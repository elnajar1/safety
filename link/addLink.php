<?php

	include_once $_SERVER['DOCUMENT_ROOT'] . '/safety/includes/config.php';

	$title = filter_var($_POST['title'] , FILTER_SANITIZE_STRING );
	$description = filter_var($_POST['description'] , FILTER_SANITIZE_STRING	);
	$link = filter_var($_POST['link'] , FILTER_SANITIZE_URL );

	@$start_date = filter_var($_POST['start_date'] , FILTER_SANITIZE_STRING	);
	@$end_date = filter_var($_POST['end_date'] , FILTER_SANITIZE_STRING	);
	@$is_time_limited = filter_var($_POST['is_time_limited'] , FILTER_SANITIZE_STRING	);

	$privacy = filter_var($_POST['privacy'] , FILTER_SANITIZE_STRING	);
	$playlist_id = filter_var($_POST['playlist_id'] , FILTER_SANITIZE_NUMBER_INT	);
	$allowed_views = filter_var($_POST['allowed_views'] , FILTER_SANITIZE_NUMBER_INT	);

	


	//echo "<pre>";
	//var_dump($_POST);

	if ( !empty($link) && !empty($user_id) && !empty($playlist_id)) {
		
		$sql = "INSERT INTO s_links ( title, description,  link , start_date,  end_date , privacy , playlist_id ,allowed_views, is_time_limited, user_id) VALUES(?,?,?,?,?,?,?,?,?,?)";
		$stmt = $pdo->prepare($sql);
		$stmt->execute([ $title , $description , $link , $start_date , $end_date , $privacy , $playlist_id ,$allowed_views, $is_time_limited , $user_id] );
		$link_id = $pdo->lastInsertId();

		echo "<div class = 'alert-success p-2 m-2 text-center'>";
		echo " تم بحمد الله اضافة الفديو الي قناتك  , يمكنك الاطلاع علية من هنا ";
		echo '<a href = "'  . $domain . $root . '/link/link.php?l=' . $link_id . '" target="_blank" class="d-block">' . $domain . $root . '/link/link.php?l=' . $link_id . '</a>';
		echo "</div>";
	}

	
?>




