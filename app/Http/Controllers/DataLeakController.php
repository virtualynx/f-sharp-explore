<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
 
class DataLeakController extends _Controller
{
    public function index(){
        $data = array();

    	return view('home')->with('data', $data);
    }

    public function data_leak(){
    	return view('dataleak/data-leak');
    }
}