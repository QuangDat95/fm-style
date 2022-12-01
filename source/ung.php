<?php
session_start();
	if (!defined("IN_SITE"))
	{
    	die('Hacking attempt!');
	}
  
//=============================================	
 
//$thanghientai = gmdate('n/Y', time() + 7*3600) ;  
 
 
if ($_POST["btnUpdate"] == "" && $_GET["id"] != "-1" && $_GET["Del"] == "" && $_REQUEST["search"] == ""   )
{
	$template->assign("timkiem","goitim()");
}
if ($_POST["btnUpdate"] != ""  )
{ 	
 		$ID   =		    $_REQUEST["id"]  ;
		$Name =  	chonghack($_POST["Name"])  ;
		$ma =  	  chonghack( $_POST["ma"] )  ;
		$sotien =   laso( $_POST["sotien"] ) ;
		$idnhanvien =   laso( $_POST["idnhanvien"] ) ;
  		$ngay =    chonghack( $_POST["ngay"] )  ; 
		$ngaytao =   gmdate('Y-n-d H:i:s', time() + 7*3600) ;  	
		
  		  $ngayung=  explode('/',$ngay);
	   	  if (strlen($ngayung[1])== 1){ $ngayung[1] = "0".$ngayung[1] ;  }
		  if (strlen($ngayung[0])== 1){ $ngayung[0] = "0".$ngayung[0] ;  }    	  $ngay = "$ngayung[2]-$ngayung[1]-$ngayung[0]";
 			
		 
		if  ($_GET["id"] == "-1")
		{
			  $sql ="select ID from  kh_ung where sotien ='$sotien' and idnhanvien='$idnhanvien' and ngay  ='$ngay' and Name ='$Name' limit 1 ";
			  if (getdong($sql)=='')
				{	  
				  $sql ="insert into kh_ung SET ngaytao='$ngaytao',Name ='$Name', ngay  ='$ngay' ,sotien ='$sotien',idnhanvien='$idnhanvien' ";
				   // echo  $sql;
				  $update = $data->query($sql);
				
				} 
		} 
		else
		{
		  $sql = "UPDATE  kh_ung  SET  idnhanvien ='$idnhanvien', Name ='$Name', ngay  ='$ngay',sotien ='$sotien' where ID='0$ID'" ;	
		  $update = $data->query($sql);		
		}  
	//	echo $sql ; 
		
		 
		$them = true;
       $template->assign("timkiem","goitim()");
 		
	 
}	

if ($_GET["Del"] != "")
{ 
      $ngaychan= gmdate('Y-n-d H:i:s', time() + 7*3600-30*24*3600) ;  
		$IDD = $_GET["Del"] ;
		$sql = "delete from  kh_ung  where ID = '0".$IDD."' and ngaytao >'$ngaychan'" ;
	 
		$update = $data->query($sql);
		$xoa = true ;
}	

{
 	$tam = "" ;
	$kt = 0 ;	
	if ($_REQUEST["search"] != "" || $them  || $xoa || $_REQUEST["id"]== "" )
	{
           
		$NameS = chonghack($_POST["NameS"]) ;
		$template->assign("NameS",$NameS);
		 $thangtim = chonghack($_POST["thangtim"]) ;
		 $namtim = chonghack($_POST["namtim"]) ;
		 for ($i=12;$i>=1;$i--)
		 {
			 if ($i== $thangtim)$template->assign("thangse","selected");else $template->assign("thangse","");
			  $template->assign("thangt",$i);	
			  $template->parse("main.block_khht1.block_thang") ;
		 }
		 
		 $nam = gmdate('Y', time() + 7*3600)  ;
		 for ($i= $nam;$i>= $nam-9;$i--)
		 {     if ($i== $namtim)$template->assign("namse","selected");else $template->assign("namse","");
			  $template->assign("namt",$i);	
			  $template->parse("main.block_khht1.block_nam") ;
		 }		
  	    $template->parse("main.block_khht1"); 
		$sql = "SELECT a.ID FROM   kh_ung a left join userac  b on a.idnhanvien =b.ID ";

		$sql_where=" where 1=1 ";
		if($NameS!="")
			$sql_where.=" and  like '%".$NameS."%'";
			
		if($thangtim!="0")
			$sql_where.=" and DATE_FORMAT(a.ngay, '%Y-%c')  = '".$namtim."-".$thangtim ."'" ;
				
		$sql.=$sql_where;

		$query_rows = $data->query($sql);
		//$result_rows = $data->num_rows($query_rows);
		//$result = $data->query($sql);
		$num=$data->num_rows($query_rows);
		if ($them) {  $template->parse("main.block_cusupdate") ;} 
		//$SOST = 0 ;
	// phan trang===================================================================
 
 	 $sql = "SELECT DATE_FORMAT(a.ngay, '%d/%m/%Y') as ngayung, a.*,b.ten,b.manv FROM kh_ung a left join userac  b on a.idnhanvien =b.ID  ".$sql_where." ORDER BY a.ngay desc ,b.ten desc  ";
//  echo $sql ;
//=========================================================
  $result = $data->query($sql);
    $SOST = 0 ; $tongung =0 ;
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
			$template->assign("sotien", formatso($result_news["sotien"])); 
			$tongung += $result_news["sotien"] ;
			$template->assign("ngay", $result_news["ngay"]);  
			$template->assign("ten", $result_news["ten"]);  
			$template->assign("code", $result_news["manv"]);  
			$template->assign("ngayung", $result_news["ngayung"]);  
		    $template->parse("main.block_khht"); 
	  	  
		     	$i++; 
		 } 
		  
		  $template->assign("tongung",formatso($tongung)); 
		  $template->parse("main.block_khht2"); 
			$template->assign("list_page",$list_page);  // phan trang
		  
	}
	 else	
	{ 
		
		if ($_REQUEST["id"] == "-1")
		{ 
		   $template->assign("t-c","Thêm mới  " );
		   $template->assign("idgoi",$_POST["id"]);
		  $template->assign("thanghientai",$thanghientai);
		  $template->assign("thangtruoc",$thangtruoc);
	    

		}
		else		
		{
			 
			 
			$sql ="SELECT DATE_FORMAT(ngay, '%d/%m/%Y') as ngays, a.*,b.ten,b.manv FROM kh_ung a left join userac  b on a.idnhanvien =b.ID   WHERE a.ID='".$_REQUEST["id"]."'";
			$query = $data->query($sql);
			$result = $data->fetch_array($query);
				$template->assign("t-c","Cập nhập" );
 				$template->assign("Name",$result["Name"]);				
				$template->assign("sotien",formatso($result["sotien"]));	
				$template->assign("ten", $result["ten"]); 
				$template->assign("code", $result["manv"]); 
			     $template->assign("idgoi",$result["ID"]);
				$template->assign("ngay"  ,$result["ngays"]);  	
			 
				$template->assign("idnhanvien", $result["idnhanvien"]); 
				$template->assign("thanghientai",$thanghientai);
		        $template->assign("thangtruoc",$thangtruoc);
				if ($result["ngays"]==$thanghientai)  $template->assign("ngay2"  , "selected"); 
   		}
		
 	    $template->parse("main.block_kh");
	}
	
	
}
 
 $template->parse("main.block_ajack"); 
   
?>