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
$path = $root_path."data/baohiemyte.xlsx" ;
$xlsx = new SimpleXLSX($path);
$sheets=$xlsx->rows();
$rows_begin = 4;
$rows_end = count($sheets);
$tam=[];
if ($rows_end >= 600) $rows_end = 600;
list($cols,) = $xlsx->dimension();
$cols=26;

$chuoiinsert='';
//if(isset($_POST['DATA'])){
	$mangch = taomang ("cuahang","macuahang","ID"); 
$demdong=0;
	$data1 = $_POST['DATA']; 
	$tmp = explode('*@!',$data1);
	$stt=0;

	foreach($sheets as $k => $r) {
	
	
		if (($k >= $rows_begin) && ($k <= $rows_end)) {
			
				if($k>=4){
					
					$nhanvien=checknhanvien($r[4]);
				
					if($nhanvien["ID"]){
					 $ngaytao = gmdate('Y-n-d H:i:s', time() + 7*3600) ;
					 $idnv=$nhanvien["ID"];
					 $manv=$r[4];
					 $idch=$mangch[$r[1]];
					 $tinhtrang=4;
					 $ngayduyet=explode('.',$r[6]);
					 $ngaygiamdoc=$ngayduyet[2].'-'.$ngayduyet[1].'-'.$ngayduyet[0];
					 $ngayvaolam=explode('.',$r[5]);
					 $ngayhoadon=$ngayvaolam[2].'-'.$ngayvaolam[1].'-'.$ngayvaolam[0];
						$chuoiinsert.="('$manv','$ngaytao','$idch',	'$tinhtrang','$ngaygiamdoc','$ngayhoadon','$idnv'),";
						$demdong++;
					}
					else{
						echo '<p style="red">thất bại dòng '.$k.' dòng<p>';
					}
				}
			}		
					
		
    }

//}
 
  	$chuoiinsert=rtrim($chuoiinsert,',');
	
	if(insertbaohiemyte($chuoiinsert)){
		if($demdong>0){
			echo '<p style="green">Thành công '.$demdong.' dòng </p>';
			
		}
		
	}
	else{
		echo "có lỗi!";
	}
$data->closedata() ;
function checknhanvien($manv){

$sql="select ID from userac where MaNV='$manv'";
global $data;
$dong=getdong($sql);
if($dong['ID']){
		return $dong;
	}
	else{
		return false;
	}

}

function insertbaohiemyte($chuoiinsert){
global $data;
	$sql="insert into duyetbaohiemyte (manv,ngaytao,IDcuahang,tinhtrang,ngaygiamdoc,ngayhoadon,IDNV) values $chuoiinsert ";
	echo  $sql;
	$update=$data->query($sql);
	return $update;
}
function vn_to_str ($str){
 
$unicode = array(
 
'a'=>'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ',
 
'd'=>'đ',
 
'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',
 
'i'=>'í|ì|ỉ|ĩ|ị',
 
'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',
 
'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',
 
'y'=>'ý|ỳ|ỷ|ỹ|ỵ',
 
'A'=>'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
 
'D'=>'Đ',
 
'E'=>'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
 
'I'=>'Í|Ì|Ỉ|Ĩ|Ị',
 
'O'=>'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
 
'U'=>'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
 
'Y'=>'Ý|Ỳ|Ỷ|Ỹ|Ỵ',
 
);
 
foreach($unicode as $nonUnicode=>$uni){
 
$str = preg_replace("/($uni)/i", $nonUnicode, $str);
 
}
$str = str_replace(' ','_',$str);
 
return $str;
 
}
?>	