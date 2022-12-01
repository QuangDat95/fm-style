<?php
session_start();
	if (!defined("IN_SITE"))
	{
    	die('Hacking attempt!');
	}
 $ID=  $_SESSION["LoginID"] ;
//========================================== 
   $ql =$quyen[$_SESSION["mangquyenid"][$act]]  ;  
 if(!($ql[0]||$idl==1)) {echo "Bạn không có phân quyền"; exit; return ;}
//========================================== 
   $template->assign("nhacc",composx("nhacungcap","Fax",0," where Fax<>''  ")); 
$template->assign("nganhhang",composx("nhomhang","Name",0,""));	 
  
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
     	 $result=$data->query($sql);		
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
 
 
 	  $chikho = " where ID = '$_SESSION[se_kho]' "  ;
	  $idkho=$_SESSION["se_kho"]  ;
 
      if($ql[5]||$idl==1||$_SESSION["loai_user"]==16||$_SESSION["loai_user"]==18)
	  { 	
 	  		$template->assign("tatca","<option value='' >Tất cả</option>");
	       if($_SESSION["loai_user"]==16) $chikho = "  where   IDtinh =$idkho " ; 
		    else if($_SESSION["loai_user"]==18) $chikho = "  where   NameN =$idkho " ;  
 			else $chikho = "  where   ID >0" ;
			if( $idl== 9901 ) $chikho = "" ;
			 
	  } 
  	  if($_SESSION["loai_user"]==8 || $idl==1|| $idl==6990) $template->assign("nhacc",compoloai("nhacungcap","Fax","Name",0," where 1 " )); 
		
	  if($ql[5]||$idl==1) { $template->assign("tatcakv",composx("khuvuc","Name",0,"$khuvuc")); $template->assign("hienthikhuvuc","");
 	       
   
        
	  //==========mieen=========================
		  if($idl==7577 ||$idl==1||$idl==4647 ||$idl==9296 ||$idl== 9901  )
		  {
			$sql = 	"select * from mien     " ;  $chuoi='';
			 $result=$data->query($sql);		
			$SOST = 0 ; 
			while($re = $data->fetch_array($result))		
			{	 	 
				   $chuoi .= "<option value='-$re[ID]' >( $re[Name] )</option> "  ;
				   
			}
		   $template->assign("mien",$chuoi); 
	     //==========mieen=========================
		 }
	  }	  
	  else 	  {  $template->assign("hienthikhuvuc",""); 	  }
	  
	  if($ql[0] && $_SESSION["loai_user"]==16)   { $template->assign("tatcakv",composx("khuvuc","Name",$_SESSION['se_kho']," where id= $_SESSION[se_kho]")); }
	  
	   
	    $template->assign("kho",composx("cuahang","Name",0,"$chikho"));		 	 
		$template->assign("lydo",composx("lydonhapxuat","Name",0," where loai=1"));   
		  
		 
		 
 	    HTCayThuMuc($IDGrouptk ) ;
    	$template->assign("cay",$tam);		
		$tungay ="01/".gmdate('m', time() + 7*3600)."/".gmdate('Y', time() + 7*3600) ;
		$denngay =gmdate('d/m/Y', time() + 7*3600) ;		
 	    $template->assign("tungay",$denngay); 		
 	    $template->assign("denngay",$denngay); 			 	
 	  
 	    $template->parse("main.block_proht1"); 
 
  
?>