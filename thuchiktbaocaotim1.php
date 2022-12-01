<?php   
session_start();
$id = $_SESSION["LoginID"]  ; if ( $id == "") return ;
$root_path =getcwd()."/"  ;


$quyen= $_SESSION["quyen"] ;   
$ql =$quyen[$_SESSION["mangquyenid"]["thuchichbaocao"]]  ;  
//if(!($ql[0]||$ID==1)) {echo "Bạn không có phân quyền"; exit; return ;}  


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

	$mangquyen = $_SESSION['quyen'] ;
	 
//=====================================================================================	


   if ( $_SESSION["sxna"] == "")
   {
	   $_SESSION["sxna"] =0 ;
	   $s1 = 0;$s2 =2 ; $s3 = 4;$s4 =6 ; $s5 = 8; 
   }
    
   if ($_POST['SX'] != "")
  {    $cot = laso($_POST['SX']) ;
  	  switch ($cot)
	  {
		  case "0": $sqlsx  = "  ngaythuchi    ";$s1 = 1;break ;
		  case "1": $sqlsx  = "  ngaythuchi  desc  ";$s1 = 0;break ;
		  case "2": $sqlsx  = "  sochungtu    ";$s2 = 3;break ;
		  case "3": $sqlsx  = "  sochungtu  desc  ";$s2 = 2;break ;
		  case "4": $sqlsx  = "  sotien    ";$s3 = 5;break ;
		  case "5": $sqlsx  = "  sotien  desc  ";$s3 = 4;break ;
		  case "6": $sqlsx  = "  lydo    ";$s4 = 7;break ;
		  case "7": $sqlsx  = "  lydo  desc  ";$s5 = 6;break ;
		  case "8": $sqlsx  = "  idtao    ";$s5 = 8;break ;
		  case "9": $sqlsx  = "  idtao  desc  ";$s5 = 9;break ;		  
 	  }
	   $trang = $_SESSION["trangcun"]  ;
 	   $sql =  $_SESSION["truyvancu"] . " $sqlsx " ;
	    //  echo $sql.'123';
  } else
  {
  $data1 = $_POST['DATA']; 
  $tmp = explode('*@!',$data1);
 		  $tungay = trim($tmp[0]) ;
		  $denngay = trim($tmp[1]) ;
          $loai = trim($tmp[2]) ;
		  $nhom   = laso($tmp[3] )  ; 
		  $taikhoan = laso($tmp[4]) ;
		  $lydo =  chonghack(trim($tmp[5])) ;		  
  		  $trang = laso($tmp[6]) ;
		  $tinhtrang =  ($tmp[7]) ;
		  $soct =  trim($tmp[8]) ;
		  $_SESSION["trangcun"] = $trang ;
		  $sql_where= "" ;
//===========================================================================
 
		 
		

 		if($loai!="")
		   {
			   if ($loai == 5)	{$sql_where=" and  (a.luachon = '1' or a.luachon= '2' ) ";$sql_ton=" and  (a.luachon = '1' or a.luachon= '2')";}
				else if ($loai == 5) {$sql_where=" and  (a.luachon = '3' or a.luachon= '4')";$sql_ton=" and (a.luachon = '3' or a.luachon= '4')";} 
					else {$sql_where=" and  a.luachon = '$loai'  "; $sql_ton=" and  a.luachon = '$loai'  ";}
			}
		if($lydo!="")
			{$sql_where.=" and a.lydo  like '%$lydo"."%'";$sql_ton.=" and a.lydo  like '%$lydo"."%'";}
		if($tinhtrang!="")
			{$sql_where.=" and a.tinhtrang = '$tinhtrang"."'"; $sql_ton.=" and a.tinhtrang = '$tinhtrang"."'";}
			else  	{$sql_where.=" and a.tinhtrang <> '8'"; $sql_ton.=" and a.tinhtrang<> '8'";}
		if($soct!="")
			{$sql_where.=" and a.sochungtu = '$soct"."'";  }
			
		if (!$ql[5] && $_SESSION["loai_user"]!=16 )	
		{ $sql_where.=" and a.loaitk = '$_SESSION[se_kho]' ";	$sql_ton.="  and a.loaitk = '$taikhoan'  "; }
		
		if ( $taikhoan==0 && $_SESSION["loai_user"]==16 ) 
		{ $sql_where.=" and c.idtinh = '$_SESSION[se_kho]' ";	$sql_ton.="  and c.idtinh = '$_SESSION[se_kho]'  ";}
		
		if($taikhoan!=0  && $ql[5])  
			{$sql_where.=" and a.loaitk = '$taikhoan' "; $sql_ton.="  and a.loaitk = '$taikhoan'  ";}
		 if($taikhoan!=0  && $_SESSION["loai_user"]==16)  
			{$sql_where.=" and a.loaitk = '$taikhoan' "; $sql_ton.="  and a.loaitk = '$taikhoan'  ";}
 		 		
		if($nhom!=0){
			$CacIDPhong ="";
			//TimIDPhong($nhom,0,0) ;
			  $nhom = $nhom.timnhom("nhomthuchi","IDGroup",$nhom);
			// echo $CacIDPhong ;	
			$sql_where .=" and  a.IDCha in ( $nhom )";
			$sql_ton .=" and  a.IDCha in ( $nhom )";
		}
		
		if($tungay!="")	
		{
		  $ngay=  explode('/',$tungay);
	   	  if (strlen($ngay[1])== 1) {  $ngay[1] = "0".$ngay[1] ;  }
		  if (strlen($ngay[0])== 1) {  $ngay[0] = "0".$ngay[0] ;  }    		
		  
		  $sql_where .= " and  a.ngaythuchi >= '$ngay[2]-$ngay[1]-$ngay[0]'";
		  $sql_ton .= " and  a.ngaythuchi < '$ngay[2]-$ngay[1]-$ngay[0]'";
 		}else  { $sql_ton .= " and  a.ngaythuchi < '1001-01-01'";}
		
		if($denngay!="")	
		{
		  $ngay=  explode('/',$denngay);
	   	  if (strlen($ngay[1])== 1) {  $ngay[1] = "0".$ngay[1] ;  }
		  if (strlen($ngay[0])== 1) {  $ngay[0] = "0".$ngay[0] ;  }    		
		  $sql_where .= " and  a.ngaythuchi <= '$ngay[2]-$ngay[1]-$ngay[0]'";
		}	
		 
		/*$sql = "SELECT a.*,b.Ten,DATE_FORMAT(a.ngaythuchi,'%d/%m/%Y') as ngay,DATE_FORMAT(a.ngaykhoa,'%d/%m/%Y') as ngaykhoa FROM thuchikt a left join userac b on a.IDtao = b.ID left join cuahang c on a.loaitk=c.id where 1=1 ".$sql_where." ORDER BY a.ngaytao desc  ";*/
		$sql = "SELECT a.*,DATE_FORMAT(a.ngaythuchi,'%d/%m/%Y') as ngay,DATE_FORMAT(a.ngaykhoa,'%d/%m/%Y') as ngaykhoa FROM thuchikt a where  1=1  ".$sql_where." ORDER BY a.ngaytao desc  ";
		//echo $sql ;
		$_SESSION["truyvancu"] =$sql ;
	 
 } // het sap xep	
  
 
if($_SESSION["admintuan"])  echo $sql  ;
  // return ;
	$result = $data->query($sql); 
	 $tongthu = 0 ; 
	  $tongchi= 0 ;
	while($re = $data->fetch_array($result))
	{
	  if ($re['luachon'] == 1 &&  $re['tinhtrang']==1 ) // cac khoan thu
	  {
		  $tongthu =  $tongthu + $re['sotien'];
	   }
	  if ($re['luachon'] == 2 &&  $re['tinhtrang']==1) // cac khoan chi
	   {
		  $tongchi =  $tongchi + $re['sotien'];
	   } 
	}
	$mangcuahang= taomang("cuahang","ID","macuahang",'') ;
	//==== tinh ton đau ky=======================================================
	$sql2 = "SELECT  sum(case when  a.luachon = 1 then a.sotien else -(a.sotien) end )as tong,DATE_FORMAT(a.ngaykhoa,'%d/%m/%Y') as ngaykhoa FROM thuhikt a left join userac b on a.IDtao = b.ID  left join cuahang c on a.loaitk=c.id 
	where a.tinhtrang=1 ".$sql_ton." ORDER BY a.ngaytao desc  ";
	 $_SESSION["truyvancu2"] = $sql2 ;
	//echo $sql2 ;
	 if ($_SESSION["admintuan"])	echo "<br>".$sql2 ;
   
	$result = $data->query($sql2); 
  	 $re = $data->fetch_array($result)  ;
 	  $tongton = $re['tong'] ;  
 
 	//========================================================
 	
  if (!is_numeric($trang) ) $trang = 1 ;
   		if ($trang * 1  <= 0 ) $trang = 1 ;	
	 $result = $data->query($sql); 
	 $num=$data->num_rows($result);	
	 $pagesize = 9000; 
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
				 else {$pt = $pt." &nbsp;"."<a style='cursor:pointer' onclick=\"timsanpham('$tmp[0]','$tmp[1]','$tmp[2]','$tmp[3]','$tmp[4]','$i')\"  > $i </a> " ;  } 		  
			}
			
		  }
	  }
	 
	 $r = $pagesize * $trang - $pagesize + 1  ; 
	//==============================================================	

 if ( $num != 0 ) { ?>
 <div style="padding-bottom:5px;color:#F60">Chữ màu đỏ các khoản chi, chữ màu xanh các khoản thu </div>
  <?php
 } else
 echo "<font size=2  color='#FF3300'>Không tìm thấy phiếu nhập nào, bạn có thể tìm lại theo từ ngắn hơn hoặc từ khác !!!</font> " ;

?>
<div   style="display:auto;overflow:scroll;width:1050px;height:385px"  >

 <table width="99%" border="0" cellpadding="0" cellspacing="0" class="tbchuan">		
				    <tr bgcolor="#F8E4CB">
				      <td align="center" height="23" width="29"><b>STT</b></td>
				      <td width="84" align="center" title="Ngày chứng từ"><strong onclick="sapxep('<?php echo $s1 ;?>')" style="cursor:pointer">Ngày CT</strong></td>  
				      <td width="88" align="center"><strong onclick="sapxep('<?php echo $s2 ;?>')" style="cursor:pointer">Số chứng từ</strong> </td> 	     <td width="88" align="center"   style="cursor:pointer">Mã CH</td> 
 				      <td width="88" align="center"><strong onclick="sapxep('<?php echo $s3 ;?>')" style="cursor:pointer">Số tiền</strong></td> 
				      <td width="314px" align="center"><strong onclick="sapxep('<?php echo $s4 ;?>')" style="cursor:pointer">Lý do</strong></td>
				      <td width="137" align="center"><strong onclick="sapxep('<?php echo $s5 ;?>')" style="cursor:pointer">Người lập phiếu</strong> </td>	    	 
     <?php if($ql[2]||$ID==1) { ?><td width="137" align="center"><strong>Tình trạng</strong></td><?php } ;?>	    
      	    
      <?php if($_SESSION["admintuan"]){ ?><td width="137" align="center"><strong>hủy</strong></td><?php } ;?>		 
    </tr>
		  <?php
		  
 while($re = $data->fetch_array($result))
	{
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
  
   if ($re['lydoN'] == '1') // táian
  { $mauchu ="c0f" ;  } 
   
  
  if ($re['tinhtrang']!= 1)
  {
	   $tinhtrang = "<b style=\"cursor:pointer\" onclick=\"goikhoach('$re[ID]')\" >Chưa khóa</b>" ;
  } else 
  {
	   $tinhtrang = "Đã khóa  $re[ngaykhoa]" ;
  }
  
  
  ?>
 	 	<tr title="<?php echo addslashes($re['note']) ?>"  style="color:#<?php echo $mauchu; ?>"       bgcolor="<?php echo $mau ?>" >
				<td align="center"><?php echo $r ; ?></td>				
				<td><?php echo $re['ngay'] ;?></td>
				<td><?php echo $re['sochungtu'] ;?></td>
				<td><?php echo $mangcuahang[$re['loaitk']] ;?></td>
                <td><?php echo $sotien ;?></td>
				<td><?php echo $re['lydo'] ;?></td>
 				<td align="left"> <?php echo $re['Ten'] ;?></td>
             <?php  if($ql[2]||$ID==1)   { ?>
		        <td  align="center" >&nbsp;<?php echo $tinhtrang ;?></td>
			<?php	}  ?>	 	 
              <?php if($_SESSION["admintuan"]){?><td align="center"><b style="cursor:pointer" onclick="huythuchi(<?php echo $re['ID'] ;?>)">Hủy</b></td><?php } ;?>		 
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
		$conlai = $tongthu - $tongchi ;
		
 ?>
 <div align="left">

   <div style="float:left"> Tìm thấy  <?php echo  $num ; ?>  phiếu ! &nbsp;   <?php if ($num > $pagesize ) echo "Trang : ". $pt ; ?>  </div>
 
   
    
  <br />

   <table width="100%" cellpadding="1" cellspacing="1" border="0">
    <tr><td  ><strong>Tồn đầu kỳ </strong> </td>
 <td>: <?php echo  formatso($tongton) ?></td><td><strong><?php echo  " ( ". doiso($tongton) ." ) " ;  ?></strong> 
</td>
 </tr>
 <tr>
  <td width="92"  >   
  <b>  Tổng thu </b> </td>
  <td width="118">: <?php echo  formatso($tongthu) ?></td><td width="998">
    <strong><?php echo  " ( ". doiso($tongthu) ." ) " ;  ?></strong></td>
  </tr>
  <tr><td  ><b> Tổng chi</b> </td><td>: 
    <?php echo  formatso($tongchi) ?> </td><td> <strong><?php echo  "( ". doiso($tongchi) ." ) " ;  ?></strong> 
   </td>
  </tr>
  

<tr><td  > 
  <strong>Còn Lại</strong></td>
<td>:   
  <?php echo  formatso($conlai+$tongton) ?></td><td> <strong><?php echo  "( ". doiso($conlai+$tongton) ." )" ;  ?> </strong>
    
</td></tr>  
</table>    
  <?php 
  
  }  
  
  //==============================================================	
 ?> 


<?php				
    $data->closedata() ;
?>	