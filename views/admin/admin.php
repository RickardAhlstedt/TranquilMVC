<?php
$oRouter = new clRouter();
$oConfig = new clConfig();

dump( $_SESSION );
dump( $_GET );


if( empty($_SESSION['userId']) ) {
    $oRouter->redirect( '/admin/login' );
}

?>
