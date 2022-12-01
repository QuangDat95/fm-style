<?php
session_start();
	if (!defined("IN_SITE"))
	{
    	die('Hacking attempt!'); 
	}
	 
   $data->setthaotac = "thongtinkho" 	;
 $ql =$quyen[$_SESSION["mangquyenid"][$act]]  ;  
 if(!($ql[0]||$idl==1)) {echo "Bạn không có phân quyền"; exit; return ;}	
//=============================khoi tao ======================//  	 Xem  	 Them  	 Cap nhap  	 Tim  	Huy  	Khoa  	In
 	$data->setthaotac = "thuchi" 	;
//	  echo $mquyen[2]."<br>";
	//echo kiemtraquyenthumuc(2,"them") ; 
    if (kiemtraquyenthumuc(10,"xem")==0)      {  echo " <meta http-equiv='refresh'content='1;url=default.php'>"; return ;}	
	if (kiemtraquyenthumuc(10,"them")== 0)    {  $template->assign("q_them","none");  }
	if (kiemtraquyenthumuc(10,"capnhap")== 1) {  $template->assign("q_luu","none");   }
	if (kiemtraquyenthumuc(5,"tim")== 1)      {  $template->assign("q_tim","none");   }
	if (kiemtraquyenthumuc(10,"xoa")== 0)     {  $template->assign("q_huy","none");   }
//	if (kiemtraquyenthumuc(5,"khoa")== false)    {  $template->assign("q_khoa","none");  }
	if (kiemtraquyenthumuc(10,"in")== 0)      {  $template->assign("q_in","none");  }
	
//	if (kiemtraquyenthumuc(12,"them")== false)      {  $template->assign("q_themc","none");  }
// 	if (kiemtraquyenthumuc(15,"them")== false)      {  $template->assign("q_themp","none");  }
 //=======================================================================================	

 $donglai = "none" ;
if (trim($_REQUEST["t5"]) != '')   $donglai = '' ;

 

  					 	
  
		$i = $page_start; 
		$compocaydata = "" ;
		compocay("nhomthuchi","Name","IDGroup",0, 0,0,0);		 
   	    $template->assign("loainhom",$compocaydata); 		
		$template->assign("ngay", gmdate('d/m/Y', time() + 7*3600) ); 		
		$template->assign("tungay", gmdate('d/m/Y', time() + 7*3600) ); 	
		$template->assign("toingay", gmdate('d/m/Y', time() + 7*3600) ); 
		
		 if($ql[5]||$idl==1)  
		 {  	  $template->assign("cuahang",composx("cuahang","Name","ID"," where ID>0 order by ID ")); 	
		
			 
		         $template->assign("tatca",' <option value="" >Tất cả cửa hàng</option>' ) ;
		 }else
 		 {   // $template->assign("kho",composx("cuahang","Name","ID"," where ID>1 order by ID ")); 	
			  $template->assign("cuahang",composx("cuahang","Name","ID"," where ID= $_SESSION[se_kho]  order by ID ")); 
		 }	
		
		if($_SESSION["loai_user"]==16)
		{ 
			$template->assign("cuahang",composx("cuahang","Name","ID"," where IDtinh=$_SESSION[se_kho] order by ID ")); 	
 		         $template->assign("tatca",' <option value="" >Tất cả cửa hàng</option>' ) ;
		}
	 
      $template->parse("main.block_thuchich");



   
?>