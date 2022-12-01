<?php
session_start();
$root_path = '../../' ;

//include_once($root_path."includes/config.php");
include_once($root_path."includes/removeUnicode.php");
include_once($root_path."includes/class.template7.php");
include_once($root_path."includes/class.paging.php");
//include_once($root_path."includes/class.mysql.php");
//include_once($root_path."includes/editor_config.php");
include_once($root_path."includes/function.php");
include_once($root_path."includes/function_local.php");
include_once($root_path."includes/handlers.php");

if(isset($_POST['perform'])){
	
	switch($_POST['perform']){
		case 'GETDANHSACH':
		if(isset($_POST['id'])){
	$id = $_POST['id'];
	$jsonquetthe=json_decode(getListEmployeeDoWork($id),true);
	$dataquetthe=$jsonquetthe["data"];
	$dataquetthe=unserialize($dataquetthe);
	$chuoiinsert='';
	foreach($dataquetthe as $key => $value){
		$sql= "select ID from nhanviendilam where IDnhanvien=$key and ngaytao='$value'";
		$query=query($sql);
		$numrow=mysqli_num_rows($query);
		$chuoiwherenv.=$value.',';
		if($numrow==0){
			$chuoiinsert.='('.$key.',"'.$value.'"),';
		}
	}
	$chuoiinsert=rtrim($chuoiinsert,',');
	$sql="insert into nhanviendilam (IDnhanvien,ngaytao) values $chuoiinsert";
	query($sql);
}

			GetDSByPB(); 
		break;
		case 'GETPAGI':
			GetPagination(); 
		break;
		case 'GETDSPAGI':
			GetDSByPBPagi(); 
		break;
		case 'LUUSUATAN':
			LuuSuatAn(); 
		break;
		case 'SUASUATAN':
			suaSuatAn(); 
		break;
		case 'SAVENOTE':
			luughichubaocaokv(); 
		break;
		case 'XOACHIASUAT':
			xoachiasuat(); 
		break;
		case 'LUUSUATANDATRUOC':
			LuuSuatAnDatTruoc();
		break;
		case 'SUASUATANDATRUOC':
			suaSuatAnDatTruoc();
		break;
		default:
		break;
	}
	
}
function suaSuatAnDatTruoc(){
global $conn;
	$id = $_POST['id'];
	$type = $_POST['type'];
	$ngay = gmdate('Y-n-d H:i:s', time() + 7*3600) ;
	$nguoitao=$_SESSION['user']['fullname'];
	$ngayngaydangki = $_POST['ngaydattruoc'];
	//kkiem tra ton tai chua
		$arrsuatcom=checktontaidattruoc($id,$ngayngaydangki);
	$idsuatcom=$arrsuatcom['ID'];
	$pbsuatcom=$arrsuatcom['maphongban'];
	
	if($ngayngaydangki){
		if($idsuatcom){
		
			if($type==0){
				$sql="update suat_an set  comtrua=if(comtrua=1,0,1),capnhat='$ngay' where id=$idsuatcom";
			}
			else if($type==1){
				$sql="update suat_an set  comtoi=if(comtoi=1,0,1),capnhat='$ngay' where id=$idsuatcom";
			}
		}
		else{
			if($type==0){
				$sql="insert into suat_an (maphongban,tennhanvien,chucvu,manhanvien,comtrua,ngaydangky,ngaytao,nguoitao,capnhat,nguoicapnhat,IDnhanvien,dattruoc,xacnhan) select a.maphongban,a.tennhanvien,b.Name,a.manhanvien,1,'$ngayngaydangki','$ngay','$nguoitao','$ngay','$nguoitao',$id,$dattruoc,xacnhan='$xacnhan' from nhan_vien a left join kh_chucvu b on a.chucvu=b.id where a.ID=$id";
			}
			else if($type==1){
				$sql="insert into suat_an (maphongban,tennhanvien,chucvu,manhanvien,comtoi,ngaydangky,ngaytao,nguoitao,capnhat,nguoicapnhat,IDnhanvien,dattruoc,xacnhan) select a.maphongban,a.tennhanvien,b.Name,a.manhanvien,1,'$ngay','$ngay','$nguoitao','$ngay','$nguoitao',$id,$dattruoc,xacnhan='$xacnhan' from nhan_vien a left join kh_chucvu b on a.chucvu=b.id where a.ID=$id";
			}
		}
		//echo $sql;
		//return;
		
			$stmt = $conn->query($sql);				
				if(checkchiasuatkv($_SESSION['user']["department"],$ngayngaydangki)['ID']){
					echo 2; 
					return;
				}
			echo $stmt;
	}
	else{
		echo -2;
	}
}
function LuuSuatAnDatTruoc(){
	global $conn;
	$id = $_POST['id'];
	$idpb = $_POST['idpb'];
	$idkv= $_POST['idkv'];
	$type = $_POST['type'];
	$ngaychia = $_POST['ngaydattruoc'];
	$ngayngaydangki = $_POST['ngaydattruoc'];
	
	if($ngayngaydangki ){
		
		$dattruoc= $_POST['dattruoc'];
		$xacnhan= $_POST['xacnhan'];
		$ngay = gmdate('Y-n-d H:i:s', time() + 7*3600) ;
		$nguoitao=$_SESSION['user']['fullname'];
		//kkiem tra ton tai chua
		$arrsuatcom=checktontaidattruoc($id,$ngayngaydangki);
		$idsuatcom=$arrsuatcom['ID'];
		$pbsuatcom=$arrsuatcom['maphongban'];
		if($idsuatcom){
			
			if($type==0){
				$sql="update suat_an set  comtrua=if(comtrua=1,0,1),capnhat='$ngay' where id=$idsuatcom";
				
			}
			else if($type==1){
				$sql="update suat_an set  comtoi=if(comtoi=1,0,1),capnhat='$ngay' where id=$idsuatcom";
			}
		}
		else{
			if($type==0){
				$sql="insert into suat_an (maphongban,tennhanvien,chucvu,manhanvien,comtrua,ngaydangky,ngaytao,nguoitao,capnhat,nguoicapnhat,IDnhanvien,dattruoc,xacnhan) select a.maphongban,a.tennhanvien,b.Name,a.manhanvien,1,'$ngayngaydangki','$ngay','$nguoitao','$ngay','$nguoitao',$id,$dattruoc,$xacnhan from nhan_vien a left join kh_chucvu b on a.chucvu=b.id where a.ID=$id";
			}
			else if($type==1){
				$sql="insert into suat_an (maphongban,tennhanvien,chucvu,manhanvien,comtoi,ngaydangky,ngaytao,nguoitao,capnhat,nguoicapnhat,IDnhanvien,dattruoc,xacnhan) select a.maphongban,a.tennhanvien,b.Name,a.manhanvien,1,'$ngay','$ngay','$nguoitao','$ngay','$nguoitao',$id,$dattruoc,$xacnhan from nhan_vien a left join kh_chucvu b on a.chucvu=b.id where a.ID=$id";
			}
		}
		
		//echo checktontai($id);
		
		
			$stmt = $conn->query($sql);				
			
				if(checkchiasuatkv($_SESSION['user']["department"],$ngayngaydangki)['ID']){
					echo 2; 
					return;
				}
				
		
			echo $stmt;
		}
		else{
			echo -2;
		}	
}


function xoachiasuat(){

	$idphong = $_POST['idphong'];
	$ngay = $_POST['ngay'];
	$khuvucden = $_POST['khuvucden'];
	$kvblock=$_POST['kvblock'];
	$sql="select sosuat from khuvuc_chiasuat where idphong='$idphong' and ngay='$ngay' and khuvucden='$khuvucden'";
	$query=query($sql);
	$row=fetch_array($query);
	$suatxoa=$row['sosuat'];
	
	$sql="update khuvuc_chiasuat set sosuat =(sosuat+$suatxoa) where idphong='$idphong' and ngay='$ngay' and khuvucden='$kvblock'";
	$query=query($sql);
	
	if($query){
		$sql="delete from  khuvuc_chiasuat where idphong='$idphong' and ngay='$ngay' and khuvucden='$khuvucden'";
		
		$query=query($sql);
		echo $query;
	}
	else{
		echo -1;
	}

}
function luughichubaocaokv(){
$id = $_POST['id'];
	$ngay = $_POST['ngay'];
	$ghichu = $_POST['ghichu'];
	$sql="update khuvuc_baocao_com set ghichu='$ghichu' where idkhuvuc=$id and ngay='$ngay'";
	
	$query=query($sql);
	echo $query;
}


function LuuSuatAn(){
global $conn;
	$id = $_POST['id'];
	$idpb = $_POST['idpb'];
	$idkv= $_POST['idkv'];
	$type = $_POST['type'];
	$ngaychia = gmdate('Y-m-d');
	$ngay = gmdate('Y-n-d H:i:s', time() + 7*3600) ;
	$nguoitao=$_SESSION['user']['fullname'];
	//kkiem tra ton tai chua
	$arrsuatcom=checktontai($id);
	$idsuatcom=$arrsuatcom['ID'];
	$pbsuatcom=$arrsuatcom['maphongban'];
	if($idsuatcom){
		
		if($type==0){
			$sql="update suat_an set  comtrua=if(comtrua=1,0,1),capnhat='$ngay' where id=$idsuatcom";
			
		}
		else if($type==1){
			$sql="update suat_an set  comtoi=if(comtoi=1,0,1),capnhat='$ngay' where id=$idsuatcom";
		}
	}
	else{
		if($type==0){
			$sql="insert into suat_an (maphongban,tennhanvien,chucvu,manhanvien,comtrua,ngaydangky,ngaytao,nguoitao,capnhat,nguoicapnhat,IDnhanvien) select a.maphongban,a.tennhanvien,b.Name,a.manhanvien,1,'$ngay','$ngay','$nguoitao','$ngay','$nguoitao',$id from nhan_vien a left join kh_chucvu b on a.chucvu=b.id where a.ID=$id";
		}
		else if($type==1){
			$sql="insert into suat_an (maphongban,tennhanvien,chucvu,manhanvien,comtoi,ngaydangky,ngaytao,nguoitao,capnhat,nguoicapnhat,IDnhanvien) select a.maphongban,a.tennhanvien,b.Name,a.manhanvien,1,'$ngay','$ngay','$nguoitao','$ngay','$nguoitao',$id from nhan_vien a left join kh_chucvu b on a.chucvu=b.id where a.ID=$id";
		}
	}
	//echo checktontai($id);
	
	
		$stmt = $conn->query($sql);				
		
			if(checkchiasuatkv($_SESSION['user']["department"])['ID']){
				echo 2; 
				return;
			}
			
	
		echo $stmt;
}
function checktontaikhuvuc_chiasuat($idphong,$khuvucden,$ngay){
	$sql="select ID from khuvuc_chiasuat where idphong='$idphong' and khuvucden='$khuvucden' and ngay='$ngay'";
		
	$query= query($sql);
	$row=fetch_array($query);
	return $row['ID'];
}
function suaSuatAn(){
global $conn;
	$id = $_POST['id'];
	$type = $_POST['type'];
	$ngay = gmdate('Y-n-d H:i:s', time() + 7*3600) ;
	$nguoitao=$_SESSION['user']['fullname'];
	//kkiem tra ton tai chua
		$arrsuatcom=checktontai($id);
	$idsuatcom=$arrsuatcom['ID'];
	$pbsuatcom=$arrsuatcom['maphongban'];
	if($idsuatcom){
	
		if($type==0){
			$sql="update suat_an set  comtrua=if(comtrua=1,0,1),capnhat='$ngay' where id=$idsuatcom";
		}
		else if($type==1){
			$sql="update suat_an set  comtoi=if(comtoi=1,0,1),capnhat='$ngay' where id=$idsuatcom";
		}
	}
	else{
		if($type==0){
			$sql="insert into suat_an (maphongban,tennhanvien,chucvu,manhanvien,comtrua,ngaydangky,ngaytao,nguoitao,capnhat,nguoicapnhat,IDnhanvien) select a.maphongban,a.tennhanvien,b.Name,a.manhanvien,1,'$ngay','$ngay','$nguoitao','$ngay','$nguoitao',$id from nhan_vien a left join kh_chucvu b on a.chucvu=b.id where a.ID=$id";
		}
		else if($type==1){
			$sql="insert into suat_an (maphongban,tennhanvien,chucvu,manhanvien,comtoi,ngaydangky,ngaytao,nguoitao,capnhat,nguoicapnhat,IDnhanvien) select a.maphongban,a.tennhanvien,b.Name,a.manhanvien,1,'$ngay','$ngay','$nguoitao','$ngay','$nguoitao',$id from nhan_vien a left join kh_chucvu b on a.chucvu=b.id where a.ID=$id";
		}
	}
	//echo $sql;
	//return;
	
		$stmt = $conn->query($sql);				
			if(checkchiasuatkv($_SESSION['user']["department"])['ID']){
				echo 2; 
				return;
			}
		echo $stmt;
}
function checktontai($id){
global $conn;
	$sql="select ID,maphongban from suat_an where IDnhanvien=$id and  Day(ngaytao)=Day(now()) and month(ngaytao)=month(now()) and Year(ngaytao)=Year(now())";
	$stmt = $conn->prepare($sql);				
		$stmt->execute();			
		$result = $stmt->get_result();
		$record = $result->fetch_assoc();
	if($record['ID']){
		
		return $record;
	}
	else{
		return false;
	}
	
}
function checktontaidattruoc($id,$ngaythang){
global $conn;

	$sql="select ID,maphongban from suat_an where IDnhanvien=$id and  ngaydangky='$ngaythang' and dattruoc=1";
	$stmt = $conn->prepare($sql);				
		$stmt->execute();			
		$result = $stmt->get_result();
		$record = $result->fetch_assoc();
	if($record['ID']){
		
		return $record;
	}
	else{
		return false;
	}
	
}
function checkDatcom($id){
global $conn;
	$sql="select comtrua,comtoi from suat_an where IDnhanvien=$id and  Day(ngaytao)=Day(now()) and month(ngaytao)=month(now()) and Year(ngaytao)=Year(now())";
	
	$stmt = $conn->prepare($sql);				
		$stmt->execute();			
		$result = $stmt->get_result();
		$record = $result->fetch_assoc();
	return array('comtrua'=>$record['comtrua'],'comtoi'=>$record['comtoi']);
}
function GetDSByPB(){
	global $conn;
	$id = $_POST['id'];
	$limit=20; 
	$sql="select a.*,a.ID as idnv,b.ID as IDpb,b.Name as tenpb,c.Name as chucvuten from (nhan_vien a left join rooms b on a.maphongban=b.ID) left join kh_chucvu c on a.chucvu=c.ID where b.ID=$id";
	$stmt = $conn->prepare($sql);				
		$stmt->execute();			
		$result = $stmt->get_result();
		//return $result;
		$output='';
		$stt=0;
	
	while ($record = $result->fetch_assoc()){
		$stt++;
			$checkdilam=checknhanviendilam($record['idnv']);
			
			if(count($checkdilam)>0){
				$chuoiwherenv.=$record['idnv'].',';
				
				$checkcomtam=checkDatcom($record['idnv']);
				$comtoi=$checkcomtam['comtoi']==1?"checked='checked'":"";
				$comtrua=$checkcomtam['comtrua']==1?"checked='checked'":"";
				
				$ktcom=false;
				if($checkcomtam['comtoi']==1 || $checkcomtam['comtrua']==1){
						$ktcom=true;
				
				}
				
				if(count($checkdilam)>1){
					$giovao=0;
					$giora=0;
					$tongiolam=0;
					$quetlan='';
					$mauchu="";
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
					
					//var_dump($tongiolam);
					
					if($tongiolam<(6.5*3600) && $ktcom){
						$mauchu="red";
						
					}
					
						$giolam=floor($tongiolam/3600);
					$phutlam=($tongiolam-$giolam*3600)/60;
					$tongh='Tổng giờ làm: '.$giolam.'h'.$phutlam.'&#013';
				}
				else{
					$mauchu="";
					$quetlan='';
					foreach($checkdilam as $key => $value){
						$quetlan.='Quét lần '.($key+1).':'.$value.'&#013';
					}
					//$giolam=floor($tongiolam/3600);
					//$phutlam=($tongiolam-$giolam*3600)/60;
					$tongh='';
				}
				
				$tt.=$quetlan.$tongh;
	
			$output.='<tr title="'.$tt.'" style="color:'.$mauchu.'">
                    <td>'.$stt.'</td>
					<td>'.$record['idnv'].'</td>
                    <td>'.$record['tenpb'].'</td>
                    <td>'.$record['tennhanvien'].'</td>
                    <td>'.$record['chucvuten'].'</td>
                    <td>'.$record['manhanvien'].'</td>
					<td align="center">                    		
                      <input type="checkbox" name="lunch" id="lunch" attrib="trua" value="{thongtin}" onclick="luusuatan(event,0,'.$record['idnv'].')" '.$comtrua.'>
				  	</td>
					<td align="center">                    		
                      <input type="checkbox" name="dinner" id="dinner" attrib="toi"  value="" onclick="luusuatan(event,1,'.$record['idnv'].')" '.$comtoi.'>
				  	</td>
                  </tr>';
			}
		}
		echo $output;	
		
}


function GetPagination(){
	global $conn,$chuoiwherenv;
	$id = $_POST['id'];
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
		echo $output;	
}


function GetDSByPBPagi(){
	global $conn,$chuoiwherenv;
	$id = $_POST['id'];
	$curentpage = $_POST['cur'];
	$limit=20; 
	$start=($curentpage-1)*$limit;
	$sql="select a.*,a.ID as idnv,b.ID as IDpb,b.Name as tenpb,c.Name as chucvuten from (nhan_vien a left join rooms b on a.maphongban=b.ID) left join kh_chucvu c on a.chucvu=c.ID where b.ID=$id and a.ID in ($chuoiwherenv) limit $start,$limit";
	
		
		
	$stmt = $conn->prepare($sql);				
		$stmt->execute();			
		$result = $stmt->get_result();
		//return $result;
		$output='';
		$stt=0;
	
	while ($record = $result->fetch_assoc()){
		$stt++;
			//var_dump($record);
			$checkcomtam=checkDatcom($record['idnv']);
			
			$comtoi=$checkcomtam['comtrua']==1?"checked='checked'":"";
			$comtrua=$checkcomtam['comtrua']==1?"checked='checked'":"";
			$output.='<tr>
                    <td>'.$stt.'</td>
					<td>'.$record['idnv'].'</td>
                    <td>'.$record['tenpb'].'</td>
                    <td>'.$record['tennhanvien'].'</td>
                    <td>'.$record['chucvuten'].'</td>
                    <td>'.$record['manhanvien'].'</td>
					<td align="center">                    		
                      <input type="checkbox" name="lunch" id="lunch" attrib="trua" value="" onclick="luusuatan(event,0,'.$record['idnv'].')" '.$comtrua.'>
				  	</td>
					<td align="center">                    		
                      <input type="checkbox" name="dinner" id="dinner" attrib="toi"  value="" onclick="luusuatan(event,1,'.$record['idnv'].')" '.$comtoi.'>
				  	</td>
                  </tr>';
		}
		echo $output;	
		
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


function checkchiasuatkv($mapb,$ngaythang=''){
	if($ngaythang){
		$ngaythang=explode("-",$ngaythang);
		$ngay = $ngaythang[0];
		$thang = $ngaythang[1]; 
		$nam = $ngaythang[2];
		$sql="select ID from khuvuc_chiasuat where idphong=$mapb and DAY(ngay)=$ngay and MONTH(ngay)=$thang and YEAR(ngay)=$nam and dattruoc=1";
	}
	else{
	
	
		$ngay = gmdate('d', time() + 7*3600);
		$thang = gmdate('m', time() + 7*3600); 
		$nam = gmdate('Y', time() + 7*3600); 
		$sql="select ID from khuvuc_chiasuat where idphong=$mapb and DAY(ngay)=$ngay and MONTH(ngay)=$thang and YEAR(ngay)=$nam ";
	}
	$query=query($sql);
	
	$rows=fetch_array($query);
	
		return $rows;
	
}
?>