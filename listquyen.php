<?php  session_start();
$root_path =getcwd()."/"  ;
 include($root_path."includes/config.php");
include($root_path."includes/removeUnicode.php");
include($root_path."includes/class.paging.php");
include($root_path."includes/class.mysql.php");
include($root_path."includes/function.php");
 
 
if ($_SESSION["LoginID"] ==''){  return; } 
   
   $data = new class_mysql();
   $data->config();
   $data->access();
   $mpt = array () ;
   $mangud = array() ;
   $data1 = $_POST['DATA']; 
   $tmp = explode('*@!',$data1);
   
    $sql = " select quyen from userac where ID = '$tmp[0]' limit 1" ;		
    $tam= getdong($sql);	
	if($tam["quyen"]=='') { echo 0; return ;}
    $tam= unserialize($tam["quyen"]);$phay='';
	 foreach ($tam as $key => $item)
     {    
	 	$chuoi.=$phay. $key.','.$item ; $phay=',' ; 
	 }
	 echo $chuoi  ;
	$data->closedata() ;
  	
	
	return ;

  				
?>