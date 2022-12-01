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
 $path = $root_path."data/filedata.xlsx"  ; 
    
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
	   
 
  $sql =" TRUNCATE TABLE datatailen" ;
 			 
   // $tam=getdong($sql);
    $result= $data->query($sql) ;
   
?>
<div style="overflow:scroll;height:400px">
<strong style="color:#F90">Đọc dữ liệu từ dòng 2 của file Excel</strong> <br />
<table id="tbex" width="100%" border="0" cellpadding="0" cellspacing="0" style="background:#FFF;" class="tbchuan">		
 		<tr bgcolor="#F8E4CB">
		  <td align="center"  height="23" width="35"><b>STT</b></td>
          <td align="center"  height="23" width="43"><b>T1</b></td>
		  <td width="98" align="center"  ><strong>T2</strong></td>  
 		  <td width="72" align="center" ><strong>T3</strong></td> 
          <td width="72" align="center" ><strong>T4</strong></td>
          <td width="72" align="center" ><strong>T5</strong></td>
          <td width="72" align="center" ><strong>T6</strong></td>
          <td width="72" align="center" ><strong>T7</strong></td>
          <td width="72" align="center" ><strong>T8</strong></td>
          <td width="72" align="center" ><strong>T9</strong></td>
          <td width="72" align="center" ><strong>T10</strong></td>
		  
  	 </tr>
<?php 	 
		$stt=0;  $loi = false ;  
	 
		for ($j = $dong; $j <= $sd ; $j++)
		{ 
		$stt++;   
 	    if($mau == "white"){$mau="#EEEEEE";$hl="Normal4";$hl2="Highlight4";}else{$mau="white";$hl = "Normal5" ;$hl2 = "Highlight5";} 
 		$mauchu ='black';
	 	$cot1 =str_replace("&nbsp;",'',trim($sheets[$j][1])) ;
	     $cot2 =str_replace("&nbsp;",'',trim($sheets[$j][2])) ;
	 
	//	if(ord($mahang[1])==160)   $makh = substr($makh,2,strlen($makh)-2) ;
  	    $mauchu ='black';
	  //  echo $sheets[$j][2] .'123';
	 	if ($cot1==''&& $cot2=='') break ;
		//$ten= $sheets[$j][3] ;
		//$tel= $sheets[$j][4] ;
	     if($re['name']!=$ten ) { $mauchu ='Red';   }  
 		 if ($re['ID']=='' ) { $mauchu ='Red';   }  
		 if($re['tel']!=$tel ) { $mauchu ='Red';   } 
		 $T1= addslashes($sheets[$j][0]) ;
		 $T2= addslashes($sheets[$j][1]) ;
		 $T3= addslashes($sheets[$j][2]) ;
		 $T4= addslashes($sheets[$j][3]) ;
		 $T5= addslashes($sheets[$j][4]) ;
		 $T6= addslashes($sheets[$j][5]) ;
		 $T7= addslashes($sheets[$j][6]) ;
		 $T8= addslashes($sheets[$j][7]) ;
		 $T9= addslashes($sheets[$j][8]) ;
		 $T10= addslashes($sheets[$j][9]) ;
		 $sql="insert into datatailen set t1='$T1',t2='$T2', t3='$T3', t4='$T4', t5='$T5', t6='$T6', t7='$T7', t8='$T8', t9='$T9', t10='$T10'";
       //  $tam=getdong($sql);
		 $result= $data->query($sql) ;
  ?>
        
 	 	<tr  style="cursor:pointer;color:<?php echo $mauchu ; ?> "   onMouseOver="this.className='<?php echo $hl2; ?>'" onMouseOut="this.className='<?php echo $hl; ?>'"  bgcolor="<?php echo $mau; ?>" >
		    <td align="right"><?php echo $stt  ;?></td>				
            <td  align="left"><?php echo $sheets[$j][0] ;?></td>
 			<td  align="left"><?php echo $sheets[$j][1] ;?></td>
 			<td  align="left"><?php echo $sheets[$j][2] ;?></td>
 			<td  align="left"><?php echo $sheets[$j][3] ;?></td>
 			<td  align="left"><?php echo $sheets[$j][4] ;?></td>
 			<td  align="left"><?php echo $sheets[$j][5] ;?></td>
 			<td  align="left"><?php echo $sheets[$j][6] ;?></td>
 			<td  align="left"><?php echo $sheets[$j][7] ;?></td>
 			<td  align="left"><?php echo $sheets[$j][8] ;?></td>
            <td  align="left"><?php echo $sheets[$j][9] ;?></td>
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