<?php
 if ($_SESSION["dangnhap"]=="") return ;
 
$IDTao = $_SESSION["LoginID"]  ;
$data->setthaotac = "tailendata" 	;
//if(!($IDTao ==1||$IDTao ==486|| $IDTao ==7068)) { echo "Bạn không có phân quyền !";  return ; }
//=================================
$chucnang= $_SESSION["act"] ; 
$quyen= $_SESSION["quyen"] ; 
$ql =$quyen[$_SESSION["mangquyenid"][$act]]  ;  
 
  
//if( $ql[0]!=1  ){return;} 
//=================================
	if (!defined("IN_SITE")) 	{    	die('Hacking attempt!');	}
	 
 //=============================khoi tao ======================//  	 Xem  	 Them  	 Cap nhap  	 Tim  	Huy  	Khoa  	In
      
 //=======================================================================================	
        $tungay ="01/".gmdate('m', time() + 7*3600)."/".gmdate('Y', time() + 7*3600) ;
		
		$denngay =gmdate('d/m/Y', time() + 7*3600) ; 
 	    $template->assign("tungay",$tungay); 		
 	    $template->assign("denngay",$denngay); 		
		
 
 
 
  
   
?>