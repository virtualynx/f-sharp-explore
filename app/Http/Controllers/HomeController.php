<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
 
class HomeController extends _Controller
{
    public function __construct(){
        // $this->middleware('auth');
    }

    public function index(){
        $data = array();

    	return view('home')->with('data', $data);
    }
}