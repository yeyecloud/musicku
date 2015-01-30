<!---MAIN--->

<div id="div-modal-admincp-login" class="modal show">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><?php echo $this->lang->line('signin');?></h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <input class="form-control" id="email" placeholder="<?php echo $this->lang->line('email');?>" data-notify="<?php echo $this->lang->line('notify_email');?>" name="email" type="email" autofocus>
                </div>
                <div class="form-group">
                    <input class="form-control" id="password" placeholder="<?php echo $this->lang->line('password');?>" data-notify="<?php echo $this->lang->line('notify_password');?>" name="password" type="password" value="">
                </div>
                <div class="checkbox">&nbsp;
                    <label>
                        <input id="remember" name="remember" type="checkbox" value="Remember Me"><?php echo $this->lang->line('remember');?>
                    </label>
                </div>
                <!-- Change this to a button or input when using this as a form -->

            </div>
            <div class="modal-footer">
                <a href="#" id="login" data-notify="<?php echo $this->lang->line('warring');?>" class="btn btn-success"><?php echo $this->lang->line('signin');?></a>
            </div>
        </div>
    </div>
</div>

