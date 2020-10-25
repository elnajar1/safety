
	</div><!-- /make it vue app -->
	
	<?php if( basename($_SERVER['PHP_SELF']) !== "video.php"): ?>	
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

		<div class="row">

			<div class="col text-right" style="font-size : 22px">
				

				<a href="/safety/index.php?s=SubscribeAsVideoCreator" class="text-info d-block">
					الصفحة الرئيسية
				</a>
				
				<a href="mailto:elnajar449@gmail.com" class="text-muted d-block">
					تواصل معنا
				</a>
				<a href="/safety/about.php" class="text-muted d-block">
					عن الموقع
				</a>



				<a href="https://www.iubenda.com/privacy-policy/45461267" class="iubenda-white iubenda-embed" title="Privacy Policy ">Privacy Policy</a>
				<script type="text/javascript">(function (w,d) {var loader = function () {var s = d.createElement("script"), tag = d.getElementsByTagName("script")[0]; s.src="https://cdn.iubenda.com/iubenda.js"; tag.parentNode.insertBefore(s,tag);}; if(w.addEventListener){w.addEventListener("load", loader, false);}else if(w.attachEvent){w.attachEvent("onload", loader);}else{w.onload = loader;}})(window, document);
				</script>

			</div>
		
		</div>

	</div>
	<?php endif; ?>
	


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


	<script src="/safety/layout/js/frb.js?v=10"></script>
   	
	<!-- Latest compiled and minified bootstrap-select JavaScript -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
    
    <!-- main js-->
    <script src="/safety/layout/js/main.js?v=17"></script>

    <!-- Go to www.addthis.com/dashboard to customize your tools -->
	<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5f8f52968ab9dad8"></script>

    <!-- development version, includes helpful console warnings -->
	<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>

	<!-- vue code -->    
    <script type="module" src="/safety/layout/js/vue.js?v=2"></script>

    <!-- progress div-->
    <script src="/safety/layout/progres/progressbar.min.js"></script>

    <!-- Landing div-->
    <script src="/safety/layout/codepen/landing/script.js?v=3"></script>

  </body>

</html>