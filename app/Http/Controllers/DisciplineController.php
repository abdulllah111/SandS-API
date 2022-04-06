<?php

namespace App\Http\Controllers;

use App\Models\Discipline;
use Illuminate\Http\Request;

class DisciplineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        return response()->json(Discipline::all());
        //
    }
    
    public function getone($id, Request $request){
        return response()->json(Discipline::findOrFail($id));
    }
    public function getForName(Request $request){
        $a = Discipline::where('discipline_name', $request->discipline_name)->first();
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
        try {
            $discipline = new Discipline();
            $discipline->discipline_name = $request->discipline_name;
            if ($discipline->save()) {
                return response()->json($discipline);
            }
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message'=>$e->getMessage()]);
        }
    }

    

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Discipline  $discipline
     * @return \Illuminate\Http\Response
     */
    public function show(Discipline $discipline)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Discipline  $discipline
     * @return \Illuminate\Http\Response
     */
    public function edit(Discipline $discipline)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Discipline  $discipline
     * @return \Illuminate\Http\Response
     */
    
    public function update($id ,Request $request)
    {
        try {
            $discipline = Discipline::findOrFail($id);
            $discipline->update($request->all());
            if ($discipline->save()) {
                return response()->json(['status' => 'succes', 'message'=>'Discipline updated']);
            }
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message'=>$e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Discipline  $discipline
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $model = Discipline::findOrFail($id);
            if ($model->delete()) {
                return response()->json(['status' => 'succes', 'message'=>'deleted']);
            }
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message'=>$e->getMessage()]);
        }
    }
}
