<?php
	
	// required headers
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Allow-Methods: GET");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
	header("Content-Type: application/json; charset=UTF-8");

    include "../../includes/config.php";
    $profile_user_id       = filter_var ( $_GET['id'] , FILTER_SANITIZE_NUMBER_INT ) ;
    
    //links
    $sql ="SELECT *
        FROM s_links WHERE s_links.user_id = ? AND s_links.privacy <> 'private' ORDER BY id DESC";

    /*$sql ="SELECT 
        id,user_id,playlist_id,title,description
        is_time_limited,allowed_views,start_date,end_date,privacy,time
        FROM s_links WHERE s_links.user_id = ? AND s_links.privacy <> 'private' ORDER BY id DESC";*/
    $stmt = $pdo->prepare($sql);
    $stmt->execute([ $profile_user_id ]);
    $links = $stmt->fetchall();

	// set response code - 200 OK
    http_response_code(200);
  
    // show products data in json format
    echo json_encode($links);