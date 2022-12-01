<?php  
session_start();
$idk = $_SESSION["LoginID"] ; if (  $idk == '') return ;
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

    $data1 = $_POST['DATA']; 
    $tmp = explode('*@!',$data1);  
 	$id = laso($tmp[0]) ;
	 $chatngan =addslashes( chonghack($tmp[1])) ;
	 $lancuoi=gmdate('Y-m-d H:i:s', time() + 7*3600) ;
     $sql = " select ID,noidung,chatngan from passdonchat where id= $id " ; $tam = getdong($sql);
	 $chatngan = $_SESSION["MaNV"]. ' <i>'.gmdate('n-d H:i:s', time() + 7*3600). "</i>:<b class = nguoitao > " . $chatngan .'</b>' ;
    
	 if(laso($tam['ID']) ==0)  { $chatngan =addslashes( $chatngan);$noidung =  $chatngan;  $sql = "  insert into passdonchat  set id='$id', chatngan = '$chatngan',noidung ='$noidung' ,lancuoi='$lancuoi'   " ; }
     else  
	{ $noidung =  ( $tam['noidung'])  ."<br>". $chatngan;     $sql = "  update passdonchat set  chatngan = '$chatngan',noidung ='$noidung' ,lancuoi='$lancuoi' where ID = '$id'  " ; }
	 
 // echo $sql ;
	   $data->query($sql) ;
	 
    echo $noidung ;   
 
 	
 
 
    $data->closedata() ;
?>