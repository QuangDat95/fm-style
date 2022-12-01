<?php
// https://services.ghtklab.com/services/shipment/
// https://services.giaohangtietkiem.vn/services/shipment/order
// 187c69cA1c3d49fE1B43573b335d67a7481e7181
class Ghtk 
{
     private $token;
     private $url;
    private $urlsanbox;
   
     function __construct($token, $url) {
         $this->token = $token;
          $this->url = $url;
         $this->urlsanbox = "https://services.ghtklab.com/services/shipment/";
        
    }
     function set_url($url) {
        $this->url = $url;
    }
    function get_url() {
        return $this->url;
    }
      function set_urlsanbox($urlsanbox) {
        $this->urlsanbox = $urlsanbox;
    }
    function get_urlsanbox() {
        return $this->urlsanbox;
    }
      function set_token($token) {
        $this->token = $token;
    }
    function get_token() {
        return $this->token;
    }
      function set_data($data) {
        $this->data = $data;
    }
    function get_data() {
        return $this->data;
    }
    function PostApiContrutor($data,$endpoint) {
        $token=$this->token;
        if(!$token){
            return array("message"=>"Token is required");
        }
        if($this->url){
            $url=$this->url;
        }
        else{
            $url=$this->urlsanbox;
        }

        $curl = curl_init();
        $payload=json_encode($data);
        curl_setopt_array($curl, array(
            CURLOPT_URL =>  $url.$endpoint,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $payload,
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json",
                "Token: ".$token,
                "Content-Length: " . strlen($payload),
            ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        $res=json_decode($response,true);
        return $res;
    }
     function PostApiNotdataContrutor($data,$endpoint) {
        $token=$this->token;
        if(!$token){
            return array("message"=>"Token is required");
        }
        if($this->url){
            $url=$this->url;
        }
        else{
            $url=$this->urlsanbox;
        }

        $curl = curl_init();
       
        curl_setopt_array($curl, array(
            CURLOPT_URL =>  $url.$endpoint."/".$data,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json",
                "Token: ".$token,
               
            ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        $res=json_decode($response,true);
        return $res;
    }
   
    function GetFeeTransport($data){
            return $this->PostApiContrutor($data,"fee");
        
    }

    function CreatBillCode($data){
            return $this->PostApiContrutor($data,"order");
    }
    function CancleBillCode($data){
            return $this->PostApiNotdataContrutor($data,"cancel");
    }
     function GetStatusBill($data){
       
            return $this->PostApiNotdataContrutor($data,"v2");
        
    }
}

//$ghtk=new Ghtk("187c69cA1c3d49fE1B43573b335d67a7481e7181","https://services.giaohangtietkiem.vn/services/shipment/");



// hàm test get phsi van chuyen+++++++++++++++
// $data = array(
//     "pick_province" => "Đà nẵng",
//     "pick_district" => "Quận cẩm lệ",
//     "province" => "Đồng nai",
//     "district" => "TP Biên hòa",
//     "address" => "323 kp 4, phường thống nhất",
//     "weight" => 1000,
//     "value" => 300000,
//     "transport" => "road",
//     // "deliver_option" => "xteam",
//     // "tags"  => [1]
// );
// $phivanchuyen=$ghtk->GetFeeTransport($data);
// hàm test get mã vận đơn
// $order=array(
//   "products"=>array(
//         array(
//             "name"=>"Sơ mi nữ TN cổ vest_Nâu nhạt",
//             "weight"=>0.5,
//             "quantity"=>"1",
//             "product_code"=>"211001163",
//             ),
//     ),
//   "order"=>
//     array(
//         "id"=>"B22032.1105.10260",
//         "tel"=>"0362039416",
//         "name"=>"Chung Eri",
//         "address"=> "xóm giáp an điền, Xã Cộng Hòa, Huyện Nam Sách, Hải Dương",
//         "province"=> "Tỉnh Hải Dương",
//         "district"=> "Huyện Nam Sách",
//         "ward"=>"Xã Cộng Hòa",
//         "pick_name"=>"35 Nguyễn Văn Cừ, Đà Lạt",
//         "pick_address"=>"35 Nguyễn Văn Cừ, Đà Lạt",
//         "pick_province"=> "Tỉnh Lâm Đồng",
//         "pick_district"=> "Thành phố Đà Lạt",
//         // "pick_ward"=>'Phường Hòa Thuận Đông',
//         "pick_tel"=>"0784264796",
//         "note"=>'pass đơn',
//         "hamlet"=> "khác",
//         "is_freeship"=>"1",
//         "pick_money"=>125000,
//         "value"=>125000,
//        // "tags"=> array(1)
//     ),
// );
// $mavd=$ghtk->CreatBillCode($order);

// hàm test hủy mã vân dơn

// $mavd=$ghtk->CancleBillCode("S4268179.MB6.G3.300071506");

// ham test trang thai don
// $mavd=$ghtk->GetStatusBill("S4268179.MN2-07-Y35.1341907233");

// echo "<pre>";
//     var_dump($mavd);
// echo "</pre>";



?>
