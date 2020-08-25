<?php

	session_start(); // Start The Session

	session_unset(); // Unset The Data

	session_destroy(); // Destory The Session
	
	setcookie("safety", null  , time() /  1987654321);
	
	unset($_COOKIE['safety']);
	
	header('Location: /safety/index.php');

	exit();
