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
		//$IDNV='6842';
		$IDNV='5791'; //loại gio 1
		//$IDNV='7576'; //loaigio2
		//$IDNV='4121';// loai gio 0
		//$tu='01/01/2021';
		//$den='10/01/2021';
		
		$tu='20/10/2021';
		$den='31/10/2021';
		
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
		
		
 //==================mang tang ca ============================================				
	/*	$sql2 ="select sum(sophut) as sophut,idnv from phieutangca where thoigianbatdau>='$tungay' and thoigianketthuc<='$toingay 23:59' and right(tinhtrang,1)=4 group by idnv";
		//echo "<br>".$sql2 ."<br>";
    	$result = $data->query($sql2);	 
		$mangtt='';
		while ($rec = $data->fetch_array($result)  )	 
		{   
		   $manglamthem[$rec['idnv']]=$rec['sophut'] ; 
   		}*/
		
					
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
  
			$sql = "SELECT b.ten as name,a.ngaytao,a.loai,a.thongtin,a.IDnhanvien,a.manv,a.IDcuahang ,a.cuahang ,DATE_FORMAT( a.ngaytao,'%d/%m/%Y') as ngay,DATE_FORMAT( a.ngaytao,'%e') as ngaylam,DATE_FORMAT( a.ngaytao,'%H') as gio,DATE_FORMAT( a.ngaytao,'%i') as phut,b.chucvu   FROM nhanviendilam a left join userac b on b.ID = a.IDnhanvien ".$sql_where." ORDER BY  a.IDnhanvien,a.ngaytao asc    ";
	
	 
	
   //in($mangtt);
	  $r =1;
	//==============================================================	
	if ($_SESSION["admintuan"]) echo $sql . " chuc vu:".   $loaiusertim ; ;
 	// echo ( strtotime('2011-09-01 10:03') -  strtotime('2011-09-01 10:02')  ) ;
	 
	$result = $data->query($sql);
	$manv ='';
	$tongngay=0;
	$idnv=0;
	$giobatdau1=7*60+30;
	$giobatdau2=13*60+30;
	$gioketthuc1=11*60+30;
	$gioketthuc2=17*60+30;
	$mangnv='';
	$ditre=1; 
	$ngaythuluu='';
	//biến đếm số lần quét
	$lanthu=1;
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
while($re = $data->fetch_array($result))
{     
	
	//$thongtinnv=tachthongtin($re['thongtin']);
	$idnv=$re['IDnhanvien'];
	//quet lan thứ n
	$lanthu++;
	//gio quet
	 $gioquetngay= $re['gio']*60+$re['phut'];
		$ngaythu =$re['ngaylam']; 
		if($ngaythu!=$ngaythuluu)
		{
			$ngaythuluu=$ngaythu ;
			$sophuttre=0;
			$lanthu=1;
			
			// lấy các thông tin từ đầu mỗi dòng mỗi ngày
			// mảng thông tin từ chuỗi
			$thongtinnv=explode("*",$re['thongtin']);
			$giobatdau1=convertHtoM($thongtinnv['2'])['totalp'];
			$gioketthuc1=convertHtoM($thongtinnv['3'])['totalp'];
			$giobatdau2=convertHtoM($thongtinnv['4'])['totalp'];
			$gioketthuc2=convertHtoM($thongtinnv['5'])['totalp'];
			$sogiolam=convertHtoM($thongtinnv['1'])['totalp'];
			//kiểm tra giờ ra vào
			$loaigiotam=$thongtinnv[0];
			$chucvutam=$thongtinnv[6];
			$mangnv[$idnv]['sogiolam']= 1*$sogiolam;    
			$mangnv[$idnv]['chucvu']= $chucvutam;
			$mangnv[$idnv]['cuahang']= $re['cuahang']; 
		//	echo $re['IDcuahang'];
			$mangnv[$idnv]['tenchucvu']= $mangcv[$chucvutam];			
			$mangnv[$idnv]['ten']=  $re['name']; 
			$mangnv[$idnv]['manv']=  $re['manv']; 
			//thay đổi theo ngày
			$mangnv[$idnv]["$ngaythu"]['giobatdau1']= $giobatdau1 ; 
			$mangnv[$idnv]["$ngaythu"]['giobatdau2']= $giobatdau2 ; 
			$mangnv[$idnv]["$ngaythu"]['gioketthuc1']= $gioketthuc1 ; 
			$mangnv[$idnv]["$ngaythu"]['gioketthuc2']= $gioketthuc2 ; 
			$mangnv[$idnv]["$ngaythu"]['sogiolam']= 1*$sogiolam; 
			$mangnv[$idnv]["$ngaythu"]['loaigio']=  $loaigiotam ;  
			$mangnv[$idnv]["$ngaythu"]['chucvu']= $chucvutam; 
			
		}
		if($idnv!=$re['IDnhanvien'])
		{    
			if($idnv) $mangnv[$idnv]['tongnay']= $tongngay ;
			$sophuttre=0;$ditre=0; $vesom=0;$tongngay= 1; $ngay = $re['ngay'] ;
			$idnv=$re['IDnhanvien'];
			
		}
		 if ($re['ngay'] != $ngay)  {  $tongngay ++; $ngay = $re['ngay']; }
		//	echo $loaigiotam;
			//thong tin chung
			$ngaythu =$re['ngaylam'];	
				
					$kiemtraquet=kiemtraquetthe4lan($giobatdau1,$giobatdau2,$gioketthuc1,$gioketthuc2,$gioquetngay,$lanthu,$loaigiotam);
					if($kiemtraquet['som1'])$mangnv[$idnv]["$ngaythu"]['thieugio']='Thiếu giờ';
					if($kiemtraquet['tre1'])$mangnv[$idnv]["$ngaythu"]["ditre"]=$re['gio'].".".$re['phut'];
					if($kiemtraquet['som2'])$mangnv[$idnv]["$ngaythu"]["thieugio"]='Thiếu giờ';
					if($kiemtraquet['tre2'])$mangnv[$idnv]["$ngaythu"]["ditre2"]=$re['gio'].".".$re['phut'];
					
					
			if($kiemtraquet['loai']==1){
					$giovao = strtotime($re['ngaytao']);
					//echo "vào";
					$sophut=0;
					$giodi= $re['gio']*60+$re['phut'];
					$mangnv[$idnv]["$ngaythu"]['giovao'.$lanthu]=$re['ngaytao'];
					
			}
			else{
					//echo "ra";
					$giora = strtotime($re['ngaytao']);
					$sophut=$giora-$giovao;
					$sp= $sogiolam*60-5400; 
					 $giora= $re['gio']*60+$re['phut'];
					  $mangnv[$idnv]["$ngaythu"]['giora'.$lanthu]=$re['ngaytao'];
					 $mangnv[$idnv]["$ngaythu"]['giolamd'] += $sophut;
					 $mangnv[$idnv]['tongcong']+= $sophut;
			}
	
}
		
	if($idnv) $mangnv[$idnv]['tongnay']= $tongngay ;

in($mangnv);
?>
<div   style=" overflow:auto;width:1070px;height:400px" >
 <table width="99%" border="0" cellpadding="0" cellspacing="0" class="tbchuan">		
 		<tr bgcolor="#F8E4CB">
		  <td align="center"  height="23" width="32"><b>STT</b></td>
		 
		    <td width="55" align="center" ><strong> Mã NV  </strong> </td> 	
		  <td width="193" align="center"  ><strong>Tên Nhân Viên </strong></td>  
		   <td width="64" align="center"  ><strong>Chức Vụ</strong></td>   
 		  <td width="104" align="center" ><strong>Nhân viên tại </strong></td>
		   <td width="98" align="center" ><strong>Tổng ngày </strong></td>
		   <td width="74" align="center" ><strong>Số giờ làm </strong></td>
           <?php  for($i=$ngaybatdau;$i<=$ngaycuoi ;$i++)
		   { ?>
             <td >Ngày <?php echo $i ; ?></td>
              <?php  } ?>
			    <td width="74" align="center" ><strong>Số giờ tính lương </strong></td>
				<td width="74" align="center" ><strong>Số giờ tăng ca</strong></td>
		    <td width="428" align="center" ><strong>Ghi Chú</strong></td>	
 		</tr>
<?php

 //=========================================================================================
//$time = date('i:s', $mangnv[$idnv]["$ngaythu"]['giolamd']);
//in($time);
//in($mangnv);
//return;
	
foreach ($mangnv as $idnv=>$re)
{
	
	
	$cuahang = $re['cuahang'];
	$chucvu = $re['chucvu'];
	$tenchucvu=$re['tenchucvu'];
	$loaiuser = $re['loaiuser'];
	$ghichu =  $re['note'];
    $tongngay=$re['tongnay'];
	$giotinhluong=0;
	 $sogio =  floor($re['tongcong']/3600)  ; 
	 $sophut = $re['tongcong'] - $sogio*3600 ;
	 $sophut = round($sophut/60);
	 if (strlen($sogio)==1) $sg = '00'.$sogio ;
	 elseif (strlen($sogio)==2) $sg = '0'.$sogio ;
	 else $sg =  $sogio;
	 if (strlen($sophut)==1) $sh = '0'.$sophut ;
	 else $sh =  $sophut;
		// echo  $re['tongcong'];
         $manv = strtoupper($re['manv']) ; 
	 if($mau == "white"){	 	 $mau = "#EEEEEE";	 $hl = "Normal4" ;	 $hl2 = "Highlight4";	 }else { $mau = "white";$hl = "Normal5" ;$hl2 = "Highlight5";}  
	  $tongcong =0 ;
	 ?>
 	 	<tr  title="<?php echo addslashes($re['note']); ?>"  onclick="setkh('<?php echo addslashes($re["idkhach"]) ; ?>','<?php echo addslashes($re['Name']) ;?>','<?php   echo $re['address'] ;?>','<?php echo $re['tel'] ;?>')"   onMouseOver="this.className='<?php echo $hl2; ?>'" onMouseOut="this.className='<?php echo $hl; ?>'"  bgcolor="<?php echo $mau; ?>" >
		  <td     align="right"> <?php echo $r ;?> </td>		
		 
				<td ><?php echo $re['manv'] ;?></td>
  				<td ><?php echo $re['ten']  ;?></td>
				<td ><?php echo $tenchucvu  ;?> </td>			
				<td ><?php echo $cuahang ;?></td>				
                <td ><?php echo $tongngay ;?></td>	
				<td ><strong><?php echo $sogio."h".$sophut ."'"  ; ?></strong></td>
                   <?php for ($i=$ngaybatdau;$i<=$ngaycuoi;$i++){
				   
						$loaigio=$re[$i]['loaigio'];
						
  					    $sophut= $re[$i]['giolamd']*1 ;
						$sp=$sophut;
						
    					if($sophut>0)
						{   //echo $sophut/3600 ."<br>" ; 
						
						   if($loaigio==2 && $sophut >4*3600 && $sophut <6.5*3600 )     $sophut = 4*3600 ;  
						   if($loaigio==2 && $sophut >6.5*3600)     $sophut = $sophut-1.5*3600 ;
							
							
							/*if($loaigio==1 && $sophut >4*3600 && $sophut <6.5*3600 )     $sophut = 4*3600;  
						   if($loaigio==1 && $sophut >6.5*3600)   $sophut = $sophut-2*3600;*/
						  
 							 $sogio =  floor($sophut/3600); 
							 $giolamd=  $sogio*1;
							 $sophut = ceil(($sophut - $giolamd*3600)/60) ;
							 $sophut=$sophut%60;
							  //echo  $sophut ."<br>";
							
							  //echo  $sophut;
 							 if(1*$sophut<10) $sophut='0'.$sophut;
							 if($sogio==0)  {
							 	$giolam="X";$maugiolam="";
							}
							  else $giolam=$giolamd."h".$sophut ."'";
							  
							$sogiolam=$re[$i]['sogiolam'];
							// echo 'loại giờ'.$loaigio.': '.$giolamd.'x60 + '.$sophut.'= '.$sogiolam.'</br>';
							if(($giolamd*60+$sophut)>=$sogiolam && ($loaigio==2 || $loaigio==1 )){
							  
							 	 $sophutlam=($sogiolam%60);
								 $giolam = floor($sogiolam/60)."h$sophutlam";
								 $giotinhluong +=$sogiolam ;
							}
							  else if($loaigio==1 || $loaigio==2){  
							  		$maugiolam="red";
									$giotinhluong += $giolamd*60+ $sophut;
									$giolam = $giolamd  ."h$sophut <br>Thiếu giờ" ;
							} 
 							  else  {
							  		$giotinhluong += $giolamd*60+ $sophut;
									$giolam = $giolamd  ."h$sophut  "; 
							} 
							 
							 
							 //hiển thị đi trễ về sớm
					
 						     if($re[$i]['ditre']!='')  
							 {
								 
									$maugiolam="red"; $giolam= $giolam."<br>T:".  $re[$i]['ditre'] ;
								
							    
							   if($sp<($sogiolam*60)) {
							   	
										$maugiolam="red";
										$giolam= $giolam."<br>Đi trễ"; 
									
								
								}
							     
							 }elseif($mangnv[$idnv][$i]['thieugio']!=''){ 
							 	
							 		$maugiolam="red";
									$giolam= $giolam."<br>" . $re[$i]['thieugio'];
								
								
							}elseif($sp<$sogiolam*60)
								 {
									if($loaigio!=0){
										$maugiolam="red";
										$giolam= $giolam."<br>Thiếu giờ";
									}  
									else{
									 $maugiolam="";
									}
								 }
								 else
								  $maugiolam="";
								
							}
							else
							{
								$giolam="X";  $maugiolam="";
							}
						
					
						//if($ditre>0 || $vesom>0) $maugiolam= "#CC6666" ;else $maugiolam="";
					  ?>
                 <td align="center" bgcolor="<?php echo $maugiolam ; ?>" ><?php echo  $giolam  ;  ?></td>
              <?php  } ?>
			  <?php  $sogio =  floor($giotinhluong/60)  ;   $sophut=$giotinhluong-$sogio*60;
			         $tangca=$manglamthem[$idnv];
					 if($tangca)
					 {
						 $giotc =  floor($tangca/60)  ;   $tangca  =$tangca-$giotc*60;
						 $tangca  = $giotc."h" .$tangca ."'";
					 }
			   ?>
			  <td   align="center" ><?php echo $sogio."h" .$sophut ."'";?></td>    
				<td   align="center" ><?php echo $tangca ;?></td>    
					<td   align="center" ><?php echo $ghichu ;?></td>    
    </tr>
<?php	
 $r++;
 }
	
 
 
	
?>	
 	 	 
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