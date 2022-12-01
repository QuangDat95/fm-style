<?php
global $conn;
$conn = OpenCon();

header("Access-Control-Allow-Orgin: *");
header("Access-Control-Allow-Methods: Origin, X-Requested-With, Content-Type, Accept, token");
header('Content-type: application/json');

$headers = getallheaders();
$author = $headers['Authorization']; //header authorization của shopee

$json = file_get_contents('php://input'); //nhận POST data body

$author_temp = hash_hmac("sha256", "FMSTYLE.COM.VN@123", "FMSTYLE.COM.VN@2012");


if ($author == $author_temp) {

  $json = json_decode($json, true);

  // // LƯU THÔNG TIN LẠI
  $myfile = file_get_contents("log.json");
  $datas = [];
  if ($myfile) {
    $datas = json_decode($myfile, true);
  }
  array_push($datas, $json);
  $luufile = file_put_contents('log.json', json_encode($datas, JSON_UNESCAPED_UNICODE));

  $order_id = $json['id'];
  $customer_phone = $json['shipping_address']['phone_number'];
  $customer_name = $json['shipping_address']['full_name'];
  $warehouse_name = $json['warehouse_info']['name'] . " -- " . $json['warehouse_info']['address'];
  $is_free_shipping = $json['is_free_shipping'] ? 1 : 0; // 1-true: Miễn phí, 0-false: Không 
  $shipping_fee = $json['shipping_fee']; //Phí vận chuyển
  $received_at_shop = $json['received_at_shop'] ? 1 : 0; // 1-true: Bán tại quầy, 0-false: Bán Online
  $note_print = $json['note_print']; // Ghi chú đơn hàng
  $address_detail = $json['shipping_address']['full_address'];
  $note = $json['note'];
  $total_discount = $json['total_discount'];
  $inserted_at = date("Y-m-d H:i:s", strtotime($json['inserted_at']));
  $updated_at = date("Y-m-d H:i:s", strtotime($json['updated_at']));
  $creator = $json['creator']['name'];
  $status = $json['status'];
  $status_name = "";
  if ($status == 0) $status_name = "Đơn mới";
  else if ($status == 1) $status_name = "Đã xác nhận";
  else if ($status == 2) $status_name = "Đã gửi";
  else if ($status == 3) $status_name = "Đã nhận";
  else if ($status == 4) $status_name = "Đang hoàn";
  else if ($status == 5) $status_name = "Đã hoàn";
  else if ($status == 6) $status_name = "Đã huỷ";
  else if ($status == 7) $status_name = "Đã xoá";
  else if ($status == 8) $status_name = "Đang đóng hàng";
  else if ($status == 9) $status_name = "Đang chuyển hàng";
  else if ($status == 11) $status_name = "Chờ hàng";
  else if ($status == 12) $status_name = "Chờ in";
  else if ($status == 13) $status_name = "Đã in";
  else if ($status == 15) $status_name = "Hoàn 1 phần";
  else if ($status == 16) $status_name = "Đã thu tiền";
  
  $address = $json['shipping_address']['address'];
  $province_id = $json['shipping_address']['province_id'];
  $district_id = $json['shipping_address']['district_id'];
  $commune_id = $json['shipping_address']['commune_id'];
  $province_name = "";
  $district_name = "";
  $commune_name = "";
  if(!empty($province_id)) {
    $sql = "SELECT name FROM pancake_provinces where province_id = '$province_id'";
    $rs = $conn->query($sql);
    $rs = $rs->fetch_array();
    $province_name = $rs['name'];
  }

  if(!empty($district_id)) {
    $district_name = get_district_name($province_id,$district_id);
  }

  if(!empty($district_id)) {
    $commune_name = get_commune_name($district_id,$commune_id);
  }

  $partner_id = $json['partner']['partner_id'];
  $partner_name = $json['partner']['partner_name'];
  $extend_code = $json['partner']['order_number_vtp'] ?? $json['partner']['extend_code'];
  $cod = $json['cod'];
  $total_price = $json['total_price'];
  $total_price_after_sub_discount = $json['total_price_after_sub_discount'];
  $charged_by_momo = $json['charged_by_momo'];
  $charged_by_qrpay = $json['charged_by_qrpay'];

  $charged_by_card = $json['charged_by_card'];
  $transfer_money = $json['transfer_money'];
  $partner_fee = $json['partner_fee'];
  $customer_pay_fee = $json['customer_pay_fee'] ? 1 : 0; // 1-true: Khách trả phí ship, 0-false: Shop trả phí ship

  $sql = "SELECT count(ID) AS order_row, status FROM order_pancake WHERE order_id = '$order_id'";

  $rsrow = $conn->query($sql);
  $rsrow = $rsrow->fetch_array();

  if (empty($rsrow['order_row'])) {
    $sql1 = "Insert into order_pancake set customer_phone = '$customer_phone', customer_name ='$customer_name', order_id = '$order_id',
    warehouse_name = '$warehouse_name', is_free_shipping = '$is_free_shipping', shipping_fee = '$shipping_fee', 
    received_at_shop = '$received_at_shop', note_print = '$note_print', address_detail = '$address_detail',note = '$note',
    total_discount = '$total_discount',inserted_at = '$inserted_at', updated_at = '$updated_at', creator = '$creator', status = '$status',
    status_name = '$status_name', partner_id = '$partner_id', partner_name = '$partner_name', extend_code = '$extend_code',
    cod = '$cod', total_price = '$total_price', total_price_after_sub_discount = '$total_price_after_sub_discount', 
    charged_by_momo = '$charged_by_momo', charged_by_qrpay = '$charged_by_qrpay', charged_by_card = '$charged_by_card',
    transfer_money = '$transfer_money', partner_fee = '$partner_fee', customer_pay_fee = '$customer_pay_fee',province = '$province_name',
    district = '$district_name', commune = '$commune_name', address = '$address'";
    
    $result = mysqli_query($conn, $sql1);
  } else if ($status != $rsrow['status']) {
    $sql1 = "Update order_pancake set customer_phone = '$customer_phone', customer_name ='$customer_name',
    warehouse_name = '$warehouse_name', is_free_shipping = '$is_free_shipping', shipping_fee = '$shipping_fee', 
    received_at_shop = '$received_at_shop', note_print = '$note_print', address_detail = '$address_detail',note = '$note',
    total_discount = '$total_discount',inserted_at = '$inserted_at', updated_at = '$updated_at', creator = '$creator', status = '$status',
    status_name = '$status_name', partner_id = '$partner_id', partner_name = '$partner_name', extend_code = '$extend_code',
    cod = '$cod', total_price = '$total_price', total_price_after_sub_discount = '$total_price_after_sub_discount', 
    charged_by_momo = '$charged_by_momo', charged_by_qrpay = '$charged_by_qrpay', charged_by_card = '$charged_by_card',
    transfer_money = '$transfer_money', partner_fee = '$partner_fee', customer_pay_fee = '$customer_pay_fee',
    province = '$province_name',district = '$district_name', commune = '$commune_name', address = '$address' where order_id = '$order_id'";
    $result = mysqli_query($conn, $sql1);
  }

  CloseCon($conn);
}



function OpenCon()
{
  $server = "localhost";
  $username = "zalo_user";
  $password = "Chucthanhcong@2022";
  $dbname = "zalo_transport";
  $conn = new mysqli($server, $username, $password, $dbname) or die("Connect failed: %s\n" . $conn->error);
  $conn->set_charset("utf8");
  return $conn;
}

function CloseCon($conn)
{
  $conn->close();
}

function get_district_name($province_id, $district_id) {
  $curl = curl_init();
  curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://pos.pages.fm/api/v1/geo/districts?api_key=6dd1e48b73ab452295bd8960140aba32&province_id='.$province_id,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'GET',
  ));

  $response = curl_exec($curl);

  curl_close($curl);
  $response = json_decode($response,true);
  $response = $response['data'];
  
  $district_name = "";
  for ($i=0; $i < count($response); $i++) { 
    if($response[$i]['id'] == $district_id) {
      
      $district_name =  $response[$i]['name'];
      break;
    }
  }

  return $district_name;
}

function get_commune_name($district_id, $commune_id) {
  $curl = curl_init();
  curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://pos.pages.fm/api/v1//geo/communes?api_key=6dd1e48b73ab452295bd8960140aba32&district_id='.$district_id,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'GET',
  ));

  $response = curl_exec($curl);

  curl_close($curl);
  $response = json_decode($response,true);
  $response = $response['data'];
  
  $commune_name = "";
  for ($i=0; $i < count($response); $i++) { 
    if($response[$i]['id'] == $commune_id) {
      
      $commune_name =  $response[$i]['name'];
      break;
    }
  }

  return $commune_name;
}