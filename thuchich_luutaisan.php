<?php
session_start();
$idk = $_SESSION["LoginID"];
if ($idk == '') return;
$idkho = $_SESSION["se_kho"];
$root_path = getcwd() . "/";
include($root_path . "biensession.php");
include($root_path . "includes/config.php");
include($root_path . "includes/removeUnicode.php");
include($root_path . "includes/class.paging.php");
include($root_path . "includes/class.mysql.php");
include($root_path . "includes/function.php");
include($root_path . "includes/function_local.php");

$data = new class_mysql();
$data->config();
$data->access();
$mpt = array();
$mangud = array();
$data1 = $_POST['DATA'];
$tmp = explode('*@!', $data1);
$i = 0;
$ma = $tmp[0];
$Name = addslashes($tmp[1]);
$type = laso($tmp[2]);
$soluong = laso($tmp[3]);
$gia = laso($tmp[4]);
$donvitinh = laso($tmp[5]);
$nguoinhan = $tmp[6];
$ngaybatdau = $tmp[7];
$ngayketthuc = $tmp[8]; // $tientra =str_replace(",","",$tmp[14]) ;	
$note = addslashes($tmp[9]);
$baohanh = laso($tmp[10]);
$idgoi = laso($tmp[11]);
$nhomtaisan  = laso($tmp[13]);

echo $data1;
//Thuchikt
$loainhom = $tmp[14];
$ngaythuchi = $tmp[15];
$sochungtu = $tmp[16];
$sotien = $tmp[17];
$lydo = $tmp[18];
$nguoinhan = $tmp[19];
$nguoichi = $tmp[20];
$cuahang = $tmp[21];
$donvi = $tmp[22];
$nhacungcap = $tmp[23];
$note = $tmp[24];
$ID = $tmp[25];
$luachon = $tmp[26];
$loaitaikhoan = $tmp[27];
$nganhang = $tmp[28];
$loaitaisan = $tmp[29];
$tkco = ""; $tkno = "";
$psno = ""; $psco = "";
$hdbh = ""; $mavandon = "";
$IDkhoa = ""; $manv = "";
$phieuxuat = ""; $sophieupm = "";
$chungtu = ""; $donvivc = "";
$phithukh = ""; $IDCha = "";

$taikhoanh = getdong("Select ma,Name from taikhoannganhang where ID = $nganhang");
$sotknh = $taikhoanh['ma'];
$tentknh = $taikhoanh['Name'];

if ($ngaythuchi != "") {
	$ngaythuchi =  explode('/', $ngaythuchi);
	if (strlen($ngaythuchi[1]) == 1) {
		$ngaythuchi[1] = "0" . $ngaythuchi[1];
	}
	if (strlen($ngaythuchi[0]) == 1) {
		$ngaythuchi[0] = "0" . $ngaythuchi[0];
	}
	$ngaythuchi = "$ngaythuchi[2]-$ngaythuchi[1]-$ngaythuchi[0]";
	// $sql_where .= " and  ngaylenhethong <= '$ngay[2]-$ngay[1]-$ngay[0] 23:59'";
}


if ($ngaybatdau != "") {
	$ngay =  explode('/', $ngaybatdau);
	if (strlen($ngay[1]) == 1) {
		$ngay[1] = "0" . $ngay[1];
	}
	if (strlen($ngay[0]) == 1) {
		$ngay[0] = "0" . $ngay[0];
	}
	$ngaybatdau = "$ngay[2]-$ngay[1]-$ngay[0]";
	// $sql_where .= " and  ngaylenhethong <= '$ngay[2]-$ngay[1]-$ngay[0] 23:59'";
}
if ($ngayketthuc != "") {
	$ngay =  explode('/', $ngayketthuc);
	if (strlen($ngay[1]) == 1) {
		$ngay[1] = "0" . $ngay[1];
	}
	if (strlen($ngay[0]) == 1) {
		$ngay[0] = "0" . $ngay[0];
	}
	$ngayketthuc = "$ngay[2]-$ngay[1]-$ngay[0]";
	// $sql_where .= " and  ngaylenhethong <= '$ngay[2]-$ngay[1]-$ngay[0] 23:59'";
}
$nguoitao = $_SESSION["TenUser"] . "_" . $idk; // dùng lưu sau này phòng trường hợp bị đổi tên user để dùng lại 



//	 $khach = getdong("select Name,address,NameN,addressN from customer where ID = '$idkhach' limit 1 "); 
//	 $tenlydo= getten("lydonhapxuat",$lydoxuat,"Name") ;

$ngaytao = gmdate('Y-m-d H:i:s', time() + 7 * 3600);
$ngay =  explode('/', $tmp[1]);
if (strlen($ngay[1]) == 1) {
	$ngay[1] = "0" . $ngay[1];
}
if (strlen($ngay[0]) == 1) {
	$ngay[0] = "0" . $ngay[0];
}
//	 $ngayxuat = $ngay[2].'-'.$ngay[1].'-'.$ngay[0] ; // có the sau nay lay theo nguoi tao de có thẻ nhap lui
$ngayxuat = gmdate('Y-m-d', time() + 7 * 3600);
if ($idgoi == 0) {
	$idphieu = getdong(" select ID from taisantam where  ma='$ma' limit 1  ");

	if ($idphieu['ID'] > 0) {
		$idgoi = $idphieu['ID'];
		$sql = "update taisantam SET dakhoa=0,mota='',gia='$gia',nguoinhan='$nguoinhan', nguoigiao='$nguoigiao', donvitinh='$donvitinh', cuahang='$idkho', ngaybatdau='$ngaybatdau',ngayketthuc='$ngayketthuc',soluong='$soluong',ngaytao='$ngaytao',ma='$ma', Name ='$Name',type ='$type',note ='$note' ,nhomtaisan='$nhomtaisan', idtao='$idk' where id=$idgoi ";
		$data->query($sql);

		
		$sqll = "UPDATE thuchikt SET IDCha = '$IDCha',sochungtu = '$sochungtu',ngaythuchi = '$ngaythuchi',ngaytao = '$ngaytao',note = '$note',sotien = '$sotien',ngaysua = '$ngaytao',lydo = '$lydo',nguoinhan = '$nguoinhan',nguoichi = '$nguoichi',loaitk = '$cuahang',IDtao = '$idk',IDsua = '$idk',luachon = '$luachon',LydoN = '',idnganhang = '$nganhang',loaitaikhoan = '$loaitaikhoan',tinhtrang = '6',IDkhoa = '$IDkhoa',tkno = '$tkno',tkco = '$tkco',psno = '$psno',psco = '$psco',donvi = '$donvi',soluong = '$soluong',dongia = '$gia',hdbh = '$hdbh',sotknh = '$sotknh, mavandon = '',NCC = '$nhacungcap',manv = '$manv',phieuxuat = '$phieuxuat',sophieupm = '$sophieupm',chungtu = '$chungtu',tentknh = '$tentknh',donvivc = '$donvivc',phithukh = '$phithukh' WHERE sochungtu = '$ma'";
		$data->query($sqll);

		echo "**#" . $idgoi . "**#$ma**#Cập nhập  phiếu tài sản đã có lần khác!!! **#";
		return;
	} {
		// $idnha la id cap nhap lan thu n, idtao là id tạo ra phiéu này, idtao va idnhap thong thuong trung nhau
		$sql = "insert into taisantam SET dakhoa=0,mota='',gia='$gia',nguoinhan='$nguoinhan', nguoigiao='$nguoigiao', donvitinh='$donvitinh', cuahang='$idkho', ngaybatdau='$ngaybatdau',ngayketthuc='$ngayketthuc',soluong='$soluong',ngaytao='$ngaytao',ma='$ma', Name ='$Name',type ='$type',note ='$note' ,nhomtaisan='$nhomtaisan', idtao='$idk' ";
		$data->query($sql);
		$idphieu = getdong(" select ID from taisantam where  ma='$ma' limit 1  ");
		$idphieu = $idphieu['ID'];

		$sqll = "insert into thuchikt  (IDCha,sochungtu,ngaythuchi,ngaytao,note,sotien,ngaysua,lydo,nguoinhan,nguoichi,loaitk,IDtao,IDsua,luachon,LydoN,idnganhang,loaitaikhoan,tinhtrang,IDkhoa,tkno,tkco,psno,psco,donvi,soluong,dongia,hdbh,sotknh,mavandon,NCC,manv,phieuxuat,sophieupm,chungtu,tentknh,donvivc,phithukh) values ('$IDCha','$sochungtu','$ngaythuchi','$ngaytao','$note','$sotien','$ngaytao','$lydo','$nguoinhan','$nguoichi','$cuahang','$idk','$idk','$luachon','$lydo','$nganhang','$loaitaikhoan','6','$IDkhoa','$tkno','$tkco','$psno','$psco','$donvi','$soluong','$gia','$hdbh','$sotknh','$mavandon','$nhacungcap','$manv','$phieuxuat','$sophieupm','$chungtu','$tentknh','$donvivc','$phithukh')";
		$data->query($sqll);

		echo "**#$idphieu**#$ma**#Tạo phiếu chi và tài sản thành công ! **#";
		return;
	}
}   // else của them mới

if ($idgoi > 0) {   //  $idgoi <>0 cập nhập


	$st = getdong(" select ID,dakhoa from taisantam where ID='$idgoi' and ma ='$ma'  ");
	if (laso($st['dakhoa']) == 1) {
		echo "#*#*Phiếu đã khóa  !!! #*#*8";
		return;
	}
	if (laso($st['ID']) == 0) {
		echo "#*#*Phiếu không tồn tại !!!#*#*8 ";
		return;
	}

	//  $st = getdong(" select ID from taisantam where ID <> '$idgoi' and  ma ='$ma' ") ;
	// if (trim($st['ID'])!= "") { echo "#*#*Trùng số chứng từ khi lưu !!!#*#* " ; return ; } 


	$sql = " update taisantam set dakhoa=0, mota='',gia='$gia',nguoinhan='$nguoinhan', nguoigiao='$nguoigiao',donvitinh='$donvitinh', cuahang='$cuahang',ngaybatdau='$ngaybatdau',ngayketthuc='$ngayketthuc',soluong='$soluong',ngaytao='$ngaytao',ma='$ma',Name ='$Name',type ='$type',note ='$note',cuahang='$idkho',nhomtaisan='$nhomtaisan', idtao='$idk'   where ID = '$idgoi'";
	$data->query($sql);


	$update = $data->query($sql);
	echo "**#" . $idgoi . "**#$ma**#Cập nhập  phiếu tài sản đã có !!! **#";
	return;
}


// echo $sql ; 
$data->closedata();
return;
 
			//=========het kiem tra =================================  				
