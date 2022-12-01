<?php
function output_file($noidung, $name, $mime_type='')
{
 
   
 $known_mime_types=array(
 	"pdf" => "application/pdf",
 	"txt" => "text/plain",
 	"html" => "text/html",
 	"htm" => "text/html",
	"exe" => "application/octet-stream",
	"zip" => "application/zip",
	"doc" => "application/msword",
	"xls" => "application/vnd.ms-excel",
	"ppt" => "application/vnd.ms-powerpoint",
	"gif" => "image/gif",
	"png" => "image/png",
	"jpeg"=> "image/jpg",
	"jpg" =>  "image/jpg",
	"php" => "text/plain"
 );

 if($mime_type==''){
	 $file_extension = strtolower(substr(strrchr($file,"."),1));
	 if(array_key_exists($file_extension, $known_mime_types)){
		$mime_type=$known_mime_types[$file_extension];
	 } else {
		$mime_type="application/force-download";
	 };
 };

 
 
 header('Content-Type: ' . $mime_type);
 header("Content-Disposition: Attachment; filename=$name");
 header("Pragma: no-cache");    
 
 echo $noidung;
  
}	

 
set_time_limit(0);

$noidung =  $_REQUEST["noidung"] ; 
$tenfile =  $_REQUEST["tenfile"] ; 
$loaifile =  $_REQUEST["loaifile"] ; //'text/plain'
  
output_file("$noidung",$tenfile,$loaifile );
?> 