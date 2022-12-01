<?php

if (!defined("IN_SITE")) {
	die('Hacking attempt!');
}

$id = $_SESSION["LoginID"];
if ($id != "1") return;

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
if ($_SESSION["loai_user"] == 6 || $_SESSION["se_kho"]  == 1 || $_SESSION["LoginID"] == 1) {
	$template->assign("kho", composx("cuahang", "Name", "ID", " where 1=1 order by ID "));
	$template->assign("tatca", ' <option value="" >Tất cả</option>');
} else
	$template->assign("kho", composx("cuahang", "Name", "ID", " where ID= $_SESSION[se_kho]  order by ID "));


$template->assign("cay", $tam);
$tungay = "01/" . gmdate('m', time() + 7 * 3600) . "/" . gmdate('Y', time() + 7 * 3600);
$denngay = gmdate('d/m/Y', time() + 7 * 3600);
$template->assign("tungay", $denngay);
$template->assign("denngay", $denngay);

$template->parse("main.block_admin");
