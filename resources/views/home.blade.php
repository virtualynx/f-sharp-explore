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
                    <h6 class="panel-title txt-dark">MSISDN Statistics</h6>
                </div>
                <div class="pull-right">
                    <div class="pull-left form-group mb-0 sm-bootstrap-select mr-15">
                        <select class="selectpicker" data-style="form-control">
                            <option selected value='1'>Telco</option>
                            <option value='2'>Gender</option>
                            <option value='3'>Generations (Age)</option>
                        </select>
                    </div>	
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
                 <div class="panel-body">
                    <!-- THE PIE CHART-->
                    <div id="e_chart_statistics" class="" style="height:221px;"></div>
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
     <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
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
                                    <th>Progress</th>
                                    <th>Percent</th>
                                </tr>
                            </thead>
                            <tbody>
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
</div>

<div class="row">
    <div class="col-lg-12 col-xs-12">
        <div class="panel panel-info card-view red-border panel-refresh">
            <div class="refresh-container">
                <div class="la-anim-1"></div>
            </div>
            <div class="panel-heading">
                <div class="pull-left">
                    <h6 class="panel-title txt-dark">Maps Location Top Searched</h6>
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
    <script src="vendors/vectormap/jquery-jvectormap-world-mill-en.js"></script>

	<!-- Switchery JavaScript -->
	<script src="{{asset('vendors/bower_components/switchery/dist/switchery.min.js')}}"></script>

    <!-- Bootstrap Select -->
	<script src="vendors/bower_components/bootstrap-select/dist/js/bootstrap-select.min.js"></script>

	<!-- EChartJS JavaScript -->
	<script src="{{asset('vendors/bower_components/echarts/dist/echarts-en.min.js')}}"></script>
	<script src="{{asset('vendors/echarts-liquidfill.min.js')}}"></script>
    
	<script src="{{asset('dist/js/dashboard-data.js')}}"></script>
    <script>
		$(function() {
			"use strict";
			var mapData = {
					"US": 298,
					"SA": 200,
					"AU": 760,
					"IN": 2000000,
					"GB": 120,
				};
			
			if( $('#world_map_marker_1').length > 0 ){
				$('#world_map_marker_1').vectorMap(
				{
					map: 'world_mill_en',
					backgroundColor: 'transparent',
					borderColor: '#fff',
					borderOpacity: 0.25,
					borderWidth: 0,
					color: '#e6e6e6',
					regionStyle : {
						initial : {
						fill : '#f4f4f4'
						}
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
				
					markers : [{
						latLng : [21.00, 78.00],
						name : 'INDIA : 350'
					
					},
					{
						latLng : [-33.00, 151.00],
						name : 'Australia : 250'
						
					},
					{
						latLng : [36.77, -119.41],
						name : 'USA : 250'
					
					},
					{
						latLng : [55.37, -3.41],
						name : 'UK   : 250'
					
					},
					{
						latLng : [25.20, 55.27],
						name : 'UAE : 250'
					
					}],

					series: {
						regions: [{
							values: {
								"US": '#667add',
								"SA": '#667add',
								"AU": '#667add',
								"IN": '#667add',
								"GB": '#667add',
							},
							attribute: 'fill'
						}]
					},
					hoverOpacity: null,
					normalizeFunction: 'linear',
					zoomOnScroll: false,
					scaleColors: ['#000000', '#000000'],
					selectedColor: '#000000',
					selectedRegions: [],
					enableZoom: false,
					hoverColor: '#fff',
				});
			}

			if( $('#e_chart_statistics').length > 0 ){
				var eChart_3 = echarts.init(document.getElementById('e_chart_statistics'));
				var option3 = {
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
							color: ['#119dd2', '#d36ee8', '#667add'],
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
							].sort(function (a, b) { return a.value - b.value; }),
						},
					],
					animationType: 'scale',
					animationEasing: 'elasticOut',
					animationDelay: function (idx) {
						return Math.random() * 1000;
					}	
				};
				eChart_3.setOption(option3);
				eChart_3.resize();
			}
		});
	</script>
@endsection