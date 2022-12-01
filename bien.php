<?php



	
error_reporting(E_ALL ^ E_NOTICE);
 define('thoigiancho', "15");

 define('thoigiantuonglai', "30");

 define('web', "fmstyle.vn");

$site_tc_tintuc ="images/tintuc/";
$uploadDirectoryimages="images/";
define("LOGO","LOGO");
define("INFO","INFO");
$imgEmpty='empty.jpg';
if ( $_SERVER["REMOTE_ADDR"] == "127.0.0.1") 

{ 	 

     define('lc', false);

	 define('lca', false);

	 define('dir_index', 'index.php');

	 define('cautruyvan', '?act=');

     define('duoi', '');

	  $linksite = "" ;

	  $linksitegoc = "" ;

	
  	 $linksiteicon = "images/" ;	

	 $linksitetin = "images/tintuc/" ;

	 $linksitelogo = "images/logo" ;

	 $linksitelogo2 = "images/logo" ;

	 $linksitegianhang = "images/" ;

	  $siteimg	= "http://localhost:85/websouce/";

	 $site	= "http://localhost:85/websouce/" ;
 	$siteproduct	=$site."products/" ;
	 $sitedm	=$site."products-" ;
  $sitetintuc	=$site."news/" ;
	 $email ="datdoan2011995@gmail.com";
$sitetag	=$site."tags/" ;
  

} else    

{  

 

 



   	 $linksiteicon = "images/" ;	

	 $linksitetin = "images/tintuc/" ;


     define('lc', false);

	 define('lca', false);

	 define('dir_index', 'index.php');

	 define('cautruyvan', '?act=');

     define('duoi', '');

	  $linksite = "" ;

	  $linksitegoc = "" ;

  	 $linksiteicon = "images/" ;	

	 $linksitetin = "images/tintuc/" ;

	 $linksitelogo = "images/logo" ;

	 $linksitelogo2 = "images/logo" ;

	 $linksitegianhang = "images/" ;

			  $siteimg	= "http://localhost:85/websouce/";

	 $site	= "http://localhost:85/websouce/" ;

	  $email ="datdoan2011995@gmail.com";
$siteproduct	=$site."products/" ;
  $sitetintuc	=$site."news/" ;
    $sitetag	=$site."tags/" ;
	 $sitedm	=$site."products-" ;
 }

 

 ?>