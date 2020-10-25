<?php

	include $_SERVER['DOCUMENT_ROOT'] . '/safety/includes/config.php';
	include_once $_SERVER['DOCUMENT_ROOT'] . '/safety/includes/Mobile_Detect.php';
	include_once $_SERVER['DOCUMENT_ROOT'] . '/safety/includes/phone_name.php';
	$detect = new Mobile_Detect;

	//filter_var($_POST['name'] , FILTER_SANITIZE_STRING )
	//filter_var ( $_GET['c'] , FILTER_SANITIZE_NUMBER_INT ) ;
	
	if( !empty($_GET['not_paid_contact_id']) ):
		
		$sql = "SELECT * FROM  s_contacts  
				WHERE id = ? ";
		$stmt = $pdo->prepare($sql);
		$stmt->execute([ $_GET['not_paid_contact_id'] ]);
		$contact = $stmt->fetch();

		//contact info
		$contact_name =  $contact['name'];
		$contact_phone  = $contact['phone'];
		$contact_email =  $contact['email'];
		$wanted_playlists_ids =  $contact['wanted_playlists_ids'];

		//playlist info
		$sql = "SELECT *  FROM  s_playlists  
				WHERE id IN ( $wanted_playlists_ids )";
		$stmt = $pdo->prepare($sql);
		$stmt->execute([]);
		$wanted_playlists = $stmt->fetchall();

		// SUM(cost)
		$sql = "SELECT SUM(cost) FROM  s_playlists  
				WHERE id IN ( $wanted_playlists_ids )";
		$stmt = $pdo->prepare($sql);
		$stmt->execute([]);
		$price = $stmt->fetchall();


	elseif( isset($_POST['pay']) ):

		//contact info
		$contact_name =  $_POST['name'];
		$contact_phone  = '+' . trim($_POST['phone']);
		$contact_email =  $_POST['email'];
		$wanted_playlists_ids =  $_POST['playlists'];

		//playlist info
		$sql = "SELECT *  FROM  s_playlists  
				WHERE id IN ( $wanted_playlists_ids )";
		$stmt = $pdo->prepare($sql);
		$stmt->execute([]);
		$wanted_playlists = $stmt->fetchall();

		// SUM(cost)
		$sql = "SELECT SUM(cost) FROM  s_playlists  
				WHERE id IN ( $wanted_playlists_ids )";
		$stmt = $pdo->prepare($sql);
		$stmt->execute([]);
		$price = $stmt->fetchall();


		//insert want to pay
		if ( !empty($wanted_playlists_ids[0])  && !empty($contact_phone) ):
			
			//free course
			if ( $price[0][0] == 0 ) : 

				$sql = "INSERT INTO s_contacts ( name, phone , email , user_id , added_by , wanted_playlists_ids , is_paid ) VALUES(?,?,?,?,?,?,?)";
				$stmt = $pdo->prepare($sql);
				$stmt->execute([ $contact_name , $contact_phone  , $contact_email , $wanted_playlists[0]['user_id'] , "site" , $wanted_playlists_ids, 1 ] );
				$contact_id = $pdo->lastInsertId();
				
				//add it to playlists
				$wanted_playlists_array = explode(',', $wanted_playlists_ids); 
				foreach ( $wanted_playlists_array as $playlist ) {
					$sql = "INSERT INTO s_contact_playlists ( contact_id, playlist_id , paid , pay_method ) VALUES(?,?,?,?)";
					$stmt = $pdo->prepare($sql);
					$stmt->execute([ $contact_id ,$playlist, 0 , "site"] );

				}

				//pay sussess - Thanks to Allah -
				header("location: pay_success.php?contact_id=" . $contact_id );

			//paid course
			else:

				$sql = "INSERT INTO s_contacts ( name, phone , email , user_id , added_by , wanted_playlists_ids , is_paid ) VALUES(?,?,?,?,?,?,?)";
				$stmt = $pdo->prepare($sql);
				$stmt->execute([ $contact_name , $contact_phone  , $contact_email , $wanted_playlists[0]['user_id'] , "site" , $wanted_playlists_ids, 0 ] );
				$contact_id = $pdo->lastInsertId();

				//header( checkout?not_paid=212 ); to avoid INSERT agin

			endif;

		endif;

	else:

		//error massege
		include $_SERVER['DOCUMENT_ROOT'] . '/safety/includes/header.php';
		
		echo '<div style = "direction : rtl ;text-align:right; padding: 10px; background : #c52b68 ; color: white;"> برجاء الذهاب الي الدورة المراد شرائوها والضغط  علي  زر  "شراء "  مرة اخر  </div>';
		exit;

	endif;


	//pay api 
	
	//if pay is success -> save it in DB and go to profile/index.php

	include $_SERVER['DOCUMENT_ROOT'] . '/safety/includes/header.php';
?>
<script src = "https://www.atfawry.com/ECommercePlugin/scripts/FawryPay.js"></script>

<div class="container text-right" style="direction: rtl">

	<div class="row my-3">
		
		<div class="col">
			<h2 class="font-weight-bold text-secondary">
				3 - الخطوة الاخيرة  - الدفع 
			</h2>
			<p class="text-muted">
				بعد الدفع يتم اضافة  الدورة 
				
				في حسابك ويمكنك مشاهدتها من  

				<a href="/safety/app/app.php">
					التطبيق 
				</a>
				ان شاء الله 
				يا
				<?= $contact_name ?>
			</p>
		</div>

	</div>

	<div class="row my-1">
		<div class="col p-1 mx-1" style="background: #3CD070"></div>
		<div class="col p-1" style="background: #3CD070"></div>
		<div class="col p-1 mx-1" style="background: #3CD070;"></div>
	</div>

	<div class="row py-5">
		<div class="col">

			<h3 class="text-center d-block">
				 اضغط علي  علامة فوري  للدفع  
			</h3>
			
			<input type="image" class="m-auto p-3 d-block" onclick='FawryPay.checkout(
			
				{ 
					"language":"ar-eg",
					"merchantCode":"is0N+YQzlE4=",
					"merchantRefNumber":"12333", 
					
					"customer": 
					{ 
						"name":"test user",
						"mobile":"0100739xxx", 
						"email":"test@test.com", 
						"customerProfileId":"8723871236" 
					}, 

					"order":{ 
						"description":"test bill inq", 
						"expiry":"2", 
						"orderItems":
							[ { 
								"productSKU":"12222", 
								"description":"Test Product", 
								"price":"50", 
								"quantity":"2", 
								"width":"10", 
								"height":"5", 
								"length":"100", 
								"weight":"1" 
							} ] }, 

					"signature":"243d69d005ba46943c5f8d590cf7f8ad6c02663a838ca5b7039c33e03ad10799"
				},

				"http://localhost/safety/pay/checkout.php?success=1" , 

				"http://localhost/safety/pay/checkout.php?failed=1")'; 

				src="https://www.atfawry.com/assets/img/FawryPayLogo.jpg"
			/>
		</div>
	</div>

	<div class="row my-1">
		<div class="col col-md-6" >
			<div class="alert alert-success">
				<h4> 
					<i class="fas fa-info-circle"></i>
					ملخص   بيانات   الطلب 
				</h4>
				<hr>
				<small class="d-block">
					<span class="text-secondary">
						المشترك    : 
					</span>
					<?= $contact_name ?> | <?= $contact_phone ?> 
				</small>

				<p class="d-block">
					<span>
						عربة التسوق    : 
					</span>
					
					<?php foreach ($wanted_playlists as $playlist ): ?>
						<small class="d-block">
							<span> 
								<?= $playlist['name'] ?> 
							</span>

							<span class="float-left"> 
								<?= $playlist['cost'] ?> 
								جنية
							</span>
						</small>
					<?php endforeach; ?>
			
				</p>
				
				<hr>
				
				<p class="d-block">
					<span>
						المجموع    : 
					</span>
					<span class="text-secondary float-left">
						<?=  $price[0][0] ?>
						جنية مصري
					</span> 
					
				</p>


			</div>
		</div>
	</div>

</div>



<?php

	echo "<pre>";
	var_dump($_POST);

	include '../includes/footer.php';
