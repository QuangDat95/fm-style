<?php
	if (!defined("IN_SITE"))
	{
    	die('Hacking attempt!');
	}
 $idk=$_SESSION["LoginID"] ;
 
 
 
 $template->assign("cuahangtk", composx("cuahang","Name",$result["cuahang"],"") );	


 $quyenso  =   laso($_POST["quyenso"]) ;
 $template->assign("quyenso",$quyenso);
  $quyentk  =   laso($_POST["quyentk"]) ;
  $template->assign("quyentk",composx("menu","Name","$quyentk"," where 1=1 order by ID " ));
  $template->assign("khuvuc", composx("khuvuc","Name","0","") );	
  $manvtd= gmdate('y', time()) * gmdate('n', time()) * gmdate('d', time()) *  (gmdate('H',time())+10) * (gmdate('i',time())+10)   +rand(1,9) ;  
   $_SESSION['IDTV']=$manvtd ;
  $template->assign("MaNV","FM".$manvtd);
   $template->assign("calamviec",compoloai("calamviec","manhomhang","Name","","where 1 order by Name")); 	
//=======================================================
function HTPhong($id_root, $level,$select_i,$idcall)
 	{	
 		global $data, $Caytm; 
		$space="&nbsp;&nbsp;&nbsp;&nbsp;";
		$name1="";	 
 		for($i=0; $i<$level; $i++)
		{
			$name1.=$space;
		}
		$sql="SELECT * from rooms WHERE ChildID='$id_root' and ID <> 0";
		
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
				if (trim($idcall)!= trim($id) ){ $Caytm.="<option value='$id' $select>$name</option> ";	}			
				else
				{ $Caytm.= "<optgroup label='$name'></optgroup>" ;}
			 
				HTPhong($id, $level+1,$select_i,$idcall);
			 
			}
		}
}
  
  //phân quyền nhiều
  
  if(isset($_POST["nhieuquyen"])){
  		$xem = laso($_POST["xem"]) ;
		$tao = laso($_POST["tao"]) ;
		$khoa = laso($_POST["khoa"]) ;
		$huy = laso($_POST["huy"]) ;
		$xoa = laso($_POST["xoa"]) ;
		$tatcach = laso($_POST["tatcach"]) ;
		$cond = $_POST["cond"] ;
	
		$cond=json_decode($cond,true);
		$quyenall=chonghack($_POST["quyenall"]);
		$quyenall=explode(",",$quyenall);
		
		$check=true;
		$wherequyen='';
		if(!$cond['tentim']){
		
		}
		if(!$cond['usertim']){
		
		}
		if(!$cond['matim']){
		
		}
		if(!$cond['timloai']){
			
			$check=false;
		}
		else{
			$wherequyen.=' loai='.$cond['timloai'];
		}
		if(!$cond['tinhluongtk']){
			
		}
		if(!$cond['chucvut']){
			//$check=false;
		}
		else{
			//$wherequyen.' ChucVu='.$cond['chucvut'];
		}	
		
		if(!$cond['quyenso']){
			
		}
		else{
			
		}
		if(!$cond['cuahangtk']){
			//$check=false;
		}
		else{
			$wherequyen.=' and cuahang='.$cond['cuahangtk'];
		}
		
		if(!$cond['quyentk']){
			$check=false;
		}
		
		
		
		if(!$check){
			$template->assign('thogbao',"alert('Thiếu điều kiện')");
			$template->parse("main.block_themquyenfail");
			return;
		}
		
		
		
		$quyenmoi='';
		//$sql="SELECT * FROM menu  where ID=".$cond['quyentk']; 
		
	   // $result=$data->query($sql); 	
		$mangpq = array();
		$arrayq=array();
       	// while ($row =$data->fetch_array($result) )  {
			  $chuoi =$xem.$tao.$khoa.$huy.$xoa.$tatcach;
			  if($chuoi!='000000') $mangpq[$cond['quyentk']]=$chuoi;
							
				
 			  //if($chuoi!='000000') $mangpq[$cond['quyentk']]=$chuoi;
			$machucnang=$cond['quyentk'];
			  $sql1="SELECT * FROM userac  where  ".$wherequyen; 
				$result1=$data->query($sql1);
				while ($row1 =$data->fetch_array($result1) )  {
					//i:1;s:6:"100000"
					//$quyenmoi=$row1['quyen'];
					if($row1['quyen']){
						$arrayq=unserialize($row1['quyen']);
					}
					$checkquyenco=false;
					foreach($arrayq as $key => $value){
						if($key==$machucnang){
							$arrayq[$key]=$chuoi;
							$checkquyenco=true;
						}
					}
					if(!$checkquyenco){
						$arrayq[$machucnang]=$chuoi;;
					}
					 
					  $quyen = serialize($arrayq);
					 
				$sql = "UPDATE  userac  SET quyen='$quyen' where ID =".$row1['ID'];
				$data->query($sql);	
					/*$pos=strpos($row1['quyen'],'i:'.$machucnang.';s:6:');
					$strensub=strlen('i:'.$machucnang.';s:6:');
					if($pos>0){
						
						//$subs=substr($row1['quyen'],($pos+$strensub),8);
						
						//$quyenmoi=substr_replace($row1['quyen'],'"'.$chuoi.'"',$pos+$strensub,8);
						
						}
						else{
							$quyenmoi=str_replace('}','i:'.$machucnang.';s:6:"'.$chuoi.'";}',$row1['quyen']);
						}
					}*/
				//}
  		}
		
		
		$template->assign('thogbao',"alert('Thêm thành công')");
			$template->parse("main.block_themquyensuccess");
		return;	
  }
  
  
  //phan nhieu quyền theo user
   if(isset($_POST["nhieuquyentheouser"])){
   		$Loai  =   chonghack($_POST["Loai"]) ;
   //==================lay phan quyen===============================
			$sql="SELECT * FROM menu   ORDER BY vitri desc,ID  "; 
	    $result=$data->query($sql); 	
		$mangpq = array();
        while ($row =$data->fetch_array($result) )  {
			  $t= "q$row[ID]_";   
			  $chuoi =laso($_POST["$t"."1"]).laso($_POST["$t"."2"]).laso($_POST["$t"."3"]).laso($_POST["$t"."4"]).		laso($_POST["$t"."5"]).laso($_POST["$t"."6"]);
 			   if($chuoi!='000000')   $mangpq[$row['ID']]=$chuoi ;
  			}
			$quyen = serialize($mangpq) ;
			$sql = "UPDATE  userac  SET quyen='$quyen' where loai=".$Loai;			
			if($data->query($sql)){
				$template->assign('thogbao',"alert('Thêm thành công')");
				$template->parse("main.block_themquyensuccess");
				return;
			}	
			//echo $quyen;
   }
  
  	 
//Phan Quyen

if ($_GET["Del"] != "")
{ 
		$IDD = chonghack($_GET["Del"]) ;
		$sql = "select ID from  phieunhapxuat where IDNhap = '".$IDD."'" ;
		$tam =getdong($sql);
	    $sql = "select ID from  nhanviendilam where IDnhanvien = '".$IDD."'" ;
		$tam1 =getdong($sql);
		if ($tam==''&&$tam1=='') $sql = "delete from  userac where ID = '".$IDD."'" ;
		else  $sql = "update  userac set Loai=-1,manv=concat('xoa_',manv),username= concat('xoa_',username) where ID = '".$IDD."'" ;
	//	echo   $sql;
		  $update = $data->query($sql);
		$xoa = true ;
}	
  if ($_REQUEST["id"] == "") { 	$template->assign("hienthi","none"); }
 
if ($_POST["btnUpdate"] != ""  )
{ 	
   if($_SESSION['IDTV']=='') return ; 
   	  $_SESSION['IDTV']='';

		$UserNamee =  khongdau(str_replace(" ", "",chonghack($_POST["UserName"]))) ;
		$Password =  khongdau(str_replace(" ", "",chonghack($_POST["Password"]))) ;
		$TenUsered      =   chonghack($_POST["Ten"]) ;
		$IDPhong  =   chonghack($_POST["IDPhong"]) ;
		$Email  =   chonghack($_POST["Email"]) ;
		$HonNhan  =   chonghack($_POST["HonNhan"]) ;
		$hesoluong  =   chonghack($_POST["hesoluong"]) ;
		$socon  =   chonghack($_POST["socon"]) ;
		$t1  =   laso($_POST["t1"]) ;
		$LuongCoBan  =  laso($_POST["LuongCoBan"]) ; 
		$SoDienThoai  =   chonghack($_POST["SoDienThoai"]) ;
		$ChucVu  =   chonghack($_POST["ChucVu"]) ;
		$DanToc  =   chonghack($_POST["DanToc"]) ;
		$hokhau=   chonghack($_POST["hokhau"]) ;
		$cmnd=   chonghack($_POST["cmnd"]) ;
		$BangCap=   chonghack($_POST["BangCap"]) ;
		$nganhang  =   chonghack($_POST["nganhang"]) ;
		$LoaiDN  =   chonghack($_POST["LoaiDN"]) ;
		$MaNV  =   chonghack($_POST["MaNV"]) ;
        $calamviec  =   laso($_POST["calamviec"]) ;
		$facebook  =   chonghack($_POST["facebook"]) ;
		$quequan  =   chonghack($_POST["quequan"]) ;
		
 		$giolamtheongay  =   chonghack($_POST["giolamtheongay"]) ;
		$hesovung  =   chonghack($_POST["hesovung"]) ;
		$thangnghi  =   chonghack($_POST["thangnghi"]) ;
		$MaNV  =   chonghack($_POST["MaNV"]) ;
		$IPdangnhap =  chonghack($_POST["IPdangnhap"]) ;
		$cuahang =  laso($_POST["cuahang"]) ;
		$tinhluong  =   laso($_POST["tinhluong"]) ;
		$template->assign("hienthiphanquyen","none");
		$ghichu =  chonghack($_POST["ghichu"]) ;
		
		
		if ($LoaiDN == "4") {$LoaiDN = "4".trim($IPdangnhap) ;}else {$IPdangnhap = "" ;}
		//==================lay phan quyen===============================
			$sql="SELECT * FROM menu   ORDER BY vitri desc,ID  "; 
	    $result=$data->query($sql); 	
		$mangpq = array();
        while ($row =$data->fetch_array($result) )  {
			  $t= "q$row[ID]_";   
			  $chuoi =laso($_POST["$t"."1"]).laso($_POST["$t"."2"]).laso($_POST["$t"."3"]).laso($_POST["$t"."4"]).laso($_POST["$t"."5"]).laso($_POST["$t"."6"]);
 			   if($chuoi!='000000')   $mangpq[$row['ID']]=$chuoi ;
  			}
			$quyen = serialize($mangpq) ;
 	 //==================lay phan quyen===============================
		
		$NgaySinh  =   chonghack($_POST["NgaySinh"]) ;	
		if ($NgaySinh != '')	
		{
			$ngays = explode('/',$NgaySinh);
			$NgaySinh = $ngays[2].'/'.$ngays[1].'/'.$ngays[0]  ;
		}
	 
	$NgayVaoLam  =   chonghack($_POST["NgayVaoLam"]) ;	
		if ($NgayVaoLam != '')	
		{
			$ngays = explode('/',$NgayVaoLam);
			$NgayVaoLam = $ngays[2].'/'.$ngays[1].'/'.$ngays[0]  ;
		}
	 	 
		$DiaChi  =   chonghack($_POST["DiaChi"]) ;
		$Loai  =   chonghack($_POST["Loai"]) ;
			
 // echo $_REQUEST["id"] $_REQUEST['edituser'] ; return ;
	if  ($_REQUEST['btnUpdate'] && $_REQUEST["id"]=='-1' )
	{
	
	
			$sql="select UserName from userac where UserName='$UserNamee' or MaNV ='$MaNV' ";
	 	 
		 	$query_rows = $data->query($sql);		
			$num=$data->num_rows($query_rows);
			if 	($num <= 0 )
			{
	//	  $sql ="INSERT INTO userac (MaNV,cuahang,UserName ,Password ,IDPhong ,Loai ,Email ,DiaChi ,SoDienThoai,image ,ChucVu, NgaySinh, NgayVaoLam ,Ten,HonNhan ,PhanQuyen,LuongCoBan,hesoluong,DanToc,nganhang )" ;
	// oDienThoai','$LoaiDN', '$ChucVu','$NgaySinh','$NgayVaoLam', '$TenUsered', '$HonNhan','$PhanQuyened','$LuongCoBan','$hesoluong','$DanToc','$nganhang' )";
		  
		   $sql ="INSERT INTO userac SET ghichu='$ghichu',t1='$t1',calamviec='$calamviec',facebook='$facebook',quequan='$quequan',MaNV='$MaNV',cuahang='$cuahang',UserName ='$UserNamee',cmnd ='$cmnd',Password='".md5($Password)."',Ten='$TenUsered',SoDienThoai ='$SoDienThoai',quyen='$quyen',Email='$Email',HonNhan='$HonNhan',BangCap='$BangCap',DiaChi='$DiaChi',IDPhong='$IDPhong',Loai='$Loai',PhanQuyen='$PhanQuyened',image = '$LoaiDN',ChucVu='$ChucVu',NgaySinh='$NgaySinh',NgayVaoLam='$NgayVaoLam',LuongCoBan='$LuongCoBan',hesoluong='$hesoluong',DanToc='$DanToc',hokhau='$hokhau',nganhang='$nganhang',giolamtheongay='$giolamtheongay',hesovung='$hesovung', tinhluong='$tinhluong',thangnghi='$thangnghi',socon='$socon' " ;
		   
		   } else
		   { 
		   	$template->assign("user",$UserNamee);
			$template->assign("MaNV",$MaNV);
			$template->assign("DiaChi", $DiaChi);
			$template->assign("SoDienThoai", $SoDienThoai);		
			$template->assign("UserName", $UserNamee);					 	
			$template->assign("Email", $Email);		
			$template->assign("HonNhan", $HonNhan);		
 			 $template->assign("chucvu", composx("kh_chucvu", "Name",0," order by ID"));  
			
			$loai = "LoaiDN".substr($LoaiDN,0,1) ;
			$template->assign($LoaiDN,"selected");	
			$template->assign("IDdangnhap",substr($LoaiDN,1,strlen($LoaiDN)));		
			if (substr($LoaiDN,0,1)=='4')
			{ $template->assign("IPdangnhapht","") ;}else {$template->assign("IPdangnhapht","none");}		
			 
			$template->assign("NgaySinh", $NgaySinh);		
			$loai = "loai".$Loai ;
			$template->assign("$loai","selected");		
			
 		   
 			$template->parse("main.block_trunguser");
			 
		   }
	} 
	else
	{
	 
$id= laso($_REQUEST['id']);

		if ($_SESSION["admintuan"]) $admint =''; else $admint = ' ID >2 and ';
		if(trim($Password) =="")
		{
			//$sql="select Password from userac where ID=".laso($_REQUEST["id"]);  
			//$query = $data->query($sql);
			//$result = $data->fetch_array($query);
			
			 $sql = "UPDATE  userac  SET ghichu='$ghichu',t1='$t1',calamviec='$calamviec',facebook='$facebook',quequan='$quequan',MaNV='$MaNV',quyen='$quyen',cuahang='$cuahang',cmnd ='$cmnd',Ten='$TenUsered',UserName ='$UserNamee',SoDienThoai ='$SoDienThoai',Email='$Email',HonNhan='$HonNhan',DiaChi='$DiaChi',IDPhong='$IDPhong',Loai='$Loai',PhanQuyen='$PhanQuyened',image = '$LoaiDN',ChucVu='$ChucVu',NgaySinh='$NgaySinh',NgayVaoLam='$NgayVaoLam',BangCap='$BangCap',LuongCoBan='$LuongCoBan',hesoluong='$hesoluong',DanToc='$DanToc',hokhau='$hokhau',nganhang='$nganhang',giolamtheongay='$giolamtheongay',hesovung='$hesovung', tinhluong='$tinhluong',thangnghi='$thangnghi',socon='$socon' where $admint ID='".$id."'" ;			
		}else
		{
		  $sql = "UPDATE  userac  SET  ghichu='$ghichu',t1='$t1',calamviec='$calamviec',facebook='$facebook',quequan='$quequan',MaNV='$MaNV',quyen='$quyen',Ten='$TenUsered',cmnd ='$cmnd', UserName ='$UserNamee',Password='".md5($Password)."',SoDienThoai ='$SoDienThoai',Email='$Email',HonNhan='$HonNhan',DiaChi='$DiaChi',BangCap='$BangCap',IDPhong='$IDPhong',Loai='$Loai',PhanQuyen='$PhanQuyened',image = '$LoaiDN',ChucVu='$ChucVu',NgaySinh= '$NgaySinh',NgayVaoLam='$NgayVaoLam',LuongCoBan='$LuongCoBan',hesoluong='$hesoluong',DanToc='$DanToc',hokhau='$hokhau',nganhang='$nganhang',giolamtheongay='$giolamtheongay',hesovung='$hesovung', tinhluong='$tinhluong',thangnghi='$thangnghi',socon='$socon' where $admint ID='".$id."'" ;	}		
	}  	 
 
	$update = $data->query($sql);
	
	$ngaytao = gmdate('Y-n-d H:i:s', time() + 7*3600) ; 
	$sqltd=" insert into ns_thaydoi (IDNV,IDtao,ngaytao,cotthaydoi,thongtintruoc,thongtinsau,ghichu ) values ";
    $tam=$_SESSION['thongtinus'] ; $dauphay=''; $sqlthaydoi=''; 
    $mangphong=taomang('rooms','ID','Name'); $mangca=taomang('calamviec','ID','Name');$mangcv=taomang('kh_chucvu','ID','Name');
    if($tam['calamviec']!=$calamviec)  { $p1=$mangca[$tam['calamviec']];$p2=$mangca[$calamviec];$sqlthaydoi .= "($id,$idl,'$ngaytao',10,'$p1','$p2','Tạo tự động')";$dauphay=',';}
    if($tam['BangCap']!=$BangCap)      { $sqlthaydoi .= "$dauphay ($id,$idl,'$ngaytao',11,'$tam[BangCap]','$BangCap','Tạo tự động')";$dauphay=',';}
    if($tam['IDPhong']!=$IDPhong){$p1=$mangphong[$tam['IDPhong']];$p2=$mangphong[$IDPhong];$sqlthaydoi .="$dauphay($id,$idl,'$ngaytao',12,'$p1','$p2','Tạo tự động')";$dauphay=',';}
    if($tam['LuongCoBan']!=$LuongCoBan){ $sqlthaydoi .= "$dauphay ($id,$idl,'$ngaytao',13,'$tam[LuongCoBan]','$LuongCoBan','Tạo tự động')"; $dauphay=',';}
    if($tam['ChucVu']!=$ChucVu){ $p1=$mangcv[$tam['ChucVu']];$p2=$mangcv[$ChucVu];$sqlthaydoi .= "$dauphay ($id,$idl,'$ngaytao',14,'$p1','$p2','Tạo tự động')";$dauphay=',';}
	if($sqlthaydoi!='') { $sql =$sqltd . $sqlthaydoi ;  $update = $data->query($sql); }
	
	 
//======update userright======================================================
		 $sql="select ID from userac where UserName ='$UserNamee'"; 
		 $queryid = $data->query($sql);
		 $resultid = $data->fetch_array($queryid);
	 	 	
		 if (trim($_REQUEST["id"]) == '-1') 
		 {     
		 	$IDf =  $resultid["ID"];
			$template->assign("IDCall","-1");	
			$manv=   gmdate('y', time())* gmdate('n', time())* gmdate('d', time())* gmdate('H',time()) * gmdate('H',time())* gmdate('i',time())+rand(9) ;  
 	 
            $_SESSION['IDTV']=$manv ;
			
			$template->assign("MaNV","FM".$manv);
			 $template->assign("chucvu", composx("kh_chucvu", "Name",0," order by ID"));  
				$template->assign("loaiuser",0);		
	          $template->assign("idcuahang",0);		
          	
			  $template->parse("main.block_user");
			 $template->parse("main.block_themmoi");
		 }
		 else
		 {
			 $IDf =$_REQUEST["id"] ;
			  $template->parse("main.block_capnhap");
		 }

	 
	 
 }
  $template->assign("chucvu", composx("kh_chucvu", "Name",0," order by ID"));  
 $template->assign("IDCall","-1");	
if ($_REQUEST["id"] != "-1" and (isset($_REQUEST["id"])))
{
   
	$sql="select * from userac where ID=".$_REQUEST["id"];
 	$query = $data->query($sql);
	$result = $data->fetch_array($query);
	$_SESSION['thongtinus']= $result ;
	  $_SESSION['IDTV']=$result["ID"];
	$template->assign("IDCall",$result["ID"]);	
	$template->assign("ID",$result["ID"]);
	$template->assign("MaNV",$result["MaNV"]);
	$template->assign("user",$result["Ten"]);
	$template->assign("DiaChi", $result["DiaChi"]);
	$template->assign("SoDienThoai", $result["SoDienThoai"]);		
	$template->assign("UserName", $result["UserName"]);		
	$template->assign("TenPhong", $result["TenPhong"]);		
	$template->assign("Email", $result["Email"]);	
	$template->assign("HonNhan", $result["HonNhan"]);	
	$template->assign("ghichu", $result["ghichu"]);	
    $template->assign("BangCap", $result["BangCap"]);	 
    $template->assign("socon", $result["socon"]);	 	
    $template->assign("hokhau", $result["hokhau"]);	 
    $template->assign("cmnd", $result["cmnd"]);	 
    $template->assign("chucvu", composx("kh_chucvu", "Name",$result["ChucVu"]," order by ID"));  
	// $template->assign("calamviec", composx("calamviec", "Name",$result["calamviec"]," where loai=3 order by Name")); 
	   $template->assign("calamviec",compoloai("calamviec","manhomhang","Name",$result["calamviec"],"where 1 order by Name")); 	
 
	$template->assign("facebook", $result["facebook"]);	
	$template->assign("quequan", $result["quequan"]);	
	$template->assign("nganhang", $result["nganhang"]);	
	$template->assign("LuongCoBan", formatso($result["LuongCoBan"]));	
	$template->assign("DanToc", $result["DanToc"]);	
	$template->assign("hesoluong", $result["hesoluong"]);	
 	 $template->assign("hesovung", $result["hesovung"]);	 
	 $template->assign("giolamtheongay", $result["giolamtheongay"]);
	  $template->assign("thangnghi", $result["thangnghi"]);
     $template->assign( "tinhluong".$result["tinhluong"],"selected");
      $template->assign("hienthiphanquyen","");
    $LoaiDN = "LoaiDN". substr($result["image"],0,1) ;
 	if (substr($result["image"],0,1)=='4')
			{ $template->assign("IPdangnhapht","") ;}else {$template->assign("IPdangnhapht","none");}	
			
	$template->assign("IPdangnhap",substr($result["image"],1,strlen($result["image"])));		
	
	$template->assign("t1".$t1,"selected");
    $template->assign("amthanh" ,"t".$t1);		
	$template->assign($LoaiDN,"selected");			
	$ngays = explode('-',$result["NgaySinh"]);
	$NgaySinh = $ngays[2].'/'.$ngays[1].'/'.$ngays[0]  ;
			
	$template->assign("NgaySinh",$NgaySinh );		
	
	$ngays = explode('-',$result["NgayVaoLam"]);
	$NgayVaoLam = $ngays[2].'/'.$ngays[1].'/'.$ngays[0]  ;
			
	$template->assign("NgayVaoLam",$NgayVaoLam );		
	$loai = "loai".$result["Loai"] ;
	$template->assign("loaiuser",$result["Loai"]);		
	$template->assign("idcuahang",$result["cuahang"]);		
	  $template->assign("khuvuc", composx("khuvuc","Name",$result["cuahang"],"") );	
	   $template->assign("chucvut", composx("kh_chucvu","Name",0,"") );	
	$template->assign("$loai","selected");		

	$PhanQuyened=$result["PhanQuyen"];
	
	 
$Caytm = "";
  

HTPhong(0, 1,$result['IDPhong'],0); 	 
 $template->assign("phong", $Caytm);
  $template->assign("khuvuc", composx("khuvuc","Name",$result["cuahang"],"") );	
    $template->assign("chucvut", composx("kh_chucvu","Name",0,"") );	
 $template->assign("cuahang", composx("cuahang","Name",$result["cuahang"],"") );	
 		  //===================phan quyen=========================================================
 
    $quyen = unserialize($result["quyen"])  ;
 	
		  
		  //===================phan quyen=========================================================


}
else
{
 
 
	$Caytm = "";
	$sql="SELECT * FROM menu   ORDER BY vitri desc,ID  ";
	$result=$data->query($sql); 	 
    $categories = array();
    $mangid ="";
          while ($row =$data->fetch_array($result) )  {$categories[] = $row; $mangid.= ",".$row["ID"];}
            $tam ='';
			$stt=0;
      $template->assign("mangid",$mangid);
	  $template->assign("nhanviencopy", composx("userac","username",0," where ID>2 and  Loai<> -1 order by ten ") );
         function caymenu1($categories, $parent_id = 0, $char = "")
          { global  $mau , $template,$stt,$quyen;
              /* BƯỚC 2.1: LẤY DANH SÁCH CATE CON*/
              $cate_child = array();
              foreach ($categories as $key => $item)
              {
                 if ($item["IDcha"] == $parent_id)
                  {
                       $cate_child[] = $item;
                        unset($categories[$key]);
                   }
              } 
			  
               /* BƯỚC 2.2: HIỂN THỊ DANH SÁCH CHUYÊN MỤC CON NẾU CÓ*/
              if ($cate_child)
              {  		 
                  foreach ($cate_child as $key => $item)
                  {     
				    
                     	if($mau == "white")
						{	   $mau = "#EEEEEE";$hl = "Normal4" ;$hl2 = "Highlight4";	} 	
						else 
						{ 	 	$mau = "white";	$hl = "Normal5" ;$hl2 = "Highlight5"; }	
						$stt++;
						$template->assign("hl2",$hl2);
						$template->assign("hl",$hl);						
						$template->assign("stt",$stt);			
						$template->assign("color", $mau);
						$template->assign("ID",$item["ID"]);
						$dongquyen =$quyen[$item["ID"]];
						for($i=1;$i<=6;$i++)
							{
								$tamq = "cq_$i";    
								if($dongquyen[$i-1]>0)  $template->assign("$tamq" ,"checked");else $template->assign($tamq , "");
							}
						
						
						if( $char=='') $template->assign("Name", $item["Name"]); else	$template->assign("Name",  $char.$item["Name"]);
						
						if( $item["icon"])	$template->assign("icon", "<IMG   src='images/$item[icon]' /> ");
						else $template->assign("icon", "");  
						   $template->parse("main.block_PhanQuyen");
						
                      /* Tiếp tục đệ quy để tìm chuyên mục con của chuyên mục đang lặp*/
                      caymenu1($categories, $item["ID"], $char." &nbsp; |- - - - - ");
                     
					
                  }
                 //  $tam .= "</ul>";
              }
          }
          caymenu1($categories);
		  
		  //===================phan quyen=========================================================
 HTPhong(0, 1, $IDPhong,0); 	 
 $template->assign("phong", $Caytm);		
 $template->assign("cuahang", composx("cuahang","Name",$cuahang,"") );	
 $template->assign("khuvuc", composx("khuvuc","Name",$cuahang,"") );
   $template->assign("chucvut", composx("kh_chucvu","Name",0,"") );		
}

  $template->parse("main.block_user");
  $sqltim  ='';
  $tentim = chonghack($_REQUEST['tentim'])  ;
  $timloai = laso($_REQUEST['timloai'])  ;
  $template->assign("loai".$timloai,"selected");	
  $usertim = chonghack($_REQUEST['usertim'])  ;
  $matim = chonghack($_REQUEST['matim'])  ;
  $cuahangtk = laso($_REQUEST['cuahangtk'])  ;
  $chucvut = laso($_REQUEST['chucvut'])  ;
  $tinhluongtk = chonghack($_REQUEST['tinhluongtk'])  ;  
  $template->assign("tinhluongtk".$tinhluongtk, "selected" );	
  if (  $tinhluongtk !='')  $sqltim .= " and u.tinhluong= '$tinhluongtk' ";  
  if (  $cuahangtk !=0)  $sqltim .= " and u.cuahang= '$cuahangtk' ";
  if (  $chucvut !=0)  $sqltim .= " and u.chucvu= '$chucvut' ";
  
  if (  $tentim !='')  $sqltim .= " and u.Ten like '%$tentim%' ";
if (  $timloai !=0)  $sqltim .= " and u.loai = $timloai ";
if (  $usertim !='')  $sqltim .= " and u.UserName like '%$usertim%' ";
if (  $matim !='')  $sqltim .= " and u.MaNV like '%$matim%' ";
if (  $quyentk >0) { $sqltim .= " and u.quyen like '%i:".$quyentk.";s:6:%' ";  }

$sql ="SELECT u.*,r.Name as cuahang FROM  userac as u  left join cuahang  as r on  u.cuahang=r.ID where u.Loai<> -1 and u.ID >2 $sqltim  order by HonNhan desc,u.IDPhong limit 600";
  	 	 

$_SESSION["luusql"] = "SELECT  r.Name as cuahang,u.ten,v.name as chucvu,u.quequan,u.manv,u.ngaysinh,u.facebook,u.sodienthoai,u.DiaChi as noisinh,u.dantoc as hokhau,u.ngayvaolam,t.name as calamviec,u.BangCap as trinhdo FROM  userac as u  left join kh_chucvu v on u.chucvu =v.id left join  cuahang  as r on  u.cuahang=r.ID left join calamviec as  t on u.calamviec=t.ID where u.Loai<> -1 and u.ID >2 $sqltim  order by HonNhan desc,u.IDPhong";
 
$_SESSION["luuten"]="user";
$_SESSION["luudong"]="10000000"; 
if ($_SESSION["admintuan"]) echo $sql ;
$query_rows = $data->query($sql);
$result_rows = $data->num_rows($query_rows);
$result = $data->query($sql);
	$SOST =1 ;
	
	while($result_news = $data->fetch_array($result))		
	{   
			
  	    if($mau == "white") { $mau = "#EEEEEE";$hl = "Normal4" ;$hl2 = "Highlight4";	} 	
		else { $mau = "white";	$hl = "Normal5" ;$hl2 = "Highlight5"; }		
 			$template->assign("hl2",$hl2);
			$template->assign("hl",$hl);		
			$template->assign("ID",$result_news["ID"]);
			$template->assign("color",$mau);
			$template->assign("stt", $SOST);
			$template->assign("MaNV", $result_news["MaNV"]);
			$template->assign("Ten", $result_news["Ten"]);		
			$template->assign("vitri", $result_news["HonNhan"]);
			$template->assign("UserName", $result_news["UserName"]);		
			$template->assign("cuahang", $result_news["cuahang"]);		
			$template->assign("Email", $result_news["Email"]);		
			$template->assign("MaNV", $result_news["MaNV"]);		
			$template->assign("LuongCoBan", $result_news["LuongCoBan"]);		
			$template->assign("hesoluong",formatso($result_news["hesoluong"]));		
			$template->assign("HonNhan", $result_news["HonNhan"]);	
			if($quyentk>0 && $quyenso>0)
			{$quyenk = unserialize($result_news["quyen"]);$tam= $quyenk[$quyentk];if($tam[$quyenso-1]) {$template->parse("main.block_us");  $SOST =$SOST +1; }}
			else { $template->parse("main.block_us"); $SOST =$SOST +1; }
			//echo $sql;
			//var_dump(unserialize($result_news["quyen"]));
		}

 
 $sql="SELECT * FROM menu   ORDER BY vitri desc,ID  ";
	$result=$data->query($sql); 	 
    $categories = array();
    $mangid ="";
    while ($row =$data->fetch_array($result) )  {$categories[] = $row; $mangid.= ",".$row["ID"];}
            $tam ='';
			$stt=0;
      $template->assign("mangid",$mangid);
	  $template->assign("nhanviencopy", composx("userac","username",0," where ID>2 and  Loai<> -1 order by ten ") );
         function caymenu($categories, $parent_id = 0, $char = "")
          { global  $mau , $template,$stt,$quyen;
              /* BƯỚC 2.1: LẤY DANH SÁCH CATE CON*/
              $cate_child = array();
              foreach ($categories as $key => $item)
              {
                  
                  if ($item["IDcha"] == $parent_id)
                  {
					 
                        $cate_child[] = $item;
                        unset($categories[$key]);
					    
	  	             
                  }
              } 
			  
               /* BƯỚC 2.2: HIỂN THỊ DANH SÁCH CHUYÊN MỤC CON NẾU CÓ*/
              if ($cate_child)
              {  		 
                  foreach ($cate_child as $key => $item)
                  {     
				    
                     	if($mau == "white")
						{	   $mau = "#EEEEEE";$hl = "Normal4" ;$hl2 = "Highlight4";	} 	
						else 
						{ 	 	$mau = "white";	$hl = "Normal5" ;$hl2 = "Highlight5"; }	
						$stt++;
						$template->assign("hl2",$hl2);
						$template->assign("hl",$hl);						
						$template->assign("stt",$stt);			
						$template->assign("color", $mau);
						$template->assign("ID",$item["ID"]);
						$dongquyen =$quyen[$item["ID"]];
						for($i=1;$i<=6;$i++)
							{
								$tamq = "cq_$i";    
								if($dongquyen[$i-1]>0)  $template->assign("$tamq" ,"checked");else $template->assign($tamq , "");
							}
						
						
						if( $char=='') $template->assign("Name", $item["Name"]); else	$template->assign("Name",  $char.$item["Name"]);
						
						if( $item["icon"])	$template->assign("icon", "<IMG   src='images/$item[icon]' /> ");
						else $template->assign("icon", "");  
						   $template->parse("main.block_PhanQuyen");
						    $template->parse("main.block_PhanQuyen_comp");
						
                      /* Tiếp tục đệ quy để tìm chuyên mục con của chuyên mục đang lặp*/
                      caymenu($categories, $item["ID"], $char." &nbsp; |- - - - - ");
                     
					
                  }
                 //  $tam .= "</ul>";
              }
          }
          caymenu($categories);
		//===========het hien thi checkbox====================================================
		
		
		

	 
?>