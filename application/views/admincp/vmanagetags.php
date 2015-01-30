<!-- Navigation -->
<?php echo $nav_header;?>

<!---MAIN--->
<div class="container documents">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading"><?php echo $this->lang->line('tags_manage');?></div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                                <tr>
                                    <th>
                                        ID
                                    </th>
                                    <th>
                                        <?php echo $this->lang->line('tags_name');?>
                                    </th>
                                    <th>
                                        <?php echo $this->lang->line('actions');?>
                                    </th>
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
<div class="modal fade" id="modal-edit-tags" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                    <?php echo $this->lang->line('edit');?>
                </h4>
            </div>
            <div class="modal-body">
                <input type="hidden" value="" id="t_id"/>
                <p>
                    <?php echo $this->lang->line('tags_edit');?>
                </p>
                <input class="form-control" type="text" value="" id="tags_name" name="tags_name" autocomplete="off" data-notify="<?php echo $this->lang->line('notify_tags_name');?>" data-notify-exist="<?php echo $this->lang->line('notify_tags_name_exist');?>">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">
                    <span class="glyphicon glyphicon-remove">
                    </span>&nbsp;<?php echo $this->lang->line('close');?>
                </button>
                <button type="button" id="submit-edit-tags"  class="btn btn-success">
                    <span class="glyphicon glyphicon-ok">
                    </span>&nbsp;<?php echo $this->lang->line('ok');?>
                </button>
            </div>
        </div>
    </div>
</div>
<!--END MODAL-->
<input type="hidden" id="notify_delete" value="<?php echo $this->lang->line('notify_tags_delete');?>"/>