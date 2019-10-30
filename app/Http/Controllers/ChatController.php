<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use App\Events\MessageSent;

class ChatController extends Controller
{   
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function get()
    {   
         // get all users except the authenticated one
        $contacts = User::where('id', '!=', auth()->id())->get();
        // get a collection of items where sender_id is the user who sent us a message
        // and messages_count is the number of unread messages we have from him
        
        return response()->json($contacts);
    }

    public function index()
    {
    	return view('chat');
    }

    public function getMessage($id)
    {
        // mark all messages with the selected contact as read
        Message::where('from', $id)->where('to', auth()->id())->update(['read' => true]);
        // get all messages between the authenticated user and the selected user
        $messages = Message::where(function($find) use ($id) {
            $find->where('from', auth()->id());
            $find->where('to', $id);
        })->orWhere(function($find) use ($id) {
            $find->where('from', $id);
            $find->where('to', auth()->id());
        })
        ->get();
        return response()->json($messages);
    }

    public function send(Request $request)
    {   
        $message = new Message;

        $message->from = Auth::user()->id;
        $message->to = $request->contact_id;
        $message->text = $request->text;

        $message->save();

        broadcast(new MessageSent($message));
        return response()->json($message);
    }

}
