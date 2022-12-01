<?php  
session_start();
$mangquyen = $_SESSION['quyen'] ;
$idk = $_SESSION["LoginID"] ; 
if (  $idk == ''||$mangquyen['thuchikhoa']!=true) return ;

 $idkho = $_SESSION["se_kho"] ; 
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
  $mpt = array () ;
  $mangud = array() ;
  $data1 = $_POST['DATA']; 
  $tmp = explode('*@!',$data1);
   $id = laso($tmp[0]);
//   echo 123;
     $ngaykhoa = gmdate('Y-n-d H:i:s', time() + 7*3600) ;
     $sql = " update  luongthang set IDkhoa='$idk',tinhtrang=1,ngaykhoa='$ngaykhoa' where ID = '$id' " ;
 	  	 $data->query($sql);	
	  
		 
	  
  	return ;
   				
?>	