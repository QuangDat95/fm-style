<?php
session_start();
 
  $ql =$quyen[$_SESSION["mangquyenid"][$act]]  ;  
  if(!($ql[0]||$idl==1)) {echo "Bạn không có phân quyền"; exit; return ;}
 
 
  $idk = laso($_SESSION["LoginID"]) ; 
   if( ($ql[5]&&$ql[4]&&$ql[3])||$idl==1) $template->parse("main.block_admin1"); 
	if ($idk==1   )  $template->parse("main.block_admin2"); 
 // if ($idk  == "0")  include($root_path."index.php");   
  if (!defined("IN_SITE")){   	die('Hacking attempt!');	}
  $idkho = $_SESSION["se_kho"] ;
  $kho = $_SESSION["S_tencuahang"] ;
 $template->assign("idkho","$idkho"); //   if($idkho==1 ||$idkho==1136)
 //=============================khoi tao ======================//  	 Xem  	 Them  	 Cap nhap  	 Tim  	Huy  	Khoa  	In
   
	$data->setthaotac = "xuatkhotong" 	;
	// echo $mquyen[1]."<br>";
	 $ql =$quyen[$_SESSION["mangquyenid"][$act]]  ;  
	 if(!($ql[0]||$idl==1)) {echo "Bạn không có phân quyền"; exit; return ;}
	 
	 
	  
 	// if( !($ql[1] )  ) { $template->assign("q_them","none");}
	 // if( !($ql[2] )) { $template->assign("q_luu","none");}
	 	 $template->assign("q_them","");
 	   $template->assign("q_luu","");
 	    if( !($ql[3] )) { $template->assign("q_huy","none");}
		  if( !($ql[4] )) { $template->assign("q_xoa","none");}
 
        
	//echo kiemtraquyenthumuc(1,"them") ; 
 //   if (kiemtraquyenthumuc(1,"xem")== false )     {  echo " <meta http-equiv='refresh'content='1;url=default.php'>"; return ;}	
	if (kiemtraquyenthumuc(1,"them")== false)    {  $template->assign("q_them","none");  }
//	if (kiemtraquyenthumuc(1,"capnhap")== false) {  $template->assign("q_luu","none");   }
//	if (kiemtraquyenthumuc(1,"tim")== false)     {  $template->assign("q_tim","none");  }
//	if (kiemtraquyenthumuc(1,"xoa")== false)     {  $template->assign("q_huy","none");  }
//	if (kiemtraquyenthumuc(1,"khoa")== false)    {  $template->assign("q_khoa","none");  }
//	if (kiemtraquyenthumuc(1,"in")== false)      {  $template->assign("q_in","none");  }
// 	if (kiemtraquyenthumuc(12,"them")== false)      {  $template->assign("q_themc","none");  }
//	if (kiemtraquyenthumuc(15,"them")== false)      {  $template->assign("q_themp","none");  }
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
//=======================================================================================
   $thang = gmdate('m', time() + 7*3600); 
   $nam = gmdate('y', time() + 7*3600); 
   $so = strlen($idkho) + 8;
    	    $template->assign("tungay",$tungay); 		
 	    $template->assign("denngay",$denngay); 			 	

   $sql = "select   max(convert( mid(SoCT,$so,22),UNSIGNED INTEGER))as sp from phieuxuat  where loai ='1' and  IDKho='$idkho' and  mid(SoCT,4,2) = '$thang' " ;
   // select max(mid(SoCT,9,111)) as fff   from phieunhapxuat  where loai ='1' and  IDKho='1' and  mid(SoCT,4,2) = '06' and ID in (2,3)
  //  echo $sql ;  
   $kq = getdong($sql) ;		
  // echo $sql ;
   $sp = laso($kq['sp']) + 1 ;
    
   if (strlen($sp)== '1' ) $sp = "00". $sp ;
   if (strlen($sp)== '2' ) $sp = "0". $sp ;
   $sochungtu ="X".$nam.$thang.".".$idkho.".".$sp ;  
   $chikho = " where ID = '$idkho' and idnhomcc<>8    " ;
   if ( $idk == 1 ||  $ql[5])  $chikho = "  where  idnhomcc<>8 and ID >0" ;
    if ($_SESSION["loai_user"]==16 )  $chikho = "      where   IDtinh =$idkho  and idnhomcc<>8 and ID >0" ;
   
    
 //  echo  $chikho. ' ' .$_SESSION["loai_user"] ;
   
   $template->assign("sochungtu",$sochungtu); 
    $template->assign("cuahangkiem",composx("cuahang","Name",0,"$chikho"));	
	  $template->assign("cuahangkiemnhan",composx("cuahang","Name",0," where idnhomcc<>8 and ID >0"));	
//=======================================================================================
 if ($_SESSION["dangnhap"] == "admin" && 1==2)
 {
//	$khon= "<option value='0'>Chọn Kho</option>".composx("kho","makho","Name","") ;
// 	 $template->assign("kho",$khon); 
	  $template->assign("kho",composx("cuahang","Name",""," where idnhomcc<>8 and ID >0")); 
 }	
  	 else
 {
     $template->assign("kho",composx("cuahang","Name","$idkho"," where idnhomcc<>8 and ID >0")); 
 	// $template->assign("kho","<option value='$idkho'>$kho</option>");
 }
 
 $_SESSION["se_khachdua"]="";
  $ten =$_SESSION["TenUser"] ;
   $template->assign("ten",$ten); 
   
  //$template->assign("songayno",composx("songayno","Loai","LoaiNo",""));   
  
   $template->assign("nhacungcap",composx("nhacungcap","Name","ID","")); 
  //$template->assign("taikhoanno",compoloai("taikhoanghico","ma","Name","","2")); 
 // $template->assign("tinh",compo("tinh","Name","")); 



  
   
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
  $template->assign("ngaynhap",$ngaytao);
    $template->assign("tungay",$ngaytao);
	  $template->assign("denngay",$ngaytao);
 $template->parse("main.block_nhaptt"); 
 $template->parse("main.block_HH"); 
?>