<?php  
session_start();
//$_SESSION["mangidhientai"]=[];
 $idk=$_SESSION["LoginID"];
 $mangidhientai=$_SESSION["mangidhientai"]?$_SESSION["mangidhientai"]:[];
 $idcuahang=$_SESSION["se_kho"];
if ($idk =='') { return ; }

$root_path =getcwd()."/"  ;
include($root_path."biensession.php");

include($root_path."includes/config.php");
include($root_path."includes/removeUnicode.php");
include($root_path."includes/class.paging.php");
include($root_path."includes/class.mysql.php");
include($root_path."includes/function.php");
   // $ql[5]=5;
$data = new class_mysql();
$data->config();
$data->access();
$data->setdangnhap($idk,$us) ;
 $arrhhcuahang=manghanghoacuhang($idcuahang);
//var_dump($mangidhientai);
//================================
 $mangdaco['0']='1';
 $chuoitrave='';
 
 function chuyen($tam)
  { global $mangdaco ;
	global $chuoitrave;
	global $mauve;
 	 if ( $tam != '')
     {
	   $tam = explode("&*!",$tam) ;
		$k =0; $sopt = count ($tam) ;
		 
		if ($sopt <2)  $chuoisp = $result_news["masp"] ;
		else
		{
			$mang = ''; $chuoisp='';
			for($i=1 ;$i<=$sopt ;$i++)
			{   if ($k==0)  {$idm = $tam[$i]; $k =1 ; } 
				else if($k==1) 
				{
					if(laso($mangdaco[$idm])=='0')
					{
					 $sql = " select sum(a.soluong) as sl from hanghoacuahang a left join products b on a.idsp=b.id where a.soluong>0 and a.idcuahang>1 and b.codepro='$idm'  ";$tamsl=getdong($sql);
				     $mangdaco[$idm]=$tamsl['sl'];
					}
					if($mangdaco[$idm]>0) { $soluongco=  " <b  style='color:red' > Về:".$mangdaco[$idm]."</b>"; $mauve="blue";}
					else  {$soluongco= "";$mauve="";}
					if($chuoisp=='') {$chuoisp =$tam[$i] .$soluongco ;} else { $chuoisp .= "<br>".$tam[$i] .$soluongco ;} 
					 $mang["$idm"]=$tam[$i]; $k =2 ;
						
				}
				elseif( $k==2) { $sl = $tam[$i] ; $k =3 ; }
 				elseif( $k==3)  {$gia = $tam[$i]; $k =0 ; }
 		
			}
		}
       }	
	   return $chuoisp;
  }
  //======================================
  if(isset($_POST["LOADLAI"])){

  		 $data1 = $_POST['LOADLAI']; 
		  $tmp = explode('*@!',$data1);
		     $loadlai= $tmp[10];
			$chuoinotin='';
		if($mangidhientai){
				
				foreach($mangidhientai as $key => $value){
					$chuoinotin.=$value.',';
				}
			}
			$chuoinotin=rtrim($chuoinotin,",");
		if($loadlai==1){
		
				 $sql_where .= " where a.ID not in ($chuoinotin)";
				
			
			$sql ="
		SELECT  a.ID as idphieu,a.IDbill,DATE_FORMAT(a.ngaytao,'%d/%m/%y %h:%i') as ngaytao,a.IDpassdon,a.mavd,a.tinhtrang,DATE_FORMAT(a.ngaynhandon,'%d/%m/%y %h:%i') as ngaynhandon,DATE_FORMAT(a.ngaytoikho,'%d/%m/%y %h:%i') as ngaytoikho,DATE_FORMAT(a.ngaygiaohang1,'%d/%m/%y %h:%i') as ngaygiaohang1,DATE_FORMAT(a.ngaygiaohang2,'%d/%m/%y %h:%i') as ngaygiaohang2,DATE_FORMAT(a.ngaygiaohang3,'%d/%m/%y %h:%i') as ngaygiaohang3,DATE_FORMAT(a.ngayhuy,'%d/%m/%y %h:%i') as ngayhuy,DATE_FORMAT(a.ngayhoanthanh,'%d/%m/%y %h:%i') as ngayhoanthanh  from vanchuyenpassdon a ".$sql_where."  ORDER BY a.ID, a.ngaytao desc ";
	
	$query =$data->query($sql);	
	
			$r=0;
		while($re=$data->fetch_array($query)){
		
					$r++;
 		
			  array_push($mangidhientai,$re['idphieu'])	;
	
			}
			$_SESSION["mangidhientai"]= $mangidhientai;
			
		
		echo $r;
		return;
		}
	}
  
 
  $data1 = $_POST['DATA']; 
  $tmp = explode('*@!',$data1);
   $manv=    ($tmp[0])    ;
   $madonvan =addslashes(trim($tmp[1]));
   $tenkhach= addslashes($tmp[2]);
   $tel= $tmp[3];   
   $tinhtrang= $tmp[4];
   $tinhtranghang= $tmp[5];
   $tu= $tmp[6];
   $den= $tmp[7];
   $nguoitao= $tmp[8];
   $trang= $tmp[9];
    $sophieu= $tmp[10];
	//echo $sophieu;
   $NgayTao = date('Y-m-d H:i:s') ;
    
  
		$sql_where=" where 1=1  ";
		if($manv!="") $sql_where.=" and u.MaNV = '".$manv."'";
		if($sophieu!="") $sql_where.=" and b.SoCT = '".$sophieu."'";
		if($madonvan!="") $sql_where.=" and a.madonvan  like '%".$madonvan."%'";
		if($tenkhach !="")  $sql_where.=" and a.tenkhach  like '%".$tenkhach."%'";
		if($tel!="") { $tam=$tel ; if($tel[0]==0 )  $tam[0]=""; $sql_where.=" and a.tel  like '%".trim($tam)."%'";   } 
		if($tinhtrang >0) { 	$sql_where.=" and a.tinhtrang= $tinhtrang  "; 		}
		if($tinhtranghang >0) { 	$sql_where.=" and a.tinhtranghang= $tinhtranghang  "; 	}	
		if($nguoitao >0) { 	$sql_where.=" and a.idtao= $nguoitao  "; 	}	
		if($tu!="")	
		{
		  $ngay=  explode('/',$tu);
	   	  if (strlen($ngay[1])== 1) {  $ngay[1] = "0".$ngay[1] ;  }
		  if (strlen($ngay[0])== 1) {  $ngay[0] = "0".$ngay[0] ;  }    		
		  $sql_where .= " and  a.ngaytao >= '$ngay[2]-$ngay[1]-$ngay[0] 00:01'";
		}
		if($den!="")	
		{
		  $ngay=  explode('/',$den);
	   	  if (strlen($ngay[1])== 1) {  $ngay[1] = "0".$ngay[1] ;  }
		  if (strlen($ngay[0])== 1) {  $ngay[0] = "0".$ngay[0] ;  }    		
		  $sql_where .= " and  a.ngaytao <= '$ngay[2]-$ngay[1]-$ngay[0] 23:59'";
		} 
		

	$sql ="
SELECT  a.ID as idphieu,a.IDTao,a.IDbill,b.SoCT as sctbill,DATE_FORMAT(a.ngaytao,'%d/%m/%Y %h:%i') as ngaytao,a.IDpassdon,a.mavd,a.tinhtrang,DATE_FORMAT(a.ngaynhandon,'%d/%m/%Y %H:%i') as ngaynhandon,DATE_FORMAT(a.ngaytoikho,'%d/%m/%Y %h:%i') as ngaytoikho,DATE_FORMAT(a.ngaygiaohang1,'%d/%m/%Y %h:%i') as ngaygiaohang1,DATE_FORMAT(a.ngaygiaohang2,'%d/%m/%y %H:%i') as ngaygiaohang2,DATE_FORMAT(a.ngaygiaohang3,'%d/%m/%Y %H:%i') as ngaygiaohang3,DATE_FORMAT(a.ngayhuy,'%d/%m/%Y %H:%i') as ngayhuy,DATE_FORMAT(a.ngayhoanthanh,'%d/%m/%Y %H:%i') as ngayhoanthanh  from vanchuyenpassdon a left join passdon c on a.IDpassdon=c.ID left join userac u on c.IDTao=u.ID left join  phieunhapxuat b on a.IDbill=b.ID ".$sql_where."  ORDER BY a.ID desc ";

//echo $sql;
		
   	  $_SESSION['sqlluu']=$sql ;
	    $mangtinhtrangmau = taomang("tinhtrang","ID","mau");
		$mangtinhtrang = taomang("tinhtrang","ID","manhomhang");	
	    $mangtinhtrangten = taomang("tinhtrang","ID","name");	
		
		$mangsize=taomang("size","ID","Name" );
 $mangmau =taomang("mausac","ID","Name" );
		  $mangcuahang = taomang("cuahang","ID","Name");	 
 if($_SESSION["admintuan"]) echo $sql ; 
 	//========================================================
  if (!is_numeric($trang) ) $trang = 1 ;
   		if ($trang * 1  <= 0 ) $trang = 1 ;	
	 $result = $data->query($sql); 
	 $num=$data->num_rows($result);	
	 $pagesize = 400; 
	 if ($trang == '') $trang = 1 ;
	  
	 	 if ($num > $pagesize )
	 {
		 if ( $trang != '')
		 {	
			$paging_two = ($trang -1) * $pagesize; 	
			$sql .=  " LIMIT ".$paging_two.", ".$pagesize;
			$result = $data->query($sql); 
			
			for ($i=1;$i<($num/$pagesize)+1;$i++)
			{
				if ( $i == $trang) 
				{ $pt = $pt . " &nbsp;". "  <label style=\"color:#FF0000\">$i</label> " ;  	}
				 else { $pt = $pt . " &nbsp;". "<a style='cursor:pointer' onclick=\"timkiemkh('$tmp[0]','$tmp[1]','$tmp[2]','$tmp[3]','$tmp[4]','$i','$tmp[6]')\"  > $i </a> " ;  } 		  
			}
			
		  }
	  }
	  $r = $pagesize * $trang - $pagesize + 1  ;
	//==============================================================	
 

?><div   style=" overflow:auto;width:99%;height:400px" >
 <table width="99%" border="0" cellpadding="0" cellspacing="0" class="tbchuan" >		
 			<tr bgcolor="#F8E4CB">
			<td align="center"  height="23" width="29"><b>STT</b></td>
             <td width="40" align="center"><strong>Ngày tạo</strong></td>	    
              <td width="109" align="center"><strong>Số chứng từ</strong> </td>
	     <td width="109" align="center"><strong>Mã vận đơn</strong> </td> 
		  <td width="109" align="center"><strong>ID Pass Đơn</strong> </td> 
 <td width="126" align="center"><strong>Tình trạng </strong></td>
 	<td width="126" align="center"><strong>Ngày nhận đơn</strong></td>
		<td width="126" align="center"><strong>Ngày tới kho</strong></td>
			<td width="126" align="center"><strong>Giao hàng lần 1</strong></td>
				<td width="126" align="center"><strong>Giao hàng lần 2</strong></td>
					<td width="126" align="center"><strong>Giao hàng lần 3</strong></td>
						<td width="126" align="center"><strong>Ngày hủy</strong></td>
						<td width="126" align="center"><strong>Lý do hủy</strong></td>
						<td width="126" align="center"><strong>Ngày hoàn thành</strong></td>
						<td width="126" align="center"><strong>Hủy</strong></td>
						<td width="126" align="center" style="display:none" ><strong>Tạo vận đơn</strong></td>
		</tr>
		<tbody id="tbdulieu">	
<?php
  $mangnhanvien =taomang("userac","ID","ten"," where ID >0    ");	//  loai in (16,5,6,10) 
 $mangnhanvien[1]='admin';
 
 
 	while($re = $data->fetch_array($result))
	{
					 array_push($mangidhientai,$re['idphieu']);			
		 if($mau == "white")
		{	{
			 $mau = "#EEEEEE";
			 $hl = "Normal4" ;
			 $hl2 = "Highlight4";
			}
			 $hl = "Normal4" ;
			 $hl2 = "Highlight4"; 
		}else { 
		$mau = "white";
		$hl = "Normal5" ;
		$hl2 = "Highlight5";
		} 
 
  $tinhtrangkhoa='<span style="color:#03a9f4;font-weight:bold">Mới tạo</span>';
  $disabled='';
  if($re['tinhtrang']==4){
  		$tinhtrangkhoa='<span style="color:#4caf50;font-weight:bold">Phiếu đã khóa<span>';
		 $disabled='disabled="disabled"';
  }
  else if($re['tinhtrang']==3){
  	$tinhtrangkhoa='<span style="color:red;font-weight:bold">Phiếu đã hủy<span>';
		 $disabled='disabled="disabled"';
  }
   //$arrhhcuahang 
  //$maspve= mangsppass($re['idphieu']);
//  var_dump($maspve);
 $mauchu="";
 if(!$re["mavd"] || $re["mavd"]==''){
 	$mauchu="red";
 }
 
 	 ?>
 	 	<tr class="dong_show" id="dong_<?php echo  $re['idphieu'] ; ?>" title="<?php echo addslashes($re['note']) ?>"   onMouseOver="this.className='<?php echo $hl2; ?>'" onMouseOut="this.className='<?php echo $hl; ?>'"  bgcolor="<?php echo $mau; ?>"  style="color:<?php echo  $mauchu; ?>">
		  <td     align="right"> <?php echo $r ;?> </td>		
		  <td ><?php echo $re['ngaytao'] ;?><br /></td>	
		   <td ><?php echo $re['sctbill'] ;?></td>			
           <td id="vandon<?=$re['idphieu']?>"><?php echo $re['mavd'] ;?></td>			
		<td ><?php echo $re['IDpassdon'] ;?></td>
		<td id="tinhtrang<?=$re['idphieu']?>"><?=$tinhtrangkhoa?></td>
			<td ><?=$re['ngaynhandon']?></td>
			<td ><?=$re['ngaytoikho']?></td>
			<td ><?=$re['ngaygiaohang1']?></td>
			<td ><?=$re['ngaygiaohang2']?></td>
			<td ><?=$re['ngaygiaohang3']?></td>
			<td ><?=$re['ngayhuy']?></td>
			<td ><?=$re['lydohuy']?></td>
			<td ><?=$re['ngayhoanthanh']?></td>
			<td >
			<?php 
				if($idk==$re['IDTao'] || $ql[5] || $_SESSION["LoginID"] ==7576 || $_SESSION["LoginID"] ==4647	 ){
			  	 if($re['tinhtrang']==4 || $re['tinhtrang']==3){
				 	$disbledkhoa="disabled='disabled'";
				 }
			?>
			<button type="button" <?=$disabled?> id="btnkhoa<?=$re['idphieu']?>" onclick="showFormhuy(<?php echo "'".$re["sctbill"]."',".$re['idphieu'].",8," ;?>'','','')">Hủy phiếu</button>
			<?php }?>
			</td>
			
				<td style="display:none" >
					<?php 
				if($idk==$re['IDTao'] || $ql[5] || $_SESSION["LoginID"] ==7576 || $_SESSION["LoginID"] ==4647	 ){
			  	 if($re['tinhtrang']==4 || $re['tinhtrang']==3){
				 	$disbledkhoa="disabled='disabled'";
				 }
				 
				 if($_SESSION["LoginID"] ==7576 || $_SESSION["LoginID"] ==4647){
				 		$disabled='';
				 }
			?>
				<?php if($mauchu ||  $_SESSION["LoginID"] ==7576 || $_SESSION["LoginID"] ==4647){?><button type="button" <?=$disabled?> id="btntaovandon<?=$re['idphieu']?>" onclick="taovandon(<?php echo $re['idphieu']?>)">Tạo vận đơn</button>
			<?php } ?>
			<?php }?>
			</td>	
			
            
    </tr>
<?php				
	$r++;
		

		
	}
?>	</tbody>
	
</table>

</div>
<div style="padding:5px;" >
<div id="khonghienthires"></div>
<?php 
//==============================================================	
    if ( $num != 0 ) {
 ?>
  Tìm thấy  <?php echo  $num ; ?>   phiếu ! &nbsp;   <?php if ($num > $pagesize ) echo "Trang : ". $pt ; ?>  
  <?php 
  } else
  {
  	 echo "<font size=2  color='#FF3300'>Không tìm thấy phụ khách hàng, bạn có thể tìm theo từ ngắn hơn hoặc bấm vào nút '<b>Thêm </b>' để thêm khách hàng !!!</font> " ;
  }
 //==============================================================	
 ?> 

 </div>
 
 
<?php				
   
function manghanghoacuhang($idch)
{ 	
	global $data ;
	
 		 $sql = " select a.* from hanghoacuahang a where a.IDcuahang='$idch'";
		$query=$data->query($sql);
		$mangtam=[];
		while($re=$data->fetch_array($query)){
			$mangtam[$re['IDSP']]=$re['SoLuong'];
		}	
				    
	   return $mangtam;
}

function mangsppass($idp)
{ 
	global $data ;
	
 		 $sql = " select a.*,b.size,b.mau from passdonchitiet a left join products b on a.IDSP =b.ID where a.IDPhieu='$idp'";
		 
		$query=$data->query($sql);
		$mangtam=[];
		while($re=$data->fetch_array($query)){
			$mangtam[$re['IDSP']]=array("ID"=>	$re['ID'],"ten"=>	$re['tenpt'],"mahang"=>	$re['mahang'],"dongia"=>$re['DonGia'],"SoLuong"=>	$re['SoLuong'],"size"=>	$re['size'],"mau"=>	$re['mau'],"IDchnhan"=>	$re['IDchnhan']);
		}	
				    
	   return $mangtam;
}

function getchhuydudon($idphieu){
	global $data ;
	$sql="select IDcuahang  from passdoncuahanghuy where IDpassdon='$idphieu'";
		$query=$data->query($sql);
		$mangtam=[];
		while($re=$data->fetch_array($query)){
			array_push($mangtam,$re["IDcuahang"]);
		}
	return $mangtam;
}	
function laycuahangdudon($idsp,$soluong){
global $data ;
	$sql="select IDcuahang from hanghoacuahang where IDSP='$idsp' and SoLuong>='$soluong'";
	//echo $sql;
	$query=$data->query($sql);
		$mangtam=[];
		while($re=$data->fetch_array($query)){
			array_push($mangtam,$re["IDcuahang"]);
		}
	return $mangtam;
}
function checkhuydon($idch,$idpassdon){

	$sql="select DATE_FORMAT(ngayhuy,'%d-%m-%Y %h:%i:%s') as ngayhuydon from passdoncuahanghuy where IDpassdon='$idpassdon' and IDcuahang>='$idch'";
	$dong=getdong($sql);
	return $dong["ngayhuydon"];
}

 $data->closedata() ;
?>	