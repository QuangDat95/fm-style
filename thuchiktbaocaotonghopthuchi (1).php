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
									//echo $nguoixacnhan;
									if(!$limit){
										 $limit=10000;
									}
								//echo $loai;
			//   var_dump($tmp);
			   //return;
			   ///++++++++++++++++++++++++++++++++++++++
			 if(!$curentpage){
			 	$curentpage=1;
			 }
			  
			// echo  $curentpage;
		  //if ($trang!=0  ) $limit  =  " LIMIT ". 10000*($trang-1) .", ". 10000*($trang); else $limit =" limit 10000";
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
					//	$sql_where.=" and d.xacnhan = '$nguoixacnhan'";
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
				//if($phieuxuat != ""){ $sql_where.=" and f.SoCT = '$phieuxuat'";  $sql_ton.=" and f.SoCT = '$phieuxuat'"; }
				//if($tkno != ""){ $sql_where.=" and a.tkno = '$manv'"; }
				//if($tkco != ""){ $sql_where.=" and c.manv = '$manv'"; }
			if($dinhkhoan != ""){ $sql_where.=" and (d.ma = '$dinhkhoan' or d.ten like '%$dinhkhoan%')"; $sql_ton.=" and (d.ma = '$dinhkhoan' or d.ten like '%$dinhkhoan%')"; }
				if($psno != ""){ $sql_where.=" and a.psno = '$psno'"; $sql_ton.=" and a.psno = '$psno'"; }
				if($psco != ""){ $sql_where.=" and a.psco = '$psco'"; $sql_ton.=" and a.psco = '$psco'"; }
				if($dongia != ""){ $sql_where.=" and a.dongia = '$dongia'";  $sql_ton.=" and a.dongia = '$dongia'"; }
				if($soluong != ""){ $sql_where.=" and a.soluong = '$soluong'"; $sql_ton.=" and a.soluong = '$soluong'"; }
				if($dvt != ""){ $sql_where.=" and a.donvi = '$dvt'";  $sql_ton.=" and a.donvi = '$dvt'"; }
				if($diengiai != ""){ $sql_where.=" and a.note = '$diengiai'"; $sql_ton.=" and a.note = '$diengiai'"; }
				
		//if($manv != ""){ $sql_where.=" and c.manv = '$manv'"; $sql_ton.=" and c.manv = '$manv'"; }
		//if($ten != ""){ $sql_where.=" and c.ten = '$ten'"; $sql_ton.=" and c.ten = '$ten'"; }
		
		
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
		
	
	 if($tu!="")	
		{
		  $ngay=  explode('/',$tu);
	   	  if (strlen($ngay[1])== 1) {  $ngay[1] = "0".$ngay[1] ;  }
		  if (strlen($ngay[0])== 1) {  $ngay[0] = "0".$ngay[0] ;  } 
		    //$sql_where2 .= " and  p.Ngaytao>= '$ngay[2]-$ngay[1]-$ngay[0]'";
			//$sql_where3 .= " and  aa.NgayTao>= '$ngay[2]-$ngay[1]-$ngay[0]'";
		  $sql_where  .= " and  a.ngaythuchi>= '$ngay[2]-$ngay[1]-$ngay[0]'";
		    $sql_ton  .= " and  a.ngaythuchi<'$ngay[2]-$ngay[1]-$ngay[0]'";
			$sql_ton_le  .= " and  a.ngaythuchi<='$ngay[2]-$ngay[1]-$ngay[0]'";
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
		
   $mangtk = taomang ("dinhkhoan","ID","madinhkhoan"); 
	
	  
	  $sql_rows = "SELECT a.ID as idthuchikt,a.sochungtu,a.luachon as loaithuchi,a.sotien,DATE_FORMAT(a.ngaytao,'%d/%m/%Y') as ngaytao,DATE_FORMAT(a.ngaythuchi,'%d/%m/%Y %H:%i') as ngaythuchikt,a.ngaythuchi as ngaythuchigoc,DATE_FORMAT(a.ngayduyet,'%d/%m/%Y %H:%i') as ngayduyetthuchi,a.psco,a.psno,a.donvi,a.soluong,a.dongia,a.hdbh,a.phithukh,a.sotknh,a.tentknh,a.NCC,a.manv,a.phieuxuat,a.sophieupm,a.chungtu,a.mavandon,a.tinhtrang,a.donvivc,a.lydoN,d.xacnhan as nguoixn,b.id as idch,b.macuahang as tencuahang,d.ma as madkhoan,d.ten as khoanmuctc,a.tkno,a.tkco,a.note as diengiai,t.ma as matinh,t.name as tentinh,m.ID as idmien,m.Name as tenmien  FROM thuchikt a left join cuahang b on a.loaitk=b.id left join tinh t on b.Fax=t.ID left join  mien m on m.ID =b.NameN left join userac c on a.IDtao = c.ID  left join dinhkhoanthuchi d on d.ID = a.IDcha left join nhacungcap e on a.NCC=e.ID left join phieuxuat f on a.phieuxuat=f.ID  ".$sql_where." $wherequyen order by  a.ngaythuchi desc";
	  
	  
	 	 $start=($curentpage-1)*$limit;
		 
		$sql = "SELECT a.ID as idthuchikt,a.sochungtu,a.luachon as loaithuchi,a.sotien,DATE_FORMAT(a.ngaytao,'%d/%m/%Y %H:%i:%s') as ngaytao,DATE_FORMAT(a.ngaythuchi,'%d/%m/%Y %H:%i') as ngaythuchikt,a.ngaythuchi as ngaythuchigoc,DATE_FORMAT(a.ngayduyet,'%d/%m/%Y %H:%i') as ngayduyetthuchi,a.psco,a.psno,a.donvi,a.soluong,a.dongia,a.hdbh,a.phithukh,a.sotknh,a.tentknh,a.NCC,a.manv,a.phieuxuat,a.sophieupm,a.chungtu,a.mavandon,a.tinhtrang,a.donvivc,a.lydoN,d.xacnhan as nguoixn,b.id as idch, b.macuahang as tencuahang,d.ma as madkhoan,d.ten as khoanmuctc,a.tkno,a.tkco,a.note as diengiai,f.SoCT as phieuxuatf,t.ma as matinh,t.name as tentinh,m.ID as idmien,m.Name as tenmien  FROM thuchikt a left join cuahang b on a.loaitk=b.id left join tinh t on b.Fax=t.ID left join  mien m on m.ID =b.NameN left join userac c on a.IDtao = c.ID  left join dinhkhoanthuchi d on d.ID = a.IDcha left join nhacungcap e on a.NCC=e.ID left join phieuxuat f on a.phieuxuat=f.ID   ".$sql_where." $wherequyen order by a.ngaythuchi,t.ma desc  ";

 if($_SESSION['admintuan'] ) echo $sql ;
	//	$query_rows = $data->query($sql);
		$result_rows = $data->query($sql_rows);
		$numrow = $data->num_rows($result_rows);
		$totalpage=ceil($numrow/$limit);
		$chuoiphantrang=' <div class="pagi"> <ul id="pagination">
		 <li><button value="F" onclick="phantrangAjax(1,17)">Đầu</button></li>
    <li><button value="-1" onclick="phantrangAjax(this.value,17)">«</button></li>';
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
			$chuoiphantrang.='<li><button value="'.$i.'" onclick="phantrangAjax(this.value,17)" style="background-color:'.$mau.'">'.$i.'</button></li>';
		}
	
	
 $chuoiphantrang.='  <li><button value="-2" onclick="phantrangAjax(this.value,17)">»</button></li>
  <li><button value="F" onclick="phantrangAjax('.$totalpage.',17)">Cuối</button></li>
  	</ul> </div>
  </div>';
  
  
		$result = $data->query($sql);
		
	
  if ($_SESSION["admintuan"])	echo  $sql ;
	 
 // echo  "Chờ tí nhé. đang chỉnh lại báo cáo tỉ lệ";  return ;
     
	/* $sql="select a.ID,a.macuahang,b.ma as matinh,b.Name as tentinh from  cuahang a left join tinh b on a.Fax=b.ID where  a.IDNhomcc <> 8 and a.macuahang <> ''";
	$mangchKH=[];
	$mangchDN=[];
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
				
	}*/
	//==============================================================	
	//$mangnhanvien =taomang("userac","ID","ten"," where tinhluong = '1'  ") ;
	
	
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
	  top:0;
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
	  top:0;
}

.tbchuan th{
	height:auto;
	padding:0.8em;
	overflow:hidden;
	    font-size: 14px;
	white-space:pre-wrap;
	background-color:#F8E4CB !important;
	color:#000000;
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
	
}
@media all and (min-width: 2560px) {
	
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

.tbchuan th, .tbchuan td {
    border: 1px solid #333333;
    padding: 5px 3px 5px 5px;
    font-weight: bold;
	overflow: initial;
	}
	
	.tbchuan th  .fillter, .tbchuan td  .fillter{
			color: #ff5722;
			cursor:pointer

	}
	.tbchuan th .fillter:hover, .tbchuan td  .fillter:hover{
		opacity:0.7
	}
.tbchuan th >div, .tbchuan td >div{
	position:relative;
	display: flex;
	width: 100%;
	height: 100%;
	align-items: center;
	justify-content: space-around;
}
	.gg-filters {
    display: block;
    box-sizing: border-box;
    position: relative;
    transform: scale(var(--ggs,1));
    width: 19px;
    height: 19px;
    background:
        radial-gradient(
            circle,
            currentColor 26%,
            transparent 26%
        )
}
.gg-filters::after,
.gg-filters::before {
    content: "";
    display: block;
    box-sizing: border-box;
    position: absolute;
    border: 2px solid;
    border-radius: 100%;
    width: 14px;
    height: 14px
}
.gg-filters::after {
    bottom: 0;
    right: 0
}
.select_filter{
	    background-color: #ffffff;
    border: 1px solid #999999;
    width: 184px;
    height: 300px;
    overflow-y: scroll;
    position: absolute;
    top: 60px;
	display:none;
	    box-shadow: 1px 1px 10px;
}	
.select_filter ul{
	padding: 0;
    margin: 0;
    display: flex;
    flex-direction: column;
    width: 100%;
}
.select_filter ul li{
	display: flex;
    list-style-type: none;
    
    align-items: center;
    padding: 0 10px;
	padding:5px 10px;
	
}
.select_filter ul li  label{
	width:80%;
}
.select_filter ul li span{
display:flex;	
width:80%;
}
.select_filter ul li input{
	margin-right: 10px;
    width: 20px;
    height: 20px;
	cursor:pointer
}
.select_filter::-webkit-scrollbar-track
{
	-webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
	background-color: #F5F5F5;
}

.select_filter::-webkit-scrollbar
{
	width: 10px;
	background-color: #F5F5F5;
}

.select_filter::-webkit-scrollbar-thumb
{
	background-color: #000000;
	border: 2px solid #555555;
}

.show_fil{
	display:flex;
	    flex-direction: column;
}

.chon_fil{
	position:sticky;
	bottom:0;
}
   </style>	
 

    <?php
 		 $tong=0;
	$chuoithml="";
	$matinhtam='';
	$machtam='';
	$chuoithmltam1='';
	$chuoithmltam2='';
	$ngaytam="";
	$mangdinhkhoanfil=[];
	$mangtkcofil=[];
	$mangtknofil=[];
	$mangchfil=[];
	$mangdulieu=[];
	$mangtongch=[];
	
	$ngaythuchitam='';
	$mangton=[];
	$cuahangtam=[];
	//$k=0;
  while($re = $data->fetch_array($result))
	{    $r++ ;
		
		
		if(!$cuahangtam[$re["tencuahang"]][$re["ngaythuchigoc"]]["ngay"]){
			$sql2 = "SELECT  sum(case when  a.luachon = 1 then round(a.psno) else -(round(a.psco)) end )as tong,DATE_FORMAT(a.ngaykhoa,'%d/%m/%Y') as ngaykhoa,a.loaitk FROM thuchikt a left join cuahang b on a.loaitk=b.id  left join userac c on a.IDtao = c.ID  left join dinhkhoanthuchi d on d.ID = a.IDcha left join nhacungcap e on a.NCC=e.ID left join phieuxuat  f on a.phieuxuat=f.ID 
			where 1=1 and (d.ma <> 'TLDK' and d.ma <> 'TL') and a.ngaythuchi<'$re[ngaythuchigoc]' and loaitk='$re[idch]'   ORDER BY a.ngaytao desc  ";
			$dong=getdong($sql2);
			$tongton=$dong["tong"];
			$cuahangtam[$re["tencuahang"]][$re["ngaythuchigoc"]]["ngay"]=$re["ngaythuchigoc"];
			$cuahangtam[$re["tencuahang"]]["tongton"]=$tongton;
			if(!$cuahangtam[$re["tencuahang"]]["tongtoncu"]){
				$cuahangtam[$re["tencuahang"]]["tongtoncu"]=$tongton;
			
			}
			
		}
		
			
				
	//echo $cuahangtam;
	$mangdulieu[$re["tenmien"]][$re["tentinh"]][$re["tencuahang"]][$re["ngaythuchikt"]][$re["madkhoan"]]["khoanmuctc"]=$re["khoanmuctc"];
	$mangdulieu[$re["tenmien"]][$re["tentinh"]][$re["tencuahang"]][$re["ngaythuchikt"]][$re["madkhoan"]]["tkno"]=$re["tkno"];
	$mangdulieu[$re["tenmien"]][$re["tentinh"]][$re["tencuahang"]][$re["ngaythuchikt"]][$re["madkhoan"]]["tkco"]=$re["tkco"];
	$mangdulieu[$re["tenmien"]][$re["tentinh"]][$re["tencuahang"]][$re["ngaythuchikt"]][$re["madkhoan"]]["psno"]+=$re["psno"];
	$mangdulieu[$re["tenmien"]][$re["tentinh"]][$re["tencuahang"]][$re["ngaythuchikt"]][$re["madkhoan"]]["psco"]+=$re["psco"];
	$mangdulieu[$re["tenmien"]][$re["tentinh"]][$re["tencuahang"]][$re["ngaythuchikt"]][$re["madkhoan"]]["tongpsnoco"]=abs($re["psno"]-$re["psco"]);
	/*$mangdulieu[$re["tentinh"]][$re["tencuahang"]][$re["ngaythuchikt"]][$re["madkhoan"]]["khoanmuctc"]=$re["khoanmuctc"];
	$mangdulieu[$re["tentinh"]][$re["tencuahang"]][$re["ngaythuchikt"]][$re["madkhoan"]]["tkno"]=$re["tkno"];
	$mangdulieu[$re["tentinh"]][$re["tencuahang"]][$re["ngaythuchikt"]][$re["madkhoan"]]["tkco"]=$re["tkco"];
	$mangdulieu[$re["tentinh"]][$re["tencuahang"]][$re["ngaythuchikt"]][$re["madkhoan"]]["psno"]+=$re["psno"];
	$mangdulieu[$re["tentinh"]][$re["tencuahang"]][$re["ngaythuchikt"]][$re["madkhoan"]]["psco"]+=$re["psco"];
	$mangdulieu[$re["tentinh"]][$re["tencuahang"]][$re["ngaythuchikt"]][$re["madkhoan"]]["tongpsnoco"]=abs($re["psno"]-$re["psco"]);*/
	
		//$mangtongch[$re["tentinh"]][$re["tencuahang"]]['tongtmketve']+=$re["psno"];
		//$mangtongch[$re["tentinh"]][$re["tencuahang"]]['tongtmketve']-=$re["psco"];
	
		/*$mangtongch[$re["tencuahang"]]["tongpsno"]+=$re["psno"];
		$mangtongch[$re["tencuahang"]]["tongpsco"]+=$re["psco"];
		$mangtongch[$re["tencuahang"]]["tongpsnoco"]+=abs($re["psno"]-$re["psco"]);*/
		$mangdinhkhoanfil[$re["madkhoan"]]=$re["khoanmuctc"];
		$mangtkcofil[$re["tkco"]]=$mangtk[$re["tkco"]];
		$mangtknofil[$re["tkno"]]=$mangtk[$re["tkno"]];
		$mangchfil[$re["tenmien"]][$re["tentinh"]][$re["tencuahang"]]=$re["tencuahang"];
		
		$mangmienfil[$re["tenmien"]][$re["tentinh"]]=$re["tentinh"];
	}
	
	//in($mangdulieu);
	
	?>
	
	<input type="hidden" name="totalpage" id="totalpage" value="<?php echo $totalpage; ?>" />
	  <div id="wrap_kq" style="display:flex;flex-direction: column;"> 
<div style="" id="showtb"  >
 
  <div class="table_left" style="width:auto;position: -webkit-sticky;
	  position: sticky;left:0;z-index:1;    height: 480px;overflow:scroll"  id="showtb_xuat">
  
  <table  border="0" cellpadding="0" cellspacing="0"  class="tbchuan table_bc" id="dopcccc" style="width:100%;border-collapse:collapse">
  <thead>
    <tr align="center" bgcolor="#F8E4CB" class="fixed-top1">
      <th  width="68"  height="23" valign="middle" >
	  <strong>STT</strong></th> 
	  
      <th width="146" valign="middle"  ><div><strong>Khu vực</strong>
	   <span class="gg-filters fillter" onclick="showFilter('select_filter1')"> </span>
	 	<!-- <span class="gg-filters fillter" onclick="showFilter('select_filter5')">-->
	  </span>
		<!--<div class="select_filter" id="select_filter5">
			<ul>
				<li style="    position: sticky;
    top: 0;
    z-index: 100;
    background-color: #ffffff;">
				
					<input type="checkbox" id="checkall_tenmienkhuvuc"  onchange="checked_allFiltotal(event,'tenmienkhuvuc')"   /><span>Chọn tất cả</span>
				</li>
				<?php
					foreach($mangchfil as $key => $value){
						if($key){
							?>
							<li>
								<input type="checkbox" class="tenmienkhuvuc" id="<?php echo $key;?>"  value='<?php echo $key;?>' onchange="checked_columnfilTotal(event,'tenmienkhuvuc')"   fill-name='tenmienkhuvuc' data-fill='<?php echo json_encode($value); ?>' />
							  <label for="<?php echo $key;?>" style="color:#ff5722"><?php echo $key;?></label>
							</li>
							
							<?php
								foreach($value as $k => $v){
									if($v){
										?>
										<li style="padding-left:20px">
											<input type="checkbox" class="tenmienkhuvuc" id="<?php echo $k;?>"  value='<?php echo $k;?>' onchange="checked_columnfilTotal(event,'tenmienkhuvuc')"  fill-name='tenmienkhuvuc' data-fill='<?php echo json_encode($v); ?>'  />
										  <label for="<?php echo $k;?>" style="color:#009688"><?php echo $k;?></label>
										</li>	
										
										<?php
										
									
								}
									
							}
						}
					}
				
				?>
				
			</ul>
			<button class="chon_fil" onclick="showFilter('select_filter5')">Đóng</button>
		</div>-->
		
		
		
		<div class="select_filter" id="select_filter1">
			<ul>
				<li style="    position: sticky;
    top: 0;
    z-index: 100;
    background-color: #ffffff;flex-direction: column;">
					<label style="    display: flex;">
					<input type="checkbox" id="checkall_tencuahang"  onchange="checked_all(event,'tencuahang')"   checked="checked"/><span>Chọn tất cả</span></label>
						<label style="    display: flex;"><input type="checkbox" id="checkall_gopmien"  onchange="checkFillGop(event,'gopmien')"   /><span>Gộp miền</span></label>
					<label style="    display: flex;">	<input type="checkbox" id="checkall_goptinh"  onchange="checkFillGop(event,'goptinh')" /><span>Gộp tỉnh</span></label>
				</li>
				<?php
					foreach($mangchfil as $key => $value){
						if($value){
							?>
							<li>
								<input type="checkbox" class="tencuahang" id="<?php echo $key;?>"  value='<?php echo $key;?>' onchange="checked_column(event,'tencuahang')" fill-name='mien' data-fill='<?php echo json_encode($value); ?>'  checked="checked"/>
							  <label for="<?php echo $key;?>" style="color:#ff5722"><?php echo $key;?></label>
							</li>
							
							<?php
								foreach($value as $k => $v){
									if($v){
										?>
										<li style="padding-left:20px">
											<input type="checkbox" class="tencuahang" id="<?php echo $k;?>"  value='<?php echo $k;?>' onchange="checked_column(event,'tencuahang')"  fill-name='khuvuc' data-fill='<?php echo json_encode($v); ?>'   checked="checked"/>
										  <label for="<?php echo $k;?>" style="color:#009688"><?php echo $k;?></label>
										</li>	
										
										<?php
										
									foreach($v as $k1 => $v1){
											if($v1){
												?>
														
												<li style="padding-left:30px">
											<input type="checkbox" class="tencuahang" id="<?php echo $k;?>"  value='<?php echo $k1;?>' onchange="checked_column(event,'tencuahang')"  checked="checked"/>
										  <label for="<?php echo $k1;?>"><?php echo $v1;?></label>
										</li>	
												<?php
											}
									}
								}
									
							}
						}
					}
				
				?>
				
			</ul>
			<button class="chon_fil" onclick="showFilter('select_filter1')">Đóng</button>
		</div></div></th>
	    <th width="304" valign="middle"  class="hidden_when_all" ><strong>Ngày</strong></th>
	    <th width="304" valign="middle"  class=""><div><strong>Khoản mục thu chi</strong> <span class="gg-filters fillter" onclick="showFilter('select_filter2')"></span>
		
		<div class="select_filter" id="select_filter2">
			<ul>
				<li style="    position: sticky;
    top: 0;
    z-index: 100;
    background-color: #ffffff;">
				
					<input type="checkbox" id="checkall_khoanmuctc" checked="checked" onchange="checked_all(event,'khoanmuctc')"/><span>Chọn tất cả</span>
				</li>
				<?php
					foreach($mangdinhkhoanfil as $key => $value){
						if($value){
							?>
							<li>
								<input type="checkbox" id="<?php echo $key;?>"  class="khoanmuctc" value='<?php echo $key;?>' onchange="checked_column(event,'khoanmuctc')" checked="checked"/>
								 <label for="<?php echo $key;?>"><?php echo $value;?></label>
							</li>
							
							<?php
							}
					}
				
				?>
				
			</ul>
			<button class="chon_fil" onclick="filter_column('khoanmuctc')">Chọn</button>
		</div>
		</div>
				 </th>
	   <th width="186" valign="middle" class="hidden_when_all" ><div><strong>TK nợ</strong>
	   <span class="gg-filters fillter" onclick="showFilter('select_filter3')"></span>
		
		<div class="select_filter" id="select_filter3">
			<ul>
				<li style="    position: sticky;
    top: 0;
    z-index: 100;
    background-color: #ffffff;">
				
					<input type="checkbox" id="checkall_tkno" onchange="checked_all(event,'tkno')" checked="checked"/><span>Chọn tất cả</span>
				</li>
				<?php
					foreach($mangtknofil as $key => $value){
					if($value){
							?>
							<li>
								<input type="checkbox"  class="tkno" id="<?php echo $key;?>" value='<?php echo $key;?>'  onchange="checked_column(event,'tkno')" checked="checked"/>
								 <label for="<?php echo $key;?>"><?php echo $value;?></label>
							</li>
							
							<?php
							}
					}
				
				?>
				
			</ul>
			<button class="chon_fil" onclick="showFilter('select_filter3')">Đóng</button>
		</div></div>
	   </th>
	    <th width="186" valign="middle" class="hidden_when_all"><div><strong>TK có</strong><span class="gg-filters fillter" onclick="showFilter('select_filter4')"></span>
		
		<div class="select_filter" id="select_filter4">
			<ul>
				<li style="    position: sticky;
    top: 0;
    z-index: 100;
    background-color: #ffffff;">
				
					<input type="checkbox" class="tkco" id="checkall_tkco" onchange="checked_all(event,'tkco')" checked="checked"/><span>Chọn tất cả</span>
				</li>
				<?php
					foreach($mangtkcofil as $key => $value){
							if($value){
							?>
							<li>
								<input type="checkbox" class="tkco" id="<?php echo $key;?>" value='<?php echo $key;?>' onchange="checked_column(event,'tkco')"  checked="checked"/>
								 <label for="<?php echo  $key;?>"><?php echo $value;?></label>
							</li>
							
							<?php
							}
					}
				
				?>
				
			</ul>
			
			<button class="chon_fil" onclick="showFilter('select_filter4')">Đóng</button>
		</div></div></th>
	    <th width="153" valign="middle" ><strong>PS Nợ  </strong></th>
      <th width="186" valign="middle" ><strong>PS Có </strong></th>
       
      <th width="186" valign="middle" ><strong>Tổng</strong></th>
    </tr>
	</thead>
	<tbody id="show_dulieu_mang">
	<?php
	$log=[];
	$i=0;
	foreach($mangdulieu as $mamien =>$mien){
	$i++;
	$log[$mamien]=0;
	$chuoithml.="<tr style='background-color: #ff98006e;'><td>$i</td><td style='    background-color: #ff9800;
    color: #ffffff;'>$mamien</td><td colspan='7'></td></tr>";
	foreach($mien as $matinh =>$cuahang){
	$i++;
		$chuoithml.="<tr style='background-color: #ff98006e;'><td>$i</td><td style='    background-color: #ff9800;
    color: #ffffff;'>$matinh</td><td colspan='7'></td></tr>";
		foreach($cuahang as $macuahang =>$ngays){
		
			$chuoithmltam1.="<tr style='background-color: #0096886e;'>";
			$chuoithmltam2='';
			
					$tongpsno=0;
					$tongpsco=0;
					$tongpsnoco=0;
					
			foreach($ngays as $ngay =>$dinhkhoan){
				$i++;
					$ngaytam='';
					$tongtiematketve=0;
				foreach($dinhkhoan as $key =>$value){
				$style='';
					if($ngay!=$ngaytam){
						
						$style=" style='background-color: #3f51b5a8;
    color: #ffffff'";
						$ngaytam=$ngay;
					}
					if($chuoithmltam2==""){
				$chuoithmltam2.="<td>$i</td><td style='    background-color: #009688;
    color: #ffffff'>$macuahang</td>
									<td class='hidden_when_all' $style>$ngay</td>";
						$chuoithmltam2.="
									<td>$value[khoanmuctc]</td>
								<td class='hidden_when_all'>".$mangtk[$value['tkno']]."</td>
								<td class='hidden_when_all'>".$mangtk[$value['tkco']]."</td>
								<td>".number_format((float)($value['psno']))."</td>
								<td>".number_format((float)($value['psco']))."</td>
								<td>".number_format((float)($value['tongpsnoco']))."</td></tr>
						";
						
						//$chuoithmltam1.=$chuoithmltam2;
					}
					else{
					
							$chuoithmltam2.="<tr><td>$i</td><td></td>
									<td class='hidden_when_all' $style>$ngay</td>
									<td>$value[khoanmuctc]</td>
								<td class='hidden_when_all'>".$mangtk[$value['tkno']]."</td>
								<td class='hidden_when_all'>".$mangtk[$value['tkco']]."</td>
								<td>".number_format((float)($value['psno']))."</td>
								<td>".number_format((float)($value['psco']))."</td>
								<td>".number_format((float)($value['tongpsnoco']))."</td></tr>
						";
					}
					
					$tongpsno+=$value['psno'];
					$tongpsco+=$value['psco'];
					$tongpsnoco+=$value['tongpsnoco'];
					
				
					if($key!='TL' && $key!='TLDK'){
						$tongtiematketve+=$value['psno'];
						$tongtiematketve-=$value['psco'];
					
					}
						
					$i++;
				}	
				
			}
			
				$tongtm=$cuahangtam[$macuahang]["tongton"]+$tongtiematketve;
						$log[$matinh]+=$tongtm;
				$chuoithmltam1.=$chuoithmltam2;
				
				$chuoithmltam1.="<tr style='background-color: #9e9e9e47;'>
		<td>$i</td>
		<td></td>
		<td>Tổng</td>
		<td></td>
		<td></td>
		<td></td>
		<td style='color: #3f51b5;'>".number_format($tongpsno)."</td>
		<td  style='color: #3f51b5;'>".number_format($tongpsco)."</td>
		<td  style='color: #3f51b5;'>".number_format($tongpsnoco)."</td>
	</tr>";
	$chuoithmltam1.="<tr style='background-color: #9e9e9e47;'>
		<td>$i</td>
		<td></td>
		<td>Tồn đầu kỳ</td>
		<td style='text-align:center;color: #ff5722;'>".number_format($cuahangtam[$macuahang]["tongtoncu"])."</td>
		<td>Tổng TM</td>
		<td  style='text-align:center;color: #ff5722;' colspan='4'>".number_format($tongtm)." <span style='margin-left:30px;font-style:italic'>(*) Không cộng tiền lẻ và tiền lẻ đầu kỳ</span></td>
		
		
	</tr>";
	
		}
		$chuoithml.=$chuoithmltam1;
		
		$chuoithmltam1='';
			}
			
	}
	//in($log);
	echo $chuoithml;
	
	$mangdulieujson=json_encode($mangdulieu,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
	$mangtk=json_encode($mangtk,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
	$cuahangtam=json_encode($cuahangtam,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
	?>
	
	</tbody>
	
  </table>
  
  
  </div>
  

</div>
<div id="data_mang_json" style="display:none"><?php echo $mangdulieujson;?></div>
   <div id="data_mang_tk_json" style="display:none"><?php echo $mangtk;?></div>
    <div id="data_mang_cuahangtam_json" style="display:none"><?php echo $cuahangtam;?></div>
<?php //echo $chuoiphantrang; 

?>
  



 
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
