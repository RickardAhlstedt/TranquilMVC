<?php

class clTableHtml {

	private $aAttributes = array();
	private $aTableHeaders = array();
	private $aTableContent = array();

	public function __construct( $aAttributes = array() ) {
		$this->aAttributes = $aAttributes;
	}

	public function setHeaders( $aTableHeaders = array() ) {
		$this->aTableHeaders = $aTableHeaders;
	}

	public function addRow( $aRow = array() ) {
		$this->aTableContent[] = $aRow;
	}

	public function render() {
		$sClass = '';
		$sTableRows = '';
		if( !empty($aAttributes['class']) ) {
			$sClass = $aAttributes['class'];
		}

		$sTable = '<table class="' . $sClass . '">';
		$sTableHeader = '<thead><tr>';
		foreach( $this->aTableHeaders as $sEntry ) {
			$sTableHeader .= '<th>' . $sEntry . '</th>';
		}
		$sTableHeader .=  '</tr></thead>';
		
		$sTableBody = '<tbody>';
		foreach( $this->aTableContent as $aEntry ) {
			$sTableRows .= '<tr>';
			foreach( $aEntry as $sEntry ) {
				$sTableRows .= '<td>' . $sEntry . '</td>';
			}
			$sTableRows .= '</tr>';
		}
		$sTableBody .= $sTableRows . '</tbody>';


		$sTable .= $sTableHeader . $sTableBody . '</table>';

		return $sTable;
	}

}