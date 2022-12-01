<?php 
/*	 //get phòng ban
$sql="select Name,ID from rooms";
		$stmt = $conn->prepare($sql);				
		$stmt->execute();			
		$result = $stmt->get_result();	
		
while ($record = $result->fetch_assoc()){
		$template->assign("ID",$record['ID']);
		$template->assign("Name",$record['Name']);
		//var_dump($record['Name']);
		$template->parse("main.block_phongbans");
}
	$template->assign("ngayhomnay",date("d/m/Y"));
	$ngayoff = "";
	$ngaytao = "2021-11-24 07:30:00";	


$iddautien='FM0705';
$sql="select ID,Name from rooms where ID=(select maphongban from nhan_vien where manhanvien='$iddautien')";
$stmt = $conn->prepare($sql);				
		$stmt->execute();			
		$result = $stmt->get_result();	
$record = $result->fetch_assoc();
$idpb=$record['ID'];
*/

	
		
if(isset($_POST["txtngay"])){

	$ngaytaowhere=$_POST["txtngay"];
	$ngayget=strtotime($_POST["txtngay"]);
	
	//echo $nam;
}
else{
	$ngaytaowhere=date("Y-m-d");
		$ngayget=strtotime(date("Y-m-d H:i:s"));
}


$wherekv=" and  ((ngaytao>='$ngaytaowhere' and ngaytao<='$ngaytaowhere 23:59:00') or (dattruoc=1 and ngaydangky>=$ngaytaowhere)) ";
if(!$maphongban){
	if(isset($_POST["idcha"]) && $_POST["idcha"]!=''){
		$kvpb=$_POST["idcha"];
		//echo $kvpb;
		$wherekv.="and (maphongban in (select idphong from khuvuc where IDcha=$kvpb) or maphongban in (select idphong from khuvuc where id=$kvpb))";
		
	}
	$template->parse("main.block_bcad");
}
else{
	$wherekv.=" and maphongban =$maphongban";
}

compocay11('khuvuc','ten','IDcha',0,0,$kvpb,0);
		$template->assign('muccha',$compocaydata);
	


//echo date('Y-m-d',$ngayget);
$template->assign("ngaykiemtra",date('Y-m-d',$ngayget));
	$ngay=date("d",$ngayget);
	$thang=date("m",$ngayget);
	$nam=date("Y",$ngayget);
$template -> assign("titlePage", $tenphongban[0]["Name"]." - Đăng ký suất ăn ".date("d/m/Y"));
$template->assign("ngayhomnay",date("d/m/Y",$ngayget));
//$template -> assign("tenphongban", $tenphongban[0]["Name"]);
//$maphongban=26; // gan ma phong ban la 26
$idpb = $maphongban?" where b.ID=$maphongban d.ngaytao>='$ngaytaowhere' and d.ngaytao<='$ngaytaowhere 23:59:00'":" where  d.ngaytao>='$ngaytaowhere' and d.ngaytao<='$ngaytaowhere 23:59:00'";
$jsonquetthe=json_decode(getListEmployeeDoWork($idpb),true);
$dataquetthe=$jsonquetthe["data"];
$dataquetthe=unserialize($dataquetthe);
//$nhanviendilam=array_keys($dataquetthe);

$chuoiinsert='';
if($dataquetthe){
	foreach($dataquetthe as $key => $value){
		$sql= "select ID from nhanviendilam where IDnhanvien=$key and ngaytao='$value'";
		$query=query($sql);
		$numrow=mysqli_num_rows($query);
		$chuoiwherenv=$value.',';
		if($numrow==0){
			$chuoiinsert.='('.$key.',"'.$value.'"),';
		}
	}
}
$chuoiinsert=rtrim($chuoiinsert,',');
//var_dump($chuoiinsert);
$sql="insert into nhanviendilam (IDnhanvien,ngaytao) values $chuoiinsert";
query($sql);
//var_dump($dataquetthe);
//$nhanvienall=getListEmployee(0);
//$datanvall=$nhanvienall['data'];
/*$datanvall=unserialize($nhanvienall);
foreach($datanvall as $key => $value){
	saveListEmployee2($value['ID'],$value['IDPhong'],$value['Ten'],$value['ChucVu'],$value['MaNV']);
}*/

/*$sql="select "
$chuoiwherenv='';
foreach($nhanviendilam as $key => $value){
	$chuoiwherenv.=$value.',';
}
$chuoiwherenv=rtrim($chuoiwherenv,',');
*/
/*echo "<pre style='margin-left:20em;'>";
var_dump($chuoiwherenv);
echo "</pre>";*/
//$chuoiwherenv='';
#$tenpb=$record['Name'];
$template->assign("idpb",$idpb);
 $limit=20;
$sql=" select * from suat_an where (comtrua=1 or comtoi=1) $wherekv";
// limit $limit echo $sql;
//echo $sql;
$query =query($sql);				
		//$stmt->execute();			
		//$result = $stmt->get_result();	

	//echo $titlePage = "Đăng ký suất ăn ";
	//$template -> assign("titlePage", $data["Tên phòng ban"]." - Đăng ký suất ăn ".date("d/m/Y"));
	#$template -> assign("tenphongban", $tenpb);
	$i = 0;
	
	while ($record = fetch_array($query)){ $i++;
			$checkdilam=checknhanviendilambaocao($record['IDnhanvien'],$ngay,$thang,$nam);
			$quetlan='';
			$tt='';
			$mauchu="#000";
			$chuoiwherenv.=$record['IDnhanvien'].',';
				//$comtoi=$record['comtoi'];
				//$comtrua=$record['comtrua'];
				//$checkcomtam=checkDatcom($record['IDnhanvien']);
				$comtoi=$record['comtoi']==1?"checked='checked'":"";
				$comtrua=$record['comtrua']==1?"checked='checked'":"";
				
				$ktcom=false;
				if($record['comtoi']==1 ||$record['comtrua']==1){
						$ktcom=true;
				
				}
				if(count($checkdilam)<=0 && $ktcom){
					$mauchu="red";
				}
			if(count($checkdilam)>0){
				
				
				$mauchu="green";
				if(count($checkdilam)>1){
				
					$giovao=0;
					$giora=0;
					$tongiolam=0;
					$quetlan='';
					foreach($checkdilam as $key => $value){
						$quetlan.='Quét lần '.($key+1).':'.$value.'&#013';
						
							if($giovao){
								$giora = strtotime($value);
								$sophut=$giora-$giovao;
								
								$tongiolam+= $sophut;
								 $giovao='';
							}
							else{
								$giovao =strtotime($value);
								
							}
					}
					
					
					if($tongiolam<(6.5*3600) && $ktcom){
						$mauchu="red";
						//var_dump($tongiolam);
					}
					
						$giolam=floor($tongiolam/3600);
					$phutlam=($tongiolam-$giolam*3600)/60;
					$tongh='Tổng giờ làm: '.$giolam.'h'.$phutlam.'&#013';
					
				}
				else{
					
					$quetlan='';
					foreach($checkdilam as $key => $value){
						$quetlan.='Quét lần '.($key+1).':'.$value.'&#013';
					}
					//$giolam=floor($tongiolam/3600);
					//$phutlam=($tongiolam-$giolam*3600)/60;
					$tongh='';
				}
				
			
			}
			
				$tt.=$quetlan.$tongh;
				$template -> assign("comtoi", $comtoi);
				$template -> assign("mauchu", $mauchu);
				$template -> assign("title", $tt);
				$template -> assign("comtrua", $comtrua);
				$template -> assign("IDnhanvien", $record["IDnhanvien"]);
				$template -> assign("sothutu", $i);
				$template -> assign("maphongban", $record["tenpb"]);
				$template -> assign("tennhanvien", $record["tennhanvien"]);
				$template -> assign("chucdanh", $record["chucvuten"]);
				$template -> assign("manhanvien", $record["manhanvien"]);
				
				$template -> parse("main.list_nhanvien");	
			
	}
	//$chuoiwherenv=rtrim($chuoiwherenv,",");
	//$template -> assign("phantrang", GetPagination($idpb,$chuoiwherenv));
	
//	echo GetPagination($idpb);
function checkDatcom($id){
global $conn;
	$sql="select comtrua,comtoi from suat_an where IDnhanvien=$id and  Day(ngaytao)=Day(now()) and month(ngaytao)=month(now()) and Year(ngaytao)=Year(now())";
	$stmt = $conn->prepare($sql);				
		$stmt->execute();			
		$result = $stmt->get_result();
		$record = $result->fetch_assoc();
	return array('comtrua'=>$record['comtrua'],'comtoi'=>$record['comtoi']);
}


function GetPagination($id,$chuoiwherenv){
	global $conn;
//	$id = $_POST['id'];
	$sql="select a.ID from (nhan_vien a left join rooms b on a.maphongban=b.ID) left join kh_chucvu c on a.chucvu=c.ID where b.ID=$id and a.ID in ($chuoiwherenv)";
	
	$result=mysqli_query($conn,$sql);
	$rowcount =mysqli_num_rows($result);
			$limit=20;
		$totalpage=ceil($rowcount/$limit);
		//return $result;
		$output='<a href="#!-1" class="cdp_i" onclick=GetdanhsachPhanTrang(event,"-1",'.$rowcount.')>prev</a>';
		for($i=1;$i<=$totalpage;$i++){
			//var_dump($record);
			$output.='
			<a href="" class="cdp_i" data-id="'.$i.'" onclick=GetdanhsachPhanTrang(event,'.$i.','.$rowcount.')>'.$i.'</a>
			';
		}
		$output.='<a href="" class="cdp_i" onclick=GetdanhsachPhanTrang(event,"+1",'.$rowcount.')>next</a>';
		return $output;	
}


function checknhanviendilam($id){
	$ngay = gmdate('d', time() + 7*3600);
	$thang = gmdate('m', time() + 7*3600); 
	$nam = gmdate('Y', time() + 7*3600); 
	$sql="select IDnhanvien,ngaytao from nhanviendilam where IDnhanvien=$id and DAY(ngaytao)=$ngay and MONTH(ngaytao)=$thang and YEAR(ngaytao)=$nam";
	
	$query=query($sql);
	$artam=[];
	while($rows=fetch_array($query)){
	//var_dump($rows);
		array_push($artam,$rows["ngaytao"]);
	}
	//if(count($artam)>0){
		return $artam;
	//}
	//return false;
}

function checknhanviendilambaocao($id,$ngay,$thang,$nam){
	/*$ngay = gmdate('d', time() + 7*3600);
	$thang = gmdate('m', time() + 7*3600); 
	$nam = gmdate('Y', time() + 7*3600); */
	$sql="select IDnhanvien,ngaytao from nhanviendilam where IDnhanvien=$id and DAY(ngaytao)=$ngay and MONTH(ngaytao)=$thang and YEAR(ngaytao)=$nam";
	
	$query=query($sql);
	$artam=[];
	while($rows=fetch_array($query)){
	//var_dump($rows);
		array_push($artam,$rows["ngaytao"]);
	}
	//if(count($artam)>0){
		return $artam;
	//}
	//return false;
}
function compocay11($table,$nameht,$tencotidchild,$id_root, $level,$select_i,$idcall)
 {	
 		global $data, $compocaydata;  
		$space="--------| &nbsp;";	$name1="";	 	
		for($i=0; $i<$level; $i++)	{$name1.=$space;}
		$sql="SELECT $nameht,ID,$tencotidchild  FROM  $table WHERE $tencotidchild  ='$id_root' and ID != 0";
		$result=query($sql);
		
		if($result){			
			while($result_news = fetch_array($result))
			{  
				$id = $result_news["ID"] ;
				if($select_i==$id){
					$selected="selected";
					
				}
				else{
					$selected="";
				}
				
				if ($result_news["$tencotidchild"] == "0") { $name1 = "" ; }
				$name=$name1."".$result_news["$nameht"];
				$compocaydata.= "<option  title=\"$name\" value='$id' $selected>$name</option>" ;
				compocay11($table,$nameht,$tencotidchild,$id, $level+1,$select_i,$idcall);
			}
		}
}

?>