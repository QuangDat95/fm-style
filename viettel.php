<?php 
//echo "ok";
class ViettelPostServices {
    public function postRequestAPI($httpurl,$body,$token){
         if($token){
                $header = array(
                    'Content-Type: application/json',
                    'token:'.$token
                );
        }
        else{
              $header = array(
                'Content-Type: application/json'
            );
        }
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => $httpurl,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => json_encode($body),
        CURLOPT_HTTPHEADER => $header,
        ));
        
        $response = curl_exec($curl);
        
        curl_close($curl);
        return json_decode($response,true);
    }

    public function getRequestAPI($httpurl,$token=""){
        $curl = curl_init();
        if($token){
            $header = array(
                'Content-Type: application/json',
                'token:'.$token
            );
         }
        else{
              $header = array(
                'Content-Type: application/json'
            );
        }
        curl_setopt_array($curl, array(
        CURLOPT_URL => $httpurl,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => $header,
        ));
        
        $response = curl_exec($curl);
        
        curl_close($curl);
        return json_decode($response,true);
    }
    public function Get_List_Office_ViettelPost($token){
        $httpurl ='https://partner.viettelpost.vn/v2/categories/listBuuCucVTP';
        $response = $this->getRequestAPI($httpurl,$token);
        return $response;
    }

    public function Get_List_Services($body,$token){
        $httpurl = 'https://partner.viettelpost.vn/v2/categories/listService';
        $response =$this->postRequestAPI($httpurl,$body,$token);
        return $response;
    }

    public function Get_List_Services_Extend($param = 'VCN'){
        $httpurl = 'https://partner.viettelpost.vn/v2/categories/listServiceExtra?serviceCode='.$param;
        $response = $this->getRequestAPI($httpurl,"");
        return $response;
    }

    public function Get_List_Province($param = -1){
        $httpurl = 'https://partner.viettelpost.vn/v2/categories/listProvinceById?provinceId='.$param;
        $response =$this->getRequestAPI($httpurl,"");
        return $response;
    }

    public function Get_List_Districts_By_Province($param = -1){
        $httpurl = 'https://partner.viettelpost.vn/v2/categories/listDistrict?provinceId='.$param;
        $response =$this->getRequestAPI($httpurl,"");
        return $response;
    }

    public function Get_List_Wards_By_District($param = -1){
        $httpurl = 'https://partner.viettelpost.vn/v2/categories/listWards?districtId='.$param;
        $response = $this->getRequestAPI($httpurl,"");
        return $response;
    }
	public function Get_Status_Oder($param=''){
        $httpurl = 'https://kimhoangvu.net/tracking/viettel/getstatus.php?type=tracuu&mavd='.$param;
        $response = $this->getRequestAPI($httpurl,"");
        return $response;
    }
}


$token = 'eyJhbGciOiJFUzI1NiJ9.eyJzdWIiOiIwOTY5OTM5MTYwIiwiVXNlcklkIjo1NjUyNTc0LCJGcm9tU291cmNlIjo1LCJUb2tlbiI6IjlUNDlNREpSSURQTlFTN1pZOEEiLCJleHAiOjE3MzEyMTk5MzAsIlBhcnRuZXIiOjU2NTI1NzR9.RCAn9qh3nPz8kLp7gkvuwRVh9PO-3Nq47_00_Q-us3mswHHXVVmPKr4rf1uQE74VA09LqG1xT9s0P5L0hpT4Pg';

//Token không thay đổi, chỉ cần đăng nhập 1 lần để lấy token nếu chưa có token
//=============== LOGIN ĐỂ LẤY TOKEN =================
// $login = new LoginViettelPost();
// $body = array(
//     'USERNAME' => '0969939160',
//     'PASSWORD' => '244466666'
// );
// $respon = $login->Sign_In_By_Parner_Account($body);
// echo "<pre>";
// var_dump($respon);
// echo "</pre>";

//================== GET LIST Văn Phòng Viettel Post ===================
// $services = new ViettelPostServices;

// $respon = $services->Get_List_Office_ViettelPost($token);
// echo "<pre>";
// var_dump($respon);
// echo "</pre>";

//================== GET LIST Services (Dịch vụ của ViettelPost) ===================
// $services = new ViettelPostServices;
// $body = array(
//     'TYPE' => 2
// );
// $respon = $services->Get_List_Services($body);
// echo "<pre>";
// var_dump($respon);
// echo "</pre>";

//================== GET LIST Services Extra (Dịch vụ khác của ViettelPost) ===================
// $services = new ViettelPostServices;

// $param = "VCN";
// $respon = $services->Get_List_Services_Extend($param);
// echo "<pre>";
// var_dump($respon);
// echo "</pre>";

//================== GET LIST Province (Danh sách thành phố VN) ===================
//Có thể tìm kiếm thành phố dựa trên ID
// $services = new ViettelPostServices;

// $respon = $services->Get_List_Province();
// echo "<pre>";
// var_dump($respon);
// echo "</pre>";

//================== GET LIST Districts (Danh sách quận huyện) ===================
//Có thể tìm kiếm quận huyện dựa theo ID thành phố
// $services = new ViettelPostServices;

// $respon = $services->Get_List_Districts_By_Province(2);
// echo "<pre>";
// var_dump($respon);
// echo "</pre>";

//================== GET LIST Wards (Danh sách phường xã) ===================
//Có thể tìm kiếm phường xã dựa theo ID quận huyện
// $services = new ViettelPostServices;

// $respon = $services->Get_List_Wards_By_District();
// echo "<pre>";
// var_dump($respon);
// echo "</pre>";

//================== CREATE ORDER (TẠO BILL) ===================
//  $order = new ViettelOrder;

//  $body = array(

//      "ORDER_NUMBER" => "B" . strtotime("+6 hours"),
//      "GROUPADDRESS_ID" => 10513950, //Mã kho
//      "CUS_ID" => 5652574, //Mã khách hàng
//      "DELIVERY_DATE" => date("d/m/Y H:i:s", strtotime("+6 hours")), //Ngày vận chuyển
//      "SENDER_FULLNAME" => "FM STYLE 43QL1A",
//      "SENDER_ADDRESS" => "Hải IT test tạo đơn hàng",
//      "SENDER_PHONE" => "0788042142",
//      "SENDER_EMAIL" => "laptrinhvien@fmstyle.com.vn",
//      "SENDER_WARD" => 8469,
//      "SENDER_DISTRICT" => 459,
//      "SENDER_PROVINCE" => 40,
//      "SENDER_LATITUDE" => 0,
//      "SENDER_LONGITUDE" => 0,
//      "RECEIVER_FULLNAME" => "Hải IT - Test",
//      "RECEIVER_ADDRESS" => "K82 H21/106/05 Nguyễn Chánh, P.Hoà Minh, Q.Liên Chiểu, TP.Đà Nẵng",
//      "RECEIVER_PHONE" => "0788042142",
//      "RECEIVER_EMAIL" => "laptrinhvien@fmstyle.com.vn",
//      "RECEIVER_WARD" => 1220,
//      "RECEIVER_DISTRICT" => 76,
//      "RECEIVER_PROVINCE" => 4,
//      "RECEIVER_LATITUDE" => 0,
//      "RECEIVER_LONGITUDE" => 0,
//      "PRODUCT_NAME" => "Áo Dạ Nữ 2 dây đẹp siêu cấp vũ trụ",
//      "PRODUCT_DESCRIPTION" => "Áo Dạ Nữ 2 dây đẹp siêu cấp vũ trụ",
//      "PRODUCT_QUANTITY" => 2,
//      "PRODUCT_PRICE" => 480000, 
//      "PRODUCT_WEIGHT" => 100, // Cân nặng sản phẩm
//      "PRODUCT_LENGTH" => 5, // chiều dài sản phẩm
//      "PRODUCT_WIDTH" => 2, // chiều rộng sản phẩm
//      "PRODUCT_HEIGHT" => 2, // chiều cao sản phẩm
//      "PRODUCT_TYPE" => "HH",// HH: Hàng hoá - TH: Thư
//      "ORDER_PAYMENT" => 3, // 1: Không thu - 2: Thu tiền cước và tiền hàng - 3: Thu tiền hàng - 4: Thu tiền cước
//      "ORDER_SERVICE" => "VCBO", //Dịch vụ đơn hàng. VCBO: Vận chuyển đường bộ
//      "ORDER_SERVICE_ADD" => "",
//      "ORDER_VOUCHER" => "",
//      "ORDER_NOTE" => "cho xem hàng, không cho thử",
//      "MONEY_COLLECTION" => 480000, // Phí thu hộ (Số tiền hàng cần thu hộ - không bao gồm tiền cước)
//      "MONEY_TOTALFEE" => 0, // Cước chính
//      "MONEY_FEECOD" => 0, // Phụ phí thu hộ
//      "MONEY_FEEVAS" => 0, // Phí gia tăng ( các dịch vụ cộng thêm khác có phát sinh)
//      "MONEY_FEEINSURRANCE" => 0, // Phí bảo hiểm (= 1% giá trị khai giá)
//      "MONEY_FEE" => 0, // Phụ phí (phụ phí xăng dầu, kết nối huyện...)
//      "MONEY_FEEOTHER" => 0, // Phụ phí khác ( phụ phí đóng gói, phát sinh khác….)
//      "MONEY_TOTALVAT" => 0, // Phí VAT
//      "MONEY_TOTAL" => 0, // Tổng tiền bao gồm VAT
//      "LIST_ITEM" => array(
//          array(
//              "PRODUCT_NAME" => "Áo Dạ Nữ 2 dây đẹp siêu cấp vũ trụ",
//              "PRODUCT_PRICE" => 210000,
//              "PRODUCT_WEIGHT" => 50,
//              "PRODUCT_QUANTITY" => 1
//          ),
//          array(
//              "PRODUCT_NAME" => "Quần Tây Nam đẹp siêu cấp vũ trụ",
//              "PRODUCT_PRICE" => 270000,
//              "PRODUCT_WEIGHT" => 50,
//              "PRODUCT_QUANTITY" => 1
//          )
//      )
//  );

//  $respon = $order->Create_Order($body, $token);
//  echo "<pre>";
//  var_dump(json_decode($respon, true));
//  echo "</pre>";

//================== UPDATE ORDER (CẬP NHẬT BILL) ===================
/* ===== TYPE =====
    1 - Duyệt đơn hàng
    2 - Duyệt chuyển hoàn
    3 - Phát tiếp
    4 - Hủy đơn hàng
    5 - Lấy lại đơn hàng (Gửi lại)
    11 - Xóa đơn hàng đã hủy(delete canceled order)
*/
// $order = new ViettelOrder;
// $body = array(
//     "TYPE" => 4,
//     "ORDER_NUMBER" => (int) "15673661915",
//     "NOTE" => "Ghi chú cập nhật trạng thái đơn hàng"
// );

// $respon = $order->Update_Order($body, $token);
// echo "<pre>";
// var_dump(json_decode($respon, true));
// echo "</pre>";