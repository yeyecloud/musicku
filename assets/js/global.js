/*
Var global 
*/
var jPlayer_N = $("#jplayer_N");


// Jplayer Playlist instance
    var addPlaylist = new jPlayerPlaylist({
        jPlayer: "#jplayer_N",
        cssSelectorAncestor: "#jp_container_N"
    }, [], {
        playlistOptions: {
            enableRemoveControls: true,
            autoPlay: true
        },
        swfPath: "../js/jPlayer",
        supplied: "webmv, ogv, m4v, oga, mp3",
        smoothPlayBar: true,
        keyEnabled: true,
        audioFullScreen: false
    });
    $(document).on($.jPlayer.event.pause, addPlaylist.cssSelector.jPlayer, function() {
        $('.musicbar').removeClass('animate');
        $('.jp-play-me').removeClass('active');
        $('.jp-play-me').parent('li').removeClass('active');
    });
    $(document).on($.jPlayer.event.play, addPlaylist.cssSelector.jPlayer, function() {
        $('.musicbar').addClass('animate');
    });
    $(document).on('click', '.jp-play-me', function(e) {
        e && e.preventDefault();
        var $this = $(e.target);
        if (!$this.is('a')) $this = $this.closest('a');
        $('.jp-play-me').not($this).removeClass('active');
        $('.jp-play-me').parent('li').not($this.parent('li')).removeClass('active');
        $this.toggleClass('active');
        $this.parent('li').toggleClass('active');
        if (!$this.hasClass('active')) {
            addPlaylist.pause();
        } else {
            var i = Math.floor(Math.random() * (1 + 7 - 1));
            addPlaylist.play(i);
        }
    });
$(function() {
	$.removeCookie('s_id');
	$.cookie('actions_search', 'song', {path: '/' });
	$(".chosen-select").chosen({width: "95%"}); 
    //Add playlist
    $('i#add-playlist').on('click', function(event) {
        event.preventDefault();
        var s_id = $(this).attr('data-id-song');
        var sViews = $('span#views-item-' + s_id);
        var Views = parseInt(sViews.text());
        $(this).removeClass('fa-plus-circle');
        $(this).addClass('fa-check-circle text-info');
        $('div#modaladdplaylist').modal('show');
        $.cookie('s_id', s_id, {path: '/' });
        
        sViews.text(parseInt(Views + 1));
        AjaxJplayer(site_url + '/xml-play-song-' + s_id + '.xml');
    });
    
    //Creat Playlist
    
    $('#playlist-name:input').on('blur',function(){
    	if($(this).val()==''){
			$(this).focus();
			toastr.error($(this).attr('data-notify'));
            return false;
		}
    });
    $('#file_upload_img:input').liteUploader(
			{
				script: site_url+'/cglobal/do_upload',
				params:
				{
					'csrf_ci_music2014': $("input[name=csrf_ci_music2014]").val(),
					'type':'img_playlist',
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
					$('#img_playlist:input').val('');
					$('#img_playlist:input').val(data.file_name);
					$('div#modaleditplaylist').find('#img_playlist:input').val(data.file_name);
					toastr.success('Success Uploads');
				}else
				{
					toastr.success(data.error);
				}

			});
    
   //Comment
   $('a#more-comment').on('click',function(){
		var s_id=$(this).attr('data-s_id');
		var pages=parseInt($(this).attr('data-pages'));
		var urlGet=site_url+'/music_home/playvideo/getComment/'+s_id+'/'+pages;
		var comment_old=parseInt($(this).attr('data-number-all-comment'));
		 $.get(urlGet,function(data,status){
		 	$('section#content-comment').fadeOut(100);
		 	$('section#content-comment').append(data);
		 	$('section#content-comment').fadeIn(100);
		  });
		  var comment_old_str=parseInt(comment_old-5);
		  if(comment_old_str<=0){
		  	var comment_old_str=0;
		  	$(this).fadeOut(200);
		  }
		  $(this).attr('data-number-all-comment',comment_old_str);
		  $(this).find('#comment-old').text(comment_old_str);
		  $(this).attr('data-pages',parseInt(pages+1));
		return false;
	});
	$('a#href-comment-form').on('click',function(){
       $($(this).attr('href')).whatyouwant();
        return false; 
    }); 
    //Search
    //Actions
    $('a#actions').on('click',function(){
    	$.cookie('actions_search', $(this).attr('data-actions'), {path: '/' });
    });
    $('i#close-search').on('click',function(){
    	$( "div#form-search" ).fadeOut(200);
    });
    $( "#actions-search:input" ).on('click',function() {
	    $('div#form-search').fadeIn(200);
	    $('#search:input').focus();
	  }
	);
    $('#search:input').keyup(function(){
    	var keyword=$(this).val();
    	
    	var dataString={
			'keyword':keyword
		};
		var urlSend=site_url+'/cglobal/search/';
		var data=ajax_global(dataString,urlSend);
		var text='';
		if(data.count_result!=0){
			for($i = 0; $i < data.count_result; $i++){
				if($.cookie('actions_search')=='song'){
					if(isUrl(data.result[$i]['s_img'])==true){
						var img=data.result[$i]['s_img'];
					}else{
						var img=base_url+'/uploads/images/'+data.result[$i]['s_img'];
					}
					
					var timeago=$.timeago(new Date(data.result[$i]['s_date_creat']*1000));
					var name=data.result[$i]['s_name'];
					if(data.result[$i]['s_type']==1){
						var url=base_url+'song/'+data.result[$i]['s_url']+'-'+data.result[$i]['s_id'];
					}else{
						var url=base_url+'video/'+data.result[$i]['s_url']+'-'+data.result[$i]['s_id'];
					}
					
				}else if($.cookie('actions_search')=='playlist'){
					var img=base_url+'/uploads/img_playlist/'+data.result[$i]['pl_img'];
					var timeago=$.timeago(new Date(data.result[$i]['pl_datecreat']*1000));
					var name=data.result[$i]['pl_name'];
					var url=base_url+'play-list/'+data.result[$i]['pl_url']+'-'+data.result[$i]['pl_id'];
					
				}else if($.cookie('actions_search')=='singer'){
					var img=base_url+'/uploads/img_singer/'+data.result[$i]['si_img'];
					var timeago='Not Data';
					var name=data.result[$i]['si_name'];
					var url=base_url+'singer/'+data.result[$i]['si_url']+'-'+data.result[$i]['si_id'];
				}else if($.cookie('actions_search')=='album'){
					var img=base_url+'/uploads/img_album/'+data.result[$i]['al_image'];
					var timeago='Not Data';
					var name=data.result[$i]['al_name'];
					var url=base_url+'album/'+data.result[$i]['al_url']+'-'+data.result[$i]['al_id'];
				}
				text += '<li class="list-group-item bg-dark lt b-black">'+
                        '<div class="media">'+
                          '<span class="pull-left thumb-sm"><img src="'+img+'" style="height:30px;" alt="'+name+'" class="img-circle thumb-xs"></span>'+
                          '<div class="pull-right text-success m-t-sm">'+
                            '<i class="fa fa-circle"></i>'+
                          '</div>'+
                          '<div class="media-body">'+
                            '<div><a href="'+url+'">'+name+'</a></div>'+
                            '<small class="text-muted">'+timeago+'</small>'+
                          '</div>'+
                        '</div>'+
                      '</li>';
			}
		}else{
			text='<li class="list-group-item bg-dark lt">'+
                        '<div class="media">'+
                          '<span class="pull-left thumb-sm"><img src="images/a0.png" alt="John said" class="img-circle"></span>'+
                          '<div class="pull-right text-success m-t-sm">'+
                            '<i class="fa fa-circle"></i>'+
                          '</div>'+
                          '<div class="media-body">'+
                            '<div><a href="#">NOT</a></div>'+
                            '<small class="text-muted">about 2 minutes ago</small>'+
                          '</div>'+
                        '</div>'+
                      '</li>';
		}
		
		//$('ul#result-search').fadeOut(100);
		$('ul#result-search').html('');
		$('ul#result-search').html(text);
		$('ul#result-search').fadeIn(100);
		if(keyword==false || keyword==''){
			$('ul#result-search').fadeOut(100);
		}
		//console.log(keyword);
    });
    
    
});
//Like Song
function LikeSong(l_id){
	var sThis=$('i#LikeSong-'+l_id);
	var dataString={
		'l_id':l_id
	};
	var urlSend=site_url+'/cglobal/LikeSong/';
	var data=ajax_global(dataString,urlSend);
	
	if(data.status===false){
		toastr.error(data.messages);
		return false;
	}else{
		var sTextCountLike=$('span#count-like-'+l_id);
		var valTextCountLike=parseInt(sTextCountLike.text());
		if(data.type==1){
			toastr.warning(data.messages);
			sTextCountLike.text(parseInt(valTextCountLike-1));
			sThis.removeClass('text-danger');
			sThis.removeClass('fa-heart');
			sThis.addClass('fa-heart-o');
			return false;
		}else{
			toastr.success(data.messages);
			sTextCountLike.text(parseInt(valTextCountLike+1));
			sThis.removeClass('fa-heart-o');
			sThis.addClass('text-danger');
			sThis.addClass('fa-heart');
			return false;
		}
		
	}
	
}
//Add Song to Playlist
function addSongtoPlaylist(){
	var pl_id=$('select#idplaylist').val();
	var dataString={
		'pl_id':pl_id
	}
	var urlSend=site_url+'/cglobal/addSongToPlayList/';
	var data=ajax_global(dataString,urlSend);
	if(data.status===false){
		 toastr.warning(data.messages);
	}else{
		 toastr.success(data.messages);
         $('div#modaladdplaylist').modal('hide');
         $('form').trigger('reset');
	}
	return false;
}
//Creat Playlist
function creat_playlist() {
        var splaylist_name = $('#playlist-name:input');
        var simages_playlist=$('#img_playlist:input');
        var pl_name = splaylist_name.val();
        if (pl_name == false || pl_name == '') {
            splaylist_name.focus();
            toastr.error(splaylist_name.attr('data-notify'));
            return false;
        }
        if(simages_playlist.val()==''){
			$('#file_upload_img:input').focus();
			 toastr.error(simages_playlist.attr('data-notify'));
			 return false;
		}
        var dataString = {
            'pl_name': pl_name,
            'pl_img':simages_playlist.val()
        };
        var urlSend = site_url + '/cglobal/creat_playlist/';
        var data = ajax_global(dataString, urlSend);
        if (data.status === false) {
            toastr.warning(data.messages);
        } else {
            toastr.success(data.messages);
            $('div#modalplaylist').modal('hide');
            $('form').trigger('reset');
            $('#img_playlist:input').val('');
            $('div#div-progress-bar-song').fadeOut(200);
        }
        return false;
    }
    //Logout

function logout() {
        var dataString = {};
        var urlSend = site_url + 'cglobal/logout/';
        var data = ajax_global(dataString, urlSend);
        if (data.status == true) {
            window.location.reload();
        }
    }
//Download
function download(s_id){
	var urlSend=site_url+'/cglobal/creat_link_download/'+s_id;
	window.location.assign(urlSend);
}
//Global Ajax
function ajax_global(dataString, url_Send) {
    var csrf = $("input[name=csrf_ci_music2014]").val();
    var security = {
        'csrf_ci_music2014': csrf
    };
    var dataSend = $.extend(security, dataString);
    var result = '';
    $.ajax({
        type: "POST",
        async: false,
        cache: false,
        url: url_Send,
        data: dataSend,
        dataType: "json",
        success: function(json) {
            result = json;
        },
        error: function(jqXHR, textStatus, errorThrown) {
            //alert("get session failed " + errorThrown);
            console.log(dataSend);
            console.log(errorThrown);
        }
    });
    return result;
};
//GET Avatar

function GetAvatar(u_id) {
     var avatar="";
        $.ajax({
         async: false,
         dataType : 'json',
         url: site_url+"/music_home/profile/GetAvatar/"+u_id+"/",
         type : 'GET',
         success: function(data) {
         	avatar=data.avatar;
           }
      	});
        return avatar;
}
function GetImgSong(s_img){
	 var Img="";
        $.ajax({
         async: false,
         dataType : 'json',
         url: site_url+"/cglobal/GetImgSong/"+s_img+"/",
         type : 'GET',
         success: function(data) {
         	Img=data.Img;
           }
      	});
        return Img;
}
//Get Notify
function GetNotify(){
	text = "";
	var i;
	$.getJSON( site_url+"/music_home/profile/getnotify/", function( json ) {
		for($i = 0; $i < json.count; $i++){
			if(json.result[$i].n_type==2 || json.result[$i].n_type==1){
				text += '<a href="'+json.result[$i].n_url+'" class="media list-group-item bg-dark lter">'+
	                  '<span class="pull-left thumb-sm text-center">'+
	                    '<i class="fa fa-envelope-o fa-2x text-success"></i>'+
	                  '</span>'+
	                  '<span class="media-body block m-b-none">'+
	                    json.result[$i].n_messages+'<br/>'+
	                    '<small class="text-muted">'+$.timeago(new Date(json.result[$i].n_datecreat*1000))+'</small>'+
	                  '</span>'+
	                '</a>';	
			}else{
				text += '<a id="notify-allow-friend-'+json.result[$i].n_id+'"  class="media list-group-item bg-dark lter">'+
                    '<span class="pull-left thumb-sm">'+
                      '<img src="'+GetAvatar(json.result[$i].n_from)+'" alt="..." class="img-circle">'+
                    '</span>'+
                    '<span class="media-body block m-b-none">'+
                      json.result[$i].n_messages+'<br/>'+
                      '<div class="m-b-sm">'+
		                '<div class="btn-group" data-toggle="buttons">'+
		                  '<label class="btn btn-xs btn-success" onclick="allow('+json.result[$i].n_from+','+json.result[$i].n_id+')">'+
		                    '<input name="options" type="radio"><i class="fa fa-check-square-o"></i> Allow'+
		                  '</label>'+
		                  '<label class="btn btn-xs btn-danger" onclick="deny('+json.result[$i].n_from+','+json.result[$i].n_id+')">'+
		                    '<input name="options" type="radio"><i class="fa fa-minus-circle"></i> Deny'+
		                  '</label>'+
		                '</div>'+
		              '</div>'+
                      '<small class="text-muted">'+$.timeago(new Date(json.result[$i].n_datecreat*1000))+'</small>'+
                    '</span>'+
                  '</a>';	
			}
			
	      
		}
		addMsg(text,json.count);
	});
	//Enter Add Comment
	
	$( "textarea#cm-text" ).keypress(function(event) {
	  if ( event.which == 13 ) {
	     event.preventDefault();
	     addCommentVideo();
	  }
	});
}
//GET NOTIFY
if(is_login==true){
	GetNotify();
setInterval(function(){
	GetNotify();
}, 60000);//1 Min
}

// add notes
function addMsg($msg,$count){
		var $el = $('.nav-user'), $n = $('.count:first', $el), $v = parseInt($n.text());
		$('.count', $el).fadeOut().fadeIn().text($count);
		$el.find('.list-group').html('');
		$($msg).hide().prependTo($el.find('.list-group')).slideDown().css('display','block');
}

//Disable Notify
function disable_notify(){
	var dataString={
		
	};
	var urlSend=site_url+'/music_home/profile/remove_all_notify/';
	var data=ajax_global(dataString,urlSend);
	return false;
}
function addCommentVideo(){
	var s_id=$('a#submit-comment').attr('data-s_id');
	var scm_text=$('textarea#cm-text');
	var cm_text=scm_text.val();
	var all_comment_display=$('#content-comment').html();
	if(cm_text==false){
		scm_text.focus();
		scm_text.notify(scm_text.attr('data-notify'),'error');
		return false;
	}
	var dataString={
		's_id':s_id,
		'cm_text':cm_text,
		'type':"CommentVideo"
	};
	var urlSend=site_url+'/cglobal/addComment/';
	var data=ajax_global(dataString,urlSend);
	toastr.success(data.messages);
	scm_text.val('');
	$('#content-comment').html(data.add_html+all_comment_display);
	
	return false;
}
//Delete Comment 
function delete_comment(cm_id,messages){
	bootbox.confirm(messages, function(result) {
  		if(result==true){
			var dataString={
				'cm_id':cm_id
			};
			var urlSend=site_url+'/cglobal/DeleteComment/';
			var data=ajax_global(dataString,urlSend);
			toastr.success(data.messages);
			$('article#comment-id-'+cm_id).fadeOut(200);
		}
	}); 
}
//Check Url
function isUrl(s) {
	var regexp = /(ftp|http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/
	return regexp.test(s);
}
//Allow Friend
function allow(u_id,notify_id){
	var dataString={
		'u_id':u_id
	};
	var urlSend=site_url+'/cglobal/allow_add_friend/';
	var data=ajax_global(dataString,urlSend);
	if(data.status==true){
		$('a#notify-allow-friend-'+notify_id).fadeOut(200);
	}
}
//Deny Friend
function deny(u_id,notify_id){
	var dataString={
		'u_id':u_id
	};
	var urlSend=site_url+'/cglobal/deny_add_friend/';
	var data=ajax_global(dataString,urlSend);
	if(data.status==true){
		$('a#notify-allow-friend-'+notify_id).fadeOut(200);
	}
}

//Player NEW 

function PlaySong(s_id, Type) {
	//Var global
	var jPlayer_N = $("#jplayer_N");
    if (Type == 'Home') {
        var sIplayNow = $('i#play-now-' + s_id);
        var divSongNew = $('div#song-new');
        //Add class Play to all
        divSongNew.find('i.icon-control-pause').addClass('icon-control-play');

        //Remove all class pause
        divSongNew.find('i.icon-control-pause').removeClass('icon-control-pause');
        if (sIplayNow.attr('data-is-play') == 0) { //Not player
            jPlayer_N.jPlayer("play");
            //Add All to status 0 (not play | not pause)
            divSongNew.find('i.icon-control-play').attr('data-is-play', 0);
            sIplayNow.removeClass('icon-control-play');
            sIplayNow.addClass('icon-control-pause');
            sIplayNow.attr('data-is-play', 1);

        } else if (sIplayNow.attr('data-is-play') == 1) { //Is play
            jPlayer_N.jPlayer("pause");
            sIplayNow.removeClass('icon-control-pause');
            sIplayNow.addClass('icon-control-play');
            sIplayNow.attr('data-is-play', 2);
            return false;
        } else {
            jPlayer_N.jPlayer("play");
            sIplayNow.removeClass('icon-control-play');
            sIplayNow.addClass('icon-control-pause');
            sIplayNow.attr('data-is-play', 1);
            return false;
        }
        //var s_id=$(this).attr('data-id-song');
        var sViews = $('span#views-item-' + s_id);
        var Views = parseInt(sViews.text());
        //Remove Active Item Hover
        divSongNew.find('div.active').removeClass('active');
        //Actives Class Hover Item
        $('#item-' + s_id).addClass('active');
        sViews.text(parseInt(Views + 1));
		AjaxJplayer(site_url + '/xml-play-song-' + s_id + '.xml');
    }else if (Type == 'PlaySong') {
		
    }

}
//Ajax jPlayer
function AjaxJplayer(url_xml){
	$.ajax({
        type: "GET",
        url: url_xml,
        dataType: "xml",
        success: function(xml) {
            $(xml).find('track').each(function() {
                var self = $(this),
                    mytitle = self.find('title').text(),
                    myartist = self.find('artist').text(),
                    mymp3 = self.find('mp3').text(),
                    playlist = JSON.stringify({
                        title: mytitle,
                        artist: myartist,
                        mp3: mymp3
                    }), // Convert the XML nodes into JSON formatted strings
                    playlistObject = $.parseJSON(playlist); // Convert the JSON formatted strings into JSON objects and add to playlist
                addPlaylist.add(playlistObject);
                jPlayer_N.jPlayer("play");
   				jPlayer_N.jPlayer("repeat");
            });

        }
    });
}


//Clear Playlist 
function ClearJplayer(url){
	jPlayer_N.jPlayer("load");
	window.location.assign(url);
	return false;
}

