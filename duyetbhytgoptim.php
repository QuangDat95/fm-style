<?php  
session_start();
 
 
 
 $root_path =getcwd()."/"  ;
 $quyen= $_SESSION["quyen"] ; 
 $ql =$quyen[$_SESSION["mangquyenid"][$_SESSION['act']]]  ;  
 $idl=$_SESSION["LoginID"];

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
		$tu= trim($tmp[2]);
		$den= trim($tmp[3]);
		$tinhtrang= laso($tmp[4]);
		$ten= chonghack($tmp[5]);
		$loai= laso($tmp[6]);
		  if ($trang!=0  ) $limit  =  " LIMIT ". 10000*($trang-1) .", ". 10000*($trang); else $limit =" limit 10000";
		$sql_where="  WHERE 1    "; 
		$sql_where2 = "" ;
		$sql_where3 = "" ;
		
		$groupby='';
		if($manv != ""){ $sql_where.=" and c.manv = '$manv'"; $groupby='MaNV'; }
		if($ten != ""){ $sql_where.=" and d.ten = '$ten'"; $groupby='ten';}
		if($kho != "")
		{
	   		
  			$sql_where.=" and a.IDcuahang =  '$kho' ";
 	     }else if ($_SESSION["loai_user"]==16)  
		{
			$kho = laso($_SESSION["se_kho"]); 	$sql_where.=" and b.IDcuahang =  '$kho' "; $groupby='IDcuahang';
		} 	
		
		if($tinhtrang != ""){
			$groupby='tinhtrang';
			if($tinhtrang == 0){
				//$sql_where.=" and a.tinhtrang = 111 or a.tinhtrang = 112 or a.tinhtrang = 121 ";
			} else if($tinhtrang == 1){
				$sql_where.=" and left(a.tinhtrang,1) = 4";
			} else if($tinhtrang == 2){
				$sql_where.= " and left(a.tinhtrang,1) = 1 or left(a.tinhtrang,1) = 2";
  			} 
			else if($tinhtrang == 3){
				$sql_where.= " and left(a.tinhtrang,1) = 3 ";
  			} 
			else if($tinhtrang == 4){
				$sql_where.= " and right(left(a.tinhtrang,2),1) = 4 ";
  			} 
			else if($tinhtrang == 5){
				$sql_where.= " and right(left(a.tinhtrang,2),1) = 1 or left(a.tinhtrang,2) = 2";
  			} 
			else if($tinhtrang == 6){
				$sql_where.= " and right(left(a.tinhtrang,2)) = 3";
  			} 
			else if($tinhtrang == 7){
				$sql_where.= " and right(a.tinhtrang,1) = 4 ";
  			} 
			else if($tinhtrang == 8){
				$sql_where.= " and right(a.tinhtrang,1) = 1 or left(a.tinhtrang,2) = 2";
  			} 
			else if($tinhtrang == 9){
				$sql_where.= " and right(a.tinhtrang,1) = 3";
  			} 
			 
		}
		
	 if($tu!="")	
		{
			$groupby='ngaytao';
		  $ngay=  explode('/',$tu);
	   	  if (strlen($ngay[1])== 1) {  $ngay[1] = "0".$ngay[1] ;  }
		  if (strlen($ngay[0])== 1) {  $ngay[0] = "0".$ngay[0] ;  } 
		    //$sql_where2 .= " and  p.Ngaytao>= '$ngay[2]-$ngay[1]-$ngay[0]'";
			//$sql_where3 .= " and  aa.NgayTao>= '$ngay[2]-$ngay[1]-$ngay[0]'";
		  $sql_where  .= " and  a.ngaytao>= '$ngay[2]-$ngay[1]-$ngay[0]'";
		}
		 
		if($den!="")	
		{
			$groupby='ngaytao';
		  $ngay=  explode('/',$den);
	   	  if (strlen($ngay[1])== 1) {  $ngay[1] = "0".$ngay[1] ;  }
		  if (strlen($ngay[0])== 1) {  $ngay[0] = "0".$ngay[0] ;  } 
			//  $sql_where2 .= " and  p.Ngaytao<= '$ngay[2]-$ngay[1]-$ngay[0] 23:59'";
			//   $sql_where3 .= " and  aa.NgayTao<= '$ngay[2]-$ngay[1]-$ngay[0] 23:59'";
		  $sql_where  .= " and  a.ngaytao<= '$ngay[2]-$ngay[1]-$ngay[0] 23:59'";
		}	 
		//
//		$sql_where2.=" and  c.IDkho<>1106 ";
//		
//		if  ($luachon==0 || $luachon==2) { $sapxep  = "desc" ; $banchay = " and soluong >0 ";} else { $sapxep = "asc" ; $banchay = " ";}
//	    $matam = taomang("groupproduct","ID","Name"," where 1  ") ;
//		if($ql[3] )  $mangncc = taomang("nhacungcap","ID","Name"," where 1  ") ; else $mangncc ="";
//		 
	// 	$sql = "  select a.IDSP,b.Name,a.mahang,b.IDGroup, sum(a.SoLuong) as sl,b.price as Gia from `xuatbanhang` a left join products b on a.IDSP = b.ID left join phieunhapxuat c on c.ID = a.IDphieu  $sql_where group by a.IDSP order by sl  $sapxep " ;
 
 	    $mangtangca=array();  $m=array();
		$sql = "select count(DISTINCT TO_DAYS(a.ngaytao)) as tongngay,a.Manv,a.ID,a.IDnhanvien,b.Ten,b.chucvu,c.tinhtrang from nhanviendilam a right join userac b on a.IDnhanvien=b.ID left join duyetbaohiemyte c on c.IDNV=a.IDnhanvien  where SUBSTRING(thongtin,3,3)='8.0' $sql_where group by IDnhanvien";
		
		//echo $sql;
		$tongphieu=0;
 		$result = $data->query($sql);
	 while($re = $data->fetch_array($result))
	{    
		$tongphieu++;
		
 		 $sogio = laso($mangtangca[$re['manv']]['sogio']);
		  //echo $sogio; 
	     $sogio = $sogio+$re['sotien']; 
		
 		 $m['tencuahang']=$re['tencuahang'];
		  $m['manv']=$re['manv'];
		  $m['nguoitao']=$re['nguoitao'];
		  $m['ChucVu']=$re['ChucVu'];
		  $m['sogio']=$sogio;
 	     $mangtangca[$re['manv']]= $m;
		
 		 
    }
	 
	
			
		//$i = $page_start; 
//		$mangnhanvien =taomang("userac","ID","ten"," where tinhluong = '1'  ") ;
	

  if ($_SESSION["admintuan"])	echo  $sql ;
	 
 // echo  "Chờ tí nhé. đang chỉnh lại báo cáo tỉ lệ";  return ;
     
	 
	//==============================================================	
	//$mangnhanvien =taomang("userac","ID","ten"," where tinhluong = '1'  ") ;
?>
   	
<div style="display:auto;overflow:scroll;width:1050px;height:380px"  >
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="tbchuan" id="dopcccc">		
     <tr bgcolor="#F8E4CB">
			<td align="center" height="23" width="37"><b>STT</b></td>
      
 			  <td width="123" align="center" ><strong>Cửa Hàng</strong></td>
			<td width="73" align="center" ><strong>Mã NV</strong></td>      
       <td width="85" align="center"><strong>Tên NV </strong></td>
       <td width="91" align="center"><strong>Chức vụ </strong></td>
 
	   <td width="29" align="center"><strong>Tổng tiền</strong></td>
 
   
  
     
    
	</tr>	
		
   <?php
 
	 $result = $data->query($sql); 
$tong=0;$tongsl=0; $r =0 ; $ngaytao = gmdate('Y-n-d H:i:s', time() + 7*3600) ;

  $cuahangtruong= 1; $giamsat= 2; $nhansu= 3;  // 4 là 12   5 là 13   6  là 23  7 là 123 
   
  $mangchucvu =taomang("kh_chucvu","ID","Name"," where 1  ") ;
  $tonggiotangca=0;
  $ngaynhap = gmdate('Y-n-d', time() + 7*3600)  ;
  
  
  foreach ($mangtangca as $manv => $re )
	{    $r++ ;
 	    
 		 if($mau=="white"){$mau="#EEEEEE";$hl="Normal4";$hl2="Highlight4";}else{$mau="white";$hl="Normal5";$hl2="Highlight5";} 
 	 			 
			    $sogio =    $re["sogio"] ;  
				$tonggiotangca += $sogio;
				/*$tam = floor($sogio/3600);			
				$sogio =   ($sogio- $tam*3600)/60 ;
				$sogio  =$tam.'h'.$sogio."'" ;*/

	 ?>	
 	 	   <tr onMouseOut="this.className='<?php echo $hl; ?>'"  bgcolor="<?php echo $mau ;?>" >
		   <td   align="right"><?php echo $r ;?></td>	
		 
		 
			 <td ><?php echo $re['tencuahang'] ;?></td>
			 <td ><?php echo $re['manv'];?></td>	  			 
             <td ><?php echo $re["nguoitao"];?></td>
			<td ><?php echo  $mangchucvu[$re["ChucVu"]];?></td>
		 <td ><?php echo  $sogio ;?></td>
 			 
			   
    </tr>
<?php	 			

	}
?>	
</table>

</div>
  <div style="padding:5px;" > 
  <strong style="font-size:18px;color:#0066CC"> Tổng phiếu duyệt: <?php echo $tongphieu; ?> - Tổng tiền: 
  <?php 
  		//$tam = floor($tonggiotangca/3600); $sogio =($tonggiotangca- $tam*3600)/60 ;  $sogio  =$tam.'h'.$sogio."'" ;
		 echo $tonggiotangca ; ?> </strong>
   
  </div>
	
  
  <?php				
    $data->closedata() ;
?>	