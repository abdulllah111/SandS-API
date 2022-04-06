<?php

namespace App\Http\Controllers;

use App\Models\Weekday;
use Illuminate\Http\Request;

class WeekdayController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Weekday::all());
        //
    }
    public function getone($id, Request $request){
        return response()->json(Weekday::findOrFail($id));
    }
    
    public function getForName(Request $request){
        $a = Weekday::where('weekday_name', $request->weekday_name)->first();
        return response()->json($a);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Weekday  $weekday
     * @return \Illuminate\Http\Response
     */
    public function show(Weekday $weekday)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Weekday  $weekday
     * @return \Illuminate\Http\Response
     */
    public function edit(Weekday $weekday)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Weekday  $weekday
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Weekday $weekday)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Weekday  $weekday
     * @return \Illuminate\Http\Response
     */
    public function destroy(Weekday $weekday)
    {
        //
    }
}
