<?php

$curl = curl_init();

$datas = array(
	"baomat" => "!@92cffe4a34ccc4f9c6ec755843593458b",
	"filter" => array(
		"loaibaocao" => 1, // 1 = kho chi tiết, 2 = báo cáo gộp
		"tu" => "14/05/2022", //thời gian tìm kiếm
		"den" => "14/05/2022", // Thời gian tìm kiếm
		"loai" => -9, //Các loại phiếu bán hàng - Team Tiktok/Team Online...
		"trang" => 1, // Số trang của dữ liệu, vd như tổng dữ liệu có 3 trang thì nhập từ 1 đến 3
		// "masp" => "", //Mã SP
		// "tensp" => "", //Tên SP
		// "nangcao" => "", // Boolean True | False
		// "nhom" => "", // Nhóm sản phẩm
		// "kho" => "", //Cửa hàng
		// "manv" => "", // Mã nhân viên
		// "mota" => "" , // Mô tả sản phẩm
		// "CK" => "", //Chiết khấu
		// "nganhhang" => "", // Ngành hàng
		// "IDNV" => "", // ID Nhân viên
		// "ghichu" => "", // Ghi chú
	)
);

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://siandchip.vn/app/api/baocaosiandchip.php?type=thongtinkho',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => json_encode($datas),
  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/json',
    'Cookie: PHPSESSID=7d25vvhiott0nhjikomfnagcg3'
  ),
));

$response = curl_exec($curl);

curl_close($curl);

echo "<pre>";
var_dump( json_decode($response));
echo "</pre>";