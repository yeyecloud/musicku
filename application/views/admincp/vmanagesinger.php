<!-- Navigation -->
<?php echo $nav_header;?>

<!---MAIN--->
<div class="container documents">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading"><?php echo $this->lang->line('manage_singer');?></div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover" id="dataTables-example">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th><?php echo $this->lang->line('singer_name');?></th>
                                    <th><?php echo $this->lang->line('singer_url');?></th>
                                    <th><?php echo $this->lang->line('actions');?></th>						                
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> 

<!--MODAL-->
<div class="modal fade" id="modal-delete-singer" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">
                        &times;
                    </span>
                    <span class="sr-only">
                        <?php echo $this->lang->line('close');?>
                    </span>
                </button>
                <h4 class="modal-title" id="myModalLabel">
                    <?php echo $this->lang->line('delete');?>
                </h4>
            </div>
            <div class="modal-body">
                <input type="hidden" value="" id="singer-del" data-notify="KHong dc chon trung khi chuyen"/>
                <p id="count-song-in-singer"></p>
                <p><?php echo $this->lang->line('convert_singer');?></p>
                <input class="form-control" type="text" id="singer-song" name="singer-song" autocomplete="off" data-notify="<?php echo $this->lang->line('notify_required');?>">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">
                    <span class="glyphicon glyphicon-remove"></span>&nbsp;<?php echo $this->lang->line('close');?>
                </button>
                <button type="button" id="submit-delete-singer"  class="btn btn-success">
                    <span class="glyphicon glyphicon-ok"></span>&nbsp;<?php echo $this->lang->line('ok');?>
                </button>
            </div>
        </div>
    </div>
</div>
<!--END MODAL-->