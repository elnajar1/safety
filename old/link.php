<?php

	include $_SERVER['DOCUMENT_ROOT'] . '/safety/includes/header.php';
	include_once $_SERVER['DOCUMENT_ROOT'] . '/safety/includes/Mobile_Detect.php';
	include_once $_SERVER['DOCUMENT_ROOT'] . '/safety/includes/phone_name.php';
	$detect = new Mobile_Detect;

	$user_id       = filter_var ( $_GET['u'] , FILTER_SANITIZE_NUMBER_INT ) ; 
	$link_id       = filter_var ( $_GET['l'] , FILTER_SANITIZE_NUMBER_INT ) ;

	$sql ="SELECT * FROM s_links WHERE s_links.user_id = ? AND id = ? ";
	$stmt = $pdo->prepare($sql);
	$stmt->execute([ $user_id , $link_id   ]);
	$link = $stmt->fetch();
	
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


?>
<div class="container" style="direction: rtl;">

	<div class="row">


		<div class="col">

			<?php if ( ($currentDate >= $start_date) && ($currentDate <= $end_date) ): ?>
				
				<?php 

					if( $detect->isAndroidOS() && $detect->isChrome() == false &&  $isWebWiew > 0 ): 
					//if( 1 == 2 ): 

				?>

					<div class="bg-gradient rounded m-1 py-3">
						<img src="https://img.icons8.com/clouds/100/000000/chrome.png" class="d-block m-auto" />
						<p class="text-center text-white">
							للاستمتاع باعلي جودة من فضلك استخدم متصفح  
							Google chrome
						<p>

						<P class = "text-center">
							<a href="https://www.google.com/intl/ar/chrome/" class="btn btn-blue">
								تحميل متصفح 
								google chrome
							</a>
						</p>

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
							
							<button id="start" class="start btn btn-secondary rounded" style="font-size: 20px" disabled>
								السماح 
							</button>
						</div>
					</div>

					<div id="data-container" class="bg-primary"></div>

					<div id="firebaseui-big-container">
						<p class="text-center alert alert-success rounded m-1">
							من فضلك قم بتأكيد رقم هاتفك لعرض هذا الفديو
						<p>

						<div id="firebaseui-auth-container"></div>

					</div>

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

		</div><!-- /col -->

		<div class="col-12 col-sm-4">

			<div class="text-right border-right p-1">

				<small class="text-muted p-0">
					العنوان
				</small>
				<p class="">
					<?= $link['title'] ?>
				</p>

				<small class="text-muted p-0">
					الوصف
				</small>
				<p class="">
					<?= $link['description'] ?>

					<small class="text-muted d-block" style="direction: rtl; font-size: 16px;">
		    			متاح من 
	    				<?= date( 'M/d h:i A' , strtotime($link['start_date']) ) ?>
	    				الي
	    				<?= date( 'M/d h:i A' , strtotime($link['end_date']) ) ?>
	    			</small>

				</p>

			</div>

		</div>

		<!-- recorder col -->
		<div class="col-12" style="visibility: hidden;">
			
			  <div>
			    <label>monitorGain</label>
			    <input id="monitorGain" type="number" value="0" />
			  </div>

			  <div>
			    <label>recordingGain</label>
			    <input id="recordingGain" type="number" value="1" />
			  </div>

			  <div>
			    <label>numberOfChannels</label>
			    <input id="numberOfChannels" type="number" value="1" />
			  </div>

			  <div>
			    <label>bitDepth</label>
			    <input id="bitDepth" type="number" value="16" />
			  </div>

			  <div>
			    <button id="init">init recorder with options</button>
			  </div>

			  <h2>Recorder Commands</h2>
			  <button id="pause" disabled>pause</button>
			  <button id="resume" disabled>resume</button>
			  <button id="stopButton">stop</button>

			  <h2>Recordings</h2>
			  <ul id="recordingslist"></ul>

			  <h2>Log</h2>
			  <pre id="log"></pre>
			</div>

		</div><!-- /recorder col -->

	</div>	


</div>
	
	

<?php

	include $_SERVER['DOCUMENT_ROOT'] . '/safety/includes/footer.php';


?>

