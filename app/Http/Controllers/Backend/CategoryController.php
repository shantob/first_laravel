<?php

namespace App\Http\Controllers\Backend;

use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::orderBy('id','DESC')->get();
        return view('backend.category.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // genetete slug
        $slug = $this->generateSlug($request->name);

        // create category
        $category = new Category;
        $category->name = $request->name;
        $category->slug = $slug;

        $category->save();

        return redirect()->route('admin.category.index')->with('success','New category is added successfullyy!!');

    }
    public function generateSlug($name)
    {
        $category = Category::where('name',$name)->get();
        if($category->count()>0){
            $count=$category->count();
            $slug = Str::slug($name).'-'.$count;
        }else{
            $slug = Str::slug($name);
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
        $category = Category::findOrFail(intval($id));
        return view('backend.category.edit', compact('category'));
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
        $category = Category::findOrFail(intval($id));
        if ($category->name != $request->name) {
            $slug = $this->generateSlug($request->name);
        }else{
            $slug = $category->slug;
        }

        $category->name = $request->name;
        $category->slug = $slug;

        $category->save();

        return redirect()->route('admin.category.index')->with('success','Category has been updated successfully!!');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::findOrFail(intval($id));

        $category->delete();


        return redirect()->route('admin.category.index')->with('success','This category is deleted successfully!!!');
    }
}
