<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Events\ChatEvent;

class ChatController extends Controller
{

    public function welcome()
    {
        return view('welcome');
    }

    public function chat()
    {
        return view('chat');
    }

    public function send(Request $request)
    {
        $user = User::find(Auth::id());
        event(new ChatEvent($request->message,$user->name));
        return $request->all();
    }
}
