<?php
$root_path =getcwd()."/"  ;
include($root_path."includes/config.php");
include($root_path."includes/class.mysql.php");
include($root_path."includes/function.php");

$data = new class_mysql();
$data->config();
$data->access();
if(isset($_POST["TINHTRANG"])){
	$data1 = $_POST['TINHTRANG']; 
  $tmp = explode('*@!',$data1);  
  $id = laso($tmp[0]) ;
  $sign = laso($tmp[1]) ; 
   $ghichu = $tmp[2] ; 
	if($sign==0){
		$sql="update baolanhvienphi set tinhtrang=1,ghichubaohiem='$ghichu' where ID='$id'";
	}
	if($sign==1){
		$sql="update baolanhvienphi set tinhtrang=8,ghichubaohiem='$ghichu' where ID='$id'";
	}
	
	if($data->query($sql)){
		echo $sign.'-'.$id;	
	}else{
		echo -1;
	}
}
  



?>