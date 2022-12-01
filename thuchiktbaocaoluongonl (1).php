<?php
session_start();



$root_path = getcwd() . "/";
$quyen = $_SESSION["quyen"];

$ql = $quyen[$_SESSION["mangquyenid"][$_SESSION['act']]];
//$ql='120000';
$idl = $_SESSION["LoginID"];
// var_dump($ql);
//var_dump($_SESSION["mangquyenid"]['baocaokhuyenmai']);
//$ql[5]=5;
if (!($ql[0] || $idl == 1)) {
	return;
}
$wherequyen = '';
if (!$ql[5]) {
	if ($ql[1]) {
		$wherequyen = ' and ( a.phieuxuat is not null and  a.phieuxuat <> "")';
	} else if ($ql[2]) {
		$wherequyen = ' and d.xacnhan=1';
	} else if ($ql[3]) {

		$wherequyen = ' and d.xacnhan=2';
	} else if ($ql[4]) {
		$wherequyen = ' and d.xacnhan=3';
	}
} else {
	$wherequyen = ' ';
}
include($root_path . "includes/config.php");
include($root_path . "includes/removeUnicode.php");
include($root_path . "includes/class.paging.php");
include($root_path . "includes/class.mysql.php");
include($root_path . "includes/function.php");




$data = new class_mysql();
$data->config();
$data->access();

$data1 = $_POST['DATA'];
$tmp = explode('*@!', $data1);

$tu = trim($tmp[0]);
$den = trim($tmp[1]);

$ngayhoanthanhtu = trim($tmp[2]);
$ngayhoanthanhden = trim($tmp[3]);
$IDNV = trim($tmp[4]);
if ($ngayhoanthanhtu != "") {
	$ngay =  explode('/', $ngayhoanthanhtu);
	if (strlen($ngay[1]) == 1) {
		$ngay[1] = "0" . $ngay[1];
	}
	if (strlen($ngay[0]) == 1) {
		$ngay[0] = "0" . $ngay[0];
	}
	
	$hoanthanhtungay_="'$ngay[2]-$ngay[1]-$ngay[0]'";
	
} else {
	$hoanthanhtungay_="'".date("Y-m-d")."'";
	
}

if ($ngayhoanthanhden != "") {
	$ngay =  explode('/', $ngayhoanthanhden);
	if (strlen($ngay[1]) == 1) {
		$ngay[1] = "0" . $ngay[1];
	}
	if (strlen($ngay[0]) == 1) {
		$ngay[0] = "0" . $ngay[0];
	}
	
	$hoanthanhdendenngay_="'$ngay[2]-$ngay[1]-$ngay[0] 23:59:00'";
	
}
else{
	$hoanthanhdendenngay_="'".date("Y-m-d")."'";
	
}

if ($tu != "") {
	$ngay =  explode('/', $tu);
	if (strlen($ngay[1]) == 1) {
		$ngay[1] = "0" . $ngay[1];
		$ngayt = "0" . ($ngay[1]-1);
	}
	else{
		$ngayt = ($ngay[1]-1);
		if (strlen($ngayt) == 1) {
			$ngayt = "0" . $ngayt;
		}
	}
	if (strlen($ngay[0]) == 1) {
		$ngay[0] = "0" . $ngay[0];
	}

	$sql_ton_le  .= " and <='$ngay[2]-$ngay[1]-$ngay[0]'";
	$tungay_="'$ngay[2]-$ngay[1]-$ngay[0]'";
	$tungayt_="'$ngay[2]-$ngayt-$ngay[0]'";
	
} else {
	
	$tungay_="'".date("Y-m-d")."'";
	$dd = date('Y-m-j');
	$newdate = strtotime ( '-1 month' , strtotime ( $dd ) ) ;
	$newdate = date ( 'Y-m-j' , $newdate );
		$tungay_="'".$newdate."'";
	
}

if ($den != "") {
	$ngay =  explode('/', $den);
	if (strlen($ngay[1]) == 1) {
		$ngay[1] = "0" . $ngay[1];
		$ngayt = "0" . ($ngay[1]-1);
	}else{
		$ngayt = ($ngay[1]-1);
		if (strlen($ngayt) == 1) {
			$ngayt = "0" . $ngayt;
		}
	}
	if (strlen($ngay[0]) == 1) {
		$ngay[0] = "0" . $ngay[0];
	}

	$denngay_="'$ngay[2]-$ngay[1]-$ngay[0] 23:59:00'";
	$denngayt_="'$ngay[2]-$ngayt-$ngay[0] 23:59:00'";
	
}
else{
	$denngay_="'".date("Y-m-d")."'";
	$dd = date('Y-m-j');
	$newdate = strtotime ( '-1 month' , strtotime ( $dd ) ) ;
	$newdate = date ( 'Y-m-j' , $newdate );
		$denngayt_="'".$newdate."'";
	
}
$whereNV='';

if($IDNV){
	
		$whereNV=" and ( b.IDTao='$IDNV' or b.diachiN='$IDNV' or b.idchol='$IDNV')";

}

if ($loaiphieu != 13 && $loaiphieu != 14) {
	//(767,766,765,768,689,688,1038,1039)
	$where__="from phieubanhangluu b
		left join vanchuyenonline d on b.ID = d.IDbill 
		left join phieukhuyenmai e on b.NguoiGiao = e.maso 
		 where (b.LyDo>45 and b.lydo not in (53,56,57)) and ((b.Loai in (1,3,5) and b.dakhoa = 1 and idchOL <> -1)   and (b.NgayNhap >= $tungay_ and b.NgayNhap <= $denngay_)) and  (d.dongthoigiantrangthaidon = 1 or b.diachiN=b.idgioithieu) and d.loai<>22  and d.ngayhoanthanh>=$hoanthanhtungay_ and d.ngayhoanthanh<=$hoanthanhdendenngay_
 $whereNV  group by b.IDTao,b.diachiN,b.idchol";
 
 	$where__dondi="from phieubanhangluu b
		left join vanchuyenonline d on b.ID = d.IDbill 
		left join phieukhuyenmai e on b.NguoiGiao = e.maso 
		 where (b.LyDo>45 and b.lydo not in (53,56,57)) and ((b.Loai in (1,3,5) and b.dakhoa = 1  and idchOL <> -1) and d.loai<>22  and (b.NgayNhap >= $tungay_ and b.NgayNhap <= $denngay_))   $whereNV  group by b.IDTao,b.diachiN,b.idchol";

 	//$where2__="inner join phieubanhangluu b on a.soct=b.SoCT left join vanchuyenonline d on b.ID=d.IDbill where b.LyDo>45 and b.Loai = 1 and b.dakhoa = 1  and b.NgayNhap <= '2022-03-31' and b.idchOL = 0 and idchOL <> -1 $whereNV group by b.SoCT) g group by g.IDTao,g.diachiN,g.idchol";
	//$where21__="inner join phieubanhangluu b on a.soct=b.SoCT left join vanchuyenonline d on b.ID=d.IDbill where b.LyDo>45 and b.Loai = 1 and b.dakhoa = 1  and b.NgayNhap <= '2022-03-31' and b.idchOL <> 0 and idchOL <> -1 $whereNV group by b.SoCT) g group by g.IDTao,g.diachiN,g.idchol";
	
	
	
		
	$where1__="from phieubanhangluu b left join vanchuyenonline d on b.ID=d.IDbill where (b.LyDo>45 and b.lydo not in (53,56,57))	and d.loai<>22  and b.Loai =3 and b.dakhoa = 1 and b.NgayNhap >= $tungay_ and b.NgayNhap <= $denngay_  and b.idchOL = 0 and b.idchOL  <>-1  $whereNV  and SUBSTRING_INDEX(SoCT,'TL',1) in (select SoCT from phieubanhangluu where ngaynhap>=$tungay_ and ngaynhap<=$denngay_) group by b.IDTao,b.diachiN,b.idchol";
	$where12__="from phieubanhangluu b left join vanchuyenonline d on b.ID=d.IDbill where (b.LyDo>45 and b.lydo not in (53,56,57)) and d.loai<>22 and b.Loai =3 and b.dakhoa = 1  and b.NgayNhap >= $tungay_ and b.NgayNhap <= $denngay_  and b.idchOL <> 0 and b.idchOL  <>-1 $whereNV and SUBSTRING_INDEX(SoCT,'TL',1) in (select SoCT from phieubanhangluu where ngaynhap>=$tungay_ and ngaynhap<=$denngay_) group by b.IDTao,b.diachiN,b.idchol";
	
	/*$where1__="from phieubanhangluu b left join vanchuyenonline d on b.ID=d.IDbill where b.LyDo>45  and b.Loai in (1,3,5) and b.dakhoa = 1 and b.NgayNhap >= $tungay_ and b.NgayNhap <= $denngay_  and  b.idchOL <> -1 and b.idchOL = 0  and  (d.dongthoigiantrangthaidon = 8 and d.loai=-1)  and (d.ngayhoanthanh>=$hoanthanhtungay_ and d.ngayhoanthanh<=$hoanthanhdendenngay_)  $whereNV group by b.IDTao,b.diachiN,b.idchol,b.SoCT";
	
	$where12__="from phieubanhangluu b left join vanchuyenonline d on b.ID=d.IDbill where b.LyDo>45 and b.Loai in (1,3,5) and b.dakhoa = 1  and b.NgayNhap >= $tungay_ and b.NgayNhap <= $denngay_ and  b.idchOL <> -1 and b.idchOL <> 0 and  (d.dongthoigiantrangthaidon = 8 and d.loai=-1)  and (d.ngayhoanthanh>=$hoanthanhtungay_ and d.ngayhoanthanh<=$hoanthanhdendenngay_) $whereNV  group by b.IDTao,b.diachiN,b.idchol,b.SoCT";*/
	
} else if ($loaiphieu == 13) {
	/*$where__="from phieubanhangluu b
	left join vanchuyenonline d on b.ID = d.IDbill 
	left join phieukhuyenmai e on b.NguoiGiao = e.maso 
	left join lydonhapxuat f on b.lydo = f.ID
 where  b.LyDo>45  and ((b.Loai in (1,3,5) and b.dakhoa = 1  and idchOL <> -1) and (b.NgayNhap >= $tungay_ and b.NgayNhap <= $denngay_)) and (d.dongthoigiantrangthaidon = 1  or  b.diachiN=b.idgioithieu ) and f.ma in ('TT1','TT2','TT3','TT7') and (d.ngayhoanthanh >= $hoanthanhtungay_ and d.ngayhoanthanh <= $hoanthanhdendenngay_) $whereNV    group by b.IDTao,b.diachiN,b.idchol ";
 
$where__dondi="from phieubanhangluu b
		left join vanchuyenonline d on b.ID = d.IDbill 
		left join phieukhuyenmai e on b.NguoiGiao = e.maso 
		 where b.LyDo>45 and (b.Loai =1 and b.dakhoa = 1  and (b.NgayNhap >= $tungay_ and b.NgayNhap <= $denngay_) and (d.ngayhoanthanh >= $hoanthanhtungay_ and d.ngayhoanthanh <= $hoanthanhdendenngay_))  $whereNV  group by b.IDTao,b.diachiN,b.idchol";
	$where2__="left join phieubanhangluu b on a.soct=b.SoCT left join vanchuyenonline d on b.ID=d.IDbill left join lydonhapxuat f on b.lydo = f.ID  where b.LyDo>45  and idchOL <> -1 and b.Loai = 1 and b.dakhoa = 1  and b.NgayNhap <= '2022-03-31' and f.ma in ('TT1','TT2','TT3','TT7') and b.idchOL = 0 $whereNV group by b.SoCT) g group by g.IDTao,g.diachiN,g.idchol";
	
		$where21__="left join phieubanhangluu b on a.soct=b.SoCT left join vanchuyenonline d on b.ID=d.IDbill left join lydonhapxuat f on b.lydo = f.ID  where b.LyDo>45  and idchOL <> -1 and b.Loai = 1 and b.dakhoa = 1  and b.NgayNhap <= '2022-03-31' and b.idchOL <> 0 and f.ma in ('TT1','TT2','TT3','TT7') $whereNV group by b.SoCT) g group by g.IDTao,g.diachiN,g.idchol";
		
		$where1__="from phieubanhangluu b left join vanchuyenonline d on b.ID=d.IDbill left join lydonhapxuat f on b.lydo = f.ID where b.LyDo>45  and idchOL <> -1 and b.Loai =3 and b.dakhoa = 1  and b.NgayNhap >= $tungay_ and b.NgayNhap <= $denngay_  and b.idchOL = 0 and f.ma in ('TT1','TT2','TT3','TT7') $whereNV  group by b.IDTao,b.diachiN,b.idchol";
		
		$where12__="from phieubanhangluu b left join vanchuyenonline d on b.ID=d.IDbill left join lydonhapxuat f on b.lydo = f.ID where b.LyDo>45 and b.Loai =3  and idchOL <> -1  and b.dakhoa = 1  and b.NgayNhap >= $tungay_ and b.NgayNhap <= $denngay_  and b.idchOL <> 0 and f.ma in ('TT1','TT2','TT3','TT7') $whereNV  group by b.IDTao,b.diachiN,b.idchol";*/
} else if ($loaiphieu == 14) {
/*$where__="from phieubanhangluu b
	left join vanchuyenonline d on b.ID = d.IDbill 
	left join phieukhuyenmai e on b.NguoiGiao = e.maso 
	left join lydonhapxuat f on b.lydo = f.ID
 where  b.LyDo>45   and  ((b.Loai in (1,3,5) and b.dakhoa = 1 and idchOL <> -1) and (b.NgayNhap >= $tungay_ and b.NgayNhap <= $denngay_)) and (d.dongthoigiantrangthaidon = 1 or  b.diachiN=b.idgioithieu ) and f.ma not in ('TT1','TT2','TT3','TT7') and (d.ngayhoanthanh >= $hoanthanhtungay_ and d.ngayhoanthanh <= $hoanthanhdendenngay_)  $whereNV  group by b.IDTao,b.diachiN,b.idchol";
 $where__dondi="from phieubanhangluu b
		left join vanchuyenonline d on b.ID = d.IDbill 
		left join phieukhuyenmai e on b.NguoiGiao = e.maso 
		 where b.LyDo>45 and (b.Loai =1 and b.dakhoa = 1  and (b.NgayNhap >= $tungay_ and b.NgayNhap <= $denngay_))  $whereNV  group by b.IDTao,b.diachiN,b.idchol";
	$where2__="left join phieubanhangluu b on a.soct=b.SoCT left join vanchuyenonline d on b.ID=d.IDbill left join lydonhapxuat f on b.lydo = f.ID  where b.LyDo>45 and b.Loai = 1 and b.dakhoa = 1  and b.NgayNhap <= '2022-03-31' and f.ma in ('TT1','TT2','TT3','TT7') and b.idchOL = 0 $whereNV group by b.SoCT) g group by g.IDTao,g.diachiN,g.idchol";
	
		$where21__="left join phieubanhangluu b on a.soct=b.SoCT left join vanchuyenonline d on b.ID=d.IDbill left join lydonhapxuat f on b.lydo = f.ID where b.LyDo>45  and idchOL <> -1 and b.Loai = 1  and b.dakhoa = 1 and b.NgayNhap <= '2022-03-31' and b.idchOL <> 0 and f.ma in ('TT1','TT2','TT3','TT7') group by b.SoCT)  g group by g.IDTao,g.diachiN,g.idchol";
	
		$where1__="from phieubanhangluu b left join vanchuyenonline d on b.ID=d.IDbill left join lydonhapxuat f on b.lydo = f.ID where b.LyDo>45 and idchOL <> -1 and b.Loai =3 and b.dakhoa = 1  and b.NgayNhap >= $tungay_ and b.NgayNhap <= $denngay_  and b.idchOL = 0 and f.ma in ('TT1','TT2','TT3','TT7') $whereNV group by b.IDTao,b.diachiN,b.idchol";
		
		$where12__="from phieubanhangluu b left join vanchuyenonline d on b.ID=d.IDbill left join lydonhapxuat f on b.lydo = f.ID where b.LyDo>45 and idchOL <> -1 and b.Loai =3 and b.dakhoa = 1  and b.NgayNhap >= $tungay_ and b.NgayNhap <= $denngay_  and b.idchOL <> 0 and f.ma in ('TT1','TT2','TT3','TT7') $whereNV  group by b.IDTao,b.diachiN,b.idchol";*/
		
		
}



$sql="select  b.IDTao,b.diachiN,b.idchol,b.idgioithieu,b.NgayNhap,d.dongthoigiantrangthaidon, d.ngayhoanthanh,
	/*========== Tổng ==========*/
	sum(ceil(b.DonGia*(1-1*b.chietkhau/100))*b.SoLuong) as tongdt,
	sum(b.SoLuong) as tongsl,count(distinct b.id) as sb ,
	/*========== So luong di ==========*/
	sum(case when(b.loai=1) and (b.idchOL = 0 or b.diachiN=b.idgioithieu) 
		 then 1 else 0 end) as soluongdi,
	/*========== Doanh Thu SP < 30K và không đồng giá ==========*/
	sum(case when(b.DonGia between 1 and 29999) 
			and b.IDtao = b.DonGia /*Không đồng giá*/
			and (b.idchOL = 0 or b.diachiN=b.idgioithieu) 
		 then (ceil(b.DonGia*(1-1*b.chietkhau/100))*b.SoLuong) else 0 end) as dtpmduoi30,
	sum(case when(b.DonGia between 1 and 29999) 
			and b.IDtao = b.DonGia /*Không đồng giá*/
			and (b.idchOL = 0 or b.diachiN=b.idgioithieu) 
		 then b.SoLuong else 0 end) as tongsoluongpmduoi30,
	
	sum(case when(b.DonGia between 1 and 29999) 
			and b.IDtao = b.DonGia /*Không đồng giá*/
			and (b.idchOL <> 0 or b.diachiN=b.idgioithieu)  /*DT Pass*/ 
		 then (ceil(b.DonGia*(1-1*b.chietkhau/100))*b.SoLuong) else 0 end) as dtpassduoi30,
	sum(case when(b.DonGia between 1 and 29999) 
			and b.IDtao = b.DonGia /*Không đồng giá*/
			and (b.idchOL <> 0  or b.diachiN=b.idgioithieu)  /*DT Pass*/
		 then b.SoLuong else 0 end) as tongdonpassduoi30,
	
	/*================ Doanh Thu SP >= 30K và < 100K ==================*/
	sum(case when(b.DonGia between 30000 and 99999) 
		and (b.idchOL = 0 or b.diachiN=b.idgioithieu) 
		 then (ceil(b.DonGia*(1-1*b.chietkhau/100))*b.SoLuong) else 0 end) as dtpmtu30den100,
	sum(case when(b.DonGia between 30000 and 99999) 
		and (b.idchOL = 0 or b.diachiN=b.idgioithieu) 
		 then b.SoLuong else 0 end) as tongsoluongpmtu30den100,
	sum(case when(b.DonGia between 30000 and 99999) 
		and (b.idchOL <> 0 or b.diachiN=b.idgioithieu)   /*DT Pass*/ 
		 then (ceil(b.DonGia*(1-1*b.chietkhau/100))*b.SoLuong) else 0 end) as dtpasstu30den100,
	sum(case when(b.DonGia between 30000 and 99999) 
		and (b.idchOL <> 0 or b.diachiN=b.idgioithieu)  /*DT Pass*/
		 then b.SoLuong else 0 end) as tongdonpasstu30den100,
	/*=========== Doanh Thu SP >= 100K và < 180K ================*/
	sum(case when(b.DonGia between 100000 and 179999) 
		and (b.idchOL = 0 or b.diachiN=b.idgioithieu)  
		then (ceil(b.DonGia*(1-1*b.chietkhau/100))*b.SoLuong) else 0 end) as dtpmtu100den180,
	sum(case when(b.DonGia between 100000 and 179999) 
		and (b.idchOL = 0  or b.diachiN=b.idgioithieu) 
		 then b.SoLuong else 0 end) as tongsoluongpmtu100den180,
	sum(case when(b.DonGia between 100000 and 179999) 
		and (b.idchOL <> 0  or b.diachiN=b.idgioithieu)  /*DT Pass*/ 
		then (ceil(b.DonGia*(1-1*b.chietkhau/100))*b.SoLuong) else 0 end) as dtpasstu100den180,
	sum(case when(b.DonGia between 100000 and 179999) 
		and (b.idchOL <> 0 or b.diachiN=b.idgioithieu)   /*DT Pass*/ 
		then b.SoLuong else 0 end) as tongdonpasstu100den180,
	
	/*=========== Doanh Thu SP >= 180K ================*/
	sum(case when(b.DonGia >= 180000) 
		and (b.idchOL = 0 or b.diachiN=b.idgioithieu) 
		 then (ceil(b.DonGia*(1-1*b.chietkhau/100))*b.SoLuong) else 0 end) as dtpmtu180,
	sum(case when(b.DonGia >= 180000) 
		and (b.idchOL = 0 or b.diachiN=b.idgioithieu) 
		 then b.SoLuong else 0 end) as tongsoluongpmtu180,
	
	sum(case when(b.DonGia >= 180000) 
		and (b.idchOL <> 0 or b.diachiN=b.idgioithieu)  /*DT Pass*/ 
		 then (ceil(b.DonGia*(1-1*b.chietkhau/100))*b.SoLuong) else 0 end) as dtpasstu180,
	sum(case when(b.DonGia >= 180000) 
			and (b.idchOL <> 0 or b.diachiN=b.idgioithieu)    /*DT Pass*/ 
		then b.SoLuong else 0 end) as tongdonpasstu180,
	
	/* =============== Sản Phẩm áp dụng CT KM PM =============*/
	sum(case when e.sotien <> 10 and (b.idchOL = 0 or b.diachiN=b.idgioithieu) 
	 then (ceil(b.DonGia*(1-1*b.chietkhau/100))*b.SoLuong) else 0 end) as dtspctkhuyenmai,
	sum(case when e.sotien <> 10 and (b.idchOL = 0 or b.diachiN=b.idgioithieu) 
	 then 1 else 0 end) as tongdonspctkhuyenmai,
	
	/* =============== Sản Phẩm áp dụng CT KM PASS DƠN =============*/
	sum(case when e.sotien <> 10 and (b.idchOL <> 0 or b.diachiN=b.idgioithieu) 
	 then (ceil(b.DonGia*(1-1*b.chietkhau/100))*b.SoLuong) else 0 end) as dtspctkhuyenmaipass,
	sum(case when e.sotien <> 10 and (b.idchOL <> 0 or b.diachiN=b.idgioithieu) 
	 then 1 else 0 end) as tongdonspctkhuyenmaipass
	 $where__ ";

	
	$sqlnhanvien="select a.ID,a.MaNV,a.Ten from userac a left join (select IDNhanvien,SUBSTRING_INDEX(SUBSTRING_INDEX(thongtin,'*',7),'*',-1) as chucvu from nhanviendilam  where ngaytao>=$tungay_ and ngaytao<=$denngay_  group by IDNhanvien,thongtin) b on a.ID=b.IDNhanvien where (a.ChucVu  in (767,766,765,768,689,688,1038,1039,738,763,684,703,773,784,972,1015,1001,1012,1012,1015,973,1038,1068,703,1001,1077,1136,978) or b.chucvu in (767,766,765,768,689,688,1038,1039,738,763,684,703,773,784,972,1015,1001,1012,1012,1015,973,1038,1068,703,1001,1077,1136,978))";

	

	$query=$data->query($sqlnhanvien);
	
	
	$mangnhanvien=[];
	$mangnhanviendaydu=[];
	$mangluongonline=[];
	while($re=$data->fetch_array($query)){
			$mangnhanvien[$re['ID']]=$re['ID'];
			$mangnhanviendaydu[$re['ID']]['MaNV']=$re['MaNV'];
			$mangnhanviendaydu[$re['ID']]['Ten']=$re['Ten'];
	}
	

	$query = $data->query($sql);
		$vongdau=false;
	
	while($re=$data->fetch_array($query)){
	
			/*if(!$vongdau){
					$mangluongonline[$re["IDTao"]]["tongbillhoanpm"]=0;
					$mangluongonline[$re["IDTao"]]["tongbillhoanpass"]=0;
					$mangluongonline[$re["IDTao"]]["duoi30"]["dt"]=0;
					$mangluongonline[$re["IDTao"]]["duoi30"]['sl']=0;
			
					$mangluongonline[$re["IDTao"]]["passduoi30"]['dt']=0;
					$mangluongonline[$re["IDTao"]]["passduoi30"]['sl']=0;
					
					$mangluongonline[$re["IDTao"]]["tu30den100"]['dt']=0;
					$mangluongonline[$re["IDTao"]]["tu30den100"]['sl']=0;
					
					$mangluongonline[$re["IDTao"]]["passtu30den100"]['dt']=0;
					$mangluongonline[$re["IDTao"]]["passtu30den100"]['sl']=0;
					
					$mangluongonline[$re["IDTao"]]["tu100den180"]['dt']=0;
					$mangluongonline[$re["IDTao"]]["tu100den180"]['sl']=0;
					
					$mangluongonline[$re["IDTao"]]["passtu100den180"]['dt']=0;
					$mangluongonline[$re["IDTao"]]["passtu100den180"]['sl']=0;
					
					$mangluongonline[$re["IDTao"]]["tu180"]['dt']=0;
					$mangluongonline[$re["IDTao"]]["tu180"]['sl']=0;
					
					$mangluongonline[$re["IDTao"]]["passtu180"]['dt']=0;
					$mangluongonline[$re["IDTao"]]["passtu180"]['sl']=0;
					
					$mangluongonline[$re["IDTao"]]["khuyenmai"]['dt']=0;
					$mangluongonline[$re["IDTao"]]["khuyenmai"]['sl']=0;
					
					$mangluongonline[$re["IDTao"]]["passkhuyenmai"]['dt']=0;
					$mangluongonline[$re["IDTao"]]["passkhuyenmai"]['sl']=0;
					
					$mangluongonline[$re["IDTao"]]["tongdt"]=0;
					$mangluongonline[$re["IDTao"]]['soluongdi']=0;
					$vongdau=true;
			}*/
		
				if($re["IDTao"]==$mangnhanvien[$re['IDTao']] ){
						
						$mangluongonline[$re["IDTao"]]["duoi30"]["dt"]+=$re["dtpmduoi30"];
						$mangluongonline[$re["IDTao"]]["duoi30"]['sl']+=$re["tongsoluongpmduoi30"];
						
				
				
						$mangluongonline[$re["IDTao"]]["passduoi30"]['dt']+=$re["dtpassduoi30"];
						$mangluongonline[$re["IDTao"]]["passduoi30"]['sl']+=$re["tongdonpassduoi30"];
						
						
						
						$mangluongonline[$re["IDTao"]]["tu30den100"]['dt']+=$re["dtpmtu30den100"];
						$mangluongonline[$re["IDTao"]]["tu30den100"]['sl']+=$re["tongsoluongpmtu30den100"];
						
						
						$mangluongonline[$re["IDTao"]]["passtu30den100"]['dt']+=$re["dtpasstu30den100"];
						$mangluongonline[$re["IDTao"]]["passtu30den100"]['sl']+=$re["tongdonpasstu30den100"];
					
						
						$mangluongonline[$re["IDTao"]]["tu100den180"]['dt']+=$re["dtpmtu100den180"];
						$mangluongonline[$re["IDTao"]]["tu100den180"]['sl']+=$re["tongsoluongpmtu100den180"];
						
						$mangluongonline[$re["IDTao"]]["passtu100den180"]['dt']+=$re["dtpasstu100den180"];
						$mangluongonline[$re["IDTao"]]["passtu100den180"]['sl']+=$re["tongdonpasstu100den180"];
						
						$mangluongonline[$re["IDTao"]]["tu180"]['dt']+=$re["dtpmtu180"];
						$mangluongonline[$re["IDTao"]]["tu180"]['sl']+=$re["tongsoluongpmtu180"];;
						
						$mangluongonline[$re["IDTao"]]["passtu180"]['dt']+=$re["dtpasstu180"];
						$mangluongonline[$re["IDTao"]]["passtu180"]['sl']+=$re["tongdonpasstu180"];
						
						$mangluongonline[$re["IDTao"]]["khuyenmai"]['dt']+=$re["dtspctkhuyenmai"];
						$mangluongonline[$re["IDTao"]]["khuyenmai"]['sl']+=$re["tongdonspctkhuyenmai"];
						
						$mangluongonline[$re["IDTao"]]["passkhuyenmai"]['dt']+=$re["dtspctkhuyenmaipass"];
						$mangluongonline[$re["IDTao"]]["passkhuyenmai"]['sl']+=$re["tongdonspctkhuyenmaipass"];
							$mangluongonline[$re["IDTao"]]["soluongtc"]+=$re["tongsoluongpmduoi30"];
							$mangluongonline[$re["IDTao"]]["soluongtc"]+=$re["tongdonpassduoi30"];
							$mangluongonline[$re["IDTao"]]["soluongtc"]+=$re["tongsoluongpmtu30den100"];
							$mangluongonline[$re["IDTao"]]["soluongtc"]+=$re["tongdonpasstu30den100"];
							$mangluongonline[$re["IDTao"]]["soluongtc"]+=$re["tongsoluongpmtu100den180"];
							$mangluongonline[$re["IDTao"]]["soluongtc"]+=$re["tongdonpasstu100den180"];
							$mangluongonline[$re["IDTao"]]["soluongtc"]+=$re["tongsoluongpmtu180"];
							$mangluongonline[$re["IDTao"]]["soluongtc"]+=$re["tongdonpasstu180"];
							$mangluongonline[$re["IDTao"]]["soluongtc"]+=$re["tongdonspctkhuyenmai"];
							$mangluongonline[$re["IDTao"]]["soluongtc"]+=$re["tongdonspctkhuyenmaipass"];
							
						$mangluongonline[$re["IDTao"]]["tongdt"]+=$re["tongdt"];
						$mangluongonline[$re["IDTao"]]["soluongdi"]+=$re["sb"];
						
				}else if($re["idchol"]==$mangnhanvien[$re['idchol']]){
						
						$mangluongonline[$re["idchol"]]["duoi30"]["dt"]+=$re["dtpmduoi30"];
						$mangluongonline[$re["idchol"]]["duoi30"]['sl']+=$re["tongsoluongpmduoi30"];
				
						$mangluongonline[$re["idchol"]]["passduoi30"]['dt']+=$re["dtpassduoi30"];
						$mangluongonline[$re["idchol"]]["passduoi30"]['sl']+=$re["tongdonpassduoi30"];
						
						$mangluongonline[$re["idchol"]]["tu30den100"]['dt']+=$re["dtpmtu30den100"];
						$mangluongonline[$re["idchol"]]["tu30den100"]['sl']+=$re["tongsoluongpmtu30den100"];
						
						$mangluongonline[$re["idchol"]]["passtu30den100"]['dt']+=$re["dtpasstu30den100"];
						$mangluongonline[$re["idchol"]]["passtu30den100"]['sl']+=$re["tongdonpasstu30den100"];
						
						$mangluongonline[$re["idchol"]]["tu100den180"]['dt']+=$re["dtpmtu100den180"];
						$mangluongonline[$re["idchol"]]["tu100den180"]['sl']+=$re["tongsoluongpmtu100den180"];
						
						$mangluongonline[$re["idchol"]]["passtu100den180"]['dt']+=$re["dtpasstu100den180"];
						$mangluongonline[$re["idchol"]]["passtu100den180"]['sl']+=$re["tongdonpasstu100den180"];
						
						$mangluongonline[$re["idchol"]]["tu180"]['dt']+=$re["dtpmtu180"];
						$mangluongonline[$re["idchol"]]["tu180"]['sl']+=$re["tongsoluongpmtu180"];;
						
						$mangluongonline[$re["idchol"]]["passtu180"]['dt']+=$re["dtpasstu180"];
						$mangluongonline[$re["idchol"]]["passtu180"]['sl']+=$re["tongdonpasstu180"];
						
						$mangluongonline[$re["idchol"]]["khuyenmai"]['dt']+=$re["dtspctkhuyenmai"];
						$mangluongonline[$re["idchol"]]["khuyenmai"]['sl']+=$re["tongdonspctkhuyenmai"];
						
						$mangluongonline[$re["idchol"]]["passkhuyenmai"]['dt']+=$re["dtspctkhuyenmaipass"];
						$mangluongonline[$re["idchol"]]["passkhuyenmai"]['sl']+=$re["tongdonspctkhuyenmaipass"];
						$mangluongonline[$re["idchol"]]["soluongdi"]+=$re["sb"];
							$mangluongonline[$re["idchol"]]["tongdt"]+=$re["tongdt"];
							
							
							$mangluongonline[$re["idchol"]]["soluongtc"]+=$re["tongsoluongpmduoi30"];
							$mangluongonline[$re["idchol"]]["soluongtc"]+=$re["tongdonpassduoi30"];
							$mangluongonline[$re["idchol"]]["soluongtc"]+=$re["tongsoluongpmtu30den100"];
							$mangluongonline[$re["idchol"]]["soluongtc"]+=$re["tongdonpasstu30den100"];
							$mangluongonline[$re["idchol"]]["soluongtc"]+=$re["tongsoluongpmtu100den180"];
							$mangluongonline[$re["idchol"]]["soluongtc"]+=$re["tongdonpasstu100den180"];
							$mangluongonline[$re["idchol"]]["soluongtc"]+=$re["tongsoluongpmtu180"];
							$mangluongonline[$re["idchol"]]["soluongtc"]+=$re["tongdonpasstu180"];
							$mangluongonline[$re["idchol"]]["soluongtc"]+=$re["tongdonspctkhuyenmai"];
							$mangluongonline[$re["idchol"]]["soluongtc"]+=$re["tongdonspctkhuyenmaipass"];
				}else if($re["diachiN"]==$mangnhanvien[$re['diachiN']]){
						
						$mangluongonline[$re["diachiN"]]["duoi30"]["dt"]+=$re["dtpmduoi30"];
						$mangluongonline[$re["diachiN"]]["duoi30"]['sl']+=$re["tongsoluongpmduoi30"];
				
						$mangluongonline[$re["diachiN"]]["passduoi30"]['dt']+=$re["dtpassduoi30"];
						$mangluongonline[$re["diachiN"]]["passduoi30"]['sl']+=$re["tongdonpassduoi30"];
						
						$mangluongonline[$re["diachiN"]]["tu30den100"]['dt']+=$re["dtpmtu30den100"];
						$mangluongonline[$re["diachiN"]]["tu30den100"]['sl']+=$re["tongsoluongpmtu30den100"];
						
						$mangluongonline[$re["diachiN"]]["passtu30den100"]['dt']+=$re["dtpasstu30den100"];
						$mangluongonline[$re["diachiN"]]["passtu30den100"]['sl']+=$re["tongdonpasstu30den100"];
						
						$mangluongonline[$re["diachiN"]]["tu100den180"]['dt']+=$re["dtpmtu100den180"];
						$mangluongonline[$re["diachiN"]]["tu100den180"]['sl']+=$re["tongsoluongpmtu100den180"];
						
						$mangluongonline[$re["diachiN"]]["passtu100den180"]['dt']+=$re["dtpasstu100den180"];
						$mangluongonline[$re["diachiN"]]["passtu100den180"]['sl']+=$re["tongdonpasstu100den180"];
						
						$mangluongonline[$re["diachiN"]]["tu180"]['dt']+=$re["dtpmtu180"];
						$mangluongonline[$re["diachiN"]]["tu180"]['sl']+=$re["tongsoluongpmtu180"];;
						
						$mangluongonline[$re["diachiN"]]["passtu180"]['dt']+=$re["dtpasstu180"];
						$mangluongonline[$re["diachiN"]]["passtu180"]['sl']+=$re["tongdonpasstu180"];
						
						$mangluongonline[$re["diachiN"]]["khuyenmai"]['dt']+=$re["dtspctkhuyenmai"];
						$mangluongonline[$re["diachiN"]]["khuyenmai"]['sl']+=$re["tongdonspctkhuyenmai"];
						
						$mangluongonline[$re["diachiN"]]["passkhuyenmai"]['dt']+=$re["dtspctkhuyenmaipass"];
						$mangluongonline[$re["diachiN"]]["passkhuyenmai"]['sl']+=$re["tongdonspctkhuyenmaipass"];						
						$mangluongonline[$re["diachiN"]]["soluongdi"]+=$re["sb"];
							$mangluongonline[$re["diachiN"]]["tongdt"]+=$re["tongdt"];
							
							$mangluongonline[$re["diachiN"]]["soluongtc"]+=$re["tongsoluongpmduoi30"];
							$mangluongonline[$re["diachiN"]]["soluongtc"]+=$re["tongdonpassduoi30"];
							$mangluongonline[$re["diachiN"]]["soluongtc"]+=$re["tongsoluongpmtu30den100"];
							$mangluongonline[$re["diachiN"]]["soluongtc"]+=$re["tongdonpasstu30den100"];
							$mangluongonline[$re["diachiN"]]["soluongtc"]+=$re["tongsoluongpmtu100den180"];
							$mangluongonline[$re["diachiN"]]["soluongtc"]+=$re["tongdonpasstu100den180"];
							$mangluongonline[$re["diachiN"]]["soluongtc"]+=$re["tongsoluongpmtu180"];
							$mangluongonline[$re["diachiN"]]["soluongtc"]+=$re["tongdonpasstu180"];
							$mangluongonline[$re["diachiN"]]["soluongtc"]+=$re["tongdonspctkhuyenmai"];
							$mangluongonline[$re["diachiN"]]["soluongtc"]+=$re["tongdonspctkhuyenmaipass"];
				}
		
	}
	
	
	//$sql2="select count(g.tongdon) as donhoanvepm,sum(g.sl) as slhoanveppm,sum(g.doanhthu) as doanhthuhoanvepm,g.idtao,g.diachin,g.idchol from (select count(b.SoCT) as tongdon,sum(abs(b.SoLuong)) as sl,sum(ceil(b.DonGia*(1-1*b.chietkhau/100))*abs(b.SoLuong)) as doanhthu ,b.IDTao as idtao,b.diachiN as diachin,b.idchol as idchol from (select distinct replace(SoCT,'TL','') as soct, soct as sobill, NgayNhap from phieubanhangluu where loai=3 and NgayNhap >= $tungay_ and NgayNhap <= $denngay_ ) a $where2__";


$sql2="select sum(b.SoLuong) as slhoanveppm ,count(distinct b.SoCT) as donhoanvepm,sum(ceil(b.DonGia*(1-1*b.chietkhau/100))*b.SoLuong) as doanhthuhoanvepm,b.IDTao,b.diachiN,b.idchol,b.idgioithieu from phieubanhangluu b left join vanchuyenonline d on b.ID=d.IDbill where (b.LyDo>45 and b.lydo not in (53,56,57)) and d.loai<>22 and b.Loai =3 and b.dakhoa = 1 and b.idchOL = 0 and idchOL <> -1 and b.NgayNhap <= '2022-03-31 23:59:00'  $whereNV and SUBSTRING_INDEX(SoCT,'TL',1) in (select SoCT from phieubanhangluu where ngaynhap>=$tungay_ and ngaynhap<=$denngay_) group by b.IDTao,b.diachiN,b.idchol";

	 $query2 = $data->query($sql2);
		$mangdthoanvethangtruoc=[];	
	
	$vongdau=false;
	while($re=$data->fetch_array($query2)){
	
				if($re["IDTao"]==$mangnhanvien[$re['IDTao']] ){
					$mangdthoanvethangtruoc[$re["IDTao"]]["donhoanvepm"]+=$re["donhoanvepm"];
					$mangdthoanvethangtruoc[$re["IDTao"]]["slhoanveppm"]+=$re["slhoanveppm"];
					$mangdthoanvethangtruoc[$re["IDTao"]]["doanhthuhoanvepm"]+=$re["doanhthuhoanvepm"];
				} else if($re["idchol"]==$mangnhanvien[$re['idchol']]){
					
					$mangdthoanvethangtruoc[$re["idchol"]]["donhoanvepm"]+=$re["donhoanvepm"];
					$mangdthoanvethangtruoc[$re["idchol"]]["slhoanveppm"]+=$re["slhoanveppm"];
					$mangdthoanvethangtruoc[$re["idchol"]]["doanhthuhoanvepm"]+=$re["doanhthuhoanvepm"];
				}else if($re["diachiN"]==$mangnhanvien[$re['diachiN']]){
					
					$mangdthoanvethangtruoc[$re["diachiN"]]["donhoanvepm"]+=$re["donhoanvepm"];
					$mangdthoanvethangtruoc[$re["diachiN"]]["slhoanveppm"]+=$re["slhoanveppm"];
					$mangdthoanvethangtruoc[$re["diachiN"]]["doanhthuhoanvepm"]+=$re["doanhthuhoanvepm"];
				}
		
		
	}
	
	/*$sql21="select count(g.tongdon) as donhoanvepm,sum(g.sl) as slhoanveppm,sum(g.doanhthu) as doanhthuhoanvepm,g.idtao,g.diachin,g.idchol from (select count(b.SoCT) as tongdon,sum(abs(b.SoLuong)) as sl,sum(ceil(b.DonGia*(1-1*b.chietkhau/100))*abs(b.SoLuong)) as doanhthu ,b.IDTao as idtao,b.diachiN as diachin,b.idchol as idchol from (select distinct replace(SoCT,'TL','') as soct, soct as sobill, NgayNhap from phieubanhangluu where loai=3 and NgayNhap >= $tungay_ and NgayNhap <= $denngay_ ) a $where21__";*/


$sql21="select sum(b.SoLuong) as slhoanveppm ,count(distinct b.SoCT) as donhoanvepm,sum(ceil(b.DonGia*(1-1*b.chietkhau/100))*b.SoLuong) as doanhthuhoanvepm,b.IDTao,b.diachiN,b.idchol,b.idgioithieu from phieubanhangluu b left join vanchuyenonline d on b.ID=d.IDbill where (b.LyDo>45 and b.lydo not in (53,56,57)) and d.loai<>22 and b.Loai =3 and b.dakhoa = 1 and b.idchOL <> 0 and idchOL <> -1 and b.NgayNhap <= '2022-03-31 23:59:00'  $whereNV  and SUBSTRING_INDEX(SoCT,'TL',1) in (select SoCT from phieubanhangluu where ngaynhap>=$tungay_ and ngaynhap<=$denngay_) group by b.IDTao,b.diachiN,b.idchol";

	 $query21 = $data->query($sql21);
		$mangdthoanvethangtruocpass=[];
	
	$vongdau=false;
	while($re=$data->fetch_array($query21)){
	
		
				if($re["IDTao"]==$mangnhanvien[$re['IDTao']] ){
					$mangdthoanvethangtruocpass[$re["IDTao"]]["donhoanvepm"]+=$re["donhoanvepm"];
					$mangdthoanvethangtruocpass[$re["IDTao"]]["slhoanveppm"]+=$re["slhoanveppm"];
					$mangdthoanvethangtruocpass[$re["IDTao"]]["doanhthuhoanvepm"]+=$re["doanhthuhoanvepm"];
				}else if($re["idchOL"]==$mangnhanvien[$re['idchOL']]){
					
					$mangdthoanvethangtruocpass[$re["idchOL"]]["donhoanvepm"]+=$re["donhoanvepm"];
					$mangdthoanvethangtruocpass[$re["idchOL"]]["slhoanveppm"]+=$re["slhoanveppm"];
					$mangdthoanvethangtruocpass[$re["idchOL"]]["doanhthuhoanvepm"]+=$re["doanhthuhoanvepm"];
				}else if($re["idchOL"]==$mangnhanvien[$re['idchOL']]){
					
					$mangdthoanvethangtruocpass[$re["idchOL"]]["donhoanvepm"]+=$re["donhoanvepm"];
					$mangdthoanvethangtruocpass[$re["idchOL"]]["slhoanveppm"]+=$re["slhoanveppm"];
					$mangdthoanvethangtruocpass[$re["idchOL"]]["doanhthuhoanvepm"]+=$re["doanhthuhoanvepm"];
				}
		
		
	}
	
		$sql1="select sum(b.SoLuong) as slhoanveppm ,count(distinct b.SoCT) as donhoanvepm,sum(ceil(b.DonGia*(1-1*b.chietkhau/100))*b.SoLuong) as doanhthuhoanvepm,b.IDTao,b.diachiN,b.idchol,b.idgioithieu $where1__";
	
	
		/*$sql1="select sum(abs(b.SoLuong)) as slhoanveppm ,count(distinct b.SoCT) as donhoanvepm,sum(ceil(b.DonGia*(1-1*b.chietkhau/100))*abs(b.SoLuong)) as doanhthuhoanvepm,b.IDTao,b.diachiN,b.idchol,b.idgioithieu $where1__";*/
	//echo "$sql1$sql1$sql1$sql1 ".$sql1;
	$query1 = $data->query($sql1);
		$mangdthoanvetrongthang=[];
	
	$vongdau=false;
	while($re=$data->fetch_array($query1)){
	
			/*if(!$vongdau){
					
					$mangdthoanvetrongthang[$re["IDTao"]]["donhoanvepm"]=0;
					
					$mangdthoanvetrongthang[$re["IDTao"]]["slhoanveppm"]=0;
					
					$mangdthoanvetrongthang[$re["IDTao"]]["doanhthuhoanvepm"]=0;
					
					$vongdau=true;
			}
		*/
				if($re["IDTao"]==$mangnhanvien[$re['IDTao']] ){
					$mangdthoanvetrongthang[$re["IDTao"]]["donhoanvepm"]+=$re["donhoanvepm"];
					$mangdthoanvetrongthang[$re["IDTao"]]["slhoanveppm"]+=$re["slhoanveppm"];
					$mangdthoanvetrongthang[$re["IDTao"]]["doanhthuhoanvepm"]+=$re["doanhthuhoanvepm"];
						
				}else if($re["idchol"]==$mangnhanvien[$re['idchol']]){
					
					$mangdthoanvetrongthang[$re["idchol"]]["donhoanvepm"]+=$re["donhoanvepm"];
					$mangdthoanvetrongthang[$re["idchol"]]["slhoanveppm"]+=$re["slhoanveppm"];
					$mangdthoanvetrongthang[$re["idchol"]]["doanhthuhoanvepm"]+=$re["doanhthuhoanvepm"];											
				}else if($re["diachiN"]==$mangnhanvien[$re['diachiN']]){
					
					$mangdthoanvetrongthang[$re["diachiN"]]["donhoanvepm"]+=$re["donhoanvepm"];
					$mangdthoanvetrongthang[$re["diachiN"]]["slhoanveppm"]+=$re["slhoanveppm"];
					$mangdthoanvetrongthang[$re["diachiN"]]["doanhthuhoanvepm"]+=$re["doanhthuhoanvepm"];
				}
		
	}
	
		$sql12="select sum(b.SoLuong) as slhoanveppm ,count(distinct b.SoCT) as donhoanvepm,sum(ceil(b.DonGia*(1-1*b.chietkhau/100))*b.SoLuong) as doanhthuhoanvepm,b.IDTao,b.diachiN,b.idchol,b.idgioithieu $where12__";
	
	
	/*	$sql12="select sum(abs(b.SoLuong)) as slhoanveppm ,count(distinct b.SoCT) as donhoanvepm,sum(ceil(b.DonGia*(1-1*b.chietkhau/100))*abs(b.SoLuong)) as doanhthuhoanvepm,b.IDTao,b.diachiN,b.idchol,b.idgioithieu $where12__";*/
		
		//echo $sql12;
	$query12 = $data->query($sql12);
		$mangdthoanvetrongthangpass=[];
	
	$vongdau=false;
	while($re=$data->fetch_array($query12)){
				if($re["IDTao"]==$mangnhanvien[$re['IDTao']] ){
					$mangdthoanvetrongthangpass[$re["IDTao"]]["donhoanvepm"]+=$re["donhoanvepm"];
					$mangdthoanvetrongthangpass[$re["IDTao"]]["slhoanveppm"]+=$re["slhoanveppm"];
					$mangdthoanvetrongthangpass[$re["IDTao"]]["doanhthuhoanvepm"]+=$re["doanhthuhoanvepm"];
						
				}else if($re["idchol"]==$mangnhanvien[$re['idchol']]){
					
					$mangdthoanvetrongthangpass[$re["idchol"]]["donhoanvepm"]+=$re["donhoanvepm"];
					$mangdthoanvetrongthangpass[$re["idchol"]]["slhoanveppm"]+=$re["slhoanveppm"];
					$mangdthoanvetrongthangpass[$re["idchol"]]["doanhthuhoanvepm"]+=$re["doanhthuhoanvepm"];											
				}else if($re["diachiN"]==$mangnhanvien[$re['diachiN']]){
					
					$mangdthoanvetrongthangpass[$re["diachiN"]]["donhoanvepm"]+=$re["donhoanvepm"];
					$mangdthoanvetrongthangpass[$re["diachiN"]]["slhoanveppm"]+=$re["slhoanveppm"];
					$mangdthoanvetrongthangpass[$re["diachiN"]]["doanhthuhoanvepm"]+=$re["doanhthuhoanvepm"];
				}
		
	}
	
	// and d.ngayhoanthanh>=$hoanthanhtungay_ and d.ngayhoanthanh<=$hoanthanhdendenngay_ 
	$sql3="select b.IDTao,b.diachiN,b.idchol,b.SoCT,SUM(b.SoLuong) as tongsl,COUNT(distinct b.ID) as sb,SUM(case when (d.dongthoigiantrangthaidon = 1 or b.diachiN=b.idgioithieu) and (d.ngayhoanthanh>=$hoanthanhtungay_ and d.ngayhoanthanh<=$hoanthanhdendenngay_) then b.SoLuong else 0 end) as soluongspthanhcong,sum(ceil(b.DonGia*(1-1*b.chietkhau/100))*b.SoLuong) as thanhtien
	 $where__dondi,b.SoCT";
	 
//echo "<br><br><br>".$sql3;
	//return;
$query3 = $data->query($sql3);
		$mangsoluongdi=[];
	
	$vongdau=false;
	$socttam=[];
	while($re=$data->fetch_array($query3)){
			/*if(!in_array($re["SOCT"],$socttam)){
				array_push($socttam,$re['SoCT']);
			}*/
				if($re["IDTao"]==$mangnhanvien[$re['IDTao']] ){
					$mangsoluongdi[$re["IDTao"]]["soluongdi"]+=$re["tongsl"];
					$mangsoluongdi[$re["IDTao"]]["soluongspthanhcong"]+=$re["soluongspthanhcong"];
						$mangsoluongdi[$re["IDTao"]]["soluongdondi"]+=$re["sb"];
						$mangsoluongdi[$re["IDTao"]]["tongdoanhthu"]+=$re["thanhtien"];
				}else if($re["idchol"]==$mangnhanvien[$re['idchol']]){
					$mangsoluongdi[$re["idchol"]]["soluongdi"]+=$re["tongsl"];		
					$mangsoluongdi[$re["idchol"]]["soluongspthanhcong"]+=$re["soluongspthanhcong"];
						$mangsoluongdi[$re["idchol"]]["soluongdondi"]+=$re["sb"];
						$mangsoluongdi[$re["idchol"]]["tongdoanhthu"]+=$re["thanhtien"];		
				}else if($re["diachiN"]==$mangnhanvien[$re['diachiN']]){
					$mangsoluongdi[$re["diachiN"]]["soluongdi"]+=$re["tongsl"];		
					$mangsoluongdi[$re["diachiN"]]["soluongspthanhcong"]+=$re["soluongspthanhcong"];
					$mangsoluongdi[$re["diachiN"]]["soluongdondi"]+=$re["sb"];	
					$mangsoluongdi[$re["diachiN"]]["tongdoanhthu"]+=$re["thanhtien"];		
				}
	}
	//echo $sql3;
	/*$sql4="select b.IDTao,b.diachiN,b.idchol,b.idgioithieu,b.NgayNhap,count(b.SoCT) as tongdondi,count(case when (d.dongthoigiantrangthaidon = 1) or (b.diachiN=b.idgioithieu) then 1 else 0 end) as donthanhcong
	 $where__dondi,b.SoCT";
		echo $sql4;
		return;
		$query4 = $data->query($sql4);
		$mangsoluongdondi=[];
	
	$vongdau=false;
	while($re=$data->fetch_array($query4)){
	
			
				if($re["IDTao"]==$mangnhanvien[$re['IDTao']] ){
				
					$mangsoluongdondi[$re["IDTao"]]["donthanhcong"]+=$re["donthanhcong"];
					$mangsoluongdondi[$re["IDTao"]]["tongdondi"]+=$re["tongdondi"];
					
				}
				if($re["idchol"]==$mangnhanvien[$re['idchol']]){
					
					$mangsoluongdondi[$re["idchol"]]["donthanhcong"]+=$re["donthanhcong"];	
					$mangsoluongdondi[$re["idchol"]]["tongdondi"]+=$re["tongdondi"];								
				}
			
			
				if($re["diachiN"]==$mangnhanvien[$re['diachiN']]){	
					$mangsoluongdondi[$re["diachiN"]]["donthanhcong"]+=$re["donthanhcong"];
					$mangsoluongdondi[$re["diachiN"]]["tongdondi"]+=$re["tongdondi"];		
				}
		
		
	}*/
//in($mangdthoanvetrongthang);
if ($_SESSION['admintuan'] || $_SESSION["LoginID"] == 1) echo $sql."<br>";

?> 

<style>
#httim{
	max-height:500px;overflow:scroll;
}
</style>
<div id="wrap_kq" style="display:flex;flex-direction: column;">
    <div>
        <input type="button"
            onclick="return timphieutonghop('' ,cuahang.value,tungay.value,denngay.value,tinhtrang.value,'',0,'',soct.value,loc.value,tkno.value,tkco.value,loaithuchi.value,nguoixacnhan.value,1,13)"
            name="search" style="width:auto" id="search" value="Team Tiktok" />
        <input  type="button" onclick="xuatkq()"  name="search3" style="width:auto" id="search3"
            value="Excel Tiktok" />
        <input type="button"
            onclick="return timphieutonghop('' ,cuahang.value,tungay.value,denngay.value,tinhtrang.value,'',0,'',soct.value,loc.value,tkno.value,tkco.value,loaithuchi.value,nguoixacnhan.value,1,14)"
            name="search" style="width:auto" id="search" value="Phần Mềm" />
        <input type="button"  onclick="xuatkq()"  name="search3" style="width:auto" id="search3"
            value="Excel Phần Mềm" />
    </div>
    
            <table border="0" cellpadding="0" cellspacing="0" class="tbchuan table_bc" id="dopcccc"
                style="width:100%;border-collapse:collapse">
                <tr style="    position: sticky;
    left: 0;
	top:-1px;
    z-index: 2;min-height:68px">
                    <th rowspan="2" style="min-width:30px;  position: sticky;
    left: 0;top:0;
    z-index: 100;">STT</th>
                    <th rowspan="2" style="min-width:100px;  position: sticky;
    left: 29px;top:0;
    z-index: 100;">Tên NV</th>
                    <th rowspan="2" style="min-width:70px;  position: sticky;
    left: 127px;top:0;
    z-index: 100;">Mã NV</th>
                    <th colspan="5">SP<30K không áp dụng đồng giá SP (DT PM)</th>
                    <th colspan="5">SP<30K không áp dụng đồng giá SP (DT PASS)</th>
                    <th colspan="5">SP >= 30K ĐẾN < 100K (DT PM)</th>
                    <th colspan="5">SP >= 30K ĐẾN < 100K (DT PASS)</th>
                    <th colspan="5">SP >= 100K ĐẾN < 180K (DT PM)</th>
                    <th colspan="5">SP >= 100K ĐẾN < 180K (DT PASS)</th>
                    <th colspan="5">SP >= 180K (DT PM) </th>
                    <th colspan="5">SP >= 180K (DT PASS)</th>
                    <th colspan="5">SẢN PHẨM ÁP DỤNG CT SALE ( trừ CT áp dụng voucher 10%) PM</th>
                    <th colspan="5">SẢN PHẨM ÁP DỤNG CT SALE ( trừ CT áp dụng voucher 10%) PASS ĐƠN</th>
                    <th rowspan="2">TỔNG TIỀN HOA HỒNG THỰC NHẬN</th>
					  <th rowspan="2">TỔNG ĐƠN ĐI</th>
					<th rowspan="2">TỔNG  ĐƠN ĐI THÀNH CÔNG</th>
					 <th rowspan="2">TỔNG SỐ LƯỢNG SẢN PHẨM ĐƠN ĐI</th>
                    <th rowspan="2">TỔNG SỐ LƯỢNG SẢN PHẨM ĐƠN ĐI THÀNH CÔNG</th>
				
					   <th rowspan="2">TỔNG DOANH THU </th>
					  <th rowspan="2">TỔNG DOANH THU THÀNH CÔNG</th>
					
                    <th colspan="3">DOANH THU TRONG THÁNG HOÀN VỀ PM</th>
                    <th colspan="3">DOANH THU TRONG THÁNG HOÀN VỀ PASS ĐƠN</th>
                <th colspan="3">DOANH THU HOÀN VỀ THÁNG TRƯỚC PM</th>
                    <th colspan="3">DOANH THU HOÀN VỀ THÁNG TRƯỚC PASS ĐƠN</th>
                </tr>
                <tr style="    position: sticky;
    left: 0;
	    top: 52px;
    z-index: 0;">
                    <th>DOANH THU</th>
                    <th>SỐ LƯỢNG SP</th>
                    <th>DOANH THU TRUNG BÌNH</th>
                    <th>HOA HỒNG</th>
                    <th>HOA HỒNG NHẬN</th>
                    <th>DOANH THU</th>
                    <th>SỐ LƯỢNG SP</th>
                    <th>DOANH THU TRUNG BÌNH</th>
                    <th>HOA HỒNG</th>
                    <th>HOA HỒNG NHẬN</th>
                    <th>DOANH THU</th>
                    <th>SỐ LƯỢNG SP</th>
                    <th>DOANH THU TRUNG BÌNH</th>
                    <th>HOA HỒNG</th>
                    <th>HOA HỒNG NHẬN</th>
                    <th>DOANH THU</th>
                    <th>SỐ LƯỢNG SP</th>
                    <th>DOANH THU TRUNG BÌNH</th>
                    <th>HOA HỒNG</th>
                    <th>HOA HỒNG NHẬN</th>
                    <th>DOANH THU</th>
                    <th>SỐ LƯỢNG SP</th>
                    <th>DOANH THU TRUNG BÌNH</th>
                    <th>HOA HỒNG</th>
                    <th>HOA HỒNG NHẬN</th>
                    <th>DOANH THU</th>
                    <th>SỐ LƯỢNG SP</th>
                    <th>DOANH THU TRUNG BÌNH</th>
                    <th>HOA HỒNG</th>
                    <th>HOA HỒNG NHẬN</th>
                    <th>DOANH THU</th>
                    <th>SỐ LƯỢNG SP</th>
                    <th>DOANH THU TRUNG BÌNH</th>
                    <th>HOA HỒNG</th>
                    <th>HOA HỒNG NHẬN</th>
                    <th>DOANH THU</th>
                    <th>SỐ LƯỢNG SP</th>
                    <th>DOANH THU TRUNG BÌNH</th>
                    <th>HOA HỒNG</th>
                    <th>HOA HỒNG NHẬN</th>
                    <th>DOANH THU</th>
                    <th>SỐ LƯỢNG SP</th>
                    <th>DOANH THU TRUNG BÌNH</th>
                    <th>HOA HỒNG</th>
                    <th>HOA HỒNG NHẬN</th>
                    <th>DOANH THU</th>
                    <th>SỐ LƯỢNG SP</th>
                    <th>DOANH THU TRUNG BÌNH</th>
                    <th>HOA HỒNG</th>
                    <th>HOA HỒNG NHẬN</th>
                    <th>DOANH THU</th>
					 <th>SỐ LƯỢNG ĐƠN</th>
                    <th>SỐ LƯỢNG SP</th>
                    <th>DOANH THU</th>
					 <th>SỐ LƯỢNG ĐƠN</th>
                    <th>SỐ LƯỢNG SP</th>
               <th>DOANH THU</th>
					 <th>SỐ LƯỢNG ĐƠN</th>
                    <th>SỐ LƯỢNG SP</th>
                    <th>DOANH THU</th>
					 <th>SỐ LƯỢNG ĐƠN</th>
                    <th>SỐ LƯỢNG SP</th>
					
                </tr> <?php
				// Mở thẻ Php
				
				$i = 1;
				

				$hoahongduoi30 = 1000;
				$hoahongtu30den100 = 2500;
				$hoahongtu100den180 = 4000;
				$hoahongtren180 = 5000;
				$hoahongapdungvc = 2500;

				$tonghoahongduoi30pm = 0;
				$tonghoahongduoi30pass = 0;
				$tonghoahongtu30den100pm = 0;
				$tonghoahongtu30den100pass = 0;
				$tonghoahongtu100den180pm = 0;
				$tonghoahongtu100den180pass = 0;
				$tonghoahongtren180pm = 0;
				$tonghoahongtren180pass = 0;
				$tonghoahongkm = 0;
				$tonghoahongkmpass = 0;
				$tonghoahongthucnhan=0;
				
				foreach($mangluongonline as $key => $v) {
					
					if($mangnhanviendaydu[$key]["MaNV"]){
					
							$hoahongduoi30pm = 0;
							$hoahongduoi30pass = 0;
							$hoahong30den100pm = 0;
							$hoahong30den100pass = 0;
							$hoahong100den180pm = 0;
							$hoahong100den180pass = 0;
							$hoahongtren180pm = 0;
							$hoahongtren180pass = 0;
							$hoahongkm = 0;
							$hoahongkmpass = 0;
							$tonghoahongthucnhan=0;
							
							$hoahongduoi30pm = $v['duoi30']["sl"]?($v['duoi30']["sl"]*$hoahongduoi30):0;
							
							$hoahongduoi30pass = $v['passduoi30']["sl"]?($v['passduoi30']["sl"]*$hoahongduoi30):0;
							$hoahong30den100pm = $v['tu30den100']["sl"]?($v['tu30den100']["sl"]*$hoahongtu30den100):0;
							$hoahong30den100pass = $v['passtu30den100']["sl"]?($v['passtu30den100']["sl"]*$hoahongtu30den100):0;
							$hoahong100den180pm = $v['tu100den180']["sl"]?($v['tu100den180']["sl"]*$hoahongtu100den180):0;
							$hoahong100den180pass = $v['passtu100den180']["sl"]?($v['passtu100den180']["sl"]*$hoahongtu100den180):0;
							$hoahongtren180pm = $v['tu180']["sl"]?($v['tu180']["sl"]*$hoahongtren180):0;
							
							$hoahongtren180pass = $v['passtu180']["sl"]?($v['passtu180']["sl"]*$hoahongtren180):0;
							$hoahongkm = $v['khuyenmai']["sl"]?($v['khuyenmai']["sl"]*$hoahongapdungvc):0;
							$hoahongkmpass = $v['passkhuyenmai']["sl"]?($v['passkhuyenmai']["sl"]*$hoahongapdungvc):0;
							
							
							$tonghoahongthucnhan = $hoahongduoi30pm + $hoahongduoi30pass + $hoahong30den100pm + $hoahong30den100pass + $hoahong100den180pm + $hoahong100den180pass + $hoahongtren180pm + $hoahongtren180pass + $hoahongkm + $hoahongkmpass;
							$tongdoanhthuthanhcong=0;
							$tongdoanhthuthanhcong +=$v['duoi30']["dt"]+$v['passduoi30']["dt"]+$v['tu30den100']["dt"]+$v['passtu30den100']["dt"]+$v['tu100den180']["dt"]+$v['passtu100den180']["dt"]+$v['tu180']["dt"]+$v['passtu180']["dt"]+$v['khuyenmai']["dt"]+$v['passkhuyenmai']["dt"];
							$tongslthanhcong=0;
							
							$tongslthanhcong+=$v['duoi30']["sl"]+$v['passduoi30']["sl"]+$v['tu30den100']["sl"]+$v['passtu30den100']["sl"]+$v['tu100den180']["sl"]+$v['passtu100den180']["sl"]+$v['tu180']["sl"]+$v['passtu180']["sl"]+$v['khuyenmai']["sl"]+$v['passkhuyenmai']["sl"];
					
				?> <tr>
                    <td style="min-width:30px;  position: sticky;
    left: 0;
    z-index: 1;background-color:#FFFFFF"> <?php echo $i++; ?></td>
                    <td style="min-width:100px;  position: sticky;
    left: 29px;
    z-index: 1;background-color:#FFFFFF"> <?php echo $mangnhanviendaydu[$key]["Ten"]; ?></td>
                    <td style="min-width:70px;  position: sticky;
    left: 127px;
    z-index: 1;background-color:#FFFFFF"> <?php echo $mangnhanviendaydu[$key]["MaNV"]; ?></td>
					
						
				<td> <?php echo $v['duoi30']["dt"]?number_format($v['duoi30']["dt"]):0; ?></td>
				<td> <?php echo $v['duoi30']["sl"]?number_format($v['duoi30']["sl"]):0; ?></td>
				<td> <?php echo ($v['duoi30']["dt"] && $v['duoi30']["sl"]) ? number_format($v['duoi30']["dt"] / $v['duoi30']["sl"]):0; ?></td>
				<td> <?php echo number_format($hoahongduoi30); ?></td>
				<td> <?php echo number_format($hoahongduoi30pm); ?></td>
				
				
				<td> <?php echo $v['passduoi30']["dt"]?number_format($v['passduoi30']["dt"]):0; ?></td>
				<td> <?php echo $v['passduoi30']["sl"]?number_format($v['passduoi30']["sl"]):0; ?></td>
				<td> <?php echo ($v['passduoi30']["dt"] && $v['passduoi30']["sl"]) ? number_format($v['passduoi30']["dt"] / $v['passduoi30']["sl"]):0; ?></td>
				<td> <?php echo number_format($hoahongduoi30); ?></td>
				<td> <?php echo number_format($hoahongduoi30pass); ?></td>
				
				
				<td> <?php echo $v['tu30den100']["dt"]?number_format($v['tu30den100']["dt"]):0; ?></td>
				<td> <?php echo $v['tu30den100']["sl"]?number_format($v['tu30den100']["sl"]):0; ?></td>
				<td> <?php echo ($v['tu30den100']["dt"] && $v['tu30den100']["sl"]) ? number_format($v['tu30den100']["dt"] / $v['tu30den100']["sl"]):0; ?></td>
				</td>
				<td> <?php echo number_format($hoahongtu30den100); ?></td>
				<td> <?php echo number_format($hoahong30den100pm); ?></td>
				
				
				<td> <?php echo $v['passtu30den100']["dt"]?number_format($v['passtu30den100']["dt"]):0; ?></td>
				<td> <?php echo $v['passtu30den100']["sl"]?number_format($v['passtu30den100']["sl"]):0; ?></td>
				<td> <?php echo ($v['passtu30den100']["dt"] && $v['passtu30den100']["sl"]) ? number_format($v['passtu30den100']["dt"] / $v['passtu30den100']["sl"]):0; ?></td>
				</td>
				<td> <?php echo number_format($hoahongtu30den100); ?></td>
				<td> <?php echo number_format($hoahong30den100pass); ?></td>
				
				
				<td> <?php echo $v['tu100den180']["dt"]?number_format($v['tu100den180']["dt"]):0; ?></td>
				<td> <?php echo $v['tu100den180']["sl"]?number_format($v['tu100den180']["sl"]):0; ?></td>
				<td> <?php echo ($v['tu100den180']["dt"] && $v['tu100den180']["sl"]) ? number_format($v['tu100den180']["dt"] / $v['tu100den180']["sl"]):0; ?></td>
				</td>
				<td> <?php echo number_format($hoahongtu100den180); ?></td>
				<td> <?php echo number_format($hoahong100den180pm); ?></td>
				
				
				<td> <?php echo $v['passtu100den180']["dt"]?number_format($v['passtu100den180']["dt"]):0; ?></td>
				<td> <?php echo $v['passtu100den180']["sl"]?number_format($v['passtu100den180']["sl"]):0; ?></td>
				<td> <?php echo ($v['passtu100den180']["dt"] && $v['passtu100den180']["sl"]) ? number_format($v['passtu100den180']["dt"] / $v['passtu100den180']["sl"]):0; ?></td>
				</td>
				<td> <?php echo number_format($hoahongtu100den180); ?></td>
				<td> <?php echo number_format($hoahong100den180pass); ?></td>
				
				<td> <?php echo $v['tu180']["dt"]?number_format($v['tu180']["dt"]):0; ?></td>
				<td> <?php echo $v['tu180']["sl"]?number_format($v['tu180']["sl"]):0; ?></td>
				<td> <?php echo ($v['tu180']["dt"] && $v['tu180']["sl"]) ? number_format($v['tu180']["dt"] / $v['tu180']["sl"]):0; ?></td>
				<td> <?php echo number_format($hoahongtren180); ?></td>
				<td> <?php echo number_format($hoahongtren180pm); ?></td>
				
				<td> <?php echo $v['passtu180']["dt"]?number_format($v['passtu180']["dt"]):0; ?></td>
				<td> <?php echo $v['passtu180']["sl"]?number_format($v['passtu180']["sl"]):0; ?></td>
				<td> <?php echo ($v['passtu180']["dt"] && $v['passtu180']["sl"]) ? number_format($v['passtu180']["dt"] / $v['passtu180']["sl"]):0; ?></td>
				<td> <?php echo number_format($hoahongtren180); ?></td>
				<td> <?php echo number_format($hoahongtren180pass); ?></td>
				
				
				
			<td> <?php echo $v['khuyenmai']["dt"]?number_format($v['khuyenmai']["dt"]):0; ?></td>
				<td> <?php echo $v['khuyenmai']["sl"]?number_format($v['khuyenmai']["sl"]):0; ?></td>
				<td> <?php echo ($v['khuyenmai']["dt"] && $v['khuyenmai']["sl"]) ? number_format($v['khuyenmai']["dt"] / $v['khuyenmai']["sl"]):0; ?></td>
				<td> <?php echo number_format($hoahongapdungvc); ?></td>
				<td> <?php echo number_format($hoahongkm); ?></td>
				
				
				<td> <?php echo $v['passkhuyenmai']["dt"]?number_format($v['passkhuyenmai']["dt"]):0; ?></td>
				<td> <?php echo $v['passkhuyenmai']["sl"]?number_format($v['passkhuyenmai']["sl"]):0; ?></td>
				<td> <?php echo ($v['passkhuyenmai']["dt"] && $v['passkhuyenmai']["sl"]) ? number_format($v['passkhuyenmai']["dt"] / $v['passkhuyenmai']["sl"]):0; ?></td>
				<td> <?php echo number_format($hoahongapdungvc); ?></td>
				<td> <?php echo number_format($hoahongkmpass); ?></td>
				
				
				
				<td> <?php echo number_format($tonghoahongthucnhan); ?></td>
					
				<td> <?php echo $mangsoluongdi[$key]["soluongdondi"]?number_format($mangsoluongdi[$key]["soluongdondi"]):0;  ?></td>
				<td> <?php echo $v["soluongdi"]?number_format($v["soluongdi"]):0; ?></td>
				
				<td> <?php echo $mangsoluongdi[$key]["soluongdi"]?number_format($mangsoluongdi[$key]["soluongdi"]):0; ?></td>
				<td> <?php echo $mangsoluongdi[$key]["soluongspthanhcong"]?number_format($mangsoluongdi[$key]["soluongspthanhcong"]):0; ?></td>
				
					<td> <?php echo $mangsoluongdi[$key]["tongdoanhthu"]?number_format($mangsoluongdi[$key]["tongdoanhthu"]):0; ?></td>
				<td> <?php echo $v['tongdt']?number_format($v['tongdt']):0; ?></td>
					
				<?php
					$slDHoanTrongThang=$mangdthoanvetrongthang[$key]['donhoanvepm']?number_format($mangdthoanvetrongthang[$key]['donhoanvepm']):0;
					$slspHoanTrongThang=$mangdthoanvetrongthang[$key]['slhoanveppm']?number_format($mangdthoanvetrongthang[$key]['slhoanveppm']):0;
					$doanhthuHoanTrongThang=$mangdthoanvetrongthang[$key]['doanhthuhoanvepm']?number_format($mangdthoanvetrongthang[$key]['doanhthuhoanvepm']):0;
				?>
				
				<td> <?php echo $doanhthuHoanTrongThang;  ?></td>
				<td> <?php echo $slDHoanTrongThang; ?></td>
				<td> <?php echo $slspHoanTrongThang;  ?></td>
				
		<?php
					$slDHoanTrongThangpass=$mangdthoanvetrongthangpass[$key]['donhoanvepm']?number_format($mangdthoanvetrongthangpass[$key]['donhoanvepm']):0;
					$slspHoanTrongThangpas=$mangdthoanvetrongthangpass[$key]['slhoanveppm']?number_format($mangdthoanvetrongthangpass[$key]['slhoanveppm']):0;
					$doanhthuHoanTrongThangpass=$mangdthoanvetrongthangpass[$key]['doanhthuhoanvepm']?number_format($mangdthoanvetrongthangpass[$key]['doanhthuhoanvepm']):0;
				?>
				
				<td> <?php echo $doanhthuHoanTrongThangpass;  ?></td>
				<td> <?php echo $slDHoanTrongThangpass; ?></td>
				<td> <?php echo $slspHoanTrongThangpas;  ?></td>
				
				
				
			<?php
			$slDHoanThangtruocpm=$mangdthoanvethangtruoc[$key]['donhoanvepm']?number_format($mangdthoanvethangtruoc[$key]['donhoanvepm']):0;
					$slspHoanThangtruocpm=$mangdthoanvethangtruoc[$key]['slhoanveppm']?number_format($mangdthoanvethangtruoc[$key]['slhoanveppm']):0;
					$doanhthuHoanThangtruocpm=$mangdthoanvethangtruoc[$key]['doanhthuhoanvepm']?number_format($mangdthoanvethangtruoc[$key]['doanhthuhoanvepm']):0;
				?>
				
			<td> <?php echo $doanhthuHoanThangtruocpm;  ?></td>
				<td> <?php echo $slDHoanThangtruocpm; ?></td>
				<td> <?php echo $slspHoanThangtruocpm;  ?></td>
				
				
				<?php
					$slDHoanThangtruocpass=$mangdthoanvethangtruocpass[$key]['donhoanvepm']?number_format($mangdthoanvethangtruocpass[$key]['donhoanvepm']):0;
					$slspHoanThangtruocpass=$mangdthoanvethangtruocpass[$key]['slhoanveppm']?number_format($mangdthoanvethangtruocpass[$key]['slhoanveppm']):0;
					$doanhthuHoanThangtruocpass=$mangdthoanvethangtruocpass[$key]['doanhthuhoanvepm']?number_format($mangdthoanvethangtruocpass[$key]['doanhthuhoanvepm']):0;
				?>
				
				<td> <?php echo $doanhthuHoanThangtruocpass;  ?></td>
				<td> <?php echo $slDHoanThangtruocpass; ?></td>
				<td> <?php echo $slspHoanThangtruocpass;  ?></td>
					</tr> 
                   <?php
				   }
					// Mở thẻ Php
				} // đóng vòng lặp
				?>
            </table>
       
</div> <?php
$data->closedata();

function gettennv($table, $ID, $cot)
{
	global $data;
	$sql = "select ID,$cot from $table where  MaNV='$ID' ";

	$result = $data->query($sql);
	$row = $data->fetch_array($result);
	// echo  $sql ;			
	return $row[$cot];
}

function checkLoaiMaVD($ma)
{

	if (is_numeric($ma)) {
		return 1; //viettel
	} else if (substr($ma, (strlen($ma) - 2), 2) == 'VN') {
		return 2; //Bưu điện
	} else if ($ma[0] == 'S') {
		return 3; //GHTK
	}
}


function checksotienhoadon($soct)
{

	$sql = "select sum(DonGia) as tongtiendg,Round(sum((DonGia-(DonGia*chietkhau/100))*SoLuong)-b.tigia) as thanhtien 
from xuatbanhang a left join phieunhapxuat b on a.IDphieu=b.ID where b.SoCT='$soct' group by a.IDphieu ";
	global $data;
	$dong = getdong($sql);
	if ($dong['tongtiendg']) {
		return $dong;
	} else {
		return false;
	}
}


function checkhoadonthuongduyet($hdbh)
{

	$sql = "select a.IDHD as idhd,a.sotien as tienthuong from thuonghoadon a left join phieunhapxuat b on a.IDHD=b.ID where b.SoCT='$hdbh' and right(tinhtrang,1)=4";

	global $data;
	$dong = getdong($sql);
	if ($dong['idhd']) {
		return $dong;
	} else {
		return false;
	}
}
?>