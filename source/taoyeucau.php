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

$urlpath = $_SERVER['SERVER_NAME'] . dirname($_SERVER['PHP_SELF']) . "/";

//=============================khoi tao ======================//  	 Xem  	 Them  	 Cap nhap  	 Tim  	Huy  	Khoa  	In
$data->setthaotac = "customer";

//=====================================================
// $ql = $quyen[$_SESSION["mangquyenid"][$act]];
// if (!($ql[0] || $idl == 1)) {
//     echo "Bạn không có phân quyền";
//     exit();
//     return;
// }

// if ($ql[1] > 0 || $idl == 1) {
//     $template->assign("q_luu", "");
// } else {
//     $template->assign("q_luu", "none");
// }
// if ($ql[2] > 0 || $idl == 1) {
//     $template->assign("q_khoa", "");
// } else {
//     $template->assign("q_khoa", "none");
// }
// if ($ql[3] > 0 || $idl == 1) {
//     $template->assign("q_huy", "");
// } else {
//     $template->assign("q_huy", "none");
// }
// if ($ql[4] > 0 || $idl == 1) {
//     $template->assign("q_xoa", "");
// } else {
//     $template->assign("q_xoa", "none");
// }
//=====================================================

// $donglai = "none";
// if (trim($_REQUEST["t5"]) != "") {
//     $donglai = "";
// }
//  $template->assign("idk",$IDTao); 
//=======================================================================================

//============= LƯU THÔNG TIN PHIẾU TẠO YÊU CẦU ==================
if (isset($_POST['taophieu'])) {
    if ($_GET['ID'] == 0) {
        $yeucau = $_POST['yeucau'];
        $chitietyeucau = $_POST['chitietyeucau'];
        $ghichu = $_POST['ghichu'];
        $nguoiduyet = implode(",", $_POST['nguoiduyet']);
        $ngaybatdau = $_POST['ngaybatdau'];
        $ngayketthuc = $_POST['ngayketthuc'];
        $bpthamgia = implode(",", $_POST['bpthamgia']);
        $truongnhom = $_POST['truongnhom'];
        $phonhom = $_POST['phonhom'];
        $ngaygiahan = $_POST['ngaygiahan'];
        $nguoitao = $_SESSION['LoginID'];
        $songuoithamgia = $_POST['songuoi'];
        $tiendocongviec = $_POST['tiendo'];
        $cacgiaidoan = implode(",", $_POST['giaidoan']);
        $ngaytao = date("Y-m-d H:i:s");
        $sogiaidoan = $_POST['sogiaidoan'];

        $filedinhkem = "";
        if (is_array($_FILES['filedinhkem'])) {
            for ($i = 0; $i < count($_FILES["filedinhkem"]["tmp_name"]); $i++) {
                $tmp_name = $_FILES["filedinhkem"]["tmp_name"][$i];
                $name = strtotime('now') . "_" . $_FILES["filedinhkem"]["name"][$i];
                $name = str_replace(" ", "-", $name);

                $mtype = array("image/jpeg", "image/pjpeg", "image/png", "image/x-png", 'image/gif', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 'application/vnd.ms-excel.sheet.macroEnabled.12', 'application/vnd.ms-excel', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', '');
                $type = $_FILES["filedinhkem"]["type"][$i];

                $filesize = filesize($_FILES["filedinhkem"]["tmp_name"][$i]);

                if (in_array($type, $mtype)) {
                    //10MB
                    if ($filesize <= 10485760) {
                        // move_uploaded_file($tmp_name, $noichua."anhnho/" . $name);
                        $filedinhkem .= $name . ",";
                    }
                }
            }
        }
        $sql = "insert into taoyeucau set yeucau = '$yeucau',chitietyeucau = '$chitietyeucau',ghichu = '$ghichu',nguoiduyet = '$nguoiduyet', ngaybatdau = '$ngaybatdau', ngayketthuc = '$ngayketthuc', bpthamgia = '$bpthamgia', truongnhom = '$truongnhom', phonhom = '$phonhom', ngaygiahan = '$ngaygiahan', filedinhkem = '$filedinhkem', nguoitao = '$nguoitao', songuoithamgia = '$songuoithamgia', tiendo = '$tiendocongviec', cacgiaidoan = '$cacgiaidoan', ngaytao = '$ngaytao', sogiaidoan = '$sogiaidoan'";
    } else {
        $ghichu = $_POST['ghichu'];
        $tiendo = $_POST['tiendo'];
        $ngaygiahan = $_POST['ngaygiahan'];

        $sql = "Update taoyeucau set ghichu = '$ghichu', tiendo = '$tiendo', ngaygiahan = '$ngaygiahan' where ID = $_GET[ID]";
    }

    // echo $sql;
    $data->query($sql);
}

if (isset($_GET['ID'])) {

    $outpust = compousers("userac","");
    $template->assign("nguoiduyets", $outpust);
    $template->assign("truongnhom", $outpust);
    $template->assign("phonhom", $outpust);
    $template->assign("bpthamgia", $outpust);
    // echo $outpust;
    //Xử lý thêm mới hoặc xem và sửa
    if ($_GET['ID'] != 0) {
        $sql = "Select * from taoyeucau where ID = " . $_GET['ID'];
        $rows = getdong($sql);

        $ngaytao = $rows['ngaytao'];
        $ngaybatdau = $rows['ngaybatdau'];
        $ngayketthuc = $rows['ngayketthuc'];
        $ngaygiahan = $rows['ngaygiahan'];
        $yeucau = $rows['yeucau'];
        $chitietyeucau = $rows['chitietyeucau'];
        $ghichu = $rows['ghichu'];
        $filedinhkem = explode(",", $rows['filedinhkem']);
        $nguoiduyet = explode(",", $rows['nguoiduyet']);
        $cacgiaidoan = $rows['cacgiaidoan'];
        $bpthamgia = $rows['bpthamgia'];
        $truongnhom = $rows['truongnhom'];
        $phonhom = $rows['phonhom'];
        $sogiaidoan = $rows['sogiaidoan'];
        $songuoithamgia = $rows['songuoithamgia'];
        $tiendocongviec = $rows['tiendo'];
        $sogiaidoan = $rows['sogiaidoan'];

        $template->assign("ngaytao", date("d-m-YTH:i:s", strtotime($ngaytao)));
        $template->assign("ngaybatdau", date("Y-m-d", strtotime($ngaybatdau)));
        $template->assign("ngayketthuc", date("Y-m-d", strtotime($ngayketthuc)));
        $template->assign("ngaygiahan", date("Y-m-d", strtotime($ngaygiahan)));
        $template->assign("yeucau", $yeucau);
        $template->assign("chitietyeucau", $chitietyeucau);
        $template->assign("ghichu", $ghichu);
        $template->assign("nguoiduyet", $nguoiduyet);
        $template->assign("songuoi", $songuoithamgia);
        $template->assign("tiendo", $tiendocongviec);
        $template->assign("sogiaidoan", $sogiaidoan);
        $template->assign("disableinput", "disabled='disabled'");
        $template->assign("cacgiaidoan", $cacgiaidoan);
        $template->assign("truongnhom",compousers("userac",$truongnhom));
        $template->assign("phonhom", compousers("userac",$phonhom));
        $template->assign("nguoithamgia", $rows['bpthamgia']);
        $template->assign("nguoiduyet", $rows['nguoiduyet']);

        for ($i = 0; $i < count($filedinhkem); $i++) {
            $url = "sources/downloadfile?files=" . $filedinhkem[$i];

            $template->assign("filedinhkem", "<div style='margin: 10px 0px'><a target='_blank' style='text-decoration: underline;' href='" . $url . "'>" . $filedinhkem[$i] . "</a></div>");
            $template->parse("main.block_form_request.edit_request");
        }
    }

    $template->parse("main.block_form_request");
} else {
    $loginID = $_SESSION['LoginID'];
    $sql = "Select * from taoyeucau 
    where nguoiduyet in ($loginID) 
    or bpthamgia in ($loginID)
    or nguoitao = $loginID 
    or truongnhom = $loginID 
    or phonhom = $loginID 
    order by ngaytao desc";
    $re = $data->query($sql);
    while ($rows = $data->fetch_array($re)) {
        $ngaytao = $rows['ngaytao'];
        $ngaybatdau = $rows['ngaybatdau'];
        $ngayketthuc = $rows['ngayketthuc'];
        $ngaygiahan = $rows['ngaygiahan'];
        $yeucau = $rows['yeucau'];
        $chitietyeucau = $rows['chitietyeucau'];
        $ghichu = $rows['ghichu'];
        $filedinhkem = $rows['filedinhkem'];
        $nguoiduyet = explode(",", $rows['nguoiduyet']);
        $cacgiaidoan = $rows['cacgiaidoan'];
        $bpthamgia = explode(",", $rows['bpthamgia']);
        $truongnhom = $rows['truongnhom'];
        $phonhom = $rows['phonhom'];
        $nguoidaduyet = (array) json_decode($rows['daduyet'], true); //[ID] => 1 (duyệt) -- [ID] => 0 (không duyệt)

        $template->assign("ngaytao", date("d/m/Y H:i", strtotime($ngaytao)));
        $template->assign("ngaybatdau", date("d/m/Y", strtotime($ngaybatdau)));
        $template->assign("ngayketthuc", date("d/m/Y", strtotime($ngayketthuc)));
        $template->assign("ngaygiahan", date("d/m/Y", strtotime($ngaygiahan)));
        $template->assign("yeucau", "<a href='?act=taoyeucau&ID=$rows[ID]'>" . $yeucau . "</a>");
        $template->assign("chitietyeucau", $chitietyeucau);
        $template->assign("ghichu", $ghichu);
        $template->assign("phonhom", $phonhom);
        $template->assign("IDyeucau", $rows['ID']);

        if (in_array($loginID, $nguoiduyet) && array_key_exists($loginID, $nguoidaduyet)) {
            $template->assign("duyet", "disabled='disabled'");
            $template->assign("duyet" . $nguoidaduyet[$loginID], "selected");
        } else if (in_array($loginID, $nguoiduyet) && !array_key_exists($loginID, $nguoidaduyet)) {
            $template->assign("duyet", "");
        } else {
            $template->assign("duyet", "disabled='disabled'");
        }

        if (!empty($truongnhom)) {
            $sql = "Select Ten from userac where ID = $truongnhom";
            $row = $data->query($sql);
            $row = $data->fetch_array($row);
            $template->assign("truongnhom", $row['Ten']);
        }

        $phongban = "";
        for ($j = 0; $j < count($bpthamgia); $j++) {
            $sql = "Select a.*, b.Name as tenphongban from userac a
            join rooms b
            on a.IDPhong = b.ID
            where a.ID =" . $bpthamgia[$j];
            $rs = getdong($sql);
            $phongban .= "<div><b>" . $rs['Ten'] . " - " . $rs['tenphongban'] . "</b></div>";
        }
        $template->assign("bptiepnhan", $phongban);

        for ($i = 0; $i < count($nguoidaduyet); $i++) {
            if (is_array($nguoidaduyet)) {
                if (array_key_exists($nguoiduyet[$i], $nguoidaduyet)) {
                    if ($nguoidaduyet[$nguoiduyet[$i]] == 1) {
                        $sql = "Select Ten from userac where ID = " . $nguoiduyet[$i];
                        $rs = getdong($sql);
                        $template->assign("tinhtrang", "<div><b>" . $rs['Ten'] . " đã duyệt </b></div>");
                    } else {
                        $sql = "Select Ten from userac where ID = " . $nguoiduyet[$i];
                        $rs = getdong($sql);
                        $template->assign("tinhtrang",  "<div><b>" . $rs['Ten'] . " <span style='color: red'>không duyệt</span> </b></div>");
                    }
                }
            }
            $template->parse("main.block_table_request.request_row.request_status");
        }
        $template->parse("main.block_table_request.request_row");
    }

    $template->parse("main.block_table_request");
}


function compousers($table, $idsosanh, $where = "")
{

    global $data;
    $output = "";

    $sql = "select a.Ten as tennv,a.ID, a.IDPhong as IDphongban, b.Name as tenchucvu, c.Name as tenphongban 
    from $table a 
    left join kh_chucvu b 
    on a.ChucVu = b.ID 
    left join rooms c 
    on a.IDPhong = c.ID
    $where order by a.IDPhong ";

    $result = $data->query($sql);
    $IDPhongban = "";
    $IDpb = "";
    while ($n = $data->fetch_array($result)) {
        $IDpb = $n['IDphongban'];
        if ($IDpb != $IDPhongban) {
            $output .= "<optgroup label='$n[tenphongban]'>";
        }

        if ($n["ID"] == $idsosanh) {
            $output .= "<option value='" . $n["ID"] . "' selected>" . $n["tennv"] . " - " . $n['tenchucvu'] . "</option>\n";
        } else {
            $output .= "<option value='" . $n["ID"] . "'>" . $n["tennv"] . " - " . $n['tenchucvu'] . "</option>\n";
        }
        $IDPhongban = $IDpb;
        if ($IDpb != $IDPhongban) {
            $output .= "</optgroup>";
        }
        
    }
    return $output;
}
