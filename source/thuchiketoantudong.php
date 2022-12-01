<?php
 if ($_SESSION["dangnhap"]=="") return ;
 date_default_timezone_set('Asia/Ho_Chi_Minh');
 $root_path =getcwd()."/"  ;
 include($root_path."thuchibienngayquahan.php"); 
$IDTao = $_SESSION["LoginID"]  ;
$data->setthaotac = "tailendata" 	;
//if(!($IDTao ==1||$IDTao ==486|| $IDTao ==7068)) { echo "Bạn không có phân quyền !";  return ; }
//=================================
$chucnang= $_SESSION["act"] ; 
$quyen= $_SESSION["quyen"] ; 
$ql =$quyen[$_SESSION["mangquyenid"][$act]]  ;  
 

//if( $ql[0]!=1  ){return;} 
//=================================
	if (!defined("IN_SITE")) 	{    	die('Hacking attempt!');	}
	 
 //=============================khoi tao ======================//  	 Xem  	 Them  	 Cap nhap  	 Tim  	Huy  	Khoa  	In
      
 //=======================================================================================	
        $tungay ="01/".gmdate('m', time() + 7*3600)."/".gmdate('Y', time() + 7*3600) ;
		
		$denngay =gmdate('d/m/Y', time() + 7*3600) ; 
 	    $template->assign("tungay",$tungay); 		
 	    $template->assign("denngay",$denngay); 		
	
	   if($_SESSION["LoginID"]==4647 || $_SESSION["LoginID"]==1){
	  	   
		  //$cuahangchophep=explode(",",$cuahangchophep);
			
			$ngaytrongthang='';
			for($i=0;$i<=31;$i++){
				$sle='';
				if($ngayquahanchophep==$i){
					$sle='selected="selected"';
				}
				$ngaytrongthang.='<option value="'.$i.'" '.$sle.'>'.$i.'</option>';
			}
			
		 $template->assign("kho",compoloai("cuahang","macuahang","Name",0," ")); 
		  $template->assign("cuahangchophep",$cuahangchophep); 
		  $template->assign("ngayquahanchophep",$ngayquahanchophep); 
		    $template->assign("ngaytrongthang",$ngaytrongthang); 
			 $template->assign("loadtu",$loadtu); 
			  $template->assign("loadden",$loadden); 
	   		if(isset($_POST["UpdateNQH"])){
				//echo "ok";ngayquahan
				$cuahang=$_POST["cuahangchuoi"];
					//echo $cuahang;
				$loadtu=$_POST["loadtu"];	
				$loadden=$_POST["loadden"];	
				
				$ngayquahanchophep=$_POST["ngayquahan"];
				$tamp="\$ngayquahanchophep='".$ngayquahanchophep."';";
				$tamp.="\$cuahangchophep='".$cuahang."';";
				$tamp.="\$loadtu='".$loadtu."';";
				$tamp.="\$loadden='".$loadden."';";
				$filename=getcwd()."/thuchibienngayquahan.php";
			if(file_exists($filename))
			{
					$chuoimoi="<?php ".$tamp." ?>";
						file_put_contents($filename,$chuoimoi);
						$template->parse("main.block_tudong.block_chinhngayquahan.block_chinhngayquahanluu");	
					}else {
			
						$template->parse("main.block_tudong.block_chinhngayquahan.block_chinhngayquahanluufail");	
					}
				
			}
			  $template->parse("main.block_tudong.block_chinhngayquahan");
	   }
	   
	   $template->parse("main.block_tudong");
?>