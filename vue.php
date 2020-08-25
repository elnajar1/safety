<?php


	include $_SERVER['DOCUMENT_ROOT'] . '/safety/includes/header.php';

?>

<div class="container-fluid text-right" style="direction: rtl;" >

	<div class="row">

		<div class="col" >
			<p v-if="title"> welcome {{ title }} to vue world en'sha Allah </p>
			<hr>
			<input type="" v-model = "title">
		</div>

		<div class="col">
		</div>
		
	</div>

</div>


<?php

	include $_SERVER['DOCUMENT_ROOT'] . '/safety/includes/footer.php';

?>

<script type="text/javascript">
	
	import VueEllipseProgress from 'vue-ellipse-progress';
 
	Vue.use(VueEllipseProgress);
 
</script>

