<?php  
session_start();
$idk = $_SESSION["LoginID"] ; if (  $idk == '') return ;
 //import thư viện
$root_path ='' ;
include($root_path."includes/config.php");
include($root_path."includes/removeUnicode.php");
 include($root_path."includes/class.mysql.php");
include($root_path."includes/function.php");

  	$tm = $_SESSION["root_path"] ; 
    $path = $root_path."data/orders.xlsx"  ;
	 
  	include( $root_path."excel/simplexlsx.class.php");
//khỏi tạo data
$data = new class_mysql();
$data->config();
$data->access();
   $idcuahang = $_SESSION["se_kho"];
   if($idcuahang!=1137){
   		$idcuahang=1105;
   }

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
	$giamgiathuc=0;
	 
//trường bắt buôt có

//T3,T4,T5,T6,T8,T9,T10,T13,T14,T16,T17,T20,T31,T33,T36,T43,T45,T48,T80,T27,T26,T25,T28,T55,T57,T66,T67,T68,T83,T86,T97,T75
while($r = $data->fetch_array($query)){
		 if($check==0){
			
					//kiểm tra giao hàng 1 phần
							//#GH1P#PCAKES355129O1138676 echo $r['T64'];
						$gh1phan=false;
						$gh1phanvdtruoc='';
						if($r['T64']){
							$tgh1p=explode("#",$r['T64']);
							
							if($tgh1p[1]=="GH1P"){
								$gh1phan=true;
								$gh1phanvdtruoc=trim(explode("GH1P",$tgh1p[2])[0]);
							}
							
						}
						
						
					$mangsp=array();
					$mangnv=array();
					$mangkh=array();
					$mangvc=array();
					$mangtinh=array();
					$mangquan=array();
					$mangphuong=array();
					$mangdiachi=array();
					$mangteam=array();
					$giamgiathuc=$r['T55']-$r['T56'];
					$matam=$r['T5']?$r['T5']:$r['T3'];
					$arrmanv=tachmanv($r['T19']);
						//var_dump($arrmanv);
						$tammangdh=array(
							"madh"=>$r['T5']?$r['T5']:$r['T3'],
							"ghichu"=>$matam.' '.$r['T19'].' '.$r['T20'].' '.$r['T65'],
							"giamgia"=>$r['T55'],
							"ngaytao"=>$r['T33'],
							"nvxacnhan"=>$r['T16'],
							"togtien"=>$r['T83'],
						);
						//nhân vien
						if(checkExists('MaNV',$arrmanv["manv"],"userac")){
							$mangnv=checkExists('MaNV',$arrmanv["manv"],"userac");
						}
						else{
							$mangnv=array("manv"=>$arrmanv["manv"],"check"=>false);
						}
						//voucher
						if(checkExists('maso',$arrmanv["voucher"],"phieukhuyenmai")){
							$mangvc=checkExists('maso',$arrmanv["voucher"],"phieukhuyenmai");
							/*$vctam=checkExists('maso',$arrmanv["voucher"],"phieukhuyenmai");
							if($r['T54']!=$vctam["sotien"]){
									$mangvc=$arrmanv["voucher"];
							}
							else{
								$mangvc=checkExists('maso',$arrmanv["voucher"],"phieukhuyenmai");
							}*/
						}
						else{
							$mangvc=$arrmanv["voucher"];
						}
					
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
						
						
						$sql="select Name,ID,price,giabinhquan,codepro,IDGroup,code from products where codepro ='$r[T43]' limit 1";
						$dong=getdong($sql);
						$chietkhau=0;
							if($r['T48']>0){
								$chietkhau=($r['T56']/$r['T48'])*100;
							}
						$sptam=array(
							"IDSP"=> $dong['ID'] ,
							"masp"=> $dong['codepro'] ,
							"code"=> $dong['code'] ,					
							"tensp"=> $dong['Name'] ,
							"idnhom"=> $dong['IDGroup'] ,
							"soluong"=>  $r['T45'] ,
							"dongia"=>$r['T48'],
							"giamgiasp"=>$r['T56'],
							"chietkhau"=>$chietkhau,
							"giabinhquan"=> $dong['giabinhquan'] ,
							"giamgia"=>$r['T55']
						 );   
						  //khách hàng
						  
						  if(trim($r['T20'])){
						 	$mangkh=[];
							$checkkh=checkExists('makh',replacesdt(trim($r['T20'])),"customer");
								
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
									'makh'=>replacesdt(trim($r['T20'])),
									'address'=>$mangdiachi,
									'type'=>0,
									'tel'=>replacesdt(trim($r['T20'])),
									'ngaysinh'=>$arrmanv["ngaysinh"]?$arrmanv["ngaysinh"]:"0000-00-00",
									  'IDKhuVuc'=>$IDKhuVuc,
									'quan'=>$quan,
									'phuong'=>$phuong,
									
									);
									$mangkh=insertKh($arrtam);
								}	
							}
						}
						else{
							echo 'Khách hàng rỗng! Đơn thứ '.($success+1);
								   break;
						}
						
						if(!$mangkh["ID"]){
							echo 'Khách hàng rỗng! Đơn thứ '.($success+1);
								   break;
						}
						 //check team
						 if($arrmanv['mach']){
						 
							$checkteam=checkTeam(trim($arrmanv['mach']));
							$checkcuahang=checkCuahang(trim($arrmanv['mach']));
							if($checkteam){
								$mangteam =$checkteam;
							}
							else if($checkcuahang){
									$mangteam =$checkcuahang;
							}else{
								
								echo 'Mã cửa hàng không tồn tại! Đơn thứ '.($success+1);
								   break;
							}
						}
						else{
							echo 'Mã cửa hàng không tồn tại! Đơn thứ '.($success+1);
								   break;
						}
						array_push($tammangsp,$sptam);
						$tammanggiaoh=array(
						"madh"=>$r['T5']?$r['T5']:$r['T3'],
						"fbpage"=>$r['T4'],
						"mavdpk"=>$r['T5']?$r['T5']:$r['T3'],
						"madoitac"=>$r['T7'],
						"dvvanch"=>$r['T8'],
						"phitravc"=>$r['T9'],
						"phithuvc"=>$r['T10'],
						"nvxuly"=>$r['T13'],
						"nvcskh"=>$r['T14'],
						"nvxacnhan"=>$r['T16'],
						"nvgui"=>$r['T17'],
						"dtkh"=>$r['T20'],
						"nvtaodon"=>$r['T31'],
						"ngaytaodon"=>$r['T33'],
						"nguondon"=>$r['T36'],
						"togtien"=>$r['T83'],
						"tinh"=>$r['T27'],
						"quan"=>$r['T26'],
						"phuong"=>$r['T25'],
						"diachi"=>$r['T28'],
						"giamgia"=>$r['T55'],
						"trigiadon"=>$r['T57'],
						"cacmasanpham"=>$r['T66'],
						"khohang"=>$r['T67'],
						"diachikho"=>$r['T68'],
						"dongthoigiantrangthaidon"=>$r['T86'],
						"tinnhantaodon"=>$r['T89'],
						"ngaydaydon_dvvc"=>$r['T100'],
						"chuyenkhoan"=>$r['T76'],
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
	
	if($check>=1){
		
			if(!$r['T3']){
			
				
				$check_uniq_sp=true;
				foreach($tammangsp as $key_un => $value_uni){
					if($value_uni['masp']==$r['T43']){
						
						$tammangsp[$key_un]['soluong']=$value_uni['soluong']+$r['T45'];
						$tammangsp[$key_un]['giamgiasp']=$value_uni['giamgiasp']+$r['T56'];
						if($r['T48']>0){
							
							$tammangsp[$key_un]['chietkhau']=$value_uni['chietkhau']+($r['T56']/$r['T48'])*100;
						//	echo $value_uni['chietkhau'];
						}
						$check_uniq_sp=false;
					}
				}
				
				$giamgiathuc=$giamgiathuc-$r['T56'];
				
				if($check_uniq_sp){
					$sql="select Name,ID,price,giabinhquan,codepro,IDGroup,code from products where codepro ='$r[T43]' limit 1";
				$dong=getdong($sql);
				$chietkhau=0;
					if($r['T48']>0){
						$chietkhau=($r['T56']/$r['T48'])*100;
					}
					$sptam=array(
						"IDSP"=> $dong['ID'] ,
						"masp"=> $dong['codepro'] ,
						"code"=> $dong['code'] ,
						"tensp"=> $dong['Name'] ,
						"idnhom"=> $dong['IDGroup'] ,
						"soluong"=>  $r['T45'] ,
						"dongia"=>$r['T48'],
						"giamgiasp"=>$r['T56'],
						"chietkhau"=>$chietkhau,
						"giabinhquan"=> $dong['giabinhquan'] ,
						"giamgia"=>$r['T55']
 					 );  
					 array_push($tammangsp,$sptam); 
				}
 				
			}
			else{
			//$tammangdh['giamgia']=$giamgiathuc;
		
				    $makm=is_array($tammangdh['vc'])?$tammangdh['vc']['maso']:$tammangdh['vc'];
					
					$idkho=1; 
						if (strlen($sp)== '1' ) $sps = "00".$sp ;
					   if (strlen($sp)== '2' ) $sps = "0".$sp ;
					  if (strlen($sp)>2) $sps =$sp ;
					   $sct ="B".$nam.$thang. "TD.".$idkho.".".$sps;
					  if($tammangdh['giamgia']>0 && $makm==''){
					  		$tammangdh['giamgia']=0;
					  }
					 $sp++;
					 
					$arr=array(
						"idkho"=>(int)($tammangdh['team']['idkho']),
						"idkhach"=>$tammangdh['kh']['ID'],
						"ngayxuat"=>$tammangdh['ngaytao'],
						"lydoxuat"=>$tammangdh['team']['lydo'],
						"tigia"=>$makm && !$gh1phan ?$giamgiathuc:0,
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
					}
					else{
						echo 'Dòng'.$success.'! Dữ liệu đã tồn tại!';
					}
						
                        if($dong){
                            $IDPhieu=$dong['ID'];
                             $MaNV=$dong['diachiN'];
							 $IDNhaCC= $dong['IDNhaCC'];
							  $idkho= $dong['IDKho'];
							 $tongtienmua=0;
                          
									//$gh1phan
						///$gh1phanvdtruoc
                            //insert vc online
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
									"togtien"=>$tammanggiaoh['togtien'],
									"tinh"=>$tammanggiaoh['tinh'],
									"quan"=>$tammanggiaoh['quan'],
									"phuong"=>$tammanggiaoh['phuong'],
									"diachi"=>$tammanggiaoh['diachi'],
									"giamgia"=>!$gh1phan?$tammanggiaoh['giamgia']:0,
									"trigiadon"=>$tammanggiaoh['trigiadon'],
									"cacmasanpham"=>$tammanggiaoh['cacmasanpham'],
									"khohang"=>$tammanggiaoh['khohang'],
									"diachikho"=>$tammanggiaoh['diachikho'],
									"dongthoigiantrangthaidon"=>$tammanggiaoh['dongthoigiantrangthaidon'],
									"tinnhantaodon"=>$tammanggiaoh['tinnhantaodon'],
									"ngaydaydon_dvvc"=>$tammanggiaoh['ngaydaydon_dvvc'],
									"chuyenkhoan"=>$tammanggiaoh['chuyenkhoan'],
									"mavdtra"=>$gh1phanvdtruoc,
                                    );
                                    //echo "bảng vận chuyển <br>";
                                    if(!insertVanchuyenonline($arrv)){
										echo 'Lỗi thêm vào dữ liệu bảng vận chuyển online dòng'.($success+1);
											xoaPhieunhap($IDPhieu);
										return;
									}
									
									$tongtienkm=0;
								foreach($tammangsp as $k => $vl){
                                    $arr1=array(
                                    "IDPhieu"=>$IDPhieu,
                                    "IDSP"=>$vl['IDSP'],
                                    "mahang"=>$vl['masp'],
                                    "tenpt"=>$vl['tensp'],
                                    "SoLuong"=>$vl['soluong'],
                                    "DonGia"=>$vl['dongia'],
                                    "LoaiTien"=>$value['ghichu'],
                                    "chietkhau"=>$vl['chietkhau'],
                                    "Loai"=>'',
                                    "giavon"=>$vl['giabinhquan'],
                                    "idnhom"=>$vl['idnhom'],
									"giamgiasp"=>$vl['giamgiasp'],
                                    "idtao"=>'',
                                    "idnv"=>'',
                                    "idban"=>'',
                                    
                                );
								$tongtienkm+=($vl['dongia']*(1-1*$vl['chietkhau']/100)*$vl['soluong']);
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
											
										echo 'Lỗi thêm vào dữ liệu bảng xuất bán hàng dòng'.($success+1);
										return;
									}
                            }
							if($makm){
								$arrp["maso"]=$makm;
								$arrp["sotiendk"]=$giamgiathuc;
								$arrp["ngaydung"]=$ngaytao;
								$arrp["idkhoa"]=$idk;
								$arrp["iddung"]=$IDNhaCC;
								$arrp["sophieu"]=$sct;
								$arrp["cuahang"]=$tongtienkm;
								updatephieukhuyenmai($arrp);
							}
							$tongtienmua=sotiendamua($sct);
								congdiem($tongtienmua,$IDNhaCC);
                            $success++;	
                    }
                    else{
                            $fail++;
							//var_dump($dong);
								echo 'Dòng'.$fail.'! Có lỗi xảy ra </br>';
								//return;
                    }
			
			//kiểm tra giao hàng 1 phần
					//#GH1P#PCAKES355129O1138676 echo $r['T64'];
				$gh1phan=false;
				$gh1phanvdtruoc='';
				if($r['T64']){
					$tgh1p=explode("#",$r['T64']);
					
					if($tgh1p[1]=="GH1P"){
						$gh1phan=true;
						$gh1phanvdtruoc=trim(explode("GH1P",$tgh1p[2])[0]);
					}
					
				}
				
				
					$giamgiathuc=$r['T55']-$r['T56'];
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
            
                    $arrmanv=tachmanv($r['T19']);
						//var_dump($arrmanv);
					$matam=$r['T5']?$r['T5']:$r['T3'];
                    $tammangdh=array(
                        "madh"=>$r['T5']?$r['T5']:$r['T3'],
                     	 "ghichu"=>$matam.' '.$r['T19'].' '.$r['T20'].' '.$r['T67'],
                        "giamgia"=>$r['T55'],
                        "ngaytao"=>$r['T33'],
                        "nvxacnhan"=>$r['T16'],
                        "togtien"=>$r['T83'],
                    );
                    //nhân vien
                    if(checkExists('MaNV',$arrmanv["manv"],"userac")){
                        $mangnv=checkExists('MaNV',$arrmanv["manv"],"userac");
                    }
                    else{
                        $mangnv=array("manv"=>$arrmanv["manv"],"check"=>false);
                    }
                    //voucher
                    if(checkExists('maso',$arrmanv["voucher"],"phieukhuyenmai")){
                    	 $mangvc=checkExists('maso',$arrmanv["voucher"],"phieukhuyenmai");
                       // $vctam=checkExists('maso',$arrmanv["voucher"],"phieukhuyenmai");
//                        if($r['T54']!=$vctam["sotien"]){
//                                $mangvc='';
//                                
//                        }
//                        else{
//                            $mangvc=checkExists('maso',$arrmanv["voucher"],"phieukhuyenmai");
//                        }
                        
                    }
                    else{
                        $mangvc='';
                    }
                
                    
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
                    
                    
                    $sql="select Name,ID,price,giabinhquan,codepro,IDGroup,code from products where codepro ='$r[T43]' limit 1";
                    $dong=getdong($sql);
					$chietkhau=0;
					if($r['T48']>0){
						$chietkhau=($r['T56']/$r['T48'])*100;
					}
                    $sptam=array(
                        "IDSP"=> $dong['ID'] ,
                        "masp"=> $dong['codepro'] ,
						"code"=> $dong['code'] ,
                        "tensp"=> $dong['Name'] ,
						"idnhom"=> $dong['IDGroup'] ,
                        "soluong"=>  $r['T45'] ,
                        "dongia"=>$r['T48'],
						"giamgiasp"=>$r['T56'],
						"chietkhau"=>$chietkhau,
                        "giabinhquan"=> $dong['giabinhquan'] ,
                        "giamgia"=>$r['T55']
                    );   
                        //khách hàng
				if(trim($r['T20'])){
					$mangkh=[];
						$checkkh=checkExists('makh',replacesdt(trim($r['T20'])),"customer");
						
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
							'makh'=>replacesdt(trim($r['T20'])),
							'address'=>$mangdiachi,
							'type'=>0,
							'tel'=>replacesdt($r['T20']),
							'ngaysinh'=>$arrmanv["ngaysinh"]?$arrmanv["ngaysinh"]:"0000-00-00",
							  'IDKhuVuc'=>$IDKhuVuc,
							'quan'=>$quan,
							'phuong'=>$phuong,
							
							);
							$mangkh=insertKh($arrtam);
						}	
                    }
                   }
				   else{
				   		echo 'Khách hàng rỗng! Đơn thứ '.($success+1);
								   break;
				   }
				   
				   
						if(!$mangkh["ID"]){
							echo 'Khách hàng rỗng! Đơn thứ '.($success+1);
								   break;
						}
                    //check team
				 if($arrmanv['mach']){
						 
					$checkteam=checkTeam(trim($arrmanv['mach']));
					$checkcuahang=checkCuahang(trim($arrmanv['mach']));
                    if($checkteam){
                        $mangteam =$checkteam;
                    }
                    else if($checkcuahang){
                            $mangteam =$checkcuahang;
                    }else{
						
						echo 'Mã cửa hàng không tồn tại! Đơn thứ '.($success+1);
						   break;
                    }
				}
				else{
					echo 'Mã cửa hàng không tồn tại! Đơn thứ '.($success+1);
						   break;
				}
                    array_push($tammangsp,$sptam);
                  $tammanggiaoh=array(
				"madh"=>$r['T5']?$r['T5']:$r['T3'],
				"fbpage"=>$r['T4'],
				"mavdpk"=>$r['T5']?$r['T5']:$r['T3'],
				"madoitac"=>$r['T7'],
				"dvvanch"=>$r['T8'],
				"phitravc"=>$r['T9'],
				"phithuvc"=>$r['T10'],
				"nvxuly"=>$r['T13'],
				"nvcskh"=>$r['T14'],
				"nvxacnhan"=>$r['T16'],
				"nvgui"=>$r['T17'],
				"dtkh"=>$r['T20'],
				"nvtaodon"=>$r['T31'],
				"ngaytaodon"=>$r['T33'],
				"nguondon"=>$r['T36'],
				"togtien"=>$r['T83'],
				"tinh"=>$r['T27'],
				"quan"=>$r['T26'],
				"phuong"=>$r['T25'],
				"diachi"=>$r['T28'],
				"giamgia"=>$r['T55'],
				"trigiadon"=>$r['T57'],
				"cacmasanpham"=>$r['T66'],
				"khohang"=>$r['T67'],
				"diachikho"=>$r['T68'],
				"dongthoigiantrangthaidon"=>$r['T86'],
						"tinnhantaodon"=>$r['T89'],
						"ngaydaydon_dvvc"=>$r['T100'],
						"chuyenkhoan"=>$r['T76'],
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
         //$tammangdh['giamgia']=$giamgiathuc;
			
		$makm=is_array($tammangdh['vc'])?$tammangdh['vc']['maso']:$tammangdh['vc'];
			
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
				"tigia"=>$makm && !$gh1phan ?$giamgiathuc:0,
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
			}
			else{
						echo 'Dòng'.$success.'! Dữ liệu đã tồn tại!';
			}
			
			if($dong){
				$IDPhieu=$dong['ID'];
				 $MaNV=$dong['diachiN'];
				$IDNhaCC= $dong['IDNhaCC'];
				 $idkho= $dong['IDKho'];
				  $tongtienmua=0;
				
				//insert vc online
				
				
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
									"togtien"=>$tammanggiaoh['togtien'],
									"tinh"=>$tammanggiaoh['tinh'],
									"quan"=>$tammanggiaoh['quan'],
									"phuong"=>$tammanggiaoh['phuong'],
									"diachi"=>$tammanggiaoh['diachi'],
									"giamgia"=>!$gh1phan?$tammanggiaoh['giamgia']:0,
									"trigiadon"=>$tammanggiaoh['trigiadon'],
									"cacmasanpham"=>$tammanggiaoh['cacmasanpham'],
									"khohang"=>$tammanggiaoh['khohang'],
									"diachikho"=>$tammanggiaoh['diachikho'],
									"dongthoigiantrangthaidon"=>$tammanggiaoh['dongthoigiantrangthaidon'],
									"tinnhantaodon"=>$tammanggiaoh['tinnhantaodon'],
									"ngaydaydon_dvvc"=>$tammanggiaoh['ngaydaydon_dvvc'],
									"chuyenkhoan"=>$tammanggiaoh['chuyenkhoan'],
									"mavdtra"=>$gh1phanvdtruoc,
                                    );
						//echo "bảng vận chuyển <br>";
						if(!insertVanchuyenonline($arrv)){
							echo 'Lỗi thêm vào dữ liệu bảng vận chuyển online'.($success+1);
							xoaPhieunhap($IDPhieu);
							return;
						}
						$tongtienkm=0;
							foreach($tammangsp as $k => $vl){
								$arr1=array(
								"IDPhieu"=>$IDPhieu,
								"IDSP"=>$vl['IDSP'],
								"mahang"=>$vl['masp'],
								"tenpt"=>$vl['tensp'],
								"SoLuong"=>$vl['soluong'],
								"DonGia"=>$vl['dongia'],
								"LoaiTien"=>$value['ghichu'],
								"chietkhau"=>$vl['chietkhau'],
								"Loai"=>'',
								"giavon"=>$vl['giabinhquan'],
								"idnhom"=>$vl['idnhom'],
								"giamgiasp"=>$vl['giamgiasp'],
								"idtao"=>'',
								"idnv"=>'',
								"idban"=>'',
								
							);
							$tongtienkm+=($vl['dongia']*(1-1*$vl['chietkhau']/100)*$vl['soluong']);
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
										echo 'Lỗi thêm vào dữ liệu bảng xuất bán hàng dòng'.($success+1);
										return;
						}
					}
					if($makm){
						$arrp["maso"]=$makm;
						$arrp["sotiendk"]=$giamgiathuc;
						$arrp["ngaydung"]=$ngaytao;
						$arrp["idkhoa"]=$idk;
						$arrp["iddung"]=$IDNhaCC;
						$arrp["sophieu"]=$sct;
						$arrp["cuahang"]=$tongtienkm;
						updatephieukhuyenmai($arrp);
					}
					$tongtienmua+=sotiendamua($sct);			
					congdiem($tongtienmua,$IDNhaCC);
					
					$success++;	
		}
		else{
			
				$fail++;
				var_dump($dong);
				echo 'Dòng'.$fail.'! Có lỗi xảy ra </br>';
				return;
		
		}
	
		$giamgiathuc=0;
		$tammangdh=array();
		$tammanggiaoh=array();
		$tammangsp=array();
		
	}
	
	 $check++;	
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
	$ngaysinh=$arr[4];
	$tamns='';
	if($ngaysinh){
		$ngaysinh=explode("/",$ngaysinh);
		$tamns=$ngaysinh[2].'-'.$ngaysinh[1]."-".$ngaysinh[0];
	}
	$tam='';
	
	return array("tenkh"=>$tenkh,"manv"=>$manv,"voucher"=>$voucher,"mach"=>$mach,'ngaysinh'=>$tamns);
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
	$sql="select * from quan1 where CONCAT(loai,' ',Name) like '%$chuoi%'";

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
	$sql="select * from phuong1 where CONCAT(loai,' ',Name) like '%$chuoi%'";

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
global $data,$idcuahang;
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
	$sql="insert IGNORE  into customer (Name,makh,address,type,tel,ngaytao,ngaysinh,IDKhuVuc,quan,phuong,nhomkh,idcuahang)
	 values('$name','$makh','$address','$type','$tel','$ngay','$ngaysinh','$IDKhuVuc','$quan','$phuong',8,'$idcuahang')";
	 
	 $update=$data->query($sql);
	 	$sql="select * from customer where makh='$tel' and tel='$tel'";
		$dong=getdong($sql);
	 	return $dong;
	
}

function checkTeam($team){
global $data,$idcuahang;
	//if(!$team) return;
	$sql="select ID,ma from lydonhapxuat where ma='$team'";
	$dong=getdong($sql);
	$result='';
	if($dong['ma']){
		$result=array("idkho"=>$idcuahang,"lydo"=>$dong['ID'],'idchol'=>'');
	}
	else{
		
		return false;
	}
	return $result;
}

function checkCuahang($team){
global $data,$idcuahang;
	//if(!$team) return;
	$sql="select ID,macuahang from cuahang where macuahang ='$team'";
		
		$query =$data->query($sql);
		$dong=getdong($sql);
		$result='';
		if($dong['ID']){
			
			$result=array('idkho'=>$idcuahang,"lydo"=>5,"idchol"=>$dong["ID"]);
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
		//echo $sql;
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
	$mavdtra=$arr['mavdtra'];

	 $sql="INSERT INTO vanchuyenonline (IDbill,sobill,madh,Fbpage,mavd,madoitac,donvivc,phitravc,phithukh,nvxuly,nvcskh,giamgia,trigiadon,cacmasp,khohang,diachikho,dongthoigiantrangthaidon,tinnhantaodon,ngaydaydon_dvvc,chuyenkhoan,dienthoai_kh,diachi,tinh,quan,phuong,tongtien,mavdtra)  
	 VALUES('$IDbill','$sobill','$madh','$Fbpage','$mavd','$madoitac','$donvivc','$phitravc','$phithukh','$nvxuly','$nvcskh','$giamgia','$trigiadon','$cacmasanpham','$khohang','$diachikho','$dongthoigiantrangthaidon','$tinnhantaodon','$ngaydaydon_dvvc','$chuyenkhoan','$dtkh','$diachi','$tinh','$quan','$phuong','$togtien','$mavdtra') ON DUPLICATE KEY UPDATE donvivc=if(dongthoigiantrangthaidon <> '8' and dongthoigiantrangthaidon <> '1','$donvivc',donvivc)";

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
	
		$sql = " select if((sum(b.SoLuong*(b.DonGia-(b.chietkhau*b.DonGia/100)))-a.tigia)>0,(sum(b.SoLuong*(b.DonGia-(b.chietkhau*b.DonGia/100)))-a.tigia),sum(b.SoLuong*(b.DonGia-(b.chietkhau*b.DonGia/100)))) as tong   
from phieunhapxuat a left join  xuatbanhang b on a.ID=b.IDPhieu where 1=1 and a.SoCT='$soct'" ;
 	$tam3 = getdong($sql) ;
	$tong=$tam3['tong'];
	return $tong;
}
function congdiem($tong,$IDNhaCC){
global $data;
    $ngaytao = gmdate('Y-m-d H:i:s', time() + 7*3600) ;
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