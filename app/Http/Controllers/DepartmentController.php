<?php

namespace App\Http\Controllers;
use App\Models\Department;
use App\Models\Push;

use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    //

    public function showAllDepartments()
    {
        return response()->json(Department::all());
        // return Response::json(Department::all())->setEncodingOptions(JSON_UNESCAPED_UNICODE | JSON_HEX_AMP);
    }
    public function getOne($id, Request $request){
        
        if (is_numeric($id))
        {
            return response()->json(Department::findOrFail($id));
        }
        else
        {
            $column = 'department_name'; // This is the name of the column you wish to search
            return response()->json(Department::where($column , '=', $id)->first());
        }
    }
    public function getGroups($id, Request $request){
        $model = Department::findOrFail($id)->groups;
        return response()->json($model);
    }
    public function getForName($id, Request $request){
        return response()->json(Department::where('department_name', $id));
    }
    public function store(Request $request)
    {
        
        try {
            $model = new Department();
            $model->department_name = $request->department_name;
            if ($model->save()) {
                return response()->json($model);
            }
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message'=>$e->getMessage()]);
        }
    }
    public function update($id ,Request $request)
    {
        try {
            $model = Department::findOrFail($id);
            $model->update($request->all());
            if ($model->update()) {
                return response()->json(['status' => 'succes', 'message'=>'Discipline updated']);
            }
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message'=>$e->getMessage()]);
        }
    }
    public function destroy($id)
    {
        try {
            $model = Department::findOrFail($id);
            if ($model->delete()) {
                return response()->json(['status' => 'succes', 'message'=>'deleted']);
            }
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message'=>$e->getMessage()]);
        }
    }
    
}
