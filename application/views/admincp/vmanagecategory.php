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
                                        <?php echo lang('category_name');?>
                                    </th>
                                    <th>
                                        <?php echo lang('category');?>
                                    </th>
                                    <th>
                                        <?php echo lang('category');?>(1=Audio)
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
<div class="modal fade" id="modal-delete-category" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                    <?php echo lang('category_delete');?>
                </h4>
            </div>
            <div class="modal-body">
                <input type="hidden" value="" id="category-del" data-notify="<?php echo lang('category_convert_exist');?>"/>
                <?php echo lang('total');?> <p id="count-song-in-category"></p>
                <?php echo lang('category_convert');?>
                <select id="category" class="selectpicker">

                    <optgroup label="Song">
                        <?php
                        foreach($all_category as $k=>$v){
                        if($v['cat_type'] == 1){


                        ?>
                        <option id="disable-<?php echo $v['cat_id'];?>" value="<?php echo $v['cat_id'];?>">
                            <?php echo $v['cat_name'];?>
                        </option>

                        <?php
                        }
                        }
                        ?>
                    </optgroup>
                    <optgroup label="Video">
                        <?php
                        foreach($all_category as $k=>$v){
                        if($v['cat_type'] == 2){


                        ?>
                        <option id="disable-<?php echo $v['cat_id'];?>" value="<?php echo $v['cat_id'];?>">
                            <?php echo $v['cat_name'];?>
                        </option>

                        <?php
                        }
                        }
                        ?>
                    </optgroup>
                </select>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">
                    <?php echo lang('close');?>
                </button>
                <button type="button" id="submit-delete-category" class="btn btn-success">
                    <?php echo lang('send');?>
                </button>
            </div>
        </div>
    </div>
</div>
<!--END MODAL-->