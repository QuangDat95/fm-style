<?php

$db["host"]                 			= "localhost"; 	// host name

$db["user"]                 			= "root";	// host username

$db["pass"]                 			= "";   	// host password

 

 



$db["name"]                 			= "fmda2020";		// database name

$db["ip"]	= $_SERVER["REMOTE_ADDR"] ;

$db["idgoi"]	= isset($_SESSION["se_id"])?$_SESSION["se_id"]:"" ;

$db["tinvip"]                 			= 60;	

$db["tinthuong"]                 		= 40;

 

 

$image_filesize 						= 550;

 ?>