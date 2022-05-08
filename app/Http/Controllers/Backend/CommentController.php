<?php

namespace App\Http\Controllers\Backend;
use Auth;
use App\Models\Comment;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $comments = Comment::where('p_id', 0)->orderBy('created_at','DESC')->get();
        return view('backend/comment/index',compact('comments'));
    }
    public function show($id)
    {

        $comment =Comment::findOrFail(intval($id));
        $comment->is_read = 1;
        $comment->save();



        return view('backend/comment/show',compact('comment'));

    }
    public function store(Request $request)
    {
        $comment = new Comment;
        $comment->user_id = Auth::user()->id;
        $comment->blog_id = $request->blog_id;
        $comment->p_id = $request->p_id;
        $comment->comment = $request->comment;
        $comment->is_read = 1;

        $comment->save();

        return redirect()->route('admin.comment.show', $request->p_id);
    }
    public function destroy($id)  
    {
        $comment = Comment::findOrFail(intval($id));
        if ($comment->child->count() > 0) {
           foreach($comment->child as $reply){
            $reply->delete();
           }
           $comment->delete();
           return redirect()->route('admin.comment.index')->with('success','Comment has benn Deleted successfully!!');
        }else{
            $p_id = $comment->p_id;
            $comment->delete();
            return redirect()->route('admin.comment.show', $p_id)->with('success','Comment has benn Deleted successfully!!');
        }
    }
}
