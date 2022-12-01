<?php  
session_start();
if ($_SESSION["LoginID"]=="") return ;
$root_path =getcwd()."/"  ;
include($root_path."biensession.php");
include($root_path."includes/config.php");
include($root_path."includes/removeUnicode.php");
include($root_path."includes/class.mysql.php");
include($root_path."includes/function.php");
$idk = laso($_SESSION["LoginID"]) ; if ( $idk != 1) return ;

   
   $data = new class_mysql();
   $data->config();
   $data->access();
  /* $data1 = $_POST['DATA']; 
   $tmp = explode('*@!',$data1);
   $id = laso($tmp[0]);
   $loai = $tmp[1] ;
   $xuatnhap = $tmp[2] ;
   $lydo = addslashes($tmp[3]) ; 
   $ngayxuly= gmdate('Y-m-d H:i:s', time() + 7*3600) ;
   $ngaychan= gmdate('Y-m-d', time() + 7*3600 -96*3600) ;*/
	huyphieutudong(1);
function huyphieutudong($id){
	global $data;
 $ngayxuly= gmdate('Y-m-d H:i:s', time() + 7*3600) ;
		 $mtam = taomang("xuatbanhang","IDSP","SoLuong"," where IDPhieu = '0$id'  ") ;
		   $mtamx = serialize($mtam);
		  
		  $tam = getdong(" select dakhoa, SoCT,IDNhaCC,IDKho,SoCT,NguoiGiao from phieunhapxuat where ID = '$id' limit 1") ;
		  
		  if  ($tam["dakhoa"]!=1) {echo "*loi#không có phiếu này hoặc ngày phục hồi đã quá hạn $ngaychan !!!"  ;   return ;  }// néu không phải đa khóa thì thoát
		  $sophieu =$tam["SoCT"];
		 
			  foreach ($mtam as $key => $x)
			  { 	     
				  $data->query(" update products set SoLuong = SoLuong + $x where ID = '$key' ") ;  
				//  $tt = getdong(" select ID from hanghoacuahang where IDSP = '$key'  and IDcuahang =  '$tam[IDKho]'  " );
				 // if (laso($tt["ID"]) >0)			  
					$data->query("update hanghoacuahang set SoLuong = SoLuong + $x  where IDSP = $key  and IDcuahang =  $tam[IDKho]   "); 
		//		echo  " update products set SoLuong = SoLuong - $x where ID = '$key' <br>";
		//	echo  " update hanghoacuahang set SoLuong = SoLuong + $x  where IDSP = $key  and IDcuahang =  $tam[IDKho]  <br>";
			  }
		 
				  $sql = " insert into xuatbhchuakhoa  (IDPhieu,IDSP,mahang,tenpt,SoLuong,DonGia,LoaiTien,Thue,BaoHanh,Ghichu,chietkhau,Loai,idnv)   (select  IDPhieu,IDSP,mahang,tenpt,SoLuong,DonGia,LoaiTien,Thue,BaoHanh,Ghichu,chietkhau,Loai,idnv  from xuatbanhang  where IDPhieu = '0$id' )" ;
				  $data->query($sql);
				  
				if ( $tam['IDNhaCC'] >1)
				{
						  $sql = " select sum(b.SoLuong*(b.DonGia-(b.chietkhau*b.DonGia/100))) as tong   
			from phieunhapxuat a left join  xuatbhchuakhoa b on a.ID=b.IDPhieu where 1=1 and a.SoCT='$tam[SoCT]' group by a.SoCT    " ;
			
						  $tam3 = getdong($sql) ;
					 
						   $sql = " update customer set sotiendamua = sotiendamua - $tam3[tong] ,diemtichluy= diemtichluy - ". ($tam3['tong'] / 10000)." where ID = '$tam[IDNhaCC]'  " ;
							$data->query($sql);
			 } 		
			 
			 if($tam['NguoiGiao']){
			 		$sql="update phieukhuyenmai set ngaydung ='',idkhoa='',iddung='',sophieu='',cuahang='' where maso = '$tam[NguoiGiao]'";
	
	 				$update=$data->query($sql);
			 }
			
		
			  
					  $data->query("delete from  xuatbanhang  where  IDPhieu = '0$id'   "); 
		  $sql = " update phieunhapxuat set dakhoa = '2',dahuy = '1'    where ID = '0$id'  " ;
		  $data->query($sql);
		 
		   $sql = " insert into xuly   set chucnang = 'phục hồi phiếu bán hàng đã khóa : $sophieu',loai=1,noidungcu='$mtamx', lydo='phục hồi phiếu bán hàng đã khóa',ngayxuly='$ngayxuly' " ;
				  $data->query($sql);
		echo "*#tb#*Đã phục hồi thành phiếu chưa khóa xong !*#tb#*$sophieu*#";
}

   

     

  				
?>	