<?php  
session_start();
     $quyen= $_SESSION["quyen"] ; 
	 $ql =$quyen[$_SESSION["mangquyenid"]["xuatkhotong"]]  ;  
 	 if( $ql[0]!=1  ){return;}

$root_path =getcwd()."/"  ;
include($root_path."biensession.php");
include($root_path."includes/config.php");
include($root_path."includes/removeUnicode.php");
include($root_path."includes/class.paging.php");
include($root_path."includes/class.mysql.php");
include($root_path."includes/function.php");
include($root_path."includes/function_local.php");

$idk = ($_SESSION["LoginID"]) ; if ( $idk == 0) return ;
$kho = laso($_SESSION["se_kho"]);   
  if ( $idk == 1 ||  $ql[5]) { $idk = 1 ;$kho =1; }
 
 
$data = new class_mysql();
$data->config();
$data->access();
  $quyenhuyphieu = "" ;
 // if ($idk != 1 || 1==1) $quyenhuyphieu = " and dakhoa != '2' " ;
  $data1 = $_POST['DATA']; 
  $tmp = explode('*@!',$data1);
  $loai  = trim($tmp[0])  ;		 
  $sophieu  = trim($tmp[1])  ;		 
  $cuahangnhan= laso($tmp[2]) ;
  $tungay = trim($tmp[3]) ;
  $denngay = trim($tmp[4]) ;		
  $dakhoa = trim($tmp[5]) ;		
  $trang = trim($tmp[6]) ;		
   
  $idkho = laso($tmp[7]) ;		
  $ghichu = trim($tmp[8]) ;		
  $lydo = laso($tmp[9]) ;
  
 		$sql_l = "" ; 
		
		 if ( $idk == 1 ||  $ql[5]) 	$sql_where= " where 1  " ; //  a.lydo in (1,24) 
		else
		$sql_where= " where a.IDkho <> -1 and a.lydo in (1,24,2) $quyenhuyphieu " ;  //  
		
		
	    if($lydo>0) $sql_where.=" and a.lydo  = '".$lydo."'";
		if($ghichu!="") $sql_where.=" and a.ghichu  like '%".$ghichu."%'";
		
 		if($sophieu!="") $sql_where.=" and a.SoCT  like '%".$sophieu."%'";
		
	  
		if($idkho!="0"   ) $sql_where.=" and (  a.IDTKCo  = '$idkho')" ; 
		
		
		
 		if($dakhoa!="" && $loai !=3 ) $sql_where.=" and a.dakhoa  = '$dakhoa' " ; 
 		if($nhacungcap!="")
			$sql_where.=" and a.tenN  like '%".$nhacungcap."%'";

 		
		if (   $_SESSION["loai_user"]==16 &&  $cuahangnhan==0  )  $sql_where.=" and c.IDtinh ='".$_SESSION["se_kho"]."'";
		else if($kho>0 &&  ($idk!=1 &&  $kho != 1) )	$sql_where.=" and (a.IDTKNo  = '$kho' or a.IDTKCo  = '$kho') ";
		
		 
		if($cuahangnhan>0  )	$sql_where.=" and (a.IDTKNo  = '$cuahangnhan'  ) ";	
		
		
		if($tungay!="")	
		{
		  $ngay=  explode('/',$tungay);
	   	  if (strlen($ngay[1])== 1) {  $ngay[1] = "0".$ngay[1] ;  }
		  if (strlen($ngay[0])== 1) {  $ngay[0] = "0".$ngay[0] ;  }    		
		  $sql_where .= " and  a.NgayNhap >= '$ngay[2]-$ngay[1]-$ngay[0]'";
		}
		
		if($denngay!="")	
		{
		  $ngay=  explode('/',$denngay);
	   	  if (strlen($ngay[1])== 1) {  $ngay[1] = "0".$ngay[1] ;  }
		  if (strlen($ngay[0])== 1) {  $ngay[0] = "0".$ngay[0] ;  }    		
		  $sql_where .= " and  a.NgayNhap <= '$ngay[2]-$ngay[1]-$ngay[0] 23:59'";
		} 
		
		
 		 //	if ($idk!=1)  $sql_where .= " and  IDTao = '$idk' " ; 
 	if ($dakhoa==1||$dakhoa=='')	 $tentb = "xuatkhotong" ; else $tentb = "xuatkhotongchuakhoa" ;
	
	 
	
 		$sql = "SELECT a.ID,a.dakhoa,a.SoCT,a.ghichu,a.NguoiGiao,a.nguoitao,DATE_FORMAT(a.NgayTao,'%d/%m/%Y %H:%i') as ngay,DATE_FORMAT(a.ngaykhoa,'%d/%m/%Y %H:%i') as ngayk,b.Name as noidi,c.Name as noinhan,sum(x.SoLuong) as tong,sum(x.SoLuong*x.dongia) as tongtien FROM phieuxuat a left join cuahang b on a.IDTKCo = b.ID left join cuahang c  on a.IDTKNo = c.ID left join $tentb x on a.ID = x.IDPhieu  ".$sql_where." group by a.ID ORDER BY a.NgayTao desc  ";
		
		if($loai==1)	
		{ 
		
		  $tungay = gmdate('Y-m-d', time() + 7*3600-72*3600) ; 
 		  $sql_w = "  where a.dakhoa=0 and a.NgayNhap <= '$tungay'";
		  if (   $_SESSION["loai_user"]==16 &&  $cuahangnhan==0  )  $sql_w.=" and c.IDtinh ='".$_SESSION["se_kho"]."'";
		  else if($kho>0 &&  ($idk!=1 &&  $kho != 1) )	$sql_w.=" and (a.IDTKNo  = '$kho' or a.IDTKCo  = '$kho') ";
		
		
		  $sql = "SELECT b.canhbaongay,DATEDIFF(CURDATE(),a.NgayTao) as songay,  a.NguoiGiao, a.ID,a.dakhoa  ,a.SoCT,a.ghichu,a.nguoitao,DATE_FORMAT(a.NgayTao,'%d/%m/%Y %H:%i') as ngay,DATE_FORMAT(a.ngaykhoa,'%d/%m/%Y %H:%i') as ngayk,b.Name as noidi,c.Name as noinhan,sum(x.SoLuong) as tong,sum(x.SoLuong*x.dongia) as tongtien FROM phieuxuat a left join cuahang b on a.IDTKCo = b.ID left join cuahang c  on a.IDTKNo = c.ID left join $tentb x on a.ID = x.IDPhieu  ".$sql_w." and DATEDIFF(CURDATE(),a.NgayTao)> b.canhbaongay group by a.ID ORDER BY a.NgayTao desc  ";
		}
			
			
	 //  echo $sql ; 	 
//		$query_rows = $data->query($sql);
//		$result_rows = $data->num_rows($query_rows);
//		$result = $data->query($sql);
 
  //=====================================
    if (!is_numeric($trang) ) $trang = 1 ;
  	if ($trang * 1  <= 0 ) $trang = 1 ;  
	 $result = $data->query($sql); 
	 $num=$data->num_rows($result);	
	 $pagesize = 400; 
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
				 else { $pt = $pt . " ". "<a style='cursor:pointer' onclick=\"timdsphieuxuat('$tmp[0]','$tmp[1]','$tmp[2]','$tmp[3]','$tmp[4]','$tmp[5]','$i','$tmp[7]','$tmp[8]')\"  > $i </a> " ;  } 		  
			}
			
		  }
	  }
	  
	//==============================================================			
    if ($_SESSION["admintuan"]==1)	echo $sql ; 	 
?>
<div style="width:1060px;overflow:scroll;height:450px" align="center">
 <table width="1050px" border="0" cellpadding="0" cellspacing="0" class="tbchuan">		
 		<tr bgcolor="#F8E4CB">
		  <td align="center" height="23" width="92"><b>Số Phiếu </b></td>
		  <td class="cothienthi"><strong>SL</strong></td>
		  <td class="cothienthi"><strong>Thành Tiền</strong></td>
		  <td width="90" align="center" ><strong>Ngày Lập </strong></td>  
		  <td width="90" align="center" ><strong>Ngày khóa</strong></td>  	   
		   <td width="90" align="center" ><strong>Số Ngày</strong></td>  	  
		  <td width="252" align="center" class="cothienthi"><strong>Nơi Xuất</strong> </td> 
		  
		  <td width="253" align="center" class="cothienthi"><strong>Nơi Nhận</strong></td>
		   <td width="253" align="center" class="cothienthi"><strong>Ghi Chú</strong></td>
		  <td width="133" align="center" class="cothienthi"><strong>Người Tạo</strong></td><td width="62" align="center" class="cothienthi"><strong>Tình Trạng</strong></td>
 		</tr>
<?php
$tong = 0 ;
while($re = $data->fetch_array($result))
	{
	 if($mau == "white")
		{
			 $mau = "#EEEEEE";
			 $hl = "Normal4" ;
			 $hl2 = "Highlight4";		
		}else 
		{ 
			$mau = "white";
			$hl = "Normal5" ;
			$hl2 = "Highlight5";
		} 
		$mauchu = "" ;
		$idphieu = $re["ID"] ; 
		if ( $re["dakhoa"] == "0" ){ $mauchu = "blue" ;$tinhtrang='Chưa khóa';
		if( $re["NguoiGiao"]=='') $dagoihang="<br><b style='color:#8f590a;' onclick='openpopup($idphieu)'>XN gởi hàng</b>";	}
		else if ( $re["dakhoa"] == "1" ) { $mauchu = "black" ;$tinhtrang='Đã khóa';$dagoihang='';}
		else  { $mauchu = "red" ;$tinhtrang='Đã hủy';	}
		
		if($loai==1)  $mauchu = "red" ;
		if (laso($re['tong']) ==0)
		{
		 	$sqlt = " select sum(soluong) as sl,sum(soluong*dongia)as tongtien from phieuxuat p left join xuatkhotongchuakhoa x on p.id=x.idphieu where p.id= 0$re[ID] limit 1 ";
 		 	$tamt = getdong($sqlt);
	//	  echo $sqlt ;
		 $re['tong']=$tamt['sl']; $re['tongtien'] =$tamt['tongtien'];
		}
		$tong += $re['tong'] ;
		$tongtien += $re['tongtien'] ;
		
		 
?>

 	 	<tr  style="cursor:pointer;color:<?php echo $mauchu ; ?> " onMouseOver="this.className='<?php echo $hl2; ?>'" onMouseOut="this.className='<?php echo $hl; ?>'"  bgcolor="<?php echo $mau; ?>" >
		  <td  onClick="setlaiphieuxuat('<?php echo $re['ID'] ;?>','<?php echo $re['dakhoa'] ;?>')" align="left"><?php echo $re['SoCT']  ;?></td>
		  		<td align="center"><?php echo $re['tong'] ;?></td>	
				<td align="center"><?php echo formatso($re['tongtien']) ;?></td>
				<td align="center"><?php echo $re['ngay'] ;?></td>
				<td align="center"><?php echo $re['ngayk'] ;?></td>
				<td align="center"><?php echo $re['songay'] ;?></td>
				<td  ><?php echo $re['noidi'] ;?></td>
				<td  ><?php echo $re['noinhan'] ;?></td>
				<td  ><?php echo $re['ghichu'] ;?></td>
				<td  ><?php echo $re['nguoitao'] ;?></td>
                <td  ><?php echo $tinhtrang ;?><?php echo $dagoihang ;?> </td>
   </tr>
<?php				
 
	 if ($re['loaixn'] == '0') 
	 { 
	 	$khoiluong = $khoiluong - $re['SoLuong'] ;
	 } 
	 else 
	 { 
	    $khoiluong = $khoiluong + $re['SoLuong'] ;
	 }
}	 
?>	
</table>
</div>
 <div style="padding:5px;" >
  Tìm thấy  <?php echo  $num ; ?>  phiếu ! tổng cộng:  <?php echo  $tong ; ?>  SP  tổng tiền:  <?php echo formatso($tongtien); ?>     <?php if ($num > $pagesize ) echo "Trang : ". $pt ; ?>  
</div>

<?php				
    $data->closedata() ;
?>	