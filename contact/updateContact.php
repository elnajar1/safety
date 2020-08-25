<?php

	include '../includes/config.php';

	$contact_id = filter_var($_POST['id'] , FILTER_SANITIZE_NUMBER_INT );
	$name = filter_var($_POST['name'] , FILTER_SANITIZE_STRING );
	$phone = filter_var($_POST['phone'] , FILTER_SANITIZE_STRING	);
	$note = filter_var($_POST['note'] , FILTER_SANITIZE_STRING );

	$playlists = filter_var($_POST['playlists'] , FILTER_SANITIZE_STRING);
	$playlists_array = explode(',', $playlists ); 

	$paid = $_POST['paid'];
	
	if ( @$_POST['status'] == "on") {
		
		$status = 0;

	}else{

		$status = 1;

	}
	


	//echo "<pre>";
	//var_dump($_POST);

	//echo "<hr>paid : <hr> ";
	//var_dump($paid);

	if ( !empty($name) && !empty($user_id && !empty($phone) ) ) {
		
		//update s_contacts (basic info)
		$sql = "UPDATE s_contacts SET  name = ? , phone = ? ,  note = ?  , status = ? , user_id = ? WHERE s_contacts.id = ? ";
		$stmt = $pdo->prepare($sql);
		$stmt->execute([ $name , $phone , $note ,$status , $user_id , $contact_id ] );

		//delete all playlists to insert them again with updats
		$sql = "DELETE FROM s_contact_playlists WHERE contact_id = ?";
		$stmt = $pdo->prepare($sql);
		$stmt->execute([ $contact_id ] );

		//insert them again with updats
		$i = 0;
		foreach ( $playlists_array as $playlist ) {

			$sql = "INSERT INTO s_contact_playlists ( contact_id, playlist_id , paid , pay_method ) VALUES(?,?,?,?)";
			$stmt = $pdo->prepare($sql);
			$stmt->execute([ $contact_id ,$playlist, $paid[$i] , "user"] );
			$i++;

		}

		echo "<div class = 'alert-success p-2 m-2 text-center'>";
		echo "تم  الحمدلله  التعديل ";
		echo "</div>";
	}


?>




