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
		SELECT  a.*,a.ID as idphieu,a.SoCT as sochungtu,DATE_FORMAT(a.ngaytao,'%d/%m/%y %h:%i') as ngaytao,u.ten,u.manv,c.Name as tenKH,c.tel as sodtkh,c.address as diachikh 
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
   $manv=    ($tmp[0])    ;
   $madonvan =addslashes(trim($tmp[1]));
   $tenkhach= addslashes($tmp[2]);
   $tel= $tmp[3];   
   $tinhtrang= $tmp[4];
   $tinhtranghang= $tmp[5];
   $tu= $tmp[6];
   $den= $tmp[7];
   $nguoitao= $tmp[8];
   $trang= $tmp[9];
    $cuahang= $tmp[11];
	$lydo= $tmp[12];
   $NgayTao = gmdate('Y-m-d H:i:s', time() + 7*3600) ;
    $curentpage= $tmp[13];
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
		$sql_where=" where 1=1  ";
		if($manv!="") $sql_where.=" and u.MaNV  = '".$manv."'";
		if($cuahang){
			$sql_where.=" and a.IDKho = '$cuahang' or a.cuahangnhan='$cuahang'";
		}
		
		
		if($lydo){
			$sql_where.=" and a.LyDo = '$lydo'";
		}
		if($madonvan!="") $sql_where.=" and a.SoCT  = '".$madonvan."'";
		if($tenkhach !="")  $sql_where.=" and a.tenkhach  like '%".$tenkhach."%'";
		if($tel!="") { $tam=$tel ; if($tel[0]==0 )  $tam[0]=""; $sql_where.=" and a.tel  like '%".trim($tam)."%'";   } 
		if($tinhtrang >0) { 	$sql_where.=" and a.tinhtrang= $tinhtrang  "; 		}
		if($tinhtranghang >0) { 	$sql_where.=" and a.tinhtranghang= $tinhtranghang  "; 	}	
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
		SELECT  a.*,a.ID as idphieu,a.SoCT as sochungtu,DATE_FORMAT(a.ngaytao,'%d/%m/%y %h:%i') as ngaytao,DATE_FORMAT(a.ngayhuy,'%d/%m/%y %h:%i') as ngayhuy,DATE_FORMAT(a.NgayNhan,'%d/%m/%y %h:%i') as NgayNhan,DATE_FORMAT(a.ngaykhoa,'%d/%m/%y %h:%i') as ngaykhoa,a.lydohuy,u.ten,u.manv,c.Name as tenKH,c.tel as sodtkh,c.address as diachikh 
		FROM passdon a left join userac u on a.idtao=u.id left join customer c on a.IDNhaCC=c.ID ".$sql_where."    ORDER BY  a.idtao ,a.ngaytao desc";
			$limit=10;
	 	 $start=($curentpage-1)*$limit;
	$sql ="
SELECT  a.*,a.ID as idphieu,a.SoCT as sochungtu,DATE_FORMAT(a.ngaytao,'%d/%m/%y %h:%i') as ngaytao,DATE_FORMAT(a.ngayhuy,'%d/%m/%y %h:%i') as ngayhuy,DATE_FORMAT(a.NgayNhan,'%d/%m/%y %h:%i') as NgayNhan,DATE_FORMAT(a.ngaykhoa,'%d/%m/%y %h:%i') as ngaykhoa,a.lydohuy,u.ten,u.manv,c.Name as tenKH,c.tel as sodtkh,c.address as diachikh 
FROM passdon a left join userac u on a.idtao=u.id left join customer c on a.IDNhaCC=c.ID ".$sql_where."    ORDER BY  a.idtao ,a.ngaytao desc limit  $start, $limit";

   }


		
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
 			<tr bgcolor="#F8E4CB">
			<td align="center"  height="23" width="29"><b>STT</b></td>
			 <td width="76" align="center"><strong>Số chứng từ</strong> </td> 
			 <td width="48" align="center"><strong>NV Tạo</strong></td>	 
			 <td width="48" align="center"><strong>Cửa hàng nhận</strong></td>	 
			  <td width="48" align="center"><strong>Nhân viên nhận</strong></td>	 
                
                 	  
    <!--  <td width="70" align="center"><strong>Tên khách / ĐT</strong></td>  
	    
	<td width="85" align="center"><strong>Tình trạng nhận đơn</strong> </td>-->

     
  
	  <td width="353" align="center"><strong>Mã HH </strong> </td> 
        
 	  
 <td width="68" align="center"><strong>Tổng Tiền</strong></td>  
  <td width="40" align="center"><strong>Ngày tạo</strong></td>	  
 <td width="76" align="center"><strong>Ngày nhận </strong></td>	
 <td width="82" align="center"><strong>Ngày hoàn thành</strong></td>
 
		</tr>
		<tbody id="tbdulieu">	
<?php
  $mangnhanvien =taomang("userac","ID","ten"," where ID >0    ");	//  loai in (16,5,6,10) 
 $mangnhanvien[1]='admin';
 
 $mangchotdon[1]="Chưa gọi được ca 1";
 $mangchotdon[2]="Đã gọi khách";
 $mangchotdon[3]="Đã hủy đơn gọi 3 ca";
 $mangchotdon[4]="Chưa gọi được ca 2";
 $mangchotdon[5]="Chưa gọi được ca 3";
 $mangchotdon[6]="Đã hủy đơn khách mua thêm";
 $mangcohangdu1=[];
 $mangcohangdu2=[];
 $mangcohangthieu1=[];
 $mangcohangthieu2=[];
 $mangkocohang=[];
 
 // xử lý lọc đơn có
 	while($re = $data->fetch_array($result))
	{
		if(!in_array($re['idphieu'],$mangidhientai)){
				array_push($mangidhientai,$re['idphieu']);
		}
		// kiêm tra xem của hàng có nhận hết chưa
			$chnhanhet=$re['cuahangnhan'];
			$nvnhanhet=$re['nhanviennhan'];
		//lấy thong tin chi tiết đơn
		 $maspve= mangsppass($re['idphieu']);
		 $checkdu=0;
		 $checkthieu=0;
		 $checkkoco=0;
		 $tammang=[];
		 foreach($maspve as $key =>$value){
					$tammang[$key]=$value;
					$tammang[$key]['cuahangnhanhet']=$chnhanhet;
					$tammang[$key]['nhanviennhanhet']=$nvnhanhet;
					//lấy số lượng có của của hàng hiện tại đang đăng nhập
					$tammang[$key]["soluongco"]=$arrhhcuahang[$key]?$arrhhcuahang[$key]:0;
		 			
		 }
		 
		 $re["chitietsp"]= $tammang;
		array_push($mangcohangdu1,$re);
	}
	$_SESSION["mangidhientai"]= $mangidhientai;
	//var_dump($_SESSION["mangidhientai"]);
	$mangall=array($mangcohangdu1);
	/*echo "<pre>";
		var_dump($mangall);
		echo "</pre>";
	return;*/
foreach($mangall as $key => $value){

	// chỉ hiện thị nút xác nhận và hủy đơn khi ở mảng đủ 1 và mảng đủ 2
	$hienxacnhan=false;
	if($key==0 || $key==1){
	
		$hienxacnhan=true;
	}	
	$dudon='';
	//nếu key =0 (cưa hàng đủ đơn) thì truyền tham số xác nhận đủ đơn
	if($key==0){
	 		$dudon='all';
	 }
foreach($value as $k => $re){
					 $hienthihuy="";
				 	$hienthixacnhan="";
					$chuoichitietnhan='';
					// kiểm tra cửa hàng hủy đơn
					$huydonch=checkhuydon($idcuahang,$re["ID"]);	
						
 if($mau == "white")
{	{
	 $mau = "#EEEEEE";
	 $hl = "Normal4" ;
	 $hl2 = "Highlight4";
	}
	 $hl = "Normal4" ;
	 $hl2 = "Highlight4"; 
}else { 
$mau = "white";
$hl = "Normal5" ;
$hl2 = "Highlight5";
} 
  $disbledkhoa='';
  $cuahangnhan='';
  $tinhtrangkhoa='Phiếu chưa khóa';
  if($re['tinhtrang']==4){
  		$tinhtrangkhoa="<span style='color:#ff9800;font-weight:bold'>Phiếu đã khóa</span>";
  }
   else if($re['tinhtrang']==3){
  		$tinhtrangkhoa="<span style='color:red;font-weight:bold'>Phiếu đã hủy<br>
		<span>$re[lydohuy]</span><br>
			<span>$re[ngayhuy]</span><br>
		</span>";
  }
   //$arrhhcuahang 
  $maspve= mangsppass($re['idphieu']);
  
  //kiểm tra tình trạng nhận đơn
  $tinhtrangnhandon='';
  $tamid='';
  $tammangch=[];
  $nhanviennhandon='';
 $danhanhet=false;
  	foreach($re["chitietsp"] as $key =>$value){
				if($value["cuahangnhanhet"]){
				
					 $tinhtrangnhandon.="<span id='ttnhandonch".$value["cuahangnhanhet"]."'>".getten("cuahang",$value['cuahangnhanhet'],"Name")." Nhận hết</span><br>";
					  $nhanviennhandon.="<span id='ttnhandonnv".$value["nhanviennhanhet"]."'>".getten("userac",$value['nhanviennhanhet'],"Ten")."</span><br>";
					 
					 if($value["cuahangnhanhet"]!=$idcuahang){
					  	$danhanhet=true;
					  }
					 break;
				}
				else{
				
					if($value["IDchnhan"]!=$tamid){
						$tamid=$value["IDchnhan"];
					
						 $tammangch[$tamid]['sl']=1;
						$tammangch[$tamid]['IDnvnhan']=$value['IDnvnhan'];
					}
					else{
							if($tammangch[$value["IDchnhan"]]['sl']){
								$tammangch[$value["IDchnhan"]]['sl']+=1;
							}
					}
					
					
				}
	}
	if(count($tammangch)>0){
		  
		foreach($tammangch as $key =>$value){
			if($key){
			
			  $nhanviennhandon.="<span id='ttnhandonnv".$value["IDnvnhan"]."'>".getten("userac",$value['IDnvnhan'],"Ten")."</span><br>";
				if($key!=$idcuahang){
					$danhanhet=true;
				}
			$tinhtrangnhandon.="<span id='ttnhandonch".$key."'>".getten("cuahang",$key,"Name")."nhận $value[sl] SP</span><br>";
			
			}
		}
	}
	
	
 		/*			  echo "<pre>";
  var_dump($tinhtrangnhandon);
echo "</pre>";*/
	
 	 ?>
 	 	<tr class="dong_show" id="dong_<?php echo  $re['ID'] ; ?>" title="<?php echo addslashes($re['note']) ?>"   onMouseOver="this.className='<?php echo $hl2; ?>'" onMouseOut="this.className='<?php echo $hl; ?>'"  bgcolor="<?php echo $mau; ?>"  style="color:<?php echo $mangtinhtrangmau[$re['tinhtrang']] ; ?>"   >
		  <td align="right"> <?php echo $r+1 ;?> </td>	
		  <td ><?php echo $re['sochungtu'];?>	
		   <td ><?php echo $re[ten];?></td>	
		    <td style="color:#009933;font-weight:bold" id="tinhtrangnhandon<?php echo $re['ID'];?>"><?php echo $tinhtrangnhandon;?></td>  
			<td style="color:#009933;font-weight:bold" id="nhanviennhandon<?php echo $re['ID'];?>"><?php echo  $nhanviennhandon;?></td>  
			
          		
            
                
                
                <td style="">
					<ul style="padding-left:1em">
				<?php 
				$chuoichitietnhan='';
				$chuoiidsp='';
				$idsp='';
				$checknguyedon=false;
				$tongtien=0;
				foreach($re["chitietsp"] as $key =>$value){
				//var_dump($value);
				$chuoiidsp.=$value["ID"]."*";
				$idsp=$value["ID"];
				
				$arrhhcuahang=manghanghoacuhang($idcuahang,$key);
				//echo $value['cuahangnhanhet'];
				if($value['cuahangnhanhet']){
						$checknguyedon=true;
						$chnhan=getten("cuahang",$value['cuahangnhanhet'],"Name");
				}
				else{
					$chnhan=getten("cuahang",$value["IDchnhan"],"Name");
				}
				
				if($value["IDchnhan"]==$idcuahang || $value['cuahangnhanhet']){
					$cuahangnhan.=$value["ID"]."*";
				}
				
					$tongtien+=($value["SoLuong"]*$value["dongia"]);
					$maubgco='';
					$mauchuco='#cccccc';
					if($arrhhcuahang[$key]){
						if($arrhhcuahang[$key]>=$value["SoLuong"]){
							$maubgco="#03a9f45c";
							$mauchuco='#0066FF';
							$chuoichitietnhan.=$value["ID"]."*";
							
						}
						else if($arrhhcuahang[$key]<$value["SoLuong"] && $arrhhcuahang[$key]>0)
						{
								$maubgco="#ff57228c";
						}	
					}
					
					if($chnhan){
						$maubgco='';
						$mauchuco='#cccccc';
					}
					//echo $cuahangnhan;
				?>
				
					<li id="sp<?php echo $idsp;?>" style="border-bottom:1px solid #c1c1c1;padding:0.5em;background-color:<?php echo $maubgco;?>">
					<span><span class="infsp" style="color:<?php echo $mauchuco; ?>;font-weight:500">Tên:</span> <?php echo $value["ten"];?></span></br>
					<span><span class="infsp" style="color:<?php echo  $mauchuco; ?>;font-weight:500">Size:
					</span> <?php echo $mangsize[$value["size"]];?>
					</span><span><span class="infsp" style="color:<?php echo  $mauchuco; ?>;font-weight:500"> Màu:</span> <?php echo $mangmau[$value["mau"]];?></span></br>
				
				<span><span class="infsp" style="color:<?php echo  $mauchuco; ?>;font-weight:500">Số lượng:</span> <?php echo $value["SoLuong"];?><span class="infsp" style="color:<?php echo  $mauchuco; ?>;font-weight:500"> Giá:</span> <?php echo number_format($value["dongia"]);?><span  class="infsp" style="color:<?php echo  $mauchuco; ?>;font-weight:500"> &nbsp;&nbsp;&nbsp;&nbsp;SL có:</span> <?php echo $arrhhcuahang[$key]?$arrhhcuahang[$key]:0;?></span></br>
			<?php 
				if($chnhan){
				?>
					<span id="spchnhan<?php echo $value["ID"];?>" style="color:#4caf50;font-weight:500"><span style="color:#4caf50;font-weight:500"> Cửa hàng nhận:</span> <?php echo $chnhan;?></span>
				<?php
				}
			?>
				
					</li>
						
				<?php
						//
				}  ?></ul></td>
  				  			
               
				<td ><?php echo formatso($tongtien) ;?></td> 
				  <td ><?php echo $re['ngaytao'] ;?><br /> </td>
				  <td ><?php echo $re['NgayNhan'] ;?><br /> </td>	
				   <td ><?php echo $re['ngayhoanthanh'] ;?><br /> </td>	
               
    </tr>
<?php		

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