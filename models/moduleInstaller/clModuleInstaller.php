<?php

include_once( PATH_MODELS . 'moduleInstaller/cfModuleInstaller.php' );
require_once( PATH_CORE . 'clDbPDO.php' );

class clModuleInstaller {

	private $oDb;

	public function __construct() {
		$this->oDb = new clDbPDO();
	}

	public function installModuleTables( $sFileSQLPath ) {
		$sTempLine = '';

		$aResults = array();

		$oFH = fopen( $sFileSQLPath, 'r' );
		while( ($sLine = fgets($oFH)) !== false ) {
			// Skip the line if it's a comment or empty
			// if( substr($sLine, 0, 1) == '---' || $sLine = '' ) {
			// 	continue;
			// }

			$sTempLine .= $sLine;

			if( substr(trim($sLine), strlen(trim($sLine)) - 1, 1) == ';' ) {
				$this->oDb->query( $sTempLine );
				$aResults[] .= $this->oDb->execute();
				$sTempLine = '';
			}
		}

		fclose($oFH);
		return $aResults;
	}

}