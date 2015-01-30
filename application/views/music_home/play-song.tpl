<section class="vbox">
	{$navtop}
	<section>
		<section class="hbox stretch">
			<!-- .aside -->
			{$aside}
			<!-- /.aside -->
			{$user=$this->ion_auth->user($info_song['u_id'])->row()}
			<section id="content">
			<section class="hbox stretch">
				<section class="vbox">
					<section id="area-load" class="scrollable wrapper-lg">
						<div class="row">
							<div class="col-sm-8">
								<div class="panel wrapper-lg bg-dark lt">
									<div class="row" id="main-play" data-id-song="{$info_song['s_id']}">
										<div class="col-sm-5">
											<img src="{$this->globallib->images_song({$info_song['s_img']})}" class="img-full m-b" alt="{$info_song['s_name']}">
										</div>
										<div class="col-sm-7">
											<h2 class="m-t-none text-light">
												<i class="icon-music-tone-alt"></i>&nbsp;{$info_song['s_name']}
											</h2>
											<div class="clearfix m-b-lg">
												<a href="{$this->globallib->UrlProfile($info_song['u_id'],$user->username)}" class="thumb-sm pull-left m-r">
													<img src="{$this->globallib->avatar({$info_song['u_id']})}" style="width:40px;height:40px;" class="img-circle" alt="{$user->username}">
												</a>
												<div class="clear">
													
													<a href="{$this->globallib->UrlProfile($info_song['u_id'],$user->username)}" class="text-info">
														<i class="icon-user"></i>&nbsp;{$user->first_name} {$user->last_name}
													</a>
													<small class="block text-muted">
														<i class="icon-user-follow"></i>&nbsp;{$data_all_follower} {lang('follow')} / <i class="icon-user-following"></i>&nbsp;{$data_all_following} {lang('following')}
													</small>
												</div>
											</div>
											<div class="m-b-lg">
												<a href="javascript:void(0)" onclick="PlaySongOnPagesSong({$info_song['s_id']})" id="a-play" class="btn btn-success" data-is-play="1">
													<i id="i-play" class="fa fa-play"></i>&nbsp;<span id="span-play-pause">Play</span>
												</a>
												<a href="#comment-form" id="href-comment-form" class="btn btn-default">
													<i class="icon-bubble"></i>&nbsp;{$data_num_comment} {lang('comment_content')}
												</a>
												
											</div>
											<div class="m-b-lg">
												
										        <button class="btn btn-default" onclick="download({$info_song['s_id']});return false;">
										        	<span class="text">
										          		<i class="icon-cloud-download"></i> {lang('download')} <span id="count-download">({$info_song['s_download']})</span>
											        </span>
											        
										        </button>
										        
										        <a class="btn btn-default">
										        	<span class="text">
										          		<i class="icon-plus"  id="add-playlist" data-id-song="{$info_song['s_id']}"></i>
											        </span>
										        </a>
											</div>
											
											<div>
												<i class="icon-tag"></i>&nbsp;Tags:
												{foreach from=$data_tags key=k item=v}
												  <a href="{base_url("tags/{$v}")}" title="{$v}" class="badge">
													{$v}
												  </a>
												{/foreach}
												
											</div>
										</div>
									</div>
									<div class="m-t">
										<p>
											{$ly_text['ly_text']}
										</p>
									</div>
									<h4 class="m-t-lg m-b">
										<i class="icon-list"></i>&nbsp;{lang('song_in_category')}
									</h4>
									<ul class="list-group list-group-lg no-bg auto m-b-none m-t-n-xxs">
										
										{foreach $data_song_in_cat as $k=>$v}
										  {$url_song=$this->globallib->UrlSong({$v.s_id},{$v.s_type},{$v.s_url})}
										 <li class="list-group-item bg-dark lter">
											<div class="pull-right m-l">
												<a href="javascript:void(0)" class="m-r-sm">
													<i onclick="download({$v.s_id})" class="icon-cloud-download">
													</i>
												</a>
												<a href="#">
													<i id="add-playlist" class="icon-plus" data-id-song="{$v.s_id}">
													</i>
												</a>
											</div>
											<a onclick="PlaySongOnPagesSong_More({$v.s_id})" href="javascript:void(0)" class="m-r-sm pull-left">
												<i class="icon-control-play text">
												</i>
												<i class="icon-control-pause text-active">
												</i>
											</a>
											<div class="clear text-ellipsis">
												<span>
													<a href="{$url_song}" title="{$v.s_name}">{$v.s_name}</a>
												</span>
												
											</div>
										</li>
										{/foreach}
										
									</ul>
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
					                  <a href="javascript:void(0)" id="more-comment" data-pages="1" data-number-all-comment="{$data_num_comment-5}" data-s_id="{$info_song['s_id']}" class="btn btn-default btn-block"><i class="fa fa-bars pull-left"></i>More Comment (<span id="comment-old">{$data_num_comment-5}</span>)</a>
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
					                    	
					                      <a href="javascript:void(0)" onclick="addCommentVideo()" id="submit-comment" data-s_id="{$info_song['s_id']}" class="btn btn-success">{lang('comment_submit')}</a>
					                    </div>
					                  </form>
					                  {/if}
								</div>
							</div>
							<div class="col-sm-4">
								<div class="panel bg-dark">
									<div class="panel-heading b-b b-black">
										{lang('random_in_category')}
									</div>
									<div class="panel-heading bg-dark lt">
									{foreach $data_random_song as $k=>$v}
									{$url_song=$this->globallib->UrlSong({$v.s_id},{$v.s_type},{$v.s_url})}
									{$user=$this->ion_auth->user($v.u_id)->row()}
										<article class="media">
											<a href="{$url_song}" class="pull-left thumb-md m-t-xs">
												<img src="{$this->globallib->images_song({$v.s_img})}" alt="{$v.s_name}" style="width:64px;height:64px;">
											</a>
											<div class="media-body">
												<a href="{$url_song}" class="font-semibold">
													{$v.s_name}
												</a>
												<div class="text-xs block m-t-xs">
												<a href="{$this->globallib->UrlProfile($v.u_id,$user->username)}">{$user->first_name}&nbsp;{$user->last_name}</a>
													<p/>{timespan($v.s_date_creat,now())}
												</div>
											</div>
										</article>
									{/foreach}
										
										
									</div>
								</div>
							</div>
						</div>
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
				<a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen,open" data-target="#nav,html">
				</a>
			</section>	
			
		</section>
		</section>
	</section>
</section>