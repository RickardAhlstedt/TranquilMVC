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

	<?php if( !empty($sUAcode) && SITE_RELEASE_MODE === true ) { ?><script>
		// Google analytics
		(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

		ga('create', '<?php echo $sUAcode; ?>', 'auto');
		ga('send', 'pageview');
	</script><?php } ?>

	<link rel="stylesheet" href="/css/test.css">
	<link rel="stylesheet" href="/css/UI.css">
	
	<script defer src="https://use.fontawesome.com/releases/v5.0.7/js/all.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<link href="https://fonts.googleapis.com/css?family=Lato:400,700|Open+Sans:400,600|Roboto" rel="stylesheet">

	<?php echo $sTop; ?>
	<title></title>
</head>
<body>
	<div id="wrapper">
		<header>
			<div class="top-promotion">
				<img src="/images/templates/e-commerce/banner.jpg" />
				<div class="close-btn"><a href="#"><i class="fas fa-times-circle"></i></a></div>
			</div>
			<div class="pre-header">
				<div class="content">
					<div class="left">left-side</div>
					<div class="right">right-side</div>
				</div>
			</div>
			<div class="container">
				<div class="left">
					<a href="/" class="logo" ><img src="/images/logo.png" /></a>
				</div>
				<div class="right">right-side</div>
			</div>
			<hr>
			<nav id="mainNav">
				<?php echo $oNavigation->buildMenu(0, 1, 'guest'); ?>
			</nav>
		</header>
	<?php echo $sContent; ?>


	</div>

<?php echo $sBottom; ?>

<script src="/js/templates/e-commerce/script.js"></script>

</body>
</html>