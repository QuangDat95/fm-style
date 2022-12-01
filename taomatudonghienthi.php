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
  $idkho = $_SESSION["se_kho"] ; 
  
$data = new class_mysql();
$data->config();
$data->access();
$updated =false;
date_default_timezone_set('Asia/Ho_Chi_Minh');
$tm = $_SESSION["root_path"] ;


if(isset($_POST["KIEMTRAHINH"])){
		$data1 = $_POST['KIEMTRAHINH']; 
	  $tmp = explode('*@!',$data1);
	  $chuoihinh   =$tmp[0];
	  if($chuoihinh){
	  	$chuoihinh =json_decode($chuoihinh,true);
		$manghinh=$chuoihinh["data"];
		
		foreach($manghinh as $key => $value){
			if($value){
				$masp=explode("-",$value)[0];
				$sql="Select ID from taomatudong  where mamota='$masp' limit 1";
				$dong=getdong($sql);
				if($dong["ID"]){
					$manghinh[$key]=$dong["ID"]."--".$value;
				}
				
			}
		}
		$chuoihinh["data"]=$manghinh;
		echo json_encode($chuoihinh);
		return;
		
	  }
	  
	  echo -1;
	  return;
		
}


if(isset($_POST["UPDATEHINH"])){
		$data1 = $_POST['UPDATEHINH']; 
	  $tmp = explode('*@!',$data1);
	  $chuoihinh   =$tmp[0];
	  $tammang=[];
	  if($chuoihinh){
	  	$chuoihinh =json_decode($chuoihinh,true);
		
		
		$tamtencheck='';
		$tamchuoi='';
		$tamfname='';
		$anhchinhtam='';
		$i=0;
		foreach($chuoihinh as $key => $value){
				$tamten=explode("--",$key);
				$fname='';
				if($tamten[0]!=$key){
						
						$fname=$tamten[1];
				}
				if($fname){
					$tamtentrung=explode("-",$fname);
					
					if($tamtencheck==$tamtentrung[0]){
						$tamchuoi.="###".$fname;
					}
					
					if($tamtencheck==''){
						$tamfname=$fname;
						
						$tamtencheck=$tamtentrung[0];
						$tamchuoi.="###".$fname;
						
						
					}
					else if($tamtencheck!=$tamtentrung[0]){
							
							$tammang[$tamtencheck]['anhchinh']=$tamfname;
							$tammang[$tamtencheck]['anhmausize']=$tamchuoi;
							$tamtencheck=$tamtentrung[0];
							$tamfname=$fname;
							$tamchuoi='';
							
					}
					
					
					
				}
					if($i==count($chuoihinh)-1){
						$tamchuoi.="###".$tamfname;
							$tammang[$tamtencheck]['anhchinh']=$tamfname;
							$tammang[$tamtencheck]['anhmausize']=$tamchuoi;
					}
			$i++;
		}
		
		if(count($tammang)>0){
			foreach($tammang as $key => $value){
					$sql="update taomatudong set images='$value[anhchinh]' where mamota='$key'";
					$update=$data->query($sql);
			}
		}
		echo "###1###Đã lưu!###";
		return;
		
	  }
	  
	  echo "###-1###lỗi!###";
	  return;
		
}

if(isset($_POST["CHECKMOTA"])){
		$data1 = $_POST['CHECKMOTA']; 
	$tmp = explode('*@!',$data1);
	$mamota=$tmp[0];
	$sql="select ID from taomatudong where mamota='$mamota'";
	$dong=getdong($sql);
	if($dong["ID"]==''){
		echo "###1###<span style='color:green'>Mã có thể dùng</span>###";
		
	}
	else{
		echo "###-1###<span style='color:red'>Mã trùng lặp</span>###";
	}
	
	return;
}

if(isset($_POST['LUUMA'])){

	$data1 = $_POST['LUUMA']; 
	$tmp = explode('*@!',$data1);
	$mamota=$tmp[0];
	$_SESSION["mamota"]=$mamota;
	$arrmota=$_SESSION["arr_mota"];
	$mangchitiet=$_SESSION["mangchitiet"];
	
	if($arrmota && $mangchitiet && $mamota){
	$sql="insert into taomatudong (IDnhom,IDnganh,IDNCC,IDSize,IDMau,gia,NgayTao,NgayNhap,tensp,mamota) values ('$arrmota[IDnhom]','$arrmota[IDnganh]','$arrmota[IDNCC]','$arrmota[IDSize]','$arrmota[IDMau]','$arrmota[gia]','$arrmota[NgayTao]','$arrmota[NgayNhap]','$arrmota[tensp]','$mamota')";
	
		$update=$data->query($sql);
		if($update){
		
			$sql="select ID from taomatudong where mamota='$mamota'";
			$dong=getdong($sql);
			$IDcha=$dong['ID'];
			$chct='';
			foreach($mangchitiet as $key  => $value){
					$chct.="('$IDcha','$value[IDSize]','$value[IDMau]','$value[soluong]','$value[gia]','$value[NgayTao]','$value[NgayNhap]','$value[tensp]','$value[codepro]'),";
				
			}
			$chct=rtrim($chct,',');
			$sql="insert into taomatudongchitiet (IDcha,IDSize,IDMau,soluong,gia,NgayTao,NgayNhap,tensp,codepro) value $chct";
			//var_dump($sql);
			$update=$data->query($sql);
			if($update){
				echo "###1###Đã lưu.###";
			}
			else{
				echo "###-1###Có lỗi xảy ra! vui lòng tạo lại mã.###";
			}
		}
		else{
			echo "###-1###Có lỗi xảy ra! vui lòng tạo lại mã.###";
		}
	}
	else{
		echo "###-1###Có lỗi xảy ra! vui lòng tạo lại mã.###";
	}
	
	
		



return;
}
if(isset($_POST['DATA'])){
$_SESSION["mangchitiet"]='';
$_SESSION["sql_mota"]='';
	$data1 = $_POST['DATA']; 
	$tmp = explode('*@!',$data1);
	$dt=$tmp[0];
	
	if($dt){
		$dt=json_decode($dt,true);
		
		$ncc=$dt["ncc"];
		$nam=$dt["nam"];
		$thang=$dt["thang"];
		$nganhhang=$dt["nganhhang"];
		$nhomhang=$dt["nhomhang"];
		$ngaynhap=$dt["ngaynhap"];
		$tensp=$dt["tensp"];
		$ngaynhap=date("Y-m-d h:m:s",strtotime($ngaynhap));
		$ngay=date("d",strtotime($ngaynhap));
		$gia=$dt["gia"];
		$tensp=$dt["tensp"];
		$sizetong=$dt["sizetong"];
		
		$mautong=$dt["mautong"];
		
		$chitietsizemau=$dt["chitietsizemau"];
		$ngaytao = date("Y-n-d H:i:s");	
	
		//tạo mã mô tả;
		$mamota='';
		$mamota.=substr($nam,2,strlen($nam));
		$mamota.=strlen($thang)==1?"0".$thang:$thang;
		
		//lấy mã nhóm
		$manhom=explode("-",$nhomhang[0]["text"])[0];
		$mamota.=strtoupper($manhom);
		//lấy mã nhà cung cấp
		$idncc=$ncc[0]['id'];
		$mancc=getten("nhacungcap",$idncc,'Fax');
		$mancc=strlen($mancc)<3?"0".$mancc:$mancc;
		$mamota.=$mancc;
	//lấy mã nganh
		/*$manganh=explode("-",$nganhhang[0]["text"])[0];
		$mamota.=strtoupper($manganh);*/
		//lấy ngày
		$mamota.=strlen($ngay)==1?"0".$ngay:$ngay;
		
		//select   max(convert(mid(mamota,LENGTH('2203KKC00222')+1,LENGTH(mamota)),UNSIGNED INTEGER)) as sp from taomatudong where mid(mamota,1,LENGTH('2203KKC00222')) = '2203KKC00222'

		 $sql = "select   max(convert(mid(mamota,LENGTH('$mamota')+1,LENGTH(mamota)),UNSIGNED INTEGER)) as sp from taomatudong where mid(mamota,1,LENGTH('$mamota')) = '$mamota'" ;
		 
		
		  $kq = getdong($sql);
		  
		  //var_dump($sql);
		  $sp='';
		 if($kq){
		 	 $sp=$kq['sp'];
			  echo $sp;
			 $sp=$sp+1;
			 $sps=strlen($sp)==1?"0":"";
			 $sp=$sps.$sp;
		 }
		 else{
		 	$sp="01";
		 }
 		
		
		$idnhomhang=$nhomhang[0]['id'];
		$idnganhhang=$nganhhang[0]['id'];
		$idncc=$ncc[0]['id'];
		$mamota.=$sp;
			//insert ma mô tả
			
			$arraymota["IDnhom"]=$idnhomhang;
			$arraymota["IDnganh"]=$idnganhhang;
			$arraymota["IDNCC"]=$idncc;
			$arraymota["IDSize"]=$sizetong;
			$arraymota["IDMau"]=$mautong;
			$arraymota["gia"]=$gia;
			$arraymota["NgayTao"]=$ngaytao;
			$arraymota["NgayNhap"]=$ngaynhap;
			$arraymota["tensp"]=$tensp;
			//$arraymota["mamota"]=$tensp;
		//$sql="insert into taomatudong (IDnhom,IDnganh,IDNCC,IDSize,IDMau,gia,NgayTao,NgayNhap,tensp,mamota) values ('$idnhomhang','$idnganhhang','$idncc','$countsize','$countmau','$gia','$ngaytao','$ngaynhap','$tensp','$mamota')";
		//$_SESSION["mamota"]=$arraymota;
		
		$_SESSION["arr_mota"]=$arraymota;
		
		//xuất giao diện xem trước
		
		$chuoimotagd="<tr  style='font-weight:600;font-size: 14px;'>
		
		<td width='30%' colspan='2'>Tên sản phẩm: $tensp</td>
		<td width='30%' colspan='2'>Mã mô tả: <input type='text' id='mamota' name='mamota' value='$mamota' onchange='checkmota(this.value)' onblur='checkmota(this.value)' style='border-color: green;
    outline: none;
    border: 1px solid;
    color: green;' /><div id='rescheckmota' style='display:inline-block'></div> </td>
		
		<td width='20%'>Giá: ".$gia."</td>
	</tr>";
		
		//$update=$data->query($sql);
		//$sql="select ID from taomatudong where mamota='$mamota'";
		//$dong=getdong($sql);
		//$IDcha=$dong['ID'];
		
		
		// tạo mã chitiet
		$codepro='';
		$codepro.=substr(date("Y"),3,strlen(date("Y"))-1);
		$mo=date("m");
		$d=date("d");
		$codepro.=$mo;
		$codepro.=$d;
		//$h=substr(date("H"),strlen(date("H"))-1,strlen(date("H")));
			
		//$m=date("i");
		//$s=date("s");
		$time=$h.$m;
		$codepro.=$time;;
		 $sql = "select  max(convert(mid(codepro,(POSITION('$d' IN codepro)+ LENGTH('$d')),LENGTH(codepro)),UNSIGNED INTEGER)) as sp from taomatudongchitiet  where mid(codepro,1,(POSITION('$d' IN codepro)+ LENGTH('$d'))-1) = '$codepro' " ;
	  $kq = getdong($sql);
	//echo  $sql;
	  $sp='';
		 if($kq){
		 	 $sp=$kq['sp'];
			 $sp=$sp+1;
			
			
		 }
		 else{
		 	$sp=1;
		 }
		 
			
				$tongslsp=0;
			$mangluu=[];	
			$chuoichitietgd='';
		if($chitietsizemau){
		$chct='';
		$stt=1;
			foreach($chitietsizemau as $key  => $value){
				$gia=str_replace(",","",$value['gia']);
				$codeprotam=$codepro;
				$sps='';
				if(strlen($sp)==1){
					 $sps="000";
				 
				}
				if(strlen($sp)==2){
				 $sps="00";
				}
				if(strlen($sp)==3){
					 $sps="0";
				}
				
				 $sps= $sps.$sp;
				
				//$sp=$sps.$sp;
				$codeprotam.=$sps;
				 //echo $codeprotam;
				$tam=[];
				$tam['IDSize']=$value['size'];
				$tam['IDMau']=$value['mau'];
				$tam['soluong']=$value['soluong'];
				$tam['gia']=$gia;
				$tam['NgayTao']=$ngaytao;
				$tam['NgayNhap']=$ngaynhap;
				$tam['tensp']=$tensp;
				$tam['codepro']=$codeprotam;
				array_push($mangluu,$tam);	
				
				//xuât chuoi gd
				$chuoichitietgd .='<tr  style="font-weight:600">
				<td>'.$stt.'</td>
		<td><span style="color:red">'.$value['tenmau'].'</span> X <span style="color:green">'.$value['tensize'].'</span></td>
		<td>Mã: '.$codeprotam.'</td>
		<td>Giá: '.number_format($gia).'</td>
		<td>Số lượng: '.$value['soluong'].' </td>
	</tr>	';		
			$tongslsp+=$value['soluong'];
			//$chct.="('$IDcha','$value[size]','$value[mau]','$value[soluong]','$gia','$ngaytao','$ngaynhap','$tensp','$codeprotam'),";
					
					//echo "<pre>";
					//var_dump($value);
					//echo "</pre>";
				$sp++;
				$stt++;
			}
		}
		
			$_SESSION["mangchitiet"]=$mangluu;
		$_SESSION["tongslsp"]=$tongslsp;
		//$chct=rtrim($chct,',');
		
		
		//$sql="insert into taomatudongchitiet (IDcha,IDSize,IDMau,soluong,gia,NgayTao,NgayNhap,tensp,codepro) value $chct";
		//$update=$data->query($sql);
		/*echo "<pre>";
					var_dump($chct);
					echo "</pre>";
		return;*/
		
	
		///
		 
		
	}	
}



?>	

<div id="show_ma_">
	<div id="close_show_"><span style="cursor:pointer;display: flex;
    justify-content: flex-end;
    padding: 1em;
    font-size: 16px;
    font-weight: bold;
    color: #ff5722;
    position: absolute;
    right: 0;
    top: 0;" onclick="showpop(false)">X</span></div>
	<table width="100%" cellpadding="5" cellspacing="0" >
	<!--<tr>
		<td width="20%" style="font-weight:600"><span style="color:red">2XL</span> X <span style="color:green">Đỏ</span></td>
		<td width="31%" style="font-weight:600"><strong>Mã: addwdadwda </strong></td>
		<td width="28%" style="font-weight:600"><strong>Giá: 123456</strong></td>
		<td width="21%" style="font-weight:600"><strong>Số lượng:22 </strong></td>
	</tr>
	<tr>
		<td>
		<span style="color:red">2XL</span> X <span style="color:green">Đỏ</span></td>
		<td>Mã: addwdadwda </td>
		<td>Giá: 123456</td>
		<td>Số lượng:22 </td>
	</tr>
	<tr>
		<td><span style="color:red">2XL</span> X <span style="color:green">Đỏ</span></td>
		<td>Mã: addwdadwda </td>
		<td>Giá: 123456</td>
		<td>Số lượng:22 </td>
	</tr>
	<tr>
		<td><span style="color:red">2XL</span> X <span style="color:green">Đỏ</span></td>
		<td>Mã: addwdadwda </td>
		<td>Giá: 123456</td>
		<td>Số lượng:22 </td>
	</tr>-->
		<?php echo $chuoimotagd; ?>
	<?php echo $chuoichitietgd; ?>
  </table>
	<div id="luu_ma">
	
	<button id="btn_luu" onclick="luuma()">Lưu mã</button><button id="btn_luu" onclick="showpop(false)">Hủy</button>
		<button type="button"  id="btn_in" onclick="goiinma3()" disabled="disabled" >In mã</button>
		<button type="button"  id="btn_exel" onclick="xuatexelm()" >Xuất exel</button>
		
	<div id="resluuma"></div>
	
	</div>
</div>