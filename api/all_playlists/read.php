<?php
	
	// required headers
	header("Access-Control-Allow-Origin: *");
	header("Access-Control-Allow-Methods: POST");
	header("Access-Control-Allow-Methods: GET");
	header("Access-Control-Max-Age: 3600");
	header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
	header("Content-Type: application/json; charset=UTF-8");
	
	include $_SERVER['DOCUMENT_ROOT'] . '/safety/includes/config.php';

	$contact_phone = '+' . filter_var ( $_GET['p'] , FILTER_SANITIZE_NUMBER_INT ) ;
	
	//contact info
	$sql ="SELECT * FROM s_playlists ORDER BY id DESC";
	$stmt = $pdo->prepare($sql);
	$stmt->execute([   ]);
	$playlists = $stmt->fetchall();
	

	
	// set response code - 200 OK
	http_response_code(200);
	
	echo json_encode(array_filter($playlists));