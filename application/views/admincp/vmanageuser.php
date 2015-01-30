<!-- Navigation -->
<?php echo $nav_header;?>

<!---MAIN--->
<div class="container documents">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading"><?php echo $this->lang->line('manage_users');?></div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover" id="dataTables-example">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th><?php echo $this->lang->line('username');?></th>
                                    <th><?php echo $this->lang->line('email');?></th>
                                    <th><?php echo $this->lang->line('first_name');?></th>
                                    <th><?php echo $this->lang->line('last_name');?></th>
                                    <th><?php echo $this->lang->line('phone');?></th>
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
<!--INPUT HIDDEN-->
<input id="notify_reset_password" type="hidden" value="<?php echo $this->lang->line('reset_password');?>"/>