<?php
	
	// required headers
	header("Access-Control-Allow-Origin: *");
	header("Content-Type: application/json; charset=UTF-8");

	include "../../includes/config.php";

	$sql ="SELECT id , name , phone , avatar , time FROM s_users";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([]);
    $users = $stmt->fetchAll();
    
	// set response code - 200 OK
    http_response_code(200);
  
    // show products data in json format
    echo json_encode($users);