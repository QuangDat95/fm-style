<?php
// test code: test.1084.459, test.1084.460, test.1084.461
/*$order = <<<HTTP_BODY
{
    "products": [{
        "name": "test",
        "weight": 0.1,
        "quantity": 1,
        "product_code": "test.1084.561"
    },
    {
        "name": "tẩy",
        "weight": 0.2,
        "quantity": 1,
        "product_code": ""
    }],
    "order": {
        "id": "a1",
        "pick_name": "HCM-nội thành",
        "pick_address": "590 CMT8 P.11",
        "pick_province": "TP. Hồ Chí Minh",
        "pick_district": "Quận 3",
        "pick_ward": "Phường 1",
        "pick_tel": "0911222333",
        "tel": "0905112113",
        "name": "GHTK - HCM - Noi Thanh",
        "address": "123 nguyễn chí thanh",
        "province": "TP. Hồ Chí Minh",
        "district": "Quận 1",
        "ward": "Phường Bến Nghé",
        "hamlet": "Khác",
        "is_freeship": "1",
        "pick_date": "2016-09-30",
        "pick_money": 47000,
        "note": "Khối lượng tính cước tối đa: 1.00 kg",
        "value": 3000000,
        "transport": "fly",
        "pick_option":"cod",      
        "deliver_option" : "xteam",  
        "pick_session" : 2,
        "tags": [ 1]
    }
}
HTTP_BODY;*/
/*
 $order=array(
  "products"=>array(
  array(
      "name"=>"Thun nữ TD cổ tròn London Borough Market_Đen",
      "weight"=>0.5,
      "quantity"=>"2",
      "product_code"=>"210925158",
    ),
  ),
  "order"=>
  array(
    "id"=>"B2201A.1064.8528",
    "tel"=>"0967249254",
    "name"=>"GHTK - HCM - Noi Thanh",
    "address"=> "123 nguyễn chí thanh",
    "province"=> "TP. Hồ Chí Minh",
    "district"=> "Quận 1",
    "ward"=>"Phường Bến Nghé",
    "pick_name"=>"HCM-nội thành",
    "pick_address"=>"590 CMT8 P.11",
    "pick_province"=> "TP. Hồ Chí Minh",
    "pick_district"=> "Quận 3",
    "pick_ward"=>'Phường 1',
    "pick_tel"=>"0793854109",
    "note"=>'Khối lượng tính cước tối đa: 1.00 kg',
    "hamlet"=> "khác",
    "is_freeship"=>"1",
    "pick_money"=>178000,
    "value"=>3000000,
    "tags"=> array(1)
  ),
);*/


 $order=array(
  "products"=>array(
  array(
      "name"=>"Thun nữ TD cổ tròn London Borough Market_Đen",
      "weight"=>0.5,
      "quantity"=>"2",
      "product_code"=>"210925158",
    ),
  ),
  "order"=>
  array(
    "id"=>"B2201A.1064.8529",
    "tel"=>"0967249254",
    "name"=>"Thu Hien Nguyen",
    "address"=> "Số nhà:218s/4",
    "province"=> "Tỉnh Đồng Nai",
    "district"=> "TP. Biên Hòa",
    "ward"=>"Phường Tân Biên",
    "pick_name"=>"Tổng kho",
    "pick_address"=>"64/34 Trần Cao Vân",
    "pick_province"=> "TP.Đà Nẵng",
    "pick_district"=> "Quận Hải Châu",
    "pick_ward"=>'Xã hòa sơn',
    "pick_tel"=>"0793854109",
    "note"=>'',
    "hamlet"=> "khác",
    "is_freeship"=>"1",
    "pick_money"=>178000,
    "value"=>3000000,
    "tags"=> array(1)
  ),
);
echo "<pre>";
var_dump($order);
echo "</pre>";
 $order=json_encode($order);
 
$curl = curl_init();

curl_setopt_array($curl, array(
    //CURLOPT_URL => "https://services.giaohangtietkiem.vn/services/shipment/order",
	CURLOPT_URL => "https://services.ghtklab.com/services/shipment/order",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => $order,
    CURLOPT_HTTPHEADER => array(
        "Content-Type: application/json",
        "Token: 187c69cA1c3d49fE1B43573b335d67a7481e7181",
        "Content-Length: " . strlen($order),
    ),
));

$response = curl_exec($curl);
curl_close($curl);

$arr = json_decode($response,true);
var_dump($arr);
//echo 'Response: ' . $response;
if (isset($arr["error"])) {
echo "<B>THÔNG BÁO</B>: Mã đơn vận: <B>".$arr["error"]["ghtk_label"]."</B> ===> Lỗi ===> ".$arr["message"];
}

if ($arr["success"] == 1) {
echo "Mã vận đơn được tạo: <B>".$arr["order"]["label"]."</B>";
}
//echo "<pre>";
//print_r($arr);
//echo "</pre>";
?>
<!--
Array
(
    [success] => 1
    [message] => Các đơn hàng đã được add vào hệ thống GHTK thành công. Thông tin đơn hàng thành công được trả về trong trường success_orders.
 GHTK chỉ hỗ trợ chọn phương thức vận chuyển với các đơn hàng đặc biệt hoặc liên miền, gửi từ Hà Nội hoặc Tp. HCM. Các tuyến đường còn lại hoặc không nhận dạng được địa chỉ sẽ được chuyển theo phương thức mặc định : Nội miền/ Nội tỉnh đường bộ & Liên miền : Đường bay.
    [order] => Array
        (
            [partner_id] => a1
            [label] => S4268179.SG8.A2.BC.300066599
            [area] => 1
            [fee] => 26400
            [insurance_fee] => 0
            [estimated_pick_time] => Chiều 2021-10-14
            [estimated_deliver_time] => Sáng 2021-10-15
            [products] => Array
                (
                )

            [status_id] => 2
            [tracking_id] => 300066599
            [sorting_code] => SG8.A2.BC
            [is_xfast] => 0
        )

    [warning_message] => Việc vận chuyển hiện tại đang gặp khó khăn do tình hình dịch bệnh phức tạp, vì vậy thời gian giao hàng tới khách sẽ chậm hơn dự kiến.
Mong Shop thông cảm và cân nhắc kỹ trước khi gửi hàng. GHTK xin lỗi vì sự bất tiện này.
)
-->