<?php

session_destroy();
unset( $_COOKIE['username'], $_COOKIE['userpass'] );

$oRouter = new clRouter();

$oRouter->redirect('/');

?>