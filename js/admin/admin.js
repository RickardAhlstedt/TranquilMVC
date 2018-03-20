$(document).ready( function() {
	$('a.linkConfirm').on( 'click', function() {
		if ( confirm(this.title) == false) return false;
		return true;
	} );

} );

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