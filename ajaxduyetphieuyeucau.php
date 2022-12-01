<?php
$root_path = getcwd() . "/";
include($root_path . "biensession.php");
include($root_path . "includes/config.php");
include($root_path . "includes/removeUnicode.php");
// include($root_path . "includes/class.paging.php");
include($root_path . "includes/class.mysql.php");
include($root_path . "includes/function.php");
// include($root_path . "includes/function_local.php");

$IDK = $_SESSION["LoginID"];
$cuahang = $_SESSION["se_kho"];
$quyen = $_SESSION["quyen"];
// $ql = $quyen[$_SESSION["mangquyenid"]["capnhaptuvan"]];
// if (!($ql[0] == 1 || $IDK == 1)) {
//       return;
// }


$data = new class_mysql();
$data->config();
$data->access();

$data1 = $_POST['DATA'];
$tmp = explode('*@!', $data1);

$duyetvalue = trim($tmp[0]);
$lydo = $tmp[1];
$id = $tmp[2];

$select = "Select * from taoyeucau where ID = $id";
$row = getdong($select);
if(empty($row['daduyet']) && empty($row['lydo'])) {
      $daduyet = array($IDK => $duyetvalue);
      $lydodaco = array($IDK => $lydo);
} else {
      $daduyet = json_decode($row['daduyet'],true);
      $lydodaco = json_decode($row['lydo'],true);

      $daduyet[$IDK] = $duyetvalue;
      $lydodaco[$IDK] = $lydo;
}

if($duyetvalue === 0) {
      $sql = "update taoyeucau set daduyet = '".json_encode($daduyet)."' , lydo = '".json_encode($lydodaco)."'   where ID = $id";
} else {
      $sql = "update taoyeucau set daduyet = '".json_encode($daduyet)."' where ID = $id";
}
$data->query($sql);

$chuoitrave = "###";
$sqll = "Select * from userac where ID =$IDK" ;
$re = getdong($sqll);
if($daduyet[$IDK] == 1) {
      $chuoitrave .= "$re[Ten] đã duyệt";
} else {
      $chuoitrave .= "$re[Ten] không duyệt";
}

$chuoitrave .= "###$id";
echo $chuoitrave;
$data->closedata();
