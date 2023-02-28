<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use BotMan\BotMan\BotMan;
use BotMan\BotMan\Messages\Incoming\Answer;
use App\chats;


class BotmanController extends Controller
{
    public function findreply($message)
    {
        return chats::where('user_message', 'LIKE', '%' . $message . '%')->first();
    }
    public function handle(Request $request)
    {
        $botman = app('botman');
        $chatmodel =  new chats;
        $botman->hears('{message}', function ($botman, $message) use ($chatmodel) {
            if ($message == 'hi' || $message == 'hello') {
                $this->askName($botman, $message);
            } else {
                $data = $this->findreply($message);
                if ($data) {
                    if ($data->bot_reply) {
                        $botman->reply($data->bot_reply);
                    }
                    if ($data->bot_question) {
                        $botman->reply($data->bot_question);
                    }
                } else {
                    $chatmodel->user_message = $message;
                    $chatmodel->bot_reply = '';
                    $chatmodel->save();
                }
            }

            // if ($message == 'hi' || $message == 'hello') {
            //     $this->askName($botman, $message);
            // } elseif ($message == 'How are you' || $message == 'how are you') {
            //     $botman->reply('Fine');
            //     $botman->reply('How are you?');
            // } elseif($message == 'fine') {
            //     $botman->reply('How can i help you?');
            // } elseif ($message == "how does it work") {
            //     $botman->reply('It is chatbot it will help you immediate queries');
            // } elseif ($message == 'thanks') {
            //     $botman->reply('welcome');
            //     $botman->reply('bye 👋');
            // }
            // else {
            //     $botman->reply("type 'hi or hello' for testing");
            // }

        });
        $botman->listen();
    }

    /**
     * Place your BotMan logic here.
     */
    public function askName($botman, $message)
    {
        $ans = '';
        $ques = '';
        if ($message == 'hi' || $message == 'hello') {
            $ques = 'Hello! What is your Name?';
            $ans = 'Nice to meet you ';
        } elseif ($message == 'How are you' || $message == 'how are you') {
            $ques = 'How are you?';
        } elseif ($message == 'fine') {
            $ques = 'How can i help you?';
        }
        $botman->ask($ques, function (Answer $answer) use ($ans, $ques) {
            $name = $answer->getText();
            if ($ques == 'Hello! What is your Name?') {
                $this->say($ans . $name . '😊');
            }
        });
    }
}
