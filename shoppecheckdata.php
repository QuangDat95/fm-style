<?php  
session_start();
 //import thư viện
$root_path ='' ;
include($root_path."includes/config.php");
include($root_path."includes/removeUnicode.php");
 include($root_path."includes/class.mysql.php");
include($root_path."includes/function.php");

  	$tm = $_SESSION["root_path"] ; 
    $path = $root_path."data/tmdt.xlsx"  ;
	 
  	include( $root_path."excel/simplexlsx.class.php");
//khỏi tạo data
$data = new class_mysql();
$data->config();
$data->access();


//if(isset($_POST["DATA"])){
	$data1 = $_POST['DATA']; 
 	 $tmp = explode('*@!',$data1);
$success=0;
$fail=0;


$thang = gmdate('m', time() + 7*3600); 
$nam = gmdate('y', time() + 7*3600); 
$sp=laso(GetsoCT());
echo  $sp ."=======";
$ngaytao = gmdate('Y-n-d H:i:s', time() + 7*3600) ;
	$ngaynhap = gmdate('Y-n-d', time() + 7*3600) ;
		
		
	$mangresult=array();
	$manggiaohang=array();
	$sql="select * from datapancake";
	
	
	$query=$data->query($sql);
	$numrow=$data->num_rows($query);
	$sheets=array();
	$check=0;
	$tammangdh=array();
	$tammanggiaoh=array();
	$tammangsp=array();
		
while($r = $data->fetch_array($query)){

	//echo $r['T5']."<br>";

	if($check>=1){
	
			if(!$r['T3']){
								
				$check_uniq_sp=true;
				foreach($tammangsp as $key_un => $value_uni){
					if(trim($value_uni['masp'])==trim($r['T6'])){
								
						$tammangsp[$key_un]['soluong']=$value_uni['soluong']+$r['T8'];
								
						$check_uniq_sp=false;
					}
				}
				
				if($check_uniq_sp){
					$sql="select Name,ID,price,giabinhquan,codepro,IDGroup,code from products where codepro ='$r[T6]' limit 1";
				$dong=getdong($sql);
					$sptam=array(
						"IDSP"=> $dong['ID'] ,
						"masp"=> $dong['codepro'] ,
						"code"=> $dong['code'] ,
						"tensp"=> $dong['Name'] ,
						"idnhom"=> $dong['IDGroup'] ,
						"soluong"=>  $r['T8'] ,
						"dongia"=>(string)($r['T7']),
						"giabinhquan"=> $dong['giabinhquan'] ,
						"giamgia"=>''
 					 );  
					 array_push($tammangsp,$sptam); 
				}
 				
			}
			else{
			
				    $makm=is_array($tammangdh['vc'])?$tammangdh['vc']['maso']:$tammangdh['vc'];
					
					$idkho=1; 
						if (strlen($sp)== '1' ) $sps = "00".$sp ;
					   if (strlen($sp)== '2' ) $sps = "0".$sp ;
					   if (strlen($sp)>2) $sps =$sp ;
					   $sct ="B".$nam.$thang. "TD.".$idkho.".".$sps;
					  // echo $sps;
					 $sp++;
					$arr=array(
					"idkho"=>(int)($tammangdh['team']['idkho']),
					"idkhach"=>$tammangdh['kh']['ID'],
					"ngayxuat"=>$tammangdh['ngaytao'],
					"lydoxuat"=>$tammangdh['team']['lydo'],
					"tigia"=>$tammangdh['giamgia'],
					"vat"=>'',
					"ghichu"=>$tammangdh['ghichu'],
					"ngaytao"=>$ngaytao,
					"ngaynhap"=>$ngaynhap,
					"idk"=>'',
					"makm"=>$makm,
					"name"=>$tammangdh['kh']['Name'],
					"address"=>$tammangdh['kh']['address'],
					"tenlydo"=>'',
					"idban"=>$tammangdh['nv']['ID'],
					"nguoitao"=>$tammangdh['nvxacnhan'],
					"tientra"=>$tammangdh['togtien'],
					"sct"=>$sct,
					"idchol"=>$tammangdh['team']['idchol'],
					);
				
					$dong='';
					if(checkPhieuNhapxuat1($tammangdh["madh"])){
						$dong= insertPhieunhapxuat($arr);
						//echo $tammangdh['madh']."<br>";
					}else{
						echo 'Dòng'.$success.'! Dữ liệu đã tồn tại';
					}
						
                        if($dong){
							
                            $IDPhieu=$dong['ID'];
                             $MaNV=$dong['diachiN'];
							 $IDNhaCC= $dong['IDNhaCC'];
							  $idkho= $dong['IDKho'];
							 $tongtienmua=0;	
							 $tongtientam=0;
                            //insert vc online
                            foreach($tammangsp as $k => $vl){
									 $tongtientam+=($vl['dongia']*$vl['soluong']);
							}
                             $arrv=array(
                                    "IDbill"=>$IDPhieu,
                                   "sobill"=>$sct,
                                    "madh"=>$tammanggiaoh['madh'],
                                    "Fbpage"=>$tammanggiaoh['fbpage'],
                                    "mavd"=>$tammanggiaoh['mavdpk'],
                                    "madoitac"=>$tammanggiaoh['madoitac'],
                                    "donvivc"=>$tammanggiaoh['dvvanch'],
                                    "phitravc"=>$tammanggiaoh['phitravc'],
                                    "phithukh"=>$tammanggiaoh['phithuvc'],
                                    "nvxuly"=>$tammanggiaoh['nvxuly'],
                                    "nvcskh"=>$tammanggiaoh['nvcskh'],
                                    "nvxacnhan"=>$tammanggiaoh['nvxacnhan'],
									"nvgui"=>$tammanggiaoh['nvgui'],
									"dtkh"=>$tammanggiaoh['dtkh'],
									"nvtaodon"=>$tammanggiaoh['nvtaodon'],
									"ngaytaodon"=>$tammanggiaoh['ngaytaodon'],
									"nguondon"=>$tammanggiaoh['nguondon'],
									"togtien"=>$tongtientam,
									"tinh"=>$tammanggiaoh['tinh'],
									"quan"=>$tammanggiaoh['quan'],
									"phuong"=>$tammanggiaoh['phuong'],
									"diachi"=>$tammanggiaoh['diachi'],
									"giamgia"=>$tammanggiaoh['giamgia'],
									"trigiadon"=>$tammanggiaoh['trigiadon'],
									"cacmasanpham"=>$tammanggiaoh['cacmasanpham'],
									"khohang"=>$tammanggiaoh['khohang'],
									"diachikho"=>$tammanggiaoh['diachikho'],
									"dongthoigiantrangthaidon"=>$tammanggiaoh['dongthoigiantrangthaidon'],
									"tinnhantaodon"=>$tammanggiaoh['tinnhantaodon'],
									"ngaydaydon_dvvc"=>$tammanggiaoh['ngaydaydon_dvvc'],
									"chuyenkhoan"=>$tammanggiaoh['chuyenkhoan'],
                                    );
                                    //echo "bảng vận chuyển <br>";
                                   if(!insertVanchuyenonline($arrv)){
										echo 'Lỗi thêm vào dữ liệu bảng vận chuyển online dòng'.($success+1);
											xoaPhieunhap($IDPhieu);
										return;
									}
									  foreach($tammangsp as $k => $vl){
                                    $arr1=array(
                                    "IDPhieu"=>$IDPhieu,
                                    "IDSP"=>$vl['IDSP'],
                                    "mahang"=>$vl['masp'],
                                    "tenpt"=>$vl['tensp'],
                                    "SoLuong"=>$vl['soluong'],
                                    "DonGia"=>$vl['dongia'],
                                    "LoaiTien"=>$value['ghichu'],
                                    "chietkhau"=>'',
                                    "Loai"=>'',
                                    "giavon"=>$vl['giabinhquan'],
                                    "idnhom"=>$vl['idnhom'],
                                    "idtao"=>'',
                                    "idnv"=>'',
                                    "idban"=>'',
                                    
                                );
							
                                //echo "bảng xuất bán hàng <br>";
                                   	if(insertXuatbanhang($arr1)){
									
											$arrtsp=array(
											'x'=>$vl['soluong'],
											'key'=>$vl['IDSP'],
											'IDKho'=>$idkho,
											);
										 trusanpham($arrtsp);
									}
									else{
										xoaxuatbanhang($IDPhieu);
										xoaPhieunhap($IDPhieu);
									}
							}
									$tongtienmua=sotiendamua($sct);
										congdiem($tongtienmua,$IDNhaCC);
                            $success++;	
                    }
                    else{
                            $fail++;
                    }
			
			
                    $tammangdh=array();
                    $tammanggiaoh=array();
                    $tammangsp=array();
            
                    $mangsp=array();
                    $mangnv=array();
                    $mangkh=array();
                    $mangvc=array();
                    $mangtinh=array();
                    $mangquan=array();
                    $mangphuong=array();
                    $mangdiachi=array();
                    $mangteam=array();
            
                    //$arrmanv=tachmanv($r['T19']);
                    $tammangdh=array(
                        "madh"=>$r['T3'],
                      	 "ghichu"=>$r['T2'].' '.$r['T3'].' '.$r['T4'].' '.$r['T5'],
                        "giamgia"=>'',
                        "ngaytao"=>'',
                        "nvxacnhan"=>'',
                        "togtien"=>'',
                    );
                    //nhân vien
                  /*  if(checkExists('MaNV',$arrmanv["manv"],"userac")){
                        $mangnv=checkExists('MaNV',$arrmanv["manv"],"userac");
                    }
                    else{
                        $mangnv=array("manv"=>$arrmanv["manv"],"check"=>false);
                    }*/
                    //voucher
                   /* if(checkExists('maso',$arrmanv["voucher"],"phieukhuyenmai")){
                    
                        $vctam=checkExists('maso',$arrmanv["voucher"],"phieukhuyenmai");
                        if($r['T54']!=$vctam["sotien"]){
                                $mangvc='';
                                
                        }
                        else{
                            $mangvc=checkExists('maso',$arrmanv["voucher"],"phieukhuyenmai");
                        }
                        
                    }
                    else{
                        $mangvc='';
                    }*/
                
                   /* 
                    //tinh
                    if(checktinh($r['T27'])){
                        $mangtinh=checktinh($r['T27']);
                    }
                    else{
                        $mangtinh=$r['T27'];
                    }
                    
                    //quan
                    if(checkquan($r['T26'])){
                        $mangquan=checkquan($r['T26']);
                    }
                    else{
                        $mangquan=$r['T26'];
                    }
                    //phuong
                    if(checkphuong($r['T25'])){
                        $mangphuong=checkphuong($r['T25']);
                    }
                    else{
                        $mangphuong=$r['T25'];
                    }
                    
                    //diachi
                    $mangdiachi=$r['T28'];
                    
                    */
                    $sql="select Name,ID,price,giabinhquan,codepro,IDGroup,code from products where codepro ='$r[T6]' limit 1";
					
					
                    $dong=getdong($sql);
                    $sptam=array(
                        "IDSP"=> $dong['ID'] ,
                        "masp"=> $dong['codepro'] ,
						"code"=> $dong['code'] ,
                        "tensp"=> $dong['Name'] ,
						"idnhom"=> $dong['IDGroup'] ,
                        "soluong"=>  $r['T8'] ,
                        "dongia"=>(string)($r['T7']),
                        "giabinhquan"=> $dong['giabinhquan'] ,
                        "giamgia"=>''
                    );   
                        //khách hàng
						$checkkh=checkExists('makh',replacesdt($r['T5']),"customer");
						
                    if($checkkh){
                        $mangkh=$checkkh;
                    }
                    else{
						$checkkh1=checkExists('makh',trim($r['T5']),"customer");
						
						if($checkkh1){
							 $mangkh=$checkkh1;
						}
						else{
						
							//$mangkh=array("sdt"=>$r[19]);
							$quan=is_array($mangquan)?$mangquan["ID"]:$mangquan;
							 $IDKhuVuc=is_array($mangtinh)?$mangtinh["ID"]:$mangtinh;
							$phuong=is_array($mangphuong)?$mangphuong["ID"]:$mangphuong;
							$arrtam=array(
							'name'=>$r['T4'],
							'makh'=>replacesdt($r['T5']),
							'address'=>"",
							'type'=>0,
							'tel'=>replacesdt($r['T5']),
							'ngaysinh'=>'',
							  'IDKhuVuc'=>"",
							'quan'=>"",
							'phuong'=>"",
							
							);
							$mangkh=insertKh($arrtam);
						}	
                    }
                    
                   //check team
					$checkteam=checkTeam(trim($r['T2']));
					$checkcuahang=checkCuahang(trim($r['T2']));
                    if($checkteam){
                        $mangteam =$checkteam;
                    }
                    else if($checkcuahang){
                            $mangteam =$checkcuahang;
                    }else{
						
						echo 'Mã cửa hàng không tồn tại! Đơn thứ '.($check+1);
						   break;
                    }
                    array_push($tammangsp,$sptam);
                    $tammanggiaoh=array(
						"madh"=>$r['T3'],
						"fbpage"=>'',
						"mavdpk"=>$r['T3'],
						"madoitac"=>'',
						"dvvanch"=>'',
						"phitravc"=>'',
						"phithuvc"=>'',
						"nvxuly"=>'',
						"nvcskh"=>'',
						"nvxacnhan"=>'',
						"nvgui"=>'',
						"dtkh"=>$r['T5'],
						"nvtaodon"=>'',
						"ngaytaodon"=>'',
						"nguondon"=>'',
						"togtien"=>'',
						"tinh"=>'',
						"quan"=>'',
						"phuong"=>'',
						"diachi"=>'',
						"giamgia"=>'',
						"trigiadon"=>'',
						"cacmasanpham"=>'',
						"khohang"=>'',
						"diachikho"=>'',
						"dongthoigiantrangthaidon"=>'',
						"tinnhantaodon"=>'',
						"ngaydaydon_dvvc"=>'',
						"chuyenkhoan"=>'',
					);
                
                    $tammangdh["sp"]=$mangsp;
                    $tammangdh["nv"]=$mangnv;
                    $tammangdh["kh"]=$mangkh;
                    $tammangdh["vc"]=$mangvc;
                    $tammangdh["tinh"]=$mangtinh;
                    $tammangdh["quan"]=$mangquan;
                    $tammangdh["phuong"]=$mangphuong;
                    $tammangdh["diachi"]=$mangdiachi;
                    $tammangdh["team"]=$mangteam;
			
                
                
		    }
            
     }
	 if($check==($numrow-1)){
          
		//$makm=is_array($tammangdh['vc'])?$tammangdh['vc']['maso']:$tammangdh['vc'];
			
			$idkho=1; 
				if (strlen($sp)== '1' ) $sps = "00".$sp ;
			if (strlen($sp)== '2' ) $sps = "0".$sp ;
			if (strlen($sp)>2) $sps =$sp ;
			$sct ="B".$nam.$thang. "TD.".$idkho.".".$sps;
			$sp++;
			$arr=array(
				"idkho"=>(int)($tammangdh['team']['idkho']),
				"idkhach"=>$tammangdh['kh']['ID'],
				"ngayxuat"=>$tammangdh['ngaytao'],
				"lydoxuat"=>$tammangdh['team']['lydo'],
				"tigia"=>$tammangdh['giamgia'],
				"vat"=>'',
				"ghichu"=>$tammangdh['ghichu'],
				"ngaytao"=>$ngaytao,
				"ngaynhap"=>$ngaynhap,
				"idk"=>'',
				"makm"=>$makm,
				"name"=>$tammangdh['kh']['Name'],
				"address"=>$tammangdh['kh']['address'],
				"tenlydo"=>'',
				"idban"=>$tammangdh['nv']['ID'],
				"nguoitao"=>$tammangdh['nvxacnhan'],
				"tientra"=>$tammangdh['togtien'],
				"sct"=>$sct,
				"idchol"=>$tammangdh['team']['idchol'],
			);
			$dong='';
			if(checkPhieuNhapxuat1($tammangdh["madh"])){
				$dong= insertPhieunhapxuat($arr);
				//echo $tammangdh['madh']."<br>";
			}
			else{
				echo 'Dòng'.$success.'! Dữ liệu đã tồn tại';
			}
			
			if($dong){
			
				$IDPhieu=$dong['ID'];
				 $MaNV=$dong['diachiN'];
				$IDNhaCC= $dong['IDNhaCC'];
				 $idkho= $dong['IDKho'];
				  $tongtienmua=0;
				  
				   $tongtientam=0;
                            //insert vc online
                            foreach($tammangsp as $k => $vl){
									 $tongtientam+=($vl['dongia']*$vl['soluong']);
							}
							 $arrv=array(
                                    "IDbill"=>$IDPhieu,
                                   "sobill"=>$sct,
                                    "madh"=>$tammanggiaoh['madh'],
                                    "Fbpage"=>$tammanggiaoh['fbpage'],
                                    "mavd"=>$tammanggiaoh['mavdpk'],
                                    "madoitac"=>$tammanggiaoh['madoitac'],
                                    "donvivc"=>$tammanggiaoh['dvvanch'],
                                    "phitravc"=>$tammanggiaoh['phitravc'],
                                    "phithukh"=>$tammanggiaoh['phithuvc'],
                                    "nvxuly"=>$tammanggiaoh['nvxuly'],
                                    "nvcskh"=>$tammanggiaoh['nvcskh'],
                                    "nvxacnhan"=>$tammanggiaoh['nvxacnhan'],
									"nvgui"=>$tammanggiaoh['nvgui'],
									"dtkh"=>$tammanggiaoh['dtkh'],
									"nvtaodon"=>$tammanggiaoh['nvtaodon'],
									"ngaytaodon"=>$tammanggiaoh['ngaytaodon'],
									"nguondon"=>$tammanggiaoh['nguondon'],
									"togtien"=>$tongtientam,
									"tinh"=>$tammanggiaoh['tinh'],
									"quan"=>$tammanggiaoh['quan'],
									"phuong"=>$tammanggiaoh['phuong'],
									"diachi"=>$tammanggiaoh['diachi'],
									"giamgia"=>$tammanggiaoh['giamgia'],
									"trigiadon"=>$tammanggiaoh['trigiadon'],
									"cacmasanpham"=>$tammanggiaoh['cacmasanpham'],
									"khohang"=>$tammanggiaoh['khohang'],
									"diachikho"=>$tammanggiaoh['diachikho'],
									"dongthoigiantrangthaidon"=>$tammanggiaoh['dongthoigiantrangthaidon'],
									"tinnhantaodon"=>$tammanggiaoh['tinnhantaodon'],
									"ngaydaydon_dvvc"=>$tammanggiaoh['ngaydaydon_dvvc'],
									"chuyenkhoan"=>$tammanggiaoh['chuyenkhoan'],
                                 );
						//echo "bảng vận chuyển <br>";
						 if(!insertVanchuyenonline($arrv)){
							echo 'Lỗi thêm vào dữ liệu bảng vận chuyển online dòng'.($success+1);
								xoaPhieunhap($IDPhieu);
							return;
						}
				foreach($tammangsp as $k => $vl){
						$arr1=array(
						"IDPhieu"=>$IDPhieu,
						"IDSP"=>$vl['IDSP'],
						"mahang"=>$vl['masp'],
						"tenpt"=>$vl['tensp'],
						"SoLuong"=>$vl['soluong'],
						"DonGia"=>$vl['dongia'],
						"LoaiTien"=>$value['ghichu'],
						"chietkhau"=>$value['ngaytao'],
						"Loai"=>'',
						"giavon"=>$vl['giabinhquan'],
						"idnhom"=>$vl['idnhom'],
						"idtao"=>'',
						"idnv"=>'',
						"idban"=>'',
						
					);
					//echo "bảng xuất bán hàng <br>";
					//var_dump($arr1);
					if(insertXuatbanhang($arr1)){
										
							$arrtsp=array(
							'x'=>$vl['soluong'],
							'key'=>$vl['IDSP'],
							'IDKho'=>$idkho,
							);
							 trusanpham($arrtsp);
						}
					
					else{
										xoaxuatbanhang($IDPhieu);
										xoaPhieunhap($IDPhieu);
					}
				}
					 $tongtienmua+=sotiendamua($sct);			
					congdiem($tongtienmua,$IDNhaCC);
				//insert vc online
				
				
				$success++;	
		}
		else{
				$fail++;
		}
	
	
		$tammangdh=array();
		$tammanggiaoh=array();
		$tammangsp=array();
		
	}
	if($check==0){
	
			$mangsp=array();
			$mangnv=array();
			$mangkh=array();
			$mangvc=array();
			$mangtinh=array();
			$mangquan=array();
			$mangphuong=array();
			$mangdiachi=array();
			$mangteam=array();
	
			//$arrmanv=tachmanv($r['T19']);
				$tammangdh=array(
					"madh"=>$r['T3'],
					"ghichu"=>$r['T2'].' '.$r['T3'].' '.$r['T4'].' '.$r['T5'],
					"giamgia"=>'',
					"ngaytao"=>'',
					"nvxacnhan"=>'',
					"togtien"=>'',
				);
				//nhân vien
				/*if(checkExists('MaNV',$arrmanv["manv"],"userac")){
					$mangnv=checkExists('MaNV',$arrmanv["manv"],"userac");
				}
				else{
					$mangnv=array("manv"=>$arrmanv["manv"],"check"=>false);
				}*/
				//voucher
				/*if(checkExists('maso',$arrmanv["voucher"],"phieukhuyenmai")){
					$vctam=checkExists('maso',$arrmanv["voucher"],"phieukhuyenmai");
					if($r['T54']!=$vctam["sotien"]){
							$mangvc=$arrmanv["voucher"];
					}
					else{
						$mangvc=checkExists('maso',$arrmanv["voucher"],"phieukhuyenmai");
					}
				}
				else{
					$mangvc=$arrmanv["voucher"];
				}*/
			
				//tinh
				/*if(checktinh($r['T27'])){
					$mangtinh=checktinh($r['T27']);
				}
				else{
					$mangtinh=$r['T27'];
				}*/
				
				//quan
				/*if(checkquan($r['T26'])){
					$mangquan=checkquan($r['T26']);
				}
				else{
					$mangquan=$r['T26'];
				}*/
				//phuong
				/*if(checkphuong($r['T25'])){
					$mangphuong=checkphuong($r['T25']);
				}
				else{
					$mangphuong=$r['T25'];
				}*/
				
				//diachi
				//$mangdiachi=$r['T28'];
				
				
			    $sql="select Name,ID,price,giabinhquan,codepro,IDGroup,code from products where codepro ='$r[T6]' limit 1";
				$dong=getdong($sql);
 				$sptam=array(
				    "IDSP"=> $dong['ID'] ,
					"masp"=> $dong['codepro'] ,
					"code"=> $dong['code'] ,					
					"tensp"=> $dong['Name'] ,
					"idnhom"=> $dong['IDGroup'] ,
					"soluong"=>  $r['T8'] ,
					"dongia"=>(string)($r['T7']),
					"giabinhquan"=> $dong['giabinhquan'] ,
					"giamgia"=>''
 				 );   
				 //khách hàng
						$checkkh=checkExists('makh',replacesdt($r['T5']),"customer");
					
                    if($checkkh){
                        $mangkh=$checkkh;
                    }
                    else{
						$checkkh1=checkExists('makh',trim($r['T5']),"customer");
							
						if($checkkh1){
							 $mangkh=$checkkh1;
						}
						else{
						
							//$mangkh=array("sdt"=>$r[19]);
						
							$quan=is_array($mangquan)?$mangquan["ID"]:$mangquan;
							 $IDKhuVuc=is_array($mangtinh)?$mangtinh["ID"]:$mangtinh;
							$phuong=is_array($mangphuong)?$mangphuong["ID"]:$mangphuong;
							$arrtam=array(
							'name'=>$r['T4'],
							'makh'=>replacesdt($r['T5']),
							'address'=>"",
							'type'=>0,
							'tel'=>replacesdt($r['T5']),
							'ngaysinh'=>'',
							  'IDKhuVuc'=>"",
							'quan'=>"",
							'phuong'=>"",
							
							);
							$mangkh=insertKh($arrtam);
						}	
                    }
				//check team
				//check team
					$checkteam=checkTeam(trim($r['T2']));
					$checkcuahang=checkCuahang(trim($r['T2']));
                    if($checkteam){
                        $mangteam =$checkteam;
                    }
                    else if($checkcuahang){
                            $mangteam =$checkcuahang;
                    }else{
						
						echo 'Mã cửa hàng không tồn tại! Đơn thứ '.($check+1);
						   break;
                    }
				array_push($tammangsp,$sptam);
				 $tammanggiaoh=array(
						"madh"=>$r['T3'],
						"fbpage"=>'',
						"mavdpk"=>$r['T3'],
						"madoitac"=>'',
						"dvvanch"=>'',
						"phitravc"=>'',
						"phithuvc"=>'',
						"nvxuly"=>'',
						"nvcskh"=>'',
						"nvxacnhan"=>'',
						"nvgui"=>'',
						"dtkh"=>$r['T5'],
						"nvtaodon"=>'',
						"ngaytaodon"=>'',
						"nguondon"=>'',
						"togtien"=>'',
						"tinh"=>'',
						"quan"=>'',
						"phuong"=>'',
						"diachi"=>'',
						"giamgia"=>'',
						"trigiadon"=>'',
						"cacmasanpham"=>'',
						"khohang"=>'',
						"diachikho"=>'',
						"dongthoigiantrangthaidon"=>'',
						"tinnhantaodon"=>'',
						"ngaydaydon_dvvc"=>'',
						"chuyenkhoan"=>'',
					);
			
			$tammangdh["sp"]=$mangsp;
			$tammangdh["nv"]=$mangnv;
			$tammangdh["kh"]=$mangkh;
			$tammangdh["vc"]=$mangvc;
			$tammangdh["tinh"]=$mangtinh;
			$tammangdh["quan"]=$mangquan;
			$tammangdh["phuong"]=$mangphuong;
			$tammangdh["diachi"]=$mangdiachi;
			$tammangdh["team"]=$mangteam;
	
	}
	 $check++;	
}

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

function checkphuong($chuoi){
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
	$makh=replacesdt($arr["makh"]);
	$address=$arr["address"]?addslashes($arr["address"]):"";
	$type=$arr["type"];
	$tel=replacesdt($arr["tel"]);
	$ngaysinh=$arr["ngaysinh"];
	$quan=$arr["quan"];
	$phuong=$arr["phuong"];
	$sql="insert into customer (Name,makh,address,type,tel,ngaytao,ngaysinh,quan,phuong,nhomkh)
	 values('$name','$makh','$address','$type','$tel','$ngay','$ngaysinh','$quan','$phuong',8)";
	 
	 $update=$data->query($sql);
	 	$sql="select * from customer where makh='$tel' and tel='$tel'";
		$dong=getdong($sql);
	 	return $dong;
	 
}

function checkTeam($team){
global $data;
	$sql="select ID,ma from lydonhapxuat where ma='$team'";
	$dong=getdong($sql);
	$result='';
	if($dong['ma']){
		$result=array("idkho"=>1105,"lydo"=>$dong['ID'],'idchol'=>$dong['ID']);
	}
	else{
		
		return false;
	}
	return $result;
}

function checkCuahang($team){
global $data;
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
			echo $sql ."<br>";
		if($numrow==0){
			
			return true;
		}
		
		return false;
}

function checkPhieuNhapxuat1($madh){
global $data;
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
	$idkho=$arr['idkho'];
	$sochungtu=$arr['sct'];
		$idkhach=$arr['idkhach'];
	$id=$arr['IDNhap'];
	$ngayxuat=$arr['ngayxuat'];
	$lydoxuat=$arr['lydoxuat'];
	$tigia=laso($arr['tigia']);
	$vat=laso($arr['vat']);
	$ghichu=$arr['ghichu'];
	$ngaytao=$arr['ngaytao'];
	$ngaynhap=$arr['ngaynhap'];
	$idk=$arr['idk'];
	$makm=$arr['makm'];
	$name=addslashes($arr['name']);
	$address=addslashes($arr['address']);
	$tenlydo=$arr['tenlydo'];
	$idban=$arr['idban'];
	$nguoitao=$tennguoitao.'-'.$idnguoitao;
	$tientra=$arr['tientra'];
	$idchol=$arr['idchol'];
	$sql = "insert into phieunhapxuat set Loai='1' ,IDKho ='$idkho',IDNhaCC ='$idkhach' ,IDNhap ='$id' ,NgayNhap ='$ngaynhap' ,SoCT='$sochungtu' ,LyDo='$lydoxuat' ,SoNgayNo='0' ,IDTKNo='0' ,IDTKCo='0' ,TiGia ='$tigia' ,VAT='$vat' ,GhiChu='$ghichu' ,NgayTao='$ngaytao',ngaykhoa='$ngaytao' ,IDTao='$idnguoitao' ,NguoiGiao='$makm' ,dakhoa=1,dahuy=0,ten='$name',diachi='$address', tenlydo='$tenlydo'   ,diachiN='$idban' ,nguoitao='$nguoitao',IDKhoa='$idnguoitao',tientra='$tientra',idchOL='$idchol'";
//echo $sql;
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
	$mahang=$arr['mahang'];
	$code=$arr['code'];
	$tenpt=$arr['tenpt'];
	$SoLuong=$arr['SoLuong'];
	$DonGia=laso($arr['DonGia']);
	$LoaiTien=laso($arr['LoaiTien']);
	$chietkhau=$arr['chietkhau'];
	$Loai=$arr['Loai'];
	$giavon=$arr['giavon'];
	$idnhom=$arr['idnhom'];
	$idtao=$arr['idtao'];
	$idnv=$arr['idnv'];
	
	 $sql="INSERT INTO xuatbanhang (IDPhieu,IDSP,mahang,tenpt,SoLuong,DonGia,LoaiTien,Thue,BaoHanh,Ghichu,chietkhau,Loai,giavon,IDnhom,IDTao,IDNV,mota) VALUES('$IDPhieu','$IDSP','$mahang','$tenpt','$SoLuong','$DonGia','$LoaiTien','$Thue','$BaoHanh','$Ghichu','$chietkhau','$Loai','$giavon','$idnhom','$idtao','$idnv','$code')";
	//echo $sql;
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
	$tinh=$arr['tinh'];
	$quan=$arr['quan'];
	$phuong=$arr['phuong'];
	$diachi=$arr['diachi'];
	$giamgia=$arr['giamgia'];
	$trigiadon=$arr['trigiadon'];
	$cacmasanpham=$arr['cacmasanpham'];
	$khohang=$arr['khohang'];
	$diachikho=$arr['diachikho'];
	$dongthoigiantrangthaidon=$arr['dongthoigiantrangthaidon'];
	$tinnhantaodon=$arr['tinnhantaodon'];
	$ngaydaydon_dvvc=$arr['ngaydaydon_dvvc'];
	$chuyenkhoan=$arr['chuyenkhoan'];

	 $sql="INSERT INTO vanchuyenonline (IDbill,sobill,madh,Fbpage,mavd,madoitac,donvivc,phitravc,phithukh,nvxuly,nvcskh,giamgia,trigiadon,cacmasp,khohang,diachikho,dongthoigiantrangthaidon,tinnhantaodon,ngaydaydon_dvvc,chuyenkhoan,dienthoai_kh,diachi,tinh,quan,phuong,loai,tongtien)  
	 VALUES('$IDbill','$sobill','$madh','$Fbpage','$mavd','$madoitac','$donvivc','$phitravc','$phithukh','$nvxuly','$nvcskh','$giamgia','$trigiadon','$cacmasanpham','$khohang','$diachikho','$dongthoigiantrangthaidon','$tinnhantaodon','$ngaydaydon_dvvc','$chuyenkhoan','$dtkh','$diachi','$tinh','$quan','$phuong',2,'$togtien')";
	
	 $update=$data->query($sql);
	 	return $update;
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
 			 $sql = " update customer set sotiendamua = sotiendamua + ".$tong. ", diemtichluy= diemtichluy + ". ($tong / 10000)." where ID = '$IDNhaCC'  " ;
 	          $update=$data->query($sql);
			  return $update;
}
 
 
function trusanpham($arr){
global $data;
	$x=$arr['x'];
	$key=$arr['key'];
	$IDKho=$arr['IDKho'];
 	$sql="update hanghoacuahang set SoLuong = SoLuong - $x  where IDSP = '$key'  and IDcuahang =  '$IDKho'";
 	
 $update=$data->query($sql);
 return $update;
}

function replacesdt($sdt){
	$result='';
	$sdt=trim($sdt);
	if($sdt[0]=="+"){
		$result=substr($sdt,3);
		$result='0'.$result;
	}
	else if($sdt[0]==8 && $sdt[1]==4){
		$result=substr($sdt,2);
		if($result[0]!=0){
			$result='0'.$result;
		}
		
	}
	else{
		 $result=$sdt;
	}	
	
	return $result;
}
?>