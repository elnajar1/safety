<?php
	
	// required headers
	header("Access-Control-Allow-Origin: *");
	header("Access-Control-Allow-Methods: POST");
	header("Access-Control-Allow-Methods: GET");
	header("Access-Control-Max-Age: 3600");
	header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
	header("Content-Type: application/json; charset=UTF-8");
	
	include $_SERVER['DOCUMENT_ROOT'] . '/safety/includes/config.php';

	$playlist_id = filter_var ( $_GET['id'] , FILTER_SANITIZE_NUMBER_INT ) ;
	
	//playlists videos 
	$sql ="SELECT 
		id,user_id,playlist_id,title,description
	    is_time_limited,allowed_views,start_date,end_date,privacy,time
		FROM s_links WHERE playlist_id = ? AND s_links.privacy <> 'private' ORDER BY id DESC";
	$stmt = $pdo->prepare($sql);
	$stmt->execute([ $playlist_id ]);
	$links = $stmt->fetchall();
	
	// set response code - 200 OK
	http_response_code(200);
	
	echo json_encode(array_filter($links));