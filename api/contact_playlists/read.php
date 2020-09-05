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
	$sql ="SELECT * FROM s_contacts WHERE s_contacts.phone = ? ";
	$stmt = $pdo->prepare($sql);
	$stmt->execute([  $contact_phone ]);
	$contact = $stmt->fetchall();
	

	$playlists = [];

	//his playlists 
	foreach ($contact as $c) {
		//foreach ( beacuse one contact my have playlists on many teachers so on phone number have many ids ( he may be susseccerbide in many courses ) )
		$sql ="SELECT * FROM s_contact_playlists 
			LEFT JOIN s_playlists ON s_playlists.id = s_contact_playlists.playlist_id
			WHERE contact_id = ?";
		$stmt = $pdo->prepare($sql);
		$stmt->execute([ $c['id'] ]);
		$playlists[] = $stmt->fetchall();
	}


	
	// set response code - 200 OK
	http_response_code(200);
	
	echo json_encode(array_filter($playlists));