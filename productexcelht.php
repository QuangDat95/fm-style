<?php  
session_start();
 if ($_SESSION["LoginID"]=="") return ;
 
$root_path ='' ;
include($root_path."includes/config.php");
include($root_path."includes/removeUnicode.php");
 include($root_path."includes/class.mysql.php");
include($root_path."includes/function.php");

  	$tm = $_SESSION["root_path"] ; 
	 
 	require "./includes/class.dropshadow.php";
	require "./includes/class.originaldropshadow.php";
 	$luu    ="images/anhnho"  ;
 	
 function image_thumbnailanhlon($likanh,$luuanh,$size=255)
 {
   $colours = split(",","255,255,255");
    $tm =getcwd()."/"  ;
	$ds = new originalDropShadow();
	$ds->setDebugging(TRUE);
	$ds->setImageSize($size);
	$ds->setImageType("jpg");
	$ds->setShadowPath("images/shadows");
	$ds->createDropShadow($likanh, $luuanh, $colours);
	 
} 

function image_thumbnailtd($pic){
	$colours = split(",","255,255,255");
  $tm =getcwd()."/"  ;
	$ds = new originalDropShadow();
	$ds->setDebugging(TRUE);
	$ds->setImageSize("225");
	$ds->setImageType("jpg");
	$ds->setShadowPath("images/shadows");
	$ds->createDropShadow("images/gianhang/$pic", "images/anhnho/$pic", $colours);
	 
} 

function image_thumbnail2($pic){
	$colours = split(",","255,255,255");
 
	$ds = new originalDropShadow();
	$ds->setDebugging(TRUE);
	$ds->setImageSize("225");
	$ds->setImageType("jpg");
	$ds->setShadowPath("images/shadows");
	$ds->createDropShadow("images/gianhang/$pic", "images/anhnho/$pic", $colours);
}  
 
    $path = $root_path."data/phieugg.xls"  ;
	 
  	include( $root_path."excel/excel_reader.php");

$idk = laso($_SESSION["LoginID"]) ; if ($idk == 0) return ;
   
$data = new class_mysql();
$data->config();
$data->access();

  $data1 = $_POST['DATA']; 
  $tmp = explode('*@!',$data1);  
 
  $datatc = new Spreadsheet_Excel_Reader($path,true,"UTF-8"); 

	if ($datatc->sheets[0]['numRows']>6000 ) $sd = 6000 ; else $sd = $datatc->sheets[0]['numRows'] ;
	   
	  $dong = 2 ;
	  $toi = 300 ;   

?>
<div style="overflow:scroll;height:500px;color:#000">
<strong style="color:#F90">Đọc dữ liệu từ dòng 2 của file Excel</strong> <br />
<table id="tbex" width="100%" border="0" cellpadding="0" cellspacing="0" style="background:#FFF;" class="tbchuan">		
  		<tr bgcolor="#F8E4CB">
		  <td align="center"  height="23" width="38"><b>STT</b></td>
       
		    
          <td align="center"  height="23" width="63"><strong>Nhóm tin</strong></td>
		  <td width="52" align="center" ><strong>Mã SP</strong> </td> 		  
          <td width="50" align="center" ><strong>Tên Sản Phẩm</strong></td>         
           <td width="61" align="center"  ><strong>Màu</strong></td>  
           <td width="61" align="center"  ><strong>Size</strong></td>  
           
           <td width="52" align="center" ><strong>Giá Bán</strong> </td> 
		   <td width="427" align="center" ><strong>mô tả</strong></td>
           <td width="427" align="center" ><strong>Nội dung</strong></td>
           <td width="52" align="center" ><strong>ảnh theo màu</strong> </td>  
           <td width="52" align="center" ><strong>ảnh sildes</strong> </td>
		   <td width="52" align="center" ><strong>Link ảnh chính</strong> </td>  
            
 		</tr>
<?php 	 

      $mangmau  = taomang("mausac","LCASE(name)","ID"); 
	// echo "<pre>";
//		var_dump($mangmau);
//		echo "</pre>";
	  $mangsize = taomang("size","LCASE(name)","ID");  
	  $mangnhom = taomang("kh_nhomgianhang","LCASE(name)","ID"); 
	   $ngaytao = gmdate('Y-m-d H:i:s', time() + 7*3600);
	$mangtamtrunglap=[];
	$stt=0;  $loi = false ; $checktrunglap=true;
	for ($j = $dong; $j <= $sd ; $j++)
	{ 
		$stt++;    
 	    if($mau == "white"){$mau="#EEEEEE";$hl="Normal4";$hl2="Highlight4";}else{$mau="white";$hl = "Normal5" ;$hl2 = "Highlight5";} 
 		$mauchu ='black';
		$mahang =str_replace("&nbsp;",'',trim($datatc->sheets[0]['cells'][$j][3])) ;
		if(ord($mahang[1])==160)   $mahang = substr($mahang,2,strlen($mahang)-2) ;
		$giagiam = laso($datatc->sheets[0]['cells'][$j][5]) ;
		$giamp = 100-round($giagiam*100/$re['price'],3) ;
    	$nhom = $mangnhom[mb_strtolower(trim($datatc->sheets[0]['cells'][$j][2]),'UTF-8')] ;
		$mausac  = trim($datatc->sheets[0]['cells'][$j][5]);
		$size =  trim($datatc->sheets[0]['cells'][$j][6]);
		$Name = trim($datatc->sheets[0]['cells'][$j][4])  ;
		$NameEN = khongdau($Name);
		$giaban = laso($datatc->sheets[0]['cells'][$j][7]) ;
		$mota = trim($datatc->sheets[0]['cells'][$j][8]) ;
		$noidung = trim($datatc->sheets[0]['cells'][$j][9]) ;
		//$noidung3 = trim($datatc->sheets[0]['cells'][$j][10]) ;
		//$anh1 = trim($datatc->sheets[0]['cells'][$j][11]) ;
//		$anh2 = trim($datatc->sheets[0]['cells'][$j][12]) ;
//		$anh3 = trim($datatc->sheets[0]['cells'][$j][13]) ;
		$anhtheomau = trim($datatc->sheets[0]['cells'][$j][10]) ;
		$anhslides = trim($datatc->sheets[0]['cells'][$j][11]) ;
		$linkanhchinh = trim($datatc->sheets[0]['cells'][$j][12]);
		
		//xử lý màu và ảnh slide, ảnh theo màu
		$mausactam=explode("-",$mausac);
		$chuoimausac='';
		$mangmaukey=[];
		foreach($mausactam as $key => $value)
		{	$chuoimausac.='&*!'.$mangmau[mb_strtolower($value,'UTF-8')].'&*!'.$value;
			array_push($mangmaukey,$mangmau[mb_strtolower($value,'UTF-8')]); 
		}	
		
		$manganhtheomau=explode("-",$anhtheomau);
		$files=[];
		foreach($manganhtheomau as $key => $value)
		{
			$arrtam=array("color"=>$mangmaukey[$key],"images"=>$value);
			array_push($files,$arrtam);
		}
		
		$manganhslides=explode("-",$anhslides);
		
		foreach($manganhslides as $key => $value)
		{
			$arrtam=array("color"=>"","images"=>$value);
			array_push($files,$arrtam);
		}
		$files=json_encode($files);
		
		//xư lý size
		$sizetam=explode("-",$size);
		$chuoisize='';
		
		foreach($sizetam as $key => $value)
		{	$chuoisize.='&*!'.$mangsize[strtolower($value)].'&*!'.$value;
			
		}	
		
		
		//if ($linkanhchinh =='') $linkanhchinh =  $mahang.".jpg";
		
		//$noidung = addslashes($noidung);
 		//$nd=explode(".jpg",$noidung);
//		$soanh =count($nd);
//	 
		//echo "<pre>";
//		var_dump($nhom);
//		echo "</pre>";
//		$anh1ht =  "<img src='images/anhhangloat/$anh1' width='30px'  />" ;
//		$anh2ht =  "<img src='images/anhhangloat/$anh2' width='30px'  />" ;
//		$anh3ht =  "<img src='images/anhhangloat/$anh3' width='30px'  />" ;
//		$anhchinh =  "<img src='images/anhhangloat/$linkanhchinh' width='30px'  />" ;
 		
		$sql ="select count(*) as c from kh_gianghang where mahang='".$mahang."'";
		$query=$data->query($sql);
		$row=$data->fetch_array($query);
		$c=$row["c"];
		
	 	if ( $nhom=='' ) { $mauchu ='Red'; $loi=true;  } else $mauchu ='black';
		
		if ( $tmp[0]==999)  // lay du lieu
	    { 
			//$anh1luu ='';$anh2luu ='';$anh3luu ='';
	//		if ($anh1!=''){ $tenanh1 =$NameEN ."_".so_ngau_nhien()."_".rand()."_".$anh1;
	//						    if ($nhieuanh=='') $nhieuanh = $tenanh1 ; else $nhieuanh .= $tenanh1 ;	
	// 							image_thumbnailanhlon("images/anhhangloat/$anh1","images/anhnoidung/".$tenanh1,800);
	//							$anh1luu =  "<img src='images/anhnoidung/$tenanh1'  class='anhnoidung'  />" ;		}
	// 		if ($anh2!=''){$tenanh2 =$NameEN ."_".so_ngau_nhien()."_".rand()."_".$anh2;
	//						   if ($nhieuanh =='') $nhieuanh = $tenanh2 ; else $nhieuanh .= "*".$tenanh2 ;	
	// 							image_thumbnailanhlon("images/anhhangloat/$anh2","images/anhnoidung/".$tenanh2,800);
	//							$anh2luu =  "<img src='images/anhnoidung/$tenanh2' class='anhnoidung'  />" ;		}		
	// 		if ($anh3!=''){ $tenanh3 =$NameEN ."_".so_ngau_nhien()."_".rand()."_".$anh3;
	//							if ($nhieuanh =='') $nhieuanh = $tenanh3 ; else $nhieuanh .= "*".$tenanh3 ;		
	// 							image_thumbnailanhlon("images/anhhangloat/$anh3","images/anhnoidung/".$tenanh3,800); 
	//							$anh3luu =  "<img src='images/anhnoidung/$tenanh3'  class='anhnoidung'   />" ;		}	
	//	
	//		
	//		
	//		
	//										
	//		$noidung = $noidung1 ."<br>" .$anh1luu."<br>". $noidung2 ."<br>" .$anh2luu."<br>" . $noidung3 ."<br>" .$anh3luu;
	// 		$noidung = addslashes($noidung);
		$tenanh = $NameEN ."_".so_ngau_nhien()."_".rand()."_".$linkanhchinh;
  				     image_thumbnailanhlon("images/anhhangloat/$linkanhchinh","images/gianhang/".$tenanh,800);
 				     image_thumbnailtd($tenanh);

		
			if($c>0)
			{ 
			$checktrunglap=false;
				$mauchu ='Red';
				//array_push($mangtamtrunglap,array(
//					"IDcha"=>$nhom,
//					"Name"=>$Name,
//					"NameEN"=>$NameEN,
//					"noidung"=>$noidung,
//					"anhchinh"=>$tenanh,
//					"hienthi"=>1,
//					"ngaytao"=>$ngaytao,
//					"capnhap"=>$ngaytao,
//					"gia"=>$giaban,
//					"files"=>$files,
//					"size"=>$chuoisize,
//					"mau"=>$chuoimausac,
//					"mahang"=>$mahang, 
//				
//				));
			
			
			}
			else{
			
				$sql = "insert into  kh_gianghang  set IDcha='$nhom',Name='$Name',NameEN='$NameEN' ,noidung='$noidung',anhchinh='$tenanh',hienthi='1',
				ngaytao='$ngaytao',capnhap='$ngaytao',gia='$giaban',files='$files' ,size='$chuoisize',mau='$chuoimausac',mahang='$mahang'  "     ;		   
				$update = $data->query($sql);
			}
				
			
 		}
		
		if ($tmp[0]==9999)  // lay du lieu
	    { 
		
			if($c>0)
			{ 
				$sql = "update  kh_gianghang  set IDcha='$nhom',Name='$Name',NameEN='$NameEN' ,noidung='$noidung',anhchinh='$tenanh',hienthi='1',
				ngaytao='$ngaytao',capnhap='$ngaytao',gia='$giaban',files='$files' ,size='$chuoisize',mau='$chuoimausac' where mahang='$mahang'";		   
				$update = $data->query($sql);
			}
			else{
			
			}
		}
		if ($tmp[0]==99999)  // lay du lieu
	    { 
			$value=$tmp[1];
			if($c>0)
			{ 
				$sql = "update  kh_gianghang  set IDcha='$nhom',Name='$Name',NameEN='$NameEN' ,noidung='$noidung',anhchinh='$tenanh',hienthi='1',
				ngaytao='$ngaytao',capnhap='$ngaytao',gia='$giaban',files='$files' ,size='$chuoisize',mau='$chuoimausac' where mahang='$value'";		   
				$update = $data->query($sql);
				
			}
			else{
			
			}
		}
		
 	?>
        
 	 		<tr  style="cursor:pointer;color:<?php echo $mauchu ; ?> "   onMouseOver="this.className='<?php echo $hl2; ?>'" onMouseOut="this.className='<?php echo $hl; ?>'"  bgcolor="<? echo $mau ?>" >
		        <td     align="right"><?php echo $stt  ;?></td>				
                <td  align="left"><?php echo $datatc->sheets[0]['cells'][$j][2] .'-'.$nhom ;?></td>
				<td  align="left"><?php echo  $mahang ;?></td>
 				<td><?php echo $Name ;?></td>
                <td><?php echo ($datatc->sheets[0]['cells'][$j][5]).'-'.$mausac ;?></td>
				<td><?php echo ($datatc->sheets[0]['cells'][$j][6]).'-'.$size ;?></td>
                <td><?php echo $giaban;?></td>
                <td><?php echo $mota ;?></td>
                <td><?php echo $noidung ;?></td>
                <td><?php echo $anhtheomau ;?></td>
                <td><?php echo $anhslides ;?></td>
                <td><?php echo $linkanhchinh ;?></td>
				<?php
			//	
//				if($c>0)
//				{
//					 echo '<td><button value="'.$mahang.'" onclick="capnhatdulieumot(this.value)">Cập nhật</button></td>';
//				}
				?>
				
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
 		if($checktrunglap==false)
		{?>
		<span style="color:#FF0000">Phát hiện trùng lặp mã sản phẩm</span>
		<input type="button" id="update" name="update"  onclick="capnhatdulieu()" value="Update tất cả"/> 
<?php			
		}
 ?>
 <div style="padding-bottom:10px;padding-left:20px"><input type="button" id="dulieue" name="dulieue"  onclick="laydulieue(<?=$c?>)" value="Lấy dữ liệu Excel"/> </div>  
  <?php
 }

    $data->closedata() ;
?>	