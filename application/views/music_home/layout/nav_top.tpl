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
				
				
				<!---NOT LOGIN-->
				<li class="dropdown">
						<a href="#" class="dropdown-toggle bg clear" data-toggle="dropdown">
							{lang('signin')} - {lang('signup')}
							<b class="caret">
							</b>
						</a>
						<ul class="dropdown-menu animated fadeInRight">
							<li>
								<span class="arrow top">
								</span>
								<a href="{base_url('sign-in')}">
									{lang('signin')}
								</a>
							</li>
							<li>
								<a href="{base_url('sign-up')}">
									{lang('signup')}
								</a>
							</li>
							
						</ul>
				</li>
				<!---END NOT LOGIN-->
				
			</ul>
		</div>
	</header>