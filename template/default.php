<?php
require_once( PATH_MODELS . 'navigation/clNavigation.php' );
$oNavigation = new clNavigation();
$oConfig = clRegistry::get( 'clConfig' );
$sUAcode = (($aData = $oConfig->readConfig('googleAnalyticsCode')) ? current(current( $aData )) : '');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="/css/main.min.css">
	<link rel="stylesheet" href="/css/UI.css">

    <?php if( !empty($sUAcode) && SITE_RELEASE_MODE === true ) { ?><script>
		// Google analytics
		(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

		ga('create', '<?php echo $sUAcode; ?>', 'auto');
		ga('send', 'pageview');
	</script><?php } ?>

	<script defer src="https://use.fontawesome.com/releases/v5.0.7/js/all.js"></script>
	<script
		src="https://code.jquery.com/jquery-3.3.1.min.js"
		integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
		crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>

	<link href="https://fonts.googleapis.com/css?family=Lato:400,700|Open+Sans:400,600|Roboto" rel="stylesheet">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css" integrity="sha384-3AB7yXWz4OeoZcPbieVW64vVXEwADiYyAEhwilzWsLw+9FgqpyjjStpPnpBO8o8S" crossorigin="anonymous">
	<script src="/js/templates/default/default.js"></script>

	<?php echo $sTop; ?>


</head>
<body>
<main class="wrapper">
	<header class="fixed">
		<div id="content">
			<a href="/" class="logo" ><img src="/images/logo.png" /></a>
			<div class="right">
				<a href="/" class="expandMenu"><i class="fas fa-bars"></i></a>
				<?php echo $oNavigation->buildMenu(0, 1, 'guest'); ?>
			</div>
		</div>
	</header>
	<main id="content">
		<?php echo $sContent; ?>
	</div>
</main>
<?php echo $sBottom; ?>
</body>
</html>