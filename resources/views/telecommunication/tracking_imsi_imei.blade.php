@extends('_template_authorized')

@section('page-title')
Cek IMSI / IMEI
@endsection

@section('page-head')
{{-- <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />

<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin="">
</script> --}}

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
                                        <select id="selectTypeImsi" class="form-control" onchange="changeTypeImsi()">
                                            <option value="" selected disabled> Select Type </option>
                                            <option value="imsi">IMSI</option>
                                            <option value="imei">IMEI</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-8 p-0 m-0">
                                <div class="form-group">
                                    <div class="input-group">
                                        <input type="text" id="imsiNumber" name="imsiNumber" class="form-control" placeholder="Enter IMSI or IMEI" required />
                                        <span class="input-group-btn">
                                            <button type="button" class="btn btn-danger btn-icon left-icon" onclick="searchImsi()"><i class="fa fa-search"></i><span class="btn-text"> Search</span></button>
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
    <div class="col-lg-12">
        <div class="panel panel-info card-view panel-refresh red-border">
            <div class="refresh-container">
                <div class="la-anim-1"></div>
            </div>
            <div class="panel-heading">
                <div class="pull-left">
                    <h6 class="panel-title txt-dark">Data Results</h6>
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
                                    <table class="table table-hover mb-0" id="tableImsi" name="tableImsi">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>MSISDN</th>
                                                <th>IMEI</th>
                                                <th>IMSI</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbodyImsi" name="tbodyImsi">
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
    function changeType() {

        var e = document.getElementById("selectTypeKendaraan");
        var valueType = e.value;
        var nomorkendaraan = document.getElementById("vehicleNumber").value;
        if (valueType == "nik") {
            console.log("masuk if")
            var idDiv = document.getElementById("kendaraan_nik");
            var idDiv2 = document.getElementById("kendaraan_nopol");
            idDiv.style.display = "table";
            idDiv2.style.display = "none";
        } else {
            var idDiv = document.getElementById("kendaraan_nopol");
            var idDiv2 = document.getElementById("kendaraan_nik");
            idDiv.style.display = "table";
            idDiv2.style.display = "none";
        }
    }

    function searchImsi() {
        var e = document.getElementById("selectTypeImsi");
        var valueType = e.value;
        var nomorimsi = document.getElementById("imsiNumber").value;

        $(".preloader-it").show();

        $.ajax({
            type: "post",
            data: {
                type: valueType,
                value: nomorimsi
            },
            cache: false,
            // url: "{{config('app.url')}}/api/telecommunication/tracking-msisdn/"+msisdn,
            url: "{{config('app.url')}}/api/telecommunication/track_imsi_imei",
            dataType: "json",
            success: function(response, status) {
                console.log("isi response " + JSON.stringify(response));
                if (status == 'success' && response.message == "success") {
                    $("#tableImsi > tbody").html("");
                    let datas = response.data.original.data;
                   
                    var content = "";
                    var number = 0;
                    if (datas.length > 0) {
                        for (var i = 0; i < datas.length; i++) {
                            number += 1;
                            content += '<tr>'
                            content += '<td name="td-registrasi-nomor">' + number + '</td>'
                            content += '<td name="td-registrasi-nomor">' + datas[i]['msisdn'] + '</td>'
                            content += '<td name="td-registrasi-nomor">' + datas[i]['imei'] + '</td>'
                            content += '<td name="td-registrasi-nomor">' + datas[i]['imsi'] + '</td>'
                            content += '</tr>'

                        }
                        $("#tbodyImsi").append(content);
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
                    alert(response.message);
                }
            },
            error: ajaxErrorHandler,
            complete: function() {
                $(".preloader-it").hide();
            },
        });
    }



    function setDataKendaraan(data, valueType) {
        console.log("masuk set");
        if (valueType == "nik") {
            // $('[name="td-nik-no_polisi"]').html(data[0]["NO_POLISI"]);
            // $('[name="td-nik-no_rangka"]').html(data[0]["NO_RANGKA"]);
            // $('[name="td-nik-pemilik"]').html(data[0]["PEMILIK"]);
            // $('[name="td-nik-alamat"]').html(data[0]["ALAMAT"]);
            // $('[name="td-nik-merk"]').html(data[0]["MERK"]);
            // $('[name="td-nik-nik"]').html(data[0]["NIK"]);
            // $('[name="td-nik-no_bpkb"]').html(data[0]["NO_BPKB"]);
            // $('[name="td-nik-warna"]').html(data[0]["WARNA"]);
            // $('[name="td-nik-no_mesin"]').html(data[0]["NO_MESIN"]);
            // $('[name="td-nik-tipe_kend"]').html(data[0]["TIPE_KEND"]);

            $('[name="td-nik-no_polisi"]').html(data["NO_POLISI"]);
            $('[name="td-nik-no_rangka"]').html(data["NO_RANGKA"]);
            $('[name="td-nik-pemilik"]').html(data["PEMILIK"]);
            $('[name="td-nik-alamat"]').html(data["ALAMAT"]);
            $('[name="td-nik-merk"]').html(data["MERK"]);
            $('[name="td-nik-nik"]').html(data["NIK"]);
            $('[name="td-nik-no_bpkb"]').html(data["NO_BPKB"]);
            $('[name="td-nik-warna"]').html(data["WARNA"]);
            $('[name="td-nik-no_mesin"]').html(data["NO_MESIN"]);
            $('[name="td-nik-tipe_kend"]').html(data["TIPE_KEND"]);

        } else {
            $('[name="td-nopol-no_mesin"]').html(data["NO_MESIN"]);
            $('[name="td-nopol-no_polisi"]').html(data["NO_POLISI"]);
            $('[name="td-nopol-pemilik"]').html(data["PEMILIK"]);
            $('[name="td-nopol-no_rangka"]').html(data["NO_RANGKA"]);
            $('[name="td-nopol-rakit"]').html(data["RAKIT"]);
            $('[name="td-nopol-samsat_bayar"]').html(data["SAMSAT_BAYAR"]);
            $('[name="td-nopol-tgl_daftar"]').html(data["TGL_DAFTAR"]);
            $('[name="td-nopol-tgl_mati_yad"]').html(data["TGL_MATI_YAD"]);
            $('[name="td-nopol-stnk"]').html(data["TGL_STNK"]);
            $('[name="td-nopol-warna"]').html(data["WARNA"]);
            $('[name="td-nopol-alamat"]').html(data["ALAMAT"]);
            $('[name="td-nopol-bbm"]').html(data["BBM"]);
            $('[name="td-nopol-gol_kend"]').html(data["GOL_KEND"]);
            $('[name="td-nopol-jenis_kend"]').html(data["JENIS_KEND"]);
            $('[name="td-nopol-kode_golongan"]').html(data["KODE_GOLONGAN"]);
            $('[name="td-nopol-kode_jenis"]').html(data["KODE_JENIS"]);
            $('[name="td-nopol-merk"]').html(data["MERK"]);
        }
    }
</script>
@endsection