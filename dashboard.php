<?php

	include_once $_SERVER['DOCUMENT_ROOT'] . '/safety/includes/config.php';

	if (empty($user_id)) {
		header("location: index.php");
		exit;
	}

	include $_SERVER['DOCUMENT_ROOT'] . '/safety/includes/header.php';

?>

<div class="container-fluid text-right" style="direction: rtl;" >

	<div class="row">

		<div class="col-12 text-center my-5">

			<i style="font-size: 30px" class="fa fa-cog text-secondary d-inline-block"></i>
			<h1 class="d-inline-block">
				لوحة التحكم 
			</h1>

		</div>

		<div class="col-10 col-sm-5 bg-primary p-3 my-1 mx-auto text-center z-depth-1 rounded">
			<a href="contact/createContact.php" class="text-white d-block">
				<img src="https://img.icons8.com/bubbles/100/000000/contacts.png" class = 'd-block m-auto'/>

				<h1>
					 أدارة  المشتركين 
					 <h6 class="d-block text-light">
					(  جهات  الاتصال  )
					</h6>
				</h1>
				
			</a>
		</div>

		<div class="col-10 col-sm-5 p-3 my-1 mx-auto text-center z-depth-1 rounded">
			<a href="link/createLink.php" class=" d-block">
				<svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
				width="96" height="96"
				viewBox="0 0 172 172"
				style=" fill:#000000;"><g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><path d="M0,172v-172h172v172z" fill="none"></path><g fill="#3498db"><path d="M28.66667,21.5c-7.83362,0 -14.33333,6.49972 -14.33333,14.33333v100.33333c0,7.83362 6.49972,14.33333 14.33333,14.33333h114.66667c7.83362,0 14.33333,-6.49972 14.33333,-14.33333v-100.33333c0,-7.83362 -6.49972,-14.33333 -14.33333,-14.33333zM28.66667,35.83333h114.66667v100.33333h-114.66667zM64.5,57.33333v57.33333l50.16667,-28.66667z"></path></g></g></svg>
				<h1>
					الفديوهات
				</h1>
				
			</a>
		</div>


		<div class="col-10 col-sm-5 p-3 my-1 mx-auto text-center z-depth-1 rounded">
			<a href="playlist/playlists.php" class=" d-block">
				
				<img src="https://img.icons8.com/nolan/96/business-report.png"  class = 'd-block m-auto' />

				<h1>
					ادارة  الدورات التعليمية  
					<h6 class="d-block text-muted">
					( قوائم التشغيل  )
					</h6>
				</h1>
				
			</a>
		</div>

		<div class="col-10 col-sm-5 bg-primary p-3 my-1 mx-auto text-center z-depth-1 rounded">
			<a href="/safety/profile/?u=<?= $user_id ?>.php" class="text-white d-block">
				
				<img src="https://img.icons8.com/plasticine/100/000000/lifecycle.png" class = 'd-block m-auto'/>

				<h1>
					زيارة  قناتك
				</h1>
				
			</a>
		</div>

	</div>

	<div class="row">

		<div class="col">

			<a href="logout.php" class="btn btn-outline-primary m-5">
				تسجيل  الخروج 
			</a>

		</div>

	</div>

	<?php include 'how_to_start.php' ?>

</div>


<?php

	include $_SERVER['DOCUMENT_ROOT'] . '/safety/includes/footer.php';


?>

