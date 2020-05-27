<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Requests\CategoryRequests\CategoryFormPost;
use App\Http\Requests\CategoryRequests\CategoryUpdateRequest;
use Auth;
use Carbon\Carbon;
use Image;

class CategoryController extends Controller
{
    public function __construct()
    {
      $this->middleware('auth');
      $this->middleware('verified');
      $this->middleware('checkrolecategory');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       // $categories = Category::where('added_by', '!=', Auth::id())->paginate(20); // Except Loggedin user
       // $categorybysellers = Category::where('added_by', Auth::id())->get();  // Sort by user
       $categories = Category::latest()->paginate(20);
       return view('backend.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryFormPost $request)
    {
        $lastId =  Category::insertGetId([
          'category_name'   => $request->category_name,
          'category_image'  => 'dummy.jpg',
          'added_by'        => Auth::id(),
          'created_at'      => Carbon::now(),
       ]);

       $uploaded_image = $request->file('category_image');
       $filename = $lastId. '.' .$uploaded_image->getClientOriginalExtension('category_image');
       $location = public_path('uploads/category/'. $filename);
       Image::make($uploaded_image)->resize(134, 134)->save($location, 100);

       Category::findOrFail($lastId)->update([
         'category_image'  => $filename
       ]);

       return back()->withSuccess('Category Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {

        return view('backend.category.create')->with('category', $category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryUpdateRequest $request, Category $category)
    {
       if($request->hasFile('category_image'))
       {
         $existing_image = public_path('uploads/category/'.$category->category_image );
         unlink($existing_image);
         $uploaded_image = $request->file('category_image');
         $filename = $category->id. '.' .$uploaded_image->extension('category_image');
         $location = public_path('uploads/category/' . $filename);
         Image::make($uploaded_image)->resize(134, 134)->save($location, 100);
         $category->category_image = $filename;
       }

       $category->category_name  = $request->category_name;
       $category->save();
       return redirect('category')->withSuccess('Category Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
      if($category->getSubCategory->count() > 0)
      {
        $count = $category->getSubCategory->count();
        return redirect('category')->withFailed('This category is associated with ' . $count . " sub categories.Please remove the sub categories and try again. Thank you" );
      }
      else
      {
        $category->delete();
        return redirect('category')->withSuccess('Category Deleted Successfully');
      }

    }
}
