$(function()
	{
		$('.selectpicker').selectpicker();
		//Cookie Upload
		$.cookie('server_img', '', { path: '/' });
		$.cookie('song_name', '', { path: '/' });
		$.cookie('type_upload_song', '', { path: '/' });
		$("#song-name:input").on('blur',function()
			{
				var songname=$(this).val();
				if(songname.length<=0)
				{
					$(this).focus();
					$(this).notify($(this).attr('data-notify'),'error');
					return false;
				}
				var dataString=
				{
					'song_name':songname
				};
				var url_Send=site_url+'/admincp/song/url_song';
				var data=ajax_global(dataString,url_Send);
				$("#song-url:input").val(data.result);
				$.cookie('song_name', data.result, { path: '/' });
			});
		//Check URL
		$('#song-url:input').on('blur',function()
			{
				var songurl=$(this).val();
				if(songurl.length<=0)
				{
					$(this).focus();
					$(this).notify($(this).attr('data-notify'),'error');
					return false;
				}
			});

		//Video or Audio
		$("#audio:input,#video:input").on('click',function()
			{
				$('#url-link:input').val('');
				$('div#url_upload').hide(300);
				append_note_upload();
				$('div#url_upload').show(300);

			});
		//Link or Upload
		$('#url:input').on('click',function()
			{
				var sSongname=$('#song-name:input');
				if(sSongname.val().length<0 || sSongname.val()=='')
				{
					sSongname.focus();
					sSongname.notify(sSongname.attr('data-notify'),'error');
					return false;
				}
				append_note_upload();
				$('div#upload-video').hide(300);
				$('div#upload-audio').hide(300);
				$('div#url').show(300);
			});
		$('#upload:input').on('click',function()
			{
				var sSongname=$('#song-name:input');
				if(sSongname.val().length<0 || sSongname.val()=='')
				{
					sSongname.focus();
					sSongname.notify(sSongname.attr('data-notify'),'error');
					return false;
				}
				append_note_upload()
				$('div#url').hide(300);
				//$('div#upload').show(300);
				if($('#video:input').prop('checked')==true)
				{
					$('div#upload-audio').hide(300);
					$('div#upload-video').show(300);
				}else if($('#audio:input').prop('checked')==true)
				{
					$('div#upload-video').hide(300);
					$('div#upload-audio').show(300);
				}
			});
		//Check Url Song, video
		$('#url-link:input').on('blur',function()
			{
				if($("#audio:input").prop('checked')==true)
				{
					var type=1;
				}else
				{
					var type=2;
				}
				var dataString=
				{
					'link_song':$(this).val(),
					'type_link':type
				};
				var url_Send=site_url+'/admincp/song/link_song_video';
				var data=ajax_global(dataString,url_Send);
				if(data.result===false)
				{
					$(this).focus();
					$(this).notify($(this).attr('data-notify'),'error');
				}
			});
		//Check Singer
		$('#singer-song:input').on('blur',function()
			{
				if($(this).val().length<=0)
				{
					$(this).focus();
					$(this).notify($(this).attr('data-notify'),'error');
					return false;
				}
			});
		$.get(site_url+'/cglobal/collection_singer_json', function(data)
			{
				$("#singer-song:input").typeahead({source:data});
			},'json');

		//Check Tags

		$('#tags-song:input').on('blur',function()
			{
				if($(this).val().length<=0)
				{
					$(this).focus();
					$(this).notify($(this).attr('data-notify'),'error');
					return false;
				}
			});
		$('#tags-song:input').tagsinput(
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
		//Check Images
		$('#img_url:input').on('click',function()
			{
				$('div#url-img').show(300);
				$('div#up-img-local').hide(300);

			});
		$('#img_local:input').on('click',function()
			{
				var sSongname=$('#song-name:input');
				if(sSongname.val().length<0 || sSongname.val()=='')
				{
					sSongname.focus();
					sSongname.notify(sSongname.attr('data-notify'),'error');
					return false;
				}
				$('div#up-img-local').show(300);
				$('div#url-img').hide(300);
			});

		//Insert Link Images
		$('#link-img:input').keyup(function()
			{
				$('#link-img-hide:input').val('');
				$('#link-img-hide:input').val($(this).val());
			});
		$('#url-link:input').keyup(function()
			{
				$('#link-song:input').val('');
				$('#link-song:input').val($(this).val());
			});
		//Submit addSong
		$('#submit-addSong:button').on('click',function()
			{
				//Check Song Name
				var sSongname=$('#song-name:input');
				if(sSongname.val().length<0 || sSongname.val()=='')
				{
					sSongname.focus();
					sSongname.notify(sSongname.attr('data-notify'),'error');
					return false;
				}
				//Check Song URL
				var sSongurl=$('#song-url:input');
				if(sSongurl.val().length<0 || sSongurl.val()=='')
				{
					sSongurl.focus();
					sSongurl.notify(sSongurl.attr('data-notify'),'error');
					return false;
				}
				//Check source Song
				var sSonglink=$('#link-song:input');
				if(sSonglink.val()=='')
				{
					$('label#notify-source-song').notify(sSonglink.attr('data-notify'),'error');
					$('label#notify-source-song').focus();
					return false;
				}
				//Check Images url
				var sSongimg=$('#link-img-hide:input');
				//alert(sSongimg.val());
				if(sSongimg.val()=='')
				{
					$('label#notify-link-img').notify(sSongimg.attr('data-notify'),'error');
					$('label#notify-link-img').focus();
					return false;
				}
				//Check Singer
				var sSongsinger=$('#singer-song:input');
				if(sSongsinger.val()=='')
				{
					sSongsinger.notify(sSongsinger.attr('data-notify'),'error');
					sSongsinger.focus();
					return false;
				}
				//Check Tags
				var sSongtags=$('#tags-song:input');
				if(sSongtags.val()=='')
				{
					sSongtags.notify(sSongtags.attr('data-notify'),'error');
					sSongtags.focus();
					return false;
				}
				if($('#audio:input').prop('checked')==true)
				{
					var SongType=1;
				}else
				{
					var SongType=2;
				}
				var dataString=
				{
					song_name:sSongname.val(),
					song_url:sSongurl.val(),
					song_link:sSonglink.val(),
					song_img:sSongimg.val(),
					song_singer:sSongsinger.val(),
					song_tags:sSongtags.val(),
					song_type:SongType,
					song_cat:$('select#category').val(),
					song_lyrics:$('textarea#lyrics').val(),
					s_id:parseInt($('#s_id:input').val()),
					ly_id:parseInt($('#ly_id:input').val())
				};
				var urlSend=site_url+'/cglobal/updateSong/'
				var data=ajax_global(dataString,urlSend);
				window.location.reload();
				return false;
			});
		//Upload Images
		$('#file_upload_img:input').liteUploader(
			{
				script: site_url+'/cglobal/do_upload',
				params:
				{
					'csrf_ci_music2014': $("input[name=csrf_ci_music2014]").val(),
					'type':'img',
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
					$('#link-img:input').val(base_url+'uploads/images/'+data.file_name);
					$('div#up-img-local').hide(300);
					$('div#url-img').show(300);
					$('#link-img-hide:input').val(data.file_name);
					toastr.success('Success');
				}else
				{
					toastr.success(data.error);
				}

			});
		//Upload Audio or Video

		$('#file_upload_audio:input').liteUploader(
			{
				script: site_url+'/cglobal/do_upload',
				params:
				{
					'csrf_ci_music2014': $("input[name=csrf_ci_music2014]").val(),
					'type':'audio',
				},
			})
		.on('lu:progress', function (e, percentage)
			{
				//console.log(percentage);
				var progress=$('div#div-progress-bar-song');
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
					$('#url-link:input').val('');
					$('#url-link:input').val(base_url+'uploads/mp3/'+data.file_name);
					$('div#upload-audio').hide(300);
					$('div#url').show(300);
					$('#link-song:input').val(data.file_name);
					toastr.success('Upload Thanh Cong');
				}else
				{
					toastr.success(data.error);
				}

			});

		$('#file_upload_video:input').liteUploader(
			{
				script: site_url+'/cglobal/do_upload',
				params:
				{
					'csrf_ci_music2014': $("input[name=csrf_ci_music2014]").val(),
					'type':'video',
				},
			})
		.on('lu:progress', function (e, percentage)
			{
				//console.log(percentage);
				var progress=$('div#div-progress-bar-song');
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
					$('#url-link:input').val('');
					$('#url-link:input').val(base_url+'uploads/mp4/'+data.file_name);
					$('div#upload-video').hide(300);
					$('div#url').show(300);
					$('#link-song:input').val(data.file_name);
					toastr.success('Upload Thanh Cong');
				}else
				{
					toastr.success(data.error);
				}

			});


	});

function append_note_upload()
{
	if($("#audio:input").prop('checked')==true)
	{
		$('p#note_upload').remove();
		$('div#url').append('<p id="note_upload" class="help-block">Ex: https://soundcloud.com/anychanh/quang-le-mai-thien-van-can-nha-mau-tim</p>');
		$('div#upload-video').hide(300);
		$('div#upload-audio').hide(300);
	}
	if($("#video:input").prop('checked')==true)
	{
		$('p#note_upload').remove();
		$('div#url').append('<p id="note_upload" class="help-block">Ex: https://www.youtube.com/watch?v=eWNtpc_UD-Q</p>');
		$('div#upload-audio').hide(300);
		$('div#upload-video').hide(300);
	}
}
