@extends('__template_base')

@section('page-template')
    <div class="wrapper theme-5-active pimary-color-blue">
        @include('_navbar')
        @include('_sidebar')
        
        <!-- Main Content -->
		<div class="page-wrapper">
            <div class="container-fluid pt-0">
                <!-- Title -->
                <div class="row heading-bg">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h5 class="txt-dark">@yield('page-title', '')</h5>
                    </div>
                    @include('_breadcrumb')
                </div>
                <!-- /Title -->

                @yield('page-content')
			</div>
            
            @include('_footer')
		</div>
        <!-- /Main Content -->
    </div>
    <!-- /.wrapper -->
@endsection