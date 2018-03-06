<?php

function createAttributes( $aAttributes = array() ) {
    $sOutput = '';
    foreach( $aAttributes as $sKey => $sValue ) {
        if( $sValue === null || is_array($sValue) ) continue;
        $sOutput .= ' ' . $sKey . '="' . $sValue . '"';
    }
    return $sOutput;
}


/**
 * Deprecated..
 */
function render( $sPath, $aParams = array() ) {
    if( is_array($aParams) && !empty($aParams) ) {
        extract( $aParams );
    }
    ob_start();
    include $sPath;
    ob_end_flush();
}