<?php
session_start();
//if ($_SESSION["LoginID"] == "") return;
$root_path = getcwd() . "/";
include($root_path . "biensession.php");
include($root_path . "includes/config.php");
include($root_path . "includes/removeUnicode.php");
include($root_path . "includes/class.paging.php");
include($root_path . "includes/class.mysql.php");
include($root_path . "includes/function.php");
include($root_path . "includes/function_local.php");
include($root_path . "excel/simplexlsx.class.php");
$idk = laso($_SESSION["LoginID"]);
$idkho =$_SESSION["se_kho"];
$path = $root_path."data/SAOKETK".'-'.$idk.'-'.$idkho.".xlsx" ;

$xlsx = new SimpleXLSX($path);
$sheets=$xlsx->rows();
//đọc dữ liệu
$rows_begin =2 ;
$rows_end = count($sheets);

//if ($idk == 0) return;

$data = new class_mysql();
$data->config();
$data->access();
$updated = false;

		$mangthuchi=checktienthuchi();
		$mangcuahang = checktienthuchicuahang();
		$chuoikt='CT DEN:797820837636 ICB;108872511486;VO THI NHAT HA chuyen khoanchBMT20HD2003';
		$kiemtrachuoi = kiemtrachuoimang($chuoikt,$mangcuahang,$mangthuchi,"325000");
		var_dump($kiemtrachuoi);
		return;
// if (isset($_POST['DATA'])) {
// 	$_SESSION['sodongloi'] = 0;
// 	$_SESSION['sodongxacnhan'] = 0;
// 	$data1 = $_POST['DATA'];
// 	$tmp = explode('*@!', $data1);
// 	$checkcol = true;
// 	include($root_path . "pancakeinsertexel.php");
// 	if (!$checkcol) {
// 		$baocot = '<p style="red">Số cột tải lên không đúng định dạng mẫu! vui lòng kiểm tra lại dữ liệu! số cột = 105</p>';
// 	}
// 	unset($_SESSION['checkgiamgia']);
// }




// $sql = "select * from tailendatapancake";

// $query = $data->query($sql);
// $sheetss = array();

// while ($r = $data->fetch_array($query)) {

// 	array_push($sheetss, $r);
// }

?>
<div style="overflow:scroll;height:300px">
	<?php
	echo $baocot;
	?>
	<strong style="color:#F90">Đọc dữ liệu từ dòng ... của file Excel</strong> <br />
	<table id="tbex" width="100%" border="0" cellpadding="0" cellspacing="0" style="background:#FFF;" class="tbchuan">
		<tr bgcolor="#F8E4CB">
			<td align="center" height="23" width="35"><b>STT</b></td>
			<td align="center" height="23" width="43"><b>T1</b></td>
			<td width="98" align="center"><strong>T2</strong></td>
			<td width="72" align="center"><strong>T3</strong></td>
			<td width="72" align="center"><strong>T4</strong></td>
			<td width="72" align="center"><strong>T5</strong></td>
			<td width="72" align="center"><strong>T6</strong></td>
		</tr>
		<?php
		
		$stt = 0;
		$mangthuchi=checktienthuchi();

		$mangcuahang = checktienthuchicuahang();
		
		foreach ($sheets as $k => $r) 
		{
			
			$mauchu = "green";
			$kiemtrachuoi = kiemtrachuoimang($r[2],$mangcuahang,$mangthuchi,$r[3]);
				if(!$kiemtrachuoi){
					$mauchu = 'red';
				}
				$stt++;
				
				?>
						<tr style="color:<?php echo $mauchu; ?>">
						<td align="right"><?php echo $stt; ?></td>
						<td align="left"><?php echo $r[0]; ?></td>
						<td align="left"><?php echo $r[1]; ?></td>
						<td align="left"><?php echo $r[2]; ?></td>
						<td align="left"><?php echo $r[3]; ?></td>
						<td align="left"><?php echo $r[4]; ?></td>
						<td align="left"><?php echo $r[5]; ?></td>
						</tr>
				<?php
					}
				?>
	</table>


</div>

<?php



$data->closedata();

function kiemtrachuoimang($t1,$mangcuahang,$mangthuchi,$t2) {
	
	$result = false;
	$vitri ='';
	
	
	foreach ($mangcuahang as $key => $value) {
		if($t1 && $value['macuahang']){
		 if (strpos($t1,$value['macuahang']) !== false) {
				$result = strpos($t1,$value['macuahang']);
				
				if($result){
					$vitri = substr($t1 ,$result,$result+4);
				
					//$vitri = explode("-",$vitri);
					
					$tamvitri =trim(substr($t1,$result+4,strlen($t1)));
					$tam='';
					for($i=0;$i<strlen($tamvitri);$i++){
							if($tamvitri[$i] && $tamvitri[$i]!=" "){
								$tam.=$tamvitri[$i];
							}
							else{
								break;
							}
							
					}
					echo $tamvitri;
					if($vitri){
						//return $mangthuchi;
						foreach($mangthuchi as $k => $v){
										
								if($v['chuoi']==$vitri[1]){
								
									if($v['psco']==$t2){
										echo $t2;
										$result=  true;
									}else{
										$result = false;
									}
								}else{
									$result= false;
								}
								if($result){
									return $result;
								}
							
						}
					}
					
				}
				
			}
		}
		
		if($result){
				return $result;
			}
	}
	
	
	
	return $result;
}




function checktienthuchi(){
global $data;
$sql = "select ID,hdbh,SUBSTRING_INDEX(hdbh,'.',-1)as chuoi,psco from thuchikt where (sotknh !=0) and DAY(ngaythuchi) < DAY(ngaythuchi)< DATE(NOW()-INTERVAL 2 DAY)  ";

$result = $data->query($sql);
$categories = array();
while ($row = $data->fetch_array($result)){
    $categories[$row['ID']] = $row;
}
return $categories;

}
function tienthuchi($vitri){
global $data;
$sql = "select mid(T3,LENGTH('$vitri'),LENGTH(T3))as cat from tailendatapancake  ";
// echo $sql;
$query=$data->query($sql);
$row = $data->fetch_array($query);
return $row["cat"];
}
function checktienthuchicuahang(){
	global $data;
	$sql = "select ID,macuahang,mid(macuahang,4,LENGTH(macuahang))as cat from cuahang  ";
	
	$result = $data->query($sql);
	$categories = array();
	while ($row = $data->fetch_array($result)){
		$categories[$row['ID']] = $row;
	}
	return $categories;
	
	}










?>