<?php  
session_start();
 
 
 
 $root_path =getcwd()."/"  ;
 $quyen= $_SESSION["quyen"] ; 
 $ql =$quyen[$_SESSION["mangquyenid"]["thuonghoadon"]]  ;  
  $idl=$_SESSION["LoginID"];

 if( !($ql[0] || $idl==1) ){return;}

	  
	
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
 
        
        $manv= trim($tmp[0]);
		$kho= laso($tmp[1]);
		$tu= trim($tmp[2]);
		$den= trim($tmp[3]);
		$tinhtrang= laso($tmp[4]);
		$ten= chonghack($tmp[5]);
		$loai= laso($tmp[6]);
		$sotien= laso($tmp[7]);
		$soct= trim($tmp[8]);
		 
		  if ($trang!=0  ) $limit  =  " LIMIT ". 10000*($trang-1) .", ". 10000*($trang); else $limit =" limit 10000";
		$sql_where="  WHERE 1    "; 
		$sql_where2 = "" ;
		$sql_where3 = "" ;
		
		
		if($manv != ""){ $sql_where.=" and c.manv = '$manv'"; }
		if($ten != ""){ $sql_where.=" and c.ten = '$ten'"; }
		if($sotien >0 ){ $sql_where.=" and a.sotien = '$sotien'"; }
		if($soct !='' ){ $sql_where.=" and a.soct like '$soct%'"; }
		if($kho != "")
		{
   			$sql_where.=" and a.IDcuahang =  '$kho' ";
 		}else if($_SESSION["loai_user"]==16)
		{
			$sql_where.=" and c.idtinh =  '$kho' ";
		}
		
		
		
       if($tinhtrang != ""){
			 if($tinhtrang == 0){   		} 
 			 else if($tinhtrang ==2){ $sql_where.= " and (left(a.tinhtrang,1)=2 or left(a.tinhtrang,1)=1) "; }
			 else if($tinhtrang ==3){ $sql_where.= " and  left(a.tinhtrang,1)=3 or right(a.tinhtrang,1)=3 "; }
			 else if($tinhtrang ==4){ $sql_where.= " and  right(a.tinhtrang,1)=4 "; }
			 else if($tinhtrang ==1){ $sql_where.= " and  left(a.tinhtrang,1)=4 and right(a.tinhtrang,1)<2 "; } // quan ly duyet
			 
		}
		
		
		
	 if($tu!="")	
		{
		  $ngay=  explode('/',$tu);
	   	  if (strlen($ngay[1])== 1) {  $ngay[1] = "0".$ngay[1] ;  }
		  if (strlen($ngay[0])== 1) {  $ngay[0] = "0".$ngay[0] ;  } 
		    //$sql_where2 .= " and  p.Ngaytao>= '$ngay[2]-$ngay[1]-$ngay[0]'";
			//$sql_where3 .= " and  aa.NgayTao>= '$ngay[2]-$ngay[1]-$ngay[0]'";
		  $sql_where  .= " and  a.ngayhoadon>= '$ngay[2]-$ngay[1]-$ngay[0]'";
		}
		 
		if($den!="")	
		{
		  $ngay=  explode('/',$den);
	   	  if (strlen($ngay[1])== 1) {  $ngay[1] = "0".$ngay[1] ;  }
		  if (strlen($ngay[0])== 1) {  $ngay[0] = "0".$ngay[0] ;  } 
			//  $sql_where2 .= " and  p.Ngaytao<= '$ngay[2]-$ngay[1]-$ngay[0] 23:59'";
			//   $sql_where3 .= " and  aa.NgayTao<= '$ngay[2]-$ngay[1]-$ngay[0] 23:59'";
		  $sql_where  .= " and  a.ngayhoadon<= '$ngay[2]-$ngay[1]-$ngay[0] 23:59'";
		}	
 
   
		 
	 
		$sql = "SELECT a.soct,a.tienhoadon,a.sotien,a.tinhtrang,a.loaihuong,a.ID,a.idcuahang,c.ten as nguoitao,a.chucvu,a.manv , b.name as tencuahang ,DATE_FORMAT(a.ngayhoadon,'%d/%m/%Y') as ngaytao,DATE_FORMAT(a.ngaynhansu,'%d/%m/%Y %H:%i') as ngayduyet,a.ghichu,a.lydoNS,a.lydoGS,c.Ten  FROM thuonghoadon a left join cuahang b on a.idcuahang=b.id  left join userac c on a.IDTV = c.ID    ".$sql_where." order by  a.ngayhoadon desc ";
 
 if($_SESSION['admintuan'] ) echo $sql ;
	//	$query_rows = $data->query($sql);
		//$result_rows = $data->num_rows($query_rows);
		$result = $data->query($sql);
		
		
		//$i = $page_start; 
//		$mangnhanvien =taomang("userac","ID","ten"," where tinhluong = '1'  ") ;
	

  if ($_SESSION["admintuan"])	echo  $sql ;
	 
 // echo  "Ch??? t?? nh??. ??ang ch???nh l???i b??o c??o t??? l???";  return ;
     
	 
	//==============================================================	
	//$mangnhanvien =taomang("userac","ID","ten"," where tinhluong = '1'  ") ;
?>
   	
<div style="display:auto;overflow:scroll;width:1050px;height:380px"  >
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="tbchuan" id="dopcccc">		
     <tr bgcolor="#F8E4CB">
			<td align="center" height="23" width="33"><b>STT</b></td>
             <td width="20" align="center"><strong>Ng??y B??n </strong></td> 
              <td width="40" align="center"><strong>Ng??y Duy???t</strong></td>  
   			  <td width="80" align="center" ><strong>C???a H??ng</strong></td>
			<td width="50" align="center" ><strong>M?? NV</strong></td>      
       <td width="57" align="center"><strong>T??n NV </strong></td>
       <td width="65" align="center"><strong>Ch???c v??? </strong></td>
	  <td width="65" align="center"><strong>S??? h??a ????n</strong></td>
	    <td width="150" align="center"><strong>Ghi ch?? h??a ????n </strong></td> 
	    <td width="53" align="center"><strong>Ti???n h??a ????n</strong></td>
		  <td width="48" align="center"><strong>Th?????ng</strong></td> 
		   <td width="48" align="center"><strong>%</strong></td> 
 
     <td width="55" align="center" ><strong>T??nh tr???ng</strong></td>	
  
      <?php  if( $ql[3] ||$ql[4]) {  ?>  <td width="131" align="center" ><strong>Gi??m s??t</strong></td>  
      <?php } ?>  
      <?php   if( $ql[3] || $ql[4] ){   ?>  <td width="123" align="center" ><strong>K??? To??n </strong></td> 
      <?php } ?> 
	</tr>	
		
   <?php
 
	 $result = $data->query($sql); 
$tong=0;$tongsl=0; $r =0 ; $ngaytao = gmdate('Y-n-d H:i:s', time() + 7*3600) ;

  $cuahangtruong= 1; $giamsat= 2; $ketoan= 3;  // 4 l?? 12   5 l?? 13   6  l?? 23  7 l?? 123 
   //$mangchucvu =taomang("kh_chucvu","ID","Name"," where 1  ") ;
  $tongtien =0;
  $ngaynhap = gmdate('Y-n-d', time() + 7*3600) ; $mangtangca= array();  
  while($re = $data->fetch_array($result))
	{    $r++ ;
 	     $mangtangca[$re['MaNV']]=1;
 		 if($mau=="white"){$mau="#EEEEEE";$hl="Normal4";$hl2="Highlight4";}else{$mau="white";$hl="Normal5";$hl2="Highlight5";} 
 	 		    $giamsat0='';$giamsat1='';$giamsat2='';$giamsat3='';$giamsat4='';$ketoan0='';$ketoan1='';$ketoan2='';$ketoan3='';$ketoan4='';
				$tinhtrang=$re["tinhtrang"]."11";
				$giamsat=$tinhtrang[0];
				$ketoan=$tinhtrang[1]; 
				$tinhtrangduyet="Ch??a duy???t" ;
				if($ketoan==4) {$tinhtrangduyet="???? duy???t" ;  }  
				elseif ($giamsat==3)  $tinhtrangduyet="Kh??ng duy???t" ;  
				elseif ($giamsat==2)  $tinhtrangduyet="Ch??? th??ng tin" ;  
				elseif ($giamsat==4 )  $tinhtrangduyet="Ch??? KT duy???t" ; 
				elseif ($giamsat==1||$giamsat==2)  $tinhtrangduyet="Ch??? GS duy???t" ; 
				
				if($giamsat==3||$giamsat==4)   $giamsatht='disabled';  else  $giamsatht='';  
				if(($ketoan==4||$ketoan==3||$giamsat==0||$giamsat==1||$giamsat==2||$giamsat==3))   $ketoanht='disabled';  else  $ketoanht='';  
				
				$tam= "giamsat$giamsat='selected'; "; eval('$'.$tam);
 				$tam= "ketoan$ketoan='selected'; ";eval('$'.$tam);
				$sotien=$re['sotien']* $re['loaihuong']/100 ;
				$tongtien += $sotien ;

	 ?>	
 	 	   <tr onMouseOut="this.className='<?php echo $hl; ?>'"  bgcolor="<?php echo $mau ;?>" >
		   <td   align="right"><?php echo $r ;?></td>	
 			 <td ><?php echo $re['ngaytao'] ;?></td>
             <td ><?php echo  ($re['ngayduyet']) ;?></td>
  			 <td ><?php echo $re['tencuahang'] ;?></td>
			 <td ><?php echo $re['manv'];?></td>	  			 
             <td ><?php echo $re["Ten"];?></td>
			 <td ><?php echo $re["chucvu"] ;?></td>
 			 <td ><?php echo $re["soct"];?></td>
			  <td ><?php echo $re["ghichu"];?></td>
			 <td ><?php echo formatso($re["tienhoadon"])  ;?></td>
		     <td ><?php echo formatso($sotien)  ;?></td>	 
			 <td ><?php echo  $re['loaihuong'].'%'  ;?></td>	
 			<td  align="center" title="<?php echo  $re['tinhtrang']  ;?>"   ><b id="tinhtrang_<?php echo $re["ID"] ;  ?>" ><?php echo $tinhtrangduyet ;?></b></td>
			 <?php  if( $ql[3] ||$ql[4]) {  ?>
 			<td valign="top">
			 <select id="cpgiamsat<?php echo $re['ID']  ;?>"  <?php echo $giamsatht; ?>  onchange="goiduyet(<?php echo $re["ID"] ?>,<?php echo $idl ?>,'<?php echo $re["Ten"] ?>','giamsat',this.value)">
					<option value="1"  <?php  echo $giamsat1; ?> >Ch??a duy???t</option> 
 					<option value="2"  <?php  echo $giamsat2; ?> >Ch??? th??ng tin</option>
					<option value="3"  <?php  echo $giamsat3; ?> >Kh??ng duy???t</option>
					<option value="4"  <?php  echo $giamsat4; ?> >Duy???t</option>
			  </select>
				 <br /><?php  if ($giamsat==2||$giamsat==3) echo  $re["lydoGS"] ; elseif($giamsat==3) echo  date('H:i  d-m-Y',  strtotime($re["ngayxacnhan2"]))   ; ?>			</td> <?php } ?>  
				  <?php  if( $ql[4]|| $ql[3]) {  ?>
			<td valign="top">
				<select id="cpketoan<?php echo $re['ID']  ;?>" name="cpketoan<?php echo $re['ID']  ;?>"  <?php echo $ketoanht; ?>   onchange="goiduyet(<?php echo $re["ID"] ?>,<?php echo $idl ?>,'<?php echo $re["Ten"] ?>','ketoan',this.value)">
					<option value="1" <?php  echo $ketoan1; ?> >Ch??a duy???t</option> 
					<option value="2" <?php  echo $ketoan2; ?> >Ch??? ??i???u ch???nh</option>
					<option value="3" <?php  echo $ketoan3; ?> >Kh??ng duy???t</option>
					<option value="4" <?php  echo $ketoan4; ?> >Duy???t</option>
				</select>
				  <br /> <?php  if ($ketoan==2||$ketoan==3) echo  $re["lydoKT"]   ; ?>  	  </td>
			 <?php } ?> 	  
    </tr>
<?php	 			

	}
?>	
</table>

</div>
  <div style="padding:5px;" > 
  <strong style="font-size:18px;color:#0066CC"> C?? <?php echo  $r ; ?> h??a ????n th?????ng - T???ng s??? ti???n th?????ng: 
  <?php  echo formatso($tongtien) ; ?> </strong>
   
  </div>
  
  <?php				
    $data->closedata() ;
?>	