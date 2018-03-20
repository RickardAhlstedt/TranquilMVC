<?php

require_once( PATH_CORE . 'clDbPDO.php' );

class clPagination {

	private $iLimit = 20;
	private $iPage = 1;

	public $sQueryString = '';

	public $oDb;

	public function __construct( $oDb, $iLimit = 20 ) {
		$this->oDb = $oDb;
		if( !empty($iLimit) ) $this->iLimit = $iLimit;
		if( !empty($_GET['page']) ) {
			if( $_GET['page'] == 'all' ) {
				$this->sQueryString = '';
			} else {
				$this->sQueryString = " LIMIT " . ( ($_GET['page'] - 1) * $this->iLimit ) . ", $this->iLimit";
			}
		} else {
			$this->sQueryString = '';
		}
	}

	public function render() {
		if( !empty($_GET['page']) && $_GET['page'] == 'all' )
			return '';
		
		$iTotal = $this->getTotal();
		$iLast = ceil( $iTotal / $this->iLimit );
		$iStart = ( ($this->iPage - 7) > 0 ) ? $this->iPage - 7 : 1;
		$iEnd = ( ($this->iPage + 7) < $iLast ) ? $this->iPage + 7 : $iLast;

		$sHtml = '<ul class="pagination">';
		$sClass = ($this->iPage == 1 ) ? 'disabled' : '';
		$sHtml .=
			'<li class="' . $sClass . '"><a href="?page=' . ( $this->iPage - 1 ) . '">&laquo;</a></li>';
		
		if( $iStart > 1 ) {
			$sHtml .= '<li>a href="?page=1">1</a></li>';
			$sHtml .= '<li class="disabled"><span>...</span></li>';
		}
		for( $i = $iStart; $i <= $iEnd; $i++ ) {
			$sClass = ( $this->iPage == $i ) ? 'active' : '';
			$sHtml .=
			'<li class="' . $sClass . '"><a href="?page=' . $i . '">' . $i . '</a></li>';
		}

		if( $iEnd < $iLast ) {
			$sHtml .= '<li class="disabled"><span>...</span></li>';
			$sHtml .= '<li>a href="?page=' . $iLast . '">' . $iLast . '</a></li>';
		}

		$sClass = ($this->iPage == $iLast ) ? 'disabled' : '';
		$sHtml .= '<li class="' . $sClass . '"><a href="?page=' . ( $this->iPage + 1 ) . '">&raquo;</a></li>';

		$sHtml .= '</ul>';
		$sHtml .= '<br />Total entries: ' . $iTotal;

		return $sHtml;
	}

	public function getTotal( ) {
		$iRowCount = $this->oDb->rowCount();
		return $iRowCount;
	}

	public function getQuery() {
		return $this->sQueryString;
	}

}