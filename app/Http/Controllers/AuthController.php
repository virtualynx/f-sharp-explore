<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
 
class AuthController extends Controller
{
    public function index(){
        $data = array();

    	return view('home')->with('data', $data);
    }

    public function login(){
        $data = array();

    	return view('login')->with('data', $data);
    }

    public function register(){
        $data = array();

    	return view('register')->with('data', $data);
    }
}