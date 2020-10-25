<?php

	include $_SERVER['DOCUMENT_ROOT'] . '/safety/includes/header.php';
	include_once $_SERVER['DOCUMENT_ROOT'] . '/safety/includes/Mobile_Detect.php';
	include_once $_SERVER['DOCUMENT_ROOT'] . '/safety/includes/phone_name.php';
	$detect = new Mobile_Detect;

	//just verify his phone and header location to contact_info.php 

?>
	<div class="container text-right" style="direction: rtl">

		<div class="row my-3">
			
			<div class="col">
				<h2 class="font-weight-bold text-secondary">
					1 - تأكيد رقم الهاتف
				</h2>
			</div>

		</div>

		<div class="row my-1">
			<div class="col p-1 mx-1" style="background: #3CD070"></div>
			<div class="col p-1" style="background: #f2f2f2"></div>
			<div class="col p-1 mx-1" style="background: #f2f2f2;"></div>
		</div>

		<div class="row">
			
			<div class="col">

				<div class="text-right"  >
					
					
					<ul>
						<li>
							1 - قم بادخال رقم هاتفك 
						</li>
						<li>
							2 - اضغط علي  "أنا لست برنامج روبوت"
						</li>
						<li>
							3 - اضغط  علي  "إثبات الملكية"
						</li>
					</ul>
				</div>

				<div id = "firebaseui-auth-container">
					
				</div>

			</div>

		</div>
	</div>




	</body>
	<!-- The core Firebase JS SDK is always required and must be listed first -->
	<script src="https://www.gstatic.com/firebasejs/7.14.2/firebase.js"></script>

	<!-- TODO: Add SDKs for Firebase products that you want to use
	     https://firebase.google.com/docs/web/setup#available-libraries -->
	<script src="https://www.gstatic.com/firebasejs/7.14.2/firebase-analytics.js"></script>

	<script>
		// Your web app's Firebase configuration
		var firebaseConfig = {
		apiKey: "AIzaSyBSkwndIJt48d-niwTZH37f0DEW3l1Y9O4",
		authDomain: "safty-9bc68.firebaseapp.com",
		databaseURL: "https://safty-9bc68.firebaseio.com",
		projectId: "safty-9bc68",
		storageBucket: "safty-9bc68.appspot.com",
		messagingSenderId: "134973120434",
		appId: "1:134973120434:web:59e36b10b26573d7b48eab",
		measurementId: "G-WJL39P1QEF"
		};
		// Initialize Firebase
		firebase.initializeApp(firebaseConfig);
		firebase.analytics();

	</script>

	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

	<link type="text/css" rel="stylesheet" href="https://cdn.jsdelivr.net/npm/firebaseui@4.0.0/dist/firebaseui.css" />

	<script src="https://www.gstatic.com/firebasejs/ui/3.4.0/firebase-ui-auth__ar.js"></script>

	<script type="text/javascript">

	firebase.auth().onAuthStateChanged(function(user) {

	  if (user) {

	    // User is signed in.
	    var p = user.phoneNumber;	    
	    console.log(p);

	     document.cookie = "f=" + p + "; expires=Fri, 31 Dec 9999 23:59:59 GMT";

	    window.location="/safety/pay/contact_info.php?playlist_id=<?= $_GET['playlist_id'] ?>";

	  } else {

	    // User is signed out.

	    var ui = new firebaseui.auth.AuthUI(firebase.auth());

	    ui.start('#firebaseui-auth-container', {
	      signInOptions: [
	        {
	          provider: firebase.auth.PhoneAuthProvider.PROVIDER_ID,
	          // The default selected country.
	          defaultCountry: 'EG',
	        }
	      ],
	    });

	  }

	});
</script>

<div class="container-fluid  mt-5 " style="background: #F9F9F9">

	<div class="row" style="height: 300px">

		<div class="col-12 m-auto" >
			<h3 class="text-muted text-center " style="direction: rtl;">
				<span>
					<pre> و علم  ينتفع به  </pre>
				</span>
			</h3>
		</div>

	</div>

</div>