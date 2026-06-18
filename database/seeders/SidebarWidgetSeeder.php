<?php

namespace Database\Seeders;

use App\Models\SidebarWidget;
use App\Models\Category;
use Illuminate\Database\Seeder;

class SidebarWidgetSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Get a sample category or null
        $category = Category::first();

        // 2. Define standard sidebar widgets
        $widgets = [
            [
                'title' => 'Useful External Links',
                'type' => 'links',
                'category_id' => null, // Global Widget
                'order' => 1,
                'content_data' => [
                    [
                        'type' => 'links',
                        'data' => [
                            'items' => [
                                ['label' => 'Official News Portal', 'url' => 'https://example.com'],
                                ['label' => 'Emergency Contacts', 'url' => 'https://example.com/contacts'],
                            ]
                        ]
                    ]
                ]
            ],
            [
                'title' => 'Related Stories',
                'type' => 'related',
                'category_id' => $category?->id, // Category Specific
                'order' => 2,
                'content_data' => [
                    [
                        'type' => 'related',
                        'data' => [
                            'article_ids' => [] // Will be empty until you link IDs
                        ]
                    ]
                ]
            ]
        ];

        // 3. Insert into database
        foreach ($widgets as $widget) {
            SidebarWidget::updateOrCreate(
                ['title' => $widget['title']], // Unique identifier
                $widget
            );
        }
    }
}
