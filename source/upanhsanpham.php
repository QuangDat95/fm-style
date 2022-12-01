<?php
session_start();
 

 //echo $_SESSION["MaNV"] ;
  $idk = trim($_SESSION["LoginID"]) ; 
  $ql =$quyen[$_SESSION["mangquyenid"][$act]]  ;  
  if(!($ql[0]||$idl==1)) {echo "Bạn không có phân quyền"; exit; return ;}
 
  if (!defined("IN_SITE")){   	die('Hacking attempt!');	}
  $idkho = $_SESSION["se_kho"] ;
  $kho = $_SESSION["S_tencuahang"] ;
  $template->assign("idkho",$idkho); 
  if($idkho!=1105)   {$template->assign("giahienthi","readonly");  $template->assign("ol","0");} else    $template->assign("ol","1");
    $template->assign("idk",$idk); 
 //=======================================================================================	
   	function printtree1($id_root, $level,$select_i,$idcall,$action)
	{			
		global $data, $Caytm;  
		$space="&nbsp;&nbsp;&nbsp;&nbsp;";
		$name1="";	 	
		for($i=1; $i<$level; $i++)
		{
			$name1.=$space;
		}
		$sql="SELECT Name,ID,IDGroup  FROM  groupproduct WHERE IDGroup='$id_root' and ID <> 0 order by Rank desc";
		
		if($result=$data->query($sql)){			
			while($result_news = $data->fetch_array($result))
			{
				$id = $result_news["ID"] ;
				if ($result_news["ChildID"] == "0") { $name1 = "" ; }
				$name=$name1."".$result_news["Name"];
				$select = "" ;
				 
				if ( trim($select_i) == trim($id) )
					{
						$select = "selected";	
 					}				 
				if (trim($idcall)!= trim($id) &&   $action ==false )
				   { $Caytm.="<option value='$id' $select>$name</option> ";}			
				   else
				   {	 $Caytm.= "<optgroup label='$name'></optgroup>" ; $action = true ;}
				printtree1($id, $level+1,$select_i,$idcall,$action);	
					 $action = false ;	 
			 }
		 }
	}
	if ($idk==1)  $template->parse("main.block_admin1"); 
//=======================================================================================
  
	
//=======================================================================================
 if ($_SESSION["dangnhap"] == "admin" && 1==2)
 {
//	$khon= "<option value='0'>Chọn Kho</option>".composx("kho","makho","Name","") ;
// 	 $template->assign("kho",$khon); 
	  $template->assign("kho",composx("kho","Name","","")); 
 }	
  	 else
 {
     $template->assign("kho",composx("kho","Name","$idkho","")); 
 	// $template->assign("kho","<option value='$idkho'>$kho</option>");
 }
 
 

  printtree1(0, 1, 0 ,0,false); 	 
 $template->assign("cay",$Caytm);			
				
 $template->parse("main.block_proht1"); 

?>