<?php
 
namespace App\Http\Controllers;

use App\Models\SearchLogDukcapil;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
 
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

	public function search_by_profile(Request $request) {
		if ($request->ajax()) {
			return $this->generate_table_profile($request);
		}

    	return view('e_ktp/search_by_profile');
    }

	private function generate_table_profile(Request $request)
	{
		$query = SearchLogDukcapil::select('*');

		$dataResult = DataTables::of($query)
			->addIndexColumn()
			->addColumn('action', function($row) {
				return '<button type="button" class="btn btn-primary btn-square btn-sm" data-toggle="tooltip" data-placement="right" data-original-title="Lihat Detail"><i class="icon-eye"></i></button>'; 
				// return '<button type="button" class="" title="lihat detail"><i class="fa-solid fa-eye"></i></button>';
			})
			->filter(function ($instance) use ($request) {
				$like_filters = [
					'fullname' => 'name',
					'fullname_mother' => 'mother',
					'fullname_father' => 'father',
					'pob' => 'pob',
					'address' => 'address'
				];

				foreach ($like_filters as $name => $column) {
					if ($request->get($name) != '') {
						$instance->where($column, 'like', '%' . $request->get($name) . '%');
					}
				}

				if ($request->get('dob') != '') {
					$instance->where('dob', $request->get('dob'));
				}
			})
			->rawColumns(['action'])
			->make(true);

		return $dataResult;
	}
}