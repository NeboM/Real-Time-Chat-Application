<?php

namespace App\Http\Controllers;

use App\Events\MessageCreated;
use App\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function store(Request $request,$id){
        $request->validate([
            'body' => 'required'
        ]);
        $msg = new Message();
        $msg->sender_id = Auth::id();
        $msg->receiver_id = $id;
        $msg->body = $request->body;
        $msg->save();
        // Fire the event
        broadcast(new MessageCreated($msg))->toOthers();
        return $msg;
    }

    public function getMessages($id){
        // If not authenticated return 403 Forbidden
        if(!auth()->check()){
            abort(403);
        }
        // Get all messages between user with id $id and user with id Auth::id()
        $collection = Message::where('sender_id','=',Auth::id())->where('receiver_id','=',$id)->get();
        $received = Message::where('sender_id','=',$id)->where('receiver_id','=',Auth::id())->get();
        $collection = $collection->merge($received);
        $collection = $collection->sortBy('id')->toArray();
        // Return array values (to prevent javascript from reordering)
        return array_values($collection);
    }
}
