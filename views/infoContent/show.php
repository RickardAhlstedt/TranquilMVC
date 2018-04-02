<?php

require_once( PATH_MODELS . 'infoContent/clInfoContent.php' );

$oRouter = clRegistry::get( 'clRouter' );
$oTemplate = clRegistry::get( 'clTemplate' );

$oInfoContent = new clInfoContent();

$aData = $oRouter->getIdByRoute( $oRouter->getRoutePath() );

if( !empty($aData) ) {
	$aContentData = $oInfoContent->read( $aData['routeViewId'] );
	if( $aContentData['contentStatus'] != 'active' ) {
		if( empty($_SESSION['userId']) && $_SESSION['userStatus'] != 'admin' ) {
			$oRouter->redirect( '/' );
		}
	}
	if( $GLOBALS['enviroment'] == 'production' && ($_SESSION['userStatus'] != 'admin') ) {
		//read cache before rendering a live-view
		if( file_exists(PATH_CACHE . 'infoContent/' . $aData['routeViewId'] . '.cache') ) {
			$fh = fopen( PATH_CACHE . 'infoContent/' . $aData['routeViewId'] . '.cache', 'r' );
			$sCacheContent = fread( $fh, filesize( PATH_CACHE . 'infoContent/' . $aData['routeViewId'] . '.cache' ) );
			$sCacheDecode = gzdecode( $sCacheContent );
			echo $sCacheDecode;
			exit;
		} else {
			$oTemplate->setTitle( $aContentData['contentTitle'] );
			$oTemplate->setKeywords( $aContentData['contentMetaKeywords'] );
			$oTemplate->setDescription( $aContentData['contentMetaDescription'] );
			$oTemplate->setCanonicalUrl( $aContentData['contentMetaCanonicalUrl'] );
			
			echo $aContentData['contentText'];
		}	
	} else {
		// Always render a live-view
		$oTemplate->setTitle( $aContentData['contentTitle'] );
		$oTemplate->setKeywords( $aContentData['contentMetaKeywords'] );
		$oTemplate->setDescription( $aContentData['contentMetaDescription'] );
		$oTemplate->setCanonicalUrl( $aContentData['contentMetaCanonicalUrl'] );
		
		echo $aContentData['contentText'];
	}
}