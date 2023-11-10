<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	{{-- <title>F# Xplore</title> --}}
    <title>{{ config('app.name') }} | @yield('page-title', '')</title>
	<meta name="description" content="F# Xplore is a Dashboard & Admin Site Responsive Template." />
	<meta name="keywords" content="admin, admin dashboard, admin template, cms, crm, responsive admin, sass, panel, software, ui, visualization, web app, application" />
	<meta name="author" content="F#XploreTeam2023"/>
	
	<!-- Favicon -->
	<link rel="shortcut icon" href="favicon.ico">
	<link rel="icon" href="favicon.ico" type="image/x-icon">
	
	<!-- Data table CSS -->
	<link href="{{asset('vendors/bower_components/datatables/media/css/jquery.dataTables.min.css')}}" rel="stylesheet" type="text/css"/>
	<link href="{{asset('vendors/bower_components/jquery-toast-plugin/dist/jquery.toast.min.css')}}" rel="stylesheet" type="text/css">
		
	<!-- Custom CSS -->
	<link href="{{asset('dist/css/style.css')}}" rel="stylesheet" type="text/css">
	
    @yield('page-head')
</head>
<body>
	<!-- Preloader -->
	<div class="preloader-it">
		<div class="la-anim-1"></div>
	</div>
	<!-- /Preloader -->

    @yield('page-template')

	<!-- JavaScript -->
	
    <!-- jQuery -->
    <script src="{{asset('vendors/bower_components/jquery/dist/jquery.min.js')}}"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="{{asset('vendors/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
    
	<!-- Data table JavaScript -->
	<script src="{{asset('vendors/bower_components/datatables/media/js/jquery.dataTables.min.js')}}"></script>
	
	<!-- Slimscroll JavaScript -->
	<script src="{{asset('dist/js/jquery.slimscroll.js')}}"></script>
	
	<!-- Progressbar Animation JavaScript -->
	<script src="{{asset('vendors/bower_components/waypoints/lib/jquery.waypoints.min.js')}}"></script>
	<script src="{{asset('vendors/bower_components/jquery.counterup/jquery.counterup.min.js')}}"></script>
	
	<!-- Fancy Dropdown JS -->
	<script src="{{asset('dist/js/dropdown-bootstrap-extended.js')}}"></script>
	
	<!-- Sparkline JavaScript -->
	<script src="{{asset('vendors/jquery.sparkline/dist/jquery.sparkline.min.js')}}"></script>
	
	<!-- Switchery JavaScript -->
	<script src="{{asset('vendors/bower_components/switchery/dist/switchery.min.js')}}"></script>
	
	<!-- EChartJS JavaScript -->
	<script src="{{asset('vendors/bower_components/echarts/dist/echarts-en.min.js')}}"></script>
	<script src="{{asset('vendors/echarts-liquidfill.min.js')}}"></script>
	
	<!-- Toast JavaScript -->
	<script src="{{asset('vendors/bower_components/jquery-toast-plugin/dist/jquery.toast.min.js')}}"></script>
	
	<!-- Init JavaScript -->
	<script src="{{asset('dist/js/init.js')}}"></script>
	<script src="{{asset('dist/js/dashboard-data.js')}}"></script>
</body>
</html>