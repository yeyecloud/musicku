<section class="vbox">
    {$navtop}
    <section>
      <section class="hbox stretch">
        <!-- .aside -->
        {$aside}
        <!-- /.aside -->
        <section id="content">
        <section class="hbox stretch">
          <section class="vbox">
          <section id="area-load" class="w-f-md">
            <section class="hbox stretch">
              <!-- side content -->
              <aside class="col-sm-5 no-padder b-r b-black" id="sidebar">
                <section class="vbox animated fadeInUp">
                  <section class="scrollable">
                    <div class="m-t-n-xxs item pos-rlt" id="main-playlist" data-id-playlist="{$data_playlist['pl_id']}">
                      <div class="top text-right">
                        <span class="musicbar animate bg-success bg-empty inline m-r-lg m-t" style="width:25px;height:30px">
                          <span class="bar1 a3 lter"></span>
                          <span class="bar2 a5 lt"></span>
                          <span class="bar3 a1 bg"></span>
                          <span class="bar4 a4 dk"></span>
                          <span class="bar5 a2 dker"></span>
                        </span>
                      </div>
                      <div class="bottom gd bg-info wrapper-lg">
                        <span class="pull-right text-sm">{$data_playlist['pl_views']} <br/>{lang('views')}</span>
                        <span class="h2 font-thin">{$data_playlist['pl_name']}</span>
                      </div>
                      <img class="img-full" src="{base_url("uploads/img_playlist/{$data_playlist['pl_img']}")}" alt="...">
                    </div>
                    <ul class="list-group list-group-lg no-radius no-border no-bg m-t-n-xxs m-b-none auto">
                     {foreach $data_s_id_pl as $k=>$v}
					    <li class="list-group-item" id="main-song-playlist-{$v}">
	                        <div class="pull-right m-l">
	                        	<a href="javascript:void(0)" class="m-r-sm"><i  onclick="download({$v})" class="icon-cloud-download"></i></a>
                          		<a href="javascript:void(0)" class="m-r-sm"><i class="icon-plus" id="add-playlist" data-id-song="{$v}"></i></a>
                         		{if $data_login===true}
	                          		<a href="javascript:void(0)" onclick="delete_song_playlist({$data_playlist['pl_id']},{$v})"><i class="icon-close"></i></a>
	                          	{/if}
	                          
	                        </div>
	                        <a href="javascript:void(0)" id="play-now" data-key="{$k}" class="m-r-sm pull-left">
	                          <i class="icon-control-play text"></i>
	                        </a>
	                        <div class="clear text-ellipsis">
	                          <span><a href="{base_url("song/{$data_s_url_pl[$k]}-{$data_s_id_pl[$k]}")}" title="{$data_s_name_pl[$k]}">{$data_s_name_pl[$k]}</a></span>
	                          <span class="text-muted"> -- {$data_si_name_pl[$k]}</span>
	                        </div>
                     	 </li>
					{/foreach}

                    </ul>
                  </section>
                </section>
              </aside>
              <!-- / side content -->
              <section  class="col-sm-4 no-padder lt">
                <section class="vbox">
                  <section class="scrollable hover">
                    <ul class="list-group list-group-lg no-bg no-radius auto m-b-none m-t-n-xxs">
                    {foreach $data_pl_random as $k=>$v}
                      <li class="list-group-item clearfix">
                        <a href="javascript:void(0)" id="play-playlist-now" data-id-playlist="{$v.pl_id}" class="pull-right m-t-sm m-l text-md">
                          <i class="icon-control-play text"></i>
                          <i class="icon-control-pause text-active"></i>
                          
                        </a>
                        <a href="{base_url("play-list/{$v.pl_url}-{$v.pl_id}")}" title="{$v.pl_name}" class="pull-left thumb-sm m-r">
                          <img src="{base_url("uploads/img_playlist/{$v.pl_img}")}" style="height: 40px;" alt="{$v.pl_name}">
                        </a>
                        <a class="clear" href="{base_url("play-list/{$v.pl_url}-{$v.pl_id}")}" title="{$v.pl_name}">
                          <span class="block text-ellipsis">{$v.pl_name}</span>
                          <small class="text-muted">{$this->ion_auth->user({$v.u_id})->row()->first_name}&nbsp;{$this->ion_auth->user({$v.u_id})->row()->last_name}</small>
                        </a>
                      </li>
                     {/foreach}
                    </ul>
                  </section>
                </section>
              </section>
             
            </section>
          </section>
         	 <!--JPlayer-->
			{$jPlayer}	
        	</section>
        	<!-- side content -->
					<aside class="aside-md bg-dark dk" id="sidebar">
						<section class="vbox animated fadeInRight">
							<section class="w-f-md scrollable hover">
								<h4 class="font-thin m-l-md m-t">
									Connected
								</h4>
								<ul class="list-group no-bg no-borders auto m-t-n-xxs">
								{if $data_is_login==true}
									{foreach $data_friend as $k=>$v}
										
										{if $v.u_id==$this->session->userdata('user_id')}
											{$user_friend=$v.u_fr}
										{else}	
											{$user_friend=$v.u_id}
										{/if}
										{$user=$this->ion_auth->user($user_friend)->row()}
										<li class="list-group-item">
											<span class="pull-left thumb-xs m-t-xs avatar m-l-xs m-r-sm">
												<img src="{$this->globallib->avatar($user_friend)}" alt="{$user->first_name}&nbsp;{$user->last_name}" class="img-circle">
												{if $this->globallib->online($user_friend)==true}
												<i class="on b-light right sm">
												</i>
												{else}
												<i class="busy b-light right sm">
												</i>
												{/if}
											</span>
											<div class="clear">
												<div>
													<a href="{base_url()}profile/{$this->globallib->autoUrl({$user->username})}-{$user_friend}">
													{$user->first_name}&nbsp;{$user->last_name}
													</a>
												</div>
												<small class="text-muted">
													{$user->address}
												</small>
											</div>
										</li>
									{/foreach}
									
									{else}
										<p>{lang('please_log_in')}</p>
									{/if}
								
								</ul>
							</section>
							<footer class="footer footer-md bg-black">
								<form class="" role="search">
									<div class="form-group clearfix m-b-none">
										<div class="input-group m-t m-b">
											<span class="input-group-btn">
												<button type="submit" class="btn btn-sm bg-empty text-muted btn-icon">
													<i class="fa fa-search">
													</i>
												</button>
											</span>
											<input type="text" class="form-control input-sm text-white bg-empty b-b b-dark no-border" placeholder="Search members">
										</div>
									</div>
								</form>
							</footer>
						</section>
					</aside>
		<!-- / side content -->
          <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen,open" data-target="#nav,html"></a>
        </section>
        </section>
        
      </section>
    </section>    
  </section>