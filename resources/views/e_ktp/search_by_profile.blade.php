@extends('_template_authorized')

@section('page-title')
  Search By Profile
@endsection

@section('page-head')
	{{-- <link href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap5.min.css" rel="stylesheet"> --}}
	{{-- <link rel="stylesheet" type="text/css" href="{{ asset('css/e_ktp/search_by_profile.css') }}"> --}}
@endsection

@section('page-content')
    <!-- Search bar -->
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default card-view">
                <div class="panel-wrapper collapse in">
                    <div class="panel-body mb-20">
                        <div class="row">
							<form id="search_by_profile" name="search_by_profile" method="POST" action="{{ url('api/e-ktp/search-by-nik') }}">
                                {{ csrf_field() }}
								<div class="col-sm-4 p-0 m-0">
									<div class="form-group">
										<label for="fullname" class="txt-dark weight-500">Nama Lengkap</label>
										<input type="text" class="form-control" id="fullname" name="fullname" placeholder="Ketik nama lengkap">
									</div>
									<div class="form-group">
										<label for="fullname-mother" class="txt-dark weight-500">Nama Lengkap Ibu</label>
										<input type="text" class="form-control" id="fullname-mother" name="fullname-mother" placeholder="Ketik nama lengkap ibu">
									</div>
								</div>
								<div class="col-sm-4 p-0 m-0">
									<div class="form-group">
										<label for="date-of-birth" class="txt-dark weight-500">Tanggal Lahir</label>
										<input type="date" class="form-control" id="date-of-birth" name="date-of-birth" placeholder="Pilih tanggal lahir">
									</div>
									<div class="form-group">
										<label for="fullname-father" class="txt-dark weight-500">Nama Lengkap Ayah</label>
										<input type="text" class="form-control" id="fullname-father" name="fullname-father" placeholder="Ketik nama lengkap ayah">
									</div>
								</div>
								<div class="col-sm-4 p-0 m-0">
									<div class="form-group">
										<label for="place-of-birth" class="txt-dark weight-500">Tempat Lahir</label>
										<input type="text" class="form-control" id="place-of-birth" name="place-of-birth" placeholder="Ketik tempat lahir">
									</div>
									<div class="form-group">
										<label for="address" class="txt-dark weight-500">Alamat</label>
										<input type="text" class="form-control" id="address" name="address" placeholder="Ketik alamat">
									</div>
								</div>
								<div class="col-sm-12 p-0 m-0">
									<span class="input-group-btn">
										<button type="submit" class="btn btn-danger btn-icon left-icon"><i class="fa fa-search"></i> <span class="btn-text"> Search</span></button>
									</span>
								</div>
							</form>
                        </div>
                    </div>
                </div>
            </div>			
        </div>	
    </div>

    <!-- Response Search -->
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-info card-view panel-refresh red-border">
                <div class="refresh-container">
                    <div class="la-anim-1"></div>
                </div>
                <div class="panel-heading">
                    <div class="pull-left">
                        <h6 class="panel-title txt-dark">Data Dukcapil</h6>
                    </div>
                    <div class="pull-right">
                        <a href="#" class="pull-left inline-block refresh mr-15">
                            <i class="zmdi zmdi-replay"></i>
                        </a>
                        <a href="#" class="pull-left inline-block full-screen mr-15">
                            <i class="zmdi zmdi-fullscreen"></i>
                        </a>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-wrapper collapse in">
                    <div class="panel-body pt-5">
                        <div class="row mb-50">
							<div class="table-responsive">
								<table name="table-search-by-profile" class="table table-hover display dataTable" width="100%">
									<thead>
										<tr>
											<th>Action</th>
											<th>Nama Lengkap</th>
											<th>Tanggal Lahir</th>
											<th>Tempat Lahir</th>
											<th>NIK</th>
											<th>NKK</th>
											<th>Agama</th>
											<th>Jenis Kelamin</th>
											<th>Pekerjaan</th>
											<th>Status Kawin</th>
										</tr>
									</thead>
									<tbody>
									</tbody>
								</table>
							</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('page-footer')
	{{-- <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script> --}}

    <script>
		const form_id = '#search_by_profile';
        let table_profile = $('[name="table-search-by-profile"]').DataTable({
			processing: true,
			serverSide: true,
			searching: false,
			scrollX: true,
			ordering: false,
			ajax: {
				url: "{{ url('e-ktp/search-by-profile') }}",
				data: function (d) {
					d.fullname = $(form_id + ' #fullname').val(),
					d.fullname_mother = $(form_id + ' #fullname-mother').val(),
					d.dob = $(form_id + ' #date-of-birth').val(),
					d.fullname_father = $(form_id + ' #fullname-father').val(),
					d.pob = $(form_id + ' #place-of-birth').val(),
					d.address = $(form_id + ' #address').val(),
					d.search = $('input[type="search"]').val()
				}
			},
			columns: [
				{data: 'action', name: 'action', orderable: false, searchable: false},
				{data: 'name', name: 'name'},
				{data: 'dob', name: 'dob'},
				{data: 'pob', name: 'pob'},
				{data: 'nik', name: 'nik'},
				{data: 'nkk', name: 'nkk'},
				{data: 'religion', name: 'religion'},
				{data: 'gender', name: 'gender'},
				{data: 'occupation', name: 'occupation'},
				{data: 'marital', name: 'marital'}
			]
		});

		$('#search_by_profile').on('submit', function(e) {
			e.preventDefault();
			table_profile.draw();
		});
    </script>
@endsection