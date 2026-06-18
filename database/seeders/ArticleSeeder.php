<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Article;
use App\Models\Category;
use App\Models\User;
use App\Models\Page;
use Illuminate\Support\Str;

class ArticleSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::first() ?? User::factory()->create();
        $categories = Category::all();
        $sportsPage = Page::where('slug', 'sports')->first();

        // Local image files from storage/app/public/images/
        $localImages = [
            storage_path('app/public/images/kenya_sports.jpg'),
            storage_path('app/public/images/majuu_sports.jpeg'),
            storage_path('app/public/images/png-thumb.jpg'),
            'https://images.unsplash.com/photo-1461896836934- voices-1?w=800',
            'https://images.unsplash.com/photo-1579952363873-27f3bade9f55?w=800',
            'https://picsum.photos/800/600?random=1',
            'https://picsum.photos/800/600?random=2',           
        ];

        // Local video file from storage/app/public/videos/
        $localVideo = storage_path('app/public/videos/mp4.mp4');

        // Sample YouTube video IDs
        $youtubeIds = [
            'jNQXAC9IVRw', // Me at the zoo
            'dQw4w9WgXcQ', // Rick Astley
            'tPEE9ZwTmy0', // PSY - Gangnam Style
            '9bZkp7q19f0', // PSY - Gentleman
            'kJQP7kiw5Fk', // Despacito
            'RgKAFK5djSk', // Wiz Khalifa - See You Again
            'JGwWNGJdvx8', // Ed Sheeran - Shape of You
            'OPf0YbXqDm0', // Mark Ronson - Uptown Funk
            'CevxZvSJLk8', // Katy Perry - Roar
            'fRh_vgS2dFE', // Justin Bieber - Sorry
        ];

        // Sample external URLs
        $externalUrls = [
            'https://www.bbc.com/sport',
            'https://www.espn.com',
            'https://www.skysports.com',
            'https://www.cnn.com/sport',
            'https://www.aljazeera.com/sport',
        ];

        foreach ($categories as $category) {
            for ($i = 1; $i <= 10; $i++) {
                $title = "Sample {$category->name} Headline " . $i;

                // Randomly designate some articles as external links, YouTube videos, local videos, or regular articles
                $randomType = rand(1, 10);
                $isExternal = $randomType <= 2;
                $isYoutube = $randomType > 2 && $randomType <= 4;
                $isLocalVideo = $randomType > 4 && $randomType <= 5;

                $article = Article::create([
                    'category_id'  => $category->id,
                    'page_id'      => $sportsPage->id ?? null,
                    'user_id'      => $user->id,
                    'title'        => $title,
                    'slug'         => Str::slug($title) . '-' . uniqid(),
                    'summary'      => "This is a compelling summary for the {$category->name} section. It should wrap nicely over two to three lines in the grid.",
                    'content'      => "<p>Full editorial content goes here.</p>",
                    'topic_label'  => 'Breaking',
                    'content_type' => 'article',
                    'layout_type' => 'hero',
                    'is_visible'   => true,
                    'is_active'    => true,
                    'is_youtube'   => $isYoutube,
                    'external_url' => $isExternal ? $externalUrls[array_rand($externalUrls)] : null,
                    'video_url'    => $isYoutube ? 'https://www.youtube.com/watch?v=' . $youtubeIds[array_rand($youtubeIds)] : null,
                    'published_at' => now()->subMinutes(rand(10, 1440)),
                ]);

                // Attach the media using Spatie Media Library with local files
                if (!$isExternal && !$isYoutube) {
                    if ($isLocalVideo && file_exists($localVideo)) {
                        // Attach local video
                        try {
                            $article->addMedia($localVideo)
                                ->preservingOriginal()
                                ->toMediaCollection('videos');

                            $article->update([
                                'video_url' => $article->getFirstMediaUrl('videos')
                            ]);
                        } catch (\Exception $e) {
                            // FFmpeg may not be configured, skip video attachment
                        }
                    } else {
                        // Attach local image
                        $imagePath = $localImages[array_rand($localImages)];
                        if (file_exists($imagePath)) {
                            try {
                                $article->addMedia($imagePath)
                                    ->preservingOriginal()
                                    ->toMediaCollection('images');

                                // Update the featured image thumb URL for frontend display
                                $imageUrl = $article->getFirstMediaUrl('images');
                                if ($imageUrl) {
                                    $article->update([
                                        'featured_image_thumb_url' => $imageUrl,
                                        'image_path' => $imageUrl
                                    ]);
                                }
                            } catch (\Exception $e) {
                                // Skip image attachment if it fails
                            }
                        }
                    }
                }
            }
        }
    }
}

