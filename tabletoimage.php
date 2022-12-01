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
	<script src="http://html2canvas.hertzen.com/dist/html2canvas.js"></script>
</head>

<body>

    <div class="container mt-3" style="padding: 0 20px; max-width:400px;" id="image" >
        <div class="row" >
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
	const block = document.getElementById('image');
const img = new Image();

const result = html2canvas(block).then(function(canvas) {
	let url = canvas.toDataURL('image/jpeg');
	url=url.replace(";","&");
	let data={ "urlbase":url };
	data=JSON.stringify(data);
	setCookie('urlbase',data,1);
	console.log(url);
});
	function setCookie(cname, cvalue, exdays) {
		  const d = new Date();
		  d.setTime(d.getTime() + (exdays*24*60*60*1000));
		  let expires = "expires="+ d.toUTCString();
		  document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
		}
	</script>
</body>

</html>


<?php

echo $_COOKIE["urlbase"];
?>