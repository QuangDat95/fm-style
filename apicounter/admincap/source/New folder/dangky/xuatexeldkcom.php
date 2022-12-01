<?php
session_start();
$root_path = '../../' ;

//include_once($root_path."includes/config.php");
include_once($root_path."includes/removeUnicode.php");
include_once($root_path."includes/class.template7.php");
include_once($root_path."includes/class.paging.php");
include_once($root_path."includes/function.php");
include_once($root_path."includes/function_local.php");
include_once($root_path."includes/handlers.php");
include_once($root_path."includes/xlsxwriter.class.php"); 

if(isset($_POST['perform'])){
	
	switch($_POST['perform']){
		case 'GETDANHSACH':

			GetDSByPB(); 
		break;
		
		default:
		break;
	}
	
}
function xuatexel(){
	$filename = "hinhanh.xlsx";
 	$writer = new XLSXWriter();
	 $writer->setAuthor('datdoan');
	  $writer->writeSheetHeader('Sheet1', array('Khu vực'=>'string','Tên Hình '=>'string','Link hình'=>'string'));
	  foreach($mangpush as  $value){
			$writer->writeSheetRow('Sheet1',$value);
	}
	  ob_end_clean();
	 header('Content-disposition: attachment; filename="'.XLSXWriter::sanitize_filename($filename).'"');
    header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
    header('Content-Transfer-Encoding: binary');
    header('Cache-Control: must-revalidate');
    header('Pragma: public'); 
	$writer->writeToStdOut();
}

?>