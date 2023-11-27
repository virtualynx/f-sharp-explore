@extends('_template_authorized')

@section('page-title')
Search By NIK
@endsection

@section('page-head')
@endsection

@section('page-content')
<!-- Search bar -->
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-default card-view">
            <div class="panel-wrapper collapse in">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-sm-12 p-0 m-0">
                            <form name="search_by_nik_form" method="POST" action="{{ url('api/e-ktp/search-by-nik') }}">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon">Search</div>
                                        <input type="text" name="nik" id="nik" class="form-control" placeholder="Enter NIK" required />
                                        <span class="input-group-btn">
                                            <button type="button" class="btn btn-danger btn-icon left-icon" onclick="searchData()"><i class="fa fa-search"></i> <span class="btn-text"> Search</span></button>
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
                    <h6 class="panel-title txt-dark">Data Dukcapil</h6>
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
                                                        <td class="border-none pl-0" name="td-nik">[No Data]</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="pl-0" width="50%"><span class="txt-dark weight-500">Nama</span></td>
                                                        <td class="pl-0" name="td-name">[No Data]</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="pl-0" width="50%"><span class="txt-dark weight-500">Tempat/Tgl Lahir</span></td>
                                                        <td class="pl-0" name="td-ttl">[No Data]</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="pl-0" width="50%"><span class="txt-dark weight-500">Jenis Kelamin</span></td>
                                                        <td class="pl-0" name="td-sex">[No Data]</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="pl-0" width="50%"><span class="txt-dark weight-500">Agama</span></td>
                                                        <td class="pl-0" name="td-religion">[No Data]</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="pl-0" width="50%" style="vertical-align: top;"><span class="txt-dark weight-500">Alamat</span></td>
                                                        <td class="pl-0" name="td-address">[No Data]</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="pl-0" width="50%"><span class="txt-dark weight-500">RT / RW</span></td>
                                                        <td class="pl-0" name="td-rt-rw">[No Data]</td>
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
                                                        <td class="pl-0 border-none" name="td-nkk">[No Data]</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="pl-0" width="50%"><span class="txt-dark weight-500">Ayah</span></td>
                                                        <td class="pl-0" name="td-father">[No Data]</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="pl-0" width="50%"><span class="txt-dark weight-500">Ibu</span></td>
                                                        <td class="pl-0" name="td-mother">[No Data]</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="pl-0" width="50%"><span class="txt-dark weight-500">Status Perkawinan</span></td>
                                                        <td class="pl-0" name="td-marital">[No Data]</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="pl-0" width="50%"><span class="txt-dark weight-500">Pekerjaan</span></td>
                                                        <td class="pl-0" name="td-job">[No Data]</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="pl-0" width="50%"><span class="txt-dark weight-500">Pendidikan Terakhir</span></td>
                                                        <td class="pl-0" name="td-lastedu">[No Data]</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="pl-0" width="50%"><span class="txt-dark weight-500">Golongan Darah</span></td>
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
                            </div>
                            <br />
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="card mb-4">
                                        <div class="card-body" id="bodyZodiac" name="bodyZodiac">
                                            <!-- <div class="row">
                                                <div class="col-sm-3">
                                                    <p class="mb-0"><span class="txt-dark weight-500">Zodiac</span></p>
                                                </div>
                                                <div class="col-sm-9">
                                                    <p class="text-muted mb-0" name="td-zodiac">[No Data]</p>
                                                </div>
                                            </div>
                                            <hr style="border-top:1px solid #dedede;">
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <p class="mb-0"><span class="txt-dark weight-500">Profil<span class="txt-dark weight-500"></p>
                                                </div>
                                                <div class="col-sm-9">
                                                    <p class="text-muted mb-0" name="td-profil">[No Data]</p>
                                                </div>
                                            </div>
                                            <hr style="border-top:1px solid #dedede;">
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <p class="mb-0"><span class="txt-dark weight-500">Weton<span class="txt-dark weight-500"></p>
                                                </div>
                                                <div class="col-sm-9">
                                                    <p class="text-muted mb-0" name="td-weton">[No Data]</p>
                                                </div>
                                            </div>
                                            <hr style="border-top:1px solid #dedede;">
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <p class="mb-0"><span class="txt-dark weight-500">Karakter Hari<span class="txt-dark weight-500"></p>
                                                </div>
                                                <div class="col-sm-9">
                                                    <p class="text-muted mb-0" name="td-weton-karakterhari">[No Data]</p>
                                                </div>
                                            </div>
                                            <hr style="border-top:1px solid #dedede;"> -->
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
        function searchData() {
            let nik = $('[name="nik"]').val();

            if(!nik){
                $.toast().reset('all');
                $.toast({
                    heading: 'Warning',
                    text: 'NIK harus diisi',
                    position: 'top-right',
                    loaderBg: '#fec107',
                    icon: 'error',
                    hideAfter: false
                });
                return;
            }

            post({
                data: {
                    nik: $('[name="nik"]').val()
                },
                // data: $('[name="search_by_nik_form"]').serialize(),
                // url: "{{config('app.url')}}/api/e-ktp/search-by-nik",
                url: "{{route('api_ektp_search_by_nik')}}",
                success: function(response, status) {
                   
                    if (status == 'success' && response.status == 0) {
                        // Parse the original date string into a Date object
                        var originalDate = new Date(response.data.TGL_LHR);

                        // Get day, month, and year from the Date object
                        var day = originalDate.getDate();
                        var month = originalDate.getMonth() + 1; // Month is zero-based, so add 1
                        var year = originalDate.getFullYear();

                        // Pad single-digit day or month with a leading zero
                        day = day < 10 ? '0' + day : day;
                        month = month < 10 ? '0' + month : month;

                        // Combine the formatted values with dashes
                        var formattedDate = day + '-' + month + '-' + year;
                        setData(response.data, formattedDate);
                    } else {
                        myAlert(response.message, 'error');
                    }
                },
            });
        }

        function searchByKarakter(tanggalLahir) {

        }

        function setData(data, tanggalLahir) {
            var dataArrDob = [];
            dataArrDob.push(tanggalLahir);
            
            post({
                data: {
                    dob: dataArrDob,
                    type: "nik"
                },
                // data: $('[name="search_by_nik_form"]').serialize(),
                // url: "{{config('app.url')}}/api/e-ktp/search-by-nik",
                url: "{{config('app.url')}}/api/e-ktp/search_by_dob",
                success: function(response, status) {
                    if (status == 'success' && response.status == 0) {
                        $('[name="photo"]').attr('src', 'data:image/png;base64,' + data.FOTO);

                        $('[name="td-name"]').html(data.NAMA_LGKP);
                        $('[name="td-nik"]').html(data.NIK);
                        $('[name="td-sex"]').html(data.JENIS_KLMIN);
                        $('[name="td-job"]').html(data.JENIS_PKRJN);
                        $('[name="td-marital"]').html(data.STAT_KWN);
                        $('[name="td-religion"]').html(data.AGAMA);
                        $('[name="td-father"]').html(data.NAMA_LGKP_AYAH);
                        $('[name="td-mother"]').html(data.NAMA_LGKP_IBU);
                        $('[name="td-address"]').html(data.ALAMAT);
                        $('[name="td-rt-rw"]').html(data.NO_RT + ' / ' + data.NO_RW);
                        // $('[name="td-rt"]').html(data.NO_RT);
                        // $('[name="td-rw"]').html(data.NO_RW);
                        $('[name="td-nkk"]').html(data.NKK);
                        $('[name="td-ttl"]').html(data.TMPT_LHR + ', ' + data.TGL_LHR);
                        $('[name="td-lastedu"]').html(data.PDDK_AKH);
                        $('[name="td-bloodtype"]').html(data.GOL_DARAH);

                        var dataArrRes = response.data;
                        var content = "";
                        var titles = ["Zodiac", "Profil", "Weton", "Karakter Hari"];
                        for (var i = 0; i < dataArrRes.length; i++) {
                            content += '<div class="row">'
                            content += '<div class="col-sm-3">'
                            content += '<p class="mb-0"><span class="txt-dark weight-500">Zodiac</span></p>'
                            content += '</div>'
                            content += '<div class="col-sm-9">'
                            content += '<p class="text-muted mb-0" name="td-zodiac">'+dataArrRes[i][0].Zodiak.zodiak+'</p>'
                            content += '</div>'
                            content += '</div>'
                            content += '</div>'
                            content += '</div>'
                            content += '<hr style="border-top:1px solid #dedede;">'
                            content += ' <div class="row">'
                            content += '<div class="col-sm-3">'
                            content += '<p class="mb-0"><span class="txt-dark weight-500">Profil</span></p>'
                            content += '</div>'
                            content += '<div class="col-sm-9">'
                            content += '<p class="text-muted mb-0" name="td-zodiac">'+dataArrRes[i][0].Zodiak.profil+'</p>'
                            content += '</div>'
                            content += '</div>'
                            content += '</div>'
                            content += '</div>'
                            content += '<hr style="border-top:1px solid #dedede;">'
                            content += ' <div class="row">'
                            content += '<div class="col-sm-3">'
                            content += '<p class="mb-0"><span class="txt-dark weight-500">Weton</span></p>'
                            content += '</div>'
                            content += '<div class="col-sm-9">'
                            content += '<p class="text-muted mb-0" name="td-zodiac">'+dataArrRes[i][0].Weton.weton+'</p>'
                            content += '</div>'
                            content += '</div>'
                            content += '</div>'
                            content += '</div>'
                            content += '<hr style="border-top:1px solid #dedede;">'
                            content += ' <div class="row">'
                            content += '<div class="col-sm-3">'
                            content += '<p class="mb-0"><span class="txt-dark weight-500">Karakter Hari</span></p>'
                            content += '</div>'
                            content += '<div class="col-sm-9">'
                            content += '<p class="text-muted mb-0" name="td-zodiac">'+dataArrRes[i][0].Weton.karakter_hari+'</p>'
                            content += '</div>'
                            content += '</div>'
                            content += '</div>'
                            content += '</div>'
                            content += '<hr style="border-top:1px solid #dedede;">'
                        }
                       
                        $("#bodyZodiac").append(content);

                    } else {
                        myAlert(response.message, 'error');
                        // alert(response.message);
                    }
                },
            });
        }
    </script>
    @endsection