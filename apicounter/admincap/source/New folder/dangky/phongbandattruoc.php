<?php 
$jsonquetthe=json_decode(getListEmployeeDoWork($idpb),true);
$dataquetthe=$jsonquetthe["data"];
$dataquetthe=unserialize($dataquetthe);
//$nhanviendilam=array_keys($dataquetthe);

$chuoiinsert='';
$chuoiupdate='';
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

//echo $_REQUEST['xacnhan'];
if(isset($_REQUEST['xacnhan']) && $_REQUEST['xacnhan']==1){

$sql="update suat_an set xacnhan=21 where ngaydangky='$_SESSION[ngaydattruoc]' and dattruoc=1 and left(xacnhan,1)=1";
//echo $sql;
$update=query($sql);
$sql="update khuvuc_chiasuat set xacnhan=21 where ngay='$_SESSION[ngaydattruoc]' and dattruoc=1 and left(xacnhan,1)=1";
$update=query($sql);


}



$idkhuvuc='';
if($maphongban){

	$khuvuc=getkhuvuc($maphongban);
	$tenkhuvuc=$khuvuc['ten'];
	$idkhuvuc=$khuvuc['ID'];
	$template->assign("idkhuvuc",$idkhuvuc);
	$template->assign("maphongban",$maphongban);
	$template->assign("khuvuc",$tenkhuvuc);

}
date_default_timezone_set('Asia/Ho_Chi_Minh').
$ngay=date("Y-m-d");
$template->assign("ngayhomnay",$ngay);
$template -> assign("titlePage", $tenphongban[0]["Name"]." - Đăng ký suất ăn ".date("d/m/Y"));
	$tongsuat=0;
	$thu=date('w', strtotime($ngay));
//echo $thu;

if(!isset($_REQUEST['view'])){
$suatdattruoc=getsuatandattruoc($maphongban);

$nhapnhay='';
$titlenhapnhay='';
if($suatdattruoc['tongsuat']>0){
$nhapnhay='blink';
$titlenhapnhay='Bạn có suất ăn đặt trước! Click vào xác nhận!';
}
$template -> assign("linkcard", '<a href="?act=suatan&dangky=phongbandattruoc&id='.$maphongban.'&view=1" class="card-link">Chia suất ăn</a>');
$template -> assign("linkxacnhan", '<a href="?act=suatan&dangky=phongbandattruoc&id='.$maphongban.'&xacnhan=1" class="card-link '.$nhapnhay.'" style="margin-left:0" title="'.$titlenhapnhay.'" onclick="xacnhandattruoc(event)">Xác nhận</a>');
$template -> assign("titlengay", "Đặt trước suất ăn ngày ");

$idpb = $maphongban?" where b.ID=$maphongban ":"";

$template->assign("idpb",$idpb);
 $limit=20;
$sql="select a.*,a.ID as idnv,b.ID as IDpb,b.Name as tenpb,c.Name as chucvuten from (nhan_vien a left join rooms b on a.maphongban=b.ID) left join kh_chucvu c on a.chucvu=c.ID  $idpb ";
// limit $limit echo $sql;

	$stmt = $conn->prepare($sql);				
		$stmt->execute();			
		$result = $stmt->get_result();	

	
	$i = 0;
$ktcom=false;
$ngaydattruoc='';

	while ($record = $result->fetch_assoc()){ $i++;
			$checkdilam=checknhanviendilam($record['idnv']);
			$quetlan='';
			$tt='';
			$chuoiwherenv.=$record['idnv'].',';
				$mauchu="#000";
				$checkcomtam=checkDatcom($record['idnv']);
				$comtoi=$checkcomtam['comtoi']==1?"checked='checked'":"";
				$comtrua=$checkcomtam['comtrua']==1?"checked='checked'":"";
				
				//var_dump($checkcomtam);
				
					if($checkcomtam['comtoi']==1 || $checkcomtam['comtrua']==1 && $checkcomtam['ngaydangky']){
							if(!$ktcom){
								$ktcom=true;
								$ngaydattruoc=$checkcomtam['ngaydangky'];
								//var_dump($checkcomtam);
							
						}
						$tongsuat++;
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
						}
						
							$giolam=floor($tongiolam/3600);
						$phutlam=($tongiolam-$giolam*3600)/60;
						$tongh='Tổng giờ làm: '.$giolam.'h'.$phutlam.'&#013';
					}
					else{
						//$mauchu="green";
					
							$quetlan='';
							foreach($checkdilam as $key => $value){
								$quetlan.='Quét lần '.($key+1).':'.$value.'&#013';
							}
								
						
						//$giolam=floor($tongiolam/3600);
						//$phutlam=($tongiolam-$giolam*3600)/60;
						$tongh='';
					}
					
					$tt.=$quetlan.$tongh;
					
				}
				else{
						//var_dump($ktcomt);
						 
						if($ktcom){
							$mauchu="red";
						}
				}
				$template -> assign("comtoi", $comtoi);
				$template -> assign("mauchu", $mauchu);
				$template -> assign("title", $tt);
				$template -> assign("comtrua", $comtrua);
				$template -> assign("idnv", $record["idnv"]);
				$template -> assign("IDpb", $record["IDpb"]);
				$template -> assign("idkv", $idkhuvuc);
				$template -> assign("sothutu", $i);
				$template -> assign("maphongban", $record["tenpb"]);
				$template -> assign("tennhanvien", $record["tennhanvien"]);
				$template -> assign("chucdanh", $record["chucvuten"]);
				$template -> assign("manhanvien", $record["manhanvien"]);
				
				$template -> parse("main.block_dksuatan.list_nhanvien");
			
	}
	$_SESSION['tongsuatpb']=$tongsuat;
	
	$sql="select a.* from khuvuc_chiasuat a where idphong='$maphongban' and ngay>='$ngay' and dattruoc=1 and left(xacnhan,1)=1";
	
	$query =query($sql);
	while ($record=fetch_array($query)){ 
	
		$template->assign("tenkv",getkhuvucmkv($record['khuvucden'])['ten']);
		$template->assign("sosuat",$record['sosuat']);
		$template -> parse("main.block_sosuatchia");
	}
	if($ktcom){
		$template -> assign("disabalengay", 'disabled="disabled"');
	}
	$template -> assign("ngaydattruocfom", $ngaydattruoc?date("d/m/Y",strtotime($ngaydattruoc)):"");
	$template -> assign("ngaydattruoc", $ngaydattruoc);
	$_SESSION['ngaydattruoc']=$ngaydattruoc;
	$template -> assign("tongsuat", $tongsuat);
	$template -> parse("main.block_dksuatan");
}
else{
$template -> assign("hiddenngay","display:none" );
loadlaitongcom($maphongban,$_SESSION['ngaydattruoc']);
$template -> assign("titlengay", "Chia suất ăn đặt trước ngày ".$_SESSION['ngaydattruoc']);
$template -> assign("linkcard", '<a onclik="refreshUrl()" href="?act=suatan&dangky=phongbandattruoc&id='.$maphongban.'" class="card-link">Đặt cơm</a>');
	$tongsuat=$_SESSION['tongsuatpb'];
	//echo $tongsuat;
	$template -> assign("tongsuatgoc", $tongsuat);
	$template->assign('muccha',compo11('khuvuc','ten',''," where IDcha=0 and ID <> $idkhuvuc"));
	
	
	$sql="select a.*,b.ten from khuvuc_chiasuat a left join khuvuc b on a.khuvucden=b.ID where a.idphong=$maphongban and ngay='".$_SESSION['ngaydattruoc']."' and khuvucden <> $idkhuvuc and dattruoc=1 and left(xacnhan,1)=1";
	$query =query($sql);	
	$numrow=num_rows($query);
	
	$monut=' disabled="disabled"  ';
	$tongsuatdachia=0;
	if($numrow>0){
	
	$monut=' style="display:flex" ';
		while ($record=fetch_array($query)){ 
			$template->assign('khuvucden',$record['khuvucden']);
			//var_dump($record['khuvucden']);
			$template->assign('ten',$record['ten']);
			$template->assign('idc',$record['ID']);
			$template->assign('maphongban',$maphongban);
			$template->assign('sosuat',$record['sosuat']);
			$tongsuatdachia+=$record['sosuat'];
			$template->assign('ghichu',$record['ghichu']);
			$template -> parse("main.block_chiasuatan.block_chiasuatanct");
		}
	}
	$tongsuat-=$tongsuatdachia;
	$template -> assign("tongsuat", $tongsuat);
	$template->assign('monut',$monut);
	if(isset($_POST['UpateChiaSuat']))
	{
		$tongsuatgoc=$_SESSION['tongsuatpb'];
		$ngay=$_SESSION['ngaydattruoc'];
		$tongsuat=$_POST["tongsuatt"];
		$idpbchia=$_POST["idpbchia"];
		$sosuatchia=$_POST["sosuat"];
		$idc=$_POST["idc"];
		$ghichuchia=$_POST["ghichu"];
		$dattruoc=1;
		$idkvchia=checktontaikhuvuc_chiasuat($maphongban,$idkhuvuc,$ngay);
		
		if($idkvchia){
			xoakhuvuc_chiasuat($idkvchia);
		}
			
		$tongsuatchia=0;
		$manggop=[];
		foreach($idpbchia as $key =>$value){
			$manggop[$value]=array("sosuat"=>$sosuatchia[$key],"ghichu"=>$ghichuchia[$key],"idc"=>$idc[$key]);
			$tongsuatchia+=$sosuatchia[$key];
		}
		$tongsuatgoc-=$tongsuatchia;
		$manggop[$idkhuvuc]=array("sosuat"=>$tongsuatgoc,"ghichu"=>"");
		$chuoiinsert='';
		//var_dump($manggop);return;
		foreach($manggop as $key => $value){
			$idchecktontai=checktontaikhuvuc_chiasuat($maphongban,$key,$ngay);
			if($idchecktontai){
				$sqlupdate="update khuvuc_chiasuat set sosuat=$value[sosuat],khuvucgoc=$idkhuvuc where ID=$idchecktontai and dattruoc=1";
				
				$query=query($sqlupdate);
			}else{
				$chuoiinsert.="('$key','$value[sosuat]','$value[ghichu]','$maphongban','$ngay','$idkhuvuc','$dattruoc'),";
			}
		}
		$chuoiinsert=rtrim($chuoiinsert,',');
		
		$result=insertkhuvuc_chiasuat($chuoiinsert);
		if($result){
			$template -> parse("main.block_chiasuatan.block_chiasuatansucc");
		}
		else{
				$template -> parse("main.block_chiasuatan.block_chiasuatanfail");
		}
	}
	
	
	$template -> parse("main.block_chiasuatan");
}
	//$chuoiwherenv=rtrim($chuoiwherenv,",");
	//$template -> assign("phantrang", GetPagination($idpb,$chuoiwherenv));
	
//	echo GetPagination($idpb);
function checkDatcom($id){
	global $conn;
	$sql="select comtrua,comtoi,ngaydangky from suat_an where IDnhanvien=$id and  Day(ngaydangky)>=Day(now()) and month(ngaydangky)>=month(now()) and Year(ngaydangky)>=Year(now()) and dattruoc=1 and left(xacnhan,1)=1";
	$stmt = $conn->prepare($sql);				
		$stmt->execute();			
		$result = $stmt->get_result();
		$record = $result->fetch_assoc();
	return array('comtrua'=>$record['comtrua'],'comtoi'=>$record['comtoi'],'ngaydangky'=>$record['ngaydangky']);
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
function getkhuvuc($mapb){
	$sql="select ID,ten from khuvuc where ID = (select IDcha from khuvuc where idphong=$mapb)";
	
	$query=query($sql);
	$row=fetch_array($query);
	return $row;
}

function getkhuvucmkv($idkv){
	$sql="select ID,ten from khuvuc where ID =$idkv";
	
	$query=query($sql);
	$row=fetch_array($query);
	return $row;
}
 function compo11($table,$Name,$idsosanh,$where){
	
	$sql = "select $Name,ID from $table $where" ;
	
 	$result= query($sql) ;
	while($n =fetch_array($result))
	{
		if($n["ID"] == $idsosanh)
		{
			$output .= "<option value='".$n["ID"]."' selected>".$n[$Name]."</option>\n";
		}
		else
		{
			$output .= "<option value='".$n["ID"]."'>".$n[$Name]."</option>\n";
		}
	}
	return $output;
 } 


function insertkhuvuc_chiasuat($chuoi){
	$sql="insert into khuvuc_chiasuat (khuvucden,sosuat,ghichu,idphong,ngay,khuvucgoc,dattruoc) values $chuoi";
	//echo $sql;
	
	return query($sql);
	
}

function xoakhuvuc_chiasuat($id){
	$sql="delete  from khuvuc_chiasuat where ID=$id";
	
	$query= query($sql);
	
	return $query;
}
function checktontaikhuvuc_chiasuat($idphong,$khuvucden,$ngay){
	$sql="select ID from khuvuc_chiasuat where idphong='$idphong' and khuvucden='$khuvucden' and ngay='$ngay'";
		
	$query= query($sql);
	$row=fetch_array($query);
	return $row['ID'];
}



function loadlaitongcom($idpb,$ngay){
/*$ngay = gmdate('d', time() + 7*3600);
	$thang = gmdate('m', time() + 7*3600); 
	$nam = gmdate('Y', time() + 7*3600);*/ 
	$sql="select count(ID) as tongsuat from suat_an where (comtoi=1 or comtrua=1) and maphongban=$idpb and ngaydangky='$ngay' and dattruoc=1 and left(xacnhan,1)=1";
	//echo $sql;
	$query=query($sql);
	$row=fetch_array($query);
	$_SESSION['tongsuatpb']=$row['tongsuat'];
			

}


function getsuatandattruoc($idpb){
$ngay = gmdate('d', time() + 7*3600);
	$thang = gmdate('m', time() + 7*3600); 
	$nam = gmdate('Y', time() + 7*3600); 
$sql="select count(ID) as tongsuat from suat_an where (comtoi=1 or comtrua=1) and maphongban=$idpb and DAY(ngaydangky)=$ngay and MONTH(ngaydangky)=$thang and YEAR(ngaydangky)=$nam and dattruoc=1 and left(xacnhan,1)=1";
	
	$query=query($sql);
	$row=fetch_array($query);
	return $row;
}
?>