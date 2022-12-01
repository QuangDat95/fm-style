<?php
session_start();
define("IN_SITE", "guest");

$root_path = getcwd() . "/";

include_once($root_path . "includes/config.php");
include_once($root_path . "includes/removeUnicode.php");
include_once($root_path . "includes/class.mysql.php");
include_once($root_path . "includes/function.php");
include_once($root_path . "includes/function_local.php");

$idkho = $_SESSION["se_kho"] ;

$data = new class_mysql();
$data->config();
$data->access();

if (isset($_FILES['anhtruoc']) && isset($_POST['soct'])) {

	$allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");
	$filename1 = $_FILES["anhtruoc"]["name"];
	$filetype1 = $_FILES["anhtruoc"]["type"];
	$filesize1 = $_FILES["anhtruoc"]["size"];

	// Xác minh phần mở rộng tệp
	$ext = pathinfo($filename1, PATHINFO_EXTENSION);
	if (!array_key_exists($ext, $allowed)) die("Lỗi: Vui lòng chọn định dạng tệp hợp lệ.");

	// Xác minh kích thước tệp - tối đa 5MB
	$maxsize = 5 * 1024 * 1024;
	if ($filesize1 > $maxsize) die("Lỗi: Kích thước tệp lớn hơn giới hạn cho phép.");

	// Xác minh loại MIME của tệp
	if (in_array($filetype1, $allowed)) {
		// Kiểm tra xem tệp có tồn tại hay không trước khi tải lên
		if (file_exists("images/anhcmnd/" . $_POST['soct'].".jpg")) {
			echo "Ảnh CCCD/CMND của phiếu ".$_POST['soct'] . " đã tồn tại.";
		} else {
			if (move_uploaded_file($_FILES["anhtruoc"]["tmp_name"], "images/anhcmnd/" . $_POST['soct'].".jpg")) { // có thể có lỗi
				echo "Ảnh của bạn đã được tải lên thành công.";
			} else {
				echo "Lỗi: không thể di chuyển tệp";
			}
		}
	} else {
		echo "Lỗi: Đã xảy ra sự cố khi tải tệp của bạn lên. Vui lòng thử lại.";
	}
}
