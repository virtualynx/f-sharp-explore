@extends('__template_base')

@section('page-template')
    <div class="wrapper theme-5-active pimary-color-blue">
        @include('_navbar')
        @include('_sidebar')
        
        <!-- Main Content -->
		<div class="page-wrapper">
            <div class="container-fluid pt-25">
                @yield('page-content')
			</div>
            
            @include('_footer')
		</div>
        <!-- /Main Content -->
    </div>
    <!-- /.wrapper -->
@endsection