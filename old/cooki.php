<?php
	
	include_once $_SERVER['DOCUMENT_ROOT'] . '/safety/includes/config.php';
	include_once $_SERVER['DOCUMENT_ROOT'] . '/safety/includes/Mobile_Detect.php';
	include_once $_SERVER['DOCUMENT_ROOT'] . '/safety/includes/phone_name.php';
	$detect = new Mobile_Detect;
	$link_id = 33;

	setcookie($link_id, "alive", time()+10800); // 1hr = 3600 secs

	if( !isset($_COOKIE[$link_id]) ){

		echo "no set";

	}else{
		echo "set";
		echo $_COOKIE[$link_id];
	}
	

?>
