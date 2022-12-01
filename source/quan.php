<?php
if(session_status()==PHP_SESSION_NONE) session_start();
	if (!defined("IN_SITE"))
	{
    	die('Hacking attempt!');
	}
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php	
$template->assign("tinhthanh1",'<option value ="'.$result["ID"].'" selected>'.$result["Name"].' </option>');
//=============================================	
if ($_POST["cancel"]  != "")
{
	$ID = "" ;
	$_GET["id"] ="" ;
} 

if ($_POST["btnUpdate"]  != ""   )
{ 	
	     
	$ID   =		    $_GET["id"]  ;
	$Name =  	    $_POST["Name"]  ;
	
	$loai = " ";
	if($_POST["idquan1"] == 1){
		$loai = "Quận";
	}else{
		$loai = "Huyện";
	};

	$idtinh =  	    $_POST["idtinh"];

	if  ($_GET["id"] == "-1")
	{
	  $sql ="insert into quan1 (Name,loai,idtinh) values ('$Name ','$loai','$idtinh')";
	}else{

		$tinh = $_POST["tinhsl"];
	
	  $sql = "UPDATE  quan1  SET  Name ='$Name', loai  ='$loai' , idtinh  ='$idtinh' where ID='0$ID'" ;			
	}  
	 //echo $sql ;
	$update = $data->query($sql);
	$them = true;

 		
	 
}	

if ($_GET["Del"]  != "")
{ 
		$IDD = $_GET["Del"] ;
		$sql = "delete from  quan1  where ID = '0".$IDD."'" ;
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
		$sql = "SELECT ID FROM quan1 ";

		$sql_where=" where 1=1 ";
		if($NameS!="")
			$sql_where.=" and Name like '%".$NameS."%'";
		$sql.=$sql_where;
		error_reporting(E_ALL ^ E_NOTICE);
	 
		if ($them) {  $template->parse("main.block_cusupdate") ;} 
		//$SOST = 0 ;
	// phan trang===================================================================
	     $sql = "SELECT ID FROM quan1 $sql_where order by Name ";
 		$query_rows = $data->query($sql);
		$num=$data->num_rows($query_rows);	
	
	    $page_start=0;
		$page_row = 20 ;
		include("paging.php");
		$list_page=paging($num);	
		
		
		$sql = "SELECT quan1.ID as IDquan,quan1.Name as quan , tinh.Name as tinh, quan1.loai as loai
		from quan1
		inner join tinh on quan1.idtinh = tinh.ID 
		".$sql_where." ORDER BY quan1.ID desc , quan1.ID limit $page_start,$page_row ";
		
		// SELECT * FROM quan1 ".$sql_where." ORDER BY id desc, ID limit $page_start,$page_row ";

		// echo $sql;

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
			$template->assign("IDquan",$result_news["IDquan"]);
			$template->assign("stt", $SOST);
			$template->assign("idtinh",$result_news["idtinh"]);	
			$template->assign("Name", $result_news["Name"]);
			$template->assign("NameB", $result_news["quan"]);
			$template->assign("NameC", $result_news["tinh"]);
			$template->assign("NameD", $result_news["loai"]);
		
			
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

		}
		else		
		{
			$sql ="SELECT * FROM  quan1  WHERE ID='".$_REQUEST["id"]."'";
			$query = $data->query($sql);
			$result = $data->fetch_array($query);
				$template->assign("t-c","Cập nhập" );
				$template->assign("id",$result["ID"]);	
				$template->assign("Name",$result["Name"]);	
				$template->assign("idtinh",$result["idtinh"]);			
				$template->assign("loai",$result["loai"]);				
			    $template->assign("tinh",composx("tinh","Name",$result["idtinh"],""));

				$loai = 0;
				if($result["loai"]== 'Quận'){
					$loai1 = "selected = 'selected'" ; 
				}else if($result["loai"]== 'Huyện'){
					$loai2 = "selected = 'selected'"; 
				}

				$template->assign("loai1", $loai1 );
				$template->assign("loai2", $loai2 );
  		}
		
 	    $template->parse("main.block_kh");
	}
}
 $template->parse("main.block_ajack"); 
  $data->closedata() ;
?>

