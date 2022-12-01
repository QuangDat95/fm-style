<?php 
session_start();
$id = $_SESSION["LoginID"] ;

 if ($id =="") return ;
 $idch = $_SESSION["se_kho"] ;
 
$root_path =getcwd()."/"  ;
include($root_path."biensession.php");
include($root_path."includes/config.php");
include($root_path."includes/removeUnicode.php");
include($root_path."includes/class.paging.php");
include($root_path."includes/class.mysql.php");
include($root_path."includes/function.php");
include($root_path."includes/function_local.php");
   
  
$data = new class_mysql();
$data->config();
$data->access();
$uploadDirectoryimages=$root_path.'images/produtcs/';
if(isset($_POST['DATA'])){
	$data1 = $_POST['DATA']; 
 	 $tmp = explode('*@!',$data1);
 
         $ngaytao = gmdate('Y-n-d H:i:s', time() + 7*3600) ;
        $idsp= trim($tmp[0]);
		$diemcl= laso($tmp[1]);
		$diemmau= laso($tmp[2]);
		$ghichu= chonghack($tmp[3]);
	if(checkdg($idsp,$id)){
		echo "###Bạn đã đánh giá sản phẩm này trước đó!###";
		return;
	}
	
  $sql="insert into  danhgiasanpham  (Name,codepro,IDsp,gia,ngaytao,chatlieu,mauma,mausac,IDNV,IDCH,ghichu,code) select a.Name,a.codepro,$idsp,price,'$ngaytao',$diemcl,'',$diemmau,$id,$idch,'$ghichu',code from products a where ID=$idsp";
 
  $update=$data->query($sql);
  if($update){
  	echo "###Đã lưu###";
  }
  else
  {
  	echo "###Có lỗi xả ra! vui lòng thử lại###";
  
  }
  return;
 }
 
 if(isset($_POST['DATAGOC'])){
	$data1 = $_POST['DATAGOC']; 
 	 $tmp = explode('*@!',$data1);
 
         $ngaytao = gmdate('Y-n-d H:i:s', time() + 7*3600) ;
        $code= trim($tmp[0]);
		$diemcl= laso($tmp[1]);
		$diemmau= laso($tmp[2]);
		$ghichu= chonghack($tmp[3]);
	if(checkdgoc($code,$id)){
		echo "###Bạn đã đánh giá sản phẩm này trước đó!###";
		return;
	}
	$sql="insert into  danhgiasanpham  (Name,codepro,IDsp,gia,ngaytao,chatlieu,mauma,mausac,IDNV,IDCH,ghichu,code) values ('','','','','$ngaytao',$diemcl,'',$diemmau,$id,$idch,'$ghichu','$code')";
	/*$sql="select * from products where code='$code'";
	$query=$data->query($sql);
	$chuoiinsert='';
	while($re=$data->fetch_array($query)){
			$chuoiinsert.="('$re[Name]','$re[codepro]','$re[ID]','$re[price]','$ngaytao',$diemcl,'',$diemmau,$id,$idch,'$ghichu','$code'),";
	}
	$chuoiinsert=rtrim($chuoiinsert,",");
  $sql="insert into  danhgiasanpham  (Name,codepro,IDsp,gia,ngaytao,chatlieu,mauma,mausac,IDNV,IDCH,ghichu,code) values $chuoiinsert";*/

  $update=$data->query($sql);
  if($update){
  		echo "###Đã lưu###";
  }
  else
  {
  	echo "###Có lỗi xả ra! vui lòng thử lại###";
  
  }
  return;
 }
  function checkdgoc($code,$idnv){
 	$sql="select count(ID) as c from danhgiasanpham where IDNV=$idnv and IDSP=$code";
	
	$dong=getdong($sql);
	if($dong['c']>0){
		return true;
	}
	else{
		return false;
	}
 }
 function checkdg($idsp,$idnv){
 	$sql="select count(ID) as c from danhgiasanpham where IDNV=$idnv and IDSP=$idsp";
	
	$dong=getdong($sql);
	if($dong['c']>0){
		return true;
	}
	else{
		return false;
	}
 }
    $data->closedata() ;
?>	