<?php   
session_start();
$id = $_SESSION["LoginID"]  ; if ( $id == "") return ;
$ch = $_SESSION["se_kho"] ;
$root_path =getcwd()."/"  ;
include($root_path."biensession.php");
include($root_path."includes/config.php");
include($root_path."includes/removeUnicode.php");
include($root_path."includes/class.paging.php");
include($root_path."includes/class.mysql.php");
include($root_path."includes/function.php");
include($root_path."includes/function_local.php");

 
  
//  //if ($us =="" || $id == "" ) { echo " Ban chua dang nhap!!! " ;return ;}
    
$data = new class_mysql();
$data->config();
$data->access();
  $mpt = array () ;
  $mangud = array() ;
  $data1 = $_POST['DATA']; 
  $xoa =  $_POST['DATAD']; 
  $tmp = explode('*@!',$data1);
  $maso= trim($tmp[0]);
  $iddung= laso($tmp[1]);
  
    	$ngay  = gmdate('Y-m-d', time() + 7*3600) ;
 	    $sql = " select ghichu,sotiendk,sotien,ID,iddung,apdungcuahang,sophieu,DATE_FORMAT(ngaydung,'%d/%m/%Y') as ngay,DATE_FORMAT(ngayhethan,'%d/%m/%Y') as ngayhethan  from phieukhuyenmai where maso = '$maso' and ngayhethan >='$ngay' limit 1  " ;
		$tam= getdong($sql);
	
	 //echo  $sql.$tam['ID']."abc";
	 if ($tam['apdungcuahang']>0 && $tam['apdungcuahang']!=$ch ) 
	 { 
	    $sql = " select macuahang from cuahang where ID=  $tam[apdungcuahang] " ;
		$tam2= getdong($sql);
	 	echo "**#-3**#$tam2[macuahang] hạn sử dụng tới ngày $tam[ngayhethan] **#"; 	  $data->closedata() ; 	return ;
 	 }
	 else if ($tam['sophieu']!='')
	 {   
		echo "**#-2**#$tam[ngay]**#**#**#"; 
	 }
	 else  if ($tam['ID']>0) 
	 {   //$iddung==$tam['iddung']
	  $dieukienapdungsosanpham=0;
	  if($tam['sotiendk']>=1 && $tam['sotiendk']<100) $dieukienapdungsosanpham=$tam['sotiendk'];
	  
	  if($tam['sotiendk']<0) $dieukienapdungsosanpham = $tam['sotiendk']; 
	  
	  if(1==1) echo  "**#" .$tam['sotien'].'**#'.$dieukienapdungsosanpham .'**#'.$tam['ghichu'].'**#'.$tam['sotiendk'].'**#' ; else echo "**#-4**#Mã Voucher này không thuộc khách hàng   ! **#**#**#**#"; 
	 }
     else echo "**#-1**#**#**#**#   "; 
	    $data->closedata() ;
  	return ;
			
?>