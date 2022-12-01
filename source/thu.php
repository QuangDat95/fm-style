<?php

// include ".fm/includes/xlsxwriter.class.php");

include_once("../includes/xlsxwriter.class.php");

$writer = new XLSXWriter();

$styles1 = array('fill'=>'#f1ce25', 'color'=>'#ff1212');
$styleborder = array('color'=>'#ffffff', 'fill'=>'#e07b22');
$stylefooter = array("font-style"=>"bold","halign"=>"center",'border'=>'left,right,top,bottom',"border-style" => "thin");
$sheet_name = 'Sheet1';
$writer->writeSheetHeader(
    'Sheet1',
    array(
        "STT" => "integer", "Tên CH" => "string", "Tổng Hoá Đơn" => "string",
        "Lượng Khách" => "string", "string", "string",
        "Tỷ Lệ" => "string", "string", "string",
        "Tỷ Lệ Đăng Ký Thành Viên" => "string",
    ),
    $styles1
);

// $writer->writeSheetRow('Sheet1', $m );// Header
$m = array(
    "", "", "",
    "Khách Cũ", "Khách mới (chỉ tính các khách tạo mới có ngày sinh)", "Khách lẻ",
    "Khách Cũ", "Khách mới (chỉ tính các khách tạo mới có ngày sinh)", "Khách lẻ",
    ""
);
$writer->writeSheetRow('Sheet1', $m, $styleborder);

$writer->markMergedCell($sheet_name, $start_row = 0, $start_col = 0, $end_row = 1, $end_col = 0);
$writer->markMergedCell($sheet_name, $start_row = 0, $start_col = 1, $end_row = 1, $end_col = 1);
$writer->markMergedCell($sheet_name, $start_row = 0, $start_col = 2, $end_row = 1, $end_col = 2);

$writer->markMergedCell($sheet_name, $start_row = 0, $start_col = 3, $end_row = 0, $end_col = 5);
$writer->markMergedCell($sheet_name, $start_row = 0, $start_col = 6, $end_row = 0, $end_col = 8);

$writer->markMergedCell($sheet_name, $start_row = 0, $start_col = 9, $end_row = 1, $end_col = 9);

// $writer->writeSheetRow('Sheet1', $m);

$writer->writeToFile('thu.xlsx');
echo "  tải về click vào đây  <strong><a href='thu.xlsx' target='_blank'> ( Tải về ) </a></strong>";

return;
