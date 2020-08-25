<?php  if (count($myerrors) > 0) : ?>
  <div class="alert alert-warning">
  	<?php foreach ($myerrors as $myerror) : ?>
  	  <p><?php echo $myerror ?></p>
  	<?php endforeach ?>
  </div>
<?php  endif ?>
