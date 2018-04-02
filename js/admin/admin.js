$(document).ready( function() {
	$('a.linkConfirm').on( 'click', function() {
		if ( confirm(this.title) == false) return false;
		return true;
	} );
	$("#menuBtn").click(function() {
		$("#sideDrawer").toggleClass("show");
		$("#wrapper").toggleClass("drawerOut leftDrawer");
	});
} );

$(window).bind('keydown', function(event) {
    if (event.ctrlKey || event.metaKey) {
        switch (String.fromCharCode(event.which).toLowerCase()) {
		case 'e':
			event.preventDefault();
			$(".sidebar.left").toggleClass("show");
			$("#wrapper").toggleClass("drawerOut leftDrawer");
			break;
        }
    }
});

function strToUrl( str ) {
	str = str.toLowerCase();

	str = str.replace(/ /g,"-");
	str = str.replace(/\\/g,"-");
	str = str.replace(/_/g,"-");
	str = str.replace(/&/g,"");
	str = str.replace(/\?/g,"");
	str = str.replace(/#/g,"");
	str = str.replace(/%/g,"");
	str = str.replace(/\+/g,"");
	str = str.replace(/$/g,"");
	str = str.replace(/,/g,"");
	str = str.replace(/:/g,"");
	str = str.replace(/;/g,"");
	str = str.replace(/=/g,"");
	str = str.replace(/@/g,"");
	str = str.replace(/&amp;/g,"");
	str = str.replace(/</g,"");
	str = str.replace(/>/g,"");
	str = str.replace(/{/g,"");
	str = str.replace(/}/g,"");
	str = str.replace(/|/g,"");
	str = str.replace(/\^/g,"");
	str = str.replace(/~/g,"");
	str = str.replace(/\[/g,"");
	str = str.replace(/\]/g,"");
	str = str.replace(/`/g,"");
	str = str.replace(/\'/g,"");
	str = str.replace(/"/g,"");
	str = str.replace(/!/g,"");
	str = str.replace(/¨/g,"");

	return str;
}