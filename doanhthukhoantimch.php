<style>
  .chartBox {
    width: 630px;
    margin: 6px;
  }

  .chartBoxhinhtron {
    width: 332px;
    margin: 6px;
  }

  .chartBoxhinhsin {
    width: 740px;
    margin: 6px;
  }
</style>
<?php
session_start();
if ($_SESSION["LoginID"] == '') {
  return;
}

$root_path = getcwd() . "/";
include($root_path . "biensession.php");
include($root_path . "includes/config.php");
include($root_path . "includes/removeUnicode.php");
include($root_path . "includes/class.paging.php");
include($root_path . "includes/class.mysql.php");
include($root_path . "includes/function.php");
include($root_path . "includes/gChart.php");

$data = new class_mysql();
$data->config();
$data->access();
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
//=============================khoi tao ======================//  	 Xem  	 Them  	 Cap nhap  	 Tim  	Huy  	Khoa  	In
if (trim($_SESSION["LoginID"]) == "") {
  return;
}
$data->setdangnhap($_SESSION["LoginID"], $us);

$data->setthaotac = "khachhang";
// $sql = "select Item,FunctionID from userright where  UserID  ='$id' and FunctionID = '10' " ;
// $tam = $data->truyvan($sql);	

$cn  =  phanquyenthu($tam['Item'], "capnhap");
if ($_SESSION["loai_user"] == 6) $cn = 1;
$cn = 1;
$xoa =  phanquyenthu($tam['Item'], "xoa");

if ($_SESSION["frm_xuathang"] == "1") {
  $cn = "";
  $xoa = "";
}
$data1 = $_POST['DATA'];
$tmp = explode('*@!', $data1);
//   echo $data1 ;
$loai  = trim($tmp[0]);

$tencuahang = (trim($tmp[0]));
$thang = (trim($tmp[1]));
$khuvuc = (trim($tmp[2]));
$khuvuc = abs($khuvuc);

if ($thang == "") {
  echo "Vui lòng chọn ngày đầy đủ từ ngày tới ngày";
  return;
}

//  echo "<br>". $dt;
if ($thang != '') {
  $ngaybatdau = 1;
  $tam = date('Y-m-d', strtotime('+1 month', strtotime("$thang")));
  $ngaycuoi =  date('d', strtotime($tam . "-1 day"));
  // echo  $thang.'==='.$ngaycuoi ;
  $tungay = "$thang";
  $toingay = "$thang";
}

  $sql_where .= "  Year(a.thangnam) = Year('$tungay') and Month(a.thangnam) = Month('$tungay') ";

  $sql = " select  b.macuahang as cuahang, a.idcuahang , sum(a.sotien) as sotien , a.datduoc   from doanhthukhoan a 
INNER JOIN cuahang b ON b.ID = a.idcuahang 
where a.macuahang <> 1135 and  $sql_where  group by b.ID";

  if ($khuvuc != "") {
    $sql = " select b.macuahang as cuahang, a.idcuahang ,sum(a.sotien) as sotien, a.datduoc from doanhthukhoan a 
    INNER JOIN cuahang b ON b.ID = a.idcuahang 
    where (b.NameN = '$khuvuc') and $sql_where  group by b.ID";
  }
  echo $sql;
  $result = $data->query($sql);

  if (mysqli_num_rows($result) == 0) return;


  // if( $result === NULL) return ;
  $r = 0;
  $mangmien = [];
  $chuoibody = '';
  $chuoihedea = '';
  $tong = 0;
  $mangtong = [];
  $mangtien = [];
  $mangdatduoc = [];

  $mangtongcuahang = [];
  $manghinhtron = [];
  array_push($mangtongcuahang, ['Galaxy', 'Số Tiền', 'Đạt Được']);
  array_push($manghinhtron, ['Year', 'Số Tiền', 'Đạt Được']);
  while ($re = $data->fetch_array($result)) {
    $r++;
    $dulieu = array("idcuahang" => $re['idcuahang'],
      "macuahang" => $re['cuahang'],
      "sotien" => $re['sotien'],
      "datduoc" => $re['datduoc']
    );
    array_push($mangmien,$dulieu);
    // $mangmien[$re["cuahang"]][$re["sotien"]][$re["datduoc"]][$re['macuahang']]++;
    array_push($mangtong, $re["cuahang"]);
    array_push($mangtien, $re["sotien"]);
    array_push($mangdatduoc, $re["datduoc"]);

    array_push($mangtongcuahang, array($re["cuahang"], (int)($re["sotien"]), (int)($re["datduoc"])));
    array_push($manghinhtron, array($re["cuahang"], (int)($re["sotien"]), (int)($re["datduoc"])));
  }
  // echo "<pre>";
  // var_dump($mangmien);
  // echo "</pre>";

  for ($i=0; $i < count($mangmien); $i++) { 
    $chuoihedea .= "<td colspan='2' ><button type='button' onclick='bieudothukhoanchitiet(".$mangmien[$i]['idcuahang'].",thang.value,khuvuc.value)'>".$mangmien[$i]['macuahang']."</button></td>";
    $tong += $mangmien[$i]['sotien'];
    $chuoibody .= '<td>' . formatso($mangmien[$i]['sotien']) . '  </td>';
    $chuoibody .= '<td style="color:#0000FF">' . formatso($mangmien[$i]['datduoc']) . ' </td>';
  }
?>
  <div style=" overflow:auto;width:100%; padding: 8px 0px" class="col-md-6">
    <table width="99%" border="0" cellpadding="0" cellspacing="0" class="tbchuan">
      <tr bgcolor="#F8E4CB">
        <td colspan='2'>Cửa Hàng &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <button type="button" onclick="bieudocuahangthukhoan(tencuahang.value,thang.value,khuvuc.value)">Tất cả</button> </td>
        <?php echo $chuoihedea; ?>
        <td>Tổng Doanh Thu</td>
      </tr>
      <?php

      ?>
      <tr>
        <td>Số Tiền</td>
        <td>Đạt Được</td>
        <?php echo $chuoibody; ?>
        <td style="color:#0000FF"><?php echo formatso($tong); ?> </td>
      </tr>
      <?php
      $vungmien = json_encode($mangtong);
      //  var_dump($vungmien);
      $tongso =  json_encode($mangtien);
      $datduoc =  json_encode($mangtien);
      // var_dump($mangtongcuahang);
      $tongcuahang = json_encode($mangtongcuahang);
      $tonghinhtron = json_encode($manghinhtron);
      ?>

    </table>
  </div>
  <div id="chart_find_stores">
    <div class="row">
      <div class="col-md-12 chartBox">
        <!-- <button id="change-chart">Change to Classic</button>
      <br><br> -->
        <div id="chart_div" style="width: 800px; height: 500px;"></div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-12 chartBoxhinhsin">
        <div id="piechart_3d" style="width: 1400px; height: 500px;"></div>
      </div>

    </div>
    <div class="row">

      <div class="col-md-12 chartBoxhinhtron">
        <div id="hinhtron" style="width: 1400px; height: 500px;"></div>
      </div>
    </div>
  </div>

  <div style="padding:5px;">
    <script type="text/javascript" language="javascript" id="dulieucuahang">
      google.charts.load('current', {
        'packages': ['corechart', 'bar']
      });
      google.charts.setOnLoadCallback(drawStuff);

      function drawStuff() {
        var vung = '<?php echo $tongcuahang ?>';
        console.log(vung);
        vung = JSON.parse(vung);

        var button = document.getElementById('change-chart');
        var chartDiv = document.getElementById('chart_div');

        var data = google.visualization.arrayToDataTable(vung);

        var materialOptions = {
          width: 1400,
          chart: {
            title: 'Biểu Đồ Doanh Thu Khoán',
            subtitle: 'Biểu Đồ Doanh Thu Khoán'
          },
          series: {
            0: {
              axis: 'Số Tiền'
            }, // Bind series 0 to an axis named 'distance'.
            1: {
              axis: 'Đạt Được'
            } // Bind series 1 to an axis named 'brightness'.
          },
          axes: {
            y: {
              distance: {
                label: 'Số Tiền'
              }, // Left y-axis.
              brightness: {
                side: 'right',
                label: 'Tỉ Lệ'
              } // Right y-axis.
            }
          }

        };

        var classicOptions = {
          width: 1400,
          series: {
            0: {
              targetAxisIndex: 0
            },
            // 1: {targetAxisIndex: 1}
          },
          title: 'Biểu Đồ Doanh Thu Khoán',
          vAxes: {
            // Adds titles to each axis.
            0: {
              title: 'Số Tiền'
            },
            // 1: {title: 'Tỉ Lệ'}
          }
        };

        function drawMaterialChart() {
          var materialChart = new google.charts.Bar(chartDiv);
          materialChart.draw(data, google.charts.Bar.convertOptions(materialOptions));
          button.innerText = 'Change to Classic';
          button.onclick = drawClassicChart;
        }

        function drawClassicChart() {
          var classicChart = new google.visualization.ColumnChart(chartDiv);
          classicChart.draw(data, classicOptions);
          button.innerText = 'Change to Material';
          button.onclick = drawMaterialChart;
        }


        drawClassicChart();
      };


      google.charts.load('current', {
        'packages': ['corechart']
      });
      google.charts.setOnLoadCallback(drawLogScales);

      function drawLogScales() {
        var hinhtron = '<?php echo $tonghinhtron ?>';
        console.log(hinhtron);
        hinhtron = JSON.parse(hinhtron);
        var data = google.visualization.arrayToDataTable(hinhtron);

        var options = {
          title: 'Biểu Đồ',
          curveType: 'function',
          legend: {
            position: 'bottom'
          },

        };

        var chart = new google.visualization.LineChart(document.getElementById('piechart_3d'));

        chart.draw(data, options);
      }

      google.charts.load("current", {
        packages: ["corechart"]
      });
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var hinhtron = '<?php echo $tonghinhtron ?>';
        console.log(hinhtron);
        hinhtron = JSON.parse(hinhtron);
        var data = google.visualization.arrayToDataTable(hinhtron);

        var options = {
          title: 'Biểu Đồ Hình Tròn',
          is3D: true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('hinhtron'));
        chart.draw(data, options);
      }
    </script>
  <?php

//==============================================================	
$data->closedata();
  ?>