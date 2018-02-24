<?php

class clDb {

    private $aDbParams = array(
        'host' => DB_HOST,
        'user' => DB_USER,
        'pass' => DB_PASS,
        'db' => DB_NAME
    );

    private $aErr = array();

    private $oConn;
    private $oStmt;

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

    public function prepare( $sStatement, $aDriverOptions = array() ) {
		return $this->oConn->prepare( $sStatement, $aDriverOptions );
	}

    public function lastId() {
		return $this->oConn->lastInsertId();
	}

    public function escapeStr( $sStr ) {
		return $this->oConn->quote( $sStr );
    }
    
    public function entryCount() {
		return $this->iEntryCount;
	}

    public function affectedEntryCount() {
		return $this->oStmt->rowCount();
    }

    public function query( $sQuery ) {
        unset( $this->oStmt );
        $this->oStmt = $this->oConn->prepare( $sQuery );
        $this->oStmt->execute();
    }

    // public function query( $sQuery ) {
    //     unset($this->oStmt);
	// 	$this->oStmt = $this->oConn->query( $sQuery );
	// 	if( $this->oStmt === false ) {
	// 		$aErr = $this->oConn->errorInfo();
			
	// 		if( $GLOBALS['debug'] ) {
	// 			throw new Exception( 'SqlError: ' . $aErr[1] . ' - ' . $aErr[2] . ' Query: ' . $sQuery );
	// 		} else {
	// 			throw new Exception( 'SqlError: ' . $aErr[0] );
	// 		}
			
	// 	}

	// 	return $this->oStmt->fetchAll( PDO::FETCH_ASSOC );
    // }

    public function write( $sQuery, $aParams = array() ) {
        $iAffectedRows = $this->oConn->exec( $sQuery );
		if( $iAffectedRows === false ) {
			$aErr = $this->oConn->errorInfo();
			
			if( $GLOBALS['debug'] ) {
				throw new Exception( 'SqlError: ' . $aErr[1] . ' - ' . $aErr[2] . ' Query: ' . $sQuery );
			} else {
				throw new Exception( 'SqlError: ' . $aErr[0] );
			}
			
		}
        return $iAffectedRow;
    }

}