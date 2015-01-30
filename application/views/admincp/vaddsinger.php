<!-- Navigation -->
	<?php echo $nav_header;?>

<!---MAIN--->
        <div class="container documents">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading"><?php echo $this->lang->line('add_singer');?></div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-6">
                                    <form role="form">
                                        <div class="form-group">
								<label>
									<?php echo $this->lang->line('singer_name');?>
								</label>
								<input class="form-control" type="text" id="singer_name" name="singer_name" data-notify="<?php echo $this->lang->line('notify_singer_name');?>" data-notify-exist="<?php echo $this->lang->line('notify_singer_name_exist');?>">
								<p class="help-block">
									Example:Lady GaGa
								</p>
							</div>
							<div class="form-group">
								<label>
									<?php echo $this->lang->line('singer_url');?>
								</label>
								<input class="form-control" type="text" id="singer_url" name="singer_url" data-notify="<?php echo $this->lang->line('notify_singer_url');?>" data-notify-exist="<?php echo $this->lang->line('notify_singer_url_exist');?>">
								<p class="help-block">
									Example:Lady-GaGa
								</p>
							</div>

							<div class="form-group">
								<label>
									<?php echo $this->lang->line('singer_birthday');?>
								</label>
								<input class="form-control" type="text" id="singer_birthday" name="singer_birthday" data-notify="<?php echo $this->lang->line('notify_singer_birthday');?>">
								<p class="help-block">
									Example:1990-12-20
								</p>
							</div>
                                    </form>
                                </div>

                                <div class="col-xs-12 col-sm-12 col-md-6">
                                    <form role="form">
                                        <div class="form-group" id="up-img-local" style="">
							<div class="progress" id="div-progress-bar-images" style="display: none;">
										<div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
											0%
										</div>
									</div>
								<label>
									<?php echo $this->lang->line('singer_img');?>
									
								</label>
								<input id="file_upload_img_singer" name="file_upload_img_singer" type="file">
							</div>

							<div class="form-group">
								<label>
									<?php echo $this->lang->line('singer_description');?>
								</label>
								<textarea class="form-control" rows="3" id="singer_description" data-notify="<?php echo $this->lang->line('notify_singer_description');?>"></textarea>
								
							</div>
                                    </form>
                                </div>
                            </div>
                            <button type="submit" id="submit-addsinger" class="btn btn-success pull-right">
								<span class="glyphicon glyphicon-ok"></span>&nbsp;<?php echo $this->lang->line('send');?>
							</button>
                        </div>
                    </div>
                </div>
            </div>
        </div> 
<!--INPUT HIDDEN-->
<input type="hidden" id="singer_img" value="" data-notify="<?php echo $this->lang->line('notify_singer_img');?>"/>
