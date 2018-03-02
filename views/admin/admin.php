<?php

$oRouter = clRegistry::get( 'clRouter' );
$oConfig = clRegistry::get( 'clConfig' );
$oTemplate = clRegistry::get( 'clTemplate' );

$oTemplate->setTitle('test');

if( empty($_SESSION['userId']) ) {
	$oRouter->redirect( '/admin/login' );
}
?>


