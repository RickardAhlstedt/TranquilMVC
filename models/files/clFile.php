<?php

require_once( PATH_CORE . 'clDbPDO.php' );

class clFile {
	private $oDb;

	public function __construct() {
		$this->oDb = new clDbPDO();
		$this->oDb->setEntity( 'entfiles' );
	}

	public function readByParent( $sParentModel, $iParentId, $aParams = array() ) {
		$sParentModel = $this->oDb->escapeStr( $sParentModel );
		$aParams += array(
			'fields' => $this->oDb->aFieldsDefault
		);

		return $this->oDb->readData( array(
			'fields' => $aParams['fields']
		), array(
			'criterias' => "fileParentModel='$sParentModel' AND fileParentId=$iParentId"
		) );
	}

	public function createFile( $aData = array() ) {
		if( empty($aData) ) return;

		$aData += array(
			'fileCreated' => date( 'Y-m-d H:i:s' ),
			'fileExtension' => getFileExtension( $aData['filename'] )
		);

		return $this->oDb->createData( $aData );
	}

}