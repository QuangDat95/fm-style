<?php  
session_start();
//set_time_limit(0);
 $quyen= $_SESSION["quyen"] ; 
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
include($root_path."excel/simplexlsx.class.php");
include($root_path."includes/xlsxwriter.class.php");   
include($root_path."thuchibienngayquahan.php"); 

$ngayquahanchuan=24;
$ngayquahanchophep=$ngayquahanchophep;
$cuahangchophep=explode(",",$cuahangchophep);


 //$path = $root_path."data/maubanhangpancake.xlsx"  ; 
 //var_dump($ql[5]); 
$idk = laso($_SESSION["LoginID"]) ; if ($idk == 0) return ;
   $idkho = $_SESSION["se_kho"] ;
$data = new class_mysql();
$data->config();
$data->access();




$tm = $_SESSION["root_path"] ;

//đọc dữ liệu
$path = $root_path."data/updatevd".'-'.$idk.'-'.$idkho.".xlsx" ;



$xlsx = new SimpleXLSX($path);

$sheets=$xlsx->rows();
/*$writer=new XLSXWriter();
	writeFileExel($sheets,$writer,$path,1,array("a","b","c","d","a","b","c","d"));
	return;*/
if(isset($_POST['EDITEX'])){
	$mangbillailen=$_SESSION["mangbilltailen"];
	$data1 = $_POST['EDITEX']; 
	$tmp = explode('*@!',$data1);
	$index=laso($tmp[0]);
	$rowstr=chonghack($tmp[1]);
	$loai=chonghack($tmp[2]);
	
	$rowstr=explode("###",$rowstr);
	
	
	
	if(!checksobill($rowstr[0])){
		echo "@@@-1@@@<span style='color:red !important'>Không tìm thấy bill!@@@";
		return;
	}
	else{
		unset($mangbillailen,$rowstr[11]);
		if($loai==1){
			if(in_array($rowstr[0],$mangbillailen)){
				echo "@@@-1@@@<span style='color:red !important'>Trùng số bill tải lên!@@@";
				return;
			}
			$tam=CheckVanChuyen($rowstr[0]);
			if($tam){
				if($tam['madh']){
					$rowstr[1]=$tam['madh'];
				}
				if($tam['mavd']){
					$rowstr[2]=$tam['mavd'];
				}
				
				if($tam['trigiadon']){
					$rowstr[3]=$tam['trigiadon'];
				}
				if($tam['tongtien']){
					$rowstr[4]=$tam['tongtien'];
				}
				if($tam['phitravc']){
					$rowstr[5]=$tam['phitravc'];
				}
				if($tam['donvivc']){
					$rowstr[6]=$tam['donvivc'];
				}
				if($tam['diachi']){
					$rowstr[7]=$tam['diachi'];
				}
				if($tam['tinh']){
					$rowstr[8]=$tam['tinh'];
				}
				if($tam['quan']){
					$rowstr[9]=$tam['quan'];
				}
				if($tam['phuong']){
					$rowstr[10]=$tam['phuong'];
				}
					$writer=new XLSXWriter();
					writeFileExel($sheets,$writer,$path,$index,$rowstr);
					//$ro = $xlsx->rows()[$index];
					//$ro=implode("###",$ro);
					//var_dump($rowstr);return;
					$rowstr=implode("###",$rowstr);
					//var_dump($rowstr);return;
					echo  "@@@1@@@<span style='color:green !important'>Đã lưu!</span><span style='color:green !important'> Tìm thấy vận đơn tương ứng trong hệ thống</span>@@@$rowstr@@@";
			}else{
			$writer=new XLSXWriter();
			writeFileExel($sheets,$writer,$path,$index,$rowstr);
			$rowstr=implode("###",$rowstr);
					echo  "@@@1@@@<span style='color:green !important'>Đã lưu!</span><span style='color:red !important'> không tìm thấy vận đơn tương ứng trong hệ thống</span>@@@$rowstr@@@";
			}
		
		
		}
		else{
			$writer=new XLSXWriter();
			writeFileExel($sheets,$writer,$path,$index,$rowstr);
			$rowstr=implode("###",$rowstr);
			
			echo  "@@@1@@@<span style='color:green !important'>Đã lưu!@@@$rowstr@@@";
		}
		
		
	}
	
return;
}
//$ql[5]=1;
?>
<div style="overflow:scroll;height:400px">
<style>.tbchuan th, .tbchuan td{
	white-space: pre-wrap;
	
}
.input_tb{
	border:none;
}
.input_tb:focus{
	border:none;
	outline:none;
}
.input_tb:active{
	border:none;
	outline:none;
}
</style>
<strong style="color:#F90">Đọc dữ liệu từ dòng 13 của file Excel</strong> <br />
<table id="tbex" width="100%" border="0" cellpadding="0" cellspacing="0" style="background:#FFF;" class="tbchuan">		
 		<tr bgcolor="#F8E4CB">
		  <td align="center"   width="35"><b>STT</b></td>
		    <td align="center"   width="200"><b>Lỗi</b></td>
          <td align="center"  width="100"><b>Số bill </b></td>
		  <td width="98" align="center"  ><strong>Mã đơn hàng</strong></td>  
 		  <td width="72" align="center" ><strong>Vận đơn</strong></td> 
          <td width="72" align="center" ><strong>Trị giá đơn</strong></td>
          <td width="100" align="center" ><strong>Tổng tiền</strong></td>
		<td width="100" align="center" ><strong>Ship</strong></td>
		 <td width="100" align="center" ><strong>đơn vị vận chuyển
			</strong></td>
			<td width="100" align="center" ><strong>Địa chỉ KH
			</strong></td>
			<td width="100" align="center" ><strong>Tỉnh
			</strong></td>
			<td width="100" align="center" ><strong>Quận
			</strong></td>
			<td width="100" align="center" ><strong>Phường
			</strong></td>
  	 </tr>
<?php


$rows_begin = 12;
$rows_end = count($sheets);
$tam=[];
$loi=false;
if ($count_rows >= 600) $rows_end = 600;
list($cols,) = $xlsx->dimension();
$cols=22;
if(isset($_POST['DATA'])){
$_SESSION["mangbilltailen"]='';
	$data1 = $_POST['DATA']; 
	$tmp = explode('*@!',$data1);
	$tudong=laso($tmp[1]);
	
	$dendong=laso($tmp[2]);
	if($tudong){
		$rows_begin =($tudong-1);
	}
	if($dendong){
		$rows_end=($dendong-1);
	}	
	
	$sott=0;
	$mangtrung=[];	
	$mangbillailen=[];
foreach($sheets as $k => $r) {
		$sott++;
		$checkloi=true;		
		$onclick=''; 
		$mauchu='green';
		$baoloirong='';
		$count2dong='';
		$baoloi='';
		$luachon=0;
		if (($k >= $rows_begin) && ($k <= $rows_end)) {
			if(!checksobill(trim($r[0]))){
					$mauchu='red';
					$baoloi.="Không tìm thấy số bill";	
					$loi=true;
					$checkloi=false;
			}
			
			$trunglap=checktrunglap($sheets,$k,trim($r[0]));
			$tamcheck=false;
			if(in_array(trim($r[0]),$mangtrung)){
				$baoloi.="Trùng số bill";	
				$mauchu='red';
					$loi=true;
					$checkloi=false;
			}
			else{
				$tamcheck=true;
			}
			if($trunglap['sodong']>0){
				$mauchu='red';
				array_push($mangtrung,trim($r[0]));
				
					$baoloi.="Trùng số bill";	
					$loi=true;
					$checkloi=false;
			}else{
				$tamcheck=true;
			}
			
			if($tamcheck==true){
				array_push($mangbillailen,trim($r[0]));
			}
			
			
					
				?>
				
				<tr style="color:<?php echo $mauchu;?>">
					<td style=""	class="input_tb input_tb<?php echo $k; ?>" >
						<?php echo $sott; ?>
					</td>
					<td style="" id="loi<?php echo $k; ?>">
						<?php
							if(!$checkloi){
								?>
								
									<span style="cursor:pointer;color:#FF0000" onclick="xuatbaoloi('<?php echo $baoloi; ?>')">lỗi</span>
								<?php	
							}
						?>
						
					</td>
					<td><input type="text" class="input_tb input_tb<?php echo $k; ?>" id="sobill<?php echo $k; ?>" value="<?php echo $r[0]; ?>" style="color:<?php echo $mauchu;?>" onchange="editRow(event,<?php echo $k; ?>,1)"/>
					<input type="hidden" class="input_tb input_tb<?php echo $k; ?>" id="sobillcu<?php echo $k; ?>" value="<?php echo $r[0]; ?>" style="color:<?php echo $mauchu;?>" onchange="editRow(event,<?php echo $k; ?>,1)"/>  </td>
					<td><input type="text" class="input_tb input_tb<?php echo $k; ?>" id="madh<?php echo $k; ?>" value="<?php echo $r[1]; ?>" style="color:<?php echo $mauchu;?>" onchange="editRow(event,<?php echo $k; ?>)" /> </td>
					<td><input type="text" class="input_tb input_tb<?php echo $k; ?>" id="mavd<?php echo $k; ?>" value="<?php echo $r[2]; ?>" style="color:<?php echo $mauchu;?>" onchange="editRow(event,<?php echo $k; ?>)" /> </td>
					<td><input type="text" class="input_tb input_tb<?php echo $k; ?>" id="trigiadon<?php echo $k; ?>" value="<?php echo $r[3]; ?>" style="color:<?php echo $mauchu;?>" onchange="editRow(event,<?php echo $k; ?>)" /> </td>
					<td><input type="text" class="input_tb input_tb<?php echo $k; ?>" id="tongtien<?php echo $k; ?>" value="<?php echo $r[4]; ?>" style="color:<?php echo $mauchu;?>" onchange="editRow(event,<?php echo $k; ?>)" /> </td>
					<td><input type="text" class="input_tb input_tb<?php echo $k; ?>" id="ship<?php echo $k; ?>" value="<?php echo $r[5]; ?>" style="color:<?php echo $mauchu;?>" onchange="editRow(event,<?php echo $k; ?>)" /> </td>
					<td><input type="text" class="input_tb input_tb<?php echo $k; ?>" id="donvivc<?php echo $k; ?>" value="<?php echo $r[6]; ?>" style="color:<?php echo $mauchu;?>" onchange="editRow(event,<?php echo $k; ?>)" /> </td>
					<td><input type="text" class="input_tb input_tb<?php echo $k; ?>" id="diachikh<?php echo $k; ?>" value="<?php echo $r[7]; ?>"  style="color:<?php echo $mauchu;?>" onchange="editRow(event,<?php echo $k; ?>)" /> </td>
					<td><input type="text" class="input_tb input_tb<?php echo $k; ?>" id="tinh<?php echo $k; ?>" value="<?php echo $r[8]; ?>" style="color:<?php echo $mauchu;?>"  onchange="editRow(event,<?php echo $k; ?>)" /> </td>
					<td><input type="text" class="input_tb input_tb<?php echo $k; ?>" id="quan<?php echo $k; ?>" value="<?php echo $r[9]; ?>" style="color:<?php echo $mauchu;?>"  onchange="editRow(event,<?php echo $k; ?>)" /> </td>
					<td><input type="text" class="input_tb input_tb<?php echo $k; ?>" id="phuong<?php echo $k; ?>" value="<?php echo $r[10]; ?>"  style="color:<?php echo $mauchu;?>"  onchange="editRow(event,<?php echo $k; ?>)" /> </td>
					
				</tr>
				
				<?php
		}
	
}
}


$_SESSION["mangbilltailen"]=$mangbillailen;
?>

</table>  


</div>

<?php
 
if ($loi) {?>

<div style="padding-bottom:10px;padding-left:20px"><input type="button" id="dulieue" name="dulieue"  onclick="xuatbaoloi('Có lỗi trong file tải lên chú ý chổ màu đỏ!')" value="Lấy dữ liệu Excel"/> </div>  
 <?php
}
 else  
 {
 ?>
 <div style="padding-bottom:10px;padding-left:20px"><input  type="button" id="dulieue" name="dulieue"  onclick="laydulieuexel()" value="Lấy dữ liệu Excel"/> </div>  
  <?php
 }
      	
    $data->closedata() ;


function checksobill($soct){
$soct=trim($soct);

$sql="select ID from phieunhapxuat where SoCT='$soct'";
//echo $sql;
global $data;
$dong=getdong($sql);
if($dong['ID']){
		return $dong;
	}
	else{
		return false;
	}

}

function CheckVanChuyen($sobill)
{
global  $data;
    $sql = "SELECT ID,IDbill, mavd, sobill, madh, diachi, tinh, quan, phuong,trigiadon,phitravc,tongtien,donvivc from vanchuyenonline where sobill ='$sobill'";
  //   echo $sql;
    $tam = getdong($sql);
	//var_dump($tam);
    return $tam;

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
	
function checktrunglap($sheettam,$k,$bill){
	$checkcount=0;
		for($i=$k+1;$i<=count($sheettam);$i++){
			
			if($sheettam[$i][0]==$bill){
				$checkcount++;
			}
		}
		
	return array("sodong"=>$checkcount);
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

function dateDiffMi($ngay1,$ngay2){
//echo "ngay2: ".$ngay2."<br/>";
//echo "ngay1: ".$ngay1;
	$to_time = strtotime($ngay1);
	$from_time = strtotime($ngay2);
	return round(abs($ngay2 - $ngay1)/60/60,2);
}


function writeFileExel($sheets,$writer,$path,$index,$row){
	
	//$filename = "thuchikt.xlsx";
	$sheets[$index]=$row;
	 		
	  $writer->setAuthor('datdoan');
	 
	foreach($sheets as $key => $value){
		if($key==0){
			$header=[];
			foreach($value as $k=>$v){
				$header[$v]="tring";
			}
			 $writer->writeSheetHeader('Sheet1',$header);	
		}
		else{
		$body=[];
			foreach($value as $k=>$v){
				array_push($body,$v);
			}
			
			 $writer->writeSheetRow('Sheet1',$body);
		}	
		
	}
	$workbook = $writer->writeToFile($path);
/*	echo "<pre>";
var_dump($workbook);
echo "</pre>";*/
	//ob_end_clean();
//	header('Content-disposition: attachment; filename="'.XLSXWriter::sanitize_filename($filename).'"');
//    header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
//    header('Content-Transfer-Encoding: binary');
//    header('Cache-Control: must-revalidate');
//    header('Pragma: public'); 
//	$writer->writeToStdOut();

}


?>	