@extends('_template_authorized')

@section('page-title')
  Search By Profile
@endsection

@section('page-head')
	{{-- <link href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap5.min.css" rel="stylesheet"> --}}
	{{-- <link rel="stylesheet" type="text/css" href="{{ asset('css/e_ktp/search_by_profile.css') }}"> --}}
	<!-- Bootstrap Datetimepicker CSS -->
	<link href="{{asset('vendors/bower_components/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css')}}" rel="stylesheet" type="text/css"/>
	<link href="{{ url('/dist/css/custom-style.css') }}" rel="stylesheet">
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
										{{-- <input type="date" class="form-control" id="date-of-birth" name="date-of-birth" placeholder="Pilih tanggal lahir"> --}}
										<div class="input-group date" id="datetimepicker-onlydate">
											<input type='text' class="form-control" id="date-of-birth" name="date-of-birth" placeholder="Pilih tanggal lahir" />
											<span class="input-group-addon">
												<span class="fa fa-calendar"></span>
											</span>
										</div>
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
							<div class="col-md-12">
                                <div class="table-wrap table-search-by-profile-wrap">
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
        </div>
    </div>
	@include('e_ktp.profile-detail') 
@endsection

@section('page-footer')
	{{-- <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script> --}}
	<!-- Bootstrap Datetimepicker JavaScript -->
	<script type="text/javascript" src="{{asset('vendors/bower_components/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js')}}"></script>

    <script>

		$('#datetimepicker-onlydate').datetimepicker({
			useCurrent: true,
			format: 'MM-DD-YYYY',
			icons: {
					time: "fa fa-clock-o",
					date: "fa fa-calendar",
					up: "fa fa-arrow-up",
					down: "fa fa-arrow-down"
				},
		});

		const form_id = '#search_by_profile';
        let tableProfile = $('[name="table-search-by-profile"]').DataTable({
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
				{
					class: 'dt-control',
					orderable: false,
					data: null,
					defaultContent: ''
				},
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
			tableProfile.draw();
		});

		function formatDataDetail(d) {
			const pob_dob = (d.pob != null) ? ( d.pob  + ', ' + d.dob ) : d.dob;

			let el_profile_detail = $('.profile-detail-master .profile-detail').clone();
			el_profile_detail.find('[name="td-nik"]').text(d.nik);
			el_profile_detail.find('[name="td-name"]').text(d.name);
			el_profile_detail.find('[name="td-ttl"]').text(pob_dob);
			el_profile_detail.find('[name="td-sex"]').text(d.gender);
			el_profile_detail.find('[name="td-religion"]').text(d.religion);
			el_profile_detail.find('[name="td-address"]').text(d.address);
			el_profile_detail.find('[name="td-nkk"]').text(d.nkk);
			el_profile_detail.find('[name="td-father"]').text(d.father);
			el_profile_detail.find('[name="td-mother"]').text(d.mother);
			el_profile_detail.find('[name="td-marital"]').text(d.marital);
			el_profile_detail.find('[name="td-job"]').text(d.occupation);
			el_profile_detail.find('[name="td-lastedu"]').text(d.education);
			el_profile_detail.find('[name="td-bloodtype"]').text(d.blood_type);

			// replace photo profile
			if (d.photo_path != null) {
				el_profile_detail.find('[name="photo"]').attr('src', d.photo_path);
			}

			return el_profile_detail;
		}


		// Array to track the ids of the details displayed rows
		const detailRows = [];

		tableProfile.on('click', 'tbody td', function () {
			let tr = event.target.closest('tr');
			let row = tableProfile.row(tr);
			let idx = detailRows.indexOf(tr.id);
		
			if (row.child.isShown()) {
				tr.classList.remove('details');
				row.child.hide();
		
				// Remove from the 'open' array
				detailRows.splice(idx, 1);
			}
			else {
				tr.classList.add('details');
				row.child( formatDataDetail( row.data() ) ).show();
		
				// Add to the 'open' array
				if (idx === -1) {
					detailRows.push(tr.id);
				}
			}
		});

		tableProfile.on('draw', () => {
			detailRows.forEach((id, i) => {
				let el = document.querySelector('#' + id + ' td.dt-control');
		
				if (el) {
					el.dispatchEvent(new Event('click', { bubbles: true }));
				}
			});
		});
    </script>
@endsection