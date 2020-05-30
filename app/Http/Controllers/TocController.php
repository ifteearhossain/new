<?php

namespace App\Http\Controllers;

use App\Http\Requests\TocRequests\TocFormRequests;
use App\Toc;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TocController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('verified');
        $this->middleware('checkroletoc');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tocs = Toc::latest()->paginate(10);
        return view('backend.terms.index', compact('tocs'));
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
    public function store(TocFormRequests $request)
    {
        Toc::insert($request->except('_token') + ['created_at' => Carbon::now()]);
        return back()->withSuccess('Terms and Condition added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Toc  $toc
     * @return \Illuminate\Http\Response
     */
    public function show(Toc $toc)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Toc  $toc
     * @return \Illuminate\Http\Response
     */
    public function edit(Toc $toc)
    {
        return view('backend.terms.edit', compact('toc'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Toc  $toc
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Toc $toc)
    {
        $toc->toc_heading = $request->toc_heading;
        $toc->toc_details = $request->toc_details; 
        $toc->save();
        return redirect('/toc')->withSuccess('Terms updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Toc  $toc
     * @return \Illuminate\Http\Response
     */
    public function destroy(Toc $toc)
    {
        $toc->delete();
        return back()->withSuccess('Terms deleted');
    }
}
