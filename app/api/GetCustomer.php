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


 if(isset($_REQUEST["type"])){
 	$rq=$_REQUEST["type"];
 		switch($rq){
			
			case 'pr':
				GetPr();
			break;
			case 'dist':
				$id=$_REQUEST["id"];
				GetDist($id);
			break;
			case 'street':
				$idpr=$_REQUEST["idpr"];
				$iddis=$_REQUEST["iddis"];
				GetStreet($idpr,$iddis);
			break;
			case 'war':
				$idpr=$_REQUEST["idpr"];
				$iddis=$_REQUEST["iddis"];
				GetWar($idpr,$iddis);
			break;
			default:
			break;
		}
 }


	
	
function GetCus(){
	global $data;
	$sql="select * from tinh";
	$mangtam=[];
	$query=$data->query($sql);
	while($re=$data->fetch_array($query)){
		 array_push($mangtam,$re);
	}
	
	echo json_encode($mangtam);
	
}
?>

