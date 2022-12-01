<?php
session_start();
  if (!defined("IN_SITE"))	{    	die('Hacking attempt!');	}
  $idtao=$_SESSION["LoginID"]; $idkho=$_SESSION["se_kho"];
  $ql =$quyen[$_SESSION["mangquyenid"][$act]]  ;  
  if(!($ql[0]||$idtao==1)) {echo "Bạn không có phân quyền"; exit; return ;}
 //=============================khoi tao ======================//  	 Xem  	 Them  	 Cap nhap  	 Tim  	Huy  	Khoa  	In
 date_default_timezone_set('Asia/Ho_Chi_Minh');
 	$template->assign("kho",compoloai("cuahang","macuahang","Name",0," where id=$idkho"));    
 if($ql[5] || $_SESSION["LoginID"]==7576 || $_SESSION["LoginID"]==1 || $_SESSION["LoginID"]==4647){
 		$chuoiCHadmin='<div>  <select   onkeypress="return chuyentiep(event,\'idnhan\')" name="cuahang_admin"  id="cuahang_admin"  class="js-ch" style="width:180px" title="cửa hàng" onchange="OnchangeCH(event)">
		  <option value="">Tất cả</option>'.compoloai("cuahang","macuahang","Name",0,"").'
		  </select></div>';
		   $template->assign("chuoiCHadmin",$chuoiCHadmin);
 }
 //=======================================================================================		
  $donglai = "none" ; 
  $idcuahang =$_SESSION["se_kho"];
  //$idcuahang=1093;
   $checkloaitk=getdong("select ID from cuahang where ID='$idcuahang' and IDNhomcc <> 8 and ID <>62");
    $template->assign("checkloaitk",$checkloaitk['ID']);
  //$idcuahang =1126;
  $ngayhientai=date('Y-m-d H:i:s');
  
   $template->assign("ngayhientai",$ngayhientai);
   $template->assign("macuahang",getten("cuahang",$idcuahang,"macuahang"));
   
   
  $tungay=gmdate('d/m/Y', time() + 7*3600) ;
  $template->assign("tungay",$tungay  );
  $tungay= gmdate('Y-m-d', time() + 7*3600) ;
  $sql_where = " where  a.ngaytao>= '$tungay' ";
   
  if (  $_POST["search"] != "" )
	{
  $sql_where = " where loaiphieu=1 ";
  $cuahangtim  = laso($_REQUEST["cuahangtim"]);
  $tungay  = trim($_REQUEST["tungay"]);
  $toingay  = trim($_REQUEST["toingay"]);
  $template->assign("tungay",$tungay  );
  $template->assign("toingay",$toingay  );
  if($cuahangtim>0)   $sql_where.=" and a.IDcuahang='".$cuahangtim."'";
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
  
  if ($_SESSION["LoginID"]==1 || $_SESSION["LoginID"]==2|| $ql[5])   
  {  
    $template->assign("kho",compoloai("cuahang","macuahang","Name","$cuahangtim"," where idnhomcc<>8 and ID >0")); 
    $template->assign("tatca",'<option value="" >Tất cả</option>');	
 
  }
  else if($_SESSION["loai_user"]==16){ 
 
	        $template->assign("tatca",'<option value="" >Tất cả</option>');	
			$template->assign("kho",compoloai("cuahang","macuahang","Name",0," where idtinh=$idkho"));
            $template->parse("main.block_thekho.block_thekhochonkho");
    }
   else  
  {   
  
  	
  
  }
 $template->assign("dinhkhoanthuchi",compoloai("dinhkhoanthuchi","ma","ten",0," "));  
	$template->assign("tkno",composx("dinhkhoan","madinhkhoan",0,""));  
	$template->assign("tkco",composx("dinhkhoan","madinhkhoan",0,""));
   $data->closedata() ;
   
?>