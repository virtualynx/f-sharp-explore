@extends('_template_authorized')

@section('page-title')
Telco Registration
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
<!-- Title -->
<div class="row heading-bg">
    <!-- <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <h5 class="txt-dark">Tracking Number</h5>
    </div> -->
    <!-- Breadcrumb -->
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
        <ol class="breadcrumb">
            <li>Telecommunication</li>
            <li><a href="/transportasi/cek_kendaraan"><span>Telco Registration</span></a></li>
        </ol>
    </div>
    <!-- /Breadcrumb -->
</div>
<!-- /Title -->
<!-- <div class="row reorder form-group">
    <div class="col-md-3 cold-xs-12">
        <label class="input-group-addon text-left">Input Vehicle Number</label>
    </div>
    <div class="col-md-6 cold-xs-12">
        <input type="text" id="vehicleNumber" name="vehicleNumber" class="form-control" placeholder="Tracking Vehicle Number">
    </div>
    <div class="col-md-3 cold-xs-12">
        <span class="input-group-btn">
            <button class="btn btn-primary btn-icon left-icon" onclick="searchKendaraan()"><i class="fa fa-search"></i><span class="btn-text">Tracking</span></button>
        </span>
    </div>
</div> -->

<form>
    <div class="form-row">
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="telcoNumber">NIK / MSISDN</label>
                <input type="text" class="form-control" id="telcoNumber">
            </div>
            <div class="form-group col-md-4">
                <label for="selectTypeTelco">Type</label>
                <select id="selectTypeTelco" class="form-control">
                    <option value="" selected disabled>--SELECT--</option>
                    <option value="nik">NIK</option>
                    <option value="msisdn">MSISDN</option>
                </select>
            </div>
            <div class="form-group col-md-2">
                <br />
                <button type="button" class="btn btn-primary" onclick="searchTelco()">Cari</button>
            </div>
        </div>

</form>

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default card-view">
            <div class="panel-heading">
                <div class="pull-left">
                    <h6 class="panel-title txt-dark">Results</h6>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="panel-wrapper collapse in">
                <!-- Panel Overlay-->
                <div class="row mt-15 ml-5" id="panel-overlay-gmaps">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="well well-sm card-view">
                            <h6 class="mb-15">Detail Information Target</h6>
                            <div class="table-wrap mt-10">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered mb-0" id="tableTelco" name="tableTelco">
                                        <thead>
                                            <tr>
                                                <th scope="col">NO</th>
                                                <th scope="col">NIK</th>
                                                <th scope="col">PHONE_NUMBER</th>
                                                <th scope="col">PROVIDER</th>
                                                <th scope="col">REGISTRATION DATE</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbodyTelco" name="tbodyTelco">

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="panel panel-default card-view">
                                <div  class="panel-wrapper collapse in">
                                    <div  class="panel-body">
                                        <h6>Detail Information Target</h6>
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="exampleInputuname_3" class="col-sm-3 control-label">MMISDN</label>
                                                    <div class="col-sm-9">
                                                            asdsdsad
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div> -->
                    </div>
                </div>
                <!-- End Panel Overlay-->
                <div class="panel-body">
                    <div id="map" style="height:600px;"></div>
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
                            content += '<td name="td-registrasi-nik">' + datas[i].PENCARIAN + '</td>'
                            content += '<td name="td-registrasi-phoneNumber">' + datas[i].NO_PESERTA + '</td>'
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