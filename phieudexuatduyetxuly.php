<?php  
session_start();
 $idk = $_SESSION["LoginID"] ; if (  $idk == '') return ; 
  include_once($root_path."send.php");
$root_path =getcwd()."/"  ;
include($root_path."includes/config.php");
include($root_path."includes/removeUnicode.php"); 
include($root_path."includes/class.paging.php");
include($root_path."includes/class.mysql.php");
include($root_path."includes/function.php");
 
 
$quyen= $_SESSION["quyen"] ;  $act= $_SESSION["act"] ;
$ql =$quyen[$_SESSION["mangquyenid"][$act]]  ;  
if(!($ql[5]==5 || $idk==1 ) ){return;}
 
   
$data = new class_mysql();
$data->config();
$data->access();

  $data1 = $_POST['DATAC']; 
  $tmp = explode('*@!',$data1);
 
        $idphieu   =  laso($tmp[0])   ;
		$idlogin   =  laso($tmp[1])   ;
		$loai   =  ($tmp[2])   ;
		$tinhtrang= laso($tmp[3]) ;
		$lydoe = $tmp[4];
		 $ngaytao = gmdate('Y-n-d H:i:s', time() + 7*3600) ;
         $ngayduyet =gmdate('d-n-Y H:i:s', time() + 7*3600) ;
	

		$sql = "select tinhtrang,lydo,sochungtu,thongtindung  from phieuyeucau  where ID = '0$idphieu'" ;	
	$phieu=getdong($sql); 
		$tam=$phieu['tinhtrang']."111";
	$thongtindung=explode("&*!",$phieu['thongtindung']);
	
	$sochungtu=$phieu['sochungtu'];
	
	$thumua=$tam[0];
	

	$ketoan=$tam[1];
	$giamdoc=$tam[2];
	
	if($loai=='thumua')	
	{
	
	   $tt=$tinhtrang."$ketoan$giamdoc";
       if($ketoan==4||$ketoan==3||$giamdoc==3||$giamdoc==4) return ;
	   if($tinhtrang==3||$tinhtrang==2) $sqlupd =  " ,lydo1 = '$lydoe' " ; else $sqlupd =  "";
	   if($lydoe=='')   { echo  "###-1###Chưa nhập lý do###---###" ; return; }
  	   $sql = "update phieuyeucau set tinhtrang='$tt',ngayxacnhan1='$ngaytao',ID1='$idk' $sqlupd  where ID = '0$idphieu'  " ;    $data->query($sql);
	    if($tinhtrang==4)   {
			 echo  "###4###Chờ giám sát duyệt###$ngayduyet###" ; 
		 
		 }
		else if($tinhtrang==3){
		 	echo  "###3###Không duyệt###$ngayduyet###$lydoe" ; 
		 }
		 else   echo  "###1###Đã lưu###$ngayduyet###$lydoe" ; 
	    return;	
	} 
	elseif($loai=='ketoan')	
	{  
	   $tt="$thumua".$tinhtrang."$giamdoc";
	   
       if($giamdoc==4||$giamdoc==3 ) return ;
	   if($tinhtrang==3||$tinhtrang==2) $sqlupd =  " ,lydo2 = '$lydoe' " ; else $sqlupd =  "";
	   if($lydoe=='') { echo  "###-1###Chưa nhập lý do###---###" ; return; }
	   
	    
  	    $sql = "update phieuyeucau set tinhtrang=$tt,ngayxacnhan2='$ngaytao',ID2='$idk'  $sqlupd   where ID = '0$idphieu'  " ; $data->query($sql); 
		
        if($tinhtrang==4)   {
		
			
		 echo  "###4###Chờ admin duyệt###$ngayduyet###" ; 
		 
		 }else if($tinhtrang==3){
		 	echo  "###3###Không duyệt###$ngayduyet###$lydoe" ; 
		 }else    echo  "###1###Đã lưu###$ngayduyet###$lydoe" ; 
	    return;	
		
	} 
   	  elseif($loai=='giamdoc')	
	{  
	   $tt="$thumua$ketoan".$tinhtrang;
	   
       //if($giamdoc==4||$giamdoc==3||$giamdoc==3 ) return ;
	   if($tinhtrang==3||$tinhtrang==2) $sqlupd =  " ,lydo3 = '$lydoe' " ; else $sqlupd =  "";
	   if($lydoe=='') { echo  "###-1###Chưa nhập lý do###---###" ; return; }
	   
	    $sql = "update phieuyeucau set tinhtrang=$tt,ngayxacnhan3='$ngaytao',ID3='$idk' $sqlupd   where ID = '0$idphieu'  " ; 
			
			 $data->query($sql); 
		
        if($tinhtrang==4){
			$sqlduyet='';
			
				if($thongtindung[1]==1){
					$sqlduyet=" idgioithieu='$thongtindung[2]' ";
				}
				else if($thongtindung[1]==2){ 
					$sqlduyet=" diachiN='$thongtindung[2]' ";
				}
				else if($thongtindung[1]==3){ 
					$sqlduyet=" LyDo='$thongtindung[2]' ";
				}
				else if($thongtindung[1]==4){ 
					$sqlduyet=" GhiChu='$thongtindung[2]' ";
				}
				
				if($thongtindung[1]!=5 && $thongtindung[1]!=6){
				
					$sql = "update phieunhapxuat  set $sqlduyet where SoCT = '$sochungtu'" ;
				}
				else if($thongtindung[1]==5){
					$sql = "delete from thuchich where sochungtu = '".trim($thongtindung[2])."'" ;
				}else if($thongtindung[1]==6){
					$sql = "delete from thuchikt where sochungtu = '".trim($thongtindung[2])."'" ;
				}
			
				$data->query($sql);
				if($thongtindung[1]!=5){
					echo  "###4###Đã duyệt###$ngayduyet###" ;
				
				}
				else{
					echo  "###4###Đã xóa###$ngayduyet###" ;
				}
			 
		}else if($tinhtrang==3){
			echo  "###3###Không duyệt###$ngayduyet###$lydoe" ;
		}
				
			 else  echo  "###1###Đã lưu###$ngayduyet###$lydoe" ; 
	  	  return;	
		
	} 
	     
  
  echo  "###-1###không duyệt###---###" ;
    $data->closedata() ;
?>	