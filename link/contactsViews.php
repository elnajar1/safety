<?php

	include $_SERVER['DOCUMENT_ROOT'] . '/safety/includes/header.php';

	if (empty($user_id)) {
	header("location: index.php");
	exit;
	}

	$link_id = filter_var ( $_GET['l'] , FILTER_SANITIZE_NUMBER_INT ) ;

	//views
	$sql = "SELECT * FROM  s_contact_views 
			LEFT JOIN s_contacts 
			ON s_contact_views.contact_id = s_contacts.id 
			WHERE s_contact_views.link_id = ?";
	$stmt = $pdo->prepare($sql);
	$stmt->execute([ $link_id ]);
	$views = $stmt->fetchall();

	//link
	$sql ="SELECT * FROM s_links WHERE id = ? AND user_id = ?";
	$stmt = $pdo->prepare($sql);
	$stmt->execute([ $link_id , $user_id]);
	$link = $stmt->fetch();

	//for security ,do not allow any user to access this page exept the owner
	if ($link['user_id'] !== $user_id ) {
		echo "Sorry, You con not access this page";
		exit;
	}

	//echo "<pre>";
	//var_dump($views);

?>

<div class="container-fluid text-right" style="direction: rtl;">

	<?php 
		//include 'includes/subMenu.php';
	 ?>
	<!-- link info  -->
	<div class=" row">
        <div class="col ">
        	<h4 class="m-4 pt-4 font-weight-bold text-secondary">
        		<?= $link['title'] ?>
        	</h4>
        </div>
    </div><!-- /link info  -->

	<div class="row" >
		<div class="col table-responsive">

			<table class="table table-striped table-hover table-sm">

				<thead class="thead-dark">
					<tr>
						<th scope="col">#</th>
						<th scope="col">
							الاسم
						</th>
						<th scope="col">
							 الهاتف
						</th>
						<th scope="col">
							اسم الجهاز  
						</th>
						<th scope="col">
							 معلومات الجهاز
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
							الاجهزة المحظورة 
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

							echo '<tr>';
							echo '<th scope="row">' . $i  . '</th>';
							echo '<td class="">'  . $view['name'] . '</td>';
							echo '<td class="">'  . $view['phone'] . '</td>';
							echo '<td class="dots">'  . $view['device_name'] . '</td>';
							echo '<td class="">'  . $view['device_info'] . '</td>';

							echo '<td class="dots">'  . $view['phone_visits'] . '</td>';
							echo '<td class="dots">'  . $view['pc_visits'] . '</td>';

							echo '<td class="dots">'  . $view['blocked_devices'] . '</td>';
							echo '<td>'  . $view['time'] . '</td>';
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

