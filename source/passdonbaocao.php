<?php
session_start();
	if (!defined("IN_SITE"))	{    	die('Hacking attempt!');	}
 $IDTao = $_SESSION["LoginID"] ;
  $donglai = "none" ;
  //=============================khoi tao ======================//  	 Xem  	 Them  	 Cap nhap  	 Tim  	Huy  	Khoa  	In
 	$data->setthaotac = "online" 	;
      if (kiemtraquyenthumuc(15,"xem")== 0 )     {  echo " <meta http-equiv='refresh'content='1;url=default.php'>"; return ;}	
 	if (kiemtraquyenthumuc(15,"them")== 0)    {  $template->assign("q_them","none");  }
	if( kiemtraquyenthumuc(15,"capnhap") ==0 )  {  $template->assign("q_capnhap","none");   }
 	//if (!($_SESSION["admintuan"]))     {  $template->assign("q_xoa","none");  }
	
	if($IDTao ==1) { $capnhap ="" ; $admindisabled ='';} else  { $capnhap =" and IDtao='$IDTao' ";$admindisabled ='disabled';}
	 
  //=======================================================================================	
$template->assign("images", "blank.gif"); 
 $template->assign("kho",composx("cuahang","Name",''," where idnhomcc<>8 and ID >0")); 
$template->assign("lydonhapxuat",composx("lydonhapxuat","Name",'',"")); 

//=============================================	
if ($_POST["cancel"] != "")
{
	$ID = "" ;
	$_GET["id"] = "" ;
} 
  $ngaytao = gmdate('Y-m-d H:i:s', time() + 7*3600) ;
  
   
$sql_where = "";
$sql_where= " where 1=1 ";
 
        $tenkhachtk   = addslashes($_REQUEST["tenkhachtk"])   ;
        $codeprotk   =addslashes($_REQUEST["codeprotk"])   ;
		$mavd = addslashes($_REQUEST["mavd"]) ;
		$teltk = addslashes($_REQUEST["teltk"]) ; 
		$tinhtrangtk = laso($_REQUEST["tinhtrangtk"]) ; 
		$tinhtranghangtk = laso($_REQUEST["tinhtranghangtk"]) ; 
		 
		if (laso($_REQUEST["page"])>0 ) 
		{
			$mavd   = $_SESSION["mavd"]    ;
            $codeprotk =  $_SESSION["codeprotk"]    ;
		    $tenkhachtk = addslashes($_SESSION["tenkhachtk"]) ;
			$teltk   = $_SESSION["teltk"]    ;
			$tinhtrangtk   = $_SESSION["tinhtrangtk"]    ;
			$tinhtranghangtk   = $_SESSION["tinhtranghangtk"]    ;
		} else
		{
		      $_SESSION["codeprotk"]  = $codeprotk   ;
              $_SESSION["mavd"] = $mavd   ;
		         $_SESSION["tenkhachtk"]   = $tenkhachtk ;
				  $_SESSION["teltk"]   = $teltk ;
				   $_SESSION["tinhtrangtk"]   = $tinhtrangtk ;
				    $_SESSION["tinhtranghangtk"]   = $tinhtranghangtk ;
		}
		
		 if($codeprotk!="")
			$sql_where.=" and masp like '%".$codeprotk."%'";
		if($mavd!="")
			$sql_where.=" and madonvan  like '%".$mavd."%'";
		if($tenkhachtk!="")
			$sql_where.=" and tenkhach  like '%".$tenkhachtk."%'";
		if($teltk!="")
		 { $tam=$teltk ;
			 if($teltk[0]==0 )  $tam[0]="";
			    
				$sql_where.=" and tel  like '%".trim($tam)."%'";  
			 
		 } 
		 if($tinhtrangtk>0)
		 { 	$sql_where.=" and tinhtrang= $tinhtrangtk  "; 		}
		 if($tinhtranghangtk>0)
		 { 	$sql_where.=" and tinhtranghang= $tinhtranghangtk  "; 		}
		 
	    $template->assign("codeprotk",$codeprotk );		
		 $template->assign("mavd",$mavd );	
		  $template->assign("tenkhach",$tenkhach );	
		   $template->assign("teltk",$teltk );	
  	   $template->assign("tinhtrangtk", compoloai("tinhtrang","Name","manhomhang",$tinhtrangtk," where loai =1   "));	
   $template->assign("tinhtranghangtk", compoloai("tinhtrang","Name","manhomhang",$tinhtranghangtk," where loai =2   "));

	
 
 
if ($_POST["btnUpdate"] != "")
{ 	
		$ID =  $_GET["id"]  ;
		$facebook= addslashes($_POST["facebook"] );
		$tenkhach= addslashes($_POST["tenkhach"] );
		$diachi= addslashes($_POST["diachi"] );
		$tel= addslashes($_POST["tel"] );
		$nvdonggoi= laso($_POST["nvdonggoi"] );
		$nvban= laso($_POST["nvban"] );
		$masp=  ($_POST["masp"] );
		$sohdtn= addslashes($_POST["sohdtn"] );
		$sohdkt= addslashes($_POST["sohdkt"] );
		$loaidon= addslashes($_POST["loaidon"] );
		$tinhtrang= addslashes($_POST["tinhtrang"] );
		$madonvan= addslashes($_POST["madonvan"] );
		$tinhtranghang= addslashes($_POST["tinhtranghang"] );
		$tongbill= laso($_POST["tongbill"] );
		$ship= laso($_POST["ship"] );
		$tongtien= laso($_POST["tongtien"] );
		$chokhachxem= addslashes($_POST["chokhachxem"] );
		$dienthoaishop= addslashes($_POST["dienthoaishop"] );
  		$dachuyenkhoan = laso($_POST["dachuyenkhoan"] );
		$note = addslashes($_POST["note"] );
	    $idkhach = laso($_POST["idkhach"] );
	 
   
	 $ngay  = gmdate('Y-n-d', time() + 7*3600) ;	  
   
  $NgayTao = gmdate('Y-n-d H:i:s', time() + 7*3600) ;
   $Ngay  = gmdate('Y-n-d', time() + 7*3600) ;
		if  ($_GET["id"] == "-1")
		{
		   $sql = "select ID from online where  tel='$tel' and  masp='$masp' and  ngaytao>='$Ngay'";
  		   $tam =getdong($sql);
			  if (laso($tam)== 0 )
			  {
				  if($idkhach==0)
				  {
				  	 $sql =" insert into  customer set  tel='$tel',name='$tenkhach',address='$diachi',mst='$facebook',idtao='$idtao',ngaytao='$NgayTao',nhomkh=4 ";
					   $update = $data->query($sql);
				  }
					   
 				   $sql ="insert into  online set    facebook='$facebook',tenkhach='$tenkhach',diachi='$diachi',tel='$tel',nvdonggoi='$nvdonggoi',nvban='$IDTao',masp='$masp',sohdtn='$sohdtn',sohdkt='$sohdkt',loaidon='$loaidon',tinhtrang='1',madonvan='$madonvan',tinhtranghang='$tinhtranghang',tongbill='$tongbill',ship='$ship',tongtien='$tongtien',chokhachxem='$chokhachxem',dienthoaishop='$dienthoaishop',IDTao='$IDTao',ngaytao='$ngaytao',dachuyenkhoan='$dachuyenkhoan',note='$note'   " ; 
			   
			  $update = $data->query($sql);
		 
			   
			  }
		} 
		else
		{
  			   $sql ="UPDATE online set  facebook='$facebook',tenkhach='$tenkhach',diachi='$diachi',tel='$tel'  ,masp='$masp',sohdtn='$sohdtn',sohdkt='$sohdkt',loaidon='$loaidon', madonvan='$madonvan',tinhtranghang='$tinhtranghang',tongbill='$tongbill',ship='$ship',tongtien='$tongtien',chokhachxem='$chokhachxem',dienthoaishop='$dienthoaishop' ,ngaytao='$ngaytao',dachuyenkhoan='$dachuyenkhoan',note='$note' where ID = '$ID'  $capnhap  " ; 
 			  $update = $data->query($sql);
 			 
		} 
	 	//  echo $sql ;
		
		$them = true;
	 
}	
 //======================xoa tin==================================================
  		
 
 if( $_REQUEST["huydon"])
   {    $NgayTao = gmdate('Y-n-d H:i:s', time() + 7*3600) ;
	   	$ID =  $_GET["id"]  ;
	   $sql = " update online set  ngaykhoa='$NgayTao',IDkhoa='$IDTao',tinhtranghang='10',tinhtrang=23 where id= '$ID' and (IDkhoa=$IDTao or IDkhoa=0) and tinhtranghang<>19 ";
	//  echo $sql ;
	   $tam=getdong($sql);
	
   }

   $del =  laso($_GET["Del"]); 
 
if ( $del != ""  )
{ 
		$IDD = $del ;
		 $Ngaychoxoa = gmdate('Y-n-d H:i:s', time() + 6*3600) ;
		$sql = "delete from  online where ID = '0".$IDD."'  and ngaytao>'$Ngaychoxoa'  and idtn=0 and idlayhang=0 and idchotdon=0 and idtao ='$IDTao' " ;
	// echo $sql ; return ;
		$update = $data->query($sql);
		 
		$xoa = true ;
}
{
 	$tam = "" ;
	$kt = 0 ;	
	if ($_REQUEST["id"] == "" || $them  || $xoa ||  $_POST["search"] != "" || $_POST["xoadl"] != "")
	{
//================================
  function chuyen($tam)
  { global $mangdaco ;
	global $chuoitrave;
	global $mauve;
 	 if ( $tam != '')
     {
	   $tam = explode("&*!",$tam) ;
		$k =0; $sopt = count ($tam) ;
		 
		if ($sopt <2)  $chuoisp = $result_news["masp"] ;
		else
		{
			$mang = ''; $chuoisp='';
			for($i=1 ;$i<=$sopt ;$i++)
			{   if ($k==0)  {$idm = $tam[$i]; $k =1 ; } 
				else if($k==1) 
				{
					if(laso($mangdaco[$idm])=='0')
					{
					 $sql = " select sum(a.soluong) as sl from hanghoacuahang a left join products b on a.idsp=b.id where a.soluong>0 and a.idcuahang>1 and b.codepro='$idm'  ";$tamsl=getdong($sql);
				     $mangdaco[$idm]=$tamsl['sl'];
					}
					if($mangdaco[$idm]>0) { $soluongco=  " <b  style='color:red' > Về:".$mangdaco[$idm]."</b>"; $mauve="blue";}
					else  {$soluongco= "";$mauve="";}
					if($chuoisp=='') {$chuoisp =$tam[$i] .$soluongco ;} else { $chuoisp .= "<br>".$tam[$i] .$soluongco ;} 
					 $mang["$idm"]=$tam[$i]; $k =2 ;
						
				}
				elseif( $k==2) { $sl = $tam[$i] ; $k =3 ; }
 				elseif( $k==3)  {$gia = $tam[$i]; $k =0 ; }
 		
			}
		}
       }	
	   return $chuoisp;
  }

  //======================================
	$IDGroup = $_POST["IDGroup"]  ;
		$IDnhom = $_POST["nhomhang"]  ;
		$IDloai = $_POST["loaihang"]  ;
		$mau = $_POST["mau"]  ;
		$IDGrouptk = $_POST["IDGrouptk"]  ;
 	  		
  
 	    $template->parse("main.block_proht1"); 
		$sql = "SELECT ID FROM online $sql_where order by ID desc ";
 		 

		$query_rows = $data->query($sql);
		$num=$data->num_rows($query_rows);

		$page_start=0;
		$page_row = 200 ;
		include("paging.php");
		$list_page=paging($num);
		
 
  
		$sql = "SELECT *,(ADDTIME(CURRENT_TIMESTAMP(),-3600)< ngaytao" ;
 	 	$sql.=" )as xoadon,DATE_FORMAT( ngaylayhang,'%s') as tinhtranglayhang,DATE_FORMAT( ngaychotdon,'%s') as tinhtrangchotdon,DATE_FORMAT(NgayTao,'%d/%m/%y %H:%i') as ngaytao FROM online  ".$sql_where." $capnhap ORDER BY ID desc  limit $page_start,$page_row";   
	// echo $sql ; return ;
	// if($_SESSION["admintuan"]) echo $sql ;  	 
		$query_rows = $data->query($sql);
		$result_rows = $data->num_rows($query_rows);
		$result = $data->query($sql);
		$i = $page_start; 
		if ($them) {  $template->parse("main.block_proupdate") ;} 
//		$SOST = 0 ;
 		$mangtinhtrangmau = taomang("tinhtrang","ID","mau");
		$mangtinhtrang = taomang("tinhtrang","ID","manhomhang");	
	    $mangtinhtrangten = taomang("tinhtrang","ID","name");	 
		$mangnhanvien =taomang("userac","ID","ten"," where ID >0 and   loai in(16,5,6,10)  ");  
		 $mangnhanvien[1]='admin';	
		 $mangchotdon[1]="Chưa gọi được";
		 $mangchotdon[2]="Đã gọi khách";
		 $mangchotdon[3]="Đã hủy đơn";
 

		while(($result_news = $data->fetch_array($result)  )	&& ($SOST < $page_row))	
		{  
			$i=$i+1;
//			$SOST =$SOST +1;
			if($mau == "white")
				$mau = "#EEEEEE";
			else
			$mau = "white";
		 
			$template->assign("mau", $mangtinhtrangmau[$result_news["tinhtrang"]]);			
			$template->assign("color", $mau);
			$template->assign("ID",$result_news["ID"]);
			$template->assign("stt", $i);
			$template->assign("tenkhach", $result_news["tenkhach"]);
			if($result_news["tel"][0]!='0') $result_news["tel"]='0'.$result_news["tel"];
 		    $template->assign("tel",$result_news["tel"]);
			if($result_news["xoadon"]==1 )  $template->assign("chophepxoa",""); else  $template->assign("chophepxoa","none");
			
		     $tam=$result_news["masp"] ;   
			 
			 //=====================================
	   
 $nvtao  ="<table class='hienthiol'><tr><td class='hienthiol1'>1: ".$mangnhanvien[$result_news['IDtao']]."</td> ";
 $nvtao .= "<td class='hienthiol2'>Đã tạo đơn</td></tr>"  ;
if( $result_news['IDlayhang']>0) {$nvtao .="<tr ><td>2: ".$mangnhanvien[$result_news['IDlayhang']]."</td> "  ;
 $nvtao .="<td>" . $mangtinhtrangten[1*$result_news['tinhtranglayhang']]."</td></tr> "  ;
}
if( $result_news['IDchotdon']>0) {$nvtao .="<tr><td>3: ".$mangnhanvien[$result_news['IDchotdon']] ."</td> "  ;
 $nvtao .="<td>"  . $mangchotdon[1*$result_news['tinhtrangchotdon']] ."</td></tr> "  ;
}
if( $result_news['IDTN']>0)    {  $nvtao .="<tr><td>4: ".$mangnhanvien[$result_news['IDTN']] ."</td> "  ;
 $nvtao .="<td>" .  $mangtinhtrangten[5]  ."</td></tr> "  ;
	}
 $nvtao  .="</table>";
      $template->assign("nvtao",$nvtao);
    //=================================================
	        
		    $template->assign("masp",chuyen($tam));
			$template->assign("sohdtn", $result_news["sohdtn"]);
			$template->assign("sohdkt", $result_news["sohdkt"]);
			$template->assign("tongbill",  formatso($result_news["tongbill"]));
			$template->assign("ship",  formatso($result_news["ship"]));
			$template->assign("tongtien", formatso($result_news["tongtien"]));
	 
			$template->assign("ngaytao", $result_news["ngaytao"]);
			$template->assign("facebook", $result_news["facebook"]);
			//$va3  = str_replace("'", "\'", $result_news["note"]);
			//$va3   = str_replace(chr(13), '<br>',$va3);
			//$va3   = str_replace(chr(10), '',$va3);
		  //  $template->assign("notet",$va3);
		    $template->assign("note",$result_news["note"]+ " - "+$result_news["note1"]);
		    $template->assign("madonvan", $result_news["madonvan"]);  
			$template->assign("giamgia", $result_news["giamgia"]);
			$template->assign("baohanh", $result_news["baohanh"]);
			$template->assign("hinhanh", $result_news["images"]);
		//	$template->assign("tinhtrang",$mangtinhtrang[$result_news['tinhtrang']]);
		//	$template->assign("tinhtrangten",$mangtinhtrangten[$result_news['tinhtrang']]);
			$template->assign("tinhtranghang",$mangtinhtrang[$result_news['tinhtranghang']]);
		//	$template->assign("tinhtranghangten",$mangtinhtrangten[$result_news['tinhtranghang']]);
		
			
			
		  $template->parse("main.block_proht"); 

		 }
			$template->assign("list_page",$list_page);  // phan trang
		  	  $template->parse("main.block_proht2"); 	  
	}
	 else	
	{ 
	   $template->assign("manhom",composx("groupproduct","ma",0,""));		  
		if ($_REQUEST["id"] == "-1")
		{ 
		   $template->assign("t-c","Thêm Mới Phiếu" );
		   $template->assign("idgoi",$_POST["id"]);
		   $template->assign("Rank","1");
		   $template->assign("loai",0);
		   $template->assign("Name",$_REQUEST["t1"]);
		   $template->assign("codepro",$_REQUEST["t2"]);
		   $template->assign("code",$_REQUEST["t3"]);
		   $template->assign("mausac",composx("mausac","Name",0,""));
		   $template->assign("size",composx("size","Name",0,""));		  
	//	   $template->assign("tinhtrang", compoloai("tinhtrang","Name","manhomhang",1," where loai =1   "));	
	//	   $template->assign("tinhtranghang", compoloai("tinhtrang","Name","manhomhang",0," where loai =2   "));
		    $template->assign("loaitien", composx("loaitien","Name",0," order by id"));
		    $tam =  compoloai("userac","manv","ten",0," where ID >=2 and   loai=16 ");	
  			$template->assign("nvdonggoi",$tam);
 		   $template->assign("chophephuy",'none');
			
			$tam =  compoloai("userac","manv","ten",$IDTao," where ID ='$IDTao' and  loai <> -1 ");	
 			$template->assign("nvban",  $tam);  
			 
		   $template->assign("loai",0);
			//function composx($table,$Name,$cat_id,$cotsapxep)
			$template->assign("donvi" ,composx("donvi","Name",$result_news["DV"],"Rank"));
		 
 			if (trim($_REQUEST["t4"]) != '')   $donglai = '' ;
			
		 
			 
		}
		else		
		{
			$sql ="SELECT * FROM  online WHERE ID='".$_REQUEST["id"]."'";
			$query = $data->query($sql);
			$result = $data->fetch_array($query);
			   $template->assign("t-c","Cập Nhập Phiếu" );
			   $template->assign("madonvan",$result["madonvan"]);
				$template->assign("ID",$result["ID"]);
			  $template->assign("loaitien", composx("loaitien","Name",0,""));
 			$template->assign("tenkhach", $result["tenkhach"]);
 		    $template->assign("tel",$result["tel"]);
			  $template->assign("chophephuy",'');
			$tam=$result["masp"] ;   
	 if ( $tam != '')
     {
	   $tam = explode("&*!",$tam) ;
		$k =0; $sopt = count ($tam) ;
		$mang = ''; $chuoisp='';
 		for($i=1 ;$i<=$sopt ;$i++)
		{   if ($k==0) $k =1 ; else $k =0;
			if( $k==1) $idm = $tam[$i] ; else { $mang["$idm"] =$tam[$i] ; }
			if ($chuoisp=='') $chuoisp = $tam[$i]; else  $chuoisp .= "<br>" . $tam[$i] ;
 		}
       }		
			
		    $template->assign("chaymasp","chaymasp() ;");
			$template->assign("masp",$result["masp"]);
			$template->assign("sohdtn", $result["sohdtn"]);
			$template->assign("sohdkt", $result["sohdkt"]);
			$template->assign("ship", $result["ship"]);
			$template->assign("tongbill", formatso($result["tongbill"]));
 			$template->assign("note", $result["note"]);
			$template->assign("dachuyenkhoan", $result["dachuyenkhoan"]);
			$template->assign("ngaytao", $result["ngaytao"]);
			$template->assign("tongtien",formatso($result["tongbill"]+$result["ship"]-$result["dachuyenkhoan"]));
	  //		$template->assign("tinhtrang", compoloai("tinhtrang","Name","manhomhang", $result["tinhtrang"]," where loai =1   "));	
	//	    $template->assign("tinhtranghang", compoloai("tinhtrang","Name","manhomhang",$result["tinhtranghang"]," where loai =2   "));
		    
			$template->assign("ngaytao", $result["ngaytao"]);
			 $template->assign("facebook", $result["facebook"]);
			  $template->assign("diachi", $result["diachi"]);
			$template->assign("chokhachxem". $result["chokhachxem"]," selected");
		    $template->assign("loaidon". $result["loaidon"]," selected");
			  
		    $tam =  compoloai("userac","manv","ten",$result["nvdonggoi"]," where ID >=2 and  loai <> -1 ");	
 			$template->assign("nvdonggoi",  $tam);
			$tam =  compoloai("userac","manv","ten",$result["nvban"]," where ID >=2 and  loai <> -1 ");	
 			$template->assign("nvban",  $tam); 		}
 
		
		$template->assign("donglai",$donglai);
 		$template->assign("upload","source/upload.php");
	    $template->parse("main.block_pro");
	}
}
 
  
?>