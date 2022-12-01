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
 if($json){
	 if(isset($_REQUEST["byname"])){
	 		$json=json_decode($json,true);
			$codepr=chonghack($json['codepro']);
			$data=GetProducts($codepr);
			if($data){
				$res=array("code"=>200,"data"=>$data);
			}
			else{
				$res=array("code"=>201,"message"=>"Sản phẩm không tồn tại!");
			}
	 }
	 else{
	 		$json=json_decode($json,true);
			$codepr=chonghack($json['codepro']);
			$data=GetOnlyOneProduct($codepr);
			if($data){
				$res=array("code"=>200,"data"=>$data);
			}
			else{
				$res=array("code"=>201,"message"=>"Sản phẩm không tồn tại!");
			}
	 }
 	
 
 }
 else{
 	$res=array("code"=>401,"message"=>"fail");
 }	
 	echo json_encode($res);
	
	
function GetOnlyOneProduct($codepro){
	$siteimg='http://192.168.1.55/fm/images/products/';
	$sql="select a.* from products a where codepro='$codepro' or Name like '%$codepro%'" ;

	$dong=getdong($sql);
	if($dong['ID']){
		$store=GetStore($dong['ID']);
		$result=array(
			"ID"=>$dong["ID"],
			"Name"=>$dong["Name"],
			"codepro"=>$dong["codepro"],
			"price"=>$dong["price"],
			"images"=>$siteimg.$dong["images"],
			"cuahang"=>$store
			
		);
		return json_encode($result);
	}
	else{
		return false;
	}
	
}
function GetProducts($param){
	global $data;
	$siteimg='http://192.168.1.55/fm/images/products/';
	$sql="select a.* from products a where codepro='$param' or Name like '%$param%' limit 100" ;

	$mangtam=[];
	$query =$data->query($sql);
	$numrow=$data->num_rows($query);
	if($numrow>0){
		while($r=$data->fetch_array($query)){
			$r["images"]=$siteimg.$r["images"];
			array_push($mangtam,$r);
		}
		return $mangtam;
	}	
	return false;
	
	
}
function GetStore($id){
	global $data;
	$sql="select b.*,c.Name from hanghoacuahang b left join cuahang c on b.IDcuahang=c.ID where b.IDsp='$id'";
	
	$mangtam=[];
	$query =$data->query($sql);
	while($r=$data->fetch_array($query)){
		array_push($mangtam,$r);
	}	
	return $mangtam;
	
}
?>