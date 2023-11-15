@extends('_template_authorized')

@section('page-title')
Search By NKK
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
                                            <button type="button" class="btn btn-danger btn-icon left-icon" onclick="searchDataNKK()"><i class="fa fa-search"></i><span class="btn-text"> Search</span></button>
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
        <div class="panel panel-info card-view red-border">
            <div class="panel-heading">
                <div class="pull-left">
                    <h6 class="panel-title txt-dark">Data Dukcapil</h6>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="panel-wrapper collapse in" id="resultsNKK" name="resultsNKK">
            </div>
        </div>
    </div>
</div>
@endsection

@section('page-footer')
<script>

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
                        content += '<div class="panel-body pt-5" style="display:' + displayDiv + ';" id="subresultnkk'+i+'">'
                        content += '<div class="row">'
                        content += '<div class="col-md-3">'
                        content += '<div class="item-big">'
                        content += '<div class="carousel slide">'
                        content += '<div class="carousel-inner">'
                        content += '<div class="item active"><img id="photoNKK' + i + '" name="photoNKK' + i + '"  src="' + imageView + '" alt="Image Personal Dukcapil"></div>'
                        content += '</div>'
                        content += "</div>"
                        content += "</div>"
                        content += "</div>"
                        content += '<div class="col-md-9">'
                        content += '<div class="row">'
                        content += '<div class="col-md-6">'
                        content += '<div class="table-wrap">'
                        content += '<div class="table-responsive mb-0">'
                        content += '<table class="table mb-0">'
                        content += "<tbody>"
                        content += "<tr>"
                        content += '<td class="border-none pl-0" width="40%">NIK</td>'
                        content += '<td class="border-none pl-0" name="td-nik">'+dataArr[i].NIK+'</td>'
                        content += "</tr>"
                        content += "<tr>"
                        content += '<td class="pl-0" width="40%">Nama</td>'
                        content += '<td class="pl-0" name="td-name">'+dataArr[i].NAMA_LGKP+'</td>'
                        content += "</tr>"
                        content += "<tr>"
                        content += '<td class="pl-0" width="40%">Tempat/Tgl Lahir</td>'
                        content += '<td class="pl-0" name="td-ttl">'+dataArr[i].TMPT_LHR+', ' + dataArr[i].TGL_LHR +' </td>'
                        content += "</tr>"
                        content += "<tr>"
                        content += '<td class="pl-0" width="40%">Jenis Kelamin</td>'
                        content += '<td class="pl-0" name="td-sex">'+dataArr[i].JENIS_KLMIN+'</td>'
                        content += "</tr>"
                        content += "<tr>"
                        content += '<td class="pl-0" width="40%">Agama</td>'
                        content += '<td class="pl-0" name="td-religion">'+dataArr[i].AGAMA+'</td>'
                        content += "</tr>"
                        content += "<tr>"
                        content += '<td class="pl-0" width="40%" style="vertical-align: top;">Alamat</td>'
                        content += '<td class="pl-0" name="td-address">'+dataArr[i].ALAMAT+'</td>'
                        content += "</tr>"
                        content += "<tr>"
                        content += '<td class="pl-0" width="40%">RT</td>'
                        content += '<td class="pl-0" name="td-rt">'+dataArr[i].NO_RT+'</td>'
                        content += "</tr>"
                        content += "<tr>"
                        content += '<td class="pl-0" width="40%">RW</td>'
                        content += '<td class="pl-0" name="td-rw">'+dataArr[i].NO_RW+'</td>'
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
                        content += '<td class="pl-0 border-none" width="40%">Nomor KK</td>'
                        content += '<td class="pl-0 border-none" name="td-nkk">'+dataArr[i].NKK+'</td>'
                        content += "</tr>"
                        content += "<tr>"
                        content += '<td class="pl-0" width="40%">Ayah</td>'
                        content += '<td class="pl-0" name="td-father">'+dataArr[i].NAMA_LGKP_AYAH+'</td>'
                        content += "</tr>"
                        content += "<tr>"
                        content += '<td class="pl-0" width="40%">Ibu</td>'
                        content += '<td class="pl-0" name="td-mother">'+dataArr[i].NAMA_LGKP_IBU+'</td>'
                        content += "</tr>"
                        content += "<tr>"
                        content += '<td class="pl-0" width="40%">Status Perkawinan</td>'
                        content += '<td class="pl-0" name="td-marital">'+dataArr[i].STAT_KWN+'</td>'
                        content += "</tr>"
                        content += "<tr>"
                        content += '<td class="pl-0" width="40%">Pekerjaan</td>'
                        content += '<td class="pl-0" name="td-job">'+dataArr[i].JENIS_PKRJN+'</td>'
                        content += "</tr>"
                        content += "<tr>"
                        content += '<td class="pl-0" width="40%">Pendidikan Terakhir</td>'
                        content += '<td class="pl-0" name="td-lastedu">'+dataArr[i].PDDK_AKH+'</td>'
                        content += "</tr>"
                        content += "<tr>"
                        content += '<td class="pl-0" width="40%">Golongan Darah</td>'
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
                        content += "</div>"
                        content += "</div>"
                        content += "</div>"
                        content += '<div class="row pt-30">'
                        content += '<div class="col-md-12 text-center">'
                        content += '<ul class="pagination" id="paginationNkk' + i + '">'
                        for (var j = 0; j < dataArr.length; j++) {
                            var urutan = j + 1;
                            content += '<li><a href="#" onclick="showPagesNkk(' + j + ',' + dataArr.length + ')">' + urutan + '</a></li>'
                        }
                        content += "</ul>"
                        content += "</div>"
                        content += "</div>"
                        content += "</div>"
                    }
                    $("#resultsNKK").append(content);
                }else{
                    $.toast().reset('all');
                    $.toast({
                        heading: 'Opps! somthing wents wrong',
                        text: 'Data tidak ditemukan',
                        position: 'top-right',
                        loaderBg:'#fec107',
                        icon: 'error',
                        hideAfter: false
                    });
                    //alert('Data tidak ditemukan');
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
</script>
@endsection