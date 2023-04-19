<?php

namespace Database\Seeders;

use App\Models\Message;
use Illuminate\Database\Seeder;
use App\Models\User;

class MessagesSeeder extends Seeder
{
    public function run()
    {
        Message::create([
            'sender_id' => 1,
            'room_id' => 1,
            'message' => 'Hello, how may I help you today?',
            'date' => 1650518537,
        ]);

        Message::create([
            'sender_id' => 1,
            'room_id' => 1,
            'message' => 'Is everything all right?',
            'date' => 1650518800,
        ]);

        Message::create([
            'sender_id' => 2,
            'room_id' => 1,
            'message' => 'No thank you',
            'date' => 1650518900,
        ]);

        Message::create([
            'sender_id' => 1,
            'room_id' => 1,
            'message' => 'Ok, bye',
            'date' => 1650619000,
        ]);

        Message::create([
            'sender_id' => 1,
            'room_id' => 1,
            'message' => 'Hi, how do you do?',
            'date' => 1650618537,
        ]);

        Message::create([
            'sender_id' => 2,
            'room_id' => 1,
            'message' => 'Fine thanks, and you?',
            'date' => 1650618800,
        ]);

        Message::create([
            'sender_id' => 1,
            'room_id' => 1,
            'message' => 'Not bad, thanks',
            'date' => 1650618900,
        ]);

        Message::create([
            'sender_id' => 2,
            'room_id' => 1,
            'message' => 'Perfect, bye',
            'date' => 1650619000,
        ]);
    }
}