<?php

require_once( PATH_CORE . 'clDbPDO.php' );

class clInfoContent {

	private $oDb;

	public function __construct() {
		$this->oDb = new clDbPDO();
	}

	public function read( $iContentId ) {
		$this->oDb->query( "SELECT * FROM `entInfoContent` WHERE `contentId`=$iContentId " );
		return $this->oDb->single();
	}

	public function readAll( $aFields = array() ) {
		$sFields = implode( " ", $aFields );
		dump( $sFields );
		$this->oDb->query( "SELECT $sFields FROM `entInfoContent`" );
		return $this->oDb->resultset();
	}

}