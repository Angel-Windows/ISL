<?php

namespace App\Http\Controllers;

use App\Models\Calendar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class WebhookController extends Controller
{
    public function index(Request $request): \Illuminate\Http\JsonResponse
    {
        $data_request = explode('|', $request->input('callback_query')['data']);
        $action = $data_request[0];
        $id = $data_request[1];
        $lesson = Calendar::where('id', $id)->first();

        switch ($action){
            case "1":
                $lesson->status = 0;
                $lesson->save();
                break;
            case "2":
                $lesson->status = 3;
                $lesson->save();
                break;
        }
        return response()->json(true, 200);
    }
}
