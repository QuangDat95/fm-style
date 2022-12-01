<?php  
session_start();
if ($_SESSION["LoginID"] =='') { return ; }

$root_path =getcwd()."/"  ;
include($root_path."biensession.php");

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
 
        $ten   =  ($tmp[0])   ;
        $ma= trim($tmp[1])  ;
		 
		$kho= trim($tmp[2]) ;
		$tu= trim($tmp[3]) ;
		$den= trim($tmp[4]) ;
		$IDNV= laso($tmp[5]) ;
		$trang= laso($tmp[8]) ; 
		
		$sql_where=" where  1 "; 
	 
		if($ten!="") 	$sql_where.=" and  a.Name  like '%".$ten."%'";
		if($ma!="")	    $sql_where.=" and  a.manv like '%".$ma."%'";
 		if($kho!="" )	$sql_where.=" and  b.cuahang ='".$kho."'";
		if($IDNV!="0" )	$sql_where.=" and  a.IDnhanvien ='".$IDNV."'";
		if($tu!="")	
		{
		  $ngay=  explode('/',$tu);
	   	  if (strlen($ngay[1])== 1) {  $ngay[1] = "0".$ngay[1] ;  }
		  if (strlen($ngay[0])== 1) {  $ngay[0] = "0".$ngay[0] ;  }    		
		  $sql_where .= " and  a.ngaytao >= '$ngay[2]-$ngay[1]-$ngay[0]'";
		}
		if($den!="")	
		{
		  $ngay=  explode('/',$den);
	   	  if (strlen($ngay[1])== 1) {  $ngay[1] = "0".$ngay[1] ;  }
		  if (strlen($ngay[0])== 1) {  $ngay[0] = "0".$ngay[0] ;  }    		
		  $sql_where .= " and  a.ngaytao <= '$ngay[2]-$ngay[1]-$ngay[0] 23:59'";
		} 
		
 				$r =1 ;	 
  $mangchucvu= taomang("kh_chucvu","ID","Name");
			$sql = "SELECT  b.ten as tennv,a.*,DATE_FORMAT( a.ngaytao,'%d/%m/%Y %H:%i') as ngay,DATE_FORMAT( ngaytao,'%m-%Y') as thang ,b.chucvu  FROM nhanviendilam a left join userac b on b.ID = a.IDnhanvien ".$sql_where." ORDER BY  a.IDnhanvien,a.ngaytao     ";
	 
	 
  if ($_SESSION["admintuan"] )  echo   $sql ; 
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
				{ $pt = $pt . " ". "  <label style=\"color:#FF0000\">$i</label> " ;  	}
				 else { $pt = $pt . " ". "<a style='cursor:pointer' onclick=\"submittk('$tmp[0]','$tmp[1]','$tmp[2]','$tmp[3]','$tmp[4]','$tmp[5]','$tmp[6]','$tmp[7]','$i','$tmp[9]')\"  > $i </a> " ;  } 		  
			}
			
		  }
	  }
	  $r = $pagesize * $trang - $pagesize + 1  ;
	//==============================================================	
	
 	// echo ( strtotime('2011-09-01 10:03') -  strtotime('2011-09-01 10:02')  ) ;
	 

?><div   style=" overflow:auto;width:99%;height:400px" >
 <table width="99%" border="0" cellpadding="0" cellspacing="0" class="tbchuan">		
 		<tr bgcolor="#F8E4CB">
		  <td align="center"  height="23" width="30"><b>STT</b></td>
		   <td width="175" align="center" ><strong> Giờ Quét Thẻ </strong></td> 
		    <td width="82" align="center" ><strong> Mã NV  </strong> </td> 	
		  <td width="171" align="center"  ><strong>Tên Nhân Viên </strong></td>  
		  <td width="71" align="center"  ><strong>Chức Vụ</strong></td>  
 		  <td width="257" align="center" ><strong>Quét thẻ tại </strong></td>
		   <td width="37" align="center" ><strong>Loại</strong></td>
		   <td width="82" align="center" ><strong>Số giờ</strong></td>
           <td width="82" align="center" ><strong>IP</strong></td>
           		    <td width="355" align="center" ><strong>Ghi Chú</strong></td>	
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
if ( $re['loai']==1 ) { $loai = "Vào" ; $giovao = strtotime($re['ngaytao']) ;  $sophut=0;}
else if ( $re['loai']==2 ) { $loai = "Ra" ; $giora = strtotime($re['ngaytao']) ;
		 $sophut = $giora-$giovao  ;	
		  $tongcong += $sophut ;
		 $sogio =   $sophut%3600  ; 
		 $tam =  $sogio ;
		 $sophut = $sophut - $sogio ;
		 $sogio =  $sophut/3600; 
		 $sophut = round($tam/60) ;
		
}
else $loai = "" ; 


	 ?>
 	 	<tr  title="<?php echo addslashes($re['note']) ?>"  onclick="setkh('<?php echo addslashes($re["idkhach"]) ; ?>','<?php echo addslashes($re['Name']) ;?>','<?php   echo $re['address'] ;?>','<?php echo $re['tel'] ;?>')"   onMouseOver="this.className='<?php echo $hl2; ?>'" onMouseOut="this.className='<?php echo $hl; ?>'"  bgcolor="<?php echo $mau ?>" >
		  <td     align="right"> <?php echo $r ;?> </td>		
		  <td ><?php echo $re['ngay'] ;?></td>		
				<td ><?php echo $re['manv'] ;?></td>
  				<td ><?php echo $re['tennv'] ;?></td>
				<td ><?php echo $mangchucvu[$re['chucvu']] ;?></td>		
				<td ><?php echo $re['cuahang'] ;?></td>				
                  <td ><?php echo $loai ;?></td>	
				   <td ><?php if ( $re['loai']==2 ) {  echo $sogio."h".$sophut ."'"; } ?></td>
                  <td   align="left" ><?php echo $re['ip'] ;?> <b onclick="goianh('<?php echo "https://trungvu.vn/upload/".$re["thang"]."/" .$re["ID"]  .".png'" ;?>)"  >Xem</b></td>     
				<td   align="left"><?php echo $re['note']  ;?><?php if ($_SESSION["admintuan"] || $_SESSION["LoginID"]==4647 ) { ?><img onclick="goianh('<?php echo "http://trungvu.vn/upload/".$re["thang"]."/" .$re["ID"]  .".png'" ;?>)" id="anh<?php echo $re["ID"] ;?>" src="http://trungvu.vn/upload/<?php echo $re["thang"]."/" .$re["ID"] ;?>.png" height="30px" /><?php } ?></td>      
    </tr>
<?php				
	$r++;
	}
	
	    $sophut = $tongcong  ;	
		   
		 $sogio =   $sophut%3600  ; 
		 $tam =  $sogio ;
		 $sophut = $sophut - $sogio ;
		 $sogio =  $sophut/3600; 
		 $sophut = round($tam/60) ;
	
?>	
 <tr><td></td><td></td><td></td><td></td><td align="right">Tổng :</td><td></td><td><?php echo $sogio."h".$sophut ."'"; ?></td></tr>
</table>
</div>
<div style="padding:5px;" ><?php 
//==============================================================	
    if ( $num != 0 ) {
 ?>
  Tìm thấy  <?php echo  $num ; ?>   lượt quét !    <?php if ($num > $pagesize ) echo "Trang : ". $pt ; ?>  
  <?php 
  } else
  {
  	 echo "<font size=2  color='#FF3300'>Không tìm thấy phụ khách hàng, bạn có thể tìm theo từ ngắn hơn hoặc bấm vào nút '<b>Thêm </b>' để thêm khách hàng !!!</font> " ;
  }
 //==============================================================	
 ?> </div>
 
 
<?php				
    $data->closedata() ;
?>	