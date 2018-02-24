<?php

// function createAttributes( $aAttributes = array() ) {
//     $sOutput = '';
//     foreach( $aAttributes as $sKey => $sValue ) {
//         if( $sValue === null || is_array($sValue) ) continue;
//         $sOutput .= ' ' . $sKey . '="' . $sValue . '"';
//     }
//     return $sOutput;
// }

// function addScript( $aParams = array() ) {
//     $aParams += array(
//         'key' => null,
//         'src' => null,
//     );
//     $sKey = $aParams['key'];
//     unset( $aParams['key'] );

//     $this->addBottom( array(
//         'key' => $sKey,
//         'content' => '<script' . createAttributes( $aParams ) .'></script>'
//     ) );
// }

// function addStyle( $aParams = array() ) {
//     $aParams += array(
//         'key' => null,
//         'content' => null
//     );

//     $aParams['content'] = '<style>' . $aParams['content'] . '</style>';

//     $this->addTop( $aParams );
// }

function render( $sPath, $aParams = array() ) {
    if( is_array($aParams) && !empty($aParams) ) {
        extract( $aParams );
    }
    ob_start();
    include $sPath;
    ob_end_flush();
}