
<!-- Navigation -->
<?php echo $nav_header; ?>
<!---MAIN--->
<div class="container documents">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading"> <?php echo lang('category_add_new'); ?></div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6">
                            <form role="form">
                                <div class="form-group">
                                    <label>
                                        <?php echo lang('category_name'); ?>
                                    </label>
                                    <input class="form-control" type="text" id="category-name" name="category-name" data-notify="<?php echo lang('notify_required'); ?>">
                                    <p class="help-block">
                                        Ex: My category
                                    </p>
                                </div>
                                <hr/>
                                <div class="form-group">
                                    <label>
                                        <?php echo lang('url'); ?>
                                    </label>
                                    <input class="form-control" type="text" id="category-url" name="category-url" data-notify="<?php echo lang('notify_required'); ?>">
                                    <p class="help-block">
                                        Ex: My-category
                                    </p>
                                </div>
                                <div class="form-group">
                                    <label id="notify-source-song">
                                        <?php echo lang('video_or_audio'); ?>
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="video_or_audio" id="audio" value="audio"><?php echo lang('audio'); ?>
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="video_or_audio" id="video" value="video"><?php echo lang('video'); ?>
                                    </label>
                                </div>

                            </form>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-6">
                            <form role="form">
                            	<div class="form-group">
                                    <label>
                                        <?php echo lang('description'); ?>
                                    </label>
                                    <textarea class="form-control" rows="3" id="category_description" data-notify="<?php echo lang('notify_required'); ?>"></textarea>
                                    <p class="help-block">

                                    </p>
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
                                        <?php echo lang('tags_add'); ?>
                                    </label>
                                    <input class="form-control"  type="text" id="tags-category" name="tags-category" data-notify="<?php echo lang('notify_required'); ?>">
                                    <p class="help-block">
                                        Ex: Lady GaGa,Abc,...
                                    </p>
                                </div>
                                
                            </form>
                        </div>
                    </div>
                    <button type="submit" id="submit-addCategory" class="btn pull-right btn-success">
                        <i class="glyphicon glyphicon-ok"></i>&nbsp;<?php echo lang('send'); ?>
                    </button>

                </div>
            </div>
        </div>
    </div>
</div> 
<!--INPUT HIDDEN-->
<input type="hidden" value="" id="img_category" data-notify="<?php echo lang('notify_required'); ?>"/>