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
 
 //=============================khoi tao ======================//  	 Xem  	 Them  	 Cap nhap  	 Tim  	Huy  	Khoa  	In
 if ( trim($_SESSION["LoginID"])== "" ) { $_SESSION["LoginID"] = $id ; }
   $data->setdangnhap($_SESSION["LoginID"],$us) ;

  $data->setthaotac = "khachhang" 	;
  $sql = "select Item,FunctionID from userright where  UserID  ='$id' and FunctionID = '10' " ;
  $tam = $data->truyvan($sql);	

  $cn  =  phanquyenthu($tam['Item'],"capnhap") ; 
  $xoa =  phanquyenthu($tam['Item'],"xoa") ;
  
   $sql = "select * from diemchietkhau order by tu " ;
   $result = $data->query($sql); 
   while($re = $data->fetch_array($result))
	{   
	  $mangc[$re['ID']] = array($re['tu'],$re['chietkhau']) ;
	}
  
 function timchietkhau($diem)
 {  
     global $mangc ;
     $chietkhau = 0;
	 
	 foreach ($mangc as $m)
	 {  
		 if($diem>=$m[0]) $chietkhau =$m[1] ;
	 }
	 return $chietkhau ;
 }
 if ($_SESSION["frm_xuathang"] == "1"  ) {  $cn ="";$xoa ="" ; }
 
 if(isset($_POST["UPDATEKH"])){
 
 		 $data1 = $_POST['UPDATEKH']; 
		  $tmp = explode('*@!',$data1);
		 //   echo $data1 ;
		  
		  $diachi=  (trim($tmp[0]))   ;
		  $IDKhuVuc  = trim($tmp[1])  ;		 
		   $quan  = trim($tmp[2])  ;
		  $phuong  = trim($tmp[3])  ;
		   $note  = trim($tmp[4])  ;
		   $makh=  (trim($tmp[5]))   ;
		   
			$sql="update customer set address='$diachi',IDKhuVuc='$IDKhuVuc',quan='$quan',phuong='$phuong',note='$note' where makh='$makh'";
			
			$update=$data->query($sql);
		if($update){
			echo  '###1####Cập nhật thành công###';
		}
	
	echo  '###2####Cập nhật lỗi###';
	
	return;
 }
 
 
  $data1 = $_POST['DATA']; 
  $tmp = explode('*@!',$data1);
 //   echo $data1 ;
  $loai  = trim($tmp[0])  ;		 
  
  $ten=  (trim($tmp[0]))   ;
  $dt =  (trim($tmp[1])) ;
  $makh= trim($tmp[2]) ;
  $trang= trim($tmp[5]) ;
  $nhom= trim($tmp[4]) ;
  $cm= trim($tmp[5]) ;
  $loai= trim($tmp[6]) ;
  
 //  echo "<br>". $dt;
 
		$sql_where=" where 1=1 ";
 		 if($ten!="")
			$sql_where.=" and c.Name like '%".$ten."%'";
		if($dt!="")
			$sql_where.=" and c.tel like '%".$dt."%'";	
		if($cm!="")
			$sql_where.=" and c.cmnd like '%".$cm."%'";				
		if($makh !="")
			$sql_where.=" and c.makh ='$makh'";
    	if($nhom !="")
			$sql_where.=" and c.nhomkh ='$nhom'";			
				$r =1 ;	 
 
		//	$sql = "SELECT k.loai as damua,c.makh,c.address,c.Name,c.tel,c.diemtichluy,c.note,c.ID as idkhach,DATE_FORMAT( c.ngaysinh,'%d/%m/%Y') as ngay  FROM customer c left join khuyenmai k on c.id= k.idkhach ".$sql_where."    ";
	 if ( $loai!=1) 
	 {
			$sql = "SELECT  c.IDKhuVuc,c.quan,c.phuong, c.note,c.makh,c.address,c.Name,c.tel,c.diemtichluy,c.note,c.ID as idkhach,DATE_FORMAT( c.ngaysinh,'%d/%m/%Y') as ngay,DATE_FORMAT( c.ngaytao,'%d/%m/%y') as ngaytaothe,c.nhomkh as nhomkhach,c.xungho as gioitinh  FROM customer c   ".$sql_where."    ";
	 } else
	 {
			$sql = "SELECT  c.IDKhuVuc, c.quan,c.phuong,c.note,c.makh,c.address,c.Name,c.tel,c.diemtichluy,c.note,c.ID as idkhach,DATE_FORMAT( c.ngaysinh,'%d/%m/%Y') as ngay,DATE_FORMAT( c.ngaytao,'%d/%m/%y') as ngaytaothe,c.nhomkh as nhomkhach,c.xungho as gioitinh  FROM customerluu c   ".$sql_where."    ";
	  } 
		
   if ($_SESSION['admintuan']) {  echo $sql ;   }
 	//========================================================
  if (!is_numeric($trang) ) $trang = 1 ;
   		if ($trang * 1  <= 0 ) $trang = 1 ;	
	 $result = $data->query($sql); 
	 $num=$data->num_rows($result);	
	 $pagesize = 50; 
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
				 else { $pt = $pt . " ". "<a style='cursor:pointer' onclick=\"timkiemkh('$tmp[0]','$tmp[1]','$tmp[2]','$tmp[3]','$tmp[4]','$i','$tmp[6]')\"  > $i </a> " ;  } 		  
			}
			
		  }
	  }
	  $r = $pagesize * $trang - $pagesize + 1  ;
	//==============================================================	
 

?>


<?php
//++++++++++++++++++


?>	



<div style="padding:5px;" ><?php  


 if($num>0){
 //echo $num;
		//if ($_SESSION["LoginID"]==1||$_SESSION["LoginID"]==2) $am = false ; else $am = true;
	while($re = $data->fetch_array($result))
	{
	 //if($mau == "white"){	 $mau = "#EEEEEE";	 $hl = "Normal4" ;	 $hl2 = "Highlight4";
//	  }else { $mau = "white";$hl = "Normal5" ;$hl2 = "Highlight5";} 
//		if ($am) { $re['tel'][2]='x' ;  $re['tel'][3]='x';    }
//		
//		
		if( laso($re['diemtichluy'])<100 || laso($re['damua'])>0) 
		{ $loaic='' ;  }
		 else 
		 { $loaic =1; 
		 }
		 
		 $ck= timchietkhau($re['diemtichluy']) ;
//		 
//	 
//			if ($loai==1)
//			{
	   // echo $re["quan"];
	 ?>
				<br />
		<fieldset  class="nencon">
			<legend> <a style="cursor:pointer"  >
			<label style="Color:#FF3300;Font-Weight:Bold;Font-size:11pt;" >Cập nhật thông tin</label>
			</a> </legend>
			<input type="hidden" id="taomoikhach" name="taomoikhach" value="1" />
			<div id="khachmoi">
		<table width="100%" border="0" cellpadding="2px" cellspacing="2px"  >
		  
		<tr>
			<td width="17%" align="right"><div align="right">Nguồn khách hàng &nbsp; </div></td>
			<td  >
				<select onkeypress="return chuyentieps(event,'Name')" name="nhomkh"  id="nhomkh"  disabled="disabled">
				  <option value="0" >Chưa xác định</option>
					<?php
					   echo composx("nhomkhachhang","Name",$re["nhomkhach"],"Rank") ;
					?>
				  </select>
				Số ĐT <input type="Text" name="telm" id="telm" style="width:100px"  autocomplete="off"   class="text"    value="<?php echo $re['makh'] ;?>" disabled="disabled"/>
				<span style="color:#FF0000"> *</span>  		
				Điểm tích lũy <span style="color:#FF0000"><?php echo $re['diemtichluy'] ;?>/<?php echo $ck ;?>%</span>	
			</td>
		</tr>
		 <tr>
			<td width="17%"  align="right">
				<div align="right">Tên Khách &nbsp;</div></td>
			<td colspan="3"><input type="Text" name="Namem" id="Namem"  class="text" style="width:427px" value="<?php echo $re['Name'] ;?>" onkeypress="return chuyentiep(event,'ngaysinh')" disabled="disabled"/>
			  <span style="color:#FF0000">*</span></td>
		</tr>
		<tr>
			<td width="17%"><div align="right">Ngày Sinh &nbsp;</div></td>
			<td  ><input  type="date"  name="ngaysinh" id="ngaysinh"   style="height:25px" class="text" size="12" value="<?php echo $re['ngay'] ;?>"  onkeypress="return chuyentiep(event,'xungho')" disabled="disabled"/>
			   <span style="color:#FF0000">*</span></td>
		</tr>
		 
		<tr>
			<td width="17%"><div align="right">Giới tính &nbsp;</div></td>
			<td width="83%"  ><span style="padding-bottom:10px">
			
			<?php
				$xungho1=$re["gioitinh"]==1?"selected":"";
				$xungho2=$re["gioitinh"]==2?"selected":"";
			?>
			  <select onkeypress="return chuyentiep(event,'tel')" name="xungho"  id="xungho" disabled="disabled" >
				<option value="0" >Chưa xác định</option>
				<option <?php echo xungho1;?> value="1">Nam</option>
				<option <?php echo xungho2;?> value="2">Nữ</option>
				</select></span>
			  <span style="color:#FF0000">*</span></td>
		</tr>
		
		 
		<tr>
			<td width="17%"><div align="right">Địa chỉ &nbsp;</div></td>
				<td width="83%"  ><span style="padding-bottom:10px">
				  <input type="text" id="address"  name="address" class="text" style="width:675px" value="<?=$re["address"]?>" onkeypress="return chuyentiep(event,'tel')" onchange="checkchangevalue()"/>
			  <span style="color:#FF0000"> </span></span></td>
		</tr>
		<tr>
			<td width="17%"><div align="right">Tỉnh Thành &nbsp;</div></td>
				<td width="83%"  > 
				 
				  <select class="js-tinh"  id="tinhthanh" name="tinhthanh"   style="width:130px" onchange="checkchangevalue()">
					<option value="0" >Chọn tỉnh thành</option>
					 <?php
					 
					 	echo composx("tinh","Name",$re['IDKhuVuc'],""); 
					 
					 ?>
			   
				  </select>
				   <span style="color:#FF0000">*</span>   Quận/Huyện 
			  <select class="js-quan" name="quan" id="quan"   style="width:170px" onchange="checkchangevalue()">
			   <option value="0"> </option>
				   <?php
				
				   	echo composxConcat("quan","CONCAT(loai,' ',Name)","name",$re['quan']," where idtinh='$re[IDKhuVuc]'"); 
				   ?>
				   </select>
			  Phường xã &nbsp;
			  <select class="js-phuong" name="phuong" id="phuong" style="width:170px" onchange="checkchangevalue()">
				  <option value="0"> </option>
				 	<?php
				  	 	echo composxConcat("phuong","CONCAT(loai,' ',Name)","name",$re['phuong']," where idtinh='$re[IDKhuVuc]' and idquan='$re[quan]'"); 
				   ?>
				  
			  </select>      </td>
		</tr>
		  
		
		<tr>
			<td ><div align="right">Chi chú &nbsp;</div></td>
			<td colspan="2"><textarea id="notem" name="notem"   class="texta" style='width:675px;height:70px' onchange="checkchangevalue()">
				<?php echo $re["note"]; ?>
			</textarea></td>
		</tr>
		<tr>
			<td ><div align="right">  &nbsp;</div></td>
			<td colspan="2"> 
			  <br /><input type="button"   onclick="setkh('<?php echo addslashes($re["idkhach"]) ; ?>','<?php echo addslashes($re['Name']) ;?>','<?php echo htmlspecialchars(addslashes($re['address'])) ;?>','<?php echo  "KH:".$re['makh'] . "-" . $re['diemtichluy']." điểm" ;?>','<?php echo $loaic ;?>',<?php echo $ck ;?>)" class="text" id="btnxacnhan" name="btnxacnhan" value="Xác nhận thông tin" />
			  <input type="button"   onclick="updatethongtinkhach(address.value,tinhthanh.value,quan.value,phuong.value,notem.value,telm.value,'<?php echo addslashes($re["idkhach"]) ; ?>','<?php echo addslashes($re['Name']) ;?>',address.value,'<?php echo  "KH:".$re['makh'] . "-" . $re['diemtichluy']." điểm" ;?>','<?php echo $loaic ;?>',<?php echo $ck ;?>)" class="text" id="btnUpdate" name="btnUpdate" style="display:none" value="cập nhật thông tin" />
			  <div id="henthiupdate"></div>
			   <div id="henthiloading" style="display:none"><img src="images/loading.gif"/></div>
			  </td>
		</tr>
		</table>
		</div>
		 
		</fieldset>	
	<?php
	$r++;
		
		/*}
		
			if($r==2 && $loai==1) {
			$sql= "select ID from customer where makh='$makh' limit 1";	
			$tam=getdong($sql);
			if (laso($tam['ID'])==0) 
			{
				$sql= "insert into customer   ( select * from customerluu where makh='$makh' limit 1)";	
				$tam=getdong($sql);			
			}
		
		}*/
	}	
}
 else if($num == 0) {
	?>
	<br />
<fieldset  class="nencon">
	<legend> <a style="cursor:pointer"  >
	<label style="Color:#FF3300;Font-Weight:Bold;Font-size:11pt;" >Nhập khách hàng mới</label>
	</a> </legend>
 	<input type="hidden" id="taomoikhach" name="taomoikhach" value="1" />
	<div id="khachmoi">
<table width="100%" border="0" cellpadding="2px" cellspacing="2px"  >
  
<tr>
	<td width="17%" align="right"><div align="right">Nguồn khách hàng &nbsp; </div></td>
	<td  >
 		<select onkeypress="return chuyentieps(event,'Name')" name="nhomkh"  id="nhomkh"  >
          <option value="0" >Chưa xác định</option>
  			<?php
			   echo composx("nhomkhachhang","Name",$_REQUEST["nhom"],"Rank") ;
			?>
 		  </select>
 		Số ĐT <input type="Text" name="telm" id="telm" style="width:100px"  autocomplete="off"   class="text"    value="<?php echo $makh; ?> " onblur="kiemtradung(this.value)"  onkeydown="onlyintc(this)"  onkeypress="return chuyentiep(event,'IDKhuVuc')"/>
 		<span style="color:#FF0000"> *</span>  		</td>
</tr>
 <tr>
	<td width="17%"  align="right">
		<div align="right">Tên Khách &nbsp;</div></td>
	<td colspan="3"><input type="Text" name="Namem" id="Namem"  class="text" style="width:427px" value="" onkeypress="return chuyentiep(event,'ngaysinh')"/>
	  <span style="color:#FF0000">*</span></td>
</tr>
<tr>
	<td width="17%"><div align="right">Ngày Sinh &nbsp;</div></td>
	<td  ><input  type="date"  name="ngaysinh" id="ngaysinh"   style="height:25px" class="text" size="12" value=""  onkeypress="return chuyentiep(event,'xungho')"/>
       <span style="color:#FF0000">*</span></td>
</tr>
 
<tr>
	<td width="17%"><div align="right">Giới tính &nbsp;</div></td>
	<td width="83%"  ><span style="padding-bottom:10px">
	  <select onkeypress="return chuyentiep(event,'tel')" name="xungho"  id="xungho"  >
	    <option value="0" >Chưa xác định</option>
	    <option {xungho1} value="1">Nam</option>
	    <option {xungho2} value="2">Nữ</option>
	    </select></span>
	  <span style="color:#FF0000">*</span></td>
</tr>

 
<tr>
	<td width="17%"><div align="right">Địa chỉ &nbsp;</div></td>
		<td width="83%"  ><span style="padding-bottom:10px">
		  <input type="text" id="address"  name="address" class="text" style="width:675px" value="" onkeypress="return chuyentiep(event,'tel')"/>
	  <span style="color:#FF0000"> </span></span></td>
</tr>
<tr>
	<td width="17%"><div align="right">Tỉnh Thành &nbsp;</div></td>
		<td width="83%"  > 
 		 
		  <select class="js-tinh"  id="tinhthanh" name="tinhthanh"   style="width:130px">
            <option value="0" >Chọn tỉnh thành</option>
			 <?php
			 
				 echo composx("tinh","Name",$_REQUEST["kv"],"")  ; 
			 
			 ?>
       
          </select>
		   <span style="color:#FF0000">*</span>   Quận/Huyện 
      <select class="js-quan" name="quan" id="quan" disabled="disabled"  style="width:170px">
	   <option value="0"> </option>
		   {quan}
           </select>
      Phường xã &nbsp;
      <select class="js-phuong" name="phuong" id="phuong" disabled="disabled" style="width:170px">
          <option value="0"> </option>
		    {phuong}
          
      </select>      </td>
</tr>
  

<tr>
	<td ><div align="right">Chi chú &nbsp;</div></td>
	<td colspan="2"><textarea id="notem" name="notem"   class="texta" style='width:675px;height:70px'></textarea></td>
</tr>
<tr>
	<td ><div align="right">  &nbsp;</div></td>
	<td colspan="2"> 
	  <br /><input type="button"   onclick="return luuthongtinkhach(nhomkh.value,telm.value,Namem.value,ngaysinh.value,xungho.value,address.value,tinhthanh.value,quan.value,phuong.value,notem.value)" class="text" id="btnUpdate" name="btnUpdate" value="Lưu thông tin" />
	   <div id="henthiloading" style="display:none"><img src="images/loading.gif"/></div>
	  </td>
</tr>
</table>
</div>
 
</fieldset>	
</div>	
	
	<?php
	
	} else {
	 echo ' <input type="hidden" id="taomoikhach" name="taomoikhach" value="0" />'  ;}
 ?>
 
</div>
 
 
<?php				
    $data->closedata() ;
	
	
function composxConcat($table,$concat,$key,$idsosanh,$cotsapxep= "",$where= ""){
    global $data;
	$f_sx = "" ;
 	 
	if ($cotsapxep != "") 
	{ 
		if (strpos($cotsapxep,"order by") || strpos($cotsapxep,"where")  )
		{	
			$f_sx = $cotsapxep ;
		} else
		{
			$f_sx = " order by  $cotsapxep   desc " ;
		}
	}	
	$sql = "select $concat as $key,ID from $table $where  $f_sx " ;
 	//echo $sql;
 	$result = $data->query($sql) ;	
 	while($n = $data->fetch_array($result))
	{
		$ft = addslashes($n[$key]) ; 
		if($n["ID"] == $idsosanh)
		{
			$output .= "<option value='".$n["ID"]."' selected>".$n[$key]."</option>\n";
		}
		else
		{
			$output .= "<option title=\"$ft\"    value='".$n["ID"]."'>".$ft."</option>\n";
		}
	}
	return $output;

}
?>	