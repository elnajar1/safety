<?php


	//include $_SERVER['DOCUMENT_ROOT'] . '/safety/includes/header.php';

?>
<link rel="stylesheet" type="text/css" href="https://unpkg.com/plyr@3/dist/plyr.css">

<div class="container-fluid text-right" style="direction: rtl;" >

	<div class="row">

		<div class="col" >
			<div id="player" data-plyr-provider="youtube" data-plyr-embed-id="bTqVqk7FSmY"></div>
		</div>

	</div>

</div>


<?php

	//include $_SERVER['DOCUMENT_ROOT'] . '/safety/includes/footer.php';

?>

<script src="https://cdn.polyfill.io/v2/polyfill.min.js?features=es6,Array.prototype.includes,CustomEvent,Object.entries,Object.values,URL"></script>
<script src="https://unpkg.com/plyr@3"></script>

<script type="text/javascript">
	
	// Change "{}" to your options:
	// https://github.com/sampotts/plyr/#options
	const player = new Plyr('#player', {
		disableContextMenu : true
	});

	// Expose player so it can be used from the console
	window.player = player;

</script>

