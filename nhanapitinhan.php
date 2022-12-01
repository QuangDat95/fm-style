<?php
 header("Content-Type: application/json");
$dd =getcwd().'/';
   $json = file_get_contents('php://input');
 // $json=json_encode(array("tin"=>"tin cho người tạo 3!","idzalo"=>"nguoitao"));
   $err='';
   if($json){
   		 $json =json_decode($json,true);
  	 	$tinnhan=$json['tin'];
		 $myfile = fopen('webdictionary.txt', 'w+') or die("Unable to open file!");
		$text= $myfile."--".$tinnhan;
		 $myfile= fwrite($myfile,$text);
		 $err=$tinnhan;
		fclose($myfile);
   }
   
  
 
       		 echo json_encode($err); return ;
?>