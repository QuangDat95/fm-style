<?php
session_start();

if ($_SESSION["dangnhap"] == "") return;
include(getcwd() . "/cauhinhtailenvandonluubien.php");
$IDTao = $_SESSION["LoginID"];

$_SESSION["frm_xuathang"] = "";
if (!defined("IN_SITE")) {
	die('Hacking attempt!');
}
$ngaytao = date('Y-m-d H:i:s');
//echo "ok";
//=============================khoi tao ======================//  	 Xem  	 Them  	 Cap nhap  	 Tim  	Huy  	Khoa  	In

//=====================================================
$ql = $quyen[$_SESSION["mangquyenid"][$act]];
if (!($ql[0] || $idl == 1)) {
	echo "Bạn không có phân quyền";
	exit;
	return;
}

if ($ql[1] > 0 || $idl == 1) {
	$template->assign("q_luu", "");
} else {
	$template->assign("q_luu", "none");
}
if ($ql[2] > 0 || $idl == 1) {
	$template->assign("q_khoa", "");
} else {
	$template->assign("q_khoa", "none");
}
if ($ql[3] > 0 || $idl == 1) {
	$template->assign("q_huy", "");
} else {
	$template->assign("q_huy", "none");
}
if ($ql[4] > 0 || $idl == 1) {
	$template->assign("q_xoa", "");
} else {
	$template->assign("q_xoa", "none");
}
//=====================================================	   


if ($_POST["cancel"] != "") {
	$ID = "";
	$_GET["id"] = "";
}


if ($_POST["btnUpdate"] != "") {
	$ID = $_GET['key'];
	$ma = $_POST['matrangthai'];
	$ten = $_POST['tentrangthai'];
	$loai = $_POST['loaitrangthai'];
	$ghichu = $_POST['ghichu'];
	if ($ID != -1) {
		$sql = "update trangthaicuoi set matrangthai = '$ma',tentrangthai = '$ten', loaitrangthai = '$loai', ghichu = '$ghichu' where ID= '$ID'";
	} else {
		$sql = "insert into trangthaicuoi (matrangthai,tentrangthai,loaitrangthai,ghichu) values ('$ma','$ten','$ngaytao','$ghichu')";
	}
	$update = $data->query($sql);
	if ($update) {
		$template->parse("main.block_capnhat.block_success");
	} else {
		$template->parse("main.block_capnhat.block_fail");
	}
	$template->parse("main.block_capnhat");
}

if ($_GET["del"] != "") {
	$del = $_GET["del"];
	$sql = "delete from trangthaicuoi where ID='$del'";
	$update = $data->query($sql);
	$template->parse("main.block_xoa");
}

if (isset($_GET['key'])) {
	$key = $_GET['key'];
	
	if($key != -1) {
		$sql = "select *  from trangthaicuoi where ID='$key'";
		$dong = getdong($sql);

		$template->assign("t-c", "Cập nhật trạng thái cuối");
		$template->assign("ID", $dong["ID"]);
		$template->assign("matrangthai", $dong["matrangthai"]);
		$template->assign("tentrangthai", $dong["tentrangthai"]);
		$template->assign("loaitrangthai".$dong["loaitrangthai"], "Selected ='selected'");
		$template->assign("ghichu", $dong["ghichu"]);

	} else {
		$template->assign("t-c", "Thêm mới trạng thái cuối");
	}
	
	$template->parse("main.block_update");
} else {

	if (isset($_POST['tim_'])) {
		$tenma = $_POST["tenma"];
		$loai = $_POST['timloai'];
	}
	$sqlwhere = "where 1=1";
	if ($tenma) {
		$sqlwhere .= " and (matrangthai like '%$temma%' or tentrangthai like '%$tenma%') ";
		$template->assign("tenma", $tenma);
	}
	if($loai) {
		$sqlwhere .= " and loaitrangthai = $loai ";
		$template->assign("timloai".$loai,"selected='selected'");
	}
	$sql = "SELECT * FROM trangthaicuoi $sqlwhere ORDER BY loaitrangthai ASC";

	$query = $data->query($sql);
	while ($re = $data->fetch_array($query)) {
		if($re['loaitrangthai'] == 1) {
			$loaitrangthai = "Đơn thành công";
		} else if($re['loaitrangthai'] == 2) {
			$loaitrangthai = "Đơn huỷ";
		} else if($re['loaitrangthai'] == 3) {
			$loaitrangthai = "Đơn hoàn";
		}
		$template->assign("ID", $re["ID"]);
		$template->assign("matrangthai", $re["matrangthai"]);
		$template->assign("tentrangthai", $re["tentrangthai"]);
		$template->assign("loaitrangthai", $loaitrangthai);
		$template->assign("ghichu", $re["ghichu"]);
		
		$template->parse("main.block_cus.block_table");
	}
	// echo "Hải ";
	$template->parse("main.block_cus");
}
