<?php

	include_once $_SERVER['DOCUMENT_ROOT'] . '/safety/includes/Mobile_Detect.php';
	include_once $_SERVER['DOCUMENT_ROOT'] . '/safety/includes/phone_name.php';
	$detect = new Mobile_Detect;

?>


<div class ="row text-center" >

	<div class="col-12">

		<?php if( $detect->isiPhone() == false ): ?>
		<!-- Modal -->
		<div class="modal fade" id="app_alert" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
		  <div class="modal-dialog">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h5 class="modal-title text-secondary font-weight-bold" id="staticBackdropLabel">
		        	<i class="fa fa-heart text-danger"></i>
		        	يابا احلي تطبيق عليك  
		    	</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>
		      <div class="modal-body">
		        <p class="text-muted">
		        	تطبيق  سهل وسريع  ان شاء الله وبطعم الفانليا 
		        </p>
		        <img src="/safety/uploads/gifs/app.gif" class="d-block w-75 m-auto">
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">
		        	مش دلوكتي 
		        </button>
		        <?php if( $detect->isAndroidOS() ): ?>
		        	<a href="/safety/app/android/safety.apk" download class="btn btn-primary">	
		        		تحميل  لاندرويد 
		        	</a>
		    	<?php endif; ?>

		    	<?php if( $detect->isMobile() == false ): ?>
		        	<a href="http://www.mediafire.com/file/cy1ae49g5n15ci4/safety.msi/file" target="_blank" class="btn btn-primary">	
		        		تحميل  للكمبيوتر 
		        	</a>
		    	<?php endif; ?>

		      </div>
		    </div>
		  </div>
		</div>
		<?php endif; ?>

	</div>
</div>

