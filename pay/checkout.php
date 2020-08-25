<?php

	include '../includes/header.php';
	include_once '../includes/Mobile_Detect.php';
	include_once '../includes/phone_name.php';
	$detect = new Mobile_Detect;

	//pay api 

	//if pay is success -> save it in DB and go to profile/index.php
?>
	<iframe src="https://accept.paymob.com/api/acceptance/iframe/43277?token=ZXlKaGJHY2lPaUpJVXpVeE1pSXNJblI1Y0NJNklrcFhWQ0o5LmV5SmxlSEFpT2pFMU9UZ3pNakl5T1RVc0luQm9ZWE5vSWpvaU5EZGpaamt6TURVMU9HRmtNR1F4T0RZM09EWmlPR05oWXpOa1lqVTRNVFZtWVRVMk56QmpZV0UxTTJVNE4ySmtOemxrTUdVNU1XTXdZemMyWm1RMlpDSXNJbU5zWVhOeklqb2lUV1Z5WTJoaGJuUWlMQ0p3Y205bWFXeGxYM0JySWpveE5EazFPWDAuaC1SWDViT3RLNHJqMEhHVVkwb1JIWWRSQk80SjFuRWpYSkwxeXJEYjY2T0FLX0dlRzVGV3ZlWDQwX3UyMGZmR0JxQU8yTHBVdU5SbE5pczFRUUQ1TVE=" width="100%" height="1000px"></iframe>
<?php

	include '../includes/footer.php';


?>

