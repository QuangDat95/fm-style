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
$json = file_get_contents("php://input");

  $myfile = file_get_contents("log.json");
 
 	 $myfile.='||'.$json; 
  
  $luufile =file_put_contents('log.json',$myfile);
if($json)
 {
	   $json = json_decode($json, true);
	 
	    $baomat= $json['baomat']  ;
	   if($baomat=='') return ;
	
 
}
 else   return ;


 	
		
    $baomat = explode('!@9',$baomat);    
    $baomat =$baomat[1];
		
 if ($baomat!="2cffe4a34ccc4f9c6ec755843593458b") return ;   // Tcv13
 $mavd= $json['label_id'];
 $trangthai=$json['status_id'];
 $time=$json['action_time'];
	// 1-> Chưa tiếp nhận
	// 2-> dã tiếp nhập
	// 3-> Đã lấy hàng/Đã nhập kho
	// 4-> Đã điều phối giao hàng/Đang giao hàng
	// 5-> Đã giao hàng/Chưa đối soát
	// 6-> Đã đối soát
	// 7-> Không lấy được hàng
	// 8-> Hoãn lấy hàng
	// 9-> Không giao được hàng
	// 10->Delay giao hàng
	// 11->Đã đối soát công nợ trả hàng
	// 12->Đã điều phối lấy hàng/Đang lấy hàng
	// 13->Đơn hàng bồi hoàn
	// 20->Đang trả hàng (COD cầm hàng đi trả)
	// 21->Đã trả hàng (COD đã trả xong hàng)
	// 123->Shipper báo đã lấy hàng
	// 127->Shipper (nhân viên lấy/giao hàng) báo không lấy được hàng
	// 128->Shipper báo delay lấy hàng
	// 45->Shipper báo đã giao hàng
	// 49->Shipper báo không giao được giao hàng
	// 410->Shipper báo delay giao hàng
	
	switch($trangthai){
		case 2:
			capnhattrangthaiPassdon('ngaynhandon',$time,$mavd);
		break;
		case 3:
			capnhattrangthaiPassdon('ngaytoikho',$time,$mavd);
		break;
		case 5:
			capnhattrangthaiPassdon('ngaygiaohang1',$time,$mavd);
		break;
		case 6:
				capnhattrangthaiPassdon('ngayhoanthanh',$time,$mavd);
		break;
		case 21:
			capnhattrangthaiPassdon('ngayhuy',$time,$mavd);
		break;
		default:
		 break;
	}
	
	function capnhattrangthaiPassdon($trangthai,$time,$mavd){
		global $data;
		$sql="update vanchuyenpassdon set $trangthai='$time' where mavd='$mavd'"
		$update=$data->query($sql);
	}
		 
?>