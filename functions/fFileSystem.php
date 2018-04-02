<?php

function deleteDir( $sDir ) {
	$sCurrentDir = opendir( $sDir );
	while( $sName = readdir($sCurrentDir) ) {
		if( is_dir($sDir . '/' . $sName) && ($sName != '.' && $sName != '..') ) {
        	if( !deleteDir($sDir . '/' . $sName) ) return false;
		} elseif( $sName != '.' && $sName != '..' ){
			if( !unlink($sDir . '/' . $sName) ) return false;
		}
	}
	closedir( $sCurrentDir );
	return rmdir( $sDir );
}

function readMimeType( $sFile ) {
	if( function_exists('finfo_file') ) {
		$rFInfo = finfo_open(FILEINFO_MIME_TYPE);
    	$sMimeType = finfo_file($rFInfo, $sFile) . "\n";
		finfo_close($rFInfo);
		return $sMimeType;
	} elseif( function_exists('mime_content_type') ) {
		return mime_content_type( $sFile );
	}
	return false;
}

function cleanFilename( $sFilename ) {
	$aReplaces = array(
		'#' => '-',
		' ' => '-',
		"'" => '',
		'"' => '',
		'__' => '-',
		'&' => '-',
		'/' => '',
		'?' => ''
	);
	return strtolower( stripslashes(str_replace(array_keys($aReplaces), $aReplaces, $sFilename)) );
}

function getFileExtension( $sFileName ) {
	if( function_exists('pathinfo') ) {
		return pathinfo( $sFileName, PATHINFO_EXTENSION );
	} else {
		return mb_substr( strrchr( $sFileName,'.' ), 1 );
	}
}

function getFileName( $sFileName ) {
	if( function_exists('pathinfo') ) {
		$sFileExt = pathinfo( $sFileName, PATHINFO_EXTENSION );
	} else {
		$sFileExt = substr( strrchr( $sFileName,'.' ), 1 );
	}
		
	return mb_substr( $sFileName, 0, -strlen($sFileExt) - 1 );
}

function bytesToStr( $iBytes ) {
    $aTypes = array( 'B', 'KB', 'MB', 'GB', 'TB' );
    for( $i = 0; $iBytes >= 1024 && $i < ( count( $aTypes ) -1 ); $iBytes /= 1024, $i++ );
    return( round( $iBytes, 2 ) . " " . $aTypes[$i] );
}

function regexScanDir( $sRegex, $sDirectory ) {
	$aReturn = array();
	
	$oDirectory = new RecursiveDirectoryIterator( $sDirectory );
	$oIterator = new RecursiveIteratorIterator( $oDirectory );
	$aHits = new RegexIterator( $oIterator, $sRegex, RecursiveRegexIterator::GET_MATCH );
	
	foreach( $aHits as $aHit ) {
		$aReturn[] = current( $aHit );
	}
	
	return $aReturn;
}