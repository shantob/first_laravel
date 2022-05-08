<?php

namespace App\Http\Controllers\Forntend;
use App\Models\Blog;
use App\Models\Comment;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BlogController extends Controller
{
  public function index()
  {
    $blogs = Blog::orderBy('id', 'DESC')->paginate(2);

    return view('forntend.blog.index',compact('blogs'));
}

public function show($slug)
{
  $blog = Blog::where('slug', $slug)->firstOrFail();


  $comments = Comment::with('child.user')->where('blog_id',$blog->id)->where('p_id', 0)->get();

    return view('forntend.blog.show',compact('blog','comments'));
}
}
