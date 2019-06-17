<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EditorController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
        $this->middleware('editor');  //이렇게 하면 editor로 login한 사람만 들어 올수 있다.
        //$this->middleware('editor',['except'=>'test']);//이렇게 하면 admin으로 login한 사람도 들어 올수 있다.
    }

    public function index()
    {
        //return view('admin.editor');
        return view('editor.index');
    }

    public function test()
    {
        return view('admin.test');
    }
}


        