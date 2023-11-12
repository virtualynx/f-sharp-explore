<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
 
class TelecommunicationController extends Controller
{
    public function __construct(){
        // $this->middleware('auth');
    }

    public function index(){
        $data = array();

    	return view('home')->with('data', $data);
    }

    public function tracking_number(){
    	return view('telecommunication/tracking_number');
    }
}