<?php
session_start();
	if (!defined("IN_SITE"))	{    	die('Hacking attempt!');	}
 
  $donglai = "none" ;
  //=============================khoi tao ======================//  	 Xem  	 Them  	 Cap nhap  	 Tim  	Huy  	Khoa  	In
 	$data->setthaotac = "nhacungcap" 	;
      if (kiemtraquyenthumuc(15,"xem")== 0 )     {  echo " <meta http-equiv='refresh'content='1;url=default.php'>"; return ;}	
 	if (kiemtraquyenthumuc(15,"them")== 0)    {  $template->assign("q_them","none");  }
	if( kiemtraquyenthumuc(15,"capnhap") ==0 )  {  $template->assign("q_capnhap","none");   }
 	if (kiemtraquyenthumuc(15,"xoa")== 0)     {  $template->assign("q_xoa","none");  }
  //=======================================================================================	
$template->assign("images", "blank.gif");

function HTmuccon($idvao,$muccon,$group)
{	   
  		global $data,$tam,$kt;
		$kt = $muccon ;
 	    $sele = "selected" ; 
   		$sql = 	"select * from groupproduct where ID <> 1 and IDGroup = '0".$idvao."'  order by ID" ;
		$result = $data->query($sql);			
 		$result_rows = $data->num_rows($result);	
		if ($result_rows > 0 )
		{	
			$kt = $kt + 1 ;
		} 
		$SOST = 0 ; 
		$result = $data->query($sql);	
		while($result_news = $data->fetch_array($result))		
		{   		
			$sss = "".$result_news["ID"] ;
 					if ($group == $sss )				
					{
						$tam  = $tam."<option  value='".$result_news["ID"]."'  $sele >" ;
					} 
					else
					{
						$tam  = $tam."<option value='".$result_news["ID"]."'>"; 
					}	 			
					for($i=1;$i<=$kt;$i++)
					{
						$tam  = $tam."&nbsp;&nbsp;&nbsp;&nbsp;" ;
					}
					$tam  = $tam.$result_news["Name"]."</option>\n" ;
					HTmuccon($result_news["ID"],$kt,$group)	;			
			 
 		}
       if ($result_rows > 0 )
		{	
			$kt = $kt - 1 ;
		} 
}
//=======================================================
function HTCayThuMuc($group)
{			
  
		global $data,$tam;
 		$ketqua = "";
 		$sele = "selected" ;
   		$sql = 	"select * from groupproduct where ID <> 1 and IDGroup = '0'  order by Rank desc " ;
		$result = mysql_query($sql) or $this->error("Could not query. ".mysql_error());	
 		$SOST = 0 ; 
 		while($result_news = $data->fetch_array($result))		
        {	 	 
			   $sss = $result_news["ID"] ;
   	           if ($group == $sss )
				{			
 					$tam  = $tam."<option $sele value='".$result_news["ID"]."'>".$result_news["Name"]."</option>\n";			
				}	
				else
				{ 
					$tam  = $tam."<option value='".$result_news["ID"]."'>".$result_news["Name"]."</option>\n";
				}		
  			 	 HTmuccon($sss,0,$group)	;			
 	      }
  	 return ;
}
//=============================================	
if ($_POST["cancel"] != "")
{
	$ID = "" ;
	$_GET["id"] = "" ;
} 
 
$sql_where = "";
$sql_where= " where 1=1 ";

 		
        $NameTK   = khongdau($_POST["NameTK"])   ;
        $codeprotk   =trim($_POST["codeprotk"])   ;
		$IDGrouptk = laso($_POST["IDGrouptk"]) ;
		$IDloaitk = laso($_POST["IDloaitk"]) ;
		 
		
		if (laso($_REQUEST["page"])>0 ){
			$NameTK   = $_SESSION["NameTK"]    ;
            $codeprotk =  $_SESSION["codeprotk"]    ;
		    $IDGrouptk = laso($_SESSION["IDGrouptk"]) ;
		    $IDloaitk = laso($_SESSION["IDloaitk"]) ;
		} 
		else{
		    $_SESSION["NameTK"]  = $NameTK   ;
            $_SESSION["codeprotk"] = $codeprotk   ;
		    $_SESSION["IDGrouptk"]   = $IDGrouptk ;
		    $_SESSION["IDloaitk"]   = $IDloaitk ;
		}
		
		 if($codeprotk!="")
			$sql_where.=" and codepro like '%".$codeprotk."%'";
		if($NameTK!="")
			$sql_where.=" and NameN like '%".$NameTK."%'";
		 
 		
 		// if($IDloaitk <> '0'){	
			// $sql_where.=" and  IDloai = '$IDloaitk' ";
			// //$IDloaitk = 1;
			// $template->assign("loaihang",composx("loaihang","Name",$IDloaitk,""));
 		// }
 		// else{
 		// 	$sql_where.=" and  IDloai = '1' ";
 		// 	$IDloaitk = 1;
 		// 	$template->assign("loaihang",composx("loaihang","Name",$IDloaitk,""));
 		// }

 		if($IDGrouptk <> '0'){	
			//$sql_where.=" and  g.ID = '$IDloaitk' ";
			//$IDloaitk = 1;
			HTCayThuMuc($IDGrouptk) ;
			$template->assign("cay",$tam);
			//$template->assign("loaihang",composx("groupproduct","Name",$IDloaitk,""));
			$gro = $IDGrouptk;
			$nhom = $gro.timnhom("groupproduct","IDGroup",$gro);

	 		$sql_where .= " and IDGroup in ( $nhom ) ";
 		}
 		if($IDGrouptk=='0'){
			HTCayThuMuc($IDGrouptk) ;
			$template->assign("cay",$tam);
			//$template->assign("loaihang",composx("groupproduct","Name","ID","")); 
			$sql_where.=" ";
			// Loại trừ 2 nhóm Chi phí Chung và Nhân công " ; 
			$gro_chiphichung ='21';
			$nhom_cpc_nc =$gro_chiphichung.timnhom("groupproduct","IDGroup",$gro_chiphichung);
			$gro_nhancong ='20';
			$nhom_cpc_nc .=",".$gro_nhancong.timnhom("groupproduct","IDGroup",$gro_nhancong);

	 		$sql_where .= "and IDGroup not in ( $nhom_cpc_nc ) ";	
		}


		 
	    $template->assign("NameTK",trim($_POST["NameTK"]) );		
		 $template->assign("codeprotk",$codeprotk );	
				
 
 
if ($_POST["btnUpdate"] != "")
{ 	
		$ID =  $_GET["id"]  ;
		$IDGroup = $_POST["IDGroup"]  ;
		$IDnhom = laso($_POST["nhomhang"] );	
		$IDloai = laso($_POST["loaihang"] );	
		$Name = addslashes($_POST["Name"]);
		$NameEN = $_POST["NameEN"];
		$NameN = khongdau($Name) ;
		$codepro = str_replace(' ','',trim($_POST["codepro"]));
		$code =  str_replace(' ','',trim($_POST["code"]));
 		$images = $_SESSION['file'];	
		$Rank = $_POST["Rank"];
		if (trim($Rank) == "") { $Rank = "1" ;}
		$LoaiTien = $_POST["LoaiTien"];
		$price = laso($_POST["price"]);	
		$giachan = laso($_POST["giachan"]);	
		$note =addslashes( $_POST["note"]);
		$note1 =addslashes( $_POST["note1"]);
		$tam_soluong = getdong("select * from hanghoacuahang_nvl where IDSP = $ID   limit 1");	
 		$SoLuong = $tam_soluong["SoLuong"];	
 		$SoLuong1 = $tam_soluong["SoLuong1"];
 		$DV = $_POST["DV"];
 		$DVT = getten("donvi",$DV,"Name");
 		$DV1 = $_POST["DV1"];
 		$DVT1 = getten("donvi",$DV1,"Name");
		$giamgia = $_POST["giamgia"]  ;	
		$baohanh = $_POST["baohanh"]  ;	
		$socanhbao= laso($_POST["socanhbao"])  ;
		$status= laso($_POST["status"])  ;
		$size= laso($_POST["size"])  ;
		$mau= laso($_POST["mau"])  ;
	 
	 
 
		
		if ($_FILES["file"]["error"] == 0)
		{   $name =so_ngau_nhien()."_".rand()."_".$_FILES["file"]["name"] ;
			// foreach($_FILES["file"] as $result) {
			//     echo $result, '<br>';
			// }
			// echo "___".$_FILES["file"]["name"] . "---" . $_FILES['file']['tmp_name']; return;
 		  	@move_uploaded_file($_FILES['file']['tmp_name'],"images/sanpham/". $name)	;
		 	@unlink($_FILES['file']); 
			$imagea  = "images,";
			$imageb  = "'$name', ";
			$imagec  = "images ='$name', ";
	     } else
		 { 
		 	$name ="";
		 	$imagea  = "";
			$imageb  = "";
			$imagec  = "";
		 }
		 
		  
	 
 
		if  ($_GET["id"] == "-1")
		{
		  $NgayTao = gmdate('Y-n-d H:i:s', time() + 7*3600) ;

			  if (kttrung("nvl_products","codepro",$codepro,"0")== "0" )
			  {
				  $sql ="insert into  nvl_products" ; 
				  $sql .="($imagea IDnhom,IDloai,mau,size,congtho,DV, DV1,DVT,DVT1, IDGroup,Name,codepro,code,Rank,
				  	price,giachan,note,note1,note2,NameN,NameEN,NgayTao,giamgia,baohanh,socanhbao,status)";
				  $sql .=" values ($imageb '$IDnhom','$IDloai','$mau','$size','0','$DV', '$DV1', '$DVT','$DVT1','$IDGroup','$Name','$codepro','$code','$Rank','$price','$giachan','$note','$note1','$note2','$NameN','$NameEN','$NgayTao','$giamgia','$baohanh','$socanhbao','$status')";
				  $update = $data->query($sql);
				   
			 
				  $tam= getdong(" select ID from nvl_products where codepro='$codepro' ");
				  // $mangch = taomang("cuahang",'ID','ID'," where 1 ");
				  // foreach ($mangch as $idch)  
				  // {			  
				  // 	$update= $data->query(" insert into hanghoacuahang set IDcuahang= $idch ,IDSP = '$tam[ID]',SoLuong = 0  ");
	 			 //  }
			 
			  }
		} 
		else
		{
			 if (kttrung("nvl_products","codepro",$codepro,$ID)== "0" ) // ,codepro ='$codepro' 
			 {
				 $codeup= "codepro='$codepro',code='$code', " ;
				 //$sql =" select ID from xuatbanhang where mahang='$codepro' union  select ID from xuatbhchuakhoa where mahang='$codepro'  union  select ID from chitietxuatnhap where mahang='$codepro' union  select ID from xuatkhotong where mahang='$codepro' union  select ID from xuatkhotongchuakhoa where mahang='$codepro'  limit 1  ";
               //$tam=getdong($sql);
			  // if ($tam['ID']>0)  $codeup ='';
			  $sql = "UPDATE  nvl_products SET $imagec $codeup IDloai='$IDloai',IDnhom='$IDnhom', mau='$mau',size='$size',DV ='$DV',DV1 ='$DV1',DVT ='$DVT',DVT1 ='$DVT1',baohanh ='$baohanh',giamgia ='$giamgia',note ='$note',note1 ='$note1',note2 ='$note2',IDGroup ='$IDGroup', Name ='$Name',code ='$code', Rank='$Rank',LoaiTien ='$LoaiTien',price ='$price',giachan ='$giachan',NameN ='$NameN',NameEN ='$NameEN', socanhbao = '$socanhbao',status=$status where ID='0$ID'" ;	
			  $update = $data->query($sql);	
			 
		$giothongbao = date('d/n/Y H:i:s');	 
		$giacu = $_SESSION['giacu'] ;
		$giamoi= formatso($price); 		 
 	   $message  = "Thong bao !
    <br />
Vao luc : $giothongbao<br />
 <br />
Ma hang: $codepro <br />
Ten hang: $Name<br />
Da cap nhap thong tin gia: <br />
 + Gia truoc: $giacu <br />
 + Gia moi: $giamoi <br />
 <br />
  <br />
Than men,<br />
Goi tu dong tu: phanmembanhang.ovn.vn <br />	  
	  
	  " ;
	  $to = "anhtuan@ovn.vn";
	  $subject	= "Thong bao co su thay doi gia ma $code !" ;  
	  $headers = "Content-type: text/html; charset=utf-8\r\nFrom: phanmembanhang.ovn.vn <info@ovn.vn>";
 	  	 // echo $to."-" .$subject."-".  $from . "-" ;
	// if ($giacu != $giamoi)   mail($to. ", anhtuanas@gmail.com ", $subject, $message, $headers) ;			 
			 
			  	
			 } 
		} 
	 	// echo $sql ;
		
		$them = true;
	 
}	
 //======================xoa tin==================================================
  		
		
			
 // if($_POST["xoadl"] != "" && count($_POST["cb"]) > 0)
if($_POST["xoadl"] != "")
			{		
			 $sql =" delete from nvl_products  where ID='-1'  "	;  
 			  foreach($_POST["cb"] as $key => $val  )
			  {
				 $ktxoa = kiemtraxoa("chitietxuatnhap","IDSP"," where  IDSP ='$val'  limit 0,1 ") ;
			     $ktxoa1= kiemtraxoa("xuatkhotong","IDSP"," where  IDSP ='$val'  limit 0,1 ") ;			  
 			     if ( $ktxoa !=1 && $ktxoa !=1)  $sql .= " or ID = '$val' " ;
  			  }
 
 			   $update = $data->query($sql);
			   $template->parse("main.block_delete");
			   
}	

   $del =  laso($_GET["Del"]); 
   $ktxoa = kiemtraxoa("chitietxuatnhap","IDSP"," where  IDSP ='$del'  limit 0,1 ") ;
   $ktxoa1= kiemtraxoa("xuatkhotong","IDSP"," where  IDSP ='$del'  limit 0,1 ") ;

if ( ($ktxoa == 1 || $ktxoa1 == 1)&& $_POST["search"] =="" &&$del>0)
{
  $template->parse("main.block_khongxoa");
}
if ( $del != "" && kiemtraquyenthumuc(15,"xoa")== "1" && $ktxoa == 0 && $ktxoa1 == 0)
{ 
		$IDD = $del ;
		$sql = "delete from  nvl_products where ID = '0".$IDD."'" ;
		$update = $data->query($sql);
		$xoa = true ;
}
{
 	$tam = "" ;
	$kt = 0 ;	
	if ($_REQUEST["id"] == "" || $them  || $xoa ||  $_POST["search"] != "" || $_POST["xoadl"] != "")
	{
		$IDGroup = $_POST["IDGroup"]  ;
		$IDnhom = $_POST["nhomhang"]  ;
		//$IDloaitk = $_POST["IDloaitk"]  ;
		$mau = $_POST["mau"]  ;
    	  
   

		$sql = "SELECT * FROM tracnghiem_cauhoi  order by RAND() limit 0,10 "; 
		//echo $sql;
		$query_rows = $data->query($sql);
		$result_rows = $data->num_rows($query_rows);
		$result = $data->query($sql);   
		$danhsachcauhoi = "";
		while(($result_news = $data->fetch_array($result)  )	&& ($SOST < $page_row))	
		{  
			$i=$i+1;  
			$template->assign("ID",$result_news["ID"]);
			$template->assign("stt", $i);  
			$danhsachcauhoi .= "{ "; 
			$danhsachcauhoi .= "id : '".$result_news["ID"]."', ";
			$danhsachcauhoi .= "question : '".$result_news["Name"]."', ";
	        $danhsachcauhoi .= "imgSrc : '" .$result_news["images"]."', ";
			$sql_dapan = "SELECT * FROM tracnghiem_dapan where IDGroup=".$result_news["ID"]." ORDER BY ID ASC "; 
			//echo "++ ".$sql_dapan;
			$query_rows_dapan = $data->query($sql_dapan);
			$result_rows_dapan = $data->num_rows($query_rows_dapan);
			$result_dapan = $data->query($sql_dapan);
			$i_dapan = 0;
			while(($result_news_dapan = $data->fetch_array($result_dapan)  )	&& ($SOST < $page_row))	
			{ 
				$i_dapan ++;
				if($i_dapan == 1) $danhsachcauhoi .= "choiceA : 'A. ".$result_news_dapan["Name"] ."', ";
		        if($i_dapan == 2) $danhsachcauhoi .= "choiceB : 'B. ".$result_news_dapan["Name"] ."', ";
		        if($i_dapan == 3) $danhsachcauhoi .= "choiceC : 'C. ".$result_news_dapan["Name"]."', ";
		        if($i_dapan == 4) $danhsachcauhoi .= "choiceD : 'D. ".$result_news_dapan["Name"]."', ";
		    }
		    if($result_news["ma"] != '') $dapandung = $result_news["ma"];
	        $danhsachcauhoi .= "correct : '".$dapandung."'";
	        $danhsachcauhoi .= " },";   

		 }
		// echo $danhsachcauhoi;
		$template->assign("danhsachcauhoi", $danhsachcauhoi); 
		$template->parse("main.block_proht2"); 	  
	}
	 else	
	{ 
	   $template->assign("manhom",composx("groupproduct","ma",0,""));		  
		if ($_REQUEST["id"] == "-1")
		{ 
		   $template->assign("t-c","Thêm Mới Kho Nguyên Vật liệu" );
		   $template->assign("idgoi",$_POST["id"]);
		   $template->assign("Rank","1");
		   $template->assign("loai",0);
		   $template->assign("Name",$_REQUEST["t1"]);
		   $template->assign("codepro",$_REQUEST["t2"]);
		   $template->assign("code",$_REQUEST["t3"]);
		   $template->assign("nhomhang",composx("nhomhang","Name",0,""));	
		   $template->assign("loaihang",composx("loaihang","Name",0,""));
		    $template->assign("mausac",composx("mausac","Name",0,""));
			 $template->assign("size",composx("size","Name",0,""));
	
			//function composx($table,$Name,$cat_id,$cotsapxep)
			$template->assign("DV" ,composx("donvi","Name",$result_news["DV"],"Rank"));
			$template->assign("DV1" ,composx("donvi","Name",$result_news["DV1"],"Rank"));
			HTCayThuMuc(laso($_REQUEST["t4"])) ;
 			if (trim($_REQUEST["t4"]) != '')   $donglai = '' ;
			
		//	echo $donglai ;
		    $template->assign("cay",$tam);	
			
		   $IDGroup = "" ;
		   $IDG = "" ;
		}
		else		
		{
			$sql ="SELECT * FROM  nvl_products WHERE ID='".$_REQUEST["id"]."' ORDER BY codepro ASC";
			$query = $data->query($sql);
			$result = $data->fetch_array($query);
			   $template->assign("t-c","Cập Nhập Thông tin Nguyên vật liệu" );
			   $template->assign("loai",$_REQUEST["id"]);
			   $template->assign("idgoi",$_POST["id"]);
			   $template->assign("Name",$result["Name"]);
	            
			   $template->assign("NameEN",$result["NameEN"]);
			   $template->assign("note",$result["note"]);
 			   $template->assign("images",$result["images"]);
			   $template->assign("codepro", $result["codepro"]);	
			   $template->assign("code", $result["code"]);
			   $tam_soluong = getdong("select * from hanghoacuahang_nvl where IDSP = ".$_REQUEST["id"]." limit 1");
			   $template->assign("SoLuong", $tam_soluong["SoLuong"]<>0 ? $tam_soluong["SoLuong"]:0);
			   $template->assign("SoLuong1", $tam_soluong["SoLuong1"]<>0 ? $tam_soluong["SoLuong1"]:0);
			   $template->assign("DV" ,composx("donvi","Name",$result["DV"],"Rank"));
			   $template->assign("DV1" ,composx("donvi","Name",$result["DV1"],"Rank"));
			   $template->assign("loaihang",composx("loaihang","Name",$result["IDloai"],""));
			   $template->assign("socanhbao", $result["socanhbao"]);
			   $template->assign("price", formatso($result["price"]));	
			   $_SESSION['giacu'] =formatso($result["price"]) ;
			   $template->assign("giachan", formatso($result["giachan"]));	
			   $template->assign("donvi" ,composx("donvi","Name",$result["DV"],"Rank"));	
   			   $template->assign("giamgia", $result["giamgia"]);	
			    $template->assign("note1", $result["note1"]);			   
			   $template->assign("baohanh", $result["baohanh"]);
			   $template->assign("nhomhang",composx("nhomhang","Name",$result["IDnhom"],""));	
			   $template->assign("loaihang",composx("loaihang","Name",$result["IDloai"],""));	
			   $template->assign("mausac",composx("mausac","Name",$result["mau"],""));	
			    $template->assign("size",composx("size","Name",$result["size"],""));
					$status = "status" .ord( $result["status"]) ;
			   $template->assign($status,"selected");
			   if ($result["LoaiTien"] == "USD" )
			   {
			   	$VND = "" ;
				$USD = "selected" ;
			   }else
			   {
			   	$VND = "selected" ;
				$USD = "" ;
			   }			   
			   $template->assign("VND", $VND);
			   $template->assign("USD", $USD);
			   
  			   
			   $_SESSION['file'] = $result["images"] ;
			   $template->assign("IDGroup",$result["IDGroup"]);
			   $IDGroup = $result["IDGroup"] ; 
			   $IDG = $IDGroup ;
			    
			   $template->assign("Rank",$result["Rank"]);
				HTCayThuMuc($IDGroup ) ;
				$template->assign("cay",$tam);	
		}
 
		
		$template->assign("donglai",$donglai);
 		$template->assign("upload","source/upload.php");
	    $template->parse("main.block_pro");
	}
}
 
  
?>