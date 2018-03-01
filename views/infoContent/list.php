<?php

require_once( PATH_MODELS . 'infoContent/clInfoContent.php' );
require_once( PATH_CORE . 'clTableHtml.php' );

$oTemplate = clRegistry::get( 'clTemplate' );
$oTemplate->setTitle( 'Add content' );

$oInfoContent = new clInfoContent();
$oTableOutput = new clTableHtml();

$aContent = $oInfoContent->readAll( array('*') );

$oTableOutput->setHeaders( array(
	'test',
	'test2',
	'test3'
) );

$oTableOutput->addRow( array(
	'content',
	'content2',
	'content3'
) );

$oTableOutput->addRow( array(
	'content4',
	'content5',
	'content6'
) );

?>
<div id="content">
	<?php 
		dump($aContent);
		echo '<div class="panel">' . $oTableOutput->render() . '</div>';
	?>
</div>
