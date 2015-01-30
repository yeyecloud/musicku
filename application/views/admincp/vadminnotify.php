<!-- Navigation -->
<?php echo $nav_header;?>

<!---MAIN--->
<div class="container documents">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading"><?php echo $this->lang->line('settings_add_notify');?></div>
                <div class="panel-body">
                    <form role="form">

                        <div class="form-group">
                            <label>
                                <?php echo $this->lang->line('settings_notify_content');?>
                            </label>
                            <textarea class="form-control" id="settings_notify_content" name="settings_notify_content" data-notify="<?php echo $this->lang->line('notify_content_notify');?>"></textarea>
                        </div>

                    </form>
                    <button type="submit" id="submit-settings-notify" class="btn btn-success pull-right">
                        <span class="glyphicon glyphicon-ok"></span>&nbsp;<?php echo $this->lang->line('send');?>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>