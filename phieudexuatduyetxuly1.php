<?php  
session_start();
  
     $id = $_SESSION["LoginID"]  ;
 

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
 
        $id   =  laso($tmp[0])   ;
        $sophieu= trim($tmp[2])  ;
		$tinhtrang= laso($tmp[1]) ;
		 $ngaytao = gmdate('Y-n-d H:i:s', time() + 7*3600) ;
         $ngayduyet =gmdate('d-n-Y H:i:s', time() + 7*3600) ;
 if($tinhtrang != 8 )
 {	
 	if( $tinhtrang != 0 ){
		$sql = "update phieuyeucau a left join phieunhapxuat b on a.sochungtu=b.soct 
		   set b.diachin=a.thongtindung,a.tinhtrang=$tinhtrang,a.ngayxacnhan3='$ngaytao' ,a.id3=1
	  		where a.ID = '0$id'  " ;
	 	// echo $sql ;
	 	$data->query($sql);
		echo  "###1###Đã duyệt###$ngayduyet###" ;
	} else {
		echo "###2###Duyệt phiếu theo thứ tự###---###";
	}
	   
 }
 else  echo  "###-1###Không duyệt, phiếu đã duyệt trước đó###---###" ;
    $data->closedata() ;
?>	