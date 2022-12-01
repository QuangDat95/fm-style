<?php
session_start();
date_default_timezone_set('Asia/Ho_Chi_Minh');
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



$req_date_1 = $_REQUEST["tungay"];

$req_date_2 = $_REQUEST["denngay"];


$today = date("Y-m-d H:i:s");
$lastdate = strtotime("-1 days", strtotime($today));
$lastdate = date("Y-m-d H:i:s", $lastdate);


if ($req_date_1) {
	$lastdate = $req_date_1;
}

if ($req_date_2) {
	$today = $req_date_2;
}

if (isset($_POST['DATA'])) {

	$chuoiinsert = '';
	//$_SESSION["mangluuvc"]=[];;
	$data1 = $_POST['DATA'];
	$tmp = explode('*@!', $data1);
	$ngaytu = $tmp[0];
	$ngayden = $tmp[1];
	$lastdate = $ngaytu;
	$today = $ngayden;
}

$sql = "SELECT a.SoCT,a.NgayNhap as ngayt,a.ID as idbill,v.dongthoigiantrangthaidon as tinhtrang,v.mavd,a.idgioithieu FROM phieubanhangluu a left join vanchuyenonline v on a.id=v.idbill where a.loai in(1,3,5) and Ngaynhap>='$lastdate' and Ngaynhap <='$today'  group by a.SoCT";

echo $sql;

$result = $data->query($sql);
$mangBillTL = [];

$mangBillCuahang = [];
$chuoiinsertBillCuahang = '';
if ($_SESSION["admintuan"])	echo $sql;


while ($re = $data->fetch_array($result)) {
	if (array_key_exists(rtrim($re['SoCT'], "TL"), $mangBillTL) || array_key_exists($re['SoCT'] . 'TL', $mangBillTL)) {

		$mangBillTL[rtrim($re['SoCT'], "TL")]["count"]++;

		if (substr($re['SoCT'], (strlen($re['SoCT']) - 2), strlen($re['SoCT'])) == "TL") {
			$mangBillTL[rtrim($re['SoCT'], "TL")]["ngayhuy"] = $re['ngayt'];
			$mangBillTL[rtrim($re['SoCT'], "TL")]["idbillTL"] = $re['idbill'];
		} else {
			$mangBillTL[rtrim($re['SoCT'], "TL")]["ngaytao"] = $re['ngayt'];
			$mangBillTL[rtrim($re['SoCT'], "TL")]["idbill"] = $re['idbill'];
		}
		if ($re['mavd']) {
			if ($re['mavd'] == "Bill trả lại") {
				$sbill = rtrim($re['SoCT'], "TL");
				$sql = "SELECT mavd FROM vanchuyenonline  where sobill='$sbill'";
				$dongvd = getdong($sql);
				if ($dongvd["mavd"]) {
					$re['mavd'] = $dongvd["mavd"];
				}
			}
			$mangBillTL[rtrim($re['SoCT'], "TL")]["mavd"] = $re['mavd'];
		}
		// if (substr($re['SoCT'], (strlen($re['SoCT']) - 2), strlen($re['SoCT'])) == "TL") {
		// 	$mangBillTL[rtrim($re['SoCT'], "TL")]["idbillTL"] = $re['idbill'];
		// } else {
		// 	$mangBillTL[rtrim($re['SoCT'], "TL")]["idbill"] = $re['idbill'];
		// }
	} else {
		$mangBillTL[rtrim($re['SoCT'], "TL")]["count"] = 1;
		//$mangBillTL[rtrim($re['SoCT'],"TL")]["ngayhuy"]='';
		if (substr($re['SoCT'], (strlen($re['SoCT']) - 2), strlen($re['SoCT'])) == "TL") {
			$mangBillTL[rtrim($re['SoCT'], "TL")]["idbillTL"] = $re['idbill'];
			$mangBillTL[rtrim($re['SoCT'], "TL")]["ngayhuy"] = $re['ngayt'];
		} else {
			$mangBillTL[rtrim($re['SoCT'], "TL")]["idbill"] = $re['idbill'];
			$mangBillTL[rtrim($re['SoCT'], "TL")]["ngaytao"] = $re['ngayt'];
		}
		// if (substr($re['SoCT'], (strlen($re['SoCT']) - 2), strlen($re['SoCT'])) == "TL") {
		// 	$mangBillTL[rtrim($re['SoCT'], "TL")]["ngayhuy"] = $re['ngayt'];
		// } else {
		// 	$mangBillTL[rtrim($re['SoCT'], "TL")]["ngaytao"] = $re['ngayt'];
		// }
		if ($re['mavd']) {
			if ($re['mavd'] == "Bill trả lại") {
				$sbill = rtrim($re['SoCT'], "TL");
				$sql = "SELECT mavd FROM vanchuyenonline  where sobill='$sbill'";
				$dongvd = getdong($sql);
				if ($dongvd["mavd"]) {
					$re['mavd'] = $dongvd["mavd"];
				}
			}
			$mangBillTL[rtrim($re['SoCT'], "TL")]["mavd"] = $re['mavd'];
		}
		if (substr($re['SoCT'], (strlen($re['SoCT']) - 2), strlen($re['SoCT'])) != "TL") {
			$scttmp = $re['SoCT'] . 'TL';

			//substr($re['SoCT'], (strlen($re['SoCT']) - 2), strlen($re['SoCT']));
			if ($re['tinhtrang']) {

				$mangBillTL[rtrim($re['SoCT'], "TL")]["tinhtrang"] = $re['tinhtrang'];
			} else {
				$sql = "SELECT a.SoCT,a.Ngaynhap as ngayt,a.ID as idbill,v.dongthoigiantrangthaidon as tinhtrang,v.mavd,a.idgioithieu FROM phieubanhangluu a left join vanchuyenonline v on a.id=v.idbill where a.loai in(1,3,5) and a.SoCT='$scttmp' group by a.SoCT";
				$dong = getdong($sql);
				if ($dong['tinhtrang']) {
					$mangBillTL[rtrim($re['SoCT'], "TL")]["tinhtrang"] = $dong['tinhtrang'];
				}
			}
		}
	}

	if ($re['idgioithieu'] == -1) {

		$chuoiinsertBillCuahang = "('$re[idbill]','$re[SoCT]','Đơn Cửa hàng','1','$re[ngayt]','6')";

		$sqlBCH = "insert into vanchuyenonline (idbill,sobill,mavd,dongthoigiantrangthaidon,ngayhoanthanh,loai) values $chuoiinsertBillCuahang on DUPLICATE KEY UPDATE dongthoigiantrangthaidon=1,mavd=VALUES(mavd),ngayhoanthanh='$re[ngayt]';";
		$data->query($sqlBCH);

		array_push($mangBillCuahang, $re['SoCT']);
	}

	$r++;
}
var_dump($mangBillTL);
//=======tự động update phiếu có phieus trả lại thành hủy
//echo json_encode($mangBillTL);
//echo json_encode($mangBillTL);
//if($_SESSION["LoginID"]==7576){

$mangBillTL2 = [];
$chuoiInsertTL = '';
$chuoibillkotltrongngay = '';
if (count($mangBillTL) > 0) {

	foreach ($mangBillTL as $key => $value) {

		if ($value["count"] >= 2) {

			if (!$value["mavd"]) {
				// mua trực tiếp
				if (date($value["ngaytao"]) == date($value["ngayhuy"])) {
					$sobill = $key . "TL";
					$chuoiInsertTL = "('$value[idbill]','$key','Bill trả lại','8','$value[ngayhuy]','6'),";
					$chuoiInsertTL .= "('$value[idbillTL]','$sobill','Bill trả lại','8','$value[ngayhuy]','6')";
				} else {
					if ($value["tinhtrang"] == 1) {
						$sobill = $key . "TL";
						$chuoiInsertTL = "('$value[idbillTL]','$sobill','Bill trả lại','1','$value[ngayhuy]','6')";
					}
				}
			} else {
				if ($value["tinhtrang"] == 1) {

					$sobill = $key . "TL";
					$chuoiInsertTL = "('$value[idbillTL]','$sobill','$value[mavd]','1','$value[ngayhuy]','6')";
				} else {
					$sobill = $key . "TL";
					$chuoiInsertTL = "('$value[idbill]','$key','$value[mavd]','8','$value[ngayhuy]','6'),";
					$chuoiInsertTL .= "('$value[idbillTL]','$sobill','$value[mavd]','8','$value[ngayhuy]','6')";
				}
			}
			if ($chuoiInsertTL) {
				$sqlu = "INSERT INTO vanchuyenonline (idbill,sobill,mavd,dongthoigiantrangthaidon,ngayhoanthanh,loai) values $chuoiInsertTL on DUPLICATE KEY UPDATE dongthoigiantrangthaidon=1,mavd=VALUES(mavd),ngayhoanthanh='$value[ngayhuy]';";
				echo "chuoiInsertTL 1:" . $chuoiInsertTL . "<br>";
				$data->query($sqlu);
			}
		} else {
			if (!empty(stripos($re['SoCT'], "TL"))) {
				$sochungtu = rtrim($re['SoCT'], "TL");
				$query = "SELECT v.dongthoigiantrangthaidon as tinhtrang FROM phieubanhangluu a left join vanchuyenonline v on a.id=v.idbill where a.loai in(1,3,5) and a.SoCT='$sochungtu' group by a.SoCT";
				$res = getdong($query);
				if ($res['tinhtrang']) {
					if (!$value["mavd"]) {
						// mua trực tiếp
						if (date($value["ngaytao"]) == date($value["ngayhuy"])) {
							$sobill = $key . "TL";
							$chuoiInsertTL = "('$value[idbill]','$key','Bill trả lại','8','$value[ngayhuy]','6'),";
							$chuoiInsertTL .= "('$value[idbillTL]','$sobill','Bill trả lại','8','$value[ngayhuy]','6')";
						} else {
							if ($res["tinhtrang"] == 1) {
								$sobill = $key . "TL";
								$chuoiInsertTL = "('$value[idbillTL]','$sobill','Bill trả lại','1','$value[ngayhuy]','6')";
							}
						}
					} else {
						if ($res["tinhtrang"] == 1) {
							$sobill = $key . "TL";
							$chuoiInsertTL = "('$value[idbillTL]','$sobill','$value[mavd]','1','$value[ngayhuy]','6')";
						} else {
							$sobill = $key . "TL";
							$chuoiInsertTL = "('$value[idbill]','$key','$value[mavd]','8','$value[ngayhuy]','6'),";
							$chuoiInsertTL .= "('$value[idbillTL]','$sobill','$value[mavd]','8','$value[ngayhuy]','6')";
						}
					}
					if ($chuoiInsertTL) {
						$sqlu = "INSERT INTO vanchuyenonline (idbill,sobill,mavd,dongthoigiantrangthaidon,ngayhoanthanh,loai) values $chuoiInsertTL on DUPLICATE KEY UPDATE dongthoigiantrangthaidon=1,mavd=VALUES(mavd),ngayhoanthanh='$value[ngayhuy]';";
						echo "chuoiInsertTL 1:" . $chuoiInsertTL . "<br>";
						$data->query($sqlu);
					}
				}
			} else {
				if ($value["tinhtrang"] == 1) {
					$mangBillTL2[$key . "TL"] = $value["mavd"] ? $value["mavd"] : "Bill hoàn thành công";
					$mangBillTinhtttruoc[$key . "TL"] = 1;
				} else {
					$mangBillTL2[$key . "TL"] = $value["mavd"] ? $value["mavd"] : "Bill trả lại";
					$mangBillTinhtttruoc[$key . "TL"] = 8;
				}
				$chuoibillkotltrongngay .= "'" . $key . "TL',";
			}
		}
	}
}

//echo "chuoiInsertTL cung ngay:" . $chuoiInsertTL;
// if ($chuoiinsertBillCuahang) {

// 	$chuoiinsertBillCuahang = rtrim($chuoiinsertBillCuahang, ",");
// 	$sqlBCH = "insert	into vanchuyenonline (idbill,sobill,mavd,dongthoigiantrangthaidon,ngayhoanthanh,loai) values $chuoiinsertBillCuahang on DUPLICATE KEY UPDATE dongthoigiantrangthaidon=VALUES(dongthoigiantrangthaidon),mavd=VALUES(mavd),ngayhoanthanh=VALUES(ngayhoanthanh);";
// 	$data->query($sqlBCH);
// }

// if ($chuoiInsertTL) {
// 	$chuoiInsertTL = rtrim($chuoiInsertTL, ",");
// 	echo "chuoiInsertTL cung ngay:" . $chuoiInsertTL;
// 	$sqlu = "insert into vanchuyenonline (idbill,sobill,mavd,dongthoigiantrangthaidon,ngayhoanthanh,loai) values $chuoiInsertTL on DUPLICATE KEY UPDATE dongthoigiantrangthaidon=VALUES(dongthoigiantrangthaidon),mavd=VALUES(mavd),ngayhoanthanh=VALUES(ngayhoanthanh);";
// 	echo "chuoiInsertTL 1:" . $chuoiInsertTL . "<br>";
// 	$data->query($sqlu);
// }
//echo "chuoibillkotltrongngay :" . $chuoibillkotltrongngay . "<br>";
if ($chuoibillkotltrongngay) {
	$chuoibillkotltrongngay = rtrim($chuoibillkotltrongngay, ",");
	$sql = "select * from phieubanhangluu where SoCT in($chuoibillkotltrongngay) group by SoCT";

	$result = $data->query($sql);
	while ($re = $data->fetch_array($result)) {
		$mavd = "";
		$mavd = $mangBillTL2[$re["SoCT"]];
		$tinhtrang = $mangBillTinhtttruoc[$re["SoCT"]];
		$chuoiInsertTL2 = "('$re[ID]','$re[SoCT]','$mavd',$tinhtrang,'$re[NgayNhap]','6')";
		$sqlu2 = "INSERT INTO vanchuyenonline (idbill,sobill,mavd,dongthoigiantrangthaidon,ngayhoanthanh,loai) VALUES $chuoiInsertTL2 ON DUPLICATE KEY UPDATE dongthoigiantrangthaidon=$tinhtrang,mavd=VALUES(mavd),ngayhoanthanh='$re[NgayNhap]'";
		$data->query($sqlu2);
	}
}



//echo "ok";
//}
//=======end tự động update phiếu có phieus trả lại thành hủy


$data->closedata();
