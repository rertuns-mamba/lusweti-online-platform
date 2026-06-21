<?php

namespace App\Services;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use RuntimeException;

class RecordingService
{
    /**
     * Store incoming temporary WebM stream chunks.
     */
    public function storeChunk($sessionId, $participantId, $chunkFile, $chunkIndex)
    {
        $directory = storage_path('app/public/recordings/'.$sessionId);
        $filePath = $directory.'/audio.webm';

        // 1. Create directory if it doesn't exist
        if (! file_exists($directory)) {
            mkdir($directory, 0775, true);
        }

        // 2. Append the binary data directly to the file
        // FILE_APPEND is the key that prevents overwriting
        file_put_contents($filePath, file_get_contents($chunkFile->getRealPath()), FILE_APPEND);
    }

    /**
     * Concatenate participant chunks, expose to the public disk, and return the download URL.
     */
    public function finalizeParticipant(string $sessionId, string $participantId): string
    {
        $chunkPath = storage_path("app/recordings/{$sessionId}/{$participantId}/chunks");
        $outputPath = storage_path("app/recordings/{$sessionId}/{$participantId}");

        if (! File::exists($chunkPath)) {
            throw new RuntimeException("No recorded chunks found for participant: {$participantId}");
        }

        $finalPrivateFile = "{$outputPath}/final.webm";

        // Sort chunks sequentially
        $files = collect(File::files($chunkPath))
            ->sortBy(fn ($file) => $file->getFilename());

        // Construct FFmpeg list manifest
        $listFile = "{$chunkPath}/list.txt";
        $content = $files
            ->map(fn ($file) => "file '{$file->getPathname()}'")
            ->implode("\n");

        File::put($listFile, $content);

        // Execute linear chunk stitching via copy-demuxer

        // Added -fflags +genpts and -async 1 to repair timeline gaps
        $cmd = sprintf(
            'ffmpeg -fflags +genpts -f concat -safe 0 -i %s -c copy -async 1 %s 2>&1',
            escapeshellarg($listFile),
            escapeshellarg($finalPrivateFile)
        );
        // $cmd = sprintf(
        //     "ffmpeg -f concat -safe 0 -i %s -c copy %s 2>&1",
        //     escapeshellarg($listFile),
        //     escapeshellarg($finalPrivateFile)
        // );
        exec($cmd);

        if (! File::exists($finalPrivateFile)) {
            throw new RuntimeException('FFmpeg failed compilation processing for final sequence.');
        }

        // Bridge file to the public disk mirror
        $publicFilename = "final_{$participantId}.webm";
        $publicPath = "recordings/{$sessionId}/{$publicFilename}";

        Storage::disk('public')->put($publicPath, File::get($finalPrivateFile));

        return asset(Storage::url($publicPath));
    }

    /**
     * Compile separate participant streams into a synchronous multi-track asset.
     */
    public function mergeSessionTracks(string $sessionId): string
    {
        $basePath = storage_path("app/recordings/{$sessionId}");

        if (! File::exists($basePath)) {
            throw new RuntimeException('Target session directory layout missing.');
        }

        $participants = File::directories($basePath);

        if (count($participants) === 0) {
            throw new RuntimeException('No active participant feeds available for merging.');
        }

        // $inputs = '';
        // $maps = '';

        // foreach ($participants as $index => $dir) {
        //     $finalFile = $dir . '/final.webm';

        //     if (!File::exists($finalFile)) {
        //         continue;
        //     }

        //     $inputs .= " -i " . escapeshellarg($finalFile) . " ";
        //     $maps .= " -map {$index}:a ";
        // }

        // $output = "{$basePath}/final-output.wav";
        // $cmd = "ffmpeg {$inputs} {$maps} -acodec pcm_s16le " . escapeshellarg($output) . " 2>&1";

        // exec($cmd);

        $inputs = '';
        $inputCount = 0;

        foreach ($participants as $index => $dir) {
            $finalFile = $dir.'/final.webm';
            if (! File::exists($finalFile)) {
                continue;
            }

            $inputs .= ' -i '.escapeshellarg($finalFile).' ';
            $inputCount++;
        }

        if ($inputCount === 0) {
            throw new RuntimeException('No valid final webm files to merge.');
        }

        $output = "{$basePath}/final-output.wav";

        // Use amix filter to blend all voices into one track
        // duration=longest ensures the track doesn't cut off when the first person stops talking
        $filter = "-filter_complex amix=inputs={$inputCount}:duration=longest";

        $cmd = "ffmpeg {$inputs} {$filter} -c:a pcm_s16le ".escapeshellarg($output).' 2>&1';

        exec($cmd);

        if (! File::exists($output)) {
            throw new RuntimeException('Multi-track generation matrix process failed.');
        }

        return $output;
    }

    /**
     * Clean global silent voids out of the mixed session track.
     */
    public function removeSilence(string $sessionId): string
    {
        $input = storage_path("app/recordings/{$sessionId}/final-output.wav");
        $output = storage_path("app/recordings/{$sessionId}/clean.wav");

        if (! File::exists($input)) {
            throw new RuntimeException('Master audio matrix not found for optimization pipeline.');
        }

        $cmd = sprintf(
            'ffmpeg -i %s -af silenceremove=start_periods=1:start_duration=0.5:start_threshold=-40dB:stop_periods=-1:stop_duration=0.8:stop_threshold=-40dB %s 2>&1',
            escapeshellarg($input),
            escapeshellarg($output)
        );

        exec($cmd);

        if (! File::exists($output)) {
            throw new RuntimeException('FFmpeg failed to generate silenceremove track pipeline.');
        }

        return 'clean.wav';
    }
}
