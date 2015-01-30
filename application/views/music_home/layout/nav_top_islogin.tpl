<header class="bg-dark dk header header-md navbar navbar-fixed-top-xs">
		<div class="navbar-header aside bg-dark lt nav-xs">
			<a class="btn btn-link visible-xs" data-toggle="class:nav-off-screen,open" data-target="#nav,html">
				<i class="icon-list">
				</i>
			</a>
			<a href="{base_url()}" class="navbar-brand text-lt">
				<i class="icon-earphones">
				</i>
				<span class="hidden-nav-xs m-l-sm">
					{$web_name}
				</span>
			</a>
			<a class="btn btn-link visible-xs" data-toggle="dropdown" data-target=".user">
				<i class="icon-settings">
				</i>
			</a>
		</div>
		<ul class="nav navbar-nav hidden-xs">
			<li>
				<a href="#nav,.navbar-header" data-toggle="class:nav-xs,nav-xs" class="text-muted">
					<i class="fa fa-indent text">
					</i>
					<i class="fa fa-dedent text-active">
					</i>
				</a>
			</li>
		</ul>
		<form class="navbar-form navbar-left input-s-lg m-t m-l-n-xs hidden-xs" role="search">
			<div class="form-group">
				<div class="input-group">
					<span class="input-group-btn">
						<button type="submit" class="btn btn-sm bg-white btn-icon rounded">
							<i class="fa fa-search">
							</i>
						</button>
					</span>
					<input id="actions-search" type="text" class="form-control input-sm no-border rounded" placeholder="Search songs, albums...">
				</div>
			</div>
			<div id="form-search" class="col-sm-6" style="display: none;position: fixed;">
			<div style="text-align: right;"><i id="close-search" class="icon-close"></i></div>
                  <section class="panel panel-default">
                    <header class="panel-heading bg-dark lter">
                      <div class="input-group text-sm">
                        <input id="search" type="text" class="input-sm form-control" placeholder="Search">
                        <div class="input-group-btn">
                          <button type="button" class="btn btn-sm btn-default dropdown-toggle" data-toggle="dropdown">Action <span class="caret"></span></button>
                          <ul class="dropdown-menu pull-right">
                            <li><a id="actions" href="javascript:void(0)" data-actions="song">{lang('song')}</a></li>
                            <li><a id="actions" href="javascript:void(0)" data-actions="singer">{lang('singer_name')}</a></li>
                            <li><a id="actions" href="javascript:void(0)" data-actions="album">{lang('album_name')}</a></li>
                            <li><a id="actions" href="javascript:void(0)" data-actions="playlist">{lang('playlist_name')}</a></li>
                          </ul>
                        </div>
                      </div>
                    </header>
                    <ul id="result-search" class="list-group alt list-group-xs" style="display: none;">
                      
                    </ul>
                  </section>          
                </div>
		</form>

		<div class="navbar-right ">
			<ul class="nav navbar-nav m-n hidden-xs nav-user user">
				
				
				<li class="hidden-xs">
					<a href="javascript:void(0)" onclick="disable_notify()"  class="dropdown-toggle lt" data-toggle="dropdown">
						<i class="icon-bell">
						</i>
						<span class="badge badge-sm up bg-danger count">
							{$check_received}
						</span>
					</a>
					<section class="dropdown-menu aside-xl animated fadeInUp">
						<section class="panel bg-dark">
							<div class="panel-heading b-black bg-dark lter">
								<strong>
									{lang('you_have')}
									<span class="count">
										{$check_received}
									</span> {lang('notify')}
								</strong>
							</div>
							<div class="list-group list-group-alt list-group-xs no-bg auto no-radius m-b-none m-t-n-xxs slim-scroll">
								
							</div>
							<div class="panel-footer bg-dark lter b-black text-sm">
								<a href="#" class="pull-right">
									<i class="fa fa-cog">
									</i>
								</a>
								<a href="{$this->globallib->UrlProfile({$user->id},{$user->username})}#interaction" data-toggle="class:show animated fadeInRight">
									See all the notifications
								</a>
							</div>
						</section>
					</section>
				</li>
				
				<li class="dropdown">
					<a href="#" class="dropdown-toggle bg clear" data-toggle="dropdown">
						<span class="thumb-sm avatar pull-right m-t-n-sm m-b-n-sm m-l-sm">
							<img src="{$this->globallib->avatar($user->user_id)}" alt="{$user->username}">
						</span>
						{$user->first_name}&nbsp;{$user->last_name}
						<b class="caret">
						</b>
					</a>
					<ul class="dropdown-menu animated fadeInRight">
						
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
										<a href="#" onclick="logout()" data-toggle="ajaxModal">
											{lang('logout')}
										</a>
									</li>
					</ul>
				</li>
			</ul>
		</div>
		
	</header>