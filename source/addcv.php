<?php
session_start();
define("IN_SITE", "guest");
 
$root_path = getcwd()."/"  ;
 
include_once($root_path."includes/config.php");
include_once($root_path."includes/removeUnicode.php");
include_once($root_path."includes/class.mysql.php");
include_once($root_path."includes/function.php");
include_once($root_path."includes/function_local.php");

$data = new class_mysql();
$data->config();
$data->access();
  
  
  $data1 = $_POST['DATA']; 
  $data1 =  str_replace("\'", "'", $data1);
  $data1 =  str_replace("\\\\", "\\", $data1);
 
  $tmp = explode('*@!',$data1); 
 	  
  if  (chonghack($_POST['del']) != "")
  {
		  $data2 = chonghack($_POST['del']); 
		  $tmp1 = explode('*@!',$data2); 
		  $tmp[6] = $tmp1[1] ;	
		  $tmp[7] = $tmp1[2] ;		  
  }
    $idnv= $tmp[7] ;
    $ngay=  explode('/',$tmp[6]);
	$ngay1=  explode('/',$tmp[6]);
	 if (strlen($ngay[1])== 1) {  $ngay[1] = "0".$ngay[1] ;  }
	 if (strlen($ngay[0])== 1) {  $ngay[0] = "0".$ngay[0] ;  }
 
 	$sql="select * from congviec where IDNhanVien='$idnv' and NgayLam like '$ngay[2]-$ngay[1]-$ngay[0]'";
	$result = mysql_query($sql) or $this->error("Could not query. ".mysql_error());		
	$result_news = $data->fetch_array($result);
	$query_rows = $data->query($sql);
	$num=$data->num_rows($query_rows);
 	$mangcv = unserialize($result_news["note"]) ;
	$ghichu = $result_news["ghichu"] ;
	$diem = $result_news["diem"] ;
    if ( $num <= 0) { $mangcv ="" ;}
    $danhgia = compo("danhgia","Name","");
  
 
   if  ($mangcv == "" ) 
   { 
    	 $pro = array (1 => array ("tu" =>$tmp[1] ,"toi" =>$tmp[2], "cv" =>$tmp[3],"dg" =>$tmp[4],"note" => $tmp[5] ));
   		$mangcv = $pro ; 
   }   
   else
   { 
		$protam = array () ;
   		$pro = $mangcv ;
		$idcv = 0 ;
		foreach($pro as $key => $value)
		{
			$tam = $key + 0;
			if ( $tam > $idcv) { $idcv = $tam ; }
		}
		$idcv = $idcv + 1;
		foreach($pro as $key => $value)
		{	
	 
		  if ( trim($key) <> $tmp1[0]  ) 
			{  
	     	    $protam[$key] = array ("tu" => $value["tu"]  ,"toi" => $value["toi"], "cv" => $value["cv"] , "dg" => $value["dg"] , "note" => $value["note"]  )  ;	
			}	
			
		}	
		 $mangcv = $protam ;	
		if ( (chonghack($_POST['del']) == "" && trim($tmp[0]) == "") || (trim($tmp[3]) != "")  ) 
		{	
			 if ( $tmp[0] != "") {$idcv = $tmp[0]  ;} 	 
   	  		 $protam[$idcv] = array("tu" => $tmp[1],"toi" => $tmp[2],"cv" => $tmp[3] ,"dg" => $tmp[4] ,"note" => $tmp[5]) ;
			 $mangcv = $protam ;
  		}
         $pro = $mangcv ; 
    
	}
 
 
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<table width="69%" border="1" cellpadding="0" cellspacing="0" style="color:">
  <tr height="17"  bgcolor="#FFCC33" align="center">
    <td height="17" width="27" >STT</td>
    <td width="35">Từ</td>
    <td width="35">Tới</td>
    <td height="17" width="260">Công việc </td>
    <td width="120">Đánh giá</td>
    <td width="160">Ghi chú</td>
    <td width="305">Xóa</td>
  </tr>
  <? 
$stt = 0 ;
$tongcong = 0 ;
$kt = 0 ;
 
foreach($pro as $key => $value)
{
        $kt = 1;
		$stt = $stt +1 ;
	 
		$idcv = $key ;		
		$va1 =$value["tu"] ;						
		$va2 =$value["toi"] ;	
		$va3 =$value["cv"] ;	
		if ($va3 == "") {$va3="&nbsp;" ;}
		 // 		$va3  = str_replace("'", "\'", $va3);
   	//	$va3   = str_replace("\n", '\n',$va3); 
 				
		$va4 = $value["dg"] ;	
 //  		$va4  = str_replace("'", "\'", $va4);
		
		$va5 =$value["note"] ;	
		if ($va5 == "") {$va5="&nbsp;" ;}	 
  // 		$va5  = str_replace("'", "\'", $va5);
//   		$va5   = str_replace("\n", '\n',$va5); 
  	    if($mau == "white")
			{	{		$mau = "#EEEEEE";$hl = "Normal4" ;$hl2 = "Highlight4";	}$hl = "Normal4" ;$hl2 = "Highlight4";	}
		else { 	$mau = "white";	$hl = "Normal5" ;$hl2 = "Highlight5"; }		

   if ($tmp[0] != $idcv || $tmp[3] != "" )
   {
?>
  <tr bgcolor="<? echo $mau ?>" style="padding-left:4px;padding-right:4px" onmouseover="this.className='<?php echo $hl2; ?>'" onmouseout="this.className='<?php echo $hl; ?>'" >
    <td width="27" align="right" ><span style="Font-Weight:Normal;Color:Black;"><? echo $stt; ?>&nbsp;</span></td>
    <td width="35" valign="middle"   >&nbsp;<? echo $va1 ; ?></td>
    <td width="35" valign="middle"   >&nbsp;<? echo $va2 ; ?></td>
    <td width="260" valign="middle" title=" Kích đôi để cập nhập !!! " onclick="editcv('<? echo $idcv ?>','','','','','',frmbaocaocv.ngaybaocao.value,'')"  ><? echo str_replace("\n", "<BR>", $va3); ?></td>
    <td width="120" valign="middle" ondblclick="editcv('<? echo $idcv ?>','','','','','',frmbaocaocv.ngaybaocao.value,'')"  >&nbsp;<? echo tenmuc("danhgia",$va4,"Name") ; ?></td>
    <td width="160" valign="middle"  ondblclick="editcv('<? echo $idcv ?>','','','','','',frmbaocaocv.ngaybaocao.value,'')" ><? echo str_replace("\n", "<BR>", $va5); ?></td>
    <td width="305"  align="center"  ><a style="cursor:pointer" ondblclick="addcv('','','','','','',frmbaocaocv.ngaybaocao.value,'<? echo $idcv ?>')"><img src="images/delete.gif" border = "0" title="Xóa <? echo $stt; ?>" /></a></td>
  </tr>
  <? }
else if ( trim($tmp[3]) == "" )
{
 
?>
  <tr bgcolor="#FFFFFF">
    <td width="27" valign="top" align="right" ><span style="Font-Weight:Normal;Color:Black;">
      <input type="text" name="stt" readonly=""  style="width:20px;border:0px;color:#0000FF;Text-Align:right"   value="<? echo $stt; ?>&nbsp;" />
    </span></td>
    <td width="35"  valign="top"  ><input type="text" name="tu"  onkeyup="kiemtragio(this)" onkeypress="onlyinthc(this)" onblur="kiemtragiora(this)" class="inpl" style="width:35px" maxlength="5" value="<? echo $va1 ; ?>" /></td>
    <td width="35"  valign="top"  ><input type="text" name="toi"  onkeyup="kiemtragio(this)" onkeypress="onlyinthc(this)" onblur="kiemtragiora(this)" class="inpl" style="width:35px" maxlength="5" value="<? echo $va2 ; ?>" /></td>
    <td width="260" valign="middle"    ><textarea name="cv" id="cv" class="inpl"  style="width:245px;height:50px;overflow:auto;"><? echo $va3 ; ?></textarea></td>
    <td width="120"  valign="top" ><select  name="dg"  style="width:125px"  value="<? echo $va4 ; ?>"  />
    	<? echo compo("danhgia","Name",$va4); ?>
    </td>
    <td width="160" valign="middle"   ><textarea name="note" id="note" class="inpl"  style="width:160px;height:50px;overflow:auto;"><? echo $va5 ; ?></textarea></td>
    <td width="305"  align="center" title="Cập nhập" ><input type="button" value="Lưu" name="luu" onclick="savecv('<? echo $idcv ; ?>',tu.value,toi.value,cv.value,dg.value,note.value,frmbaocaocv.ngaybaocao.value,'')" style="width:30px" /></td>
  </tr>
  <? }

}

 if ($tmp[0] == "" || ($tmp[0] != "" &&  $tmp[3] != ""))
{
 ?>

  <tr height="17" bgcolor="#FFFFFF">
    <td height="17" align="right" style="color:#0000FF" valign="top"><input type="text" name="stt" readonly=""  style="width:20px;border:0px;color:#0000FF"   value="" /></td>
    <td align="right" valign="top"><input name="tu"  onkeyup="kiemtragio(this)" onkeypress="onlyinthc(this)" onblur="kiemtragiora(this)" type="text" class="inpl" style="width:35px" maxlength="5" value="" /></td>
    <td align="right" valign="top"><input name="toi"  type="text" onkeyup="kiemtragio(this)" onkeypress="onlyinthc(this)" onblur="kiemtragiora(this)" class="inpl" style="width:35px" maxlength="5" value="" /></td>
    <td><textarea name="cv" id="cv" class="inpl"  style="width:245px;height:50px;overflow:auto;"></textarea></td>
    <td valign="top"><select  name="dg"  style="width:125px"  />
    
        <? echo   $danhgia  ?> </td>
    <td><textarea name="note" id="note" class="inpl"  style="width:160px;height:50px;overflow:auto;"></textarea></td>

    <td align="center"><input type="button" value=" + " name="them"  onclick="kiemtracv('',tu.value,toi.value,cv.value,dg.value,note.value,frmbaocaocv.ngaybaocao.value,'')" style="width:30px" /></td>
  </tr>
 <?
   }
 ?> 
  
</table>

 <?php
   		$ngayf = $ngay1[0] . "_" .$ngay1[1] . "_" . $ngay1[2] ;
 		$dir    = getcwd()."/file/$idnv"  ;
		$sf = "";
		$mangfile = "";
         if ( file_exists($dir) ) 
		 {  
	 		//$files1 = scandir($dir);
	 		$files1 = opendir($dir); 
			while (false !== ($key = readdir($files1)))
 	//	    foreach($files1  as $key )
			{
				if ($key != "." && $key != ".." && substr($key,0,strpos($key,"-",1)) == $ngayf )
				{
					$tenfile = substr($key ,strpos($key,"-",1)+1,strlen($key)) ;
					$sf .=  "<a style='cursor:pointer' onclick=\"taifile('$tenfile')\">$tenfile</a> &nbsp;&nbsp;<img src='images/icon_delete.gif'  style='cursor:pointer;padding-top:7px'  onclick=\"xoaten('$tenfile')\"   width='12' /><br>" ;	
					if ($mangfile != "") { $mangfile .= "@#@" ;}
					$mangfile .= "$tenfile" ;
    			}	
				 
			}	
			 
		}
		if ($sf != "") { $sf ="File đính kèm<br>" . $sf;}
 ?>	
 
<div id="cacfile" style="padding:5px"><?php echo  $sf ; ?></div> 
<input id="mangfilean" type="hidden"  size="25" name="mangfilean" value="<?php echo  $mangfile ; ?>">
 
  <label>File: 
  <input id="fileToUpload" type="file"  size="35" name="fileToUpload" class="input" style="height:22px" />
<button class="button" id="buttonUpload" onClick="return ajaxFileUpload();" style="height:22px">Upload</button>  
 &nbsp;(chọn file và bấm Upload) </label>
   
 
	<fieldset >
	<legend> 
	 
<label class="maufiel" onclick="anhien2f('ankhachhang','khachangchitiet')">Đánh giá cũ</label></legend>
<div id="ht_danhgia">
	<div style="padding-top:10px;color:#0000FF" ><?php echo str_replace("\n", "<br>", $ghichu )  ; ?>	</div>
<?php 
   if ( $diem > "0" ) 
   {
 ?>  <br />

Tự đánh giá <img src="images/star_<?php echo $diem ; ?>.gif" width="66" height="13" />
<?php 
  }
 
  
 ?> 
 </div> 
 <br />
Lãnh đạo cho điểm : <img src="images/star_<?php echo $diemdg ; ?>.gif" width="66" height="13" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br />
<textarea name="ghichu" id="ghichu" class="inpt" readonly="readonly" style="width:560px;height:100px;overflow:auto;background-color:#eef2fb;"><?php echo $ghichudg ; ?></textarea>
</fieldset>


<input type="hidden" name="idcv"  value="<? echo $idcv ; ?>"/>
<input type="hidden" name="luuok"  value="<? echo $stt ; ?>"/>

<?php 
    
    $pro = serialize($mangcv) ;
    $pro =  str_replace("'", "\\'", $pro);
	if (   $num <= 0) 
	{  	  	

	$sql ="INSERT INTO congviec (IDNhanVien,NgayLam,note)VALUES ('$idnv', '$ngay[2]-$ngay[1]-$ngay[0]','$pro')"; 	  	  
    } else
	{
		$sql ="update congviec set note ='$pro'  where IDNhanVien=$idnv and NgayLam like '$ngay[2]-$ngay[1]-$ngay[0]'";
	}
	 
 	 	$update = $data->query($sql);
//echo $sql ;
?>
 