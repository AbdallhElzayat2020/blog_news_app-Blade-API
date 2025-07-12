<?php

namespace App\Http\Helpers;

if (!function_exists('apiResponse')) {
    function apiResponse($status, $message = null, $data = null): \Illuminate\Http\JsonResponse
    {
        $response = [
            'message' => $message,
            'status' => $status,
        ];

        if ($data !== null) {
            $response['data'] = $data;
        }


        return response()->json($response, $status);
    }
}
