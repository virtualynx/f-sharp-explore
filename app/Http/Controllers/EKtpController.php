<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
 
class EKtpController extends _Controller
{
    public function index(){
        $data = array();

    	return view('home')->with('data', $data);
    }

    public function search_by_nkk(){
    	return view('e_ktp/search_by_nkk');
    }

    public function search_by_nik(){
    	return view('e_ktp/search_by_nik');
    }
}