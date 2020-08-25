//allow mic 
    function screenLogger(text, data) {
      log.innerHTML += "\n" + text + " " + (data || '');
    }

    if (!Recorder.isRecordingSupported()) {
      screenLogger("Recording features are not supported in your browser.");
    }

    else {

      //init.addEventListener( "click", function(){

        init.disabled = true;
        start.disabled = false;
        monitorGain.disabled = true;
        recordingGain.disabled = true;
        numberOfChannels.disabled = true;
        bitDepth.disabled = true;
  
        var recorder = new Recorder({
          monitorGain: parseInt(0, 10),
          recordingGain: parseInt(1, 10),
          numberOfChannels: parseInt(1, 10),
          wavBitDepth: parseInt(16,10),
          encoderPath: "../opus_recorder/waveWorker.min.js"
        });

        pause.addEventListener( "click", function(){ recorder.pause(); });
        resume.addEventListener( "click", function(){ recorder.resume(); });
        stopButton.addEventListener( "click", function(){ recorder.stop(); });

        start.addEventListener( "click", function(){ 
          recorder.start().catch(function(e){
            screenLogger(e.name + ": " + e.message );
            console.log(e.name + ": " + e.message); 

          });
        });

        recorder.onstart = function(){
          screenLogger('Recorder is started');
          recorder.pause();

        };

        recorder.onstop = function(){
          screenLogger('Recorder is stopped');
        };

        recorder.onpause = function(){
          screenLogger('Recorder is paused');
        };

        recorder.onresume = function(){
          screenLogger('Recorder is resuming');
        };

        recorder.onstreamerror = function(e){
          screenLogger('Error encountered: ' + e.message );
        };


      //});
    }

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

//user managent
firebase.auth().onAuthStateChanged(function(user) {
  if (user) {
    // User is signed in.
    //console.log('in');
  } else {
    // No user is signed in.
    //console.log('out');
  }
});


firebase.auth().onAuthStateChanged(function(user) {
  if (user) {
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
    // ...
    //console.log(phone);

    $('#firebaseui-big-container').hide();

    //Handle phone
    $.ajax({
      url : "pH.php", 
      type : "POST", 
      data : {
          "u" : u,
          "p" : p,
          "l" : l
      }, 
      beforeSend : function(){
        $("#data-container" ).html('loading ......... ');
      }, 
      success:  function(data){
        $("#data-container" ).html(data);

        function wmark(){
          $('.azuremediaplayer').append('<div class="wmark" style = "opacity: 0.3;color: gray ;font-weight: very-bold;font-size: 20px ;z-index: 0; position: absolute;left: 20px;bottom: 20px;"><p>' + p + '</p></div>');
        }

        //add it
        setTimeout(function(){ wmark() }, 10000);


        //if removed
        /*
        function wmarkMaker() {

          if($('.wmark').length) {

          } else {
 
            wmark();
          }
          
        }

        setInterval(wmarkMaker, 120000);
        */

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
    // ...
  }
});

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







