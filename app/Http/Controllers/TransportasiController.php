<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
 
class TransportasiController extends Controller
{
    public function index(){
        $data = array();

    	return view('home')->with('data', $data);
    }

    public function cek_kendaraan(){
    	return view('transportasi/cek_kendaraan');
    }
}