<?php
	
	// required headers
	header("Access-Control-Allow-Origin: *");
	header("Access-Control-Allow-Methods: POST");
	header("Access-Control-Allow-Methods: GET");
	header("Access-Control-Max-Age: 3600");
	header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
	header("Content-Type: application/json; charset=UTF-8");
	
	//for security
	$auth       = filter_var ( $_GET['auth'] , FILTER_SANITIZE_STRING ) ;
    if ( $auth !== "aman_en_sha_allah"){
        exit;
	}
	
	include '../../includes/config.php';
	include_once '../../includes/Mobile_Detect.php';
	include_once '../../includes/phone_name.php';
	$detect = new Mobile_Detect;

	$error = '';
	$massege = '';	

	$link_id       = filter_var ( $_GET['l'] , FILTER_SANITIZE_NUMBER_INT ) ;
	$contact_phone = '+' . filter_var ( $_GET['p'] , FILTER_SANITIZE_NUMBER_INT ) ;

	//link info
	$sql ="SELECT * FROM s_links WHERE id = ? ";
	$stmt = $pdo->prepare($sql);
	$stmt->execute([ $link_id   ]);
	$link = $stmt->fetch();
	$user_id = $link['user_id'];
	

	//check if link is betwen start and end date
	$currentDate = date('Y-m-d H:i:s');
	$currentDate = date('Y-m-d H:i:s', strtotime($currentDate));
	$start_date = date('Y-m-d H:i:s A', strtotime($link['start_date']) );
	$end_date = date('Y-m-d H:i:s A', strtotime($link['end_date']) );
	
	//echo $currentDate . 'current<br>';
	//echo $start_date . 'start<br>';
	//echo $end_date . 'end<br>';

	//contact info
	$sql ="SELECT * FROM s_contacts WHERE s_contacts.user_id = ? AND s_contacts.phone = ? ";
	$stmt = $pdo->prepare($sql);
	$stmt->execute([ $user_id , $contact_phone ]);
	$contact = $stmt->fetch();
	$count_contact = $stmt->rowCount();
	@$contact_id = $contact['id'];

	//contact views
	$sql = "SELECT * FROM  s_contact_views 
			WHERE s_contact_views.link_id = ? AND s_contact_views.contact_id = ? ";
	$stmt = $pdo->prepare($sql);
	$stmt->execute([ $link_id , $contact_id ]);
	$contact_view = $stmt->fetch();

	//user
	$sql ="SELECT * FROM s_users WHERE id = ? ";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([ $user_id ]);
    $user = $stmt->fetch();
	
	//var_dump($contact_view);
	//var_dump($contact);
	//var_dump($link);
	
	//link aviblity check
	if ( $link['privacy'] == "private"):

		$error .= '<img src="https://img.icons8.com/cute-clipart/64/000000/lock.png" class="d-block m-auto" />';
		$error .= '<p class="text-center text-white"> هذا الفديو خاص <p>';

	else:

		//
		if ( ( (($currentDate >= $start_date) && ($currentDate <= $end_date)) || $link['is_time_limited'] !== "on") == false  ): 

			$error .= 	'<div class="alert alert-warning text-center py-3">	
							<img src="https://img.icons8.com/cotton/64/000000/time.png"/>

							<p>
								الفديو  غير متاح 
							</p>
							<small class="text-muted" style="direction: rtl">

								هذا الفديو  متاح فقط  من  تاريخ
								<br>' . date( 'l jS \of F Y h:i A' , strtotime($link['start_date']) )  .

								'<br>
								الي
								<br>' . date( 'l jS \of F Y h:i A' , strtotime($link['end_date']) )  . 

							'</small>
						</div>';

		endif;

	endif;

	//check if he found in s_contacts
	if ( $count_contact > 0 ) {

		//can he access this playlist
		if( $contact['playlist_id_access_limit'] !== "0" ){
			
			if ( $contact['playlist_id_access_limit'] !== $link['playlist_id'] ) {

				//He can't access this playlist
				$error .= "<div class = 'alert alert-danger border p-2' style = 'direction: rtl;'>"; 
				$error .= '<img src="https://img.icons8.com/dotty/80/000000/closed-eye.png" class="d-block m-auto" />'; 
				$error .= "<p class = 'text-center'> ";
				$error .= "عذرا , هذا الفديو ضمن قائمة تشغيل  لم  يتم السماح لك بمشاهدتها ";
				$error .= "</p>";
				$error .= "</div>";

			}
			
		}

		//calculte visits
		if(  ( @$contact_view['phone_visits'] + @$contact_view['pc_visits'])  == $link['allowed_views'] ){

			$error .= "<div class = 'alert alert-danger border p-2' style = 'direction: rtl;'>";  
			$error .= "<p class = 'text-center'> ";
			$error .= "يسمح فقط  بمشاهدة الفديو" . $link['allowed_views'] . " مرات  ";
			$error .= "</p>";
			$error .= "</div>";

		}

		//Contact stutus
		if( $contact['status'] == 0 ){

			$error .= "<div class = 'alert alert-danger border p-2' style = 'direction: rtl;'>";  
			$error .= "<p class = 'text-center'> ";
			$error .= " تم تعطيل حسابك مؤقتا  من قبل ";
			$error .= "<span class = 'text-primary'> المسؤل  <span>";
			$error .= "<a href = 'https://wa.me/2" . $user['phone'] . "?text=السلام%20عليكم%20تم%20تعطيل%20حسابي%20ما%20العمل%20؟' class ='d-block m-auto btn-success z-depth-1 rounded w-50' > تواصل واتساب مع المسؤل  </a>";
			$error .= "</p>";
			$error .= "</div>";

		}

	}else{

		$error .= 
		"<div class = 'alert alert-danger'>
	
			<div>
				<img src='https://img.icons8.com/color/96/000000/id-not-verified.png' class = 'd-block m-auto' />
			</div>
				
			<div> 

				<p class = 'text-center' id = 'sign-out-btn-container'> 
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
		
		</div>";


	}


	//check if He stored in s_contats_views ( visit video for first time or not)
	$sql ="SELECT * FROM s_contact_views WHERE s_contact_views.contact_id = ? AND s_contact_views.link_id = ?";
	$stmt = $pdo->prepare($sql);
	$stmt->execute([ $contact_id , $link_id ]);
	$contact_view = $stmt->fetch();
	$count_contact_view = $stmt->rowCount();
	
	//store in visits
	if ( $count_contact_view == 0 && empty($error) ) {

		//first time
		$sql = "INSERT INTO s_contact_views ( link_id, contact_id ,  is_phone , device_name , device_info , phone_visits , pc_visits) VALUES(?,?,?,?,?,?,?)";
		$stmt = $pdo->prepare($sql);
		$stmt->execute([ $link_id , $contact_id , 1 , $ua_phone_name , 'API - ' . $ua_arry2[0] , 0 , 0 ] );
	
	}

	//link time if time limited
	$link_limited_time = '';
	if (  $link['is_time_limited'] == "on" ): 
		$link_limited_time = '<small class="text-muted d-block" style="direction: rtl; font-size: 16px;">
			متاح من '
			. date( 'M/d h:i A' , strtotime($link['start_date']) ) .
			'الي'
			.  date( 'M/d h:i A' , strtotime($link['end_date']) ) .
		'</small>';
	endif;
	
	@$data = [ 
		'error' => $error,
		'massege' => $massege,
		
		'contact_id' => $contact_id,
		'contact_phone' => $contact_phone,
		'contact_status' => $contact['status'],
		'contact_view_count' => $contact_view['phone_visits'] + $contact_view['pc_visits'] ,
		'ua_phone_name' => $ua_phone_name,

		'user_id' => $user_id,
		'user_name' => $user['name'],
		'user_phone' => $user['phone'],
		
		'link_id' => $link_id,
		'link_title' => $link['title'],
		'link_description' => $link['description'],
		'link_limited_time' => $link_limited_time,
		'link_link' => $link['link'],
		'is_time_limited' => $link['is_time_limited']
	];

	// set response code - 200 OK
	http_response_code(200);
	
	echo json_encode($data);