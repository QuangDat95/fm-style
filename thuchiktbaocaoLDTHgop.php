<?php  
session_start();
 
 
 
 $root_path =getcwd()."/"  ;
 $quyen= $_SESSION["quyen"] ; 

 $ql =$quyen[$_SESSION["mangquyenid"][$_SESSION['act']]]  ;  
 //$ql='120000';
  $idl=$_SESSION["LoginID"];
 // var_dump($ql);
//var_dump($_SESSION["mangquyenid"]['baocaokhuyenmai']);
//$ql[5]=5;

 if( !($ql[0] || $idl==1) ){return;}
$wherequyen='';
if(!$ql[5]){
	if($ql[1]){
		$wherequyen=' and ( a.phieuxuat is not null and  a.phieuxuat <> "")';
		}
	else if($ql[2]){
		$wherequyen=' and d.xacnhan=1';
		
	}
	else if($ql[3]){
	
		$wherequyen=' and d.xacnhan=2';
	
	}
	else if($ql[4]){
		$wherequyen=' and d.xacnhan=3';
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
			 //echo $tu;
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
									   $dinhkhoanthuchi=rtrim($dinhkhoanthuchi,",");
									//echo $nguoixacnhan;
									if(!$limit){
										 $limit=20;
									}
								//echo $loai;
			//   var_dump($tmp);
			   //return;
			//echo  $data1;
			   ///++++++++++++++++++++++++++++++++++++++
			 if(!$curentpage){
			 	$curentpage=1;
			 }
			// $limit=20;
			 // $curentpage=1;
			
		 // if ($trang!=0  ) $limit  =  " LIMIT ". 10000*($trang-1) .", ". 10000*($trang); else $limit =" limit 10000";
		$sql_where="  WHERE 1 =1   "; 
		$sql_where2 = "" ;
		$sql_where3 = "" ;
		$sql_ton=" and  (a.luachon = '1' or a.luachon= '2' )";
				if($loai!=""){
					$sql_where.=" and a.luachon ='$loai'";
						$sql_ton.=" and a.luachon ='$loai'";
				}
			if($stknh != ""){ $sql_where.=" and a.sotknh ='$stknh'"; }
				if($tentknh != ""){ $sql_where.=" and a.tentknh ='$tentknh'"; $sql_ton.=" and a.tentknh ='$tentknh'"; }
				if($nguoixacnhan != ""){ 
					if($nguoixacnhan!=4){
						$sql_where.=" and d.xacnhan = '$nguoixacnhan'";
					}
					else if($nguoixacnhan==4){ 
						$sql_where.=" and a.phieuxuat is not null  and a.phieuxuat<> 0";
					}
				 }
				
				if($mavd != ""){ $sql_where.=" and a.mavandon = '$mavd'";  $sql_ton.=" and a.mavandon = '$mavd'"; }
				if($dvvc != ""){ $sql_where.=" and a.donvivc = '$dvvc'"; $sql_ton.=" and a.donvivc = '$dvvc'"; }
				//if($ncc != ""){ $sql_where.=" and e.Name like '%$ncc%'"; $sql_ton.=" and e.Name like '%$ncc%'"; }
				if($ngaytaotu != ""  && $ngaytaoden==""){ $sql_where.=" and a.ngaytao >='$ngaytaotu'"; $sql_ton.=" and a.ngaytao < '$ngaytaotu'"; }
				//if($ngaytaotu == ""  && $ngaytaoden==""){$sql_ton.=" and a.ngaytao < '1001-01-01'"; }
				if($ngaytaotu != ""  && $ngaytaoden!=""){ $sql_where.=" and a.ngaytao >='$ngaytaotu' and a.ngaytao <='$ngaytaoden'";}
				/*if($phieuxuat != ""){ $sql_where.=" and f.SoCT = '$phieuxuat'";  $sql_ton.=" and f.SoCT = '$phieuxuat'"; }*/
				//if($tkno != ""){ $sql_where.=" and a.tkno = '$manv'"; }
				//if($tkco != ""){ $sql_where.=" and c.manv = '$manv'"; }
				if($dinhkhoan != ""){ $sql_where.=" and (d.ma = '$dinhkhoan' or d.ten like '%$dinhkhoan%')"; $sql_ton.=" and (d.ma = '$dinhkhoan' or d.ten like '%$dinhkhoan%')"; }
				if($psno != ""){ $sql_where.=" and a.psno = '$psno'"; $sql_ton.=" and a.psno = '$psno'"; }
				if($psco != ""){ $sql_where.=" and a.psco = '$psco'"; $sql_ton.=" and a.psco = '$psco'"; }
				if($dongia != ""){ $sql_where.=" and a.dongia = '$dongia'";  $sql_ton.=" and a.dongia = '$dongia'"; }
				if($soluong != ""){ $sql_where.=" and a.soluong = '$soluong'"; $sql_ton.=" and a.soluong = '$soluong'"; }
				if($dvt != ""){ $sql_where.=" and a.donvi = '$dvt'";  $sql_ton.=" and a.donvi = '$dvt'"; }
				if($diengiai != ""){ $sql_where.=" and a.note = '$diengiai'"; $sql_ton.=" and a.note = '$diengiai'"; }
				
		/*if($manv != ""){ $sql_where.=" and c.manv = '$manv'"; $sql_ton.=" and c.manv = '$manv'"; }
		if($ten != ""){ $sql_where.=" and c.ten = '$ten'"; $sql_ton.=" and c.ten = '$ten'"; }*/
		if($sotien >0 ){ $sql_where.=" and a.sotien = '$sotien'"; $sql_ton.=" and a.sotien = '$sotien'"; }
		if($soct !='' ){ $sql_where.=" and a.sochungtu = '$soct'"; $sql_ton.=" and a.sochungtu = '$soct'"; }
		if($kho != "")
		{
   			$sql_where.=" and a.loaitk =  '$kho' ";
			$sql_ton.=" and a.loaitk =  '$kho' ";
 		}
		
		/*else if($_SESSION["loai_user"]==16)
		{
			$sql_where.=" and c.idtinh =  '$kho' ";
			$sql_ton.=" and c.idtinh =  '$kho' ";
		}*/
		/*if($dinhkhoanthuchi){
			$sql_where.=" and d.ID in ($dinhkhoanthuchi) ";
			$sql_ton.=" and d.ID  in ($dinhkhoanthuchi) ";
		}*/
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
			 else if($tinhtrang ==1){ $sql_where.= " and  a.tinhtrang=1";  $sql_ton.= " and  a.tinhtrang=1"; } //chưa duyệt cso lyd do
			 else if($tinhtrang ==5){ $sql_where.= " and  a.tinhtrang=5"; $sql_ton.= " and  a.tinhtrang=5"; } // quan ly duyet
		}
		
	 $sql_where_chuaload ='';
	 if($tu!="")	
		{
		  $ngay=  explode('/',$tu);
	   	  if (strlen($ngay[1])== 1) {  $ngay[1] = "0".$ngay[1] ;  }
		  if (strlen($ngay[0])== 1) {  $ngay[0] = "0".$ngay[0] ;  } 
		    //$sql_where2 .= " and  p.Ngaytao>= '$ngay[2]-$ngay[1]-$ngay[0]'";
			//$sql_where3 .= " and  aa.NgayTao>= '$ngay[2]-$ngay[1]-$ngay[0]'";
		 	$sql_where  .= " and  a.ngaythuchi>= '$ngay[2]-$ngay[1]-$ngay[0]'";
		    $sql_where_chuaload  .= " and g.NgayNhap>= '$ngay[2]-$ngay[1]-$ngay[0]'";
		    $sql_ton  .= " and  a.ngaythuchi< '$ngay[2]-$ngay[1]-$ngay[0]'";
			$sql__nv  .= " and  ngaytao>= '$ngay[2]-$ngay[1]-$ngay[0]'";
		}
		else{
			//$sql_ton .= " and  a.ngaythuchi < '1001-01-01'";
		}
		
		if($den!="")	
		{
		  $ngay=  explode('/',$den);
	   	  if (strlen($ngay[1])== 1) {  $ngay[1] = "0".$ngay[1] ;  }
		  if (strlen($ngay[0])== 1) {  $ngay[0] = "0".$ngay[0] ;  } 
			//  $sql_where2 .= " and  p.Ngaytao<= '$ngay[2]-$ngay[1]-$ngay[0] 23:59'";
			//   $sql_where3 .= " and  aa.NgayTao<= '$ngay[2]-$ngay[1]-$ngay[0] 23:59'";
		  $sql_where  .= " and  a.ngaythuchi<= '$ngay[2]-$ngay[1]-$ngay[0] 23:59'";
		   $sql_where_chuaload  .= " and  g.NgayNhap<='$ngay[2]-$ngay[1]-$ngay[0] 23:59'";
		     $sql__nv  .= " and  ngaytao<= '$ngay[2]-$ngay[1]-$ngay[0] 23:59'";
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
	$sqlnhanvien="select a.ID,a.MaNV,a.Ten from userac a left join (select IDNhanvien,SUBSTRING_INDEX(SUBSTRING_INDEX(thongtin,'*',-4),'*',1) as chucvu from nhanviendilam  where 1=1 $sql__nv  group by IDNhanvien,thongtin) b on a.ID=b.IDNhanvien where (a.ChucVu  in (767,766,765,768,689,688,1038,1039,738,763,684,703,773,784,972,1015,1001,1012,1012,1015,973,1038,1068) or b.chucvu in (767,766,765,768,689,688,1038,1039,738,763,684,703,773,784,972,1015,1001,1012,1012,1015,973,1038,1068))";
	$query=$data->query($sqlnhanvien);
	$mangnhanvien=[];
	$mangnhanviendaydu=[];
	while($re=$data->fetch_array($query)){
			$mangnhanvien[$re['ID']]=$re['ID'];
			$mangnhanviendaydu[$re['ID']]['MaNV']=$re['MaNV'];
			$mangnhanviendaydu[$re['ID']]['Ten']=$re['Ten'];
	}
   	$manglydotra = taomang ("lydotra","ma","Name"); 
	  
	 $sql_rows = "
SELECT count(distinct s.SoCT) as soluonghd,s.ma as malydotra,s.IDTao, s.diachiN,s.idchOL from 
(SELECT g.SoCT as SoCT,DATE_FORMAT(g.ngaynhap,'%d/%m/%y %h:%i:%s') as ngayhdbh, g.diachiN as diachiN,g.IDTao as IDTao,g.idchOL as idchOL,l.Name as lydotra,l.ma as ma FROM  phieubanhangluu g  left join lydotra l on g.tenkho=l.ID left join vanchuyenonline v on v.IDbill=g.ID left join cuahang b on g.IDkho=b.id left join customer k on k.ID=g.IDNhaCC where 1=1 ".$sql_where_chuaload."  and g.SoCT is not null and g.loai=3 (and g.tenkho <> '' and g.tenkho is not null) group by g.SoCT ORDER BY g.diachiN,g.IDtao,g.idchOL) s group by s.ma,s.diachiN,s.IDTao,s.idchOL 
";

//and (a.loaitk=1105 or a.loaitk=1137)
	 /* $sql_rows = "SELECT count(g.SoCT) as soluonghd,DATE_FORMAT(g.ngaynhap,'%d/%m/%y %h:%i:%s') as ngayhdbh, g.diachiN,g.IDTao,g.idchOL,l.Name as lydotra,count(l.ma) as slydo,l.ma as malydotra
FROM thuchikt a left join phieubanhangluu g on a.hdbh=g.SoCT  left join lydotra l on g.tenkho=l.ID left join vanchuyenonline v on v.IDbill=g.ID  left join cuahang b on a.loaitk=b.id  left join userac c on a.IDtao = c.ID 
  left join dinhkhoanthuchi d on d.ID = a.IDcha left join nhacungcap e on a.NCC=e.ID left join phieuxuat  f on a.phieuxuat=f.ID  left join customer k on k.ID=g.IDNhaCC    
	".$sql_where." and (a.loaitk=1105 or a.loaitk=1137 ) and g.SoCT is not null and g.loai=3 group by l.ma,g.diachiN,g.IDTao,g.idchOL ORDER BY g.diachiN  desc ";*/
	   	//$limit=20;
	 	 $start=($curentpage-1)*$limit;
		
		$sql = "SELECT count(distinct s.SoCT) as soluonghd,s.ma as malydotra,s.IDTao, s.diachiN,s.idchOL from 
(SELECT g.SoCT as SoCT,DATE_FORMAT(g.ngaynhap,'%d/%m/%y %h:%i:%s') as ngayhdbh, g.diachiN as diachiN,g.IDTao as IDTao,g.idchOL as idchOL,l.Name as lydotra,l.ma as ma FROM phieubanhangluu g  left join lydotra l on g.tenkho=l.ID left join vanchuyenonline v on v.IDbill=g.ID left join cuahang b on g.IDkho=b.id  left join customer k on k.ID=g.IDNhaCC where 1=1 ".$sql_where_chuaload."  and g.SoCT is not null and g.loai=3  (and g.tenkho <> '' and g.tenkho is not null)  group by g.SoCT ORDER BY g.diachiN,g.IDtao,g.idchOL) s group by s.ma,s.diachiN,s.IDTao,s.idchOL";


//======================================================
//======================================================


//limit $start,$limit
	if($_SESSION["LoginID"]==7576){
  		 echo "<br>".$sql ;
   }
//echo $sql;h.macuahang
 if($_SESSION['admintuan'] ) echo $sql ;
  //echo $sql;
	//$query_rows = $data->query($sql);
		$result_rows = $data->query($sql_rows);
		$numrow = $data->num_rows($result_rows);
		$totalpage=ceil($numrow/$limit);
		$chuoiphantrang=' <div class="pagi" style="position:relative"> <ul id="pagination">
		 <li><button value="F" onclick="phantrangAjax(1,3)">Đầu</button></li>
    <li><button value="-1" onclick="phantrangAjax(this.value,3)">«</button></li>';
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
				$min =$max-($totalpage - $buocnhay);
				
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
				$chuoiphantrang.='<li><button value="'.$i.'" onclick="phantrangAjax(this.value,3,16)" style="background-color:'.$mau.'">'.$i.'</button></li>';
		}
	
	
 $chuoiphantrang.='<li><button value="-2" onclick="phantrangAjax(this.value,1,16)">»</button></li>
  <li><button value="F" onclick="phantrangAjax('.$totalpage.',2,16)">Cuối</button></li>
  
 <li class="chonsodong"><button type="button" value="" onclick="showChondong()">Số dòng</button>
 	<div class="select_sodong"id="select_sodong">
		<div class="select_sodong_item"><button type="button" value="30" onclick="SendLimit(this.value,16)">30 dòng/trang</button></div>
		<div class="select_sodong_item"><button type="button" value="50" onclick="SendLimit(this.value,16)">50 dòng/trang</button></div>
		<div class="select_sodong_item"><button type="button" value="100" onclick="SendLimit(this.value,16)">100 dòng/trang</button></div>
		<div class="select_sodong_item"><button type="button" value="150" onclick="SendLimit(this.value,16)">150 dòng/trang</button></div>
		<div class="select_sodong_item"><button type="button" value="200" onclick="SendLimit(this.value,16)">200 dòng/trang</button></div>
		<div class="select_sodong_item"><input type="number" value="100" id="sodongnhap" nam="sodongnhap" onkeyup="SendLimitKeyup(event,16)" /></div>
		
	</div>
 
 </li>
  	</ul> 
	<button onclick="togglechuaload(true)" style="position:absolute;right:0;top:0">Phát hiện ('.$coutnchuaload.') phiếu chưa load</button>
	
	</div>
  </div>';
  
  
		$result = $data->query($sql);
		
	
  if ($_SESSION["admintuan"])	echo  $sql ;
	 
 // echo  "Chờ tí nhé. đang chỉnh lại báo cáo tỉ lệ";  return ;
     
	 
	//==============================================================	
	//$mangnhanvien =taomang("userac","ID","ten"," where tinhluong = '1'  ") ;
?>
   <style>
   #chuaload{
   	    position: fixed;
    width: 100%;
    height: 100vh;
    z-index: 100;
    top: 0;
    left: 0;
    display: none;
    justify-content: center;
    align-items: center;
	    backdrop-filter: blur(5px);
    -webkit-backdrop-filter: blur(5px);
	background-color: #00000033;
   }
    #chuaload >div{ 
   	   padding:1em;
    width: 60%;
    height: 500px;
	    background-color:#FFFFFF;
		border:1px solid #000000;
		position:relative;
		    height: 500px;
    overflow: scroll;
   }
   #btn_close_chuaload{
   	      display: flex;
    justify-content: flex-end;
    right: 0;
    z-index: 100;
    padding: 0.3em;
    font-size: 17px;
   }
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
   <?php echo $chuoichuaload;?>
 
	<input type="hidden" name="totalpage" id="totalpage" value="<?php echo $totalpage; ?>" />
	  <div id="wrap_kq" style="display:flex;flex-direction: column;"> 
<div style="" id="showtb"  >
 
  <div class="table_left" style="width:auto;position: -webkit-sticky;
	  position: sticky;left:0;z-index:1;    height: 480px;overflow:scroll" id="showtb_xuat">
  
  <table  border="0" cellpadding="0" cellspacing="0"  class="tbchuan table_bc" id="dopcccc" style="width:100%;border-collapse:collapse">
    <tr align="center" bgcolor="#F8E4CB" class="fixed-top1">
      <th  width="68"  height="23" valign="middle" >
	  <strong>STT</strong></th> 
	  
    
	    <th width="304" valign="middle"  ><strong>Tên nhân viên</strong></th>
	 
      <th width="186" valign="middle" ><strong>Mã nhân viên</strong></th> 
	  <?php
	  
	  	foreach($manglydotra as $key =>$value){
				?>
						 <th width="186" valign="middle" ><strong><?php echo $value;?></strong></th> 				
				<?php
		}
	?>
      
		<th width="153" valign="middle" ><strong>Tổng SL đơn</strong></th>
			  
    </tr>
    <?php

  $r = $start ;
 $mangthongtinnv=[];
 $tammang=[];
 $nvtam='';
 $nvtam1='';
  $nvtam2='';
 $tongdon=0;
  $r=0;
  
 $vongdau=false;
  while($re = $data->fetch_array($result))
	{   
	
		if($mangnhanviendaydu[$re["diachiN"]]){
			$mangthongtinnv[$re["diachiN"]]["lydo"][$re["malydotra"]]+=$re["soluonghd"];
			$mangthongtinnv[$re["diachiN"]]["tongdon"]+=$re["soluonghd"];
		}
		else if($mangnhanviendaydu[$re["IDTao"]]){
				$mangthongtinnv[$re["IDTao"]]["lydo"][$re["malydotra"]]+=$re["soluonghd"];
				$mangthongtinnv[$re["IDTao"]]["tongdon"]+=$re["soluonghd"];
		}else if($mangnhanviendaydu[$re["idchOL"]]){
			$mangthongtinnv[$re["idchOL"]]["lydo"][$re["malydotra"]]+=$re["soluonghd"];
			$mangthongtinnv[$re["idchOL"]]["tongdon"]+=$re["soluonghd"];
		}
		
		//if($mangthongtinnv[$re["idchOL"]]){
//			$mangthongtinnv[$re["idchOL"]]["tongdon"]+=$re["soluonghd"];
//		}else if($mangthongtinnv[$re["IDTao"]]){
//			$mangthongtinnv[$re["IDTao"]]["tongdon"]+=$re["soluonghd"];
//		}
//		else if($mangthongtinnv[$re["diachiN"]]){
//			$mangthongtinnv[$re["diachiN"]]["tongdon"]+=$re["soluonghd"];
//		}
//		else{
//			if(!$mangthongtinnv[$re["idchOL"]]){
//				$mangthongtinnv[$re["idchOL"]]["tongdon"]+=$re["soluonghd"];
//			}else if(!$mangthongtinnv[$re["IDTao"]]){
//				$mangthongtinnv[$re["IDTao"]]["tongdon"]+=$re["soluonghd"];
//			}
//			else if(!$mangthongtinnv[$re["diachiN"]]){
//				$mangthongtinnv[$re["diachiN"]]["tongdon"]+=$re["soluonghd"];
//			}
//		}
//		
		
		
		
		
		/*if($nvtam!=$re["diachiN"]){
			//$tammang[$re["malydotra"]]=$re["slydo"];
			$mangthongtinnv[$nvtam]=$tammang;
			$mangthongtinnv[$nvtam]["tongdon"]=$tongdon;
			$tongdon=0;
			 $tammang=[];
			 $nvtam=$re["diachiN"];
		}
		
		if($r==$numrow-1){
			$mangthongtinnv[$nvtam]=$tammang;
			$mangthongtinnv[$nvtam]["tongdon"]=$tongdon;
			
		}*/
			/*$tongdon+=$re["soluonghd"];
		 	$tammang[$re["malydotra"]]=$re["soluonghd"];*/
 		 		/*if($mau=="white"){$mau="#EEEEEE";$hl="Normal4";$hl2="Highlight4";}else{$mau="white";$hl="Normal5";$hl2="Highlight5";}
		 
			
			if($nvtam!=$re["diachiN"]){
			$chuoidong1.='<tr  class="tb_tr tb_tr'.$re["idthuchikt"].'" data-id="'.$re["idthuchikt"].'"  bgcolor="'.$mau.'"  style="color:'.$mauchu.'">
			<td>'.$r.'</td>';
				$nvtam=$re["diachiN"];
				$chuoidong1.='<td>'.$manguserten[$re["diachiN"]].'</td>
				<td>'.$manguser[$re["diachiN"]].'</td>';
				
				
				
			}
				
				$mangtongsoldonnv[$re["diachiN"]]+=$re["soluonghd"];
				foreach($manglydotra as $key =>$value){
					if($re["malydotra"]==$key){
						$chuoidong1.='<td style="color: #2196f3;
    font-weight: bold;">'.$re["slydo"].'</td>';
					}
					else{
						$chuoidong1.='<td>0</td>';
					}
				}
			if($nvtam!=$re["diachiN"]){	
				$chuoidong1.='<td  style="color: #2196f3;
    font-weight: bold;">'.$mangtongsoldonnv[$re["diachiN"]].'</td></tr>';
			 
			}*/
		$r++;
	
	}
	/*in($mangthongtinnv);
	return;*/
	$r=0;
	foreach($mangthongtinnv as $key => $value){
	
	if($mau=="white"){$mau="#EEEEEE";$hl="Normal4";$hl2="Highlight4";}else{$mau="white";$hl="Normal5";$hl2="Highlight5";}
	if($key!=0){
		if($mangnhanviendaydu[$key]){
				$r++;
				$chuoidong1.='<tr  class="tb_tr tb_tr" data-id=""  bgcolor="'.$mau.'"  style="color:'.$mauchu.'">
					<td>'.$r.'</td>';
					$chuoidong1.='<td>'.$mangnhanviendaydu[$key]['Ten'].'</td>
						<td>'.$mangnhanviendaydu[$key]['MaNV'].'</td>';
						foreach($manglydotra as $k =>$v){
							if($value["lydo"][$k]){
								$chuoidong1.='<td style="color: #2196f3;
			font-weight: bold;">'.$value["lydo"][$k].'</td>';
							}
							else{
								$chuoidong1.='<td>0</td>';
							}
						}
					$chuoidong1.='<td  style="color: #2196f3;
			font-weight: bold;">'.$mangthongtinnv[$key]['tongdon'].'</td></tr>';
			}
			
		}
	}
	
	echo $chuoidong1;
?>
  </table>
  </div>
 
</div>
<?php /* echo $chuoiphantrang;*/ ?>

 
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
	
$sql="select sum(DonGia) as tongtiendg,Round(sum((DonGia-(DonGia*chietkhau/100))*SoLuong)-b.tigia) as thanhtien 
from xuatbanhang a left join phieunhapxuat b on a.IDphieu=b.ID where b.SoCT='$soct' group by a.IDphieu ";
global $data;
$dong=getdong($sql);
	if($dong['tongtiendg']){
		return $dong;
	}
	else{
		return false;
	}
}


function checkhoadonthuongduyet($hdbh){

$sql="select a.IDHD as idhd,a.sotien as tienthuong from thuonghoadon a left join phieunhapxuat b on a.IDHD=b.ID where b.SoCT='$hdbh' and right(tinhtrang,1)=4";

global $data;
$dong=getdong($sql);
if($dong['idhd']){
		return $dong;
	}
	else{
		return false;
	}

}
?>
