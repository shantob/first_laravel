<?php

namespace App\Http\Controllers\Forntend;
use App\Models\Blog;
use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function show($slug)
    {
        $category = Category::where('slug', $slug)->with('blogs')->first();


        $blogs = Blog::orderBy('id', 'DESC')->where('category_id' , $category->id)->paginate(2);

        return view('forntend.blog.index',compact('blogs'));
    }
}
