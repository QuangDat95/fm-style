<?php   
session_start();
$id = $_SESSION["LoginID"]  ; if ( $id == "") return ;

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
  $mpt = array () ;
  $mangud = array() ;
  $data1 = $_POST['DATA']; 
  $xoa =  $_POST['DATAD']; 
  $tmp = explode('*@!',$data1);
 //  $mang = explode('|@|',$tmp[0]);
   $i =0 ;
   $nguoitao = $ten ;
   $tenN = khongdau($tenkhach);$diachiN = khongdau($diachi) ;	
   if ($xoa != '')
   {
	   
	   $tmp = explode('*@!',$xoa);
	 //  echo $tmp[1] ;
	   	 $sql = " select ID from congnoncc where idnhacc='$tmp[1]'    order by ngaytao desc,ID desc limit 1  "; $IDLonNhat=getdong($sql);$IDLonNhat=$IDLonNhat['ID'];
		//echo $IDLonNhat ;echo $sql ;
 	    $sql = " delete from congnoncc where ID = '$tmp[0]' and ID='$IDLonNhat' " ; 
		$data->query($sql);
	   return ;
   }
   
		 $ngay =  explode('/',$tmp[1]);
		 if (strlen($ngay[1])== 1) {  $ngay[1] = "0".$ngay[1] ;  }	 if (strlen($ngay[0])== 1) {  $ngay[0] = "0".$ngay[0] ;  }
		 $ngaynhap = $ngay[2].'-'.$ngay[1].'-'.$ngay[0] ;
	
	    $loaitk=$tmp[0];$sochungtu=$tmp[2];
		$ngaytao = gmdate('Y-n-d H:i:s', time() + 7*3600) ;
		$ngay=$ngaynhap;$note=$tmp[9];$lydo=$tmp[4];     $nguoinhan=$tmp[5];		        $nguoichi=$tmp[6];  $idnhacc =$tmp[8];
	    $IDtao= $id;$IDSua ="" ; $luachon =$tmp[11]; $lydoN =khongdau($lydo);
        $dongia=laso($tmp[7]);
		
	    $sotien= laso($tmp[3]);
	    $soluong=laso($tmp[12]);
		if($dongia>0 &&$soluong>0) $sotien=$dongia*$soluong;
		$idgoi = $tmp[10] ; 
		$IDtao = '$id';
		$sodu = 0 ;
		//========================bat loi khong dung du lieu===========================
         if ($loaitk==0) { echo "Loại tài khoản chưa chọn !!!" ; return ;}
		//===================================================		 
 	 
 		if(trim($idgoi) == '' )
		{
	//=====================tao so phieu========================================== 
    $thang = gmdate('m', time() + 7*3600);  
   $nam = gmdate('y', time() + 7*3600); 
   $so = strlen($id) + 10; 
    $sql = "select  MAX(CONVERT(MID(sochungtu,$so,22 ),UNSIGNED INTEGER))   as sp from congnoncc 
	 where  mid(sochungtu,6,2) = '$thang'  and mid(sochungtu,4,2) = '$nam'   " ; // khong dung duoc do no kg dung theo kho ma dung theo id
 // echo $sql ;
   $kq = $data->truyvan($sql) ;		
   $sp = laso($kq['sp']) + 1 ;
   if (strlen($sp)== '1' ) $sp = "00". $sp ;
   if (strlen($sp)== '2' ) $sp = "0". $sp ;
   	if ($loaitk==1)  $sochungtu ="CNT".$nam.$thang.".".$id.".".$sp ; else   $sochungtu ="CNC".$nam.$thang.".".$id.".".$sp ;  		
			
	//===================================================		
		   
			  $sql = " select sodu from congnoncc where idnhacc='$idnhacc'    order by ngaytao desc,ID desc limit 1  ";
			$tam =getdong($sql);
		 
			if ($loaitk==1) $st= - $sotien ; else $st= $sotien ; 
			$sodu = laso($tam['sodu']) + $st ; 
		
			$sql = " INSERT INTO congnoncc
			set  soluong = '$soluong',dongia = '$dongia',IDtao='$id', sochungtu='$sochungtu',ngay='$ngaynhap',ngaytao='$ngaytao',note='$note',sotien='$st',lydo='$lydo',nguoinhan='$nguoinhan',nguoichi='$nguoichi',donvi='$donvi',loaitk='$loaitk' ,IDSua='$id',luachon='$luachon',lydoN ='$lydoN',idnhacc='$idnhacc',sodu='$sodu'  "; 
			$data->query($sql);	
			  $sql = " select ID from congnoncc where sochungtu='$sochungtu'    order by ngaytao desc,ID desc limit 1  ";
			  $tam =getdong($sql); echo "**#".$tam['ID']."**#";
			  
 		} else
		{
		//$st = " congnoncc where ID <> '$idgoi' and  sochungtu ='$sochungtu' " ;
	    // if (getid($st) != "") { echo "Tr&#249;ng  s&#7889; ch&#7913;ng t&#7915; " ; return ; }          
		 //============================tim so du truoc no====================================================
		// $sql = "SELECT sodu,ID  FROM congnoncc   where idnhacc='$idnhacc' and ngay<='$ngaynhap'   ORDER BY  ngay desc,ID desc" ;
		// $result = $data->query($sql); $laysau = false ;$sodu = 0 ;
  	//	 while($re = $data->fetch_array($result))
	//	 {
	//		if ($laysau == true) 
	//		{
   	//			$sodu = laso($re['sodu'])  ;				
	//			break ;
 	//		}
	//		if ( $re['ID'] == $idgoi ) { $laysau = true ;}
 	//	 }
		// if ($loaitk==1) $st= - $sotien ; else $st= $sotien ;
		// $sodu = $sodu + $st ;
		   $sql = " select ID from congnoncc where idnhacc='$idnhacc'    order by ngaytao desc,ID desc limit 1  "; $IDLonNhat=getdong($sql);$IDLonNhat=$IDLonNhat['ID'];
		 
		   
		   if($idgoi==$IDLonNhat){
			   
			   			  $sql = " select sodu from congnoncc where idnhacc='$idnhacc' and ID <> $idgoi   order by ngaytao desc,ID desc limit 1  ";
			$tam =getdong($sql);
			if ($loaitk==1) $st= - $sotien ; else $st= $sotien ;
		 
			$sodu = laso($tam['sodu']) + $st ; 
			
			
 		   $sql = " update congnoncc set  soluong = '$soluong',dongia = '$dongia',sodu='$sodu', ngay='$ngaynhap',ngaysua='$ngaytao',note='$note',sotien='$st',lydo='$lydo',nguoinhan='$nguoinhan',nguoichi='$nguoichi',donvi='$donvi',loaitk='$loaitk' ,IDSua='$id',luachon='$luachon',lydoN ='$lydoN',idnhacc='$idnhacc'  where ID = '$idgoi' and ID=$IDLonNhat "  ;
   	 	$t =$data->query($sql);	}
		 
 
// return ;
		
	//  $tam =getdong("SET @stt=0;");
//	  $tam =getdong("SET @vt=0;");

//	   $sql = "  select ID,sotien,loaitk from (  select  @stt:=@stt+1 AS st,ID,sotien,loaitk ,IF(ID=$idgoi,@vt:=@stt,1) as yy  from congnoncc where idnhacc='$idnhacc' and ngay>='$ngaynhap'  order by   ngay desc,ID desc  limit 20  ) aa where st < @vt order by st desc    ";
 		//  	echo  $sql  ;
		//  return ;
	//	$sodu = 0 ;

 //  $sql = " select ID,sotien,loaitk from congnoncc where idnhacc='$idnhacc' order by ngay ,ID " ;
 //  echo $sql ;
 //	$result = $data->query($sql);
 // 			while($re = $data->fetch_array($result))
	///			{
	//			 if ($re['loaitk']==1) $st= - $re['sotien'] ; else $st= $re['sotien'] ;
 	//			 $sodu = $sodu + $st ; 
					 
	//				$sql = " update congnoncc set  sodu='$sodu' where ID =  '$re[ID]' and idnhacc='$idnhacc' " ; //echo  $sql  ;
	//			   $data->query($sql);
	//			} 
		  
	 	}
  
	    $data->closedata() ;
  	return ;

  				
?>	