$(document).ready(function(){

    setInterval(changeUrl,10000);

    function changeUrl(){

    	/*
    	$("#v").html('<source src="m.mp4" type="video/mp4"></source>' );
    	$("#v-div")[0].load();
        console.log('changed');
		*/

        var $video = $('#v'),
			videoSrc = $('m.mp4', $video).attr('src', videoFile);
			$video[0].load();
			$video[0].play();
	    }

});