<?php

session_start();

$root_path = getcwd() . "/";
include($root_path . "biensession.php");
include($root_path . "includes/config.php");
include($root_path . "includes/removeUnicode.php");
include($root_path . "includes/class.paging.php");
include($root_path . "includes/class.mysql.php");
include($root_path . "includes/function.php");
include($root_path . "myfunction.php");
include($root_path . "tinhluongkpifunction.php");

$data = new class_mysql();
$data->config();
$data->access();
$data1 = $_POST['DATA'];
$tmp = explode('*@!', $data1);
$ten   =  ($tmp[0]);
$ma = trim($tmp[1]);
$kho = trim($tmp[2]);
$tu = trim($tmp[3]);
$den = trim($tmp[4]);
$trang = laso($tmp[6]);
$IDNV = laso($tmp[5]);
$thang =  $tmp[7];
$loaiusertim =  laso($tmp[9]);

$ngay =  explode('/', $tu);
if (strlen($ngay[1]) == 1) {
	$ngay[1] = "0" . $ngay[1];
}
if (strlen($ngay[0]) == 1) {
	$ngay[0] = "0" . $ngay[0];
}
$tungay =   "$ngay[2]-$ngay[1]-$ngay[0]";
$ngaybatdau = $ngay[0];
$ngay =  explode('/', $den);
if (strlen($ngay[1]) == 1) {
	$ngay[1] = "0" . $ngay[1];
}
if (strlen($ngay[0]) == 1) {
	$ngay[0] = "0" . $ngay[0];
}
$toingay = "$ngay[2]-$ngay[1]-$ngay[0]";

$tu = date("Y-m-d", strtotime($toingay));
$sql = "Select * from ns_luongthang where manv = '$ma' and YEAR(luongthang) = YEAR('$tu') AND MONTH(luongthang) = MONTH('$tu')";

$row = getdong($sql);
// echo $sql;
// var_dump($row);
$output = tinhluong_nangluc($row['luongcoban'], $row['luongkpi'], $row['phucap'] + $row['phucapkhac'], $row['songaytrongthang'], $row['ngaychuan'], $row['bhxh'], $row['daung'], $row['phat']);
echo $output;

function tinhluong_nangluc($luongvitri, $luongnangluc, $phucap, $congchuanthang, $congthucte, $sotienbaohiem, $daung, $phat)
{
	$tienluong = ((($luongvitri + $luongnangluc + $phucap) / $congchuanthang) * $congthucte) - $sotienbaohiem - $daung - $phat;
	return $tienluong;
}

function tinhluong_doanhthu($luongcoban, $luongdoanhthu, $phucap, $congchuanthang, $congthucte, $sotienbaohiem, $daung, $phat)
{
	$tienluong = ((($luongcoban + $luongdoanhthu + $phucap) / $congchuanthang) * $congthucte) - $sotienbaohiem - $daung - $phat;
	return $tienluong;
}
