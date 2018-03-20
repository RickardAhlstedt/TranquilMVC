<?php

require_once( PATH_CORE . 'clDbPDO.php' );

class clNavigation {
	
	private $oDb;

	public function __construct() {
		$this->oDb = new clDbPDO();
	}

	public function buildMenu( $iParentId, $iLevel, $sGroup = 'guest' ) {
		$this->oDb->query(
			"SELECT
				a.navigationId, a.navigationParentId, a.navigationName, a.navigationHref, a.navigationBehavior, a.navigationPrefixContent, Deriv1.Count
			FROM
				`entnavigation` a
			LEFT OUTER JOIN (SELECT navigationParentId, COUNT(*) as COUNT FROM 
				`entnavigation`
			GROUP BY navigationParentId)
				Deriv1 ON a.navigationId = Deriv1.navigationParentId
			WHERE
				a.navigationParentId=$iParentId
			AND
				`navigationGroup`='$sGroup'"
		);
		$aResult = $this->oDb->resultSet();
		$sClass = '';
		if( $iLevel <= 1 ) $sClass = 'navMain';
		elseif( $iLevel >= 2 ) $sClass = 'subMenu';
		echo '<ul class="' . $sClass . '">';		
		foreach( $aResult as $aEntry ) {
			if( $aEntry['Count'] > 0 ) {
				echo '<li><a href="' . $aEntry['navigationHref'] . '" target="' . $aEntry['navigationBehavior'] . '">' . $aEntry['navigationPrefixContent'] . '<span>' . $aEntry['navigationName'] . '</span></a>';
					$this->buildMenu( $aEntry['navigationId'], $iLevel + 1 );
				echo '</li>';
			} elseif( $aEntry['Count'] == '0' || empty( $aEntry['Count'] ) ) {
				echo '<li><a href="' . $aEntry['navigationHref'] . '" target="' . $aEntry['navigationBehavior'] . '">' . $aEntry['navigationPrefixContent'] . '<span>' . $aEntry['navigationName'] . '</span></a><li>';
			} else;
		}
		echo '</ul>';
	}

}