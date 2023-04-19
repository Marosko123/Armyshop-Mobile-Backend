<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\User;
use App\Models\Message;
use App\Models\ChatRoom;
use Illuminate\Support\Facades\Validator;

class MessagesController extends Controller
{
    public function getMessages(Request $request, $user_id, $room_id)
    {
        // does sender exist
        if (!User::find($user_id)) {
            return response()->json([
                'status' => 404,
                'message' => 'Sender not found'
            ], 404);
        }

        $messages = Message::where('room_id', $room_id)
            ->orderBy('date', 'asc')
            ->get();

        return response()->json([
            'status' => 200,
            'messages' => $messages
        ], 200);
    }

    public function sendMessage(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'sender_id' => 'required|integer',
            'room_id' => 'required|integer',
            'message' => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'message' => $validator->messages()
            ], 422);
        }

        // does sender exist
        if (!User::find($request->sender_id)) {
            return response()->json([
                'status' => 404,
                'message' => 'Sender not found'
            ], 404);
        }

        $message = Message::create([
            'sender_id' => $request->sender_id,
            'room_id' => $request->room_id,
            'message' => $request->message,
            'date' => time()
        ]);

        return response()->json([
            'status' => 200,
            'message' => $message,
        ], 200);
    }
}