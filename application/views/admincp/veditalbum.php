<!-- Navigation -->
<?php echo $nav_header;?>

<!---MAIN--->
<div class="container documents">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading"><?php echo lang('album_edit');?></div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6">
                            <form role="form">
                                <div class="form-group">
                                    <label for="input-admincp-album-name"><?php echo lang('album_name');?></label>
                                    <input id="input-admincp-album-name" type="text" class="form-control" value="<?php echo $info_album['al_name'];?>" autocomplete="off" data-notify="<?php echo lang('notify_required_or_not_type');?>"/>
                                </div>
                                <p class="help-block">Ex:My Album</p>
                                <hr/>
                                <div class="form-group">
                                    <label for="input-admincp-album-url"><?php echo lang('album_url');?></label>
                                    <input id="input-admincp-album-url" type="url" class="form-control" value="<?php echo $info_album['al_url'];?>" autocomplete="off" data-notify="<?php echo lang('notify_required_or_not_type');?>"/>
                                </div>
                                <!--PROCESSBAR-->
                                <div class="progress" id="div-progress-bar-images" style="display: none;">
                                        <div class="progress-bar progress-bar-success progress-bar-striped active"  role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
                                            0%
                                        </div>
                                </div>
                                
                            </form>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-6">

                            <form role="form">

                                <div class="form-group">
                                    <label for="textarea-admincp-album-description"><?php echo lang('album_description');?></label>
                                    <textarea style="min-height: 108px;" id="textarea-admincp-album-description" data-notify="<?php echo lang('notify_required_or_not_type');?>" class="form-control"><?php echo $info_album['al_description'];?></textarea>
                                </div>
                                <!--IMAGES-->
                                <div class="form-group">
                                    <label id="notify-link-img">
                                        Images
                                    </label><br/>
                                    <label class="radio-inline">
                                        <input type="radio" name="img_url_local_picasa" id="img_url" value="url">Link
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="img_url_local_picasa" id="img_local" value="url">Local
                                    </label>
                                    
                                </div>

                                <div class="form-group" id="url-img" style="display: none;">
                                    <label>
                                        Link Images
                                    </label>
                                    <input class="form-control" value="<?php echo $info_album['al_image'];?>" type="url" id="link-img" name="link-img" data-notify="<?php echo lang('notify_required_or_not_type');?>">
                                </div>
                                <div class="form-group" id="up-img-local" style="display: none;">
                                    <label>
                                        Upload Images
                                    </label>
                                    <input id="file_upload_img" name="file_upload_img_album" type="file">
                                </div>

                                <!--END IMAGES-->
                            </form>
                        </div>
                    </div>
                    <button id="button-submit-admincp-edit-album" class="btn btn-success pull-right"><?php echo lang('send');?></button>
                </div>
            </div>
        </div>
    </div>
</div>
<!---INPUT HIDDEN--->
<input type="hidden" id="al-image-old" value="<?php echo $info_album['al_image'];?>"/>
<input type="hidden" id="al-id" value="<?php echo $info_album['al_id'];?>"/>