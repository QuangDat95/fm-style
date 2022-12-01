<?php  
session_start();
if ($_SESSION["LoginID"]=="") return ;
$root_path =getcwd()."/"  ;
include($root_path."biensession.php");
include($root_path."includes/config.php");
include($root_path."includes/removeUnicode.php");
include($root_path."includes/class.mysql.php");
include($root_path."includes/function.php");
$idk = laso($_SESSION["LoginID"]) ; if ( $idk == 0) return ;
  
   
   $data = new class_mysql();
   $data->config();
   $data->access();
   $data1 = $_POST['DATA']; 
   $tmp = explode('*@!',$data1);
   $id = laso($tmp[0]);
   $loai = $tmp[1] ;
   $xuatnhap = $tmp[2] ;
   $qua = trim($tmp[3]) ;
   $ngaykhoa= gmdate('Y-n-d H:i:s', time() + 7*3600) ;
   
     
      $mtam = taomang("xuatbhchuakhoa","IDSP","SoLuong"," where IDPhieu = '0$id'  ") ;
      $tam = getdong("select  nguoigiao,IDNhaCC,IDKho,SoCT,ngaykhoa from phieunhapxuat where ID = $id limit 1") ;
	  
 
     //====  kiem tra loi phieu=======================================================================
	    $sql = "select a.IDSP,a.mahang,b.codepro from xuatbhchuakhoa a left join  products b on a.IDSP = b.ID where a.IDPhieu = '0$id' and b.codepro <> a.mahang"; 
		$taml=getdong($sql);
 		if ($taml!='')
		{
			 echo "###Phiếu này có lỗi sai mã và ID liên hệ gấp quản trị phần mềm và tạo phiếu khác nhé !###$taml[mahang] $taml[mahang] #  $taml[IDSP] id=$taml[ID]     $sql"; return ; 
		}
     //========kiem tra loi phieuu================================================================
	 
	 	  
	   if ($tam['ngaykhoa']>0) $ngaykhoa =$tam['ngaykhoa'] ;
	 
		  foreach ($mtam as $key => $x)
		  { 	     
			 // $data->query(" update products set SoLuong = SoLuong - $x where ID = '$key' ") ;  
			//  $tt = getdong(" select ID from hanghoacuahang where IDSP = '$key'  and IDcuahang =  '$tam[IDKho]'  " );
			 // if (laso($tt["ID"]) >0)			  
 			  	$data->query("update hanghoacuahang set SoLuong = SoLuong - $x  where IDSP = $key  and IDcuahang =  $tam[IDKho]   "); 
 	//		echo  " update products set SoLuong = SoLuong - $x where ID = '$key' <br>";
	//		echo  " update hanghoacuahang set SoLuong = SoLuong - $x  where IDSP = $key  and IDcuahang =  $tam[IDKho]  <br>";
  		  }
	 
  			  $sql = " insert into xuatbanhang  (IDPhieu,IDSP,mahang,tenpt,SoLuong,DonGia,LoaiTien,Thue,BaoHanh,Ghichu,chietkhau,Loai,giavon,idnhom,idtao,idnv)   (select  IDPhieu,IDSP,mahang,tenpt,SoLuong,DonGia,LoaiTien,Thue,BaoHanh,Ghichu,chietkhau,Loai,giavon,idnhom,idtao,idnv  from xuatbhchuakhoa where IDPhieu = '0$id' )  " ;
 			  $data->query($sql);
 
			  
    if ( $tam['IDNhaCC'] >1)
	{
               
			  $sql = " select sum(b.SoLuong*(b.DonGia-(b.chietkhau*b.DonGia/100))) as tong   
from phieunhapxuat a left join  xuatbhchuakhoa b on a.ID=b.IDPhieu where 1=1 and a.SoCT='$tam[SoCT]' group by a.SoCT    " ;

		 	  $tam3 = getdong($sql) ;
		   if($qua!="true")
		   {
 			   $sql = " update customer set sotiendamua = sotiendamua + ".$tam3['tong']. ", diemtichluy= diemtichluy + ". ($tam3['tong'] / 10000)." where ID = '$tam[IDNhaCC]'  " ;
 	              $data->query($sql);
		   }
 } 			   
	  $data->query("delete from  xuatbhchuakhoa  where  IDPhieu = '0$id'   "); 
   	  $sql = " update phieunhapxuat set dakhoa = '1',IDKhoa='$idk', ngaykhoa = '$ngaykhoa'  where ID = '0$id'  " ;
	  $data->query($sql);
     

 if ( $tam['nguoigiao'] != '')
	{
	    $sql = " select  ID  from phieukhuyenmai where maso = '$tam[nguoigiao]' and ngayhethan>='$ngay' and sophieu is null  limit 1  " ;
     	$tam5= getdong($sql);
	    if ($tam5['ID']>0)  
		{
		  $sql = " update   phieukhuyenmai set ngaydung ='$ngaykhoa',idkhoa='$idk',iddung='$tam[IDNhaCC]',sophieu='$tam[SoCT]',cuahang='$tam[IDKho]' where maso = '$tam[nguoigiao]'    limit 1  " ;
		  $tam= getdong($sql);
		}

	}

	$data->closedata() ;
	
	echo "*#tb#*Đã Khóa phiếu xong !*#tb#*";
  	return ;

  				
?>	