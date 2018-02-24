<?php
$oRouter = new clRouter();

if( !isset($_SESSION['userId']) ) {
    $oRouter->redirect( '/admin/login' );
}
?>
