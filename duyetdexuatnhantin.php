<?php
session_start();
  
$root_path =getcwd()."/"  ;
include($root_path."biensession.php");
include($root_path."includes/config.php");
include($root_path."includes/removeUnicode.php");
include($root_path."includes/class.paging.php");
include($root_path."includes/class.mysql.php");
include($root_path."includes/function.php");
include($root_path."tinhluongkpifunction.php"); 	

$data = new class_mysql();
$data->config(); 
$data->access();

if(isset($_POST['DATA'])){
 	$data1 = $_POST['DATA'];
	$tmp = explode('*@!',$data1);
    $manv= trim($tmp[0]);
	
}

?>