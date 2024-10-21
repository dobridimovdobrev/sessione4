<?php
namespace App\Helpers;

class ResponseMessages
{
//reusable success message ( i can use later the status for the frontend)
public static function success($message, $code){
    return response()->json([
        'status' => 'success',
        'message' => $message
    ],$code);
}

// reusable error message ( i can use later the status for the frontend)
public static function error($message, $code){
    return response()->json([
        'status' => 'error',
        'message' => $message
    ],$code);
}

}