<?php
$targetFolder = '../../../uploads/qualidade/';
if (!empty($_FILES)) {
	$tempFile = $_FILES['Filedata']['tmp_name'];
	$targetPath = $targetFolder;
	$targetFile = rtrim($targetPath,'/') . '/' . $_FILES['Filedata']['name'];
	$fileTypes = array('jpg','jpeg','pdf','png','odt','xls','xlsx','txt');
	$fileParts = pathinfo($_FILES['Filedata']['name']);	
	if (in_array($fileParts['extension'],$fileTypes)) {
		move_uploaded_file($tempFile,$targetFile);
		echo '1';
	} else {
		echo 'Invalid file type.';
	}
}
?>