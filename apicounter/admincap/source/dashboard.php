    
<?php
//echo date("h:i:s") . "<br>";
  //echo date("F d, Y h:i:s A") . "<br>";
  //echo date("h:i a");
  //$today = date("F j, Y, g:i a");
 // echo date('d/m/Y H:i:s', time() + 7 * 60 * 60);
//$template -> assign("titlePage", "THỐNG KÊ SỐ NGƯỜI VÀO / RA - NGÀY ".date('d/m/Y H:i:s', time() + 7 * 60 * 60));
$template -> assign("titlePage", "THỐNG KÊ SỐ NGƯỜI VÀO / RA");
//$template -> assign("hientai",date("l, F j, Y H:i:s", time() + 7 * 60 * 60));
$template -> assign("hientai","Hiện tại là: ".date('H:i:s', time() + 7 * 60 * 60)." ngày ".date('d/m/Y'));
$hientai = date('Y-m-d');
$json = '{"code":"48YBDNG","date":"'.$hientai.'"}';
$data = json_decode($json,true);
$tk_vao = thongkevao($data);
$template -> assign("demvao",$tk_vao["demvao"]);
$tk_ra = thongkera($data);
$template -> assign("demra",$tk_ra["demra"]);
?>
