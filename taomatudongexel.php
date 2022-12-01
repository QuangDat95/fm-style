<?php  
session_start();
 
  $idk =   $_SESSION["LoginID"]  ; 
   if ($idk  == "")  return ;  
$root_path =getcwd()."/"  ;
include($root_path."biensession.php");
include($root_path."includes/config.php");
include($root_path."includes/removeUnicode.php");
include($root_path."includes/class.paging.php");
include($root_path."includes/class.mysql.php");
include($root_path."includes/function.php");
include($root_path."includes/function_local.php");
 include_once("includes/xlsxwriter.class.php"); 

   $data = new class_mysql();
   $data->config();
   $data->access();
   
  if(isset($_POST['XUATEXEL'])){
$mamota=$_SESSION["mamota"];
	/*$data1 = $_POST['DATA']; 
	$tmp = explode('*@!',$data1);
	$kieuin=$tmp[0];
	
	
	if(isset($_REQUEST['type'])){
			$kieuin=$_REQUEST['type'];
	}*/
	
		
	
			$filename = "taoma.xlsx";
			 $writer = new XLSXWriter();
			 $writer->setAuthor('datdoan');
			 
		$mangsize=taomang("size","ID","Name", "");
		$mangmau=taomang("mausac","ID", "Name", "");
					 $writer->writeSheetHeader('Sheet1', array("Ten SKU"=>"string","Mã vạch"=>"string","Giá bán"=>"string","Giá bán"=>"string","Số lượng"=>"string","Mã sản phẩm"=>"string","Size"=>"string","Màu"=>"string"));
			 
			 $sql="select a.mamota,b.* from taomatudong a left join taomatudongchitiet b on a.ID=b.IDcha where a.mamota='$mamota'";
			 
			 $result = $data->query($sql); 
			 while($re = $data->fetch_array($result))
			{   
				
					//var_dump($mangsize);
				$tensku=$re["tensp"]."-".$mangmau[$re["IDMau"]]."-".$mangsize[$re["IDSize"]];
				 $tamarr=array($tensku,$re['codepro'],$re["gia"],$re["soluong"],$re["mamota"],$mangsize[$re["IDSize"]],$mangmau[$re["IDMau"]]);
				  
					$writer->writeSheetRow('Sheet1',$tamarr);
					
			}
		
	ob_end_clean();
	header('Content-disposition: attachment; filename="'.XLSXWriter::sanitize_filename($filename).'"');
    header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
    header('Content-Transfer-Encoding: binary');
    header('Cache-Control: must-revalidate');
    header('Pragma: public'); 
	$writer->writeToStdOut();
	 return;
}


	   $data->closedata();
?> 
	 