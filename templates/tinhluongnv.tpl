<style>
	#poupcopy {
		position: fixed;
		width: 1100px;
		height: 100vh;
		top: 0;
		display: none;
		align-items: center;
		justify-content: center;
	}

	#contenttt {
		width: 60%;
		height: 45%;
		background-color: #ffffff;
		border: 1px solid;
		padding: 1em;
	}

	#contenttt .ct .form input,
	#contenttt .ct .form select {
		height: 30px;
	}

	#contenttt .title {
		display: flex;
		justify-content: space-between;
	}
</style>

<div id="poupcopy">

	<div id="contenttt">
		<div class="title">
			<h4>Copy thông tin</h4><button style="height:30px" onclick="closelaytt()">x</button>
		</div>
		<div class="ct">
			<div class="form">
				<div class="mau" style="margin-bottom:1em">
					<label style="width:60px">NV mẫu: </label><input type="text" name="manvmau" id="manvmau"
						placeholder="Mã nv" style="width:60px" />
					<label>Ngày: <input type="date" name="ngaymau" id="ngaymau" style="width:120px" /></label>
					<button id="timnvmau" onclick="laythongtin()">Tìm</button>
				</div>
				<div class="di">
					<label style="width:60px">NV Copy: </label>
					<input type="text" name="manv" id="manv" placeholder="Mã nv" style="width:60px"
						onchange="onkeyupcheck(1)" />
					<select name="loaicv" id="loaicv" class="style1 js-cvcopy" style="width:100px;height:30px"
						onchange="onkeyupcheck(2)">
						<option value="">Chức vụ..</option>
						{kh_chucvu}
					</select>
					<label>Từ ngày: <input type="date" name="tu" id="tu" style="width:120px" /></label>
					<label>Đến ngày: <input type="date" name="den" id="den" style="width:120px" /></label>
				</div>
			</div>
			<div class="showtt" id="showtt" style="margin: 1em 0;height: 100px;">

			</div>
			<div class="footertt"><button onclick="copyTT()">Copy</button></div>
		</div>
	</div>
</div>

<script>
	$(document).ready(() => {
		$(".js-cvcopy").select2();
	});
	function showlaytt() {
		document.getElementById('poupcopy').style.display = 'flex';
	}

	function closelaytt() {
		document.getElementById('poupcopy').style.display = 'none';
	}
	function laythongtin() {
		var manv = document.getElementById('manvmau').value;
		var ngaymau = document.getElementById('ngaymau').value;
		if (!manv) {
			alert("Vui lòng nhập mã nhân viên mẫu!");
			return;
		}
		if (!ngaymau) {
			alert("Vui lòng Chọn ngày!");
			return;
		}

		//console.log(value);
		var poststr = "DATA=" + encodeURIComponent(manv) + "*@!" + encodeURIComponent(ngaymau);
		loadtrang('showtt', "copythongtin", poststr, "xuly1");

	}
	function laythongtinKeycode(e, value) {
		//var manv=document.getElementById('manvmau').value;
		//var loaicv=document.getElementById('loaicv').value;
		if (e.keyCode == 13) {
			console.log(value);
			var poststr = "DATA=" + encodeURIComponent(value) + "*@!" + encodeURIComponent(0);
			loadtrang('showtt', "copythongtin", poststr, "xuly1");
		}


	}
	function xuly1() {

	}

	function removethongtin(value) {
		var chuoitt = document.getElementById('thongtinluu').value;
		var tammang = chuoitt.split("&*!");
		var mangmoi = tammang.filter((el) => {
			return el != value;
		});

		console.log(mangmoi);
	}

	function copyTT() {
		var manv = document.getElementById('manvmau').value;
		var ngaymau = document.getElementById('ngaymau').value;
		if (!manv) {
			alert("Vui lòng nhập mã nhân viên mẫu!");
			return;
		}
		if (!ngaymau) {
			alert("Vui lòng Chọn ngày!");
			return;
		}
		if (!document.getElementById('chuoitttrave')) {
			alert("Chuỗi thông tin chưa có!");
			return;
		}
		var chuoitt = document.getElementById('chuoitttrave').value;
		if (!chuoitt) {
			alert("Chuỗi thông tin trống!");
			return;
		}
		var manvcopy = document.getElementById('manv').value;
		var chucvucopy = document.getElementById('loaicv').value;
		var tucopy = document.getElementById('tu').value;
		var dencopy = document.getElementById('den').value;
		if (!manvcopy && !chucvucopy) {
			alert("Vui lòng nhập mã nhân viên hoặc chức vụ muốn copy!");
			return;
		}

		if (!tucopy) {
			alert("Vui lòng chọn thời gian từ!");
			return;
		}
		if (!dencopy) {
			alert("Vui lòng chọn thời gian đến!");
			return;
		}

		var poststr = "COPYTT=" + encodeURIComponent(manvcopy) + "*@!" + encodeURIComponent(chucvucopy) + "*@!" + encodeURIComponent(tucopy) + "*@!" + encodeURIComponent(dencopy) + "*@!" + encodeURIComponent(chuoitt);
		loadtrang('copyres', "copythongtin", poststr, "xuly1");
	}

	function onkeyupcheck(loai) {
		if (loai == 1) {
			var manvcopy = document.getElementById('manv').value;
			if (manvcopy != '') {
				document.getElementById('loaicv').setAttribute("disabled", "disabled");
			}
			else {
				document.getElementById('loaicv').removeAttribute("disabled");
			}
		}
		if (loai == 2) {
			var chucvucopy = document.getElementById('loaicv').value;
			if (chucvucopy != '') {
				document.getElementById('manv').setAttribute("disabled", "disabled");
			}
			else {
				document.getElementById('manv').removeAttribute("disabled");
			}
		}
	}
</script>
<div class="top_space"></div>
<div class="nenbao">
	<fieldset class="nencon">
		<legend> <a style="cursor:pointer">
				<label style="Color:#FF3300;Font-Weight:Bold;Font-size:9pt;">Báo cáo số giờ làm nhân viên</label>
			</a></legend>

		<form name="frmttk" method="post">
			<div style="display:none" id="hthuongdan"> </div>
			<div id="codechinh">
				<!-- BEGIN: block_proht1 -->


				<div style="padding-bottom:10px">&nbsp;
					<input onkeypress="return chuyentiep(event,'codeprotk')" type="text" placeholder="Tên NV"
						name="NameTK" id="NameTK" ondblclick="this.value=''" size="9" value="{NameTK}" />
					&nbsp;
					<input onkeypress="return chuyentieps(event,'IDNV')" type="text" placeholder="Mã NV "
						name="codeprotk" id="codeprotk" ondblclick="this.value=''" size="6" value="{codeprotk}" />
					&nbsp; <input onkeypress="return chuyentiep(event,'IDGrouptk')" type="text" name="IDNV" id="IDNV"
						style="width:25px;display:none" value="{IDNV}" ondblclick="this.value=''" />


					<select onkeypress="return chuyentiep(event,'search')" name="kho" id="kho" style="width:140px"
						class="js-khachhang">
						<option value="">Tất cả cửa hàng</option>
						{kho}
					</select>
					<select name="loaiuser" id="loaiuser" class="style1 js-chucvu" style="width:120px;height:26px">
						<option value="">Tất cả thành viên</option>
						{kh_chucvu}
					</select>

					Từ
					<input onkeypress="return chuyentiep(event,'denngay')" type="text" name="tungay" id="tungay"
						class="text" style="width:67px" value="{tungay}" />
					<img src="images/img.gif" id="Lichtungaytao" style="cursor: pointer; border: 0px solid red;"
						title="Date selector" onclick="displayCalendar(frmttk.tungay,'dd/mm/yyyy',this)" />&nbsp;đến
					<input onkeypress="return chuyentiep(event,'htchitiet')" type="text" name="denngay" id="denngay"
						class="text" style="width:67px" value="{denngay}" />
					<img src="images/img.gif" id="Lichtungaytao" style="cursor: pointer; border: 0px solid red;"
						title="Date selector" onclick="displayCalendar(frmttk.denngay,'dd/mm/yyyy',this)" /> &nbsp;
					<select onkeypress="return chuyentiep(event,'search')" name="thang" id="thang" style="width:110px">
						<option value="">Tất cả</option>
						<!-- BEGIN: block_thangnam -->
						<option value="{namthang}">{thangnam}</option> <!-- END: block_thangnam -->

					</select>
					<input type="button"
						onclick="return tongquat(NameTK.value,codeprotk.value ,kho.value,tungay.value,denngay.value,IDNV.value,0,loaiuser.value)"
						name="search1" style="width:70px" id="search1" value="Tổng Quát" />
					<input type="button"
						onclick="return theongay(NameTK.value,codeprotk.value ,kho.value,tungay.value,denngay.value,IDNV.value,thang.value,thang.value,0,loaiuser.value)"
						name="search2" style="width:68px" id="search2" value="Theo ngày" />
				</div>
				<div id="httim">

				</div>
				<div style="padding:10px;display:none" align="right">
					<input type="button" name="timnhap32" id="timnhap32" style="width:90px" onclick="huongdan()"
						value="Hướng Dẫn" />
					<input type="button" name="timnhap3" id="timnhap3" style="width:90px" onclick="matdinh()"
						value="Đóng lại" />
				</div>
			</div>
		</form>
		<form name="xuatketqua" id="xuatketqua" action="xuatfile.php" method="post" target="_blank">
			<input name="noidung" id="noidung" type="hidden" value="Chưa chọn dữ liệu">
			<input name="tenfile" id="tenfile" type="hidden" value="baocaodoanhthu.xls">
			<input name="loaifile" id="loaifile" type="hidden" value="application/vnd.ms-excel">
		</form>

		<div id="hienthongbao" onmouseout="goidong()"
			style="display:none; padding-top: 10px;  overflow: hidden; position: absolute; left: 168px; top: 38px;"
			align="center">
			<div
				style="width:600px; min-height:400px;border:1px #999 solid; background-color:#FFF; opacity: 0.98;font-size:15px; font-weight:bold; padding:5px; color:#000;">

				<div align="right"><b style="color:#00F;cursor:pointer" onclick="goidong()">( X Đóng lại )</b></div>
				<div style="font-size:12px;font-weight:100">
					<table width="98%">
						<tr>
							<td><strong>Hình Ảnh</strong></td>
						</tr>
						<tr>
							<td width="360px"><img id="hinhanh" style="border:1px solid #F60"
									src="images/sanpham/demo.jpg" width="450px" /></td>

						</tr>
					</table>
				</div>
			</div>
		</div>
		<!-- End: block_proht1 -->

		<script src="js/jquery-1.7.2.min.js"></script>
		<script src="js/select2.min.js"></script>
		<link rel="stylesheet" media="screen" href="js/select2.min.css">
		<script language="JavaScript">
			function initluughichu() {
				return luughichu = () => {
					var ghichuob = document.getElementById("ghich1");
					var ghichu = ghichuob.value;
					var id = ghichuob.getAttribute("data-id");
					console.log(ghichu);
				}
			}
			$(document).ready(function () {
				$('.js-khachhang').select2();
				$('.js-chucvu').select2();

			});
			function goianh(src) {
				document.getElementById('hienthongbao').style.display = "";
				document.getElementById('hinhanh').src = src;
				document.getElementById('hinhanh').reload();

			}
			function xuatkq() {
				document.getElementById("noidung").value = ' <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><html><body>' + document.getElementById("httim").innerHTML + "</body></html>";
				// alert( document.getElementById("ketqua").value);
				document.getElementById("xuatketqua").submit();
			}

			document.getElementById('NameTK').focus();
			function submittk(t1, t2, t3, t4, t5, t6, t8, t7, t9, t10) {

				poststr = "DATA=" + encodeURIComponent(t1) + "*@!" + encodeURIComponent(t2) + "*@!" + encodeURIComponent(t3) + "*@!" + encodeURIComponent(t4) + "*@!" + encodeURIComponent(t5);
				poststr = poststr + "*@!" + encodeURIComponent(t6) + "*@!" + encodeURIComponent(t7) + "*@!" + encodeURIComponent(t8) + "*@!" + encodeURIComponent(t9) + "*@!" + encodeURIComponent(t10);
				loadtrang('httim', "baocaogiolamtim", poststr, "");

			}
			function tongquat(t1, t2, t3, t4, t5, t6, t8, t7, t9, t10) {

				poststr = "DATA=" + encodeURIComponent(t1) + "*@!" + encodeURIComponent(t2) + "*@!" + encodeURIComponent(t3) + "*@!" + encodeURIComponent(t4) + "*@!" + encodeURIComponent(t5);
				poststr = poststr + "*@!" + encodeURIComponent(t6) + "*@!" + encodeURIComponent(t7) + "*@!" + encodeURIComponent(t8) + "*@!" + encodeURIComponent(t9) + "*@!" + encodeURIComponent(t10);
				loadtrang('httim', "tinhluongnvthang", poststr, "");

			}

			function theongay(t1, t2, t3, t4, t5, t6, t8, t7, t9, t10) {

				poststr = "DATA=" + encodeURIComponent(t1) + "*@!" + encodeURIComponent(t2) + "*@!" + encodeURIComponent(t3) + "*@!" + encodeURIComponent(t4) + "*@!" + encodeURIComponent(t5);
				poststr = poststr + "*@!" + encodeURIComponent(t6) + "*@!" + encodeURIComponent(t7) + "*@!" + encodeURIComponent(t8) + "*@!" + encodeURIComponent(t9) + "*@!" + encodeURIComponent(t10);
				loadtrang('httim', "tinhluongnvtim", poststr, "xuly2");

			}
			function xuly2() {
				initluughichu();
			}	
		</script>

	</fieldset>
</div>