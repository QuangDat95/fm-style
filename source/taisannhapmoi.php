<?php
session_start();
if (!defined("IN_SITE")) {
	die('Hacking attempt!');
}
//=============================khoi tao ======================//  	 Xem  	 Them  	 Cap nhap  	 Tim  	Huy  	Khoa  	In
$data->setthaotac = "taisannhapmoi";
//=======================================================================================		
$donglai = "none";
$idcuahang = $_SESSION["se_kho"];
$idtao = $_SESSION["LoginID"];
$tungay = gmdate('d/m/Y', time() + 7 * 3600);
$template->assign("ngaychungtu", $tungay);
$tungay = gmdate('Y-m-d', time() + 7 * 3600);
	 
$template->assign("note2",". Tên NCC:
. Địa chỉ:
. SĐT:
. Thời gian bảo hành:
. Tình trạng:
. Khác: "); 

if ($_POST["search"] != "") {
}

if($_GET['Del']) {
	$sql = "DELETE FROM taisantam WHERE ID = ".$_GET['Del'];
	$result = $data->query($sql);
	header("location: ?act=taisannhapmoi");
	$template->parse("main.block_delsuccess");
}


if ($ql[5] || $idl == 1 || $idl == 6990 || $idl == 4647 || $idl == 2513) {
	$template->assign("tatca", "<option value='0' >Tất cả cửa hàng</option>");
	if ($_SESSION["loai_user"] == 16) {
		$chikho = "  where    IDtinh =$_SESSION[se_kho] ";
		$khuvuc = "and  IDtinh =$_SESSION[se_kho] ";
	} else {
		$chikho = "  where   ID >0";
	}
	$template->assign("kho", composx("cuahang", "Name", "ID", " where idnhomcc<>8 and id>0 $khuvuc order by ID "));
} else {
	$template->assign("kho", composx("cuahang", "Name", "ID", " where ID= $_SESSION[se_kho]  order by ID "));
}

if ($_POST["cancel"] != "") {
	$ID = "";
	$_GET["id"] = "";
}
 

$tam = "";
$kt = 0;


if ($_REQUEST["id"] == ""  || $them  || $xoa || $_POST["search"] != "") {

	

	if ($them) {
		$template->parse("main.block_cusupdate");
	}

	if (isset($_POST['search'])) {
		$cuahangtim  = laso($_REQUEST["cuahangtim"]);
		$manv  = chonghack(trim($_REQUEST["manv"]));
		$tungay  = trim($_REQUEST["tungay"]);
		$denngay  = trim($_REQUEST["denngay"]);
		$tinhtrang  = laso($_REQUEST["tinhtrang"]);
		// echo $tinhtrang . "=====".$cuahangtim . "====". $tungay . "====". $denngay. "====";
		$template->assign("manv", $manv);
		$template->assign("tinhtrang" . $tinhtrang, "selected");
		$template->assign("tungay", $tungay);
		$template->assign("denngay", $denngay);
		$template->assign("kho", composx("cuahang", "Name", $cuahangtim, " where ID= $_SESSION[se_kho] order by ID "));

		$sql_where = " WHERE 1=1 ";

		if ($cuahangtim > 0)   $sql_where .= " and a.cuahang='" . $cuahangtim . "'";
		if ($tinhtrang != "") {
			if ($tinhtrang == 6) $sql_where .= " and d.tinhtrang = 6 "; 
			else if ($tinhtrang == 7) $sql_where .= " and d.tinhtrang = 7 ";
			else if ($tinhtrang == 4) $sql_where .= " and d.tinhtrang = 4 ";
		}

		if ($manv != '')   $sql_where .= " and c.manv = '" . $manv . "'";

		if ($tungay != "") {
			$ngay =  explode('/', $tungay);
			if (strlen($ngay[1]) == 1) {
				$ngay[1] = "0" . $ngay[1];
			}
			if (strlen($ngay[0]) == 1) {
				$ngay[0] = "0" . $ngay[0];
			}
			$sql_where .= " and a.ngaytao>= '$ngay[2]-$ngay[1]-$ngay[0]'   ";
		}
		if ($denngay != "") {
			$ngay =  explode('/', $denngay);
			if (strlen($ngay[1]) == 1) {
				$ngay[1] = "0" . $ngay[1];
			}
			if (strlen($ngay[0]) == 1) {
				$ngay[0] = "0" . $ngay[0];
			}
			$sql_where .= " and  a.ngaytao<= '$ngay[2]-$ngay[1]-$ngay[0] 23:59'   ";
		}

		$sql = "SELECT a.ID, a.ngaytao, a.ngaykhoa, b.Name as tencuahang, c.MaNV, c.Ten as tennv, a.Name as tentaisan, a.ma as mataisan, a.soluong, a.gia, d.tinhtrang, d.nguoinhan, d.nguoichi, d.lydo, a.dakhoa
		FROM taisantam a 
		LEFT JOIN cuahang b ON a.cuahang = b.ID 
		LEFT JOIN userac c ON a.idtao = c.ID 
		LEFT JOIN thuchikt d ON a.ma = d.sochungtu 
		 ". $sql_where . " ORDER BY a.ngaytao DESC";
	} else {
		$date_now = date("Y-m-d");

		$sql = "SELECT a.ID, a.ngaytao, a.ngaykhoa, b.Name as tencuahang, c.MaNV, c.Ten as tennv, a.Name as tentaisan, a.ma as mataisan, a.soluong, a.gia, d.tinhtrang, d.nguoinhan, d.nguoichi, d.lydo, a.dakhoa
		FROM taisantam a 
		LEFT JOIN cuahang b ON a.cuahang = b.ID 
		LEFT JOIN userac c ON a.idtao = c.ID 
		LEFT JOIN thuchikt d ON a.ma = d.sochungtu 
		WHERE a.ngaytao BETWEEN '$date_now 00:00:00' AND '$date_now 23:59:59' 
		ORDER BY a.ngaytao DESC";
	}
	
	if ($_SESSION["admintuan"]) echo $sql;
	$query_rows = $data->query($sql);
	$result = $data->query($sql);
	//=========================================================
	$i = 0;
	while ($re = $data->fetch_array($result)) {
		if ($mau == "white")  $mau = "#EEEEEE";
		else  $mau = "white";
		$template->assign("color", $mau);
		$template->assign("ID", $re["ID"]);
		$template->assign("XOA", $re["ID"]);
		$template->assign("stt", $i + 1);
		$template->assign("ngaytao", $re["ngaytao"]);
		$template->assign("ngaykhoa", $re["ngaykhoa"]);
		$template->assign("tencuahang", $re["tencuahang"]);
		$template->assign("MaNV", $re["MaNV"]);
		$template->assign("tennhanvien", $re["tennv"]);
		$template->assign("tentaisan", $re["tentaisan"]);
		$template->assign("ngaytao", date('d-m-Y H:i:s', strtotime($re["ngaytao"])));
		if (!empty($re['ngaykhoa'])) {
			$template->assign("ngaykhoa", date('d-m-Y H:i:s', strtotime($re["ngaykhoa"])));
		}
		$template->assign("mataisan", $re["mataisan"]);
		$template->assign("soluong", $re["soluong"]);
		$template->assign("gia", number_format($re["gia"])."đ");
		$template->assign("lydo", $re["lydo"]);
		
		if ($re["dakhoa"] == 0) {
			$tinhtrang = "Chưa khoá" ;
			$disable_button = "" ;
		} else if ($re["dakhoa"] == 1) {
			$tinhtrang = "Đã khoá";
			$disable_button = "style='display:none;'" ;
		}
		$template->assign("disable_button", $disable_button);
		$template->assign("tinhtrang", $tinhtrang);
		$template->assign("nguoinhan", $re["nguoinhan"]);
		$template->assign("nguoichi", $re["nguoichi"]);

		$template->parse("main.block_cusht");

		$i++;
	}
	$template->assign("type", $cuahang);
	$template->parse("main.block_cusht1");
	$template->parse("main.block_cusht2");
} else {

	if ($_REQUEST["id"] == "-1") {

		$template->assign("t-c", "Thêm Mới Tài Sản");

		if ($_SESSION["LoginID"] == 1 || $_SESSION["LoginID"] == 2 || $_SESSION["LoginID"] == 179) {
			$template->assign("cuahang", composx("cuahang", "Name", "ID", " where ID>0 order by ID "));
			if ($_SESSION["loai_user"] == 6  || $_SESSION["LoginID"] == 1 || $_SESSION["LoginID"] == 179)    $template->assign("tatca", ' <option value="" >Tất cả</option>');
		} else {
			$template->assign("cuahang", composx("cuahang", "Name", "ID", " where ID= $_SESSION[se_kho]  order by ID "));
		}

		$template->assign("cay", compoloai("taisannhom", "ma", "Name", "", "where 1 order by Name desc "));

		$template->assign("nganhang", compoloai("taikhoannganhang", "ma", "Name", 0, ""));
		$template->assign("nhacungcap", composx("nhacungcap", "ID", "ID", " order by Name  "));
		$template->assign("loainhom", $taocaydata);


		$template->assign("chonggoilai", gmdate('d/m/Y H:i:s', time() + 7 * 3600));
		if ($idl == 1 || $idl == 4647) $cuahang = "";
		else $cuahang = " and  cuahang = $_SESSION[se_kho]    ";

		// $template->assign("nhanvienonline", compoloai("userac", "MaNV", "Ten", 0, " where 1 $cuahang  ") . compoloai("nhanviennhieucuahang", "Name", "manv", 0, " "));
		$template->assign("ngaytao",  gmdate('d/m/Y', time() + 7 * 3600));
		$template->assign("kho", composx("cuahang", "Name", $_REQUEST["idcuahang"], "ID"));

		if ($_SESSION["LoginID"] == 1 || $_SESSION["LoginID"] == 2) {
			$template->parse("main.block_cus.block_admin");
		} else {
			$template->assign("tencuahang", $_SESSION["S_tencuahang"]);
			$template->parse("main.block_cus.block_cuahang");
		}
	} else {
		// $template->assign("chonggoilai", gmdate('d/m/Y H:i:s', time() + 7 * 3600));
		
		$sql = "SELECT * FROM taisantam WHERE ID = ".  $_GET["id"];
		$query = $data->query($sql);
		$result = $data->fetch_array($query);

		$template->assign("t-c", "Cập Nhật Tài Sản");
		$template->assign("cuahang", composx("cuahang", "Name", $result["cuahang"], "ID"));

		// if ($idtao == 1 || $idtao == 4647) $cuahang = "";
		// else $cuahang = " and  cuahang = $_SESSION[se_kho]    ";
		// $template->assign("kho", composx("cuahang", "Name", $result["cuahang"], "ID"));
		// $template->assign("nhanvienonline", compoloai("userac", "Ten", "MaNV", $result["IDNV"], " where 1  $cuahang  "));

		$template->assign("ngaychungtu", date("d/m/Y", strtotime($result["ngaytao"])));

		$template->assign("ma", $result["ma"]);
		$template->assign("idts", $result["ID"]);
		$template->assign("Name", $result["Name"]);
		$template->assign("mota", $result["mota"]);
		$template->assign("type".$result["type"], "selected");
		$template->assign("cay", compoloai("taisannhom", "ma", "Name", $result['nhomtaisan'], "where 1 order by Name desc "));
		$template->assign("soluong",$result['soluong']);
		$template->assign("gia",$result['gia']);
		$template->assign("donvi".$result['donvitinh'],"selected");

		if ($result["dakhoa"] == 0) {
			$disable_button = "" ;
		} else if ($result["dakhoa"] == 1) {
			$disable_button = "disabled" ;
		}
		$template->assign("disable_button",$disable_button);

		$newDate1 = date('d/m/Y', strtotime($result["ngaybatdau"]));
		$newDate2 = date('d/m/Y', strtotime($result["ngayketthuc"]));

		$template->assign("ngaybatdau", $newDate1);
		$template->assign("ngayketthuc", $newDate2);
		
		$template->assign("macuahang", $result["macuahang"]);
		$template->assign("note2", $result["note"]);

		// $template->assign("capnhapct", " readonly='readonly' ");

		if ($_SESSION["LoginID"] == 1 || $_SESSION["LoginID"] == 2) {
			$template->parse("main.block_cus.block_admin");
		} else {
			$template->assign("tencuahang", $_SESSION["S_tencuahang"]);
			$template->parse("main.block_cus.block_cuahang");
		}
	}
	$template->assign("donglai", $donglai);
	$template->parse("main.block_cus");
}
 

$data->closedata();
