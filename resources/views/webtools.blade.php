@extends('_template_authorized')

@section('page-title')
    Webtools
@endsection

@section('page-head')
@endsection

@section('page-content')

    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-info card-view red-border">
                <div class="panel-wrapper collapse in">
                    <div class="panel-body pt-5">
                        <div class="row">
                            <div class="col-md-12">
                                <iframe src="{{ url('webtools_content/index.html') }}" src="https://x0320.id/webtools/index.html" width="100%" height="600px" title="Webtools"></iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('page-footer')
    <script>
		$(function() {
			"use strict";
			
		});
	</script>
@endsection