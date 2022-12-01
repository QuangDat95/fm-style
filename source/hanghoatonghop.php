<?php
session_start();
   $pa = getcwd() ;
      $idkho = $_SESSION["se_kho"] ; 
	  
	 
    $root_path = $pa."/data/data_file".$idkho.".xlsx"  ;
  	//include( $pa."/excel/excel_reader.php");
	include( $pa."/excel/simplexlsx.class.php");  
	if (!defined("IN_SITE")){  	die('Hacking attempt!');}
 	$data->setthaotac = "doichieu" 	;
//=============================khoi tao ======================//  	 Xem  	 Them  	 Cap nhap  	 Tim  	Huy  	Khoa  	In
  //=======================================================================================	
 
 
  
 $donglai = "none" ;
if (trim($_REQUEST["t5"]) != '')   $donglai = '' ;

    $IDtao =  $_SESSION["LoginID"]  ;
	  $idkho = $_SESSION["se_kho"] ; 
  //=======================================================================================
   
	
	
if(isset($_POST['Submit']) || isset($_POST['luulai']) )
{	
 
@move_uploaded_file($_FILES['file']['tmp_name'],$root_path) ;
@unlink($_FILES['file']); 

	if ( $data_file = SimpleXLSX::parse($root_path) ) {

	//echo '<table border="1" cellpadding="3" style="border-collapse: collapse">';
        $sheets=$data_file->rows();
		$sd= count($sheets);
		//echo $sd;
		$dim = $data_file->dimension();
		$cols = $dim[0];
       
	   echo $sd;
	
   // $template->assign("dong", 2  );
	//$template->assign("toi", ''  );
		
		foreach ( $data_file->rows() as $k => $r ) {
					if ($k < 2) continue; // bo qua 2 dong dau
			//echo '<tr>';
			
			//for ( $i = 0; $i < $cols; $i++ ) { 
			for ( $i = 0; $i < $cols; $i++ ) { 
				//$congnoncc[] = $r[$i];
				//echo '<td>' . ( isset( $r[ $i ] ) ? $r[ $i ] : '&nbsp;' ) . '</td>';
				//echo '<td>' . $r[ $i ] . '</td>';
				//$td[] = '<td>' . $r[ $i ] . '</td>';
				//$template->assign("t2",$ngayct = (new DateTime($r[1]))->format('d-m-Y'));
				$template->assign("t1",$t1 = $r[0]);
				$template->assign("t2",$t2 = $r[1]);
				$template->assign("t3",$t3 = $r[2]);
				$template->assign("t4",$t4 = $r[3]);
				$template->assign("t5",$t5 = $r[4]);
				$template->assign("t6",$t6 = $r[5]);
				$template->assign("t7",$t7 = $r[6]);
				$template->assign("t8",$t8 = $r[7]);
				$template->assign("t9",$t9 = $r[8]);
				$template->assign("t10",$t10 = $r[9]);
				$template->assign("t11",$t11 = $r[10]);
				$template->assign("t12",$t12 = $r[11]);
				$template->assign("t13",$t13 = $r[12]);	
				$template->assign("t14",$t14 = $r[13]);	
				$template->assign("t15",$t15 = $r[14]);	
				$template->assign("t16",$t16 = $r[15]);
				$template->assign("t17",$t17 = $r[16]);
				$template->assign("t18",$t18 = $r[17]);
				$template->assign("t19",$t19 = $r[18]);	
				$template->assign("t20",$t20 = $r[19]);	
				$template->assign("t21",$t21 = $r[20]);
				$template->assign("t22",$t22 = $r[21]);	
				$template->assign("t23",$t23 = $r[22]);
				
			}
			//echo '</tr>';
			$template->parse("main.block_fileht");
			if (isset($_POST['luulai']))
			{   
			 
			$sql = " INSERT INTO ghtk2
			set  t1 = '$t1',t2 = '$t2',t3 = '$t3', t4 = '$t4', t5 = '$t5', t6 = '$t6', t7 = '$t7', t8 = '$t8', t9 = '$t9', t10 = '$t10', t11 = '$t11', t12 = '$t12', t13 = '$t13',
				 t14 = '$t14', t15 = '$t15', t16 = '$t16', t17 = '$t17', t18 = '$t18', t19 = '$t19', t20 = '$t20', t21 = '$t21', t22 = '$t22', t23 = '$t23' ";
			$data->query($sql); 
			} 
			if (isset($_POST['luulai']) )  $template->assign("daluu","Đã Lấy Xong !!!" );
			/*if (isset($_POST['luulai2']) )
			{   
			 
			$sql = " INSERT INTO ghtk2
			set  t1 = '$t1',t2 = '$t2',t3 = '$t3', t4 = '$t4', t5 = '$t5', t6 = '$t6', t7 = '$t7', t8 = '$t8', t9 = '$t9', t10 = '$t10', t11 = '$t11', t12 = '$t12', t13 = '$t13',
				 t14 = '$t14', t15 = '$t15', t16 = '$t16', t17 = '$t17', t18 = '$t18', t19 = '$t19', t20 = '$t20', t21 = '$t21', t22 = '$t22', t23 = '$t23' ";
			$data->query($sql); 
			}*/
		}
		//echo '</table>';
	} else {
		echo SimpleXLSX::parseError();
		}
	}	
	$sqltach = "SELECT T2,T22 FROM ghtk1";
	$result = $data->query($sqltach);
	while ($rows = $data->fetch_array($result)) {
		//echo $rows["T2"];
		$arr = (explode('.', $rows["T2"]));
		//echo $arr[4];
		$mavandon = $arr[count($arr) - 1];
		$sotien = $rows["T22"];
		//$ghtk[] = array("T2"=>$mavandon,"T22"=>$sotien);
		$ghtk[] = array($mavandon,$sotien);
		//if ($mavandon = intval("941539237")) { echo $mavandon."-".$sotien."</br>"; 
		//}
	}
	$sqldc = "SELECT T3,T10 FROM ghtk2";
	$result = $data->query($sqldc);
	while ($row = $data->fetch_array($result)) {
		if ($row["T3"]===$row["T3"]) {
		$mavandondc = $row["T3"];
		$sotiendc = intval($row["T10"]);
		//$doichieu[] = array("T3"=>$mavandondc,"T10"=>$sotiendc);
		$doichieu[] = array($mavandondc,$sotiendc);
		}
		
	}	
	
$tam=[];
	//if ($mavandon == $mavandondc) { }
foreach($ghtk as $key => $value){
echo "ma1:".$value[0]."<br/>";
	foreach($doichieu as $k => $v){
	echo "ma2:".$v[0]."<br/>";
		if((int)($value[0])==(int)($v[0])){
		
			array_push($tam,$value);
		}
	}
	
}	
print_r($tam);
/*$so_dong=count($mang_2);
for($i=0;$i<$so_dong;$i++)
{ echo “<br>Dòng $i: ”;
foreach ($mang_2[$i] as $key=>$gia_tri)
echo " $key=>$gia_tri ";
}*/
//$kq = array_diff($ghtk, $doichieu);
//print_r($kq);

	//$kq = !empty(array_intersect($ghtk, $doichieu));	
	echo "<pre>";
	//print_r($ghtk);
	//print_r($doichieu);
	//print_r($kq);
	echo "</pre>";
?>