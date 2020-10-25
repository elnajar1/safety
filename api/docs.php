<?php
	
	
	include '../includes/header.php';

?>

	<div class="container">

		<div class="row">

			<div class="col-12" >
				
				<h1 class="font-weight-bold"> 
					API Documents 
				</h1>				
				<p class="text-muted"> 
					welcome Doumi Abdelmoumen 
				</p>
				
				<hr>
				<p> 
					<span class="text-danger"> Note :</span>
					 user = teacher | contact = student | link = video | playlist = دوره تعليمية 
				</p>
				
				<hr>


				<h2>
					User
				</h2>

				<h3> GET all users </h3>
				<code>
					<pre>https://freshweb.tech/safety/api/chanels/read.php</pre>
				</code>

				<h3> GET user info </h3>
				<code>
					<pre>https://freshweb.tech/safety/api/user/read.php?id={user_id}</pre>
				</code>
				
				<h3> GET user videos ( links) </h3>
				<code>
					<pre>https://freshweb.tech/safety/api/profile/read.php?id={user_id}</pre>
				</code>

				<h2>
					Contact
				</h2>

				<h3> GET contact playlists </h3>
				<code>
					<pre>https://freshweb.tech/safety/api/contact_playlists/read.php?p={phone_number}</pre>
				</code>

				<h2>
					playlist
				</h2>

	<h3> GET all playlists 
<span class = "badge badge-primary" >
 New 
</span>
</h3>
				<code>
					<pre>https://freshweb.tech/safety/api/all_playlists/read.php</pre>
				</code>


				<h3> GET playlists videos </h3>
				<code>
					<pre>https://freshweb.tech/safety/api/playlist_videos/read.php?id={playlist_id}</pre>
				</code>

				<h2>
					GET Video 
				</h2>
				

				<h3> New mehod </h3>
				<code>
					<pre>https://freshweb.tech/safety/api/ph/read.php?l={link_id}&p={phone_number}&device={device_id}</pre> 
				</code>

				<p class =  "text-muted" >
				you send phone number I check if he can access this video (link) and send video link or not and send error message  
				</p>		

				<h3> Old method ( I iframe the video in app by ) </h3>
				<code>
					<pre>< iframe src = 'https://freshweb.tech/safety/video.php?l={link_id}' >< / iframe ></pre>
				</code>

	</div>

		</div>

		
	</div>
	

<?php

	include '../includes/footer.php';


?>
<style>
h2{
	color : #21A465;
	border-left: 5px solid #11a56585;
	padding-left: 5px
} 

pre:hover{
	background-color: rgb(0,22,40 , 0.1);
}
</style>
