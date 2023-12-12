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
                                        <div class="input-group-addon">Search</div>
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

        if(!nkk){
            $.toast().reset('all');
            $.toast({
                heading: 'Warning',
                text: 'NKK harus diisi',
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
                nkk: nkk
            },
            cache: false,
            url: "{{config('app.url')}}/api/e-ktp/search_by_nkk",
            dataType: "json",
            success: function(response, status) {
                var content = "";
                var dataArr = response.data;
                var dataArrDob = [];
                $('.panel-title').html('Data Dukcapil');
                $("#resultsNKK").html('');
                if (dataArr !== null) {
                    for (var i = 0; i < dataArr.length; i++) {
                        // Parse the original date string into a Date object
                        var originalDate = new Date(dataArr[i].TGL_LHR);

                        // Get day, month, and year from the Date object
                        var day = originalDate.getDate();
                        var month = originalDate.getMonth() + 1; // Month is zero-based, so add 1
                        var year = originalDate.getFullYear();

                        // Pad single-digit day or month with a leading zero
                        day = day < 10 ? '0' + day : day;
                        month = month < 10 ? '0' + month : month;

                        // Combine the formatted values with dashes
                        var formattedDate = day + '-' + month + '-' + year;
                        dataArrDob.push(formattedDate);

                    }
                    setData(dataArr, dataArrDob);

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

    function setData(dataArr, tanggalLahir) {
        $.ajax({
            type: "post",
            data: {
                dob: tanggalLahir,
                type: "nkk"
            },
            // data: $('[name="search_by_nik_form"]').serialize(),
            cache: false,
            // url: "{{config('app.url')}}/api/e-ktp/search-by-nik",
            url: "{{config('app.url')}}/api/e-ktp/search_by_dob",
            dataType: "json",
            success: function(response, status) {
                

                var dataArrZodiac = response.data;
                if (status == 'success' && response.status == 0) {
                    var content = "";
                    for (var i = 0; i < dataArr.length; i++) {
                        var imageView = "data:image/jpg;base64," + dataArr[i].FOTO;
                        var displayDiv = "none";
                        if (i == 0) {
                            displayDiv = "block";
                        }
                        content += '<div class="panel-body pt-5" style="display:' + displayDiv + ';" id="subresultnkk' + i + '">'
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
                        content += '<table class="table table-hover mb-0">'
                        content += "<tbody>"
                        content += "<tr>"
                        content += '<td class="border-none pl-0" width="50%"><span class="txt-dark weight-500">NIK</span></td>'
                        content += '<td class="border-none pl-0" name="td-nik">' + dataArr[i].NIK + '</td>'
                        content += "</tr>"
                        content += "<tr>"
                        content += '<td class="pl-0" width="50%"><span class="txt-dark weight-500">Nama</span></td>'
                        content += '<td class="pl-0" name="td-name">' + dataArr[i].NAMA_LGKP + '</td>'
                        content += "</tr>"
                        content += "<tr>"
                        content += '<td class="pl-0" width="50%"><span class="txt-dark weight-500">Tempat/Tgl Lahir</span></td>'
                        content += '<td class="pl-0" name="td-ttl">' + dataArr[i].TMPT_LHR + ', ' + dataArr[i].TGL_LHR + ' </td>'
                        content += "</tr>"
                        content += "<tr>"
                        content += '<td class="pl-0" width="50%"><span class="txt-dark weight-500">Jenis Kelamin</span></td>'
                        content += '<td class="pl-0" name="td-sex">' + dataArr[i].JENIS_KLMIN + '</td>'
                        content += "</tr>"
                        content += "<tr>"
                        content += '<td class="pl-0" width="50%"><span class="txt-dark weight-500">Agama</span></td>'
                        content += '<td class="pl-0" name="td-religion">' + dataArr[i].AGAMA + '</td>'
                        content += "</tr>"
                        content += "<tr>"
                        content += '<td class="pl-0" width="50%" style="vertical-align: top;"><span class="txt-dark weight-500">Alamat</span></td>'
                        content += '<td class="pl-0" name="td-address">' + dataArr[i].ALAMAT + '</td>'
                        content += "</tr>"
                        content += "<tr>"
                        content += '<td class="pl-0" width="50%"><span class="txt-dark weight-500">RT / RW</span></td>'
                        content += '<td class="pl-0" name="td-rt-rw">' + dataArr[i].NO_RT + ' / ' + dataArr[i].NO_RW + ' </td>'
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
                        content += '<table class="table table-hover mb-0">'
                        content += "<tbody>"
                        content += " <tr>"
                        content += '<td class="pl-0 border-none" width="50%"><span class="txt-dark weight-500">Nomor KK</span></td>'
                        content += '<td class="pl-0 border-none" name="td-nkk">' + dataArr[i].NKK + '</td>'
                        content += "</tr>"
                        content += "<tr>"
                        content += '<td class="pl-0" width="50%"><span class="txt-dark weight-500">Ayah</span></td>'
                        content += '<td class="pl-0" name="td-father">' + dataArr[i].NAMA_LGKP_AYAH + '</td>'
                        content += "</tr>"
                        content += "<tr>"
                        content += '<td class="pl-0" width="50%"><span class="txt-dark weight-500">Ibu</span></td>'
                        content += '<td class="pl-0" name="td-mother">' + dataArr[i].NAMA_LGKP_IBU + '</td>'
                        content += "</tr>"
                        content += "<tr>"
                        content += '<td class="pl-0" width="50%"><span class="txt-dark weight-500">Status Perkawinan</span></td>'
                        content += '<td class="pl-0" name="td-marital">' + dataArr[i].STAT_KWN + '</td>'
                        content += "</tr>"
                        content += "<tr>"
                        content += '<td class="pl-0" width="50%"><span class="txt-dark weight-500">Pekerjaan</span></td>'
                        content += '<td class="pl-0" name="td-job">' + dataArr[i].JENIS_PKRJN + '</td>'
                        content += "</tr>"
                        content += "<tr>"
                        content += '<td class="pl-0" width="50%"><span class="txt-dark weight-500">Pendidikan Terakhir</span></td>'
                        content += '<td class="pl-0" name="td-lastedu">' + dataArr[i].PDDK_AKH + '</td>'
                        content += "</tr>"
                        content += "<tr>"
                        content += '<td class="pl-0" width="50%"><span class="txt-dark weight-500">Golongan Darah</span></td>'
                        content += '<td class="pl-0" name="td-bloodtype">' + dataArr[i].GOL_DARAH + '</td>'
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
                        content += "</br>"
                        content += '<div class="row">'
                        content += '<div class="col-lg-12">'
                        content += '<div class="card mb-4">'
                        content += '<div class="card-body" id="bodyZodiac" name="bodyZodiac">'
                        content += '<div class="row">'
                        content += '<div class="col-sm-3">'
                        content += '<p class="mb-0"><span class="txt-dark weight-500">Zodiac</span></p>'
                        content += '</div>'
                        content += '<div class="col-sm-9">'
                        content += '<p class="text-muted mb-0">' + dataArrZodiac[i][0].Zodiak.zodiak + '</p>'
                        content += '</div>'
                        content += '</div>'
                        content += '<hr style="border-top:1px solid #dedede;">'
                        content += '<div class="row">'
                        content += '<div class="col-sm-3">'
                        content += '<p class="mb-0"><span class="txt-dark weight-500">Profil</span></p>'
                        content += '</div>'
                        content += '<div class="col-sm-9">'
                        content += '<p class="text-muted mb-0">' + dataArrZodiac[i][0].Zodiak.profil + '</p>'
                        content += '</div>'
                        content += '</div>'
                        content += '<hr style="border-top:1px solid #dedede;">'
                        content += '<div class="row">'
                        content += '<div class="col-sm-3">'
                        content += '<p class="mb-0"><span class="txt-dark weight-500">Weton</span></p>'
                        content += '</div>'
                        content += '<div class="col-sm-9">'
                        content += '<p class="text-muted mb-0">' + dataArrZodiac[i][0].Weton.weton + '</p>'
                        content += '</div>'
                        content += '</div>'
                        content += '<hr style="border-top:1px solid #dedede;">'
                        content += '<div class="row">'
                        content += '<div class="col-sm-3">'
                        content += '<p class="mb-0"><span class="txt-dark weight-500">Karakter Hari</span></p>'
                        content += '</div>'
                        content += '<div class="col-sm-9">'
                        content += '<p class="text-muted mb-0">' + dataArrZodiac[i][0].Weton.karakter_hari + '</p>'
                        content += '</div>'
                        content += '</div>'
                        content += '<hr style="border-top:1px solid #dedede;">'
                        content += '</div>'
                        content += '</div>'
                        content += '</div>'
                        content += '</div>'
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
</script>
@endsection