<?php  
session_start();
//if ($_SESSION["LoginID"] =='') { return ; }
function in($str){echo "<pre>";var_dump($str);echo '</pre>';}

//$giobatdau1=7.3;$g=floor($giobatdau1); $p=$giobatdau1-$g;if($p<0.6&&$p>0) $p=$p*100; echo $p ;
  
//   return;
  
$root_path =getcwd()."/"  ;
include($root_path."biensession.php");
include($root_path."includes/config.php");
include($root_path."includes/removeUnicode.php");
include($root_path."includes/class.paging.php");
include($root_path."includes/class.mysql.php");
include($root_path."includes/function.php");
include($root_path."myfunction.php"); 	

$data = new class_mysql();
$data->config(); 
$data->access();

if(isset($_POST['GETFORMTT'])){
		  $data1 = $_POST['GETFORMTT']; 
			 $tmp = explode('*@!',$data1);
        $id= trim($tmp[0]) ;
		$sql="SELECT * from thongtinluongnv where IDnhanvien= $id";
		$dong=getdong($sql);
			
		$chuoihtml='<table class="tbchuan luongtb">
			<tr>
				<td colspan="4" align="center">
					<h4>Cập nhật thông tin lương nhân viên</h4>				</td>
			</tr>
				<tr>
					<td><strong>Lương cơ bản</strong></td>
					<td><input type="text" id="luongcb" name="luongcb"   value="'.$dong["luongcoban"].'" /></td>
						<td><strong>Lương KPI</strong></td>
					<td><input type="text" id="luongkpi" name="luongkpi"  value="'.$dong["luongkpi"].'"/></td>
				</tr>
				<tr>
					<td><strong>Số của hàng quản lý</strong></td>
					<td><input type="text" id="socuahang" name="socuahang"  value="'.$dong["socuahang"].'"/></td>
						<td><strong>Lương trách nhiệm</strong></td>
					<td><input type="text" id="luongtrachnhiem" name="luongtrachnhiem"  value="'.$dong["luongtrachnhiem"].'" /></td>
				</tr>
				<tr>
					<td><strong>Lương KPI miền</strong></td>
					<td><input type="text" id="luongkpimien" name="luongkpimien"  value="'.$dong["luongkpimien"].'" /></td>
						<td><strong>lương KPI doanh thu</strong></td>
					<td><input type="text" id="luongkpidoanhthu" name="luongkpidoanhthu" value="'.$dong["luongkpidoanhthu"].'"  /></td>
				</tr>
				<tr align="right">
					
					<td colspan="4"><button type="button" id="themthongtin" name="themthongtin">Cập nhật</button></td>
				</tr>
		  </table>';
	echo $chuoihtml;
			return;
		
}
if(isset($_POST['UPDATETT'])){
		  $data1 = $_POST['UPDATETT']; 
			 $tmp = explode('*@!',$data1);
        	$id= trim($tmp[0]) ;
		$id= trim($tmp[0]) ;
		$id= trim($tmp[0]) ;
		$id= trim($tmp[0]) ;
		$id= trim($tmp[0]) ;
		return;
}
if(isset($_POST['XOACAP'])){
  $data1 = $_POST['XOACAP']; 
			 $tmp = explode('*@!',$data1);
        	$id= trim($tmp[0]) ;
			$idpb= trim($tmp[1]) ;
			
			$update=xoacap($id);
			if($update){
				
				 $chuoihtml=loadNSpB($idpb);
					 if($chuoihtml){
							$suacap=suacaphtml($chuoihtmloption);
							 echo $chuoihtml.$suacap;
					 }
					 else{
						echo "###-1###Có lỗi xảy ra vui lòng load lại###";
					 }
				
			}
			else{
				echo "###-1###Có lỗi xảy ra vui lòng thử lại###";
			 }
}
if(isset($_POST['SUACAP'])){
		  $data1 = $_POST['SUACAP']; 
			 $tmp = explode('*@!',$data1);
        	$idcha= trim($tmp[0]) ;
			$id= trim($tmp[1]) ;
		$idpb=trim($tmp[2]);
		$update=suacap($id,$idcha);
		if($update){
			 $chuoihtml=loadNSpB($idpb);
			 if($chuoihtml){
			 		$suacap=suacaphtml($chuoihtmloption);
					 echo $chuoihtml.$suacap;
			 }
			 else{
				echo "###-1###Có lỗi xảy ra vui lòng load lại###";
			 }
		}else{
				echo "###-1###Có lỗi xảy ra vui lòng thử lại###";
		}
		return;
}
if(isset($_POST['SEARCHNV'])){
		  $data1 = $_POST['SEARCHNV']; 
			 $tmp = explode('*@!',$data1);
        	$str= trim($tmp[0]) ;
		$chuoihtml =composx("userac","Ten","",""," where 1=1 and Ten like '%$str%' or MaNV='$str' ");
	
		if($chuoihtml){
			echo '<option value="">Chọn cấp trên</option>'.$chuoihtml;
		}else{
				echo "###-1###không tìm thấy nhân viên!###";
		}
		return;
}
if(isset($_POST['ADDNVPB'])){
			 $data1 = $_POST['ADDNVPB']; 
			 $tmp = explode('*@!',$data1);
        	$idnv= trim($tmp[0]);
			$idpb= trim($tmp[1]);
			$idcha= trim($tmp[2])?trim($tmp[2]):0;
			
			$update=addNVpb($idnv,$idcha,$idpb);
			if($update){
					$chuoihtml=loadNSpB($idpb);
	
					 if($chuoihtml){
					 	$suacap=suacaphtml($chuoihtmloption);
							 echo $chuoihtml.$suacap;
					 }
					 else{
							echo "###-1###có lỗi xả ra vui lòng load lại###";
					 }
			}
			else{
				echo "###-1###có lỗi xả ra vui lòng thử lại###";
			}

}
if(isset($_POST['GETNHANVIEN'])){
		  $data1 = $_POST['GETNHANVIEN']; 
			 $tmp = explode('*@!',$data1);
        	$phongban= trim($tmp[0]) ;
			$chucvu= trim($tmp[1]) ;
			$chuoihtml='<option value="">Chọn nhân viên</option>';
			//IDphong=$phongban and
		$chuoihtml.=composx("userac","Ten",""," where  chucvu=$chucvu");
		echo $chuoihtml;
		return;
}
if(isset($_POST['GETNHANVIENMA'])){
		  $data1 = $_POST['GETNHANVIENMA']; 
			 $tmp = explode('*@!',$data1);
        	$id= trim($tmp[0]) ;
			$sql = "select a.*,b.luongcoban,b.luongkpi,b.socuahang,b.luongtrachnhiem,b.luongkpimien,b.luongkpidoanhthu from userac a left join thongtinluongnv b on a.ID=b.IDnhanvien where  a.ID='$id' limit 1" ;
    		 $result = $data->query($sql) ;
 			$row = $data->fetch_array($result);
			//$chuoihtml='<option value="">Chọn nhân viên</option>';
			//IDphong=$phongban and
		//$chuoihtml.=composx("userac","Ten",$row["ID"],""," where  MaNV='$ma'");
		if($row){
			echo "###1###$row[ID]###$row[MaNV]###$row[ChucVu]###$row[IDPhong]###$row[Ten]###$row[cuahang]###$row[luongcoban]###$row[luongkpi]###$row[socuahang]###$row[luongtrachnhiem]###$row[luongkpimien]###$row[luongkpidoanhthu]###";
		}
		else{
			echo "###-1###Không tìm thấy nhân viên###";
		}
		
		return;
}


if(isset($_POST['SETPB'])){
		  $data1 = $_POST['SETPB']; 
			 $tmp = explode('*@!',$data1);
        	$ma= trim($tmp[0]) ;
			$sql = "select ID,IDphong,ChucVu from userac where  MaNV='$ma' " ;
    		 $result = $data->query($sql) ;
 			$row = $data->fetch_array($result);
			
		echo $row["IDphong"]."-".$row["ChucVu"];
		return;
}


if(isset($_POST['GETMANHANVIEN'])){
		  $data1 = $_POST['GETMANHANVIEN']; 
			 $tmp = explode('*@!',$data1);
        	$id= trim($tmp[0]) ;
			$ten=getten("userac",$id,"Manv");
		echo $ten;
		return;
}

if(isset($_POST['GETNHANSU'])){
		  $data1 = $_POST['GETNHANSU']; 
			 $tmp = explode('*@!',$data1);
        $id= trim($tmp[0]) ;
		
	
		  $chuoihtml=loadNSpB($id);
	
	 if($chuoihtml){
	 $suacap=suacaphtml($chuoihtmloption);
			 echo $chuoihtml.$suacap;
	 }
	 else{
	 	echo "chưa có phòng ban!";
	 }
		return;	
}


if(isset($_POST['UPDATEKPI'])){
		  $data1 = $_POST['UPDATEKPI']; 
			 $tmp = explode('*@!',$data1);
        $value= trim($tmp[0]) ;
		 $idcha= trim($tmp[1]) ;
		 $idnv= trim($tmp[2]) ;
		  $thang= trim($tmp[3]) ;
		  $type= trim($tmp[4]) ;
		  $ID = laso($tmp[5]);
		 	if($ID){
				$w=" and ID <> $ID ";
			}
				if($type==1){
			$sql="select kpi_dexuat,ten from kpi_danhgia where ID=$ID";
			$dong=getdong($sql);
			$diemkpi=$dong["kpi_dexuat"]?$dong["kpi_dexuat"]:0;
			$tenkpi=$dong["ten"];
			if($diemkpi<$value){
					echo "###-1###Số điểm vượt quá tổng điểm của chỉ tiêu kpi này\n$tenkpi\nĐiểm tổng: $diemkpi ###";		
				return;
			}
			
			$sql="select kpi_dexuat,ten from kpi_danhgia where ID=$idcha";
			if($idcha==0){
				$sql="select kpi_dexuat,ten from kpi_danhgia where ID=$ID";
			
			}
			$dong=getdong($sql);
			$diemtong=$dong["kpi_dexuat"]?$dong["kpi_dexuat"]:0;
			$tencha=$dong["ten"];
			
			if($idcha==0){
				$sql="select sum(kpi_danhgia) as dgthang  from kpi_danhgia_thang where IDcha in(select ID from kpi_danhgia where IDCha=$ID) and thang='$thang' and IDnhanvien='$idnv'";
			}
			else{
				$sql="select sum(kpi_danhgia) as dgthang  from kpi_danhgia_thang where IDcha in(select ID from kpi_danhgia where IDCha=$idcha) or IDcha=$idcha and thang='$thang' and IDnhanvien='$idnv'";
			}
			$dong=getdong($sql);
			$dgthang=$dong["dgthang"]?$dong["dgthang"]:0;
			//echo $diemtong;
			$diemconlai=$diemtong-$dgthang;
		 if($diemconlai<$value){
			echo "###-1###Số điểm vượt quá tổng điểm của nhóm kpi này\n$tencha\nĐiểm tổng: $diemtong\nĐiểm còn lại: $diemconlai ###";
			return;
		}
		
		}
		$sql="SELECT ID FROM kpi_danhgia_thang where IDnhanvien=$idnv and thang='$thang' and IDcha=$ID";
		
		$dong=getdong($sql);
		if($dong['ID'] ){
			if($type==1){
			
				$sql="update kpi_danhgia_thang set kpi_danhgia='$value' where ID=$dong[ID]";
			}
			if($type==2){
			
				$sql="update kpi_danhgia_thang  set Ghichu='$value' where ID=$dong[ID]";
			}
		}
		else{
			if($type==1){
			
				$sql="insert into kpi_danhgia_thang (IDcha,IDnhanvien,kpi_danhgia,thang) value($ID,$idnv,'$value','$thang')";
			}
			if($type==2){
			
				$sql="insert into kpi_danhgia_thang (IDcha,IDnhanvien,Ghichu,thang) value($ID,$idnv,'$value','$thang')";
			}
		}
		
	$result=$data->query($sql); 	 
  /*  $categories = array();
while ($row =$data->fetch_array($result) )  {$categories[] = $row;}
	   $chuoihtml='';
	   $stt=0;
	
	 caymenu($categories);
	 echo $chuoihtml;*/
		return;	
}

if(isset($_POST['GETFORMKPI'])){
		  $data1 = $_POST['GETFORMKPI']; 
			 $tmp = explode('*@!',$data1);
        $id= trim($tmp[0]) ;
	//$id=35;
		 $thang= trim($tmp[1]);
		 $idnv= trim($tmp[2]) ;
		 $idphongban= trim($tmp[3]) ;
		 $thang=explode('-',$thang);
		 $month=$thang[1];
		 $year=$thang[0];
		$sql="SELECT a.* FROM kpi_danhgia a where a.chucvu= $id and IDphongban='$idphongban'";
		
		$danhgiaTH=danhgiathang($idnv,$month,$year);
		
	$result=$data->query($sql); 	 
    $categories = array();
	while ($row =$data->fetch_array($result) )  {$categories[] = $row;}
	   $chuoihtml='<table class="tbchuan">
			<thead>
				<tr>
					<th width="200" align="center" valign="middle" style="text-align:center">Chỉ số đánh giá KPIS</th>
					<th width="30" align="center" style="text-align:center">Đề xuất</th>
					<th width="30" align="center" style="text-align:center">Đánh giá</th>
					<th width="200" align="center" style="text-align:center">Ghi chú</th>
				</tr>
			</thead><tbody id="showkpi">';
	   $stt=0;
	   $tongdexuatdanhgia=0;
		$tongdexuat=0;
	 caymenukpi($categories);
	 $chuoihtml.='<tr align="center" valign="middle" class="fixed-bottom" style="color:#FF0000;background-color: #ffffff;">
					<td><strong>
					Tổng cộng
					</strong></td>
					<td><strong>
					'.$tongdexuat.'%
					</strong></td>
					<td>'.$tongdexuatdanhgia.'</td>
					<td style="padding:0"> </td>
				</tr></tbody>
		  </table>';
		 
	 echo $chuoihtml;
		return;	
}


function caymenu($categories,&$chuoihtml,&$chuoihtmloption,&$stt,$parent_id = 0, $char = "")
{ 
		//global $stt;
	  /* BƯỚC 2.1: LẤY DANH SÁCH CATE CON*/
	  $cate_child = array();
	  foreach ($categories as $key => $item)
	  {
		  if ($item["IDcha"] == $parent_id)
		  {
				$cate_child[] = $item;
				unset($categories[$key]);
			   
		  }
	  } 
	  
	  
	   /* BƯỚC 2.2: HIỂN THỊ DANH SÁCH CHUYÊN MỤC CON NẾU CÓ*/
	  if ($cate_child)
	  {  		 
		  foreach ($cate_child as $key => $item)
		  {    
		/*echo "<pre>"; 
		 var_dump($item['ID']);
		  echo "<pre>";*/
		  	if($item["ten"]){
						if($char==''){
					 $chuoihtmloption.="<option value='$item[ID]'>$item[ten]</option>";
						$chuoihtml.="
						
						<div class='kpi-list'>
						
							<p style='font-size: 16px;'><a class='nhanvien' style='cursor: pointer;color:#000000' data-cv='".$item["chucvu"]."' data-id='".$item["IDnhanvien"]."' onclick='getKpiDanhgia(event,$item[phongban])'>".$item["ten"]."</a></p>
							<div id='myBtn' class='btn-edit'>
								
								<button  onClick='block($item[ID])' value='$item[ID]'>Sửa</button>
								<button onClick='xoacapnv($item[ID])' value='$item[ID]'>Xóa</button>
							</div>
						</div>";
					} else{
						$chuoihtml.="
						<div class='kpi-list'>
						
							<p style='font-size: 16px;'><a  class='nhanvien' style='cursor: pointer;color:#000000' data-cv='".$item["chucvu"]."' data-id='".$item["IDnhanvien"]."' onclick='getKpiDanhgia(event,$item[phongban])'>".$char.$item["ten"]."</a></p>
							<div id='myBtn' class='btn-edit'>
							
							<button onClick='block($item[ID])' value='$item[ID]'>Sửa</button>
							<button onClick='xoacapnv($item[ID])' value='$item[ID]'> Xóa</button>
							</div>
							
						</div>";
						 $chuoihtmloption.="<option value='$item[ID]'>".$char.$item["ten"]."</option>";
					}
				}
				/*if( $item["icon"])	$template->assign("icon", "<IMG   src='images/$item[icon]' /> ");
				else $template->assign("icon", ""); */ 
				 /*  $template->parse("main.block_PhanQuyen");
					$template->parse("main.block_PhanQuyen_comp");*/
				
			  /* Tiếp tục đệ quy để tìm chuyên mục con của chuyên mục đang lặp*/
			  caymenu($categories,$chuoihtml,$chuoihtmloption,$stt,$item["ID"], $char." &nbsp; |- - - ");
			
		  }
		
	  }
	}
	
function caymenukpi($categories, $parent_id = 0, $char = "")
{ 
		global $stt, $chuoihtml,$tongdexuat,$danhgiaTH,$tongdexuatdanhgia;
	
	  /* BƯỚC 2.1: LẤY DANH SÁCH CATE CON*/
	  $cate_child = array();
	  foreach ($categories as $key => $item)
	  {
		  if ($item["IDcha"] == $parent_id)
		  {
				$cate_child[] = $item;
				unset($categories[$key]);
			   
		  }
	  } 
	  
	  //var_dump($cate_child);
	   /* BƯỚC 2.2: HIỂN THỊ DANH SÁCH CHUYÊN MỤC CON NẾU CÓ*/
	  if ($cate_child)
	  {  		 
		  foreach ($cate_child as $key => $item)
		  {     
		  	$danhgiathang='';
			$ghichuthang='';
		  	foreach($danhgiaTH as $key => $value){
				if($value['IDcha']==$item['ID']){
					$danhgiathang=$value['kpi_danhgia'];
					$tongdexuatdanhgia+=$danhgiathang;
					$ghichuthang=$value['Ghichu'];
				}
				
			}
			
		  	if($item["ten"]){
					if($char==''){
					$tongdexuat+=$item["kpi_dexuat"];
						$chuoihtml.='<tr bgcolor="#FFFF00">
					<td><strong>
					'.$item["ten"].'
					</strong></td>
					<td align="center" valign="middle" style="color:#FF0000"><strong>
					'.$item["kpi_dexuat"].'%
					</strong></td>
					<td align="center" valign="middle">
						<input name="danhgiakpi" type="text" id="danhgiakpi" style="width:30px" onchange="updateKPI(event,1,'.$item["ID"].','.$item["IDcha"].')" data-id="'.$item["ID"].'" value="'.$danhgiathang.'"/>%
					</td>
					<td align="center" valign="middle" style="padding:0.5em 0">
				      <span style="font-weight: bold">
				      <textarea type="text" name="ghichukpi" id="ghichukpi" style="width:90%" onchange="updateKPI(event,2,'.$item["ID"].','.$item["IDcha"].')" data-id="'.$item["ID"].'">'.$ghichuthang.'</textarea>
			      </span></td>
				</tr>';
					} else{
						$chuoihtml.='<tr >
					<td>
					'.$item["ten"].'
					</td>
					<td align="center" valign="middle">
					'.$item["kpi_dexuat"].'%
					</td>
					<td align="center" valign="middle">
					<input name="danhgiakpi" type="text" id="danhgiakpi" style="width:30px" onchange="updateKPI(event,1,'.$item["ID"].','.$item["IDcha"].')" data-id="'.$item["ID"].'"  value="'.$danhgiathang.'"/>%				  </td>
					<td align="center" valign="middle" style="padding:0.5em 0">
				      <span style="font-weight: bold">
				      <textarea type="text" name="ghichukpi" id="ghichukpi" style="width:90%" onchange="updateKPI(event,2,'.$item["ID"].','.$item["IDcha"].')" data-id="'.$item["ID"].'">'.$ghichuthang.'</textarea>
			      </span></td>
				</tr>';
					}
				}
				/*if( $item["icon"])	$template->assign("icon", "<IMG   src='images/$item[icon]' /> ");
				else $template->assign("icon", ""); */ 
				 /*  $template->parse("main.block_PhanQuyen");
					$template->parse("main.block_PhanQuyen_comp");*/
				
			  /* Tiếp tục đệ quy để tìm chuyên mục con của chuyên mục đang lặp*/
			  caymenukpi($categories, $item["ID"], "con");
			
		  }
		
	  }
}


function danhgiathang($id,$month,$year){
	global $data;
	$sql="select b.* from  kpi_danhgia_thang b where b.IDnhanvien=$id and MONTH(b.thang)=$month and YEAR(b.thang)= $year";
	$query=$data->query($sql);
	//var_dump($sql);
	$result=[];
	while ($row =$data->fetch_array($query) ) {
		array_push($result,$row);
	
	}
	return $result;
}

function suacaphtml($chuoihtmloption){
	
	// $phongban=cayoption("kpi_phongban_nhanvien","ten","IDcha","0","0","0",'0');

	return '<div id="myModal" class="modal" style="z-index:1000">
				<div class="modal-content">
					<div class="modal-header">
						<span id="close-pop" class="close" onclick="hiddenModal()">&times;</span>
						<h2>Sửa cấp</h2>
						<div><span>Chọn cấp trên</span><span id="ressuacap"></span></div>
					</div>
					<div class="modal-body">
						<label>Nhân viên</label>
						<div class="staff-pop">
							<select name="phongban" id="suacappb" class="js-phongban" onchange="suacapnv(this.value)">
								<option value="">Chọn nhân viên</option>
								'.$chuoihtmloption.'
							</select>
						</div>
					</div>
				</div>
			</div>';
			
}

function suacap($id,$idcha){
global $data;
	$sql="update kpi_phongban_nhanvien set IDcha='$idcha' where ID='$id' and ID <> '$idcha'";
	$update=$data->query($sql);
		return $update;
}
function xoacap($id){
global $data;
	$sql="delete from kpi_phongban_nhanvien where ID='$id'";
	$update=$data->query($sql);
		return $update;
}
function formAddUser(){
	$chuoihtml='';
	
}

function loadNSpB($idpb){
global $data;
	$sql="SELECT * FROM kpi_phongban_nhanvien where phongban= $idpb";
				 $chuoihtmloption='';
				
				
					$result=$data->query($sql);
					 
					$categories = array();
				while ($row =$data->fetch_array($result) )  {$categories[] = $row;}
					   $chuoihtml="<div class='showedit showandedit'><div id='loadinxoacap' style='display:inline-block'></div>
					   <div class='showadd' onclick='showthem()'><button style='background-color:#ffc107';margin-right:0.5em >Thêm</button></div><button onclick='showsuaxoa()'>Sửa</button></div>";
					   
					   $stt=0;
					
					 caymenu($categories,$chuoihtml,$chuoihtmloption,$stt);
					 if($chuoihtml){
							$suacap=suacaphtml($chuoihtmloption);
							return $chuoihtml.$suacap.htmlAddnv($chuoihtmloption);
					 }
					 return false;
}

function htmlAddnv($chuoihtmloption){
$chuoinvop=compoloai('userac','MaNV','Ten','','');
	return " <div id='myAdd' class='form-add'>
			<h6>Thêm mới nhân viên</h6>
			<select name='captrenadd' id='captrenadd' class='form-control js-captrenadd input-sm add-staff'
			onchange=''>
				<option value=''>Chọn cấp trên</option>
			$chuoihtmloption
			</select>
			<!--<div class='input-add-staff add-staff'>
				<input class='form-control input-sm' name'' id='' value='' placeholder='Nhập mã hoặc tên nhân viên' onkeyup='OnkeyUpSeacrh(event)' />
			</div>-->
			<select name='nhanvienadd' id='nhanvienadd' class='form-control js-nhanvienadd input-sm add-staff'
			onchange=''>
				<option value=''>Chọn nhân viên</option>
				".$chuoinvop."
			</select>

			<button type='submit' id='luuadd' class='btn btn-success btn-sm btn-add' onclick='addNvPb(nhanvienadd.value,captrenadd.value)'>Lưu</button>
			<div id='loadingtim'></div>
		</div>";
}

function addNVpb($id,$idcha,$idpb){
	global $data;
	$sql="insert into kpi_phongban_nhanvien (IDcha,ten,chucvu,IDnhanvien,manv,phongban) select $idcha,Ten,ChucVu,ID,MaNV,$idpb from userac where ID=$id";
//	echo $sql;
	$update=$data->query($sql);
	return $update;
}
    $data->closedata() ;
?>	