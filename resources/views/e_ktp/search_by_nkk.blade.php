@extends('_template_authorized')

@section('page-title')
SEARCH BY NKK
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
                                        <div class="input-group-addon">Search NKK</div>
                                        <input type="text" name="inputNKK" id="inputNKK" class="form-control" placeholder="Enter NKK" required />
                                        <span class="input-group-btn">
                                            <button type="button" class="btn btn-danger btn-icon left-icon" onclick="searchDataNKK()"><i class="fa fa-search"></i><span class="btn-text">Search</span></button>
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
        <div class="panel panel-default card-view">
            <div class="panel-heading">
                <div class="pull-left">
                    <h6 class="panel-title txt-dark">Data Dukcapil</h6>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="panel-wrapper collapse in" id="resultsNKK" name="resultsNKK">
                <!-- <div class="panel-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="item-big">
                                <div class="carousel slide">
                                    <div class="carousel-inner">
                                        <div class="item active"><img id="photoNKK" name="photoNKK" src="{{asset('dist/img/gallery/mock1.jpg')}}" alt="Image Personal Dukcapil"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="product-detail-wrap text-center">
                                <h5 class="mb-20 mt-10 weight-500" name="td-name">[NO DATA]</h5>
                            </div>
                        </div>

                        <div class="col-md-9">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="table-wrap">
                                        <div class="table-responsive">
                                            <table class="table mb-0">
                                                <tbody>
                                                    <tr>
                                                        <td class="border-none pl-0">Jenis Kelamin</td>
                                                        <td class="border-none pl-0" name="td-sex">[No Data]</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="pl-0">Pekerjaan</td>
                                                        <td class="pl-0" name="td-job">[No Data]</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="pl-0">Martial</td>
                                                        <td class="pl-0" name="td-martial">[No Data]</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="pl-0">Agama</td>
                                                        <td class="pl-0" name="td-religion">[No Data]</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="pl-0">Ayah</td>
                                                        <td class="pl-0" name="td-father">[No Data]</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="pl-0">Ibu</td>
                                                        <td class="pl-0" name="td-mother">[No Data]</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="pl-0">Alamat</td>
                                                        <td class="pl-0" name="td-address">[No Data]</td>
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
                                            <table class="table mb-0">
                                                <tbody>
                                                    <tr>
                                                        <td class="border-none pl-0">RT</td>
                                                        <td class="border-none pl-0" name="td-rt">[No Data]</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="pl-0">RW</td>
                                                        <td class="pl-0" name="td-rw">[No Data]</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="pl-0">Nomor KK</td>
                                                        <td class="pl-0" name="td-nkk">[No Data]</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="pl-0">Tempat/Tgl Lahir</td>
                                                        <td class="pl-0" name="td-ttl">[No Data]</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="pl-0">Pendidikan Terakhir</td>
                                                        <td class="pl-0" name="td-lastedu">[No Data]</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="pl-0">Golongan Darah</td>
                                                        <td class="pl-0" name="td-bloodtype">[No Data]</td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="2"></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12" style="display:flex; justify-content:center">
                                    <nav aria-label="...">
                                        <ul class="pagination pagination-lg">
                                            <li class="page-item disabled">
                                                <a class="page-link" href="#" tabindex="-1">1</a>
                                            </li>
                                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->
            </div>
        </div>
    </div>
</div>

{{-- <div class="row">
        <form method="POST" action="{{ url('api/e-ktp/search-by-nik') }}">
{{ csrf_field() }}
<div class="col-md-8 cold-xs-12 form-group">
    <label class="control-label mb-5" for="exampleInputUsername_2">NIK</label>
    <input name="nik" type="text" class="form-control" required="" placeholder="Enter NIK">
</div>
<div class="col-md-4 cold-xs-12 form-group text-center mb-0">
    <button type="button" onclick="searchData()" class="btn btn-danger btn-block">Search</button>
</div>
</form>
</div> --}}

{{-- <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default card-view">
                <div class="panel-heading">
                    <div class="pull-left">
                        <h6 class="panel-title txt-dark">Data Dukcapil</h6>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-wrapper collapse in">
                    <!-- Panel Overlay-->
                    <div class="row mt-15 ml-5" id="panel-overlay-gmaps">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="well well-sm card-view text-center">
                                <h6 class="mb-10">Photo</h6>
                                <img name="photo" src="" alt="..." class="img-thumbnail mb-15" style="max-width: 300px; max-height: 400px;">
                            </div>
                            <div class="table-wrap mb-15">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered mb-0">
                                        <tbody>
                                            <tr>
                                                <td width="30%">Nama Lengkap</td>
                                                <td name="td-name">[NO DATA]</td>
                                            </tr>
                                            <tr>
                                                <td width="30%">Jenis Kelamin</td>
                                                <td name="td-sex">[NO DATA]</td>
                                            </tr>
                                            <tr>
                                                <td width="30%">Pekerjaan</td>
                                                <td name="td-job">[NO DATA]</td>
                                            </tr>
                                            <tr>
                                                <td width="30%">Marital</td>
                                                <td name="td-marital">[NO DATA]</td>
                                            </tr>
                                            <tr>
                                                <td width="30%">Agama</td>
                                                <td name="td-religion">[NO DATA]</td>
                                            </tr>
                                            <tr>
                                                <td width="30%">Ayah</td>
                                                <td name="td-father">[NO DATA]</td>
                                            </tr>
                                            <tr>
                                                <td width="30%">Ibu</td>
                                                <td name="td-mother">[NO DATA]</td>
                                            </tr>
                                            <tr>
                                                <td width="30%">Alamat</td>
                                                <td name="td-address">[NO DATA]</td>
                                            </tr>
                                            <tr>
                                                <td width="30%">RT</td>
                                                <td name="td-rt">[NO DATA]</td>
                                            </tr>
                                            <tr>
                                                <td width="30%">RW</td>
                                                <td name="td-rw">[NO DATA]</td>
                                            </tr>
                                            <tr>
                                                <td width="30%">Nomor KK</td>
                                                <td name="td-nkk">[NO DATA]</td>
                                            </tr>
                                            <tr>
                                                <td width="30%">Tempat/Tgl Lahir</td>
                                                <td name="td-ttl">[NO DATA]</td>
                                            </tr>
                                            <tr>
                                                <td width="30%">Pendidikan Terakhir</td>
                                                <td name="td-lastedu">[NO DATA]</td>
                                            </tr>
                                            <tr>
                                                <td width="30%">Golongan Darah</td>
                                                <td name="td-bloodtype">[NO DATA]</td>
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
    </div> --}}
@endsection

@section('page-footer')
<script>
    // setMap([-1.269160, 116.825264]);


    function searchDataNKK() {
        let nkk = $('[name="inputNKK"]').val();

        $(".preloader-it").show();

        $.ajax({
            type: "post",
            data: {
                nkk: nkk
            },
            cache: false,
            url: "{{config('app.url')}}/api/e-ktp/search_by_nkk",
            dataType: "json",
            success: function(response, status) {
                var content = "";
                var dataArr = response.data;

                $("#resultsNKK").html('');
                if(dataArr !== null){
                    for (var i = 0; i < dataArr.length; i++) {
                        var imageView = "data:image/jpg;base64," + dataArr[i].FOTO;
                        var displayDiv = "none";
                        if (i == 0) {
                            displayDiv = "block";
                        }
                        content += '<div class="panel-body" style="display:' + displayDiv + ';" id="subresultnkk'+i+'">'
                        content += '<div class="row">'
                        content += '<div class="col-md-3">'
                        content += '<div class="item-big">'
                        content += '<div class="carousel slide">'
                        content += '<div class="carousel-inner">'
                        content += '<div class="item active"><img id="photoNKK' + i + '" name="photoNKK' + i + '"  src="' + imageView + '" alt="Image Personal Dukcapil"></div>'
                        content += '</div>'
                        content += "</div>"
                        content += "</div>"
                        content += '<div class="product-detail-wrap text-center">'
                        content += '<h5 class="mb-20 mt-10 weight-500" name="td-name">'+dataArr[i].NAMA_LGKP+'</h5>'
                        content += "</div>"
                        content += "</div>"
                        content += '<div class="col-md-9">'
                        content += '<div class="row">'
                        content += '<div class="col-md-6">'
                        content += '<div class="table-wrap">'
                        content += '<div class="table-responsive">'
                        content += '<table class="table mb-0">'
                        content += "<tbody>"
                        content += "<tr>"
                        content += '<td class="border-none pl-0">Jenis Kelamin</td>'
                        content += '<td class="border-none pl-0" name="td-sex">'+dataArr[i].JENIS_KLMIN+'</td>'
                        content += "</tr>"
                        content += "<tr>"
                        content += '<td class="pl-0">Pekerjaan</td>'
                        content += '<td class="pl-0" name="td-job">'+dataArr[i].JENIS_PKRJN+'</td>'
                        content += "</tr>"
                        content += "<tr>"
                        content += '<td class="pl-0">Marital</td>'
                        content += '<td class="pl-0" name="td-martial">'+dataArr[i].STAT_KWN+'</td>'
                        content += "</tr>"
                        content += "<tr>"
                        content += '<td class="pl-0">Agama</td>'
                        content += '<td class="pl-0" name="td-religion">'+dataArr[i].AGAMA+'</td>'
                        content += "</tr>"
                        content += "<tr>"
                        content += '<td class="pl-0">Ayah</td>'
                        content += '<td class="pl-0" name="td-father">'+dataArr[i].NAMA_LGKP_AYAH+'</td>'
                        content += "</tr>"
                        content += "<tr>"
                        content += '<td class="pl-0">Ibu</td>'
                        content += '<td class="pl-0" name="td-mother">'+dataArr[i].NAMA_LGKP_IBU+'</td>'
                        content += "</tr>"
                        content += "<tr>"
                        content += '<td class="pl-0">Alamat</td>'
                        content += '<td class="pl-0" name="td-address">'+dataArr[i].ALAMAT+'</td>'
                        content += "</tr>"
                        content += "<tr>"
                        content += '<td colspan="2" class="pa-0"></td>'
                        content += "</tr>"
                        content += "</tbody>"
                        content += "</table>"
                        content += "</div>"
                        content += "</div>"
                        content += "</div>"
                        content += '<div class="col-md-6">'
                        content += '<div class="table-wrap">'
                        content += '<div class="table-responsive">'
                        content += '<table class="table mb-0">'
                        content += "<tbody>"
                        content += " <tr>"
                        content += '<td class="border-none pl-0">RT</td>'
                        content += '<td class="border-none pl-0" name="td-rt">'+dataArr[i].NO_RT+'</td>'
                        content += "</tr>"
                        content += "<tr>"
                        content += '<td class="pl-0">RW</td>'
                        content += '<td class="pl-0" name="td-rw">'+dataArr[i].NO_RW+'</td>'
                        content += "</tr>"
                        content += "<tr>"
                        content += '<td class="pl-0">Nomor KK</td>'
                        content += '<td class="pl-0" name="td-nkk">'+dataArr[i].NKK+'</td>'
                        content += "</tr>"
                        content += "<tr>"
                        content += '<td class="pl-0">Tempat/Tgl Lahir</td>'
                        content += '<td class="pl-0" name="td-ttl">'+dataArr[i].TMPT_LHR+', ' + dataArr[i].TGL_LHR +' </td>'
                        content += "</tr>"
                        content += "<tr>"
                        content += '<td class="pl-0">Pendidikan Terakhir</td>'
                        content += '<td class="pl-0" name="td-lastedu">'+dataArr[i].PDDK_AKH+'</td>'
                        content += "</tr>"
                        content += "<tr>"
                        content += '<td class="pl-0">Golongan Darah</td>'
                        content += '<td class="pl-0" name="td-bloodtype">'+dataArr[i].GOL_DARAH+'</td>'
                        content += "</tr>"
                        content += "<tr>"
                        content += '<td colspan="2"></td>'
                        content += "</tr>"
                        content += "</tbody>"
                        content += "</table>"
                        content += "</div>"
                        content += "</div>"
                        content += "</div>"
                        content += '<div class="col-md-12" style="display:flex; justify-content:center">'
                        content += '<nav aria-label="...">'
                        content += '<ul class="pagination pagination-lg" id="paginationNkk' + i + '">'
                        for (var j = 0; j < dataArr.length; j++) {
                            var urutan = j + 1;
                            content += '<li class="page-item"><a class="page-link" onclick="showPagesNkk(' + j + ',' + dataArr.length + ')">' + urutan + '</a></li>'
                        }
                        // content += '<li class="page-item disabled">'
                        // content += '<a class="page-link" href="#" tabindex="-1">1</a>'
                        // content += '</li>'
                        // content += '<li class="page-item"><a class="page-link" href="#">2</a></li>'
                        // content += '<li class="page-item"><a class="page-link" href="#">3</a></li>'
                        content += "</ul>"
                        content += "</nav>"
                        content += "</div>"
                        content += "</div>"
                        content += "</div>"
                        content += "</div>"
                        content += "</div>"
                    }
                    $("#resultsNKK").append(content);
                }else{
                    alert('Data tidak ditemukan');
                }
               
                $(".preloader-it").hide();
            },
            error: function(request, error) {
                console.log(arguments);
                alert(" Can't do because: " + error);
                $(".preloader-it").hide();
            }
        });
    }

    function showPagesNkk(urutan, length) {
        for (var i = 0; i < length; i++) {
            if (document.getElementById('subresultnkk' + i)) {
                document.getElementById('subresultnkk' + i).style.display = 'none';
            }
            if (document.getElementById('subresultnkk' + urutan)) {

                document.getElementById('subresultnkk' + urutan).style.display = 'block';
            }
        }
    }

    function setData(data) {
        $('[name="td-msisdn"]').html(data.msisdn);
        $('[name="td-imsi"]').html(data.imsi);
        $('[name="td-imei"]').html(data.imei);
        $('[name="td-provider"]').html(data.provider);
        $('[name="td-address"]').html(data.address);
        $('[name="td-phone"]').html(data.phone);
        $('[name="td-lat"]').html(data.lat);
        $('[name="td-long"]').html(data.long);
    }
</script>
@endsection