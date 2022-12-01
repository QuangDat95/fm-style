<?php  
session_start();
$idk = $_SESSION["LoginID"] ; if (  $idk == '') return ;
$root_path =getcwd()."/"  ;
include($root_path."biensession.php");
include($root_path."includes/config.php");
include($root_path."includes/removeUnicode.php");
include($root_path."includes/class.paging.php");
include($root_path."includes/class.mysql.php"); 
include($root_path."includes/function.php");
include($root_path."includes/function_local.php");
 $data = new class_mysql();
$data->config();
$data->access();
     $data1 = $_POST['DATA']; 
    $tmp = explode('*@!',$data1);  
 	$id = laso($tmp[0]) ;
      $sql = " select ID,noidung,chatngan from onlinechat where id= '0$id' " ; $tam = getdong($sql);
     echo $tam['noidung']   ;   
     $data->closedata() ;
?>