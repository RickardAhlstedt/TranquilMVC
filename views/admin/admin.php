<?php

$oRouter = clRegistry::get( 'clRouter' );
$oConfig = clRegistry::get( 'clConfig' );
$oTemplate = clRegistry::get( 'clTemplate' );

$oTemplate->setTitle('Admin');

if( !empty($_POST) ) dump($_POST);

require_once( PATH_MODELS . 'infoContent/clInfoContent.php' );
$oInfoContent = new clInfoContent();

require_once( PATH_CORE . 'clOutputFormHtml.php' );
$oForm = new clOutputFormHtml( array(
	'enctype' => 'multipart/form-data'
) );
$oForm->setDataDict( $oInfoContent->aFormDataDict );
echo $oForm->render();

$oTemplate->addBottom( array(
	'key' => 'CKEditor',
	'content' => '<script src="https://cdn.ckeditor.com/4.8.0/standard/ckeditor.js"></script>'
) );
$oTemplate->addBottom( array(
	'key' => 'CKEditorInit',
	'content' => '
	<script>
		CKEDITOR.config.allowedContent=true;
		CKEDITOR.replace( "contentText", {
			extraAllowedContent: "*"
		} );

	</script>'
) );

?>


