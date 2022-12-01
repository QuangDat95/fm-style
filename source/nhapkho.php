<?php
if(session_status()==PHP_SESSION_NONE) session_start();
	if (!defined("IN_SITE"))
	{
    	die('Hacking attempt!');
	}
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php	

//=============================================	
if ($_POST["cancel"]  ?? "")
{
	$ID = "" ;
	$_GET["id"] ="" ;
} 
 
if ($_POST["btnUpdate"]  ?? ""   )
{ 	
	     
		$ID   =		    $_GET["id"]  ;
		$_name =  	    $_POST["_name"]  ;
		$idquan =  	        $_POST["idquan"]  ;
	$idtinh =  	    $_POST["idtinh"]  ;
	$idphuong =  	    $_POST["idphuong"]  ;
	
		if  ($_GET["id"] == "-1")
		{
		  $sql ="insert into street  (_name,idquan,idtinh,idphuong) values ('$_name ','$idquan','$idtinh','$idphuong')";
		} 
		else
		{
		  $sql = "UPDATE  street  SET  _name ='$_name', idquan  ='$idquan' , idtinh  ='$idtinh' , idphuong  ='$idphuong' where ID='0$ID'" ;			
		}  
	 	//echo $sql ;
		$update = $data->query($sql);
		$them = true;
 
 		
	 
}	

if ($_GET["Del"]  ?? "")
{ 
		$IDD = $_GET["Del"] ;
		$sql = "delete from  street  where ID = '0".$IDD."'" ;
		$update = $data->query($sql);
		$xoa = true ;
}	

{
 	$tam = "" ;
	$kt = 0 ;	
	error_reporting(E_ALL ^ E_NOTICE);
	if ($_REQUEST["id"] == "" || $them  || $xoa )
	
	{
		error_reporting(E_ALL ^ E_NOTICE);
		$NameS = chonghack($_POST["NameS"]) ;
		
		$template->assign("NameS",$NameS);
		
  	    $template->parse("main.block_khht1"); 
		$sql = "SELECT ID FROM street ";

		$sql_where=" where 1=1 ";
		if($NameS!="")
			$sql_where.=" and _name like '%".$NameS."%'";
		$sql.=$sql_where;
		error_reporting(E_ALL ^ E_NOTICE);
	 
		if ($them) {  $template->parse("main.block_cusupdate") ;} 
		//$SOST = 0 ;
	// phan trang===================================================================
	     $sql = "SELECT ID FROM street $sql_where order by Name ";
 		$query_rows = $data->query($sql);
		$num=$data->num_rows($query_rows);	
	
	    $page_start=0;
		$page_row = 20 ;
		include("paging.php");
		$list_page=paging($num);	
		
		
		$sql = "SELECT * FROM street ".$sql_where." ORDER BY id desc, ID limit $page_start,$page_row ";

		$query_rows = $data->query($sql);
		$result_rows = $data->num_rows($query_rows);
		$result = $data->query($sql);
		$i = $page_start; 
//=========================================================
       $SOST = $page_start; 
		while($result_news = $data->fetch_array($result))		
		{  
			if($mau == "white")
				$mau = "#EEEEEE";
			else
			$mau = "white";
			$SOST = $SOST + 1 ;			
			$template->assign("color", $mau);
			$template->assign("ID",$result_news["ID"]);
			$template->assign("stt", $SOST);
			$template->assign("_name", $result_news["_name"]);
			$template->assign("idquan", $result_news["idquan"]);
			$template->assign("idtinh", $result_news["idtinh"]);
			$template->assign("idphuong", $result_news["idphuong"]);
			
		  $template->parse("main.block_khht"); 
	  	  $template->parse("main.block_khht2"); 
		     	$i++; 
		 } 
	 
			$template->assign("list_page",$list_page);  // phan trang
			 $template->parse("main.block_proht2"); 	 
		  
	}
	 else	
	{ 
		
		if ($_REQUEST["id"] == "-1")
		{ 
		   $template->assign("t-c","Thêm mới  " );
		   $template->assign("idgoi",$_POST["id"]);
		    $template->assign("tinh",composx("tinh","Name",$result["ID"],""));
			$template->assign("quan",composx("quan","Name",$result["ID"],""));
			$template->assign("phuong",composx("phuong","Name",$result["ID"],""));
		}
		else		
		{
			$sql ="SELECT * FROM  street  WHERE ID='".$_REQUEST["id"]."'";
			$query = $data->query($sql);
			$result = $data->fetch_array($query);
				$template->assign("t-c","Cập nhập" );
				$template->assign("_name",$result["_name"]);		
				$template->assign("idquan",$result["idquan"]);			
				$template->assign("idtinh",$result["idtinh"]);	
				$template->assign("idphuong",$result["idphuong"]);			
				$template->assign("quan",composx("quan","Name",$result["ID"],""));
				$template->assign("phuong",composx("phuong","Name",$result["ID"],""));
			    $template->assign("tinh",composx("tinh","Name",$result["ID"],""));
  		}
		
 	    $template->parse("main.block_kh");
	}
}
 $template->parse("main.block_ajack"); 
  $data->closedata() ;
?>
