<?php  
session_start();
// if ($_SESSION["LoginID"] =='') { return ; }
 
$root_path =getcwd()."/"  ;
include($root_path."biensession.php");
//$_SESSION["goiroi"]='';
include($root_path."includes/config.php");
include($root_path."includes/removeUnicode.php");
include($root_path."includes/class.paging.php");
include($root_path."includes/class.mysql.php");
include($root_path."includes/function.php");
$_SESSION["UserName"] = -1;
 
 
$data = new class_mysql();
$data->config();
$data->access();
 $ngaykhoa= gmdate('Y-n-d', time() - 17*3600) ; $thangnamngay=gmdate('ynd', time() -17*3600) ;  // lui lại 1 ngày
 $gio = gmdate('H', time() -17*3600) ; $phut = gmdate('i', time() -17*3600) ;
	
    if ($gio!=01) return ;
     echo $gio;
 //$ngaykhoa= "2021-12-27" ;
 //  $_SESSION["goiroi"] =1 ;
 // $ngaykhoa="2021-11-26" ;
 // $thangnamngay = '211126';
  if ($_SESSION["goiroi"]==2) return ; else $_SESSION["goiroi"]= $_SESSION["goiroi"] +1;
 
 $sql = "   SELECT p.idkho,    c.Name ,c.macuahang,sum(x.DonGia*(1-1*x.chietkhau/100)*x.SoLuong) as tongtien,  (SELECT sum(pp.tigia) as vc  from phieunhapxuat pp 
where pp.Loai in (1,3) and pp.dakhoa =1 and pp.NgayNhap >= '$ngaykhoa' and pp.NgayNhap <= '$ngaykhoa' AND pp.idkho=c.ID 
)as vc
   from userac a inner join phieunhapxuat p on p.IDTao = a.ID left join 
  cuahang c on p.IDKho=c.ID inner join xuatbanhang x on p.ID = x.IDPhieu left join products d on x.IDSP = d.ID
	where p.Loai in (1,3) and p.dakhoa =1 and p.NgayNhap >= '$ngaykhoa' and p.NgayNhap <= '$ngaykhoa' group by c.ID    "  ;
  echo $sql."<br>";
  //return;
  $result = $data->query($sql); 
while($re = $data->fetch_array($result))
	{ $tongtien = $re['tongtien'] ; $id= $re['ID']; $IDKhoa =$re['IDKhoa']  ; $idkho =$re['idkho']  ;
	$macuahang =$re['macuahang']  ;
	   echo  '123'."<br>";
	 $sochungtu = "TTD_$idkho"."_$thangnamngay";
	 $re['tongtien'] = $re['tongtien'] -$re['vc'] ;
	// echo $re['tongtien'] -  $re['vc']. "<br>";
	$sql = "   SELECT ID from thuchich where  sochungtu='$sochungtu' ";$tam=getdong($sql);
	  $sql = "   SELECT ID from thuchikt where  sochungtu='$sochungtu' ";$tam2=getdong($sql);
 //	  echo  $sql . "<br>";
 //	  echo laso($tam['ID']) ;
	 if (laso($tam['ID'])==0)
	 {
	 
	 	$sql = "    INSERT INTO thuchich (loaitaikhoan,idnganhang,IDCha,sochungtu,ngaythuchi,ngaytao,note,sotien ,lydo,nguoinhan,nguoichi,donvi,
	loaitk,IDtao,IDSua,luachon,lydoN,tinhtrang,idkhoa,ngaykhoa) 
		 VALUES ('0','0','192','$sochungtu','$ngaykhoa','$ngaykhoa','Tự động tạo từ phần mềm','$re[tongtien]',
		  'Doanh Thu tự động từ phần mềm','','','','$idkho','1','1','1','Tu-dong-tao tu phan mem',1,1,'$ngaykhoa')";
  echo $sql."<br>"; 
      $data->query($sql); 
	  
	
	 }
	  if (laso($tam2['ID'])==0)
	 {
	   ///thu chi kt
		$sql = "    INSERT INTO thuchikt (IDcha,sochungtu,ngaythuchi,ngaytao,note,sotien ,lydo,nguoinhan,nguoichi,donvi,loaitk,IDtao,IDSua,luachon,lydoN,tinhtrang,idkhoa,ngaykhoa,tkno,tkco,psno,soluong,dongia,psco) 
		 VALUES ('97','$sochungtu','$ngaykhoa','$ngaykhoa','Tự động tạo từ phần mềm','$re[tongtien]',
		  'Doanh Thu tự động từ phần mềm','','','','$idkho','1','1','1','Tu-dong-tao tu phan mem',1,1,'$ngaykhoa','2517','2734','$re[tongtien]','','','')";
  echo $sql."<br>"; 
      $data->query($sql); 
	 
  }
	  
	}
 echo "đã xong";
  
    $data->closedata() ;
?>	