<?php session_start();	     
$root_path =getcwd()."/"  ;
include($root_path."biensession.php");
include($root_path."includes/config.php");
include($root_path."includes/removeUnicode.php");
include($root_path."includes/class.paging.php");
include($root_path."includes/class.mysql.php");
include($root_path."includes/function.php");
include($root_path."includes/function_local.php");


 
   $data = new class_mysql();
   $data->config();
   $data->access();
?>
 
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 
 <style>
 
  .cltb {    border-collapse: collapse;    border-spacing: 0; border:10px }
  .cltb th, .cltb td {     border: 1px solid #333333;    padding: 5px 3px 5px 5px;font-size:11px}
 </style>

 <?php
   $data1 = $_REQUEST['DATA']; 
   $tmp = explode('*@!',$data1);
   $soct = chonghack($tmp[0]);
  //  $soct = $_REQUEST["id"];
 
    if($soct=="undefined") return ;
    $sql = "select a.*,b.ten,mid(macuahang,4,LENGTH(c.macuahang)) as macuahang  from phieunhapxuat a left join userac b on a.diachin=b.id left join cuahang c on a.idkho=c.id where a.SoCT =  '$soct' and a.dakhoa = '1'   " ;
 // if ($_SESSION["admintuan"])  echo $sql ; 
   $result = $data->query($sql);
   $re = $data->fetch_array($result) ;
   if ($re['ID'] == "") return ;
   $tuvan= $re["ten"] ;
   $tenlydo=$re["tenlydo"];$ten=$re["ten"];$diachi=$re["diachi"];$NguoiGiao=$re["NguoiGiao"] ;$tenkho=$re["tenkho"];$NgayNhap = $re["NgayNhap"] ;
   $tientra=$re["tientra"] ;$Voucher=$re["TiGia"] ; $macuahang =$re["macuahang"];
   $socuoi= explode('.',$re["SoCT"]); $socuoi=$socuoi[2]   ;
	 $ngay=  explode('-',$NgayNhap);
	 if (strlen($ngay[1])== 1) {  $ngay[1] = "0".$ngay[1] ;  }
	 if (strlen($ngay[0])== 1) {  $ngay[0] = "0".$ngay[0] ;  }
  
  if ($re["dakhoa"] ==1)
  {
    $sql = "select  (SoLuong*DonGia  ) as thanhtien,tenpt,SoLuong,DonGia,chietkhau from xuatbanhang    where IDPhieu =   '".$re["ID"]."' and dongia<>1  " ;
   }
   else $sql = "select (SoLuong*DonGia  ) as thanhtien,tenpt,SoLuong,DonGia,chietkhau  from xuatbhchuakhoa where IDPhieu =   '".$re["ID"]."' and dongia<>1 " ;
   
 //  echo $sql ;
   $resultc = $data->query($sql);
  
 
   				
?><body style="margin:0;padding:0; "  >

<div style="width:100%; font-size:12px" align="center" > 
<div style="width:auto" align="left">
  <div style="padding-left:10px;padding-right:14px; "  >	
 		 
 
 		<div    ><strong>Hệ Thống  Thời Trang FM Style</strong></div> 
		<div   >ĐC:<?php echo  $_SESSION["S_tencuahang"]  ; ?> </div> 
		
		<div  align="center" style="font-size:14px;border-bottom:1px solid #666666 "><strong>HÓA ĐƠN BÁN LẺ </strong></div>
		<div style=" ; padding-top:1px"  >Số:<?php echo $soct ; ?> &nbsp; Ngày:<?php echo gmdate('d/m/Y H:i', time() + 7*3600)  ; ?></div>	
		<div style="font-size:11px; padding-top:1px;padding-bottom:3px"  > Thu Ngân:<?php echo $_SESSION["TenUser"]  ; ?> </div>	
		<div style="font-size:11px; padding-top:1px;padding-bottom:3px"  > Tư Vấn: <?php echo $tuvan ; ?> </div>	

  <?php if ($re['IDNhaCC']>1 ) { 
	        $idkhach = laso($re['IDNhaCC']);
			$sql = " select address,name,diemtichluy from customer where ID= $idkhach   ";
			$tam = getdong($sql);
      
	?>     
       <div style="font-size:11px; padding-top:1px;padding-bottom:3px" ><strong>Khách hàng: <?php echo $tam['name'] ; ?></strong>  
     <strong>&nbsp; Điểm tích lũy: <?php echo $tam['diemtichluy']  ; ?> </strong></div>
             
	 <?php } ?>    	 
     
     		 
	<div align="left"> 
	 

<table border="0" cellpadding="0" cellspacing="0" width="94%" class="cltb" >
               <tr>
                 <td width="3%"  align="center"><strong>TT</strong> </td>				  
                 <td width="62%"  align="center"><strong>Hàng hóa </strong> </td>
			     			 <td width="2%"  align="center"><strong>SL</strong></td>
			                 <td width="14%"  align="center"><strong>Đơn giá</strong></td>
			 				  <td width="1%"  align="center"><strong>CK</strong></td> 
			 <td width="19%" class="cotdaydu" align="center"><strong>Thành tiền</strong ></td>
            </tr>
<?php
  $r = 0 ;  $tongcong = 0 ; $tongchietkhau=0;
   while ($rec = $data->fetch_array($resultc)) 
   {
   
   $r =$r+1 ;
  
   $tongsl += $rec["SoLuong"] ;
   $chietkhau = $rec["DonGia"] *$rec["chietkhau"]/100 ;
   $gia =  round(($rec["DonGia"] -$chietkhau )/10)*10;
   $thanhtien =  $gia *  $rec["SoLuong"] ;
   $tongchietkhau +=  $chietkhau* $rec["SoLuong"] ;
   $tongcong +=  ($thanhtien) ;
 ?>

               <tr>
                 <td width="3%" align="right"><?php echo $r ;?></td>				  
                 <td width="62%" ><?php echo $rec["tenpt"] ;?></td>
 				 <td width="2%"  align="right"><?php echo formatso(abs($rec["SoLuong"])) ;?></td>
				 <td width="14%" align="right"><?php echo formatso($rec["DonGia"]) ;?></td>
			     <td width="1%" align="right"><?php echo  $rec["chietkhau"]  ;?></td>
				 <td width="19%"   align="right"><?php echo formatso($thanhtien) ;?></td>
               </tr>
<?php

   }
 ?>
   <tr height="28px"><td colspan="2"><strong>Tổng : <?php echo formatso($tongcong + $tongchietkhau) ;?></strong></td>
   <td align="right"  ><strong><?php echo formatso($tongsl) ;?></strong></td>
    
    <td width="19%" colspan="3" 	   align="right"><strong><?php echo formatso($tongcong) ;?></strong></td>
   </tr>
   
   <?php 
     $time = "2022-06-02";   $time1 = "2022-06-03"; $chan= gmdate('H:i', time() + 7*3600) ;  $changay=gmdate('Y-m-d', time() + 7*3600) ;
     $ngay1 = strtotime($time);
     
	  $ngay2=strtotime($NgayNhap);
	  
	 if ((($tongcong+10)-$Voucher)>=300000 && $_SESSION['se_kho']==1133 && ($time==$changay || $time1==$changay) && 1*$chan<17  )
	  {  
	  ?>
 <tr height="28px">
   		<td colspan="6"><strong style="font-size:18px">
		Chúc mừng bạn được tham gia chương trình bốc thăm trúng thưởng <br>
		</strong></td>
    </tr>	
	<?php  
	  }
   
      if ((($tongcong+10)-$Voucher)>=300000 && $ngay2>=$ngay1   )
	  {
//===============================================
	$iddung=$re['ID'];
 	$masotudong = $re['SoCT'];
	$sql ="select * from phieukhuyenmai where maso='$masotudong'   limit 1 ";
	$tam=getdong($sql);
		if(laso($tam['ID'])==0)
		{  
		     if ((($tongcong+10)-$Voucher)>=300000) {$ghichu=  "300k";  $sotien =20; } else  { $ghichu=  "300k" ; $sotien= 20; }
			 
			$dieukien = "#GVC#$sotien#DK#gia#>#1000# " ;  // ma giam gia cho website
			 
		    $thang = gmdate('m', time() + 7*3600); $nam = gmdate('y', time() + 7*3600); 
			$ngaytao=gmdate('Y-m-d H:i:s',time()+7*3600); $ngaybatdau =gmdate('Y-m-d', time() + 24*2*3600+ 7*3600);$ngayhethan=gmdate('Y-m-d', time() + 24*32*3600+ 7*3600) ;
			$sql =" insert into phieukhuyenmai set sotien = '$sotien',iddung='$idkhach',sotiendk='2',apdungcuahang='0',ngaybatdau='$ngaybatdau',ngaytao='$ngaytao',maso='$masotudong' ,ngayhethan='$ngayhethan',ghichu ='$dieukien HĐ trên $ghichu tặng voucher 20% chỉ mua online trên website ',loai=4,IDTao='$id' " ;
			$update = $data->query($sql);
		 
	    }
		else
		{
		     $sotien = $tam['sotien']  ;  if ($tam['sotien']==20  ) $ghichu=  "20%";   
		}
	 
	 //==========================================================
	  ?>
   <tr height="28px">
   		<td colspan="3"><strong>
		CHÚC MỪNG bạn đã nhận được PMH giảm giá <?php echo formatso($sotien) ; ?>% cho lần mua tiếp theo tại website fm.com.vn 
		<br>PMH này áp dụng từ ngày  <?php echo gmdate('d/m/Y', time() + 24*3600+ 7*3600) ; ?> đến  <?php echo gmdate('d/m/Y', time() + 24*31*3600+ 7*3600) ; ?>   <br>
* Áp dụng cho sản phẩm bất kỳ trên web và không đồng thời với các chương trình khuyến mãi khác. <br>
* Mã PMH : <?php echo $soct ; ?>  &nbsp;  Hãy giữ lại hóa đơn nhé! <br>
		</strong></td>
		<td colspan="3" align="center">
		<?php   
		   $masotudong =base64_encode($masotudong);
		   $dataanh = file_get_contents("http://localhost/fmstyle.ovn.vn/phpqrcode/base64qrcode.php?noidung=https://fm.com.vn/ms=$masotudong&h=3");
		 
		?>
		
		<img id="anhqr" name="anhqr" src="data:image/png;base64,<?php echo $dataanh ; ?> " title="mã khuyến mãi" /></td>
    </tr>
   <?php 
	  }
	  $tamb= $_SESSION['thanghang']  ;  
	  $tamb= $tamb["$idkhach"] ;
	  if($tamb!='' && laso($_SESSION['phantram'])>0){
	 ?>
	   
	  <tr><td  colspan='6' style='font-size:20px; padding-top:5px;'>Bạn đã thăng hạng : <?php echo $_SESSION['hang'] ; ?><br>
	 <span  style='font-size:20px; padding-top:5px;'> FM xin tặng bạn phiếu (<?php echo $soct ; ?>) giảm giá  <?php echo $_SESSION['phantram'].'%' ; ?> cho 2 sản phẩm </span><br>
 
	   </td></tr> 
 	 <?php 
	  
	   }
	 
	  
	  
   ?>
      </table>
	 </div> 
   		 
 	     <div  style="padding-left:10px; padding-top:5px; "> <em><strong>Tổng tiền bằng chữ:</strong> 
	       <?php echo  doiso($tongcong); ?> 
         </em></div>
          <?php if ($Voucher>0) { ?> 
		  <div  style="padding-left:10px;line-height:18px; border-bottom:1px dotted #CCCCCC">Voucher: <strong><?php echo formatso($Voucher) ?></strong></div> 
		   <?php } ?> 
          <div  style="padding-left:10px;line-height:18px; border-bottom:1px dotted #CCCCCC">Tiền thanh toán: <strong><?php echo formatso($tongcong-$Voucher) ?></strong> khách trả <strong><?php echo formatso($tientra); ?> </strong> <b>CK: <?php echo  $macuahang ." ". $socuoi ?></b> </div> 
		  <div  style="padding-left:10px;line-height:18px; border-bottom:1px solid #CCCCCC"> Tiền thừa:<strong><?php echo formatso($tientra - $tongcong+$Voucher); ?></strong>
		  Số tiền được giảm:  <strong> <?php echo  formatso($tongchietkhau+$Voucher); ?></strong> </div>      
 <div align="left" style="padding-top:5px">
	        
        <div align="left" style="padding-top:1px">  
 - Sinh nhật được tặng voucher giảm 50k/100k/150k/200k theo hạng thành viên tương ứng Kết nối/Đồng/Bạc/Vàng/Kim Cương.<br>
- Lễ Tết mua hàng theo chính sách cực ưu đãi.<br>
- Đổi hàng trong vòng 03 ngày (được đổi 01 lần)<br>
- Bảo hành sản phẩm trong vòng 30 ngày (KH thành viên), 07 ngày (khách lẻ).<br>
- Sản phẩm phải còn nhãn, hóa đơn, còn nguyên vẹn, không bị dơ bẩn, không có mùi đã qua sử dụng/giặt tẩy.<br>
- Hàng đổi có giá trị ≥ hàng đã mua.<br>
- Hàng KM, hàng len/dệt kim/ren/da, quần legging, áo lông/dạ, phụ kiện không được đổi trả.<br>
- Mọi thắc mắc vui lòng liên hệ: 0901 800 888 ( phím 8)<br>
Cảm ơn Quý Khách đã mua sắm tại Fm Style!<br>

 
            </div>
 </div>
 	 
 
     </div>
	 
 </div>
  
 </div></body>
 </html>

 