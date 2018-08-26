<?php
function imageValidate(){
	//checks if image is valid

	$error="";
	$fileError = $_FILES['txtProdImg']['error'];
	if($fileError>0){		
		$error="<div class='error'><i class='fa fa-rose fa-exclamation-triangle'></i> Oops! The file you chose was faulty.</div>";
		exit;
	}
	//maximum size of images
	$maxSize = 1000000;
	$fileType = $_FILES['txtProdImg']['type'];
	$fileSize = $_FILES['txtProdImg']['size'];
	$fileTempName = $_FILES['txtProdImg']['tmp_name'];

	$trueFileType = exif_imagetype($fileTempName);
	//file types allowed
	$allowedFiles = array(IMAGETYPE_GIF, IMAGETYPE_JPEG, IMAGETYPE_PNG);
	if (in_array($trueFileType, $allowedFiles)) {
		if($fileSize > $maxSize){
			$error="<div class='error'><i class='fa fa-rose fa-exclamation-triangle'></i> Oops! The file you chose was too large.</div>";

		}else{
			switch($trueFileType){
				case 1 : $fileExt  = ".gif";
				break;
				case 2: $fileExt  = ".jpg";
				break;
				case 3 : $fileExt  = ".png";
				break;
			}
		}
	}else{
		//error message
		$error="<div class='error'><i class='fa fa-rose fa-exclamation-triangle'></i> Oops! The file you chose was not an image.</div>";
	}
	return $error;
}

function imageUpload(){
	$fileTempName = $_FILES['txtProdImg']['tmp_name'];

	$myPathInfo = pathinfo($_SERVER['DOCUMENT_ROOT'].$_SERVER['PHP_SELF']);

	$currentDir = $myPathInfo['dirname'];
	$imgDir = $currentDir . '/uploads/';
	
	$prodImg = $_FILES['txtProdImg']['name'];

	$newImgLocation = $imgDir . $prodImg;
	//moves selected file to new location
	if(move_uploaded_file($fileTempName, $newImgLocation)){
		return $prodImg;
	}else{
		return false;
	}
}
?>