<?php  session_start();

$id = $_SESSION["LoginID"] ; if (  $id == '') return ;

$root_path =getcwd()."/"  ;
include($root_path."biensession.php");
 include($root_path."includes/removeUnicode.php");
 include($root_path."includes/function.php");
include($root_path."includes/function_local.php");

 
  $data1 = $_POST['DATA']; 
  $tmp = explode('*@!',$data1);
   $mang = explode('|@|',$tmp[0]);
    $_SESSION["mangin"] =  $mang ;
   
   return ;
   
 
  				
?>	