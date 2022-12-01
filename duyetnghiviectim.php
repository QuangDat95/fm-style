<?php  
session_start();
 
 
 
 $root_path =getcwd()."/"  ;
 $quyen= $_SESSION["quyen"] ; 
 $ql =$quyen[$_SESSION["mangquyenid"][$_SESSION["act"]]];  
  $idl=$_SESSION["LoginID"];
//var_dump($ql);
$ql[5]=5;
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
		$sql_where="  WHERE 1=1"; 
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
			$sql_where.=" and c.IDcuahang =  '$kho' ";
		}
		
		
		
      if($tinhtrang != ""){
			$groupby='tinhtrang';
			if($tinhtrang == 0){
				//$sql_where.=" and a.tinhtrang = 111 or a.tinhtrang = 112 or a.tinhtrang = 121 ";
			} else if($tinhtrang == 1){
				$sql_where.=" and left(a.tinhtrang,1) = 4";
			} else if($tinhtrang == 2){
				$sql_where.= " and left(a.tinhtrang,1) = 1 or left(a.tinhtrang,1) = 2";
  			} 
			else if($tinhtrang == 3){
				$sql_where.= " and left(a.tinhtrang,1) = 3 ";
  			} 
			else if($tinhtrang == 4){
				$sql_where.= " and right(left(a.tinhtrang,2),1) = 4 ";
  			} 
			else if($tinhtrang == 5){
				$sql_where.= " and right(left(a.tinhtrang,2),1) = 1 or left(a.tinhtrang,2) = 2";
  			} 
			else if($tinhtrang == 6){
				$sql_where.= " and right(left(a.tinhtrang,2)) = 3";
  			} 
			else if($tinhtrang == 7){
				$sql_where.= " and right(a.tinhtrang,1) = 4 ";
  			} 
			else if($tinhtrang == 8){
				$sql_where.= " and right(a.tinhtrang,1) = 1 or left(a.tinhtrang,2) = 2";
  			} 
			else if($tinhtrang == 9){
				$sql_where.= " and right(a.tinhtrang,1) = 3";
  			} 
			 
		}
		
		
		
	 if($tu!="")	
		{
		  $ngay=  explode('/',$tu);
	   	  if (strlen($ngay[1])== 1) {  $ngay[1] = "0".$ngay[1] ;  }
		  if (strlen($ngay[0])== 1) {  $ngay[0] = "0".$ngay[0] ;  } 
		    //$sql_where2 .= " and  p.Ngaytao>= '$ngay[2]-$ngay[1]-$ngay[0]'";
			//$sql_where3 .= " and  aa.NgayTao>= '$ngay[2]-$ngay[1]-$ngay[0]'";
		  $sql_where  .= " and  a.ngaytao>= '$ngay[2]-$ngay[1]-$ngay[0]'";
		}
		 
		if($den!="")	
		{
		  $ngay=  explode('/',$den);
	   	  if (strlen($ngay[1])== 1) {  $ngay[1] = "0".$ngay[1] ;  }
		  if (strlen($ngay[0])== 1) {  $ngay[0] = "0".$ngay[0] ;  } 
			//  $sql_where2 .= " and  p.Ngaytao<= '$ngay[2]-$ngay[1]-$ngay[0] 23:59'";
			//   $sql_where3 .= " and  aa.NgayTao<= '$ngay[2]-$ngay[1]-$ngay[0] 23:59'";
		  $sql_where  .= " and  a.ngaytao<= '$ngay[2]-$ngay[1]-$ngay[0] 23:59'";
		}	
 
   
		 
	 
		$sql = "SELECT a.ID as IDp,a.soct,a.lydo,a.sotien,a.tinhtrang,a.ID,a.idcuahang,c.Ten as nguoitao,a.chucvu,a.manv , b.name as tencuahang ,DATE_FORMAT(a.ngaytao,'%d/%m/%Y') as ngaytao,DATE_FORMAT(a.ngaynghidexuat,'%d/%m/%Y') as ngaynghidx,DATE_FORMAT(a.ngaynghiduyet,'%d/%m/%Y ') as ngaynghid,DATE_FORMAT(a.ngaynghithuc,'%d/%m/%Y ') as ngaynghit,DATE_FORMAT(a.ngaygiamdoc,'%d/%m/%Y %H:%i') as ngayduyet,a.ghichu,a.lydothumua,a.lydoketoan,a.lydogiamdoc  FROM duyetnghiviec a left join cuahang b on a.idcuahang=b.id  left join userac c on a.IDNV = c.ID    ".$sql_where." order by  a.ngaytao desc ";
 //echo $sql;
 if($_SESSION['admintuan'] ) echo $sql ;
	//	$query_rows = $data->query($sql);
		//$result_rows = $data->num_rows($query_rows);
		$result = $data->query($sql);
		
		
		//$i = $page_start; 
//		$mangnhanvien =taomang("userac","ID","ten"," where tinhluong = '1'  ") ;
	

  if ($_SESSION["admintuan"])	echo  $sql ;
	 
 // echo  "Chờ tí nhé. đang chỉnh lại báo cáo tỉ lệ";  return ;
     
	 
	//==============================================================	
	//$mangnhanvien =taomang("userac","ID","ten"," where tinhluong = '1'  ") ;
?>
   	
<div style="display:auto;overflow:scroll;width:1050px;height:380px"  >
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="tbchuan" id="dopcccc">		
     <tr bgcolor="#F8E4CB">
			<td align="center" height="23" width="33"><b>STT</b></td>
             <td width="20" align="center"><strong>Ngày Tạo </strong></td> 
              <td width="40" align="center"><strong>Ngày Duyệt</strong></td>  
   			  <td width="80" align="center" ><strong>Cửa Hàng</strong></td>
			<td width="50" align="center" ><strong>Mã NV</strong></td>      
       <td width="57" align="center"><strong>Tên NV </strong></td>
       <td width="65" align="center"><strong>Chức vụ </strong></td>
	 
	    <td width="150" align="center"><strong>Ghi chú </strong></td> 
		<td width="150" align="center"><strong>Lý do </strong></td>
	    <td width="53" align="center"><strong>ngày nghỉ đề xuất</strong></td>
		  
  <td width="53" align="center"><strong>ngày nghỉ duyệt</strong></td>
   <td width="53" align="center"><strong>ngày nghỉ thực</strong></td>
     <td width="55" align="center" ><strong>Tình trạng</strong></td>	
      <?php  if($ql[1] || $ql[5]) {  
	  //	echo "ok";
	  ?>  
	  
	  <td width="131" align="center" ><strong>Giám sát</strong></td>  
      <?php } ?>  
      <?php   if($ql[2] || $ql[5]){   ?> 
	  <td width="123" align="center" ><strong>Nhân sự</strong></td> 
      <?php } ?>
	  
	   <td width="53" align="center"><strong>Xem</strong></td>
	</tr>	
		
   <?php
 
	 $result = $data->query($sql); 
$tong=0;$tongsl=0; $r =0 ; $ngaytao = gmdate('Y-n-d H:i:s', time() + 7*3600) ;

  $cuahangtruong= 1; $giamsat= 2; $ketoan= 3;  // 4 là 12   5 là 13   6  là 23  7 là 123 
   //$mangchucvu =taomang("kh_chucvu","ID","Name"," where 1  ") ;
  $tongtien =0;
  $ngaynhap = gmdate('Y-n-d', time() + 7*3600) ; $mangtangca= array();  
  while($re = $data->fetch_array($result))
	{    $r++ ;
 	     $mangtangca[$re['MaNV']]=1;
 		 if($mau=="white"){$mau="#EEEEEE";$hl="Normal4";$hl2="Highlight4";}else{$mau="white";$hl="Normal5";$hl2="Highlight5";} 
 	 		    $giamdoc0='';$giamdoc1='';$giamdoc2='';$giamdoc3='';$giamdoc4='';$ketoan0='';$ketoan1='';$ketoan2='';$ketoan3='';$ketoan4='';$thumua0='';$thumua1='';$thumua2='';$thumua3='';$thumua4='';
				$tinhtrang=$re["tinhtrang"]."11";
				
				$ketoan=$tinhtrang[0]; 
				$giamdoc=$tinhtrang[1];
				$tinhtrangduyet="Chưa duyệt" ;
				if($giamdoc==4) {$tinhtrangduyet="Nhân sự đã duyệt" ;  }  
				elseif ($giamdoc==3)  $tinhtrangduyet="Nhân sự không duyệt" ; 
				elseif ($ketoan==3)  $tinhtrangduyet="Giám sát không duyệt" ;  
				elseif ($ketoan==2)  $tinhtrangduyet="Giám sát chờ thông tin" ;  
				elseif ($ketoan==4 )  $tinhtrangduyet="Chờ nhân sự duyệt" ;
				elseif ($ketoan==1)  $tinhtrangduyet="Chờ giám sát duyệt" ; 
				//ke toán = giám sát
				// giám đốc = nhấn sự
				$giamdocht='disabled'; $ketoanht='';
				if($ketoan==4){
					$ketoanht='disabled';
						$giamdocht='';
				}
				elseif($ketoan==3){
						$ketoanht='disabled';
						$giamdocht='disabled';
				}
				if($giamdoc==3 || $giamdoc==4){
						
						$ketoanht='disabled';
						$giamdocht='disabled';
					}
				/*if($giamdoc==3||$giamdoc==4)   $giamdocht='disabled';  else  $giamdocht='';  
				if(($ketoan==4||$ketoan==3||$giamdoc==0||$giamdoc==1||$giamdoc==2||$giamdoc==3))   $ketoanht='disabled';  else  $ketoanht='';  
				if(($thumua==4||$giamdoc==0||$giamdoc==1||$giamdoc==2||$giamdoc==3 ||$ketoan==0||$ketoan==1||$ketoan==2||$ketoan==3))   $giamdocht='disabled'; $ketoanht='disabled';  else  $ketoanht='';  */
				$tam= "giamdoc$giamdoc='selected'; "; eval('$'.$tam);
 				$tam= "ketoan$ketoan='selected'; ";eval('$'.$tam);
				

	 ?>	
 	 	   <tr onMouseOut="this.className='<?php echo $hl; ?>'"  bgcolor="<?php echo $mau ;?>"  >
		   <td   align="right"><?php echo $r ;?></td>	
 			 <td ><?php echo $re['ngaytao'] ;?></td>
             <td ><?php echo  ($re['ngayduyet']) ;?></td>
  			 <td ><?php echo $re['tencuahang'] ;?></td>
			 <td ><?php echo $re['manv'];?></td>	  			 
             <td ><?php echo $re["nguoitao"];?></td>
			 <td ><?php echo $re["chucvu"] ;?></td>
 			
			  <td style="    max-width: 200px;
    word-break: break-word;"><?php echo $re["ghichu"];?></td>
			   <td style="    max-width: 200px;
    word-break: break-word;"><?php echo $re["lydo"];?></td>
			
		     <td ><?php echo $re['ngaynghidx']  ;?></td>
			 		     <td ><?php echo $re['ngaynghid']  ;?></td>
						 		     <td ><?php echo $re['ngaynghit']  ;?></td>	 	 	 
 			<td  align="center" title="<?php echo  $re['tinhtrang']  ;?>"   ><b id="tinhtrang_<?php echo $re["IDp"] ;  ?>" ><?php echo $tinhtrangduyet ;?></b></td>
			
			  	
			
				  <?php  if($ql[1] || $ql[5]) {  ?>
			<td style="    max-width: 200px;
    word-break: break-word;" valign="top">
				<select id="cpketoan<?php echo $re['IDp']  ;?>" name="cpketoan<?php echo $re['IDp']  ;?>"  <?php echo $ketoanht; ?>   onchange="goiduyet(<?php echo $re["IDp"] ?>,<?php echo $idl ?>,'<?php echo $re["nguoitao"] ?>','ketoan',this.value,'cpketoan')">
					<option value="1" <?php  echo $ketoan1; ?> >Chưa duyệt</option> 
					<option value="2" <?php  echo $ketoan2; ?> >Chờ điều chỉnh</option>
					<option value="3" <?php  echo $ketoan3; ?> >Không duyệt</option>
					<option value="4" <?php  echo $ketoan4; ?> >Duyệt</option>
				</select>
				  <br /><span id="lydo<?php echo $re['IDp']  ;?>"> <?php  if ($ketoan==2||$ketoan==3) echo  $re["lydoketoan"]   ; ?> </span> 
				  	  </td>
					  
			 <?php } ?> 	 
			  <?php  if($ql[2] || $ql[5]) { ?>
 			<td style="    max-width: 200px;
    word-break: break-word;" valign="top">
			 <select id="cpgiamdoc<?php echo $re['IDp']  ;?>"  <?php echo $giamdocht; ?>  onchange="goiduyet(<?php echo $re["IDp"] ?>,<?php echo $idl ?>,'<?php echo $re["nguoitao"] ?>','giamdoc',this.value,'cpgiamdoc')">
					<option value="1"  <?php  echo $giamdoc1; ?> >Chưa duyệt</option> 
 					<option value="2"  <?php  echo $giamdoc2; ?> >Chờ thông tin</option>
					<option value="3"  <?php  echo $giamdoc3; ?> >Không duyệt</option>
					<option value="4"  <?php  echo $giamdoc4; ?> >Duyệt</option>
			  </select>
				 <br /><span id="lydo<?php echo $re['IDp']  ;?>"><?php  if ($giamdoc==2||$giamdoc==3) echo  $re["lydogiamdoc"] ; elseif($giamdoc==3) echo  date('H:i  d-m-Y',  strtotime($re["ngayxacnhan2"]))   ; ?></span>
				 </td> 
				 <?php } ?>  
				 
				 <td onclick="showchitiet(<?=$re['IDp']?>)" style="cursor:pointer">Xem</td>
			   
    </tr>
<?php	 			

	}
?>	
</table>

</div>

  <?php				
    $data->closedata() ;
?>	