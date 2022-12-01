<?php




		
		$mangrom=taomangmoi("rooms",'ID','Name');
		$chuoiinsert='';
		$chuoiinsert1='';
		
$idkv='';
if(!isset($_POST["ngaytim"])){

	$ngay=date("Y-m-d");
}
else{
	$ngay=$_POST["ngaytim"];
}

if(isset($_POST["idcha"]) && $_POST["idcha"]){
//echo $_POST["idcha"];
	$idkv=" and id =".$_POST["idcha"];
}
if(isset($_REQUEST['xacnhan']) && $_REQUEST['xacnhan']==1){

$sql="update suat_an set xacnhan=22 where ngaydangky='$ngay' and dattruoc=1 and xacnhan<22";
//echo $sql;
$update=query($sql);
$sql="update khuvuc_chiasuat set xacnhan=22 where ngay='$ngay' and dattruoc=1 and xacnhan<22";
$update=query($sql);
$template->parse("main.block_xacnhansucc");
	
}
$suatdattruoc=getsuatandattruoc();

$nhapnhay='';
$titlenhapnhay='';
if($suatdattruoc['tongsuat']>0){
	$nhapnhay='blink';
	$titlenhapnhay='Click vào để xác nhận!';
	$template->assign("nhapnhay",$nhapnhay);
	$template->assign("titlenhapnhay",$titlenhapnhay);
}
$template->assign('muccha',compo11('khuvuc where IDcha=0','ten',$idcha));
	$template->assign("ngayhomnay",$ngay);
	$sql="select count(ID) as tongsuat from suat_an where ngaydangky>='$ngay' and ngaydangky <='$ngay 23:59:00' and dattruoc=1 and xacnhan<22 and (comtrua=1 or comtoi=1)";
	
	$query=query($sql);
	$row=fetch_array($query);
	$template->assign("tongsuatan",$row[tongsuat]);
	
	$sql="select ID,IDcha,ten,diachi,idphong from khuvuc where IDcha=0  $idkv";
	$query=query($sql);
	while($row=fetch_array($query)){
		$template->assign("ID",$row['ID']);
		$idcha=$row['ID'];
		$ghichu=getghichu($row['ID'],$ngay);
		$template->assign("ghichu",$ghichu);
		$template->assign("ten",$row['ten']);
		//lay suất chia các khu vuc khac
		$mangkvtru=getsuatchiakhuvuctru($idcha,$ngay);
		$mangkvcong=getsuatchiakhuvuccong($idcha,$ngay);
		$tongsuattru=0;
		//$suattruarr=$mangkvtru[$idcha];
		foreach($mangkvtru as $key =>$value){
			if($key!=$idcha){
				if($value['tongsuat']){
					$tongsuattru-=$value['tongsuat'];
					$template->assign("tongsuatcong",$value['tongsuat']);
					$template->assign("tensuatcong",$value['ten']);
						$template->parse('main.block_kv.block_suatantru');
				}
				
			}
			
		}
		
		foreach($mangkvcong as $key =>$value){
			//echo $value['khuvucden'];
			if($value['khuvucden']==$idcha){
				if($value['tongsuat']){
					$tongsuattru+=$value['tongsuat'];
					$template->assign("tongsuatcong",$value['tongsuat']);
					$template->assign("tensuatcong",$value['tengoc']);
						$template->parse('main.block_kv.block_suatancong');
				}
				
			}
			
		}
		
		
		//kiem tra ton tai rôi thi update ngược lại thi insert
		$idkvbc=checktontaikhuvuc_baocao_com($row['ID'],$ngay);
		if(!$idkvbc){
				$chuoiinsert.="('$row[IDcha]',$row[ID],'$row[ten]','$row[diachi]','$row[idphong]','$ngay',";
		}	
		
		$tongsuatkv=0;
		$sql1="select count(ID) as tongsuat,maphongban from suat_an where ngaydangky>='$ngay' and ngaydangky <='$ngay 23:59:00' and dattruoc=1 and xacnhan<22 and (comtrua=1 or comtoi=1) and maphongban in (select idphong from khuvuc where IDcha=$row[ID])  group by maphongban";
			$query1=query($sql1);
			while($row=fetch_array($query1)){
						$tongsuatkv+=$row['tongsuat'];
						$template->assign("ID",$idcha);						
						//$idkv=getidkhuvuc($row['maphongban'],$idcha);
						//echo $idcha."<br>";
						//$ghichu=getghichu($idkv,$ngay);
						//$template->assign("idkv",$idkv);
						//get ghi chú chia suat của phòng ban
						$tongsuatpb=$row['tongsuat'];
						$arrghichu=getghichupb($row['maphongban'],$ngay,$idcha);
						foreach($arrghichu as $key =>$value){
						$tongsuatpb-=$value['sosuat'];
							$ss=$value['sosuat'];
							$tenkv=$value['ten'];
								$template->assign("ghichu",'<span style="    display: flex;
    font-size: 12px;
    font-style: italic;
    color: #007bff;">'."-".$ss." ".$tenkv." &nbsp;&nbsp;<span style='color:red'> Ghi chú:&nbsp; </span>".$value['ghichu'].'</span>');
								$template->parse('main.block_kv.block_suatan.block_ghichu');
						}
						//$template->assign("ghichu",$ghichu);
				$template->assign("tongsuat",$row['tongsuat']);
				$template->assign("tongsuatpb",$tongsuatpb);
				$idkvbc1=checktontaikhuvuc_baocao_com($idkv,$ngay);
				//kiem tra ton tai rôi thi update ngược lại thi insert
				if(!$idkvbc1){
					$chuoiinsert1.="('$idcha','$idkv','".$mangrom[$row['maphongban']]."','','$row[maphongban]','$ngay',$row[tongsuat]),";
				}
				else{
					$sqlupdate1="update khuvuc_baocao_com set tong=$row[tongsuat] where ID=$idkvbc1";
					
					query($sqlupdate1);
				}
				$template->assign("phong",$mangrom[$row['maphongban']]?$mangrom[$row['maphongban']]:"Chưa rõ!");
				$template->parse('main.block_kv.block_suatan');
			}
		if($idkvbc){
			
			$sqlupdate="update khuvuc_baocao_com set tong=$tongsuatkv where ID=$idkvbc";
			
			query($sqlupdate);
		}
		else{
			
			$chuoiinsert.="'$tongsuatkv'),";
		}
		$tongsuattru=$tongsuattru+$tongsuatkv;
		$template->assign("tongsuattru",$tongsuattru);
		$template->assign("tongsuatkv",$tongsuatkv);
		$template->parse('main.block_kv');
		
	}
	$chuoiinsert=$chuoiinsert.$chuoiinsert1;
	$chuoiinsert=rtrim($chuoiinsert,',');
	
	//echo $chuoiinsert;

	insertbaocaokv($chuoiinsert);



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


function compo11($table,$Name,$idsosanh){
	
	$sql = "select $Name,ID from $table " ;
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
//===========================================
function taomangmoi($table,$truong1,$truong2,$where=""){

	$sql = "select $truong1,$truong2 from $table $where  "   ;
	
 	$result= query($sql) ;
	$mang =  array() ;
 	while($n = fetch_array($result))
	{
	   $idm = $n[$truong1] ;
	   $ten = $n[$truong2] ;
	   $mang[$idm] =  $ten ;
	   
	}
		 
	return  $mang ;
}


function insertbaocaokv($chuoi){
	$sql="insert into khuvuc_baocao_com (IDcha,idkhuvuc,ten,diachi,idphong,ngay	,tong) values $chuoi";
//	echo $sql;
	return query($sql);
	
}

function getidkhuvuc($mapb,$idcha){
	$sql="select ID from khuvuc where idphong='$mapb' and IDcha='$idcha'";
	$query=query($sql);
	$row=fetch_array($query);
	return $row['ID'];
}

function getghichu($idkv,$ngay){
	$sql="select ghichu from khuvuc_baocao_com where idkhuvuc='$idkv' and ngay='$ngay'";
	$query=query($sql);
	$row=fetch_array($query);
	
	return $row['ghichu'];
}

function getten1($table,$id,$cot){
	$sql="select $cot from $table where ID=$id";
	$query=query($sql);
	$row=fetch_array($query);
	
	return $row[$cot];
}
function checktontaikhuvuc_baocao_com($idkv,$ngay){
	$sql="select ID from khuvuc_baocao_com where idkhuvuc='$idkv' and ngay='$ngay' and dattruoc=1 and xacnhan<22";
		
	$query= query($sql);
	$row=fetch_array($query);
	return $row['ID'];
}

function getsuatchiakhuvuctru($idkv,$ngay){
	$sql="select sum(a.sosuat) as tongsuat,a.khuvucden,b.ten from khuvuc_chiasuat a left join khuvuc b on a.khuvucden=b.ID where a.khuvucgoc = $idkv and ngay='$ngay' and dattruoc=1 and xacnhan<22 group by khuvucden";
		$query=query($sql);
		$mang=[];
	while($row = fetch_array($query))
	{
			$mang[$row['khuvucden']]=array('tongsuat'=>$row['tongsuat'],"ten"=>$row['ten']);
	}
	return $mang;
}


function getsuatchiakhuvuccong($idkv,$ngay){
	$sql="select sum(a.sosuat) as tongsuat,a.khuvucgoc,a.khuvucden,b.ten as tenden,c.ten as tengoc from khuvuc_chiasuat a left join khuvuc b on a.khuvucden=b.ID left join khuvuc c on a.khuvucgoc =c.ID
where a.khuvucgoc <> $idkv and ngay='$ngay'  and dattruoc=1 and xacnhan<22
group by a.khuvucden,a.khuvucgoc";

		$query=query($sql);
		$mang=[];
	while($row = fetch_array($query))
	{
		array_push($mang,$row);
	}
	return $mang;
}


function getghichupb($idghichu,$ngay,$idkv){
	$sql="select a.ghichu,b.ten,a.sosuat from khuvuc_chiasuat a left join khuvuc b on a.khuvucden=b.ID
where a.idphong = $idghichu and ngay='$ngay' and a.khuvucden <> $idkv ";
//echo $sql;
		$query=query($sql);
		$mang=[];
	while($row = fetch_array($query))
	{
		array_push($mang,$row);
	}
	return $mang;
}

function getsuatandattruoc(){
$ngay = gmdate('d', time() + 7*3600);
	$thang = gmdate('m', time() + 7*3600); 
	$nam = gmdate('Y', time() + 7*3600); 
$sql="select count(ID) as tongsuat from suat_an where (comtoi=1 or comtrua=1) and DAY(ngaydangky)=$ngay and MONTH(ngaydangky)=$thang and YEAR(ngaydangky)=$nam and dattruoc=1 and xacnhan<22";
	//echo $sql;
	$query=query($sql);
	$row=fetch_array($query);
	return $row;
}
?>