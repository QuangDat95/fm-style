<?php
session_start();
if ($_SESSION["LoginID"] == "") return;
$root_path = getcwd() . "/";
include($root_path . "biensession.php");
include($root_path . "includes/config.php");
include($root_path . "includes/removeUnicode.php");
include($root_path . "includes/class.paging.php");
include($root_path . "includes/class.mysql.php");
include($root_path . "includes/function.php");
include($root_path . "includes/function_local.php");
include($root_path . "excel/simplexlsx.class.php");
//$path = $root_path."data/maubanhangpancake.xlsx"  ; 

$idk = laso($_SESSION["LoginID"]);
if ($idk == 0) return;
$idkho = $_SESSION["se_kho"];

$data = new class_mysql();
$data->config();
$data->access();
$updated = false;

$tm = $_SESSION["root_path"];
//đọc dữ liệu
$path = $root_path . "data/tinhluong.xlsx";
$xlsx = new SimpleXLSX($path);
$sheets = $xlsx->rows();
$rows_begin = 1;
$rows_end = count($sheets);

$tam = [];
if ($rows_end >= 600) $rows_end = 600;
list($cols,) = $xlsx->dimension();

$data1 = $_POST['DATA'];
$tmp = explode('*@!', $data1);
$stt = 0;

$demdongsucc = 0;
$demdongfail = 0;
$mangch = taomang("cuahang", "macuahang", "ID");
$mangnv = taomang("userac", "MaNV", "ID");
$mangcv = taomang("userac", "MaNV", "ChucVu");
foreach ($sheets as $k => $r) {
	if (($k >= $rows_begin) && ($k <= $rows_end)) {
		$demdongfail++;
		$chuoiinsert = '';
		$luongthang = $r[1];
		$IDcuahang = $r[2];
		$IDNV = $mangnv[$r[3]];
		$tenNV = $r[4];
		$manv = $r[6];
		$ngayvaolam = $r[7];
		$chucdanh = $r[8];
		$ngaychuan = $r[13];
		$sogiotrenngay = $r[14];
		$giocong = $r[15];
		$luongngaycong = $r[17];
		$luongds = $r[20];
		$phucap = $r[26];
		$phucapdich = '';
		$phucapkhac = '';
		$phat = $r[27];
		$bhxh = $r[28];
		$thunhap = $r[29];
		$luongcu = $r[30];
		$congno = $r[31];
		$daung = $r[32];
		$giuluong = $r[33];
		$thucnhan = $r[34];
		$cuahang = $r[35];
		$xacnhan = $r[36];
		$xacnhanluongnghiviec = '';
		$giocongtinhsp = '';
		$thuongdskho = '';
		$thuongdsolt = '';
		$hesoluong = $r[10];
		$hesovung = $r[11];
		$socuahang = '';
		$machaythuong = $r[3];
		$machayluong = $r[4];
		$phantramdoanhthu = '';
		$luongdtcpct = $r[21];
		$luongdtbhtnbv = $r[22];
		$hoahong = $r[23];
		$thuongcs = $r[24];
		$thuongtop = $r[25];
		$songaytrongthang = '';
		$songaymocua = '';
		$hanghoa = '';
		$nhansuvadaotao = '';
		$doanhthumoicuahang = '';
		$dichvu = '';
		$doanhthumuctieu = '';
		$doanhthuthuc = '';
		$doanhthucanhan = '';
		$doanhthudat = '';
		$hesodoanhthu = '';
		$luongchitieu = '';
		$luongDTCNTB = '';
		$luongdoanhthu = '';
		$luongCPtrenDT = '';
		$luongcoban = $r[12];
		$luongkpi = '';
		$luongtrachnhiem = '';
		$chucvu = $mangcv[$r[6]];
		$phongban = '';
		$chuoiinsert .= "('$luongthang','$IDcuahang','$IDNV','$tenNV','$manv','$ngayvaolam','$chucdanh','$ngaychuan','$sogiotrenngay','$giocong','$luongngaycong','$luongds','$phucap','$phucapdich','$phucapkhac','$phat','$bhxh','$thunhap','$luongcu','$congno','$daung','$giuluong','$thucnhan','$cuahang','$xacnhan','$xacnhanluongnghiviec','$giocongtinhsp','$trugiocongtinhsp','$thuongdskho','$thuongdsolt','$hesoluong','$hesovung','$socuahang','$machaythuong','$machayluong','$phantramdoanhthu','$luongdtcpct','$luongdtbhtnbv','$hoahong','$thuongcs','$thuongtop','$songaytrongthang','$songaymocua','$hanghoa','$nhansuvadaotao','$doanhthumoicuahang','$dichvu','$doanhthumuctieu','$doanhthuthuc','$doanhthucanhan','$doanhthudat','$hesodoanhthu','$luongchitieu','$luongDTCNTB','$luongdoanhthu','$luongCPtrenDT','$luongcoban','$luongkpi','$luongtrachnhiem','$chucvu','$phongban')";

		if (insertNsLuongthang($chuoiinsert)) {
			$demdongsucc++;
		} else {
			echo '<p style="red">thất bại dòng  ' . $k . '<p>';
		}
	}
}

if ($demdongsucc) {

	echo '<p style="green">Thành công ' . $demdongsucc . ' dòng </p>';
}
$data->closedata();



function insertNsLuongthang($chuoi)
{
	global $data;



	$sql = "insert into ns_luongthang  (luongthang,IDcuahang,IDNV,tenNV,manv,ngayvaolam,chucdanh,ngaychuan,sogiotrenngay,giocong,luongngaycong,luongds,phucap,phucapdich,phucapkhac,phat,bhxh,thunhap,luongcu,congno,daung,giuluong,thucnhan,cuahang,xacnhan,xacnhanluongnghiviec,giocongtinhsp,trugiocongtinhsp,thuongdskho,thuongdsolt,hesoluong,hesovung,socuahang,machaythuong,machayluong,phantramdoanhthu,luongdtcpct,luongdtbhtnbv,hoahong,thuongcs,thuongtop,songaytrongthang,songaymocua,hanghoa,nhansuvadaotao,doanhthumoicuahang,dichvu,doanhthumuctieu,doanhthuthuc,doanhthucanhan,doanhthudat,hesodoanhthu,luongchitieu,luongDTCNTB,luongdoanhthu,luongCPtrenDT,luongcoban,luongkpi,luongtrachnhiem,chucvu,phongban) values $chuoi";

	echo $sql; return;
	if ($data->query($sql)) {

		return true;
	} else {
		return;
	}
}
