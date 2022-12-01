<?php
 session_start();
 
 $idl=$_SESSION["LoginID"] ;
 
$IDCH = $_SESSION["se_kho"] ; 
$root_path =getcwd()."/"  ;
// include($root_path."biensession.php");
include($root_path."includes/config.php");
include($root_path."includes/removeUnicode.php");
include($root_path."includes/class.paging.php");
include($root_path."includes/class.mysql.php");
include($root_path."includes/function.php");
include($root_path."includes/function_local.php");
include($root_path."includes/xlsxwriter.class.php"); 
//  //if ($us =="" || $id == "" ) { echo " Ban chua dang nhap!!! " ;return ;}
  
$data = new class_mysql();
$data->config();
$data->access();
  
$data1="nothing";

if(isset($_POST["TINH"])){
	 $data1 = chonghack($_POST['TINH']); 
	// echo $data1."abcs";

	 $tmp = explode('*@!',$data1);

	$idtinh=$tmp[0];
	$sql="select * from quan where idtinh=".$idtinh;
	
	$query_districts = $data->query($sql);
	$arrtmp=[];
	$chuoithanhpho ='<option value="0" >Chọn quận... </option>';
	while($result_district = $data->fetch_array($query_districts)){
	$arrtmp=$result_district;
	$chuoithanhpho.='<option value="'.$result_district['ID'].'">'.$result_district['loai'].' '.$result_district['Name'].'</option>';
	}  
 	 echo $chuoithanhpho;
	 return;

}


if(isset($_POST["THANH"])){   
	$data1 = chonghack($_POST['THANH']); 
	$tmp = explode('*@!',$data1);

	$idtinh=$tmp[0];
	$idthanhpho=$tmp[1];
	$sql="select * from phuong where idtinh=".$idtinh." and idquan=".$idthanhpho;
	
	$query_districts = $data->query($sql);
	$arrtmp=[];
	$chuoiphuongxa ='<option value="0" > </option>';
	while($result_district = $data->fetch_array($query_districts)){

		$chuoiphuongxa.='<option value="'.$result_district['ID'].'">'.$result_district['loai'].' '.$result_district['Name'].'</option>';

	  }
	echo $chuoiphuongxa;
	return;

}


if(isset($_POST["PHUONG"])){   
	$data1 = chonghack($_POST['PHUONG']); 
	$tmp = explode('*@!',$data1);

   $idtinh=$tmp[0];
   $idthanhpho=$tmp[1];
   $idquan=$tmp[2];
   $sql="select * from duong where idtinh=".$idtinh." and idquan=".$idthanhpho."idquan=".$idquan;
   echo $sql;
   $query_districts = $data->query($sql);
   $arrtmp=[];
   $chuoiduong ='<option value="0" > </option>';
   while($result_district = $data->fetch_array($query_districts)){

	   $chuoiduong.='<option value="'.$result_district['id'].'">'.$result_district['loai'].' '.$result_district['Name'].'</option>';

	 }
   echo $chuoiduong;
   return;

}


?>