@extends('_template_authorized')

@section('page-title')
Telco Registration
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
<!-- Search bar -->
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-default card-view">
            <div class="panel-wrapper collapse in">
                <div class="panel-body">
                    <div class="row">
                        <form>
                            <div class="col-sm-4 p-0 m-0">
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon">Search</div>
                                        <select id="selectTypeTelco" class="form-control" required>
                                            <option value="" selected disabled> Select Type </option>
                                            <option value="nik">NIK</option>
                                            <option value="msisdn">MSISDN</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-8 p-0 m-0">
                                <div class="form-group">
                                    <div class="input-group">
                                        <input type="text" id="telcoNumber" name="telcoNumber" class="form-control" placeholder="Enter NIK Or MSISDN" required />
                                        <span class="input-group-btn">
                                            <button type="button" class="btn btn-danger btn-icon left-icon" onclick="searchTelco()"><i class="fa fa-search"></i><span class="btn-text"> Search</span></button>
                                        </span> 
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>			
    </div>	
</div>

<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-info card-view panel-refresh red-border">
            <div class="refresh-container">
                <div class="la-anim-1"></div>
            </div>
            <div class="panel-heading">
                <div class="pull-left">
                    <h6 class="panel-title txt-dark">Data Search Result</h6>
                </div>
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
                                    <table class="table table-hover mb-0" id="tableTelco" name="tableTelco">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>NIK</th>
                                                <th>Phone Number</th>
                                                <th>Provider</th>
                                                <th>Registration Date</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbodyTelco" name="tbodyTelco">
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
    function searchTelco() {
        var e = document.getElementById("selectTypeTelco");
        var valueType = e.value;
        var telcoNumber = document.getElementById("telcoNumber").value;

        $(".preloader-it").show();

        $.ajax({
            type: "post",
            data: {
                type: valueType,
                value: telcoNumber
            },
            cache: false,
            // url: "{{config('app.url')}}/api/telecommunication/tracking-msisdn/"+msisdn,
            url: "{{config('app.url')}}/api/telecommunication/telco_registration",
            dataType: "json",
            success: function(response, status) {
                $("#tableTelco > tbody").html("");
                if (status == 'success' && response.message == "success") {
                    let datas = response.data;

                    if (datas.length > 0) {
                        var content = "";
                        var number = 0;
                        for (var i = 0; i < datas.length; i++) {
                            number += 1;
                            content += '<tr>'
                            content += '<td name="td-registrasi-nomor">' + number + '</td>'
                            content += '<td name="td-registrasi-nik"><span class="txt-dark weight-500">' + datas[i].PENCARIAN + '</span></td>'
                            content += '<td name="td-registrasi-phoneNumber"><span class="txt-dark">' + datas[i].NO_PESERTA + '</span></td>'
                            content += '<td name="td-registrasi-provider">' + datas[i].INSTANSI + '</td>'
                            content += '<td name="td-registrasi-registrationDate">' + datas[i].TANGGAL + '</td>'
                            content += '</tr>'
                            
                        }
                        $("#tbodyTelco").append(content);
                    } else {
                        alert('Data tidak ditemukan');
                    }
                } else {
                    alert(response.message);
                }
            },
            error: function(request, error) {
                console.log(arguments);
                alert(" Can't do because: " + error);
            },
            complete: function() {
                $(".preloader-it").hide();
            },
        });
    }
</script>
@endsection