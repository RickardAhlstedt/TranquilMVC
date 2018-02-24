<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="css/main.min.css">
    <title></title>

    <?php
        if( array_key_exists('head', $aParams) ) {
            foreach( $aParams['head'] as $aEntry ) {
                echo $aEntry . "\n";
            }
        }
    ?>

</head>
<body>

<?php
    echo render($aParams['content']);
    
    
    if( array_key_exists('bottom', $aParams) ) {
        foreach( $aParams['bottom'] as $aEntry ) {
            echo $aEntry . "\n";
        }
    }
?>

</body>
</html>