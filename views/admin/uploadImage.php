<?php

if( $_SESSION['userStatus'] != 'admin' ) {
	die( 'No access' );
}

if(!empty($_FILES['files'])) {
	$path = PATH_UPLOAD_IMAGE;
	$imageName = $_FILES['files']['name'];
	$imageName = current($imageName);
	$imageTempName = $_FILES['files']['tmp_name'];
	$imageTempName = current($imageTempName);
	$path = $path . basename( $imageName );
	if(move_uploaded_file($imageTempName, $path)) {

		$aImageInfo = getimagesize($path);

	  	echo json_encode( array(
			'data' => array(
				$path,
				array(
					'src' => $path,
					'type' => 'image',
					'height' => $aImageInfo[0],
					'width' => $aImageInfo[1]
				)
			)
		) );
	} else {
		echo "There was an error uploading the file, please try again!";
	}
}
?>