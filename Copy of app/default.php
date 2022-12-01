<?php

session_start();
define("lc", false);
 // session_unset(); 
// echo "<a href ='http://smax.ovn.vn' >vui long truy cap smax.ovn.vn</a>";
 // return ;
define("IN_SITE", "guest");
$_SESSION["root_path"] = getcwd()."/"  ;
$page_col = 4;
$page_row = 10;
$root_path = $_SESSION["root_path"] ;

include_once($root_path."includes/config.php");
include_once($root_path."includes/removeUnicode.php");
include_once($root_path."includes/class.template7.php");
include_once($root_path."includes/class.paging.php");
include_once($root_path."includes/class.mysql.php");
//include_once($root_path."includes/editor_config.php");
include_once($root_path."includes/function.php");
include_once($root_path."includes/function_local.php");
//====================================================
 
 $_SESSION["root_pathtm"] ='/'. str_replace("\\","",strrchr(getcwd(),"\\")) ;;
// =================================================
 
$ngayng = '1';
$ngayth = '10';
$ngayna = '19';

$hethongng = gmdate('d', time() + 3600*7) ;
$hethongth = gmdate('m', time() + 3600*7) ;
$hethongna = gmdate('y', time() + 3600*7) ;

 

if ($ngayng != "")
{ 
	//if(   $ngayth < $hethongth   ){ echo "Đã hết hạn sử dụng phần mềm xin liên Công ty để tiếp tục !!!" ;return;}
}	//2609078681
  $sous1 = substr($dswf,2,2)-9;
  $sous2 = substr($dswf,6,2)-8;
  $sous3 = substr($dswf,0,2);
  $sous4 = substr($dswf,4,2);
  $sous5 = substr($dswf,8,2);  
  $sous  =  $sous1.$sous2 ;
  if ($sous3 != "26" || $sous4 != "07" || $sous5 != "81")
  {
	  $_SESSION["souser"] = "0" ;	
  } else  $_SESSION["souser"] = $sous;


$data = new class_mysql();
$data->config();
  
$data->access();
$paging = new paging();
$_SESSION['data']= $data ;
 // set_cookie("member_id" , 44 , 1);
 // echo get_cookie('member_id') ;

 error_reporting(E_ALL ^ E_NOTICE);
$ktb = $_REQUEST["act"];

 //echo $sous ."---".kiemtrasoluongus($_SESSION["souser"]) ;

 if ($_SESSION["member_dinhdanh"] ==''&& $_SESSION["LoginID"] !="")
{
	$giay = gmdate('s',time())+11;  
	$phut = gmdate('i',time())+ 11 ;
	$ran = round(laso(microtime()*10000)) + rand(1000,9999) ; 
	$masotudong =  "VTT".gmdate('y',time()).gmdate('n',time()). gmdate('d',time())."_".$ran.gmdate('H',time())     ;
	
   set_cookie("member_dinhdanh" , "$masotudong" , 1);
   $_SESSION["member_dinhdanh"] =$masotudong;
   

}

 
if ($ktb=="Exit") { $_SESSION["dangnhap"] = "" ;
   set_cookie("member_id" , "" , 1);
    set_cookie("member_pa" , "" , 1);
	set_cookie("member_ten" , "" , 1);
	 
} 
 

if(isset($_POST["btnLogin"]) )
{
        $UserName =  $_POST["txtUserName"]  ;
		$password = md5($_POST["txtPassword"]);	
    set_cookie("member_id" ,$UserName , 1);
    set_cookie("member_pa" , $password , 1);
	set_cookie("member_ten" , $_SESSION["TenUser"]  , 1);
//	echo  $_SESSION["LoginID"] ."22222"; return ;
    set_cookie("member_LoginID" , $_SESSION["LoginID"]   , 1);
	set_cookie("member_kho" , $_SESSION["lg_kho"]   , 1);
}
		 
//echo $_SERVER["REMOTE_ADDR"] ; lay ip cua may dang nhap
  


?>

<?php include_once($root_path."source/index.php"); ?>