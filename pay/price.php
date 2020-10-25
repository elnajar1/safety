<?php

	include $_SERVER['DOCUMENT_ROOT'] . '/safety/includes/config.php';

	//get phone
	$playlist_array = implode(" , ", $_POST['playlist_array']) ;

	if ( empty($playlist_array[0]) ) {
		echo 0;
	}else{
		// SUM(cost)
		$sql = "SELECT SUM(cost) FROM  s_playlists  
				WHERE id IN ( $playlist_array )";
		$stmt = $pdo->prepare($sql);
		$stmt->execute([]);
		$price = $stmt->fetchall();
		
		echo $price[0][0];
	}