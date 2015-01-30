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
								
							</nav>
							<!-- / nav -->
						</div>
					</section>
				</section>
			</aside>
			<!-- /.aside -->