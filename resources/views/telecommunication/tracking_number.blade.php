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
                                <button class="btn btn-success btn-icon left-icon" data-toggle="modal" data-target="#modal-add-number"><i class="fa fa-search"></i><span class="btn-text">Add Number</span></button>
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
                                </tr>
                                <tr>
                                    <td>
                                        <button><i class="fa-solid fa-xmark"></i></button>
                                        <button><i class="fa-solid fa-pen"></i></button>
                                        <button><i class="fa-solid fa-list"></i></i></button>
                                        <button><i class="fa-regular fa-calendar-days"></i></button>
                                        <button><i class="fa-solid fa-map-location-dot"></i></button>
                                        <button><i class="fa-solid fa-play"></i></button>
                                    </td>
                                    <td>6281133335555</td>
                                    <td>Taulany</td>
                                    <td>Artis</td>
                                    <td>
                                        <span class="label label-danger">Stopped</span>
                                    </td>
                                    <td>15</td>
                                    <td>0</td>
                                    <td>Can't track number</td>
                                    <td>
                                        11 November 2023
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

    <!-- Modal -->
    <div class="modal fade" id="modal-add-number" role="dialog">
        <div class="modal-dialog">
    
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Number</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="#" name="form_add_cron">
                        <div class="row">
                            <div class="form-group ml-5 mr-5">
                                <label class="control-label mb-10" for="exampleInputUsername_2">Phone</label>
                                <input name="phone" type="text" class="form-control" placeholder="Enter phone">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group ml-5 mr-5">
                                <label class="pull-left control-label mb-10" for="exampleInputpwd_2">Name</label>
                                <input name="name" type="text" class="form-control" placeholder="Enter name">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group ml-5 mr-5">
                                <label class="pull-left control-label mb-10" for="exampleInputpwd_2">Group</label>
                                <input name="group" type="text" class="form-control" placeholder="Enter group">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <label class="pull-left control-label mb-10" for="exampleInputpwd_2">Minutes</label>
                                    <input name="cron_minute" value="*" type="text" class="form-control" placeholder="* or 0-59">
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <label class="pull-left control-label mb-10" for="exampleInputpwd_2">Hour</label>
                                    <input name="cron_hour" value="*" type="text" class="form-control" placeholder="* or 0-23">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="pull-left control-label mb-10" for="exampleInputpwd_2">Day of Month</label>
                                    <input name="cron_day_of_month" value="*" type="text" class="form-control" placeholder="* or 1-31">
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group">  
                                    <label class="pull-left control-label mb-10" for="exampleInputpwd_2">Month</label>
                                    <input name="cron_month" value="*" type="text" class="form-control" placeholder="* or 1-12">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="pull-left control-label mb-10" for="exampleInputpwd_2">Day Of Week</label>
                                    <select class="form-control" id="sel1" name="select_day_of_week">
                                        <option value="*">*</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                        <option value="7">7</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" onclick="addNumber()" class="btn btn-primary">Save</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('page-footer')
    <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script>

    <script>
        $(document).ready(function(){
            $("button").click(function(){
                $("p").slideToggle();
            });
        });
        
        // <th>Actions</th>
        // <th>Phone</th>
        // <th>Name</th>
        // <th>Group</th>
        // <th>Status</th>
        // <th>Success</th>
        // <th>Failed</th>
        // <th>Last Error</th>
        // <th>Last Updated</th>
        // <th>Cron Info</th>

        $(function() {
            var table = $('[name="tracked-table"]').DataTable({
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
        });

        function getTrackedNumbers(){
            $(".preloader-it").show();

            $.ajax({
                type: "get",
                data: {},
                cache: false,
                url: "{{route('api_tracked_number_list')}}",
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

        function addTrackedNumberRow(data){
            let template = `
                <tr>
                    <td>
                        <button><i class="fa-solid fa-xmark"></i></button>
                        <button><i class="fa-solid fa-pen"></i></button>
                        <button><i class="fa-solid fa-list"></i></i></button>
                        <button><i class="fa-regular fa-calendar-days"></i></button>
                        <button><i class="fa-solid fa-map-location-dot"></i></button>
                        <button><i class="fa-solid fa-play"></i></button>
                    </td>
                    <td>{msisdn}</td>
                    <td>{name}</td>
                    <td>{group}</td>
                    <td>
                        <span class="label label-success">{status}</span>
                    </td>
                    <td>{success}</td>
                    <td>{failed}</td>
                    <td>{last_error}</td>
                    <td>
                        {last_tracked}
                    </td>
                    <td>
                        <button><i class="fa-solid fa-eye"></i></button>
                    </td>
                </tr>
            `;


        }

        function addNumber(){
            // $('#myModal').on('shown.bs.modal', function () {
            //     $('#myInput').trigger('focus');
            // });
            // $('#myModal').show();

            // $(".preloader-it").show();

            // $.ajax({
            //     type: "post",
            //     data: {msisdns: msisdn.split(',').map(item=>item.trim())},
            //     cache: false,
            //     url: "{{config('app.url')}}/api/telecommunication/tracking-msisdn",
            //     dataType: "json",
            //     success: function (response, status) {
            //         if(status == 'success' && response.status == 0){
            //             $([document.documentElement, document.body]).animate({
            //                 scrollTop: $("#map").offset().top
            //             }, 150);
                        
            //             let datas = response.data;

            //             if(datas.length > 0){
            //                 if(markers.length > 0){
            //                     markers.forEach(marker => {
            //                         map.removeLayer(marker);
            //                     });

            //                     markers = [];
            //                 }
                            
            //                 let successDatas = [];
            //                 datas.forEach(data => {
            //                     if(data.status == 'success'){
            //                         setData(data);
            //                         let marker = L.marker([data.lat, data.long]).addTo(map);
            //                         markers.push(marker);
            //                         successDatas.push(data);
            //                     }
            //                 });
            //                 if(successDatas.length == 1){
            //                     map.flyTo(
            //                         [successDatas[0].lat, successDatas[0].long], 
            //                         16, 
            //                         {
            //                             animate: true,
            //                             duration: 2 // in seconds
            //                         }
            //                     );
            //                 }else if(successDatas.length > 1){
            //                     var group = new L.featureGroup(markers);
            //                     map.fitBounds(group.getBounds());
            //                 }
            //             }
            //         }else{
            //             alert(response.message);
            //         }
            //         $(".preloader-it").hide();
            //     },
            //     error: function (request, error) {
            //         console.log(arguments);
            //         alert(" Can't do because: " + error);
            //         $(".preloader-it").hide();
            //     }
            // });
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