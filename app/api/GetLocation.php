<?php
session_start();
$_SESSION["LoginID"]=1;$_SESSION["UserName"]='zalo';
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header("Access-Control-Allow-Headers: Content-Type, Authorization");
header('Content-Type: text/html; charset=utf-8');

 
  
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
		

 if(isset($_REQUEST["type"])){
 	$rq=$_REQUEST["type"];
 		switch($rq){
			
			case 'pr':
				GetPr();
			break;
			case 'dist':
				$id=laso($_REQUEST["id"]);
				GetDist($id);
			break;
			case 'street':
				$idpr=laso($_REQUEST["idpr"]);
				$iddis=laso($_REQUEST["iddis"]);
				GetStreet($idpr,$iddis);
			break;
			case 'war':
				$idpr=laso($_REQUEST["idpr"]);
				$iddis=laso($_REQUEST["iddis"]);
				GetWar($idpr,$iddis);
			break;
			case 'cus':
				$id=laso($_REQUEST["id"]);
				GetCus($id);
			case 'addcus':
				// $json = file_get_contents('php://input');
				if($json){
			
					$json=json_decode($json,true);
						$update=insertCus($json);
				
						if($update==2){
							$res=array("code"=>200,"message"=>"Thêm thành công!");
						}
						else if($update==3){
							$res=array("code"=>201,"message"=>"Thêm thất bại!");
						}
							else if($update==1){
								$res=array("code"=>201,"message"=>"Khách hàng đã tồn tại!");
							}
						echo json_encode($res);
				}	
			break;
			case 'updatecus':
				 //$json = file_get_contents('php://input');
				 // var_dump($json);
				if($json){
			
				
					$json=json_decode($json,true);
					 // var_dump($json);
						$update=updateCus($json);
				
						if($update==2){
							$res=array("code"=>200,"message"=>"Cập nhật thành công!");
						}
						else if($update==3){
							$res=array("code"=>201,"message"=>"Cập nhật thất bại!");
						}
						else{
							$res=array("code"=>203,"message"=>"lỗ 3!");
						}
							
						echo json_encode($res);
				}
				else{
							$res=array("code"=>201,"message"=>"Cập nhật thất bại!");
							echo json_encode($res);
				}	
			break;
			default:
			$res=array("code"=>201,"default"=>"Cập nhật thất bại!");
			echo json_encode($res);
			break;
		}
 }
 
	
	
function GetPr(){
	global $data;
	$sql="select * from tinh";
	$mangtam=[];
	$query=$data->query($sql);
	while($re=$data->fetch_array($query)){
		 array_push($mangtam,$re);
	}
	
	echo json_encode($mangtam);
	
}

function GetDist($id){
	global $data;
	$sql="select * from quan where _province_id='$id'";
	$mangtam=[];
	$query=$data->query($sql);
	while($re=$data->fetch_array($query)){
		 array_push($mangtam,$re);
	}
	
	echo json_encode($mangtam);
	
}

function GetStreet($idpr,$iddis){
	global $data;
	$sql="select * from street where _province_id='$idpr' and _district_id='$iddis'";
	$mangtam=[];
	$query=$data->query($sql);
	while($re=$data->fetch_array($query)){
		 array_push($mangtam,$re);
	}
	
	echo json_encode($mangtam);
	
}

function GetWar($idpr,$iddis){
	global $data;
	$sql="select * from phuong where _province_id='$idpr' and _district_id='$iddis'";
	$mangtam=[];
	$query=$data->query($sql);
	while($re=$data->fetch_array($query)){
		 array_push($mangtam,$re);
	}
	
	echo json_encode($mangtam);
	
}

function GetCus($id){
	global $data;
	$sql="select * from customer where makh='$id'";
	$mangtam=[];
	$dong=getdong($sql);
	$tinh=$dong['IDKhuVuc'];
	$quan=$dong['quan'];
	$phuong=$dong['phuong'];
	$mangtinh='';
	$mangquan='';
	$mangphuong='';
	if($tinh){
		$sql="select * from tinh where id='$tinh'";
		
		$mangtinh=getdong($sql);
	}
	if($quan){
		$sql="select * from quan where id='$quan'";
		$mangquan=getdong($sql);
	}
	if($phuong){
		$sql="select * from phuong where id='$phuong'";
		$mangphuong=getdong($sql);
	}
	$mangtam=array("cus"=>$dong,"prov"=>array($mangtinh),"dist"=>array($mangquan),"war"=>array($mangphuong));
	echo json_encode($mangtam);
}


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
		/*foreach($json as $key =>$value){
				if($key!="ID" &&  $key!="tinh"){
		
					$chuoicot.=$key.",";
					$chuoivalue.="'".$value."',";
				}
		}*/
	/*	$chuoicot="(".rtrim($chuoicot,",").")";
		$chuoivalue="(".rtrim($chuoivalue,",").")";*/
		$ngaytao = gmdate('Y-n-d H:i:s', time() + 7*3600) ;
	$sql= "insert into customer (tel,makh,Name,ngaytao,IDKhuVuc,quan,phuong,ngaysinh,address,xungho,nhomkh,IDCuaHang,IDTao) values ('$json[tel]','$json[tel]','$json[Name]','$ngaytao','$json[IDKhuVuc]','$json[quan]','$json[phuong]','$json[ngaysinh]','$json[address]','$json[xungho]',7,'$json[IDCuaHang]','$json[IDTao]')";
		
		// $update=$data->query($sql);
		if($data->query($sql)){
			return 2;
		}
		else{
			return 3;
		}

	}
}
function updateCus($json){
	global $data;
		$ngaytao = gmdate('Y-n-d H:i:s', time() + 7*3600) ;
		$sql= "update customer set Name='$json[Name]',address='$json[address]',IDKhuVuc='$json[IDKhuVuc]',quan='$json[quan]',phuong='$json[phuong]',ngaysinh='$json[ngaysinh]',xungho='$json[xungho]',ngaycapnhap='$ngaytao',IDCapnhap='$json[IDCapnhap]' where ID='$json[ID]'";
		// var_dump($sql);
		// $update=$data->query($sql);
		//  var_dump($update);
		if($data->query($sql)){
			return 2;
		}
		else{
			return 3;
		}

}
?>