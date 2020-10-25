<?php
	
	include $_SERVER['DOCUMENT_ROOT'] . '/safety/includes/config.php';

		//contact info
		$contact_id =  filter_var ( $_GET['contact_id'] , FILTER_SANITIZE_NUMBER_INT );

		$sql = "SELECT * FROM  s_contacts  
				WHERE id = ? ";
		$stmt = $pdo->prepare($sql);
		$stmt->execute([ $contact_id ]);
		$contact = $stmt->fetch();

	include $_SERVER['DOCUMENT_ROOT'] . '/safety/includes/header.php';
?>
<script src = "https://www.atfawry.com/ECommercePlugin/scripts/FawryPay.js"></script>

<div class="container text-right" style="direction: rtl">

	<div class="row my-1">
		<div class="col p-1 mx-1" style="background: #3CD070"></div>
		<div class="col p-1" style="background: #3CD070"></div>
		<div class="col p-1 mx-1" style="background: #3CD070;"></div>
	</div>

	<div class="row py-5">
		<div class="col">

			<div>
				<img src="https://img.icons8.com/color/96/000000/smiling-face-with-heart.png" class="d-block m-auto" />
				<svg class="d-block m-auto" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
					width="96" height="96"
					viewBox="0 0 172 172"
					style=" fill:#000000;"><defs><linearGradient x1="76.11358" y1="140.61358" x2="12.68858" y2="77.18858" gradientUnits="userSpaceOnUse" id="color-1_VFaz7MkjAiu0_gr1"><stop offset="0.108" stop-color="#f1c40f"></stop><stop offset="0.433" stop-color="#e7c232"></stop></linearGradient><linearGradient x1="159.13689" y1="34.36377" x2="52.28084" y2="141.22356" gradientUnits="userSpaceOnUse" id="color-2_VFaz7MkjAiu0_gr2"><stop offset="0" stop-color="#f1c40f"></stop><stop offset="1" stop-color="#d6ba64"></stop></linearGradient></defs><g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><path d="M0,172v-172h172v172z" fill="none"></path><g><path d="M59.47975,148.42167l-53.81808,-53.81808c-2.7735,-2.7735 -2.7735,-7.267 0,-10.0405l14.40142,-14.40142c2.7735,-2.7735 7.267,-2.7735 10.0405,0l53.81808,53.81808c2.7735,2.7735 2.7735,7.267 0,10.0405l-14.40142,14.40142c-2.7735,2.76992 -7.267,2.76992 -10.0405,0z" fill="url(#color-1_VFaz7MkjAiu0_gr1)"></path><path d="M45.07833,123.97975l96.81808,-96.81808c2.7735,-2.7735 7.267,-2.7735 10.0405,0l14.40142,14.40142c2.7735,2.7735 2.7735,7.267 0,10.0405l-96.81808,96.81808c-2.7735,2.7735 -7.267,2.7735 -10.0405,0l-14.40142,-14.40142c-2.76992,-2.7735 -2.76992,-7.267 0,-10.0405z" fill="url(#color-2_VFaz7MkjAiu0_gr2)"></path></g></g>
				</svg>
			</div>

			<p class="text-muted text-center">
				شكرا لك  , يمكنك الان مشاهدة الدورة بعد تحميل 

				<a href="/safety/app/app.php">
					التطبيق 
				</a>
				ان شاء الله 
			</p>
			
		</div>
	</div>

	<div class="row my-1">
		<div class="col " >
			the app and the chanal
		</div>
	</div>

</div>



<?php

	include '../includes/footer.php';
