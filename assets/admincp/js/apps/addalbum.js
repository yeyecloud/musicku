$(function(){
	$.cookie('album_name', '', { path: '/' });
	//Image URL / Local 
	$('#img_url:input').on('change',function(){
		$('div#url-img').animateCSS('bounceIn',function (){
         	$(this).fadeIn();
     	});
		$('div#up-img-local').hide();		
	});
	$('#img_local:input').on('change',function(){
		$('div#up-img-local').animateCSS('bounceIn',function (){
         	$(this).fadeIn();
     	});
     	$('div#url-img').hide();
	});
	//Cookie Album name + auto url
	$('#input-admincp-album-name:input').on('blur',function(){
			$.cookie('album_name', $(this).val(), { path: '/' });
			var dataString={
				'al_name':$(this).val()
			};
			var urlSend=site_url+'/admincp/album/AutoUrl/';
			var data=ajax_global(dataString,urlSend);
			$('#input-admincp-album-url:input').val(data.url);
			return false;
			
	});
	
		//Upload Images
		$('#file_upload_img:input').liteUploader(
			{
				script: site_url+'/cglobal/do_upload',
				params:
				{
					'csrf_ci_music2014': $("input[name=csrf_ci_music2014]").val(),
					'type':'img_album',
				},
			})
		.on('lu:progress', function (e, percentage)
			{
				//console.log(percentage);
				var progress=$('div#div-progress-bar-images');
				progress.show(100);
				progress.find('.progress-bar').attr('aria-valuenow',percentage);
				progress.find('.progress-bar').css("width", percentage+"%");
				progress.find('.progress-bar').text(percentage+"%");
			})
		.on('lu:success', function (e, response)
			{

				
				var data=JSON.parse(response);
				if(data.error==false)
				{

					$('#link-img:input').val('');
					$('#link-img:input').val(data.file_name);
					$('div#up-img-local').hide(300);
					$('div#url-img').show(300);
					toastr.success('Success');
				}else
				{
					toastr.success(data.error);
				}

			});
	//Submit Album
	$('#button-submit-admincp-create-album:button').on('click',function(){
		var sinput_admincp_album_name=$('#input-admincp-album-name:input');
		var sinput_admincp_album_url=$('#input-admincp-album-url:input');
		var stextarea_admincp_album_description=$('textarea#textarea-admincp-album-description');
		var slink_img=$('#link-img');
		if(sinput_admincp_album_name.val()==false){
			sinput_admincp_album_name.focus();
			sinput_admincp_album_name.notify(sinput_admincp_album_name.attr('data-notify'),'error');
			return false;
		}
		if(sinput_admincp_album_url.val()==false){
			sinput_admincp_album_url.focus();
			sinput_admincp_album_url.notify(sinput_admincp_album_url.attr('data-notify'),'error');
			return false;
		}
		if(stextarea_admincp_album_description.val()==false){
			stextarea_admincp_album_description.focus();
			stextarea_admincp_album_description.notify(stextarea_admincp_album_description.attr('data-notify'),'error');
			return false;
		}
		if(slink_img.val()==false){
			$('label#notify-link-img').focus();
			$('label#notify-link-img').notify(slink_img.attr('data-notify'),'error');
			return false;
		}
		var dataString={
			'al_name':sinput_admincp_album_name.val(),
			'al_url':sinput_admincp_album_url.val(),
			'al_description':stextarea_admincp_album_description.val(),
			'al_image':slink_img.val()
		};
		var urlSend=base_url+'admincp/album/ajaxcreatealbum/';
		var dataAjax=ajax_global(dataString,urlSend);
		if(dataAjax.status==true){
			window.location.reload();
		}
		return false;
	});
});