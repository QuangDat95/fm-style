<?php
session_start();
error_reporting(0);
$id = $_SESSION["LoginID"];
if ($id == "") return;
$root_path = getcwd() . "/";
include($root_path . "biensession.php");
include($root_path . "includes/config.php");
include($root_path . "includes/removeUnicode.php");
include($root_path . "includes/class.paging.php");
include($root_path . "includes/class.mysql.php");
include($root_path . "includes/function.php");
include($root_path . "includes/function_local.php");



$data = new class_mysql();
$data->config();
$data->access();

$data1 = $_POST['DATA'];
$tmp = explode('*@!', $data1);

$ten   =  ($tmp[0]);
$ma = trim($tmp[1]);
$nhom = laso($tmp[2]);
$kho = trim($tmp[3]);
$tu = trim($tmp[4]);
$den = trim($tmp[5]);
$trang = laso($tmp[6]);
$IDNV = laso($tmp[7]);
$loai = laso($tmp[8]);
$ch = '';
$sql_where = " where dakhoa =1 ";

if ($ten != "") 	$sql_where .= " and d.Name  like '%" . $ten . "%'";
if ($ma != "")	    $sql_where .= " and d.codepro like '%" . $ma . "%'";
if ($nhom > 0) {
	//$sql_where.=" and c.IDGroup ='".$nhom."'";
	$nhom = $nhom . timnhom("groupproduct", "IDGroup", $nhom);
	$sql_where .= " and  d.IDGroup in ( $nhom ) ";
}
if ($kho != "") {
	$sql_where .= " and p.IDKho ='" . $kho . "'";
	$ch = " and ID = $kho";
}
if ($IDNV != "0")	$sql_where .= " and p.IDTao ='" . $IDNV . "'";
$tam = strtotime(gmdate('Y-m-d H:i:s', time() + 7 * 3600));

if ($tu != "") {
	if ($loai == 0) {
		$tu = date('d/m/Y', strtotime("-1 day", $tam));
		$den = $tu;
	} // mot ngay truoc
	if ($loai == 3) {
		$tu = date('d/m/Y', strtotime("-3 day", $tam));
		$den = date('d/m/Y', strtotime("-1 day", $tam));
	} // mot ngay truoc
	if ($loai == 4) {
		$tu = date('d/m/Y', strtotime("-7 day", $tam));
		$den = date('d/m/Y', strtotime("-1 day", $tam));
	} // mot tuan truoc
	if ($loai == 5) {
		$thang = gmdate("m/Y", strtotime("-1 months") + 7 * 3600);
		$tu  = "01/" . $thang;
		$den = date('d/m/Y', strtotime("-1 day", strtotime(gmdate('Y-n-01', time() + 7 * 3600))));
	} // mot thang truoc


	$ngay =  explode('/', $tu);


	if (strlen($ngay[1]) == 1) {
		$ngay[1] = "0" . $ngay[1];
	}
	if (strlen($ngay[0]) == 1) {
		$ngay[0] = "0" . $ngay[0];
	}
	$sql_where .= " and  p.NgayNhap >= '$ngay[2]-$ngay[1]-$ngay[0]'";
}
if ($den != "") {
	$ngay =  explode('/', $den);
	if (strlen($ngay[1]) == 1) {
		$ngay[1] = "0" . $ngay[1];
	}
	if (strlen($ngay[0]) == 1) {
		$ngay[0] = "0" . $ngay[0];
	}
	$sql_where .= " and  p.NgayNhap <= '$ngay[2]-$ngay[1]-$ngay[0]'";
}

$r = 1;

$sql = "SELECT DATE_FORMAT(p.NgayNhap,'%d/%m/%Y') as NgayNhap ,c.ID,a.Ten,c.Name,c.macuahang,x.IDSP,sum(x.SoLuong) as sl,sum(x.DonGia*(1-1*x.chietkhau/100)*x.SoLuong) as tongtien from  
        userac a 
		inner join  phieubanhangluu p on p.IDTao = a.ID
		left join   cuahang c on p.IDKho=c.ID  inner join 
        xuatbanhang x on p.ID = x.IDPhieu  left join products d on x.IDSP = d.ID	$sql_where ";
if ($loai == 1 || $loai == 0 || $loai == 3 || $loai == 4 || $loai == 5) $sql .= "  group by p.IDKho order by tongtien desc";
elseif ($loai == 2) $sql .= "  group by p.IDKho,p.NgayNhap order by p.NgayNhap";
// mot ngay truoc 
else  $sql .= "  group by a.ID ";

// echo $sql;

if ($_SESSION["admintuan"])	echo $sql;

//========================================================
if (!is_numeric($trang)) $trang = 1;
if ($trang * 1  <= 0) $trang = 1;
$result = $data->query($sql);
$num = $data->num_rows($result);
$pagesize = 1000;
if ($trang == '') $trang = 1;

if ($num > $pagesize) {
	if ($trang != '') {
		$paging_two = ($trang - 1) * $pagesize;
		$sql .=  " LIMIT " . $paging_two . ", " . $pagesize;
		$result = $data->query($sql);

		for ($i = 1; $i < ($num / $pagesize) + 1; $i++) {
			if ($i == $trang) {
				$pt = $pt . " &nbsp;" . "  <label style=\"color:#FF0000\">$i</label> ";
			} else {
				$pt = $pt . " &nbsp;" . "<a style='cursor:pointer' onclick=\"timkiemkh('$tmp[0]','$tmp[1]','$tmp[2]','$tmp[3]','$tmp[4]','$i')\"  > $i </a> ";
			}
		}
	}
}
$r = $pagesize * $trang - $pagesize + 1;
//==============================================================	

$mangch = taomang("cuahang", "ID", "Name", $where = " where ID >1 $ch   ");

$mangtd[1] = "Ngày ";

// $mangch[1]="Ngày";
foreach ($mangch as $key => $value) {
	$mangtd[$key] =  $value;
}



?>

<script type="text/javascript" language="javascript" id="dulieu">
	function drawChart() {

		var data = google.visualization.arrayToDataTable([
			["Element", "Doanh Thu", {
				role: "style"
			}],
			<?php
			$mau[1] = "#3B7CC8";
			$mau[2] = "#c83bad";
			$mau[3] = "#c85f3b";
			$mau[4] = "#c8bb3b";
			$mau[5] = "#a3c83b";
			$mau[6] = "#72c83b";
			$mau[7] = "#3bc83d";
			$mau[8] = "#3bc876";
			$mau[9] = "#3bc8a8";
			$mau[10] = "#3b9ac8";
			$mau[11] = "#3b5ac8";
			$mau[12] = "#5c3bc8";
			$mau[13] = "#953bc8";
			$mau[14] = "#c83bbb";
			$mau[15] = "#c83b7b";
			$mau[16] = "#c83b50";
			$mau[17] = "#cbe309";
			$mau[18] = "#194ab2";
			$mau[19] = "#f40cc7";
			$mau[20] = "#cad60e";
			$mau[21] = "#130cf4";
			$mau[22] = "#c83b7b";
			$mau[23] = "#c83b50";
			$mau[24] = "#cbe309";
			$mau[25] = "#194ab2";
			$mau[26] = "#f40cc7";
			$mau[27] = "#cad60e";
			$mau[28] = "#130cf4";

			$tong = 0;
			$tongsl = 0;
			$i = 0;
			$dauphay = '';
			$mangbd = '';

			$mangbd[$i + 1] = $mangtd;

			$j = 1;
			while ($re = $data->fetch_array($result)) {
				$i++;
				if ($re['NgayNhap'] != $mangbd[$j][1]) {
					$j++;
				}
				$mangbd[$j][1] = $re['NgayNhap'];

				$mangbd[$j][$re['ID']] = $re['tongtien'];

				$ten = $re['Name'];
				$ma = $re['codepro'];
				$giamgia = $re['giamgia'] . "%";
				$baohanh = $re['baohanh'];
				$nhap = $re['nhap'];
				$xuat = $re['xuat'];
				$gia = number_format($re['gia']);

				$tong += $re['tongtien'];
				$tongsl += $re['sl'];
				$dvt = $re['DV'];
				if ($gia == '0.00') $gia = "";




			?>
				<?php echo $dauphay; ?>["<?php echo $re['macuahang']; ?>", <?php echo $re['tongtien']; ?>, "color: <?php echo $mau[$i]; ?>"]

			<?php
				if ($dauphay == '') $dauphay = ',';
			}

			?>, [".", 1, "color: black"]

		]);

		var view = new google.visualization.DataView(data);
		view.setColumns([0, 1,
			{
				calc: "stringify",
				sourceColumn: 1,
				type: "string",
				role: "annotation"
			},
			2
		]);

		var options = {
			title: "Biểu đồ doanh thu các cửa hàng !",
			width: 960,
			height: 550,
			bar: {
				groupWidth: "80%"
			},
			legend: {
				position: "none"
			},
		};
		var chart = new google.visualization.ColumnChart(document.getElementById("barchart_values"));
		chart.draw(view, options);




	}
</script>


<script type="text/javascript" language="javascript" id="bdt">
	function drawChart3() {
		var data = google.visualization.arrayToDataTable([


					<?php


					$dauphay = '';
					$k = 1;
					foreach ($mangbd as $key => $value) {
						//echo   $key ."===" .  $value."<br>" ;
						//	 echo   $key ."==".$mangbd[$key][1].$mangbd[$key][58]." ---<br>";


						$tam = '';
						$l = 0;
						foreach ($mangtd as $key1 => $value1) {
							if ($k == 1) $tam .= ",'$value1'";
							else {
								if ($l == 0)   $tam .= ",'" . $mangbd[$key][$key1] . "'";
								else   $tam .= ", " . laso($mangbd[$key][$key1]);
								$l = 1;
							}
						}
						$tam[0] = ' ';
						$tam = $dauphay . '[' . $tam  . ']';
						$k = 2;
						if ($dauphay == '') $dauphay = ',';
						echo $tam;
					}
					echo  "]);";
					?>



					var options = {
						title: 'Biểu đồ doanh thu cửa hàng theo ngày !',
						hAxis: {
							title: 'Ngày',
							titleTextStyle: {
								color: '#333'
							}
						},
						vAxis: {
							minValue: 0
						}
					};

					var chart3 = new google.visualization.AreaChart(document.getElementById('chart_div'));
					chart3.draw(data, options);
				}
</script>


<div style="font-size:18px;color:#00F">Tổng cộng:<strong><?php echo formatso($tong); ?></strong></div>



<div id="barchart_values" style="width: 960px; height: 650px;"></div>
<div id="chart_div" style="width: 960px; height: 550px; "></div>