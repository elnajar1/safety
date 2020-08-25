<?php

	include '../includes/config.php';

	echo "<pre>";
	var_dump($_POST);
	$name = filter_var($_POST['name'] , FILTER_SANITIZE_STRING );
	$phone = filter_var($_POST['phone'] , FILTER_SANITIZE_STRING);
	$note = filter_var($_POST['note'] , FILTER_SANITIZE_STRING );

	$playlists = filter_var($_POST['playlists'] , FILTER_SANITIZE_STRING);
	$playlists_array = explode(',', $playlists ); 

	$paid = $_POST['paid'];

	/*
	//remove all empty value
	$paid_no_empty = array_filter($paid, fn($value) => !is_null($value) && $value !== '');
	//to rest [value] arangement
	$paid_str = implode(",", $paid_no_empty );
	$paid_array = explode(",", $paid_str);
	*/

	echo "<pre>";
	var_dump($_POST);
	
	echo "<hr>paid : <hr> ";
	var_dump($paid);
	
	if ( !empty($name) && !empty($user_id)  && !empty($phone) ) {
		
		$sql = "INSERT INTO s_contacts ( name, phone , note ,user_id) VALUES(?,?,?,?)";
		$stmt = $pdo->prepare($sql);
		$stmt->execute([ $name , $phone , $note  ,$user_id] );
		$contact_id = $pdo->lastInsertId();

		$i = 0;
		foreach ( $playlists_array as $playlist ) {

			$sql = "INSERT INTO s_contact_playlists ( contact_id, playlist_id , paid , pay_method ) VALUES(?,?,?,?)";
			$stmt = $pdo->prepare($sql);
			$stmt->execute([ $contact_id ,$playlist, $paid[$i] , "user"] );
			$i++;

		}

		echo '<tr class = "bg-info">';
		echo '<th scope="row"> # </th>';
		echo '<td class="dots">'  . $name  . '</td>';
		echo '<td class="dots">'  . $phone . '</td>';
		echo '<td class="dots">'  . $note  . '</td>';
		echo '</tr>';
	}

	
?>




