<section id="content" class="m-t-lg wrapper-md animated fadeInUp">    
    <div class="container aside-xl">
      <a class="navbar-brand block" href="{$base_url}"><span class="h1 font-bold">{$signin}</span></a>
      <section class="m-b-lg">
        <header class="wrapper text-center">
          <strong>{$solo}</strong>
        </header>
        <form action="#" method="POST">
          <div class="form-group">
            <input type="email" placeholder="{$email}" id="email" data-notify="{$notify_email}" class="form-control rounded input-lg text-center no-border">
          </div>
          <div class="form-group">
             <input type="password" placeholder="{$password}" id="password" data-notify="{$notify_password}" class="form-control rounded input-lg text-center no-border">
          </div>
          <div class="checkbox i-checks m-b">
					<label class="m-l">
						<input type="checkbox" id="remember" value="TRUE" checked="">
						<i>
						</i> 
						{$remember}
					</label>
			</div>
          <button type="submit" id="signin" class="btn btn-lg btn-warning lt b-white b-2x btn-block btn-rounded"><i class="icon-arrow-right pull-right"></i><span class="m-r-n-lg">{$signin}</span></button>
         
          <div class="line line-dashed"></div>
          <p class="text-muted text-center"><small>{$not_already_account}</small></p>
          <a href="{$base_url}sign-up" class="btn btn-lg bg-dark btn-block rounded">{$signup}</a>
        </form>
      </section>
    </div>
  </section>

  <!-- / footer -->