<?php

namespace App\Http\Controllers;

use App\Models\Push;
use Illuminate\Http\Request;

class PushController extends Controller
{
    
    public function index()
    {
        return response()->json(Push::all());
        //
    }
    public function getone($id, Request $request){
        return response()->json(Push::findOrFail($id));
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
            $model = Push::where('idteacher', $request->idteacher)->first();
            if($model == null){
                $model = new Push();
                $model->idteacher = $request->idteacher;
            $model->token = $request->token;
                if ($model->save()) {
                    return response()->json($model);
                }
            }
            else{
               $model->update($request->all());
                if ($model->update()) {
                    return response()->json($model);
                }
            }
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message'=>$e->getMessage()]);
        }
    }

    
    public function update($id ,Request $request)
    {
        try {
            $model = Push::findOrFail($id);
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
            $model = Push::findOrFail($id);
            if ($model->delete()) {
                return response()->json(['status' => 'succes', 'message'=>'deleted']);
            }
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message'=>$e->getMessage()]);
        }
    }
}
