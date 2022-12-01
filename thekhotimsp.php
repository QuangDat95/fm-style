<?php  
session_start();
ob_start();
if ($_SESSION["LoginID"]=="") return ;

 $quyen= $_SESSION["quyen"] ; 
 $ql =$quyen[$_SESSION["mangquyenid"]["thekho"]]  ;  
 if( !($ql[0] || $idl==1) ){return;}

$idl=$_SESSION["LoginID"] ;
  
$IDCH = $_SESSION["se_kho"] ; 
 
$root_path =getcwd()."/"  ;
include($root_path."biensession.php");
include($root_path."includes/config.php");
include($root_path."includes/removeUnicode.php");
include($root_path."includes/class.paging.php");
include($root_path."includes/class.mysql.php");
include($root_path."includes/function.php");
include($root_path."includes/function_local.php");
include($root_path."includes/xlsxwriter.class.php"); 
//  //if ($us =="" || $id == "" ) { echo " Ban chua dang nhap!!! " ;return ;}
  
$data = new class_mysql();
$data->config();
$data->access();

  $data1 = $_POST['DATA'];   
  $tmp = explode('*@!',$data1);
  $codeprotk  = trim($tmp[0])  ;		 
  $code = trim($tmp[1]) ;
  $NameTK   = trim($tmp[2])   ;
  $IDGrouptk = laso($tmp[3]) ;  
  $cuahang = laso($tmp[4]) ;	 
  $nhomhang = laso($tmp[5]) ;	  
  $loai = laso($tmp[6]) ;   
  $mota = trim($tmp[7]) ;
  $tu =  ($tmp[8]) ;	
  $den =  ($tmp[9]) ;	 
  $trang  = laso($tmp[10]) ;	 
  $loaigoi = $tmp[11] ;
   $ncc = $tmp[10] ;  
   $khuvuc= laso($tmp[12]) ;
    $size= laso($tmp[13]) ;
	 $mau= laso($tmp[14]) ;
  // echo $khuvuc ;
 // echo  $data1 ;
  
      if  ($idk == 1 ||  $ql[5])   $ID =1 ;
	  $sql_where=" where  b.IDcuahang=$IDCH  "; $sqlw="";
	  if($ID==1|| $IDCH ==1) $sql_where=" where  b.IDcuahang=$cuahang  ";
	  if( ($ID==1 ||$IDCH ==1)&& $cuahang==0 ) 
	       $sql_where=" where  b.IDcuahang <> 62 and  b.IDcuahang <> -1  and  c.macuahang IS NOT NULL ";
	
	  if($_SESSION["loai_user"]==16){ $sql_where=" where  b.IDcuahang=$cuahang  "; }
      if($_SESSION["loai_user"]==16&& $cuahang==0){ $sql_where=" where  c.idtinh=$IDCH  "; }
	  
	  
	   
	  
	  if($cuahang==-9){ $sql_where=" where  b.IDcuahang<>1106 and b.IDcuahang>=1  ";  }
  
      if($loai==1)  $sql_where.=" and b.SoLuong<>0 and a.price>10 ";	
	  if($loai==2)  $sql_where.=" and b.SoLuong=0";
	  if($loai==3)  $sql_where.=" and b.SoLuong<0";
	  if($loai==4)  $sql_where.=" and b.SoLuong>0";	
	  if($loai==5)  $sql_where.=" and b.SoLuong>2";	
	  if($loai==6)  $sql_where.=" and b.SoLuong>0";	 
	  if($loai==7)  $sql_where.=" and b.SoLuong> " . laso($codeprotk);	 
	  if($loai==8)  {$mota=laso($mota) ;$sql_where.=" and b.SoLuong>0 and b.soluong< " . laso($codeprotk)   ;  $codeprotk='';	}   // >0 nho hon o ma
	  if($loai==9)  $sql_where.=" and a.price>10";	 
	  if($loai==10)  $sql_where.=" and a.price<10";	 
//	echo $loai ;
       if($size>0)  $sql_where.=" and a.size=$size";	
	   if($mau>0)   $sql_where.=" and a.mau=$mau";	 
        if($tu!="")	
		{
		   $ngay=  explode('/',$tu);
  	   	  if (strlen($ngay[1])== 1) {  $ngay[1] = "0".$ngay[1] ;  }
		  if (strlen($ngay[0])== 1) {  $ngay[0] = "0".$ngay[0] ;  }  
 		  $sql_where .= " and  a.NgayTao >= '$ngay[2]-$ngay[1]-$ngay[0]'";
 		} 

	 	if($den!="")	
		{
		  $ngay=  explode('/',$den);
	   	  if (strlen($ngay[1])== 1) {  $ngay[1] = "0".$ngay[1] ;  }
		  if (strlen($ngay[0])== 1) {  $ngay[0] = "0".$ngay[0] ;  }    		
		   $sql_where .= " and   a.NgayTao <= '$ngay[2]-$ngay[1]-$ngay[0] 23:59'";
  
		} 		
		if($NameTK!="")
		{
			$sql_where.=" and a.Name  like '%".$NameTK."%'";
			$sqlw .=" and b.tenpt  like '%".$NameTK."%'"; 
		}
		
		if($codeprotk!="") 
		{ $sql_where.=" and a.codepro like '%".$codeprotk."%'";  $sqlw .=" and b.mahang  like '%".$NameTK."%'"; } 
		
		
		if($mota!="" && $cuahang>0) { $sql_where.=" and a.code like '%".$mota."%'";  $sqlw .=" and b.mota  like '%".$mota."%'"; } 
		if($mota!="" && $cuahang==0) { $sql_where.=" and a.code like '".$mota."%'";  $sqlw .=" and b.mota  like '%".$mota."%'"; } 
		
    	if($nhomhang>0) { $sql_where.=" and a.IDnhom = '".$nhomhang."'"; $sqlw .=" and b.idnhom  = '".$nhomhang."'"; } 
		
		 
		if($khuvuc>0) 	{$sql_where.=" and c.idtinh   ='$khuvuc'"; $sql_kho3=  " and c3.idtinh   ='".$khuvuc."' ";}
		if($khuvuc<0) 	{$khuvuc=abs($khuvuc) ; $sql_where.=" and c.NameN   ='$khuvuc'"; $sql_kho3=  " and c3.NameN   ='".$khuvuc."' ";}
		
		
	 	 if($ncc>0){ $sql_where.=" and n.ID=$ncc"; }				
	
	    if(  $IDGrouptk>0)
		{
	   		$nhom = $IDGrouptk.timnhom("groupproduct","IDGroup",$IDGrouptk);
			 
 			$sql_where.=" and  a.IDGroup in ( $nhom ) ";
 		}
		
  
	 
	//	if($code!="" )
		//	$sql_where.=" and a.code like '%".$code."%'";
				$r =1 ;	 
 		if ($idl==1 || $IDCH ==1 || $idl ==7391 )
		{
	    	$sql = "SELECT  c.macuahang, a.ID,a.Name,a.size,a.mau,b.SoLuong ,  a.NameN,a.codepro,a.code,a.price ,DATE_FORMAT(a.NgayTao,'%d/%m/%y') as ngaytao,a.giachan,a.giabinhquan from hanghoacuahang b left join  products  a on ( b.IDSP =a.ID) left join cuahang c on b.IDcuahang = c.ID   left join nhacungcap n on a.congtho =n.ID    $sql_where     ORDER BY b.SoLuong    ";
		}
		 else $sql = "SELECT   c.macuahang, a.ID,a.Name,a.size,a.mau,  b.SoLuong ,  a.NameN,a.codepro,a.code,a.price ,DATE_FORMAT(a.NgayTao,'%d/%m/%y') as ngaytao,a.giachan,a.giabinhquan from hanghoacuahang b left join  products a on ( b.IDSP =a.ID  )  left join cuahang c on b.IDcuahang = c.ID   left join nhacungcap n on a.congtho =n.ID       $sql_where   ORDER BY b.SoLuong     ";		 
				 
 	 
	  if ($_SESSION["admintuan"])	{echo $sql ."<br>";   }	
	 //   echo $sql ."<br>";  
	 
		$result = $data->query($sql);
	 
	 
	if($cuahang>0)
	{
		$sqlt="  
		select b.idsp, sum(CASE WHEN  p.idtkco=$cuahang  THEN   -b.soluong  end ) as xuat, sum(CASE WHEN  p.idtkno=$cuahang  THEN   b.soluong  end ) as nhan from phieuxuat p left join xuatkhotongchuakhoa b on p.id=b.idphieu where (p.idtkno=$cuahang or p.idtkco=$cuahang  ) and p.dakhoa=0 $sqlw group by b.idsp " ;
 		  if ($_SESSION["admintuan"]) echo  $sqlt ."<br>" ;
		  $resul = $data->query($sqlt);
		  while($rec = $data->fetch_array($resul))
		  {
		    $mangtam[$rec['idsp']] = $rec ; 
		  }
   
 	} 
		//if($phienbanphp==7) $sodong = $data->sodong($result);  else  $sodong =  mysql_num_rows($result);
		 $sodong = $data->num_rows($result);
	 if( $idl==1||$idl==7391)   { $giachan="Giá BQ"; }else{ $giachan="Giá Chặn"; }  //$idl==7577 ||	 
		 
 //=======================================================================
  $r=0 ;
   
if($sodong>10000)
{	  
 $writer = new XLSXWriter();
 $tongt = 0 ;  $tongsl = 0 ;  $tongn=0;
 $writer->writeSheetHeader('Sheet1', array('STT'=>'integer','Tên Sản phẩm '=>'string','Mã Sản phẩm'=>'string','Mô Tả'=>'string','Mã CH'=>'string','Giá bán'=>'integer',"$giachan"=> 'integer','SL'=>'integer' ) );
 while($re = $data->fetch_array($result))
 {
   $r++ ;    
   if( $idl==1||$idl==7391)  $re['giachan']=$re['giabinhquan'];
   $m= array($r,"$re[Name]","$re[codepro]","$re[code]","$re[macuahang]", round($re['price']), round($re['giachan']),$re['SoLuong']);
   $tongsl += $re['SoLuong'] ;
   $tongt +=  $re['price'] * $re['SoLuong'] ;  
   $tongn +=  $re['giachan'] * $re['SoLuong'] ;  
   $writer->writeSheetRow('Sheet1', $m );
  }
   $m= array('',"Tổng cộng"," "," "," ",round($tongt), round($tongn),$tongsl);
    $writer->writeSheetRow('Sheet1', $m );


     $writer->writeToFile('thekhofm2021.xlsx');
     echo "Số dòng $sodong quá lớn bạn có thể tải về click vào đây  <strong><a href='taive.php' target='_blank'> ( Tải về ) </a></strong>";
return;	  
}	  

//=======================================================================
		 

 
 echo "Tìm thấy <strong>$sodong</strong> kết quả ." ;
 // if ($sodong>50000) return ;
?>
<br />

<div style="height:300px;overflow:scroll">
 <table width="100%" border="0" cellpadding="0" cellspacing="0" class="tbchuan">		
 		<tr bgcolor="#F8E4CB"  >
		  <td align="center" height="23" width="34"><b>STT</b></td>
		  <td width="519" align="center" ><strong>Tên Sản phẩm </strong></td>  		  
		
		  <td width="150" align="center" ><strong>Mã Sản phẩm </strong> </td> 
          <td width="150" align="center" ><strong>Mô Tả</strong> </td> 
		  <td width="150" align="center" ><strong>Size</strong> </td> 
		  <td width="150" align="center" ><strong>Màu</strong> </td> 
		  <td width="79" align="center" ><strong>Mã CH</strong></td>
		  <td width="119" align="center" ><strong>Ngày tạo </strong></td>  		
		  <td width="150" align="center" ><strong><strong>Giá bán</strong> </strong></td>	    
		  <td width="150" align="center" ><strong><?php echo $giachan ; ?> </strong></td>	      
		  <td width="22" align="center"  > <strong>SL</strong></td> 
		   <td width="22" align="center"  > <strong>Nhận</strong></td> 
		    <td width="22" align="center"  > <strong>Xuất</strong></td> 
			 <td width="22" align="center"  > <strong>SL<br /> sẻ có</strong></td> 
  </tr>
<?php
$tongt = 0 ;
$tongsl = 0 ;
 $mangsize=taomang("size","ID","Name" );
 $mangmau =taomang("mausac","ID","Name" );

while($re = $data->fetch_array($result))
	{  $r++ ;  
 if($mau == "white" ){ $mau = "#EEEEEE"; $hl = "Normal4" ; $hl2 = "Highlight4";  }else {  $mau = "white" ;$hl = "Normal5" ; $hl2 = "Highlight5";} 
$tongsl += $re['SoLuong'] ;
$tongt +=  $re['price'] * $re['SoLuong'] ;  
if ($re['SoLuong']<0) $mauc ="red;" ; else  $mauc ="black;" ;

 
       if( $idl==1||$idl==7391)  $re['giachan']=$re['giabinhquan']; //$idl==7577 ||
	 ?>
 	 	<tr  title=" <?php echo  addslashes($re['note']); ?>"  style="cursor:pointer;color:<?php echo $mauc ; ?>"  onMouseOver="this.className='<?php echo $hl2; ?>'" onMouseOut="this.className='<?php echo $hl; ?>'"  bgcolor="<?php echo $mau; ?>" >
		  <td align="right"> <?php echo $r ;?></td>				
				<td ><?php echo $re['Name'] ;?></td>				
 				<td ><?php echo $re['codepro'] ;?></td>
                <td ><?php echo $re['NameN'] ;?></td>
				<td ><?php echo $mangsize[$re['size']] ;?></td>
				<td ><?php echo $mangmau[$re['mau']] ;?></td>
				<td ><?php echo $re['macuahang'] ;?></td>
				<td ><?php echo $re['ngaytao'] ;?></td>
				<td align="right"><?php echo  formatso($re['price']) ;?></td>
				<td align="right"  ><?php echo  formatso($re['giachan']) ;?></td>
				<td  align="right"><?php echo formatso($re['SoLuong']) ;?></td>
				<td  align="right"><?php echo   formatso($mangtam[$re['ID']]['nhan']) ;?></td>
				<td  align="right"><?php echo formatso($mangtam[$re['ID']]['xuat']) ;?></td>
				<td  align="right"><?php echo formatso($re['SoLuong']+$mangtam[$re['ID']]['nhan'] +$mangtam[$re['ID']]['xuat']   ) ;?></td>
    </tr>
<?php	
 
 
	}
?>	

</table>
</div> 
<div align="right"> Có :<?php echo $tongsl; ?> sản phẩm tìm được &nbsp; Tổng trị giá : <?php echo formatso($tongt); ?></div>
<?php

 if ($codeprotk!='')
 {
 	$sql = "SELECT  c.macuahang, a.ID,a.Name, ( b.SoLuong) as SoLuong,  a.NameEN,a.codepro,a.code,a.price ,a.giachan from
	 hanghoacuahang b left join  products  a on ( b.IDSP =a.ID) left join cuahang c on b.IDcuahang = c.ID where   b.IDcuahang <> 62 and  b.IDcuahang <> -1  and  c.macuahang IS NOT NULL and a.codepro = '$codeprotk'      ";
  if ($_SESSION["admintuan"]) 	echo $sql ; 
	
			$ret = $data->query($sql);
 
?>
<div style="height:300px;overflow:scroll">
 <table width="100%" border="0" cellpadding="0" cellspacing="0" class="tablechuan">		
 		<tr bgcolor="#F8E4CB">
		  <td align="center" height="23" width="34"><b>STT</b></td>
		  <td width="519" align="center" ><strong>Tên Sản phẩm </strong></td>  		  
		  <td width="170" align="center" ><strong>Mã Sản phẩm </strong> </td> 
		  <td width="79" align="center" ><strong>Mã CH</strong></td>
		  <td width="150" align="center" ><strong><strong>Giá bán</strong> </strong></td>	    
		   <td width="150" align="center" ><strong><strong>Giá chặn</strong> </strong></td>	      
		  <td width="112" align="center"  > <strong>SL</strong></td> 
  </tr>
<?php 
while($rea = $data->fetch_array($ret))
	{
 if($mau == "white")
	{	  $mau = "#EEEEEE";  	 $hl = "Normal4" ; 	 $hl2 = "Highlight4";  }else { 
	$mau = "white"; $hl = "Normal5" ; $hl2 = "Highlight5";  } 
 
	 ?>
 	 	<tr     bgcolor="<?php echo $mau; ?>" >
		  <td align="right"> <?php echo $r ;?></td>				
				<td ><?php echo $rea['Name'] ;?></td>				
				<td ><?php echo $rea['codepro'] ;?></td>
				<td ><?php echo $rea['macuahang'] ;?></td>
				<td align="right"><?php echo formatso($rea['price']) ;?></td>
				<td align="right"><?php echo formatso($rea['giachan']) ;?></td>
				<td align="right"><?php echo $rea['SoLuong'] ;?></td>
    </tr>
<?php	
 
	$r++;
	}
?>	
</table>
</div>
<?php	
			
		}

				
    $data->closedata() ;
	$content1 = ob_get_contents();
ob_clean();
ob_end_flush();
 
$_SESSION['content1'] = $content1;
echo $content1 ;
return;
?>	