<?php
function doiso($so) 
{
//var  $Chu , $solop , $so1 , $tg ;
if ($so == 0 || $so == "") 
{ return "-" ; }

if ($so < 0) 
{
	$Chu = "(âm) " ;
	$so = 0 - $so ;
}
//ReDim term(10) , lop(6) , tlop(6) 

$term["1"] = " một" ;
$term["2"] = " hai";
$term["3"] = " ba";
$term["4"] = " bốn";
$term["5"] = " năm";
$term["6"] = " sáu";
$term["7"] = " bảy";
$term["8"] = " tám";
$term["9"] = " chín";

$tlop["1"] = "" ;
$tlop["2"] = " nghìn";
$tlop["3"] = " triệu";
$tlop["4"] = " tỷ";
$tlop["5"] = " nghìn tỷ";
$tlop["6"] = " triệu tỷ";

$so1 = $so ;
$solop = 1;
while ($so1 > 0)
{
	$tg = $so1 ;
	$so1 =  intval($so1 / 1000); // int coi lai
	 
	$lop[$solop] = $tg - $so1 * 1000;
	$solop = $solop + 1 ;
}
$i = $solop - 1 ;
// $Chu = ""
while ($i > 0 )
{
	$so1 = $lop[$i] ;
if ($so1 > 0 )
{
	$hangtram = intval($so1 / 100 ) ;
	$hangchuc =  intval(($so1 - $hangtram * 100)/ 10 );
	$hangdonvi = $so1 - $hangtram * 100 - $hangchuc * 10 ;
	if ($hangtram > 0 )
	{	//Chu $so hang tram c ngha $so1>=100
		$Chu = $Chu . $term[$hangtram] . " tr&#259;m" ;
	}	
//Xet chu $so hang chuc
if ( $hangchuc > 1 )
{
 	$Chu = $Chu . $term[$hangchuc] . " mươi" ;
	 
}elseif ($hangchuc == 1 )
{
	$Chu = $Chu . "mười" ;
}elseif ($hangchuc == 0 && $so1 > 100 && $hangdonvi != 0 )
{
	$Chu = $Chu . " lẻ" ;
}
// Xet ch s- hng n v"
	if ($hangdonvi != 5 && $hangdonvi != 0 && $hangdonvi != 1 )
	{
		$Chu = $Chu . $term[$hangdonvi] ;
	}
	elseif ($hangdonvi == 5 && $hangchuc != 0 )
	{ 
		$Chu = $Chu . " lăm " ;
	}
	elseif ($hangdonvi == 5 && $hangchuc == 0 )
	{ $Chu = $Chu . " năm " ;}
	elseif ($hangdonvi == 1 && $hangchuc > 1 )
	{
		$Chu = $Chu . " mốt" ; 
	}
	else
	{ $Chu = $Chu . $term[$hangdonvi] ;
	}
 
$Chu = $Chu . $tlop[$i] ;
}
// Xet lop ke tiep
$i = $i - 1 ;
} // Loop
	$Chu = trim($Chu);
	 
	if ($Chu != "" )
	{
	 $Chu = strtoupper(substr($Chu,0,1)) . substr($Chu,1,strlen($Chu) - 1) . " đồng chẵn" ;
	}
	return $Chu ;

}
function get_OrderNew($user_id,$user_phone) {
$curl = curl_init();
$field = array("loai" => 1,"user_id" => $user_id, "user_phone" => $user_phone);
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
$input_json = get_OrderNew('1593994626189841293',"0942118018");
/*
$input_json = '{
    "Erorr": 0,
    "diachi": "223 Nguyễn Tất Thành, Ea Kar, Đắk Lắk",
    "thungan": "Thu ngân ca sáng 223 Nguyễn Tất Thành, Ea Kar, Đắk Lắk",
    "mahoadon": "B22011.1097.4227",
    "ngaytao": "25/01/2022",
    "tuvan": "Ngô Thị Liên",
    "khachhang": "TRẦN VĂN HIẾU",
    "diemtichluy": "69",
    "voucher": "",
    "trigia": "0",
    "cuoibill": " - Sinh nhật được tặng voucher giảm 50k/100k/150k/200k theo hạng thành viên tương ứng Kết nối/Đồng/Bạc/Vàng/Kim Cương.<br>\n- Lễ Tết mua hàng theo chính sách cực ưu đãi.<br>\n- Đổi hàng trong vòng 03 ngày (được đổi 01 lần)<br>\n- Bảo hành sản phẩm trong vòng 30 ngày (KH thành viên), 07 ngày (khách lẻ).<br>\n- Sản phẩm phải còn nhãn, hóa đơn, còn nguyên vẹn, không bị dơ bẩn, không có mùi đã qua sử dụng/giặt tẩy.<br>\n- Hàng đổi có giá trị ≥ hàng đã mua.<br>\n- Hàng KM, hàng len/dệt kim/ren/da, quần legging, áo lông/dạ, phụ kiện không được đổi trả.<br>\n- Mọi thắc mắc vui lòng liên hệ: 0901 800 888 ( phím 8)<br>\nCảm ơn Quý Khách đã mua sắm tại Fm Style!",
	"tongcong":"265000",
	"bangchu":"hai trăm sáu mưới lăm ngàn đồng chẵn",
    "thongtin": [
        [
            "211118011",
            "Set len lỗ áo khoác cổ V 3 nút ngọc + áo cr 2 dây nhí",
            "265000",
            "1",
            "10"
        ]
    ]
}';
*/
$data = json_decode($input_json,true);
//echo "<pre>";
//print_r($data);
?>
<!doctype html>
<html lang="en">

<head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css" />
</head>

<body>

    <div class="container mt-3" style="padding: 0 20px; max-width:400px;">
        <div class="row" id="imagesave">
            <div class="col-3">
                <div class="title w-100">
                    <img style="width: 80px; margin-bottom: 10px;margin-top: 10px" src="image/logo1.png" alt="FM">
                </div>
            </div>

            <div class="col-9">
				<div class="add-bill d-flex">                    
                    <h6>HỆ THỐNG THỜI TRANG FM STYLE</h6>
                </div>

                <!-- add -->
                <div class="add-bill d-flex">
                    <p><strong><i class="fa fa-home" aria-hidden="true"></i>:</strong></p>
                    <p> <?php echo $data["diachi"];?></p>
                </div>

                <!-- tel -->
                <div class="add-bill d-flex">
                    <p><strong><i class="fa fa-phone" aria-hidden="true"></i>:</strong></p>
                    <p>Hotline: 0901 800 888 - <i class="fa fa-globe" aria-hidden="true"></i>: www.fm.com.vn</p>
                </div>

            </div>
            <div class="title-bot">
                <h6>HÓA ĐƠN BÁN LẺ</h6>
            </div>
            <div class="detail-bill mb-1">
                <span class="mr-2">Số: <b><?php echo $data["mahoadon"];?></b></span>
                <span>Ngày: <b><?php echo $data["ngaytao"];?></b></span>
                <p>Thu ngân: <?php echo $data["thungan"];?></p>
                <p>Tư vấn: <?php echo $data["tuvan"];?></p>
                <p>Khách hàng: <strong><?php echo $data["khachhang"];?> </strong> - Điểm tích lũy:<strong> <?php echo $data["diemtichluy"];?></strong></p>
            </div>

            <!-- table -->
            <div class="container container-table mb-1">
                <div class="row">
                    <table style="border-style: dotted;" class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">TT</th>
								<th scope="col">Mã SP</th>
                                <th scope="col">Tên sản phẩm</th>
                                <th scope="col">Đơn giá</th>
                                <th scope="col">CK</th>
                                <th scope="col" width="100">Thành tiền</th>
                            </tr>
                        </thead>
						<?php 
						$i = 0; $tongcong = 0; $tongchietkhau = 0;
						foreach ($data["thongtin"] as $key) { $i++; 
							 $chietkhau = $key[2] * $key[4]/100; // dongia * chietkhau/100
							 $gia =  $key[2] - $chietkhau ; // dongia - chietkhau
						     $thanhtien =  $gia * $key[3] ; // gia * soluong
						     $tongchietkhau +=  $chietkhau * $key[3] ; // chietkhau * soluong
						     $tongcong +=  ($thanhtien) ;
							 ?>
                        <tbody>
                            <tr>
                                <th scope="row"><?php echo $i;?></th>
								 <th scope="row"><?php echo $key[0];?></th>
                                <td colspan="2"><?php echo $key[1];?></td>
                            </tr>
                            <tr>
                                <th scope="row"></th>
								<td></td>
								<!-- so luong -->
                                <td>SL: <?php echo $key[3];?></td>
								<!-- don gia -->
                                <td><?php echo number_format($key[2], 0, '.', ',');?></td>
								<!-- chiet khau -->
                                <td><?php echo $key[4];?></td>
								<!-- thanh tien -->
                                <td><?php echo number_format($thanhtien, 0, '.', ',');?></td>
                            </tr>
							<?php } ?>
                            <tr>
								<td></td>
                                <td></td>
								<td colspan="3"><b>Tổng tiền thanh toán</b></td>
                                <td colspan="1"><b><?php echo number_format($data["tongcong"], 0, '.', ',');?></b></td>
                            </tr>
                        </tbody>
						
                    </table>
                </div>
            </div>

            <div class="detail-bill mb-1">
                <p><strong>Tổng bằng chữ: </strong><i><?php echo $data["bangchu"];?></i></p>
                <!--<p>Tiền thanh toán: <strong><?php echo $data["tongcong"];?></strong> khách trả <strong>0</strong></p> -->
                
            </div>

            <div class="detail-bill mb-1">
                <p><?php echo $data["cuoibill"];?></p>                
            </div>
        </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	
	<script>
		html2canvas(document.getElementById("imagesave"),
		{
			allowTaint: true,
			useCORS: true
		}).then(function (canvas) {
			var url=canvas.toDataURL();
			console.log(url)
		});
	</script>
</body>

</html>