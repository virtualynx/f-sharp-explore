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

	<style>
		.opacity70 {
			opacity: 70%;
		}

		.loading {
			font-family: "Arial Black", "Arial Bold", Gadget, sans-serif;
			text-transform:uppercase;
			
			width:150px;
			text-align:center;
			line-height:50px;
			
			position:fixed;
			left:0;right:0;top:50%;
			margin:auto;
			transform:translateY(-50%);
		}

		.loading span {
			position:relative;
			z-index:999;
			color:#fff;
		}

		.loading:before {
			content:'';
			background:#61bdb6;
			width:128px;
			height:36px;
			display:block;
			position:absolute;
			top:0;left:0;right:0;bottom:0;
			margin:auto;
			
			animation:2s loadingBefore infinite ease-in-out;
		}

		@keyframes loadingBefore {
			0%   {transform:translateX(-14px);}
			50%  {transform:translateX(14px);}
			100% {transform:translateX(-14px);}
		}

		.loading:after {
			content:'';
			background:#ff3600;
			width:14px;
			height:60px;
			display:block;
			position:absolute;
			top:0;left:0;right:0;bottom:0;
			margin:auto;
			opacity:.5;
			
			animation:2s loadingAfter infinite ease-in-out;
		}

		@keyframes loadingAfter {
			0%   {transform:translateX(-50px);}
			50%  {transform:translateX(50px);}
			100% {transform:translateX(-50px);}
		}
	</style>
	
    @yield('page-head')
</head>
<body>
	<!-- Preloader -->
	<div class="preloader-it opacity70">
		{{-- <div class="la-anim-1"></div> --}}
		<div class="loading">
			<span>Loading</span>
		</div>
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

    @yield('page-footer')
</body>
</html>