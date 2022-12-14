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

//Token kh??ng thay ?????i, ch??? c???n ????ng nh???p 1 l???n ????? l???y token n???u ch??a c?? token
//=============== LOGIN ????? L???Y TOKEN =================
// $login = new LoginViettelPost();
// $body = array(
//     'USERNAME' => '0969939160',
//     'PASSWORD' => '244466666'
// );
// $respon = $login->Sign_In_By_Parner_Account($body);
// echo "<pre>";
// var_dump($respon);
// echo "</pre>";

//================== GET LIST V??n Ph??ng Viettel Post ===================
// $services = new ViettelPostServices;

// $respon = $services->Get_List_Office_ViettelPost($token);
// echo "<pre>";
// var_dump($respon);
// echo "</pre>";

//================== GET LIST Services (D???ch v??? c???a ViettelPost) ===================
// $services = new ViettelPostServices;
// $body = array(
//     'TYPE' => 2
// );
// $respon = $services->Get_List_Services($body);
// echo "<pre>";
// var_dump($respon);
// echo "</pre>";

//================== GET LIST Services Extra (D???ch v??? kh??c c???a ViettelPost) ===================
// $services = new ViettelPostServices;

// $param = "VCN";
// $respon = $services->Get_List_Services_Extend($param);
// echo "<pre>";
// var_dump($respon);
// echo "</pre>";

//================== GET LIST Province (Danh s??ch th??nh ph??? VN) ===================
//C?? th??? t??m ki???m th??nh ph??? d???a tr??n ID
// $services = new ViettelPostServices;

// $respon = $services->Get_List_Province();
// echo "<pre>";
// var_dump($respon);
// echo "</pre>";

//================== GET LIST Districts (Danh s??ch qu???n huy???n) ===================
//C?? th??? t??m ki???m qu???n huy???n d???a theo ID th??nh ph???
// $services = new ViettelPostServices;

// $respon = $services->Get_List_Districts_By_Province(2);
// echo "<pre>";
// var_dump($respon);
// echo "</pre>";

//================== GET LIST Wards (Danh s??ch ph?????ng x??) ===================
//C?? th??? t??m ki???m ph?????ng x?? d???a theo ID qu???n huy???n
// $services = new ViettelPostServices;

// $respon = $services->Get_List_Wards_By_District();
// echo "<pre>";
// var_dump($respon);
// echo "</pre>";

//================== CREATE ORDER (T???O BILL) ===================
//  $order = new ViettelOrder;

//  $body = array(

//      "ORDER_NUMBER" => "B" . strtotime("+6 hours"),
//      "GROUPADDRESS_ID" => 10513950, //M?? kho
//      "CUS_ID" => 5652574, //M?? kh??ch h??ng
//      "DELIVERY_DATE" => date("d/m/Y H:i:s", strtotime("+6 hours")), //Ng??y v???n chuy???n
//      "SENDER_FULLNAME" => "FM STYLE 43QL1A",
//      "SENDER_ADDRESS" => "H???i IT test t???o ????n h??ng",
//      "SENDER_PHONE" => "0788042142",
//      "SENDER_EMAIL" => "laptrinhvien@fmstyle.com.vn",
//      "SENDER_WARD" => 8469,
//      "SENDER_DISTRICT" => 459,
//      "SENDER_PROVINCE" => 40,
//      "SENDER_LATITUDE" => 0,
//      "SENDER_LONGITUDE" => 0,
//      "RECEIVER_FULLNAME" => "H???i IT - Test",
//      "RECEIVER_ADDRESS" => "K82 H21/106/05 Nguy???n Ch??nh, P.Ho?? Minh, Q.Li??n Chi???u, TP.???? N???ng",
//      "RECEIVER_PHONE" => "0788042142",
//      "RECEIVER_EMAIL" => "laptrinhvien@fmstyle.com.vn",
//      "RECEIVER_WARD" => 1220,
//      "RECEIVER_DISTRICT" => 76,
//      "RECEIVER_PROVINCE" => 4,
//      "RECEIVER_LATITUDE" => 0,
//      "RECEIVER_LONGITUDE" => 0,
//      "PRODUCT_NAME" => "??o D??? N??? 2 d??y ?????p si??u c???p v?? tr???",
//      "PRODUCT_DESCRIPTION" => "??o D??? N??? 2 d??y ?????p si??u c???p v?? tr???",
//      "PRODUCT_QUANTITY" => 2,
//      "PRODUCT_PRICE" => 480000, 
//      "PRODUCT_WEIGHT" => 100, // C??n n???ng s???n ph???m
//      "PRODUCT_LENGTH" => 5, // chi???u d??i s???n ph???m
//      "PRODUCT_WIDTH" => 2, // chi???u r???ng s???n ph???m
//      "PRODUCT_HEIGHT" => 2, // chi???u cao s???n ph???m
//      "PRODUCT_TYPE" => "HH",// HH: H??ng ho?? - TH: Th??
//      "ORDER_PAYMENT" => 3, // 1: Kh??ng thu - 2: Thu ti???n c?????c v?? ti???n h??ng - 3: Thu ti???n h??ng - 4: Thu ti???n c?????c
//      "ORDER_SERVICE" => "VCBO", //D???ch v??? ????n h??ng. VCBO: V???n chuy???n ???????ng b???
//      "ORDER_SERVICE_ADD" => "",
//      "ORDER_VOUCHER" => "",
//      "ORDER_NOTE" => "cho xem h??ng, kh??ng cho th???",
//      "MONEY_COLLECTION" => 480000, // Ph?? thu h??? (S??? ti???n h??ng c???n thu h??? - kh??ng bao g???m ti???n c?????c)
//      "MONEY_TOTALFEE" => 0, // C?????c ch??nh
//      "MONEY_FEECOD" => 0, // Ph??? ph?? thu h???
//      "MONEY_FEEVAS" => 0, // Ph?? gia t??ng ( c??c d???ch v??? c???ng th??m kh??c c?? ph??t sinh)
//      "MONEY_FEEINSURRANCE" => 0, // Ph?? b???o hi???m (= 1% gi?? tr??? khai gi??)
//      "MONEY_FEE" => 0, // Ph??? ph?? (ph??? ph?? x??ng d???u, k???t n???i huy???n...)
//      "MONEY_FEEOTHER" => 0, // Ph??? ph?? kh??c ( ph??? ph?? ????ng g??i, ph??t sinh kh??c???.)
//      "MONEY_TOTALVAT" => 0, // Ph?? VAT
//      "MONEY_TOTAL" => 0, // T???ng ti???n bao g???m VAT
//      "LIST_ITEM" => array(
//          array(
//              "PRODUCT_NAME" => "??o D??? N??? 2 d??y ?????p si??u c???p v?? tr???",
//              "PRODUCT_PRICE" => 210000,
//              "PRODUCT_WEIGHT" => 50,
//              "PRODUCT_QUANTITY" => 1
//          ),
//          array(
//              "PRODUCT_NAME" => "Qu???n T??y Nam ?????p si??u c???p v?? tr???",
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

//================== UPDATE ORDER (C???P NH???T BILL) ===================
/* ===== TYPE =====
    1 - Duy???t ????n h??ng
    2 - Duy???t chuy???n ho??n
    3 - Ph??t ti???p
    4 - H???y ????n h??ng
    5 - L???y l???i ????n h??ng (G???i l???i)
    11 - X??a ????n h??ng ???? h???y(delete canceled order)
*/
// $order = new ViettelOrder;
// $body = array(
//     "TYPE" => 4,
//     "ORDER_NUMBER" => (int) "15673661915",
//     "NOTE" => "Ghi ch?? c???p nh???t tr???ng th??i ????n h??ng"
// );

// $respon = $order->Update_Order($body, $token);
// echo "<pre>";
// var_dump(json_decode($respon, true));
// echo "</pre>";