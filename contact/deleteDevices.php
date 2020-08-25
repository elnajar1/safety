<?php

	include '../includes/config.php';

		if (empty($user_id)) {
		header("location: ../index.php");
		exit;
	}

	include '../includes/header.php';


	$contact_id = filter_var ( $_GET['c'] , FILTER_SANITIZE_NUMBER_INT ) ;
	
	//contacts
	$sql ="SELECT * FROM s_contacts WHERE id = ? AND user_id = ?";
	$stmt = $pdo->prepare($sql);
	$stmt->execute([ $contact_id , $user_id]);
	$contact = $stmt->fetch();

	//for security ,do not allow any user to access this page exept the owner
	if ($contact['user_id'] !== $user_id ) {
		echo "Sorry, You con not access this page";
		exit;
	}

    //Delete device_name
    $sql ="UPDATE s_contact_views SET device_name = ? WHERE contact_id = ? ";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([ '' , $contact_id ]);

    echo "<h1 class = 'text-center p-5' style = 'direction : rtl ' > 
	تم تصفير الاجهزة ل  ";
    echo $contact['name'];
    echo "<h1>";
?>


<?php

	include $_SERVER['DOCUMENT_ROOT'] . '/safety/includes/footer.php';


?>

