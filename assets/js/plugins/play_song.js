function PlaySongOnPagesSong(s_id) {
    if ($('a#a-play').attr('data-is-play') == 1) { //is play
        addPlaylist.pause();
        $('a#a-play').removeClass('btn-danger');
        $('a#a-play').addClass('btn-success');
        $('a#a-play').attr('data-is-play', 2); // status pause
        $('i#i-play').removeClass('fa-pause');
        $('i#i-play').addClass('fa-play');
        $('span#span-play-pause').text('Play');
        return false;
    } else if ($('a#a-play').attr('data-is-play') == 2) {
        addPlaylist.play();
        $('a#a-play').removeClass('btn-success');
        $('a#a-play').addClass('btn-danger');
        $('a#a-play').attr('data-is-play', 1);
        $('i#i-play').removeClass('fa-play');
        $('i#i-play').addClass('fa-pause');
        $('span#span-play-pause').text('Pause');
        return false;
    } else {
        $('a#a-play').removeClass('btn-success');
        $('a#a-play').addClass('btn-danger');
        $('a#a-play').attr('data-is-play', 1);
        $('i#i-play').removeClass('fa-play');
        $('i#i-play').addClass('fa-pause');
        $('span#span-play-pause').text('Pause');
        addPlaylist.remove();
        AjaxJplayer(site_url + '/xml-play-song-' + s_id + '.xml');
        addPlaylist.play();
    }


}

function PlaySongOnPagesSong_More(s_id) {
    $('a#a-play').removeClass('btn-danger');
    $('a#a-play').addClass('btn-success');
    $('a#a-play').attr('data-is-play', 0); // status pause
    $('i#i-play').removeClass('fa-pause');
    $('i#i-play').addClass('fa-play');
    $('span#span-play-pause').text('Play');
    addPlaylist.remove();
    AjaxJplayer(site_url + '/xml-play-song-' + s_id + '.xml');
    addPlaylist.play();

}
$(function() {
    //Auto Play 
    AjaxJplayer(site_url + '/xml-play-song-' + $('#main-play').attr('data-id-song') + '.xml');
    //Add Pause
    $('a#a-play').removeClass('btn-danger');
    $('a#a-play').addClass('btn-success');
    $('a#a-play').attr('data-is-play', 0);
    $('i#i-play').removeClass('fa-pause');
    $('i#i-play').addClass('fa-play');
    $('span#span-play-pause').text('Play');
});