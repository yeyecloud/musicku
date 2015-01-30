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
                    <div class="m-t-n-xxs item pos-rlt" id="main-album" data-id-album="{$data_album['al_id']}">
                      <div class="top text-right">
                        <span class="musicbar animate bg-success bg-empty inline m-r-lg m-t" style="width:25px;height:30px">
                          <span class="bar1 a3 lter"></span>
                          <span class="bar2 a5 lt"></span>
                          <span class="bar3 a1 bg"></span>
                          <span class="bar4 a4 dk"></span>
                          <span class="bar5 a2 dker"></span>
                        </span>
                      </div>
                      
                      <img class="img-full img-circle fa-spin" src="{$this->globallib->ImgAlbum({$data_album['al_image']})}" style="position: absolute;margin-left: 27%;margin-top: 23px;opacity: 0.3;max-height: 84%;max-width: 100%;height: auto;width: auto;" alt="{$data_album['al_name']}">
                      <img class="img-full" src="{$this->globallib->ImgAlbum({$data_album['al_image']})}" style="position: absolute; max-height: 98%;max-width: 100%;height: auto;width: auto;margin-left: 1%;margin-top: 1%;" alt="{$data_album['al_name']}">
                      <img class="img-full" src="{base_url()}/assets/images/box_bg.png"/>
                      
                      
                      <div class="bottom gd bg-info wrapper-lg">
                        <span class="pull-right text-sm">{$data_album['al_views']} <br/>{lang('views')}</span>
                        <span class="h2 font-thin">{$data_album['al_name']}</span>
                      </div>
                    </div>
                    <ul class="list-group list-group-lg no-radius no-border no-bg m-t-n-xxs m-b-none auto">
                     {foreach $data_song as $k=>$v}
					    <li class="list-group-item" id="main-song-playlist-{$v}">
	                        <div class="pull-right m-l">
	                        	<a href="javascript:void(0)" class="m-r-sm"><i  onclick="download({$v['s_id']})" class="icon-cloud-download"></i></a>
                          		<a href="javascript:void(0)" class="m-r-sm"><i class="icon-plus" id="add-playlist" data-id-song="{$v['s_id']}"></i></a>
                         		
	                        </div>
	                        <a href="javascript:void(0)" id="play-now" data-key="{$k}" class="m-r-sm pull-left">
	                          <i class="icon-control-play text"></i>
	                        </a>
	                        <div class="clear text-ellipsis">
	                          <span><a href="{$this->globallib->UrlSong($v['s_id'],$v['s_type'],$v['s_url'])}" title="{$data_s_name_pl[$k]}">{$v['s_name']}</a></span>
	                          <span class="text-muted">--{$v['si_name']}</span>
	                        </div>
                     	 </li>
					{/foreach}

                    </ul>
                  </section>
                </section>
              </aside>
              <!-- / side content -->
              <section class="col-sm-4 no-padder lt">
                <section class="vbox">
                  <section class="scrollable hover">
                    <div class="m-t-n-xxs">
                     
                      {foreach $data_album_random as $k=>$v}
                     	{if $k%2==0}
                       <div class="item pos-rlt">
                       	
                        <a href="{$this->globallib->UrlAlbum({$v['al_url']},{$v['al_id']})}" class="item-overlay active opacity wrapper-md font-xs">
                          <span class="block h3 font-bold text-info">{$v['al_name']}</span>
                          <span class="text-muted">{$v['al_description']}</span>
                          <span class="bottom wrapper-md block">{$v['al_views']} {lang('views')}<i id="play-album-now" data-id-album="{$v['al_id']}" class="fa fa-play i-lg pull-right"></i></span>
                        </a>
                        <a href="{$this->globallib->UrlAlbum({$v['al_url']},{$v['al_id']})}">
                          <img class="img-full" src="{$this->globallib->ImgAlbum({$v['al_image']})}" alt="{$v['al_name']}" style="width: 100%;max-height: 200px;height: auto;">
                        </a>
                      </div>
                      {else}
                      <div class="item pos-rlt">
                        <a  href="{$this->globallib->UrlAlbum({$v['al_url']},{$v['al_id']})}" class="item-overlay active opacity wrapper-md font-xs text-right">
                          <span class="block h3 font-bold text-success text-u-c">{$v['al_name']}</span>
                          <span class="text-muted">{$v['al_description']}</span>
                          <span class="bottom wrapper-md block"><i id="play-album-now" data-id-album="{$v['al_id']}" class="fa fa-play i-lg pull-left"></i>{$v['al_views']} {lang('views')}</span>
                        </a>
                        <a href="{$this->globallib->UrlAlbum({$v['al_url']},{$v['al_id']})}">
                          <img class="img-full" src="{$this->globallib->ImgAlbum({$v['al_image']})}" alt="{$v['al_name']}" style="width: 100%;max-height: 200px;height: auto;">
                        </a>
                      </div>
                      {/if}
                     {/foreach}
                    </div>
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