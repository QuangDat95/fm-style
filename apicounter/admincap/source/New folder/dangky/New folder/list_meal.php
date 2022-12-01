<?php 
	
	$template->assign("ngayhomnay",date("d/m/Y"));
	$ngayoff = "";
	$ngaytao = "2021-11-24 07:30:00";	
	
$data = array(
"Mã phòng ban" => "VP-PM",
"Tên phòng ban" => "IT - Phần mềm",
"Nhân viên" => [
	array("STT" => "1","Họ và tên" => "Nguyễn Anh Tuấn", "Chức danh" => "Giám đốc IT", "Mã nhân viên" => "FM0001", "Giờ vào" => $ngayoff),
	array("STT" => "2","Họ và tên" => "Lê Thị Mỹ Duyên", "Chức danh" => "Admin phần mềm",  "Mã nhân viên" => "FM0703","Giờ vào" => $ngaytao),
	array("STT" => "3","Họ và tên" => "Lê Văn Hải", "Chức danh" => "Lập trình viên", "Mã nhân viên" => "FM0704", "Giờ vào" => $ngaytao),
	array("STT" => "4","Họ và tên" => "Đoàn Tấn Đạt", "Chức danh" => "Lập trình viên",  "Mã nhân viên" => "FM0705","Giờ vào" => $ngaytao),
	array("STT" => "5","Họ và tên" => "Nguyễn Tiến Thuận", "Chức danh" => "Lập trình viên",  "Mã nhân viên" => "FM0896","Giờ vào" => $ngaytao),	
	array("STT" => "6","Họ và tên" => "Thái Viết Hùng", "Chức danh" => "Lập trình viên",  "Mã nhân viên" => "FM2855","Giờ vào" => $ngaytao),
	array("STT" => "7","Họ và tên" => "Nguyễn Hữu Duy", "Chức danh" => "Lập trình viên",  "Mã nhân viên" => "FM2856","Giờ vào" => $ngaytao),
	array("STT" => "8","Họ và tên" => "Dương Kiều Giao", "Chức danh" => "Lập trình viên",  "Mã nhân viên" => "FM2858","Giờ vào" => $ngaytao),
	array("STT" => "9","Họ và tên" => "Võ Thanh Lực", "Chức danh" => "Lập trình viên",  "Mã nhân viên" => "FM3251","Giờ vào" => $ngaytao)
	
	]); 
	//echo $titlePage = "Đăng ký suất ăn ";
	$template -> assign("titlePage", $data["Tên phòng ban"]." - Đăng ký suất ăn ".date("d/m/Y"));
	$template -> assign("tenphongban", $data["Tên phòng ban"]);
	$i = 0;
	foreach ($data["Nhân viên"] as $key => $value) { 
		if (($value["Giờ vào"] != NULL) || ($value["Giờ vào"] != "")) {	$i++;	
			$template -> assign("sothutu", $i);
			$template -> assign("maphongban", $data["Mã phòng ban"]);
			$template -> assign("tennhanvien", $value["Họ và tên"]);
			$template -> assign("chucdanh", $value["Chức danh"]);
			$template -> assign("manhanvien", $value["Mã nhân viên"]);
			$template -> assign("thongtin", $data["Mã phòng ban"]."|".$value["Họ và tên"]."|".$value["Chức danh"]."|".$value["Mã nhân viên"]);
			$template -> parse("main.list_nhanvien");
		} 
		
	}
if (isset($_REQUEST["submit"])) {
	echo "<center>";
	echo $ngaydangky = date("d/m/Y");
	echo $maphongban = $_REQUEST["maphongban"];
	echo $tennhanvien = $_REQUEST["hovaten"];
	echo $chucdanh = $_REQUEST["chucdanh"];
	echo $manhanvien = $_REQUEST["manhanvien"];;
	echo $lunch = $_REQUEST["lunch"];
	echo $dinner = $_REQUEST["dinner"];
}	
?>