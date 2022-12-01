<?php  
session_start();
 
 
 
 $root_path =getcwd()."/"  ;
 $quyen= $_SESSION["quyen"] ; 

 $ql =$quyen[$_SESSION["mangquyenid"][$_SESSION['act']]]  ;  
 //$ql='120000';
  $idl=$_SESSION["LoginID"];
 // _dump($ql);
//$_dump($_SESSION["mangquyenid"]['baocaokhuyenmai']);
//$ql[5]=5;
 if( !($ql[0] || $idl==1) ){return;}

include($root_path."includes/config.php");
include($root_path."includes/removeUnicode.php");
include($root_path."includes/class.paging.php");
include($root_path."includes/class.mysql.php");
include($root_path."includes/function.php");
 

 
   
$data = new class_mysql();
$data->config();
$data->access();
if($_POST['GOITK']){
	 $data1 = $_POST['GOITK']; 
  $tmp = explode('*@!',$data1);
 
        
        $iddk= trim($tmp[0]);
	
	$sql="select no,co,thongtin from dinhkhoanthuchi where ID='$iddk'";
	$dong=getdong($sql);
	
   
	if($dong){
			 $tkno=composx('dinhkhoan','madinhkhoan',$dong['no'],'');
			$tkco=composx('dinhkhoan','madinhkhoan',$dong['co'],'');
		echo "###1###$tkno###$tkco###$dong[thongtin]";
	}
	else{
		//echo "###-1###Không tìm thấy nhân viên!";
	}
	return;
}

if($_POST['GOITENNV']){
	 $data1 = $_POST['GOITENNV']; 
  $tmp = explode('*@!',$data1);
 
        
        $manv= trim($tmp[0]);
					
    $tennv=gettennv('userac',$manv,'Ten','MaNV');
	if($tennv){
		echo "###1###$tennv";
	}
	else{
		echo "###-1###Không tìm thấy nhân viên!";
	}
	return;
}

 if($_POST['GOITENNH']){
	 $data1 = $_POST['GOITENNH']; 
  $tmp = explode('*@!',$data1);
 
        
        $manv= trim($tmp[0]);
					
    $tennv=gettennv('taikhoannganhang',$manv,'tenchutaikhoan','ma');
	if($tennv){
		echo "###1###$tennv";
	}
	else{
		echo "###-1###Không tìm thấy ngân hàng!";
	}
	return;
}

	
 if($_POST['LUUSUA']){
	 $data1 = $_POST['LUUSUA']; 
  	$tmp = explode('*@!',$data1);
 
        $IDcha= $tmp[0];
		$note=  addslashes($tmp[1]);
		$dongia= str_replace(",",'',$tmp[2]);
		$ngaysua= $tmp[3];
		$loaitk= $tmp[4];
		$phieuxuat=$tmp[5];
		$psno=str_replace(",",'',$tmp[6]);
		$psco=str_replace(",",'',$tmp[7]);
		$donvi= $tmp[8];
		$soluong= $tmp[9];
		$dongia= str_replace(",",'',$tmp[10]);
		$tkno= $tmp[11];
		$tkco= $tmp[12];
		$hdbh= $tmp[13];
		$sotknh= $tmp[14];
		$tentknh= $tmp[15];
		$mavandon= $tmp[16];
		$ncc= $tmp[17];
		$manv=$tmp[18];
		$lydo= $tmp[19];
       $idphieu= $tmp[20];
	   $loaiphieu= $tmp[21];
	    $dvvc= $tmp[22];
		$phithukh= $tmp[23];
if($phieuxuat){

	$sql="select ID  from phieuxuat where SoCT='$phieuxuat'";
	//echo $sql;
	$dong=getdong($sql);
	if(!$dong["ID"]){
		echo "###-1###Phiếu xuất ko tồn tại!";
		return;
	}
	
	$phieuxuat=$dong["ID"];
}	   
	   
	   
	$sql="update thuchikt set IDcha='$IDcha',note='$note',dongia='$dongia',ngaysua='$ngaysua',IDcha='$IDcha',phieuxuat='$phieuxuat',psno='$psno',psco='$psco',donvi='$donvi',soluong='$soluong',dongia='$dongia',tkno='$tkno',tkco='$tkco',hdbh='$hdbh',sotknh='$sotknh',tentknh='$tentknh',mavandon='$mavandon',ncc='$ncc',manv='$manv',lydo='$lydo',tinhtrang=5,luachon='$loaiphieu',donvivc='$dvvc',phithukh='$phithukh' where ID=$idphieu";
		
	
    $update=$data->query($sql);
	if($update){
		echo "###1###Đã lưu";
	}
	else{
		echo "###-1###Có lỗi xảy ra!";
	}
	return;
}

function gettennv($table,$ID,$cot,$cotim)
{
   global $data ;
 	$sql = "select ID,$cot from $table where  $cotim='$ID' " ;
		
     $result = $data->query($sql) ;
 	$row = $data->fetch_array($result);	
	// echo  $sql ;			
		return $row[$cot] ;		
}
$data->closedata() ;
?>
