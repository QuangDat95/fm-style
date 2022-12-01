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
   
$data = new class_mysql();
$data->config();
$data->access();
$updated =false;
if(isset($_POST["UPDATE"])){
	$data1 = $_POST['UPDATE']; 
  $tmp = explode('*@!',$data1);  
  $ids = laso($tmp[0]);
  $sp = $tmp[1] ;
 
   $sl = $tmp[2] ;
    $checksp = $tmp[3] ;
	
   $arrmanv=tachmanv($dts);
 	
				//check sp
				if(!checksp($sp)){
						echo -4;
						return;
				}
				//check sl
				if($sl<=0){
						echo -5;
						return;
				}
		$sql="update datapancake set T5='".$sp."',T7='".$sl."' where ID=".$ids;
	
	if($data->query($sql)){
	
		$updated=true;
		return;
	}
	
	
}
if(isset($_POST['DATA'])){
 	$data1 = $_POST['DATA']; 
 	 $tmp = explode('*@!',$data1);
	 $checkcol=true;
	 include($root_path."lazadainsertexel.php");
	 if(!$checkcol){
		return;
	}
}
   
if(isset($_POST['SHOW'])){
 	$data1 = $_POST['SHOW']; 
 	 $tmp = explode('*@!',$data1);
	
}
/*
    $datatc = new SimpleXLSX($path);
	$sheets=$datatc->rows();

	
	$sd= count($sheets) ;
	*/

 $sql="select * from datapancake";
$query=$data->query($sql);
$sheets=array();

while($r = $data->fetch_array($query)){
	
	array_push($sheets,$r);
	
}

?>
<div style="overflow:scroll;height:400px">
<strong style="color:#F90">Đọc dữ liệu từ dòng ... của file Excel</strong> <br />
<table id="tbex" width="100%" border="0" cellpadding="0" cellspacing="0" style="background:#FFF;" class="tbchuan">		
 		<tr bgcolor="#F8E4CB">
		  <td align="center"  height="23" width="35"><b>STT</b></td>
		   <td align="center"  height="23" width="43"><b>stt</b></td>
          <td align="center"  height="23" width="43"><b>Mã vận đơn</b></td>
		  <td width="98" align="center"  ><strong>Tên khách hàng</strong></td>  
 		  <td width="72" align="center" ><strong>Số điện thoại</strong></td> 
          <td width="72" align="center" ><strong>Mã sản phẩm</strong></td>
          <td width="72" align="center" ><strong>Giá tiền</strong></td>
          <td width="72" align="center" ><strong>Số lượng</strong></td>
          
		  
  	 </tr>
<?php
//kiem tra masp
//kiem tra voucher
//kiem tra manv
//kiem tra cua hang
// 
$stt=0;
$loi=false;
$macheck='';
foreach( $sheets as $k => $r) { 
$stt++;
$check=true;
$checkvd=true;
$texterror='';
$tiengiamhople=0;
$manxtam='';
$macheck=$r['T1'];
		if($r['T2']){
			$manxtam=$r['T2'];
			//check sp
			
			if(!checksp(trim($r['T5']))){
					$check=false;
					$loi=true;
					$texterror.="|*|4";
				
			}
			//check sl
			if($r["T6"]<=0){
					$check=false;
					$loi=true;
					$texterror.="|*|5";
				
			}
			//check ma van don
			
			if(!checkPhieuNhapxuat1($r['T2'])){
					$checkvd=false;
					
				
			}
			$mauchu="green";
			if($checkvd && !$check){
				$mauchu='red';
			}
			if(!$checkvd && $check){
				$mauchu='#ffc107';
			} 
			
			if(!$checkvd && !$check){
				$mauchu='red';
			} 
			
		if($checkvd && !$check){
		?>
		<tr id="<?=$r['ID']?>" style="cursor:pointer;color:<?php echo $mauchu ; ?> " onclick="showPoupSua('<?=$r['ID']?>','<?=$r['T3']?>','<?=$r["T54"]?>','<?=$texterror?>','<?=$r['T5']?>','<?=$r["T7"]?>','<?=$mangvc["sotien"]?>',0,3)">
		
		<?php
			}
			else if(!$checkvd && $check)
			{
			?>
		<tr id="<?=$r['ID']?>" style="cursor:pointer;color:<?php echo $mauchu ; ?> " onclick="xuatbaoloi('Dữ liệu này đã tồn tại!')">
	
		<?php		
			}
			else if(!$checkvd && !$check){
			?>
			
				<tr id="<?=$r['ID']?>" style="cursor:pointer;color:<?php echo $mauchu ; ?> " onclick="showPoupSua('<?=$r['ID']?>','<?=$r['T3']?>','<?=$r["T54"]?>','<?=$texterror?>','<?=$r['T5']?>','<?=$r["T6"]?>','<?=["T5"]?>',0,3)">
			<?php
			
			
			}
			else{
			
		?>
		<tr id="<?=$r['ID']?>" style="cursor:pointer;color:<?php echo $mauchu; ?> ">
		<?php
		
			}
		?>
		    <td align="right"><?php echo $stt  ;?></td>				
          <td  align="left"><?php echo $r["T1"];?></td>
 			<td  align="left"><?php echo $r["T2"];?></td>
 			<td  align="left"><?php echo $r["T3"];?></td>
 			<td  align="left"><?php echo $r["T4"];?></td>
			<td  align="left"><?php echo $r["T5"];?></td>
 			<td  align="left"><?php echo $r["T6"];?></td>
 			<td  align="left"><?php echo $r["T7"];?></td>
			
 			
			
    </tr>	
			
<?php		}else{

//check sp
			
			if(!checksp(trim($r['T5']))){
					$check=false;
					$loi=true;
					$texterror.="|*|4";
				
			}
			//check sl
			if($r["T6"]<=0){
					$check=false;
					$loi=true;
					$texterror.="|*|5";
				
			}
			
			$mauchu="green";
			if(!$check){
				$mauchu='red';
			}
			
		if(!$check){
		?>
		<tr id="<?=$r['ID']?>" style="cursor:pointer;color:<?php echo $mauchu ; ?> " onclick="showPoupSua('<?=$r['ID']?>','<?=$r['T3']?>','<?=$r["T54"]?>','<?=$texterror?>','<?=$r['T5']?>','<?=$r["T7"]?>','<?=$mangvc["sotien"]?>',0,3)">
		
		<?php
			}
			else{
			
		?>
		<tr id="<?=$r['ID']?>" style="cursor:pointer;color:<?php echo $mauchu; ?> ">
		<?php
		
			}
		?>
		
		
		    <td align="right"><?php echo $stt  ;?></td>				
          <td  align="left"><?php echo $r["T1"];?></td>
 			<td  align="left"><?php echo $r["T2"];?></td>
 			<td  align="left"><?php echo $r["T3"];?></td>
 			<td  align="left"><?php echo $r["T4"];?></td>
			<td  align="left"><?php echo $r["T5"];?></td>
 			<td  align="left"><?php echo $r["T6"];?></td>
 			<td  align="left"><?php echo $r["T7"];?></td>
 			
			
    </tr>	



<?php
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
 <div style="padding-bottom:10px;padding-left:20px"><input type="button" id="dulieue" name="dulieue"  onclick="laydulieuexellazada()" value="Lấy dữ liệu Excel"/> </div>  
  <?php
 }
      	
    $data->closedata() ;
	
function tachmanv($chuoi){
	$arr=explode("-",$chuoi);
	$tenkh=$arr[0];
	$voucher=$arr[1];
	$manv=$arr[2];
	$mach=$arr[3];
	$tam='';
	
	return array("tenkh"=>$tenkh,"manv"=>$manv,"voucher"=>$voucher,"mach"=>$mach);
}

function tachlaymasp($chuoi){
	$arr=explode(" ",$chuoi);

	$masp=$arr[count($arr)-1];
	return $masp;
}
function checkExists($cot,$ma,$bang){
	global $data;
	$ma=trim($ma);
	$sql="select * from $bang where $cot='$ma'";
	
	$query =$data->query($sql);
	$num_row=$data->num_rows($query);
	if($num_row==0){
		return;
	
	}
	else{
		return getdong($sql);
	}
}


function checktinh($chuoi){
	
	global $data;
	$chuoi=strtolower(trim($chuoi));
	$sql="select * from tinh where LOWER(TRIM(Name)) = '$chuoi'";
	
	$query =$data->query($sql);
	$num_row=$data->num_rows($query);
	if($num_row==0){
		return;
	}
	else{
		return getdong($sql);
	}
}
function checkquan($chuoi){
	
	global $data;
	$sql="select * from quan where CONCAT(loai,' ',Name) like '%$chuoi%'";

	$query =$data->query($sql);
	$num_row=$data->num_rows($query);
	if($num_row==0){
		return;
	
	}
	else{
		return getdong($sql);
	}
}
function checkdiachi($chuoi){
	$arr=explode(",",$chuoi);
	return $arr[0];
	/*global $data;
	$sql="select * from quan where CONCAT(loai,' ',Name) like '%$chuoi%'";

	$query =$data->query($sql);
	$num_row=$data->num_rows($query);
	if($num_row==0){
		return;
	
	}
	else{
		return getdong($sql);
	}*/
	

}


function checkphuong($chuoi){
	global $data;
	$sql="select * from phuong where CONCAT(loai,' ',Name) like '%$chuoi%'";

	$query =$data->query($sql);
	$num_row=$data->num_rows($query);
	if($num_row==0){
		return;
	
	}
	else{
		return getdong($sql);
	}

}

function checksp($masp){
	global $data;
	$sql="select ID from products where codepro=".$masp;
	$query =$data->query($sql);
	$num_row=$data->num_rows($query);
	if($num_row==0){
		return;
	
	}
	else{
		return getdong($sql);
	}

}


function insertKh($arr){
global $data;
 $ngay = gmdate('Y-n-d H:i:s', time() + 7*3600) ;
	$name=$arr["name"];
	$makh=$arr["makh"];
	$address=$arr["address"];
	$type=$arr["type"];
	$tel=$arr["tel"];
	$ngaysinh=$arr["ngaysinh"];
	$quan=$arr["quan"];
	$phuong=$arr["phuong"];
	$sql="insert into customer (Name,makh,address,type,tel,ngaytao,ngaysinh,quan,phuong)
	 values('$name','$makh','$address','$type','$tel','$ngay','$ngaysinh','$quan','$phuong')";
	 
	 $update=$data->query($sql);
	 	$sql="select * from customer where makh='$tel' and tel='$tel'";
		$dong=getdong($sql);
	 	return $dong;
	 
	 
}

function checkTeam($team){
global $data;
	$sql="select ma from lydonhapxuat where ma='$team'";
	$dong=getdong($sql);
	$result='';
	if($dong['ma']){
		$result=1105;
	}
	else{
		
		return false;
	}
	return $result;
}

function checkCuahang($team){
global $data;
	$sql="select ID from cuahang where macuahang ='$team'";
		
		$query =$data->query($sql);
		$dong=getdong($sql);
		$result='';
		if($dong['ID']){
			
			$result=$dong['ID'];
		}
		else{
			return;
		}
		
		return $result;
}
function insertPhieunhapxuat($arr){
global $data;

	$idkho=$arr['idkho'];
	$sochungtu=$arr['sct'];
		$idkhach=$arr['idkhach'];
	$id=$arr['IDNhap'];
	$ngayxuat=$arr['ngayxuat'];
	$lydoxuat=$arr['lydoxuat'];
	$tigia=$arr['tigia'];
	$vat=$arr['vat'];
	$ghichu=$arr['ghichu'];
	$ngaytao=$arr['ngaytao'];
	$idk=$arr['idk'];
	$makm=$arr['makm'];
	$name=$arr['name'];
	$address=$arr['address'];
	$tenlydo=$arr['tenlydo'];
	$idban=$arr['idban'];
	$nguoitao='';
	$tientra=$arr['tientra'];
	$idchol=$arr['idchol'];
	$sql = "insert into phieunhapxuat   set Loai='1' ,IDKho ='$idkho',IDNhaCC ='$idkhach' ,IDNhap ='$id' ,NgayNhap ='$ngayxuat' ,SoCT='$sochungtu' ,LyDo='$lydoxuat' ,SoNgayNo='0' ,IDTKNo='0' ,IDTKCo='0' ,TiGia ='$tigia' ,VAT='$vat' ,GhiChu='$ghichu' ,NgayTao='$ngaytao' ,IDTao='$idk' ,NguoiGiao='$makm' ,dakhoa=1,ten='$name',diachi='$address', tenlydo='$tenlydo'   ,diachiN='$idban' ,nguoitao='$nguoitao',tientra='$tientra',idchol='$idchol'   "  ;

	if($data->query($sql)){
	 	$sql="select * from phieunhapxuat where SoCT='$sochungtu'";
		$dong=getdong($sql);
	 	return $dong;
	}
	else{
		return;
	}
}

function checkPhieunhapxuat($sct){
global $data;
	$sql="select SoCT from phieunhapxuat where SoCT='$sct'";
	
	$dong=getdong($sql);
	
	if($dong['SoCT']){
		return true;
	}
	else{
		
		return false;
	}
}
function checkPhieuNhapxuat1($madh){
global $data;
	$sql="select ID from vanchuyenonline where madh ='$madh'";
	
		$query =$data->query($sql);
		$numrow=$data->num_rows($query);
			
		if($numrow==0){
			
			return true;
		}
		
		return false;
}
function insertXuatbanhang($arr){
	global $data;
	$IDPhieu=$arr['IDPhieu'];
	$IDSP=$arr['IDSP'];
	$mahang=$arr['mahang'];
	$tenpt=$arr['tenpt'];
	$SoLuong=$arr['SoLuong'];
	$DonGia=$arr['DonGia'];
	$LoaiTien=$arr['LoaiTien'];
	$chietkhau=$arr['chietkhau'];
	$Loai=$arr['Loai'];
	$giavon=$arr['giavon'];
	$idnhom=$arr['idnhom'];
	$idtao=$arr['idtao'];
	$idnv=$arr['idnv'];
	
	 $sql="INSERT INTO xuatbanhang (IDPhieu,IDSP,mahang,tenpt,SoLuong,DonGia,LoaiTien,Thue,BaoHanh,Ghichu,chietkhau,Loai,giavon,idnhom,idtao,idnv) VALUES('$IDPhieu','$IDSP','$mahang','$tenpt','$SoLuong','$DonGia','$LoaiTien','$Thue','$BaoHanh','$Ghichu','$chietkhau','$Loai','$giavon','$idnhom','$idtao','$idnv')";
	 
	 $update=$data->query($sql);
	 	
	 	return $update;
}

function insertVanchuyenonline($arr){
	global $data;
	$IDbill=$arr['IDbill'];
	$sobill=$arr['sobill'];
	$madh=$arr['madh'];
	$Fbpage=$arr['Fbpage'];
	$mavd=$arr['mavd'];
	$madoitac=$arr['madoitac'];
	$donvivc=$arr['donvivc'];
	$phitravc=$arr['phitravc'];
	$phithukh=$arr['phithukh'];
	$nvxuly=$arr['nvxuly'];
	$nvcskh=$arr['nvcskh'];
	

	 $sql="INSERT INTO vanchuyenonline (IDbill,sobill,madh,Fbpage,mavd,madoitac,donvivc,phitravc,phithukh,nvxuly,nvcskh)  
	 VALUES('$IDbill','$sobill','$madh','$Fbpage','$mavd','$madoitac','$donvivc','$phitravc','$phithukh','$nvxuly','$nvcskh')";
	 
	 $update=$data->query($sql);
	 	
	 	return $update;
}

function GetsoCT($idkho){
	global $data;
 			$thang = gmdate('m', time() + 7*3600); 
		   $nam = gmdate('y', time() + 7*3600); 
		   $so = strlen($idkho) + 9;
		   $sql = "select   max(convert( mid(SoCT,$so,22),UNSIGNED INTEGER))as sp from phieunhapxuat  where loai ='1' and  IDKho='$idkho' and  mid(SoCT,4,2) = '$thang' " ;
 		   $kq = $data->truyvan($sql) ;		
		   $sp = laso($kq['sp']) + 1 ;
		   if (strlen($sp)== '1' ) $sp = "00". $sp ;
		   if (strlen($sp)== '2' ) $sp = "0". $sp ;
		   $sochungtu ="B".$nam.$thang.$_SESSION["S_MaNV"].".".$idkho.".".$sp ; 
		   $sochungtu2 ="B".$nam.$thang.$_SESSION["S_MaNV"].".".$idkho.".".($sp+1) ;
	return  $sochungtu ;
}
 
 return;

?>	