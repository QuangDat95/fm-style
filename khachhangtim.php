<?php  
session_start();
if ($_SESSION["LoginID"] =='') { return ; }
 $idnv =$_SESSION["LoginID"] ;
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
 //////////////////////////////////////////////////////////////
    
  //////////////////////////////////////////////////////////////
 //=============================khoi tao ======================//  	 Xem  	 Them  	 Cap nhap  	 Tim  	Huy  	Khoa  	In
 if ( trim( $idnv )== "" ) { return  ; }
   $data->setdangnhap( $idnv,$us) ;

  $data->setthaotac = "khachhang" 	;
 // $sql = "select Item,FunctionID from userright where  UserID  ='$id' and FunctionID = '10' " ;
 // $tam = $data->truyvan($sql);	
   $cn  =  phanquyenthu($tam['Item'],"capnhap") ; 
  if ($_SESSION["loai_user"] ==6 ||  $idnv==5562 ) $cn = 1 ;
  $cn = 1 ;
  $xoa =  phanquyenthu($tam['Item'],"xoa") ;
 if($idnv==5565|| $idnv==5562) $xoa =1;
 
 if ($_SESSION["frm_xuathang"] == "1"  ) {  $cn ="";$xoa ="" ; }
  $data1 = $_POST['DATA']; 
  $tmp = explode('*@!',$data1);
 //   echo $data1 ;
  $loai  = trim($tmp[0])  ;		 
  
  $ten=  (trim($tmp[0]))   ;
  $dt =  (trim($tmp[1])) ;
  $makh= trim($tmp[2]) ;
    $cuahang= laso($tmp[3]) ;
   $cm= trim($tmp[4]) ;
  $sapxep= trim($tmp[6]) ;
  $loai= laso($tmp[7]) ;
  if ( $sapxep =="")  
  { $sapxep = "ngaytao" ; } 
  $trang= trim($tmp[5]) ;
    $pagesize = 500; 
 	   $tungay= trim($tmp[7]) ;
  $denngay= trim($tmp[8]) ;
   $nhomkh= laso($tmp[9]) ;
  
		$sql_where=" where 1=1 ";
 		 if($ten!="")
			$sql_where.=" and a.Name  like '%".$ten."%'";
		if($dt!="")
			$sql_where.=" and a.tel like '%".$dt."%'";	
		if($tinh>0)
			$sql_where.=" and IDKhuVuc=  '".$tinh."' ";		
			if($cuahang>0)
			$sql_where.=" and IDcuahang=  '".$cuahang."' ";		
			
			
		if($nhomkh>0)
			$sql_where.=" and nhomkh=  '".$nhomkh."' ";			
		if($cm!="")
			$sql_where.=" and a.cmnd like '%".$cm."%'";				
		if($makh !="" && trim($tmp[6])!= 'makh')
			$sql_where.=" and a.makh ='$makh'";
		else	if($makh !="" && trim($tmp[6])=='makh') 	$sql_where.=" and a.makh like '%$makh%'";
		
   if ($sapxep=='timngaytao') { $sapxep = 'ngaytao';  $timngay=true; $ngaysinh="ngaytao";} else {$timngay=false;; $ngaysinh="ngaysinh";}
   if($tungay!="")	
		{
		  $ngay=  explode('/',$tungay);
	   	  if (strlen($ngay[1])== 1) {  $ngay[1] = "0".$ngay[1] ;  }
		  if (strlen($ngay[0])== 1) {  $ngay[0] = "0".$ngay[0] ;  }  
		  $thang=$ngay[1] ;
		if($denngay=="")	 
		  { 
		  	if($timngay) $sql_where .= " and    $ngaysinh>= '$ngay[2]-$ngay[1]-$ngay[0]'  "; 
			  else $sql_where .= " and   DATE_FORMAT( $ngaysinh,'%m') = '$ngay[1]' and  DATE_FORMAT( $ngaysinh,'%d')  = '$ngay[0]' ";
		  }
		  else 
		  {
			 	if( $timngay)  $sql_where .= " and   $ngaysinh>= '$ngay[2]-$ngay[1]-$ngay[0]'  "; 
				else $sql_where .= " and DATE_FORMAT( $ngaysinh,'%d')  >=  '$ngay[0]'  and  DATE_FORMAT( $ngaysinh,'%m')  = '$thang' ";
		  }
  		} 
   if($denngay!="")	
		{
		  $ngay=  explode('/',$denngay);
	   	  if (strlen($ngay[1])== 1) {  $ngay[1] = "0".$ngay[1] ;  }
		  if (strlen($ngay[0])== 1) {  $ngay[0] = "0".$ngay[0] ;  }    		
		   if($timngay) $sql_where .= " and    $ngaysinh<= '$ngay[2]-$ngay[1]-$ngay[0]'  "; 
		   else
		   $sql_where .= " and   DATE_FORMAT( $ngaysinh,'%d')   <=  '$ngay[0]'   ";
  		} 		
		
   
	 if ($idnv==1||$idnv==2 ||$idnv==604||$idnv==983) 
	 {
	//	 if ($nhom>0) $sql_where.=" and a.IDcuahang ='$nhom'";
 		  if ($idnv==983) $pagesize = 10000; 
	 }
//	 elseif($nhom !="0") {$sql_where.=" and a.IDcuahang ='$nhom'";		 $pagesize = 500; }	
				
				$r =1 ;	 
 if (!$loai) 
 {
			$sql = "SELECT a.ID,a.IDCuaHang,a.idkhuvuc,a.Name,a.makh,a.tel,a.diemtichluy ,DATE_FORMAT( ngaysinh,'%d/%m/%Y') as ngay ,DATE_FORMAT( ngaytao,'%d/%m/%y %H:%i') as ngaytao ,a.ID as idkhach,a.note FROM customer a ".$sql_where." ORDER BY a.$sapxep desc   ";
 } else
 {
			$sql = "SELECT a.ID,a.IDCuaHang,a.idkhuvuc,a.Name,a.makh,a.tel,a.diemtichluy ,DATE_FORMAT( ngaysinh,'%d/%m/%Y') as ngay ,DATE_FORMAT( ngaytao,'%d/%m/%y %H:%i') as ngaytao ,a.ID as idkhach FROM customerluu a ".$sql_where." ORDER BY a.$sapxep desc   ";
  }
		
 //  echo $sql ;
 $mangch =taomang("cuahang","ID","macuahang"); $mangtinh =taomang("tinh","ID","Name");
 	//========================================================
  if (!is_numeric($trang) ) $trang = 1 ;
   		if ($trang * 1  <= 0 ) $trang = 1 ;	
	 $result = $data->query($sql); 
	 $num=$data->num_rows($result);	
	
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
				 else { $pt = $pt . " ". "<a style='cursor:pointer' onclick=\"timkiemkh('$tmp[0]','$tmp[1]','$tmp[2]','$tmp[3]','$tmp[4]','$i','$tmp[6]','$tmp[7]','$tmp[8]','$tmp[9]')\"  > $i </a> " ;  } 		  
			}
			
		  }
	  }
	  $r = $pagesize * $trang - $pagesize + 1  ;
	//==============================================================	
  if ($_SESSION["admintuan"] )  echo $sql ; 

?><div   style=" overflow:auto;width:99%;height:400px"     >
 <table width="99%" border="0" cellpadding="0" cellspacing="0" class="tbchuan">		
 		<tr bgcolor="#F8E4CB">
		  <td align="center"  height="23" width="34"><b>STT</b></td>
		   <td width="49" align="center" > <strong>Mã KH</strong> </td>	
		  <td width="151" align="center"  > <strong>Tên khách khàng </strong></td>  
		  <td width="137" align="center" > <strong>Tỉnh / Thành Phố</strong> </td> 	   
  		  <td width="86" align="center" > <strong>Điện Thoại </strong></td>
		 <td width="260" align="center" > <strong>Ghi chú</strong></td>
		  <td width="81" align="center" > <strong> Ngày Sinh</strong> </td>	
		  <td width="47" align="center" > <strong>Điểm</strong></td>
        <td width="44" align="center" > <strong>Mã CH</strong></td>
		  <td width="70" align="center" > <strong>Ngày Tạo</strong ></td>     	      
   <?php if ($cn  ==1) {  ?>  <td width="39" align="center"  ><strong>C&#7853;p nh&#7853;p</strong></td>
   <?php } ?>
   <?php if ($xoa ==1) {  ?>  <td width="50" align="center" ><strong>X&#243;a</strong></td>		 
   <?php } ?>
   </tr>
<?php
  $IDCH = $_SESSION["se_kho"] ; 
  if ($idnv==1||$idnv==2 ||$idnv== 5565||$idnv==9296||$idnv==604||$idnv ==5562||$IDCH ==1013||$IDCH ==2513||  $tungay!="") $am = false ; else $am = true;
 //echo   $am . "123" ;

 // if ($IDCH) $am = true ; else $am = false;
while($re = $data->fetch_array($result))
	{   $makh= $re['makh'] ;
		 if ($am&&$re['IDCuaHang']!=$IDCH) { $re['tel'][2]='x' ;  $re['tel'][3]='x'; $re['tel'][4]='x';   $re['makh'][2]='x' ;  $re['makh'][3]='x'; $re['makh'][4]='x';     }
		 
		 if($mau == "white")
		{	 
			 $mau = "#EEEEEE"; $hl = "Normal4" ; $hl2 = "Highlight4"; 		 
		}else { $mau = "white";  $hl = "Normal5" ;  $hl2 = "Highlight5"; } 
		
		if ($loai)
		{
	 ?>
     
 	 	<tr  title="<?php echo addslashes($re['note']) ?>"   onMouseOver="this.className='<?php echo $hl2; ?>'" onMouseOut="this.className='<?php echo $hl; ?>'"  bgcolor="<?php echo $mau ?>" >
       <?php } else { ?>
       
        	 	<tr  title="<?php echo addslashes($re['note']) ?>"  onclick="setkh('<?php echo addslashes($re["idkhach"]) ; ?>','<?php echo addslashes($re['Name']) ;?>','<?php echo $re['address'] ;?>','<?php echo $re['tel'] ;?>')"   onMouseOver="this.className='<?php echo $hl2; ?>'" onMouseOut="this.className='<?php echo $hl; ?>'"  bgcolor="<?php echo $mau ?>" >
      <?php }   ?>   
		  <td     align="right"> <?php echo $r ;?> </td>		
		  <td  style="cursor:pointer" onclick="goikhach('<?php echo $re['ID'] ;?>')"><?php echo $re['makh'] ;?></td>		
				<td ><?php echo $re['Name'] ;?></td>
				<td ><?php echo $mangtinh[$re['idkhuvuc']] ;?></td>
			 
 				<td ><?php echo $re['tel'] ;?></td>
                <td ><?php echo $re['note'] ;?></td>
				<td ><?php echo $re['ngay'] ;?></td>
                
				<td ><?php echo $re['diemtichluy'] ;?></td>				
               <td   align="center" ><?php echo $mangch[$re['IDCuaHang']] ;?></td>  
				<td   align="center" ><?php echo $re['ngaytao'] ;?></td>    
                	  
<?php if($cn  ==1){ ?><td align="center" ><a href = "default.php?act=customer&id=<?php echo $re["idkhach"] ; ?>" > <img src = "images/book_addressHS.png" border = "0" ></a> </td><?php } ?>
<?php if ($xoa  ==1){?><td align="center" ><a onclick='return ask()' href="default.php?act=customer&Del=<?php echo $re["idkhach"] ; ?>"><img src="images/delete.gif" border = "0"></a></td><?php } ?>
   </tr>
<?php				
	$r++;
	}
	
	 
?>	
</table>
</div>
<div style="padding:5px;" ><?php 
//==============================================================	
 	  if ( $num != 0 ) {
 ?>
  Tìm thấy  <?php echo  $num ; ?>   khách hàng !    <?php if ($num > $pagesize ) echo "Trang : ". $pt ; ?>  
  <?php 
  } else
  {
  	 echo "<font size=2  color='#FF3300'>Không tìm thấy   khách hàng, bạn có thể tìm theo từ ngắn hơn hoặc bấm vào nút '<b>Thêm </b>' để thêm khách hàng !!!</font> " ;
  }
 //==============================================================	
 ?> </div>
 
 
<?php				
    $data->closedata() ;
?>	