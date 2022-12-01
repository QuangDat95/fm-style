<?php
session_start();
if (!defined("IN_SITE")) {
	die('Hacking attempt!');
}
$ql = $quyen[$_SESSION["mangquyenid"][$act]];
if (!($ql[0] || $idl == 1)) {
	echo "Bạn không có phân quyền";
	exit;
	return;
}
//=============================khoi tao ======================//  	 Xem  	 Them  	 Cap nhap  	 Tim  	Huy  	Khoa  	In
$data->setthaotac = "capnhaptuvan";
//=======================================================================================		
$donglai = "none";
$idcuahang = $_SESSION["se_kho"];
$idtao = $_SESSION["LoginID"];
$tungay = gmdate('d/m/Y', time() + 7 * 3600);
$template->assign("tungay", $tungay);
$tungay = gmdate('Y-m-d', time() + 7 * 3600);
$sql_where = " where  a.ngaytao>= '$tungay' ";

if ($_POST["search"] != "") {
	$sql_where = " where loaiphieu=1 ";

	$cuahangtim  = laso($_REQUEST["cuahangtim"]);
	$tungay  = trim($_REQUEST["tungay"]);
	$toingay  = trim($_REQUEST["toingay"]);
	$template->assign("tungay", $tungay);
	$template->assign("toingay", $toingay);
	if ($cuahangtim > 0)   $sql_where .= " and a.idcuahang='" . $cuahangtim . "'";
	if ($tungay != "") {
		$ngay =  explode('/', $tungay);
		if (strlen($ngay[1]) == 1) {
			$ngay[1] = "0" . $ngay[1];
		}
		if (strlen($ngay[0]) == 1) {
			$ngay[0] = "0" . $ngay[0];
		}
		$sql_where .= " and    a.ngaytao>= '$ngay[2]-$ngay[1]-$ngay[0]'   ";
	}
	if ($denngay != "") {
		$ngay =  explode('/', $denngay);
		if (strlen($ngay[1]) == 1) {
			$ngay[1] = "0" . $ngay[1];
		}
		if (strlen($ngay[0]) == 1) {
			$ngay[0] = "0" . $ngay[0];
		}
		$sql_where .= "  and    a.ngaytao<= '$ngay[2]-$ngay[1]-$ngay[0] 23:59'   ";
	}
}
if ($_SESSION["LoginID"] == 1 || $_SESSION["LoginID"] == 2 || $_SESSION["LoginID"] == 6990) {
	$template->assign("kho", composx("cuahang", "Name", "$cuahangtim", " where idnhomcc<>8 and ID >0"));
	$template->assign("tatca", '<option value="" >Tất cả</option>');
} else   $template->assign("kho", composx("cuahang", "Name", $_SESSION["se_kho"], "Name"));


if ($_POST["cancel"] != "") {
	$ID = "";
	$_GET["id"] = "";
}



if ($_POST["btnUpdate"] != "") {

	$ID  	  =	   $_GET["id"];
	$Name 	  =    $_POST["Name"];
	$idcuahang  =    laso($_POST["cuahang"]);
	//echo $idcuahang;return;
	$sochungtu =   trim(chonghack($_POST["sochungtu"]));
	$loaicapnhat = laso($_POST["loaicapnhat"]);
	if ($loaicapnhat == 20) {
		$tuvandung  =    "Phục hồi phiếu tăng ca&*!20&*!" . trim(chonghack($_POST["manv"]))."&*!".date("d-m-Y",strtotime($_POST["ngay"]));
		$tuvansai  =    "Phục hồi phiếu tăng ca&*!20&*!" . trim(chonghack($_POST["manv"]))."&*!".date("d-m-Y",strtotime($_POST["ngay"]));
	} else if ($loaicapnhat == 21) {
		$tuvandung  =    "Phục hồi phiếu bù giờ&*!21&*!" . trim(chonghack($_POST["manv"]))."&*!".date("d-m-Y",strtotime($_POST["ngay"]));
		$tuvansai  =   "Phục hồi phiếu bù giờ&*!21&*!" . trim(chonghack($_POST["manv"]))."&*!".date("d-m-Y",strtotime($_POST["ngay"]));
	} else if ($loaicapnhat == 22) {
		$tuvandung  =     "Hủy giờ quét đi làm sai&*!22&*!" . trim(chonghack($_POST["manv"]))."&*!".date("d-m-Y",strtotime($_POST["ngay"]));
		$tuvansai  =     "Hủy giờ quét đi làm sai&*!22&*!" . trim(chonghack($_POST["manv"]))."&*!".date("d-m-Y",strtotime($_POST["ngay"]));
	} else if ($loaicapnhat == 23) {
		$tuvandung =    "Hủy giờ quét tăng ca sai&*!23&*!" . trim(chonghack($_POST["manv"]))."&*!".date("d-m-Y",strtotime($_POST["ngay"]));
		$tuvansai  =     "Hủy giờ quét tăng ca sai&*!23&*!" . trim(chonghack($_POST["manv"]))."&*!".date("d-m-Y",strtotime($_POST["ngay"]));
	}

	$lydo =   chonghack(addslashes($_POST["lydo"]));
	// $ngay =  explode('/', $ngay);
	// if (strlen($ngay[1]) == 1) {
	// 	$ngay[1] = "0" . $ngay[1];
	// }
	// if (strlen($ngay[0]) == 1) {
	// 	$ngay[0] = "0" . $ngay[0];
	// }
	// $ngay = $ngay[2] . '-' . $ngay[1] . '-' . $ngay[0];
	$ngaytao = gmdate('Y-m-d H:i:s', time() + 7 * 3600);

	// if ($_SESSION['chonggoilai'] == $_REQUEST['chonggoilai']) return;
	// echo $ngaytao;
	if ($_GET["id"] == "-1") {

		$sql = "insert into phieuyeucau set lydo='$lydo',sochungtu='$sochungtu', idcuahang ='$idcuahang',ngaytao ='$ngaytao',thongtinsai ='$tuvansai',thongtindung ='$tuvandung' ,idtao=$idtao,tinhtrang=111,loaiphieu=1 ";
		// echo $sql;
		// return;
		$update = $data->query($sql);
		$_SESSION['chonggoilai'] = $_REQUEST['chonggoilai'];
	} else {
		$sql = "UPDATE  phieuyeucau  set lydo='$lydo' ,thongtindung ='$tuvandung',thongtinsai='$tuvansai',ngaytao='$ngaytao',idtao=$idtao  where ID='0$ID'  and idtao=$idtao and tinhtrang=111 ";
		//  echo $sql ;
		if (($ql[4] || $idl == 1)) $update = $data->query($sql);
		$_SESSION['chonggoilai'] = $_REQUEST['chonggoilai'];
		//  return ;
	}


	$them = true;
}
$del =  laso($_GET["Del"]);
if ($del > 0) {


	if ($ktxoa == 1 && $_POST["search"] == "") {
		$template->parse("main.block_khongxoa");
	}
	if ($del != "") {
		$IDD = $_GET["Del"];
		//echo $IDD;
		if ($_SESSION['admintuan']) $dieukiem = '';
		else  $dieukiem = " and idtao= '$idtao' and tinhtrang=111 ";
		$sql = "delete from  phieuyeucau where  ID = '0" . $IDD . "'  $dieukiem ";
		echo $sql;
		$update = $data->query($sql);
		$xoa = true;
	}
} {
	$tam = "";
	$kt = 0;

	if ($_REQUEST["id"] == ""  || $them  || $xoa || $_POST["search"] != "") {


		$template->assign("type", $cuahang);

		$template->parse("main.block_cusht1");


		$sql = "SELECT a.id FROM phieuyeucau a ";
		$sql .= $sql_where;
		//echo $sql ;
		$query_rows = $data->query($sql);
		$num = $data->num_rows($query_rows);
		if ($them) {
			$template->parse("main.block_cusupdate");
		}
		//$SOST = 0 ;
		// phan trang===================================================================
		$page_start = 0;
		$page_row = 200;
		include("paging.php");
		$list_page = paging($num);
		$sql = "SELECT a.tinhtrang,a.ID,a.sochungtu,a.idcuahang,a.thongtinsai,a.thongtindung,b.name as tencuahang,DATE_FORMAT(a.ngaytao,'%d/%m/%Y %h:%i') as ngaytao,DATE_FORMAT(a.ngayxacnhan3,'%d/%m/%Y') as ngayduyet,a.lydo FROM phieuyeucau a left join cuahang b on a.idcuahang=b.id   " . $sql_where . " ORDER BY a.ID desc limit $page_start,$page_row ";
		if ($_SESSION["admintuan"]) echo $sql;
		$query_rows = $data->query($sql);
		$result_rows = $data->num_rows($query_rows);
		$result = $data->query($sql);
		$i = $page_start;
		$mangnhanvien = taomang("userac", "MaNV", "ten", " where tinhluong = '1'  ");
		$mangteams = taomang("lydonhapxuat", "ID", "Name", "");
		//=========================================================

		while ($rec = $data->fetch_array($result)) {
			if ($mau == "white")  $mau = "#EEEEEE";
			else  $mau = "white";
			$template->assign("color", $mau);
			$template->assign("ID", $rec["ID"]);
			$template->assign("XOA", $rec["ID"]);
			$template->assign("stt", $i + 1);
			$template->assign("ngaytao", $rec["ngaytao"]);
			$template->assign("lydo", $rec["lydo"]);
			$template->assign("tencuahang", $rec["tencuahang"]);
			$template->assign("ngayduyet", $rec["ngayduyet"]);
			$arrdung = explode('&*!', $rec["thongtindung"]);
			$arrsai = explode('&*!', $rec["thongtinsai"]);

			if ($arrdung[1] == 20) {
				$template->assign("tuvandung", $arrdung[0] . ': ' . $arrdung[2]." - ".date("d/m/Y",strtotime($arrdung[3])));
				$template->assign("tuvansai", $arrsai[0] . ': ' . $arrsai[2]." - ".date("d/m/Y",strtotime($arrsai[3])));
			} else if ($arrdung[1] == 21) {
				$template->assign("tuvandung", $arrdung[0] . ': ' . $arrdung[2]." - ".date("d/m/Y",strtotime($arrdung[3])));
				$template->assign("tuvansai", $arrsai[0] . ': ' . $arrsai[2]." - ".date("d/m/Y",strtotime($arrsai[3])));
			} else if ($arrdung[1] == 22) {
				$template->assign("tuvandung", $arrdung[0] . ': ' . $arrdung[2]." - ".date("d/m/Y",strtotime($arrdung[3])));
				$template->assign("tuvansai", $arrsai[0] . ': ' . $arrsai[2]." - ".date("d/m/Y",strtotime($arrsai[3])));
			} else if ($arrdung[1] == 23) {
				$template->assign("tuvandung", $arrdung[0] . ': ' . $arrdung[2]." - ".date("d/m/Y",strtotime($arrdung[3])));
				$template->assign("tuvansai", $arrsai[0] . ': ' . $arrsai[2]." - ".date("d/m/Y",strtotime($arrsai[3])));
			}
			
			$template->assign("tennv", $mangnhanvien[$arrdung[2]]. " - ". $arrdung[2]);

			//thumua=cuahang,ketoan=giamsat,giamdoc=admin

			$tinhtrang = "Chờ xử lý";
			$tam = $rec['tinhtrang'] . "111";
			$ketoan = $tam[1];
			$thumua = $tam[0];
			$giamdoc = $tam[2];
			$tinhtrang = "Mới tạo";
			if ($giamdoc == 4) {
				$tinhtrang = "Đã duyệt";
			} elseif ($ketoan == 3)  $tinhtrang = "Không duyệt";
			elseif ($ketoan == 2)  $tinhtrang = "Chờ thông tin";
			elseif ($ketoan == 4)  $tinhtrang = "Chờ admin duyệt";
			elseif (($ketoan == 1 || $ketoan == 2) && $thumua == 4)  $tinhtrang = "Chờ giám sát duyệt";
			elseif ($thumua == 3)  $tinhtrang = "Không duyệt";
			elseif ($thumua == 2)  $tinhtrang = "Chờ thông tin";
			elseif ($thumua == 4)  $tinhtrang = "Chờ giám sát duyệt";
			elseif ($thumua == 1 || $thumua == 2)  $tinhtrang = "Chờ cửa hàng duyệt";



			$template->assign("tinhtranggoc", $re['tinhtrang']);

			$template->assign("tinhtrang", $tinhtrang . $re['tinhtrang']);
			$template->parse("main.block_cusht");

			$i++;
		}
		$template->assign("list_page", $list_page);  // phan trang
		$template->parse("main.block_cusht2");
	} else {

		if ($_REQUEST["id"] == "-1") {

			//$template->assign("loaisai1",'loaicapnhathidden');
			$template->assign("t-c", "Thêm Mới Yêu Cầu ");
			$template->assign("cuahang", $_SESSION["se_kho"]);
			$template->assign("chonggoilai", gmdate('d/m/Y H:i:s', time() + 7 * 3600));
			if ($idtao == 1 || $idtao == 4647) $cuahang = "";
			else $cuahang = " and  cuahang = $_SESSION[se_kho]    ";
			$template->assign("nhanvienhethong", compoloai("userac", "ten", "manv", 0, " where tinhluong=1 "));
			$template->assign("ngaytao",  gmdate('d/m/Y', time() + 7 * 3600));
			if ($ql[5]) {
				$template->assign("kho", composx("cuahang", "Name", '', "ID"));
			} else {
				$template->assign("kho", composx("cuahang", "Name", $idcuahang, "ID"));
			}

			$template->assign("nhanvienonline", compoloai("userac", "ten", "manv", 0, " where  tinhluong=1 "));

			$template->assign("lydocp", compoloai("lydonhapxuat", "ma", "Name", "", "where Loai ='1' order by Rank desc "));
			if ($_SESSION["LoginID"] == 1 || $_SESSION["LoginID"] == 2) {
				$template->parse("main.block_cus.block_admin");
			} else {
				$template->assign("tencuahang", $_SESSION["S_tencuahang"]);
				$template->parse("main.block_cus.block_cuahang");
			}
		} else {
			$template->assign("chonggoilai", gmdate('d/m/Y H:i:s', time() + 7 * 3600));
			$sql = "SELECT a.thongtindung,a.sochungtu, DATE_FORMAT(a.ngaytao,'%d/%m/%Y') as ngaytao,b.macuahang,b.name as tencuahang,b.id as idcuahang ,a.lydo FROM  phieuyeucau a left join cuahang b on a.idcuahang=b.id WHERE a.ID='" . $_REQUEST["id"] . "'";
			$query = $data->query($sql);
			$result = $data->fetch_array($query);
			
			$template->assign("t-c", "Cập nhập Yêu Cầu");
			if ($idtao == 1 || $idtao == 4647) $cuahang = "";
			else $cuahang = " and  cuahang = $_SESSION[se_kho]    ";

			$template->assign("cuahang", $result["idcuahang"]);
			$template->assign("lydo", $result["lydo"]);
			$template->assign("macuahang", $result["macuahang"]);
			$template->assign("capnhapct", " readonly='readonly' ");
			$arrdung = explode('&*!', $result["thongtindung"]);
			$arrsai = explode('&*!', $result["thongtinsai"]);

			$template->assign("nhanvienonline", compoloai("userac", "ten", "manv", $result["thongtindung"], " where tinhluong=1  $cuahang  "));
			//	$template->assign("khachhang", compoloai("customer","Name","tel",'',""));
			$template->assign("nhanvienhethong", compoloai("userac", "ten", "manv", 0, " where tinhluong=1 "));

			$template->assign("nhanvienonline", compoloai("userac", "ten", "manv", 0, " where  tinhluong=1 "));
			$template->assign("lydocp", compoloai("lydonhapxuat", "ma", "Name", "", "where Loai ='1' order by Rank desc "));

			//var_dump($arrsai[2]);

			if ($ql[5]) {
				$template->assign("kho", composx("cuahang", "Name", '', "ID"));
			} else {
				$template->assign("kho", composx("cuahang", "Name", $idcuahang, "ID"));
			}

			$template->assign("loaidse" . $arrdung[1], 'selected="selected"');
			// $template->assign("loaisai" . $arrdung[1], 'loaicapnhatshow');
			$template->assign("manv", $arrdung[2]);
			$template->assign("ngay", date("Y-m-d",strtotime($arrdung[3])));
			// if ($arrdung[1] == 1) {
			// 	$template->assign("nhanvienhethong", compoloai("userac", "ten", "manv", $arrdung[2], " where tinhluong=1 "));
			// } else if ($arrdung[1] == 2) {
			// 	$template->assign("nhanvienonline", compoloai("userac", "ten", "manv", $arrdung[2], " where  tinhluong=1 "));
			// 	$template->assign("loaidse2", 'selected="selected"');
			// } else if ($arrdung[1] == 3) {
			// 	$template->assign("lydocp", compoloai("lydonhapxuat", "ma", "Name", $arrdung[2], "where Loai ='1' order by Rank desc "));
			// } else if ($arrdung[1] == 4) {
			// 	$template->assign("ghichu", $arrdung[2]);
			// 	$template->assign("ghichusai", $arrsai[2]);
			// } else if ($arrdung[1] == 5 || $arrdung[1] == 6 || $arrdung[1] == 7 || $arrdung[1] == 8 || $arrdung[1] == 9 || $arrdung[1] == 10 || $arrdung[1] == 11 || $arrdung[1] == 12 || $arrdung[1] == 13 || $arrdung[1] == 14 || $arrdung[1] == 15  || $arrdung[1] == 16) {
			// 	$template->assign("phieuthuchi", $arrdung[2]);
			// 	$template->assign("sochungtu", $arrdung[2]);
			// } else if ($arrdung[1] == 17) {

			// 	// $template->assign("khachhang", compoloai("customer","Name","tel",$arrdung[2],"") );
			// 	$template->assign("loaidse17", 'selected="selected"');
			// }

			if ($_SESSION["LoginID"] == 1 || $_SESSION["LoginID"] == 2)
				$template->parse("main.block_cus.block_admin");
			else  $template->parse("main.block_cus.block_cuahang");
		}
		$template->assign("donglai", $donglai);
		$template->parse("main.block_cus");
	}
}

$data->closedata();
