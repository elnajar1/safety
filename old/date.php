<?php
	
	include_once $_SERVER['DOCUMENT_ROOT'] . '/safety/includes/config.php';

	echo date('Y-m-d\Th:i') . "<br>";

	//echo strtotime( date('Y-m-d\Th:i') );

	//echo date( 'Y-m-d h:i' , strtotime( date('Y-m-d\Th:i') ));

	$tomorrow  = mktime(0, 0, 0, date("m")  , date("d")+1, date("Y"));

	$currentDate = date('Y-m-d');
	$currentDate = date('Y-m-d', strtotime($currentDate));
	   
	$startDate = date('Y-m-d', strtotime("01/09/2019"));
	$endDate = date('Y-m-d', strtotime("01/10/2019"));
	   
	if (($currentDate >= $startDate) && ($currentDate <= $endDate)){
	 
	}else{
	    echo "Current date is not between two dates";  
	}
echo $endDate.  '<br>' .   $currentDate .  '<br>' . $startDate;


