<?php
session_start();
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header("Access-Control-Allow-Headers: Content-Type, Authorization");
header('Content-Type: text/html; charset=utf-8');
//if ($_SESSION["LoginID"]=="") return ;
 
  
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

// echo "ok";
 $json = file_get_contents('php://input');
 	
 if(isset($_REQUEST["type"])){
 	$rq=chonghack($_REQUEST["type"]);
 		switch($rq){
			case 'addcomm':
               
			$json=json_decode($json,true);
           
            $datac=$json["data"];
            //   var_dump($datac);
            // return;
                //   return;
            $commdata=[];
            foreach ($datac as $key => $value) {
                $id=$value["id"];
               
                $commdata[$id]["message"]= $value["message"];
                 $commdata[$id]["id"]= $id;
                  $commdata[$id]["created_time"]= $value["created_time"];
                
                  if($value["attachments"]['data'][0]["media"]["image"]["src"]){
                        $commdata[$id]["image"]= $value["attachments"]['data'][0]["media"]["image"]["src"];
                  }
                if($value["attachments"]['data'][0]["media"]["source"]){
                      $commdata[$id]["video"]= $value["attachments"]['data'][0]["media"]["source"];
                  }
                  $subattachments='';
                
                   
               if($value["attachments"]['data'][0]["subattachments"]['data']){
                    foreach ($value["attachments"]['data'][0]["subattachments"]['data'] as $k => $v) {
                         $subattachments="###".$v["media"]["image"]["src"];
                
                    }
                     $commdata[$id]["subattachments"]= $subattachments;
               }
               
                  $commdata[$id]["permalink_url"]= $value["permalink_url"];
                
                if($value["comments"]){
                    $datac1=$value["comments"]['data'];
                    $tammang=[];
                    foreach ($datac1 as $k1 => $v1) {
                        $idcm=$v1["id"];
                         $tam=[];
                        $tam["idcomm"]=$idcm;
                         $tam["iduser"]=$v1["from"]["id"];
                        $tam["created_time"]=$v1["created_time"];
                     
                         $tam["message"]=$v1["message"];
                        if(!$tam["message"] || $tam["message"]==''){
                            $atttachments= getMediaComm($idcm);
                           
                            if($atttachments){
                                $atttachments=json_decode($atttachments,true);
                                $tam["image"]=$atttachments["attachment"]["media"]["image"]["src"];
                            }
                             
                              
                        }
                         if($v1["comments"]){
                              $tammang2=[];
                              $datac2=$v1["comments"]["data"];
                               foreach ($datac2 as $k2 => $v2) {
                                   $tam2=[];
                                     $tam2["idcomm"]=$v2["id"];
                                        $tam2["iduser"]=$v2["from"]["id"];
                                        $tam2["created_time"]=$v2["created_time"];
                                        $tam2["message"]=$v2["message"];
                                        if(!$tam2["message"] || $tam2["message"]==''){
                                            $atttachments= getMediaComm($v2["id"]);
                                            if($atttachments){
                                                $atttachments=json_decode($atttachments,true);
                                                $tam2["image"]=$atttachments["attachment"]["media"]["image"]["src"];
                                            }
                                        }
                                          array_push($tammang2,$tam2);
                                       
                               }
                                 $tam["comments"]=$tammang2;
                         }
                         array_push($tammang,$tam);
                    }
                    $commdata[$id]["comments"]=$tammang;
                }
              
            }
              
            $datac=insertComm($commdata);
                if($datac){
                        $res=array("code"=>201,"message"=>"thêm thành công!");
                }
                else{
                        $res=array("code"=>201,"message"=>"Thêm thất bại!");
                    }
			break;
			default:
				$res=array("code"=>201,"message"=>"Thêm thất bại!");
			break;
		}
 }
 
 echo json_encode($res);

function insertComm($commdata){
    // echo "<pre>";
    //  var_dump($commdata);
    //   echo "</pre>";
    // return;
    global $data;
    $ngaytao=date("Y-m-d h:m:s");
    $chuoinsert='';
    $chuoinsertcmm="";
    foreach ($commdata as $key => $value) {
       
      $chuoinsert.="('$value[id]','".addslashes($value['message'])."','$ngaytao','$value[image]','$value[subattachments]','$value[video]','$value[permalink_url]','$value[created_time]'),";
      if($value["comments"]){
        foreach ($value["comments"] as $k => $v) {
                  $chuoinsertcmm.="('$value[id]','','$v[idcomm]','$ngaytao','$v[iduser]','$v[message]','$v[image]','$v[subattachments]','$v[video]','$v[permalink_url]','$v[created_time]'),";
                  if($v["comments"]){
                       foreach ($v["comments"] as $k1 => $v1) {
                         $chuoinsertcmm.="('$value[id]','$v[idcomm]','$v1[idcomm]','$ngaytao','$v1[iduser]','$v[message]','$v1[image]','$v1[subattachments]','$v1[video]','$v1[permalink_url]','$v1[created_time]'),";

                       }
                  }
        }
      }
    }

        $chuoinsert=rtrim($chuoinsert,",");
         $chuoinsertcmm=rtrim($chuoinsertcmm,",");
        $sql="insert IGNORE INTO fbComm 
        (idpost,message,ngaytao,image,subattachment,video,permalink_url,created_time) values $chuoinsert";
   
     if($data->query($sql)){
         $sql="insert IGNORE INTO fbCommDetail 
        (idpost,IDcha,idcomm,ngaytao,iduser,message,image,subattachment,video,permalink_url,created_time) values $chuoinsertcmm";
    //        var_dump($sql);
    // return;
          if($data->query($sql)){
                 return true;
          }
          else{
              return  false;
          }
     }
        return  false;
}

function insertCommDetail(){
    
}


function getMediaComm($cmid){
    $curl = curl_init();
    $url='https://graph.facebook.com/v12.0/';
    $endoint="?fields=attachment";
    $access_token='EAAOFnsGIUHYBAMuys1ZCSnZBZApyZAwZCofJu9wosuIuz4TvFBlqkt8CZCZBL5ZAsKQNS5BIgpBAYsDZCM69bqiZAs6wziMtOuBUgprc8qZCSzpX33YN2aDwRt9hUUPTUbuQyFKkhgBx0nLrXQg3d1jt6dqaRQdYpZBJAs8ZC0MdL4rWSg2RRMZCsc7HdpZCz4uzH9DLCMoYz7FazsCTwZDZD';
   
//    echo $url.$cmid.$endoint."&access_token=".$access_token;
//    return;
    curl_setopt_array($curl, array(
    CURLOPT_URL => $url.$cmid.$endoint."&access_token=".$access_token,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'GET',
    CURLOPT_HTTPHEADER => array(
        'Cookie: sb=7yC7YPRdvUTACsPMzGr1Z0iH'
    ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    return $response;
}
?>