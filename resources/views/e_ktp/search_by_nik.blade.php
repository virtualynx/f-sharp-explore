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
                                            <div class="input-group-addon">Search NIK</div>
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
                                    <table class="table table-hover mb-0" id="tableDataLeak" name="tableDataLeak">
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
@endsection

@section('page-footer')
    <script>
        function searchData(){
            let nik = $('[name="nik"]').val();

            $(".preloader-it").show();

            $.ajax({
                type: "post",
                data: {nik: $('[name="nik"]').val()},
                // data: $('[name="search_by_nik_form"]').serialize(),
                cache: false,
                // url: "{{config('app.url')}}/api/e-ktp/search-by-nik",
                url: "{{route('api_ektp_search_by_nik')}}",
                dataType: "json",
                success: function (response, status) {
                    if(status == 'success' && response.status == 0){
                        setData(response.data);
                    }else{
                        $.toast().reset('all');
                        $.toast({
                            heading: 'Opps! somthing wents wrong',
                            text: response.message,
                            position: 'top-right',
                            loaderBg:'#fec107',
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

        function setData(data){
            $('[name="photo"]').attr('src', 'data:image/png;base64,'+data.FOTO);

            $('[name="td-name"]').html(data.NAMA_LGKP);
            $('[name="td-nik"]').html(data.NIK);
            $('[name="td-sex"]').html(data.JENIS_KLMIN);
            $('[name="td-job"]').html(data.JENIS_PKRJN);
            $('[name="td-marital"]').html(data.STAT_KWN);
            $('[name="td-religion"]').html(data.AGAMA);
            $('[name="td-father"]').html(data.NAMA_LGKP_AYAH);
            $('[name="td-mother"]').html(data.NAMA_LGKP_IBU);
            $('[name="td-address"]').html(data.ALAMAT);
            $('[name="td-rt-rw"]').html(data.NO_RT+' / '+data.NO_RW);
            // $('[name="td-rt"]').html(data.NO_RT);
            // $('[name="td-rw"]').html(data.NO_RW);
            $('[name="td-nkk"]').html(data.NKK);
            $('[name="td-ttl"]').html(data.TMPT_LHR+', '+data.TGL_LHR);
            $('[name="td-lastedu"]').html(data.PDDK_AKH);
            $('[name="td-bloodtype"]').html(data.GOL_DARAH);
        }
    </script>
@endsection