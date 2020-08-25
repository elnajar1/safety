<?php

	include_once $_SERVER['DOCUMENT_ROOT'] . '/safety/includes/config.php';

		if (empty($user_id)) {
		header("location: index.php");
		exit;
	}

	include $_SERVER['DOCUMENT_ROOT'] . '/safety/includes/header.php';


	$link_id = filter_var ( $_GET['l'] , FILTER_SANITIZE_NUMBER_INT ) ;
	
	//links
	$sql ="SELECT * FROM s_links WHERE id = ? AND user_id = ?";
	$stmt = $pdo->prepare($sql);
	$stmt->execute([ $link_id , $user_id]);
	$link = $stmt->fetch();

    //playlists
    $sql ="SELECT * FROM s_playlists WHERE user_id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([ $user_id]);
    $playlists = $stmt->fetchall();


	$start_date = date('Y-m-d\TH:i', strtotime($link['start_date']) );
	//echo "<hr><br><br>" .  $start_date;

	$end_date = date('Y-m-d\TH:i', strtotime($link['end_date']) );

	//for security ,do not allow any user to access this page exept the owner
	if ($link['user_id'] !== $user_id ) {
		echo "Sorry, You con not access this page";
		exit;
	}

	//var_dump($link);

?>

<div class="container  text-right" style="direction: rtl;">

	<?php 
		//include 'includes/subMenu.php'; 
	?>
	<!--creat link  -->
	<div class=" row ">

		<div class="col-12">
        	<h1 class="m-4 font-weight-bold text-secondary">
        		<img src="https://img.icons8.com/bubbles/100/000000/edit.png"/>
        		 تعديل 
        		<?= $link['title'] ?>
        	</h1>
        </div>

        <div class="col-12 col-sm-6 rounded z-depth-1 bg-muted py-2">
            <form id="update-link-form" action="#" method="post"  >
            	
            	 <input type="text"  class="form-control"  name = "id" autofocus = "true" value="<?= $link['id'] ?>" hidden>

            	<div class="form-group">
            		<label for = "link"> 
                    	الرابط
                    </label>
                    <input type="text"  class="form-control" id = "link"  name = "link" autofocus = "true" value="<?= $link['link'] ?>" required>
                </div>

                <div class="form-group">
                    <label for = "link"> 
                        رابط البث          
                    </label>
                    <input type="text"  class="form-control" id = "link"  name = "m_link"  value="<?= $link['m_link'] ?>" placeholder = "اذا كنت لا تعلم ما هذا , اتركه فارغا ">
                </div>


                <div class="form-group">
                	<label for = "title"> 
                    	العنوان 
                    </label>
                    <input type="text"  class="form-control" id = "title"  name = "title" value="<?= $link['title'] ?>" placeholder="ماذا يحتوي هذا الرابط" required>
                </div>

                <div class="form-group">
                    <label for = "title"> 
                        عدد المشاهدات المسموح  به 
                    </label>
                    <input type="number"  class="form-control"  name = "allowed_views" value="<?= $link['allowed_views'] ?>" placeholder="" required>
                </div>


                <div class="form-group">
                	 <label for = "description"> 
                    	الوصف
                    </label>
                    <input type="text"  class="form-control" id = "description"  name = "description" value="<?= $link['description'] ?>">
                </div>
                

                <div class="form-group">
                     <label> 
                        اضف الي قائمة تشغيل 
                    </label>

                    <select name="playlist_id" class="custom-select" value="<?= $link['privacy'] ?>">
                        

                        <?php foreach( $playlists as $playlist ): ?>
                        
                            <option value="<?= $playlist['id'] ?>" 
                            <?php if ( $link['playlist_id'] == $playlist['id']): ?>
                                selected
                            <?php endif; ?>
                            >
                                <?= $playlist['name'] ?>    
                            </option>

                        <?php endforeach; ?>
                    </select>

                </div>

                <div class="form-group">
                	 <label> 
                    	الخصوصية
                    </label>

                    <select name="privacy" class="custom-select" value="<?= $link['privacy'] ?>">
                    	
                        <option value="available_for_all" 
                        <?php if ( $link['privacy'] ==  'available_for_all' ): ?>
                            selected
                        <?php endif; ?>
                        >
                    		متاح لكل جهات الاتصال
                    	</option>

                    	<option value="private"
                        <?php if ( $link['privacy'] ==  'private' ): ?>
                            selected
                        <?php endif; ?>
                        >
                    		 خاص - غير مرئي في القناة
                    	</option>

                    </select>

                </div>
                
                <div class="custom-control custom-checkbox" style="direction: rtl;">
					<input type="checkbox" class="custom-control-input"  name = "is_time_limited" id="is_time_limited" >
					<label class="custom-control-label"  for="is_time_limited">
						تحديد بوقت 
					</label>
				</div>

                <div class="form-group">
                	 <label > 
                    	هذا الفديو متاح  للمشاهدة من تاريخ  :
                    </label>

                    <input type="datetime-local"  class="timer form-control"  name = "start_date" value="<?= $start_date ?>"  disabled >
                </div>

                <div class="form-group">
                	 <label > 
                    	حتي تاريخ  : 
                    </label>

                    <input type="datetime-local"  class="timer form-control"  name = "end_date" value="<?= $end_date ?>" disabled >
                </div>

                <div id="link-is-updated-container"></div>

                <button type="submit" name="update_link"  class="btn btn-secondary rounded form-control z-depth-0 p-2">
                	تحديث
                </button>
            </form>
        </div>
    </div><!-- /create link  -->

</div>


<?php

	include $_SERVER['DOCUMENT_ROOT'] . '/safety/includes/footer.php';


?>

