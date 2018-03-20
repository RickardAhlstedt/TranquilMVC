<?php

require_once( PATH_CORE . 'clDbPDO.php' );

class clRouter {

	private $oDb;

	public $sPath;

	public function __construct() {
		$this->oDb = new clDbPDO();
	}

	public function getRoutePath() {
		if( isset($_SERVER['PATH_INFO']) ) {
			$sPath = $_SERVER['PATH_INFO'];
			
		} else {
			$sQuery = strpos( $_SERVER['REQUEST_URI'], '?' );
			
			if( $sQuery === false ) {
				$sPath = $_SERVER['REQUEST_URI'];
				
			} else {
				$sPath = substr( $_SERVER['REQUEST_URI'], 0, $sQuery );
				
			}
			
			$sPath = rawurldecode( $sPath );
			//$sPath = rawurldecode( str_replace(dirname($_SERVER['SCRIPT_NAME']), '', $sPath) );
		}
	
		return '/' . trim( $sPath, '/' );
	}
	
	public function read( $sRoute ) {
		// SELECT * FROM `entRoutes` WHERE `routePath` LIKE '%/%'
		$this->oDb->query( "SELECT * FROM `entRoutes` WHERE `routePath` LIKE '%$sRoute%'" );
		$aData = $this->oDb->single();
		if( !empty( $aData ) ) {
			return $aData;
		} else {
			return false;
		}
	}

	public function readAll( $aFields = array() ) {
		$sFields = implode( " ", $aFields );
		$this->oDb->query( "SELECT $sFields FROM `entRoutes`" );
		return $this->oDb->resultset();
	}

	public function readByViewId( $iViewId ) {
		$this->oDb->query( "SELECT * FROM `entRoutes` WHERE `routeViewId`=$iViewId" );
		return $this->oDb->single();
	}

	public function getIdByRoute( $sRoute ) {
		$this->oDb->query( "SELECT `routeViewId` FROM `entRoutes` WHERE `routePath` LIKE '%$sRoute%'" );
		return $this->oDb->single();
	}

	public function createRoute( $aData = array() ) {
		$sRoutePath = $aData['routePath'];
		$sRouteTemplate = $aData['routeTemplate'];
		$sRouteModel = $aData['routeModel'];
		$sRouteView = $aData['routeView'];
		$sRouteViewId = $aData['routeViewId'];
		$sRouteCreated = strtotime( "Y-m-d H:i:s" );
		$this->oDb->query( "INSERT INTO `entroutes`(`routePath`, `routeTemplate`, `routeModel`, `routeView`, `routeViewId`, `routeCreated`) VALUES (
			'$sRoutePath',
			'$sRouteTemplate',
			'$sRouteModel',
			'$sRouteView',
			$sRouteViewId,
			'$sRouteCreated'
		)" );
		$this->oDb->execute();
		return $this->oDb->lastInsertId();
	}

	public function deleteByViewId( $iViewId ) {
		$this->oDb->query( "DELETE FROM `entroutes` WHERE `routeViewId`=$iViewId" );
		return $this->oDb->execute();
	}

	public function deleteByRouteId( $iRouteId ) {
		$this->oDb->query( "DELETE FROM `entroutes` WHERE `routeId`=$iRouteId" );
		return $this->oDb->execute();
	}

	public function redirect( $sPath ) {
		header( 'location: ' . $sPath );
		exit;
	}
}