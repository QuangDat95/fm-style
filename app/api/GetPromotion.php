<?php
session_start();
header("Content-Type: application/json");

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
	$codepr=$json['codepro'];
	$data=GetOnlyOneProduct($codepr);
	if($data){
 		$res=array("code"=>200,"data"=>$data);
	}
	else{
		$res=array("code"=>201,"message"=>"Sản phẩm không tồn tại!");
	}
 
 }
 else{
 	$res=array("code"=>401,"message"=>"fail");
 }	
 	echo json_encode($res);
	
	
function GetOnlyOneProduct($codepro){
	$siteimg='http://192.168.1.55/fm/images/products/';
	$sql="select a.* from products a where codepro='$codepro'";

	$dong=getdong($sql);
	if($dong['ID']){
		$result=array(
			"ID"=>$dong["ID"],
			"Name"=>$dong["Name"],
			"codepro"=>$dong["codepro"],
			"price"=>$dong["price"],
			"images"=>$siteimg.$dong["images"],
			
		);
		return json_encode($result);
	}
	else{
		return false;
	}
	
}
?>

