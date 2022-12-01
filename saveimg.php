<?php
include "./api/systemConfig.php";
$Api=new systemConfig();
$data="not thing";
if (isset($_POST["data"])) {
        $data=$_POST["data"];
}

$res=imagesaver($data);

// $upload=upload($res);

$Api->sendResponse(200,'{"items":'.json_encode($data).'}');
function imagesaver($image_data){
	define('UPLOAD_DIR', 'upload/');
	$img = $image_data;
    $pos = strpos($img, 'data:image/png');
   if($pos!==false)
   {
          $img = str_replace('data:image/png;base64,', '', $img);
            $img = str_replace(' ', '+', $img);
            $data = base64_decode($img);
            // return $data;
            $file = UPLOAD_DIR . uniqid() . '.png';
            $success = file_put_contents($file, $data);
            return $success ? $file :false;
   }
   else{
       return false;
   }
	
   
}



?>