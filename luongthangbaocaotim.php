<?php   
session_start();
$id = $_SESSION["LoginID"]  ; if ( $id == "") return ;
$root_path =getcwd()."/"  ;
include($root_path."biensession.php");
include($root_path."includes/config.php");
include($root_path."includes/removeUnicode.php");
include($root_path."includes/class.paging.php");
include($root_path."includes/class.mysql.php");
include($root_path."includes/function.php");
include($root_path."includes/function_local.php");

   
 
  
$data = new class_mysql();
$data->config();
$data->access();
 
//=====================================================================================	

  
  $data1 = $_POST['DATA']; 
  $tmp = explode('*@!', $data1);
 // echo   $data1  ;
 		  $thang = laso($tmp[0]) ;
		  $nam = laso($tmp[1]) ;
          $tennv = trim($tmp[2]) ;
		  $manv   = trim($tmp[3] )  ; 
		  $cuahang = laso($tmp[4]) ;
		  $chucvu = laso (trim($tmp[5])) ;		  
  		  $trang = laso($tmp[6]) ;
		  $tinhtrang =  ($tmp[8]) ;
 		  $_SESSION["trangcun"] = $trang ;
		  $sql_where= "" ;
//===========================================================================
  		if($thang>0) { $sql_where.=" and DATE_FORMAT(luongthang,'%c') = '$thang'"; }
 		if($nam>0) { $sql_where.=" and DATE_FORMAT(luongthang,'%Y') = '$nam'"; }
 		 if($tennv!="") {$sql_where.=" and tennv like '%$tennv"."%'";  }
 		 if($manv!="") {$sql_where.=" and manv like '%$manv%'";  }
 		 if($cuahang>0) {$sql_where.=" and idcuahang = '$cuahang'";  }
 		 if($chucvu>0) {$sql_where.=" and idchucvu = '$chucvu'";  }
		 if($tinhtrang!="") {$sql_where.=" and tinhtrang = '$tinhtrang"."'";  } 
	   	  if (strlen($ngay[1])== 1) {  $ngay[1] = "0".$ngay[1] ;  }
		  if (strlen($ngay[0])== 1) {  $ngay[0] = "0".$ngay[0] ;  }    		
		  
		//  $sql_where .= " and  a.ngaythuchi ><td class="cothienthi">&nbsp;<?php echo $re['ngay[2]-$ngay[1]-$ngay[0]'";
		 
 		 
		
		$cuahangtruong  = $_SESSION["se_kho"]  ;
		 
		 
		if ($_SESSION["loai_user"]!=4&& $id !=1 ) return;
		
		if ($cuahang>0) $cuahang =" and cuahang= '$_SESSION[se_mach]' "; else  $cuahang ="";
		 
		$sql = "SELECT  * FROM ns_luongthang   where  1 $cuahang ".$sql_where." ORDER BY idcuahang,  tennv    "; 
		if ($_SESSION["admintuan"]) echo $sql ;
 // echo $sql  ;
  // return ;
	$result = $data->query($sql); 
	 
 
 
?>
<style>

.fixed-top{
 position: -webkit-sticky;
  position: sticky;
  top:0;
}

</style>
   <table border="1" cellpadding="0" cellspacing="0"  class="tbchuan" width="1750px">
   <tr height="60" style="background-color:#F8E4CB;font-weight:bold" class="fixed-top">
   		 
    <td height="44" width="53">STT</td>
    <td width="154">T??n NV</td>
    <td width="61">M?? NV</td>
    <td width="76">Ng??y <br />
      v??o l??m</td>
    <td width="62">Ch???c danh</td>
    <td width="54">ch???c danh</td>
    <td width="98">??H??? s???<br />
      l????ng??</td>
    <td width="49">??H??? s??? v??ng??</td>
    <td width="87">LCB</td>
    <td width="85">??ng??y chu???n??</td>
    <td width="42">??h/<br />
      ng??y??</td>
    <td width="59">Gi???<br />
      c??ng</td>
    <td width="88">L????ng<br />
      ng??y c??ng</td>
    <td width="99">L????ng<br />
      KPI</td>
    <td width="80">L????ng<br />
      danh s???</td>
	  <td width="86">??L????ng ch??? ti??u??</td>
	  <td width="86">L????ng??Doanh thu CNTB??</td>
	   <td width="86">L????ng??CP tr??n DT</td>
	    <td width="86">L????ng tr??ch nhi???m</td>
		 <td width="151">Ph??? c???p <br /></td>
    <td width="151">Ph??? c???p <br />
      d???ch</td>
    <td width="120">Ph??? c???p<br />
      kh??c</td>
    <td width="78">Ph???t (??M)</td>
    <td width="64">BHXH</td>
    <td width="88">THU NH???P??</td>
    <td width="85">L????ng <br />
      c??</td>
	    <td width="95">x??c nh???n l????ng ngh??? vi???c</td>
    <td width="71">??Gi??? c??ng t??nh SP??</td>
    <td width="57">??Tr??? Gi??? c??ng t??nh SP??</td>
    <td width="84">??Th?????ng DS kho??</td>
    <td width="86">??Th?????ng DS OLT??</td>
    <td width="76">C??ng n???</td>
    <td width="96">???? ???ng</td>
    <td width="76">Gi??? l????ng</td>
    <td width="106">??TH???C NH???N??</td>
    <td width="58">??C???a h??ng??</td>
    <td width="112">??X??c nh???n??</td>
  
	<!--<td width="86">??Th???c nh???n??</td>-->
     </tr>
   
 
	  
   <?php
	$mangcuahang  = taomang("cuahang","ID","macuahang");	  
	$mangchucvu  = taomang("kh_chucvu","ID","ma");	   $r=1; 
 while($re = $data->fetch_array($result))
	{
      if($mau == "white")
		{ $mau = "#FAFAF5";  $hl = "Normal4" ; $hl2 = "Highlight4";   }else { $mau = "white"; $hl = "Normal5" ;  $hl2 = "Highlight5"; } 
  $ten = addslashes($re['Name']) ;
  $ma = addslashes($re['codepro']) ;
  $sotien = formatso($re['sotien']) ;
  $mauchu ="000" ;
  if ($re['luachon'] == 1) // cac khoan thu
  {
 	  $mauchu ="00F" ;
  }
  if ($re['luachon'] == 2) // cac khoan thu
  { 	   $mauchu ="F00" ;  } 
  
  
 
  $thunhap=$re['luongngaycong']+$re['luongkpi']+$re['luongds']+$re['hoahong']+$re['thuongcs']+$re['phucap']+$re['phatam']+$re['bhxh']+$re['thuongtop']+$re['luongchitieu']+$re['luongdoanhthu']+$re['luongtrachnhiem']+$re['luongkpimien'];
  $thucnhan=round($thunhap+$re['luongcu']+$re['congno']+$re['daung']+$re['giuluong']);
  ?>
 	 	<tr title="<?php echo addslashes($re['note']) ?>"  style="color:#<?php echo $mauchu; ?>"       bgcolor="<?php echo $mau ?>" >
				<td ><?php echo $r ; ?></td>		
                <td ><?php echo $re['tennv'] ;?></td>  		
				<td ><?php echo $re['manv']  ;?></td>
				<td ><?php echo chuyenngay($re['ngayvaolam'],"yyyy-mm-dd","dd-mm-yyyy" ,'-'  ) ;?></td>
				<td ><?php echo $re['chucdanh'] ;?></td>
                <td ><?php echo $re['chucvu'] ;?></td>
				
  	            <td ><?php echo $re['hesoluong']; ?></td >
				<td><?php echo $re['hesovung']; ?></td >
				<td><?php echo formatso($re['luongcoban']); ?></td >
				<td><?php echo $re['ngaychuan']; ?></td >
				<td><?php echo $re['sogiotrenngay']*1; ?></td >
				<td><?php echo $re['giocong']*1; ?></td >
				<td><?php echo formatso($re['luongngaycong']); ?></td >
				<td><?php echo formatso($re['luongkpi']); ?></td >
				<td><?php echo formatso($re['luongds']); ?></td >
				  <td ><?php echo formatso($re['luongchitieu']); ?></td>
			  <td ><?php echo formatso($re['luongDTCNTB']); ?></td>
			   <td><?php echo formatso($re['luongCTtrenDT']); ?></td>
			   <td><?php echo formatso($re['luongtrachnhiem']); ?></td>
			   	<td><?php echo formatso($re['phucap']); ?></td >
				<td><?php echo formatso($re['phucapdich']); ?></td >
				<td><?php echo formatso($re['phucapkhac']); ?></td >
				<td><?php echo formatso($re['phat']); ?></td >
				<td><?php echo formatso($re['BHXH']); ?></td >
				<td><?php echo formatso($thunhap); ?></td >
				<td><?php echo formatso($re['luongcu']); ?></td >
				<td><?php echo $re['xacnhanluongnghiviec']; ?></td >
				<td><?php echo $re['giocongtinhSP']*1; ?></td >
				<td><?php echo $re['trugiocongtinhSP']; ?></td >
				<td><?php echo $re['thuongDSkho']; ?></td >
				<td><?php echo $re['thuongDSOLT']; ?></td >
				<td><?php echo formatso($re['congno']); ?></td >
				<td><?php echo formatso($re['daung']); ?></td >
				<td><?php echo formatso($re['giuluong']); ?></td >
				<td><?php echo formatso($thucnhan); ?></td >
				<td><?php echo $re['cuahang']; ?></td >
				<td><?php echo $re['xacnhan']; ?></td >
				
				<!--<td><?php echo formatso($re['thucnhan']); ?></td >-->
			 
   </tr>
<?php				
	$r++;
	}
?>	
</table>
  
   

<?php				
    $data->closedata() ; 
	
?>	