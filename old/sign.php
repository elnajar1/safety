<div class="container ">

	<!--sing in and up  -->
	<div id="singIn" class="row text-center" >
		<div class="col jumbotron rounded m-2">
		    
			<form method="post" action="index.php#singIn">
			    
				<div class="text-center ">
					<h2>
						تسجيل الدخول
					</h2> 
					<?php include('includes/login_errors.php'); ?> 
				</div>
				
				<div class="form-group text-left ">
					<label for="a">Email</label>
					<input type="email" name="email" id="a" placeholder="email" class="form-control">
				</div>
				
				<div class="form-group text-left ">
					<label for="b">Password</label>
					<input type="password" id="b" name="password" placeholder="passward" class="form-control">
				</div>
				
				<a href="#sing-up">creat new acount?</a><br>
			    <button type="submit" name="login" class="btn btn-secondary rounded ">
			    	تسجيل الدخول
			    </button>
			    
			</form>
			
			<!--
	        <a href="<?php echo $loginURL ?>" style="background : #597CC5 " class="w-100 btn d-block btn-block rounded  ">
			    <span class="text-white"> 
			     <i class="fab fa-facebook-square "></i> 
	             تسجيل الدخول عبر فيسبوك 
			    </span>
		    </a>
			-->
		</div>
		
		<div id="singUp" class="col my-2  rounded bg-muted">
		    
			<form method="post" action="index.php#singUp" enctype="multipart/form-data">
				
				<div class=" text-center">
					<h2 class=" text-muted"> 
						أنشي حساب جديد
					</h2> 
					<?php include('includes/errors.php'); ?>
				</div>
				
				<div class="form-group">
					<input type="text" name="yourname" placeholder="Your Name" class="form-control">
				</div>
				
				<div class="form-group">
					<input type="email" name="email" placeholder="E-mail" class="form-control">
				</div>
				
				<div class="form-group">
				    <input hidden type="text" name="username" placeholder="User Name" class="form-control">
				</div>

				<div class="form-group">
				    <input type="number" name="phone" placeholder="phone" class="form-control">
				</div>
				
				<div class="form-group">
					<input type="password" name="password_1" placeholder="Password" class="form-control">
				</div>
				
				<div class="form-group">
					<input type="password" name="password_2" placeholder="Confirm Password" class="form-control">
				</div>
					
				<div class="form-group"> 
				    <span class="d-block">
				    	اختر صورة شخصية
				    </span>
					 <input type="file" class="text-info" name="avatar" value="choose a profile photo" accept="image/*">
				</div>
					 
			    <button type="submit" name="signup" class="btn btn-white rounded">
			    	انشاء 
			    </button>

			</form>
			
		</div>
	</div><!-- /sing in and up  -->

</div>


