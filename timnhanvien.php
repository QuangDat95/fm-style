<?php  
session_start();

$id = $_SESSION["LoginID"]  ; if ( $id == "") return ;
$root_path =getcwd()."/"  ;
include($root_path."includes/config.php");
include($root_path."includes/removeUnicode.php");
include($root_path."includes/class.paging.php");
include($root_path."includes/class.mysql.php");
include($root_path."includes/function.php");
 
  
  
$data = new class_mysql();
$data->config();
$data->access();

  $data1 = $_POST['DATA']; 
  $tmp = explode('*@!',$data1);
		$trang= laso($tmp[0]) ;
        $ten   = trim($tmp[1])   ;
        $code= trim($tmp[2])  ;
 		
		 
		$sql_where=" where 1 "; 
	 
		if($ten!="") 	$sql_where.=" and ten  like '%".$ten."%'";
		if($code!="")	    $sql_where.=" and manv like '%".$code."%'";
		
		 
		if($tu!="")	
		{
		  $ngay=  explode('/',$tu);
	   	  if (strlen($ngay[1])== 1) {  $ngay[1] = "0".$ngay[1] ;  }
		  if (strlen($ngay[0])== 1) {  $ngay[0] = "0".$ngay[0] ;  }    		
		  $sql_where .= " and  ngaykhoa >= '$ngay[2]-$ngay[1]-$ngay[0]'";
		}
		if($den!="")	
		{
		  $ngay=  explode('/',$den);
	   	  if (strlen($ngay[1])== 1) {  $ngay[1] = "0".$ngay[1] ;  }
		  if (strlen($ngay[0])== 1) {  $ngay[0] = "0".$ngay[0] ;  }    		
		  $sql_where .= " and  ngaykhoa <= '$ngay[2]-$ngay[1]-$ngay[0] 23:59'";
		} 
		
		
		
		$r =1 ;	 
 		
	 $mangcuahang = taomang('cuahang','ID','macuahang');
		$sql = "SELECT * FROM userac " ;
		 
 		$sql .= " $sql_where  and ID>2 order by  Ten ";
     // 	echo $sql ;
//	 echo urlencode(" m'dáh%a") ;
 	//========================================================
  if (!is_numeric($trang) ) $trang = 1 ;
   		if ($trang * 1  <= 0 ) $trang = 1 ;	
	 $result = $data->query($sql); 
	 $num=$data->num_rows($result);	
	 $pagesize = 1000; 
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
				{ $pt = $pt . " &nbsp;". "  <label style=\"color:#FF0000\">$i</label> " ;  	}
				 else { $pt = $pt . " &nbsp;". "<a style='cursor:pointer' onclick=\"timnhanvien('$i','$tmp[0]','$tmp[1]')\" > $i </a> " ;  } 		  
			}
			
		  }
	  }
	 $r = $pagesize * $trang - $pagesize + 1  ; 
	//==============================================================	

?>
<div   style="display:auto;overflow:scroll;width:470px;height:440px"  >
 <table width="99%" border="0" cellpadding="0" cellspacing="0" class="tbchuan">		
 		<tr bgcolor="#F8E4CB">
		  <td align="center" height="14" width="5px"><b>TT</b></td>
		  <td width="212" align="center" ><strong>Tên Nhân Viên</strong></td> 
		  <td width="83" align="center" ><strong>Mã NV</strong></td> 
		   <td width="76" align="center" ><strong>Điện Thoại</strong></td> 
		  <td width="79" align="center" ><strong>Cửa hàng</strong></td>  
		      	      
		  
		</tr>
<?php
$tong=0;$tongsl=0;$mau ='';
while($re = $data->fetch_array($result))
	{
 if($mau == "white")
{$mau = "#EEEEEE";$hl="Normal4";$hl2="Highlight4";  
}else { $mau = "white";$hl="Normal5";$hl2="Highlight5";
} 
 
 
	 ?>
 	 	<tr   style="cursor:pointer"  onclick="setnhanvien('<?php echo $re['ID'] ;?>' ,'<?php echo  ($re['MaNV']) ;?>','<?php echo  ($re['Ten']) ; ?>')" onMouseOut="this.className='<?php echo $hl; ?>'"  bgcolor="<?php echo $mau ?>" >
		    <td    align="right"><?php echo $r ;?></td>	
		    <td >&nbsp;<?php echo $re['Ten'] ;?></td>	
		    <td >&nbsp;<?php echo $re['MaNV'] ;?></td>
			<td >&nbsp;<?php echo $re['SoDienThoai'] ;?></td>	
 			<td >&nbsp;<?php echo $mangcuahang[$re['cuahang']] ;?></td>
			 
    </tr>
<?php				
	$r++;
	}
?>	

 
</table>
 </div>
  <div style="padding:5px;" ><?php 
//==============================================================	
    if ( $num != 0 ) {
 ?>
   
    Có <?php echo  $r-- ; ?>  nhân viên &nbsp;  
  <?php 
  } 
 //==============================================================	
 ?> </div>


  <?php				
    $data->closedata() ;
?>	