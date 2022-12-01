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
$uploadDirectoryimages=$root_path.'images/produtcs/';



$anhchinh='';
$anhchinhdaluu=$_POST["anhchinhdaluu"];

$hinhdaluu=$_POST["hinhdaluu"];
$chuoihinh=$_POST["chuoihinh"];

$id=$_POST["id"];
if(isset($_FILES["anhchinh"]))
{
				foreach ($_FILES["anhchinh"]["tmp_name"] as $key => $value) 
				{	
					
                    $tmp_name = $_FILES["anhchinh"]["tmp_name"][$key];
					if($_FILES["anhchinh"]["name"][$key]){
						
						$hinh=so_ngau_nhien()."_".rand()."_".$_FILES["anhchinh"]["name"][$key];
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
				
				if($anhchinhdaluu){
					unlink($uploadDirectoryimages.$anhchinhdaluu);
				}
		
  }
  else{
  
  
		$anhchinh=$anhchinhdaluu;
  	
  }

if(isset($_FILES["hinh"]))
{
	
	$chuoihinh=json_decode($chuoihinh,true);
	
	$arraytam=[];

				foreach ($_FILES["hinh"]["tmp_name"] as $key => $value) 
				{	
					
                    $tmp_name = $_FILES["hinh"]["tmp_name"][$key];
					if($_FILES["hinh"]["name"][$key]){
						
						$hinh=so_ngau_nhien()."_".rand()."_".$_FILES["hinh"]["name"][$key];
						 $mtype= array("image/jpeg","image/pjpeg","image/png","image/x-png",'image/gif','application/x-shockwave-flash');
						 
                 	   $type=$_FILES["hinh"]["type"][$key];		
                        if( in_array($type,$mtype) )
                        { 
                            $kt=true;
                            
                        }
                        if ($kt==true) {
                            if(move_uploaded_file($tmp_name,$uploadDirectoryimages.$hinh)){
								$arraytam[$hinh]=$chuoihinh[$_FILES["hinh"]["name"][$key]];
							}
                        }
					}
                    
                }
				
			$chuoihinh=json_encode($arraytam);
			$hinhmoi=array_keys($arraytam);
		if($hinhdaluu){
			$hinhdaluu=json_decode($hinhdaluu,true);
			foreach($hinhdaluu as $key => $value){
					if(!in_array($key,$hinhmoi)){
						unlink($uploadDirectoryimages.$key);
					}

			}
		}
  }
  else{

				$chuoihinh=json_decode($chuoihinh,true);
			$hinhmoi=array_keys($chuoihinh);
		if($hinhdaluu){
			$hinhdaluu=json_decode($hinhdaluu,true);
			foreach($hinhdaluu as $key => $value){
					if(!in_array($key,$hinhmoi)){
						unlink($uploadDirectoryimages.$key);
					}
			}
		}
		if(count($chuoihinh)>0){
			$chuoihinh=json_encode($chuoihinh);
		}
		else{
			$chuoihinh='';
		}
		
  }
  //return;
  $sql="update products set images='$anhchinh',NameEN='$chuoihinh' where ID=$id";
 
  $update=$data->query($sql);
  if($update){
  	echo 1;
  }
  else
  {
  	echo -1;
  
  }
    $data->closedata() ;
?>	