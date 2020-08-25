<?php
	
	include "includes/config.php";

	if ( isset($user_id) ){
		header("location: dashboard.php");
		exit;
	}
	
	include $_SERVER['DOCUMENT_ROOT'] . '/safety/includes/header.php';

	//style=" background: radial-gradient(ellipse at bottom, #1b2735 0%, #090a0f 100%); height: 100vh;"
?>

	<div class="container-fluid ">



		<div class="row">

			<div class="col" >
				
				<link rel="stylesheet" href="/safety/layout/codepen/landing/style.css?v=3">				
				<!-- partial:index.partial.html -->
				<header>
					<nav>
						<div class="logo">
							<h1>Safety <span> | FreshWeb</span></h1>
						</div>
						</ul>
					</nav>
				</header>
				<!-- MIDDLE CONTENT -->
				<div class="middle-header">
					<div class="main">
						<!-- TYPER -->
						<h1 class="aqua" style="min-height: 40vh"><i class="fas fa-video"></i></h1>
						<!-- TYPER END -->
						<div class="line"></div>
						<p>اسمح لاشخاص محددة فقط في مشاهدة فديوهاتك العظيمة </p>
						
						<button>
							<a href = "#creatAcount">
								انشر فديوهاتك الان 
							</a>
							<i class="far fa-arrow-alt-circle-down"></i></button>
					</div>
				</div>
				<!-- partial -->
				 

			</div>
				

		</div>
		
		<div class="row" id="creatAcount" style="height: 100vh">

			<div class="col-12 m-auto" >
				
				<p class="display-3  text-center text-muted font-weight-light" >
					هل تريد حماية فديوهاتك ؟  أنشي  حساب  للاشتراك
				</p>

			</div>

		</div>

		<div class="row">

			<div class="col-12" >
				
				<?php include 'includes/sign.php'; ?>


			</div>

		</div>
		
	</div>	
	


		<div class="row" style="height: 25vh">

			<div class="col-12 m-auto" >
				
				<p class="display-3  text-center text-muted font-weight-light" >
					كيف تعمل ؟؟
				</p>

			</div>

		</div>

	<div class="row text-center p-3">

			<div class="col-12 col-sm-4 pt-4" >
				
				<img src="https://img.icons8.com/cute-clipart/64/000000/enter-2.png" class = 'd-block m-auto'/>

				<p>

					انشي حاب خاص بك في الموقع 

				</p>

			</div>


			<div class="col-12 col-sm-4" >
				<img src="https://img.icons8.com/bubbles/100/000000/contacts.png" class = 'd-block m-auto'/>
				<p>
					اضف ارقام هواتف الاشخاص المراد السماح لهم بالمشاهدة 
				</p>

			</div>

			<div class="col-12 col-sm-4" >
				<img src="https://img.icons8.com/cute-clipart/64/000000/youtube-play.png" class = 'd-block m-auto'/>
				<p>
					اضف فديوهاتك   وانتعش 
				</p>

			</div>

		</div>
		
	</div>	

	<div class="row">

		<div class="col">
			<hr>
			<?php include 'app/app.php'; ?>


		</div>

	</div>
	

<?php
	
	include $_SERVER['DOCUMENT_ROOT'] . '/safety/includes/footer.php';


?>

