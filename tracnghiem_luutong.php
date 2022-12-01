<?php  
session_start();
$idk = $_SESSION["LoginID"] ; if (  $idk == '') return ;
 $idkho = $_SESSION["se_kho"] ;
$root_path =getcwd()."/"  ;
include($root_path."biensession.php");
include($root_path."includes/config.php");
include($root_path."includes/removeUnicode.php");
include($root_path."includes/class.paging.php");
include($root_path."includes/class.mysql.php");
include($root_path."includes/function.php");
include($root_path."includes/function_local.php");
   
		$data = new class_mysql();
		$data->config();
		$data->access();
		$mpt = array () ;
		$mangud = array() ;
		$data1 = $_POST['DATA']; 
		//echo $data1;
		//return;
		$tmp = explode('*@!',$data1); 
		// echo 1; return;
 
		$score=$tmp[1]; 
		$questions_lenght=$tmp[2];
		$scorepercent=$tmp[3]; 
		$match=$tmp[4]; 
		$traloi=$tmp[5]; 

		$ngaytao = gmdate('Y-n-d H:i:s', time() + 7*3600) ; 

 		if( 1==1 )
		{ 
			$sql = "insert into tracnghiem_ketqua set ngaytao='$ngaytao', ma ='$score',IDloai ='$questions_lenght' , IDnhom ='$scorepercent', NameN ='$match', note='$traloi', id_user='$idk' "  ;
			//echo $sql; return;
			$data->query($sql);	

			$ngaytrangthai= gmdate('H:i:s d-n-Y', time() + 7*3600) ;
			echo "Đã Xong!" ;
			// echo "Trạng thái: đã lưu Phiếu: $sochungtu, lúc: $ngaytrangthai" ;
			//return ;		 
		}   // else của them mới
		// else
		// {    

		// 	$sql = " update nvl_xuatkho   set ngaytao='$ngaytao', diem ='$score', scorepercent ='$scorepercent', loai ='$match', id_user='$idk'  where ID = '$idgoi'"  ;
		// 	$data->query($sql);	

		// 	echo "Đã Cập nhật**#$idgoi**#$sochungtu**#" ;
		// 	// $ngaytrangthai= gmdate('H:i:s d-n-Y', time() + 7*3600) ;
		// 	// echo "Trạng thái: đã cập nhật Phiếu: <b> $sochungtu </b>, lúc:<b> $ngaytrangthai </b>" ;
		// 	//echo "Đã Cập nhật :)";
		// }
	    $data->closedata() ;
  	
	

  	return ;

  				
?>	