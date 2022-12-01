<?php  
session_start();
 
   
 
 $root_path =getcwd()."/"  ;
 $quyen= $_SESSION["quyen"] ; 
 date_default_timezone_set('Asia/Ho_Chi_Minh');
 $ql =$quyen[$_SESSION["mangquyenid"][$_SESSION['act']]]  ;  
 //$ql='120000';

  $idl=$_SESSION["LoginID"];
   $idkho = $_SESSION["se_kho"];

//$idkho =1093;
//$ql[5]=1;
//$_SESSION["LoginID"]=7576;
 if( !($ql[0] || $idl==1) ){return;}
$wherequyen='';

if(!$ql[5]){
	if($ql[1]){
		$wherequyen=' and ( a.phieuxuat is not null and  a.phieuxuat <> "")';
		}
	else if($ql[2]){
		$wherequyen=' and LEFT(d.xacnhan,0)=1 or LEFT(d.xacnhan,1)=1 or LEFT(d.xacnhan,2)=1';
		
	}
	else if($ql[3]){
	
		$wherequyen=' and LEFT(d.xacnhan,0)=2 or LEFT(d.xacnhan,1)=2 or LEFT(d.xacnhan,2)=2';
	
	}
	else if($ql[4]){
		$wherequyen=' and LEFT(d.xacnhan,0)=3 or LEFT(d.xacnhan,1)=3 or LEFT(d.xacnhan,2)=3';
	}
	
}  
else{
	$wherequyen=' ';
}
include($root_path."includes/config.php");
include($root_path."includes/removeUnicode.php");
include($root_path."includes/class.paging.php");
include($root_path."includes/class.mysql.php");
include($root_path."includes/function.php");
 

 
   
$data = new class_mysql();
$data->config();
$data->access();

  $data1 = $_POST['DATA']; 
  	$tmp = explode('*@!',$data1);
 
        
        $manv= trim($tmp[0]);
		$kho= laso($tmp[1]);
		$tu= trim($tmp[2]);
		$den= trim($tmp[3]);
		$tinhtrang= laso($tmp[4]);
		$ten= chonghack($tmp[5]);
		$loai= laso($tmp[6]);
		$sotien= laso($tmp[7]);
		$soct= trim($tmp[8]);
		 $loc= trim($tmp[9]);
		  $tkno= trim($tmp[10]);
		   $tkco= trim($tmp[11]);
		     $curentpage= trim($tmp[12]);
		// echo $tu;
			 //dieufd kiên thêm ++++++++++++++++++++++++++++++++++++

			   $stknh= trim($tmp[13]);
			     $tentknh= trim($tmp[14]);
				   $mavd= trim($tmp[15]);
				     $dvvc= trim($tmp[16]);
					    $ncc= trim($tmp[17]);
			     $manv= trim($tmp[18]);
				   $phieuxuat= trim($tmp[19]);
				    // $tkno= trim($tmp[20]);
					  //$tkco= trim($tmp[21]);
					    $diengiai= trim($tmp[22]);
					   $dinhkhoan= trim($tmp[23]);
					 
					    $psno= trim($tmp[24]);
						 $psco= trim($tmp[25]);
						  $dongia= trim($tmp[26]);
						    $soluong= trim($tmp[27]);
							  $dvt= trim($tmp[28]);
							  
							 
							    $ngaytaotu= trim($tmp[29]);
								 $ngaytaoden= trim($tmp[30]);
								  $loai= trim($tmp[31]);
								    $limit= trim($tmp[32]);
									  $nguoixacnhan= trim($tmp[33]);
									   $dinhkhoanthuchi= trim($tmp[34]);
									     $tuthongbao= trim($tmp[35]);
										   $tinhtrangtb= trim($tmp[36]);
										     $idchadmin= trim($tmp[37]);
								//echo $nguoixacnhan;
									if(!$limit){
										 $limit=20;
									}
								// $limit=20;
		//var_dump(in_array(strtoupper($dinhkhoan),$mangOlDuyetAll));
			   //return;
			   ///++++++++++++++++++++++++++++++++++++++
			 if(!$curentpage){
			 	$curentpage=1;
			 }
			  
			 
	
		 // if ($trang!=0  ) $limit  =  " LIMIT ". 10000*($trang-1) .", ". 10000*($trang); else $limit =" limit 10000";
		$sql_where="  "; 
		$sql_where2 = "" ;
		$sql_where3 = "" ;
		$sql_ton=" and  (a.luachon = '1' or a.luachon= '2' )";
				if($loai!=""){
					$sql_where.=" and a.luachon ='$loai'";
						$sql_ton.=" and a.luachon ='$loai'";
				}
			if($stknh != ""){ $sql_where.=" and a.sotknh ='$stknh'"; }
				if($tentknh != ""){ $sql_where.=" and a.tentknh ='$tentknh'"; $sql_ton.=" and a.tentknh ='$tentknh'"; }
				
				if($mavd != ""){ $sql_where.=" and a.mavandon = '$mavd'";  $sql_ton.=" and a.mavandon = '$mavd'"; }
				if($dvvc != ""){ $sql_where.=" and a.donvivc = '$dvvc'"; $sql_ton.=" and a.donvivc = '$dvvc'"; }
				if($ncc != ""){ $sql_where.=" and e.Name like '%$ncc%'"; $sql_ton.=" and e.Name like '%$ncc%'"; }
				if($ngaytaotu != ""  && $ngaytaoden==""){ $sql_where.=" and a.ngaytao >='$ngaytaotu'"; $sql_ton.=" and a.ngaytao < '$ngaytaotu'"; }
				//if($ngaytaotu == ""  && $ngaytaoden==""){$sql_ton.=" and a.ngaytao < '1001-01-01'"; }
				if($ngaytaotu != ""  && $ngaytaoden!=""){ $sql_where.=" and a.ngaytao >='$ngaytaotu' and a.ngaytao <='$ngaytaoden'";}
				if($phieuxuat != ""){ $sql_where.=" and f.SoCT = '$phieuxuat'";  $sql_ton.=" and f.SoCT = '$phieuxuat'"; }
				//if($tkno != ""){ $sql_where.=" and a.tkno = '$manv'"; }
				//if($tkco != ""){ $sql_where.=" and c.manv = '$manv'"; }
				if($nguoixacnhan != ""){ 
					if($nguoixacnhan!=4){
						$sql_where.=" and d.xacnhan = '$nguoixacnhan'";
					}
					else if($nguoixacnhan==4){ 
						$sql_where.=" and a.phieuxuat is not null  and a.phieuxuat<> 0";
					}
				 }
				
				if($dinhkhoan != ""){ $sql_where.=" and (d.ma = '$dinhkhoan' or d.ten like '%$dinhkhoan%')"; $sql_ton.=" and (d.ma = '$dinhkhoan' or d.ten like '%$dinhkhoan%')"; }
				if($psno != ""){ $sql_where.=" and a.psno = '$psno'"; $sql_ton.=" and a.psno = '$psno'"; }
				if($psco != ""){ $sql_where.=" and a.psco = '$psco'"; $sql_ton.=" and a.psco = '$psco'"; }
				if($dongia != ""){ $sql_where.=" and a.dongia = '$dongia'";  $sql_ton.=" and a.dongia = '$dongia'"; }
				if($soluong != ""){ $sql_where.=" and a.soluong = '$soluong'"; $sql_ton.=" and a.soluong = '$soluong'"; }
				if($dvt != ""){ $sql_where.=" and a.donvi = '$dvt'";  $sql_ton.=" and a.donvi = '$dvt'"; }
				if($diengiai != ""){ $sql_where.=" and a.note = '$diengiai'"; $sql_ton.=" and a.note = '$diengiai'"; }
				
		if($manv != ""){ $sql_where.=" and a.manv = '$manv'"; $sql_ton.=" and a.manv = '$manv'"; }
		if($ten != ""){ $sql_where.=" and c.ten = '$ten'"; $sql_ton.=" and c.ten = '$ten'"; }
		if($sotien >0 ){ $sql_where.=" and a.sotien = '$sotien'"; $sql_ton.=" and a.sotien = '$sotien'"; }
		if($soct !='' ){ $sql_where.=" and a.sochungtu = '$soct'"; $sql_ton.=" and a.sochungtu = '$soct'"; }
		if($kho != "")
		{
   			$sql_where.=" and a.loaitk =  '$kho' ";
			$sql_ton.=" and a.loaitk =  '$kho' ";
 		}else if($_SESSION["loai_user"]==16)
		{
			$sql_where.=" and c.idtinh =  '$kho' ";
			$sql_ton.=" and c.idtinh =  '$kho' ";
		}
		
		if($dinhkhoanthuchi){
			$sql_where.=" and d.ID in ($dinhkhoanthuchi) ";
			$sql_ton.=" and d.ID  in ($dinhkhoanthuchi) ";
		}
		if($tkno){
			$sql_where.=" and a.tkno in ($tkno) ";
			$sql_ton.=" and a.tkno in ($tkno) ";
		}
		if($tkco){
			$sql_where.=" and a.tkco in  ($tkco) ";
			$sql_ton.=" and a.tkco in  ($tkco) ";
		}
		
		
       if($tinhtrang != ""){
			 if($tinhtrang == 0){   $sql_where.= " and a.tinhtrang=0 "; $sql_ton.= " and a.tinhtrang=0 ";	} 
 			 else if($tinhtrang ==2){ $sql_where.= " and a.tinhtrang=2 "; $sql_ton.= " and a.tinhtrang=2 "; }
			 else if($tinhtrang ==3){ $sql_where.= " and  a.tinhtrang=3 "; $sql_ton.= " and  a.tinhtrang=3 "; }
			 else if($tinhtrang ==4){ $sql_where.= " and  a.tinhtrang=4"; $sql_ton.= " and  a.tinhtrang=4"; }
			 else if($tinhtrang ==1){ $sql_where.= " and  a.tinhtrang=1 and d.ma <> 'DTBH'";  $sql_ton.= " and  a.tinhtrang=1 and d.ma <> 'DTBH'"; } //chưa duyệt cso lyd do
			  else if($tinhtrang ==5){ $sql_where.= " and  a.tinhtrang=5"; $sql_ton.= " and  a.tinhtrang=5"; } // quan ly duyet
			 
		}
		
	
	 if($tu!="")	
		{
		  $ngay=  explode('/',$tu);
	   	  if (strlen($ngay[1])== 1) {  $ngay[1] = "0".$ngay[1] ;  }
		  if (strlen($ngay[0])== 1) {  $ngay[0] = "0".$ngay[0] ;  } 
		    //$sql_where2 .= " and  p.Ngaytao>= '$ngay[2]-$ngay[1]-$ngay[0]'";
			//$sql_where3 .= " and  aa.NgayTao>= '$ngay[2]-$ngay[1]-$ngay[0]'";
		  $sql_where  .= " and  a.ngaythuchi>= '$ngay[2]-$ngay[1]-$ngay[0]'";
		    $sql_ton  .= " and  a.ngaythuchi< '$ngay[2]-$ngay[1]-$ngay[0]'";
		}
		else{
			$sql_ton .= " and  a.ngaythuchi < '1001-01-01'";
		}
		
		if($den!="")	
		{
		  $ngay=  explode('/',$den);
	   	  if (strlen($ngay[1])== 1) {  $ngay[1] = "0".$ngay[1] ;  }
		  if (strlen($ngay[0])== 1) {  $ngay[0] = "0".$ngay[0] ;  } 
			//  $sql_where2 .= " and  p.Ngaytao<= '$ngay[2]-$ngay[1]-$ngay[0] 23:59'";
			//   $sql_where3 .= " and  aa.NgayTao<= '$ngay[2]-$ngay[1]-$ngay[0] 23:59'";
		  $sql_where  .= " and  a.ngaythuchi<= '$ngay[2]-$ngay[1]-$ngay[0] 23:59'";
		}	
 		
		if($loc != ""){
			switch($loc){
				case 1:
					$sql_where.=" and (a.hdbh is not null and a.hdbh <>'')"; 
						$sql_ton.=" and (a.hdbh is not null and a.hdbh <>'')"; 
				break;
				case 2:
					$sql_where.=" and (a.sotknh is not null and a.sotknh<> 0)";
					$sql_ton.=" and (a.sotknh is not null and a.sotknh<> 0)";
				break;
				case 3:
					$sql_where.=" and (a.tentknh is not null and a.tentknh <>'')";
					$sql_ton.=" and (a.tentknh is not null and a.tentknh <>'')";
				break;
				case 4:
				
					$sql_where.=" and a.mavandon is not null";
						$sql_ton.=" and a.mavandon is not null";
				break;
				case 5:
					$sql_where.=" and a.donvivc is not null";
					$sql_ton.=" and a.donvivc is not null";
				break;
				case 6:
					$sql_where.=" and a.mavandon REGEXP '^[0-9]+$'";	
					$sql_ton.=" and a.mavandon REGEXP '^[0-9]+$'";	
				break;
				case 7:
					$sql_where.=" and a.mavandon REGEXP '^[0-9]+$'";
					$sql_ton.=" and a.mavandon REGEXP '^[0-9]+$'";		
				break;
				case 8:
					$sql_where.=" and (a.NCC is not null and a.NCC <> '')";	
					$sql_ton.=" and (a.NCC is not null and a.NCC <> '')";	
				break;
				case 9:
					$sql_where.=" and (a.manv is not null and a.manv <> '')";
					$sql_ton.=" and (a.manv is not null and a.manv <> '')";		
				break;
				case 10:
					$sql_where.=" and a.phieuxuat is not null  and a.phieuxuat<> 0";
					$sql_ton.=" and a.phieuxuat is not null  and a.phieuxuat<> 0";		
				break;
				case 11:
					$sql_where.=" and a.tkno is not null  and a.tkno <> 0";	
						$sql_ton.=" and a.tkno is not null  and a.tkno <> 0";		
				break;
				case 12:
					$sql_where.=" and a.tkco is not null  and a.tkco <> 0";	
					$sql_ton.=" and a.tkco is not null  and a.tkco <> 0";		
				break;
				default:
				break;
				
			}
		 			 
		 }
		
		
 		$where_thongbao='';
			if($tuthongbao){
				if($tinhtrangtb==1){
					$wtt="and (tinhtrang=0 or tinhtrang=1)";
				}
				else{
					$wtt="and  tinhtrang='$tinhtrangtb'";
				}
				if($idchadmin){
					$where_thongbao.=" and a.loaitk='$idchadmin' $wtt and DATE(ngaythuchi)>= DATE(NOW()-INTERVAL 7 DAY)";
				}
				else{
					$where_thongbao.=" and a.loaitk='$idkho' $wtt and DATE(ngaythuchi)>= DATE(NOW()-INTERVAL 7 DAY)";
				}
				
				$sql_where=$where_thongbao;
				
			}
   $mangtk = taomang ("dinhkhoan","ID","madinhkhoan");
  $mangnhomts = taomang ("taisannhom","ID","ma");
   $mangOlDuyetAll=taomang("dinhkhoanthuchi","ma","ID"," where duyetnhieu=1");

  //$mangOlDuyetAll=array("KCKNBO","HCNVCOL","CNDHOL","DGNTDN","HDGNTDN");
  // var_dump($mangtk);
		// $mangcuahang= taomang("cuahang","ID","macuahang",'') ;
	 
	  $sql_rows = "SELECT a.ID as idthuchikt,a.sochungtu,a.luachon as loaithuchi,a.sotien,DATE_FORMAT(a.ngaytao,'%d/%m/%Y') as ngaytao,DATE_FORMAT(a.ngaythuchi,'%d/%m/%Y %H:%i') as ngaythuchikt,DATE_FORMAT(a.ngayduyet,'%d/%m/%Y %H:%i') as ngayduyetthuchi,a.psco,a.psno,a.donvi,a.soluong,a.dongia,a.hdbh,a.phithukh,a.sotknh,a.tentknh,a.NCC,a.manv,a.phieuxuat,a.sophieupm,a.chungtu,a.mavandon,a.tinhtrang,a.donvivc,a.lydoN,d.xacnhan as nguoixn,b.macuahang as tencuahang,d.ma as madkhoan,d.ten as khoanmuctc,a.tkno,a.tkco,a.note as diengiai,s.note as ghichuchitietts,s.nguoigiao as nguoigiaots,s.nguoinhan as nguoinhants,s.ngaybatdau as ngaybdts,s.ngayketthuc as ngayktts,s.name as tents,s.nhomtaisan as nhomts  FROM thuchikt a left join cuahang b on a.loaitk=b.id  left join userac c on a.IDtao = c.ID  left join dinhkhoanthuchi d on d.ID = a.IDcha  left join taisantam s on a.sochungtu=s.ma left join nhacungcap e on a.NCC=e.ID left join phieuxuat f on a.phieuxuat=f.ID where 1=1 ".$sql_where." $wherequyen order by  a.ngaythuchi desc";
	  
	   //	$limit=20;
		//echo($curentpage);
	 	 $start=($curentpage-1)*$limit;
		 
		$sql = "SELECT a.ID as idthuchikt,a.sochungtu,a.luachon as loaithuchi,a.sotien,DATE_FORMAT(a.ngaytao,'%d/%m/%Y %H:%i:%s') as ngaytao,DATE_FORMAT(a.ngaythuchi,'%d/%m/%Y %H:%i') as ngaythuchikt,DATE_FORMAT(a.ngayduyet,'%d/%m/%Y %H:%i') as ngayduyetthuchi,a.psco,a.psno,a.donvi,a.soluong,a.dongia,a.hdbh,a.phithukh,a.sotknh,a.tentknh,a.NCC,a.manv,a.phieuxuat,a.sophieupm,a.chungtu,a.mavandon,a.tinhtrang,a.donvivc,a.lydoN,d.xacnhan as nguoixn,b.macuahang as tencuahang,d.ma as madkhoan,d.ten as khoanmuctc,a.tkno,a.tkco,a.note as diengiai,f.SoCT as phieuxuatf,s.note as ghichuchitietts,s.nguoigiao as nguoigiaots,s.nguoinhan as nguoinhants,DATE_FORMAT(s.ngaybatdau,'%d/%m/%Y') as ngaybdts,DATE_FORMAT(s.ngayketthuc,'%d/%m/%Y') as ngayktts,s.name as tents,s.nhomtaisan as nhomts  FROM thuchikt a left join cuahang b on a.loaitk=b.id  left join userac c on a.IDtao = c.ID  left join dinhkhoanthuchi d on d.ID = a.IDcha left join taisantam s on a.sochungtu=s.ma left join nhacungcap e on a.NCC=e.ID left join phieuxuat f on a.phieuxuat=f.ID where 1=1  ".$sql_where." $wherequyen order by  a.ngaythuchi desc limit $start,$limit";


 if($_SESSION['admintuan'] ) echo $sql ;
  if($_SESSION["LoginID"]==7576 || $_SESSION["LoginID"]==1){
  		 echo "<br>".$sql ;
   }
	//	$query_rows = $data->query($sql);
		$result_rows = $data->query($sql_rows);
		$numrow = $data->num_rows($result_rows);
		$totalpage=ceil($numrow/$limit);
		$chuoiphantrang=' <div class="pagi" style="display:flex;
    align-items: center;
    justify-content: center;"> <ul id="pagination" style="display:flex;margin-bottom:0">
		  <li><button value="F" onclick="phantrangAjax(1,1)">Đầu</button></li>
    <li><button value="-1" onclick="phantrangAjax(this.value,1)">«</button></li>';
		$min=1;
		$max=20;
		$buocnhay=3;
		if($totalpage>$max){
			if($curentpage-$buocnhay <$min || ($curentpage<$max-$buocnhay &&  $curentpage>$min)){
				$min =1;
				$max = 20;
				
			}
			else if($curentpage>=$max-$buocnhay && $curentpage<$totalpage && ($curentpage+$buocnhay)<=$totalpage){
				
				$max = $curentpage + $buocnhay ;
				$min =$curentpage-($limit-$buocnhay);
				
			}
			else if($curentpage >= $totalpage || ($curentpage+$buocnhay)>=$totalpage)
			{
			
				$max = $totalpage;
				$min =$totalpage - ($limit-$buocnhay);
			//	echo $min;
			}
			else{
			
				$min +=$buocnhay;
				$max +=$buocnhay;
			}
		}
		else{
			$min=1;
			$max=$totalpage;
		}	
		
		for($i=$min;$i<=$max;$i++){
			$mau='';
		if($curentpage==$i){
			$mau="red";
		}
			$chuoiphantrang.='<li><button value="'.$i.'" onclick="phantrangAjax(this.value,1)" style="background-color:'.$mau.'">'.$i.'</button></li>';
		}
	
	
 $chuoiphantrang.='  <li><button value="-2" onclick="phantrangAjax(this.value,1)">»</li></button>
 
 <li><button value="F" onclick="phantrangAjax('.$totalpage.',1)">Cuối</button></li>
 <li class="chonsodong"><button type="button" value="" onclick="showChondong()">Số dòng</button>
 	<div class="select_sodong"id="select_sodong">
		<div class="select_sodong_item"><button type="button" value="30" onclick="SendLimit(this.value,1)">30 dòng/trang</button></div>
		<div class="select_sodong_item"><button type="button" value="50" onclick="SendLimit(this.value,1)">50 dòng/trang</button></div>
		<div class="select_sodong_item"><button type="button" value="100" onclick="SendLimit(this.value,1)">100 dòng/trang</button></div>
		<div class="select_sodong_item"><button type="button" value="150" onclick="SendLimit(this.value,1)">150 dòng/trang</button></div>
		<div class="select_sodong_item"><button type="button" value="200" onclick="SendLimit(this.value,1)">200 dòng/trang</button></div>
		<div class="select_sodong_item"><input type="number" value="100" id="sodongnhap" nam="sodongnhap" onkeyup="SendLimitKeyup(event,1)" /></div>
		
	</div>
 
 </li>
  	</ul>
	<input type="button" onclick=" xuatexel(1) " name=" search3 " style=" width:65px ;height:30px" id=" search3" value="Excel" />
	 </div>
	
		
  </div>';
  
  
		$result = $data->query($sql);
		
		
 		
		//$i = $page_start; 
//		$mangnhanvien =taomang("userac","ID","ten"," where tinhluong = '1'  ") ;
	//==== tinh ton đau ky=======================================================
	$sql2 = "SELECT  sum(case when  a.luachon = 1 then round(a.psno) else -(round(a.psco)) end )as tong,DATE_FORMAT(a.ngaykhoa,'%d/%m/%Y') as ngaykhoa FROM thuchikt a left join cuahang b on a.loaitk=b.id  left join userac c on a.IDtao = c.ID  left join dinhkhoanthuchi d on d.ID = a.IDcha left join nhacungcap e on a.NCC=e.ID left join phieuxuat  f on a.phieuxuat=f.ID 
	where 1=1 and (d.ma <> 'TLDK' and d.ma <> 'TL') ".$sql_ton."  ORDER BY a.ngaytao desc  ";
	//a.tinhtrang=1

	 $_SESSION["truyvancu2"] = $sql2 ;
	 if ($_SESSION["LoginID"]==7576)echo "<br>".$sql2 ;
	 
	 
	 if ($_SESSION["admintuan"])	echo "<br>".$sql2 ;
  
	$result = $data->query($sql2); 
  	 $re = $data->fetch_array($result)  ;
 	  $tongton = $re['tong'] ;  
		
 $sql3 = "SELECT (sum(round(a.psno))) as tongthu,(sum(round(a.psco))) as tongchi FROM thuchikt a left join cuahang b on a.loaitk=b.id  left join userac c on a.IDtao = c.ID  left join dinhkhoanthuchi d on d.ID = a.IDcha left join nhacungcap e on a.NCC=e.ID left join phieuxuat  f on a.phieuxuat=f.ID  where  (d.ma <> 'TL' and d.ma <> 'TLDK')  ".$sql_where." ";
 
  if ($_SESSION["LoginID"]==7576)echo "<br>".$sql3 ;
 	$result = $data->query($sql3); 
  	 $re = $data->fetch_array($result)  ;
 	 $tongthu = $re["tongthu"]; 
	  $tongchi=  $re["tongchi"];
	//echo $tongthu;
 /* while($re = $data->fetch_array($result))
	{    $r++ ;
	
		if ($re['loaithuchi'] == 1 ) // cac khoan thu&&  $re['tinhtrang']==4 
		  {
			  $tongthu =  $tongthu + $re['psno'];
		   }
		  if ($re['loaithuchi'] == 2 ) // cac khoan chi&&  $re['tinhtrang']==4
		   {
			  $tongchi =  $tongchi + $re['psco'];
		   } 
	}*/
 	//========================================================

  if ($_SESSION["admintuan"])	echo  $sql ;
	 
 // echo  "Chờ tí nhé. đang chỉnh lại báo cáo tỉ lệ";  return ;
     
	
	//==============================================================	
	
	
	$mangnhanvien =taomang("userac","LOWER(MaNV)","ten"," where tinhluong = '1'  ") ;
	
	//in($mangnhanvien);
?>
   <style>
   
   .fixed-bottom{
	 position: -webkit-sticky;
	  position: sticky;
	  bottom:0;
	}
	 .fixed-top{
	 position: -webkit-sticky;
	  position: sticky;
	  top:-1px;
	}
	.fixed-left{
	/* position: -webkit-sticky;
	  position: sticky;
	  z-index:1;
	  width:200px;*/
	}
	.td-fixed {
  left: 0px;
 
  z-index: 1;
  height: 25px;
}
   .fixed-top1 {	 position: -webkit-sticky;
	  position: sticky;
	  top:-10px;
}

.tbchuan th{
	height:90px;
	padding:0.3em;
	overflow:hidden;
	    font-size: 14px;
	white-space:pre-wrap;
	background-color:#F8E4CB !important;
	color:#000000;
}
#showtb{
		overflow: scroll;
    width: 100%; 
	 height: 450px;
    display: flex;

    flex-direction: row;
	}
	.td_l{
		   height: 100%;
					width: 170px;
					display: flex;
					    align-items: center;
					overflow: ;
					white-space: ;
	}
	@media all and (min-width: 1280px) {
	#showtb{
		overflow: scroll;
    width: 100%; height: 500px;
    display: flex;

    flex-direction: row;
	}
	.td_l{
		   height: 100%;
					max-width: 100px;
					display: flex;
					    align-items: center;
					overflow: ;
					white-space: ;
	}
}
@media all and (min-width: 1366px) {
	#showtb{
		overflow: scroll;
    width: 100%;  height: 500px;
    display: flex;
padding:0.5em;
    flex-direction: row;
	}
	.td_l{
		   height: 100%;
					max-width: 150px;
					display: flex;
					    align-items: center;
					overflow: ;
					white-space: ;
	}
}
@media all and (min-width: 1440px) {
	#showtb{
		overflow: scroll;
    width: 100%;  height: 500px;
    display: flex;

    flex-direction: row;
	}
	.td_l{
		   height: 100%;
					max-width: 180px;
					display: flex;
					    align-items: center;
					overflow: ;
					white-space: ;
	}
}
@media all and (min-width: 1600px) {
	#showtb{
		overflow: scroll;
    width: 100%; height: 450px;
    display: flex;

    flex-direction: row;
	}
	.td_l{
		   height: 100%;
					max-width: 180px;
					display: flex;
					    align-items: center;
					overflow: ;
					white-space: ;
	}
}
@media all and (min-width: 1920px) {
	#showtb{
		overflow: scroll;
  width: 100%;
   height: 550px;
    display: flex;

    flex-direction: row;
	}
}
@media all and (min-width: 2560px) {
	#showtb{
		overflow: scroll;
    width: 100%; height: 60%;
    display: flex;

    flex-direction: row;
	}
	.td_l{
		   height: 100%;
					max-width: 500px;
					display: flex;
					    align-items: center;
					overflow: ;
					white-space: ;
	}
}

#pagination{
	display:flex;
	    align-items: center;
    justify-content: center;
}
#pagination li{
	list-style-type:none
}
#pagination li button{
	    width: 30px;
    height: 30px;
    background-color: #03a9f4;
    border: none;
    border-radius: 5px;
    color: #ffffff;
	margin-left:0.5em;	
}
.chonsodong{
position:relative;

}
.chonsodong button{
	width:auto !important;
	
}
.chonsodong .select_sodong.show{
display: flex;
}
.chonsodong .select_sodong{
	position:absolute;
	padding:0.5em 0 0 0;
	border:1px solid #000000;
	top:-170px;
	    width: 150px;
		height:height: 160px;
    z-index: 1000;
	  backdrop-filter: blur(5px);
        -webkit-backdrop-filter: blur(5px);
	    display: none;
    flex-direction: column;
}
.chonsodong .select_sodong button{
	background-color:unset;
	padding:0.5em;
}
.chonsodong .select_sodong .select_sodong_item{
border-bottom:1px solid #000000;
}
.chonsodong .select_sodong button{
	background-color:unset !important;
	color:#000000 !important;
	
}
.chonsodong .select_sodong .select_sodong_item button:hover{
	color:#3399CC !important;
}
   </style>	
 	
    <div style="padding-bottom:5px;text-align:center"><span style="color:red"> Chữ màu đỏ các khoản chi,</span><span style="color:blue"> chữ màu xanh các khoản thu</span> </div>
	<?php

		if($mangOlDuyetAll[strtoupper($dinhkhoan)] && ($ql[2] || $ql[5] || $_SESSION["LoginID"]==7576)){
			?>
			<select name="select" id="thuquy"  onchange="goiduyetMutiple(this.value,'thuquy')" style="">
				<option value="0">Chưa duyệt</option>
				<option value="1">Chưa duyệt</option>
				<option value="2">Yêu cầu chỉnh sửa</option>
				  
				<option value="4">Duyệt</option>
				<option value="3">Không duyệt</option>
			  </select>
				
			
			<?php
		}
	
	?>
	<input type="hidden" name="totalpage" id="totalpage" value="<?php echo $totalpage; ?>" />
	  <div id="wrap_kq" style="display:flex;flex-direction: column;"> 
<div style="" id="showtb"  >
 
  <div class="table_left" style="width:auto;position: -webkit-sticky;
	  position: sticky;left:0;z-index:1;">
  
  <table  border="0" cellpadding="0" cellspacing="0" class="tbchuan table_bc" id="dopcccc" style="width:100%">
    <tr align="center" bgcolor="#F8E4CB" class="fixed-top1">
	<?php
		if($mangOlDuyetAll[strtoupper($dinhkhoan)]==true  && ($ql[2] || $ql[5] || $_SESSION["LoginID"]==7576)){
				?>
				 <th  width="26"  height="23" valign="middle" >
				 <input type="checkbox" id="checkMutiplall"  name="checkMutiplall" class="checkMutiplall"  style="cursor:pointer" onclick="checkSelectAll(event)" />
	  			</th> 
				<?php
		}
	?>
      <th  width="26"  height="23" valign="middle" >
	  <strong>STT</strong></th> 
	  
      <th width="37" valign="middle"  ><strong>Ngày Thu Chi </strong></th>
	    <th width="37" valign="middle"  ><strong>Ngày tải file </strong></th>
	   <th width="37" valign="middle"  ><strong>Số CT</strong></th>
      <th width="38" valign="middle" ><strong>Cửa Hàng</strong></th>
        <!-- <td width="79" valign="middle" ><strong>THU/</strong><strong>CHI</strong>
        </td>
   <td width="38" valign="middle" ><strong>Mã</strong></td>-->
      <th width="67" valign="middle" ><strong>Khoản mục thu/chi</strong></th>
      <th width="58" valign="middle" ><strong> Diễn giải</strong></th>
      <th width="35" valign="middle" ><strong>PS Nợ</strong></th>
      <th width="30" valign="middle"  ><strong>ĐVT</strong></th>
      <th width="33" valign="middle"  ><strong>SL</strong></th>
      <th width="29" valign="middle"  ><strong>Đơn giá</strong></th>
	    <?php if($ql[5]){ ?>
	    	<th width="29" valign="middle"  ><strong>TK nợ</strong></th>
		  <th width="29" valign="middle"  ><strong>TK có</strong></th>
		 
		 <?php }?>
      <th width="119" valign="middle"  style="border-right: 1px solid #ff7909 !important;"><strong>PS Có</strong></th>
     <!-- <td width="200" align="center"  ><strong>HĐBH</strong></td>
      <td width="200" align="center"  ><strong>STK NH</strong></td>
      <td width="200" align="center"  ><strong>Tên TK NH</strong></td>
      <td width="200" align="center"  ><strong>GHTK/Viettel/bưu điện</strong></td>
      <td width="200" align="center"  ><strong>Shopee</strong></td>
      <td width="200" align="center"  ><strong>Lazada</strong></td>
      <td width="200" align="center"  ><strong>Tiki</strong></td>
      <td width="200" align="center"  ><strong>NCC</strong></td>
      <td width="200" align="center"  ><strong>Họ và tên NV</strong></td>
      <td width="200" align="center"  ><strong>Mã NV</strong></td>
      <td width="200" align="center"  ><strong>Phiếu xuất</strong></td>
      <td width="200" align="center"  ><strong>Số phiếu pm</strong></td>
      <td width="200" align="center"  ><strong>Chứng từ</strong></td>
      <td width="150" align="center" ><strong>Tình Trạng</strong></td>
      <td width="55" align="center"  ><strong>Thủ Quỹ XN</strong></td>
      <td width="131" align="center"  ><strong>Kế Toán Online XN</strong></td>
      <td width="123" align="center"  ><strong>Kế Toán Của Hàng XN </strong></td>-->
    </tr>
    <?php
 //	$mangch = taomang ("cuahang","ID","macuahang");
	 $result = $data->query($sql); 
$tong=0;$tongsl=0; $r = $start ; $ngaytao = gmdate('Y-n-d H:i:s', time() + 7*3600) ;

  $cuahangtruong= 1; $giamsat= 2; $ketoan= 3;  // 4 là 12   5 là 13   6  là 23  7 là 123 
   //$mangchucvu =taomang("kh_chucvu","ID","Name"," where 1  ") ;
  $tongtien =0;
  $chuoihtml='';
   $chuoipx='';
  $chuoiql='';
  $chuoiqlcheck=0;
    $chuoidhxn=0;
  $ngaynhap = gmdate('Y-n-d', time() + 7*3600) ; $mangtangca= array();  
  //  $tongthu = 0; 
	 // $tongchi=0;
  while($re = $data->fetch_array($result))
	{    $r++ ;
			
			/*if($re['loaithuchi']==1){
					 $tongthu+=(int)$re['psno'];
			}
			if($re['loaithuchi']==2){
					 $tongchi+=(int)$re['psco'];
			}*/
			$onclick='';
		  if($_SESSION["LoginID"]==7576){
		  	$onclick='onclick="getphieu('.$re['idthuchikt'].',\'poupduyet\')"';
		  }
		   
	$lydoN='';
 	     $mangtangca[$re['MaNV']]=1;
 		 if($mau=="white"){$mau="#EEEEEE";$hl="Normal4";$hl2="Highlight4";}else{$mau="white";$hl="Normal5";$hl2="Highlight5";} 
 	 		    $thuquy0='';$thuquy1='';$thuquy2='';$thuquy3='';$thuquy4='';
				$ketoanOnL0='';$ketoanOnL1='';$ketoanOnL2='';$ketoanOnL3='';$ketoanOnL4='';
				$ketoanCH0='';$ketoanCH1='';$ketoanCH2='';$ketoanCH3='';$ketoanCH4='';
				$tinhtrang=$re["tinhtrang"];
				$tinhtrangduyet="Chưa duyệt" ;
				$select1='';
				$select2='';
				 $select4='';
				 $select3='';
				 $showchinhsua=false;
				 $disabledall='';
				if($tinhtrang==4) {
					$tinhtrangduyet="Đã duyệt"; 
					$select4="selected='selected'";
					//$disable='disable';
				}  
				elseif ($tinhtrang==1 || $tinhtrang==0)  {
					$tinhtrangduyet="Chưa duyệt";
					 $select1="selected='selected'";
					 $select0="selected='selected'";
				 }  
				 elseif ($tinhtrang==3)  {
					$tinhtrangduyet="Không duyệt";
				 	$select3="selected='selected'";
				 }  
				  elseif ($tinhtrang==2)  {
					$tinhtrangduyet="Yêu cầu chỉnh sửa";
					 $select2="selected='selected'";
					 $showchinhsua=true;
				 } 
				 elseif ($tinhtrang==5){
				 	$tinhtrangduyet="Đã chỉnh sửa";
				 }
				  elseif ($tinhtrang==6){
				 	$tinhtrangduyet="Chờ thu mua duyệt";
					$disabledall="disabled='disabled'";
				 }
				 
				 //tài sản  6 mới tạo ben khác, tạo phiếu chi
				 // tài sản xác nhận =7 --> kết toán xác nhận =4
				 
				  
				$disabled='';
				
			if($tinhtrang==4 || $tinhtrang==3 ||$tinhtrang==2 ){
					//$disabled='disabled';
			} 
				
				/*$tam= "giamsat$giamsat='selected'; "; eval('$'.$tam);
 				$tam= "ketoan$ketoan='selected'; ";eval('$'.$tam);*/
				$sotien=$re['sotien'];
				$tongtien += $sotien ;
				
					 if ($re['loaithuchi'] == 2) // cac khoan chi
				  {
					  $mauchu ="red" ;
				  }
				  if ($re['loaithuchi'] == 1) // cac khoan thu
				  { 	   $mauchu ="blue" ; 
				  
				   } 
	$lydoN=$re["lydoN"]; 
	
	
	$hidden='';
		if($re["madkhoan"]=="DTBH"){
			$hidden="display:none";
			$tinhtrangduyet="";
		}
		
		$KXD="";
		if($mangtk[$re["tkco"]]=="KXD" || $mangtk[$re["tkno"]]=="KXD"){
			$KXD=true;
		}
		$isOnline=false;
		
		if($mangOlDuyetAll[strtoupper($dinhkhoan)]  && $mangOlDuyetAll[strtoupper($re["madkhoan"])]){
			
			$isOnline=true;
		}
		
		
		//updateSotienbill($tienthuchi,$tienbill,$soct,$c)
		$chuoicanhatlydo='';
	//onmouseout="this.className=\''.$hl.'\'" 
			$chuoihtml.=	'<tr  bgcolor="'.$mau.'" class="tb_tr tb_tr'.$re["idthuchikt"].'" data-id="'.$re["idthuchikt"].'"  style="color:'.$mauchu.'" '.$onclick.'><td  style="border-left: 1px solid #ff7909 !important; text-align:center" >';
			if($re["hdbh"]){
				$tttien=checksotienhoadon(trim($re["hdbh"]))['thanhtien'];
				
				/*if($re["psno"]){
					
					if(updateSotienbill($re["psno"],$tttien,$re['idthuchikt'],'psno',$re["dongia"])){
						$re["psno"]=abs($tttien);
						$re["dongia"]=abs($tttien);
					}
				}
				if($re["psco"]){
					//echo $tttien;
					if(updateSotienbill($re["psco"],$tttien,$re['idthuchikt'],'psco',$re["dongia"])){
						$re["psco"]=abs($tttien);
						$re["dongia"]=abs($tttien);
					}
				}*/
				$chuoihtml.=$re["hdbh"].'</br> Thành tiền: '.number_format($tttien);
				if($re["madkhoan"]=='CPTBNV'){
					$checkhdthuong=checkhoadonthuongduyet($re["hdbh"]);
					//var_dump($checkhdthuong);
					if($checkhdthuong['idhd']){
						$chuoihtml.='</br> Đã duyệt </br>Tiền thưởng: '.number_format($checkhdthuong['tienthuong']);
					}
				}
			}	
			else{
					$chuoihtml.='';
			}
		$chuoihtml.='</td>
      <td >';
	  
	   if($re["sotknh"]!=0){
	 	  $chuoihtml.=$re["sotknh"];
	   }
	   else{
	   		$chuoihtml.='';
	   }
	  
	  $chuoihtml.='</td>
      <td >'.$re["tentknh"].'</td>
	   <td >'.$re["donvivc"].'</td>
      ';
	$chuoihtml.='<td>'.$re["mavandon"];
	 /*if(checkLoaiMaVD($re["mavandon"])==1 || checkLoaiMaVD($re["mavandon"])==2 || checkLoaiMaVD($re["mavandon"])==3 ){ $chuoihtml.=$re["mavandon"]; } <td ></td> CheckVanChuyen
      <td ></td>
      <td ></td>*/
	 
	 $chuoihtml.='</td>';
	$chuoihtml.='<td style="color:green">';
	$dongvc='';
	if($re["hdbh"]){
		$dongvc=CheckVanChuyen($re["hdbh"]);
		//var_dump($dongvc); 
		 $chuoihtml.=$dongvc['mavd'];
	}
	
	 
	 $chuoihtml.='</td>';     
	  $chuoihtml.='<td>'.getten('nhacungcap',$re["NCC"],'Name').'</td>
      <td>'.$mangnhanvien[strtolower(trim($re["manv"]))].'</td>
      <td>'.$re["manv"].'</td>
      <td>';
	 	 if($re["phieuxuat"]!=0){
	   		$chuoihtml.=$re["phieuxuatf"];
	   }
	   else{
	   	$chuoihtml.='';
	   }
	  
	  $chuoihtml.='</td>';
	   $chuoihtml.='<td  align="center" title="phí thu khách hàng" >';
	   if($re["phithukh"] && $re["phithukh"]!=0){
	   		$chuoihtml.=number_format($re["phithukh"]);
	   }
	   else{
	   	$chuoihtml.=$re["phithukh"];
	   }
			 $chuoihtml.= '</td>';
		 $chuoihtml.='<td  align="center" title="phí thu khách hàng trên hệ thống" style="color:green">';
		 	if($re["hdbh"]){
				if($dongvc && $dongvc["phithukh"]!=''){
					$chuoihtml.=number_format($dongvc["phithukh"]);
					
				}
				else{
					$chuoihtml.="chưa có";
				}
			}	
		 $chuoihtml.='</td>';
		  $chuoihtml.='<td  align="center" title="" >'.$re['ghichuchitietts'].'</td>';
		   $chuoihtml.='<td  align="center" title="" >'.$re['nguoigiaots'].'</td>';
		    $chuoihtml.='<td  align="center" title="" >'.$re['nguoinhants'].'</td>';
			 $chuoihtml.='<td  align="center" title="" >'.$re['ngaybdts'].'</td>';
			 $chuoihtml.='<td  align="center" title="" >'.$re['ngayktts'].'</td>';
			 
			 $chuoihtml.='<td  align="center" title="" >'.$re['tents'].'</td>';
			 $chuoihtml.='<td  align="center" title="" >'.$mangnhomts[$re['nhomts']].'</td>';
	  if($tinhtrang==2){
    	  $chuoihtml.='<td  align="center" title="'.$re['tinhtrang'].'" style="cursor: pointer;" onclick="getphieu('.$re['idthuchikt'].',\'poupduyet\')" ><b id="tinhtrang_'.$re["idthuchikt"].'" >
        '.$tinhtrangduyet.'
      </b><br><span id="lydo_tingtrang'.$re["idthuchikt"].'">'.$re["lydoN"].'</span></td>';
	  }
	  else{
	  	  $chuoihtml.='<td  align="center" title="'.$re['tinhtrang'].'" ><b id="tinhtrang_'.$re["idthuchikt"].'" >
        '.$tinhtrangduyet.'
      </b><br><span id="lydo_tingtrang'.$re["idthuchikt"].'">'.$re["lydoN"].'</span></td>';
	  }
	  
	  $cktk=false;
    	/*if($r==1){
			 $re["madkhoan"]="CK";
		}*/
		if($re["madkhoan"]=='CK' || $re["madkhoan"]=='TK'){
				 $cktk=true;
		
		}
		
			$nhanvienxacnhan=[];
				if(trim($re["nguoixn"])){
					for($i=0;$i<strlen($re["nguoixn"]);$i++){
						
						array_push($nhanvienxacnhan,$re["nguoixn"][$i]);
					}
					//echo $nhanvienxacnhan;
				}
				/*echo "<pre>";
				var_dump($nhanvienxacnhan);
				echo "</pre>";*/
				
			if($ql[5] || $ql[4] || $ql[3] || $ql[2] || $ql[1]){
			$xn_='';
				if($re["phieuxuat"]){
					$xn_='dieuhang';
				}
				if(in_array(1,$nhanvienxacnhan)){
					$xn_='thuquy';
				}
				if(in_array(2,$nhanvienxacnhan)){
					$xn_='ketoanol';
				}
				if(in_array(3,$nhanvienxacnhan)){
					$xn_='ketoanch';
				}
				$chuoicanhatlydo.='<td><button onclick="capnhatlydo('.$re['idthuchikt'].',\''.$xn_.'\')">Cập nhật</button></td>';
			}
			
	//echo  $re["madkhoan"];
	if(!$ql[5]){
			
			if((($re["phieuxuat"]!=0 && $ql[1]) || ($cktk&& $ql[1])) || $_SESSION["LoginID"]==7576 || in_array(4,$nhanvienxacnhan))  {
			 
				$chuoihtml.=' <td valign="middle" align="center" style="max-width:150px;min-width:150px">';
			 $chuoihtml.='<select name="select" id="dieuhang'.$re['idthuchikt'].'"  onchange="goiduyet('.$re["idthuchikt"].',this.value,\'dieuhang\',\''.$KXD.'\',\''.$re["madkhoan"].'\')" '.$disabled.' '.$disabledall.' style="'.$hidden.'">
            <option value="0"  '.$select0.' >Chưa duyệt</option>
			<option value="1" '.$select1.' >Chưa duyệt</option>
			  <option value="2"  '.$select2.' >Yêu cầu chỉnh sửa</option>
            <option value="4"  '.$select4.' >Duyệt</option>
            <option value="3"  '.$select3.' >Không duyệt</option>
          </select> <br />';
			   if($tinhtrang==3 || $tinhtrang==2 || $tinhtrang==1){
					$chuoihtml.='<br><span id="lydodieuhang'.$re['idthuchikt'].'">'.$re["lydoN"].'</span>';
				}
				else{
					$chuoihtml.='<br><span id="lydodieuhang'.$re['idthuchikt'].'"></span>';
				}
				if($chuoidhxn<1){
					 $chuoipx.='<th  align="center"  style="max-width:150px;min-width:150px"><strong>Điều Hàng XN</strong></th>';
					 $chuoidhxn=1;
				 }
			  $chuoihtml.='</td>';
			 
         
		}
		else{
			/*if($chuoidhxn<1){
						 $chuoipx.='<th  align="center"  style="max-width:150px;min-width:150px"><strong>Điều Hàng XN</strong></th>';
						 $chuoidhxn=1;
					 }*/
				//$chuoihtml.=' <td valign="middle" align="center" style="max-width:150px;min-width:150px"></td>';
			}
			if(((in_array(1,$nhanvienxacnhan) && $ql[2]) || ($cktk && $ql[2])) || $_SESSION["LoginID"]==7576 ) {
			 
				$chuoihtml.=' <td valign="middle" align="center" style="max-width:150px;min-width:150px">';
				 $chuoihtml.='<select name="select" id="thuquy'.$re['idthuchikt'].'"  onchange="goiduyet('.$re["idthuchikt"].',this.value,\'thuquy\',\''.$KXD.'\',\''.$re["madkhoan"].'\')" '.$disabled.' '.$disabledall.' style="'.$hidden.'">
				<option value="0"  '.$select0.' >Chưa duyệt</option>
				<option value="1" '.$select1.' >Chưa duyệt</option>
				<option value="2"  '.$select2.' >Yêu cầu chỉnh sửa</option>
				  
				<option value="4"  '.$select4.' >Duyệt</option>
				<option value="3"  '.$select3.' >Không duyệt</option>
			  </select> <br />';
				   if($tinhtrang==3 || $tinhtrang==2 || $tinhtrang==1){
						$chuoihtml.='<br><span id="lydothuquy'.$re['idthuchikt'].'">'.$re["lydoN"].'</span>';
					}
					else{
					$chuoihtml.='<br><span id="lydothuquy'.$re['idthuchikt'].'"></span>';
					}
					 if($chuoiqlcheck<2){ 
						 $chuoiql.='<th  align="center"  style="max-width:150px;min-width:150px"><strong>Thủ Quỹ XN</strong></th>';
						 $chuoiqlcheck=2;
					 }
				  $chuoihtml.='</td>';
				 
			 	
			}
			 
		 
			 if(((in_array(2,$nhanvienxacnhan) && $ql[3]) || ($cktk && $ql[2])) || $_SESSION["LoginID"]==7576  ) { 
			  $chuoihtml.='<td valign="middle" align="center" style="max-width:150px;min-width:150px">';
				  $chuoihtml.='<select id="ketoanol'.$re['idthuchikt'].'" name="'.$re['idthuchikt'].'"  onchange="goiduyet('.$re["idthuchikt"].',this.value,\'ketoanol\',\''.$KXD.'\',\''.$re["madkhoan"].'\')" '.$disabled.' '.$disabledall.' style="'.$hidden.'">
				  <option value="0" '.$select0.' >Chưa duyệt</option>
					<option value="1" '.$select1.' >Chưa duyệt</option>
					  <option value="2"  '.$select2.' >Yêu cầu chỉnh sửa</option>
					<option value="4"  '. $select4.' >Duyệt</option>
					<option value="3"  '. $select3.' >Không duyệt</option>
				  </select>';
					  if($tinhtrang==3 || $tinhtrang==2 || $tinhtrang==1){
						$chuoihtml.='<br><span id="lydoketoanol'.$re['idthuchikt'].'">'.$re["lydoN"].'</span>';
					 }
					 else{
						$chuoihtml.='<br><span id="lydoketoanol'.$re['idthuchikt'].'"></span>';
					 }
				if($chuoiqlcheck<3){
			
						 $chuoiql.='<th  align="center"  style="max-width:150px;min-width:150px"><strong>Kế Toán Online XN</strong></th>';
						  $chuoiqlcheck=3;
				}
				$chuoihtml.='</td>';
				
		   }
		  
			 
	  
		 
			 if( ((in_array(3,$nhanvienxacnhan) && $ql[4]) || ($cktk && $ql[2]))  || $_SESSION["LoginID"]==7576 ) {  
			  $chuoihtml.='<td valign="middle" align="center" style="max-width:150px;min-width:150px">';
			   $chuoihtml.='<select id="ketoanch'.$re['idthuchikt'].'" name="'.$re['idthuchikt'].'"  onchange="goiduyet('.$re["idthuchikt"].',this.value,\'ketoanch\',\''.$KXD.'\',\''.$re["madkhoan"].'\')" '.$disabled.' '.$disabledall.' style="'.$hidden.'">
				<option value="0" '.$select0.' >Chưa duyệt</option>
				<option value="1" '.$select1.' >Chưa duyệt</option>
				  <option value="2"  '.$select2.' >Yêu cầu chỉnh sửa</option>
				<option value="4"  '. $select4.' >Duyệt</option>
				<option value="3"  '. $select3.' >Không duyệt</option>	
			  </select>';
				 if($tinhtrang==3 || $tinhtrang==2 || $tinhtrang==1){
					$chuoihtml.='<br><span id="lydoketoanch'.$re['idthuchikt'].'">'.$re["lydoN"].'</span>';
				 }
				 else{
				 
					 $chuoihtml.='<br><span id="lydoketoanch'.$re['idthuchikt'].'"></span>';
				 }
				   if($chuoiqlcheck<4){
					  $chuoiql.='<th  align="center"  style="max-width:150px;min-width:150px"><strong>Kế Toán Của Hàng XN </strong></th>  ';
					  
				  $chuoiqlcheck=4;
				 $chuoihtml.='</td>';
				
			 } 
			  
				
		}
	
	}
	else if($ql[5] ){
	
		
		if($re["phieuxuat"]!=0 || $_SESSION["LoginID"]==7576 || $cktk || in_array(4,$nhanvienxacnhan)) {
		 
				$chuoihtml.=' <td valign="middle" align="center" style="max-width:150px;min-width:150px">';
			 $chuoihtml.='<select name="select" id="dieuhang'.$re['idthuchikt'].'"  onchange="goiduyet('.$re["idthuchikt"].',this.value,\'dieuhang\',\''.$KXD.'\',\''.$re["madkhoan"].'\')" '.$disabled.' '.$disabledall.' style="'.$hidden.'">
            <option value="0"  '.$select0.' >Chưa duyệt</option>
			<option value="1" '.$select1.' >Chưa duyệt</option>
			  <option value="2"  '.$select2.' >Yêu cầu chỉnh sửa</option>
            <option value="4"  '.$select4.' >Duyệt</option>
            <option value="3"  '.$select3.' >Không duyệt</option>
          </select> <br />';
			   if($tinhtrang==3 || $tinhtrang==2 || $tinhtrang==1){
						$chuoihtml.='<br><span id="lydodieuhang'.$re['idthuchikt'].'">'.$re["lydoN"].'</span>';
				}
				else{
					$chuoihtml.='<br><span id="lydodieuhang'.$re['idthuchikt'].'"></span>';
				}
				if($chuoidhxn<1){
					 $chuoipx.='<th  align="center"  style="max-width:150px;min-width:150px"><strong>Điều Hàng XN</strong></th>';
					 $chuoidhxn=1;
				 }
			  $chuoihtml.='</td>';
			
         
		}
		else{
			if($chuoidhxn<1){
					 $chuoipx.='<th  align="center"  style="max-width:150px;min-width:150px"><strong>Điều Hàng XN</strong></th>';
					 $chuoidhxn=1;
				 }
			$chuoihtml.=' <td valign="middle" align="center" style="max-width:150px;min-width:150px"></td>';
		}
		$chuoihtml.=' <td valign="middle" align="center" style="max-width:150px;min-width:150px">';
			if(in_array(1,$nhanvienxacnhan) || $_SESSION["LoginID"]==7576 || $cktk) {
			 
				
				 $chuoihtml.='<select name="select" id="thuquy'.$re['idthuchikt'].'"  onchange="goiduyet('.$re["idthuchikt"].',this.value,\'thuquy\',\''.$KXD.'\',\''.$re["madkhoan"].'\')" '.$disabled.' '.$disabledall.' style="'.$hidden.'">
				<option value="0"  '.$select0.' >Chưa duyệt</option>
				<option value="1" '.$select1.' >Chưa duyệt</option>
				  <option value="2"  '.$select2.' >Yêu cầu chỉnh sửa</option>
				<option value="4"  '.$select4.' >Duyệt</option>
				<option value="3"  '.$select3.' >Không duyệt</option>
			  </select> <br />';
				   if($tinhtrang==3 || $tinhtrang==2 || $tinhtrang==1){
						$chuoihtml.='<br><span id="lydothuquy'.$re['idthuchikt'].'">'.$re["lydoN"].'</span>';
					}
					else{
						$chuoihtml.='<br><span id="lydothuquy'.$re['idthuchikt'].'"></span>';
					}
					 
				
			 
			}
			if($chuoiqlcheck<2){ 
						 $chuoiql.='<th  align="center"  style="max-width:150px;min-width:150px"><strong>Thủ Quỹ XN</strong></th>';
						 $chuoiqlcheck=2;
					 }
			   $chuoihtml.='</td>';
				  $chuoihtml.='<td valign="middle" align="center" style="max-width:150px;min-width:150px">';
		 
			 if(in_array(2,$nhanvienxacnhan) || $_SESSION["LoginID"]==7576 || $cktk ) { 
			 
				  $chuoihtml.='<select id="ketoanol'.$re['idthuchikt'].'" name="'.$re['idthuchikt'].'"  onchange="goiduyet('.$re["idthuchikt"].',this.value,\'ketoanol\',\''.$KXD.'\',\''.$re["madkhoan"].'\')" '.$disabled.' '.$disabledall.' style="'.$hidden.'">
					<option value="0" '.$select0.' >Chưa duyệt</option>
					<option value="1" '.$select1.' >Chưa duyệt</option>
					  <option value="2"  '.$select2.' >Yêu cầu chỉnh sửa</option>
					<option value="4"  '. $select4.' >Duyệt</option>
					<option value="3"  '. $select3.' >Không duyệt</option>
				  </select>';
					  if($tinhtrang==3 || $tinhtrang==2 || $tinhtrang==1){
						$chuoihtml.='<br><span id="lydoketoanol'.$re['idthuchikt'].'">'.$re["lydoN"].'</span>';
					 }
					 else{
					 	$chuoihtml.='<br><span id="lydoketoanol'.$re['idthuchikt'].'"></span>';
					 }
				
				
		   }
		  if($chuoiqlcheck<3){
			
						 $chuoiql.='<th  align="center"  style="max-width:150px;min-width:150px"><strong>Kế Toán Online XN</strong></th>';
						  $chuoiqlcheck=3;
				}
				
			 $chuoihtml.='</td>';
	  
		  $chuoihtml.='<td valign="middle" align="center" style="max-width:150px;min-width:150px">';
			 if(in_array(3,$nhanvienxacnhan)|| $_SESSION["LoginID"]==7576 || $cktk) {  
			 
			   $chuoihtml.='<select id="ketoanch'.$re['idthuchikt'].'" name="'.$re['idthuchikt'].'"  onchange="goiduyet('.$re["idthuchikt"].',this.value,\'ketoanch\',\''.$KXD.'\',\''.$re["madkhoan"].'\')" '.$disabled.' '.$disabledall.' style="'.$hidden.'">
				<option value="0" '.$select0.' >Chưa duyệt</option>
				<option value="1" '.$select1.' >Chưa duyệt</option>
				  <option value="2"  '.$select2.' >Yêu cầu chỉnh sửa</option>
				<option value="4"  '. $select4.' >Duyệt</option>
				<option value="3"  '. $select3.' >Không duyệt</option>
			  </select>';
				 if($tinhtrang==3 || $tinhtrang==2 || $tinhtrang==1){
					$chuoihtml.='<br><span id="lydoketoanch'.$re['idthuchikt'].'">'.$re["lydoN"].'</span>';
				 }
				 else{
				 	$chuoihtml.='<br><span id="lydoketoanch'.$re['idthuchikt'].'"></span>';
				 }
				  
			 
				
		}
			if($chuoiqlcheck<4){
					  $chuoiql.='<th  align="center"  style="max-width:150px;min-width:150px"><strong>Kế Toán Của Hàng XN </strong></th>  ';
					  
				  $chuoiqlcheck=4;
				
			 } 
		  $chuoihtml.='</td>';
	}
		$chuoihtml.=$chuoicanhatlydo;  
     $chuoihtml.='</tr>';

	 ?>
	 <!--onmouseout="this.className='-->
    <tr  class="tb_tr tb_tr<?=$re["idthuchikt"]?>" data-id="<?=$re["idthuchikt"]?>"  bgcolor="<?php echo $mau ;?>"  style="color:<?=$mauchu?>">
	<?php
		if($isOnline  && ($ql[2] || $ql[5] || $_SESSION["LoginID"]==7576)){
		//echo "ok";
		?>
		
		 	 <td  align="right" ><input type="checkbox" id="checkMutipl<?php echo $re["idthuchikt"];?>"  name="checkMutipl<?php echo $re["idthuchikt"];?>" class="checkMutipl" value="<?php echo $re["madkhoan"]."-".$re["idthuchikt"]?>" style="cursor:pointer" <?php echo $disabled; ?> /></td>
		<?php
		}
	
	?>
      <td  align="right" ><?php echo $r ;?></td>
	  
      <td ><?php echo $re['ngaythuchikt'] ;?></td>
	   <td ><?php echo $re['ngaytao'] ;?></td>
	   <td ><?php echo $re['sochungtu'] ;?></td>
      <td ><?php echo $re['tencuahang'] ;?></td>
      
      <td ><?php echo "<span style=' ' class='td_l'>".$re["khoanmuctc"]."</span>";?></td>
      <td ><?php echo "<span style='' class='td_l'>".$re["diengiai"]."</span>";?></td>
	 
      <td ><?php echo $re["psno"]?number_format($re["psno"]):0;?></td>
      <td ><?php echo $re["donvi"];?></td>
      <td ><?php echo $re["soluong"];?></td>
      <td ><?php echo $re["dongia"]?number_format($re["dongia"]):"";?></td>
	  <?php if($ql[5]){ ?>
	   <td ><?php echo $mangtk[$re["tkno"]];?></td>
	   <td ><?php echo  $mangtk[$re["tkco"]];?></td>
	   
	   
	   <?php }?>
      <td style="border-right: 1px solid #ff7909 !important;">
		  <?php echo $re["psco"]?number_format($re["psco"]):0;?></td>
      
    </tr>
    <?php	 			

	}
?>
  </table>
  </div>
  <div class="table_right" style="width:auto">
  <table  border="0" cellpadding="0" cellspacing="0" class="tbchuan table_bc" id="dopcccc1">
  	<tr bgcolor="#F8E4CB" class="fixed-top1">
	<th align="center" style="border-left: 1px solid #ff7909 !important;" ><strong>HĐBH</strong></th>
      <th  align="center"  ><strong>STK NH</strong></th>
      <th  align="center"  ><strong>Tên TK NH</strong></th>
	   <th  align="center"  ><strong>Đơn vị vận chuyển</strong></th>
      <th  align="center"  ><strong>Mã vận đơn</strong></th>
	   <th  align="center"  ><strong>Mã vận đơn HT</strong></th>
      <!--<th  align="center"  ><strong>Shopee</strong></th>
      <th align="center"  ><strong>Lazada</strong></th>
      <th  align="center"  ><strong>Tiki</strong></th>-->
      <th align="center"  ><strong>NCC</strong></th>
      <th  align="center"  ><strong>Họ và tên NV</strong></th>
      <th  align="center"  ><strong>Mã NV</strong></th>
      <th  align="center"  ><strong>Phiếu xuất</strong></th>
	  <th  align="center"  ><strong>Phí Thu KH</strong></th>
	    <th  align="center"  ><strong>Phí Thu KH HT</strong></th>
		  <th  align="center"  ><strong>Ghi chú chi tiết</strong></th>
		   <th  align="center"  ><strong>Người giao</strong></th>
		    <th  align="center"  ><strong>Người nhận</strong></th>
			<th  align="center"  ><strong>ngày bắt đầu TS</strong></th>
			<th  align="center"  ><strong>ngày kết thúc TS</strong></th>
			<th  align="center"  ><strong>tên ts</strong></th>
			<th  align="center"  ><strong>nhóm ts</strong></th>
      <th  align="center" width="200px" ><strong>Tình Trạng</strong></th>
	  <?=$chuoipx?>
	 <?=$chuoiql?>
	  <?php
	  	if($ql[5] || $ql[4] || $ql[3] || $ql[2] || $ql[1]){
			?>
				<th  align="center" width="200px" ><strong>Cập nhật lý do</strong></th>
			<?php	
		
		}
	  
	  ?>
       </tr>
	  <?=$chuoihtml?>
	 
  </table>

</div>

</div>
<?php echo $chuoiphantrang; 

?>

  <br />
<div style="margin-top:">

	 <?php //$tongton=10000000;
	/* var_dump($tongton);
		var_dump(number_format($tongton));
		 var_dump($tongthu);
		var_dump(number_format($tongthu));
		 var_dump($tongchi);
		var_dump(number_format($tongchi));*/
	  if ( $numrow != 0 ) {$conlai = $tongthu - $tongchi;?>	
		
   <table width="100%" cellpadding="1" cellspacing="1" border="0" >
    <tr><td  ><strong>SDDK</strong> </td>
 <td>: <?php echo  formatso($tongton) ?></td><td><strong><?php echo  " ( ". doiso($tongton) ." ) " ;  ?></strong> 
</td>
 </tr>
 <tr>
  <td width="92"  >   
  <b>  Tổng PS nợ </b> </td>
  <td width="118">: <?php echo  formatso($tongthu) ?></td><td width="998">
  <strong><?php echo  " ( ". doiso($tongthu) ." ) " ;  ?></strong></td>
  </tr>
  <tr><td  ><b> Tổng PS có</b> </td><td>: 
    <?php echo  formatso($tongchi) ?> </td><td> <strong><?php echo  "( ". doiso($tongchi) ." ) " ;  ?></strong> 
   </td>
  </tr>

<tr><td  > 
  <strong>SDCK</strong></td>
<td>:   
  <?php echo  formatso($conlai+$tongton) ?></td><td> <strong><?php echo  "( ". doiso($conlai+$tongton) ." )" ;  ?> </strong>
    
</td></tr>  
</table>  
<?php }

?>
</div> 

</div>


<?php				
    $data->closedata() ;
	
function gettennv($table,$ID,$cot)
{
   global $data ;
 	$sql = "select ID,$cot from $table where  MaNV='$ID' " ;
		
     $result = $data->query($sql) ;
 	$row = $data->fetch_array($result);	
	// echo  $sql ;			
		return $row[$cot] ;		
}

function checkLoaiMaVD($ma){

	if(is_numeric($ma)){
		return 1;//viettel
	}
	else if(substr($ma,(strlen($ma)-2),2)=='VN'){
		return 2; //Bưu điện
	}
	else if($ma[0]=='S'){
		return 3; //GHTK
	}
}


function checksotienhoadon($soct){
	
$sql="select sum(DonGia) as tongtiendg,(sum(ceil(a.DonGia*(1-1*a.chietkhau/100))*a.SoLuong)-b.tigia)
  as thanhtien from xuatbanhang a left join phieunhapxuat b on a.IDphieu=b.ID where b.SoCT='$soct' group by a.IDphieu ";
global $data;
$dong=getdong($sql);
	if($dong['tongtiendg']){
		return $dong;
	}
	else{
		return false;
	}
}

function updateSotienbill($tienthuchi,$tienbill,$idthuchikt,$c,$dg){
	global $data;
	if($tienthuchi==$tienbill){
		return;
	}
	
	if($tienthuchi<=(abs($tienbill)+5) && $tienthuchi>=(abs($tienbill)-5)){
		$tienbill=abs($tienbill);
			if($dg){
				$sql="update thuchikt set $c='$tienbill',dongia='$tienbill' where ID='$idthuchikt'";
			}
			else{
				$sql="update thuchikt set $c='$tienbill' where ID='$idthuchikt'";
			}	
		
		//echo $sql;
		$data->query($sql);
		return true;
	}
	return;
}
function checkhoadonthuongduyet($hdbh){
$sql="select a.IDHD as idhd,(a.sotien*(a.loaihuong/100)) as tienthuong from thuonghoadon a left join phieunhapxuat b on a.IDHD=b.ID where b.SoCT='$hdbh' and a.tinhtrang=44";

global $data;
$dong=getdong($sql);
if($dong['idhd']){
		return $dong;
	}
	else{
		return false;
	}

}


function CheckVanChuyen($sobill)
{
	global  $data;
    $sql = "SELECT  mavd, sobill,phithukh,madh from vanchuyenonline where sobill ='$sobill'";
  //echo $sql;
    $tam = getdong($sql);
	//var_dump($tam);
    return $tam;

}

?>
