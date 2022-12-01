<?php

function GenUuid()
{
    return sprintf(
        '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
        mt_rand(0, 0xffff),
        mt_rand(0, 0xffff),
        mt_rand(0, 0xffff),
        mt_rand(0, 0x0fff) | 0x4000,
        mt_rand(0, 0x3fff) | 0x8000,
        mt_rand(0, 0xffff),
        mt_rand(0, 0xffff),
        mt_rand(0, 0xffff)
    );
}
function callAPI($method, $url, $data)
{
    $endpoint = 'http://fmplustest.xyz/';
    $requestId = GenUuid();
    $apiKey = 'PnVdWXApSHQlUiJDey14aFU4TVVROT1aP0tAOVhwSGE';
    $curl = curl_init();
    switch ($method) {
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
    curl_setopt($curl, CURLOPT_URL, $endpoint . $url);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array(
        'x-requestid: ' .  $requestId,
        'x-apikey: ' . $apiKey,
        'Content-Type: application/json',
        'Accept: */*n',
        'Accept-Encoding: gzip, deflate, br'
    ));
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $user_agent = 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1; .NET CLR 1.0.3705; .NET CLR 1.1.4322)';
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 300);
    curl_setopt($curl, CURLOPT_TIMEOUT, 300);
    curl_setopt($curl, CURLOPT_USERAGENT, $user_agent);
    curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    // EXECUTE:
    $status = curl_error($curl);
    $result = curl_exec($curl);

    if (!$result) {
        die("Connection Failure");
    }
    curl_close($curl);

    return array(
        'status' => $status,
        'result' => json_decode($result, true)
    );
}


function callAPInoibo($method, $url, $data)
{

    $requestId = GenUuid();
    $apiKey = 'PnVdWXApSHQlUiJDey14aFU4TVVROT1aP0tAOVhwSGE';
    $curl = curl_init();
    switch ($method) {
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
    $CURLOPT_HTTPHEADER = array(
        "Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8",
        "Accept-Language: en-US,en;q=0.5",
        "Cache-Control: no-cache",
        "Connection: keep-alive",
        "Cookie: ht=7635aa7ceda60bf1",
        "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:62.0) Gecko/20100101 Firefox/62.0"
    );
    $user_agent = 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1; .NET CLR 1.0.3705; .NET CLR 1.1.4322)';
    // $user_agent = $_SERVER['HTTP_USER_AGENT'];
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_USERAGENT, $user_agent);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    // curl_setopt($curl, CURLOPT_HTTPHEADER,array('Content-Type: multipart/form-data'));

    curl_setopt($curl, CURLOPT_HTTPHEADER, $CURLOPT_HTTPHEADER);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    // curl_setopt($ch, CURLOPT_INFILESIZE, $filesize);
    // EXECUTE:
    $status = curl_error($curl);
    $result = curl_exec($curl);
    var_dump($result);
    if (!$result) {
        echo curl_errno($curl) . '<br/>';
        echo curl_error($curl) . '<br/>';
        // die("Connection Failure");
    }
    curl_close($curl);

    return array(
        'status' => $status,
        'result' => json_decode($result, true)
    );
}


function callApiGetImage()
{
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://fmstyle.com.vn/layanhvtt.php',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => '{"url":"test"}',
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json'
        ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    echo $response;
}
