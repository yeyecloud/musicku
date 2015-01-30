$(document).ready(function(){
	$('#submit-settings:button').on('click',function(){
		//Home
		var ssettings_title_home=$('#settings_title_home:input');
		var ssettings_description_home=$('#settings_description_home:input');
		
		var ssettings_analytics=$('#settings_analytics:input');
		//Song
		var ssettings_title_song=$('#settings_title_song:input');
		var ssettings_description_song=$('#settings_description_song:input');
		//Category
		var ssettings_title_category=$('#settings_title_category:input');
		var ssettings_description_category=$('#settings_description_category:input');
		//Playlist
		var ssettings_title_playlist=$('#settings_title_playlist:input');
		var ssettings_description_playlist=$('#settings_description_playlist:input');
		//Profile
		var ssettings_title_profile=$('#settings_title_profile:input');
		var ssettings_description_profile=$('#settings_description_profile:input');
		//singer
		var ssettings_title_singer=$('#settings_title_singer:input');
		var ssettings_description_singer=$('#settings_description_singer:input');
		//Tags 
		var ssettings_title_tags=$('#settings_title_tags:input');
		var ssettings_description_tags=$('#settings_description_tags:input');
		
		//HOME
		if(ssettings_title_home.val()==false){
			ssettings_title_home.notify(ssettings_title_home.attr('data-notify'),'error');
			ssettings_title_home.focus();
			return false;
		}
		if(ssettings_description_home.val()==false){
			ssettings_description_home.notify(ssettings_description_home.attr('data-notify'),'error');
			ssettings_description_home.focus();
			return false;
		}
		//Song
		if(ssettings_title_song.val()==false){
			ssettings_title_song.notify(ssettings_title_song.attr('data-notify'),'error');
			ssettings_title_song.focus();
			return false;
		}
		if(ssettings_description_song.val()==false){
			ssettings_description_song.notify(ssettings_description_song.attr('data-notify'),'error');
			ssettings_description_song.focus();
			return false;
		}
		//category
	
		if(ssettings_title_category.val()==false){
			ssettings_title_category.notify(ssettings_title_category.attr('data-notify'),'error');
			ssettings_title_category.focus();
			return false;
		}
		if(ssettings_description_category.val()==false){
			ssettings_description_category.notify(ssettings_description_category.attr('data-notify'),'error');
			ssettings_description_category.focus();
			return false;
		}
		//Playlist 
		if(ssettings_title_playlist.val()==false){
			ssettings_title_playlist.notify(ssettings_title_playlist.attr('data-notify'),'error');
			ssettings_title_playlist.focus();
			return false;
		}
		if(ssettings_description_playlist.val()==false){
			ssettings_description_playlist.notify(ssettings_description_playlist.attr('data-notify'),'error');
			ssettings_description_playlist.focus();
			return false;
		}
		//Profile
		if(ssettings_title_profile.val()==false){
			ssettings_title_profile.notify(ssettings_title_profile.attr('data-notify'),'error');
			ssettings_title_profile.focus();
			return false;
		}
		if(ssettings_description_profile.val()==false){
			ssettings_description_profile.notify(ssettings_description_profile.attr('data-notify'),'error');
			ssettings_description_profile.focus();
			return false;
		}
		//Singer
		if(ssettings_title_singer.val()==false){
			ssettings_title_singer.notify(ssettings_title_singer.attr('data-notify'),'error');
			ssettings_title_singer.focus();
			return false;
		}
		if(ssettings_description_singer.val()==false){
			ssettings_description_singer.notify(ssettings_description_singer.attr('data-notify'),'error');
			ssettings_description_singer.focus();
			return false;
		}
		//Tags 
		if(ssettings_title_tags.val()==false){
			ssettings_title_tags.notify(ssettings_title_tags.attr('data-notify'),'error');
			ssettings_title_tags.focus();
			return false;
		}
		if(ssettings_description_tags.val()==false){
			ssettings_description_tags.notify(ssettings_description_tags.attr('data-notify'),'error');
			ssettings_description_tags.focus();
			return false;
		}
		var dataString={
			'set_title_song':ssettings_title_song.val(),
			'set_description_song':ssettings_description_song.val(),
			'set_analytics':ssettings_analytics.val(),
			'set_title_home':ssettings_title_home.val(),
			'set_description_home':ssettings_description_home.val(),
			'set_title_category':ssettings_title_category.val(),
			'set_description_category':ssettings_description_category.val(),
			'set_title_playlist':ssettings_title_playlist.val(),
			'set_description_playlist':ssettings_description_playlist.val(),
			'set_title_profile':ssettings_title_profile.val(),
			'set_description_profile':ssettings_description_profile.val(),
			'set_title_singer':ssettings_title_singer.val(),
			'set_description_singer':ssettings_description_singer.val(),
			'set_title_tags':ssettings_title_tags.val(),
			'set_description_tags':ssettings_description_tags.val()
		}
		var urlSend=site_url+'/admincp/settings/update_settings/';
		var data=ajax_global(dataString,urlSend);
		console.log(data);
		return false;
	});
})