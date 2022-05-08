<?php

namespace App\Http\Controllers\Backend;

use File;
use App\Models\Blog;
use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * 
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blogs = Blog::orderBy('id', 'DESC')->paginate(10);
        return view('backend.blog.index', compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::orderBy('name', 'ASC')->get();
        return view('backend.blog.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'blog' => 'required',
            'category_id' => 'required',
            'img_alt' => 'nullable|max:255',
            'meta_description' => 'nullable|max:255|min:120',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'og_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $blog = new Blog;
        $blog->title = $request->title;
        $blog->slug = $this->generateSlug($request->title);
        $blog->blog = $request->blog;
        $blog->category_id = $request->category_id;
        $blog->img_alt = $request->img_alt;
        $blog->meta_description = $request->meta_description;
        $blog->tags = $request->tags;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalName();
            $filename = time().'-blog-'.$extension;
            $file->move('upload/images/', $filename);
            $blog->image = $filename;
        }
        if ($request->hasFile('og_image')) {
            $file = $request->file('og_image');
            $extension = $file->getClientOriginalName();
            $filename = time().'-blog-'.$extension;
            $file->move('upload/images/', $filename);
            $blog->og_image = $filename;
        }
        $blog->save();

        return redirect()->route('admin.blog.index')->with('success', 'New blog is added successfully');
    }

    public function generateSlug($title)
    {
        $blog = Blog::where('title', $title)->get();
        if ($blog->count() > 0) {
            $count = $blog->count();
            $slug = Str::slug($title).'-'.$count;
        }else{
            $slug = Str::slug($title);
        }
        return $slug;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $blog = Blog::findOrFail(intval($id));
        $categories = Category::orderBy('name', 'ASC')->get();
        return view('backend.blog.edit', compact('blog', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'blog' => 'required',
            'category_id' => 'required',
            'img_alt' => 'nullable|max:255',
            'meta_description' => 'nullable|max:255|min:120',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'og_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $blog = Blog::findOrFail(intval($id));
        $blog->title = $request->title;
        $blog->slug = $this->generateSlug($request->title);
        $blog->blog = $request->blog;
        $blog->category_id = $request->category_id;
        $blog->img_alt = $request->img_alt;
        $blog->meta_description = $request->meta_description;
        $blog->tags = $request->tags;

        if ($request->hasFile('image')) {

            $file_path = public_path().'/upload/images/'.$blog->image;

            if (File::exists($file_path)) {
                File::delete($file_path);
            }
            $file = $request->file('image');
            $extension = $file->getClientOriginalName();
            $filename = time().'-blog-'.$extension;
            $file->move('upload/images/', $filename);
            $blog->image = $filename;
        }
        if ($request->hasFile('og_image')) {
            $file = $request->file('og_image');
            $extension = $file->getClientOriginalName();
            $filename = time().'-blog-'.$extension;
            $file->move('upload/images/', $filename);
            $blog->og_image = $filename;
        }

        $blog->save();

        return redirect()->route('admin.blog.index')->with('success', 'Blog has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $blog = Blog::findOrFail(intval($id));
        $file_path = public_path().'/upload/images/'.$blog->image;

        if (File::exists($file_path)) {
            File::delete($file_path);
        }

        $og_file_path = public_path().'/upload/images/'.$blog->og_image;

        if (File::exists($og_file_path)) {
            File::delete($og_file_path);
        }
        $blog->delete();

        return redirect()->route('admin.blog.index')->with('success', 'Blog has been deleted successfully');
    }
}