$('#toggle_fullscreen').on('click', function(){

  if ( $(".iframe-main-container").css("position") == "absolute" ) {
  // if already full screen; exit
  $(".iframe-main-container").css({"position":"", "top":"","left":"","width":"","height":"" });
  $(".iframe-container").css({ "height":"" });
  }else{
    // else go fullscreen
    $(".iframe-main-container").css({"position":"absolute", "top":"0","left":"0","width":"100%","height":"100vh" });
    $(".iframe-container").css({ "height":"100%" });
  }

});