<?php

	
	include '../includes/config.php';

	if (empty($user_id)) {
		header("location: ../index.php");
		exit;
	}

	include '../includes/header.php';
	include_once '../includes/Mobile_Detect.php';
	include_once '../includes/phone_name.php';
	$detect = new Mobile_Detect;

	//create playlist


?>
	
<div class="container">
	<div class="row">
		<div class="col text-center" style="height: 100vh;direction: rtl">
			
			<div class="my-5">

				<h1 class="font-weight-bold text-secondary">
					انشاء  دورة  التعليمية  للفدوهات 
				</h1>

				<p class="text-muted">
					الدورات التعليمية  (قائمة التشغيل  ): هي  قائمة  تضيف فيها مجموعة من فديوهاتك , ويمكنك اتاحتها لمن تختارة فقط من جهات اتصالك  , ويمكنك بيعها عن طريق الموقع  في  قناتك 
				</p>

			</div>

			<form class="m-sm-5" method="post" action="playlists.php">

				<div class="form-group">

            		<label for = "contact"> 
                    	الاسم
                    </label>
                    <input type="text"  class="form-control"  name = "name" autofocus = "true" placeholder="اسم  قائمة التشغيل " required>

                </div>

                <div class="form-group">

            		<label for = "contact"> 
                    	السعر 
                    </label>
                    <input type="number"  class="form-control"  name = "cost" placeholder=" جنية  مصري " required>
                    <small class="text-muted">
                    	هذا السعر يستخدم في بيعها عن طريق الموقع وفي  الاحصائيات 
                    </small>
                </div>

                <button type="submit" name="create_playlist" class="btn btn-primary rounded">
                	انشاء 
                </button>

			</form>
		
		</div>
	</div>
</div>
<?php

	include '../includes/footer.php';


?>

