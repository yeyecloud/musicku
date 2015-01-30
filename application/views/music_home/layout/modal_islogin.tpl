<!--MODAL CREAT PLAYLIST-->
<div class="modal fade" id="modalplaylist" tabindex="-1" role="dialog" aria-labelledby="modalplaylist" aria-hidden="true">
<div class="modal-dialog">
  <div class="modal-content bg-dark">
    <div class="modal-header b-black">
      <button type="button" class="close" data-dismiss="modal">&times;</button>
      <h4 class="modal-title">{lang('creat_playlist')}</h4>
    </div>
    <div class="modal-body">
      <form class="bs-example form-horizontal">
                        <div class="form-group">
                          <label class="col-lg-2 control-label">{lang('playlist_name')}</label>
                          <div class="col-lg-10">
                            <input type="text" id="playlist-name" class="form-control" placeholder="{lang('playlist_name')}" data-notify="{lang('notify_not_playlist_name')}">
                            <span class="help-block m-b-none">Example: My Play List</span>
                          </div>
                          
                        </div>
                      <div class="form-group">
                      
                      <label class="col-sm-2 control-label">{lang('images_playlist')}</label>
                      <div class="col-sm-10">
                      	<div class="progress" id="div-progress-bar-song" style="display: none;">
									<div class="progress-bar progress-bar-success progress-bar-striped active"  role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
										0%
							</div>
						</div>
                        <input type="file" id="file_upload_img" name="file_upload_img_playlist" class="filestyle" data-icon="false" data-classButton="btn btn-default" data-classInput="form-control inline v-middle input-s">
                      </div>
                    </div>
                    <input type="hidden" id="img_playlist" value="" data-notify="{lang('notify_images')}"/>
                      </form>
    </div>
    <div class="modal-footer b-black">
      <button class="btn btn-default" data-dismiss="modal">{lang('close')}</button>
      <button onclick="creat_playlist()" class="btn btn-success">{lang('ok')}</button>
    </div>
  </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</div>
<!--END MODAL CREAT PLAYLIST-->
<!--MODAL ADD PLAYLIST-->
<div class="modal fade" id="modaladdplaylist" tabindex="-1" role="dialog" aria-labelledby="modaladdplaylist" aria-hidden="true">
<div class="modal-dialog">
  <div class="modal-content bg-dark">
    <div class="modal-header b-black">
      <button type="button" class="close" data-dismiss="modal">&times;</button>
      <h4 class="modal-title">{lang('notify_add_playlist')}</h4>
    </div>
    <div class="modal-body">
      <form class="bs-example form-horizontal">
                <div class="form-group">
                      <label class="col-sm-2 control-label">{lang('playlist_name')}</label>
                      <div class="col-sm-10">
                        <select class="chosen-select" name="idplaylist" id="idplaylist">
							  {foreach $playlist as $k => $v}
							     <option value="{$v.pl_id}">{$v.pl_name}</option>
							  {/foreach}
                        </select>
                      </div>
                    </div>
       </form>
    </div>
    <div class="modal-footer b-black">
      <button class="btn btn-default" data-dismiss="modal">{lang('close')}</button>
      <button onclick="addSongtoPlaylist()" class="btn btn-success">{lang('ok')}</button>
    </div>
  </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</div>
<!--END MODAL ADD PLAYLIST-->


<!--MODAL EDIT PROFILE-->
<div class="modal fade" id="modaleditprofile" tabindex="-1" role="dialog" aria-labelledby="modaleditprofile" aria-hidden="true">
<div class="modal-dialog">
  <div class="modal-content bg-dark">
    <div class="modal-header b-black">
      <button type="button" class="close" data-dismiss="modal">&times;</button>
      <h4 class="modal-title">{lang('profile_edit')}</h4>
    </div>
    <div class="modal-body">
      <form class="form-horizontal">
                
                    <div class="form-group">
                      <label class="col-sm-2 control-label">{lang('first_name')}</label>
                      <div class="col-sm-10">
                        <input type="text" id="first_name" value="{$data_user->first_name}" data-notify="{lang('notify_first_name')}" class="form-control">
                      </div>
                    </div>
                   <div class="line line-dashed b-b line-lg pull-in"></div>
                   <div class="form-group">
                      <label class="col-sm-2 control-label">{lang('last_name')}</label>
                      <div class="col-sm-10">
                        <input type="text" id="last_name" value="{$data_user->last_name}" data-notify="{lang('notify_last_name')}" class="form-control">
                      </div>
                    </div>
                   <div class="line line-dashed b-b line-lg pull-in"></div>
                  <div class="form-group">
                      <label class="col-sm-2 control-label">{lang('company')}</label>
                      <div class="col-sm-10">
                        <input type="text" id="company" value="{$data_user->company}" data-notify="{lang('notify_company')}" class="form-control">
                      </div>
                   </div>
                   <div class="line line-dashed b-b line-lg pull-in"></div>
                   <div class="form-group">
                      <label class="col-sm-2 control-label">{lang('phone')}</label>
                      <div class="col-sm-10">
                        <input type="number" id="phone" value="{$data_user->phone}" data-notify="{lang('notify_phone')}" class="form-control">
                      </div>
                   </div>
                   <div class="line line-dashed b-b line-lg pull-in"></div>
                   <div class="form-group">
                      <label class="col-sm-2 control-label">{lang('address')}</label>
                      <div class="col-sm-10">
                        <input type="text" id="address" value="{$data_user->address}" data-notify="{lang('notify_address')}" class="form-control">
                      </div>
                   </div>
                   <div class="line line-dashed b-b line-lg pull-in"></div>
                   <div class="form-group">
                      <label class="col-sm-2 control-label">{lang('sex')}</label>
                      <div class="col-sm-10">
                        <div class="radio i-checks">
                          <label>
                            <input type="radio" id="sex" name="a" value="1" {if $data_user->sex==1} checked {/if}>
                            <i></i>
                            {lang('male')}
                          </label>
                        </div>
                        <div class="radio i-checks">
                          <label>
                            <input type="radio" name="a" value="2" {if $data_user->sex==2} checked {/if}>
                            <i></i>
                             {lang('female')}
                          </label>
                        </div>
                      </div>
                    </div>
                   <div class="line line-dashed b-b line-lg pull-in"></div>
                   <div class="form-group">
                      <label class="col-sm-2 control-label">{lang('aboutme')}</label>
                       <div class="col-sm-10">
                      		<textarea id="aboutme" class="form-control" rows="3" data-notify="{lang('notify_aboutme')}">{$data_user->about}</textarea>
                      </div>
                    </div>
                    <div class="line line-dashed b-b line-lg pull-in"></div>
                   <div class="form-group">
                      <label class="col-sm-2 control-label">{lang('avatar')}</label>
                      <div class="col-sm-10">
                      	<div class="progress" id="div-progress-bar-song" style="display: none;">
							<div class="progress-bar progress-bar-success progress-bar-striped active"  role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
										0%
							</div>
						</div>
                        <input type="file" id="file_upload_img_avatar" name="file_upload_img_avatar" data-notify="{lang('notify_avatar')}" class="filestyle" data-icon="false" data-classButton="btn btn-default" data-classInput="form-control inline v-middle input-s">
                      </div>
                    </div>
                  <input  type="hidden" value="{$data_user->avatar}" id="avatar"/>  
       </form>
    </div>
    <div class="modal-footer b-black">
      <button class="btn btn-default" data-dismiss="modal">{lang('close')}</button>
      <button  class="btn btn-success" id="submit-edit-profile">{lang('ok')}</button>
    </div>
  </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</div>
<!--END MODAL EDIT PROFILE-->

<!--MODAL CHANGE PASSWORD-->
<div class="modal fade" id="modalchangepassword" tabindex="-1" role="dialog" aria-labelledby="modalchangepassword" aria-hidden="true">
<div class="modal-dialog">
  <div class="modal-content bg-dark">
    <div class="modal-header b-black">
      <button type="button" class="close" data-dismiss="modal">&times;</button>
      <h4 class="modal-title">{lang('change_password')}</h4>
    </div>
    <div class="modal-body">
      <form class="bs-example form-horizontal">
                        <div class="form-group">
                          <label class="col-lg-2 control-label">{lang('password_old')}</label>
                          <div class="col-lg-10">
                            <input type="password" class="form-control" id="password_old">
                        
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-lg-2 control-label">{lang('password_new')}</label>
                          <div class="col-lg-10">
                            <input type="password" class="form-control" id="password_new" data-notify="{lang('notify_not_password_old')}">
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-lg-2 control-label">{lang('re_password_new')}</label>
                          <div class="col-lg-10">
                            <input type="password" class="form-control" id="re_password_new" data-notify="{lang('notify_not_config_password')}">
                          </div>
                        </div>
        </form>
    </div>
    <div class="modal-footer b-black">
      <button class="btn btn-default" data-dismiss="modal">{lang('close')}</button>
      <button id="submit-change-password" class="btn btn-success">{lang('ok')}</button>
    </div>
  </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</div>
<!--END MODAL CHANGE PASSWORD-->


<!--MODAL EDIT PLAYLIST-->
<div class="modal fade" id="modaleditplaylist" tabindex="-1" role="dialog" aria-labelledby="modaleditplaylist" aria-hidden="true">
<div class="modal-dialog">
  <div class="modal-content bg-dark">
    <div class="modal-header b-black">
      <button type="button" class="close" data-dismiss="modal">&times;</button>
      <h4 class="modal-title">{lang('notify_add_playlist')}</h4>
    </div>
    <div class="modal-body">
      <form class="bs-example form-horizontal">
                <div class="form-group">
                          <label class="col-lg-2 control-label">{lang('playlist_name')}</label>
                          <div class="col-lg-10">
                            <input type="text" class="form-control" id="playlist_edit_name" name="playlist_edit_name" value="" data-notify="{lang('notify_not_playlist_name')}">
                          </div>
                 </div>
                 <div class="line line-dashed b-b line-lg pull-in"></div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label">{lang('images_playlist')}</label>
                      <div class="col-sm-10">
                      	<div class="progress" id="div-progress-bar-song" style="display: none;">
							<div class="progress-bar progress-bar-success progress-bar-striped active"  role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
										0%
							</div>
						</div>
                        <input type="file" id="file_upload_img" name="file_upload_img" data-notify="{lang('notify_images')}" class="filestyle" data-icon="false" data-classButton="btn btn-default" data-classInput="form-control inline v-middle input-s">
                      </div>
                    </div>
                <input  type="hidden" id="img_playlist" value=""/>
                
        </form>
    </div>
    <div class="modal-footer b-black">
      <button class="btn btn-default" data-dismiss="modal">{lang('close')}</button>
      <button onclick="submit_edit_playlist()" id="submit-edit-playlist" data-id-playlist="" class="btn btn-success">{lang('ok')}</button>
    </div>
  </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</div>
<!--END MODAL EDIT PLAYLIST-->