<?php
header("Content-Type: application/json");
$root_path =getcwd()."/"  ;
include($root_path."../biensession.php");
include($root_path."../includes/config.php");
include($root_path."../includes/removeUnicode.php");
include($root_path."../includes/class.paging.php");
include($root_path."../includes/class.mysql.php");
include($root_path."../includes/function.php");
include($root_path."../includes/function_local.php");
  
$data = new class_mysql();
$data->config();
$data->access();
 $json = file_get_contents('php://input');

 if(isset($_REQUEST["cuahang"])){
     $macuahang=$_REQUEST["cuahang"];
        echo json_encode(array("code"=>200,"data"=>array("mach"=> $macuahang,"ipcam"=>"rtsp://admin:987654321@fm48yenbai.ddns.net:12345/user=admin&password=987654321&channel=11&stream=1.sdp")));
        
     return;
 }

  if($json){	
    	$json=json_decode($json,true);
		$username=$json['username'];
		$password=$json['password'];
		$checkdata=checkLogin($username,$password);
		if($checkdata){
		
		
			$rtsp = $checkdata["rtsp"];
			$port = $checkdata["port"];
			$user = $checkdata["username"];
			$pass = $checkdata["password"];
			$ch = $checkdata["channel"];
			$str = $checkdata["stream"];
			$macuahang = $checkdata["macuahang"];
			//rtsp://admin:987654321@fm48yenbai.ddns.net:12345/user=admin&password=987654321&channel=11&stream=1.sdp
		 $path = $rtsp.":".$port."/user=".$user."&password=".$pass."&channel=".$ch."&stream=".$str.".sdp";
			echo json_encode(array("code"=>200,"data"=>array("macuahang"=>$checkdata['macuahang'],"rtsp"=>$path)));		
			//admin:987654321@fm48yenbai.ddns.net:12345/user=admin&password=987654321&channel=11&stream=0.sdp
			//echo json_encode(array("code"=>200,"data"=>$checkdata));	
		}
		else{
			echo json_encode(array("code"=>201,"data"=>"not found!"));	
		}
     return;
 }
 
 
 function checkLogin($user,$pass){
 		global $data;
		$pass=md5($pass);
 		$sql="select a.MaNV,b.rtsp,b.macuahang,b.port,b.username,b.password,b.channel,b.stream from userac a left join cuahang_camera b on a.cuahang=b.idcuahang where a.UserName='$user' and a.Password='$pass'";
		//return $sql;
		$dong=getdong($sql);
		if($dong["MaNV"]){
			return $dong;
		}
		else{
			return false;
		}
		
 }
?>