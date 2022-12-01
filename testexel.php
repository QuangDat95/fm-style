<?php  
session_start();
 //import thư viện
$root_path ='' ;
include($root_path."includes/config.php");
include($root_path."includes/removeUnicode.php");
 include($root_path."includes/class.mysql.php");
include($root_path."includes/function.php");

  	$tm = $_SESSION["root_path"] ; 
    $path = $root_path."data/maubanhangpancake.xlsx"  ;
	 
  	include( $root_path."excel/simplexlsx.class.php");
//khỏi tạo data
$data = new class_mysql();
$data->config();
$data->access();
// khởi tạo đọc excel
$xlsx = new SimpleXLSX($path);
$sheets=$xlsx->rows();


//đọc dữ liệu
$rows_begin = 4;
$rows_end = count($sheets);


if ($count_rows >= 600) $rows_end = 600;
list($cols,) = $xlsx->dimension();

$mangresult=array();
$manggiaohang=array();

foreach( $sheets as $k => $r) { 

	if (($k >= $rows_begin) && ($k <= $rows_end)) {
		/*echo "<pre>";  
				var_dump($r);
				echo "</pre>";*/
		$mangsp=array();
		$mangnv=array();
		$mangkh=array();
		$mangvc=array();
		$mangtinh=array();
		$mangquan=array();
		$mangphuong=array();
		$mangdiachi=array();
		$mangteam=array();
		
		if($r[2]){
			$arrmanv=tachmanv($r[18]);
			$mangdonhang=array(
				"madh"=>$r[2],
				"ghichu"=>$r[2].' '.$r[19].' '.$arrmanv["tenkh"],
				"giamgia"=>$r[53],
				"ngaytao"=>$r[32],
				"nvxacnhan"=>$r[15],
				"togtien"=>$r[79],
			);
			
			
			//nhân vien
			if(checkExists('MaNV',$arrmanv["manv"],"userac")){
				$mangnv=checkExists('MaNV',$arrmanv["manv"],"userac");
			}
			else{
				$mangnv=array("manv"=>$arrmanv["manv"],"check"=>false);
			}
			//voucher
			if(checkExists('maso',$arrmanv["voucher"],"phieukhuyenmai")){
				$mangvc=checkExists('maso',$arrmanv["voucher"],"phieukhuyenmai");
			}
			else{
				$mangvc=$arrmanv["voucher"];
			}
		
			
			//tinh
			if(checktinh($r[26])){
				$mangtinh=checktinh($r[26]);
			}
			else{
				$mangtinh=$r[26];
			}
			
			//quan
			if(checkquan($r[25])){
				$mangquan=checkquan($r[25]);
			}
			else{
				$mangquan=$r[25];
			}
			//phuong
			if(checkphuong($r[24])){
				$mangphuong=checkphuong($r[24]);
			}
			else{
				$mangphuong=$r[24];
			}
			
			//diachi
			$mangdiachi=$r[27];
			$sptam=array(
				"masp"=>(string)($r[42]),
				"soluong"=>(string)($r[44]),
				"dongia"=>(string)($r[46]),
				"giamgia"=>(string)($r[54])
			);
				//khách hàng
			if(checkExists('makh',$r[19],"customer")){
				$mangkh=checkExists('makh',$r[19],"customer");
			}
			else{
				//$mangkh=array("sdt"=>$r[19]);
				$quan=is_array($mangquan)?$mangquan["ID"]:$mangquan;
				$phuong=is_array($mangphuong)?$mangphuong["ID"]:$mangphuong;
				$arrtam=array(
				'name'=>$arrmanv["tenkh"],
				'makh'=>$r[19],
				'address'=>$mangdiachi,
				'type'=>0,
				'tel'=>$r[19],
				'ngaysinh'=>'',
				'quan'=>$quan,
				'phuong'=>$phuong,
				
				);
				$mangkh=insertKh($arrtam);
			}
			
			//check team
			if(checkTeam(trim($arrmanv['mach']))){
				$mangteam =checkTeam(trim($arrmanv['mach']));
			}
			else{
				if(checkCuahang(trim($arrmanv['mach']))){
					$mangteam =checkCuahang(trim($arrmanv['mach']));
				}
				else{
					$mangteam="chua có";
				}
			}
			array_push($mangsp,$sptam);
			$manggiaohangtam=array(
			"madh"=>$r[2],
			"fbpage"=>$r[3],
			"mavdpk"=>$r[4],
			"madoitac"=>$r[5],
			"dvvanch"=>$r[7],
			"phitravc"=>$r[8],
			"phithuvc"=>$r[9],
			"nvxuly"=>$r[12],
			"nvcskh"=>$r[13],
			"nvxacnhan"=>$r[15],
			"nvgui"=>$r[16],
			"dtkh"=>$r[19],
			"nvtaodon"=>$r[30],
			"ngaytaodon"=>$r[32],
			"nguondon"=>$r[35],
			"togtien"=>$r[79],
			"tinh"=>$mangtinh,
			"quan"=>$mangquan,
			"phuong"=>$mangphuong,
			"diachi"=>$mangdiachi,
			);
		}
		if(!$r[2]){
			continue;
		}
		if(!$sheets[$k+1][2]){
			
			for($i=$k+1;$i<$rows_end;$i++){
					$val=$sheets[$i];
					if($sheets[$i][2]){
						break;
					}
				$sptam=array(
					"masp"=>(string)($val[42]),
					"soluong"=>(string)($val[44]),
					"dongia"=>(string)($val[46])
			
				);
				array_push($mangsp,$sptam);
			}	
		}
		$mangdonhang["sp"]=$mangsp;
		$mangdonhang["nv"]=$mangnv;
		$mangdonhang["kh"]=$mangkh;
		$mangdonhang["vc"]=$mangvc;
		$mangdonhang["tinh"]=$mangtinh;
		$mangdonhang["quan"]=$mangquan;
		$mangdonhang["phuong"]=$mangphuong;
		$mangdonhang["diachi"]=$mangdiachi;
		$mangdonhang["team"]=$mangteam;
		array_push($mangresult,$mangdonhang);
		array_push($manggiaohang,$manggiaohangtam);
		/*for( $i = 0; $i < $cols; $i++)
		{
				
			
		}*/
	
	}
   
	 
} 

in($mangresult);return;
	$ngaytao = gmdate('Y-n-d H:i:s', time() + 7*3600) ;
foreach($mangresult as $key => $value){
	$makm=is_array($value['vc'])?$value['vc']['maso']:$value['vc'];
	$sct=uniqid().$key;
	
	if(!checkPhieunhapxuat($sct)){
		
	
	$arr=array(
		"idkho"=>(int)($value['team']),
		"idkhach"=>$value['kh']['ID'],
		"ngayxuat"=>$ngaytao,
		"lydoxuat"=>$value['team'],
		"tigia"=>$value['giamgia'],
		"vat"=>'',
		"ghichu"=>$value['ghichu'],
		"ngaytao"=>$value['ngaytao'],
		"idk"=>'',
		"makm"=>$makm,
		"name"=>$value['kh']['Name'],
		"address"=>$value['kh']['address'],
		"tenlydo"=>'',
		"idban"=>$value['nv']['manv'],
		"nguoitao"=>$value['nvxacnhan'],
		"tientra"=>$value['togtien'],
		"sct"=>$sct,
		"idchol"=>'',
		);
		$dong= insertPhieunhapxuat($arr);
		
		if($dong){
			$IDPhieu=$dong['ID'];
			foreach($value['sp'] as $k => $vl){
				$arr1=array(
					"IDPhieu"=>$IDPhieu,
					"IDSP"=>$vl['masp'],
					"mahang"=>'',
					"tenpt"=>'',
					"SoLuong"=>$vl['soluong'],
					"DonGia"=>$vl['dongia'],
					"LoaiTien"=>$value['ghichu'],
					"chietkhau"=>$value['ngaytao'],
					"Loai"=>'',
					"giavon"=>'',
					"idnhom"=>'',
					"idtao"=>'',
					"idnv"=>'',
					"idban"=>'',
					
				);
				echo "bảng xuất bán hàng <br>";
					in(insertXuatbanhang($arr1));
			}
			//insert vc online
			
			
				$arrv=array(
					"IDbill"=>$IDPhieu,
					"sobill"=>$IDPhieu,
					"madh"=>$manggiaohang[$key]['madh'],
					"Fbpage"=>$manggiaohang[$key]['fbpage'],
					"mavd"=>$manggiaohang[$key]['mavdpk'],
					"madoitac"=>$manggiaohang[$key]['madoitac'],
					"donvivc"=>$manggiaohang[$key]['dvvanch'],
					"phitravc"=>$manggiaohang[$key]['phitravc'],
					"phithukh"=>$manggiaohang[$key]['phithuvc'],
					"nvxuly"=>$manggiaohang[$key]['nvxuly'],
					"nvcskh"=>$manggiaohang[$key]['nvcskh'],
					
					);
					echo "bảng vận chuyển <br>";
					in(insertVanchuyenonline($arrv));
				
	}
	else{
		echo $key;
	}
	}
}


function in($mang){
	echo "<pre>";  
	var_dump($mang);
	echo "</pre>";
} 

?>
<?php 	 

 
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
 
?>