<?php 
session_start();
$id = $_SESSION["LoginID"] ;

 if ($id =="") return ;
 $idch = $_SESSION["se_kho"] ;
 
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
if(isset($_POST['DATA'])){
  $data1 = $_POST['DATA']; 
  $tmp = explode('*@!',$data1);
        $NameTK   = ($tmp[0])   ;
        $codeprotk  = trim($tmp[1])  ;
		$code = trim($tmp[2]) ;
		$IDGrouptk = laso($tmp[3]) ;
		$trang = laso($tmp[4]) ;
		$kho= laso($tmp[5]) ;
		$mota= chonghack($tmp[6]) ;
        $ngaytao=gmdate('Y-m-d H:i', time() + 7*3600) ;
		//$sql_where=" where a.congtho = '0' ";
	    $sql_where=' where 1=1 ';
		if($NameTK!="")
			$sql_where.=" and a.Name like '%".$NameTK."%'";
		if($codeprotk!="")
			$sql_where.=" and a.codepro like '%".$codeprotk."%'";
	    if($mota!="")
			$sql_where.=" and a.NameN like '%".$mota."%'";	
		if(  $IDGrouptk>0)
		{
		    $nhom = $IDGrouptk.timnhom("groupproduct","IDGroup",$IDGrouptk);
			 
 			$sql_where.=" and a.IDGroup = $nhom  ";
 		}
		if($kho!="" and $kho > 0 )
			//$sql_where.=" and (c.IDKho ='".$kho."' or c.IDKho is null ) ";			
			$khotv = "sum( case   when c.IDkho = $kho   then  b.SoLuong   else   0    end) as sl ," ;
		 else
		 	$khotv = "sum( b.SoLuong) as sl ," ;
	
		if($code!="" )
			$sql_where.=" and a.code like '%".$code."%'";
				$r =1 ;	 
 		
		
		// $manggiarieng =taomang() ;
		
	//	$sql = "SELECT * FROM products  ".$sql_where." ORDER BY NgayTao desc  ";
		$sql = " SELECT a.ID,a.Name,a.images,a.NameN, a.DV, a.NameEN,a.codepro,a.code,a.price,a.giachan,a.giamgia from products a $sql_where limit 200 ";
			//echo $sql;
			//and code ='J000002' 
//		$query_rows = $data->query($sql);
//		$result_rows = $data->num_rows($query_rows);
//		$result = $data->query($sql);
    
 	//========================================================
	//echo $sql;
	 if ($_SESSION["admintuan"])  {echo $sql;  }
     
   $r=0; $num=0;
	//==============================================================	
 if ( $num != 0 ) { ?>
 <div style="padding-bottom:5px"><b style="color:#0000FF;padding-bottom:5px" > Click chuột để chọn hàng hóa  </b></div>
  <?php
 }
   
?>
<div style="overflow:auto ;height:375px;">
<style>
.camera:focus{
	    transform: scale(0.9);
}
.camera:active{
	    transform: scale(0.9);
}		
.camera {
    position: relative;
    background: white;

    display: block;
    height: 25px;
    width: 25px;

    margin: 0px auto;

    border-radius: 5px;
    overflow: hidden;
    box-shadow: 0 1px 0 0 #aec6c7;
  }

  .camera:before {
    content: " ";

    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;

    border-radius: 50%;
    border: solid 1px #f8f8f8;
    background: #44545e;
    box-shadow: inset 0 0 2px 3px #a6daed,
                inset 0 0 0 1px #aee3f7,
                inset 0 0 0 2px #90dcf9,
                inset 0 0 1px 3px #5c7683,
                inset 0 0 0 4px #6992a4,
                inset 0 0 0 8px #5d7784,
                0 5px 4px 0 #e9e9e9;

    overflow: hidden;
    z-index: 1;
  }

  .camera .shade {
    position: absolute;
    top: 0;
    left: 0;

    width: 0;
    height: 0;
    font-size: 0;

    opacity: .2;
    border-style: solid;
    border-width: 3px 0 0 3px;
    border-color: transparent transparent transparent #f7f8f8;
    z-index: 10;

    box-shadow: 3px 3px 3px black;
  }

  .camera:after {
    content: " ";
    position: absolute;

    right: 3px;
    bottom: 3px;

    height: 5px;
    width: 5px;

    border-radius: 50%;
    background: #d55865;
    box-shadow: inset 0 0 3px 0 #d24a58,
                -3px -2px 0 -1px #697a87,
                -3px -2px 0 -1px #8a92a3;
    z-index: 20;
  }
  
  
</style>
  <table width="98%" border="0" cellpadding="0" cellspacing="0" class="tbchuan">		
 		<tr bgcolor="#F8E4CB">
		  <td align="center" height="23" width="35"><b>STT</b></td>
		  <td width="690" align="center" ><strong>Tên Hàng Hóa </strong></td>  
 		  <td width="182" align="center" ><strong>Mã HH </strong> </td> 
 		  <td width="182" align="center" ><strong>Mô tả</strong> </td> 
 		  <td width="106" align="center" ><strong><strong>Giá </strong> Bán </strong></td>
		    <td width="106" align="center" ><strong>Điểm chất liệu</strong></td>
		   <td width="106" align="center" ><strong>Điểm màu sắc</strong></td>
		   <td width="106" align="center" ><strong>Hình ảnh</strong></td>
		   <td width="106" align="center" ><strong>Đánh giá</strong></td>
 		</tr>
<?php
$cha='';
$count=0;
$result = $data->query($sql);  $mau='';
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
$diemg1=laydiem($re['codepro']);

$diemgoc=laydiemgoc($re['code']);
	$images=$re['images']?'<img src="images/products/'.$re['images'].'" style="width:30px"/>':"";
 $gia = formatso($re['price']) ;
 
  if ($gia =='0.00') $gia = "";
 	if($cha!=$re['code']){
						?>
						<tr title="<?php echo $re['note'] ?>"  onclick="getspgoc('<?=$re['code']?>')"  style="cursor:pointer"  onMouseOver="this.className='<?php echo $hl2; ?>'" onMouseOut="this.className='<?php echo $hl; ?>'"  bgcolor="<?php echo $mau; ?>" >
						<td   align="right"></td>
							
							
							<td colspan="4" style="color:#00CC00;font-weight:bold"><?=$re['code']?></td>
								<td align="right"><?php echo $diemgoc['tongdiemchatlieu'] ;?></td>
				<td align="right"><?php echo $diemgoc['tongdiemmau'] ;?></td>
				<td align="right"><?php echo $images ;?></td>
					<td   align="center"><a onclick="getspgoc('<?=$re['code']?>')">
  Đánh giá
</a></td>
							</tr>
						<tr title="<?php echo $re['note'] ?>"  onclick="getsp('<?=$re['codepro']?>')"  style="cursor:pointer"  onMouseOver="this.className='<?php echo $hl2; ?>'" onMouseOut="this.className='<?php echo $hl; ?>'"  bgcolor="<?php echo $mau; ?>" >
							<td   align="right"> <?php echo $r ;?> </td>				
							 <td ><?php echo '--------------+'.$re['Name'] ;?></td>
							<td ><?php echo $re['codepro'] ;?></td>
							<td ><?php echo $re['NameN'] ;?></td>
							<td align="right"><?php echo $gia ;?></td>
							<td align="right"><?php echo $diemg1['tongdiemchatlieu'] ;?></td>
				<td align="right"><?php echo $diemg1['tongdiemmau'] ;?></td>
							<td align="right"><?php echo $images ;?></td>
						 <td align="center"><a onclick="getsp('<?=$re['codepro']?>')">
			  Đánh giá
			</a></td>
			   </tr>
						<?php	
						
				 		
						$cha=$re['code'];
						
					}
					else{
					
						
						?>
					
	
 	 	<tr title="<?php echo $re['note'] ?>"  onclick="getsp('<?=$re['codepro']?>')"  style="cursor:pointer"  onMouseOver="this.className='<?php echo $hl2; ?>'" onMouseOut="this.className='<?php echo $hl; ?>'"  bgcolor="<?php echo $mau; ?>" >
				<td   align="right"> <?php echo $r ;?> </td>				
				 <td ><?php echo '--------------+'.$re['Name'] ;?></td>
 				<td ><?php echo $re['codepro'] ;?></td>
			    <td ><?php echo $re['NameN'] ;?></td>
				<td align="right"><?php echo $gia ;?></td>
				<td align="right"><?php echo $diemg1['tongdiemchatlieu'] ;?></td>
				<td align="right"><?php echo $diemg1['tongdiemmau'] ;?></td>
				<td align="right"><?php echo $images ;?></td>
			 <td align="center"><a onclick="getsp('<?=$re['codepro']?>')">
  Đánh giá
</a></td>
   </tr>
   
<?php
		}
								
	$r++;
	}
?>	
</table>
</div>
 <div style="padding:5px;" >
 <?php 
    if ( $num != 0 ) {
 ?>
  C&#243; <?php echo  $num ; ?>  hàng hóa tìm thấy !    <?php if ($num > $pagesize ) echo "Trang : ". $pt ; ?>  
  <?php 
  } else
  {
   
  }
 
 ?>
  <br />
<br />
<br />
<br />

</div>


<?php	
	
}	

if(isset($_POST['DATATONGDIEM'])){
  $data1 = $_POST['DATATONGDIEM']; 
  $tmp = explode('*@!',$data1);
        $NameTK   = ($tmp[0])   ;
        $codeprotk  = trim($tmp[1])  ;
		$code = trim($tmp[2]) ;
		$IDGrouptk = laso($tmp[3]) ;
		$trang = laso($tmp[4]) ;
		$kho= laso($tmp[5]) ;
		$mota= chonghack($tmp[6]) ;
        $ngaytao=gmdate('Y-m-d H:i', time() + 7*3600) ;
		//$sql_where=" where a.congtho = '0' ";
	    $sql_where=' where 1=1 ';
		if($NameTK!="")
			$sql_where.=" and a.Name like '%".$NameTK."%'";
		if($codeprotk!="")
			$sql_where.=" and a.codepro like '%".$codeprotk."%'";
	    if($mota!="")
			$sql_where.=" and a.NameN like '%".$mota."%'";	
		if(  $IDGrouptk>0)
		{
		    $nhom = $IDGrouptk.timnhom("groupproduct","IDGroup",$IDGrouptk);
			 
 			$sql_where.=" and a.IDGroup = $nhom  ";
 		}
		if($kho!="" and $kho > 0 )
			//$sql_where.=" and (c.IDKho ='".$kho."' or c.IDKho is null ) ";			
			$khotv = "sum( case   when c.IDkho = $kho   then  b.SoLuong   else   0    end) as sl ," ;
		 else
		 	$khotv = "sum( b.SoLuong) as sl ," ;
	
		if($code!="" )
			$sql_where.=" and a.code like '%".$code."%'";
				$r =1 ;	 
 		
		
		// $manggiarieng =taomang() ;
		$sql="select sum(chatlieu) as tongdiemchatlieu,sum(mausac) as tongdiemmausac,sum(chatlieu+mausac) as tongdiem ,code from danhgiasanpham  where  code is not null and (IDSP is null or IDSP =0) group by code ";
	//echo $sql;
	//	$sql = "SELECT * FROM products  ".$sql_where." ORDER BY NgayTao desc  ";
		
			//and code ='J000002' 
//		$query_rows = $data->query($sql);
//		$result_rows = $data->num_rows($query_rows);
//		$result = $data->query($sql);
    
 	//========================================================
	//echo $sql;
	 if ($_SESSION["admintuan"])  {echo $sql;  }
     
   $r=0; $num=0;
	//==============================================================	
 if ( $num != 0 ) { ?>
 <div style="padding-bottom:5px"><b style="color:#0000FF;padding-bottom:5px" > Click chuột để chọn hàng hóa  </b></div>
  <?php
 }
   
?>
<div style="overflow:auto ;height:375px;">
<style>
.camera:focus{
	    transform: scale(0.9);
}
.camera:active{
	    transform: scale(0.9);
}		
.camera {
    position: relative;
    background: white;

    display: block;
    height: 25px;
    width: 25px;

    margin: 0px auto;

    border-radius: 5px;
    overflow: hidden;
    box-shadow: 0 1px 0 0 #aec6c7;
  }

  .camera:before {
    content: " ";

    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;

    border-radius: 50%;
    border: solid 1px #f8f8f8;
    background: #44545e;
    box-shadow: inset 0 0 2px 3px #a6daed,
                inset 0 0 0 1px #aee3f7,
                inset 0 0 0 2px #90dcf9,
                inset 0 0 1px 3px #5c7683,
                inset 0 0 0 4px #6992a4,
                inset 0 0 0 8px #5d7784,
                0 5px 4px 0 #e9e9e9;

    overflow: hidden;
    z-index: 1;
  }

  .camera .shade {
    position: absolute;
    top: 0;
    left: 0;

    width: 0;
    height: 0;
    font-size: 0;

    opacity: .2;
    border-style: solid;
    border-width: 3px 0 0 3px;
    border-color: transparent transparent transparent #f7f8f8;
    z-index: 10;

    box-shadow: 3px 3px 3px black;
  }

  .camera:after {
    content: " ";
    position: absolute;

    right: 3px;
    bottom: 3px;

    height: 5px;
    width: 5px;

    border-radius: 50%;
    background: #d55865;
    box-shadow: inset 0 0 3px 0 #d24a58,
                -3px -2px 0 -1px #697a87,
                -3px -2px 0 -1px #8a92a3;
    z-index: 20;
  }
  
  
</style>
  <table width="98%" border="0" cellpadding="0" cellspacing="0" class="tbchuan">		
 		<tr bgcolor="#F8E4CB">
		  <td align="center" height="23" width="35"><b>STT</b></td>
		  <td width="690" align="center" ><strong>Tên Hàng Hóa </strong></td>  
 		  <td width="182" align="center" ><strong>Mã HH </strong> </td> 
 		  <td width="182" align="center" ><strong>Mô tả</strong> </td> 
 		  <td width="106" align="center" ><strong>Điểm màu sắc</strong></td>
		   <td width="106" align="center" ><strong>Điểm chất liệu</strong></td>
		   <td width="106" align="center" ><strong>Tổng điểm</strong></td>
 		</tr>
<?php
$cha='';
$count=0;
$result = $data->query($sql);  $mau='';
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
//echo $re['code'];
	
 
  if ($gia =='0.00') $gia = "";
 	
						?>
						<tr title=""  style="cursor:pointer"  onMouseOver="this.className='<?php echo $hl2; ?>'" onMouseOut="this.className='<?php echo $hl; ?>'"  bgcolor="<?php echo $mau; ?>" >
						<td   align="right"><?php echo $r ;?></td>
							<td  colspan="3" align="left" style="color:green;font-weight:bold"><?=$re['code']?></td><td align="right"><?php echo $re['tongdiemchatlieu'];?></td>
							<td align="right"><?php  echo $re['tongdiemmausac'] ;?></td>
							<td   align="center"><?=$re['tongdiem']?></td>
					</tr>

	<?php
	
			$sql1 = "SELECT a.ID,a.Name,a.NameN, a.DV, a.NameEN,a.codepro,a.code,a.price,a.giachan,a.giamgia,sum(b.chatlieu) as diemchatlieu,sum(b.mausac) as diemmausac  from products a inner join danhgiasanpham b on a.codepro=b.codepro where b.code='$re[code]' group by b.codepro ";
			//echo $sql1;
			$result1 = $data->query($sql1);  $mau='';
		while($re1 = $data->fetch_array($result1))
			{
			$r++;
			$images=$re1['images']?"images/products/".$re1['images']:"";
 $gia = formatso($re1['price']) ;
	?>
				
						<tr title="<?php echo $re1['note'] ?>"   style="cursor:pointer"  onMouseOver="this.className='<?php echo $hl2; ?>'" onMouseOut="this.className='<?php echo $hl; ?>'"  bgcolor="<?php echo $mau; ?>" >
							<td   align="right"> <?php echo $r ;?> </td>				
							 <td ><?php echo '--------------+'.$re1['Name'] ;?></td>
							<td ><?php echo $re1['codepro'] ;?></td>
							<td ><?php echo $re1['NameN'] ;?></td>
							<td align="right"><?php echo $re1['diemchatlieu'];?></td>
							<td align="right"><?php  echo $re1['diemmausac'] ;?></td>
							
						 <td align="center"><?php  echo ($re1['diemmausac']+$re1['diemchatlieu']) ;?></td>
			   </tr>
<?php	}
					
				 		
		$r++;
	}									
	
?>	
</table>
</div>
 <div style="padding:5px;" >
 <?php 
    if ( $num != 0 ) {
 ?>
  C&#243; <?php echo  $num ; ?>  hàng hóa tìm thấy !    <?php if ($num > $pagesize ) echo "Trang : ". $pt ; ?>  
  <?php 
  } else
  {
   
  }
 
 ?>
  <br />
<br />
<br />
<br />

</div>


<?php	
	
}	

function laydiem($c){
		$sql="select sum(chatlieu) as tongdiemchatlieu,sum(mausac) as tongdiemmau from danhgiasanpham where codepro='$c' group by codepro";
		$dong=getdong($sql);
		return $dong;
	}	
	
	function laydiemgoc($c){
		$sql="select sum(chatlieu) as tongdiemchatlieu,sum(mausac) as tongdiemmau from danhgiasanpham where code='$c' and code is not null and (IDSP is null or IDSP =0) group by code ";
		//echo $sql;
		$dong=getdong($sql);
		return $dong;
	}		
    $data->closedata() ;
?>	