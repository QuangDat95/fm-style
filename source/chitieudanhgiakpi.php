<?php
session_start();
if (!defined("IN_SITE")) {
    die("Hacking attempt!");
}
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
// compocay("kpi_danhgia", "Name", "IDGroup", 0, 0, 0, 0);

// echo compocay("kpi_danhgia","Name","IDGroup",0, 0,0,0);
// $template->assign("kpi_danhgia",composx("kpi_danhgia", "ten","", "", ""));
// echo $template->assign("kpi_danhgia",composx("kpi_danhgia", "Name","", "", ""));
//=============================khoi tao ======================//  	 Xem  	 Them  	 Cap nhap  	 Tim  	Huy  	Khoa  	In
$data->setthaotac = "nhomphutung";
//  echo $mquyen[12]."<br>";
//echo kiemtraquyenthumuc(2,"them") ;
$q_cn = "";
$q_xoa = "";
if (kiemtraquyenthumuc(14, "xem") == "0") {
    echo " <meta http-equiv='refresh'content='1;url=default.php'>";
    return;
}
if (kiemtraquyenthumuc(14, "them") == "0") {
    $template->assign("q_them", "none");
}
if (kiemtraquyenthumuc(14, "capnhap") == 0) {
    $template->assign("q_capnhap", "none");
    $q_cn = " none";
}
if (kiemtraquyenthumuc(14, "xoa") == "0") {
    $template->assign("q_xoa", "none");
    $q_xoa = " none";
}

//=======================================================================================

function printtree1($id_root, $level,$select_i,$idcall,$action,$where)
	{			
		global $data, $Caytm;  
		$space="&nbsp;";
		$ten1="";	 	
		for($i=0; $i<$level; $i++)
		{
			$ten1.=$space;
		}
		$sql="SELECT ten,ID,IDcha,kpi_dexuat,chucvu FROM  kpi_danhgia WHERE IDcha='$id_root' and ID != 0 $where";
		
        // echo "test1".$sql;
		if($result=$data->query($sql)){			
			while($result_news = $data->fetch_array($result))
			{
				$id = $result_news["ID"] ;
				if (trim($result_news["IDcha"]) == "0") { $ten1 = "" ; }
				$ten=$result_news["ten"];
				$ma =  $ten1."".$result_news["ma"] ;
				$select = "" ;
				 
				if ( trim($select_i) == trim($id) )
					{
						$select = "selected";	
 					}				 
				if (trim($idcall)!= trim($id) &&   $action ==false )
				   { $Caytm.="<option value='$id' $select>$ma - $ten</option> ";}			
				   else
				   {	 $Caytm.= "<optgroup label='$ma - $ten'></optgroup>" ; $action = true ;}
				printtree1($id, $level+1,$select_i,$idcall,$action,$idphongban);	
					 $action = false ;	 
			 }
		 }
	}
//===========================================================================



// echo "test".$Caytm; 
//=============================================


$stt = 0;
$ma = "";
$matam1 = "";
function tree($id_root, $level)
{
    global $data,
        $Caytme,
        $mau,
        $stt,
        $q_cn,
        $q_xoa,
        $idcv,
        $idphongb,
        $ma,
        $matam1;
    if ($idcv) {
        $wherecv = " and chucvu=$idcv";
    }
    if ($idphongb) {
        $wherecv = " and IDphongban=$idphongb";
    }
    $ma = "";
    //echo $matam1;
    $space = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
    $ten1 = "";
    for ($i = 1; $i < $level; $i++) {
        $ten1 .= $space;
    }
    $sql = "SELECT a.*,b.Name as tenphong FROM  kpi_danhgia a left join rooms b on a.IDphongban=b.ID WHERE IDcha='$id_root' and a.ID != 0 $wherecv";
    // echo $sql;
    if ($result = $data->query($sql)) {
        while ($result_news = $data->fetch_array($result)) {
            if ($matam1 == "" || $matam1 != $result_news["tenphong"]) {
                $ma = "&nbsp;" . $result_news["tenphong"] . "&nbsp;";
                $matam1 = $result_news["tenphong"];
            }

            $id = $result_news["ID"];
            $mottin = "&nbsp;" . $result_news["ten"];
            $stt = $stt + 1;
            if ($result_news["IDcha"] != "0") {
                $ten = "<td align='center'>$stt</td><td  align='left' style='    color: #ff5722;
    font-weight: bold;'>$ma</td><td>&nbsp; $ten1<img src='images/images_admin/nutdo.gif' border='0'>&nbsp;$mottin</td><td  align='center' style='display:$q_cn'><a href='default.php?act=chitieudanhgiakpi&id=$id'><img title='Cập nhập' src=\"images/edit.gif\" border='0'></a></td><td style='display:$q_xoa' align='center'><a href=\"default.php?act=chitieudanhgiakpi&Del=$id\" onclick=\"return ask()\"><img title=\"Xóa Mục\"  src=\"images/delete.gif\" border=\"0\"></a></td>";
            } else {
                $ten = "<td  align='center'>$stt</td><td align='left'  style='    color: #ff5722;
    font-weight: bold;'>$ma</td><td>&nbsp; $ten1<img src=\"images/images_admin/round_f.gif\" border='0'><strong>&nbsp;$mottin</strong></td><td  style='display:$q_cn' align='center'><a href='default.php?act=chitieudanhgiakpi&id=$id'><img title=\"Cập nhập\" src=\"images/edit.gif\" border='0'></a></td><td style='display:$q_xoa' align='center'><a href=\"default.php?act=chitieudanhgiakpi&Del=$id\" onclick=\"return ask()\"><img title=\"Xóa Mục\"  src=\"images/delete.gif\" border=\"0\"></a></td>";
            }
            if ($mau == "white") {
                $mau = "#EEEEEE";
                $hl = "Normal4";
                $hl2 = "Highlight4";
            } else {
                $mau = "white";
                $hl = "Normal5";
                $hl2 = "Highlight5";
            }

            $Caytme .= "<tr bgcolor='$mau'  onmouseover=\"this.classten='$hl2'\" onmouseout=\"this.classten='$hl'\">$ten</tr>";
            tree($id, $level + 1);
        }
    }
}
//===================================
if ($_POST["cancel"] != "") {
    $ID = "";
    $_GET["id"] = "";
}

if ($_POST["btnUpdate"] != "") {
    $ID = $_GET["id"];
    $nhomcha = $_POST["nhomcha"];
    $ten = $_POST["ten"];
    $ghichu = $_POST["ghichu"];
    $chucvu = $_POST["chucvu"];
    $kpi_dexuat = $_POST["kpi_dexuat"];
    $Rank = $_POST["Rank"];
    $idphongb = $_POST["phongban"];
    if (trim($Rank) == "") {
        $Rank = "1";
    }

    if ($_GET["id"] == "-1") {
        $sql = "insert into  kpi_danhgia (IDcha,ten,ghichu,chucvu,kpi_dexuat,IDphongban) values ('$nhomcha','$ten','$ghichu','$chucvu','$kpi_dexuat','$idphongb')";
        echo $sql; return;
    } else {
        $sql = "UPDATE kpi_danhgia SET IDcha='$nhomcha', ten ='$ten',ghichu ='$ghichu',chucvu ='$chucvu',kpi_dexuat='$kpi_dexuat',IDphongban='$idphongb' where ID != 1 and ID='0$ID'";
    }

    $update = $data->query($sql);
    header("location: default.php?act=chitieudanhgiakpi");
    $them = true;
}
$del = laso($_GET["Del"]);
if ($del == "0") {
    $del = -1;
}
//  echo kiemtraxoa("phieunhapxuat","IDNhaCC"," where  IDNhaCC ='40' and Loai = '0' limit 0,1 ") ;
$ktxoa = kiemtraxoa("products", "IDcha", " where  IDcha ='$del'  limit 0,1 ");
if ($ktxoa == 1 || $del == 1) {
    $template->parse("main.block_khongxoa");
}
if ($del != "" && kiemtraquyenthumuc(14, "xoa") == "1" && $ktxoa == 0) {
    $IDD = $del;
    $xoa = true;
    if (kiemtranhomcon("kpi_danhgia", $IDD, "IDcha") == "0") {
        $sql =
            "delete from  kpi_danhgia where ID != 1   and  ID = '0" .
            $IDD .
            "'";
        $update = $data->query($sql);
    } else {
        $template->parse("main.block_canhbao");
    }
}

$IDcha = "";
$idchucvu = "";
$tam = "";
$kt = 0;
$idcv = $_REQUEST["chucvu"];
$idphongb = $_REQUEST["phongban"];
//echo $idphongb;
if ($_REQUEST["id"] == "") {
    tree(0, 1);
    $template->assign("kh_chucvu", composx("kh_chucvu", "Name", $idcv, ""));
    $template->assign("rooms", composx("rooms", "Name", $idphongb, ""));
    //$template->assign("kpi_danhgia",compocay1("kpi_danhgia", "ten", "IDcha", "", "","","",""));
    $template->assign("caymenuedit", $Caytme);
    $template->parse("main.block_grpht1");
    $template->parse("main.block_grpht2");
    $template->parse("main.block_caymenu");

    /* if(isset($_POST["cvim"])){
		
			$chucvuS=laso($_POST["chucvu"]);
			$phongbanS=laso($_POST["chucvu"]);
			$sql_where='1=1';
			if($chucvuS){
				$sql_where.=" chucvu='$chucvuS'";
			}
			if($phongbanS){
				$sql_where.=" phongban='$phongbanS'";
			}
			$query = $data->query($sql);
			$result = $data->fetch_array($query);
			  
			 
			   $template->assign("ten",$result["ten"]);
			   $template->assign("ghichu",$result["Ghichu"]);
			   $template->assign("kpi_dexuat",$result["kpi_dexuat"]);
			
			   $IDcha=$result["IDcha"];
			    $idchucvu=$result["chucvu"];
				 $idphong=$result["IDphong"];
			/*  $template->assign("kh_chucvu",composx("kh_chucvu","Name",$idcv,""));
				$template->assign("rooms",composx("rooms","Name",$idphong,""));
			   $template->assign("IDcha",$result["IDcha"]);
			 
			
		}	  */
} else {
    if ($_REQUEST["id"] == "-1") {
        $template->assign("t-c", "Thêm chỉ tiêu đánh gia KPI mới");
        $template->assign("idgoi", $_POST["id"]);
        $template->assign("loai", "0");
        $template->assign("Rank", "1");
		printtree1(0, 1, 0, '', false, '');

        $_SESSION["file"] = "";
        $IDcha = "";
        $IDG = "";
    } else {
        $sql = "SELECT a.* FROM  kpi_danhgia a WHERE ID='".laso($_REQUEST["id"])."'";
        $query = $data->query($sql);
        $result = $data->fetch_array($query);
        $template->assign("t-c", "Cập nhập Nhóm");
        $template->assign("loai", $_REQUEST["id"]);
        $template->assign("idgoi", $_POST["id"]);
        $template->assign("ten", $result["ten"]);
        $template->assign("ghichu", $result["Ghichu"]);
        // $template->assign("tenphong",$result["tenphong"]);
        $template->assign("kpi_dexuat", $result["kpi_dexuat"]);
        //$template->assign("gioitinh",composx("nhomhang","ten",$result["tenN"],""));
        // $template->assign("nhomhang",composx("nhomhang","ten",$result["IDnhom"],""));
        $IDcha = $result["IDcha"];
        $idchucvu = $result["chucvu"];
        $idphongban = $result["IDphongban"];
     	printtree1(0, 1, 0, '', false, " and IDphongban='$idphongban'");
    //  var_dump($IDcha);
        $template->assign("IDcha", $result["IDcha"]);

        $IDG = $result["ID"];
      
        //$template->assign("Rank",$result["Rank"]);
    }
	
  	$template->assign("cay", $Caytm);
	
    $template->assign("rooms", composx("rooms", "Name", $idphongban, ""));
    // $template->assign("kpi_danhgia", composx("kpi_danhgia", "ten", $idphongb, ""));
   
    $template->assign("kh_chucvu", composx("kh_chucvu", "Name", $idchucvu, ""));
    //$template->assign("nhomhang",composx("nhomhang","ten",$result["IDnhom"],""));
    $template->assign("upload", "source/upload.php");
    $template->parse("main.block_grp");
}
function compocay1($table,$nameht,$tencotidchild,$id_root, $level,$select_i,$idcall,$where)
 	{	
	
 		global $data, $compocaydata;  
		$space="&nbsp;&nbsp;&nbsp;";	$name1="";	 	
		for($i=0; $i<$level; $i++)	{$name1.=$space;}
		$sql="SELECT $nameht,ID,$tencotidchild  FROM  $table WHERE $tencotidchild  ='$id_root' and ID != 0 $where";
		
		if($result=$data->query($sql)){			
			while($result_news = $data->fetch_array($result))
			{  
				$id = $result_news["ID"] ;
				if ($result_news["$tencotidchild"] == "0") { $name1 = "" ; }
				$name=$name1."".$result_news["$nameht"];
				$compocaydata.= "<option  title=\"$name\" value='$id' >$name</option>" ;
				compocay($table,$nameht,$tencotidchild,$id, $level+1,$select_i,$idcall,$where);
			}
		}
}
$data->closedata();


?>
