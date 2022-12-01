<?php  
    $quyen= $_SESSION["quyen"] ; $idl=$_SESSION["LoginID"]; 

  if ($_SESSION["mangmenu"]=='')
 {   $m =array();
     $mangquyenid= $m;
	$sql="Select Name ,ID,icon,idcha ,ma,hienthi  from  menu  where  1  order by vitri desc  ";
	 
	$result=$data->query($sql); 	 
    $categories = array(); $mt=array(); 
	if ($idl>0) $mt['Name']="Đăng Xuất" ; else $mt['Name']="Đăng nhập" ;
      $mt['ID']=  "9999";  $mt['icon']= 'customer.gif'; $mt['ma']="default.php?act=Exit" ;$mt['idcha']= '0';$mt['hienthi']= '0';
	  while ($row =$data->fetch_array($result) )
		  { $ql =$quyen[$row['ID']]  ;
		     $str= $row['ma'];
		     $str=substr($str,16,strlen($str));
		     $mangquyenid[$str]= $row['ID'] ;
		    if($ql[0]==1||$idl==1)  $categories[] = $row;  
			 
		   }
 		  $categories[9999] = $mt;
 		$_SESSION["mangmenu"]=  $categories;
	    $_SESSION["mangquyenid"]=  $mangquyenid;
 } else   $categories=$_SESSION["mangmenu"];
 
 
     $tam ='';

         
		   
		
         function showCategories($categories, $parent_id = 0, $char = "")
          { global  $tam   ;
              /* BƯỚC 2.1: LẤY DANH SÁCH CATE CON*/
              $cate_child = array();
              foreach ($categories as $key => $item)
              {
                  /*Nếu là chuyên mục con thì hiển thị*/
                  if ($item["idcha"] == $parent_id)
                  {   
				   
					  $cate_child[] = $item;
                      unset($categories[$key]);
                  }
              }
               /* BƯỚC 2.2: HIỂN THỊ DANH SÁCH CHUYÊN MỤC CON NẾU CÓ*/
              if ($cate_child)
              {$i=0;$uldr='';
				    // if($item["hienthi"]==1)  $drop="class='dropdown'"; else $drop="";
				  
                  foreach ($cate_child as $key => $item)
                  {    
				    if ($i==0)
					{     if ($tam=="") $tam = "<ul  class='nav navbar-nav dropdown' >";  
					  else 
					  {  if($item["hienthi"]==1)   $tam .= "<ul class='dropdown'>";   
					     else   
					 	 { if($uldr=='')  $tam .= "<ul class='dropdown-menu'>"; else  $tam .= "<ul >";  }
					  }
					  
					  }
				     $i++;
					  if($item["hienthi"]==1) { $drop="class='dropdown'";  $ad = "data-toggle='dropdown' class='dropdown-toggle'"; } else { $drop=""; $ad = "class='menu'"; }
                        $tam .= "
                       <li $drop ><A   $ad  href='$item[ma]' >";
						if($item["icon"]!='') $tam .= "<IMG   src='images/$item[icon]' />";
						$tam .=    $item["Name"];
						if($item["hienthi"]==1) $tam .= "<span class='caret'></span>";
						$tam .=   "</a>";
						
                       
                      /* Tiếp tục đệ quy để tìm chuyên mục con của chuyên mục đang lặp*/
                      showCategories($categories, $item["ID"], $char."|---");
                       $tam .= "</li>";
                  }
                   $tam .= "</ul>";
              }
          }
		  
		
		  
          showCategories($categories);  
 	    $template->assign("menuy" , $tam ) ;   
     
   
 ?>