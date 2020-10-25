<?php

	include '../includes/header.php';
	include_once '../includes/Mobile_Detect.php';
	include_once '../includes/phone_name.php';
	$detect = new Mobile_Detect;

	//filter_var($_POST['name'] , FILTER_SANITIZE_STRING )
	//filter_var ( $_GET['c'] , FILTER_SANITIZE_NUMBER_INT ) ;
	
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
	$sql ="SELECT * FROM s_playlists WHERE user_id = ? ORDER BY id DESC";
	$stmt = $pdo->prepare($sql);
	$stmt->execute([ $profile_user_id ]);
	$playlists = $stmt->fetchall();

    
	//links
	$sql ="SELECT * FROM s_links WHERE s_links.user_id = ? AND s_links.privacy <> 'private' ORDER BY id DESC";
	$stmt = $pdo->prepare($sql);
	$stmt->execute([ $profile_user_id ]);
	$links = $stmt->fetchall();

    
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

	<div class=" row p-0">

		<div class="col-12 m-1">
			<p class="d-inline-block">
				شاارك القناة 
				<span class="d-none d-md-inline">
					مع اصدقائك والطلاب 
				</span>
			</p>

            <!-- Go to www.addthis.com/dashboard to customize your tools -->
            <div class="addthis_inline_share_toolbox d-inline-block float-left"></div>
        	
		</div> 
		
	</div>

	<div class=" row bg-muted p-0">

		<div class="col-12 my-3">
			<h1 class="font-weight-blod">
				الفديوهات 
			</h1>
			<small class="text-muted">
				* تسمح   المشاهدة فقط   للاشخاص   المسجلين  بواسطة ناشر الفديوهات  او الذين قاموا بالاشتراك من خلال هذة الصفحة 
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
						<p > 
							<i class="fas fa-list-alt text-muted"></i> 
							<?= $playlist['name'] ?>
							
							<span class="float-left d-inline">
								
								<span class=" text-success">
									<?= $playlist['cost'] ?> 
									جنية 
								</span>
								<a href="/safety/pay/?playlist_id=<?= $playlist['id'] ?>" class="btn btn-outline-primary z-depth-0 rounded py-1">
									
									<?php if ( $playlist['cost'] == 0 ): ?>	
									
										الاشتراك مجانا 
									
									<?php else: ?>

										شراء 

									<?php endif; ?>
								
								</a>
							
							</span>
						</p>
					</div>

					<ul class="list-group list-group-flush">

						<?php foreach ($links as $link ): ?>

						
						<li class="list-group-item">
							
							<a href = "<?= $domain . $root . '/link/link.php?l=' . $link['id'] ?>" class= "text-dark">

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

