<?php  
session_start();
 
     $id = $_SESSION["LoginID"]  ;
     $quyen= $_SESSION["quyen"] ; 
	 $ql =$quyen[$_SESSION["mangquyenid"]["baocaotile"]]  ;  
 	 if( $ql[0]!=1  ){return;}

//$ql[5]=5;

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
 
        $ten   =  ($tmp[0])   ;
        $ma= trim($tmp[1])  ;
		$nhom= laso($tmp[2]) ;
		$kho= laso($tmp[3]) ;
		$tu= trim($tmp[4]) ;
		$den= trim($tmp[5]) ;
		$luachon= laso($tmp[6]) ;
	   
	   
		  if ($trang!=0  ) $limit  =  " LIMIT ". 10000*($trang-1) .", ". 10000*($trang); else $limit =" limit 10000";
		$sql_where="  WHERE 1    "; 
		$sql_where2 = "" ;
		$sql_where3 = "" ;
		if ($tuso>0)
		{
			  $dodait = strlen($ten) ; $dodaim = strlen($ma) ;
				if($ten!="" )	$sql_where.=" and SUBSTRING(p.Name,$tuso,$dodait)= '$ten' ";
				if($ma!="" )	$sql_where.=" and SUBSTRING(p.codepro,$tuso,$dodaim)='$ma'";			
		}
		else
		{
			if ($nangcao=="true")
			{
				if($ten!="" )	$sql_where.=" and p.Name  like '".$ten."%'";
				if($ma!="" )	$sql_where.=" and p.codepro like '".$ma."%'";
			}else
			{
				if($ten!="" )	$sql_where.=" and a.sochungtu like '%".$ten."%'";
				if($ma!="" )	$sql_where.=" and p.codepro like '%".$ma."%'";
			}
         } 


		if(  $nhom>0)
		{
	   		$nhom = $nhom.timnhom("groupproduct","IDGroup",$nhom);
  			$sql_where.=" and p.IDGroup in ( $nhom ) ";
 		}
		if(  $ncc>0)
		{
	   		 
  			$sql_where.=" and p.congtho = $ncc";
 		}
	 if($tu!="")	
		{
			
		  $ngay=  explode('/',$tu);
	   	  if (strlen($ngay[1])== 1) {  $ngay[1] = "0".$ngay[1] ;  }
		  if (strlen($ngay[0])== 1) {  $ngay[0] = "0".$ngay[0] ;  }   
		  if($loaithoigian==1){
		    //$sql_where2 .= " and  p.Ngaytao>= '$ngay[2]-$ngay[1]-$ngay[0]'";
			//$sql_where3 .= " and  aa.NgayTao>= '$ngay[2]-$ngay[1]-$ngay[0]'";
			  $sql_where  .= " and  p.Ngaytao>= '$ngay[2]-$ngay[1]-$ngay[0]'";
 			} else
			{
				$sql_where2 .= " and  c.NgayNhap>= '$ngay[2]-$ngay[1]-$ngay[0]'";
				$sql_where3 .= " and  aa.NgayTao>= '$ngay[2]-$ngay[1]-$ngay[0]'";
 			}
		}
		 
		if($den!="")	
		{
		  $ngay=  explode('/',$den);
	   	  if (strlen($ngay[1])== 1) {  $ngay[1] = "0".$ngay[1] ;  }
		  if (strlen($ngay[0])== 1) {  $ngay[0] = "0".$ngay[0] ;  } 
		   if($loaithoigian==1){
			//  $sql_where2 .= " and  p.Ngaytao<= '$ngay[2]-$ngay[1]-$ngay[0] 23:59'";
			//   $sql_where3 .= " and  aa.NgayTao<= '$ngay[2]-$ngay[1]-$ngay[0] 23:59'";
			  $sql_where  .= " and  p.Ngaytao<= '$ngay[2]-$ngay[1]-$ngay[0] 23:59'";
		   } else 
		   {
			  $sql_where2 .= " and  c.NgayNhap<= '$ngay[2]-$ngay[1]-$ngay[0] 23:59'";
			   $sql_where3 .= " and  aa.NgayTao<= '$ngay[2]-$ngay[1]-$ngay[0] 23:59'";
			   
		   }
		}		
	    if(  $kho > 0 ) 
		{ $sql_where2.=" and  c.IDkho ='".$kho."'    ";$cuahang1=" and  hc.idcuahang ='$kho' ";
		  $cuahang2=" and  h.idcuahang ='$kho' ";
		    
			
		}
		
		$sql_where2.=" and  c.IDkho<>1106 ";
		
		if  ($luachon==0 || $luachon==2) { $sapxep  = "desc" ; $banchay = " and soluong >0 ";} else { $sapxep = "asc" ; $banchay = " ";}
	    $matam = taomang("groupproduct","ID","Name"," where 1  ") ;
		if($ql[3] )  $mangncc = taomang("nhacungcap","ID","Name"," where 1  ") ; else $mangncc ="";
		 
	// 	$sql = "  select a.IDSP,b.Name,a.mahang,b.IDGroup, sum(a.SoLuong) as sl,b.price as Gia from `xuatbanhang` a left join products b on a.IDSP = b.ID left join phieunhapxuat c on c.ID = a.IDphieu  $sql_where group by a.IDSP order by sl  $sapxep " ;
 
   
		 
	 
		$sql = "SELECT a.tinhtrang,a.ID as IDp,a.sochungtu,a.lydo1,a.lydo2,a.lydo3,a.idcuahang,a.thongtinsai,a.thongtindung,b.name as tencuahang,DATE_FORMAT(a.ngaytao,'%d/%m/%Y') as ngaytao,DATE_FORMAT(a.ngayxacnhan3,'%d/%m/%Y %H:%i') as ngayduyet,a.lydo FROM phieuyeucau a left join cuahang b on a.idcuahang=b.id   ".$sql_where." ORDER BY a.ID desc ";
 
		$query_rows = $data->query($sql);
		$result_rows = $data->num_rows($query_rows);
		$result = $data->query($sql);
		$i = $page_start; 
		$mangnhanvien =taomang("userac","ID","ten"," where tinhluong = '1'  ") ;
		$mangteams=taomang("lydonhapxuat","ID","Name","") ;

  if ($_SESSION["admintuan"])	echo  $sql ;
	 
 // echo  "Chờ tí nhé. đang chỉnh lại báo cáo tỉ lệ";  return ;
     
	 
	//==============================================================	
 ?>
   	
<div   style="display:auto;overflow:scroll;width:1050px;height:380px"  >
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="tbchuan" id="dopcccc">		
  		
    <tr bgcolor="#F8E4CB">
			<td align="center" height="23" width="48"><b>STT</b></td>
            <td width="132" align="center" ><strong>Số Hóa Đơn</strong></td>
            <td width="84" align="center"><strong>Ngày Tạo</strong></td> 
            <td width="96" align="center"><strong>Ngày Duyệt</strong></td>  
 			<td width="236" align="center" ><strong>Tên Của Hàng</strong></td>      
       <td width="158" align="center"><strong>Thông tin cần đổi</strong></td>
      <td width="158" align="center"><strong>Thông tin đúng</strong></td>
	  <td width="221" align="center"><strong>Lý Do</strong></td>  
     <td width="99" align="center" ><strong>Tình trạng</strong></td>	
     <?php if ($ql[1] || $ql[5]) {  ?>  <td width="76" align="center" ><strong>Cửa hàng trưởng</strong></td> <?php } ?> 
     <?php if ($ql[2] || $ql[5]) {  ?>  <td width="76" align="center" ><strong>Giám Sát</strong></td> <?php } ?> 
     <?php if ($ql[3] || $ql[5]) {  ?>  <td width="76" align="center" ><strong>Admin</strong></td><?php } ?> 
	 <td width="99" align="center" ><strong>Xem</strong></td>	
		</tr>	
		
		<?php
 
	 $result = $data->query($sql); 
$tong=0;$tongsl=0; $r =0 ; $ngaytao = gmdate('Y-n-d H:i:s', time() + 7*3600) ;

/* $cuahangtruong= 1; $giamsat= 2; $adminql= 3;  // 4 là 12   5 là 13   6  là 23  7 là 123 
  if ($re['tinhtrang']== 7)
  {
	     $tinhtrangCHT="Đã duyệt";$tinhtranggiamsat="Đã duyệt";$tinhtrangadminql = "Đã duyệt" ; $cuahangtruong= 0; $giamsat= 0;$adminql= 0;
  } 
  else  if ($re['tinhtrang']== 1)
  {
	   $tinhtrangCHT="Đã duyệt" ; $tinhtranggiamsat="Chưa duyệt"; $tinhtrangadminql="Chưa duyệt" ;$cuahangtruong= 0;$giamsat= 4;$adminql= 0;//$adminql= 5;
  } 
  else  if ($re['tinhtrang']== 2)
  {
	   $tinhtrangCHT="Chưa duyệt";$tinhtranggiamsat="Đã duyệt";$tinhtrangadminql="Chưa duyệt" ;$cuahangtruong= 4;$giamsat= 0;$adminql= 0;//$adminql= 6;
  } else  if ($re['tinhtrang']== 3) // cái này sẻ không xảy ra nữa 
  {
	   $tinhtrangCHT="Chưa duyệt" ; $tinhtranggiamsat="Chưa duyệt" ;  $tinhtrangadminql="Đã duyệt" ;$cuahangtruong= 5;$giamsat= 6;$adminql=0;
  }else  if ($re['tinhtrang']== 4) // chỉ mỗi cái này là quản lý mới duyệt
  {
	   $tinhtrangCHT="Đã duyệt" ;  $tinhtranggiamsat="Đã duyệt" ;   $tinhtrangadminql="Chưa duyệt" ;$cuahangtruong= 0;$giamsat= 0;$adminql=7;
  }
  else  if ($re['tinhtrang']== 5) // cái này sẻ không xảy ra nữa 
  {
	    $tinhtrangCHT="Đã duyệt" ; $tinhtranggiamsat="Chưa duyệt" ;  $tinhtrangadminql="Đã duyệt" ;$cuahangtruong= 0;$giamsat= 7;$adminql=0;
  }
  else  if ($re['tinhtrang']== 6)  // cái này sẻ không xảy ra nữa 
  {
	   $tinhtrangCHT="Chưa duyệt"; $tinhtranggiamsat="Đã duyệt" ;  $tinhtrangadminql="Đã duyệt" ;$cuahangtruong= 7;$giamsat= 0;$adminql= 0;
  }
  
  else{$tinhtrangCHT="Chưa duyệt"; $tinhtranggiamsat = "Chưa duyệt" ;  $tinhtrangadminql = "Chưa duyệt" ;$cuahangtruong= 1; $giamsat= 2;$adminql=0; }//adminql=3*/
  
  
  $ngaynhap = gmdate('Y-n-d', time() + 7*3600) ;
  while($re = $data->fetch_array($result))
	{    $r++ ;
 		 if($mau=="white"){$mau="#EEEEEE";$hl="Normal4";$hl2="Highlight4";}else{$mau="white";$hl="Normal5";$hl2="Highlight5";} 
		  $giamdoc0='';$giamdoc1='';$giamdoc2='';$giamdoc3='';$giamdoc4='';$ketoan0='';$ketoan1='';$ketoan2='';$ketoan3='';$ketoan4='';$thumua0='';$thumua1='';$thumua2='';$thumua3='';$thumua4='';
				$tinhtrang=$re["tinhtrang"]."11";
				//thumua=cuahang,ketoan=giamsat,giamdoc=admin
				$thumua=$tinhtrang[0];
				//echo $tinhtrang;
				$ketoan=$tinhtrang[1]; 
				$giamdoc=$tinhtrang[2];
				$tinhtrangduyet="Chưa duyệt" ;
				 if($giamdoc==4) {$tinhtrang="Đã duyệt" ;  }  
				elseif ($ketoan==3)  $tinhtrang="Không duyệt" ;  
				elseif ($ketoan==2)  $tinhtrang="Chờ thông tin" ;  
				elseif ($ketoan==4 )  $tinhtrang="Chờ admin duyệt" ; 
				elseif (($ketoan==1||$ketoan==2) && $thumua==4)  $tinhtrang="Chờ giám sát duyệt" ; 
				elseif ($thumua==3)  $tinhtrang="Không duyệt" ;  
				elseif ($thumua==2)  $tinhtrang="Chờ thông tin" ;  
				elseif ($thumua==4 )  $tinhtrang="Chờ giám sát duyệt" ; 
				elseif ($thumua==1||$thumua==2)  $tinhtrang="Chờ cửa hàng duyệt" ;		
				$giamdocht=''; $ketoanht='disabled'; $thumuaht='disabled';
				if($ketoan!=4){
					if($thumua==4){
						$ketoanht='';
					}
					else if($thumua==3){
						$thumuaht='disabled';
						$ketoanht='disabled';
						$giamdocht='disabled';
					}
					else{
						$thumuaht='';
					}
					if($ketoan==4){
						$ketoanht='disabled';
						
					}
					else if($ketoan==3){
						$thumuaht='disabled';
						$ketoanht='disabled';
						$giamdocht='disabled';
					}
					
				}
				
				if($giamdoc==3 || $giamdoc==4){
						$thumuaht='disabled';
						$ketoanht='disabled';
						$giamdocht='disabled';
					}
				/*if($giamdoc==3||$giamdoc==4)   $giamdocht='disabled';  else  $giamdocht='';  
				if(($ketoan==4||$ketoan==3||$giamdoc==0||$giamdoc==1||$giamdoc==2||$giamdoc==3))   $ketoanht='disabled';  else  $ketoanht='';  
				if(($thumua==4||$giamdoc==0||$giamdoc==1||$giamdoc==2||$giamdoc==3 ||$ketoan==0||$ketoan==1||$ketoan==2||$ketoan==3))   $giamdocht='disabled'; $ketoanht='disabled';  else  $ketoanht='';  */
				$tam= "giamdoc$giamdoc='selected'; "; eval('$'.$tam);
 				$tam= "ketoan$ketoan='selected'; ";eval('$'.$tam);
				$tam= "thumua$thumua='selected'; ";eval('$'.$tam);
 	 			
				  
	 ?>
 	 	   <tr onMouseOut="this.className='<?php echo $hl; ?>'"  bgcolor="<?php echo $mau ;?>" >
		   <td   align="right"><?php echo $r ;?></td>	
 		    <td ><?php echo $re['sochungtu']  ;?></td>	
		    <td ><?php echo $re['ngaytao']  ;?></td>
           <td ><?php echo  ($re['ngayduyet']) ;?></td>
			 <td ><?php echo $re['tencuahang'] ;?></td>	  
			 
			 <?php
			 	$arrdung=explode('&*!',$re["thongtindung"]);
				$arrsai=explode('&*!',$re["thongtinsai"]);
				$thongtindung='';
				$thongtinsai='';
				if($arrdung[1]==1){
					$thongtindung=$arrdung[0].': '.$mangnhanvien[$arrdung[2]];
 					$thongtinsai=$arrsai[0].': '.$mangnhanvien[$arrsai[2]];
				}
				else if($arrdung[1]==2){
					$thongtindung=$arrdung[0].': '.$mangnhanvien[$arrdung[2]];
 					$thongtinsai=$arrsai[0].': '.$mangnhanvien[$arrsai[2]];
				}
				else if($arrdung[1]==3){
				
					$thongtindung=$arrdung[0].': '.$mangteams[$arrdung[2]];
 					$thongtinsai=$arrsai[0].': '.$mangteams[$arrsai[2]];
				}
				else if($arrdung[1]==4){
				
					$thongtindung=$arrdung[0].': '.$arrdung[2];
 					$thongtinsai=$arrsai[0].': '.$arrsai[2];
				}
 				else if($arrdung[1]==5 || $arrdung[1]==6){
				
					$thongtindung=$arrdung[0].': '.$arrdung[2];
 					$thongtinsai=$arrsai[0].': '.$arrsai[2];
				}
				
			 
			 ?>			 
             <td ><?php echo  $thongtinsai;?></td>
			<td ><?php echo  $thongtindung;?></td>
  
   <td  align="center" > <?php echo $re['lydo'] ;?> </td>
                 <td  align="center"   ><b id="tinhtrang_<?php echo $re["IDp"] ;  ?>" ><?php echo $tinhtrang ;?></b></td>
			 <?php if($ql[1] || $ql[5]) {  ?>
			<td style="    max-width: 200px;
    word-break: break-word;" valign="top">
				<select id="cpthumua<?php echo $re['IDp']  ;?>" name="cpketoan<?php echo $re['IDp']  ;?>"  <?php echo $thumuaht; ?>   onchange="goiduyet(<?php echo $re["IDp"] ?>,<?php echo $id ?>,'<?php echo $re["nguoitao"] ?>','thumua',this.value,'cpthumua')">
					<option value="1" <?php  echo $thumua1; ?> >Chưa duyệt</option> 
					<option value="2" <?php  echo $thumua2; ?> >Chờ điều chỉnh</option>
					<option value="3" <?php  echo $thumua3; ?> >Không duyệt</option>
					<option value="4" <?php  echo $thumua4; ?> >Duyệt</option>
				</select>
				  <br /><span id="lydo<?php echo $re['IDp']  ;?>"> <?php  if ($thumua==2||$thumua==3) echo  $re["lydo1"]   ; ?>  <span>
				  	  </td>
					  
			 <?php } ?> 	
			
				  <?php  if($ql[2] || $ql[5]) {  ?>
			<td style="    max-width: 200px;
    word-break: break-word;" valign="top">
				<select id="cpketoan<?php echo $re['IDp']  ;?>" name="cpketoan<?php echo $re['IDp']  ;?>"  <?php echo $ketoanht; ?>   onchange="goiduyet(<?php echo $re["IDp"] ?>,<?php echo $id ?>,'<?php echo $re["nguoitao"] ?>','ketoan',this.value,'cpketoan')">
					<option value="1" <?php  echo $ketoan1; ?> >Chưa duyệt</option> 
					<option value="2" <?php  echo $ketoan2; ?> >Chờ điều chỉnh</option>
					<option value="3" <?php  echo $ketoan3; ?> >Không duyệt</option>
					<option value="4" <?php  echo $ketoan4; ?> >Duyệt</option>
				</select>
				  <br /><span id="lydo<?php echo $re['IDp']  ;?>"> <?php  if ($ketoan==2||$ketoan==3) echo  $re["lydo2"]   ; ?> </span> 
				  	  </td>
					  
			 <?php } ?> 	 
			  <?php  if($ql[5]) { ?>
 			<td style="    max-width: 200px;
    word-break: break-word;" valign="top">
			 <select id="cpgiamdoc<?php echo $re['IDp']  ;?>"  <?php echo $giamdocht; ?>  onchange="goiduyet(<?php echo $re["IDp"] ?>,<?php echo $id ?>,'<?php echo $re["nguoitao"] ?>','giamdoc',this.value,'cpgiamdoc')">
					<option value="1"  <?php  echo $giamdoc1; ?> >Chưa duyệt</option> 
 					<option value="2"  <?php  echo $giamdoc2; ?> >Chờ thông tin</option>
					<option value="3"  <?php  echo $giamdoc3; ?> >Không duyệt</option>
					<option value="4"  <?php  echo $giamdoc4; ?> >Duyệt</option>
			  </select>
				 <br /><span id="lydo<?php echo $re['IDp']  ;?>"><?php  if ($giamdoc==2||$giamdoc==3) echo  $re["lydo3"] ; elseif($giamdoc==3) echo  date('H:i  d-m-Y',  strtotime($re["ngayxacnhan2"]))   ; ?></span>
				 </td> 
				 <?php } ?>  
			
			
			<td width="76" align="center" id="xem<?php echo $re["IDp"] ;  ?>"><b  style="cursor:pointer" onclick="xemchitiet(<?php echo $re["IDp"];?>,'<?php echo  $re['sochungtu'] ;?>')">Xem</b>    </td>
    </tr>
<?php	 			

	}
?>	
   
 
</table>
 </div>
  <div style="padding:5px;" > 
     
   
  </div>


  <?php				
    $data->closedata() ;
?>	