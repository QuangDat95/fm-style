<?php
$root_path =getcwd()."/"  ;
include($root_path."biensession.php");
include($root_path."includes/config.php");
include($root_path."includes/removeUnicode.php");
include($root_path."includes/class.paging.php");
include($root_path."includes/class.mysql.php");
include($root_path."includes/function.php");
include($root_path."myfunction.php"); 



$data = new class_mysql();
$data->config(); 
$data->access();
  $data1 = $_POST['DATA']; 
  $tmp = explode('*@!',$data1);
  $ma= trim($tmp[0]);
	//$ma='211022155';	
	$sql="select * from products where codepro='$ma'";
	$dong=getdong($sql);
	
	echo $dong['Name'];
?>