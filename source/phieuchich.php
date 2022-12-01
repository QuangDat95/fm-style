<?php
session_start();
if (!defined("IN_SITE")) {
	die('Hacking attempt!');
}
$data->setthaotac = "phieuchi";
//=============================khoi tao ======================//  	 Xem  	 Them  	 Cap nhap  	 Tim  	Huy  	Khoa  	In

//	  echo $mquyen[2]."<br>";
//echo kiemtraquyenthumuc(2,"them") ; 
if (kiemtraquyenthumuc(10, "xem") == 0) {
	echo " <meta http-equiv='refresh'content='1;url=default.php'>";
	return;
}
if (kiemtraquyenthumuc(10, "them") == 0) {
	$template->assign("q_them", "none");
}
if (kiemtraquyenthumuc(10, "capnhap") == 1) {
	$template->assign("q_luu", "none");
}
if (kiemtraquyenthumuc(5, "tim") == 1) {
	$template->assign("q_tim", "none");
}
if (kiemtraquyenthumuc(10, "xoa") == 0) {
	$template->assign("q_huy", "none");
}
//	if (kiemtraquyenthumuc(5,"khoa")== false)    {  $template->assign("q_khoa","none");  }
if (kiemtraquyenthumuc(10, "in") == 0) {
	$template->assign("q_in", "none");
}
//	if (kiemtraquyenthumuc(12,"them")== false)      {  $template->assign("q_themc","none");  }
// 	if (kiemtraquyenthumuc(15,"them")== false)      {  $template->assign("q_themp","none");  }
//=======================================================================================	

$donglai = "none";
if (trim($_REQUEST["t5"]) != '')   $donglai = '';

// $sql = "select * from thuchich where   id=2";
// $tam=  getdong($sql); 

// echo htmlentities($tam['note'], ENT_QUOTES, "UTF-8") ;

//============= ==========================================================================
$template->assign("nganhang", compoloai("taikhoannganhang", "ma", "Name", 0, ""));

if ($_SESSION["LoginID"] == 1 || $_SESSION["LoginID"] == 2 || $_SESSION["LoginID"] == 179) {
	$template->assign("cuahang", composx("cuahang", "Name", "ID", " where ID>0 order by ID "));
	if ($_SESSION["loai_user"] == 6  || $_SESSION["LoginID"] == 1 || $_SESSION["LoginID"] == 179)    $template->assign("tatca", ' <option value="" >Tất cả</option>');
} else {   // $template->assign("kho",composx("cuahang","Name","ID"," where ID>1 order by ID ")); 	
	$template->assign("cuahang", composx("cuahang", "Name", "ID", " where ID= $_SESSION[se_kho]  order by ID "));
}


$template->assign("nhacungcap", composx("nhacungcap", "ID", "ID", " order by Name  "));
$i = $page_start;
$compocaydata = "";
// 	compocay("nhomthuchich","Name","IDGroup",0, 0,0,0);		 
$taocaydata = "";
// $template->assign("donvitinh",composx("donvi","Name",0,""));	
$template->assign("nguoinhants", compoloai("userac", "manv", "ten", 0, ""));


$template->assign("note2", ". Tên NCC:
. Địa chỉ:
. SĐT:
. Thời gian bảo hành:
. Tình trạng:
. Khác: ");
// $template->assign("cay",compoloai("taisannhom","ma","Name","","where 1 order by Name desc ")); 
// taocay("nhomthuchi","Name","ID","IDGroup",0,0,0,0,0);
$template->assign("loainhom", $taocaydata);
$template->assign("ngay", gmdate('d/m/Y', time() + 7 * 3600));
//	$template->assign("taikhoan",compoloai("taikhoan","ma","Name","","where 1=1 order by ma ")); 
$template->assign("tungay", gmdate('d/m/Y', time() + 7 * 3600));
$template->parse("main.block_thuchich");
