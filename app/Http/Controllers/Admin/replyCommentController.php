<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Comment;
use App\replyComment;

class replyCommentController extends Controller
{
    public function replyThreadComment(Request $request, Comment $comment)
    {
        $request->validate([
            'content' => 'required|min:20',
        ]);

        $reply = new replyComment;
        $reply->content = $request->content;
        $reply->user_id = auth()->user()->id;

        $comment->reply_thread_comments()->save($reply);

        return back()->withInfo('Komentar balasan telah berhasil terkirim');
    }
}
