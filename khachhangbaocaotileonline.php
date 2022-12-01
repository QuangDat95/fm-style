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
 //////////////////////////////////////////////////////////////
    
  //////////////////////////////////////////////////////////////
 //=============================khoi tao ======================//  	 Xem  	 Them  	 Cap nhap  	 Tim  	Huy  	Khoa  	In
 if ( trim($_SESSION["LoginID"])== "" ) { return  ; }
   $data->setdangnhap($_SESSION["LoginID"],$us) ;

  $data->setthaotac = "khachhangbaocao" 	;
 // $sql = "select Item,FunctionID from userright where  UserID  ='$id' and FunctionID = '10' " ;
 // $tam = $data->truyvan($sql);	

  $cn  =  phanquyenthu($tam['Item'],"capnhap") ; 
  if ($_SESSION["loai_user"] ==6 ) $cn = 1 ;
  $cn = 1 ;
  $xoa =  phanquyenthu($tam['Item'],"xoa") ;
 
 if ($_SESSION["frm_xuathang"] == "1"  ) {  $cn ="";$xoa ="" ; }
  $data1 = $_POST['DATA']; 
  $tmp = explode('*@!',$data1);
 //   echo $data1 ;
  $loai  = trim($tmp[0])  ;		 
  
  $ten= (trim($tmp[0]))   ;
  $dt = (trim($tmp[1])) ;
  
  $makh= trim($tmp[2]) ;
    $nhom= laso($tmp[3]) ;
  $cm= trim($tmp[4]) ;
  $sapxep= trim($tmp[6]) ;
  $loai= laso($tmp[7]) ;
  if ( $sapxep =="")  
  { $sapxep = "ngaytao" ; } 
  $trang= trim($tmp[5]) ;
    $pagesize = 365; 
 	   $tungay= trim($tmp[7]) ;
  $denngay= trim($tmp[8]) ;
   $tinh = laso($tmp[9]) ;
  $diemtichluy = laso($tmp[10]) ;
  
 //  echo "<br>". $dt;
 
		$sql_where=" where 1=1 ";
 		 if($ten!="")
			$sql_where.=" and c.Name  like '%".$ten."%'";
		if($dt!="")
			$sql_where.=" and c.tel like '%".$dt."%'";	
		if($cm!="")
			$sql_where.=" and c.cmnd like '%".$cm."%'";				
		if($makh !="" && trim($tmp[6])!= 'makh')
			$sql_where.=" and c.makh ='$makh'";
		else	if($makh !="" && trim($tmp[6])=='makh') 	$sql_where.=" and c.makh like '%$makh%'";
  
   if($diemtichluy>0) 	$sql_where.=" and c.diemtichluy >=$diemtichluy ";		
  
    if (!$_SESSION["admintuan"] &&  ($tungay==''||$denngay=="") ) { echo "Vui lòng chọn ngày đầy đủ từ ngày tới ngày"; return; }
    
   if($tungay!="")	
		{
		  $ngay=  explode('/',$tungay);
	   	  if (strlen($ngay[1])== 1) {  $ngay[1] = "0".$ngay[1] ;  }
		  if (strlen($ngay[0])== 1) {  $ngay[0] = "0".$ngay[0] ;  }  
		  $thang=$ngay[1] ;
		  
		  $sql_where .= " and    a.ngaytao>= '$ngay[2]-$ngay[1]-$ngay[0]'   ";
		  
		  
  		} 
   if($denngay!="")	
		{
		  $ngay=  explode('/',$denngay);
	   	  if (strlen($ngay[1])== 1) {  $ngay[1] = "0".$ngay[1] ;  }
		  if (strlen($ngay[0])== 1) {  $ngay[0] = "0".$ngay[0] ;  }    		
 
		  $sql_where .= "  and    a.ngaytao<= '$ngay[2]-$ngay[1]-$ngay[0] 23:59'   "; 
  		} 		
		
   
	 if ($_SESSION["LoginID"]==1||$_SESSION["LoginID"]==2 ||$_SESSION["LoginID"]==604||$_SESSION["LoginID"]==983) 
	 {
		 if ($nhom>0) $sql_where.=" and a.IDkho ='$nhom'";
		  if ($_SESSION["LoginID"]==983) $pagesize = 10000; 
		 
	 }elseif($nhom !="0" && strlen($dt)<10  ) {$sql_where.=" and a.IDkho ='$nhom'";		 $pagesize = 10000; }	
				
	 $r =1 ;	 
 
    // case when (v.ngayhoanthanh> $tucuoi and  v.ngayhoanthanh< $dencuoi ) then sum(ceil(b.DonGia*(1-1*b.chietkhau/100))*b.SoLuong) else 0 end) as hoanthanh  
 
 
	
 $sql = " select  u.ID,u.ma,u.Name,count(a.id) as sodon ,  sum( case when a.idnhacc=1 then 1  else 0 end ) as khachle
         ,sum( case when DATE_FORMAT(c.ngaytao,'%Y/%m/%d')= a.ngaynhap  then 1  else 0 end ) as khachmoi  
		 ,sum( case when a.idnhacc>1  then 1  else 0 end ) as sokhach 
    from  phieunhapxuat a left join customer c on c.id=a.idnhacc  left join lydonhapxuat u on a.lydo=u.id
   $sql_where and a.dakhoa=1 and a.loai = 1  and a.lydo>45  group by a.lydo  " ;

  if ($_SESSION["admintuan"])   {  echo $sql ;    }  
 
  
 $mangch =taomang("cuahang","ID","macuahang"); $mangten =taomang("cuahang","ID","name");
 	//========================================================
 
	 $result = $data->query($sql); 
	 
	
	 
	//==============================================================	
   

?><div   style=" overflow:auto;width:99%;height:400px"     >
 <table width="99%" border="0" cellpadding="0" cellspacing="0" class="tbchuan">		
 			<thead><tr bgcolor="#F8E4CB">
		  <th align="center"  height="23" width="102"><b>STT</b></th>
		  <th width="152" align="center" > <strong>Team</strong></th> 
           
          <th width="158" align="center" > <strong>Mã Team </strong ></th> 	
          <th width="158" align="center" ><strong>Số Đơn</strong></th> 	
          <th width="158" align="center" > <strong>Khách cũ </strong ></th> 	
		  <th width="158" align="center" > <strong>Khách mới </strong ></th>
		  <th width="116" align="center" > <strong>Khách lẻ </strong></th>  
		  <th width="158" align="center" ><strong>Tỉ lệ </strong></th>  
		   
    
   </tr>	</thead>
<?php
  $IDCH = $_SESSION["se_kho"] ; 
 if ($_SESSION["LoginID"]==1||$_SESSION["LoginID"]==2 ||$_SESSION["LoginID"]==983||$_SESSION["LoginID"]==4647 ||$_SESSION["LoginID"]==604||$IDCH ==1006||$IDCH ==1013||$tungay!="") $am = false ; else $am = true;
 //echo   $am . "123" ;

 // if ($IDCH) $am = true ; else $am = false;
while($re = $data->fetch_array($result))
	{   $makh= $re['makh'] ;
	 
		 
		 if($mau == "white")
		{	 
			 $mau = "#EEEEEE"; $hl = "Normal4" ; $hl2 = "Highlight4"; 		 
		}else { $mau = "white";  $hl = "Normal5" ;  $hl2 = "Highlight5"; } 
		
		if ($loai)
		{
	 ?>
     
 	 	<tr  title="<?php echo addslashes($re['note']) ?>"   onMouseOver="this.className='<?php echo $hl2; ?>'" onMouseOut="this.className='<?php echo $hl; ?>'"  bgcolor="<?php echo $mau; ?>" >
       <?php } else { ?>
       
        	 	<tr     onMouseOver="this.className='<?php echo $hl2; ?>'" onMouseOut="this.className='<?php echo $hl; ?>'"  bgcolor="<?php echo $mau ?>" >
      <?php }   ?>   
		        <td title="<?php echo $re['ID'] ;?>"  align="right"> <?php echo $r ;?> </td>		
 				<td onclick="goikhach('<?php echo $re['ID'] ;?>')" ><?php echo $re['Name'] ;?> &nbsp;</td>
                <td ><?php echo $re['ma'] ;?></td>
                <td ><?php echo formatso($re['sodon']) ;?></td>
                <td ><?php echo formatso($re['sokhach']-$re['khachmoi']) ;?></td>
				<td ><?php echo formatso($re['khachmoi'])  ;?></td>
				<td ><?php echo formatso($re['khachle']) ;?></td>
                <td ><?php echo round($re['khachmoi'] *100/$re['sodon'],2) . '%'   ;?></td>
				 
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
  Tìm thấy  <?php echo  $num ; ?>   khách hàng ! &nbsp;   <?php if ($num > $pagesize ) echo "Trang : ". $pt ; ?>  
  <?php 
  } else
  {
  	 echo "<font size=2  color='#FF3300'>Không tìm thấy phụ khách hàng, bạn có thể tìm theo từ ngắn hơn hoặc bấm vào nút '<b>Thêm </b>' để thêm khách hàng !!!</font> " ;
  }
 //==============================================================	
 ?> </div>
 
 
<?php				
    $data->closedata() ;
?>	