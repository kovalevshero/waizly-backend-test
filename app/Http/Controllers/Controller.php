<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Log;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function successResponse(string $message, $data = [], $meta = null, int $statusCode = 200): JsonResponse
    {
        $response = [
            'status' => 'success',
            'message' => $message,
            'data' => $data,
        ];

        if ($meta) {
            $response['meta'] = $meta;
        }

        Log::info($message, [
            'user' => request()->user() ? request()->user()->id : 'Unknown',
            'path' => request()->url(),
            'method' => request()->method(),
            'statusCode' => $statusCode,
            'requestBody' => request()->all(),
            'meta' => $meta,
        ]);

        return response()->json($response, $statusCode);
    }

    public function errorResponse(Exception $e, string $message = "An error occurred", int $statusCode = 500, $data = null): JsonResponse
    {
        $errorMessage = $e->getMessage();

        Log::error($message, [
            'user' => request()->user() ? request()->user()->id : 'Unknown',
            'path' => request()->url(),
            'method' => request()->method(),
            'statusCode' => $statusCode,
            'requestBody' => request()->all(),
            'error' => $errorMessage,
            'stack' => (env('APP_DEBUG') ? $e->getTraceAsString() : null),
        ]);

        return response()->json([
            'status' => 'error',
            'message' => $message,
            'data' => $data,
            'error' => $errorMessage,
        ], $statusCode);
    }
}
