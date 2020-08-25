$(document).ready(function(){
    
     //show_contact_info
	$('.show_contact_info' ).click(function(e){
		e.preventDefault();
	    e.stopImmediatePropagation();
	        
	    var contactId = this.id;
		
		$.ajax({
			url : "showContactInfo.php", 
			type : "POST", 
			data : { "c" : contactId }, 
			beforeSend : function(){
				$("#" + contactId ).html(' . . . . . .  ');
			}, 
			success:  function(data){
				$(".modal-body").html(data);
				$('#show_contact_info_model').modal('show');
				$("#" + contactId ).html('المزيد');

			}
		});
		return false ;
	});

    //mltiple checkbox in createContact.php
    $('.selectpicker').selectpicker();

    $('#selectpic').change(function(){
		$('#hidden_selectpic').val($('#selectpic').val());

		var playlistArray = $('#selectpic').val().toString().split(",");

		$('.playlist-inputs').hide();
		$('#add-contact-form').find(".paid-input").prop('name','');
		$('#update-contact-form').find(".paid-input").prop('name','');

		//show selected only
		playlistArray.forEach( playlist => 

			$('#input_' + playlist ).show()
		
		);

		//remove requrid from all inputs
		playlistArray.forEach( playlist => 

			$('.paid-input' ).prop('required',false)
		
		);

		//add requrid to selected only
		playlistArray.forEach( playlist => 

			$('#input_' + playlist + ' input' ).prop('required','true')
		
		);

		//add input name to selected only
		playlistArray.forEach( playlist => 

			$('#input_' + playlist + ' input' ).prop('name','paid[]')
		
		);

		$('#playlist_paid_inputs').html();
		
	});

    //Create contact
	$('#add-contact-form' ).submit(function(e){
		e.preventDefault();
	    e.stopImmediatePropagation();
	        
	    var data = $('#add-contact-form').serialize();
		
		$.ajax({
			url : "addContact.php", 
			type : "POST", 
			data : data, 
			beforeSend : function(){
				$("#new-link-container" ).html('loading...');
			}, 
			success:  function(data){
				$("#new-contact-container" ).html('<div class = "alert-warning"> تمت الاضافة بنجاح </div>');
				$('tbody').append(data);

				//reset values
				$('#add-contact-form').find("input[type=text], textarea").val("");
				$('#phone-input').val("+2");

				$(".selectpicker").val('default');
				$(".selectpicker").selectpicker("refresh");
				$('.playlist-inputs').hide();
				$('.paid-input' ).prop('required',false);

			}
		});
		return false ;
	});

    //chickbox in createlink.php
    $("#is_time_limited").change(function(){
    	
   		$('.timer').attr('disabled',!this.checked);
   		$('.time-limit-inputs').show();

    });


    //update contact 
	$('#update-contact-form' ).submit(function(e){
	e.preventDefault();
    e.stopImmediatePropagation();
        
    var data = $('#update-contact-form').serialize();
	
	$.ajax({
		url : "updateContact.php", 
		type : "POST", 
		data : data, 
		beforeSend : function(){
			$("#contact-is-updated-container" ).html(' جاري التحديث ... ');
		}, 
		success:  function(data){
			$("#contact-is-updated-container" ).html(data);
		},
        error: function (request, status, error) { 
        	console.log("Sorry, An error occured & respons status  : " +  request.status  + " & readyState " + request.readyState  + ": & Respons text : "  + request.responseText  +  " & status : "  +  status  + " & error : "  + error) ;         
        }
	});

	return false ;
	
	});


    //update link 
	$('#update-link-form' ).submit(function(e){
	e.preventDefault();
    e.stopImmediatePropagation();
        
    var data = $('#update-link-form').serialize();
	
	$.ajax({
		url : "updateLink.php", 
		type : "POST", 
		data : data, 
		beforeSend : function(){
			$("#link-is-updated-container" ).html('loading #!!!!! ');
		}, 
		success:  function(data){
			$("#link-is-updated-container" ).html(data);

		}
	});

	return false ;

	});

  	//create link
	$('#add-link-form' ).submit(function(e){
		e.preventDefault();
	    e.stopImmediatePropagation();
	        
	    var data = $('#add-link-form').serialize();
		
		$.ajax({
			url : "addLink.php", 
			type : "POST", 
			data : data, 
			beforeSend : function(){
				$("#new-link-container" ).html('loading #!!!!! ');
			}, 
			success:  function(data){
				$("#new-link-container" ).html(data);
				$('#add-link-form').find("input[type=text], textarea").val("");

			}
		});
		return false ;
	});




});
