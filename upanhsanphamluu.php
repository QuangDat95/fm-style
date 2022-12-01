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

if(isset($_POST["KIEMTRAHINH"])){
		$data1 = $_POST['KIEMTRAHINH']; 
	  $tmp = explode('*@!',$data1);
	  $chuoihinh   =$tmp[0];
	  if($chuoihinh){
	  	$chuoihinh =json_decode($chuoihinh,true);
		$manghinh=$chuoihinh["data"];
		
		foreach($manghinh as $key => $value){
			if($value){
				$masp=explode("-",$value)[0];
				$sql="Select ID from products  where codepro='$masp' or code='$masp' limit 1";
				$dong=getdong($sql);
				if($dong["ID"]){
					$manghinh[$key]=$dong["ID"]."--".$value;
				}
				
			}
		}
		$chuoihinh["data"]=$manghinh;
		echo json_encode($chuoihinh);
		return;
		
	  }
	  
	  echo -1;
	  return;
		
}

if(isset($_POST["UPDATEHINH"])){
		$data1 = $_POST['UPDATEHINH']; 
	  $tmp = explode('*@!',$data1);
	  $chuoihinh   =$tmp[0];
	  $tammang=[];
	  if($chuoihinh){
	  	$chuoihinh =json_decode($chuoihinh,true);
		
		
		$tamtencheck='';
		$tamchuoi='';
		$tamfname='';
		$anhchinhtam='';
		$i=0;
		foreach($chuoihinh as $key => $value){
				$tamten=explode("--",$key);
				$fname='';
				if($tamten[0]!=$key){
						
						$fname=$tamten[1];
				}
				if($fname){
					$tamtentrung=explode("-",$fname);
					
					if($tamtencheck==$tamtentrung[0]){
						$tamchuoi.="###".$fname;
					}
					
					if($tamtencheck==''){
						$tamfname=$fname;
						
						$tamtencheck=$tamtentrung[0];
						$tamchuoi.="###".$fname;
						
						
					}
					else if($tamtencheck!=$tamtentrung[0]){
							
							$tammang[$tamtencheck]['anhchinh']=$tamfname;
							$tammang[$tamtencheck]['anhmausize']=$tamchuoi;
							$tamtencheck=$tamtentrung[0];
							$tamfname=$fname;
							$tamchuoi='';
							
					}
					
					
					
				}
					if($i==count($chuoihinh)-1){
						$tamchuoi.="###".$tamfname;
							$tammang[$tamtencheck]['anhchinh']=$tamfname;
							$tammang[$tamtencheck]['anhmausize']=$tamchuoi;
					}
			$i++;
		}
		
		if(count($tammang)>0){
			foreach($tammang as $key => $value){
					$sql="update products set images='$value[anhchinh]',NameEN='$value[anhmausize]' where code='$key' or codepro='$key'";
					$update=$data->query($sql);
			}
		}
		echo "###1###Đã lưu!###";
		return;
		
	  }
	  
	  echo "###-1###lỗi!###";
	  return;
		
}

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
if($_POST["LUUANHMAU"]){
	if(isset($_FILES["hinh"]))
	{
		$arraytam=[];

				foreach ($_FILES["hinh"]["tmp_name"] as $key => $value) 
				{	
					
                    $tmp_name = $_FILES["hinh"]["tmp_name"][$key];
					if($_FILES["hinh"]["name"][$key]){
						
						$hinh=so_ngau_nhien()."_".rand()."_".replacesp($_FILES["hinh"]["name"][$key]);
						 $mtype= array("image/jpeg","image/pjpeg","image/png","image/x-png",'image/gif','application/x-shockwave-flash');
						 
                 	   $type=$_FILES["hinh"]["type"][$key];		
                        if( in_array($type,$mtype) )
                        { 
                            $kt=true;
                            
                        }
                        if ($kt==true) {
                            if(move_uploaded_file($tmp_name,$uploadDirectoryimages.$hinh)){
								array_push($arraytam,$hinh);
							}
                        }
					}
                    		
                }
			echo json_encode($arraytam);	
  	}
  
  	return;
 }
 
 if($_POST["LUUTT"]){
 
   $data1 = $_POST['LUUTT']; 
	  $tmp = explode('*@!',$data1);
	  $chuoihinh   =$tmp[0];
	  $tamchuoi='';
	   if($chuoihinh){
	  	$chuoihinh =json_decode($chuoihinh,true);
			foreach($chuoihinh as $key => $value){
				
				if($key){
					
					
						$tamchuoi.="###".$key;
					
				}
			}
			
		}
	   $anhchinh   =$tmp[1];

		$id=$tmp[2];
	
	  $sql="update products set images='$anhchinh',NameEN='$tamchuoi' where ID=$id";
	   //echo $sql;
	   
	  $update=$data->query($sql);
	 echo 1;
	return;
 }
  if($_POST["DATAXOAANH"]){
  	$linkchinh=$root_path.'images/products/';
	  $data1 = $_POST['DATAXOAANH']; 
	  $tmp = explode('*@!',$data1);
	  $tenanh   =$tmp[0];
	  if(file_exists($linkchinh.$tenanh)){
	  	if(unlink($linkchinh.$tenanh)){
			echo "##Đã xóa##";
		}
	  }
	  else{
	  	echo "##File không tồn tại##";
	  }
			
			
  }		
 
 
 function replacesp($tr){
 	$tr=str_replace("-","_",$tr);
	$tr=str_replace(" ","_",$tr);
	$tr=str_replace("(","",$tr);
	$tr=str_replace(")","",$tr);
	return $tr;
 }
    $data->closedata() ;
?>	