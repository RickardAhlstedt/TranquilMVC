<?php 

session_start();
error_reporting( E_ALL );
ini_set( 'display_errors', true );
ini_set( 'memory_limit', '128M' );
ini_set( 'magic_quotes_gpc', 0 );
ini_set( 'magic_quotes_runtime', 0 );
ini_set( 'magic_quotes_sybase', 0 );

require_once( 'config/cfBase.php' );
require_once( 'core/clRouter.php' );
require_once( 'core/clConfig.php' );
require_once( 'core/clRegistry.php' );
require_once( 'core/clView.php' );
require_once( 'core/clTemplate.php' );

require_once( 'functions/fOutputHtml.php' );
require_once( 'functions/fDevelopment.php' );
require_once( 'functions/fFileSystem.php' );

ini_set( 'session.gc_maxlifetime', SITE_SESSION_TIMEOUT );

$oConfig = new clConfig();
$oRouter = new clRouter();

clRegistry::add( $oConfig );
clRegistry::add( $oRouter );

$oTemplate = new clTemplate();
clRegistry::add( $oTemplate );
$oView = new clView();
clRegistry::add( $oView );

$aRouteData = $oRouter->read( $oRouter->getRoutePath() );
// dump( $aRouteData );
if( $aRouteData != false ) {
	$oTemplate->setTemplate( $aRouteData['routeTemplate'] . '.php' );
	$oView->setView( PATH_VIEWS . '/' . $aRouteData['routeModel'] . '/' . $aRouteData['routeView'] . '.php' );
} else {
	$oTemplate->setTemplate( 'default.php' );
	$oView->setView( PATH_VIEWS . '/infoContent/404.php' );
}

//Render the output
ob_start();
$sOutputBuffer = '';

$sViewBuffer = $oView->render($oView->getView());
$oTemplate->setContent( $sViewBuffer );
$sTemplateBuffer = $oTemplate->render();

$sOutputBuffer .= $sTemplateBuffer;
ob_end_flush();

echo $sOutputBuffer;

//Check out the new logo that I created on <a href="http://logomakr.com" title="Logo Makr">LogoMakr.com</a> https://logomakr.com/09S0FI


?>