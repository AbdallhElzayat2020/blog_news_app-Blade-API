<?php

namespace App\Http\Helpers;

if (!function_exists('apiResponse')) {
    function apiResponse($status, $message = null, $data = null): \Illuminate\Http\JsonResponse
    {
        $response = [
            'status' => $status,
            'message' => $message,
        ];

        if ($data !== null) {
            $response['data'] = $data;
        }


        return response()->json($response, $status);
    }
}
