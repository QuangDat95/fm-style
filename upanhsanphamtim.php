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
		$sql = " SELECT a.ID,a.images,a.Name,a.NameN, a.DV, a.NameEN,a.codepro,a.code,a.price,a.giachan,a.giamgia from products a $sql_where limit 200";
			//echo $sql;
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
		   <td width="106" align="center" ><strong>Hình ảnh</strong></td>
		   <td width="106" align="center" ><strong>Upload ảnh</strong></td>
 		</tr>
<?php
$result = $data->query($sql);  $mau='';
$linkanh='https://image.fmstyle.com.vn/anhchamcong/anhsanpham/';
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

	$images=$re['images']?'<img src="'.$linkanh.$re['images'].'" style="width:80px" onclick="showanhlon(event)"/>':"";
 $gia = formatso($re['price']) ;
 
  if ($gia =='0.00') $gia = "";
 
	 ?>
 	 	<tr title="<?php echo $re['note'] ?>"   style="cursor:pointer" onclick="" onMouseOver="this.className='<?php echo $hl2; ?>'" onMouseOut="this.className='<?php echo $hl; ?>'"  bgcolor="<?php echo $mau; ?>" >
				<td   align="right"> <?php echo $r ;?> </td>				
				<td  ><?php echo $re['Name'] ;?></td>
 				<td ><?php echo $re['codepro'] ;?></td>
			    <td ><?php echo $re['NameN'] ;?></td>
				<td align="right"><?php echo $gia ;?></td>
				<td align="center" id="addimg<?=$re['ID']?>"><?php echo $images ;?></td>
			 <td align="center"><a  class="camera" onclick="getsp('<?=$re['codepro']?>')">
  <span class="shade"></span>
</a></td>
   </tr>
<?php				
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
    $data->closedata() ;
?>	