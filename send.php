<?php
//echo "oooo"; myid zalo 2646491592555906088
//yêu cau xét duyệt, lý do, số tiền, người tạo
/*$id='2646491592555906088';
$noidung="yêu cầu xét duyệt:
lý do:
số tiền:
người tạo:";
$result=sendme($id,$noidung);
var_dump(json_decode($result,true));*/
function sendme($id,$noidung){
	$mang[] =  $id  ;  // 0905044126
 	 $url = 'https://kimhoangvu.net/sendzalo/send/19.fm' ;
     $datatruyen  =  array(
	  "token" => "7cb5c316244cf4d55f17facc0fd7b13f7d3f4540ab2afa2599607f6a61f4edac", 
	 "id" => 19, 	   
   	 "message" => $noidung,
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
//  CURLOPT_SSL_VERIFYPEER => false
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
	//var_dump($response);
	
	curl_close($curl);
	return $response;
}
function guithumua(){
	$mang[] =   '4571897234802874336'  ;  // 0905044126
 	 $url = 'https://kimhoangvu.net/nhantin/send/999.fm' ;
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
	var_dump($response);
	
	curl_close($curl);
	return $response;
}
?>