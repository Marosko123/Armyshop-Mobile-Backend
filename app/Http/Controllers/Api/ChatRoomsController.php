<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\ChatRoom;

class ChatRoomsController extends Controller
{
    public function get(Request $request)
    {
        $chatRooms = ChatRoom::get();

        return response()->json([
            'status' => 200,
            'chatRooms' => $chatRooms
        ], 200);
    }

    public function getRoomsOfUser(Request $request, $user_id)
    {
        $user = User::find($user_id);

        if (!$user) {
            return response()->json([
                'status' => 404,
                'message' => 'User not found'
            ], 404);
        }

        $chatRooms = ChatRoom::where('members', 'LIKE', '%' . $user_id . '%')
            ->orWhere('creator_id', $user_id)
            ->distinct()
            ->get();

        return response()->json([
            'status' => 200,
            'chat_rooms' => $chatRooms
        ], 200);
    }

    public function getUsersWithPermission(Request $request, $room_id)
    {
        $roomWithUsers = ChatRoom::where('room_id', $room_id)
            ->pluck('user_id');

        if ($roomWithUsers->count() == 0) {
            return response()->json([
                'status' => 404,
                'message' => 'Room does not exist'
            ], 404);
        }

        return response()->json([
            'status' => 200,
            'roomWithUsers' => $roomWithUsers
        ], 200);
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'creator_id' => 'required|integer',
            'room_name' => 'required|string|min:1|max:64',
            'members' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'message' => $validator->messages()
            ], 422);
        }

        $chatRoom = ChatRoom::create([
            'creator_id' => $request->creator_id,
            'room_name' => $request->room_name,
            'members' => $request->members,
        ]);

        return response()->json([
            'status' => 200,
            'message' => 'Chat room created successfully',
            'chat_room' => $chatRoom
        ], 200);
    }

    public function delete(Request $request, $room_id)
    {
        ChatRoom::where('room_id', $room_id)
            ->delete();

        return response()->json([
            'status' => 200,
            'message' => 'Chat room deleted successfully'
        ], 200);
    }
}