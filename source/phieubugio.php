<?php
   session_start();
   $dd =getcwd()  ;
	if (!defined("IN_SITE"))	{    	die('Hacking attempt!');	}
   //=============================khoi tao ======================//  	 Xem  	 Them  	 Cap nhap  	 Tim  	Huy  	Khoa  	In
 	$data->setthaotac = "capnhaptuvan" 	;
 //=======================================================================================		
  $donglai = "none" ;
   $idcuahang =$_SESSION["se_kho"];
   $idtao=$_SESSION["LoginID"];
  $tungay=gmdate('d/m/Y', time() + 7*3600) ;
  $template->assign("tungay",$tungay  );
  $tungay= gmdate('Y-n-d', time() + 7*3600) ;
  $sql_where = " where  a.ngaytao>= '$tungay' ";
   
  if (  $_POST["search"] != "" )
	{
  $sql_where = " where 1 ";
  
  $cuahangtim  = laso($_REQUEST["cuahangtim"]);
  $manv  = chonghack(trim($_REQUEST["manv"]));   
  $template->assign("manv",$manv);
  $tinhtrang  = laso($_REQUEST["tinhtrang"]); $template->assign("tinhtrang".$tinhtrang,"selected" ); 
  $tungay  = trim($_REQUEST["tungay"]);
  $toingay  = trim($_REQUEST["toingay"]);
  $template->assign("tungay",$tungay  );
  $template->assign("toingay",$toingay  );
  if($cuahangtim>0)   $sql_where.=" and a.idcuahang='".$cuahangtim."'";
  //  echo $tinhtrang ;
  if($tinhtrang != ""){
		 if($tinhtrang == 0){ $sql_where.="   "; 			}  // tang ca chỉ cần nhân sự (giám sát chung cột) duyệt   left 
		 else if($tinhtrang ==1){ $sql_where.= " and  right(a.tinhtrang,1)=4 and  left(a.tinhtrang,1)<3  "; } 
		 else if($tinhtrang ==2){ $sql_where.= " and  left(a.tinhtrang,1)<3 "; }
		 else if($tinhtrang ==3){ $sql_where.= " and  left(a.tinhtrang,1)=3 "; }
		 else if($tinhtrang ==4){ $sql_where.= " and  left(a.tinhtrang,1)=4 "; }
		 // giam sat duyet
  }
  
  
  
  if($manv!='')   $sql_where.=" and a.manv like '%".$manv."%'";
  
  
   if($tungay!="")	
		{
		  $ngay=  explode('/',$tungay);
	   	  if (strlen($ngay[1])== 1) {  $ngay[1] = "0".$ngay[1] ;  }
		  if (strlen($ngay[0])== 1) {  $ngay[0] = "0".$ngay[0] ;  }  
  		  $sql_where .= " and    a.ngaytao>= '$ngay[2]-$ngay[1]-$ngay[0]'   ";
   		} 
   if($denngay!="")	
		{
		  $ngay=  explode('/',$denngay);
	   	  if (strlen($ngay[1])== 1) {  $ngay[1] = "0".$ngay[1] ;  }
		  if (strlen($ngay[0])== 1) {  $ngay[0] = "0".$ngay[0] ;  }    		
 		  $sql_where .= "  and    a.ngaytao<= '$ngay[2]-$ngay[1]-$ngay[0] 23:59'   ";
   		} 		
		
 } 
  
 
		 if($ql[5]||$idl==1|| $idl==6990|| $idl==4647||$idl==2513)   
		 {   
		     $template->assign("tatca","<option value='0' >Tất cả cửa hàng</option>");
 		 	if($_SESSION["loai_user"]==16){  $chikho = "  where    IDtinh =$_SESSION[se_kho] " ;  $khuvuc = "and  IDtinh =$_SESSION[se_kho] ";}
			else {$chikho = "  where   ID >0" ;  }
 			 $template->assign("kho",composx("cuahang","Name","ID"," where idnhomcc<>8 and id>0 $khuvuc order by ID "));  
 		 }
 		 else
		 {  $template->assign("kho",composx("cuahang","Name","ID"," where ID= $_SESSION[se_kho]  order by ID ")); }
		 
 
 
 
   
if ($_POST["cancel"] != "")
{
	$ID = "" ;
	$_GET["id"] ="" ;
} 
		
 
 
if ($_POST["btnUpdate"] != ""   )
{ 	
	     
		$ID  	  =	   $_GET["id"]	;
		$Name 	  =    $_POST["Name"];
		$IDnhanvien = laso($_POST["nhanvien"]);
		$manv =  ($_POST["manv"]);
 		$idcuahang  =    laso($_POST["cuahang"]);
		$hinhcu = $_POST["hinhanhc"];
		$thoigianbatdau = $_POST["thoigianbatdau"];
		$thoigianketthuc = $_POST["thoigianketthuc"];
		$sophut = $_POST["sophut"];
		$ngaybu = $_POST["ngaybu"];
		$lydo =   chonghack(addslashes($_POST["lydo"])); 
		 $ngay =  explode('/',$ngay);
  		 if (strlen($ngay[1])== 1) {  $ngay[1] = "0".$ngay[1] ;  }	 if (strlen($ngay[0])== 1) {  $ngay[0] = "0".$ngay[0] ;  }
		 $ngay = $ngay[2].'-'.$ngay[1].'-'.$ngay[0] ;
		 $ngaytao = gmdate('Y-n-d H:i:s', time() + 7*3600) ;
		if($_SESSION['chonggoilai']==$_REQUEST['chonggoilai']) return ;
		 $manv=getten("userac", "$IDnhanvien", "manv");
		 
		 $hinhanhvao='';
		if($hinhcuvao){
			if(isset($_SESSION["sfilesvao"])){
				$tamhinh=$_SESSION["sfilesvao"];
				$tamhinh=explode("*",$tamhinh);
				$hinhcutam=explode("*",$hinhcura);
				foreach($tamhinh as $key => $value){
					if($value){
						if(!in_array($value,$hinhcutam)){
							if(unlink("$dd/images/bugio/".$value)){
								
							}
						}
					}
				}
			}
			$hinhanhvao=$hinhcuvao;
		}
		
		if($_FILES["hinhanhvao"]){
			 foreach ($_FILES["hinhanhvao"]["error"] as $key => $error) 
			{
				if ($error == UPLOAD_ERR_OK) 
				{
					$tmp_name = $_FILES["hinhanhvao"]["tmp_name"][$key];
					//$tmp_name = str_replace(" ","-",$tmp_name);	 
					$name =so_ngau_nhien()."_".rand()."_".$_FILES["hinhanhvao"]["name"][$key];
					$name =str_replace(" ","-",$name );
					$name = khongdau($name);
					$hinhanhvao.="*".$name;
					
					
					move_uploaded_file($tmp_name, "$dd/images/bugio/".$name);				
				}
			}	
		}
		
		 $hinhanhra='';
		if($hinhcura){
			if(isset($_SESSION["sfilesra"])){
				$tamhinh=$_SESSION["sfilesra"];
				$tamhinh=explode("*",$tamhinh);
				$hinhcutam=explode("*",$hinhra);
				foreach($tamhinh as $key => $value){
					if($value){
						if(!in_array($value,$hinhcutam)){
							if(unlink("$dd/images/bugio/".$value)){
								
							}
						}
					}
				}
			}
			$hinhanhra=$hinhcura;
		}
		
		if($_FILES["hinhanhra"]){
			 foreach ($_FILES["hinhanhra"]["error"] as $key => $error) 
			{
				if ($error == UPLOAD_ERR_OK) 
				{
					$tmp_name = $_FILES["hinhanhra"]["tmp_name"][$key];
					//$tmp_name = str_replace(" ","-",$tmp_name);	 
					$name =so_ngau_nhien()."_".rand()."_".$_FILES["hinhanhra"]["name"][$key];
					$name =str_replace(" ","-",$name );
					$name = khongdau($name);
					$hinhanhra.="*".$name;
					
					
					move_uploaded_file($tmp_name, "$dd/images/bugio/".$name);				
				}
			}	
		}
		if  ($_GET["id"] == "-1")
		{
		  
 		  $sql ="insert into phieubugio set lydo='$lydo',manv='$manv', IDcuahang ='$idcuahang',ngaytao ='$ngaytao',IDtao=$idtao,tinhtrang=11,IDNV = '$IDnhanvien',thoigianbatdau = '$thoigianbatdau',thoigianketthuc = '$thoigianketthuc',hinhanhvao='$hinhanhvao',hinhanhra='$hinhanhra',ngaybu='$ngaybu',sophut='$sophut'  ";
          	$update = $data->query($sql);	
			$_SESSION['chonggoilai']= $_REQUEST['chonggoilai'];
 		} 
		else
		{	
		  $sql = "UPDATE  phieubugio  set lydo='$lydo',manv='$manv',ngaytao='$ngaytao',IDtao='$idtao', IDNV = '$IDnhanvien', thoigianbatdau = '$thoigianbatdau', thoigianketthuc = '$thoigianketthuc',hinhanhvao='$hinhanhvao',hinhanhra='$hinhanhra',ngaybu='$ngaybu',sophut='$sophut'  where ID='0$ID'  and (IDtao=$idtao or idtao=7218) and  tinhtrang<44  "  ;	
		//  echo $sql ;
 		  //if( ($ql[4]||$idl==1))
		  $update = $data->query($sql);
		  $_SESSION['chonggoilai']= $_REQUEST['chonggoilai'];
		//  return ;
		}  
	 	   
		
		$them = true;
 
 		
	 
}	 
   $del =  laso($_GET["Del"]); 
if ($del>0  )
{
	 
	 
	if ($ktxoa == 1 && $_POST["search"] == "" )
	{
  	  $template->parse("main.block_khongxoa");
	}
	if ( $del != ""   )
	{ 
			$IDD = $_GET["Del"] ;
			if($_SESSION['admintuan']) $dieukiem=''; else  $dieukiem=" and idtao= '$idtao' and tinhtrang=0 ";
			$sql = "delete from  phieubugio where  ID = '0".$IDD."'  $dieukiem " ;
		 
			$update = $data->query($sql); 
			$xoa = true ;
	}	
}


{
 	$tam = "" ;
	$kt = 0 ;	

	if  ($_REQUEST["id"] == ""  || $them  || $xoa || $_POST["search"] != "" )
	{
	 	 

		$template->assign("type", $cuahang);		

  	    $template->parse("main.block_cusht1"); 

		
		$sql = "SELECT a.id FROM phieubugio a ";
 		$sql.=$sql_where;
		//echo $sql ;
		$query_rows = $data->query($sql); 
  		$num=$data->num_rows($query_rows);
		if ($them) {  $template->parse("main.block_cusupdate") ;} 
		//$SOST = 0 ;
	// phan trang===================================================================
		$page_start=0;
		$page_row = 200 ;
		 
	 
		$sql = "SELECT a.tinhtrang,a.ID,DATE_FORMAT(a.ngaybu,'%d/%m/%Y') as ngaybugio,a.idcuahang,b.name as tencuahang,DATE_FORMAT(a.ngaytao,'%d/%m/%Y %H:%i') as ngaytao,DATE_FORMAT(a.ngayxacnhan3,'%d/%m/%Y') as ngayduyet,a.lydogs,a.sophut,a.lydons,c.Ten as tenNV, c.Chucvu, c.MaNV,a.IDNV, a.thoigianbatdau  ,a.thoigianketthuc  FROM phieubugio a left join cuahang b on a.idcuahang=b.id left join userac c on a.idnv=c.id".$sql_where." ORDER BY a.ID  ";
			if ($_SESSION["admintuan"]) echo $sql ;
		$query_rows = $data->query($sql);
		$result_rows = $data->num_rows($query_rows);
		$result = $data->query($sql);
		$i = $page_start; 
	//	$mangnhanvien =taomang("userac","ID","Ten"," where tinhluong = '1'  ") ;
//=========================================================
 		$mangchucvu =taomang("kh_chucvu","ID","Name"," where 1  ") ;

		while($re = $data->fetch_array($result))		
		{  
				if($mau=="white")  $mau = "#EEEEEE"; else  $mau = "white";
 				$template->assign("color", $mau);
				$template->assign("ID",$re["ID"]);
				$template->assign("XOA",$re["ID"]);
				$template->assign("stt", $i+1);
				$template->assign("ngaytao", $re["ngaytao"]);
 				$template->assign("lydogs",$re["lydogs"]);
				$template->assign("lydo",$re["lydo"]);
				$template->assign("ngaybu",$re["ngaybugio"]);
				$template->assign("giovao",$re["thoigianbatdau"]);
				$template->assign("giora",$re["thoigianketthuc"]);
				$template->assign("lydons",$re["lydons"]);
				$template->assign("tennhanvien",$re["tenNV"]);
				$template->assign("sophut",$re["sophut"]);
 				//$sogio =   strtotime($re["thoigianketthuc"])- strtotime($re["thoigianbatdau"]);  
				$sogio=$re["sophut"];
				$gio = floor($sogio/60);			
				$phut =   $sogio%60 ;
 				$template->assign("sogio",$gio.'h'.$phut."'");
				
				$template->assign("chucvu",$mangchucvu[$re["Chucvu"]]);
				$template->assign("manhanvien",$re["MaNV"]);
				$template->assign("thoigiantangca", date('H:i  d-m-Y',  strtotime($re["thoigianbatdau"]))  . " <br> " .date('H:i d-m-Y',  strtotime($re["thoigianketthuc"])) );
				$template->assign("tencuahang",$re["tencuahang"]);
				$template->assign("ngayduyet",$re["ngayduyet"]);
  				$tam=$re['tinhtrang']."11"; $quanly=$tam[1]; $nhansu=$tam[0]; 
				$tinhtrang="Mới tạo" ;
                if($nhansu==4) {$tinhtrang="Đã duyệt" ;  }  
				elseif ($nhansu==3)  $tinhtrang="Không duyệt" ;  
				elseif ($quanly==2)  $tinhtrang="Chờ thông tin" ;  
				elseif ($quanly==4&&$nhansu<3)  $tinhtrang="Chờ NS duyệt" ;  
 				else  $tinhtrang="Chờ NS duyệt" ; 				
				
				$template->assign("tinhtranggoc",$re['tinhtrang']);
				
				$template->assign("tinhtrang",$tinhtrang);
   			    $template->parse("main.block_cusht"); 
			 
		     	$i++; 
		}	
			$template->assign("list_page",$list_page);  // phan trang
		  $template->parse("main.block_cusht2"); 
 	}
	 else	
	{ 
		
		if ($_REQUEST["id"] == "-1")
		{ 
		  
		    $template->assign("t-c","Thêm Mới Yêu Cầu " );
		    $template->assign("cuahang",$_SESSION["se_kho"] );
			 $template->assign("chonggoilai", gmdate('d/m/Y H:i:s', time() + 7*3600));
			  if($idl==1||$idl==4647) $cuahang="" ; else $cuahang=" and  cuahang = $_SESSION[se_kho]    ";
 			$template->assign("nhanvienonline", compoloai("userac","MaNV","Ten",0," where 1 $cuahang  "). compoloai("nhanviennhieucuahang","Name","manv",0," "));
		    $template->assign("ngaytao",  gmdate('d/m/Y', time() + 7*3600));
 		   	$template->assign("kho",composx("cuahang","Name",$_REQUEST["idcuahang"],"ID"));
			
			if($_SESSION["LoginID"]==1 || $_SESSION["LoginID"]==2)   
			{ 
 				 $template->parse("main.block_cus.block_admin"); 
			}
			else
			{ 
			   $template->assign("tencuahang", $_SESSION["S_tencuahang"]);
			 	$template->parse("main.block_cus.block_cuahang"); 
				 
			}
 
  				 			 
 
		}
		else		
		{
			 $template->assign("chonggoilai", gmdate('d/m/Y H:i:s', time() + 7*3600));
			$sql ="SELECT DATE_FORMAT(a.ngaytao,'%d/%m/%Y') as ngaytao,b.macuahang,b.name as tencuahang,b.id as idcuahang ,a.lydo,a.thoigianbatdau,a.sophut, a.thoigianketthuc,a.hinhanhvao,a.hinhanhra,a.ngaybu,a.IDNV FROM phieubugio a left join cuahang b on a.idcuahang=b.id WHERE a.ID='".$_REQUEST["id"]."'";
			$query = $data->query($sql);
			$result = $data->fetch_array($query);
				$template->assign("t-c","Cập nhập Yêu Cầu" );
 				$template->assign("cuahang",$result["idcuahang"]);
			    if($idtao==1 || $idtao ==4647) $cuahang= "" ; else $cuahang=" and  cuahang = $_SESSION[se_kho]    ";
 			  	$template->assign("kho",composx("cuahang","Name",$result["idcuahang"],"ID"));  
			 	$template->assign("nhanvienonline", compoloai("userac","Ten","MaNV",$result["IDNV"]," where 1  $cuahang  "));
 				$template->assign("cuahang",$result["idcuahang"]);
 				$template->assign("ngaytao",$result["ngay"]);
 				$template->assign("lydo",$result["lydo"]);
				$ngaybu = date('Y-m-d', strtotime($result["ngaybu"]));
				$newDate1 = date('Y-m-d\TH:i', strtotime($result["thoigianbatdau"]));
				$newDate2 = date('Y-m-d\TH:i', strtotime($result["thoigianketthuc"]));
				$template->assign("sophut",$re["sophut"]);
 				//$sogio =   strtotime($re["thoigianketthuc"])- strtotime($re["thoigianbatdau"]);  
				$sogio=$re["sophut"];
				$gio = floor($sogio/60);			
				$phut =   $sogio%60 ;
 				$template->assign("sogio",$gio.'h'.$phut."'");
					$template->assign("hinhanhc",$result["hinhanh"]);
				$template->assign("thoigianbatdau", $newDate1);
				$template->assign("ngaybu", $ngaybu);
 				$template->assign("thoigianketthuc", $newDate2);
 				$template->assign("macuahang",$result["macuahang"]);
				$template->assign("capnhapct"," readonly='readonly' ");
				$hinhanhvao=$result["hinhanhvao"];
				$_SESSION["sfilesvao"]=$hinhanhvao;
				$hinhanhvao=explode("*",$hinhanhvao);
				$chuoihinhvao='';
				foreach($hinhanhvao as $key => $value){
				if($value!=""){
					$chuoihinhvao.='<div style="width:90px">
					<p  style="cursor:pointer;color: blue;" data-name="'.$value.'" onclick="xoaanh(event)">xóa ảnh này</p>
					<img style="width:100%" src="images/bugio/'.$value.'" onclick="setimage(\'images/bugio/'.$value.'\')" /></div>';
					}
				}
				$template->assign("chuoihinhvao",$chuoihinhvao);
				
				$hinhanhra=$result["hinhanhra"];
				$_SESSION["sfilesra"]=$hinhanhra;
				$hinhanhra=explode("*",$hinhanhra);
				$chuoihinhra='';
				foreach($hinhanhra as $key => $value){
				if($value!=""){
					$chuoihinhra.='<div style="width:90px">
					<p  style="cursor:pointer;color: blue;" data-name="'.$value.'" onclick="xoaanh(event)">xóa ảnh này</p>
					<img style="width:100%" src="images/bugio/'.$value.'" onclick="setimage(\'images/bugio/'.$value.'\')" /></div>';
					}
				}
				$template->assign("chuoihinhra",$chuoihinhra);
			if($_SESSION["LoginID"] ==1 || $_SESSION["LoginID"] ==2)   
			{$template->parse("main.block_cus.block_admin"); }
			 else { $template->assign("tencuahang", $_SESSION["S_tencuahang"]); $template->parse("main.block_cus.block_cuahang");  }
 
  				
 		}
		$template->assign("donglai",$donglai);
 	    $template->parse("main.block_cus");
	}
}

   $data->closedata() ;
   
?>