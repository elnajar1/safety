<?php

	include $_SERVER['DOCUMENT_ROOT'] . '/safety/includes/config.php';
	include_once $_SERVER['DOCUMENT_ROOT'] . '/safety/includes/Mobile_Detect.php';
	include_once $_SERVER['DOCUMENT_ROOT'] . '/safety/includes/phone_name.php';
	$detect = new Mobile_Detect;

	//filter_var($_POST['name'] , FILTER_SANITIZE_STRING )
	//filter_var ( $_GET['c'] , FILTER_SANITIZE_NUMBER_INT ) ;
	
	//get phone
	$phone = $_COOKIE['f'];
	$targeted_playlist_id = $_GET['playlist_id'];

	/*
	if (empty($targeted_playlist_id)) {
		header("location: index.php");
		exit;
	}
	*/
	//playlist info
	$sql = "SELECT * FROM  s_playlists  
			WHERE id = ?";
	$stmt = $pdo->prepare($sql);
	$stmt->execute([ $targeted_playlist_id ]);
	$targeted_playlist = $stmt->fetch();

	//all user playlists
	$sql = "SELECT * FROM  s_playlists  
			WHERE user_id = ?";
	$stmt = $pdo->prepare($sql);
	$stmt->execute([ $targeted_playlist['user_id'] ]);
	$user_playlists = $stmt->fetchall();

	//had been added before?
	$sql = "SELECT * FROM  s_contacts  
			WHERE phone = ? AND user_id = ? AND wanted_playlists_ids = ?";
	$stmt = $pdo->prepare($sql);
	$stmt->execute([ '+' . trim($phone) ,  $targeted_playlist['user_id'] , $targeted_playlist_id  ]);
	$contact = $stmt->fetch();

	//if the user had been added it to  this playlist -> go to profile/index.php 
	if( $contact['added_by'] == 'user' ):

		echo '<div class = "alert alert-sussess py-5"> لقت تمت  أضافتك الي  هذة الدورة  بواسطتة صاحبها , لذالك انت لا تحتاج الي شرائها مرة  اخري  , حمل  التطبيق  وسجل دخولك برقم هاتفك هذا وانتعش   </div>'; 
		exit;

	//if he paid this playlist before -> go to profile/index.php 
	elseif( $contact['added_by'] == 'site' && $contact['is_paid'] == 1 ):
		
		echo  '<div class = "alert alert-sussess py-5"> لقد قمت بالفعل بشراء هذه الدوره من  قبل  , حمل  التطبيق  وسجل دخولك برقم هاتفك هذا وانتعش   </div>';
		exit;

	//if he had filled his info in this page before -> go to checkout.php
	elseif(  $contact['added_by'] == 'site' && $contact['is_paid'] == 0 ):
		
		header("location: checkout.php?not_paid_contact_id=" . $contact['id'] );
		exit;

	//if he not all of the obove ->  fill your info now in this page
	else:

	endif;
	
	var_dump($contact);

	include $_SERVER['DOCUMENT_ROOT'] . '/safety/includes/header.php';
?>
	<div class="container text-right" style="direction: rtl">

		<div class="row my-3">
			
			<div class="col">
				<h2 class="font-weight-bold text-secondary">
					2 - ادخل بياناتك
				</h2>
			</div>

		</div>

		<div class="row my-1">
			<div class="col p-1 mx-1" style="background: #3CD070"></div>
			<div class="col p-1" style="background: #3CD070"></div>
			<div class="col p-1 mx-1" style="background: #f2f2f2;"></div>
		</div>

		<div class="row">
			
			<div class="col col-md-8 m-auto">
				
				<form method="post" action="checkout.php">
					
                <div class="form-group">
                	<label> 
                        رقم الهاتف 
                    </label>
                    <input type="text"  class="form-control" value="<?= '+' . $phone ?>" disabled style = "direction: ltr;text-align: right;">
                    <input type="text"  class="form-control" name = "phone" value="<?= $phone ?>" hidden>
                </div>

                <div class="form-group">
                	<label> 
                        الاسم 
                    </label>
                    <input type="text"  class="form-control" name = "name" value="" required>
                </div>

             	<div class="form-group">
                	<label> 
                		البريد الالكتروني  ( اختياري )
                    </label>
                    <input type="email"  class="form-control" name = "email" value="">
                </div>

                <div class="form-group">
                	<label> 
                        اختر قوائم التشغيل   التي ستشتريها 
                    </label>

                	<select id="selectpic" class="selectpicker form-control" multiple title=" اختر قوائم التشغيل  المسموحة  " data-width="fit" data-style="btn-primary" required="">

					    <?php foreach( $user_playlists as $user_playlist ): ?>
	                        <option value="<?= $user_playlist['id'] ?>" 

	                            <?php if ( $user_playlist['id'] == $targeted_playlist_id ): ?>
	                            <?php echo 'selected'; endif; ?>

	                        >
	                            <?= $user_playlist['name'] ?>
	                        </option>
	                    <?php endforeach; ?>

					</select>

					<input type="text" name="playlists" id="hidden_selectpic" value="<?= $targeted_playlist_id ?>"  />

                </div>

                <div class="form-group">
                	<hr>
                	<h3>
	                	اجمالي السعر  : 

	                	<span id ="price" class="font-weight-bold text-info">
	                		<?= $user_playlist['cost'] ?>
	                	</span>
	                	
	                	جنية مصري 

                	</h3>
                </div>

                <div class="form-group">
                	<input type="submit" class="btn btn-success btn-block z-depth-0 " name="pay" value = "الدفع " style="font-size: 20px">
                </div>


				</form>

			</div>

		</div>
	</div>

<?php

	include '../includes/footer.php';

?>
<script type="text/javascript">
	$('#selectpic').change(function(){

		var playlistArray = $('#selectpic').val().toString().split(",");

		$.ajax({
			url : "price.php", 
			type : "POST", 
			data : {
				'playlist_array' : playlistArray 
			}, 
			beforeSend : function(){
				$("#price" ).html(' .... ');
			}, 
			success:  function(data){

				$('#price').html(data);

			}
		});
			
	});
</script>
