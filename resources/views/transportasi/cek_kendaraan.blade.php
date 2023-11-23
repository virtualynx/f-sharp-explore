@extends('_template_authorized')

@section('page-title')
Cek Kendaraan
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
                                        <select id="selectTypeKendaraan" class="form-control" onchange="changeType()">
                                            <option value="" selected disabled> Select Type </option>
                                            <option value="nik">NIK</option>
                                            <option value="nopol">Vehicle Number (NOPOL)</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-8 p-0 m-0">
                                <div class="form-group">
                                    <div class="input-group">
                                        <input type="text" id="vehicleNumber" name="vehicleNumber" onkeyup="capitalizeVehicleNumber()" class="form-control" placeholder="Enter Vehicle Number (NOPOL) Or NIK" required />
                                        <span class="input-group-btn">
                                            <button type="button" class="btn btn-danger btn-icon left-icon" onclick="searchKendaraan()"><i class="fa fa-search"></i><span class="btn-text"> Search</span></button>
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
                    <h6 class="panel-title txt-dark">Data Kendaraan</h6>
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
                <div class="panel-body pt-5">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-wrap">
                                <div class="table-responsive mb-0" id="table-kendaraan-div">
                                    <table class="table table-hover mb-0 pb-50" id="kendaraan_nopol" style="display: none;">
                                        <thead>
                                            <tr>
                                                <th colspan="2" class="text-center">Detail Information Target</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td width="30%"><span class="txt-dark weight-500">Nomor Mesin</span></td>
                                                <td name="td-nopol-no_mesin">[NO DATA]</td>
                                            </tr>
                                            <tr>
                                                <td width="30%"><span class="txt-dark weight-500">Nomor Polisi</span></td>
                                                <td name="td-nopol-no_polisi">[NO DATA]</td>
                                            </tr>
                                            <tr>
                                                <td width="30%"><span class="txt-dark weight-500">Nomor Rangka</span></td>
                                                <td name="td-nopol-no_rangka">[NO DATA]</td>
                                            </tr>
                                            <tr>
                                                <td width="30%"><span class="txt-dark weight-500">Pemilik</span></td>
                                                <td name="td-nopol-pemilik">[NO DATA]</td>
                                            </tr>
                                            <tr>
                                                <td width="30%"><span class="txt-dark weight-500">Rakit</span></td>
                                                <td name="td-nopol-rakit">[NO DATA]</td>
                                            </tr>
                                            <tr>
                                                <td width="30%"><span class="txt-dark weight-500">Samsat Bayar</span></td>
                                                <td name="td-nopol-samsat_bayar">[NO DATA]</td>
                                            </tr>
                                            <tr>
                                                <td width="30%"><span class="txt-dark weight-500">Tanggal Daftar</span></td>
                                                <td name="td-nopol-tgl_daftar">[NO DATA]</td>
                                            </tr>
                                            <tr>
                                                <td width="30%"><span class="txt-dark weight-500">Tanggal Mati YAD</span></td>
                                                <td name="td-nopol-tgl_mati_yad">[NO DATA]</td>
                                            </tr>
                                            <tr>
                                                <td width="30%"><span class="txt-dark weight-500">Tanggal STNK</span></td>
                                                <td name="td-nopol-stnk">[NO DATA]</td>
                                            </tr>
                                            <tr>
                                                <td width="30%"><span class="txt-dark weight-500">Warna</span></td>
                                                <td name="td-nopol-warna">[NO DATA]</td>
                                            </tr>
                                            <tr>
                                                <td width="30%"><span class="txt-dark weight-500">Alamat</span></td>
                                                <td name="td-nopol-alamat">[NO DATA]</td>
                                            </tr>
                                            <tr>
                                                <td width="30%"><span class="txt-dark weight-500">Jenis BBM</span></td>
                                                <td name="td-nopol-bbm">[NO DATA]</td>
                                            </tr>
                                            <tr>
                                                <td width="30%"><span class="txt-dark weight-500">Golongan Kendaraan</span></td>
                                                <td name="td-nopol-gol_kend">[NO DATA]</td>
                                            </tr>
                                            <tr>
                                                <td width="30%"><span class="txt-dark weight-500">Jenis Kendaraan</span></td>
                                                <td name="td-nopol-jenis_kend">[NO DATA]</td>
                                            </tr>
                                            <tr>
                                                <td width="30%"><span class="txt-dark weight-500">Kode Golongan</span></td>
                                                <td name="td-nopol-kode_golongan">[NO DATA]</td>
                                            </tr>
                                            <tr>
                                                <td width="30%"><span class="txt-dark weight-500">Kode Jenis</span></td>
                                                <td name="td-nopol-kode_jenis">[NO DATA]</td>
                                            </tr>
                                            <tr>
                                                <td width="30%"><span class="txt-dark weight-500">Merk Kendaraan</span></td>
                                                <td name="td-nopol-merk">[NO DATA]</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <table class="table table-hover mb-0 pb-50" id="kendaraan_nik" style="display: none;">
                                        <thead>
                                            <tr>
                                                <th colspan="2" class="text-center">Detail Information Target</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td width="30%"><span class="txt-dark weight-500">Nomor Polisi</span></td>
                                                <td name="td-nik-no_polisi">[NO DATA]</td>
                                            </tr>
                                            <tr>
                                                <td width="30%"><span class="txt-dark weight-500">Nomor Rangka</span></td>
                                                <td name="td-nik-no_rangka">[NO DATA]</td>
                                            </tr>
                                            <tr>
                                                <td width="30%"><span class="txt-dark weight-500">Pemilik</span></td>
                                                <td name="td-nik-pemilik">[NO DATA]</td>
                                            </tr>
                                            <tr>
                                                <td width="30%"><span class="txt-dark weight-500">Alamat</span></td>
                                                <td name="td-nik-alamat">[NO DATA]</td>
                                            </tr>
                                            <tr>
                                                <td width="30%"><span class="txt-dark weight-500">Merk Kendaraan</span></td>
                                                <td name="td-nik-merk">[NO DATA]</td>
                                            </tr>
                                            <tr>
                                                <td width="30%"><span class="txt-dark weight-500">NIK</span></td>
                                                <td name="td-nik-nik">[NO DATA]</td>
                                            </tr>
                                            <tr>
                                                <td width="30%"><span class="txt-dark weight-500">Nomor BPKB</span></td>
                                                <td name="td-nik-no_bpkb">[NO DATA]</td>
                                            </tr>
                                            <tr>
                                                <td width="30%"><span class="txt-dark weight-500">Warna</span></td>
                                                <td name="td-nik-warna">[NO DATA]</td>
                                            </tr>
                                            <tr>
                                                <td width="30%"><span class="txt-dark weight-500">Nomor Mesin</span></td>
                                                <td name="td-nik-no_mesin">[NO DATA]</td>
                                            </tr>
                                            <tr>
                                                <td width="30%"><span class="txt-dark weight-500">Tipe Kendaraan</span></td>
                                                <td name="td-nik-tipe_kend">[NO DATA]</td>
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
@endsection

@section('page-footer')
<script>
    function capitalizeVehicleNumber(){
        let vecNumber = $('[name="vehicleNumber"]').val();
        $('[name="vehicleNumber"]').val(vecNumber.toUpperCase());
    }

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

    function searchKendaraan() {
        var e = document.getElementById("selectTypeKendaraan");
        var valueType = e.value;
        var nomorkendaraan = document.getElementById("vehicleNumber").value;

        if(!valueType || !nomorkendaraan){
            $.toast().reset('all');
            $.toast({
                heading: 'Warning',
                text: 'Tipe dan Nomor Pencarian harus diisi',
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
                type: valueType,
                nopol: nomorkendaraan
            },
            cache: false,
            // url: "{{config('app.url')}}/api/telecommunication/tracking-msisdn/"+msisdn,
            url: "{{config('app.url')}}/api/transportasi/tracking_kendaraan",
            dataType: "json",
            success: function(response, status) {
                console.log("isi response " + JSON.stringify(response));
                if (status == 'success' && response.message == "success") {
                    let datas = response.data;

                    if (datas.length > 0) {
                        setDataKendaraan(datas[0], valueType);
                    }else{
                        // alert('Data tidak ditemukan');
                        
                        $.toast().reset('all');
                        $.toast({
                            heading: 'No Data',
                            text: 'Data tidak ditemukan',
                            position: 'top-right',
                            loaderBg: '#fec107',
                            icon: 'error',
                            hideAfter: false
                        });
                    }
                } else {
                    // alert(response.message);
                        
                    $.toast().reset('all');
                    $.toast({
                        heading: 'Opps! something wents wrong',
                        text: response.message,
                        position: 'top-right',
                        loaderBg: '#fec107',
                        icon: 'error',
                        hideAfter: false
                    });
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