<?php
 
  $idk = trim($_SESSION["LoginID"]) ; 
  $ql =$quyen[$_SESSION["mangquyenid"][$act]]  ;  
  if(!($ql[0]||$idl==1)) {echo "Bạn không có phân quyền"; exit; return ;}
 
  if (!defined("IN_SITE")){   	die('Hacking attempt!');	}
  $idkho = $_SESSION["se_kho"] ;
  $kho = $_SESSION["S_tencuahang"] ;
  $template->assign("idkho",$idkho); 
  if($idkho!=1105)   {$template->assign("giahienthi","readonly");  $template->assign("ol","0");} else    $template->assign("ol","1");
  
  
  if (laso($_SESSION['chietkhaugiam'])==0) $_SESSION['chietkhaugiam'] =12 ;
   $template->assign("chietkhaugiam",$_SESSION['chietkhaugiam']); 
 //=============================khoi tao ======================//  	 Xem  	 Them  	 Cap nhap  	 Tim  	Huy  	Khoa  	In
 	$sql="insert into cuahang set name='8888888888'";
//	echo $sql;
//	  $result=$data->query($sql);
	  
	//  return ;
	$data->setthaotac = "banhang" 	;
	// echo $mquyen[1]."<br>";
	
	//echo kiemtraquyenthumuc(1,"them") ; 
    if (kiemtraquyenthumuc(1,"xem")== false )     {  echo " <meta http-equiv='refresh'content='1;url=default.php'>"; return ;}	
	if (kiemtraquyenthumuc(1,"them")== false)    {  $template->assign("q_them","none");  }
	if (kiemtraquyenthumuc(1,"capnhap")== false) {  $template->assign("q_luu","none");   }
	if (kiemtraquyenthumuc(1,"tim")== false)     {  $template->assign("q_tim","none");  }
	if (kiemtraquyenthumuc(1,"xoa")== false)     {  $template->assign("q_huy","none");  }
	if (kiemtraquyenthumuc(1,"khoa")== false)    {  $template->assign("q_khoa","none");  }
	if (kiemtraquyenthumuc(1,"in")== false)      {  $template->assign("q_in","none");  }
 	if (kiemtraquyenthumuc(12,"them")== false)      {  $template->assign("q_themc","none");  }
	if (kiemtraquyenthumuc(15,"them")== false)      {  $template->assign("q_themp","none");  }
 //=======================================================================================	
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
				if ($result_news["IDGroup"] == "0") { $name1 = "" ; }
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
	if ($idk==1)  $template->parse("main.block_admin1"); 
//=======================================================================================
   $thang = gmdate('m', time() + 7*3600); 
   $nam = gmdate('y', time() + 7*3600); 
   $so = strlen($idkho) + 9;
   $sql = "select   max(convert(mid(SoCT,$so,22),UNSIGNED INTEGER))as sp from passdon  where loai ='1' and  IDKho='$idkho' and  mid(SoCT,4,2) = '$thang' " ;
   
   // select max(mid(SoCT,9,111)) as fff   from passdon  where loai ='1' and  IDKho='1' and  mid(SoCT,4,2) = '06' and ID in (2,3)
  //  echo $sql ;
   $kq = getdong($sql) ;	
  // echo 	$kq  ;
 //   echo $kq['sp'] ;
   $sp = laso($kq['sp']) + 1 ;
   if (strlen($sp)== '1' ) $sp = "00". $sp ;
   if (strlen($sp)== '2' ) $sp = "0". $sp ;
   $sochungtu ="P".$nam.$thang.$_SESSION["S_MaNV"].".".$idkho.".".$sp ;  
  
   $template->assign("sochungtu",$sochungtu); 
    $taikhoanqlkv ="";
   $sql = " select idtinh as khuvuc from cuahang where id=$idkho" ; 
   $tam=getdong($sql); 
   if($tam['khuvuc']>0) { $taikhoanqlkv = " or ( loai=16 and cuahang=$tam[khuvuc] ) " ;  }
   
  // echo $taikhoanqlkv ;
  
      $template->assign("nhanvienonline", compoloai("userac","ten","manv",$idk," where  tinhluong=1 ") );
	 
	
	
 
	
	
	
	
//=======================================================================================
 if ($_SESSION["dangnhap"] == "admin" && 1==2)
 {
//	$khon= "<option value='0'>Chọn Kho</option>".composx("kho","makho","Name","") ;
// 	 $template->assign("kho",$khon); 
	  $template->assign("kho",composx("kho","Name","","")); 
 }	
  	 else
 {
     $template->assign("kho",composx("kho","Name","$idkho","")); 
 	// $template->assign("kho","<option value='$idkho'>$kho</option>");
 }
 
 $_SESSION["se_khachdua"]="";
  $ten =$_SESSION["TenUser"] ;
   $template->assign("ten",$ten); 
   
  //$template->assign("songayno",composx("songayno","Loai","LoaiNo",""));   
  
   $template->assign("nhacungcap",composx("nhacungcap","Name","ID","")); 
     $template->assign("taikhoannganhang",compoloai("taikhoannganhang","ma","tenchutaikhoan","ID","")); 
  //$template->assign("taikhoanno",compoloai("taikhoanghico","ma","Name","","2")); 
 // $template->assign("tinh",compo("tinh","Name","")); 


    $template->assign("cuahang",composx("cuahang","Name",0," where idnhomcc<>8 and ID >0"));	
  
   
 $IDNV = $_SESSION["LoginID"] ;
 $template->assign("IDNV",$IDNV);
 
 $template->assign("tencuahang",$_SESSION["S_tencuahang"]  );
 
 
 $template->parse("main.block_khoitao"); 

  printtree1(0, 1, 0 ,0,false); 	 
 $template->assign("cay",$Caytm);			
				
 $template->parse("main.block_luachon"); 

$mang = array(); 
$_SESSION['mang'] = $mang;
 
 
  $template->assign("lydo",compoloai("lydonhapxuat","ma","Name","","where Loai ='1' order by Rank desc ")); 
   $template->assign("khuvuc",composx("tinh","Name",0,"Rank")); 
  $ngaytao = gmdate('d/m/Y', time() + 7*3600) ;
   $tungay = gmdate('d/m/Y', time() + 7*3600 ) ;
  $template->assign("ngaynhap",$ngaytao);
    $template->assign("tungay",$tungay);
 $template->parse("main.block_nhaptt"); 
 $template->parse("main.block_HH"); 
?>