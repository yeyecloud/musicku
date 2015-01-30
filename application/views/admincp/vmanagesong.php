<!-- Navigation -->
<?php echo $nav_header;?>
<!---MAIN--->
<div class="container documents">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading"><?php echo lang('song_manage');?></div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover" id="dataTables-example">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th><?php echo lang('song_name');?></th>
                                    <th><?php echo lang('category');?></th>
                                    <th>(1=Audio)</th>
                                    <th><?php echo lang('url');?></th>
                                    <th><?php echo lang('song_user_send');?></th>
                                    <th><?php echo lang('actions');?></th>
                                </tr>
                            </thead>
                            
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!---MODAL--->
<div id="div-modal-admincp-add-to-album" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    	<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title"><?php echo lang('album_add_song');?></h4>
                    </div>
                    <div class="modal-body">
                        <select id="select-id-album" name="selecter_basic" class="selecter_3"  data-selecter-options='{"cover":"true"}'>
							<?php
							$album_result='';
							foreach ($album as $k=>$v){
								$album_result .='<option value="'.$v['al_id'].'">'.$v['al_name'].'</option>';
							}
							echo $album_result;
							?>
						</select>
						<input type="hidden" id="s_id" value=""/>
                    </div>
                    <div class="modal-footer">
                    	<button type="button" class="btn btn-default" data-dismiss="modal"><?php echo lang('close');?></button>
                        <button id="button-submit-admincp-add-to-album" class="btn btn-success"><?php echo lang('send');?></button>
                    </div>
                </div>
            </div>
</div>

