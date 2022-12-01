<?php
session_start();
if ($_SESSION["dangnhap"]=="") return ;
$IDTao = $_SESSION["LoginID"]  ;
 
     $_SESSION["frm_xuathang"] = "" ;
	if (!defined("IN_SITE")) 	{    	die('Hacking attempt!');	}
	 
 //echo "ok";
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
$mangthongtinbb=[14,15,16,17,18,19,20,21,22,23,24,25,26];
if ($_POST["btnUpdate"] != ""   )
{ 	
	     
		$ID   =		   chonghack($_GET["id"]) ;
		$ma =  	  addslashes(chonghack($_POST["madk"])) ;
		$ten = 	   addslashes(chonghack($_POST["tendk"])) ;
		 $no = 	   laso($_POST["tkno"]) ;
	 	 $co = 	 laso($_POST["tkco"]) ;
		  $loai = 	 laso($_POST["loai"]) ;
	 	  $xacnhan = 	  laso($_POST["xacnhanc"]);
		   $duyetnhieu =$_POST["duyetnhieu"]?1:0;
		  
		  $chuoithongtin='';
		  $i=0;
		  foreach($mangthongtinbb as $value){
		  		if(laso($_POST["ttbb_".$value]) !=0){
					$chuoithongtin.=laso($_POST["ttbb_".$value]).'*';
				}
			
		  }
		  $chuoithongtin=rtrim($chuoithongtin,"*");
		  //$thongtin = 	   addslashes(laso($_POST["ttbb"]));
		 // var_dump($co);
		  
		if($_GET["id"] == "-1")
		{
		 
		  	$sql ="insert into dinhkhoanthuchi set   ma='$ma', ten='$ten', no='$no',co='$co',xacnhan='$xacnhan',thongtin='$chuoithongtin', loai='$loai', duyetnhieu='$duyetnhieu'";
		  
		} 
		else
		{
	 		$sql ="Update  dinhkhoanthuchi set   ma='$ma', ten='$ten', no='$no',co='$co',xacnhan='$xacnhan',thongtin='$chuoithongtin',loai='$loai',duyetnhieu='$duyetnhieu' where ID='0$ID'";
		  
		
			$them = true;
 
		}
		  $update = $data->query($sql);
	 
}	

$template->assign("idtk",'tk');
if ($_POST["btnUpdateTk"] != ""   )
{ 	
	     
		$ID   =	chonghack($_GET["id"]) ;
		$ma =  	  addslashes(chonghack($_POST["matk"])) ;
		$ten = 	   addslashes(chonghack($_POST["tentk"])) ;
		$tenen = 	   addslashes(chonghack($_POST["tenen"])) ;
		$ghichu = 	   addslashes(chonghack($_POST["ghichutk"])) ;
		$loaitk = 	   laso($_POST["loaitk"]);
		
		
		if($ID == "tk")
		{
		
			if($loaitk==0 || $loaitk==1 || $loaitk==3){
					$sql ="insert into dinhkhoan set   madinhkhoan='$ma', tendinhkhoan='$ten',ghichu='$ghichu',loai='$loaitk',tenen='$tenen'";
					 $update = $data->query($sql);
			}
			else if($loaitk==2){
				$sql ="insert into dinhkhoan set   madinhkhoan='$ma', tendinhkhoan='$ten',ghichu='$ghichu',loai='0',tenen='$tenen'";
				 $update = $data->query($sql);
				$sql ="insert into dinhkhoan set   madinhkhoan='$ma', tendinhkhoan='$ten',ghichu='$ghichu',loai='1',tenen='$tenen'";
				 $update = $data->query($sql);
			}
		  
		} 
		else
		{
				$sql="select loai,ID from dinhkhoan where madinhkhoan='$ma'";
				$query=$data->query($sql);
				$numrow=$data->num_rows($query);
				
				if($numrow>1){
					if($loaitk==0 || $loaitk==1 || $loaitk==3){
				
						$ktam=0;
							while($re=$data->fetch_array($query)){
								if($ktam==0){
										$sql ="delete from dinhkhoan where ID='$re[ID]'";
											//var_dump($sql);
											//return;
									 $update = $data->query($sql);
								}
								else{
										$sql ="Update  dinhkhoan set  madinhkhoan='$ma', tendinhkhoan='$ten',ghichu='$ghichu',loai='0',tenen='$tenen' where ID='$re[ID]'";
									 $update = $data->query($sql);
								}
								$ktam++;
							}
					}
					else{
					
					}
					
						
				}
				else{
					if($loaitk==0 || $loaitk==1 || $loaitk==3){
							$sql ="Update  dinhkhoan set  madinhkhoan='$ma', tendinhkhoan='$ten',ghichu='$ghichu',loai='$loaitk',tenen='$tenen' where ID='0$ID'";
							 $update = $data->query($sql);
					}
					else{
							$dong=getdong($sql);
							if($dong['loai']==1){
								$sql ="insert into dinhkhoan set   madinhkhoan='$ma', tendinhkhoan='$ten',ghichu='$ghichu',loai='0',tenen='$tenen'";
								$update = $data->query($sql);
							}
							else if($dong['loai']==0){
								$sql ="insert into dinhkhoan set   madinhkhoan='$ma', tendinhkhoan='$ten',ghichu='$ghichu',loai='1',tenen='$tenen'";
								 $update = $data->query($sql);
								}
							
					}
				}
	
			
 
		}
		
	 	$template->parse("main.block_themtkthanhcong");
}
    $del =  laso($_GET["Del"]); 
  // $ktxoa = kiemtraxoa("phieunhapxuat","IDNhaCC"," where  IDNhaCC ='$del'  limit 0,1 ") ;
  // $ktxoa1 = kiemtraxoa("baogia","MaKH"," where  MaKH ='$del'  limit 0,1 ") ;
  if ($ktxoa == 1  || $ktxoa1 == 1)
  {
 	 $template->parse("main.block_khongxoa");
  }
  $IDD = $_GET["Del"] ;
  if($IDD>0 && $_REQUEST["view"]=="tk"){
  
 	 $sql="select loai,ID from dinhkhoan where madinhkhoan=(select madinhkhoan from dinhkhoan where ID='$IDD')";
	
			 $query=$data->query($sql);
				$numrow=$data->num_rows($query);
		if($numrow>1){
			while($re=$data->fetch_array($query)){
					$sql = "delete from  dinhkhoan where ID = '$re[ID]'" ;
						$update = $data->query($sql);
			}
		}
		else{
			$sql = "delete from  dinhkhoan where ID = '0".$IDD."'" ;
			$update = $data->query($sql);
		}		
				
		
		$template->parse("main.block_xoatk");
		$xoa = true ;

}else if ($IDD >0 && !isset($_REQUEST["view"]) ) 
 { 
 		$sql = "delete from  dinhkhoanthuchi where ID = '0".$IDD."'" ;
		$update = $data->query($sql);
		$template->parse("main.block_xoa");
		$xoa = true ;
 }	


 	$tam = "" ;
	$kt = 0 ;	
 
	if ($_REQUEST["id"] == ""  || $them  || $xoa ||  $_POST["search"] != "" )
	{    
		
		$NameS = chonghack($_POST["ten"]) ;
		$maS = chonghack($_POST["ma"]) ;
		$loaiS = laso($_POST["loaitk"]) ;
		$sapxep = chonghack($_POST["sapxep"]) ;
		$template->assign("tendk",$NameS);
		$template->assign("madk",$maS);
			
  	    $template->parse("main.block_cusht2.block_cusht1"); 
		$sql = "SELECT ID FROM dinhkhoanthuchi a ";

		$sql_where=" where 1=1 ";
		if($NameS!="")
			$sql_where.=" and a.ten like '%".$NameS."%' ";
				if($maS!="")
			$sql_where.=" and a.ma like '%".$maS."%' ";
		
			
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
		/*$page_start=0;
		include("paging.php");
		$list_page=paging($num);	
		 $page_row =100 ;*/
		$sql = "SELECT a.ID,a.ma,a.ten,a.no,a.co,a.xacnhan,a.thongtin,a.loai FROM dinhkhoanthuchi a ".$sql_where." ORDER BY ".$sapxep." desc ";
	 
	 	//echo $sql;
 		/*$query_rows = $data->query($sql);
		$result_rows = $data->num_rows($query_rows);
		
		$i = $page_start;*/ 
		$result = $data->query($sql);
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
				$template->assign("ten", $result_news["ten"]);
				$template->assign("no", getten("dinhkhoan",$result_news["no"],'madinhkhoan'));
				$template->assign("co", getten("dinhkhoan",$result_news["co"],'madinhkhoan'));
				$template->assign("ma",$result_news["ma"]);
				//$selectedloai1=$result_news["loai"]==1?"selected='selected'":"";
				//$selectedloai2=$result_news["loai"]==2?"selected='selected'":"";
				$loaitc=$result_news["loai"];
				
				if($loaitc==1){
					$template->assign("loaishow","Thu");
				}
				else if($loaitc==2){
					$template->assign("loaishow","Chi");
				}
				else{
					$template->assign("loaishow","Chưa xác định");
				}
				$nhanvienxacnhan='';
				if(strlen(trim($result_news["xacnhan"]))>1){
					for($i=0;$i<strlen($result_news["xacnhan"]);$i++){
						
						if($result_news["xacnhan"][$i]==1) $nhanvienxacnhan.='Thủ quỷ XN<br/>';
						if($result_news["xacnhan"][$i]==2) $nhanvienxacnhan.='Kế toán Online XN<br/>';
						if($result_news["xacnhan"][$i]==3) $nhanvienxacnhan.='Kế toán cửa hàng XN<br/>';
					}
					//echo $nhanvienxacnhan;
				}
				else{
				
					if($result_news["xacnhan"]==1) $nhanvienxacnhan='Thủ quỷ XN';
					if($result_news["xacnhan"]==2) $nhanvienxacnhan='Kế toán Online XN';
					if($result_news["xacnhan"]==3) $nhanvienxacnhan='Kế toán cửa hàng XN';
				}
				
				$template->assign("xacnhan",$nhanvienxacnhan);
   			    $template->parse("main.block_cusht2.block_cusht"); 
		     	$i++; 
		}	
			$template->assign("list_page",$list_page);  // phan trang
		  $template->parse("main.block_cusht2"); 
 	}
	else if($_REQUEST["id"] == "dstk" && $_REQUEST["view"] == "tk"){
	
		$act='dinhkhoanthuchi&id=dstk&view=tk';
			$mangtaikhoan=taomangtaikhoan();
			$template->assign("t-c","Danh Sách Tài Khoản" );
			
			$NameS = chonghack($_POST["tentks"]) ;
			
			$maS = chonghack($_POST["matks"]);
			
		$loaiS =$_POST["loaitks"];
			//echo $loaiS;
		$sapxep = chonghack($_POST["sapxep"]) ;
		$template->assign("tendk",$NameS);
		$template->assign("madks",$maS);
		$template->assign("loai_".$loaiS,"selected");
  	    $template->parse("main.block_dstaikhoan.block_cusht1"); 
		$sql = "SELECT ID FROM dinhkhoan  a";
		$checktim=0;
		$sql_where=" where 1=1 ";
		
		if($NameS!="")
			{ $sql_where.=" and a.tendinhkhoan like '%".$NameS."%' "; $limitsql=" 0,100 "; $checktim=1;}
				if($maS!=""){
			$sql_where.=" and a.madinhkhoan like '%".$maS."%'"; $limitsql=" limit 0,100 "; $checktim=1;}
			if($loaiS!=""){
					if($loaiS!=2){
						$sql_where.=" and loai=".$loaiS;
					}
					else{
					$sql_where.="";
					}
				$limitsql=" limit 0,50 "; $checktim=1;
			}
			
		$sql .=$sql_where;
		
   		//echo $sql;
		$query_rows = $data->query($sql);
		//$result_rows = $data->num_rows($query_rows);
		//$result = $data->query($sql);
		$num=$data->num_rows($query_rows);
		if ($them) {  $template->parse("main.block_cusupdate") ;} 
		
		//$SOST = 0 ;
		// phan trang===================================================================
   	   if ($sapxep =="")$sapxep = "ID";
	   $template->assign("sapxep".$sapxep, "selected");
		/*$page_start=0;
		 $page_row =100 ;
		include("paging.php");
		
		$list_page=paging($num);	
		if($checktim==0){
			$limitsql=" limit $page_start,$page_row ";
		
		}*/
		$sql = "SELECT a.ID,a.madinhkhoan,a.tendinhkhoan,a.tenen,a.ghichu,a.loai FROM dinhkhoan a ".$sql_where."  ORDER BY ".$sapxep." desc ";
		//echo $sql;
 		$query_rows = $data->query($sql);
		/*$result_rows = $data->num_rows($query_rows);
		$result = $data->query($sql);
		$i = $page_start; */
//=========================================================
 	$maduynhat='';
		while($result_news = $data->fetch_array($query_rows))		
		{  
 				
				
				if($maduynhat==$result_news["madinhkhoan"]){
					continue;
				}
				$maduynhat=$result_news["madinhkhoan"];
				if($mau == "white")
					$mau = "#EEEEEE";
				else
				$mau = "white";
							
				$template->assign("color", $mau);
				$template->assign("ID",$result_news["ID"]);
				$template->assign("stt", $i+1);
				$template->assign("ten", $result_news["tendinhkhoan"]);
				$template->assign("tenen", $result_news["tenen"]);
				$template->assign("ma",$result_news["madinhkhoan"]);
				$template->assign("ghichu",$result_news["ghichu"]);
				$template->assign("ngungtheodoi",$result_news["ngungtheodoi"]==1?"TRUE":"FALSE");
				$loai='';
				
				//echo $mangtaikhoan[$result_news["madinhkhoan"]];
				if($mangtaikhoan[$result_news["madinhkhoan"]]==1){
					if($result_news["loai"]==0) $loai='Dư có';
					if($result_news["loai"]==1) $loai='Dư nợ';
				}
				else if($mangtaikhoan[$result_news["madinhkhoan"]]==2){
					$loai='Lưỡng tính';
				}else if($mangtaikhoan[$result_news["madinhkhoan"]]==3){
					$loai='không xác định';
				}
				
				$template->assign("loai",$loai);
   			    $template->parse("main.block_dstaikhoan.block_cusht"); 
				$i++; 
		}	
		$template->assign("list_page",$list_page);  // phan trang
		  $template->parse("main.block_dstaikhoan"); 
				
	}
	 else if($_REQUEST["id"] && !isset($_REQUEST["view"]))	
	{ 
		$template->assign("htxe", "none");
		 $template->assign("idgoi",$_REQUEST["id"]);
		
		if ($_REQUEST["id"] == "-1" )
		{// assign("tinh",composx("tinh","Name","ID","  order by Name ")) where loai=0 where loai=1
		
			//echo $_REQUEST["id"];
		  	 $template->assign("t-c","Thêm Mới Định khoản thu chi" );
			  $template->assign("tkco",composx("dinhkhoan","madinhkhoan","ID","", '')); 
		 
		   $template->assign("tkno",composx("dinhkhoan","madinhkhoan","ID","", '')); 
		    $template->parse("main.block_cus.block_themdinhkhoan");
		}
		
		else if ($_REQUEST["id"] != "tk" && $_REQUEST["id"] != "-1" && $_REQUEST["view"] == "")		
		{
			$sql ="SELECT a.ID,a.ma,a.ten,a.duyetnhieu,a.no,a.co,a.xacnhan,a.thongtin,a.loai  FROM  dinhkhoanthuchi a WHERE ID='".laso($_REQUEST["id"])."'";
			$query = $data->query($sql);
			$result = $data->fetch_array($query);
				$template->assign("t-c","Cập nhập Định khoản" );
 				 
				$template->assign("ten",$result["ten"]);
				$template->assign("ma",$result["ma"]);
				$template->assign("ID",$result["ID"]);
				if($result["duyetnhieu"]==1){
					$template->assign("duyetnhieu","checked='checked'");
				}
				
		//	echo "<br> aaaa".$result["duyetnhieu"]."<br>";
					//echo $result["co"]."<br>";
			 $template->assign("tkno",composx("dinhkhoan","madinhkhoan",$result["no"],"", ' '));
			 $template->assign("tkco",composx("dinhkhoan","madinhkhoan",$result["co"],"", ' ')); 
			
		// var_dump(composx("dinhkhoan","madinhkhoan",$result["co"],"ID", ' where loai=0'));
		  		//$selectedloai1=$result["loai"]==1?"selected='selected'":"";
				//$selectedloai2=$result["loai"]==2?"selected='selected'":"";
					$loaitc=$result["loai"];
				$template->assign("selectedloai1","");
				$template->assign("selectedloai2","");
				if($loaitc==1){
					$template->assign("selectedloai1","selected='selected'");
					
				}
				else if($loaitc==2){
					$template->assign("selectedloai2","selected='selected'");
				}
						
				$nhanvienxacnhan='';
				 $template->assign("xacnhanc",$nhanvienxacnhan); 	
				if(trim($result["xacnhan"])){
					for($i=0;$i<strlen($result["xacnhan"]);$i++){
							$nhanvienxacnhan.=$result["xacnhan"][$i].'###';
					
					}
					
				}
				$nhanvienxacnhan=rtrim($nhanvienxacnhan,"###");
			//	echo $nhanvienxacnhan;
				 $template->assign("nhanvienxacnhan",$nhanvienxacnhan); 	
				//$template->assign("loaishow",$result["loai"]==1?"Thu":"Chi");
				/*if ($result["xacnhan"] == "1") $template->assign("xacnhan1","selected"); 				
				if ($result["xacnhan"] == "2") $template->assign("xacnhan2","selected");
				if ($result["xacnhan"] == "3") $template->assign("xacnhan3","selected");*/
					$thongtin=$result["thongtin"];
			 		$thongtin=explode("*",$thongtin);
					
						foreach($thongtin as $value)
						{
							$tamq = "ttbb_$value";    
						
							 $template->assign("$tamq" ,"checked");
						}
 				 $template->parse("main.block_cus.block_capnhatdinhkhoan");
 		}
		$template->assign("donglai",$donglai);	   
    
 	    $template->parse("main.block_cus");
	}


if($_REQUEST["view"]=="tk"){

		if($_REQUEST["id"] == "tk")
		{
			$template->assign("t-c","Thêm Mới tài khoản" );
			$template->parse("main.block_tk.block_themtaikhoan");
		}
		else if($_REQUEST["id"] && $_REQUEST["view"]="tk")
		{
			$mangtaikhoan=taomangtaikhoan();
			$sql ="SELECT a.ID,a.madinhkhoan,a.tendinhkhoan,a.ghichu,a.loai,a.tenen  FROM  dinhkhoan a WHERE ID='".laso($_REQUEST["id"])."'";
			$query = $data->query($sql);
			$result = $data->fetch_array($query);
				$template->assign("t-c","Cập nhập Tài khoản" );
 				 
				$template->assign("ten",$result["tendinhkhoan"]);
				$template->assign("tenen",$result["tenen"]);
				$template->assign("ma",$result["madinhkhoan"]);
				$template->assign("ID",$result["ID"]);
				$template->assign("ghichu",$result["ghichu"]);
				$loai='';
				//var_dump($mangtaikhoan);
				if($mangtaikhoan[$result["madinhkhoan"]]==1){
				
					if ($result["loai"] == 0) $template->assign("loai0","selected"); 				
					if ($result["loai"] == 1) $template->assign("loai1","selected");
				}
				else if($mangtaikhoan[$result["madinhkhoan"]]==2){
					 $template->assign("loai2","selected");
					 
				}
				else  if($mangtaikhoan[$result["madinhkhoan"]]==3){
					 $template->assign("loai3","selected");
					 
				}
				
				
				
 				 $template->parse("main.block_tk.block_capnhattaikhoan");
		}
		$template->parse("main.block_tk");
}

$template->assign("goitim","document.getElementById('search2').click()   ;");

 if ( !($_SESSION["se_kho"] ==1 && $_SESSION["loai_user"] ==6 )  )   $template->parse("main.block_kt");    
 $template->parse("main.block_ajack"); 
   
   
   
 function taomangtaikhoan(){
 	global $data;
 	$sql ="SELECT count(a.loai) as loai,a.loai as l,a.madinhkhoan FROM dinhkhoan a
group by madinhkhoan";
 	$query=$data->query($sql);
	$mang=[];
	while($row = $data->fetch_array($query)){
		if($row['l']==3){
			$mang[$row['madinhkhoan']]=$row['l'];
		}
		else{
		
		$mang[$row['madinhkhoan']]=$row['loai'];
		}
	}
	
	return $mang;
 }
?>