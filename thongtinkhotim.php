<?php  
session_start(); 
 
    $ngaychan= gmdate('Y-m-d H:i:s', time() + 7*3600) ;
    $quyen= $_SESSION["quyen"] ; 
    $ql =$quyen[$_SESSION["mangquyenid"]["thongtinkho"]]  ; 
 	if( $ql[0]!=1 && (strtotime("now") < strtotime("2021-02-08")) ){return;}
		  
$root_path =getcwd()."/"  ;
include($root_path."biensession.php");
include($root_path."includes/config.php");
include($root_path."includes/removeUnicode.php");
include($root_path."includes/class.paging.php");
include($root_path."includes/class.mysql.php");
include($root_path."includes/function.php");
include($root_path."includes/function_local.php");
include($root_path."includes/xlsxwriter.class.php"); 
  
  
$data = new class_mysql();
$data->config();
$data->access();

  $data1 = $_POST['DATA']; 
  $tmp = explode('*@!',$data1);
 
        $ten   =  ($tmp[0])   ;
        $ma= trim($tmp[1])  ;
		$nhom= laso($tmp[2]) ;
		$kho= trim($tmp[3]) ;
		$tu= trim($tmp[4]) ;  //if($chophep_thongtinkho==false&&$_SESSION["LoginID"]!=2 ) $tu =$ngaychophep ;
		$den= trim($tmp[5]) ;		
		$IDNV= laso($tmp[6]) ;
		$trang= laso($tmp[7]) ; 
		$loai= laso($tmp[8]) ;
		$nangcao=  ($tmp[9]) ;  
		$mota=  chonghack($tmp[10]) ; 
 		$tim= laso($tmp[11]) ;
		$nganhhang= laso($tmp[12]) ;
 		$ncc=  laso($tmp[13]) ; 
		$ghichu=  chonghack($tmp[14]) ; 
		$manv=  chonghack($tmp[15]) ; 
		$CK=  laso($tmp[16]) ; 
		
		if($loai ==-11) 
		{   $manv =laso($manv) ; 
		  $sql_where.=" and   b.DonGia *(1-1* chietkhau /100)  > $IDNV  and    b.DonGia *(1-1* chietkhau /100)  <  $manv   " ; 	
		  $IDNV =0 ; $manv ='';
		} 
		else
		{
 		  if ($manv!='') { $IDNV= getdong("select ID from userac where manv='$manv' union select ID from nhanvienxuong where manv='$manv'   ") ;  $IDNV=laso($IDNV['ID']);  }
		  if($IDNV!="0" && $loai ==-8 ) { $sql_where.=" and  a.idgioithieu = $IDNV   " ; $sql_wherev.=" and  a.idgioithieu = $IDNV  " ;}
	      else if($IDNV=="0" && $loai ==-8 ) { $sql_where.=" and  a.idgioithieu >0   " ; $sql_wherev.=" and  a.idgioithieu >0 " ;}
	
		}
		$sql_where=" where a.Loai  in (1,3,5)  and a.dakhoa = 1 "; 
		$sql_wherev= 'where a.dakhoa = 1  ';
		if($nganhhang>0)  $sql_where.=" and c.IDnhom = '".$nganhhang."'";	
		
		
	 if ($loai ==1) { $sql_where .=" and (b.DonGia*(1-1*b.chietkhau/100)) <> c.price "; } 
	 if ($loai ==2) { $sql_where .=" and (b.DonGia*(1-1*b.chietkhau/100)) = c.price "; } 
	 if ($loai ==3) { $sql_where .=" and  a.tigia <>0 "; }
	 if ($loai ==4) { $sql_where .=" and  a.idnhacc  >1 "; } 
	 if ($loai ==-4) { $sql_where .=" and a.loai=3 and a.nguoisua <>-2 "; } 
     if ($loai ==-5) { $sql_where .=" and  a.idnhacc  =1 ";} 
     if ($loai>9||$loai==5){ $sql_where .=" and  a.lydo =$loai ";  $sql_wherev .=" and a.lydo ='".$loai."'";	 } 
	 if ($loai ==-6) { $sql_where .=" and ( a.lydo =53 or a.lydo =56  or  a.lydo =61   or  a.lydo =62   or  a.lydo =49)  "; 
 	      $sql_wherev .=" and ( a.lydo =53 or a.lydo =56  or  a.lydo =61   or  a.lydo =62   or  a.lydo =49)  "; 
	 }   // tong shopee
 	 if ($loai ==-7) { $sql_where .=" and ( a.lydo =46 or  a.lydo =47  or  a.lydo =48   or  a.lydo =52 or a.lydo =55    )  ";
	    $sql_wherev .=" and ( a.lydo =46 or  a.lydo =47  or  a.lydo =48   or  a.lydo =52 or a.lydo =55 )  "; 
	  }   // tong team 1,2,3,7,kids
    
	
	if ($loai ==-10) { $sql_where .=" and  a.lydo  >44 and a.loai=3 "; }  
	if ($loai ==-9) { $sql_where .=" and  a.lydo  >44 "; }  //  
	if ($loai ==-3) { $sql_where .=" and  a.nguoisua=-2"; }  // bill tra
	 
	if($ghichu!="" )	$sql_where.=" and (a.ghichu like '%".$ghichu."%' or  b.GhiChu like '%".$ghichu."%' )";		
	 
	if ($nangcao=="true")
		{
			if($ten!="") 	$sql_where.=" and c.Name like '".$ten."%'";
			if($ma!="")	    $sql_where.=" and c.codepro like '".$ma."%'";
		}else
		{
			if($ten!="" )	$sql_where.=" and c.Name  like '".$ten."%'";
			if($ma!="" )	$sql_where.=" and c.codepro like '".$ma."%'";
		}
		
		if($nhom >0 )	{ 
 			$nhom = $nhom.timnhom("groupproduct","IDGroup",$nhom);
  			$sql_where.=" and  c.IDGroup in ( $nhom ) ";
		}	
		
		if($CK>0)	{ $sql_where.=" and b.chietkhau > $CK ";  }
		if($mota!="" )	{ $sql_where.=" and c.code like '".$mota."%'";  }
		
		$idkho=$_SESSION["se_kho"]  ;
		 if ( !($idk == 1 ||  $ql[5] || $_SESSION["loai_user"]==16|| $_SESSION["loai_user"]==18))   // nv thường
		 { $sql_where.=" and a.IDKho ='".$idkho."'"; $sql_wherev.=" and a.IDKho ='".$idkho."'";	 }
		 elseif($_SESSION["loai_user"]==16&& $kho=='')
		 { $sql_where.=" and ch.IDtinh ='".$idkho."'"; $sql_wherev.=" and ch.IDtinh ='".$idkho."'";	 }
		 elseif($_SESSION["loai_user"]==18&& $kho=='')
		 { $sql_where.=" and ch.namen ='".$idkho."'"; $sql_wherev.=" and ch.namen ='".$idkho."'";	 }
 		 elseif($kho!="" )	{ $sql_where.=" and a.IDKho ='".$kho."'"; $sql_wherev.=" and a.IDKho ='".$kho."'";}
			// ==========================================ngoai le
		//	if($kho=='' && $idk ==4836)
		//	{   
				//	$sql_where.=" and a.IDKho in (1062,1071,1072)" ;
 				//    $sql_wherev=" and a.IDKho in (1062,1071,1072) ";
		//	}  
		//	else if($kho!='' && $idk ==4836)
		//	{  
		 		//$sql_where.= " and a.IDKho in (1062,1071,1072) and p.IDKho ='".$kho."'";
 				//$sql_wherev= " and a.IDKho in (1062,1071,1072) and p.IDKho ='".$kho."' ";
			 
		//	}
				// ==========================================ngoai le
		if($ncc>0 )	$sql_where.=" and c.congtho ='".$ncc."'";
		
		if($IDNV!="0" && $loai !=-8 )	 { $sql_where.=" and (a.IDTao = $IDNV  or a.diachiN='$IDNV')" ; $sql_wherev.=" and (a.IDTao = $IDNV  or a.diachiN='$IDNV')" ;}
		

		$th=   gmdate('n', time() + 7*3600) ;$ng=   gmdate('d', time() + 7*3600) ;
		$na=gmdate('Y', time() + 7*3600) ;
		if($th<3) $th =$th+12;
        if($tu=="")   $tu = gmdate('01/n/Y', time() + 7*3600-60*24*3600)  	 ;
		
		if($tu!="")	
		{
		  $ngay=  explode('/',$tu);
	  //      if (($ngay[1]+2)<($th)) {$ngay[1]= $th-2 ;	  if (($ngay[1]+2)<($th)) $ngay[0]= '01' ; if($th>12) $ngay[2]=$ngay[2]-1;}
	     if ($na!=$ngay[2])
		  {
			//  if (($ngay[1]+2)<($th)) {$ngay[1]= $th-2 ;}
		  }  
	   	  if (strlen($ngay[1])== 1) {  $ngay[1] = "0".$ngay[1] ;  }
		  if (strlen($ngay[0])== 1) {  $ngay[0] = "0".$ngay[0] ;  }    		
		  $sql_where .= " and  NgayNhap >= '$ngay[2]-$ngay[1]-$ngay[0]'";
		  $sql_wherev .= " and  NgayNhap >= '$ngay[2]-$ngay[1]-$ngay[0]'";
		}
		if($den!="")	
		{
		  $ngay=  explode('/',$den);
	   	  if (strlen($ngay[1])== 1) {  $ngay[1] = "0".$ngay[1] ;  }
		  if (strlen($ngay[0])== 1) {  $ngay[0] = "0".$ngay[0] ;  }    		
		  $sql_where .= " and  NgayNhap <= '$ngay[2]-$ngay[1]-$ngay[0]'";
		  $sql_wherev .= " and  NgayNhap <= '$ngay[2]-$ngay[1]-$ngay[0]'";
		} 
		
		
		
		$r =1 ;	 
 		
		// $sql = "SELECT * FROM products ".$sql_where." ORDER BY NgayTao desc  ";IDSP``SoLuong``DonGia``LoaiTien``Thue``BaoHanh``GhiChu``Loai` 
		 
	    if ($tim==1) {$s1=" sum(ceil(b.DonGia*(1-1*b.chietkhau/100))*b.SoLuong) as thanhtien,";$sum = " sum(b.SoLuong) as SoLuong "; }else {$s1="";$sum = " b.SoLuong "; }
		
		$sql = "SELECT $s1 a.idchol,a.tigia,c.code,m.makh,DATE_FORMAT(m.ngaysinh,'%d/%m/%y') as ngaysinh,m.address,m.diemtichluy,m.tel,m.Name as tenkh,DATE_FORMAT(a.NgayTao,'%d/%m/%y %H:%i') as ngayban,a.idgioithieu,a.SoCT ,a.nguoigiao,a.nguoitao,a.diachiN ,b.idnv as giagiamdoichieu,b.IDSP,c.Name as ten,b.chietkhau, b.DonGia,c.price as gia,c.giamgia,c.code as magoc,c.codepro as mapt, b.SoLuong,a.loai,b.ghichu,$sum  ,a.ghichu as note FROM   phieunhapxuat a left join xuatbanhang b on a.ID =b.IDPhieu left join products c on b.IDSP = c.ID left join customer m on a.IDNhaCC =m.id  " ;
		
	 if($_SESSION["loai_user"]==16||$_SESSION["loai_user"]==18)  $sql = "SELECT $s1 a.idchol,a.tigia,c.code,m.makh,DATE_FORMAT(m.ngaysinh,'%d/%m/%y') as ngaysinh  ,m.diemtichluy,m.tel,m.Name as tenkh,a.diachiN ,m.address,DATE_FORMAT(a.NgayTao,'%d/%m/%y %H:%i') as ngayban,a.SoCT ,a.nguoigiao,a.nguoitao ,b.IDSP,c.Name as ten,b.chietkhau, b.DonGia,c.price as gia,c.giamgia,c.code as magoc,c.codepro as mapt, b.SoLuong,a.loai,b.ghichu,$sum  ,a.ghichu as note FROM   phieunhapxuat a left join cuahang ch on a.IDKho=ch.ID left join xuatbanhang b on a.ID =b.IDPhieu left join products c on b.IDSP = c.ID left join customer m on a.IDNhaCC =m.id  " ;
			
		
    if ($tim==2) { $sql .= " $sql_where and a.nguoigiao like 'B211%'    order by c.Name    ";}	 
    elseif ($tim==1) { $sql .= " $sql_where group by c.ID   order by c.Name    ";}
	else { $sql .= " $sql_where     order by a.id desc,a.NgayTao desc,c.price desc  "; }
	// echo $sql ; 
   if ($_SESSION["admintuan"])	echo $sql ;
   
	
	
// SELECT b.chietkhau, b.DonGia,c.price as gia, b.SoLuong,a.loai FROM phieunhapxuat a left join xuatbanhang b on a.ID =b.IDPhieu left join products c on b.IDSP = c.ID where a.Loai in (1,3) and a.dakhoa = 1 and NgayNhap >= '2014-04-01' and NgayNhap <= '2014-04-21'
 	if($tim==2) $loai30 = " and a.nguoigiao like 'B211%' " ; else $loai30 = "" ;
 $sqld = "SELECT sum(b.DonGia*b.chietkhau/100* b.SoLuong) as ck  ,sum(b.SoLuong) as sl,sum(ceil(b.DonGia*(1-1*b.chietkhau/100))*b.SoLuong)as tongt     FROM   phieunhapxuat a left join cuahang ch on a.idkho=ch.id  left join xuatbanhang b on a.ID =b.IDPhieu left join products c on b.IDSP = c.ID  $sql_where   $loai30  ";
 $tam =getdong($sqld) ;    if ($_SESSION["admintuan"])	echo "<br>".$sqld ;
 $sqld = "SELECT  sum(a.tigia) tongv    FROM   phieunhapxuat a left join cuahang ch on a.idkho=ch.id $sql_wherev   $loai30  ";
  if ($_SESSION["admintuan"])	echo "<br>".$sqld ;
 $tamv =getdong($sqld) ; 
 
    $mangch =taomang("cuahang","ID","Name");
    $mangnv =taomang("userac","ID","MaNV");
    $mangten =taomang("userac","ID","ten");
	
    $mangxuongma = taomang("nhanvienxuong","ID","manv");
	$mangxuongten= taomang("nhanvienxuong","ID","Name");
	
	 
	
 
 	//========================================================
  if (!is_numeric($trang) ) $trang = 1 ;
   		if ($trang * 1  <= 0 ) $trang = 1 ;	
	 $result = $data->query($sql); 
	 $num=$data->num_rows($result);	
	 
//===================================================================
if($num>500 && $idkho>0 )
{	  
 $writer = new XLSXWriter();
 $tongt = 0 ;  $tongsl = 0 ;  $tongn=0;
 
 
 $writer->writeSheetHeader('Sheet1', array('STT'=>'integer','Ngày Bán'=>'string','NV Bán'=>'string','Thu ngân'=>'string','Số phiếu'=>'string','Tên khách'=>'string','Ngày sinh'=>'string','Điện thoại'=>'string','Tên sản phẩm'=>'string','Mã sản phẩm'=>'string','Mã mô tả'=>'string','Giá chuẩn'=>'integer',"Voucher"=> 'integer',"CK"=> 'integer','Giá bán'=>'integer', 'SL'=>'integer','Thành tiền'=>'integer','Ghi chú'=>'string'  ) );
 while($re = $data->fetch_array($result))
 {
   $r++ ;     
   if( $idl==1||$idl==7391)  $re['giachan']=$re['giabinhquan'];
    if ($re['loai'] ==3) $mauchu="red"; else $mauchu="" ;
    if ($gia =='0.00') $gia = "";
    if (formatso($dongia) !=  $gia) {$mauchu = "#FF00CC" ;  if ( round($dongia)== $re['giagiamdoichieu'] ) $mauchu = "blue" ;}  
    if ($re['mapt']==  "giamgia" ) $mauchu = "#FF9900" ;		
	$styleborder = array('color '=>"$mauchu" );
	
	$dongia =  $re['DonGia']*(1-1*$re['chietkhau']/100) ;		 
	$gia = number_format($re['gia']) ;
	$thanhtien =round($re['SoLuong'] * $dongia )   ; 
	$ghichu =	 $re['nguoigiao']."  " .$re['note'] ." " . $re['ghichu']  ;	
   $m= array($r,"$re[ngayban]"," $nguoiban -  $re[idchol] ","$re[nguoitao]","$re[SoCT]","$re[tenkh]","$re[ngaysinh]","$re[tel]", "$re[ten]" , "$re[mapt]" , "$re[code]" 
   , $gia , $re['tigia'] , $re['chietkhau'] , $dongia,$re['SoLuong'],$thanhtien,"$ghichu" );
   $tongsl += $re['SoLuong'] ;
   $tongt +=  $re['price'] * $re['SoLuong'] ;  
   $tongn +=  $re['giachan'] * $re['SoLuong'] ;  
   $writer->writeSheetRow('Sheet1', $m ,$styleborder);
  }
 //  $m= array('',"Tổng cộng"," "," "," ",round($tongt), round($tongn),$tongsl);
 //   $writer->writeSheetRow('Sheet1', $m );


     $writer->writeToFile('baocaobanhang.xlsx');
     echo "Số dòng $sodong quá lớn bạn có thể tải về click vào đây  <strong><a href='baocaobanhang.xlsx' target='_blank'> ( Tải về ) </a></strong>";
return;	  
}	  
//==========================================================================	 
	 
	 $pagesize = 15000; 
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
				{ $pt = $pt . " &nbsp;". "  <label style=\"color:#FF0000\">$i</label> " ;  	}
				 else { $pt = $pt . " &nbsp;". "<a style='cursor:pointer' onclick=\"submittk('$tmp[0]','$tmp[1]','$tmp[2]','$tmp[3]','$tmp[4]','$tmp[5]','$tmp[6]','$i','$tmp[8]','$tmp[9]','$tmp[10]','$tmp[11]','$tmp[12]','$tmp[13]','$tmp[14]')\"  > $i </a> " ;  } 		  
			}
 
		  }
	  }
	 $r = $pagesize * $trang - $pagesize + 1  ; 
	//==============================================================	

?>
<div>Có tổng số: <?php echo $tam['sl'] ; ?> sản phẩm bán ra & trị giá: <?php echo formatso($tam['tongt']) ; ?>&nbsp; &nbsp; Tổng tiền đã chiết khấu:  <?php echo formatso($tam['ck']) ; ?>  </div>
<div   style="display:auto;overflow:scroll;min-width:960px;max-width:1450px;height:415px"  >

 <table width="98%" border="0" cellpadding="0" cellspacing="0" class="tbchuan">		
  <thead>		
 		<tr bgcolor="#F8E4CB">
		  <th align="center"  height="23" width="29"><b>STT</b></th>
		  <th width="74" align="center" ><strong>Ngày bán</strong></th> 
           <th width="74" align="center" ><strong>NV Bán</strong></th> 
		   <th width="147" align="center" ><strong>Thu ngân </strong></th> 
		    <th width="147" align="center" ><strong>Taget</strong></th> 
		  <th width="92" align="center" ><strong>Số Phiếu</strong></th> 
          <th width="143"  colspan="3" align="center" ><strong>Thông tin khách hàng</strong></th> 
		  <th width="240" align="center"  ><strong>Tên Sản phẩm </strong></th>  
		  <th width="90" align="center" ><strong>Mã SP </strong> </th> 
          <th width="90" align="center" ><strong>Mô tả</strong> </th> 
		  <th width="79" align="center" ><strong> Giá chuẩn </strong></th>
          <th width="79" align="center" ><strong>Voucher </strong></th>
		  <th width="23" align="center" ><strong>CK</strong></th>
		  <th width="67" align="center" ><strong>Giá Bán</strong></th>	 
		   <th width="67" align="center" ><strong>Giá giảm</strong></th>
		  <th width="20" align="center" ><strong>SL</strong></th>	    	      
     	  <th width="80" align="center" ><strong>Thành Tiền</strong></th>	    	      
		  <th width="80" align="center" ><strong>Note</strong></th>
		</tr>
	 </thead>			 
<?php
 
 $mangten[0]='';$mangnv[0]='';
$tong=0;$tongsl=0; $tamct = '' ;$soct='';
while($re = $data->fetch_array($result))
{
 if($mau=="white") {$mau="#EEEEEE";$hl="Normal4";$hl2="Highlight4";}else {$mau="white";$hl = "Normal5" ; $hl2 ="Highlight5";} 
 if ($re['SoCT']!=$tamct) { $tonggiam += $re['tigia'] ;$tamct=$re['SoCT'];}
 
 if ($re['SoCT']==$soct) $re['tigia'] = 0;
 $soct = $re['SoCT'] ;
 $ten = $re['Name'] ;
 $ma = $re['codepro'] ;
 $giamgia = $re['giamgia']. "%" ;
 $baohanh = $re['baohanh'] ;
 $nhap = $re['nhap'] ;
 $xuat = $re['xuat'] ;
 $gia = number_format($re['gia']) ;
 $dongia =  $re['DonGia']*(1-1*$re['chietkhau']/100) ;
 
 $thanhtien =round($re['SoLuong'] * $dongia )   ; 
 $tong += $thanhtien ;
 $tongsl += $re['SoLuong'] ;
 $dvt = $re['DV'] ;
 if ($re['loai'] ==3) $mauchu="red"; else $mauchu="" ;
 if ($gia =='0.00') $gia = "";
 if (formatso($dongia) !=  $gia    ) {$mauchu = "#FF00CC" ;  if ( round($dongia)== $re['giagiamdoichieu'] ) $mauchu = "blue" ;}  

 
 
 if ($re['mapt']==  "giamgia" ) $mauchu = "#FF9900" ;
 $nguoiban=$mangten[$re['diachiN']]."<br>". $mangtgnv[$re['diachiN']] ." - $re[diachiN]";
 
 if($loai==5) $nguoiban = $mangch[$re['idchol']]; 
  $taget= $mangten[$re['idgioithieu']].$mangtgten[$re['idgioithieu']].  "<br>".$mangnv[$re['idgioithieu']].$mangxuongma[$re['idgioithieu']];  
	 ?>
 	 	<tr   style="cursor:pointer;color:<?php echo $mauchu ;?>"    onMouseOut="this.className='<?php echo $hl; ?>'"  bgcolor="<?php echo $mau; ?>" >
		    <td    align="right"> <?php echo $r ;?></td>	
		    <td ><?php echo $re['ngayban'] ;?></td>	
		    <td ><?php echo  $nguoiban."-". $re['idchol'] ;?></td>	
		    <td ><?php echo $re['nguoitao'] ;?></td>
			<td ><?php echo $taget ;?></td>		
			<td ><?php echo $re['SoCT'] ;?></td>
            <td ><?php echo $re['tenkh'] .'<br>'.$re['ngaysinh']   ;?></td>
            <td ><?php echo $re['tel'] .'<br>'.$re['address'] ;?></td>
            <td ><?php echo $re['diemtichluy'];?></td>
			<td ><?php echo $re['ten'];?></td>
			<td ><?php echo $re['mapt'] ;?></td>	
            <td ><?php echo $re['code'] ;?></td>				
			<td ><?php echo $gia ;?></td>
			<td ><?php echo $re['tigia'] ;?></td>
            <td ><?php echo $re['chietkhau'] ;?></td>
			<td ><?php echo formatso($dongia ) ;?></td>
			<td ><?php echo formatso($giagiam) ;?></td>
			<td ><?php echo $re['SoLuong'] ;?></td>
			<td ><?php echo formatso($thanhtien) ;?></td>
            <td ><?php echo $re['nguoigiao']."  " .$re['note'] ;?> <?php echo $re['ghichu'] ;?></td>
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
	 if($tim==1) $tong =' Gộp chỉ tính số lượng'; else $tong = formatso($tong) ;
		 
 ?>
   
    Có <?php echo  $tongsl ; ?>  sản phẩm tổng giá trị:  <?php echo $tong ; ?> &nbsp;   <?php if ($num > $pagesize ) echo "Trang : ". $pt ; ?>  
  <?php 
  } else
  {
  	 echo "<font size=2  color='#FF3300'>Không tìm dữ liệu bán hàng nào, bạn có thể tìm theo từ ngắn hơn  !!!</font> " ;
  }
 //==============================================================	
 ?>
 &nbsp; Tổng Giá trị Voucher đã xuất ra:<strong> <?php echo formatso($tamv['tongv']); ?></strong>
  Tổng thực thu: <?php echo formatso($tam['tongt']-$tamv['tongv'])  ; ?></div>


  <?php				
    $data->closedata() ;
?>	