<?php
$root_path =getcwd()."/"  ;
include($root_path."../../biensession.php");
include($root_path."../../includes/config.php");
include($root_path."../../includes/removeUnicode.php");
include($root_path."../../includes/class.paging.php");
include($root_path."../../includes/class.mysql.php");
include($root_path."../../includes/function.php");
include($root_path."../../includes/function_local.php");
  
$data = new class_mysql();
$data->config();
$data->access();
//  $test2 = [
//     'recipient' => [
//         'id' => '1962958627103807',
//     ],
//     'message' => [
//         'text' => 'hello, world!'
//     ]
// ];
// $test1 = [
//     'recipient' => [
//         'id' => '4712811502139254',
//     ],
//     'message' => [
//         'text' => 'hello, world!'
//     ]
// ];

//  $tamtest=[
//     [
//       "method"=>"POST",
//       "relative_url"=>"me/messages",
//       "body"=>http_build_query($test2, "", '&'),
//     ],
//    [
//       "method"=>"POST",
//       "relative_url"=>"me/messages",
//       "body"=>http_build_query($test1, "", '&'),
//     ]
//    ];
//  var_dump(json_encode($mangbatch));
// sendFB();
// testpost();
function sendFB(){
    global $data;
   $sql="select distinct a.IDfb from userac a left join nhanviendilam b on a.ID=b.IDnhanvien where day(b.ngaytao)=day(now()) and month(b.ngaytao)=month(now()) and year(b.ngaytao) = year(now()) and a.IDfb is not null";
    $query=$data->query($sql);
     echo $sql;
    // $magresp=array("1962958627103807","4712811502139254");
$mess="đây là tin nhắn tự động\nCủa đơn hàng...";
$mangbatch=[];
    while($re=$data->fetch_array($query)){
        $value=$re["IDfb"];
          echo $value;
            $texbody = [
                    'recipient'=> [
                        'id' => $value,
                    ],
                    'message'=>[
                        'text'=>$mess
                    ]
                ];
            $batch=[
            'method'=>'POST',
            'relative_url'=>'me/messages',
            'body'=>http_build_query($texbody, "", '&'),
            ];
        array_push($mangbatch,$batch);
    

    }
    $jsonurl=json_encode($mangbatch);
    //   $jsonurl=urlencode($jsonurl);
      //  var_dump($jsonurl);
   $res=guitinnhanhangloat($jsonurl);
   var_dump($res);
   
//    if($res[0]["code"]==200){
//        echo "thành công";
//    }
//    else{
//        echo "thất bại";
//    }
  
}

function guitinnhanhangloat($jsonurl){
    
 $agent = 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1; .NET CLR 1.0.3705; .NET CLR 1.1.4322)';
    $curl = curl_init();
    $url='https://graph.facebook.com/me';
    // $ACCESSTOKEN='EAAOFnsGIUHYBAMuys1ZCSnZBZApyZAwZCofJu9wosuIuz4TvFBlqkt8CZCZBL5ZAsKQNS5BIgpBAYsDZCM69bqiZAs6wziMtOuBUgprc8qZCSzpX33YN2aDwRt9hUUPTUbuQyFKkhgBx0nLrXQg3d1jt6dqaRQdYpZBJAs8ZC0MdL4rWSg2RRMZCsc7HdpZCz4uzH9DLCMoYz7FazsCTwZDZD';
    //$endpoint="me&access_token=".$ACCESSTOKEN;
    //return  $url.$endpoint;'EAAOFnsGIUHYBAMuys1ZCSnZBZApyZAwZCofJu9wosuIuz4TvFBlqkt8CZCZBL5ZAsKQNS5BIgpBAYsDZCM69bqiZAs6wziMtOuBUgprc8qZCSzpX33YN2aDwRt9hUUPTUbuQyFKkhgBx0nLrXQg3d1jt6dqaRQdYpZBJAs8ZC0MdL4rWSg2RRMZCsc7HdpZCz4uzH9DLCMoYz7FazsCTwZDZD',
    $mangaccesstoken=['EAAOFnsGIUHYBACcJZC2erkZB8uxLEH3jOUvoaLTZCvvD8KfDrz5kcuIitfZBHZCi9bZBnuZBRWtPhzEjCFeceeSVV6bEpkGoMZAOJu2TJ8sFFsTrJe8bQUdGXYu8seZCSvzEyCGQQGUtZC6MO3mc7kZAZCMvKUSrq5VLZBL9XlYdoFhZCBKnCZBE4XAmode'];
    $mangtrave=array();
       
        curl_setopt_array($curl, array(
            CURLOPT_URL =>$url,
            CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_POSTFIELDS =>array("batch"=>$jsonurl,"access_token"=>$mangaccesstoken[0]),
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_USERAGENT => $agent,
                CURLOPT_HTTPHEADER => array(
                    'Cookie: sb=7yC7YPRdvUTACsPMzGr1Z0iH'
                ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        echo "<pre>";
			var_dump(json_decode($response,true));
			echo "</pre>";
     
    
    return json_decode($response,true);

}

//  $url1="https://image.fmstyle.com.vn/app/api/insertconvertion.php?type=mess";
// $arr=array("fbmail"=> "",
// "fbid"=> "4895693237183685",
// "timestamp"=> 1647394700452,
// "mid"=> "m_6qOdlOXC17bEzzzoOJvZHRNaaohuhNNgVtq_XCvFOl4PYPo4BQmBhi9nKavilwvmUI9m2YYMJWRjwBoDasvcjA",
// "text"=> "###UPDATE###FM0705###",
// "attachments"=> "",
// "type"=> null,
// "url"=> null);
// var_dump(saveConv($url1,$arr));
// function saveConv($url,$data){
// $curl = curl_init();

//     curl_setopt_array($curl, array(
//      CURLOPT_URL =>$url,
//      // 'https://image.fmstyle.com.vn/app/api/insertconvertion.php?type=mess',
//     //  CURLOPT_URL => 'https://fm.ovn.vn/app/api/insertconvertion.php?type=mess',
//     CURLOPT_RETURNTRANSFER => true,
//     CURLOPT_ENCODING => '',
//     CURLOPT_MAXREDIRS => 10,
//     CURLOPT_TIMEOUT => 0,
//     CURLOPT_FOLLOWLOCATION => true,
//     CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
//     CURLOPT_CUSTOMREQUEST => 'POST',
//     CURLOPT_POSTFIELDS =>json_encode($data),
//     CURLOPT_HTTPHEADER => array(
//         'Content-Type: application/json',
//         'Cookie: PHPSESSID=11m1jicbk61joqcll98hfprpn5'
//     ),
//     ));

//     $response = curl_exec($curl);

//     curl_close($curl);
//     return $response;

// }

// ++++++++++++++++++++++++++++++++++++++++++
	     $sendOption=array("messaging_type"=>urldecode("RESPONSE"),
									"recipient"=>urldecode(json_encode(array("id"=>"4895693237183685"))),
									"message"=>urldecode(json_encode(array("text"=>"FM0705
Đoàn Tấn Đạt
lập trình viên
80 nguyễn văn thoại, đà nẵng
7/2021
"))),
								);
    sendMessAuto($sendOption);
function sendMessAuto($data){

// $ACCESS_TOKEN ='EAAOFnsGIUHYBAMuys1ZCSnZBZApyZAwZCofJu9wosuIuz4TvFBlqkt8CZCZBL5ZAsKQNS5BIgpBAYsDZCM69bqiZAs6wziMtOuBUgprc8qZCSzpX33YN2aDwRt9hUUPTUbuQyFKkhgBx0nLrXQg3d1jt6dqaRQdYpZBJAs8ZC0MdL4rWSg2RRMZCsc7HdpZCz4uzH9DLCMoYz7FazsCTwZDZD';
	// $ACCESS_TOKEN ='EAAOFnsGIUHYBACcJZC2erkZB8uxLEH3jOUvoaLTZCvvD8KfDrz5kcuIitfZBHZCi9bZBnuZBRWtPhzEjCFeceeSVV6bEpkGoMZAOJu2TJ8sFFsTrJe8bQUdGXYu8seZCSvzEyCGQQGUtZC6MO3mc7kZAZCMvKUSrq5VLZBL9XlYdoFhZCBKnCZBE4XAmode';
 $agent = 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1; .NET CLR 1.0.3705; .NET CLR 1.1.4322)';

	 $mangaccesstoken=['EAAOFnsGIUHYBACcJZC2erkZB8uxLEH3jOUvoaLTZCvvD8KfDrz5kcuIitfZBHZCi9bZBnuZBRWtPhzEjCFeceeSVV6bEpkGoMZAOJu2TJ8sFFsTrJe8bQUdGXYu8seZCSvzEyCGQQGUtZC6MO3mc7kZAZCMvKUSrq5VLZBL9XlYdoFhZCBKnCZBE4XAmode'];
    //  / $mangtrave=array();
	// foreach ($mangaccesstoken as $key => $accesstoken) {
			$curl = curl_init();
			// '{
			//   "messaging_type": "UPDATE",
			//   "recipient": {
			//     "id": "4712811502139254"
			//   },
			//   "message": {
			//     "text": "hello, world!"
			//   }
			// }'
			curl_setopt_array($curl, array(
			CURLOPT_URL => 'https://graph.facebook.com/v12.0/me/messages?access_token='.$mangaccesstoken[0],
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => '',
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => 'POST',
			CURLOPT_USERAGENT => $agent,
			CURLOPT_POSTFIELDS =>json_encode($data),
			CURLOPT_HTTPHEADER => array(
				'Content-Type: application/json',
				'Cookie: sb=7yC7YPRdvUTACsPMzGr1Z0iH'
			),
			));

			$response = curl_exec($curl);
			curl_close($curl);
			echo "<pre>";
			var_dump(json_decode($response,true));
			echo "</pre>";
			// array_push($mangtrave,json_decode($response,true));
	// }
	
	return json_decode($response,true);
}

//     $manv ="FM0705";
//       $ngay ="02/07/2021";


//       echo "<pre>";
//  var_dump(json_decode(getListEmployeeDoWork($manv,$ngay),true));
//  echo "</pre>";
function getListEmployeeDoWork($manv,$ngay){

    // $manv =FM0705
        // $ngay =01/07/2021 https://image.fmstyle.com.vn/app/api/chamcongapi1.php
    $curl = curl_init();
    $baomat = "!@92cffe4a34ccc4f9c6ec755843593458b!@926";
    $field = array("manv" => $manv,"ngay" => $ngay,"baomat" => $baomat); 
    //{"idphong":".$id_phongban.","baomat":"!@92cffe4a34ccc4f9c6ec755843593458b!@926"}
    curl_setopt_array($curl, array(
    CURLOPT_URL => 'http://siandchip.vn/app/api/chamcongapi1.php',
        // CURLOPT_URL => 'https://image.fmstyle.com.vn/app/api/chamcongapi1.php',
    CURLOPT_RETURNTRANSFER => true,
    // CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS => json_encode($field),
    CURLOPT_HTTPHEADER => array(
        'Content-Type: application/json'
    ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    //echo $response;
    return $response;
}
?>