<?php
session_start();
$_SESSION["mangin"] =  "" ;
     if ( $_SESSION["dangnhap"] == "")  include($root_path."index.php");   
     $IDNV = $_SESSION["LoginID"] ;
if ($IDNV==1)  $template->parse("main.block_admin1");
	if (!defined("IN_SITE")) 	{    	die('Hacking attempt!');	}

    $idkho = $_SESSION["lg_kho"] ;
 	$template->assign("tenkho",$_SESSION["S_tencuahang"]); 
  
//=============================khoi tao ======================//  	 Xem  	 Them  	 Cap nhap  	 Tim  	Huy  	Khoa  	In
  	 
 	$data->setthaotac = "inma" 	;
	// echo $mquyen[1]."<br>";
	
	//echo kiemtraquyenthumuc(1,"them") ; 
 	
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
//=======================================================================================
   $thang = gmdate('m', time() + 7*3600); 
   $nam = gmdate('y', time() + 7*3600); 
   
  
//=======================================================================================
  
  $ten =$_SESSION["TenUser"] ; 
   $template->assign("ten",$ten); 
   
   
   

 $template->assign("IDNV",$IDNV);
 $template->parse("main.block_khoitao"); 

  printtree1(0, 1, 0 ,0,false); 	 
 $template->assign("cay",$Caytm);			
				
 $template->parse("main.block_luachon"); 

$mang = array(); 
$_SESSION['mang'] = $mang;
 
   $ngaytao = gmdate('d/m/Y', time() + 7*3600) ;
  $template->assign("ngaynhap",$ngaytao);
   $template->assign("tungay",$ngaytao);
 $template->parse("main.block_nhaptt"); 
 $template->parse("main.block_HH"); 
?>