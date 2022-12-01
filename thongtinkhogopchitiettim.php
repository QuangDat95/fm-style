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

$sql_where = " where a.Loai  in (1,3)  and a.dakhoa = 1 ";
$sql_wherev = 'where a.dakhoa = 1  ';
if ($nganhhang > 0)  $sql_where .= " and c.IDnhom = '" . $nganhhang . "'";


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
if ($loai == -3) {
	$sql_where .= " and  a.nguoisua=-2";
}  // bill tra

if ($ghichu != "")	$sql_where .= " and (a.ghichu like '%" . $ghichu . "%' or  b.GhiChu like '%" . $ghichu . "%' )";

if ($nangcao == "true") {
	if ($ten != "") 	$sql_where .= " and c.Name like '" . $ten . "%'";
	if ($ma != "")	    $sql_where .= " and c.codepro like '" . $ma . "%'";
} else {
	if ($ten != "")	$sql_where .= " and c.Name  like '%" . $ten . "%'";
	if ($ma != "")	$sql_where .= " and c.codepro like '%" . $ma . "%'";
}

if ($nhom > 0) {
	$nhom = $nhom . timnhom("groupproduct", "IDGroup", $nhom);
	$sql_where .= " and  c.IDGroup in ( $nhom ) ";
}


if ($mota != "") {
	$sql_where .= " and c.NameN like '%" . $mota . "%'";
}

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
//	if($kho=='' && $idk ==4836)
//	{   
//	$sql_where.=" and a.IDKho in (1062,1071,1072)" ;
//    $sql_wherev=" and a.IDKho in (1062,1071,1072) ";
//	}  
//	else if($kho!='' && $idk ==4836)
//	{  
//$sql_where.= " and a.IDKho in (1062,1071,1072) and p.IDKho ='".$kho."'";
//$sql_wherev= " and a.IDKho in (1062,1071,1072) and p.IDKho ='".$kho."' ";

//	}
// ==========================================ngoai le
if ($ncc > 0)	$sql_where .= " and c.congtho ='" . $ncc . "'";
if ($IDNV != "0") {
	$sql_where .= " and (a.IDTao = $IDNV  or a.diachiN='$IDNV')";
	$sql_wherev .= " and (a.IDTao = $IDNV  or a.diachiN='$IDNV')";
}

$th =   gmdate('n', time() + 7 * 3600);
$ng =   gmdate('d', time() + 7 * 3600);
$na = gmdate('Y', time() + 7 * 3600);
if ($th < 3) $th = $th + 12;
if ($tu == "")   $tu = gmdate('01/n/Y', time() + 7 * 3600 - 60 * 24 * 3600);

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
	$sql_wherev .= " and  NgayNhap >= '$ngay[2]-$ngay[1]-$ngay[0]'";
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
}



$r = 1;

// $sql = "SELECT * FROM products ".$sql_where." ORDER BY NgayTao desc  ";IDSP``SoLuong``DonGia``LoaiTien``Thue``BaoHanh``GhiChu``Loai` 


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



$sql = "select h.*,k.phithukh  from ( SELECT $s1  v.tongtien as cod,v.donvivc,v.phitravc,v.trigiadon,v.chuyenkhoan,v.diachi,v.mavd,v.dongthoigiantrangthaidon as tinhtrang,v.phuong,v.quan,v.tinh,a.lydo as team,a.tigia,c.NameN,m.makh,DATE_FORMAT(m.ngaysinh,'%d/%m/%y') as ngaysinh,m.address,m.diemtichluy,m.tel,m.Name as tenkh, sum(b.soluong) as SoLuong,DATE_FORMAT(a.NgayTao,'%d/%m/%y %H:%i') as ngayban,v.ngayhoanthanh,a.idgioithieu,a.idkho,a.SoCT ,a.nguoigiao,a.nguoitao,a.diachiN ,b.idnv as giagiamdoichieu,b.IDSP,c.Name as ten,sum(ceil(b.DonGia*(1-1*b.chietkhau/100))*b.SoLuong) as thanhtien,b.chietkhau,c.idgroup,c.idnhom ,c.size,c.mau,c.code as magoc,c.codepro as mapt,a.idchol ,  a.loai,b.ghichu ,a.ghichu as note,a.tenn as idchat  FROM   phieunhapxuat a left join xuatbanhang b on a.ID =b.IDPhieu left join products c on b.IDSP = c.ID left join customer m on a.IDNhaCC =m.id left join vanchuyenonline v on a.id=v.idbill $sql_where group by a.ID  ) h left join thuchikt k on h.SoCT=k.hdbh ";
$result = $data->query($sql);
$tongsotrang = $data->num_rows($result);
$tongsotrang = ceil($tongsotrang/500);	


// $limit = 500;
// $start = ($trang - 1) * $limit;
$sql = "select h.*,k.phithukh  from ( SELECT $s1  v.tongtien as cod,v.donvivc,v.phitravc,v.trigiadon,v.chuyenkhoan,v.diachi,v.mavd,v.dongthoigiantrangthaidon as tinhtrang,v.phuong,v.quan,v.tinh,a.lydo as team,a.tigia,c.NameN,m.makh,DATE_FORMAT(m.ngaysinh,'%d/%m/%y') as ngaysinh,m.address,m.diemtichluy,m.tel,m.Name as tenkh, sum(b.soluong) as SoLuong,DATE_FORMAT(a.NgayTao,'%d/%m/%y %H:%i') as ngayban,v.ngayhoanthanh,a.idgioithieu,a.idkho,a.SoCT ,a.nguoigiao,a.nguoitao,a.diachiN ,b.idnv as giagiamdoichieu,b.IDSP,c.Name as ten,sum(ceil(b.DonGia*(1-1*b.chietkhau/100))*b.SoLuong) as thanhtien,b.chietkhau,c.idgroup,c.idnhom ,c.size,c.mau,c.code as magoc,c.codepro as mapt,a.idchol ,  a.loai,b.ghichu ,a.ghichu as note,a.tenn as idchat  FROM   phieunhapxuat a left join xuatbanhang b on a.ID =b.IDPhieu left join products c on b.IDSP = c.ID left join customer m on a.IDNhaCC =m.id left join vanchuyenonline v on a.id=v.idbill $sql_where group by a.ID  ) h left join thuchikt k on h.SoCT=k.hdbh"; //  LIMIT $start, $limit

//========================================================
$result = $data->query($sql);



?>
<div>Có tổng số: <?php echo $tam['sl']; ?> sản phẩm bán ra & trị giá: <?php echo formatso($tam['tongt']); ?>&nbsp; &nbsp; Tổng tiền đã chiết khấu: <?php echo formatso($tam['ck']); ?> </div>
<div style="display:auto;overflow:scroll  ;width:1070px;height:450px">
	<table width="98%" border="0" cellpadding="0" cellspacing="0" class="tbchuan">
		<thead>
			<tr bgcolor="#F8E4CB">
				<th align="center" height="23" width="29"><b>STT</b> </th>
				<th width="74" align="center"><strong>Ngày bán</strong> </th>
				<th width="74" align="center"><strong>NV Bán</strong> </th>
				<th width="147" align="center"><strong>Thu ngân </strong> </th>
				<th width="147" align="center"><strong>Taget</strong> </th>
				<th width="92" align="center"><strong>Số Phiếu</strong> </th>
				<th width="143" colspan="3" align="center"><strong>Thông tin khách hàng</strong> </th>

				<th width="79" align="center"><strong>Voucher </strong> </th>
				<th width="23" align="center"><strong>CK</strong> </th>

				<th width="20" align="center"><strong>SL</strong> </th>
				<th width="80" align="center"><strong>Thành Tiền</strong> </th>
				<th width="80" align="center"><strong>Thực thu</strong></th>
				<th width="80" align="center"><strong>Note</strong> </th>
				<th height="20" align="left" width="327">Địa chỉ Giao hàng (Chi tiết - đầy đủ) </th>
				<th align="left" width="253">Địa chỉ Giao hàng (Xã/Phường/Thị trấn) </th>
				<th align="left" width="395">Địa chỉ Giao hàng (Quận/Huyện/Thị Xã/Thành phố thuộc Tỉnh) </th>
				<th align="left" width="226">Địa chỉ Giao hàng (Tỉnh/Thành phố) </th>
				<th align="left" width="191">Địa chỉ Cửa hàng </th>
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
			while ($re = $data->fetch_array($result)) {
				if ($mau == "white") {
					$mau = "#EEEEEE";
					$hl = "Normal4";
					$hl2 = "Highlight4";
				} else {
					$mau = "white";
					$hl = "Normal5";
					$hl2 = "Highlight5";
				}
				if ($re['SoCT'] != $tamct) {
					$tonggiam += $re['tigia'];
					$tamct = $re['SoCT'];
				}

				if ($re['SoCT'] == $soct) $re['tigia'] = 0;
				$soct = $re['SoCT'];
				$ten = $re['Name'];
				$ma = $re['codepro'];


				$thanhtien = $re['thanhtien'];
				$tongthanhtien += $thanhtien;
				$tongsoluong += $re['SoLuong'];
				$tongvc += $re['tigia'];
				$dvt = $re['DV'];
				if ($re['loai'] == 3) $mauchu = "red";
				else $mauchu = "";
				if ($gia == '0.00') $gia = "";



				if ($re['mapt'] ==  "giamgia") $mauchu = "#FF9900";
				$nguoiban = $mangten[$re['diachiN']] . "<br>" . $mangnv[$re['diachiN']] . " - $re[diachiN]";

				if ($loai == 5) $nguoiban = $mangch[$re['idchol']];
				$taget = $mangten[$re['idgioithieu']] .  "<br>" . $mangnv[$re['idgioithieu']];
			?>
				<tr style="cursor:pointer;color:<?php echo $mauchu; ?>" onmouseout="this.className='<?php echo $hl; ?>'" bgcolor="<?php echo $mau; ?>">
					<td align="right"><?php echo $r; ?></td>
					<td><?php echo $re['ngayban']; ?></td>
					<td><?php echo  $nguoiban . "-" . $re['idchol']; ?></td>
					<td><?php echo $re['nguoitao']; ?></td>
					<td><?php echo $taget; ?></td>
					<td><?php echo $re['SoCT']; ?></td>
					<td><?php echo $re['tenkh'] . '<br>' . $re['ngaysinh']; ?></td>
					<td><?php echo $re['tel'] . '<br>' . $re['address']; ?></td>
					<td><?php echo $re['diemtichluy']; ?></td>

					<td><?php echo $re['tigia']; ?></td>
					<td><?php echo $re['chietkhau']; ?></td>

					<td><?php echo $re['SoLuong']; ?></td>
					<td><?php echo formatso($thanhtien); ?></td>
					<td><?php echo formatso($thanhtien - $re['tigia']); ?></td>
					<td><?php echo $re['nguoigiao'] . "  " . $re['note']; ?> <?php echo $re['ghichu']; ?></td>
					<td><?php echo $re['diachi']; ?></td>
					<td><?php echo $re['phuong']; ?></td>
					<td><?php echo $re['quan']; ?></td>
					<td><?php echo $re['tinh']; ?></td>
					<td><?php echo $mangdiachi[$re['idkho']]; ?></td>
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
			?>
		</thead>
		<tr>
			<td colspan="9"></td>


			<td><?php echo formatso($tongvc); ?></td>
			<td><?php echo formatso($tongck); ?></td>

			<td><?php echo formatso($tongsoluong); ?></td>
			<td><?php echo formatso($tongthanhtien); ?></td>
			<td><?php echo formatso($tongthanhtien - $tongvc); ?></td>
			<td>&nbsp; </td>
			<td>&nbsp; </td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
	</table>
</div>
			

<?php
$data->closedata();
?>