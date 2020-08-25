<?php
	
	
	include $_SERVER['DOCUMENT_ROOT'] . '/safety/includes/header.php';

	
?>	

	<embed src="https://www.youtube.com/embed/iLyKbfr89Mc" style="width: 500px;height: 350px"></embed>

	<a href="https://www.google.com" style="font-size: 30px">google</a>

	<!--
	<div id="video-placeholder"></div>
	

	<p id="play">
		play
	</p>
	-->
	<div id="q">
		
	</div>

<?php

	include $_SERVER['DOCUMENT_ROOT'] . '/safety/includes/footer.php';


?>

<script src="http://malsup.github.io/jquery.blockUI.js"></script>
<script src="https://www.youtube.com/iframe_api"></script>

<script type="text/javascript">

	$('#player').load('https://www.youtube.com/embed/3sH7wbIZjEY');

	var player;

	function onYouTubeIframeAPIReady() {
	    player = new YT.Player('video-placeholder', {
	        width: 600,
	        height: 400,
	        videoId: 'Xa0Q0J5tOP0',

	        playerVars: {
	            color: 'white',
	            playlist: 'taJ60kskkns,FG0fTKAqZ5g'
	        },
	        events: {
	            onReady: initialize
	        }
	    });
	}

	function initialize(){

	    // Update the controls on load
	    updateTimerDisplay();
	    updateProgressBar();

	    // Clear any old interval.
	    clearInterval(time_update_interval);

	    player.setPlaybackQuality( "hd720" );
	    // Start interval to update elapsed time display and
	    // the elapsed part of the progress bar every second.
	    time_update_interval = setInterval(function () {
	        updateTimerDisplay();
	        updateProgressBar();
	    }, 1000)

	}

	function onPlayerReady(event) {
    event.target.setPlaybackQuality('hd720');
	}

	$('#play').on('click', function () {

	    player.playVideo();

	});
	
	console.log(player.getPlaybackQuality());


	$('#q').text( player.getAvailableQualityLevels() );

	$.blockUI();

</script>
