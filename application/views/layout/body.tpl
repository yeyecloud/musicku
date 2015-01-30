{$header}
<body class="bg-dark lter">
{$body_data}

<script>
	var base_url='{base_url()}';
	var site_url='{site_url()}';
	var is_login="{$this->ion_auth->logged_in()}";
</script>
<script src="{base_url('assets/js/jquery.min.js')}"></script>
  <!-- Bootstrap -->
  <script src="{base_url('assets/js/bootstrap.js')}"></script>
  <!-- App -->
  <script src="{base_url('assets/js/app.js')}"></script>  
  <script src="{base_url('assets/js/slimscroll/jquery.slimscroll.min.js')}"></script>
  <script type="text/javascript" src="{base_url('assets/js/jPlayer/jquery.jplayer.min.js')}"></script>
  <script type="text/javascript" src="{base_url('assets/js/jPlayer/add-on/jplayer.playlist.min.js')}"></script>
  <script type="text/javascript" src="{base_url('assets/js/notify/notify.min.js')}"></script>
  <script type="text/javascript" src="{base_url('assets/js/toastr/toastr.min.js')}"></script>
  <script type="text/javascript" src="{base_url('assets/js/pjax/jquery.pjax.min.js')}"></script>
  <script type="text/javascript" src="{base_url('assets/js/cookie/jquery.cookie.js')}"></script>
  <script type="text/javascript" src="{base_url('assets/js/chosen/chosen.jquery.min.js')}"></script>
  <script type="text/javascript" src="{base_url('assets/js/file-input/bootstrap-filestyle.min.js')}"></script>
  <script type="text/javascript" src="{base_url('assets/js/ajaxupload/liteUploader.min.js')}"></script>
  <script type="text/javascript" src="{base_url('assets/js/bootbox/bootbox.min.js')}"></script>
  <script type="text/javascript" src="{base_url('assets/js/timeago/timeago.js')}"></script>
  <script src="{base_url('assets/js/app.plugin.js')}"></script>
   
  <script type="text/javascript" src="{base_url('assets/js/global.js')}"></script>
  <script>
  	$.pjax({
		  area: ['#area-load','#sidebar'],
		  load: { head: 'base, meta, link', css: true, script: true },
		  cache: { click: true, submit: false, popstate: true }
	});
  </script>
  {$js_load}
  {$this->templayout->set_modal()}
	 <input type="hidden" value="{$this->security->get_csrf_hash()}" name="{$this->security->get_csrf_token_name()}"/>
</body>
</html>