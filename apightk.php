<?php  
session_start();

 
 
 $root_path =getcwd()."/"  ;
 $quyen= $_SESSION["quyen"] ; 

 $ql =$quyen[$_SESSION["mangquyenid"][$_SESSION['act']]]  ;  
 //$ql='120000';
  $idl=$_SESSION["LoginID"];
 
include($root_path."includes/config.php");
include($root_path."includes/removeUnicode.php");
include($root_path."includes/class.paging.php");
include($root_path."includes/class.mysql.php");
include($root_path."includes/function.php");
 

 
   
$data = new class_mysql();
$data->config();
$data->access();

 
if(isset($_POST['PHIVANCHUYEN'])){
	 $data1 = $_POST['PHIVANCHUYEN']; 
  $tmp = explode('*@!',$data1);
        //$ten   =  ($tmp[0])   ;
}
 function getfeevcv($datajson){
//$data = array(
//    "pick_province" => "Đà nẵng",
//    "pick_district" => "Quận cẩm lệ",
//    "province" => "Đồng nai",
//    "district" => "TP Biên hòa",
//    "address" => "323 kp 4, phường thống nhất",
//    "weight" => 1000,
//    "value" => 300000,
//    "transport" => "road",
//    // "deliver_option" => "xteam",
//    // "tags"  => [1]
//);
$curl = curl_init();
 
curl_setopt_array($curl, array(
    //CURLOPT_URL => "https://services.giaohangtietkiem.vn/services/shipment/order",
	CURLOPT_URL => "https://services.ghtklab.com/services/shipment/fee",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => $datajson,
    CURLOPT_HTTPHEADER => array(
        "Content-Type: application/json",
        "Token: 187c69cA1c3d49fE1B43573b335d67a7481e7181",
        "Content-Length: " . strlen($datajson),
    ),
));

$response = curl_exec($curl);
curl_close($curl);
return $response;
}			
  $data->closedata() ;
?>	