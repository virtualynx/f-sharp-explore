@extends('_template_authorized')

@section('page-title')
    Locate Number
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
                            <div class="col-sm-12 p-0 m-0">
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon">Input Phone Number</div>
                                        <input type="text" name="msisdn" id="msisdn" class="form-control" placeholder="6281211112222, 6281233334444" required />
                                        <span class="input-group-btn">
                                            <button class="btn btn-danger btn-icon left-icon" onclick="searchMsisdn()"><i class="fa fa-search"></i><span class="btn-text">Tracking</span></button>
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
        <div class="col-lg-12">
            <div class="panel panel-default card-view">
                <div class="panel-heading">
                    <div class="pull-left">
                        <h6 class="panel-title txt-dark">Detail Information And Maps</h6>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="table-wrap">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered mb-20">
                                            <thead>
                                                <tr>
                                                    <td colspan="2"><h6>Detail Information Target</h6></td>
                                                </tr>
                                            </thead>
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
                            <div class="col-lg-8">
                                <div id="map" style="height:600px;"></div>
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
        // setMap([-1.269160, 116.825264]);
        // var map = L.map('map').setView([-1.269160, 116.825264], 16);
        var map = L.map(
            "map",
            {
                center: [-6.268333, 106.955],
                crs: L.CRS.EPSG3857,
                zoom: 14,
                zoomControl: true,
                preferCanvas: false,
            }
        );
        var markers = [];

        L.tileLayer(
            'https://tile.openstreetmap.org/{z}/{x}/{y}.png', 
            {
                maxZoom: 19,
                attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>',
                "detectRetina": false, 
                "maxNativeZoom": 18, 
                "maxZoom": 18, 
                "minZoom": 0, 
                "noWrap": false, 
                "opacity": 1, 
                "subdomains": "abc", 
                "tms": false
            }
        ).addTo(map);

        function searchMsisdn(){
            let msisdn = $('[name="msisdn"]').val();

            $(".preloader-it").show();

            $.ajax({
                type: "post",
                data: {msisdns: msisdn.split(',').map(item=>item.trim())},
                cache: false,
                // url: "{{config('app.url')}}/api/telecommunication/tracking-msisdn",
                url: "{{route('api_locate_number')}}",
                dataType: "json",
                success: function (response, status) {
                    if(status == 'success' && response.status == 0){
                        $([document.documentElement, document.body]).animate({
                            scrollTop: $("#map").offset().top
                        }, 150);
                        
                        let datas = response.data;

                        if(datas.length > 0){
                            if(markers.length > 0){
                                markers.forEach(marker => {
                                    map.removeLayer(marker);
                                });

                                markers = [];
                            }
                            
                            let successDatas = [];
                            datas.forEach(data => {
                                if(data.status == 'success'){
                                    setData(data);
                                    let marker = L.marker([data.lat, data.long]).addTo(map);
                                    markers.push(marker);
                                    successDatas.push(data);
                                }
                            });
                            if(successDatas.length == 1){
                                map.flyTo(
                                    [successDatas[0].lat, successDatas[0].long], 
                                    16, 
                                    {
                                        animate: true,
                                        duration: 2 // in seconds
                                    }
                                );
                            }else if(successDatas.length > 1){
                                var group = new L.featureGroup(markers);
                                map.fitBounds(group.getBounds());
                            }
                        }
                    }else{
                        alert(response.message);
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