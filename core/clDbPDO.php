<?php

class clDbPDO {
	private $aDbParams = array(
        'host' => DB_HOST,
        'user' => DB_USER,
        'pass' => DB_PASS,
        'db' => DB_NAME
    );

	private $aErr = array();
	
	private $oConn;
	public  $stmt;

	public $sHelperQuery = '';

	public $sPrimaryEntity = '';
	public $sCriterias = '';
	public $aFieldsDefault = '*';

	public $aFields = array();

	public function __construct() {
		$dsn = 'mysql:host=' . $this->aDbParams['host'] .';dbname=' . $this->aDbParams['db'];
        $aOptions = array(
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        );
        try {
            $this->oConn = new PDO( $dsn, $this->aDbParams['user'], $this->aDbParams['pass'], $aOptions );
        } catch( PDOException $e ) {
            $this->aErr[] = $e->getMessage();
        }
        $this->query( 'SET names utf8' );
	}

	public function setHelper( $oHelper ) {
		$this->sHelperQuery = $oHelper->getQuery();
	}

	public function query($query){
		$this->stmt = $this->oConn->prepare($query . $this->sHelperQuery);
		// dump( $this->stmt );
	}

	public function bind($param, $value, $type = null){
		if (is_null($type)) {
			switch (true) {
				case is_int($value):
					$type = PDO::PARAM_INT;
					break;
				case is_bool($value):
					$type = PDO::PARAM_BOOL;
					break;
				case is_null($value):
					$type = PDO::PARAM_NULL;
					break;
				default:
					$type = PDO::PARAM_STR;
			}
		}
		$this->stmt->bindValue($param, $value, $type);
	}

	public function setEntity( $sPrimaryEntity ) {
		$this->sPrimaryEntity = $sPrimaryEntity;
	}

	public function setCriterias( $sCriterias ) {
		$this->sCriterias = $sCriterias;
	}

	public function setFields( $aFields ) {
		$this->aFields = $aFields;
	}

	public function createData( $aData, $aParams = array() ) {
		if( empty($aData) ) return;

		$aParams += array(
			'entities' => $this->sPrimaryEntity
		);
		$this->setEntity( $aParams['entities'] );

		$this->query( 'INSERT INTO ' . $this->sPrimaryEntity . ' SET ' . $this->formatData( $aData ) );
		return $this->execute();
	}

	public function updateData( $aData, $aParams = array() ) {
		if( empty($aData) ) return;

		$aParams += array(
			'entities' => $this->sPrimaryEntity,
			'criterias' => null
		);
		$this->setEntity( $aParams['entities'] );
		$this->setCriterias( $aParams['criterias'] );

		$this->query( 'UPDATE ' . $this->sPrimaryEntity . ' SET ' . $this->formatData( $aData ) . $this->formatCriteras( $aParams['criterias']));
		// dump( $this->stmt );
		return $this->execute();
	}

	public function readData( $aParams = array() ) {
		$aParams += array(
			'entities' => $this->sPrimaryEntity,
			'criterias' => null,
			'fields' => $this->aFieldsDefault
		);
		$this->setEntity( $aParams['entities'] );
		$this->setCriterias( $aParams['criterias'] );
		$this->setFields( $aParams['fields'] );

		$this->query( 'SELECT ' . $this->formatFields($aParams['fields']) . ' FROM ' . $this->sPrimaryEntity . $this->formatCriteras($aParams['criterias']) );
		return $this->single();
	}

	public function formatFields( $aFields ) {
		$aFieldsTmp = array();

		foreach( $aFields as $sField ) {
			$aFieldsTmp[] = $sField;
		}
		return implode( ', ', $aFieldsTmp );
	}

	public function formatData( $aData, $bEscape = true) {
		$aDataTmp = array();

		foreach( $aData as $sKey => $sValue ) {
			$aDataTmp[$sKey] = $sKey . ' = ' . ( $bEscape ? $this->escapeStr($sValue) : $sValue );
		}
		return implode( ', ', $aDataTmp );
	}

	public function formatCriteras( $sCriterias = '' ) {
		if( empty($sCriterias) && empty($this->sCriterias) ) return;
		return ' WHERE ' . $sCriterias . ( (!empty($sCriterias) && !empty($this->sCriterias)) ? ' AND ' . $this->sCriterias : $this->sCriterias );
	}

	public function execute(){
		return $this->stmt->execute();
	}

	public function escapeStr( $sStr ) {
		return $this->oConn->quote( $sStr );
    }

	public function resultset(){
		$this->execute();
		return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	public function single(){
		$this->execute();
		return $this->stmt->fetch(PDO::FETCH_ASSOC);
	}

	public function rowCount(){
		return $this->stmt->rowCount();
	}

	public function lastInsertId(){
		return $this->oConn->lastInsertId();
	}

	public function beginTransaction(){
		return $this->oConn->beginTransaction();
	}

	public function endTransaction(){
		return $this->oConn->commit();
	}

	public function cancelTransaction(){
		return $this->oConn->rollBack();
	}

	public function debugDumpParams(){
		return $this->stmt->debugDumpParams();
	}

}