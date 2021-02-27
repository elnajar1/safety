<?php

	//Bismi Alaah
	if( $_SERVER['HTTP_HOST'] == 'localhost:8080'){
	  
    //Database connection
	  include 'dev_connection.php';
	  
	}else{
	
	  //Database connection
	  include 'pro_connection.php';
	
    //error_reporting ( 0 ); 
    
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
 
