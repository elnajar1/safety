<?php
	
	include_once $_SERVER['DOCUMENT_ROOT'] . '/safety/includes/config.php';
	include_once $_SERVER['DOCUMENT_ROOT'] . '/safety/includes/Mobile_Detect.php';
	include_once $_SERVER['DOCUMENT_ROOT'] . '/safety/includes/phone_name.php';
	$detect = new Mobile_Detect;

	$link_id       = filter_var ( $_POST['l_id'] , FILTER_SANITIZE_NUMBER_INT ) ;
	$contact_id= filter_var ( $_POST['c_id'] , FILTER_SANITIZE_NUMBER_INT ) ;
	$is_phone       = filter_var ( $_POST['is_phone'] , FILTER_SANITIZE_STRING ) ;
	$is_pc = filter_var ( $_POST['is_pc'] , FILTER_SANITIZE_STRING ) ;
	
	if( !isset($_COOKIE[$link_id]) ){

		if( $is_phone == "true" ){
		$sql = "UPDATE s_contact_views SET phone_visits = phone_visits + 1 WHERE  s_contact_views.link_id = ? AND s_contact_views.contact_id = ?";
		$stmt = $pdo->prepare($sql);
		$stmt->execute([ $link_id , $contact_id ] );
		}

		if( $is_pc == "true" ){
		$sql = "UPDATE s_contact_views SET pc_visits = pc_visits + 1 WHERE  s_contact_views.link_id = ? AND s_contact_views.contact_id = ?";
		$stmt = $pdo->prepare($sql);
		$stmt->execute([ $link_id , $contact_id ] );
		}

		setcookie($link_id, "alive", time()+86400); // 1hr = 3600 secs
		//echo "done";

	}
	

?>
