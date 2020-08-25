<?php

	include '../includes/header.php';
	include_once '../includes/Mobile_Detect.php';
	include_once '../includes/phone_name.php';
	$detect = new Mobile_Detect;

	//get phone

	//if the user had been added it to  this playlist -> go to profile/index.php 

	//if he paid this playlist before -> go to profile/index.php 

	//if he had filled his info in this page before -> go to checkout.php

	//if he not all of the obove ->  fill your info now in this page

	//user playlists
	$sql = "SELECT * FROM  s_contact_views 
			LEFT JOIN s_contacts 
			ON s_contact_views.contact_id = s_contacts.id 
			WHERE s_contact_views.link_id = ?";
	$stmt = $pdo->prepare($sql);
	$stmt->execute([ $link_id ]);
	$views = $stmt->fetchall();
	  
?>
	<div class="container">
		<div class="row">
			
			<div class="col">
				
				<form method="post" action="checkout.php">
					
                <div class="form-group">
                	<label> 
                        رقم الهاتف 
                    </label>
                    <input type="text"  class="form-control" name = "phone" value="" disabled required>
                </div>

                <div class="form-group">
                	<label> 
                        الاسم 
                    </label>
                    <input type="text"  class="form-control" name = "name" value="" disabled required>
                </div>

                <div class="form-group">
                	<label> 
                        اختر قوائم التشغيل   التي ستشتريها 
                    </label>
                    <input type="text"  class="form-control" name = "name" value="" disabled required>
                </div>

				</form>

			</div>

		</div>
	</div>

<?php

	include '../includes/footer.php';


?>

