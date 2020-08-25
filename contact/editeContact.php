<?php

	include '../includes/config.php';

		if (empty($user_id)) {
		header("location: ../index.php");
		exit;
	}

	include '../includes/header.php';


	$contact_id = filter_var ( $_GET['c'] , FILTER_SANITIZE_NUMBER_INT ) ;
	
	//contacts
	$sql ="SELECT * FROM s_contacts WHERE id = ? AND user_id = ?";
	$stmt = $pdo->prepare($sql);
	$stmt->execute([ $contact_id , $user_id]);
	$contact = $stmt->fetch();
    
    //user playlists
    $sql ="SELECT * FROM s_playlists WHERE user_id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([ $user_id]);
    $playlists = $stmt->fetchall();

    //contact playlist
    $sql ="SELECT * FROM s_contact_playlists WHERE contact_id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([ $contact_id ]);
    $his_playlists = $stmt->fetchall(); //his = contact

    $his_playlists_id = array_column( $his_playlists , 'playlist_id' );
    $his_playlists_paid = array_column( $his_playlists , 'paid' );
    $his_playlists_id_paid = array_combine( $his_playlists_id , $his_playlists_paid );

	//for security ,do not allow any user to access this page exept the owner
	if ($contact['user_id'] !== $user_id ) {
		echo "Sorry, You con not access this page";
		exit;
	}

    //echo "<pre>";
	//var_dump($his_playlists_id);

?>

<div class="container text-right" style="direction: rtl;">

	<?php 
		//include 'includes/subMenu.php'; 
	?>
	<!-- contact  -->
	<div class=" row">

		<div class="col-12">
        	<h1 class="m-4 font-weight-bold text-secondary">
        		<img src="https://img.icons8.com/bubbles/100/000000/edit.png"/>
        		 تعديل 
        		<?= $contact['name'] ?>
        	</h1>
        </div>

        <div class="col-12 col-sm-6 bg-muted rounded py-2">
            <form id="update-contact-form" action="#" method="post"  >
            	
            	 <input type="text"  class="form-control"  name = "id" autofocus = "true" value="<?= $contact['id'] ?>" hidden>

            	<div class="form-group">
            		<label for = "contact"> 
                    	الاسم
                    </label>
                    <input type="text"  class="form-control" id = "contact"  name = "name" autofocus = "true" value="<?= $contact['name'] ?>" required>
                </div>

                <div class="form-group">
                	<label> 
                        الرقم
                    </label>
                    <input type="text" style = "direction: ltr"  class="form-control" name = "phone" value="<?= $contact['phone'] ?>" required>
                </div>

                <div class="form-group">
                	 <label for = "description"> 
                    	ملاحظه 
                    </label>
                    <input type="text"  class="form-control" id = "note"  name = "note" value="<?= $contact['note'] ?>">
                </div>
                      
                <div class="form-group">
                    
                    <label> 
                        مشترك بـ
                    </label>

                    <select id="selectpic" class="selectpicker form-control" multiple title=" اختر قوائم التشغيل  المسموحة  " data-width="fit" data-style="btn-primary" required="">
                      
                        <?php foreach( $playlists as $playlist ): ?>
                            <option value="<?= $playlist['id'] ?>" 

                                <?php if ( in_array( $playlist['id'] , $his_playlists_id ) ): ?>
                                <?php echo 'selected'; endif; ?>

                            >
                                <?= $playlist['name'] ?>
                            </option>
                        <?php endforeach; ?>

                    </select>

                    <input type="text" name="playlists" id="hidden_selectpic" hidden />


                </div>
                
                <div class="form-group">
                    <label class="font-weight-bold text-secondary"> 
                        الدفع
                    </label>

                    <?php foreach( $playlists as $playlist ): ?>

                        <div id = "input_<?= $playlist['id'] ?>"

                                <?php if ( !in_array( $playlist['id'] , $his_playlists_id ) ): ?>
                                <?php echo 'style = "display: none" '; endif; ?> 
                            
                            class = "playlist-inputs py-1">

                            <p class="d-inline">
                                <?= $playlist['name'] ?>
                                    
                            </p>
                            <input type="number" class = "paid-input form-control w-50 d-inline" placeholder="المدفوع "  name="paid[]" min="0" max="<?= $playlist['cost'] ?>" value = "<?= $his_playlists_id_paid[ $playlist['id'] ] ?>"

                            <?php if ( in_array( $playlist['id'] , $his_playlists_id ) ): ?>
                            <?php echo 'required'; endif; ?> 

                            > 

                            <p class="d-inline">
                            / <?= $playlist['cost'] ?> جنية مصري 
                            </p>
                        </div>

                    <?php endforeach; ?>

                    
                </div>
                
                <div class="form-group">
                    <label for = "note"> 
                        طريقة الدفع 
                    </label>
                    <input type="text"  class="form-control" value="يدوي بواستطك " disabled>
                    <small class="text-muted">
                        ( وكذالك  يستطيع المشاركين  الاشتراك والدفع عن طريق الموقع من صفحة القناه الخاصة بك  )
                    </small>
                </div>


                <div class="custom-control custom-checkbox" style="direction: rtl;">
					<input type="checkbox" class="custom-control-input"  name = "status" id="status" 

                    <?php
                        if ($contact['status'] == 0 ) {
                            echo "checked";
                        }
                    ?>

                    >
					<label class="custom-control-label"  for="status">
						تعطيل 
					</label>
				</div>

                <div id="contact-is-updated-container"></div>

                <button type="submit" name="update_contact"  class="btn btn-secondary rounded form-control z-depth-0 p-2">
                	تحديث
                </button>

            </form>

            <a href="deleteDevices.php?c=<?=  $contact_id ?>" class = "btn btn-outline-warning text-dark m-3 rounded d-block">
                تصفير الاجهزة
            </a>

            <a href="deleteView.php?c=<?=  $contact_id ?>" class = "btn btn-outline-secondary m-3 rounded d-block">
                تصفير الاجهزة والمشاهدات 
            </a>
        </div>
    </div><!-- / contact  -->

</div>


<?php

	include $_SERVER['DOCUMENT_ROOT'] . '/safety/includes/footer.php';


?>
<script type="text/javascript">
    $('#hidden_selectpic').val($('#selectpic').val());
</script>
