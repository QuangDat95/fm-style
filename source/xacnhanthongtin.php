<?php
session_start();
if ($_SESSION["dangnhap"]=="") return ;
$IDTao = $_SESSION["LoginID"]  ;
 
     $_SESSION["frm_xuathang"] = "" ;
	if (!defined("IN_SITE")) 	{    	die('Hacking attempt!');	}
	 
 
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
  //============= ==========================================================================
   $template->assign("tinh",composx("tinh","Name","ID","  order by Name ")); 	
   
   
   if($ql[5]||$idl==1)
		 {  	   $template->assign("cuahangnhan",composx("cuahang","Name","ID"," where ID>1 order by ID ")); 	
		           $template->assign("tatca",' <option value="" >Tất cả</option>' ) ;
		 }else
 		 {   // $template->assign("kho",composx("cuahang","Name","ID"," where ID>1 order by ID ")); 	
             $template->assign("cuahangnhan",composx("cuahang","Name","ID"," where ID= $_SESSION[se_kho]  order by ID ")); 
		 }
		 
 
 if ($_POST["cancel"] != "")
{
	$ID = "" ;
	$_GET["id"] ="" ;
} 

if ($_POST["btnUpdate"] != ""   )
{ 	
	     
		$ID   =		   chonghack($_GET["id"]) ;
		$Name =  	  addslashes(chonghack($_POST["Name"])) ;
		$address = 	   addslashes(chonghack($_POST["address"])) ;
	 
 		$type =  	   chonghack($_POST["type"]) ;
		$tel =  	   str_replace('84','0',chonghack($_POST["tel"]));
		$mobile =  	   chonghack($_POST["mobile"]) ;
		$Fax =  	   chonghack($_POST["Fax"]) ;
 		$email= 	   chonghack($_POST["email"]) ;
		$website =     chonghack($_POST["website"]) ;
		$note =  	   chonghack($_POST["note"]) ;
		$MST =  	    laso(str_replace(",","",$_POST["MST"]) ) ;  					
		$STK =  	  laso(str_replace(",","",$_POST["STK"]) ) ;   
		$nganhang =    chonghack($_POST["nganhang"]) ;		
		$cmnd =        chonghack($_POST["cmnd"]) ;		
		$makh =        chonghack($_POST["makh"]) ;		
		$IDCuaHang  = $_SESSION["se_kho"] ;
		 
		$sokhung =     chonghack($_POST["sokhung"]) ;		
		$mauson =      chonghack($_POST["mauson"]) ;		
		$model =       chonghack($_POST["model"]) ;		
		$IDKhuVuc =      laso($_POST["IDKhuVuc"]) ;	
        $quan =          laso($_POST["quan"]) ;	
        $phuong =      laso($_POST["phuong"]) ;	
		$nhomkh =      chonghack($_POST["nhomkh"]) ;	
		$xungho =      laso($_POST["xungho"]) ;	
		$ngaysinh =   chonghack($_POST["ngaysinh"]) ;
		$sapxep = chonghack($_POST["sapxep"]) ;
		$diemtichluy =   laso(str_replace(",","",$_POST["diemtichluy"]) ) ;
		 
	    $ngay=  explode('/',$ngaysinh);
   		 if (strlen($ngay[1])== 1) {  $ngay[1] = "0".$ngay[1] ;  }
	 	 if (strlen($ngay[0])== 1) {  $ngay[0] = "0".$ngay[0] ;  }
 		$ngaysinh = $ngay[2]."-". $ngay[1]."-". $ngay[0] ;	 	
		 $ngaytao = date('Y/n/d H:i:s');
		if  ($_GET["id"] == "-1")
		{
		 
		  $sql ="insert into customer set   nhomkh='$nhomkh', IDKhuVuc='$IDKhuVuc', quan='$quan', phuong='$phuong', nganhang='$nganhang',  Name ='$Name',address ='$address',type ='$type',tel ='$tel',mobile ='$mobile',Fax ='$Fax',email ='$email',website ='$website',note ='$note',MST ='$MST',STK ='$STK', NameN= '$NameN', addressN = '$addressN',ngaytao='$ngaytao',makh='$makh',xungho='$xungho',cmnd='$cmnd',ngaysinh='$ngaysinh',IDTao ='$IDTao' ,IDCuaHang ='$IDCuaHang'  " ;
		  
				 $sqlk = " select ID from customer where tel='$tel'   limit 1";
  
		} 
		else
		{
	 
		if ($IDTao == "1" ||$IDTao == "604"  ||  $_SESSION["loai_user"] ==6  ||$IDTao==5565 ||$IDTao==5562)  
		{ $diemtichluy = " ,diemtichluy= '$diemtichluy' " ; $tudo= '';  $ma = ", makh='$makh' " ;} else 
		{ $tudo= " and   IDCuaHang ='$IDCuaHang' "; $diemtichluy =  "" ; $ma='';}
		  $sql = "UPDATE  customer SET   nhomkh='$nhomkh' $ma, IDKhuVuc='$IDKhuVuc', quan='$quan', phuong='$phuong', nganhang='$nganhang',  Name ='$Name',address ='$address',type ='$type',tel ='$tel',mobile ='$mobile',Fax ='$Fax',email ='$email',website ='$website',note ='$note',MST ='$MST',STK ='$STK', NameN= '$NameN', addressN = '$addressN' ,xungho='$xungho',cmnd='$cmnd',ngaysinh='$ngaysinh',ngaycapnhap='$ngaytao' ,IDcapnhap ='$IDTao'  $diemtichluy   where ID='0$ID' $tudo " ;		
		 $sqlk = " select ID from customer where tel='$tel' and ID<>'$ID' limit 1";
		}  
	 	 //echo  $sql;return ;
	    $tam= getdong($sqlk);
	
		if (laso($tam[ID])==0)   $update = $data->query($sql);
		
		$them = true;
 
 	  //   $sinhnhat ="FMSTYLE chuc ban mot ngay sinh nhat vui ve, Trong vong 10 ngay he thong FM uu dai chiet khau cho ban len den 12% tren tong hoa don,mua sam tha ga tai FM nhe.";
	 //    $url= "http://tinsinhnhat.ovn.vn/tudonglaysinhnhat.php" ;
		// $baomat = base64_encode("b3a8fb84adb8f1d251c39cd94d8f53fb");  
    	        $cacbien = array(
			                'baomat'=>  ($baomat),
 						 	'mobile'=> $tel,							
							'message'=>  ($sinhnhat),  						 
							'user'=> "3",
							'ngaysinh'=> $ngaysinh ,
						    'brand'=> "dienthoai",
							'sokhung'=> "FM" ,
  					); 		
	//   if (trim($sinhnhat) != "" && $tel != "" && ($ngaysinh != "" || $ngaysinh!='0000-00-00' ) ) { $kq = goidulieu($cacbien,$url) ;   }
		  
		
	 
}	

    $del =  laso($_GET["Del"]); 
  // $ktxoa = kiemtraxoa("phieunhapxuat","IDNhaCC"," where  IDNhaCC ='$del'  limit 0,1 ") ;
  // $ktxoa1 = kiemtraxoa("baogia","MaKH"," where  MaKH ='$del'  limit 0,1 ") ;
  if ($ktxoa == 1  || $ktxoa1 == 1)
  {
 	 $template->parse("main.block_khongxoa");
  }
  $IDD = $_GET["Del"] ;
 if (($IDTao == "1" || $_SESSION["loai_user"] ==6||$IDTao==5565 ||$IDTao==5562) && $IDD >0 ) 
 { 
 		$sql = "delete from  customer where ID = '0".$IDD."'" ;
		$update = $data->query($sql);
		$xoa = true ;
 }	

{
 	$tam = "" ;
	$kt = 0 ;	
 
	if ($_REQUEST["id"] == "" || $them  || $xoa ||  $_POST["search"] != "" )
	{    
		$template->assign("nhomkh",composx("nhomkhachhang","Name",$_REQUEST["nhom"],"Rank")); 
		$template->assign("khuvuc",composx("tinh","Name",$_REQUEST["kv"],""));
		$NameS = chonghack($_POST["NameS"]) ;
		$nhom = chonghack($_POST["nhom"]) ;
		$nhom = chonghack($_POST["tinh"]) ;
		$dt = chonghack(trim($_POST["dt"])) ;
		$cm = chonghack(trim($_POST["cm"])) ;
		
		$template->assign("NameS",$NameS);
		
		$typencc=chonghack($_POST["type"])."";
		if($typencc=="0")	{ $ch0="selected";	}		
		if($typencc=="1")	$ch1="selected";
		if($typencc=="2")	$ch2="selected";				
		
		$nhacungcap='<select name="type">
						<option value="" >Tất cả</option>
						<option value="0" '.$ch0.'>Xe</option>
						<option value="1" '.$ch1.'>Công ty</option>						
						<option value="2" '.$ch2.'>Cá Nhân</option>
					</select> ';

		$template->assign("type", $nhacungcap);		

  	    $template->parse("main.block_cusht1"); 
		$sql = "SELECT ID FROM customer ";

		$sql_where=" where 1=1 ";
		if($NameS!="")
			$sql_where.=" and Name like '%".$NameS."%' ";
		if($nhom!="")
			$sql_where.=" and nhomkh =  '".$nhom."' ";		
		if($kv!="")
			$sql_where.=" and IDKhuVuc=  '".$kv."' ";						
		if($typencc!="")
			$sql_where.=" and type='".$typencc."'";
	 
		if($cm!="")
				$sql_where.=" and cmnd like'%".$cm."%'";
	if($dt!="")
			$sql_where.=" and mobile='%".$dt."%'";			
		$sql .=$sql_where;
		
   
		$query_rows = $data->query($sql);
		//$result_rows = $data->num_rows($query_rows);
		//$result = $data->query($sql);
		$num=$data->num_rows($query_rows);
		if ($them) {  $template->parse("main.block_cusupdate") ;} 
		//$SOST = 0 ;
	// phan trang===================================================================
   	   if ($sapxep =="")$sapxep = "ID";
	   $template->assign("sapxep".$sapxep, "selected");
		$page_start=0;
		include("paging.php");
		$list_page=paging($num);	
		 $page_row =20 ;
		$sql = "SELECT * FROM customer ".$sql_where." ORDER BY $sapxep desc limit $page_start,$page_row ";
	//  echo $sql ;
 		$query_rows = $data->query($sql);
		$result_rows = $data->num_rows($query_rows);
		$result = $data->query($sql);
		$i = $page_start; 
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
				$template->assign("Name", $result_news["Name"]);
				$template->assign("address",$result_news["address"]);
				$SoDienThoai = $result_news["tel"] ;
				if ( trim($SoDienThoai) == "")	
				{
					$SoDienThoai  = $result_news["mobile"] ;
				}		
				$template->assign("SoDienThoai",$SoDienThoai  );
   			    $template->parse("main.block_cusht"); 
		     	$i++; 
		}	
			$template->assign("list_page",$list_page);  // phan trang
		  $template->parse("main.block_cusht2"); 
 	}
	 else	
	{ 
		$template->assign("htxe", "none");
		 $template->assign("idgoi",$_REQUEST["id"]);
		
		if ($_REQUEST["id"] == "-1")
		{ 
		   $template->assign("t-c","Thêm Mới Khách Hàng" );
		  
		   printtree1(0, 1,0 ,0,false); 	 
		  $template->assign("khuvuc",composx("tinh","Name",0,"Rank")); 
		   $template->assign("nhomkh",composx("nhomkhachhang","Name",0,"Rank")); 
		   
		}
		else		
		{
			$sql ="SELECT *,DATE_FORMAT( ngaysinh,'%d/%m/%Y') as ngay FROM  customer WHERE ID='".laso($_REQUEST["id"])."'";
			$query = $data->query($sql);
			$result = $data->fetch_array($query);
				$template->assign("t-c","Cập nhập Khách Hàng" );
 				 
				$template->assign("Name",$result["Name"]);
				$template->assign("address",$result["address"]);
				$template->assign("type",$result["type"]);
				$template->assign("makh", $result["makh"]);
				$template->assign("ID",$result["ID"]);
				if ($result["type"] == "0") $template->assign("ch0","checked"); 				
				if ($result["type"] == "1") $template->assign("ch1","checked");
				if ($result["type"] == "2") $template->assign("ch2","checked");
			 	$xungho = "xungho".$result["xungho"];
				$template->assign("$xungho","selected"); 
				$template->assign("tel",$result["tel"]);
				$template->assign("mobile",$result["mobile"]);
				$template->assign("Fax",$result["Fax"]);
				$template->assign("email",$result["email"]);
				$template->assign("website",$result["website"]);
				$template->assign("note",$result["note"]);
				$template->assign("MST",$result["MST"]);
				$template->assign("STK",$result["STK"]);
				$template->assign("cmnd",$result["cmnd"]);
				$template->assign("diemtichluy",formatso($result["diemtichluy"]));
				$template->assign("sotiendamua",formatso($result["sotiendamua"]));
 				$template->assign("ngaysinh",$result["ngay"]);
				$template->assign("nganhang",$result["nganhang"]);
				$template->assign("tinh",composx("tinh","Name",$result["IDKhuVuc"],""));
				$template->assign("quan",composx("quan","Name",$result["quan"],""));
				$template->assign("phuong",composx("phuong","Name",$result["phuong"],""));
				$template->assign("nhomkh",composx("nhomkhachhang","Name",$result["nhomkh"],"Rank"));
 				
 		}
		$template->assign("donglai",$donglai);	   
        $template->assign("cay",$Caytm);
 	    $template->parse("main.block_cus");
	}
}
$template->assign("goitim","document.getElementById('search2').click()   ;");

 if ( !($_SESSION["se_kho"] ==1 && $_SESSION["loai_user"] ==6 )  )   $template->parse("main.block_kt");    
 $template->parse("main.block_ajack"); 
   
?>