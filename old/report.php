<?php
	
	
	echo '<pre>';

	var_dump($_POST);
	
	echo '</pre>';

	
	echo '<h1>'  . $_POST["chapter"]['name_arabic'] . '</h1>';

	$verses_count = (int)$_POST["chapter"]['verses_count'] + 1;

	var_dump($verses_count);

	for( $i = 3 ; $i < $verses_count ; $i++ ){
		echo $i . '<hr>'; 
	}

	//verse until
	//verses_until 3

	







	//line count ??????????????????

	include $_SERVER['DOCUMENT_ROOT'] . '/safety/includes/footer.php';

?>

