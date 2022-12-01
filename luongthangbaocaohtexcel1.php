<?php  
session_start();
if ($_SESSION["LoginID"]=="") return ;
$root_path =getcwd()."/"  ;
include($root_path."biensession.php");
include($root_path."includes/config.php");
include($root_path."includes/removeUnicode.php");
include($root_path."includes/class.paging.php");
include($root_path."includes/class.mysql.php");
include($root_path."includes/function.php");
include($root_path."includes/function_local.php");
 
    $path = $root_path."data/luongthang.xlsx"  ; 
  // 	include( $root_path."excel/excel_reader.php");
	   	include( $root_path."excel/simplexlsx.class.php");




$idk = laso($_SESSION["LoginID"]) ; if ($idk == 0) return ;
   
$data = new class_mysql();
$data->config();
$data->access();

  $data1 = $_POST['DATA']; 
  $tmp = explode('*@!',$data1);  
  $laydulieu = laso($tmp[0]) ; 
 
  	//$datatc = new Spreadsheet_Excel_Reader($path,true,"UTF-8"); 
    $datatc = new SimpleXLSX($path);
	$sheets=$datatc->rows();
	$sd= count($sheets) ;
   
 // $sql =" TRUNCATE TABLE datatailen" ;
 // $tam=getdong($sql);
 
?>
<div style="overflow:scroll;height:400px;color:#000000">
<strong style="color:#F90">Đọc dữ liệu từ dòng 4 của file Excel</strong> <br />
<table id="tbex" width="100%" border="0" cellpadding="0" cellspacing="0" style="background:#FFF;" class="tbchuan">		
  <tr bgcolor="#F8E4CB">
		 
    <td height="44" width="53">STT</td>
    <td width="154">Tên NV</td>
    <td width="61">Mã NV</td>
    <td width="76">Ngày <br />
      vào làm</td>
    <td width="62">Chức danh</td>
    <td width="54">chức danh</td>
    <td width="98"> Hệ số<br />
      lương </td>
    <td width="49"> Hệ số vùng </td>
    <td width="87">LCB</td>
    <td width="85"> ngày chuẩn </td>
    <td width="42"> h/<br />
      ngày </td>
    <td width="59">Giờ<br />
      công</td>
    <td width="88">Lương<br />
      ngày công</td>
    <td width="99">Lương<br />
      KPI</td>
    <td width="80">Lương<br />
      danh số</td>
    <td width="151">Phụ cấp <br />
      dịch</td>
    <td width="120">Phụ cấp<br />
      khác</td>
    <td width="78">Phạt (ÂM)</td>
    <td width="64">BHXH</td>
    <td width="88">THU NHẬP </td>
    <td width="85">Lương <br />
      cũ</td>
    <td width="76">Công nợ</td>
    <td width="96">Đã ứng</td>
    <td width="76">Giữ lương</td>
    <td width="106"> THỰC NHẬN </td>
    <td width="58"> Cửa hàng </td>
    <td width="112"> Xác nhận </td>
    <td width="95">xác nhận lương    nghỉ việc</td>
    <td width="71"> Giờ công tính SP </td>
    <td width="57"> Trừ Giờ công tính SP </td>
    <td width="84"> Thưởng DS kho </td>
    <td width="86"> Thưởng DS OLT </td>
  </tr>
<?php 	
         $mangnv=taomangsql(" select  manv as ID,cuahang,ID as IDNV ,ten,ngayvaolam from userac  "  ); 
		 $thang= $sheets[0][1] ;
		   
		  echo "Lương tháng: ".$thang ;
		  $thang="01-".$thang ;  $thang=chuyenngay( $thang,"dd-mm-yyyy" ,"yyyy-mm-dd",'-'  ); 
		  if($thang=='') { echo "Bạn chưa nhập tháng"; return ;}
		$stt=0;  $loi = false ;  
	  if ($sd>9000 ) $sd = 9000 ;  
 	  $dong =2 ;
	  $toi = 9000 ; 
		for ($j = $dong; $j <= $sd ; $j++)
		{ 
		$stt++;    
 	    if($mau == "white"){$mau="#EEEEEE";$hl="Normal4";$hl2="Highlight4";}else{$mau="white";$hl = "Normal5" ;$hl2 = "Highlight5";} 
 		$mauchu ='black';
		$manv =str_replace("&nbsp;",'',trim($sheets[$j][2])) ;
		 
		if(ord($manv[1])==160)   $manv = substr($manv,2,strlen($manv)-2) ;
  	    $mauchu ='black';
		if ($manv=='') break ;
	 
		$idnv=$mangnv[$manv]['IDNV'] .'' ;
		if($idnv=='')   $mauchu ='red';
		$idcuahang=$mangnv[$manv]['cuahang'] ; $tennv=$mangnv[$manv]['ten'] ; $ngayvaolam=$mangnv[$manv]['ngayvaolam'] ;
		 $T1= $sheets[$j][1] ;
		 $T2= $sheets[$j][2] ;
		 $T3= $sheets[$j][3] ;
		 $T4= $sheets[$j][4] ;
		 $T5= $sheets[$j][5] ;
		 $T6= $sheets[$j][6] ;
		 $T7= $sheets[$j][7] ;
		 $T8= $sheets[$j][8] ;
		 $T9= $sheets[$j][9] ;
		 $T10= $sheets[$j][10] ;
		 $T11= $sheets[$j][11] ;
		 $T12= $sheets[$j][12] ;
		 $T13= $sheets[$j][13] ;
		 $T14= $sheets[$j][14] ;
		 $T15= $sheets[$j][15] ;
		 $T16= $sheets[$j][16] ;
		 $T17= $sheets[$j][17] ;
		 $T18= $sheets[$j][18] ;
		 $T19= $sheets[$j][19] ;
		 $T20= $sheets[$j][20] ;
		 $T21= $sheets[$j][21] ;
		 $T22= $sheets[$j][22] ;
		 $T23= $sheets[$j][23] ;
		 $T24= $sheets[$j][24] ;
		 $T25= $sheets[$j][25] ;
		 $T26= $sheets[$j][26] ;
		 $T27= $sheets[$j][27] ;
		 $T28= $sheets[$j][28] ;
		 $T29= $sheets[$j][29] ;
		 $T30= $sheets[$j][30] ;
		 $T31= $sheets[$j][31] ;
		 $T32= $sheets[$j][32] ;
		 
		 if($laydulieu==1)
		 { 
		 
		 	$sql="insert into ns_luongthang set luongthang='$thang',idnv='$idnv',idcuahang=$idcuahang,tennv='$tennv', manv='$manv',ngayvaolam='$ngayvaolam',ChucVu='$T4',Chucdanh='$T5',hesoluong='$T6',hesovung='$T7', luongcoban='$T8',ngaychuan='$T9',sogiotrenngay='$T10',giocong='$T11',luongngaycong='$T12',luongKPI='$T13',luongDS='$T14',phucapdich='$T15',phucapkhac='$T16',phat='$T17',BHXH='$T18',thunhap='$T19',luongcu='$T20',congno='$T21',daung='$T22',giuluong='$T23',thucnhan='$T24',cuahang='$T25',xacnhan='$T26',xacnhanluongnghiviec='$T27',giocongtinhSP='$T28',trugiocongtinhSP='$T29',thuongDSkho='$T30',thuongDSOLT='$T31' ";echo $sql;
 	       $tam=getdong($sql);
		 }
  ?>
        
 	 	<tr  style="cursor:pointer;color:<?php echo $mauchu ; ?> "   onMouseOver="this.className='<?php echo $hl2; ?>'" onMouseOut="this.className='<?php echo $hl; ?>'"  bgcolor="<?php echo $mau; ?>" >
		    <td  align="left"><?php echo $sheets[$j][0] ;?></td>				
            <td  align="left"><?php echo $sheets[$j][1] ;?></td>
 			<td  align="left"><?php echo $sheets[$j][2].'-'.$idnv  ;?></td>
 			<td  align="left"><?php echo $sheets[$j][3] ;?></td>
 			<td  align="left"><?php echo $sheets[$j][4] ;?></td>
 			<td  align="left"><?php echo $sheets[$j][5] ;?></td>
 			<td  align="left"><?php echo $sheets[$j][6] ;?></td>
 			<td  align="left"><?php echo $sheets[$j][7] ;?></td>
 			<td  align="left"><?php echo $sheets[$j][8] ;?></td>
 			<td  align="left"><?php echo $sheets[$j][9] ;?></td>
            <td  align="left"><?php echo $sheets[$j][10] ;?></td>
            <td  align="left"><?php echo $sheets[$j][11] ;?></td>
            <td  align="left"><?php echo $sheets[$j][12] ;?></td>
            <td  align="left"><?php echo $sheets[$j][13] ;?></td>
            <td  align="left"><?php echo $sheets[$j][14] ;?></td>
            <td  align="left"><?php echo $sheets[$j][15] ;?></td>
            <td  align="left"><?php echo $sheets[$j][16] ;?></td>
            <td  align="left"><?php echo $sheets[$j][17] ;?></td>
            <td  align="left"><?php echo $sheets[$j][18] ;?></td>
            <td  align="left"><?php echo $sheets[$j][19] ;?></td>
            <td  align="left"><?php echo $sheets[$j][20] ;?></td>
            <td  align="left"><?php echo $sheets[$j][21] ;?></td>
			<td  align="left"><?php echo $sheets[$j][22] ;?></td>
			<td  align="left"><?php echo $sheets[$j][23] ;?></td>
			<td  align="left"><?php echo $sheets[$j][24] ;?></td>
			<td  align="left"><?php echo $sheets[$j][25] ;?></td>
			<td  align="left"><?php echo $sheets[$j][26] ;?></td>
			<td  align="left"><?php echo $sheets[$j][27] ;?></td>
			<td  align="left"><?php echo $sheets[$j][28] ;?></td>
			<td  align="left"><?php echo $sheets[$j][29] ;?></td>
			<td  align="left"><?php echo $sheets[$j][30] ;?></td>
			<td  align="left"><?php echo $sheets[$j][31] ;?></td>
    </tr>
   <?php } ?>
   
</table>  
 
</div>   
<?php  
if ( $loi ) {?>

<div style="padding-bottom:10px;padding-left:20px"><input type="button" id="dulieue" name="dulieue"  onclick="xuatbaoloi('Có lỗi trong file tải lên chú ý chổ màu đỏ!')" value="Lấy dữ liệu Excel"/> </div>  
 <?php
}
 else  
 {
 ?>
 <div style="padding-bottom:10px;padding-left:20px"><input type="button" id="dulieue" name="dulieue"  onclick="laydulieue()" value="Lấy dữ liệu Excel"/> </div>  
  <?php
 }
      	
    $data->closedata() ;
?>	