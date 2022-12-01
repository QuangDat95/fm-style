<?php

session_start();
$_SESSION["LoginID"]=1;$_SESSION["UserName"]='zalo';
header("Content-Type: application/json");


 $json = file_get_contents('php://input');	  
  
  
 if($json)
   {
   
       
	   $json = json_decode($json,true);
	  
	    $baomat= $json['baomat']  ;
    
	   if($baomat=='') return ;
		$ngay=$json['ngay']  ;
	   	$manv= $json['manv'] ;
 
}
 else  {
    //   echo $baomat;
    //    return;

    
    return ;}


 	  
 
		
    $baomat = explode('!@9',$baomat);    
    $baomat =$baomat[1];
		
 if ($baomat!="2cffe4a34ccc4f9c6ec755843593458b") return ;   // Tcv13


$root_path =getcwd()."/"  ;

include($root_path."../../biensession.php");

include($root_path."../../includes/config.php");

include($root_path."../../includes/removeUnicode.php");

include($root_path."../../includes/class.paging.php");

include($root_path."../../includes/class.mysql.php");

include($root_path."../../includes/function.php");

include($root_path."../../includes/function_local.php");
include($root_path."myfunction.php"); 

$data = new class_mysql();

$data->config();

$data->access();


//   $json = file_get_contents('php://input');
// $manv="FM0705";
// $ngay="03/07/2021";

$t= baochamcong($manv,$ngay);
if($t){
    echo json_encode(array("code"=>"200","data"=>$t));
}
else{
    echo json_encode(array("code"=>"201","message"=>"Lỗi gì đó ko biết!"));

}
// echo "<pre>";
// var_dump($t);
// echo "</pre>";
function baochamcong($manv,$ngay){
	global $data;
	$chuoiresultchamcong='';
    $mangresult=[];
    if(!$manv || $manv==''){
          return array("message"=>"Mã nhân viên là bắt buộc");
    
          
    }
    if(!$ngay || $ngay==''){
          return array("message"=>"Ngày là bắt buộc");
    
    }
    $IDNV='';
    $dong=getdong("select ID from userac where MaNV='$manv'");
    $IDNV=$dong["ID"];
    if($IDNV!="0" )	$sql_where.=" where  a.IDnhanvien ='$IDNV'";
    
    // $sql_where=" where  a.manv='$manv'";
    // $thang=date('m');
	// $thang=7;
    $tu=$ngay;
    $den=$ngay;
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

          $namnay=date("Y");
          $namnay=$namnay-1;
		   $tungay="$namnay-$thang-01";
		   $toingay="$namnay-$thang-31";
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
	
	//echo 	$sql;
	
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
	
		if($ngaythu!=$ngaythuluu){
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

   
// 	echo "<pre>";
	
// var_dump($mangnv);
// 	echo "</pre>";
//     return;
$ngayvaoratam='';	
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
	$chuoiresultchamcong.= "<br/>". addslashes($re['note']);
    $chuoiresultchamcong.=  "<br/>".$re['manv'];
   	$chuoiresultchamcong.=  "<br/>".$re['ten'] ;
    $chuoiresultchamcong.=  "<br/>".$tenchucvugoc ;
	$chuoiresultchamcong.=  "<br/>".$cuahang ;
	// $chuoiresultchamcong.=  "<br/>".$thang."/".$namnay ;
   $mangresult["manv"]=$re['manv'];
    $mangresult["ten"]=$re['ten'];
     $mangresult["cuahang"]=$cuahang ;
	// $chuoiresultchamcong.=  "<br/>".$sogio."h".$sophut ."'" ;
	// echo  "<br/>------------------------------";
	for ($i=(int)($ngaybatdau);$i<=(int)($ngaycuoi);$i++){
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
						if($re[$i]['giovao1']){
							$ngayvaora="<br/>N: ".date("d",strtotime($re[$i]['giovao1']));
						}
						else if($re[$i]['giovao2']){

									$ngayvaora="<br/>N: ".date("d",strtotime($re[$i]['giovao2']));
						}
						else if($re[$i]['giovao3']){

									$ngayvaora="<br/>N: ".date("d",strtotime($re[$i]['giovao3']));
						}
						else if($re[$i]['giovao4']){

									$ngayvaora="<br/>N: ".date("d",strtotime($re[$i]['giovao4']));
						}
						

                          $mangresult["giovao1"]=$re[$i]['giovao1'];
                          $mangresult["giora2"]=$re[$i]['giora2'];
                          $mangresult["giovao3"]=$re[$i]['giovao3'];
                          $mangresult["giora4"]=$re[$i]['giora4'];
						$giovaott1=$re[$i]['giovao1']?"<br/>vào: ".date("H:m:s",strtotime($re[$i]['giovao1'])):$re[$i]['giovao1'];
						$gioratt1=$re[$i]['giora2']?"<br/>ra: ".date("H:m:s",strtotime($re[$i]['giora2'])):$re[$i]['giora2'];
						$giovaott2=$re[$i]['giovao3']?"<br/>vào: ".date("H:m:s",strtotime($re[$i]['giovao3'])):$re[$i]['giovao3'];
						$gioratt2=$re[$i]['giora4']?"<br/>ra: ".date("H:m:s",strtotime($re[$i]['giora4'])):$re[$i]['giora4'];
						$giolamtt=floor($re[$i]['sogiolam']/60);	
						$phutlamtt=(($re[$i]['sogiolam']-$giolamtt*60)/60);
						$giolamtt=$giolamtt+$phutlamtt;
						$tenchucvu=$re[$i]['tenchucvu'];
						// Chức vụ: ".$tenchucvu."&#013;Loại giờ: ".$loaigio."&#013;<br/>Số giờ làm: ".$giolamtt." Giờ <br/>".
						$title=$giovaott1.$gioratt1.$giovaott2.$gioratt2;
						// Chuỗi TT:'.$chuoitt.'&#013;<br/>Chức vụ đầu:'.$tenchucvugoc.'&#013;<br/>Số phút làm:'.($re[$i]['giolamd']/60).' &#013;'
						   $mangresult["phutlam"]=($re[$i]['giolamd']/60);
                        
                        $ngayhienthi=strlen($i)==1?'0'.$i:$i;
						if( $re[$i]['giolamd']){
						//  $chuoiresultchamcong.= "<br/>********************";
						 	 $chuoiresultchamcong.= "<br/>***";
						// $chuoiresultchamcong.= "<br/>Ngày làm: $ngayhienthi/$thang/$namnay";
						// $chuoiresultchamcong.= "<br/>Thông tin quét thẻ:";
						// echo "------------------------------<br/>";
						$chuoiresultchamcong.= "".$ngayvaora;
						$chuoiresultchamcong.= "".$title;
						// $chuoiresultchamcong.= "<br/>------------------------------";
  					    $sophut= $re[$i]['giolamd']*1 ;
						$sophut=$sophut+($sogiobugio*60);
						//echo $sophut;
						$sp=$sophut;
						
    					if($sophut>0)
						{  
							$gionghittrua=$re[$i]['gioketthuc1']-$re[$i]['giobatdau2'];
						   if($loaigio==2 && $sophut >4*3600 && $sophut <6.5*3600 )     $sophut = 4*3600 ;  
						   if($loaigio==2 && $sophut >6.5*3600)     $sophut = $sophut-$gionghittrua*60 ;
						
					
 							 $sogio =  floor($sophut/3600); 
							 $giolamd=  $sogio*1;
							 $sophut = ($sophut - $giolamd*3600)/60;
							 $phutlamtong=$giolamd*60+$sophut;
						
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
							 
						
							 //hiển thị đi trễ về sớm
 						     if($re[$i]['ditre1']!='' || $re[$i]['ditre2']!='')  
							 {
							 	if($re[$i]['ditre1']){
									$maugiolam="red";
									//  $giolam= $giolam."<br>T1:".  $re[$i]['ditre1'] ;
								}
							 	if($re[$i]['ditre2']){
									$maugiolam="red";
									//  $giolam= $giolam."<br>T2:".  $re[$i]['ditre2'] ;
								}
							    
							 
							     
							 }  
							 
						     else if(($re[$i]['thieugio1']!='' || $re[$i]['thieugio2']!='') && $loaigio!=0){ 
							 	if($re[$i]['thieugio1']){
										$maugiolam="red";
									// $giolam= $giolam."<br> S1:" . $re[$i]['thieugio1'];
								}
							 	if($re[$i]['thieugio2']){
									$maugiolam="red";
									// $giolam= $giolam."<br> S2:" . $re[$i]['thieugio2'];
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
					}
					if($ngayvaoratam=='' || $ngayvaoratam!=$ngayvaora){
						$chuoiresultchamcong.= "<br/>G: ".$giolam;
						$ngayvaoratam=$ngayvaora;
                         $mangresult["giolam"]=$giolam;
					}
					 //$chuoiresultchamcong.= "<br/>G: ".$giolam;
					if($bugios){
						
						
					}
					//  $chuoiresultchamcong.= "<br/>bù giơ: ".$bugios;	
                     $mangresult["bugio"]=$bugios;
					if($giochunhat){

					}
				//  $chuoiresultchamcong.= "<br/>giờ chủ nhật: ".$giochunhat;
                 $mangresult["chunhat"]=$giochunhat;
     				 $sogio =  floor($giotinhluong/60)  ;   $sophut=$giotinhluong%60;
			         $tangca=$manglamthem[$idnv];
				
					  $bugio=0;
					  $tongngoaigio=$giotinhluongchunhat+$tangca+$bugio;
					 if($tangca)
					 {
						 $giotc =  floor($tangca/60)  ;   $tangca  =$tangca-$giotc*60;
						 $tangca  = $giotc."h" .$tangca ."'";
					 }
					 
					
					 
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
 
			}
			 $chuoiresultchamcong.= "<br/>****";
			//   $chuoiresultchamcong.= "<br/>Tổng hợp";
			//   $chuoiresultchamcong.= "<br/>------------------------------";
			 $chuoiresultchamcong.= "<br/>Số giờ tính lương: ".$sogio."h" .$sophut ."'";
					  $chuoiresultchamcong.= "<br/>Số giờ tăng ca: ".$tangca ;
					  $chuoiresultchamcong.= "<br/>Tăng ca chủ nhật: ".$giochunhat.'h'.$phutchunhat;
					  $chuoiresultchamcong.= "<br/>Tổng ngoài giờ: ".$tongngoaigio;
					  $chuoiresultchamcong.= "<br/>Ghi chú: ".$ghichu ;

 $r++;

 }
//   $mangresult["chunhat"]=$giochunhat;
    return $mangresult;
 }
?>