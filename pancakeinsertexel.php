<?php  
session_start();
	$tm = $_SESSION["root_path"] ;
 //import thư viện
//$root_path ='' ;
/*include($root_path."includes/config.php");
include($root_path."includes/removeUnicode.php");
 include($root_path."includes/class.mysql.php");
include($root_path."includes/function.php");
include( $root_path."excel/simplexlsx.class.php");*/
  
    $path = $root_path."data/orders.xlsx" ;
	 
  	
//khỏi tạo data
/*$data = new class_mysql();
$data->config();
$data->access();*/
// khởi tạo đọc excel
$xlsx = new SimpleXLSX($path);
$sheets=$xlsx->rows();


//đọc dữ liệu
$rows_begin = 1;
$rows_end = count($sheets);


if ($count_rows >= 5000) $rows_end = 5000;
list($cols,) = $xlsx->dimension();


if($cols!=105){

	$checkcol=false;
}

$cols=100;
$c="(";
$chuoir='';
$checkcol=false;
$sql="delete from datapancake";
	$update=$data->query($sql);
foreach($sheets as $k => $r) { 
	
	if (($k >= $rows_begin) && ($k <= $rows_end)) {
	

		$ri='(';
		if(!$checkcol){
		
			for( $i = 0; $i < $cols; $i++)
			{
					if($i==($cols-1)){
							$c.="T".($i+1)."";
							$checkcol=true;
					}	
					else{
						$c.="T".($i+1).",";
					}
					
		
			}
		}
		
		$j=0;
		foreach($r as $key => $value){
		
				if($j==($cols-1)){
						$ri.="'".addslashes($value)."'";
						
						break;
				}	
				else{
					$ri.="'".addslashes($value)."',";
				}
			$j++;
		}	
		$ri.=')';
		
			$chuoir.=$ri.',';
		
		
		 
	}
   
	 
} 
$c.=")";
$chuoir=rtrim($chuoir,',');
insertData($c,$chuoir);
function insertData($col,$row){
global $data;
	
	$sql="insert into datapancake ".$col." values ".$row;
	
	 $update=$data->query($sql);
	 return  $update;
}


?>