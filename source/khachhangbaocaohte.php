<?php  
session_start();
if ($_SESSION["LoginID"]=="") return ;
$root_path =getcwd()."/"  ;
include($root_path."biensession.php");
include($root_path."includes/config.php");
include($root_path."includes/removeUnicode.php");
include($root_path."includes/class.paging.php");
include($root_path."includes/class.mysql.php");
include($root_path."includes/function.php");
include($root_path."includes/function_local.php");
include( $root_path."excel/simplexlsx.class.php");  
 $path = $root_path."data/khachhang.xlsx"  ; 
    
$idk = laso($_SESSION["LoginID"]) ; if ($idk == 0) return ;
   
$data = new class_mysql();
$data->config();
$data->access();

  $data1 = $_POST['DATA']; 
  $tmp = explode('*@!',$data1);  
  $IDcuahang = laso($tmp[0]) ; 

    $datatc = new SimpleXLSX($path);
	$sheets=$datatc->rows();
	$sd= count($sheets) ;
	
 
	  $dong =1 ;
	  $toi = 30000 ;   
	//if ($datatc->sheets[0]['numRows']>6000 ) $sd = 6000 ; else $sd = $datatc->sheets[0]['numRows'] ;
	   
 if($tmp[1] =="0")
 {
     $sql =" TRUNCATE TABLE khachhangsosanh" ;
     $tam=getdong($sql);
 }
?>
<div style="overflow:scroll;height:400px">
<strong style="color:#F90">Đọc dữ liệu từ dòng 2 của file Excel</strong> <br />
<table id="tbex" width="100%" border="0" cellpadding="0" cellspacing="0" style="background:#FFF;" class="tbchuan">		
 		<tr bgcolor="#F8E4CB">
		  <td align="center"  height="23" width="35"><b>STT</b></td>
          <td align="center"  height="23" width="43"><strong>Điện thoại</strong></td>
		  <td width="98" align="center"  ><strong>Tên </strong></td>  
 		 
  	 </tr>
<?php 	 
		$stt=0;  $loi = false ;  
	 
		for ($j = $dong; $j <= $sd ; $j++)
		{ 
		$stt++;     
 	    if($mau == "white"){$mau="#EEEEEE";$hl="Normal4";$hl2="Highlight4";}else{$mau="white";$hl = "Normal5" ;$hl2 = "Highlight5";} 
 		$mauchu ='black';
	 	$tel =str_replace("&nbsp;",'',trim($sheets[$j][1])) ;
   	    $mauchu ='black';
	  //  echo $sheets[$j][2] .'123';
	 	if ($tel=='') break ;
 
		 $T1= $sheets[$j][0] ;
		 $T2= $sheets[$j][1] ;
		 $T3= $sheets[$j][2] ;
		 
 if($tmp[1] =="0")
 {	   
 	   if(strlen($T1)==9) $T1='0'.$T1 ;
 	   $sql="select a.ID,b.tel from customer  a left join khachhangsosanh b on a.id=b.id where a.tel='$T1' limit 1 ";       
	   $tam=getdong($sql);
 	   $id=laso($tam['ID']); 
	    $tel=laso($tam['tel']); 
	   if($id && $tel==0){ 
	    $T2= addslashes($T2) ;
 	    $sql="insert into khachhangsosanh set id='$id',tel='$T1',name='$T2' ";  
		//  echo    $sql . "<br>" ;
		 $tam=getdong($sql); 
		
		
		 }
 }	   
  ?>
        
 	 	<tr  style="cursor:pointer;color:<?php echo $mauchu ; ?> "   onMouseOver="this.className='<?php echo $hl2; ?>'" onMouseOut="this.className='<?php echo $hl; ?>'"  bgcolor="<?php echo $mau; ?>" >
		    <td align="right"><?php echo $stt  ;?></td>				
            <td  align="left"><?php echo $sheets[$j][0] ;?></td>
 			<td  align="left"><?php echo $sheets[$j][1] ;?></td>
 		 
    </tr>
   <?php } ?>
   
</table>  
</div>   
<?php  
if ( $loi ) {?>

<div style="padding-bottom:10px;padding-left:20px"><input type="button" id="dulieue" name="dulieue"  onclick="xuatbaoloi('Có lỗi trong file tải lên chú ý chổ màu đỏ!')" value="Lấy dữ liệu Excel"/> </div>  
 <?php
}
 else  
 {
 ?>
 <div style="padding-bottom:10px;padding-left:20px"><input type="button" id="dulieue" name="dulieue"  onclick="laydulieue()" value="Lấy dữ liệu Excel"/> </div>  
  <?php
 }
      	
    $data->closedata() ;
?>	