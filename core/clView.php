<?php

class clView {

	private $sView = '';

	public function __construct( $sView = 'index.php') {
		$this->sView = $sView;
	}

	public function setView( $sView ) {
		$this->sView = $sView;
	}

	public function getView() {
		return $this->sView;
	}

	public function render( $sPath, $aParams = array() ) {
		if( is_array($aParams) && !empty($aParams) ) {
			extract( $aParams );
		}
		ob_start();
		include $sPath;
		return ob_get_clean();
	}

}