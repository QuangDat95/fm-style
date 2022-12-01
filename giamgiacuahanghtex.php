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
 
    $path = $root_path."data/giamgia.xlsx"  ;
	   	include( $root_path."excel/simplexlsx.class.php"); 
  //	include( $root_path."excel/excel_reader.php");

$idk = laso($_SESSION["LoginID"]) ; if ($idk == 0) return ;
   
$data = new class_mysql();
$data->config();
$data->access();

  $data1 = $_POST['DATA']; 
  $tmp = explode('*@!',$data1);  
  $IDcuahang = laso($tmp[0]) ; 

  //	$datatc = new Spreadsheet_Excel_Reader($path,true,"UTF-8"); 

  
	$datatc = new SimpleXLSX($path);
	$sheets=$datatc->rows();
	
	$sd= count($sheets) ;   
	
		if ($sd>6000 ) $sd = 6000 ;  
	  $dong = 1 ;
	  $toi = 1000 ;  
	   
 // $ngay= "2021/08/20 23:59 " ;
//echo kiemtrangay($ngay,'Y-m-d H:m') ;  return ;
?>
<div style="overflow:scroll;height:400px">
<strong style="color:#F90">Đọc dữ liệu từ dòng 2 của file Excel</strong> <br />
<div id="hienthitim">
<table id="tbex" width="100%" border="0" cellpadding="0" cellspacing="0" style="background:#FFF;" class="tbchuan">		
 		<tr bgcolor="#F8E4CB">
		  <td align="center" height="23" width="35"><b>STT</b></td>
          <td align="center" height="23" width="43" title="ALL là tất cả"><b>Mã CH</b></td>
          <td align="center" height="23" width="43"><b>IDSP</b></td>
		  <td width="98" align="center" ><strong>Mã Hàng Hóa</strong></td>  
		  <td width="98" align="center" ><strong>Mã mô tả</strong></td>  	   
		  <td width="383" align="center" class="cothienthi"><strong>Tên Hàng Hóa</strong> </td> 
          <td width="163" align="center" class="cothienthi"><strong>Đơn giá</strong> </td> 
          <td width="49" align="center" ><strong>Giá BQ</strong></td>   
		  <td width="72" align="center" class="cothienthi"><strong>Giá giảm</strong></td>
          <td width="72" align="center" class="cothienthi"><strong>% Giảm</strong></td>
            <td width="427" align="center" class="cothienthi"><strong>từ ngày</strong></td>
              <td width="427" align="center" class="cothienthi"><strong>Tới ngày</strong></td>
		   <td width="427" align="center" class="cothienthi"><strong>Ghi chú</strong></td>
		    
 		</tr>
<?php 	 
		$stt=0;  $loi = false ; $dongloi=0;
		$mangcuahang =taomangs("cuahang","LCASE(macuahang)","ID"," where id>0"); 
		$mangcuahang['all']=-1;
		for ($j = $dong; $j <= $sd ; $j++)
		{ 
		$stt++;    
   		
	   if($mau == "white"){$mau="#EEEEEE";$hl="Normal4";$hl2="Highlight4";}else{$mau="white";$hl = "Normal5" ;$hl2 = "Highlight5";} 

		$mauchu ='black';
		$codegg=$sheets[$j][2];
		$mahang =str_replace("&nbsp;",'',trim($sheets[$j][1])) ;
		
		if(ord($mahang[1])==160)   $mahang = substr($mahang,2,strlen($mahang)-2) ;
		$mota =str_replace("&nbsp;",'',trim($sheets[$j][2])) ;
		if(ord($mota[1])==160)   $mota = substr($mota,2,strlen($mota)-2) ;
		$mota ='';	
			
		$giagiam = laso($sheets[$j][5]) ;
		
 		
		//if ($mota!='') $sql = "select * from products where code ='$mota' limit 1 " ;
		
				
		  	$mauchu="black" ;
	  
		if ($mahang==''){
			if ($codegg!=''){
				$sqlc = "select * from products where code ='$codegg' limit 1 " ;
				 $result=$data->query($sqlc);
				 while($re =$data->fetch_array($result)){
					$giamp = 100-round($giagiam*100/$re['price'],3) ;
					if ($giagiam < $re['giabinhquan']) $mauchu="Red" ; 
					//   if(!($idk==1||$idk==179)) $re['giabinhquan']=0; 
					if ($mach !='-1')   $mach= laso($mangcuahang[strtolower(trim($sheets[$j][7]))]) ;
						
					   $tungay=  $sheets[$j][8];  $dung1=chuyenngay($tungay,'dd-mm-yyyy') ;   
					   if($dung1=='') {$dung1=chuyenngay($tungay,'yyyy-mm-dd') ; } $tungay=$dung1;
					   $toingay=  $sheets[$j][9];  $dung2=chuyenngay($toingay,'dd-mm-yyyy') ;   
					   if($dung2=='') {$dung2=chuyenngay($toingay,'yyyy-mm-dd')   ;}   $toingay=$dung2; 
					   if($mach==0 || $dung1=="" || $dung2=="") {  $mauchu ='Red'; $loi=true ;if ($dongloi=='') $dongloi=$stt;} else 
					   { $mauchu ='black';
					   if ($re['ID']=='' ) { $mauchu ='Red'; $loi=true ;if ($dongloi=='') $dongloi=$stt;} else $mauchu ='black';
					   }
					  
					    
					 
					?>
					
					<tr  style="cursor:pointer;color:<?php echo $mauchu ; ?> " onClick="setlaiphieu('<?php echo $re['ID'] ;?>','<?php echo $re['dakhoa'] ;?>')" onMouseOver="this.className='<?php echo $hl2; ?>'" onMouseOut="this.className='<?php echo $hl; ?>'"  bgcolor="<?php echo $mau; ?>" >
					  <td    align="right"><?php echo $stt  ;?></td>				
							<td align="left"><?php echo $sheets[$j][1] . "-" . $mach  ;?></td>
							 <td align="left"><?php echo $re['ID'] ;?></td>
							<td align="left"><?php echo  $re['codepro'] ;?></td>
							<td  ><?php echo ($re['mota']);?></td>
							<td  ><?php echo ($re['Name']);?></td>
							<td align="right" ><?php echo (formatso($re['price'])) ;?></td>
							<td  align="right"><?php echo  formatso($re['giabinhquan']) ;?></td>
							<td align="right" ><?php echo formatso($giagiam); ?></td>
							
							<td  ><?php echo $giamp  ."%" ;?></td>
							<td  ><?php echo $tungay . "-" .$dung1 ;?></td>
							<td  ><?php echo $toingay . "-" .$dung2;?></td>
							<td  ><?php echo ($sheets[$j][5]) ;?></td>
						 
					</tr>
			  	 <?php 
				}
			   
			}
			
		}
		else{
			$sql = "select * from products where codepro ='$mahang' limit 1 " ;
			$re = getdong($sql);
			if($re['price']>0){
				$giamp = 100-round($giagiam*100/$re['price'],3) ;
			}
			  $sql=" select ID from giamgiacuahang where  IDSP='$re[ID]' and  giagiam='$giagiam'  and IDcuahang='$IDcuahang' limit 1 " ;
		$tam = getdong($sql); 
		  
				  if ($giagiam < $re['giabinhquan']) $mauchu="Red" ; 
		  
		  
		  
		 
		//   if(!($idk==1||$idk==179)) $re['giabinhquan']=0; 
		if ($mach !='-1')   $mach= laso($mangcuahang[strtolower(trim($sheets[$j][7]))]) ;
		    
		   $tungay=  $sheets[$j][8];  $dung1=chuyenngay($tungay,'dd-mm-yyyy') ;   
		   if($dung1=='') {$dung1=chuyenngay($tungay,'yyyy-mm-dd') ; } $tungay=$dung1;
 		   $toingay=  $sheets[$j][9];  $dung2=chuyenngay($toingay,'dd-mm-yyyy') ;   
		   if($dung2=='') {$dung2=chuyenngay($toingay,'yyyy-mm-dd')   ;}   $toingay=$dung2; 
		   if($mach==0 || $dung1=="" || $dung2=="") {  $mauchu ='Red'; $loi=true ;if ($dongloi=='') $dongloi=$stt;} else 
		   { $mauchu ='black';
		   if ($re['ID']=='' ) { $mauchu ='Red'; $loi=true ;if ($dongloi=='') $dongloi=$stt;} else $mauchu ='black';
		   }
		  
		   
		 
 		?>
        
 	 	<tr  style="cursor:pointer;color:<?php echo $mauchu ; ?> " onClick="setlaiphieu('<?php echo $re['ID'] ;?>','<?php echo $re['dakhoa'] ;?>')" onMouseOver="this.className='<?php echo $hl2; ?>'" onMouseOut="this.className='<?php echo $hl; ?>'"  bgcolor="<?php echo $mau; ?>" >
		  <td    align="right"><?php echo $stt  ;?></td>				
                <td align="left"><?php echo $sheets[$j][1] . "-" . $mach  ;?></td>
                 <td align="left"><?php echo $re['ID'] ;?></td>
				<td align="left"><?php echo  $re['codepro'] ;?></td>
 				<td  ><?php echo ($re['mota']);?></td>
				<td  ><?php echo ($re['Name']);?></td>
                <td align="right" ><?php echo (formatso($re['price'])) ;?></td>
                <td  align="right"><?php echo  formatso($re['giabinhquan']) ;?></td>
				<td align="right" ><?php echo formatso($giagiam); ?></td>
                
				<td  ><?php echo $giamp  ."%" ;?></td>
                <td  ><?php echo $tungay . "-" .$dung1 ;?></td>
                <td  ><?php echo $toingay . "-" .$dung2;?></td>
                <td  ><?php echo ($sheets[$j][5]) ;?></td>
             
    </tr>
   <?php 
    }
   	} 
   	
   ?>
		
		 
		
		
      
 
	  
   
</table>  
</div>
</div>   
<?php  
if ( $loi ) {?>

<div style="padding-bottom:10px;padding-left:20px"><input type="button" id="dulieue" name="dulieue"  onclick="xuatbaoloi('Có lỗi trong file tải lên chú ý chổ màu đỏ!','<?php   echo $dongloi ;?>')" value="Lấy dữ liệu Excel"/> </div>  

 
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