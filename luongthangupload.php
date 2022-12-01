<?php
session_start();

$error = "";
$msg = "";
$us = $_REQUEST["us"];

if ($us == "") exit;
//$tenfileluu="orders.xlsx";
if ($_REQUEST["loai"] == 1)  $tenfileluu = $_REQUEST["us"] . '.xlsx';

//cái này mới thêm 
$us = $_REQUEST["us"];
$tenfileluu = $us . '.xlsx';

//if ( !file_exists($dir) ) {    mkdir($dir,0777) ;   }	
$root_path = getcwd() . "/data/";
//$dir  = getcwd()."/file"  ;
//$root_path = getcwd()."/file/";	
$fileElementName = 'fileToUpload';

if ($_FILES["fileToUpload"]["size"] > 20000000000) {
	$msg = "Vượt dung lượng cho phép 200Mb !!!";
	
	echo "{";
	echo				"error: '" . $msg . "',\n";
	echo				"msg: '" . $msg . "'\n";
	echo "}";
	exit(-1);
}

if (!empty($_FILES[$fileElementName]['error'])) {
	switch ($_FILES[$fileElementName]['error']) {
		case '1':
			$error = 'Vượt dung lượng cho phép 2Mb !!!'; //'The uploaded file exceeds the upload_max_filesize directive in php.ini';
			break;
		case '2':
			$error = 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form';
			break;
		case '3':
			$error = 'The uploaded file was only partially uploaded';
			break;
		case '4':
			$error = 'No file was uploaded.';
			break;
		case '6':
			$error = 'Missing a temporary folder';
			break;
		case '7':
			$error = 'Failed to write file to disk';
			break;
		case '8':
			$error = 'File upload stopped by extension';
			break;
		case '999':
		default:
			$error = 'No error code avaiable';
	}
} elseif (empty($_FILES['fileToUpload']['tmp_name']) || $_FILES['fileToUpload']['tmp_name'] == 'none') {
	$error = 'Bạn chưa chọn file !!!';
} else {



	//	    $msg .='-' . $target_path ;
	//$msg .=$ngay."*". $_FILES['fileToUpload']['name'] ; // . ", ";
	// 	$msg .= " File Size: " . @filesize($_FILES['fileToUpload']['tmp_name']);
	//for security reason, we force to remove all uploaded file
	$target_path = $root_path . $tenfileluu;
	// echo $target_path ;
	if (@move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $target_path)) {
		$result = 1;
	}
	@unlink($_FILES['fileToUpload']);
}
echo "{";
echo				"error: '" . $error . "',\n";
echo				"msg: '" . $msg . "'\n";
echo "}";
