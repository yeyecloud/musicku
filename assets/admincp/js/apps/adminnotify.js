$(function()
	{
		$('#submit-settings-notify:button').on('click',function(){
			var scontent=$('textarea#settings_notify_content');
			if(scontent.val()==false){
				scontent.notify(scontent.attr('data-notify'),'error');
				return false;
			}
			var dataString={
				'content':scontent.val()
			}
			var urlSend=site_url+'/admincp/settings/add_admin_notify/';
			var data=ajax_global(dataString,urlSend);
			if(data.status==true){
				window.location.reload();
			}
			return false;
		});
	});