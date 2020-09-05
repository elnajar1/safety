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
	   
	   	<link rel="icon" type="image/png" sizes="undefinedxundefined" href="layout/assets/img/logo.png?h=bbdfc6a09095f7548f82c4c476b0b087">
    	<link rel="icon" type="image/png" sizes="undefinedxundefined" href="layout/assets/img/logo.png?h=bbdfc6a09095f7548f82c4c476b0b087">
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
    	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:400,400i,700,700i,600,600i">

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

		<link rel="stylesheet" href="/safety/layout/css/main.css?v=5">

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

		<?php if( basename($_SERVER['PHP_SELF']) !== "video.php" ): ?>
		
		<nav class="font-mont navbar navbar-light navbar-expand-lg fixed-top bg-white clean-navbar main-nav ">

			<div class="container">

				<a class="navbar-brand logo" href="/safety/index.php">
					<span class="font-weight-bold">Safety </span>| freshweb
				</a>

				<button data-toggle="collapse" class="navbar-toggler" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>

				<div class="collapse navbar-collapse" id="navcol-1">
	                <ul class="nav navbar-nav ml-auto">
	                    <li class="nav-item px-2" role="presentation"><a class="nav-link" href="/safety/index.php">الرئيسية</a></li>
	                    
	                    <?php if(isset( $user_id )): ?>

	                    <li class="nav-item px-2" role="presentation"><a class="nav-link" href="/safety/logout.php"> تسجيل الخروج </a></li>
	                   
	                    <?php endif; ?>
	                </ul>
	            </div>

	            <?php if(isset( $user_id )): ?>

						<a href="/safety/profile/?u=<?= $user_id ?>.php" class="navbar-brand logo d-block">

							<span class="text-muted"><?= $user_name ?></span>
							<img src="<?= $user_avatar ?>" class = "rounded " style = "max-height: 40px" />

						</a>
						
					</div>

				<?php endif; ?>

			</div>	

		 </nav>
		<?php endif; ?>


			