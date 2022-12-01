<?php
session_start();
$ngaychan = gmdate('Y-m-d H:i:s', time() + 7 * 3600);
$quyen = $_SESSION["quyen"];
$ql = $quyen[$_SESSION["mangquyenid"]["thongtinkho"]];
if ($ql[0] != 1 && (strtotime("now") < strtotime("2021-02-08"))) {
	return;
}

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

$data1 = $_POST['DATA'];
$tmp = explode('*@!', $data1);

$ten   =  ($tmp[0]);
$ma = trim($tmp[1]);
$nhom = laso($tmp[2]);
$kho = trim($tmp[3]);
$tu = trim($tmp[4]);
$den = trim($tmp[5]);
$IDNV = laso($tmp[6]);

$trang = laso($tmp[7]);
$loai = laso($tmp[8]);
$nangcao =  ($tmp[9]);
$mota =  chonghack($tmp[10]);
$tim = laso($tmp[11]);
$nganhhang = laso($tmp[12]);

$ncc =  laso($tmp[13]);
$ghichu =  chonghack($tmp[14]);
$tinhtrang =  chonghack($tmp[15]);
$tucuoi =  trim($tmp[16]);
$dencuoi =  trim($tmp[17]);

$sql_where = " where a.Loai  in (1,3,5)  and a.dakhoa = 1 ";
$sql_wherev = 'where a.dakhoa = 1  ';
if ($nganhhang > 0)  $sql_where .= " and c.IDnhom = '" . $nganhhang . "'";

if ($IDNV == 1)  $IDNV = 0;;


if ($loai == 1) {
	$sql_where .= " and (b.DonGia*(1-1*b.chietkhau/100)) <> c.price ";
}
if ($loai == 2) {
	$sql_where .= " and (b.DonGia*(1-1*b.chietkhau/100)) = c.price ";
}
if ($loai == 3) {
	$sql_where .= " and  a.tigia  >0 ";
}
if ($loai == 4) {
	$sql_where .= " and  a.idnhacc  >1 ";
}
if ($loai == -5) {
	$sql_where .= " and  a.idnhacc  =1 ";
}
if ($loai > 9 || $loai == 5) {
	$sql_where .= " and  a.lydo =$loai ";
	$sql_wherev .= " and a.lydo ='" . $loai . "'";
}
if ($loai == -6) {
	$sql_where .= " and ( a.lydo =53 or a.lydo =56  or  a.lydo =61   or  a.lydo =62   or  a.lydo =49)  ";
	$sql_wherev .= " and ( a.lydo =53 or a.lydo =56  or  a.lydo =61   or  a.lydo =62   or  a.lydo =49)  ";
}   // tong shopee
if ($loai == -7) {
	$sql_where .= " and ( a.lydo =46 or  a.lydo =47  or  a.lydo =48   or  a.lydo =52 or a.lydo =55    )  ";
	$sql_wherev .= " and ( a.lydo =46 or  a.lydo =47  or  a.lydo =48   or  a.lydo =52 or a.lydo =55 )  ";
}   // tong team 1,2,3,7,kids
if ($loai == -8) {
	$sql_where .= " and  a.idgioithieu  >0 ";
}  // taget
if ($loai == -9) {
	$sql_where .= " and  a.lydo  >44 ";
}  //  
if ($loai == -11) {
	$sql_where .= " and  a.idkho = 1105";
}  // 
if ($loai == -12) {
	$sql_where .= " and  a.idkho=  1137";
}
if ($loai == -13) {
	$sql_where .= " and (a.idkho=1137 or a.idkho=1105) ";
}
if ($loai == -3) {
	$sql_where .= " and  a.nguoisua=-2";
}  // bill tra
if ($loai == -10) {
	$sql_where .= " and  a.lydo  >44 and a.loai=3 ";
}
if ($ghichu != "")	$sql_where .= " and (a.ghichu like '%" . $ghichu . "%' or  b.GhiChu like '%" . $ghichu . "%' )";

if ($nangcao == "true") {
	if ($ten != "") 	$sql_where .= " and c.Name like '" . $ten . "%'";
	if ($ma != "")	    $sql_where .= " and c.codepro like '" . $ma . "%'";
} else {
	if ($ten != "")	$sql_where .= " and c.Name  like '" . $ten . "%'";
	if ($ma != "")	$sql_where .= " and c.codepro like '" . $ma . "%'";
}

if ($nhom > 0) {
	$nhom = $nhom . timnhom("groupproduct", "IDGroup", $nhom);
	$sql_where .= " and  c.IDGroup in ( $nhom ) ";
}

if ($tinhtrang == 1) {
	$sql_where .= " and (v.dongthoigiantrangthaidon =1   ) ";
} elseif ($tinhtrang == 2) {
	$sql_where .= " and (v.mavd='' or v.mavd is null ) and a.loai<>3";
} elseif ($tinhtrang == 3) {
	$sql_where .= " and (v.dongthoigiantrangthaidon is null or v.dongthoigiantrangthaidon =''  ) and a.loai<>3";
} elseif ($tinhtrang == 4) {
	$sql_where .= " and  v.loai=8 and a.loai<>3  and  v.dongthoigiantrangthaidon='' ";
} elseif ($tinhtrang != "" && $tinhtrang != "0") {
	$sql_where .= " and v.dongthoigiantrangthaidon = $tinhtrang ";
} elseif ($tinhtrang == "0") {
	$sql_where .= " and v.dongthoigiantrangthaidon <>1 and v.dongthoigiantrangthaidon <> 8 and  a.loai<>3    ";
}



if ($mota != "") {
	$sql_where .= " and c.NameN like '" . $mota . "%'";
}
if ($kho == 0)  $kho = '';
$idkho = $_SESSION["se_kho"];
if (!($idk == 1 ||  $ql[5] || $_SESSION["loai_user"] == 16))   // nv thường
{
	$sql_where .= " and a.IDKho ='" . $idkho . "'";
	$sql_wherev .= " and a.IDKho ='" . $idkho . "'";
} elseif ($_SESSION["loai_user"] == 16 && $kho == '') {
	$sql_where .= " and ch.IDtinh ='" . $idkho . "'";
	$sql_wherev .= " and ch.IDtinh ='" . $idkho . "'";
} elseif ($kho != "") {
	$sql_where .= " and a.IDKho ='" . $kho . "'";
	$sql_wherev .= " and a.IDKho ='" . $kho . "'";
}
// ==========================================ngoai le

// ==========================================ngoai le
if ($ncc > 0)	$sql_where .= " and c.congtho ='" . $ncc . "'";
if ($IDNV != "0") {
	$sql_where .= " and (a.IDTao = $IDNV  or a.diachiN='$IDNV' or a.idchol='$IDNV')";
	$sql_wherev .= " and (a.IDTao = $IDNV  or a.diachiN='$IDNV' or a.idchol='$IDNV')";
}

$th =   gmdate('n', time() + 7 * 3600);
$ng =   gmdate('d', time() + 7 * 3600);
$na = gmdate('Y', time() + 7 * 3600);
if ($th < 3) $th = $th + 12;
if ($tu == "")   $tu = gmdate('01/n/Y', time() + 7 * 3600 - 60 * 24 * 3600);

$sql_where9 = " ";

if ($tu != "") {
	$ngay =  explode('/', $tu);
	//      if (($ngay[1]+2)<($th)) {$ngay[1]= $th-2 ;	  if (($ngay[1]+2)<($th)) $ngay[0]= '01' ; if($th>12) $ngay[2]=$ngay[2]-1;}
	if ($na != $ngay[2]) {
		//  if (($ngay[1]+2)<($th)) {$ngay[1]= $th-2 ;}
	}
	if (strlen($ngay[1]) == 1) {
		$ngay[1] = "0" . $ngay[1];
	}
	if (strlen($ngay[0]) == 1) {
		$ngay[0] = "0" . $ngay[0];
	}
	$sql_where .= " and  NgayNhap >= '$ngay[2]-$ngay[1]-$ngay[0]'";
	$sql_where9 .= " and  p.ngaythuchi >= '$ngay[2]-$ngay[1]-$ngay[0]'";

	$sql_wherev .= " and  NgayNhap >= '$ngay[2]-$ngay[1]-$ngay[0]'";
	$tu = "  '$ngay[2]-$ngay[1]-$ngay[0]' ";
}
if ($den != "") {
	$ngay =  explode('/', $den);
	if (strlen($ngay[1]) == 1) {
		$ngay[1] = "0" . $ngay[1];
	}
	if (strlen($ngay[0]) == 1) {
		$ngay[0] = "0" . $ngay[0];
	}
	$sql_where .= " and  NgayNhap <= '$ngay[2]-$ngay[1]-$ngay[0]'";
	$sql_wherev .= " and  NgayNhap <= '$ngay[2]-$ngay[1]-$ngay[0]'";
	$sql_where9 .= " and  p.ngaythuchi <= '$ngay[2]-$ngay[1]-$ngay[0]'";
	$den = "  '$ngay[2]-$ngay[1]-$ngay[0] 23:59' ";
}

if ($tucuoi != "") {
	$ngay =  explode('/', $tucuoi);
	//      if (($ngay[1]+2)<($th)) {$ngay[1]= $th-2 ;	  if (($ngay[1]+2)<($th)) $ngay[0]= '01' ; if($th>12) $ngay[2]=$ngay[2]-1;}

	if (strlen($ngay[1]) == 1) {
		$ngay[1] = "0" . $ngay[1];
	}
	if (strlen($ngay[0]) == 1) {
		$ngay[0] = "0" . $ngay[0];
	}
	$tucuoi = "  '$ngay[2]-$ngay[1]-$ngay[0]' ";
}
if ($dencuoi != "") {
	$ngay =  explode('/', $dencuoi);
	if (strlen($ngay[1]) == 1) {
		$ngay[1] = "0" . $ngay[1];
	}
	if (strlen($ngay[0]) == 1) {
		$ngay[0] = "0" . $ngay[0];
	}
	$dencuoi = " '$ngay[2]-$ngay[1]-$ngay[0]' ";
}



$r = 1;

// $sql = "SELECT * FROM products ".$sql_where." ORDER BY NgayTao desc  ";IDSP``SoLuong``DonGia``LoaiTien``Thue``BaoHanh``GhiChu``Loai` 


if ($tim == 1) {
	$s1 = " sum(ceil(b.DonGia*(1-1*b.chietkhau/100))*b.SoLuong) as thanhtien,";
	$sum = " sum(b.SoLuong) as SoLuong ";
} else {
	$s1 = "";
	$sum = " b.SoLuong ";
}
$mangsize = taomang("size", "ID", "Name");
$mangmau = taomang("mausac", "ID", "Name");
$mangdiachi = taomang("cuahang", "ID", "address");
$macuahang = taomang("cuahang", "ID", "macuahang");
$mangteam = taomang("lydonhapxuat", "ID", "Name", " where id>45  and loai=1");
$mangch = taomang("cuahang", "ID", "Name");
$mangnv = taomang("userac", "ID", "MaNV");
$mangten = taomang("userac", "ID", "ten");
$mangnhomhang = taomang("groupproduct", "ID", "Name");
$mangnganhhang = taomang("nhomhang", "ID", "Name");

$sql = "SELECT $s1  (case when ( v.ngayhoanthanh> $tucuoi and  v.ngayhoanthanh< $dencuoi )   then sum(ceil(b.DonGia*(1-1*b.chietkhau/100))*b.SoLuong) else 0 end) as hoanthanh  ,sum(ceil(b.DonGia*(1-1*b.chietkhau/100))*b.SoLuong)  as tongtiend, v.phithukh,v.diachi,v.phuong,v.quan,v.tinh,v.mavd,v.ngayhoanthanh,v.dongthoigiantrangthaidon as tinhtrang,v.loai as loaivc,a.lydo as team,a.idchol,a.tigia,a.ID as idbill,c.NameN,m.makh,DATE_FORMAT(m.ngaysinh,'%d/%m/%y') as ngaysinh,m.address,m.diemtichluy,m.tel,m.Name as tenkh,DATE_FORMAT(a.NgayTao,'%d/%m/%y %H:%i') as ngayban,a.NgayTao as ngayt,a.idgioithieu,a.idkho,a.SoCT ,a.nguoigiao,a.nguoitao,a.diachiN,a.idchOL  ,b.idnv as giagiamdoichieu,b.IDSP,c.Name as ten,b.chietkhau, b.DonGia,b.giavon,c.price as gia,c.giamgia,c.idgroup,c.idnhom ,c.size,c.mau,c.size,c.code as magoc,c.codepro as mapt, b.SoLuong,a.loai,b.ghichu,$sum  ,a.ghichu as note,a.tenn as idchat FROM   phieunhapxuat a left join xuatbanhang b on a.ID =b.IDPhieu left join products c on b.IDSP = c.ID left join customer m on a.IDNhaCC =m.id left join vanchuyenonline v on a.id=v.idbill ";



if ($tim == 1 || $tim == 9) {   // 1 gop  0 chi tiêt
	$sql .= " $sql_where group by a.ID   order by c.Name    ";
} else if ($tim == 0) {
	$sql .= " $sql_where   group by b.ID   order by a.id,a.NgayTao desc,c.price desc  ";
}
//	echo $sql ; 
if ($_SESSION["admintuan"])	echo $sql;



// SELECT b.chietkhau, b.DonGia,c.price as gia, b.SoLuong,a.loai FROM phieunhapxuat a left join xuatbanhang b on a.ID =b.IDPhieu left join products c on b.IDSP = c.ID where a.Loai in (1,3) and a.dakhoa = 1 and NgayNhap >= '2014-04-01' and NgayNhap <= '2014-04-21'
if ($tim == 2) $loai30 = " and a.nguoigiao like 'B211%' ";
else $loai30 = "";




//========================================================
if (!is_numeric($trang)) $trang = 1;
if ($trang * 1  <= 0) $trang = 1;
$result = $data->query($sql);
$num = $data->num_rows($result);
$pagesize = 15000;

if ($num > 15000) {
	include_once("includes/xlsxwriter.class.php");
	$writer = new XLSXWriter();
	$writer->writeSheetHeader('Sheet1', array(
		'STT' => 'integer',
		'Ngày bán' => 'string',
		'NV bán' => 'string',
		'Thu Ngân' => 'string',
		'Target' => 'string',
		'NV Pass đơn' => 'string',
		'Mã NV Pass đơn' => 'string',
		'Số phiếu' => 'string',
		'Thông tin khách hàng' => 'string',
		"" => "", "" => "",
		'Tên sản phẩm' => 'string',
		'Mã sản phẩm' => 'string',
		"Số lượng" => "integer",
		"Thành tiền" => "",
		"Phí thu KH" => "string",
		"Note" => "string",
		"Mã vận đơn" => "string",
		"Tình trạng đơn" => "string",
		"Thời gian cuối" => "string",
		"Địa chỉ giao hàng" => "string",
		"Mã CH" => "string",
		"Team Online" => "string"
	));

	$writer->markMergedCell($sheet_name, $start_row = 0, $start_col = 9, $end_row = 0, $end_col = 11);

	$tong = 0;
	$tongsl = 0;
	$tamct = '';
	$soct = '';
	$tralai = 0;
	$dondi = 0;
	$hoanthanh = 0;
	$donxuly = 0;
	$donhoanhientai = 0;
	$donhoan = 0;
	$donxulycuoi = 0;
	while ($re = $data->fetch_array($result)) {

		if ($re['SoCT'] != $tamct) {
			$tonggiam += $re['tigia'];
			$tamct = $re['SoCT'];
		}

		if ($re['SoCT'] == $soct) $re['tigia'] = 0;
		$soct = $re['SoCT'];
		$ten = $re['Name'];
		$ma = $re['codepro'];
		$giamgia = $re['giamgia'] . "%";
		$baohanh = $re['baohanh'];
		$nhap = $re['nhap'];
		$xuat = $re['xuat'];
		$gia = number_format($re['gia']);
		$dongia =  $re['DonGia'] * (1 - 1 * $re['chietkhau'] / 100);
		$gianhap =  $re['giavon'];

		$thanhtien = $re['SoLuong'] * $dongia;
		$tong += $thanhtien;
		$tongsl += $re['SoLuong'];
		if ($re['tinhtrang'] == 1) $thanhcong++;

		if ($re['hoanthanh'] != 0 && $re['tinhtrang'] == 1) {
			$hoanthanh++;
			$tienhoanthanh += $re['hoanthanh'];
		}
		if ($re['hoanthanh'] != 0 && $re['tinhtrang'] == 8) {
			$donhoan++;
			$tiendonhoan += $re['hoanthanh'];
		}
		if ($re['tinhtrang'] == 8)  $donhoanhientai++;


		// else if($re['hoanthanh'] ==1 && $re['tinhtrang']==8)  $donhoan ++ ;

		if ($re['loai'] == 3) $tralai++;
		if ($re['loai'] == 1) $dondi++;
		if ($re['hoanthanh'] != 0 && $re['loai'] == 1)  $donxuly++;
		if ($re['hoanthanh'] != 0 && $re['loai'] == 1)  $donxulycuoi++;

		$dvt = $re['DV'];
		if ($re['loai'] == 3) $mauchu = "red";
		else $mauchu = "";
		if ($gia == '0.00') $gia = "";
		if (formatso($dongia) !=  $gia) {
			$mauchu = "#FF00CC";
			if (round($dongia) == $re['giagiamdoichieu']) $mauchu = "blue";
		}

		if ($re['tinhtrang'] == 1)  $re['tinhtrang'] = "Đã xong";
		else  if ($re['tinhtrang'] == 8)  $re['tinhtrang'] = "Đã hủy";
		if ($re['mapt'] ==  "giamgia") $mauchu = "#FF9900";
		$nguoiban = $mangten[$re['diachiN']] . "\n" . $mangnv[$re['diachiN']] . " - $re[diachiN]";
		$passdon = $mangten[$re['idchOL']] . "\n" . $mangnv[$re['idchOL']] . " - $re[idchOL]";

		if ($loai == 5) $nguoiban = $mangch[$re['idchol']];
		if ($loai == -8) $taget = $mangten[$re['idgioithieu']] .  "\n" . $mangnv[$re['idgioithieu']];
		else   $taget = '';

		$tamarr = array($r++, $re['ngayban'], $nguoiban . "-" . $re['idchol'], $re['nguoitao'], $taget, $mangten[$re['idchOL']], $mangnv[$re['idchOL']], $re['SoCT'], $re['tenkh'] . "\n" . $re['ngaysinh'], $re['tel'] . "\n" . $re['address'], $re['diemtichluy'], $re['ten'], $re['mapt'], $re['SoLuong'],formatso($thanhtien), $re['phithukh'], $re['nguoigiao'] . " " . $re['note'] . " " . $re['ghichu'], $re['mavd'], $re['tinhtrang'], $re['ngayhoanthanh'], $re['diachi'], $macuahang[$re['idkho']], $mangteam[$re['team']]);

		$writer->writeSheetRow('Sheet1', $tamarr);
	}

	$writer->writeToFile('baocaobanhangnv.xlsx');
	echo "Số dòng $sodong quá lớn bạn có thể tải về click vào đây  <strong><a href='baocaobanhangnv.xlsx' target='_blank'> ( Tải về ) </a></strong>";
	return;
}


if ($trang == '') $trang = 1;
if ($num > $pagesize) {
	if ($trang != '') {
		$paging_two = ($trang - 1) * $pagesize;
		$sql .=  " LIMIT " . $paging_two . ", " . $pagesize;
		$result = $data->query($sql);

		for ($i = 1; $i < ($num / $pagesize) + 1; $i++) {
			if ($i == $trang) {
				$pt = $pt . " &nbsp;" . "  <label style=\"color:#FF0000\">$i</label> ";
			} else {
				$pt = $pt . " &nbsp;" . "<a style='cursor:pointer' onclick=\"submittk('$tmp[0]','$tmp[1]','$tmp[2]','$tmp[3]','$tmp[4]','$tmp[5]','$tmp[6]','$i','$tmp[8]','$tmp[9]','$tmp[10]','$tmp[11]','$tmp[12]','$tmp[13]','$tmp[14]')\"  > $i </a> ";
			}
		}
	}
}
$r = $pagesize * $trang - $pagesize + 1;
//==============================================================	

?>
<div>Có tổng số: <?php echo $tam['sl']; ?> sản phẩm bán ra & trị giá: <?php echo formatso($tam['tongt']); ?>&nbsp; &nbsp; Tổng tiền đã chiết khấu: <?php echo formatso($tam['ck']); ?> </div>
<div style="display:auto;overflow:scroll;min-width:960px;max-width:1450px;height:415px">


	<table width="99%" border="0" cellpadding="0" cellspacing="0" class="tbchuan">
		<thead>
			<tr bgcolor="#F8E4CB">
				<th align="center" height="23" width="29"><b>STT</b> </th>
				<th width="74" align="center"><strong>Ngày bán</strong> </th>
				<th width="74" align="center"><strong>NV Bán</strong> </th>
				<th width="147" align="center"><strong>Thu ngân </strong> </th>
				<th width="147" align="center"><strong>Target</strong> </th>
				<th width="74" align="center"><strong>Tên NV Pass đơn</strong> </th>
				<th width="74" align="center"><strong>Mã NV Pass đơn</strong> </th>
				<th width="92" align="center"><strong>Số Phiếu</strong> </th>
				<th width="143" colspan="3" align="center"><strong>Thông tin khách hàng</strong> </th>
				<th width="240" align="center"><strong>Tên Sản phẩm </strong> </th>
				<th width="90" align="center"><strong>Mã SP </strong> </th>
				<th width="20" align="center"><strong>SL</strong> </th>
				<th width="80" align="center"><strong>Thành Tiền</strong> </th>
				<th width="80" align="center"><strong>Phí thu KH</strong> </th>
				<th width="80" align="center"><strong>Note</strong> </th>
				<th width="80" align="center"><strong>Mã Vận đơn</strong> </th>
				<th width="80" align="center"><strong>Tình trạng đơn</strong> </th>
				<th width="80" align="center"><strong>Thời gian cuối</strong> </th>
				<th height="20" align="left" width="327">Địa chỉ Giao hàng (Chi tiết - đầy đủ) </th>
				<th align="left" width="64">Mã Cửa hàng </th>
				<th align="left" width="86">Team Online </th>
			</tr>
			<?php


			$tong = 0;
			$tongsl = 0;
			$tamct = '';
			$soct = '';
			$tralai = 0;
			$dondi = 0;
			$hoanthanh = 0;
			$donxuly = 0;
			$donhoanhientai = 0;
			$donhoan = 0;

			$mangBillTL = [];


			//=============đạt=======
			$thanhcongd = 0;
			$tongthanhcongd = 0;
			$donhoand = 0;
			$tongdonhoand = 0;
			$donhuyd = 0;
			$tongdonhuyd = 0;
			$dondangxulyd = 0;
			$tongdondangxulyd = 0;
			$dondid = 0;
			$tongdondid = 0;
			while ($re = $data->fetch_array($result)) {
				//=============đạt=======
				if ($tim == 1) {

					if (array_key_exists(rtrim($re['SoCT'], "TL"), $mangBillTL) || array_key_exists($re['SoCT'] . "TL", $mangBillTL)) {

						$mangBillTL[rtrim($re['SoCT'], "TL")]["count"]++;

						if (substr($re['SoCT'], (strlen($re['SoCT']) - 2), strlen($re['SoCT'])) == "TL") {
							$mangBillTL[rtrim($re['SoCT'], "TL")]["ngayhuy"] = $re['ngayt'];
						}
						if ($re['mavd']) {
							$mangBillTL[rtrim($re['SoCT'], "TL")]["mavd"] = $re['mavd'];
						}
					} else {
						$mangBillTL[rtrim($re['SoCT'], "TL")]["count"] = 1;
						$mangBillTL[rtrim($re['SoCT'], "TL")]["ngayhuy"] = '';
						$mangBillTL[rtrim($re['SoCT'], "TL")]["idbill"] = $re['idbill'];
						if (substr($re['SoCT'], (strlen($re['SoCT']) - 2), strlen($re['SoCT'])) == "TL") {
							$mangBillTL[rtrim($re['SoCT'], "TL")]["ngayhuy"] = $re['ngayt'];
						}
						if ($re['mavd']) {
							$mangBillTL[rtrim($re['SoCT'], "TL")]["mavd"] = $re['mavd'];
						}
					}
				}

				$dondid++;
				$tongdondid += $re['tongtiend'];
				$tinhtrang = '';
				if ($re['tinhtrang'] == 1 || $re['diachiN'] == $re['idgioithieu']) {
					$thanhcongd++;
					$tongthanhcongd += $re['tongtiend'];
					$tinhtrang = "Đã xong";
				}
				if ($re['tinhtrang'] == 8 && $re['loaivc'] == -1) {
					$donhoand++;
					$tongdonhoand += $re['tongtiend'];
					$tinhtrang = "Đơn hoàn";
				}
				if ($re['tinhtrang'] == 8 && $re['loaivc'] != -1) {
					$donhuyd++;
					$tongdonhuyd += $re['tongtiend'];
					$tinhtrang = "Đã hủy";
				}
				if ($re['tinhtrang'] != 8 && $re['tinhtrang'] != 1) {
					$dondangxulyd++;
					$tongdondangxulyd += $re['tongtiend'];
					$tinhtrang = $re['tinhtrang'];
				}
				//=========================

				if ($mau == "white") {
					$mau = "#EEEEEE";
					$hl = "Normal4";
					$hl2 = "Highlight4";
				} else {
					$mau = "white";
					$hl = "Normal5";
					$hl2 = "Highlight5";
				}

				if ($re['loai'] == 3) $mauchu = "red";
				else $mauchu = "";

				if ($re['SoCT'] != $tamct) {
					$tonggiam += $re['tigia'];
					$tamct = $re['SoCT'];
				}
				if ($re['idchOL'] == $re['idgioithieu'] && $re['idgioithieu'] > 0) {
					$re['hoanthanh'] = 1;
					$re['tinhtrang'] = 1;
					$mauchu = "#666600";
				}

				if ($re['SoCT'] == $soct) $re['tigia'] = 0;
				$soct = $re['SoCT'];
				$ten = $re['Name'];
				$ma = $re['codepro'];
				$giamgia = $re['giamgia'] . "%";
				$baohanh = $re['baohanh'];
				$nhap = $re['nhap'];
				$xuat = $re['xuat'];
				$gia = number_format($re['gia']);
				$dongia =  $re['DonGia'] * (1 - 1 * $re['chietkhau'] / 100);
				$gianhap =  $re['giavon'];
				$thanhtien = $re['SoLuong'] * $dongia;
				$tong += $thanhtien;
				$tongsl += $re['SoLuong'];
				if ($re['tinhtrang'] > 0) $thanhcong++;

				if (($re['hoanthanh'] > 0 && $re['tinhtrang'] == 1))  $hoanthanh++;  // đon hoan thanh  cả 2 
				if ($re['hoanthanh'] == 1 && $re['tinhtrang'] == 8)  $donhoan++;
				if ($re['tinhtrang'] == 8)  $donhoanhientai++;
				// else if($re['hoanthanh'] ==1 && $re['tinhtrang']==8)  $donhoan ++ ;
				if ($re['loai'] == 3) $tralai++;
				if ($re['loai'] == 1) $dondi++;
				if ($re['hoanthanh'] == 0 && $re['loai'] == 1)  $donxuly++;
				$dvt = $re['DV'];
				if ($gia == '0.00') $gia = "";
				if (formatso($dongia) !=  $gia) {
					$mauchu = "#FF00CC";
					if (round($dongia) == $re['giagiamdoichieu']) $mauchu = "blue";
				}


				/*if ($re['tinhtrang'] == 1 || $re['diachiN']==$re['idgioithieu'] )  $re['tinhtrang'] = "Đã xong";
				else  if ($re['tinhtrang'] == 8 && $re['loaivc']!=-1)  $re['tinhtrang'] = "Đã hủy";
				else  if ($re['tinhtrang'] == 8 && $re['loaivc']==-1 )  $re['tinhtrang'] = "Đơn hoàn";*/
				if ($re['mapt'] ==  "giamgia") $mauchu = "#FF9900";
				$nguoiban = $mangten[$re['diachiN']] . "<br>" . $mangnv[$re['diachiN']] . " - $re[diachiN]";
				//$passdon = $mangten[$re['idchOL']] . "<br>" . $mangnv[$re['idchOL']] . " - $re[idchOL]";

				if ($loai == 5) $nguoiban = $mangch[$re['idchol']];
				if ($loai == -8) $taget = $mangten[$re['idgioithieu']] .  "<br>" . $mangnv[$re['idgioithieu']];
				else   $taget = '';
			?>
				<tr style="cursor:pointer;color:<?php echo $mauchu; ?>" onmouseout="this.className='<?php echo $hl; ?>'" bgcolor="<?php echo $mau; ?>">
					<td align="right"><?php echo $r; ?></td>
					<td><?php echo $re['ngayban']; ?></td>
					<td><?php echo  $nguoiban . "-" . $re['idchol']; ?></td>
					<td><?php echo $re['nguoitao']; ?></td>
					<td><?php echo $taget; ?></td>
					<td><?php echo $mangten[$re['idchOL']]; ?></td>
					<td><?php echo $mangnv[$re['idchOL']]; ?></td>
					<td><?php echo $re['SoCT']; ?></td>
					<td><?php echo $re['tenkh'] . '<br>' . $re['ngaysinh']; ?></td>
					<td><?php echo $re['tel'] . '<br>' . $re['address']; ?></td>
					<td><?php echo $re['diemtichluy']; ?></td>
					<td><?php echo $re['ten']; ?></td>
					<td><?php echo $re['mapt']; ?></td>
					<td><?php echo $re['SoLuong']; ?></td>
					<td><?php echo formatso($thanhtien); ?></td>
					<td><?php echo $re['phithukh']; ?></td>
					<td><?php echo $re['nguoigiao'] . "  " . $re['note']; ?> <?php echo $re['ghichu']; ?></td>
					<td><?php echo $re['mavd']; ?></td>
					<td><?php echo $tinhtrang; ?></td>
					<td><?php echo $re['ngayhoanthanh']; ?></td>
					<td><?php echo $re['diachi']; ?></td>
					<td><?php echo $macuahang[$re['idkho']]; ?></td>
					<td><?php echo $mangteam[$re['team']]; ?></td>
				</tr>
			<?php
				$r++;
			}

			//if($_SESSION["LoginID"]==7576){
			if ($tim == 1) {
				$mangBillTL2 = [];
				$chuoiInsertTL = '';
				if (count($mangBillTL) > 0) {
					foreach ($mangBillTL as $key => $value) {
						if ($value["count"] >= 2 && !$value["mavd"]) {
							$chuoiInsertTL .= "('$value[idbill]','$key','Bill trả lại','8','$value[ngayhuy]','6'),";
							array_push($mangBillTL2, $value);
						}
					}
				}
				if ($chuoiInsertTL) {
					$chuoiInsertTL = rtrim($chuoiInsertTL, ",");
					$sqlu = "insert	into vanchuyenonline (idbill,sobill,mavd,dongthoigiantrangthaidon,ngayhoanthanh,loai) values $chuoiInsertTL on DUPLICATE KEY UPDATE dongthoigiantrangthaidon=VALUES(dongthoigiantrangthaidon),mavd=VALUES(mavd),ngayhoanthanh=VALUES(ngayhoanthanh);";

					$data->query($sqlu);
					/*var_dump($sqlu);
						echo "<br>";
						var_dump($mangBillTL2);*/
				}
			}
			//}
			?>
		</thead>
	</table>
</div>
<div style="padding:5px;"><?php
							//==============================================================	

							if ($tim == 1) $tong = ' Gộp chỉ tính số lượng';
							else $tong = formatso($tong);
							?>

	Có <?php echo  $tongsl; ?> sản phẩm tổng giá trị: <?php echo $tong; ?> &nbsp;

	<?php if ($tim == 1) {
		//=============đạt=======

	?>
		<table width="1197">
			<tr>
				<td width="196">tổng đơn trong tháng: </td>
				<td width="145">: <?php echo formatso($thanhcongd + $donhoand + $donhuyd + $dondangxulyd); ?></td>
				<td width="118"> Tổng doanh thu: </td>
				<td width="718">: <?php echo formatso($tongthanhcongd + $tongdonhoand + $tongdonhuyd + $tongdondangxulyd); ?></td>
			</tr>

			<tr>
				<td width="196">tổng đơn thành công: </td>
				<td width="145">: <?php echo formatso($thanhcongd); ?></td>

				<td width="118">Tổng doanh thu: </td>
				<td width="718">: <?php echo formatso($tongthanhcongd); ?></td>

			</tr>
			<tr>
				<td width="196">Số lượng đơn hoàn trong tháng: </td>
				<td width="145">: <?php echo formatso($donhoand); ?></td>

				<td width="118">Tổng doanh thu: </td>
				<td width="718">: <?php echo formatso($tongdonhoand); ?></td>

			</tr>
			<tr>
				<td width="196">tổng đơn hủy: </td>
				<td width="145">: <?php echo formatso($donhuyd); ?></td>

				<td width="118">Tổng doanh thu: </td>
				<td width="718">: <?php echo formatso($tongdonhuyd); ?></td>

			</tr>
			<tr>
				<td width="196">tổng đơn đang xử lý: </td>
				<td width="145">: <?php echo formatso($dondangxulyd); ?></td>

				<td width="118"> Tổng doanh thu: </td>
				<td width="718">: <?php echo formatso($tongdondangxulyd); ?></td>

			</tr>

			<!--<tr>
	<td width="255"> Tổng đơn trả lại  </td> 
	<td width="69">:  <?php echo formatso($tralai); ?></td> 
	
    <td width="59">  </td>
	<td width="184"> Tổng đơn đi   </td> 
	<td width="63">: <?php echo formatso($dondi); ?></td> 
 </tr>
<tr>
	<td width="255">Đơn thành công theo thời gian bill  </td> 
    <td width="69">: <?php echo formatso($thanhcong); ?> </td>
    <td width="59">: <?php echo formatso($tienthanhcong); ?> </td>
    <td width="184">Đơn hoàn theo thời gian bill </td> 
    <td width="63"> : <?php echo formatso($donhoanhientai); ?></td>
	 <td width="73"> : <?php echo formatso($s); ?></td>
    <td width="189">Đơn đang xử lý thời gian bill </td> 
    <td width="66"> : <?php echo formatso($donxuly); ?></td>
	<td width="199"> : <?php echo formatso($s); ?></td>
  </tr>
	  <tr>
	     <td>Đơn thành công theo thời gian cuối </td><td>: <?php echo formatso($hoanthanh); ?></td>
		 <td width="59">: <?php echo formatso($tienhoanthanh); ?> </td>
	     <td>Đơn hoàn theo thời gian cuối </td>
		   <td>: <?php echo formatso($donhoan); ?></td> 
	       <td width="73"> : <?php echo formatso($s); ?></td>
		   <td width="189">Đơn đang xử lý thời gian cuối </td> 
		   <td width="66"> : <?php echo formatso($donxulycuoi); ?></td>
	      <td width="199"> : <?php echo formatso($s); ?></td>
    </tr>-->
		</table>
	<?php  } ?>
	<div></div>

	<?php
	$data->closedata();
	?>