<?php

namespace Database\Seeders;

use App\Jobs\AttachArticleMediaJob;
use App\Models\Article;
use App\Models\Category;
use App\Models\Page;
use App\Models\User;
use Database\Seeders\Concerns\UsesPublicStorageMedia;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class ArticleSeeder extends Seeder
{
    use UsesPublicStorageMedia;

    public const ARTICLES_PER_CATEGORY = 12;
    public const CHUNK_SIZE = 100;

    public function run(): void
    {
        $user = User::first() ?? User::factory()->create();
        $page = Page::where('slug', 'general-sports')->first() ?? Page::where('slug', 'home')->first();
        
        if (!$user || !$page) {
            Log::error('ArticleSeeder aborted: Missing base User or Page.');
            return;
        }

        // Branch logic based on environment
        if (App::environment('production')) {
            $this->runProductionSeeding($user, $page);
        } else {
            $this->runLocalSeeding($user, $page);
        }
    }

    /**
     * Safely seeds minimal structure for Production.
     * Prevents overwriting live data or injecting dummy content.
     */
    protected function runProductionSeeding(User $user, Page $page): void
    {
        if (Article::exists()) {
            $this->command->info('Production environment detected. Articles table is not empty. Skipping dummy data injection.');
            return;
        }

        $this->command->warn('Production environment detected. Seeding initial Welcome article only.');

        $category = Category::firstOrCreate(
            ['slug' => 'announcements'],
            ['name' => 'Announcements', 'is_active' => true]
        );

        Article::create([
            'category_id' => $category->id,
            'page_id' => $page->id,
            'user_id' => $user->id,
            'title' => 'Welcome to the Platform',
            'slug' => 'welcome-to-the-platform',
            'summary' => 'Our new sports portal is officially live.',
            'content' => '<p>Welcome to the production launch of the sports application.</p>',
            'topic_label' => 'Featured',
            'content_type' => 'article',
            'layout_type' => 'hero',
            'is_visible' => true,
            'is_active' => true,
            'published_at' => now(),
        ]);
    }

    /**
     * High-performance bulk seeding for Local/Testing environments.
     */
    protected function runLocalSeeding(User $user, Page $page): void
    {
        $this->command->info('Local environment detected. Commencing high-speed bulk seed...');

        $categories = Category::where('is_active', true)->get();
        $images = collect($this->publicStorageImages());
        $videos = collect($this->publicStorageVideos());
        $externalStories = collect($this->externalStories());
        $youtubeStories = collect($this->youtubeStories());

        $articlesToInsert = [];
        $mediaTasks = [];

        // 1. Build the dataset in memory
        foreach ($categories as $category) {
            for ($index = 0; $index < self::ARTICLES_PER_CATEGORY; $index++) {
                $kind = $index % 4;
                $title = $this->titleFor($category, $index, $kind);
                $slug = Str::slug($title);
                
                $articleData = $this->getBaseArticleArray($category, $page, $user, $title, $slug, $index, $kind);

                // Pre-process third-party media URLs
                // Pre-process third-party media URLs
                if ($kind === 2) { // YouTube
                    $story = $youtubeStories[$index % max($youtubeStories->count(), 1)];
                    // ✨ FIX: Append category name and index to guarantee unique slugs
                    $articleData['title'] = "{$category->name}: {$story['title']} " . ($index + 1);
                    $articleData['slug'] = Str::slug($articleData['title']);
                    
                    $articleData['is_youtube'] = true;
                    $articleData['video_url'] = $this->youtubeWatchUrl($story['id']);
                    $articleData['featured_image_thumb_url'] = $this->youtubeThumbnailUrl($story['id']);
                    $articleData['image_path'] = $articleData['featured_image_thumb_url'];
                    
                } elseif ($kind === 3) { // External
                    $story = $externalStories[$index % max($externalStories->count(), 1)];
                    // ✨ FIX: Append category name and index to guarantee unique slugs
                    $articleData['title'] = "{$category->name}: {$story['title']} " . ($index + 1);
                    $articleData['slug'] = Str::slug($articleData['title']);
                    
                    $articleData['external_url'] = $story['url'];
                    $articleData['featured_image_thumb_url'] = $story['image'];
                    $articleData['image_path'] = $story['image'];
                }

                $articlesToInsert[] = $articleData;

                // Track which specific slugs need local Spatie file attachments via Queue
                if ($kind === 0 || $kind === 1) {
                    $mediaTasks[$articleData['slug']] = [
                        'image' => $images->get($index % max($images->count(), 1)),
                        'video' => $kind === 1 ? $videos->get($index % max($videos->count(), 1)) : null,
                    ];
                }
            }
        }

        // 2. Perform Database Operations
        DB::transaction(function () use ($articlesToInsert) {
            Article::withoutEvents(function () use ($articlesToInsert) {
                collect($articlesToInsert)->chunk(self::CHUNK_SIZE)->each(function ($chunk) {
                    Article::upsert(
                        $chunk->toArray(),
                        ['slug'], // Unique constraint
                        [
                            'category_id', 'title', 'summary', 'content', 'topic_label', 
                            'content_type', 'is_visible', 'is_active', 'is_youtube', 
                            'external_url', 'video_url', 'featured_image_thumb_url', 
                            'image_path', 'published_at', 'updated_at'
                        ]
                    );
                });
            });
        });

        // 3. Dispatch Media Jobs (Cloud Safe)
        $this->dispatchMediaJobs($mediaTasks);
    }

    /**
     * Fetches the newly inserted articles and pushes media processing to the Queue.
     */
    protected function dispatchMediaJobs(array $mediaTasks): void
    {
        $slugs = array_keys($mediaTasks);
        
        if (empty($slugs)) {
            return;
        }

        // Fetch the models that were just inserted by the bulk upsert
        Article::whereIn('slug', $slugs)->chunk(self::CHUNK_SIZE, function ($articles) use ($mediaTasks) {
            foreach ($articles as $article) {
                $task = $mediaTasks[$article->slug];
                
                // Skip dispatching if image URL is missing
                if ($task['image'] === null) {
                    continue;
                }
                
                // Dispatch to the background queue, preventing Seeder timeouts
                AttachArticleMediaJob::dispatch(
                    $article, 
                    $task['image'], 
                    $task['video']
                );
            }
        });

        $this->command->info(count($slugs) . ' media attachment jobs dispatched to the queue.');
    }

    protected function titleFor(Category $category, int $index, int $kind): string
    {
        $labels = ['Photo Essay', 'Local Video', 'YouTube Highlight', 'External Report'];
        return "{$category->name} {$labels[$kind]} " . ($index + 1);
    }

    protected function getBaseArticleArray(Category $category, Page $page, User $user, string $title, string $slug, int $index, int $kind): array
    {
        return [
            'category_id' => $category->id,
            'page_id' => $page->id,
            'user_id' => $user->id,
            'title' => $title,
            'slug' => $slug,
            'summary' => "Dummy {$category->name} coverage seeded from public storage.",
            'content' => '<p>This seeded story is used to exercise the frontend UI.</p>',
            'topic_label' => $kind === 3 ? 'External' : 'Featured',
            'content_type' => $kind === 1 || $kind === 2 ? 'video' : 'article',
            'layout_type' => 'hero',
            'is_visible' => true,
            'is_active' => true,
            'is_youtube' => false,
            'external_url' => null,
            'video_url' => null,
            'featured_image_thumb_url' => null,
            'image_path' => null,
            'published_at' => now()->subMinutes(($index + 1) * 11)->toDateTimeString(),
            'created_at' => now()->toDateTimeString(),
            'updated_at' => now()->toDateTimeString(),
        ];
    }
}

// namespace Database\Seeders;

// use App\Models\Article;
// use App\Models\Category;
// use App\Models\Page;
// use App\Models\User;
// use Database\Seeders\Concerns\UsesPublicStorageMedia;
// use Illuminate\Database\Seeder;
// use Illuminate\Support\Collection;
// use Illuminate\Support\Facades\DB;
// use Illuminate\Support\Facades\Log;
// use Illuminate\Support\Str;

// class ArticleSeeder extends Seeder
// {
//     use UsesPublicStorageMedia;

//     // Set to true to let Laravel handle the outer transaction if called by DatabaseSeeder,
//     // though we are manually handling the inner bulk transaction below.
//     public $withinTransaction = true;

//     public function run(): void
//     {
//         $user = User::first() ?? User::factory()->create();
//         $page = Page::where('slug', 'general-sports')->first() ?? Page::where('slug', 'home')->first();
//         $categories = Category::where('is_active', true)->get();
//         $images = $this->publicStorageImages();
//         $videos = $this->publicStorageVideos();
//         $externalStories = collect($this->externalStories());
//         $youtubeStories = collect($this->youtubeStories());


// //         // Wrap the entire loop in a transaction AND mute events
// // DB::transaction(function () use ($categories, $user, $page, $images, $videos, $externalStories, $youtubeStories) {
// //     Article::withoutEvents(function () use ($categories, $user, $page, $images, $videos, $externalStories, $youtubeStories) {
// //         foreach ($categories as $category) {
// //             // ... your existing for-loop logic ...
// //         }
// //     });
// // });

//         // Wrap the entire loop in a transaction for massive insert speed gains
//         DB::transaction(function () use ($categories, $user, $page, $images, $videos, $externalStories, $youtubeStories) {
//     Article::withoutEvents(function () use ($categories, $user, $page, $images, $videos, $externalStories, $youtubeStories) {
//         foreach ($categories as $category) {
//                 for ($index = 0; $index < 12; $index++) {
//                     $title = null;
//                     try {
//                         $kind = $index % 4;
//                         $title = $this->titleFor($category, $index, $kind);
//                         $slug = Str::slug($title);

//                         $article = Article::updateOrCreate(
//                             ['slug' => $slug],
//                             [
//                                 'category_id' => $category->id,
//                                 'page_id' => $page?->id,
//                                 'user_id' => $user->id,
//                                 'title' => $title,
//                                 'summary' => "Dummy {$category->name} coverage seeded from public storage so frontend sections have realistic media.",
//                                 'content' => '<p>This seeded story is used to exercise the frontend article, hero, video, and external-link layouts.</p>',
//                                 'topic_label' => $kind === 3 ? 'External' : 'Featured',
//                                 'content_type' => $kind === 1 || $kind === 2 ? 'video' : 'article',
//                                 'layout_type' => 'hero',
//                                 'is_visible' => true,
//                                 'is_active' => true,
//                                 'is_youtube' => false,
//                                 'external_url' => null,
//                                 'video_url' => null,
//                                 'featured_image_thumb_url' => null,
//                                 'image_path' => null,
//                                 'published_at' => now()->subMinutes(($index + 1) * 11),
//                             ]
//                         );

//                         match ($kind) {
//                             1 => $this->seedLocalVideoArticle($article, $videos, $images, $index),
//                             // Pass $category explicitly to prevent N+1 queries
//                             2 => $this->seedYoutubeArticle($article, $category, $youtubeStories[$index % max($youtubeStories->count(), 1)]),
//                             3 => $this->seedExternalArticle($article, $externalStories[$index % max($externalStories->count(), 1)]),
//                             default => $this->attachFeaturedImage($article, $images->get($index % max($images->count(), 1))),
//                         };
//                     } catch (\Throwable $e) {
//                         // Log the error natively so it doesn't fail silently if something breaks inside the transaction
//                         Log::warning("Failed to seed article: {$title}. Error: {$e->getMessage()}");
//                     }
//                 }
//             }
//         });
//     }

//     protected function titleFor(Category $category, int $index, int $kind): string
//     {
//         $labels = [
//             'Photo Essay',
//             'Local Video',
//             'YouTube Highlight',
//             'External Report',
//         ];

//         return "{$category->name} {$labels[$kind]} " . ($index + 1);
//     }

//     /**
//      * @param  Collection<int, string>  $videos
//      * @param  Collection<int, string>  $images
//      */
//     protected function seedLocalVideoArticle(Article $article, Collection $videos, Collection $images, int $index): void
//     {
//         $this->attachLocalVideo(
//             $article,
//             $videos->get($index % max($videos->count(), 1)),
//             $images->get($index % max($images->count(), 1)),
//         );
//     }

//     /**
//      * @param  array{id: string, title: string}  $youtubeStory
//      */
//     protected function seedYoutubeArticle(Article $article, Category $category, array $youtubeStory): void
//     {
//         $thumbnailUrl = $this->youtubeThumbnailUrl($youtubeStory['id']);

//         $article->forceFill([
//             // Uses the passed $category object to eliminate the hidden N+1 query
//             'title' => "{$category->name} {$youtubeStory['title']}",
//             'is_youtube' => true,
//             'video_url' => $this->youtubeWatchUrl($youtubeStory['id']),
//             'featured_image_thumb_url' => $thumbnailUrl,
//             'image_path' => $thumbnailUrl,
//         ])->save();
//     }

//     /**
//      * @param  array{url: string, image: string, title: string}  $externalStory
//      */
//     protected function seedExternalArticle(Article $article, array $externalStory): void
//     {
//         $article->forceFill([
//             'title' => $externalStory['title'],
//             'external_url' => $externalStory['url'],
//             'featured_image_thumb_url' => $externalStory['image'],
//             'image_path' => $externalStory['image'],
//             'is_youtube' => false,
//             'video_url' => null,
//         ])->save();
//     }
// }
