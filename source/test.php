<?php

use function PHPSTORM_META\map;

if(session_status()==PHP_SESSION_NONE) session_start();
	if (!defined("IN_SITE"))
	{
    	die('Hacking attempt!');
	}
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 <?php
 
            $conn = mysqli_connect("localhost", "root", "", "fmstyleda");
             
            $sql = "SELECT Name ,NameN,ID,IDGroup,foder,IDnhom,foder from nhomcongvan where Rank=1";
             
            $result = mysqli_query($conn, $sql);
             
            $categories = array();
  
            while ($row = mysqli_fetch_assoc($result)){
                $categories[] = $row;
             }
             
			  
			 $tam ='';

            /* BƯỚC 2: HÀM ĐỆ QUY HIỂN THỊ CATEGORIES*/
            function Testpro($categories, $parent_id = 0, $char = "")
            {
			   global  $tam   ;
                /* BƯỚC 2.1: LẤY DANH SÁCH CATE CON*/
                $cate_child = array();
                foreach ($categories as $key => $item)
                {
                    /*Nếu là chuyên mục con thì hiển thị*/
                    if ($item["IDGroup"] == $parent_id)
                    {
                        $cate_child[] = $item;
                        unset($categories[$key]);
                    }
                }
                 
                /* BƯỚC 2.2: HIỂN THỊ DANH SÁCH CHUYÊN MỤC CON NẾU CÓ*/
                if ($cate_child)
                {
                    
                    $tam .= "<ul>";
                    foreach ($cate_child as $key => $item)
                    {
                        /*Hiển thị tiêu đề chuyên mục*/
						$tam .=  "<a  href=default.php?act=test&id=".$item["ID"]."><li>".$item["Name"];
                         
                        /* Tiếp tục đệ quy để tìm chuyên mục con của chuyên mục đang lặp*/
                        Testpro($categories, $item["ID"], $char."|---");
						$tam .=  "</li></a>";
                    }
					$tam .=  "</ul>";
                }
            }
            Testpro($categories);
		
			$template->assign("item",$tam);



  /* Tiếp tục đệ quy để tìm chuyên mục con của chuyên mục đang lặp*/

  ///////////////id
  
  ///////////////id
  
  
  
  
    if ($_POST["cancel"]  ?? "")
    {
        $ID = "" ;
        $_GET["id"] ="" ;
    } 


  
  if ($_REQUEST["id"] == "-1")
  { 
     $template->assign("t-c","Thêm mới  " );
     $template->assign("idgoi",$_POST["id"]);
      $template->assign("congvan",composx("files","Name",$result["ID"],""));

  }
  	else		
  {
      $sql =" SELECT a.ID,a.Name as Name ,a.ma as ma ,a.foder as foder ,
      a.img as img ,b.files as files,b.ID as bid ,b.idcha as idcha ,
       b.ngaytao as ngaytao , b.mota as mota , b.idsua as idsua , b.idtao as idtao,b.quyen as quyen
      FROM nhomcongvan as a left join congvan as b 
      on a.ID = b.idcha WHERE a.ID='".$_REQUEST["id"]."'";
      
      $query = $data->query($sql);
      while ( $result = $data->fetch_array($query)){
        $template->assign("Name",$result["Name"]);	
           $template->assign("ID",$result["ID"]);
           $template->assign("ma",$result["ma"]);
           $template->assign("quyen",$result["quyen"]);
           $template->assign("bid",$result["bid"]);
           $template->assign("foder",$result["foder"]);
           $template->assign("img",$result["img"]);
           $template->assign("idcha",$result["idcha"]);
           $template->assign("ngaytao",$result["ngaytao"]);
           $template->assign("mota",$result["mota"]);
           $template->assign("idsua",$result["idsua"]);
           $template->assign("idtao",$result["idtao"]);
           $template->assign("files",$result["files"]);
           $template->parse("main.block_congvan");
 }
     

  }

////////////////////
////////////////////

////////////////////////////////////////////////////////////////////////////////////////////////////
  
if ($_REQUEST["id"] == "-1")
{ 
   $template->assign("t-c","Thêm mới  " );
   $template->assign("idgoi",$_POST["id"]);
    $template->assign("congvan",composx("files","Name",$result["ID"],""));

}
    else
    {
    $sql ="SELECT a.Name as Namechitiet ,a.Id as idchitiet ,a.files as filechitiet,b.files as filecongvan
    FROM chitietcongvan as a left join congvan as b 
    on a.idcongvan = b.ID WHERE b.ID='".$_REQUEST["id"]."'";

    $query = $data->query($sql);
    while ( $result = $data->fetch_array($query)){
      $template->assign("Namechitiet",$result["Namechitiet"]);	
         $template->assign("idchitiet",$result["idchitiet"]);
         $template->assign("filechitiet",$result["filechitiet"]);
         $template->assign("filecongvan",$result["filecongvan"]);
         $template->parse("main.block_chitietcongvan");
}
   
    }

$template->parse("main.block_ajack"); 
$data->closedata() ;

            ?>
            