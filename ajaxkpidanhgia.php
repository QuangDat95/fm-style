<?php
 session_start();
 
 $idl=$_SESSION["LoginID"] ;
 
$IDCH = $_SESSION["se_kho"] ; 
$root_path =getcwd()."/"  ;
// include($root_path."biensession.php");
include($root_path."includes/config.php");
include($root_path."includes/removeUnicode.php");
include($root_path."includes/class.paging.php");
include($root_path."includes/class.mysql.php");
include($root_path."includes/function.php");
include($root_path."includes/function_local.php");
include($root_path."includes/xlsxwriter.class.php"); 
//  //if ($us =="" || $id == "" ) { echo " Ban chua dang nhap!!! " ;return ;}
  
$data = new class_mysql();
$data->config();
$data->access();
  
$data1="nothing";

if(isset($_POST["PHONGBAN"])){
	$data1 = chonghack($_POST['PHONGBAN']); 
	$tmp = explode('*@!',$data1);
	$idkpi=trim($tmp[0]);
	$sql="select * from kpi_danhgia where IDphongban=".$idkpi;
	// $query_districts = $data->query($sql);
	// $arrtmp=[];
	// $chuoikpi ='<option value="0" > </option>';
	// while($result_district = $data->fetch_array($query_districts)){
	// 	$arrtmp=$result_district;
	printtree1(0, 1, 0, '', false, $idkpi);
	// }  
	echo "<option value=' '></option>".$Caytm;
	// return;
}


function printtree1($id_root, $level,$select_i,$idcall,$action,$idphongban)
	{			
		global $data, $Caytm;  
		$space="&nbsp;";
		$ten1="";	 	
		for($i=0; $i<$level; $i++)
		{
			$ten1.=$space;
		}
		$sql="SELECT ten,ID,IDcha,kpi_dexuat,chucvu FROM  kpi_danhgia WHERE IDcha='$id_root' and ID != 0 and IDphongban=$idphongban";
		
        // echo "test1".$sql;
		if($result=$data->query($sql)){			
			while($result_news = $data->fetch_array($result))
			{
				$id = $result_news["ID"] ;
				if (trim($result_news["IDcha"]) == "0") { $ten1 = "" ; }
				$ten=$result_news["ten"];
				$ma =  $ten1."";
				$select = "" ;
				 
				if ( trim($select_i) == trim($id) )
					{
						$select = "selected";	
 					}				 
				if (trim($idcall)!= trim($id) && $action ==false )
				   { $Caytm.="<option value='$id' $select>$ma - $ten</option> ";}			
				   else
				   {	 $Caytm.= "<optgroup label='$ma - $ten'></optgroup>" ; $action = true ;}
				printtree1($id, $level+1,$select_i,$idcall,$action,$idphongban);	
					 $action = false ;	 
			 }
		 }
	}



?>