<?php
session_start();
$idk = $_SESSION["LoginID"];
if ($idk == '') return;
$idkho = $_SESSION["se_kho"];
$root_path = getcwd() . "/";
include($root_path . "biensession.php");
include($root_path . "includes/config.php");
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
$i = 0;
$ma = $tmp[0];
$Name = addslashes($tmp[1]);
$type = laso($tmp[2]);
$soluong = laso($tmp[3]);
$gia = laso($tmp[4]);
$donvitinh = laso($tmp[5]);
$nguoinhan = $tmp[6];
$ngaybatdau = $tmp[7];
$ngayketthuc = $tmp[8]; // $tientra =str_replace(",","",$tmp[14]) ;	
$note = addslashes($tmp[9]);
$baohanh = laso($tmp[10]);
$idgoi = laso($tmp[11]);
$nhomtaisan  = laso($tmp[13]);
$mota  =  addslashes($tmp[14]);
$ngaythuchi = $tmp[15];
$sochungtu = trim($tmp[16]);

// echo "**#" . $tmp[11] . "**#$sochungtu**#Cập nhật $sql !!! **#"; return;

if ($sochungtu == '') {
	$sql = "SELECT `AUTO_INCREMENT` as sp FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '$db[name]' AND TABLE_NAME = 'taisantam';";
	$kq = getdong($sql);
	$sp  = laso($kq['sp']);
	$sochungtu  = "TST." . $nhomtaisan . "." . $sp;
}

//echo $data1;
//Thuchikt
$loainhom = $tmp[14];



$sotien = $tmp[17];
$lydo = $tmp[18];
$nguoinhan = $tmp[19];
$nguoichi = $tmp[20];
$cuahang = $tmp[21];
$donvi = $tmp[22];
$nhacungcap = $tmp[23];

$ID = $tmp[25];
$luachon = $tmp[26];
$loaitaikhoan = $tmp[27];


$loaitaisan = $tmp[29];
$tkco = "";
$tkno = "";
$psno = "";
$psco = "";
$hdbh = "";
$mavandon = "";
$IDkhoa = "";
$manv = "";
$phieuxuat = "";
$sophieupm = "";
$chungtu = "";
$donvivc = "";
$phithukh = "";
$IDCha = "";

$sotknh = $taikhoanh['ma'];
$tentknh = $taikhoanh['Name'];

if ($ngaythuchi != "") {
	$ngaythuchi =  explode('/', $ngaythuchi);
	if (strlen($ngaythuchi[1]) == 1) {
		$ngaythuchi[1] = "0" . $ngaythuchi[1];
	}
	if (strlen($ngaythuchi[0]) == 1) {
		$ngaythuchi[0] = "0" . $ngaythuchi[0];
	}
	$ngaythuchi = "$ngaythuchi[2]-$ngaythuchi[1]-$ngaythuchi[0]";
	// $sql_where .= " and  ngaylenhethong <= '$ngay[2]-$ngay[1]-$ngay[0] 23:59'";
} else {
	$ngaythuchi = gmdate('Y-m-d H:i:s', time() + 7 * 3600);
}


if ($ngaybatdau != "") {
	$ngay =  explode('/', $ngaybatdau);
	if (strlen($ngay[1]) == 1) {
		$ngay[1] = "0" . $ngay[1];
	}
	if (strlen($ngay[0]) == 1) {
		$ngay[0] = "0" . $ngay[0];
	}
	$ngaybatdau = "$ngay[2]-$ngay[1]-$ngay[0]";
	// $sql_where .= " and  ngaylenhethong <= '$ngay[2]-$ngay[1]-$ngay[0] 23:59'";
}
if ($ngayketthuc != "") {
	$ngay =  explode('/', $ngayketthuc);
	if (strlen($ngay[1]) == 1) {
		$ngay[1] = "0" . $ngay[1];
	}
	if (strlen($ngay[0]) == 1) {
		$ngay[0] = "0" . $ngay[0];
	}
	$ngayketthuc = "$ngay[2]-$ngay[1]-$ngay[0]";
	// $sql_where .= " and  ngaylenhethong <= '$ngay[2]-$ngay[1]-$ngay[0] 23:59'";
}

$nguoitao = $_SESSION["TenUser"] . "_" . $idk; // dùng lưu sau này phòng trường hợp bị đổi tên user để dùng lại 
// $ngaytao = 
$ngay =  explode('/', $tmp[1]);
if (strlen($ngay[1]) == 1) {
	$ngay[1] = "0" . $ngay[1];
}
if (strlen($ngay[0]) == 1) {
	$ngay[0] = "0" . $ngay[0];
}
//	 $ngayxuat = $ngay[2].'-'.$ngay[1].'-'.$ngay[0] ; // có the sau nay lay theo nguoi tao de có thẻ nhap lui

$ngayxuat = gmdate('Y-m-d', time() + 7 * 3600);

if ($idgoi == 0) {
	$idphieu = getdong(" select ID from taisantam where  ma='$ma' limit 1  ");

	if ($idphieu['ID'] > 0) {
		$sql = "SELECT `AUTO_INCREMENT` as sp FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '$db[name]' AND TABLE_NAME = 'taisantam';";
		$kq = getdong($sql);
		$sp  = laso($kq['sp']);
		$sochungtu  = "TST." . $nhomtaisan . "." . $sp;
	}
	$sql = "INSERT INTO taisantam SET dakhoa=0,ma='$sochungtu',mota='$mota',gia='$gia',nguoinhan='$nguoinhan', nguoigiao='$nguoigiao', donvitinh='$donvitinh', cuahang='$idkho', ngaybatdau='$ngaybatdau',ngayketthuc='$ngayketthuc',soluong='$soluong',ngaytao='$ngaythuchi',  Name ='$Name',type ='$type',note ='$note' ,nhomtaisan='$nhomtaisan', idtao='$idk' ON DUPLICATE KEY UPDATE  ma =VALUES(ma) ,gia=VALUES(gia),nguoinhan=VALUES(nguoinhan),nguoigiao=VALUES(nguoigiao),donvitinh=VALUES(donvitinh),cuahang=VALUES(cuahang),ngaybatdau=VALUES(ngaybatdau),ngayketthuc=VALUES(ngayketthuc),soluong=VALUES(soluong),ngaytao=VALUES(ngaytao),Name=VALUES(Name),type=VALUES(type),note=VALUES(note),nhomtaisan=VALUES(nhomtaisan)  ,idtao=VALUES(idtao) ";
	$data->query($sql);

	echo "**#" . $idgoi . "**#$sochungtu**#Đã thêm phiếu tài sản thành công!!! **#";
	return;
} else	if ($idgoi > 0) {   //  $idgoi <>0 cập nhập


	$st = getdong(" select ID,dakhoa from taisantam where ID='$idgoi' and ma ='$ma'  ");
	if (laso($st['dakhoa']) == 1) {
		echo "**#**#**#Phiếu đã khóa!!! **#8";
		return;
	}
	if (laso($st['ID']) == 0) {
		echo "**#**#**#Phiếu không tồn tại!!!**#8 ";
		return;
	}

	//  $st = getdong(" select ID from taisantam where ID <> '$idgoi' and  ma ='$ma' ") ;
	// if (trim($st['ID'])!= "") { echo "#*#*Trùng số chứng từ khi lưu !!!#*#* " ; return ; } 


	$sql = "UPDATE taisantam SET dakhoa=0, mota= '$mota',gia='$gia',nguoinhan='$nguoinhan', nguoigiao='$nguoigiao',donvitinh='$donvitinh', cuahang='$cuahang',ngaybatdau='$ngaybatdau',ngayketthuc='$ngayketthuc',soluong='$soluong',ngaytao='$ngaythuchi',ma='$ma',Name ='$Name',type ='$type',note ='$note',cuahang='$idkho',nhomtaisan='$nhomtaisan', idtao='$idk'   where ID = '$idgoi'";
	$data->query($sql);


	$update = $data->query($sql);
	echo "**#" . $idgoi . "**#$sochungtu**#Đã cập nhật phiếu tài sản thành công !!! **#";
	return;
}


// echo $sql ; 
$data->closedata();
return;
 
//=========het kiem tra =================================  				
