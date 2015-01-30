$(document).ready(function() {
	$('a#edit-profile').on('click',function(){
		$('div#modaleditprofile').modal('show');
	});
	$('#submit-edit-profile:button').on('click',function(){
	console.log(1232);
		var sfirst_name=$('#first_name:input');
		var slast_name=$('#last_name:input');
		var scompany=$('#company:input');
		var sphone=$('#phone:input');
		var saddress=$('#address:input');
		var stextarea=$('#aboutme:input');
		var savatar=$('#avatar:input');
		if(sfirst_name.val()==false){
			sfirst_name.notify(sfirst_name.attr('data-notify'),'error');
			sfirst_name.focus();
			return false;
		}
		if(slast_name.val()==false){
			slast_name.notify(slast_name.attr('data-notify'),'error');
			slast_name.focus();
			return false;
		}
		if(scompany.val()==false){
			scompany.notify(scompany.attr('data-notify'),'error');
			scompany.focus();
			return false;
		}
		if(sphone.val()==false){
			sphone.notify(sphone.attr('data-notify'),'error');
			sphone.focus();
			return false;
		}
		if(saddress.val()==false){
			saddress.notify(saddress.attr('data-notify'),'error');
			saddress.focus();
			return false;
		}
		if(stextarea.val()==false){
			stextarea.notify(stextarea.attr('data-notify'),'error');
			stextarea.focus();
			return false;
		}
		if(savatar.val()==false){
			$('#file_upload_img:input').notify($('#file_upload_img:input').attr('data-notify'),'error');
			$('#file_upload_img:input').focus();
			return false;
			
		}
		if($('#sex:input').prop('checked')==true){
			var sex=1;
		}else{
			var sex=2;
		}
		
		var dataString={
			'first_name':sfirst_name.val(),
			'last_name':slast_name.val(),
			'company':scompany.val(),
			'phone':sphone.val(),
			'address':saddress.val(),
			'textarea':stextarea.val(),
			'avatar':savatar.val(),
			'sex':sex
		};
		var urlSend=site_url+'/music_home/profile/update_info_user/';
		var data=ajax_global(dataString,urlSend);
		if(data.status==true){
			window.location.reload();
		}
		
	});
	//Change Password 
	$('a#change-password').on('click',function(){
		$('div#modalchangepassword').modal('show');	
	});
	$('#submit-change-password:button').on('click',function(){
		
		var spassword_old=$('#password_old:input');
		var spassword_new=$('#password_new:input');
		
		var sre_password_new=$('#re_password_new:input');
		if(spassword_old.val()==false){
			spassword_old.notify(spassword_old.attr('data-notify'),'error');
			spassword_old.focus();
			return false;
		}
		if(spassword_new.val()==false || sre_password_new.val()==false){
			sre_password_new.notify(sre_password_new.attr('data-notify'),'error');
			sre_password_new.focus();
			return false;
		}
		if(spassword_new.val()!==sre_password_new.val()){
			sre_password_new.notify(sre_password_new.attr('data-notify'),'error');
			sre_password_new.focus();
			return false;
		}
		var dataString={
			'password_old':spassword_old.val(),
			'password_new':spassword_new.val()
		};
		var urlSend=site_url+'/music_home/profile/change_password/';
		var data=ajax_global(dataString,urlSend);
		if(data.status==true){
			window.location.reload();
		}else{
			spassword_old.notify(data.messages,'error');
			spassword_old.focus();
			return false;
		}
	});
	//Upload Avatar
		$('#file_upload_img_avatar:input').liteUploader(
			{
				script: site_url+'/cglobal/do_upload',
				params:
				{
					'csrf_ci_music2014': $("input[name=csrf_ci_music2014]").val(),
					'type':'img_avatar',
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
					$('#avatar:input').val('');
					$('#avatar:input').val(data.file_name);
					toastr.success('Success Uploads');
				}else
				{
					toastr.success(data.error);
				}

			});
			
			
			
		
});
function edit_playlist(pl_id){
	var smodal=$('div#modaleditplaylist');
	var spl_name=$('span#pl_name-'+pl_id);
	var pl_name=spl_name.text();
	var pl_img=$('img#img-playlist-'+pl_id).attr('src');
	$.cookie('playlist_name', pl_name, {path: '/' });
	smodal.find('#img_playlist:input').val(pl_img);
	smodal.find('#playlist_edit_name:input').val(pl_name);
	smodal.modal('show');
	$('#submit-edit-playlist:button').attr('data-id-playlist',pl_id);
	return false;
}
function submit_edit_playlist(){
	var smodal=$('div#modaleditplaylist');
	var pl_id=smodal.find('#submit-edit-playlist:button').attr('data-id-playlist');
	var spl_name=smodal.find('#playlist_edit_name:input');
	var spl_img=smodal.find('#img_playlist:input');
	if(spl_name.val()==false){
		spl_name.focus();
		spl_name.notify(spl_name.attr('data-notify'),'error');
		return false;
	}
	if(spl_img.val()==false){
		smodal.find('#file_upload_img:input').notify(smodal.find('#file_upload_img:input').attr('data-notify'),'error');
		smodal.find('#file_upload_img:input').focus();
		return false;
	}
	var dataString={
		'pl_id'	:pl_id,
		'pl_name':spl_name.val(),
		'pl_img':spl_img.val()
	};
	var urlSend=site_url+'/music_home/profile/edit_playlist/';
	var data=ajax_global(dataString,urlSend);
	if(data.status==true){
		window.location.reload();
	}
}
function delete_playlist(pl_id,messages){
	bootbox.confirm(messages, function(result) {
	  if(result==true){
	  	var dataString={
			'pl_id':pl_id	
		};
		var urlSend=site_url+'/music_home/profile/delete_playlist/';
		var data=ajax_global(dataString,urlSend);
		if(data.status==false){
			toastr.error(data.messages);
			return false;
		}else{
			toastr.success(data.messages);
			$('li#main-playlist-'+pl_id).fadeOut(200);
		}
	  }
	});
}
function follow(u_following){
	var dataString={
		'u_following':u_following
	};
	var urlSend=site_url+'/music_home/profile/follow/';
	var data=ajax_global(dataString,urlSend);
	if(data.status===false){
		toastr.error(data.messages);
		return false;
	}else if(data.status==1){
		toastr.success(data.messages);
		$('span#follow').text($('span#follow').attr('data-notify-following'));
		return false;
	}else{
		toastr.success(data.messages);
		$('span#follow').text($('span#follow').attr('data-notify-follow'));
		return false;
	}
	
}
function friend(u_fr){
	var dataString={
		'u_fr':u_fr
	};
	var urlSend=site_url+'/music_home/profile/friend/';
	var data=ajax_global(dataString,urlSend);
	if(data.status==false){
		toastr.error(data.messages);
		return false;
	}else if(data.status==1){
		toastr.success(data.messages);
		$('span#friend').text($('span#friend').attr('data-notify-watting-friend'));
		return false;
	}else if(data.status==2 || data.status==3){
		toastr.success(data.messages);
		$('span#friend').text($('span#friend').attr('data-notify-add-friend'));
		return false;
	}
	
}
function allow(u_fr,n_id){
	var dataString={
		'u_fr':u_fr,
		'n_id':n_id
	};
	var urlSend=site_url+'/music_home/profile/allowFriend/';
	var data=ajax_global(dataString,urlSend);
	if(data.status==true){
		$('a#notify-allow-friend-'+n_id).fadeOut(200);
		GetNotify();
	}
	return false;
}
function deny(u_fr,n_id){
	var dataString={
		'u_fr':u_fr,
		'n_id':n_id
	};
	var urlSend=site_url+'/music_home/profile/denyFriend/';
	var data=ajax_global(dataString,urlSend);
	if(data.status==true){
		$('a#notify-allow-friend-'+n_id).fadeOut(200);
		GetNotify();
	}
	return false;
}
