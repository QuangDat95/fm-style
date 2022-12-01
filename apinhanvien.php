<?php  
 header("Content-Type: application/json");
 $json = file_get_contents('php://input');	  
 
 
 if($json)
   {
	   $json = json_decode($json, true);
	 
	    $baomat= $json['baomat']  ;
	   if($baomat=='') return ;
		$idphong=  ($json['idphong'])  ;
	   
 
}
 else   return ;


 	
		
    $baomat = explode('!@9',$baomat);    
    $baomat =$baomat[1];
		
 if ($baomat!="2cffe4a34ccc4f9c6ec755843593458b") return ;   // Tcv13



$root_path =getcwd()."/"  ;
include($root_path."biensession.php");
include($root_path."includes/config.php");
include($root_path."includes/removeUnicode.php");
include($root_path."includes/class.paging.php");
include($root_path."includes/class.mysql.php");
include($root_path."includes/function.php");
include($root_path."includes/function_local.php");

  
//  //if ($us =="" || $id == "" ) { echo " Ban chua dang nhap!!! " ;return ;}
  
$data = new class_mysql();
$data->config();
$data->access();

     $ngaytao =  gmdate('Y-m-d', time() + 7*3600 ) ;
  
     $user  = chonghack(trim($user))  ;		 
     $pass =  chonghack($pass)  ;	
     if(laso($idphong)>0)  $phong = " and b.idphong=$idphong  " ; 
	 
 	 $sql = " SELECT  b.ID,b.Ten,b.MaNV,b.IDPhong,b.ChucVu from   userac b   where  1 $phong       ";  
 	 $result = $data->query($sql);
	 

	  
   while($re = $data->fetch_array($result))  { $mangqt[$re['ID']]= $re; }
 	 
	// 	echo serialize($mangqt) ; return ;
		
     if(!$result) { $data_array =  array(
				"Erorr"=> 1,
				'Messenger' =>"Không có dữ liệu $sql "
  			  );	
			  echo json_encode($data_array);  return;
          }
		  
	$data_array =  array(
				"Erorr"=> 0,
				'data' => serialize($mangqt),
				'Messenger' =>"Thành công  "
 			  );	 
         
    
     echo json_encode($data_array); return ;
  			
 
    $data->closedata() ;
?>	