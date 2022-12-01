<?php  
session_start();
//set_time_limit(0);
 $quyen= $_SESSION["quyen"] ; 
 date_default_timezone_set('Asia/Ho_Chi_Minh');
//ini_set('memory_limit', '-1');$_SESSION["act"]
if ($_SESSION["LoginID"]=="") return ;
$ql =$quyen[$_SESSION["mangquyenid"][$_SESSION["act"]]] ;  

$root_path =getcwd()."/"  ;
include($root_path."biensession.php");
include($root_path."includes/config.php");
include($root_path."includes/removeUnicode.php");
include($root_path."includes/class.paging.php");
include($root_path."includes/class.mysql.php");
include($root_path."includes/function.php");
include($root_path."includes/function_local.php");
include( $root_path."excel/simplexlsx.class.php");  
include( $root_path."cauhinhtailenvandonluubien.php"); 
if($mangcauhinhvc){
	$mangcauhinhvc=json_decode($mangcauhinhvc,true);
}
?>	
<div class="input" style="">
<input id="mangfilean" type="hidden"  size="25" name="mangfilean" value="" />
    <label>File vận chuyển Excel *.xlsx</label>
<input id="fileToUpload" type="file" accept=".xlsx"   size="35" name="fileToUpload" class="input" style="height:22px" />
<div><label style="color:#000066">Nhà vận chuyển:</label>

	<select id="chonnhavc" name="chonnhavc" class="js-chonnhavc" onchange="setTudong(event)">
	<?php
		foreach($mangcauhinhvc as $key => $value){
				
	?>
	
			<option value="<?php echo $key; ?>" data-dong="<?php echo $value["sodong"][0] ?>" >
					<?php echo $value['tennvc']; ?>
			</option>
	<?php } ?>
	</select>
</div>
<div><label style="color:#000066">Từ dòng:</label><input type="number" id="tudong" name="tudong" value="1"/>
<label style="color:#000066">Đến dòng:</label><input type="number" id="dendong" name="dendong"/></div>


<style>
   .chiao{     display: flex;
    flex-direction: column;
    width: 40%;
    min-height: 120px;
    padding: 0 1em;
    justify-content: space-between;
	    display: flex;
    flex-direction: column;
    width: 40%;
    min-height: 60px;
    padding: 0.5em 1em;
    justify-content: space-between;
  
    margin-right: 1em;
	}
</style>
<div style="    margin: 0.5em;display: flex;
    justify-content: center;">
	<div class="chiao " style="  border: 1px solid red;">
		<p style="color:#FF0000;font-weight:bold">Tải lên phiếu thu chi</p>
		<button class="button" id="buttonUpload" onclick="return ajaxFileUpload('vandontailen',1);" style="height:22px">Tải lên</button>
		
	</div>

	
</div>
<div id="resupdate"></div>

</div>

 <div id="hienthiexcel" style="padding:5px">
 
 <table id="tbex" width="100%" border="0" cellpadding="0" cellspacing="0" style="background:#FFF;" class="tbchuan">		
 		<tr bgcolor="#F8E4CB">
		  <td align="center" class="cothienthi" height="23" width="32"><b>STT</b></td>
       
		  <td width="75" align="center" class="cothienthi" ><strong>Mã Thành Viên</strong></td>  
 		  <td width="360" align="center" class="cothienthi"><strong>Tên</strong> </td> 
          <td width="39" align="center" class="cothienthi"><strong>Điện thoại</strong></td>
          <td width="40" align="center" class="cothienthi"><strong>Ngày Sinh</strong> </td> 
 		  
		    
 		</tr>
        	<tr bgcolor="" style="color:#000">
		  <td align="center" class="cothienthi" height="23" width="32">5</td>
       
		  <td width="75" align="center" class="cothienthi" >2805210001</td>  
 		  <td width="360" align="center" class="cothienthi">Nguyễn Văn A</td> 
          <td width="39" align="center" class="cothienthi">0987654321</td> 
		  <td width="40" align="center" class="cothienthi">01/01/2000</td>
       
		    
		    
 		</tr>
        </table>
 
 
 
 
</div>

