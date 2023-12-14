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
                <div class="panel-body mb-20">
                    <div class="row">
                        <div class="col-sm-12 p-0 m-0">
                            <form>
                                {{ csrf_field() }}
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="inputSosmedLeak" class="txt-dark weight-500">Username</label>
                                        <input type="text" name="inputSosmedLeak" id="inputSosmedLeak" class="form-control" placeholder="Enter ...">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="inputSosmedSites" class="txt-dark weight-500">Max Sites</label>
                                        <input type="number" pattern="^[0-9]*$" name="inputSosmedSites" id="inputSosmedSites" class="form-control" placeholder="Enter ...">
                                    </div>
                                </div>
                                <div class="col-sm-4 p-0 m-0">
                                    <div class="form-group">
                                        <label></label>
                                        <span class="input-group-btn">
                                            <button type="button" class="btn btn-danger btn-icon left-icon" onclick="searchSosmedLeak()"><i class="fa fa-search"></i><span class="btn-text"> Search</span></button>
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
                                                <th>Action</th>
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
        let maxSites = $('[name="inputSosmedSites"]').val();

        if (!sosmed || !maxSites) {
            myAlert('Text pencarian harus diisi', 'warning');
            return;
        } else if (sosmed.length < 5) {
            myAlert('Minimal input username 5 karakter', 'warning');
            return;
        }

        post({
            data: {
                sosmed: sosmed,
                maxSites: maxSites
            },
            url: "{{config('app.url')}}/api/dataleak/sosmed_leak",
            success: function(response, status) {
                var content = "";
                var dataArr = response.data;
                $('.panel-title').html('Data Dukcapil');
                //$("#tableDataSosmed > tbody").html("");
                if (status == 'success' && response.message == "success") {
                    if (response.data != null) {
                        let datas = response.data.found_accounts;
                        if (datas.length > 0) {
                            var content = "";
                            var number = 0;
                            var table = $('#tableDataSosmed').DataTable();
                            table.clear();
                            for (var i = 0; i < datas.length; i++) {
                                number += 1;
                                // number += 1;
                                // content += '<tr>'
                                // content += '<td name="td-registrasi-nomor">' + number + '</td>'
                                // content += '<td name="td-registrasi-nomor">' + datas[i]['site'] + '</td>'
                                // content += '<td name="td-registrasi-nomor"><a href="' + datas[i]['url_user'] + '"><span class="input-group-btn"><button type="button" class="btn btn-danger btn-icon left-icon"><i class="fa fa-search"></i><span class="btn-text">Lihat</span></button></span></a></td>'
                                // content += '</tr>'
                                table.row.add([
                                    number,
                                    datas[i]['site'],
                                    '<a href="' + datas[i]['url_user'] + '" target="_blank"><span class="input-group-btn"><button type="button" class="btn btn-danger btn-icon left-icon"><i class="fa fa-search"></i><span class="btn-text">Lihat</span></button></span></a>',
                                ]).draw(true);
                            }
                            table.draw();
                            //$("#tbodyDataSosmed").append(content);
                        } else {
                            myAlert('Data tidak ditemukan', 'warning');
                        }
                    }

                } else {
                    myAlert(response.message, 'error');
                }
            }
        });
    }
</script>
@endsection