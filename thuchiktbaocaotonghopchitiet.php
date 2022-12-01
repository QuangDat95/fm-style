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



$sql_rows = "SELECT  sum(round(a.psco))as tongpsco,sum(round(a.psno))as tongpsno,a.loaitk,b.Name,b.macuahang,a.ngaythuchi FROM thuchikt a left join cuahang b on a.loaitk=b.id  
	" . $sql_where . "  and  IDCha not in (select ID from dinhkhoanthuchi where ma='TL' or ma='TLDK') group by a.ngaythuchi,a.loaitk ORDER BY a.ngaythuchi,b.ID desc";

//$limit=20;
$start = ($curentpage - 1) * $limit;

$sql = "SELECT  sum(round(a.psco))as tongpsco,sum(round(a.psno))as tongpsno,a.loaitk,b.Name,b.macuahang,DATE_SUB(a.ngaythuchi, INTERVAL 1 DAY) as ngaythuchi,a.ngaythuchi as ngaythuchiht FROM thuchikt a left join cuahang b on a.loaitk=b.id  
	" . $sql_where . " and IDCha  not in (select ID from dinhkhoanthuchi where  ma='TL' or ma='TLDK') group by a.ngaythuchi,a.loaitk ORDER BY a.ngaythuchi,b.ID desc limit $start,$limit";
// var_dump($sql);
if ($_SESSION["LoginID"] == 7576) {
	echo $sql;
}
//echo $sql;
if ($_SESSION['admintuan']) echo $sql;
//	$query_rows = $data->query($sql);
$result_rows = $data->query($sql_rows);
$numrow = $data->num_rows($result_rows);
$totalpage = ceil($numrow / $limit);
$chuoiphantrang = ' <div class="pagi"> <ul id="pagination">
		 <li><button value="F" onclick="phantrangAjax(1,2)">Đầu</button></li>
    <li><button value="-1" onclick="phantrangAjax(this.value,2)">«</button></li>';
$min = 1;
$max = 20;
$buocnhay = 3;
if ($totalpage > $max) {
	if ($curentpage - $buocnhay < $min || ($curentpage < $max - $buocnhay &&  $curentpage > $min)) {
		$min = 1;
		$max = 20;
	} else if ($curentpage >= $max - $buocnhay && $curentpage < $totalpage && ($curentpage + $buocnhay) <= $totalpage) {

		$max = $curentpage + $buocnhay;
		$min = $curentpage - ($limit - $buocnhay);
	} else if ($curentpage >= $totalpage || ($curentpage + $buocnhay) >= $totalpage) {

		$max = $totalpage;
		$min = $max - ($totalpage - $buocnhay);
	} else {

		$min += $buocnhay;
		$max += $buocnhay;
	}
} else {
	$min = 1;
	$max = $totalpage;
}

for ($i = $min; $i <= $max; $i++) {
	$mau = '';
	if ($curentpage == $i) {
		$mau = "red";
	}
	$chuoiphantrang .= '<li><button value="' . $i . '" onclick="phantrangAjax(this.value,2)" style="background-color:' . $mau . '">' . $i . '</button></li>';
}


$chuoiphantrang .= '  <li><button value="-2" onclick="phantrangAjax(this.value,2)">»</button></li>
  <li><button value="F" onclick="phantrangAjax(' . $totalpage . ',2)">Cuối</button></li>
  	<li><input type="button" onclick="xuatexel(7)" name="search3" style="height:30px;margin-left:5px" id="search3" value="Excel Tổng hợp chi tiết" /></li>
  </ul> </div>
  </div>';


$result = $data->query($sql);


if ($_SESSION["admintuan"])	echo  $sql;

// echo  "Chờ tí nhé. đang chỉnh lại báo cáo tỉ lệ";  return ;


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
</style>

<div style="padding-bottom:5px;text-align:center"><span style="color:red"> Chữ màu đỏ các khoản chi,</span><span style="color:blue"> chữ màu xanh các khoản thu</span> </div>
<input type="hidden" name="totalpage" id="totalpage" value="<?php echo $totalpage; ?>" />
<div id="wrap_kq" style="display:flex;flex-direction: column;">
	<div style="" id="showtb">

		<div class="table_left" style="width:auto;position: -webkit-sticky;
	  position: sticky;left:0;z-index:1;    height: 480px;overflow:scroll">

			<table border="0" cellpadding="0" cellspacing="0" class="tbchuan table_bc" id="dopcccc" style="width:100%;border-collapse:collapse">
				<tr align="center" bgcolor="#F8E4CB" class="fixed-top1">
					<th width="68" height="23" valign="middle">
						<strong>STT</strong>
					</th>
					<th width="100px" height="23" valign="middle">
						<strong>Ngày thu chi</strong>
					</th>
					<th width="146" valign="middle"><strong>Mã cửa hàng</strong></th>
					<th width="304" valign="middle"><strong>Tên cửa hàng</strong></th>
					<th valign="middle" cellpadding="0" cellspacing="0" colspan="2" style="white-space:unset !important; padding:0;border-collapse:collapse">
						<table cellpadding="0" cellspacing="0" style="margin:0;padding:0;width:100%;text-align:center;">
							<thead>
								<th colspan="2" style="text-align:center">Số DCK</th>
							</thead>
							<tbody>
								<td valign="middle" align="center" width="50%">
									TM
								</td>
								<td valign="middle" align="center" width="50%">
									TL
								</td>
							</tbody>
						</table>
					</th>
					<th width="186" valign="middle"><strong>PS Nợ</strong></th>

					<th width="153" valign="middle"><strong>PS Có</strong></th>
					<th valign="middle" colspan="2" cellpadding="0" cellspacing="0" style="white-space:unset !important; padding:0">

						<table cellpadding="0" cellspacing="0" style="margin:0;padding:0;width:100%;text-align:center;border-collapse:collapse">
							<thead>
								<th colspan="2" style="text-align:center">Số DCK</th>
							</thead>
							<tbody>
								<td valign="middle" align="center" width="50%">
									TM
								</td>
								<td valign="middle" align="center" width="50%">
									TL
								</td>
							</tbody>
						</table>
					</th>

				</tr>
				<?php
				$tongpsco = 0;
				$tongpno = 0;
				$tongtldk = 0;
				$tongtlck = 0;
				$tongtmdk = 0;
				$tongtmck = 0;


				$tldaucuoi = 0;
				while ($re = $data->fetch_array($result)) {
					$r++;

					$tongpsco += $re["tongpsco"];
					$tongpno += $re["tongpsno"];

					$tongdk = 0;
					$sql2 = "SELECT  sum(case when  a.luachon = 1 then round(a.psno) else -(round(a.psco)) end )as tong,a.loaitk FROM thuchikt a left join cuahang b on a.loaitk=b.id  
	where  a.IDcha not in (select ID from dinhkhoanthuchi where (ma='TLDK' or ma='TL')) and a.ngaythuchi<'$re[ngaythuchiht]' and a.loaitk='$re[loaitk]' group by a.loaitk";
					//echo $sql2;
					$dongtam = getdong($sql2);
					$tongdk = $dongtam['tong'] ? $dongtam['tong'] : 0;
					$tongck = $tongdk + ($re["tongpsno"] - $re["tongpsco"]);

					$tongtmdk += ($tongdk > 0 || $tongdk < 0) ? round($tongdk) : 0;
					$tongtmck += ($tongck > 0 || $tongck < 0) ? round($tongck) : 0;
					///=========tiền lẻ đầu kì=========
					$tienledk = 0;
					$sql_tienle = "SELECT   sum(case when  a.luachon = 1 then round(a.psno) else -(round(a.psco)) end )as tong,a.loaitk,a.ngaythuchi from thuchikt a where a.ngaythuchi< '$re[ngaythuchi]' and  a.IDcha  in (select ID from dinhkhoanthuchi where (ma='TLDK' or ma='TL')) and a.loaitk='$re[loaitk]' group by a.loaitk";
					$dong = getdong($sql_tienle);

					$tienledk = $dong['tong'] ? $dong['tong'] : 0;

					//$tongtldk+=$tienledk;


					///=========tiền lẻ trư=========
					$tienleck = 0;
					$sql_tienleck = "SELECT   sum(round(a.psno))as lethu,sum(round(a.psco))as lechi,a.loaitk from thuchikt a where ngaythuchi='$re[ngaythuchi]' and a.IDcha  in (select ID from dinhkhoanthuchi where (ma='TL')) and a.loaitk='$re[loaitk]' group by a.loaitk";
					$dong = getdong($sql_tienleck);
					$tienleckthu = $dong['lethu'] ? $dong['lethu'] : 0;
					$tienleckchi = $dong['lechi'] ? $dong['lechi'] : 0;
					$tienleck = ($tienleckthu - $tienleckchi) + $tienledk;


					//	echo 
					/* $tongtldk+=$mangTLCH[$re["loaitk"]];
		 $tongtlck+=(($mangTLTRu[$re["loaitk"]]["lethu"]-$mangTLTRu[$re["loaitk"]]["lechi"])+$mangTLCH[$re["loaitk"]]);
		  $tongtmdk+=$mangTongdk[$re["loaitk"]];
		   $tongtmck+=($mangTongdk[$re["loaitk"]]-$re["tongpsco"]+$re["tongpsno"]);*/
					//echo $mangTLTRu[$re["loaitk"]]["lechi"];
					//  echo $re["macuahang"];
					$lydoN = '';

					if ($mau == "white") {
						$mau = "#EEEEEE";
						$hl = "Normal4";
						$hl2 = "Highlight4";
					} else {
						$mau = "white";
						$hl = "Normal5";
						$hl2 = "Highlight5";
					}

				?>
					<!--onmouseout="this.className='-->
					<tr class="tb_tr tb_tr<?= $re["idthuchikt"] ?>" data-id="<?= $re["idthuchikt"] ?>" bgcolor="<?php echo $mau; ?>" style="color:<?= $mauchu ?>">
						<td><?php echo $r;  ?></td>
						<td><?php echo $re["ngaythuchiht"];  ?></td>
						<td><?php echo $re["macuahang"];  ?></td>
						<td><?php echo $re["Name"];  ?></td>
						<td width="150px"><?php echo number_format(($tongdk > 0 || $tongdk < 0) ? round($tongdk) : 0);  ?></td>
						<td width="150px"><?php echo number_format($tienledk);  ?></td>
						<td><?php echo number_format($re["tongpsno"]); ?></td>
						<td><?php echo number_format($re["tongpsco"]); ?></td>
						<td width="150px"><?php echo number_format(($tongck > 0 || $tongck < 0) ? round($tongck) : 0); ?></td>
						<td width="150px"><?php echo number_format($tienleck); ?></td>
					</tr>
				<?php

				}
				?>
				<tr style="color:#FF0000;font-weight:bold;position:sticky;    bottom: -1px;
    background-color: antiquewhite;">
					<td colspan="4">Tổng</td>

					<td><?php echo number_format($tongtmdk); ?></td>
					<td><?php echo number_format($tienledk); ?></td>
					<td><?php echo number_format($tongpno); ?></td>
					<td><?php echo number_format($tongpsco); ?></td>
					<td><?php echo number_format($tongtmck); ?></td>
					<td><?php echo number_format($tienleck); ?></td>
				</tr>
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