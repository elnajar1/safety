<?php
	
	include_once $_SERVER['DOCUMENT_ROOT'] . '/safety/includes/config.php';
	include_once $_SERVER['DOCUMENT_ROOT'] . '/safety/includes/Mobile_Detect.php';
	include_once $_SERVER['DOCUMENT_ROOT'] . '/safety/includes/phone_name.php';
	$detect = new Mobile_Detect;

	echo $ua_phone_name;

	echo " isChrome : ";
	var_dump( $detect->isChrome() ) ;

	echo " isAndroid : ";
	var_dump( $detect->isAndroidOS() ) ;

	echo " isiPhone : ";
	var_dump( $detect->isiPhone() );

	echo " isMobile()	 : ";
	var_dump( $detect->isMobile() );

	$isWebWiew = strpos( $_SERVER['HTTP_USER_AGENT'] ," wv");

	if ($isWebWiew > 0 ) {
		# code...
		echo "this is webview";
	}


	echo "<pre>";

	


	var_dump( $_SERVER['HTTP_USER_AGENT'] );


?>

		<video id="vid1" class="azuremediaplayer amp-default-skin m-auto" autoplay controls width="400" min-height="" max-height="100%"  poster="poster.jpg" data-setup='{ "nativeControlsForTouch": false, "logo": { "enabled": false }  , "plugins": {"ga":{ "eventsToTrack": ["playerConfig", "loaded", "playTime", "percentsPlayed", "start", "end", "play", "pause", "error", "buffering", "fullscreen", "seek", "bitrate"], "debug": false}}}' >

	    	<source src="http://safety-usea.streaming.media.azure.net/41fb2db1-7a6f-4024-8e92-3229aee99489/Alight.ism/manifest" />
		    <p class="amp-no-js">
		        To view this video please enable JavaScript, and consider upgrading to a web browser that supports HTML5 video
		   	</p>

		</video>


		<link href="https://amp.azure.net/libs/amp/2.3.4/skins/amp-default/azuremediaplayer.min.css" rel="stylesheet">
		<script src= "https://amp.azure.net/libs/amp/2.3.4/azuremediaplayer.min.js"></script>



