<?php  
session_start();
//$_SESSION["mangidhientai"]=[];
 $idk=$_SESSION["LoginID"];
 $mangidhientai=$_SESSION["mangidhientai"]?$_SESSION["mangidhientai"]:[];
 $idcuahang=$_SESSION["se_kho"];
if ($idk =='') { return ; }

$root_path =getcwd()."/"  ;
include($root_path."biensession.php");

include($root_path."includes/config.php");
include($root_path."includes/removeUnicode.php");
include($root_path."includes/class.paging.php");
include($root_path."includes/class.mysql.php");
include($root_path."includes/function.php");
    //$ql[5]=5;
$data = new class_mysql();
$data->config();
$data->access();
$data->setdangnhap($idk,$us) ;
 $arrhhcuahang=manghanghoacuhang($idcuahang);
//var_dump($mangidhientai);
//================================
 $mangdaco['0']='1';
 $chuoitrave='';
 
 function chuyen($tam)
  { global $mangdaco ;
	global $chuoitrave;
	global $mauve;
 	 if ( $tam != '')
     {
	   $tam = explode("&*!",$tam) ;
		$k =0; $sopt = count ($tam) ;
		 
		if ($sopt <2)  $chuoisp = $result_news["masp"] ;
		else
		{
			$mang = ''; $chuoisp='';
			for($i=1 ;$i<=$sopt ;$i++)
			{   if ($k==0)  {$idm = $tam[$i]; $k =1 ; } 
				else if($k==1) 
				{
					if(laso($mangdaco[$idm])=='0')
					{
					 $sql = " select sum(a.soluong) as sl from hanghoacuahang a left join products b on a.idsp=b.id where a.soluong>0 and a.idcuahang>1 and b.codepro='$idm'  ";$tamsl=getdong($sql);
				     $mangdaco[$idm]=$tamsl['sl'];
					}
					if($mangdaco[$idm]>0) { $soluongco=  " <b  style='color:red' > Về:".$mangdaco[$idm]."</b>"; $mauve="blue";}
					else  {$soluongco= "";$mauve="";}
					if($chuoisp=='') {$chuoisp =$tam[$i] .$soluongco ;} else { $chuoisp .= "<br>".$tam[$i] .$soluongco ;} 
					 $mang["$idm"]=$tam[$i]; $k =2 ;
						
				}
				elseif( $k==2) { $sl = $tam[$i] ; $k =3 ; }
 				elseif( $k==3)  {$gia = $tam[$i]; $k =0 ; }
 		
			}
		}
       }	
	   return $chuoisp;
  }
  //======================================
  if(isset($_POST["LOADLAI"])){
  		 $data1 = $_POST['LOADLAI']; 
		  $tmp = explode('*@!',$data1);
		     $loadlai= $tmp[10];
			$chuoinotin='';
		if($mangidhientai){
				
				foreach($mangidhientai as $key => $value){
					$chuoinotin.=$value.',';
				}
			}
			$chuoinotin=rtrim($chuoinotin,",");
		if($loadlai==1){
		
				 $sql_where .= " where a.ID not in ($chuoinotin)";
				
			
			$sql ="
		SELECT  a.*,a.ID as idphieu,a.SoCT as sochungtu,DATE_FORMAT(a.ngaytao,'%d/%m/%y %h:%i') as ngaytao,DATE_FORMAT(a.ngaynhan,'%d/%m/%y %h:%i') as ngaypassdon,u.ten,u.manv,c.Name as tenKH,c.tel as sodtkh,c.address as diachikh 
		FROM passdon a left join userac u on a.idtao=u.id left join customer c on a.IDNhaCC=c.ID ".$sql_where."    ORDER BY  a.idtao ,a.ngaytao desc limit 100";
	
	$query =$data->query($sql);	
	
			$r=0;
		while($re=$data->fetch_array($query)){
		
					$r++;
 		
			  array_push($mangidhientai,$re['idphieu'])	;
	
			}
			$_SESSION["mangidhientai"]= $mangidhientai;
			
		
		echo $r;
		return;
		}
	}
  
 
  $data1 = $_POST['DATA']; 
  $tmp = explode('*@!',$data1);
   $masp=    ($tmp[0])    ;
   $madonvan =addslashes(trim($tmp[1]));
   $tenkhach= addslashes($tmp[2]);
   $tel= $tmp[3];   
   $tinhtrang= $tmp[4];
   $tinhtranghang= $tmp[5];
   $tu= $tmp[6];
   $den= $tmp[7];
   $nguoitao= $tmp[8];
   $trang= $tmp[9];
    $trangthai= $tmp[10];
	  $cuahang= $tmp[11];
	$lydo= $tmp[12];
	  $curentpage= $tmp[13];
   $NgayTao = gmdate('Y-m-d H:i:s', time() + 7*3600) ;
    
   if($tel=='-1')
   {   $NgayTao = gmdate('Y-n-d H:i:', time() + 7*3600) ;
        $NgayTao .=$tinhtrang ;
	
		if($madonvan!='') $madonvan = ",madonvan='$madonvan'";
		 
	   $sql = " update online set ngaychotdon='$NgayTao',IDchotdon='$idk',tinhtrang='8',ghichuchotdon='$tenkhach' $madonvan where id= '$masp' and idtn=0 and idlayhang>0    ";
	 
	   $tam=getdong($sql);
	  ?>
        <script type="text/javascript" language="javascript" id="dulieu">
			alert("đã chốt đơn có mã đơn vận: '" + madonvan+ "'");
        </script>
      <?php
 	   $sql = $_SESSION['sqlluu'];  
   }
   else
   {
   
   	if($cuahang){
			$sql_where.=" and a.IDKho = '$cuahang' or a.cuahangnhan='$cuahang'";
		}
		
		
		if($lydo){
			$sql_where.=" and a.LyDo = '$lydo'";
		}
		$sql_where=" where 1=1  ";
		if($masp!="") $sql_where.=" and a.masp like '%".$masp."%'";
		if($madonvan!="") $sql_where.=" and a.SoCT  = '".$madonvan."'";
		if($tenkhach !="")  $sql_where.=" and a.tenkhach  like '%".$tenkhach."%'";
		if($tel!="") { $tam=$tel ; if($tel[0]==0 )  $tam[0]=""; $sql_where.=" and a.tel  like '%".trim($tam)."%'";   } 
		if($tinhtrang >0) { 	$sql_where.=" and a.tinhtrang= $tinhtrang  "; 		}
		if($tinhtranghang >0) { 	$sql_where.=" and a.tinhtranghang= $tinhtranghang  "; 	}	
		
		if($trangthai){
			if($trangthai==1){
				$sql_where.=" and ((a.cuahangnhan is not null and  a.cuahangnhan <> '')  or (d.IDchnhan is not null and  d.IDchnhan <> '' )) "; 	
			}else if($trangthai==2){
				$sql_where.=" and (( a.cuahangnhan is null and a.cuahangnhan='') or (d.IDchnhan is null  and d.IDchnhan='' ))"; 	
			}
			else if($trangthai==3){
				$sql_where.=" and a.tinhtrang =4"; 	
			}
			else if($trangthai==4){
				$sql_where.=" and a.tinhtrang < 4"; 	
			}
			else if($trangthai==5){
				$sql_where.=" and a.tinhtrang =3"; 	
			}
		}
		if($nguoitao >0) { 	$sql_where.=" and a.idtao= $nguoitao  "; 	}	
		if($tu!="")	
		{
		  $ngay=  explode('/',$tu);
	   	  if (strlen($ngay[1])== 1) {  $ngay[1] = "0".$ngay[1] ;  }
		  if (strlen($ngay[0])== 1) {  $ngay[0] = "0".$ngay[0] ;  }    		
		  $sql_where .= " and  a.ngaytao >= '$ngay[2]-$ngay[1]-$ngay[0] 00:01'";
		}
		if($den!="")	
		{
		  $ngay=  explode('/',$den);
	   	  if (strlen($ngay[1])== 1) {  $ngay[1] = "0".$ngay[1] ;  }
		  if (strlen($ngay[0])== 1) {  $ngay[0] = "0".$ngay[0] ;  }    		
		  $sql_where .= " and  a.ngaytao <= '$ngay[2]-$ngay[1]-$ngay[0] 23:59'";
		} 
		
	$sql_rows ="
SELECT  a.*,a.ID as idphieu,a.SoCT as sochungtu,DATE_FORMAT(a.ngaytao,'%d/%m/%y %h:%i') as ngaytao,DATE_FORMAT(a.ngayhuy,'%d/%m/%y %h:%i') as ngayhuy,DATE_FORMAT(a.NgayNhan,'%d/%m/%y %h:%i') as NgayNhan,DATE_FORMAT(a.ngaykhoa,'%d/%m/%y %h:%i') as ngaykhoa,a.lydohuy,u.ten,u.manv,c.Name as tenKH,c.tel as sodtkh,c.address as diachikh ,e.mavd,e.donvivc,e.phiship,f.SoCT as sohoadon,d.mahang,d.SoLuong,d.DonGia,(d.SoLuong*d.DonGia) as thanhtien, d.chietkhau,d.IDchnhan,d.IDnvnhan
FROM passdon a left join userac u on a.idtao=u.id left join customer c on a.IDNhaCC=c.ID left join passdonchitiet d  on a.ID=d.IDPhieu left join vanchuyenpassdon e on a.ID =e.IDpassdon left join phieunhapxuat f on e.IDbill = f.ID ".$sql_where." ORDER BY  a.idtao ,a.ngaytao desc ";
	$limit=10;
	 	 $start=($curentpage-1)*$limit;
	$sql ="
SELECT  a.*,a.ID as idphieu,a.SoCT as sochungtu,DATE_FORMAT(a.ngaytao,'%d/%m/%y %h:%i') as ngaytao,DATE_FORMAT(a.ngayhuy,'%d/%m/%y %h:%i') as ngayhuy,DATE_FORMAT(a.NgayNhan,'%d/%m/%y %h:%i') as NgayNhan,DATE_FORMAT(a.ngaykhoa,'%d/%m/%y %h:%i') as ngaykhoa,a.lydohuy,u.ten,u.manv,c.Name as tenKH,c.tel as sodtkh,c.address as diachikh ,e.mavd,e.donvivc,e.phiship,f.SoCT as sohoadon,d.mahang,d.SoLuong,d.DonGia,(d.SoLuong*d.DonGia) as thanhtien, d.chietkhau,d.IDchnhan,d.IDnvnhan
FROM passdon a left join userac u on a.idtao=u.id left join customer c on a.IDNhaCC=c.ID left join passdonchitiet d  on a.ID=d.IDPhieu left join vanchuyenpassdon e on a.ID =e.IDpassdon left join phieunhapxuat f on e.IDbill = f.ID ".$sql_where." ORDER BY  a.idtao ,a.ngaytao desc limit $start, $limit";

   }

//echo $sql;
		
   	  $_SESSION['sqlluu']=$sql ;
	    $mangtinhtrangmau = taomang("tinhtrang","ID","mau");
		$mangtinhtrang = taomang("tinhtrang","ID","manhomhang");	
	    $mangtinhtrangten = taomang("tinhtrang","ID","name");	
		
		$mangsize=taomang("size","ID","Name" );
 $mangmau =taomang("mausac","ID","Name" );
		  $mangcuahang = taomang("cuahang","ID","Name");	 
 if($_SESSION["admintuan"]) echo $sql ; 
 	//========================================================
  $result_rows = $data->query($sql_rows);
		$numrow = $data->num_rows($result_rows);
		$totalpage=ceil($numrow/$limit);
		$chuoiphantrang=' <div class="pagi"> <ul id="pagination">
    <li><button type="button" value="-1" onclick="phantrangAjax(this.value)">«</button></li>';
		$min=1;
		$max=10;
		$buocnhay=3;
		if($totalpage>$max){
			if($curentpage-$buocnhay <$min || ($curentpage<$max-$buocnhay &&  $curentpage>$min)){
				$min =1;
				$max = 10;
				
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
			$chuoiphantrang.='<li><button type="button" value="'.$i.'" onclick="phantrangAjax(this.value)" style="background-color:'.$mau.'">'.$i.'</button></li>';
		}
	
	
 $chuoiphantrang.='  <li><button type="button" value="-2" onclick="phantrangAjax(this.value)">»</button></li>
  	</ul> </div>
  </div>';
  $result = $data->query($sql);
	//==============================================================	
 

?>
<style>


.tbchuan th:first-child {
  position: -webkit-sticky;
  position: sticky;
  left: 0;
  z-index: 2;
}
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
 position: -webkit-sticky;
  position: sticky;
  left:0;
  z-index:1;
}
</style>
<style>
    .none-line{
        border: none;
    }
    .width-table{
        width: 170px;
    }
</style>
<style>
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

</style>
<div   style=" overflow:auto;width:99%;height:400px" >
 <table width="99%" border="0" cellpadding="0" cellspacing="0" class="tbchuan" >		
 			<tr bgcolor="#F8E4CB" class="fixed-top">
			<td align="center"  height="23" width="29"><b>STT</b></td>
			 <td width="76" align="center"><strong>soct</strong> </td> 
			 <td width="76" align="center"><strong>Ngày Pass</strong> </td> 
			  <td width="76" align="center"><strong>Team OL Pass</strong> </td> 
			    <td width="76" align="center"><strong>Cửa hàng Pass</strong> </td> 
				  <td width="76" align="center"><strong>Mã NV Pass</strong> </td> 
			 <td width="48" align="center"><strong>Cửa hàng nhận</strong></td>	 
			  <td width="48" align="center"><strong>Tên KH</strong></td>	 
                <td width="48" align="center"><strong>SĐT KH</strong></td>	
                <td width="48" align="center"><strong>Mã SP</strong></td>
				 <td width="48" align="center"><strong>Số lượng</strong></td>	
				 <td width="48" align="center"><strong>Đơn giá</strong></td>
				  <td width="48" align="center"><strong>Thành tiền(Không bao gồm phí)</strong></td>
				   <td width="48" align="center"><strong>Chiếc khấu</strong></td>
				     <td width="48" align="center"><strong>Giảm giá</strong></td>
					   <td width="48" align="center"><strong>Phí ship</strong></td>
					   <td width="48" align="center"><strong>Thanh toán trực tuyến</strong></td>
					   <td width="48" align="center"><strong>Mua trực tiếp tại cửa hàng</strong></td>
				<td width="48" align="center"><strong>Cửa hàng tự ship</strong></td>
				 <td width="48" align="center"><strong>Thu COD</strong></td>
				  <td width="48" align="center"><strong>Số Hóa Đơn</strong></td>
				    <td width="48" align="center"><strong>Mã vận Đơn</strong></td>
					  <td width="48" align="center"><strong>Đơn vị vận chuyển</strong></td>	
  
		</tr>
		<tbody id="tbdulieu">	
<?php
 
 $mangcohangdu1=[];
$tamchitiet=[];
 
 $mangteam=taomang("lydonhapxuat","ID","Name","");
  $mangch=taomang("cuahang","ID","Name","");
  $mangkh=taomang("customer","ID","Name","");
  $socttam='';
  $r=0;
 // xử lý lọc đơn có
 	while($re = $data->fetch_array($result))
		{
		//echo $r;
		//echo "<pre>";
//			var_dump($re);
//			echo "</pre>";
		//var_dump($re["sohoadon"]);
			
		if($r==0){
			$socttam=$re['sochungtu'];
			$mangcohangdu1[$socttam]["NgayNhan"]=$re["NgayNhan"];
			$mangcohangdu1[$socttam]["LyDo"]=$re["LyDo"];
			$mangcohangdu1[$socttam]["IDKho"]=$re["IDKho"];
			$mangcohangdu1[$socttam]["IDTao"]=$re["IDTao"];
			$mangcohangdu1[$socttam]["TiGia"]=$re["TiGia"];
			$mangcohangdu1[$socttam]["sohoadon"]=$re["sohoadon"];
			$mangcohangdu1[$socttam]["mavd"]=$re["mavd"];
			$mangcohangdu1[$socttam]["donvivc"]=$re["donvivc"];
			$mangcohangdu1[$socttam]["tenKH"]=$re["tenKH"];
			$mangcohangdu1[$socttam]["sodtkh"]=$re["sodtkh"];
			$mangcohangdu1[$socttam]["manv"]=$re["manv"];
			$mangcohangdu1[$socttam]["cuahangnhan"]=$re["cuahangnhan"];
			$mangcohangdu1[$socttam]["phiship"]=$re["phiship"];
			
			$tam["IDchnhan"]=$re["IDchnhan"];
			$tam["mahang"]=$re["mahang"];
			$tam["SoLuong"]=$re["SoLuong"];
			$tam["DonGia"]=$re["DonGia"];
			$tam["thanhtien"]=$re["thanhtien"];
			$tam["chieckhau"]=$re["chieckhau"];
			array_push($tamchitiet,$tam);
			//$tam["cuahangnhan"]=$re["cuahangnhan"];
			
			
		}
		if($r>0 && $r<($numrow-1)){
			if($socttam!=$re['sochungtu']){
			
				$mangcohangdu1[$socttam]["chitiet"]=$tamchitiet;
				$tamchitiet=[];
				$socttam=$re['sochungtu'];
				$mangcohangdu1[$socttam]["NgayNhan"]=$re["NgayNhan"];
				$mangcohangdu1[$socttam]["LyDo"]=$re["LyDo"];
				$mangcohangdu1[$socttam]["IDKho"]=$re["IDKho"];
				$mangcohangdu1[$socttam]["IDTao"]=$re["IDTao"];
				$mangcohangdu1[$socttam]["TiGia"]=$re["TiGia"];
				$mangcohangdu1[$socttam]["sohoadon"]=$re["sohoadon"];
				$mangcohangdu1[$socttam]["mavd"]=$re["mavd"];
				$mangcohangdu1[$socttam]["donvivc"]=$re["donvivc"];
				$mangcohangdu1[$socttam]["tenKH"]=$re["tenKH"];
				$mangcohangdu1[$socttam]["sodtkh"]=$re["sodtkh"];
				$mangcohangdu1[$socttam]["manv"]=$re["manv"];
				$mangcohangdu1[$socttam]["cuahangnhan"]=$re["cuahangnhan"];
				$tam["IDchnhan"]=$re["IDchnhan"];
				$tam["mahang"]=$re["mahang"];
				$tam["SoLuong"]=$re["SoLuong"];
				$tam["DonGia"]=$re["DonGia"];
				$tam["thanhtien"]=$re["thanhtien"];
				$tam["chieckhau"]=$re["chieckhau"];
				array_push($tamchitiet,$tam);
				//$tam["cuahangnhan"]=$re["cuahangnhan"];
			
			}else{
			
				$tam["IDchnhan"]=$re["IDchnhan"];
				$tam["mahang"]=$re["mahang"];
				$tam["SoLuong"]=$re["SoLuong"];
				$tam["DonGia"]=$re["DonGia"];
				$tam["thanhtien"]=$re["thanhtien"];
				$tam["chieckhau"]=$re["chieckhau"];
				array_push($tamchitiet,$tam);
			}
			
		
		}
		
		if($r==($numrow-1)){
			$tam["IDchnhan"]=$re["IDchnhan"];
				$tam["mahang"]=$re["mahang"];
				$tam["SoLuong"]=$re["SoLuong"];
				$tam["DonGia"]=$re["DonGia"];
				$tam["thanhtien"]=$re["thanhtien"];
				$tam["chieckhau"]=$re["chieckhau"];
				array_push($tamchitiet,$tam);
			$mangcohangdu1[$socttam]["chitiet"]=$tamchitiet;
			
			$tamchitiet=[];
		}
		
		$r++;
	}
	$_SESSION["mangidhientai"]= $mangidhientai;
	//var_dump($_SESSION["mangidhientai"]);
	$mangall=array($mangcohangdu1);
	
		//echo "<pre>";
//		var_dump($mangall);
//		echo "</pre>";
	
	$r=0;
foreach($mangall as $key => $value){


foreach($value as $k => $re){


								
 if($mau == "#77bf7b33")
{	{
	 $mau = "#EEEEEE";
	 $hl = "Normal4" ;
	 $hl2 = "Highlight4";
	}
	 $hl = "Normal4" ;
	 $hl2 = "Highlight4"; 
}else { 
$mau = "#77bf7b33";
$hl = "Normal5" ;
$hl2 = "Highlight5";
} 	
			
	
 	 ?>
 	 	<tr style="background-color:<?php echo $mau; ?>">
		<td><?php echo $r+1; ?></td>
		<td><?php echo $k; ?></td>
		<td><?php echo $re["NgayNhan"]; ?></td>
		<td><?php echo $mangteam[$re["LyDo"]]; ?></td>
		<td><?php echo $mangch[$re["IDKho"]]; ?></td>
		<td><?php echo $re["manv"]; ?></td>
		<?php 
			if($re["chitiet"][0]['IDchnhan']){
				?>
					<td><?php echo $mangch[$re["chitiet"][0]['IDchnhan']]; ?></td>
				
				<?php
			}
			else{
				?>
					<td><?php echo $mangch[$re['cuahangnhan']]; ?></td>
				
				<?php
			}
		
		?>
		
		<td><?php echo $re["tenKH"]; ?></td>
		<td><?php echo $re["sodtkh"]; ?></td>
		<td><?php echo $re["chitiet"][0]['mahang']; ?></td>
		<td><?php echo $re["chitiet"][0]['SoLuong']; ?></td>
		<td><?php echo $re["chitiet"][0]['DonGia']; ?></td>
		<td><?php echo $re["chitiet"][0]['thanhtien']; ?></td>
		<td><?php echo $re["chitiet"][0]['chietkhau']; ?></td>
		<td><?php echo $re["TiGia"]; ?></td>
		
		<td><?php echo number_format($re["phiship"]); ?></td>
		<td><?php echo $re["tttt"]; ?></td>
		<td><?php echo $re["muatttch"]; ?></td>
		<td><?php echo $re["cuahangts"]; ?></td>
		<td><?php echo $re["thucod"]; ?></td>
		<td><?php echo $re["sohoadon"]; ?></td>
		<td><?php echo $re["mavd"]; ?></td>
		<td><?php echo $re["donvivc"]; ?></td>
		</tr>
		
<?php		
	$r1=0;
	if($re["chitiet"]){
		foreach($re["chitiet"] as $keyct => $valuect ){
			if($r1>0){
		?>
				<tr>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td><?php echo $mangch[$valuect['IDchnhan']]; ?></td>
		
		
		<td></td>
		<td></td>
		<td><?php echo $valuect['mahang']; ?></td>
		<td><?php echo $valuect['SoLuong']; ?></td>
		<td><?php echo $valuect['DonGia']; ?></td>
		<td><?php echo $valuect['thanhtien']; ?></td>
		<td><?php echo $valuect['chietkhau']; ?></td>
		<td></td>
		
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		</tr>
				<?php
				}
				$r1++;
		}	
		}
	$r++;
		}

		
	}
?>	</tbody>
	
</table>
<?php echo $chuoiphantrang; ?>
</div>
<div style="padding:5px;" >
<div id="khonghienthires"></div>
<?php 
//==============================================================	
    if ( $numrow != 0 ) {
 ?>
  Tìm thấy  <?php echo  $numrow ; ?>   phiếu ! &nbsp;   <?php if ($numrow > $pagesize ) echo "Trang : ". $pt ; ?>  
  <?php 
  } else
  {
  	 echo "<font size=2  color='#FF3300'>Không tìm thấy phụ khách hàng, bạn có thể tìm theo từ ngắn hơn hoặc bấm vào nút '<b>Thêm </b>' để thêm khách hàng !!!</font> " ;
  }
 //==============================================================	
 ?> 

 </div>
 
 
<?php				
   
function manghanghoacuhang($idch)
{ 	
	global $data ;
	
 		 $sql = " select a.* from hanghoacuahang a where a.IDcuahang='$idch'";
		$query=$data->query($sql);
		$mangtam=[];
		while($re=$data->fetch_array($query)){
			$mangtam[$re['IDSP']]=$re['SoLuong'];
		}	
				    
	   return $mangtam;
}

function mangsppass($idp)
{ 
	global $data ;
	
 		 $sql = " select a.*,b.size,b.mau from passdonchitiet a left join products b on a.IDSP =b.ID where a.IDPhieu='$idp'";
		 
		$query=$data->query($sql);
		$mangtam=[];
		while($re=$data->fetch_array($query)){
			$mangtam[$re['IDSP']]=array("ID"=>	$re['ID'],"ten"=>	$re['tenpt'],"mahang"=>	$re['mahang'],"dongia"=>$re['DonGia'],"SoLuong"=>	$re['SoLuong'],"size"=>	$re['size'],"mau"=>	$re['mau'],"IDchnhan"=>	$re['IDchnhan'],"IDnvnhan"=>	$re['IDnvnhan']);
		}	
				    
	   return $mangtam;
}

function getchhuydudon($idphieu){
	global $data ;
	$sql="select IDcuahang  from passdoncuahanghuy where IDpassdon='$idphieu'";
		$query=$data->query($sql);
		$mangtam=[];
		while($re=$data->fetch_array($query)){
			array_push($mangtam,$re["IDcuahang"]);
		}
	return $mangtam;
}	
function laycuahangdudon($idsp,$soluong){
global $data ;
	$sql="select IDcuahang from hanghoacuahang where IDSP='$idsp' and SoLuong>='$soluong'";
	//echo $sql;
	$query=$data->query($sql);
		$mangtam=[];
		while($re=$data->fetch_array($query)){
			array_push($mangtam,$re["IDcuahang"]);
		}
	return $mangtam;
}
function checkhuydon($idch,$idpassdon){

	$sql="select DATE_FORMAT(ngayhuy,'%d-%m-%Y %h:%i:%s') as ngayhuydon from passdoncuahanghuy where IDpassdon='$idpassdon' and IDcuahang>='$idch'";
	$dong=getdong($sql);
	return $dong["ngayhuydon"];
}




 $data->closedata() ;
?>	