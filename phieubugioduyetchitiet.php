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
 
        
        $id= trim($tmp[0]);
		
		 
	 
		$sql = "SELECT a.tinhtrang,a.ID,DATE_FORMAT(a.ngaybu,'%d/%m/%Y') as ngaybu,a.idcuahang,d.ten as nguoitao,d.chucvu as chucvutao,a.ngayxacnhan1,b.name as tencuahang,a.thoigianbatdau,a.thoigianketthuc,DATE_FORMAT(a.ngaytao,'%d/%m/%Y') as ngaytao,DATE_FORMAT(a.ngayxacnhan2,'%d/%m/%Y %H:%i') as ngayduyet,DATE_FORMAT(a.ngayxacnhan1,'%d/%m/%Y %H:%i') as ngayxacnhan1,a.lydo,a.lydoNS,a.lydoGS,c.Ten, c.MaNV, c.ChucVu FROM phieubugio a left join cuahang b on a.idcuahang=b.id  left join userac c on a.IDNV = c.ID  left join userac d on a.IDtao = d.ID  where a.IDNV=$id   ORDER BY a.ID desc ";
 
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
<style>
 #duyetformbugio{
 	font-size:16px !important;
	
 }
 	#showformbugio table td{
		font-size:1.4em;
		padding:0.5em;
	}
	#showformbugio{
		width: 100%;
		height: 100%;
		margin-top: 2em;
		font-size: 3em;
		overflow:scroll;
		    height: 90vh;
	}
	
		#showformbugio select {
			    font-size: 50px;
    width: 50%;
		
		}
	#duyetformbugio{
			display:flex;
		width:100%;
		height:100%;
		background-color:#FFFFFF;
		flex-direction: column;
		padding:1em;
	}
	
	#duyetformbugio button{
			    background-color: unset;
			border: none;
			font-size: 6em;
	}
	#titl{
		    font-size: 3em;
    display: flex;
    flex-direction: column;	
	}
	#titl span{
		
	}
	
	#showformbugio .form{
		    display: flex;
		flex-wrap: wrap;
		    flex-direction: column;
	}
	#showformbugio .form >div{
		width:100%;
	}
	#showformbugio .form .block_d{
	
	}
	#showformbugio .form .block_d >div{
		width:100%;
		display: flex;
		
    flex-direction: column;
	}
	#showformbugio .form .block_d  label{
		width:50% !important;
	}
	#showformbugio .form .block_i >div{
		margin-bottom:0.5em;
		width:100%;
		
	}
	
	#showformbugio .form .block_i >div .break_w{
	word-break: break-all;
	display: inline-flex;
    width: 55%;
	}
	#showformbugio .form .block_i label{
		width:410px;
	}
	#showformbugio .ghichu{
		width:410px;
	}
	#loading1{
		display:none;
	}
	.btn2{
		background-color: #ffc107 !important;
	}
	.btn3{
		background-color: #ff5722  !important;
	}
	
	.btn4{
		background-color: #4caf50 !important;
	}
	.btn{
		    font-size: 1em !important;
		padding: 0.5em;
		
		color: #ffffff;
	}
	#duyetformbugio table tr td,table tr th{
		font-size:14px !important;
	}
	@media all and (min-width: 600px) {
		#duyetformbugio{
		font-size:16px !important;
		
	 }
		#showformbugio table td{
			font-size:1.4em;
			padding:0.5em;
		}
		#showformbugio{
			width: 100%;
			height: 100%;
			margin-top: 2em;
			font-size: 3em;
			overflow:scroll;
				height: 90vh;
		}
		
			#showformbugio select {
					font-size: 50px;
		width: 50%;
			
			}
		#duyetformbugio{
				display:flex;
			width:100%;
			height:100%;
			background-color:#FFFFFF;
			flex-direction: column;
			padding:1em;
		}
		
		#duyetformbugio button{
					background-color: unset;
				border: none;
				font-size: 6em;
		}
		#titl{
				font-size: 3em;
		display: flex;
		flex-direction: column;	
		}
		#titl span{
			
		}
		
		#showformbugio .form{
				display: flex;
			flex-wrap: wrap;
				flex-direction: column;
		}
		#showformbugio .form >div{
			width:100%;
		}
		#showformbugio .form .block_d >div{
			width:100%;
			display: flex;
		}
		#showformbugio .form .block_d  label{
			width:50% !important;
		}
		#showformbugio .form .block_i >div{
			margin-bottom:0.5em;
			width:100%;
		}
		#showformbugio .form .block_i label{
			width:410px;
		}
		
	}
	
	@media all and (min-width: 1024px) {
		#duyetformbugio{
		font-size:16px !important;
		
	 }
	 #showformbugio .ghichu{
		width:20% !important;
	}
		#duyetformbugio{
		
		}
		#showformbugio{
			width: 100%;
			height: 80%;
			margin-top: 1em;
			font-size: 1em;
			overflow:scroll;
				height: 90vh;
		}
		
			#showformbugio select {
					font-size: 14px;
		width: 50%;
			
			}
		#duyetformbugio{
				display:flex;
			width:92%;
			height:80%;
			background-color:#FFFFFF;
			flex-direction: column;
			padding:1em;
		}
		
		#duyetformbugio button{
					background-color: unset;
				border: none;
				font-size: 2em;
		}
		#titl{
			    font-size: 1em;
    display: flex;
    flex-direction: row;
}
		
		#titl span{
			margin-left:1em;
		}
		
		#showformbugio .form{
				display: flex;
			flex-wrap: wrap;
				    flex-direction: row;
		}
		#showformbugio .form >div{
			width:50%;
		}
		#showformbugio .form .block_d{
			width:100%;
			display: flex;
		}
		#showformbugio .form .block_d >div{
			    flex-direction: row;
		}
		#showformbugio .form .block_d  label{
			width:30% !important;
		}
		#showformbugio .form .block_i >div{
			margin-bottom:1em;
			width:100%;
			
		}
		#showformbugio .form .block_i label{
			width:40%;
		}
		#showformbugio .form .block_d .btn_w{
			width:60%;
		}
	}
	
	@media all and (min-width: 1280px){
		#duyetformbugio{
			
		}
		#poupduyetbugio{
				height:100vh;
		}
	}
 </style>
<div id="duyetformbugio">
		<div style="    display: flex;
    width: 100%;
    justify-content: space-between;
    padding-bottom: 1em;
    align-items: center;
    border-bottom: 1px solid #148a1426;">
	<div id="titl"><span><strong style="color:#FF0000">Chi tiết phiếu bù giờ</strong></span>
	<span><strong style="color:red">Màu đỏ là phiếu chưa/không duyệt</strong></span>
	<span><strong style="color:green">Màu xanh là phiếu đã duyệt</strong></span>
		<div id="khonghienthi" style="display: "></div>
	</div><button type="button" id="closepo" onclick="closepop('poupduyetbugio')">x</button></div>
	<div id="showformbugio"> 	
<div style="display:auto;width:1050px;height:380px"  >
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
				
				if($giamsat==4||$giamsat==4){
					$mauchu="green";
				}
				else{
					$mauchu="red";
				}
				
				$tam= "giamsat$giamsat='selected'; "; eval('$'.$tam);
 				$tam= "quanly$quanly='selected'; ";eval('$'.$tam);
				 
				
				$ngaynghiphep = date("d-m-Y",strtotime($re["thoigianketthuc"]));
			    $sogio =   strtotime($re["thoigianketthuc"])- strtotime($re["thoigianbatdau"]);  
				$tongnghiphep += $sogio;
				$tam = floor($sogio/3600);			
				$sogio =   ($sogio- $tam*3600)/60 ;
				$sogio  =$tam.'h'.$sogio."'" ;

	 ?>	
 	 	   <tr onMouseOut="this.className='<?php echo $hl; ?>'"  bgcolor="<?php echo $mau ;?>" style="color:<?=$mauchu?>" >
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
 			<td valign="top" style="min-width:100px">
			 <select style="font-size:14px;width:100%" id="cpquanly<?php echo $re['ID']  ;?>"  <?php echo $quanlyht; ?>  onchange="goiduyet(<?php echo $re["ID"] ?>,<?php echo $idl ?>,'<?php echo $re["Ten"] ?>','quanly',this.value)">
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
			<td valign="top" style="min-width:100px">
				<select style="font-size:14px;width:100%" id="cpgiamsat<?php echo $re['ID']  ;?>" name="cpgiamsat<?php echo $re['ID']  ;?>"  <?php echo $giamsatht; ?>   onchange="goiduyet(<?php echo $re["ID"] ?>,<?php echo $idl ?>,'<?php echo $re["Ten"] ?>','giamsat',this.value)">
					<option value="1" <?php  echo $giamsat1; ?> >Chưa duyệt</option> 
					<option value="2"  <?php  echo $giamsat2; ?> >Chờ điều chỉnh</option>
					<option value="3"  <?php  echo $giamsat3; ?> >Không duyệt</option>
					<option value="4"  <?php  echo $giamsat4; ?> >Duyệt</option>
				</select>
				  <br /> <?php  if ($giamsat==2||$giamsat==3) echo "<span id='lydo".$re['ID']."'>".$re["lydoGS"].'<span>'  ; ?>			 <span id='lydogiamsat<?=$re['ID']?>'><span></td>
			 <?php }?> 
			 
			 <td onclick="showchitietbugioct(<?=$re['ID']?>)" style="cursor:pointer">Xem</td> 
    </tr>
<?php	 			

	}
?>	
</table>

</div>
  <div style="padding:5px;" > 
  <strong style="font-size:18px;color:#0066CC"> Tổng số giờ bù: 
  <?php 
  		$tam = floor($tongnghiphep/3600); $sogio =($tongnghiphep- $tam*3600)/60 ;  $sogio  =$tam.'h'.$sogio."'" ; echo $sogio ; ?> </strong>
   
  </div>
	
  </div>
	</div>
  <?php				
    $data->closedata() ;
?>	