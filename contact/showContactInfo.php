<?php

	include '../includes/config.php';

	$contact_id = filter_var($_POST['c'] , FILTER_SANITIZE_NUMBER_INT );


	if ( !empty($contact_id) && !empty($user_id) ) {
		
			//contacts
			$sql ="SELECT * FROM s_contacts WHERE id = ?";
			$stmt = $pdo->prepare($sql);
			$stmt->execute([ $contact_id ]);
			$contact = $stmt->fetch();

			//his playlists
			$sql ="SELECT * FROM s_contact_playlists 
			LEFT JOIN s_playlists ON s_playlists.id = s_contact_playlists.playlist_id
				WHERE s_contact_playlists.contact_id = ?";
			$stmt = $pdo->prepare($sql);
			$stmt->execute([ $contact_id ]);
			$contact_playlists = $stmt->fetchall();

			$i = 1;

			?>

				<div style="direction: rtl">

					<h1 class="text-secondary">
						<?= $contact['name'] ?>
					</h1>
					<hr>
					<p>
						رقم الهاتف  : 
						<?= $contact['phone'] ?>
					</p>
					<p>
						ملاحظات  : 
						<?= $contact['note'] ?>
					</p>

					<h1>
						مشترك بـ
					</h1>
					<hr>

					<table class="table">
					  <thead>
					    <tr>
					      <th scope="col">#</th>
					      <th scope="col"> اسم قائمة التشغيل  ( الدورة ) </th>
					      <th scope="col"> المدفوع  </th>
					      <th scope="col"> السعر  </th>
					    </tr>
					  </thead>
					  <tbody>

					  	<?php foreach ($contact_playlists as $playlist) : ?>
					  		 <tr>
						      <th scope="row"><?= $i ?></th>
						      <td><?= $playlist['name'] ?></td>
						      <td class="text-success"><?= $playlist['paid'] ?></td>
						      <td><?= $playlist['cost'] ?></td>
						    </tr>
						<?php $i++; endforeach; ?>

					  </tbody>
					</table>
				
				</div>
			<?php


	}

	
?>




