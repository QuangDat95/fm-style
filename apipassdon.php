<?php  
 header("Content-Type: application/json");
 $root_path =getcwd()."/"  ;
include($root_path."biensession.php");
include($root_path."includes/config.php");
include($root_path."includes/removeUnicode.php");
include($root_path."includes/class.paging.php");
include($root_path."includes/class.mysql.php");
include($root_path."includes/function.php");
include($root_path."includes/function_local.php");

 $json = file_get_contents('php://input');	  
 
 
 if($json)
   {
	   $json = json_decode($json, true);
	 
	    $baomat= $json['baomat']  ;
	   if($baomat=='') return ;
	   
	   
		$idch=  laso($json['idch']);
	   $tungay=  chonghack($json['tungay'])  ;
	   $toingay=  chonghack($json['toingay'])  ;
 
}
 else   return ;


 	
		
    $baomat = explode('!@9',$baomat);    
    $baomat =$baomat[1];
		
 if ($baomat!="2cffe4a34ccc4f9c6ec755843593458b") return ; 

 $sql_where=' where  1=1 ';
	if($idch!=0)
	{
			$sql_where.=" idkho='$idch' ";
			
	}
	if($tungay=="") {
	
		$tungay = gmdate('01/n/Y', time() + 7*3600-60*24*3600);
	}
		
		if($tungay!="")	
		{
		  $ngay=  explode('/',$tungay);
	 	
	     if ($na!=$ngay[2])
		  {
			//  if (($ngay[1]+2)<($th)) {$ngay[1]= $th-2 ;}
		  }  
	   	  if (strlen($ngay[1])== 1) {  $ngay[1] = "0".$ngay[1] ;  }
		  if (strlen($ngay[0])== 1) {  $ngay[0] = "0".$ngay[0] ;  } 
		  
		   		
		  $sql_where .= " and  a.NgayNhap >= '$ngay[2]-$ngay[1]-$ngay[0]'";
		    $sql_wherev .= " and  a.NgayNhap >= '$ngay[2]-$ngay[1]-$ngay[0]'";
		}
		if($toingay!="")	
		{
		  $ngay=  explode('/',$toingay);
	   	  if (strlen($ngay[1])== 1) {  $ngay[1] = "0".$ngay[1] ;  }
		  if (strlen($ngay[0])== 1) {  $ngay[0] = "0".$ngay[0] ;  }    		
		  $sql_where .= " and  a.NgayNhap <= '$ngay[2]-$ngay[1]-$ngay[0]'";
		  $sql_wherev .= " and  a.NgayNhap <= '$ngay[2]-$ngay[1]-$ngay[0]'";
		} 
		
	if($toingay!="" && $tungay!=""){
		$ngaytu=  explode('/',$tungay);
		$ngaytoi= explode('/',$toingay);
		$ngaytu="$ngaytu[2]-$ngaytu[1]-$ngaytu[0]";
		$ngaytoi="$ngaytoi[2]-$ngaytoi[1]-$ngaytoi[0]";
		$datetime1 = date_create($ngaytu);
		$datetime2 = date_create($ngaytoi);
		$interval = date_diff($datetime1, $datetime2);
		if($interval->format("%a")>30){
		//var_dump($interval->format("%a"));
			$data_array =  array(
				"Erorr"=> 1,
				'Messenger' =>"Số ngay yêu cầu trong khoảng 30 ngày"
  			  );	
			  echo json_encode($data_array); return ;
		}
		
	}


  
//  //if ($us =="" || $id == "" ) { echo " Ban chua dang nhap!!! " ;return ;}
  
$data = new class_mysql();
$data->config();
$data->access();
	
$sql = "SELECT v.diachi,v.phuong,v.quan,v.tinh,DATE_FORMAT(v.ngayhoanthanh,'%d/%m/%y %H:%i:%s %p' ) as ngayht,DATE_FORMAT(v.ngaytoikho,'%d/%m/%y %H:%i:%s %p' ) as ngayxuatkho,DATE_FORMAT(v.ngayhuy,'%d/%m/%y %H:%i:%s %p' ) as ngayhuydon,a.LyDo as team,a.ID as IDdonghd,a.SoCT as sophieu,a.idchol,a.tigia,c.NameN,m.makh,DATE_FORMAT(m.ngaysinh,'%d/%m/%y') as ngaysinh,m.address,m.diemtichluy,m.tel,m.Name as tenkh,DATE_FORMAT(a.NgayTao,'%d/%m/%y %H:%i') as ngayban,a.idgioithieu,a.IDNhaCC,a.idkho,a.SoCT ,a.nguoigiao,a.nguoitao,a.IDTao,a.diachiN ,b.idnv as giagiamdoichieu,b.IDSP,b.DonGia as giaban,b.SoLuong as SoLuong,c.Name as ten,b.GhiChu as note,b.chietkhau,c.idgroup,c.idnhom,c.price as giachuan ,c.size,c.mau,c.code as magoc,c.codepro as mapt,  a.loai,b.ghichu ,a.ghichu as note,p.ID as idpassdon,p.cuahangnhan as chnhanhet,p.nhanviennhan as nvnhanhet,p.NgayNhan as ngaypassdon 
 FROM   phieunhapxuat a left join xuatbanhang b on a.ID =b.IDPhieu left join products c on b.IDSP = c.ID left join customer m on a.IDNhaCC =m.id left join vanchuyenpassdon v on a.id=v.idbill left join passdon p on v.IDpassdon=p.id   $sql_where" ;
//echo $sql;
 //group by a.ID    sum(b.soluong) as SoLuong,sum(b.DonGia*(1-1*b.chietkhau/100)*b.SoLuong) as thanhtien

$query=$data->query($sql);
$numrow=$data->num_rows($query);

     if(!$query) {
	 		 $data_array =  array(
				"Erorr"=> 1,
				'Messenger' =>"Không có dữ liệu $sql "
  			  );	
			  
			  echo json_encode($data_array); 
			   return;
      }
		  
		     $mangsize=taomang("size","ID","Name" );
 $mangmau =taomang("mausac","ID","Name" );
 $mangdiachi =taomang("cuahang","ID","address" );	
 $macuahang =taomang("cuahang","ID","macuahang" );	
 //
 $mangteam =taomang("lydonhapxuat","ID","Name"," where id>45  and loai=1 " );	
   $mangch =taomang("cuahang","ID","Name");
   $mangnv =taomang("userac","ID","MaNV");
  $mangten =taomang("userac","ID","ten");
  $mangnhomhang =taomang("groupproduct","ID","Name");  
   $mangnganhhang =taomang("nhomhang","ID","Name");  
 

  $sophieutam='';
  $tammangchitiet=[];
  $mangtong=[];
  $iddong='';
  $r=0;
while($re=$data->fetch_array($query)){
		
	if($r==0){
		$sophieutam=$re['sophieu'];
		 $iddong=$re['IDdonghd'];
		 $ngayban=$re['ngayban'];
		 //k+++++++++++++kh
		 $mangkh['ma_khach_hang']=$re['makh'];
		 $mangkh['ten_khach_hang']=$re['tenkh'];
		  $mangkh['ngay_sinh']=$re['ngaysinh'];
		   $mangkh['so_dien_thoai']=$re['tel'];
		    $mangkh['dia_chi']=$re['address'];
			
			///++++++++=nhan vien
				$mangnhv['ma_nhan_vien']=$mangnv[$re['diachiN']];
				 $mangnhv['nhan_vien_id']=$re['diachiN'];
				  $mangnhv['ten_nhan_vien']=$mangten[$re['diachiN']];
			
		 ///++++++++=thungan
		$mangtn['ma_nhan_vien']=$mangnv[$re['IDTao']];
		 $mangtn['nhan_vien_id']=$re['IDTao'];
		  $mangtn['ten_nhan_vien']=$mangten[$re['IDTao']];
		  //++++++++++++++++++cưa hàng nhân pass getCHpassDonle
		  
			$passdon=getPassDon($re,$mangdiachi,$mangnv,$mangten);
		  //++++++++++++++++++++++=trạng thái đon
		  $trangthai['thoi_gian_hoan_thanh']=$re['ngayht'];
		 $trangthai['thoi_gian_tra_hang']=$re['ngayhuydon'];
		    //++++++++++++++++++++++=trạng thái tong đon
		  $trangthaitongdon['thoi_gian_tao_don']=$re['ngayban'];
		 $trangthaitongdon['thoi_gian_huy_don']=$re['ngayhuydon'];
		  $trangthaitongdon['thoi_gian_xuat_kho']=$re['ngayxuatkho'];
		   $trangthaitongdon['thoi_gian_hoan_thanh']=$re['ngayht'];
		    $trangthaitongdon['thoi_gian_tra_hang']=$re['ngayhuydon'];
		//++++++++++++++++team
	
		$kenhbanonline['team_online']=$mangteam[$re['team']];
		$kenhbanonline['dia_chi_giao_hang_day_du']=$re['diachi'];
		$kenhbanonline['phuong_xa']=$re['phuong'];
		$kenhbanonline['quan_huyen']=$re['quan'];
		$kenhbanonline['tinh_tp']=$re['tinh'];
		//+++++++++++++cửa hàng
		$kenhbanoffline['dia_chi_cua_hang_day_du']=$mangdiachi[$re['idkho']];
		$kenhbanoffline['phuong_xa']='';
		$kenhbanoffline['quan_huyen']='';
		$kenhbanoffline['tinh_tp']='';
		$kenhbanoffline['khu_vuc']='';
		 $mangdata=[];
		// echo $re['sophieu'];
	}
	else{
	
		if($sophieutam!='' && $sophieutam!=$re['sophieu']){
				
				$mangdata["so_phieu"]=$sophieutam;
				$chitietdon['dong_hoa_don_id']=$iddong;
				$chitietdon['noi_dung_dong_hoa_don']= $tammangchitiet;
				$chitietdon['kenh_ban_online']= $kenhbanonline;
				$chitietdon['kenh_ban_offline']= $kenhbanoffline;
				$chitietdon['trang_thai']= $trangthaitongdon;
				$mangdata["dong_hoa_don"]=$chitietdon;
				$mangdata["khach_hang"]=$mangkh;
				$mangdata["nhan_vien"]=$mangnhv;
				$mangdata["thu_ngan"]=$mangtn;
				array_push($mangtong,$mangdata);
				//================
				$tammangchitiet=[];
				$mangdata=[];
				$sophieutam=$re['sophieu'];
				 $iddong=$re['IDdonghd'];
			//k+++++++++++++kh
				 $mangkh['ma_khach_hang']=$re['makh'];
				 $mangkh['ten_khach_hang']=$re['tenkh'];
			  $mangkh['ngay_sinh']=$re['ngaysinh'];
			   $mangkh['so_dien_thoai']=$re['tel'];
				$mangkh['dia_chi']=$re['address'];
				
				///++++++++=nhan vien
			
					$mangnhv['ma_nhan_vien']=$mangnv[$re['idgioithieu']];
				 	$mangnhv['nhan_vien_id']=$re['idgioithieu'];
			  	$mangnhv['ten_nhan_vien']=$mangten[$re['idgioithieu']];
			  
			 ///++++++++=thungan
					$mangtn['ma_nhan_vien']=$mangnv[$re['IDNhaCC']];
					 $mangtn['nhan_vien_id']=$re['IDNhaCC'];
					  $mangtn['ten_nhan_vien']=$mangten[$re['IDNhaCC']];
					//++++++++++++++++++cưa hàng nhân pass getCHpassDonle
					$passdon=getPassDon($re,$mangdiachi,$mangnv,$mangten);
							  //++++++++++++++++++++++=trạng thái đon
					 $trangthai['thoi_gian_hoan_thanh']=$re['ngayht'];
					 $trangthai['thoi_gian_tra_hang']=$re['ngayhuydon'];
					   //++++++++++++++++++++++=trạng thái tong đon
		  $trangthaitongdon['thoi_gian_tao_don']=$re['ngayban'];
		 $trangthaitongdon['thoi_gian_huy_don']=$re['ngayhuydon'];
		  $trangthaitongdon['thoi_gian_xuat_kho']=$re['ngayxuatkho'];
		   $trangthaitongdon['thoi_gian_hoan_thanh']=$re['ngayht'];
		    $trangthaitongdon['thoi_gian_tra_hang']=$re['ngayhuydon'];
					//++++++++++++++++team
				
					$kenhbanonline['team_online']=$mangteam[$re['team']];
					$kenhbanonline['dia_chi_giao_hang_day_du']=$re['diachi'];
					$kenhbanonline['phuong_xa']=$re['phuong'];
					$kenhbanonline['quan_huyen']=$re['quan'];
					$kenhbanonline['tinh_tp']=$re['tinh'];
						//+++++++++++++cửa hàng
					$kenhbanoffline['dia_chi_cua_hang_day_du']=$mangdiachi[$re['idkho']];
					$kenhbanoffline['phuong_xa']='';
					$kenhbanoffline['quan_huyen']='';
					$kenhbanoffline['tinh_tp']='';
					$kenhbanoffline['khu_vuc']='';
					
						}
		if($r==($numrow-1)){
			//k+++++++++++++kh
				 $mangkh['ma_khach_hang']=$re['makh'];
				 $mangkh['ten_khach_hang']=$re['tenkh'];
			  $mangkh['ngay_sinh']=$re['ngaysinh'];
			   $mangkh['so_dien_thoai']=$re['tel'];
				$mangkh['dia_chi']=$re['address'];
				
				///++++++++=nhan vien
			
					$mangnhv['ma_nhan_vien']=$mangnv[$re['idgioithieu']];
				 	$mangnhv['nhan_vien_id']=$re['idgioithieu'];
			  	$mangnhv['ten_nhan_vien']=$mangten[$re['idgioithieu']];
			  
			 ///++++++++=thungan
					$mangtn['ma_nhan_vien']=$mangnv[$re['IDNhaCC']];
					 $mangtn['nhan_vien_id']=$re['IDNhaCC'];
					  $mangtn['ten_nhan_vien']=$mangten[$re['IDNhaCC']];
				 //++++++++++++++++++cưa hàng nhân pass getCHpassDonle
					$passdon=getPassDon($re,$mangdiachi,$mangnv,$mangten);
				//++++++++++++++++++++++=trạng thái đon
				  $trangthai['thoi_gian_hoan_thanh']=$re['ngayht'];
					$trangthai['thoi_gian_tra_hang']=$re['ngayhuydon'];
					   //++++++++++++++++++++++=trạng thái tong đon
		  $trangthaitongdon['thoi_gian_tao_don']=$re['ngayban'];
		 $trangthaitongdon['thoi_gian_huy_don']=$re['ngayhuydon'];
		  $trangthaitongdon['thoi_gian_xuat_kho']=$re['ngayxuatkho'];
		   $trangthaitongdon['thoi_gian_hoan_thanh']=$re['ngayht'];
		    $trangthaitongdon['thoi_gian_tra_hang']=$re['ngayhuydon'];
					//++++++++++++++++team
				
					$kenhbanonline['team_online']=$mangteam[$re['team']];
					$kenhbanonline['dia_chi_giao_hang_day_du']=$re['diachi'];
					$kenhbanonline['phuong_xa']=$re['phuong'];
					$kenhbanonline['quan_huyen']=$re['quan'];
					$kenhbanonline['tinh_tp']=$re['tinh'];
						//+++++++++++++cửa hàng
					$kenhbanoffline['dia_chi_cua_hang_day_du']=$mangdiachi[$re['idkho']];
					$kenhbanoffline['phuong_xa']='';
					$kenhbanoffline['quan_huyen']='';
					$kenhbanoffline['tinh_tp']='';
					$kenhbanoffline['khu_vuc']='';
			$tamct=[];
			
			$tamct['ma_san_pham']=$re['mapt'];
			$tamct['ten_san_pham']=$re['ten'];
			$tamct['Size']= $mangsize[$re['size']];
			$tamct['mau_san_pham']=$mangmau[$re['mau']];
			$tamct['nhom_hang']=$mangnhomhang[$re['idnhom']];
			$tamct['ma_mo_ta']=$re['magoc'];
			$tamct['gia_chuan']=$re['giachuan'];
			$tamct['voucher']=$re['tigia'];
			$tamct['chiet_khau']=$re['chietkhau'];
			$tamct['gia_ban']=$re['giaban'];
			$tamct['gia_giam']=$re['tigia'];
			$tamct['so_luong']=$re['SoLuong'];
			$tamct['thanh_tien']=$re['thanhtien'];
			$tamct['note']=$re['note'];
			$tamct['pass_don']= $passdon;
			$tamct['trang_thai']= $trangthai;
			array_push($tammangchitiet,$tamct);
			
				$mangdata["so_phieu"]=$sophieutam;
				$chitietdon['dong_hoa_don_id']=$iddong;
				$chitietdon['noi_dung_dong_hoa_don']= $tammangchitiet;
				$chitietdon['kenh_ban_online']= $kenhbanonline;
				$chitietdon['kenh_ban_offline']= $kenhbanoffline;
				$chitietdon['trang_thai']= $trangthaitongdon;
				$mangdata["dong_hoa_don"]=$chitietdon;
				$mangdata["khach_hang"]=$mangkh;
				$mangdata["nhan_vien"]=$mangnhv;
				$mangdata["thu_ngan"]=$mangtn;
			array_push($mangtong,$mangdata);
			//================
			$tammangchitiet=[];
			$mangdata=[];
			$sophieutam=$re['sophieu'];
			 $iddong=$re['IDdonghd'];
		}	
	}
		

	$tamct=[];
	$tamct['ma_san_pham']=$re['mapt'];
	$tamct['ten_san_pham']=$re['ten'];
	$tamct['Size']= $mangsize[$re['size']];
	$tamct['mau_san_pham']=$mangmau[$re['mau']];
	$tamct['nhom_hang']=$mangnhomhang[$re['idnhom']];
	$tamct['ma_mo_ta']=$re['magoc'];
	$tamct['gia_chuan']=$re['giachuan'];
	$tamct['voucher']=$re['tigia'];
	$tamct['chiet_khau']=$re['chietkhau'];
	$tamct['gia_ban']=$re['giaban'];
	$tamct['gia_giam']=$re['tigia'];
	$tamct['so_luong']=$re['SoLuong'];
	$tamct['thanh_tien']=$re['thanhtien'];
	$tamct['note']=$re['note'];
	$tamct['pass_don']= $passdon;
	$tamct['trang_thai']= $trangthai;
	array_push($tammangchitiet,$tamct);
	$r++;
}
		/*echo "<pre>";
		var_dump($mangtong);
		echo "</pre>";*/

	
	$data_array =  array(
				"Erorr"=> 0,
				'data' => $mangtong,
				'Messenger' =>"Thành công  "
 			  );	 
         
    
     echo json_encode($data_array); return ;
  			
 function getCHpassDonle($idpass,$idsp=''){
 	global $data;
	$where="";
	if($idsp){
		$where=" and IDSP='$idsp'";
	}
	
 		$sql="select IDchnhan,IDnvnhan,NgayNhan from passdonchitiet where IDPhieu='$idpass' $where";
	
		$dong=getdong($sql);
		return $dong;
 }
 
 function getPassDon($re,$mangdiachi,$mangnv,$mangten){
 
 	if($re['idpassdon']!=''){
				
					  if($re['chnhanhet']!=''){
			
						/// nhân viên pass
						 $passdon['nhan_vien_nhan_don']=array(
							"ma_nhan_vien"=>$mangnv[$re['nvnhanhet']],
								"nhan_vien_id"=>$re['nvnhanhet'],
							"ten_nhan_vien"=>$mangten[$re['nvnhanhet']],
							);
							/// của hàng pass
						 $passdon['cua_hang_nhan_don']=array(
								"dia_chi_cua_hang_day_du"=>$mangdiachi[$re['chnhanhet']],
								"phuong_xa"=>'',
								"quan_huyen"=>'',
								"tinh_tp"=>'',
								"khu_vuc"=>'',
							);
								/// ngay pass
						 $passdon['thoi_gian_nhan_don_pass']=$re['ngaypassdon'];
						 		 	
					  }
					  else{
					  //chi tiết pass
					  	$passdonct=getCHpassDonle($re['idpassdon'],$re['IDSP']);
								/// nhân viên pass
						 $passdon['nhan_vien_nhan_don']=array(
								"ma_nhan_vien"=>$mangnv[$passdonct['IDnvnhan']],
								"nhan_vien_id"=>$passdonct['IDnvnhan'],
								"ten_nhan_vien"=>$mangten[$passdonct['IDnvnhan']],
							);
							/// của hàng pass
						 $passdon['cua_hang_nhan_don']=array(
								"dia_chi_cua_hang_day_du"=>$mangdiachi[$passdonct['IDchnhan']],
								"phuong_xa"=>'',
								"quan_huyen"=>'',
								"tinh_tp"=>'',
								"khu_vuc"=>'',
							);
								/// ngay pass
						 $passdon['thoi_gian_nhan_don_pass']=$passdonct['NgayNhan'];
							
								
						}
		 }
		 return $passdon;
 }
    $data->closedata() ;
?>	