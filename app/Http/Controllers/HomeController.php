<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        //para la verificaion
        //$this->middleware('auth','verified');
    }

    public function index()
    {
        return view('dash.index');
    }
}