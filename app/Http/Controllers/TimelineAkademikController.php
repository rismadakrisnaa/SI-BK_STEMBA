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
        $data = $request->except('_token');
        $data['user_id']=auth()->user()->_id;
        TimelineAkademik::create($data);
        return back()->with('alert-success', 'Timeline berhasil dibuat.');
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
        return view('timeline-akademik.edit',compact('timelineAkademik'));
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
        $timelineAkademik->update($request->all());
        return back()->with('alert-success','Timeline berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TimelineAkademik  $timelineAkademik
     * @return \Illuminate\Http\Response
     */
    public function destroy(TimelineAkademik $timelineAkademik)
    {
        $timelineAkademik->delete();
        return back()->with('alert-success', 'Timeline berhasil dihapus.');
    }
}
