<?php

	$ua = $_SERVER['HTTP_USER_AGENT'];

	$ua_arry1 = explode('(', $ua  );

	$ua_arry2 = explode(')', $ua_arry1[1] );

	$ua_arry3 = explode(';', $ua_arry2[0] );

	@$ua_arry4 = explode(' ', trim($ua_arry3[2]) );

	//echo "<pre>";
	//var_dump($ua_arry2);
	//var_dump($ua_arry3);
	//var_dump($ua_arry4 );

	@$ua_phone_name = $ua_arry4[0] ;

	if (empty($ua_phone_name)){

		@$ua_phone_name = $ua_arry3[0];

	}



