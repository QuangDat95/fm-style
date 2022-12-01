<?php
session_start();
  if (!defined("IN_SITE"))	{    	die('Hacking attempt!');	}
  $idtao=$_SESSION["LoginID"]; $idkho=$_SESSION["se_kho"];
  $ql =$quyen[$_SESSION["mangquyenid"][$act]]  ;  
  if(!($ql[0]||$idtao==1)) {echo "Bạn không có phân quyền"; exit; return ;}
 //=============================khoi tao ======================//  	 Xem  	 Them  	 Cap nhap  	 Tim  	Huy  	Khoa  	In
 
 //=======================================================================================		
  $donglai = "none" ; 
  $idcuahang =$_SESSION["se_kho"];
  
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
  
  if ($_SESSION["LoginID"]==1 || $_SESSION["LoginID"]==2|| $ql[2])   
  {  
  
    $template->assign("kho",composx("cuahang","Name","$cuahangtim"," where idnhomcc<>8 and ID >0")); 
    $template->assign("tatca",'<option value="" >Tất cả</option>');	
 
  }
  else if($_SESSION["loai_user"]==16){ 
 
	        $template->assign("tatca",'<option value="" >Tất cả</option>');	
			$template->assign("kho",composx("cuahang","Name",0," where idtinh=$idkho"));
            $template->parse("main.block_thekho.block_thekhochonkho");
    }
   else  
  {   
  
  	$template->assign("kho",composx("cuahang","Name",0," where id=$idkho"));  
  
  }
 
   $data->closedata() ;
   
?>