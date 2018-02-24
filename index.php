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
require_once( 'functions/fOutputHtml.php' );
require_once( 'functions/fDevelopment.php' );

ini_set( 'session.gc_maxlifetime', SITE_SESSION_TIMEOUT );

$oRouter = new clRouter();

$sViewPath = 'views/';
$sRoutePath = $oRouter->getRoutePath();

$sTemplatePath = 'template/';
$sTemplate = $sTemplatePath . 'default.php';

$sViewToRender = '';

if( $sRoutePath == '/' ) {
    $sViewToRender = $sViewPath . 'home/index.php';
} elseif( strpos( $sRoutePath, '/admin') !== false ) {
    $sTemplate = $sTemplatePath . 'admin.php';
    $aRoutePath = explode( '/', $sRoutePath );
    if( count($aRoutePath) > 2 ) {
        $sViewToRender = $sViewPath . $aRoutePath[1] . '/' . $aRoutePath[2] . '.php';    
    } else {
        $sViewToRender = $sViewPath . $aRoutePath[1] . '/' . $aRoutePath[1] . '.php';
    }
} else {
    $aRoutePath = explode( '/', $sRoutePath );
    if( count($aRoutePath) > 2 ) {
        $sViewToRender = $sViewPath . $aRoutePath[1] . '/' . $aRoutePath[2] . '.php';    
    } else {
        $sViewToRender = $sViewPath . $aRoutePath[1] . '/' . $aRoutePath[1] . '.php';
    }
}
ob_start();

$sOutputBuffer = '';

if( is_file($sViewToRender) ) {
    $sContent = $sViewToRender;
} else {
    $sContent = "$sViewToRender is not a valid view";
}

$sTemplate = render( $sTemplate, array(
    'head' => array(
        '<meta name="keywords" content="test">'
    ),
    'content' => $sContent
) );
$sOutputBuffer .= $sTemplate;

ob_end_flush();

echo $sOutputBuffer;
?>