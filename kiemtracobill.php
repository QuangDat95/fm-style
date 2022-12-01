<?php  
session_start();

   $IDK = $_SESSION["LoginID"]  ;
   $cuahang =$_SESSION["se_kho"];
  $quyen= $_SESSION["quyen"] ; 
	 $ql =$quyen[$_SESSION["mangquyenid"]["capnhaptuvan"]]  ;  
 	 if( !($ql[0]==1 || $IDK==1) ){return;}
 
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
 
        $soct =  trim($tmp[0])   ;
   
  
  if($soct=='') { echo "###-1### "; return  ; }
  if($IDK==1 || $IDK ==4647 || $IDK ==7576 ) $cuahang= "" ; else $cuahang=" and  a.idkho=$cuahang ";
 	  
			$sql = "SELECT  a.soct,a.id,a.idkho,a.ghichu,a.idgioithieu,a.diachiN,a.LyDo,b.ten,c.ten as nv,DATE_FORMAT(a.NgayTao,'%d/%m/%Y %H:%i') as ngay,DATE_FORMAT(a.NgayTao,'%Y-%m-%d') as ngaykt from phieunhapxuat a left join userac b on a.diachin=b.id   left join userac c on a.idtao=c.id where a.soct='$soct' $cuahang limit 1 "; 
	        $tam=getdong($sql);
			
 		   if($tam['id']=='')  { echo "###-1###Không tìm thấy số hóa đơn $soct này ! "; return  ; }
		   echo  "###1###$tam[id]###$tam[soct]###$tam[ten]###$tam[diachiN]###$tam[idkho]###$tam[idgioithieu]###$tam[LyDo]###$tam[ghichu]###$tam[ngaykt]### Ngày tạo: <b>$tam[ngay] </b> NV tạo:<b> $tam[nv] </b> , &nbsp; Nhân viên tư vấn trên bill: <b> $tam[ten]</b>, &nbsp; Team: <b> ".getten('lydonhapxuat',$tam['LyDo'],'Name')."</b>, &nbsp; Nhân viên giới thiệu: <b> ".getten('userac',$tam['idgioithieu'],'Ten')."</b>, &nbsp; Ghi chú: <b> $tam[ghichu]</b>   ###xong $sql";
  //  if ($_SESSION['admintuan']) {  echo $sql ;   }
     $data->closedata() ;
?>	