<?php
 
namespace App\Http\Controllers;

use App\Services\TelecommunicationService;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use \YaLinqo\Enumerable;

class TelecommunicationController extends _Controller
{
    public function __construct(){
        // $this->middleware('auth');
    }

    public function index(){
        $data = array();

    	return view('home')->with('data', $data);
    }

    public function locate_number(){
    	return view('telecommunication/locate_number');
    }

    public function tracking_number(Request $request){
        if ($request->ajax()) {
            
        }

    	return view('telecommunication/tracking_number');
    }

    public function telco_registration(){
    	return view('telecommunication/telco_registration');
    }
}