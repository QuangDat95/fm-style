<?php  
session_start();
 //import thư viện
//$root_path ='' ;
/*include($root_path."includes/config.php");
include($root_path."includes/removeUnicode.php");
 include($root_path."includes/class.mysql.php");
include($root_path."includes/function.php");
include( $root_path."excel/simplexlsx.class.php");*/
  	$tm = $_SESSION["root_path"] ;
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


if ($count_rows >= 600) $rows_end = 600;
list($cols,) = $xlsx->dimension();


if($cols!=105){

	$checkcol=false;
}

$cols=100;
$sql="delete from datapancake";
	$update=$data->query($sql);
foreach($sheets as $k => $r) { 
	
	if (($k >= $rows_begin) && ($k <= $rows_end)) {
	

		$ri='(';
		$c="(";
		for( $i = 0; $i < $cols; $i++)
		{
				if($i==($cols-1)){
						$c.="T".($i+1)."";
				}	
				else{
					$c.="T".($i+1).",";
				}
				
	
		}
		$c.=")";
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
		//insertData($c,$ri);
		if(!insertData($c,$ri))
		{
			//echo " <span style='color:red'>Fail line:".$k."</span> <br>";
		}
		else{
			//echo " <span style='color:green'>Success line:".$k."</span> <br>";
		}
		 
	}
   
	 
} 


return;
function insertData($col,$row){
global $data;
	
	$sql="insert into datapancake ".$col." values ".$row;
	
	 $update=$data->query($sql);
	 return  $update;
}


?>