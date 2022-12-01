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

<strong style="color:#F90">Đọc dữ liệu từ dòng 13 của file Excel</strong> <br />
<table id="tbex" width="100%" border="0" cellpadding="0" cellspacing="0" style="background:#FFF;" class="tbchuan">		
 		<!--<tr bgcolor="#F8E4CB">
		  <td align="center"  height="23" width="35"><b>STT</b></td>
          <td align="center"  height="23" width="43"><b>Mã chạy thưởng</b></td>
		  <td width="98" align="center"  ><strong>Mã chạy lương</strong></td>  
 		  <td width="72" align="center" ><strong>Tên nhân viên</strong></td> 
          <td width="72" align="center" ><strong>Mã nhân viên</strong></td>
          <td width="72" align="center" ><strong>Ngày vào làm</strong></td>
		
		   <td width="72" align="center" ><strong>Chức danh</strong></td> 
          <td width="72" align="center" ><strong>Hệ số lương</strong></td>
		     <td width="72" align="center" ><strong>Hệ số vùng</strong></td>
			 <td width="72" align="center" ><strong>Lương căn bản</strong></td>
			 <td width="72" align="center" ><strong>Ngày chuẩn</strong></td>
			  <td width="72" align="center" ><strong>h/ngày</strong></td>
			 <td width="72" align="center" ><strong>Giờ công</strong></td>
			 <td width="72" align="center" ><strong>Giờ tăng ca</strong></td>
			 <td width="72" align="center" ><strong>Lương ngày công</strong></td>
			 <td width="72" align="center" ><strong>Lương KPI</strong></td>
			 <td width="72" align="center" ><strong>% chia doanh thu</strong></td>
			 <td width="72" align="center" ><strong>Lương</strong></td>
			 <td width="72" align="center" ><strong>Mã vận đơn Lazada</strong></td>
			 <td width="72" align="center" ><strong>Tiki</strong></td>
			 <td width="72" align="center" ><strong>Ncc</strong></td>
			  <td width="72" align="center" ><strong>Họ và tên NV</strong></td>
			   <td width="72" align="center" ><strong>MÃ NV</strong></td>
			    <td width="72" align="center" ><strong>Phiếu xuất</strong></td>
				 <td width="72" align="center" ><strong>Số phiếu PM</strong></td>
				 
  	 </tr>-->
<?php

$tm = $_SESSION["root_path"] ;

//đọc dữ liệu
$path = $root_path."data/tinhluong.xlsx" ;
$xlsx = new SimpleXLSX($path);
$sheets=$xlsx->rows();



$rows_begin = 3;
$rows_end = count($sheets);
$tam=[];
$loi=false;
if ($count_rows >= 600) $rows_end = 600;
list($cols,) = $xlsx->dimension();

if(isset($_POST['DATA'])){
	$data1 = $_POST['DATA']; 
	$tmp = explode('*@!',$data1);
	$sott=12;

	foreach($sheets as $k => $r) {
	
		if($k==0){
			?>
			<tr bgcolor="#F8E4CB" style="color:#FF0000">
				<?php
					for($i=0;$i<36;$i++){
						if($r[$i]){
							?>
								<td align="center"  height="23" width="35"><b><?=$r[$i]?></b></td>
							<?php
						}
					}
				?>
				  
			</tr>
<?php
			
		}
		if (($k >= $rows_begin) && ($k <= $rows_end)) {
		?>
			<tr style="color:green">
				<?php
					for($i=0;$i<36;$i++){
						
							?>
					<td align="center"  height="23" width="35"><b><?=is_numeric($r[$i])?number_format((float)($r[$i])):$r[$i]?></b></td>
							<?php
						
					}
				?>
				  
			</tr>
<?php
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

function checkcol($chuoi,$r){
	
	$rong=[];
	$co=[];
	if($chuoi){
		$arr=explode("*",$chuoi);
		foreach($arr as $key => $value){
			if(!$r[$value-1]){
				
				array_push($rong,$value);
			}
			else{
				array_push($co,$value);
			}
		}
	}
	return array("rong"=>$rong,'co'=>$co);
}
function checkcotchitiet($so,$r){
	
	$result=[];
	$thongtin=[];
	switch($so){
		case 14:
			$sql="select SoCT as dulieu from phieunhapxuat where SoCT='".$r[$so-1]."'";
			
		break;
		case 15:
			$sql="select ma as dulieu,loai as loaitk from taikhoannganhang where ma='".$r[$so-1]."'";
			
		break;
		
		case 17:
			$sql="select madh as dulieu from vanchuyenonline where madh='".$r[$so-1]."'";
			
		break;
		case 18:
			$sql="select madh as dulieu from vanchuyenonline where madh='".$r[$so-1]."'";
			
		break;
		case 19:
			$sql="select madh as dulieu from vanchuyenonline where madh='".$r[$so-1]."'";
			
		break;
		case 20:
			$sql="select madh as dulieu from vanchuyenonline where madh='".$r[$so-1]."'";
			
		break;
		case 23:
			$sql="select MaNV,Ten as dulieu from userac where MaNV='".$r[$so-1]."'";
			
		break;
		case 24:
			$sql="select ID as dulieu from phieuxuat where ID='".$r[$so-1]."'";
			
		break;
		default:
		break;
	}
	
	//return $sql;
	if($sql){
	$dong =getdong($sql);
	if($dong['dulieu']){
		if($dong['dulieu']){
			$thongtin['mangh']=$dong['dulieu'];
		}
		if($dong['loaitk']){
			$thongtin['loaitk']=$dong['loaitk'];
		}
		return array('dulieu'=>$dong['dulieu'],'thongtint'=>$thongtin);
	}
	else
	{
		return false;
	}
	}
	else{
		return false;
	}
	
		
}

function getthongtin($id){
	$sql="select ID,ma,no,co,thongtin from dinhkhoanthuchi where ma='$id'";
	$dong=getdong($sql);
	if($dong['ma']){
		return array('ID'=>$dong['ID'],'no'=>$dong['no'],'co'=>$dong['co'],'thongtin'=>$dong['thongtin']);
	}
	return false;
}

function xuatbaoloirong($loi){
	$result='';
	switch($loi-1){
		case 13:
			$result= "Cột HĐBH trống!\\n";
		break;
		case 14:
			$result= "Cột STKNH trống!\\n";
		break;
		case 15:
			$result= "Cột Tên TK NH trống!\\n";
		break;
		case 16:
			$result= "Cột GHTK/Vietel/ Bưu Điện trống!\\n";
		break;
		case 17:
			$result= "Cột Shopee trống!\\n";
		break;
		case 18:
			$result= "Cột Lazada trống!\\n";
		break;
		case 19:
			$result= "Cột Tiki trống!\\n";
		break;
		case 20:
			$result= "Cột NCC trống!\\n";
		break;
		case 21:
			$result= "Cột Họ và tên nhân viên trống!\\n";
		break;
		case 22:
			$result= "Cột Mã nhân viên trống!\\n";
		break;
		case 23:
			$result= "Cột Phiếu xuất trống!\\n";
		break;
		case 24:
			$result= "Cột Số phiếu PM trống!\\n";
		break;
		case 25:
			$result= "Cột Chứng từ trống!\\n";
		break;
	
		default:
		break;
	}
	return $result;
}
function xuatbaoloitontai($loi){
	$result='';
	switch($loi){
		case 14:
			$result= "Cột HĐBH không tồn tại dữ liệu!\\n";
		break;
		case 15:
			$result= "Cột STKNH không tồn tại dữ liệu!\\n";
		break;
		case 16:
			$result= "Cột Tên TK NH không tồn tại dữ liệu!\\n";
		break;
		case 17:
			$result= "Cột GHTK/Vietel/ Bưu Điện không tồn tại dữ liệu!\\n";
		break;
		case 18:
			$result= "Cột Shopee không tồn tại dữ liệu!\\n";
		break;
		case 19:
			$result= "Cột Lazada không tồn tại dữ liệu!\\n";
		break;
		case 20:
			$result= "Cột Tiki không tồn tại dữ liệu!\\n";
		break;
		case 21:
			$result= "Cột NCC không tồn tại dữ liệu!\\n";
		break;
		case 22:
			$result= "Cột Họ và tên nhân viên không tồn tại dữ liệu!\\n";
		break;
		case 23:
			$result= "Cột Mã nhân viên không tồn tại dữ liệu!\\n";
		break;
		case 24:
			$result= "Cột Phiếu xuất không tồn tại dữ liệu!\\n";
		break;
		case 25:
			$result= "Cột Số phiếu PM không tồn tại dữ liệu!\\n";
		break;
		
	
		default:
		break;
	}
	return $result;
}

function checkcuahang($mach){
global $data;
	$sql="select ID from cuahang where macuahang='$mach'";
	$dong=getdong($sql);
	if($dong['ID']){
		return $dong;
	}
	else{
		return false;
	}
}
function kiemtratontaidulieu($ngaythuchi,$sotien,$lydo,$idkho){
 		$sql  = " select ID from thuchikt where ngaythuchi='$ngaythuchi' and sotien='$sotien' and lydo='$lydo' and loaitk='$idkho'  limit 1 ";
	//echo $sql."<br>";
		$chan = getdong($sql);   
	// echo $sql."<br>---";
		 if (laso($chan['ID'])>0){  
			 return false;	
		}
		return true;
}


function checksotienhoadon($soct){
	
$sql="select sum(DonGia) as tongtiendg,Round(sum((DonGia-(DonGia*chietkhau/100)))) as thanhtien 
from xuatbanhang a left join phieunhapxuat b on a.IDphieu=b.ID where b.SoCT='$soct' group by a.IDphieu ";
global $data;
$dong=getdong($sql);
	if($dong['tongtiendg']){
		return $dong;
	}
	else{
		return false;
	}
}
?>	