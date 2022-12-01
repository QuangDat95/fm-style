<?php
session_start();
	if (!defined("IN_SITE"))
	{ 
    	die('Hacking attempt!'); 
	}
 
 
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
		$result = mysql_query($sql) or $this->error("Could not query. ".mysql_error());	
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
		$tungay = gmdate('d/m/Y', time() + 7*3600-24*3600) ;
		//$denngay =gmdate('d/m/Y', time() + 7*3600) ;		
 	    $template->assign("tungay",$tungay); 		
 	    $template->assign("denngay",$denngay); 			 	
 	    $template->assign("kho",composx("cuahang","Name","ID"," where 1=1 order by ID ")); 	
 	    $template->parse("main.block_proht1"); 
 
  
?>