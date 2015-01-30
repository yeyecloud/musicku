<!-- .aside -->
			<aside class="bg-black dk nav-xs aside hidden-print" id="nav">
				<section class="vbox">
					<section class="w-f-md scrollable">
						<div class="slim-scroll" data-height="auto" data-disable-fade-out="true" data-distance="0" data-size="10px" data-railOpacity="0.2">
					<!-- nav -->
							<nav class="nav-primary hidden-xs">
								<ul class="nav bg clearfix">
									
									<li>
										<a href="{base_url()}">
											<i class="icon-disc icon text-success">
											</i>
											<span class="font-bold">
												{lang('new')}
											</span>
										</a>
									</li>
									
									<li>
										<a href="{base_url()}/song/">
											<i class="icon-music-tone-alt  text-info-dker">
											</i>
											<span class="font-bold">
												{lang('audio')}
											</span>
										</a>
									</li>
									<li>
										<a href="{base_url()}/video/" data-target="#content" data-el="#bjax-el" data-replace="true">
											<i class="icon-social-youtube icon  text-primary">
											</i>
											<span class="font-bold">
												{lang('video')}
											</span>
										</a>
									</li>
									<li class="m-b hidden-nav-xs">
									</li>
								</ul>
								<ul class="nav" data-ride="collapse">
									
									<li >
										<a href="#" class="auto">
											<span class="pull-right text-muted">
												<i class="fa fa-angle-left text">
												</i>
												<i class="fa fa-angle-down text-active">
												</i>
											</span>
											<i class="icon-music-tone icon">
											</i>
											<span>
												{lang('category_audio')}
											</span>
										</a>
										<ul class="nav dk text-sm">
										{foreach $all_category as $k=>$v}
											{if $v.cat_type == 1}
												<li>
													<a href="{$this->globallib->UrlCategory($v.cat_id,$v.cat_url)}" class="auto">
														<i class="fa fa-angle-right text-xs">
														</i>

														<span>
															{$v.cat_name}
														</span>
													</a>
												</li>
											{/if}										 
										{/foreach}
										</ul>
									</li>
									<li >
										<a href="#" class="auto">
											<span class="pull-right text-muted">
												<i class="fa fa-angle-left text">
												</i>
												<i class="fa fa-angle-down text-active">
												</i>
											</span>
											<i class="icon-social-youtube icon">
											</i>
											<span>
												{lang('category_video')}
											</span>
										</a>
										<ul class="nav dk text-sm">
										{foreach $all_category as $k=>$v}
											{if $v.cat_type == 2}
												<li>
													<a href="{$this->globallib->UrlCategory($v.cat_id,$v.cat_url)}" class="auto">
														<i class="fa fa-angle-right text-xs">
														</i>

														<span>
															{$v.cat_name}
														</span>
													</a>
												</li>
											{/if}										 
										{/foreach}
										</ul>
									</li>
								<!---ALBUM--->
								
								<li >
										<a href="#" class="auto">
											<span class="pull-right text-muted">
												<i class="fa fa-angle-left text">
												</i>
												<i class="fa fa-angle-down text-active">
												</i>
											</span>
											<i class="fa fa-bookmark-o"></i>
											<span>
												{lang('album')}
											</span>
										</a>
										<ul class="nav dk text-sm">
										{foreach $album_new as $k=>$v}
											
												<li>
													<a href="{$this->globallib->UrlAlbum($v['al_url'],$v['al_id'])}" class="auto">
														<i class="fa fa-angle-right text-xs">
														</i>
														<span>
															{$v['al_name']}
														</span>
													</a>
												</li>
																		 
										{/foreach}
										</ul>
									</li>
								
								<!---END ALBUM-->
									
								</ul>
								<ul class="nav text-sm">
									<li class="hidden-nav-xs padder m-t m-b-sm text-xs text-muted">
										<span class="pull-right">
											<a href="#modalplaylist" data-toggle="modal" >
												<i class="icon-plus i-lg">
												</i>
											</a>
										</span>
										Playlist
									</li>
									{foreach $playlist as $k=>$v}
									 	{if $v.s_id == ''}
										    <li>
												<a onclick="ClearJplayer('{$this->globallib->UrlPlayList({$v.pl_id},{$v.pl_url})}')" href="javascript:void(0)">
													<i class="icon-music-tone icon">
													</i>
													<span>
														{$v.pl_name}
													</span>
												</a>
											</li>
										{else}
										    <li>
												<a onclick="ClearJplayer('{$this->globallib->UrlPlayList({$v.pl_id},{$v.pl_url})}')" href="javascript:void(0)">
													<i class="icon-playlist icon text-success-lter">
													</i>
													<b class="badge bg-success dker pull-right">
														{$this->mglobal->playlist_user('count-song',{$v.pl_id},NULL,NULL,NULL)}
													</b>
													<span>
														{$v.pl_name}
													</span>
												</a>
											</li>
										{/if}
									{/foreach}
								</ul>
							</nav>
							<!-- / nav -->
						</div>
					</section>

					<footer class="footer hidden-xs no-padder text-center-nav-xs">
						<div class="bg hidden-xs ">
							<div class="dropdown dropup wrapper-sm clearfix">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">
									<span class="thumb-sm avatar pull-left m-l-xs">
										<img src="{$this->globallib->avatar($user->user_id)}" class="dker" alt="{$user->username}">
										<i class="on b-black">
										</i>
									</span>
									<span class="hidden-nav-xs clear">
										<span class="block m-l">
											<strong class="font-bold text-lt">
												{$user->first_name}&nbsp;{$user->last_name}
											</strong>
											<b class="caret">
											</b>
										</span>
										<span class="text-muted text-xs block m-l">
											{$user->email}
										</span>
									</span>
								</a>
								<ul class="dropdown-menu animated fadeInRight aside text-left">
									<li>
										<a href="{$this->globallib->UrlProfile({$user->id},{$user->username})}">
											{lang('profile')}
										</a>
									</li>
									<li>
										<a href="{$this->globallib->UrlProfile({$user->id},{$user->username})}">
											<span class="badge bg-danger pull-right">
												{$check_received}
											</span>
											{lang('notify')}
										</a>
									</li>
									
									<li class="divider">
									</li>
									<li>
										<a href="javascript:void(0)" onclick="logout()" data-toggle="ajaxModal">
											{lang('logout')}
										</a>
									</li>
								</ul>
							</div>
						</div>
					</footer>
				</section>
			</aside>
			<!-- /.aside -->
