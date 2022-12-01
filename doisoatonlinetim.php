<?php  
session_start(); 

  $ngaychan= gmdate('Y-m-d H:i:s', time() + 7*3600) ;
  $act= $_SESSION["act"] ; 
  $quyen= $_SESSION["quyen"] ; 
   $ql =$quyen[$_SESSION["mangquyenid"][$act]]  ; 
  
  
  
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
		$tu= trim($tmp[4]) ;
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
		 
		$sql_where=" where a.Loai  in (1,3)  and a.dakhoa = 1 and (a.idkho=1105 or a.lydo > 45) "; 
	 
		if($nganhhang>0)  $sql_where.=" and c.IDnhom = '".$nganhhang."'";	
		
		
	 if ($loai ==1) { $sql_where .=" and (b.DonGia*(1-1*b.chietkhau/100)) <> c.price "; }
	 if ($loai ==2) { $sql_where .=" and (b.DonGia*(1-1*b.chietkhau/100)) = c.price "; }
	 if ($loai ==3) { $sql_where .=" and  a.tigia  >0 "; }
	 if ($loai ==4) { $sql_where .=" and  a.idnhacc  >1 "; } 
     if ($loai ==-5) { $sql_where .=" and  a.idnhacc  =1 ";} 
     if ($loai>9||$loai==5){ $sql_where .=" and  a.lydo =$loai ";  $sql_wherev .=" and a.lydo ='".$loai."'";	 } 
	 if ($loai ==-6) { $sql_where .=" and ( a.lydo =53 or a.lydo =56  or  a.lydo =61   or  a.lydo =62   or  a.lydo =49)  "; 
 	      $sql_wherev .=" and ( a.lydo =53 or a.lydo =56  or  a.lydo =61   or  a.lydo =62   or  a.lydo =49)  "; 
	 }   // tong shopee
 	 if ($loai ==-7) { $sql_where .=" and ( a.lydo =46 or  a.lydo =47  or  a.lydo =48   or  a.lydo =52 or a.lydo =55    )  ";
	    $sql_wherev .=" and ( a.lydo =46 or  a.lydo =47  or  a.lydo =48   or  a.lydo =52 or a.lydo =55 )  "; 
	  }   // tong team 1,2,3,7,kids
    if ($loai ==-8) { $sql_where .=" and  a.idgioithieu  >0 "; }  // taget
	if ($loai ==-9) { $sql_where .=" and  a.lydo  >44 "; }  //  
	if ($loai ==-3) { $sql_where .=" and  a.nguoisua=-2"; }  // bill tra
	if ($loai ==-10) { $sql_where .=" and  a.lydo  >44 and a.loai=3 "; }  
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
		
		
	 
		
		$idkho=$_SESSION["se_kho"]  ;
		 if ( !($idk == 1 ||  $ql[5] || $_SESSION["loai_user"]==16))   // nv thường
		 { $sql_where.=" and a.IDKho ='".$idkho."'"; $sql_wherev.=" and a.IDKho ='".$idkho."'";	 }
		 elseif($_SESSION["loai_user"]==16&& $kho=='')
		 { $sql_where.=" and ch.IDtinh ='".$idkho."'"; $sql_wherev.=" and ch.IDtinh ='".$idkho."'";	 }
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
		if($IDNV!="0" )	 { $sql_where.=" and (a.IDTao = $IDNV  or a.diachiN='$IDNV')" ; $sql_wherev.=" and (a.IDTao = $IDNV  or a.diachiN='$IDNV')" ;}

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
		 
	 
    $mangteam =taomang("lydonhapxuat","ID","Name"," where id>45  and loai=1" );	
   $macuahang =taomang("cuahang","ID","macuahang");
 
 	
		$sql = "SELECT  sum(b.DonGia*(1-1*b.chietkhau/100)*b.SoLuong) as thanhtien,a.tigia, a.lydo as team,a.idchol,a.tigia ,m.makh,DATE_FORMAT(m.ngaysinh,'%d/%m/%y') as ngaysinh,m.address,m.diemtichluy,m.tel,m.Name as tenkh,DATE_FORMAT(a.NgayTao,'%d/%m/%y %H:%i') as ngayban,a.idgioithieu,a.idkho,a.SoCT ,a.nguoigiao,a.nguoitao,a.diachiN  ,  a.loai,b.ghichu, a.ghichu as note,v.mavd ,v.donvivc 
		FROM   phieunhapxuat a left join xuatbanhang b on a.ID =b.IDPhieu  left join customer m on a.IDNhaCC =m.id left join vanchuyenonline v on a.id=v.idbill  $sql_where group by a.ID    order by a.ID desc    "; 
 
	//	echo $sql ; 
   if ($_SESSION["admintuan"])	echo $sql ;
   
	 
 
 
 	//========================================================
  if (!is_numeric($trang) ) $trang = 1 ;
   		if ($trang * 1  <= 0 ) $trang = 1 ;	
	 $result = $data->query($sql); 
	 $num=$data->num_rows($result);	
	 $pagesize =  10000; 
	 //==============================================================	
if($num>10000)
{	  
	 
 $writer = new XLSXWriter();
 $tongt = 0 ;  $tongsl = 0 ;  $tongn=0;
 $writer->writeSheetHeader('Sheet1', array('STT'=>'integer','Ngày bán '=>'string','Đơn vị vận chuyển'=>'string','Mã vận đơn'=>'string','Thông tin khách hàng'=>'string','số điện thoại'=>'string',"Số hóa đơn"=> 'string','Thành tiền'=>'integer',"Mã Cửa hàng"=> 'string',"Team Online"=> 'string','Ghi chú'=>'string' ) );
 while($re = $data->fetch_array($result))
 {
   $r++ ;    
    $thanhtien =  $re['thanhtien']-$re['tigia']   ;  $ghichu =$re['nguoigiao']."  " .$re['note']."  "  . $re['ghichu'] ;
	$mach= $macuahang[$re['idkho']] ; $team =$mangteam[$re['team']] ;
   $m= array($r,"$re[ngayban]","$re[donvivc]","$re[mavd]","  $re[tenkh]    $re[ngaysinh]   $re[address] ", " $re[tel]"," $re[SoCT]", $thanhtien," $mach "," $team" ," $ghichu " );
     
   $writer->writeSheetRow('Sheet1', $m );
  }
 
     $writer->writeToFile('doisoatonine.xlsx');
     echo "Số dòng $sodong quá lớn bạn có thể tải về click vào đây  <strong><a href='doisoatonine.xlsx' target='_blank'> ( Tải về ) </a></strong>";
return;	  
}	  

//=======================================================
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
	
?>
 
<div   style="display:auto;overflow:scroll ;width:1070px;height:450px"  >
  <table width="98%" border="0" cellpadding="0" cellspacing="0" class="tbchuan">
    <thead>
      <tr bgcolor="#F8E4CB">
        <th align="center"  height="23" width="29"><b>STT</b> </th>
        <th width="74" align="center" ><strong>Ngày bán</strong> </th>
        <th width="74" align="center" ><strong>Đơn vị vận chuyển </strong></th>
        <th width="147" align="center" ><strong>Mã vận đơn </strong> </th>
        <th width="147" align="center" ><strong>Thông tin khách hàng </strong> </th>
        <th width="92" align="center" ><strong>Số ĐT </strong> </th>
        
        <th align="left" width="191"><strong>Số Phiếu</strong></th>
        <th align="left" width="95">Thành tiền </th>
		 <th align="left" width="64">Mã Cửa hàng </th>
        <th align="left" width="86">Team  Online </th>
		<th align="left" width="95">Ghi chú</th>
       </tr>
      <?php
 

$tong=0;$tongsl=0; $tamct = '' ;$soct='';
while($re = $data->fetch_array($result))
	{
 if($mau=="white") {$mau="#EEEEEE";$hl="Normal4";$hl2="Highlight4";}else {$mau="white";$hl = "Normal5" ; $hl2 ="Highlight5";} 
 if ($re['SoCT']!=$tamct) { $tonggiam += $re['tigia'] ;$tamct=$re['SoCT'];}
 
 if ($re['SoCT']==$soct) $re['tigia'] = 0;
 $soct = $re['SoCT'] ;
  $thanhtien =  $re['thanhtien']-$re['tigia']   ; 
  $ghichu =$re['nguoigiao']."  " .$re['note']."  "  . $re['ghichu'] ;
 $tong +=  $thanhtien;
 
 if ($re['loai'] ==3) $mauchu="red"; else $mauchu="" ;
   

  $nguoiban=$mangten[$re['diachiN']]."<br>". $mangnv[$re['diachiN']] ." - $re[diachiN]";
 
 	 ?>
      <tr   style="cursor:pointer;color:<?php echo $mauchu ;?>"    onmouseout="this.className='<?php echo $hl; ?>'"  bgcolor="<?php echo $mau; ?>" >
        <td    align="right"><?php echo $r ;?></td>
        <td ><?php echo $re['ngayban'] ;?></td>
        <td ><?php echo  $re['donvivc'] ;?></td>
        
       
        <td ><?php echo $re['mavd'];?></td>
        <td ><?php echo $re['tenkh'] .'<br>'.$re['ngaysinh'] .'<br>'.$re['address']  ;?></td>
        <td ><?php echo $re['tel']  ;?></td>
        <td ><?php echo $re['SoCT'] ;?></td>
     
        <td ><?php echo formatso($thanhtien ) ;?></td>
	    <td ><?php echo $macuahang[$re['idkho']] ;?></td>
        <td ><?php echo $mangteam[$re['team']] ;?></td>
        <td ><?php echo $ghichu ;?></td>
       
      </tr>
      <?php				
	$r++;
	}
?>
    </thead>
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