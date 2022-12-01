<?php
session_start();
$_SESSION["LoginID"]=1;$_SESSION["UserName"]='zalo';
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header("Access-Control-Allow-Headers: Content-Type, Authorization");
header('Content-Type: text/html; charset=utf-8');
//if ($_SESSION["LoginID"]=="") return ;
 
  
$root_path =getcwd()."/"  ;
include($root_path."../../biensession.php");
include($root_path."../../includes/config.php");
include($root_path."../../includes/removeUnicode.php");
include($root_path."../../includes/class.paging.php");
include($root_path."../../includes/class.mysql.php");
include($root_path."../../includes/function.php");
include($root_path."../../includes/function_local.php");
  
$data = new class_mysql();
$data->config();
$data->access();


 $json = file_get_contents('php://input');

 $json=json_decode($json,true);

//  echo json_encode(array("code"=>200,"data"=>$json));
/*
 $json = array(
    'IDkho' => '1004',
    'IDNhaCC' => '4587',
    'IDNhap' => '0',
    'SoCT' => '1004',
    'LyDo' => '1004',
    'SoNgayNo' => '2022-01-08',
    'IDTKNo' => '1004',
    'IDTKCo' => '1004',
    'TiGia' => '1004',
    'VAT' => '1004',
    'GhiChu' => '1004',
    'Loai' => '1004',
    'ten' => '1004',
    'diachi' => '1004',
    'tenkho' => '1004',
    'tenlydo' => '1004',
    'tenN' => '1004',
    'diachiN' => '1004',
    'dakhoa' => '1004',
    'nguoitao' => '1004',
    'nguoisua' => '1004',
    'ngaykhoa' => '2022-01-08',
    'dahuy' => '1004',
    'IDKhoa' => '1004',
    'tientra' => '1004',
    'idchOL' => '1004',
    'idgioithieu' => '1004',
    'tinhtrang' => '1004',
    'cuahangnhan' => '1004',
    'lydohuy' => '1004',
    'ngayhuy' => '1004',
    'nhanviennhan' => '1004',
    'NgayNhan' => '2022-01-08',
    'passdonchitiet' => array(
        array(
            "IDSP" =>" ",
            "mahang" => '',
            "SoLuong" =>'',
            "DonGia"=> '',
            "LoaiTien" => '',
            "tenpt" => '',
            "Thue" => "",
            "BaoHanh" => "",
            "GhiChu" => "",
            "Loai" => "",
            "giavon" => '',
            "ngaytao" => "",
            "IDTao" => "",
            "IDnhom" => "",
            "IDNV" => "",
            "chietkhau" => "",
            "mota" => "",
            "IDchnhan" => "",
            "idbill" => "",
            "IDnvnhan" => "",
            "NgayNhan" => "",
        )
    )
);*/
$update=insertPassdon($json);
if($update){
	$res= array("code"=>200,"message"=>"Thêm đơn thành công!");
}
else{

	$res=array("code"=>201,"message"=>"Thêm đơn thất bại! vui lòng thử lại!");
}

echo json_encode($res);
function insertPassdon($json){
    global $data;
    $IDkho = $json["IDkho"];
    $IDNhaCC = $json["IDNhaCC"];
    $IDNhap = $json["IDNhap"];
    // $SoCT = $json["SoCT"];
    $LyDo = $json["LyDo"];
    $SoNgayNo = $json["SoNgayNo"];
    $IDTKNo = $json["IDTKNo"];
    $IDTKCo = $json["IDTKCo"];
    $TiGia = $json["TiGia"];
    $VAT = $json["VAT"];
    $GhiChu = $json["GhiChu"];
    $Loai = $json["Loai"];
    $ten = $json["ten"];
    $diachi = $json["diachi"];
    $tenkho = $json["tenkho"];
    $tenlydo = $json["tenlydo"];
    $tenN = $json["tenN"];
    $diachiN = $json["diachiN"];
    $dakhoa = $json["dakhoa"];
    $nguoitao = $json["nguoitao"];
    $nguoisua = $json["nguoisua"];
    $ngaykhoa = $json["ngaykhoa"];
    $dahuy = $json["dahuy"];
    $IDKhoa = $json["IDKhoa"];
    $tientra = $json["tientra"];
    $idchOL = $json["idchOL"];
    $idgioithieu = $json["idgioithieu"];
    $tinhtrang = $json["tinhtrang"];
    $cuahangnhan = $json["cuahangnhan"];
    $lydohuy = $json["lydohuy"];
    $ngayhuy = $json["ngayhuy"];
    $nhanviennhan = $json["nhanviennhan"];
    $NgayNhan = $json["NgayNhan"];
	$user=$json["user"];
	$idkho=$user["IDcuahang"];
	$IDuser=$user["ID"];
	$tenuser=$user["Ten"];
	$s_manv=$user["MaNV"] = substr(trim($user["MaNV"]),strlen(trim($user["MaNV"])) -1,1);
	 if($idkho){
	date_default_timezone_set('Asia/Ho_Chi_Minh');
	$ngaytao=date('Y-m-d H:i:s') ;
    //=======================================================================================
    $thang = gmdate('m', time() + 7*3600); 
    $nam = gmdate('y', time() + 7*3600); 
   $so = strlen($idkho) + 9;
    $sql = "select max(convert(mid(SoCT,$so,22),UNSIGNED INTEGER))as sp from passdon  where loai ='1' and  IDKho='$idkho' and  mid(SoCT,4,2) = '$thang' " ;
     $kq = $data->truyvan($sql) ;		
    $sp = laso($kq['sp']) + 1 ;
    if (strlen($sp)== '1' ) $sp1 = "00";
    if (strlen($sp)== '2' ) $sp1 = "0";
    $sochungtu ="P".$nam.$thang.$s_manv.".".$idkho.".".$sp1.$sp ; 
    $sochungtu2 ="P".$nam.$thang.$s_manv.".".$idkho.".".$sp1.($sp+1) ; 
  
    $tam = getdong("select ID from passdon where SoCT ='$sochungtu' limit 1 ") ;

   if ($tam["ID"]  != ""  ) $sochungtu= $sochungtu2  ;
    $SoCT = $sochungtu;

    // chay insert passdon
    $sql1= "insert into passdon (IDkho,IDNhaCC,IDNhap,SoCT,LyDo,SoNgayNo,IDTKNo,IDTKCo,TiGia,VAT,GhiChu,Loai, ten, diachi, tenkho, tenlydo, tenN, diachiN, dakhoa, nguoitao, nguoisua, ngaykhoa, dahuy, IDKhoa, tientra, idchOL, idgioithieu, tinhtrang, cuahangnhan, lydohuy, ngayhuy, nhanviennhan, NgayNhan,NgayTao,IDTao) values ('$idkho', '$IDNhaCC', '$IDNhap', '$SoCT', '$LyDo', '$SoNgayNo', '$IDTKNo', '$IDTKCo', '$TiGia', '$VAT', '$GhiChu', '$Loai', '$ten', '$diachi', '$tenkho', '$tenlydo', '$tenN', '$diachiN', '$dakhoa', '$tenuser', '$nguoisua', '$ngaykhoa', '$dahuy', '$IDKhoa', '$tientra', '$idchOL', '$idgioithieu', '$tinhtrang', '$cuahangnhan', '$lydohuy', '$ngayhuy', '$nhanviennhan', '$NgayNhan','$ngaytao','$IDuser')";

	$update = $data->query($sql1);
    
	if($update){
    $chuoitinhanchitiet="Đơn pass: $sochungtu\n";
		$sql = "select ID from passdon where SoCT = '$SoCT'";
		// echo  $sql; return;
		$dong = getdong($sql);
		$idphieu = $dong['ID'];
		$passdonchitiet = $json["passdonchitiet"];
		
$chuoiinsert='';
		foreach($passdonchitiet as $key => $value){
			$IDSP = $value["IDSP"];
			$mahang = $value["mahang"];
			$SoLuong = $value["SoLuong"];
			$DonGia = $value["DonGia"];
			$LoaiTien = $value["LoaiTien"];
			$tenpt = $value["tenpt"];
			$Thue = $value["Thue"];
			$BaoHanh = $value["BaoHanh"];
			$GhiChu = $value["GhiChu"];
			$Loai = $value["Loai"];
			$giavon = $value["giavon"];
			$ngaytao = $value["ngaytao"];
			$IDTao = $value["IDTao"];
			$IDnhom = $value["IDnhom"];
			$IDNV = $value["IDNV"];
			$chietkhau = $value["chietkhau"];
			$mota = $value["mota"];
			$IDchnhan = $value["IDchnhan"];
			$idbill = $value["idbill"];
			$IDnvnhan = $value["IDnvnhan"];
			$NgayNhan = $value["NgayNhan"];
            $chuoitinhanchitiet.="Mã sản phẩm: $mahang\ntên sản phẩm: $tenpt\nSố lượng: $SoLuong";
		$chuoiinsert.="('$idphieu','$IDSP','$mahang','$SoLuong','$DonGia','$LoaiTien','$tenpt','$Thue','$BaoHanh','$GhiChu','$Loai','$giavon','$ngaytao','$IDTao','$IDnhom','$IDNV','$chietkhau','$mota','$IDchnhan','$idbill','$IDnvnhan','$NgayNhan'),";
		//	$sql= "insert into passdonchitiet (IDPhieu, IDSP,mahang,SoLuong,DonGia,LoaiTien,tenpt,Thue,BaoHanh,GhiChu,Loai,giavon,ngaytao,IDTao,IDnhom,IDNV,chietkhau,mota,IDchnhan,idbill,IDnvnhan,NgayNhan) values ('$idphieu','$IDSP','$mahang','$SoLuong','$DonGia','$LoaiTien','$tenpt','$Thue','$BaoHanh','$GhiChu','$Loai','$giavon','$ngaytao','$IDTao','$IDnhom','$IDNV','$chietkhau','$mota','$IDchnhan','$idbill','$IDnvnhan','$NgayNhan')";
			// echo  $sql; return;

			
		}
		$chuoiinsert=rtrim($chuoiinsert,",");
		$sql= "insert into passdonchitiet (IDPhieu, IDSP,mahang,SoLuong,DonGia,LoaiTien,tenpt,Thue,BaoHanh,GhiChu,Loai,giavon,ngaytao,IDTao,IDnhom,IDNV,chietkhau,mota,IDchnhan,idbill,IDnvnhan,NgayNhan) values ".$chuoiinsert;
		//echo $sql;
		$update=$data->query($sql);
        if($update){
				sendFB($chuoitinhanchitiet);
			}
		return $update;
	}
	}
	return;
    
}

			
function sendFB($mess){
    global $data;
    $sql="select distinct a.IDfb from userac a left join nhanviendilam b on a.ID=b.IDnhanvien where day(b.ngaytao)=day(now()) and month(b.ngaytao)=month(now()) and year(b.ngaytao) = year(now()) and a.IDfb is not null";
    $query=$data->query($sql);
    
    // $magresp=array("1962958627103807","4712811502139254");
//$mess="đây là tin nhắn tự động";
$mangbatch=[];
    while($re=$data->fetch_array($query)){
        $value=$re["IDfb"];
            $texbody = [
                    'recipient'=> [
                        'id' => $value,
                    ],
                    'message'=>[
                        'text'=>$mess
                    ]
                ];
            $batch=[
            'method'=>'POST',
            'relative_url'=>'me/messages',
            'body'=>http_build_query($texbody, "", '&'),
            ];
        array_push($mangbatch,$batch);
    

    }
    $jsonurl=json_encode($mangbatch);
      $jsonurl=urlencode($jsonurl);
   $res=guitinnhanhangloat($jsonurl);
   $res=json_decode($res,true);
   var_dump($res);
   return $res;
//    if($res[0]["code"]==200){
//        echo "thành công";
//    }
//    else{
//        echo "thất bại";
//    }
  
}

function guitinnhanhangloat($jsonurl){
    

    $curl = curl_init();
    $url='https://graph.facebook.com/';
    $ACCESSTOKEN='EAAOFnsGIUHYBAMuys1ZCSnZBZApyZAwZCofJu9wosuIuz4TvFBlqkt8CZCZBL5ZAsKQNS5BIgpBAYsDZCM69bqiZAs6wziMtOuBUgprc8qZCSzpX33YN2aDwRt9hUUPTUbuQyFKkhgBx0nLrXQg3d1jt6dqaRQdYpZBJAs8ZC0MdL4rWSg2RRMZCsc7HdpZCz4uzH9DLCMoYz7FazsCTwZDZD';
    $endpoint='me?batch='.$jsonurl."&access_token=".$ACCESSTOKEN;
    //return  $url.$endpoint;
    curl_setopt_array($curl, array(
    CURLOPT_URL =>$url.$endpoint,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_HTTPHEADER => array(
        'Cookie: sb=7yC7YPRdvUTACsPMzGr1Z0iH'
    ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    return $response;

}		
?>