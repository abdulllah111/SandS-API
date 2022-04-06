<?php

namespace App\Http\Controllers;

use App\Models\DisciplineGroupTeacher;
use Illuminate\Http\Request;

class DisciplineGroupTeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dgts = DisciplineGroupTeacher::all();
        foreach($dgts as $dgt){
            $dgt->teacher;
            $dgt->discipline;
            $dgt->group;
        }
        return response()->json($dgts);
        //
    }
    public function getone($id, Request $request){
        return response()->json(DisciplineGroupTeacher::findOrFail($id));
    }
    public function getForIdGroup($id,Request $request)
    {
        $model = DisciplineGroupTeacher::where('idgroup',$id)->get();
        $dgts = [];
         foreach($model as $dgt){
            $dgt->teacher;
            $dgt->discipline;
            $dgt->group;
            array_push($dgts, $dgt);
            }
         return response()->json($dgts);
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
            $model = new DisciplineGroupTeacher();
            $model->idteacher = $request->idteacher;
            $model->iddiscipline = $request->iddiscipline;
            $model->idgroup = $request->idgroup;
            if ($model->save()) {
                return response()->json($model);
            }
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message'=>$e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DisciplineGroupTeacher  $disciplineGroupTeacher
     * @return \Illuminate\Http\Response
     */
    public function show(DisciplineGroupTeacher $disciplineGroupTeacher)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DisciplineGroupTeacher  $disciplineGroupTeacher
     * @return \Illuminate\Http\Response
     */
    public function edit(DisciplineGroupTeacher $disciplineGroupTeacher)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DisciplineGroupTeacher  $disciplineGroupTeacher
     * @return \Illuminate\Http\Response
     */
    public function update($id ,Request $request)
    {
        try {
            $model = DisciplineGroupTeacher::findOrFail($id);
            $model->update($request->all());
            if ($model->update()) {
                return response()->json(['status' => 'succes', 'message'=>' updated']);
            }
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message'=>$e->getMessage()]);
        }
    }
    public function destroy($id)
    {
        try {
            $model = DisciplineGroupTeacher::findOrFail($id);
            if ($model->delete()) {
                return response()->json(['status' => 'succes', 'message'=>'deleted']);
            }
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message'=>$e->getMessage()]);
        }
    }
    public function deleteAll(){
        try {
            $model = DisciplineGroupTeacher::all();
            $col = 0;
            foreach($model as $item){
                $item->delete();
                $col++;
            }
            return response()->json(['status' => 'succes', 'message'=>$col]);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message'=>$e->getMessage()]);
        } 
    }
}
