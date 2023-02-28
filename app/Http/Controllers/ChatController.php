<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\chats;

class ChatController extends Controller
{
    public function sendmessage(Request $request)
    {
        $response['reply'] = '';
        $response['bot_question'] = '';
        $chat = chats::where('user_message', 'LIKE', '%' . $request->message . '%')->first();
        if ($chat) {
            $response['reply'] = $chat->bot_reply;
            $response['bot_question'] = $chat->bot_question;
        } else {
            $response['reply'] = "I can't understand your queries";
        }
        return response()->json($response,200);
    }
}
