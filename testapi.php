<?php


$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://localhost/fm/apipassdon.php',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'{
    "baomat":"!@92cffe4a34ccc4f9c6ec755843593458b",
    "idch":0,
    "tungay":"08/01/2022",
    "toingay":""
}',
  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/json',
    'Cookie: PHPSESSID=bhtjk0h4gaprmjco898shikgq0'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
echo $response;

?>