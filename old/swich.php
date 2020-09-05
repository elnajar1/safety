<?php
	
	session_start();
	 $_SESSION['user_id'] = $_GET['u'];

	// echo  $_GET['u'];
    //swich acount 
    header('location: dashboard.php');
