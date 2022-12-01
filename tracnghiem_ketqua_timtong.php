<?php  
session_start();

$root_path =getcwd()."/"  ;
include($root_path."biensession.php");
include($root_path."includes/config.php");
include($root_path."includes/removeUnicode.php");
include($root_path."includes/class.paging.php");
include($root_path."includes/class.mysql.php");
include($root_path."includes/function.php");
include($root_path."includes/function_local.php");

$idk = ($_SESSION["LoginID"]) ; if ( $idk == 0) return ;
$kho = laso($_SESSION["se_kho"]);   
 if ($_SESSION["loai_user"] ==6 ) { $idk = 1 ;$kho =1; }
$data = new class_mysql();
$data->config();
$data->access();
  $quyenhuyphieu = "" ;
  if ($idk != 1 || 1==1) $quyenhuyphieu = " and dakhoa != '2' " ;
  $data1 = $_POST['DATA']; 
  $tmp = explode('*@!',$data1);
  $idtraloi  = laso($tmp[0])  ;		 
   
 		$sql = "SELECT * FROM tracnghiem_ketqua  where ID = '$idtraloi' ";

		$note = getdong($sql);
		//echo $note["note"];

		$tmp = explode('@$$@',$note["note"]);
		//echo count($tmp); return;
		?>

		<div style="width:98%;overflow:scroll;height:530px" align="center">
		 <table style="width: 100%" border="0" cellpadding="0" cellspacing="0">		
	 		<tr bgcolor="#F8E4CB">
	 			<td height="23" width="3%" align="center" class="cothienthi" ><b>STT</b></td>
				<td height="23" width="40%" align="center" class="cothienthi" ><b>Câu hỏi</b> </td>
				<td width="20%" align="center"  class="cothienthi"><strong>Đáp án</strong></td>
				<td width="5%" align="center" class="cothienthi" ><strong>Đáp án đúng</strong></td>  
				<td width="5%" align="center" class="cothienthi" ><strong>Trả lời</strong></td>  	   
				<td width="5%" align="center" class="cothienthi"><strong>Đúng/Sai</strong> </td> 
	 		</tr>
		<?php
		foreach ($tmp as  $value) {
			//echo $value."<br>";
			if($mau == "white")
			{
				 $mau = "#EEEEEE";
				 $hl = "Normal4" ;
				 $hl2 = "Highlight4";		
			}
			else 
			{ 
				$mau = "white";
				$hl = "Normal5" ;
				$hl2 = "Highlight5";
			} 
			$tmp_1 = explode('@#@',$value);
			//echo $tmp_1["0"]."-".$tmp_1["1"]."-".$tmp_1["2"]."<br>";
			?>
			<tr  style="cursor:pointer;color:<?php echo $mauchu ; ?> "  onMouseOver="this.className='<?php echo $hl2; ?>'" onMouseOut="this.className='<?php echo $hl; ?>'"  bgcolor="<?php echo $mau ?>" >
	 	 		<td class="cothienthi"    align="center"><?php echo $tmp_1["0"] ;?></td>
				<td class="cothienthi"    align="left"><?php echo getten("tracnghiem_cauhoi",$tmp_1["1"],"Name"); ?>&nbsp;</td>
				<td class="cothienthi" align="left">
					<?php
						$sql_dapan = "SELECT * FROM tracnghiem_dapan where IDGroup='".$tmp_1["1"]."' ORDER BY ID ASC "; 
						//echo "++ ".$sql_dapan;
						$query_rows_dapan = $data->query($sql_dapan);
						$result_rows_dapan = $data->num_rows($query_rows_dapan);
						$result_dapan = $data->query($sql_dapan);
						$i_dapan = 0;
						$danhsachdapan = '';
						while(($result_news_dapan = $data->fetch_array($result_dapan)  ) )	
						{ 
							$i_dapan ++;
							if($i_dapan == 1) $danhsachdapan .= "&nbsp;A. ".$result_news_dapan["Name"] ."<br> ";
					        if($i_dapan == 2) $danhsachdapan .= "&nbsp;B. ".$result_news_dapan["Name"] ."<br> ";
					        if($i_dapan == 3) $danhsachdapan .= "&nbsp;C. ".$result_news_dapan["Name"]."<br> ";
					        if($i_dapan == 4) $danhsachdapan .= "&nbsp;D. ".$result_news_dapan["Name"]." ";
					    }
					    echo $danhsachdapan;  
					 ?>
				</td>	
				<td class="cothienthi" align="center">
					<?php 
						$dapandung = getten("tracnghiem_cauhoi",$tmp_1["1"],"ma");
						echo $dapandung;
					?>
				</td>
				<td class="cothienthi" align="center">&nbsp;<?php echo $tmp_1["2"]==$dapandung?"<span style='color: ; font-weight:bold'>".$tmp_1["2"]."</span>":"<span style='color:red;'>".$tmp_1["2"]."</span>" ;?></td>
				<td class="cothienthi"  >&nbsp;<?php echo $tmp_1["2"]==$dapandung?"<span style='color:; font-weight:bold'>Đúng</span>":"<span style='color:red;'>Sai</span>" ;?></td> 
	   		</tr>
		<?php
		}
		?>
		<!-- <tr>
		 	<td class="cothienthi" colspan="2"   align="center"><b>Tổng</b></td>
			<td class="cothienthi" align="center">&nbsp;<b><?php echo $tong; ?></b></td>	
			<td class="cothienthi" align="center">&nbsp;<?php  ?></td>
			<td class="cothienthi" align="center">&nbsp;<?php  ?></td> 
			<td class="cothienthi" align="center">&nbsp;<?php  ?></td>
		</tr> -->	
	</table>
	</div>
  

<?php				
    $data->closedata() ;
?>	