<?php

namespace Database\Seeders;

use App\Models\ChatRoom;
use Illuminate\Database\Seeder;

class ChatRoomsSeeder extends Seeder
{
    public function run()
    {
        ChatRoom::create([
            'creator_id' => 1,
            'room_name' => "Admin Test Room",
            'members' => '{"user_ids":[1,2,3]}',
        ]);

    }
}