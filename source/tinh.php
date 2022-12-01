<?php
if(session_status()==PHP_SESSION_NONE) session_start();
	if (!defined("IN_SITE"))
	{
    	die('Hacking attempt!');
	}
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php	

$template->assign("tinh",composx("tinh","Name",$result["IDKhuVuc"],""));
$template->assign("quan",composx("quan","Name",$result["quan"],""));
$template->assign("phuong",composx("phuong","Name",$result["phuong"],""));
$template->assign("duong",composx("duong","Name",$result["duong"],""));

//=============================================	
if ($_POST["cancel"])
{
	$ID = "" ;
	$_GET["id"] ="" ;
} 
 
if ($_POST["btnUpdate"])
{ 	
	     
		$ID   =		    $_GET["id"]  ;
		$Name =  	    $_POST["Name"]  ;
		$ma =  	        $_POST["ma"]  ;
		$Rank =  	    $_POST["Rank"]  ;
 		 

		if  ($_GET["id"] == "-1")
		{
		  $sql ="insert into tinh  (Name,ma,Rank) values ('$Name ','$ma','$Rank')";
		} 
		else
		{
		  $sql = "UPDATE  tinh  SET  Name ='$Name', ma  ='$ma' , Rank  ='$Rank' where ID='0$ID'" ;			
		}  
	 	//echo $sql ;
		$update = $data->query($sql);
		$them = true;
 
 		
	 
}	

if ($_GET["Del"])
{ 
		$IDD = $_GET["Del"] ;
		$sql = "delete from  tinh  where ID = '0".$IDD."'" ;
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
		$sql = "SELECT ID FROM tinh ";

		$sql_where=" where 1=1 ";
		if($NameS!="")
			$sql_where.=" and Name like '%".$NameS."%'";
		$sql.=$sql_where;
		// echo $sql;
		error_reporting(E_ALL ^ E_NOTICE);
	 
		if ($them) {  $template->parse("main.block_cusupdate") ;} 
		//$SOST = 0 ;
	// phan trang===================================================================
	     $sql = "SELECT ID FROM tinh $sql_where order by Name ";
 		$query_rows = $data->query($sql);
		$num=$data->num_rows($query_rows);	
	
	    $page_start=0;
		$page_row = 20 ;
		include("paging.php");
		$list_page=paging($num);	
		
		
		$sql = "SELECT * FROM tinh ".$sql_where." ORDER BY Rank desc, ID limit $page_start,$page_row ";
		echo $sql;
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
			$template->assign("Name", $result_news["Name"]);
			 $template->assign("ma", $result_news["ma"]); 
			
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

		}
		else		
		{
			$sql ="SELECT * FROM  tinh  WHERE ID='".$_REQUEST["id"]."'";
			$query = $data->query($sql);
			$result = $data->fetch_array($query);
				$template->assign("t-c","Cập nhập" );
				$template->assign("Name",$result["Name"]);				
				$template->assign("ma",$result["ma"]);			
				$template->assign("Rank",$result["Rank"]);	
  		}
		
 	    $template->parse("main.block_kh");
	}
}
 $template->parse("main.block_ajack"); 
  $data->closedata() ;
?>
