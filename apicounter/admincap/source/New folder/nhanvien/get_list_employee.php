<?php
$template -> assign("titlePage", "DANH SÁCH NHÂN VIÊN");
$template -> assign("capnhat", date("d/m/Y"));	
$result = getListEmployee(0); // not 3, 5
$record = unserialize($result);
$i = 0;
foreach ($record as $key => $value) { $i++;
			if (substr($value["MaNV"],0,4) != 'xoa_') {
			$template -> assign("sothutu", $i);
			$template -> assign("idnv", $value["ID"]);
			$template -> assign("maphongban", $value["IDPhong"]);			
			$template -> assign("tennhanvien", $value["Ten"]);
			$template -> assign("chucdanh", $value["ChucVu"]);
			$template -> assign("manhanvien", $value["MaNV"]);
	   		$template -> parse("main.list_nhanvien");
			//saveListEmployee($value["IDPhong"],$value["Ten"],$value["ChucVu"],$value["MaNV"]);
			//saveListEmployee2($value["ID"],$value["IDPhong"],$value["Ten"],$value["ChucVu"],$value["MaNV"]));	
			}
	   }
/*if (isset($_REQUEST["submit"])) {
	foreach ($record as $rows => $row) {
	saveListEmployee($row["IDPhong"], $row["Ten"], $row["ChucVu"], $row["MaNV"]);
	}
	echo 'Lưu dữ liệu thành công!';	
}	else { echo 'Lưu dữ liệu không thành công!'; }*/
?>