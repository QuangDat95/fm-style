<?php 
session_start();
$id = $_SESSION["LoginID"] ;

 if ($id =="") return ;
 $idch = $_SESSION["se_kho"] ;
 
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
$uploadDirectoryimages='images/products/tamfile/';

if($_POST["LUUANHCHINH"]){
$anhchinh='';
		if(isset($_FILES["anhchinh"]))
		{
						foreach ($_FILES["anhchinh"]["tmp_name"] as $key => $value) 
						{	
							
							$tmp_name = $_FILES["anhchinh"]["tmp_name"][$key];
							if($_FILES["anhchinh"]["name"][$key]){
								
								$hinh=so_ngau_nhien()."_".rand()."_".replacesp($_FILES["anhchinh"]["name"][$key]);
								 $mtype= array("image/jpeg","image/pjpeg","image/png","image/x-png",'image/gif','application/x-shockwave-flash');
								 
							   $type=$_FILES["anhchinh"]["type"][$key];		
								if( in_array($type,$mtype) )
								{ 
									$kt=true;
									
								}
								if ($kt==true) {
									if(move_uploaded_file($tmp_name,$uploadDirectoryimages.$hinh)){
										$anhchinh=$hinh;
									}
								}
							}
							
						}
						
				echo $anhchinh;
		  }
		  
		  return;
		
}

	function checkAnhSp
 function replacesp($tr){
 	$tr=str_replace("-","_",$tr);
	$tr=str_replace(" ","_",$tr);
	$tr=str_replace("(","",$tr);
	$tr=str_replace(")","",$tr);
	return $tr;
 }
    $data->closedata() ;
?>	