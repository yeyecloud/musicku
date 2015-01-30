$(document).ready(function(){
	$.ajax({
        type: "GET",
        url: site_url+'/xml-play-video-'+$('#s_id:input').val()+'.xml',
        dataType: "xml",
        success: function(xml) {
            $(xml).find('track').each(function() {
                var self = $(this),
                    mytitle = self.find('title').text();
                    myposter = self.find('poster').text();
                    mymp4 = decodeURIComponent(self.find('mp4').text());
                    mywebm = decodeURIComponent(self.find('webm').text());
                    
                $("#jplayer_1").jPlayer({
				    ready: function () {
				      $(this).jPlayer("setMedia", {
				        title: mytitle,
				       	mp4:  mymp4,
				        webmv: mywebm,
				        poster: myposter
				      }).jPlayer("play");
				    },
				    playlistOptions: {
					  autoPlay: true,
					  loopOnPrevious: false,
					  shuffleOnLoop: true,
					  enableRemoveControls: false,
					},
				    swfPath: "js",
				    supplied: "webmv, ogv, m4v, mp4, webm",
				    size: {
				      width: "100%",
				      height: "auto",
				      cssClass: "jp-video-360p"
				    },
				    globalVolume: true,
				    smoothPlayBar: true,
				    keyEnabled: true,
				  });
            });
            
        }
    });
	
})