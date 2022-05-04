<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

class ApiAutorizController extends Controller
{
    public function checkTokenValid()
    {
     return response()->json(['message'=>"Valid"]);
    }
}
