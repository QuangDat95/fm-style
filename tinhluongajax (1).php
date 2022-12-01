<?php
session_start();
//if ($_SESSION["LoginID"] =='') { return ; }
function in($str){echo "<pre>";var_dump($str);echo '</pre>';}

//$giobatdau1=7.3;$g=floor($giobatdau1); $p=$giobatdau1-$g;if($p<0.6&&$p>0) $p=$p*100; echo $p ;
  
//   return;
  
$root_path =getcwd()."/"  ;
include($root_path."biensession.php");
include($root_path."includes/config.php");
include($root_path."includes/removeUnicode.php");
include($root_path."includes/class.paging.php");
include($root_path."includes/class.mysql.php");
include($root_path."includes/function.php");
include($root_path."myfunction.php"); 	

$data = new class_mysql();
$data->config(); 
$data->access();

if(isset($_POST['LOADMOI'])){
		  $data1 = $_POST['LOADMOI']; 
		$tmp = explode('*@!',$data1);
        $thanggoc= trim($tmp[0]);
		$thang= explode("-",$thanggoc);
		$nam=$thang[0];
		$ngay=$thang[2];
		$thang=$thang[1];
		$ngaybd=$nam."-".$thang."-01";
		$ngaykt=$nam."-".$thang."-31 23:59:00";
		$tongngaythang=cal_days_in_month(CAL_GREGORIAN,$thang,$nam);
	$sql_where .= " where  a.ngaytao>='$ngaybd' and  a.ngaytao<='$ngaykt' ";
		
 				$r =1 ;	 
		  
 	    $mangchucvu= taomang("kh_chucvu","ID","Name");
		
		$manglamthem='';
 //==================mang tang ca ============================================				
		$sql2 ="select sum(sophut) as sophut,idnv from phieutangca where thoigianbatdau>='$ngaybd' and thoigianketthuc<='$ngaykt' and left(tinhtrang,1)=4 group by idnv";
		if ($_SESSION["admintuan"]) echo "<br>".$sql2 ."<br>";
    	$result = $data->query($sql2);	 
		$mangtt='';
		while ($rec = $data->fetch_array($result)  )	 
		{   	
		   $manglamthem[$rec['idnv']]=$rec['sophut'] ; 
   		}		
		

			$sql = "SELECT b.ten as name,b.NgayVaoLam,b.luongcoban,a.ngaytao,a.loai,a.thongtin,a.IDnhanvien,a.manv,b.cuahang as IDch  ,DATE_FORMAT( a.ngaytao,'%d/%m/%Y') as ngay,DATE_FORMAT( a.ngaytao,'%e') as ngaylam,DATE_FORMAT( a.ngaytao,'%H') as gio,DATE_FORMAT(a.ngaytao,'%a') as thu,DATE_FORMAT( a.ngaytao,'%i') as phut,b.chucvu   FROM nhanviendilam a left join userac b on b.ID = a.IDnhanvien ".$sql_where." ORDER BY  a.IDnhanvien,a.ngaytao asc    ";


	  $r =1;
	//==============================================================	
	//	if ($_SESSION["admintuan"]) echo $sql . " chuc vu:".   $loaiusertim ; ;
 	// echo ( strtotime('2011-09-01 10:03') -  strtotime('2011-09-01 10:02')  ) ;
	 
	$result = $data->query($sql);
	$manv ='';
	$tongngay=0;
	$idnv=0;
	$idnvc=0;
	$ngay=0;
	$mangnv='';
	$ditre=1; 
	$ngaythuluu='';
	//biến đếm số lần quét
	$checktruocsang=false;
	$checksang=false;
	$checktrua=false;
	$checkchieu=false;
	$checksauchieu=false;
	$checkvao=false;
			$checkra=false;
			$checktre2=false;
	$lanthu=1;
	$giovao='';
	$giora='';
	$gioquetkt='';
	// lấy các thông tin từ đầu mỗi dòng
	$giobatdau1='';
	$gioketthuc1='';
	$giobatdau2='';
	$gioketthuc2='';
	$sogiolam='';
	$loaigiotam='';
	$chucvutam='';
	$cuahangtam='';
	$mangcv = taomang ("kh_chucvu","ID","LCASE(Name)"); 
	$mangch = taomang ("cuahang","ID","LCASE(Name)"); 
	$mangtam=[];
	//var_dump($mangcv);
	$k=0;
	$checkdau=false;
while($re = $data->fetch_array($result))
{    		
		
		//echo "123";
		 if($gioquetkt==''){
		 	$gioquetkt=$re['gio'].".".$re['phut'];
		 }
	
	
	//quet lan thứ n
	$lanthu++;
	$idnv=$re['IDnhanvien'];
	//gio quet
	$createDate = new DateTime($re['ngaytao']);
	$re['ngaytao'] =$createDate->format('Y-m-d H:i');
	
		//echo  $gioquetngay;
		$ngaythu =$re['ngaylam']; 
		//$thongtinnv=tachthongtin($re['thongtin']);
		if(!$checkdau){
			
			$idnvc=$re['IDnhanvien'];
			// lấy các thông tin từ đầu mỗi dòng mỗi ngày
				// mảng thông tin từ chuỗi
				$thongtinnv=explode("*",$re['thongtin']);
				$giobatdau1=convertHtoM($thongtinnv['2'])['totalp'];
				$gioketthuc1=convertHtoM($thongtinnv['3'])['totalp'];
				$giobatdau2=convertHtoM($thongtinnv['4'])['totalp'];
				$gioketthuc2=convertHtoM($thongtinnv['5'])['totalp'];
				$sogiolam=convertMtoH($thongtinnv['1'])['totalp'];
					//echo $re['ngay'];
			//kiem tra thu
			$thumay=$re['thu'];
			
				//kiểm tra giờ ra vào
				$loaigiotam=$thongtinnv[0];
				$chucvutam=$thongtinnv[6];
				$chucvuchinh=$re['chucvu'];
				//echo $mangcv[$chucvuchinh];
				$mangnv[$idnv]["$ngaythu"]['chuoithongtin']= $re['thongtin'];  
				$mangnv[$idnv]['sogiolam']= 1*$sogiolam;    
				$mangnv[$idnv]['chucvu']= $chucvuchinh; 
				$mangnv[$idnv]['tenchucvu']= $mangcv[$chucvuchinh];
				$mangnv[$idnv]['IDcuahang']=$re['IDch'];
				$mangnv[$idnv]['cuahang']= $mangch[$re['IDch']];
				//echo $re['chucvu'];		
				$mangnv[$idnv]['ten']=  $re['name']; 
				$mangnv[$idnv]['manv']=  $re['manv']; 
				$mangnv[$idnv]['luongcoban']=  $re['luongcoban']; 
				$mangnv[$idnv]['ngayvaolam']=  $re['NgayVaoLam']; 
				//thay đổi theo ngày
			
				//echo $re['IDch'];
				
				$mangnv[$idnv]["$ngaythu"]['IDcuahang']= $re['IDch'];
				$mangnv[$idnv]["$ngaythu"]['thu']= $thumay; 
				$mangnv[$idnv]["$ngaythu"]['giobatdau1']= $giobatdau1 ; 
				$mangnv[$idnv]["$ngaythu"]['giobatdau2']= $giobatdau2 ; 
				$mangnv[$idnv]["$ngaythu"]['gioketthuc1']= $gioketthuc1 ; 
				$mangnv[$idnv]["$ngaythu"]['gioketthuc2']= $gioketthuc2 ; 
				$mangnv[$idnv]["$ngaythu"]['sogiolam']= 1*$sogiolam; 
				$mangnv[$idnv]["$ngaythu"]['loaigio']=  $loaigiotam ;  
				$mangnv[$idnv]["$ngaythu"]['chucvu']= $chucvutam; 
				$mangnv[$idnv]["$ngaythu"]['tenchucvu']= $mangcv[$chucvutam]; 
			//echo $chucvuchinh;
			$checkdau=true;
		}
	
		if($ngaythu!=$ngaythuluu)
		{
			$ngaythuluu=$ngaythu ;
			$sophuttre=0;
			 $gioquetngay=0;
			// lấy các thông tin từ đầu mỗi dòng mỗi ngày
			// mảng thông tin từ chuỗi
			$thongtinnv=explode("*",$re['thongtin']);
			$giobatdau1=convertHtoM($thongtinnv['2'])['totalp'];
			$gioketthuc1=convertHtoM($thongtinnv['3'])['totalp'];
			$giobatdau2=convertHtoM($thongtinnv['4'])['totalp'];
			$gioketthuc2=convertHtoM($thongtinnv['5'])['totalp'];
			$sogiolam=convertMtoH($thongtinnv['1'])['totalp'];
				//echo $re['ngay'];
		//kiem tra thu
		$thumay=$re['thu'];
		
			//kiểm tra giờ ra vào
			$loaigiotam=$thongtinnv[0];
			$chucvutam=$thongtinnv[6];
			$chucvuchinh=$re['chucvu'];
			$mangnv[$idnv]["$ngaythu"]['chuoithongtin']= $re['thongtin'];  
			$mangnv[$idnv]['sogiolam']= 1*$sogiolam;    
			$mangnv[$idnv]['chucvu']= $chucvuchinh; 
				$mangnv[$idnv]['tenchucvu']= $mangcv[$chucvuchinh];
			$mangnv[$idnv]['cuahang']= $mangch[$re['IDch']];
			$mangnv[$idnv]['IDcuahang']=$re['IDch'];
			$mangnv[$idnv]['ngayvaolam']=  $re['NgayVaoLam']; 
		$mangnv[$idnv]['luongcoban']=  $re['luongcoban']; 	
			$mangnv[$idnv]['ten']=  $re['name']; 
			$mangnv[$idnv]['manv']=  $re['manv']; 
			//thay đổi theo ngày
		
			//echo $re['IDch'];
			
			$mangnv[$idnv]["$ngaythu"]['IDcuahang']= $re['IDch'];
			$mangnv[$idnv]["$ngaythu"]['thu']= $thumay; 
			$mangnv[$idnv]["$ngaythu"]['giobatdau1']= $giobatdau1 ; 
			$mangnv[$idnv]["$ngaythu"]['giobatdau2']= $giobatdau2 ; 
			$mangnv[$idnv]["$ngaythu"]['gioketthuc1']= $gioketthuc1 ; 
			$mangnv[$idnv]["$ngaythu"]['gioketthuc2']= $gioketthuc2 ; 
			$mangnv[$idnv]["$ngaythu"]['sogiolam']= 1*$sogiolam; 
			$mangnv[$idnv]["$ngaythu"]['loaigio']=  $loaigiotam ;  
			$mangnv[$idnv]["$ngaythu"]['chucvu']= $chucvutam; 
			$mangnv[$idnv]["$ngaythu"]['tenchucvu']= $mangcv[$chucvutam]; 
		
			$giovao='';
			$giora='';
			 $checkvao=false;
			$checkra=false;
			$checktruocsang=false;
			$checksang=false;
			$checktrua=false;
			$checkchieu=false;
			$checksauchieu=false;
			$checktre2=false;
			$tinh=false;
			$lanthu=1;
			
		}
		//echo $re['IDnhanvien'];
		if($idnvc!=$re['IDnhanvien'] )
		{    
			//$idnvc=$re['IDnhanvien'];
			if($idnvc) $mangnv[$idnvc]['tongnay']= $tongngay ;
			
			$sophuttre=0;$ditre=0; $vesom=0;$tongngay= 0; $ngay = $re['ngay'] ;
			$idnv=$re['IDnhanvien'];
			$checkdau=false;
			
		}
		
		 if ($re['ngay'] != $ngay)  {  $tongngay ++; $ngay = $re['ngay']; }
		  $gioquetngay= $re['gio']*60+$re['phut'];
	//echo $tongngay."<br>";
		//&& $re['cuahang']!=1 && $thumay!='Sun'
		//echo $thumay
		
		$htam=strlen(convertHtoM($thongtinnv['5'])['h'])==1?"0".convertHtoM($thongtinnv['5'])['h']:convertHtoM($thongtinnv['5'])['h'];
		$ptam=strlen(convertHtoM($thongtinnv['5'])['p'])==1?"0".convertHtoM($thongtinnv['5'])['p']:convertHtoM($thongtinnv['5'])['p'];
		$giocuoi=$htam.":".$ptam.":00";
		
		
		 $ktbuoi=kiemtrasolanquet($giobatdau1,$giobatdau2,$gioketthuc1,$gioketthuc2,$gioquetngay,$giovao,$gioquetkt);
				 	if($giobatdau1 !=0 && $giobatdau2!=0 && $gioketthuc1!=0 && $gioketthuc2!=0 	){
		//echo $thumay;
				if($loaigiotam==2 ){
				
				if($ktbuoi==1){
						
					
						$giovao =strtotime($re['ngaytao']);
					//$giovao =strtotime(chuyenngaychuan($re['ngaytao'],$giobatdau1));
					$mangnv[$idnv]["$ngaythu"]['giovao'.$lanthu]=$re['ngaytao'];
					
				}	
				else if($ktbuoi==2){
					if($re['IDch']!=1){
						if($giovao){
								$mangnv[$idnv]["$ngaythu"]["thieugio1"]=$re['gio'].".".$re['phut'];
							
						}
						else{
						
							if(!$giora){
								$mangnv[$idnv]["$ngaythu"]["ditre1"]=$re['gio'].".".$re['phut'];
								//$checktre2=true;
							}
						}
					}
					$tinh=true;
					
				}	
				else if($ktbuoi==3){
					
			
					$tinh=true;
				}
				else if($ktbuoi==4){
					if($re['IDch']!=1){
							if($giovao){
								
									$mangnv[$idnv]["$ngaythu"]["thieugio2"]=$re['gio'].".".$re['phut'];
									
							}
							else{
								
								$mangnv[$idnv]["$ngaythu"]["ditre2"]=$re['gio'].".".$re['phut'];
								
							}
						}
					$tinh=true;
						
				}
				else if($ktbuoi==5){
			
						
						$tinh=true;
				}
				if($tinh){
					
							if($giovao){
								
								$giora = strtotime($re['ngaytao']);
									//strtotime(chuyenngaychuan($re['ngaytao'],$giobatdau1)
									$sophut=$giora-$giovao;
									 
									$giora= $re['gio']*60+$re['phut'];
									 $mangnv[$idnv]["$ngaythu"]['giora'.$lanthu]=$re['ngaytao'];
									
									 $mangnv[$idnv]["$ngaythu"]['giolamd'] += $sophut;
									 $mangnv[$idnv]['tongcong']+= $sophut;
									 $giovao='';
							}
							else{
								$giovao =strtotime($re['ngaytao']);
								$mangnv[$idnv]["$ngaythu"]['giovao'.$lanthu]=$re['ngaytao'];
								
							}
					}
				}
				else if($loaigiotam==1 || $loaigiotam==3){
				
					
					if($ktbuoi==1 && !$checktruocsang){
					
						$giovao =strtotime($re['ngaytao']);
						$mangnv[$idnv]["$ngaythu"]['giovao'.$lanthu]=$re['ngaytao'];
						$checktruocsang=true;
					}	
					else if($ktbuoi==2 &&  !$checksang){
							if($re['IDch']!=1){
								if($giovao){
										$mangnv[$idnv]["$ngaythu"]["thieugio1"]=$re['gio'].".".$re['phut'];
										
								}
								else{
							
									$mangnv[$idnv]["$ngaythu"]["ditre1"]=$re['gio'].".".$re['phut'];
									
								}
							}
						$tinh=true;
						$checksang=true;
						
					}	
					else if($ktbuoi==3 && !$checktrua){
						
							
						$tinh=true;
						$checktrua=true;
					}
					else if($ktbuoi==4 && !$checkchieu){
							if($re['IDch']!=1){
								if($giovao){
									
										$mangnv[$idnv]["$ngaythu"]["thieugio2"]=$re['gio'].".".$re['phut'];
										
								}
								else{
									
										$mangnv[$idnv]["$ngaythu"]["ditre2"]=$re['gio'].".".$re['phut'];
									
								}
							}
							$tinh=true;
							$checkchieu=true;
					}
					else if($ktbuoi==5 && !$checksauchieu){
				
							if($giovao){
									$tinh=true;
									
							}
							
							
							$checksauchieu=true;
					}
					//+++++++++++++++++++++
					else if($ktbuoi==6){
					if($re['IDch']!=1){
							if($giovao){
								
							}
							else{
								
									$mangnv[$idnv]["$ngaythu"]["ditre1"]=$re['gio'].".".$re['phut'];
								
							}
						}
							$tinh=true;
					}
					else if($ktbuoi==7){
					//echo "ok";
						if($re['IDch']!=1){
							if($giovao){
								$mangnv[$idnv]["$ngaythu"]["thieugio1"]=$re['gio'].".".$re['phut'];
								
							}
							else{
								//$mangnv[$idnv]["$ngaythu"]["ditre"]=$re['gio'].".".$re['phut'];
							}
						}
							$tinh=true;
					}
					else if($ktbuoi==20){
							
							
							$tinh=true;
							
					}
					else if($ktbuoi==21){
							
							$tinh=true;
							
					}
					else if($ktbuoi==22){
					if($re['IDch']!=1){
							if($giovao){
								$mangnv[$idnv]["$ngaythu"]["thieugio2"]=$re['gio'].".".$re['phut'];
								
							}
							else{
								//$mangnv[$idnv]["$ngaythu"]["ditre"]=$re['gio'].".".$re['phut'];
							}
						}
							$tinh=true;
							
					}
					if($gioketthuc1>=giobatdau2){
						 $mangnv[$idnv]["$ngaythu"]['xoayca']=1;
							if($giovaotam){
									$gioratam = strtotime($re['ngaytao']);
									$sophut=$gioratam-$giovaotam;
									//$gioratam= $re['gio']*60+$re['phut'];
									 $mangnv[$idnv]["$ngaythu"]['giolamdtam'] += $sophut;
									// $mangnv[$idnv]['tongcongtam']+= $sophut;
									 $giovaotam='';
							}
							else{
								$giovaotam =strtotime($re['ngaytao']);
								
							}
						//trường hợp giờ kết thúc 1 > giờ bắt đầu 2
					 if($ktbuoi==8 && !$checkvao){
								$giovao =strtotime($re['ngaytao']);
								$mangnv[$idnv]["$ngaythu"]['giovao'.$lanthu]=$re['ngaytao'];
								$checkvao=true;
						}
						else if($ktbuoi==9 && !$checkvao){
									$giovao =strtotime($re['ngaytao']);
								$mangnv[$idnv]["$ngaythu"]['giovao'.$lanthu]=$re['ngaytao'];
								if($re['IDch']!=1){
									$mangnv[$idnv]["$ngaythu"]["ditre1"]=$re['gio'].".".$re['phut'];
								}
								$checkvao=true;
						}
						else if($ktbuoi==10 && !$checkra){
								$mangnv[$idnv]["$ngaythu"]["thieugio"]=$re['gio'].".".$re['phut'];
								$tinh=true;
								$checkra=true;
						}
						else if($ktbuoi==11 && !$checkra){
						
								$tinh=true;
								$checkra=true;
						}else if($ktbuoi==12 && !$checkvao){
							
								$giovao =strtotime($re['ngaytao']);
								$mangnv[$idnv]["$ngaythu"]['giovao'.$lanthu]=$re['ngaytao'];
								$checkvao=true;
						}
						else if($ktbuoi==13 && !$checkra){
								$mangnv[$idnv]["$ngaythu"]["thieugio"]=$re['gio'].".".$re['phut'];
								$tinh=true;
								$checkra=true;
						}
						else if($ktbuoi==14 && !$checkra){
							
								$tinh=true;
								$checkra=true;
						}
						else if($ktbuoi==15 && !$checkra){
								
								$mangnv[$idnv]["$ngaythu"]["thieugio"]=$re['gio'].".".$re['phut'];
								$tinh=true;
								$checkra=true;
						}
						else if($ktbuoi==16 && !$checkvao){
								
							$checkvao=true;
							$giovao =strtotime($re['ngaytao']);
										$mangnv[$idnv]["$ngaythu"]['giovao'.$lanthu]=$re['ngaytao'];
							if($re['IDch']!=1){
										
								$mangnv[$idnv]["$ngaythu"]["ditre2"]=$re['gio'].".".$re['phut'];
							}
						}
						else if(($ktbuoi==17 || $ktbuoi==18) && !$checkra){
							$tinh=true;
							$checkra=true;
						}
						
					}
				
					
						if($tinh){
						
								if($giovao){
										$giora = strtotime($re['ngaytao']);
										$sophut=$giora-$giovao;
										 
										$giora= $re['gio']*60+$re['phut'];
										 $mangnv[$idnv]["$ngaythu"]['giora'.$lanthu]=$re['ngaytao'];
										
										 $mangnv[$idnv]["$ngaythu"]['giolamd'] += $sophut;
										 $mangnv[$idnv]['tongcong']+= $sophut;
										 $giovao='';
								}
								else{
									$giovao =strtotime($re['ngaytao']);
									$mangnv[$idnv]["$ngaythu"]['giovao'.$lanthu]=$re['ngaytao'];
									
								}
						}
					
				}
			}
			else if($loaigiotam==3 && $thumay=='Sun'){
				
						if($giovao){
								$giora = strtotime($re['ngaytao']);
								$sophut=$giora-$giovao;
								 
								 $giora= $re['gio']*60+$re['phut'];
								 $mangnv[$idnv]["$ngaythu"]['giora'.$lanthu]=$re['ngaytao'];
								 $mangnv[$idnv]["$ngaythu"]['giolamd'] += $sophut;
								 $mangnv[$idnv]['tongcong']+= $sophut;
								 $giovao='';
						}
						else{
							$giovao =strtotime($re['ngaytao']);
							$mangnv[$idnv]["$ngaythu"]['giovao'.$lanthu]=$re['ngaytao'];
							
						}
			}
			else{
					if($giovao){
								$giora = strtotime($re['ngaytao']);
								$sophut=$giora-$giovao;
								 
								 $giora= $re['gio']*60+$re['phut'];
								 $mangnv[$idnv]["$ngaythu"]['giora'.$lanthu]=$re['ngaytao'];
								 $mangnv[$idnv]["$ngaythu"]['giolamd'] += $sophut;
								 $mangnv[$idnv]['tongcong']+= $sophut;
								 $giovao='';
						}
						else{
							$giovao =strtotime($re['ngaytao']);
							$mangnv[$idnv]["$ngaythu"]['giovao'.$lanthu]=$re['ngaytao'];
							
						}
			}
			
		$gioquetkt=$re['gio'].".".$re['phut'];
		
		
			
}
		
if($idnv) $mangnv[$idnv]['tongnay']= $tongngay ;

$chuoiinsert='';
foreach ($mangnv as $idnv=>$re)
{
	
	
	$cuahang = $re['cuahang'];
	$chucvugoc = $re['chucvu'];
	$tenchucvugoc=$re['tenchucvu'];
	
	$loaiuser = $re['loaiuser'];
	$ghichu =  $re['note'];
    $tongngay=$re['tongnay'];
	
	//in($re);
	$giotinhluongchunhat=0;
	$giotinhluong=0;
	// echo $re['tongcong']."<br>";
	 $sogio =  floor($re['tongcong']/3600)  ; 
	 $sophut = $re['tongcong'] - $sogio*3600 ;
	 $sophut = round($sophut/60);
	
	 if (strlen($sogio)==1) $sg = '00'.$sogio ;
	 elseif (strlen($sogio)==2) $sg = '0'.$sogio ;
	 else $sg =  $sogio;
	 if (strlen($sophut)==1) $sh = '0'.$sophut ;
	 else $sh =  $sophut;
		 //echo  $re['tongcong'];
         $manv = strtoupper($re['manv']) ;
		 $machaythuong= $manv;
		 $machayluong=$manv;
		 $luongcoban=$re['luongcoban'];
	
	  $tongcong =0 ;
 for ($i=(int)(1);$i<=(int)($tongngaythang);$i++){
  
				  			$thieugio1=0;
							$thieugio2=0;	
							$trephut1=0;
							$trephut2=0;
							$giotre=0;
							$phuttre=0;
							$chuoitt=$re[$i]['chuoithongtin'];
							$loaigio=$re[$i]['loaigio'];
						//tính phút trễ 
						
						if($re[$i]['ditre1']){
								
								$trephut1=convertHtoM($re[$i]['ditre1'])['totalp'];
								$trephut1=$trephut1-$re[$i]['giobatdau1'];
									//echo $i." trễ 1:".$trephut1."<br>";
						}
						if($re[$i]['ditre2']){
							$trephut2=convertHtoM($re[$i]['ditre2'])['totalp'];
							$trephut2=$trephut2-$re[$i]['giobatdau2'];
								//echo $i." trễ 1:".$trephut2."<br>";
						}
						$tongphuttre=$trephut1+$trephut2;
						//echo $tongphuttre;
						$giotre=floor($tongphuttre/60);
						$phuttre=floor($tongphuttre-($giotre*60));
						
						//tinh ve som
						if($re[$i]['thieugio1']){
								
								$thieugio1=convertHtoM($re[$i]['thieugio1'])['totalp'];
								$thieugio1=$re[$i]['gioketthuc1']-$thieugio1;
								//	echo $i." thieu1:".$thieugio1."<br>";
						}
						//tinh ve som
						if($re[$i]['thieugio2']){
								
								$thieugio2=convertHtoM($re[$i]['thieugio2'])['totalp'];
								$thieugio2=$re[$i]['gioketthuc2']-$thieugio2;
									//echo $i." thieu2:".$thieugio2."<br>";
						}
						$tongphutsom=$thieugio1+$thieugio2;
					
						$giosom=floor($tongphutsom/60);
						$phutsom=floor($tongphutsom-($giosom*60));
						$tongphuttre+=$tongphutsom;
						//echo $tongphuttre;
						$thu=$re[$i]['thu'];
						$IDcuahang=$re[$i]['IDcuahang'];
						
						
  					    $sophut= $re[$i]['giolamd']*1 ;
						
						//echo $sophut;
						$sp=$sophut;
						
    					if($sophut>0)
						{   //echo $sophut/3600 ."<br>" ; 
					
							$gionghittrua=$re[$i]['gioketthuc1']-$re[$i]['giobatdau2'];
						   if($loaigio==2 && $sophut >4*3600 && $sophut <6.5*3600 )     $sophut = 4*3600 ;  
						   if($loaigio==2 && $sophut >6.5*3600)     $sophut = $sophut-$gionghittrua*60 ;
						
						// echo ($sophut/60)."<br>";
 							 $sogio =  floor($sophut/3600); 
							 $giolamd=  $sogio*1;
							 $sophut = ($sophut - $giolamd*3600)/60;
							 $phutlamtong=$giolamd*60+$sophut;
							//echo $phutlamtong;
							// $sophut = floor(($sophut - $giolamd*3600)/60) ;
							// $sophut=($sophut%3600)*60;
							  //echo $sogio.":".$sophut ."<br>";
							
							  //echo  $sophut;
 							 if(1*$sophut<10) $sophut='0'.$sophut;
							 if($sogio==0)  {
							 	$giolam="X";$maugiolam="";
							}
							  else $giolam=$giolamd."h".$sophut ."'";
								
								$sogiolam=$re[$i]['sogiolam'];
							if($thu=="Sun" && $loaigio==3){
									$giotinhluongchunhat += $giolamd*60+ $sophut;
									$giolam="X";$maugiolam="";
									$giochunhat=$giolamd  ."h".$sophut;
										//$giolam = $giolamd  ."h".$sophut; 
							}
							else{
							$giochunhat="";
							
							 //echo 'loại giờ'.$loaigio.': '.$giolamd.'x60 + '.$sophut.'= '.$sogiolam.'</br>';
								if(($giolamd*60+$sophut)>=$sogiolam && $loaigio==2 ){
									$sogiolam-=$tongphuttre;
									//echo $tongphuttre;
									//$sophutlam=ConvertTimeWork($sogiolam)["phutlam"];
									$giolamtam=floor($sogiolam/60);
									$sophutlam=$sogiolam%60;
									 //$giolamtam = ConvertTimeWork($sogiolam)["giolam"];
									 $giolam = $giolamtam."h$sophutlam";
									 $giotinhluong +=$sogiolam ;
								}//nv vp				 
								 else if (($giolamd*60+$sophut)>=$sogiolam && ($loaigio==1 || $loaigio==3))  // cht chp
								  {    
								  
										if(!(($phutlamtong)>=$sogiolam && $re[$i]['IDcuahang']!=1))
										{
											
											$sogiolam-=$tongphuttre;
										}
									
									$giolamtam=floor($sogiolam/60);
									$sophutlam=$sogiolam%60;
									
									 $giolam = $giolamtam."h$sophutlam";
									 $giotinhluong +=$sogiolam ;
								  }
								  else if(($loaigio==1 || $loaigio==2 || $loaigio==3)){  
								  	$sogiolamtam=$phutlamtong;
									
										$maugiolam="red";
									
										$giolamd=floor($sogiolamtam/60);
										$sophut=$sogiolamtam%60;
										$giothieu=floor(($sogiolam-$sogiolamtam)/60);
										$phutthieu=($sogiolam-$sogiolamtam)%60;
																			
										$giotinhluong += $giolamd*60+ $sophut;
										$giolam = $giolamd."h".$sophut."<br>G:".$giothieu.":".$phutthieu;
								} 
								  else  {
								  	
										$giotinhluong += $giolamd*60+ $sophut;
										$giolam = $giolamd  ."h".$sophut; 
								} 
								
							}
							 
							
 						     if($re[$i]['ditre1']!='' || $re[$i]['ditre2']!='')  
							 {
							 	if($re[$i]['ditre1']){
									$maugiolam="red";
									 $giolam= $giolam."<br>T1:".  $re[$i]['ditre1'] ;
								}
							 	if($re[$i]['ditre2']){
									$maugiolam="red";
									 $giolam= $giolam."<br>T2:".  $re[$i]['ditre2'] ;
								}
							    
							  
							 }  
							 
						     else if(($re[$i]['thieugio1']!='' || $re[$i]['thieugio2']!='') && $loaigio!=0){ 
							 	if($re[$i]['thieugio1']){
										$maugiolam="red";
									$giolam= $giolam."<br> S1:" . $re[$i]['thieugio1'];
								}
							 	if($re[$i]['thieugio2']){
									$maugiolam="red";
									$giolam= $giolam."<br> S2:" . $re[$i]['thieugio2'];
								}
							 
							 	
								
							} 
							 else if($sp<$sogiolam*60 && $loaigio!=0)
							 {
							 	
							 }
							 else{
							 	 $maugiolam="";
							  	
							  }
							  
							
 						}
						else
						{
							$giochunhat="";
							$giolam="X";  $maugiolam="";
						}
					
				
	
					 $sogio =  floor($giotinhluong/60)  ;   $sophut=$giotinhluong%60;
			         $tangca=$manglamthem[$idnv];
					 if($tangca)
					 {
						 $giotc =  floor($tangca/60)  ;   $tangca  =$tangca-$giotc*60;
						 $tangca  = $giotc."h" .$tangca ."'";
					 }
					 if($giotinhluongchunhat){
					 	$giochunhat=floor($giotinhluongchunhat/60);
						$phutchunhat=$giotinhluongchunhat%60;
						 
					 }else{
					 	$giochunhat=0;
						$phutchunhat=0;
					 }
					 
					
 $r++;
 }
 
 	$idtontai=checktontai($thanggoc,$idnv,$manv);
	$luongngaycong= ((($luongcoban/26)/8)/60)*$giotinhluong;
 	if($idtontai){
		
		 $sql="update set luongthang='$thanggoc',IDcuahang='$re[IDcuahang]',IDNV='$idnv',tenNV='$re[ten]',manv='$manv',ngayvaolam='$re[ngayvaolam]',chucdanh='$tenchucvugoc',ngaychuan=26,giocong='$giotinhluong',luongngaycong='$luongngaycong',machaythuong='$machaythuong',machayluong='$machayluong',songaytrongthang='$tongngaythang',luongcoban='$luongcoban',chucvugoc='$chucvugoc' where ID=$idtontai";
		 UpdateNsLuongthang($sql);
		//echo $sql;
	}
	else{
		 $chuoiinsert.="('$thanggoc','$re[IDcuahang]','$idnv','$re[ten]','$manv','$re[ngayvaolam]','$tenchucvugoc',26,'','$giotinhluong','$luongngaycong','','','','','','','','','','','','','','','','','','','','','','','$machaythuong','$machayluong','','','','','','','$tongngaythang','','','','','','','','','','','','','','','$luongcoban','','','$chucvugoc',''),";
	}
 

}

}
if($chuoiinsert){

 $chuoiinsert =rtrim($chuoiinsert,",");
 insertNsLuongthang($chuoiinsert);
}
 
 function insertNsLuongthang($chuoi){
global $data;

	  $sql ="insert into ns_luongthang  (luongthang,IDcuahang,IDNV,tenNV,manv,ngayvaolam,chucdanh,ngaychuan,sogiotrenngay,giocong,luongngaycong,luongds,phucap,phucapdich,phucapkhac,phat,bhxh,thunhap,luongcu,congno,daung,giuluong,thucnhan,cuahang,xacnhan,xacnhanluongnghiviec,giocongtinhsp,trugiocongtinhsp,thuongdskho,thuongdsolt,hesoluong,hesovung,socuahang,machaythuong,machayluong,phantramdoanhthu,luongdtcpct,luongdtbhtnbv,hoahong,thuongcs,thuongtop,songaytrongthang,songaymocua,hanghoa,nhansuvadaotao,doanhthumoicuahang,dichvu,doanhthumuctieu,doanhthuthuc,doanhthucanhan,doanhthudat,hesodoanhthu,luongchitieu,luongDTCNTB,luongdoanhthu,luongCPtrenDT,luongcoban,luongkpi,luongtrachnhiem,chucvu,phongban) values $chuoi";
	  
	
	if($data->query($sql)){
	 	
	 	return true;
	}
	else{
		return;
	}
}
function UpdateNsLuongthang($sql){
global $data;
	
	if($data->query($sql)){
	 	
	 	return true;
	}
	else{
		return;
	}
}
function checktontai($luongthang,$idnv,$manv){
		$sql="select ID from ns_luongthang where luongthang='$luongthang' and IDNV='$idnv' and manv='$manv'";
		$dong=getdong($sql);
		if($dong['ID']){
			return $dong['ID'];
		}
		else{
			return false;
		}	

}

 $sql_where=" where month(luongthang)=$thang and  year(luongthang)=$nam";
// phan trang===================================================================
	     $sql = "SELECT ID,DATE_FORMAT(luongthang,'%d/%m/%Y') as thangluong,luongcoban,manv,luongkpi,socuahang,luongtrachnhiem,luongkpimien,luongds,chucvu,phongban FROM  ns_luongthang $sql_where order by ID ";
 		$query_rows = $data->query($sql);
		$num=$data->num_rows($query_rows);	
	$act='thongtinluongnv';
	    $page_start=0;
		$page_row = 20 ;
		$page_col = 4;
		include("source/paging.php");
	$list_page=paging($num);	
	//var_dump($sql);
		$sql ="SELECT ID,DATE_FORMAT(luongthang,'%d/%m/%Y') as thangluong,luongcoban,manv,luongkpi,socuahang,luongtrachnhiem,luongkpimien,luongds,chucvu,phongban FROM  ns_luongthang  ".$sql_where." ORDER BY ID desc, ID limit $page_start,$page_row ";
		
		
		$query_rows = $data->query($sql);
		$result_rows = $data->num_rows($query_rows);
		$result = $data->query($sql);
		while($result_news = $data->fetch_array($result))		
		{  
			if($mau == "white")
				$mau = "#EEEEEE";
			else
			$mau = "white";
			$SOST = $SOST + 1 ;			
	
			?>
			
				<tr bgcolor="<?=$mau?>">
				<td style="border:solid windowtext 1.0pt; mso-border-alt:solid windowtext .5pt;padding:0in 0.4pt 0in 0.4pt;padding-right:12px" align="right">&nbsp;<?=$SOST?></td>
				
				<td valign="middle" style="border:solid windowtext 1.0pt; mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt"  >
				<label for="sele<%=j%>" style="Font-Weight:Normal;Color:Black;" >&nbsp;<?=$result_news["thangluong"]?></label></td>
			<td valign="middle" style="border:solid windowtext 1.0pt; mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt"  >
				<label for="sele<%=j%>" style="Font-Weight:Normal;Color:Black;" >&nbsp;<?=$result_news["manv"]?></label></td><td valign="middle" style="border:solid windowtext 1.0pt; mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt"  >
				<label for="sele<%=j%>" style="Font-Weight:Normal;Color:Black;" >&nbsp;<?=$result_news["luongcoban"]?></label></td>
				<td valign="middle" style="border:solid windowtext 1.0pt; mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt"  >
				<label for="sele<%=j%>" style="Font-Weight:Normal;Color:Black;" >&nbsp;<?=$result_news["luongkpi"]?></label></td>
				<td valign="middle" style="border:solid windowtext 1.0pt; mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt"  >
				<label for="sele<%=j%>" style="Font-Weight:Normal;Color:Black;" >&nbsp;<?=$result_news["giotrenngay"]?></label></td>
				<td valign="middle" style="border:solid windowtext 1.0pt; mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt"  >
				<label for="sele<%=j%>" style="Font-Weight:Normal;Color:Black;" >&nbsp;<?=$result_news["luongngaycong"]?></label></td>
				<td valign="middle" style="border:solid windowtext 1.0pt; mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt"  >
				<label for="sele<%=j%>" style="Font-Weight:Normal;Color:Black;" >&nbsp;<?=$result_news["ngaycong"]?></label></td>
				<td valign="middle" style="border:solid windowtext 1.0pt; mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt"  >
				<label for="sele<%=j%>" style="Font-Weight:Normal;Color:Black;" >&nbsp;<?=$result_news["giocong"]?></label></td>
				<td valign="middle" style="border:solid windowtext 1.0pt; mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt"  >
				<label for="sele<%=j%>" style="Font-Weight:Normal;Color:Black;" >&nbsp;<?=$result_news["chucvu"]?></label></td>
				<td valign="middle" style="border:solid windowtext 1.0pt; mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt"  >
				<label for="sele<%=j%>" style="Font-Weight:Normal;Color:Black;" >&nbsp;<?=$result_news["phongban"]?></label></td>
				<td align="center"  style="border:solid windowtext 1.0pt; mso-border-alt:solid windowtext .5pt;padding:0in 3.4pt 0in 3.4pt"><label for="sele<%=j%>" style="Font-Weight:Normal;Color:Black;cursor:hand">
				<a href = "default.php?act=thongtinluongnv&id=<?=$result_news["ID"]?>"> <img src = "images/book_addressHS.png" border = "0" ></a></label></td>


				<td  align="center" style="border:solid windowtext 1.0pt; mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt">  <a onclick='return ask()' href="default.php?act=thongtinluongnv&Del=<?=$result_news["ID"]?>"><img src="images/delete.gif" border = "0"></a></td>								
				</tr>

		
			
			<?php
				 $i++; 
		 } 
		 ?>
		 <tr style="padding-top:10"><td align="right" colspan="4"><?=$list_page?></td></tr>
		 <?php
		 

?>