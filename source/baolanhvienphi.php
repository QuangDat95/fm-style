<?php
session_start();
	if (!defined("IN_SITE"))
	{
    	die('Hacking attempt!');
	}
 	

//=============================khoi tao ======================//  	 Xem  	 Them  	 Cap nhap  	 Tim  	Huy  	Khoa  	In
 	$data->setthaotac = "baolanhvienphi" 	;
	//  echo $mquyen[19]."<br>";
	//echo kiemtraquyenthumuc(2,"them") ; 
 //   if (kiemtraquyenthumuc(19,"xem")== "0")     {  echo " <meta http-equiv='refresh'content='1;url=default.php'>"; return ;}	
 //	if (kiemtraquyenthumuc(19,"them")== "0")    {  $template->assign("q_them","none");  }
	//if( kiemtraquyenthumuc(19,"capnhap") ==0 )  {  $template->assign("q_luu","none");   }
 	//if (kiemtraquyenthumuc(19,"xoa")== "0")     {  $template->assign("q_huy","none");  }
   //=======================================================================================	if ($_POST["cancel"] <> "")
  
 
if ($_POST["btnUpdate"] != ""   )
{ 	
	     
		$ID   =		   chonghack($_GET["id"]) ;
		$idhoso =  	   chonghack($_POST["idhoso"]) ;
		$idbv=  	   chonghack($_POST["idbv"]) ;
		$vienphiuoctinh =     chonghack($_POST["vienphiuoctinh"]) ;
	    $nguyennhan =     chonghack($_POST["nguyennhan"]) ;
        $dutoanvienphi =     chonghack($_POST["dutoanvienphi"]) ; 
	    $dutoanchiphi =     chonghack($_POST["dutoanchiphi"]) ; 
		$dtbaolanhvienphi = chonghack($_POST["dtbaolanhvienphi"]);
			$dtbaolanhchiphi = chonghack($_POST["dtbaolanhchiphi"]);
			$ngaylambl =  	   chonghack($_POST["ngaylambl"]) ;
		$dongy_tuchoi=  	   chonghack($_POST["dongy_tuchoi"]) ;
		$lydo =     chonghack($_POST["lydo"]) ;
	    $lydomotphan =     chonghack($_POST["lydomotphan"]) ;
        $luuy =     chonghack($_POST["luuy"]) ; 
	    $ngayky =     chonghack($_POST["ngayky"]) ; 
		$ngaytao = chonghack($_POST["ngaytao"]);
			$nhanvien = chonghack($_POST["nhanvien"]);
			$them = chonghack($_POST["them"]);
			$note = chonghack($_POST["note"]);
		
		
		if ( $ID == "-1")
		{
		 $sql ="insert into baolanhvienphi SET idhoso ='$idhoso',idbv='$idbv',vienphiuoctinh='$vienphiuoctinh',nguyennhan='$nguyennhan',dutoanvienphi ='$dutoanvienphi',dutoanchiphi='$dutoanchiphi',dtbaolanhvienphi='$dtbaolanhvienphi' , dtbaolanhchiphi='$dtbaolanhchiphi'  ngaylambl='$ngaylambl',dongy_tuchoi='$dongy_tuchoi',lydo='$lydo',lydomotphan ='$lydomotphan',luuy='$luuy',ngayky='$ngayky' , ngaytao='$ngaytao' nhanvien='$nhanvien',them='$them' , note='$note' ";
		} 
		else
		{
		  $sql = "UPDATE baolanhvienphi SET idhoso ='$idhoso',idbv='$idbv',vienphiuoctinh='$vienphiuoctinh',nguyennhan='$nguyennhan',dutoanvienphi ='$dutoanvienphi',dutoanchiphi='$dutoanchiphi',dtbaolanhvienphi='$dtbaolanhvienphi' , dtbaolanhchiphi='$dtbaolanhchiphi'  ngaylambl='$ngaylambl',dongy_tuchoi='$dongy_tuchoi',lydo='$lydo',lydomotphan ='$lydomotphan',luuy='$luuy',ngayky='$ngayky' , ngaytao='$ngaytao' nhanvien='$nhanvien',them='$them' , note='$note'    where ID='0$ID'" ;			
		}  
	 
		$update = $data->query($sql);
		$them = true;
 
 		
	 
}	

 $del =  $_GET["Del"]; 
if ( $del != "" )
{  
   $del =  laso($_GET["Del"]); 


 if ( kiemtraquyenthumuc(19,"xoa")== "1" && $ktxoa == 0)
  { 

		$IDD = $_GET["Del"] ;
		$sql = "delete from  baolanhvienphi where ID = '0".$IDD."'" ;
		$update = $data->query($sql);
		$xoa = true ;
  }	
}

//=====================================
  	$tam = "" ;
	$kt = 0 ;	
	$page_row=1;	 $page_col=1; 
 	
	
	if  ($_REQUEST["id"] == ""  || $them  || $xoa || $_POST["search"] != "" )
	{
	
	
		$mabaolanhvienphi = chonghack($_POST["mabaolanhvienphiS"]) ;
		$template->assign("mabaolanhvienphi",$mabaolanhvienphi);
 		$NameS = chonghack($_POST["NameS"]) ;
		$template->assign("NameS",$NameS);

     	$sql_where=" where 1=1 ";
		if($NameS!="")
			$sql_where.=" and Name like '%".$NameS."%'";
		if($mabaolanhvienphi!="")
			$sql_where.=" and mabaolanhvienphi like '%".$mabaolanhvienphi."%'";

  	    $template->parse("main.block_khht1"); 
		$sql = "SELECT * FROM baolanhvienphi $sql_where ";
//		echo $sql ;
		 $query_rows = $data->query($sql);
		
 		$num=$data->num_rows($query_rows);
		if ($them) {  $template->parse("main.block_cusupdate") ;} 
		//$SOST = 0 ;
	// phan trang===================================================================
		$page_start=0;
		include("paging.php");
		$list_page=paging($num);	
		$sql = "SELECT * FROM baolanhvienphi ".$sql_where." ORDER BY  id  desc";

		$query_rows = $data->query($sql);
		$result_rows = $data->num_rows($query_rows);
		$result = $data->query($sql);
		$i =1; 
//=========================================================

	echo $sql;
		while($result_news = $data->fetch_array($result))		
		{  
			if($mau == "white")
				$mau = "#EEEEEE";
			else
			$mau = "white";
						
			$template->assign("color", $mau);
			$template->assign("ID",$result_news["ID"]);
			$template->assign("stt", $i);
			$template->assign("sohopdong", $result_news["sohopdong"]);
			$template->assign("thoihanhieuluc", $result_news["thoihanhieuluc"]);			
			$template->assign("namsinh",  $result_news["namsinh"]  );	
		    $template->assign("tencongty",  $result_news["tencongty"]  );	
			$template->assign("socmnd",  $result_news["socmnd"]  );
		    $template->assign("ngaykhambenh" , $result_news["ngaykhambenh"]  );
			$template->assign("chuandoanbenh",  $result_news["chuandoanbenh"]  );
		    $template->assign("tienkham" , number_format($result_news["tienkham"] ) );
			$template->assign("xetnghiem" , number_format($result_news["xetnghiem"])  );
			$template->assign("tienthuoc" , number_format($result_news["tienthuoc"] ) );
			$template->assign("chiphikhac" , number_format($result_news["chiphikhac"])  );
			$tongcong=$result_news["tienkham"]+$result_news["xetnghiem"]+$result_news["tienthuoc"]+$result_news["chiphikhac"];
			$template->assign("tongcong" , number_format($tongcong)  );
			if($result_news["tinhtrang"]==0) $tinhtrang="Chưa biết";
			if($result_news["tinhtrang"]==1) $tinhtrang="Không xác nhận";
			if($result_news["tinhtrang"]==8) $tinhtrang="Đã xác nhận";
			
			$template->assign("dongy_tuchoi" , $tinhtrang);
		    $template->assign("ngayky" , $result_news["ngayky"]  );
			$template->assign("ngaytao",  $result_news["ngaytao"]  );
		    $template->assign("nhanvien" , $result_news["nhanvien"]  );
			$template->assign("ghichubaohiem" , $result_news["ghichubaohiem"]  );
		 

			
		$template->parse("main.block_kh_poup");
		  $template->parse("main.block_khht"); 
	  	  $template->parse("main.block_khht2"); 
		     	$i++; 
		 } 
		  if ($result_rows==0){	 $template->parse("main.block_khht2"); }   
			$template->assign("list_page",$list_page);  // phan trang
	}
	 else	
	{ 
		
		if ($_REQUEST["id"] == "-1")
		{ 
		   $template->assign("t-c","Thêm Mới " );
		   $template->assign("idgoi",$_POST["id"]);

		}
		else		
		{
			$sql ="SELECT * FROM  baolanhvienphi WHERE ID='".$_REQUEST["id"]."' limit 1";
			$query = $data->query($sql);
			$result = $data->fetch_array($query);
				$template->assign("t-c","Cập nhập Sixe" );
				$template->assign("idgoi",$_POST["id"]);
			$template->assign("stt", $i);
			$template->assign("ID",$result["ID"]);
			$template->assign("stt", $i);
			$template->assign("sohopdong", $result["sohopdong"]);
			$template->assign("thoihanhieuluc", $result["thoihanhieuluc"]);			
			$template->assign("namsinh",  $result["namsinh"]  );	
		    $template->assign("tencongty",  $result["tencongty"]  );	
			$template->assign("socmnd",  $result["socmnd"]  );
		    $template->assign("ngaykhambenh" , $result["ngaykhambenh"]  );
			$template->assign("chuandoanbenh",  $result["chuandoanbenh"]  );
		    $template->assign("tienkham" , number_format($result["tienkham"] ) );
			$template->assign("xetnghiem" , number_format($result["xetnghiem"])  );
			$template->assign("tienthuoc" , number_format($result["tienthuoc"] ) );
			$template->assign("chiphikhac" , number_format($result["chiphikhac"])  );
			if($result_news["tinhtrang"]==0) $tinhtrang="Chưa biết";
			if($result_news["tinhtrang"]==1) $tinhtrang="Không xác nhận";
			if($result_news["tinhtrang"]==8) $tinhtrang="Đã xác nhận";
			
			$template->assign("dongy_tuchoi" , $tinhtrang);
		    $template->assign("ngayky" , $result["ngayky"]  );
			$template->assign("ngaytao",  $result["ngaytao"]  );
		    $template->assign("nhanvien" , $result["nhanvien"]  );
			$template->assign("ghichubaohiem" , $result["ghichubaohiem"] );
			
			}
 	    $template->parse("main.block_kh");
	 
}
 
  
?>