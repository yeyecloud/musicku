<!-- Navigation -->
<?php echo $nav_header;?>

<!---MAIN--->
<div class="container documents">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading"><?php echo lang('category_manage');?></div>
                <div class="panel-body">

                    <div class="table-responsive">
                        <table class="table table-bordered table-hover" id="dataTables-example">
                            <thead>
                                <tr>
                                    <th>
                                        ID
                                    </th>
                                    <th>
                                        <?php echo lang('album_name');?>
                                    </th>
                                    <th>
                                        <?php echo lang('url');?>
                                    </th>
                                    
                                    <th>
                                        <?php echo lang('url');?>
                                    </th>
                                    <th>
                                        <?php echo lang('actions');?>
                                    </th>

                                </tr>
                            </thead>
                           
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> 

<!--MODAL-->
<div class="modal fade" id="modal-manage-song-in-album" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">
                        &times;
                    </span>
                    <span class="sr-only">
                        <?php echo lang('close');?>
                    </span>
                </button>
                <h4 class="modal-title" id="myModalLabel">
                    <?php echo lang('album_manage_song');?>
                </h4>
            </div>
            <div class="modal-body">
             <ul id="ul-content-song" class="list-group" style="overflow: auto;max-height: 200px;">
            	
            </ul>

            </div>
            <div class="modal-footer">
         
                <button type="button"  class="btn" data-dismiss="modal"><?php echo lang('close');?></button>
            </div>
        </div>
    </div>
</div>
<!--END MODAL-->