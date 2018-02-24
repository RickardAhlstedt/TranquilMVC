<?php
require_once( PATH_CORE . 'clDbPDO.php' );

class login {

	private $oDb;

	public function __construct() {
		$this->oDb = new clDbPDO();
		
	}
	
	public function saltPassword( $sUsername, $sUserpass ) {
		return md5( $sUsername . $sUserpass . USER_PASS_SALT );
	}

	// public function loginFromCookies( $sUsername, $sUserpass ) {
	// 	$sUsername = $this->oDb->escapeStr( $sUsername );
	// 	$sUserpass = $this->oDb->escapeStr( $sUserpass );
	// 	$this->oDb->query("SELECT * FROM `entUsers` WHERE `userName`=$sUsername AND `userPass`=$sUserpass");
	// 	$aRow = $this->oDb->single();
	// 	if( !empty($aRow) ) {
	// 		// User found
	// 		$_SESSION['userId'] = $aRow['userId'];
	// 		$_SESSION['userName'] = $aRow['userName'];
	// 		$_SESSION['userStatus'] = $aRow['userStatus'];
			
	// 		$iUserId = $aRow['userId'];
	// 		$oLastLogin = date( "Y-m-d H:i:s", time() );

	// 		$this->oDb->query("UPDATE `entUsers` SET `userLastLogin`='$oLastLogin' WHERE `userId`=\"$iUserId\"");
	// 		$aResult = $this->oDb->execute();
	// 		return true;
	// 	} else {
	// 		return false;
	// 	}
	// }

	public function login( $sUsername, $sUserpass ) {
		$sUsername = $this->oDb->escapeStr( $sUsername );
		$sUserpass = $this->oDb->escapeStr( $sUserpass );
		$sUserpass = md5( $sUsername . $sUserpass . USER_PASS_SALT );
		$this->oDb->query("SELECT * FROM `entUsers` WHERE `userName`=$sUsername AND `userPass`='$sUserpass'");
		$aRow = $this->oDb->single();
		if( !empty($aRow) ) {
			// User found
			$_SESSION['userId'] = $aRow['userId'];
			$_SESSION['userName'] = $aRow['userName'];
			$_SESSION['userStatus'] = $aRow['userStatus'];
			
			$iUserId = $aRow['userId'];
			$oLastLogin = date( "Y-m-d H:i:s", time() );

			$this->oDb->query("UPDATE `entUsers` SET `userLastLogin`='$oLastLogin' WHERE `userId`='$iUserId'");
			$aResult = $this->oDb->execute();
			return true;
		} else {
			return false;
		}
	}

}
