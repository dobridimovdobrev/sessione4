<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Models\VideoFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

class StreamController extends Controller
{
    /**
     * Stream a video file
     *
     * @param string $filename
     * @return \Symfony\Component\HttpFoundation\StreamedResponse|\Illuminate\Http\Response
     */
    public function streamVideo($filename)
    {
        // Trova il video nel database usando il filename
        $video = VideoFile::where('url', 'LIKE', '%' . $filename . '%')->first();
        
        if (!$video) {
            return response()->json(['error' => 'Video non trovato'], 404);
        }
        
        $path = $video->url;
        
        // Verifica se il file esiste
        if (!Storage::disk('public')->exists($path)) {
            return response()->json(['error' => 'File non trovato'], 404);
        }
        
        // Determina il tipo MIME in base all'estensione del file
        $extension = pathinfo($path, PATHINFO_EXTENSION);
        $contentType = $this->getContentType($extension);
        
        // Supporto per range request (per permettere lo seeking nel video)
        $fileSize = Storage::disk('public')->size($path);
        $start = 0;
        $end = $fileSize - 1;
        $status = 200;
        
        // Gestione delle richieste range (per lo streaming parziale)
        if (isset($_SERVER['HTTP_RANGE'])) {
            $range = $_SERVER['HTTP_RANGE'];
            $range = str_replace('bytes=', '', $range);
            $range = explode('-', $range);
            $start = (int)$range[0];
            $end = (isset($range[1]) && is_numeric($range[1])) ? (int)$range[1] : $fileSize - 1;
            $status = 206; // Partial Content
        }
        
        $length = $end - $start + 1;
        
        // Imposta gli header appropriati
        $headers = [
            'Content-Type' => $contentType,
            'Content-Length' => $length,
            'Accept-Ranges' => 'bytes',
            'Content-Range' => "bytes $start-$end/$fileSize",
        ];
        
        if ($status === 206) {
            $headers['Content-Range'] = "bytes $start-$end/$fileSize";
        }
        
        // Crea una risposta di streaming
        $response = new StreamedResponse(function () use ($path, $start, $end) {
            $handle = fopen(Storage::disk('public')->path($path), 'rb');
            fseek($handle, $start);
            $buffer = 1024 * 8; // 8KB buffer
            $currentPosition = $start;
            
            while (!feof($handle) && $currentPosition <= $end) {
                $bytesToRead = min($buffer, $end - $currentPosition + 1);
                echo fread($handle, $bytesToRead);
                flush();
                $currentPosition += $bytesToRead;
            }
            
            fclose($handle);
        }, $status, $headers);
        
        return $response;
    }
    
    /**
     * Get the content type based on file extension
     *
     * @param string $extension
     * @return string
     */
    private function getContentType($extension)
    {
        $contentTypes = [
            'mp4' => 'video/mp4',
            'webm' => 'video/webm',
            'ogg' => 'video/ogg',
            'mov' => 'video/quicktime',
            'avi' => 'video/x-msvideo',
            'mkv' => 'video/x-matroska',
        ];
        
        return $contentTypes[strtolower($extension)] ?? 'application/octet-stream';
    }
}
