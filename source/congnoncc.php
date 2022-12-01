<?php
session_start();
   $pa = getcwd() ;
      $idkho = $_SESSION["se_kho"] ; 
    $root_path = $pa."/data/data_cnncc".$idkho.".xlsx"  ;
  	//include( $pa."/excel/excel_reader.php");
	include( $pa."/excel/simplexlsx.class.php");  
	if (!defined("IN_SITE")){  	die('Hacking attempt!');}
 	$data->setthaotac = "phieuthu" 	;
//=============================khoi tao ======================//  	 Xem  	 Them  	 Cap nhap  	 Tim  	Huy  	Khoa  	In
  //=======================================================================================	
 
 
  
 $donglai = "none" ;
if (trim($_REQUEST["t5"]) != '')   $donglai = '' ;

    $IDtao =  $_SESSION["LoginID"]  ;
	  $idkho = $_SESSION["se_kho"] ; 
  //=======================================================================================
   $nganhang =laso( $_REQUEST['nganhang']) ;
   $loaitaikhoan = laso($_REQUEST['loaitaikhoan']) ;
  	 $template->assign("loaitaikhoan".$loaitaikhoan,"selected");
	  $template->assign("nganhang",compoloai("taikhoannganhang","ma","Name",$nganhang,""));
	 				 	
     $template->assign("nhacungcap",composx("nhacungcap","Name",$idnhacc,""));
     $template->assign("diachinhacungcap",composx("nhacungcap","address",0,""));		
	 $i = $page_start; 
	 $compocaydata = "" ;
	// 	compocay("nhomcongnoncc","Name","IDGroup",0, 0,0,0);		 
      $taocaydata = "" ;
 
		$template->assign("ngay", gmdate('d/m/Y', time() + 7*3600  ) ); 		
	//	$template->assign("taikhoan",compoloai("taikhoan","ma","Name","","where 1=1 order by ma ")); 
	  $template->assign("tungay", gmdate('d/m/Y',time() + 7*3600 -30*24*3600  ) ); 		
   
    $template->assign("dong", 2  );
	$template->assign("toi", ''  );
	
	
if(isset($_POST['Submit']) || isset($_POST['luulai'])  )
{	
 
@move_uploaded_file($_FILES['filehd']['tmp_name'],$root_path) ;
@unlink($_FILES['filehd']); 

	if ( $data_cnncc = SimpleXLSX::parse($root_path) ) {

	//echo '<table border="1" cellpadding="3" style="border-collapse: collapse">';
        $sheets=$data_cnncc->rows();
		$sd= count($sheets);
		//echo $sd;
		$dim = $data_cnncc->dimension();
		$cols = $dim[0];

		foreach ( $data_cnncc->rows() as $k => $r ) {
					if ($k < 2) continue; // bo qua 2 dong dau
			//echo '<tr>';
			
			for ( $i = 0; $i < $cols; $i++ ) { 
				//$congnoncc[] = $r[$i];
				//echo '<td>' . ( isset( $r[ $i ] ) ? $r[ $i ] : '&nbsp;' ) . '</td>';
				//echo '<td>' . $r[ $i ] . '</td>';
				//$td[] = '<td>' . $r[ $i ] . '</td>';
				$template->assign("t1",$stt = $r[ 0 ]);
				//$template->assign("t2",$r[ 1 ]);
				$template->assign("t2",$ngayct = (new DateTime($r[1]))->format('d-m-Y'));
				$template->assign("t3",$mancc = $r[ 2 ]);
				$template->assign("t4",$tenncc = $r[ 3 ]);
				$template->assign("t5",$soluong = $r[ 4 ]);
				$template->assign("t6",$dongia = $r[ 5 ]);
				$template->assign("t7",$nguoichi = $r[ 6 ]);
				$template->assign("t8",$nguoinhan = $r[ 7 ]);
				$template->assign("t9",$loaitk = $r[ 8 ]);
				$template->assign("t10",$diengiai = $r[ 9 ]);
				$template->assign("t11",$ghichu = $r[ 10 ]);
				//$congnoncc = array("STT"=>$stt,"NgayCT"=>$ngayct,"MaNCC"=>$mancc,"TenNCC"=>$tenncc,"Soluong"=>$soluong,"Dongia"=>$dongia,"Nguoichi"=>$nguoichi,"Nguoinhan"=>$nguoinhan,"LoaiTK"=>$loaitk,"Diengiai"=>$diengiai,"Ghichu"=>$ghichu);	
				
				
			}
			//echo '</tr>';
			$template->parse("main.block_fileht");
			if (isset($_POST['luulai']) )
			{   
			//Tạo số chứng từ
				$thang = gmdate('m', time() + 7*3600);  
			   $nam = gmdate('y', time() + 7*3600); 
			   $so = strlen($id) + 10; 
				$sql = "select  MAX(CONVERT(MID(sochungtu,$so,22 ),UNSIGNED INTEGER))   as sp from congnoncc 
				 where  mid(sochungtu,6,2) = '$thang'  and mid(sochungtu,4,2) = '$nam'   " ; // khong dung duoc do no kg dung theo kho ma dung theo id
			$sotien = intval($dongia) * intval($soluong);	 
			$sql = " INSERT INTO congnoncc
			set  soluong = '$soluong',dongia = '$dongia',IDtao='$id', sochungtu='$sochungtu',ngay='$ngayct',ngaytao='$ngaytao',note='$note',sotien='$sotien',lydo='$lydo',nguoinhan='$nguoinhan',nguoichi='$nguoichi',donvi='$donvi',loaitk='$loaitk' ,IDSua='$id',luachon='$luachon',lydoN ='$diengiai',idnhacc='$mancc',sodu='$sodu'  ";
			$data->query($sql); 
			}
		}
		//echo '</table>';
	} else {
		echo SimpleXLSX::parseError();
		}
	
	
			
			
/*	 $datatc = new SimpleXLSX($root_path);
	//$datatc = new SimpleXLSX("data/datac0.xlsx");
	$sheets=$datatc->rows();
	$sd= count($sheets) ;
	 
	// echo $datatc->sheets[0]['numRows'] ; return ;
  	if ($sd>6000 ) $sd = 6000 ;  
	$dong = laso($_REQUEST['dong'])  ;
	
	$toi = laso($_REQUEST['toi']) ;
	$kieungay = laso($_REQUEST['kieungay']) ;
	 $template->assign("kieungay".$kieungay,"selected");
	
	if ($toi!=0) $sd = $toi-1 ;
	if ($dong == 0) $dong = 11 ;
	if ($toi == 0) $toi = 900 ;
	 $template->assign("toi", $toi  );
	$template->assign("dong", $dong   );
	$dong = $dong - 1;$toi = $toi - 1;
	
	
	$stt = 1 ; $sodu =0 ;
	$ngaytao = gmdate('Y-n-d H:i:s', time() + 7*3600) ;
	
	//echo $sd;
	for ($j = $dong; $j <= $sd ; $j++)
		{  
	    
		
		
	    if ($kieungay==0)      $ngaythuchi =chuyenngay(trim($sheets[$j][0]),"dd-mm-yyyy" ,"yyyy-mm-dd",'-'  ); 
			else if ($kieungay==1) $ngaythuchi =chuyenngay(trim($sheets[$j][0]),"mm-dd-yyyy" ,"yyyy-mm-dd",'-'  );  
			else if ($kieungay==2) $ngaythuchi =chuyenngay(trim($sheets[$j][0]),"yyyy-mm-dd" ,"yyyy-mm-dd",'-'  );  
			else if ($kieungay==3){$ng =($sheets[$j][0]-25569)*86400;$ngaythuchi= date("Y-m-d", $ng) ; }
 			else $ngaythuchi="" ;
			
	//	echo	 $ngaythuchi ."===" ."<br>" ;
		  if(  strtotime($ngaythuchi)>strtotime(gmdate('Y-n-d'),time() + 7*3600)  )
		   {
			   echo "Lỗi dòng $j ngày chứng từ lớn hơn ngày hiện tại  ";return;  
		   }				
			
			
			if ($ngaythuchi ==''||$nhom=='') 
			{	$mau="red"; echo $j .'-'.$ngaythuchi .'-'.$nhom .'=nhom='.$sheets[$j][4]; return; 	}else {$mau=""; }
			
			 $template->assign("mau",$mau );
	   	$template->assign("j",$stt ); $stt ++;
		 
			
			if(strlen($ngaythuchi)<6){echo $ngaythuchi.'-'.$sheets[$j][1].'=='.$sheets[$j][4];return;} 
		 	 $sochungtu = trim($sheets[$j][1]) .$nam.$thang.".k".$idkho.".". $sp  ;  
			 $sp=$sp +1 ;
		 	 
			  
			$template->assign("t1", trim($sheets[$j][0])." => ". $ngaythuchi);
 			
			$luachon='0';
			if(trim($sheets[$j][1])=="T") $luachon= 1 ;
			if(trim($sheets[$j][1])=="C") $luachon= 2 ;
			if($luachon==0){ echo "lỗi dòng $j không có loại thu chi " ;  break ;}
			$template->assign("t2" ,$sheets[$j][1]."- $luachon ");
			$template->assign("t3", $sheets[$j][2]  . "-".$nhom);
			if( $sheets[$j][3]=="TM") $loaitaikhoan=0; else  $loaitaikhoan=1 ;
			$template->assign("t4", $sheets[$j][3] ."-".$loaitaikhoan );
			$lydo= chonghack($sheets[$j][4])  ;  $template->assign("t5", $lydo  );
			$nguoinhan= chonghack($sheets[$j][5]) ; $template->assign("t6", $nguoinhan  );
			$nguoichi = chonghack($sheets[$j][6]) ; $template->assign("t7", $nguoichi  );
			$sotien = laso($sheets[$j][7]) ;$template->assign("t8",$sotien  );
			if ( $sotien==0)  		  {   break;return;	 } 
			$ncc = $mangncc[strtolower(trim($sheets[$j][8]))];
			$template->assign("t9", $tamnh .' ('.$ncc  .')'   );
		 
			 
			$template->assign("t10", $sheets[$j][9] );
			$note= chonghack($sheets[$j][9] );
			if( trim($sheets[$j][11])!=''){
				$idnganhang= $mangnh[strtolower(trim($sheets[$j][10]))];
			} else  $idnganhang='';
			$template->assign("t11", $sheets[$j][10]  ."-".$idnganhang );  

	} // end for
	*/
	
}

/*	#if ($_REQUEST['loaitaikhoan']==1) $template->parse("main.block_nganhang"); 
	else $template->parse("main.block_tienmat");
if(isset($_POST['Submit']) || isset($_POST['luulai'])  )
{	
   #$mangnhomt =   taomang("nhomthuchi","ma","ID");
   #$mangch =   taomang("cuahang","macuahang","ID");

//   foreach ($mangch as $aa => $key)
//   {
//	   echo $aa."=" ;
//   }
 
   $ngaytao = gmdate('Y-n-d H:i:s', time() + 7*3600) ;
   $thang = gmdate('m', time() + 7*3600); 
   $nam = gmdate('Y', time() + 7*3600);   
   $so =  10;
 
   #$sql = "SELECT `AUTO_INCREMENT` as sp FROM INFORMATION_SCHEMA.TABLES
    # WHERE TABLE_SCHEMA = 'siandchip_20' AND TABLE_NAME = 'thuchich';" ;   $kq = $data->truyvan($sql) ;		
    #$sp  = laso($kq['sp'])+1   ;	
	 

  
  	@move_uploaded_file($_FILES['filehd']['tmp_name'],$root_path) ;
 	@unlink($_FILES['filehd']); 

  	// $datatc = new Spreadsheet_Excel_Reader($root_path,true,"UTF-8"); 
    $datatc = new SimpleXLSX($root_path);
	$sheets=$datatc->rows();
	$sd= count($sheets) ;
	
	// echo $datatc->sheets[0]['numRows'] ; return ;
  	if ($sd>6000 ) $sd = 6000 ;  
	$dong = laso($_REQUEST['dong'])  ;
	
	$toi = laso($_REQUEST['toi']) ;
	$kieungay = laso($_REQUEST['kieungay']) ;
	 $template->assign("kieungay".$kieungay,"selected");
	
	if ($toi!=0) $sd = $toi-1 ;
	if ($dong == 0) $dong = 11 ;
	if ($toi == 0) $toi = 900 ;
	 $template->assign("toi", $toi  );
	$template->assign("dong", $dong   );
	$dong = $dong - 1;$toi = $toi - 1;
	
	
	$stt = 1 ; $sodu =0 ;
	$ngaytao = gmdate('Y-n-d H:i:s', time() + 7*3600) ;
	if( isset($_POST['luulai'])  )
	{	
	// 	$sql = " delete from congnoncc where  idnhacc='$idnhacc' and idnhacc>0 " ;
	//	$data->query($sql);	
	}
	$landau = true ;
		$mangncc = taomang ("nhacungcap","LCASE(ID)","ID"); 
	$mangnhom = taomang ("nhomthuchi","LCASE(ma)","ID"); 
    $mangnh = taomang ("taikhoannganhang","LCASE(diachi)","ID"); 
	 	for ($j = $dong; $j <= $sd ; $j++)
		{      
		
		$tamnh= $sheets[$j][8] ;   	$nhom= $mangnhomt["$tamnh"] ;
		$tamch= $sheets[$j][9] ; 	$cuahanght= $mangch["$tamch"] ;
		$nhom = $mangnhom[strtolower(trim($sheets[$j][2]))];
	    if ($kieungay==0)      $ngaythuchi =chuyenngay(trim($sheets[$j][0]),"dd-mm-yyyy" ,"yyyy-mm-dd",'-'  ); 
			else if ($kieungay==1) $ngaythuchi =chuyenngay(trim($sheets[$j][0]),"mm-dd-yyyy" ,"yyyy-mm-dd",'-'  );  
			else if ($kieungay==2) $ngaythuchi =chuyenngay(trim($sheets[$j][0]),"yyyy-mm-dd" ,"yyyy-mm-dd",'-'  );  
			else if ($kieungay==3){$ng =($sheets[$j][0]-25569)*86400;$ngaythuchi= date("Y-m-d", $ng) ; }
 			else $ngaythuchi="" ;
			
	//	echo	 $ngaythuchi ."===" ."<br>" ;
		  if(  strtotime($ngaythuchi)>strtotime(gmdate('Y-n-d'),time() + 7*3600)  )
		   {
			   echo "Lỗi dòng $j ngày chứng từ lớn hơn ngày hiện tại  ";return;  
		   }				
			
			
			if ($ngaythuchi ==''||$nhom=='') 
			{	$mau="red"; echo $j .'-'.$ngaythuchi .'-'.$nhom .'=nhom='.$sheets[$j][4]; return; 	}else {$mau=""; }
			
			 $template->assign("mau",$mau );
	   	$template->assign("j",$stt ); $stt ++;
		 
			
			if(strlen($ngaythuchi)<6){echo $ngaythuchi.'-'.$sheets[$j][1].'=='.$sheets[$j][4];return;} 
		 	 $sochungtu = trim($sheets[$j][1]) .$nam.$thang.".k".$idkho.".". $sp  ;  
			 $sp=$sp +1 ;
		 	 
			  
			$template->assign("t1", trim($sheets[$j][0])." => ". $ngaythuchi);
 			
			$luachon='0';
			if(trim($sheets[$j][1])=="T") $luachon= 1 ;
			if(trim($sheets[$j][1])=="C") $luachon= 2 ;
			if($luachon==0){ echo "lỗi dòng $j không có loại thu chi " ;  break ;}
			$template->assign("t2" ,$sheets[$j][1]."- $luachon ");
			$template->assign("t3", $sheets[$j][2]  . "-".$nhom);
			if( $sheets[$j][3]=="TM") $loaitaikhoan=0; else  $loaitaikhoan=1 ;
			$template->assign("t4", $sheets[$j][3] ."-".$loaitaikhoan );
			$lydo= chonghack($sheets[$j][4])  ;  $template->assign("t5", $lydo  );
			$nguoinhan= chonghack($sheets[$j][5]) ; $template->assign("t6", $nguoinhan  );
			$nguoichi = chonghack($sheets[$j][6]) ; $template->assign("t7", $nguoichi  );
			$sotien = laso($sheets[$j][7]) ;$template->assign("t8",$sotien  );
			if ( $sotien==0)  		  {   break;return;	 } 
			$ncc = $mangncc[strtolower(trim($sheets[$j][8]))];
			$template->assign("t9", $tamnh .' ('.$ncc  .')'   );
		 
			 
			$template->assign("t10", $sheets[$j][9] );
			$note= chonghack($sheets[$j][9] );
			if( trim($sheets[$j][11])!=''){
				$idnganhang= $mangnh[strtolower(trim($sheets[$j][10]))];
			} else  $idnganhang='';
			$template->assign("t11", $sheets[$j][10]  ."-".$idnganhang );  

      	    if (isset($_POST['luulai']) )
			{   $khongco=0;
				 				  
					 $sql  = " select ID from thuchich where ngaythuchi='$ngaythuchi' and sotien='$sotien' and lydo='$lydo' and loaitk='$idkho'  limit 1 ";
				// 	echo $sql."<br>";
					$chan = getdong($sql);   
				// 	echo $sql."<br>---";
				  if ( laso($chan['ID'])>0)  		  {   break;	 }
					
 				      $sql = "INSERT INTO thuchich set   IDtao=$IDtao,  donvi='$ncc', loaitaikhoan='$loaitaikhoan',idnganhang='$idnganhang',IDCha='$nhom',sochungtu='$sochungtu',ngaythuchi='$ngaythuchi',
					 ngaytao='$ngaytao',note='$note',sotien='$sotien',lydo='$lydo' ,nguoinhan='$nguoinhan',nguoichi='$nguoichi',loaitk='$idkho',luachon='$luachon'";	 
				//	 	echo $sql."<br>";
                      $data->query($sql);	 
					//   echo  $stt ."<br>";  
				
					  $spt++ ; $khongco=0;
 				$stt++ ; 
		 
			}
			
		
 			$template->parse("main.block_fileht");
		 	if ($j==2000) return ;
 		}
	if (isset($_POST['luulai']) )  $template->assign("daluu","Đã Lấy Xong !!!" );
}		
*/
?>