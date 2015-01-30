
<!-- Navigation -->
<?php echo $nav_header;?>

<!---MAIN--->
<div class="container documents">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading"><?php echo $this->lang->line('settings_name');?></div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6">
                            <form role="form">
                                <div class="form-group">
                                    <label>
                                        <?php echo $this->lang->line('settings_title_home');?>
                                    </label>
                                    <input class="form-control" type="text" id="settings_title_home" name="settings_title_home" value="<?php echo $data_settings['set_title_home'];?>" data-notify="<?php echo $this->lang->line('notify_title_settings');?>">
                                    <p class="help-block">
                                        Example:My Website
                                    </p>
                                </div>
                                <div class="form-group">
                                    <label>
                                        <?php echo $this->lang->line('settings_description_home');?>
                                    </label>
                                    <input class="form-control" type="text" id="settings_description_home" name="settings_description_home" value="<?php echo $data_settings['set_description_home'];?>" data-notify="<?php echo $this->lang->line('notify_description_hone');?>">
                                    <p class="help-block">
                                        Example:Description my website
                                    </p>
                                </div>

                                <div class="form-group">
                                    <label>
                                        <?php echo $this->lang->line('settings_analytics');?>
                                    </label>
                                    <textarea class="form-control" id="settings_analytics" name="settings_analytics" style="min-height: 60px;" data-notify="<?php echo $this->lang->line('notify_analytics');?>"><?php echo $data_settings['set_analytics'];?></textarea>
                                </div>
                                <hr/>
                                <div class="form-group">
                                    <label>
                                        <?php echo $this->lang->line('settings_title_song');?>
                                    </label>
                                    <input class="form-control" type="text" id="settings_title_song" name="settings_title_song" value="<?php echo $data_settings['set_title_song'];?>" data-notify="<?php echo $this->lang->line('notify_title_song');?>">
                                    <p class="help-block">
                                        Example:Not remove or change {song-name}
                                    </p>
                                </div>

                                <div class="form-group">
                                    <label>
                                        <?php echo $this->lang->line('settings_description_song');?>
                                    </label>
                                    <input class="form-control" type="text" id="settings_description_song" name="settings_description_song" value="<?php echo $data_settings['set_description_song'];?>" data-notify="<?php echo $this->lang->line('notify_description_song');?>">
                                    <p class="help-block">
                                        Example:Not remove or change {song-name}
                                    </p>
                                </div>
                                <hr/>

                                <div class="form-group">
                                    <label>
                                        <?php echo $this->lang->line('settings_title_category');?>
                                    </label>
                                    <input class="form-control" type="text" id="settings_title_category" name="settings_title_category" value="<?php echo $data_settings['set_title_category'];?>" data-notify="<?php echo $this->lang->line('notify_title_category');?>">
                                    <p class="help-block">
                                        Example:Not remove or change {category-name}
                                    </p>
                                </div>

                                <div class="form-group">
                                    <label>
                                        <?php echo $this->lang->line('settings_description_category');?>
                                    </label>
                                    <input class="form-control" type="text" id="settings_description_category" name="settings_description_category" value="<?php echo $data_settings['set_description_category'];?>" data-notify="<?php echo $this->lang->line('notify_description_category');?>">
                                    <p class="help-block">
                                        Example:Not remove or change {category-name}
                                    </p>
                                </div>
                                <hr/>

                                <div class="form-group">
                                    <label>
                                        <?php echo $this->lang->line('settings_title_playlist');?>
                                    </label>
                                    <input class="form-control" type="text" id="settings_title_playlist" name="settings_title_playlist" value="<?php echo $data_settings['set_title_playlist'];?>" data-notify="<?php echo $this->lang->line('notify_title_playlist');?>">
                                    <p class="help-block">
                                        Example:Not remove or change {playlist-name}
                                    </p>
                                </div>
                            </form>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-6">
                            <form role="form">
                                <div class="form-group">
                                    <label>
                                        <?php echo $this->lang->line('settings_description_playlist');?>
                                    </label>
                                    <input class="form-control" type="text" id="settings_description_playlist" name="settings_description_playlist" value="<?php echo $data_settings['set_description_playlist'];?>" data-notify="<?php echo $this->lang->line('notify_description_playlist');?>">
                                    <p class="help-block">
                                        Example:Not remove or change {playlist-name}
                                    </p>
                                </div>
                                
                                <div class="form-group">
                                    <label>
                                        <?php echo $this->lang->line('settings_title_profile');?>
                                    </label>
                                    <input class="form-control" type="text" id="settings_title_profile" name="settings_title_profile" value="<?php echo $data_settings['set_title_profile'];?>" data-notify="<?php echo $this->lang->line('notify_title_profile');?>">
                                    <p class="help-block">
                                        Example:Not remove or change {profile-name}
                                    </p>
                                </div>

                                <div class="form-group">
                                    <label>
                                        <?php echo $this->lang->line('settings_description_profile');?>
                                    </label>
                                    <input class="form-control" type="text" id="settings_description_profile" name="settings_description_profile" value="<?php echo $data_settings['set_description_profile'];?>" data-notify="<?php echo $this->lang->line('notify_description_profile');?>">
                                    <p class="help-block">
                                        Example:Not remove or change {profile-name}
                                    </p>
                                </div>
                                <hr/>

                                <div class="form-group">
                                    <label>
                                        <?php echo $this->lang->line('settings_title_singer');?>
                                    </label>
                                    <input class="form-control" type="text" id="settings_title_singer" name="settings_title_singer" value="<?php echo $data_settings['set_title_singer'];?>" data-notify="<?php echo $this->lang->line('notify_title_singer');?>">
                                    <p class="help-block">
                                        Example:Not remove or change {singer-name}
                                    </p>
                                </div>

                                <div class="form-group">
                                    <label>
                                        <?php echo $this->lang->line('settings_description_singer');?>
                                    </label>
                                    <input class="form-control" type="text" id="settings_description_singer" name="settings_description_singer" value="<?php echo $data_settings['set_description_singer'];?>" data-notify="<?php echo $this->lang->line('notify_description_singer');?>">
                                    <p class="help-block">
                                        Example:Not remove or change {singer-name}
                                    </p>
                                </div>
                                <hr/>

                                <div class="form-group">
                                    <label>
                                        <?php echo $this->lang->line('settings_title_tags');?>
                                    </label>
                                    <input class="form-control" type="text" id="settings_title_tags" name="settings_title_tags" value="<?php echo $data_settings['set_title_tags'];?>" data-notify="<?php echo $this->lang->line('notify_title_tags');?>">
                                    <p class="help-block">
                                        Example:Not remove or change {tags-name}
                                    </p>
                                </div>

                                <div class="form-group">
                                    <label>
                                        <?php echo $this->lang->line('settings_description_tags');?>
                                    </label>
                                    <input class="form-control" type="text" id="settings_description_tags" name="settings_description_tags" value="<?php echo $data_settings['set_description_tags'];?>" data-notify="<?php echo $this->lang->line('notify_description_tags');?>">
                                    <p class="help-block">
                                        Example:Not remove or change {tags-name}
                                    </p>
                                </div>
                                <hr/>

                            </form>
                        </div>
                    </div>
                    <button type="submit" id="submit-settings" class="btn btn-success pull-right">
                        <span class="glyphicon glyphicon-ok"></span>&nbsp;<?php echo $this->lang->line('send');?>
                    </button>
                    
                </div>
            </div>
        </div>
    </div>
</div> 