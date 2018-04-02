<?php

session_destroy();

$oRouter = new clRouter();

$oRouter->redirect('/');

?>