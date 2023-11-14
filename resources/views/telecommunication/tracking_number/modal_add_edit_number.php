
<!-- Modal -->
<div class="modal fade" id="modal_add_edit_number" role="dialog">
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
                <form action="#" name="form_add_edit_number">
                    <input name="mode" type="hidden">
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
                                <input name="cron_dayofmonth" value="*" type="text" class="form-control" placeholder="* or 1-31">
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
                                <select class="form-control" id="sel1" name="cron_dayofweek">
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
                <button type="button" name="btn_save_number" class="btn btn-primary">Save</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
    
</script>