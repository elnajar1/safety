<?php

	include '../includes/header.php';

	include '../includes/config.php';

	if (empty($user_id)) {
	header("location: ../index.php");
	exit;
	}

	/*
		$sql ="SELECT s_contacts.* , SUM(s_contact_playlists.paid) AS 'paid' , SUM(s_playlists.cost) AS 'cost' FROM s_contacts 
		LEFT JOIN s_contact_playlists ON s_contacts.id = s_contact_playlists.contact_id
		LEFT JOIN s_playlists ON s_playlists.id = s_contact_playlists.playlist_id
		WHERE s_contacts.user_id = ?";
		*/
	//contacts
	$sql ="SELECT s_contacts.*  FROM s_contacts 
		WHERE s_contacts.user_id = ?";
	$stmt = $pdo->prepare($sql);
	$stmt->execute([ $user_id ]);
	$contacts = $stmt->fetchall();
	$count_contacts = $stmt->rowCount();
	//echo "<pre>";
	//var_dump($contacts);
	uasort($contacts, function($a, $b) { return strcasecmp($a['name'], $b['name']); });


	//Total paid
	$sql ="SELECT SUM(s_contact_playlists.paid) FROM s_contact_playlists , s_contacts
		WHERE s_contacts.user_id= ? AND s_contacts.id = s_contact_playlists.contact_id";
	$stmt = $pdo->prepare($sql);
	$stmt->execute([ $user_id ]);
	$contacts_total_paid = $stmt->fetchall();

	//total cost
	$sql ="SELECT SUM(cost) FROM s_playlists
	LEFT JOIN s_contact_playlists ON s_playlists.id = s_contact_playlists.playlist_id
		WHERE s_playlists.user_id= ? ";
	$stmt = $pdo->prepare($sql);
	$stmt->execute([ $user_id ]);
	$contacts_total_cost = $stmt->fetch();
	
	@$contacts_paid_presentag = $contacts_total_paid[0][0] / $contacts_total_cost[0] * 100 ;

	//echo "<pre>";
	//var_dump(  $contacts_total_paid );
	//echo "</pre>";

	//playlists
	$sql ="SELECT * FROM s_playlists WHERE user_id = ? ORDER BY id DESC";
	$stmt = $pdo->prepare($sql);
	$stmt->execute([ $user_id ]);
	$playlists = $stmt->fetchall();
	$count_playlists = $stmt->rowCount();


?>

<div class="container-fluid text-right" style="direction: rtl;">


	<?php if( $count_playlists == 0 ): ?>
		<div class="alert alert-warning text-center py-5 border">
			<i class="fas fa-plus  fa-3x animate__animated animate__flash animate__slower animate__infinite"></i>
			<p>
				يلزم  اولا انشاء قائمة تشغيل  واحدة علي الاقل  تقوم فيها بأضافة   المشتركين  
				<a href="/safety/playlist/createPlaylist.php"> من هنا </a>
			</p>
		</div>
	<?php endif; ?>

	<!--creat contact  -->
	<div class=" row py-5 bg-gradient">

        <div class="col col-sm-6 bg-white border z-depth-1 p-5 m-auto ">
        	<h2 class="m-4 font-weight-bold text-secondary">
        		أضف جهة اتصال جديدة 
        		<small class="d-block text-muted" style="font-size: 16px">
        			فقط  هولاء الاشخاص   يمكنهم مشاهدة الفديوهات الخاصة بك
        		</small>
        	</h2>

            <form id="add-contact-form" action="#" method="post"  >
            
            	<div class="form-group">
            		<label> 
                    	الاسم
                    </label>
                    <input type="text"  class="form-control" id = "name"  name = "name" required>
                </div>

                <div class="form-group">
                	<label for = "phone"> 
                    	رقم الهاتف 
                    </label>
                    <br>
                    <input style="direction: ltr" class="form-control"  name="phone" id="phone-input" type="tel" value= "" placeholder="+2123456789" required>
                    <small class="text-muted">
                    	ادخل رمز الدوله مصحوب ب + ثم الرقم 
                    </small>
                </div>

                <div class="form-group">
	                
	                <label> 
                    	مشترك  بـ
                    </label>

	                <select id="selectpic" class="selectpicker form-control" multiple title=" اختر قوائم التشغيل  المسموحة  " data-width="fit" data-style="btn-primary" required="">
					 	<?php foreach( $playlists as $playlist ): ?>
							<option value="<?= $playlist['id'] ?>"><?= $playlist['name'] ?></option>
						<?php endforeach; ?>

					</select>

					<input type="text" name="playlists" id="hidden_selectpic" hidden />


				</div>
                
                <div class="form-group">
                	<label class="font-weight-bold text-secondary"> 
                    	الدفع
                    </label>

                    <?php foreach( $playlists as $playlist ): ?>

                    	<div id = "input_<?= $playlist['id'] ?>" style = "display: none" class = "playlist-inputs py-1">
                    		<p class="d-inline">
                    			<?= $playlist['name'] ?>
                    				
                    		</p>
                    		<input type="number" class = "paid-input form-control w-50 d-inline" placeholder="المدفوع "  name="paid[]" min="0" max="<?= $playlist['cost'] ?>" value = "0" > 
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
                    <small class="text-muted d-none">
                    	( وكذالك  يستطيع المشاركين  الاشتراك والدفع عن طريق الموقع من صفحة القناه الخاصة بك  )
                    </small>
                </div>

                <div class="form-group">
                	<label for = "note"> 
                    	ملاحظه
                    </label>
                    <input type="text"  class="form-control" id = "note"  name = "note" placeholder="ملاحظة خاصة بك لجهة الاتصال هذة">
                </div>

                <button type="submit" name="add_contact"  class="btn btn-secondary form-control z-depth-1 p-2">
                	انشاء
                </button>
            </form>

            <div id="new-contact-container"></div>

        </div>
    </div><!-- /create contact  -->

   <!-- analysis  -->
   <div class="row">

        <div class="col">

	    	<div class="border rounded mt-4 text-center z-depth-1">
	           <span>
	           		<h2 class="d-inline-block">
	           			<?=  $count_contacts?>
	           		</h2>  
	           		<i class="fa fa-user text-muted"></i>
	           </span>
	           <p>
	           		مشترك 
	           </p>
	        </div>
		</div>

       <div class="col">

	    	<div class="border rounded mt-4 text-center z-depth-1">
	           <span>
	           		<h2 class="d-inline-block">
	           			<?=  $contacts_total_cost[0] ?> 
	           		</h2>
	           		<i class="fa fa-dollar-sign text-success"></i>
	           </span>
	           <p>
	           		اجمالي  السعر  المطلوب    تحصيلة 
	           </p>
	        </div>
		</div>


	   <div class="col-12 col-sm-6 text-center m-auto">

           <h3>
           		<?=  $contacts_total_paid[0][0] ?>
           		<i class="fa fa-hand-holding-usd text-secondary"></i>
           	</h3>	

	       <div class="progress "  style="height: 20px;font-size: 16px">
			  <div class="progress-bar bg-success" role="progressbar" style="width: <?= $contacts_paid_presentag ?>%;" aria-valuenow="<?= $contacts_paid_presentag ?>" aria-valuemin="0" aria-valuemax="100"><?= intval($contacts_paid_presentag) ?>%</div>
			</div>

	    	<p class="text-center">
				 اجمالي المدفوع  من اجمالي  سعر  قوائم التشغيل   
			</p>

	   </div>



   </div>

   <!-- /analysis  -->


	<div class="row" >
	
		<div class="col table-responsive text-center">

			<h1 class="m-4 pt-4 font-weight-bold text-secondary">
				 كل المشتركين 
			</h1>
			<table class="table table-striped table-hover table-sm">

				<thead class="thead-dark" >
					<tr>
						<th scope="col">#</th>
						<th scope="col">
							الاسم
						</th>
						<th scope="col">
							رقم الهاتف
						</th>

						<th scope="col">
							ملاحظات 
						</th>

						<!--
						<th scope="col" style="direction: rtl">
							<span class="text-success">
								المدفوع 
							</span>
							/
							اجمالي السعر
						</th>
						-->
						
						<th scope="col">
							الحالة 
						</th>

						<th scope="col">
							شاهد  
						</th>

						<th scope="col">
							<i class="far fa-edit"></i>
						</th>

						<th scope="col">
						 	<i class="fas fa-info-circle"></i>
						</th>
					</tr>
				</thead>

				<tbody>

					<?php

						$i = 1;
						foreach ($contacts as $contact ) {

							echo '<tr>';
							echo '<th scope="row">' . $i  . '</th>';
							echo '<td>'  . $contact['name'] . '</td>';
							
							//phone
							echo '<td style = "direction: ltr">'; 

							echo '<a href = "https://wa.me/' . str_replace("+","",$contact['phone']) .  '" target = "_blank"><i class="fab fa-whatsapp text-success"></i> ' . $contact['phone'] . ' </a>';
							echo '</td>';
							
							echo '<td class="dots">'  . $contact['note'] . '</td>';

							//echo '<td>'  . $contact['cost'] . '/<span class = "text-success">' . $contact['paid'] . '</span></td>';
		
							
							
							if( $contact['status'] == true ){

								echo '<td>مسموح </td>';

							}else{

								echo '<td class = "bg-danger">معطل </td>';

							}

						    //link who from countacts view count 
			                $sql ="SELECT * FROM s_contact_views 
			                WHERE contact_id = ?  AND pc_visits + phone_visits > 0 ";
			                $stmt = $pdo->prepare($sql);
			                $stmt->execute([ $contact['id'] ]);
			                $link_count = $stmt->rowCount();
			                echo'<td><a href = "contactLinkViews.php?c=' . $contact['id'] . '"><i class="fas fa-video text-muted" style="font-size: 14px" ></i>  ' .  $link_count   . '<span  class= "text-primary border-bottom"> عرض   </span></a></td>' ;


							echo '<td><a href = "'  . $domain . $root . '/contact/editeContact.php?c=' . $contact['id'] . '" class = "text-primary border-bottom"> تعديل  </a></td>';

							echo "<td><a href= '#' id =" . $contact['id'] . " class = 'show_contact_info'> المزيد  </a></td>";

							echo '</tr>';
							$i++;
						}
					?>

				</tbody>

				</table>
		</div>
	</div>

	<div class="row">
		<div class="col-12">
			<!-- Full Height Modal Right -->
			<div id = "show_contact_info_model" class="modal fade right" id="fullHeightModalRight" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
			  aria-hidden="true">

			  <div class="modal-dialog modal-full-height modal-right" role="document">


			    <div class="modal-content">
			      <div class="modal-header">
			        <h4 class="modal-title w-100" id="myModalLabel"> معلومات  </h4>
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			          <span aria-hidden="true">&times;</span>
			        </button>
			      </div>
			      <div class="modal-body">

			      </div>
			      <div class="modal-footer justify-content-center">
			        <button type="button" class="btn btn-secondary" data-dismiss="modal"> اغلاق  </button>
			      </div>
			    </div>
			  </div>
			</div>
			<!-- Full Height Modal Right -->
		</div>
	</div>
</div>




<?php

	include $_SERVER['DOCUMENT_ROOT'] . '/safety/includes/footer.php';
	
?>

