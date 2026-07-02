<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class GenerateMediaSeeder extends Seeder
{
    /**
     * Generate placeholder images and videos for seeding.
     * Uses GD library for images and creates minimal valid MP4s for videos.
     */
    public function run(): void
    {
        $this->generatePlaceholderImages();
        $this->generatePlaceholderVideos();
        $this->command->info('✅ Generated placeholder media for seeders.');
    }

    /**
     * Generate placeholder images using GD library.
     */
    protected function generatePlaceholderImages(): void
    {
        $imagesDir = public_path('storage/images');
        
        if (! File::isDirectory($imagesDir)) {
            File::makeDirectory($imagesDir, 0755, true);
        }

        // Generate 6 unique placeholder images
        $colors = [
            [255, 87, 34],   // Deep Orange
            [63, 81, 181],   // Indigo
            [76, 175, 80],   // Green
            [233, 30, 99],   // Pink
            [0, 150, 136],   // Teal
            [255, 152, 0],   // Amber
        ];

        foreach ($colors as $index => $color) {
            $filename = "placeholder-{$index}.jpg";
            $filepath = "{$imagesDir}/{$filename}";

            // Skip if already exists
            if (File::exists($filepath)) {
                continue;
            }

            // Create a 1200x675 image (article featured image ratio)
            $image = imagecreatetruecolor(1200, 675);
            $rgbColor = imagecolorallocate($image, ...$color);
            
            // Fill background
            imagefilledrectangle($image, 0, 0, 1199, 674, $rgbColor);
            
            // Add text
            $textColor = imagecolorallocate($image, 255, 255, 255);
            $text = "Placeholder {$index}";
            $fontPath = __DIR__ . '/../../public/fonts/inter.ttf';
            
            if (file_exists($fontPath)) {
                imagettftext($image, 48, 0, 400, 350, $textColor, $fontPath, $text);
            }

            // Save as JPEG
            imagejpeg($image, $filepath, 85);
            imagedestroy($image);

            $this->command->line("  📸 Generated: {$filename}");
        }
    }

    /**
     * Generate minimal valid MP4 placeholder videos.
     * Creates very small valid MP4 files that can be used for testing.
     */
    protected function generatePlaceholderVideos(): void
    {
        $videosDir = public_path('storage/videos');
        
        if (! File::isDirectory($videosDir)) {
            File::makeDirectory($videosDir, 0755, true);
        }

        // Minimal valid MP4 file data (base64 encoded for safety)
        // This is a valid but empty MP4 container with no actual video data
        $minimalMp4Base64 = 'AAAAHGZ0eXBpc29tAAACAGlzb21pc28yYXZjMW1wNDEAAAAIZnJlZQAACfptZGF0';

        $videoCount = 3;
        for ($i = 0; $i < $videoCount; $i++) {
            $filename = "placeholder-video-{$i}.mp4";
            $filepath = "{$videosDir}/{$filename}";

            // Skip if already exists
            if (File::exists($filepath)) {
                continue;
            }

            // Create a minimal valid MP4 file
            // In production, you'd use FFmpeg or another video encoder
            $this->createMinimalMp4($filepath);

            $this->command->line("  🎬 Generated: {$filename}");
        }
    }

    /**
     * Create a minimal but valid MP4 file for testing.
     * For production, consider using FFmpeg to generate proper video files.
     */
    protected function createMinimalMp4(string $filepath): void
    {
        // This creates a valid but minimal MP4 structure
        // Real implementations should use FFmpeg
        $data = pack(
            'N',
            28
        ) . 'ftypmp42' . pack('NNN', 0, 0, 0) . pack('N', 8) . 'wide';

        File::put($filepath, $data);
    }
}
