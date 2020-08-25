<?php

	include '../includes/header.php';

	if (empty($user_id)) {
	header("location: ../index.php");
	exit;
	}

	$c = filter_var ( $_GET['c'] , FILTER_SANITIZE_NUMBER_INT ) ;

	//views
	$sql = "SELECT * FROM  s_contact_views 
			LEFT JOIN s_links 
			ON s_contact_views.link_id = s_links.id 
			WHERE s_contact_views.contact_id = ?";
	$stmt = $pdo->prepare($sql);
	$stmt->execute([ $c ]);
	$view_count = $stmt->rowCount();
	$views = $stmt->fetchall();

	//link
	$sql ="SELECT * FROM s_contacts WHERE id = ? AND user_id = ?";
	$stmt = $pdo->prepare($sql);
	$stmt->execute([ $c , $user_id]);
	$contact = $stmt->fetch();

	//for security ,do not allow any user to access this page exept the owner
	if ($contact['user_id'] !== $user_id ) {
		echo "Sorry, You con not access this page";
		exit;
	}
	
	//echo "<pre>";
	//var_dump($views);

	//link is realy viewed - count 
    $sql ="SELECT * FROM s_contact_views 
    WHERE contact_id = ?  AND pc_visits + phone_visits > 0 ";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([ $contact['id'] ]);
    $link_count = $stmt->rowCount();

?>

<div class="container-fluid text-right" style="direction: rtl;">

	<div class=" row my-3">
        <div class="col-5 border-left text-center">
        	<h1 class="display-1">
        		<span class="display-3">
        			<i class="fas fa-eye text-dark "></i>
        		</span>
        		 <?= $view_count  ?>
        	</h1>
        	<h1>
        		زيارة  
        	</h1>
        </div>

        <div class="col-5  text-center">
        	<h1 class="display-1">
        		<span class="display-3">
        			<i class="fas fa-video text-success"></i>  
        		</span>
        		 <?= $link_count ?>
        	</h1>
        	<h1>
        		زيارة وشاهد الفديو    
        	</h1>
        </div>

    </div>

	<!-- link info  -->
	<div class=" row">
        <div class="col ">
        	<h4 class="m-4 pt-4 font-weight-bold text-secondary">
        		 <span class="text-dark">
        		 	شاهد 
        		 </span>
        		 
        		 <?= $contact['name'] ?>
        	</h4>
        </div>
    </div><!-- /link info  -->

	<div class="row" >
		<div class="col table-responsive">

			<table class="table table-striped table-dark table-sm">

				<thead class="thead-dark">
					<tr>
						<th scope="col">#</th>
						<th scope="col">
							عنوان الفديو 
						</th>
						<th scope="col">
							اسم الجهاز  
						</th>

						<th scope="col">
							<i class="far fa-eye text-secondary"></i>
							<i class="fas fa-mobile-alt"></i>
						</th>
						<th scope="col">
							<i class="far fa-eye text-secondary"></i>
							<i class="fas fa-desktop"></i>
						</th>

						<th scope="col">
							ووقت اخر زيارة 
						</th>


					</tr>
				</thead>

				<tbody>

					<?php

						$i = 1;
						foreach ($views as $view ) {

							if ( $view['phone_visits'] + $view['pc_visits']  > 0 ) {
								echo '<tr class="bg-success">';
							}else{
								echo '<tr>';
							}

							echo '<th scope="row">' . $i  . '</th>';


							echo '<td class="">';

							if ( $view['title'] == "") {
								echo " فديو  تم حذفة  ";
							}else{
								echo $view['title'] ;
							}

							echo '</td>';
							
							echo '<td class="dots">'  . $view['device_name'] . '</td>';
							
							echo '<td class="dots">'  . $view['phone_visits'] . '</td>';
							echo '<td class="dots">'  . $view['pc_visits'] . '</td>';

							echo '<td>'  . $view[9] . '</td>';
							echo '</tr>';
							$i++;
						}
					?>

				</tbody>

				</table>
		</div>
	</div>

</div>




<?php

	include $_SERVER['DOCUMENT_ROOT'] . '/safety/includes/footer.php';


?>

