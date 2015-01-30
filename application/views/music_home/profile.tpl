<section class="vbox">
  {$navtop}
  <section>
    <section class="hbox stretch">
      <!-- .aside -->
      {$aside}
      <!-- /.aside -->
      <section id="content">
        <section class="vbox">
          <section class="scrollable">
            <section class="hbox stretch">
              <aside class="aside-lg bg-light lter b-r b-black">
                <section class="vbox">
                  <section class="scrollable">
                    <div class="wrapper bg-dark">
                      <div class="text-center m-b m-t">
                        <a href="#" class="thumb-lg">
                          <img src="{$this->globallib->avatar($data_user->user_id)}" class="img-circle" alt="{$data_user->username}">
                        </a>
                        <div>
                          <div class="h3 m-t-xs m-b-xs">{$data_user->first_name}&nbsp;{$data_user->last_name}</div>
                          <small class="text-muted"><i class="fa fa-map-marker"></i>&nbsp;{$data_user->address}</small>
                        </div>
                      </div>
                      <div class="panel wrapper bg-dark lt">
                        <div class="row text-center">
                          <div class="col-xs-6">
                            <a href="#">
                              <span class="m-b-xs h4 block">{$data_all_follower}</span>
                              <small class="text-muted">{lang('follow')}</small>
                            </a>
                          </div>
                          <div class="col-xs-6">
                            <a href="#">
                              <span class="m-b-xs h4 block">{$data_all_following}</span>
                              <small class="text-muted">{lang('following')}</small>
                            </a>
                          </div>
                        </div>
                      </div>
                      <div class="btn-group btn-group-justified m-b">
                      {if $login==true}
                        <a id="edit-profile" class="btn btn-success btn-rounded">
                          <span class="text">
                              <i class="fa fa-edit"></i>&nbsp;{lang('profile_edit')}
                            </span>
                        </a>
                        <a id="change-password" class="btn btn-info btn-rounded">
                          <i class="fa icon-key"></i>&nbsp;{lang('change_password')}
                        </a>
                       {else} 
                       	<a  onclick="follow({$user_id})" class="btn btn-success btn-rounded">
                          <span class="text">
                          {if $is_login==true}
                          	{if $this->globallib->Follow('check-following',NULL,{$user_id})==true}
                              <i class="icon-user-follow"></i>&nbsp;<span id="follow" data-notify-follow="{lang('follow')}" data-notify-following="{lang('following')}">{lang('following')}</span>
                            {else} 
                            	<i class="icon-user-follow"></i>&nbsp;<span id="follow" data-notify-follow="{lang('follow')}" data-notify-following="{lang('following')}">{lang('follow')}</span>
                            {/if}
                          {else} 
                          	<i class="icon-user-follow"></i>&nbsp;<span id="follow" data-notify-follow="{lang('follow')}" data-notify-following="{lang('following')}">{lang('follow')}</span>
                          {/if}
                          </span>
                        </a>
                        
                        <a id="addfriend" onclick="friend({$user_id})" class="btn btn-info btn-rounded">
                        {if $is_login==true}
                        	{if $this->globallib->Friend('CheckStatus',NULL,{$user_id},NULL)==NULL}
                        	  <i class="icon-users"></i>&nbsp;<span id="friend" data-notify-add-friend="{lang('addfriend')}" data-notify-watting-friend="{lang('wattingfriend')}" data-notify-friend="{lang('friend')}">{lang('addfriend')}</span>
                        	{elseif $this->globallib->Friend('CheckStatus',NULL,{$user_id},NULL)=='0'}
                        		<i class="icon-users"></i>&nbsp;<span id="friend" data-notify-add-friend="{lang('addfriend')}" data-notify-watting-friend="{lang('wattingfriend')}" data-notify-friend="{lang('friend')}">{lang('wattingfriend')}</span>
                        	{else}
                        		<i class="icon-users"></i>&nbsp;<span id="friend" data-notify-add-friend="{lang('addfriend')}" data-notify-watting-friend="{lang('wattingfriend')}" data-notify-friend="{lang('friend')}">{lang('friend')}</span>	 
                        	{/if}
                        {else} 
                          	<i class="icon-users"></i>&nbsp;<span id="friend" data-notify-add-friend="{lang('addfriend')}" data-notify-watting-friend="{lang('wattingfriend')}" data-notify-friend="{lang('friend')}">{lang('addfriend')}</span>
                          {/if}
                       	
                        </a>
                    {/if}  	
                      
                      </div>
                      <div>
                        <small class="text-uc text-xs text-muted">{lang('company')}</small>
                        <p>{$data_user->company}</p>
                        <small class="text-uc text-xs text-muted">{lang('phone')}</small>
                        <p>{$data_user->phone}</p>
                        <small class="text-uc text-xs text-muted">{lang('sex')}</small>
                        <p>
                          {if $data_user->sex==1} {lang('male')} {else} {lang('female')} {/if}
                        </p>
                        <small class="text-uc text-xs text-muted">{lang('aboutme')}</small>
                        <p>{$data_user->about}</p>
                        <div class="line"></div>
                        <small class="text-uc text-xs text-muted">Connection</small>
                        <p class="m-t-sm">
                          <a href="#" class="btn btn-rounded btn-twitter btn-icon"><i class="fa fa-twitter"></i></a>
                          <a href="#" class="btn btn-rounded btn-facebook btn-icon"><i class="fa fa-facebook"></i></a>
                          <a href="#" class="btn btn-rounded btn-gplus btn-icon"><i class="fa fa-google-plus"></i></a>
                        </p>
                      </div>
                    </div>
                  </section>
                </section>
              </aside>
              <aside class="bg-dark">
                <section class="vbox">
                  <header class="header bg-dark lt">
                    <ul class="nav nav-tabs nav-dark lter">
                      <li class="active"><a href="#playlist" data-toggle="tab">{lang('playlist')}</a>
                      </li>
                      <li class=""><a href="#interaction" data-toggle="tab">{lang('profile_notify')}</a>
                      </li>
                    </ul>
                  </header>
                  <section class="scrollable">
                    <div class="tab-content">
                      
                      <div class="tab-pane active" id="playlist">
                        <ul class="list-group list-group-xs no-bg auto no-radius m-b-none m-t-n-xxs">
                        {foreach $data_playlist as $k=>$v}
                          <li class="list-group-item clearfix" id="main-playlist-{$v.pl_id}">
                          	{if $login===true}
                            <a href="javascript:void(0)" class="pull-right m-t-sm m-l text-md">
                              <i class="fa fa-edit" onclick="edit_playlist({$v.pl_id})"></i>
                              <i class="fa icon-close" onclick="delete_playlist({$v.pl_id},'{lang('notify_delete_playlist')}')"></i>
                            </a>
                            {/if}
                            <a href="{base_url("/play-list/{$v.pl_url}-{$v.pl_id}")}" title="{$v.pl_name}" class="pull-left thumb-sm m-r">
                              <img id="img-playlist-{$v.pl_id}" src="{base_url("/uploads/img_playlist/{$v.pl_img}")}" style="height: 40px;" alt="{$v.pl_name}">
                            </a>
                            <a class="clear" href="{base_url("/play-list/{$v.pl_url}-{$v.pl_id}")}" title="{$v.pl_name}">
                              <span class="block text-ellipsis" id="pl_name-{$v.pl_id}">{$v.pl_name}</span>
                              <small class="text-muted">{$v.pl_views}&nbsp;{lang('views')}</small><br/>
                              <small>{timespan($v.pl_datecreat, now())}&nbsp;{lang('ago')}</small>
                            </a>
                          </li>
                         {/foreach}
                        </ul>
                      </div>
                      <div class="tab-pane" id="interaction">
                        <div class="list-group list-group-xs no-bg auto m-b-none m-t-n-xxs no-radius" id="slimScroll-notify">
                        	{foreach $data_notify as $k=>$v}
                        		{if $v.n_type==1 OR $v.n_type==2}
									<a href="{$v.n_url}" class="media list-group-item">
									  <span class="pull-left thumb-sm text-center">
									    <i class="fa fa-envelope-o fa-2x text-success">
									    </i>
									  </span>
									  <span class="media-body block m-b-none">
									    {$v.n_messages}
									    <br>
									    <small class="text-muted">
									      {timespan($v.n_datecreat,now())}
									    </small>
									  </span>
									</a>
								{else}
									<a id="notify-allow-friend-{$v.n_id}" class="media list-group-item">
												  <span class="pull-left thumb-sm">
												    <img src="{$this->globallib->avatar($v.n_from)}" alt="Notify" class="img-circle">
												  </span>
												  <span class="media-body block m-b-none">
												    {$v.n_messages}
												    <br>
												    <div class="m-b-sm">
												      <div class="btn-group" data-toggle="buttons">
												        <label class="btn btn-xs btn-success" onclick="allow({$v.n_from},{$v.n_id})">
												          <input name="options" type="radio">
												          <i class="fa fa-check-square-o">
												          </i>
												          Allow
												        </label>
												        <label class="btn btn-xs btn-danger" onclick="deny({$v.n_from},{$v.n_id})">
												          <input name="options" type="radio">
												          <i class="fa fa-minus-circle">
												          </i>
												          Deny
												        </label>
												      </div>
												    </div>
												    <small class="text-muted">
												      {timespan($v.n_datecreat,now())}
												    </small>
												  </span>
												</a>
								{/if}
							{/foreach}
						</div>
                      </div>
                    </div>
                  </section>
                </section>
              </aside>
              <aside class="col-lg-3 b-l b-black">
                <section class="vbox">
                  <section class="scrollable padder-v">
                    <div class="panel bg-dark">
                      <h4 class="font-thin padder">{lang('admin_notify')}</h4>
                      <ul class="list-group list-group-xs no-bg auto m-b-none m-t-n-xxs no-radius">
                        {foreach $data_admin_notify as $val}
                        <li class="list-group-item lt">
                          <p><a href="#" class="text-info">@Admin</a> {$val.set_notify_content}</p>
                          <small class="block text-muted"><i class="fa fa-clock-o"></i>&nbsp;{timespan($val.set_notify_datecreat, now())}</small>
                        </li>
                        {/foreach}
                      </ul>
                    </div>
                   
                  </section>
                </section>
              </aside>
            </section>
          </section>
        </section>
        <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen,open" data-target="#nav,html"></a>
      </section>
    </section>
  </section>
</section>