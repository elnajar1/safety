<?php

	include $_SERVER['DOCUMENT_ROOT'] . '/safety/includes/header.php';
	//include 'includes/app_alert.php';
	include_once $_SERVER['DOCUMENT_ROOT'] . '/safety/includes/Mobile_Detect.php';
	include_once $_SERVER['DOCUMENT_ROOT'] . '/safety/includes/phone_name.php';
	$detect = new Mobile_Detect;

	$link_id       = filter_var ( $_GET['l'] , FILTER_SANITIZE_NUMBER_INT ) ;

	//link_info
	$sql ="SELECT s_links.* , s_playlists.id , s_playlists.name FROM s_links LEFT JOIN s_playlists ON s_playlists.id = s_links.playlist_id 
			WHERE s_links.id = ? ";
	$stmt = $pdo->prepare($sql);
	$stmt->execute([ $link_id   ]);
	$link = $stmt->fetch();

	$link_user_id = $link['user_id'] ;	

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

<div class="container" style="direction: rtl;">

	<div class="row">


		<div class="col">

			<?php if ( $link['privacy'] == "private"): ?>

				<div class="bg-gradient rounded m-1 py-3">
					<img src="https://img.icons8.com/cute-clipart/64/000000/lock.png" class="d-block m-auto" />
					<p class="text-center text-white">
						هذا الفديو خاص 
					<p>


				</div>

			<?php

			else:

				if ( ( ($currentDate >= $start_date) && ($currentDate <= $end_date) ) || $link['is_time_limited'] !== "on"): 

					//check if he THE ADMIN
					if( @$user_id == $link['user_id'] ): 
					
				?>		
						<link rel="stylesheet" href="https://cdn.plyr.io/3.6.2/plyr.css" />
						<style type="text/css">
							
							.plyr{
								height: auto;
							}

						</style>


						<div id="player" class="plyr__video-embed" data-plyr-provider="youtube" data-plyr-embed-id="plyr.php?l=<?= $link['link'] ?>"></div>


						<script src="/safety/layout/plyr/demo.js"></script>

						<div class = "alert alert-warning">
							<p class = "text-center">
								انت فقط من يمكنه الدخول الي هذه الصفحة بدون تاكيد رقم الهاتف , يحتاج  المشتركين الي ادخال وتاكيد رقم هاتفهم قبل الدخول الي هذه الصفحة  , و لا يسمح الا للاشخاص الذين تم تسجيلهم من قبلك بمشاهدة الفديو  , اشطا  ؟ 
							</p>
						</div>

				<?php elseif( $link['temp_show'] == "0" ): ?>

					<div class = "border m-2 p-2 z-depth-1" style="direction: ltr">

						<p class="text-center bg-white rounded border p-2" style="direction: rtl">
							يلزم تثبيت التطبيق لتجربة مشاهدة اروع واسهل  و  انتعش كدا 
							<i class="fas fa-heart text-danger "></i>
						</p>
						<?php include 'app.php'; ?>

					</div>

				<?php else: ?>

						<div id="allow-mic-container" style="display: none;">
							<div class="alert  bg-gradient m-1 py-5 text-center">
								
								<span class="text-white" style="font-size: 70px">
									<i class="fas fa-microphone"></i>	
								</span>

								<p id="allow-mic-error-container" class="alert alert-warning p-0 "></p>

								<p class="text-white">
									من فضلك قم بالسماح للموقع باستخدام الميكروفون 
								</p>
								
								<button id="start" class="btn btn-secondary rounded" style="font-size: 20px">
									السماح 
								</button>
							</div>
						</div>

						<?php 
							//if use iphone , tell hem it doesn't suported yet
							//if( $detect->isiOS() ): 
							if( 1 == 2 ):

						?>

							<div class="bg-gradient rounded m-1 p-1">
								<img src="https://img.icons8.com/cute-clipart/64/000000/sad.png" class="d-block m-auto" />
								<p class="text-center text-white">
									عُذرًا , اجهزة  الايفون غير مدعومة حاليا 
								<p>
								<small class="text-center text-white d-block" style="font-size: 16px">
									نحن  نسعي جاهدون  لكي نوفر الدعم للكل الاجهزة عما قريب ان شاء الله
								</small>
							</div>

						<?php endif; ?>

						<!-- main video container -->
						<div id="data-container">
						</div>

						<div id="firebaseui-big-container"  style ="display: none;" class="alert alert-info p-0 py-2 border">

							<div class="text-right">
								
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

						</div><!-- /main video container -->

						<!-- main video container -->

						<?php /* 
						<div class = "border-tob" style="direction: ltr">

						<p class="text-center bg-white rounded border p-2" style="direction: rtl">
							لتجربة مشاهدة اروع  ان شاء الله
							<i class="fas fa-heart text-danger "></i>
						</p>
						<?php include 'app.php'; ?>
 						*/ ?>
					</div><!-- /main video container -->

					<?php endif; ?>

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

		</div><!-- /col -->

		<!-- video info -->
		<div class="col-12 col-sm-4">

			<div id= "firebase-sign-out-container" style="display: none;">
				<button id="firebase-sign-out" class="btn btn-sm btn-secondary rounded z-depth-0 d-block">سجل  الدخول برقم اخر  </button>
			</div>
			
			<div class="text-right text-dark alert alert-info">
				<small class="text-muted p-0">
					العنوان
				</small>
				<p class="">
					<?= $link['title'] ?>
				</p>

				<small class="text-muted p-0">
					الوصف
				</small>
				
				<p>
					<?= $link['name'] ?>
				</p>
				
				<p class="">
					<?= $link['description'] ?>

					
					<?php if (  $link['is_time_limited'] == "on" ): ?>
					<small class="text-muted d-block" style="direction: rtl; font-size: 16px;">
		    			متاح من 
	    				<?= date( 'M/d h:i A' , strtotime($link['start_date']) ) ?>
	    				الي
	    				<?= date( 'M/d h:i A' , strtotime($link['end_date']) ) ?>
	    			</small>
	    			<?php endif; ?>

					<small class =" d-block">
					<a href ="https://freshweb.tech/safety/profile/?u=<?=  $link_user_id ?>">
					 
					عرض كل فديوهات القناة >>

					</a>
					</small>
				</p>
			</div>

			<?php if( !empty( $s_sittings[1]['value']) ): ?>
			<!-- whats_new col -->
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

			</div><!-- /whats_new col -->
		</div><!-- /video info -->
		<?php endif; ?>

		<!-- recorder col -->
		<div class="col-12">

		</div><!-- /recorder col -->

	</div>	


</div>

<?php

	include $_SERVER['DOCUMENT_ROOT'] . '/safety/includes/footer.php';

?>

<!-- app alert -->
<script type="text/javascript">
	$('#app_alert').modal('show');
</script>
<!-- End of app alert  -->