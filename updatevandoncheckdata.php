<?php  
session_start();
 $quyen= $_SESSION["quyen"] ; 
if ($_SESSION["LoginID"]=="") return ;
$ql =$quyen[$_SESSION["mangquyenid"][$_SESSION['act']]]  ;
$root_path =getcwd()."/"  ;
include($root_path."biensession.php");
include($root_path."includes/config.php");
include($root_path."includes/removeUnicode.php");
include($root_path."includes/class.paging.php");
include($root_path."includes/class.mysql.php");
include($root_path."includes/function.php");
include($root_path."includes/function_local.php");
include( $root_path."excel/simplexlsx.class.php");  
include( $root_path."thuchibienngayquahan.php"); 
$ngayquahanchuan=24;
$ngayquahanchophep=$ngayquahanchophep;
$cuahangchophep=explode(",",$cuahangchophep);
 //$path = $root_path."data/maubanhangpancake.xlsx"  ; 
    
$idk = laso($_SESSION["LoginID"]) ; if ($idk == 0) return ;
  $idkho = $_SESSION["se_kho"] ; 
  
$data = new class_mysql();
$data->config();
$data->access();
$updated =false;

$tm = $_SESSION["root_path"] ;
//đọc dữ liệu

$path = $root_path."data/updatevd".'-'.$idk.'-'.$idkho.".xlsx" ;
$xlsx = new SimpleXLSX($path);
$sheets=$xlsx->rows();
$rows_begin = 1;
$rows_end = count($sheets);
$tam=[];
if ($rows_end >= 600) $rows_end = 600;
list($cols,) = $xlsx->dimension();

	$data1 = $_POST['DATA']; 
	$tmp = explode('*@!',$data1);
	$tudong=laso($tmp[1]);
	
	$dendong=laso($tmp[2]);
	if($tudong){
		$rows_begin =($tudong-1);
	}
	if($dendong){
		$rows_end=($dendong-1);
	}	
	
	$sott=0;
	$mangfail=[];
	$mangtrung=[];	
	$success=0;;
foreach($sheets as $k => $r) {
		$sott++;
		$checkloi=true;		
		$onclick=''; 
		$mauchu='green';
		$baoloirong='';
		$count2dong='';
		$baoloi='';
		$luachon=0;
		if (($k >= $rows_begin) && ($k <= $rows_end)) {
			if(!checksobill(trim($r[0]))){
					$mauchu='red';
					echo "Không tìm thấy số bill dòng ".$k;	
					$loi=true;
					$checkloi=false;
			}
			
			$trunglap=checktrunglap($sheets,$k,trim($r[0]));
			$tamcheck=false;
			if(in_array(trim($r[0]),$mangtrung)){
				echo "Trùng số bill dòng ".$k;	
				$mauchu='red';
					$loi=true;
					$checkloi=false;
			}
			else{
				$tamcheck=true;
			}
			if($trunglap['sodong']>0){
				$mauchu='red';
				array_push($mangtrung,trim($r[0]));
				
					echo "Trùng số bill dòng ".$k;	
					$loi=true;
					$checkloi=false;
			}else{
				$tamcheck=true;
			}
			
			$sql="update vanchuyenonline set madh='$r[1]',mavd='$r[2]',trigiadon='$r[3]',tongtien='$r[4]',phithukh='$r[5]',donvivc='$r[6]',diachi='$r[7]',tinh='$r[8]',quan='$r[9]',phuong='$r[10]' where sobill='$r[0]'";
			
			$update=$data->query($sql);
			if($update){
				$success++;
			}
			else{
					array_push($mangfail,$k);
			}
			
	}
}
echo "###thành công $success dòng! thất bại ".count($mangfail)." dòng";
if(count($mangfile)){
	foreach($mangfile as $key -> $value){
		echo "###Dòng thất bại ".count($value)." dòng";
	}
	
}


 $data->closedata() ;
function checktrunglap($sheettam,$k,$bill){
	$checkcount=0;
		for($i=$k+1;$i<=count($sheettam);$i++){
			
			if($sheettam[$i][0]==$bill){
				$checkcount++;
			}
		}
		
	return array("sodong"=>$checkcount);
}

function checksobill($soct){
$soct=trim($soct);

$sql="select ID from phieunhapxuat where SoCT='$soct'";
//echo $sql;
global $data;
$dong=getdong($sql);
if($dong['ID']){
		return $dong;
	}
	else{
		return false;
	}

}

function CheckVanChuyen($sobill)
{
global  $data;
    $sql = "SELECT ID,IDbill, mavd, sobill, madh, diachi, tinh, quan, phuong,trigiadon,phitravc,tongtien,donvivc from vanchuyenonline where sobill ='$sobill'";
  //   echo $sql;
    $tam = getdong($sql);
	//var_dump($tam);
    return $tam;

}
?>	