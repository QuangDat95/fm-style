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

if(isset($_POST["TAOVANDON"])){
	$data1 = $_POST['TAOVANDON']; 
    $tmp = explode('*@!',$data1); 
	$id = laso($tmp[0]) ;
	$tienship = laso($tmp[1]) ;
	if(!$tienship){
			 echo  "###8###Vui lòng nhập phí ship!###-1###";
				return;
		}
	$sql="select a.*,b.* from phieunhapxuat a left join xuatbanhang b on a.ID=b.IDPhieu  where a.ID=(select IDbill from vanchuyenpassdon where ID=$id)";
	$query =$data->query($sql);
	$numrow=$data->num_rows($query);
	
	$i=0;
	$oder=[];
	$idbill='';
	$products=[];
		$mangtpTrunguong=array("SG","DDN","HN","HP","CT");
		 $tongtien=0;
	while($r=$data->fetch_array($query)){
	
		
		
	$tam=[];
		if($i==0){
			if(!checkDiachiDaydu(1,$r['IDNhaCC'])){
				echo  "###4###Không thể khóa phiếu này do địa chỉ khách hàng không đầy đủ!###$id###$tench###$idcuahang###-1###" ;
					return;
			}
			if(!checkDiachiDaydu(2,$r["IDKho"])){
			$tench=getten("cuahang",$value,"Name");
				echo  "###4###Không thể khóa phiếu này do địa chỉ cửa hàng $tench không đầy đủ!###$id###$tench###$idcuahang###-1###" ;
					return;
			}
		
			$sobill=$r["SoCT"];
			$oder["id"]=$r["SoCT"];
			//địa chỉ của hàng
				$diachich=getdiachiCH($r["IDKho"]);
				
			$oder["pick_name"]=$diachich["Name"];
			
			$oder["pick_address"]=$diachich["address"];
			if(in_array($diachich["matinh"],$mangtpTrunguong)){
					
				$oder['pick_province']="TP. ".$diachich["tinh"];
			}
			else{
				$oder['pick_province']="Tỉnh ".$diachich["tinh"];
			}
			//$oder["pick_province"]=$diachich["tinh"];
			$oder["pick_district"]=$diachich["quan"];
			$oder["pick_ward"]==$diachich["phuong"];
			$oder["pick_tel"]=$diachich["tel"];
			//dia chỉ kh
			$diachikh=getdiachiKH($r['IDNhaCC']);
			$oder["tel"]=$diachikh["tel"];
			$oder["name"]=$diachikh["Name"];
			$oder["address"]=$diachikh["address"];
			if(in_array($diachikh["matinh"],$mangtpTrunguong)){
				$oder['province']="TP. ".$diachikh["tinh"];
			}
			else{
				$oder['province']="Tỉnh ".$diachikh["tinh"];
			}
			
			$oder['district']=$diachikh["quan"];
			$oder['ward']=$diachikh["phuong"];
			
			$oder["hamlet"]='khác';
			$oder["is_freeship"]='1';
		
			$oder["note"]='pass đơn';
			
			
			//products
			$tam['name']=$r['tenpt'];
			$tam['weight']=0.5;
			$tam['quantity']=$r['SoLuong'];
			$tam['product_code']=$r['mahang'];
			 $x=$r['SoLuong'];
			 $idsp=$r['IDSP'];
			 $tongtien+=($r['DonGia']*$x);
			array_push($products,$tam);
			
		}
		else{
			$tam['name']=$r['tenpt'];
			$tam['weight']=0.5;
			$tam['quantity']=$r['SoLuong'];
			$tam['product_code']=$r['mahang'];
			 $x=$r['SoLuong'];
			 $idsp=$r['IDSP'];
			 $tongtien+=($r['DonGia']*$x);
			 array_push($products,$tam);
		}
		
		if($i==($numrow-1)){
			$oder["value"]=$tongtien;
			$oder["pick_money"]=$tongtien;
		}
		$i++;
	}
	$mangvandon['products']=$products;
	$mangvandon['order']=$oder;
	
	$mavd=getmavandon(json_encode($mangvandon));
	if($mavd){
	
		$sql="update vanchuyenpassdon set mavd='$mavd',phiship='$tienship' where ID='$id'";
		$update= $data->query($sql);
		if($update){
			$sql="update vanchuyenonline set mavd='$mavd' where sobill='$sobill'";
			$update= $data->query($sql);
			if($update){
				echo  "###8###Đã tạo mã vận đơn!###$id###$mavd###" ;
			}
			else{
				 echo  "###8###Có lỗi xảy ra vui lòng thử lại!###-1###";
			}
		}else{
				 echo  "###8###Có lỗi xảy ra vui lòng thử lại!###-1###";
			}
	}
	else{
				 echo  "###8###Có lỗi xảy ra Không thể tạo mã vận đơn!###-1###";
			}
	return;
	
}


//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
if(isset($_POST["huydon"])){
$lydo=chonghack($_POST["lydo"]);
$id=laso($_POST["idpass"]);
$soct=chonghack($_POST["soctpass"]);
$loai=laso($_POST["loaipass"]);
if(!$lydo){

	echo "###-1###Vui lòng nhập lý do####";
	return;
	
}
if(!$id){

	echo "###-1###có lỗi xảy ra vui lòng thử lại!####";
	return;
	
}
if(!isset($_FILES["hinh"]) || isset($_FILES["hinh"])==''){
			
				echo "###-1###Vui lòng chọn hình ảnh!####";
				return;
	}

$uploadDirectoryimages="images/passdonhuy";
if (!is_dir($uploadDirectoryimages))
{

	 mkdir($uploadDirectoryimages, 0777, true);
}


 			if(isset($_FILES["hinh"]))
            {
				foreach ($_FILES["hinh"]["tmp_name"] as $key => $value) 
				{	
					
                    $tmp_name = $_FILES["hinh"]["tmp_name"][$key];
					if($_FILES["hinh"]["name"][$key]){
					
							$hinh=so_ngau_nhien()."_".rand()."_".$_FILES["hinh"]["name"][$key];
						 
						}
                    $mtype= array("image/jpeg","image/pjpeg","image/png","image/x-png",'image/gif','application/x-shockwave-flash');  
                    $type=$_FILES["hinh"]["type"][$key];		
                        if( in_array($type,$mtype) )
                        { 
                            $kt=true;
                            
                        }
                        if ($kt==true) {
                           if(move_uploaded_file($tmp_name,  $uploadDirectoryimages.'/'.$hinh)){
						   			 $chuoihinh.='*'.$hinh;
						   }
                        }
                }
                                    
            }
		
		 $ngaytao=date('Y-m-d H:i:s') ;	
	$sql="update passdon set tinhtrang=3,lydohuy='$lydo',ngayhuy='$ngaytao',images='$chuoihinh' where ID='$id'";
	
	$update=$data->query($sql);
	if($update){
			echo "###1###Đã hủy đơn!####$id####";
			return;
	}
	else{
		echo "###-1###có lỗi xảy ra vui lòng thử lại!####";
	return;
	}		
return;	
}
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
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
	 $sql="select mavd from vanchuyenpassdon where ID='$id'";
	echo $sql."<br>";
	 $dong=getdong($sql);
	 $mavd=$dong["mavd"];
	 echo $mavd."<br>";
		$huyvandon=huymavandon($mavd);
	 //$huyvandon["success"]=true;
	 if($huyvandon["success"]){
	 	
	
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
		 }
		 else{
		 	 echo  "###8###Có lỗi xảy ra vui lòng thử lại!###-1###";
		 }
			// insert vanchuyenpassdon
		
			return;
 	 }
     $data->closedata() ;
	 

function taophieuhuy($id,$soct){
global $data;

$ngay=date('Y-m-d H:i:s') ;
	$sql="Insert into phieunhapxuat(IDkho,IDNhaCC,IDNhap,NgayNhap,SoCT,LyDo,SoNgayNo,IDTKNo,IDTKCo,TiGia,VAT,GhiChu,NgayTao,IDTao,NguoiGiao,Loai,ten,diachi,tenkho,tenlydo,tenN,diachiN,dakhoa,nguoitao,nguoisua,ngaykhoa,dahuy,IDkhoa,tientra,idchOL,idgioithieu)
select IDkho,IDNhaCC,IDNhap,NgayNhap,'$soct',LyDo,SoNgayNo,IDTKNo,IDTKCo,TiGia,VAT,GhiChu,'$ngay',IDTao,NguoiGiao,3,ten,diachi,tenkho,tenlydo,tenN,diachiN,dakhoa,nguoitao,nguoisua,ngaykhoa,dahuy,IDkhoa,tientra,idchOL,idgioithieu from phieunhapxuat where ID='$id'";
echo $sql;
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


function huymavandon($mavd){
    $curl = curl_init();

    curl_setopt_array($curl, array(
         CURLOPT_URL =>"https://services.giaohangtietkiem.vn/services/shipment/cancel/".$mavd,
       // CURLOPT_URL => "https://services.ghtklab.com/services/shipment/cancel/".$mavd,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_HTTPHEADER => array(
           "Token: 187c69cA1c3d49fE1B43573b335d67a7481e7181",
        ),
    ));

    $response = curl_exec($curl);
    curl_close($curl);

    return json_decode($response,true);
}



function getmavandon($order){

	// test code: test.1084.459, test.1084.460, test.1084.461

//HTTP_BODY;

$curl = curl_init();

curl_setopt_array($curl, array(
   CURLOPT_URL => "https://services.giaohangtietkiem.vn/services/shipment/order",
//CURLOPT_URL => "https://services.ghtklab.com/services/shipment/order",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS =>$order,
    CURLOPT_HTTPHEADER => array(
        "Content-Type: application/json",
        "Token: 187c69cA1c3d49fE1B43573b335d67a7481e7181",
        "Content-Length: " . strlen($order),
    ),
));

$response = curl_exec($curl);
curl_close($curl);

$arr = json_decode($response,true);
return $arr["order"]["label"];
/*//echo 'Response: ' . $response;
if (isset($arr["error"])) {
echo "<B>THÔNG BÁO</B>: Mã đơn vận: <B>".$arr["error"]["ghtk_label"]."</B> ===> Lỗi ===> ".$arr["message"];
}

if ($arr["success"] == 1) {
echo "Mã vận đơn được tạo: <B>".$arr["order"]["label"]."</B>";
}*/
}

function getdiachiKH($id){
	
	$sql="select a.Name,a.tel,a.address,b.ma as matinh,b.Name as tinh,CONCAT(c.loai,' ',c.Name) as quan,CONCAT(d.loai,' ',d.Name) as phuong from customer a left join tinh b on a.IDKhuVuc=b.ID left join quan c on a.quan=c.ID left join phuong d on a.phuong=d.ID where a.ID='$id'";
	$dong=getdong($sql);
	return $dong;
}
function getdiachiCH($id){
	$sql="select a.Name,a.tel,a.address,b.ma as matinh,b.Name as tinh,CONCAT(c.loai,' ',c.Name) as quan,CONCAT(d.loai,' ',d.Name) as phuong from cuahang a left join tinh b on a.Fax=b.ID left join quan c on a.quan=c.ID left join phuong d on a.phuong=d.ID where a.ID='$id'";
	$dong=getdong($sql);
	return $dong;
}
function dateDiffMi($ngay1,$ngay2){

$to_time = strtotime($ngay1);
$from_time = strtotime($ngay2);
return round(abs($to_time - $from_time) / 60,2);
}

function checkDiachiDaydu($loai,$id){

	if($loai==1){
		$sql="select IDKhuVuc,quan,phuong from customer where id='$id'";
		$dong=getdong($sql);
		
		if(!$dong["IDKhuVuc"] || !$dong["quan"] || !$dong["phuong"]){
			return false;
		}
	}
	else if($loai==2){
		$sql="select Fax,quan,phuong from cuahang where ID='$id'";
		$dong=getdong($sql);
	
		if(!$dong["Fax"] || !$dong["quan"] || !$dong["phuong"]){
			return false;
		}
	}
	return true;
}

function getCHvaKH($loai,$id){
	global $data;
	if($loai==1){

		$sql="select cuahangnhan,IDNhaCC from passdon where ID='$id'";
		$dong=getdong($sql);
		
		return $dong;
	}else if($loai==2){
		$sql="select IDNhaCC from passdon where ID='$id'";
		$dong=getdong($sql);
	
		$kh=$dong["IDNhaCC"];
		$ch=[];
		$sql="select IDchnhan from passdonchitiet where IDPhieu='$id'";
			$query=$data->query($sql);
			while($re=$data->fetch_array($query)){
				array_push($ch,$re["IDchnhan"]);
			}
		return array("kh"=>$kh,"ch"=>$ch);
	}	
}
?>