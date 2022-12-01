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
$sobill =  trim($tmp[18]);
$sql_where = " where (a.Loai  in (1,3,5)  and a.dakhoa = 1 and idchOL <> -1)";
$sql_whereslsp = " where (a.Loai  in (1,3,5)  and a.dakhoa = 1  and idchOL <> -1) ";
$sql_wherev = 'where a.dakhoa = 1  ';
if ($nganhhang > 0)  $sql_where .= " and c.IDnhom = '" . $nganhhang . "'";

if ($IDNV == 1)  $IDNV = 0;;


if ($loai == 1) {
	$sql_where .= " and (a.DonGia*(1-1*a.chietkhau/100)) <> c.price ";
	$sql_whereslsp .= " and (a.DonGia*(1-1*a.chietkhau/100)) <> c.price ";
}
if ($loai == 2) {
	$sql_where .= " and (a.DonGia*(1-1*a.chietkhau/100)) = c.price ";
	$sql_whereslsp .= " and (a.DonGia*(1-1*a.chietkhau/100)) = c.price ";
}
if ($loai == 3) {
	$sql_where .= " and  a.tigia  >0 ";
	$sql_whereslsp .= " and a.tigia  >0 ";
}
if ($loai == 4) {
	$sql_where .= " and  a.idnhacc  >1 ";
	$sql_whereslsp .= " and a.idnhacc  >1 ";
}
if ($loai == -5) {
	$sql_where .= " and  a.idnhacc  =1 ";
	$sql_whereslsp .= " and a.idnhacc  =1 ";
}
if ($loai > 9 || $loai == 5) {
	$sql_where .= " and  a.lydo =$loai ";
	$sql_wherev .= " and a.lydo ='" . $loai . "'";
	$sql_whereslsp .= " and a.lydo  =$loai ";
}
if ($loai == -6) {
	$sql_where .= " and ( a.lydo =53 or a.lydo =56  or  a.lydo =61   or  a.lydo =62   or  a.lydo =49)  ";
	$sql_wherev .= " and ( a.lydo =53 or a.lydo =56  or  a.lydo =61   or  a.lydo =62   or  a.lydo =49)  ";

	$sql_whereslsp .= " and ( a.lydo =53 or a.lydo =56  or a.lydo =61   or  a.lydo =62   or  a.lydo =49)  ";
}   // tong shopee
if ($loai == -7) {
	$sql_where .= " and ( a.lydo =46 or  a.lydo =47  or  a.lydo =48   or  a.lydo =52 or a.lydo =55    )  ";
	$sql_wherev .= " and ( a.lydo =46 or  a.lydo =47  or  a.lydo =48   or  a.lydo =52 or a.lydo =55 )  ";
	$sql_whereslsp .= " and ( a.lydo =46 or  a.lydo =47  or  a.lydo =48   or  a.lydo =52 or a.lydo =55    )   ";
}   // tong team 1,2,3,7,kids
if ($loai == -8) {
	$sql_where .= " and  a.idgioithieu  >0 ";
	$sql_whereslsp .= " and  a.idgioithieu  >0  ";
}  // taget
if ($loai == -9) {
	$sql_where .= " and a.lydo >44 and a.lydo not in (69,79) ";
	$sql_whereslsp .= " and a.lydo >44 and a.lydo not in (69,79) ";
}  //  
if ($loai == -11) {
	$sql_where .= " and  a.idkho = 1105";
	$sql_whereslsp .= " and  a.idkho  =1105  ";
}  // 
if ($loai == -12) {
	$sql_where .= " and  a.idkho=  1137";
	$sql_whereslsp .= " and  a.idkho  =1137  ";
}
if ($loai == -13) {
	$sql_where .= " and (a.idkho=1137 or a.idkho=1105) ";
	$sql_whereslsp .= " and (a.idkho=1137 or b.idkho=1105) ";
}
if ($loai == -3) {
	$sql_where .= " and  a.nguoisua=-2";
	$sql_whereslsp .= " and  a.nguoisua=-2 ";
}  // bill tra
if ($loai == -10) {
	$sql_where .= " and  a.lydo  >44 and a.loai=3 ";
	$sql_whereslsp .= "and  a.lydo  >44 and a.loai=3 ";
}
if ($ghichu != "") {
	$sql_where .= " and (a.ghichu like '%" . $ghichu . "%' or  a.GhiChu like '%" . $ghichu . "%' )";
	$sql_whereslsp .= " and (a.ghichu like '%" . $ghichu . "%' or  a.GhiChu like '%" . $ghichu . "%' )";
}
if ($sobill) {
	$sql_where .= " and a.SoCT='$sobill' ";
	$sql_whereslsp .= " and a.SoCT='$sobill' ";
}
if ($nangcao == "true") {
	if ($ten != "") {
		$sql_where .= " and c.Name like '" . $ten . "%'";

		$sql_whereslsp .= " and c.Name like '" . $ten . "%' ";
	}
	if ($ma != "") {
		$sql_where .= " and c.codepro like '" . $ma . "%'";
		$sql_whereslsp .= "  and c.codepro like '" . $ma . "%' ";
	}
} else {
	if ($ten != "") {

		$sql_where .= " and c.Name  like '" . $ten . "%'";
		$sql_whereslsp .= "  and c.Name  like '" . $ten . "%' ";
	}
	if ($ma != "") {
		$sql_where .= " and c.codepro like '" . $ma . "%'";
		$sql_whereslsp .= "  and c.codepro like '" . $ma . "%' ";
	}
}

if ($nhom > 0) {
	$nhom = $nhom . timnhom("groupproduct", "IDGroup", $nhom);
	$sql_where .= " and  c.IDGroup in ( $nhom ) ";
	$sql_whereslsp .= "   and  c.IDGroup in ( $nhom )  ";
}

if ($tinhtrang == 1) {
	$sql_where .= " and (v.dongthoigiantrangthaidon =1  or  a.diachiN=a.idgioithieu)";
} elseif ($tinhtrang == "5") {
	$sql_where .= " and (v.dongthoigiantrangthaidon =1 or  a.diachiN=a.idgioithieu)  ";
} // đơn gối đầu
elseif ($tinhtrang == "8") {
	$sql_where .= " and ((v.dongthoigiantrangthaidon =8 and v.loai=-1)  or  a.diachiN=a.idgioithieu )   ";
} // đơn gối đầu
elseif ($tinhtrang == 2) {
	$sql_where .= " and (v.mavd='' or v.mavd is null ) and a.loai<>3 and !(a.idchOL >1 and (a.idchOL =a.idgioithieu)) and (a.lydo<>53 and a.lydo<>56)";
} elseif ($tinhtrang == 3) {
	$sql_where .= " and (v.dongthoigiantrangthaidon is null or v.dongthoigiantrangthaidon =''  ) and a.loai<>3 and !(a.idchOL >1 and (a.idchOL = a.idgioithieu)) and (a.lydo<>53 and a.lydo<>56)";
} elseif ($tinhtrang == 4) {
	$sql_where .= " and  v.loai=8 and a.loai<>3  and  v.dongthoigiantrangthaidon='' ";
} elseif ($tinhtrang != "" && $tinhtrang != "0") {
	$sql_where .= " and v.dongthoigiantrangthaidon = $tinhtrang ";
} elseif ($tinhtrang == "0") {
	$sql_where .= " and v.dongthoigiantrangthaidon <>1 and v.dongthoigiantrangthaidon <> 8 and  a.loai<>3    ";
}

$sql_where .= " and v.loai <> 22"; // loại những đơn TMĐT 

if ($mota != "") {
	$sql_where .= " and c.NameN like '" . $mota . "%'";
}
if ($kho == 0)  $kho = '';
$idkho = $_SESSION["se_kho"];
if (!($idk == 1 ||  $ql[5] || $_SESSION["loai_user"] == 16))   // nv thường
{
	$sql_where .= " and a.IDKho ='" . $idkho . "'";
	$sql_whereslsp .= " and a.IDKho ='" . $idkho . "'";
	$sql_wherev .= " and a.IDKho ='" . $idkho . "'";
} elseif ($_SESSION["loai_user"] == 16 && $kho == '') {
	$sql_where .= " and ch.IDtinh ='" . $idkho . "'";
	$sql_wherev .= " and ch.IDtinh ='" . $idkho . "'";
} elseif ($kho != "") {
	$sql_where .= " and a.IDKho ='" . $kho . "'";
	$sql_wherev .= " and a.IDKho ='" . $kho . "'";
	$sql_whereslsp .= " and a.IDKho ='" . $idkho . "'";
}
// ==========================================ngoai le

// ==========================================ngoai le
if ($ncc > 0)	$sql_where .= " and c.congtho ='" . $ncc . "'";
if ($IDNV != "0") {
	$sql_where .= " and (a.IDTao = $IDNV  or a.diachiN='$IDNV' or a.idchol='$IDNV')";
	$sql_whereslsp .= " and (a.IDTao = $IDNV  or a.diachiN='$IDNV' or a.idchol='$IDNV')";
	$sql_wherev .= " and (a.IDTao = $IDNV  or a.diachiN='$IDNV' or a.idchol='$IDNV')";
	$whereNV .= " and (b.IDTao = $IDNV  or b.diachiN='$IDNV' or b.idchol='$IDNV')";
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
	$sql_whereslsp .= " and  NgayNhap >= '$ngay[2]-$ngay[1]-$ngay[0]'";
	$sql_wherev .= " and  NgayNhap >= '$ngay[2]-$ngay[1]-$ngay[0]'";
	$tu = " '$ngay[2]-$ngay[1]-$ngay[0]' ";
}
if ($den != "") {
	$ngay =  explode('/', $den);
	if (strlen($ngay[1]) == 1) {
		$ngay[1] = "0" . $ngay[1];
	}
	if (strlen($ngay[0]) == 1) {
		$ngay[0] = "0" . $ngay[0];
	}
	$sql_where .= " and  NgayNhap <= '$ngay[2]-$ngay[1]-$ngay[0] 23:59:00'";
	$sql_whereslsp .= " and  NgayNhap <= '$ngay[2]-$ngay[1]-$ngay[0] 23:59:00'";
	$sql_wherev .= " and  NgayNhap <= '$ngay[2]-$ngay[1]-$ngay[0] 23:59:00'";
	$sql_where9 .= " and  p.ngaythuchi <= '$ngay[2]-$ngay[1]-$ngay[0] 23:59:00'";
	$den = " '$ngay[2]-$ngay[1]-$ngay[0] 23:59:00' ";
}
$sqlchan = '';
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
	//$sql_whereslsp.="  and v.ngayhoanthanh>='$ngay[2]-$ngay[1]-$ngay[0]'";
	$sqlchan .= "  and v.ngayhoanthanh>='$ngay[2]-$ngay[1]-$ngay[0]'";
	$sql_whereslsp .= $sqlchan;
}
if ($dencuoi != "") {

	$ngay =  explode('/', $dencuoi);
	if (strlen($ngay[1]) == 1) {
		$ngay[1] = "0" . $ngay[1];
	}
	if (strlen($ngay[0]) == 1) {
		$ngay[0] = "0" . $ngay[0];
	}
	$dencuoi = " '$ngay[2]-$ngay[1]-$ngay[0] 23:59:00' ";

	$sqlchan .= "  and v.ngayhoanthanh<='$ngay[2]-$ngay[1]-$ngay[0] 23:59:00'";
	$sql_whereslsp .= $sqlchan;
}

if ($tinhtrang == "5" || $tinhtrang == "8" || $tinhtrang == 1) {
	$sql_where .= $sqlchan;
}



$r = 1;

// $sql = "SELECT * FROM products ".$sql_where." ORDER BY NgayTao desc  ";IDSP``SoLuong``DonGia``LoaiTien``Thue``BaoHanh``GhiChu``Loai` 

if ($tim == 9) {
	$sq19 = "select n.id,n.soct,a.mavandon,a.phithukh,a.donvivc,a.dongia,a.ngaythuchi from ( select * from  thuchikt p  where (p.tinhtrang=4) and p.hdbh<>'' $sql_where9  ) a left join vanchuyenonline v on a.hdbh=v.sobill left join phieunhapxuat n on a.hdbh = n.soct  where  v.id is null and n.lydo>45  ";
	echo $sq19 . "<br>";
	$sqlu = " insert	into vanchuyenonline (idbill,sobill,mavd,phithukh,donvivc,tongtien,dongthoigiantrangthaidon,ngayhoanthanh,loai) values ";
	$result = $data->query($sq19);
	$dauphay = '';
	$r = 0;
	$k = 0;
	while ($re = $data->fetch_array($result)) {
		$r++;
		if (trim($re['mavandon']) == '')  $re['mavandon'] = 'Không có mã vận đơn';
		$sqlu .= $dauphay . "('$re[id]','$re[soct]','$re[mavandon]','$re[phithukh]','$re[donvivc]','$re[dongia]','0','',8)";
		if ($dauphay == '') $dauphay = ",";
		if ($r == 100) {
			$r = 0;
			$dauphay = '';
			echo $sqlu . "<br>";
			$k++;
			$data->query($sqlu);
			$sqlu = " insert	into vanchuyenonline (idbill,sobill,mavd,phithukh,donvivc,tongtien,dongthoigiantrangthaidon,ngayhoanthanh,loai) values ";
		}
		if ($k == 10)  return;
	}
	if ($r != 0) {
		echo $sqlu . "<br>";
		$data->query($sqlu);
	}
	return;
} elseif ($tim == 8) {
	$sq17 = "  select * from  phieunhapxuat a   left join vanchuyenonline b on b.idbill=a.id 
      where a.dakhoa=1 and a.idgioithieu=a.idchol and a.idgioithieu >0 and a.ngaytao>='2022-05-01' 
      and  b.dongthoigiantrangthaidon<>1 and   b.dongthoigiantrangthaidon<>8 ";  // tim Tất cả đơn hàng có mã vận đơn : NV mua (taget=nhân viên passdon) -> tình trạng đơn đã xong


	$sq19 = "select a.id,b.ngaytao, DATE_ADD(b.ngaytao, INTERVAL 10 DAY )as hoanthanh ,DATEDIFF( NOW(),b.ngaytao)   from ( select id,sobill from vanchuyenonline  where dongthoigiantrangthaidon='Đã tiếp nhận'  ) a 
  left join  phieunhapxuat b on a.sobill=b.soct where b.dakhoa=1 and  DATEDIFF( NOW(),b.ngaytao) >10 ";
	echo $sq19 . "<br>";

	$sqlu = " insert	into vanchuyenonline (ID, dongthoigiantrangthaidon,ngayhoanthanh,loai) values ";
	$result = $data->query($sq19);
	$dauphay = '';
	$r = 0;
	$k = 0;
	while ($re = $data->fetch_array($result)) {
		$r++;
		$sqlu .= $dauphay . "('$re[id]','8','$re[hoanthanh]',7)";
		if ($dauphay == '') $dauphay = ",";
		if ($r == 100) {
			$r = 0;
			$dauphay = '';
			echo $sqlu . "<br>";
			$k++;
			$data->query($sqlu . " ON DUPLICATE KEY UPDATE dongthoigiantrangthaidon=VALUES(dongthoigiantrangthaidon),ngayhoanthanh=VALUES(ngayhoanthanh)");
			$sqlu = " insert	into vanchuyenonline (ID, dongthoigiantrangthaidon,ngayhoanthanh,loai) values ";
		}
		if ($k == 10)  return;
	}
	if ($r != 0) {
		echo $sqlu . "<br>";
		$data->query($sqlu . " ON DUPLICATE KEY UPDATE dongthoigiantrangthaidon=VALUES(dongthoigiantrangthaidon),ngayhoanthanh=VALUES(ngayhoanthanh)");
	}
	return;
}




/*
if ($tim == 1) {
	$s1 = " sum(ceil(a.DonGia*(1-1*a.chietkhau/100))*a.SoLuong) as thanhtien,";
	$sum = " sum(a.SoLuong) as SoLuong ";
} else {
	$s1 = "";
	$sum = " a.SoLuong ";
}*/
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

/*$sql = "SELECT $s1  (case when ( v.ngayhoanthanh> $tucuoi and  v.ngayhoanthanh< $dencuoi )   then sum(ceil(b.DonGia*(1-1*b.chietkhau/100))*b.SoLuong) else 0 end) as hoanthanh  ,sum(ceil(b.DonGia*(1-1*b.chietkhau/100))*b.SoLuong)  as tongtiend, v.phithukh,v.diachi,v.phuong,v.quan,v.tinh,v.mavd,v.ngayhoanthanh,(case when ( v.ngayhoanthanh>= $tucuoi and  v.ngayhoanthanh<= $dencuoi)  then 1 else 0 end) as ngayhoanthanhtrongthang,v.dongthoigiantrangthaidon as tinhtrang,v.loai as loaivc,a.lydo as team,a.idchol,a.tigia,a.ID as idbill,c.NameN,m.makh,DATE_FORMAT(m.ngaysinh,'%d/%m/%y') as ngaysinh,m.address,m.diemtichluy,m.tel,m.Name as tenkh,DATE_FORMAT(a.NgayTao,'%d/%m/%y %H:%i') as ngayban,a.NgayTao as ngayt,a.idgioithieu,a.idkho,a.SoCT ,a.nguoigiao,a.nguoitao,a.diachiN,a.idchOL  ,b.idnv as giagiamdoichieu,b.IDSP,c.Name as ten,b.chietkhau, b.DonGia,b.giavon,c.price as gia,c.giamgia,c.idgroup,c.idnhom ,c.size,c.mau,c.size,c.code as magoc,c.codepro as mapt, b.SoLuong,a.loai,b.ghichu,$sum  ,a.ghichu as note,a.tenn as idchat FROM   phieunhapxuat a left join xuatbanhang b on a.ID =b.IDPhieu left join products c on b.IDSP = c.ID left join customer m on a.IDNhaCC =m.id left join vanchuyenonline v on a.id=v.idbill ";*/


$sql = "SELECT sum(ceil(a.DonGia*(1-1*a.chietkhau/100))*a.SoLuong) as thanhtien,
sum(ceil(a.DonGia*(1-1*a.chietkhau/100))*abs(a.SoLuong)) as thanhtienabs, 

(case when (v.ngayhoanthanh> $tucuoi and  v.ngayhoanthanh< $dencuoi) 
then sum(ceil(a.DonGia*(1-1*a.chietkhau/100))*a.SoLuong) else 0 end) as hoanthanh ,

sum(ceil(a.DonGia*(1-1*a.chietkhau/100))*a.SoLuong) as tongtiend, 
v.phithukh,v.diachi,v.phuong,v.quan,v.tinh,v.mavd,v.ngayhoanthanh ,

(case when ( v.ngayhoanthanh>= $tucuoi and  v.ngayhoanthanh<= $dencuoi)  
then 1 else 0 end) as ngayhoanthanhtrongthang,

v.dongthoigiantrangthaidon as tinhtrang,v.loai as loaivc,a.lydo as team,a.idchol,a.tigia,a.ID as idbill,
c.NameN,m.makh,DATE_FORMAT(m.ngaysinh,'%d/%m/%y') as ngaysinh,m.address,m.diemtichluy,m.tel,m.Name as tenkh,
DATE_FORMAT(a.NgayTao,'%d/%m/%y %H:%i') as ngayban,a.NgayTao as ngayt,a.idgioithieu,a.idkho,a.SoCT ,a.nguoigiao,
a.nguoitao,a.diachiN,a.idchOL ,a.idnv as giagiamdoichieu,a.IDSP,c.Name as ten,a.chietkhau,a.DonGia,a.giavon,
c.price as gia,c.giamgia,c.idgroup,c.idnhom ,c.size,c.mau,c.size,c.code as magoc,c.codepro as mapt,a.SoLuong,
a.loai,a.ghichu, sum(a.SoLuong) as SoLuongt ,a.ghichu as note,a.tenn as idchat 
FROM phieubanhangluu a 
left join products c on a.IDSP = c.ID 
left join customer m on a.IDNhaCC =m.id 
left join vanchuyenonline v on a.id=v.idbill";


if ($tim == 1 || $tim == 9) {   // 1 gop  0 chi tiêt
	$sqltam = "SELECT SUM(a.SoLuong) as tongsl,
	SUM(case when ((v.dongthoigiantrangthaidon = 1 or a.diachiN=a.idgioithieu) 
	and a.lydo not in (53,56,57,69,79) and v.loai<>22) 
	then a.SoLuong else 0 end) as soluongspthanhcong,
	SUM(case when ((v.dongthoigiantrangthaidon = 8) and  (v.loai=-1)) 
	and a.lydo not in (53,56,57,69,79)  and v.loai<>22 
	then abs(a.SoLuong) else 0 end) as soluongspdonhoan,
	SUM(case when ((v.dongthoigiantrangthaidon =8) and  (v.loai<>-1)) 
	and a.lydo not in (53,56,57,69,79)  and v.loai<>22  
	then a.SoLuong else 0 end) as soluongspdonhuy,
	SUM(case when ((v.dongthoigiantrangthaidon <>8  and v.dongthoigiantrangthaidon <> 1) 
	and a.lydo not in (53,56,57,69,79)  and v.loai<>22 and !(a.diachiN=a.idgioithieu)) 
	then a.SoLuong else 0 end) as soluongspdangxuly
	FROM  phieubanhangluu a 
	left join products c on a.IDSP = c.ID 
	left join customer m on a.IDNhaCC =m.id 
	left join vanchuyenonline v on a.id=v.idbill $sql_whereslsp ";


	$dongslsp = getdong($sqltam);

	$sql .= " $sql_where group by a.ID   order by a.NgayTao,c.Name";
} else if ($tim == 0) {
	$sql .= " $sql_where   group by a.ID,a.IDSP  order by a.NgayTao,a.id desc,c.price desc  ";
}
// echo $sql;
//echo "<br>".$sql;
//hoàn vê TL
$sql1 = "SELECT sum(b.SoLuong) as slhoanveppm ,
count(distinct b.SoCT) as donhoanvepm,
sum(ceil(b.DonGia*(1-1*b.chietkhau/100))*b.SoLuong) as doanhthuhoanvepm,
b.IDTao,b.diachiN,b.idchol,b.idgioithieu 
from phieubanhangluu b 
left join vanchuyenonline d on b.ID=d.IDbill 
where b.LyDo>45 and b.lydo not in (53,56,57,69,79)  
and b.Loai =3 and b.dakhoa = 1  and b.idchOL <> -1 
and b.NgayNhap >= $tucuoi and b.NgayNhap <= $dencuoi   $whereNV  
and SUBSTRING_INDEX(SoCT,'TL',1) in (select SoCT from phieubanhangluu where ngaynhap>=$tucuoi and ngaynhap<=$dencuoi)";

$donghtvtl = getdong($sql1);

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
		'Mã NV' => 'string',
		"ID Chat" => 'string',
		'Số phiếu' => 'string',
		'Thông tin khách hàng' => 'string',
		"" => "", "" => "",
		'Tên sản phẩm' => 'string',
		'Mã sản phẩm' => 'string',
		'Mô tả' => 'string',
		"Giá chuẩn" => "string",
		"Voucher" => "integer",
		"CK" => "integer",
		"Giá bán" => "string",
		"Giá giảm" => "string",
		"Phí thu KH" => "string",
		"SL" => "",
		"Thành tiền" => "",
		"Note" => "string",
		"Mã vận đơn" => "string",
		"Tình trạng đơn" => "string",
		"Thời gian cuối" => "string",
		"Địa chỉ giao hàng" => "string",
		"Size sản phẩm" => "string",
		"Màu sản phẩm" => "string",
		"Nhóm hàng" => "string",
		"Ngành hàng" => "string",
		"Mã CH" => "string",
		"Team Online" => "string"
	));

	$writer->markMergedCell($sheet_name, $start_row = 0, $start_col = 8, $end_row = 0, $end_col = 10);

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

		$thanhtien = $re['thanhtien'];
		$tong += $thanhtien;
		$tongsl += $re['SoLuongt'];
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



		//=============đạt=================
		$tinhtrang = '';

		if ((($re['tinhtrang'] == 1 || ($re['diachiN'] == $re['idgioithieu']) && $re['loaivc'] != 22) && !in_array($re['team'], [56, 57, 53, 69, 79]) && $re["ngayhoanthanhtrongthang"])) {
			$thanhcongd++;
			$tongthanhcongd += $re['thanhtien'];
			$tinhtrang = "Đã xong";
		} else if ((($re['tinhtrang'] == 1 || $re['tinhtrang'] = 8 || $re['diachiN'] == $re['idgioithieu']) && $re['loaivc'] != 22) && !$re["ngayhoanthanhtrongthang"]) {
			$tinhtrang = "Đang Giao";
		}
		if (($re['tinhtrang'] == 8 && $re['loaivc'] == -1) && $re["ngayhoanthanhtrongthang"] && $re['loaivc'] != 22 && !in_array($re['team'], [56, 57, 53])) {
			$donhoand++;
			$tongdonhoand += $re['thanhtien'];
			$tinhtrang = "Đơn hoàn";
			$sldonhoan += abs($re['SoLuong']);
		}
		if (($re['tinhtrang'] == 8 && $re['loaivc'] != -1) && $re["ngayhoanthanhtrongthang"] && $re['loaivc'] != 22 && !in_array($re['team'], [56, 57, 53, 69, 79])) {
			$donhuyd++;
			$tongdonhuyd += $re['thanhtien'];
			$tinhtrang = "Đã hủy";
		}
		if ($re['tinhtrang'] != 8 && $re['tinhtrang'] != 1 && $re['loaivc'] != 22 && !in_array($re['team'], [56, 57, 53, 69, 79])) {
			$dondangxulyd++;
			$tongdondangxulyd += $re['thanhtien'];
			$tinhtrang = $re['tinhtrang'];
		}

		if ($re['loaivc'] == 22 || in_array($re['team'], [56, 57, 53, 69, 79])) {
			$tinhtrang .= "Đang Giao TMDT";
		}
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

		$tamarr = array($r++, $re['ngayban'], $nguoiban . "-" . $re['idchol'], $re['nguoitao'], $taget, $passdon, $mangnv[$re['idchOL']], $re['idchat'], $re['SoCT'], $re['tenkh'] . "\n" . $re['ngaysinh'], $re['tel'] . "\n" . $re['address'], $re['diemtichluy'], $re['ten'], $re['mapt'], $re['NameN'], $gia, $re['chietkhau'], formatso($dongia), formatso($giagiam), $re['SoLuong'], $re['phithukh'], formatso($thanhtien), $re['nguoigiao'] . " " . $re['note'] . " " . $re['ghichu'], $re['mavd'], $tinhtrang, $re['ngayhoanthanh'], $re['diachi'], $mangsize[$re['size']], $mangmau[$re['mau']], $mangnhomhang[$re['idgroup']], $mangnganhhang[$re['idnhom']], $macuahang[$re['idkho']], $mangteam[$re['team']]);

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
				<th width="147" align="center"><strong>Taget</strong> </th>
				<th width="74" align="center"><strong>NV Pass đơn</strong> </th>
				<th width="74" align="center"><strong>ID Chat</strong> </th>
				<th width="92" align="center"><strong>Số Phiếu</strong> </th>
				<th width="143" colspan="3" align="center"><strong>Thông tin khách hàng</strong> </th>
				<th width="240" align="center"><strong>Tên Sản phẩm </strong> </th>
				<th width="90" align="center"><strong>Mã SP </strong> </th>
				<th width="90" align="center"><strong>Mô tả</strong> </th>
				<th width="79" align="center"><strong> Giá chuẩn </strong> </th>
				<th width="79" align="center"><strong>Voucher </strong> </th>
				<th width="23" align="center"><strong>CK</strong> </th>
				<th width="67" align="center"><strong>Giá Bán</strong> </th>
				<th width="67" align="center"><strong>Giá giảm</strong> </th>
				<th width="67" align="center"><strong>Phí thu KH</strong> </th>
				<th width="20" align="center"><strong>SL</strong> </th>
				<th width="80" align="center"><strong>Thành Tiền</strong> </th>
				<th width="80" align="center"><strong>Note</strong> </th>
				<th width="80" align="center"><strong>Mã Vận đơn</strong> </th>
				<th width="80" align="center"><strong>Tình trạng đơn</strong> </th>
				<th width="80" align="center"><strong>Thời gian cuối</strong> </th>
				<th height="20" align="left" width="327">Địa chỉ Giao hàng (Chi tiết - đầy đủ) </th>
				<th align="left" width="95">Size sản phẩm </th>
				<th align="left" width="97">Màu sản phẩm </th>
				<th align="left" width="78">Nhóm hàng </th>
				<th align="left" width="78">Ngành hàng </th>
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
			$sldonhoan = 0;
			$mangBillTL = [];

			$mangBillCuahang = [];
			$chuoiinsertBillCuahang = '';
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
					$re['dongia'] = '';
					if (array_key_exists(rtrim($re['SoCT'], "TL"), $mangBillTL) || array_key_exists($re['SoCT'] . 'TL', $mangBillTL)) {

						$mangBillTL[rtrim($re['SoCT'], "TL")]["count"]++;

						if (substr($re['SoCT'], (strlen($re['SoCT']) - 2), strlen($re['SoCT'])) == "TL") {
							$mangBillTL[rtrim($re['SoCT'], "TL")]["ngayhuy"] = $re['ngayt'];
						} else {
							$mangBillTL[rtrim($re['SoCT'], "TL")]["ngaytao"] = $re['ngayt'];
						}
						if ($re['mavd']) {
							$mangBillTL[rtrim($re['SoCT'], "TL")]["mavd"] = $re['mavd'];
						}
						if (substr($re['SoCT'], (strlen($re['SoCT']) - 2), strlen($re['SoCT'])) == "TL") {
							$mangBillTL[rtrim($re['SoCT'], "TL")]["idbillTL"] = $re['idbill'];
						} else {
							$mangBillTL[rtrim($re['SoCT'], "TL")]["idbill"] = $re['idbill'];
						}
						/*if($re['tinhtrang']){
								$mangBillTL[rtrim($re['SoCT'],"TL")]["tinhtrang"]=$re['tinhtrang'];
							}
*/							//$mangBillTL[rtrim($re['SoCT'],"TL")]["ngayhuy"]=$re['Ngaynhap'];
					} else {
						$mangBillTL[rtrim($re['SoCT'], "TL")]["count"] = 1;
						//$mangBillTL[rtrim($re['SoCT'],"TL")]["ngayhuy"]='';
						if (substr($re['SoCT'], (strlen($re['SoCT']) - 2), strlen($re['SoCT'])) == "TL") {
							$mangBillTL[rtrim($re['SoCT'], "TL")]["idbillTL"] = $re['idbill'];
						} else {
							$mangBillTL[rtrim($re['SoCT'], "TL")]["idbill"] = $re['idbill'];
						}
						if (substr($re['SoCT'], (strlen($re['SoCT']) - 2), strlen($re['SoCT'])) == "TL") {
							$mangBillTL[rtrim($re['SoCT'], "TL")]["ngayhuy"] = $re['ngayt'];
						} else {
							$mangBillTL[rtrim($re['SoCT'], "TL")]["ngaytao"] = $re['ngayt'];
						}
						if ($re['mavd']) {
							$mangBillTL[rtrim($re['SoCT'], "TL")]["mavd"] = $re['mavd'];
						}
						if (substr($re['SoCT'], (strlen($re['SoCT']) - 2), strlen($re['SoCT'])) != "TL") {
							$mangBillTL[rtrim($re['SoCT'], "TL")]["tinhtrang"] = $re['tinhtrang'];
						}
					}
				}

				if ($re['idgioithieu'] == -1) {

					$chuoiinsertBillCuahang .= "('$re[idbill]','$re[SoCT]','Đơn Cửa hàng','1','$re[ngayt]','6'),";
					array_push($mangBillCuahang, $re['SoCT']);
				}
				$dondid++;
				$tongdondid += $re['tongtiend'];
				$tinhtrang = '';

				if ((($re['tinhtrang'] == 1 || ($re['diachiN'] == $re['idgioithieu'])) && $re["ngayhoanthanhtrongthang"]) && $re['loaivc'] != 22 && !in_array($re['team'], [56, 57, 53, 69, 79])) {
					$thanhcongd++;
					$tongthanhcongd += $re['thanhtien'];
					$tinhtrang = "Đã xong";
				} else if (($re['tinhtrang'] == 1 || ($re['diachiN'] == $re['idgioithieu'])) && !$re["ngayhoanthanhtrongthang"] && !in_array($re['team'], [56, 57, 53, 69, 79])) {
					$tinhtrang = "Đang Giao";
				}
				if (($re['tinhtrang'] == 8 && $re['loaivc'] == -1) && $re["ngayhoanthanhtrongthang"] && $re['loaivc'] != 22 && !in_array($re['team'], [56, 57, 53, 69, 79])) {
					$donhoand++;
					$tongdonhoand += $re['thanhtien'];
					$tinhtrang = "Đơn hoàn";
					$sldonhoan += abs($re['SoLuong']);
				}
				if (($re['tinhtrang'] == 8 && $re['loaivc'] != -1) && $re["ngayhoanthanhtrongthang"] && $re['loaivc'] != 22 && !in_array($re['team'], [56, 57, 53, 69, 79])) {
					$donhuyd++;
					$tongdonhuyd += $re['thanhtien'];
					$tinhtrang = "Đã hủy";
				}
				if ($re['tinhtrang'] != 8 && $re['tinhtrang'] != 1 && $re['loaivc'] != 22 && !in_array($re['team'], [56, 57, 53, 69, 79])) {
					$dondangxulyd++;
					$tongdondangxulyd += $re['thanhtien'];
					$tinhtrang = $re['tinhtrang'];
				}

				if ($re['loaivc'] == 22 || in_array($re['team'], [56, 57, 53, 69, 79])) {

					$tinhtrang .= "Đang Giao TMDT";
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
				$thanhtien = $re['thanhtien'];
				$tong += $re["thanhtien"];
				$tongsl += $re['SoLuongt'];
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
				$passdon = $mangten[$re['idchOL']] . "<br>" . $mangnv[$re['idchOL']] . " - $re[idchOL]";

				if ($loai == 5) $nguoiban = $mangch[$re['idchol']];
				if ($loai == -8) $taget = $mangten[$re['idgioithieu']] .  "<br>" . $mangnv[$re['idgioithieu']];
				else   $taget = '';
			?>
				<tr style="cursor:pointer;color:<?php echo $mauchu; ?>" onmouseout="this.className='<?php echo $hl; ?>'" bgcolor="<?php echo $mau; ?>">
					<td align="right" title="<?php echo $re['tinhtrang'] . " === " . $re['hoanthanh']; ?> "><?php echo $r; ?></td>
					<td><?php echo $re['ngayban']; ?></td>
					<td><?php echo  $nguoiban . "-" . $re['idchol']; ?></td>
					<td><?php echo $re['nguoitao']; ?></td>
					<td><?php echo $taget; ?></td>
					<td><?php echo $passdon; ?></td>
					<td><?php echo $re['idchat']; ?></td>
					<td><?php echo $re['SoCT']; ?></td>
					<td><?php echo $re['tenkh'] . '<br>' . $re['ngaysinh']; ?></td>
					<td><?php echo $re['tel'] . '<br>' . $re['address']; ?></td>
					<td><?php echo $re['diemtichluy']; ?></td>
					<td><?php echo $re['ten']; ?></td>
					<td><?php echo $re['mapt']; ?></td>
					<td><?php echo $re['NameN']; ?></td>
					<td><?php echo $gia; ?></td>

					<td><?php echo $re['tigia']; ?></td>
					<td><?php echo $re['chietkhau']; ?></td>

					<td><?php echo formatso($dongia); ?></td>

					<td><?php echo formatso($giagiam); ?></td>
					<td><?php echo $re['phithukh']; ?></td>
					<td><?php echo $re['SoLuong']; ?></td>
					<td><?php echo formatso($thanhtien); ?></td>
					<td><?php echo $re['nguoigiao'] . "  " . $re['note']; ?> <?php echo $re['ghichu']; ?></td>
					<td><?php echo $re['mavd']; ?></td>
					<td><?php echo $tinhtrang; ?></td>
					<td><?php echo $re['ngayhoanthanh']; ?></td>
					<td><?php echo $re['diachi']; ?></td>


					<td><?php echo $mangsize[$re['size']]; ?></td>
					<td><?php echo $mangmau[$re['mau']]; ?></td>
					<td><?php echo $mangnhomhang[$re['idgroup']]; ?></td>
					<td><?php echo $mangnganhhang[$re['idnhom']]; ?></td>
					<td><?php echo $macuahang[$re['idkho']]; ?></td>
					<td><?php echo $mangteam[$re['team']]; ?></td>
				</tr>
			<?php
				$r++;
			}

			//=======tự động update phiếu có phieus trả lại thành hủy

			//in($mangBillTL);
			//if($_SESSION["LoginID"]==7576){
			if ($tim == 1) {

				if ($chuoiinsertBillCuahang) {

					$chuoiinsertBillCuahang = rtrim($chuoiinsertBillCuahang, ",");
					$sqlBCH = "insert	into vanchuyenonline (idbill,sobill,mavd,dongthoigiantrangthaidon,ngayhoanthanh,loai) values $chuoiinsertBillCuahang on DUPLICATE KEY UPDATE dongthoigiantrangthaidon=VALUES(dongthoigiantrangthaidon),mavd=VALUES(mavd),ngayhoanthanh=VALUES(ngayhoanthanh);";
					// $data->query($sqlBCH);
				}
				$mangBillTL2 = [];
				$chuoiInsertTL = '';
				if (count($mangBillTL) > 0) {
					foreach ($mangBillTL as $key => $value) {
						if ($value["count"] >= 2) {

							if (!$value["mavd"]) {
								if (date("Y-m-d", $value["ngaytao"]) == date("Y-m-d", $value["ngayhuy"])) {
									$chuoiInsertTL .= "('$value[idbill]','$key','Bill trả lại','8','$value[ngayhuy]','6'),";
								} else {
									if ($value["tinhtrang"] == 1) {
										$sobill = $key . "TL";
										$chuoiInsertTL .= "('$value[idbillTL]','$sobill','$value[mavd]','1','$value[ngayhuy]','6'),";
									}
								}
							} else {

								if ($value["tinhtrang"] == 1) {
									$sobill = $key . "TL";
									$chuoiInsertTL .= "('$value[idbillTL]','$sobill','$value[mavd]','1','$value[ngayhuy]','6'),";
								}
							}
						}
					}
				}

				if ($chuoiInsertTL) {
					$chuoiInsertTL = rtrim($chuoiInsertTL, ",");
					$sqlu = "insert	into vanchuyenonline (idbill,sobill,mavd,dongthoigiantrangthaidon,ngayhoanthanh,loai) values $chuoiInsertTL on DUPLICATE KEY UPDATE dongthoigiantrangthaidon=VALUES(dongthoigiantrangthaidon),mavd=VALUES(mavd),ngayhoanthanh=VALUES(ngayhoanthanh);";
					// $data->query($sqlu);

				}
			}
			//}
			//=======end tự động update phiếu có phieus trả lại thành hủy
			?>
		</thead>
	</table>
</div>
<div style="padding:5px;">

	<?php
	//==============================================================	

	/*	if ($tim == 1) $tong = ' Gộp chỉ tính số lượng';
							else $tong = formatso($tong); 	Có   $tongsl; sản phẩm tổng giá trị:echo $tong; */
	?>



	<?php if ($tim == 1) {
		//=============đạt=======

	?>
		<table width="1197" style="margin-top:10px">
			<tr>
				<td width="146" height="35">tổng đơn trong tháng: </td>
				<td width="116">: <?php echo formatso($dondid); ?></td>
				<td width="111"> Tổng doanh thu: </td>
				<td width="141">: <?php echo formatso($tong ? $tong : 0); ?></td>
				<td width="120">Tổng Số lượng sp: </td>
				<td width="535">: <?php echo formatso($tongsl ? $tongsl : 0); ?></td>
			</tr>

			<tr>
				<td width="146">tổng đơn thành công: </td>
				<td width="116">: <?php echo formatso($thanhcongd); ?></td>

				<td width="111">Tổng doanh thu: </td>
				<td width="141">: <?php echo formatso($tongthanhcongd); ?></td>

				<td width="120">Tổng Số lượng sp: </td>
				<td width="535">: <?php echo formatso($dongslsp['soluongspthanhcong'] ? $dongslsp['soluongspthanhcong'] : 0); ?></td>
			</tr>
			<tr>
				<td width="146">Số lượng đơn hoàn trong tháng: </td>
				<td width="116">: <?php echo formatso($donhoand); ?></td>

				<td width="111">Tổng doanh thu: </td>
				<td width="141">: <?php echo formatso($tongdonhoand); ?></td>
				<td width="120">Tổng Số lượng sp: </td>
				<td width="535">: <?php echo formatso($dongslsp['soluongspdonhoan'] ? $dongslsp['soluongspdonhoan'] : 0); ?>
				</td>
			</tr>
			<tr>
				<td width="146">tổng đơn hủy: </td>
				<td width="116">: <?php echo formatso($donhuyd); ?></td>

				<td width="111">Tổng doanh thu: </td>
				<td width="141">: <?php echo formatso($tongdonhuyd); ?></td>
				<td width="120">Tổng Số lượng sp: </td>
				<td width="535">: <?php echo formatso($dongslsp['soluongspdonhuy'] ? $dongslsp['soluongspdonhuy'] : 0); ?></td>
			</tr>
			<tr>
				<td width="146">tổng đơn đang xử lý: </td>
				<td width="116">: <?php echo formatso($dondangxulyd); ?></td>

				<td width="111"> Tổng doanh thu: </td>
				<td width="141">: <?php echo formatso($tongdondangxulyd); ?></td>
				<td width="120">Tổng Số lượng sp: </td>
				<td width="535">: <?php echo formatso($dongslsp['soluongspdangxuly'] ? $dongslsp['soluongspdangxuly'] : 0); ?></td>

			<tr>
				<td width="146">Tổng đơn TL: </td>
				<td width="116">: <?php echo formatso($donghtvtl['donhoanvepm']); ?></td>

				<td width="111"> Tổng doanh thu: </td>
				<td width="141">: <?php echo formatso($donghtvtl['doanhthuhoanvepm']); ?></td>
				<td width="120">Tổng Số lượng sp: </td>
				<td width="535">: <?php echo formatso($donghtvtl['slhoanveppm'] ? $donghtvtl['slhoanveppm'] : 0); ?></td>
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