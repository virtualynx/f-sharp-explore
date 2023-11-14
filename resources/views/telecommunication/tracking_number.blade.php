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

    <link href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    
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
                            <div class="col-sm-3 mr-10 pull-right">
                                <button onclick="addNumber()" class="btn btn-success btn-icon left-icon" data-toggle="modal" data-target="#modal_add_edit_number"><i class="fa fa-search"></i><span class="btn-text">Add Number</span></button>
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
                
                <div class="table-wrap">
                    <div class="table-responsive">
                        <table name="tracked-table" class="table table-hover table-striped mb-0">
                            <thead>
                                <tr>
                                    <th>Actions</th>
                                    <th>Phone</th>
                                    <th>Name</th>
                                    <th>Group</th>
                                    <th>Status</th>
                                    <th>Success</th>
                                    <th>Failed</th>
                                    <th>Last Error</th>
                                    <th>Last Updated</th>
                                    <th>Cron Info</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- <tr>
                                    <td>
                                        <button><i class="fa-solid fa-xmark"></i></button>
                                        <button><i class="fa-solid fa-pen"></i></button>
                                        <button><i class="fa-solid fa-list"></i></i></button>
                                        <button><i class="fa-regular fa-calendar-days"></i></button>
                                        <button><i class="fa-solid fa-map-location-dot"></i></button>
                                        <button><i class="fa-solid fa-play"></i></button>
                                    </td>
                                    <td>6281122223333</td>
                                    <td>Andre</td>
                                    <td>Juragan</td>
                                    <td>
                                        <span class="label label-success">Running</span>
                                    </td>
                                    <td>15</td>
                                    <td>0</td>
                                    <td></td>
                                    <td>
                                        13 November 2023
                                    </td>
                                    <td>
                                        <button><i class="fa-solid fa-eye"></i></button>
                                    </td>
                                </tr> --}}
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>

    @include('telecommunication.tracking_number.modal_add_edit_number')
    @include('telecommunication.tracking_number.modal_tracking_log')
@endsection

@section('page-footer')
    <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script>

    <script>
        var table_tracked = null;
        var table_log = null;
        var map_log = null;
        var marker_log = null;

        $(function(){
            table_tracked = $('[name="tracked-table"]').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ url('/telecommunication/tracking-number') }}",
                columns: [
                    {data: 'action', orderable: false, searchable: false},
                    {data: 'msisdn'},
                    {data: 'name'},
                    {data: 'group'},
                    {data: 'status'},
                    {data: 'success_count'},
                    {data: 'failed_count'},
                    {data: 'last_error'},
                    {data: 'last_tracked'},
                    {data: 'cron_info'},
                ]
            });

            // $('[name="btn_add_number"]').click(function(){
            //     $data = $('[name="form_add_number"]').serialize();
            //     console.log($data);
            // });
            $('[name="btn_save_number"]').click(addOrSaveNumber);

            map_log = L.map(
                "map_log",
                {
                    center: [-6.268333, 106.955],
                    crs: L.CRS.EPSG3857,
                    zoom: 14,
                    zoomControl: true,
                    preferCanvas: false,
                }
            );

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
            ).addTo(map_log);
        });

        function addNumber(){
            $('[name="mode"]').val('add');
        }

        function editNumber(msisdn){
            $('[name="mode"]').val('edit');

            $(".preloader-it").show();

            $.ajax({
                type: "get",
                data: {msisdn: msisdn},
                cache: false,
                url: "{{ route('api_tracked_number_get') }}",
                dataType: "json",
                success: function (response, status) {
                    if(status == 'success' && response.status == 0){
                        let data = response.data;
                        $('[name="phone"]').val(data.msisdn);
                        $('[name="name"]').val(data.name);
                        $('[name="group"]').val(data.group);
                        $('[name="cron_minute"]').val(data.cron_minute);
                        $('[name="cron_hour"]').val(data.cron_hour);
                        $('[name="cron_dayofmonth"]').val(data.cron_dayofmonth);
                        $('[name="cron_month"]').val(data.cron_month);
                        $('[name="cron_dayofweek"]').val(data.cron_dayofweek);
                    }
                },
                error: function (request, error) {
                    console.log(arguments);
                    alert(" Can't do because: " + error);
                },
                complete: function(){
                    $(".preloader-it").hide();
                }
            });
        }

        function deleteNumber(msisdn){
            if (confirm('Delete number '+msisdn+' from tracking?')) {
                $(".preloader-it").show();

                $.ajax({
                    type: "delete",
                    data: {msisdn: msisdn},
                    cache: false,
                    url: "{{ route('api_tracked_number_delete') }}",
                    dataType: "json",
                    success: function (response, status) {
                        if(status == 'success' && response.status == 0){
                            alert('Hapus nomor berhasil');
                        }
                    },
                    error: function (request, error) {
                        console.log(arguments);
                        alert(" Can't do because: " + error);
                    },
                    complete: function(){
                        $(".preloader-it").hide();
                        table_tracked.draw();
                    }
                });
            }
        }

        function addOrSaveNumber(a){
            let data = $('[name="form_add_edit_number"]').serialize();

            $(".preloader-it").show();

            $.ajax({
                type: "post",
                data: $('[name="form_add_edit_number"]').serialize(),
                cache: false,
                url: "{{ route('api_tracked_number_save') }}",
                dataType: "json",
                success: function (response, status) {
                    if(status == 'success'){
                        alert('Penyimpanan berhasil');
                    }
                },
                error: function (request, error) {
                    console.log(arguments);
                    alert(" Can't do because: " + error);
                },
                complete: function(){
                    $(".preloader-it").hide();
                    // $('[name="modal_add_edit_number"]').hide();
                    $('[name="modal_add_edit_number"]').modal('hide');
                    table_tracked.draw();
                }
            });
        }

        function trackingLog(msisdn){
            if(table_log !== null){
                table_log.clear().destroy();
            }

            table_log = $('[name="table_log"]').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{config('app.url')}}/api/telecommunication/tracking-log-datatable/"+msisdn,
                columns: [
                    // {data: 'action', orderable: false, searchable: false},
                    {data: 'time'},
                    {data: 'see_button'},
                    {data: 'lat_long'},
                    {data: 'status'},
                ]
            });
        }

        function seeCoordinateOnMap(lat, long){
            if(map_log !== null){
                // map_log.off();
                // map_log.remove();
            }

            if(marker_log !== null){
                map_log.removeLayer(marker_log);
            }

            marker_log = L.marker([lat, long]).addTo(map_log);

            // map_log.flyTo(
            //     [lat, long], 
            //     16, 
            //     {
            //         animate: true,
            //         duration: 2 // in seconds
            //     }
            // );

            map_log.panTo([lat, long]);
        }
    </script>
@endsection