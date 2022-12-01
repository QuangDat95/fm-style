<?php
session_start();
//if ($_SESSION["LoginID"] =='') { return ; }
function in($str)
{
	echo "<pre>";
	var_dump($str);
	echo '</pre>';
}

//$giobatdau1=7.3;$g=floor($giobatdau1); $p=$giobatdau1-$g;if($p<0.6&&$p>0) $p=$p*100; echo $p ;

//   return;

$root_path = getcwd() . "/";
include($root_path . "biensession.php");
include($root_path . "includes/config.php");
include($root_path . "includes/removeUnicode.php");
include($root_path . "includes/class.paging.php");
include($root_path . "includes/class.mysql.php");
include($root_path . "includes/function.php");
include($root_path . "myfunction.php");

$data = new class_mysql();
$data->config();
$data->access();
if (isset($_POST['DATA'])) {
	$data1 = $_POST['DATA'];
	$tmp = explode('*@!', $data1);

	$ma = trim($tmp[0]);
	$ngaymau = trim($tmp[1]);
	$loaicvmau = trim($tmp[2]);

	$ngay = date('d');
	//$thang=date('m');
	$thang = 11;
	$sql = "select thongtin from nhanviendilam where manv='$ma' and ngaytao>='$ngaymau' and ngaytao<='" . $ngaymau . " 23:59:00'";
	$dong = getdong($sql);

	if (!$dong['thongtin']) {
		echo '<div style="color:red">Không tìm thấy thông tin<div>';
		return;
	}

	if(isset($loaicvmau)) {
		$dongthongtin = explode("*",$dong['thongtin']);
		$dongthongtin[6] = $loaicvmau;
		$chuoithongtin = implode("*",$dongthongtin);
	}

	//<button style="margin-left: 1em;" onclick="editChuoi(this.value)">Sửa</button>
	//$dong['thongtin']
	$chuoihmtl = '<p style="font-weight: bold;">Các chuỗi thông tin</p>';
	$chuoihmtl .= '<div><span style="    width: 40%;
    display: inline-block;"><input  type="text" style="    width: 100%;" id="chuoitttrave" value="' . $chuoithongtin . '"></span></div><div style="margin-top:1em;" id="copyres"></div>';

	echo $chuoihmtl;
}


if (isset($_POST['COPYTT'])) {
	$data1 = $_POST['COPYTT'];
	$tmp = explode('*@!', $data1);

	$ma = trim($tmp[0]);
	$chucvu = trim($tmp[1]);
	$tu = trim($tmp[2]);
	$den = trim($tmp[3]);
	$chuoitt = trim($tmp[4]);
	if ($ma) {
		$sql = "update nhanviendilam set thongtin='$chuoitt' where manv='$ma' and ngaytao>='$tu' and ngaytao<='" . $den . " 23:59:00" . "'";

		//$update=$data->query($sql);
		if ($data->query($sql)) {
			echo '<div style="color:green">Đã copy thành công!<div>';
		}
	}
	if ($chucvu) {
		$sql = "select ID from userac where Chucvu=$chucvu";
		/*	echo $sql;
			return;*/
		$query = $data->query($sql);
		$numrow = $data->num_rows($query);

		if ($numrow == 0) {
			echo '<div style="color:red">Không tìm thấy nhân viên nào!<div>';
			return;
		}
		$query = $data->query($sql);
		$k = 0;
		while ($rows = $data->fetch_array($query)) {
			$sql = "update nhanviendilam set thongtin='$chuoitt' where IDnhanvien='$rows[ID]'  and ngaytao>='$tu' and ngaytao<='" . $den . " 23:59:00" . "'";

			if ($data->query($sql)) {
				$k++;
			}
		}
		if ($k == $numrow) {
			echo '<div style="color:green">Đã copy thành công ' . $k . ' nhân viên!<div>';
		}
		if ($k < $numrow) {
			echo '<div style="color:green">Đã copy thành công ' . $k . ' nhân viên!<div>
					<div style="color:green">Thất bại ' . ($numrow - $k) . ' nhân viên!<div>
				';
		}
	}
}
$data->closedata();
