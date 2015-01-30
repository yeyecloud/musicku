$(function()
	{

		//Cookie Upload
		$.cookie('singer_name', '', { path: '/' });
		$("#singer_name:input").on('blur',function()
			{
				var singer_name=$(this).val();
				if(singer_name.length<=0)
				{
					$(this).focus();
					$(this).notify($(this).attr('data-notify'),'error');
					return false;
				}
				var dataString=
				{
					'singer_name':singer_name
				};
				var url_Send=site_url+'/admincp/singer/check_singer_name/';
				var data=ajax_global(dataString,url_Send);
				if(data.status==false)
				{
					$(this).notify($(this).attr('data-notify-exist'),'warring');
					$(this).focus();
					return false;
				}
				var urlSend=site_url+'/admincp/singer/auto_url_singer/';
				var dataUrl=ajax_global(dataString,urlSend);
				$('#singer_url:input').val(dataUrl.url);
				$.cookie('singer_name', dataUrl.url, { path: '/' });
			});
		//Check URL
		$('#singer_url:input').on('blur',function()
			{
				var singer_url=$(this).val();
				if(singer_url==false)
				{
					$(this).notify($(this).attr('data-notify'),'error');
					$(this).focus();
					return false;
				}
				var dataString=
				{
					'singer_url':singer_url
				};
				var urlSend=site_url+'/admincp/singer/check_singer_url/';
				var data=ajax_global(dataString,urlSend);
				if(data.status==false)
				{
					$(this).notify($(this).attr('data-notify-exist'),'warring');
					$(this).focus();
					return false;
				}

			});


		//Upload Images
		$('#file_upload_img_singer:input').liteUploader(
			{
				script: site_url+'/cglobal/do_upload',
				params:
				{
					'csrf_ci_music2014': $("input[name=csrf_ci_music2014]").val(),
					'type':'img_singer',
				},
			})
		.on('lu:progress', function (e, percentage)
			{

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
					$('#singer_img:input').val(data.file_name);
				}else
				{
					toastr.error(data.error);
				}

			});
		//Submit Add Singer
		$('#submit-addsinger:button').on('click',function()
			{
				var sSingerName=$('#singer_name:input');
				var sSingerUrl=$('#singer_url:input');
				var sSingerBirthday=$('#singer_birthday:input');
				var sSingerDescription=$('#singer_description:input');
				var sSingerImg=$('#singer_img:input');
				if(sSingerName.val()==false)
				{
					sSingerName.focus();
					sSingerName.notify(sSingerName.attr('data-notify'),'error');
					return false;
				}
				if(sSingerUrl.val()==false)
				{
					sSingerUrl.focus();
					sSingerUrl.notify(sSingerUrl.attr('data-notify'),'error');
					return false;
				}
				if(sSingerBirthday.val()==false)
				{
					sSingerBirthday.focus();
					sSingerBirthday.notify(sSingerBirthday.attr('data-notify'),'error');
					return false;
				}
				if(sSingerImg.val()==false)
				{
					sSingerImg.focus();
					$('#file_upload_img_singer:input').notify(sSingerImg.attr('data-notify'),'error');
					return false;
				}
				if(sSingerDescription.val()==false)
				{
					sSingerDescription.focus();
					sSingerDescription.notify(sSingerDescription.attr('data-notify'),'error');
					return false;
				}
				var dataString=
				{
					'SingerName':sSingerName.val(),
					'SingerUrl':sSingerUrl.val(),
					'SingerBirthday':sSingerBirthday.val(),
					'SingerImg':sSingerImg.val(),
					'SingerDescription':sSingerDescription.val()
				};
				var urlSend=site_url+'/admincp/singer/add_singer/';
				var data=ajax_global(dataString,urlSend);
				if(data.status==true)
				{
					window.location.reload();
				}
				return false;
			});


	});

