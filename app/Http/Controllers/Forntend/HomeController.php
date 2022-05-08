<?php

namespace App\Http\Controllers\Forntend;
use App\Models\Blog;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $blogs = Blog::orderBy('id','DESC')->take(3)->get();
        return view('forntend.home.index',compact('blogs'));
    }
}
