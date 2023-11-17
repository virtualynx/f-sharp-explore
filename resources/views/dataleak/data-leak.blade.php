@extends('_template_authorized')

@section('page-title')
Data Leak
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
                                        <div class="input-group-addon">Search Data</div>
                                        <input type="text" name="inputMsisdnLeak" id="inputMsisdnLeak" class="form-control" placeholder="Enter MSISDN" required />
                                        <span class="input-group-btn">
                                            <button type="button" class="btn btn-danger btn-icon left-icon" onclick="searchDataLeak()"><i class="fa fa-search"></i><span class="btn-text"> Search</span></button>
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
                <div class="pull-left">
                    <h6 class="panel-title txt-dark">
                        Lakukan pencarian data terlebih dahulu pada "Search Box" diatas
                    </h6>
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
                                                <th>Name</th>
                                                <th>NIK</th>
                                                <th>Alamat</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbodyDataLeak" name="tbodyDataLeak">
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
                <div class="panel-body pt-5">
                    <div class="row mb-50">
                        <div class="col-md-3">
                            <div class="item-big">
                                <div class="carousel slide">
                                    <div class="carousel-inner">
                                        <div class="item active"><img name="photo" src="{{asset('dist/img/gallery/mock1.jpg')}}" alt="Image Personal Dukcapil" width="100%"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-9">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="table-wrap">
                                        <div class="table-responsive mb-0">
                                            <table class="table table-hover mb-0">
                                                <tbody>
                                                    <tr>
                                                        <td class="border-none pl-0" width="50%"><span class="txt-dark weight-500">NIK</span></td>
                                                        <td class="border-none pl-0" name="td-nik-leak">[No Data]</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="pl-0" width="50%"><span class="txt-dark weight-500">Nama</span></td>
                                                        <td class="pl-0" name="td-name-leak">[No Data]</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="pl-0" width="50%"><span class="txt-dark weight-500">Tempat/Tgl Lahir</span></td>
                                                        <td class="pl-0" name="td-ttl-leak">[No Data]</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="pl-0" width="50%"><span class="txt-dark weight-500">Jenis Kelamin</span></td>
                                                        <td class="pl-0" name="td-sex-leak">[No Data]</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="pl-0" width="50%"><span class="txt-dark weight-500">Agama</span></td>
                                                        <td class="pl-0" name="td-religion-leak">[No Data]</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="pl-0" width="50%" style="vertical-align: top;"><span class="txt-dark weight-500">Alamat</span></td>
                                                        <td class="pl-0" name="td-address-leak">[No Data]</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="pl-0" width="50%"><span class="txt-dark weight-500">RT / RW</span></td>
                                                        <td class="pl-0" name="td-rt-rw-leak">[No Data]</td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="2" class="pa-0"></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="table-wrap">
                                        <div class="table-responsive">
                                            <table class="table table-hover mb-0">
                                                <tbody>
                                                    <tr>
                                                        <td class="pl-0 border-none" width="50%"><span class="txt-dark weight-500">Nomor KK</span></td>
                                                        <td class="pl-0 border-none" name="td-nkk-leak">[No Data]</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="pl-0" width="50%"><span class="txt-dark weight-500">Ayah</span></td>
                                                        <td class="pl-0" name="td-father-leak">[No Data]</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="pl-0" width="50%"><span class="txt-dark weight-500">Ibu</span></td>
                                                        <td class="pl-0" name="td-mother-leak">[No Data]</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="pl-0" width="50%"><span class="txt-dark weight-500">Status Perkawinan</span></td>
                                                        <td class="pl-0" name="td-marital-leak">[No Data]</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="pl-0" width="50%"><span class="txt-dark weight-500">Pekerjaan</span></td>
                                                        <td class="pl-0" name="td-job-leak">[No Data]</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="pl-0" width="50%"><span class="txt-dark weight-500">Pendidikan Terakhir</span></td>
                                                        <td class="pl-0" name="td-lastedu-leak">[No Data]</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="pl-0" width="50%"><span class="txt-dark weight-500">Golongan Darah</span></td>
                                                        <td class="pl-0" name="td-bloodtype-leak">[No Data]</td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="2"></td>
                                                    </tr>
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
    </div>
</div>



@endsection

@section('page-footer')
<script>
    function searchDataLeak() {
        let msisdn = $('[name="inputMsisdnLeak"]').val();

        $(".preloader-it").show();

        $.ajax({
            type: "post",
            data: {
                msisdn: msisdn
            },
            cache: false,
            url: "{{config('app.url')}}/api/dataleak/data_leak",
            dataType: "json",
            success: function(response, status) {
                var content = "";
                var dataArr = response.data;
                console.log("isi data " + JSON.stringify(response));
                $('.panel-title').html('Data Dukcapil');
                $("#resultsDataLeak").html('');
                if (status == 'success' && response.message == "success") {
                    let datas = response.data;

                    if (datas.length > 0) {
                        var content = "";
                        var number = 0;
                        for (var i = 0; i < datas.length; i++) {
                            number += 1;
                            content += '<tr>'
                            content += '<td name="td-registrasi-nomor">' + number + '</td>'
                            if (datas[i].name) {
                                content += '<td name="td-registrasi-nomor">' + datas[i].name[0] + '</td>'
                            }
                            if (datas[i].registration_data) {
                                content += '<td name="td-registrasi-nomor">' + datas[i].registration_data + '</td>'
                            }
                            if (datas[i].address) {
                                content += '<td name="td-registrasi-nomor">' + datas[i].address + '</td>'
                            }
                            if (datas[i].registration_data) {
                                content += '<td name="td-registrasi-nomor"><a onclick="searchByNikFromLeak(' + datas[i].registration_data + ')"><button type="button" class="btn btn-primary"><i class="far fa-eye"></i></button></a></td>'

                            }
                            content += '</tr>'

                        }
                        $("#tbodyDataLeak").append(content);
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
                        text: 'Data tidak ditemukan',
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

    function searchByNikFromLeak(nik) {

        $(".preloader-it").show();

        $.ajax({
            type: "post",
            data: {
                nik: nik
            },
            // data: $('[name="search_by_nik_form"]').serialize(),
            cache: false,
            // url: "{{config('app.url')}}/api/e-ktp/search-by-nik",
            url: "{{route('api_ektp_search_by_nik')}}",
            dataType: "json",
            success: function(response, status) {

                if (status == 'success' && response.status == 0) {
                    setDataNikLeak(response.data);
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
                    // alert(response.message);
                }
            },
            error: ajaxErrorHandler,
            complete: function() {
                $(".preloader-it").hide();
            },
        });
    }

    function setDataNikLeak(data) {
        $('[name="photo"]').attr('src', 'data:image/png;base64,' + data.FOTO);

        $('[name="td-name-leak"]').html(data.NAMA_LGKP);
        $('[name="td-nik-leak"]').html(data.NIK);
        $('[name="td-sex-leak"]').html(data.JENIS_KLMIN);
        $('[name="td-job-leak"]').html(data.JENIS_PKRJN);
        $('[name="td-marital-leak"]').html(data.STAT_KWN);
        $('[name="td-religion-leak"]').html(data.AGAMA);
        $('[name="td-father-leak"]').html(data.NAMA_LGKP_AYAH);
        $('[name="td-mother-leak"]').html(data.NAMA_LGKP_IBU);
        $('[name="td-address-leak"]').html(data.ALAMAT);
        $('[name="td-rt-rw-leak"]').html(data.NO_RT + ' / ' + data.NO_RW);
        // $('[name="td-rt"]').html(data.NO_RT);
        // $('[name="td-rw"]').html(data.NO_RW);
        $('[name="td-nkk-leak"]').html(data.NKK);
        $('[name="td-ttl-leak"]').html(data.TMPT_LHR + ', ' + data.TGL_LHR);
        $('[name="td-lastedu-leak"]').html(data.PDDK_AKH);
        $('[name="td-bloodtype-leak"]').html(data.GOL_DARAH);
    }
</script>
@endsection