<!-- Navigation -->
<?php echo $nav_header;?>
<!---MAIN--->
<div class="container documents">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading"><?php echo $this->lang->line('tags_add');?></div>
                <div class="panel-body">
                    <form role="form">
                        <div class="form-group">
                            <label>
                                <?php echo $this->lang->line('tags_name');?>
                            </label>
                            <input class="form-control" type="text" id="tags_name" name="tags_name" data-notify="<?php echo $this->lang->line('notify_tags_name');?>" data-notify-exist="<?php echo $this->lang->line('notify_tags_name_exist');?>">
                            <p class="help-block">
                                Example:Tags 1
                            </p>
                        </div>

                    </form>
                    <button type="submit" id="submit-addTags" class="btn btn-success pull-right">
                        <span class="glyphicon glyphicon-ok">
                        </span>&nbsp;<?php echo $this->lang->line('send');?>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>