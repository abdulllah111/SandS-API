<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Teacher::all());
        //
    }
    public function getone($id, Request $request){
        return response()->json(Teacher::findOrFail($id));
    }
    public function getForName(Request $request){
        $a = Teacher::where('name', $request->name)->first();
        return response()->json($a);
    }
    
     public function login(Request $request){
        $a = Teacher::where('login', $request->login)->where('password', $request->password)->first();
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
            $model = new Teacher();
            $model->name = $request->name;
            $model->login = $request->login;
            $model->password = $request->password;
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
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function show(Teacher $teacher)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function edit(Teacher $teacher)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function update($id ,Request $request)
    {
        try {
            $model = Teacher::findOrFail($id);
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
            $model = Teacher::findOrFail($id);
            if ($model->delete()) {
                return response()->json(['status' => 'succes', 'message'=>'deleted']);
            }
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message'=>$e->getMessage()]);
        }
    }
}
