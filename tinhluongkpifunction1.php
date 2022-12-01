<?php

function luongQuanLyVungMien($luongcoban,$socuahang,$doanhthumuctieu,$doanhthutatcacuahang,$songaymocua,$luongtrachnhiemchuan,$hanghoa,$nhansudaotao,$doanhthumoicuahang,$dichvu,$luongkpimien,$thang,$nam){
//phần trăm doanh thu
	$phantramDT=phantramdoanhthu($doanhthumuctieu,$doanhthutatcacuahang);
	//số ngày trong tháng
	$tongngaythang=cal_days_in_month(CAL_GREGORIAN,$thang,$nam);
	//lương trách nhiệm miền
	$luongtrachnhiem=(($luongtrachnhiemchuan/$tongngaythang)*$songaymocua*$phantramDT)*$socuahang;
	
	//hệ số lương
	$hesoluong=hesoluongdoanhthumien($phantramDT);
	
	//lương doanh thu miền.
	$luongdanhthumien=$hesoluong*$doanhthutatcacuahang;
	//lương kpi miên thực
	$luongkpimienthuc=$luongkpimien*($hanghoa+$nhansudaotao+$doanhthumoicuahang+$dichvu)/100;
	//echo number_format($luongkpimien)."<br>";
	$luong=$luongcoban+$luongtrachnhiem+$luongdanhthumien+$luongkpimienthuc;
	return array("luong"=>$luong,"phantramdt"=>$phantramDT,"tongngaythang"=>$tongngaythang,"luongtrachnhiem"=>$luongtrachnhiem,"hesoluong"=>$hesoluong,"luongdoanhthumien"=>$luongdanhthumien);
}

//heso doanh thu miên
function hesoluongdoanhthumien($phantramDT){
	$phantramDT=$phantramDT*100;
	if($phantramDT<80){
		return 0;
	}
	else if($phantramDT<99){ 
		return 0.06;
	}
	else if($phantramDT<100){
		return 0.08;
	}
	else if($phantramDT==100){
		return 0.1;
	}
	else if($phantramDT>=200){
		return 0.15;
	}
	else{
		return 0;
	}

}
//phantram doanhthu

function phantramdoanhthu($doanhthudexuat,$doanhthuthuc){
	return $doanhthuthuc/$doanhthudexuat;
}


//lương của hàng trưởng cửa hàng phó
function luongCHTCHP($luongcoban,$doanhthudoichieu,$doanhthumuctieu,$doanhthuthuc,$doanhthudat,$giatricotloi,$cocuahangpho,$luongkpichuan,$loai=1){
	//phần trăm doanh thu
		$phantramDT=$doanhthudat+$giatricotloi;
	//hệ số doanh thu
		$hesodt=$doanhthuthuc>=$doanhthumuctieu?0.3:0.2;
		
		//var_dump($hesodt);
	if($loai==1){
		//kiểm tra có cưa hàng phó ko
		$checkchpho=$cocuahangpho?0.7:1;
		//lương doanh thu
		$luongdoanhthu=($hesodt/100)*$doanhthuthuc*$checkchpho;
		//lương kpi thuc
		//sô doanh thu dối chiếu để tăng luong kpi =500,000,000
		//tien tăng theo = 500,000
		
		if($doanhthuthuc<=$doanhthudoichieu){
			$luongkpithuc=$luongkpichuan;
		}
		else{
			$luongkpithuc=floor(($doanhthuthuc-$doanhthudoichieu)/500000000)*500000+$luongkpichuan;
		}
		
		
		
	}
	else{
		//kiểm tra có cưa hàng phó ko
		$checkchpho=$cocuahangpho?0.3:1;
		//lương doanh thu
		$luongdoanhthu=($hesodt/100)*$doanhthuthuc*$checkchpho;
		$luongkpithuc=$luongkpichuan;
	}
	
	$luong=$luongcoban+$luongdoanhthu+$luongkpithuc;
	return array("luong"=>$luong,"luongdoanhthu"=>$luongdoanhthu,"luongkpithuc"=>$luongkpithuc,"phantramdt"=>$phantramDT,"hesodt"=>$hesodt);

}

//lương tổ trưởng
function luongToTruong($luongcoban,$doanhthucanhan,$luongtrachnhiem){

	if($doanhthucanhan<100000000){
		$heso=0;
	}
	else if($doanhthucanhan<165000000){
		$heso=1;
	}
	else if($doanhthucanhan<200000000){
		$heso=1.3;
	}
	else{
		$heso=1.7;
	}
	
	$luongdoanhthu=$doanhthucanhan*($heso/100);
	
	$luong=$luongcoban+$luongtrachnhiem+$luongdoanhthu;
	return $luong;
}	


//lương chuyen viên thu ngân
function luongCVTN($luongcoban,$doanhthucalamviec,$hesodoanhthu,$doanhthucanhan){

	if($doanhthucanhan<100000000){
		$heso=0;
	}
	else if($doanhthucanhan<165000000){
		$heso=1;
	}
	else if($doanhthucanhan<200000000){
		$heso=1.3;
	}
	else{
		$heso=1.7;
	}
	
	$luongdoanhthu=($doanhthucalamviec*($hesodoanhthu/100))+($doanhthucanhan*($heso/100));
	
	$luong=$luongcoban+$luongdoanhthu;
	return array("luong"=>$luong,"luongdoanhthu"=>$luongdoanhthu,"heso"=>$heso);
}


//lương chuyên vien tư vấn
function luongCVTV($luongcoban,$doanhthucanhan){

	if($doanhthucanhan<100000000){
		$heso=0;
	}
	else if($doanhthucanhan<165000000){
		$heso=1;
	}
	else if($doanhthucanhan<200000000){
		$heso=1.3;
	}
	else{
		$heso=1.7;
	}
	
	$luongdoanhthu=$doanhthucanhan*($heso/100);

	$luong=$luongcoban+$luongdoanhthu;
	return array("luong"=>$luong,"luongdoanhthu"=>$luongdoanhthu,"heso"=>$heso);
}	


//lương tiếp đón khách hàng
function luongTDKH($luongcoban,$doanhthucalamviec,$hesodoanhthu,$luongkpi){

	
	$luongdoanhthu=$doanhthucalamviec*($hesodoanhthu/100);

	$luong=$luongcoban+$luongdoanhthu+$luongkpi;
	return array("luong"=>$luong,"luongdoanhthu"=>$luongdoanhthu);
}	

//lương văn phòng
function luongVP($luongcoban,$luongkpi,$luongkpidoanhthu,$doanhthumuctieu,$doanhthuthuc){

	$tilehoanthanhdoanhthu=($doanhthuthuc/$doanhthumuctieu)*100;
	
	if($tilehoanthanhdoanhthu<80){
		$hesoluongkpidoanhthu=0.5;
	}
	else if($tilehoanthanhdoanhthu<90){
		$hesoluongkpidoanhthu=0.75;
	}else if($tilehoanthanhdoanhthu<100){
		$hesoluongkpidoanhthu=1;
	}else if($tilehoanthanhdoanhthu<110){
		$hesoluongkpidoanhthu=1.25;
	}
	else{
		$hesoluongkpidoanhthu=1.5;
	}
	
	//var_dump($hesoluongkpidoanhthu);
	$luong=$luongcoban+($hesoluongkpidoanhthu*$luongkpi);
	return array("luong"=>$luong,"tilehoanthanhdoanhthu"=>$tilehoanthanhdoanhthu,"hesoluongkpidoanhthu"=>$hesoluongkpidoanhthu);
}

// ASM
function luongASM($luongcoban,$doanhthudoichieu,$luongkpi,$doanhthudexuat,$chiphiquangcao,$doanhthuthuc,$chiphiquangcaothuc){
	if($doanhthuthuc<=$doanhthudoichieu){
		$luongkpithuc=$luongkpi;
	}
	else {
		$luongkpithuc=((floor($doanhthuthuc-$doanhthudoichieu)/1000000000)*2000000)+$luongkpi;
		
	}
	$tilehoanthanhdoanhthu=($doanhthuthuc/$doanhthudexuat)*100;
	$tilechiphiquangcao=($chiphiquangcaothuc/$chiphiquangcao)*100;
	$luongchitieu='';
	$phantramdtdc='';
	$phantramcpdc='';
	if($tilehoanthanhdoanhthu>=50){
		$phantramdtdc=($luongkpithuc*0.5)*($doanhthuthuc/$doanhthudexuat);
		
	}
	else{
		$phantramdtdc=($luongkpithuc*0.5)*0;
	}
	
	if($tilechiphiquangcao<30){
		$phantramcpdc=($luongkpithuc*0.5)*(120/100);
		
	}
	else if($tilechiphiquangcao<=35){
		$phantramcpdc=($luongkpithuc*0.5)*(100/100);
	}
	else{
		$phantramcpdc=($luongkpithuc*0.5)*0;
	}
	//var_dump($tilechiphiquangcao);
	$luongchitieu=$phantramdtdc+$phantramcpdc;
	$luong=$luongcoban+$luongchitieu;
	return array("luong"=>$luong,"luongkpi"=>$luongkpithuc,"luongchitieu"=>$luongchitieu);
}

// trưởng phòng sale
function luongtruongphongsale($luongcoban,$doanhthudoichieu,$luongkpi,$doanhthudexuat,$chiphiquangcao,$doanhthuthuc,$chiphiquangcaothuc,$nvsale,$nvsaletv){
	if($doanhthuthuc<=$doanhthudoichieu){
		$luongkpithuc=$luongkpi;
	}
	else {
		$luongkpithuc=((floor($doanhthuthuc-$doanhthudoichieu)/1000000000)*1000000)+$luongkpi;
		
	}
	$tilehoanthanhdoanhthu=($doanhthuthuc/$doanhthudexuat)*100;
	$tilechiphiquangcao=($chiphiquangcaothuc/$chiphiquangcao)*100;
	$soluongnvsale=$nvsale+($nvsaletv/2);
	$doanhthucanhantrungbinh=$doanhthuthuc/$soluongnvsale;
	$tiledtcn=0;
	if($doanhthucanhantrungbinh<120000000){
		$tiledtcn=0;
	}
	else if($doanhthucanhantrungbinh<150000000){
		$tiledtcn=0.02;
	}
	else if($doanhthucanhantrungbinh<200000000){
		$tiledtcn=0.04;
	}else{
		$tiledtcn=0.06;
	}
	$luongdtcntb=$doanhthuthuc*($tiledtcn/100);

	$luongchitieu='';
	$phantramdtdc='';
	$phantramcpdc='';
	if($tilehoanthanhdoanhthu>=50){
		$phantramdtdc=($luongkpithuc*0.5)*($doanhthuthuc/$doanhthudexuat);
		
	}
	else{
		$phantramdtdc=($luongkpithuc*0.5)*0;
	}
	
	if($tilechiphiquangcao<30){
		$phantramcpdc=($luongkpithuc*0.5)*(120/100);
		
	}
	else if($tilechiphiquangcao<=35){
		$phantramcpdc=($luongkpithuc*0.5)*(100/100);
	}
	else{
		$phantramcpdc=($luongkpithuc*0.5)*0;
	}
	
	$luongchitieu=$phantramdtdc+$phantramcpdc;
	//var_dump($luongkpithuc);
	$luong=$luongcoban+$luongchitieu+$luongdtcntb;
	return array("luong"=>$luong,"luongkpi"=>$luongkpithuc,"luongchitieu"=>$luongchitieu);
}


//lương chuyên viên sale online
function luongCVSaleOnline($luongcoban,$doanhthucanhan,$loai){

	$hesodt='';
	if($loai==1){
		if($doanhthucanhan<100000000){
			$hesodt=0;
		}
		else if($doanhthucanhan<150000000){
			$hesodt=1;
		}
		else if($doanhthucanhan<200000000){
			$hesodt=1.8;
		}
		else if($doanhthucanhan<200000000){
			$hesodt=2;
		}
	}
	else if($loai==2){
		if($doanhthucanhan<70000000){
			$hesodt=0;
		}
		else if($doanhthucanhan<150000000){
			$hesodt=1;
		}
		else if($doanhthucanhan<200000000){
			$hesodt=1.8;
		}
		else if($doanhthucanhan<200000000){
			$hesodt=2;
		}
	}
	
	$luongdoanhthu=$doanhthucanhan*($hesodt/100);
	$luong=$luongcoban+$luongdoanhthu;
	return array("luong"=>$luong,"luongdoanhthu"=>$luongdoanhthu,"hesodt"=>$hesodt);
}

function luongtruongphongSaleSi($luongcoban,$doanhthucanhan,$loai){
	

}


//photeam online
function luongphoteamonline($luongcoban,$doanhthudexuat,$chiphiquangcao,$chiphiquangcaothuc,$doanhthuthuc,$nvsale,$nvsaletv,$cocuahangpho=false){
		if($doanhthuthuc<=$doanhthudoichieu){
		$luongkpithuc=$luongkpi;
	}
	else {
		$luongkpithuc=((floor($doanhthuthuc-$doanhthudoichieu)/1000000000)*1000000)+$luongkpi;
		
	}
	$tilehoanthanhdoanhthu=($doanhthuthuc/$doanhthudexuat)*100;
	$tilechiphiquangcao=($chiphiquangcaothuc/$chiphiquangcao)*100;
	$soluongnvsale=$nvsale+($nvsaletv/2);
	$doanhthucanhantrungbinh=$doanhthuthuc/$soluongnvsale;
	$tiledtcn=0;
	if($doanhthucanhantrungbinh<120000000){
		$tiledtcn=0;
	}
	else if($doanhthucanhantrungbinh<150000000){
		$tiledtcn=0.1;
	}
	else if($doanhthucanhantrungbinh<200000000){
		$tiledtcn=0.12;
	}else{
		$tiledtcn=0.2;
	}
	$luongdtcntb=$doanhthuthuc*($tiledtcn/100);

	$luongchitieu='';
	$phantramdtdc='';
	$phantramcpdc='';
	if($tilehoanthanhdoanhthu<50){
		$phantramdtdc=0;
		
	}
	else if($tilehoanthanhdoanhthu<80){
		$phantramdtdc=0.06;
		
	}
	else if($tilehoanthanhdoanhthu<100){
		$phantramdtdc=0.08;
		
	}
	else if($tilehoanthanhdoanhthu<120){
		$phantramdtdc=0.1;
		
	}
	else {
		$phantramdtdc=0.15;
	}
	
	if($tilechiphiquangcao<30){
		$phantramcpdc=0.15;
		
	}
	else if($tilechiphiquangcao<=35){
		$phantramcpdc=0.1;
	}
	else{
		$phantramcpdc=0;
	}
	$luongchitieu=$doanhthuthuc*(($phantramdtdc+$phantramcpdc)/100);

	if($cocuahangpho){
		$luongchitieu=$luongchitieu*0.3;
		$luongdtcntb=$luongdtcntb*0.3;
	}
	else{
		$luongchitieu=$luongchitieu*0.7;
		$luongdtcntb=$luongdtcntb*0.7;
	}
	
	
	$luong=$luongcoban+$luongchitieu+$luongdtcntb;
	return array("luong"=>$luong,"luongdoanhthu"=>$luongdtcntb,"luongchitieu"=>$luongchitieu);
}


// chuyên viên content
function luongchuyenviencontent($luongcoban,$doanhthudexuat,$doanhthuthuc){
	$tilehoanthanhdoanhthu=($doanhthuthuc/$doanhthudexuat)*100;
	$luongkpi=0;
	if($tilehoanthanhdoanhthu<80){
		$luongkpi=0;
	}
	else if($tilehoanthanhdoanhthu<90){
		$luongkpi=500000;
	}else if($tilehoanthanhdoanhthu<100){
		$luongkpi=1000000;
	}else if($tilehoanthanhdoanhthu<110){
		$luongkpi=1500000;
	}else {
		$luongkpi=2000000;
	}
	
	$luong=$luongcoban+$luongkpi;
	return array("luong"=>$luong,"luongkpi"=>$luongkpi);
}


// trưởng phòng tmdt
function luongtruongphongtmdt($luongcoban,$doanhthudexuat,$doanhthuthuc,$doanhthudoichieu,$luongkpi,$chiphi){
	
	$mucluongchitieu=0;
	$luongkpithuc=0;
	if($doanhthuthuc<=$doanhthudoichieu){
		$luongkpithuc=$luongkpi;
	}
	else{
		$luongkpithuc=(floor(($doanhthuthuc-$doanhthudoichieu)/1000000000)*1000000)+$luongkpi;
	}
	$tilechiphi=($chiphi/$doanhthuthuc)*100;
	$tilehoanthanhdt=($doanhthuthuc/$doanhthudexuat)*100;
	
	
	if($tilehoanthanhdt>50){
			$mucluongchitieu+=($luongkpithuc*0.5)*($tilehoanthanhdt/100);
	}
	
	if($tilechiphi<=38){
		$mucluongchitieu+=($luongkpithuc*0.5)+ ($doanhthuthuc*(38-$tilechiphi)/100);
	}
	
	
	$luong=$luongcoban+$mucluongchitieu;
	return array("luong"=>$luong,"luongkpi"=>$luongkpithuc,"luongchitieu"=>$mucluongchitieu);
}



// chuyên viên tmdt
function luongchuyenvientmdt($luongcoban,$doanhthudexuat,$doanhthuthuc,$doanhthudoichieu,$luongkpi,$chiphi){
	
	$mucluongchitieu=0;
	$luongkpithuc=0;
	if($doanhthuthuc<=$doanhthudoichieu){
		$luongkpithuc=$luongkpi;
	}
	else{
		$luongkpithuc=(floor(($doanhthuthuc-$doanhthudoichieu)/1000000000)*1000000)+$luongkpi;
	}
	$tilechiphi=($chiphi/$doanhthuthuc)*100;
	$tilehoanthanhdt=($doanhthuthuc/$doanhthudexuat)*100;
	$tiletong=0;
	
	if($tilehoanthanhdt>50){
			$tiletong+=$tilehoanthanhdt/100;
	}
	
	if($tilechiphi<30){
		$tiletong+=1.2;
	}
	else if($tilechiphi<=35){
		$tiletong+=1;
	}
	else {
		$tiletong+=0;
	}
	
	$mucluongchitieu=($luongkpithuc*0.5)*$tiletong;
	
	$luong=$luongcoban+$mucluongchitieu;
	return array("luong"=>$luong,"mucluongchitieu"=>$mucluongchitieu);
}



// trưởng phòng quảng cáo
function luongtruongphongquangcao($luongcoban,$doanhthudexuat,$doanhthuthuc,$doanhthudoichieu,$luongkpi,$chiphi,$loaicv,$luongtrachnhiem,$soluongtp,$soluongtn,$soluongnv){
	
	
	$luongkpithuc=0;
	$tilechiphi=($chiphi/$doanhthuthuc)*100;
	$tilehoanthanhdt=($doanhthuthuc/$doanhthudexuat)*100;
	$tiletong=0;
	//trưởng phòng
	if($tilehoanthanhdt>50){
			$tiletong+=$tilehoanthanhdt/100;
	}
	
	if($tilechiphi<30){
		$tiletong+=1.2;
	}
	else if($tilechiphi<=35){
		$tiletong+=1;
	}
	else {
		$tiletong+=0;
	}
	
	//trưởng nhoms
	if($tilehoanthanhdt<80){
		$luongkpithuc=0;
	}
	else if($tilehoanthanhdt<90){
		$luongkpithuc=500000;
	}
	else if($tilehoanthanhdt<100){
		$luongkpithuc=1000000;
	}
	else if($tilehoanthanhdt<110){
		$luongkpithuc=1500000;
	}
	else if($tilehoanthanhdt<120){
		$luongkpithuc=2000000;
	}
	else {
		$luongkpithuc=2500000;
	}
	
	$luongcphi=0;
	
	if($tilechiphi<=35){
		$luongcphi=1000000;
		$ngansachtietkiem=$doanhthuthuc*((35-$tilechiphi)/100)*$ngansachtietkiem/100;
	}
	else {
		$luongcphi=0;
		$ngansachtietkiem=0;
	}
	// thưởng 
	$ngansachtietkiem=0;
	if($tilehoanthanhdt<85){
		$ngansachtietkiem=0;
	}
	else if($tilehoanthanhdt<90){
		$ngansachtietkiem=5;
	}
	else if($tilehoanthanhdt<100){
		$ngansachtietkiem=8;
	}
	else if($tilehoanthanhdt<110){
		$ngansachtietkiem=10;
	}
	else if($tilehoanthanhdt<115){
		$ngansachtietkiem=12;
	}
	else if($tilehoanthanhdt<120){
		$ngansachtietkiem=14;
	}
	else if($tilehoanthanhdt<125){
		$ngansachtietkiem=16;
	}
	else {
			$ngansachtietkiem=20;
	}
	
	if($tilechiphi<35){
		$ngansachtietkiem=$doanhthuthuc*((35-$tilechiphi)/100)*$ngansachtietkiem/100;
	}
	else {
		$ngansachtietkiem=0;
	}
	
	
	//tien thương
	$mucluongchitieu=0;
	$luongtrachnhiemt=0;
	$hesothuong=0;
	if($loaicv==1){
		$hesothuong=1;
		$mucluongchitieu=$luongkpithuc*$tiletong;
	}
	else if($loaicv==2){
		$hesothuong=0.7;
		$luongtrachnhiemt=$luongtrachnhiem;
		$mucluongchitieu=$luongkpithuc+$luongcphi;
	}
	else if($loaicv==3){
		$hesothuong=0.7;
		$mucluongchitieu=$luongkpithuc+$luongcphi;
	}
	$tongnhanvien=$soluongtp+$soluongtn+$soluongnv;

	$luong=$luongcoban+$mucluongchitieu+$luongtrachnhiemt+$luongkpithuc+($thuong/$soluongtp);
	//var_dump($mucluongchitieu);
		
	return array("luong"=>$luong,"mucluongchitieu"=>$mucluongchitieu,"tilehoanthanhdt"=>$tilehoanthanhdt,"luongtrachhiem"=>$luongtrachnhiemt);
}

//lương trưởng phòng livestream
function luongtruongphonglivestream($luongcoban,$doanhthuhethong,$luongkpi){
	$luongdoanhthu=0;
	if($doanhthuhethong<80){
			$luongdoanhthu=1250000;
			
	}
	else if($doanhthuhethong<90){
		$luongdoanhthu=1875000;
	}
	else if($doanhthuhethong<100){
		$luongdoanhthu=2500000;
	}
	else if($doanhthuhethong<110){
		$luongdoanhthu=3125000;
	}
	else{	
		$luongdoanhthu=3750000;
		
	}
	$luong=$luongcoban+$luongdoanhthu+$luongkpi;
	//var_dump($mucluongchitieu);
		
	return array("luong"=>$luong,"luongdoanhthu"=>$luongdoanhthu,"luongkpi"=>$luongkpi);
}




//hoc  việc quan lý miền


function luongphut($luongcanban){
	$phutluong=$luongcanban/26/8/60;
	return $phutluong;
}
function tinhluongtatca($idch,$chucvu){
	if($idch==62){
			
	}
	else{
			switch($idch){
				//khách hàng
				case 2:
				break;
				// quản lý công ty
				case 3:
				break;
				//cưa hàng trưởng
				case 4:
				break;
				//nhân viên thu ngân
				case 5:
				break;
				//kế toán
				case 6:
				break;
				//kiểm kho
				case 7:
				break;
				//nhân viên kho
				case 8:
				break;
				//nhân viên văn phòng
				case 9:
				break;
				//nhân viên bán hàng
				case 10:
				break;
				//nhân viên bảo vệ
				case 11:
				break;
				//nhân viên thời vụ
				case 12:
				break;
				//nhân viên loại khác
				case 13:
				break;
				case 14:
				break;
				case 15:
				break;
				case 16:
				break;
				case 17:
				break;
				default:
				break;
		}
	}
	
}		
?>
