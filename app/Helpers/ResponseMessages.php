<?php
namespace App\Helpers;

class ResponseMessages
{
/**
 * Reusable success message with support for both message and data formats
 * 
 * @param mixed $messageOrData The message string or data array
 * @param int $code HTTP status code
 * @param bool $useDataKey Whether to include data key in response (for Angular compatibility)
 * @return \Illuminate\Http\JsonResponse
 */
public static function success($messageOrData, $code, $useDataKey = false){
    $response = ['status' => 'success'];
    
    // Check if $messageOrData is an array with 'tv_series' key (TV Series update case)
    if (is_array($messageOrData) && isset($messageOrData['tv_series'])) {
        // Format for Angular compatibility - move tv_series to data key
        $response['message'] = $messageOrData['message'] ?? 'Success';
        $response['data'] = $messageOrData['tv_series'];
    } 
    // Check if explicitly requested to use data key
    elseif ($useDataKey) {
        $response['data'] = $messageOrData;
    }
    // Default format (backward compatible)
    else {
        $response['message'] = $messageOrData;
    }
    
    return response()->json($response, $code);
}

/**
 * Reusable error message
 * 
 * @param string $message Error message
 * @param int $code HTTP status code
 * @return \Illuminate\Http\JsonResponse
 */
public static function error($message, $code){
    return response()->json([
        'status' => 'error',
        'message' => $message
    ],$code);
}

}