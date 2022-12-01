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
	
		 
 $soluong=1;
 $tongtien=1;
 	 
	$sql = "select tinhtrang,lydo,IDNV,sotien,soct,soluong,ghichu,hinhanh  from duyetdexuat  where ID = '0$idphieu'" ;	
	$phieu=getdong($sql); 
		$tam=$phieu['tinhtrang']."111";
	 $sotien=$phieu['sotien'];
	  $lydo=$phieu['lydo'];
	    $soluong=$phieu['soluong'];
		 $ghichu=$phieu['ghichu'];
		 $hinhanh=$phieu['hinhanh'];
	  $Name=getten("userac",$phieu['IDNV'],'Ten');
	  $sochungtu=$phieu['soct'];
	$thumua=$tam[0];
	

	$ketoan=$tam[1];
	$giamdoc=$tam[2];
	
	if($loai=='thumua')	
	{
	
	   $tt=$tinhtrang."$ketoan$giamdoc";
       if($ketoan==4||$ketoan==3||$giamdoc==3||$giamdoc==4) return ;
	   if($tinhtrang==3||$tinhtrang==2) $sqlupd =  " ,lydothumua = '$lydoe' " ; else $sqlupd =  "";
	   if($lydoe=='')   { echo  "###-1###Chưa nhập lý do###---###" ; return; }
  	   $sql = "update duyetdexuat set tinhtrang='$tt',ngaythumua='$ngaytao',IDthumua='$idk' $sqlupd  where ID = '0$idphieu'  " ;    $data->query($sql);
	   
	 
	     if($tinhtrang==4)   { 
		 //gủi tin thu mua
		 			$siteimg='https://siandchip.vn/images/duyetmuasam/';
			
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
$noidung="Yêu cầu xét duyệt: $sochungtu

*Lý do: $lydo

*Số tiền: $sotien

*Số lượng: $soluong

*Tổng tiền: $tongtien

*Người tạo: $Name

$ghichutxt

$hinhanhtxt
";


	$result=sendme($id,$noidung);
			
				if($result){
					$result=json_decode($result,true);
					if($result['status']==200){
							$sql = "update duyetdexuat set tinhan=211  where ID = '0$idphieu'  " ;
							 $data->query($sql);
					}
					
				}
		 		
				
				
			 echo  "###4###Chờ kế toán duyệt###$ngayduyet###" ; 
		 
		 }
		else if($tinhtrang==3){
		 	echo  "###3###Không duyệt###$ngayduyet###$lydoe" ; 
		 }
		 else    echo  "###1###Đã lưu###$ngayduyet###$lydoe" ; 
	    return;	
	} 
	elseif($loai=='ketoan')	
	{  
	   $tt="$thumua".$tinhtrang."$giamdoc";
	   
       if($giamdoc==4||$giamdoc==3 ) return ;
	   if($tinhtrang==3||$tinhtrang==2) $sqlupd =  " ,lydoketoan = '$lydoe' " ; else $sqlupd =  "";
	   if($lydoe=='') { echo  "###-1###Chưa nhập lý do###---###" ; return; }
	   
	    
  	    $sql = "update duyetdexuat set tinhtrang=$tt,ngayketoan='$ngaytao',IDketoan='$idk'  $sqlupd   where ID = '0$idphieu'  " ; $data->query($sql); 
		
        if($tinhtrang==4)   {
		
				//gủi tin kế toán
		 		$siteimg='https://siandchip.vn/images/duyetmuasam/';
			
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

				$id='6587999482046213375';
$noidung="Yêu cầu xét duyệt: $sochungtu

*Lý do: $lydo

*Số tiền: $sotien

*Số lượng: $soluong

*Tổng tiền: $tongtien

*Người tạo: $Name

$ghichutxt

$hinhanhtxt
";


//echo $noidung;
				/*$result=sendme($id,$noidung);
			
			//gủi tin giamdoc
		 		$id='4571897234802874336';
$noidung="yêu cầu xét duyệt: $sochungtu
lý do: $lydo
số tiền: $sotien
người tạo: $Name";*/
				$result1=sendme($id,$noidung);
				if($result1){
					$result1=json_decode($result1,true);
					if($result1['status']==200){
							$sql = "update duyetdexuat set tinhan=221  where ID = '0$idphieu'  " ;
							 $data->query($sql);
					}
					
				}
		 echo  "###4###Chờ lãnh đạo duyệt###$ngayduyet###" ; 
		 
		 }else if($tinhtrang==3){
		 	echo  "###3###Không duyệt###$ngayduyet###$lydoe" ; 
		 }else    echo  "###1###Đã lưu###$ngayduyet###$lydoe" ; 
	    return;	
		
	} 
   	  elseif($loai=='giamdoc')	
	{  
	   $tt="$thumua$ketoan".$tinhtrang;
	   
       //if($giamdoc==4||$giamdoc==3||$giamdoc==3 ) return ;
	   if($tinhtrang==3||$tinhtrang==2) $sqlupd =  " ,lydogiamdoc = '$lydoe' " ; else $sqlupd =  "";
	   if($lydoe=='') { echo  "###-1###Chưa nhập lý do###---###" ; return; }
	   
	    $sql = "update duyetdexuat set tinhtrang=$tt,ngaygiamdoc='$ngaytao',IDgiamdoc='$idk' $sqlupd   where ID = '0$idphieu'  " ; 
			
			 
			 $data->query($sql); 
		
        if($tinhtrang==4){
				//gủi tin giám đốc
		 		$siteimg='https://siandchip.vn/images/duyetmuasam/';
			
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

				$id='4571897234802874336';
$noidung="Yêu cầu xét duyệt: $sochungtu

*Lý do: $lydo

*Số tiền: $sotien

*Số lượng: $soluong

*Tổng tiền: $tongtien

*Người tạo: $Name

$ghichutxt

$hinhanhtxt
";

				/*$result=sendme($id,$noidung);
			
			//gủi tin ketoan
		 		$id='2646491592555906088';
$noidung="yêu cầu xét duyệt: $sochungtu
lý do: $lydo
số tiền: $sotien
người tạo: $Name";*/
				$result1=sendme($id,$noidung);
				if($result1){
					$result1=json_decode($result1,true);
					if($result1['status']==200){
							$sql = "update duyetdexuat set tinhan=222  where ID = '0$idphieu'  " ;
							 $data->query($sql);
					}
					
				}
				
			 echo  "###3###Đã duyệt###$ngayduyet###" ;
			 
			}else if($tinhtrang==3){
		 		echo  "###3###Không duyệt###$ngayduyet###$lydoe" ;
				}
				
			 else  echo  "###1###Đã lưu###$ngayduyet###$lydoe" ; 
	  	  return;	
		
	} 
	     
  
  echo  "###-1###không duyệt###---###" ;
    $data->closedata() ;
?>	