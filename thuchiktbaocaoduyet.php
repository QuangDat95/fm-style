<?php  
session_start();
 $idk = $_SESSION["LoginID"] ; if (  $idk == '') return ; 
 date_default_timezone_set('Asia/Ho_Chi_Minh');
$root_path =getcwd()."/"  ;
include($root_path."includes/config.php");
include($root_path."includes/removeUnicode.php"); 
include($root_path."includes/class.paging.php");
include($root_path."includes/class.mysql.php");
include($root_path."includes/function.php");
 
$MADK1="HCNVCOL";
 $MADK2="CNDHOL";
   
$data = new class_mysql();
$data->config();
$data->access();


if(isset($_POST["CAPNHATLYDO"])){
	$data1 = $_POST['CAPNHATLYDO']; 
	 $ngayduyet =gmdate('d-n-Y H:i:s', time() + 7*3600) ;
 	 $tmp = explode('*@!',$data1);
		$id   =  laso($tmp[0]) ;
		$lydo = $tmp[1];
 		if($lydo=='')   { echo  "###-1###Chưa nhập lý do###---###" ; return; }
		   
		   
		   
				$sql = "update thuchikt set lydoN='$lydo'  where ID = '$id'  " ;   
				$update=$data->query($sql);
				if($update){
					 echo  "###6###$ngayduyet###$id###$lydo###" ;
				}
				else{
						echo  "###-6###Có lỗi xảy ra vui lòng thử lại!###" ;
				}
	return;
}
if(isset($_POST["DUYETMUTIL"])){
	
	 $data1 = $_POST['DUYETMUTIL']; 
 	 $tmp = explode('*@!',$data1);
 	 $ngayduyet =gmdate('d-n-Y H:i:s', time() + 7*3600) ;
        $idphieu   =  chonghack($tmp[0]);
		$tinhtrang   =  laso($tmp[1]) ;
		$lydo = $tmp[2];
		
		$mangidphieu=explode("###",$idphieu);
		$tammang=[];
		foreach($mangidphieu as $key => $value){
			if($value){
				$value=explode("-",$value);
				if($value[0]=$MADK1 || $value[0]==$MADK2 ){
					array_push($tammang,$value[1]);
				}
			}
		}
		 if($tinhtrang==3 || $tinhtrang==2 || $tinhtrang==1){
		   if($lydo=='')   { echo  "###-1###Chưa nhập lý do###---###" ; return; }
		   
		   	if($tammang && count($tammang)>0){
				foreach($tammang as $key => $value){
		   			$sql = "update thuchikt set tinhtrang='$tinhtrang',ngayduyet='$ngayduyet',lydoN='$lydo'  where ID = '$value'  " ;    	$data->query($sql);
				}
			}
	   }else{
		if($tammang && count($tammang)>0){
			foreach($tammang as $key => $value){
				$sql = "update thuchikt set tinhtrang='$tinhtrang',ngayduyet='$ngayduyet',lydoN='$lydo'  where ID = '$value'  " ; 
				
					$data->query($sql);
			}
		}
	   }
	   $tammang=implode("-",$tammang);
	    if($tinhtrang==4)    echo  "###4###Đã duyệt###$ngayduyet###$tammang###" ;
		 else  if($tinhtrang==2) echo  "###2###Yêu cầu chỉnh sửa###$ngayduyet###$tammang###$lydo###" ;
		 else  if($tinhtrang==3)    echo  "###3###Không duyệt###$ngayduyet###$tammang###$lydo###" ;
		  else  if($tinhtrang==1)  echo  "###1###Chưa duyệt###$ngayduyet###$tammang###$lydo###" ; 
return;
}

  $data1 = $_POST['DATAC']; 
  $tmp = explode('*@!',$data1);
 
        $idphieu   =  laso($tmp[0])   ;
		$tinhtrang   =  laso($tmp[1]) ;
		$lydo = $tmp[2];
		$tknokxd = $tmp[3];
		$tkcokxd = $tmp[4];		
		//$tkcokxd = $tmp[4];	
			/*$idlogin   =  laso($tmp[1])   ;
		$loai   =  ($tmp[2])   ;
		$tinhtrang= laso($tmp[3]) ;
		$lydo = $tmp[4];
		 $ngaytao = gmdate('Y-n-d H:i:s', time() + 7*3600) ;*/
         $ngayduyet =date('Y-m-d H:i:s') ;
	
	  if($tinhtrang==3 || $tinhtrang==2 || $tinhtrang==1){
		   if($lydo=='')   { echo  "###-1###Chưa nhập lý do###---###" ; return; }
		   $sql = "update thuchikt set tinhtrang='$tinhtrang',ngayduyet='$ngayduyet',lydoN='$lydo'  where ID = '$idphieu'  " ;    	$data->query($sql);
	   }
	   else{
		   if($tkcokxd && $tknokxd){
		   	 $sql = "update thuchikt set tinhtrang='$tinhtrang',ngayduyet='$ngayduyet',lydoN='$lydo',tkno='$tknokxd',tkco='$tkcokxd'  where ID = '$idphieu'  " ; 
		   }
		   else if($tkcokxd){
		    $sql = "update thuchikt set tinhtrang='$tinhtrang',ngayduyet='$ngayduyet',lydoN='$lydo',tkco='$tkcokxd'  where ID = '$idphieu'  " ; 
		   }
		   else if($tknokxd){
		   	 $sql = "update thuchikt set tinhtrang='$tinhtrang',ngayduyet='$ngayduyet',lydoN='$lydo',tkno='$tknokxd'  where ID = '$idphieu'  " ; 
		   }
		   else{
		   
			$sql = "update thuchikt set tinhtrang='$tinhtrang',ngayduyet='$ngayduyet',lydoN='$lydo'  where ID = '$idphieu'  " ;   
			} 	
			//echo $sql;
			//return;
			$data->query($sql);
	   }
	     if($tinhtrang==4)    echo  "###4###Đã duyệt###$ngayduyet###$idphieu###$lydo###" ;
		 else  if($tinhtrang==2) echo  "###2###Yêu cầu chỉnh sửa###$ngayduyet###$idphieu###$lydo###" ;
		 else  if($tinhtrang==3)    echo  "###3###Không duyệt###$ngayduyet###$idphieu###$lydo###" ;
		  else  if($tinhtrang==1)  echo  "###1###Chưa duyệt###$ngayduyet###$idphieu###$lydo###" ; 
	    return;	
		
   	  /*
  echo  "###-1###không duyệt###---###" ;*/
    $data->closedata() ;
?>	