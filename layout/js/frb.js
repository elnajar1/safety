var ph;
// getUrlParameter
var getUrlParameter = function getUrlParameter(sParam) {
    var sPageURL = window.location.search.substring(1),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;

    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');

        if (sParameterName[0] === sParam) {
            return sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
        }
    }
};

//sign out
$('#firebase-sign-out').click(function(){

  firebase.auth().signOut().then(function() {
    // Sign-out successful.
    location.reload();
  }).catch(function(error) {
    // An error happened.
  });

});


firebase.auth().onAuthStateChanged(function(user) {

  if (user && $( "#firebaseui-big-container" ).length) {

    // User is signed in.
    var displayName = user.displayName;
    var email = user.email;
    var p = user.phoneNumber;
    var emailVerified = user.emailVerified;
    var photoURL = user.photoURL;
    var isAnonymous = user.isAnonymous;
    var uid = user.uid;
    var providerData = user.providerData;

    var u = getUrlParameter('u');
    var l = getUrlParameter('l');
    var s = getUrlParameter('s');
    // ...
    //console.log(phone);

    //$('#firebaseui-big-container').hide();
    $('#firebase-sign-out-container').show();
    //$('#allow-mic-container').show();

    $.ajax({
      url : "pH.php", 
      type : "POST", 
      data : {
          "p" : p,
          "l" : l,
          "s" : s
      }, 
      beforeSend : function(){
        $("#data-container" ).html('<div class="d-flex justify-content-center text-primary"><div class="spinner-border" role="status"><span class="sr-only">Loading...</span></div></div>');
      }, 
      success:  function(data){

        $('#firebaseui-big-container').hide();
        $("#data-container" ).html(data);

        function wmark(){
          $('.azuremediaplayer').append('<div class="wmark" style = "direction: rtl; opacity: 0.3;color: gray ;font-weight: very-bold;font-size: 16px ;z-index: 0; position: absolute;left: 20px;bottom: 20px;"><p>' + p + '</p></div>');
        }

        //add it
        setTimeout(function(){ wmark() }, 60000);

        //update it 
        function wmarkUpdater() {
          $('.wmark').remove();
          setTimeout(function(){ wmark() }, 30000);
        }

        setInterval(wmarkUpdater, 120000);

      },
      error: function (request, status, error) { 
      
        console.log("Sorry, An error occured & respons status  : " +  request.status  + " & readyState " + request.readyState  + ": & Respons text : "  + request.responseText  +  " & status : "  +  status  + " & error : "  + error) ;
               
      }

    });

    
  } else {
    // User is signed out.

  }

  $('#firebaseui-big-container').show();
    var ui = new firebaseui.auth.AuthUI(firebase.auth());

    ui.start('#firebaseui-auth-container', {
      signInOptions: [
        {
          provider: firebase.auth.PhoneAuthProvider.PROVIDER_ID,
          // The default selected country.
          defaultCountry: 'EG',
        }
      ],
    });

});


