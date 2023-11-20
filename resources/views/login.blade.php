@extends('_template_not_authorized')

@section('page-title')
  Login
@endsection

@section('page-content')
    <!-- Row -->
    <div class="table-struct full-width full-height">
        <div class="table-cell vertical-align-middle auth-form-wrap">
            <div class="auth-form  ml-auto mr-auto no-float">
                <div class="row">
                    <div class="col-sm-12 col-xs-12">
                        <div class="mb-30">
                            <div class="text-center txt-dark mb-10"><img class="logo-brand-img-login mr-10" src="{{asset('dist/img/black-0320-horizontal-logo.png')}}" alt="new logo 0320explorer"/></div>
                            <h6 class="text-center nonecase-font txt-grey">Enter your credentials below</h6>
                        </div>	
                        <div class="form-wrap mb-20">
                            <form method="POST" action="{{ url("do-login") }}">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label class="control-label mb-10" for="exampleInputUsername_2">Username</label>
                                    <input name="username" type="username" class="form-control" required="" id="exampleInputUsername_2" placeholder="Enter username">
                                </div>
                                <div class="form-group">
                                    <label class="pull-left control-label mb-10" for="exampleInputpwd_2">Password</label>
                                    <input name="password" type="password" class="form-control" required="" id="exampleInputpwd_2" placeholder="Enter pwd">
                                </div>
                                <div class="form-group">
                                    <a class="capitalize-font text-danger block mb-10 pull-right font-12" href="forgot-password.html">forgot password ?</a>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="form-group text-center">
                                    <button type="submit" class="btn btn-danger btn-block">sign in</button>
                                </div>
                            </form>
                            <div class="clearfix"></div>
                        </div>
                        <div class="form-group mb-0 text-center">
                            <span class="inline-block">Don't have an account?</span>
                            <a class="capitalize-font text-danger mb-10" href="/register"><u>Sign Up Here.</u></a>
                        </div>
                    </div>	
                </div>
            </div>
        </div>
    </div>
    <!-- /Row -->	
@endsection