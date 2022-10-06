<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class WebhookController extends Controller
{
    public function index(Request $request): \Illuminate\Http\JsonResponse
    {
        Log::debug($request->all());
        return response()->json(true, 200);
    }
}
