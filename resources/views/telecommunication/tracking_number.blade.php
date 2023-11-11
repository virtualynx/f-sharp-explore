@extends('_template_authorized')

@section('page-title')
  Tracking Number
@endsection

@section('page-head')
    <link 
        rel="stylesheet" 
        href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
        crossorigin=""
        />

    <script 
        src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
        crossorigin="">
    </script>
@endsection

@section('page-content')
    <!-- Title -->
    <div class="row heading-bg">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h5 class="txt-dark">Tracking Number</h5>
        </div>
        <!-- Breadcrumb -->
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li>Telekomunikasi</li>
                <li><a href="/telecommunication/tracking-number"><span>Tracking Number</span></a></li>
            </ol>
        </div>
        <!-- /Breadcrumb -->
    </div>
    <!-- /Title -->
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default card-view">
                <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-sm-12 p-0 m-0">
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon">Input Phone Number</div>
                                        <input type="text" id="example-input2-group2" name="msisdn" class="form-control" placeholder="Tracking Phone Number">
                                        <span class="input-group-btn">
                                            <button class="btn btn-primary btn-icon left-icon" onclick="searchMsisdn()"><i class="fa fa-search"></i><span class="btn-text">Tracking</span></button>
                                        </span> 
                                    </div>
                                 </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>			
        </div>	
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default card-view">
                <div class="panel-heading">
                    <div class="pull-left">
                        <h6 class="panel-title txt-dark">Maps</h6>
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
                                        <table class="table table-striped table-bordered mb-0">
                                            <tbody>
                                                <tr>
                                                    <td width="30%">MSISDN</td>
                                                    <td name="td-msisdn">[NO DATA]</td>
                                                </tr>
                                                <tr>
                                                    <td width="30%">IMSI</td>
                                                    <td name="td-imsi">[NO DATA]</td>
                                                </tr>
                                                <tr>
                                                    <td width="30%">IMEI</td>
                                                    <td name="td-imei">[NO DATA]</td>
                                                </tr>
                                                <tr>
                                                    <td width="30%">PROVIDER</td>
                                                    <td name="td-provider">[NO DATA]</td>
                                                </tr>
                                                <tr>
                                                    <td width="30%">ADDRESS</td>
                                                    <td name="td-address">[NO DATA]</td>
                                                </tr>
                                                <tr>
                                                    <td width="30%">PHONE</td>
                                                    <td name="td-phone">[NO DATA]</td>
                                                </tr>
                                                <tr>
                                                    <td width="30%">LATITUDE</td>
                                                    <td name="td-lat">[NO DATA]</td>
                                                </tr>
                                                <tr>
                                                    <td width="30%">LONGITUDE</td>
                                                    <td name="td-long">[NO DATA]</td>
                                                </tr>
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
        // setMap([-1.269160, 116.825264]);
        var map = L.map('map').setView([-1.269160, 116.825264], 16);
        var marker = null;

        L.tileLayer(
            'https://tile.openstreetmap.org/{z}/{x}/{y}.png', 
            {
                maxZoom: 19,
                attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
            }
        ).addTo(map);

        function searchMsisdn(){
            let msisdn = $('[name="msisdn"]').val();

            $.get(
                "{{config('app.url')}}/api/telecommunication/tracking-msisdn/"+msisdn,
                function(response, status){
                    if(response.status == 0){
                        $('[name="td-msisdn"]').html(response.data.msisdn);
                        $('[name="td-imsi"]').html(response.data.imsi);
                        $('[name="td-imei"]').html(response.data.imei);
                        $('[name="td-provider"]').html(response.data.provider);
                        $('[name="td-address"]').html(response.data.address);
                        $('[name="td-phone"]').html(response.data.phone);
                        $('[name="td-lat"]').html(response.data.lat);
                        $('[name="td-long"]').html(response.data.long);
                        
                        // map.panTo(new L.LatLng(response.data.lat, response.data.long));
                        map.flyTo([response.data.lat, response.data.long], 16);
                        if(marker!=null){
                            map.removeLayer(marker);
                        }
                        marker = L.marker([response.data.lat, response.data.long]).addTo(map);
                    }else{
                        alert(response.message);
                    }
                }
            );
        }

        function setMap(latLang){
            var map = L.map('map').setView(latLang, 16);

            L.tileLayer(
                'https://tile.openstreetmap.org/{z}/{x}/{y}.png', 
                {
                    maxZoom: 19,
                    attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
                }
            ).addTo(map);
        }

        // map.setView([51.505, -0.09], 16);
    </script>
@endsection