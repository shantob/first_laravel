<?php

namespace App\Http\Controllers\Forntend;
// notification user
use App\Models\User;

use App\Models\Blog;
use App\Models\Comment;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// for Notification
use App\Notifications\CommentNotification;


class CommentController extends Controller
{
    public function store(Request $request)
    {
        $comment = new Comment;
        $comment->name = $request->name;
        $comment->email = $request->email;
        $comment->comment = $request->comment;
        $comment->blog_id = $request->blog_id;
        $comment->save();

        $blog =Blog::findOrFail(intval($request->blog_id));
// notification
        $users = User::all();
        foreach ($users as $user);{
            $user->notify(new CommentNotification($comment));
        }

        return redirect()->route('blog.show', $blog->slug)->with('success','Thank you For Comment!!! ');
    }
}
