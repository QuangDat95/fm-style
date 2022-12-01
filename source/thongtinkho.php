<?php
session_start();
	if (!defined("IN_SITE"))
	{
    	die('Hacking attempt!');
	}
//=====================================================
 $data->setthaotac = "thongtinkho" 	;
 $ql =$quyen[$_SESSION["mangquyenid"][$act]]  ;  
 if(!($ql[0]||$idl==1)) { echo "Bạn không có phân quyền"; exit; return ; }
 
 	   if($ql[1]>0||$idl==1)     {  $template->assign("q_luu","");   }  else {  $template->assign("q_luu","none");   }
	   if($ql[2]>0||$idl==1)     {  $template->assign("q_khoa","");   }   else {  $template->assign("q_khoa","none");   }	
	   if($ql[3]>0||$idl==1)     {  $template->assign("q_huy","");  } else {  $template->assign("q_huy","none");   }
	   if($ql[4]>0||$idl==1)     {  $template->assign("q_xoa","");  } else {  $template->assign("q_xoa","none");   }
//=====================================================	   
function HTmuccon($idvao,$muccon,$group)
{	   
  		global $data,$tam,$kt;
		$kt = $muccon ;
 	    $sele = "selected" ; 
   		$sql = 	"select * from groupproduct where  ID <> 1 and IDGroup = '0".$idvao."'  order by ID" ;
		$result = $data->query($sql);			
 		$result_rows = $data->num_rows($result);	
		if ($result_rows > 0 )
		{	
			$kt = $kt + 1 ;
		} 
		$SOST = 0 ; 
		$result = $data->query($sql);	
		while($result_news = $data->fetch_array($result))		
		{   		
			$sss = "".$result_news["ID"] ;
			if ($group == $sss )				
			{
				$tam  = $tam."<option  value='".$result_news["ID"]."'  $sele >" ; 
			} 
			else
			{
				$tam  = $tam."<option value='".$result_news["ID"]."'>"; 
			}	 			
			for($i=1;$i<=$kt;$i++)
			{
				$tam  = $tam."&nbsp;&nbsp;&nbsp;&nbsp;" ;
			}
			$tam  = $tam.$result_news["Name"]."</option>\n" ;
			HTmuccon($result_news["ID"],$kt,$group)	;			
  		}
 }
//=======================================================
function HTCayThuMuc($group)
{			
  
		global $data,$tam;
 		$ketqua = "";
 		$sele = "selected" ;
   		$sql = 	"select * from groupproduct where ID <> 1 and  IDGroup = '0'  order by ID " ;
		$result = $data->query($sql); 	
 		$SOST = 0 ; 
 		while($result_news = $data->fetch_array($result))		
        {	 	 
			   $sss = $result_news["ID"] ;
   	           if ($group == $sss )
				{			
 					$tam  = $tam."<option $sele value='".$result_news["ID"]."'>".$result_news["Name"]."</option>\n";			
				}	
				else
				{ 
					$tam  = $tam."<option value='".$result_news["ID"]."'>".$result_news["Name"]."</option>\n";
				}		
  			 	 HTmuccon($sss,0,$group)	;			
 	      }
  	 return ;
}
 //============================================================
 
 	    HTCayThuMuc($IDGrouptk ) ;
    	$template->assign("cay",$tam);		
		$tungay ="01/".gmdate('m', time() + 7*3600)."/".gmdate('Y', time() + 7*3600) ;
		
		$denngay =gmdate('d/m/Y', time() + 7*3600) ;	$tungay = 	$denngay ;
 	    $template->assign("tungay",$tungay); 		
 	    $template->assign("denngay",$denngay); 		
		 
		  $template->assign("nganhhang",composx("nhomhang","Name",0,""));	 
		 
		 
	  $chikho = " where ID = '$_SESSION[se_kho]' "  ;
      $idkho=$_SESSION["se_kho"]  ;
      if($ql[5]||$idl==1||$_SESSION["loai_user"]==16)
	  { 	
	  		$template->assign("tatca","<option value='' >Tất cả</option>");
	       if($_SESSION["loai_user"]==16) $chikho = "  where   IDtinh =$idkho " ; else $chikho = "  where   ID >0" ;
	  }
	  
	  if($ql[0]&&$_SESSION["loai_user"]==18)
	  { 	
	  		$template->assign("tatca","<option value='' >Tất cả</option>");
	        if($_SESSION["loai_user"]==18) $chikho = "  where   NameN =$idkho " ;  
	  }
	  if($idl==7277) $themcuahang= "<option value='1137' >Online miền Nam</option>"; else $themcuahang= "";
    
	       $template->assign("kho",composx("cuahang","Name",0,"$chikho"). $themcuahang );		 	 	
 	    		$template->assign("lydo",composx("lydonhapxuat","Name",0," where loai=1"));   

 	    $template->parse("main.block_proht1"); 
 
  
?>