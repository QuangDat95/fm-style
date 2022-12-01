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

// echo $tencuahang;
if ($tencuahang != "") {
  $sql = "SELECT d.sotien,p.NgayNhap,n.vc,p.idkho,c.Name,c.macuahang, 
  sum(ceil(p.DonGia*(1-1*p.chietkhau/100))*p.SoLuong) as tongtien , 
  sum(CASE WHEN (p.lydo>45) THEN (ceil(p.DonGia*(1-1*p.chietkhau/100))*p.SoLuong) end) as tienonline  
  from phieubanhangluu p  
  left join cuahang c on p.IDKho=c.ID 
  left join doanhthukhoan d on p.IDKho = d.idcuahang 
  left join (select m.idkho,sum(m.tigia) as vc from phieunhapxuat m where m.Loai in (1,3,5) and m.dakhoa =1 and DATE_FORMAT(m.NgayNhap,'%c%y') = DATE_FORMAT('$thang','%c%y')
  GROUP BY m.idkho ) n on p.idkho=n.idkho
  WHERE p.idkho=$tencuahang and p.Loai in (1,3,5) and p.dakhoa =1 
  and DATE_FORMAT(p.NgayNhap,'%c%y') = DATE_FORMAT('$thang','%c%y')
  and DATE_FORMAT(d.thangnam,'%c%y') = DATE_FORMAT('$thang','%c%y')
  GROUP BY p.NgayNhap 
  ORDER BY p.NgayNhap";
  echo $sql;
  $result = $data->query($sql);
  $chitieucuahang = [];
  while ($res = $data->fetch_array($result)) {
    $tongchitieu = (int) $res['Sotien'];
    $tongchitieuhienco = (int) $res['datduoc'];
    $songay = (int) date("d", strtotime($res['NgayNhap']));
    // echo $songay;
    $mangtam = array($songay => [$res['NgayNhap'], (int) $res['tongtien']]);

    $chitieucuahang += $mangtam;
    $chitieucandat = (int) $res['sotien'];
  }
  // var_dump($chitieucuahang);
  // echo $tongchitieu. "==========" . $tongchitieuhienco;


  $songay1thang = (int) date("t", strtotime($thang));
  if (date("m", strtotime($thang)) != date("m")) {
    $songayhientai = (int) date("t", strtotime($thang));
  } else {
    $songayhientai = (int) date("d");
  }

  $thanghientai = date("m", strtotime($thang));
  $mangdulieu = array(["Ngày","Chỉ tiêu đã đạt","Chỉ tiêu hằng ngày"]);
  // var_dump($mangdulieu);
  for ($i = 1; $i <= $songay1thang; $i++) {
    $mangdulieu = array_merge($mangdulieu, array($i => ["Ngày $i",0,0]));

    // $chitieungay = round($tongchitieu / $songay1thang);
    // $chitieungayhienco = round($tongchitieuhienco / $songayhientai);
    if (is_array($chitieucuahang[$i])) {
      $mangdulieu[$i][1] = $chitieucuahang[$i][1];
      $mangdulieu[$i][2] = round($chitieucandat/$songay1thang);
    } else {
      $mangdulieu[$i][2] = round($chitieucandat/$songay1thang);
    }
  }
  // echo "<pre>";
  // var_dump($mangdulieu);
  // echo "</pre>";
  $mangdulieu = json_encode($mangdulieu, JSON_UNESCAPED_UNICODE);
  // echo $mangdulieu;
?>
  <!-- <div style=" overflow:auto;width:99%;height:134px" class="col-md-6"> -->
  <div class="row" id="chart_detail_store">
    <div class="col-md-12 chartBox">
      <!-- <button id="change-chart">Change to Classic</button>
      <br><br> -->
      <div id="areachart" style="width: 800px; height: 500px;"></div>
    </div>
  </div>

  <!-- <div class="row">
    <div class="col-md-12 chartBoxhinhsin">
      <div id="piechart_3d" style="width: 1400px; height: 500px;"></div>
    </div>

  </div>
  <div class="row">

    <div class="col-md-12 chartBoxhinhtron">
      <div id="hinhtron" style="width: 1400px; height: 500px;"></div>
    </div>
  </div> -->
  <!-- </div> -->
  <script type="text/javascript" language="javascript" id="dulieucuahang2">

    google.charts.load('current', {
      'packages': ['corechart']
    });
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
      var vung = '<?php echo $mangdulieu ?>';
      // console.log(vung);
      vung = JSON.parse(vung);
      var data = google.visualization.arrayToDataTable(vung);

      var options = {
        title: 'Doanh Thu Khoán',
        width: 1400,
        hAxis: {
          title: 'Ngày',
          titleTextStyle: {
            color: '#333002'
          }
        },
        vAxis: {
          title: "Chỉ tiêu",
          // minValue: 0
        }
      };

      var chart = new google.visualization.AreaChart(document.getElementById('areachart'));
      chart.draw(data, options);
    }
  </script>

<?php
}
//==============================================================	
$data->closedata();
?>