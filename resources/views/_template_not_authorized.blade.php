@extends('__template_base')

@section('page-template')
    <div class="wrapper pa-0">
        <!-- Main Content -->
		<div class="page-wrapper pa-0 ma-0 auth-page">
            <div class="container-fluid">
                @yield('page-content')
			</div>
            
            @include('_footer')
		</div>
        <!-- /Main Content -->
    </div>
    <!-- /.wrapper -->
@endsection