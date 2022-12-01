<?php  
session_start();
if ($_SESSION["LoginID"]=="") return ;
$root_path =getcwd()."/"  ;
include($root_path."biensession.php");
include($root_path."includes/config.php");
include($root_path."includes/removeUnicode.php");
include($root_path."includes/class.paging.php");
include($root_path."includes/class.mysql.php");
include($root_path."includes/function.php");
include($root_path."includes/function_local.php");
     $path = $root_path."data/giamgia.xlsx"  ;
  // 	include( $root_path."excel/excel_reader.php");
	include( $root_path."excel/simplexlsx.class.php"); 
$idk = laso($_SESSION["LoginID"]) ; if ($idk == 0) return ;
   
$data = new class_mysql();
$data->config();
$data->access();

  $data1 = $_POST['DATA'];   
  $tmp = explode('*@!',$data1);  
 

  //	$datatc = new Spreadsheet_Excel_Reader($path,true,"UTF-8"); 
  $datatc = new SimpleXLSX($path);
	$sheets=$datatc->rows();
	$sd= count($sheets) ;

	if ($sd>6000 ) $sd = 6000 ; 
	$IDcuahang = laso($tmp[0]) ; 
    $ngaytao=gmdate('Y-n-d H:i:s', time() + 7*3600) ;
	$tu = $tmp[1] ;
	$den =$tmp[2];
		if($tu!="")	
		{
		  $ngay=  explode('/',$tu);
	   	  if (strlen($ngay[1])== 1) {  $ngay[1] = "0".$ngay[1] ;  }
		  if (strlen($ngay[0])== 1) {  $ngay[0] = "0".$ngay[0] ;  }   
		   $tu = "$ngay[2]-$ngay[1]-$ngay[0]";
 		   
		}
		if($den!="")	
		{
		  $ngay=  explode('/',$den);
	   	  if (strlen($ngay[1])== 1) {  $ngay[1] = "0".$ngay[1] ;  }
		  if (strlen($ngay[0])== 1) {  $ngay[0] = "0".$ngay[0] ;  }    		
		  $den = "$ngay[2]-$ngay[1]-$ngay[0]";
		} 
			
	  $dong = 1 ;
	  $toi = 500 ;   
        $mangcuahang =taomangs("cuahang","LCASE(macuahang)","ID"," where id>0"); 
		$mangcuahang['all']=-1;
  			
		$stt=0;  $loi = false ;
		for ($j = $dong; $j <= $sd ; $j++)
		{ 
			
			$codegg=$sheets[$j][2];
			$mahang =str_replace("&nbsp;",'',trim($sheets[$j][1])) ;
			if(ord($mahang[1])==160)   $mahang = substr($mahang,2,strlen($mahang)-2) ;
			$giagiam = laso($sheets[$j][5]) ;
			$GhiChu = addslashes($sheets[$j][6]) ;
			$IDcuahang= laso($mangcuahang[strtolower(trim($sheets[$j][7]))]) ;
				 
			   $tungay=  $sheets[$j][8];  { $dung1=chuyenngay($tungay,'dd-mm-yyyy') ;  }   
			   if($dung1=='') {$dung1=chuyenngay($tungay,'yyyy-mm-dd') ; }$tungay=$dung1;
			   $toingay=  $sheets[$j][9]; { $dung2=chuyenngay($toingay,'dd-mm-yyyy') ; }  
			   if($dung2=='') {$dung2=chuyenngay($toingay,'yyyy-mm-dd')   ;}   $toingay=$dung2; 
		 
		if(!$mahang){
		
			if($codegg){
				
				$sqlc = "select * from products where code ='$codegg'" ;
				
				 $result=$data->query($sqlc);
				 while($re =$data->fetch_array($result)){
					$giamp = 100-round($giagiam*100/$re['price'],3) ;
					
							if ($IDcuahang==-1)
							{
								
								foreach($mangcuahang as $mach=>$IDcuahang)
								{
									$sql=" select ID from giamgiacuahang where  IDSP='$re[ID]'   and IDcuahang='$IDcuahang' limit 1 " ;
									
									$tam = getdong($sql);
							 
									if ($tam['ID']!='') 
									$sql="update   giamgiacuahang set IDSP='$re[ID]',giamgia='$giamp',giagiam='$giagiam',ngaybatdau='$tungay',ngayketthuc='$toingay',
									IDcuahang='$IDcuahang',GhiChu='$GhiChu',ngaytao='$ngaytao', ngaycapnhap='$ngaytao' where ID= '$tam[ID]' ";
									else
									$sql="INSERT INTO giamgiacuahang set IDSP='$re[ID]',giamgia='$giamp',giagiam='$giagiam',ngaybatdau='$tungay',ngayketthuc='$toingay',
									IDcuahang='$IDcuahang',GhiChu='$GhiChu',ngaytao='$ngaytao', ngaycapnhap='$ngaytao'";
									  
									//  echo $sql ;
									$update=$data->query($sql);
								}
								
							}
							else if ($IDcuahang>0)
							{
								
									$sql=" select ID from giamgiacuahang where  IDSP='$re[ID]'   and IDcuahang='$IDcuahang' limit 1 " ;
								
									$tam = getdong($sql);
							 
									if ($tam['ID']!='') 
									$sql="update   giamgiacuahang set IDSP='$re[ID]',giamgia='$giamp',giagiam='$giagiam',ngaybatdau='$tungay',ngayketthuc='$toingay',
									IDcuahang='$IDcuahang',GhiChu='$GhiChu',ngaytao='$ngaytao', ngaycapnhap='$ngaytao' where ID= '$tam[ID]' ";
									else
									$sql="INSERT INTO giamgiacuahang set IDSP='$re[ID]',giamgia='$giamp',giagiam='$giagiam',ngaybatdau='$tungay',ngayketthuc='$toingay',
									IDcuahang='$IDcuahang',GhiChu='$GhiChu',ngaytao='$ngaytao', ngaycapnhap='$ngaytao'";
											
									$update=$data->query($sql);
									
							}
					}
			}
		}
		else{
			$sql = "select * from products where codepro ='$mahang' limit 1 " ;
			
			
			$re = getdong($sql);		
			$giamp = 100-round($giagiam*100/$re['price'],3) ;
			
			if ($re['ID']=='') {  $loi=true ; return ; }
			
				if ($IDcuahang==-1)
				{
					foreach($mangcuahang as $mach=>$IDcuahang)
					{
						$sql=" select ID from giamgiacuahang where  IDSP='$re[ID]'   and IDcuahang='$IDcuahang' limit 1 " ;
						$tam = getdong($sql);
				 
						if ($tam['ID']!='') 
						$sql="update   giamgiacuahang set IDSP='$re[ID]',giamgia='$giamp',giagiam='$giagiam',ngaybatdau='$tungay',ngayketthuc='$toingay',
						IDcuahang='$IDcuahang',GhiChu='$GhiChu',ngaytao='$ngaytao', ngaycapnhap='$ngaytao' where ID= '$tam[ID]' ";
						else
						$sql="INSERT INTO giamgiacuahang set IDSP='$re[ID]',giamgia='$giamp',giagiam='$giagiam',ngaybatdau='$tungay',ngayketthuc='$toingay',
						IDcuahang='$IDcuahang',GhiChu='$GhiChu',ngaytao='$ngaytao', ngaycapnhap='$ngaytao'";
						 
						 
						//$tam = getdong($sql);
						$update=$data->query($sql);
							
					}
					
				}
				else if ($IDcuahang>0)
				{
						$sql=" select ID from giamgiacuahang where  IDSP='$re[ID]'   and IDcuahang='$IDcuahang' limit 1 " ;
						$tam = getdong($sql);
				 
						if ($tam['ID']!='') 
						$sql="update   giamgiacuahang set IDSP='$re[ID]',giamgia='$giamp',giagiam='$giagiam',ngaybatdau='$tungay',ngayketthuc='$toingay',
						IDcuahang='$IDcuahang',GhiChu='$GhiChu',ngaytao='$ngaytao', ngaycapnhap='$ngaytao' where ID= '$tam[ID]' ";
						else
						$sql="INSERT INTO giamgiacuahang set IDSP='$re[ID]',giamgia='$giamp',giagiam='$giagiam',ngaybatdau='$tungay',ngayketthuc='$toingay',
						IDcuahang='$IDcuahang',GhiChu='$GhiChu',ngaytao='$ngaytao', ngaycapnhap='$ngaytao'";
						
						$update=$data->query($sql);
				}
		}
		
 	  }  
 
      	
    $data->closedata() ;
?>	