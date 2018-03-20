<?php

define( 'SITE_TITLE', 'Tranquil' );
define( 'SITE_RELEASE_MODE', false );

define( 'DB_HOST', 'localhost' );
define( 'DB_USER', 'root' );
define( 'DB_PASS', '' );
define( 'DB_NAME', 'tranquil_db' );

define( 'USER_PASS_SALT', 'tranquil2k18' );
define( 'USER_TIMEOUT', 3600 );
define( 'SITE_SESSION_TIMEOUT', USER_TIMEOUT );

define( 'PATH_TEMPLATE', 'template/' );
define( 'PATH_VIEWS', 'views' );
define( 'PATH_CORE', 'core/' );
define( 'PATH_CONFIG', 'config/' );
define( 'PATH_FUNCTIONS', 'functions/' );
define( 'PATH_MODELS', 'models/' );
define( 'PATH_LOG', 'logs/' );

define( 'PATH_UPLOAD_IMAGE', 'images/upload/' );

$GLOBALS['debug'] = true;
$GLOBALS['enviroment'] = 'development';