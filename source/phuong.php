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
if (isset($_POST['view'])) {
	header("Content-Type', application/pdf");
	readfile("templates/QUOC.pdf");
}


if ($_POST["cancel"]!="")
{
	$ID = "" ;
	$_GET["id"] ="" ;
} 
 
if ($_POST["btnUpdate"]!=""   )
{ 	
	     
	$ID           =		$_GET["id"]  ;
	$Name         =  	$_POST["Name"]  ;
	$idquan      =  	$_POST["idquan"]  ;
	$idtinh =  		$_POST["idtinh"]  ;
	$loai =  		$_POST["loai"];
	  if($loai==1){
	 	$loai="Xã";
	  }
	  else if($loai==2){
	  	$loai="Thị trấn";
	  }
	  else if($loai==3){
	  	$loai="Phường";
	  }	
	//$loai=$loai==1?"Đường":"Phố";
	$idphuong1 =  	$_POST["idphuong"]  ;
	
		if  ($_GET["id"] == "-1"){
		  $sql ="insert into phuong1  (Name,idquan,idtinh,loai) values ('$Name ','$idquan','$idtinh','$loai')";
		}else{
		  $sql = "UPDATE  phuong1  SET  Name ='$Name', idquan  ='$idquan' , idtinh  ='$idtinh' ,loai='$loai' where ID='0$ID'" ;			
		}  
	 	// echo $sql ; return;
		$update = $data->query($sql);
		$them = true;
 
 		
	 
}	

if ($_GET["Del"]!="")
{ 
		$IDD = $_GET["Del"] ;
		$sql = "delete from  phuong1  where ID = '0".$IDD."'" ;
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
		$sql = "SELECT ID FROM phuong1 ";

		$sql_where=" where 1=1 ";
		if($NameS!="")
			$sql_where.=" and Name like '%".$NameS."%'";
		$sql.=$sql_where;
		error_reporting(E_ALL ^ E_NOTICE);
	 
		if ($them) {  $template->parse("main.block_cusupdate") ;} 
		//$SOST = 0 ;
	// phan trang===================================================================
	     $sql = "SELECT ID FROM phuong1 $sql_where order by Name ";
 		$query_rows = $data->query($sql);
		$num=$data->num_rows($query_rows);	
	
	    $page_start=0;
		$page_row = 20 ;
		include("paging.php");
		$list_page=paging($num);	
		
		
	
		$sql ="SELECT a.ID,a.idquan,a.idtinh,a.Name as phuong, b.Name as quan ,c.Name as tinh 
		from phuong1 as a 
		left join quan as b 
		on a.idquan = b.ID 
		left join tinh c 
		on a.idtinh = c.ID".$sql_where." ORDER BY ID desc, ID limit $page_start,$page_row ";

		// echo $sql; return;

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
	$template->assign("Name", $result_news["phuong"]);
	$template->assign("idquan",$result_news["idquan"]);			
	$template->assign("idtinh",$result_news["idtinh"]);	
	$template->assign("NameB", $result_news["quan"]);
	$template->assign("NameC", $result_news["tinh"]);
	
	
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
	$template->assign("phuong1",composx("phuong1","Name",$result["ID"],""));
	$template->parse("main.block_kh.block_them");
}
else		
{
			$sql ="SELECT * FROM  phuong1  WHERE ID='".$_REQUEST["id"]."'";

			$query = $data->query($sql);
			$result = $data->fetch_array($query);
				$template->assign("t-c","Cập nhập" );
				$template->assign("Name",$result["Name"]);		
						
				$template->assign("idtinh",$result["idtinh"]);	
				$template->assign("idphuong",$result["idphuong"]);
				$template->assign("phuong",composx("phuong1","Name",$result["phuong"],""));
				$template->assign("idquan",$result["idquan"]);			
				$template->assign("quan",composx("quan","Name",$result["idquan"],""));
				// echo 'test'.$result["idquan"]; return;
			    $template->assign("tinh",composx("tinh","Name",$result["idtinh"],""));

				$loai = 0;
				if($result["loai"]== 'Xã'){
					$loai1 = "selected = 'selected'" ; 
				}else if($result["loai"]== 'Thị Trấn'){
					$loai2 = "selected = 'selected'"; 
				}
				else if($result["loai"]== 'Phường'){
					$loai3 = "selected = 'selected'"; 
				}

				$template->assign("loai1", $loai1 );
				$template->assign("loai2", $loai2 );
				$template->assign("loai3", $loai3 );
  		}
		
 	    $template->parse("main.block_kh");
	}
}
 $template->parse("main.block_ajack"); 
  $data->closedata() ;
?>
