<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: X-Requested-With");

if ($_SERVER['REQUEST_METHOD']=='POST') {
   
$data=json_decode(file_get_contents('php://input'),true);
//$base64_img = $_POST['data'];
//function upload_base64($order){
if ($data["order"] != NULL) {
$base64_img = $data["order"];
$split = explode(',', substr($base64_img, 5), 2);
$mime = $split[0];
$img_data = $split[1];
$mime_split_without_base64 = explode(';', $mime, 2);
$mime_split = explode('/', $mime_split_without_base64[0], 2);
$upload_path = "uid/";
if (count($mime_split) == 2) {
  // get file extension
  $extension = $mime_split[1];
  // decode base64 string
  $decoded = base64_decode($img_data);
  // create filename
  #$filename = date('H-i-s') . '.' . $extension;
  $filename = $data["uid"] . '.' . $extension;
  // returns falsy if unsuccessful
  $upload_file = file_put_contents($upload_path . $filename, $decoded);
} else {
 // data not formatted correctly
}
$url = "https://kimhoangvu.net/hoadon/uid/".$filename;
//echo  "<a href=".$url."/".$filename.">".$filename."</a>";
echo $url;
//}
}

} else { echo '{result: no data}';};
?> 