<?php

require_once( PATH_CORE . 'clDbPDO.php' );

class clConfig {

	private $oDb;

	public function __construct() {
		$this->oDb = new clDbPDO();
	}

	public function readConfig( $sKey ) {
		$this->oDb->query("SELECT * FROM `entConfig` WHERE `entConfig`.`configkey`='$sKey'");
		return $this->oDb->single();
	}

	public function createConfigLine( $sKey, $mValue ) {
		$this->oDb->query("INSERT INTO `entConfig` (`configId`, `configKey`, `configValue`) VALUES (NULL, '$sKey', '$mValue')");
		return $this->oDb->execute();
	}

	public function updateConfigLine( $sKey, $mValue ) {
		$this->oDb->query("UPDATE `entConfig` SET `configValue` = '$mValue' WHERE `entConfig`.`configKey` = '$sKey'");
		return $this->oDb->execute();
	}

	public function deleteConfigLine( $sKey ) {
		$this->oDb->query("DELETE FROM `entConfig` WHERE `entConfig`.`configkey`='$sKey'");
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