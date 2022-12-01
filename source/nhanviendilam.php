<?php
session_start();

$IDTao = $_SESSION["LoginID"];

     $_SESSION["frm_xuathang"] = "" ;
	if (!defined("IN_SITE")) 	{    	die('Hacking attempt!');	}
		 
 //if (kiemtradienthoai()==1)  return ;
 $posiphone=strpos($_SERVER['HTTP_USER_AGENT'],"iPhone")   ;
// echo $_SERVER['HTTP_USER_AGENT'] ;
 
 //echo $posiphone ;
 $pos=strpos($_SERVER['HTTP_USER_AGENT'],"Window")   ;
 
 

   $template->parse("main.block_proht1");  
//=============================khoi tao ======================//  	 Xem  	 Them  	 Cap nhap  	 Tim  	Huy  	Khoa  	In
 	$data->setthaotac = "khachhang" 	;
//	  echo $mquyen[2]."<br>";
	//echo kiemtraquyenthumuc(2,"them") ; 
 
//	if (kiemtraquyenthumuc(12,"them")== false)      {  $template->assign("q_themc","none");  }
// 	if (kiemtraquyenthumuc(15,"them")== false)      {  $template->assign("q_themp","none");  }
 //=======================================================================================	

 $donglai = "none" ;
if (trim($_REQUEST["t5"]) != '')   $donglai = '' ;
  //============= ==========================================================================

 if($_POST["cancel"] != "")
{
	$ID = "" ;
	$_GET["id"] ="" ;
}
 
if ($_POST["btnUpdate"] != ""   )
{ 	
	     
		$ID   =		   chonghack($_GET["id"]) ;
		$Name =  	   chonghack($_POST["Name"]) ;
		$address = 	   chonghack($_POST["address"]) ;
		$NameN   = 	   khongdau($Name);
		$addressN =    khongdau($address) ;
 		$type =  	   chonghack($_POST["type"]) ;
		$tel =  	   chonghack($_POST["tel"]) ;
		$mobile =  	   chonghack($_POST["mobile"]) ;
		$Fax =  	   chonghack($_POST["Fax"]) ;
 		$email= 	   chonghack($_POST["email"]) ;
		$website =     chonghack($_POST["website"]) ;
		$note =  	   chonghack($_POST["note"]) ;
		$MST =  	   chonghack($_POST["MST"]) ;							
		$STK =  	   chonghack($_POST["STK"]) ;		
		$nganhang =    chonghack($_POST["nganhang"]) ;		
		$cmnd =        chonghack($_POST["cmnd"]) ;		
		$makh =        chonghack($_POST["makh"]) ;		
		$IDCuaHang  = $_SESSION["se_kho"] ;
		 
		$sokhung =     chonghack($_POST["sokhung"]) ;		
		$mauson =      chonghack($_POST["mauson"]) ;		
		$model =       chonghack($_POST["model"]) ;		
		$IDKhuVuc =      chonghack($_POST["IDKhuVuc"]) ;	
		$nhomkh =      chonghack($_POST["nhomkh"]) ;	
		$xungho =      laso($_POST["xungho"]) ;	
		$ngaysinh =   chonghack($_POST["ngaysinh"]) ;
		$diemtichluy =   chonghack(str_replace(",","",$_POST["diemtichluy"]) ) ;
		
	    $ngay=  explode('/',$ngaysinh);
   		 if (strlen($ngay[1])== 1) {  $ngay[1] = "0".$ngay[1] ;  }
	 	 if (strlen($ngay[0])== 1) {  $ngay[0] = "0".$ngay[0] ;  }
 		$ngaysinh = $ngay[2]."-". $ngay[1]."-". $ngay[0] ;	 	
		 $ngaytao = date('Y/n/d H:i:s');
}	

  // $del =  laso($_GET["Del"]); 
  // $ktxoa = kiemtraxoa("phieunhapxuat","IDNhaCC"," where  IDNhaCC ='$del'  limit 0,1 ") ;
  // $ktxoa1 = kiemtraxoa("baogia","MaKH"," where  MaKH ='$del'  limit 0,1 ") ;
  	if ($ktxoa == 1  || $ktxoa1 == 1)
  	{
 		$template->parse("main.block_khongxoa");
  	}
	if ( $del != "" && kiemtraquyenthumuc(10,"xoa")== "1" && $ktxoa == 0 && $ktxoa1 == 0)
	{ 
 		$IDD = $_GET["Del"] ;
		$sql = "delete from  customer where ID = '0".$IDD."'" ;
		$update = $data->query($sql);
		$xoa = true ;
	}	


 	$tam = "" ;
	$kt = 0 ;	
	if ($_REQUEST["id"] == "" || $them  || $xoa ||  $_POST["search"] != "" )
	{

		$NameS = chonghack($_POST["NameS"]) ;
		$nhom = chonghack($_POST["nhom"]) ;
		$kv = chonghack($_POST["kv"]) ;
		$dt = chonghack(trim($_POST["dt"])) ;
		$cm = chonghack(trim($_POST["cm"])) ;
		
		$template->assign("NameS",$NameS);
		
		$typencc=chonghack($_POST["type"])."";
		if($typencc=="0")	{ $ch0="selected";	}		
		if($typencc=="1")	$ch1="selected";
		if($typencc=="2")	$ch2="selected";				
		
		$nhacungcap='<select name="type">
						<option value="" >Tất cả</option>
						<option value="0" '.$ch0.'>Xe</option>
						<option value="1" '.$ch1.'>Công ty</option>						
						<option value="2" '.$ch2.'>Cá Nhân</option>
					</select> ';

		$template->assign("type", $nhacungcap);		

  	    $template->parse("main.block_cusht1"); 
		$sql = "SELECT ID FROM customer ";

		$sql_where=" where 1=1 ";
		if($NameS!="")
			$sql_where.=" and Name like '%".$NameS."%' ";
		if($nhom!="")
			$sql_where.=" and nhomkh =  '".$nhom."' ";		
		if($kv!="")
			$sql_where.=" and IDKhuVuc=  '".$kv."' ";						
		if($typencc!="")
			$sql_where.=" and type='".$typencc."'";
		if($cm!="")
				$sql_where.=" and cmnd like'%".$cm."%'";
		if($dt!="")
			$sql_where.=" and mobile='%".$dt."%'";			
		$sql .=$sql_where;
		
   
	
	// phan trang===================================================================
   	 }
	


 	//if ( !($_SESSION["se_kho"] ==1 && $_SESSION["loai_user"] ==6 )  )   $template->parse("main.block_kt");    
 	$template->parse("main.block_ajack"); 
  
?>