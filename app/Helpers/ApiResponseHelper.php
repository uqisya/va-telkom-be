<?php

namespace App\Helpers;

/*
    ApiResponseHelper -> class untuk membantu dalam memberikan response API yang konsisten
    dengan template
    'is_success' => boolean,
    'message' => string,

    // disesuaikan dengan kebutuhan response (success/error)
    // jika response success
    'data' => array/object,

    // jika response error
    'errors' => array
*/

class ApiResponseHelper
{
    public function successResponse(string $message, $data, int $codeResponse)
    {
        return response()->json([
            'is_success' => true,
            'message' => $message,
            'data' => $data
        ], $codeResponse);
    }

    public function errorResponse(string $message, $errors, int $codeResponse)
    {
        return response()->json([
            'is_success' => false,
            'message' => $message,
            'errors' => $errors
        ], $codeResponse);
    }
}
