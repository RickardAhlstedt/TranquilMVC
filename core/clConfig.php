<?php

require_once( PATH_CORE . 'clDbPDO.php' );

class clConfig {

	private $oDb;

	public function __construct() {
		$this->oDb = new clDbPDO();
		$this->oDb->setEntity( 'entconfig' );
	}

	public function readConfig( $sKey ) {
		return $this->oDb->readData( array(
			'fields' => array(
				'configvalue'
			),
			'criterias' => "configkey = '$sKey'"
		) );
		// $this->oDb->query("SELECT * FROM `entconfig` WHERE `entconfig`.`configkey`='$sKey'");
		// return $this->oDb->single();
	}

	public function createConfigLine( $sKey, $mValue ) {
		return $this->oDb->createData( array(
			'configkey' => $sKey,
			'configvalue' => $mValue
		) );
		
		// $this->oDb->query("INSERT INTO `entconfig` (`configId`, `configKey`, `configValue`) VALUES (NULL, '$sKey', '$mValue')");
		// return $this->oDb->execute();
	}

	public function updateConfigLine( $sKey, $mValue ) {
		return $this->oDb->updateData( array(
			'configvalue' => $mValue
		), array(
			'criterias' => "configkey = '$sKey'"
		) );
		// $this->oDb->query("UPDATE `entconfig` SET `configValue` = '$mValue' WHERE `entconfig`.`configKey` = '$sKey'");
		// return $this->oDb->execute();
	}

	public function deleteConfigLine( $sKey ) {
		$this->oDb->query("DELETE FROM `entconfig` WHERE `entconfig`.`configkey`='$sKey'");
		return $this->oDb->execute();
	}

}

/**
 * entACL
 * 	ID
 * 	Name
 * 	Level
 * 	created
 * 	updated
 */