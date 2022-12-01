<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<style type="text/css">
	.style1 {
		color: #FF0000
	}

</style>

<!-- BEGIN: block_update -->
<form name="frmProduct2" id="frmProduct2" method="post" style="background-color: #E8F7F5;">

	<fieldset class="nencon" id="khachhang">
		<legend>
			<h3>{t-c}</h3>
		</legend>

		<style>
			table tr td {
				padding: 0.2em;
			}

			table tr td input,
			table tr td select {
				padding: 0.5em;

			}

			input ,textarea,select {
				width: 40%;
			}
		</style>	

		<table width="100%" border="0">
			<tr>
				<td width="20%">Mã trạng thái</td>
				<td width="60%">
					<input type="text" name="matrangthai" id="matrangthai" placeholder="Mã trạng thái" value="{matrangthai}" required />
				</td>
			</tr>
			<tr>
				<td width="20%">Tên trạng thái</td>
				<td width="60%">
					<input type="text" name="tentrangthai" id="tentrangthai" placeholder="Tên trạng thái" value="{tentrangthai}" required /> <span style="font-weight: bold; color: red;">**Tên trạng thái phải đúng với trạng thái của NVC </span>
				</td>
			</tr>
			<tr>
				<td width="20%">Loại trạng thái</td>
				<td width="60%">
					<select name="loaitrangthai" width="100%">
						<option {loaitrangthai1} value="1">Đơn thành công</option>
						<option {loaitrangthai2} value="2">Đơn huỷ</option>
						<option {loaitrangthai3} value="3">Đơn hoàn</option>
					</select>
				</td>
			</tr>
			<tr>
				<td width="20%">Ghi chú</td>
				<td width="60%">
					<textarea name="ghichu" id="" cols="30" rows="5" maxlength="250"></textarea>
				</td>
			</tr>
		</table>
		<br />


		<div style="padding-left:105px;padding-bottom:8px">
			<input type="Submit" onfocus="setrong()" onclick="return kiemtra()" class="text" id="btnUpdate"
				name="btnUpdate" value="Cập nhập" style="width:200px"/>
			<input type="button" onclick="return window.location='?act=trangthaicuoi'" name="cancel2" style="width:200px" value="Quay lại danh sách" />
		</div>
	</fieldset>



</form>

<script src="js/jquery-1.7.2.min.js"></script>
<script src="js/select2.min.js"></script>
<link rel="stylesheet" media="screen" href="js/select2.min.css">
<script language="JavaScript">
	$('.js-chonnhavc').select2();
</script>
<!-- END:block_update -->

<!-- BEGIN:block_capnhat -->
	<!-- BEGIN: block_success -->
	<script>
		alert("Cập nhật thành công!");
		window.location = '?act=trangthaicuoi';
	</script>
	<!-- END: block_success -->

	<!-- BEGIN: block_fail -->
	<script>
		alert("Cập nhật Thất bại!");
	</script>
	<!-- END: block_fail -->
<!-- END:block_capnhat -->

<!-- BEGIN: block_xoa -->
<script>
	alert("Xóa thành công!");
	window.location = '?act=trangthaicuoi';
</script>
<!-- END: block_xoa -->

<!-- BEGIN: block_cus -->
<div class="nenbao">
	<div style="padding:1px">
		<fieldset class="nencon">
			<legend> <a style="cursor:pointer">
					<label style="Color:#FF3300;Font-Weight:Bold;Font-size:15pt;">Trạng thái cuối nhà vận chuyển</label>
				</a></legend>
			<div>
				<b style="display:{q_them}"> [ <a href="default.php?act=trangthaicuoi&key=-1">Thêm Mới</a>]

					<form name="frmProduct2" id="frmProduct2" method="post">


						<table class="table table-bordered" width="100%" border="0">

							<tr>
								<td>
									<input type="text" name="tenma" id="tenma" style="width:300px"
										placeholder='Nhập tên hoặc mã ' value="{tenma}" />
									<select name="timloai" style="height: 24px;" id="">
										<option value=""></option>
										<option {timloai1} value="1">Đơn thành công</option>
										<option {timloai2} value="2">Đơn huỷ</option>
										<option {timloai3} value="3">Đơn hoàn</option>
									</select>
									<input type="submit" name="tim_" id="tim_" style="width:auto" value="Tìm" />
								</td>
							</tr>

						</table>
						<fieldset class="nencon" id="khachhang">
							<table class="table table-bordered" width="100%" border="0">
								<thead>
									<tr>
										<th class="text-center">Mã</th>
										<th class="text-center">Tên </th>
										<th class="text-center">Loại</th>
										<th class="text-center">Ghi chú</th>
										<th class="text-center">Xóa</th>
										<th class="text-center">Cập nhật</th>
									</tr>
								</thead>
								<tbody id="show_s">

									<!-- BEGIN: block_table -->
									<tr>
										<th class="text-center">{matrangthai}</th>
										<th class="text-center">{tentrangthai} </th>
										<th class="text-center">{loaitrangthai}</th>
										<th class="text-center">{ghichu}</th>

										<th class="text-center"><a href="?act=trangthaicuoi&del={ID}">Xóa</a></th>
										<th class="text-center"><a href="?act=trangthaicuoi&key={ID}">Cập nhật</a></th>
									</tr>

									<!-- END: block_table -->

								</tbody>
							</table>
						</fieldset>
					</form>
			</div>
		</fieldset>
	</div>
</div>


<script>

	var mangcauhinhvc = '{mangcauhinhvc}';
	function OnleyUpsearch(e) {
		var target = e.target;
		var value = target.value;


		if (mangcauhinhvc) {
			manghinhtam = JSON.parse(mangcauhinhvc);

			manghinhtam = Object.values(manghinhtam);

			temp = manghinhtam.filter(item => {

				var text = item.tennvc;

				text = text.toLowerCase()
				var ma = item.manvc;
				ma = ma.toLowerCase()
				if (text.includes(value.toLowerCase()) || ma.includes(value.toLowerCase())) {
					return item;
				}

			});
		}

		showsearch(temp)
	}

</script>



<!-- END: block_cus -->



</fieldset>
<script type="text/javascript" src="templates/ajaxfileupload.js"></script>

<script>
	function checkColum(e) {
		var target = e.target;
		var value = target.value;
		console.log(value);
		if (target.checked == true) {
			document.getElementById("cotdl" + value).style.display = "block"

		}
		else {
			document.getElementById("cotdl" + value).style.display = "none"
		}
	}


	function nhapexcel1() {
		if (document.getElementById('hiennhapexcel').style.display == "") {
			document.getElementById('hiennhapexcel').style.display = "none";
			//document.getElementById('timkhachhanght').style.display = '' ;	
			//document.getElementById('timphieuxuat').style.display = 'none' ;	
		} else {
			document.getElementById('hiennhapexcel').style.display = "";
			//document.getElementById('timkhachhanght').style.display = 'none' ;	
			//document.getElementById('timphieuxuat').style.display = '' ;	
		}

		poststr = "DATA=" + encodeURIComponent(0);
		loadtrang('formtailen_vc', "trangthaicuoiform", poststr, "");
	}

	function setTudong(e) {

		var target = e.target;
		var option = target.options[target.options.selectedIndex];

		var tudong = option.getAttribute("data-dong");
		document.getElementById("tudong").value = tudong;
		//console.log(tudong);

	}
	function ajaxFileUpload(tenfile, loai) {

		var tt = id_user;

		//$("#buttonUpload").val(loai);
		var nn = new Date().getTime();;
		$("#loading")
			.ajaxStart(function () {
				$(this).show();
			})
			.ajaxComplete(function () {
				$(this).hide();
			});
		$.ajaxFileUpload
			(
				{
					url: 'fileuploadchung.php?us=' + tenfile,
					secureuri: false,
					fileElementId: 'fileToUpload',
					dataType: 'json',
					success: function (data, status) {



						if (typeof (data.error) != 'undefined') {
							if (data.error != '') {
								alert(data.error);
								return false;
							} else {
								kq = data.msg;
								mkq = kq.split('*');

								hienthidulieu();

							}

						}
					},
					error: function (data, status, e) {
						if (data.e == 'vuotdungluong') {
							alert("Vượt dung lượng cho phép 8M !!!");
						}
					}
				}
			)

		return false;

	}



	function laydulieuexel() {
		document.getElementById("dulieue").disabled = true;
		var tudong = document.getElementById("tudong").value;
		var dendong = document.getElementById("dendong").value;
		var nhavc = document.getElementById("chonnhavc").value;

		if (!confirm("Thêm mới những dòng màu xanh dương và cập nhật các dòng màu xanh lá,màu vàng!")) {
			return;
		}
		var poststr = "DATA=" + encodeURIComponent(0) + "*@!" + encodeURIComponent(tudong) + "*@!" + encodeURIComponent(dendong) + "*@!" + encodeURIComponent(nhavc);
		loadtrang('resupdate', "cauhinhvandontailencheckdata", poststr, "xuly2");

	}

	function xuly2() {
		var tam = document.getElementByID("resupdate").innerHTML;
		document.getElementById("dulieue").disabled = false;
		if (tam) {

			alert(tam);

		}
	}

	function hienthidulieu() {
		var tudong = document.getElementById("tudong").value;
		var dendong = document.getElementById("dendong").value;
		var t1;

		var nhavc = document.getElementById("chonnhavc").value;

		//  t1=document.getElementById('idchuyen').value;
		poststr = "DATA=" + encodeURIComponent(t1) + "*@!" + encodeURIComponent(tudong) + "*@!" + encodeURIComponent(dendong) + "*@!" + encodeURIComponent(nhavc) + "*@!" + encodeURIComponent(0);
		loadtrang('hienthiexcel', 'cauhinhvandontailenhienthi', poststr, "");

	}

	function filterVandon(loai) {
		var tudong = document.getElementById("tudong").value;
		var dendong = document.getElementById("dendong").value;
		var t1;

		var nhavc = document.getElementById("chonnhavc").value;

		//  t1=document.getElementById('idchuyen').value;
		poststr = "DATA=" + encodeURIComponent(t1) + "*@!" + encodeURIComponent(tudong) + "*@!" + encodeURIComponent(dendong) + "*@!" + encodeURIComponent(nhavc) + "*@!" + encodeURIComponent(loai);
		loadtrang('hienthiexcel', 'cauhinhvandontailenhienthi', poststr, "");

	}
	function xuatbaoloi(str) {
		alert(str);
	}



	function showformtaive() {

		document.getElementById("formtaivepos").style.display = "inline-flex";
	}
	var fail = "";
	function GetVandonPos() {

		var ngaytu = document.getElementById("ngaytu_").value;
		var ngayden = document.getElementById("ngayden_").value;
		var mavc = document.getElementById("nhavc_").value;
		var mavd = document.getElementById("mavd_").value;
		if (!ngaytu || !ngayden || !mavc) {
			alert("vui lòng chọn ngày");
			return;
		}



		poststr = "DATA=" + encodeURIComponent(ngaytu) + "*@!" + encodeURIComponent(ngayden) + "*@!" + encodeURIComponent(mavc) + "*@!" + encodeURIComponent(mavd) + "*@!";
		loadtrang('show_pos', 'cauhinhvandongetpos', poststr, "");

	}


	function GetVandonLoiPos() {
		fail = 1;
		var ngaytu = document.getElementById("ngaytu_").value;
		var ngayden = document.getElementById("ngayden_").value;
		var mavc = document.getElementById("nhavc_").value;
		var mavd = document.getElementById("mavd_").value;
		if (!ngaytu || !ngayden || !mavc) {
			alert("vui lòng chọn ngày");
			return;
		}



		poststr = "DATALOI=" + encodeURIComponent(ngaytu) + "*@!" + encodeURIComponent(ngayden) + "*@!" + encodeURIComponent(mavc) + "*@!" + encodeURIComponent(mavd) + "*@!";
		loadtrang('show_pos', 'cauhinhvandongetpos', poststr, "");

	}

	function GetVandonPosNoBill(type) {

		var ngaytu = document.getElementById("ngaytu_").value;
		var ngayden = document.getElementById("ngayden_").value;
		var mavc = document.getElementById("nhavc_").value;
		var mavd = document.getElementById("mavd_").value;
		poststr = type + "=" + encodeURIComponent(ngaytu) + "*@!" + encodeURIComponent(ngayden) + "*@!" + encodeURIComponent(mavc) + "*@!" + encodeURIComponent(mavd) + "*@!";
		loadtrang('show_pos', 'cauhinhvandongetpos', poststr, "");

	}


	function updateSobillpos(e, id, mavc) {

		var target = e.target;
		var value = target.value;

		var myHeaders = new Headers();
		myHeaders.append("Content-Type", "application/json");

		var raw = JSON.stringify({
			"id": id,
			"sobill": value,
			"mavc": mavc
		});


		var requestOptions = {
			method: 'POST',
			headers: myHeaders,
			body: raw,
			redirect: 'follow'
		};
		var url = "https://kimhoangvu.net/webhook/pancake/pancake.php?type=addbill";
		if (mavc == 'Shopee') {
			url = 'https://kimhoangvu.net/shopee/shopee_order_api.php?type=addbill';
		}
		if (mavc == 'Lazada') {
			url = 'https://kimhoangvu.net/lazada/laz_order_api.php?type=addbill';
		}
		fetch(url, requestOptions)
			.then(response => response.text())
			.then(result => {
				console.log(result);
				if (result) {
					result = JSON.parse(result);

					console.log(result);
					if (result["code"] == 200) {
						//target.disabled=true;

					}
					notification(result.code, result.message)

				}
			})
			.catch(error => console.log('error', error));
	}

	var idnot = 1;
	function notification(code, text) {

		var div = document.createElement("div");
		div.innerHTML = text;
		div.classList.add("notifi");
		div.setAttribute("id", idnot);
		if (code == 201) {
			div.style.color = '#ff9800';
		}

		if (code == 200) {
			div.style.color = 'green';
		}

		document.body.appendChild(div);

		setTimeout(() => {
			document.getElementById(idnot).remove();
		}, 3000);
	}

	function laydulieupos(type) {

		var ngaytu = document.getElementById("ngaytu_").value;
		var ngayden = document.getElementById("ngayden_").value;
		var mavc = document.getElementById("nhavc_").value;
		var mavd = document.getElementById("mavd_").value;
		document.getElementById("loading__").style.display = "block";

		poststr = "LAYDULIEUPOS=" + encodeURIComponent(ngaytu) + "*@!" + encodeURIComponent(ngayden) + "*@!" + encodeURIComponent(mavc) + "*@!" + encodeURIComponent(fail) + "*@!" + encodeURIComponent(mavd) + "*@!";
		loadtrang('khonghienthi', 'cauhinhvandongetpos', poststr, "xuly1");
	}

	function xuly1() {
		document.getElementById("loading__").style.display = "none";
		var tam = document.getElementById("khonghienthi").innerHTML;
		tam = tam.split('###');
		notification(tam[0], tam[1]);
	}

</script>