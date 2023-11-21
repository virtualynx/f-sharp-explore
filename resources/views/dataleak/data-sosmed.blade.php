@extends('_template_authorized')

@section('page-title')
Data Media Social
@endsection

@section('page-head')
<style>
    @media (max-width: 768px) {
        .reorder {
            display: flex;
            flex-direction: column;
        }
    }
</style>
@endsection

@section('page-content')
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-default card-view">
            <div class="panel-wrapper collapse in">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-sm-12 p-0 m-0">
                            <form>
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon">Search Social Media</div>
                                        <input type="text" name="inputSosmedLeak" id="inputSosmedLeak" class="form-control" placeholder="Enter Username" required />
                                        <span class="input-group-btn">
                                            <button type="button" class="btn btn-danger btn-icon left-icon" onclick="searchSosmedLeak()"><i class="fa fa-search"></i><span class="btn-text">Search</span></button>
                                        </span>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Response Search -->
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-info card-view panel-refresh red-border">
            <div class="refresh-container">
                <div class="la-anim-1"></div>
            </div>
            <div class="panel-heading">
                <div class="pull-right">
                    <a href="#" class="pull-left inline-block refresh mr-15">
                        <i class="zmdi zmdi-replay"></i>
                    </a>
                    <a href="#" class="pull-left inline-block full-screen mr-15">
                        <i class="zmdi zmdi-fullscreen"></i>
                    </a>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="panel-wrapper collapse in">
                <div class="panel-body pt-5 pb-50">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-wrap">
                                <div class="table-responsive mb-0">
                                    <table class="table table-hover mb-0" id="tableDataSosmed" name="tableDataSosmed">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Website</th>
                                                <th>Address</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbodyDataSosmed" name="tbodyDataSosmed">
                                        </tbody>
                                    </table>
                                </div>
                            </div>
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
    function searchSosmedLeak() {
        let sosmed = $('[name="inputSosmedLeak"]').val();

        if(!sosmed){
            $.toast().reset('all');
            $.toast({
                heading: 'Warning',
                text: 'Text pencarian harus diisi',
                position: 'top-right',
                loaderBg: '#fec107',
                icon: 'error',
                hideAfter: false
            });
            return;
        }

        $(".preloader-it").show();

        $.ajax({
            type: "post",
            data: {
                sosmed: sosmed
            },
            cache: false,
            url: "{{config('app.url')}}/api/dataleak/sosmed_leak",
            dataType: "json",
            success: function(response, status) {
                var content = "";
                var dataArr = response.data;
                $('.panel-title').html('Data Dukcapil');
                $("#tableDataSosmed > tbody").html("");
                if (status == 'success' && response.message == "success") {
                    let datas = response.data.found_accounts;
                    if (datas.length > 0) {
                        var content = "";
                        var number = 0;
                        for (var i = 0; i < datas.length; i++) {
                            number += 1;
                            content += '<tr>'
                            content += '<td name="td-registrasi-nomor">' + number + '</td>'
                            content += '<td name="td-registrasi-nomor">' + datas[i]['site'] + '</td>'
                            content += '<td name="td-registrasi-nomor">' + datas[i]['url_user'] + '</td>'
                            content += '</tr>'
                        }



                        $("#tbodyDataSosmed").append(content);
                    } else {
                        $.toast().reset('all');
                        $.toast({
                            heading: 'Opps! somthing wents wrong',
                            text: 'Data tidak ditemukan',
                            position: 'top-right',
                            loaderBg: '#fec107',
                            icon: 'error',
                            hideAfter: false
                        });
                    }
                } else {
                    $.toast().reset('all');
                    $.toast({
                        heading: 'Opps! somthing wents wrong',
                        text: response.message,
                        position: 'top-right',
                        loaderBg: '#fec107',
                        icon: 'error',
                        hideAfter: false
                    });
                    //alert('Data tidak ditemukan');
                }

                $(".preloader-it").hide();
            },
            error: ajaxErrorHandler,
            complete: function() {
                $(".preloader-it").hide();
            }
        });
    }
</script>
@endsection