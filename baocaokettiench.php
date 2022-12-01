<?php
session_start();



$root_path = getcwd() . "/";
$quyen = $_SESSION["quyen"];

$ql = $quyen[$_SESSION["mangquyenid"][$_SESSION['act']]];
//$ql='120000';
$idl = $_SESSION["LoginID"];
// var_dump($ql);
//var_dump($_SESSION["mangquyenid"]['baocaokhuyenmai']);
//$ql[5]=5;
if (!($ql[0] || $idl == 1)) {
	return;
}
$wherequyen = '';
if (!$ql[5]) {
	if ($ql[1]) {
		$wherequyen = ' and ( a.phieuxuat is not null and  a.phieuxuat <> "")';
	} else if ($ql[2]) {
		$wherequyen = ' and d.xacnhan=1';
	} else if ($ql[3]) {

		$wherequyen = ' and d.xacnhan=2';
	} else if ($ql[4]) {
		$wherequyen = ' and d.xacnhan=3';
	}
} else {
	$wherequyen = ' ';
}
include($root_path . "includes/config.php");
include($root_path . "includes/removeUnicode.php");
include($root_path . "includes/class.paging.php");
include($root_path . "includes/class.mysql.php");
include($root_path . "includes/function.php");




$data = new class_mysql();
$data->config();
$data->access();

$data1 = $_POST['DATA'];
$tmp = explode('*@!', $data1);


$manv = trim($tmp[0]);
$kho = laso($tmp[1]);
$tu = trim($tmp[2]);
$den = trim($tmp[3]);
$tinhtrang = laso($tmp[4]);
$ten = chonghack($tmp[5]);
$loai = laso($tmp[6]);
$sotien = laso($tmp[7]);
$soct = trim($tmp[8]);
$loc = trim($tmp[9]);
$tkno = trim($tmp[10]);
$tkco = trim($tmp[11]);
$curentpage = trim($tmp[12]);
//echo $tu;
//dieufd kiên thêm ++++++++++++++++++++++++++++++++++++

$stknh = trim($tmp[13]);
$tentknh = trim($tmp[14]);
$mavd = trim($tmp[15]);
$dvvc = trim($tmp[16]);
$ncc = trim($tmp[17]);
$manv = trim($tmp[18]);
$phieuxuat = trim($tmp[19]);
// $tkno= trim($tmp[20]);
//$tkco= trim($tmp[21]);
$diengiai = trim($tmp[22]);
$dinhkhoan = trim($tmp[23]);
$psno = trim($tmp[24]);
$psco = trim($tmp[25]);
$dongia = trim($tmp[26]);
$soluong = trim($tmp[27]);
$dvt = trim($tmp[28]);


$ngaytaotu = trim($tmp[29]);
$ngaytaoden = trim($tmp[30]);
$loai = trim($tmp[31]);
$limit = trim($tmp[32]);
$nguoixacnhan = trim($tmp[33]);
//echo $nguoixacnhan;
if (!$limit) {
	$limit = 10000;
}
//echo $loai;
//   var_dump($tmp);
//return;
///++++++++++++++++++++++++++++++++++++++
if (!$curentpage) {
	$curentpage = 1;
}

// echo  $curentpage;

$sql_where = "  WHERE 1 =1   ";
$sql_where2 = "";
$sql_where3 = "";
$sql_ton = " and  (a.luachon = '1' or a.luachon= '2' )";
if ($loai != "") {
	$sql_where .= " and a.luachon ='$loai'";
	$sql_ton .= " and a.luachon ='$loai'";
}
if ($stknh != "") {
	$sql_where .= " and a.sotknh ='$stknh'";
}
if ($tentknh != "") {
	$sql_where .= " and a.tentknh ='$tentknh'";
	$sql_ton .= " and a.tentknh ='$tentknh'";
}
if ($nguoixacnhan != "") {
	if ($nguoixacnhan != 4) {
		//	$sql_where.=" and d.xacnhan = '$nguoixacnhan'";
	} else if ($nguoixacnhan == 4) {
		$sql_where .= " and a.phieuxuat is not null  and a.phieuxuat<> 0";
	}
}

if ($mavd != "") {
	$sql_where .= " and a.mavandon = '$mavd'";
	$sql_ton .= " and a.mavandon = '$mavd'";
}
if ($dvvc != "") {
	$sql_where .= " and a.donvivc = '$dvvc'";
	$sql_ton .= " and a.donvivc = '$dvvc'";
}
//if($ncc != ""){ $sql_where.=" and e.Name like '%$ncc%'"; $sql_ton.=" and e.Name like '%$ncc%'"; }
if ($ngaytaotu != ""  && $ngaytaoden == "") {
	$sql_where .= " and a.ngaytao >='$ngaytaotu'";
	$sql_ton .= " and a.ngaytao < '$ngaytaotu'";
}
//if($ngaytaotu == ""  && $ngaytaoden==""){$sql_ton.=" and a.ngaytao < '1001-01-01'"; }
if ($ngaytaotu != ""  && $ngaytaoden != "") {
	$sql_where .= " and a.ngaytao >='$ngaytaotu' and a.ngaytao <='$ngaytaoden'";
}
//if($phieuxuat != ""){ $sql_where.=" and f.SoCT = '$phieuxuat'";  $sql_ton.=" and f.SoCT = '$phieuxuat'"; }
//if($tkno != ""){ $sql_where.=" and a.tkno = '$manv'"; }
//if($tkco != ""){ $sql_where.=" and c.manv = '$manv'"; }
//if($dinhkhoan != ""){ $sql_where.=" and (d.ma = '$dinhkhoan' or d.ten like '%$dinhkhoan%')"; $sql_ton.=" and (d.ma = '$dinhkhoan' or d.ten like '%$dinhkhoan%')"; }
if ($psno != "") {
	$sql_where .= " and a.psno = '$psno'";
	$sql_ton .= " and a.psno = '$psno'";
}
if ($psco != "") {
	$sql_where .= " and a.psco = '$psco'";
	$sql_ton .= " and a.psco = '$psco'";
}
if ($dongia != "") {
	$sql_where .= " and a.dongia = '$dongia'";
	$sql_ton .= " and a.dongia = '$dongia'";
}
if ($soluong != "") {
	$sql_where .= " and a.soluong = '$soluong'";
	$sql_ton .= " and a.soluong = '$soluong'";
}
if ($dvt != "") {
	$sql_where .= " and a.donvi = '$dvt'";
	$sql_ton .= " and a.donvi = '$dvt'";
}
if ($diengiai != "") {
	$sql_where .= " and a.note = '$diengiai'";
	$sql_ton .= " and a.note = '$diengiai'";
}

//if($manv != ""){ $sql_where.=" and c.manv = '$manv'"; $sql_ton.=" and c.manv = '$manv'"; }
//if($ten != ""){ $sql_where.=" and c.ten = '$ten'"; $sql_ton.=" and c.ten = '$ten'"; }


if ($sotien > 0) {
	$sql_where .= " and a.sotien = '$sotien'";
	$sql_ton .= " and a.sotien = '$sotien'";
}
if ($soct != '') {
	$sql_where .= " and a.sochungtu = '$soct'";
	$sql_ton .= " and a.sochungtu = '$soct'";
}
if ($kho != "") {
	$sql_where .= " and a.loaitk =  '$kho' ";
	$sql_ton .= " and a.loaitk =  '$kho' ";
} else if ($_SESSION["loai_user"] == 16) {
	$sql_where .= " and c.idtinh =  '$kho' ";
	$sql_ton .= " and c.idtinh =  '$kho' ";
}

if ($tkno) {
	$sql_where .= " and a.tkno in ($tkno) ";
	$sql_ton .= " and a.tkno in ($tkno) ";
}

if ($tkco) {
	$sql_where .= " and a.tkco in  ($tkco) ";
	$sql_ton .= " and a.tkco in  ($tkco) ";
}


if ($tinhtrang != "") {
	if ($tinhtrang == 0) {
		$sql_where .= " and a.tinhtrang=0 ";
		$sql_ton .= " and a.tinhtrang=0 ";
	} else if ($tinhtrang == 2) {
		$sql_where .= " and a.tinhtrang=2 ";
		$sql_ton .= " and a.tinhtrang=2 ";
	} else if ($tinhtrang == 3) {
		$sql_where .= " and  a.tinhtrang=3 ";
		$sql_ton .= " and  a.tinhtrang=3 ";
	} else if ($tinhtrang == 4) {
		$sql_where .= " and  a.tinhtrang=4";
		$sql_ton .= " and  a.tinhtrang=4";
	} else if ($tinhtrang == 1) {
		$sql_where .= " and  a.tinhtrang=1";
		$sql_ton .= " and  a.tinhtrang=1";
	} //chưa duyệt cso lyd do
	else if ($tinhtrang == 5) {
		$sql_where .= " and  a.tinhtrang=5";
		$sql_ton .= " and  a.tinhtrang=5";
	} // quan ly duyet
}


if ($tu != "") {
	$ngay =  explode('/', $tu);
	if (strlen($ngay[1]) == 1) {
		$ngay[1] = "0" . $ngay[1];
	}
	if (strlen($ngay[0]) == 1) {
		$ngay[0] = "0" . $ngay[0];
	}
	//$sql_where2 .= " and  p.Ngaytao>= '$ngay[2]-$ngay[1]-$ngay[0]'";
	//$sql_where3 .= " and  aa.NgayTao>= '$ngay[2]-$ngay[1]-$ngay[0]'";
	$sql_where  .= " and  a.ngaythuchi>= '$ngay[2]-$ngay[1]-$ngay[0]'";
	// $sql_ton  .= " and  a.ngaythuchi<'$ngay[2]-$ngay[1]-$ngay[0]'";
	$sql_ton_le  .= " and  a.ngaythuchi<='$ngay[2]-$ngay[1]-$ngay[0]'";
} else {
	//$sql_ton .= " and  a.ngaythuchi < '1001-01-01'";
}

if ($den != "") {
	$ngay =  explode('/', $den);
	if (strlen($ngay[1]) == 1) {
		$ngay[1] = "0" . $ngay[1];
	}
	if (strlen($ngay[0]) == 1) {
		$ngay[0] = "0" . $ngay[0];
	}
	//  $sql_where2 .= " and  p.Ngaytao<= '$ngay[2]-$ngay[1]-$ngay[0] 23:59'";
	//   $sql_where3 .= " and  aa.NgayTao<= '$ngay[2]-$ngay[1]-$ngay[0] 23:59'";
	$sql_where  .= " and  a.ngaythuchi<= '$ngay[2]-$ngay[1]-$ngay[0] 23:59'";
}

if ($loc != "") {
	switch ($loc) {
		case 1:
			$sql_where .= " and (a.hdbh is not null and a.hdbh <>'')";
			$sql_ton .= " and (a.hdbh is not null and a.hdbh <>'')";
			break;
		case 2:
			$sql_where .= " and (a.sotknh is not null and a.sotknh<> 0)";
			$sql_ton .= " and (a.sotknh is not null and a.sotknh<> 0)";
			break;
		case 3:
			$sql_where .= " and (a.tentknh is not null and a.tentknh <>'')";
			$sql_ton .= " and (a.tentknh is not null and a.tentknh <>'')";
			break;
		case 4:

			$sql_where .= " and a.mavandon is not null";
			$sql_ton .= " and a.mavandon is not null";
			break;
		case 5:
			$sql_where .= " and a.donvivc is not null";
			$sql_ton .= " and a.donvivc is not null";
			break;
		case 6:
			$sql_where .= " and a.mavandon REGEXP '^[0-9]+$'";
			$sql_ton .= " and a.mavandon REGEXP '^[0-9]+$'";
			break;
		case 7:
			$sql_where .= " and a.mavandon REGEXP '^[0-9]+$'";
			$sql_ton .= " and a.mavandon REGEXP '^[0-9]+$'";
			break;
		case 8:
			$sql_where .= " and (a.NCC is not null and a.NCC <> '')";
			$sql_ton .= " and (a.NCC is not null and a.NCC <> '')";
			break;
		case 9:
			$sql_where .= " and (a.manv is not null and a.manv <> '')";
			$sql_ton .= " and (a.manv is not null and a.manv <> '')";
			break;
		case 10:
			$sql_where .= " and a.phieuxuat is not null  and a.phieuxuat<> 0";
			$sql_ton .= " and a.phieuxuat is not null  and a.phieuxuat<> 0";
			break;
		case 11:
			$sql_where .= " and a.tkno is not null  and a.tkno <> 0";
			$sql_ton .= " and a.tkno is not null  and a.tkno <> 0";
			break;
		case 12:
			$sql_where .= " and a.tkco is not null  and a.tkco <> 0";
			$sql_ton .= " and a.tkco is not null  and a.tkco <> 0";
			break;
		default:
			break;
	}
}

$mangtk = taomang("dinhkhoan", "ID", "madinhkhoan");
// $mangcuahang= taomang("cuahang","ID","macuahang",'') ;


//a.tinhtrang=1
$_SESSION["truyvancu2"] = $sql2;
//echo $sql2 ;
if ($_SESSION["admintuan"])	echo "<br>" . $sql2;


//echo $sql_tienle;
//====Xử lý tử đây====

// $sql_rows = "SELECT sum(case when  a.luachon = 1 then round(a.psno) else (round(a.psco)) end ) as tongtienbanhang,a.loaitk,b.Name,b.macuahang,a.ngaythuchi FROM thuchikt a left join cuahang b on a.loaitk=b.id  
// 	" . $sql_where . "  and  IDCha in (select ID from dinhkhoanthuchi where ma='DTBH' or ma='DTBH') group by a.ngaythuchi,a.loaitk ORDER BY a.ngaythuchi,b.ID desc";

$limit = 20;
$start = ($curentpage - 1) * $limit;

$sql = 'SELECT sum(case when  a.luachon = 1 then round(a.psno) else (round(a.psco)) end ) as tongtien,
a.ngaythuchi, a.IDcha, d.madinhkhoan, c.ma, a.lydo, a.sotknh FROM thuchikt a 
left join cuahang b on a.loaitk=b.id 
left join dinhkhoanthuchi c on a.IDcha = c.ID 
left join dinhkhoan d on a.tkno = d.ID
where a.loaitk = 1130 
and (c.ma="CTTNCC" or c.ma="DTBH" or d.madinhkhoan in(111,1111) or d.madinhkhoan = 112 ) 
and (a.ngaythuchi between "2022-04-01" and "2022-04-30") 
group by a.ngaythuchi,a.loaitk, a.IDcha, a.tkno ORDER BY a.ngaythuchi,b.ID, a.IDcha desc';

if ($_SESSION["LoginID"] == 7576) {
	echo $sql;
}
//echo $sql;
if ($_SESSION['admintuan']) echo $sql;
//	$query_rows = $data->query($sql);
// $result_rows = $data->query($sql_rows);
// $numrow = $data->num_rows($result_rows);
// $totalpage = ceil($numrow / $limit);
// $chuoiphantrang = ' <div class="pagi"> <ul id="pagination">
// 		 <li><button value="F" onclick="phantrangAjax(1,2)">Đầu</button></li>
//     <li><button value="-1" onclick="phantrangAjax(this.value,2)">«</button></li>';
// $min = 1;
// $max = 20;
// $buocnhay = 3;
// if ($totalpage > $max) {
// 	if ($curentpage - $buocnhay < $min || ($curentpage < $max - $buocnhay &&  $curentpage > $min)) {
// 		$min = 1;
// 		$max = 20;
// 	} else if ($curentpage >= $max - $buocnhay && $curentpage < $totalpage && ($curentpage + $buocnhay) <= $totalpage) {

// 		$max = $curentpage + $buocnhay;
// 		$min = $curentpage - ($limit - $buocnhay);
// 	} else if ($curentpage >= $totalpage || ($curentpage + $buocnhay) >= $totalpage) {

// 		$max = $totalpage;
// 		$min = $max - ($totalpage - $buocnhay);
// 	} else {

// 		$min += $buocnhay;
// 		$max += $buocnhay;
// 	}
// } else {
// 	$min = 1;
// 	$max = $totalpage;
// }
// for ($i = $min; $i <= $max; $i++) {
// 	$mau = '';
// 	if ($curentpage == $i) {
// 		$mau = "red";
// 	}
// 	$chuoiphantrang .= '<li><button value="' . $i . '" onclick="phantrangAjax(this.value,2)" style="background-color:' . $mau . '">' . $i . '</button></li>';
// }
// $chuoiphantrang .= '  <li><button value="-2" onclick="phantrangAjax(this.value,2)">»</button></li>
//   <li><button value="F" onclick="phantrangAjax(' . $totalpage . ',2)">Cuối</button></li>
//   	</ul> </div>
//   </div>';

$mangrows = [];
$mang = [];
$result = $data->query($sql);
while ($rows = $data->fetch_array($result)) {
	if (array_key_exists($rows['ngaythuchi'], $mangrows)) {
		
		if ($rows['ma'] == 'DTBH') {
			$key = "doanhthu";
			$giatritruoc = empty($mangrows[$rows['ngaythuchi']][$key][1]) ? 0 : $mangrows[$rows['ngaythuchi']][$key][1];
			$tongtien = $rows['tongtien'] + $giatritruoc;
			$arrval = array($rows['ngaythuchi'], $rows['tongtien']);
		} else if ($rows['ma'] == "CTTNCC") {
			$key = "nhacc";
			$giatritruoc = empty($mangrows[$rows['ngaythuchi']][$key][1]) ? 0 : $mangrows[$rows['ngaythuchi']][$key][1];
			$tongtien = $rows['tongtien'] + $giatritruoc;
			$arrval = array($rows['NCC'], $tongtien);
		} else {
			if ($rows['madinhkhoan'] == 111 || $rows['madinhkhoan'] == 1111) {
				$key = "tienmat";
				$giatritruoc = empty($mangrows[$rows['ngaythuchi']][$key][1]) ? 0 : $mangrows[$rows['ngaythuchi']][$key][1];
				$tongtien = $rows['tongtien'] + $giatritruoc;
				$arrval = array($rows['lydo'], $tongtien);
			} else {
				$key = "chuyenkhoan";
				$giatritruoc = empty($mangrows[$rows['ngaythuchi']][$key][1]) ? 0 : $mangrows[$rows['ngaythuchi']][$key][1];
				$tongtien = $rows['tongtien'] + $giatritruoc;
				$arrval = array($rows['sotknh'], $tongtien);
			}
		}
		$mangrows[$rows['ngaythuchi']][$key] = $arrval;
	} else {
		if ($rows['ma'] == 'DTBH') {
			$arrval = array($rows['ngaythuchi'], $rows['tongtien']);
			$key = "doanhthu";
		} else if ($rows['ma'] == "CTTNCC") {
			$arrval = array($rows['NCC'], $rows['tongtien']);
			$key = "nhacc";
		} else {
			if ($rows['madinhkhoan'] == 111 || $rows['madinhkhoan'] == 1111) {
				$arrval = array($rows['lydo'], $rows['tongtien']);
				$key = "tienmat";
			} else {
				$arrval = array($rows['sotknh'], $rows["tongtien"]);
				$key = "chuyenkhoan";
			}
		}
		$mangrows[$rows['ngaythuchi']][$key] = $arrval;
	}
}


$sql = 'Select sum(case when  a.luachon = 1 then round(a.psno) else (round(a.psco)) end ) as tongtien,
a.ngaythuchi, a.loaitk
FROM thuchikt a
left join cuahang b on a.loaitk=b.id 
left join dinhkhoanthuchi c on a.IDcha = c.ID 
left join dinhkhoan d
on a.tkno = d.ID
where a.loaitk = 1130 
and (c.ma <> "CTTNCC" and c.ma <> "DTBH" and d.madinhkhoan not in(111,1111) and d.madinhkhoan <> 112 )
and (a.ngaythuchi between "2022-04-01" and "2022-04-30") 
group by a.ngaythuchi,a.loaitk ORDER BY a.ngaythuchi,b.ID, a.IDcha desc';

$result = $data->query($sql);
while ($rows = $data->fetch_array($result)) {
	if (key_exists($rows['ngaythuchi'], $mangrows)) {
		$mangrows[$rows['ngaythuchi']]['chikhac'] = $rows['tongtien'];
	}
}

if ($_SESSION["admintuan"])	echo  $sql;

// echo  "Chờ tí nhé. đang chỉnh lại báo cáo tỉ lệ";  return ;

// echo "<pre>";
// var_dump($mangrows);
// echo "</pre>";

//==============================================================	
//$mangnhanvien =taomang("userac","ID","ten"," where tinhluong = '1'  ") ;
?>
<style>
	.fixed-bottom {
		position: -webkit-sticky;
		position: sticky;
		bottom: 0;
	}

	.fixed-top {
		position: -webkit-sticky;
		position: sticky;
		top: 0;
	}

	.fixed-left {
		/* position: -webkit-sticky;
	  position: sticky;
	  z-index:1;
	  width:200px;*/
	}

	.td-fixed {
		left: 0px;

		z-index: 1;
		height: 25px;
	}

	.fixed-top1 {
		position: -webkit-sticky;
		position: sticky;
		top: 0;
	}

	.tbchuan th {
		height: auto;
		padding: 0.8em;
		overflow: hidden;
		font-size: 14px;
		white-space: pre-wrap;
		background-color: #F8E4CB !important;
		color: #000000;
	}

	.td_l {
		height: 100%;
		width: 170px;
		display: flex;
		align-items: center;
		overflow: ;
		white-space: ;
	}

	@media all and (min-width: 1280px) {

		.td_l {
			height: 100%;
			max-width: 100px;
			display: flex;
			align-items: center;
			overflow: ;
			white-space: ;
		}
	}

	@media all and (min-width: 1366px) {

		.td_l {
			height: 100%;
			max-width: 150px;
			display: flex;
			align-items: center;
			overflow: ;
			white-space: ;
		}
	}

	@media all and (min-width: 1440px) {

		.td_l {
			height: 100%;
			max-width: 180px;
			display: flex;
			align-items: center;
			overflow: ;
			white-space: ;
		}
	}

	@media all and (min-width: 1600px) {

		.td_l {
			height: 100%;
			max-width: 180px;
			display: flex;
			align-items: center;
			overflow: ;
			white-space: ;
		}
	}

	@media all and (min-width: 1920px) {}

	@media all and (min-width: 2560px) {

		.td_l {
			height: 100%;
			max-width: 500px;
			display: flex;
			align-items: center;
			overflow: ;
			white-space: ;
		}
	}

	#pagination {
		display: flex;
		align-items: center;
		justify-content: center;
	}

	#pagination li {
		list-style-type: none
	}

	#pagination li button {
		width: 30px;
		height: 30px;
		background-color: #03a9f4;
		border: none;
		border-radius: 5px;
		color: #ffffff;
		margin-left: 0.5em;
	}

	th,
	td {
		text-align: center;
	}
</style>

<div style="padding-bottom:5px;text-align:center"><span style="color:red"> Chữ màu đỏ các khoản chi,</span><span style="color:blue"> chữ màu xanh các khoản thu</span> </div>
<input type="hidden" name="totalpage" id="totalpage" value="<?php echo $totalpage; ?>" />
<div id="wrap_kq" style="display:flex;flex-direction: column;">
	<div style="" id="showtb">
		<div class="table_left" style="width:auto;position: -webkit-sticky;
	  position: sticky;left:0;z-index:1;    height: 480px;overflow:scroll">
			<table border="0" cellpadding="0" cellspacing="0" class="tbchuan table_bc" id="dopcccc" style="width:100%;border-collapse:collapse">
				<tr>
					<th colspan="2">Doanh Thu Tự Động Phần Mềm</th>
					<th colspan="2">Thanh toán NCC (331)</th>
					<th colspan="2">Tiền mặt (111)</th>
					<th colspan="2">Chuyển khoản (112)</th>
					<th>Chi khác</th>
					<th rowspan="2">Tồn Quỹ</th>
				</tr>
				<tr>
					<th>Ngày</th>
					<th>Số tiền</th>
					<th>Tên NCC</th>
					<th>Số tiền</th>
					<th>Nội dung</th>
					<th>Số tiền</th>
					<th>TK nhận tiền</th>
					<th>Số tiền</th>
					<th>Tổng nợ phát sinh (chi còn lại ngoài 3TK 331,111,112)</th>
				</tr>
				<?php
				// Mở thẻ Php
				$tongtmdk = 0;
				foreach ($mangrows as $key => $value) {

					$sql2 = "SELECT sum(case when  a.luachon = 1 then round(a.psno) else -(round(a.psco)) end )as tong,a.loaitk FROM thuchikt a left join cuahang b on a.loaitk=b.id  
					where  a.IDcha not in (select ID from dinhkhoanthuchi where ma='TLDK' or ma='TL') and a.ngaythuchi<'".$value["doanhthu"][0]."' and a.loaitk='1130' group by a.loaitk";

					$dongtam = getdong($sql2);
					$tongdk = $dongtam['tong'] ? $dongtam['tong'] : 0;
					$tongtmdk = ($tongdk > 0 || $tongdk < 0) ? round($tongdk) : 0;
				?>

					<tr>
						<td> <?php echo $value['doanhthu'][0]; ?></td>
						<td> <?php echo number_format($value['doanhthu'][1]); ?></td>
						<td> <?php echo $value['nhacc'][0]; ?></td>
						<td> <?php echo number_format($value['nhacc'][1]); ?></td>
						<td> <?php echo $value['tienmat'][0]; ?></td>
						<td> <?php echo number_format($value['tienmat'][1]); ?></td>
						<td> <?php echo $value['chuyenkhoan'][0]; ?></td>
						<td> <?php echo number_format($value['chuyenkhoan'][1]); ?></td>
						<td> <?php echo number_format($value['chikhac']); ?></td>
						<td> <?php echo number_format($tongtmdk); ?></td>

					</tr>

				<?php
					// Mở thẻ Php
				} // đóng vòng lặp
				?>

			</table>
		</div>

	</div>
	<?php echo $chuoiphantrang;

	?>





</div>


<?php
$data->closedata();

function gettennv($table, $ID, $cot)
{
	global $data;
	$sql = "select ID,$cot from $table where  MaNV='$ID' ";

	$result = $data->query($sql);
	$row = $data->fetch_array($result);
	// echo  $sql ;			
	return $row[$cot];
}

function checkLoaiMaVD($ma)
{

	if (is_numeric($ma)) {
		return 1; //viettel
	} else if (substr($ma, (strlen($ma) - 2), 2) == 'VN') {
		return 2; //Bưu điện
	} else if ($ma[0] == 'S') {
		return 3; //GHTK
	}
}


function checksotienhoadon($soct)
{

	$sql = "select sum(DonGia) as tongtiendg,Round(sum((DonGia-(DonGia*chietkhau/100))*SoLuong)-b.tigia) as thanhtien 
from xuatbanhang a left join phieunhapxuat b on a.IDphieu=b.ID where b.SoCT='$soct' group by a.IDphieu ";
	global $data;
	$dong = getdong($sql);
	if ($dong['tongtiendg']) {
		return $dong;
	} else {
		return false;
	}
}


function checkhoadonthuongduyet($hdbh)
{

	$sql = "select a.IDHD as idhd,a.sotien as tienthuong from thuonghoadon a left join phieunhapxuat b on a.IDHD=b.ID where b.SoCT='$hdbh' and right(tinhtrang,1)=4";

	global $data;
	$dong = getdong($sql);
	if ($dong['idhd']) {
		return $dong;
	} else {
		return false;
	}
}
?>