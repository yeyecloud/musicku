$(function() {
    $('a#play-now').on('click', function(event) {
        event.preventDefault();
        addPlaylist.play($(this).attr('data-key'));
    });

});
function play_album(pl_id) {
    //Play One now
    AjaxJplayer(site_url + '/xml-play-album-' + pl_id + '.xml');
}

$(document).ready(function() {
    //Auto Play 
    var al_id = $('#main-album').attr('data-id-album');
  	 play_album(al_id);
    $('a#play-album-now').on('click', function(event) {
        event.preventDefault();
        addPlaylist.remove();
        var pl_id = $(this).attr('data-id-album');
        play_album(pl_id);
        addPlaylist.play();
        
    });

});