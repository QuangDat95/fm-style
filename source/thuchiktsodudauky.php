<?php
session_start();
if ($_SESSION["dangnhap"]=="") return ;
$IDTao = $_SESSION["LoginID"]  ;
 
     $_SESSION["frm_xuathang"] = "" ;
	if (!defined("IN_SITE")) 	{    	die('Hacking attempt!');	}
	 
 //echo "ok";
//=============================khoi tao ======================//  	 Xem  	 Them  	 Cap nhap  	 Tim  	Huy  	Khoa  	In
 	$data->setthaotac = "customer" 	;
//=====================================================
  $ql =$quyen[$_SESSION["mangquyenid"][$act]]  ;  
 if(!($ql[0]||$idl==1)) {echo "Bạn không có phân quyền"; exit; return ;}
 
 	   if($ql[1]>0||$idl==1)     {  $template->assign("q_luu","");   }  else {  $template->assign("q_luu","none");   }
	   if($ql[2]>0||$idl==1)     {  $template->assign("q_khoa","");   }   else {  $template->assign("q_khoa","none");   }	
	   if($ql[3]>0||$idl==1)     {  $template->assign("q_huy","");  } else {  $template->assign("q_huy","none");   }
	   if($ql[4]>0||$idl==1)     {  $template->assign("q_xoa","");  } else {  $template->assign("q_xoa","none");   }
//=====================================================	   

 $donglai = "none" ;
if (trim($_REQUEST["t5"]) != '')   $donglai = '' ;

  
	
	
  //============= ==========================================================================
 
  
 
 if ($_POST["cancel"] != "")
{
	$ID = "" ;
	$_GET["id"] ="" ;
} 


////++++++++++++++++++update
if ($_POST["btnUpdate"] != ""   )
{ 	
	     
		$ID   =		   chonghack($_GET["id"]) ;
		 $IDch = 	   $_POST["cuahang"] ;
		$ma =  	getten("cuahang",$IDch,"macuahang");
		$ten =  	getten("cuahang",$IDch,"Name");
		$madk =  	getten("dinhkhoanthuchi","DK","ID");
		echo $madk;
		$ngaytao=date("Y-m-d H:m:s");
	 	
	 	  $soddk = 	  laso($_POST["soddk"]);
		
		if  ($_GET["id"] == "-1")
		{
		 
		  	$sql ="insert into thuchikt set  ma='', ten='$ten',IDch='$IDch',soddk='$soddk',ngaytao='$ngaytao'";
		  
		} 
		else
		{
	 		$sql ="Update  thuchikt set  ma='$ma', ten='$ten',IDch='$IDch',soddk='$soddk',ngaytao='$ngaytao' where ID='0$ID'";
		  
		
			$them = true;
 
		}
		  $update = $data->query($sql);
	  if($update){
		 	header("location: default.php?act=thuchiktsodudauky");
		 }
}	

    $del =  laso($_GET["Del"]); 
 
  if ($ktxoa == 1  || $ktxoa1 == 1)
  {
 	 $template->parse("main.block_khongxoa");
  }
  $IDD = $_GET["Del"] ;
  if($IDD){
  		$sql ="delete from thuktsodudauky where ID='$IDD'";
		 $update = $data->query($sql);
		 if($update){
		 	header("location: default.php?act=thuchiktsodudauky");
		 }
  }
	if ($_REQUEST["id"] == ""  || $them  || $xoa ||  $_POST["search"] != "" )
	{    
		
		$cuahang=compoloai("cuahang","macuahang","Name","","");
		$template->assign("cuahang",$cuahang);
		$CuahangS = laso($_POST["cuahangs"]) ;
		
		$template->assign("CuahangS",$CuahangS);
		
  	    $template->parse("main.block_cusht2.block_cusht1"); 
	

		$sql_where=" where 1=1 ";
		if($CuahangS!="")
			$sql_where.=" and a.IDch = '$CuahangS' ";
			
		
		$sql = "SELECT a.*,DATE_FORMAT(a.ngaytao,'%d/%m/%Y %H:%i:%s') as ngayt FROM thuktsodudauky a ".$sql_where." ORDER BY ma desc ";
		
		$result = $data->query($sql);
//=========================================================
 
		while($result_news = $data->fetch_array($result))		
		{  
 
				if($mau == "white")
					$mau = "#EEEEEE";
				else
				$mau = "white";
							
				$template->assign("color", $mau);
				$template->assign("ID",$result_news["ID"]);
				$template->assign("stt", $i+1);
				$template->assign("ten", $result_news["ten"]);
				$template->assign("soddk",$result_news["soddk"]);
				$template->assign("ma",$result_news["ma"]);
			$template->assign("ngayt",$result_news["ngayt"]);
   			    $template->parse("main.block_cusht2.block_cusht"); 
		     	$i++; 
		}	
			
		  $template->parse("main.block_cusht2"); 
 	}
	else{
		$idch='';
		if($_REQUEST["id"]!=-1){
			$sql = "SELECT a.* FROM thuktsodudauky a where ID='$_REQUEST[id]'";
			
			$result = $data->query($sql);
			$result_news = $data->fetch_array($result);
				
			$template->assign("soddk",$result_news["soddk"]);
			$template->assign("ma",$result_news["ma"]);
			$idch=$result_news["IDch"];
		}
		$cuahang=compoloai("cuahang","macuahang","Name",$idch,"");
		$template->assign("cuahang",$cuahang);
		 $template->parse("main.block_cusht3"); 
	}
   
   
 function taomangtaikhoan(){
 	global $data;
 	$sql ="SELECT count(a.loai) as loai,a.loai as l,a.madinhkhoan FROM dinhkhoan a
group by madinhkhoan";
 	$query=$data->query($sql);
	$mang=[];
	while($row = $data->fetch_array($query)){
		if($row['l']==3){
			$mang[$row['madinhkhoan']]=$row['l'];
		}
		else{
		
		$mang[$row['madinhkhoan']]=$row['loai'];
		}
	}
	
	return $mang;
 }
?>