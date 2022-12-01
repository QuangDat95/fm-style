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
   $idkho=$_SESSION["se_kho"];
$data = new class_mysql();
$data->config();
$data->access();

    $data1 = $_POST['DATA']; 
    $tmp = explode('*@!',$data1);  
 	$id = laso($tmp[0]) ;
	
	$tench=getten("cuahang",$idcuahang,"Name");
	$loai = laso($tmp[1]) ; 
	$lydo = chonghack($tmp[3]) ; 
	$loainhan = chonghack($tmp[4]) ;
	$idchitietpass = chonghack($tmp[2]);
	$idchitietpass =explode("*",$idchitietpass);
	/*var_dump($idchitietpass);
	return;*/
	$idchitietpasshuy = chonghack($tmp[5]);
		
	$idchitietpasshuy =explode("*",$idchitietpasshuy);
	$tienship = laso($tmp[6]);
	
	date_default_timezone_set('Asia/Ho_Chi_Minh');
	$lancuoi=date('Y-m-d H:i:s') ;
   $now=date('Y-m-d H:i:s') ;
     if($loai==8)  {
	 	if(!$lydo || $lydo==''){
				echo  "###8###Vui lòng nhập lý do!###$id###$tench###-1###" ;
				return;
		}
		
	 	if($loainhan=="all"){
		$chuoitamnhan='';
		$chuoiidsp='';
		
					$sql.="update passdon set cuahangnhan='' where ID='$id' and cuahangnhan='$idcuahang'"; 			
					$update= $data->query($sql);
				 if($update){
				 	$chuoiinsert='';
				 	foreach($idchitietpasshuy as $key => $value){
						
							if($value){
							
								$idsp=layIDSPpassDonChTiet($value);
								
								$soluonghientai=mangsoluongcuahang($idcuahang,$idsp);
								$chuoitamnhan.= getten("passdonchitiet",$value,"tenpt")."*";
								$chuoiidsp.=$value."*";
								$chuoiinsert.="('$id','$value','$idcuahang','$soluonghientai','$lydo','$lancuoi'),";
							}
					}
					$chuoiinsert=rtrim($chuoiinsert,",");
					
				 	$sql="insert into passdoncuahanghuy (IDpassdon,IDpassdonchitiet,IDcuahang,soluongco,lydo,ngayhuy) values $chuoiinsert";
					
					$update= $data->query($sql);
					 if($update){
									echo  "###8###Đã hủy đơn!###$id###$tench###$idcuahang###$chuoitamloi###$chuoitamnhan###$chuoiidsp###" ;
					 }
				 }
				 
		}
		else{
	 	
		
			$chuoitamloi='';
			$chuoitamnhan='';
			$chuoiidsp='';
			$chuoiinsert='';
			foreach($idchitietpass as $key => $value){
				if($value){
					
					$chuoiupdate.="update passdonchitiet set IDchnhan ='' where ID='$value' and IDchnhan='$idcuahang'";
					$dongxn=checkDanhan($value);
					
						 $update= $data->query($chuoiupdate);
						 if($update){
							$chuoiidsp.=$value."*";
							 $chuoitamnhan.= getten("passdonchitiet",$value,"tenpt")."*";
						 }
					
						
				}
			}
			
				$chuoiinsert='';
				foreach($idchitietpasshuy as $key => $value){
					
						if($value){
							
								$idsp=layIDSPpassDonChTiet($value);
								$soluonghientai=mangsoluongcuahang($idcuahang,$idsp);
							$chuoiinsert.="('$id','$value','$idcuahang','$soluonghientai','$lydo','$lancuoi'),";
						}
				}
					$chuoiinsert=rtrim($chuoiinsert,",");
					
				 	$sql="insert into passdoncuahanghuy (IDpassdon,IDpassdonchitiet,IDcuahang,soluongco,lydo,ngayhuy) values $chuoiinsert";
					$update= $data->query($sql);
					 if($update){
					 			echo  "###8###Đã hủy đơn!###$id###$tench###$idcuahang###$chuoitamloi###$chuoitamnhan###$chuoiidsp###" ;
					 }
			
		}
	 
	   
	 }
     else if($loai==1) 
	 {
	 	$thoigiannhandon=30;//phút
		if($loainhan=='all'){
		
				$sql="select cuahangnhan,ngaytao from passdon where ID='$id'";
				$dong=getdong($sql);
				$sophut= dateDiffMi($dong["ngaytao"],$now);
			
				if($sophut>=$thoigiannhandon){
						echo  "###1###Quá số phút nhân đủ đơn!###$id###$tench###-1###" ;
						return;
				}
				if($dong['cuahangnhan']){
						echo  "###1###Phiếu đã có của hàng nhận!###$id###$tench###-1###" ;
						return;
				}
				else{
				
					$sql="update passdon set cuahangnhan='$idcuahang',nhanviennhan='$idk',NgayNhan='$lancuoi' where ID='$id'";
					 $update= $data->query($sql);
					 if($update){
					 		foreach($idchitietpass as $key => $value){
									if($value){
									$chuoiupdate="update passdonchitiet set GhiChu='$lydo' where ID='$value' and (IDchnhan is null or IDchnhan =0)";
									 $update= $data->query($chuoiupdate);
										 $chuoiidsp.=$value."*";
											 $chuoitamnhan.= getten("passdonchitiet",$value,"tenpt")."*";
									}
							}
					 
					 	echo  "###1###Đã nhận đơn!###$id###$tench###$idcuahang###$chuoitamloi###$chuoitamnhan###$chuoiidsp###" ;
					 return;
					 }
				}
		}
		else{
			
			$chuoitamloi='';
			$chuoitamnhan='';
			$chuoiidsp='';
			foreach($idchitietpass as $key => $value){
				if($value){
					$chuoiupdate="update passdonchitiet set IDchnhan ='$idcuahang',IDnvnhan='$idk',NgayNhan='$lancuoi',GhiChu='$lydo' where ID='$value' and (IDchnhan is null or IDchnhan =0)";
					$dongxn=checkDanhan($value);
					if($dongxn['IDchnhan']){
						$chuoitamloi.=$dongxn['mahang']."*".$dongxn['tenpt']."*".getten("cuahang",$idcuahang,"Name")."###";				
					}
					else{
						 $update= $data->query($chuoiupdate);
						 $chuoitamnhan.= getten("passdonchitiet",$value,"tenpt")."*";
						 $chuoiidsp.=$value."*";
					}
					
					
				}
			}
			echo  "###1###Đã nhận đơn!###$id###$tench###$idcuahang###$chuoitamloi###$chuoitamnhan###$chuoiidsp###" ;
			
		}
		
 	 }
	  else if($loai==4) 
	 {
	 
		if(!$tienship){
			echo  "###4###vui lòng nhập phí ship!###$id###$tench###$idcuahang###-1###" ;
				return;
		}
	 	if(!checkKhoaPhieu($id)){
				echo  "###4###Không thể khóa phiếu này do xác nhận đơn chưa đủ!###$id###$tench###$idcuahang###-1###" ;
				return;
		}
		
		
	 $NgayTao = date('Y-m-d H:i:s')  ;
	 //tao sô chứng từ
	 //=======================================================================================
		   /*$thang = gmdate('m', time() + 7*3600); 
		   $nam = gmdate('y', time() + 7*3600); 
		   $so = strlen($idcuahang) + 9;
		   $sql = "select   max(convert( mid(SoCT,$so,22),UNSIGNED INTEGER))as sp from phieunhapxuat  where loai ='1' and  IDKho='$idcuahang' and  mid(SoCT,4,2) = '$thang' " ;
 		   $kq = $data->truyvan($sql) ;		
		   $sp = laso($kq['sp']) + 1 ;
		   if (strlen($sp)== '1' ) $sps = "00" ;
		   if (strlen($sp)== '2' ) $sps = "0" ;
		   $sochungtu ="B".$nam.$thang.$_SESSION["S_MaNV"].".".$idcuahang.".".$sps.$sp ; 
		   $sochungtu2 ="B".$nam.$thang.$_SESSION["S_MaNV"].".".$idcuahang.".".$sps.($sp+1) ; 
		   
		   $tam = getdong(" select ID from phieunhapxuat where SoCT ='$sochungtu' limit 1 ") ;
	  
	  
   	   		if ($tam["ID"]!=""){$sochungtu= $sochungtu2;}*/
	if($loainhan=='all'){
	
		$KhCh=getCHvaKH(1,$id);
		$Kh=$KhCh["IDNhaCC"];
		$Ch=$KhCh["cuahangnhan"];
		if(!checkDiachiDaydu(1,$Kh)){
			echo  "###4###Không thể khóa phiếu này do địa chỉ khách hàng không đầy đủ!###$id###$tench###$idcuahang###-1###" ;
				return;
		}
		if(!checkDiachiDaydu(2,$Ch)){
			$tench=getten("cuahang",$value,"Name");
				echo  "###4###Không thể khóa phiếu này do địa chỉ cửa hàng $tench không đầy đủ!###$id###$tench###$idcuahang###-1###" ;
					return;
			}
		
		
		
			
		
		
			$SoCT=getten("passdon",$id,"SoCT");
			//echo $SoCT;
	// $SoCTNew = 'B'.substr($SoCT, 1);
	//	 echo "Trùng số chứng từ !!! " ; return ; }   
		//=======================================================================================
		   $thang = gmdate('m', time() + 7*3600); 
		   $nam = gmdate('y', time() + 7*3600); 
		   $so = strlen($idkho) + 9;
		   $sql = "select   max(convert( mid(SoCT,$so,22),UNSIGNED INTEGER))as sp from phieunhapxuat  where loai ='1' and  IDKho='$idkho' and  mid(SoCT,4,2) = '$thang' " ;
 		   $kq = $data->truyvan($sql) ;		
		   $sp = laso($kq['sp']) + 1 ;
		  if (strlen($sp)== '1' ) $sp1 = "00";
			if (strlen($sp)== '2' ) $sp1 = "0";
			$sochungtu ="B".$nam.$thang.$_SESSION["S_MaNV"].".".$idkho.".".$sp1.$sp ; 
			$sochungtu2 ="B".$nam.$thang.$_SESSION["S_MaNV"].".".$idkho.".".$sp1.($sp+1) ; 
				   
		
	   $tam = getdong("select ID from phieunhapxuat where SoCT ='$sochungtu' limit 1 ") ;
	   
	
	   
   	   if ($tam["ID"]  != ""  ) $sochungtu= $sochungtu2  ;
	   
	 $SoCTNew =$sochungtu;
	 //insert phiếu nhập xuất
	 		$sql="Insert into phieunhapxuat(IDkho,IDNhaCC,IDNhap,NgayNhap,SoCT,LyDo,SoNgayNo,IDTKNo,IDTKCo,TiGia,VAT,GhiChu,NgayTao,IDTao,NguoiGiao,Loai,ten,diachi,tenkho,tenlydo,tenN,diachiN,dakhoa,nguoitao,nguoisua,ngaykhoa,dahuy,IDkhoa,tientra,idchOL,idgioithieu)
select cuahangnhan,IDNhaCC,IDNhap,NgayNhap,'$SoCTNew',LyDo,SoNgayNo,IDTKNo,IDTKCo,TiGia,VAT,'$lydo','$NgayTao',IDTao,NguoiGiao,Loai,ten,diachi,tenkho,tenlydo,tenN,diachiN,1,nguoitao,nguoisua,ngaykhoa,dahuy,IDkhoa,tientra,idchOL,idgioithieu from passdon where ID='$id'";
		
			 $update= $data->query($sql);
			 
			 if($update){
			 	$mangtpTrunguong=array("SG","DDN","HN","HP","CT");
				$sql="select *,ID from phieunhapxuat where SoCT='$SoCTNew'";
			
				$dong=getdong($sql);
				$idphieu=$dong["ID"];
				$mangoder['id']=$SoCTNew;
				$diachikh=getdiachiKH($dong['IDNhaCC']);
				$mangoder['tel']=$diachikh["tel"];
				$mangoder['name']=$diachikh["Name"];
				$mangoder['address']=$diachikh["address"];
				
				if(in_array($diachikh["matinh"],$mangtpTrunguong)){
					$mangoder['province']="TP. ".$diachikh["tinh"];
				}
				else{
					$mangoder['province']="Tỉnh ".$diachikh["tinh"];
				}
				
				$mangoder['district']=$diachikh["quan"];
				$mangoder['ward']=$diachikh["phuong"];
				
				//+++++++++++++++++++++
				$sql="select ID,cuahangnhan from passdon where SoCT='$SoCT'";
				$dong=getdong($sql);
				$idchall=$dong["cuahangnhan"];
				$diachich=getdiachiCH($idchall);
				$mangoder['pick_name']=$diachich["Name"];
				$address=$diachich["address"];
					if($diachich["address"]=="11 Phan Đăng Lưu"){
							$address='Phan Đ.Lưu';
					}
				$mangoder['pick_address']=$address;
				$mangoder['pick_province']=$diachich["tinh"];
				
				if(in_array($diachich["matinh"],$mangtpTrunguong)){
					
					$mangoder['pick_province']="TP. ".$diachich["tinh"];
				}
				else{
					$mangoder['pick_province']="Tỉnh ".$diachich["tinh"];
				}
				$mangoder['pick_district']=$diachich["quan"];
				
				$mangoder['pick_ward']=$diachich["phuong"];
				$mangoder['pick_tel']=$diachich["tel"];
				$mangoder['note']="pass đơn";
				$idpassdon=$dong["ID"];
				 $insertpch='';
				if($idchall){
					 $insertpch="('".$idphieu."','".$idchall."'),";
				 }
				//+++++++++++++++++++++++++++++
			 	$sql="select * from passdonchitiet where IDphieu='$id'";
				
				 $query= $data->query($sql);
				 $insert='';
				$idpasschitiet='';
				$manngpro=[];
				$tongtien=0;
				while($re=$data->fetch_array($query)){
					/*$sql="update passdonchitiet set idbill=$idphieu where ID='$re[ID]'";
					$update= $data->query($sql);
				*/
				$tam['name']=$re['tenpt'];
				$tam['weight']=0.5;
				$tam['quantity']=$re['SoLuong'];
				$tam['product_code']=$re['mahang'];
				
				$cacmasp='';
				$idpasschitiet.=$re['ID']."*";
				array_push($manngpro,$tam);
					 $insert.="('".$idphieu."','".$re['IDSP']."','".$re['mahang']."','".$re['SoLuong']."','".$re['DonGia']."','".$re['LoaiTien']."','".$re['tenpt']."','".$re['thue']."','".$re['BaoHanh']."','".$re['GhiChu']."','".$re['Loai']."','".$re['giavon']."','".$NgayTao."','".$re['IDtao']."','".$re['IDnhom']."','".$re['IDNV']."','".$re['chietkhau']."','".$re['mota']."'),";
					$cacmasp.=$re['mahang'].'x'.$re['SoLuong'].' ';
					 $x=$re['SoLuong'];
					 $idsp=$re['IDSP'];
					 $tongtien+=($re['DonGia']*$x);
					$idcuahangnhan=$re['IDchnhan'];
					$idchkhoa=$idchall?$idchall:$idcuahangnhan;
					if(!$idchall){
						 $insertpch.="('".$idphieu."','".$idchkhoa."'),";
					 }
					 $sqlhh="update hanghoacuahang set SoLuong = SoLuong - $x  where IDSP = $idsp  and IDcuahang =  $idchkhoa";
					 	echo $sqlhh."<br>";
					 $update=$data->query("update hanghoacuahang set SoLuong = SoLuong - $x  where IDSP = $idsp  and IDcuahang =  $idchkhoa   "); 
				}
			 }
			 // insert cuahangpassdon và xuat ban hàng
	 		 $insert=rtrim($insert,",");
			
			  $insertpch=rtrim($insertpch,",");
	 		$sql="insert into xuatbanhang(IDphieu,IDSP,mahang,SoLuong,DonGia,LoaiTien,tenpt,Thue,BaoHanh,GhiChu,Loai,giavon,ngaytao,IDTao,IDnhom,IDNV,Chietkhau,mota) values  $insert";
			
			//echo $sql;
			$update= $data->query($sql);
			$sql="insert into passdoncuahang(IDphieu,IDcuahang) values $insertpch";
			
			$update= $data->query($sql);
				$sql="update passdon set tinhtrang=4 where ID='$id'";
				$update= $data->query($sql);
				if($tienship==1){
					$tienship=0;
				}
				
				$tongtien+=$tienship;
			// insert vanchuyenpassdon
				$mangoder['hamlet']='khác';
				$mangoder['is_freeship']='1';
				$mangoder['pick_money']=$tongtien;
				
				$mangoder['value']=$tongtien;
				//$mangoder['tags']=[ 1];
				$orderArr["products"]=$manngpro;
				$orderArr["order"]=$mangoder;
				echo "<pre>";
					var_dump($orderArr);
				echo "</pre>";
			
			//$_SESSION["tamoder"]=$orderArr;
			$mavd=getmavandon(json_encode($orderArr));
			echo "<pre>";
				var_dump($mavd);
			echo "</pre>";
		
			
			$sql="insert into vanchuyenpassdon(IDbill,IDpassdon,mavd,ngaytao,donvivc,phiship) values ('$idphieu','$id','$mavd','$NgayTao','GHTK','$tienship')";
			
			$update= $data->query($sql);
				if($update){
					$nhanvienxuly=getten("userac",$idk,'Ten');
					$khohang=getten("cuahang",$idcuahang,'Name');
						$sql="insert into vanchuyenonline(IDbill,sobill,madh,mavd,madoitac,donvivc,nvxuly,trigiadon,cacmasp,khohang,diachikho,tongtien,ngaydaydon_dvvc,dienthoai_kh,diachi,tinh,quan,phuong) values ('$idphieu','$SoCTNew','$mavd','$mavd','$mavd','GHTK','$nhanvienxuly','$tongtien','$cacmasp','$khohang','$address','$tongtien','$NgayTao','$diachikh[tel]','$diachikh[address]','$diachikh[tinh]','$diachikh[quan]','$diachikh[phuong]')";
						
						$update= $data->query($sql);
						if($update){
						echo  "###4###Đã Khóa phiếu!###$id###$tench###$idcuahang###1###$idpasschitiet###" ;
						}
					}
			}
			else{
				$KhCh=getCHvaKH(2,$id);
				$Kh=$KhCh["kh"];
				$Ch=$KhCh["ch"];
				
				if(!checkDiachiDaydu(1,$Kh)){
					echo  "###4###Không thể khóa phiếu này do địa chỉ khách hàng không đầy đủ!###$id###$tench###$idcuahang###-1###" ;
						return;
				}
				
				foreach($Ch as $key =>$value){
				
					if(!checkDiachiDaydu(2,$value)){
						$tench=getten("cuahang",$value,"Name");
						echo  "###4###Không thể khóa phiếu này do địa chỉ cửa hàng $tench không đầy đủ!###$id###$tench###$idcuahang###-1###" ;
							return;
					}
				}
			
			
			$sql="select * from passdonchitiet where IDPhieu='$id'";
			$query=$data->query($sql);
			$numrow=$data->num_rows($query);
			$idchnhan='';
			$mangtam=[];
			$tam=[];
			$idpasschitiet='';
			$r=0;
			while($re=$data->fetch_array($query)){
				$idpasschitiet.=$re["ID"];
				
					if($r==0){
						$idchnhan=$re["IDchnhan"];
						array_push($tam,$re);
					}
					else{
					
						if($idchnhan!=$re["IDchnhan"]){
								
								$mangtam[$idchnhan]=$tam;
							$tam=[];
							
							$idchnhan=$re["IDchnhan"];
						}
						array_push($tam,$re);
					}
				
				
					if($r==($numrow-1)){
						$mangtam[$idchnhan]=$tam;
						$tam=[];
						
						$idchnhan=$re["IDchnhan"];
					}
					
				$r++;
			}
			echo "<pre>";
			var_dump($mangtam);
			echo "</pre>";
		
			$mangtpTrunguong=array("SG","DDN","HN","HP","CT");
			 foreach($mangtam as $key => $value){
				 $SoCT=getten("passdon",$id,"SoCT");
						// $SoCTNew = 'B'.substr($SoCT, 1);
						//	 echo "Trùng số chứng từ !!! " ; return ; }   
							//=======================================================================================
							   $thang = gmdate('m', time() + 7*3600); 
							   $nam = gmdate('y', time() + 7*3600); 
							   $so = strlen($key) + 9;
							   $sql = "select   max(convert( mid(SoCT,$so,22),UNSIGNED INTEGER))as sp from phieunhapxuat  where loai ='1' and  IDKho='$idkho' and  mid(SoCT,4,2) = '$thang' " ;
				   $kq = $data->truyvan($sql) ;		
				   $sp = laso($kq['sp']) + 1 ;
				   if (strlen($sp)== '1' ) $sp1 = "00";
				   if (strlen($sp)== '2' ) $sp1 = "0";
				   $sochungtu ="B".$nam.$thang.$_SESSION["S_MaNV"].".".$key.".".$sp1.$sp ; 
				   $sochungtu2 ="B".$nam.$thang.$_SESSION["S_MaNV"].".".$key.".".$sp1.($sp+1) ; 
							   
							
						   $tam = getdong(" select ID from phieunhapxuat where SoCT ='$sochungtu' limit 1 ") ;
						   
						
						   
						   if ($tam["ID"]  != ""  ) $sochungtu= $sochungtu2  ;
						   
						 $SoCTNew =$sochungtu;
					 //insert phiếu nhập xuất
							$sql="Insert into phieunhapxuat(IDkho,IDNhaCC,IDNhap,NgayNhap,SoCT,LyDo,SoNgayNo,IDTKNo,IDTKCo,TiGia,VAT,GhiChu,NgayTao,IDTao,NguoiGiao,Loai,ten,diachi,tenkho,tenlydo,tenN,diachiN,dakhoa,nguoitao,nguoisua,ngaykhoa,dahuy,IDkhoa,tientra,idchOL,idgioithieu)
				select '$key',IDNhaCC,IDNhap,NgayNhap,'$SoCTNew',LyDo,SoNgayNo,IDTKNo,IDTKCo,TiGia,VAT,'$lydo','$NgayTao',IDTao,NguoiGiao,Loai,ten,diachi,tenkho,tenlydo,tenN,diachiN,1,nguoitao,nguoisua,ngaykhoa,dahuy,IDkhoa,tientra,idchOL,idgioithieu from passdon where ID='$id'";
						
					$update=$data->query($sql);
					if($update){
						 	$sql="select *,ID from phieunhapxuat where SoCT='$SoCTNew'";
							$dong=getdong($sql);
							$idphieu=$dong["ID"];
							$mangoder['id']=$SoCTNew;
							$diachikh=getdiachiKH($dong['IDNhaCC']);
							$mangoder['tel']=$diachikh["tel"];
							$mangoder['name']=$diachikh["Name"];
							$mangoder['address']=$diachikh["address"];
							
							if(in_array($diachikh["matinh"],$mangtpTrunguong)){
								$mangoder['province']="TP. ".$diachikh["tinh"];
							}
							else{
								$mangoder['province']="Tỉnh ".$diachikh["tinh"];
							}
							
							$mangoder['district']=$diachikh["quan"];
							$mangoder['ward']=$diachikh["phuong"];
							
							//+++++++++++++++++++++
							$sql="select ID,cuahangnhan from passdon where SoCT='$SoCT'";
							$dong=getdong($sql);
							$idchall=$dong["cuahangnhan"];
							$diachich=getdiachiCH($key);
							$mangoder['pick_name']=$diachich["Name"];
							$address=$diachich["address"];
								if($diachich["address"]=="11 Phan Đăng Lưu"){
										$address='Phan Đ.Lưu';
								}
							$mangoder['pick_address']=$address;
							$mangoder['pick_province']=$diachich["tinh"];
							
							if(in_array($diachich["matinh"],$mangtpTrunguong)){
								
								$mangoder['pick_province']="TP. ".$diachich["tinh"];
							}
							else{
								$mangoder['pick_province']="Tỉnh ".$diachich["tinh"];
							}
							$mangoder['pick_district']=$diachich["quan"];
							
							$mangoder['pick_ward']=$diachich["phuong"];
							$mangoder['pick_tel']=$diachich["tel"];
							$mangoder['note']="pass đơn";
							$idpassdon=$dong["ID"];
							 $insertpch='';
							if($idchall){
								 $insertpch="('".$idphieu."','".$idchall."'),";
							 }
							//+++++++++++++++++++++++++++++
							$sql="select * from passdonchitiet where IDphieu='$id'";
//							 $query= $data->query($sql);
							 $insert='';
							$tongtien=0;
							$manngpro=[];
							foreach($value as $k =>$re){
								$sql="update passdonchitiet set idbill=$idphieu where ID='$re[ID]'";
//								$update= $data->query($sql);
//							
							$tam['name']=$re['tenpt'];
							$tam['weight']=0.5;
							$tam['quantity']=$re['SoLuong'];
							$tam['product_code']=$re['mahang'];
							
							array_push($manngpro,$tam);
								 $insert.="('".$idphieu."','".$re['IDSP']."','".$re['mahang']."','".$re['SoLuong']."','".$re['DonGia']."','".$re['LoaiTien']."','".$re['tenpt']."','".$re['thue']."','".$re['BaoHanh']."','".$re['GhiChu']."','".$re['Loai']."','".$re['giavon']."','".$NgayTao."','".$re['IDtao']."','".$re['IDnhom']."','".$re['IDNV']."','".$re['chietkhau']."','".$re['mota']."'),";
								
								 $x=$re['SoLuong'];
								 $idsp=$re['IDSP'];
								 $tongtien+=($re['DonGia']*$x);
								$idcuahangnhan=$re['IDchnhan'];
								$idchkhoa=$idchall?$idchall:$idcuahangnhan;
								if(!$idchall){
									 $insertpch.="('".$idphieu."','".$idchkhoa."'),";
								 }
								 $update=$data->query("update hanghoacuahang set SoLuong = SoLuong - $x  where IDSP = $idsp  and IDcuahang =  $idchkhoa   "); 
							}
						 
						 // insert cuahangpassdon và xuat ban hàng
						 $insert=rtrim($insert,",");
						
						  $insertpch=rtrim($insertpch,",");
						$sql="insert into xuatbanhang(IDphieu,IDSP,mahang,SoLuong,DonGia,LoaiTien,tenpt,Thue,BaoHanh,GhiChu,Loai,giavon,ngaytao,IDTao,IDnhom,IDNV,Chietkhau,mota) values  $insert";
						//echo $sql;
						$update= $data->query($sql);
						$sql="insert into passdoncuahang(IDphieu,IDcuahang) values $insertpch";
						$update= $data->query($sql);
							$sql="update passdon set tinhtrang=4 where ID='$id'";
							$update= $data->query($sql);
							
							if($tienship==1){
								$tienship=0;
							}
							$tongtien+=$tienship;
						// insert vanchuyenpassdon
							$mangoder['hamlet']='khác';
							$mangoder['is_freeship']='1';
							$mangoder['pick_money']=$tongtien;
							
							$mangoder['value']=$tongtien;
							//$mangoder['tags']=[ 1];
							$orderArr["products"]=$manngpro;
							$orderArr["order"]=$mangoder;
							echo "<pre>";
								var_dump($orderArr);
							echo "</pre>";
						
						//$_SESSION["tamoder"]=$orderArr;
						$mavd=getmavandon(json_encode($orderArr));
						echo "<pre>";
							var_dump($mavd);
						echo "</pre>";
						
						
						$sql="insert into vanchuyenpassdon(IDbill,IDpassdon,mavd,ngaytao,donvivc,phiship) values ('$idphieu','$id','$mavd','$NgayTao','GHTK','$tienship')";
						$update= $data->query($sql);
							if($update){
									$nhanvienxuly=getten("userac",$idk,'Ten');
									$khohang=getten("cuahang",$idcuahang,'Name');
										$sql="insert into vanchuyenonline(IDbill,sobill,madh,mavd,madoitac,donvivc,nvxuly,trigiadon,cacmasp,khohang,diachikho,tongtien,ngaydaydon_dvvc,dienthoai_kh,diachi,tinh,quan,phuong) values ('$idphieu','$SoCTNew','$mavd','$mavd','$mavd','GHTK','$nhanvienxuly','$tongtien','$cacmasp','$khohang','$address','$tongtien','$NgayTao','$diachikh[tel]','$diachikh[address]','$diachikh[tinh]','$diachikh[quan]','$diachikh[phuong]')";
								$update= $data->query($sql);
									if($update){
										echo  "###4###Đã Khóa phiếu!###$id###$tench###$idcuahang###1###$idpasschitiet###" ;
									}
							}
					}
				 }
				 return;
			
			}
		
 	 }
     $data->closedata() ;
	 
	 

function checkDanhan($id){
	$sql="select IDchnhan,mahang,tenpt from passdonchitiet where ID='$id'";
	$dong=getdong($sql);
	return $dong;
}	 
function checkKhoaPhieu($id){
	global $data;
		
	$sql="select  count(ID) as c from passdonchitiet where IDPhieu='$id' and (IDchnhan is null || IDchnhan =0)";
	$dong=getdong($sql);
	
	$xacnhanchitiet=$dong['c'];
	$sql="select  cuahangnhan as c from passdon where ID='$id'";
	
	$dong=getdong($sql);
	$xacnhanall=$dong['c'];
	if($xacnhanchitiet && !$xacnhanall ){
		return false;
	}
	return true;
}
function layIDSPpassDonChTiet($idchitiet)
{ 	
 		 $sql = "select a.IDSP from passdonchitiet a where a.ID='$idchitiet'";
			
		$dong =getdong($sql);
	   return $dong["IDSP"];
}
function mangsoluongcuahang($idch,$idsp)
{ 	
 		 $sql = " select a.SoLuong from hanghoacuahang a where a.IDcuahang='$idch' and a.IDSP='$idsp'";
		
		$dong =getdong($sql);
	   return $dong["SoLuong"];
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