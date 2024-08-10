<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\ChatEvent;

class ChatsController extends Controller
{
    
    public function sendmessage(Request $request){
        
        $message = $request->sms;
        // event(new ChatEvent($message));
        broadcast(new ChatEvent($message));

        return response()->json(['status'=>"Message Sent Successfully","message"=>$message]);

    }

}
