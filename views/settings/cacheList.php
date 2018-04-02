<?php

$aCache = array();
$aCachedObjects = array();

$iCachedObjects = 0;

$objects = new RecursiveIteratorIterator(new RecursiveDirectoryIterator(PATH_CACHE), RecursiveIteratorIterator::SELF_FIRST);
foreach($objects as $name => $object){
	if( is_file( $name ) ) {
		$name .= "\\" . filemtime( $name );
		$iCachedObjects++;
		$aCache[] = $name;
	}
}
foreach( $aCache as $sLine ) {
	$aBits = explode( "\\", $sLine );
	// dump( $aBits );
	$aCachedObjects[] = array(
		$aBits[1] => array(
			'file' => $aBits[2],
			'modified' => $aBits[3]
		)
	);
}

if( isset($_POST['clearAllCache']) ) {
}



echo '
<h1>Cache</h1>
<div class="panel">
	Cached objects: ' . $iCachedObjects . '
	<form action="' . $_SERVER['REQUEST_URI'] . '" method="post">
		<button name="clearAllCache" value="true" class="linkConfirm raised">Clear all cache</button>
	</form>
</div>';