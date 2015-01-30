<!-- Navigation -->
<?php echo $nav_header;?>

<!---MAIN--->
<div class="container documents">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading"><?php echo lang('user_add_new');?></div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6">
                            <form role="form">
                                <div class="form-group">
                                    <label>
                                        <?php echo $this->lang->line('email');?>
                                    </label>
                                    <input class="form-control" type="email" id="email" name="email" data-notify="<?php echo $this->lang->line('notify_email');?>">
                                    <p class="help-block">
                                        Example:admin@admin.com
                                    </p>
                                </div>
                                <div class="form-group">
                                    <label>
                                        <?php echo $this->lang->line('username');?>
                                    </label>
                                    <input class="form-control" type="text" id="username" name="username" data-notify="<?php echo $this->lang->line('notify_required');?>">
                                    <p class="help-block">
                                        Example:admin
                                    </p>
                                </div>

                                <div class="form-group">
                                    <label>
                                        <?php echo $this->lang->line('password');?>
                                        <button type="button" id="random_password" class="btn btn-primary btn-xs">
                                            <?php echo $this->lang->line('random_password');?>
                                        </button>
                                    </label>
                                    <input class="form-control" type="text" id="password" name="password" data-notify="<?php echo $this->lang->line('notify_password');?>">
                                    <p class="help-block">
                                        Example:password
                                    </p>
                                </div>
                            </form>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-6">
                            <form role="form">
                                <div class="form-group">
                                    <label>
                                        <?php echo $this->lang->line('first_name');?>
                                    </label>
                                    <input class="form-control" type="text" id="first_name" name="first_name" data-notify="<?php echo $this->lang->line('notify_first_name');?>">
                                    <p class="help-block">
                                        Example:Norwood
                                    </p>
                                </div>

                                <div class="form-group">
                                    <label>
                                        <?php echo $this->lang->line('last_name');?>
                                    </label>
                                    <input class="form-control" type="text" id="last_name" name="last_name" data-notify="<?php echo $this->lang->line('notify_last_name');?>">
                                    <p class="help-block">
                                        Example:Jason Mark
                                    </p>
                                </div>

                                <div class="form-group">
                                    <label id="notify-source-song">
                                        <?php echo $this->lang->line('groups');?>
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" checked="checked" name="admin_or_member" id="member" value="2"><?php echo $this->lang->line('groups_member');?>
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="admin_or_member" id="admin" value="1"><?php echo $this->lang->line('groups_admin');?>
                                    </label>
                                </div>
                            </form>
                        </div>
                    </div>
                    <button type="submit" id="submit-addUser" class="btn btn-success pull-right">
                        <span class="glyphicon glyphicon-ok"></span>&nbsp;<?php echo $this->lang->line('send');?>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
<!---INPUT HIDDEN-->
<input type="hidden" id="check_email" value="0" data-notify="<?php echo $this->lang->line('notify_email_exists');?>"/>
<input type="hidden" id="check_username" value="0" data-notify="<?php echo $this->lang->line('notify_username_exists');?>"/>
