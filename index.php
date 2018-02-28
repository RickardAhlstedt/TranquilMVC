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

ini_set( 'session.gc_maxlifetime', SITE_SESSION_TIMEOUT );

$oConfig = new clConfig();
$oRouter = new clRouter();

clRegistry::add( $oConfig );
clRegistry::add( $oRouter );

$sViewPath = 'views/';
$sRoutePath = $oRouter->getRoutePath();

// $sTemplate = 'default.php';
$oTemplate = new clTemplate();
clRegistry::add( $oTemplate );

$oView = new clView( $sViewPath . 'home/index.php' );
clRegistry::add( $oView );

$sViewToRender = '';

if( $sRoutePath == '/' ) {
	$sViewToRender = $sViewPath . 'home/index.php';
	$oView->setView( $sViewToRender );
} elseif( $sRoutePath == '/admin/uploadImage') {
	$oTemplate->setTemplate( 'empty.php' );
	$sViewToRender = $sViewPath . 'admin/uploadImage.php';
	$oView->setView( $sViewToRender );
} elseif( $sRoutePath == '/admin/login' ) {
	$oTemplate->setTemplate( 'adminLogin.php' );
	$sViewToRender = $sViewPath . 'admin/login.php';
	$oView->setView( $sViewToRender );
} elseif( strpos( $sRoutePath, '/admin') !== false ) {
	$oTemplate->setTemplate( 'admin.php' );
	$aRoutePath = explode( '/', $sRoutePath );
	if( count($aRoutePath) > 3 ) {
		$sViewToRender = $sViewPath . $aRoutePath[1] . '/' . $aRoutePath[2] . '/' . $aRoutePath[3] . '.php';
		$oView->setView( $sViewToRender );
	} elseif(count($aRoutePath) > 2 ) {
		$sViewToRender = $sViewPath . $aRoutePath[1] . '/' . $aRoutePath[2] . '.php';
		$oView->setView( $sViewToRender );
	} else {
		$sViewToRender = $sViewPath . $aRoutePath[1] . '/' . $aRoutePath[1] . '.php';
		$oView->setView( $sViewToRender );
	}

} else {
	$aRoutePath = explode( '/', $sRoutePath );
	if( count($aRoutePath) > 2 ) {
		$sViewToRender = $sViewPath . $aRoutePath[1] . '/' . $aRoutePath[2] . '.php';
		$oView->setView( $sViewToRender );
	} else {
		$sViewToRender = $sViewPath . $aRoutePath[1] . '/' . $aRoutePath[1] . '.php';
		$oView->setView( $sViewToRender );
	}
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