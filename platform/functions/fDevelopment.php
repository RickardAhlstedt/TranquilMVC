<?php

function dump( $oObject ) {
	echo '<pre>';
	print_r($oObject);
	echo '</pre>';
}

function averageSystemLoad() {
	if( !function_exists('sys_getloadavg') ) return false;
	
	$aLoad = sys_getloadavg();
	return implode( '; ', $aLoad );
}

function memoryUsage() {
	return memory_get_usage() . ' / ' . memory_get_peak_usage();
}