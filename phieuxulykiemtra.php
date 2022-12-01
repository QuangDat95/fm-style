<?php
session_start();

$IDK = $_SESSION["LoginID"];
$cuahang = $_SESSION["se_kho"];
$quyen = $_SESSION["quyen"];
$ql = $quyen[$_SESSION["mangquyenid"]["capnhaptuvan"]];
if (!($ql[0] == 1 || $IDK == 1)) {
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

$soct =  trim($tmp[0]);
$loai =  laso($tmp[1]);
// echo $loai;
//return;
if ($soct == '') {
	echo "###-1### ";
	return;
}
if ($IDK == 1 || $IDK == 4647 || $IDK == 7576) $cuahang = "";
else $cuahang = " and  a.idkho=$cuahang ";

$ngaygioihan1 = 30;
$ngaygioihan2 = 60;
$ngaygioihan3 = 90;

$tam = '';
switch ($loai) {
	case  1:   // target 
		$sql = "SELECT  a.soct,a.id,a.idkho,a.ghichu,a.idgioithieu,a.diachiN,a.LyDo,b.ten,c.ten as nv,DATE_FORMAT(a.NgayTao,'%d/%m/%Y %H:%i') as ngay,DATE_FORMAT(a.NgayTao,'%Y-%m-%d') as ngaykt ,DATEDIFF(CURDATE(),a.ngaytao) as songay  from phieunhapxuat a left join userac b on a.diachin=b.id   left join userac c on a.idtao=c.id where a.soct='$soct'";
		$dong = getdong($sql);
		if ($dong['id'] == '') {
			echo "###-1###Không tìm thấy phiếu bán hàng $soct này ! ";
			return;
		}
		if ((int)($dong['songay']) >= (int)($ngaygioihan1)) {
			echo "###-2###Phiếu quá hạn ! ";
			return;
		}
		$tam = $dong;
		echo  "###1###$tam[id]###$tam[soct]###$tam[ten]###$tam[diachiN]###$tam[idkho]###$tam[idgioithieu]###$tam[LyDo]###$tam[ghichu]###$tam[ngaykt]### Ngày tạo: <b>$tam[ngay] </b> NV tạo:<b> $tam[nv] </b> , &nbsp; Nhân viên tư vấn trên bill: <b> $tam[ten]</b>, &nbsp; Team: <b> " . getten('lydonhapxuat', $tam['LyDo'], 'Name') . "</b>, &nbsp; Nhân viên giới thiệu: <b> " . getten('userac', $tam['idgioithieu'], 'Ten') . "</b>, &nbsp; Ghi chú: <b> $tam[ghichu]</b>   ###";
		return;
		break;
	case  2:   // nhan vien tu van
		//echo  $soct ;
		$sql = "SELECT  a.soct,a.id,a.idkho,a.ghichu,a.idgioithieu,a.diachiN,a.LyDo,b.ten,c.ten as nv,DATE_FORMAT(a.NgayTao,'%d/%m/%Y %H:%i') as ngay,DATE_FORMAT(a.NgayTao,'%Y-%m-%d') as ngaykt from phieunhapxuat a left join userac b on a.diachin=b.id   left join userac c on a.idtao=c.id where a.soct='$soct'";
		$dong = getdong($sql);
		if ($dong['id'] == '') {
			echo "###-1###Không tìm thấy phiếu thu chi $soct này ! ";
			return;
		}
		if ((int)($dong['songay']) >= (int)($ngaygioihan1)) {
			echo "###-2###Phiếu quá hạn ! ";
			return;
		}
		$tam = $dong;
		echo  "###1###$tam[id]###$tam[soct]###$tam[ten]###$tam[diachiN]###$tam[idkho]###$tam[idgioithieu]###$tam[LyDo]###$tam[ghichu]###$tam[ngaykt]### Ngày tạo: <b>$tam[ngay] </b> NV tạo:<b> $tam[nv] </b> , &nbsp; Nhân viên tư vấn trên bill: <b> $tam[ten]</b>, &nbsp; Team: <b> " . getten('lydonhapxuat', $tam['LyDo'], 'Name') . "</b>, &nbsp; Nhân viên giới thiệu: <b> " . getten('userac', $tam['idgioithieu'], 'Ten') . "</b>, &nbsp; Ghi chú: <b> $tam[ghichu]</b>   ###";
		return;
		break;
	case  3:   // lý do
		$sql = "SELECT  a.soct,a.id,a.idkho,a.ghichu,a.idgioithieu,a.diachiN,a.LyDo,b.ten,c.ten as nv,DATE_FORMAT(a.NgayTao,'%d/%m/%Y %H:%i') as ngay,DATE_FORMAT(a.NgayTao,'%Y-%m-%d') as ngaykt from phieunhapxuat a left join userac b on a.diachin=b.id   left join userac c on a.idtao=c.id where a.soct='$soct'";
		$dong = getdong($sql);
		if ($dong['id'] == '') {
			echo "###-1###Không tìm thấy phiếu thu chi $soct này ! ";
			return;
		}
		if ((int)($dong['songay']) >= (int)($ngaygioihan1)) {
			echo "###-2###Phiếu quá hạn ! ";
			return;
		}
		$tam = $dong;
		echo  "###1###$tam[id]###$tam[soct]###$tam[ten]###$tam[diachiN]###$tam[idkho]###$tam[idgioithieu]###$tam[LyDo]###$tam[ghichu]###$tam[ngaykt]### Ngày tạo: <b>$tam[ngay] </b> NV tạo:<b> $tam[nv] </b> , &nbsp; Nhân viên tư vấn trên bill: <b> $tam[ten]</b>, &nbsp; Team: <b> " . getten('lydonhapxuat', $tam['LyDo'], 'Name') . "</b>, &nbsp; Nhân viên giới thiệu: <b> " . getten('userac', $tam['idgioithieu'], 'Ten') . "</b>, &nbsp; Ghi chú: <b> $tam[ghichu]</b>   ###";
		return;

		break;
	case  4:   // ghi chú
		$sql = "SELECT  a.soct,a.id,a.idkho,a.ghichu,a.idgioithieu,a.diachiN,a.LyDo,b.ten,c.ten as nv,DATE_FORMAT(a.NgayTao,'%d/%m/%Y %H:%i') as ngay,DATE_FORMAT(a.NgayTao,'%Y-%m-%d') as ngaykt from phieunhapxuat a left join userac b on a.diachin=b.id   left join userac c on a.idtao=c.id where a.soct='$soct'";
		$dong = getdong($sql);
		if ($dong['id'] == '') {
			echo "###-1###Không tìm thấy phiếu thu chi $soct này ! ";
			return;
		}
		if ((int)($dong['songay']) >= (int)($ngaygioihan1)) {
			echo "###-2###Phiếu quá hạn ! ";
			return;
		}
		$tam = $dong;
		echo  "###1###$tam[id]###$tam[soct]###$tam[ten]###$tam[diachiN]###$tam[idkho]###$tam[idgioithieu]###$tam[LyDo]###$tam[ghichu]###$tam[ngaykt]### Ngày tạo: <b>$tam[ngay] </b> NV tạo:<b> $tam[nv] </b> , &nbsp; Nhân viên tư vấn trên bill: <b> $tam[ten]</b>, &nbsp; Team: <b> " . getten('lydonhapxuat', $tam['LyDo'], 'Name') . "</b>, &nbsp; Nhân viên giới thiệu: <b> " . getten('userac', $tam['idgioithieu'], 'Ten') . "</b>, &nbsp; Ghi chú: <b> $tam[ghichu]</b>   ###";
		return;
		break;
	case  5:   // thuchich
		$sql = "SELECT  a.sochungtu,a.id,a.lydo,b.ten,c.ten as nv,DATE_FORMAT(a.ngaytao,'%d/%m/%Y %H:%i') as ngay,DATE_FORMAT(a.ngaytao,'%Y-%m-%d') as ngaykt,DATEDIFF(CURDATE(),a.ngaytao) as songay from thuchich a left join userac b on a.IDtao=b.id   left join userac c on a.idtao=c.id where a.sochungtu='$soct'";
		$dong = getdong($sql);
		if ($dong['id'] == '') {
			echo "###-1###Không tìm thấy phiếu thu chi $soct này ! ";
			return;
		}
		if ((int)($dong['songay']) >= (int)($ngaygioihan1)) {
			echo "###-2###Phiếu quá hạn ! ";
			return;
		}
		$tam = $dong;
		break;
	case  6:  // thuchikt
		$sql = "SELECT  a.sochungtu,a.id,a.lydo,b.ten,c.ten as nv,DATE_FORMAT(a.ngaytao,'%d/%m/%Y %H:%i') as ngay,DATE_FORMAT(a.ngaythuchi,'%Y-%m-%d') as ngaykt,DATEDIFF(CURDATE(),a.ngaythuchi) as songay from thuchikt a left join userac b on a.IDtao=b.id   left join userac c on a.idtao=c.id where a.sochungtu='$soct'";
		$dong = getdong($sql);
		//echo $dong['songay'];
		if ($dong['id'] == '') {
			echo "###-1###Không tìm thấy phiếu thu chi $soct này  ! ";
			return;
		}
		if ((int)($dong['songay']) >= (int)($ngaygioihan1)) {
			echo "###-2###Phiếu quá hạn ! ";
			return;
		}

		$tam = $dong;
		break;
	case 7:   // thuchich
		$sql = "SELECT  a.sochungtu,a.id,a.lydo,b.ten,c.ten as nv,DATE_FORMAT(a.ngaytao,'%d/%m/%Y %H:%i') as ngay,DATE_FORMAT(a.ngaytao,'%Y-%m-%d') as ngaykt,DATEDIFF(CURDATE(),a.ngaytao) as songay from thuchich a left join userac b on a.IDtao=b.id   left join userac c on a.idtao=c.id where a.sochungtu='$soct'";
		$dong = getdong($sql);
		if ($dong['id'] == '') {
			echo "###-1###Không tìm thấy phiếu thu chi cửa hàng  $soct quá hạn này ! ";
			return;
		}
		if ((int)($dong['songay']) >= (int)($ngaygioihan2)) {
			echo "###-2###Phiếu quá hạn ! ";
			return;
		}

		$tam = $dong;
		break;
	case 8:   // thuchikt qua han
		$sql = "SELECT  a.sochungtu,a.id,a.lydo,b.ten,c.ten as nv,DATE_FORMAT(a.ngaytao,'%d/%m/%Y %H:%i') as ngay,DATE_FORMAT(a.ngaythuchi,'%Y-%m-%d') as ngaykt,DATEDIFF(CURDATE(),a.ngaythuchi) as songay from thuchikt a left join userac b on a.IDtao=b.id   left join userac c on a.idtao=c.id where a.sochungtu='$soct'";
		$dong = getdong($sql);
		if ($dong['id'] == '') {
			echo "###-1###Không tìm thấy phiếu thu chi kế toán  $soct quá hạn này    ! ";
			return;
		}
		if ((int)($dong['songay']) >= (int)($ngaygioihan2)) {
			echo "###-2###Phiếu quá hạn ! ";
			return;
		}

		$tam = $dong;
		break;

	case 9:   // thuchikt phục hồi
		$sql = "SELECT  a.sochungtu,a.id,a.lydo,b.ten,c.ten as nv,DATE_FORMAT(a.ngaytao,'%d/%m/%Y %H:%i') as ngay,DATE_FORMAT(a.ngaythuchi,'%Y-%m-%d') as ngaykt,DATEDIFF(CURDATE(),a.ngaythuchi) as songay from thuchikt a left join userac b on a.IDtao=b.id   left join userac c on a.idtao=c.id where a.sochungtu='$soct'";
		$dong = getdong($sql);
		if ($dong['id'] == '') {
			echo "###-1###Không tìm thấy phiếu thu chi kế toán  $soct cần phục hồi này  ! ";
			return;
		}
		if ((int)($dong['songay']) >= (int)($ngaygioihan1)) {
			echo "###-2###Phiếu quá hạn ! ";
			return;
		}

		$tam = $dong;
		break;
	case 10:   // doi tra hang lần 2,3
		$sql = "SELECT  a.soct ,a.id,a.idkho,a.ghichu,a.idgioithieu,a.diachiN,a.LyDo,b.ten,c.ten as nv,DATE_FORMAT(a.NgayTao,'%d/%m/%Y %H:%i') as ngay,DATE_FORMAT(a.NgayTao,'%Y-%m-%d') as ngaykt,DATEDIFF(CURDATE(),a.NgayTao) as songay  from phieunhapxuat a left join userac b on a.diachin=b.id   left join userac c on a.idtao=c.id where a.loai=3 and  a.dakhoa=1 and a.soct='$soct'";
		$dong = getdong($sql);
		if ($dong['id'] == '') {
			echo "###-1###Không tìm thấy phiếu đổi trả  $soct cần duyệt    ! ";
			return;
		}
		if ((int)($dong['songay']) >= (int)($ngaygioihan3)) {
			echo "###-2###Phiếu quá hạn ! ";
			return;
		}

		$tam = $dong;
		break;
	case 11:   // Phục hồi phiếu xuất kho 1 xuatkhtongphuchoi
		$sql = "SELECT  a.soct  as sochungtu,a.id,a.idkho,a.ghichu,a.diachiN,a.LyDo,b.ten,c.ten as nv,DATE_FORMAT(a.NgayTao,'%d/%m/%Y %H:%i') as ngay,DATE_FORMAT(a.NgayTao,'%Y-%m-%d') as ngaykt,DATEDIFF(CURDATE(),a.NgayTao) as songay  from phieuxuat a left join userac b on a.diachin=b.id   left join userac c on a.idtao=c.id where a.loai=1 and  a.dakhoa=1 and a.soct='$soct'";

		$dong = getdong($sql);
		if ($dong['id'] == '') {
			echo "###-1###Không tìm thấy phiếu xuất  $soct cần duyệt    ! ";
			return;
		}
		if ((int)($dong['songay']) >= (int)($ngaygioihan3)) {
			echo "###-2###Phiếu quá hạn ! ";
			return;
		}

		$tam = $dong;
		break;
	case 12:   // Phục hồi Phiếu nhập kho 0 nhapkhophuchoi
		$sql = "SELECT  a.soct as sochungtu,a.id,a.idkho,a.ghichu,a.idgioithieu,a.diachiN,a.LyDo,b.ten,c.ten as nv,DATE_FORMAT(a.NgayTao,'%d/%m/%Y %H:%i') as ngay,DATE_FORMAT(a.NgayTao,'%Y-%m-%d') as ngaykt,DATEDIFF(CURDATE(),a.NgayTao) as songay  from phieunhapxuat a left join userac b on a.diachin=b.id   left join userac c on a.idtao=c.id where a.loai=0 and  a.dakhoa=1 and a.soct='$soct'";
		$dong = getdong($sql);
		if ($dong['id'] == '') {
			echo "###-1###Không tìm thấy phiếu nhập  $soct cần duyệt    ! ";
			return;
		}
		if ((int)($dong['songay']) >= (int)($ngaygioihan3)) {
			echo "###-2###Phiếu quá hạn ! ";
			return;
		}

		$tam = $dong;
		break;
	case 13:   // Phục hồi phiếu trả nhà cung cấp  xuatraphuchoi
		$sql = "SELECT  a.soct  as sochungtu,a.id,a.idkho,a.ghichu,a.idgioithieu,a.diachiN,a.LyDo,b.ten,c.ten as nv,DATE_FORMAT(a.NgayTao,'%d/%m/%Y %H:%i') as ngay,DATE_FORMAT(a.NgayTao,'%Y-%m-%d') as ngaykt,DATEDIFF(CURDATE(),a.NgayTao) as songay  from phieunhapxuat a left join userac b on a.diachin=b.id   left join userac c on a.idtao=c.id where a.loai=4 and  a.dakhoa=1 and a.soct='$soct'";
		$dong = getdong($sql);
		if ($dong['id'] == '') {
			echo "###-1###Không tìm thấy phiếu đổi trả  $soct cần duyệt    ! ";
			return;
		}
		if ((int)($dong['songay']) >= (int)($ngaygioihan3)) {
			echo "###-2###Phiếu quá hạn ! ";
			return;
		}

		$tam = $dong;
		break;
	case 14:   // phiếu bán sỉ 5 bansinhacungcap
		$sql = "SELECT  a.soct  as sochungtu,a.id,a.idkho,a.ghichu,a.idgioithieu,a.diachiN,a.LyDo,b.ten,c.ten as nv,DATE_FORMAT(a.NgayTao,'%d/%m/%Y %H:%i') as ngay,DATE_FORMAT(a.NgayTao,'%Y-%m-%d') as ngaykt,DATEDIFF(CURDATE(),a.NgayTao) as songay  from phieunhapxuat a left join userac b on a.diachin=b.id   left join userac c on a.idtao=c.id where a.loai=5 and  a.dakhoa=1 and a.soct='$soct'";
		$dong = getdong($sql);
		if ($dong['id'] == '') {
			echo "###-1###Không tìm thấy phiếu bán sỉ  $soct cần duyệt    ! ";
			return;
		}
		if ((int)($dong['songay']) >= (int)($ngaygioihan3)) {
			echo "###-2###Phiếu quá hạn ! ";
			return;
		}

		$tam = $dong;
		break;
	case 15:   // phiếu bán hàng trả lại 3 xuatkhophuchoi
		$sql = "SELECT  a.soct  as sochungtu,a.id,a.idkho,a.ghichu,a.idgioithieu,a.diachiN,a.LyDo,b.ten,c.ten as nv,DATE_FORMAT(a.NgayTao,'%d/%m/%Y %H:%i') as ngay,DATE_FORMAT(a.NgayTao,'%Y-%m-%d') as ngaykt,DATEDIFF(CURDATE(),a.NgayTao) as songay  from phieunhapxuat a left join userac b on a.diachin=b.id   left join userac c on a.idtao=c.id where a.loai=3 and  a.dakhoa=1 and a.soct='$soct'";
		$dong = getdong($sql);
		if ($dong['id'] == '') {
			echo "###-1###Không tìm thấy phiếu bán sỉ  $soct cần duyệt    ! ";
			return;
		}
		if ((int)($dong['songay']) >= (int)($ngaygioihan3)) {
			echo "###-2###Phiếu quá hạn ! ";
			return;
		}

		$tam = $dong;
		break;
	case 16:   //phục hồi phiếu bán hàng 1 xuatkhophuchoi
		$sql = "SELECT  a.soct  as sochungtu,a.id,a.idkho,a.ghichu,a.idgioithieu,a.diachiN,a.LyDo,b.ten,c.ten as nv,DATE_FORMAT(a.NgayTao,'%d/%m/%Y %H:%i') as ngay,DATE_FORMAT(a.NgayTao,'%Y-%m-%d') as ngaykt,DATEDIFF(CURDATE(),a.NgayTao) as songay  from phieunhapxuat a left join userac b on a.diachin=b.id   left join userac c on a.idtao=c.id where a.loai=1 and  a.dakhoa=1 and a.soct='$soct'";
		echo $sql;
		$dong = getdong($sql);
		if ($dong['id'] == '') {
			echo "###-1###Không tìm thấy phiếu bán hàng $soct cần duyệt    ! ";
			return;
		}
		if ((int)($dong['songay']) >= (int)($ngaygioihan3)) {
			echo "###-2###Phiếu quá hạn ! ";
			return;
		}

		$tam = $dong;
		break;

	case  17:   // đổi thông tin khách hàng 
		if (is_numeric($soct)) // kiểm tra thông tin điện thoại
		{
			$sql = "SELECT id,name from customer where  tel='$soct' ";
			$dong = getdong($sql);
			if ($dong['id'] == '') {
				echo "###-1###Không tìm thấy số điện thoại $soct này ! ";
				return;
			}
			echo "###2###$dong[id]###$dong[name]### ";
			return;
		} else {
			$sql = "SELECT  k.name,k.tel,a.soct,a.id,a.idkho,a.IDNhaCC,a.ghichu,a.idgioithieu,a.diachiN,a.LyDo,b.ten,c.ten as nv,DATE_FORMAT(a.NgayTao,'%d/%m/%Y %H:%i') as ngay,DATE_FORMAT(a.NgayTao,'%Y-%m-%d') as ngaykt ,DATEDIFF(CURDATE(),a.ngaytao) as songay  from phieunhapxuat a left join userac b on a.diachin=b.id   left join userac c on a.idtao=c.id left join customer k on a.idnhacc=k.id where a.soct='$soct'";
			$dong = getdong($sql);
			if ($dong['id'] == '') {
				echo "###-1###Không tìm thấy phiếu bán hàng $soct này ! ";
				return;
			}
			if ((int)($dong['songay']) >= (int)($ngaygioihan1)) {
				echo "###-2###Phiếu quá hạn ! ";
				return;
			}
			$tam = $dong;
			echo  "###1###$tam[id]###$tam[soct]###$tam[ten]###$tam[IDNhaCC]###$tam[idkho]###$tam[idgioithieu]###$tam[LyDo]###$tam[ghichu]###$tam[ngaykt]### Ngày tạo: <b>$tam[ngay] </b> NV tạo:<b> $tam[nv] </b> , &nbsp; Nhân viên tư vấn trên bill: <b> $tam[ten]</b>, &nbsp;   &nbsp; Khách hàng: <b>  $tam[name]  đt:  $tam[tel]</b>, &nbsp; Ghi chú: <b> $tam[ghichu]</b>   ###";
		}
		return;

	default:
		echo "###-1###Không tìm thấy phiếu thu chi $soct này ! ";
		return;
		break;
}

if ($tam) {
	echo  "###1###$tam[id]###$tam[sochungtu]###$tam[ten]###$tam[lydo]###$tam[ngaykt]### Ngày tạo: <b>$tam[ngay] </b> NV tạo:<b> $tam[nv] </b>, &nbsp; Lý do: <b> $tam[lydo]</b>&nbsp; Ghichu: <b> $tam[GhiChu]</b>   ###";
} else {
	echo "###-1###Không tìm thấy phiếu thu chi $soct này ! ";
	return;
}





$data->closedata();
