<?php

namespace App\Http\Controllers;

use App\Models\TimelineAkademik;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TimelineAkademikController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $timelines=TimelineAkademik::all();
        return view('timeline-akademik.index',compact('timelines'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('timeline-akademik.create');
    }

    public function post_media(Request $request)
    {
        $name=date('Ymd').Str::random(7);
        $name.='.'.$request->file('media')->getClientOriginalExtension();
        $request->file('media')->move(public_path('images/media'),$name);
        return asset('images/media/'.$name);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        dd($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TimelineAkademik  $timelineAkademik
     * @return \Illuminate\Http\Response
     */
    public function show(TimelineAkademik $timelineAkademik)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TimelineAkademik  $timelineAkademik
     * @return \Illuminate\Http\Response
     */
    public function edit(TimelineAkademik $timelineAkademik)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TimelineAkademik  $timelineAkademik
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TimelineAkademik $timelineAkademik)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TimelineAkademik  $timelineAkademik
     * @return \Illuminate\Http\Response
     */
    public function destroy(TimelineAkademik $timelineAkademik)
    {
        //
    }
}
