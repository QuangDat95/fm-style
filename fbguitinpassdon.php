<?php
$root_path =getcwd()."/"  ;
include($root_path."biensession.php");
include($root_path."includes/config.php");
include($root_path."includes/removeUnicode.php");
include($root_path."includes/class.paging.php");
include($root_path."includes/class.mysql.php");
include($root_path."includes/function.php");
include($root_path."includes/function_local.php");
  
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
sendFB();
function sendFB(){
    global $data;
   $sql="select distinct a.IDfb from userac a left join nhanviendilam b on a.ID=b.IDnhanvien where day(ngaytao)=day(now()) and month(ngaytao)=month(now()) and year(ngaytao) = year(now()) and a.IDfb is not null";
    $query=$data->query($sql);
   
    // $magresp=array("1962958627103807","4712811502139254");
$mess="đây là tin nhắn tự động\npass đơn";
$mangbatch=[];
    while($re=$data->fetch_array($query)){
        $value=$re["IDfb"];
		 
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
      $jsonurl=urlencode($jsonurl);
   $res=guitinnhanhangloat($jsonurl);
   $res=json_decode($res,true);
   if($res[0]["code"]==200){
       echo "thành công";
   }
   else{
       echo "thất bại";
   }
  
}

function guitinnhanhangloat($jsonurl){
    

    $curl = curl_init();
    $url='https://graph.facebook.com/';
    $ACCESSTOKEN='EAAOFnsGIUHYBAMuys1ZCSnZBZApyZAwZCofJu9wosuIuz4TvFBlqkt8CZCZBL5ZAsKQNS5BIgpBAYsDZCM69bqiZAs6wziMtOuBUgprc8qZCSzpX33YN2aDwRt9hUUPTUbuQyFKkhgBx0nLrXQg3d1jt6dqaRQdYpZBJAs8ZC0MdL4rWSg2RRMZCsc7HdpZCz4uzH9DLCMoYz7FazsCTwZDZD';
    $endpoint='me?batch='.$jsonurl."&access_token=".$ACCESSTOKEN;
    //return  $url.$endpoint;
    curl_setopt_array($curl, array(
    CURLOPT_URL =>$url.$endpoint,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_HTTPHEADER => array(
        'Cookie: sb=7yC7YPRdvUTACsPMzGr1Z0iH'
    ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
	//var_dump($response);
    return $response;

}
?>