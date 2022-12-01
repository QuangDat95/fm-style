<?php  
session_start();

$id = $_SESSION["LoginID"]  ;  
 if($id ==9901 ||$id==5475 ||$id==10824 ) $id =1;
 
$quyen= $_SESSION["quyen"] ; 
$ql =$quyen[$_SESSION["mangquyenid"]["baocaodoanhthu"]]  ;  
if( $ql[0]!=1  ){return;}
 $idkho=$_SESSION["se_kho"]  ;
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

  $data1 = $_POST['DATA']; 
  $tmp = explode('*@!',$data1);
 
        $ten   =  ($tmp[0])   ;
        $ma= trim($tmp[1])  ;
		$nhom= laso($tmp[2]) ;
		$kho= trim($tmp[3]) ;
		$tu= trim($tmp[4]) ;
		$den= trim($tmp[5]) ;
		$trang= laso($tmp[6]) ;
		$IDNV= laso($tmp[7]) ;
		$loai= laso($tmp[8]) ;
		$nhomhang= laso($tmp[9]) ;
		$mota= chonghack($tmp[10]) ;
		$khuvuc= laso($tmp[12]) ;
		$luachon= laso($tmp[11]) ; 
		$ncc= laso($tmp[14]) ;  
		 $ngayhientai=gmdate('Y-m-d', time() + 7*3600) ;
		  $sqlm = " and m.dakhoa =1 "; 
		  $sqlm2 = "  ";  
	      $sqlm3  = " and  m.NgayNhap >= '$ngayhientai'"; 
		  $sql_where=" where p.Loai  in (1,3,5) and p.dakhoa =1 "; 
		  $sql_where1 =" where 1 "; 
	      $sql_where2  = " and left(soct,5) !='NK-BD' " ;
		  $sql_where3  = "" ;
		  $sql_where4  = "" ;  $sql_where5  = "" ;
		  $sql_wheren ="  ";  $sqllc  ="" ;  
		  
		  if($loai == "10" && laso($kho)==0)  $kho=$idkho ;
		
	 if ($luachon ==1) { $sql_where .=" and (x.DonGia*(1-1*x.chietkhau/100)) <> d.price "; }
	 if ($luachon ==2) { $sql_where .=" and (x.DonGia*(1-1*x.chietkhau/100)) = d.price "; }
	 if ($luachon ==3) { $sql_where .=" and  p.tigia  >0 "; }
	 if ($luachon ==4) { $sql_where .=" and  p.idnhacc  >1 "; }
	 if ($luachon ==-1) { $sql_where .=" and p.diachiN=0 and DATE_FORMAT(p.NgayTao,'%H') >= 7 and   DATE_FORMAT(p.NgayTao,'%H') <= 15"; }    // khong tu van ca 1
	 if ($luachon ==-2) { $sql_where .=" and p.diachiN=0 and DATE_FORMAT(p.NgayTao,'%H') > 15 and   DATE_FORMAT(p.NgayTao,'%H') <= 24"; }    // khong tu van ca 1
	 if ($luachon ==-5) { $sql_where .=" and  p.idnhacc  =1 "; } 
	 
	 if ($luachon ==-6) { $sql_where .=" and ( p.lydo =53 or  p.lydo =56  or  p.lydo =61   or  p.lydo =62   or  p.lydo =72)  ";  // tong thuongmai dien tu
	                   $sqllc .=" and ( p4.lydo =53 or  p4.lydo =56  or  p4.lydo =61   or  p4.lydo =62   or  p4.lydo =49)  ";  }   
	 if ($luachon ==-7) { $sql_where .=" and ( p.lydo =46 or  p.lydo =47  or  p.lydo =48   or  p.lydo =52 or  p.lydo =55   or  p.lydo =55    )  ";  // tong team 1,2,3,7,kids
	        $sqllc .=" and ( p4.lydo =46 or  p4.lydo =47  or  p4.lydo =48   or  p4.lydo =52 or  p4.lydo =55    )  ";       }   
			
	 if ($luachon ==-8) { $sql_where .=" and   p.lydo >45     "; $sqllc .=" and  p4.lydo >45  ";       }   
			
			
	 if ($luachon>9 ||$luachon==5){ $sql_where .=" and  p.lydo =$luachon ";  $sqllc .=" and p4.lydo ='".$luachon."'";} 
	
	
			 
  			
		if($ten!=""){$sql_where.=" and d.Name  like '%".$ten."%'"; $sql_where1.=" and a.Name  like '%".$ten."%'"; $sql_wheren.=" and a.Name  like '%".$ten."%'"; }
		if($ma!=""){$sql_where.=" and d.codepro like '%".$ma."%'"; $sql_where1.=" and a.codepro like '%".$ma."%'";$sql_wheren." and a.codepro like '%".$ma."%'"; }
	    if($mota!=""){ $sql_where.=" and d.NameN like '%".$mota."%'";$sql_where1.=" and a.NameN like '%".$mota."%'";$sql_wheren." and a.NameN like '%".$mota."%'"; }
		if($nhom >0 )	{ 
			//$sql_where.=" and c.IDGroup ='".$nhom."'";
			$nhom = $nhom.timnhom("groupproduct","IDGroup",$nhom);
  			$sql_where.=" and  d.IDGroup in ( $nhom ) ";
			$sql_where1.=" and  a.IDGroup in ( $nhom ) ";
			$sql_wheren.=" and  a.IDGroup in ( $nhom ) ";
		}	
		if($nhomhang>0)  $sql_where.=" and d.IDnhom = '".$nhomhang."'";		
		
		if($khuvuc>0) 	{$sql_where.=" and c.idtinh   ='$khuvuc'"; $sql_kho3=  " and c3.idtinh   ='".$khuvuc."' ";}
		if($khuvuc<0) 	{$khuvuc=abs($khuvuc) ; $sql_where.=" and c.NameN   ='$khuvuc'"; $sql_kho3=  " and c3.NameN   ='".$khuvuc."' ";}
		
		
		 $thang=  '';

		 if ( !($id == 1 ||  $ql[5] || $_SESSION["loai_user"]==16|| $_SESSION["loai_user"]==18))  	
			{   $kho = laso($_SESSION["se_kho"]); 
					$sql_where.=" and p.IDKho ='".$kho."'";
 				$sql_kho3=" and p1.IDKho ='".$kho."' ";
				 
			}
			elseif($kho!="" )	{ 
					$sql_where.=" and p.IDKho ='".$kho."'";
 					$sql_kho3=" and p1.IDKho ='".$kho."' ";
			} else if($kho=='' && $idk ==4836)// ==========================================ngoai le
			{   
					$sql_where.=" and p.IDKho in (1062,1071,1072)" ;
 			 	$sql_kho3=" and p1.IDKho in (1062,1071,1072)";}
			else if($kho!='' && $idk ==4836)
			{  
				$sql_where.=" and p.IDKho in (1062,1071,1072) and p.IDKho ='".$kho."'";
 				$sql_kho3=  " and p.IDKho in (1062,1071,1072) and p1.IDKho ='".$kho."' ";
			}
			else if($kho=='' &&  $_SESSION["loai_user"]==16 )  // 5475 mkt01
			{  
			     if($id==1) {}
				 else
				 {
			        $sql_where.=" and c.idtinh   ='$idkho'";
					$sql_kho3=  " and c3.idtinh   ='".$idkho."' ";
				 }
				
				   
			}	// ==========================================ngoai le
			elseif($kho=='' &&  $_SESSION["loai_user"]==18)
			{  
		 	    $sql_where.=" and c.namen   ='$idkho'";
 			 	$sql_kho3=  " and c3.namen    ='$idkho'";
			}	//
			
			
		 
		 $chontheomotnguoi="";
		if($IDNV!="0" )	{ $sql_where.=" and (p.IDTao = $IDNV  or p.diachiN='$IDNV')" ; $chontheomotnguoi=", p.ngaynhap";  }
		if($ncc>0 )	{ $sql_where.=" and  d.congtho = $ncc  " ;    }
		$th=   gmdate('n', time() + 7*3600) ;$ng=   gmdate('d', time() + 7*3600) ;
		$na=gmdate('Y', time() + 7*3600) ;
		//if($th<3) $th =$th+12;
	   
        if($tu=="")   $tu = gmdate('01/n/Y', time() + 7*3600-60*24*3600)  	 ;
		
		
		if($tu!="")	
		{ 	
		
		  $ngay=  explode('/',$tu); 
		  if ($na!=$ngay[2])
		  {
		//	  if (($ngay[1]+2)<($th)) {$ngay[1]= $th-2 ;}
		  }
	 
		  if (strlen($ngay[1])== 1) {  $ngay[1] = "0".$ngay[1] ;  }
		  if (strlen($ngay[0])== 1) {  $ngay[0] = "0".$ngay[0] ;  }    		
		  $sql_where .= " and  p.NgayNhap >= '$ngay[2]-$ngay[1]-$ngay[0]'";
 	      $sql_where3 .= " and  p1.NgayNhap >= '$ngay[2]-$ngay[1]-$ngay[0]' ";
		  $sql_where4 .= " and  p4.NgayNhap >= '$ngay[2]-$ngay[1]-$ngay[0]' ";
		  $sql_where5 .= " and  p5.NgayNhap >= '$ngay[2]-$ngay[1]-$ngay[0]' ";
		  $sqlm .= " and  m.NgayNhap >= '$ngay[2]-$ngay[1]-$ngay[0]'";
		  $sqlm2 .= " and  m.NgayNhap >= '$ngay[2]-$ngay[1]-$ngay[0]'";
		 
		}
		if($den!="")	
		{
		  $ngay=  explode('/',$den);
	   	  if (strlen($ngay[1])== 1) {  $ngay[1] = "0".$ngay[1] ;  }
		  if (strlen($ngay[0])== 1) {  $ngay[0] = "0".$ngay[0] ;  }    		
		   $sql_where .= " and  p.NgayNhap <= '$ngay[2]-$ngay[1]-$ngay[0]'";
 		   $sql_where3 .= " and  p1.NgayNhap <= '$ngay[2]-$ngay[1]-$ngay[0]'";
		   $sql_where4 .= " and  p4.NgayNhap <= '$ngay[2]-$ngay[1]-$ngay[0]'";
		   $sql_where5 .= " and  p5.NgayNhap <= '$ngay[2]-$ngay[1]-$ngay[0]'";
		   $sqlm .= " and  m.NgayNhap <= '$ngay[2]-$ngay[1]-$ngay[0]'";
		   $sqlm2 .= " and  m.NgayNhap <= '$ngay[2]-$ngay[1]-$ngay[0]'"; 
		 
		   $denngay= " đến " .$den ;
		} 
		
   	    $r =1 ;	 $th=""; 
        if ($loai == 10) $th=" ,DATE_FORMAT(p.NgayNhap,'%y%m') as thang ";     
	
	$giavon = "  sum(x.SoLuong * (select avg(h.DonGia) from `phieunhapxuat` t left join `chitietxuatnhap` h on t.ID=h.IDphieu where t.dakhoa=1 and left(t.soct,5) !='NK-BD' and t.Loai=0 and h.IDSP=d.ID    
group by h.IDSP limit 1))as giavon , " ;	  

    if($id!=1) $giavon= "" ;
    if ($loai ==1)
	{                         
		$sql = "  select * from ( SELECT n.vc,p.idkho,DATE_FORMAT(p.NgayNhap,'%d/%m/%Y') as NgayNhap $th ,p.NgayNhap as NgayNhapg, 
		$giavon
 sum(d.price*x.SoLuong) as giaban,a.ID,a.Ten,p.diachiN,c.Name,c.macuahang,x.IDSP,sum(x.SoLuong) as sl,sum(ceil(x.DonGia*(1-1*x.chietkhau/100))*x.SoLuong) as tongtien, sum(x.DonGia*x.chietkhau/100* x.SoLuong) as ck ,count(DISTINCT p.ID)as sobill,count(DISTINCT CASE WHEN (p.loai=3) THEN  p.ID end )as sobilltra
 ,count(DISTINCT CASE WHEN (p.nguoisua=-2) THEN  p.ID end )as trabill
  ,sum( CASE WHEN (p.loai=3) THEN  x.SoLuong end )as sltra,  sum(CASE WHEN (p.lydo>45) THEN ceil(x.DonGia*(1-1*x.chietkhau/100))*x.SoLuong end)  as tienonline
  ,  sum(CASE WHEN (p.nguoisua=-2) THEN   ceil(x.DonGia*(1-1*x.chietkhau/100))*x.SoLuong  end)  as tientralai
  , count(DISTINCT CASE WHEN (p.lydo>45) THEN (p.ID) end)  as billol
  , count(DISTINCT CASE WHEN (p.lydo>45 and p.nguoisua=-2) THEN (p.ID) end)  as billoltra
  , sum( CASE WHEN (p.lydo>45 and p.nguoisua=-2) THEN  x.SoLuong end )as sloltra 
  , sum(CASE WHEN (p.lydo>45 and p.nguoisua=-2 ) THEN ceil(x.DonGia*(1-1*x.chietkhau/100))*x.SoLuong end)  as tienoltra    
   , sum(CASE WHEN (p.lydo>45) THEN  x.SoLuong  end)  as slol
		from   phieunhapxuat p   left join userac a on a.id=p.idtao   
		left join   cuahang c on p.IDKho=c.ID  inner join 
        xuatbanhang x on p.ID = x.IDPhieu  left join products d on x.IDSP = d.ID
 		left join  
        (select m.idkho,sum(m.tigia) as vc from phieunhapxuat m where m.Loai in (1,3,5)  $sqlm group by m.idkho )  n on p.idkho=n.idkho $sql_where   " ;
	
	//	$sql .= "  (select m.idcuahang as idkho,sum(m.voucher) as vc from thongkesolieuvc m where 1  $sqlm2 group by m.idcuahang
	//            union select m.idkho,sum(m.tigia) as vc from phieunhapxuat m where  m.Loai in (1,3,5)  $sqlm3 group by m.idkho
	// )  n on p.idkho=n.idkho $sql_where  " ;	
 	}
	else
	{
		$sql = "SELECT p.idgioithieu,p.idkho,DATE_FORMAT(p.NgayNhap,'%d/%m/%Y') as NgayNhap $th ,p.NgayNhap as NgayNhapg,
		$giavon
 sum(d.price*x.SoLuong) as giaban,a.ID,a.Ten,p.diachiN,c.Name,c.macuahang,x.IDSP,sum(x.SoLuong) as sl,sum(ceil(x.DonGia*(1-1*x.chietkhau/100))*x.SoLuong) as tongtien, sum(x.DonGia*x.chietkhau/100* x.SoLuong) as ck ,count(DISTINCT p.ID)as sobill,count(DISTINCT CASE WHEN (p.loai=3) THEN  p.ID end )as sobilltra
 ,count(DISTINCT CASE WHEN (p.nguoisua=-2) THEN  p.ID end )as trabill
  ,  sum(CASE WHEN (p.nguoisua=-2) THEN ceil(x.DonGia*(1-1*x.chietkhau/100))*x.SoLuong end)  as tientralai
 ,sum( CASE WHEN (p.loai=3) THEN  x.SoLuong end )as sltra, sum(CASE WHEN (p.lydo>45) THEN ceil(x.DonGia*(1-1*x.chietkhau/100))*x.SoLuong end)  as tienonline
   , count(DISTINCT CASE WHEN (p.lydo>45) THEN (p.ID) end)  as billol
   , sum(CASE WHEN (p.lydo>45) THEN  x.SoLuong  end)  as slol
    , count(DISTINCT CASE WHEN (p.lydo>45 and p.nguoisua=-2) THEN (p.ID) end)  as billoltra
  , sum( CASE WHEN (p.lydo>45 and p.nguoisua=-2) THEN  x.SoLuong end )as sloltra 
  , sum(CASE WHEN (p.lydo>45 and p.nguoisua=-2 ) THEN ceil(x.DonGia*(1-1*x.chietkhau/100))*x.SoLuong end)  as tienoltra

		  from   phieunhapxuat p   left join userac a on a.id=p.idtao  
		left join   cuahang c on p.IDKho=c.ID  inner join 
        xuatbanhang x on p.ID = x.IDPhieu  left join products d on x.IDSP = d.ID
 			$sql_where  " ;
	}
		
		if ($loai == 1) $sql .= "  group by c.ID ) v order by tongtien-vc desc " ;
	    elseif  ($loai == 8) {	 $sql .= "  group by p.diachiN $chontheomotnguoi,c.id   order by tongtien desc" ; 		}  // nvbh
	    elseif  ($loai == 12) {	 $sql .= " and  p.idgioithieu>0 group by p.idgioithieu $chontheomotnguoi,c.id   order by tongtien desc" ; 		} // theo taget
	    elseif  ($loai == 14) {	 $sql .= " group by d.IDGroup      order by tongtien desc" ; 		} // theo taget
	    elseif  ($loai == 15) {	 $sql .= " group by d.IDnhom     order by tongtien desc" ; 		} // theo taget
		elseif  ($loai == 2) $sql .= "  group by p.IDKho,p.NgayNhap " ;
	    elseif  ($loai == 6) $sql .= " and (( DATE_FORMAT(p.NgayTao,'%H') >= 1 and DATE_FORMAT(p.NgayTao,'%H') <= 14) or ( DATE_FORMAT(p.NgayTao,'%H') = 15 and  DATE_FORMAT(p.NgayTao,'%i')  <= 30 )) group by p.IDKho order by tongtien desc " ;
 		elseif  ($loai == 7) $sql .= " and (( DATE_FORMAT(p.NgayTao,'%H') = 15  and  DATE_FORMAT(p.NgayTao,'%i') >30) or  DATE_FORMAT(p.NgayTao,'%H') > 15) group by p.IDKho order by tongtien desc " ;
 		elseif  ($loai == 3) $sql .= " and DATE_FORMAT(p.NgayTao,'%H') >= 1 and   DATE_FORMAT(p.NgayTao,'%H') <= 11 group by p.IDKho order by tongtien desc " ;
		elseif  ($loai == 4) $sql .= " and DATE_FORMAT(p.NgayTao,'%H') >= 12 and   DATE_FORMAT(p.NgayTao,'%H') <= 16 group by p.IDKho order by tongtien desc " ;
 		elseif  ($loai == 5) $sql .= " and DATE_FORMAT(p.NgayTao,'%H') >= 17 and   DATE_FORMAT(p.NgayTao,'%H') <= 24 group by p.IDKho order by tongtien desc " ;
		elseif  ($loai == 10) $sql .= " group by c.ID,DATE_FORMAT(p.NgayTao,'%y%m') order by  p.NgayTao desc " ;
		else  $sql .= "  group by a.ID " ; 
	 
	  //	echo $sql ."<br>";
	// echo $sql ;
        if ($_SESSION["admintuan"])	echo $sql ."<br>";  	
   
 	//========================================================
  if (!is_numeric($trang) ) $trang = 1 ;
   		if ($trang * 1  <= 0 ) $trang = 1 ;	
	 $result = $data->query($sql); 
	 $num=$data->num_rows($result);	
	 $pagesize = 10000; 
	 if ($trang == '') $trang = 1 ;
	  
	 	 if ($num > $pagesize )
	 {
		 if ( $trang != '')
		 {	
			$paging_two = ($trang -1) * $pagesize; 	
			$sql .=  " LIMIT ".$paging_two.", ".$pagesize;
			$result = $data->query($sql); 
			
			for ($i=1;$i<($num/$pagesize)+1;$i++)
			{
				if ( $i == $trang) 
				{ $pt = $pt . " ". "  <label style=\"color:#FF0000\">$i</label> " ;  	}
				 else { $pt = $pt . " ". "<a style='cursor:pointer' onclick=\"timkiemkh('$tmp[0]','$tmp[1]','$tmp[2]','$tmp[3]','$tmp[4]','$i')\"  > $i </a> " ;  } 		  
			}
			
		  }
	  }
	 $r = $pagesize * $trang - $pagesize + 1  ; 
	//==============================================================	
      if(  $id==1 ||$id==2 || $id==179 ||$id==4858||$id==7564||$id==10824 ) $chophep=true ; else $chophep=false ;
  
?>
<div align="center" style="font-family:Arial, Helvetica, sans-serif">
<div style="background-color:#FFFFFF;width:100%  ;min-width:1060px;padding:5px" align="left">
<div><strong>Hệ Thống Shop Thời Trang Dành Cho Giới Trẻ

<br />Địa chỉ: <?php echo $_SESSION["S_diachi"] ; ?>
</strong></div>

<div align="center" style="padding-bottom:5px"><b style="font-size:14px">BÁO CÁO BÁN HÀNG VÀ THU TIỀN</b>
<br />Ngày: <?php echo  $tu .   $denngay ; ?>
</div>

<div    align="center" style="height:500px;overflow:scroll" >
 <table width="100%" border="0" cellpadding="0" cellspacing="0" class="tbchuan">
    <thead>		
 		<tr bgcolor="#F8E4CB">
		  <th align="center"  height="23" width="34"><b>STT</b></td>
		  <th width="54" align="center"  ><strong>Mã CH</strong></td>
           <th width="165" align="center"  ><strong>Của hàng</strong></td>
		  <th width="156" align="center" ><strong>Tên NV</strong></td> 
		  <th width="104" align="center" ><strong>Mã NV</strong></td> 
		   <th width="64" align="center" ><strong>Ngày Bán</strong></td> 
		  <th width="46" align="center" ><strong>Số Bill</strong></td> 
		  <th width="46" align="center" ><strong>Bill đổi</strong></td> 
		   <th width="48" align="center" ><strong onclick="locbill()">Bill Trả</strong></td> 
		   <th width="48" align="center" ><strong onclick="locbill()">Tiền Trả</strong></td> 
          <th width="60" align="center" title="Số lượng sản phẩm"><strong>SL SP </strong></td> 
		  <th width="30" align="center" ><strong>SL Trả </strong></td> 
		   <th width="59" align="center" ><strong>Tổng chưa CK</strong></td> 
		  <th width="46" align="center" ><strong>CK</strong></td> 
          <th width="59" align="center" ><strong>DTBH</strong></td> 
		  <th width="59" align="center" ><strong>Bill OL</strong></td> 
		    <th width="59" align="center" ><strong>SL OL </strong></td> 
		    <th width="59" align="center" ><strong>DTOL</strong></td> 
			  <th width="59" align="center" ><strong>OL Trả</strong></td> 
		    <th width="59" align="center" ><strong>SL OL trả</strong></td> 
		    <th width="59" align="center" ><strong>DT OL trả</strong></td> 
            <th width="73" align="center" ><strong>Voucher Giảm giá</strong></td> 
            <th width="49" align="center" title="giá trung bình / bill"><strong>Giá TB</strong></td>  
		    <th width="92" align="center"><strong>DT CH</strong></td>  
		    <th width="92" align="center"><strong>DTThuan</strong></td>  
			<?php if($chophep) { ?><th width="81" align="center" ><strong>Giá Vốn</strong></td> <?php } ?> 
      </thead>
   </tr>
<?php
if ($luachon ==-1) { $sql_where4 .=" and p4.diachiN=0 and DATE_FORMAT(p4.NgayTao,'%H') >= 7 and   DATE_FORMAT(p4.NgayTao,'%H') <= 15"; 
				     $sql_where5 .=" and p5.diachiN=0 and DATE_FORMAT(p5.NgayTao,'%H') >= 7 and   DATE_FORMAT(p5.NgayTao,'%H') <= 15"; } 
elseif ($luachon ==-2) {  $sql_where4 .=" and p4.diachiN=0 and DATE_FORMAT(p4.NgayTao,'%H') > 15 and   DATE_FORMAT(p4.NgayTao,'%H') <= 24"; 
				          $sql_where5 .=" and p5.diachiN=0 and DATE_FORMAT(p5.NgayTao,'%H') > 15 and   DATE_FORMAT(p5.NgayTao,'%H') <= 24"; } 

$mangnv =taomang("userac","ID","ten");
$mangmanv =taomang("userac","ID","manv");
$mangnv[0]="Không tư vấn";
$tong=0;$tongsl=0; $tongck  = 0; $tonggv =0 ;$tck=0 ;$tvc=0;$tongsb=0;$tongsltra=0; $tongtongtien=0 ; $tongslol=0; $tongbillol=0; $tongtienol=0;
while($re = $data->fetch_array($result)) 
	{
 if($mau == "white"){ $mau = "#EEEEEE"; $hl = "Normal4" ; $hl2 = "Highlight4"; }else { $mau = "white";$hl = "Normal5" ;$hl2 = "Highlight5";} 
 
 $ten = $re['Name'] ;
 $ma = $re['codepro'] ;
 $giamgia = $re['giamgia']. "%" ;
 $baohanh = $re['baohanh'] ;
 $nhap = $re['nhap'] ;
 $xuat = $re['xuat'] ;
 $thang= $re['thang'] ;
 $gia = number_format($re['gia']);
 

 $tongsl += $re['sl'] ;
 $dvt = $re['DV'] ;
 $tonggv += $re['giavon'] ;
 $tgiaban += $re['giaban'] ;
 		 $ck=$re['giaban']-$re['tongtien'] ;
		 $tck += $ck ;

 
//	 $sql = "SELECT  price
//,(select sum(c.SoLuong)from `phieunhapxuat` p left join `chitietxuatnhap` c on p.ID=c.IDphieu where p.Loai=0 and c.IDSP=a.ID $sql_where2  group by c.IDSP limit 1)as nhap 
//,(select sum(c1.SoLuong) from `phieunhapxuat` p1 left join `xuatbanhang` c1 on p1.ID=c1.IDphieu where (p1.Loai=1 or p1.Loai=3)and c1.IDSP=a.ID  $sql_kho3 $sql_where3 group by c1.IDSP limit 1)as ban
// ,(select avg(c.DonGia) from `phieunhapxuat` p left join `chitietxuatnhap` c on p.ID=c.IDphieu where p.Loai=0 and c.IDSP=a.ID   $sql_where2 group by c.IDSP limit 1)as nhaptb 
// from products  a " ;
//		 $sql .= " where 1 $sql_wheren   ";
	//	 echo  $sql ."<br>";
		//  $result = $data->query($sql); 
		//  while($re = $data->fetch_array($result))
//		  {
//		  }
//echo $loai."=========";
		  if ($gia =='0.00') $gia = "";
		  
	 
		  $chontheo1nguoivc='';
		  if($IDNV!="0" )	{  $chontheo1nguoivc =" and p4.NgayNhap ='$re[NgayNhapg]'";}
		  
		  $sqlvc = " select sum(p4.tigia) as vc from phieunhapxuat p4 where p4.dakhoa=1 and p4.idkho=$re[idkho] $sql_where4   "; 
		  if  ($loai == 2)  $sqlvc .= " and   p4.NgayNhap ='$re[NgayNhapg]' " ;  
 		  elseif  ($loai == 0)  $sqlvc .= " and   p4.idtao ='$re[ID]' " ;	  
		  elseif  ($loai == 1 && $IDNV!="0" )  $sqlvc .= " and   p4.diachiN= '$IDNV'  or p4.idtao= '$IDNV'   " ;	
		  elseif  ($loai == 3)  $sqlvc .= " and DATE_FORMAT(p4.ngaykhoa,'%H') >= 1 and   DATE_FORMAT(p4.ngaykhoa,'%H') <= 11  " ;  
		  elseif  ($loai == 4)  $sqlvc .= " and DATE_FORMAT(p4.ngaykhoa,'%H') >= 12 and   DATE_FORMAT(p4.ngaykhoa,'%H') <= 16  " ;   
		  elseif  ($loai == 5)  $sqlvc .= " and DATE_FORMAT(p4.ngaykhoa,'%H') >= 17 and   DATE_FORMAT(p4.ngaykhoa,'%H') <= 24  " ;   
		  elseif  ($loai == 8)  $sqlvc .= " and p4.diachiN= '$re[diachiN]'  $chontheo1nguoivc  " ;      // theo tu van
		  elseif  ($loai == 12) $sqlvc .= " and p4.idgioithieu= '$re[diachiN]'  $chontheo1nguoivc  " ;    // theo taget
 		  elseif  ($loai ==10)  $sqlvc .= " and  DATE_FORMAT(p4.ngaykhoa,'%y%m')='$thang'    " ; 
 		  $sqlvc .=   $sqllc ;
		//===========================================================================================================================
 //        $chontheo1nguoivc='';
//		  if($IDNV!="0" )	{  $chontheo1nguoivc =" and p5.NgayNhap ='$re[NgayNhapg]'";}
//		  
//		  $sqlvc = " select sum(p5.voucher) as vc from thongkesolieuvc p5 where  p5.idcuahang =$re[idkho] $sql_where5   "; 
//		  if  ($loai == 2)  $sqlvc .= " and   p5.NgayNhap ='$re[NgayNhapg]' " ;  
// 		  elseif  ($loai == 0)  $sqlvc .= " and   p5.idtao ='$re[ID]' " ;	  
//		  elseif  ($loai == 1 && $IDNV!="0" )  $sqlvc .= " and   p5.idtuvan= '$IDNV'  or p4.idtao= '$IDNV'   " ;	
//		  elseif  ($loai == 3)  $sqlvc .= " and DATE_FORMAT(p5.ngaytao,'%H') >= 1 and   DATE_FORMAT(p5.ngaytao,'%H') <= 11  " ;  
//		  elseif  ($loai == 4)  $sqlvc .= " and DATE_FORMAT(p5.ngaytao,'%H') >= 12 and   DATE_FORMAT(p5.ngaytao,'%H') <= 16  " ;   
//		  elseif  ($loai == 5)  $sqlvc .= " and DATE_FORMAT(p5.ngaytao,'%H') >= 17 and   DATE_FORMAT(p5.ngaytao,'%H') <= 24  " ;   
//		  elseif  ($loai == 8)  $sqlvc .= " and p5.idtuvan= '$re[diachiN]'  $chontheo1nguoivc  " ;      // theo tu van
//		  elseif  ($loai == 12) $sqlvc .= " and p5.idtarget= '$re[diachiN]'  $chontheo1nguoivc  " ;    // theo taget
// 		  elseif  ($loai ==10)  $sqlvc .= " and  DATE_FORMAT(p5.ngaytao,'%y%m')='$thang'    " ; 
// 		  $sqlvc .=   $sqllc ;		
//		    
		//===========================================================================================================================
		  
		  
		  
 		     if ($_SESSION["admintuan"])	echo "<br>"."<br>".$sqlvc  ;  	
		  
		  $tam =getdong($sqlvc) ;
		  $dtthuan= $re['giaban']-$ck-$tam['vc'] ;
		  if($re['idkho'] ==1105) { $re['tienonline']=0; $re['billol']=0; }
		   $tong +=  $dtthuan ; // $re['tongtien']  -$tam['vc'];
		  $tvc += $tam['vc']   ;
		  $tongsb += $re['sobill']   ;
		  $tongsltra += $re['sobilltra']   ;
		  $tongtrabill += $re['trabill']   ;
		  $tongtientra += $re['tientralai']   ;
		  
		  $billdoi= $re['sobilltra']-$re['trabill'] ;
		  $tongbilldoi+=$billdoi ;
		  $tongtongtien +=$re['tongtien'] ;
		  $tongslhangtra += $re['sltra']   ;
		  $tongslol   += $re['slol']   ;
		  $tongbillol += $re['billol'] ;
		  $tongtienol += $re['tienonline'] ;
		  $tongbilloltra += $re['billoltra'] ;
		  $tongsloltra += $re['billoltra'] ;
		  $tongtienoltra  += $re['tienoltra'] ;
		  $tennv='';
		  if($loai==8)  $tennv= $mangnv[$re['diachiN']]. '-'.$re['diachiN'];  $manv=$mangmanv[$re['diachiN']]; 
		    
		 if($loai==12)  { $tennv=   $mangnv[$re['idgioithieu']]	 ; $manv=	$mangmanv[$re['idgioithieu']];  } 
		  $tbbill=formatso(ceil(($re['tongtien']-$re['tienonline']-$tam['vc'])/($re['sobill']-($re['billol']-$re['billoltra'])-$billdoi-2*($re['trabill']-$re['billoltra']))."")) ;
			$dtch =$dtthuan-$re['tienonline'] ;
			$tongch += $dtch ; 
 		  if($loai==0) { $tennv=  $re['Ten']  ;  $manv=$re['diachiN']; } 
		 	
	 ?>
 	 	<tr   style="cursor:pointer" title=" "    >
		    <td     align="right"> <?php echo $r ;?></td>	
		    <td > <?php echo $re['macuahang'] ;?></td>	
            <td > <?php echo  $re['Name'] ;?></td>	
		    <td ><?php  echo $tennv;   ?> </td>	
		    <td ><?php   echo  $manv;  ?> </td>	
			<td  align="center"><?php if ($loai!=1) echo $re['NgayNhap']  ;?></td>
			<td  align="right"><?php echo $re['sobill'] ;?></td>
			<td  align="right"><?php echo $billdoi ;?></td>
			<td  align="right"><?php echo $re['trabill'] ;?></td>
			<td  align="right"><?php echo round($re['tientralai']) ;?></td>
 	 	    <td  align="right"><?php echo $re['sl'] ;?></td>
			<td  align="right"><?php echo $re['sltra'] ;?></td>
            <td  align="right"><?php echo formatso($re['giaban']) ;?></td>
			<td  align="right"><?php echo formatso($ck) ;?></td>
			<td  align="right"><?php echo formatso($re['tongtien']) ;?></td>
			<td  align="right"><?php echo formatso($re['billol']) ;?></td>
			<td  align="right"><?php echo formatso($re['slol']) ;?></td>
			<td  align="right"><?php echo formatso($re['tienonline']) ;?></td>
			<td  align="right"><?php echo formatso($re['billoltra']) ;?></td>
			<td  align="right"><?php echo formatso($re['sloltra']) ;?></td>
			<td  align="right"><?php echo formatso($re['tienoltra']) ;?></td>
  			<td  align="right"><?php echo formatso($tam['vc']) ;?></td>
            <td  align="right"><?php echo $tbbill  ;?></td>
				<td  align="right"><?php echo formatso($dtch) ;?></td>
 		    <td  align="right"><?php echo formatso($dtthuan) ;?></td>
		
			
		     <?php if($chophep ) { ?>  <td align="right"><?php echo formatso($re['giavon'] ) ;?></td><?php } ?>
    </tr>
<?php				
	$r++;
	}
	
?>	
 	 	<tr class="fixed-bottom"  style="cursor:pointer;background-color:#F8E4CB" title=" "    >
		    <td   colspan="5"    ><strong>Tổng cộng </strong></td>	
            <td align="right"><?php echo $tongsl  ;?></td>
		   <td  align="right"><?php echo formatso($tongsb)  ;?></td>
		   <td  align="right"><?php echo formatso($tongbilldoi)  ;?></td>
		     <td  align="right"><?php echo formatso($tongtrabill)  ;?></td>
		    <td  align="right"><?php echo formatso($tongtientra)  ;?></td>
			
			<td  align="right"><?php echo formatso($tongsl)  ;?></td>
			 <td  align="right"><?php echo formatso($tongslhangtra)  ;?></td>
            <td  align="right"><?php echo formatso($tgiaban)  ;?></td>
			<td  align="right"><?php echo   formatso($tck) ;?></td>
            <td  align="right"><?php echo   formatso($tongtongtien) ;?></td>
			<td  align="right"><?php echo formatso($tongbillol) ;?></td>
			
			<td  align="right"><?php echo formatso($tongslol) ;?></td>
            <td  align="right"><?php echo formatso($tongtienol) ;?></td>
			<td  align="right"><?php echo formatso($tongbilloltra) ;?></td>
			<td  align="right"><?php echo formatso($tongsloltra);?></td>
			<td  align="right"><?php echo formatso($tongtienoltra) ;?></td>
            <td  align="right"><?php echo   formatso($tvc) ;?></td>  
			<td><strong><?php echo formatso(ceil(($tongtongtien -  $tvc-$tongtienol  )   / ($tongsb-($tongbillol-$tongbilloltra)-$tongbilldoi- 2*($tongtrabill-$tongbilloltra))))   ;?></strong> </td>
			<td title="Doanh thu cửa hàng"  align="right"><?php echo   formatso($tongch) ;?></td>
 			<td title="tổng trung bình bill"  align="right"><?php echo   formatso($tong) ;?></td>
				
  <?php if($chophep ) { ?>   	<td align="right"><?php echo   formatso($tonggv) ;?></td>  <?php } ?>
    </tr>
</table>
</div>
  <div style="padding:5px;" ><?php 
//==============================================================	
 if ($_SESSION["admintuan"])	echo "<br>"."<br> ".$sqlvc  ;  	
    if ( $num != 0 ) {
 ?>
   
    Có   <?php echo  $tongsl ; ?>  sản phẩm tổng giá trị:  <?php echo  formatso($tong)  ." ( ". doiso($tong) ." )"; ?>    <?php if ($num > $pagesize ) echo "<br>Trang : ". $pt ; ?>  
  <?php 
  } else
  {
  	 echo "<font size=2  color='#FF3300'>Không tìm dữ liệu bán hàng nào, bạn có thể tìm theo từ ngắn hơn  !!!</font> " ;
  }
 //==============================================================	
 	 
 ?> </div>
</div></div>

  <?php	
   return ;
  $tongtnhap = 0;
	 $sql = "SELECT ID,Name,codepro,price
,(select sum(c.SoLuong)from `phieunhapxuat` p left join `chitietxuatnhap` c on p.ID=c.IDphieu where p.Loai=0 and c.IDSP=a.ID $sql_where2  group by c.IDSP limit 1)as nhap 
,(select sum(c1.SoLuong) from `phieunhapxuat` p1 left join `xuatbanhang` c1 on p1.ID=c1.IDphieu left join cuahang c3 on p1.idkho=c3.id where (p1.Loai=1 or p1.Loai=3)and c1.IDSP=a.ID  $sql_kho3 $sql_where3 group by c1.IDSP limit 1)as ban
 
,(select avg(c.DonGia) from `phieunhapxuat` p left join `chitietxuatnhap` c on p.ID=c.IDphieu where p.Loai=0 and c.IDSP=a.ID   $sql_where2 group by c.IDSP limit 1)as nhaptb 
 
from products  a " ;
		 $sql .= " $sql_where1   ";
		 
		  $result = $data->query($sql); 
		  while($re = $data->fetch_array($result))
		  {
		  		 if (laso($re['nhap'])==0) $re['nhaptb'] =  $re['price']*70/100 ;
 				 if (laso($re['nhaptb'])==0) $re['nhaptb'] =  $re['price']  ;
		  	 if ( $re['ban']>0)
			  {
				 $tongtnhap += $re['nhaptb']*$re['ban'];  
			  }
		  }
		  if ($id ==179 || $id ==1)	echo  "Tổng tiền nhập :" .formatso($tongtnhap) ; 			
    $data->closedata() ;
?>	