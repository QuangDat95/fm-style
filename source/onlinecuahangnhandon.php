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
	$loai = laso($tmp[1]) ; 
	$lancuoi=gmdate('Y-n-d H:i:s', time() + 7*3600) ;
  
     if($loai==8)  
	 {$sql = "  update online  set  IDTN = '0',ngaythungan ='$lancuoi'   where ID = '$id'  and IDTN=$idk " ; 
	//  echo $sql ;
	   $data->query($sql) ;
	   echo  "***". mysql_affected_rows() ."***" ;
	 }
     else
	 {
	     $sql = "  update online  set  IDTN = '$idk',ngaythungan ='$lancuoi'   where ID = '$id'  and IDTN=0 " ;  
 	   $data->query($sql) ;
	   echo  "###". mysql_affected_rows() ."###" ;
 	 }
     $data->closedata() ;
?>