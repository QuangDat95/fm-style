<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
 header("Access-Control-Allow-Headers: X-Requested-With");
$data_img="not thing";
$data_img = $_POST['data']; 
  // $tmp = explode('*@!',$data_img);
$data_img=json_decode($data_img);


$idUser=$data_img->id ;
$url=$data_img->url;

$res=imagesaver($url,$idUser);

    echo json_encode(['data'=>$res]);
 

  
  function imagesaver($image_data,$name){
      $linkDomain="https://kimhoangvu.com/fmstylemoi.vn/";
      $linkUpload='upload/';
      $check=true;
      $currentYear=date("Y");//2019
      $curentMonth=date("m");
      $drName=$curentMonth."-".$currentYear;
       // Check forder exists
        $directory = $linkUpload.$drName;
        
        if (!file_exists($directory)) {
          if(!mkdir($directory, 0777, true)){
            $check=false;
          }
        //  return "koco"
        }
         
        if($check)
        {
           define('UPLOAD_DIR', $directory."/");
              $img = $image_data;
              $pos = strpos($img, 'data:image/png');
            
             
              if($pos!==false)
              {
                 
                        $img = str_replace('data:image/png;base64,', '', $img);
                        $img = str_replace(' ', '+', $img);
                        $data = base64_decode($img);
						if(strlen($data)<5580) return ;
					//	$data =strlen($data). base64_decode($img);
                        // return $data;
                        // l?y ngày gi? hi?n t?i
                        date_default_timezone_set("Asia/Ho_Chi_Minh");
                        $t=time();
                        $timeNow=date("Y-m-d-H:i:s",$t);
                        
                       // $file = UPLOAD_DIR .$name."-".str_replace(":","-",$timeNow)."-".$t.'.png';
                        $file = UPLOAD_DIR .$name.'.png';
                        $resPo=$name.'.png';
                        $success = file_put_contents($file, $data);
                        return $success ? $linkDomain.$file :false;
              }
              else{
                  return false;
                   return  "fail";
              }
        }
        else{
              return false;
        }   
   
}
?>