<?php
	
	// required headers
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Allow-Methods: GET");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
	header("Content-Type: application/json; charset=UTF-8");

    include "../../includes/config.php";
    $user_id       = filter_var ( $_GET['id'] , FILTER_SANITIZE_NUMBER_INT ) ;
    
    //user_info

    $sql ="SELECT s_users.name , s_users.email , s_users.phone ,s_users.avatar FROM s_users WHERE id =  ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([ $user_id ]);
    $user = $stmt->fetch();

    
	// set response code - 200 OK
    http_response_code(200);
  
    // show products data in json format
    echo json_encode($user);