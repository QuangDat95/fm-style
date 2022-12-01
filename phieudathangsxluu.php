<?php  
session_start();
$idk = $_SESSION["LoginID"] ; if (  $idk == '') return ;
 $idkho = $_SESSION["se_kho"] ;
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

if(isset($_POST["UPDATEHINH"])){
 $data1 = $_POST['UPDATEHINH']; 
  $tmp = explode('*@!',$data1);
  
 $chuoihinh  = trim($tmp[1])  ;
   
  $id = laso($tmp[2])  ;
   $tamchuoihinh='';
		
		 if($chuoihinh){
		 	$chuoihinh=json_decode($chuoihinh,true);
			foreach($chuoihinh as $key => $value){
				 $tamchuoihinh.='###'.$key;
			}
		 }	
		 
		 $sql="update phieudathangsx set tenN='$tamchuoihinh' where ID='$id'";
		 echo $data1;
		  $data->query($sql);	
return;
}
  $mpt = array () ;
  $mangud = array() ;
  $data1 = $_POST['DATA']; 
  $tmp = explode('*@!',$data1);
  $mang = explode('|@|',$tmp[1]);
  
   $i =0 ;
 
   foreach($mang as $x)
   {
     	$mpt[$i] = explode('|*|',$x); 
        $i  = $i + 1 ;	
   }
   
   	
		$sochungtu=$tmp[2];$tigia= ($tmp[4]);$lydoxuat=$tmp[5];$nguoigiao=$tmp[6];$idkhach=laso($tmp[7]);$ghichu=addslashes($tmp[8]);
		$vat=$tmp[9];$Loai=$tmp[10];$tenkhach=$tmp[11];$ghichucuahang=$tmp[12]; $nhanviendat=$tmp[13];  $tientra =str_replace(",","",$tmp[14]) ;	
		$ngaygiaohang =trim($tmp[15]) ;  $diem =str_replace(",","",$tmp[16]); $diem = substr($diem,strrpos($diem,'-')+1,strlen($diem)) ; $makm =trim($tmp[17]) ;$chuoihinh =trim($tmp[18]) ;
		 $tamchuoihinh='';
		
		 if($chuoihinh){
		 	$chuoihinh=json_decode($chuoihinh,true);
			foreach($chuoihinh as $key => $value){
				 $tamchuoihinh.='###'.$key;
			}
		 }
	 	//$tenkho = getten("kho",$xuatkho,"Name") ;
		
         $idgoi = laso($tmp[0]) ;
		 $nguoitao =$_SESSION["TenUser"]."_".$idk; // dùng lưu sau này phòng trường hợp bị đổi tên user để dùng lại 
  
		
		 
		 
	 
		 
		 $ngaytao = gmdate('Y-m-d H:i:s', time() + 7*3600) ;
		 $ngay =  explode('/',$tmp[1]);
   		 if (strlen($ngay[1])== 1) {  $ngay[1] = "0".$ngay[1] ;  }
	 	 if (strlen($ngay[0])== 1) {  $ngay[0] = "0".$ngay[0] ;  }
		 
		 
		  
   		 
		 
	//	 $ngayxuat = $ngay[2].'-'.$ngay[1].'-'.$ngay[0] ; // có the sau nay lay theo nguoi tao de có thẻ nhap lui
		  $ngayxuat =gmdate('Y-m-d', time() + 7*3600) ;
	//	 echo $idgoi ;
	
	
					
					
 		if( $idgoi == 0 )
		{
	 
		// $idnha la id cap nhap lan thu n, idtao là id tạo ra phiéu này, idtao va idnhap thong thuong trung nhau
		$tam = getdong(" select ID from phieudathangsx where SoCT ='$sochungtu' limit 1 ") ;
   	    if ($tam["ID"]  != ""  )
				 {
		
		//	 echo "Trùng số chứng từ !!! " ; return ; }   
		//=======================================================================================
		   $thang = gmdate('m', time() + 7*3600); 
		   $nam = gmdate('y', time() + 7*3600); 
		   $so = strlen($idkho) + 9;
		   $sql = "select   max(convert( mid(SoCT,$so,22),UNSIGNED INTEGER))as sp from phieudathangsx  where loai ='1' and  IDKho='1' and  mid(SoCT,4,2) = '$thang' " ;
 		   $kq = $data->truyvan($sql) ;		
		   $sp = laso($kq['sp']) + 1 ;
		   if (strlen($sp)== '1' ) $sp = "00". $sp ;
		   if (strlen($sp)== '2' ) $sp = "0". $sp ;
		   $sochungtu ="D".$nam.$thang.$_SESSION["S_MaNV"].".".$idkho.".".$sp ; 
		   $sochungtu2 ="D".$nam.$thang.$_SESSION["S_MaNV"].".".$idkho.".".($sp+1) ; 
		   
		}
	   $tam = getdong(" select ID from phieudathangsx where SoCT ='$sochungtu' limit 1 ") ;
   	   if ($tam["ID"]  != ""  ) $sochungtu= $sochungtu2  ;
				 
		
		$sql = "insert into phieudathangsx   set Loai='1' ,IDKho ='$idkho',IDNhaCC ='$idkhach' ,IDNhap ='$id' ,NgayNhap ='$ngayxuat' ,SoCT='$sochungtu' ,LyDo='$lydoxuat' ,SoNgayNo='$ngaygiaohang' ,IDTKNo='0' ,IDTKCo='0' ,TiGia ='$tigia' ,VAT='$vat' ,GhiChu='$ghichu' ,NgayTao='$ngaytao' ,IDTao='$idk' ,NguoiGiao='$makm' ,ten='$khach[Name]',diachi='$ghichucuahang', tenlydo='$tenlydo'  ,diachiN='$nhanviendat' ,nguoitao='$nguoitao',tientra='$tientra',tenN='$tamchuoihinh'  "  ;
		 
 		 $data->query($sql);	
	  
		  
		    $idphieu = getdong(" select ID from phieudathangsx where  SoCT = '$sochungtu'  ");
			$idphieu = $idphieu['ID'];
		 
			
 			$sql = "INSERT INTO phieudathangsxchitiet (IDPhieu,IDSP,mahang,tenpt,SoLuong,DonGia,LoaiTien,Thue,BaoHanh,Ghichu,chietkhau,Loai,giavon,idnhom) VALUES "; 
			$sqlu = "" ;$sqlt ="";	
			
 			
			$tien =0;		
 			foreach($mpt as $x)
			{  
			  
				   if ($Loai=='0') {$dau = "+";$t3= laso($x[3]) ;}else{$dau="-";$t3= -(laso($x[3])) ;}
				   $t0= $x[0] ;$t1= $x[1] ;$t2= $x[2] ;$t4= laso($x[4]) ;$t5= $x[5] ;$t6= $x[6] ;$t7= $x[7] ;
				    $tenpt =getdong(" select Name,price,codepro,idgroup,giabinhquan from products where ID= $t0 limit 1"); $gia = $tenpt['giabinhquan'] ;
					 $nhom = $tenpt['idgroup'] ;
					$tien=$tien + $t3 *($t4-($t5*$t4/100))  ;
					$codepro=$tenpt['codepro']  ;
					$tenpt = addslashes($tenpt['Name']) ;
					if($sqlu == "")  
					{		     // IDPhieu   ,IDSP,mahang,tenpt,   SoLuong,DonGia,LoaiTien,Thue,BaoHanh,Ghichu,chietkhau,Loai,giavon			
						 $sqlu =  "('$idphieu','$t0','$codepro','$tenpt','$t3','$t4','$t6','0','0','$t7','$t5','1','$gia','$nhom')";	
					}else
					{
						 $sqlu .= ",('$idphieu','$t0','$codepro','$tenpt','$t3','$t4','$t6','0','0','$t7','$t5','1','$gia','$nhom')";	
					}
				
 				   $sl = abs($t3);
					 
			//	  $data->query("update products set SoLuong = SoLuong - $sl  where ID ='$t0' ");
 			//	  $data->query("update hanghoacuahang set SoLuong = SoLuong - $sl  where IDSP ='$t0' and IDcuahang = '$idkho'  "); 
  				 
			}
			$sql .= $sqlu  ;  
 		    $update = $data->query($sql);
			//if($tamchuoihinh){
				//var_dump(luuanhApi(array("save"=>true,"iduser"=>$_SESSION["LoginID"],"data"=>$tamchuoihinh)));
			//}
			
			echo "**#$idphieu**#$sochungtu**#" ;
		 	
			   
            return ;		 
		}   // else của them mới
		else
		{   //  $idgoi <>0 cập nhập
		
		
		    $st = getdong(" select ID,dakhoa from phieudathangsx where ID='$idgoi' and  SoCT ='$sochungtu'   ") ;
			if ( laso($st['dakhoa']) == 1) { echo "#*#*Phiếu đã khóa  !!! " ; return ; } 
			if ( laso($st['ID']) == 0) { echo "#*#*Phiếu không tồn tại !!! " ; return ; } 
			
		   $st = getdong(" select ID from phieudathangsx where ID <> '$idgoi' and  SoCT ='$sochungtu' ") ;
	       if (trim($st['ID'])!= "") { echo "#*#*Trùng số chứng từ khi lưu !!! " ; return ; } 
	 	    
			 
		   $sql = " update phieudathangsx   set    IDKho ='$idkho',IDNhaCC ='$idkhach'  ,diachiN='$nhanviendat' ,NgayNhap ='$ngayxuat'  ,LyDo='$lydoxuat' ,SoNgayNo='$ngaygiaohang' ,IDTKNo='0' ,IDTKCo='0' ,TiGia ='$tigia' ,VAT='$vat' ,GhiChu='$ghichu' ,NgayTao='$ngaytao' ,IDTao='$idk' ,NguoiGiao='$makm' ,ten='$khach[Name]',diachi='$ghichucuahang', tenlydo='$tenlydo' ,nguoitao='$nguoitao',tientra='$tientra',tenN='$tamchuoihinh'  where ID = '$idgoi'"  ;
 		   $data->query($sql);	
		   
		   $data->query(" delete from phieudathangsxchitiet where IDPhieu='$idgoi'    ");
		      $sql = "INSERT INTO phieudathangsxchitiet (IDPhieu,IDSP,mahang,tenpt,SoLuong,DonGia,LoaiTien,Thue,BaoHanh,Ghichu,chietkhau,Loai,giavon,idnhom) VALUES "; 
		   // $sql = "INSERT INTO xuatbhchuakhoa (IDPhieu,IDSP,mahang,tenpt,SoLuong,DonGia,LoaiTien,Thue,BaoHanh,Ghichu,chietkhau,Loai) VALUES "; 
			$sqlu = "" ;$sqlt ="";	
 			foreach($mpt as $x)
			{  
 				   $t0= $x[0] ;$t1= $x[1] ;$t2= $x[2] ;$t3= laso($x[3]) ;$t4= laso($x[4]) ;$t5= $x[5] ;$t6= $x[6] ;$t7= $x[7] ;
				   $tenpt =   getdong(" select Name,price,idgroup,giabinhquan from products where ID= $t0 limit 1 ");	 	$gia = $tenpt['giabinhquan'] ;
					$nhom = $tenpt['idgroup'] ;$tenpt = addslashes($tenpt['Name']) ;
					if($sqlu == "")  
					{		     //0idsp,1ten,2code,3soluong,4dongia,5thue,6loaitien,7ghichu)			
						 $sqlu =  "('$idgoi','$t0','$t1','$tenpt','$t3','$t4','$t6','0','0','$t7','$t5','1','$gia','$nhom')";		
					}else
					{
						 $sqlu .= ",('$idgoi','$t0','$t1','$tenpt','$t3','$t4','$t6','0','0','$t7','$t5','1','$gia','$nhom')";	
					}
  			}
				$sql .= $sqlu  ;
				 
 		    $update = $data->query($sql);
			
			
			echo "**#$idgoi**#" ;
	 }
 
       
// echo $sql ; 
	    $data->closedata() ;
  	return ;



function luuanhApi($data){
	$curl = curl_init();
	
	curl_setopt_array($curl, array(
	  CURLOPT_URL => 'https://image.fmstyle.com.vn/upanhsanphamluu.php?type=dathangsx&save=1',
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_ENCODING => '',
	  CURLOPT_MAXREDIRS => 10,
	  CURLOPT_TIMEOUT => 0,
	  CURLOPT_FOLLOWLOCATION => true,
	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	  CURLOPT_CUSTOMREQUEST => 'POST',
	  CURLOPT_POSTFIELDS =>json_encode($data),
	  CURLOPT_HTTPHEADER => array(
		'Content-Type: application/json',
		'Cookie: PHPSESSID=8c3tfo55m50n22lamuqjihueu7'
	  ),
	));
	
	$response = curl_exec($curl);
	
	curl_close($curl);

	return $response;
}

    			
?>	