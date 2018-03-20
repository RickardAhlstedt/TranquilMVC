$( document ).ready( function() {
	var header = $("header");

	$("a.expandMenu").click( function(evt) {
		evt.preventDefault();
		$("ul.navMain").toggle();
	} );

	$( "main.wrapper" ).scroll( function() {
		if( $(this).scrollTop() >= header.height() ) {
			header.removeClass("fixed");
		} else {
			header.addClass("fixed");
		}
	} );
	var children=$('.navMain li a').filter(function(){return $(this).nextAll().length>0})
	$('<span class="expand">▼</span>').insertAfter(children)
	$('.navMain .expand').click(function (e) {
	  $(this).next().toggle();
	  return false;
	});
} );