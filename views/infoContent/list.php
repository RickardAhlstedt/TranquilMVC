<?php

require_once( PATH_MODELS . 'infoContent/clInfoContent.php' );
require_once( PATH_CORE . 'clTableHtml.php' );

$oRouter = clRegistry::get( 'clRouter' );

$oTemplate = clRegistry::get( 'clTemplate' );
$oTemplate->setTitle( 'Add content' );
$oTemplate->addTop( array(
	'key' => 'infoContentScript',
	'content' => '<script src="/js/admin/infoContent.js"></script>'
) );
$oInfoContent = new clInfoContent();
$oTableOutput = new clTableHtml();

$aContent = $oInfoContent->readAll( array('*') );

$oTableOutput->setHeaders( array(
	'Title',
	'Created',
	'Updated',
	'Controls'
) );

if( !empty($_GET['delete']) && ctype_digit($_GET['delete']) ) {
	$iContentId = $_GET['delete'];
	$oInfoContent->delete( $iContentId );
	$oRouter->deleteByViewId( $iContentId );
}

foreach( $aContent as $aEntry ) {
	$oTableOutput->addRow( array(
		'<a href="/admin/infoContent/add?contentId=' . $aEntry['contentId'] . '">' . $aEntry['contentTitle'] . '</a>',
		substr($aEntry['contentCreated'], 0, 16),
		substr($aEntry['contentUpdated'], 0, 16),
		'<a href="/admin/infoContent/add?contentId=' . $aEntry['contentId'] . '"><i class="fas fa-edit"></i>Edit</a>
		<a href="/admin/infoContent?delete=' . $aEntry['contentId'] . '" class="linkConfirm" title="Do you, really, want to delete this item?"><i class="fas fa-trash-alt"></i>Delete</a>'
	) );
}


echo '
<h1>Pages</h1>
<div class="panel">
	<h2>Tools</h2>
	<a href="/admin/infoContent/add"><i class="fas fa-plus"></i> Add new page</a>
</div>
<div class="panel">
	' . $oTableOutput->render() . '
</div>';
