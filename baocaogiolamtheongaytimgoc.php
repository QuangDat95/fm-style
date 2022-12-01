<?php  
session_start();
if ($_SESSION["LoginID"] =='') { return ; }

//$giobatdau1=7.3;$g=floor($giobatdau1); $p=$giobatdau1-$g;if($p<0.6&&$p>0) $p=$p*100; echo $p ;
  
//   return;
  
$root_path =getcwd()."/"  ;
include($root_path."biensession.php");
include($root_path."includes/config.php");
include($root_path."includes/removeUnicode.php");
include($root_path."includes/class.paging.php");
include($root_path."includes/class.mysql.php");
include($root_path."includes/function.php");
    
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
		$loaiusertim=  laso($tmp[9])  ;
		$sql_where=" where  1 "; 
		
		
    // $IDNV='5791'; //loại gio 1
	$IDNV='7576'; //loaigio2
	//$IDNV='4121'; // loai gio 0
		$tu='20/10/2021';
		$den='30/10/2021';
		
		
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
		$sql2 ="select sum(sophut) as sophut,idnv from phieutangca where thoigianbatdau>='$tungay' and thoigianketthuc<='$toingay 23:59' and right(tinhtrang,1)=4 group by idnv";
		//echo "<br>".$sql2 ."<br>";
    	$result = $data->query($sql2);	 
		$mangtt='';
		while ($rec = $data->fetch_array($result)  )	 
		{   
		   $manglamthem[$rec['idnv']]=$rec['sophut'] ; 
   		}				
  //==============================================================		
		$sql2 =" select v.sogiolam,v.loaigio,v.batdau,v.ketthuc,v.batdau2,v.ketthuc2,a.ID,a.ten,a.manv,b.Name as cuahang,c.Name as  chucvu from userac  a left join cuahang b on a.cuahang =b.id left join kh_chucvu c on a.chucvu=c.id left join calamviec v on a.calamviec=v.id    "; if ($_SESSION["admintuan"]) echo $sql2 ."<br>";
   		$result = $data->query($sql2);	 
		$mangtt='';
		while ($rec = $data->fetch_array($result)  )	 
		{      
		    if(strpos($rec['sogiolam'],".5")>0) {  $rec['sogiolam']= floor($rec['sogiolam']) *60 + 30;   }
			else  {  $rec['sogiolam']=  $rec['sogiolam']  *60 ;  }
			 
		 	 $mangtt[$rec['ID']]=$rec ; 
   		}				
  
			$sql = "SELECT b.ten as name,a.ngaytao,a.loai,a.IDnhanvien,a.manv ,DATE_FORMAT( a.ngaytao,'%d/%m/%Y') as ngay,DATE_FORMAT( a.ngaytao,'%e') as ngaylam,DATE_FORMAT( a.ngaytao,'%H') as gio,DATE_FORMAT( a.ngaytao,'%i') as phut,b.chucvu   FROM nhanviendilam a left join userac b on b.ID = a.IDnhanvien ".$sql_where." ORDER BY  a.IDnhanvien,a.ngaytao asc    ";
	 
	 
	
		// $mangch= taomang("cuahang","ID","Name");
  //  echo $sql ; 
  // 	if ($_SESSION["admintuan"]) echo $sql ;
 //  	return ;
	
   
	  $r =1;
	//==============================================================	
	if ($_SESSION["admintuan"]) echo $sql . " chuc vu:".   $loaiusertim ; ;
 	// echo ( strtotime('2011-09-01 10:03') -  strtotime('2011-09-01 10:02')  ) ;
	 
	$result = $data->query($sql);
	$manv =''; $tongngay=0;$idnv=0; $giobatdau1=7*60+30;$giobatdau2=13*60+30; $gioketthuc1=11*60+30;$gioketthuc2=17*60+30;
	$mangnv=''; $ditre=0; $ngaythuluu='';
	while($re = $data->fetch_array($result))
	 {     
		$ngaythu =$re['ngaylam']; 
		if($ngaythu!=$ngaythuluu) {$ngaythuluu=$ngaythu ; $sophuttre=0 ; $lan1=1;    }
			if($idnv!=$re['IDnhanvien'] )
			 {    
			    if($idnv) $mangnv[$idnv]['tongnay']= $tongngay ;
			    $sophuttre=0;$ditre=0; $vesom=0;$tongngay= 1; $ngay = $re['ngay'] ;
 				$idnv=$re['IDnhanvien'];
				$giobatdau1=  $mangtt[$idnv]['batdau'] ;      $g=floor($giobatdau1);  $p=$giobatdau1-$g; if($p<0.6&&$p>0) $p=$p*100; $giobatdau1=$g*60+$p ;
				$gioketthuc1= $mangtt[$idnv]['ketthuc'] ;     $g=floor($gioketthuc1); $p=$gioketthuc1-$g;if($p<0.6&&$p>0) $p=$p*100; $gioketthuc1=$g*60+$p ;
				$giobatdau2=  $mangtt[$idnv]['batdau2'] ;     $g=floor($giobatdau2);  $p=$giobatdau2-$g; if($p<0.6&&$p>0) $p=$p*100; $giobatdau2=$g*60+$p ;
				$gioketthuc2= $mangtt[$idnv]['ketthuc2'] ;    $g=floor($gioketthuc2); $p=$gioketthuc2-$g;if($p<0.6&&$p>0) $p=$p*100; $gioketthuc2=$g*60+$p ;
				$loaigio=$mangtt[$idnv]['loaigio']; $sogiolam=$mangtt[$idnv]['sogiolam'];
 				$mangnv[$idnv]['sogiolam']= 1*$mangtt[$idnv]['sogiolam'] ;    
				$mangnv[$idnv]['loaigio']=   $mangtt[$idnv]['loaigio'] ;  //0 tinh theo quét   1: tính đủ giờ  2 văn phòng chỉ quét 2 lần
				$mangnv[$idnv]['giobatdau1']= $giobatdau1 ; 
				$mangnv[$idnv]['giobatdau2']= $giobatdau2 ; 
				$mangnv[$idnv]['gioketthuc1']= $gioketthuc1 ; 
				$mangnv[$idnv]['gioketthuc2']= $gioketthuc2 ; 
   				$mangnv[$idnv]['ten']=  $re['name']  ; 
				$mangnv[$idnv]['chucvu']=  $re['chucvu']  ; 
 				$ngaythu =$re['ngaylam']; $lan1=1;
  				
 			}
			
			 
 		     if ($re['ngay'] != $ngay)  {  $tongngay ++; $ngay = $re['ngay'] ; }
			 
			 if ( $re['loai']==1 ) 
			 { $loai = "Vào" ; $giovao = strtotime($re['ngaytao']) ;  $sophut=0;
			    $giodi= $re['gio']*60+$re['phut'];
				  $mangnv[$idnv]["$ngaythu"]['giovao']=$re['ngaytao'] ;
				 if($lan1==1)
				 {   $lan1 =2 ; 
				 	//if($re['loaiuser']==9) { if($giodi>$giobatdau1){  $mangnv[$idnv]["$ngaythu"]['ditre']= $re['gio'].".".$re['phut'] ; } }
				 //	if($re['loaiuser']==4 ) {   $mangnv[$idnv]["$ngaythu"]['ditre']= 0  ;  }
					if($giobatdau1>0 && $giodi>$giobatdau1) {  $mangnv[$idnv]["$ngaythu"]['ditre']= $re['gio'].".".$re['phut'] ; } //  echo  ($giodi/60)."<br>";
 				 } 
				 else if($lan1==2)
				 { $lan1 =1 ; 
				     if($giobatdau2>0 && $giodi>$giobatdau2) {  $mangnv[$idnv]["$ngaythu"]['ditre2']= $re['gio'].".".$re['phut'] ; } //  echo  ($giodi/60)."<br>";
				 }
  			 }
			 else if ( $re['loai']==2 ) 
			 {   
			     $loai = "Ra" ; $giora = strtotime($re['ngaytao']) ;
				 $sophut=$giora-$giovao;
				// if($sophut>=240) $sp=240; else  $sp=$sophut ;   // 480
				 $sp= $sogiolam*60-5400;  //9000=3600+90*60 1.5  
			     if($loaigio==2 && $sophut<$sp  ){$mangnv[$idnv]["$ngaythu"]['thieugio']="Thiếu giờ";  } 
			//	 $mangnv[$idnv]["$ngaythu"]['ditre'] = $sophuttre; 
 				 $mangnv[$idnv]["$ngaythu"]['giolamd'] += $sophut ;
   				 $mangnv[$idnv]['tongcong']+= $sophut ;
			 
				  $giora= $re['gio']*$re['phut'];
				 if($lan1==1) { if($giora<$gioketthuc1) $vesom =1; }
  			 }
 		}
		
		// het while
	 
		if($idnv) $mangnv[$idnv]['tongnay']= $tongngay ;
	// if ($_SESSION["admintuan"])  	   echo "Ngaythu:".$ngaythu."--" . $mangnv[$idnv]["$ngaythu"]['giolamd'] ."==".$mangnv[$idnv]['tongcong'] ."==<br> "  ; 

	 
?><div   style=" overflow:auto;width:1070px;height:400px" >
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
echo "<pre>";
var_dump($mangnv);
echo "</pre>";
 //=========================================================================================

foreach ($mangnv as $idnv=>$re)
{
    $tennv = $re['Name']  ;
	$cuahang = $re['cuahang'];
	$chucvu = $re['chucvu'];
	$loaiuser = $re['loaiuser'];
	$ghichu =  $re['note'];
    $tongngay=$re['tongnay'];
	$giotinhluong=0;
	$loaigio=$mangtt[$idnv]['loaigio']; $sogiolam=$mangtt[$idnv]['sogiolam'];
	       
         $sogio =  floor($mangnv[$idnv]['tongcong']/3600)  ; 
 		 $sophut = $mangnv[$idnv]['tongcong'] - $sogio*3600 ;
 		 $sophut = round($sophut/60) ;
 		 if (strlen($sogio)==1) $sg = '00'.$sogio ;
		 elseif (strlen($sogio)==2) $sg = '0'.$sogio ;
		 else $sg =  $sogio ;
 		 if (strlen($sophut)==1) $sh = '0'.$sophut ;
		 else $sh =  $sophut ;
		 
         $manv = strtoupper($re['manv']) ; 
	 if($mau == "white"){	 	 $mau = "#EEEEEE";	 $hl = "Normal4" ;	 $hl2 = "Highlight4";	 }else { $mau = "white";$hl = "Normal5" ;$hl2 = "Highlight5";}  
	  $tongcong =0 ;
	 ?>
 	 	<tr  title="<?php echo addslashes($re['note']); ?>"  onclick="setkh('<?php echo addslashes($re["idkhach"]) ; ?>','<?php echo addslashes($re['Name']) ;?>','<?php   echo $re['address'] ;?>','<?php echo $re['tel'] ;?>')"   onMouseOver="this.className='<?php echo $hl2; ?>'" onMouseOut="this.className='<?php echo $hl; ?>'"  bgcolor="<?php echo $mau; ?>" >
		  <td     align="right"> <?php echo $r ;?> </td>		
		 
				<td ><?php echo $mangtt[$idnv]['manv'] ;?></td>
  				<td ><?php echo $mangnv[$idnv]['ten']  ;?></td>
				<td ><?php echo $mangtt[$idnv]['chucvu']  ;?> </td>			
				<td ><?php echo $mangtt[$idnv]['cuahang'] ;?></td>				
                <td ><?php echo $tongngay ;?></td>	
				<td ><strong><?php echo $sogio."h".$sophut ."'"  ; ?></strong></td>
                   <?php for ($i=$ngaybatdau;$i<=$ngaycuoi;$i++){
  					    $sophut= $mangnv[$idnv][$i]['giolamd']*1 ;
						$sp=$sophut;
    					if($sophut>0)
						{   //echo $sophut/3600 ."<br>" ; 
						   if($loaigio==2 && $sophut >4*3600 && $sophut <6.5*3600 )     $sophut = 4*3600 ;  
						   if($loaigio==2 && $sophut >4*3600)     $sophut = $sophut-1.5*3600 ;
						
						  
 							 $sogio =  floor($sophut/3600)  ; 
							 $giolamd=  $sogio*1;
							// $sophut = ceil(($sophut - $giolamd*3600)/60) ;
							 $sophut=$sophut%60 ;
							 // echo  $sophut ."<br>";
							  
 							 if(1*$sophut<10) $sophut='0'.$sophut;
							 if($sogio==0)  { $giolam="X";$maugiolam=""; } else $giolam=$giolamd."h".$sophut ."'";
							 $sogiolam=$mangnv[$idnv]['sogiolam'];
							 
						 
						 	
							
						 	
							  if(($giolamd*60+$sophut)>=$sogiolam&&$loaigio==2){$sophutlam=($sogiolam%60);$giolam = floor($sogiolam/60)."h$sophutlam";$giotinhluong +=$sogiolam ;}//nv vp
							  elseif(($giolamd*60+$sophut)>=$sogiolam && $loaigio==2) 
							  {$sophutlam =$sogiolam%60 ;$giolam = floor($sogiolam/60) ."h$sophutlam $giolamd ";$giotinhluong +=$sogiolam  ; }  	// nv vp					 
							  else if (($giolamd*60+$sophut)>=$sogiolam && $loaigio==1 )  // cht chp
							  {      $sophutlam =$sogiolam%60 ; $giolam =  floor($sogiolam/60) ."h$sophutlam "; $giotinhluong +=$sogiolam  ;    ;
						      }
							  else if( $loaigio==1){  $maugiolam="red"; $giotinhluong += $giolamd*60+ $sophut; $giolam = $giolamd  ."h$sophut <br>Thiếu giờ" ; } // $maugiolam="red"; 
 							  else  {$giotinhluong += $giolamd*60+ $sophut;   $giolam = $giolamd  ."h$sophut  "   ;   } // $maugiolam="red";  
							  
							  
							 
							
							 
 						     if($mangnv[$idnv][$i]['ditre']!='')  
							 { $maugiolam="red"; $giolam= $giolam."<br>T:".  $mangnv[$idnv][$i]['ditre'] ;
							    
							 
							  // if($mangnv[$idnv][$i]['thieugio']!=''){  $giolam= $giolam."<br> " . $mangnv[$idnv][$i]['thieugio']  ;}
							   if($sp<($sogiolam*60)) {  $maugiolam="red"; $giolam= $giolam."<br>Đi trể"   ; }
							     
							 }  
							 
						     elseif($mangnv[$idnv][$i]['thieugio']!=''){ $maugiolam="red"; $giolam= $giolam."<br>" . $mangnv[$idnv][$i]['thieugio']  ; } 
							 elseif($sp<$sogiolam*60)
							 {
							   $maugiolam="red"; $giolam= $giolam."<br>Thiếu giờ"   ;  
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