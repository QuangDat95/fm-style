<?php  
session_start();

//echo "abc";
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
  $data1 = $_POST['DATA']; 
  $tmp = explode('*@!',$data1);
        $ten   =  ($tmp[0])   ;
        $ma= trim($tmp[1])  ;
 		$kho= trim($tmp[2]) ;
		$tu= trim($tmp[3]) ;
		$den= trim($tmp[4]) ;
		$trang= laso($tmp[6]) ;
		$IDNV= laso($tmp[5]) ;
		$thang=  $tmp[7]  ;
		$loaiusertim=  laso($tmp[9]);
		//$IDNV='7275';
		//$IDNV='5791'; //loại gio 1
		//$IDNV='7576'; //loaigio2
		//$IDNV='4121'; // loai gio 0
		//$tu='01/01/2021';
		//$den='10/01/2021';
		
		//$tu='1/11/2021';
		//$den='30/11/2021';
		
		$sql_where=" where  1 "; 
     
 		if($ten!="") 	$sql_where.=" and  a.Name  like '%".$ten."%'";
		if($ma!="")	    $sql_where.=" and  a.manv like '%".$ma."%'";
 		if($kho!="" )	$sql_where.=" and  b.cuahang ='".$kho."'";
		if($IDNV!="0" )	$sql_where.=" and  a.IDnhanvien ='".$IDNV."'";
		if($loaiusertim!=0)	$sql_where.=" and  b.loai ='".$loaiusertim."'";
		
		if($tu!="")	
		{
		  $ngay=  explode('/',$tu);
	   	  if (strlen($ngay[1])== 1) {  $ngay[1] = "0".$ngay[1] ;  }
		  if (strlen($ngay[0])== 1) {  $ngay[0] = "0".$ngay[0] ;  }    		
	//	  $sql_where .= " and  a.ngaytao >= '$ngay[2]-$ngay[1]-$ngay[0]'";
		}
		if($den!="")	
		{
		  $ngay=  explode('/',$den);
	   	  if (strlen($ngay[1])== 1) {  $ngay[1] = "0".$ngay[1] ;  }
		  if (strlen($ngay[0])== 1) {  $ngay[0] = "0".$ngay[0] ;  }    		
		//  $sql_where .= " and  a.ngaytao <= '$ngay[2]-$ngay[1]-$ngay[0] 23:59'";
		} 
		 if($thang!='')   
		 {  $ngaybatdau=1 ;
		   $tam = date('Y-m-d', strtotime('+1 month',strtotime("$thang-01")));
		   $ngaycuoi =  date('d',strtotime($tam ."-1 day"));
		  // echo  $thang.'==='.$ngaycuoi ;
		   $tungay="$thang-01";
		   $toingay="$thang-31";
		 }
      	else 
		{  
		  
		   $ngay=  explode('/',$tu);
	   	   if (strlen($ngay[1])== 1) {  $ngay[1] = "0".$ngay[1] ;  }
		   if (strlen($ngay[0])== 1) {  $ngay[0] = "0".$ngay[0] ;  }    		
		   $tungay=   "$ngay[2]-$ngay[1]-$ngay[0]";	
		   $ngaybatdau=$ngay[0] ;
		  $ngay=  explode('/',$den);
		  if (strlen($ngay[1])== 1) {  $ngay[1] = "0".$ngay[1] ;  }
		  if (strlen($ngay[0])== 1) {  $ngay[0] = "0".$ngay[0] ;  }    	
		   $toingay= "$ngay[2]-$ngay[1]-$ngay[0]" ;	
		   $ngaycuoi =   $ngay[0];
		   
		}
			
		$sql_where .= " and  a.ngaytao >= '$tungay'  and  a.ngaytao <= '$toingay 23:59' ";
		
 				$r =1 ;	 
		  
 	    $mangchucvu= taomang("kh_chucvu","ID","Name");
		
		$manglamthem='';
 //==================mang tang ca ============================================				
		$sql2 ="select sum(sophut) as sophut,idnv from phieutangca where thoigianbatdau>='$tungay' and thoigianketthuc<='$toingay 23:59' and left(tinhtrang,1)=4 group by idnv";
		if ($_SESSION["admintuan"]) echo "<br>".$sql2 ."<br>";
    	$result = $data->query($sql2);	 
		$mangtt='';
		while ($rec = $data->fetch_array($result)  )	 
		{   	
		   $manglamthem[$rec['idnv']]=$rec['sophut'] ; 
   		}		
		
		//==================mang bu gio ============================================				
		$sql2 ="select sophut,idnv,DATE_FORMAT(thoigianbatdau,'%Y%m%d') as ngay from phieubugio where thoigianbatdau>='$tungay' and thoigianketthuc<='$toingay 23:59' and left(tinhtrang,1)=4 group by idnv";
		if ($_SESSION["admintuan"]) echo "<br>".$sql2 ."<br>";
    	$result = $data->query($sql2);	 
		$mangtt='';
		while ($rec = $data->fetch_array($result)  )	 
		{   	
		   $mangbugio[$rec['idnv']][$rec['ngay']]=$rec['sophut'] ; 
   		}		
		
		//var_dump($mangbugio);
		//in($manglamthem);
  //==============================================================		
		/*$sql2 =" select v.sogiolam,v.loaigio,v.batdau,v.ketthuc,v.batdau2,v.ketthuc2,a.ID,a.ten,a.manv,b.Name as cuahang,c.Name as  chucvu from userac  a left join cuahang b on a.cuahang =b.id left join kh_chucvu c on a.chucvu=c.id left join calamviec v on a.calamviec=v.id    "; if ($_SESSION["admintuan"]) echo $sql2 ."<br>";
   		$result = $data->query($sql2);	 
		$mangtt='';
		while ($rec = $data->fetch_array($result)  )	 
		{      
		    if(strpos($rec['sogiolam'],".5")>0) {  $rec['sogiolam']= floor($rec['sogiolam']) *60 + 30;   }
			else  {  $rec['sogiolam']=  $rec['sogiolam']  *60 ;  }
			 
		 	 $mangtt[$rec['ID']]=$rec ; 
   		}	*/			
  
			$sql = "SELECT b.ten as name,a.ngaytao,a.loai,a.thongtin,a.IDnhanvien,a.manv,b.cuahang as IDch  ,DATE_FORMAT( a.ngaytao,'%d/%m/%Y') as ngay,DATE_FORMAT( a.ngaytao,'%e') as ngaylam,DATE_FORMAT( a.ngaytao,'%H') as gio,DATE_FORMAT(a.ngaytao,'%a') as thu,DATE_FORMAT( a.ngaytao,'%i') as phut,b.chucvu   FROM nhanviendilam a left join userac b on b.ID = a.IDnhanvien ".$sql_where." ORDER BY  a.IDnhanvien,a.ngaytao asc    ";
	
	
	
   //in($mangtt);
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
	$ngaytaoformat =$createDate->format('Ymd');
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
					
				$sogiobugio=$mangbugio[$idnv][$ngaytaoformat];
				
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
				
				$mangnv[$idnv]['cuahang']= $mangch[$re['IDch']];
				//echo $re['chucvu'];		
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
				$mangnv[$idnv]["$ngaythu"]['sogiobugio']= $sogiobugio;
			//echo $chucvuchinh;
			$checkdau=true;
		}
	
		if($ngaythu!=$ngaythuluu)
		{
			$ngaythuluu=$ngaythu ;
			$sophuttre=0;
			 $gioquetngay=0;
			// lấy các thông tin từ đầu mỗi dòng mỗi ngày
			$sogiobugio=$mangbugio[$idnvc][$ngaytaoformat];
				/*var_dump($mangbugio[$idnvc][$ngaytaoformat]);
				echo $sogiobugio;*/
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
			//echo $re['chucvu'];		
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
		$mangnv[$idnv]["$ngaythu"]['sogiobugio']= $sogiobugio;
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
		{    $tongngay++;
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
		/* echo $loaigiotam."<br>";
		 echo $re['IDch']."<br>";
		 echo $thumay."<br>";
		 echo $giobatdau1."<br>";
		  echo $giobatdau2."<br>";
		   echo $gioketthuc1."<br>";
		    echo $gioketthuc2."<br>";*/
		 	if($giobatdau1 !=0 && $giobatdau2!=0 && $gioketthuc1!=0 && $gioketthuc2!=0 	){
		//echo $thumay;
				if($loaigiotam==2 ){
				
				if($ktbuoi==1){
						
					/*if(!$giovao){
					//echo chuyenngaychuan($re['ngaytao'],$giobatdau1);
						$giovao =strtotime($re['ngaytao']);
					//$giovao =strtotime(chuyenngaychuan($re['ngaytao'],$giobatdau1));
					$mangnv[$idnv]["$ngaythu"]['giovao'.$lanthu]=$re['ngaytao'];
					}
					else{
						$tinh=true;
					}*/
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
					
				/*	if(!$giovao){
					//echo chuyenngaychuan($re['ngaytao'],$giobatdau1);
						$giovao =strtotime($re['ngaytao']);
					//$giovao =strtotime(chuyenngaychuan($re['ngaytao'],$giobatdau1));
						$mangnv[$idnv]["$ngaythu"]['giovao'.$lanthu]=$re['ngaytao'];
					}
					else{
						$tinh=true;
					}
					*/	
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
			
						/*if($giovao){
								$giora = strtotime(chuyenngaychuan($re['ngaytao'],$gioketthuc2));
								
						}*/
						$tinh=true;
				}
				if($tinh){
					
							if($giovao){
								/*if(!$giora){
								
									$giora = strtotime($re['ngaytao']);
								}*/
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

//return;
?>
<style>
.tbchuan thead th{
  position: -webkit-sticky;
  position: sticky;
   top: 0;
   border-bottom:1px solid;
   color:#000000;
   background-color:#F8E4CB;
  
}
/*.tbchuan th:first-child {
  position: -webkit-sticky;
  position: sticky;
  left: 0;
  z-index: 2;
  
}*/
#ghichu1:focus{
	border:none;
}
#ghichu1{
	   border: none;
    background-color: unset;
}
</style>
<div   style=" overflow:auto;width:1070px;height:400px" >
 <table width="99%" border="0" cellpadding="0" cellspacing="0" class="tbchuan">		
  <thead>
 		<tr bgcolor="#F8E4CB">
		  <th align="center"  height="23" width="32"><b>STT</b></td>
		 
		    <th width="55" align="center"><strong> Mã NV  </strong> </td> 	
		  <th width="193" align="center" ><strong>Tên Nhân Viên </strong></td>  
		   <th width="64" align="center" ><strong>Chức Vụ</strong></td>   
 		  <th width="104" align="center"><strong>Nhân viên tại </strong></td>
		   <th width="98" align="center"><strong>Tổng ngày </strong></td>
		   <th width="74" align="center"><strong>Số giờ làm </strong></td>
           <?php  for($i=$ngaybatdau;$i<=$ngaycuoi ;$i++)
		   { ?>
             <th>Ngày <?php echo $i ; ?></td>
              <?php  } ?>
			    <th width="74" align="center"><strong>Số giờ tính lương </strong></td>
				<th width="74" align="center"><strong>Số giờ tăng ca</strong></td>
				<!--<th width="74" align="center"><strong>Số giờ bù giờ</strong></td>-->
				<th width="74" align="center"><strong>Tăng ca chủ nhật</strong></td>
				 <th width="428" align="center"><strong>Tổng ngoài giờ</strong></td>
		    <th width="428" align="center"><strong>Ghi Chú</strong></td>
			 <th width="428" align="center"><strong>Ghi Chú</strong></td>	
 		</tr>
	 </thead>
	 <tbody>
<?php

 //=========================================================================================
//$time = date('i:s', $mangnv[$idnv]["$ngaythu"]['giolamd']);
//in($time);
//in($mangnv);
//return;
	
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
	/* if($r>1175){
	 	in($idnv);
	 }*/
	
	 if (strlen($sogio)==1) $sg = '00'.$sogio ;
	 elseif (strlen($sogio)==2) $sg = '0'.$sogio ;
	 else $sg =  $sogio;
	 if (strlen($sophut)==1) $sh = '0'.$sophut ;
	 else $sh =  $sophut;
		 //echo  $re['tongcong'];
         $manv = strtoupper($re['manv']) ; 
	 if($mau == "white"){	 	 $mau = "#EEEEEE";	 $hl = "Normal4" ;	 $hl2 = "Highlight4";	 }else { $mau = "white";$hl = "Normal5" ;$hl2 = "Highlight5";}  
	  $tongcong =0 ;
	 ?>
 	 	<tr  title="<?php echo addslashes($re['note']); ?>"  onclick="setkh('<?php echo addslashes($re["idkhach"]) ; ?>','<?php echo addslashes($re['Name']) ;?>','<?php   echo $re['address'] ;?>','<?php echo $re['tel'] ;?>')"   onMouseOver="this.className='<?php echo $hl2; ?>'" onMouseOut="this.className='<?php echo $hl; ?>'"  bgcolor="<?php echo $mau; ?>" >
		  <td align="right"> <?php echo $r ;?> </td>		
		 
				<td ><?php echo $re['manv'] ;?></td>
  				<td ><?php echo $re['ten']  ;?></td>
				<td ><?php echo $tenchucvugoc  ;?> </td>			
				<td ><?php echo $cuahang ;?></td>				
                <td ><?php echo $tongngay ;?></td>	
				<td ><strong><?php echo $sogio."h".$sophut ."'"  ; ?></strong></td>
                   <?php for ($i=(int)($ngaybatdau);$i<=(int)($ngaycuoi);$i++){
				   			$thieugio1=0;
							$thieugio2=0;	
							$trephut1=0;
							$trephut2=0;
							$giotre=0;
							$phuttre=0;
							$bugios='';
							 $sogiobugio=0;
							$chuoitt=$re[$i]['chuoithongtin'];
							$loaigio=$re[$i]['loaigio'];
							 $sogiobugio=$re[$i]['sogiobugio'];
							// echo "bugf giờ:".$sogiobugio;
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
						//echo $IDcuahang;
						$giovaott1=$re[$i]['giovao1']?"&#013;giờ vào: ".$re[$i]['giovao1']:$re[$i]['giovao1'];
						$gioratt1=$re[$i]['giora2']?"&#013;giờ ra: ".$re[$i]['giora2']:$re[$i]['giora2'];
						$giovaott2=$re[$i]['giovao3']?" &#013;giờ vào: ".$re[$i]['giovao3']:$re[$i]['giovao3'];
						$gioratt2=$re[$i]['giora4']?" &#013;giờ ra: ".$re[$i]['giora4']:$re[$i]['giora4'];
						$giolamtt=floor($re[$i]['sogiolam']/60);	
						$phutlamtt=(($re[$i]['sogiolam']-$giolamtt*60)/60);
						$giolamtt=$giolamtt+$phutlamtt;
						$tenchucvu=$re[$i]['tenchucvu'];
						
						$title="Chức vụ: ".$tenchucvu."&#013;Loại giờ: ".$loaigio."&#013;Số giờ làm: ".$giolamtt." Giờ".$giovaott1.$gioratt1.$giovaott2.$gioratt2.'&#013;Chức vụ đầu:'.$tenchucvugoc.'&#013;Số phút làm:'.($re[$i]['giolamd']/60).' &#013;Chuỗi TT:'.$chuoitt;
						
  					    $sophut= $re[$i]['giolamd']*1 ;
						$sophut=$sophut+($sogiobugio*60);
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
								  
								  	//$phutlamtong-=$tongphuttre;
									//echo $re[$i]['IDcuahang'];
									/*$sogiolam-=$tongphuttre;
									 	$sophutlam=ConvertTimeWork($sogiolam)["phutlam"];
									 	$giolamtam = ConvertTimeWork($sogiolam)["giolam"];
										 $giolam = $giolamtam."h$sophutlam";
										$giotinhluong +=$sogiolam  ;*/
										/*if(!($phutlamtong>=(9*60+30) && $re[$i]['IDcuahang']!=1))
										{
											
											$sogiolam-=$tongphuttre;
										}*/
										if(!(($phutlamtong)>=$sogiolam && $re[$i]['IDcuahang']!=1))
										{
											
											$sogiolam-=$tongphuttre;
										}
									// echo $sogiolam;	
									//echo $tongphuttre;
									//$sophutlam=ConvertTimeWork($sogiolam)["phutlam"];
									$giolamtam=floor($sogiolam/60);
									$sophutlam=$sogiolam%60;
									 //$giolamtam = ConvertTimeWork($sogiolam)["giolam"];
									 $giolam = $giolamtam."h$sophutlam";
									 $giotinhluong +=$sogiolam ;
								  }
								  else if(($loaigio==1 || $loaigio==2 || $loaigio==3)){  
								  	$sogiolamtam=$phutlamtong;
									//echo $sogiolamtam;
								  	/*if($re[$i]['ditre1']!='' || $re[$i]['ditre2']!=''){
										$sogiolamtam=$sogiolam;
										//$sogiolamtam=$phutlamtong;
										
									}
									else if($re[$i]['thieugio1']!='' || $re[$i]['thieugio2']!=''){
										//$sogiolamtam=$sogiolam;
											$sogiolamtam=$phutlamtong;
										
									}*/
										//echo $sogiolamtam;
									//echo $sogiolamtam;
										$maugiolam="red";
										//$sogiolamtam-=$tongphuttre;
											
									//	echo $giolamdtam;
										$giolamd=floor($sogiolamtam/60);
										$sophut=$sogiolamtam%60;
										$giothieu=floor(($sogiolam-$sogiolamtam)/60);
										$phutthieu=($sogiolam-$sogiolamtam)%60;
										//echo $giolamdtam;	
									
										/*$giolamd=$giolamd-$giotre;
									
										$sophut=$sophut-$phuttre;
									
										$giothieu=ConvertTimeNotE($sogiolam,$giolamd,$sophut)["giothieu"];
										$phutthieu=ConvertTimeNotE($sogiolam,$giolamd,$sophut)["phutthieu"];*/									
										$giotinhluong += $giolamd*60+ $sophut;
										$giolam = $giolamd."h".$sophut."<br>G:".$giothieu.":".$phutthieu;
								} 
								  else  {
								  	
										$giotinhluong += $giolamd*60+ $sophut;
										$giolam = $giolamd  ."h".$sophut; 
								} 
								
							}
							 
							//echo $re[$i]['ditre1'];
							 //hiển thị đi trễ về sớm
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
							    
							   /*if($sp<($sogiolam*60)) {
							   		$maugiolam="red";
									$giolam= $giolam."<br>Đi trễ"; 
								
								}*/
							     
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
							 	
							 	/*if($loaigio!=0){
							  	 	$maugiolam="red";
							    	$giolam= $giolam."<br>R";
								}  */
							 }
							 else{
							 	 $maugiolam="";
							  	
							  }
							  
							  
							  if($sogiobugio)  
							 {
							 		$hbugio=floor($sogiobugio/60);
									$pbugio=$sogiobugio%60;
									 $bugios= "<br>B:".$hbugio."h".$pbugio;
								
							}
							//hiển thị bù giờ
 						}
						else
						{
							$giochunhat="";
							$giolam="X";  $maugiolam="";
						}
					
						//if($ditre>0 || $vesom>0) $maugiolam= "#CC6666" ;else $maugiolam="";
					  ?>
                 <td align="center" bgcolor="<?php echo $maugiolam ; ?>" title="<?=$title?>"><?php echo  $giolam  ; echo $bugios; ?><br /><span style="font-size:10px"><?=$giochunhat?></span></td>
              <?php  } ?>
			  <?php  $sogio =  floor($giotinhluong/60)  ;   $sophut=$giotinhluong%60;
			         $tangca=$manglamthem[$idnv];
					 // $bugio=$mangbugio[$idnv];
					  $bugio=0;
					  $tongngoaigio=$giotinhluongchunhat+$tangca+$bugio;
					 if($tangca)
					 {
						 $giotc =  floor($tangca/60)  ;   $tangca  =$tangca-$giotc*60;
						 $tangca  = $giotc."h" .$tangca ."'";
					 }
					 
					/* $bugio=$mangbugio[$idnv];
					 if($bugio)
					 {
						 $giobu =  floor($bugio/60)  ;   $bugio  =$bugio-$giobu*60;
						 $bugio  = $giobu."h" .$bugio ."'";
					 }*/
					 
					 if($tongngoaigio)
					 {
						 $ngoaigio =  floor($tongngoaigio/60)  ;   $tongngoaigio  =$tongngoaigio-$ngoaigio*60;
						 $tongngoaigio  = $ngoaigio."h" .$tongngoaigio ."'";
					 }
					 if($giotinhluongchunhat){
					 	$giochunhat=floor($giotinhluongchunhat/60);
						$phutchunhat=$giotinhluongchunhat%60;
						 
					 }else{
					 	$giochunhat=0;
						$phutchunhat=0;
					 }
					 
					 
			   ?>
			  <td   align="center" ><?php echo $sogio."h" .$sophut ."'";?></td>    
				<td   align="center" ><?php echo $tangca ;?></td>
				<!--<td   align="center" style="cursor:pointer"  onclick="showchitietbugio(<?=$idnv?>,'poupduyetbugio')" ><?=$bugio;?></td>-->
				<td   align="center" ><?=$giochunhat.'h'.$phutchunhat?></td>   
				<td   align="center" ><?=$tongngoaigio?></td> 
					<td   align="center" ><?php echo $ghichu ;?></td>    
					<td   align="center" ><input type="text" name="ghichu1" id="ghich1" onchange="luughichu()" data-id=""/></td>    
    </tr>
<?php	
 $r++;
 }
	
 
 
	
?>	
 	 	<tbody> 
 </table>
</div>
<div style="padding:5px;" ><?php 
//==============================================================	
    if ( $num != 0 ) {
 ?>
  Tìm thấy  <?php echo  $num ; ?>   lượt quét !    <?php if ($num > $pagesize ) echo "Trang : ". $pt ; ?>  
  <?php 
  } else
  {
  	 echo "<font size=2  color='#FF3300'>Không tìm thấy kết quả nào !!!</font> " ;
  }
 //==============================================================	
 ?> </div>
 

<?php				
    $data->closedata() ;
?>	