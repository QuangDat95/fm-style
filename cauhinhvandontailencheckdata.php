<?php
session_start();
//set_time_limit(0);
$quyen = $_SESSION["quyen"];
date_default_timezone_set('Asia/Ho_Chi_Minh');
//ini_set('memory_limit', '-1');$_SESSION["act"]
if ($_SESSION["LoginID"] == "") return;
$ql = $quyen[$_SESSION["mangquyenid"][$_SESSION["act"]]];

$root_path = getcwd() . "/";
include($root_path . "biensession.php");
include($root_path . "includes/config.php");
include($root_path . "includes/removeUnicode.php");
include($root_path . "includes/class.paging.php");
include($root_path . "includes/class.mysql.php");
include($root_path . "includes/function.php");
include($root_path . "includes/function_local.php");
include($root_path . "excel/simplexlsx.class.php");
include($root_path . "cauhinhtailenvandonluubien.php");
$cauhinhvc = $mangcauhinhvc ? json_decode($mangcauhinhvc, true) : "";

include($root_path . "cauhinhtailenvandonbientrangthai.php");




$mangttcuoiHT = ["Đã đối soát", "Bồi hoàn", "Đã giao hàng/Chưa đối soát", "Giao thành công", "Completed", "COMPLETED", "Đã ký nhận", "Phát thành công", "Phát hoàn thành công", "Đã giao", "Đã giao hàng", "Đã nhận", "Đã xong", "Hoàn thành", "hoàn thành", "delivered", "Thành công - Phát thành công"];
$mangttcuoiHUY = ["Đã đối soát công nợ trả hàng", "Không lấy được hàng", "Đã trả", "Returned to Sender", "Đã chuyển hoàn", "Đã hủy", "Đã huỷ", "Trả hàng/hoàn tiền", "Trả hàng hoặc hoàn tiền", "Thất lạc & Hư hỏng", "Đơn hủy", "Đã trả hàng (COD đã trả xong hàng)", "Hủy đơn hàng", "Cancelled", "Xoá gần đây"];
$mangttcuoiHOAN = ["Đã đối soát công nợ trả hàng", "Đã trả", "Returned to Sender"];
//$path = $root_path."data/maubanhangpancake.xlsx"  ; 
//var_dump($ql[5]); 
$idk = laso($_SESSION["LoginID"]);
if ($idk == 0) return;
$idkho = $_SESSION["se_kho"];
$data = new class_mysql();
$data->config();
$data->access();



$tm = $_SESSION["root_path"];

//đọc dữ liệu
$path = $root_path . "data/vandontailen" . '-' . $idk . '-' . $idkho . ".xlsx";
$xlsx = new SimpleXLSX($path);
//var_dump($xlsx);
$sheets = $xlsx->rows();
$sheettam = $sheets;


$rows_begin = 12;
$rows_end = count($sheets);
$tam = [];
$loi = false;
if ($count_rows >= 600) $rows_end = 600;
list($cols,) = $xlsx->dimension();
$cols = 22;
$ngaytao = gmdate('Y-m-d H:i:s');
if (isset($_POST['DATA'])) {

	$_SESSION["mangluuvc"] = [];;
	$data1 = $_POST['DATA'];
	$tmp = explode('*@!', $data1);
	$tudong = laso($tmp[1]);

	$dendong = laso($tmp[2]);
	$manvc = chonghack($tmp[3]);
	if ($tudong) {
		$rows_begin = ($tudong);
	}
	if ($dendong) {
		$rows_end = ($dendong);
	}
	$sott = 0;

	$cauhinh = $cauhinhvc[$manvc];

	$chuoiinsert = '';
	$updatesucess = 0;
	$updatefail = 0;
	$insertsuccess = 0;
	$insertfail = 0;
	foreach ($sheets as $k => $r) {

		$checkloi = false;
		$mauchu = 'green';
		$thongbaoloi = '';
		$onclick = '';
		if ($manvc == 'KMVD') {
			if (($k >= $rows_begin) && ($k <= $rows_end)) {
				$mvd = $r[$cauhinh['socot']['mavd']['cot']];
				$sobill = $r[$cauhinh['socot']['sobill']['cot']];
				if ($mvd) {
					$mavdtam = explode(".", $mvd);
					$madoitac = $mavdtam[count($mavdtam) - 1];
				} else {
					$mvd = 'Bill Công nợ / không có mã VD';
					$mavdtam = 'Bill Công nợ / không có mã VD';
					$madoitac = $sobill;
				}
				$tt1 = $r[$cauhinh['socot']['dongthoigiantrangthaidon']['cot']];
				$loai = '';

				if (in_array($tt1, $mangttcuoiHT)) {
					$tt1 = 1;
				} else if (in_array($tt1, $mangttcuoiHUY)) {
					$tt1 = 8;
					if (in_array($tt1, $mangttcuoiHOAN)) {
						$loai = -1;
					}
				}
				$dongdulieu = getdong("select ID,NgayNhap from phieubanhangluu where SoCT ='$sobill' limit 1");
				$chuoiinsert_ = "('$dongdulieu[ID]','$sobill','$mvd','$mvd','$madoitac','$tt1',(select NgayNhap from phieubanhangluu where SoCT ='$sobill' limit 1),'$loai')";
				$sql = "
 			insert into vanchuyenonline (IDbill,sobill,madh,mavd,madoitac,dongthoigiantrangthaidon,ngayhoanthanh,loai)  values $chuoiinsert_ ON DUPLICATE KEY UPDATE IDbill=VALUES(IDbill),sobill=VALUES(sobill),madh=VALUES(madh),mavd=VALUES(mavd),madoitac=VALUES(madoitac),dongthoigiantrangthaidon='$tt1',ngayhoanthanh='$dongdulieu[NgayNhap]'";
				if ($data->query($sql)) {
					$insertsuccess++;
				}
			}
		} else if ($manvc == 'GOPVD') {
			if (($k >= $rows_begin) && ($k <= $rows_end)) {
				$mavd = $r[$cauhinh['socot']['mavd']['cot']];
				$sobill = $r[$cauhinh['socot']['sobill']['cot']];
				if ($mavd) {
					$mavdtam = explode(".", $mavd);
					$madoitac = $mavdtam[count($mavdtam) - 1];


					$tt1 = $r[$cauhinh['socot']['dongthoigiantrangthaidon']['cot']];
					$ngayhoanthanh = $r[$cauhinh['socot']['ngayhoanthanh']['cot']];
					$loai = '';
					if (in_array($tt1, $mangttcuoiHT)) {
						$tt1 = 1;
					} else if (in_array($tt1, $mangttcuoiHUY)) {
						$tt1 = 8;
						if (in_array($tt1, $mangttcuoiHOAN)) {
							$loai = -1;
						}
					}

					$chuoiinsert .= "((select ID from phieubanhangluu where SoCT ='$sobill' limit 1),'$sobill','$mavd','$mavd','$madoitac','$tt1','$ngayhoanthanh','$loai'),";
					$insertsuccess++;

					$sql = "update vanchuyenonline set dongthoigiantrangthaidon='" . $tt1 . "',ngayhoanthanh='" . $ngayhoanthanh . "',loai='$loai' where madoitac='$madoitac' or  mavd='" . $mavd . "'";
					//if(!(($tt1==1 || $tt1==8) && $ngayhoanthanh==''))){
					if ($data->query($sql)) {
						$updatesucess++;
					} else {
						$updatefail++;
					}
					//}


					echo $sql;
					echo "<br>";
					echo $chuoiinsert;
				}
			}
		} else {
			if (($k >= $rows_begin) && ($k <= $rows_end)) {


				$checkvanchuyen = CheckVanChuyendon($r[$cauhinh['socot']['madh']['cot']]);

				$checksobill = '';
				$thongbaosobill = '';
				$thongbaomadh = '';
				$thongbaomavd = '';
				$thongbaotongtien = '';
				$thongbaophitravc = '';
				$phithukh = '';
				$mavdtmp = '';
				$mavdtam = $r[$cauhinh['socot']['madh']['cot']];
				$donvivc = $r[$cauhinh['socot']['donvivc']['cot']];
				$mavdtam = explode(".", $mavdtam);
				$madoitac = $mavdtam[count($mavdtam) - 1];
				if ($r[$cauhinh['socot']['sobill']['cot']]) {
					$ngayhoanthanh = '';
					$checksobill = checkBill($r[$cauhinh['socot']['sobill']['cot']]);
					$ngaydaydon_dvvc = $checksobill["ngaydaydon_dvvc"];
					if (!$ngaydaydon_dvvc) {
						$ngaydaydon_dvvc = $ngaytao;
					}
					if ($checksobill && !$checkvanchuyen['ID']) {
						if ($checksobill['sobill']) {
							$tt1 = $r[$cauhinh['socot']['dongthoigiantrangthaidon']['cot']];
							$tt2 = $checksobill['dongthoigiantrangthaidon'];
							$tth = 0;
							//|| in_array($tt2,$mangttcuoiHT) || in_array($tt2,$mangttcuoiHUY)
							if ($tt2 == 8 || $tt2 == 1) {

								if ($_SESSION["LoginID"] == 7576 || $_SESSION["LoginID"] == 7579  || $_SESSION["LoginID"] == 4647) {

									if (in_array($tt1, $mangttcuoiHT)) {
										$tt1 = 1;
										$ngayhoanthanh = $r[$cauhinh['socot']['ngayhoanthanh']['cot']] ? $r[$cauhinh['socot']['ngayhoanthanh']['cot']] : $r[$cauhinh['socot']['ngaygiaohang']['cot']];
										if ($manvc == "NINJA") {
											if ($r[$cauhinh['socot']['ngaygiaolan3']['cot']]) {
												$ngayhoanthanh = $r[$cauhinh['socot']['ngaygiaolan3']['cot']];
											} else if ($r[$cauhinh['socot']['ngaygiaolan2']['cot']]) {
												$ngayhoanthanh = $r[$cauhinh['socot']['ngaygiaolan2']['cot']];
											} else if ($r[$cauhinh['socot']['ngaygiaolan1']['cot']]) {
												$ngayhoanthanh = $r[$cauhinh['socot']['ngaygiaolan1']['cot']];
											}
										}

										if ($r[$cauhinh['socot']['thongtintrahoan']['cot']]) {
											if (in_array($r[$cauhinh['socot']['thongtintrahoan']['cot']], $mangttcuoiHOAN)) {
												$tt1 = 8;
												$tth = -1;
											}
										}
									} else if (in_array($tt1, $mangttcuoiHUY)) {
										$tt1 = 8;
										if ($tt1 == 'Bồi hoàn' || $tt1 == 'Đã đối soát công nợ trả hàng') {
											if ($r[$cauhinh['socot']['ngaygiaohang']['cot']]) {
												$ngayhoanthanh = $r[$cauhinh['socot']['ngaygiaohang']['cot']];
											} else if ($r[$cauhinh['socot']['ngaytaodon']['cot']]) {
												$ngayhoanthanh = $r[$cauhinh['socot']['ngaytaodon']['cot']];
											} else {
												$ngayhoanthanh = $r[$cauhinh['socot']['ngayhuy']['cot']] ? $r[$cauhinh['socot']['ngayhuy']['cot']] : $r[$cauhinh['socot']['ngayhoanthanh']['cot']];
											}
										} else {
											$ngayhoanthanh = $r[$cauhinh['socot']['ngayhuy']['cot']] ? $r[$cauhinh['socot']['ngayhuy']['cot']] : $r[$cauhinh['socot']['ngayhoanthanh']['cot']];
										}
										if ($manvc == "NINJA") {
											if ($r[$cauhinh['socot']['ngaygiaolan3']['cot']]) {
												$ngayhoanthanh = $r[$cauhinh['socot']['ngaygiaolan3']['cot']];
											} else if ($r[$cauhinh['socot']['ngaygiaolan2']['cot']]) {
												$ngayhoanthanh = $r[$cauhinh['socot']['ngaygiaolan2']['cot']];
											} else if ($r[$cauhinh['socot']['ngaygiaolan1']['cot']]) {
												$ngayhoanthanh = $r[$cauhinh['socot']['ngaygiaolan1']['cot']];
											}
										}
										if (in_array($tt1, $mangttcuoiHOAN)) {
											$tth = -1;
										}
									}

									if ($_SESSION["LoginID"] == 7576 || $_SESSION["admintuan"])
										echo "ngayhoanthanh 1: " . $ngayhoanthanh;
								}


								$sql = "update vanchuyenonline set madh='" . $r[$cauhinh['socot']['madh']['cot']] . "',mavd='" . $r[$cauhinh['socot']['madh']['cot']] . "',loai='$tth',ngaydaydon_dvvc='$ngaydaydon_dvvc' where IDbill='" . $checksobill["IDbill"] . "'";
							} else {

								if (in_array($tt1, $mangttcuoiHT)) {
									$ngayhoanthanh = $r[$cauhinh['socot']['ngayhoanthanh']['cot']] ? $r[$cauhinh['socot']['ngayhoanthanh']['cot']] : $r[$cauhinh['socot']['ngaygiaohang']['cot']];

									if ($manvc == "NINJA") {
										if ($r[$cauhinh['socot']['ngaygiaolan3']['cot']]) {
											$ngayhoanthanh = $r[$cauhinh['socot']['ngaygiaolan3']['cot']];
										} else if ($r[$cauhinh['socot']['ngaygiaolan2']['cot']]) {
											$ngayhoanthanh = $r[$cauhinh['socot']['ngaygiaolan2']['cot']];
										} else if ($r[$cauhinh['socot']['ngaygiaolan1']['cot']]) {
											$ngayhoanthanh = $r[$cauhinh['socot']['ngaygiaolan1']['cot']];
										}
									}
									$tt1 = 1;
									if ($r[$cauhinh['socot']['thongtintrahoan']['cot']]) {
										if (in_array($r[$cauhinh['socot']['thongtintrahoan']['cot']], $mangttcuoiHOAN)) {
											$tt1 = 8;
											$tth = -1;
										}
									}
								} else if (in_array($tt1, $mangttcuoiHUY)) {
									if ($tt1 == 'Bồi hoàn' || $tt1 == 'Đã đối soát công nợ trả hàng') {
										if ($r[$cauhinh['socot']['ngaygiaohang']['cot']]) {
											$ngayhoanthanh = $r[$cauhinh['socot']['ngaygiaohang']['cot']];
										} else if ($r[$cauhinh['socot']['ngaytaodon']['cot']]) {
											$ngayhoanthanh = $r[$cauhinh['socot']['ngaytaodon']['cot']];
										} else {
											$ngayhoanthanh = $r[$cauhinh['socot']['ngayhuy']['cot']] ? $r[$cauhinh['socot']['ngayhuy']['cot']] : $r[$cauhinh['socot']['ngayhoanthanh']['cot']];
										}
									} else {
										$ngayhoanthanh = $r[$cauhinh['socot']['ngayhuy']['cot']] ? $r[$cauhinh['socot']['ngayhuy']['cot']] : $r[$cauhinh['socot']['ngayhoanthanh']['cot']];
									}
									if ($manvc == "NINJA") {
										if ($r[$cauhinh['socot']['ngaygiaolan3']['cot']]) {
											$ngayhoanthanh = $r[$cauhinh['socot']['ngaygiaolan3']['cot']];
										} else if ($r[$cauhinh['socot']['ngaygiaolan2']['cot']]) {
											$ngayhoanthanh = $r[$cauhinh['socot']['ngaygiaolan2']['cot']];
										} else if ($r[$cauhinh['socot']['ngaygiaolan1']['cot']]) {
											$ngayhoanthanh = $r[$cauhinh['socot']['ngaygiaolan1']['cot']];
										}
									}

									$tt1 = 8;
									if (in_array($tt1, $mangttcuoiHOAN)) {
										$tth = -1;
									}
									if ($_SESSION["LoginID"] == 7576) {

										echo "okokoko1" . $tt1 . "<br>";
										echo "ngayhoanthanh" . $ngayhoanthanh . "<br>";
									}
								}

								if (substr($r[$cauhinh['socot']['madh']['cot']], -1) == "R") {
									$mavdtmp = rtrim($r[$cauhinh['socot']['madh']['cot']], "R");
									$checkvanchuyen = CheckVanChuyendon($mavdtmp);
									if ($checkvanchuyen["ID"]) {
										$tt1 = 8;
										$tth = -1;
									}
								}
								if ($tt2 != 8 && $tt2 != 1) {
									if ($mavdtmp) {
										$sql = "update vanchuyenonline dongthoigiantrangthaidon='" . $tt1 . "',ngayhoanthanh='$ngayhoanthanh',loai='$tth',ngaydaydon_dvvc='$ngaydaydon_dvvc',donvivc='$donvivc' where madoitac='$madoitac' or  mavd='" . $mavdtmp . "'";
									} else {

										if ($ngayhoanthanh) {
											if ($checksobill["ngayhoanthanh"] && $checksobill["ngayhoanthanh"] != '0000-00-00 00:00:00' && $checksobill["ngayhoanthanh"] < $ngayhoanthanh) {
												$sql = "update vanchuyenonline set madh='" . $r[$cauhinh['socot']['madh']['cot']] . "',tongtien='" . $r[$cauhinh['socot']['tongtien']['cot']] . "',phitravc='" . $r[$cauhinh['socot']['phitravc']['cot']] . "',dongthoigiantrangthaidon='" . $tt1 . "',ngayhoanthanh='$ngayhoanthanh',mavd='" . $r[$cauhinh['socot']['madh']['cot']] . "',madoitac='$madoitac',loai='$tth',ngaydaydon_dvvc='$ngaydaydon_dvvc',donvivc='$donvivc' where madoitac='$madoitac' or  mavd='" . $checksobill["mavd"] . "'";
											} else {


												$sql = "update vanchuyenonline set madh='" . $r[$cauhinh['socot']['madh']['cot']] . "',tongtien='" . $r[$cauhinh['socot']['tongtien']['cot']] . "',phitravc='" . $r[$cauhinh['socot']['phitravc']['cot']] . "',dongthoigiantrangthaidon='" . $tt1 . "',ngayhoanthanh='$ngayhoanthanh',loai='$tth',ngaydaydon_dvvc='$ngaydaydon_dvvc',donvivc='$donvivc' where madoitac='$madoitac' or  mavd='" . $checksobill["mavd"] . "'";
											}
										} else {

											$sql = "update vanchuyenonline set madh='" . $r[$cauhinh['socot']['madh']['cot']] . "',tongtien='" . $r[$cauhinh['socot']['tongtien']['cot']] . "',phitravc='" . $r[$cauhinh['socot']['phitravc']['cot']] . "',mavd='" . $r[$cauhinh['socot']['madh']['cot']] . "',dongthoigiantrangthaidon='" . $tt1 . "',loai='$tth',ngaydaydon_dvvc='$ngaydaydon_dvvc' where madoitac='$madoitac',donvivc='$donvivc' or mavd='" . $checksobill["mavd"] . "'";
										}
									}
									if ($_SESSION["LoginID"] == 7576) {

										echo "okokoko2" . $tt1 . "<br>";
										echo "ngayhoanthanh" . $ngayhoanthanh . "<br>";
									}
								} else {

									/*	if($_SESSION["LoginID"]==7576 ||$_SESSION["admintuan"]||$_SESSION["LoginID"]==5638 ||$_SESSION["LoginID"]==4647){
									if($ngayhoanthanh){
										$sql="update vanchuyenonline ngayhoanthanh='$ngayhoanthanh',loai='$tth',ngaydaydon_dvvc='$ngaydaydon_dvvc' where madoitac='$madoitac' or  mavd='".$checksobill["mavd"]."'";
									}
									echo "sql 1: ".$sql;
								}*/
								}
							}

							if ($sql) {
								if ($data->query($sql)) {
									$updatesucess++;
								} else {
									$updatefail++;
								}
							}
						} else {
							$tth = 0;
							$tt1 = $r[$cauhinh['socot']['dongthoigiantrangthaidon']['cot']];

							if (in_array($tt1, $mangttcuoiHT)) {
								$ngayhoanthanh = $r[$cauhinh['socot']['ngayhoanthanh']['cot']] ? $r[$cauhinh['socot']['ngayhoanthanh']['cot']] : $r[$cauhinh['socot']['ngaygiaohang']['cot']];
								if ($manvc == "NINJA") {
									if ($r[$cauhinh['socot']['ngaygiaolan3']['cot']]) {
										$ngayhoanthanh = $r[$cauhinh['socot']['ngaygiaolan3']['cot']];
									} else if ($r[$cauhinh['socot']['ngaygiaolan2']['cot']]) {
										$ngayhoanthanh = $r[$cauhinh['socot']['ngaygiaolan2']['cot']];
									} else if ($r[$cauhinh['socot']['ngaygiaolan1']['cot']]) {
										$ngayhoanthanh = $r[$cauhinh['socot']['ngaygiaolan1']['cot']];
									}
								}
								$tt1 = 1;
								if ($r[$cauhinh['socot']['thongtintrahoan']['cot']]) {
									if (in_array($r[$cauhinh['socot']['thongtintrahoan']['cot']], $mangttcuoiHOAN)) {
										$tt1 = 8;
										$tth = -1;
									}
								}
							} else if (in_array($tt1, $mangttcuoiHUY)) {
								if ($tt1 == 'Bồi hoàn' || $tt1 == 'Đã đối soát công nợ trả hàng') {
									if ($r[$cauhinh['socot']['ngaygiaohang']['cot']]) {
										$ngayhoanthanh = $r[$cauhinh['socot']['ngaygiaohang']['cot']];
									} else if ($r[$cauhinh['socot']['ngaytaodon']['cot']]) {
										$ngayhoanthanh = $r[$cauhinh['socot']['ngaytaodon']['cot']];
									} else {
										$ngayhoanthanh = $r[$cauhinh['socot']['ngayhuy']['cot']] ? $r[$cauhinh['socot']['ngayhuy']['cot']] : $r[$cauhinh['socot']['ngayhoanthanh']['cot']];
									}
								} else {
									$ngayhoanthanh = $r[$cauhinh['socot']['ngayhuy']['cot']] ? $r[$cauhinh['socot']['ngayhuy']['cot']] : $r[$cauhinh['socot']['ngayhoanthanh']['cot']];
								}
								$tt1 = 8;
								if ($manvc == "NINJA") {
									if ($r[$cauhinh['socot']['ngaygiaolan3']['cot']]) {
										$ngayhoanthanh = $r[$cauhinh['socot']['ngaygiaolan3']['cot']];
									} else if ($r[$cauhinh['socot']['ngaygiaolan2']['cot']]) {
										$ngayhoanthanh = $r[$cauhinh['socot']['ngaygiaolan2']['cot']];
									} else if ($r[$cauhinh['socot']['ngaygiaolan1']['cot']]) {
										$ngayhoanthanh = $r[$cauhinh['socot']['ngaygiaolan1']['cot']];
									}
								}
								if (in_array($tt1, $mangttcuoiHOAN)) {
									$tth = -1;
								}
							}
							//(IDbill,sobill,madh,mavd,tongtien,phitravc,dongthoigiantrangthaidon,ngayhoanthanh,donvivc,madoitac,loai,ngaydaydon_dvvc)
							//(IDbill,sobill,madh,mavd,tongtien,phitravc,dongthoigiantrangthaidon) 
							$chuoiinsert .= "('" . $checksobill['IDbill'] . "','" . $checksobill['SoCT'] . "','" . $r[$cauhinh['socot']['madh']['cot']] . "','" . $r[$cauhinh['socot']['madh']['cot']] . "','" . $r[$cauhinh["socot"]["tongtien"]["cot"]] . "','" . $r[$cauhinh["socot"]["phitravc"]["cot"]] . "','" . $tt1 . "','" . $ngayhoanthanh . "','" . $donvivc . "','" . $madoitac . "','" . $tth . "','" . $ngaydaydon_dvvc . "'),";

							if ($_SESSION["admintuan"] || $_SESSION["LoginID"] == 7576) {
								echo $chuoiinsert;
							}
							$insertsuccess++;
						}
					}
				}

				if ($checkvanchuyen['ID']) {
					$ngaydaydon_dvvc = $checkvanchuyen["ngaydaydon_dvvc"];
					if (!$ngaydaydon_dvvc) {
						$ngaydaydon_dvvc = $ngaytao;
					}
					$thongbaoloi .= 'Phát hiện mã đơn hàng trong hệ thống\n';
					$thongbaomadh = '<br/><span style="color:green;font-size:10px">Phát hiện phiếu</span>';

					$tth = 0;
					$tt1 = $r[$cauhinh['socot']['dongthoigiantrangthaidon']['cot']];
					$tt3 = $tt1;
					$tt2 = $checkvanchuyen['dongthoigiantrangthaidon'];
					//|| in_array($tt2,$mangttcuoiHT) || in_array($tt2,$mangttcuoiHUY)
					if ($tt2 == 8 || $tt2 == 1) {

						if ($_SESSION["LoginID"] == 7576 || $_SESSION["LoginID"] == 7579  || $_SESSION["LoginID"] == 4647 ) {

							if (in_array($tt1, $mangttcuoiHT)) {
								$tt3 = 1;
								$ngayhoanthanh = $r[$cauhinh['socot']['ngayhoanthanh']['cot']] ? $r[$cauhinh['socot']['ngayhoanthanh']['cot']] : $r[$cauhinh['socot']['ngaygiaohang']['cot']];
								if ($manvc == "NINJA") {
									if ($r[$cauhinh['socot']['ngaygiaolan3']['cot']]) {
										$ngayhoanthanh = $r[$cauhinh['socot']['ngaygiaolan3']['cot']];
									} else if ($r[$cauhinh['socot']['ngaygiaolan2']['cot']]) {
										$ngayhoanthanh = $r[$cauhinh['socot']['ngaygiaolan2']['cot']];
									} else if ($r[$cauhinh['socot']['ngaygiaolan1']['cot']]) {
										$ngayhoanthanh = $r[$cauhinh['socot']['ngaygiaolan1']['cot']];
									}
								}

								if ($r[$cauhinh['socot']['thongtintrahoan']['cot']]) {
									if (in_array($r[$cauhinh['socot']['thongtintrahoan']['cot']], $mangttcuoiHOAN)) {
										$tt3 = 8;
										$tth = -1;
									}
								}
							} else if (in_array($tt1, $mangttcuoiHUY)) {
								$tt3 = 8;
								if ($tt1 == 'Bồi hoàn' || $tt1 == 'Đã đối soát công nợ trả hàng') {
									if ($r[$cauhinh['socot']['ngaygiaohang']['cot']]) {
										$ngayhoanthanh = $r[$cauhinh['socot']['ngaygiaohang']['cot']];
									} else if ($r[$cauhinh['socot']['ngaytaodon']['cot']]) {
										$ngayhoanthanh = $r[$cauhinh['socot']['ngaytaodon']['cot']];
									} else {
										$ngayhoanthanh = $r[$cauhinh['socot']['ngayhuy']['cot']] ? $r[$cauhinh['socot']['ngayhuy']['cot']] : $r[$cauhinh['socot']['ngayhoanthanh']['cot']];
									}
								} else {
									$ngayhoanthanh = $r[$cauhinh['socot']['ngayhuy']['cot']] ? $r[$cauhinh['socot']['ngayhuy']['cot']] : $r[$cauhinh['socot']['ngayhoanthanh']['cot']];
								}
								if ($manvc == "NINJA") {
									if ($r[$cauhinh['socot']['ngaygiaolan3']['cot']]) {
										$ngayhoanthanh = $r[$cauhinh['socot']['ngaygiaolan3']['cot']];
									} else if ($r[$cauhinh['socot']['ngaygiaolan2']['cot']]) {
										$ngayhoanthanh = $r[$cauhinh['socot']['ngaygiaolan2']['cot']];
									} else if ($r[$cauhinh['socot']['ngaygiaolan1']['cot']]) {
										$ngayhoanthanh = $r[$cauhinh['socot']['ngaygiaolan1']['cot']];
									}
								}
								if (in_array($tt1, $mangttcuoiHOAN)) {
									$tth = -1;
								}
							}
							//echo "ngayhoanthanh 2: ".$ngayhoanthanh;
						}
					} else {


						if (in_array($tt1, $mangttcuoiHT)) {

							$ngayhoanthanh = $r[$cauhinh['socot']['ngayhoanthanh']['cot']] ? $r[$cauhinh['socot']['ngayhoanthanh']['cot']] : $r[$cauhinh['socot']['ngaygiaohang']['cot']];
							if ($manvc == "NINJA") {
								if ($r[$cauhinh['socot']['ngaygiaolan3']['cot']]) {
									$ngayhoanthanh = $r[$cauhinh['socot']['ngaygiaolan3']['cot']];
								} else if ($r[$cauhinh['socot']['ngaygiaolan2']['cot']]) {
									$ngayhoanthanh = $r[$cauhinh['socot']['ngaygiaolan2']['cot']];
								} else if ($r[$cauhinh['socot']['ngaygiaolan1']['cot']]) {
									$ngayhoanthanh = $r[$cauhinh['socot']['ngaygiaolan1']['cot']];
								}
							}
							$tt1 = 1;
							if ($r[$cauhinh['socot']['thongtintrahoan']['cot']]) {
								if (in_array($r[$cauhinh['socot']['thongtintrahoan']['cot']], $mangttcuoiHOAN)) {
									$tt1 = 8;
									$tth = -1;
								}
							}
						} else if (in_array($tt1, $mangttcuoiHUY)) {

							if ($tt1 == 'Bồi hoàn' || $tt1 == 'Đã đối soát công nợ trả hàng') {
								if ($r[$cauhinh['socot']['ngaygiaohang']['cot']]) {
									$ngayhoanthanh = $r[$cauhinh['socot']['ngaygiaohang']['cot']];
								} else if ($r[$cauhinh['socot']['ngaytaodon']['cot']]) {
									$ngayhoanthanh = $r[$cauhinh['socot']['ngaytaodon']['cot']];
								} else {
									$ngayhoanthanh = $r[$cauhinh['socot']['ngayhuy']['cot']] ? $r[$cauhinh['socot']['ngayhuy']['cot']] : $r[$cauhinh['socot']['ngayhoanthanh']['cot']];
								}
							} else {
								$ngayhoanthanh = $r[$cauhinh['socot']['ngayhuy']['cot']] ? $r[$cauhinh['socot']['ngayhuy']['cot']] : $r[$cauhinh['socot']['ngayhoanthanh']['cot']];
							}
							if ($manvc == "NINJA") {
								if ($r[$cauhinh['socot']['ngaygiaolan3']['cot']]) {
									$ngayhoanthanh = $r[$cauhinh['socot']['ngaygiaolan3']['cot']];
								} else if ($r[$cauhinh['socot']['ngaygiaolan2']['cot']]) {
									$ngayhoanthanh = $r[$cauhinh['socot']['ngaygiaolan2']['cot']];
								} else if ($r[$cauhinh['socot']['ngaygiaolan1']['cot']]) {
									$ngayhoanthanh = $r[$cauhinh['socot']['ngaygiaolan1']['cot']];
								}
							}
							if (in_array($tt1, $mangttcuoiHOAN)) {
								$tth = -1;
							}
							$tt1 = 8;
						}

						$tt3 = $tt1;
						if ($_SESSION["LoginID"] == 7576) {

							echo "okokoko3" . $tt1 . "<br>";
							echo "ngayhoanthanh" . $ngayhoanthanh . "<br>";
						}
					}



					if ($cauhinh['socot']['giatrihanghoa']['cot']) {

						$gthh = $r[$cauhinh['socot']['giatrihanghoa']['cot']];
						$gthh = str_replace(",", "", $gthh);
						$tongtien = $r[$cauhinh['socot']['tongtien']['cot']];
						$tongtien = str_replace(",", "", $tongtien);
						if ($tongtien < $gthh) {
							$thongbaoloi .= 'Giá trị đơn hàng lớn hơn COD\n';
							//$checkloi=true;
							//$loi=true;
							$mauchu = 'yellow';
						} else {
							//$phithukh=trim($checkvanchuyen['phithukh'])?trim($checkvanchuyen['phithukh']):($tongtien-$gthh);
							$phithukh = (int)($tongtien) - (int)($gthh);
						}


						if (trim($checkvanchuyen['phithukh']) !== trim($phithukh)) {
							//echo $phithukh;
						}
						if ($_SESSION["LoginID"] == 7576) {

							echo "okokoko4" . $tt1 . "<br>";
							echo "ngayhoanthanh" . $ngayhoanthanh . "<br>";
						}
					}






					// || $_SESSION["LoginID"]==7576 ||$_SESSION["LoginID"]==4647
					if (($tt2 != 8 && $tt2 != 1 ) || $_SESSION["LoginID"]==1 ||$_SESSION["LoginID"]==7579) {

						if (trim($phithukh) != '') {
							if ($_SESSION["LoginID"] == 7576  || $_SESSION["LoginID"] == 7579 || $_SESSION["LoginID"] == 4647) {
								if ($mavdtmp) {
									/*	$sql="update vanchuyenonline set dongthoigiantrangthaidon='".$tt1."',ngayhoanthanh='$ngayhoanthanh',loai='$tth',ngaydaydon_dvvc='$ngaydaydon_dvvc' where madoitac='$madoitac' or  mavd='".$mavdtmp."'";*/
								} else {
									if ($ngayhoanthanh) {
										if ($checksobill && $checksobill["ngayhoanthanh"] && $checksobill["ngayhoanthanh"] != '0000-00-00 00:00:00' && $checksobill["ngayhoanthanh"] < $ngayhoanthanh) {

											$sql = "update vanchuyenonline set dongthoigiantrangthaidon='" . $tt3 . "',phithukh='$phithukh',phitravc='" . $r[$cauhinh['socot']['phitravc']['cot']] . "',ngayhoanthanh='$ngayhoanthanh',mavd='" . $r[$cauhinh['socot']['madh']['cot']] . "',madoitac='$madoitac',loai='$tth',ngaydaydon_dvvc='$ngaydaydon_dvvc',donvivc='$donvivc' where madoitac='$madoitac' or  mavd='" . $checkvanchuyen['mavd'] . "'";
										}
										$sql = "update vanchuyenonline set dongthoigiantrangthaidon='" . $tt3 . "',phithukh='$phithukh',phitravc='" . $r[$cauhinh['socot']['phitravc']['cot']] . "',ngayhoanthanh='$ngayhoanthanh',loai='$tth',mavd='" . $r[$cauhinh['socot']['madh']['cot']] . "',madoitac='$madoitac',ngaydaydon_dvvc='$ngaydaydon_dvvc',donvivc='$donvivc' where madoitac='$madoitac' or  mavd='" . $checkvanchuyen['mavd'] . "'";
									} else {
										$sql = "update vanchuyenonline set dongthoigiantrangthaidon='" . $tt3 . "',phithukh='$phithukh',phitravc='" . $r[$cauhinh['socot']['phitravc']['cot']] . "',mavd='" . $r[$cauhinh['socot']['madh']['cot']] . "',loai='$tth',mavd='" . $r[$cauhinh['socot']['madh']['cot']] . "',madoitac='$madoitac',ngaydaydon_dvvc='$ngaydaydon_dvvc',donvivc='$donvivc' where madoitac='$madoitac' or  mavd='" . $checkvanchuyen['mavd'] . "'";
									}
								}
								if ($_SESSION["admintuan"])   echo $sql;
							} else {

								if ($ngayhoanthanh) {
									if ($checksobill && $checksobill["ngayhoanthanh"] && $checksobill["ngayhoanthanh"] != '0000-00-00 00:00:00' && $checksobill["ngayhoanthanh"] < $ngayhoanthanh) {
										$sql = "update vanchuyenonline set dongthoigiantrangthaidon='" . $tt3 . "',phithukh='$phithukh',phitravc='" . $r[$cauhinh['socot']['phitravc']['cot']] . "',ngayhoanthanh='$ngayhoanthanh',mavd='" . $r[$cauhinh['socot']['madh']['cot']] . "',madoitac='$madoitac',loai='$tth',ngaydaydon_dvvc='$ngaydaydon_dvvc',donvivc='$donvivc' where (madoitac='$madoitac' or mavd='" . $checkvanchuyen['mavd'] . "') and (dongthoigiantrangthaidon <> 8 and dongthoigiantrangthaidon <> 1)";
									} else {

										$sql = "update vanchuyenonline set dongthoigiantrangthaidon='" . $tt3 . "',phithukh='$phithukh',phitravc='" . $r[$cauhinh['socot']['phitravc']['cot']] . "',ngayhoanthanh='$ngayhoanthanh',loai='$tth',mavd='" . $r[$cauhinh['socot']['madh']['cot']] . "',madoitac='$madoitac',ngaydaydon_dvvc='$ngaydaydon_dvvc',donvivc='$donvivc' where (madoitac='$madoitac' or mavd='" . $checkvanchuyen['mavd'] . "') and ( dongthoigiantrangthaidon <> 8 and dongthoigiantrangthaidon <> 1)";
									}
								} else {
									$sql = "update vanchuyenonline set dongthoigiantrangthaidon='" . $tt3 . "',phithukh='$phithukh',phitravc='" . $r[$cauhinh['socot']['phitravc']['cot']] . "',mavd='" . $r[$cauhinh['socot']['madh']['cot']] . "',loai='$tth',mavd='" . $r[$cauhinh['socot']['madh']['cot']] . "',madoitac='$madoitac',ngaydaydon_dvvc='$ngaydaydon_dvvc',donvivc='$donvivc' where (madoitac='$madoitac' or  mavd='" . $checkvanchuyen['mavd'] . "') and (dongthoigiantrangthaidon <> 8 and dongthoigiantrangthaidon <> 1)";
								}
							}
							if ($_SESSION["LoginID"] == 7576) {

								echo "okokoko5" . $tt1 . "<br>";
								echo "ngayhoanthanh" . $sql . "<br>";
							}
						} else {
							//echo "adadadawdw ".$tt1;
							if ($mavdtmp) {
								$sql = "update vanchuyenonline set dongthoigiantrangthaidon='" . $tt1 . "',ngayhoanthanh='$ngayhoanthanh',loai='$tth',ngaydaydon_dvvc='$ngaydaydon_dvvc',donvivc='$donvivc' where madoitac='$madoitac' or  mavd='" . $mavdtmp . "'";
							} else {
								if ($ngayhoanthanh) {

									if ($checksobill && $checksobill["ngayhoanthanh"] && $checksobill["ngayhoanthanh"] != '0000-00-00 00:00:00' && $checksobill["ngayhoanthanh"] < $ngayhoanthanh) {
										$sql = "update vanchuyenonline set dongthoigiantrangthaidon='" . $tt3 . "',ngayhoanthanh='$ngayhoanthanh',mavd='" . $r[$cauhinh['socot']['madh']['cot']] . "',madoitac='$madoitac',phitravc='" . $r[$cauhinh['socot']['phitravc']['cot']] . "',loai='$tth',ngaydaydon_dvvc='$ngaydaydon_dvvc',donvivc='$donvivc' where madoitac='$madoitac' or  mavd='" . $checkvanchuyen['mavd'] . "'";
									} else {
										$sql = "update vanchuyenonline set dongthoigiantrangthaidon='" . $tt3 . "',ngayhoanthanh='$ngayhoanthanh',phitravc='" . $r[$cauhinh['socot']['phitravc']['cot']] . "',loai='$tth',mavd='" . $r[$cauhinh['socot']['madh']['cot']] . "',madoitac='$madoitac',ngaydaydon_dvvc='$ngaydaydon_dvvc',donvivc='$donvivc' where  madoitac='$madoitac' or  mavd='" . $checkvanchuyen['mavd'] . "'";
									}
								} else {
									$sql = "update vanchuyenonline set dongthoigiantrangthaidon='" . $tt3 . "',phitravc='" . $r[$cauhinh['socot']['phitravc']['cot']] . "',mavd='" . $r[$cauhinh['socot']['madh']['cot']] . "',madoitac='$madoitac',loai='$tth',mavd='" . $r[$cauhinh['socot']['madh']['cot']] . "',madoitac='$madoitac',ngaydaydon_dvvc='$ngaydaydon_dvvc',donvivc='$donvivc' where madoitac='$madoitac' or  mavd='" . $checkvanchuyen['mavd'] . "'";
								}
							}
						}

						if ($_SESSION["LoginID"] == 7576) {
							echo "sql 2: " . $sql;
						}
					} else {
						if ($_SESSION["LoginID"] == 7576 || $_SESSION["LoginID"] == 7579 ) {
							if ($ngayhoanthanh) {
								$sql = "update vanchuyenonline set dongthoigiantrangthaidon='" . $tt3 . "',ngayhoanthanh='$ngayhoanthanh',phitravc='" . $r[$cauhinh['socot']['phitravc']['cot']] . "' where ID='" . $checkvanchuyen['ID'] . "'";
							}
						}
					}

					if (($tt2 != 8 && $tt2 != 1) || ($_SESSION["LoginID"] == 7576 || $_SESSION["LoginID"] == 7579)) {

						if ($sql) {
							if ($data->query($sql)) {
								$updatesucess++;
							} else {
								$updatefail++;
							}
						}
					} 
					//Hải tự thêm
					/*else if($_SESSION["LoginID"] == 7576 || $_SESSION["LoginID"] == 7579  ) {
						if ($sql) {
							if ($data->query($sql)) {
								$updatesucess++;
							} else {
								$updatefail++;
							}
						}
					}*/

					/*if($checkvanchuyen['madh']!=$r[$cauhinh['socot']['madh']['cot']]){
						$mauchu='red';
						$thongbaoloi.='Mã đơn hàng không trùng\n';
						$checkloi=true;
						$loi=true;
				}
			
				if($checkvanchuyen['tongtien']!=$r[$cauhinh['socot']['tongtien']['cot']]){
						$mauchu='red';
						$thongbaoloi.='Tổng tiền không trùng\n';
						$checkloi=true;
						$loi=true;
				}
				if($checkvanchuyen['phitravc']!=$r[$cauhinh['socot']['phitravc']['cot']]){
						$mauchu='red';
						$thongbaoloi.='phí trả nhà cung cấp không trùng\n';
						$checkloi=true;
						$loi=true;
				}*/
				} else if (!$checksobill && !$checkvanchuyen['ID']) {

					if (substr($r[$cauhinh['socot']['madh']['cot']], -1) == "R") {

						$mavdtmp = rtrim($r[$cauhinh['socot']['madh']['cot']], "R");
						$checkvanchuyen = CheckVanChuyendon($mavdtmp);
						if ($checkvanchuyen["ID"]) {
							$tt1 = 8;
							$tth = -1;
						}
					}
					if ($mavdtmp) {
						$ngayhoanthanh = $r[$cauhinh['socot']['ngayhoanthanh']['cot']] ? $r[$cauhinh['socot']['ngayhoanthanh']['cot']] : $r[$cauhinh['socot']['ngaygiaohang']['cot']];
						if ($manvc == "NINJA") {
							if ($r[$cauhinh['socot']['ngaygiaolan3']['cot']]) {
								$ngayhoanthanh = $r[$cauhinh['socot']['ngaygiaolan3']['cot']];
							} else if ($r[$cauhinh['socot']['ngaygiaolan2']['cot']]) {
								$ngayhoanthanh = $r[$cauhinh['socot']['ngaygiaolan2']['cot']];
							} else if ($r[$cauhinh['socot']['ngaygiaolan1']['cot']]) {
								$ngayhoanthanh = $r[$cauhinh['socot']['ngaygiaolan1']['cot']];
							}
						}
						if ($ngayhoanthanh) {
							$sql = "update  vanchuyenonline set dongthoigiantrangthaidon='" . $tt1 . "',ngayhoanthanh='$ngayhoanthanh',loai='$tth',ngaydaydon_dvvc='$ngaydaydon_dvvc',donvivc='$donvivc' where madoitac='$madoitac' or  mavd='" . $mavdtmp . "'";
						}

						//echo "ngược lại ".$sql;
					} else {
						$checkloi = true;
						$mauchu = '#ffc107';
						$thongbaoloi .= 'Không tồn tại mã đơn hàng trong hệ thống\n';
					}


					if ($sql) {
						if ($data->query($sql)) {
							$updatesucess++;
						} else {
							$updatefail++;
						}
					}
				}
				
				echo $sql."Hải test";
			}
		}
	}
}
$chuoiinsert = rtrim($chuoiinsert, ",");



if ($chuoiinsert) {

	if ($manvc == 'GOPVD') {
		$sql = "
 insert into vanchuyenonline (IDbill,sobill,madh,mavd,madoitac,dongthoigiantrangthaidon,ngayhoanthanh,loai)  values $chuoiinsert ON DUPLICATE KEY UPDATE IDbill=VALUES(IDbill),sobill=VALUES(sobill),madh=VALUES(madh),mavd=VALUES(mavd),madoitac=VALUES(madoitac),dongthoigiantrangthaidon=VALUES(dongthoigiantrangthaidon),ngayhoanthanh=VALUES(ngayhoanthanh)";

		if ($data->query($sql)) {
			echo "<span>Thêm thành công $insertsuccess dòng</span><br/>
					<span>Cập nhật thành công $updatesucess dòng</span><br/>
					<span>Cập nhật Thất bại $updatefail dòng</span><br/>
				";
		}
	} else {
		/*if(insertVanchuyenOnline($chuoiinsert)){
			 
				echo "<span>Thêm thành công $insertsuccess dòng</span><br/>
					<span>Cập nhật thành công $updatesucess dòng</span><br/>
					<span>Cập nhật Thất bại $updatefail dòng</span><br/>
				";
		}*/
	}
} else {

	echo "<span>Thêm thành công $insertsuccess dòng</span><br/>
				<span>Cập nhật thành công $updatesucess dòng</span><br/>
				<span>Cập nhật Thất bại $updatefail dòng</span><br/>
			";
}

$data->closedata();

function checkcuahang($mach)
{
	global $data;
	$sql = "select ID from cuahang where macuahang='$mach'";
	$dong = getdong($sql);
	if ($dong['ID']) {
		return $dong;
	} else {
		return false;
	}
}
function kiemtratontaidulieu($ngaythuchi, $sotien, $lydo, $idkho, $hdbh, $donvi, $sotknh, $tentknh, $donvivc, $mavandon, $manv, $note)
{
	//$sql  = " select ID from thuchikt where ngaythuchi='$ngaythuchi' and sotien='$sotien' and lydo='$lydo' and loaitk='$idkho' and hdbh='$hdbh' and donvi='$donvi' and sotknh='$sotknh' and tentknh='$tentknh' and donvivc='$donvivc' and mavandon='$mavandon' and manv='$manv'    limit 1 ";
	$sql  = " select ID from thuchikt where ngaythuchi='$ngaythuchi' and sotien='$sotien' and lydo='$lydo' and loaitk='$idkho' and note='$note'    limit 1 ";
	//echo $sql."<br>";
	$chan = getdong($sql);
	// echo $sql."<br>---";
	if ($chan['ID']) {
		return false;
	}
	return true;
}


function checksotienhoadon($soct)
{
	$sql = "select sum(DonGia) as tongtiendg,(sum(ceil(a.DonGia*(1-1*a.chietkhau/100))*a.SoLuong)-b.tigia)
  as thanhtien from xuatbanhang a left join phieunhapxuat b on a.IDphieu=b.ID where b.SoCT='$soct' group by a.IDphieu ";
	//$sql="select sum(DonGia) as tongtiendg,floor((sum((DonGia*(1-1*chietkhau/100))*SoLuong)-b.tigia)) as thanhtien from xuatbanhang a left join phieunhapxuat b on a.IDphieu=b.ID where b.SoCT='$soct' group by a.IDphieu ";
	global $data;
	$dong = getdong($sql);
	if ($dong['tongtiendg']) {
		return $dong;
	} else {
		return false;
	}
}
function checkhoadonthuongduyet($hdbh)
{

	$sql = "select a.IDHD as idhd,a.sotien as tienthuong from thuonghoadon a left join phieunhapxuat b on a.IDHD=b.ID where b.SoCT='$hdbh' and a.tinhtrang=44";
	//echo $sql;
	global $data;
	$dong = getdong($sql);
	if ($dong['idhd']) {
		return $dong;
	} else {
		return false;
	}
}
function checktaikhoandinhkhoan($madk)
{

	$sql = "select no,co,loai from dinhkhoanthuchi where ma='$madk'";

	global $data;
	$dong = getdong($sql);
	if ($dong['no'] || $dong['co']) {
		return $dong;
	} else {
		return false;
	}
}



function checknhacungcap($NCC)
{

	$sql = "select ID from nhacungcap where ID=$NCC";

	global $data;
	$dong = getdong($sql);
	if ($dong['ID']) {
		return $dong;
	} else {
		return false;
	}
}
function create_slug($string)
{
	$unicode = array(
		'a' => 'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ',
		'd' => 'đ',
		'e' => 'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',
		'i' => 'í|ì|ỉ|ĩ|ị',
		'o' => 'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',
		'u' => 'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',
		'y' => 'ý|ỳ|ỷ|ỹ|ỵ',
		'A' => 'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
		'D' => 'Đ',
		'E' => 'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
		'I' => 'Í|Ì|Ỉ|Ĩ|Ị',
		'O' => 'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
		'U' => 'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
		'Y' => 'Ý|Ỳ|Ỷ|Ỹ|Ỵ',
	);

	foreach ($unicode as $nonUnicode => $uni) {
		$str = preg_replace("/($uni)/i", $nonUnicode, $str);
	}
	return $str;
}

function checktrunglap($r, $sheettam, $socotkiemtra, $k)
{
	$tam = [];
	$tam2 = [];
	$check = 0;
	for ($i = $k + 1; $i <= count($sheettam); $i++) {
		$checkcount = 0;
		for ($j = 0; $j < $socotkiemtra; $j++) {
			if ($r[$j] == $sheettam[$i][$j]) {
				$checkcount++;
			} else {
				array_push($tam, $sheettam[$i]);
			}
		}

		if ($checkcount == $socotkiemtra) {
			$check++;

			array_push($tam2, $i);
			/*	echo "<pre>";
					var_dump($tam2);
					echo "</pre>";
				*/
		}
	}

	return array("sodong" => $check, "mangmoi" => $tam, "mangindex" => $tam2);
}
function validateDate($date)
{
	if (!$date) {
		return false;
	} else {

		$date = explode("-", $date);
		$year = $date[0];

		$month = $date[1];
		$day = (int)($date[2]);
		/*var_dump(is_numeric($day));	
		echo $day;	*/
		if (is_numeric($year) && is_numeric($month) && is_numeric($day)) {

			return true;
		}
		return false;
	}
	return false;
}
function CheckVanChuyendon($mavd)
{
	global $data, $manvc;
	if (trim($mavd)) {


		$tamvd = explode(".", $mavd);
		$tamvd = $tamvd[count($tamvd) - 1];
		$sql = "SELECT ID,IDbill, mavd, sobill, madh, diachi, tinh, quan, phuong,trigiadon,phitravc,phithukh,tongtien,donvivc,dongthoigiantrangthaidon,ngaydaydon_dvvc from vanchuyenonline where madoitac='$tamvd' or mavd='$mavd'";

		$tam = getdong($sql);
		//var_dump($tam);
		return $tam;
	}
	return;
}


function checkBill($soct)
{
	global  $data;
	$sql = "SELECT a.ID as IDbill,a.SoCT,b.sobill,b.madh,b.mavd,b.tongtien,b.phithukh,b.ngaydaydon_dvvc,b.ngayhoanthanh,b.dongthoigiantrangthaidon from phieunhapxuat a left join vanchuyenonline b on b.IDbill=a.ID where a.SoCT ='$soct' and a.lydo>45 ";
	//   echo $sql;
	$tam = getdong($sql);
	//var_dump($tam);
	return $tam;
}
function dateDiffMi($ngay1, $ngay2)
{
	//echo "ngay2: ".$ngay2."<br/>";
	//echo "ngay1: ".$ngay1;
	$to_time = strtotime($ngay1);
	$from_time = strtotime($ngay2);
	return round(abs($ngay2 - $ngay1) / 60 / 60, 2);
}


function kiemtratrungngay($ngay1, $ngay2)
{
	return (date("d", $ngay1) == date("d", $ngay2)  && date("m", $ngay1) == date("m", $ngay2) && date("Y", $ngay1) == date("Y", $ngay2));
}

function insertVanchuyenOnline($chuoiinsert)
{
	global  $data;
	//echo $chuoiinsert ; 
	$sql = "insert into vanchuyenonline (IDbill,sobill,madh,mavd,tongtien,phitravc,dongthoigiantrangthaidon,ngayhoanthanh,donvivc,madoitac,loai,ngaydaydon_dvvc) values $chuoiinsert  ON DUPLICATE KEY UPDATE madh=VALUES(madh),mavd=VALUES(mavd),tongtien=VALUES(tongtien),phitravc=VALUES(phitravc),dongthoigiantrangthaidon=VALUES(dongthoigiantrangthaidon),ngayhoanthanh=VALUES(ngayhoanthanh) ,donvivc=VALUES(donvivc) ,madoitac=VALUES(madoitac),loai=VALUES(loai)";
	//	echo $sql 
	return $data->query($sql);
}
