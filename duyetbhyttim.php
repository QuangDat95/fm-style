<?php  
session_start();
 
 
 
 $root_path =getcwd()."/"  ;
 $quyen= $_SESSION["quyen"] ; 
 $ql =$quyen[$_SESSION["mangquyenid"][$_SESSION["act"]]];  
  $idl=$_SESSION["LoginID"];
//var_dump($ql);
$ql[5]=5;
 if( !($ql[0] || $idl==1) ){return;}

	  
	
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
 
        
        $manv= trim($tmp[0]);
		$kho= laso($tmp[1]);
		$thang= trim($tmp[2]);
		$nam= trim($tmp[3]);
		$tinhtrang= laso($tmp[4]);
		$ten= chonghack($tmp[5]);
		$loai= laso($tmp[6]);
		$sotien= laso($tmp[7]);
		$soct= trim($tmp[8]);
		 
		  if ($trang!=0  ) $limit  =  " LIMIT ". 10000*($trang-1) .", ". 10000*($trang); else $limit =" limit 10000";
		$sql_where="  WHERE 1=1"; 
		$sql_where2 = "" ;
		$sql_where3 = "" ;
		
		
		if($manv != ""){ $sql_where.=" and b.MaNV = '$manv'"; }
		if($ten != ""){ $sql_where.=" and b.Ten = '$ten'"; }
		if($sotien >0 ){ $sql_where.=" and a.sotien = '$sotien'"; }
		if($soct !='' ){ $sql_where.=" and a.soct like '$soct%'"; }
		if($kho != "")
		{
   			$sql_where.=" and a.IDcuahang =  '$kho' ";
 		}else if($_SESSION["loai_user"]==16)
		{
			$sql_where.=" and c.IDcuahang =  '$kho' ";
		}
		
		
	$crdate=date('Y-m-d');
	$songaylamtimtu=(date('Y')-1)."-".date('m').'-01';
	$songaylamtimden=date('Y')."-".date('m').'-31';
     if($nam!=""){
	 	if($thang!=''){
			$crdate=$nam.'-'.$thang."-".date('d');
			
			$songaylamtimden=$nam.'-'.($thang-1)."-31";
			$songaylamtimtu=($nam-1).'-'.$thang."-01";
		}
		else{
			$crdate=$nam.'-'.date('m')."-".date('d');
			$songaylamtimden=$nam.'-'.(date('m')-1)."-31";
			$songaylamtimtu=($nam-1).'-'.date('m')."-01";
			$thang=date('m');
		}
	 }
	 else{
	 	$nam=date('Y');
	 		if($thang!=''){
				$crdate=date('Y').'-'.$thang."-".date('d');
				$songaylamtimden=date('Y').'-'.($thang-1)."-31";
				$songaylamtimtu=(date('Y')-1).'-'.$thang."-01";
			}
			
	 }	
		
		
	 /*if($tu!="")	
		{
		  $ngay=  explode('/',$tu);
	   	  if (strlen($ngay[1])== 1) {  $ngay[1] = "0".$ngay[1] ;  }
		  if (strlen($ngay[0])== 1) {  $ngay[0] = "0".$ngay[0] ;  } 
		    //$sql_where2 .= " and  p.Ngaytao>= '$ngay[2]-$ngay[1]-$ngay[0]'";
			//$sql_where3 .= " and  aa.NgayTao>= '$ngay[2]-$ngay[1]-$ngay[0]'";
		  $sql_where  .= " and  a.ngaytao>= '$ngay[2]-$ngay[1]-$ngay[0]'";
		}
		 
		if($den!="")	
		{
		  $ngay=  explode('/',$den);
	   	  if (strlen($ngay[1])== 1) {  $ngay[1] = "0".$ngay[1] ;  }
		  if (strlen($ngay[0])== 1) {  $ngay[0] = "0".$ngay[0] ;  } 
			//  $sql_where2 .= " and  p.Ngaytao<= '$ngay[2]-$ngay[1]-$ngay[0] 23:59'";
			//   $sql_where3 .= " and  aa.NgayTao<= '$ngay[2]-$ngay[1]-$ngay[0] 23:59'";
		  $sql_where  .= " and  a.ngaytao<= '$ngay[2]-$ngay[1]-$ngay[0] 23:59'";
		}	*/
 
 
$mangcv = taomang ("kh_chucvu","ID","LCASE(Name)"); 
	 
	$sql = "select count(DISTINCT TO_DAYS(a.ngaytao)) as tongngay,month(a.ngaytao) as thang,year(a.ngaytao) as nam,a.Manv,a.ID,a.IDnhanvien,b.Ten,b.chucvu,b.ngayvaolam,
 (12*(YEAR('$crdate') - YEAR(b.ngayvaolam)) 
 + (MONTH('$crdate')- MONTH(b.ngayvaolam)))  as sothang,((12*(YEAR($crdate) - YEAR(b.ngayvaolam)) 
 + (MONTH('$crdate')- MONTH(b.ngayvaolam)))/12 )as uocso
from nhanviendilam a right join userac b on a.IDnhanvien=b.ID 
where SUBSTRING(thongtin,3,3)='8.0'
and (a.ngaytao>='$songaylamtimtu' and a.ngaytao<='$songaylamtimden')

 and (12*(YEAR('$crdate') - YEAR(b.ngayvaolam)) 
 + (MONTH('$crdate')- MONTH(b.ngayvaolam)))%12=0 group by IDnhanvien,month(a.ngaytao)";	
//echo $sql;
 if($_SESSION['admintuan'] ) echo $sql ;
	//	$query_rows = $data->query($sql);
		//$result_rows = $data->num_rows($query_rows);
		$result = $data->query($sql);
		$numrow=$data->num_rows($result);
		
		$mangbhyt=[];
		$mangthang=[];	
		$idnv='';
		$idnvtam='';
		$mangcv = taomang ("kh_chucvu","ID","LCASE(Name)"); 
		$check=0;
	while($re = $data->fetch_array($result))
	{  
			$check++;
			
			
				$mangbhyt[$re['IDnhanvien']]['Manv']=$re['Manv'];
				$mangbhyt[$re['IDnhanvien']]['Ten']=$re['Ten'];
				$mangbhyt[$re['IDnhanvien']]['ngayvaolam']=$re['ngayvaolam'];
				$mangbhyt[$re['IDnhanvien']]['chucvu']=$mangcv[$re['chucvu']];
					
			if($idnv!=$re['IDnhanvien']){
				if($idnv==''){
					
					$idnvtam=$re['IDnhanvien'];
				}
				else{
					$idnvtam=$idnv;
				}
				$idnv=$re['IDnhanvien'];
				$mangbhyt[$idnvtam]['thang']=$mangthang;
					
				$mangthang=[];
			}
		/*	if($check>0){
					$mangbhyt[$idnvtam]['thang']=$mangthang;
					$mangthang=[];
			}*/
			$mangthang[$re['nam']][$re['thang']]=$re['tongngay'];
			if($check==$numrow){
			
				$mangbhyt[$re['IDnhanvien']]['thang']=$mangthang;
			}
		
	}
/*echo "<pre>";
	var_dump($mangbhyt);
	echo "</pre>";
*/		//$i = $page_start; 
//		$mangnhanvien =taomang("userac","ID","ten"," where tinhluong = '1'  ") ;
	

  if ($_SESSION["admintuan"])	echo  $sql ;
	 
 // echo  "Chờ tí nhé. đang chỉnh lại báo cáo tỉ lệ";  return ;
     
	 
	//==============================================================	
	//$mangnhanvien =taomang("userac","ID","ten"," where tinhluong = '1'  ") ;
?>
   <style>
   .fixed_top{
  position: -webkit-sticky;
  position: sticky;
   top: 0;
   border-bottom:1px solid;
   color:#000000;
   background-color:#F8E4CB;
  
}
   </style>	
<div style="display:auto;overflow:scroll;width:1050px;height:380px"  >
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="tbchuan" id="dopcccc">		
     <tr bgcolor="#F8E4CB" class="fixed_top">
			<td align="center" height="23" width="79"><b>STT</b></td>
             
			<td width="120" align="center" ><strong>Mã NV</strong></td>      
       <td width="137" align="center"><strong>Tên NV </strong></td>
       <td width="156" align="center"><strong>Chức vụ </strong></td>
	 <td width="156" align="center"><strong>Ngày vào làm</strong></td>
	 <?php
	 	
	 	for($i=$thang;$i<=12;$i++){
		?>
			 <td width="127" align="center"><strong>Tháng <?=$i.'/'.($nam-1)?></strong></td>
		<?php
		
		}
	 	for($i=1;$i<$thang;$i++){
		?>
			 <td width="127" align="center"><strong>Tháng <?=$i.'/'.$nam?></strong></td>
		<?php
		
		}
	 ?>
  
	     <td width="224" align="center" ><strong>Tình trạng duyệt BHYT</strong></td>	
    
      <?php 
	  		if($ql[2] || $ql[5]){   ?> 
	 			 <td width="207" align="center" ><strong>Nhân sự duyệt</strong></td> 
      <?php } ?>
	  
	  
	</tr>	
		
   <?php
 
 foreach($mangbhyt as $key => $re){ 

	 ?>	
 	 	   <tr onMouseOut="this.className='<?php echo $hl; ?>'"  bgcolor="<?php echo $mau ;?>"  >
		   <td   align="right"><?php echo $r ;?></td>	
 			 <td ><?php echo $re['Manv'];?></td>
             <td ><?php echo  $re['Ten'];?></td>
  			 <td ><?php echo $re["chucvu"];?></td>
			  <td ><?php echo $re["ngayvaolam"];?></td>
			<?php
			
		
				
				for($i=$thang;$i<=12;$i++){
					
		?>
			 	<td width="127" align="center"><strong><?=$re['thang'][$nam-1][$i]?$re['thang'][$nam-1][$i]:""?></strong></td>
			<?php
			
			
			
		}
		?>
		<?php
			
			
				for($i=1;$i<$thang;$i++){
					
		?>
			 	<td width="127" align="center"><strong><?=$re['thang'][$nam][$i]?$re['thang'][$nam][$i]:""?></strong></td>
			<?php
			
			
		}
		?>
			
						 		    
 			<td  align="center" title="<?php echo  $re['tinhtrang']  ;?>"   ><b id="tinhtrang_<?php echo $re["ID"] ;  ?>" ><?php echo $tinhtrangduyet ;?></b></td>
			
			
				 
			  <?php  if($ql[2] || $ql[5]) { ?>
 			<td style="    max-width: 200px;
    word-break: break-word;" valign="middle" align="center">
			 <select id="cpgiamdoc<?php echo $re['IDp']  ;?>"  <?php echo $giamdocht; ?>  onchange="goiduyet(<?php echo $re["ID"] ?>,<?php echo $idl ?>,'<?php echo $re["nguoitao"] ?>','giamdoc',this.value,'cpgiamdoc')">
					<option value="1"  <?php  echo $giamdoc1; ?> >Chưa duyệt</option> 
 					<option value="2"  <?php  echo $giamdoc2; ?> >Chờ thông tin</option>
					<option value="3"  <?php  echo $giamdoc3; ?> >Không duyệt</option>
					<option value="4"  <?php  echo $giamdoc4; ?> >Duyệt</option>
			  </select>
				 <br /><span id="lydo<?php echo $re['IDp']  ;?>"><?php  if ($giamdoc==2||$giamdoc==3) echo  $re["lydogiamdoc"] ; elseif($giamdoc==3) echo  date('H:i  d-m-Y',  strtotime($re["ngayxacnhan2"]))   ; ?></span>
				 </td> 
				 <?php } ?>  
				 
				
    </tr>
<?php	 			

	}
?>	
</table>

</div>



  <?php				
    $data->closedata() ;
?>	