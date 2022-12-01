<?php
session_start();



$root_path = getcwd() . "/";
$quyen = $_SESSION["quyen"];

$ql = $quyen[$_SESSION["mangquyenid"][$_SESSION['act']]];
$idl = $_SESSION["LoginID"];
//var_dump($_SESSION["mangquyenid"]['baocaokhuyenmai']);
//$ql[5]=5;
if (!($ql[0] || $idl == 1)) {
	return;
}



include($root_path . "includes/config.php");
include($root_path . "includes/removeUnicode.php");
include($root_path . "includes/class.paging.php");
include($root_path . "includes/class.mysql.php");
include($root_path . "includes/function.php");




$data = new class_mysql();
$data->config();
$data->access();

if (isset($_POST["dataexel"])) {

	$data1 = $_POST['dataexel'];
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
	$nguoixacnhan = trim($tmp[32]);
	$dinhkhoanthuchi = trim($tmp[33]);
	//$dinhkhoanthuchi= trim($tmp[34]);
	// echo $nguoixacnhan;
	//echo "<br>";
	if (!$limit) {
		$limit = 20;
	}

	//var_dump(in_array(strtoupper($dinhkhoan),$mangOlDuyetAll));
	//return;
	///++++++++++++++++++++++++++++++++++++++
	if (!$curentpage) {
		$curentpage = 1;
	}



	// if ($trang!=0  ) $limit  =  " LIMIT ". 10000*($trang-1) .", ". 10000*($trang); else $limit =" limit 10000";
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

	if ($mavd != "") {
		$sql_where .= " and a.mavandon = '$mavd'";
		$sql_ton .= " and a.mavandon = '$mavd'";
	}
	if ($dvvc != "") {
		$sql_where .= " and a.donvivc = '$dvvc'";
		$sql_ton .= " and a.donvivc = '$dvvc'";
	}
	if ($ncc != "") {
		$sql_where .= " and e.Name like '%$ncc%'";
		//$sql_ton.=" and e.Name like '%$ncc%'"; 

	}
	if ($ngaytaotu != ""  && $ngaytaoden == "") {
		$sql_where .= " and a.ngaytao >='$ngaytaotu'";
		$sql_ton .= " and a.ngaytao < '$ngaytaotu'";
	}
	//if($ngaytaotu == ""  && $ngaytaoden==""){$sql_ton.=" and a.ngaytao < '1001-01-01'"; }
	if ($ngaytaotu != ""  && $ngaytaoden != "") {
		$sql_where .= " and a.ngaytao >='$ngaytaotu' and a.ngaytao <='$ngaytaoden'";
	}
	if ($phieuxuat != "") {
		$sql_where .= " and f.SoCT = '$phieuxuat'";
		//$sql_ton.=" and f.SoCT = '$phieuxuat'"; 

	}
	//if($tkno != ""){ $sql_where.=" and a.tkno = '$manv'"; }
	//if($tkco != ""){ $sql_where.=" and c.manv = '$manv'"; }
	if ($nguoixacnhan != "") {
		if ($nguoixacnhan != 4) {
			$sql_where .= " and d.xacnhan = '$nguoixacnhan'";
		} else if ($nguoixacnhan == 4) {
			$sql_where .= " and a.phieuxuat is not null  and a.phieuxuat<> 0";
		}
	}

	if ($dinhkhoan != "") {
		$sql_where .= " and (d.ma = '$dinhkhoan' or d.ten like '%$dinhkhoan%')";
		//$sql_ton.=" and (d.ma = '$dinhkhoan' or d.ten like '%$dinhkhoan%')"; 
	}
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

	if ($manv != "") {
		$sql_where .= " and a.manv = '$manv'";
		$sql_ton .= " and a.manv = '$manv'";
	}
	if ($ten != "") {
		$sql_where .= " and c.ten = '$ten'";
		//$sql_ton.=" and c.ten = '$ten'"; 
	}
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
		//	$sql_ton.=" and c.idtinh =  '$kho' ";
	}

	if ($dinhkhoanthuchi) {
		$sql_where .= " and d.ID in ($dinhkhoanthuchi) ";
		//$sql_ton.=" and d.ID  in ($dinhkhoanthuchi) ";
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
		$sql_where_chuaload  .= "  a.NgayNhap>= '$ngay[2]-$ngay[1]-$ngay[0]'";
		$sql_ton  .= " and  a.ngaythuchi< '$ngay[2]-$ngay[1]-$ngay[0]'";
	} else {
		$sql_ton .= " and  a.ngaythuchi < '1001-01-01'";
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
		$sql_where_chuaload  .= " and  a.NgayNhap<='$ngay[2]-$ngay[1]-$ngay[0]'";
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


	if (isset($_POST["exeltralai"])  && $_POST["exeltralai"] != '') {


		$mang = $_SESSION["mangxuatexeltralai"];


		include_once("includes/xlsxwriter.class.php");
		$today = date("d-m-Y h:m:s");
		$filename = "thuchitailen" . $today . ".xlsx";
		$writer = new XLSXWriter();
		$writer->setAuthor('datdoan');

		$writer->writeSheetHeader('Sheet1', array("Ngày thu chi" => "string", "CH/BP" => "string", "THU/CHI" => "string", "Mã" => "string", "Khoản mục thu chi" => "string", "Diễn giải" => "string", "Tk nợ" => "string", "TK có" => "string", "Ps nợ" => "string", "ĐVT" => "string", "SL" => "string", "Đơn giá" => "string", "PS có" => "string", "HDBH" => "string", "Số TKNH" => "string", "Tên TKNH" => "string", "Đơn vị vận chuyển" => "string", "Mã vận đơn" => "string", "NCC" => "string", "Họ và tên NV" => "string", "Mã nhân viên" => "string", "Phiếu xuất" => "string", "Phí thu KH" => "string"));

		foreach ($mang as $key => $value) {
			if ($value[25]) {

				$styles1 = array('font-style' => 'bold', 'fill' => '#ffc107');
				$writer->writeSheetRow('Sheet1', $value, $styles1);
			} else {
				$writer->writeSheetRow('Sheet1', $value);
			}
		}
		ob_end_clean();
		header('Content-disposition: attachment; filename="' . XLSXWriter::sanitize_filename($filename) . '"');
		header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
		header('Content-Transfer-Encoding: binary');
		header('Cache-Control: must-revalidate');
		header('Pragma: public');
		$writer->writeToStdOut();
		return;
	}
	if (isset($_POST["tonghop"]) && $_POST["tonghop"] != '') {

		if ($_POST["tonghop"] == 2) {
			$mangtk = taomang("dinhkhoan", "ID", "madinhkhoan");
			// $mangcuahang= taomang("cuahang","ID","macuahang",'') ;
			//==== tinh ton đau ky=======================================================


			$sql2 = "SELECT  sum(case when  a.luachon = 1 then a.psno else -(a.psco) end )as tong,a.loaitk FROM thuchikt a left join cuahang b on a.loaitk=b.id  
			where 1=1 " . $sql_ton . " and IDcha not in (select ID from dinhkhoanthuchi where ma='TLDK' or ma='TL') group by a.loaitk ORDER BY a.ngaytao desc";


			//a.tinhtrang=1
			$_SESSION["truyvancu2"] = $sql2;
			//echo $sql2 ;
			if ($_SESSION["admintuan"])	echo "<br>" . $sql2;

			$result = $data->query($sql2);
			$mangTongdk = [];
			while ($re = $data->fetch_array($result)) {
				$mangTongdk[$re['loaitk']] = $re['tong'];
			}

			///=========tiền lẻ đầu kì=========
			$sql_tienle = "SELECT   sum(case when  a.luachon = 1 then a.psno else -(a.psco) end )as tong,a.loaitk from thuchikt a where 1=1 " . $sql_ton . " and a.IDcha  in (select ID from dinhkhoanthuchi where ma='TLDK' or ma='TL' ) group by a.loaitk";


			$result = $data->query($sql_tienle);
			$mangTLCH = [];
			while ($re = $data->fetch_array($result)) {
				$mangTLCH[$re['loaitk']] = $re['tong'];
			}

			///=========tiền lẻ trư=========
			$sql_tienle = "SELECT   sum(a.psno)as lethu,sum(a.psco)as lechi,a.loaitk from thuchikt a " . $sql_where . " and a.IDcha  = (select ID from dinhkhoanthuchi where ma='TL') group by a.loaitk";
			//echo $sql_tienle;
			$result = $data->query($sql_tienle);
			$mangTLTRu = [];
			while ($re = $data->fetch_array($result)) {
				$mangTLTRu[$re['loaitk']] = array("lethu" => $re["lethu"], "lechi" => $re["lechi"]);
			}

			//$sql_rows = "SELECT  sum(a.psco)as tongpsco,sum(a.psno)as tongpsno,a.loaitk,b.Name,b.macuahang FROM thuchikt a left join cuahang b on a.loaitk=b.id ".$sql_where." group by a.loaitk ORDER BY a.ngaytao desc";

			$limit = 20;
			$start = ($curentpage - 1) * $limit;
			//SELECT   sum(case when  a.luachon = 1 then a.psno else -(a.psco) end )as tong,loaitk from thuchikt where IDcha=(select ID from dinhkhoanthuchi where ma='TLDK') group by loaitk
			$sql = "SELECT  sum(a.psco)as tongpsco,sum(a.psno)as tongpsno,a.loaitk,b.Name,b.macuahang FROM thuchikt a left join cuahang b on a.loaitk=b.id  
			" . $sql_where . " group by a.loaitk ORDER BY a.ngaytao desc";


			include_once("includes/xlsxwriter.class.php");

			$filename = "thuchikttonghop.xlsx";
			$writer = new XLSXWriter();
			$writer->setAuthor('datdoan');

			if ($ql[5]) {

				$writer->writeSheetHeader('Sheet1', array("STT" => "string", "Mã cửa hàng" => "string", "Tên cửa hàng" => "string", "TM DK" => "string", "TL DK" => "string", "PS nợ" => "string", "PS có" => "string", "TM CK" => "string", "TL CK" => "string"));
			} else {
				$writer->writeSheetHeader('Sheet1', array("STT" => "string", "Mã cửa hàng" => "string", "Tên cửa hàng" => "string", "TM DK" => "string", "TL DK" => "string", "PS nợ" => "string", "PS có" => "string", "TM CK" => "string", "TL CK" => "string"));
			}


			$result = $data->query($sql);
			$tongpsco = 0;
			$tongpno = 0;
			$tongtldk = 0;
			$tongtlck = 0;
			$tongtmdk = 0;
			$tongtmck = 0;
			while ($re = $data->fetch_array($result)) {
				$r++;

				$sddk = number_format(floor($mangTongdk[$re["loaitk"]]));
				$tongtmdk += ($mangTongdk[$re["loaitk"]]);
				$tldk = number_format(floor($mangTLCH[$re["loaitk"]]));
				$tongtldk += ($mangTLCH[$re["loaitk"]]);
				$psnot = number_format(ceil($re["tongpsno"]));
				$tongpno += $re["tongpno"];
				$pscot = number_format(ceil($re["tongpsco"]));
				$tongpsco += $re["tongpsco"];
				$sdck = number_format(floor($mangTongdk[$re["loaitk"]] - $re["tongpsco"] + $re["tongpsno"]));
				$tongtmck += ($mangTongdk[$re["loaitk"]] - $re["tongpsco"] + $re["tongpsno"]);
				$tlck = number_format(($mangTLTRu[$re["loaitk"]]["lethu"] - $mangTLTRu[$re["loaitk"]]["lechi"]) + $mangTLCH[$re["loaitk"]]);
				$tongtlck += (($mangTLTRu[$re["loaitk"]]["lethu"] - $mangTLTRu[$re["loaitk"]]["lechi"]) + $mangTLCH[$re["loaitk"]]);
				//  echo $re["macuahang"];
				if ($ql[5]) {
					$tamarr = array($r, $re['macuahang'], $re["Name"], $sddk, $tldk, $psnot, $pscot, $sdck, $tlck);
				} else {
					$tamarr = array($r, $re['macuahang'], $re["Name"], $sddk, $tldk, $psnot, $pscot, $sdck, $tlck);
				}
				$writer->writeSheetRow('Sheet1', $tamarr);
			}
			$tamarr = array('Tổng', '', '', $tongtmdk, $tongtldk, $tongpno, $tongpsco, $tongtmck, $tongtlck);
			$writer->writeSheetRow('Sheet1', $tamarr);
		} else if ($_POST["tonghop"] == 3) {


			//======================================================

			$sqltt = "SELECT (sum(ceil(i.DonGia*(1-1*i.chietkhau/100))*i.SoLuong)-g.tigia) as tongtt
 FROM thuchikt a left join phieunhapxuat g on a.hdbh=g.SoCT left join vanchuyenonline v on v.IDbill=g.ID left join xuatbanhang i on g.ID=i.IDPhieu left join cuahang b on a.loaitk=b.id  left join userac c on a.IDtao = c.ID 
  left join dinhkhoanthuchi d on d.ID = a.IDcha left join nhacungcap e on a.NCC=e.ID left join phieuxuat  f on a.phieuxuat=f.ID  left join customer k on k.ID=g.IDNhaCC    
	" . $sql_where . " and (a.loaitk=1105 or a.loaitk=1137 ) and g.SoCT is not null ORDER BY g.ID desc";

			$dongtt = getdong($sqltt);
			$tongtt = $dongtt["tongtt"];
			//======================================================			 
			$sql = "SELECT g.SoCT as sohd,g.TiGia as giamgiad,DATE_FORMAT(g.ngaytao,'%d/%m/%y %h:%i:%s') as ngayhdbh,b.Name as tencuahang,a.donvivc as dvvc,a.mavandon as mavd,a.note as diengiai,k.Name tenkh,k.tel as sdtkh,i.*,v.phitravc,v.phithukh,v.chuyenkhoan 
 FROM thuchikt a left join phieunhapxuat g on a.hdbh=g.SoCT left join vanchuyenonline v on v.IDbill=g.ID left join xuatbanhang i on g.ID=i.IDPhieu left join cuahang b on a.loaitk=b.id  left join userac c on a.IDtao = c.ID 
  left join dinhkhoanthuchi d on d.ID = a.IDcha left join nhacungcap e on a.NCC=e.ID left join phieuxuat  f on a.phieuxuat=f.ID  left join customer k on k.ID=g.IDNhaCC    
	" . $sql_where . " and (a.loaitk=1105 or a.loaitk=1137 ) and g.SoCT is not null ORDER BY g.ID desc";


			include_once("includes/xlsxwriter.class.php");

			$filename = "thuchiktDHOL.xlsx";
			$writer = new XLSXWriter();
			$writer->setAuthor('datdoan');

			$writer->writeSheetHeader('Sheet1', array("STT" => "string", "Ngày HĐBH" => "string", "Số hóa đơn" => "string", "Tên cửa hàng" => "string", "Đơn vị vận chuyển" => "string", "Mã vận đơn" => "string", "Tên khách hàng" => "string", "SĐT" => "string", "Mã Sp" => "string", "Đơn giá" => "string", "Số lượng" => "string", "Chiết khấu" => "string", "Thành tiền" => "string", "Tổng đơn" => "string", "voucher" => "string", "thanh toán" => "string", "phí trả NVC" => "string", "Phí thu KH" => "string", "Chuyển khoản" => "string", "sum" => "string"));

			$soctam = "";
			$result = $data->query($sql);
			$numrow = $data->num_rows($result);

			$tamarr1 = [];
			$tamarr2 = [];
			$tongtiendon = 0;
			$mangtam = [];
			$t = 0;
			$giamgiatam = 0;
			$phithukhtam = 0;
			$phitranvctam = 0;
			$chuyenkhoantam = 0;
			$check1 = 0;
			while ($re = $data->fetch_array($result)) {
				$r++;

				if ($soctam == "") {
					$soctam = $re["sohd"];
					$giamgiatam = $re["giamgiad"];
					$phitranvctam = $re["phitravc"];
					$phithukhtam = $re["phithukh"];
					$chuyenkhoantam = $re["chuyenkhoan"];
					$tamarr1 = array($r, $re['ngayhdbh'], $re["sohd"], $re["tencuahang"], $re["dvvc"], $re["mavd"], $re["diengiai"], $re["sdtkh"], $re["mahang"], number_format($re["DonGia"]), $re["SoLuong"], $re["chietkhau"], number_format($re["SoLuong"] * ceil($re["DonGia"] * (1 - 1 * $re["chietkhau"] / 100))));
					array_push($mangtam, $tamarr1);

					$tongtiendon += ($re["SoLuong"] * ceil($re["DonGia"] * (1 - 1 * $re["chietkhau"] / 100)));
				} else if ($soctam != $re["sohd"]) {

					array_push($mangtam[$check1], number_format($tongtiendon));
					array_push($mangtam[$check1], number_format($giamgiatam));
					array_push($mangtam[$check1], number_format(floor($tongtiendon) - $giamgiatam));
					array_push($mangtam[$check1], number_format($phitranvctam));
					array_push($mangtam[$check1], number_format($phithukhtam));
					array_push($mangtam[$check1], number_format($chuyenkhoantam));
					if ($check1 == 0) {
						array_push($mangtam[$check1], number_format($tongtt));
					}

					$tamarr1 = array($r, $re['ngayhdbh'], $re["sohd"], $re["tencuahang"], $re["dvvc"], $re["mavd"], $re["diengiai"], $re["sdtkh"], $re["mahang"], number_format($re["DonGia"]), $re["SoLuong"], $re["chietkhau"], number_format($re["SoLuong"] * ceil($re["DonGia"] * (1 - 1 * $re["chietkhau"] / 100))));
					array_push($mangtam, $tamarr1);
					$tongtiendon = 0;
					$giamgiatam = 0;
					$soctam = $re["sohd"];
					$giamgiatam = $re["giamgiad"];
					$phitranvctam = $re["phitravc"];
					$phithukhtam = $re["phithukh"];
					$chuyenkhoantam = $re["chuyenkhoan"];
					$tongtiendon += ($re["SoLuong"] * ceil($re["DonGia"] * (1 - 1 * $re["chietkhau"] / 100)));
					$check1 = $t;
				} else {
					// if($t==($numrow-1)){
					//					
					//							//echo $tongtiendon;
					//			  		 $tamarr2=array($r,$re['ngayhdbh'],$re["sohd"],$re["tencuahang"],$re["dvvc"],$re["mavd"],$re["tenkh"],$re["sdtkh"],$re["mahang"],number_format($re["DonGia"]),$re["SoLuong"],$re["chietkhau"],number_format($re["SoLuong"]*ceil($re["DonGia"]*(1-1*$re["chietkhau"]/100))),"","","","","","","");
					//					 $tongtiendon+=($re["SoLuong"]*ceil($re["DonGia"]*(1-1*$re["chietkhau"]/100)));
					//						array_push($mangtam,$tamarr2);	
					//							 
					//							//array_push($mangtam,$tamarr2);	
					//								array_push($mangtam[$check1],number_format($tongtiendon));
					//						  array_push($mangtam[$check1],number_format($giamgiatam));
					//						array_push($mangtam[$check1],number_format($tongtiendon-$giamgiatam));
					//						 array_push($mangtam[$check1],number_format($phitranvctam));
					//						array_push($mangtam[$check1],number_format($phithukhtam));
					//						array_push($mangtam[$check1],number_format($chuyenkhoantam));
					//								
					//								//array_push($mangtam,$tamarr1);
					//						}else{

					//echo $tongtiendon;
					$tamarr2 = array($r, $re['ngayhdbh'], $re["sohd"], $re["tencuahang"], $re["dvvc"], $re["mavd"], $re["diengiai"], $re["sdtkh"], $re["mahang"], number_format($re["DonGia"]), $re["SoLuong"], $re["chietkhau"], number_format($re["SoLuong"] * ceil($re["DonGia"] * (1 - 1 * $re["chietkhau"] / 100))), "", "", "", "", "", "", "");
					$tongtiendon += ($re["SoLuong"] * ceil($re["DonGia"] * (1 - 1 * $re["chietkhau"] / 100)));
					array_push($mangtam, $tamarr2);
					//}

				}


				if ($t == ($numrow - 1)) {
					//$giamgiatam=$re["giamgiad"];
					//echo $tongtiendon;
					/* $tamarr2=array($r,$re['ngayhdbh'],$re["sohd"],$re["tencuahang"],$re["dvvc"],$re["mavd"],$re["tenkh"],$re["sdtkh"],$re["mahang"],number_format($re["DonGia"]),$re["SoLuong"],$re["chietkhau"],number_format($re["SoLuong"]*ceil($re["DonGia"]*(1-1*$re["chietkhau"]/100))),"","","","","","","");
					 $tongtiendon+=($re["SoLuong"]*ceil($re["DonGia"]*(1-1*$re["chietkhau"]/100)));
						array_push($mangtam,$tamarr2);	*/

					//array_push($mangtam,$tamarr2);	
					array_push($mangtam[$check1], number_format($tongtiendon));
					array_push($mangtam[$check1], number_format($giamgiatam));
					array_push($mangtam[$check1], number_format(floor($tongtiendon) - $giamgiatam));
					array_push($mangtam[$check1], number_format($phitranvctam));
					array_push($mangtam[$check1], number_format($phithukhtam));
					array_push($mangtam[$check1], number_format($chuyenkhoantam));

					//array_push($mangtam,$tamarr1);
				}
				//$writer->writeSheetRow('Sheet1',$tamarr);

				$t++;
			}
			/*echo "<pre>";
				var_dump($mangtam);
				echo "</pre>";
				return;*/
			foreach ($mangtam as $key => $value) {
				$writer->writeSheetRow('Sheet1', $value);
			}
		} else if ($_POST["tonghop"] == 4) {

			//======================================================

			$sqltt = "SELECT (sum(i.DonGia*(1-1*i.chietkhau/100)*i.SoLuong)-g.tigia) as tongtt
 FROM thuchikt a left join phieunhapxuat g on a.hdbh=g.SoCT left join vanchuyenonline v on v.IDbill=g.ID left join xuatbanhang i on g.ID=i.IDPhieu left join cuahang b on a.loaitk=b.id  left join userac c on a.IDtao = c.ID 
  left join dinhkhoanthuchi d on d.ID = a.IDcha left join nhacungcap e on a.NCC=e.ID left join phieuxuat  f on a.phieuxuat=f.ID  left join customer k on k.ID=g.IDNhaCC    
	" . $sql_where . " and (d.ma='CNDHOLPD' or d.ma='HCNDHOLPD' or d.ma='CNDHOLCH' or d.ma='HCNDHOLCH') and g.SoCT is not null ORDER BY g.ID desc";

			$dongtt = getdong($sqltt);
			$tongtt = $dongtt["tongtt"];
			//======================================================	

			$sql = "SELECT g.SoCT as sohd,g.TiGia as giamgiad,DATE_FORMAT(g.ngaytao,'%d/%m/%y %h:%i:%s') as ngayhdbh,b.Name as tencuahang,a.donvivc as dvvc,a.mavandon as mavd,a.note as diengiai,k.Name tenkh,k.tel as sdtkh,i.*
 FROM thuchikt a left join phieunhapxuat g on a.hdbh=g.SoCT  left join xuatbanhang i on g.ID=i.IDPhieu left join cuahang b on a.loaitk=b.id  left join userac c on a.IDtao = c.ID 
  left join dinhkhoanthuchi d on d.ID = a.IDcha left join nhacungcap e on a.NCC=e.ID left join phieuxuat  f on a.phieuxuat=f.ID  left join customer k on k.ID=g.IDNhaCC    
	" . $sql_where . " and (d.ma='CNDHOLPD' or d.ma='HCNDHOLPD') and g.SoCT is not null  ORDER BY g.ID desc";


			include_once("includes/xlsxwriter.class.php");

			$filename = "thuchiktDHOLPD.xlsx";
			$writer = new XLSXWriter();
			$writer->setAuthor('datdoan');

			$writer->writeSheetHeader('Sheet1', array("STT" => "string", "Ngày HĐBH" => "string", "Số hóa đơn" => "string", "Tên cửa hàng" => "string", "Đơn vị vận chuyển" => "string", "Mã vận đơn" => "string", "Tên khách hàng" => "string", "SĐT" => "string", "Mã Sp" => "string", "Đơn giá" => "string", "Số lượng" => "string", "Chiết khấu" => "string", "Thành tiền" => "string", "Tổng đơn" => "string", "voucher" => "string", "thanh toán" => "string", "phí trả NVC" => "string", "Phí thu KH" => "string", "Chuyển khoản" => "string", "sum" => "string"));

			$soctam = "";
			$result = $data->query($sql);
			$numrow = $data->num_rows($result);
			$tamarr1 = [];
			$tamarr2 = [];
			$tongtiendon = 0;
			$mangtam = [];
			$t = 0;
			$check1 = 0;
			while ($re = $data->fetch_array($result)) {
				$r++;



				if ($soctam == "") {
					$soctam = $re["sohd"];
					$giamgiatam = $re["giamgiad"];
					$phitranvctam = $re["phitravc"];
					$phithukhtam = $re["phithukh"];
					$chuyenkhoantam = $re["chuyenkhoan"];
					$tamarr1 = array($r, $re['ngayhdbh'], $re["sohd"], $re["tencuahang"], $re["dvvc"], $re["mavd"], $re["diengiai"], $re["sdtkh"], $re["mahang"], number_format($re["DonGia"]), $re["SoLuong"], $re["chietkhau"], number_format($re["SoLuong"] * ($re["DonGia"] * (1 - 1 * $re["chietkhau"] / 100))));
					array_push($mangtam, $tamarr1);

					$tongtiendon += ($re["SoLuong"] * ($re["DonGia"] * (1 - 1 * $re["chietkhau"] / 100)));
				} else if ($soctam != $re["sohd"]) {

					array_push($mangtam[$check1], number_format($tongtiendon));
					array_push($mangtam[$check1], number_format($giamgiatam));
					array_push($mangtam[$check1], number_format($tongtiendon - $giamgiatam));
					array_push($mangtam[$check1], number_format($phitranvctam));
					array_push($mangtam[$check1], number_format($phithukhtam));
					array_push($mangtam[$check1], number_format($chuyenkhoantam));
					if ($check1 == 0) {
						array_push($mangtam[$check1], number_format($tongtt));
					}

					$tamarr1 = array($r, $re['ngayhdbh'], $re["sohd"], $re["tencuahang"], $re["dvvc"], $re["mavd"], $re["diengiai"], $re["sdtkh"], $re["mahang"], number_format($re["DonGia"]), $re["SoLuong"], $re["chietkhau"], number_format($re["SoLuong"] * ($re["DonGia"] * (1 - 1 * $re["chietkhau"] / 100))));
					array_push($mangtam, $tamarr1);
					$tongtiendon = 0;
					$giamgiatam = 0;
					$soctam = $re["sohd"];
					$giamgiatam = $re["giamgiad"];
					$phitranvctam = $re["phitravc"];
					$phithukhtam = $re["phithukh"];
					$chuyenkhoantam = $re["chuyenkhoan"];
					$tongtiendon += ($re["SoLuong"] * ($re["DonGia"] * (1 - 1 * $re["chietkhau"] / 100)));
					$check1 = $t;
				} else {
					if ($t == ($numrow - 1)) {

						//echo $tongtiendon;
						$tamarr2 = array($r, $re['ngayhdbh'], $re["sohd"], $re["tencuahang"], $re["dvvc"], $re["mavd"], $re["diengiai"], $re["sdtkh"], $re["mahang"], number_format($re["DonGia"]), $re["SoLuong"], $re["chietkhau"], number_format($re["SoLuong"] * ($re["DonGia"] * (1 - 1 * $re["chietkhau"] / 100))), "", "", "", "", "", "", "");
						$tongtiendon += ($re["SoLuong"] * ($re["DonGia"] * (1 - 1 * $re["chietkhau"] / 100)));
						array_push($mangtam, $tamarr2);

						//array_push($mangtam,$tamarr2);	
						array_push($mangtam[$check1], number_format($tongtiendon));
						array_push($mangtam[$check1], number_format($giamgiatam));
						array_push($mangtam[$check1], number_format($tongtiendon - $giamgiatam));
						array_push($mangtam[$check1], number_format($phitranvctam));
						array_push($mangtam[$check1], number_format($phithukhtam));
						array_push($mangtam[$check1], number_format($chuyenkhoantam));

						//array_push($mangtam,$tamarr1);
					} else {

						//echo $tongtiendon;
						$tamarr2 = array($r, $re['ngayhdbh'], $re["sohd"], $re["tencuahang"], $re["dvvc"], $re["mavd"], $re["diengiai"], $re["sdtkh"], $re["mahang"], number_format($re["DonGia"]), $re["SoLuong"], $re["chietkhau"], number_format($re["SoLuong"] * ($re["DonGia"] * (1 - 1 * $re["chietkhau"] / 100))), "", "", "", "", "", "", "");
						$tongtiendon += ($re["SoLuong"] * ($re["DonGia"] * (1 - 1 * $re["chietkhau"] / 100)));
						array_push($mangtam, $tamarr2);
					}
				}



				//$writer->writeSheetRow('Sheet1',$tamarr);

				$t++;
			}
			/*echo "<pre>";
				var_dump($mangtam);
				echo "</pre>";
				return;*/
			foreach ($mangtam as $key => $value) {
				$writer->writeSheetRow('Sheet1', $value);
			}
		} else if ($_POST["tonghop"] == 5) {

			//======================================================

			$sqltt = "SELECT (sum(i.DonGia*(1-1*i.chietkhau/100)*i.SoLuong)-g.tigia) as tongtt
 FROM thuchikt a left join phieunhapxuat g on a.hdbh=g.SoCT left join vanchuyenonline v on v.IDbill=g.ID left join xuatbanhang i on g.ID=i.IDPhieu left join cuahang b on a.loaitk=b.id  left join userac c on a.IDtao = c.ID 
  left join dinhkhoanthuchi d on d.ID = a.IDcha left join nhacungcap e on a.NCC=e.ID left join phieuxuat  f on a.phieuxuat=f.ID  left join customer k on k.ID=g.IDNhaCC    
	" . $sql_where . " and (d.ma='CNDHOLPD' or d.ma='HCNDHOLPD') and g.SoCT is not null ORDER BY g.ID desc";

			$dongtt = getdong($sqltt);
			$tongtt = $dongtt["tongtt"];
			//======================================================

			$sql = "SELECT g.SoCT as sohd,g.TiGia as giamgiad,DATE_FORMAT(g.ngaytao,'%d/%m/%y %h:%i:%s') as ngayhdbh,b.Name as tencuahang,a.donvivc as dvvc,a.mavandon as mavd,a.note as diengiai,k.Name tenkh,k.tel as sdtkh,i.*
 FROM thuchikt a left join phieunhapxuat g on a.hdbh=g.SoCT  left join xuatbanhang i on g.ID=i.IDPhieu left join cuahang b on a.loaitk=b.id  left join userac c on a.IDtao = c.ID 
  left join dinhkhoanthuchi d on d.ID = a.IDcha left join nhacungcap e on a.NCC=e.ID left join phieuxuat  f on a.phieuxuat=f.ID  left join customer k on k.ID=g.IDNhaCC    
	" . $sql_where . " and (d.ma='CNDHOLPD' or d.ma='HCNDHOLPD' or d.ma='CNDHOLCH' or d.ma='HCNDHOLCH')  and g.SoCT is not null  ORDER BY g.ID desc";


			include_once("includes/xlsxwriter.class.php");

			$filename = "thuchiktDSDH.xlsx";
			$writer = new XLSXWriter();
			$writer->setAuthor('datdoan');
			$writer->writeSheetHeader('Sheet1', array("STT" => "string", "Ngày HĐBH" => "string", "Số hóa đơn" => "string", "Tên cửa hàng" => "string", "Đơn vị vận chuyển" => "string", "Mã vận đơn" => "string", "Tên khách hàng" => "string", "SĐT" => "string", "Mã Sp" => "string", "Đơn giá" => "string", "Số lượng" => "string", "Chiết khấu" => "string", "Thành tiền" => "string", "Tổng đơn" => "string", "voucher" => "string", "thanh toán" => "string", "phí trả NVC" => "string", "Phí thu KH" => "string", "Chuyển khoản" => "string", "sum" => "string"));
			$soctam = "";
			$result = $data->query($sql);
			$numrow = $data->num_rows($result);
			$tamarr1 = [];
			$tamarr2 = [];
			$tongtiendon = 0;
			$mangtam = [];
			$t = 0;
			$check1 = 0;
			while ($re = $data->fetch_array($result)) {
				$r++;



				if ($soctam == "") {
					$soctam = $re["sohd"];
					$giamgiatam = $re["giamgiad"];
					$phitranvctam = $re["phitravc"];
					$phithukhtam = $re["phithukh"];
					$chuyenkhoantam = $re["chuyenkhoan"];
					$tamarr1 = array($r, $re['ngayhdbh'], $re["sohd"], $re["tencuahang"], $re["dvvc"], $re["mavd"], $re["diengiai"], $re["sdtkh"], $re["mahang"], number_format($re["DonGia"]), $re["SoLuong"], $re["chietkhau"], number_format($re["SoLuong"] * ($re["DonGia"] * (1 - 1 * $re["chietkhau"] / 100))));
					array_push($mangtam, $tamarr1);

					$tongtiendon += ($re["SoLuong"] * ($re["DonGia"] * (1 - 1 * $re["chietkhau"] / 100)));
				} else if ($soctam != $re["sohd"]) {

					array_push($mangtam[$check1], number_format($tongtiendon));
					array_push($mangtam[$check1], number_format($giamgiatam));
					array_push($mangtam[$check1], number_format($tongtiendon - $giamgiatam));
					array_push($mangtam[$check1], number_format($phitranvctam));
					array_push($mangtam[$check1], number_format($phithukhtam));
					array_push($mangtam[$check1], number_format($chuyenkhoantam));
					if ($check1 == 0) {
						array_push($mangtam[$check1], number_format($tongtt));
					}

					$tamarr1 = array($r, $re['ngayhdbh'], $re["sohd"], $re["tencuahang"], $re["dvvc"], $re["mavd"], $re["diengiai"], $re["sdtkh"], $re["mahang"], number_format($re["DonGia"]), $re["SoLuong"], $re["chietkhau"], number_format($re["SoLuong"] * ($re["DonGia"] * (1 - 1 * $re["chietkhau"] / 100))));
					array_push($mangtam, $tamarr1);
					$tongtiendon = 0;
					$giamgiatam = 0;
					$soctam = $re["sohd"];
					$giamgiatam = $re["giamgiad"];
					$phitranvctam = $re["phitravc"];
					$phithukhtam = $re["phithukh"];
					$chuyenkhoantam = $re["chuyenkhoan"];
					$tongtiendon += ($re["SoLuong"] * ($re["DonGia"] * (1 - 1 * $re["chietkhau"] / 100)));
					$check1 = $t;
				} else {
					if ($t == ($numrow - 1)) {

						//echo $tongtiendon;
						$tamarr2 = array($r, $re['ngayhdbh'], $re["sohd"], $re["tencuahang"], $re["dvvc"], $re["mavd"], $re["diengiai"], $re["sdtkh"], $re["mahang"], number_format($re["DonGia"]), $re["SoLuong"], $re["chietkhau"], number_format($re["SoLuong"] * ($re["DonGia"] * (1 - 1 * $re["chietkhau"] / 100))), "", "", "", "", "", "", "");
						$tongtiendon += ($re["SoLuong"] * ($re["DonGia"] * (1 - 1 * $re["chietkhau"] / 100)));
						array_push($mangtam, $tamarr2);

						//array_push($mangtam,$tamarr2);	
						array_push($mangtam[$check1], number_format($tongtiendon));
						array_push($mangtam[$check1], number_format($giamgiatam));
						array_push($mangtam[$check1], number_format($tongtiendon - $giamgiatam));
						array_push($mangtam[$check1], number_format($phitranvctam));
						array_push($mangtam[$check1], number_format($phithukhtam));
						array_push($mangtam[$check1], number_format($chuyenkhoantam));

						//array_push($mangtam,$tamarr1);
					} else {

						//echo $tongtiendon;
						$tamarr2 = array($r, $re['ngayhdbh'], $re["sohd"], $re["tencuahang"], $re["dvvc"], $re["mavd"], $re["diengiai"], $re["sdtkh"], $re["mahang"], number_format($re["DonGia"]), $re["SoLuong"], $re["chietkhau"], number_format($re["SoLuong"] * ($re["DonGia"] * (1 - 1 * $re["chietkhau"] / 100))), "", "", "", "", "", "", "");
						$tongtiendon += ($re["SoLuong"] * ($re["DonGia"] * (1 - 1 * $re["chietkhau"] / 100)));
						array_push($mangtam, $tamarr2);
					}
				}



				//$writer->writeSheetRow('Sheet1',$tamarr);

				$t++;
			}
			/*echo "<pre>";
				var_dump($mangtam);
				echo "</pre>";
				return;*/
			foreach ($mangtam as $key => $value) {
				$writer->writeSheetRow('Sheet1', $value);
			}
		} else if ($_POST["tonghop"] == 6) {
			include_once("includes/xlsxwriter.class.php");

			$filename = "thuchiktDHOLChuaload.xlsx";
			$writer = new XLSXWriter();
			$writer->setAuthor('datdoan');


			$sqlphieuchuaload = "select a.*,c.Name as tench,c.macuahang from phieunhapxuat a left join thuchikt b on a.soct=b.hdbh left join cuahang c on a.IDKho=c.ID where " . $sql_where_chuaload . " and  b.ID is null and a.IDKho=1105 and a.dakhoa=1";

			$writer->writeSheetHeader('Sheet1', array("STT" => "string", "Ngày Nhập" => "string", "Số hóa đơn" => "string", "Mã cửa hàng" => "string", "Tên cửa hàng" => "string"));
			$resultchuaload = $data->query($sqlphieuchuaload);
			$r = 0;
			while ($re = $data->fetch_array($resultchuaload)) {
				$r++;
				$tamarr2 = array($r, $re['NgayNhap'], $re["SoCT"], $re["macuahang"], $re["tench"]);
				$writer->writeSheetRow('Sheet1', $tamarr2);
			}
		} else if ($_POST["tonghop"] == 7) {


			include_once("includes/xlsxwriter.class.php");

			$filename = "thuchikttonghopchitiet.xlsx";
			$writer = new XLSXWriter();
			$writer->setAuthor('datdoan');

			$writer->writeSheetHeader('Sheet1', array("STT" => "string", "Ngày thu chi" => "string", "Mã cửa hàng" => "string", "Tên cửa hàng" => "string", "TM DK" => "string", "TL DK" => "string", "PS nợ" => "string", "PS có" => "string", "TM CK" => "string", "TL CK" => "string"));


			$sql = "SELECT  sum(round(a.psco))as tongpsco,sum(round(a.psno))as tongpsno,a.loaitk,b.Name,b.macuahang,a.ngaythuchi FROM thuchikt a left join cuahang b on a.loaitk=b.id  
	" . $sql_where . " and IDCha not in (select ID from dinhkhoanthuchi where ma='TL' or ma='TLDK') group by a.ngaythuchi,a.loaitk ORDER BY a.ngaythuchi,b.ID desc";


			$tongpsco = 0;
			$tongpno = 0;
			$tongtldk = 0;
			$tongtlck = 0;
			$tongtmdk = 0;
			$tongtmck = 0;
			$r = 0;

			$result = $data->query($sql);
			while ($re = $data->fetch_array($result)) {
				$r++;

				$tongpsco += $re["tongpsco"];
				$tongpno += $re["tongpsno"];

				$tongdk = 0;
				$sql2 = "SELECT  sum(case when  a.luachon = 1 then round(a.psno) else -(round(a.psco)) end )as tong,a.loaitk FROM thuchikt a left join cuahang b on a.loaitk=b.id  
		where  IDcha not in (select ID from dinhkhoanthuchi where ma='TLDK' or ma='TL' ) and ngaythuchi<'$re[ngaythuchi]' and a.loaitk='$re[loaitk]'  group by a.loaitk";
				$dongtam = getdong($sql2);
				$tongdk = $dongtam['tong'] ? $dongtam['tong'] : 0;
				$tongck = $tongdk + ($re["tongpsno"] - $re["tongpsco"]);
				$tongtmdk += ($tongdk > 0 || $tongdk < 0) ? round($tongdk) : 0;
				$tongtmck += ($tongck > 0 || $tongck < 0) ? round($tongck) : 0;
				///=========tiền lẻ đầu kì=========

				$tienledk = 0;
				$sql_tienle = "SELECT   sum(case when  a.luachon = 1 then round(a.psno) else -(round(a.psco)) end )as tong,a.loaitk,a.ngaythuchi from thuchikt a where a.ngaythuchi< '$re[ngaythuchi]' and  a.IDcha  in (select ID from dinhkhoanthuchi where ma='TLDK' or ma='TL') and a.loaitk='$re[loaitk]' group by a.loaitk";
				$dong = getdong($sql_tienle);

				$tienledk = $dong['tong'] ? $dong['tong'] : 0;


				//$tongtldk+=$tienledk;


				///=========tiền lẻ trư=========
				$tienleck = 0;
				$sql_tienleck = "SELECT   sum(round(a.psno))as lethu,sum(round(a.psco))as lechi,a.loaitk from thuchikt a where ngaythuchi='$re[ngaythuchi]' and a.IDcha  = (select ID from dinhkhoanthuchi where ma='TL') and a.loaitk='$re[loaitk]' group by a.loaitk";
				$dong = getdong($sql_tienleck);
				$tienleckthu = $dong['lethu'] ? $dong['lethu'] : 0;
				$tienleckchi = $dong['lechi'] ? $dong['lechi'] : 0;
				$tienleck = ($tienleckthu - $tienleckchi) + $tienledk;

				$tamarr = array($r, $re['ngaythuchi'], $re['macuahang'], $re["Name"], ($tongdk > 0 || $tongdk < 0) ? round($tongdk) : 0, $tienledk, number_format($re["tongpsno"]), number_format($re["tongpsco"]), ($tongck > 0 || $tongck < 0) ? round($tongck) : 0, $tienleck);

				$writer->writeSheetRow('Sheet1', $tamarr);
			}
			$tamarr = array('Tổng', '', '', '', $tongtmdk, $tienledk, $tongpno, $tongpsco, $tongtmck, $tienleck);
			$writer->writeSheetRow('Sheet1', $tamarr);
		} else if ($_POST["tonghop"] == 8) {


			include_once("includes/xlsxwriter.class.php");

			$filename = "thuchikttienthua.xlsx";
			$writer = new XLSXWriter();
			$writer->setAuthor('datdoan');


			$sql = "select a.ID,a.macuahang,b.ma as matinh from  cuahang a left join tinh b on a.Fax=b.ID where  a.IDNhomcc <> 8 and a.macuahang <> ''";
			$mangchKH = [];
			$mangchDN = [];
			$mangch = [];
			$query = $data->query($sql);

			$arrayheaderDN = array("CH/Ngày" => "string");
			$arrayheaderKH = array();
			while ($re = $data->fetch_array($query)) {

				if ($re['matinh'] == 'DDN') {
					$arrayheaderDN[$re['macuahang']] = 'string';
					$mangchDN[$re['ID']] = $re['macuahang'];
				} else {
					$arrayheaderKH[$re['macuahang']] = 'string';
					$mangchKH[$re['ID']] = $re['macuahang'];
				}
			}
			$arrayheader = array_merge($arrayheaderDN, $arrayheaderKH);
			$writer->writeSheetHeader('Sheet1', $arrayheader);
			$mangch = array_merge($mangchDN, $mangchKH);

			$sql = "SELECT DATE_FORMAT(a.ngaythuchi,'%d/%m/%Y') as ngaythuchikt,a.ngaythuchi,a.loaitk,sum(case when  a.luachon = 1 then round(a.psno) else -(round(a.psco)) end )as tong,b.macuahang as tencuahang,c.ma as matinh
 FROM thuchikt a left join dinhkhoanthuchi d on a.IDcha=d.ID left join cuahang b on a.loaitk=b.id left join tinh c on c.ID=b.Fax " . $sql_where . " and b.IDNhomcc <> 8 and (d.ma='KTT' or d.ma='KTTI') group by a.ngaythuchi,a.loaitk order by  a.ngaythuchi desc ";
			$result = $data->query($sql);

			$mangtam = [];
			$mangtong = [];
			$ngaythuchitam = '';
			while ($re = $data->fetch_array($result)) {


				$mangtong[$re['tencuahang']] += $re['tong'];
				if ($ngaythuchitam == '') {
					$ngaythuchitam = $re['ngaythuchikt'];


					$mangtam[$ngaythuchitam][$re['tencuahang']] = $re['tong'];

					// <th width="37" valign="middle"  ><strong>Ngày tải file </strong></th></tr>
				} else {
					$mangtam[$ngaythuchitam][$re['tencuahang']] = $re['tong'];

					if ($ngaythuchitam != $re['ngaythuchikt']) {
						$ngaythuchitam = $re['ngaythuchikt'];
					}
				}

				if ($r == ($numrow - 1)) {

					$mangtam[$ngaythuchitam][$re['tencuahang']] = $re['tong'];
				}

				$r++;
			}
			$dongcuoi3 = 0;

			$MangDLDN = [];
			$MangDLKH = [];
			$mangtongDLDN = ["Tổng"];
			$mangtongDLKH = [];


			foreach ($mangtam as $key => $value) {
				$tamarr = [$key];
				array_push($MangDLDN, $key);

				foreach ($mangchDN as $k => $v) {
					if ($value[$v]) {
						array_push($tamarr, $value[$v]);
					} else {
						array_push($tamarr, "");
					}

					if ($dongcuoi3 < count($mangch)) {

						if ($mangtong[$v]) {
							array_push($mangtongDLDN, $mangtong[$v]);

							$dongcuoi3++;
						} else {
							array_push($mangtongDLDN, "");
							$dongcuoi3++;
						}
						//$dongcuoi3++;
					}
				}
				foreach ($mangchKH as $k => $v) {

					if ($value[$v]) {
						array_push($tamarr, $value[$v]);
					} else {
						array_push($tamarr, "");
					}


					if ($dongcuoi3 < count($mangch)) {
						if ($mangtong[$v]) {
							array_push($mangtongDLDN, $mangtong[$v]);
							$dongcuoi3++;
						} else {

							array_push($mangtongDLDN, "");
							$dongcuoi3++;
						}
					}
				}


				//$tamarr=array_merge($MangDLDN,$MangDLKH);
				//in($tamarr);


				$writer->writeSheetRow('Sheet1', $tamarr);
			}

			$writer->writeSheetRow('Sheet1', $mangtongDLDN);
		} else if ($_POST["tonghop"] == 9) {

			include_once("includes/xlsxwriter.class.php");
			$mangcongno = ["CNNV", "HCNNV", "CNS"];

			$chuoiCN = '';
			foreach ($mangcongno as $key => $value) {
				$chuoiCN .= "'" . $value . "',";
			}

			$chuoiCN = rtrim($chuoiCN, ",");
			$filename = "thuchiktcongno.xlsx";
			$writer = new XLSXWriter();
			$writer->setAuthor('datdoan');
			$writer->writeSheetHeader('CÔNG NỢ', array("Ngày thu chi" => "string", "Tên NV" => "string", "Mã nhân viên" => "string", "Nội dung" => "string", "Nợ" => "string", "Có" => "string", "Cn tại cửa hàng" => "string", "Số tiền" => "string", "Gh chú" => "string"));
			$writer->writeSheetHeader('CÔNG NỢ SẾP', array("Ngày thu chi" => "string", "Nội dung" => "string", "Nợ" => "string", "Có" => "string", "Cn tại cửa hàng" => "string", "Số tiền" => "string", "Gh chú" => "string"));

			$sql = "SELECT DATE_FORMAT(a.ngaythuchi,'%m/%d/%Y') as ngaythuchikt,b.macuahang as tencuahang,c.manv as MaNV,c.Ten as tennhanvien,a.note,a.tkno,a.tkco,a.psno,a.psco,d.ma as madk
 FROM thuchikt a left join dinhkhoanthuchi d on a.IDcha=d.ID left join cuahang b on a.loaitk=b.id left join userac c on a.manv= c.MaNV  " . $sql_where . " and d.ma in ($chuoiCN) order by  a.ngaythuchi desc";

			$query = $data->query($sql);


			$mangtk = taomang("dinhkhoan", "ID", "madinhkhoan");
			$mangCNsep = [];
			while ($re = $data->fetch_array($query)) {

				if ($re["madk"] == "CNS") {
					array_push($mangCNsep, $re);
				} else {
					$tamarr = array($re["ngaythuchikt"], $re["tennhanvien"], $re["MaNV"], $re["note"], $mangtk[$re["tkno"]], $mangtk[$re["tkco"]], $re["tencuahang"], $re["psno"] ? number_format($re["psno"]) : number_format($re["psco"]));
					$writer->writeSheetRow('CÔNG NỢ', $tamarr);
				}
			}

			if (count($mangCNsep)) {
				foreach ($mangCNsep as $key => $value) {
					$tamarr = array($value["ngaythuchikt"], $value["note"], $mangtk[$value["tkno"]], $mangtk[$value["tkco"]], $value["tencuahang"], $value["psno"] ? number_format($value["psno"]) : number_format($value["psco"]));
					$writer->writeSheetRow('CÔNG NỢ SẾP', $tamarr);
				}
			}
		} else if ($_POST["tonghop"] == 10) {


			include_once("includes/xlsxwriter.class.php");

			$filename = "thuchiktdoanhthu.xlsx";
			$writer = new XLSXWriter();
			$writer->setAuthor('datdoan');


			$sql = "select a.ID,a.macuahang,b.ma as matinh from  cuahang a left join tinh b on a.Fax=b.ID where  a.IDNhomcc <> 8 and a.macuahang <> ''";
			$mangchKH = [];
			$mangchDN = [];
			$mangch = [];
			$query = $data->query($sql);

			$arrayheaderDN = array("CH/Ngày" => "string");
			$arrayheaderKH = array();
			while ($re = $data->fetch_array($query)) {

				if ($re['matinh'] == 'DDN') {
					$arrayheaderDN[$re['macuahang']] = 'string';
					$mangchDN[$re['ID']] = $re['macuahang'];
				} else {
					$arrayheaderKH[$re['macuahang']] = 'string';
					$mangchKH[$re['ID']] = $re['macuahang'];
				}
			}
			$arrayheader = array_merge($arrayheaderDN, $arrayheaderKH);
			$writer->writeSheetHeader('Sheet1', $arrayheader);
			$mangch = array_merge($mangchDN, $mangchKH);

			$sql = "SELECT DATE_FORMAT(a.ngaythuchi,'%d/%m/%Y') as ngaythuchikt,a.ngaythuchi,a.loaitk,sum(case when  a.luachon = 1 then round(a.psno) else -(round(a.psco)) end )as tong,b.macuahang as tencuahang,c.ma as matinh
 FROM thuchikt a left join dinhkhoanthuchi d on a.IDcha=d.ID left join cuahang b on a.loaitk=b.id left join tinh c on c.ID=b.Fax " . $sql_where . " and b.IDNhomcc <> 8 and (d.ma='DTBH') group by a.ngaythuchi,a.loaitk order by  a.ngaythuchi desc ";
			$result = $data->query($sql);

			$mangtam = [];
			$mangtong = [];
			$ngaythuchitam = '';
			while ($re = $data->fetch_array($result)) {


				$mangtong[$re['tencuahang']] += $re['tong'];
				if ($ngaythuchitam == '') {
					$ngaythuchitam = $re['ngaythuchikt'];


					$mangtam[$ngaythuchitam][$re['tencuahang']] = $re['tong'];

					// <th width="37" valign="middle"  ><strong>Ngày tải file </strong></th></tr>
				} else {
					$mangtam[$ngaythuchitam][$re['tencuahang']] = $re['tong'];

					if ($ngaythuchitam != $re['ngaythuchikt']) {
						$ngaythuchitam = $re['ngaythuchikt'];
					}
				}

				if ($r == ($numrow - 1)) {

					$mangtam[$ngaythuchitam][$re['tencuahang']] = $re['tong'];
				}

				$r++;
			}
			$dongcuoi3 = 0;

			$MangDLDN = [];
			$MangDLKH = [];
			$mangtongDLDN = ["Tổng"];
			$mangtongDLKH = [];


			foreach ($mangtam as $key => $value) {
				$tamarr = [$key];
				array_push($MangDLDN, $key);

				foreach ($mangchDN as $k => $v) {
					if ($value[$v]) {
						array_push($tamarr, $value[$v]);
					} else {
						array_push($tamarr, "");
					}

					if ($dongcuoi3 < count($mangch)) {

						if ($mangtong[$v]) {
							array_push($mangtongDLDN, $mangtong[$v]);

							$dongcuoi3++;
						} else {
							array_push($mangtongDLDN, "");
							$dongcuoi3++;
						}
						//$dongcuoi3++;
					}
				}
				foreach ($mangchKH as $k => $v) {

					if ($value[$v]) {
						array_push($tamarr, $value[$v]);
					} else {
						array_push($tamarr, "");
					}


					if ($dongcuoi3 < count($mangch)) {
						if ($mangtong[$v]) {
							array_push($mangtongDLDN, $mangtong[$v]);
							$dongcuoi3++;
						} else {

							array_push($mangtongDLDN, "");
							$dongcuoi3++;
						}
					}
				}


				//$tamarr=array_merge($MangDLDN,$MangDLKH);
				//in($tamarr);


				$writer->writeSheetRow('Sheet1', $tamarr);
			}

			$writer->writeSheetRow('Sheet1', $mangtongDLDN);
		} else if ($_POST["tonghop"] == 11) {


			include_once("includes/xlsxwriter.class.php");

			$filename = "thuchikttienmat.xlsx";
			$writer = new XLSXWriter();
			$writer->setAuthor('datdoan');


			$sql = "select a.ID,a.macuahang,b.ma as matinh from  cuahang a left join tinh b on a.Fax=b.ID where  a.IDNhomcc <> 8 and a.macuahang <> ''";
			$mangchKH = [];
			$mangchDN = [];
			$mangch = [];
			$query = $data->query($sql);

			$arrayheaderDN = array("CH/Ngày" => "string");
			$arrayheaderKH = array();
			while ($re = $data->fetch_array($query)) {

				if ($re['matinh'] == 'DDN') {
					$arrayheaderDN[$re['macuahang']] = 'string';
					$mangchDN[$re['ID']] = $re['macuahang'];
				} else {
					$arrayheaderKH[$re['macuahang']] = 'string';
					$mangchKH[$re['ID']] = $re['macuahang'];
				}
			}
			$arrayheader = array_merge($arrayheaderDN, $arrayheaderKH);
			$writer->writeSheetHeader('Sheet1', $arrayheader);
			$mangch = array_merge($mangchDN, $mangchKH);

			$sql = "SELECT  DATE_FORMAT(a.ngaythuchi,'%d/%m/%Y') as ngaythuchikt,sum(round(a.psco))as tongpsco,sum(round(a.psno))as tongpsno,a.loaitk,b.Name,b.macuahang as tencuahang,a.ngaythuchi FROM thuchikt a left join dinhkhoanthuchi c on a.IDcha=c.ID left join cuahang b on a.loaitk=b.id  
	 " . $sql_where . " and (c.ma <> 'TL' and c.ma <> 'TLDK') group by a.ngaythuchi,a.loaitk ORDER BY a.ngaythuchi,b.ID desc ";


			$result = $data->query($sql);

			$mangtam = [];
			$mangtong = [];
			$ngaythuchitam = '';
			$tongpsco = 0;
			$tongpno = 0;
			$tongtldk = 0;
			$tongtlck = 0;
			$tongtmdk = 0;
			$tongtmck = 0;

			while ($re = $data->fetch_array($result)) {



				$tongpsco += $re["tongpsco"];
				$tongpno += $re["tongpsno"];

				$tongdk = 0;
				$sql2 = "SELECT  sum(case when  a.luachon = 1 then round(a.psno) else -(round(a.psco)) end )as tong,a.loaitk FROM thuchikt a left join dinhkhoanthuchi b on a.IDcha=b.ID
			where   (b.ma <> 'TLDK' and b.ma <> 'TL') and a.ngaythuchi<'$re[ngaythuchi]' and a.loaitk='$re[loaitk]' group by a.loaitk";
				//echo $sql2;
				$dongtam = getdong($sql2);
				$tongdk = $dongtam['tong'] ? $dongtam['tong'] : 0;
				$tongck = $tongdk + ($re["tongpsno"] - $re["tongpsco"]);


				$mangtong[$re['tencuahang']] += $tongck;

				/*if($re['tencuahang']=='DNA11PDL'){
						echo $tongck;
						echo $sql2;
					}*/
				if ($ngaythuchitam == '') {
					$ngaythuchitam = $re['ngaythuchikt'];
					$mangtam[$ngaythuchitam][$re['tencuahang']] = $tongck;
				} else {
					$mangtam[$ngaythuchitam][$re['tencuahang']] = $tongck;
					if ($ngaythuchitam != $re['ngaythuchikt']) {
						$ngaythuchitam = $re['ngaythuchikt'];
						$tongpsco = 0;
						$tongpno = 0;
						$tongtldk = 0;
						$tongtlck = 0;
						$tongtmdk = 0;
						$tongtmck = 0;
					}
				}

				if ($r == ($numrow - 1)) {

					$mangtam[$ngaythuchitam][$re['tencuahang']] = $tongck;
				}

				$r++;
			}
			$dongcuoi3 = 0;

			$MangDLDN = [];
			$MangDLKH = [];
			$mangtongDLDN = ["Tổng"];
			$mangtongDLKH = [];


			foreach ($mangtam as $key => $value) {
				$tamarr = [$key];
				array_push($MangDLDN, $key);

				foreach ($mangchDN as $k => $v) {
					if ($value[$v]) {
						array_push($tamarr, $value[$v]);
					} else {
						array_push($tamarr, "");
					}

					if ($dongcuoi3 < count($mangch)) {

						if ($mangtong[$v]) {
							array_push($mangtongDLDN, $mangtong[$v]);

							$dongcuoi3++;
						} else {
							array_push($mangtongDLDN, "");
							$dongcuoi3++;
						}
						//$dongcuoi3++;
					}
				}
				foreach ($mangchKH as $k => $v) {

					if ($value[$v]) {
						array_push($tamarr, $value[$v]);
					} else {
						array_push($tamarr, "");
					}


					if ($dongcuoi3 < count($mangch)) {
						if ($mangtong[$v]) {
							array_push($mangtongDLDN, $mangtong[$v]);
							$dongcuoi3++;
						} else {

							array_push($mangtongDLDN, "");
							$dongcuoi3++;
						}
					}
				}


				//$tamarr=array_merge($MangDLDN,$MangDLKH);
				//in($tamarr);


				$writer->writeSheetRow('Sheet1', $tamarr);
			}

			$writer->writeSheetRow('Sheet1', $mangtongDLDN);
		} else if ($_POST["tonghop"] == 12) {


			include_once("includes/xlsxwriter.class.php");

			$filename = "thuchiktNTQ.xlsx";
			$writer = new XLSXWriter();
			$writer->setAuthor('datdoan');


			$sql = "select a.ID,a.macuahang,b.ma as matinh from  cuahang a left join tinh b on a.Fax=b.ID where  a.IDNhomcc <> 8 and a.macuahang <> ''";
			$mangchKH = [];
			$mangchDN = [];
			$mangch = [];
			$query = $data->query($sql);

			$arrayheaderDN = array("CH/Ngày" => "string");
			$arrayheaderKH = array();
			while ($re = $data->fetch_array($query)) {

				if ($re['matinh'] == 'DDN') {
					$arrayheaderDN[$re['macuahang']] = 'string';
					$mangchDN[$re['ID']] = $re['macuahang'];
				} else {
					$arrayheaderKH[$re['macuahang']] = 'string';
					$mangchKH[$re['ID']] = $re['macuahang'];
				}
			}
			$arrayheader = array_merge($arrayheaderDN, $arrayheaderKH);
			$writer->writeSheetHeader('Sheet1', $arrayheader);
			$mangch = array_merge($mangchDN, $mangchKH);

			$sql = "SELECT DATE_FORMAT(a.ngaythuchi,'%d/%m/%Y') as ngaythuchikt,a.ngaythuchi,a.loaitk,sum(case when  a.luachon = 1 then round(a.psno) else (round(a.psco)) end )as tong,b.macuahang as tencuahang,c.ma as matinh
 			FROM thuchikt a left join dinhkhoanthuchi d on a.IDcha=d.ID left join cuahang b on a.loaitk=b.id left join tinh c on c.ID=b.Fax " . $sql_where . " and b.IDNhomcc <> 8 and (d.ma='NTTKQ' or d.ma='NTMVQ') group by a.ngaythuchi,a.loaitk order by  a.ngaythuchi desc ";
			$result = $data->query($sql);

			$mangtam = [];
			$mangtong = [];
			$ngaythuchitam = '';
			while ($re = $data->fetch_array($result)) {


				$mangtong[$re['tencuahang']] += $re['tong'];
				if ($ngaythuchitam == '') {
					$ngaythuchitam = $re['ngaythuchikt'];


					$mangtam[$ngaythuchitam][$re['tencuahang']] = $re['tong'];

					// <th width="37" valign="middle"  ><strong>Ngày tải file </strong></th></tr>
				} else {
					$mangtam[$ngaythuchitam][$re['tencuahang']] = $re['tong'];

					if ($ngaythuchitam != $re['ngaythuchikt']) {
						$ngaythuchitam = $re['ngaythuchikt'];
					}
				}

				if ($r == ($numrow - 1)) {

					$mangtam[$ngaythuchitam][$re['tencuahang']] = $re['tong'];
				}

				$r++;
			}
			$dongcuoi3 = 0;

			$MangDLDN = [];
			$MangDLKH = [];
			$mangtongDLDN = ["Tổng"];
			$mangtongDLKH = [];


			foreach ($mangtam as $key => $value) {
				$tamarr = [$key];
				array_push($MangDLDN, $key);

				foreach ($mangchDN as $k => $v) {
					if ($value[$v]) {
						array_push($tamarr, $value[$v]);
					} else {
						array_push($tamarr, "");
					}

					if ($dongcuoi3 < count($mangch)) {

						if ($mangtong[$v]) {
							array_push($mangtongDLDN, $mangtong[$v]);

							$dongcuoi3++;
						} else {
							array_push($mangtongDLDN, "");
							$dongcuoi3++;
						}
						//$dongcuoi3++;
					}
				}
				foreach ($mangchKH as $k => $v) {

					if ($value[$v]) {
						array_push($tamarr, $value[$v]);
					} else {
						array_push($tamarr, "");
					}


					if ($dongcuoi3 < count($mangch)) {
						if ($mangtong[$v]) {
							array_push($mangtongDLDN, $mangtong[$v]);
							$dongcuoi3++;
						} else {

							array_push($mangtongDLDN, "");
							$dongcuoi3++;
						}
					}
				}


				//$tamarr=array_merge($MangDLDN,$MangDLKH);
				//in($tamarr);
				$writer->writeSheetRow('Sheet1', $tamarr);
			}

			$writer->writeSheetRow('Sheet1', $mangtongDLDN);
		} else if ($_POST["tonghop"] == 13) {
			include_once("includes/xlsxwriter.class.php");

			$filename = "baocaokettienCH.xlsx";
			$writer = new XLSXWriter();
			$writer->setAuthor('datdoan');

			$styles1 = array('font-style' => 'bold', 'fill' => '#f1ce25', 'halign' => 'center', 'border' => 'left,right,top,bottom', "border-style" => "thin");
			$styleborder = array('border' => 'left,right,top,bottom', "border-style" => "thin", 'halign' => 'center',);
			$sheet_name = 'Sheet1';

			$writer->writeSheetHeader($sheet_name, array("Doanh Thu Tự Động Phần Mềm" => "string", "string", "Thanh Toán NCC" => "string", "string", "Tiền Mặt" => "string", "string", "Chuyển Khoản" => "string", "string", "Chi Khác" => "string", "Tồn Quỹ" => "string"), $styles1);

			// $writer->writeSheetRow('Sheet1', $m );// Header
			$m = array("Ngày", "Số tiền", "Tên NCC", "Số tiền", "Nội dung", "Số tiền", "TK nhận tiền", "Số tiền", "Tổng nợ phát sinh (chi còn lại ngoài ngoài 3TK 331,111,112)", "");
			$writer->writeSheetRow($sheet_name, $m, $styleborder);

			$writer->markMergedCell($sheet_name, $start_row = 0, $start_col = 0, $end_row = 0, $end_col = 1);
			$writer->markMergedCell($sheet_name, $start_row = 0, $start_col = 2, $end_row = 0, $end_col = 3);
			$writer->markMergedCell($sheet_name, $start_row = 0, $start_col = 4, $end_row = 0, $end_col = 5);
			$writer->markMergedCell($sheet_name, $start_row = 0, $start_col = 6, $end_row = 0, $end_col = 7);
			$writer->markMergedCell($sheet_name, $start_row = 0, $start_col = 9, $end_row = 1, $end_col = 9);

			//Tạo 1 hàng trống ngăn cách ở giữa
			//	$m = array("Ngày", "Số tiền", "Tên NCC", "Số tiền", "Nội dung", "Số tiền", "TK nhận tiền", "Số tiền", "Tổng nợ phát sinh (chi còn lại ngoài ngoài 3TK 331,111,112)", "");
			//			$writer->writeSheetRow($sheet_name, $m);

			$mangrows = [];
			$mang = [];

			$sql = 'SELECT sum(case when  a.luachon = 1 then round(a.psno) else (round(a.psco)) end ) as tongtien,
			a.ngaythuchi, a.IDcha, d.madinhkhoan, c.ma, a.lydo, a.sotknh FROM thuchikt a 
			left join cuahang b on a.loaitk=b.id 
			left join dinhkhoanthuchi c on a.IDcha = c.ID 
			left join dinhkhoan d on a.tkno = d.ID
			' . $sql_where . ' 
			and (c.ma="CTTNCC" or c.ma="DTBH" or d.madinhkhoan in(111,1111) or d.madinhkhoan = 112 ) 
			group by a.ngaythuchi,a.loaitk, a.IDcha, a.tkno ORDER BY a.ngaythuchi,b.ID, a.IDcha desc';
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
			' . $sql_where . ' 
			and (c.ma <> "CTTNCC" and c.ma <> "DTBH" and d.madinhkhoan not in(111,1111) and d.madinhkhoan <> 112 )
			group by a.ngaythuchi,a.loaitk ORDER BY a.ngaythuchi,b.ID, a.IDcha desc';

			$result = $data->query($sql);
			while ($rows = $data->fetch_array($result)) {
				if (key_exists($rows['ngaythuchi'], $mangrows)) {
					$mangrows[$rows['ngaythuchi']]['chikhac'] = $rows['tongtien'];
				}
			}

			$tongtmdk = 0;
			foreach ($mangrows as $key => $value) {

				$sql2 = "SELECT sum(case when  a.luachon = 1 then round(a.psno) else -(round(a.psco)) end )as tong,a.loaitk FROM thuchikt a left join cuahang b on a.loaitk=b.id  
					where  a.IDcha not in (select ID from dinhkhoanthuchi where ma='TLDK' or ma='TL') and a.ngaythuchi<'" . $value["doanhthu"][0] . "' and a.loaitk='$kho' group by a.loaitk";

				$dongtam = getdong($sql2);
				$tongdk = $dongtam['tong'] ? $dongtam['tong'] : 0;
				$tongtmdk = ($tongdk > 0 || $tongdk < 0) ? round($tongdk) : 0;

				$m = array(
					$value["doanhthu"][0],
					number_format($value["doanhthu"][1]),
					$value['nhacc'][0],
					number_format($value['nhacc'][1]),
					$value['tienmat'][0],
					number_format($value['tienmat'][1]),
					$value['chuyenkhoan'][0],
					number_format($value['chuyenkhoan'][1]),
					number_format($value['chikhac']),
					number_format($tongtmdk)
				);
				$writer->writeSheetRow($sheet_name, $m, $styleborder);
			}
		} else if ($_POST["tonghop"] == 14) {
			$sql_where = "";
			if ($manv != "") {
				$sql_where .= " and a.manv = '$manv'";
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
				$sql_where  .= " and b.NgayTao>= '$ngay[2]-$ngay[1]-$ngay[0]'";
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
				$sql_where  .= " and b.NgayTao <= '$ngay[2]-$ngay[1]-$ngay[0] 23:59'";
			}

			include_once("includes/xlsxwriter.class.php");

			$filename = "Báo_Cáo_Lương_Online.xlsx";
			$writer = new XLSXWriter();

			$styles1 = array('font-style' => 'bold', 'fill' => '#f1ce25', 'halign' => 'center', 'border' => 'left,right,top,bottom', "border-style" => "thin");
			$styleborder = array('border' => 'left,right,top,bottom', "border-style" => "thin", 'halign' => 'center', 'font-style' => 'bold',[],[],[],["fill" => "#2825e0"],["fill" => "#da25e0"],["fill" => "#2825e0"], 'fill' => '#e07b22');
			$stylefooter = array(["fill" => "#da25e0"],["fill" => "#2825e0"]);
			$sheet_name = 'Sheet1';

			$writer->writeSheetHeader(
				'Sheet1',
				array(
					"STT" => "integer", "Tên NV" => "string", "Mã NV" => "string",
					"SP < 30K không áp dụng đồng giá SP (DT PM)" => "string", "string", "string", "string", "string",
					"SP < 30K không áp dụng đồng giá SP (DT PASS)" => "string", "string", "string", "string", "string",
					"SP >= 30K ĐẾN < 100K (DT PM)" => "string", "string", "string", "string", "string",
					"SP >= 30K ĐẾN < 100K (DT PASS)" => "string", "string", "string", "string", "string",
					"SP >= 100K ĐẾN < 180K (DT PM)" => "string", "string", "string", "string", "string",
					"SP >= 100K ĐẾN < 180K (DT PASS)" => "string", "string", "string", "string", "string",
					"SP >= 180K (DT PM)" => "string", "string", "string", "string", "string",
					"SP >= 180K (DT PASS)" => "string", "string", "string", "string", "string",
					"SẢN PHẨM ÁP DỤNG CT SALE ( trừ CT áp dụng voucher 10%)" => "string", "string", "string", "string", "string",
					"SẢN PHẨM ÁP DỤNG CT SALE ( trừ CT áp dụng voucher 10%) PASS ĐƠN" => "string", "string", "string", "string", "string",
					"TỔNG HOA HỒNG THỰC NHẬN" => "string",
					"TỔNG SỐ LƯỢNG SẢN PHẨM ĐƠN ĐI THÀNH CÔNG" => "string",
					"DOANH THU TRONG THÁNG HOÀN VỀ PM" => "string", "string",
					"DOANH THU TRONG THÁNG HOÀN VỀ PASS ĐƠN" => "string", "string",
					"DOANH THU  HOÀN VỀ THÁNG TRƯỚC PM" => "string", "string",
					"DOANH THU  HOÀN VỀ THÁNG TRƯỚC PASS ĐƠN" => "string", "string",
				),
				$styles1
			);

			// $writer->writeSheetRow('Sheet1', $m );// Header
			$m = array(
				"", "", "",
				"DOANH THU", "SỐ LƯỢNG SP", "DOANH THU TRUNG BÌNH", "HOA HỒNG", "HOA HỒNG NHẬN",
				"DOANH THU", "SỐ LƯỢNG ĐƠN HÀNG", "DOANH THU TRUNG BÌNH", "HOA HỒNG", "HOA HỒNG NHẬN",
				"DOANH THU", "SỐ LƯỢNG ĐƠN HÀNG", "DOANH THU TRUNG BÌNH", "HOA HỒNG", "HOA HỒNG NHẬN",
				"DOANH THU", "SỐ LƯỢNG ĐƠN HÀNG", "DOANH THU TRUNG BÌNH", "HOA HỒNG", "HOA HỒNG NHẬN",
				"DOANH THU", "SỐ LƯỢNG SP", "DOANH THU TRUNG BÌNH", "HOA HỒNG", "HOA HỒNG NHẬN",
				"DOANH THU", "SỐ LƯỢNG ĐƠN HÀNG", "DOANH THU TRUNG BÌNH", "HOA HỒNG", "HOA HỒNG NHẬN",
				"DOANH THU", "SỐ LƯỢNG SP", "DOANH THU TRUNG BÌNH", "HOA HỒNG", "HOA HỒNG NHẬN",
				"DOANH THU", "SỐ LƯỢNG ĐƠN HÀNG", "DOANH THU TRUNG BÌNH", "HOA HỒNG", "HOA HỒNG NHẬN",
				"DOANH THU", "SỐ LƯỢNG ĐƠN HÀNG", "DOANH THU TRUNG BÌNH", "HOA HỒNG", "HOA HỒNG NHẬN",
				"DOANH THU", "SỐ LƯỢNG ĐƠN HÀNG", "DOANH THU TRUNG BÌNH", "HOA HỒNG", "HOA HỒNG NHẬN",
				"",
				"",
				"DOANH THU", "SỐ LƯỢNG SP",
				"DOANH THU", "SỐ LƯỢNG SP",
				"DOANH THU", "SỐ LƯỢNG SP",
				"DOANH THU", "SỐ LƯỢNG SP"
			);
			$writer->writeSheetRow('Sheet1', $m, $styleborder);

			$writer->markMergedCell($sheet_name, $start_row = 0, $start_col = 0, $end_row = 1, $end_col = 0);
			$writer->markMergedCell($sheet_name, $start_row = 0, $start_col = 1, $end_row = 1, $end_col = 1);
			$writer->markMergedCell($sheet_name, $start_row = 0, $start_col = 2, $end_row = 1, $end_col = 2);

			$writer->markMergedCell($sheet_name, $start_row = 0, $start_col = 3, $end_row = 0, $end_col = 7);
			$writer->markMergedCell($sheet_name, $start_row = 0, $start_col = 8, $end_row = 0, $end_col = 12);
			$writer->markMergedCell($sheet_name, $start_row = 0, $start_col = 13, $end_row = 0, $end_col = 17);
			$writer->markMergedCell($sheet_name, $start_row = 0, $start_col = 18, $end_row = 0, $end_col = 22);
			$writer->markMergedCell($sheet_name, $start_row = 0, $start_col = 23, $end_row = 0, $end_col = 27);
			$writer->markMergedCell($sheet_name, $start_row = 0, $start_col = 28, $end_row = 0, $end_col = 32);
			$writer->markMergedCell($sheet_name, $start_row = 0, $start_col = 33, $end_row = 0, $end_col = 37);
			$writer->markMergedCell($sheet_name, $start_row = 0, $start_col = 38, $end_row = 0, $end_col = 42);
			$writer->markMergedCell($sheet_name, $start_row = 0, $start_col = 43, $end_row = 0, $end_col = 47);
			$writer->markMergedCell($sheet_name, $start_row = 0, $start_col = 48, $end_row = 0, $end_col = 52);

			$writer->markMergedCell($sheet_name, $start_row = 0, $start_col = 53, $end_row = 1, $end_col = 53);
			$writer->markMergedCell($sheet_name, $start_row = 0, $start_col = 54, $end_row = 1, $end_col = 54);

			$writer->markMergedCell($sheet_name, $start_row = 0, $start_col = 55, $end_row = 0, $end_col = 56);
			$writer->markMergedCell($sheet_name, $start_row = 0, $start_col = 57, $end_row = 0, $end_col = 58);
			$writer->markMergedCell($sheet_name, $start_row = 0, $start_col = 59, $end_row = 0, $end_col = 60);
			$writer->markMergedCell($sheet_name, $start_row = 0, $start_col = 61, $end_row = 0, $end_col = 62);

			$sql = "select b.diachiN as IDNV,b.NgayTao, 
			/*========== Doanh Thu SP < 30K và không đồng giá ==========*/
			sum(case when(a.DonGia between 1 and 29999) 
					 and a.IDtao = a.DonGia /*Không đồng giá*/
					 and b.idchOL = 0
				 and d.dongthoigiantrangthaidon = 1 then (ceil(a.DonGia*(1-1*a.chietkhau/100))*a.SoLuong) else 0 end) as dtpmduoi30,
			sum(case when(a.DonGia between 1 and 29999) 
					 and a.IDtao = a.DonGia /*Không đồng giá*/
					 and b.idchOL = 0 
				 and d.dongthoigiantrangthaidon = 1 then a.SoLuong else 0 end) as tongsoluongpmduoi30,
			
			sum(case when(a.DonGia between 1 and 29999) 
					 and a.IDtao = a.DonGia /*Không đồng giá*/
					 and b.idchOL <> 0 /*DT Pass*/ 
				 and d.dongthoigiantrangthaidon = 1 then (ceil(a.DonGia*(1-1*a.chietkhau/100))*a.SoLuong) else 0 end) as dtpassduoi30,
			sum(case when(a.DonGia between 1 and 29999) 
					 and a.IDtao = a.DonGia /*Không đồng giá*/
					 and b.idchOL <> 0 /*DT Pass*/
				 and d.dongthoigiantrangthaidon = 1 then a.SoLuong else 0 end) as tongdonpassduoi30,
			
			/*================ Doanh Thu SP >= 30K và < 100K ==================*/
			sum(case when(a.DonGia between 30000 and 99999) 
					/* and a.IDtao = a.DonGia Không đồng giá*/
					 and b.idchOL = 0
				 and d.dongthoigiantrangthaidon = 1 then (ceil(a.DonGia*(1-1*a.chietkhau/100))*a.SoLuong) else 0 end) as dtpmtu30den100,
			sum(case when(a.DonGia between 30000 and 99999) 
					 /* and a.IDtao = a.DonGia Không đồng giá*/
					 and b.idchOL = 0
				 and d.dongthoigiantrangthaidon = 1 then a.SoLuong else 0 end) as tongsoluongpmtu30den100,
			
			sum(case when(a.DonGia between 30000 and 99999) 
					 /* and a.IDtao = a.DonGia Không đồng giá*/
					 and b.idchOL <> 0 /*DT Pass*/ 
				 and d.dongthoigiantrangthaidon = 1 then (ceil(a.DonGia*(1-1*a.chietkhau/100))*a.SoLuong) else 0 end) as dtpasstu30den100,
			sum(case when(a.DonGia between 30000 and 99999) 
					 /* and a.IDtao = a.DonGia Không đồng giá*/
					 and b.idchOL <> 0 /*DT Pass*/
				 and d.dongthoigiantrangthaidon = 1 then a.SoLuong else 0 end) as tongdonpasstu30den100,
			               
			/*=========== Doanh Thu SP >= 100K và < 180K ================*/
			sum(case when(a.DonGia between 100000 and 179999) 
					/* and a.IDtao = a.DonGia Không đồng giá*/
					 and b.idchOL = 0 
				 and d.dongthoigiantrangthaidon = 1 then (ceil(a.DonGia*(1-1*a.chietkhau/100))*a.SoLuong) else 0 end) as dtpmtu100den180,
			sum(case when(a.DonGia between 100000 and 179999) 
					 /* and a.IDtao = a.DonGia Không đồng giá*/
					 and b.idchOL = 0 
				 and d.dongthoigiantrangthaidon = 1 then a.SoLuong else 0 end) as tongsoluongpmtu100den180,
			
			sum(case when(a.DonGia between 100000 and 179999) 
					 /* and a.IDtao = a.DonGia Không đồng giá*/
					 and b.idchOL <> 0 /*DT Pass*/ 
				 and d.dongthoigiantrangthaidon = 1 then (ceil(a.DonGia*(1-1*a.chietkhau/100))*a.SoLuong) else 0 end) as dtpasstu100den180,
			sum(case when(a.DonGia between 100000 and 179999) 
					 /* and a.IDtao = a.DonGia Không đồng giá*/
					 and b.idchOL <> 0 /*DT Pass*/ 
				 and d.dongthoigiantrangthaidon = 1 then a.SoLuong else 0 end) as tongdonpasstu100den180,
			
			/*=========== Doanh Thu SP >= 180K ================*/
			sum(case when(a.DonGia >= 180000) 
					 and b.idchOL = 0 
				 and d.dongthoigiantrangthaidon = 1 then (ceil(a.DonGia*(1-1*a.chietkhau/100))*a.SoLuong) else 0 end) as dtpmtu180,
			sum(case when(a.DonGia >= 180000) 
					 and b.idchOL = 0 
				 and d.dongthoigiantrangthaidon = 1 then a.SoLuong else 0 end) as tongsoluongpmtu180,
			
			sum(case when(a.DonGia >= 180000) 
					 and b.idchOL <> 0 /*DT Pass*/ 
				 and d.dongthoigiantrangthaidon = 1 then (ceil(a.DonGia*(1-1*a.chietkhau/100))*a.SoLuong) else 0 end) as dtpasstu180,
			sum(case when(a.DonGia >= 180000) 
					 and b.idchOL <> 0 /*DT Pass*/ 
				 and d.dongthoigiantrangthaidon = 1 then a.SoLuong else 0 end) as tongdonpasstu180,
			
			/* =============== Sản Phẩm áp dụng CT KM PM =============*/
	sum(case when e.sotien <> 10 and b.idchOL = 0  then (ceil(a.DonGia*(1-1*a.chietkhau/100))*a.SoLuong) else 0 end) as dtspctkhuyenmai,
	sum(case when e.sotien <> 10 and b.idchOL = 0  then 1 else 0 end) as tongdonspctkhuyenmai,
	
	/* =============== Sản Phẩm áp dụng CT KM PASS DƠN =============*/
	sum(case when e.sotien <> 10 and b.idchOL <> 0  then (ceil(a.DonGia*(1-1*a.chietkhau/100))*a.SoLuong) else 0 end) as dtspctkhuyenmaipass,
	sum(case when e.sotien <> 10 and b.idchOL <> 0  then 1 else 0 end) as tongdonspctkhuyenmaipass,
	
			/* ========= Tổng Số Lượng SP bán ra ==========*/
			sum(case when d.dongthoigiantrangthaidon = 1 then a.SoLuong else 0 end) as tongsoluongsphoanthanh,
			/* ========= Doanh Thu Trong Tháng Hoàn Về ==========*/
			Sum(case when dongthoigiantrangthaidon=8 
				and (MONTH(b.NgayTao) = MONTH(b.NgayTao) and YEAR(b.NgayTao) = YEAR(b.NgayTao)) 
				and b.idchOL = 0
				then (ceil(a.DonGia*(1-1*a.chietkhau/100))*a.SoLuong) else 0 end) as dthoanvetrongthangpm,
			Sum(case when dongthoigiantrangthaidon=8 
				and (MONTH(b.NgayTao) = MONTH(b.NgayTao) and YEAR(b.NgayTao) = YEAR(b.NgayTao))
				and b.idchOL = 0
				then a.SoLuong else 0 end) as dthoanvetrongthangslsppm,
			Sum(case when dongthoigiantrangthaidon=8 
				and (MONTH(b.NgayTao) = MONTH(b.NgayTao) and YEAR(b.NgayTao) = YEAR(b.NgayTao)) 
				and b.idchOL <> 0
				then (ceil(a.DonGia*(1-1*a.chietkhau/100))*a.SoLuong) else 0 end) as dthoanvetrongthangpass,
			Sum(case when dongthoigiantrangthaidon=8 
				and (MONTH(b.NgayTao) = MONTH(b.NgayTao) and YEAR(b.NgayTao) = YEAR(b.NgayTao))
				and b.idchOL <> 0
				then a.SoLuong else 0 end) as dthoanvetrongthangslsppass
			from phieunhapxuat b 
			left join xuatbanhang a on a.IDphieu=b.ID 
			left join vanchuyenonline d on b.ID = d.IDbill 
			left join phieukhuyenmai e on b.NguoiGiao= e.maso 
			where b.lydo>45 and (dongthoigiantrangthaidon=1 or dongthoigiantrangthaidon=8)
			and b.idkho = 1105  
			" . $sql_where . "
			
			group by b.diachiN /*ID nhân viên*/";
			
			$hoahongduoi30 = 1000;
			$hoahongtu30den100 = 2500;
			$hoahongtu100den180 = 4000;
			$hoahongtren180 = 5000;
			$hoahongapdungvc = 2500;

			$query = $data->query($sql);
			$i = 1;
			$mangnv = taomang("userac", "ID", "MaNV");
			$mangten = taomang("userac", "ID", "ten");
			while ($rows = $data->fetch_array($query)) {
				$sql = "Select Sum(case when d.dongthoigiantrangthaidon=8 
					and (MONTH(b.NgayTao) = MONTH('" . $rows['NgayTao'] . "')-1 and YEAR(b.NgayTao) = YEAR('" . $rows['NgayTao'] . "')) 
					and b.idchOL = 0
					then (ceil(a.DonGia*(1-1*a.chietkhau/100))*a.SoLuong) else 0 end) as dthoanvethangtruocpm,
				Sum(case when d.dongthoigiantrangthaidon=8 
					and (MONTH(b.NgayTao) = MONTH('" . $rows['NgayTao'] . "')-1 and YEAR(b.NgayTao) = YEAR('" . $rows['NgayTao'] . "'))
					and b.idchOL = 0
					then a.SoLuong else 0 end) as dthoanvethangtruocslsppm,
				Sum(case when d.dongthoigiantrangthaidon=8 
					and (MONTH(b.NgayTao) = MONTH('" . $rows['NgayTao'] . "')-1 and YEAR(b.NgayTao) = YEAR('" . $rows['NgayTao'] . "')) 
					and b.idchOL <> 0
					then (ceil(a.DonGia*(1-1*a.chietkhau/100))*a.SoLuong) else 0 end) as dthoanvethangtruocpass,
				Sum(case when d.dongthoigiantrangthaidon=8 
					and (MONTH(b.NgayTao) = MONTH('" . $rows['NgayTao'] . "')-1 and YEAR(b.NgayTao) = YEAR('" . $rows['NgayTao'] . "'))
					and b.idchOL <> 0
					then a.SoLuong else 0 end) as dthoanvethangtruocslsppass
				from phieunhapxuat b 
				left join  xuatbanhang a on a.IDphieu=b.ID 
				left join vanchuyenonline d on b.ID = d.IDbill 
				left join phieukhuyenmai e on b.NguoiGiao= e.maso 
				where b.lydo>45 and b.idkho = 1105 
				and b.diachiN = '" . $rows["IDNV"] . "'
				group by b.diachiN";
				$res = getdong($sql);
				$hoahongduoi30pm = 0;
				$hoahongduoi30pass = 0;
				$hoahong30den100pm = 0;
				$hoahong30den100pass = 0;
				$hoahong100den180pm = 0;
				$hoahong100den180pass = 0;
				$hoahongtren180pm = 0;
				$hoahongtren180pass = 0;
				$hoahongkm = 0;
				$hoahongkmpass = 0;

				if ($rows['tongsoluongpmduoi30']) {
					$hoahongduoi30pm = $rows['tongsoluongpmduoi30'] * $hoahongduoi30;
				}

				if ($rows['tongdonpassduoi30']) {
					$hoahongduoi30pass = $rows['tongdonpassduoi30'] * $hoahongduoi30;
				}

				if ($rows['tongsoluongpmtu30den100']) {
					$hoahong30den100pm = $rows['tongsoluongpmtu30den100'] * $hoahongtu30den100;
				}
				if ($rows['tongdonpasstu30den100']) {
					$hoahong30den100pass = $rows['tongdonpasstu30den100'] * $hoahongtu30den100;
				}
				if ($rows['tongsoluongpmtu100den180']) {
					$hoahong100den180pm = $rows['tongsoluongpmtu100den180'] * $hoahongtu100den180;
				}
				if ($rows['tongdonpasstu100den180']) {
					$hoahong100den180pass = $rows['tongdonpasstu100den180'] * $hoahongtu100den180;
				}

				if ($rows['tongsoluongpmtu180']) {
					$hoahongtren180pm = $rows['tongsoluongpmtu180'] * $hoahongtren180;
				}

				if ($rows['tongdonpasstu180']) {
					$hoahongtren180pass = $rows['tongdonpasstu180'] * $hoahongtren180;
				}
				if ($rows['tongdonspctkhuyenmai']) {
					$hoahongkm = $rows['tongdonspctkhuyenmai'] * $hoahongapdungvc;
				}

				if ($rows['tongdonspctkhuyenmaipass']) {
					$hoahongkmpass = $rows['tongdonspctkhuyenmaipass'] * $hoahongapdungvc;
				}
				$tonghoahongduoi30pm += $hoahongduoi30pm;
				$tonghoahongduoi30pass += $hoahongduoi30pass;
				$tonghoahongtu30den100pm += $hoahong30den100pm;
				$tonghoahongtu30den100pass += $hoahong30den100pass;
				$tonghoahongtu100den180pm += $hoahong100den180pm;
				$tonghoahongtu100den180pass += $hoahong100den180pass;
				$tonghoahongtren180pm += $hoahongtren180pm;
				$tonghoahongtren180pass += $hoahongtren180pass;
				$tonghoahongkm += $hoahongkm;
				$tonghoahongkmpass += $hoahongkmpass;

				$tonghoahongthucnhan = $hoahongduoi30pm+$hoahongduoi30pass+$hoahong30den100pm+$hoahong30den100pass+$hoahong100den180pm+$hoahong100den180pass+$hoahongtren180pm+$hoahongtren180pass+$hoahongkm+$hoahongkmpass;

				$m = array(
					$i++, $mangten[$rows['IDNV']], $mangnv[$rows['IDNV']],
					number_format($rows['dtpmduoi30']), number_format($rows['tongsoluongpmduoi30']), number_format(ceil($rows['dtpmduoi30']/$rows['tongsoluongpmduoi30'])), number_format($hoahongduoi30), number_format($hoahongduoi30pm),

					number_format($rows['dtpassduoi30']), number_format($rows['tongdonpassduoi30']), number_format(ceil($rows['dtpassduoi30']/$rows['tongdonpassduoi30'])), number_format($hoahongduoi30), number_format($hoahongduoi30pass),

					number_format($rows["dtpmtu30den100"]), number_format($rows["tongsoluongpmtu30den100"]), number_format(ceil($rows["dtpmtu30den100"]/$rows["tongsoluongpmtu30den100"])), number_format($hoahongtu30den100), number_format($hoahong30den100pm),

					number_format($rows["dtpasstu30den100"]), number_format($rows["tongdonpasstu30den100"]), number_format(ceil($rows["dtpasstu30den100"]/$rows["tongdonpasstu30den100"])), number_format($hoahongtu30den100), number_format($hoahong30den100pass),

					number_format($rows["dtpmtu100den180"]), number_format($rows["tongsoluongpmtu100den180"]), number_format(ceil($rows["dtpmtu100den180"]/$rows["tongsoluongpmtu100den180"])), number_format($hoahongtu100den180), number_format($hoahong100den180pm),

					number_format($rows["dtpasstu100den180"]), number_format($rows["tongdonpasstu100den180"]), number_format(ceil($rows["dtpasstu100den180"]/$rows["tongdonpasstu100den180"])), number_format($hoahongtu100den180), number_format($hoahong100den180pass),

					number_format($rows["dtpmtu180"]), number_format($rows["tongsoluongpmtu180"]), number_format(ceil($rows["dtpmtu180"]/$rows["tongsoluongpmtu180"])), number_format($hoahongtren180), number_format($hoahongtren180pm),

					number_format($rows["dtpasstu180"]), number_format($rows["tongdonpasstu180"]), number_format(ceil($rows["dtpasstu180"]/$rows["tongdonpasstu180"])), number_format($hoahongtren180), number_format($hoahongtren180pass),

					number_format($rows["dtspctkhuyenmai"]), number_format($rows["tongdonspctkhuyenmai"]), number_format(ceil($rows["dtspctkhuyenmai"]/$rows["tongdonspctkhuyenmai"])), number_format($hoahongapdungvc), number_format($hoahongkm),

					number_format($rows["dtspctkhuyenmaipass"]), number_format($rows["tongdonspctkhuyenmaipass"]), number_format(ceil($rows["dtspctkhuyenmaipass"]/$rows["tongdonspctkhuyenmaipass"])), number_format($hoahongapdungvc), number_format($hoahongkmpass),

					number_format($tonghoahongthucnhan),
					number_format($rows['tongsoluongsphoanthanh']), 

					number_format($rows['dthoanvetrongthangpm']), number_format($rows['soluongsphoanvetrongthangpm']),
					number_format($rows['dthoanvetrongthangpass']), number_format($rows['soluongsphoanvetrongthangpass']), 
					number_format($res['dthoanvethangtruocpm']), number_format($res['dthoanvethangtruocslsppm']),
					number_format($res['dthoanvethangtruocpass']), number_format($res['dthoanvethangtruocslsppass'])
				);

				$writer->writeSheetRow('Sheet1', $m);
			}

			$writer->writeSheetRow('Sheet1', array("", "", "", "", "", "", number_format($tonghoahongduoi30pm), "", "", "", number_format($tonghoahongduoi30pass), "", "", "", number_format($tonghoahongtu30den100pm), "", "", "", number_format($tonghoahongtu30den100pass), "", "", "", number_format($tonghoahongtu100den180pm), "", "", "", number_format($tonghoahongtu100den180pass), "", "", "", number_format($tonghoahongtren180pm), "", "", "", number_format($tonghoahongtren180pass), "", "", "", number_format($tonghoahongkm), "", "", "", number_format($tonghoahongkmpass), "", "", "", ""), $stylefooter);
		} else if ($_POST["tonghop"] == 15) {
			$sql_where = "";
			if ($manv != "") {
				$sql_where .= " and a.manv = '$manv'";
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
				$sql_where  .= " and b.NgayTao>= '$ngay[2]-$ngay[1]-$ngay[0]'";
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
				$sql_where  .= " and b.NgayTao <= '$ngay[2]-$ngay[1]-$ngay[0] 23:59'";

				$sql_where .= " and d.ngayhoanthanh <= '$ngay[2]-" . ($ngay[1] + 1) . "-05' ";
				$caulenh_dthuthangtruoc = "  and d.ngayhoanthanh <= '$ngay[2]-" . ($ngay[1] + 1) . "-05' ";
			}

			include_once("includes/xlsxwriter.class.php");

			$filename = "Báo_Cáo_Lương_Online_Tiktok.xlsx";
			$writer = new XLSXWriter();

			$styles1 = array('font-style' => 'bold', 'fill' => '#f1ce25', 'halign' => 'center', 'border' => 'left,right,top,bottom', "border-style" => "thin");
			$styleborder = array('border' => 'left,right,top,bottom', "border-style" => "thin", 'halign' => 'center', 'fill' => '#e07b22', 'font-style' => 'bold');
			$stylefooter = array("font-style" => "bold", "halign" => "center", 'border' => 'left,right,top,bottom', "border-style" => "thin");
			$sheet_name = 'Sheet1';

			$writer->writeSheetHeader(
				'Sheet1',
				array(
					"STT" => "integer", "Tên NV" => "string", "Mã NV" => "string",
					"SP < 30K không áp dụng đồng giá SP (DT PM)" => "string", "string", "string", "string", "string",
					"SP < 30K không áp dụng đồng giá SP (DT PASS)" => "string", "string", "string", "string", "string",
					"SP >= 30K ĐẾN < 100K (DT PM)" => "string", "string", "string", "string", "string",
					"SP >= 30K ĐẾN < 100K (DT PASS)" => "string", "string", "string", "string", "string",
					"SP >= 100K ĐẾN < 180K (DT PM)" => "string", "string", "string", "string", "string",
					"SP >= 100K ĐẾN < 180K (DT PASS)" => "string", "string", "string", "string", "string",
					"SP >= 180K (DT PM)" => "string", "string", "string", "string", "string",
					"SP >= 180K (DT PASS)" => "string", "string", "string", "string", "string",
					"SẢN PHẨM ÁP DỤNG CT SALE ( trừ CT áp dụng voucher 10%)" => "string", "string", "string", "string", "string",
					"SẢN PHẨM ÁP DỤNG CT SALE ( trừ CT áp dụng voucher 10%) PASS ĐƠN" => "string", "string", "string", "string", "string",
					"TỔNG HOA HỒNG THỰC NHẬN" => "string",
					"TỔNG SỐ LƯỢNG SẢN PHẨM ĐƠN ĐI THÀNH CÔNG" => "string",
					"DOANH THU TRONG THÁNG HOÀN VỀ" => "string", "string",
					"DOANH THU  HOÀN VỀ THÁNG TRƯỚC" => "string", "string",
				),
				$styles1
			);

			// $writer->writeSheetRow('Sheet1', $m );// Header
			$m = array(
				"", "", "",
				"DOANH THU", "SỐ LƯỢNG SP", "DOANH THU TRUNG BÌNH", "HOA HỒNG", "HOA HỒNG NHẬN",
				"DOANH THU", "SỐ LƯỢNG ĐƠN HÀNG", "DOANH THU TRUNG BÌNH", "HOA HỒNG", "HOA HỒNG NHẬN",
				"DOANH THU", "SỐ LƯỢNG ĐƠN HÀNG", "DOANH THU TRUNG BÌNH", "HOA HỒNG", "HOA HỒNG NHẬN",
				"DOANH THU", "SỐ LƯỢNG ĐƠN HÀNG", "DOANH THU TRUNG BÌNH", "HOA HỒNG", "HOA HỒNG NHẬN",
				"DOANH THU", "SỐ LƯỢNG SP", "DOANH THU TRUNG BÌNH", "HOA HỒNG", "HOA HỒNG NHẬN",
				"DOANH THU", "SỐ LƯỢNG ĐƠN HÀNG", "DOANH THU TRUNG BÌNH", "HOA HỒNG", "HOA HỒNG NHẬN",
				"DOANH THU", "SỐ LƯỢNG SP", "DOANH THU TRUNG BÌNH", "HOA HỒNG", "HOA HỒNG NHẬN",
				"DOANH THU", "SỐ LƯỢNG ĐƠN HÀNG", "DOANH THU TRUNG BÌNH", "HOA HỒNG", "HOA HỒNG NHẬN",
				"DOANH THU", "SỐ LƯỢNG ĐƠN HÀNG", "DOANH THU TRUNG BÌNH", "HOA HỒNG", "HOA HỒNG NHẬN",
				"DOANH THU", "SỐ LƯỢNG ĐƠN HÀNG", "DOANH THU TRUNG BÌNH", "HOA HỒNG", "HOA HỒNG NHẬN",
				"",
				"",
				"DOANH THU", "SỐ LƯỢNG SP",
				"DOANH THU", "SỐ LƯỢNG SP"
			);
			$writer->writeSheetRow('Sheet1', $m, $styleborder);

			$writer->markMergedCell($sheet_name, $start_row = 0, $start_col = 0, $end_row = 1, $end_col = 0);
			$writer->markMergedCell($sheet_name, $start_row = 0, $start_col = 1, $end_row = 1, $end_col = 1);
			$writer->markMergedCell($sheet_name, $start_row = 0, $start_col = 2, $end_row = 1, $end_col = 2);

			$writer->markMergedCell($sheet_name, $start_row = 0, $start_col = 3, $end_row = 0, $end_col = 7);
			$writer->markMergedCell($sheet_name, $start_row = 0, $start_col = 8, $end_row = 0, $end_col = 12);
			$writer->markMergedCell($sheet_name, $start_row = 0, $start_col = 13, $end_row = 0, $end_col = 17);
			$writer->markMergedCell($sheet_name, $start_row = 0, $start_col = 18, $end_row = 0, $end_col = 22);
			$writer->markMergedCell($sheet_name, $start_row = 0, $start_col = 23, $end_row = 0, $end_col = 27);
			$writer->markMergedCell($sheet_name, $start_row = 0, $start_col = 28, $end_row = 0, $end_col = 32);
			$writer->markMergedCell($sheet_name, $start_row = 0, $start_col = 33, $end_row = 0, $end_col = 37);
			$writer->markMergedCell($sheet_name, $start_row = 0, $start_col = 38, $end_row = 0, $end_col = 42);
			$writer->markMergedCell($sheet_name, $start_row = 0, $start_col = 43, $end_row = 0, $end_col = 47);
			$writer->markMergedCell($sheet_name, $start_row = 0, $start_col = 48, $end_row = 0, $end_col = 52);

			$writer->markMergedCell($sheet_name, $start_row = 0, $start_col = 53, $end_row = 1, $end_col = 53);
			$writer->markMergedCell($sheet_name, $start_row = 0, $start_col = 54, $end_row = 1, $end_col = 54);

			$writer->markMergedCell($sheet_name, $start_row = 0, $start_col = 55, $end_row = 0, $end_col = 56);
			$writer->markMergedCell($sheet_name, $start_row = 0, $start_col = 57, $end_row = 0, $end_col = 58);

			$sql = "select b.diachiN as IDNV,b.NgayTao, 
				/*========== Doanh Thu SP < 30K và không đồng giá ==========*/
				sum(case when(a.DonGia between 1 and 29999) 
						and a.IDtao = a.DonGia /*Không đồng giá*/
						and b.idchOL = 0
					and d.dongthoigiantrangthaidon = 1 then (ceil(a.DonGia*(1-1*a.chietkhau/100))*a.SoLuong) else 0 end) as dtpmduoi30,
				sum(case when(a.DonGia between 1 and 29999) 
						and a.IDtao = a.DonGia /*Không đồng giá*/
						and b.idchOL = 0 
					and d.dongthoigiantrangthaidon = 1 then a.SoLuong else 0 end) as tongsoluongpmduoi30,
				
				sum(case when(a.DonGia between 1 and 29999) 
						and a.IDtao = a.DonGia /*Không đồng giá*/
						and b.idchOL <> 0 /*DT Pass*/ 
					and d.dongthoigiantrangthaidon = 1 then (ceil(a.DonGia*(1-1*a.chietkhau/100))*a.SoLuong) else 0 end) as dtpassduoi30,
				sum(case when(a.DonGia between 1 and 29999) 
						and a.IDtao = a.DonGia /*Không đồng giá*/
						and b.idchOL <> 0 /*DT Pass*/
					and d.dongthoigiantrangthaidon = 1 then a.SoLuong else 0 end) as tongdonpassduoi30,
				
				/*================ Doanh Thu SP >= 30K và < 100K ==================*/
				sum(case when(a.DonGia between 30000 and 99999) 
						/* and a.IDtao = a.DonGia Không đồng giá*/
						and b.idchOL = 0
					and d.dongthoigiantrangthaidon = 1 then (ceil(a.DonGia*(1-1*a.chietkhau/100))*a.SoLuong) else 0 end) as dtpmtu30den100,
				sum(case when(a.DonGia between 30000 and 99999) 
						/* and a.IDtao = a.DonGia Không đồng giá*/
						and b.idchOL = 0
					and d.dongthoigiantrangthaidon = 1 then a.SoLuong else 0 end) as tongsoluongpmtu30den100,
				
				sum(case when(a.DonGia between 30000 and 99999) 
						/* and a.IDtao = a.DonGia Không đồng giá*/
						and b.idchOL <> 0 /*DT Pass*/ 
					and d.dongthoigiantrangthaidon = 1 then (ceil(a.DonGia*(1-1*a.chietkhau/100))*a.SoLuong) else 0 end) as dtpasstu30den100,
				sum(case when(a.DonGia between 30000 and 99999) 
						/* and a.IDtao = a.DonGia Không đồng giá*/
						and b.idchOL <> 0 /*DT Pass*/
					and d.dongthoigiantrangthaidon = 1 then a.SoLuong else 0 end) as tongdonpasstu30den100,
				               
				/*=========== Doanh Thu SP >= 100K và < 180K ================*/
				sum(case when(a.DonGia between 100000 and 179999) 
						/* and a.IDtao = a.DonGia Không đồng giá*/
						and b.idchOL = 0 
					and d.dongthoigiantrangthaidon = 1 then (ceil(a.DonGia*(1-1*a.chietkhau/100))*a.SoLuong) else 0 end) as dtpmtu100den180,
				sum(case when(a.DonGia between 100000 and 179999) 
						/* and a.IDtao = a.DonGia Không đồng giá*/
						and b.idchOL = 0 
					and d.dongthoigiantrangthaidon = 1 then a.SoLuong else 0 end) as tongsoluongpmtu100den180,
				
				sum(case when(a.DonGia between 100000 and 179999) 
						/* and a.IDtao = a.DonGia Không đồng giá*/
						and b.idchOL <> 0 /*DT Pass*/ 
					and d.dongthoigiantrangthaidon = 1 then (ceil(a.DonGia*(1-1*a.chietkhau/100))*a.SoLuong) else 0 end) as dtpasstu100den180,
				sum(case when(a.DonGia between 100000 and 179999) 
						/* and a.IDtao = a.DonGia Không đồng giá*/
						and b.idchOL <> 0 /*DT Pass*/ 
					and d.dongthoigiantrangthaidon = 1 then a.SoLuong else 0 end) as tongdonpasstu100den180,
				
				/*=========== Doanh Thu SP >= 180K ================*/
				sum(case when(a.DonGia >= 180000) 
						and b.idchOL = 0 
					and d.dongthoigiantrangthaidon = 1 then (ceil(a.DonGia*(1-1*a.chietkhau/100))*a.SoLuong) else 0 end) as dtpmtu180,
				sum(case when(a.DonGia >= 180000) 
						and b.idchOL = 0 
					and d.dongthoigiantrangthaidon = 1 then a.SoLuong else 0 end) as tongsoluongpmtu180,
				
				sum(case when(a.DonGia >= 180000) 
						and b.idchOL <> 0 /*DT Pass*/ 
					and d.dongthoigiantrangthaidon = 1 then (ceil(a.DonGia*(1-1*a.chietkhau/100))*a.SoLuong) else 0 end) as dtpasstu180,
				sum(case when(a.DonGia >= 180000) 
						and b.idchOL <> 0 /*DT Pass*/ 
					and d.dongthoigiantrangthaidon = 1 then a.SoLuong else 0 end) as tongdonpasstu180,
				
				/* =============== Sản Phẩm áp dụng CT KM PM =============*/
	sum(case when e.sotien <> 10 and b.idchOL = 0  then (ceil(a.DonGia*(1-1*a.chietkhau/100))*a.SoLuong) else 0 end) as dtspctkhuyenmai,
	sum(case when e.sotien <> 10 and b.idchOL = 0  then 1 else 0 end) as tongdonspctkhuyenmai,
	
	/* =============== Sản Phẩm áp dụng CT KM PASS DƠN =============*/
	sum(case when e.sotien <> 10 and b.idchOL <> 0  then (ceil(a.DonGia*(1-1*a.chietkhau/100))*a.SoLuong) else 0 end) as dtspctkhuyenmaipass,
	sum(case when e.sotien <> 10 and b.idchOL <> 0  then 1 else 0 end) as tongdonspctkhuyenmaipass,
	
				/* ========= Tổng Số Lượng SP bán ra ==========*/
				sum(case when d.dongthoigiantrangthaidon = 1 then a.SoLuong else 0 end) as tongsoluongsphoanthanh,
				/* ========= Doanh Thu Trong Tháng Hoàn Về ==========*/
				Sum(case when dongthoigiantrangthaidon=8 
					and (MONTH(b.NgayTao) = MONTH(b.NgayTao) and YEAR(b.NgayTao) = YEAR(b.NgayTao)) 
					and b.idchOL = 0
					then (ceil(a.DonGia*(1-1*a.chietkhau/100))*a.SoLuong) else 0 end) as dthoanvetrongthangpm,
				Sum(case when dongthoigiantrangthaidon=8 
					and (MONTH(b.NgayTao) = MONTH(b.NgayTao) and YEAR(b.NgayTao) = YEAR(b.NgayTao))
					and b.idchOL = 0
					then a.SoLuong else 0 end) as dthoanvetrongthangslsppm
				Sum(case when dongthoigiantrangthaidon=8 
					and (MONTH(b.NgayTao) = MONTH(b.NgayTao) and YEAR(b.NgayTao) = YEAR(b.NgayTao)) 
					and b.idchOL <> 0
					then (ceil(a.DonGia*(1-1*a.chietkhau/100))*a.SoLuong) else 0 end) as dthoanvetrongthangpass,
				Sum(case when dongthoigiantrangthaidon=8 
					and (MONTH(b.NgayTao) = MONTH(b.NgayTao) and YEAR(b.NgayTao) = YEAR(b.NgayTao))
					and b.idchOL <> 0
					then a.SoLuong else 0 end) as dthoanvetrongthangslsppass
				from phieunhapxuat b 
				left join xuatbanhang a on a.IDphieu=b.ID 
				left join vanchuyenonline d on b.ID = d.IDbill 
				left join phieukhuyenmai e on b.NguoiGiao= e.maso 
				left join lydonhapxuat f on b.LyDo = f.ID 
				where b.lydo>45 and (dongthoigiantrangthaidon=1 or dongthoigiantrangthaidon=8) 
				and b.idkho = 1105 and f.ma in ('TT1','TT2','TT3','TT7') 
				" . $sql_where . "
			group by b.diachiN /*ID nhân viên*/";

			$query = $data->query($sql);

			$hoahongduoi30 = 1000;
			$hoahongtu30den100 = 2500;
			$hoahongtu100den180 = 4000;
			$hoahongtren180 = 5000;
			$hoahongapdungvc = 2500;

			$tonghoahongduoi30pm = 0;
			$tonghoahongduoi30pass = 0;
			$tonghoahongtu30den100pm = 0;
			$tonghoahongtu30den100pass = 0;
			$tonghoahongtu100den180pm = 0;
			$tonghoahongtu100den180pass = 0;
			$tonghoahongtren180pm = 0;
			$tonghoahongtren180pass = 0;
			$tonghoahongkm = 0;
			$tonghoahongkmpass = 0;
			$i = 1;

			$mangnv = taomang("userac", "ID", "MaNV");
			$mangten = taomang("userac", "ID", "ten");
			while ($rows = $data->fetch_array($query)) {
				$sql = "Select Sum(case when d.dongthoigiantrangthaidon=8 
					and (MONTH(b.NgayTao) = MONTH('" . $rows['NgayTao'] . "')-1 and YEAR(b.NgayTao) = YEAR('" . $rows['NgayTao'] . "')) 
					and b.idchOL = 0
					then (ceil(a.DonGia*(1-1*a.chietkhau/100))*a.SoLuong) else 0 end) as dthoanvethangtruoc,
				Sum(case when d.dongthoigiantrangthaidon=8 
					and (MONTH(b.NgayTao) = MONTH('" . $rows['NgayTao'] . "')-1 and YEAR(b.NgayTao) = YEAR('" . $rows['NgayTao'] . "'))
					and b.idchOL = 0
					then a.SoLuong else 0 end) as dthoanvethangtruocslsp,
				Sum(case when d.dongthoigiantrangthaidon=8 
					and (MONTH(b.NgayTao) = MONTH('" . $rows['NgayTao'] . "')-1 and YEAR(b.NgayTao) = YEAR('" . $rows['NgayTao'] . "')) 
					and b.idchOL <> 0
					then (ceil(a.DonGia*(1-1*a.chietkhau/100))*a.SoLuong) else 0 end) as dthoanvethangtruoc,
				Sum(case when d.dongthoigiantrangthaidon=8 
					and (MONTH(b.NgayTao) = MONTH('" . $rows['NgayTao'] . "')-1 and YEAR(b.NgayTao) = YEAR('" . $rows['NgayTao'] . "'))
					and b.idchOL <> 0
					then a.SoLuong else 0 end) as dthoanvethangtruocslsp
				from phieunhapxuat b 
				left join  xuatbanhang a on a.IDphieu=b.ID 
				left join vanchuyenonline d on b.ID = d.IDbill 
				left join phieukhuyenmai e on b.NguoiGiao= e.maso 
				left join lydonhapxuat f on b.LyDo = f.ID 
				where b.lydo>45 
				and b.idkho = 1105 and f.ma in ('TT1','TT2','TT3','TT7') 
				$caulenh_dthuthangtruoc
				and b.diachiN = '" . $rows["IDNV"] . "'
				group by b.diachiN";
				$res = getdong($sql);

				$hoahongduoi30pm = 0;
				$hoahongduoi30pass = 0;
				$hoahong30den100pm = 0;
				$hoahong30den100pass = 0;
				$hoahong100den180pm = 0;
				$hoahong100den180pass = 0;
				$hoahongtren180pm = 0;
				$hoahongtren180pass = 0;
				$hoahongkm = 0;
				$hoahongkmpass = 0;
				if ($rows['tongsoluongpmduoi30']) {
					$hoahongduoi30pm = $rows['tongsoluongpmduoi30'] * $hoahongduoi30;
				}

				if ($rows['tongdonpassduoi30']) {
					$hoahongduoi30pass = $rows['tongdonpassduoi30'] * $hoahongduoi30;
				}

				if ($rows['tongsoluongpmtu30den100']) {
					$hoahong30den100pm = $rows['tongsoluongpmtu30den100'] * $hoahongtu30den100;
				}
				if ($rows['tongdonpasstu30den100']) {
					$hoahong30den100pass = $rows['tongdonpasstu30den100'] * $hoahongtu30den100;
				}
				if ($rows['tongsoluongpmtu100den180']) {
					$hoahong100den180pm = $rows['tongsoluongpmtu100den180'] * $hoahongtu100den180;
				}
				if ($rows['tongdonpasstu100den180']) {
					$hoahong100den180pass = $rows['tongdonpasstu100den180'] * $hoahongtu100den180;
				}

				if ($rows['tongsoluongpmtu180']) {
					$hoahongtren180pm = $rows['tongsoluongpmtu180'] * $hoahongtren180;
				}

				if ($rows['tongdonpasstu180']) {
					$hoahongtren180pass = $rows['tongdonpasstu180'] * $hoahongtren180;
				}
				if ($rows['tongdonspctkhuyenmai']) {
					$hoahongkm = $rows['tongdonspctkhuyenmai'] * $hoahongapdungvc;
				}

				if ($rows['tongdonspctkhuyenmaipass']) {
					$hoahongkmpass = $rows['tongdonspctkhuyenmaipass'] * $hoahongapdungvc;
				}
				$tonghoahongduoi30pm += $hoahongduoi30pm;
				$tonghoahongduoi30pass += $hoahongduoi30pass;
				$tonghoahongtu30den100pm += $hoahong30den100pm;
				$tonghoahongtu30den100pass += $hoahong30den100pass;
				$tonghoahongtu100den180pm += $hoahong100den180pm;
				$tonghoahongtu100den180pass += $hoahong100den180pass;
				$tonghoahongtren180pm += $hoahongtren180pm;
				$tonghoahongtren180pass += $hoahongtren180pass;
				$tonghoahongkm += $hoahongkm;
				$tonghoahongkmpass += $hoahongkmpass;

				$tonghoahongthucnhan = $hoahongduoi30pm+$hoahongduoi30pass+$hoahong30den100pm+$hoahong30den100pass+$hoahong100den180pm+$hoahong100den180pass+$hoahongtren180pm+$hoahongtren180pass+$hoahongkm+$hoahongkmpass;

				$m = array(
					$i++, $mangten[$rows['IDNV']], $mangnv[$rows['IDNV']],
					number_format($rows['dtpmduoi30']), number_format($rows['tongsoluongpmduoi30']), number_format(ceil($rows['dtpmduoi30']/$rows['tongsoluongpmduoi30'])), number_format($hoahongduoi30), number_format($hoahongduoi30pm),

					number_format($rows['dtpassduoi30']), number_format($rows['tongdonpassduoi30']), number_format(ceil($rows['dtpassduoi30']/$rows['tongdonpassduoi30'])), number_format($hoahongduoi30), number_format($hoahongduoi30pass),

					number_format($rows["dtpmtu30den100"]), number_format($rows["tongsoluongpmtu30den100"]), number_format(ceil($rows["dtpmtu30den100"]/$rows["tongsoluongpmtu30den100"])), number_format($hoahongtu30den100), number_format($hoahong30den100pm),

					number_format($rows["dtpasstu30den100"]), number_format($rows["tongdonpasstu30den100"]), number_format(ceil($rows["dtpasstu30den100"]/$rows["tongdonpasstu30den100"])), number_format($hoahongtu30den100), number_format($hoahong30den100pass),

					number_format($rows["dtpmtu100den180"]), number_format($rows["tongsoluongpmtu100den180"]), number_format(ceil($rows["dtpmtu100den180"]/$rows["tongsoluongpmtu100den180"])), number_format($hoahongtu100den180), number_format($hoahong100den180pm),

					number_format($rows["dtpasstu100den180"]), number_format($rows["tongdonpasstu100den180"]), number_format(ceil($rows["dtpasstu100den180"]/$rows["tongdonpasstu100den180"])), number_format($hoahongtu100den180), number_format($hoahong100den180pass),

					number_format($rows["dtpmtu180"]), number_format($rows["tongsoluongpmtu180"]), number_format(ceil($rows["dtpmtu180"]/$rows["tongsoluongpmtu180"])), number_format($hoahongtren180), number_format($hoahongtren180pm),

					number_format($rows["dtpasstu180"]), number_format($rows["tongdonpasstu180"]), number_format(ceil($rows["dtpasstu180"]/$rows["tongdonpasstu180"])), number_format($hoahongtren180), number_format($hoahongtren180pass),

					number_format($rows["dtspctkhuyenmai"]), number_format($rows["tongdonspctkhuyenmai"]), number_format(ceil($rows["dtspctkhuyenmai"]/$rows["tongdonspctkhuyenmai"])), number_format($hoahongapdungvc), number_format($hoahongkm),

					number_format($rows["dtspctkhuyenmaipass"]), number_format($rows["tongdonspctkhuyenmaipass"]), number_format(ceil($rows["dtspctkhuyenmaipass"]/$rows["tongdonspctkhuyenmaipass"])), number_format($hoahongapdungvc), number_format($hoahongkmpass),

					number_format($tonghoahongthucnhan),
					number_format($rows['tongsoluongsphoanthanh']), 

					number_format($rows['dthoanvetrongthangpm']), number_format($rows['soluongsphoanvetrongthangpm']),
					number_format($rows['dthoanvetrongthangpass']), number_format($rows['soluongsphoanvetrongthangpass']), 
					number_format($res['dthoanvethangtruocpm']), number_format($res['dthoanvethangtruocslsppm']),
					number_format($res['dthoanvethangtruocpass']), number_format($res['dthoanvethangtruocslsppass'])
				);


				$writer->writeSheetRow('Sheet1', $m);
			}
			$writer->writeSheetRow('Sheet1', array("", "", "", "", "", "", number_format($tonghoahongduoi30pm), "", "", "", number_format($tonghoahongduoi30pass), "", "", "", number_format($tonghoahongtu30den100pm), "", "", "", number_format($tonghoahongtu30den100pass), "", "", "", number_format($tonghoahongtu100den180pm), "", "", "", number_format($tonghoahongtu100den180pass), "", "", "", number_format($tonghoahongtren180pm), "", "", "", number_format($tonghoahongtren180pass), "", "", "", number_format($tonghoahongkm), "", "", "", number_format($tonghoahongkmpass), "", "", "", ""));
		} else if ($_POST["tonghop"] == 16) {
			$sql_where = "";
			if ($manv != "") {
				$sql_where .= " and a.manv = '$manv'";
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
				$sql_where  .= " and b.NgayTao>= '$ngay[2]-$ngay[1]-$ngay[0]'";
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
				$sql_where  .= " and b.NgayTao <= '$ngay[2]-$ngay[1]-$ngay[0] 23:59'";
			}

			include_once("includes/xlsxwriter.class.php");

			$filename = "Báo_Cáo_Lương_Online_Phần-Mềm.xlsx";
			$writer = new XLSXWriter();

			$styles1 = array('font-style' => 'bold', 'fill' => '#f1ce25', 'halign' => 'center', 'border' => 'left,right,top,bottom', "border-style" => "thin");
			$styleborder = array('border' => 'left,right,top,bottom', "border-style" => "thin", 'halign' => 'center', 'fill' => '#e07b22', 'font-style' => 'bold');
			$stylefooter = array("font-style" => "bold", "halign" => "center", 'border' => 'left,right,top,bottom', "border-style" => "thin");
			$sheet_name = 'Sheet1';

			$writer->writeSheetHeader(
				'Sheet1',
				array(
					"STT" => "integer", "Tên NV" => "string", "Mã NV" => "string",
					"SP < 30K không áp dụng đồng giá SP (DT PM)" => "string", "string", "string", "string", "string",
					"SP < 30K không áp dụng đồng giá SP (DT PASS)" => "string", "string", "string", "string", "string",
					"SP >= 30K ĐẾN < 100K (DT PM)" => "string", "string", "string", "string", "string",
					"SP >= 30K ĐẾN < 100K (DT PASS)" => "string", "string", "string", "string", "string",
					"SP >= 100K ĐẾN < 180K (DT PM)" => "string", "string", "string", "string", "string",
					"SP >= 100K ĐẾN < 180K (DT PASS)" => "string", "string", "string", "string", "string",
					"SP >= 180K (DT PM)" => "string", "string", "string", "string", "string",
					"SP >= 180K (DT PASS)" => "string", "string", "string", "string", "string",
					"SẢN PHẨM ÁP DỤNG CT SALE ( trừ CT áp dụng voucher 10%) PM" => "string", "string", "string", "string", "string",
					"SẢN PHẨM ÁP DỤNG CT SALE ( trừ CT áp dụng voucher 10%) PASS ĐƠN" => "string", "string", "string", "string", "string",
					"TỔNG HOA HỒNG THỰC NHẬN" => "string",
					"TỔNG SỐ LƯỢNG SẢN PHẨM ĐƠN ĐI THÀNH CÔNG" => "string",
					"DOANH THU TRONG THÁNG HOÀN VỀ PM" => "string", "string",
					"DOANH THU TRONG THÁNG HOÀN VỀ Pass Đơn" => "string", "string",
					"DOANH THU  HOÀN VỀ THÁNG TRƯỚC PM" => "string", "string",
					"DOANH THU  HOÀN VỀ THÁNG TRƯỚC Pass Đơn" => "string", "string",
				),
				$styles1
			);

			// $writer->writeSheetRow('Sheet1', $m );// Header
			$m = array(
				"", "", "",
				"DOANH THU", "SỐ LƯỢNG SP", "DOANH THU TRUNG BÌNH", "HOA HỒNG", "HOA HỒNG NHẬN",
				"DOANH THU", "SỐ LƯỢNG ĐƠN HÀNG", "DOANH THU TRUNG BÌNH", "HOA HỒNG", "HOA HỒNG NHẬN",
				"DOANH THU", "SỐ LƯỢNG ĐƠN HÀNG", "DOANH THU TRUNG BÌNH", "HOA HỒNG", "HOA HỒNG NHẬN",
				"DOANH THU", "SỐ LƯỢNG ĐƠN HÀNG", "DOANH THU TRUNG BÌNH", "HOA HỒNG", "HOA HỒNG NHẬN",
				"DOANH THU", "SỐ LƯỢNG SP", "DOANH THU TRUNG BÌNH", "HOA HỒNG", "HOA HỒNG NHẬN",
				"DOANH THU", "SỐ LƯỢNG ĐƠN HÀNG", "DOANH THU TRUNG BÌNH", "HOA HỒNG", "HOA HỒNG NHẬN",
				"DOANH THU", "SỐ LƯỢNG SP", "DOANH THU TRUNG BÌNH", "HOA HỒNG", "HOA HỒNG NHẬN",
				"DOANH THU", "SỐ LƯỢNG ĐƠN HÀNG", "DOANH THU TRUNG BÌNH", "HOA HỒNG", "HOA HỒNG NHẬN",
				"DOANH THU", "SỐ LƯỢNG ĐƠN HÀNG", "DOANH THU TRUNG BÌNH", "HOA HỒNG", "HOA HỒNG NHẬN",
				"DOANH THU", "SỐ LƯỢNG ĐƠN HÀNG", "DOANH THU TRUNG BÌNH", "HOA HỒNG", "HOA HỒNG NHẬN",
				"",
				"",
				"DOANH THU", "SỐ LƯỢNG SP",
				"DOANH THU", "SỐ LƯỢNG SP",
				"DOANH THU", "SỐ LƯỢNG SP",
				"DOANH THU", "SỐ LƯỢNG SP"
			);
			$writer->writeSheetRow('Sheet1', $m, $styleborder);

			$writer->markMergedCell($sheet_name, $start_row = 0, $start_col = 0, $end_row = 1, $end_col = 0);
			$writer->markMergedCell($sheet_name, $start_row = 0, $start_col = 1, $end_row = 1, $end_col = 1);
			$writer->markMergedCell($sheet_name, $start_row = 0, $start_col = 2, $end_row = 1, $end_col = 2);

			$writer->markMergedCell($sheet_name, $start_row = 0, $start_col = 3, $end_row = 0, $end_col = 7);
			$writer->markMergedCell($sheet_name, $start_row = 0, $start_col = 8, $end_row = 0, $end_col = 12);
			$writer->markMergedCell($sheet_name, $start_row = 0, $start_col = 13, $end_row = 0, $end_col = 17);
			$writer->markMergedCell($sheet_name, $start_row = 0, $start_col = 18, $end_row = 0, $end_col = 22);
			$writer->markMergedCell($sheet_name, $start_row = 0, $start_col = 23, $end_row = 0, $end_col = 27);
			$writer->markMergedCell($sheet_name, $start_row = 0, $start_col = 28, $end_row = 0, $end_col = 32);
			$writer->markMergedCell($sheet_name, $start_row = 0, $start_col = 33, $end_row = 0, $end_col = 37);
			$writer->markMergedCell($sheet_name, $start_row = 0, $start_col = 38, $end_row = 0, $end_col = 42);
			$writer->markMergedCell($sheet_name, $start_row = 0, $start_col = 43, $end_row = 0, $end_col = 47);
			$writer->markMergedCell($sheet_name, $start_row = 0, $start_col = 48, $end_row = 0, $end_col = 52);

			$writer->markMergedCell($sheet_name, $start_row = 0, $start_col = 53, $end_row = 1, $end_col = 53);
			$writer->markMergedCell($sheet_name, $start_row = 0, $start_col = 54, $end_row = 1, $end_col = 54);

			$writer->markMergedCell($sheet_name, $start_row = 0, $start_col = 55, $end_row = 0, $end_col = 56);
			$writer->markMergedCell($sheet_name, $start_row = 0, $start_col = 57, $end_row = 0, $end_col = 58);

			$sql = "select b.diachiN as IDNV,b.NgayTao, 
			/*========== Doanh Thu SP < 30K và không đồng giá ==========*/
			sum(case when(a.DonGia between 1 and 29999) 
					 and a.IDtao = a.DonGia /*Không đồng giá*/
					 and b.idchOL = 0
				 and d.dongthoigiantrangthaidon = 1 then (ceil(a.DonGia*(1-1*a.chietkhau/100))*a.SoLuong) else 0 end) as dtpmduoi30,
			sum(case when(a.DonGia between 1 and 29999) 
					 and a.IDtao = a.DonGia /*Không đồng giá*/
					 and b.idchOL = 0 
				 and d.dongthoigiantrangthaidon = 1 then a.SoLuong else 0 end) as tongsoluongpmduoi30,
			
			sum(case when(a.DonGia between 1 and 29999) 
					 and a.IDtao = a.DonGia /*Không đồng giá*/
					 and b.idchOL <> 0 /*DT Pass*/ 
				 and d.dongthoigiantrangthaidon = 1 then (ceil(a.DonGia*(1-1*a.chietkhau/100))*a.SoLuong) else 0 end) as dtpassduoi30,
			sum(case when(a.DonGia between 1 and 29999) 
					 and a.IDtao = a.DonGia /*Không đồng giá*/
					 and b.idchOL <> 0 /*DT Pass*/
				 and d.dongthoigiantrangthaidon = 1 then a.SoLuong else 0 end) as tongdonpassduoi30,
			
			/*================ Doanh Thu SP >= 30K và < 100K ==================*/
			sum(case when(a.DonGia between 30000 and 99999) 
					/* and a.IDtao = a.DonGia Không đồng giá*/
					 and b.idchOL = 0
				 and d.dongthoigiantrangthaidon = 1 then (ceil(a.DonGia*(1-1*a.chietkhau/100))*a.SoLuong) else 0 end) as dtpmtu30den100,
			sum(case when(a.DonGia between 30000 and 99999) 
					 /* and a.IDtao = a.DonGia Không đồng giá*/
					 and b.idchOL = 0
				 and d.dongthoigiantrangthaidon = 1 then a.SoLuong else 0 end) as tongsoluongpmtu30den100,
			
			sum(case when(a.DonGia between 30000 and 99999) 
					 /* and a.IDtao = a.DonGia Không đồng giá*/
					 and b.idchOL <> 0 /*DT Pass*/ 
				 and d.dongthoigiantrangthaidon = 1 then (ceil(a.DonGia*(1-1*a.chietkhau/100))*a.SoLuong) else 0 end) as dtpasstu30den100,
			sum(case when(a.DonGia between 30000 and 99999) 
					 /* and a.IDtao = a.DonGia Không đồng giá*/
					 and b.idchOL <> 0 /*DT Pass*/
				 and d.dongthoigiantrangthaidon = 1 then a.SoLuong else 0 end) as tongdonpasstu30den100,
			             
			/*=========== Doanh Thu SP >= 100K và < 180K ================*/
			sum(case when(a.DonGia between 100000 and 179999) 
					/* and a.IDtao = a.DonGia Không đồng giá*/
					 and b.idchOL = 0 
				 and d.dongthoigiantrangthaidon = 1 then (ceil(a.DonGia*(1-1*a.chietkhau/100))*a.SoLuong) else 0 end) as dtpmtu100den180,
			sum(case when(a.DonGia between 100000 and 179999) 
					 /* and a.IDtao = a.DonGia Không đồng giá*/
					 and b.idchOL = 0 
				 and d.dongthoigiantrangthaidon = 1 then a.SoLuong else 0 end) as tongsoluongpmtu100den180,
			
			sum(case when(a.DonGia between 100000 and 179999) 
					 /* and a.IDtao = a.DonGia Không đồng giá*/
					 and b.idchOL <> 0 /*DT Pass*/ 
				 and d.dongthoigiantrangthaidon = 1 then (ceil(a.DonGia*(1-1*a.chietkhau/100))*a.SoLuong) else 0 end) as dtpasstu100den180,
			sum(case when(a.DonGia between 100000 and 179999) 
					 /* and a.IDtao = a.DonGia Không đồng giá*/
					 and b.idchOL <> 0 /*DT Pass*/ 
				 and d.dongthoigiantrangthaidon = 1 then a.SoLuong else 0 end) as tongdonpasstu100den180,
			
			/*=========== Doanh Thu SP >= 180K ================*/
			sum(case when(a.DonGia >= 180000) 
					 and b.idchOL = 0 
				 and d.dongthoigiantrangthaidon = 1 then (ceil(a.DonGia*(1-1*a.chietkhau/100))*a.SoLuong) else 0 end) as dtpmtu180,
			sum(case when(a.DonGia >= 180000) 
					 and b.idchOL = 0 
				 and d.dongthoigiantrangthaidon = 1 then a.SoLuong else 0 end) as tongsoluongpmtu180,
			
			sum(case when(a.DonGia >= 180000) 
					 and b.idchOL <> 0 /*DT Pass*/ 
				 and d.dongthoigiantrangthaidon = 1 then (ceil(a.DonGia*(1-1*a.chietkhau/100))*a.SoLuong) else 0 end) as dtpasstu180,
			sum(case when(a.DonGia >= 180000) 
					 and b.idchOL <> 0 /*DT Pass*/ 
				 and d.dongthoigiantrangthaidon = 1 then a.SoLuong else 0 end) as tongdonpasstu180,
			
		/* =============== Sản Phẩm áp dụng CT KM PM =============*/
	sum(case when e.sotien <> 10 and b.idchOL = 0  then (ceil(a.DonGia*(1-1*a.chietkhau/100))*a.SoLuong) else 0 end) as dtspctkhuyenmai,
	sum(case when e.sotien <> 10 and b.idchOL = 0  then 1 else 0 end) as tongdonspctkhuyenmai,
	
	/* =============== Sản Phẩm áp dụng CT KM PASS DƠN =============*/
	sum(case when e.sotien <> 10 and b.idchOL <> 0  then (ceil(a.DonGia*(1-1*a.chietkhau/100))*a.SoLuong) else 0 end) as dtspctkhuyenmaipass,
	sum(case when e.sotien <> 10 and b.idchOL <> 0  then 1 else 0 end) as tongdonspctkhuyenmaipass,
	
			/* ========= Tổng Số Lượng SP bán ra ==========*/
			sum(case when d.dongthoigiantrangthaidon = 1 then a.SoLuong else 0 end) as tongsoluongsphoanthanh,
			/* ========= Doanh Thu Trong Tháng Hoàn Về ==========*/
			Sum(case when dongthoigiantrangthaidon=8 
				and (MONTH(b.NgayTao) = MONTH(b.NgayTao) and YEAR(b.NgayTao) = YEAR(b.NgayTao)) 
				and b.idchOL = 0
				then (ceil(a.DonGia*(1-1*a.chietkhau/100))*a.SoLuong) else 0 end) as dthoanvetrongthangpm,
			Sum(case when dongthoigiantrangthaidon=8 
				and (MONTH(b.NgayTao) = MONTH(b.NgayTao) and YEAR(b.NgayTao) = YEAR(b.NgayTao))
				and b.idchOL = 0
				then a.SoLuong else 0 end) as dthoanvetrongthangslsppm,
			Sum(case when dongthoigiantrangthaidon=8 
				and (MONTH(b.NgayTao) = MONTH(b.NgayTao) and YEAR(b.NgayTao) = YEAR(b.NgayTao)) 
				and b.idchOL <> 0
				then (ceil(a.DonGia*(1-1*a.chietkhau/100))*a.SoLuong) else 0 end) as dthoanvetrongthangpass,
			Sum(case when dongthoigiantrangthaidon=8 
				and (MONTH(b.NgayTao) = MONTH(b.NgayTao) and YEAR(b.NgayTao) = YEAR(b.NgayTao))
				and b.idchOL <> 0
				then a.SoLuong else 0 end) as dthoanvetrongthangslsppass
			from phieunhapxuat b 
			left join xuatbanhang a on a.IDphieu=b.ID 
			left join vanchuyenonline d on b.ID = d.IDbill 
			left join phieukhuyenmai e on b.NguoiGiao= e.maso 
			left join lydonhapxuat f on b.LyDo = f.ID
			where b.lydo>45 and (dongthoigiantrangthaidon=1 or dongthoigiantrangthaidon=8) 
			and b.idkho = 1105 and f.ma not in ('TT1','TT2','TT3','TT7') 
			" . $sql_where . "
			group by b.diachiN /*ID nhân viên*/";

			$hoahongduoi30 = 1000;
			$hoahongtu30den100 = 2500;
			$hoahongtu100den180 = 4000;
			$hoahongtren180 = 5000;
			$hoahongapdungvc = 2500;

			$tonghoahongduoi30pm = 0;
			$tonghoahongduoi30pass = 0;
			$tonghoahongtu30den100pm = 0;
			$tonghoahongtu30den100pass = 0;
			$tonghoahongtu100den180pm = 0;
			$tonghoahongtu100den180pass = 0;
			$tonghoahongtren180pm = 0;
			$tonghoahongtren180pass = 0;
			$tonghoahongkm = 0;
			$tonghoahongkmpass = 0;
			$query = $data->query($sql);
			$i = 1;

			$mangnv = taomang("userac", "ID", "MaNV");
			$mangten = taomang("userac", "ID", "ten");
			while ($rows = $data->fetch_array($query)) {
				$sql = "Select Sum(case when d.dongthoigiantrangthaidon=8 
					and (MONTH(b.NgayTao) = MONTH('" . $rows['NgayTao'] . "')-1 and YEAR(b.NgayTao) = YEAR('" . $rows['NgayTao'] . "')) 
					and b.idchOL = 0
					then (ceil(a.DonGia*(1-1*a.chietkhau/100))*a.SoLuong) else 0 end) as dthoanvethangtruocpm,
				Sum(case when d.dongthoigiantrangthaidon=8 
					and (MONTH(b.NgayTao) = MONTH('" . $rows['NgayTao'] . "')-1 and YEAR(b.NgayTao) = YEAR('" . $rows['NgayTao'] . "'))
					and b.idchOL = 0
					then a.SoLuong else 0 end) as dthoanvethangtruocslsppm,
				Sum(case when d.dongthoigiantrangthaidon=8 
					and (MONTH(b.NgayTao) = MONTH('" . $rows['NgayTao'] . "')-1 and YEAR(b.NgayTao) = YEAR('" . $rows['NgayTao'] . "')) 
					and b.idchOL <> 0
					then (ceil(a.DonGia*(1-1*a.chietkhau/100))*a.SoLuong) else 0 end) as dthoanvethangtruocpass,
				Sum(case when d.dongthoigiantrangthaidon=8 
					and (MONTH(b.NgayTao) = MONTH('" . $rows['NgayTao'] . "')-1 and YEAR(b.NgayTao) = YEAR('" . $rows['NgayTao'] . "'))
					and b.idchOL <> 0
					then a.SoLuong else 0 end) as dthoanvethangtruocslsppass
				from phieunhapxuat b 
				left join  xuatbanhang a on a.IDphieu=b.ID 
				left join vanchuyenonline d on b.ID = d.IDbill 
				left join phieukhuyenmai e on b.NguoiGiao= e.maso 
				left join lydonhapxuat f on b.LyDo = f.ID 
				where b.lydo>45 
				and b.idkho = 1105 and f.ma not in ('TT1','TT2','TT3','TT7') 
				and b.diachiN = '" . $rows["IDNV"] . "'
				group by b.diachiN";
				$res = getdong($sql);

				$hoahongduoi30pm = 0;
				$hoahongduoi30pass = 0;
				$hoahong30den100pm = 0;
				$hoahong30den100pass = 0;
				$hoahong100den180pm = 0;
				$hoahong100den180pass = 0;
				$hoahongtren180pm = 0;
				$hoahongtren180pass = 0;
				$hoahongkm = 0;
				$hoahongkmpass = 0;
				if ($rows['tongsoluongpmduoi30']) {
					$hoahongduoi30pm = $rows['tongsoluongpmduoi30'] * $hoahongduoi30;
				}

				if ($rows['tongdonpassduoi30']) {
					$hoahongduoi30pass = $rows['tongdonpassduoi30'] * $hoahongduoi30;
				}

				if ($rows['tongsoluongpmtu30den100']) {
					$hoahong30den100pm = $rows['tongsoluongpmtu30den100'] * $hoahongtu30den100;
				}
				if ($rows['tongdonpasstu30den100']) {
					$hoahong30den100pass = $rows['tongdonpasstu30den100'] * $hoahongtu30den100;
				}
				if ($rows['tongsoluongpmtu100den180']) {
					$hoahong100den180pm = $rows['tongsoluongpmtu100den180'] * $hoahongtu100den180;
				}
				if ($rows['tongdonpasstu100den180']) {
					$hoahong100den180pass = $rows['tongdonpasstu100den180'] * $hoahongtu100den180;
				}

				if ($rows['tongsoluongpmtu180']) {
					$hoahongtren180pm = $rows['tongsoluongpmtu180'] * $hoahongtren180;
				}

				if ($rows['tongdonpasstu180']) {
					$hoahongtren180pass = $rows['tongdonpasstu180'] * $hoahongtren180;
				}
				if ($rows['tongdonspctkhuyenmai']) {
					$hoahongkm = $rows['tongdonspctkhuyenmai'] * $hoahongapdungvc;
				}

				if ($rows['tongdonspctkhuyenmaipass']) {
					$hoahongkmpass = $rows['tongdonspctkhuyenmaipass'] * $hoahongapdungvc;
				}
				$tonghoahongduoi30pm += $hoahongduoi30pm;
				$tonghoahongduoi30pass += $hoahongduoi30pass;
				$tonghoahongtu30den100pm += $hoahong30den100pm;
				$tonghoahongtu30den100pass += $hoahong30den100pass;
				$tonghoahongtu100den180pm += $hoahong100den180pm;
				$tonghoahongtu100den180pass += $hoahong100den180pass;
				$tonghoahongtren180pm += $hoahongtren180pm;
				$tonghoahongtren180pass += $hoahongtren180pass;
				$tonghoahongkm += $hoahongkm;
				$tonghoahongkmpass += $hoahongkmpass;

				$tonghoahongthucnhan = $hoahongduoi30pm+$hoahongduoi30pass+$hoahong30den100pm+$hoahong30den100pass+$hoahong100den180pm+$hoahong100den180pass+$hoahongtren180pm+$hoahongtren180pass+$hoahongkm+$hoahongkmpass;

				$m = array(
					$i++, $mangten[$rows['IDNV']], $mangnv[$rows['IDNV']],
					number_format($rows['dtpmduoi30']), number_format($rows['tongsoluongpmduoi30']), number_format(ceil($rows['dtpmduoi30']/$rows['tongsoluongpmduoi30'])), number_format($hoahongduoi30), number_format($hoahongduoi30pm),

					number_format($rows['dtpassduoi30']), number_format($rows['tongdonpassduoi30']), number_format(ceil($rows['dtpassduoi30']/$rows['tongdonpassduoi30'])), number_format($hoahongduoi30), number_format($hoahongduoi30pass),

					number_format($rows["dtpmtu30den100"]), number_format($rows["tongsoluongpmtu30den100"]), number_format(ceil($rows["dtpmtu30den100"]/$rows["tongsoluongpmtu30den100"])), number_format($hoahongtu30den100), number_format($hoahong30den100pm),

					number_format($rows["dtpasstu30den100"]), number_format($rows["tongdonpasstu30den100"]), number_format(ceil($rows["dtpasstu30den100"]/$rows["tongdonpasstu30den100"])), number_format($hoahongtu30den100), number_format($hoahong30den100pass),

					number_format($rows["dtpmtu100den180"]), number_format($rows["tongsoluongpmtu100den180"]), number_format(ceil($rows["dtpmtu100den180"]/$rows["tongsoluongpmtu100den180"])), number_format($hoahongtu100den180), number_format($hoahong100den180pm),

					number_format($rows["dtpasstu100den180"]), number_format($rows["tongdonpasstu100den180"]), number_format(ceil($rows["dtpasstu100den180"]/$rows["tongdonpasstu100den180"])), number_format($hoahongtu100den180), number_format($hoahong100den180pass),

					number_format($rows["dtpmtu180"]), number_format($rows["tongsoluongpmtu180"]), number_format(ceil($rows["dtpmtu180"]/$rows["tongsoluongpmtu180"])), number_format($hoahongtren180), number_format($hoahongtren180pm),

					number_format($rows["dtpasstu180"]), number_format($rows["tongdonpasstu180"]), number_format(ceil($rows["dtpasstu180"]/$rows["tongdonpasstu180"])), number_format($hoahongtren180), number_format($hoahongtren180pass),

					number_format($rows["dtspctkhuyenmai"]), number_format($rows["tongdonspctkhuyenmai"]), number_format(ceil($rows["dtspctkhuyenmai"]/$rows["tongdonspctkhuyenmai"])), number_format($hoahongapdungvc), number_format($hoahongkm),

					number_format($rows["dtspctkhuyenmaipass"]), number_format($rows["tongdonspctkhuyenmaipass"]), number_format(ceil($rows["dtspctkhuyenmaipass"])/$rows["tongdonspctkhuyenmaipass"]), number_format($hoahongapdungvc), number_format($hoahongkmpass),

					number_format($tonghoahongthucnhan),
					number_format($rows['tongsoluongsphoanthanh']),
					 
					number_format($rows['dthoanvetrongthangpm']), number_format($rows['soluongsphoanvetrongthangpm']), 
					number_format($rows['dthoanvetrongthangpass']), number_format($rows['soluongsphoanvetrongthangpass']), 
					number_format($res['dthoanvethangtruocpm']), number_format($res['dthoanvethangtruocslsppm']),number_format($res['dthoanvethangtruocpass']), number_format($res['dthoanvethangtruocslsppass'])
				);

				$writer->writeSheetRow('Sheet1', $m);
			}
			$writer->writeSheetRow('Sheet1', array("", "", "", "", "", "", number_format($tonghoahongduoi30pm), "", "", "", number_format($tonghoahongduoi30pass), "", "", "", number_format($tonghoahongtu30den100pm), "", "", "", number_format($tonghoahongtu30den100pass), "", "", "", number_format($tonghoahongtu100den180pm), "", "", "", number_format($tonghoahongtu100den180pass), "", "", "", number_format($tonghoahongtren180pm), "", "", "", number_format($tonghoahongtren180pass), "", "", "", number_format($tonghoahongkm), "", "", "", number_format($tonghoahongkmpass), "", "", "", ""));
		} else if ($_POST["tonghop"] == 17) {
			$sql_where = "where a.dongthoigiantrangthaidon<>1 and a.dongthoigiantrangthaidon<>8";
			if ($manv != "") {
				$sql_where .= " and c.MaNV = '$manv'";
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
				$sql_where  .= " and b.NgayTao>= '$ngay[2]-$ngay[1]-$ngay[0]'";
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
				$sql_where  .= " and b.NgayTao <= '$ngay[2]-$ngay[1]-$ngay[0] 23:59'";
			}
			include_once("includes/xlsxwriter.class.php");

			$filename = "thuchiktLuongONLKothanhcong.xlsx";
			$writer = new XLSXWriter();
			$writer->setAuthor('datdoan');
			$writer->writeSheetHeader('Sheet1',	array("Ngày nhập" => "string", "Tên NV" => "string", "Mã NV" => "string", "Số bill" => "string", "Mã VD" => "string", "trạng thái đơn hàng" => "string", "tổng tiền" => "string", "Mã SP" => "string", "Đơn giá" => "string", "Số lượng" => "string"));
			$sql = "select a.*,sum(ceil(x.DonGia*(1-1*x.chietkhau/100))*x.SoLuong) as thanhtien,x.mahang,x.DonGia,x.soluong,c.Ten as tennv,c.MaNV as manv,DATE_FORMAT(b.ngaynhap,'%d/%m/%Y %h:%i:%s') as nn from vanchuyenonline a left join phieunhapxuat b on a.IDbill=b.ID left join xuatbanhang x on x.IDphieu=b.ID  left join userac c on b.diachiN=c.ID $sql_where ";

			$query = $data->query($sql);
			$tamsobill = '';
			while ($r = $data->fetch_array($query)) {
				$tamarr = array($r["nn"], $r["tennv"], $r["manv"], $r["sobill"], $r["mavd"], $r["dongthoigiantrangthaidon"], $r["tongtien"], $r["mahang"], $r["DonGia"], $r["soluong"], $r["thanhtien"]);
				$writer->writeSheetRow('Sheet1', $tamarr);
			}
		} else if ($_POST["tonghop"] == 18) {
			include_once("includes/xlsxwriter.class.php");

			$filename = "thuchiktLDTH.xlsx";
			$writer = new XLSXWriter();
			$writer->setAuthor('datdoan');
			$writer->writeSheetHeader('Sheet1',	array("Sô TT" => "string", "Ngày bán" => "string", "Nhân viên bán" => "string", "Thu ngân" => "string", "Số Hóa đơn" => "string", "Thông tin KH" => "string", "Số điện thoại" => "string", "Mã SP" => "string", "Đơn giá" => "string", "Số lượng" => "string", "Chiếc khấu" => "string", "Thành tiền" => "string", "Đơn vị VC" => "string", "Mã vận đơn" => "string", "Đơn nội thành" => "string", "Địa chỉ của hàng" => "string", "Lý do trả hàng" => "string"));
			$sql = "SELECT g.SoCT as sohd,DATE_FORMAT(g.ngaynhap,'%d/%m/%y %h:%i:%s') as ngayhdbh,g.IDTao as thungan, g.diachiN,b.Name as tencuahang,b.address as diachicuahang,a.donvivc as dvvc,a.mavandon as mavd,k.Name tenkh,k.tel as sdtkh,l.Name as lydotra,i.*,v.phitravc,v.phithukh,v.chuyenkhoan 
FROM thuchikt a left join phieunhapxuat g on a.hdbh=g.SoCT  left join lydotra l on g.tenkho=l.ID left join vanchuyenonline v on v.IDbill=g.ID  left join xuatbanhang i on g.ID=i.IDPhieu left join cuahang b on a.loaitk=b.id  left join userac c on a.IDtao = c.ID 
  left join dinhkhoanthuchi d on d.ID = a.IDcha left join nhacungcap e on a.NCC=e.ID left join phieuxuat  f on a.phieuxuat=f.ID  left join customer k on k.ID=g.IDNhaCC    
	" . $sql_where . " and (a.loaitk=1105 or a.loaitk=1137 ) and g.SoCT is not null  and g.loai=3 ORDER BY g.ID desc";
			$result = $data->query($sql);
			$r = 0;
			$manguser = taomang("userac", "ID", "MaNV");
			while ($re = $data->fetch_array($result)) {
				$r++;

				$tamarr = array($r, $re["ngayhdbh"], $manguser[$re["diachiN"]], $manguser[$re["thungan"]], $re["sohd"], $re["tenkh"], $re["sdtkh"], $re["mahang"], number_format($re["DonGia"]), $re["SoLuong"], $re["chietkhau"], number_format($re["SoLuong"] * ($re["DonGia"] * (1 - 1 * $re["chietkhau"] / 100))), $re["dvvc"], $re["mavd"], $re["mavd"], $re["diachicuahang"], $re["lydotra"]);
				$writer->writeSheetRow('Sheet1', $tamarr);
			}
		}

		ob_end_clean();
		header('Content-disposition: attachment; filename="' . XLSXWriter::sanitize_filename($filename) . '"');
		header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
		header('Content-Transfer-Encoding: binary');
		header('Cache-Control: must-revalidate');
		header('Pragma: public');
		$writer->writeToStdOut();
		return;
	}

	// thu chi kt bao bao duyet

	$mangtk = taomang("dinhkhoan", "ID", "madinhkhoan");
	// $mangcuahang= taomang("cuahang","ID","macuahang",'') ;

	$sql = "SELECT a.ID as idthuchikt,a.luachon as loaithuchi,a.donvivc,a.sochungtu,DATE_FORMAT(a.ngaytao,'%d/%m/%Y') as ngaytao,DATE_FORMAT(a.ngaythuchi,'%d/%m/%Y %H:%i') as ngaythuchikt,DATE_FORMAT(a.ngayduyet,'%d/%m/%Y %H:%i') as ngayduyetthuchi,a.phithukh,a.psco as psco,a.psno as psno,a.donvi,a.soluong,a.dongia ,a.hdbh,a.sotknh,a.tentknh,a.NCC,a.manv,a.phieuxuat,a.sophieupm,a.chungtu,a.mavandon,a.tinhtrang,a.lydoN,d.xacnhan as nguoixn,b.macuahang as tencuahang,d.ma as madkhoan,d.ten as khoanmuctc,a.tkno,a.tkco,a.note as diengiai  FROM thuchikt a left join cuahang b on a.loaitk=b.id  left join userac c on a.IDtao = c.ID  left join dinhkhoanthuchi d on d.ID = a.IDcha  " . $sql_where . " order by  a.ngaythuchi desc ";

	if ($_SESSION['admintuan']) echo $sql;
	//echo $sql;
	//return;
	$result = $data->query($sql);


	include_once("includes/xlsxwriter.class.php");

	$filename = "thuchikt.xlsx";
	$writer = new XLSXWriter();
	$writer->setAuthor('datdoan');
	if ($ql[5]) {

		$writer->writeSheetHeader('Sheet1', array("Ngày thu chi" => "string", "Ngày tải file" => "string", "Số chứng từ" => "string", "Cửa hàng" => "string", "Khoản mục thu/chi" => "string", "Diễn giải" => "string", "PS Nợ" => "string", "ĐVT" => "string", "Số lượng" => "string", "Đơn giá" => "string", "TK nợ" => "string", "TK có" => "string", "PS có" => "string", "HĐBH" => "string", "STK NH" => "string", "Tên TK NH" => "string", "ĐV vận chuyển" => "string", "Mã vận đơn" => "string", "Mã vận đơn hệ thống" => "string", "NCC" => "string", "Họ và tên NV" => "string", "Mã NV" => "string", "Phiếu xuất" => "string", "Phí thu KH" => "string", "Phí thu KH HT" => "string", "Tình Trạng" => "string", "lý do" => "string", "Thủ Quỹ XN" => "string", "Kế Toán Online XN" => "string", "Kế Toán Của Hàng XN" => "string"));
	} else {
		$writer->writeSheetHeader('Sheet1', array("Ngày thu chi" => "string", "Ngày tải file" => "string", "Số chứng từ" => "string", "Cửa hàng" => "string", "Khoản mục thu/chi" => "string", "Diễn giải" => "string", "PS Nợ" => "string", "ĐVT" => "string", "Số lượng" => "string", "Đơn giá" => "string", "PS có" => "string", "HĐBH" => "string", "STK NH" => "string", "Tên TK NH" => "string", "ĐV vận chuyển" => "string", "Mã vận đơn" => "string", "Mã vận đơn hệ thống" => "string", "NCC" => "string", "Họ và tên NV" => "string", "Mã NV" => "string", "Phiếu xuất" => "string", "Phí thu KH" => "string", "Phí thu KH HT" => "string", "Tình Trạng" => "string", "lý do" => "string", "Thủ Quỹ XN" => "string", "Kế Toán Online XN" => "string", "Kế Toán Của Hàng XN" => "string"));
	}


	//	$mangch = taomang ("cuahang","ID","macuahang");
	$result = $data->query($sql);
	$tong = 0;
	$tongsl = 0;
	$r = 0;
	$ngaytao = gmdate('Y-n-d H:i:s', time() + 7 * 3600);

	$cuahangtruong = 1;
	$giamsat = 2;
	$ketoan = 3;  // 4 là 12   5 là 13   6  là 23  7 là 123 
	//$mangchucvu =taomang("kh_chucvu","ID","Name"," where 1  ") ;
	$tongtien = 0;
	$chuoihtml = '';
	$ngaynhap = gmdate('Y-n-d', time() + 7 * 3600);
	$mangtangca = array();
	while ($re = $data->fetch_array($result)) {
		$r++;
		$lydoN = '';
		$mangtangca[$re['MaNV']] = 1;
		if ($mau == "white") {
			$mau = "#EEEEEE";
			$hl = "Normal4";
			$hl2 = "Highlight4";
		} else {
			$mau = "white";
			$hl = "Normal5";
			$hl2 = "Highlight5";
		}
		$thuquy0 = '';
		$thuquy1 = '';
		$thuquy2 = '';
		$thuquy3 = '';
		$thuquy4 = '';
		$ketoanOnL0 = '';
		$ketoanOnL1 = '';
		$ketoanOnL2 = '';
		$ketoanOnL3 = '';
		$ketoanOnL4 = '';
		$ketoanCH0 = '';
		$ketoanCH1 = '';
		$ketoanCH2 = '';
		$ketoanCH3 = '';
		$ketoanCH4 = '';
		$tinhtrang = $re["tinhtrang"];
		$tinhtrangduyet = "Chưa duyệt";
		$select1 = '';
		$select4 = '';
		$select3 = '';
		if ($tinhtrang == 4) {
			$tinhtrangduyet = "Đã duyệt";
			$select4 = "selected='selected'";
			//$disable='disable';
		} elseif ($tinhtrang == 1 || $tinhtrang == 0) {
			$tinhtrangduyet = "Chưa duyệt";
			$select1 = "selected='selected'";
			$select0 = "selected='selected'";
		} elseif ($tinhtrang == 3) {
			$tinhtrangduyet = "Không duyệt";
			$select3 = "selected='selected'";
		} elseif ($tinhtrang == 2) {
			$tinhtrangduyet = "Yêu cầu chỉnh sửa";
			$select2 = "selected='selected'";
			$showchinhsua = true;
		} elseif ($tinhtrang == 5) {
			$tinhtrangduyet = "Đã chỉnh sửa";
		}



		/*$tam= "giamsat$giamsat='selected'; "; eval('$'.$tam);
 				$tam= "ketoan$ketoan='selected'; ";eval('$'.$tam);*/
		$sotien = $re['sotien'];
		$tongtien += $sotien;

		if ($re['loaithuchi'] == 2) // cac khoan chi
		{
			$mauchu = "red";
		}
		if ($re['loaithuchi'] == 1) // cac khoan thu
		{
			$mauchu = "blue";
		}
		$lydoN = $re["lydoN"];
		$dongvc = '';
		$hdbh = $re["hdbh"] ? $re["hdbh"] . ' Thành tiền: ' . checksotienhoadon($re["hdbh"])['thanhtien'] : "";
		if ($re["hdbh"]) {
			$dongvc = CheckVanChuyen($re["hdbh"]);
		}

		$thuquyxn = '';
		$thuquyolxn = '';
		$thuquychxn = '';
		if ($re['nguoixn'] == 1 &&  ($ql[2] || $ql[5])) {

			if ($tinhtrang == 1) {
				$thuquyxn = 'Chưa duyệt';
			} else if ($tinhtrang == 3) {
				$thuquyxn = 'Duyệt';
			} else if ($tinhtrang == 3) {
				$thuquyxn = 'Không duyệt \n' . $re["lydoN"];
			}
		}



		if ($re['nguoixn'] == 2 && ($ql[3] || $ql[5])) {

			if ($tinhtrang == 1) {
				$thuquyolxn = 'Chưa duyệt';
			} else if ($tinhtrang == 3) {
				$thuquyolxn = 'Duyệt';
			} else if ($tinhtrang == 3) {
				$thuquyolxn = 'Không duyệt \n' . $re["lydoN"];
			}
		}


		if ($re['nguoixn'] == 3 && ($ql[4] || $ql[5])) {

			if ($tinhtrang == 1) {
				$thuquychxn = 'Chưa duyệt';
			} else if ($tinhtrang == 3) {
				$thuquychxn = 'Duyệt';
			} else if ($tinhtrang == 3) {
				$thuquychxn = 'Không duyệt \n' . $re["lydoN"];
			}
		}

		$mavdht = '';
		if ($dongvc && $dongvc['mavd']) {
			$mavdht = $dongvc['mavd'];
		}
		$phithukhht = '';
		if ($dongvc && $dongvc['phithukh']) {
			$phithukhht = $dongvc['phithukh'];
		}
		if ($ql[5]) {
			$tamarr = array($re['ngaythuchikt'], $re['ngaytao'], $re['sochungtu'], $re['tencuahang'], $re["khoanmuctc"], $re["diengiai"], $re["psno"], $re["donvi"], $re["soluong"], $re["dongia"], $mangtk[$re["tkno"]], $mangtk[$re["tkco"]], $re["psco"], $hdbh, $re["sotknh"] ? $re["sotknh"] : "", $re["tentknh"], $re["donvivc"], $re["mavandon"], $mavdht, $re["NCC"], gettennv('userac', $re["manv"], "Ten"), $re["manv"], $re["phieuxuat"] ? $re["phieuxuat"] : "", $re["phithukh"] != '' ? $re["phithukh"] : "", $phithukhht, $tinhtrangduyet, $re["lydoN"], $thuquyxn, $thuquyolxn, $thuquychxn);
		} else {
			$tamarr = array($re['ngaythuchikt'], $re['ngaytao'], $re['sochungtu'], $re['tencuahang'], $re["khoanmuctc"], $re["diengiai"], $re["psno"], $re["donvi"], $re["soluong"], $re["dongia"], $re["psco"], $hdbh, $re["sotknh"] ? $re["sotknh"] : "", $re["tentknh"], $re["donvivc"], $re["mavandon"], $mavdht, $re["NCC"], gettennv('userac', $re["manv"], "Ten"), $re["manv"], $re["phieuxuat"] ? $re["phieuxuat"] : "", $re["phithukh"] != '' ? $re["phithukh"] : "", $phithukhht, $tinhtrangduyet, $re["lydoN"], $thuquyxn, $thuquyolxn, $thuquychxn);
		}


		$writer->writeSheetRow('Sheet1', $tamarr);
	}


	ob_end_clean();
	header('Content-disposition: attachment; filename="' . XLSXWriter::sanitize_filename($filename) . '"');
	header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
	header('Content-Transfer-Encoding: binary');
	header('Cache-Control: must-revalidate');
	header('Pragma: public');
	$writer->writeToStdOut();
}
?>
  
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

function CheckVanChuyen($sobill)
{
	global  $data;
	$sql = "SELECT  mavd, sobill,phithukh,madh from vanchuyenonline where sobill ='$sobill'";
	//echo $sql;
	$tam = getdong($sql);
	//var_dump($tam);
	return $tam;
}
?>
