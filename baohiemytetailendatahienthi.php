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


?>
<div style="overflow:scroll;height:400px">
<style>.tbchuan th, .tbchuan td{
	white-space: pre-wrap;
}</style>
<strong style="color:#F90">Đọc dữ liệu từ dòng 13 của file Excel</strong> <br />
<table id="tbex" width="100%" border="0" cellpadding="0" cellspacing="0" style="background:#FFF;" class="tbchuan">		
<?php

$tm = $_SESSION["root_path"] ;

//đọc dữ liệu
$path = $root_path."data/baohiemyte.xlsx" ;
$xlsx = new SimpleXLSX($path);
$sheets=$xlsx->rows();


//var_dump($sheets);
$rows_begin = 1;
$rows_end = count($sheets);
$tam=[];
$loi=false;
if ($count_rows >= 600) $rows_end = 600;
list($cols,) = $xlsx->dimension();
$cols=10;
if(isset($_POST['DATA'])){
	$data1 = $_POST['DATA']; 
	$tmp = explode('*@!',$data1);
	$sott=0;
		$mangch = taomang ("cuahang","macuahang","ID"); 
		$mangdk = taomang ("dinhkhoanthuchi","ma","ID"); 
		//var_dump($mangdk);
		$mangtk = taomang ("dinhkhoan","ID","madinhkhoan"); 
		
	foreach($sheets as $k => $r) {
		$checkloi=true;	
		$onclick=''; 
		$mauchu='green';
		$baoloirong='';
	if (($k >= $rows_begin) && ($k <= $rows_end)) {
		if($k==1){
			$k2=0;
			
		?>
			<tr bgcolor="#F8E4CB">
		<?php
			
			while($r[$k2]!=''){
					?>
				<td><?=$r[$k2]?></td>
					<?php
				$k2++;	
			}
			?>
			</tr>
			<?php
		}
		if($k>=4){
			$k2=0;
			$onclick='';
			$nhanvien=checknhanvien($r[4]);
			//var_dump($nhanvien);
			if(!$nhanvien["ID"]){
				$mauchu="red";
				$onclick="alert('Nhân viên không tồn tại!')";
				$loi=true;
			}
		?>
			<tr style="cursor:pointer; color:<?=$mauchu?>" onclick="<?=$onclick?>">
		<?php
			
			while($r[$k2]!=''){
					?>
				<td><?=$r[$k2]?></td>
					<?php
				$k2++;	
			}
			?>
			</tr>
			<?php
		}
		
			
		}
	   
		 
	}
	
	
}


?>

</table>  


</div>

<?php
 
if ($loi) {?>

<div style="padding-bottom:10px;padding-left:20px"><input type="button" id="dulieue" name="dulieue"  onclick="xuatbaoloi('Có lỗi trong file tải lên chú ý chổ màu đỏ!')" value="Lấy dữ liệu Excel"/> </div>  
 <?php
}
 else  
 {
 ?>
 <div style="padding-bottom:10px;padding-left:20px"><input type="button" id="dulieue" name="dulieue"  onclick="laydulieuexel()" value="Lấy dữ liệu Excel"/> </div>  
  <?php
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