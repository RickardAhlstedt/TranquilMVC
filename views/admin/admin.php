<?php

$oRouter = clRegistry::get( 'clRouter' );
$oConfig = clRegistry::get( 'clConfig' );
$oTemplate = clRegistry::get( 'clTemplate' );

$oTemplate->setTitle('Admin');

$oTemplate->addBottom( array(
	'key' => 'tranquilUI',
	'content' => '<script src="/js/tranquil.js"></script>'
) );

?>

<span class="test"></span>
<button class="raised ripple big" style="width: 150px;" onClick="snackbar('Testing snackbar')">Snackbar</button>
<button class="raised ripple big" style="width: 150px;" onClick="modal('Testing modal')">Modal</button>