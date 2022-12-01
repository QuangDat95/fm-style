<?php
session_start();
 
     if ( $_SESSION["dangnhap"] == "") { include($root_path."index.php");   return ; }
     
	if (!defined("IN_SITE"))	{  	die('Hacking attempt!');	}
//=============================khoi tao ======================//  	 Xem  	 Them  	 Cap nhap  	 Tim  	Huy  	Khoa  	In
 	$data->setthaotac = "giamgiacuahang" 	;
     if (kiemtraquyenthumuc(2,"xem")== false)     {  echo " <meta http-equiv='refresh'content='1;url=default.php'>"; return ;}	
	if (kiemtraquyenthumuc(2,"them")== false)    {  $template->assign("q_them","none");  }
	if (kiemtraquyenthumuc(2,"capnhap")== false) {  $template->assign("q_luu","none");   }
	if (kiemtraquyenthumuc(2,"tim")== false)     {  $template->assign("q_tim","none");  }
	if (kiemtraquyenthumuc(2,"xoa")== false)     {  $template->assign("q_huy","none");  }
	if (kiemtraquyenthumuc(2,"khoa")== false)    {  $template->assign("q_khoa","none");  }
	if (kiemtraquyenthumuc(2,"in")== false)      {  $template->assign("q_in","none");  }
 	if (kiemtraquyenthumuc(12,"them")== false)      {  $template->assign("q_themc","none");  }
//	if (kiemtraquyenthumuc(15,"them")== false)      {  $template->assign("q_themp","none");  }
 //=======================================================================================	
	  
      $idtao = $_SESSION["LoginID"] ;
      $ten = $_SESSION["dangnhap"] ; 
      $template->assign("ten",$ten); 
	  $tg=gmdate('ymd', time() + 7*3600);
	  
	  $tam = getdong("select count(ID)as st from luanchuyen where  DATE_FORMAT( ngaychuyen, '%y%m%d' )='$tg' ");
 
	  $sophieuchuyen= "LC". $tg."_".(laso($tam['st'])+1) ;   
	  $template->assign("sophieuchuyen",$sophieuchuyen); 
	  
	  $template->assign("cuahangnhan",composx("cuahang","Name",0,""));		
	   $template->assign("cuahangchuyen",composx("cuahang","Name",0,""));  
	  
   // $template->assign("mangj",taomangj("thongtinxe","soxe","makh"," where ltrim(soxe) <> '' "));
   // $template->assign("loaibinhb",compochung("select ID,Name from products where status = 1 order by Rank desc ","")); 

//=======================================================================================
   return ;
   $sql = "select * from cuahang where ID='0$idu'  or IDcha=0$idu order by ID=0$idu desc " ;
	 //  $result = $data->query($sql);
	   while($result_news = $data->fetch_array($result))
		 {  $st++;
		 }
		 
		 return ;
//=======================================================================================
   $thang = gmdate('m', time() + 7*3600); 
   $nam = gmdate('Y', time() + 7*3600); 
   $sql = "select  count(SoCT) as sp from phieunhapxuat  where loai ='1' and  mid(SoCT,7,2) = '$thang' " ;
   $kq = $data->truyvan($sql) ;		
   $sp = $kq['sp'] + 1 ;
   if (strlen($sp)== '1' ) $sp = "00". $sp ;
   if (strlen($sp)== '2' ) $sp = "0". $sp ;
   $sochungtu = "XK".$nam.$thang."_".$sp ;  
   $template->assign("sochungtu",$sochungtu); 
 //=======================================================================================  


 if ($_SESSION["dangnhap"] == "admin" && 1==2)
 {
 	  $template->assign("kho",composx("kho","makho","Name","")); 
 }	
  	 else
 {
     $template->assign("kho",composx("kho","Name","$idkho","")); 
  }
  $template->assign("lydonhap",compoloai("lydonhapxuat","ma","Name","","where Loai = '1' order by Rank desc ")); 
   $ten = $_SESSION["TenUser"] ; 
   $template->assign("ten",$ten); 
   
  //$template->assign("songayno",composx("songayno","Loai","LoaiNo",""));   
   
   $template->assign("nhacungcap",composx("customer","Name","ID"," order by NameN")); 
  //$template->assign("taikhoanno",compoloai("taikhoanghico","ma","Name","","2")); 
 // $template->assign("tinh",compo("tinh","Name","")); 


  
  

  
   
 $IDNV = $_SESSION["LoginID"] ;
 $template->assign("IDNV",$IDNV);
 $template->parse("main.block_khoitao"); 

  printtree1(0, 1, 0 ,0,false); 	 
 $template->assign("cay",$Caytm);			
 
$template->assign("nhomkh",composx("nhomkhachhang","Name",$_REQUEST["nhom"],"Rank")); 

 $template->parse("main.block_luachon"); 

  
   
    $ngaytao = gmdate('d/m/Y', time() + 7*3600) ;
  $template->assign("ngaynhap",$ngaytao);
  $template->assign("khuvuc",composx("tinh","Name",0,"Rank")); 
 $template->parse("main.block_nhaptt"); 
 $template->parse("main.block_HH"); 
?>