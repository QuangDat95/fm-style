<?php  
session_start();
 
 //echo "Đang cập nhập vui lòng chờ trong vài phút nữa"; return ;
 
 $root_path =getcwd()."/"  ;
 $quyen= $_SESSION["quyen"] ; 
 $ql =$quyen[$_SESSION["mangquyenid"]["phieubugioduyet"]]  ;  
  $idl=$_SESSION["LoginID"];
//$ql[4]=4;
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
		  if ($trang!=0  ) $limit  =  " LIMIT ". 10000*($trang-1) .", ". 10000*($trang); else $limit =" limit 10000";
		$sql_where="  WHERE 1    "; 
		$sql_where2 = "" ;
		$sql_where3 = "" ;
		
		
		if($manv != ""){ $sql_where.=" and c.manv = '$manv'"; }
		if($ten != ""){ $sql_where.=" and d.ten = '$ten'"; }
		if($kho != "")
		{
	   		
  			$sql_where.=" and a.IDcuahang =  '$kho' ";
			
 		}else if ($_SESSION["loai_user"]==16)  
		{
		 	$kho = laso($_SESSION["se_kho"]); 	$sql_where.=" and b.IDtinh =  '$kho' ";
 		}else if ($_SESSION["loai_user"]==18)  
		{
		 	$kho = laso($_SESSION["se_kho"]); 	$sql_where.=" and b.NameN =  '$kho' ";
		}  	
		 
	
		 
		if($tinhtrang != ""){
			 if($tinhtrang == 0){ $sql_where.=" and a.tinhtrang = 1 or a.tinhtrang = 2 or a.tinhtrang = 7 "; 			} 
 			 else if($tinhtrang == 2){ $sql_where.= " and (left(a.tinhtrang,1)=2 or left(a.tinhtrang,1)=1) "; }
			 else if($tinhtrang ==3){ $sql_where.= " and  left(a.tinhtrang,1)=3 "; }
			 else if($tinhtrang ==4){ $sql_where.= " and  left(a.tinhtrang,1)=4 "; }
			 else if($tinhtrang ==1){ $sql_where.= " and  right(a.tinhtrang,1)=4 "; } // giam sat duyet
		}
		
	 if($tu!="")	
		{
		  $ngay=  explode('/',$tu);
	   	  if (strlen($ngay[1])== 1) {  $ngay[1] = "0".$ngay[1] ;  }
		  if (strlen($ngay[0])== 1) {  $ngay[0] = "0".$ngay[0] ;  } 
		    //$sql_where2 .= " and  p.Ngaytao>= '$ngay[2]-$ngay[1]-$ngay[0]'";
			//$sql_where3 .= " and  aa.NgayTao>= '$ngay[2]-$ngay[1]-$ngay[0]'";
		  $sql_where  .= " and  a.thoigianbatdau>= '$ngay[2]-$ngay[1]-$ngay[0]'";
		}
		 
		if($den!="")	
		{
		  $ngay=  explode('/',$den);
	   	  if (strlen($ngay[1])== 1) {  $ngay[1] = "0".$ngay[1] ;  }
		  if (strlen($ngay[0])== 1) {  $ngay[0] = "0".$ngay[0] ;  } 
			//  $sql_where2 .= " and  p.Ngaytao<= '$ngay[2]-$ngay[1]-$ngay[0] 23:59'";
			//   $sql_where3 .= " and  aa.NgayTao<= '$ngay[2]-$ngay[1]-$ngay[0] 23:59'";
		  $sql_where  .= " and  a.thoigianbatdau<= '$ngay[2]-$ngay[1]-$ngay[0] 23:59'";
		}	
		//
//		$sql_where2.=" and  c.IDkho<>1106 ";
//		
//		if  ($luachon==0 || $luachon==2) { $sapxep  = "desc" ; $banchay = " and soluong >0 ";} else { $sapxep = "asc" ; $banchay = " ";}
//	    $matam = taomang("groupproduct","ID","Name"," where 1  ") ;
//		if($ql[3] )  $mangncc = taomang("nhacungcap","ID","Name"," where 1  ") ; else $mangncc ="";
//		 
	// 	$sql = "  select a.IDSP,b.Name,a.mahang,b.IDGroup, sum(a.SoLuong) as sl,b.price as Gia from `xuatbanhang` a left join products b on a.IDSP = b.ID left join phieunhapxuat c on c.ID = a.IDphieu  $sql_where group by a.IDSP order by sl  $sapxep " ;
 
   
		 
	 
		$sql = "SELECT a.tinhtrang,a.ID,DATE_FORMAT(a.ngaybu,'%d/%m/%Y') as ngaybu,a.idcuahang,d.ten as nguoitao,d.chucvu as chucvutao,a.ngayxacnhan1,b.name as tencuahang,a.thoigianbatdau,a.thoigianketthuc,DATE_FORMAT(a.ngaytao,'%d/%m/%Y') as ngaytao,DATE_FORMAT(a.ngayxacnhan2,'%d/%m/%Y %H:%i') as ngayduyet,DATE_FORMAT(a.ngayxacnhan1,'%d/%m/%Y %H:%i') as ngayxacnhan1,a.lydo,a.sophut,a.lydoNS,a.lydoGS,c.Ten, c.MaNV, c.ChucVu FROM phieubugio a left join cuahang b on a.idcuahang=b.id  left join userac c on a.IDNV = c.ID  left join userac d on a.IDtao = d.ID  ".$sql_where."   ORDER BY a.ID desc ";
 
	//	$query_rows = $data->query($sql);
		//$result_rows = $data->num_rows($query_rows);
		$result = $data->query($sql);
		
		
		//$i = $page_start; 
//		$mangnhanvien =taomang("userac","ID","ten"," where tinhluong = '1'  ") ;
	//echo  $sql ;

  if ($_SESSION["admintuan"])	echo  $sql ;
	 
 // echo  "Chờ tí nhé. đang chỉnh lại báo cáo tỉ lệ";  return ;
     
	 
	//==============================================================	
	//$mangnhanvien =taomang("userac","ID","ten"," where tinhluong = '1'  ") ;
?>
   	
<div style="display:auto;overflow:scroll;width:1050px;height:380px"  >
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="tbchuan" id="dopcccc">		
     <tr bgcolor="#F8E4CB">
			<td align="center" height="23" width="37"><b>STT</b></td>
            <td width="59" align="center"><strong>ID Phiếu</strong></td> 
            <td width="59" align="center"><strong>Ngày Tạo</strong></td> 
              <td width="64" align="center"><strong>Ngày Duyệt</strong></td>  
			  <td width="59" align="center"><strong>Người tạo </strong></td> 
			  <td width="59" align="center"><strong>Chức vụ</strong></td> 
 			  <td width="123" align="center" ><strong>Cửa Hàng</strong></td>
			<td width="73" align="center" ><strong>Mã NV</strong></td>      
       <td width="85" align="center"><strong>Tên NV </strong></td>
       <td width="91" align="center"><strong>Chức vụ </strong></td>
	   <td width="231" align="center"><strong>Ngày bù</strong></td>
	    <td width="231" align="center"><strong>Giờ vào</strong></td>
	    <td width="231" align="center"><strong>Giờ ra</strong></td>
	    <td width="150" align="center"><strong>Lý do</strong></td> 
	   <td width="29" align="center"><strong>Số giờ</strong></td>
 
     <td width="73" align="center" ><strong>Tình trạng</strong></td>	
     <?php   if( $ql[3] || $ql[4] ){   ?>  <td width="79" align="center" ><strong>Quản lý</strong></td> 
     <?php } ?> 
      <?php  if($ql[3] ||$ql[4]) {  ?>  <td width="75" align="center" ><strong>Giám sát/PNS</strong></td>  <?php } ?>  
     
    <td width="73" align="center" ><strong>xem</strong></td>	
	</tr>	
		
   <?php
 
	 $result = $data->query($sql); 
$tong=0;$tongsl=0; $r =0 ; $ngaytao = gmdate('Y-n-d H:i:s', time() + 7*3600) ;

  $cuahangtruong= 2; $giamsat= 3; $quanly= 4;  // 4 là 12   5 là 13   6  là 23  7 là 123 
   
  $mangchucvu =taomang("kh_chucvu","ID","Name"," where 1  ") ;
  $tongnghiphep=0;
  $ngaynhap = gmdate('Y-n-d', time() + 7*3600) ; $mangnghiphep= array();  
  while($re = $data->fetch_array($result))
	{    $r++ ;
 	     $mangnghiphep[$re['MaNV']]=1;
 		 if($mau=="white"){$mau="#EEEEEE";$hl="Normal4";$hl2="Highlight4";}else{$mau="white";$hl="Normal5";$hl2="Highlight5";} 
 	 		    $giamsat1='';$giamsat2='';$giamsat3='';$giamsat4='';$quanly1='';$quanly2='';$quanly3='';$quanly4='';
				$tinhtrang=$re["tinhtrang"]."00";
				$giamsat=$tinhtrang[0];
				$quanly=$tinhtrang[1]; 
				$tinhtrangduyet="Mới tạo" ;
 				if( $giamsat==4 ) {$tinhtrangduyet="Giám sát/Nhân sự Đã duyệt" ;  }  
				elseif ($giamsat==3)  $tinhtrangduyet="Giám sát/Nhân sự Không duyệt" ;  
				elseif ($giamsat==2)  $tinhtrangduyet="Chờ thông tin" ;  
				elseif ($giamsat==4||$quanly==1)  $tinhtrangduyet="Chờ NS duyệt" ; 
				elseif ($quanly==3)  $tinhtrangduyet="Quản lý Không duyệt" ;  
				elseif ($quanly==2)  $tinhtrangduyet="Chờ thông tin" ;  
				elseif ($quanly==4)  $tinhtrangduyet="Chờ NS duyệt" ; 
				
				if($giamsat==3||$giamsat==4)   $giamsatht='disabled';  else  $giamsatht='';  
			 	if( $quanly==3||$quanly==4  )   $quanlyht='disabled';  else  $quanlyht='';  
				
				$tam= "giamsat$giamsat='selected'; "; eval('$'.$tam);
 				$tam= "quanly$quanly='selected'; ";eval('$'.$tam);
				
				
				/*$ngaynghiphep = date("d-m-Y",strtotime($re["thoigianketthuc"]));
			    $sogio =   strtotime($re["thoigianketthuc"])- strtotime($re["thoigianbatdau"]);  
				$tongnghiphep += $sogio;
				$tam = floor($sogio/3600);			
				$sogio =   ($sogio- $tam*3600)/60 ;
				$sogio  =$tam.'h'.$sogio."'" ;*/
				 $sogio=$re["sophut"];
				 //echo $sogio;
				$gio = floor($sogio/60);			
				$phut =   $sogio%60 ;
				$sogio  =$gio.'h'.$phut."'" ;
	 ?>	
 	 	   <tr onMouseOut="this.className='<?php echo $hl; ?>'"  bgcolor="<?php echo $mau ;?>" >
		   <td   align="right"><?php echo $r ;?></td>	
		    <td ><?php echo $re['ID']  ;?></td>		    
			<td ><?php echo $re['ngaytao']  ;?></td>
             <td ><?php echo  ($re['ngayduyet']) ;?></td>
 			 <td ><?php echo $re['nguoitao'] ;?></td>
			 <td ><?php echo $mangchucvu[$re['chucvutao']] ;?></td>
			 
			 <td ><?php echo $re['tencuahang'] ;?></td>
			 <td ><?php echo $re['MaNV'];?></td>	  			 
             <td ><?php echo $re["Ten"];?></td>
			<td ><?php echo  $mangchucvu[$re["ChucVu"]];?></td>
		 <td ><?php echo $re['ngaybu'] ;?></td>
			   
  			<td ><?php echo   date('H:i  d/m',  strtotime($re["thoigianbatdau"]));?></td>
			<td ><?php echo  date('H:i d/m',  strtotime($re["thoigianketthuc"]))  ;?></td>
				 <td ><?php echo $re["lydo"];?></td><td ><?php echo  $sogio ;?></td>
 			<td  align="center"   ><b id="tinhtrang_<?php echo $re["ID"] ;  ?>" ><?php echo $tinhtrangduyet ;?></b></td>
			 <?php  if( $ql[3] ||$ql[4]) {  ?>
 			<td valign="top">
			 <select id="cpquanly<?php echo $re['ID']  ;?>"  <?php echo $quanlyht; ?>  onchange="goiduyet(<?php echo $re["ID"] ?>,<?php echo $idl ?>,'<?php echo $re["Ten"] ?>','quanly',this.value)">
					<option value="1"  <?php  echo $quanly1; ?> >Chưa duyệt</option> 
					<option value="2"  <?php  echo $quanly2; ?> >Xác nhận bù giờ</option> 
					<option value="3"  <?php  echo $quanly3; ?> >Không duyệt</option>
					<option value="4"  <?php  echo $quanly4; ?> >Duyệt</option>
			  </select>
				 <br /><?php  if ($quanly==2||$quanly==3) echo  "<span id='lydoquanly".$re['ID']."'>".$re["lydoNS"].'<span>' ; elseif($quanly==4) echo  date('H:i  d-m-Y',  strtotime($re["ngayxacnhan1"]))   ; ?>	
				 <span id='lydoquanly<?=$re['ID']?>'><span>
				 		</td> <?php }
				 	
				  ?>  
				  <?php  if( $ql[3]||$ql[4]) {  ?>
			<td valign="top">
				<select id="cpgiamsat<?php echo $re['ID']  ;?>" name="cpgiamsat<?php echo $re['ID']  ;?>"  <?php echo $giamsatht; ?>   onchange="goiduyet(<?php echo $re["ID"] ?>,<?php echo $idl ?>,'<?php echo $re["Ten"] ?>','giamsat',this.value)">
					<option value="1" <?php  echo $giamsat1; ?> >Chưa duyệt</option> 
					<option value="2"  <?php  echo $giamsat2; ?> >Chờ điều chỉnh</option>
					<option value="3"  <?php  echo $giamsat3; ?> >Không duyệt</option>
					<option value="4"  <?php  echo $giamsat4; ?> >Duyệt</option>
				</select>
				  <br /> <?php  if ($giamsat==2||$giamsat==3) echo "<span id='lydo".$re['ID']."'>".$re["lydoGS"].'<span>'  ; ?>			 <span id='lydogiamsat<?=$re['ID']?>'><span></td>
			 <?php }?> 
			 
			 <td onclick="showchitiet(<?=$re['ID']?>,'poupduyetbugioct')" style="cursor:pointer">Xem</td> 
    </tr>
<?php	 			

	}
?>	
</table>

</div>
  <div style="padding:5px;" > 
  <strong style="font-size:18px;color:#0066CC"> Có <?php echo count($mangnghiphep); ?> nhân viên bù giờ - Tổng số giờ bù: 
  <?php 
  		$tam = floor($tongnghiphep/3600); $sogio =($tongnghiphep- $tam*3600)/60 ;  $sogio  =$tam.'h'.$sogio."'" ; echo $sogio ; ?> </strong>
   
  </div>
	
  
  <?php				
    $data->closedata() ;
?>	