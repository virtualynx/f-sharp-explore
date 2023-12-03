@extends('_template_authorized')

@section('page-title')
    Dashboard
@endsection

@section('page-head')
    <!--Maps-->
	<link href="vendors/vectormap/jquery-jvectormap-2.0.2.css" rel="stylesheet" type="text/css"/>

    <!-- Bootstrap Select -->
	<link href="vendors/bower_components/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet" type="text/css"/>
@endsection

@section('page-content')
<div class="row">
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <div class="panel panel-info card-view red-border panel-refresh">
            <div class="refresh-container">
                <div class="la-anim-1"></div>
            </div>
            <div class="panel-heading">
                <div class="pull-left">
                    <h6 class="panel-title txt-dark">Most Located Msisdn</h6>
                </div>
                <div class="pull-right">
                    <div class="pull-left form-group mb-0 sm-bootstrap-select mr-15">
                        <select id="select_stat_msisdn_by" class="selectpicker" data-style="form-control">
                            <option selected value='{{App\Enums\StatisticByEnum::OPERATOR->value}}'>Operator</option>
                            <option value='{{App\Enums\StatisticByEnum::HANDSET->value}}'>Handset</option>
                        </select>
                    </div>	
                    {{-- <div class="pull-left form-group mb-0 sm-bootstrap-select mr-15">
                        <select id="select_stat_msisdn_by_province" class="selectpicker" data-style="form-control">
                            <option selected value=''>All Province</option>
                        </select>
                    </div>
                    <div class="pull-left form-group mb-0 sm-bootstrap-select mr-15">
                        <select id="select_stat_msisdn_by_city" class="selectpicker" data-style="form-control">
                            <option selected value=''>All City</option>
                        </select>
                    </div> --}}
                    <a href="#" class="pull-left inline-block refresh mr-15" style="top: 3px;">
                        <i id="link_refresh_chart_msisdn" class="zmdi zmdi-replay"></i>
                    </a>
                    <a href="#" class="pull-left inline-block full-screen" style="top: 3px;">
                        <i class="zmdi zmdi-fullscreen"></i>
                    </a>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="panel-wrapper collapse in">
                <div class="panel-body">
                    <!-- THE PIE CHART-->
                    <div id="e_chart_msisdn" class="" style="height:221px;"></div>
                    <div id="chart_detail_msisdn">
                        <hr class="light-grey-hr row mt-10 mb-15"/>
                        <div class="label-chatrs">
                            <div class="">
                                <span class="clabels clabels-lg inline-block bg-primary mr-10 pull-left"></span>
                                <span class="clabels-text font-12 inline-block txt-dark capitalize-font pull-left"><span class="block font-15 weight-500 mb-5">44.46% Telkomsel</span></span>
                                <span class="txt-dark block counter pull-right"><span class="counter-anim">102</span></span>
                                <div class="clearfix"></div>
                            </div>
                        </div>
        
                        <hr class="light-grey-hr row mt-10 mb-15"/>
                        <div class="label-chatrs">
                            <div class="">
                                <span class="clabels clabels-lg inline-block bg-purple mr-10 pull-left"></span>
                                <span class="clabels-text font-12 inline-block txt-dark capitalize-font pull-left"><span class="block font-15 weight-500 mb-5">30.3% Indosat</span></span>
                                <span class="txt-dark block counter pull-right"><span class="counter-anim">88</span></span>
                                <div class="clearfix"></div>
                            </div>
                        </div>
    
                        <hr class="light-grey-hr row mt-10 mb-15"/>
                        <div class="label-chatrs">
                            <div class="">
                                <span class="clabels clabels-lg inline-block bg-skyblue mr-10 pull-left"></span>
                                <span class="clabels-text font-12 inline-block txt-dark capitalize-font pull-left"><span class="block font-15 weight-500 mb-5">5.53% Hutchison 3</span></span>
                                <span class="txt-dark block counter pull-right"><span class="counter-anim">23</span></span>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                </div>	
             </div>
        </div>
    </div>

    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <div class="panel panel-info card-view red-border panel-refresh">
            <div class="refresh-container">
                <div class="la-anim-1"></div>
            </div>
            <div class="panel-heading">
                <div class="pull-left">
                    <h6 class="panel-title txt-dark">Most Searched On Dukcapil</h6>
                </div>
                <div class="pull-right">
                    <div class="pull-left form-group mb-0 sm-bootstrap-select mr-15">
                        <select id="select_stat_dukcapil_by" class="selectpicker" data-style="form-control">
                            <option selected value='{{App\Enums\StatisticByEnum::GENDER->value}}'>Gender</option>
                            <option value='{{App\Enums\StatisticByEnum::GENERATION->value}}'>Generations (Age)</option>
                            <option value='{{App\Enums\StatisticByEnum::OCCUPATION->value}}'>Occupation</option>
                            <option value='{{App\Enums\StatisticByEnum::EDUCATION->value}}'>Education</option>
                            <option value='{{App\Enums\StatisticByEnum::RELIGION->value}}'>Religion</option>
                            <option value='{{App\Enums\StatisticByEnum::PROVINCE->value}}'>Province</option>
                            <option value='{{App\Enums\StatisticByEnum::CITY->value}}'>City</option>
                            <option value='{{App\Enums\StatisticByEnum::DISTRICT->value}}'>District</option>
                        </select>
                    </div>
                    <div class="pull-left form-group mb-0 sm-bootstrap-select mr-15">
                        <select id="select_stat_dukcapil_by_province" class="selectpicker" data-style="form-control">
                            <option selected value=''>All Province</option>
                        </select>
                    </div>
                    <div class="pull-left form-group mb-0 sm-bootstrap-select mr-15">
                        <select id="select_stat_dukcapil_by_city" class="selectpicker" data-style="form-control">
                            <option selected value=''>All City</option>
                        </select>
                    </div>
                    <a href="#" class="pull-left inline-block refresh mr-15" style="top: 3px;">
                        <i id="link_refresh_chart_dukcapil" class="zmdi zmdi-replay"></i>
                    </a>
                    <a href="#" class="pull-left inline-block full-screen" style="top: 3px;">
                        <i class="zmdi zmdi-fullscreen"></i>
                    </a>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="panel-wrapper collapse in">
                <div class="panel-body">
                    <!-- THE PIE CHART-->
                    <div id="e_chart_dukcapil" class="" style="height:257px;"></div>
                    <div id="chart_detail_dukcapil">
                        <hr class="light-grey-hr row mt-20 mb-15"/>
                        <div class="label-chatrs">
                            <div class="">
                                <span class="clabels clabels-lg inline-block bg-primary mr-10 pull-left"></span>
                                <span class="clabels-text font-12 inline-block txt-dark capitalize-font pull-left"><span class="block font-15 weight-500 mb-5">58% Male</span></span>
                                <span class="txt-dark block counter pull-right"><span class="counter-anim">1000</span></span>
                                <div class="clearfix"></div>
                            </div>
                        </div>

                        <hr class="light-grey-hr row mt-10 mb-15"/>
                        <div class="label-chatrs">
                            <div class="">
                                <span class="clabels clabels-lg inline-block bg-purple mr-10 pull-left"></span>
                                <span class="clabels-text font-12 inline-block txt-dark capitalize-font pull-left"><span class="block font-15 weight-500 mb-5">41% Female</span></span>
                                <span class="txt-dark block counter pull-right"><span class="counter-anim">700</span></span>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                </div>	
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
        <div class="panel panel-info card-view red-border panel-refresh">
            <div class="refresh-container">
                <div class="la-anim-1"></div>
            </div>
            <div class="panel-heading">
                <div class="pull-left">
                    <h6 class="panel-title txt-dark">Top 10 City Searched MSISDN</h6>
                </div>
                <div class="pull-right">
                    <a href="#" class="pull-left inline-block refresh mr-15" style="top: 3px;">
                        <i class="zmdi zmdi-replay"></i>
                    </a>
                    <a href="#" class="pull-left inline-block full-screen" style="top: 3px;">
                        <i class="zmdi zmdi-fullscreen"></i>
                    </a>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="panel-wrapper collapse in">
                <div class="panel-body row pa-0">
                    <div class="table-wrap">
                        <div class="table-responsive">
                          <table class="table table-hover mb-0">
                            <thead>
                                  <tr>
                                    <th>City</th>
                                    <th>Portion</th>
                                    <th>Percent</th>
                                </tr>
                            </thead>
                            <tbody id="table-top-10-located-msisdn">
                              <tr>
                                <td>Surabaya</td>
                                <td>
                                    <div class="progress progress-xs mb-0 ">
                                        <div class="progress-bar progress-bar-danger" style="width: 55%"></div>
                                      </div>
                                </td>
                                <td class="txt-dark weight-500">50%</td>	
                              </tr>
                              <tr>
                                <td>Bandung</td>
                                <td>
                                    <div class="progress progress-xs mb-0 ">
                                        <div class="progress-bar progress-bar-danger" style="width: 52%"></div>
                                      </div>
                                </td>
                                <td class="txt-dark weight-500">52%</td>	
                              </tr>
                              <tr>
                                <td>Jakarta</td>
                                <td>
                                    <div class="progress progress-xs mb-0 ">
                                        <div class="progress-bar progress-bar-warning" style="width: 48%"></div>
                                      </div>
                                </td>
                                <td class="txt-dark weight-500">48%</td>	
                              </tr>
                              <tr>
                                <td>Medan</td>
                                <td>
                                    <div class="progress progress-xs mb-0 ">
                                        <div class="progress-bar progress-bar-warning" style="width: 40%"></div>
                                      </div>
                                </td>
                                <td class="txt-dark weight-500">40%</td>	
                              </tr>
                              <tr>
                                <td>Semarang</td>
                                <td>
                                    <div class="progress progress-xs mb-0 ">
                                        <div class="progress-bar progress-bar-primary" style="width: 39%"></div>
                                      </div>
                                </td>
                                <td class="txt-dark weight-500">39%</td>	
                              </tr>
                              <tr>
                                <td>Makassar</td>
                                <td>
                                    <div class="progress progress-xs mb-0 ">
                                        <div class="progress-bar progress-bar-primary" style="width: 37%"></div>
                                      </div>
                                </td>
                                <td class="txt-dark weight-500">37%</td>	
                              </tr>
                              <tr>
                                <td>Palembang</td>
                                <td>
                                    <div class="progress progress-xs mb-0 ">
                                        <div class="progress-bar progress-bar-primary" style="width: 36%"></div>
                                      </div>
                                </td>
                                <td class="txt-dark weight-500">39%</td>	
                              </tr>
                              <tr>
                                <td>Batam</td>
                                <td>
                                    <div class="progress progress-xs mb-0 ">
                                        <div class="progress-bar progress-bar-info" style="width: 25%"></div>
                                      </div>
                                </td>
                                <td class="txt-dark weight-500">39%</td>	
                              </tr>
                              <tr>
                                <td>Denpasar</td>
                                <td>
                                    <div class="progress progress-xs mb-0 ">
                                        <div class="progress-bar progress-bar-info" style="width: 22%"></div>
                                      </div>
                                </td>
                                <td class="txt-dark weight-500">39%</td>	
                              </tr>
                              <tr>
                                <td>Kupang</td>
                                <td>
                                    <div class="progress progress-xs mb-0 ">
                                        <div class="progress-bar progress-bar-info" style="width: 20%"></div>
                                      </div>
                                </td>
                                <td class="txt-dark weight-500">39%</td>	
                              </tr>
                            </tbody>
                          </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
        <div class="panel panel-info card-view red-border panel-refresh">
            <div class="refresh-container">
                <div class="la-anim-1"></div>
            </div>
            <div class="panel-heading">
                <div class="pull-left">
                    <h6 class="panel-title txt-dark">Maps Location Top Searched</h6>
                </div>
                <div class="pull-right">
                    {{-- <div class="pull-left form-group mb-0 sm-bootstrap-select mr-5">
                        <select class="selectpicker" data-style="form-control">
                            <option selected value='1'>Jawa Timur</option>
                            <option value='2'>Jawa Tengah</option>
                            <option value='3'>DKI Jakarta</option>
                        </select>
                    </div>	
                    <div class="pull-left form-group mb-0 sm-bootstrap-select mr-15">
                        <select class="selectpicker" data-style="form-control">
                            <option selected value='1'>Kota Malang</option>
                            <option value='2'>Kota Surabaya</option>
                            <option value='3'>Kota Blitar</option>
                        </select>
                    </div>	 --}}
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
                <div class="panel-body">
                    <div id="world_map_marker_1" style="height: 385px"></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('page-footer')
	<!-- Data table JavaScript -->
	<script src="{{asset('vendors/bower_components/datatables/media/js/jquery.dataTables.min.js')}}"></script>
    
	<!-- Progressbar Animation JavaScript -->
	<script src="{{asset('vendors/bower_components/waypoints/lib/jquery.waypoints.min.js')}}"></script>
	<script src="{{asset('vendors/bower_components/jquery.counterup/jquery.counterup.min.js')}}"></script>
    
	<!-- Fancy Dropdown JS -->
	<script src="{{asset('dist/js/dropdown-bootstrap-extended.js')}}"></script>

    <!--Maps-->
	<script src="vendors/vectormap/jquery-jvectormap-2.0.2.min.js"></script>
    {{-- <script src="vendors/vectormap/jquery-jvectormap-world-mill-en.js"></script> --}}
    <script src="vendors/vectormap/indonesia-adm1.js"></script>

	<!-- Switchery JavaScript -->
	<script src="{{asset('vendors/bower_components/switchery/dist/switchery.min.js')}}"></script>

    <!-- Bootstrap Select -->
	<script src="vendors/bower_components/bootstrap-select/dist/js/bootstrap-select.min.js"></script>

	<!-- EChartJS JavaScript -->
	<script src="{{asset('vendors/bower_components/echarts/dist/echarts-en.min.js')}}"></script>
	<script src="{{asset('vendors/echarts-liquidfill.min.js')}}"></script>
    
	<script src="{{asset('dist/js/dashboard-data.js')}}"></script>
	{{-- <script src="{{asset('vendors/vectormap/jquery-jvectormap-world-mill-en.js')}}"></script> --}}
    {{-- 
        for complete district vector map in
        https://github.com/nsetyo/jvectormap-indonesia 
    --}}
	<script src="{{asset('vendors/vectormap/indonesia-adm1.js')}}"></script>
    <script>
		$(function() {
			"use strict";
			if( $('#e_chart_msisdn').length > 0 ){
				eChartMsisdn = echarts.init(document.getElementById('e_chart_msisdn'));
				eChartMsisdn.setOption(chartOptionMsisdn);
				eChartMsisdn.resize();
			}
            
            //-- CHART TAMBAHAN (MOST SEARCHED DUKCAPIL BY GENDER / GENERATION) --> 
            if( $('#e_chart_dukcapil').length > 0 ){
				eChart_dukcapil = echarts.init(document.getElementById('e_chart_dukcapil'));
				eChart_dukcapil.setOption(chartOptionDukcapil);
				eChart_dukcapil.resize();
			}
            //-- CHART TAMBAHAN (MOST SEARCHED DUKCAPIL BY GENDER / GENERATION) --> 

            $('#select_stat_msisdn_by').change(function(e){
                var by = $(e.target).val();

                getSearchStatisticBy(by);
            });

            $('#select_stat_dukcapil_by').change(function(e){
                var by = $(e.target).val();

                // getSearchStatisticBy(by);
                selectStatDukcapilChanged();
            });

            populateStatDukcapilProvinces();

            $('#select_stat_dukcapil_by_province').change(function(e){
                selectStatDukcapilProvinceChanged();
            });

            $('#select_stat_dukcapil_by_city').change(function(e){
                selectStatDukcapilCityChanged();
            });

            getTop10City('city');
            
            /** 
             * Load another jvectormap on region click
             * https://stackoverflow.com/questions/15643677/load-another-jvectormap-on-region-click
            */
			if( $('#world_map_marker_1').length > 0 ){
				$('#world_map_marker_1').vectorMap({
					// map: 'world_mill_en',
					map: 'indonesia-adm1_merc',
                    // map: 'indonesia-adm2-1_merc',
					backgroundColor: 'transparent',
					borderColor: '#fff',
					borderOpacity: 0.25,
					borderWidth: 0,
					color: '#e6e6e6',
					hoverOpacity: null,
					normalizeFunction: 'linear',
					zoomOnScroll: true,
					scaleColors: ['#000000', '#000000'],
					selectedColor: '#000000',
					selectedRegions: [],
					enableZoom: false,
					hoverColor: '#fff',

                    regionStyle: { 
                        initial: { fill: '#d2d6de' }, 
                        hover: { fill: '#A0D1DC' } 
                    },

					markerStyle: {
					    initial: {
									r: 10,
									'fill': '#fff',
									'fill-opacity':1,
									'stroke': '#000',
									'stroke-width' : 1,
									'stroke-opacity': 0.4
                        },
                    },
				
					markers : [
                        // {
                        //     latLng : [21.00, 78.00],
                        //     name : 'INDIA : 350'
                        
                        // },
                        // {
                        //     latLng : [-33.00, 151.00],
                        //     name : 'Australia : 250'
                            
                        // }
                    ],

					series: {
						regions: [
                            // {
                            //     values: {
                            //         "US": '#667add',
                            //         "SA": '#667add',
                            //         "AU": '#667add',
                            //         "IN": '#667add',
                            //         "GB": '#667add',
                            //     },
                            //     attribute: 'fill'
                            // }
                            {
                                "values": {
                                    // '10': "#1c8b7b",
                                    // '16': "#341ebc",
                                    // '27': "#987c19"
                                },
                                "attribute": "fill"
                            }
                        ]
					},

                    onRegionTipShow: function(e, el, code){
                        let value = mapInstance.series.regions[0].values[code];
                        if(value){
                            let percent = (mapData.values[code] / mapData.total * 100).toFixed(2);
                            el.text(el.text() + ': ' + mapData.values[code] + ' (' + percent + '%)');
                        }
                    },

                    // labels: {
                    //     regions: {
                    //         render: function(code){
                    //             let percent = (mapData.values[code] / mapData.total * 100).toFixed(2) + '%';

                    //             return percent;
                    //         }
                    //     }
                    // },
				});
                mapInstance = $('#world_map_marker_1').vectorMap('get', 'mapObject');

                // mapInstance = new jvm.Map({
				// 	map: 'indonesia-adm1_merc',
                //     container: $('#world_map_marker_1'),
                //     zoomOnScroll: true,
                //     regionsSelectable: false,
                //     backgroundColor: "aliceblue", 
                //     markers: [], /* Initialize the map with empty markers */
                //     series: {
                //     regions: [{
                //         values: {}, /* Initialize the map with empty region values */
                //         scale: ['#C8EEFF', '#0071A4'],
                //         normalizeFunction: 'polynomial'
                //     }],
                //     /* Initialize the map with empty marker values */
                //     markers: [{attribute: 'fill', scale: {}, values: []}]
                //     }, 
                //     onRegionTipShow: function(e, el, code){
                //         // var value = worldMap.series.regions[0].values[code],
                //         // formattedValue = new Intl.NumberFormat('en-US', worldMap.dataSetFormat).format(value);
                //         // el.text(el.text() + ' (' + worldMap.dataSetName + ': ' + formattedValue + ')');
                //     }
                // });

                getVectorMapData();
			}
		});

        var eChartMsisdn;
        var chartOptionMsisdn = {
            tooltip : {
                trigger: 'item',
                formatter: "{a} <br/>{b} : {c} ({d}%)",
                backgroundColor: 'rgba(33,33,33,1)',
                borderRadius:0,
                padding:10,
                textStyle: {
                    color: '#fff',
                    fontStyle: 'normal',
                    fontWeight: 'normal',
                    fontFamily: "'Roboto', sans-serif",
                    fontSize: 12
                }	
            },
            legend: {
                show:false
            },
            toolbox: {
                show : false,
            },
            calculable : true,
            itemStyle: {
                normal: {
                    shadowBlur: 5,
                    shadowColor: 'rgba(0, 0, 0, 0.5)'
                }
            },
            series : [
                {
                    name:'Provider / Telco',
                    type:'pie',
                    radius : '80%',
                    center : ['50%', '50%'],
                    roseType : 'radius',
                    color: ['#119dd2', '#d36ee8', '#667add', '#ff0000'],
                    label: {
                        normal: {
                            fontFamily: "'Roboto', sans-serif",
                            fontSize: 12
                        }
                    },
                    data:[
                        {value:335, name:'Telkomsel'},
                        {value:310, name:'Indosat'},
                        {value:274, name:'Hutchison 3'},
                        {value:375, name:'XL Axiata'},
                    ].sort(function (a, b) { return a.value - b.value; }),
                },
            ],
            animationType: 'scale',
            animationEasing: 'elasticOut',
            animationDelay: function (idx) {
                return Math.random() * 1000;
            }	
        };
        
        var eChart_dukcapil;
        var chartOptionDukcapil = {
            tooltip : {
                trigger: 'item',
                formatter: "{a} <br/>{b} : {c} ({d}%)",
                backgroundColor: 'rgba(33,33,33,1)',
                borderRadius:0,
                padding:10,
                textStyle: {
                    color: '#fff',
                    fontStyle: 'normal',
                    fontWeight: 'normal',
                    fontFamily: "'Roboto', sans-serif",
                    fontSize: 12
                }	
            },
            legend: {
                show:false
            },
            toolbox: {
                show : false,
            },
            calculable : true,
            itemStyle: {
                normal: {
                    shadowBlur: 5,
                    shadowColor: 'rgba(0, 0, 0, 0.5)'
                }
            },
            series : [
                {
                    name:'Most Search By Gender',
                    type:'pie',
                    radius : '80%',
                    center : ['50%', '50%'],
                    roseType : 'radius',
                    color: ['#119dd2', '#d36ee8'],
                    label: {
                        normal: {
                            fontFamily: "'Roboto', sans-serif",
                            fontSize: 12
                        }
                    },
                    data:[
                        {value:1000, name:'Male'},
                        {value:700, name:'Female'},
                    ].sort(function (a, b) { return a.value - b.value; }),
                },
            ],
            animationType: 'scale',
            animationEasing: 'elasticOut',
            animationDelay: function (idx) {
                return Math.random() * 1000;
            }	
        };

        var mapInstance = null;
        const mapData = {
            values: [],
            total: 0
        };
        /**
         * region map for file indonesia-adm1.js
        */
        const jvectorMapProvince = {
            "24": {
                "name": "Papua"
            },
            "25": {
                "name": "Riau"
            },
            "26": {
                "name": "Sulawesi Barat"
            },
            "27": {
                "name": "Sulawesi Selatan"
            },
            "20": {
                "name": "Maluku Utara"
            },
            "21": {
                "name": "Maluku"
            },
            "22": {
                "name": "Nusa Tenggara Barat"
            },
            "23": {
                "name": "Nusa Tenggara Timur"
            },
            "28": {
                "name": "Sulawesi Tengah"
            },
            "29": {
                "name": "Sulawesi Tenggara"
            },
            "1": {
                "name": "Aceh"
            },
            "3": {
                "name": "Bangka-Belitung"
            },
            "2": {
                "name": "Bali"
            },
            "5": {
                "name": "Bengkulu"
            },
            "4": {
                "name": "Banten"
            },
            "7": {
                "name": "Irian Jaya Barat"
            },
            "6": {
                "name": "Gorontalo"
            },
            "9": {
                "name": "Jambi"
            },
            "8": {
                "name": "Jakarta Raya"
            },
            "11": {
                "name": "Jawa Tengah"
            },
            "10": {
                "name": "Jawa Barat"
            },
            "13": {
                "name": "Kalimantan Barat"
            },
            "12": {
                "name": "Jawa Timur"
            },
            "15": {
                "name": "Kalimantan Tengah"
            },
            "14": {
                "name": "Kalimantan Selatan"
            },
            "17": {
                "name": "Kalimantan Utara"
            },
            "16": {
                "name": "Kalimantan Timur"
            },
            "19": {
                "name": "Lampung"
            },
            "18": {
                "name": "Kepulauan Riau"
            },
            "31": {
                "name": "Sumatera Barat"
            },
            "30": {
                "name": "Sulawesi Utara"
            },
            "34": {
                "name": "Yogyakarta"
            },
            "33": {
                "name": "Sumatera Utara"
            },
            "32": {
                "name": "Sumatera Selatan"
            }
        };

        function selectStatDukcapilProvinceChanged(){
            let province = $('#select_stat_dukcapil_by_province').val();

            if(province != ''){
                populateStatDukcapilCities(province);
            }else{
                $('#select_stat_dukcapil_by_city').val('');
                $('#select_stat_dukcapil_by_city').selectpicker('refresh')
                $('#select_stat_dukcapil_by_city').hide();
            }
            selectStatDukcapilChanged();
        }
        
        function selectStatDukcapilCityChanged(){
            selectStatDukcapilChanged();
        }

        function selectStatDukcapilChanged(){
            let by = $('#select_stat_dukcapil_by').val();
            let province = $('#select_stat_dukcapil_by_province').val();
            let city = $('#select_stat_dukcapil_by_city').val();

            getSearchStatisticBy(by, province, city);
        }

        function populateStatDukcapilProvinces(){
            get({
                url: "{{config('app.url')}}/api/wilayah/provinces",
                success: function (response, status) {
                    if(status == 'success' && response.status == 0){
                        const optionProvinceTemplate = `
                            <option value="<value>"><text></option>
                        `;
                        
                        // let content = '<option value="">All Province</option>';
                        $("#select_stat_dukcapil_by_province").empty();
                        $('#select_stat_dukcapil_by_province').append('<option value="">All Province</option>');
                        response.data.forEach((a) => {
                            // content += optionProvinceTemplate
                            //     .replaceAll('<value>', a.id)
                            //     .replaceAll('<text>', a.name)
                            //     ;

                            $('#select_stat_dukcapil_by_province').append(
                                optionProvinceTemplate
                                .replaceAll('<value>', a.id)
                                .replaceAll('<text>', a.name)
                            );
                        });
                        // $('#select_stat_dukcapil_by_province').html(content);
                        $("#select_stat_dukcapil_by_province").selectpicker("refresh");
                    }else{
                        myAlert(response.message, 'error');
                    }
                }
            }, false);
        }

        function populateStatDukcapilCities(province_id){
            get({
                url: "{{config('app.url')}}/api/wilayah/cities/"+province_id,
                success: function (response, status) {
                    if(status == 'success' && response.status == 0){
                        const optionCityTemplate = `
                            <option value="<value>"><text></option>
                        `;
                        
                        // let content = '<option value="">All City</option>';
                        $("#select_stat_dukcapil_by_city").empty();
                        $('#select_stat_dukcapil_by_city').append('<option value="">All City</option>');
                        response.data.forEach((a) => {
                            // content += optionCityTemplate
                            //     .replaceAll('<value>', a.id)
                            //     .replaceAll('<text>', a.name)
                            //     ;

                            $('#select_stat_dukcapil_by_city').append(
                                optionCityTemplate
                                .replaceAll('<value>', a.id)
                                .replaceAll('<text>', a.name)
                            );
                        });
                        // $('#select_stat_dukcapil_by_city').html(content);
                        $("#select_stat_dukcapil_by_city").selectpicker("refresh");
                        $('#select_stat_dukcapil_by_city').show();
                    }else{
                        myAlert(response.message, 'error');
                    }
                }
            }, false);
        }

        function getSearchStatisticBy(by, province_id = '', city_id = ''){
            if(by == '{{App\Enums\StatisticByEnum::OPERATOR->value}}'){
                $('#link_refresh_chart_msisdn').trigger('click');
            } else if (by == '{{App\Enums\StatisticByEnum::PROVINCE->value}}') {
                $('#link_refresh_chart_dukcapil').trigger('click');
            } else if (by == '{{App\Enums\StatisticByEnum::CITY->value}}') {
                $('#link_refresh_chart_dukcapil').trigger('click');
            } else if (by == '{{App\Enums\StatisticByEnum::DISTRICT->value}}') {
                $('#link_refresh_chart_dukcapil').trigger('click');
            } else {
                $('#link_refresh_chart_dukcapil').trigger('click');
            }

            get({
                url: "{{config('app.url')}}/api/report/search-statistic/"+by+"?province_id="+province_id+"&city_id="+city_id,
                success: function (response, status) {
                    if(status == 'success' && response.status == 0){
                        updateCharts(by, response.data);
                    }else{
                        myAlert(response.message, 'error');
                    }
                }
            }, false);
        }

        function updateCharts(by, datas){
            let colors = [];
            for(let a=0;a<datas.length;a++){
                colors.push(randomHexColorCode());
            }

            let detailContainer;
            const chartDatas = [];
            let totalCount = 0;
            if(
                by == '{{App\Enums\StatisticByEnum::OPERATOR->value}}'
                || by == '{{App\Enums\StatisticByEnum::HANDSET->value}}'
            ){
                let series = chartOptionMsisdn.series[0];

                if(by == '{{App\Enums\StatisticByEnum::OPERATOR->value}}'){
                    series.name = 'Provider / Telco';
                }else if(by == '{{App\Enums\StatisticByEnum::HANDSET->value}}'){
                    series.name = 'Handset';
                }
                
                series.color = colors;
                datas.forEach((a) => {
                    const row = {};

                    if(by == '{{App\Enums\StatisticByEnum::OPERATOR->value}}'){
                        row.name = a.operator;
                    }else if(by == '{{App\Enums\StatisticByEnum::HANDSET->value}}'){
                        row.name = a.phone;
                    }
                    row.value = a.count;
                    totalCount += parseInt(a.count);
                    chartDatas.push(row);
                });
                series.data = chartDatas;

				eChartMsisdn.setOption(chartOptionMsisdn);
				// eChartMsisdn.resize();

                detailContainer = $('#chart_detail_msisdn');
            }else{
                let series = chartOptionDukcapil.series[0];

                if(by == '{{App\Enums\StatisticByEnum::GENDER->value}}'){
                    series.name = 'Gender';
                }else if(by == '{{App\Enums\StatisticByEnum::GENERATION->value}}'){
                    series.name = 'Generation (Age)';
                }else if(by == '{{App\Enums\StatisticByEnum::OCCUPATION->value}}'){
                    series.name = 'Occupation';
                }else if(by == '{{App\Enums\StatisticByEnum::EDUCATION->value}}'){
                    series.name = 'Education';
                }else if(by == '{{App\Enums\StatisticByEnum::RELIGION->value}}'){
                    series.name = 'Religion';
                }else if(by == '{{App\Enums\StatisticByEnum::PROVINCE->value}}'){
                    series.name = 'Province';
                }else if(by == '{{App\Enums\StatisticByEnum::CITY->value}}'){
                    series.name = 'City';
                }else if(by == '{{App\Enums\StatisticByEnum::DISTRICT->value}}'){
                    series.name = 'District';
                }
                
                series.color = colors;
                datas.forEach((a) => {
                    const row = {};

                    if(by == '{{App\Enums\StatisticByEnum::GENDER->value}}'){
                        row.name = a.gender;
                    }else if(by == '{{App\Enums\StatisticByEnum::GENERATION->value}}'){
                        row.name = a.generation;
                    }else if(by == '{{App\Enums\StatisticByEnum::OCCUPATION->value}}'){
                        row.name = a.occupation;
                    }else if(by == '{{App\Enums\StatisticByEnum::EDUCATION->value}}'){
                        row.name = a.education;
                    }else if(by == '{{App\Enums\StatisticByEnum::RELIGION->value}}'){
                        row.name = a.religion;
                    }else if(by == '{{App\Enums\StatisticByEnum::PROVINCE->value}}'){
                        row.name = a.province;
                    }else if(by == '{{App\Enums\StatisticByEnum::CITY->value}}'){
                        row.name = a.city;
                    }else if(by == '{{App\Enums\StatisticByEnum::DISTRICT->value}}'){
                        row.name = a.district;
                    }
                    row.value = a.count;
                    totalCount += parseInt(a.count);

                    chartDatas.push(row);
                });
                series.data = chartDatas;

				eChart_dukcapil.setOption(chartOptionDukcapil);
				// eChart_dukcapil.resize();

                detailContainer = $('#chart_detail_dukcapil');
            }

            const chartDetailTemplate = `
                    <hr class="light-grey-hr row mt-10 mb-15"/>
                    <div class="label-chatrs">
                        <div class="">
                            <span class="clabels clabels-lg inline-block mr-10 pull-left" style="background-color:@color"></span>
                            <span class="clabels-text font-12 inline-block txt-dark capitalize-font pull-left"><span class="block font-15 weight-500 mb-5">@percentage% @name</span></span>
                            <span class="txt-dark block counter pull-right"><span class="counter-anim">@count</span></span>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                `;
            
            detailContainer.html('');
            let content = '';
            for(let a=0;a<chartDatas.length;a++){
                let percent = (chartDatas[a].value / totalCount) * 100;

                let row = chartDetailTemplate
                    .replaceAll("@color", colors[a])
                    .replaceAll("@percentage", percent.toFixed(2))
                    .replaceAll("@name", chartDatas[a].name)
                    .replaceAll("@count", chartDatas[a].value)
                    ;
                content+=row;
            }
            detailContainer.html(content);
        }

        function getTop10City(by){
            const rowTemplate = `
                <tr>
                    <td>@city</td>
                    <td>
                        <div class="progress progress-xs mb-0 ">
                            <div class="progress-bar" style="width: @percent%; background-color: @color"></div>
                            </div>
                    </td>
                    <td class="txt-dark weight-500">@percent%</td>	
                </tr>
            `;

            get({
                url: "{{config('app.url')}}/api/report/dashboard/most-located-msisdn/"+by,
                success: function (response, status) {
                    if(status == 'success' && response.status == 0){
                        let datas = response.data;

                        const colors = [];
                        for(let a=0;a<datas.length;a++){
                            colors.push(randomHexColorCode());
                        }

                        let totalCount = 0;
                        datas.forEach((a) => {
                            totalCount += parseInt(a.count);
                        });

                        $('#table-top-10-located-msisdn').html('');
                        let content = '';
                        for(let a=0;a<datas.length;a++){
                            let data = datas[a];    
                            let field = null;

                            if(by == 'city'){
                                field = data.city;
                            }

                            let percent = (data.count / totalCount) * 100;

                            let rowContent = rowTemplate
                                .replaceAll('@city', field)
                                .replaceAll('@percent', percent.toFixed(2))
                                .replaceAll('@color', colors[a])
                                ;

                            content += rowContent;
                        }
                        $('#table-top-10-located-msisdn').html(content);
                    }else{
                        alert(response.message);
                    }
                }
            }, false);
        }

        function getVectorMapData(){
            const provinceMap = [];
            for(const [key, value] of Object.entries(jvectorMapProvince)) {
                const rowdata = {
                    region_id: key,
                    name: value.name
                };
                provinceMap.push(rowdata);
            }

            post({
                url: "{{config('app.url')}}/api/report/dashboard/map-visualization",
                success: function (response, status) {
                    if(status == 'success' && response.status == 0){
                        const datas = response.data;
                        const regionData = {
                            values: {},
                            attribute: 'fill'
                        };
                        const regionValuesData = {};
                        const colors = [];
                        for(let a=0;a<datas.length;a++){
                            colors.push(randomHexColorCode());
                        }

                        mapData.total = 0;
                        let mapDataValues = {};
                        for(let a=0;a<datas.length;a++){
                            let loopData = datas[a];
                            let matchedDatas = provinceMap.filter((b) => b.name.toLowerCase() == loopData.province.toLowerCase());
                            if(matchedDatas.length > 0){
                                let matchedData = matchedDatas[0];
                                regionValuesData[matchedData.region_id] = colors[a];
                                mapDataValues[matchedData.region_id] = parseInt(loopData.count);
                                mapData.total += parseInt(loopData.count);
                            }
                        }
                        mapData.values = mapDataValues;

                        // let region = mapInstance.series.regions[0];
                        /* Reset the scale min & max, allow recomputation. */ 
                        // region.params.min = min;
                        // region.params.max = max;
                        // region.setValues(regionData);
                        // region.values = regionData;

                        // let mapInst = $('#world_map_marker_1').vectorMap('get', 'mapObject');
                        // mapInst.clearSelectedRegions();
                        // mapInst.series.regions[0].clear(); //clear the array values
                        // mapInst.setSelectedRegions([code]);
                        // mapInst.series.regions[0].values = regionValuesData;

                        mapInstance.series.regions[0].setValues(regionValuesData);
                    }else{
                        myAlert(response.message, 'error');
                    }
                },
            }, false);
        }
	</script>
@endsection