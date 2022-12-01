<?php
session_start();
if (!defined("IN_SITE")) {
	die('Hacking attempt!');
}

//   HTCayThuMuc($IDGrouptk ) ;
$template->assign("cay", $tam);
$thang = gmdate('m', time() + 7 * 3600);
$nam = gmdate('Y', time() + 7 * 3600);
$namt = $nam - 1;
for ($i = 1; $i <= 12; $i++) {
	if ($i <= $thang) {
		if ($i < 10) {
			$namthang = "$nam-0$i";
			$thangnam = "Tháng 0$i/$nam";
		} else {
			$namthang = "$nam-$i";
			$thangnam = "Tháng $i/$nam";
		}
	} else {
		if ($i < 10) {
			$namthang = "$namt-0$i";
			$thangnam = "Tháng 0$i/$namt";
		} else {
			$namthang = "$namt-$i";
			$thangnam = "Tháng $i/$namt";
		}
	}

	$template->assign("namthang", $namthang);
	$template->assign("thangnam", $thangnam);
	$template->parse("main.block_proht1.block_thangnam");
	$template->parse("main.block_proht1.block_thangnam1");
}

$tungay = "01/" . gmdate('m', time() + 7 * 3600) . "/" . gmdate('Y', time() + 7 * 3600);
$denngay = gmdate('d/m/Y', time() + 7 * 3600);
$template->assign("tungay", $tungay);
$template->assign("denngay", $denngay);
$template->assign("kho", composx("cuahang", "Name", "ID", " where 1=1 order by ID "));
$template->assign("kh_chucvu", composx("kh_chucvu", "Name", "ID", ""));
$template->parse("main.block_proht1");



function HTmuccon($idvao, $muccon, $group)
{
	global $data, $tam, $kt;
	$kt = $muccon;
	$sele = "selected";

	$sql = 	"select * from groupproduct where  ID <> 1 and IDGroup = '0" . $idvao . "'  order by ID";
	$result = $data->query($sql);
	$result_rows = $data->num_rows($result);
	if ($result_rows > 0) {
		$kt = $kt + 1;
	}
	$SOST = 0;
	$result = $data->query($sql);
	while ($result_news = $data->fetch_array($result)) {
		$sss = "" . $result_news["ID"];
		if ($group == $sss) {
			$tam  = $tam . "<option  value='" . $result_news["ID"] . "'  $sele >";
		} else {
			$tam  = $tam . "<option value='" . $result_news["ID"] . "'>";
		}
		for ($i = 1; $i <= $kt; $i++) {
			$tam  = $tam . "&nbsp;&nbsp;&nbsp;&nbsp;";
		}
		$tam  = $tam . $result_news["Name"] . "</option>\n";
		HTmuccon($result_news["ID"], $kt, $group);
	}
}
//=======================================================

//============================================================
