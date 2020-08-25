<?php
	
	
	include $_SERVER['DOCUMENT_ROOT'] . '/safety/includes/header.php';

	
?>	

<style type="text/css">
.iframe-container {
	position: relative;
}


.locker{
	position: absolute;
	z-index: 2;
	top: 0;
	height: 100%;
	display: block;
  	animation: example 0.2s  infinite reverse;
	width: 100%;
	background: yellow; 
}

@keyframes example {
  from {height: 100%;}
  to {height: 0%;}
}


.lockedframe {

 z-index: 1; 

}
</style>

<div class="container-fluid" style="direction: rtl;">
	<div class="row">
		<div class="col col-sm-6">

			<div class = "iframe-container"  style="width: 100%" height="315">
				<div class="locker"></div>
				<iframe class = "lockediframe" style="width: 100%"  height="315" src="https://www.youtube.com/embed/oakoNKyk_I8?version=3&vq=hd720" frameborder="0" modestbranding="1" allow="accelerometer; autoplay; encrypted-media; gyroscope"  sandbox="allow-same-origin allow-scripts " ></iframe>
			</div>

			<a href="#">goooooooooooole</a>

			<object width="800" height="450" data="http://www.youtube.com/embed/nmZcGPIrojI/@Model.YoutubeId&rel=0&modestbranding=1"></object>

		</div>
	</div>
</div>

<?php

	include $_SERVER['DOCUMENT_ROOT'] . '/safety/includes/footer.php';


?>
