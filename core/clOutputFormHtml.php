<?php

class clOutputFormHtml {

	public $aDataDict = array();
	public $iFormId = 1;

	public $aParams = array();

	public function __construct( $aParams = array() ) {
		$aParams += array(
			'method' => 'post',
			'action' => $_SERVER['PHP_SELF'],
			'autocomplete' => 'on',
			'class' => 'form',
			'labels' => true
		);
		$this->aParams = $aParams;
	}

	public function setDataDict( $aDataDict ) {
		$this->aDataDict = $aDataDict;
	}

	public function dumpElements() {
		dump( $this->aDataDict );
	}

	public function render() {
		$sElements = '';
		$sOutput = '';

		$this->iFormId++;
		foreach( $this->aDataDict as $aEntry) {
			if( $this->aParams['labels'] == true ) {
				$sLabel = '<label for="' . $aEntry['title'] . '">' . $aEntry['title'] . '</label>';
			}
			switch( $aEntry['type'] ) {
				case 'textarea':
					$sInput = $this->generateTextarea( $aEntry );
					break;
				case 'button':
					$sLabel = '';
					$sInput = $this->generateSubmit( $aEntry );
					break;
				case 'array':
				case 'select':
					$sInput = $this->generateSelect( $aEntry );
					break;
				case 'hidden':
					$sLabel = '';
					$sInput = '<input type="hidden" name="' . $aEntry['title'] . '" value="' . $aEntry['value'] . '" />';
				case 'text':
				default:
					$sInput = $this->generateText( $aEntry );
					break;
			}
			$sElements .= $sLabel . '<p>' . $sInput . '</p>';
		}
		$sOutput = '
			<form action="' . $this->aParams['action'] . '" method="' . $this->aParams['method'] . '" class="' . $this->aParams['class'] . '">
				<input type="hidden" name="action" value="submit_' . $this->iFormId . '" />
				' . $sElements . '
			</form>';
		return $sOutput;
	}

	private function generateSelect( $aParams = array() ) {
		$sClass = '';
		if( !empty($aParams['attributes']) ) {
			$sClass = !empty( $aParams['attributes']['class'] ) ? $aParams['attributes']['class'] : '';
		}
		$sOptions = '';
		foreach( $aParams['values'] as $sKey => $sValue ) {
			$sOptions .= '<option value="' . $sKey . '">' . $sValue . '</option>';
		}
		return '<select name="' . $aParams['title'] . '"class="' . $sClass . '">' . $sOptions . '</select>';
	}

	private function generateSubmit( $aParams = array() ) {
		$sClass = '';
		if( !empty($aParams['attributes']) ) {
			$sClass = !empty( $aParams['attributes']['class'] ) ? $aParams['attributes']['class'] : '';
		}
		// return '<input type="submit" name="' . $aParams['title'] . '" value="' . $aParams['title'] . '" class="' . $sClass . '">';
		return '<button name="' . $aParams['title'] . '" value="' . $aParams['title'] . '" class="' . $sClass . '">' . $aParams['title'] . '</button>';
	}

	private function generateText( $aParams = array() ) {
		$sClass = '';
		$sPlaceholder = '';
		if( !empty($aParams['attributes']) ) {
			$sClass = !empty( $aParams['attributes']['class'] ) ? $aParams['attributes']['class'] : '';
			$sPlaceholder = !empty( $aParams['attributes']['placeholder'] ) ? $aParams['attributes']['placeholder'] : '';
		}
		$sValue = !empty($aParams['value'] ) ? $aParams['value'] : '';
		return '<input type="text" name="' . $aParams['title'] . '" class="' . $sClass . '" placeholder="' . $sPlaceholder . '" value="' . $sValue . '">';
	}

	private function generateTextarea( $aParams = array() ) {
		$sClass = '';
		if( !empty($aParams['attributes']) ) {
			$sClass = !empty( $aParams['attributes']['class'] ) ? $aParams['attributes']['class'] : '';
		}
		$sValue = !empty($aParams['value'] ) ? $aParams['value'] : '';
		return '<textarea name="' . $aParams['title'] . '" class="' . $sClass . '">' . $sValue . '</textarea>';
	}

}