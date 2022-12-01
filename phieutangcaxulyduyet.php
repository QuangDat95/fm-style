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
	    $data->setthaotac("phieutangca") ;
		 
 
 	 
	$sql = "select tinhtrang,thoigianketthuc,thoigianbatdau from phieutangca  where ID = '0$idphieu'" ;	$phieu=getdong($sql); 	$tam=$phieu['tinhtrang'] ;
	 
	$giamsat=$tam[0];
	$quanly=$tam[1];
 // echo $giamsat . "- $loai ql " . $quanly ;
    // if($tam==44 || $giamsat==3 || $quanly==3) return ;
	  if($tam==44  ) return ;
 
	if($loai=='giamsat')	 // giam sat nhan su dung chung
	{
	
	   $tt=$tinhtrang."$quanly";
           $sogio = strtotime($phieu["thoigianketthuc"])- strtotime($phieu["thoigianbatdau"]);  
		   $tam = floor($sogio/3600);			
				$sogio =   ($sogio- $tam*3600)/60 ;
				$sophut  =$tam*60+$sogio  ;
		        $sophut=",sophut='$sophut' "  ; 
	   
	   if($tinhtrang==3||$tinhtrang==1) $sqlupd =  " ,lydoGS = '$lydo' " ; else $sqlupd =  "";
	   if($lydo=='')   { echo  "###-1###Chưa nhập lý do###---###" ; return; }
  	   $sql = "update phieutangca set tinhtrang='$tt',ngayxacnhan1='$ngaytao',ID2='$idk' $sqlupd  $sophut where ID = '0$idphieu'  " ;   $data->query($sql);
	   
	    if($tinhtrang==4)    echo  "###1###Đã duyệt###$ngayduyet###" ; else    echo  "###1###Đã lưu###$ngayduyet###" ;   
	    return;	
	} 
	elseif($loai=='quanly')	
	{  
	   $tt="$giamsat".$tinhtrang;
	   
       
	   if($tinhtrang==3||$tinhtrang==2) $sqlupd =  " ,lydoNS = '$lydo' " ; else $sqlupd =  "";
	   if($lydo=='') { echo  "###-1###Chưa nhập lý do###---###" ; return; }
	   $sophut="";
	    if($tinhtrang==4)    
		{ $sogio = strtotime($phieu["thoigianketthuc"])- strtotime($phieu["thoigianbatdau"]);  
		   $tam = floor($sogio/3600);			
				$sogio =   ($sogio- $tam*3600)/60 ;
				$sophut  =$tam*60+$sogio  ;
		        $sophut=",sophut='$sophut' "  ;}
	   
  	   $sql = "update phieutangca set tinhtrang=$tt,ngayxacnhan2='$ngaytao',ID2='$idk'  $sqlupd $sophut where ID = '0$idphieu'  " ;	   $data->query($sql);
       if($tinhtrang==3)    echo  "###1###Đã duyệt###$ngayduyet###" ; else    echo  "###1###Đã lưu###$ngayduyet###" ;  
	    return;	
	} 
 	  
	     
  
  echo  "###-1###không duyệt###---###" ;
    $data->closedata() ;
?>	