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
	private $stmt;

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

	public function query($query){
		$this->stmt = $this->oConn->prepare($query);
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