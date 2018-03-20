<?php

$oTemplate = clRegistry::get( 'clTemplate' );
$oRouter = clRegistry::get( 'clRouter' );

if( $GLOBALS['enviroment'] != 'development' ) {
	return;
}

?>

<div class="columns group">
	<div class="col span_1_of_4">
		<div class="panel">
			<h2 class="title">Routes</h2>
		</div>
	</div>
	<div class="col span_1_of_4">
		<div class="panel">
			<h2 class="title">Pages</h2>
		</div>
	</div>
	<div class="col span_1_of_4">
		<div class="panel">
			<h2 class="title">Statistics</h2>
		</div>
	</div>
	<div class="col span_1_of_4">
		<div class="panel">
			<h2 class="title">Settings</h2>
		</div>
	</div>
</div>