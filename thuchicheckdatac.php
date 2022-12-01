<?php  
session_start();
 $quyen= $_SESSION["quyen"] ; 
  date_default_timezone_set('Asia/Ho_Chi_Minh');
if ($_SESSION["LoginID"]=="") return ;
$ql =$quyen[$_SESSION["mangquyenid"][$_SESSION['act']]]  ;
$root_path =getcwd()."/"  ;
include($root_path."biensession.php");
include($root_path."includes/config.php");
include($root_path."includes/removeUnicode.php");
include($root_path."includes/class.paging.php");
include($root_path."includes/class.mysql.php");
include($root_path."includes/function.php");
include($root_path."includes/function_local.php");
include( $root_path."excel/simplexlsx.class.php");  
include( $root_path."thuchibienngayquahan.php"); 
$ngayquahanchuan=1;
$ngayquahanchophep=$ngayquahanchophep;
$thangquahanchohep=$thangquahanchohep;
$cuahangchophep=explode(",",$cuahangchophep);
 //$path = $root_path."data/maubanhangpancake.xlsx"  ; 
    
$mangDVVC=["GHTK","J&T","VTP","VNPOST","SHOPEE","LAZADA","FM","NINJA VAN","MTT","TM","CH","SHOPEE 1","SHOPEE 2","SHOPEE 3","SHOPEE 7","SHOPEE KIDS","DNA"];

$idk = laso($_SESSION["LoginID"]) ; if ($idk == 0) return ;
  $idkho = $_SESSION["se_kho"] ; 
  
$data = new class_mysql();
$data->config();
$data->access();
$updated =false;

$tm = $_SESSION["root_path"] ;
//đọc dữ liệu
$path = $root_path."data/thuchi".'-'.$idk.'-'.$idkho.".xlsx" ;
$xlsx = new SimpleXLSX($path);
$sheets=$xlsx->rows();
$rows_begin = 12;
$rows_end = count($sheets);
$tam=[];
if ($rows_end >= 600) $rows_end = 600;
list($cols,) = $xlsx->dimension();
$cols=26;

$chuoiinsert='';
//if(isset($_POST['DATA'])){
$demdong=0;
	$data1 = $_POST['DATA']; 
	$tmp = explode('*@!',$data1);
	$tudong=laso($tmp[0]);
	$dendong=laso($tmp[1]);
	if($tudong){
		$rows_begin =($tudong-1);
	}
	if($dendong){
		$rows_end=($dendong-1);
	}	
	$stt=0;
		$thang = gmdate('m', time() + 7*3600); 
		$nam = gmdate('y', time() + 7*3600); 
		 $ngaytao = gmdate('Y-n-d H:i:s', time() + 7*3600) ;
		 //số chứng từ
		$sql = "SELECT `AUTO_INCREMENT` as sp FROM INFORMATION_SCHEMA.TABLES
     WHERE TABLE_SCHEMA = '$db[name]' AND TABLE_NAME = 'thuchikt';" ;  
		 $kq = getdong($sql) ;		
    	$sp  = laso($kq['sp']);	
		
	 	$mangdk = taomang ("dinhkhoanthuchi","ma","ID"); 
	$mangch = taomang ("cuahang","macuahang","ID"); 
	$mangtk = taomang ("dinhkhoan","ID","madinhkhoan"); 
	//$mangtkma = array_flip($mangtk);
	//'17','18','19','20',
	//var_dump($mangch);
	$mangchecktontai=['14','15','19','21','22'];
	$mangcheckhople=['20'];
	$kiemtratienchechlech='';
	$mangindextrung=[];
	foreach($sheets as $k => $r) {
	
	$checkloi=true;	
	$IDCha=$thongtinchuoi['ID'];
	$tkno='';
	$tkco='';
	$psno='';
	$donvitinh='';
	
	$soluong='';
	$dongia='';
	
		$hdbh='';
		$sophieupm='';
		$chungtu='';
		$note='';
		$nguoinhan='';
		$nguoichi='';
		$loaitk='';
		$luachon='';
		$LydoN='';
		$tinhtrang='';
		$IDkhoa='';
		$ngaythuchi='';
		$lydo='';
		$loaitaikhoan='';
		$idnganhang='';
		$sotknh='';
		$mavandon='';
		$NCC='';
		$manv='';
		$loaitk='';
		$phieuxuat='';
		$phithukh='';
		$donvivc='';
		if (($k >= $rows_begin) && ($k <= $rows_end)) {
			if(trim($r[3])=='DTBH'){
						continue;
				}
			if((trim($r[8])=='') && (trim($r[12])=='') ){
						$mauchu='red';
								$baoloirong .='PS nơ và PS có rỗng!';
								$checkloi=false;
							$loi=true;
				}
				
				if(!trim($r[2]) || trim($r[2])==''){
						$mauchu='red';
								$baoloirong .='Kiểm tra loại thu chi!';
								$checkloi=false;
							$loi=true;
				}
				if(trim($r[12])!='' && (trim($r[10])*trim($r[11]))!=1*trim($r[12])){
						$mauchu='red';
								$baoloirong .='Kiểm tra lại đơn giá nhân số lượng!';
								$checkloi=false;
							$loi=true;
				}
				if($r[2] && strtolower(trim($r[2]))=='chi'  && (trim($r[12])=='' || (trim($r[10])=='') || (trim($r[11])==''))){
						$mauchu='red';
								$baoloirong .='PS có, số lượng và đơn giá không được trống với loại phiếu CHI!';
								$checkloi=false;
							$loi=true;
						
				}
				
				if($r[2] && strtolower(trim($r[2]))=='thu' && (trim($r[8])=='') ){
							
							$mauchu='red';
								$baoloirong .='PS nợ không được trống với loại phiếu THU!';
								$checkloi=false;
							$loi=true;
					
				}
			if(!validateDate($r[0])){
				$mauchu='red';
						$baoloirong .='Ngày thu chi rỗng hoặc sai định dạng! \n';
						$checkloi=false;
						$loi=true;
			}
				
				/*if(trim($r[17])){
					if(!CheckVanChuyen(trim($r[17]))['ID']){
						
								$baoloirong .='Ngày thu chi rỗng hoặc sai định dạng! \n';
								$checkloi=false;
								$loi=true;
					}
				}*/
			$checktrunglap=checktrunglap($r,$sheettam,26,$k);
			$count2dong=$checktrunglap["sodong"];
			//$sheettam=$checktrunglap["mangmoi"];
			$mangindextrung=$checktrunglap["mangindex"];
			
		//var_dump($mangindextrung);
		
			if(in_array($k,$mangindextrung) || $count2dong>0){
				$dongtrungnhau='';
			
				foreach($mangindextrung as $key => $value){
					$dongtrungnhau.="$value,";
				}
						$mauchu='red';
						$baoloirong .='dòng trùng nhau!'.$k.'  '.$dongtrungnhau.'\n';
						$checkloi=false;
						$loi=true;
			}
			
			
			if(trim($r[3]) && trim($r[3])!=''){
				if(trim($r[3])=='DTBH'){
						continue;
				}
				$stt++;
				if(!$mangdk[trim($r[3])]){
					echo "lỗi mã định khoản không tồn tại! <br>";
					$checkloi=false;
				}else{
					//1=nợ 6 0 =co 7
					$arridtk=checktaikhoandinhkhoan($r[3]);
					
					
					if($r[6]){
						//$r[6];
						//var_dump($arridtk);
					
							/*if($mangtk[$arridtk['no']]!=$r[6] && $r[3]!='CK' && $r[3]!="TK"){
								echo "Mã tài khoản nợ không đúng! <br>";
								$checkloi=false;
							}*/
						
					}
					
					if($r[7]){
						//$r[6];
						/*if($mangtk[$arridtk['co']]!=$r[7] && $r[3]!='CK' && $r[3]!="TK"){
							echo "Mã tài khoản có không đúng! <br>";
							$checkloi=false;
						}*/
					}
				}
					$IDcuahang=checkcuahang(trim($r['1']));
					if(!$IDcuahang){
						echo "lỗi cửa hàng không tồn tại! dòng".$k;
						if($checkloi){
										$demdong++;
									}
									$checkloi=false;
					}
					else{
					$IDcuahang=$IDcuahang["ID"];
					//var_dump($IDcuahang);
					
						if($_SESSION["LoginID"]!=7576 && $_SESSION["LoginID"]!=4647 && !$ql[5]){
							if($IDcuahang!=$_SESSION["se_kho"]){
									
								echo 'Cửa hàng không được phép tải lên! dòng'.$k;
								$checkloi=false;
								
							}
							
						}
					}
					if(strtolower(trim($r[2]))=='thu'){
						$ct='T';
						$luachon=1;
					}
					else if(strtolower(trim($r[2]))=='chi'){
						$ct='C';
						$luachon=2;
					}
					if($arridtk["loai"]!=$luachon){
							echo "Vui lòng kiểm tra lại loại thu chi! dòng".$k;
							$checkloi=false;
					}
					$thongtinchuoi=getthongtin(trim($r[3]));
					$IDCha=$thongtinchuoi['ID'];
					$tkno=$thongtinchuoi['no'];
					$tkco=$thongtinchuoi['co'];
					//	var_dump($mangtkma);
					//echo($mangtk["KXD"]);
					$psno=trim($r['8']);
					$psco=trim($r['12']);
					$donvitinh=trim($r[9]);
					//$manv=$r['22'];
					$soluong=trim($r[10]);
					$dongia=trim($r[11]);
						
							$tentknh=trim($r[15]);
						$hdbh=trim($r[13]);
						$sophieupm='';
						$chungtu='';
						$note=addslashes($r[5]);
						$nguoinhan='';
						$nguoichi='';
						
						//$IDcuahang=$mangch[$r[1]];
						$LydoN='';
						$tinhtrang='';
						$IDkhoa='';
						$ngaythuchi=trim($r[0]);
						$lydo=trim($r[4]);
						$donvivc=trim($r[16]);
						$mavandon=trim($r[17]);
						$phithukh=trim($r[22]);
						$sotienthuc=0;
						/*if($r[16]){
							$mavandon=$r[16];
						}
						else if($r[17]){
							$mavandon=$r[17];
						}
						else if($r[18]){
							$mavandon=$r[18];
						}
						else if($r[19]){
							$mavandon=$r[19];
						}*/
						
				
					$artt=checkcol($thongtinchuoi['thongtin'],$r);
					
					if(count($artt['rong'])>0){
						
						foreach($artt['rong'] as $key => $value){
							
							echo "lỗi thiếu dữ liệu ".xuatbaoloirong($value)." dòng ".$k."<br>";
						}
						if($checkloi){
							$demdong++;
						}
						
						$checkloi=false;
					}
					
					$datetam=explode("-",$r[0]);
					if($datetam[0]<date("Y")){
							
						echo "Năm thu chi nhỏ hơn năm hiện tại!  dòng ".$k; 
					  	$checkloi=false;
					}
					
						$ngaytaiqh=dateDiffMi(strtotime($r[0]),strtotime(gmdate('Y-n-d'),time() + 7*3600));
				//	var_dump($ngaytaiqh);
				
				$quahan=false;
				if($_SESSION["LoginID"]!=7576 && $_SESSION["LoginID"]!=4647 && !$ql[5]){
						//++++++mới thêm+++++++
					$today_ = date('Y-m-d');
					 $ngaytruoc=strtotime(date("Y-m-d", strtotime($today_)) . " -1 day");
					 $ngaythuchitai=strtotime(date("Y-m-d", strtotime($r[0])));
				
					  if(!kiemtratrungngay($ngaytruoc, $ngaythuchitai)){
					  
					  	//+++++++++++++++
					  
					  		//++++++cái cũ+++++++
						/*if($ngaytaiqh>$ngayquahanchuan)
					   {*/
					   
					   	//++++++cái cũ+++++++
					   
					   	$strcrr=strtotime(date('Y-m-d h:m'));
						///if($strcrr<=strtotime($loadden) && $strcrr>=strtotime($loadtu)){
								/*$baoloirong .="Ngày thu chi Quá hạn!\\n"; 
								   $checkloi=false;
							   $mauchu='red';
								$loi=true;*/
					   		$currdate=date("d",strtotime($r[0]));
								$currmonth=date("m",strtotime($r[0]));
								$curryear=date("Y",strtotime($r[0]));
								 	//$thanghientai=date('m');
									//echo $thanghientai;
								if( $curryear==date("Y")){
									if(in_array($mangch[strtoupper(trim($r[1]))],$cuahangchophep)){
							
										if(($currdate!=$ngayquahanchophep || $currmonth!=$thangquahanchohep)){
										
											$quahan=true;
										}
										else{
											$quahan=false;
										}	
									}
									else{
										//echo "<br/>hiện tại: ".$ngayquahanchophep."<br/>";
										$quahan=true;
									}
					   			}
								else{
											$quahan=true;
								}	
								//}else{
								//	$quahan=true;
								//}
							}
							   //mới thêm +++++++++++
						  if(kiemtratrungngay(strtotime($today_ ),$ngaythuchitai)){
									$trungngay_=true;
									$quahan=false;
						}
						
						
						if($trungngay_==true){
							echo "Không được tải lên trùng ngày!\\n"; 
							 $checkloi=false;
						  
						}
							//+++++++++++++++
							if($quahan==true){
								echo "Ngày thu chi Quá hạn!dòng ".$k."<br>";
								$checkloi=false;
							}
				   }
				
				if(strtotime($r[0])>strtotime(gmdate('Y-n-d'),time() + 7*3600))
				   {
							echo "Ngày thu chi lớn hơn ngày hiện tại! dòng ".$k; 
							if($checkloi){
										$demdong++;
							}
					   	$checkloi=false;
					  	 
				   }	
				  if(!kiemtratontaidulieu(date("Y-m-d",strtotime($r[0])),$r[11],addslashes($r[4]),$mangch[strtoupper($r[1])],$r[13],$r[9],$r[14],$r[15],$r[16],$r[17],$r[22],addslashes($r[5]))){
						echo "Dòng này đã tồn tại! dòng ".$k;
						if($checkloi){
								$demdong++;
						}
						$checkloi=false;
					}
					
				
					if(count($artt['co'])>0){
					
						foreach($artt['co'] as $key => $value){
						
							if($value==17){
								if(!in_array(trim($r[$value-1]),$mangDVVC)){
											$mauchu='red';
												$baoloirong .='Kiểm tra lại đơn vị vận chuyển!';
												$checkloi=false;
											$loi=true;
								}
							}
							
							if(in_array($value,$mangchecktontai)){
								$checktontai=checkcotchitiet($value,$r);
								
									
								if(!$checktontai){
									echo "lỗi dữ liệu không tồn tại ".xuatbaoloitontai($value)." dòng ".$k."<br>";								
								
								
									if($checkloi){
										$demdong++;
									}
									$checkloi=false;
								}
								else{
								
									if($value==21){
									
										if(create_slug(trim($checktontai['dulieu']))!=create_slug(trim($r[21]))){
											
											echo "lỗi dữ liệu không tồn tại ".xuatbaoloitontai(20)." dòng ".$k."<br>";
											if($checkloi){
												$demdong++;
											}
											$checkloi=false;
										}
									}
									if($value==15){
										$loaitaikhoan=$checktontai['thongtin']['loaitk'];
										$idnganhang=$checktontai['thongtin']['mangh'];
										$sotknh=$checktontai['dulieu'];
										
									}
									
									//var_dump($artt['co']);
									/*if($value==17 || $value==18 || $value==19 || $value==20){
										$mavandon=$checktontai['dulieu'];
									}*/
									if($value==19){
										$NCC=$checktontai['dulieu'];
									}
									if($value==21){
										$manv=$r['20'];
									}
									if($value==22){
										$phieuxuat=$checktontai['dulieu'];
										//var_dump($checktontai);
									}
									if($value==14){
									$checktiendung=true;
										
										if($r[3]=='CPTBNV'){
												$tienthuongcheck=checkhoadonthuongduyet($r[13]);
												if($tienthuongcheck['tienthuong']){
														if(trim($r[8]) && $r[8]!=$tienthuongcheck['tienthuong']){
															$checktiendung=false;
															echo "Tiền thưởng bill của đơn hàng không trùng với cột PS Nợ\\n";
														}
														else if(trim($r[12]) && $r[12]!=$tienthuongcheck['tienthuong']){
															$checktiendung=false;
															echo "Tiền thưởng bill của đơn hàng không trùng với cột PS Có\\n";
														
														}
												}
												if(!$checktiendung){
													$checkloi=false;
													$loi=true;
													
													$mauchu='red';
												}
										}
										else{
											if(trim($r[13])==trim($sheets[$k+1][13])){
														//echo $r[14];
														//echo $r[12]+$sheets[$k+1][12];
														$tienkiemtrapsno=$r[8]+$sheets[$k+1][8];
														$tienkiemtrapsco=$r[12]+$sheets[$k+1][12];
														$kiemtratienchechlech=$k;
												}
												else if(trim($r[13])==trim($sheets[$kiemtratienchechlech][13])){
												
													$tienkiemtrapsno=$r[8]+$sheets[$kiemtratienchechlech][8];
														$tienkiemtrapsco=$r[12]+$sheets[$kiemtratienchechlech][12];	
															//echo $sheets[$kiemtratienchechlech][12].",";
														$kiemtratienchechlech='';
														
												}
												else{
														$tienkiemtrapsno=$r[8];
														$tienkiemtrapsco=$r[12];
												}
											
											$tiendonhang=checksotienhoadon($checktontai['dulieu']);
											if($tienkiemtrapsno){
												
											
												if($tienkiemtrapsno==abs($tiendonhang['thanhtien'])){
													$tvdtam='';
													if($mavandon){
														$tvdtam=gettienvandon($mavandon);
													}
													if($tvdtam){
														$sotienthuc=$tvdtam;
													}
													else{
														$sotienthuc=$tienkiemtrapsno;
													}
													$psno=abs($tiendonhang['thanhtien']);
													if($dongia!=''){
														$dongia=abs($tiendonhang['thanhtien']);
													}
													/*if($tienkiemtrapsno!=abs($tiendonhang['thanhtienlen'])){
														$checktiendung=false;
														echo "lỗi dữ liệu không khớp! Số tiền hóa đơn".$r[8]." khác cột ".$value." dòng ".$k."<br>";
													}*/
												}
												else{
													$checktiendung=false;
														echo "lỗi dữ liệu không khớp! Số tiền hóa đơn".$tiendonhang['thanhtien']." khác cột ".$value." dòng ".$k."<br>";
												}
											}
											else if($tienkiemtrapsco){
										
												if($tienkiemtrapsco==abs($tiendonhang['thanhtien'])){
													$tvdtam='';
													if($mavandon){
														$tvdtam=gettienvandon($mavandon);
													}
													if($tvdtam){
														$sotienthuc=$tvdtam;
													}
													else{
														$sotienthuc=$tienkiemtrapsco;
													}
													$psco=abs($tiendonhang['thanhtien']);
													if($dongia!=''){
														$dongia=abs($tiendonhang['thanhtien']);
													}	/*if($tienkiemtrapsco!=abs($tiendonhang['thanhtienlen'])){
													$checktiendung=false;
													echo "lỗi dữ liệu không khớp! Số tiền hóa đơn".$tiendonhang." khác cột ".$value." dòng ".$k."<br>";
													}
*/												}else{
													$checktiendung=false;
												echo "lỗi dữ liệu không khớp! Số tiền hóa đơn".$tiendonhang['thanhtien']." khác cột ".$value." dòng ".$k."<br>";		
												}
											}
											
											if(!$checktiendung){
											
												if($checkloi){
													$demdong++;
												}
												$checkloi=false;
											}
										}
										//var_dump($checktiendung);
											
									}
								}
								
							}
							
								
						}
						
						
						
					}
				
					//echo $hdbh;
					if($checkloi){
					 $sochungtu = $ct.$nam.$thang.".T".$idkho.".". $sp;  
				 	$sp++;
						$chuoiinsert.="('$IDCha','$sochungtu','$ngaythuchi','$ngaytao','$note','$sotienthuc','$ngaytao','$lydo','$nguoinhan','$nguoichi','$IDcuahang','$_SESSION[LoginID]','$_SESSION[LoginID]','$luachon','$LydoN','$idnganhang','$loaitaikhoan','$tinhtrang','$IDkhoa','$tkno','$tkco','$psno','$psco','$donvitinh','$soluong','$dongia','$hdbh','$sotknh','$mavandon','$NCC','$manv','$phieuxuat','$sophieupm','$chungtu','$tentknh','$donvivc','$phithukh'),";
					}
					
			}
			 else{
				break;
			}
		}
		
    }

//}

 	
  	$chuoiinsert=rtrim($chuoiinsert,',');
	//return;
	if(insertThuchiCH($chuoiinsert)){
		if($demdong>0){
			echo '<p style="green">Thành công '.(($stt)-$demdong).' dòng </p>';
			echo '<p style="red">thất bại '.$demdong.' dòng<p>';
		}
		else{
			echo '<p style="green">Thành công '.($stt).' dòng </p>';
		}
		
		
	}
	else{
		echo "có lỗi!";
	}
$data->closedata() ;

function checkcol($chuoi,$r){
	
	$rong=[];
	$co=[];
	if($chuoi){
		$arr=explode("*",$chuoi);
		foreach($arr as $key => $value){
			if($value){
				if($value==23){
						if(trim($r[$value-1])=='' || !is_numeric(trim($r[$value-1])) ){
							array_push($rong,$value);
						}
					}
					else{
						if(trim($r[$value-1])==''){
							
							array_push($rong,$value);
						}
						else{
							array_push($co,$value);
						}
					}
			}
		}
	}
	return array("rong"=>$rong,'co'=>$co);
}

function checkcotchitiet($so,$r){
	$result=[];
	$thongtin=[];
	switch($so){
		case 14:
			$sql="select SoCT as dulieu from phieunhapxuat where SoCT='".trim($r[$so-1])."'";
			
		break;
		case 15:
			$sql="select ma as dulieu,loai as loaitk from taikhoannganhang where ma='".trim($r[$so-1])."'";
			
		break;
		
		case 18:
			$sql="select madh as dulieu from vanchuyenonline where madh='".trim($r[$so-1])."'";
			
		break;
		//case 18:
//			$sql="select madh as dulieu from vanchuyenonline where madh='".trim($r[$so-1])."'";
//			
//		break;
//		case 19:
//			$sql="select madh as dulieu from vanchuyenonline where madh='".trim($r[$so-1])."'";
//			
//		break;
//		case 20:
//			$sql="select madh as dulieu from vanchuyenonline where madh='".trim($r[$so-1])."'";
//			
//		break;
		case 19:
			$sql="select ID as dulieu from nhacungcap where ID='".trim($r[$so-1])."'";
			
		break;
		case 21:
			$sql="select MaNV,Ten as dulieu from userac where MaNV='".trim($r[$so-1])."'";
		break;
		case 22:
			$sql="select ID as dulieu from phieuxuat where SoCT='".trim($r[$so-1])."'";
			//echo $sql
		break;
		default:
		break;
	}
	
	//return $sql;
	if($sql){
	$dong =getdong($sql);
	if($dong['dulieu']){
		if($dong['dulieu']){
			$thongtin['mangh']=$dong['dulieu'];
		}
		if($dong['loaitk']){
			$thongtin['loaitk']=$dong['loaitk'];
		}
		return array('dulieu'=>$dong['dulieu'],'thongtint'=>$thongtin);
	}
	else
	{
		return false;
	}
	}
	else{
		return false;
	}
	
		
}
function getthongtin($id){
	$sql="select ID,ma,no,co,thongtin from dinhkhoanthuchi where ma='$id'";
	
	$dong=getdong($sql);
	if($dong['ma']){
		return array('ID'=>$dong['ID'],'no'=>$dong['no'],'co'=>$dong['co'],'thongtin'=>$dong['thongtin']);
	}
	return false;
}

function xuatbaoloirong($loi){
	$result='';
	switch($loi-1){
		case 13:
			$result= "Cột HĐBH trống!\\n";
		break;
		case 14:
			$result= "Cột STKNH trống!\\n";
		break;
		case 15:
			$result= "Cột Tên TK NH trống!\\n";
		break;
		case 16:
			$result= "Đơn vị vận chuyển trống!\\n";
		break;
		case 17:
			$result= "Cột Mã vận đơn trống\\n";
		break;
	//	case 17:
//			$result= "Cột Shopee trống!\\n";
//		break;
//		case 18:
//			$result= "Cột Lazada trống!\\n";
//		break;
//		case 19:
//			$result= "Cột Tiki trống!\\n";
//		break;
		case 18:
			$result= "Cột NCC trống!\\n";
		break;
		case 19:
			$result= "Cột Họ và tên nhân viên trống!\\n";
		break;
		case 20:
			$result= "Cột Mã nhân viên trống!\\n";
		break;
		case 21:
			$result= "Cột Phiếu xuất trống!\\n";
		break;
		case 22:
			$result= "Cột phí thu Khách hàng trống!\\n";
		break;
		/*case 24:
			$result= "Cột Số phiếu PM trống!\\n";
		break;*/
		/*case 25:
			$result= "Cột Chứng từ trống!\\n";
		break;*/
	
		default:
			$result= "lỗi!";
		break;
	}
	return $result;
}
function xuatbaoloitontai($loi){
	$result='';
	switch($loi){
		case 14:
			$result= "Cột HĐBH không tồn tại dữ liệu!\\n";
		break;
		case 15:
			$result= "Cột STKNH không tồn tại dữ liệu!\\n";
		break;
		case 16:
			$result= "Cột Tên TK NH không tồn tại dữ liệu!\\n";
		break;
		case 18:
			$result= "Cột Mã vận đơn không tồn tại dữ liệu!\\n";
		break;
	/*	case 18:
			$result= "Cột Shopee không tồn tại dữ liệu!\\n";
		break;
		case 19:
			$result= "Cột Lazada không tồn tại dữ liệu!\\n";
		break;
		case 20:
			$result= "Cột Tiki không tồn tại dữ liệu!\\n";
		break;*/
		case 19:
			$result= "Cột NCC không tồn tại dữ liệu!\\n";
		break;
		case 20:
			$result= "Cột Họ và tên nhân viên không tồn tại dữ liệu!\\n";
		break;
		case 21:
			$result= "Cột Mã nhân viên không tồn tại dữ liệu!\\n";
		break;
		case 22:
			$result= "Cột Phiếu xuất không tồn tại dữ liệu!\\n";
		break;
		/*case 25:
			$result= "Cột Số phiếu PM không tồn tại dữ liệu!\\n";
		break;*/
		
	
		default:
		break;
	}
	return $result;
}

function insertThuchiCH($chuoi){
global $data;
/*
	$sochungtu=$arr['sochungtu'];
	$IDCha=$arr['IDCha'];
	$ngaythuchi=$arr['ngaythuchi'];
	$ngaytao=$arr['ngaytao'];
	$note=$arr['note'];
	$sotien=$arr['sotien'];
	$ngaysua=$arr['ngaysua'];
	$lydo=$arr['lydo'];
	$nguoinhan=$arr['nguoinhan'];
	$nguoichi=$arr['nguoichi'];
	$donvi=$arr['donvi'];
	$loaitk=$arr['loaitk'];
	$IDtao=$arr['IDtao'];
	$IDsua=$arr['IDsua'];
	$luachon=$arr['luachon'];
	$LydoN=$arr['LydoN'];
	$idnganhang=$arr['idnganhang'];
	$loaitaikhoan=$arr['loaitaikhoan'];
	$tinhtrang=$arr['tinhtrang'];
	$IDkhoa=$arr['IDkhoa'];
	$tkno=$arr['tkno'];
	$tkco=$arr['tkco'];	
	$psno=$arr['psno'];
	$psco=$arr['psco'];	
	$donvitinh=$arr['donvitinh'];	
	$soluong=$arr['soluong'];
	$dongia=$arr['dongia'];	
	$hdbh=$arr['hdbh'];
	$sotknh=$arr['sotknh'];	
	$mavandon=$arr['mavandon'];
	$NCC=$arr['NCC'];
	$manv=$arr['manv'];
	$phieuxuat=$arr['phieuxuat'];
	$sophieupm=$arr['sophieupm'];
	$chungtu=$arr['chungtu'];	*/

	
	$sql = "insert into thuchikt  (IDCha,sochungtu,ngaythuchi,ngaytao,note,sotien,ngaysua,lydo,nguoinhan,nguoichi,loaitk,IDtao,IDsua,luachon,LydoN,idnganhang,loaitaikhoan,tinhtrang,IDkhoa,tkno,tkco,psno,psco,donvi,soluong,dongia,hdbh,sotknh,mavandon,NCC,manv,phieuxuat,sophieupm,chungtu,tentknh,donvivc,phithukh) values ".$chuoi;
	
	if($data->query($sql)){
	 	/*$sql="select * from phieunhapxuat where SoCT='$sochungtu'";
		$dong=getdong($sql);*/
		
	 	return true;
	}
	else{
		return;
	}
}

function GetsoCT(){
	global $data;
	$idkho=1;
 		$thang = gmdate('m', time() + 7*3600);  
		$nam = gmdate('y', time() + 7*3600);  
		   $so = $idkho+ 10;
		   $sosanh= $nam.$thang."TD";
		   $sql = "select max(convert( mid(sochungtu,11,22),UNSIGNED INTEGER)) as sp from thuchikt where mid(SoCT,2,6) ='$sosanh' " ;
		   
 		   $kq = getdong($sql);		
		   $sp = $kq['sp'] +1;
		  
		return $sp ;
}

function checkcuahang($mach){
global $data;
	$sql="select ID from cuahang where macuahang='$mach'";
	$dong=getdong($sql);
	if($dong['ID']){
		return $dong;
	}
	else{
		return false;
	}
}

function kiemtratontaidulieu($ngaythuchi,$sotien,$lydo,$idkho,$hdbh,$donvi,$sotknh,$tentknh,$donvivc,$mavandon,$manv,$note){
 //	$sql  = " select ID from thuchikt where ngaythuchi='$ngaythuchi' and sotien='$sotien' and lydo='$lydo' and loaitk='$idkho' and hdbh='$hdbh' and donvi='$donvi' and sotknh='$sotknh' and tentknh='$tentknh' and donvivc='$donvivc' and mavandon='$mavandon' and manv='$manv'    limit 1 ";
 
 	$sql  = " select ID from thuchikt where ngaythuchi='$ngaythuchi' and (psno='$sotien' or psco='$sotien' ) and lydo='$lydo' and loaitk='$idkho'  limit 1 ";
	//echo $sql."<br>";
		$chan = getdong($sql);   
	// echo $sql."<br>---"; and note='$note'
		if($chan['ID']){  
			 return false;	
		}
		return true;
}

function taomangtontai($ngaythuchi,$idkho){
	global $data;
	$sql  = " select ID,psno,psco,lydo from thuchikt where ngaythuchi='$ngaythuchi' and loaitk='$idkho'";
	//echo $sql;
	$query=$data->query($sql);
	$result=[];
	while($re=$data->fetch_array($query)){
			$tam=[];
			$tam['psno']=$re["psno"];
			$tam['psco']=$re["psco"];
			$tam['lydo']=$re["lydo"];
			$result[$re["ID"]]=$tam;
	} 
	return $result;
}


function kiemtratontaiDLmang($arr,$psno,$psco,$lydo){
	//var_dump($psno); 
//	echo "<br>";
//	var_dump($psco); 
	foreach($arr as $key => $value){
		if(trim($value["psno"])==$psno && trim($value["psco"])==$psco && trim($value["lydo"])==$lydo){
				return true;
		}
	}
	return false;
}
function checksotienhoadon($soct){
$sql="select sum(DonGia) as tongtiendg,(sum(ceil(a.DonGia*(1-1*a.chietkhau/100))*a.SoLuong)-b.tigia)
  as thanhtien from xuatbanhang a left join phieunhapxuat b on a.IDphieu=b.ID where b.SoCT='$soct' group by a.IDphieu ";

//$sql="select sum(DonGia) as tongtiendg,floor((sum((DonGia*(1-1*chietkhau/100))*SoLuong)-b.tigia)) as thanhtien from xuatbanhang a left join phieunhapxuat b on a.IDphieu=b.ID where b.SoCT='$soct' group by a.IDphieu ";
global $data;

$dong=getdong($sql);
	if($dong['tongtiendg']){
		return $dong;
	}
	else{
		return false;
	}
}

function checkhoadonthuongduyet($hdbh){

$sql="select a.IDHD as idhd,(a.sotien*(a.loaihuong/100)) as tienthuong from thuonghoadon a left join phieunhapxuat b on a.IDHD=b.ID where b.SoCT='$hdbh' and a.tinhtrang=44";
//echo $sql;
global $data;
$dong=getdong($sql);
if($dong['idhd']){
		return $dong;
	}
	else{
		return false;
	}

}

function checktaikhoandinhkhoan($madk){

$sql="select no,co,loai from dinhkhoanthuchi where ma='$madk'";

global $data;
$dong=getdong($sql);
if($dong['no'] || $dong['co']){
		return $dong;
	}
	else{
		return false;
	}


}

function create_slug($string)
    {
        $unicode = array(
            'a'=>'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ',
            'd'=>'đ',
            'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',
            'i'=>'í|ì|ỉ|ĩ|ị',
            'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',
            'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',
            'y'=>'ý|ỳ|ỷ|ỹ|ỵ',
			'A'=>'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
            'D'=>'Đ',
            'E'=>'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
            'I'=>'Í|Ì|Ỉ|Ĩ|Ị',
            'O'=>'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
            'U'=>'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
            'Y'=>'Ý|Ỳ|Ỷ|Ỹ|Ỵ',
        );
        
       foreach($unicode as $nonUnicode=>$uni){
            $str = preg_replace("/($uni)/i", $nonUnicode, $str);
       }
		return $str;
    }
	
	
function checktrunglap($r,$sheettam,$socotkiemtra,$k){
	$tam=[];
	$tam2=[];
		$check=0;
		for($i=$k+1;$i<=count($sheettam);$i++){
			$checkcount=0;
			for($j=0;$j<$socotkiemtra;$j++){
				if($r[$j]==$sheettam[$i][$j]){
					$checkcount++;
					
				}else{
					array_push($tam,$sheettam[$i]);
				}
			}	
			
			if($checkcount==$socotkiemtra){
				$check++;
				
				array_push($tam2,$i);
			/*	echo "<pre>";
					var_dump($tam2);
					echo "</pre>";
				*/
			}
		}
		
	return array("sodong"=>$check,"mangmoi"=>$tam,"mangindex"=>$tam2);
}



function validateDate($date){
if(!$date){
	return false;
}
else{

$date=explode("-",$date);
	 	$year=$date[0];
	
	$month=$date[1];
	$day=(int)($date[2]);
	/*var_dump(is_numeric($day));	
		echo $day;	*/
	if(is_numeric($year) && is_numeric($month) && is_numeric($day)){

		return true;
	}
	return false;
	
}
return false;
  
}  

function CheckVanChuyen($mavd)
{
global  $data;
    $sql = "SELECT ID,IDbill, mavd, sobill, madh, diachi, tinh, quan, phuong,trigiadon,phitravc,tongtien,donvivc from vanchuyenonline where mavd ='$mavd' or  madh ='$mavd'";
  //   echo $sql;
    $tam = getdong($sql);
	//var_dump($tam);
    return $tam;

}
function gettienvandon($mavd){
	$sql="select tongtien,trigiadon from vanchuyenonline where mavd='$mavd' or madh='$mavd'";
	//echo $sql;
	$dong=getdong($sql);
	return $dong['tongtien'];
}
function dateDiffMi($ngay1,$ngay2){
//echo "ngay2: ".$ngay2."<br/>";
//echo "ngay1: ".$ngay1;
$to_time = strtotime($ngay1);
$from_time = strtotime($ngay2);
return round(abs($ngay2 - $ngay1)/60/60,2);
}


function kiemtratrungngay($ngay1,$ngay2){
	return (date("d",$ngay1)==date("d",$ngay2)  && date("m",$ngay1)==date("m",$ngay2) && date("Y",$ngay1)==date("Y",$ngay2));

}
?>	