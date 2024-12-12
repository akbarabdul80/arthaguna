<?php

namespace App\Http\Responses;

use Illuminate\Http\JsonResponse;

class BaseResponse
{
    public static function json(string $message, int $status = 200, $data = "", $errors = null): JsonResponse
    {
        return response()->json([
            'status' => $status,
            'message' => $message,
            'data' => $data,
            'errors' => $errors,
        ], $status);
    }

    // Shortcuts for common response scenarios
    public static function success(string $message, $data = "", int $status = 200): JsonResponse
    {
        return self::json($message, $status, $data);
    }

    public static function error(string $message, int $status = 400, $errors = null): JsonResponse
    {
        return self::json($message, $status, null, $errors);
    }

    public static function errorNotFound(string $message = "Data not found"): JsonResponse
    {
        return self::error($message, 404);
    }

    public static function errorInternal(string $message = "Internal server error"): JsonResponse
    {
        return self::error($message, 500);
    }

    public static function errorUnauthorized(string $message = "Silahkan Login Kembali!"): JsonResponse
    {
        return self::error($message, 401);
    }

    public static function errorForbidden(string $message = "Forbidden"): JsonResponse
    {
        return self::error($message, 403);
    }

    public static function errorBadRequest(string $message = "Bad request", $errors = null): JsonResponse
    {
        return self::error($message, 400, null, $errors);
    }

    public static function errorConflict(string $message = "Conflict"): JsonResponse
    {
        return self::error($message, 409);
    }

}
