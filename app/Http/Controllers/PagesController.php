<?php

namespace App\Http\Controllers;

use App\Message;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PagesController extends Controller
{

    public function login(){
        $emails = User::all('email')->take(4);
        return view('auth.login')->with('emails',$emails);
    }
    public function home(){
        return view('home');
    }
    public function users(){
        $user = User::all('id','name');
        return view('chat.users')->with('users',$user);
    }
    public function chat($id){

        if(!($user = User::where('id','=',$id)->first())){
            abort(404);
        }

        $collection = Message::where('sender_id','=',Auth::id())->where('receiver_id','=',$id)->get();
        $received = Message::where('sender_id','=',$id)->where('receiver_id','=',Auth::id())->get();
        $collection = $collection->merge($received);
        $collection = $collection->sortBy('id');

        return view('chat.chat')->with([
            'user' => $user,
            'data' => $collection
        ]);
    }

}
