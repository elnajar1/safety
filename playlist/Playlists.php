<?php
	

	include '../includes/config.php';

	if (empty($user_id)) {
		header("location: ../index.php");
		exit;
	}
	
	include '../includes/header.php';
	include_once '../includes/Mobile_Detect.php';
	include_once '../includes/phone_name.php';
	$detect = new Mobile_Detect;

	//if posted data fron createPlaylist.php
	if (isset($_POST['create_playlist'])) {
		$name = filter_var($_POST['name'] , FILTER_SANITIZE_STRING );
		$cost = filter_var($_POST['cost'] , FILTER_SANITIZE_NUMBER_INT );

		if ( !empty($name) && !empty($user_id)  && !empty($cost) ) {
		
			$sql = "INSERT INTO s_playlists ( user_id , name , cost ) VALUES(?,?,?)";
			$stmt = $pdo->prepare($sql);
			$stmt->execute([$user_id , $name, $cost] );

			header("location: playlists.php?success=1");
		}
	}

	//if playlist successfuly created
	if ( @$_GET['success'] ) {
		echo '<div class = "alert alert-success py-3 p-2 text-center" style = "direction: rtl"><i class="far fa-check-circle"></i>';
		echo ' تم  انشاء قائمة التشغيل بحمد الله بنجاح  , الان يمكنك اضافة فديوهات من  ';
		echo "<a href = '/safety/link/createLink.php'> هنا  </a> ";
		echo "  الي قائمة التشغيل هذة ";
		echo '</div>';
	}

	//playlists
	$sql ="SELECT * FROM s_playlists WHERE user_id = ? ORDER BY id DESC";
	$stmt = $pdo->prepare($sql);
	$stmt->execute([ $user_id ]);
	$playlists = $stmt->fetchall();
	$count_playlists = $stmt->rowCount();

?>

<div class="container text-right" style = "direction: rtl">

	<div class="row">
		<div class="col">
			
			<h1 class="font-weight-bold text-secondary">
				 الدورات   الخاصة بك 

				<a href="createPlaylist.php" class="btn btn-sm btn-outline-secondary z-depth-0">
					انشاء   الدورات التعليمية جديدة 
				</a>
			</h1>
			
		</div>
	</div>

	<div class="row">
		<div class="col">
			<?php if( $count_playlists == 0 ): ?>
				<div class="py-5 text-center text-muted">
					<h3>
						قم بانشاء قائمة جديدة 
						<a href="/safety/playlist/createPlaylist.php"> من هنا </a>
					</h3>
				</div>
			<?php endif; ?>
		</div>
	</div>

	<div class=" row">

		<div class="col">
			
			<?php foreach ($playlists as $playlist ): 
				//links
				$sql ="SELECT * FROM s_links WHERE s_links.user_id = ? AND playlist_id = ? ORDER BY id DESC";
				$stmt = $pdo->prepare($sql);
				$stmt->execute([ $user_id , $playlist['id'] ]);
				$links = $stmt->fetchall();
			?>
				<div class="card m-2">
					
					<div class="card-header">
						<p > 
							<i class="fas fa-list-alt text-muted"></i> 
							<?= $playlist['name'] ?>
							<span class="float-left text-success">
								<?= $playlist['cost'] ?> 
								جنية 
							</span>
						</p>
					</div>

					
					<ul class="list-group list-group-flush">

						<?php foreach ($links as $link ): ?>

						
						<li class="list-group-item">
							
							<a href = "<?= $domain . $root . '/link/link.php?l=' . $link['id'] ?>" class= "text-dark">

								<i class="fa fa-video text-secondary p-1"></i>
								
								<?= $link['title'] ?>
								
								<?php if( $link['privacy'] == "private" ):  ?>
					              <span class="badge badge-danger z-depth-0 rounded">
					                <i class="fas fa-lock"></i> 
					              </span>
					            <?php endif; ?>

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

