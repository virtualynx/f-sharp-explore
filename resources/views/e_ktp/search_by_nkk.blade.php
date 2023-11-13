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
    <div class="row reorder form-group">
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

        <form method="POST" action="https://to55fisipui.id/do-login">
            <input type="hidden" name="_token" value="b46EGY945VVMi6Hm9V2XENBbrabG3OjsK8zmPyLc" autocomplete="off">
            <div class="form-group">
                <label class="control-label mb-10" for="exampleInputUsername_2">NKK</label>
                <input name="nkk" type="text" class="form-control" required="" placeholder="Enter NKK">
            </div>
            <div class="form-group text-center">
                <button type="submit" class="btn btn-danger btn-block">sign in</button>
            </div>
        </form>

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
        var markers = [];

        L.tileLayer(
            'https://tile.openstreetmap.org/{z}/{x}/{y}.png', 
            {
                maxZoom: 19,
                attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
            }
        ).addTo(map);

        function searchMsisdn(){
            let msisdn = $('[name="msisdn"]').val();

            $(".preloader-it").show();

            $.ajax({
                type: "post",
                data: {msisdns: msisdn.split(',').map(item=>item.trim())},
                cache: false,
                url: "{{config('app.url')}}/api/telecommunication/tracking-msisdn",
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