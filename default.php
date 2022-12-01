<?php
session_start();
define("lc", false);
// session_unset(); 
// echo "<a href ='http://smax.ovn.vn' >vui long truy cap smax.ovn.vn</a>";
// return ;
define("IN_SITE", "guest");
$_SESSION["root_path"] = getcwd() . "/";
$page_col = 4;
$page_row = 10;
$root_path = $_SESSION["root_path"];

include_once($root_path . "includes/config.php");
include_once($root_path . "includes/removeUnicode.php");
include_once($root_path . "includes/class.template7.php");
include_once($root_path . "includes/class.paging.php");
include_once($root_path . "includes/class.mysql.php");
//include_once($root_path."includes/editor_config.php");
include_once($root_path . "includes/function.php");
include_once($root_path . "includes/function_local.php");
//====================================================

$_SESSION["root_pathtm"] = '/' . str_replace("\\", "", strrchr(getcwd(), "\\"));;
// =================================================

$ngayng = '1';
$ngayth = '10';
$ngayna = '19';

$hethongng = gmdate('d', time() + 3600 * 7);
$hethongth = gmdate('m', time() + 3600 * 7);
$hethongna = gmdate('y', time() + 3600 * 7);



if ($ngayng != "") {
  //if(   $ngayth < $hethongth   ){ echo "Đã hết hạn sử dụng phần mềm xin liên Công ty để tiếp tục !!!" ;return;}
}  //2609078681
$sous1 = substr($dswf, 2, 2) - 9;
$sous2 = substr($dswf, 6, 2) - 8;
$sous3 = substr($dswf, 0, 2);
$sous4 = substr($dswf, 4, 2);
$sous5 = substr($dswf, 8, 2);
$sous  =  $sous1 . $sous2;
if ($sous3 != "26" || $sous4 != "07" || $sous5 != "81") {
  $_SESSION["souser"] = "0";
} else  $_SESSION["souser"] = $sous;


$data = new class_mysql();
$data->config();

$data->access();
$paging = new paging();
$_SESSION['data'] = $data;
// set_cookie("member_id" , 44 , 1);
// echo get_cookie('member_id') ;

error_reporting(E_ALL ^ E_NOTICE);
$ktb = $_REQUEST["act"];

//echo $sous ."---".kiemtrasoluongus($_SESSION["souser"]) ;

if ($_SESSION["member_dinhdanh"] == '' && $_SESSION["LoginID"] != "") {
  $giay = gmdate('s', time()) + 11;
  $phut = gmdate('i', time()) + 11;
  $ran = round(laso(microtime() * 10000)) + rand(1000, 9999);
  $masotudong =  "VTT" . gmdate('y', time()) . gmdate('n', time()) . gmdate('d', time()) . "_" . $ran . gmdate('H', time());

  set_cookie("member_dinhdanh", "$masotudong", 1);
  $_SESSION["member_dinhdanh"] = $masotudong;
}


if ($ktb == "Exit") {
  $_SESSION["dangnhap"] = "";
  set_cookie("member_id", "", 1);
  set_cookie("member_pa", "", 1);
  set_cookie("member_ten", "", 1);
}


if (isset($_POST["btnLogin"])) {
  $UserName =  $_POST["txtUserName"];
  $password = md5($_POST["txtPassword"]);
  set_cookie("member_id", $UserName, 1);
  set_cookie("member_pa", $password, 1);
  set_cookie("member_ten", $_SESSION["TenUser"], 1);
  //	echo  $_SESSION["LoginID"] ."22222"; return ;
  set_cookie("member_LoginID", $_SESSION["LoginID"], 1);
  set_cookie("member_kho", $_SESSION["lg_kho"], 1);
}

//echo $_SERVER["REMOTE_ADDR"] ; lay ip cua may dang nhap

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en" xml:lang="en">
<meta http-equiv="Page-Exit" content="progid:DXImageTransform.Microsoft.Fade(duration=.9)" />

<head>
  <title>Quản Lý Bán Hàng</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <link rel="stylesheet" type="text/css" href="cssm/style.css" />


  <script language="javascript">
    var id_user = "<?php echo $_SESSION["LoginID"]; ?>";
  </script>
  <script language="javascript">
    var loai_user = "<?php echo $_SESSION["loai_user"]; ?>";
  </script>
  <script language="javascript">
    var IDPhong_user = "<?php echo $_SESSION["S_IDPhong"]; ?>";
  </script>
  <?php $data->setdangnhap($_SESSION["LoginID"], $_SESSION["UserName"]); ?>

  <link href="cssm/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <link href="cssm/menumobi.css" rel="stylesheet" id="bootstrap-css">
  <script src="cssm/jquery-1.11.1.min.js"></script>
  <script src="cssm/bootstrap.min.js"></script>


  <script type="text/javascript" src="js/function.js"></script>
  <script language=JavaScript src="js/load.js"></script>
  <link type="text/css" rel="stylesheet" href="calendar/dhtmlgoodies_calendar.css?random=20051112" media="screen">
  </LINK>
  <SCRIPT type="text/javascript" src="calendar/dhtmlgoodies_calendar.js?random=20060118"></script>


</head>

<body style="width:100%;margin:0;" bgcolor="#000000">
  <div id="sound_element"></div>
  <div class="wrapper">
    <div class="header" style="background-color:#99CCFF">
      <div onclick="location.href='default.php'">
        <marquee loop="1" behavior="slide">
          <?php echo $_SESSION["member_dinhdanh"];  ?>
        </marquee>
        </font>
      </DIV>
      <DIV align="right" style="color:#FF9900;background-color:#99CCFF;height:20px">

        <?php

        $nguoidangnhap = "";

        if ($_SESSION["dangnhap"] == "admin") {
          $nguoidangnhap = " Quản trị hệ thống";
        } else {
          $nguoidangnhap = $_SESSION["TenUser"] . " (Phòng: " . $_SESSION["S_TenPhong"] . ")";
        }

        ?>
        <font size="2"> Login:<?php echo $nguoidangnhap . "  Lúc :" . $_SESSION["giodangnhap"];  ?>&nbsp; </font>
      </DIV>


      <div style="clear:left"></div>
      <?php

      // $mquyen = $_SESSION["s_quyentm"] ;
      // echo $mquyen[2]."-". kiemtraquyenthumuc(2,"xem") ;   
      // $data->setdangnhap('1234') ;
      // $data->setthaotac("123") ;
      // echo $data->getdangnhap() ;

      ?>

      <?php include_once($root_path . "source/index.php"); ?>

    </div>
  </div>



  <DIV class=footer style="background-color:#99CCFF;padding:15px"> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href="http://www.ovn.vn" style="text-decoration:none"><B style="color:#FF6600">Copyright © 2009 Việt Trực Tuyến. All rights resevered</B></a> Mobi 0983366015 &nbsp; Email:anhtuanas@gmail.com </DIV>
  <div id="hienthigoilai" style="display:none">1111</div>

  </div>

  </div>

  <video style='display:none' id='nhac' src="images/<?php echo $_SESSION["nhac"]; ?>.wav"></video>

</body>




<script type="text/javascript" src="./jquery.qrcode-master/jquery.qrcode.js"></script>

</html>

<script language="javascript">
  var timerq;

  function goilaict11(v) {
    poststr = "DATA=" + encodeURIComponent(v) + "*@!" + encodeURIComponent(0) + "*@!" + encodeURIComponent(0);
    loadtrang('hienthigoilai', "goithuongxuyen", poststr, "");
    goispbd(1);
  }

  function goispbd(v) {
    clearTimeout(timerq);
    timerq = setTimeout(function validate() {
      goilaict11(v)
    }, 70000);
  }

  goispbd(1)

  function canhbao() {
    var n = confirm("Bạn có muốn xóa không");
    if (n == false) {
      return false;

    }
  }
</script>