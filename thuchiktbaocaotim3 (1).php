<?php  
session_start();
 
 
 
 $root_path =getcwd()."/"  ;
 $quyen= $_SESSION["quyen"] ; 

 $ql =$quyen[$_SESSION["mangquyenid"]["thuchiktbaocao"]]  ;  
  $idl=$_SESSION["LoginID"];
 //var_dump($_SESSION["mangquyenid"]['baocaokhuyenmai']);
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
		$tu= trim($tmp[2]);
		$den= trim($tmp[3]);
		$tinhtrang= laso($tmp[4]);
		$ten= chonghack($tmp[5]);
		$loai= laso($tmp[6]);
		$sotien= laso($tmp[7]);
		$soct= trim($tmp[8]);
		 
		  if ($trang!=0  ) $limit  =  " LIMIT ". 10000*($trang-1) .", ". 10000*($trang); else $limit =" limit 10000";
		$sql_where="  WHERE 1    "; 
		$sql_where2 = "" ;
		$sql_where3 = "" ;
		
		
		if($manv != ""){ $sql_where.=" and c.manv = '$manv'"; }
		if($ten != ""){ $sql_where.=" and c.ten = '$ten'"; }
		if($sotien >0 ){ $sql_where.=" and a.sotien = '$sotien'"; }
		if($soct !='' ){ $sql_where.=" and a.soct like '$soct%'"; }
		if($kho != "")
		{
   			$sql_where.=" and a.loaitk =  '$kho' ";
 		}else if($_SESSION["loai_user"]==16)
		{
			$sql_where.=" and c.idtinh =  '$kho' ";
		}
		
		
		
       if($tinhtrang != ""){
			 if($tinhtrang == 0){   		} 
 			 else if($tinhtrang ==2){ $sql_where.= " and (left(a.tinhtrang,1)=2 or left(a.tinhtrang,1)=1) "; }
			 else if($tinhtrang ==3){ $sql_where.= " and  left(a.tinhtrang,1)=3 or right(a.tinhtrang,1)=3 "; }
			 else if($tinhtrang ==4){ $sql_where.= " and  right(a.tinhtrang,1)=4 "; }
			 else if($tinhtrang ==1){ $sql_where.= " and  left(a.tinhtrang,1)=4 and right(a.tinhtrang,1)<2 "; } // quan ly duyet
			 
		}
		
		
		
	 if($tu!="")	
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
		}	
 
   
		// $mangcuahang= taomang("cuahang","ID","macuahang",'') ;
	 
		$sql = "SELECT a.ID as idthuchikt,a.luachon as loaithuchi,DATE_FORMAT(a.ngaytao,'%d/%m/%Y') as ngaytao,DATE_FORMAT(a.ngaythuchi,'%d/%m/%Y %H:%i') as ngaythuchikt,DATE_FORMAT(a.ngayduyet,'%d/%m/%Y %H:%i') as ngayduyetthuchi,a.psco,a.psno,a.donvi,a.soluong,a.dongia,a.hdbh,a.sotknh,a.tentknh,a.NCC,a.manv,a.phieuxuat,a.sophieupm,a.chungtu,a.mavandon,a.tinhtrang,a.lydoN,d.xacnhan as nguoixn,b.macuahang as tencuahang,d.ma as madkhoan,d.ten as khoanmuctc,a.note as diengiai  FROM thuchikt a left join cuahang b on a.loaitk=b.id  left join userac c on a.IDtao = c.ID  left join dinhkhoanthuchi d on d.ID = a.IDcha  ".$sql_where." order by  a.ngaythuchi desc ";
// echo $sql;
 if($_SESSION['admintuan'] ) echo $sql ;
	//	$query_rows = $data->query($sql);
		//$result_rows = $data->num_rows($query_rows);
		$result = $data->query($sql);
		
		
		//$i = $page_start; 
//		$mangnhanvien =taomang("userac","ID","ten"," where tinhluong = '1'  ") ;
	

  if ($_SESSION["admintuan"])	echo  $sql ;
	 
 // echo  "Chờ tí nhé. đang chỉnh lại báo cáo tỉ lệ";  return ;
     
	 
	//==============================================================	
	//$mangnhanvien =taomang("userac","ID","ten"," where tinhluong = '1'  ") ;
?>
   <style>
   
   .fixed-bottom{
	 position: -webkit-sticky;
	  position: sticky;
	  bottom:0;
	}
	 .fixed-top{
	 position: -webkit-sticky;
	  position: sticky;
	  top:0;
	}
	.fixed-left{
	/* position: -webkit-sticky;
	  position: sticky;
	  z-index:1;
	  width:200px;*/
	}
	.td-fixed {
  left: 0px;
 
  z-index: 1;
  height: 25px;
}
   .fixed-top1 {	 position: -webkit-sticky;
	  position: sticky;
	  top:0;
}
.tbchuan td{
	height:100px;
	overflow:hidden;
	font-size:9px;
	white-space:wrap;
}
   </style>	
    <div style="padding-bottom:5px;text-align:center"><span style="color:red"> Chữ màu đỏ các khoản chi,</span><span style="color:blue"> chữ màu xanh các khoản thu</span> </div>
<div style="display:block;overflow:scroll;width:100%;height:400px;    display: flex;
    flex-direction: row;"  >
 
  <!--<div class="table_left" style="width:30%;position: -webkit-sticky;
	  position: sticky;left:0;z-index:1;">
  -->
  <table  border="0" cellpadding="0" cellspacing="0" class="tbchuan" id="dopcccc" style="width:100%">
    <tr align="center" bgcolor="#F8E4CB" class="fixed-top1">
      <td  width="26"  height="23" valign="middle" >
	  <strong>STT</strong></td> 
	  
      <td width="37" valign="middle"  ><strong>Ngày Thu Chi </strong></td>
      <td width="38" valign="middle" ><strong>Cửa Hàng</strong></td>
        <!-- <td width="79" valign="middle" ><strong>THU/</strong><strong>CHI</strong>
        </td>
   <td width="38" valign="middle" ><strong>Mã</strong></td>-->
      <td width="67" valign="middle" ><strong>Khoản mục thu/chi</strong></td>
      <td width="58" valign="middle" ><strong> Diễn giải</strong></td>
      <td width="35" valign="middle" ><strong>PS Nợ</strong></td>
      <td width="30" valign="middle"  ><strong>ĐVT</strong></td>
      <td width="33" valign="middle"  ><strong>Số lượng</strong></td>
      <td width="29" valign="middle"  ><strong>Đơn giá</strong></td>
      <td width="119" valign="middle"  ><strong>PS Có</strong></td>
	  <td align="center" ><strong>HĐBH</strong></td>
     <td  align="center"  ><strong>STK NH</strong></td>
      <td  align="center"  ><strong>Tên TK NH</strong></td>
      <td  align="center"  ><strong>GHTK/ Viettel/ bưu điện</strong></td>
      <td  align="center"  ><strong>Shopee</strong></td>
      <td align="center"  ><strong>Lazada</strong></td>
      <td  align="center"  ><strong>Tiki</strong></td>
      <td align="center"  ><strong>NCC</strong></td>
      <td  align="center"  ><strong>Họ và tên NV</strong></td>
      <td  align="center"  ><strong>Mã NV</strong></td>
      <td  align="center"  ><strong>Phiếu xuất</strong></td>
      <td  align="center" ><strong>Tình Trạng</strong></td>
      <td  align="center"  ><strong>Thủ Quỹ XN</strong></td>
      <td  align="center"  ><strong>Kế Toán Online XN</strong></td>
      <td  align="center"  ><strong>Kế Toán Của Hàng XN </strong></td>
    </tr>
    <?php
 //	$mangch = taomang ("cuahang","ID","macuahang");
	 $result = $data->query($sql); 
$tong=0;$tongsl=0; $r =0 ; $ngaytao = gmdate('Y-n-d H:i:s', time() + 7*3600) ;

  $cuahangtruong= 1; $giamsat= 2; $ketoan= 3;  // 4 là 12   5 là 13   6  là 23  7 là 123 
   //$mangchucvu =taomang("kh_chucvu","ID","Name"," where 1  ") ;
  $tongtien =0;
  $chuoihtml='';
  $ngaynhap = gmdate('Y-n-d', time() + 7*3600) ; $mangtangca= array();  
  while($re = $data->fetch_array($result))
	{    $r++ ;
	$lydoN='';
 	     $mangtangca[$re['MaNV']]=1;
 		 if($mau=="white"){$mau="#EEEEEE";$hl="Normal4";$hl2="Highlight4";}else{$mau="white";$hl="Normal5";$hl2="Highlight5";} 
 	 		    $thuquy0='';$thuquy1='';$thuquy2='';$thuquy3='';$thuquy4='';
				$ketoanOnL0='';$ketoanOnL1='';$ketoanOnL2='';$ketoanOnL3='';$ketoanOnL4='';
				$ketoanCH0='';$ketoanCH1='';$ketoanCH2='';$ketoanCH3='';$ketoanCH4='';
				$tinhtrang=$re["tinhtrang"];
				$tinhtrangduyet="Chưa duyệt" ;
				$select1='';
				 $select4='';
				 $select3='';
				if($tinhtrang==4) {
					$tinhtrangduyet="Đã duyệt"; 
					$select4="selected='selected'";
				}  
				elseif ($tinhtrang==1)  {
					$tinhtrangduyet="Chưa duyệt";
					 $select1="selected='selected'";
				 }  
				 elseif ($tinhtrang==3)  {
				$tinhtrangduyet="Không duyệt";
				 $select3="selected='selected'";
				 }  
				
		
				
				/*$tam= "giamsat$giamsat='selected'; "; eval('$'.$tam);
 				$tam= "ketoan$ketoan='selected'; ";eval('$'.$tam);*/
				$sotien=$re['sotien'];
				$tongtien += $sotien ;
				
				 if ($re['loaithuchi'] == 2) // cac khoan chi
				  {
					  $mauchu ="red" ;
				  }
				  if ($re['loaithuchi'] == 1) // cac khoan thu
				  { 	   $mauchu ="blue" ;  } 
	$lydoN=$re["lydoN"]; 

	 ?>
    <tr onmouseout="this.className='<?php echo $hl; ?>'"  bgcolor="<?php echo $mau ;?>"  style="color:<?=$mauchu?>">
      <td  align="right" ><?php echo $r ;?></td>
      <td ><?php echo $re['ngaythuchikt'] ;?></td>
      <td ><?php echo $re['tencuahang'] ;?></td>
      <!--"<span style='    height: 100%;
					width: 100px;
					display: block;
					overflow: ;
					white-space: ;'>".."</span>"-->
      <td ><?php echo $re["khoanmuctc"];?></td>
      <td ><?php echo $re["diengiai"];?></td>
      <td ><?php echo $re["psno"]?number_format($re["psno"]):"";?></td>
      <td ><?php echo $re["donvi"];?></td>
      <td ><?php echo $re["soluong"];?></td>
      <td ><?php echo $re["dongia"]?number_format($re["dongia"]):"";?></td>
      <td style="border-right: 1px solid #ff7909 !important;">
	  <?php echo $re["psco"]?number_format($re["psco"]):"";?></td>
	  
	 <td  style="border-left: 1px solid #ff7909 !important; text-align:center"><?=$re["hdbh"]?></br> Thành tiền: <?=checksotienhoadon($re["hdbh"])['thanhtien']?></td>
      <td ><?=$re["sotknh"]?>adwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwww</td>
      <td ><?=$re["tentknh"]?></td>
      <td >
	  <?php
	 if(checkLoaiMaVD($re["mavandon"])==1 || checkLoaiMaVD($re["mavandon"])==2 || checkLoaiMaVD($re["mavandon"])==3 ){ echo $re["mavandon"]; }
	 ?>
	 </td>
      <td ></td>
      <td ></td>
      <td ></td>
      <td><?=$re["NCC"]?></td>
      <td ><?=gettennv('userac',$re["manv"],"Ten")?></td>
      <td ><?=$re["manv"]?></td>
      <td ><?=$re["phieuxuat"]?></td>
      
      <td  align="center" title="'.$re['tinhtrang'].'"   ><b id="tinhtrang_'.$re["idthuchikt"].'" >
        <?=$tinhtrangduyet?>
      </b></td>
      <td valign="top" >
	 <?php  if($re['nguoixn']==1 &&  ($ql[2] || $ql[5])) {  ?>
	  	
        <select name="select" id="<?=$re['idthuchikt']?>"  onchange="goiduyet('.$re["idthuchikt"].',this.value)">
            <option value="1"  <?=$select1?> >Chưa duyệt</option>
            <option value="4"  <?=$select4?> >Duyệt</option>
            <option value="3"  <?=$select3?> >Không duyệt</option>
          </select> <br />
		 <?php
		   if($tinhtrang==3){
		 		echo $re["lydoN"];
		 		}
		 }
		?>
		
     </td>
      <td valign="top">
	  <?php 
	  	if( $re['nguoixn']==2 && ($ql[3] || $ql[5])) {  
	  ?>
          <select id="<?=$re['idthuchikt']?>" name="<?=$re['idthuchikt']?>"  onchange="goiduyet('.$re["idthuchikt"].',this.value)">
            <option value="1" <?=$select1?> > Chưa duyệt</option>
            <option value="4"  <?=$select4?> >Duyệt</option>
            <option value="3"  <?=$select3?> >Không duyệt</option>
          </select>
		
		 
		 <?php
		  if($tinhtrang==3){
				echo $re["lydoN"];
			 }
			}
		 ?>
      </td>
      <td valign="top">
	 <?php  if( $re['nguoixn']==3 && ( $ql[4] || $ql[5])) {   ?>
         <select id="<?=$re['idthuchikt']?>" name="<?=$re['idthuchikt']?>"  onchange="goiduyet('.$re["idthuchikt"].',this.value)">
            <option value="1" <?=$select1?> >Chưa duyệt</option>
            <option value="4"  <?=$select4?> >Duyệt</option>
            <option value="3"  <?=$select3?> >Không duyệt</option>
          </select>
		  
		  <?php
		   if($tinhtrang==3){
		 	$chuoihtml.=$re["lydoN"];
		 }
          } 
		  ?>
    </td>
      
    </tr>
    <?php	 			

	}
?>
  </table>
  <!-- </div>
 <div class="table_right" style="width:auto">
  <table  border="0" cellpadding="0" cellspacing="0" class="tbchuan" id="dopcccc">
  	<tr bgcolor="#F8E4CB" class="fixed-top1">
	<td align="center" style="border-left: 1px solid #ff7909 !important;" ><strong>HĐBH</strong></td>
      <td  align="center"  ><strong>STK NH</strong></td>
      <td  align="center"  ><strong>Tên TK NH</strong></td>
      <td  align="center"  ><strong>GHTK/Viettel/bưu điện</strong></td>
      <td  align="center"  ><strong>Shopee</strong></td>
      <td align="center"  ><strong>Lazada</strong></td>
      <td  align="center"  ><strong>Tiki</strong></td>
      <td align="center"  ><strong>NCC</strong></td>
      <td  align="center"  ><strong>Họ và tên NV</strong></td>
      <td  align="center"  ><strong>Mã NV</strong></td>
      <td  align="center"  ><strong>Phiếu xuất</strong></td>
      <td  align="center" ><strong>Tình Trạng</strong></td>
      <td  align="center"  ><strong>Thủ Quỹ XN</strong></td>
      <td  align="center"  ><strong>Kế Toán Online XN</strong></td>
      <td  align="center"  ><strong>Kế Toán Của Hàng XN </strong></td>
	  </tr>
	
  </table>
  
  </div>-->
</div>
<?php				
    $data->closedata() ;
	
	function gettennv($table,$ID,$cot)
{
   global $data ;
 	$sql = "select ID,$cot from $table where  MaNV='$ID' " ;
		
     $result = $data->query($sql) ;
 	$row = $data->fetch_array($result);	
	// echo  $sql ;			
		return $row[$cot] ;		
}

function checkLoaiMaVD($ma){
	if(is_numeric($ma)){
		return 1;//viettel
	}
	else if(substr($ma,(strlen($ma)-2),2)=='VN'){
		return 2; //Bưu điện
	}
	else if($ma[0]=='S'){
		return 3; //GHTK
	}
}


function checksotienhoadon($soct){
	
$sql="select sum(DonGia) as tongtiendg,Round(sum((DonGia-(DonGia*chietkhau/100)))) as thanhtien 
from xuatbanhang a left join phieunhapxuat b on a.IDphieu=b.ID where b.SoCT='$soct' group by a.IDphieu ";
global $data;
$dong=getdong($sql);
	if($dong['tongtiendg']){
		return $dong;
	}
	else{
		return false;
	}
}
?>
