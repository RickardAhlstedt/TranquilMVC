<?php

require_once( PATH_CORE . 'clTableHtml.php' );
$oRouter = clRegistry::get( 'clRouter' );

$oTemplate = clRegistry::get( 'clTemplate' );
$oTemplate->setTitle( 'Routes' );

$oTableOutput = new clTableHtml();

if( !empty($_GET['delete']) && ctype_digit($_GET['delete']) ) {
	$iRouteId = $_GET['delete'];
	$oRouter->deleteByRouteId( $iRouteId );
}

$aRoutes = $oRouter->readAll( array('*') );

$oTableOutput->setHeaders( array(
	'ID',
	'Path',
	'Template',
	'Model',
	'View',
	'Parent-ID',
	'Created',
	'Updated'
) );

foreach( $aRoutes as $aEntry ) {
	$oTableOutput->addRow( array(
		'<a href="/admin/routes/add?routeId=' . $aEntry['routeId'] . '">' . $aEntry['routeId'] . '</a>',
		'<a href="'. $aEntry['routePath'] . '">' . $aEntry['routePath'] . '</a>',
		$aEntry['routeTemplate'],
		$aEntry['routeModel'],
		$aEntry['routeView'],
		$aEntry['routeViewId'],
		substr($aEntry['routeCreated'], 0, 16),
		substr($aEntry['routeUpdated'], 0, 16),
		'<a href="/admin/routes/add?routeId=' . $aEntry['routeId'] . '"><i class="fas fa-edit"></i>Edit</a>
		<a href="/admin/routes?delete=' . $aEntry['routeId'] . '" class="linkConfirm" title="Do you, really, want to delete this item?"><i class="fas fa-trash-alt"></i>Delete</a>'
	) );
}

echo '
<h1>Routes</h1>
<div class="panel">
	<h2>Tools</h2>
	<a href="/admin/routes/add"><i class="fas fa-plus"></i> Add new route</a>
</div>
<div class="panel">
	' . $oTableOutput->render() . '
</div>';

$oTemplate->addTop( array(
	'key' => 'infoContentScript',
	'content' => '<script src="/js/admin/admin.js"></script>'
) );