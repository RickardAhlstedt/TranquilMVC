<?php

$oRouter = clRegistry::get( 'clRouter' );
$oConfig = clRegistry::get( 'clConfig' );
$oTemplate = clRegistry::get( 'clTemplate' );

$oTemplate->setTitle('Admin');


require_once( PATH_MODELS . 'navigation/clNavigation.php' );
$oNavigation = new clNavigation();

dump($oNavigation->readGroup());

dump( $oNavigation->buildMenu(0, $oNavigation->readGroup() ) );

?>


