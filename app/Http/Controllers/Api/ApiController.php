<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

class ApiController extends Controller
{
    protected function successResponse($data, $message = null, $code = Response::HTTP_OK)
    {
        return response()->json([
            'status' => true,
            'message' => $message,
            'data' => $data
        ], $code);
    }

    protected function errorResponse($message, $code = Response::HTTP_BAD_REQUEST)
    {
        return response()->json([
            'status' => false,
            'message' => $message,
        ], $code);
    }
} 