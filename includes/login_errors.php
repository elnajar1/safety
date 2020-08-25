<?php  if (count($loginErrors) > 0) : ?>
  <div class="alert alert-warning">
  	<?php foreach ($loginErrors as $error) : ?>
  	  <p><?php echo $error ?></p>
  	<?php endforeach ?>
  </div>
<?php  endif ?>
