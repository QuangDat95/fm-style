<?php
session_start();
  
$root_path =getcwd()."/"  ;
include($root_path."biensession.php");
include($root_path."includes/config.php");
include($root_path."includes/removeUnicode.php");
include($root_path."includes/class.paging.php");
include($root_path."includes/class.mysql.php");
include($root_path."includes/function.php");
include($root_path."tinhluongkpifunction.php"); 	

$data = new class_mysql();
$data->config(); 
$data->access();
$idnv='7576';
if(isset($_REQUEST['idnv'])){
	$idnv=$_REQUEST['idnv'];
}
$sql="select chucvu from userac where id=$idnv";
$dong=getdong($sql);
$chucvu=$dong['chucvu'];
$mangchucvu= taomang("kh_chucvu","ID","Name");
 
$chucvuten=$mangchucvu[$chucvu];
//echo $chucvuten;
$thang=date('m');
$nam=date('Y');


//luong kpi miền
$luongcoban=1000000;
$socuahang=10;
$doanhthumuctieu=1000000000;
$doanhthutatcacuahang=800000000;
$songaymocua=20;
$luongtrachnhiemchuan=1000000;
$hanghoa=20;
$nhansudaotao=20;
$doanhthumoicuahang=40;
$dichvu=20;
$luongkpimien=15000000;
$thang=11;
$nam=2021;
$luong= luongQuanLyVungMien($luongcoban,$socuahang,$doanhthumuctieu,$doanhthutatcacuahang,$songaymocua,$luongtrachnhiemchuan,$hanghoa,$nhansudaotao,$doanhthumoicuahang,$dichvu,$luongkpimien,$thang,$nam);
//in(number_format($luong));

//luong kpi vùng
$luongcoban=1000000;
$socuahang=10;
$doanhthumuctieu=1000000000;
$doanhthutatcacuahang=800000000;
$songaymocua=20;
$luongtrachnhiemchuan=1000000;
$hanghoa=20;
$nhansudaotao=20;
$doanhthumoicuahang=40;
$dichvu=20;
$luongkpimien=8000000;
$thang=10;
$nam=2021;
$luong= luongQuanLyVungMien($luongcoban,$socuahang,$doanhthumuctieu,$doanhthutatcacuahang,$songaymocua,$luongtrachnhiemchuan,$hanghoa,$nhansudaotao,$doanhthumoicuahang,$dichvu,$luongkpimien,$thang,$nam);
//in(number_format($luong));



//luong kpi chtchp
$luongcoban=4800000;
$doanhthumuctieu=1000000000;
$doanhthudoichieu=1000000000;
$doanhthuthuc=1500000000;
$doanhthudat=80;
$giatricotloi=20;
$cocuahangpho=true;
$luongkpichuan=4000000;
$loai=1;

$luong= luongCHTCHP($luongcoban,$doanhthudoichieu,$doanhthumuctieu,$doanhthuthuc,$doanhthudat,$giatricotloi,$cocuahangpho,$luongkpichuan,$loai);
//in(number_format($luong));


//luong kpi chp
$luongcoban=4000000;
$doanhthumuctieu=1000000000;
$doanhthudoichieu=1000000000;
$doanhthuthuc=1500000000;
$doanhthudat=80;
$giatricotloi=20;
$cocuahangpho=true;
$luongkpichuan=3000000;
$loai=2;

$luong= luongCHTCHP($luongcoban,$doanhthudoichieu,$doanhthumuctieu,$doanhthuthuc,$doanhthudat,$giatricotloi,$cocuahangpho,$luongkpichuan,$loai);
//in(number_format($luong));

//luong kpi to truong
$luongcoban=4000000;
$doanhthucanhan=200000000;
$luongtrachnhiem=1000000;

$luong= luongToTruong($luongcoban,$doanhthucanhan,$luongtrachnhiem);
//in(number_format($luong));


//chuyen viên thu ngan
$luongcoban=4000000;
$doanhthucalamviec=600000000;
$hesodoanhthu=0.5;
$doanhthucanhan=100000000;
$luong=  luongCVTN($luongcoban,$doanhthucalamviec,$hesodoanhthu,$doanhthucanhan);
//in(number_format($luong));


//chuyen viên thu ngan
$luongcoban=4000000;
$doanhthucanhan=200000000;
$luong=  luongCVTV($luongcoban,$doanhthucanhan);
//in(number_format($luong));


//Tiếp đón khách hàng
$luongcoban=4000000;
$doanhthucalamviec=550000000;
$hesodoanhthu=0.2;
$luongkpi=500000;
$luong=  luongTDKH($luongcoban,$doanhthucalamviec,$hesodoanhthu,$luongkpi);
//in(number_format($luong));

//văn phòng
$luongcoban=6000000;
$luongkpidoanhthu=1000000;
$doanhthumuctieu=13000000000;
$doanhthuthuc=13000000000;
$luongkpi=500000;
$luong= luongVP($luongcoban,$luongkpi,$luongkpidoanhthu,$doanhthumuctieu,$doanhthuthuc);
//in(number_format($luong));

//luong ASM
$luongcoban=7000000;
$doanhthudoichieu=4000000000;
$luongkpi=8000000;
$doanhthudexuat=13000000000;
$chiphiquangcao=300000000;
$doanhthuthuc=11000000000;
$chiphiquangcaothuc=100000000;


$luong=luongASM($luongcoban,$doanhthudoichieu,$luongkpi,$doanhthudexuat,$chiphiquangcao,$doanhthuthuc,$chiphiquangcaothuc);
//in(number_format($luong["luong"]));
//chuyen viên sale online
$luongcoban=4000000;
$doanhthucanhan=70000000;
$loai=2;
$luong= luongCVSaleOnline($luongcoban,$doanhthucanhan,$loai);
//in(number_format($luong["luong"]));

//luong trưởng phòng sale
$luongcoban=7000000;
$doanhthudoichieu=4000000000;
$luongkpi=6000000;
$doanhthudexuat=10000000000;
$chiphiquangcao=250000000;
$doanhthuthuc=15000000000;
$chiphiquangcaothuc=150000000;
$nvsale=4;
$nvsaletv=10;

$luong=luongtruongphongsale($luongcoban,$doanhthudoichieu,$luongkpi,$doanhthudexuat,$chiphiquangcao,$doanhthuthuc,$chiphiquangcaothuc,$nvsale,$nvsaletv);
//in(number_format($luong["luong"]));


//luong phó team online
$luongcoban=6000000;
$doanhthudexuat=2500000000;
$chiphiquangcao=280000000;
$doanhthuthuc=2000000000;
$chiphiquangcaothuc=100000000;
$nvsale=12;
$nvsaletv=8;

$luong=luongphoteamonline($luongcoban,$doanhthudexuat,$chiphiquangcao,$chiphiquangcaothuc,$doanhthuthuc,$nvsale,$nvsaletv,true);



//chuyên viên content
$luongcoban=6000000;
$doanhthudexuat=1200000000;
$doanhthuthuc=1300000000;
$luongkpi=8000000;
$luong=luongchuyenviencontent($luongcoban,$doanhthudexuat,$doanhthuthuc);

//truong phong tmdt
$luongcoban=7000000;
$doanhthudexuat=2000000000;
$doanhthuthuc=2500000000;
$doanhthudoichieu=3000000000;
$chiphi=1000000000;
$luongkpi=8000000;
$luong=luongtruongphongtmdt($luongcoban,$doanhthudexuat,$doanhthuthuc,$doanhthudoichieu,$luongkpi,$chiphi);
	
	
//chuyen viên tmdt
$luongcoban=6000000;
$doanhthudexuat=2000000000;
$doanhthuthuc=2500000000;
$doanhthudoichieu=3000000000;
$chiphi=1000000000;
$luongkpi=5000000;
$luong=luongchuyenvientmdt($luongcoban,$doanhthudexuat,$doanhthuthuc,$doanhthudoichieu,$luongkpi,$chiphi);
	
//trưởng phòng quảng cáo	
$luongcoban=7000000;
$doanhthudexuat=5000000000;
$doanhthuthuc=7000000000;
$doanhthudoichieu=4000000000;
$chiphi=3000000000;
$luongkpi=6000000;
$soluongtp=1;
$soluongtn=1;
$soluongnv=6;
$loaicv=1;
//$luong=luongtruongphongquangcao($luongcoban,$doanhthudexuat,$doanhthuthuc,$doanhthudoichieu,$luongkpi,$chiphi,$loaicv,0,$soluongtp,$soluongtn,$soluongnv);
//in(number_format($luong["luong"]));



//trưởng nhóm quảng cáo	
$luongcoban=6000000;
$doanhthudexuat=10000000000;
$doanhthuthuc=12500000000;
$doanhthudoichieu=4000000000;
$luongtrachnhiem=1000000;
$chiphi=4000000000;
$luongkpi=6000000;
$soluongtp=1;
$soluongtn=1;
$soluongnv=6;
$loaicv=2;
$luong=luongtruongphongquangcao($luongcoban,$doanhthudexuat,$doanhthuthuc,$doanhthudoichieu,$luongkpi,$chiphi,$loaicv,$luongtrachnhiem,$soluongtp,$soluongtn,$soluongnv);
//in(number_format($luong["luong"]));


//cv quảng cáo	
$luongcoban=6000000;
$doanhthudexuat=10000000000;
$doanhthuthuc=12500000000;
$doanhthudoichieu=4000000000;
$luongtrachnhiem=1000000;
$chiphi=4000000000;
$luongkpi=6000000;
$soluongtp=1;
$soluongtn=1;
$soluongnv=6;
$loaicv=3;
$luong=luongtruongphongquangcao($luongcoban,$doanhthudexuat,$doanhthuthuc,$doanhthudoichieu,$luongkpi,$chiphi,$loaicv,$luongtrachnhiem,$soluongtp,$soluongtn,$soluongnv);
//in(number_format($luong["luong"]));

//trưởng phong live stream
$luongcoban=6750000;
$doanhthuhethong=80;
$luongkpi=750000;

$luong=luongtruongphonglivestream($luongcoban,$doanhthuhethong,$luongkpi);
in(number_format($luong["luong"]));
function in($str){

	echo "<pre>";
	var_dump($str);
	echo "</pre>";
}


/*
$string='0392579253';
echo replacesdt($string);
function replacesdt($sdt){
	$result='';
	
	if($sdt[0]=="+"){
		$result=substr($sdt,3);
		$result='0'.$result;
	}
	else if($sdt[0]==8 && $sdt[1]==4){
		$result=substr($sdt,2);
		$result='0'.$result;
	}
	else{
		 $result=$sdt;
	}	
	
	return $result;
}*/
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html   lang="en" xml:lang="en">
<meta http-equiv="Page-Exit" content="progid:DXImageTransform.Microsoft.Fade(duration=.9)" />		
<head>
<title>Quản Lý Bán Hàng</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

 </head>
 <body style="width:100%;margin:0;" >
 
 	<style>

.tbchuan {    border-collapse: collapse;    border-spacing: 0; border:10px }
 .tbchuan th {    background: none repeat scroll 0 0 #E4EBF2;    color: #12537F;    font-weight: bold;}
 .tbchuan th, .tbchuan td {     border: 1px solid #333333;    padding: 5px 3px 5px 5px;}
 .tbchuan  .mautr {    background: none repeat scroll 0 0 #E4EBF2;    color: #12537F;    font-weight: bold;}
 .tbchuan thead th{
  position: -webkit-sticky;
  position: sticky;
   top: -1px;
   border-bottom:1px solid;
   color:#000000;
   background-color:#F8E4CB;
  
}
.tbchuan th:first-child {
  position: -webkit-sticky;
  position: sticky;
  left: 0;
  z-index: 2;
}
.fixed-bottom{
 position: -webkit-sticky;
  position: sticky;
  bottom:0;
}

.fixed-left{
 position: -webkit-sticky;
  position: sticky;
  left:0;
  z-index:1;
}
</style>

<div style="height:90vh;overflow:scroll;width:90%;margin:0 auto">
<table width="auto" border="0" cellpadding="0" cellspacing="0" class="tbchuan">		
		  <thead>
			<tr bgcolor="#F8E4CB">
				<th align="center" height="23" width="30" class="fixed-left"><b>STT</b></th>
				<th width="175" align="center" style="background-color:#009900"><strong>Lương cơ bản</strong></th>
				<th width="175" align="center" style="background-color:#009900"><strong>Số của hàng</strong></th>
				<th width="175" align="center"><strong>Tổng ngày trong tháng
						<?=$thang?>
					</strong></th>
				<th width="175" align="center" style="background-color:#009900"><strong>Số ngày mở cửa</strong></th>
				<th width="175" align="center" style="background-color:#009900"><strong>Lương trách nhiệm chuẩn</strong></th>
				<th width="175" align="center"><strong>Lương trách nhiệm miền</strong></th>
				<th width="175" align="center" style="background-color:#009900"><strong>Hệ số doanh thu miền</strong></th>
				<th width="175" align="center"><strong>Lương doanh thu Miền</strong></th>
				<th width="175" align="center" style="background-color:#009900"><strong>Hàng hóa (%)</strong></th>
				<th width="175" align="center" style="background-color:#009900"><strong>Nhân sự và đào tạo(%)</strong></th>
				<th width="175" align="center" style="background-color:#009900"><strong>Doanh thu mỗi cửa hàng (%)</strong></th>
				<th width="175" align="center" style="background-color:#009900"><strong>Dịch vụ (%)</strong></th>
				<th width="82" align="center" style="background-color:#009900"><strong> Mức KPI</strong> </th>
				<th width="171" align="center" style="background-color:#009900"><strong>Lương KPI</strong></th>
				<th width="200" align="center" style="background-color:#009900"><strong>Doanh thu đề xuất</strong></th>
				<th width="200" align="center" style="background-color:#009900"><strong>CPQC đề xuất</strong></th>
				<th width="200" align="center" style="background-color:#009900"><strong>Doanh thu thực</strong></th>
				<th width="200" align="center" style="background-color:#009900"><strong>CPQC thực</strong></th>
				<th width="200" align="center"><strong>Lương KPI thực</strong></th>
				<th width="200" align="center"><strong>Tỉ lệ HTDT (%)</strong></th>
				<th width="200" align="center"><strong>Tỉ lệ CPQC/DT (%)</strong></th>
				<th width="200" align="center"><strong>Tỉ lệ HT KPI</strong></th>
				<th width="200" align="center"><strong>Lương chỉ tiêu</strong></th>
				<th width="200" align="center" style="background-color:#009900"><strong>Chức danh</strong></th>
				<th width="200" align="center"><strong>Hệ số thưởng</strong></th>
				<th width="200" align="center"><strong>Ngân sách tiết kiệm được</strong></th>
				<th width="200" align="center" style="background-color:#009900"><strong>SL trưởng phòng</strong></th>
				<th width="200" align="center" style="background-color:#009900"><strong>SL trưởng nhóm</strong></th>
				<th width="200" align="center" style="background-color:#009900"><strong>SL chuyên viên</strong></th>
				<th width="200" align="center"><strong>Tổng nhân viên</strong></th>
				<th width="200" align="center" style="background-color:#009900"><strong>SL nhân viên sale chính</strong></th>
				<th width="200" align="center" style="background-color:#009900"><strong>SL nhân viên sale thử việc</strong></th>
				<th width="200" align="center"><strong>Tổng nhân viên sale</strong></th>
				<th width="200" align="center"><strong>Hệ số quy đổi</strong></th>
				<th width="200" align="center"><strong>Thưởng</strong></th>
				<th width="200" align="center"><strong>Lương</strong></th>
			</tr>
		</thead>
	 <tbody>
	 <tr>
	 <td>1</td>
		 <td <?=number_format($luongcoban)?></td>
		 <td ><?=$socuahang?></td>
	 	<td><?=cal_days_in_month(CAL_GREGORIAN,$thang,$nam)?></td>
		 <td > <?=$songaymocua?></td>
		 <td> <?=number_format($luongtrachnhiemchuan)?></td>
		  <td>dsdsds</td>
		  <td><?=$hanghoa?></td>
		  <td><?=$nhansuvadaotao?></td>
		  <td><?=$doanhthumoicuahang?></td>
		 <td><?=$dichvu?></td>
		 <td><?=$luongKPIdoichieu?></td>
		   <td><?=$luongkpi?></td>
		  <td><?=$doanhthudexuat?></td>
		  <td><?=$chiphiquangcaodexuat?></td>
		  <td><?=$doanhthuthuc?></td>
		 <td><?=$chiphiquangcaothuc?></td>
		 <td>dsdsd</td>
		  <td>dsdsd</td>
		  <td>dsdsd</td>
		  <td>dsdsd</td>
		 <td>dsdsd</td>
		 <td>dsdsd</td>
		  <td>dsdsd</td>
		  <td>dsdsd</td>
		   <td>dsdsd</td>
		 <td>dsdsd</td>
		 <td>dsdsd</td>
		  <td>dsdsd</td>
		  <td>dsdsd</td>
		   <td>dsdsd</td>
		 <td>dsdsd</td>
		 <td>dsdsd</td>
		  <td>dsdsd</td>
		  <td>dsdsd</td>
		   <td>dsdsd</td>
		  <td>dsdsd</td>
	</tr>
	 
	 
	  <tr  class="fixed-bottom"><th colspan="4">  Tổng</th><th colspan="2">1234556</th></tr>
</tbody>
</table>
</div>	 
 </body>
 </html>