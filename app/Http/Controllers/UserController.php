<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){
        $name = "Dai hoc Can Tho";
        return view('hello', ['name'=>$name]);
    }
}
