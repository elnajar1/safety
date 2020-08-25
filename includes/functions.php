<?php

	//Bismi Alaah
	function get_youtube_id( $url ){

	  preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $match);
	  
	  return $match[1];

	 }