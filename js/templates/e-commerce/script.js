$( document ).ready( function() {
	$(".close-btn > a").click( function() {
		$(".top-promotion").slideUp(500);
	} );

	var children=$('.navMain li a').filter(function(){return $(this).nextAll().length>0})
	$('<span class="expand">▼</span>').insertAfter(children)
	$('.navMain .expand').click(function (e) {
	  $(this).next().slideToggle();
	  return false;
	});
} );