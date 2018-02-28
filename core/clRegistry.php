<?php

class clRegistry {

	static private $aObjects = array();

	static public function add( $oObject, $sName = null ) {
		$sName = (!is_null($sName)) ? $sName : get_class($oObject);
		$return = null;
		if(isset(self::$aObjects[$sName]))
		{
			$return = self::$aObjects[$sName];
		}
		self::$aObjects[$sName] = $oObject;
		return $return;
	}

	static public function get($sName) {
		if(!self::contains($sName))
		{
			throw new Exception("Object does not exist in registry");
		}
		return self::$aObjects[$sName];
	}
	
	static public function contains($sName) {
		if(!isset(self::$aObjects[$sName]))
		{
			return false;
		}
		return true;
	}

	static public function remove($sName) {
        if(self::contains($sName))
        {
            unset(self::$aObjects[$sName]);
        }
    }

}