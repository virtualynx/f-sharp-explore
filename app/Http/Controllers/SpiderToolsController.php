<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
 
class SpidertoolsController extends _Controller
{
    public function __construct(){
        // $this->middleware('auth');
    }

    public function index(){
        $data = array();

    	return view('spidertools')->with('data', $data);
    }
}