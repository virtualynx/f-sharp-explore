@extends('__template_base')

@section('page-template')
    <div class="wrapper pa-0">
        <!-- Main Content -->
		<div class="page-wrapper pa-0 ma-0 auth-page" style="background: url('{{asset('dist/videos/gif-login-background.gif')}}') no-repeat center center fixed; background-size: cover;">
            <div class="container-fluid">
                @yield('page-content')
			</div>
            
            @include('_footer')
		</div>
        <!-- /Main Content -->
    </div>
    <!-- /.wrapper -->
@endsection