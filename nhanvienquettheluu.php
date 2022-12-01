<?php  session_start();

 
$IDcuahang = $_SESSION["se_kho"] ;
$tencuahang = $_SESSION["S_tencuahang"] ;
$root_path =getcwd()."/"  ;
include($root_path."includes/config.php");
include($root_path."includes/class.paging.php");
include($root_path."includes/class.mysql.php");
include($root_path."includes/function.php");

    
$data = new class_mysql();
$data->config();
$data->access();
 
  $data1 = $_POST['DATA']; 
  $tmp = explode('*@!',$data1);
  $manv = chonghack($tmp[0]) ;
	 
   $_SESSION["manvq"] = $manv   ;
  $note = chonghack($tmp[1]) ;
  if ($manv =='') return 'Chua c� m�';
   $ngaytao = gmdate('Y-n-d H:i:s', time() + 7*3600) ;
   $ngayk = gmdate('Y-n-d H:i:s', time() + 7*3600-300) ;
   $ngay = gmdate('Y-n-d', time() + 7*3600) ;
//    echo $ngaytao;
      $sql = " select  ID,Ten from userac where MaNV ='$manv' limit 1 " ; 
	  $tam = getdong($sql) ;
    if ($tam=='') return ;
	
	 $sql = " select  count(ID) as solan  from nhanviendilam where MaNV ='$manv' and ngaytao > '$ngay 00:01:01'   " ; 
 	   $tamk = getdong($sql) ;
		
	    if (laso($tamk['solan']) ==0 ) $lan = 1;
	    else if (laso($tamk['solan']) ==1 ) $lan = 2;
	    else if (laso($tamk['solan']) ==2 ) $lan = 1;
	    else if (laso($tamk['solan']) ==3 ) $lan = 2;
	    else if (laso($tamk['solan']) ==4 ) $lan = 1;
	    else if (laso($tamk['solan']) ==5 ) $lan = 2;
	    else if (laso($tamk['solan']) ==6 ) $lan = 1;	
		else if (laso($tamk['solan']) ==7 ) $lan = 2;
	    else if (laso($tamk['solan']) ==8 ) $lan = 1;
	   
	  $sql = " select  ID  from nhanviendilam where MaNV ='$manv' and ngaytao > '$ngayk' limit 1 " ; 
 	   $tamk = getdong($sql) ;
		// echo $tamk["ID"];
	    if ($tamk !='') { echo "**#2**#" ; return ; }
		
       $sql = " insert into nhanviendilam set manv ='$manv',IDnhanvien ='$tam[ID]',Name ='$tam[Ten]',NameN='".$tam['Ten']."',cuahang='$tencuahang',IDcuahang='$IDcuahang',note='$note',ngaytao='$ngaytao',loai='$lan',ip='$db[ip]' ";
		$tt= $data->query($sql);	
		
		$sql = " select  ID  from nhanviendilam where MaNV ='$manv' and ngaytao='$ngaytao'" ;
	 
  		$tak = getdong($sql) ;
		if ($tak['ID']) { echo "**#1**#$tak[ID]**#" ; return ; }
		$sql = "";
	 
	 //   $data->closedata() ;
  	return ;
 ?>