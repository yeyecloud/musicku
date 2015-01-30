$(function()
	{

		//Check Tags Name
		$('#tags_name:input').on('blur',function()
			{
				var tags_name=$(this).val();
				if(tags_name==false)
				{
					$(this).notify($(this).attr('data-notify'),'error');
					$(this).focus();
					return false;
				}
				var dataString=
				{
					'tags_name':tags_name
				}
				var urlSend=site_url+'/admincp/tags/check_tags_name/';
				var data=ajax_global(dataString,urlSend);
				if(data.status==false)
				{
					$(this).notify($(this).attr('data-notify-exist'),'warring');
					$(this).focus();
					return false;
				}
			});
		//Submit Add Tags
		$('#submit-addTags:button').on('click',function()
			{
				var sTagsName=$('#tags_name:input');
				var TagsName=sTagsName.val();
				if(TagsName==false)
				{
					sTagsName.notify(sTagsName.attr('data-notify'),'error');
					sTagsName.focus();
					return false;
				}
				var dataString=
				{
					'tags_name':TagsName
				}
				var urlSend=site_url+'/admincp/tags/check_tags_name/';
				var data=ajax_global(dataString,urlSend);
				if(data.status==false)
				{
					sTagsName.notify(sTagsName.attr('data-notify-exist'),'warring');
					sTagsName.focus();
					return false;
				}
				var dataString2=
				{
					'TagsName':TagsName
				};
				var urlSend2=site_url+'/admincp/tags/add_tags/';
				var data2=ajax_global(dataString2,urlSend2);
				if(data2.status==true)
				{
					window.location.reload();
				}
				return false;
			});


	});

