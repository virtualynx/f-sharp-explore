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
                                                <button type="button" class="btn btn-danger btn-icon left-icon" onclick="searchData()"><i class="fa fa-search"></i> <span class="btn-text">Search</span></button>
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
                <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="item-big">
                                    <div class="carousel slide">
                                        <div class="carousel-inner">
                                           <div class="item active"><img name="photo" src="{{asset('dist/img/gallery/mock1.jpg')}}" alt="Image Personal Dukcapil" width="100%"></div>
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
                                                            <td class="border-none pl-0" width="40%">NIK</td>
                                                            <td class="border-none pl-0" name="td-nik">[No Data]</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="pl-0" width="40%">Jenis Kelamin</td>
                                                            <td class="pl-0" name="td-sex">[No Data]</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="pl-0" width="40%">Pekerjaan</td>
                                                            <td class="pl-0" name="td-job">[No Data]</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="pl-0" width="40%">Marital</td>
                                                            <td class="pl-0" name="td-marital">[No Data]</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="pl-0" width="40%">Agama</td>
                                                            <td class="pl-0" name="td-religion">[No Data]</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="pl-0" width="40%">Ayah</td>
                                                            <td class="pl-0" name="td-father">[No Data]</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="pl-0" width="40%">Ibu</td>
                                                            <td class="pl-0" name="td-mother">[No Data]</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="pl-0" width="40%">Nomor KK</td>
                                                            <td class="pl-0" name="td-nkk">[No Data]</td>
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
                                                            <td class="border-none pl-0" width="40%">Alamat</td>
                                                            <td class="border-none pl-0" name="td-address">[No Data]</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="pl-0" width="40%">RT</td>
                                                            <td class="pl-0" name="td-rt">[No Data]</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="pl-0" width="40%">RW</td>
                                                            <td class="pl-0" name="td-rw">[No Data]</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="pl-0" width="40%">Tempat/Tgl Lahir</td>
                                                            <td class="pl-0" name="td-ttl">[No Data]</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="pl-0" width="40%">Pendidikan Terakhir</td>
                                                            <td class="pl-0" name="td-lastedu">[No Data]</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="pl-0" width="40%">Golongan Darah</td>
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
                error: function (request, error) {
                    console.log(arguments);
                    alert(" Can't do because: " + error);
                },
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
            $('[name="td-rt"]').html(data.NO_RT);
            $('[name="td-rw"]').html(data.NO_RW);
            $('[name="td-nkk"]').html(data.NKK);
            $('[name="td-ttl"]').html(data.TMPT_LHR+', '+data.TGL_LHR);
            $('[name="td-lastedu"]').html(data.PDDK_AKH);
            $('[name="td-bloodtype"]').html(data.GOL_DARAH);
        }
    </script>
@endsection