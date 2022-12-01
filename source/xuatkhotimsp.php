<?php 
session_start();
$id = $_SESSION["LoginID"] ;

 if ($id =="") return ;
 $idch = $_SESSION["se_kho"] ;
 
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
        $NameTK   = ($tmp[0])   ;
        $codeprotk  = trim($tmp[1])  ;
		$code = trim($tmp[2]) ;
		$IDGrouptk = laso($tmp[3]) ;
		$trang = laso($tmp[4]) ;
		$kho= laso($tmp[5]) ;
		$mota= chonghack($tmp[6]) ;
        $ngaytao=gmdate('Y-m-d H:i', time() + 7*3600) ;
		//$sql_where=" where a.congtho = '0' ";
	    $sql_where='';
		if($NameTK!="")
			$sql_where.=" and a.Name like '%".$NameTK."%'";
		if($codeprotk!="")
			$sql_where.=" and a.codepro like '%".$codeprotk."%'";
	    if($mota!="")
			$sql_where.=" and a.NameN like '%".$mota."%'";	
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
 		
		
		// $manggiarieng =taomang() ;
		
	//	$sql = "SELECT * FROM products  ".$sql_where." ORDER BY NgayTao desc  ";
		$sql = " SELECT a.ID,a.Name,a.NameN, b.SoLuong, a.DV, a.NameEN,a.codepro,a.code,a.price ,c.giagiam ,a.giachan,a.giamgia,c.giamgia as giam ";
		$sql = $sql . " from products a left join hanghoacuahang b  on (a.ID = b.IDSP ) left join giamgiacuahang c on (c.IDSP = a.ID and  c.IDcuahang =$idch  and c.ngaybatdau<= '$ngaytao' and c.ngayketthuc >= '$ngaytao' )" ;		
		$sql = $sql . "  where    b.IDcuahang=$idch  $sql_where    order by a.Rank desc  limit 200  " ;		
//		$query_rows = $data->query($sql);
//		$result_rows = $data->num_rows($query_rows);
//		$result = $data->query($sql);
    
 	//========================================================
	 if ($_SESSION["admintuan"])  {echo $sql;  }
     
   $r=0; $num=0;
	//==============================================================	
 if ( $num != 0 ) { ?>
 <div style="padding-bottom:5px"><b style="color:#0000FF;padding-bottom:5px" > Click chuột để chọn hàng hóa  </b></div>
  <?php
 }
   
?>
<div style="overflow:auto ;height:375px;">
  <table width="98%" border="0" cellpadding="0" cellspacing="0" class="tbchuan">		
 		<tr bgcolor="#F8E4CB">
		  <td align="center" height="23" width="35"><b>STT</b></td>
		  <td width="690" align="center" ><strong>Tên Hàng Hóa </strong></td>  
 		  <td width="182" align="center" ><strong>Mã HH </strong> </td> 
 		  <td width="182" align="center" ><strong>Mô tả</strong> </td> 
 		  <td width="106" align="center" ><strong><strong>Giá </strong> Bán </strong></td>
		  <td width="84" align="center" > <strong>Giảm</strong>  </td>	  
		  <td width="84" align="center" > <strong>Giá Giảm</strong> </td>	    	      
		  <td width="94" align="center"  > <strong>SL </strong></td>	 
 		</tr>
<?php
$result = $data->query($sql);  $mau='';
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
 $ten = addslashes($re['Name']) ;
 $ma = addslashes($re['codepro']) ;

  if (laso($re['giam']) > laso($re['giamgia']) ) $giamgia = $re['giam'] ; else $giamgia = $re['giamgia'] ;
   $giachan = $re['giachan'] ;
 $gia = formatso($re['price']) ;
 $giadagiam =  ($re['price'] -  ($re['price'] * $giamgia/100 ))  ;
 $dvt = $re['DV'] ;
  if ($gia =='0.00') $gia = "";
 
	 ?>
 	 	<tr title="<?php echo $re['note'] ?>"   style="cursor:pointer" onclick="setsanpham('<?php echo $re['ID'] ;?>','<?php echo $ten ;?>','<?php echo $ma ;?>','<?php echo $gia ;?>','<?php echo $dvt ;?>','<?php echo $giamgia ;?>','<?php echo $giachan ;?>','<?php echo $re['SoLuong'] ;?>','<?php echo $re['NameN'] ;?>','<?php echo $giadagiam ;?>')" onMouseOver="this.className='<?php echo $hl2; ?>'" onMouseOut="this.className='<?php echo $hl; ?>'"  bgcolor="<?php echo $mau; ?>" >
				<td    align="right"> <?php echo $r ;?> </td>				
				<td  ><?php echo $re['Name'] ;?>  <?php echo $re['NameEN'] ;?></td>
 				<td ><?php echo $re['codepro'] ;?></td>
			    <td ><?php echo $re['NameN'] ;?></td>
				<td align="right"><?php echo $gia ;?></td>
				<td align="right"><?php echo $giamgia ;?>%</td> 
				<td align="right"><?php echo formatso($giadagiam);?> </td> 
				<td align="right"><?php echo formatso($re['SoLuong']);?></td>
			 
   </tr>
<?php				
	$r++;
	}
?>	
</table>
</div>
 <div style="padding:5px;" >
 <?php 
    if ( $num != 0 ) {
 ?>
  C&#243; <?php echo  $num ; ?>  hàng hóa tìm thấy !    <?php if ($num > $pagesize ) echo "Trang : ". $pt ; ?>  
  <?php 
  } else
  {
   
  }
 
 ?>
  <br />
<br />
<br />
<br />

</div>


<?php				
    $data->closedata() ;
?>	