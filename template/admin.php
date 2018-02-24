<?php

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link href="https://fonts.googleapis.com/css?family=Lato:400,700|Open+Sans:400,600|Roboto" rel="stylesheet">
    <link rel="stylesheet" href="//localhost/css/admin.css">

    <title>Admin</title>
    <?php
        if( array_key_exists('head', $aParams) ) {
            foreach( $aParams['head'] as $aEntry ) {
                echo $aEntry . "\n";
            }
        }
    ?>
</head>
<body>
    <div id="content-wrapper" class="">
    <?php
        echo render($aParams['content']);
        
        
        if( array_key_exists('bottom', $aParams) ) {
            foreach( $aParams['bottom'] as $aEntry ) {
                echo $aEntry . "\n";
            }
        }
    ?>
    </div>
    <footer>
    </footer>
</body>
</html>