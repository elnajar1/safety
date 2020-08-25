jQuery(document).ready(function() {
  if (jQuery('.aqua').length) {
  var words = [
		' بيع ',
		'فديوهاتك',
    'وأنت ',
    'مُطمَّن',
		' أنتعش ', 
		'<i class="fas fa-smile-wink"></i>'
  ], 

  i = 0;
  setInterval(function(){
    jQuery('.aqua').fadeOut(function(){
        jQuery(this).html(words[i=(i+1)%words.length]).fadeIn();
    });
  }, 1000);
}
});