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
//$ql[2]=1;
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
								//echo $nguoixacnhan;
									if(!$limit){
										 $limit=20;
									}
								
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
				
				
				if($dinhkhoan != ""){ $sql_where.=" and (d.ma = '$dinhkhoan' or d.ten like '%$dinhkhoan%')"; $sql_ton.=" and (d.ma = '$dinhkhoan' or d.ten like '%$dinhkhoan%')"; }
				if($psno != ""){ $sql_where.=" and a.psno = '$psno'"; $sql_ton.=" and a.psno = '$psno'"; }
				if($psco != ""){ $sql_where.=" and a.psco = '$psco'"; $sql_ton.=" and a.psco = '$psco'"; }
				if($dongia != ""){ $sql_where.=" and a.dongia = '$dongia'";  $sql_ton.=" and a.dongia = '$dongia'"; }
				if($soluong != ""){ $sql_where.=" and a.soluong = '$soluong'"; $sql_ton.=" and a.soluong = '$soluong'"; }
				if($dvt != ""){ $sql_where.=" and a.donvi = '$dvt'";  $sql_ton.=" and a.donvi = '$dvt'"; }
				if($diengiai != ""){ $sql_where.=" and a.note = '$diengiai'"; $sql_ton.=" and a.note = '$diengiai'"; }
				
		if($manv != ""){ $sql_where.=" and a.manv = '$manv'"; $sql_ton.=" and a.manv = '$manv'"; }
		
		if($sotien >0 ){ $sql_where.=" and a.sotien = '$sotien'"; $sql_ton.=" and a.sotien = '$sotien'"; }
		if($soct !='' ){ $sql_where.=" and a.sochungtu = '$soct'"; $sql_ton.=" and a.sochungtu = '$soct'"; }
		
		
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
		    $sql_ton  .= " and  month(a.ngaythuchi) < '$ngay[1]'";
		}
		else{
			$sql_ton .= " and a.ngaythuchi < '1001-01-01'";
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
		
 //  $mangtk = taomang ("dinhkhoan","ID","madinhkhoan");
   
   //$mangOlDuyetAll=taomang("dinhkhoanthuchi","ma","ID"," where duyetnhieu=1");
   //var_dump($mangOlDuyetAll);
  //$mangOlDuyetAll=array("KCKNBO","HCNVCOL","CNDHOL","DGNTDN","HDGNTDN");
  // var_dump($mangtk);
		// $mangcuahang= taomang("cuahang","ID","macuahang",'') ;
	 
	  $sql_rows = "SELECT DATE_FORMAT(a.ngaythuchi,'%d/%m/%Y') as ngaythuchikt,a.ngaythuchi,a.loaitk,sum(case when  a.luachon = 1 then round(a.psno) else -(round(a.psco)) end )as tong,b.macuahang as tencuahang,c.ma as matinh
 FROM thuchikt a left join dinhkhoanthuchi d on a.IDcha=d.ID left join cuahang b on a.loaitk=b.id left join tinh c on c.ID=b.Fax where 1=1 ".$sql_where." and b.IDNhomcc <> 8 and (d.ma='DTBH') group by a.ngaythuchi,a.loaitk order by  a.ngaythuchi desc";
	  
	   	if($limit==500){
			$limit=100000;
		
		}
		//echo($curentpage);
	 	 $start=($curentpage-1)*$limit;
		 
		$sql = "SELECT DATE_FORMAT(a.ngaythuchi,'%d/%m/%Y') as ngaythuchikt,a.ngaythuchi,a.loaitk,sum(case when  a.luachon = 1 then round(a.psno) else -(round(a.psco)) end )as tong,b.macuahang as tencuahang,c.ma as matinh
 FROM thuchikt a left join dinhkhoanthuchi d on a.IDcha=d.ID left join cuahang b on a.loaitk=b.id left join tinh c on c.ID=b.Fax where 1=1  ".$sql_where." and b.IDNhomcc <> 8 and  (d.ma='DTBH') group by a.ngaythuchi,a.loaitk order by  a.ngaythuchi desc limit $start,$limit";
//var_dump($sql);

 if($_SESSION['admintuan'] ) echo $sql ;
  if($_SESSION["LoginID"]==7576){
  		 echo "<br>".$sql ;
   }
	//	$query_rows = $data->query($sql);
		$result_rows = $data->query($sql_rows);
		$numrow = $data->num_rows($result_rows);
		$totalpage=ceil($numrow/$limit);
		$chuoiphantrang=' <div class="pagi"> <ul id="pagination">
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
	
	
 $chuoiphantrang.='<li><button value="-2" onclick="phantrangAjax(this.value,1)">»</li></button>
 
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
 <li>
 <input type="button" onclick="xuatexel(10)" name="search3" style="height:30px;margin-left:5px;" id="search3" value="Excel Doanh thu" />
 </li>
  	</ul> </div>
	
	
  </div>';
  
  
		$result = $data->query($sql);
		
	
  if ($_SESSION["admintuan"])	echo  $sql ;
	 ?>
   <style>
   
   .fixed-bottom{
	 position: -webkit-sticky;
	  position: sticky;
	  bottom:-7px;
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
	
	<input type="hidden" name="totalpage" id="totalpage" value="<?php echo $totalpage; ?>" />
	  <div id="wrap_kq" style="display:flex;flex-direction: column;"> 
<div style="" id="showtb"  >
 
  <div class="table_left" style="width:auto;position: -webkit-sticky;
	  position: sticky;left:0;z-index:1;">
  
  <table  border="0" cellpadding="0" cellspacing="0" class="tbchuan table_bc" id="dopcccc" style="width:100%">
    
    <?php
 //	$mangch = taomang ("cuahang","ID","macuahang");
	 $result = $data->query($sql); 
$r=0;
	$chuoihtml1='<tr bgcolor="#F8E4CB" class="fixed-top1"><th width="37" valign="middle"><strong>CH/Ngày</strong></th>';
	$chuoihtml2='<tr  bgcolor="#F8E4CB" class="fixed-top1">';
	$chuoihtml3='';
	$chuoihtml4='<tr align="center"  bgcolor="#2196f3">';
	$chuoihtml4tam='';
	$ngaythuchitam='';
	$dongdau=false;
	
	$sql="select a.ID,a.macuahang,b.ma as matinh from  cuahang a left join tinh b on a.Fax=b.ID where  a.IDNhomcc <> 8 and a.macuahang <> ''";
	$mangchKH=[];
	$mangchDN=[];
	$mangch=[];
	$query=$data->query($sql);
	while($re=$data->fetch_array($query)){
		if($re['matinh']=='DDN'){
			$chuoihtml1.='<th width="37" valign="middle"  ><strong>'.$re['macuahang'].'</strong></th>';
			$mangchDN[$re['ID']]=$re['macuahang'];
		}
		else{
			$chuoihtml2.='<th width="37" valign="middle"  ><strong>'.$re['macuahang'].'</strong></th>';
			$mangchKH[$re['ID']]=$re['macuahang'];
		}
				
	}
	$mangch=array_merge($mangchDN,$mangchKH);
	//in($mangch);
	// chuỗi htlm1 và html2 cuối vòng lặp thì đóng thẻ
	// chuỗi html 3 /4 đòng thẻ mỗi ngày
	$chuoihtml1.='</tr>';
	$chuoihtml2.='</tr>';
	$mangtam=[];
	$mangtong=[];
  while($re = $data->fetch_array($result))
	{  
 		
		 
		 	$mangtong[$re['tencuahang']]+=$re['tong'];
			if($ngaythuchitam==''){ 
				$ngaythuchitam=$re['ngaythuchikt'];
				
				
				$mangtam[$ngaythuchitam][$re['tencuahang']]=$re['tong'];
				
				// <th width="37" valign="middle"  ><strong>Ngày tải file </strong></th></tr>
			}
			else{
				$mangtam[$ngaythuchitam][$re['tencuahang']]=$re['tong'];
			
				if($ngaythuchitam!=$re['ngaythuchikt']){
					$ngaythuchitam=$re['ngaythuchikt'];
				}
				
				
			}
			
			if($r==($numrow-1)){
			
				$mangtam[$ngaythuchitam][$re['tencuahang']]=$re['tong'];
			}
 			
 		$r++;
	}
	
	$chuoitong3.='<tr align="center"  bgcolor="#F8E4CB" class="fixed-bottom">
							 <td width="37" valign="middle"  ><strong>Tổng</strong></td>';
	$chuoitong4.='<tr align="center"  bgcolor="#F8E4CB" class="fixed-bottom">';
	$dongcuoi4=0;
	$dongcuoi3=0;
	
	//in($mangtong['BMT20HD']);
	foreach($mangtam as $key => $value){
	 if($mau=="white"){$mau="#EEEEEE";$hl="Normal4";$hl2="Highlight4";}else{$mau="white";$hl="Normal5";$hl2="Highlight5";}
		$checkcongcuoi=true;
			$chuoihtml3.='<tr align="center"  bgcolor="'.$mau.'">  
							 <td width="37" valign="middle"  ><strong>'.$key.'</strong></td>';
							 $chuoihtml4.='<tr align="center"  bgcolor="'.$mau.'">';
							
		foreach($mangchDN as $k => $v){
			if($value[$v]){
				$chuoihtml3.='<td width="37" valign="middle"  ><strong>'.number_format($value[$v]).'</strong></td>';
			}
			else{
				$chuoihtml3.='<td width="37" valign="middle"  ><strong></strong></td>';
			}
				
			if($dongcuoi3<count($mangch)){
			
				if($mangtong[$v]){
					 $chuoitong3.='<td width="37" valign="middle"  ><strong>'.number_format($mangtong[$v]).'</strong></td>';
					$dongcuoi3++;
				}
				else{
					 $chuoitong3.='<td width="37" valign="middle"  ><strong></strong></td>';
					$dongcuoi3++;
					 
				}
				//$dongcuoi3++;
			}
		
		}
		foreach($mangchKH as $k => $v){
			
			if($value[$v]){
					$chuoihtml4.='<td width="37" valign="middle"  ><strong>'.number_format($value[$v]).'</strong></td>';
					 
			}
			else{
				$chuoihtml4.='<td width="37" valign="middle"  ><strong></strong></td>';
				
			}
			
				
			if($dongcuoi3<count($mangch)){
				if($mangtong[$v]){
			 		$chuoitong4.='<td width="37" valign="middle"  ><strong>'.number_format($mangtong[$v]).'</strong></td>';
						$dongcuoi3++;
				}else{
			
					 $chuoitong4.='<td width="37" valign="middle"><strong></strong></td>';
					$dongcuoi3++;
				}
			}
			
			
		}
		
		$chuoihtml3.='</tr>';
		$chuoihtml4.='</tr>';
	}
	$chuoitong4.='</tr>';
	$chuoitong3.='</tr>';
	//in($mangtong);
	echo $chuoihtml1;
	echo $chuoihtml3;
	echo $chuoitong3;
?>
	  
  </table>
  </div>
  <div class="table_right" style="width:auto">
  <table  border="0" cellpadding="0" cellspacing="0" class="tbchuan table_bc" id="dopcccc1">
  	<?php echo $chuoihtml2;?>
	  	<?php echo $chuoihtml4;?>
			<?php echo $chuoitong4;?>
  </table>

</div>

</div>
<?php echo $chuoiphantrang; 

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
