<?php

namespace App\Http\Controllers;

use App\Models\Ttable;
use App\Models\SubTtable;
use App\Models\Group;
use App\Models\DisciplineGroupTeacher;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class TtableController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Ttable::all());
        //
    }
    public function getone($id, Request $request){
        return response()->json(Ttable::findOrFail($id));
    }
    public function getfull(){
        $model = Ttable::all();
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
    public function getForIdGroupWeekday($id, $weekday, Request $request)
    {
        $ttt = DisciplineGroupTeacher::where('idgroup',$id)->get();
        $ttables = [];
         foreach($ttt as $t){
             $tt = $t->ttables;
             foreach($tt as $ttable){
                 if($ttable->idweekday == $weekday){
                     $ttable->weekday;
                     $ttable->lesson;
                     $ttable->office;
                     $ttable->discipline_group_teacher;
                     $ttable->discipline_group_teacher->teacher;
                     $ttable->discipline_group_teacher->discipline;
                     $ttable->discipline_group_teacher->group;
                     array_push($ttables, $ttable);
                 }
             }
             
         }
         return response()->json($ttables);
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
            $model = new Ttable();
            $model->idweekday = $request->idweekday;
            $model->idlesson = $request->idlesson;
            $model->idoffice = $request->idoffice;
            $model->iddisciplinegroupteacher = $request->iddisciplinegroupteacher;
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
     * @param  \App\Models\Ttable  $ttable
     * @return \Illuminate\Http\Response
     */
    public function show(Ttable $ttable)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ttable  $ttable
     * @return \Illuminate\Http\Response
     */
    public function edit(Ttable $ttable)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ttable  $ttable
     * @return \Illuminate\Http\Response
     */
    public function update($id ,Request $request)
    {
        try {
            $model = Ttable::findOrFail($id);
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
            $model = Ttable::findOrFail($id);
            if ($model->delete()) {
                return response()->json(['status' => 'succes', 'message'=>'deleted']);
            }
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message'=>$e->getMessage()]);
        }
    }
    public function deleteAll($id, Request $request){
        $model = Ttable::all();
        $ttables = [];
        $subttables = [];
        $dgts = [];
        $groups = [];
        $disciplines = [];
        $teachers = [];
        $colvo = 0;
        foreach($model as $ttable){
            if($ttable->discipline_group_teacher->group->department->iddepartment == $id){
                array_push($ttables, $ttable);
            }
        }
        $model = SubTtable::all();
        foreach($model as $subttable){
            if($subttable->discipline_group_teacher->group->department->iddepartment == $id){
                array_push($subttables, $subttable);
            }
        }
        // $model = DisciplineGroupTeacher::all();
        // foreach($model as $dgt){
        //     if($dgt->group->department->iddepartment == $id){
        //         array_push($dgts, $dgt);
        //         array_push($groups, $dgt->group);
        //         array_push($disciplines, $dgt->discipline);
        //         array_push($teachers, $dgt->teacher);
        //     } 
        // }
        foreach($ttables as $m){
            $m->delete();
            $colvo++;
         }
        foreach($subttables as $m){
            $m->delete();
            $colvo++;
        }
        // foreach($dgts as $m){
        //     $m->delete();$colvo++;
        // }
        // foreach($groups as $m){
        //     $m->delete();$colvo++;
        // }
        // foreach($disciplines as $m){
        //     $m->delete();$colvo++;
        // }
        // foreach($teachers as $m){
        //     $m->delete();$colvo++;
        // }
        return response()->json(['status' => 'succes', 'message'=>"deleted $colvo"]);
        // $groups = Group::all();
        // foreach($groups as $group){

        // }

        // return response()->json(['status' => 'succes', 'message'=>"deleted $colvo"]);
        // $model->discipline_group_teacher;
        // $model->discipline_group_teacher->group->department->where('iddepartment', $id)->get();
        
        // $colvo = DB::delete("DELETE FROM ttable WHERE idttable IN(
        //     SELECT `ttable`.idttable FROM `ttable`, `discipline-group-teacher`, `group`, `department`
        //     WHERE `ttable`.iddisciplinegroupteacher = `discipline-group-teacher`.`iddiscipline-group-teacher`
        //     AND `discipline-group-teacher`.idgroup = `group`.idgroup AND `group`.iddepartment = $id)");
        //     if ($colvo > 0){
        //         return response()->json(['status' => 'succes', 'message'=>"deleted $colvo"]);
        //     }
    }
}
