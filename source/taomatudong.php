<?php
session_start();
if ($_SESSION["dangnhap"] == "") {
    return;
}
$IDTao = $_SESSION["LoginID"];

$_SESSION["frm_xuathang"] = "";
if (!defined("IN_SITE")) {
    die("Hacking attempt!");
}

//=============================khoi tao ======================//  	 Xem  	 Them  	 Cap nhap  	 Tim  	Huy  	Khoa  	In
$data->setthaotac = "customer";

//$template->assign("khuvuc",composx("tinh", "Name", $_REQUEST["IDKhuVuc"], "", ""));

//=====================================================
$ql = $quyen[$_SESSION["mangquyenid"][$act]];
if (!($ql[0] || $idl == 1)) {
    echo "Bạn không có phân quyền";
    exit();
    return;
}

if ($ql[1] > 0 || $idl == 1) {
    $template->assign("q_luu", "");
} else {
    $template->assign("q_luu", "none");
}
if ($ql[2] > 0 || $idl == 1) {
    $template->assign("q_khoa", "");
} else {
    $template->assign("q_khoa", "none");
}
if ($ql[3] > 0 || $idl == 1) {
    $template->assign("q_huy", "");
} else {
    $template->assign("q_huy", "none");
}
if ($ql[4] > 0 || $idl == 1) {
    $template->assign("q_xoa", "");
} else {
    $template->assign("q_xoa", "none");
}
//=====================================================

$donglai = "none";
if (trim($_REQUEST["t5"]) != "") {
    $donglai = "";
}
 $template->assign("idk",$IDTao); 
//============= ==========================================================================
$template->assign("size", composx("size", "Name", "ID", "  order by Name "));
$template->assign("mau", composx("mausac", "Name", "ID", "  order by Name "));
$template->assign("nhacungcap", compoloai("nhacungcap", "Fax","Name", "ID", "  order by Name "));
$template->assign("nhomhang", composx("groupproduct","CONCAT(ma,'-',Name)", "ID", "  order by Name "));
$template->assign("nganhhang", composx("nhomhang","CONCAT(manhomhang,'-',Name)", "ID", "  order by Name "));

$sql="select * from mausac";
$query=$data->query($sql);
$chuoimau='';
while($r=$data->fetch_array($query)){
	
	  $chuoimau.='<div>
					<div><input type="checkbox" class="jsmau" name="mau[]" id="mau'.$r["ID"].'" style="cursor:pointer" value="'.$r["ID"].'" data-name="'.$r["Name"].'"  data-ma="'.$r["ma"].'"/></div>
												<label for="mau'.$r["ID"].'" style="margin-left:0.5em;cursor:pointer">'.$r["manhomhang"].' - '.$r["Name"].'</label>
											</div>';
}
$template->assign("chuoimau",$chuoimau);
$sql="select * from size";
$chuoisize='';
$query=$data->query($sql);
while($r=$data->fetch_array($query)){

	  $chuoisize.='<div>
												<div><input type="checkbox" name="size[]" id="size'.$r["ID"].'" style="cursor:pointer" value="'.$r["ID"].'" data-name="'.$r["Name"].'"  data-ma="'.$r["ma"].'" class="jssize"/></div>
												<label for="size'.$r["ID"].'" style="margin-left:0.5em;cursor:pointer">'.$r["manhomhang"].' - '.$r["Name"].'</label>
											</div>';
}
$template->assign("chuoisize",$chuoisize);
$chuoithang='';
$crrentt=date('m');
for($i=0;$i<=12;$i++){
$sel=$crrentt==$i?"selected":"";
	$chuoithang.='<option value="'.$i.'" '.$sel.'>'.$i.'</option>';
}
 $template->assign("chuoithang",$chuoithang);
 
 $chuoinam='';
 $crrenty=date("Y");
for($i=$crrenty-10;$i<=$crrenty+10;$i++){
	$sel=$crrenty==$i?"selected":"";
	$chuoinam.='<option value="'.$i.'" '.$sel.'>'.$i.'</option>';
}
 $template->assign("chuoinam",$chuoinam);
//============= ==========================================================================
if ($ql[5] || $idl == 1) {
    $template->assign(
        "cuahangnhan",
        composx("cuahang", "Name", "ID", " where ID>1 order by ID ")
    );
    $template->assign("tatca", ' <option value="" >Tất cả</option>');
} else {
    // $template->assign("kho",composx("cuahang","Name","ID"," where ID>1 order by ID "));
    $template->assign(
        "cuahangnhan",
        composx(
            "cuahang",
            "Name",
            "ID",
            " where ID= $_SESSION[se_kho]  order by ID "
        )
    );
}

if ($_POST["cancel"] != "") {
    $ID = "";
    $_GET["id"] = "";
}

if ($_POST["btnUpdate"] != "") {
    $ID = laso($_POST["id"]);
	
    $sobill = chonghack($_POST["sobill"]);
	$IDbill = laso($_POST["idbill"]);
	
    $mavd = chonghack($_POST["mavd"]);
	$madh = chonghack($_POST["madh"]);
    $diachi = chonghack($_POST["diachigiaohang"]);
    $trigiadon = laso($_POST["giatridon"]);
	 $phiship = laso($_POST["phiship"]);
    $tinh = chonghack($_POST["tinhsl"]);
    $quan = chonghack($_POST["quansl"]);
    $phuong = chonghack($_POST["phuongsl"]);
   $donvivc = chonghack($_POST["nhavcv"]);
    $ngaydaydon = date("Y-n-d H:i:s");	

		// check id có tồn tại hay không
		$sql = "select sobill from vanchuyenonline";
		$getid = getdong($sql);

		if($ID){
			$sql = "UPDATE vanchuyenonline set sobill='$sobill', mavd='$mavd', diachi='$diachi', phitravc='$phiship', tinh='$tinh', quan='$quan', phuong='$phuong', ngaydaydon_dvvc='$ngaydaydon',IDbill='$IDbill',madh='$madh',donvivc='$donvivc' where ID='$ID'";
            // echo $sql; return;
		}else{
			$sql = "insert into vanchuyenonline set sobill='$sobill', mavd='$mavd', diachi='$diachi', phitravc='$phiship',trigiadon='$trigiadon', tinh='$tinh', quan='$quan', phuong='$phuong',IDbill='$IDbill', ngaydaydon_dvvc='$ngaydaydon',madh='$madh',donvivc='$donvivc'";
            //  echo $sql; return;
		}
		
        $update = $data->query($sql); 
		if($update){
			 $template->parse("main.block_capnhatthanhcong");
		}
		
		
	return;
}

$del = laso($_GET["Del"]);

if ($ktxoa == 1 || $ktxoa1 == 1) {
    $template->parse("main.block_khongxoa");
}
$IDD = $_GET["Del"];
if (
    ($IDTao == "1" ||
        $_SESSION["loai_user"] == 6 ||
        $IDTao == 5565 ||
        $IDTao == 5562) &&
    $IDD > 0
) {
    $sql = "delete from  customer where ID = '0" . $IDD . "'";
    $update = $data->query($sql);
    $xoa = true;
}

$tam = "";
$kt = 0;

if ($_REQUEST["id"] == "" || $them || $xoa || $_POST["search"] != "") {
    $template->assign(
        "nhomkh",
        composx("nhomkhachhang", "Name", $_REQUEST["nhom"], "Rank")
    );
    $template->assign("khuvuc", composx("tinh", "Name", $_REQUEST["kv"], ""));
    $NameS = chonghack($_POST["NameS"]);
    $nhom = chonghack($_POST["nhom"]);
    $nhom = chonghack($_POST["tinh"]);
    $dt = chonghack(trim($_POST["dt"]));
    $cm = chonghack(trim($_POST["cm"]));

    $template->assign("NameS", $NameS);

    $typencc = chonghack($_POST["type"]) . "";
    if ($typencc == "0") {
        $ch0 = "selected";
    }
    if ($typencc == "1") {
        $ch1 = "selected";
    }
    if ($typencc == "2") {
        $ch2 = "selected";
    }

    $nhacungcap =
        '<select name="type">
						<option value="" >Tất cả</option>
						<option value="0" ' .
        $ch0 .
        '>Xe</option>
						<option value="1" ' .
        $ch1 .
        '>Công ty</option>						
						<option value="2" ' .
        $ch2 .
        '>Cá Nhân</option>
					</select> ';

    $template->assign("type", $nhacungcap);

    $template->parse("main.block_cusht1");
    $sql = "SELECT ID FROM customer ";

    $sql_where = " where 1=1 ";
    if ($NameS != "") {
        $sql_where .= " and Name like '%" . $NameS . "%' ";
    }
    if ($nhom != "") {
        $sql_where .= " and nhomkh =  '" . $nhom . "' ";
    }
    if ($kv != "") {
        $sql_where .= " and IDKhuVuc=  '" . $kv . "' ";
    }
    if ($typencc != "") {
        $sql_where .= " and type='" . $typencc . "'";
    }

    if ($cm != "") {
        $sql_where .= " and cmnd like'%" . $cm . "%'";
    }
    if ($dt != "") {
        $sql_where .= " and mobile='%" . $dt . "%'";
    }
    $sql .= $sql_where;

    $query_rows = $data->query($sql);
    //$result_rows = $data->num_rows($query_rows);
    //$result = $data->query($sql);
    $num = $data->num_rows($query_rows);
    if ($them) {
        $template->parse("main.block_cusupdate");
    }
    //$SOST = 0 ;
    // phan trang===================================================================
    if ($sapxep == "") {
        $sapxep = "ID";
    }
    $template->assign("sapxep" . $sapxep, "selected");
    $page_start = 0;
    include "paging.php";
    $list_page = paging($num);
    $page_row = 20;
    $sql =
        "SELECT * FROM customer " .
        $sql_where .
        " ORDER BY $sapxep desc limit $page_start,$page_row ";
    //  echo $sql ;
    $query_rows = $data->query($sql);
    $result_rows = $data->num_rows($query_rows);
    $result = $data->query($sql);
    $i = $page_start;
    //=========================================================

    while ($result_news = $data->fetch_array($result)) {
        if ($mau == "white") {
            $mau = "#EEEEEE";
        } else {
            $mau = "white";
        }

        $template->assign("color", $mau);
        $template->assign("ID", $result_news["ID"]);
        $template->assign("stt", $i + 1);
        $template->assign("Name", $result_news["Name"]);
        $template->assign("address", $result_news["address"]);
        $SoDienThoai = $result_news["tel"];
        if (trim($SoDienThoai) == "") {
            $SoDienThoai = $result_news["mobile"];
        }
        $template->assign("SoDienThoai", $SoDienThoai);
        $template->parse("main.block_cusht");
        $i++;
    }
    $template->assign("list_page", $list_page); // phan trang
    $template->parse("main.block_cusht2");
	$template->parse("main.block_cus");
} 
$template->assign("goitim", "document.getElementById('search2').click()   ;");

if (!($_SESSION["se_kho"] == 1 && $_SESSION["loai_user"] == 6)) {
    $template->parse("main.block_kt");
}
$template->parse("main.block_ajack");

?>