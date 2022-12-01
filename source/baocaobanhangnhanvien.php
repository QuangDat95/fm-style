<?php
session_start();
	if (!defined("IN_SITE"))
	{
    	die('Hacking attempt!');
	}
//=====================================================
 $idl=$_SESSION["LoginID"];
 $ql =$quyen[$_SESSION["mangquyenid"][$act]]  ;  
  if(!($ql[0]||$idl==1)) {echo "Bạn không có phân quyền"; exit; return ;}
 
 	   if($ql[1]>0||$idl==1)     {  $template->assign("q_luu","");   }  else {  $template->assign("q_luu","none");   }
	   if($ql[2]>0||$idl==1)     {  $template->assign("q_khoa","");   }   else {  $template->assign("q_khoa","none");   }	
	   if($ql[3]>0||$idl==1)     {  $template->assign("q_huy","");  } else {  $template->assign("q_huy","none");   }
	   if($ql[4]>0||$idl==1)     {  $template->assign("q_xoa","");  } else {  $template->assign("q_xoa","none");   }
//=====================================================	=======   
  		$tungay ="01/".gmdate('m', time() + 7*3600)."/".gmdate('Y', time() + 7*3600) ;
 		$denngay =gmdate('d/m/Y', time() + 7*3600) ;	$tungay = 	$denngay ;
 	    $template->assign("tungay",$tungay); 		
 	    $template->assign("denngay",$denngay); 		
		  $template->assign("IDNV", $idl); 		
		 
		  $template->assign("nganhhang",composx("nhomhang","Name",0,""));	 
		 
		 
	  $chikho = " where ID = '$_SESSION[se_kho]' "  ;
      $idkho=$_SESSION["se_kho"]  ; 
      if($ql[5]||$idl==1||$_SESSION["loai_user"]==16)
	  { 	
  		    $template->assign("nhanvien", compoloai("userac","ten","manv",0," where  tinhluong=1 ")  ."<option value=''>Tất cả</option>" );
       	
	
	
	  }    else   $template->assign("nhanvien", "<option value='$idl'>$idl</option>" ) ;
	  
 	       $template->assign("kho",composx("cuahang","Name",0,"$chikho"));		 	 	
 	    		$template->assign("lydo",composx("lydonhapxuat","Name",0," where loai=1"));   

 	    $template->parse("main.block_proht1"); 
 
  
?>