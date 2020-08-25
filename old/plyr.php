<?php
	
	include_once $_SERVER['DOCUMENT_ROOT'] . '/safety/includes/config.php';
	$link_id  = filter_var ( $_GET['l'] , FILTER_SANITIZE_NUMBER_INT ) / 365 ;

	//echo $link_id ;

	//link info
	$sql ="SELECT * FROM s_links WHERE id = ? ";
	$stmt = $pdo->prepare($sql);
	$stmt->execute([ $link_id ]);
	$link = $stmt->fetch();
	
	header("location: " . $link['link']);
?> 

<?php
