<?php

function luongQuanLyVungMien($luongcoban,$luongtrachnhiem,$luongkpi,$luongdoanhthu){

	$luong=$luongcoban+$luongtrachnhiem+$luongdanhthumien+$luongkpi;
	return $luong;
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
function luongCHTCHP($luongcoban,$luongkpi,$luongdoanhthu){
	
	$luong=$luongcoban+$luongdoanhthu+$luongkpi;
	return $luong;

}

//lương tổ trưởng
function luongToTruong($luongcoban,$doanhthucanhan,$luongtrachnhiem){

	$luong=$luongcoban+$luongtrachnhiem+$luongdoanhthu;
	return $luong;
}	


//lương chuyen viên thu ngân
function luongCVTN($luongcoban,$luongdoanhthu){

	$luong=$luongcoban+$luongdoanhthu;
	return luong;
}


//lương chuyên vien tư vấn
function luongCVTV($luongcoban,$luongdoanhthu){

	$luong=$luongcoban+$luongdoanhthu;
	return luong;
}	


//lương tiếp đón khách hàng
function luongTDKH($luongcoban,$luongdoanhthu,$luongkpi){

	$luong=$luongcoban+$luongdoanhthu+$luongkpi;
	return $luong;
}	

//lương văn phòng
function luongVP($luongcoban,$luongkpi,$luongdoanhthu){

	
	$luong=$luongcoban+luongdoanhthu+$luongkpi;
	return $luong;
}

// ASM
function luongASM($luongcoban,$luongchitieu){
	
	$luong=$luongcoban+$luongchitieu;
	return $luong;
}

// trưởng phòng sale
function luongtruongphongsale($luongcoban,$luongchitieu,$luongdtcntb){
	
	$luong=$luongcoban+$luongchitieu+$luongdtcntb;
	return $luong;
}


//lương chuyên viên sale online
function luongCVSaleOnline($luongcoban,$luongdoanhthu){

	
	$luong=$luongcoban+$luongdoanhthu;
	return $luong;
}




//photeam online
function luongtruongphoteamonline($luongcoban,$luongchitieu,$luongdtcntb){
		
	$luong=$luongcoban+$luongchitieu+$luongdtcntb;
	return $luong;
}


// chuyên viên content
function luongchuyenviencontent($luongcoban,$luongdoanhthu){
	
	$luong=$luongcoban+$luongdoanhthu;
	return $luong;
}


// trưởng phòng tmdt
function luongtruongphongtmdt($luongcoban,$luongchitieu){
	
	
	$luong=$luongcoban+$luongchitieu;
	return $luong;
}



// chuyên viên tmdt
function luongchuyenvientmdt($luongcoban,$luongchitieu){
	
	$luong=$luongcoban+$luongchitieu;
	return $luong;
}



// trưởng phòng quảng cáo
function luongtruongphongquangcao($luongcoban,$luongchitieu,$ngansachtk,$hesothuong){
	

	$luong=$luongcoban+$luongchitieu+$luongtrachnhiemt+($ngansachtk/$hesothuong);
	//var_dump($mucluongchitieu);
		
	return $luong;
}
// trưởng nhóm quảng cáo
function luongtruongnhomquangcao($luongcoban,$luongdoanhthu,$luongchiphidt,$luongtrachnhiem,$ngansachtk,$hesothuong){
	

	$luong=$luongcoban+$luongdoanhthu+$luongchiphidt+($ngansachtk/$hesothuong);
	//var_dump($mucluongchitieu);
		
	return $luong;
}

// trưởng nhóm quảng cáo
function luongcvquangcao($luongcoban,$luongdoanhthu,$luongchiphidt,$luongtrachnhiem,$ngansachtk,$hesothuong){
	

	$luong=$luongcoban+$luongdoanhthu+$luongchiphidt+($ngansachtk/$hesothuong);
	//var_dump($mucluongchitieu);
		
	return $luong;
}
//lương trưởng phòng livestream
function luongtruongphonglivestream($luongcoban,$luongdoanhthu,$luongkpi){
	
	$luong=$luongcoban+$luongdoanhthu+$luongkpi;
	//var_dump($mucluongchitieu);
		
	return $luong;
}




//hoc  việc quan lý miền


function luongphut($luongcanban){
	$phutluong=$luongcanban/26/8/60;
	return $phutluong;
}

?>
