<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<style type="text/css">
	<!--
	.style1 {
		color: #FF0000
	}
	-->

</style>
<div id="hiennhapexcel" style="display:none ; overflow:hidden; position:fixed;       left: 0px;
    width: 100%;
    top: 0;    height: 100vh;" align="center">
	<div style=" width:100%; min-height:510px;border:1px #999 solid; background-color:#FFF; opacity: 0.98;font-size:15px; 
  font-weight:bold; padding:5px; color:#F00;height:100%">

		<div align="right" style="    position: absolute;
    right: 20px;"><b style="color:#00F;cursor:pointer" onclick="goidongid('hiennhapexcel')">( X Đóng lại )</b></div>

		<div id="timexxcel" style="padding:10px">

			<div id="formtailen_vc" style="    display: flex;
    flex-direction: column;
    overflow: scroll;
    height: 100vh;">

			</div>
		</div>
	</div>
</div>
<!-- BEGIN: block_update -->
<form name="frmProduct2" id="frmProduct2" method="post">

	<fieldset class="nencon" id="khachhang">
		<legend>
			<h3>{t-c}</h3>
		</legend>
		<script language="javascript">
			var t = 1;
			mTimer = setTimeout('doititle()', 1000);
			function doititle() {
				t = t + 1;

				if (t < 18) {
					if (document.title != '***') {
						document.title = "***";
					} else {
						document.title = "Thêm Khách Hàng";
					}
					setTimeout('doititle()', 500);
				}
			}
		</script>

		<input name="dachon" type="hidden" id="dachon" value="{type}" /> <input name="id" id="id" type="hidden"
			value="{ID}" />
		<style>
			table tr td {
				padding: 0.2em;
			}

			table tr td input,
			table tr td select {
				padding: 0.5em;

			}

			.ttbb {
				width: 100%;
				display: flex;
				flex-wrap: wrap;
				flex-direction: row;
				justify-content: space-between;
			}

			.ttbb .itemtt {
				padding: 0.5em
			}

			.ttbb .itemtt input {

				cursor: pointer !important;
			}

			.ttbb .itemtt label {
				margin-right: 0.5em
			}

			.ttbb .itemtt label input {
				margin-left: 0.5em;
				cursor: pointer !important;
			}

			.choncot {
				display: flex;

				width: 950px;
				overflow: scroll;
			}

			.choncot label {
				width: 100px;
				margin-right: 0.5em;
			}

			/* The container */
			.container_c {
				display: block;
				position: relative;
				padding-left: 35px;
				margin-bottom: 12px;
				cursor: pointer;
				font-size: 15px;
				-webkit-user-select: none;
				-moz-user-select: none;
				-ms-user-select: none;
				user-select: none;
			}

			/* Hide the browser's default checkbox */
			.container_c input {
				position: absolute;
				opacity: 0;
				cursor: pointer;
				height: 0;
				width: 0;
			}

			/* Create a custom checkbox */
			.checkmark {
				position: absolute;
				top: 0;
				left: 0;
				height: 25px;
				width: 25px;
				background-color: #eee;
			}

			/* On mouse-over, add a grey background color */
			.container_c:hover input~.checkmark {
				background-color: #ccc;
			}

			/* When the checkbox is checked, add a blue background */
			.container_c input:checked~.checkmark {
				background-color: #2196F3;
			}

			/* Create the checkmark/indicator (hidden when not checked) */
			.checkmark:after {
				content: "";
				position: absolute;
				display: none;
			}

			/* Show the checkmark when checked */
			.container_c input:checked~.checkmark:after {
				display: block;
			}

			/* Style the checkmark/indicator */
			.container_c .checkmark:after {
				left: 10px;
				top: 5px;
				width: 5px;
				height: 10px;
				border: solid white;
				border-width: 0 3px 3px 0;
				-webkit-transform: rotate(45deg);
				-ms-transform: rotate(45deg);
				transform: rotate(45deg);
			}

			.chondong {
				height: 196px;
				margin-top: 2em;
				overflow-y: scroll;
			}

			.exel_ {
				width: 100%;
				display: flex;
			}

			.cot_wrap {
				width: 90%;
				width: 950px;
			}

			.img_ {
				width: 100%;
			}

			.img_ img {
				width: 100%;
			}
		</style>

		<table width="100%" border="0">




			<tr>
				<td width="17%">Nhà vận chuyển </td>
				<td width="10%">
					<input type="text" name="manvc" id="manvc" placeholder="Mã nhà vận chuyển" value="{manvc}"
						required />
					<input type="hidden" name="manvcc" id="manvcc" placeholder="Mã nhà vận chuyển" value="{manvcc}" />
				</td>
				<td width="17%"><input type="text" name="tennvc" id="tennvc" placeholder="Tên nhà vận chuyển"
						value="{tennvc}" required /></td>
				<td>

				</td>
			</tr>
			<tr>
				<td colspan="4">
					<div class="exel_">
						<div class="chondong">
							{chuoidong}
						</div>
						<div class="cot_wrap">
							<div class="choncot">
								{chuoicot}
							</div>
							<div class="img_">
								<img src="images/exel_vd.png" />
							</div>
						</div>
					</div>
				</td>
			</tr>
			<!--<tr>
	<td width="17%"></td>
	<td colspan="3" >
	<div class="ttbb" style="  ">
		<div class="itemtt">
		<label for="ttbb_14">HĐBH:</label>
			<input  type="checkbox" id="ttbb_14" name="ttbb_14"  {ttbb_14} value="14"/>
		</div>
		<div class="itemtt">
		<label  for="ttbb_15">STKNH:</label>
		<input  type="checkbox" id="ttbb_15" name="ttbb_15" {ttbb_15}  value="15" />
		</div>
		<div class="itemtt">
		<label for="ttbb_16">Tên NH: </label>
			<input  type="checkbox" id="ttbb_16" name="ttbb_16" {ttbb_16} value="16" />
		</div>
		<div class="itemtt">
			<label for="ttbb_16">ĐVVC: </label>
			<input  type="checkbox" name="ttbb_17"  {ttbb_17} value="17" />
		</div>
		<div class="itemtt">
			<label for="ttbb_16">MÃ VĐ: </label>
			<input  type="checkbox" name="ttbb_18"  {ttbb_18} value="18" />
		</div>
		
		<div class="itemtt">
		<label for="ttbb_19" >NCC: </label>
			<input  type="checkbox"  id="ttbb_19" name="ttbb_19" {ttbb_19}  value="19" />
		</div>
		
		<div class="itemtt">
		<label for="ttbb_20">Họ và tên nhân viên: </label>
			<input  type="checkbox" id="ttbb_20" name="ttbb_20" {ttbb_20}  value="20" />
		</div>
		<div class="itemtt">
		<label for="ttbb_21">Mã nhân viên: </label>
			<input  type="checkbox" id="ttbb_21" name="ttbb_21" {ttbb_21} value="21" />
		</div>
		<div class="itemtt">
			<label for="ttbb_22">Phiếu xuất: </label>
			<input  type="checkbox" id="ttbb_22" name="ttbb_22" {ttbb_22} value="22" />
		</div>
		<div class="itemtt">
			<label for="duyetnhieu">Cho phép duyệt hàng loạt: </label>
			<input  type="checkbox" id="duyetnhieu" name="duyetnhieu" {duyetnhieu}/>
		</div>
	
			
	</div>
	</td>
 
	
</tr>-->
		</table>
		<br />


		<div style="padding-left:105px;padding-bottom:8px">
			<input type="Submit" onfocus="setrong()" onclick="return kiemtra()" class="text" id="btnUpdate"
				name="btnUpdate" value="Cập nhập" />
			<input type="button" onclick="return window.location='?act=cauhinhtailenvandon'" name="cancel2"
				style="width:200px" value="Quay lại danh sách" />
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
<!-- BEGIN: block_chinhluu -->
<script>
	alert("Cập nhật thành công!");
	window.location = '?act=cauhinhtailenvandon';
</script>

<!-- END: block_chinhluu -->

<!-- BEGIN: block_chinhluufail -->
<script>

	alert("Cập nhật Thất bại!");

</script>

<!-- END: block_chinhluufail -->
<!-- END:block_capnhat -->

<!-- BEGIN: block_xoa -->
<script>
	alert("Xóa thành công!");
	window.location = '?act=cauhinhtailenvandon';
</script>

<!-- END: block_xoa -->

<!-- BEGIN: block_cus -->
<div class="nenbao">
	<div style="padding:1px">
		<fieldset class="nencon">
			<legend> <a style="cursor:pointer">
					<label style="Color:#FF3300;Font-Weight:Bold;Font-size:15pt;">Danh Sách Cấu hình tải file</label>
				</a></legend>
			<div>
				<b style="display:{q_them}"> [ <a href="default.php?act=cauhinhtailenvandon&key=-1">Thêm Mới</a>]
					[ <button style="background-color:unset;border:none" onclick="nhapexcel1()">Tên lên mã vận
						đơn</button>]

					[ <button style="background-color:unset;border:none" onclick="showformtaive()">Tên về mã vận đơn từ
						pos</button>]
					<!--[ <a style="background-color:unset;border:none" he>Yêu cầu cập nhật mã vận đơn</a>]-->
					<div style="display:none;    align-items: center;
    justify-content: space-between;" id="formtaivepos"> Ngày từ: &nbsp; <input type="date" name="ngaytu_" id="ngaytu_"
							style="line-height:unset" />
						đến: &nbsp; <input type="date" name="ngayden_" id="ngayden_" style="line-height:unset" />
						<select name="nhavc_" id="nhavc_">
							<option value="GHTK">Giao hàng tiết kiệm</option>
							<option value="VT">Viettel</option>
							<option value="NINJAVAN">NINJA VAN</option>
							<option value="NT">Nội thành</option>
							<option value="Shopee">Shoppe</option>
							<option value="Lazada">Lazada</option>
							<option value="pancake">Từ pancake</option>
						</select>

						<input type="text" name="mavd_" id="mavd_" style="line-height:unset" placeholder="Mã vận đơn" />
						<button
							style="background-color:#009933;border:none;color:#FFFFFF;padding:3px 5px;border-radius:5px;margin-left:5px"
							onclick="GetVandonPos()">Tải về</button>

						<button
							style="background-color:#009933;border:none;color:#FFFFFF;padding:3px 5px;border-radius:5px;margin-left:5px"
							onclick="GetVandonLoiPos()">Đơn lỗi</button>
						<button
							style="background-color:#009933;border:none;color:#FFFFFF;padding:3px 5px;border-radius:5px;margin-left:5px"
							onclick="GetVandonLoiPos()">Cập nhật MVĐ GHTK</button>

					</div>
					<div id="show_pos">

					</div>
					<form name="frmProduct2" id="frmProduct2" method="post">


						<table class="table table-bordered" width="100%" border="0">

							<tr>
								<td><input type="text" name="tenmavc" id="tenmavc" style="width:300px"
										placeholder='Nhập tên hoặc mã vc' onkeyup="OnleyUpsearch(event)" /></td>
							</tr>

						</table>
						<fieldset class="nencon" id="khachhang">
							<table class="table table-bordered" width="100%" border="0">
								<thead>
									<tr>
										<th class="text-center">Mã</th>
										<th class="text-center">Tên </th>
										<th class="text-center">Danh sách cột</th>
										<th class="text-center">Danh sách dòng</th>

										<th class="text-center">Xóa</th>
										<th class="text-center">Cập nhật</th>
									</tr>
								</thead>
								<tbody id="show_s">

									{chuoitable}

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

	function showsearch(arr) {
		if (arr.length > 0) {
			var chuoi = '';
			for (let i = 0; i < arr.length; i++) {
				const element = arr[i];
				chuoi += '<tr><td class="text-center">' + element['manvc'] + '</td><td class="text-center">' + element['tennvc'] + ' </td><td class="text-center">' + element['socot'].toString() + '</td><td class="text-center">' + element['socot'].toString() + '</td><td class="text-center"><a href="?act=cauhinhtailenvandon&del=' + element['manvc'].toString() + '">Xóa</a></td><td class="text-center"><a href="?act=cauhinhtailenvandon&key=' + element['manvc'].toString() + '">Cập nhật</a></td></tr>';
			}

			document.getElementById('show_s').innerHTML = chuoi;
		}
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
		loadtrang('formtailen_vc', "cauhinhtailenvandonform", poststr, "");
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
		fail = '';
		var ngaytu = document.getElementById("ngaytu_").value;
		var ngayden = document.getElementById("ngayden_").value;
		var mavc = document.getElementById("nhavc_").value;
		var mavd = document.getElementById("mavd_").value;
		if (mavc != "pancake") {
			if (!ngaytu || !ngayden || !mavc) {
				alert("vui lòng chọn ngày");
				return;
			}

		}
		poststr = "DATA=" + encodeURIComponent(ngaytu) + "*@!" + encodeURIComponent(ngayden) + "*@!" + encodeURIComponent(mavc) + "*@!" + encodeURIComponent(mavd) + "*@!";
		loadtrang('show_pos', 'cauhinhvandongetpos', poststr, "");

	}


	function updatemvdghtk() {

		poststr = "DATA=" + "*@!";
		loadtrang('', 'cauhinhtailenvandoncapnhatghtk', poststr, "");

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