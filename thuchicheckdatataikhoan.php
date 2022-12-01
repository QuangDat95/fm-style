<?php  
session_start();

if ($_SESSION["LoginID"]=="") return ;
$root_path =getcwd()."/"  ;
include($root_path."biensession.php");
include($root_path."includes/config.php");
include($root_path."includes/removeUnicode.php");
include($root_path."includes/class.paging.php");
include($root_path."includes/class.mysql.php");
include($root_path."includes/function.php");
include($root_path."includes/function_local.php");
include( $root_path."excel/simplexlsx.class.php");  
 //$path = $root_path."data/maubanhangpancake.xlsx"  ; 
    
$idk = laso($_SESSION["LoginID"]) ; if ($idk == 0) return ;
  $idkho = $_SESSION["se_kho"] ; 
  
$data = new class_mysql();
$data->config();
$data->access();
$updated =false;

$tm = $_SESSION["root_path"] ;
//đọc dữ liệu
$path = $root_path."data/taikhoan.xlsx" ;
$xlsx = new SimpleXLSX($path);
$sheets=$xlsx->rows();
$rows_begin = 2;
$rows_end = count($sheets);
$tam=[];
if ($rows_end >= 600) $rows_end = 600;
list($cols,) = $xlsx->dimension();


$chuoiinsert='';
//if(isset($_POST['DATA'])){
$demdong=0;
	$data1 = $_POST['DATA']; 
	$tmp = explode('*@!',$data1);
	$stt=0;
		
	foreach($sheets as $k => $r) {
	
	
		if (($k >= $rows_begin) && ($k <= $rows_end)) {
			
			$matk=$r[0];
			$tentk=$r[1];
			$tentienganh=$r[3];
			$diengiai=$r[4];
			$ngungtheodoi=$r[5]?1:0;
			
			if(trim($r[2])=='Dư Nợ'){
				if(!checktontai($matk,1)){
					$chuoiinsert.="('$matk','$tentk',1,'$tentienganh','$diengiai','$ngungtheodoi'),";
				
				}
			}
			else if(trim($r[2])=='Lưỡng tính'){
				if(!checktontai($matk,1)){
					$chuoiinsert.="('$matk','$tentk',1,'$tentienganh','$diengiai','$ngungtheodoi'),";
				}
				
				if(!checktontai($matk,0)){
					$chuoiinsert.="('$matk','$tentk',0,'$tentienganh','$diengiai','$ngungtheodoi'),";
				}
			}
			else if(trim($r[2])=='Dư Có'){
				if(!checktontai($matk,0)){
					$chuoiinsert.="('$matk','$tentk',0,'$tentienganh','$diengiai',$ngungtheodoi),";
				}
			}
			
			
				
		}
		
		
 }


$chuoiinsert=rtrim($chuoiinsert,',');
if(inserttaikhoan($chuoiinsert)){
	echo "<p style='color:green'>Đã thêm thành công</p>";
}
//insert into dinhkhoan(madinhkhoan,tendinhkhoan,loai)
$data->closedata() ;

function inserttaikhoan($chuoi){
global $data;

	$sql = "insert into dinhkhoan (madinhkhoan,tendinhkhoan,loai,tenen,ghichu,ngungtheodoi) values ".$chuoi;
	//echo $sql;
	if($data->query($sql)){
	 	/*$sql="select * from phieunhapxuat where SoCT='$sochungtu'";
		$dong=getdong($sql);*/
		
	 	return true;
	}
	else{
		return;
	}
}


function checktontai($ma,$loai){
$sql ="select ID from dinhkhoan where madinhkhoan='$ma' and loai ='$loai'";
	$dong=getdong($sql);
	return $dong['ID'];

}
?>	