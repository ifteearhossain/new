<?php

namespace App\Http\Controllers;

use App\About;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Requests\AboutRequest\AboutFormRequests;
use Image;

class AboutController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('verified');
        $this->middleware('checkroleabout');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $abouts = About::all();
       return view('backend.about.index', compact('abouts'));
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
    public function store(AboutFormRequests $request)
    {
        $about = About::create([
            'about_banner'            => 'dummy',
            'about_short_description' => $request->about_short_description,
            'about_long_description'  => $request->about_long_description,
            'created_at'              => Carbon::now(),
        ]);
        $uploaded_file = $request->file('about_banner');
        $file_name = $about->id. '.' .$uploaded_file->extension('about_banner');
        $location = public_path('uploads/about/'. $file_name);
        Image::make($uploaded_file)->resize(1920, 635)->save($location);

        About::findOrFail($about->id)->update([
            'about_banner'  => $file_name
          ]);

          return back()->withSuccess('About Information Added');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\About  $about
     * @return \Illuminate\Http\Response
     */
    public function show(About $about)
    {
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\About  $about
     * @return \Illuminate\Http\Response
     */
    public function edit(About $about)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\About  $about
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, About $about)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\About  $about
     * @return \Illuminate\Http\Response
     */
    public function destroy(About $about)
    {
       $location = public_path('uploads/about/' . $about->about_banner);
       unlink($location);
       $about->delete();
       return back()->withSuccess('About Deleted');
    }
}
