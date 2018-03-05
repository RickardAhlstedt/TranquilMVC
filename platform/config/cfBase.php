<?php

define( 'SITE_RELEASE_MODE', false );

define( 'DB_HOST', 'localhost' );
define( 'DB_USER', 'root' );
define( 'DB_PASS', '' );
define( 'DB_NAME', 'tranquil_db' );

define( 'USER_PASS_SALT', 'tranquil2k18' );
define( 'USER_TIMEOUT', 3600 );
define( 'SITE_SESSION_TIMEOUT', USER_TIMEOUT );

define( 'PATH_APPLICATION', 'platform/' );

define( 'PATH_TEMPLATE', PATH_APPLICATION . 'template/' );
define( 'PATH_VIEWS', PATH_APPLICATION . 'views' );
define( 'PATH_CORE', PATH_APPLICATION . 'core/' );
define( 'PATH_CONFIG', PATH_APPLICATION . 'config/' );
define( 'PATH_FUNCTIONS', PATH_APPLICATION . 'functions/' );
define( 'PATH_MODELS', PATH_APPLICATION . 'models/' );
define( 'PATH_LOG', PATH_APPLICATION . 'logs/' );

define( 'PATH_UPLOAD_IMAGE', 'images/upload/' );

$GLOBALS['debug'] = true;