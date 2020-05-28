<?php

namespace App\Http\Controllers;

use App\Policy;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Requests\PolicyRequests\PolicyFormRequests;

class PolicyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('verified');
        $this->middleware('checkrolepolicy');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $policies = Policy::latest()->paginate(10);
       return view('backend.policy.index', compact('policies'));
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
    public function store(PolicyFormRequests $request)
    {
        Policy::insert($request->except('_token') + ['created_at' => Carbon::now()]);
        return back()->withSuccess('Policy added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Policy  $policy
     * @return \Illuminate\Http\Response
     */
    public function show(Policy $policy)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Policy  $policy
     * @return \Illuminate\Http\Response
     */
    public function edit(Policy $policy)
    {
        return view('backend.policy.edit', compact('policy'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Policy  $policy
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Policy $policy)
    {
        $policy->policy_heading = $request->policy_heading;
        $policy->policy_details = $request->policy_details; 
        $policy->save();
        return redirect('/policies')->withSuccess('Policy updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Policy  $policy
     * @return \Illuminate\Http\Response
     */
    public function destroy(Policy $policy)
    {
        $policy->delete();
        return back()->withSuccess('Policy deleted');
    }
}
