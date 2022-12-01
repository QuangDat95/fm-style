<?php  
session_start();
 
 
 
 $root_path =getcwd()."/"  ;
 $quyen= $_SESSION["quyen"] ; 
 date_default_timezone_set('Asia/Ho_Chi_Minh');
 $ql =$quyen[$_SESSION["mangquyenid"][$_SESSION['act']]]  ;  
 //$ql='120000';
  $idl=$_SESSION["LoginID"];
 $idkho = $_SESSION["se_kho"] ;

include($root_path."includes/config.php");
include($root_path."includes/removeUnicode.php");
include($root_path."includes/class.paging.php");
include($root_path."includes/class.mysql.php");
include($root_path."includes/function.php");
$data = new class_mysql();
$data->config();
$data->access();

if(isset($_POST['GETTHONGBAOPHIEU'])){
	$data1 = $_POST['GETTHONGBAOPHIEU']; 
	$tmp = explode('*@!',$data1);
	$ngaymoi=$tmp[0];
	$idch=laso($tmp[1]);
	
	if($ql[5] || $_SESSION["LoginID"]==7576 || $_SESSION["LoginID"]==1 || $_SESSION["LoginID"]==4647){
		$sqlwhere=' 1=1 ';
		if($idch!=''){
			$sqlwhere.= "and loaitk='$idch'";
		}
		$sql="select sum(CASE WHEN tinhtrang = 2 THEN 1 ELSE 0 END) as tongyeucauchinhsua,
sum(CASE WHEN tinhtrang = 1 or tinhtrang = 0 THEN 1 ELSE 0 END) as tongchuaduyet,
sum(CASE WHEN tinhtrang = 4 THEN 1 ELSE 0 END) as tongduyet,
sum(CASE WHEN tinhtrang = 3 THEN 1 ELSE 0 END) as tongkhongduyet
from thuchikt where   $sqlwhere and  DATE(ngaythuchi)>= DATE(NOW()-INTERVAL 7 DAY) group by loaitk";

	}
	else{
		$sql="select sum(CASE WHEN tinhtrang = 2 THEN 1 ELSE 0 END) as tongyeucauchinhsua,
sum(CASE WHEN tinhtrang = 1 or tinhtrang = 0 THEN 1 ELSE 0 END) as tongchuaduyet,
sum(CASE WHEN tinhtrang = 4 THEN 1 ELSE 0 END) as tongduyet,
sum(CASE WHEN tinhtrang = 3 THEN 1 ELSE 0 END) as tongkhongduyet
from thuchikt where  loaitk='$idkho' and  DATE(ngaythuchi)>= DATE(NOW()-INTERVAL 7 DAY) group by loaitk";
	}
	$query =$data->query($sql);
	$dong=$data->fetch_array($query);
	if($idch){
		$sql="select sochungtu,tinhtrang,ngayduyet from thuchikt where ngayduyet>'$ngaymoi' and  loaitk='$idch' and (tinhtrang=3 or tinhtrang=2) order by ngayduyet desc";
	}
	else{
		$sql="select sochungtu,tinhtrang,ngayduyet from thuchikt where ngayduyet>'$ngaymoi' and  loaitk='$idkho' and (tinhtrang=3 or tinhtrang=2) order by ngayduyet desc";
	
	}
	//echo $sql;
	$query =$data->query($sql);
	$mangmoi=[];
	$mangmoi['moi']=[];
	$k=0;
	while($re = $data->fetch_array($query)){
		$tam=[];
		if($k==0){
			$mangmoi["ngaymoi"]=$re['ngayduyet'];
		}	
		$tinhtrang='';
		if($re['tinhtrang']==3){
			$tinhtrang='Không duyệt';
		}
		else if($re['tinhtrang']==5){
			$tinhtrang='Yêu cầu chỉnh sửa';
		}
		$tam['soct']=$re['sochungtu'];
		$tam['tinhtrang']=$tinhtrang;
		$tam['tinhtrangso']=$re['tinhtrang'];
		array_push($mangmoi['moi'],$tam);
		$k++;
	}
	
		$dong["dulieumoi"]=$mangmoi;
	//var_dump($dong);
	echo json_encode($dong);
	return;
}
  $data->closedata() ;
?>
