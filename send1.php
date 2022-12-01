<?php
$mang[] =   '4571897234802874336'  ;  // 0905044126
 	 $url = 'https://kimhoangvu.net/vfm/' ;
     $datatruyen  =  array(
	  "token" => "7cb5c316244cf4d55f17facc0fd7b13f7d3f4540ab2afa2599607f6a61f4edac", 
	 "id" => 19, 	   
   	 "message" =>  "test thong tin "  ,
	  "user_id" =>$mang   
	) ;
	
	 //$make_call=callAPInoibo('POST',$url, json_encode($datatruyen));
	 
	// echo json_encode($datatruyen);
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => $url,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_SSL_VERIFYPEER => false,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => json_encode($datatruyen),
  CURLOPT_HTTPHEADER => array(
    'token: 7cb5c316244cf4d55f17facc0fd7b13f7d3f4540ab2afa2599607f6a61f4edac',
    'Content-Type: application/json'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
var_dump($response);
?>