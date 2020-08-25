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


	//playlists
	$sql ="SELECT * FROM s_playlists WHERE user_id = ? ORDER BY id DESC";
	$stmt = $pdo->prepare($sql);
	$stmt->execute([ $profile_user_id ]);
	$playlists = $stmt->fetchall();

    
	//links
	/*
	$sql ="SELECT * FROM s_links WHERE s_links.user_id = ? AND s_links.privacy <> 'private' ORDER BY id DESC";
	$stmt = $pdo->prepare($sql);
	$stmt->execute([ $profile_user_id ]);
	$links = $stmt->fetchall();
    */
	//var_dump($playlists);

?>

<div class="container-fluid text-right" style="direction: rtl;">

	<div class="row bg-gradent-animated" style ="height: 50vh;">

		<div class="col m-auto">
			<img src="<?= $profile_user_avatar ?>" style="max-width: 150px;" class="border rounded z-depth-5 rainbow d-block m-auto"/>
			<h1 class="display-3 text-center text-white mx-auto m-3 p-2 ">
				<?= $profile_user_name ?>
			</h1>
		</div>

	</div>

	<div class=" row bg-muted p-0">

		<div class="col-12 my-3">
			<h1 class="font-weight-blod">
				الفديوهات 
			</h1>
			<small class="text-muted">
				* يسمح  فقط الاشخاص المسجلين  بواسطة ناشر الفديوهات بالمشاهدة 
			</small>
		</div> 
		
	</div>


	<div class=" row bg-muted">

		<div class="col">
			
			<?php foreach ($playlists as $playlist ): 
				//links
				$sql ="SELECT * FROM s_links WHERE s_links.user_id = ? AND s_links.privacy <> 'private' AND playlist_id = ? ORDER BY id DESC";
				$stmt = $pdo->prepare($sql);
				$stmt->execute([ $profile_user_id , $playlist['id'] ]);
				$links = $stmt->fetchall();
			?>
				<div class="card m-2">
					
					<div class="card-header">
						<i class="fas fa-list-alt text-muted"></i> 
						<?= $playlist['name'] ?>
					</div>

					<ul class="list-group list-group-flush">

						<?php foreach ($links as $link ): ?>

						
						<li class="list-group-item">
							
							<a href = "<?= $domain . $root . '/link.php?l=' . $link['id'] ?>" class= "text-dark">

								<i class="fa fa-video text-secondary p-1"></i>
								
								<?= $link['title'] ?>
								
								<?php
		        					$link_date = date('Y-m-d' , strtotime($link['time']) );
		        					if($link_date == date('Y-m-d') )  {
									   echo '<span class="badge badge-danger text-dark z-depth-1"> جديد </span>';
									}
		        				?>

		        				<?php if( $link['is_time_limited'] == "on" ):  ?>
					            	<span class="badge badge-primary z-depth-0" style="font-size: 10px">
					            		<i class="far fa-clock"></i> 
					                	محدد بوقت 
					           		</span>
					            <?php endif; ?>

	        				</a>
						</li>			

						<?php endforeach; ?>
					
					</ul>

				</div>
			<?php endforeach; ?>
		
		</div>
		
	</div>

</div>


<?php

	include '../includes/footer.php';


?>

