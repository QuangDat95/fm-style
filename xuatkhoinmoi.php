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
 		 
 
 		<div    ><strong>H??? Th???ng  Th???i Trang FM Style</strong></div> 
		<div   >??C:<?php echo  $_SESSION["S_tencuahang"]  ; ?> </div> 
		
		<div  align="center" style="font-size:14px;border-bottom:1px solid #666666 "><strong>H??A ????N B??N L??? </strong></div>
		<div style=" ; padding-top:1px"  >S???:<?php echo $soct ; ?> &nbsp; Ng??y:<?php echo gmdate('d/m/Y H:i', time() + 7*3600)  ; ?></div>	
		<div style="font-size:11px; padding-top:1px;padding-bottom:3px"  > Thu Ng??n:<?php echo $_SESSION["TenUser"]  ; ?> </div>	
		<div style="font-size:11px; padding-top:1px;padding-bottom:3px"  > T?? V???n: <?php echo $tuvan ; ?> </div>	

  <?php if ($re['IDNhaCC']>1 ) { 
	        $idkhach = laso($re['IDNhaCC']);
			$sql = " select address,name,diemtichluy from customer where ID= $idkhach   ";
			$tam = getdong($sql);
      
	?>     
       <div style="font-size:11px; padding-top:1px;padding-bottom:3px" ><strong>Kh??ch h??ng: <?php echo $tam['name'] ; ?></strong>  
     <strong>&nbsp; ??i???m t??ch l??y: <?php echo $tam['diemtichluy']  ; ?> </strong></div>
             
	 <?php } ?>    	 
     
     		 
	<div align="left"> 
	 

<table border="0" cellpadding="0" cellspacing="0" width="94%" class="cltb" >
               <tr>
                 <td width="3%"  align="center"><strong>TT</strong> </td>				  
                 <td width="62%"  align="center"><strong>H??ng h??a </strong> </td>
			     			 <td width="2%"  align="center"><strong>SL</strong></td>
			                 <td width="14%"  align="center"><strong>????n gi??</strong></td>
			 				  <td width="1%"  align="center"><strong>CK</strong></td> 
			 <td width="19%" class="cotdaydu" align="center"><strong>Th??nh ti???n</strong ></td>
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
   <tr height="28px"><td colspan="2"><strong>T???ng : <?php echo formatso($tongcong + $tongchietkhau) ;?></strong></td>
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
		Ch??c m???ng b???n ???????c tham gia ch????ng tr??nh b???c th??m tr??ng th?????ng <br>
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
			$sql =" insert into phieukhuyenmai set sotien = '$sotien',iddung='$idkhach',sotiendk='2',apdungcuahang='0',ngaybatdau='$ngaybatdau',ngaytao='$ngaytao',maso='$masotudong' ,ngayhethan='$ngayhethan',ghichu ='$dieukien H?? tr??n $ghichu t???ng voucher 20% ch??? mua online tr??n website ',loai=4,IDTao='$id' " ;
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
		CH??C M???NG b???n ???? nh???n ???????c PMH gi???m gi?? <?php echo formatso($sotien) ; ?>% cho l???n mua ti???p theo t???i website fm.com.vn 
		<br>PMH n??y ??p d???ng t??? ng??y  <?php echo gmdate('d/m/Y', time() + 24*3600+ 7*3600) ; ?> ?????n  <?php echo gmdate('d/m/Y', time() + 24*31*3600+ 7*3600) ; ?>   <br>
* ??p d???ng cho s???n ph???m b???t k??? tr??n web v?? kh??ng ?????ng th???i v???i c??c ch????ng tr??nh khuy???n m??i kh??c. <br>
* M?? PMH : <?php echo $soct ; ?>  &nbsp;  H??y gi??? l???i h??a ????n nh??! <br>
		</strong></td>
		<td colspan="3" align="center">
		<?php   
		   $masotudong =base64_encode($masotudong);
		   $dataanh = file_get_contents("http://localhost/fmstyle.ovn.vn/phpqrcode/base64qrcode.php?noidung=https://fm.com.vn/ms=$masotudong&h=3");
		 
		?>
		
		<img id="anhqr" name="anhqr" src="data:image/png;base64,<?php echo $dataanh ; ?> " title="m?? khuy???n m??i" /></td>
    </tr>
   <?php 
	  }
	  $tamb= $_SESSION['thanghang']  ;  
	  $tamb= $tamb["$idkhach"] ;
	  if($tamb!='' && laso($_SESSION['phantram'])>0){
	 ?>
	   
	  <tr><td  colspan='6' style='font-size:20px; padding-top:5px;'>B???n ???? th??ng h???ng : <?php echo $_SESSION['hang'] ; ?><br>
	 <span  style='font-size:20px; padding-top:5px;'> FM xin t???ng b???n phi???u (<?php echo $soct ; ?>) gi???m gi??  <?php echo $_SESSION['phantram'].'%' ; ?> cho 2 s???n ph???m </span><br>
 
	   </td></tr> 
 	 <?php 
	  
	   }
	 
	  
	  
   ?>
      </table>
	 </div> 
   		 
 	     <div  style="padding-left:10px; padding-top:5px; "> <em><strong>T???ng ti???n b???ng ch???:</strong> 
	       <?php echo  doiso($tongcong); ?> 
         </em></div>
          <?php if ($Voucher>0) { ?> 
		  <div  style="padding-left:10px;line-height:18px; border-bottom:1px dotted #CCCCCC">Voucher: <strong><?php echo formatso($Voucher) ?></strong></div> 
		   <?php } ?> 
          <div  style="padding-left:10px;line-height:18px; border-bottom:1px dotted #CCCCCC">Ti???n thanh to??n: <strong><?php echo formatso($tongcong-$Voucher) ?></strong> kh??ch tr??? <strong><?php echo formatso($tientra); ?> </strong> <b>CK: <?php echo  $macuahang ." ". $socuoi ?></b> </div> 
		  <div  style="padding-left:10px;line-height:18px; border-bottom:1px solid #CCCCCC"> Ti???n th???a:<strong><?php echo formatso($tientra - $tongcong+$Voucher); ?></strong>
		  S??? ti???n ???????c gi???m:  <strong> <?php echo  formatso($tongchietkhau+$Voucher); ?></strong> </div>      
 <div align="left" style="padding-top:5px">
	        
        <div align="left" style="padding-top:1px">  
 - Sinh nh???t ???????c t???ng voucher gi???m 50k/100k/150k/200k theo h???ng th??nh vi??n t????ng ???ng K???t n???i/?????ng/B???c/V??ng/Kim C????ng.<br>
- L??? T???t mua h??ng theo ch??nh s??ch c???c ??u ????i.<br>
- ?????i h??ng trong v??ng 03 ng??y (???????c ?????i 01 l???n)<br>
- B???o h??nh s???n ph???m trong v??ng 30 ng??y (KH th??nh vi??n), 07 ng??y (kh??ch l???).<br>
- S???n ph???m ph???i c??n nh??n, h??a ????n, c??n nguy??n v???n, kh??ng b??? d?? b???n, kh??ng c?? m??i ???? qua s??? d???ng/gi???t t???y.<br>
- H??ng ?????i c?? gi?? tr??? ??? h??ng ???? mua.<br>
- H??ng KM, h??ng len/d???t kim/ren/da, qu???n legging, ??o l??ng/d???, ph??? ki???n kh??ng ???????c ?????i tr???.<br>
- M???i th???c m???c vui l??ng li??n h???: 0901 800 888 ( ph??m 8)<br>
C???m ??n Qu?? Kh??ch ???? mua s???m t???i Fm Style!<br>

 
            </div>
 </div>
 	 
 
     </div>
	 
 </div>
  
 </div></body>
 </html>

 