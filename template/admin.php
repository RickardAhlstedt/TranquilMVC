<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">

	<script defer src="https://use.fontawesome.com/releases/v5.0.7/js/all.js"></script>
	<link href="https://fonts.googleapis.com/css?family=Lato:400,700|Open+Sans:400,600|Roboto" rel="stylesheet">
	<link rel="stylesheet" href="//localhost/css/admin.css">

	{top}

</head>
<body class="">
	<div id="content-wrapper" class="">
		<header>
			<div class="left"><a href="/admin"><img src="//localhost/images/views/admin/logo.png" class="logo"></a></div>
			<div class="middle"></div>
			<div class="right">
				<div class="content">
					<?php echo !empty($_SESSION['userId']) ? '<a href="/admin/logout" class="logout"><i class="fas fa-sign-out-alt"></i>Logout</a>': ''; ?>
				</div>
			</div>
		</header>
		<aside>
			<ul class="mainNav">
				<li><a href="/admin"><i class="fas fa-tachometer-alt"></i><span>Dashboard</span></a></li>
				<li><a href="/admin/modules/listModules"><i class="fas fa-archive"></i><span>Modules</span></a></li>
				<li><a href="/admin/settings"><i class="fas fa-cogs"></i><span>Settings</span></a></li>
			</ul>
		</aside>
			{content}
	</div>
	{bottom}
</body>
</html>