$(function()
	{
		//Cookie
		$.cookie('category_name', '', { path: '/' });
		//Auto URL category
		$('#category-name:input').on('blur',function()
			{
				if($(this).val()=='' || $(this).val()==false)
				{
					$(this).notify($(this).attr('data-notify'),'error');
					return false;
				}
				var dataString=
				{
					'category_name':$(this).val()
				};
				var urlSend=site_url+'/admincp/category/url_category/';
				var data=ajax_global(dataString,urlSend);
				$('#category-url:input').val(data.result);
				$.cookie('category_name', data.result, { path: '/' });
			});
		//Upload Images
		$('#file_upload_img_category:input').liteUploader(
			{
				script: site_url+'/cglobal/do_upload',
				params:
				{
					'csrf_ci_music2014': $("input[name=csrf_ci_music2014]").val(),
					'type':'img_category',
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

					$('#img_category:input').val('');
					$('#img_category:input').val(data.file_name);
					toastr.success('Upload Thanh Cong');
				}else
				{
					toastr.success(data.error);
				}

			});
		//Tags Input
		$('#tags-category:input').tagsinput(
			{
				typeahead:
				{
					source: function(query)
					{
						return $.get(site_url+'/cglobal/collection_tags_json');
					}
				},
				freeInput: true
			});
		//Submit Add Category
		$('#submit-addCategory:button').on('click',function()
			{
				var sCategoryName=$('#category-name:input');
				var sCategoryUrl=$('#category-url:input');
				var sCategoryImg=$('#img_category:input');
				var sCategoryTags=$('#tags-category:input');
				var sCategoryDescription=$('textarea#category_description');
				if(sCategoryName.val()=='' || sCategoryName.val()==false)
				{
					$(sCategoryName).focus();
					$(sCategoryName).notify(sCategoryName.attr('data-notify'),'error');
					return false;
				}
				if(sCategoryUrl.val()=='' || sCategoryUrl.val()==false)
				{
					$(sCategoryUrl).focus();
					$(sCategoryUrl).notify(sCategoryUrl.attr('data-notify'),'error');
					return false;
				}
				if(sCategoryImg.val()=='' || sCategoryImg.val()==false)
				{
					$('label#notify-link-img').focus();
					$('label#notify-link-img').notify(sCategoryImg.attr('data-notify'),'error');
					return false;
				}
				if(sCategoryTags.val()=='' || sCategoryTags.val()==false)
				{
					$(sCategoryTags).focus();
					$(sCategoryTags).notify(sCategoryTags.attr('data-notify'),'error');
					return false;
				}
				if(sCategoryDescription.val()=='' || sCategoryDescription.val()==false)
				{
					$(sCategoryDescription).focus();
					$(sCategoryDescription).notify(sCategoryDescription.attr('data-notify'),'error');
					return false;
				}
				if($('#audio:input').prop('checked')==true)
				{
					var type=1;
				}else
				{
					var type=2;
				}
				var dataString=
				{
					'CategoryName':sCategoryName.val(),
					'CategoryUrl':sCategoryUrl.val(),
					'CategoryImg':sCategoryImg.val(),
					'CategoryTags':sCategoryTags.val(),
					'CategoryDescription':sCategoryDescription.val(),
					'CategoryType':type
				}
				var urlSend=site_url+'/admincp/category/insert_category/';
				var data=ajax_global(dataString,urlSend);
				window.location.reload();
				return false;
			});
	});


