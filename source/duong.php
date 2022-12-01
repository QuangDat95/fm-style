<?php
if(session_status()==PHP_SESSION_NONE) session_start();
	if (!defined("IN_SITE"))
	{
    	die('Hacking attempt!');
	}
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php	
$template->assign("tinh",composx("tinh","Name",$result["stinh"],""));
$template->assign("quan",composx("quan","Name",$result["squan"],""));
$template->assign("phuong",composx("phuong","Name",$result["sphuong"],""));
// $template->assign("street",composx("street","Name",$result["sduong"],""));
//=============================================	
if (isset($_POST['view'])) {
	header("Content-Type', application/pdf");
	readfile("templates/QUOC.pdf");
}


if ($_POST["cancel"]  != "")
{
	$ID = "" ;
	$_GET["id"] ="" ;
} 
 
if ($_POST["btnUpdate"]  != ""   )
{ 	
	     
	$ID           =		$_GET["id"]  ;
	$Name         =  	$_POST["Name"]  ;
	$idquan      =  	$_POST["idquan"]  ;
	$idtinh 		=  	$_POST["idtinh"]  ;
	$idphuong 		=  	$_POST["idphuong"]  ;
	$loai =  			$_POST["loai"]  ;
	
		if  ($_GET["id"] == "-1")
		{
		  $sql ="insert into street  (Name, idquan, idtinh, idphuong,loai) values ('$Name ','$idquan','$idtinh', '$idphuong','$loai')";
		//   echo $sql;
		// return; 
		} 
		
		else
		{
		  $sql = "UPDATE  street  SET  Name ='$Name', idquan  ='$idquan' , idtinh  ='$idtinh', idphuong  ='$idphuong', loai  ='$loai' where ID='0$ID'" ;			
		}  
	 	//echo $sql ;
		$update = $data->query($sql);
		$them = true;
 
 		
	 
}	

if ($_GET["Del"]  != "")
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

		$squan = chonghack($_POST["squan"]) ;

		$stinh = chonghack($_POST["stinh"]) ;

		$sphuong = chonghack($_POST["sphuong"]);
		
		$template->assign("NameS",$NameS);
		$template->assign("squan",$squan);
		$template->assign("stinh",$stinh);
		$template->assign("sphuong",$sphuong);
		
  	    $template->parse("main.block_khht1"); 
		$sql = "SELECT a.ID,a.idquan,a.idtinh,a.Name as street, b.Name as quan ,c.Name as tinh, d.Name as phuong
		from street as a 
		inner join quan as b 
		on a.idquan = b.ID  
		inner join tinh c 
		on a.idtinh = c.ID 
		inner join phuong d 
		on a.idphuong = c.ID";

		$sql_where=" where 1=1 ";
		if($NameS!="")
			$sql_where.=" and a.Name like '%".$NameS."%'";
		if($squan!="")
			$sql_where.=" and b.ID =".$squan;
		if($stinh!="")
			$sql_where.=" and c.ID =".$stinh;
		if($sphuong!="")
			$sql_where.=" and d.ID =".$sphuong;
		$sql.=$sql_where;
		echo "test". $sql;
		error_reporting(E_ALL ^ E_NOTICE);
	 
		if ($them) {  $template->parse("main.block_cusupdate") ;} 
		//$SOST = 0 ;
	// phan trang===================================================================
	     $sql = "SELECT id FROM street $sql_where order by Name ";
 		$query_rows = $data->query($sql);
		$num=$data->num_rows($query_rows);	
	
	    $page_start=0;
		$page_row = 20 ;
		include("paging.php");
		$list_page=paging($num);	
		
		
	
		$sql ="SELECT a.ID,a.idquan,a.idtinh,a.Name as street, b.Name as quan ,c.Name as tinh, d.Name as phuong
		from street as a 
		inner join quan as b 
		on a.idquan = b.ID  
		inner join tinh c 
		on a.idtinh = c.ID 
		inner join phuong d 
		on a.idphuong = c.ID ".$sql_where."
		ORDER BY ID desc, ID limit $page_start,$page_row ";
		// echo $sql;
		
		// echo "test".$sql;

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
	$template->assign("ID",$result_news["id"]);
	$template->assign("stt", $SOST);
	$template->assign("NameE", $result_news["phuong"]);
	// echo "test".$result_news["phuong"];
	$template->assign("idquan",$result_news["idquan"]);			
	$template->assign("idtinh",$result_news["idtinh"]);	
	$template->assign("NameB", $result_news["quan"]);
	$template->assign("NameC", $result_news["tinh"]);
	$template->assign("NameD", $result_news["street"]);
	
	
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
	$template->assign("street",composx("street","Name",$result["id"],""));
}
else		
{
			$sql ="SELECT * FROM  street  WHERE id='".$_REQUEST["id"]."'";
			// echo "test".$sql;

			$query = $data->query($sql);
			$result = $data->fetch_array($query);
				$template->assign("t-c","Cập nhập" );
				$template->assign("Name",$result["Name"]);		
				$template->assign("idquan",$result["idquan"]);			
				$template->assign("idtinh",$result["idtinh"]);	
				$template->assign("loai",$result["loai"]);			
				$template->assign("quan",composx("quan","Name",$result["ID"],""));
				$template->assign("phuong",composx("phuong","Name",$result["ID"],""));
			    $template->assign("tinh",composx("tinh","Name",$result["ID"],""));
			    $template->assign("street",composx("street","Name",$result["id"],""));
  		}
		
 	    $template->parse("main.block_kh");
	}
}
 $template->parse("main.block_ajack"); 
  $data->closedata() ;
?>
