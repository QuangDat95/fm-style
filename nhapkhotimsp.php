<?php  
$root_path =getcwd()."/"  ;
include($root_path."biensession.php");

include($root_path."includes/config.php");
include($root_path."includes/removeUnicode.php");
include($root_path."includes/class.paging.php");
include($root_path."includes/class.mysql.php");
include($root_path."includes/function.php");
include($root_path."includes/function_local.php");

  $ten = get_cookie('member_ten') ; 
  $us = get_cookie('member_id') ; 
  $id = get_cookie('member_LoginID') ; 
 //  ////if ($us ==""  ) { echo " Ban chua dang nhap!!! " ;return ;}
  
$data = new class_mysql();
$data->config();
$data->access();

  $data1 = $_POST['DATA']; 
  $tmp = explode('*@!',$data1);
 
        $NameTK   = trim ($tmp[0])   ;
        $codeprotk  = trim($tmp[1])  ;
		$code = trim($tmp[2]) ;
		$IDGrouptk = laso($tmp[3]) ;
		$trang = laso($tmp[4]) ;
		$kho= laso($tmp[5]) ;
	// echo $data1 ;
	 
	//	if ($baogia == '1') {	$sql_where=" where 1=1 "; } else { $sql_where=" where congtho = '0' ";}
	
	    if($NameTK!="")
			$sql_where.=" and a.Name  like '%".$NameTK."%'";
		if($codeprotk!="")
			$sql_where.=" and a.codepro like '%".$codeprotk."%'";
		if(  $IDGrouptk>0)
		{
	   		$nhom = $IDGrouptk.timnhom("groupproduct","IDGroup",$IDGrouptk);
			 
 			$sql_where.=" and a.IDGroup in ( $nhom ) ";
 		}
		if($kho!="" and $kho > 0 )
			//$sql_where.=" and (c.IDKho ='".$kho."' or c.IDKho is null ) ";			
			$khotv = "sum( case   when c.IDkho = $kho   then  b.SoLuong   else   0    end) as sl ," ;
		 else
		 	$khotv = "sum( b.SoLuong) as sl ," ;
		if($code!="" )
			$sql_where.=" and a.code like '%".$code."%'";
				$r =1 ;	 
 		
	//	$sql = "SELECT * FROM products  ".$sql_where." ORDER BY NgayTao desc  ";
		$sql = " SELECT a.ID,a.Name, a.SoLuong, a.NameEN,a.codepro,a.code,a.price ,a.giamgia,a.giabinhquan, c.DonGia as gianhap " ;
		$sql = $sql . " from products a   left join chitietxuatnhap c on a.id =c.idsp " ;		
		$sql = $sql . "  where 1=1 $sql_where  order by a.Rank desc   " ;		
//		$query_rows = $data->query($sql);
//		$result_rows = $data->num_rows($query_rows);
//		$result = $data->query($sql);

var_dump($sql);
    if ($_SESSION["admintuan"])	echo $sql ."<br>";  	
 	//========================================================
	$sqlr = "SELECT a.ID  from products a   where 1=1 $sql_where " ;
	 $resultt = $data->query($sqlr); 
	 
	 $num=$data->num_rows($resultt);	
	 $pagesize = 200; 
	 if ($trang == '' || $trang == '0') $trang = 1 ;
	 if ($num > $pagesize )
	 {
		 if ( $trang != '')
		 {	
			$paging_two = ($trang -1) * $pagesize; 	
			$sql .=  " LIMIT ".$paging_two.", ".$pagesize;
			
			
			for ($i=1;$i<($num/$pagesize)+1;$i++)
			{
				if ( $i == $trang) 
				{ $pt = $pt . " &nbsp;". "  <label style=\"color:#FF0000\">$i</label> " ;  	}
				 else { $pt = $pt . " &nbsp;". "<a style='cursor:pointer' onclick=\"timsanpham('$NameTK','$codeprotk','$code','$IDGrouptk','$i')\"  > $i </a> " ;  } 		  
			}
			
		  }
	  }
	  $r = $pagesize * ($trang - 1) +1 ;
 $result = $data->query($sql); 

	//==============================================================	
 if ( $num != 0 ) { ?>
 <div style="padding-bottom:5px"><b style="color:#0000FF;padding-bottom:5px" > Kích đôi chuột để chọn hàng hóa -*- Kích vào biểu tượng <img title="Kích đây để xem thẻ kho" src="images/18_tablecell.gif" /> để xem thẻ kho hàng hóa đó</b></div>
  <?php
 } 
?>
  <table width="98%" border="0" cellpadding="0" cellspacing="0">		
 		<tr bgcolor="#F8E4CB">
		  <td align="center" class="cothienthi" height="23" width="86"><b>STT</b></td>
		  <td width="614" align="center" class="cothienthi" ><strong>Tên Hàng Hóa </strong></td>  
		
		  <td width="164" align="center" class="cothienthi"><strong>Mã HH </strong> </td> 
		
		  <td width="97" align="center" class="cothienthi"><strong><strong>Giá nhập </strong> </strong></td>
		   <td width="97" align="center" class="cothienthi"><strong><strong>Giá bán </strong> </strong></td>
		  <td width="62" align="center" class="cothienthi"><strong><strong>Giảm</strong> </strong></td>	    	      
		  <td width="83" align="center"  class="cothienthi"> <strong>SL </strong></td>	 
		  <td width="100" align="center"  class="cothienthi"> <strong>Thẻ </strong></td>	 
		</tr>
<?php
while($re = $data->fetch_array($result))
	{
	
	
 if($mau == "white")
{	{
	 $mau = "#EEEEEE";
	 $hl = "Normal4" ;
	 $hl2 = "Highlight4";
	}
	 $hl = "Normal4" ;
	 $hl2 = "Highlight4"; 
}else { 
$mau = "white";
$hl = "Normal5" ;
$hl2 = "Highlight5";
} 
 $ten = $re['Name'] ;
 $ma = $re['codepro'] ;
 $giamgia = $re['giamgia'] ;
 $baohanh = $re['baohanh'] ;
 $gia = formatso($re['gianhap']) ;
 
 
 
 $dvt = $re['DV'] ;
 if ($gia =='0.00') $gia = "";
	 ?>
 	 	<tr title="<?php echo addslashes($re['note']) ?>"   style="cursor:pointer" onclick="setsanpham('<?php echo $re['ID'] ;?>','<?php echo $ten ;?>','<?php echo $ma ;?>','<?php echo $gia ;?>','<?php echo $dvt ;?>','<?php echo formatso($re['price']) ;?>','<?php echo $baohanh ;?>','<?php echo $giabinhquan ;?>')" onMouseOver="this.className='<?php echo $hl2; ?>'" onMouseOut="this.className='<?php echo $hl; ?>'"  bgcolor="<?php echo $mau ?>" >
				<td class="cothienthi"    align="right"> <?php echo $r ;?> </td>				
				<td class="cothienthi">&nbsp;<?php echo $re['Name'] ;?></td>
				
				<td class="cothienthi">&nbsp;<?php echo $re['codepro'] ;?></td>
				
				<td class="cothienthi" align="right"><?php echo $gia ;?>&nbsp;</td>
				<td class="cothienthi" align="right"><?php echo formatso($re['price'])   ;?>&nbsp;</td>
				<td class="cothienthi">&nbsp;<?php echo $re['giamgia'] ;?></td> 
				<td class="cothienthi"><?php echo formatso($re['SoLuong']);?>&nbsp;</td>
				<td class="cothienthi" align="center" ondblclick="xemthe('<?php echo $re['ID'] ;?>','','','','')"><img title="Kích đây để xem thẻ kho" src="images/18_tablecell.gif" /></td>
   </tr>
<?php				
	$r++;
	}
?>	
</table>

 <div style="padding:5px;" >
 <?php 
    if ( $num != 0 ) {
 ?>
  Có <?php echo  $num ; ?>  dòng thỏa điều kiện ! &nbsp;   <?php if ($num > $pagesize ) echo "Trang : ". $pt ; ?>  
  <?php 
  } else
  {
  	 echo "<font size=2  color='#FF3300'>Không tìm thấy hàng hóa nào, bạn có thể tìm theo từ ngắn hơn hoặc bấm vào nút '<b>Thêm Vật Tư</b>' để thêm hàng hóa !!!</font> " ;
  }
 
 ?>
  
</div>


 <?php				
    $data->closedata() ;
?>	