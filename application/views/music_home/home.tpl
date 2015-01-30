<section class="vbox">
		{$navtop}
	<section>
		<section class="hbox stretch">
			{$aside}
			<section id="content">
				<section class="hbox stretch">
					<section>
						<section class="vbox">
							<section id="area-load" class="scrollable padder-lg w-f-md">
								<a href="#" class="pull-right text-muted m-t-lg" data-toggle="class:fa-spin" >
									<i class="icon-refresh i-lg  inline" id="refresh">
									</i>
								</a>
								<h2 class="font-thin m-b">
									{lang('song_home_new')}
									<span class="musicbar animate inline m-l-sm" style="width:20px;height:20px">
										<span class="bar1 a1 bg-primary lter">
										</span>
										<span class="bar2 a2 bg-info lt">
										</span>
										<span class="bar3 a3 bg-success">
										</span>
										<span class="bar4 a4 bg-warning dk">
										</span>
										<span class="bar5 a5 bg-danger dker">
										</span>
									</span>
								</h2>
								<div class="row row-sm" id="song-new">
									{foreach $data_song_new as $k=>$v}
									{$url_song=$this->globallib->UrlSong({$v.s_id},{$v.s_type},{$v.s_url})}
									<div class="col-xs-6 col-sm-4 col-md-3 col-lg-2">
										<div class="item">
											<div class="pos-rlt">
												<div class="top">
													<span class="pull-right m-t-sm m-r-sm badge bg-info" id="views-item-{$v.s_id}">
														{$v.v_views}
													</span>
												</div>
												<div class="item-overlay opacity r r-2x bg-black" id="item-{$v.s_id}">
													<div class="text-info padder m-t-sm text-sm">
														<i class="fa fa-star">
														</i>
														<i class="fa fa-star">
														</i>
														<i class="fa fa-star">
														</i>
														<i class="fa fa-star">
														</i>
														<i class="fa fa-star-o text-muted">
														</i>
													</div>
													<div class="center text-center m-t-n">
														<a href="javascript:void(0)">
															<i onclick="PlaySong({$v.s_id},'Home')" class="icon-control-play i-2x" id="play-now-{$v.s_id}" data-is-play="0">
															</i>
														</a>
													</div>
													<div class="bottom padder m-b-sm">
														<a href="javascript:void(0);" class="pull-right">
															{if $this->globallib->CheckLike($v.l_id,0,$v.u_like)==TRUE}
															<i onclick="LikeSong({$v.l_id})" id="LikeSong-{$v.l_id}" class="fa fa-heart text-danger">
															</i>
															{else}
															<i onclick="LikeSong({$v.l_id})" id="LikeSong-{$v.l_id}" data-like="{$v.u_like}" class="fa fa-heart-o">
															</i>
															{/if}
															<span id="count-like-{$v.l_id}">{$this->globallib->CountLike($v.u_like)}</span>
														</a>
														<a href="#">
															<i class="fa fa-plus-circle" id="add-playlist" data-id-song="{$v.s_id}">
															</i>
														</a>
													</div>
												</div>
												<a href="{$url_song}">
													<img src="{$this->globallib->images_song({$v.s_img})}" alt="{$v.s_name}" width="148px" height="221px" class="r r-2x img-full">
												</a>
											</div>
											<div class="padder-v">
												<a href="{$url_song}" class="text-ellipsis">
													{$v.s_name}
												</a>
												<a href="{$this->globallib->UrlSinger($v.si_id,$v.si_url)}" class="text-ellipsis text-xs text-muted">
													{$v.si_name}
												</a>
											</div>
										</div>
									</div>
									{if ($k+1)%2 == 0}
									<div class="clearfix visible-xs">
									</div> 
									{/if}	 
									{/foreach}
									
								</div>
								<div class="row">
									<div class="col-md-7">
										<h3 class="font-thin">
											{lang('video_home_new')}
										</h3>
										<div class="row row-sm">
											{foreach from=$data_video_new key=k item=v}
											{$url_song=$this->globallib->UrlSong({$v.s_id},{$v.s_type},{$v.s_url})}
											<div class="col-xs-6 col-sm-3">
												<div class="item">
													<div class="pos-rlt">
														<div class="item-overlay opacity r r-2x bg-black">
															<div class="center text-center m-t-n">
																<a href="{$url_song}">
																	<i class="fa fa-play-circle i-2x">
																	</i>
																</a>
															</div>
														</div>
														
														<a href="{$url_song}">
															<img src="{$this->globallib->images_song({$v.s_img})}" height="126px" width="126px" alt="{$v.s_name}" class="r r-2x img-full">
														</a>
													</div>
													<div class="padder-v">
														<a href="{$url_song}" class="text-ellipsis">
															{$v.s_name}
														</a>
														<a href="{$this->globallib->UrlSinger($v.si_id,$v.si_url)}" class="text-ellipsis text-xs text-muted">
															{$v.si_name}
														</a>
													</div>
												</div>
											</div>
											{/foreach}
											
										</div>
									</div>
									<div class="col-md-5">
										<h3 class="font-thin">
											{lang('top_views_week')}
										</h3>
										<div class="list-group list-group-lg bg-dark  no-bg auto">
										
										{foreach $data_top_week as $k=>$v}
											{$url_song=$this->globallib->UrlSong({$v.s_id},{$v.s_type},{$v.s_url})}
										  <a href="{$url_song}" class="list-group-item clearfix">
												<span class="pull-right h2 text-muted m-l">
													{$k+1}
												</span>
												<span class="pull-left thumb-sm avatar m-r">
													<img src="{$this->globallib->images_song({$v.s_img})}" style="width: 40px;height:40px;" alt="{$v.s_name}">
												</span>
												<span class="clear">
													<span>
														{$v.s_name}
													</span>
													<small class="text-muted clear text-ellipsis">
														{$v.si_name}
													</small>
												</span>
											</a>
										{/foreach}
																						
										</div>
									</div>
								</div>
								
							</section>
							<!--JPlayer-->
							{$jPlayer}	
						</section>
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
				</section>
				<a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen,open" data-target="#nav,html">
				</a>
			</section>
		</section>
	</section>
</section>

