<section id="content" class="m-t-lg wrapper-md animated fadeInDown">
	<div class="container aside-xl">
		<a class="navbar-brand block" href="index.html">
			<span class="h1 font-bold">
				{$signup}
			</span>
		</a>
		<section class="m-b-lg">
			<header class="wrapper text-center">
				<strong>
					{$solo}
				</strong>
			</header>
			<form action="#" method="POST">
				<div class="form-group">
					<input type="text" placeholder="{$first_name}" id="first_name" data-notify="{$notify_first_name}" class="form-control rounded input-lg text-center no-border">
				</div>
				<div class="form-group">
					<input type="text" placeholder="{$last_name}" id="last_name" data-notify="{$notify_last_name}" class="form-control rounded input-lg text-center no-border">
				</div>
				
				<div class="form-group">
					<input type="email" placeholder="{$email}" id="email" data-notify="{$notify_email}" class="form-control rounded input-lg text-center no-border">
				</div>
				<div class="form-group">
					<input type="password" placeholder="{$password}" id="password" data-notify="{$notify_password}" class="form-control rounded input-lg text-center no-border">
				</div>
				<div class="form-group">
					<input type="password" placeholder="{$password_confirm}" id="password_confirm" data-notify="{$notify_password_confirm}" class="form-control rounded input-lg text-center no-border">
				</div>
				<div class="checkbox i-checks m-b">
					<label class="m-l">
						<input type="checkbox" checked="">
						<i>
						</i> 
						<a href="#modal-terms" data-toggle="modal">
							{$agree_terms}
						</a>
					</label>
				</div>
				<button id="signup" type="submit" class="btn btn-lg btn-warning lt b-white b-2x btn-block btn-rounded">
					<i class="icon-arrow-right pull-right">
					</i>
					<span class="m-r-n-lg">
						{$signup}
					</span>
				</button>
				<div class="line line-dashed">
				</div>
				<p class="text-muted text-center">
					<small>
						{$already_account}
					</small>
				</p>
				<a href="{$base_url}sign-in" class="btn btn-lg bg-dark btn-block btn-rounded">
					{$signin}
				</a>
			</form>
		</section>
	</div>
</section>

<!-- Modal -->
<div class="modal fade" id="modal-terms" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content bg-dark">
      <div class="modal-header b-black">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">{$agree_terms}</h4>
      </div>
      <div class="modal-body">
       {$terms}
      </div>
      <div class="modal-footer b-black">
        <button type="button" class="btn btn-default" data-dismiss="modal">{$close}</button>
      </div>
    </div>
  </div>
</div>