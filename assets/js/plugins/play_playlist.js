$(function() {
    $('a#play-now').on('click', function(event) {
        event.preventDefault();
        addPlaylist.play($(this).attr('data-key'));
    });

});
function play_playlist(pl_id) {
    //Play One now
    AjaxJplayer(site_url + '/xml-play-playlist-' + pl_id + '.xml');
}
function delete_song_playlist(pl_id, s_id) {
    var dataString = {
        'pl_id': pl_id,
        's_id': s_id
    }
    var urlSend = site_url + '/music_home/playlist/delete_song_playlist/';
    var data = ajax_global(dataString, urlSend);
    if (data.status == true) {
        $('li#main-song-playlist-' + s_id).fadeOut(200);
        toastr.success(data.messages);
        return false;
    } else {
        toastr.error(data.messages);
        return false;
    }
}
$(document).ready(function() {
    //Auto Play 
    var pl_id = $('#main-playlist').attr('data-id-playlist');
    play_playlist(pl_id);
    $('a#play-playlist-now').on('click', function(event) {
        event.preventDefault();
        addPlaylist.remove();
        var pl_id = $(this).attr('data-id-playlist');
        play_playlist(pl_id);
        addPlaylist.play();
    });

});