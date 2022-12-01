<?php
session_start();
$idk = $_SESSION["LoginID"];
if ($idk == '') return;
$idkho = $_SESSION["se_kho"];
$root_path = getcwd() . "/";
include($root_path . "biensession.php");
include($root_path . "includes/config.php");
include($root_path . "includes/removeUnicode.php");
include($root_path . "includes/class.paging.php");
include($root_path . "includes/class.mysql.php");
include($root_path . "includes/function.php");
include($root_path . "includes/function_local.php");

$data = new class_mysql();
$data->config();
$data->access();
$mpt = array();
$mangud = array();
$data1 = $_POST['DATA'];
$tmp = explode('*@!', $data1);
$mang = explode('|@|', $tmp[1]);
//echo $data1;
$i = 0;
$data->setthaotac('xuatkholuu');
foreach ($mang as $x) {
	$mpt[$i] = explode('|*|', $x);
	$i  = $i + 1;
}


$sochungtu = $tmp[2];
$tigia = laso($tmp[4]);
$lydoxuat = $tmp[5];
$idban = $tmp[6];
$idkhach = laso($tmp[7]);
$ghichu = addslashes($tmp[8]);
$vat = $tmp[9];
$Loai = $tmp[10];
$tenkhach = $tmp[11];
$diachi = $tmp[12];
$tientra = str_replace(",", "", $tmp[14]);
$qua = trim($tmp[15]);
$diem = str_replace(",", "", $tmp[16]);
$diem = substr($diem, strrpos($diem, '-') + 1, strlen($diem));
$makm = trim($tmp[17]);
$idchol = laso($tmp[18]);
$tenN =  ($tenkhach);
$diachiN =  ($diachi);
$idgioithieu = laso($tmp[19]);
//$tenkho = getten("kho",$xuatkho,"Name") ;

$idgoi = laso($tmp[0]);
$nguoitao = $_SESSION["TenUser"] . "_" . $idk; // dùng lưu sau này phòng trường hợp bị đổi tên user để dùng lại 

$khach = getdong("select Name,address,diemtichluy from customer where ID = '$idkhach' limit 1 ");
$tenlydo = getten("lydonhapxuat", $lydoxuat, "Name");
$mangc = $_SESSION["mangck"];
function timchietkhau($diem)
{
	global $mangc;
	$chietkhau = 0;
	foreach ($mangc as $m) {
		if ($diem >= $m[0]) $chietkhau = $m[1];
	}
	return $chietkhau;
}
$ck = timchietkhau($khach['diemtichluy']);
if (strlen($ck) == 1) $ck = "0" . $ck;

$ngaytao = gmdate('Y-n-d H:i:s', time() + 7 * 3600);
$ngay =  explode('/', $tmp[1]);
if (strlen($ngay[1]) == 1) {
	$ngay[1] = "0" . $ngay[1];
}
if (strlen($ngay[0]) == 1) {
	$ngay[0] = "0" . $ngay[0];
}
//	 $ngayxuat = $ngay[2].'-'.$ngay[1].'-'.$ngay[0] ; // có the sau nay lay theo nguoi tao de có thẻ nhap lui
$ngayxuat = gmdate('Y-n-d', time() + 7 * 3600);
//	 echo $idgoi ;




if ($idgoi == 0) {

	// $idnha la id cap nhap lan thu n, idtao là id tạo ra phiéu này, idtao va idnhap thong thuong trung nhau
	$tam = getdong(" select ID from phieunhapxuat where SoCT ='$sochungtu' limit 1 ");
	if ($tam["ID"]  != "") {

		//	 echo "Trùng số chứng từ !!! " ; return ; }   
		//=======================================================================================
		$thang = gmdate('m', time() + 7 * 3600);
		$nam = gmdate('y', time() + 7 * 3600);
		$so = strlen($idkho) + 9;
		$sql = "select   max(convert( mid(SoCT,$so,22),UNSIGNED INTEGER))as sp from phieunhapxuat  where loai ='1' and  IDKho='$idkho' and  mid(SoCT,4,2) = '$thang' ";
		$kq = $data->truyvan($sql);
		$sp = laso($kq['sp']) + 1;
		if (strlen($sp) == '1') $sp = "00" . $sp;
		if (strlen($sp) == '2') $sp = "0" . $sp;
		$sochungtu = "B" . $nam . $thang . $_SESSION["S_MaNV"] . "." . $idkho . "." . $sp;
		$sochungtu2 = "B" . $nam . $thang . $_SESSION["S_MaNV"] . "." . $idkho . "." . ($sp + 1);
	}
	$tam = getdong(" select ID from phieunhapxuat where SoCT ='$sochungtu' limit 1 ");



	if ($tam["ID"]  != "") $sochungtu = $sochungtu2;
	if ($ck != "00")	$ghichu = $ck . "% " . $ghichu;

	$sql = "insert into phieunhapxuat   set Loai='1' ,IDKho ='$idkho',IDNhaCC ='$idkhach' ,IDNhap ='$id' ,NgayNhap ='$ngayxuat' ,SoCT='$sochungtu' ,LyDo='$lydoxuat' ,SoNgayNo='0' ,IDTKNo='0' ,IDTKCo='0' ,TiGia ='$tigia' ,VAT='$vat' ,GhiChu='$ghichu' ,NgayTao='$ngaytao' ,IDTao='$idk' ,NguoiGiao='$makm' ,ten='$khach[Name]',diachi='$khach[address]', tenlydo='$tenlydo'   ,diachiN='$idban' ,nguoitao='$nguoitao',tientra='$tientra',idchol='$idchol',idgioithieu='$idgioithieu'   ";
	$data->query($sql);


	$idphieu = getdong(" select ID from phieunhapxuat where  SoCT = '$sochungtu'  ");
	$idphieu = $idphieu['ID'];


	//   echo  $tam["ID"]." select ID from phieunhapxuat where SoCT ='$sochungtu' limit 1 " ;	


	$sql = "INSERT INTO xuatbhchuakhoa (IDPhieu,IDSP,mahang,tenpt,SoLuong,DonGia,LoaiTien,Thue,BaoHanh,Ghichu,chietkhau,Loai,giavon,idnhom,idtao,idnv,mota) VALUES ";
	$sqlu = "";
	$sqlt = "";


	$tien = 0;

	foreach ($mpt as $x) {

		if ($Loai == '0') {
			$dau = "+";
			$t3 = laso($x[3]);
		} else {
			$dau = "-";
			$t3 = - (laso($x[3]));
		}
		$t0 = $x[0];
		$t1 = $x[1];
		$t2 = $x[2];
		$t4 = laso($x[4]);
		$t5 = $x[5];
		$t6 = $x[6];
		$t7 = addslashes($x[7]);
		$tenpt = getdong("select a.Name,a.code,a.codepro,a.price,a.idgroup,a.giabinhquan,b.giagiam from products a left join giamgiacuahang b on (a.id=b.idsp and b.idcuahang=$idkho)   where a.ID=$t0 limit 1 ");
		$giagiam = laso($tenpt['giagiam']);
		$gia = $tenpt['giabinhquan'];
		$nhom = $tenpt['idgroup'];
		$tien = $tien + $t3 * ($t4 - ($t5 * $t4 / 100));
		$codepro = $tenpt['codepro'];
		$giaban = $tenpt['price'];
		$mota = $tenpt['code'];
		$tenpt = addslashes($tenpt['Name']);
		if ($sqlu == "") {		     // IDPhieu   ,IDSP,mahang,tenpt,   SoLuong,DonGia,LoaiTien,Thue,BaoHanh,Ghichu,chietkhau,Loai,giavon			
			$sqlu =  "('$idphieu','$t0','$codepro','$tenpt','$t3','$t4','$t6','0','0','$t7','$t5','1','$gia','$nhom','$giaban','$giagiam','$mota')";
		} else {
			$sqlu .= ",('$idphieu','$t0','$codepro','$tenpt','$t3','$t4','$t6','0','0','$t7','$t5','1','$gia','$nhom','$giaban','$giagiam','$mota')";
		}

		$sl = abs($t3);

		//	  $data->query("update products set SoLuong = SoLuong - $sl  where ID ='$t0' ");
		//	  $data->query("update hanghoacuahang set SoLuong = SoLuong - $sl  where IDSP ='$t0' and IDcuahang = '$idkho'  "); 

	}
	$sql .= $sqlu;  //  echo "$sql";
	$update = $data->query($sql);
	echo "**#$idphieu**#$sochungtu**#";


	if ($qua == "true") {

		$setdiem = 100 - ($tien / 10000);
		$sql = "insert into khuyenmai set ghichu='$ghichu - set diem ve 0' ,iduser='$idk' ,diem='$diem'  ,
			   idcuahang='$idkho' ,loai='1',ngay='$ngaytao',sophieu='$sochungtu',idkhach='$idkhach' ";
		$update = $data->query($sql);
		//	 $sql = " update customer  set  diemtichluy='$setdiem' where id='$idkhach'		  ";
		$sql = " update customer  set  diemtichluy='0' where id='$idkhach' limit 1		  ";
		$update = $data->query($sql);
	}
	return;
}   // else của them mới
else {   //  $idgoi <>0 cập nhập


	$st = getdong(" select ID,dakhoa from phieunhapxuat where ID='$idgoi' and  SoCT ='$sochungtu'   ");
	if (laso($st['dakhoa']) == 1) {
		echo "#*#*Phiếu đã khóa  !!! ";
		return;
	}
	if (laso($st['ID']) == 0) {
		echo "#*#*Phiếu không tồn tại !!! ";
		return;
	}

	$st = getdong(" select ID from phieunhapxuat where ID <> '$idgoi' and  SoCT ='$sochungtu' ");
	if (trim($st['ID']) != "") {
		echo "#*#*Trùng số chứng từ khi lưu !!! ";
		return;
	}


	$sql = " update phieunhapxuat   set  IDNhaCC ='$idkhach' , IDNhap ='$id' ,LyDo='$lydoxuat'    ,VAT='$vat' ,GhiChu='$ghichu'  ,NguoiGiao='$nguoigiao' ,ten='$khach[Name]',diachi='$khach[address]' ,TiGia ='$tigia', tenlydo='$tenlydo' ,tenN='$khach[NameN]' ,diachiN='$idban',tientra='$tientra'    where ID = '$idgoi'";
	$data->query($sql);

	$data->query(" delete from xuatbhchuakhoa where IDPhieu='$idgoi'    ");
	// $sql = "INSERT INTO xuatbhchuakhoa (IDPhieu,IDSP,mahang,tenpt,SoLuong,DonGia,LoaiTien,Thue,BaoHanh,Ghichu,chietkhau,Loai,giavon,idnhom,idnv) VALUES "; 
	$sql = "INSERT INTO xuatbhchuakhoa (IDPhieu,IDSP,mahang,tenpt,SoLuong,DonGia,LoaiTien,Thue,BaoHanh,Ghichu,chietkhau,Loai,giavon,idnhom,idtao,idnv,mota) VALUES ";
	// $sql = "INSERT INTO xuatbhchuakhoa (IDPhieu,IDSP,mahang,tenpt,SoLuong,DonGia,LoaiTien,Thue,BaoHanh,Ghichu,chietkhau,Loai) VALUES "; 
	$sqlu = "";
	$sqlt = "";
	foreach ($mpt as $x) {
		$t0 = $x[0];
		$t1 = $x[1];
		$t2 = $x[2];
		$t3 = laso($x[3]);
		$t4 = laso($x[4]);
		$t5 = $x[5];
		$t6 = $x[6];
		$t7 = addslashes($x[7]);
		//   $tenpt =   getdong(" select Name,price,idgroup,giabinhquan from products where ID= $t0 limit 1 ");

		$sqlt = " select a.Name,a.price,a.codepro,a.code,a.idgroup,a.giabinhquan,b.giagiam from products a left join giamgiacuahang b on (a.id=b.idsp and b.idcuahang=$idkho) where a.ID=$t0 limit 1";
		$tenpt =   getdong($sqlt);

		$giagiam = laso($tenpt['giagiam']);
		$gia = $tenpt['giabinhquan'];
		$mota = $tenpt['code'];
		$nhom = $tenpt['idgroup'];
		$tenpt = addslashes($tenpt['Name']);

		if ($sqlu == "") {		     // IDPhieu   ,IDSP,mahang,tenpt,   SoLuong,DonGia,LoaiTien,Thue,BaoHanh,Ghichu,chietkhau,Loai,giavon			
			$sqlu =  "('$idgoi','$t0','$t1','$tenpt','$t3','$t4','$t6','0','0','$t7','$t5','1','$gia','$nhom','$giaban','$giagiam','$mota')";
		} else {
			$sqlu .= ",('$idgoi','$t0','$t1','$tenpt','$t3','$t4','$t6','0','0','$t7','$t5','1','$gia','$nhom','$giaban','$giagiam','$mota')";
		}
	}
	$sql .= $sqlu;
	// echo  $sql ;
	$update = $data->query($sql);


	echo "**#$idgoi**#";
}


// echo $sql ; 
$data->closedata();
return;

//=========bat dau kiem tra =================================  
if ($idkhach > 1) {
	foreach ($mpt as $x) {
		if ($x[1] == 'ATCF182')
			$kt =   getdong(" select a.ID from phieunhapxuat a left join xuatbanhang b on a.ID = b.IDPhieu  where a.IDNhaCC= $idkhach and b.mahang='ATCF182' limit 1 ");

		if ($kt['ID'] != "") {
			echo "**#8**#Mã ATCF182 đã được khách hàng này mua một lần rồi !";
			// return ;		      
		}
	}
}
   
  
  
			//=========het kiem tra =================================  				
