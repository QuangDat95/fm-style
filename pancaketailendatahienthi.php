<?php  
session_start();
if ($_SESSION["LoginID"]=="") return ;
$root_path =getcwd()."/"  ;
include($root_path."biensession.php");
include($root_path."includes/config.php");
include($root_path."includes/removeUnicode.php");
include($root_path."includes/class.paging.php");
include($root_path."includes/class.mysql.php");
include($root_path."includes/function.php");
include($root_path."includes/function_local.php");
include( $root_path."excel/simplexlsx.class.php");  
 //$path = $root_path."data/maubanhangpancake.xlsx"  ; 

   
$idk = laso($_SESSION["LoginID"]) ; if ($idk == 0) return ;
   
$data = new class_mysql();
$data->config();
$data->access();
$updated =false;
if(isset($_POST["UPDATE"])){
	$data1 = $_POST['UPDATE']; 
  $tmp = explode('*@!',$data1);  
  $ids = laso($tmp[0]);
  $dts = $tmp[1] ;
 
   $giamgia = $tmp[2] ;
    $sp = $tmp[3] ;
	$sl = $tmp[4] ;
	 $tiengiam = $tmp[5] ;
	 $checksp = $tmp[6] ;
	
   $arrmanv=tachmanv($dts);
  
 	if($checksp==0){
			//nhân vien
			if(!checkExists('MaNV',$arrmanv["manv"],"userac")){
				echo -1;
				return;
			}
		 //check team
			if(!checkTeam(trim($arrmanv['mach']))){
				if(!checkCuahang(trim($arrmanv['mach']))){
					echo -2;
					return;
				}
				
			}
			
			//voucher
			if($arrmanv["voucher"]!=0){
				if(checkExists('maso',$arrmanv["voucher"],"phieukhuyenmai")){
					$mangvc=checkExists('maso',$arrmanv["voucher"],"phieukhuyenmai");
					/*if($tiengiam!=$mangvc["sotien"]){
						echo -6;
						return;
					}*/
					
					
				}
				else{
						echo -3;
						return;
					}
				
			}
			
			
			//check sp
				if(!checksp($sp)){
						echo -4;
						return;
				}
				//check sl
				if($sl<=0){
						echo -5;
						return;
				}
				if($sl>100){
						echo -8;
						return;
				}
		$sql="update datapancake set T19='".$dts."',T21='".$dts."',T43='".$sp."',T45='".$sl."',T54='".$tiengiam."',xacnhan=0 where ID=".$ids;
		
	}
	
	 if($checksp==1){
			//check sp
				if(!checksp($sp)){
						echo -4;
						return;
				}
				//check sl
				if($sl<=0){
						echo -5;
						return;
				}
		$sql="update datapancake set T43='".$sp."',T45='".$sl."',xacnhan=0 where ID=".$ids;
		
	}
	 if($checksp==2){
	
		$sql="update datapancake set xacnhan=0 where ID=".$ids;

		$_SESSION['checkgiamgia']=1;
		
		if($data->query($sql)){
			 $_SESSION['sodongxacnhan']--;	
			 echo $ids."*".$_SESSION['sodongloi'].'*'.$_SESSION['sodongxacnhan'];
			 
			$updated=true;
		}
		else{
			 echo -7;
		}
	}
	else{
	
		if($data->query($sql)){
			 $_SESSION['sodongloi']--;
			 echo $ids."*".$_SESSION['sodongloi'].'*'.$_SESSION['sodongxacnhan'];
			 
			$updated=true;
		}
		else{
			 echo -7;
		}
	}
	
	/*$sql="select T1,T2,T3,T4,T5,T19,T43,T45,T48,T55,T56 from datapancake where ID=".$ids;
	$r=getdong($sql);
	$giamgia=0;
	if($*/
	/*echo ' <td align="right">stt</td>				
           <td  align="left">'.$r["T1"].'</td>
 			<td  align="left">'.$r["T2"].'</td>
 			<td  align="left">'.$r["T3"].'</td>
 			<td  align="left">'.$r["T4"].'</td>
			<td  align="left">'.$r["T5"].'</td>
			<td  align="left">....</td>
 			<td  align="left">'.$r["T19"].'</td>
			<td  align="left">....</td>
			<td  align="left">'.$r["T43"].'</td>
			<td  align="left">'.$r["T45"].'</td>
			<td  align="left">'.$r["T48"].'</td>
			<td  align="left">'.$r["T55"].'</td>
			<td  align="left">'.$giamgia.'</td>
			<td  align="left">'.$voucher.'</td>
			<td  align="left">'.$r["T56"].'</td>
			<td  align="left">'.$chieckhau.'</td>
			<td  align="left">....</td>';*/
	
	
	return;
}

	if(isset($_POST['DATA'])){
		 $_SESSION['sodongloi']=0;
		 $_SESSION['sodongxacnhan']=0;
		$data1 = $_POST['DATA']; 
		 $tmp = explode('*@!',$data1);
		$checkcol=true;
		include($root_path."pancakeinsertexel.php");
		if(!$checkcol){
			$baocot='<p style="red">Số cột tải lên không đúng định dạng mẫu! vui lòng kiểm tra lại dữ liệu! số cột = 105</p>';
	
		}
			unset($_SESSION['checkgiamgia']);
		
	}
  
if(isset($_POST['SHOW'])){
 	$data1 = $_POST['SHOW']; 
 	 $tmp = explode('*@!',$data1);
	
}
	

 $sql="select * from datapancake";
$query=$data->query($sql);
$sheets=array();

while($r = $data->fetch_array($query)){
	
	array_push($sheets,$r);
	
}

?>
<div style="overflow:scroll;height:400px">
<?php
echo $baocot;
?>
<strong style="color:#F90">Đọc dữ liệu từ dòng ... của file Excel</strong> <br />
<table id="tbex" width="100%" border="0" cellpadding="0" cellspacing="0" style="background:#FFF;" class="tbchuan">		
 		<tr bgcolor="#F8E4CB">
		  <td align="center"  height="23" width="35"><b>STT</b></td>
          <td align="center"  height="23" width="43"><b>T1</b></td>
		  <td width="98" align="center"  ><strong>T2</strong></td>  
 		  <td width="72" align="center" ><strong>Mã đơn hàng đầy đủ</strong></td> 
          <td width="72" align="center" ><strong>Facebook</strong></td>
          <td width="72" align="center" ><strong>Mã vận đơn</strong></td>
		  	<td  align="left">....</td>
       
          <td width="72" align="center" ><strong>Khách hàng</strong></td>
         
		  <td  align="left">....</td>
		   <td width="72" align="center" ><strong>Mã sản phẩm</strong></td> 
          <td width="72" align="center" ><strong>Số lượng</strong></td>
		     <td width="72" align="center" ><strong>Đơn giá</strong></td>
			 <td width="72" align="center" ><strong>Giảm giá đơn</strong></td>
			 <td width="72" align="center" ><strong>Giảm giá đơn thực</strong></td>
			  <td width="72" align="center" ><strong>Voucher</strong></td>
			 <td width="72" align="center" ><strong>Giảm giá sản phẩm</strong></td>
			 <td width="72" align="center" ><strong>chiết khấu</strong></td>
			
		  <td  align="left">....</td>
  	 </tr>
<?php
//kiem tra masp
//kiem tra voucher
//kiem tra manv
//kiem tra cua hang
// 
$stt=0;
$loi=false;

$loigiamgia=true;
foreach( $sheets as $k => $r) { 
$stt++;
$check=true;
$checkvd=true;
$checkgiamgia=true;
$loisesion=false;

$giamgiatam=0;
$giamgia=0;

$texterror='';
$tiengiamhople=0;
$voucher='';
$chieckhau=0;
$xacnhan=$r['xacnhan'];

if($r['T56']){
	if($r['T48']>0){
		$chieckhau=($r['T56']/$r['T48'])*100;
	}
}

/*$gh1phan=false;
				if($r['T64']){
					$tgh1p=explode("#",$r['T64']);
					
					if($tgh1p[1]=="GH1P"){
						$gh1phan=true;
						$gh1phanvdtruoc=trim(explode("GH1P",$tgh1p[2])[0]);
						var_dump($gh1phanvdtruoc);
					}
					
				}*/
$id= $r['ID'];
		if($r['T3']){
			
			if(!$sheets[$k+1]['T3']){
				$giamgiatam=tongtiengiamdon($sheets,$k,$r['T56']);
				
				$giamgia=$r['T55']-$giamgiatam;	
				$giamgiatam=0;	
			}
			
			/*if($k==0){
				$giamgiatong=$r['T56'];
			}
			else{
				$giamgiatam=$giamgiatong;
				$giamgia=$r['T56']-$giamgiatam;
				$giamgiatong=0;
			}*/
			$arrmanv=tachmanv($r['T19']);
		
				//voucher
			if($arrmanv["voucher"]!=0){
				if(checkExists('maso',$arrmanv["voucher"],"phieukhuyenmai")){
					$mangvc=checkExists('maso',$arrmanv["voucher"],"phieukhuyenmai");
					$voucher=$arrmanv["voucher"];
					if($r["T55"]!=$mangvc["sotien"]){
						$checkgiamgia=false;
						//$check=false;
						//$loi=true;
						$texterror.="|*|6";
						$tiengiamhople=$mangvc["sotien"];
					}
					
				}
				else{
						if(!$loisesion){
							$_SESSION['sodongloi']++;
							$loisesion=true;
						}
						echo "lỗi Dòng ".$stt."</br>";
						$check=false;
						$loi=true;
						$texterror.="|*|1";
				}
				
			}
			else {
			
				if($giamgia!=0){
					
					if(!isset($_SESSION['checkgiamgia']) || $_SESSION['checkgiamgia']!=1){
						if($xacnhan==0){
							setxacnhan(2,$id);
						}
						$_SESSION['sodongxacnhan']++;
						echo "Dòng xác nhận voucher ".$stt."</br>";
							$checkgiamgia=false;
							$loigiamgia=false;
							//$check=false;
							//$loi=true;
							$texterror.="|*|6";
							$texterror.="|*|7";
						
			
					}
				}
			}
			
			//nhân vien
			if(!checkExists('MaNV',$arrmanv["manv"],"userac")){
					if(!$loisesion){
							$_SESSION['sodongloi']++;
							$loisesion=true;
						}
				echo "lỗi Dòng ".$stt."</br>";
				$check=false;
				$loi=true;
				$texterror.="|*|2";
			}
			//check team
			if(!checkTeam(trim($arrmanv['mach']))){
				if(!checkCuahang(trim($arrmanv['mach']))){
					if(!$loisesion){
							$_SESSION['sodongloi']++;
							$loisesion=true;
						}
					echo "lỗi Dòng ".$stt."</br>";
					$check=false;
					$loi=true;
					$texterror.="|*|3";
				}
				
			}
			//check sp
			if(!checksp(trim($r["T43"]))){
				if(!$loisesion){
							$_SESSION['sodongloi']++;
							$loisesion=true;
				}
				/*if($stt==62){
					echo $r["T43"];
				}*/
						echo "lỗi Dòng ".$stt."</br>";
					$check=false;
					$loi=true;
					$texterror.="|*|4";
				
			}
			//check sl
			if($r["T45"]<=0){
				if(!$loisesion){
							$_SESSION['sodongloi']++;
							$loisesion=true;
						}
						echo "lỗi Dòng ".$stt."</br>";
					$check=false;
					$loi=true;
					$texterror.="|*|5";
				
			}
			//check sl
			if($r["T45"]>=100){
				if(!$loisesion){
							$_SESSION['sodongloi']++;
							$loisesion=true;
						}
					echo "lỗi Dòng ".$stt."</br>";
					$check=false;
					$loi=true;
					$texterror.="|*|8";
				
			}
			//check ma van don
			
			if(!checkPhieuNhapxuat1($r['T5']?$r['T5']:$r['T3'])){
					$checkvd=false;
					
				//echo "lỗi Dòng ".$stt."</br>";
			}
			$mauchu="green";
			$loainut=-1;
			
			if($checkvd && $check && !$checkgiamgia){
				$mauchu='#0432df';
				$loainut=4;
			} 
			if($checkvd && !$check && !$checkgiamgia){
				$mauchu='red';
				$loainut=3;
			} 
			if(!$check){
				if($xacnhan!=1){
					setxacnhan(1,$id);
				}
			}
			
			if($checkvd && $checkgiamgia && !$check ){
				$mauchu='red';
					$loainut=1;
			}
			if(!$checkvd && $check && $checkgiamgia){
				$mauchu='#ffc107';
				$loainut=2;
			} 
			
			if(!$checkvd && !$check && $checkgiamgia){
				$mauchu='red';
				$loainut=3;
			} 
			
			
			
			if(!$checkvd && $check && !$checkgiamgia){
				$mauchu='#ffc107';
				$loainut=2;
			} 
		if($loainut==1){
		?>
		<tr id="<?=$r['ID']?>" style="cursor:pointer;color:<?php echo $mauchu ; ?> " onclick="showPoupSua('<?=$r['ID']?>','<?=$r['T19']?>','<?=$r["T48"]?>','<?=$texterror?>','<?=$r["T43"]?>','<?=$r["T45"]?>','<?=$mangvc["sotien"]?>',0)">
		
		<?php
			}
			else if($loainut==2)
			{
			?>
		<tr id="<?=$r['ID']?>" style="cursor:pointer;color:<?php echo $mauchu ; ?> " onclick="xuatbaoloi('Dữ liệu này đã tồn tại!')">
	
		<?php		
			}
			else if($loainut==3){
			?>
			
				<tr id="<?=$r['ID']?>" style="cursor:pointer;color:<?php echo $mauchu ; ?> " onclick="showPoupSua('<?=$r['ID']?>','<?=$r['T19']?>','<?=$r["T48"]?>','<?=$texterror?>','<?=$r["T43"]?>','<?=$r["T45"]?>','<?=$mangvc["sotien"]?>',0)">
			<?php
			
			
			}
			else if($loainut==4){
			?>
			
				<tr id="<?=$r['ID']?>" style="cursor:pointer;color:<?php echo $mauchu ; ?> " onclick="showPoupSua('<?=$r['ID']?>','<?=$r['T19']?>','<?=$r["T48"]?>','<?=$texterror?>','<?=$r["T43"]?>','<?=$r["T45"]?>','<?=$mangvc["sotien"]?>',2)">
			<?php
			
			
			}
			else{
			
		?>
		<tr id="<?=$r['ID']?>" style="cursor:pointer;color:<?php echo $mauchu; ?> ">
		<?php
		
			}
		?>
		    <td align="right"><?php echo $stt  ;?></td>				
           <td  align="left"><?php echo $r["T1"];?></td>
 			<td  align="left"><?php echo $r["T2"];?></td>
 			<td  align="left"><?php echo $r["T3"];?></td>
 			<td  align="left"><?php echo $r["T4"];?></td>
			<td  align="left"><?php echo $r["T5"];?></td>
			<td  align="left">....</td>
 			
 			<td  align="left"><?php echo $r["T19"];?></td>
			
			<td  align="left">....</td>
			<td  align="left"><?php echo $r["T43"];?></td>
			<td  align="left"><?php echo $r["T45"];?></td>
			<td  align="left"><?php echo $r["T48"];?></td>
			<td  align="left"><?php echo $r["T55"];?></td>
			<td  align="left"><?php echo $giamgia;?></td>
			<td  align="left"><?php echo $voucher;?></td>
			<td  align="left"><?php echo $r["T56"];?></td>
			<td  align="left"><?php echo $chieckhau;?></td>
			<td  align="left">....</td>
			
    </tr>	
			
<?php		}
		if(!$r['T3']){
			//$giamgiatong+=$r["T56"];
			//check sp
			if(!checksp(trim($r["T43"]))){
					$check=false;
					$loi=true;
					$texterror.="|*|4";
					if(!$loisesion){
							$_SESSION['sodongloi']++;
							$loisesion=true;
					}
				echo "lỗi Dòng ".$stt."</br>";
			}
			
			//check sl
			if($r["T45"]<=0){
					$check=false;
					$loi=true;
					$texterror.="|*|5";
					if(!$loisesion){
							$_SESSION['sodongloi']++;
							$loisesion=true;
						}
				echo "lỗi Dòng ".$stt."</br>";
			}
			//check sl
			if($r["T45"]>=100){
				if(!$loisesion){
							$_SESSION['sodongloi']++;
							$loisesion=true;
						}
					echo "lỗi Dòng ".$stt."</br>";
					$check=false;
					$loi=true;
					$texterror.="|*|8";
				
			}
			$mauchu=$check?"green":"red";
		if(!$check){	
			
?>
		<tr id="<?=$r['ID']?>" style="cursor:pointer;color:<?php echo $mauchu ; ?> " 
		onclick="showPoupSua('<?=$r['ID']?>','<?=$r['T19']?>','<?=$r["T48"]?>','<?=$texterror?>','<?=$r["T43"]?>','<?=$r["T45"]?>','<?=$mangvc["sotien"]?>',1)">
		
		<?php
			}
			else{
			
		?>
		<tr id="<?=$r['ID']?>" style="cursor:pointer;color:<?php echo $mauchu ; ?> ">
		<?php
		
			}
		?>
		    <td align="right"><?php echo $stt  ;?></td>				
           <td  align="left"><?php echo $r["T1"];?></td>
 			<td  align="left"><?php echo $r["T2"];?></td>
 			<td  align="left"><?php echo $r["T3"];?></td>
 			<td  align="left"><?php echo $r["T4"];?></td>
			<td  align="left"><?php echo $r["T5"];?></td>
			<td  align="left">....</td>
 			
 			<td  align="left"><?php echo $r["T19"];?></td>
			
			<td  align="left">....</td>
			<td  align="left"><?php echo $r["T43"];?></td>
			<td  align="left"><?php echo $r["T45"];?></td>
			<td  align="left"><?php echo $r["T48"];?></td>
			<td  align="left"><?php echo $r["T55"];?></td>
			<td  align="left"><?php echo '';?></td>
			<td  align="left"><?php echo $voucher;?></td>
			<td  align="left"><?php echo $r["T56"];?></td>
			<td  align="left"><?php echo $chieckhau;?></td>
			<td  align="left">....</td>
			
    </tr>	


<?php
		}
		
		
}
?>
</table>  


</div>

<?php
 
if ($loi) {?>

<div style="padding-bottom:10px;padding-left:20px" id="btnlaydulieu_w"><input type="button" id="dulieue" name="dulieue"  onclick="xuatbaoloi('Có lỗi trong file tải lên chú ý chổ màu đỏ!')" value="Lấy dữ liệu Excel"/> </div>  
 <?php
}
else if(!$loigiamgia){
?>
<div style="padding-bottom:10px;padding-left:20px" id="btnlaydulieu_w"><input type="button" id="dulieue" name="dulieue"  onclick="xuatbaoloi('Vui lòng xác nhận voucher! Dòng màu xanh dương')" value="Lấy dữ liệu Excel"/> </div>  

<?php
}
 else  
 {
 ?>
 <div style="padding-bottom:10px;padding-left:20px" id="btnlaydulieu_w"><input type="button" id="dulieue" name="dulieue"  onclick="laydulieuexel()" value="Lấy dữ liệu Excel"/> </div>  
  <?php
 }
      	
    $data->closedata() ;
	
function tachmanv($chuoi){
	$arr=explode("-",$chuoi);
	$tenkh=$arr[0];
	$voucher=$arr[1];
	$manv=$arr[2];
	$mach=$arr[3];
	$ngaysinh=$arr[4];
	$tamns='';
	if($ngaysinh){
		$ngaysinh=explode("/",$ngaysinh);
		$tamns=$ngaysinh[2].'-'.$ngaysinh[1]."-".$ngaysinh[0];
	}
	$tam='';
	
	return array("tenkh"=>$tenkh,"manv"=>$manv,"voucher"=>$voucher,"mach"=>$mach,'ngaysinh'=>$tamns);
}


function checkExists($cot,$ma,$bang){
	global $data;
	$ma=trim($ma);
	$sql="select * from $bang where $cot='$ma'";
	
	$query =$data->query($sql);
	$num_row=$data->num_rows($query);
	if($num_row==0){
		return;
	
	}
	else{
		return getdong($sql);
	}
}


function checktinh($chuoi){
	
	global $data;
	$chuoi=addslashes($chuoi);
	$chuoi=strtolower(trim($chuoi));
	$sql="select * from tinh where LOWER(TRIM(Name)) = '$chuoi'";
	
	$query =$data->query($sql);
	$num_row=$data->num_rows($query);
	if($num_row==0){
		return;
	}
	else{
		return getdong($sql);
	}
}
function checkquan($chuoi){
	
	global $data;
	$chuoi=addslashes($chuoi);
	$sql="select * from quan where CONCAT(loai,' ',Name) like '%$chuoi%'";

	$query =$data->query($sql);
	$num_row=$data->num_rows($query);
	if($num_row==0){
		return;
	
	}
	else{
		return getdong($sql);
	}
}
function checkdiachi($chuoi){
$chuoi=addslashes($chuoi);
	$arr=explode(",",$chuoi);
	
	return $arr[0];

	

}


function checkphuong($chuoi){
	global $data;
	$chuoi=addslashes($chuoi);
	$sql="select * from phuong where CONCAT(loai,' ',Name) like '%$chuoi%'";
	
	$query =$data->query($sql);
	$num_row=$data->num_rows($query);
	if($num_row==0){
		return;
	
	}
	else{
		return getdong($sql);
	}

}

function checksp($masp){
	global $data;
	$sql="select ID from products where codepro='$masp'";
	
	$query =$data->query($sql);
	$num_row=$data->num_rows($query);
	if($num_row==0){
		return;
	
	}
	else{
		return getdong($sql);
	}

}


function insertKh($arr){
global $data;
 $ngay = gmdate('Y-n-d H:i:s', time() + 7*3600) ;
	$name=$arr["name"];
	$makh=$arr["makh"];
	$address=$arr["address"];
	$type=$arr["type"];
	$tel=$arr["tel"];
	$ngaysinh=$arr["ngaysinh"];
	$quan=$arr["quan"];
	$phuong=$arr["phuong"];
	$sql="insert into customer (Name,makh,address,type,tel,ngaytao,ngaysinh,quan,phuong)
	 values('$name','$makh','$address','$type','$tel','$ngay','$ngaysinh','$quan','$phuong')";
	 
	 $update=$data->query($sql);
	 	$sql="select * from customer where makh='$tel' and tel='$tel'";
		$dong=getdong($sql);
	 	return $dong;
	 
	 
}

function checkTeam($team){
global $data;
	$sql="select ma from lydonhapxuat where ma='$team'";
	$dong=getdong($sql);
	$result='';
	if($dong['ma']){
		$result=1105;
	}
	else{
		
		return false;
	}
	return $result;
}

function checkCuahang($team){
global $data;
	$sql="select ID from cuahang where macuahang ='$team'";
		
		$query =$data->query($sql);
		$dong=getdong($sql);
		$result='';
		if($dong['ID']){
			
			$result=$dong['ID'];
		}
		else{
			return;
		}
		
		return $result;
}
function insertPhieunhapxuat($arr){
global $data;

	$idkho=$arr['idkho'];
	$sochungtu=$arr['sct'];
		$idkhach=$arr['idkhach'];
	$id=$arr['IDNhap'];
	$ngayxuat=$arr['ngayxuat'];
	$lydoxuat=$arr['lydoxuat'];
	$tigia=$arr['tigia'];
	$vat=$arr['vat'];
	$ghichu=$arr['ghichu'];
	$ngaytao=$arr['ngaytao'];
	$idk=$arr['idk'];
	$makm=$arr['makm'];
	$name=$arr['name'];
	$address=$arr['address'];
	$tenlydo=$arr['tenlydo'];
	$idban=$arr['idban'];
	$nguoitao='';
	$tientra=$arr['tientra'];
	$idchol=$arr['idchol'];
	$sql = "insert into phieunhapxuat   set Loai='1' ,IDKho ='$idkho',IDNhaCC ='$idkhach' ,IDNhap ='$id' ,NgayNhap ='$ngayxuat' ,SoCT='$sochungtu' ,LyDo='$lydoxuat' ,SoNgayNo='0' ,IDTKNo='0' ,IDTKCo='0' ,TiGia ='$tigia' ,VAT='$vat' ,GhiChu='$ghichu' ,NgayTao='$ngaytao' ,IDTao='$idk' ,NguoiGiao='$makm' ,dakhoa=1,ten='$name',diachi='$address', tenlydo='$tenlydo'   ,diachiN='$idban' ,nguoitao='$nguoitao',tientra='$tientra',idchol='$idchol'   "  ;

	if($data->query($sql)){
	 	$sql="select * from phieunhapxuat where SoCT='$sochungtu'";
		$dong=getdong($sql);
	 	return $dong;
	}
	else{
		return;
	}
}

function checkPhieunhapxuat($sct){
global $data;
	$sql="select SoCT from phieunhapxuat where SoCT='$sct'";
	
	$dong=getdong($sql);
	
	if($dong['SoCT']){
		return true;
	}
	else{
		
		return false;
	}
}
function checkPhieuNhapxuat1($madh){
global $data;
	$sql="select ID from vanchuyenonline where madh ='$madh'";
	
		$query =$data->query($sql);
		$numrow=$data->num_rows($query);
			
		if($numrow==0){
			
			return true;
		}
		
		return false;
}
function insertXuatbanhang($arr){
	global $data;
	$IDPhieu=$arr['IDPhieu'];
	$IDSP=$arr['IDSP'];
	$mahang=$arr['mahang'];
	$tenpt=$arr['tenpt'];
	$SoLuong=$arr['SoLuong'];
	$DonGia=$arr['DonGia'];
	$LoaiTien=$arr['LoaiTien'];
	$chietkhau=$arr['chietkhau'];
	$Loai=$arr['Loai'];
	$giavon=$arr['giavon'];
	$idnhom=$arr['idnhom'];
	$idtao=$arr['idtao'];
	$idnv=$arr['idnv'];
	
	 $sql="INSERT INTO xuatbanhang (IDPhieu,IDSP,mahang,tenpt,SoLuong,DonGia,LoaiTien,Thue,BaoHanh,Ghichu,chietkhau,Loai,giavon,idnhom,idtao,idnv) VALUES('$IDPhieu','$IDSP','$mahang','$tenpt','$SoLuong','$DonGia','$LoaiTien','$Thue','$BaoHanh','$Ghichu','$chietkhau','$Loai','$giavon','$idnhom','$idtao','$idnv')";
	 
	 $update=$data->query($sql);
	 	
	 	return $update;
}

function insertVanchuyenonline($arr){
	global $data;
	$IDbill=$arr['IDbill'];
	$sobill=$arr['sobill'];
	$madh=$arr['madh'];
	$Fbpage=$arr['Fbpage'];
	$mavd=$arr['mavd'];
	$madoitac=$arr['madoitac'];
	$donvivc=$arr['donvivc'];
	$phitravc=$arr['phitravc'];
	$phithukh=$arr['phithukh'];
	$nvxuly=$arr['nvxuly'];
	$nvcskh=$arr['nvcskh'];
	

	 $sql="INSERT INTO vanchuyenonline (IDbill,sobill,madh,Fbpage,mavd,madoitac,donvivc,phitravc,phithukh,nvxuly,nvcskh)  
	 VALUES('$IDbill','$sobill','$madh','$Fbpage','$mavd','$madoitac','$donvivc','$phitravc','$phithukh','$nvxuly','$nvcskh')";
	 
	 $update=$data->query($sql);
	 	
	 	return $update;
}

function GetsoCT($idkho){
	global $data;
 			$thang = gmdate('m', time() + 7*3600); 
		   $nam = gmdate('y', time() + 7*3600); 
		   $so = strlen($idkho) + 9;
		   $sql = "select   max(convert( mid(SoCT,$so,22),UNSIGNED INTEGER))as sp from phieunhapxuat  where loai ='1' and  IDKho='$idkho' and  mid(SoCT,4,2) = '$thang' " ;
 		   $kq = $data->truyvan($sql) ;		
		   $sp = laso($kq['sp']) + 1 ;
		   if (strlen($sp)== '1' ) $sp = "00". $sp ;
		   if (strlen($sp)== '2' ) $sp = "0". $sp ;
		   $sochungtu ="B".$nam.$thang.$_SESSION["S_MaNV"].".".$idkho.".".$sp ; 
		   $sochungtu2 ="B".$nam.$thang.$_SESSION["S_MaNV"].".".$idkho.".".($sp+1) ;
	return  $sochungtu ;
}
 
 
 function setxacnhan($tt,$id){
 	global $data;
	$sql='update datapancake set xacnhan='.$tt.' where ID='.$id;
	
	return $data->query($sql);
 }
  function getxacnhan(){
 	global $data;
	$sql='select xacnhan from datapancake';
	$dong =getdong($sql);
	return $dong['xacnhan'];
 }
 
 function tongtiengiamdon($arr,$k,$t){
 	$result=$t;
 	for($i=$k+1;$i<count($arr);$i++){
		if($arr[$i]['T3']){
			break;
		}
		
		$result+=$arr[$i]['T56'];
		
	}
	
	return $result;
 
 }
 return;

?>	