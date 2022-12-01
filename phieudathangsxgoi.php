<?php  
session_start();
$root_path =getcwd()."/"  ;
include($root_path."biensession.php");
include($root_path."includes/config.php");
include($root_path."includes/removeUnicode.php");
include($root_path."includes/class.paging.php");
include($root_path."includes/class.mysql.php");
include($root_path."includes/function.php");
include($root_path."includes/function_local.php");
 
//  //if ($us =="" || $id == "" ) { echo " Ban chua dang nhap!!! " ;return ;}
  
$data = new class_mysql();
$data->config();
$data->access();




  $data1 = $_POST['DATA']; 
  $tmp = explode('*@!',$data1);
  $id  = trim($tmp[1])  ;
   
  $dakhoa = laso($tmp[2])  ;		 
  
  $sql = "SELECT *,DATE_FORMAT(NgayNhap,'%d/%m/%Y') as ngay FROM phieudathangsx   where ID = '$id'  and dakhoa ='$dakhoa'  ";
  // echo $sql ;
	//	$sql = " select DATE_FORMAT(c.NgayNhap,'%d/%m/%Y') as ngay,a.DonGia, " ;
	$result = $data->query($sql);    
    $re = $data->fetch_array($result) ;
	$re['tenkho'] = getten('cuahang',$re['IDKho'],'Name');
	if (count($re)<=2) return ;
	echo implode("@$@",$re) ;
	 
    $sql = "SELECT a.ID,a.IDPhieu,a.IDSP,a.mahang,a.SoLuong,a.DonGia,a.LoaiTien,a.tenpt,a.Thue,a.BaoHanh,a.Ghichu,a.Loai,a.chietkhau,b.NameN  FROM phieudathangsxchitiet a left join products b on a.IDSP =b.ID where a.IDPhieu = '$id'  ";
 //	echo $sql; 
	$result = $data->query($sql);    
    echo "&$&" ;
	$i = 0 ;
	while ($re = $data->fetch_array($result) )
	{  
		if ($i == 0 ) { echo implode("@$@",$re) ; } else { echo "@$&".implode("@$@",$re) ;}
		$i =1 ;
    }
	
	$data->closedata() ;
?>	