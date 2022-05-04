<?php

namespace App\Http\Controllers;

use App\Models\SubTtable;
use Illuminate\Http\Request;
use App\Models\DisciplineGroupTeacher;
use App\Providers\PushServiceProvider;
use App\Models\Push;

class SubTtableController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(SubTtable::all());
        //
    }
    public function getForIdGroupAndDate($id, $date, Request $request)
    {
        $ttt = DisciplineGroupTeacher::where('idgroup',$id)->get();
        $subttables = [];
         foreach($ttt as $t){
             $tt = $t->sub_ttables;
             foreach($tt as $sttable){
                 if($sttable->date == $date){
                     $sttable->weekday;
                     $sttable->lesson;
                     $sttable->office;
                     $sttable->discipline_group_teacher;
                     $sttable->discipline_group_teacher->teacher;
                     $sttable->discipline_group_teacher->discipline;
                     $sttable->discipline_group_teacher->group;
                     array_push($subttables, $sttable);
                 }
             }
             
         }
         return response()->json($subttables);
    }
    public function getone($id, Request $request){
        return response()->json(SubTtable::findOrFail($id));
    }
    public function getfull(){
        $model = SubTtable::all();
        foreach($model as $item){
            $item->discipline_group_teacher;
            $item->weekday;
            $item->lesson;
            $item->office;
            $item->discipline_group_teacher->teacher;
            $item->discipline_group_teacher->discipline;
            $item->discipline_group_teacher->group;
        }
        return response()->json($model);
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
        $dgt = DisciplineGroupTeacher::findOrFail($request->iddisciplinegroupteacher);
        $push_model = Push::where('idteacher', $dgt->idteacher)->first();
        $token = $push_model->token;
        $push = new PushServiceProvider();
        
        $push->SendPush($token);
        try {
            $model = new SubTtable();
            $model->idweekday = $request->idweekday;
            $model->idlesson = $request->idlesson;
            $model->idoffice = $request->idoffice;
            $model->iddisciplinegroupteacher = $request->iddisciplinegroupteacher;
            $model->date = $request->date;
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
     * @param  \App\Models\SubTtable  $subTtable
     * @return \Illuminate\Http\Response
     */
    public function show(SubTtable $subTtable)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SubTtable  $subTtable
     * @return \Illuminate\Http\Response
     */
    public function edit(SubTtable $subTtable)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SubTtable  $subTtable
     * @return \Illuminate\Http\Response
     */
    public function update($id ,Request $request)
    {
        try {
            $model = SubTtable::findOrFail($id);
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
            $model = SubTtable::findOrFail($id);
            if ($model->delete()) {
                return response()->json(['status' => 'succes', 'message'=>'deleted']);
            }
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message'=>$e->getMessage()]);
        }
    }
}
