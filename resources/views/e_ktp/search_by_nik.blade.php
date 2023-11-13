@extends('_template_authorized')

@section('page-title')
  Search By NIK
@endsection

@section('page-head')
@endsection

@section('page-content')
    {{-- <div class="row reorder form-group">
        <div class="col-md-3 cold-xs-12">
            <label class="input-group-addon text-left">Input Phone Number</label>
        </div>
        <div class="col-md-6 cold-xs-12">
            <input type="text" id="example-input2-group2" name="msisdn" class="form-control" placeholder="6281211112222, 6281233334444">
        </div>
        <div class="col-md-3 cold-xs-12">
            <span class="input-group-btn">
                <button class="btn btn-primary btn-icon left-icon" onclick="searchMsisdn()"><i class="fa fa-search"></i><span class="btn-text">Tracking</span></button>
            </span> 
        </div>
    </div> --}}
    
    <div class="row">
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
    </div>

    <div class="row">
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
                    <!-- End Panel Overlay-->
                    {{-- <div class="panel-body">
                        <div id="map" style="height:600px;"></div>
                    </div> --}}
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
                cache: false,
                // url: "{{config('app.url')}}/api/telecommunication/tracking-msisdn",
                url: "{{route('api_ektp_searchbynik')}}",
                dataType: "json",
                success: function (response, status) {
                    if(status == 'success' && response.status == 0){
                        let data = response.data;
                        setData(response.data.id_data);
                    }else{
                        alert(response.message);
                    }
                    $(".preloader-it").hide();
                },
                error: function (request, error) {
                    console.log(arguments);
                    alert(" Can't do because: " + error);
                    $(".preloader-it").hide();
                }
            });
        }

        function setData(data){
            $('[name="photo"]').attr('src', 'data:image/png;base64,'+data.FOTO);

            $('[name="td-name"]').html(data.NAMA_LGKP);
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