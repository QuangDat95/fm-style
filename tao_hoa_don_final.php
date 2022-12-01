<?php


// $data= array(
//     "Erorr"=> 0,
//     "diachi"=> "280 Lý Thường Kiệt, Hội An, Quảng Nam",
//     "thungan"=> "Thu ngân ca 01 CH 214 Lý Thường Kiệt, HA",
//     "mahoadon"=> "B22024.1014.3549",
//     "ngaytao"=> "26/02/2022",
//     "tuvan"=> "Trương Thị Ngọc Trâm",
//     "khachhang"=> "Anh Tuấn",
//     "diemtichluy"=> "2060",
//     "voucher"=> "",
//     "trigia"=> "0",
//     "cuoibill"=> " - Sinh nhật được tặng voucher giảm 50k/100k/150k/200k theo hạng thành viên tương ứng Kết nối/Đồng/Bạc/Vàng/Kim Cương. \n- Lễ Tết mua hàng theo chính sách cực ưu đãi. \n- Đổi hàng trong vòng 03 ngày (được đổi 01 lần)  \n- Bảo hành sản phẩm trong vòng 30 ngày (KH thành viên), 07 ngày (khách lẻ). \n- Sản phẩm phải còn nhãn, hóa đơn, còn nguyên vẹn, không bị dơ bẩn, không có mùi đã qua sử dụng/giặt tẩy. \n- Hàng đổi có giá trị ≥ hàng đã mua. \n- Hàng KM, hàng len/dệt kim/ren/da, quần legging, áo lông/dạ, phụ kiện không được đổi trả. \n- Mọi thắc mắc vui lòng liên hệ: 0901 800 888 ( phím 8) \nCảm ơn Quý Khách đã mua sắm tại Fm Style!",
//     "tongcong"=> "584000",
//     "bangchu"=> "N&#259;m tr&#259;m t&#225;m m&#432;&#417;i b&#7889;n ng&#224;n &#273;&#7891;ng ch&#7861;n",
//     "thongtin"=> [
//         [
//             "210704113",
//             "Khoac nhung nu 2 tui nap bo lai_Kem",
//             "169000",
//             "1",
//             "100"
//         ],
//         [
//             "21061709",
//             "Khoac gio mu 2 lop Addition",
//             "345000",
//             "1",
//             "0"
//         ],
//         [
//             "211016165",
//             "Khoác nhung nữ mũ 2 túi bo thun lai_Vàng",
//             "239000",
//             "1",
//             "0"
//         ],
//         [
//             "21060630",
//             "Khoac gio mu 2 lop mau",
//             "325000",
//             "1",
//             "100"
//         ]
//     ]
// );
//var_dump($data);
//tao hoa don
// xulysdulieutraanh($data);
function xulysdulieutraanh($data, $uid)
{


    // $data=$data;
    if ($data["Erorr"] == 0) {
        # code...


        $noidungfootertam = $data["cuoibill"];


        $noidungfootertam = explode('"\n', $noidungfootertam);
        //  echo "<pre>";
        //         var_dump($noidungfootertam);
        //         echo "<pre>"; 
        // // $noidungfootertam=str_replace('"',"",$noidungfootertam);

        // // $noidungfootertam=explode("-",$noidungfootertam);

        $noidungfooter = '';
        foreach ($noidungfootertam as $key => $value) {
            $tamval = explode(" ", $value);
            if (count($tamval) > 14) {

                $tamval[14] = "\n" . $tamval[14];
                $tamc = implode(" ", $tamval);
                $noidungfooter .= str_replace('"', "", $tamc);
            } else {
                $noidungfooter .= str_replace('"', "", $value);
            }
        }

        $dataloop = [
            // array(

            // "Stt_count" => "1",

            // "Masp_count" => "2114578456", //Hóa đơn

            // "Tensp_count" => "Áo thun ba lỗ của độ mixi bábc ábc stne sbes áb các bạn ơi", //Hóa đơn

            // "soluong_count" => "1", //Hóa đơn

            // "dongia_count" => "265000", //Hóa đơn

            // "ck_count" => "0", //Hóa đơn

            // "thanhtien_count" => "265000", //Hóa đơn

            // ),

        ];



        // xu ly san pham
        $i = 0;
        $tongcong = 0;
        $tongchietkhau = 0;
        $mangthongtinsp = $data["thongtin"];
        for ($i = 0; $i < count($mangthongtinsp); $i++) {
            $value = $mangthongtinsp[$i];
            //$chietkhau =$value[]*$value["chieckhau"]/100; // dongia * chietkhau/100
            $ck = $value[2] * $value[4] / 100; // dongia * chietkhau/100
            $chietkhau = $value[4];

            $gia =  $value[2]; // dongia - chietkhau
            $thanhtien = ($gia * $value[3]) - $ck; // gia * soluong
            $tongchietkhau +=  $ck * $value[3]; // chietkhau * soluong
            $tongcong +=  ($thanhtien);


            $tam = [];
            $tam["Stt_count"] = $i;
            $tam["Masp_count"] = $value[0];
            $tam["Tensp_count"] = $value[1];
            $tam["soluong_count"] = $value[3];
            $tam["dongia_count"] = $value[2];
            $tam["ck_count"] = $chietkhau;
            //tam["ck_count"]=$value[4];
            $tam["thanhtien_count"] = $thanhtien;
            $tam["tongcong"] = $tongcong;
            array_push($dataloop, $tam);
        }




        $dataheader = [

            "voucherCode" => 'FM STYLE', //Reply

            "logo" => "logo.png",

            "eftCardNo" => '123123', //Cash registration card number

            "recAccount" => 'HỆ THỐNG THỜI TRANG FM STYLE', //Collection account

            "info_store" => $data["diachi"], // thong tin

            "info_hotline" => "Hotline: 0901 800 888 - Website: www.fm.com.vn", // thong tin

            "Sale_off" => "HÓA ĐƠN BÁN LẺ", //Hóa đơn

            "mahoadon" => $data["mahoadon"], //Hóa đơn

            "ngaytao" => $data["ngaytao"], //Hóa đơn
            "thungan" => $data["thungan"], //Hóa đơn
            "tuvan" => $data["tuvan"], //Hóa đơn
            "diemtichluy" => $data["diemtichluy"], //Hóa đơn
            // table

            "Stt" => "TT", //Hóa đơn

            "Masp" => "Mã SP", //Hóa đơn

            "Tensp" => "Tên sản phẩm", //Hóa đơn

            "dongia" => "Đơn giá", //Hóa đơn

            "ck" => "CK", //Hóa đơn

            "thanhtien" => "Thành tiền", //Hóa đơn

            "sum_title" => "Tổng tiền thanh toán", //Hóa đơn
            "tongtiendon" => $data["tongcong"], //Hóa đơn
            "bangchu" => $data["bangchu"], //Hóa đơn
            "tongchietkhau" => $tongchietkhau, //Hóa đơn

        ];

        return array("link" => create_table($noidungfooter, $dataloop, $dataheader, $uid));
    } else {
        return array("mess" => "không có dữ liệu");
    }
}





function create_table($noidungfooter, $dataloop, $dataheader, $user_id)
{

    $data = $dataheader;

    $params = [

        'row' => 5, //Number of data

        'file_name' => $user_id . '.png',

        'data' => $data

    ];

    $base = [

        'border' => 10, //Photo frame

        'file_path' => 'images/', //Picture saving path

        'title_height' => 210, //Report name height

        'title_font_size' => 16, //Report name font size

        'font_ulr' => 'OpenSans-Bold.ttf', //Font file path

        'font_ulr_thin' => 'OpenSans-VariableFont.ttf', //font thin

        'text_size' => 12, //Text font size

        'font_weight' => 100,

        'text_size_text' => 10, //Text font size

        'row_hight' => 30, //Each line of data is high

        'filed_id_width' => 60, //Sequence column width

        'filed_name_width' => 160, //The width of the player name

        'filed_data_width' => 100, //Data column width

        'Table_Header' => ['serial number', 'nickname', 'data 1', 'Data 2', 'Data 3', 'Data 4', 'Data 5'], //Head text

        'column_text_offset_arr' => [45, 90, 55, 55, 55, 65, 65], //Header text left offset

        'row_text_offset_arr' => [50, 110, 90, 90, 90, 90, 90], //Data column text left offset

        'cell_width' => 80, //Minimum cell width

    ];
    // header('Content-Type: image/jpeg');

    // echo $k;

    $count = (count($dataloop) - 1);

    $base['img_width'] = $base['filed_id_width'] + $base['filed_name_width'] + $base['filed_data_width'] * 5 + $base['border'] * 2; //Picture width

    $base['img_height'] = $params['row'] * $base['row_hight'] + $base['row_hight'] * 3.2 * $count + $base['border'] * 2 + $base['title_height']; //Picture height

    $border_top = $base['border'] + $base['title_height']; //Top height

    $border_bottom = $base['img_height'] - $base['border']; //Table bottom height

    $base['column_x_arr'] = [

        $base['border'] + $base['filed_id_width'], //First column edge frame X-axis pixel

        $base['border'] + $base['filed_id_width'] + $base['filed_name_width'], //The second column edge frame X-axis pixel

        $base['border'] + $base['filed_id_width'] + $base['filed_name_width'] + $base['filed_data_width'] * 1, //Third column frame line X-axis pixels

        $base['border'] + $base['filed_id_width'] + $base['filed_name_width'] + $base['filed_data_width'] * 2, //Fourth column frame line X-axis pixel

        $base['border'] + $base['filed_id_width'] + $base['filed_name_width'] + $base['filed_data_width'] * 3, //Fifth Loop Border Wire X-axis

        $base['border'] + $base['filed_id_width'] + $base['filed_name_width'] + $base['filed_data_width'] * 4, //Fifth Loop Border Wire X-axis

        $base['border'] + $base['filed_id_width'] + $base['filed_name_width'] + $base['filed_data_width'] * 5, //Fifth Loop Border Wire X-axis

    ];
    $caohinh = $base['img_height'] + 320;

    //$caohinh=$caohinh-$base['img_height'];

    $img = imagecreatetruecolor($base['img_width'], $caohinh); //Create a specified size picture

    $bg_color = imagecolorallocate($img, 255, 255, 190); //Set the picture background color

    $text_coler = imagecolorallocate($img, 0, 0, 0); //Set text color

    $border_coler = imagecolorallocate($img, 0, 0, 0); //Set border color

    $white_coler = imagecolorallocate($img, 255, 255, 255); //Set border color

    imagefill($img, 0, 0, $bg_color); //Fill picture background color

    // Pack a black bulk background
    //Khung của bảng

    $caokhung = $caohinh - 320;

    imagefilledrectangle($img, $base['border'], $base['border'] + $base['title_height'], $base['img_width'] - $base['border'], $caokhung, $border_coler);

    imagefilledrectangle($img, $base['border'] + 2, $base['border'] + $base['title_height'] + 2, $base['img_width'] - $base['border'] - 2, $caokhung - 2, $bg_color); //Draw rectangle

    //zll begin------------------

    //===== CỘT DỌC CỦA TIÊU ĐỀ BẢNG =====

    imageline($img, ($base['img_width'] - $base['border']) / 3 + $base['filed_name_width'] / 2, $border_top + $base['row_hight'] - 30, ($base['img_width'] - $base['border']) / 3 + $base['filed_name_width'] / 2, $border_top + $base['row_hight'], $border_coler);

    imageline($img, ($base['img_width'] - $base['border']) - (50 * 6) + $base['filed_name_width'] / 3, $border_top + $base['row_hight'] - 30, ($base['img_width'] - $base['border']) - (50 * 6) + $base['filed_name_width'] / 3, $border_top + $base['row_hight'], $border_coler);

    imageline($img, ($base['img_width'] - $base['border']) / 2 + $base['filed_name_width'] / 2, $border_top + $base['row_hight'] - 30, ($base['img_width'] - $base['border']) / 2 + $base['filed_name_width'] / 2, $border_top + $base['row_hight'], $border_coler);
    ///=== KẺ DỌC CỐ ĐỊNH CỦA BẢNG (không thay đổi) ===///

    /// 3 KẺ DỌC NÀY SẼ ĐI TỪ ĐẦU ĐẾN CUỐI BẢNG ///

    //border tăng chiều cao 1

    imageline($img, ($base['img_width'] - $base['border']) / 15 + $base['filed_name_width'] / 15, $border_top + $base['row_hight'] - 30, ($base['img_width'] - $base['border']) / 15 + $base['filed_name_width'] / 15, $caokhung, $border_coler);

    //border tăng chiều cao 2

    imageline($img, ($base['img_width'] - $base['border']) / 5 + $base['filed_name_width'] / 15, $border_top + $base['row_hight'] / 11, ($base['img_width'] - $base['border']) / 5 + $base['filed_name_width'] / 15, $caokhung, $border_coler);

    //border tăng chiều cao 3

    //==== CỘT NGANG TIÊU ĐỀ BẢNG ====

    imageline($img, $base['border'], $border_top + $base['row_hight'], $base['img_width'] - $base['border'], $border_top + $base['row_hight'], $border_coler);



    //Start writing ------

    //==== XỬ LÝ LOGO ====

    //$dest = imagecreatefrompng ('logo.png');



    // imagepng($src);

    // imagedestroy($dest);

    // imagedestroy($dest);



    //====  ====

    // imagettftext($img, $base['text_size'], 0, $base['img_width'] / 2 + $base['cell_width'] - 140 * 3, $border_top + $base['row_hight'] - 45 * 5, $text_coler, $base['font_ulr'], $data['recAccount']);

    // header title fm

    imagettftext($img, $base['text_size'], 0, $base['img_width'] / 2 + $base['cell_width'] * 2 + (-150), $border_top + $base['row_hight'] - 45 * 5, $text_coler, $base['font_ulr'], $data['recAccount']);

    //thông tin công ty

    imagettftext($img, $base['text_size_text'], 0, $base['img_width'] / 2 + $base['cell_width'] * 2 + (-150), $border_top + $base['row_hight'] - 42 * 5, $text_coler, $base['font_ulr_thin'], $data['info_store']);

    //thông tin liên hệ

    imagettftext($img, $base['text_size_text'], 0, $base['img_width'] / 2 + $base['cell_width'] * 2 + (-150), $border_top + $base['row_hight'] - 39 * 5, $text_coler, $base['font_ulr_thin'], $data['info_hotline']);

    // Hóa đơn bán lẻ

    imagettftext($img, $base['text_size'], 0, $base['img_width'] / 2 + $base['cell_width'] - 150, $border_top + $base['row_hight'] - 34 * 5, $text_coler, $base['font_ulr'], $data['Sale_off']);

    imageline($img, $base['filed_name_width'] / 12, $border_top + $base['row_hight'] - 33 * 5, ($base['img_width'] - $base['border']) / 1, $border_top + $base['row_hight'] - 33 * 5, $border_coler);



    // Hóa đơn bán lẻ

    imagettftext($img, $base['text_size'], 0, $base['img_width'] / 2 + $base['cell_width'] - 150, $border_top + $base['row_hight'] - 34 * 5, $text_coler, $base['font_ulr'], $data['Sale_off']);



    imagettftext($img, $base['text_size_text'], 0, $base['img_width'] / 2 + $base['cell_width'] - 110 * 4 + 15, $border_top + $base['row_hight'] - 30 * 5, $text_coler, $base['font_ulr_thin'], "Số: " . $data['mahoadon']);

    imagettftext($img, $base['text_size_text'], 0, $base['img_width'] / 2 + $base['cell_width'] - 70 * 4 + 15, $border_top + $base['row_hight'] - 30 * 5, $text_coler, $base['font_ulr_thin'], "Ngày: " . $data['ngaytao']);

    imagettftext($img, $base['text_size_text'], 0, $base['img_width'] / 2 + $base['cell_width'] - 110 * 4 + 15, $border_top + $base['row_hight'] - 25 * 5, $text_coler, $base['font_ulr_thin'], "Thu ngân: " . $data['thungan']);

    imagettftext($img, $base['text_size_text'], 0, $base['img_width'] / 2 + $base['cell_width'] - 110 * 4 + 15, $border_top + $base['row_hight'] - 20 * 5, $text_coler, $base['font_ulr_thin'], "Tư vấn: " . $data['tuvan']);

    imagettftext($img, $base['text_size_text'], 0, $base['img_width'] / 2 + $base['cell_width'] - 110 * 4 + 15, $border_top + $base['row_hight'] - 15 * 5, $text_coler, $base['font_ulr_thin'], "Khách hàng: " . $data['khachhang'] . " - " . "Tích lũy: " . $data['diemtichluy']);



    // header-table

    imagettftext($img, $base['text_size'], 0, $base['img_width'] / 2 + $base['cell_width'] - 110 * 4 + 15, $border_top + $base['row_hight'] - 8, $text_coler, $base['font_ulr'], $data['Stt']);

    imagettftext($img, $base['text_size'], 0, $base['img_width'] / 2 + $base['cell_width'] - 75 * 5 + 10, $border_top + $base['row_hight'] - 8, $text_coler, $base['font_ulr'], $data['Masp']);

    imagettftext($img, $base['text_size'], 0, $base['img_width'] / 2 + $base['cell_width'] - 55 * 5 + 10, $border_top + $base['row_hight'] - 8, $text_coler, $base['font_ulr'], $data['Tensp']);

    imagettftext($img, $base['text_size'], 0, $base['img_width'] / 2 + $base['cell_width'] - 20 * 5 + 10, $border_top + $base['row_hight'] - 8, $text_coler, $base['font_ulr'], $data['dongia']);

    imagettftext($img, $base['text_size'], 0, $base['img_width'] / 2 + $base['cell_width'], $border_top + $base['row_hight'] - 8, $text_coler, $base['font_ulr'], $data['ck']);

    imagettftext($img, $base['text_size'], 0, $base['img_width'] / 2 + $base['cell_width'] + 90, $border_top + $base['row_hight'] - 8, $text_coler, $base['font_ulr'], $data['thanhtien']);



    $rowh1 = $base['row_hight'] + 9 * 4;

    $rowh2 = $base['row_hight'];

    //$cottang1=1;

    $cotchung = $border_top + $base['row_hight'];

    $cottang2 = 3;

    $cottang3 = 4;

    $cot2 = $border_top + $base['row_hight'] * $cottang2;

    $cot3 = $border_top + $base['row_hight'] * $cottang3;


    $y = $border_top + $base['row_hight'] + 9 * 4;

    $y2 = $border_top + $base['row_hight'] + 20 * 4;

    $k = 0;



    $tongtien = 0;

    foreach ($dataloop as $key => $value) {

        //Dòng sản phẩm 1 - body table 1

        //$cottang1=$cottang1==0?1:$cottang1;



        imagettftext($img, $base['text_size'], 0, $base['img_width'] / 2 + $base['cell_width'] - 110 * 4 + 15, $y, $text_coler, $base['font_ulr_thin'], $value['Stt_count']);

        imagettftext($img, $base['text_size_text'], 0, $base['img_width'] / 2 + $base['cell_width'] - 75 * 5, $y, $text_coler, $base['font_ulr_thin'], $value['Masp_count']);

        imagettftext($img, $base['text_size_text'], 0, $base['img_width'] / 2 + $base['cell_width'] - 55 * 5 + 10, $y, $text_coler, $base['font_ulr_thin'], $value['Tensp_count']);





        $tongtiensp = $value['dongia_count'] * $value['soluong_count'];

        //Dòng sản phẩm 2 - body table 2

        imagettftext($img, $base['text_size_text'], 0, $base['img_width'] / 2 + $base['cell_width'] - 55 * 5 + 10, $y2, $text_coler, $base['font_ulr_thin'], "SL: " . $value['soluong_count']);

        imagettftext($img, $base['text_size_text'], 0, $base['img_width'] / 2 + $base['cell_width'] - 20 * 5 + 10, $y2, $text_coler, $base['font_ulr_thin'], number_format($value['dongia_count']));





        imagettftext($img, $base['text_size_text'], 0, $base['img_width'] / 2 + 10 + $base['cell_width'], $y2, $text_coler, $base['font_ulr_thin'], $value['ck_count']);





        imagettftext($img, $base['text_size_text'], 0, $base['img_width'] / 2 + $base['cell_width'] + 90, $y2, $text_coler, $base['font_ulr_thin'], number_format($value['thanhtien_count']));



        //Phân dòng hàng ngang của - phân cách từng sản phẩm

        //imageline($img, $base['filed_name_width'] / 12, $cot1, ($base['img_width'] - $base['border']) / 1, $cot1, $border_coler);

        imageline($img, $base['border'] + 146, $cot2, $base['img_width'] - $base['border'], $cot2, $border_coler);

        imageline($img, $base['border'], $cot3, $base['img_width'] - $base['border'], $cot3, $border_coler);



        ///Phân dòng hàng dọc của SL, đơn giá, và thành tiền của sản phẩm (kẻ dọc này đi cùng từng sản phẩm)

        imageline($img, ($base['img_width'] - $base['border']) - (50 * 6.7) + $base['filed_name_width'] / 3, $y2 - $base['row_hight'] + 10, ($base['img_width'] - $base['border']) - (50 * 6.7) + $base['filed_name_width'] / 3, $y2 + 10, $border_coler);





        imageline($img, ($base['img_width'] - $base['border']) - (50 * 6) + $base['filed_name_width'] / 3, $y2 - $base['row_hight'] + 10, ($base['img_width'] - $base['border']) - (50 * 6) + $base['filed_name_width'] / 3, $y2 + 10, $border_coler);





        imageline($img, ($base['img_width'] - $base['border']) / 3 + $base['filed_name_width'] / 2, $border_top + $base['row_hight'] + 90, ($base['img_width'] - $base['border']) / 3 + $base['filed_name_width'] / 2, $border_top + $base['row_hight'] + 60, $border_coler);

        $tongtien += $value['thanhtien_count'];
        $y += $rowh1 + $rowh2;

        $y2 += $rowh1 + $rowh2;

        $cot2 += $rowh1 + $rowh2;
        $cot3 += $rowh1 + $rowh2;

        //$cottang1+=$y;

        //$cottang2+=3;

        //$cottang3+=4;

        $k++;

        // echo $k."<br>";
    }
    //footer-table

    //=== GẠCH DỌC TỔNG TIỀN THANH TOÁN ===

    $caokhungBt = $caokhung - 10;

    imageline($img, ($base['img_width'] - $base['border']) - (50 * 6) + $base['filed_name_width'] / 3, $caokhung - $base['row_hight'] - 10, ($base['img_width'] - $base['border']) - (50 * 6) + $base['filed_name_width'] / 3, $caokhung, $border_coler);

    imagettftext($img, $base['text_size'], 0, $base['img_width'] / 2 + $base['cell_width'] - 55 * 5 + 10, $caokhungBt, $text_coler, $base['font_ulr'], $data['sum_title']);

    imagettftext($img, $base['text_size_text'], 0, $base['img_width'] / 2 + $base['cell_width'] + 90, $caokhungBt, $text_coler, $base['font_ulr'], number_format($data["tongcong"]));
    //=== thông tin thêm ===

    /// footer
    imagettftext($img, $base['text_size_text'], 0, $base['img_width'] / 2 + $base['cell_width'] - 110 * 4 + 15, $caokhung + 30, $text_coler, $base['font_ulr_thin'], "Tổng bằng chữ: " . $data['bangchu']);
    imagettftext($img, $base['text_size_text'], 0, $base['img_width'] / 2 + $base['cell_width'] - 110 * 4 + 15, $caokhung + 50, $text_coler, $base['font_ulr_thin'], $noidungfooter);
    $save_path = $base['file_path'] . $params['file_name'];



    if (!is_dir($base['file_path'])) //Judging whether the storage path exists, there is no existence

    {

        mkdir($base['file_path'], 0777, true); //Create multi-level directory

    }
    imagepng($img, $save_path); //Output picture, output PNG use imagePng method, output GIF use imagegif method
    $source_image = $save_path;
    // Load the stamp and the photo to apply the watermark to

    //$im = imagecreatefrompng($save_path);

    //$stamp = imagecreatefrompng('logo1.png');

    // First we create our stamp image manually from GD
    $my_watermark = imagecreatefrompng('logo1.png');
    //Then we will get the width and height of the watermark image.
    //We will use these dimensions to locate it fit position.
    $watermark_width = imagesx($my_watermark);
    $watermark_height = imagesy($my_watermark);
    //So now we are going to create our image component from the source image.
    $image = imagecreatefrompng($source_image);
    //and we get its dimensions
    $image_size = getimagesize($source_image);
    //Then we specify the position of the watermark.
    //We wll locate it right under corner of the image with 20px margin from edges.
    $wm_x = $watermark_width - 70;
    $wm_y = $watermark_height - 95;

    //Then we are copying the watermark image on created image component with configured locations and dimensions.

    imagecopy($image, $my_watermark, $wm_x, $wm_y, 0, 0, $watermark_width, $watermark_height);

    //Lastly show the image on the screen. Do not forget to set header as image of the page.

    imagepng($image, $save_path);
    //And destroy variables to prevent using memory.

    imagedestroy($image);

    imagedestroy($my_watermark);
    //echo '<img src="./' . $save_path . '"/>';
    return $save_path;
}

function get_OrderNew($user_id, $user_phone)
{
    $curl = curl_init();
    $field = array("loai" => 1, "user_id" => $user_id, "user_phone" => $user_phone);
    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://siandchip.vn/zalo_tracubill.php',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => json_encode($field), //{"loai":"1","user_id":"1593994626189841293","user_phone":"0942118018"}
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json',
            'Cookie: PHPSESSID=9bb1ua01s9qp9n4a01q6st7dk4'
        ),
    ));
    $response = curl_exec($curl);

    curl_close($curl);
    //echo $response;
    return $response;
}
// ket thuc tao hoa don
