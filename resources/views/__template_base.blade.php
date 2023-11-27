<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>{{ config('app.name') }} | @yield('page-title', '')</title>
	<meta name="description" content="F# Xplore is a Dashboard & Admin Site Responsive Template." />
	<meta name="keywords" content="admin, admin dashboard, admin template, cms, crm, responsive admin, sass, panel, software, ui, visualization, web app, application" />
	<meta name="author" content="F#XploreTeam2023"/>
	
	<!-- Favicon -->
	<link rel="apple-touch-icon" sizes="180x180" href="{{asset('dist/favicon/apple-touch-icon.png')}}">
	<link rel="icon" type="image/png" sizes="32x32" href="{{asset('dist/favicon/favicon-32x32.png')}}">
	<link rel="icon" type="image/png" sizes="16x16" href="{{asset('dist/favicon/favicon-16x16.png')}}">
	<link rel="manifest" href="{{asset('dist/favicon/site.webmanifest')}}">
	<link rel="mask-icon" href="{{asset('dist/favicon/safari-pinned-tab.svg')}}" color="#5bbad5">
	<meta name="msapplication-TileColor" content="#da532c">
	<meta name="theme-color" content="#ffffff">
	
	<!-- Data table CSS -->
	<link href="{{asset('vendors/bower_components/datatables/media/css/jquery.dataTables.min.css')}}" rel="stylesheet" type="text/css"/>
	<link href="{{asset('vendors/bower_components/jquery-toast-plugin/dist/jquery.toast.min.css')}}" rel="stylesheet" type="text/css">
	
	{{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet" type="text/css"> --}}

	@yield('page-head')
	
	<!-- Custom CSS -->
	<link href="{{asset('dist/css/style_v_1_0.css')}}" rel="stylesheet" type="text/css">

	<style type="text/css"> 
		.lds-spinner,
		.lds-spinner div,
		.lds-spinner div:after {
			box-sizing: border-box;
		}

		.lds-spinner {
			color: black;
			position: fixed;
			top: 50%;
			left: 50%;
			/* bring your own prefixes */
			transform: translate(-50%, -50%);
			display: inline-block;
			width: 80px;
			height: 80px;
		}

		.lds-spinner div {
			transform-origin: 40px 40px;
			animation: lds-spinner 1.2s linear infinite;
		}

		.lds-spinner div:after {
			content: " ";
			display: block;
			position: absolute;
			top: 3.2px;
			left: 36.8px;
			width: 6.4px;
			height: 17.6px;
			border-radius: 20%;
			background: currentColor;
		}

		.lds-spinner div:nth-child(1) {
			transform: rotate(0deg);
			animation-delay: -1.1s;
		}

		.lds-spinner div:nth-child(2) {
			transform: rotate(30deg);
			animation-delay: -1s;
		}

		.lds-spinner div:nth-child(3) {
			transform: rotate(60deg);
			animation-delay: -0.9s;
		}

		.lds-spinner div:nth-child(4) {
			transform: rotate(90deg);
			animation-delay: -0.8s;
		}

		.lds-spinner div:nth-child(5) {
			transform: rotate(120deg);
			animation-delay: -0.7s;
		}

		.lds-spinner div:nth-child(6) {
			transform: rotate(150deg);
			animation-delay: -0.6s;
		}

		.lds-spinner div:nth-child(7) {
			transform: rotate(180deg);
			animation-delay: -0.5s;
		}

		.lds-spinner div:nth-child(8) {
			transform: rotate(210deg);
			animation-delay: -0.4s;
		}

		.lds-spinner div:nth-child(9) {
			transform: rotate(240deg);
			animation-delay: -0.3s;
		}

		.lds-spinner div:nth-child(10) {
			transform: rotate(270deg);
			animation-delay: -0.2s;
		}

		.lds-spinner div:nth-child(11) {
			transform: rotate(300deg);
			animation-delay: -0.1s;
		}

		.lds-spinner div:nth-child(12) {
			transform: rotate(330deg);
			animation-delay: 0s;
		}

		@keyframes lds-spinner {
			0% {
				opacity: 1;
			}

			100% {
				opacity: 0;
			}
		}
	</style>
</head>
<body>
	<!-- Preloader -->
	<div class="preloader-it opacity-80">
		{{-- <div class="la-anim-1"></div> --}}
		<div class="lds-spinner"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
	</div>
	<!-- /Preloader -->

    @yield('page-template')

	<!-- JavaScript -->
    <script src="{{asset('dist/js/ajax-error-handler.js')}}"></script>
	
    <!-- jQuery -->
    <script src="{{asset('vendors/bower_components/jquery/dist/jquery.min.js')}}"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="{{asset('vendors/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
    
	<!-- Data table JavaScript -->
	<script src="{{asset('vendors/bower_components/datatables/media/js/jquery.dataTables.min.js')}}"></script>
	
	<!-- Slimscroll JavaScript -->
	<script src="{{asset('dist/js/jquery.slimscroll.js')}}"></script>
	
	<!-- Progressbar Animation JavaScript -->
	{{-- <script src="{{asset('vendors/bower_components/waypoints/lib/jquery.waypoints.min.js')}}"></script>
	<script src="{{asset('vendors/bower_components/jquery.counterup/jquery.counterup.min.js')}}"></script> --}}
	
	<!-- Fancy Dropdown JS -->
	{{-- <script src="{{asset('dist/js/dropdown-bootstrap-extended.js')}}"></script> --}}
	
	<!-- Sparkline JavaScript -->
	{{-- <script src="{{asset('vendors/jquery.sparkline/dist/jquery.sparkline.min.js')}}"></script> --}}
	
	<!-- Switchery JavaScript -->
	{{-- <script src="{{asset('vendors/bower_components/switchery/dist/switchery.min.js')}}"></script> --}}
	
	<!-- EChartJS JavaScript -->
	{{-- <script src="{{asset('vendors/bower_components/echarts/dist/echarts-en.min.js')}}"></script>
	<script src="{{asset('vendors/echarts-liquidfill.min.js')}}"></script> --}}
	
	<!-- Toast JavaScript -->
	<script src="{{asset('vendors/bower_components/jquery-toast-plugin/dist/jquery.toast.min.js')}}"></script>
	
	<!-- Init JavaScript -->
	<script src="{{asset('dist/js/init.js')}}"></script>
	{{-- <script src="{{asset('dist/js/dashboard-data.js')}}"></script> --}}
	
	{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/js/all.min.js"></script> --}}
	
    @yield('page-footer')
</body>
</html>