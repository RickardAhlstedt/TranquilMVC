<?php

function getRoutePath() {
	if( isset($_SERVER['PATH_INFO']) ) {
		$sPath = $_SERVER['PATH_INFO'];
		
	} else {
		$sQuery = strpos( $_SERVER['REQUEST_URI'], '?' );
		
		if( $sQuery === false ) {
			$sPath = $_SERVER['REQUEST_URI'];
			
		} else {
			$sPath = substr( $_SERVER['REQUEST_URI'], 0, $sQuery );
			
		}
		
		$sPath = rawurldecode( $sPath );
		//$sPath = rawurldecode( str_replace(dirname($_SERVER['SCRIPT_NAME']), '', $sPath) );
	}

	return '/' . trim( $sPath, '/' );
}

function redirect( $sPath ) {
	header( 'location: ' . $sPath );
	exit;
}