<?php

	include '../includes/header.php';
	include_once '../includes/Mobile_Detect.php';
	include_once '../includes/phone_name.php';
	$detect = new Mobile_Detect;

	//just verify his phone and header location to contact_info.php 

?>
	<div class="container">
		<div class="row">
			
			<div class="col">
				
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

	<link type="text/css" rel="stylesheet" href="https://cdn.firebase.com/libs/firebaseui/3.5.2/firebaseui.css" />

	<script src="https://www.gstatic.com/firebasejs/ui/3.4.0/firebase-ui-auth__ar.js"></script>

	<script type="text/javascript">

	firebase.auth().onAuthStateChanged(function(user) {

	  if (user) {

	    // User is signed in.
	    var p = user.phoneNumber;	    
	    console.log(p);

	     document.cookie = "f=" + p + "; expires=Fri, 31 Dec 9999 23:59:59 GMT";

	    //header contact_info.php

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