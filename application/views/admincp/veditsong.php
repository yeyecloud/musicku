<!-- Navigation -->
	<?php echo $nav_header;?>
<!---MAIN--->
        <div class="container documents">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading"><?php echo lang('song_edit');?></div>
                        <div class="panel-body">
                           <form role="form">
							<div class="form-group">
								<label>
									<?php echo lang('song_name');?>
								</label>
								<input class="form-control" type="text" id="song-name" name="song-name" value="<?php echo $info_song['s_name'];?>" data-notify="<?php echo lang('notify_required');?>">
								<p class="help-block">
									Ex: Gangnam Style
								</p>
							</div>
							<div class="form-group">
								<label>
									<?php echo lang('url');?>
								</label>
								<input class="form-control" type="text" id="song-url" name="song-url" value="<?php echo $info_song['s_url'];?>" data-notify="<?php echo lang('notify_required');?>">
								<p class="help-block">
									Ex: Gangnam-Style
								</p>
							</div>
							<div class="form-group">
								<label id="notify-source-song">
									<?php echo lang('video_or_audio');?>
								</label>
								<?php
								if($info_song['s_type']==2){
									$video_checked='checked';
									$audio_checked='';
								}else{
									$video_checked='';
									$audio_checked='checked';
								}
								
								?>
								<label class="radio-inline">
									<input type="radio" name="video_or_audio" id="audio" value="audio" <?php echo $audio_checked;?>><?php echo lang('audio');?>
								</label>
								<label class="radio-inline">
									<input type="radio" name="video_or_audio" id="video" value="video" <?php echo $video_checked;?>><?php echo lang('video');?>
								</label>
							</div>

							<div class="form-group" id="url_upload" style="display: none;">
								<label>
									Url or Upload
								</label>
								<label class="radio-inline">
									<input type="radio" name="url_or_upload" id="url" value="url">Url
								</label>
								<label class="radio-inline">
									<input type="radio" name="url_or_upload" id="upload" value="upload">Upload
								</label>
								<div class="progress" id="div-progress-bar-song" style="display: none;">
									<div class="progress-bar progress-bar-success progress-bar-striped active"  role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
										0%
									</div>
								</div>
							</div>

							<div class="form-group" id="upload-audio" style="display: none;">
								<label>
									Upload Audio
								</label>
								<input id="file_upload_audio" type="file" name="file_upload_audio">
								<p id="note_upload" class="help-block">
									Ex: Mp3 File
								</p>
							</div>

							<div class="form-group" id="upload-video" style="display: none;">
								<label>
									Upload video
								</label>
								<input id="file_upload_video" type="file" name="file_upload_video">
								<p id="note_upload" class="help-block">
									Ex: Mp4 File
								</p>
							</div>

							<div class="form-group" id="url" style="display: none;">
								<label>
									Link Video or Audio
								</label>
								<input class="form-control" type="url" id="url-link" name="url-link" data-notify="<?php echo lang('notify_required_or_not_type');?>">
							</div>
							<!--IMAGES-->
							<div class="form-group">
								<label id="notify-link-img">
									Images
								</label>
								<?php
								$reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";
								if(preg_match($reg_exUrl,$info_song['s_img'],$match)==true){
									$img_url_checked='checked';
									$img_local_checked='';
								}else{
									$img_url_checked='';
									$img_local_checked='checked';
								}
								?>
								<label class="radio-inline">
									<input type="radio" name="img_url_local_picasa" id="img_url" value="url" <?php echo $img_url_checked;?>>Link
								</label>
								<label class="radio-inline">
									<input type="radio" name="img_url_local_picasa" id="img_local" value="url" <?php echo $img_local_checked;?>>Local
								</label>
								<div class="progress" id="div-progress-bar-images" style="display: none;">
									<div class="progress-bar progress-bar-success progress-bar-striped active"  role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
										0%
									</div>
								</div>
							</div>

							<div class="form-group" id="url-img" style="display: none;">
								<label>
									Link Images
								</label>
								<input class="form-control" type="url" id="link-img" name="link-img" data-notify="<?php echo lang('notify_required_or_not_type');?>">
							</div>
							<div class="form-group" id="up-img-local" style="display: none;">
								<label>
									Upload Images
								</label>
								<input id="file_upload_img" name="file_upload_images" type="file">
							</div>

							<!--END IMAGES-->
							<!--CATEGORY-->
							<div class="form-group">
								<label>
									<?php echo lang('category');?>
								</label>
								<select id="category" class="selectpicker">

									<optgroup label="Song">
										<?php
										foreach($all_category as $k=>$v)
										{
											if($v['cat_type'] == 1)
											{
												if($info_song['cat_id']==$v['cat_id']){
													$select='selected';
												}else{
													$select='';
												}	

												?>
												<option value="<?php echo $v['cat_id'];?>" <?php echo $select;?>>
													<?php echo $v['cat_name'];?>
												</option>

												<?php
											}
										}
										?>
									</optgroup>
									<optgroup label="Video">
										<?php
										foreach($all_category as $k=>$v)
										{
											if($v['cat_type'] == 2)
											{

												if($info_song['cat_id']==$v['cat_id']){
													$select='selected';
												}else{
													$select='';
												}
												?>
												<option value="<?php echo $v['cat_id'];?>" <?php echo $select;?>>
													<?php echo $v['cat_name'];?>
												</option>

												<?php
											}
										}
										?>
									</optgroup>
								</select>

							</div>
							<!--END CATEGORY-->
							<div class="form-group">
								<label>
									<?php echo lang('singer_name');?>
								</label>
								<input class="form-control" type="text" id="singer-song" name="singer-song" value="<?php echo $info_song['si_name'];?>" data-notify="<?php echo lang('notify_required');?>">
								<p class="help-block">
									Ex: Lady GaGa not Include %
								</p>
							</div>
							<div class="form-group">
								<label>
									<?php echo lang('tags_add');?>
								</label>
								<input class="form-control"  type="text" id="tags-song" name="tags-song" data-notify="<?php echo lang('notify_required');?>" value="<?php echo $tags_name;?>">
								<p class="help-block">
									Ex: Lady GaGa,Abc,..
								</p>
							</div>
							<div class="form-group">
								<label>
									<?php echo lang('song_lyrics');?>
								</label>
								<textarea id="lyrics" class="form-control" rows="3"><?php echo $info_song['ly_text'];?></textarea>
								
							</div>

							
							
						</form>
                            <button type="submit" id="submit-addSong" class="btn btn-success pull-right">
								<i class="glyphicon glyphicon-ok"></i> <?php echo lang('send');?>
							</button>
                        </div>
                    </div>
                </div>
            </div>
        </div> 
<!--INPUT HIDDEN-->
<input type="hidden" id="link-song" value="<?php echo $info_song['s_link']?>" data-notify="<?php echo lang('notify_required');?>"/>
<input type="hidden" id="link-img-hide" value="<?php echo $info_song['s_img']?>" data-notify="<?php echo lang('notify_required');?>"/>
<input type="hidden" id="name-upload" value="<?php echo $info_song['s_url']?>" data-notify="<?php echo lang('notify_required');?>"/>
<input type="hidden" id="s_id" value="<?php echo $s_id;?>" data-notify="<?php echo lang('notify_required');?>"/>
<input type="hidden" id="ly_id" value="<?php echo $info_song['ly_id'];?>" data-notify="<?php echo lang('notify_required');?>"/>