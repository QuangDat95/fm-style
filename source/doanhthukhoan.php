<?php
if (session_status() == PHP_SESSION_NONE) session_start();

if (!defined("IN_SITE")) {
	die('Hacking attempt!');
}

if ($_SESSION["admintuan"])	 $template->parse("main.block_admin");
//=============================================	
if ($_POST["cancel"]  != "") {
	$ID = "";
	$_GET["id"] = "";
}
$template->assign('muccha', composx('cuahang', 'Name', '', ""));
$thang = gmdate('m', time() + 7 * 3600) + 1;
$nam = gmdate('Y', time() + 7 * 3600);
$toi = 24 - $thang;
$chuoi = '';
for ($i = 0; $i <= $toi; $i++) {
	$thang = $thang - 1;
	if ($thang <= 0) {
		$thang = $thang + 12;
		$nam = $nam - 1;
	}
	$thangnamv = $nam . '-0' . $thang . '-01';
	if ($thangnam == $thang . $nam) $sele = "selected";
	else   $sele = "";
	if ($thang < 10)   $chuoi .= "<option value='$thangnamv' $sele>Tháng 0$thang/$nam</option> ";
	else $chuoi .= " <option value='$nam-$thang-01' $sele >Tháng $thang/$nam</option> ";
}
$template->assign("thangnam", $chuoi);


if ($_POST["btnUpdate"]  != "") {

	$sotien =  	    $_POST["sotien"];
	$cuahang =  	        $_POST["tencuahang"];
	$datduoc =  	    $_POST["datduoc"];
	$thangnam = getngay();

	if ($_GET["id"] == "-1") {

		$sql = "insert into doanhthukhoan  (sotien,macuahang,idcuahang,datduoc,thangnam) values ('$sotien ','$cuahang','$cuahang','$datduoc','$thangnam')";
	} else {
		$sql = "UPDATE  doanhthukhoan  SET  sotien ='$sotien', macuahang  ='$cuahang' , idcuahang  ='$cuahang', datduoc = '$datduoc' , thangnam = '$thangnam' where ID='0$ID'";
	}
	//echo $sql ;
	$update = $data->query($sql);
	$them = true;
}


if ($_GET["Del"]  != "") {
	$IDD = $_GET["Del"];
	$sql = "delete from  doanhthukhoan  where ID = '0" . $IDD . "'";
	$update = $data->query($sql);
	$xoa = true;
} {
	$tam = "";
	$kt = 0;
	error_reporting(E_ALL ^ E_NOTICE);
	if ($_REQUEST["id"] == "" || $them  || $xoa) {
		error_reporting(E_ALL ^ E_NOTICE);
		$tencuahang = chonghack($_POST["tencuahang"]);
		$ngay = chonghack($_POST["tungay"]);
		if ($ql[5] || $idl == 1) {
			$template->assign("tatcakv", composx("khuvuc", "Name", 0, "$khuvuc"));
			$template->assign("hienthikhuvuc", "");



			//==========mieen========================= 
			if ($idl == 7577 || $idl == 1 || $idl == 4647 || $idl == 9296 || $idl == 9901 || $idl == 11787) //  11787 Nam  // 9901 Ni   // 7577 Mỹ   // 9296   thao  // 4647 Duyen 
			{
				$sql = 	"select * from mien";
				$chuoi = '';
				$result = $data->query($sql);
				$SOST = 0;
				while ($re = $data->fetch_array($result)) {
					$chuoi .= "<option value='-$re[ID]' >( $re[Name] )</option> ";
				}
				$template->assign("mien", $chuoi);
				//==========mieen=========================
			}
		}

		$template->parse("main.block_khht1");
		$sql = "SELECT ID FROM doanhthukhoan ";

		$sql_where = " where 1=1 ";
		if ($tencuahang != "")
			$sql_where .= " and idcuahang like '%" . $tencuahang . "%'";
		if ($ngay != "")
			$sql_where .= " and thangnam like '%" . $ngay . "%'";
		$sql .= $sql_where;
		// echo $sql;
		error_reporting(E_ALL ^ E_NOTICE);

		if ($them) {
			$template->parse("main.block_cusupdate");
		}
		//$SOST = 0 ;
		// phan trang===================================================================
		$sql = "SELECT ID FROM doanhthukhoan $sql_where ";
		$query_rows = $data->query($sql);
		$num = $data->num_rows($query_rows);

		$page_start = 0;
		$page_row = 20;
		include("paging.php");
		$list_page = paging($num);


		$sql = "SELECT a.ID,a.sotien , a.datduoc , a.thangnam,b.Name as tencuahang , b.macuahang  as ma , a.thangnam FROM doanhthukhoan a INNER JOIN cuahang b ON b.ID = a.idcuahang" . $sql_where . " ORDER BY a.ID desc, a.ID limit $page_start,$page_row ";
		// echo $sql;
		$query_rows = $data->query($sql);
		$result_rows = $data->num_rows($query_rows);
		$result = $data->query($sql);
		$i = $page_start;
		//=========================================================
		$SOST = $page_start;
		while ($result_news = $data->fetch_array($result)) {
			if ($mau == "white")
				$mau = "#EEEEEE";
			else
				$mau = "white";
			$SOST = $SOST + 1;

			$template->assign("color", $mau);
			$template->assign("ID", $result_news["ID"]);
			$template->assign("stt", $SOST);
			$template->assign("sotien", $result_news["sotien"]);
			$template->assign("macuahang", $result_news["ma"]);
			$template->assign("tencuahang", $result_news["tencuahang"]);
			$template->assign("thangnam", $result_news["thangnam"]);
			$template->assign("chitieu1ngay", $sotiencon);

			$template->parse("main.block_khht");
			$template->parse("main.block_khht2");
			$i++;
		}

		$template->assign("list_page", $list_page);  // phan trang
		$template->parse("main.block_proht2");
	} else {

		if ($_REQUEST["id"] == "-1") {
			$template->assign("t-c", "Thêm mới  ");
			$template->assign("idgoi", $_POST["id"]);
			$template->assign('muccha', composx('cuahang', 'Name', '', ""));
		} else {
			$sql = "SELECT * FROM  doanhthukhoan  WHERE ID='" . $_REQUEST["id"] . "'";
			// echo $sql;
			$query = $data->query($sql);
			$result = $data->fetch_array($query);
			$thangnam = $result["thangnam"];
			$template->assign("t-c", "Cập nhập");
			$template->assign("sotien", $result["sotien"]);
			$template->assign("macuahang", $result["macuahang"]);
			$template->assign("idcuahang", $result["idcuahang"]);
			$template->assign("datduoc", $result["datduoc"]);
			$template->assign('muccha', composx('cuahang', 'Name', $result["idcuahang"], ""));
			$thang = gmdate('m', time() + 7 * 3600) + 1;
			$nam = gmdate('Y', time() + 7 * 3600);
			$toi = 24 - $thang;
			$chuoi = '';
			for ($i = 0; $i <= $toi; $i++) {
				$thang = $thang - 1;
				if ($thang <= 0) {
					$thang = $thang + 12;
					$nam = $nam - 1;
				}
				$thangnamv = $nam . '-0' . $thang . '-01';
				if ($thangnam == $thang . $nam) $sele = "selected";
				else   $sele = "";
				if ($thang < 10)   $chuoi .= "<option value='$thangnamv' $sele>Tháng 0$thang/$nam</option> ";
				else $chuoi .= " <option value='$nam-$thang-01' $sele >Tháng $thang/$nam</option> ";
			}
			$template->assign("thangnam", $chuoi);
		}
		//$template->assign('muccha',composx('cuahang','Name','',""));
		$template->parse("main.block_kh");
	}
}



$tungay = "01/" . gmdate('m', time() + 7 * 3600) . "/" . gmdate('Y', time() + 7 * 3600);
$denngay = gmdate('d/m/Y', time() + 7 * 3600);
$template->assign("tungay", $tungay);
$template->assign("denngay", $denngay);



$data->closedata();



