<!-- Navigation -->
	<?php echo $nav_header;?>
<!---MAIN--->
        <div class="container documents">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading"><?php echo lang('category_edit');?></div>
                        <div class="panel-body">
                           <form role="form">
							<div class="form-group">
								<label>
									<?php echo lang('category_name');?>
								</label>
								<input class="form-control" type="text" id="category-name" name="category-name" value="<?php echo $info_cat['cat_name'];?>" data-notify="<?php lang('notify_required');?>">
								<p class="help-block">
									Ex: My category
								</p>
							</div>
							<div class="form-group">
								<label>
									<?php echo lang('url');?>
								</label>
								<input class="form-control" type="text" id="category-url" name="category-url" value="<?php echo $info_cat['cat_url'];?>" data-notify="<?php lang('notify_required');?>">
								<p class="help-block">
									Ex: My-category
								</p>
							</div>
							<div class="form-group">
								<?php 
									if($info_cat['cat_type']==1){
										$checked_audio='checked';
										$checked_video='';
									}else{
										$checked_audio='';
										$checked_video='checked';
									}
								?>
								<label >
									<?php echo lang('video_or_audio');?>
								</label>
								<label class="radio-inline">
									<input type="radio" name="video_or_audio" id="audio" <?php echo $checked_audio;?> value="audio"><?php echo lang('audio');?>
								</label>
								<label class="radio-inline">
									<input type="radio" name="video_or_audio" id="video" <?php echo $checked_video;?> value="video"><?php echo lang('video');?>
								</label>
							</div>

							
							<!--IMAGES-->
							<div class="form-group">
								<label id="notify-link-img">
									Images
								</label>
								<div class="progress" id="div-progress-bar-images" style="display: none;">
									<div class="progress-bar progress-bar-success progress-bar-striped active"  role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
										0%
									</div>
								</div>
								<input id="file_upload_img_category" name="file_upload_img_category" type="file">
							</div>

							<!--END IMAGES-->
							
							<div class="form-group">
								<label>
									<?php echo lang('tags_add');?>
								</label>
								<input class="form-control" value="<?php echo $tags_name;?>"  type="text" id="tags-category" name="tags-category" data-notify="<?php lang('notify_required');?>">
								<p class="help-block">
									Ex: Lady GaGa,Abc,...
								</p>
							</div>
							<div class="form-group">
								<label>
									<?php echo lang('description');?>
								</label>
								<textarea class="form-control" rows="3" id="category_description" data-notify="<?php lang('notify_required');?>"><?php echo $info_cat['cat_description'];?></textarea>
								<p class="help-block">
				
								</p>
							</div>

						</form>
						<button type="submit" id="submit-addCategory" class="btn btn-success pull-right">
								<i class="glyphicon glyphicon-ok"></i> <?php echo lang('send');?>
							</button>
                        </div>
                    </div>
                </div>
            </div>
        </div> 
<!--INPUT HIDDEN-->
<input type="hidden" id="img_category" value="<?php echo $info_cat['cat_img'];?>" data-notify="<?php lang('notify_required');?>"/>
<input type="hidden" id="cat_id" value="<?php echo $info_cat['cat_id'];?>" data-notify="<?php lang('notify_required');?>"/>

