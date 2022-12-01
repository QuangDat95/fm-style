<?php  
session_start();
//set_time_limit(0);
 $quyen= $_SESSION["quyen"] ; 
 date_default_timezone_set('Asia/Ho_Chi_Minh');
//ini_set('memory_limit', '-1');$_SESSION["act"]
if ($_SESSION["LoginID"]=="") return ;
$ql =$quyen[$_SESSION["mangquyenid"][$_SESSION["act"]]] ;  

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

$mangDVVC=["GHTK","J&T","VTP","VNPOST","SHOPEE","LAZADA","FM","NINJA VAN","MTT","TM","CH","SHOPEE 1","SHOPEE 2","SHOPEE 3","SHOPEE 7","SHOPEE KIDS","DNA"];
 //$path = $root_path."data/maubanhangpancake.xlsx"  ; 
 //var_dump($ql[5]); 
$idk = laso($_SESSION["LoginID"]) ; if ($idk == 0) return ;
   $idkho = $_SESSION["se_kho"];
$data = new class_mysql();
$data->config();
$data->access();

//$ql[5]=1;
?>
<div style="overflow:scroll;height:400px">
<style>.tbchuan th, .tbchuan td{
	white-space: pre-wrap;
}</style>
<strong style="color:#F90">Đọc dữ liệu từ dòng 13 của file Excel</strong> <br />
<table id="tbex" width="100%" border="0" cellpadding="0" cellspacing="0" style="background:#FFF;" class="tbchuan">		
 		<tr bgcolor="#F8E4CB">
		  <td align="center"  height="23" width="35"><b>STT</b></td>
          <td align="center"  height="23" width="43"><b>Ngày</b></td>
		  <td width="98" align="center"  ><strong>CH/BP</strong></td>  
 		  <td width="72" align="center" ><strong>Thu/Chi</strong></td> 
          <td width="72" align="center" ><strong>Mã</strong></td>
          <td width="100" align="center" ><strong>Khoản mục thu/chi</strong></td>
		
		   <td width="72" align="center" ><strong>Diễn giải</strong></td> 
          <td width="72" align="center" ><strong>TK nợ</strong></td>
		     <td width="72" align="center" ><strong>TK có</strong></td>
			 <td width="72" align="center" ><strong>PS nợ</strong></td>
			 <td width="72" align="center" ><strong>ĐVT</strong></td>
			  <td width="72" align="center" ><strong>Số lượng</strong></td>
			 <td width="72" align="center" ><strong>Đơn giá</strong></td>
			 <td width="72" align="center" ><strong>PS có</strong></td>
			 <td width="72" align="center" ><strong>HĐBH</strong></td>
			 <td width="72" align="center" ><strong>STK NH</strong></td>
			 <td width="72" align="center" ><strong>Tên TK NH</strong></td>
			  <td width="72" align="center" ><strong>Đơn vị vận chuyển</strong></td>
			 <td width="72" align="center" ><strong>Mã vận đơn</strong></td>
			<!-- <td width="72" align="center" ><strong>Mã vận đơn Shoppe</strong></td>
			 <td width="72" align="center" ><strong>Mã vận đơn Lazada</strong></td>
			 <td width="72" align="center" ><strong>Tiki</strong></td>-->
			 <td width="72" align="center" ><strong>Ncc</strong></td>
			  <td width="72" align="center" ><strong>Họ và tên NV</strong></td>
			   <td width="72" align="center" ><strong>MÃ NV</strong></td>
			    <td width="72" align="center" ><strong>Phiếu xuất</strong></td>
				  <td width="72" align="center" ><strong>Phí thu KH</strong></td>
				 
  	 </tr>
<?php

$tm = $_SESSION["root_path"] ;

//đọc dữ liệu
$path = $root_path."data/thuchi".'-'.$idk.'-'.$idkho.".xlsx" ;
$xlsx = new SimpleXLSX($path);
//var_dump($xlsx);
$sheets=$xlsx->rows();
$sheettam=$sheets;


$rows_begin = 12;
$rows_end = count($sheets);
$tam=[];
$loi=false;
if ($count_rows >= 600) $rows_end = 600;
list($cols,) = $xlsx->dimension();
$cols=23;
if(isset($_POST['DATA'])){
	$data1 = $_POST['DATA']; 
	$tmp = explode('*@!',$data1);
	$tudong=laso($tmp[1]);
	
	$dendong=laso($tmp[2]);
	if($tudong){
		$rows_begin =($tudong-1);
	}
	if($dendong){
		$rows_end=($dendong-1);
	}	
	
	$sott=0;
		$mangch = taomang ("cuahang","macuahang","ID"); 
		$mangdk = taomang ("dinhkhoanthuchi","ma","ID"); 
		//var_dump($mangch);
		$mangtk = taomang ("dinhkhoan","ID","madinhkhoan"); 
		//'17','18','19','20',
		$mangchecktontai=['14','15','19','21','22'];
	$mangcheckhople=['20'];
	$kiemtratienchechlech='';
	$mangindextrung=[];
	
	foreach($sheets as $k => $r) {
		
		$checkloi=true;		
		$onclick=''; 
		$mauchu='green';
		$baoloirong='';
		$count2dong='';
		$luachon=0;
		if (($k >= $rows_begin) && ($k <= $rows_end)) {
		
			if(trim($r[3])=='DTBH'){
						continue;
				}
				$sott++;
				if((trim($r[8])=='') && (trim($r[12])=='')){
						$mauchu='red';
								$baoloirong .='Đơn giá, PS nợ và PS có rỗng!';
								$checkloi=false;
							$loi=true;
							
				}
				
				if(!trim(str_replace("\t","",$r[2])) || trim(str_replace("\t","",$r[2]))=='' ){
						$mauchu='red';
								$baoloirong .='Kiểm tra lại thu chi!';
								$checkloi=false;
							$loi=true;
						echo $r[2];
				}
					
			//	echo trim($r[10])*trim($r[11]);
				//echo trim($r[12])*1;
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
				
				/*if(trim($r[17])){
					if(!CheckVanChuyen(trim($r[17]))['ID']){
							$mauchu='red';
								$baoloirong .='Mã vận đơn không tồn tại trên hệ thống!';
								$checkloi=false;
							$loi=true;
					}
				}*/
			if(!validateDate($r[0])){
						$mauchu='red';
						$baoloirong .='Ngày thu chi rỗng hoặc sai định dạng! \n';
						$checkloi=false;
						$loi=true;
						
			}
			
			
			$checktrunglap=checktrunglap($r,$sheettam,26,$k);
			$count2dong=$checktrunglap["sodong"];
			//$sheettam=$checktrunglap["mangmoi"];
			$mangindextrung=$checktrunglap["mangindex"];
			
		//var_dump($mangindextrung);
		
			if(in_array($k,$mangindextrung) || $count2dong>0){
				$dongtrungnhau='';
		
				foreach($mangindextrung as $key => $value){
					
						$dongtrungnhau.="$value,";
					
					$keytam++;
				}
						$mauchu='red';
						$baoloirong .='dòng trùng nhau! kiểm tra các dòng'.$k.' '.$dongtrungnhau.'\n';
						$checkloi=false;
						$loi=true;
			}
			
			
			//echo $r[22];
			if(trim($r[3]) && trim($r[3])!=''){
				
				
				if(!$mangdk[trim($r[3])]){
						$mauchu='red';
						$baoloirong .='Mã định khoản không tồn tại!';
						$checkloi=false;
						$loi=true;
				}
				else{
					//1=nợ 6 0 =co 7
					$arridtk=checktaikhoandinhkhoan($r[3]);
					if(strtolower(trim($r[2]))=='thu'){
						
						$luachon=1;
					}
					else if(strtolower(trim($r[2]))=='chi'){
						
						$luachon=2;
					}
					
					if($arridtk["loai"]!=$luachon){
						$mauchu='red';
						$baoloirong .='vui lòng kiểm tra lại thu chi!';
						$checkloi=false;
						$loi=true;
					}
						
					if($r[6]){
						//$r[6];
						//var_dump($arridtk);
						
						/*if($mangtk[$arridtk['no']]!=$r[6]){
							$mauchu='red';
								$baoloirong .='Mã tài khoản nợ không đúng!';
								$checkloi=false;
							$loi=true;
						}*/
					}
					
					if($r[7]){
						//$r[6];
						/*if($mangtk[$arridtk['co']]!=$r[7]){
							$mauchu='red';
								$baoloirong .='Mã tài khoản có không đúng!';
								$checkloi=false;
							$loi=true;
						}*/
					}
				}
				
				
					$kiemtracuahang=checkcuahang(trim($r['1']));
					//var_dump($kiemtracuahang);
					if(!$kiemtracuahang["ID"]){
						$mauchu='red';
						$baoloirong .='Cửa hàng không tồn tại!';
						$checkloi=false;
						$loi=true;
					}
					else{
						if($_SESSION["LoginID"]!=7576 && $_SESSION["LoginID"]!=4647 && !$ql[5]){
								if($kiemtracuahang["ID"]!=$_SESSION["se_kho"]){
									$mauchu='red';
									$baoloirong .='Cửa hàng không được phép tải lên!';
									$checkloi=false;
									$loi=true;
								}
							
						}
					}
					$thongtinchuoi=getthongtin(trim($r[3]));
					
					$artt=checkcol($thongtinchuoi['thongtin'],$r);	
				/*echo "<pre>";
					var_dump($artt);
					echo "</pre>";*/
					if(count($artt['rong'])>0){
					
						foreach($artt['rong'] as $key => $value){
							
							$baoloirong .=xuatbaoloirong($value);
							
						}
							
						$mauchu='red';
						$checkloi=false;
						$loi=true;	
							
					}
					
					//$donvi,$sotknh,$tentknh,$donvivc,$mavd,$manv
					//echo date("Y-m-d",strtotime($r[0]));
					if(!kiemtratontaidulieu(date("Y-m-d",strtotime($r[0])),$r[11],addslashes($r[4]),$mangch[strtoupper($r[1])],trim($r[13]),$r[9],$r[14],$r[15],$r[16],$r[17],$r[22],addslashes($r[5]))){
						$baoloirong .="Dòng này đã tồn tại!\\n"; 
						$mauchu='#8b2405';
						
						$checkloi=false;
						$loi=true;
					}
					if(!$r[0]){
						$baoloirong .="Ngày thu chi rỗng!\\n"; 
					   $checkloi=false;
					   $mauchu='red';
						$loi=true;	 
					}
					$datetam=explode("-",$r[0]);
					if($datetam[0]<date("Y")){
							
						 $baoloirong .="Năm thu chi nhỏ hơn năm hiện tại!\\n"; 
					   $checkloi=false;
					   $mauchu='red';
						$loi=true;	
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
							//var_dump((int)$strcrr-(int)strtotime($loadden));
//							echo "<br/>hiện tại: ".$strcrr."<br/>";
//					  echo "den: ".strtotime($loadden)."<br/>";
//					  echo "từ: ".strtotime($loadtu)."<br/>";
					//var_dump($cuahangchophep);
						//if($strcrr<=strtotime($loadden) && $strcrr>=strtotime($loadtu)){
								//$currdate=strtotime($r[0]);
								$currdate=date("d",strtotime($r[0]));
								$currmonth=date("m",strtotime($r[0]));
								$curryear=date("Y",strtotime($r[0]));
								 	//$thanghientai=date('m');
									
									//echo "<br>".$thanghientai;
							 //var_dump(in_array($mangch[strtoupper(trim($r[1]))],$cuahangchophep));
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
							$baoloirong .="Không được tải lên trùng ngày!\\n"; 
							 $checkloi=false;
						   $mauchu='red';
							$loi=true;
						}
							//+++++++++++++++
						if($quahan==true){
						
							$baoloirong .="Ngày thu chi Quá hạn!\\n"; 
							 $checkloi=false;
						   $mauchu='red';
							$loi=true;
							
						}
				   }
				if(strtotime($r[0])>strtotime(gmdate('Y-n-d'),time() + 7*3600))
				   {
					   $baoloirong .="Ngày thu chi lớn hơn ngày hiện tại!\\n"; 
					   $checkloi=false;
					   $mauchu='red';
						$loi=true;	 
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
									$baoloirong .=xuatbaoloitontai($value);
									$mauchu='red';
									$checkloi=false;
									$loi=true;
								}
								else{
									if($value==21){
									
			/*echo create_slug(trim($checktontai['dulieu']))."<br>";
			echo create_slug(trim($r[21]))."<br>";*/
										if(create_slug(trim($checktontai['dulieu']))!=create_slug(trim($r[21]))){
											
										$checkloi=false;
										$loi=true;
											$baoloirong .=xuatbaoloitontai(20);
											//var_dump($checktontai);
											$baoloirong .="Tải lên: ".$r[20]."-".$r[19]."\\n";
											$baoloirong .="Gốc: ".$r[20]."-".$checktontai['dulieu']."\\n";
											$mauchu='red';
											
										}
									}
								
									if($value==14){
									$checktiendung=true;
												if($r[3]=='CPTBNV'){
														$tienthuongcheck=checkhoadonthuongduyet(trim($r[13]));
														if($tienthuongcheck['tienthuong']){
																if(trim($r[8])!='' && $r[8]!=$tienthuongcheck['tienthuong']){
																	$checktiendung=false;
																	$baoloirong .="Tiền thưởng bill của đơn hàng không trùng với cột PS Nợ\\n";
																}
																else if(trim($r[12])!='' && $r[12]!=$tienthuongcheck['tienthuong']){
																	$checktiendung=false;
																	$baoloirong .="Tiền thưởng bill của đơn hàng không trùng với cột PS Có\\n";
																
																}
														}
														if(!$checktiendung){
															$checkloi=false;
															$loi=true;
														
															$mauchu='red';
														}
												}
												else{
												//var_dump($r[13]);
													//var_dump($sheets[$k+1][13]);
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
													
														/*echo "<pre>";
													var_dump($tiendonhang);
												echo "</pre>";*/
													if($tienkiemtrapsno){
														/*if($tienkiemtrapsno<=(abs($tiendonhang['thanhtien'])+2) && $tienkiemtrapsno>=(abs($tiendonhang['thanhtien'])-2)){*/
																
															if($tienkiemtrapsno!=abs($tiendonhang['thanhtien'])){
																$checktiendung=false;
																$baoloirong .="Tổng tiền của đơn hàng không trùng với cột PS Nợ\\n";
															
														}
														else{
															//$checktiendung=false;
																//$baoloirong .="Tổng tiền của đơn hàng không trùng với cột PS Nợ\\n";
														}
													}
													else if($tienkiemtrapsco){
														/*if($tienkiemtrapsco<=(abs($tiendonhang['thanhtien'])+2) && $tienkiemtrapsco>=(abs($tiendonhang['thanhtien'])-2) ){*/
															
															if($tienkiemtrapsco!=abs($tiendonhang['thanhtien'])){
																$checktiendung=false;
																$baoloirong .="Tổng tiền của đơn hàng không trùng với cột PS Có\\n";
															
														}
														else{
															//$checktiendung=false;
															//	$baoloirong .="Tổng tiền của đơn hàng không trùng với cột PS Có\\n";
														}
														
													}
													
													if(!$checktiendung){
														$checkloi=false;
														$loi=true;
														
														$mauchu='red';
													}
												}
												//var_dump($checktiendung);
													
											}
									}
								}
							}
							
						
					
						
					}
					if(!$checkloi){
						$onclick="xuatbaoloi('".$baoloirong."')";
						
					}
					//$onclick="xuatbaoloi('".$baoloirong."')";
					
		?>
			<tr id="" style="cursor:pointer;color:<?=$mauchu?>" onclick="<?=$onclick?>">
				<td align="center"><?php echo $sott  ;?></td>	
		<?php		
				for($i=0;$i<($cols);$i++){
				
					if($i==0){
					?>
						<td align="left"><?php 
						if(validateDate($r[0])){
							
						 echo date("d/m/Y",strtotime($r[$i]));
						 }else{
							echo '';
						} ?></td>	
					
					<?php
					}
					else{
						if($i!=25){
						
							if($i==4 || $i==5){
								?>
									<td align="left" style="min-width:200px;max-width:200px"><span><?php echo $r[$i]?></span></td>		
								<?php
							}
							else{
							
							?>
								<td align="left"><?php echo $r[$i]?></td>	
							<?php
							}
						}
						
					}
					
				
		
				}
		?>
				</tr>	
				<?php	
			}
			 
		}
	  
		
	} 
	
	
}


?>

</table>  


</div>

<?php
 
if ($loi) {?>

<div style="padding-bottom:10px;padding-left:20px"><input type="button" id="dulieue" name="dulieue"  onclick="xuatbaoloi('Có lỗi trong file tải lên chú ý chổ màu đỏ!')" value="Lấy dữ liệu Excel"/> </div>  
 <?php
}
 else  
 {
 ?>
 <div style="padding-bottom:10px;padding-left:20px"><input type="button" id="dulieue" name="dulieue"  onclick="laydulieuexel()" value="Lấy dữ liệu Excel"/> </div>  
  <?php
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
			$sql="select SoCT as dulieu from phieuxuat where SoCT='".trim($r[$so-1])."'";
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
 		//$sql  = " select ID from thuchikt where ngaythuchi='$ngaythuchi' and sotien='$sotien' and lydo='$lydo' and loaitk='$idkho' and hdbh='$hdbh' and donvi='$donvi' and sotknh='$sotknh' and tentknh='$tentknh' and donvivc='$donvivc' and mavandon='$mavandon' and manv='$manv'    limit 1 ";
	$sql  = " select ID from thuchikt where ngaythuchi='$ngaythuchi' and (psno='$sotien' or psco='$sotien' ) and lydo='$lydo' and loaitk='$idkho'  limit 1 ";
	//echo $sql."<br>";
		$chan = getdong($sql);   
	// echo $sql."<br>---"; and note='$note'
		 if ($chan['ID']){  
			 return false;	
		}
		return true;
}

function taomangtontai($ngaythuchi,$idkho){
	$sql  = " select ID from thuchikt where ngaythuchi='$ngaythuchi' and (psno='$sotien' or psco='$sotien' ) and lydo='$lydo' and loaitk='$idkho'";
	
	
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



function checknhacungcap($NCC){

$sql="select ID from nhacungcap where ID=$NCC";

global $data;
$dong=getdong($sql);
if($dong['ID']){
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