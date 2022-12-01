<?php
session_start();
$idk = $_SESSION["LoginID"] ;
	if (!defined("IN_SITE"))
	{
    	die('Hacking attempt!');
	}
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php	
//=============================khoi tao ======================//  	 Xem  	 Them  	 Cap nhap  	 Tim  	Huy  	Khoa  	In
 	$data->setthaotac = "nhomphutung" 	;
	//  echo $mquyen[12]."<br>";
	//echo kiemtraquyenthumuc(2,"them") ; 
	$q_cn = "" ; $q_xoa = "" ;
    if (kiemtraquyenthumuc(14,"xem")== "0")     {  echo " <meta http-equiv='refresh'content='1;url=default.php'>"; return ;}	
 	if (kiemtraquyenthumuc(14,"them")== "0")    {  $template->assign("q_them","none");  }
	if( kiemtraquyenthumuc(14,"capnhap") ==0 )  { $template->assign("q_capnhap","none");  $q_cn   = " none"  ;  }
 	if (kiemtraquyenthumuc(14,"xoa")== "0")     { $template->assign("q_xoa","none");      $q_xoa  = " none"  ;  }
	
  //=======================================================================================		
 
	function printtree1($id_root, $level,$select_i,$idcall,$action)
	{			
		global $data, $Caytm;  
		$space="&nbsp; &nbsp;";
		$name1="";	 	
		for($i=0; $i<$level; $i++)
		{
			$name1.=$space;
		}
		$sql="SELECT Name,ID,IDGroup,ma,IDGroup  FROM  tracnghiem_cauhoi WHERE IDGroup='$id_root' and ID != 0 order by Rank desc";
		
		if($result=$data->query($sql)){			
			while($result_news = $data->fetch_array($result))
			{
				$id = $result_news["ID"] ;
				if (trim($result_news["IDGroup"]) == "0") { $name1 = "" ; }
				$name=$result_news["Name"];
				$ma =  $name1."".$result_news["ma"] ;
				$select = "" ;
				 
				if ( trim($select_i) == trim($id) )
					{
						$select = "selected";	
 					}				 
				if (trim($idcall)!= trim($id) &&   $action ==false )
				   { $Caytm.="<option value='$id' $select>$ma - $name</option> ";}			
				   else
				   {	 $Caytm.= "<optgroup label='$ma - $name'></optgroup>" ; $action = true ;}
				printtree1($id, $level+1,$select_i,$idcall,$action);	
					 $action = false ;	 
			 }
		 }
	}
//===========================================================================

//=============================================	
    $stt = 0;
	function tree($id_root, $level)
	{
		global $data, $Caytme,$mau,$stt,$q_cn,$q_xoa; 
		$space="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
		$name1="";	 
		for($i=1; $i<$level; $i++)
		{
			$name1.=$space;
		}
		$sql="SELECT * FROM  tracnghiem_cauhoi WHERE IDGroup='$id_root' and ID != 0 order by Name Asc";
		 
		if($result=$data->query($sql)){			
			while($result_news = $data->fetch_array($result))
 			{   
			   $ma = "&nbsp;".$result_news["ma"] ."&nbsp;";
				$id = $result_news["ID"] ;
 			    $mottin ="&nbsp;".$result_news["Name"] ;
 			    $mottin1 ="&nbsp;". getten("loaihang",$result_news["IDloai"],"Name");
				 $stt = $stt +1 ;
 				if ( $result_news["IDGroup"] != "0" )				
				{  
  					$name="<td align='center'>$stt</td>
  					<td  style='display:none' align='left'>$ma</td>
  					<td>&nbsp; $name1<img src='images/images_admin/nutdo.gif' border='0'>&nbsp;$mottin</td>
  					<td>&nbsp; $name1<img src='images/images_admin/nutdo.gif' border='0'>&nbsp;$mottin1</td>
  					<td  align='center' style='display:$q_cn'><a href='default.php?act=tracnghiem_cauhoi&id=$id'><img title='Cập nhập' src=\"images/edit.gif\" border='0'></a></td>
  					<td style='display:$q_xoa' align='center'><a href=\"default.php?act=tracnghiem_cauhoi&Del=$id\" onclick=\"return ask()\"><img title=\"Xóa Mục\"  src=\"images/delete.gif\" border=\"0\"></a></td>";
				}else
				{				
					$name="<td  align='center'>$stt</td>
					<td  style='display:none' align='left'>$ma</td>
					<td >&nbsp; $name1<img src=\"images/images_admin/round_f.gif\" border='0'><strong>&nbsp;$mottin</strong></td>
					<td>&nbsp; $name1<img src=\"images/images_admin/round_f.gif\" border='0'><strong>&nbsp;$mottin1</strong></td>
					<td  style='display:$q_cn' align='center'><a href='default.php?act=tracnghiem_cauhoi&id=$id'><img title=\"Cập nhập\" src=\"images/edit.gif\" border='0'></a></td>
					<td style='display:$q_xoa' align='center'><a href=\"default.php?act=tracnghiem_cauhoi&Del=$id\" onclick=\"return ask()\"><img title=\"Xóa Mục\"  src=\"images/delete.gif\" border=\"0\"></a></td>";
				}	
				   if($mau == "white")
					{	   $mau = "#EEEEEE";$hl = "Normal4" ;$hl2 = "Highlight4";	} 	
					else 
					{ 	 	$mau = "white";	$hl = "Normal5" ;$hl2 = "Highlight5"; }		

				$Caytme.="<tr bgcolor='$mau'  onmouseover=\"this.className='$hl2'\" onmouseout=\"this.className='$hl'\">$name</tr>";				
				tree($id, $level+1);
			 
			}
		}
	}
//===================================
 if ($_POST["cancel"] != "")
{
	$ID = "" ;
	$_GET["id"] ="" ;
} 
 
if ($_POST["btnUpdate"] != "")
{ 	
		$ID = $_GET["id"] ;
		$IDGroup = $_POST["IDGroup"] ;
		$Name = $_POST["Name"] ;
		$images = $_SESSION['file'] ;	
		$Rank = $_POST["Rank"] ;
		if (trim($Rank) == "") { $Rank = "1" ; } 
		$ma = $_POST["ma"] ;
		$note = $_POST["note"] ;	
		$IDloai = laso($_POST["IDloai"] );	
		$NameN = khongdau($Name);
		$dapana = $_POST["dapana"] ;
		$dapanb = $_POST["dapanb"] ;
		$dapanc = $_POST["dapanc"] ;
		$dapand = $_POST["dapand"] ;
		$dapandung = $_POST["dapandung"] ;
		$ngaytao = gmdate('Y-n-d H:i:s', time() + 7*3600) ;
		if  ($_GET["id"] == "-1")
		{
		  	$sql ="insert into  tracnghiem_cauhoi (IDloai,note,IDGroup,Name,images,Rank,ma,NameN,id_user,ngaytao) values ('$IDloai','$note','$IDGroup','$Name','$images','$Rank','$dapandung','$NameN','$idk','$ngaytao')"; 
			$update = $data->query($sql);
			$them = true;
			$tam_soluong = getdong("select ID from tracnghiem_cauhoi order by ID DESC limit 0,1");
			$sqldapana ="insert into  tracnghiem_dapan (IDloai,note,IDGroup,Name,images,Rank,ma,NameN,id_user,ngaytao) values ('1','$note','".$tam_soluong["ID"]."','$dapana','','','','','$idk','$ngaytao')";
			$update = $data->query($sqldapana);
			$sqldapanb ="insert into  tracnghiem_dapan (IDloai,note,IDGroup,Name,images,Rank,ma,NameN,id_user,ngaytao) values ('2','$note','".$tam_soluong["ID"]."','$dapanb','','','','','$idk','$ngaytao')";
			$update = $data->query($sqldapanb);
			$sqldapanc ="insert into  tracnghiem_dapan (IDloai,note,IDGroup,Name,images,Rank,ma,NameN,id_user,ngaytao) values ('3','$note','".$tam_soluong["ID"]."','$dapanc','','','','','$idk','$ngaytao')";
			$update = $data->query($sqldapanc);
			$sqldapand ="insert into  tracnghiem_dapan (IDloai,note,IDGroup,Name,images,Rank,ma,NameN,id_user,ngaytao) values ('4','$note','".$tam_soluong["ID"]."','$dapand','','','','','$idk','$ngaytao')";
			$update = $data->query($sqldapand);
		} 
		else
		{
		  	$sql ="UPDATE  tracnghiem_cauhoi SET  IDloai='$IDloai', note ='$note',ma ='$dapandung',IDGroup ='$IDGroup', Name ='$Name',images ='$images',Rank='$Rank',NameN ='$NameN',id_user_sua='$idk',ngaysua='$ngaytao'  where  ID='0$ID'" ;
			$update = $data->query($sql);
			$them = true; 

			$sqldapana ="UPDATE  tracnghiem_dapan SET  note ='$note',ma ='$dapandung',  Name ='$dapana',images ='$images',Rank='$Rank',NameN ='$NameN',id_user_sua='$idk',ngaysua='$ngaytao'  where  IDGroup='0$ID' and IDloai='1' " ;
			$update = $data->query($sqldapana); 
			$sqldapanb ="UPDATE  tracnghiem_dapan SET  note ='$note',ma ='$dapandung',  Name ='$dapanb',images ='$images',Rank='$Rank',NameN ='$NameN',id_user_sua='$idk',ngaysua='$ngaytao'  where  IDGroup='0$ID' and IDloai='2' " ;
			$update = $data->query($sqldapanb); 
			$sqldapanc ="UPDATE  tracnghiem_dapan SET  note ='$note',ma ='$dapandung',  Name ='$dapanc',images ='$images',Rank='$Rank',NameN ='$NameN',id_user_sua='$idk',ngaysua='$ngaytao'  where  IDGroup='0$ID' and IDloai='3' " ;
			$update = $data->query($sqldapanc); 
			$sqldapand ="UPDATE  tracnghiem_dapan SET  note ='$note',ma ='$dapandung',  Name ='$dapand',images ='$images',Rank='$Rank',NameN ='$NameN',id_user_sua='$idk',ngaysua='$ngaytao'  where  IDGroup='0$ID' and IDloai='4' " ;
			$update = $data->query($sqldapand); 
		}  
	 
}	
   $del =  laso($_GET["Del"]); 
   if ($del == '0' ) $del = -1 ;
//  echo kiemtraxoa("phieunhapxuat","IDNhaCC"," where  IDNhaCC ='40' and Loai = '0' limit 0,1 ") ;
  $ktxoa = kiemtraxoa("tracnghiem_dapan","IDGroup"," where  IDGroup ='$del'  limit 0,1 ") ;
  //echo $ktxoa;
if ($ktxoa == 1 || $del == 1 )
{
  $template->parse("main.block_khongxoa");
}
if ( $del != "" && kiemtraquyenthumuc(14,"xoa")== "1" && $ktxoa == 0)
{ 
 		$IDD = $del ;
 		$xoa = true ;
				if (kiemtranhomcon("tracnghiem_cauhoi",$IDD,"IDGroup")=="0")
				{ 
 					$sql = "delete from  tracnghiem_cauhoi where   ID = '0".$IDD."'" ;
					$update = $data->query($sql);
 				}
				 else
				{

					$template->parse("main.block_canhbao");				
				}		
		
}
 
 
 	$tam = "" ;
	$kt = 0 ;	
	if ($_REQUEST["id"] == ""  )
	{
 	 //tree(0, 1); 		
  	 //$template->assign("caymenuedit", $Caytme );
  	 $sql = "SELECT *, DATE_FORMAT(ngaytao,'%d/%m/%Y %H:%i') as ngaytaoa, DATE_FORMAT(ngaysua,'%d/%m/%Y %H:%i') as ngaysuaa FROM tracnghiem_cauhoi  order by ngaytao ASC "; 
		//echo $sql;
		$query_rows = $data->query($sql);
		$result_rows = $data->num_rows($query_rows);
		$result = $data->query($sql);  
		while(($result_news = $data->fetch_array($result)  )	&& ($SOST < $page_row))	
		{  
			$i=$i+1;  
			$template->assign("ID",$result_news["ID"]);
			$template->assign("stt", $i);
			$template->assign("Name",$result_news["Name"]);
			$sql_dapan = "SELECT * FROM tracnghiem_dapan where IDGroup=".$result_news["ID"]." ORDER BY ID ASC "; 
			//echo "++ ".$sql_dapan;
			$query_rows_dapan = $data->query($sql_dapan);
			$result_rows_dapan = $data->num_rows($query_rows_dapan);
			$result_dapan = $data->query($sql_dapan);
			$i_dapan = 0;
			$danhsachdapan = '';
			while(($result_news_dapan = $data->fetch_array($result_dapan)  )	&& ($SOST < $page_row))	
			{ 
				$i_dapan ++;
				if($i_dapan == 1) $danhsachdapan .= "&nbsp;A. ".$result_news_dapan["Name"] ."<br> ";
		        if($i_dapan == 2) $danhsachdapan .= "&nbsp;B. ".$result_news_dapan["Name"] ."<br> ";
		        if($i_dapan == 3) $danhsachdapan .= "&nbsp;C. ".$result_news_dapan["Name"]."<br> ";
		        if($i_dapan == 4) $danhsachdapan .= "&nbsp;D. ".$result_news_dapan["Name"]." ";
		    }
		    $template->assign("danhsachdapan",$danhsachdapan);
		    $template->assign("dapandung",$result_news["ma"]); 
		    $template->assign("thongtin","&nbsp;Ngày tạo: ".$result_news["ngaytaoa"].", ".getten("userac",$result_news["id_user"],"Ten")."<br>"."&nbsp;Ngày sửa: ".$result_news["ngaysuaa"].", ".getten("userac",$result_news["id_user_sua"],"Ten")."<br>");

 	 		$template->parse("main.block_caymenu");
		 } 	 
	 $template->parse("main.block_grpht1");	
	 $template->parse("main.block_grpht2");	  
	}
	 else	
	{ 
	
		if ($_REQUEST["id"] == "-1")
		{ 
		   $template->assign("t-c","Thêm Mới Nhóm" );
		   $template->assign("idgoi",$_POST["id"]);
		   $template->assign("loai","0");	
		   $template->assign("Rank","1");
		   $template->assign("dapandunga","checked=''");
		   $_SESSION['file'] ="" ;
		   $IDGroup = "" ;
		   $IDG = "" ;
		}
		else		
		{
			$sql ="SELECT * FROM  tracnghiem_cauhoi WHERE ID='".laso($_REQUEST["id"])."'";
			$query = $data->query($sql);
			$result = $data->fetch_array($query);
			   $template->assign("t-c","Cập nhập Nhóm" );
			   $template->assign("loai",$_REQUEST["id"]);	
			   $template->assign("idgoi",$_POST["id"]);
			   $template->assign("Name",$result["Name"]);
			   $template->assign("note",$result["note"]);
			   
			   $template->assign("loaihang",composx("loaihang","Name",$result["IDloai"],""));
			   $template->assign("dapandunga",($result["ma"]=='A'?"checked=''":""));
			   $template->assign("dapandungb",($result["ma"]=='B'?"checked=''":""));
			   $template->assign("dapandungc",($result["ma"]=='C'?"checked=''":""));
			   $template->assign("dapandungd",($result["ma"]=='D'?"checked=''":""));
			   
				$tam = getdong("select Name from tracnghiem_dapan where IDGroup='".$_REQUEST["id"]."' and IDloai = 1 limit 0,1");
				$template->assign("dapana",$tam["Name"]);
				$tam = getdong("select Name from tracnghiem_dapan where IDGroup='".$_REQUEST["id"]."' and IDloai = 2 limit 0,1");
				$template->assign("dapanb",$tam["Name"]);
				$tam = getdong("select Name from tracnghiem_dapan where IDGroup='".$_REQUEST["id"]."' and IDloai = 3 limit 0,1");
				$template->assign("dapanc",$tam["Name"]);
				$tam = getdong("select Name from tracnghiem_dapan where IDGroup='".$_REQUEST["id"]."' and IDloai = 4 limit 0,1");
				$template->assign("dapand",$tam["Name"]);
			   
			   $template->assign("ma",$result["ma"]);
			   $_SESSION['file'] = $result["images"] ;
			   $template->assign("IDGroup",$result["IDGroup"]);
			   $IDGroup = $result["IDGroup"] ; 
			   $IDG = $result["ID"] ;
			   
			   $template->assign("Rank",$result["Rank"]);
		   
		}
 		printtree1(0, 1, $IDGroup ,$IDG,false); 	 
     	$template->assign("cay",$Caytm);			
		$template->assign("loaihang",composx("loaihang","Name",$result["IDloai"],""));	
 		$template->assign("upload","source/upload.php");
	    $template->parse("main.block_grp");
	 
}
 $data->closedata() ;
 
?>