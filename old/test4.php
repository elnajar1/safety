<?php
	
	
	include $_SERVER['DOCUMENT_ROOT'] . '/safety/includes/header.php';

?>

	<div id = "report-container">
		
	</div>

<?php



	include $_SERVER['DOCUMENT_ROOT'] . '/safety/includes/footer.php';

?>

<script type="text/javascript">
	
	var settings = {
	  "async": true,
	  "crossDomain": true,
	  "url": "http://api.quran.com:3000/api/v3/chapters/1/",
	  "method": "GET",
	  "headers": {},
	  "data": "{}"
	}

	$.ajax(settings).done(function (data) {
	  //console.log(data);
	  	$.ajax('report.php', {
		    type: 'POST',  // http method
		    data: data ,  // data to submit
		    success: function (report_data) {
		       $('#report-container').html(report_data);
		    },
		    error: function (jqXhr, textStatus, errorMessage) {
		            $('p').append('Error' + errorMessage);
		    }
		});

	});

</script>
	
<?php
	
	#Done
		//verses_until
		//verses_count
	
	#

	#Advaced
		//line_count ( depend on verses count)