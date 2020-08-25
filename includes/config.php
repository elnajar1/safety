<?php

	//Bismi Alaah
	if( $_SERVER['HTTP_HOST'] == 'freshweb.tech'){

		include 'fw_connection.php';
		$domain = "https://" . $_SERVER['HTTP_HOST'];
		error_reporting ( 0 );

	}else{

		include 'connection.php';
		$domain = "http://" . $_SERVER['HTTP_HOST'];
	}
	
	//roots &  directorys
	$root = "/safety";
	$GLOBALS['root'] = $root;
	$GLOBALS['domain'] = $domain;
	$ip = $_SERVER['REMOTE_ADDR']; 
	$GLOBALS['ip'] = $ip;

	//includes
	include 'server.php';
	
	
	//echo "<pre>";
	//var_dump($_SERVER['HTTP_REFERER']) ;
	//echo "</pre>";
	date_default_timezone_set('Africa/Cairo');	
 