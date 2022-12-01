<?php  
session_start();
 $quyen= $_SESSION["quyen"] ; 
  date_default_timezone_set('Asia/Ho_Chi_Minh');
if ($_SESSION["LoginID"]=="") return ;
$ql =$quyen[$_SESSION["mangquyenid"][$_SESSION['act']]]  ;
$root_path =getcwd()."/"  ;
include($root_path."biensession.php");
include($root_path."includes/config.php");
include($root_path."includes/removeUnicode.php");
include($root_path."includes/class.paging.php");
include($root_path."includes/class.mysql.php");
include($root_path."includes/function.php");
include($root_path."includes/function_local.php");

$idk = laso($_SESSION["LoginID"]) ; if ($idk == 0) return ;
  $idkho = $_SESSION["se_kho"] ; 
  
$data = new class_mysql();
$data->config();
$data->access();
$updated =false;

$tm = $_SESSION["root_path"] ;



$sql="select ID,mavandon from thuchikt where ngaythuchi<='2022-29-03' and ngaythuchi>='2022-03-01' and mavandon is not null and mavandon <> '' ";
$query=$data->query($sql);

while($r=$data->fetch_array($query)){
	$ID=$r['ID'];
	$sotien=gettienvandon($r['mavandon']);
	if($sotien && $sotien>0 && $sotien!=''){
		$sql="update thuchikt set sotien='$sotien' where ID='$ID'";
		$update=$data->query($sql);
	}
	echo "<pre>";
	var_dump($sotien);
	echo "</pre>";
}

function gettienvandon($mavd){
	$sql="select tongtien,trigiadon from vanchuyenonline where mavd='$mavd' or madh='$mavd'";
	
	$dong=getdong($sql);
	return $dong['tongtien'];
}


$data->close();
?>	