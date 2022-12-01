<meta charset="utf-8">
<?php

include($root_path."includes/class.mysql.php");
include($root_path."includes/config.php");
include($root_path."includes/function.php");

$json = file_get_contents("php://input");

$headers = getallheaders();
$author = $headers['Authorization']; //header authorization của shopee
   
$data = new class_mysql();
$data->config();
$data->access();

$author_temp = hash_hmac("sha256", "FMSTYLE.COM.VN@123", "FMSTYLE.COM.VN@2012");

if($author == $author_temp) {
	$json = json_decode($json, true);
	$user_phone = $json['employ_phone'];
	$user_id = $json['user_id'];
	if(isset($use_phone)) {
		$sql = "Select * from userac where SoDienThoai like '%$user_phone%' limit 1";
		$res = getdong($sql);

		$response = array(
			"employee_code" => $res['MaNV'],
			"employee_name" => $res['Ten'],
			"employee_birthday" => $res['NgaySinh'],
			"employee_date_working" => $res['NgayVaoLam'],
			"employee_phone" => $res['SoDienThoai']
		);

		echo json_encode($response,JSON_UNESCAPED_UNICODE);
	}
}