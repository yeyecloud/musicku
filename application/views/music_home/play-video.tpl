<section class="vbox">
    {$navtop}
    <section>
      <section class="hbox stretch">
        <!-- .aside -->
        {$aside}
        <!-- /.aside -->
        <section id="content">
          <section class="vbox">
            <section class="scrollable wrapper-lg">
              <div class="row">
                <div class="col-sm-8">
                  <div class="panel bg-dark">
                    <!-- video player -->
                    <div id="jp_container_1">
                      <div class="jp-type-single pos-rlt">
                        <div id="jplayer_1" class="jp-jplayer jp-video"></div>
                        <div class="jp-gui">
                          <div class="jp-video-play">
                            <a class="fa fa-5x text-white fa-play-circle"></a>
                          </div>
                          <div class="jp-interface bg-dark lt padder">
                            <div class="jp-controls">
                              <div>
                                <a class="jp-play"><i class="icon-control-play i-2x"></i></a>
                                <a class="jp-pause hid"><i class="icon-control-pause i-2x"></i></a>
                              </div>
                              <div class="jp-progress">
                                <div class="jp-seek-bar dker">
                                  <div class="jp-play-bar dk">
                                  </div>
                                  <div class="jp-title text-lt">
                                    <ul>
                                      <li></li>
                                    </ul>
                                  </div>
                                </div>
                              </div>
                              <div class="hidden-xs hidden-sm jp-current-time text-xs text-muted"></div>
                              <div class="hidden-xs hidden-sm jp-duration text-xs text-muted"></div>
                              <div class="hidden-xs hidden-sm">
                                <a class="jp-mute" title="mute"><i class="icon-volume-2"></i></a>
                                <a class="jp-unmute hid" title="unmute"><i class="icon-volume-off"></i></a>
                              </div>
                              <div class="hidden-xs hidden-sm jp-volume">
                                <div class="jp-volume-bar dk">
                                  <div class="jp-volume-bar-value lter"></div>
                                </div>
                              </div>
                              <div>
                                <a class="jp-full-screen" title="full screen"><i class="fa fa-expand"></i></a>
                                <a class="jp-restore-screen" title="restore screen"><i class="fa fa-compress text-lt"></i></a>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="jp-no-solution hide">
                          <span>Update Required</span>
                          To play the media you will need to either update your browser to a recent version or update your <a href="http://get.adobe.com/flashplayer/" target="_blank">Flash plugin</a>.
                        </div>
                      </div>
                    </div>
                    <!-- / video player -->
                    <div class="wrapper-lg bg-dark">
                      <h1 class="m-t-none text-light">{$data_info_song[0]['s_name']}</h1>
                      <div class="post-sum">
                       <p>{$data_info_song[0]['ly_text']}</p>
                      </div>
                      <div class="line b-b b-black"></div>
                      <div class="text-muted">
                      	{$user=$this->ion_auth->user({$data_info_song[0]['u_id']})->row()}
                        <i class="fa fa-user icon-muted"></i> by <a href="{base_url()}profile/{$this->globallib->autoUrl({$user->username})}-{{$data_info_song[0]['u_id']}}" class="m-r-sm"><h2 style="font-size: inherit;display: -webkit-inline-box;display: -moz-inline-box;">{$user->first_name}&nbsp;{$user->last_name}</h2></a>
                        <i class="fa fa-clock-o icon-muted"></i>{date('Y-m-d',{$data_info_song[0]['s_date_creat']})}
                        <a href="#comment-form" id="href-comment-form" class="m-l-sm"><i class="fa fa-comment-o icon-muted"></i> {$data_num_comment} {lang('comment_content')}</a>
                      </div>
                    </div>
                  </div>
                  <input type="hidden" id="s_id" value="{$data_info_song[0]['s_id']}"/>
                  <h4 class="m-t-lg m-b">{$data_num_comment} {lang('comment_content')}</h4>
                  
                  <section class="comment-list block" id="content-comment">
                    {foreach $data_comment as $k=>$v}
                    {$user2=$this->ion_auth->user($v.cm_uid)->row()}
                    	<article id="comment-id-{$v.cm_id}" class="comment-item">
		                      <a class="pull-left thumb-sm">
		                        <img src="{$this->globallib->avatar($v.cm_uid)}" alt="{$user2->first_name}&nbsp;{$user2->last_name}" class="img-circle">
		                      </a>
		                      <section class="comment-body m-b">
		                        <header>
		                          <a href="{base_url()}profile/{$this->globallib->autoUrl({$user2->username})}-{$v.cm_uid}" ><strong>{$user2->first_name}&nbsp;{$user2->last_name}</strong></a>
		                          {$gr=$this->ion_auth->get_users_groups($v.cm_uid)->result()}
		                          {if $gr.0->id == 1}
		                          	<label class="label bg-danger m-l-xs">{$gr.0->name}</label> 
		                          {else}
		                          	<label class="label bg-info m-l-xs">{$gr.0->name}</label> 
		                          {/if}
		                          {if $v.cm_uid==$this->ion_auth->user()->row()->user_id}
		                          	<i class="fa icon-close" onclick="delete_comment({$v.cm_id},'{lang('how_to_delete')}')"></i>
		                          {/if}
		                          <span class="text-muted text-xs block m-t-xs">
		                            {timespan($v.cm_datecreat,now())}
		                          </span>
		                        </header>
		                        <div class="m-t-sm">{$v.cm_text}</div>
		                      </section>
		                    </article>
                    {/foreach}
                  </section>
                  {if {$data_num_comment}>5}
                  <a href="javascript:void(0)" id="more-comment" data-pages="1" data-number-all-comment="{$data_num_comment-5}" data-s_id="{$data_info_song[0]['s_id']}" class="btn btn-default btn-block"><i class="fa fa-bars pull-left"></i>More Comment (<span id="comment-old">{$data_num_comment-5}</span>)</a>
                  <p/>
                  {/if}
                  <hr/>
                  {if $data_is_login==true}
                  <h4 id="comment-form" class="m-t-lg m-b">{lang('comment_content')}</h4>
                  <form>
                    <div class="form-group">
                    	<textarea id="cm-text" data-notify="{lang('notify_required')}" class="form-control" rows="5"></textarea>
                    </div>
                    <div class="form-group">
                    	
                      <a href="javascript:void(0)" onclick="addCommentVideo()" id="submit-comment" data-s_id="{$data_info_song[0]['s_id']}" class="btn btn-success">{lang('comment_submit')}</a>
                    </div>
                  </form>
                  {/if}
                </div>
                <div class="col-sm-4">
                  <div class="panel bg-dark">
                    <div class="panel-heading bg-dark lt b-black">{lang('random_in_category')}</div>
                    <div class="panel-body">
                    	{foreach $data_random_song as $k=>$v}
                    		 <article class="media">
		                        <a href="{base_url("video/{$v.s_url}-{$v.s_id}")}" class="pull-left thumb-lg m-t-xs">
		                          <img src="{$this->globallib->images_song({$v.s_img})}" alt="{$v.s_name}" style="width:128px;height:64px" >
		                        </a>
	                        <div class="media-body">                        
	                          <a href="{base_url("video/{$v.s_url}-{$v.s_id}")}" class="font-semibold">{$v.s_name}</a>
	                          <div class="text-xs block m-t-xs">{timespan({$v.s_date_creat},now())}</div>
	                        </div>
	                      </article>
                    	{/foreach}
                    </div>
                  </div>
                </div>
              </div>
            </section>
          </section>
          <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen,open" data-target="#nav,html"></a>
        </section>
      </section>
    </section>    
  </section>