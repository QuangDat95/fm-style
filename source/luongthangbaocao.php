<?php
session_start();
	if (!defined("IN_SITE"))
	{
    	die('Hacking attempt!'); 
	}
 if (!($idl==1||$idl ==7194||$idl ==5794  ))  {  echo " <meta http-equiv='refresh'content='1;url=default.php'>";	 return ;  }

 //=============================khoi tao ======================//  	 Xem  	 Them  	 Cap nhap  	 Tim  	Huy  	Khoa  	In
 	$data->setthaotac("luongthangbaocao") 	;
  //=======================================================================================	

 $donglai = "none" ;
if (trim($_REQUEST["t5"]) != '')   $donglai = '' ;

 		 for ($i=12;$i>=1;$i--)
		 {
			 if ($i== $thangtim)$template->assign("thangse","selected");else $template->assign("thangse","");
			  $template->assign("thangt",$i);	
			  $template->parse("main.block_thang") ;
		 }
		 
		 $nam = gmdate('Y', time() + 7*3600)  ;
		 for ($i= $nam;$i>= $nam-5;$i--)
		 {     if ($i== $namtim)$template->assign("namse","selected");else $template->assign("namse","");
			  $template->assign("namt",$i);	
			  $template->parse("main.block_nam") ;
		 }		
		 
 $template->assign("chucvu",  composx("kh_chucvu","Name",0,""))  ;
  $template->assign("cuahang",  composx("cuahang","Name",0,""))  ;
  					 	
   
 


   
?>