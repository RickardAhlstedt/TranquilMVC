<?php

require_once( PATH_CORE . 'clDbPDO.php' );

class clNavigation {
	
	private $oDb;

	public function __construct() {
		$this->oDb = new clDbPDO();
	}

	public function readGroup( $sGroup = 'guest' ) {
		$this->oDb->query(
			"SELECT
				navigationId, navigationParentId, navigationName
			FROM
				`entNavigation`
			WHERE
				`navigationGroup`='$sGroup'
			ORDER BY
				navigationParentId, navigationName
			"
		);
		return $this->oDb->resultSet();
	}

// Array
// (
//     [0] => Array
//         (
//             [navigationId] => 1
//             [navigationParentId] => 0
//             [navigationName] => Home
//         )

//     [1] => Array
//         (
//             [navigationId] => 2
//             [navigationParentId] => 1
//             [navigationName] => Sub
//         )

// )

	public function buildMenu( $iParentId, $aMenuData = array() ) {
		$sOutput = '<ul>';

		foreach( $aMenuData as $aEntry ) {
			if( $aEntry['navigationParentId'] == 0 ) {
				$sOutput .= '<li class="' . $aEntry['navigationName'] . '">' . $aEntry['navigationName'] . '</li>';
			} elseif( $aEntry['navigationParentId'] == 1 ) {
				$sOutput .= '<ul class="subList"><li class="' . $aEntry['navigationName'] . '">' . $aEntry['navigationName'] . '</li></ul>';
			}
		}

		$sOutput .= '</ul>';
		return $sOutput;
	}

}