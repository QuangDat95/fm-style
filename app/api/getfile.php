<?php
header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header("Access-Control-Allow-Headers: Content-Type, Authorization");
header('Content-Type: text/html; charset=utf-8');

$json = file_get_contents('php://input');

$LINK_="https://image.fmstyle.com.vn/";
// $mangtam=[];
// getAllfileNew('',$mangtam);
// echo "<pre>";
// var_dump($mangtam);
// echo "</pre>";
// return;
if (isset($_REQUEST["type"])) {
   $type=$_REQUEST["type"];
   switch ($type) {
       case 'getfile':
         $folderName = $_REQUEST['foldername'];

         // kiểm trang foldername tồn tại hay không
         if ($folderName) {
            $data= getfile($folderName);
         }else{
            $data= getfile();
         } 
         if($data){
            $arrRes=array("code"=>200,"data"=> $data);
         }
         else{
            $arrRes=array("code"=>201,"message"=>"Not found images");
         }
         break;

      case 'getfolder':
         $data= getfolder($type);
         if($data){
            $arrRes=array("code"=>200,"data"=> $data);
         }
         else{
            $arrRes=array("code"=>201,"message"=>"Not found folder");
         }
         break;

      case 'addfolder':
         // echo $json; return;
         $json = json_decode($json, true);
         $data= addfolder($json);
            if($data){
               $arrRes=array("code"=>200,"data"=>$data);
            }
            else{
               $arrRes=array("code"=>201,"message"=>"Fail to create folders");
            }
         break;

      case 'upfile':
         
         $data= upfile($type);
         if($data){
            $arrRes=array("code"=>200,"data"=> $data);
         }
         else{
            $arrRes=array("code"=>201,"message"=>"Not found images");
         }
         break;
      case 'deletefile':
         $json = json_decode($json, true);
         $data= deletefile($json);
         if($data){
            $arrRes=array("code"=>200,"message"=> "đã xóa");
         }
         else{
            $arrRes=array("code"=>201,"message"=>"Not found images");
         }
         break;
      case 'search':
         $json = json_decode($json, true);
         $data= SearchFileOrFolder($json);
         if($data){
            $arrRes=array("code"=>200,"data"=>$data);
         }
         else{
            $arrRes=array("code"=>201,"message"=>"Not found images");
         }
         break;
      case 'renamefo':
         $json = json_decode($json, true);
         $data= RenameFo($json);
         if($data){
            $arrRes=array("code"=>200,"message"=>"Đã sửa thành công");
         }
         else{
            $arrRes=array("code"=>201,"message"=>"Not found images");
         }
         break;
      case 'getnewfile':
       
         $data= AllFileNew('',$data);
         if($data){
            $arrRes=array("code"=>200,"data"=>$data);
         }
         else{
            $arrRes=array("code"=>201,"message"=>"Not found images");
         }
         break;
      case 'deletefo':
         $json = json_decode($json, true);
         $data= deleteFo($json);
         if($data){
            $arrRes=array("code"=>200,"message"=>"Đã xóa thành công");
         }
         else{
            $arrRes=array("code"=>201,"message"=>"Not found images");
         }
         break;
      default:
         $arrRes=array("code"=>201,"mess"=>"fail");
         break;
   }

  
}
else{
        $arrRes=array("code"=>201,"mess"=>"fail");
}
// getfile();
  echo json_encode($arrRes);
return;

function getfile($folderName = ""){
   $link="https://image.fmstyle.com.vn/";
   //ham lấy file ảnh
   $dir = "./../../anhchamcong/anhsanpham/";
 
   // get theo folder
   $dir = $dir.$folderName;
   
   if(is_dir($dir)){
      // $file = scandir($dir);
      $files = glob($dir . '/*.{jpg,JPG,jpeg,JPEG,png,PNG,gif,GIF}', GLOB_BRACE);
    
      if(count($files)>0){
         for ($i=0; $i < count($files); $i++) { 
               $files[$i]=$link.$files[$i];
            }
               return $files;  
         }
      return false;
   }
     return false;
}


//get thư mục
function getfolder($folder = '', $levels = 100){
   $link="https://image.fmstyle.com.vn/";
   $dir = "anhchamcong/anhsanpham/";
   
   $folder= $link.$dir;
   
   if ( empty($folder) )
      return false;
   if ( ! $levels )
      return false;
   $dirs = scandir($dir);

   $mangfolder=[];
   if ( $dirs) {
      foreach($dirs as $key =>$file){
         
         if ( in_array($file, array('.', '..') ) )
            continue;
         if (is_dir( $dir . '/' . $file ) ) {
            $files = glob( $dir.'/'.$file."/*", GLOB_BRACE);
            array_push($mangfolder,array("name"=>$file,"link"=>$folder . '/' . $file . '/',"count"=>count($files)));
         }  
      }
      
   }
   return $mangfolder;
}

//hàm tạo thư mục
function addfolder($json){
  global $LINK_;  $linkimg=$LINK_;
   $folder = "anhchamcong/anhsanpham/".$json["namefb"];
   // echo $folder; return;
   if (!mkdir($folder, 0777, true)) {
      return false;
   }
   else{
      return array("name"=>$json["namefb"],"link"=>$linkimg.$folder);
   }
   
}

//hàm upfile
function upfile($type){
  global $LINK_;  $linkimg=$LINK_;
   $uploadDirectoryimages='anhchamcong/anhsanpham/';
   $data=[];
   $selectFolder = "";
   
   if(isset($_POST['folder_post'])){
      $selectFolder = $_POST['folder_post'];
      $uploadDirectoryimages=$uploadDirectoryimages.$selectFolder."/";
   }
   if(isset($_FILES['picture'])){
   
      foreach ($_FILES["picture"]["tmp_name"] as $key => $value) {	
         $tmp_name = $_FILES["picture"]["tmp_name"][$key];
         $hinh=time()."_".rand()."_".$_FILES["picture"]["name"][$key];
         $mtype= array("image/jpeg","image/pjpeg","image/png","image/x-png",'image/gif','application/x-shockwave-flash');  
         $type=$_FILES["picture"]["type"][$key];		
         if( in_array($type,$mtype) ){ 
            $kt=true;    
         }if ($kt==true) {
            move_uploaded_file($tmp_name,  $uploadDirectoryimages.$hinh);
         }
         array_push($data,$linkimg.$uploadDirectoryimages.$hinh);
      }
      // echo "texts".$selectFolder; return;
     // echo json_encode(array('image_source'=>  $data));

   }
   if(count($data)>0){
      return array('image_source'=>  $data);
   }
   else{
      return false;
   }
   
}

//hàm deletefile
function deletefile($json){
  global $LINK_;  $linkimg=$LINK_;
   $uploadDirectoryimages='anhchamcong/anhsanpham/';
   // var_dump($json);
   // return;
  $count=0;
   foreach ($json as $key => $value) {
      $li=str_replace($linkimg,"",$value);
      unlink($li);
       $count++;
   }
   if($count==count($json)){
      return true;
   }
}


function SearchFileOrFolder($json){
  global $LINK_;  $linkimg=$LINK_;
   $uploadDirectoryimages='anhchamcong/anhsanpham/';
   // var_dump($json);
   // return;
   $type=$json["type"];
   $name=$json['name'];
   if($type=="fi"){
      $files=[];
      SearchAllfile('',$files,$name);
   }
   if(count($files)>0){
      $i=0;
      foreach ($files as $key => $value) {
         $files[$i]=$linkimg.$value;
         $i++;
      }
      return $files;
   }
   return false;
}

function getAllfile($folder,&$mangtam){
  global $LINK_;  $linkimg=$LINK_;
   if (!$folder) {
      //ham lấy file ảnh
     $dir = "anhchamcong/anhsanpham/";
   }
   else{
         $dir = $folder."/";
   }


   
   if(is_dir($dir)){
      // $file = scandir($dir);
      $files = glob($dir."*", GLOB_BRACE);
      if(count($files)>0){
         foreach ($files as $key => $value) {
            if(in_array($value,array(".",".."))){
               continue;
            }
             
            if(is_dir($value)){
               getAllfile($value,$mangtam);
             
            }
            else{
               array_push($mangtam,$value);
              
            }
         }
           
      }
   }
}



function SearchAllfile($folder,&$mangtam,$search,$link=''){
   global $LINK_;  $linkimg=$LINK_;
   if (!$folder) {
      //ham lấy file ảnh
     $dir = "anhchamcong/anhsanpham/";
   }
   else{
         $dir = $folder."/";
   }

 
    
   if(is_dir($dir)){
      // $file = scandir($dir);
      $files = glob($dir."*", GLOB_BRACE);
            
      if(count($files)>0){
         foreach ($files as $key => $value) {
            if(in_array($value,array(".",".."))){
              
               continue;
              
            }
              
            if(is_dir($value)){
               
               getAllfile($value,$mangtam,$search,$link.$value);
             
            }
            else{
            //      echo "<pre>";
            //     var_dump($value);
            //  echo "</pre>";
               $tam=explode("/",$value);
               $filename=$tam[count($tam)-1];
                $pos=strpos(strtolower($filename),strtolower($search));
                $file=$value;
                if($pos){ array_push($mangtam,$file);}
            }
         }
           
      }
   }
   // else{
   //    return;
   // }
}


function RenameFo($json){
   $link=$json["link"];
   $oldname=$json["oldname"];
   $newname=$json["newname"];
   if(is_dir($link.$oldname)){
       return rename($link.$oldname, $link.$newname);
   }
   return false;
   // $link="https://kimhoangvu.net/webhook/facebook/";
  
   
}
function AllFileNew(){
   $mangtam=[];
   global $LINK_;  $link=$LINK_;
   getAllfileNew('',$mangtam);
   if(count($mangtam)>0){
      for ($i=0; $i <count($mangtam) ; $i++) { 
        $mangtam[$i]=$link.$mangtam[$i];
      }
      return $mangtam;
   }

   return false;
}
function getAllfileNew($folder,&$mangtam){
    global $LINK_;  $link=$LINK_;
   if (!$folder) {
      //ham lấy file ảnh
     $dir = "anhchamcong/anhsanpham/";
   }
   else{
         $dir = $folder."/";
   }


   
   if(is_dir($dir)){
      // $file = scandir($dir);
      $files = glob($dir."*", GLOB_BRACE);
         usort($files, function($x, $y) {
         return filemtime($x) < filemtime($y);
      });
      if(count($files)>0){
         foreach ($files as $key => $value) {
            if(in_array($value,array(".",".."))){
               continue;
            }
             
            if(is_dir($value)){
                  getAllfileNew($value,$mangtam);
             
            }
            else{
               if(count($mangtam)<=20){
                 array_push($mangtam,$value);
              }
              else{
                 return;
              }
            }
         }
           
      }
   }
}


function deleteFo($json){
   $dir = "anhchamcong/anhsanpham/";
   $folder=$dir.$json["folder"];
   
  if(is_dir($folder)){
     $files = glob($folder."/*", GLOB_BRACE);
       
       foreach ($files as $key => $value) {
            if(in_array($value,array(".",".."))){
               continue;
            }
            if(file_exists($value)){
               unlink($value);
            }
           
       }
      return rmdir($folder);
   }
   return false;
}

?>