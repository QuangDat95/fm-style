<?php  
session_start();
//set_time_limit(0);
 $quyen= $_SESSION["quyen"] ; 
 date_default_timezone_set('Asia/Ho_Chi_Minh');
//ini_set('memory_limit', '-1');$_SESSION["act"]
if ($_SESSION["LoginID"]=="") return ;
$ql =$quyen[$_SESSION["mangquyenid"][$_SESSION["act"]]] ;  

$root_path =getcwd()."/"  ;
include($root_path."biensession.php");
include($root_path."includes/config.php");
include($root_path."includes/removeUnicode.php");
include($root_path."includes/class.paging.php");
include($root_path."includes/class.mysql.php");
include($root_path."includes/function.php");
include($root_path."includes/function_local.php");
include( $root_path."excel/simplexlsx.class.php");  
include( $root_path."cauhinhtailenvandonluubien.php"); 
$cauhinhvc=$mangcauhinhvc?json_decode($mangcauhinhvc,true):"";


 //$path = $root_path."data/maubanhangpancake.xlsx"  ; 
 //var_dump($ql[5]); 
$idk = laso($_SESSION["LoginID"]) ; if ($idk == 0) return ;
   $idkho = $_SESSION["se_kho"] ;
$data = new class_mysql();
$data->config();
$data->access();

?>
<div style="overflow:scroll;height:450px">
<style>.tbchuan th, .tbchuan td{
	
}</style>
<strong style="color:#F90">Đọc dữ liệu từ dòng 13 của file Excel</strong> <br />
<table id="tbex" width="100%" border="0" cellpadding="0" cellspacing="0" style="background:#FFF;" class="tbchuan">		
 	
<?php

$tm = $_SESSION["root_path"] ;

//đọc dữ liệu
$path = $root_path."data/vandontailen".'-'.$idk.'-'.$idkho.".xlsx" ;
$xlsx = new SimpleXLSX($path);
//var_dump($xlsx);
$sheets=$xlsx->rows();
$sheettam=$sheets;


$rows_begin = 12;
$rows_end = count($sheets);
$tam=[];
$loi=false;
if ($count_rows >= 600) $rows_end = 600;
list($cols,) = $xlsx->dimension();
$cols=22;
if(isset($_POST['DATA'])){
	
	//$_SESSION["mangluuvc"]=[];;
	$data1 = $_POST['DATA']; 
	$tmp = explode('*@!',$data1);
	$tudong=laso($tmp[1]);
	
	$dendong=laso($tmp[2]);
	$manvc=chonghack($tmp[3]);
	
	$loai=chonghack($tmp[4]);
	if($loai==0){
		$_SESSION["mangkotontai"]=[];
		$_SESSION["mangtonvandon"]=[];
			$_SESSION["mangtonsobill"]=[];
			$_SESSION["manggtdhkhonghople"]=[];
		if($tudong){
			$rows_begin =($tudong);
		}
		if($dendong){
			$rows_end=($dendong);
		}	
		
		
	}
	
	$sott=0;
	if($loai==1){
		$sheets=$_SESSION["mangkotontai"];
		$rows_begin=0;
		$rows_end=count($sheets);
	}
	if($loai==2){
		$sheets=$_SESSION["mangtonvandon"];
		
		$rows_begin=0;
		$rows_end=count($sheets);
	}
	if($loai==3){
		
		$sheets=$_SESSION["mangtonsobill"];
		$rows_begin=0;
		$rows_end=count($sheets);
	}
	if($loai==4){
		
		$sheets=$_SESSION["manggtdhkhonghople"];
		$rows_begin=0;
		$rows_end=count($sheets);
	}
	
		
	$cauhinh=$cauhinhvc[$manvc];
	

	
	foreach($sheets as $k => $r) {
		
		$checkloi=false;		
		
		$mauchu='green';
		$thongbaoloi='';
		$onclick='';
		if($manvc=='KMVD'){
			if($k==0){
			?>
				
					<tr bgcolor="#F8E4CB" style="position: sticky;top: 0px;">
			
						<td align="left" style="">
							<span><?php echo $r[0]; ?></span>
						</td>
						<td align="left" style="">
						<span>	<?php echo $r[$cauhinh['socot']['sobill']['cot']]; ?></span>
							
						</td>
						<td align="left" style="">
						<span>	<?php echo $r[$cauhinh['socot']['mavd']['cot']]; ?></span>
							
						</td>
						<td align="left" style="">
						<span>	<?php echo $r[$cauhinh['socot']['dongthoigiantrangthaidon']['cot']]; ?></span>
							
						</td>
						
					</tr>
			
			<?php
			}
			if (($k >= $rows_begin) && ($k <= $rows_end)) {
				?>
				
					<tr id="" style="cursor:pointer;color:<?=$mauchu?>" onclick="">
						
						<td align="left" style="">
							<span><?php echo $r[0]; ?></span>
						</td>
						<td align="left" style="">
						<span>	<?php echo $r[$cauhinh['socot']['sobill']['cot']]; ?></span>
							
						</td>
						<td align="left" style="">
						<span>	<?php echo $r[$cauhinh['socot']['mavd']['cot']]; ?></span>
							
						</td>
						<td align="left" style="">
						<span>	<?php echo $r[$cauhinh['socot']['dongthoigiantrangthaidon']['cot']]; ?></span>
							
						</td>
					</tr>
					
				<?php
			}
			
		}
		else{
		
		//$ngayhoanthanh=$r[$cauhinh['socot']['ngayhoanthanh']['cot']];
//		echo $ngayhoanthanh;
			
		if($k==0){
			if($loai==0){
				array_push($_SESSION["mangtonvandon"],$r);
				array_push($_SESSION["mangkotontai"],$r);
				array_push($_SESSION["mangtonsobill"],$r);
				array_push($_SESSION["manggtdhkhonghople"],$r);
			}
			?>
			<tr bgcolor="" style="position: sticky;top: -1px;    background-color: white;">
			
						<td align="left" style=" " colspan="15" >
							<button onclick="filterVandon(1)">Lọc mã vận đơn Không tồn tại</button>
							<button  onclick="filterVandon(2)">Lọc mã vận đơn tồn tại</button>
							<button  onclick="filterVandon(3)">Lọc số bill tồn tại</button>
							<button  onclick="filterVandon(4)">GTĐH không hợp lệ</button>
						</td>
						
				
					</tr>
					<tr bgcolor="#F8E4CB" style="position: sticky;top: 30px;">
			
						<td align="left" style="">
							<span><?php echo $r[0]; ?></span>
						</td>
						<td align="left" style="">
						<span>	<?php echo $r[$cauhinh['socot']['madh']['cot']]; ?></span>
							
						</td>
						<td align="left" style="">
						<span>Số bill phần mềm</span>
							
						</td>
						<td align="left" style="">
						<span>	<?php echo $r[$cauhinh['socot']['sobill']['cot']]; ?></span>
							
						</td>
						<td align="left" style="">
							<span><?php echo $r[$cauhinh['socot']['tongtien']['cot']]; ?></span>
							
						</td>
						<td align="left" style="">
							<span><?php echo $r[$cauhinh['socot']['phitravc']['cot']]; ?></span>
						
						</td>
						<td align="left" style="">
							<span><?php echo $r[$cauhinh['socot']['dongthoigiantrangthaidon']['cot']]; ?></span>
						
						</td>
						<td align="left" style="">
							<span><?php echo $r[$cauhinh['socot']['giatrihanghoa']['cot']]; ?></span>
						
						</td>
						<td align="left" style="">
							<span>Phí thu KH tính được</span>
						
						</td>
							<td align="left" style="">
							<span>Phí thu KH trên hệ thống</span>
						
						</td>
						
						</td>
							<td align="left" style="">
							<span>Ngày tạo đơn</span>
						
						</td>
						</td>
							<td align="left" style="">
							<span>Ngày lấy hàng</span>
						
						</td>
						</td>
							<td align="left" style="">
							<span>Ngày Giao hàng</span>
						
						</td>
						</td>
							<td align="left" style="">
							<span>Ngày Trả hàng</span>
						
						</td>
						</td>
							<td align="left" style="">
							<span>Ngày đối soát</span>
						
						</td>
						</td>
							<td align="left" style="">
							<span>Ngày Giao hàng lần 1</span>
						
						</td>
						</td>
							<td align="left" style="">
							<span>Ngày Giao hàng lần 2</span>
						
						</td>
						</td>
							<td align="left" style="">
							<span>Ngày Giao hàng lần 2</span>
						
						</td>
					</tr>
					<?php
			}
				
		if (($k >= $rows_begin) && ($k <= $rows_end)) {
		
			$tt1='';
			$tt2='';
			$checkvanchuyen = CheckVanChuyendon($r[$cauhinh['socot']['madh']['cot']]);
			$checksobill='';
			$thongbaosobill='';
			$thongbaomadh='';
			$thongbaomavd='';
			$thongbaotongtien='';
			$thongbaophitravc='';
			$phithukh='';
			if($r[$cauhinh['socot']['sobill']['cot']]){
			
				$checksobill=checkBill($r[$cauhinh['socot']['sobill']['cot']]);
						if($checksobill && !$checkvanchuyen['ID']){
							array_push($_SESSION["mangtonsobill"],$r);
							$tt1=$checksobill['dongthoigiantrangthaidon'];
							
							/*array_push($_SESSION["mangluuvc"],array(
								'madh'=>$r[$cauhinh['socot']['madh']['cot']],
								'mavd'=>$r[$cauhinh['socot']['madh']['cot']],
								'sobill'=>$r[$cauhinh['socot']['sobill']['cot']],
								'tongtien'=>$r[$cauhinh['socot']['tongtien']['cot']],
								'phitravc'=>$r[$cauhinh['socot']['phitravc']['cot']],
								'dongthoigiantrangthaidon'=>$r[$cauhinh['socot']['dongthoigiantrangthaidon']['cot']],
							));*/
								$mauchu='blue';
								$thongbaoloi.='Phát hiện phiếu bán hàng tương ứng trong hệ thống\n';
								$checkloi=true;
								$thongbaosobill.='<br/><span style="color:green;font-size:10px">Phát hiện phiếu</span>';
								/*if($checksobill['madh'] && $checksobill['madh']!=$r[$cauhinh['socot']['madh']['cot']]){	
									$madhc=$checksobill['madh']?$checksobill['madh']:"chưa có";
									$thongbaomadh='<br/><span style="color:red;font-size:10px">Mã đơn hàng không trùng</span>';
									$thongbaomadh.='<br/><span style="color:red;font-size:10px">Mã: '.$madhc.'</span>';
								}*/
								
								/*if($checksobill['mavd'] && $checksobill['mavd']!=$r[$cauhinh['socot']['mavd']['cot']]){
								
								$mavdc=$checksobill['mavd']?$checksobill['mavd']:"chưa có";
									$thongbaomavd='<br/><span style="color:red;font-size:10px">Mã vận đơn không trùng</span>';
									$thongbaomavd.='<br/><span style="color:red;font-size:10px">Mã: '.$mavdc.'</span>';
								}*/
								/*if($checksobill['tongtien'] && $checksobill['tongtien']!=$r[$cauhinh['socot']['tongtien']['cot']]){
								$tongtienc=$checksobill['tongtien']?$checksobill['tongtien']:"chưa có";
									$thongbaotongtien='<br/><span style="color:red;font-size:10px">Tổng tiền  không trùng</span>';
									$thongbaotongtien.='<br/><span style="color:red;font-size:10px">Tổng tiền: '.$tongtienc.'</span>';
								}
								if($checksobill['phitravc'] && $checksobill['phitravc']!=$r[$cauhinh['socot']['phitravc']['cot']]){
								
								$phitravcc=$checksobill['phitravc']?$checksobill['phitravc']:"chưa có";
									$thongbaophitravc='<br/><span style="color:red;font-size:10px">phí vận chuyển không trùng</span>';
									$thongbaophitravc.='<br/><span style="color:red;font-size:10px">Phí vc: '.$phitravcc.'</span>';
								}*/
						}
						
					
				
			}
			$sobillpm='';
			if($checkvanchuyen['ID']){
				array_push($_SESSION["mangtonvandon"],$r);
				$tt2=$checkvanchuyen['dongthoigiantrangthaidon'];
				$thongbaoloi.='Phát hiện mã đơn hàng trong hệ thống\n';
				$thongbaomadh='<br/><span style="color:green;font-size:10px">Phát hiện phiếu</span>';
				$mauchu='green';
				if($checkvanchuyen['madh']!=$r[$cauhinh['socot']['madh']['cot']]){
						$mauchu='red';
						$thongbaoloi.='Mã đơn hàng không trùng\n';
						$checkloi=true;
						$loi=true;
				}
				else{
					
					if($checkvanchuyen['sobill']){
						$sobillpm=$checkvanchuyen['sobill'];
					}
				}
				
				
			
					$phithukhht=$checkvanchuyen['phithukh'] || $checkvanchuyen['phithukh']==0?$checkvanchuyen['phithukh']:"chưa có";
				
				/*if($checkvanchuyen['mavd']!=$r[$cauhinh['socot']['mavd']['cot']]){
						$mauchu='red';
						$thongbaoloi.='Mã vận đơn không trùng\n';
						$checkloi=true;
						$loi=true;
				}*/
				/*if($checkvanchuyen['tongtien']!=$r[$cauhinh['socot']['tongtien']['cot']]){
						$mauchu='red';
						$thongbaoloi.='Tổng tiền không trùng\n';
						$checkloi=true;
						$loi=true;
				}
				if($checkvanchuyen['phitravc']!=$r[$cauhinh['socot']['phitravc']['cot']]){
						$mauchu='red';
						$thongbaoloi.='phí trả nhà cung cấp không trùng\n';
						$checkloi=true;
						$loi=true;
				}*/
				
			}else  if(!$checksobill && !$checkvanchuyen['ID']){
				$checkloi=true;
				$mauchu='red';
				$thongbaoloi.='Không tồn tại mã đơn hàng trong hệ thống\n';
				if($k!=$rows_begin){
					array_push($_SESSION["mangkotontai"],$r);
				}
			}
					if($cauhinh['socot']['giatrihanghoa']['cot']){
					$gthh=$r[$cauhinh['socot']['giatrihanghoa']['cot']];
					$gthh=str_replace(",","",$gthh);
					
					$tongtien=$r[$cauhinh['socot']['tongtien']['cot']];
					$tongtien=str_replace(",","",$tongtien);
					if($tongtien<$gthh){
						$thongbaoloi.='Giá trị đơn hàng lớn hơn COD\n';
						$checkloi=true;
						$loi=true;
						$mauchu='#9c27b0';
						array_push($_SESSION["manggtdhkhonghople"],$r);
					}
					$phithukh=(int)($tongtien)-(int)($gthh);
					
					if(trim($checkvanchuyen['phithukh']) !== trim($phithukh)){
						//echo $phithukh;
					}
			
				}
			
			
			
			
			if($tt2 == 8||$tt2==1 || $tt1==8 || $tt1==1){
				$checkloi=true;
				$mauchu='#9e9e9e';
				$thongbaoloi.='Phiếu đã ở trạng thái cuối\n';
			}
			if($checkloi){
				$onclick="xuatbaoloi('$thongbaoloi')";
			}
			
			
				
				?>
				
					<tr id="" style="cursor:pointer;color:<?=$mauchu?>" onclick="<?=$onclick?>">
						<td align="left" style="">
						<span>	<?php echo $r[0]; ?></span>
						</td>
						<td align="left" style="">
							<span><?php echo $r[$cauhinh['socot']['madh']['cot']]; ?></span>
							<?php echo $thongbaomadh; ?>
						</td>
						<td align="left" style="">
							<span>	<?php echo $sobillpm; ?></span>
								
							</td>
						<td align="left" style="">
							<span><?php echo $r[$cauhinh['socot']['sobill']['cot']]; ?></span>
							<?php echo $thongbaosobill; ?>
						</td>
						<td align="left" style="">
							<span><?php echo number_format($r[$cauhinh['socot']['tongtien']['cot']]); ?></span>
							<?php echo $thongbaotongtien; ?>
						</td>
						<td align="left" style="">
							<span><?php echo number_format($r[$cauhinh['socot']['phitravc']['cot']]); ?></span>
								<?php echo $thongbaophitravc; ?>
						</td>
						<td align="left" style="">
							<span><?php echo $r[$cauhinh['socot']['dongthoigiantrangthaidon']['cot']]; ?></span>
								
						</td>
						<td align="left" style="">
							<span><?php echo $r[$cauhinh['socot']['giatrihanghoa']['cot']]; ?></span>
								
						</td>
						<td align="left" style="">
							<span><?php echo ($phithukh || $phithukh==0)?number_format($phithukh):""; ?></span>
								
						</td>
						<td align="left" style="">
							<span><?php echo ($phithukhht || $phithukhht==0)?number_format($phithukhht):""; ?></span>
								
						</td>
						</td>
							<td align="left" style="">
							<span><?php echo $r[$cauhinh['socot']['ngaytaodon']['cot']]; ?></span>
						
						</td>
						</td>
							<td align="left" style="">
							<span><?php echo $r[$cauhinh['socot']['ngaylayhang']['cot']]; ?></span>
						
						</td>
						</td>
							<td align="left" style="">
							<span><?php echo $r[$cauhinh['socot']['ngaygiaohang']['cot']]; ?></span>
						
						</td>
						</td>
							<td align="left" style="">
								<span><?php echo $r[$cauhinh['socot']['ngayhuy']['cot']]; ?></span>
						
						</td>
						</td>
							<td align="left" style="">
								<span><?php echo $r[$cauhinh['socot']['ngayhoanthanh']['cot']]; ?></span>
						
						</td>
						
						
							</td>
							<td align="left" style="">
							<span><?php echo $r[$cauhinh['socot']['ngaygiaolan1']['cot']]; ?></span>
						
						</td>
						</td>
							<td align="left" style="">
								<span><?php echo $r[$cauhinh['socot']['ngaygiaolan2']['cot']]; ?></span>
						
						</td>
						</td>
							<td align="left" style="">
								<span><?php echo $r[$cauhinh['socot']['ngaygiaolan3']['cot']]; ?></span>
						
						</td>
					</tr>	
				<?php	
			
		}
	  	
		}
		
	} 
	
	
}
?>

</table>  


</div>
 <div style="padding-bottom:10px;padding-left:20px"><input type="button" id="dulieue" name="dulieue"  onclick="laydulieuexel()" value="Lấy dữ liệu Excel"/> </div>  
 
<?php
 
if ($loi) {?>
<!--
<div style="padding-bottom:10px;padding-left:20px"><input type="button" id="dulieue" name="dulieue"  onclick="xuatbaoloi('Có lỗi trong file tải lên chú ý chổ màu đỏ!')" value="Lấy dữ liệu Excel"/> </div>  -->
 <?php
}
 else  
 {
 ?>
<!-- <div style="padding-bottom:10px;padding-left:20px"><input type="button" id="dulieue" name="dulieue"  onclick="laydulieuexel()" value="Lấy dữ liệu Excel"/> </div>  -->
  <?php
 }
      	
    $data->closedata() ;

function checkcuahang($mach){
global $data;
	$sql="select ID from cuahang where macuahang='$mach'";
	$dong=getdong($sql);
	if($dong['ID']){
		return $dong;
	}
	else{
		return false;
	}
}
function kiemtratontaidulieu($ngaythuchi,$sotien,$lydo,$idkho,$hdbh,$donvi,$sotknh,$tentknh,$donvivc,$mavandon,$manv,$note){
 		//$sql  = " select ID from thuchikt where ngaythuchi='$ngaythuchi' and sotien='$sotien' and lydo='$lydo' and loaitk='$idkho' and hdbh='$hdbh' and donvi='$donvi' and sotknh='$sotknh' and tentknh='$tentknh' and donvivc='$donvivc' and mavandon='$mavandon' and manv='$manv'    limit 1 ";
		$sql  = " select ID from thuchikt where ngaythuchi='$ngaythuchi' and sotien='$sotien' and lydo='$lydo' and loaitk='$idkho' and note='$note'    limit 1 ";
	//echo $sql."<br>";
		$chan = getdong($sql);   
	// echo $sql."<br>---";
		 if ($chan['ID']){  
			 return false;	
		}
		return true;
}


function checksotienhoadon($soct){
$sql="select sum(DonGia) as tongtiendg,(sum(ceil(a.DonGia*(1-1*a.chietkhau/100))*a.SoLuong)-b.tigia)
  as thanhtien from xuatbanhang a left join phieunhapxuat b on a.IDphieu=b.ID where b.SoCT='$soct' group by a.IDphieu ";
//$sql="select sum(DonGia) as tongtiendg,floor((sum((DonGia*(1-1*chietkhau/100))*SoLuong)-b.tigia)) as thanhtien from xuatbanhang a left join phieunhapxuat b on a.IDphieu=b.ID where b.SoCT='$soct' group by a.IDphieu ";
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

$sql="select a.IDHD as idhd,a.sotien as tienthuong from thuonghoadon a left join phieunhapxuat b on a.IDHD=b.ID where b.SoCT='$hdbh' and a.tinhtrang=44";
//echo $sql;
global $data;
$dong=getdong($sql);
if($dong['idhd']){
		return $dong;
	}
	else{
		return false;
	}

}
function checktaikhoandinhkhoan($madk){

$sql="select no,co,loai from dinhkhoanthuchi where ma='$madk'";

global $data;
$dong=getdong($sql);
if($dong['no'] || $dong['co']){
		return $dong;
	}
	else{
		return false;
	}

}



function checknhacungcap($NCC){

$sql="select ID from nhacungcap where ID=$NCC";

global $data;
$dong=getdong($sql);
if($dong['ID']){
		return $dong;
	}
	else{
		return false;
	}

}
 function create_slug($string)
    {
        $unicode = array(
            'a'=>'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ',
            'd'=>'đ',
            'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',
            'i'=>'í|ì|ỉ|ĩ|ị',
            'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',
            'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',
            'y'=>'ý|ỳ|ỷ|ỹ|ỵ',
			'A'=>'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
            'D'=>'Đ',
            'E'=>'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
            'I'=>'Í|Ì|Ỉ|Ĩ|Ị',
            'O'=>'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
            'U'=>'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
            'Y'=>'Ý|Ỳ|Ỷ|Ỹ|Ỵ',
        );
        
       foreach($unicode as $nonUnicode=>$uni){
            $str = preg_replace("/($uni)/i", $nonUnicode, $str);
       }
		return $str;
    }
	
function checktrunglap($r,$sheettam,$socotkiemtra,$k){
	$tam=[];
	$tam2=[];
		$check=0;
		for($i=$k+1;$i<=count($sheettam);$i++){
			$checkcount=0;
			for($j=0;$j<$socotkiemtra;$j++){
				if($r[$j]==$sheettam[$i][$j]){
					$checkcount++;
					
				}else{
					array_push($tam,$sheettam[$i]);
				}
			}	
			
			if($checkcount==$socotkiemtra){
				$check++;
				
				array_push($tam2,$i);
			/*	echo "<pre>";
					var_dump($tam2);
					echo "</pre>";
				*/
			}
		}
		
	return array("sodong"=>$check,"mangmoi"=>$tam,"mangindex"=>$tam2);
}
function validateDate($date){
if(!$date){
	return false;
}
else{

$date=explode("-",$date);
	 	$year=$date[0];
	
	$month=$date[1];
	$day=(int)($date[2]);
	/*var_dump(is_numeric($day));	
		echo $day;	*/
	if(is_numeric($year) && is_numeric($month) && is_numeric($day)){

		return true;
	}
	return false;
	
}
return false;
  
} 
function CheckVanChuyendon($mavd)
{
	global $data,$manvc;
	$tamvd=$mavd;
	if($manvc=='GHTK'){
		$tamvd=explode(".",$mavd);
		$tamvd=$tamvd[count($tamvd)-1];
	}
	//(SUBSTRING_INDEX(mavd,'.',-1) ='$tamvd' and  mavd <> '') or  (SUBSTRING_INDEX(madh,'.',-1) ='$tamvd' and  madh <> '')
    $sql = "SELECT ID,IDbill, mavd, sobill, madh, diachi, tinh, quan, phuong,trigiadon,phitravc,phithukh,tongtien,donvivc,dongthoigiantrangthaidon from vanchuyenonline where madoitac='$tamvd' or mavd='$tamvd'";
      //echo $sql;
    $tam = getdong($sql);
	//var_dump($tam);
    return $tam;

}

function checkBill($soct)
{
	global  $data;
    $sql = "SELECT a.ID as IDbill,b.madh,b.mavd,b.tongtien,b.phithukh,b.dongthoigiantrangthaidon from phieunhapxuat a left join vanchuyenonline b on b.IDbill=a.ID where a.SoCT ='$soct'";
  //   echo $sql;
    $tam = getdong($sql);
	//var_dump($tam);
    return $tam;

}
function dateDiffMi($ngay1,$ngay2){
//echo "ngay2: ".$ngay2."<br/>";
//echo "ngay1: ".$ngay1;
	$to_time = strtotime($ngay1);
	$from_time = strtotime($ngay2);
	return round(abs($ngay2 - $ngay1)/60/60,2);
}


function kiemtratrungngay($ngay1,$ngay2){
	return (date("d",$ngay1)==date("d",$ngay2)  && date("m",$ngay1)==date("m",$ngay2) && date("Y",$ngay1)==date("Y",$ngay2));

}
?>	