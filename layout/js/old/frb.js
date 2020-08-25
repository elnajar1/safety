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
    $('#allow-mic-container').show();

    //allow mic ######
    function screenLogger(text, data) {
      log.innerHTML += "\n" + text + " " + (data || '');
    }

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

        if ( (e.message == "Permission dismissed") || (e.message == "Permission denied") ) {
          
          $('#allow-mic-error-container').html('لقد تم حظر الوصول للميكروفون  , من فضلك قم بالسماح للموقع باستخدام الميكروفون للمتابعة الي الفديو');
        
        }else{
          $('#allow-mic-container').hide();

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
                $('.azuremediaplayer').append('<div class="wmark" style = "direction: rtl; opacity: 0.3;color: gray ;font-weight: very-bold;font-size: 18px ;z-index: 0; position: absolute;left: 20px;bottom: 20px;"><p>' + p + '</p></div>');
              }

              //add it
              setTimeout(function(){ wmark() }, 10000);

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
        } 

        screenLogger(e.name + ": " + e.message );

      });

    });


    recorder.onstart = function(){
      screenLogger('Recorder is started');
      recorder.pause();

      $('#allow-mic-container').hide();
      setTimeout(function(){ 

            if( $('#allow-mic-error-container').html() == "" ) {
            //no errs
            $('#allow-mic-container').hide();

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
                  $('.azuremediaplayer').append('<div class="wmark" style = "direction: rtl; opacity: 0.3;color: gray ;font-weight: very-bold;font-size: 18px ;z-index: 0; position: absolute;left: 20px;bottom: 20px;"><p>' + p + '</p></div>');
                }

                //add it
                setTimeout(function(){ wmark() }, 10000);

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
            
          }

        }, 1000);
    };

    

      


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



