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


 $json = file_get_contents('php://input');
 $json=json_decode($json,true);
 
 echo json_encode(array("code"=>200,"data"=>$json));

function insertCus($json){
global $data;
$idCus=$json["tel"];
$sql="select ID from customer where makh=$idCus";
$query=$data->query($sql);
$numrow=$data->num_rows($query);
	if($numrow>0){
		return 1;
	}
	else{
	
	$chuoicot='';
	$chuoivalue='';
	
		$ngaytao = gmdate('Y-n-d H:i:s', time() + 7*3600) ;
		$sql= "insert into customer (tel,makh,Name,ngaytao,IDKhuVuc,quan,phuong,ngaysinh,address,xungho,nhomkh,IDCuaHang) values ('$json[tel]','$json[tel]','$json[Name]','$ngaytao','$json[IDKhuVuc]','$json[quan]','$json[phuong]','$json[ngaysinh]','$json[address]','$json[xungho]',7,'$json[IDCuaHang]')";
		
		$update=$data->query($sql);
		if($update){
			return 2;
		}
		else{
			return 3;
		}
	
	}
}
?>

