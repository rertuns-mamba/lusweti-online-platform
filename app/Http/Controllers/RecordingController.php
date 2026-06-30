<?php


namespace App\Http\Controllers;

use App\Services\RecordingService;
use App\Broadcast\SRS\SrsService; // Import your service
use Illuminate\Http\Request;

class RecordingController extends Controller
{
    protected RecordingService $recordingService;
    protected SrsService $srsService; // Define property

    // Laravel automatically "resolves" and injects both services here
    public function __construct(RecordingService $recordingService, SrsService $srsService)
    {
        $this->recordingService = $recordingService;
        $this->srsService = $srsService;
    }

    public function goLive(Request $request)
    {
        // Now you have full access to your broadcast tools!
        $streamKey = 'my-show-123';
        $token = 'secure-token-abc';
        
        $details = $this->srsService->getChannelConnectionDetails($streamKey, $token);
        
        return response()->json($details);
    }
}

// namespace App\Http\Controllers;

// use App\Jobs\ProcessParticipantRecording;
// use Illuminate\Http\Request;
// use App\Services\RecordingService;
// use Illuminate\Http\JsonResponse;
// use Exception;
// use Illuminate\Support\Facades\Log;
// use Illuminate\Support\Str;
// use Illuminate\Support\Facades\Storage;

// class RecordingController extends Controller
// {
//     protected RecordingService $recordingService;

//     /**
//      * Inject the underlying processing layer.
//      */
//     public function __construct(RecordingService $recordingService)
//     {
//         $this->recordingService = $recordingService;
//     }

//     /**
//      * Stream chunk endpoint.
//      */
//     public function storeChunk($sessionId, $participantId, $chunkFile, $chunkIndex)
//     {
//         // 1. Define the directory path
//         // Using storage_path() allows us to get the absolute system path
//         $directory = storage_path('app/public/recordings/' . $sessionId);

//         // 2. Ensure the directory exists
//         // 0775 is standard for web servers (Owner: read/write/exec, Group: read/write/exec, Others: read/exec)
//         if (!file_exists($directory)) {
//             mkdir($directory, 0775, true);
//         }

//         // 3. Define the final file name
//         $filePath = $directory . '/audio.webm';

//         // 4. Append the chunk data
//         // getRealPath() retrieves the temporary path where Laravel stored the upload
//         // FILE_APPEND ensures we add to the end of the file instead of overwriting it
//         file_put_contents($filePath, file_get_contents($chunkFile->getRealPath()), FILE_APPEND);

//         Log::info("Chunk {$chunkIndex} appended for session {$sessionId}");
//     }
//     // // public function uploadChunk(Request $request): JsonResponse
//     // // {
//     // //     // In your Laravel Controller handling the upload:
//     // //     $safeFolder = Str::slug($request->input('sessionId'));
//     // //     // or hash it: $safeFolder = md5($request->input('sessionId'));

//     // //     Storage::disk('public')->makeDirectory("recordings/{$safeFolder}/...");


//     // //     $request->validate([
//     // //         'chunk' => 'required|file',
//     // //         'sessionId' => 'required|string',
//     // //         'participantId' => 'required|string',
//     // //     ]);

//     // //     try {
//     // //         $this->recordingService->storeChunk(
//     // //             $request->sessionId,
//     // //             $request->participantId,
//     // //             $request->file('chunk')
//     // //         );

//     // //         return response()->json(['status' => 'chunk_uploaded']);
//     // //     } catch (Exception $e) {
//     // //         return response()->json(['error' => $e->getMessage()], 500);
//     // //     }
//     // // }

//     /**
//      * Processing closure point for single tracks.
//      */


//     public function finalize(Request $request): JsonResponse
//     {
//         $request->validate([
//             'sessionId' => 'required|string',
//             'participantId' => 'required|string',
//         ]);

//         // Push to Redis/Database queue
//         ProcessParticipantRecording::dispatch(
//             $request->sessionId,
//             $request->participantId
//         );

//         // 202 tells the client: "We received this and are working on it."
//         return response()->json([
//             'success' => true,
//             'status' => 'processing_started',
//             'message' => 'Recording is being compiled. You will be notified when ready.'
//         ], 202);
//     }
//     // public function finalize(Request $request): JsonResponse
//     // {
//     //     Log::info('--- FINALIZING RECORDING REACHED ---');
//     //     Log::info('Request Session ID: ' . $request->input('sessionId'));
//     //     Log::info('Finalize request received for session: ' . $request->input('sessionId'));
//     //     $request->validate([
//     //         'sessionId' => 'required|string',
//     //         'participantId' => 'required|string',
//     //         'startTime' => 'required'
//     //     ]);

//     //     try {
//     //         $downloadUrl = $this->recordingService->finalizeParticipant(
//     //             $request->sessionId,
//     //             $request->participantId
//     //         );

//     //         return response()->json([
//     //             'success' => true,
//     //             'status' => 'participant_finalized',
//     //             'download_url' => $downloadUrl
//     //         ]);
//     //     } catch (Exception $e) {
//     //         return response()->json(['error' => $e->getMessage()], 400);
//     //     }
//     // }

//     /**
//      * Session multi-track mixdown execution.
//      */
//     public function mergeSession($sessionId): JsonResponse
//     {
//         try {
//             $output = $this->recordingService->mergeSessionTracks($sessionId);

//             return response()->json([
//                 'status' => 'session_merged',
//                 'output' => $output
//             ]);
//         } catch (Exception $e) {
//             return response()->json(['error' => $e->getMessage()], 400);
//         }
//     }

//     /**
//      * Audio dynamics silence gate endpoint.
//      */
//     public function removeSilence($sessionId): JsonResponse
//     {
//         try {
//             $outputFilename = $this->recordingService->removeSilence($sessionId);

//             return response()->json([
//                 'output' => $outputFilename
//             ]);
//         } catch (Exception $e) {
//             return response()->json(['error' => $e->getMessage()], 400);
//         }
//     }
// }
