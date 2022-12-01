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
include($root_path . "cauhinhtailenvandonluubienpos.php");
$mangposvdluu = json_decode($mangposvd, true);
$mangposvdluu = $mangposvdluu["data"];
include($root_path . "cauhinhtailenvandonbientrangthai.php");
/*$mangttcuoiHT=["Đã đối soát","Bồi hoàn","Đã giao hàng/Chưa đối soát","Giao thành công","Completed","COMPLETED","Đã ký nhận","Phát thành công","Phát hoàn thành công","Đã giao","Đã giao hàng","Đã nhận","Đã xong","Hoàn thành","hoàn thành","delivered"];
$mangttcuoiHUY=["Đã đối soát công nợ trả hàng","Không lấy được hàng","Đã trả","Returned to Sender","Đã chuyển hoàn","Đã hủy","Đã huỷ","Trả hàng/hoàn tiền","Trả hàng hoặc hoàn tiền","Thất lạc & Hư hỏng","Đơn hủy","Đã trả hàng (COD đã trả xong hàng)","Hủy đơn hàng","Cancelled","Xoá gần đây"];
$mangttcuoiHOAN=["Đã đối soát công nợ trả hàng","Đã trả","Returned to Sender"];*/

$idk = laso($_SESSION["LoginID"]);
if ($idk == 0) return;
$idkho = $_SESSION["se_kho"];
$data = new class_mysql();
$data->config();
$data->access();


$tm = $_SESSION["root_path"];
if (isset($_POST['LAYDULIEUPOS'])) {

	$chuoiinsert = '';
	//$_SESSION["mangluuvc"]=[];;
	$data1 = $_POST['LAYDULIEUPOS'];
	$tmp = explode('*@!', $data1);
	$ngaytu = $tmp[0];
	$ngayden = $tmp[1];
	$mavc = $tmp[2];
	$fail = $tmp[3];
	$mavd = trim($tmp[4]);
	$payload = array("ngaytu" => $ngaytu, "ngayden" => $ngayden . " 23:59:00", "mavc" => $mavc, "mavd" => $mavd);
	$curl = curl_init();
	//ghichu : http://103.176.179.46/~ketnoifb goi bang ip phai có user vd: ~ketnoifb // update trinh duyệt
	if ($fail) {
		$url = 'http://103.176.179.46/~ketnoifb/webhook/pancake/pancake.php?type=fail';
	} else {

		$url = 'http://103.176.179.46/~ketnoifb/webhook/pancake/pancake.php?type=order';

		if ($mavc == 'Shopee') {
			$url = 'http://103.176.179.46/~ketnoifb/shopee/shopee_order_api.php?type=order';
		}
		if ($mavc == 'Lazada') {
			$url = 'http://103.176.179.46/~ketnoifb/lazada/laz_order_api.php?type=order';
		}
		if ($mavc == 'pancake') {
			$url = 'http://103.176.179.46/~ketnoifb/webhook/pancake/pancake.php?type=pancakeapi';
			if (!$mavd) {
			}
		}
	}

	curl_setopt_array($curl, array(
		//CURLOPT_URL => 'http://103.126.161.147:81/api',
		CURLOPT_URL => $url,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => '',
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 0,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => 'POST',
		CURLOPT_POSTFIELDS => json_encode($payload),
		CURLOPT_HTTPHEADER => array(
			'Content-Type: application/json'
		),
	));

	$response = curl_exec($curl);

	curl_close($curl);

	$resarr = json_decode($response, true);

	if ($resarr && $resarr['data']) {
		$countupdate = 0;
		$countsuccess = 0;
		$mangposvd = $resarr['data'];
		foreach ($mangposvd as $key => $value) {

			$checkvd = CheckVanChuyendon($value['mavd']);
			$donvivc = $value['donvivc'];
			$mavdtam = explode(".", $value['mavd']);
			$madoitac = $mavdtam[count($mavdtam) - 1];
			$checkbill = [];
			$checkbill = checkBill($value['madh']);
			$ngayhoanthanh = $value['ngaycapnhat'];
			$tinhtrang = '';
			$sobillsua = $value['sobill'];
			$sql = '';
			$ttroot1 = $checkvd['dongthoigiantrangthaidon'];
			$ttroot2 = $checkbill['dongthoigiantrangthaidon'];


			if ($checkvd["ID"]) {
				if ($ttroot1 != 1 && $ttroot1 != 8) {
					$ngaydaydon_dvvc = $checkvd['ngaydaydon_dvvc'] ? $checkvd['ngaydaydon_dvvc'] : gmdate('Y-m-d H:i:s');

					$tt1 = $value['trangthai'];

					$sobill = $checkvd["sobill"];
					$ngayhoanthanh = '';
					$tth = '';

					if (in_array($tt1, $mangttcuoiHT)) {
						$tt1 = 1;
						$ngayhoanthanh = $value['ngaycapnhat'];
					} else if (in_array($tt1, $mangttcuoiHUY)) {
						$tt1 = 8;
						if (in_array($tt1, $mangttcuoiHOAN)) {
							$tth = -1;
						}
						$ngayhoanthanh = $value['ngaycapnhat'];
					}
					$sql = "update vanchuyenonline set madh='" . $value['mavd'] . "',tongtien='" . $value['cod'] . "',phitravc='" . $value['phitravc'] . "',dongthoigiantrangthaidon='" . $tt1 . "',ngayhoanthanh='$ngayhoanthanh',loai='$tth',ngaydaydon_dvvc='$ngaydaydon_dvvc',madoitac='$madoitac',donvivc='$donvivc' where mavd='" . $checkvd["mavd"] . "'";
					//echo "vandon: ".$sql."<br>";
					$countupdate++;
				}
			} else if ($checkbill["sobill"]) {
				if ($ttroot2 != 1 && $ttroot2 != 8) {
					$ngaydaydon_dvvc = $checkbill['ngaydaydon_dvvc'] ? $checkbill['ngaydaydon_dvvc'] : gmdate('Y-m-d H:i:s');
					$tt1 = $value['trangthai'];

					$sobill = $checkbill["sobill"];
					$ngayhoanthanh = '';
					$tth = '';

					if (in_array($tt1, $mangttcuoiHT)) {
						$tt1 = 1;
						$ngayhoanthanh = $value['ngaycapnhat'];
					} else if (in_array($tt1, $mangttcuoiHUY)) {
						$tt1 = 8;
						if (in_array($tt1, $mangttcuoiHOAN)) {
							$tth = -1;
						}
						$ngayhoanthanh = $value['ngaycapnhat'];
					}
					$sql = "update vanchuyenonline set madh='" . $value['mavd'] . "',mavd='" . $value['mavd'] . "',tongtien='" . $value['cod'] . "',phitravc='" . $value['phitravc'] . "',dongthoigiantrangthaidon='" . $tt1 . "',ngayhoanthanh='$ngayhoanthanh',loai='$tth',ngaydaydon_dvvc='$ngaydaydon_dvvc',madoitac='$madoitac',donvivc='$donvivc' where sobill='" . $checkbill["sobill"] . "'";
					//echo "sobill: ".$sql."<br>";
				}
			} else if (!$checkbill["sobill"]  && !$checkvd["ID"]) {

				$ngaydaydon_dvvc = gmdate('Y-m-d H:i:s');

				if ($checkbill["SoCT"]) {
					//(IDbill,sobill,madh,mavd,tongtien,phitravc,dongthoigiantrangthaidon,ngayhoanthanh,donvivc,madoitac,loai,ngaydaydon_dvvc)
					$chuoiinsert .= "('" . $checkbill['IDbill'] . "','" . $checkbill['SoCT'] . "','" . $value['mavd'] . "','" . $value['mavd'] . "','" . $value['cod'] . "','" . $value['phishipvc'] . "','" . $value['trangthai'] . "','','" . $donvivc . "','" . $madoitac . "','','" . $ngaydaydon_dvvc . "'),";
					$countsuccess++;
					//echo "sobill 2: ".$sql."<br>";
				} else {
					$checkbilllan2 = checkBill($sobillsua);
					$ttroot3 = $checkbilllan2['dongthoigiantrangthaidon'];
					if ($ttroot3 != 1 && $ttroot3 != 8) {
						if ($checkbilllan2['sobill']) {

							$ngaydaydon_dvvc = $checkbilllan2['ngaydaydon_dvvc'] ? $checkbilllan2['ngaydaydon_dvvc'] : gmdate('Y-m-d H:i:s');
							$tt1 = $value['trangthai'];

							$sobill = $checkbilllan2["sobill"];
							$ngayhoanthanh = '';
							$tth = '';

							if (in_array($tt1, $mangttcuoiHT)) {
								$tt1 = 1;
								$ngayhoanthanh = $value['ngaycapnhat'];
							} else if (in_array($tt1, $mangttcuoiHUY)) {
								$tt1 = 8;
								if (in_array($tt1, $mangttcuoiHOAN)) {
									$tth = -1;
								}
								$ngayhoanthanh = $value['ngaycapnhat'];
							}
							$sql = "update vanchuyenonline set madh='" . $value['mavd'] . "',mavd='" . $value['mavd'] . "',tongtien='" . $value['cod'] . "',phitravc='" . $value['phitravc'] . "',dongthoigiantrangthaidon='" . $tt1 . "',ngayhoanthanh='$ngayhoanthanh',loai='$tth',ngaydaydon_dvvc='$ngaydaydon_dvvc',donvivc='$donvivc' where sobill='" . $checkbilllan2["sobill"] . "'";
						}
						//echo "sobill 3: ".$sql."<br>";
					} elseif ($checkbilllan2['SoCT']) {
						//(IDbill,sobill,madh,mavd,tongtien,phitravc,dongthoigiantrangthaidon,ngayhoanthanh,donvivc,madoitac,loai,ngaydaydon_dvvc)
						$chuoiinsert .= "('" . $checkbilllan2['IDbill'] . "','" . $checkbilllan2['SoCT'] . "','" . $value['mavd'] . "','" . $value['mavd'] . "','" . $value['cod'] . "','" . $value['phishipvc'] . "','" . $value['trangthai'] . "','','" . $mavc . "','" . $madoitac . "','','" . $ngaydaydon_dvvc . "'),";
						$countsuccess++;
					}
				}
			}

			if ($sql) {

				$update = $data->query($sql);


				if ($update) {
					$countupdate++;
				}
				//echo $countupdate;
			}
		}

		if ($chuoiinsert) {

			$chuoiinsert = rtrim($chuoiinsert, ',');
			if (insertVanchuyenOnline($chuoiinsert)) {

				$thongbao .= '200###Đã thêm thành cônng ' . $countsuccess . ' dòng<br>';
			}
		}


		if ($countupdate && $countupdate > 0) {

			$thongbao .= '200###Đã cập nhật thành công ' . $countupdate . ' dòng!';
		}

		if (!$thongbao) {

			$thongbao .= '201###Không dòng thành công!';
		}
		//in($thongbao);
		//	return;
		echo $thongbao;
	} else {
		echo "201###Không có dữ liệu";
	}
	return;
}
$arrNobill = $_SESSION["NOBILL"];
$arrkhopbill = $_SESSION["KHOPBILL"];
$arrkhopbillvavd = $_SESSION["KHOPBILLVAVD"];
$arrkhopvd = $_SESSION["KHOPVD"];
if (isset($_POST['NOBILL'])) {
	$mangposvd = [];
	$arrNobill = $_SESSION["NOBILL"];
	if ($arrNobill && count($arrNobill) > 0) {
		$mangposvd = $arrNobill;
	}
}
if (isset($_POST['KHOPBILL'])) {
	$mangposvd = [];
	$arrkhopbill = $_SESSION["KHOPBILL"];
	if ($arrkhopbill && count($arrkhopbill) > 0) {
		$mangposvd = $arrkhopbill;
	}
}
if (isset($_POST['KHOPBILLVAVD'])) {
	$mangposvd = [];
	$arrkhopbillvavd = $_SESSION["KHOPBILLVAVD"];
	if ($arrkhopbillvavd && count($arrkhopbillvavd) > 0) {
		$mangposvd = $arrkhopbillvavd;
	}
	//in($arrkhopbillvavd);
}
if (isset($_POST['KHOPVD'])) {
	$mangposvd = [];
	$arrkhopvd = $_SESSION["KHOPVD"];
	if ($arrkhopvd && count($arrkhopvd) > 0) {
		$mangposvd = $arrkhopvd;
	}
}

if (isset($_POST['DATALOI'])) {
	$arrNobill = [];
	$arrkhopbill = [];
	$arrkhopbillvavd = [];
	$arrkhopvd = [];
	//$_SESSION["mangluuvc"]=[];;
	$data1 = $_POST['DATALOI'];
	$tmp = explode('*@!', $data1);
	$ngaytu = $tmp[0];
	$ngayden = $tmp[1];
	$mavc = $tmp[2];
	$mavd = trim($tmp[3]);
	$payload = array("ngaytu" => $ngaytu, "ngayden" => $ngayden . " 23:59:00", "mavc" => $mavc, "mavd" => $mavd);
	$curl = curl_init();

	$url = 'http://103.176.179.46/~ketnoifb/webhook/pancake/pancake.php?type=fail';

	/*if($mavc=='Shopee'){
				$url='http://103.176.179.46/~ketnoifb/shopee/shopee_order_api.php?type=order';
			}
			if($mavc=='Lazada'){
				$url='http://103.176.179.46/~ketnoifb/lazada/laz_order_api.php?type=order';
			}*/
	//ghichu : http://103.176.179.46/~ketnoifb goi bang ip phai có user vd: ~ketnoifb // update trinh duyệt
	curl_setopt_array($curl, array(
		//CURLOPT_URL => 'http://103.126.161.147:81/api',
		CURLOPT_URL => $url,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => '',
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 0,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => 'POST',
		CURLOPT_POSTFIELDS => json_encode($payload),
		CURLOPT_HTTPHEADER => array(
			'Content-Type: application/json'
		),
	));

	$response = curl_exec($curl);
	//in($response);
	curl_close($curl);


	$resarr = json_decode($response, true);

	if ($resarr["code"] == 200) {
		if ($resarr['data']) {
			/*	$tamp.="\$mangposvd='".$response."';";
					$filename=getcwd()."/cauhinhtailenvandonluubienpos.php";
					if(file_exists($filename))
					{
							$chuoimoi="<?php ".$tamp." ?>";
							file_put_contents($filename,$chuoimoi);
							
							
					}*/
			$mangposvd = $resarr['data'];
		} else {
			echo "<h1 style='text-align:center;color:#f44336'>" . $resarr["message"] . "</h1>";
			return;
		}
	} else {

		echo "<h1 style='text-align:center;color:#f44336'>" . $resarr["message"] . "</h1>";
		return;
	}
}


if (isset($_POST['DATA'])) {
	$arrNobill = [];
	$arrkhopbill = [];
	$arrkhopbillvavd = [];
	$arrkhopvd = [];
	//$_SESSION["mangluuvc"]=[];;
	$data1 = $_POST['DATA'];
	$tmp = explode('*@!', $data1);
	$ngaytu = $tmp[0];
	$ngayden = $tmp[1];
	$mavc = $tmp[2];
	$mavd = trim($tmp[3]);
	$payload = array("ngaytu" => $ngaytu. " 00:00:00", "ngayden" => $ngayden . " 08:00:00", "mavc" => $mavc, "mavd" => $mavd);
	$curl = curl_init();

	$url = 'http://103.176.179.46/~ketnoifb/webhook/pancake/pancake.php?type=order';

	if ($mavc == 'Shopee') {
		$url = 'http://103.176.179.46/~ketnoifb/shopee/shopee_order_api.php?type=order';
	}
	if ($mavc == 'Lazada') {
		$url = 'http://103.176.179.46/~ketnoifb/lazada/laz_order_api.php?type=order';
	}

	if ($mavc == 'pancake') {
		$url = 'http://103.176.179.46/~ketnoifb/webhook/pancake/pancake.php?type=pancakeapi';
		if (!$mavd) {
			echo "<h1 style='text-align:center;color:#f44336'>Vui lòng nhập mã vận đơn </br> <span style='font-size:14px'>đối với tải về từ pancake chỉ tìm theo mã vận đơn</span></h1>";
			return;
		}
	}

	//ghichu : http://103.176.179.46/~ketnoifb goi bang ip phai có user vd: ~ketnoifb // update trinh duyệt
	curl_setopt_array($curl, array(
		//CURLOPT_URL => 'http://103.126.161.147:81/api',
		CURLOPT_URL => $url,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => '',
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 0,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => 'POST',
		CURLOPT_POSTFIELDS => json_encode($payload),
		CURLOPT_HTTPHEADER => array(
			'Content-Type: application/json'
		),
	));

	$response = curl_exec($curl);

	curl_close($curl);

	echo $response;
	$resarr = json_decode($response, true);

	if ($resarr["code"] == 200) {
		if ($resarr['data']) {
			/*	$tamp.="\$mangposvd='".$response."';";
					$filename=getcwd()."/cauhinhtailenvandonluubienpos.php";
					if(file_exists($filename))
					{
							$chuoimoi="<?php ".$tamp." ?>";
							file_put_contents($filename,$chuoimoi);
							
							
					}*/
			$mangposvd = $resarr['data'];
		} else {
			echo "<h1 style='text-align:center;color:#f44336'>" . $resarr["message"] . "</h1>";
			return;
		}
	} else {

		echo "<h1 style='text-align:center;color:#f44336'>" . $resarr["message"] . "</h1>";
		return;
	}
}

?>
<style>
	.notifi {
		position: fixed;
		top: 100px;
		animation: notification 0.4s linear;
		left: 50%;
		background-color: #ffffff;
		padding: 10px 30px;
		font-weight: bold;
		box-shadow: 1px 1px 5px #e2e2e2;
	}

	@keyframes notification {
		0% {
			opacity: 0;
			top: 0px;
		}

		100% {
			opacity: 1;
			top: 100px;
		}
	}
</style>
<!--	<div style="padding-bottom: 10px;
    padding-left: 20px;
    display: flex;
    align-items: center;"><button type="button" style="    background-color: #f44336;
    padding: 3px 5px;
    color: #ffffff;
    border-radius: 3px;
    border: none;" id="" name=""  onclick="GetVandonPosNoBill()" value="">Lọc các dòng không có số bill</button> </div>	-->

<div style="    display: flex;
    flex-direction: column;
    width: 35%;"><span style="color:blue;cursor:pointer" onclick="GetVandonPosNoBill('KHOPBILL')">(*) Dòng màu xanh dương: khớp số bill không khớp vận đơn (PM)</span>
	<span style="color:green;cursor:pointer" onclick="GetVandonPosNoBill('KHOPVD')">(*) Dòng màu lá: khớp vận đơn không khớp Số bill (PM)</span>
	<span style="color:#ff9800;cursor:pointer" onclick="GetVandonPosNoBill('KHOPBILLVAVD')">(*) Dòng màu cam: khớp vận đơn và khớp Số bill (PM)</span>
	<span style="color:red;cursor:pointer" onclick="GetVandonPosNoBill('NOBILL')">(*) Dòng đỏ: không khớp vận đơn và không khớp Số bill (PM)</span>
	<!--<span style="color:#9c27b0;cursor:pointer"  onclick="GetVandonPosNoBill('ALL')">(*) Tất cả</span>-->
</div>
<?php if ($mangposvd && count($mangposvd) > 0) {

?>
	<div style="overflow:scroll;height:450px">
		<table id="tbex" width="100%" border="0" cellpadding="0" cellspacing="0" style="background:#FFF;" class="tbchuan">

			<tr bgcolor="#F8E4CB" style="position: sticky;top: 0px;">

				<td align="left" style="">
					<span>STT</span>
				</td>
				<td align="left" style="">
					<span>Mã vận đơn</span>

				</td>
				<td align="left" style="">
					<span>Mã đơn hàng</span>

				</td>
				<td align="left" style="">
					<span>Số bill</span>

				</td>
				<td align="left" style="">
					<span>Tình trạng mới</span>

				</td>
				<td align="left" style="">
					<span>Tình trạng cũ (Phần mềm)</span>

				</td>
				<td align="left" style="">
					<span>Nhà vận chuyển</span>

				</td>
				<td align="left" style="">
					<span>Phí COD</span>

				</td>
				<td align="left" style="">
					<span>Phí ship NVC</span>

				</td>
				<td align="left" style="">
					<span>Phí ship tính</span>

				</td>
				<td align="left" style="">
					<span>Ngày tạo đơn</span>

				</td>
				<td align="left" style="">
					<span>Ngày Cập nhật trạng thái</span>

				</td>
			</tr>
			<?php
			$r = 0;

			//in($mangposvd);

			foreach ($mangposvd  as $key => $value) {
				$r++;
				$mau = '';
				$checkvd = CheckVanChuyendon($value['mavd']);
				$checkbill = [];
				$checkbill = checkBill($value['madh']);
				//in($checkbill);$arrNobill=[];
				$mau = 'red';
				$sobillsua = $value['sobill'];
				$sobill = '';
				$tinhtrang = '';
				if ($checkbill["sobill"]  && $checkvd["ID"]) {
					$sobill = $checkbill["sobill"];
					$mau = '#ff9800';
					if ($checkvd["dongthoigiantrangthaidon"]) {
						if ($checkvd["dongthoigiantrangthaidon"] == 1) {
							$tinhtrang = 'Đã xong';
							$mau = '#9e9e9e';
						} else if ($checkvd["dongthoigiantrangthaidon"] == 8 && $checkvd["loai"] == -1) {
							$tinhtrang = 'Đơn hoàn';
							$mau = '#9e9e9e';
						} else if ($checkvd["dongthoigiantrangthaidon"] == 8) {
							$tinhtrang = 'Đơn hủy';
							$mau = '#9e9e9e';
						} else if (!$tinhtrang) {
							$tinhtrang = $checkvd["dongthoigiantrangthaidon"];
						}
					}


					if ($_POST['DATA']) array_push($arrkhopbillvavd, $value);
				} else if ($checkvd["ID"]) {
					$mau = 'green';
					$sobill = $checkvd["sobill"];
					if ($checkvd["dongthoigiantrangthaidon"]) {
						if ($checkvd["dongthoigiantrangthaidon"] == 1) {
							$tinhtrang = 'Đã xong';
							$mau = '#9e9e9e';
						} else if ($checkvd["dongthoigiantrangthaidon"] == 8 && $checkvd["loai"] == -1) {
							$tinhtrang = 'Đơn hoàn';
							$mau = '#9e9e9e';
						} else if ($checkvd["dongthoigiantrangthaidon"] == 8) {
							$tinhtrang = 'Đơn hủy';
							$mau = '#9e9e9e';
						} else if (!$tinhtrang) {
							$tinhtrang = $checkvd["dongthoigiantrangthaidon"];
						}
					}

					if ($_POST['DATA']) array_push($arrkhopvd, $value);
				} else if ($checkbill["sobill"]) {
					$sobill = $checkbill["sobill"];
					$mau = 'blue';
					if ($checkbill["dongthoigiantrangthaidon"]) {
						if ($checkbill["dongthoigiantrangthaidon"] == 1) {
							$tinhtrang = 'Đã xong';
							$mau = '#9e9e9e';
						} else if ($checkbill["dongthoigiantrangthaidon"] == 8 && $checkbill["loai"] == -1) {
							$tinhtrang = 'Đơn hoàn';
							$mau = '#9e9e9e';
						} else if ($checkbill["dongthoigiantrangthaidon"] == 8) {
							$tinhtrang = 'Đơn hủy';
							$mau = '#9e9e9e';
						} else if (!$tinhtrang) {
							$tinhtrang = $checkbill["dongthoigiantrangthaidon"];
						}
					}
					if ($_POST['DATA']) array_push($arrkhopbill, $value);
				} else if ($checkbill["SoCT"]) {
					$sobill = $checkbill["sobill"];
					$mau = 'blue';
					if ($_POST['DATA']) array_push($arrkhopbill, $value);
				} else {
					$checksobilllan2 = checkBill($sobillsua);
					$mauinput = '#000000';

					if ($checksobilllan2["sobill"] || $checksobilllan2["SoCT"]) {
						$mauinput = '#2196f3';

						//$sobill=$checksobilllan2["sobill"]?$checksobilllan2["sobill"]:$checksobilllan2["SoCT"];
					} else {

						if ($_POST['DATA']) array_push($arrNobill, $value);
					}
				}




			?>
				<tr style="color:<?php echo $mau; ?>">

					<td align="left" style="">
						<span><?php echo $r ?></span>
					</td>
					<td align="left" style="">
						<span><?php echo $value['mavd']; ?></span>

					</td>

					<td align="left" style="">
						<span><?php echo $value['madh'] ?></span>
					</td>
					<?php
					if ($sobill) {

					?>
						<td align="left" style="">
							<span><?php echo $sobill; ?></span>

						</td>

					<?php

					} else {

					?>
						<td align="left" style="">
							<span><input type="text" id="<?php echo "bill_" . $r; ?>" value="<?php echo $sobillsua; ?>" style="color:<?php echo $mauinput; ?>;border-color:<?php echo $mauinput; ?>" onchange="updateSobillpos(event,'<?php echo $value["ID"]; ?>','<?php echo $mavc; ?>');" /></span>

						</td>

					<?php

					}

					?>

					<td align="left" style="">
						<span><?php echo $value['trangthai']; ?></span>
					</td>
					<td align="left" style="">
						<span><?php echo $tinhtrang; ?></span>
					</td>
					<td align="left" style="">
						<span><?php echo $mavc; ?></span>

					</td>
					<td align="left" style="">
						<span><?php echo number_format($value['cod']); ?></span>

					</td>
					<td align="left" style="">
						<span><?php echo $value['phishipvc']; ?></span>
					</td>
					<td align="left" style="">
						<span><?php echo $value['giatridon'] ? number_format($value['cod'] - $value['giatridon']) : ""; ?></span>
					</td>
					<td align="left" style="">
						<span><?php echo $value['ngaytao'] ? $value['ngaytao'] : ""; ?></span>
					</td>
					<td align="left" style="">
						<span><?php echo $value['ngaycapnhat'] ? $value['ngaycapnhat'] : ""; ?></span>
					</td>
				</tr>
			<?php
			}


			?>

		</table>

	</div>
<?php

} else {
	echo $resarr['message'] ? "<h1 style='text-align:center;color:#f44336'>" . $resarr['message'] . "</h1>" : "<h1 style='text-align:center;color:#f44336'>Không có dữ liệu</h1>";
	return;
}

?>
<div class="" style="    display: flex;
    justify-content: space-between;"><span>Tổng: <?php echo $r; ?> dòng</span><span style="color:#FF0000;font-style:italic">(*) chỉ update các dòng mày xanh lá,màu vàng và thêm mới các dòng màu xanh dương</span></div>
<div style="    padding-bottom: 10px;
    padding-left: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    height: 60px;"><input type="button" style="    background-color: #ff9800;
    padding: 3px 5px;
    color: #ffffff;
    border-radius: 3px;
    border: none;" id="dulieue" name="dulieue" onclick="laydulieupos()" value="Lấy dữ liệu" />
	<div id="loading__" style="margin-left:5px;display:none"><img src="images/loading.gif" /> chờ xíu...</div>
	<div id="khonghienthi" style="display:none"></div>
</div>
<?php

//style="display:none"

$_SESSION["NOBILL"] = $arrNobill;

$_SESSION["KHOPBILL"] = $arrkhopbill;
$_SESSION["KHOPBILLVAVD"] = $arrkhopbillvavd;

$_SESSION["KHOPVD"] = $arrkhopvd;

$data->closedata();


function callAPInoibo($method, $url, $data)
{
	$agent = 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1; .NET CLR 1.0.3705; .NET CLR 1.1.4322)';
	$curl = curl_init();
	curl_setopt_array($curl, array(
		CURLOPT_URL => $url,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => '',
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 0,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_CUSTOMREQUEST => $method,
		CURLOPT_SSL_VERIFYPEER => false,

		//CURLOPT_SSLVERSION=>2,
		CURLOPT_VERBOSE => true,
		//CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		//CURLOPT_USERAGENT => $agent,
		CURLOPT_POSTFIELDS => json_encode($data),
		CURLOPT_HTTPHEADER => array(
			'Content-Type: application/json',
			'Cookie: sb=7yC7YPRdvUTACsPMzGr1Z0iH'
		),
	));

	$response = curl_exec($curl);
	in($curl);
	in(curl_error($curl));
	curl_close($curl);
	return json_decode($response, true);
}
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

		$tamvd = $mavd;
		if ($manvc == 'GHTK') {
			$tamvd = explode(".", $mavd);
			$tamvd = $tamvd[count($tamvd) - 1];
		}
		$sql = "SELECT ID,IDbill, mavd, sobill, madh, diachi, tinh, quan, phuong,trigiadon,phitravc,phithukh,tongtien,donvivc,dongthoigiantrangthaidon,ngaydaydon_dvvc from vanchuyenonline where madoitac='$tamvd' or mavd='$tamvd'";

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
	//echo $sql;
	return $data->query($sql);
}
?>