<?php

require_once( PATH_MODELS . 'infoContent/clInfoContent.php' );

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
		$sRender = ob_get_clean();
		
		// dump( preg_match("/\{view:(.*)\}/", $sRender) );

		if( preg_match("/\{view:(.*)\}/", $sRender) ) {
			$aOutput = array();
			preg_match_all("/\{view:(.*)\}/", $sRender, $aOutput );
			for( $i = 0; $i < count($aOutput[1]); $i++ ) {
				$aOutput[1][$i] = $this->render( PATH_VIEWS . '/' . $aOutput[1][$i] . '.php' );
			}
			$sRender = str_replace($aOutput[0], $aOutput[1], $sRender );
			// dump( $aOutput );
		}
		if( preg_match("/\{render:(.*)\}/", $sRender) ) {
			$aOutput = array();
			preg_match_all("/\{render:(.*)\}/", $sRender, $aOutput );
			// dump( $aOutput );
			for( $i = 0; $i < count($aOutput[1]); $i++ ) {
				$oInfoContent = new clInfoContent();
				$aInfoContent = $oInfoContent->read( $aOutput[1][$i] );
				$aOutput[1][$i] = $aInfoContent['contentText'];
			}

			$sRender = str_replace($aOutput[0], $aOutput[1], $sRender );
			// dump( $aOutput );
		}
		return $sRender;
	}

}