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

include($root_path . "cauhinhtailenvandonbientrangthai.php");




//$path = $root_path."data/maubanhangpancake.xlsx"  ; 
//var_dump($ql[5]); 
$idk = laso($_SESSION["LoginID"]);
if ($idk == 0) return;
$idkho = $_SESSION["se_kho"];
$data = new class_mysql();
$data->config();
$data->access();

if($_POST['DATA']) {
		
	$sql = "UPDATE vanchuyenonline SET madoitac=SUBSTRING_INDEX(mavd,'.',-1) WHERE SUBSTRING_INDEX(mavd,'.',-1) <> '' AND madoitac IS NULL";
	$data->query($sql);
}
