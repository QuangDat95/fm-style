<?php


 $res=callAPI('POST','https://image.fmstyle.com.vn/app/api/testpostSianchip.php','');
 
 var_dump($res);
 
function GenUuid() {
    return sprintf( '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
         mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ),
         mt_rand( 0, 0xffff ),
         mt_rand( 0, 0x0fff ) | 0x4000,
         mt_rand( 0, 0x3fff ) | 0x8000,
         mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff )
    );
}
function callAPI($method, $url, $data){
    //$endpoint = 'http://fmplustest.xyz/';
    $requestId = GenUuid();
    $apiKey = 'PnVdWXApSHQlUiJDey14aFU4TVVROT1aP0tAOVhwSGE';
    $curl = curl_init();
    switch ($method){
        case "POST":
            curl_setopt($curl, CURLOPT_POST, 1);
            if ($data)
                curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            break;
        case "PUT":
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
            if ($data)
                curl_setopt($curl, CURLOPT_POSTFIELDS, $data);                              
            break;
        default:
            if ($data)
                $url = sprintf("%s?%s", $url, http_build_query($data));
    }	
    // OPTIONS:
    curl_setopt($curl, CURLOPT_URL,$url);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array(
        'x-requestid: '.  $requestId,
        'x-apikey: ' . $apiKey,
        'Content-Type: application/json',
        'Accept: */*n',
        'Accept-Encoding: gzip, deflate, br'
    ));
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $user_agent = 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1; .NET CLR 1.0.3705; .NET CLR 1.1.4322)' ;
 	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 300);
	curl_setopt($curl,CURLOPT_TIMEOUT, 300);	  
    curl_setopt($curl, CURLOPT_USERAGENT, $user_agent);
    curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    // EXECUTE:
    $status = curl_error($curl);
    $result = curl_exec($curl);
 
     if(!$result){
        die("Connection Failure");
    }
    curl_close($curl);
	 
   return array(
        'status' => $status,
        'result' => json_decode($result, true)
    );
}
 
?>