<?php

	include $_SERVER['DOCUMENT_ROOT'] . '/safety/includes/header.php';
	include_once $_SERVER['DOCUMENT_ROOT'] . '/safety/includes/Mobile_Detect.php';
	include_once $_SERVER['DOCUMENT_ROOT'] . '/safety/includes/phone_name.php';
	$detect = new Mobile_Detect;

	$link_id       = filter_var ( $_GET['l'] , FILTER_SANITIZE_NUMBER_INT ) ;
	@$source       = filter_var ( $_GET['s'] , FILTER_SANITIZE_STRING ) ;

	//link_info
	$sql ="SELECT s_links.* , s_playlists.id , s_playlists.name FROM s_links LEFT JOIN s_playlists ON s_playlists.id = s_links.playlist_id 
			WHERE s_links.id = ? ";
	$stmt = $pdo->prepare($sql);
	$stmt->execute([ $link_id   ]);
	$link = $stmt->fetch();

	//حاسب   متتلخبطش 
	if(  $source  !== "app" ){
		
		include 'app/app.php'; 	
		exit;
	}

	$user_id = $link['user_id'] ;	



	//echo "<pre>";
	//var_dump($link);

	//check if he dosent use chrome or he use webview in android
	$isWebWiew = strpos( $_SERVER['HTTP_USER_AGENT'] ," wv");
	
	//check if link is betwen start and end date
	$currentDate = date('Y-m-d H:i:s');
	$currentDate = date('Y-m-d H:i:s', strtotime($currentDate));
	//echo $currentDate;

	$start_date = date('Y-m-d H:i:s A', strtotime($link['start_date']) );
	//echo $start_date;

	$end_date = date('Y-m-d H:i:s A', strtotime($link['end_date']) );
	//echo $end_date;

	//site_info
	$sql ="SELECT * FROM s_sittings";
	$stmt = $pdo->prepare($sql);
	$stmt->execute();
	$s_sittings = $stmt->fetchall();


?>
<div class="container-fluid" style="direction: rtl;min-height: 100vh;">

	<div class="row">

		<div class="col-12 p-0">

			<?php if ( $link['privacy'] == "private"): ?>

				<div class="bg-gradient rounded m-1 py-3">
					<img src="https://img.icons8.com/cute-clipart/64/000000/lock.png" class="d-block m-auto" />
					<p class="text-center text-white">
						هذا الفديو خاص 
					<p>


				</div>

			<?php

			else:

				//time is betwen limeted time (Ashta)
				if ( ( ($currentDate >= $start_date) && ($currentDate <= $end_date) ) || $link['is_time_limited'] !== "on"): 

					?>
						<!-- main video container -->
						<div id="firebaseui-big-container"  style ="display: none;" class="p-0 py-2">

							<div class="text-right"  >
								
								<div  class="text-center">
									<img src="https://img.icons8.com/ultraviolet/40/000000/front-gate-closed.png"  />
									<img src="https://img.icons8.com/ultraviolet/40/000000/uk-police-officer--v2.png"   />
								</div>
								
								<ul>
									<li>
										1 - للمتابعه الي الفديو  , قم بادخال رقم هاتفك 
									</li>
									<li>
										2 - اضغط علي  "أنا لست برنامج روبوت"
									</li>
									<li>
										3 - اضغط  علي  "إثبات الملكية"
									</li>
								</ul>
							</div>

							<div id="firebaseui-auth-container"></div>

						</div>
						
						<div id="data-container">
							<div class="my-3 d-flex justify-content-center text-primary">
							  <div class="spinner-border" role="status">
							    <span class="sr-only">Loading...</span>
							  </div>
							</div>
						</div> 
						<!-- /main video container -->

				<?php else: ?>

			    	<div class="alert alert-warning text-center py-3">	
			    		<img src="https://img.icons8.com/cotton/64/000000/time.png"/>

			    		<p>
			    			الفديو  غير متاح 
			    		</p>
			    		<small class="text-muted" style="direction: rtl">

			    			هذا الفديو  متاح فقط  من  تاريخ
		    				<br>
		    				<?= date( 'l jS \of F Y h:i A' , strtotime($link['start_date']) ) ?>
		    				<br>
		    				الي
		    				<br>
		    				<?= date( 'l jS \of F Y h:i A' , strtotime($link['end_date']) ) ?>

			    		</small>
			    	</div>

				<?php endif; ?>

			<?php endif; ?>

		</div>

		<!-- video info -->
		<div class="col-12 col-sm-4">
			
			<div class="text-right text-dark ">
				<h1 class="">
					<?= $link['title'] ?>
				</h1>

				<small class="text-muted p-0">
					الوصف
				</small>
				
				<p class="text-muted">
					<?= $link['name'] ?> . 
					<?= $link['description'] ?>

					
					<?php if (  $link['is_time_limited'] == "on" ): ?>
					<small class="text-muted d-block" style="direction: rtl; font-size: 16px;">
		    			متاح من 
	    				<?= date( 'M/d h:i A' , strtotime($link['start_date']) ) ?>
	    				الي
	    				<?= date( 'M/d h:i A' , strtotime($link['end_date']) ) ?>
	    			</small>
	    			<?php endif; ?>

				</p>

				<div id= "firebase-sign-out-container" style="display: none;">
				<button id="firebase-sign-out" class="btn btn-block btn-sm btn-secondary m-2 z-depth-0 d-block">سجل  الدخول برقم اخر  </button>

			</div>

			</div>

			<?php if( !empty( $s_sittings[1]['value']) ): ?>
			<!-- whats_new  -->
			<div class="col-12 alert alert-info text-right border border-primary" >
				
				<div class="row">
					<div class="col">
						<p class="text-dark">
							ما الجديد !
						</p>	
					</div>
					
					<div class="col-2">
						<img src="https://img.icons8.com/ultraviolet/40/000000/idea.png" class="d-block m-auto" />
					</div>	
				</div>

				<div class="row">
					<div class="col-12">
						
						<?= $s_sittings[1]['value'] ?>

					</div>
				</div>

			</div><!-- /whats_new  -->

		</div><!-- /video info -->

		<!-- Warrning -->
		<div class="col-12">

			<small class = "d-block text-muted text-right">
				يسمح فقط  لاشخاص  المسجل ارقام هواتفهم من قبل ناشر الفديو بالمشاهدة 

				<small class = "text-secondary">
					, ولا  يجوز  
				</small>
				مشاهدة الفديو بدون اذن الناشر 
			</small>
		</div>
		<!-- /Warrning -->

		<?php endif; ?>


	</div>	


</div>

<?php

	include $_SERVER['DOCUMENT_ROOT'] . '/safety/includes/footer.php';


?>

