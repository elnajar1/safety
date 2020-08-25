<?php

	include '../includes/header.php';
	include_once '../includes/Mobile_Detect.php';
	include_once '../includes/phone_name.php';
	$detect = new Mobile_Detect;

	$profile_user_id       = filter_var ( $_GET['u'] , FILTER_SANITIZE_NUMBER_INT ) ;

	$sql ="SELECT * FROM s_users WHERE id = ? ";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([ $profile_user_id ]);
    $user = $stmt->fetch();
    
    if(isset($user['name'])){
    	$profile_user_name =$user['name'] ;
    }else{
    	$profile_user_name =$user['fb_name'] ;
    }
    
    if(isset($user['avatar'])){
    	$profile_user_avatar = $root .  "/uploads/avatars/"  . $user['avatar'] ;
    }elseif( isset( $user['fb_avatar'] )){
    	$profile_user_avatar = $user['fb_avatar'] ;
    }else{
    	$profile_user_avatar = $root .  "/layout/img/user.jpeg" ;
    } 

	//links
    if (  ($profile_user_id == 1) || ($profile_user_id == 3)  ) {

    	$sql ="SELECT * FROM s_links WHERE s_links.user_id = ? AND s_links.privacy <> 'private' AND s_links.temp_show = 1 ORDER BY id DESC";
		$stmt = $pdo->prepare($sql);
		$stmt->execute([ $profile_user_id ]);
		$links = $stmt->fetchall();

    }else{
    	$sql ="SELECT * FROM s_links WHERE s_links.user_id = ? AND s_links.privacy <> 'private' ORDER BY id DESC";
		$stmt = $pdo->prepare($sql);
		$stmt->execute([ $profile_user_id ]);
		$links = $stmt->fetchall();

    }

	//var_dump($links);

?>

<div class="container" >

	<div class="row">

		<div class="col m-auto">
			
		</div>

	</div>

</div>


<?php

	include '../includes/footer.php';


?>

