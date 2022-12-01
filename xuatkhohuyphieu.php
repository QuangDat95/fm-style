<?php  
session_start();
$id = $_SESSION["LoginID"]  ; if ( $id == "") return ;
$root_path =getcwd()."/"  ;
include($root_path."biensession.php");
include($root_path."includes/config.php");
include($root_path."includes/removeUnicode.php");
include($root_path."includes/class.paging.php");
include($root_path."includes/class.mysql.php");
include($root_path."includes/function.php");
include($root_path."includes/function_local.php");
  $ten = get_cookie('member_ten') ; 
  $us = get_cookie('member_id') ; 
  $id = get_cookie('member_LoginID') ; 
   //if ($us =="" || $id == "" ) { echo " Ban chua dang nhap!!! " ;return ;}
  
$data = new class_mysql();
$data->config();
$data->access();

  $data1 = $_POST['DATA']; 
  $tmp = explode('*@!',$data1);  
  	 
	$id = laso($tmp[0]) ;
	$loai = $tmp[1] ;
//	$loai = $tmp[2]    	  
   $sql = " select ID,dakhoa,idkho,DATEDIFF('2016-08-29',NOW()) as ngay  from phieuxuat where ID = '0$id' limit 1";
	  $tam=getdong($sql);

   if ($tam['idkho'] == $idkho && $tam['ngay']<5 && $idkho !=1) { echo "###Bên nhận mới được khóa phiếu hoặc sau 5 ngày bạn mới dược khóa phiếu này !###"; return ; }
	
	
  	 $sql = "  update phieuxuat set dakhoa = 2, dahuy = 1 where ID = '$id' limit 1 " ; //and dakhoa = '0' 
  
    $data->query($sql) ;
 	
//return ;  
 
    $data->closedata() ;
?>