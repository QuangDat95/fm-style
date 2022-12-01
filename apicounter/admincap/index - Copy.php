<?php
session_start();
define("lc", false);
 // session_unset(); 
define("IN_SITE", "guest");
$_SESSION["root_path"] = getcwd()."/"  ;
$page_col = 4;
$page_row = 10;
$root_path = $_SESSION["root_path"] ;

//include_once($root_path."includes/config.php");
#include_once($root_path."includes/removeUnicode.php");
include_once($root_path."includes/class.template7.php");
#include_once($root_path."includes/class.paging.php");
//include_once($root_path."includes/class.mysql.php");
//include_once($root_path."includes/editor_config.php");
#include_once($root_path."includes/function.php");
#include_once($root_path."includes/function_local.php");
include_once($root_path."includes/handlers.php");


//====================================================
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">  
  <title>Admin Office | HR Manager System</title>
<?php require_once("templates/header.tpl"); ?>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
<?php 
 if (!defined("IN_SITE")){ die('Hacking attempt!'); }
 $template = new template($root_path."templates/index.tpl");
 if (empty($_REQUEST["act"])) { 
 	$template->assign_file("file_include", $root_path."templates/dangnhap/dangnhap.tpl");
	include($root_path."source/dangnhap/dangnhap.php");
 } else {
$template->assign_file("navbar", $root_path."templates/navbar_office.tpl");
$template->assign("hovaten",$_SESSION['user']["fullname"]);
$template->assign("uid",$_SESSION['user']["uid"]);
$uid = $_SESSION['user']["uid"];
$maphongban = $_SESSION['user']["department"];
//$idpb = $_SESSION['user']["department"];
#$template->assign("maphongban",$maphongban);
#$tenphongban = danhsachtenphongban($maphongban); 	
#$template -> assign("tenphongban", $tenphongban[0]["Name"]);

//load menu
if (($_SESSION['user']["userLevel"] == "SYSADMIN") || ($_SESSION['user']["userLevel"] == "SUPERUSER")){
//require_once("templates/hrm/navbar_qlns.tpl");

$template->assign("menu_taonhanh",'<a href="?act=daotao&add=new" class="dropdown-item"><i class="fas fa-file mr-2"></i>Tạo khoá đào tạo</a>');
// Sidebar -->
include($root_path."source/menu_manager.php");
 
 } 
 if (($_SESSION['user']["userLevel"] == "HR") || ($_SESSION['user']["userLevel"] == "USER")) { 		
	// Sidebar -->
	include($root_path."source/menu_user.php");
 }

 
	
   switch($_REQUEST["act"])
	{
	    case "dashboard":
			$template->assign_file("file_include", $root_path."templates/dashboard.tpl");			
			include($root_path."source/dashboard.php");
		break;
		case "load":
			$template->assign_file("file_include", $root_path."templates/nhanvien/get_nhanvien_all.tpl");
			include($root_path."source/nhanvien/get_list_employee.php");
		break;
		
		case "suatan":
			switch($_REQUEST["dangky"])
				{
					/*case "tatca":											
						$template->assign_file("file_include", $root_path."templates/dangky/list_meal.tpl");
						include($root_path."source/dangky/list_meal.php");
						//$template->assign_file("file_include", $root_path."templates/dangky/suatan.tpl");
					break;*/
					case "phongban":											
						$template->assign_file("file_include", $root_path."templates/dangky/phongban.tpl");
						include($root_path."source/dangky/phongban.php");
						//$template->assign_file("file_include", $root_path."templates/dangky/suatan.tpl");
					break;
					case "phongbandattruoc":
						$template->assign_file("file_include", $root_path."templates/dangky/phongbandattruoc.tpl");
						include($root_path."source/dangky/phongbandattruoc.php");
					break;
					default:
						echo '<div class="alert-box warning"><span>warning: </span>Không tìm thấy.</div>';
					break;
				}
			
				//include($root_path."source/nhansu/hopdong.php");
				
			break;
		case "baocao":
			$template->assign_file("file_include", $root_path."templates/dangky/baocao.tpl");
			include($root_path."source/dangky/baocao.php");
		break;
		
		case "quanlykhuvuc":
			$template->assign_file("file_include", $root_path."templates/dangky/quanlykhuvuc.tpl");
			include($root_path."source/dangky/quanlykhuvuc.php");
		break;
			case "chiasuatan":
			$template->assign_file("file_include", $root_path."templates/dangky/chiasuatan.tpl");
			include($root_path."source/dangky/chiasuatan.php");
		break;
			case "chiasuatdattruoc":
			$template->assign_file("file_include", $root_path."templates/dangky/chiasuatdattruoc.tpl");
			include($root_path."source/dangky/chiasuatdattruoc.php");
		break;
		case "user":			
			switch($_REQUEST["action"]) {	
				case "info":	 
					$template->assign("thongbao","<span>Đang xây dựng!</span></div>");	
				break;
				case "password":	
					$template->assign("thongbao","<span>Đang xây dựng!</span></div>");	
				break;
				case "logout":	 
					logout(); redirect("index.php");
				break;	
				default:
				//echo "<div class='error' align='center'><span>Thông báo:</span> Không tìm thấy!</div>";
				$template->assign("thongbao","<span>Không tìm thấy!</span></div>");		
				break;
			}			
		break;
		
		default:
			//echo '<div class="alert-box warning"><span>warning: </span>Không tìm thấy.</div>';
			$template->assign("thongbao","<span>Không tìm thấy!</span></div>");			
			break;
	} 
  
}
?>
  
</div>
<!-- ./wrapper -->
<?php require_once("templates/plugin.tpl"); ?>

<!-- AdminLTE App -->
<script src="js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<!--<script src="js/demo.js"></script>-->
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<!--<script src="js/pages/dashboard.js"></script> -->
<?php
$template->parse("main");
$template->out("main");
?>
</body>
</html>

