<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
 
class WebtoolsController extends _Controller
{
    public function __construct(){
        // $this->middleware('auth');
    }

    public function index(){
        $data = array();

    	return view('tools/webtools')->with('data', $data);
    }
}