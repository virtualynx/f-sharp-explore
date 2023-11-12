@extends('__template_base')

@section('page-template')
    <div class="wrapper theme-5-active pimary-color-blue">
        <!-- Main Content -->
		<div class="page-wrapper auth-page">
            <div class="container-fluid pt-25">
                @yield('page-content')
			</div>
            
            @include('_footer')
		</div>
        <!-- /Main Content -->
    </div>
    <!-- /.wrapper -->
@endsection