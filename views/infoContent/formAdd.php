<?php
require_once( PATH_MODELS . 'infoContent/clInfoContent.php' );
$oInfoContent = new clInfoContent();

$oTemplate = clRegistry::get( 'clTemplate' );
$oRouter = clRegistry::get( 'clRouter' );

$aErr = array();
$aData = array();

if( !empty($_POST['frmAddContent']) ) {
	if( !empty($_GET['contentId']) && ctype_digit($_GET['contentId']) ) {
		$iContentId = $_GET['contentId'];
		$aResult = $oInfoContent->update( $iContentId, $_POST );
		if( !empty($aResult) ) {
			
		} else {
			$aErr[] = 'Error updating page';
		}
	} else {
		// Create
		$iContentId = $oInfoContent->create( $_POST );
		if( !empty($iContentId) ) {
			$_POST['routeViewId'] = $iContentId;
			$aResult = $oRouter->createRoute( $_POST );
			if( !empty($aResult) ) {

			} else {
				$aErr[] = 'Error creating route';
			}
		}
	}

	if( empty($_GET['contentId']) ) {
		$oRouter->redirect( '/admin/infoContent/add?contentId=' . $iContentId );
	}
}

if( isset($_GET['contentId']) && ctype_digit($_GET['contentId']) ) {
	$aData = $oRouter->readByViewId($_GET['contentId']);
	$aData = array_merge( $aData, $oInfoContent->read( $_GET['contentId'] ) );
	$aData = json_encode($aData);

	$oTemplate->addBottom( array(
		'key' => 'autoFill',
		'content' => "
		<script>
			var data = $aData;
			var frm = $('form');
			$.each(data, function(key, value) {  
				var ctrl = $('[name='+key+']', frm);  
				switch(ctrl.prop('type')) { 
					case 'radio': case 'checkbox':   
						ctrl.each(function() {
							if($(this).attr('value') == value) $(this).attr('checked',value);
						});   
						break;  
					default:
						ctrl.val(value); 
				}  
			});  
		</script>"
	) );
}

?>

<form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post">
	<fieldset id="pageContent">
		<legend>Page-content</legend>
		<label for="contentTitle">Title</label>
		<input type="text" id="contentTitle" name="contentTitle" />
		<label for="routePath">Route</label>
		<input type="text" id="routePath" name="routePath" />
		<input type="hidden" name="routeTemplate" value="<?php echo DEFAULT_TEMPLATE; ?>" />
		<input type="hidden" name="routeModel" value="infoContent" />
		<input type="hidden" name="routeView" value="show" />
		<label for="contentText">Content</label>
		<textarea id="contentText" name="contentText" class="editor"></textarea>
	</fieldset>
	<fieldset id="pageMeta">
		<legend>Meta</legend>
		<label for="contentMetaKeywords">Keywords</label>
		<input type="text" id="contentMetaKeywords" name="contentMetaKeywords" />
		<label for="contentMetaDescription">Description</label>
		<input type="textarea" rows="4" cols="50" id="contentMetaDescription" name="contentMetaDescription" />
		<label for="contentMetaCanonicalUrl">Canonical-URL</label>
		<input type="text" id="contentMetaCanonicalUrl" name="contentMetaCanonicalUrl" />
	</fieldset>
	<fieldset id="pageSettings">
		<legend>Settings</legend>
		<label for="contentStatus">Status</label>
		<select name="contentStatus" id="contentStatus" style="width: 100%;">
			<option value="active">Active</option>
			<option value="preview">Preview</option>
			<option value="inactive">Inactive</option>
		</select>
	</fieldset>
	<input type="hidden" name="frmAddContent" value="true" />
	<button type="submit" class="raised">Save</button>
</form>

<?php

$oTemplate->addBottom( array(
	'key' => 'autoRoutePath2',
	'content' => '
		<script>
			$("#contentTitle").keyup( function() {
				var sContent = $(this).val();
				sContent = strToUrl( "/" + sContent );
				$("input#routePath").val(sContent);
				$("input#routePath").trigger("update");
			} );
			$(document).ready( function() {
				if( $("input#routePath").val() == "" ) {
					$("input#routePath").val( "/" )
				}
			} );
		</script>'
) );

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
