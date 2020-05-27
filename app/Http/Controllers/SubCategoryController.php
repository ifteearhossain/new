<?php

namespace App\Http\Controllers;

use App\SubCategory;
use Illuminate\Http\Request;
use App\Category;
use  App\Http\Requests\SubCategoryRequests\SubCategoryFormPost;
use Carbon\Carbon;

class SubCategoryController extends Controller
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
      $sub_categories = SubCategory::latest()->paginate(20);
      return view('backend.sub_category.index', compact('sub_categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $categories = Category::all();

      return view('backend.sub_category.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SubCategoryFormPost $request)
    {
      SubCategory::create($request->except('_token') + ['created_at' => Carbon::now()]);
      return back()->withSuccess('Sub category Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function show(SubCategory $subCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(SubCategory $subCategory)
    {
      $categories = Category::all();
      return view('backend.sub_category.create', compact('subCategory', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SubCategory $subCategory)
    {
      $subCategory->sub_category_name = $request->sub_category_name;
      $subCategory->category_id   = $request->category_id;
      $subCategory->save();
      return redirect('sub_category')->withSuccess('Category Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(SubCategory $subCategory)
    {
        $subCategory->delete();
        return back()->withSuccess('Sub category deleted successfully');
    }
}
