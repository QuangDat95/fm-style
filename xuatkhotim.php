<?php  
session_start();



    /* $quyen= $_SESSION["quyen"] ; 
	 $ql =$quyen[$_SESSION["mangquyenid"]["xuatkho"]]  ;  
 	 if( $ql[0]!=1  ){return;}*/


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
 
$data = new class_mysql();
$data->config();
$data->access();
  $quyenhuyphieu = "" ;
  if ($ten != "admin" || 1==1) $quyenhuyphieu = " and dakhoa != '2' " ;
  $data1 = $_POST['DATA']; 
  $tmp = explode('*@!',$data1);
  $loai  = trim($tmp[0])  ;		 
  $sophieu  = trim($tmp[1])  ;		 
  $nhacungcap=  (trim($tmp[2])) ;
  $tungay = trim($tmp[3]) ;
  $denngay = trim($tmp[4]) ;		
  $dakhoa = trim($tmp[5]) ;		
  $trang = trim($tmp[6]) ;	
  $tientu = laso($tmp[7]) ;	
 
 		$sql_l = "" ; 
		$sql_where= " where  (a.Loai ='1' or a.Loai ='3') $quyenhuyphieu " ;
 		if($sophieu!="") $sql_where.=" and a.SoCT  like '%".$sophieu."%'";
 		if($dakhoa!="" && $loai !=3 ) $sql_where.=" and a.dakhoa  = '$dakhoa' " ; 
 		if($nhacungcap!="")
			$sql_where.=" and a.ten   like '%".$nhacungcap."%'";

 		if($kho>0 && !($idk==1||$ql[5]) )	$sql_where.=" and a.dahuy=0 and a.IDKho  = '$kho'";
		
		
			
		
		
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
		  $sql_where .= " and  a.NgayNhap <= '$ngay[2]-$ngay[1]-$ngay[0]'";
		} 
 		//  	if ($idk!=1)  $sql_where .= " and IDKho  = '$kho' " ; 
 		if ($dakhoa==1) $tinhtrang	='xuatbanhang'; else  $tinhtrang ='xuatbhchuakhoa';
 		$sql = "SELECT a.*,c.Name,DATE_FORMAT(a.NgayTao,'%d/%m/%Y %H:%i') as ngay,sum(b.DonGia*(1-1*b.chietkhau/100)*b.SoLuong) as sotien  FROM phieunhapxuat a left join $tinhtrang b  on b.IDphieu =a.ID left join  cuahang c on a.IDKho =c.ID  group by a.id ORDER BY a.NgayTao desc   ";
		 $pagesize = 40; 
		if($tientu>0 && ($idk==1||$ql[5]) )	
		{  $pagesize = 200; 
		   $sql = "select * from (SELECT a.*,c.Name,DATE_FORMAT(a.NgayTao,'%d/%m/%Y %H:%i') as ngay,sum(b.DonGia*(1-1*b.chietkhau/100)*b.SoLuong) as sotien  FROM phieunhapxuat a left join $tinhtrang b  on b.IDphieu =a.ID left join  cuahang c on a.IDKho =c.ID group by a.id ORDER BY a.NgayTao desc ) g where sotien>=$tientu   ";
		}
		 
	  //echo $sql ; 	 
//		$query_rows = $data->query($sql);
//		$result_rows = $data->num_rows($query_rows);
//		$result = $data->query($sql);
  //=====================================
    if (!is_numeric($trang) ) $trang = 1 ;
  	if ($trang * 1  <= 0 ) $trang = 1 ;  
	 $result = $data->query($sql); 
	 $num=$data->num_rows($result);	
	
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
				 else { $pt = $pt . " ". "<a style='cursor:pointer' onclick=\"timdsphieuxuat('$tmp[0]','$tmp[1]','$tmp[2]','$tmp[3]','$tmp[4]','$tmp[5]','$i','$tmp[7]','$i')\"  > $i </a> " ;  } 		  
			}
			
		  }
	  }
	  
	//==============================================================			
 if($_SESSION["admintuan"]) echo $sql ;
?>
<div style="width:850px;overflow:scroll;height:400px" align="center">
 <table width="820px" border="0" cellpadding="0" cellspacing="0" class="tbchuan">		
 		<tr bgcolor="#F8E4CB">
		  <td align="center"  height="23" width="92"><b>Số Phiếu </b></td>
		  <td width="90" align="center"  ><strong>Ngày Lập </strong></td>  
		 	   <td width="90" align="center" ><strong>Số Tiền</strong></td>   
		  <td width="151" align="center" ><strong>Lý Do </strong> </td> 
            
		  <td width="254" align="center" ><strong>Ghi Chú</strong></td>
		   <td width="354" align="center" ><strong>Cửa hàng</strong></td>
	 
 		</tr>
<?php

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
		if ( $re["dakhoa"] == "0" ) $mauchu = "blue" ;	 
?>

 	 	<tr  style="cursor:pointer;color:<?php echo $mauchu ; ?> " onClick="setlaiphieuxuat('<?php echo $re['ID'] ;?>','<?php echo $re['dakhoa'] ;?>')" onMouseOver="this.className='<?php echo $hl2; ?>'" onMouseOut="this.className='<?php echo $hl; ?>'"  bgcolor="<?php echo $mau ?>" >
		  <td     align="left"><?php echo $re['SoCT']  ;?></td>	
          			
				<td  align="center"><?php echo $re['ngay'] ;?></td>
                  <td   align="right"><?php echo formatso($re['sotien'] ) ;?></td>
				<td ><?php echo $re['tenlydo'] ;?></td>
			    <td><?php echo $re['ghichu'] ;?></td>
 				<td><?php echo $re['Name'] ;?></td>
 
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
  Tìm thấy  <?php echo  $num ; ?>  phiếu !    <?php if ($num > $pagesize ) echo "Trang : ". $pt ; ?>  
  </div>

<?php				
    $data->closedata() ;
?>	