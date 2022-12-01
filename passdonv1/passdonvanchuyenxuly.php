<?php  
session_start();
$idk = $_SESSION["LoginID"] ; if (  $idk == '') return ;
$root_path =getcwd()."/"  ;
include($root_path."biensession.php");
include($root_path."includes/config.php");
include($root_path."includes/removeUnicode.php");
include($root_path."includes/class.paging.php");
include($root_path."includes/class.mysql.php"); 
include($root_path."includes/function.php");
include($root_path."includes/function_local.php");
  $idcuahang=$_SESSION["se_kho"];
  
$data = new class_mysql();
$data->config();
$data->access();

    $data1 = $_POST['DATA']; 
    $tmp = explode('*@!',$data1);  
 	$id = laso($tmp[0]) ;
	$lydo = chonghack($tmp[3]);
	$loai = laso($tmp[1]) ;
/*	$tench=getten("cuahang",$idcuahang,"Name");
	 
	 
	$loainhan = chonghack($tmp[4]) ;
	$idchitietpass = chonghack($tmp[2]);
	$idchitietpass =explode("*",$idchitietpass);
	$idchitietpasshuy = chonghack($tmp[5]);
	$idchitietpasshuy =explode("*",$idchitietpasshuy);*/
	$ngay=date('Y-m-d H:i:s') ;
  
     if($loai==8) 
	 {
	 
	 	if(!$lydo){
			echo  "###8###Vui lòng nhập lý do!###-1###";
				return;
		}
	 	
		$sql="update vanchuyenpassdon set tinhtrang=3,ngayhuy='$ngay',lydohuy='$lydo' where ID='$id'";	
		$update= $data->query($sql);
		if($update){
			 $NgayTao = gmdate('Y-m-d', time() + 7*3600) ;
			 $thongtin=getthongtinhuy($id);
			 $idbill= $thongtin["thongtinvc"]["IDbill"];
			 $idpassdon= $thongtin["thongtinvc"]["IDpassdon"];
			 $IDcuahang= $thongtin["thongtinpassdon"][$idbill][0];
			  $soctbill= $thongtin["thongtinpassdon"][$idbill][1];
			  $soctbill=$soctbill.'TL';
			 $xuatbanhang= $thongtin["thongtinpassdon"][$idbill][2];
			 
			
			
			 $update=taophieuhuy($idbill,$soctbill);
			 if($update){
			 	foreach($xuatbanhang as $key => $value){
					
					$sql="update hanghoacuahang  set SoLuong=SoLuong+$value[SoLuong] where IDcuahang='$IDcuahang=' and IDSP='$value[IDSP]'";
					$update= $data->query($sql);
				}
				$sql="update passdon  set tinhtrang=3,ngayhuy='$ngay',lydohuy='$lydo' where ID='$idpassdon'";
				$update= $data->query($sql);
				if($update)
				{
					 echo  "###8###Đã hủy phiếu!###$id###" ;
				 }
			 }
			 
				
		}
		else{
			 echo  "###8###Có lỗi xảy ra vui lòng thử lại!###-1###";
		}	
		
			// insert vanchuyenpassdon
		
		
 	 }
     $data->closedata() ;
	 

function taophieuhuy($id,$soct){
global $data;

$ngay=date('Y-m-d H:i:s') ;
	$sql="Insert into phieunhapxuat(IDkho,IDNhaCC,IDNhap,NgayNhap,SoCT,LyDo,SoNgayNo,IDTKNo,IDTKCo,TiGia,VAT,GhiChu,NgayTao,IDTao,NguoiGiao,Loai,ten,diachi,tenkho,tenlydo,tenN,diachiN,dakhoa,nguoitao,nguoisua,ngaykhoa,dahuy,IDkhoa,tientra,idchOL,idgioithieu)
select IDkho,IDNhaCC,IDNhap,NgayNhap,'$soct',LyDo,SoNgayNo,IDTKNo,IDTKCo,TiGia,VAT,GhiChu,'$ngay',IDTao,NguoiGiao,3,ten,diachi,tenkho,tenlydo,tenN,diachiN,dakhoa,nguoitao,nguoisua,ngaykhoa,dahuy,IDkhoa,tientra,idchOL,idgioithieu from phieunhapxuat where ID='$id'";

$update= $data->query($sql);
/*$SoCT=getten("phieunhapxuat",$id,"SoCT");
$soct=$SoCT.'TL';*/
$sql="select ID from phieunhapxuat where SoCT='$soct'";
$dong=getdong($sql);
$idbillmoi=$dong['ID'];
		$sql="select * from xuatbanhang where IDPhieu='$id'";
				 $query= $data->query($sql);
				 $insert='';
				
				while($re=$data->fetch_array($query)){
						$insert.="('".$idbillmoi."','".$re['IDSP']."','".$re['mahang']."','-".$re['SoLuong']."','".$re['DonGia']."','".$re['LoaiTien']."','".$re['tenpt']."','".$re['thue']."','".$re['BaoHanh']."','".$re['GhiChu']."','".$re['Loai']."','".$re['giavon']."','".$NgayTao."','".$re['IDtao']."','".$re['IDnhom']."','".$re['IDNV']."','".$re['chietkhau']."','".$re['mota']."'),";
				}
				
			 $insert=rtrim($insert,",");
			 
	 		$sql="insert into xuatbanhang(IDPhieu,IDSP,mahang,SoLuong,DonGia,LoaiTien,tenpt,Thue,BaoHanh,GhiChu,Loai,giavon,ngaytao,IDtao,IDnhom,IDNV,Chietkhau,mota) values  $insert";
			
			
			$update= $data->query($sql);
	return $update;
}
function getthongtinpassdon($idbill){
	global $data;
	$mangtam=[];
		 $sql = "select ID,IDKho,SoCT from phieunhapxuat a where a.ID='$idbill'";
		 $dong =getdong($sql);
		
		 $sql = "select * from xuatbanhang a where a.IDphieu='$idbill'";
		 $query= $data->query($sql);
		$tam=[];
		while($re=$data->fetch_array($query)){
			array_push($tam,$re);
		}
		 $mangtam[$dong["ID"]]=array($dong['IDKho'],$dong['SoCT'],$tam);
		 return $mangtam;
}

function getthongtinhuy($idvc)
{ 	
		$mangtam=[];
 		$sql = "select IDbill,IDpassdon,Sobill from vanchuyenpassdon a where a.ID='$idvc'";
		$dong =getdong($sql);
		$mangtam['thongtinvc']=$dong ;
		$mangtam['thongtinpassdon']=getthongtinpassdon($dong['IDbill']);
		return $mangtam;
}


?>