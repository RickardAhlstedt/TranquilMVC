<?php

class clLogger {

	public function __construct() {}

	public static function log( $mMsg = '', $sFilename = 'general.log' ) {
		if( is_array($mMsg) ) {
			$sMsg = var_export( $mMsg, true );
		} elseif( is_object($mMsg) ) {
			$sMsg = serialize($mMsg);
		} else {
			$sMsg = $mMsg;
		}
		return file_put_contents( PATH_LOG . $sFilename, date('Y-m-d H:i:s') . "\t" . $sMsg . "\r\n", FILE_APPEND );
	}

	public static function logRotate( $sFilename = 'general.log', $sFileSize = '32M' )  {
		if( !file_exists( PATH_LOG . $sFilename ) ) return false; // Logfile does not exist
		
		if( !is_numeric($sFileSize) ) {
			$aFilesizesToMultiplier = array(
				'b' => 1, 'byte' => 1, 'bytes' => 1,
				'k' => 1024, 'kilobyte' => 1024, 'kb' => 1024, 'kilobytes' => 1024,
				'm' => 1048576, 'megabyte' => 1048576, 'mb' => 1048576, 'megabytes' => 1048576,
				'g' => 1073741824, 'gigabyte' => 1073741824, 'gb' => 1073741824, 'gigabytes' => 1073741824				
			);
			$sFilesizeUnit = str_replace( array(
				' ',
				'.',
				','
			), '', $sFileSize );
			$sFilesizeUnit = mb_strtolower( preg_replace('[\d]', '', $sFilesizeUnit) );
			
			if( !array_key_exists($sFilesizeUnit, $aFilesizesToMultiplier) ) return false; // Not know filesize format
			$iSize = preg_replace('[\D]', '', $sFileSize);
			
			$iSize = $iSize * $aFilesizesToMultiplier[ $sFilesizeUnit ];
		} else {
			$iSize = (int) $sFileSize;
		}

		if( filesize( PATH_LOG . $sFilename ) >= $iSize ) {
			// Rotate
			$iPositionOfDot = mb_strlen( strrchr( $sFilename, '.' ));
			$sNewFilename = mb_substr( $sFilename, 0, $iPositionOfDot * -1 ) . '.' . time() . mb_substr( $sFilename, $iPositionOfDot * -1 );

			return rename( PATH_LOG . $sFilename, PATH_LOG . $sNewFilename );
		}

		return false;

	}

}