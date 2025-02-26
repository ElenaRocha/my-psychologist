<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;

abstract class Controller extends BaseController
{
    public function successResponse($data, $message = "Success", $status = 200)
    {
        return response()->json([
            'message' => $message,
            'data' => $data
        ], $status);
    }

    public function errorResponse($message = "Error", $status = 400)
    {
        return response()->json([
            'message' => $message
        ], $status);
    }
}
