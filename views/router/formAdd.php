<?php
require_once( PATH_CORE . 'clRouter.php' );
$oRouter = new clRouter();

$oTemplate = clRegistry::get( 'clTemplate' );

$aErr = array();
$aData = array();

$aTmp = array();
$aTemplates = array();
$objects = new RecursiveIteratorIterator(new RecursiveDirectoryIterator(PATH_TEMPLATE), RecursiveIteratorIterator::SELF_FIRST);
foreach($objects as $name => $object){
	if( is_file( $name ) ) {
		$aTmp[] = $name;
	}
}
foreach( $aTmp as $sLine ) {
	$aBits = explode( "\\", $sLine );
	$aTemplates[] = $aBits[1];
}

$sTemplates = '<select id="routeTemplate" name="routeTemplate">';
foreach( $aTemplates as $sTemplate ) {
	$sTemplates .= '<option value="' . $sTemplate . '">' . $sTemplate . '</option>';
}
$sTemplates .= '</select>';

if( !empty($_POST['frmSaveRoute']) ) {
	if( !empty($_GET['routeId']) && ctype_digit($_GET['routeId']) ) {
		$iRouteId = $_GET['routeId'];
		// $aResult = $oInfoContent->update( $iContentId, $_POST );
		if( !empty($aResult) ) {
			
		} else {
			$aErr[] = 'Error updating page';
		}
	} else {
		// Create
		$aResult = $oRouter->createRoute( $_POST );
		if( !empty($aResult) ) {
			$iRouteId = $aResult;
		} else {
			$aErr[] = 'Error creating route';
		}
	}

	if( empty($_GET['routeId']) ) {
		$oRouter->redirect( '/admin/routes/add?routeId=' . $iRouteId );
	}
}

if( isset($_GET['routeId']) && ctype_digit($_GET['routeId']) ) {
	$aData = $oRouter->readByRouteId($_GET['routeId']);
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
	<fieldset id="route">
		<legend>Route</legend>
		<label for="routePath">Path</label>
		<input type="text" id="routePath" name="routePath" />
		<label for="routeTemplate">Template</label>
		<?php echo $sTemplates; ?>
		<label for="routeModel">Model</label>
		<input type="text" id="routeModel" name="routeModel" />
		<label for="routeView">View</label>
		<input type="text" id="routeView" name="routeView" />
		<label for="routeViewId">View-Id</label>
		<input type="text" id="routeViewId" name="routeViewId" />
	</fieldset>
	<input type="hidden" name="frmSaveRoute" value="true" />
	<button type="submit" class="raised">Save</button>
</form>
