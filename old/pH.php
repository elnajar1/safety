<?php
	
	include_once $_SERVER['DOCUMENT_ROOT'] . '/safety/includes/config.php';
	include_once $_SERVER['DOCUMENT_ROOT'] . '/safety/includes/Mobile_Detect.php';
	include_once $_SERVER['DOCUMENT_ROOT'] . '/safety/includes/phone_name.php';
	$detect = new Mobile_Detect;

	 
	$link_id       = filter_var ( $_POST['l'] , FILTER_SANITIZE_NUMBER_INT ) ;
	$contact_phone = filter_var ( $_POST['p'] , FILTER_SANITIZE_NUMBER_INT ) ;

	@$source       = filter_var ( $_POST['s'] , FILTER_SANITIZE_STRING ) ;

	$show_video = 0;

	//echo $ua_phone_name;

	//link info
	$sql ="SELECT * FROM s_links WHERE  id = ? ";
	$stmt = $pdo->prepare($sql);
	$stmt->execute([ $link_id   ]);
	$link = $stmt->fetch();

	$user_id = $link['user_id'] ;	


	//contact info
	$sql ="SELECT * FROM s_contacts WHERE s_contacts.user_id = ? AND s_contacts.phone = ? ";
	$stmt = $pdo->prepare($sql);
	$stmt->execute([ $user_id , $contact_phone ]);
	$contact = $stmt->fetch();
	$count_contact = $stmt->rowCount();
	$contact_id = $contact['id'];

	//contact views
	$sql = "SELECT * FROM  s_contact_views 
			WHERE s_contact_views.link_id = ? AND s_contact_views.contact_id = ? ";
	$stmt = $pdo->prepare($sql);
	$stmt->execute([ $link_id , $contact_id ]);
	$contact_view = $stmt->fetch();

	

	//check if he found in s_contacts
	if ( $count_contact > 0 ) {

		//playlist_id_access_limit
		if( $contact['playlist_id_access_limit'] !== "0" ){
			
			if ( $contact['playlist_id_access_limit'] !== $link['playlist_id'] ) {

				//He can't access this playlist
				echo "<div class = 'alert alert-danger border p-2' style = 'direction: rtl;'>"; 
				echo '<img src="https://img.icons8.com/dotty/80/000000/closed-eye.png" class="d-block m-auto" />'; 
				echo "<p class = 'text-center'> ";
				echo "عذرا , هذا الفديو ضمن قائمة تشغيل  لم  يتم السماح لك بمشاهدتها ";
				echo "</p>";
				echo "</div>";

				exit;
			}
			
		}

		//calculte visits
		if(  ( @$contact_view['phone_visits'] + @$contact_view['pc_visits'] )  == 3 ){

			echo "<div class = 'alert alert-danger border p-2' style = 'direction: rtl;'>";  
			echo "<p class = 'text-center'> ";
			echo "يسمح فقط  بمشاهدة الفديو  3 مرات  ";
			echo "</p>";
			echo "</div>";

			exit;
		}

		//Contact stutus
		if( $contact['status'] == 0 ){

			echo "<div class = 'alert alert-danger border p-2' style = 'direction: rtl;'>";  
			echo "<p class = 'text-center'> ";
			echo " تم تعطيل حسابك مؤقتا  من قبل ";
			echo "<span class = 'text-primary'> المسؤل  <span>";
			echo "<a target='_blank' href = 'https://wa.me/201015551135?text=السلام%20عليكم%20تم%20تعطيل%20حسابي%20ما%20العمل%20؟' class ='d-block m-auto btn-success z-depth-1 rounded w-50' > تواصل واتساب مع المسؤل  </a>";
			echo "</p>";
			echo "</div>";

			exit;
		}

		//check if He stored in s_contats_views ( visit video for first time or not)
		$sql ="SELECT * FROM s_contact_views WHERE s_contact_views.contact_id = ? AND s_contact_views.link_id = ?";
		$stmt = $pdo->prepare($sql);
		$stmt->execute([ $contact_id , $link_id ]);
		$contact_view = $stmt->fetch();
		$count_contact_view = $stmt->rowCount();
		
		//if his device has been reset by deleteDevices.php page
		if ($contact_view['device_name'] == "") {

			$sql = "UPDATE s_contact_views SET device_name = ? WHERE s_contact_views.id = ?";
			$stmt = $pdo->prepare($sql);
			$stmt->execute([$ua_phone_name , $contact_view['id'] ] );

			//Remembe this browser ( b ) ( it is important only in pc )
			setcookie( "b_l_" . $link_id , $contact_id ,  time()+(10 * 365 * 24 * 60 * 60)); 

			//reSelect contact_view ( to UPDATE take afect)
			$sql ="SELECT * FROM s_contact_views WHERE s_contact_views.contact_id = ? AND s_contact_views.link_id = ?";
			$stmt = $pdo->prepare($sql);
			$stmt->execute([ $contact_id , $link_id ]);
			$contact_view = $stmt->fetch();
			$count_contact_view = $stmt->rowCount();
			

		}
		

		if( $detect->isMobile() ){

			//he use phone
			//check if He visit video for first time or not
			if ( $count_contact_view == 0) {

				//first time
				$sql = "INSERT INTO s_contact_views ( link_id, contact_id ,  is_phone , device_name , device_info , phone_visits , pc_visits) VALUES(?,?,?,?,?,?,?)";
				$stmt = $pdo->prepare($sql);
				$stmt->execute([ $link_id , $contact_id , 1 , $ua_phone_name , $ua_arry2[0] , 0 , 0 ] );

				//update Phone_vists
				echo '<script> setTimeout(function(){ viewed(' . $link_id . ',' . $contact_id . ',true,false) }, 900000); </script>'; 

				//allow it view_video
				$show_video = 1;

				//echo "first time stored "; 

			}else{


				//Not the first time
				//check if he use the same phone stored in database or anthor phone
				//allow iphone tempory 
				//echo ' not first time ';

				//if ( ($contact_view['device_name'] == $ua_phone_name) || ($contact_view['device_name'] == "iPhone") ) {
				if ( ($contact_view['device_name'] == $ua_phone_name) ) {

					//same phone
					//echo "but the same device";

					//update Phone_vists
					echo '<script> setTimeout(function(){ viewed(' . $link_id . ',' . $contact_id . ',true,false) }, 900000); </script>';

					//allaw he to view the video
					$show_video = 1;

				}else{

					//Not the same phone
					//echo "AND not same device";

					//Dont allow him to view video !!!!!!!!!!!!!!!!!!
					echo "<div class = 'alert alert-danger border p-2' style = 'direction: rtl;'>";  
					echo "<img src='https://img.icons8.com/officel/100/000000/no-mobile-devices.png' class = 'd-block m-auto' />";
					echo "<p class = 'text-center'> ";
					echo "لقد قمت بتسجيل الدخول من  جهاز اخر "  . '(' . $contact_view['device_name'] . ')' . " و لا يمكن مشاهدة الفديو الا من هذا  الجهاز";
					echo "</p>";
					echo "</div>";

					//store in s_contacts views blocked
					$sql = "UPDATE s_contact_views SET blocked_devices = concat( blocked_devices , ','  , ? ) WHERE s_contact_views.id = ?";
					$stmt = $pdo->prepare($sql);
					$stmt->execute([$ua_arry2[0] , $contact_view['id'] ] );

				}

			}

		}else{

			//he does not use phone (e.g Windows)

			/*
			//Tempory Dont allow him to view video !!!!!!!!!!!!!!!!!!
			echo "<div class = 'alert alert-danger border p-2 my-3' style = 'direction: rtl;'>";  
			echo "<p class = 'text-center'> ";
			echo '<img src="https://img.icons8.com/cotton/64/000000/laptop-error.png" class="d-block m-auto"/>';
			echo "تم تعطيل الدخول من اجهزة الكمبيوتر بواسطة الناشر ";
			echo "</p>";
			echo "</div>";
			*/

			
			//check if He visit video for first time or not
			//IMPORTANT!! system may block phone for second time if pc was first
			if ( $count_contact_view == 0 ) {

				//first time
				$sql = "INSERT INTO s_contact_views ( link_id, contact_id ,  is_phone , device_name , device_info , phone_visits , pc_visits) VALUES(?,?,?,?,?,?,?)";
				$stmt = $pdo->prepare($sql);
				$stmt->execute([ $link_id , $contact_id , 1 , $ua_phone_name , $ua_arry2[0] , 0 , 0 ] );
				
				//update pc_vists
				echo '<script> setTimeout(function(){ viewed(' . $link_id . ',' . $contact_id . ',false,true) }, 900000); </script>';

				//Remembe this browser ( b )
				setcookie( "b_l_" . $link_id , $contact_id ,  time()+(10 * 365 * 24 * 60 * 60)); 

				//echo "first time";
				//allow it view video 
				$show_video = 1;

			}else{

				if ( ($contact_view['device_name'] == $ua_phone_name) && (@$_COOKIE["b_l_" . $link_id] == $contact_id) )  {

					//same device and same borwser
					//echo "same device and same borwser";
					//update pc_vists
					echo '<script> setTimeout(function(){ viewed(' . $link_id . ',' . $contact_id . ',false,true) }, 900000); </script>';

					//allow it view video 
					$show_video = 1;

				}else{

					//not same device

					//Dont allow him to view video !!!!!!!!!!!!!!!!!!
					echo "<div class = 'alert alert-danger border p-2' style = 'direction: rtl;'>";  
					echo "<p class = 'text-center'> ";
					echo "<img src='https://img.icons8.com/officel/100/000000/no-mobile-devices.png' class = 'd-block m-auto' />";
					echo "من فضلك  قم بالدخول من الجهاز الذي سجلت الدخول به اول مرة ";
					echo "</p>";
					echo "</div>";

					//store in s_contacts views blocked
					$sql = "UPDATE s_contact_views SET blocked_devices = concat( blocked_devices , ','  , ? ) WHERE s_contact_views.id = ?";
					$stmt = $pdo->prepare($sql);
					$stmt->execute([$ua_arry2[0] , $contact_view['id'] ] );
				}	
			}
			
			
		}

	}else{

		?>

		<div class = 'alert alert-danger'>
			
			<div>
				<img src='https://img.icons8.com/color/96/000000/id-not-verified.png' class = 'd-block m-auto' />
			</div>
				
			<div> 

				<p class = 'text-center' id = "sign-out-btn-container"> 
				 لم يتم السماح لك بمشاهدة هذا الفديو  . من فضلك تواصل مع ناشر الفديو
				</p>

				<p  class = 'text-right'>
					ما السبب  ؟؟

					<ul  class = 'text-right'>
						<li>
							لم يتم تسجيل رقم  هاتفك ضمن المسموح لهم  بالمشاهدة من قبل ناشر الفديو 
						</li>
						<li>
							تم ادخال رقم هاتف غير المسجل  من قبل ناشر الفديو 
						</li>
						<li>
							ناشر الفديو اخطا في كتابة رقم هاتفك اثناء تسجيلة 
						</li>
					</ul>
				</p>
			</div>
		
		</div>

		<?php

	}


	if ( $show_video == 1 ) : ?>

		<div class="border-bottom p-0 m-1 text-right">
			<div class="row">

				<div class="col">
					<p class="text-dark d-inline-block" id = "sign-out-btn-container" style="direction: rtl">
						<small class="text-muted">

							<div class="d-inline-block badge badge-white mx-1 border z-depth-0">
								<i class="far fa-eye text-secondary"></i>

								<?= @$contact_view['phone_visits'] + @$contact_view['pc_visits'] ?> / 3
							</div>


							 <?= $contact['name'] ?> 

						</small>
					</p>
				</div>

			</div>
		</div>
		
		

		<?php if (  $source == "app" ) : 

			//save device name in s_contact
			$sql = "UPDATE s_contacts SET app_device = ? WHERE s_contacts.id = ?";
			$stmt = $pdo->prepare($sql);
			$stmt->execute([$ua_phone_name , $contact['id'] ] );

			?>

			<script type="text/javascript">
				$(".plyr_holder").css("visibility", "visible");
			</script>
	
		<?php else: ?>

			<div>
	      		<div id= "original-video" style="display: ;height: 100%" min-height="250px">
				<video id="vid1" class="azuremediaplayer amp-default-skin m-auto" autoplay controls width="100%"  max-width="800px" min-height="250px" max-height="100%"  poster="poster.jpg" data-setup='{ "nativeControlsForTouch": false, "logo": { "enabled": false }  , "plugins": {"ga":{ "eventsToTrack": ["playerConfig", "loaded", "playTime", "percentsPlayed", "start", "end", "play", "pause", "error", "buffering", "fullscreen", "seek", "bitrate"], "debug": false}}}' >

			    	<source src="<?= $link['m_link'] ?>" type="application/vnd.ms-sstr+xml" />
				    <p class="amp-no-js">
				        To view this video please enable JavaScript, and consider upgrading to a web browser that supports HTML5 video
				   	</p>

				</video>

			</div>

			<small class = "d-block text-muted text-right">
				هذا الفديو خاضع لحقوق النشر، وناشر الفديو

				<span class = "text-secondary" >
				 غير مسامح بمشاهدة الفديو بدون وجهه حق اطلاقا
				</span>

				 ، يرجي مراسلة الناشر اذا كنت غير مشترك 
			</small>

		<?php endif; ?>


		<?php

	endif;


?>


<script type="text/javascript">

//he wached video
function viewed ( l_id , c_id  , is_phone , is_pc ){

  $.ajax({
    url : "viewCounter.php", 
    type : "POST", 
    data : {
        "l_id" : l_id,
        "c_id" : c_id,
        "is_phone" : is_phone,
        "is_pc" : is_pc

    }, 
    beforeSend : function(){
      
    }, 
    success:  function(data){

    },
    error: function (request, status, error) { 
    
      console.log("Sorry, An error occured & respons status  : " +  request.status  + " & readyState " + request.readyState  + ": & Respons text : "  + request.responseText  +  " & status : "  +  status  + " & error : "  + error) ;
             
    }

  });
  
}

</script>

<style type="text/css">
.wmark{
  position: absolute;
  animation: myfirst 60s linear infinite ;
}
@keyframes myfirst {
  0%   {left:30px; top:30px;}
  25%  {left:200px; top:30px;}
  50%  {left:30px; top:30px;}
  60%  {left:20px; top:80%;}
  100% {left:200px; top:80%;}
}
</style>

<link href="https://amp.azure.net/libs/amp/2.3.4/skins/amp-default/azuremediaplayer.min.css" rel="stylesheet">
<script src= "https://amp.azure.net/libs/amp/2.3.4/azuremediaplayer.min.js"></script>



<?php

/*


			<div  style="display: none;"  id = "alert-video-container">
			<video id = "alert-video" width="100%"  max-width="600px" min-height="250px" max-height="100%" autoplay controls>
				<source src="/safety/uploads/videos/alert.mp4" type="video/mp4">
				Your browser does not support the video tag.
			</video>
			<button id = "skip-alert" class="btn btn-secondary btn-block rounded z-depth-1"> 
				تخطي الاعلام  وعرض الفديو الاصلي 
			</button>
		</div>

		
		<div id= "original-video" style="display: ;height: 100%" min-height="250px">
			<video id="vid1" class="azuremediaplayer amp-default-skin m-auto" autoplay controls width="100%"  max-width="800px" min-height="250px" max-height="100%"  poster="poster.jpg" data-setup='{ "nativeControlsForTouch": false, "logo": { "enabled": false }  , "plugins": {"ga":{ "eventsToTrack": ["playerConfig", "loaded", "playTime", "percentsPlayed", "start", "end", "play", "pause", "error", "buffering", "fullscreen", "seek", "bitrate"], "debug": false}}}' >

		    	<source src="<?= $link['link'] ?>" type="application/vnd.ms-sstr+xml" />
			    <p class="amp-no-js">
			        To view this video please enable JavaScript, and consider upgrading to a web browser that supports HTML5 video
			   	</p>

			</video>

		</div>

		<script type="text/javascript">

			var alertVideo               = document.getElementById("alert-video");
			var alertVideoContainer      = document.getElementById("alert-video-container");
			var originalVideo            = document.getElementById("original-video");
			var skipAlertButton          = document.getElementById("skip-alert");

			

			alertVideo.play();

			//skip button , hide alert when clicked
			skipAlertButton.onclick = function(){

				alertVideoContainer.style.display  = "none";
				alertVideo.pause();
			    originalVideo.style.display  = "block";
			
			};

			//hide alert when video ended
			alertVideo.onended = function() {

				alertVideoContainer.style.display  = "none";
			    originalVideo.style.display  = "block";
			
			};
		</script>

*/