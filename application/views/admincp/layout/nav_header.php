<nav class="navbar navbar-default navbar-custom" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#"><img src="<?php echo base_url();?>assets/admincp/img/logo.png" height="40">
            </a>
        </div>
        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav navbar-right">
                
                
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle current" data-toggle="dropdown">CP-1<b class="caret"></b></a>
                    <ul class="dropdown-menu" role="menu">
                        <li class="dropdown-header">
                            <i class="fa fa-music"></i>&nbsp;<?php echo lang( 'song');?>
                        </li>
                        <li>
                            <a href="<?php echo base_url('admincp/song/add');?>">
                                <i class="fa fa-plus-square"></i>&nbsp;<?php echo lang( 'song_add');?>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url('admincp/song/manage/');?>">
                                <i class="fa fa-list-alt"></i>&nbsp;<?php echo lang( 'song_manage');?>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li class="dropdown-header">
                            <i class="fa fa-user"></i>&nbsp;<?php echo lang( 'member');?>
                        </li>
                        <li>
                            <a href="<?php echo base_url('admincp/user/add/');?>">
                                <i class="fa fa-plus-square"></i>&nbsp;<?php echo lang( 'member_add');?>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url('admincp/user/manage/');?>">
                                <i class="fa fa-list-alt"></i>&nbsp;<?php echo lang( 'member_manage');?>
                            </a>
                        </li>

                        <li class="divider"></li>
                        <li class="dropdown-header">
                            <i class="fa fa-list"></i>&nbsp;<?php echo lang( 'category');?>
                        </li>
                        <li>
                            <a href="<?php echo base_url('admincp/category/addnew');?>">
                                <i class="fa fa-plus-square"></i>&nbsp;<?php echo lang( 'category_add_new');?>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url('admincp/category/manage');?>">
                                <i class="fa fa-list-alt"></i>&nbsp;<?php echo lang( 'category_manage');?>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li class="dropdown-header">
                            <i class="fa fa-users"></i>&nbsp;<?php echo lang( 'singer');?>
                        </li>

                        <li>
                            <a href="<?php echo base_url('admincp/singer/add/');?>">
                                <i class="fa fa-plus-square"></i>&nbsp;<?php echo lang( 'add_singer');?>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url('admincp/singer/manage/');?>">
                                <i class="fa fa-list-alt"></i>&nbsp;<?php echo lang( 'manage_singer');?>
                            </a>
                        </li>
                        
                    </ul>
            	</li>
                
                
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">CP-2<b class="caret"></b></a>
                    <ul class="dropdown-menu" role="menu">
                        <li class="dropdown-header">
                            <i class="fa fa-list-ol"></i>&nbsp;<?php echo lang( 'album');?>
                        </li>

                        <li>
                            <a href="<?php echo base_url('admincp/album/create/');?>">
                                <i class="fa fa-plus-square"></i>&nbsp;<?php echo lang( 'album_create');?>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url('admincp/album/manage/');?>">
                                <i class="fa fa-list-alt"></i>&nbsp;<?php echo lang( 'album_manage');?>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li class="dropdown-header">
                            <i class="fa fa-tags"></i>&nbsp;<?php echo lang( 'tags');?>
                        </li>

                        <li>
                            <a href="<?php echo base_url('admincp/tags/add/');?>">
                                <i class="fa fa-plus-square"></i>&nbsp;<?php echo lang( 'tags_add');?>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url('admincp/tags/manage/');?>">
                                <i class="fa fa-list-alt"></i>&nbsp;<?php echo lang( 'tags_manage');?>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li class="dropdown-header">
                            <i class="fa fa-cogs"></i>&nbsp;<?php echo lang( 'settings_name');?>
                        </li>

                        <li>
                            <a href="<?php echo base_url('admincp/settings/');?>">
                                <i class="fa fa-cog"></i>&nbsp;<?php echo lang( 'settings_name');?>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url('admincp/settings/notify/');?>">
                                <i class="fa fa-comments-o"></i>&nbsp;<?php echo lang( 'settings_notify');?>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url('admincp/settings/manage_notify/');?>">
                                <i class="fa fa-list-alt"></i>&nbsp;<?php echo lang( 'settings_notify_manage');?>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="javascript:logout_admin()"><i class="fa fa-sign-out"></i>&nbsp;<?php echo lang('logout');?></a>
                        </li>
                    </ul>
            	</li>
            </ul>


        </div>
    </div>
</nav>
<script>
    function logout_admin() {
        $.get(site_url + '/cglobal/logout_admin/', function(data) {
            window.location.assign(base_url + 'admincp/login');
        });

    }
</script>