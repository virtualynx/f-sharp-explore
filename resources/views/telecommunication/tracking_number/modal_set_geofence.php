
<!-- Modal -->
<div id="modal_set_geofence" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h5 class="modal-title" id="modal_set_geofence_title">Set Geofence</h5>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-addon">Action</div>
                                <select class="form-control" id="select_geofence_action">
                                    <option value="">- Choose Action -</option>
                                    <option value="IN">IN</option>
                                    <option value="OUT">OUT</option>
                                </select>
                                <span class="input-group-btn">
                                    <button id="btn_geofence_save" onclick="saveGeofence()" type="button" class="btn btn-success btn-icon left-icon"><i class="fa fa-plus"></i><span class="btn-text">Save Changes</span></button>
                                </span> 
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 p-10">
                        <div>
                            <div id="map_geofence" style="height:450px;"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer mt-20">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<!-- <div class="modal fade" id="modal_set_geofence" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Set Geofence</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input name="input_geofence_msisdn" type="hidden" value=""/>
                <div class="row">
                    <div class="col-xs-4">
                        <button id="btn_geofence_save" onclick="saveGeofence()" type="button" class="btn btn-success btn-icon left-icon">
                            <i class="fa fa-plus"></i><span class="btn-text">Save Changes</span>
                        </button>
                    </div>
                    <div class="col-xs-8 mb-10">
                        <div class="row">
                            <div class="col-xs-6">
                                <label class="pull-left control-label mb-10">Action</label>
                            </div>
                            <div class="col-xs-6">
                                <select class="form-control" id="select_geofence_action" >
                                    <option value="">-</option>
                                    <option value="IN">IN</option>
                                    <option value="OUT">OUT</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 p-10">
                        <div>
                            <div id="map_geofence" style="height:600px;"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div> -->

<script>
    
</script>