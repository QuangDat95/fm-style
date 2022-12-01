<?php  
session_start();
 $idk = $_SESSION["LoginID"] ; if (  $idk == '') return ; 

$root_path =getcwd()."/"  ;
include($root_path."includes/config.php");
include($root_path."includes/removeUnicode.php"); 
include($root_path."includes/class.paging.php");
include($root_path."includes/class.mysql.php");
include($root_path."includes/function.php");
 

 
   
$data = new class_mysql();
$data->config();
$data->access();

  $data1 = $_POST['DATAC']; 
  $tmp = explode('*@!',$data1);
 
        $idphieu   =  laso($tmp[0])   ;
		$idlogin   =  laso($tmp[1])   ;
		$loai   =  ($tmp[2])   ;
		$tinhtrang= laso($tmp[3]) ;
		$lydo = $tmp[4];
		 $ngaytao = gmdate('Y-n-d H:i:s', time() + 7*3600) ;
         $ngayduyet =gmdate('d-n-Y H:i:s', time() + 7*3600) ;
	
		 
 
 	 
	$sql = "select tinhtrang  from thuonghoadon  where ID = '0$idphieu'" ;	$phieu=getdong($sql); 	$tam=$phieu['tinhtrang']."11";
	 
	$giamsat=$tam[0];
	$nhansu=$tam[1];
	if($loai=='giamsat')	
	{
	
	   $tt=$tinhtrang."$nhansu";
       if($nhansu==4||$nhansu==3||$giamsat==3||$giamsat==4) return ;
	   if($tinhtrang==3||$tinhtrang==2) $sqlupd =  " ,lydoGS = '$lydo' " ; else $sqlupd =  "";
	   if($lydo=='')   { echo  "###-1###Chưa nhập lý do###---###" ; return; }
  	   $sql = "update thuonghoadon set tinhtrang='$tt',ngaygiamsat='$ngaytao',ID2='$idk' $sqlupd  where ID = '0$idphieu'  " ;    $data->query($sql);
	   
	     if($tinhtrang==4)    echo  "###1###Đã duyệt###$ngayduyet###" ; else    echo  "###1###Đã lưu###$ngayduyet###" ; 
	    return;	
	} 
	elseif($loai=='ketoan')	
	{  
	   $tt="$giamsat".$tinhtrang;
	   
       if($nhansu==4||$nhansu==3||$giamsat==3 ) return ;
	   if($tinhtrang==3||$tinhtrang==2) $sqlupd =  " ,lydoNS = '$lydo' " ; else $sqlupd =  "";
	   if($lydo=='') { echo  "###-1###Chưa nhập lý do###---###" ; return; }
	   
	    if($tinhtrang==4)    
		{ 
  	    $sql = "update thuonghoadon set tinhtrang=$tt,ngaynhansu='$ngaytao',ID2='$idk'  $sqlupd   where ID = '0$idphieu'  " ; $data->query($sql); 
        if($tinhtrang==4)    echo  "###1###Đã duyệt###$ngayduyet###" ; else    echo  "###1###Đã lưu###$ngayduyet###" ; 
	    return;	
		}
	} 
   	  
	     
  
  echo  "###-1###không duyệt###---###" ;
    $data->closedata() ;
?>	