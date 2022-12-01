<?php
   session_start();
  include_once($root_path."send.php");
   $dd =getcwd()  ;
   $noichua = "anhnoidung/";
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
	header("location: ?act=themnghiviec");
} 
		
 
 
if ($_POST["btnUpdate"] != ""   )
{ 		$tongtien=1;
	     $soluong=1;
		$ID  	  =	   $_REQUEST["id"]	;
		$Name 	  =    $_SESSION["TenUser"];
		$IDnhanvien = $_SESSION["LoginID"];
		$IDcuahang=$_SESSION["se_kho"];
		$manv = $_SESSION["MaNV"];
		$hinhcu = $_POST["hinhanhc"];
		$ngaynghidexuat = $_POST["ngaynghidexuat"];
			$lydo =   chonghack(addslashes($_POST["lydo"]));
		$ghichu =   chonghack(addslashes($_POST["ghichu"])); 
		$thang = gmdate('m', time() + 7*3600);  
		$nam = gmdate('y', time() + 7*3600);  
		 $ngaytao = gmdate('Y-n-d H:i:s', time() + 7*3600) ;
		  //số chứng từ
		$sql = "SELECT `AUTO_INCREMENT` as sp FROM INFORMATION_SCHEMA.TABLES
     WHERE TABLE_SCHEMA = '$db[name]' AND TABLE_NAME = 'duyetbaohiemyte';" ;  
	 $kq = getdong($sql) ;		
    	$sp  = laso($kq['sp']);	
		
		  $sochungtu = $ct.$nam.$thang.".DN".$IDcuahang.".". $sp;  
		$hinhanh='';
		if($hinhcu){
			if(isset($_SESSION["sfiles"])){
				$tamhinh=$_SESSION["sfiles"];
				$tamhinh=explode("*",$tamhinh);
				$hinhcutam=explode("*",$hinhcu);
				foreach($tamhinh as $key => $value){
					if($value){
						if(!in_array($value,$hinhcutam)){
							if(unlink("$dd/images/duyetnghi/".$value)){
								
							}
						}
					}
				}
			}
			$hinhanh=$hinhcu;
		}
		
		if($_FILES["hinhanh"]){
			 foreach ($_FILES["hinhanh"]["error"] as $key => $error) 
			{
				if ($error == UPLOAD_ERR_OK) 
				{
					$tmp_name = $_FILES["hinhanh"]["tmp_name"][$key];
					//$tmp_name = str_replace(" ","-",$tmp_name);	 
					$name =so_ngau_nhien()."_".rand()."_".$_FILES["hinhanh"]["name"][$key];
					$name =str_replace(" ","-",$name );
					$name = khongdau($name);
					$hinhanh.="*".$name;
					
					
					move_uploaded_file($tmp_name, "$dd/images/duyetnghi/".$name);				
				}
			}	
		}
		//if($_SESSION['chonggoilai']==$_REQUEST['chonggoilai']) return ;
		
		//var_dump($hinhanh);
		if($_GET["id"] == "-1")
		{
		  
 		  $sql ="insert into duyetbaohiemyte set soct='$sochungtu',lydo='$lydo',manv='$manv',ngaytao ='$ngaytao',IDtao=$IDnhanvien,tinhtrang=11,tinnhan=11,IDNV = '$IDnhanvien',hinhanh='$hinhanh',IDcuahang='$IDcuahang',ngaynghidexuat='$ngaynghidexuat',ghichu='$ghichu'";
          //	$update = $data->query($sql);	
			//$_SESSION['chonggoilai']= $_REQUEST['chonggoilai'];
			 $update = $data->query($sql);
			if($update){
			
			
			$siteimg='https://siandchip.vn/images/duyetnghi/';
			if($ghichu){
				$ghichutxt="*Ghi chú: $ghichu";
			}
			$hinhanhtxt='';
			if($hinhanh){
			$hinhanhtxt.="*Link ảnh: ";
			$arrhinh=explode("*",$hinhanh);
			foreach($arrhinh as $key => $value){
				if($value){
					$hinhanhtxt.=$siteimg.$value."
					";
				}
			}
		}
		
		$tongtien=$sotien*$soluong;

				$id='4855964974924921585';
$noidung="Yêu cầu xét duyệt nghỉ việc: $sochungtu

*Lý do: $lydo

*Số tiền: $sotien

*ngày nghỉ: $ngaynghidexuat

*Người tạo: $Name

$ghichutxt

$hinhanhtxt
";

			
			/*	$result=sendme($id,$noidung);
			
				if($result){
					$result=json_decode($result,true);
					if($result['status']==200){
						$sql="UPDATE  duyetbaohiemyte  set tinnhan=21 where manv='$manv' and ngaytao ='$ngaytao' and IDtao=$IDnhanvien and lydo='$lydo'"  ;
						$update = $data->query($sql);
					}
				}	*/
			}
 		} 
		else
		{	
		
		  $sql = "UPDATE  duyetbaohiemyte  set lydo='$lydo',manv='$manv',ngaytao ='$ngaytao',IDtao=$IDnhanvien,tinhtrang=11,IDNV = '$IDnhanvien',hinhanh='$hinhanh',IDcuahang='$IDcuahang',ngaynghidexuat='$ngaynghidexuat',ghichu='$ghichu'  where ID=".$_REQUEST["id"]."  and (IDtao=$IDnhanvien or idtao=7218) and  tinhtrang<44  "  ;	
		
		  $update = $data->query($sql);
		//  echo $sql ;
 		  //if( ($ql[4]||$idl==1))
		 
		 // $_SESSION['chonggoilai']= $_REQUEST['chonggoilai'];
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
			if($_SESSION['admintuan']) $dieukiem='';// else  $dieukiem=" and idtao= '$idtao' and tinhtrang=0 ";
			$sql = "delete from  duyetbaohiemyte where  ID = '0".$IDD."'  $dieukiem " ;
		 
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

		
		$sql = "SELECT a.id FROM duyetbaohiemyte a ";
 		$sql.=$sql_where;
		//echo $sql ;
		$query_rows = $data->query($sql); 
  		$num=$data->num_rows($query_rows);
		if ($them) {  $template->parse("main.block_cusupdate") ;} 
		//$SOST = 0 ;
	// phan trang===================================================================
		$page_start=0;
		$page_row = 200 ;
		 
	 
		$sql = "SELECT a.tinhtrang,a.ID,a.IDcuahang,a.soluong,a.sotien,a.hinhanh,a.soluong,b.name as tencuahang,DATE_FORMAT(a.ngaytao,'%d/%m/%Y %H:%i') as ngaytao,DATE_FORMAT(a.ngaynghidexuat,'%d/%m/%Y') as ngaynghidx,DATE_FORMAT(a.ngaynghiduyet,'%d/%m/%Y ') as ngaynghid,DATE_FORMAT(a.ngaynghithuc,'%d/%m/%Y ') as ngaynghit,DATE_FORMAT(a.ngaygiamdoc,'%d/%m/%Y') as ngayduyet,a.lydo,a.lydothumua,a.lydogiamdoc,a.lydoketoan,c.Ten as tenNV, c.Chucvu, c.MaNV,a.IDNV FROM duyetbaohiemyte a left join cuahang b on a.idcuahang=b.id left join userac c on a.IDNV=c.id".$sql_where." ORDER BY a.ID  ";
	//	echo $sql;
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
				$tongngaylam=songaylamviec($re["ID"]);
				$template->assign("tongngaylam",$tongngaylam["tongngay"]);
				$template->assign("stt", $i+1);
				$template->assign("ngaytao", $re["ngaytao"]);
				$template->assign("ngaynghidexuat",$re["ngaynghidx"]);
				$template->assign("ngaynghithuc",$re["ngaynghit"]);
				$template->assign("ngaynghiduyet",$re["ngaynghid"]);
 				$template->assign("lydogiamdoc",$re["lydogiamdoc"]);
			
				$template->assign("lydothumua",$re["lydothumua"]);
				$template->assign("lydoketoan",$re["lydoketoan"]);
				$template->assign("lydo",$re["lydo"]);
				$template->assign("tennhanvien",$re["tenNV"]);
 				
				$template->assign("chucvu",$mangchucvu[$re["Chucvu"]]);
				$template->assign("manhanvien",$re["MaNV"]);
				
				$template->assign("tencuahang",$re["tencuahang"]);
				$template->assign("ngayduyet",$re["ngayduyet"]);
  				$tam=$re['tinhtrang']."11"; $ketoan=$tam[0];$giamdoc=$tam[1]; 
				$tinhtrang="Mới tạo" ;
				//ke toán = giám sát
				// giám đốc = nhấn sự
               if($giamdoc==4) {$tinhtrang="Đã duyệt" ;  }  
				elseif ($ketoan==3)  $tinhtrang="Không duyệt" ;  
				elseif ($ketoan==2)  $tinhtrang="Chờ thông tin" ;  
				elseif ($ketoan==4 )  $tinhtrang="Chờ nhân sự duyệt" ; 
				
				
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
 			///$template->assign("nhanvienonline", compoloai("userac","MaNV","Ten",0," where 1 $cuahang  "). //compoloai("nhanviennhieucuahang","Name","manv",0," "));
		    $template->assign("ngaytao",  gmdate('d/m/Y', time() + 7*3600));
 		   	//$template->assign("kho",composx("cuahang","Name",$_REQUEST["idcuahang"],"ID"));
			
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
			$sql ="SELECT a.lydo,a.ID,a.sotien,a.soluong,DATE_FORMAT(a.ngaygiamdoc,'%d/%m/%Y') as ngayduyet, a.ghichu,a.ngaynghidexuat,DATE_FORMAT(a.ngaynghidexuat,'%Y-%m-%d') as ngaynghidx,DATE_FORMAT(a.ngaynghithuc,'%Y-%m-%d') as ngaynghit,DATE_FORMAT(a.ngaynghiduyet,'%Y-%m-%d') as ngaynghid,a.hinhanh FROM duyetbaohiemyte a WHERE a.ID='".$_REQUEST["id"]."'";
			//echo $sql;
			$query = $data->query($sql);
			$result = $data->fetch_array($query);
				$template->assign("t-c","Cập nhập Yêu Cầu" );
			  $template->assign("idgoi",$result["ID"]);
 				$template->assign("lydo",$result["lydo"]);
				$template->assign("sotien",$result["sotien"]);
				$template->assign("soluong",$result["soluong"]);
				$tongtien=$result["sotien"]*$result["soluong"];
				$template->assign("tongtien",number_format($tongtien));
				$template->assign("ngayduyet",$result["ngayduyet"]);
				$template->assign("ngaynghidexuat",$result["ngaynghidx"]);
				//echo $re["ngaynghidexuat"];
				$template->assign("ngaynghithuc",$result["ngaynghit"]);
				$template->assign("ngaynghiduyet",$result["ngaynghid"]);

 				$template->assign("ghichu",$result["ghichu"]);
				$template->assign("hinhanhc",$result["hinhanh"]);
				$hinhanh=$result["hinhanh"];
				$_SESSION["sfiles"]=$hinhanh;
				$hinhanh=explode("*",$hinhanh);
				$chuoihinh='';
				foreach($hinhanh as $key => $value){
				if($value!=""){
					$chuoihinh.='<div style="width:90px">
					<p  style="cursor:pointer;color: blue;" data-name="'.$value.'" onclick="xoaanh(event)">xóa ảnh này</p>
					<img style="width:100%" src="images/duyetnghi/'.$value.'" onclick="setimage(\'images/duyetnghi/'.$value.'\')" /></div>';
					}
				}
				$template->assign("chuoihinh",$chuoihinh);
				//var_dump($hinhanh);
				
			if($_SESSION["LoginID"] ==1 || $_SESSION["LoginID"] ==2)   
			{$template->parse("main.block_cus.block_admin"); }
			 else { $template->assign("tencuahang", $_SESSION["S_tencuahang"]); $template->parse("main.block_cus.block_cuahang");  }
 
  				
 		}
		$template->assign("donglai",$donglai);
 	    $template->parse("main.block_cus");
	}
}

   $data->closedata() ;
   
   function callapi($url,$arr){
   
  	 	$curl = curl_init();
		
		curl_setopt_array($curl, array(
		  CURLOPT_URL => $url,
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => '',
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => 'POST',
		  CURLOPT_POSTFIELDS =>json_encode($arr),
		  CURLOPT_HTTPHEADER => array(
			'Content-Type: application/json'
		  ),
		));
		
		$response = curl_exec($curl);
		
		curl_close($curl);
		return $response;
   
   }
   
   
   function songaylamviec($idnv){
		$sql="select count(DISTINCT TO_DAYS(ngaytao)) as tongngay from nhanviendilam where IDnhanvien=$idnv and SUBSTRING(thongtin,3,3)='8.0' group by IDnhanvien";
		$dong = getdong($sql);
		return $dong;
   }

?>