<?php  
session_start();
$idk = $_SESSION["LoginID"] ; if (  $idk == '') return ;
 //import thư viện
$root_path ='' ;
include($root_path."includes/config.php");
include($root_path."includes/removeUnicode.php");
 include($root_path."includes/class.mysql.php");
include($root_path."includes/function.php");
 	include( $root_path."excel/simplexlsx.class.php");
  	$tm = $_SESSION["root_path"] ; 
	
 
//khỏi tạo data
$data = new class_mysql();
$data->config();
$data->access();


//if(isset($_POST["DATA"])){
$data1 = $_POST['DATA']; 
$tmp = explode('*@!',$data1);
$success=0;
$fail=0;

$loi='';
$thang = gmdate('m', time() + 7*3600); 
$nam = gmdate('y', time() + 7*3600); 
$sp=laso(GetsoCT());
echo  $sp ."=======";
	$ngaytao = gmdate('Y-n-d H:i:s', time() + 7*3600) ;
	$ngaynhap = gmdate('Y-n-d', time() + 7*3600) ;
		
$path = $root_path."data/shoppe2.xlsx" ;
$xlsx = new SimpleXLSX($path);
$sheets=$xlsx->rows();
$rows_begin = 2;
$rows_end = count($sheets);
$tam=[];
$loi=false;
if ($count_rows >= 600) $rows_end = 600;
list($cols,) = $xlsx->dimension();
	$check=0;
//trường bắt buôt có
foreach($sheets as $key => $r){
                 
                    if($key>=$rows_begin && $key <=$rows_end){
			if($r[0]){
			$check++;
                    //tinh
					$mangtinh=checktinh(trim($r[51]));
                    if(!$mangtinh){
                        $mangtinh=trim($r[51]);
                    }
                    //quan
					$mangquan=checkquan(trim($r[52]));
                    if(!$mangquan){
                        $mangquan=trim($r[52]);
                    }
                    
                    //phuong
					$mangphuong=checkphuong(trim($r[53]));
                    if(!$mangphuong){
                       $mangphuong=trim($r[53]);
                    }
                   
					$mangdiachi=addslashes(trim($r[54]));
                 
                      //khách hàng
					  $mangkh='';
					//khách hàng
						$checkkh=checkExists('makh',replacesdt($r['T20']),"customer");
						
                    if($checkkh){
                        $mangkh=$checkkh;
                    }
                    else{
						$checkkh1=checkExists('makh',trim($r['T20']),"customer");
						if($checkkh1){
							 $mangkh=$checkkh1;
						}
						else{
						
							//$mangkh=array("sdt"=>$r[19]);
							$quan=is_array($mangquan)?$mangquan["ID"]:$mangquan;
							 $IDKhuVuc=is_array($mangtinh)?$mangtinh["ID"]:$mangtinh;
							$phuong=is_array($mangphuong)?$mangphuong["ID"]:$mangphuong;
							$arrtam=array(
							'name'=>$arrmanv["tenkh"],
							'makh'=>replacesdt($r['T20']),
							'address'=>$mangdiachi,
							'type'=>0,
							'tel'=>replacesdt($r['T20']),
							'ngaysinh'=>"0000-00-00",
							  'IDKhuVuc'=>$IDKhuVuc,
							'quan'=>$quan,
							'phuong'=>$phuong,
							
							);
							$mangkh=insertKh($arrtam);
						}	
                    }
					$mangteam=array('idkho'=>1105,"lydo"=>53,"idchol"=>'');
					
					
                      $idkho=1; 
						if (strlen($sp)== '1' ) $sps = "00".$sp ;
					   if (strlen($sp)== '2' ) $sps = "0".$sp ;
					  if (strlen($sp)>2) $sps =$sp ;
					   $sct ="B".$nam.$thang. "TD.".$idkho.".".$sps;
					 
					 $sp++;
					 $maghichudh=$r[5]?$r[5]:$r[0];
					$arr=array(
						"idkho"=>(int)($mangteam['idkho']),
						"idkhach"=>$mangkh['ID'],
						"ngayxuat"=>$ngaytao,
						"lydoxuat"=>$mangteam['lydo'],
						"tigia"=>'',
						"vat"=>'',
						"ghichu"=>$maghichudh." ".$mangkh['makh']." ".$mangkh['name']." ".$mangkh['name']." ".$r[19],
						"ngaytao"=>$ngaytao,
						"ngaynhap"=>$ngaynhap,
						"idk"=>'',
						"makm"=>"",
						"name"=>$mangkh['name'],
						"address"=>$mangkh['address'],
						"tenlydo"=>'',
						"idban"=>'',
						"nguoitao"=>"",
						"tientra"=>"",
						"sct"=>$sct,
						"idchol"=>$mangteam['idchol'],
					);
				
					$dong='';
					if(checkPhieuNhapxuat1($r[0])){
						$dong= insertPhieunhapxuat($arr);
					}
					else{
						echo 'Dòng'.$success.'! Dữ liệu đã tồn tại!';
					}
					
					//var_dump($dong);
					if($dong){
						 $sql="select Name,ID,price,giabinhquan,codepro,IDGroup,code from products where codepro ='$r[18]' limit 1";
                    	$dongsp=getdong($sql);
					
						$IDPhieu=$dong['ID'];
						 $MaNV=$dong['diachiN'];
						$IDNhaCC= $dong['IDNhaCC'];
						 $idkho= $dong['IDKho'];
						  $tongtienmua=0;
							$arr1=array(
								"IDPhieu"=>$IDPhieu,
								"IDSP"=>$dongsp['ID'],
								"mahang"=>$dongsp['codepro'],
								"tenpt"=>$dongsp['Name'],
								"SoLuong"=>$r[25],
								"DonGia"=>$r[24],
								"LoaiTien"=>'',
								"chietkhau"=>'',
								"Loai"=>'',
								"giavon"=>$dongsp['giabinhquan'],
								"idnhom"=>$dongsp['IDGroup'],
								"idtao"=>'',
								"idnv"=>'',
								"idban"=>'',
							);
								//var_dump($arr1);
							if(insertXuatbanhang($arr1)){
									
								$arrtsp=array(
								'x'=>$r[25],
								'key'=>$dong['ID'],
								'IDKho'=>$idkho,
								);
								 trusanpham($arrtsp);
							
							$tongtienmua+=sotiendamua($sct);			
							congdiem($tongtienmua,$IDNhaCC);
							 $arrv=array(
                                    "IDbill"=>$IDPhieu,
                                   "sobill"=>$sct,
                                    "madh"=>$r[0],
                                    "Fbpage"=>"",
                                    "mavd"=>$r[5],
                                    "madoitac"=>"",
                                    "donvivc"=>'',
                                    "phitravc"=>$r[36],
                                    "phithukh"=>$r[37],
                                    "nvxuly"=>"",
                                    "nvcskh"=>"",
                                    "nvxacnhan"=>"",
									"nvgui"=>"",
									"dtkh"=>$mangkh['tel'],
									"nvtaodon"=>'',
									"ngaytaodon"=>$ngaytao,
									"nguondon"=>"",
									"togtien"=>$r[40],
									"tinh"=>$r[51],
									"quan"=>$r[52],
									"phuong"=>$r[53],
									"diachi"=>$r[54],
									"giamgia"=>"",
									"trigiadon"=>$r[27],
									"cacmasanpham"=>$r[18],
									"khohang"=>'',
									"diachikho"=>'',
									"dongthoigiantrangthaidon"=>'',
									"tinnhantaodon"=>'',
									"ngaydaydon_dvvc"=>'',
									"chuyenkhoan"=>'',
                                 );
						//echo "bảng vận chuyển <br>";
									 if(!insertVanchuyenonline($arrv)){
											echo 'Lỗi thêm vào dữ liệu bảng vận chuyển online dòng'.($success+1);
											xoaPhieunhap($IDPhieu);
											xoaxuatbanhang($IDPhieu);
										return;
									}
									$success++;	
								}else{
									xoaxuatbanhang($IDPhieu);
									xoaPhieunhap($IDPhieu);
							}
							
						}
						else{
							$fail++;
							echo 'lỗi Dòng '.$check.'!';	
						}
						
					}
					
                 }
			
}

	echo $loi;

echo "<span style='color:green'>Thêm thành công ".$success." dòng</span>
<span style='color:red'>Thất bại ".$fail." dòng</span>";
$data->closedata() ;
	//in($sheets); return;
	return;
?>
<?php 	 

 

function tachmanv($chuoi){
	$arr=explode("-",$chuoi);
	$tenkh=$arr[0];
	$voucher=$arr[1];
	$manv=$arr[2];
	$mach=$arr[3];
	$tam='';
	
	return array("tenkh"=>$tenkh,"manv"=>$manv,"voucher"=>$voucher,"mach"=>$mach);
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
	$arr=explode(",",$chuoi);
	return $arr[0];
	/*global $data;
	$sql="select * from quan where CONCAT(loai,' ',Name) like '%$chuoi%'";

	$query =$data->query($sql);
	$num_row=$data->num_rows($query);
	if($num_row==0){
		return;
	
	}
	else{
		return getdong($sql);
	}*/
	

}


function checkphuong($chuoi){
	$chuoi=addslashes($chuoi);
	global $data;
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
function insertKh($arr){
global $data;
	 $ngay = gmdate('Y-n-d H:i:s', time() + 7*3600) ;
 
	$name=addslashes($arr["name"]);
	$makh=$arr["makh"];
	$address=addslashes($arr["address"]);
	$type=$arr["type"];
	$tel=$arr["tel"];
	$ngaysinh=$arr["ngaysinh"];
	$IDKhuVuc=addslashes($arr["IDKhuVuc"]);
	$quan=addslashes($arr["quan"]);
	$phuong=addslashes($arr["phuong"]);
	$sql="insert into customer (Name,makh,address,type,tel,ngaytao,ngaysinh,IDKhuVuc,quan,phuong,nhomkh,idcuahang)
	 values('$name','$makh','$address','$type','$tel','$ngay','$ngaysinh','$IDKhuVuc','$quan','$phuong',8,1105)";
	 
	 $update=$data->query($sql);
	 	$sql="select * from customer where makh='$tel' and tel='$tel'";
		$dong=getdong($sql);
	 	return $dong;
	 
	 
}

function checkTeam($team){
global $data;
	//if(!$team) return;
	$sql="select ID,ma from lydonhapxuat where ma='$team'";
	$dong=getdong($sql);
	$result='';
	if($dong['ma']){
		$result=array("idkho"=>1105,"lydo"=>$dong['ID'],'idchol'=>'');
	}
	else{
		
		return false;
	}
	return $result;
}

function checkCuahang($team){
global $data;
	//if(!$team) return;
	$sql="select ID,macuahang from cuahang where macuahang ='$team'";
		
		$query =$data->query($sql);
		$dong=getdong($sql);
		$result='';
		if($dong['ID']){
			
			$result=array('idkho'=>1105,"lydo"=>5,"idchol"=>$dong["ID"]);
		}
		else{
			return;
		}
		
		return $result;
}

function checkPhieuNhapxuat($ngay,$IDNnhaCC,$name,$ghichu){
global $data;
	$sql="select ID from phieunhapxuat where NgayNhap ='$ngay' and IDNhaCC ='$IDNnhaCC'  and ten ='$name'  and GhiChu ='$ghichu'";
	
		$query =$data->query($sql);
		$numrow=$data->num_rows($query);
		//	echo $sql ."<br>";
		if($numrow==0){
			
			return true;
		}
		
		return false;
}

function checkPhieuNhapxuat1($madh){
global $data;
	//if(!$madh)return;
	$sql="select ID from vanchuyenonline where madh ='$madh'";
	
		$query =$data->query($sql);
		$numrow=$data->num_rows($query);
			
		if($numrow==0){
			
			return true;
		}
		
		return false;
}
function insertPhieunhapxuat($arr){
global $data;
$idnguoitao =$_SESSION["LoginID"] ;

$tennguoitao = $_SESSION["TenUser"];
$sochungtu=$arr['sct'];
	$idkho=$arr['idkho'];
	
	$idkhach=$arr['idkhach']?$arr['idkhach']:"8";
	$id=$arr['IDNhap'];
	$ngaynhap=$arr['ngaynhap'];
	$lydoxuat=$arr['lydoxuat'];
	$tigia=laso($arr['tigia']);
	$ghichu=addslashes($arr['ghichu']);
	//if(!$idkho) return;
	//if(!$idkhach)return;
	//if(!$id) return $id;
	//if(!$ngaynhap) return; 
	//if(!$lydoxuat) return; 
	//if(!$tigia)$tigia=0; 
	//if(!$ghichu) return; 
	//if(!$idnguoitao) return;  
	$ngayxuat=$arr['ngayxuat'];
	$tigia=laso($arr['tigia']);
	$vat=laso($arr['vat']);
	$ngaytao=$arr['ngaytao'];
	$idk=$arr['idk'];
	$makm=$arr['makm'];
	$name=addslashes($arr['name']);
	$address=addslashes($arr['address']);
	$tenlydo=$arr['tenlydo'];
	$idban=$arr['idban'];
	$nguoitao=$tennguoitao.'-'.$idnguoitao;
	$tientra=laso($arr['tientra']);
	$idchol=$arr['idchol'];
	$sql = "insert into phieunhapxuat set Loai='1' ,IDKho ='$idkho',IDNhaCC ='$idkhach' ,IDNhap ='$id' ,NgayNhap ='$ngaynhap' ,SoCT='$sochungtu' ,LyDo='$lydoxuat' ,SoNgayNo='0' ,IDTKNo='0' ,IDTKCo='0' ,TiGia ='$tigia' ,VAT='$vat' ,GhiChu='$ghichu' ,NgayTao='$ngaytao',ngaykhoa='$ngaytao' ,IDTao='$idnguoitao' ,NguoiGiao='$makm' ,dakhoa=1,dahuy=0,ten='$name',diachi='$address', tenlydo='$tenlydo'   ,diachiN='$idban' ,nguoitao='$nguoitao',IDKhoa='$idnguoitao',tientra='$tientra',idchOL='$idchol'";

	if($data->query($sql)){
	 	$sql="select * from phieunhapxuat where SoCT='$sochungtu'";
		$dong=getdong($sql);
	 	return $dong;
	}
	else{
	
		return;
	}
}

/*function checkPhieunhapxuat($sct){
global $data;
	$sql="select SoCT from phieunhapxuat where SoCT='$sct'";
	
	$dong=getdong($sql);
	
	if($dong['SoCT']){
		return true;
	}
	else{
		
		return false;
	}
}*/

function insertXuatbanhang($arr){

		
	global $data;
	$IDPhieu=$arr['IDPhieu'];
	$IDSP=$arr['IDSP'];
	$SoLuong=laso($arr['SoLuong']);
	if(!$IDSP) return;
	if(!$SoLuong || $SoLuong==0 || $SoLuong>100)return;
	$mahang=$arr['mahang'];
	$code=$arr['code'];
	$tenpt=$arr['tenpt'];
	$DonGia=laso($arr['DonGia']);
	$LoaiTien=$arr['LoaiTien'];
	$chietkhau=$arr['chietkhau'];
	$Loai=$arr['Loai'];
	$giavon=laso($arr['giavon']);
	$idnhom=$arr['idnhom'];
	$idtao=$arr['idtao'];
	$idnv=$arr['idnv'];
	$giamgiasp=$arr['giamgiasp'];
	$Thue=$arr['thue']?$arr['thue']:0;
	$chietkhau=$chietkhau/$SoLuong;
	/*if((int)($DonGia)>0){
		$chietkhau=($giamgiasp/$DonGia)*100;
	}
	else{
		$chietkhau=0;
	}*/
	//$chietkhau=($giamgiasp/($DonGia)*100;
	//var_dump($chietkhau/2);
	
	 $sql="INSERT INTO xuatbanhang (IDPhieu,IDSP,mahang,tenpt,SoLuong,DonGia,LoaiTien,Thue,BaoHanh,Ghichu,chietkhau,Loai,giavon,IDnhom,IDTao,IDNV,mota) VALUES('$IDPhieu','$IDSP','$mahang','$tenpt','$SoLuong','$DonGia','$LoaiTien','$Thue','$BaoHanh','$Ghichu',$chietkhau,'$Loai','$giavon','$idnhom','$idtao','$idnv','$code')";
		
	 $update=$data->query($sql);
	 	
	 	if($update){
			return true;
		}
		else{
			//echo $sql;
			return false;
		}
}

function xoaPhieunhap($idphieu){
global $data;
	$sql='delete from phieunhapxuat where ID='.$idphieu;
	
	 $update=$data->query($sql);
	 	
	 	return $update;
}
function xoaxuatbanhang($idphieu){
	global $data;
	$sql='delete from xuatbanhang where IDPhieu='.$idphieu;
	 $update=$data->query($sql);
	 	
	 	return $update;
}

function xoavanchuyen($idphieu){
	global $data;
	$sql='delete from vanchuyenonline where IDbill='.$idphieu;
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
	$nvxacnhan=$r['T16'];
	$nvgui=$arr['nvgui'];
	$dtkh=$arr['dtkh'];
	$vtaodon=$arr['vtaodon'];
	$ngaytaodon=$arr['ngaytaodon'];
	$nguondon=$arr['nguondon'];
	$togtien=$arr['togtien'];
	$tinh=addslashes($arr['tinh']);
	$quan=addslashes($arr['quan']);
	$phuong=addslashes($arr['phuong']);
	$diachi=addslashes($arr['diachi']);
	$giamgia=$arr['giamgia'];
	$trigiadon=$arr['trigiadon'];
	$cacmasanpham=$arr['cacmasanpham'];
	$khohang=$arr['khohang'];
	$diachikho=$arr['diachikho'];
	$dongthoigiantrangthaidon=$arr['dongthoigiantrangthaidon'];
	$tinnhantaodon=$arr['tinnhantaodon'];
	$ngaydaydon_dvvc=$arr['ngaydaydon_dvvc'];
	$chuyenkhoan=$arr['chuyenkhoan'];

	 $sql="INSERT INTO vanchuyenonline (IDbill,sobill,madh,Fbpage,mavd,madoitac,donvivc,phitravc,phithukh,nvxuly,nvcskh,giamgia,trigiadon,cacmasp,khohang,diachikho,dongthoigiantrangthaidon,tinnhantaodon,ngaydaydon_dvvc,chuyenkhoan,dienthoai_kh,diachi,tinh,quan,phuong,tongtien)  
	 VALUES('$IDbill','$sobill','$madh','$Fbpage','$mavd','$madoitac','$donvivc','$phitravc','$phithukh','$nvxuly','$nvcskh','$giamgia','$trigiadon','$cacmasanpham','$khohang','$diachikho','$dongthoigiantrangthaidon','$tinnhantaodon','$ngaydaydon_dvvc','$chuyenkhoan','$dtkh','$diachi','$tinh','$quan','$phuong','$togtien')";
	
	 $update=$data->query($sql);
	 	if($update){
			return true;
		}
		else{
			//echo $sql;
			return false;
		}
}
function updatephieukhuyenmai($arr){
global $data;
	$maso=$arr["maso"];
	$sotiendk=$arr["sotiendk"];
	$ngaydung=$arr["ngaydung"];
	$idkhoa=$arr["idkhoa"];
	$iddung=$arr["iddung"];
	$sophieu=$arr["sophieu"];
	$cuahang=$arr["cuahang"];
	$sql="update phieukhuyenmai set ngaydung ='$ngaydung',idkhoa='$idkhoa',iddung='$iddung',sophieu='$sophieu',cuahang='$cuahang' where maso = '$maso'";
	
	 	$update=$data->query($sql);
	 	if($update){
			return true;
		}
		else{
			//echo $sql;
			return false;
		}
	//$sql="update   phieukhuyenmai set sotiendk='$tam3[tong]',ngaydung ='$ngaykhoa',idkhoa='$idk',iddung='$tam[IDNhaCC]',sophieu='$tam[SoCT]',cuahang='$tam[IDKho]' where maso = '$tam[nguoigiao]'";
	
}
function GetsoCT(){
	global $data;
	$idkho=1;
 		$thang = gmdate('m', time() + 7*3600);  
		$nam = gmdate('y', time() + 7*3600);  
		   $so = $idkho+ 10;
		   $sosanh= $nam.$thang."TD";
		   $sql = "select max(convert( mid(SoCT,11,22),UNSIGNED INTEGER)) as sp from phieunhapxuat where mid(SoCT,2,6) ='$sosanh' " ;
		   //$query=$data->query($sql);
		   //  echo $sql ;
 		   $kq = getdong($sql);		
		   $sp = $kq['sp'] +1;
		  
		return $sp ;
}

function sotiendamua($soct){
global $data;
	
		$sql = " select sum(b.SoLuong*(b.DonGia-(b.chietkhau*b.DonGia/100))) as tong   
from phieunhapxuat a left join  xuatbanhang b on a.ID=b.IDPhieu where 1=1 and a.SoCT='$soct' group by a.SoCT" ;
 	$tam3 = getdong($sql) ;
	$tong=$tam3['tong'];
	return $tong;
}
function congdiem($tong,$IDNhaCC){
global $data;
 			 $sql = " update customer set sotiendamua = sotiendamua + ".$tong. ", diemtichluy= diemtichluy + ". ($tong / 10000)." ,ngaycapnhap='$ngaytao' where ID = '$IDNhaCC'  " ;
 	          $update=$data->query($sql);
			  return $update;
}
 
 
function trusanpham($arr){
global $data;
	$x=$arr['x'];
	$key=$arr['key'];
	$IDKho=$arr['IDKho'];
 	$sql="update hanghoacuahang set SoLuong = SoLuong - $x  where IDSP = $key  and IDcuahang =  $IDKho";
 	
 	$update=$data->query($sql);
 	return $update;
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
 
function replacesdt($sdt){
	$result='';
	
	if($sdt[0]=="+"){
		$result=substr($sdt,3);
		$result='0'.$result;
	}
	else if($sdt[0]==8 && $sdt[1]==4){
		$result=substr($sdt,2);
		$result='0'.$result;
	}
	else{
		 $result=$sdt;
	}	
	
	return $result;
}
?>