function snackbar( message, level = "info" ) {
	$("body").append( '<div id="snackbar" class="' + level + '">' + message + '</div>' );
	var snackbarElement = $("#snackbar");
	snackbarElement.addClass("show");
	setTimeout( function() {
		snackbarElement.removeClass("show");
		snackbarElement.remove();
	}, 3000 );
}

function modal( content ) {
	$("body").append( '<div id="modal" class="modal">' +
	'<div class="modal-content">' + 
		'<span class="close">&times;</span>' +
		content + 
	'</div>' );
	var modalElement = $("#modal.modal");
	modalElement.addClass("show");
	var closeBtn = $("#modal.modal > .modal-content > .close");
	closeBtn.bind("click", function() {
		// modalElement.removeClass("show");
		modalElement.addClass("hide");
		setTimeout( function() {
			modalElement.remove();
			modalElement.removeClass("show");
		}, 450 );
	} );
}