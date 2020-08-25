<?php

	include 'config.php';
	include 'functions.php';
?>
<!doctype html>
<html lang="en">
	<head>
		
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<!-- normalize CSS  -->
	    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
	   
	   	<link rel="icon" href="/safety/layout/imgs/lock.jpg">
	    <meta property="og:image" content="/safety/layout/imgs/lock.png"> 
	    <meta property="og:image:type" content="/safety/layout/imgs/lock.png"> 
	    <meta property="og:image:width" content="1024"> 
	    <meta property="og:image:height" content="1024">
	    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	    
	    <!-- firebase -->
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/firebaseui@4.5.0/dist/firebaseui.css">

	    
	    <!-- Font Awesome -->
	    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
	 
	   <!-- Bootstrap core CSS -->
	   <link href="/safety/layout/bootstrap/css/bootstrap.min.css?v=2" rel="stylesheet">
	  
	    <!-- Material Design Bootstrap -->
	    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.6.1/css/mdb.min.css" rel="stylesheet">
	   
	    <!-- google font -->
    	<link href="https://fonts.googleapis.com/css2?family=Changa&family=Lemonada&family=Markazi+Text&display=swap" rel="stylesheet">
    	<link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Droid+Sans" />

    	 <!-- animate.css -->
    	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css"/>

    	<!-- progress.css -->
    	<link rel="stylesheet" href="/safety/layout/progres/css-circular-prog-bar.css">

		<!-- Global site tag (gtag.js) - Google Analytics -->
		<script async src="https://www.googletagmanager.com/gtag/js?id=UA-166809640-1"></script>
		<script>
		  window.dataLayer = window.dataLayer || [];
		  function gtag(){dataLayer.push(arguments);}
		  gtag('js', new Date());

		  gtag('config', 'UA-166809640-1');
		</script>


		<link rel="stylesheet" href="https://cdn.plyr.io/3.6.2/plyr.css" />

		<link rel="stylesheet" href="/safety/layout/css/main.css?v=4">

		<!-- Appzi: Capture Insightful Feedback -->
		<script async src="https://w.appzi.io/bootstrap/bundle.js?token=6CFqk"></script>
		<!-- End Appzi -->

		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">

		<?php
			if(isset($_GET['l'])){

				$link_id  = filter_var ( $_GET['l'] , FILTER_SANITIZE_NUMBER_INT ) ;
				//LINK INFO
				$sql ="SELECT * FROM s_links WHERE id = ? ";
				$stmt = $pdo->prepare($sql);
				$stmt->execute([ $link_id ]);
				$link = $stmt->fetch();
				
				echo '<title>' . $link['title'] . ' | Safety </title>' ;
				echo '<meta name="description" content="Safty | Protect your videos ! ">' ;
				
			} else{
				 			
				echo '<title>Safety</title>';
				
				//echo '<title>' . $page_name  . ' | FreshWeb - نظم ملفاتك التعليمية واستمتع بتشغيل الملفات الصوتية مباشره دون تحميل </title>';
			
				echo '<meta name="description" content="Safty | Protect your videos ! ">' ;
			
			}

		?>

	</head>

	<body>

		<div id = "safety-app"><!-- make it vue app -->

		<?php 
		if( (basename($_SERVER['PHP_SELF']) !== "index.php") && (basename($_SERVER['PHP_SELF']) !== "video.php" ) ):
		 ?>
		<div class="container-fluid menu">

			<div class="row border border-bottom">

				<div class="col-8">
					<a href="/safety/index.php">
						<h1 class="p-0 m-0 d-inline font-weight-bold text-dark"> 
						Safety .  
						</h1>
					</a>
					<small class="text-muted d-inline p-0 m-0" style="font-size: 14px">
						احمي فديوهاتك
					</small>
					
					
				</div>

				<?php if(isset( $user_id )): ?>

					<div class="col m-auto text-right">

						<a href="/safety/dashboard.php" class=" text-muted">
							<i style="font-size: 30px" class="fa fa-cog text-secondary d-sm-inline-block d-none p-3 animate__animated animate__rotateIn "></i>

							<h3 class="d-sm-inline-block d-none ">
								<?= $user_name ?>
							</h3>

							<img src="<?= $user_avatar ?>" class = "rounded " style = "max-height: 40px" />

						</a>
						
					</div>

				<?php else: ?>

					<div class="col m-auto text-right font-weight-bold" style="font-size: 16px">

						<a href="/safety/index.php"></a>
						
					</div>

				<?php endif; ?>

			</div>	

		</div>
		<?php endif; ?>


			