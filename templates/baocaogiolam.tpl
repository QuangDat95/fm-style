<style>
	#poupduyetbugio {
		display: none;
		width: 100%;
		height: 100vh;
		position: fixed;
		left: 0;
		top: 0;
		align-items: center;
		justify-content: center;
		z-index: 100;
		background-color: #00000045;
	}
</style>


<div id="poupduyetbugio">

</div>
<style>
	#poupduyetbugioct {
		display: none;
		width: 100%;
		height: 100vh;
		position: fixed;
		left: 0;
		top: 0;
		align-items: center;
		justify-content: center;
		z-index: 100;
		background-color: #00000045;
	}
</style>


<div id="poupduyetbugioct">

</div>
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
					<label style="width:60px">NV mẫu: </label>
					<input type="text" name="manvmau" id="manvmau" placeholder="Mã nv" style="width:60px" />
					<select name="loaicvmau" id="loaicvmau" class="style1" style="width:100px;height:30px">
						<option value="">Chức vụ..</option>
						{chucvu}
					</select>
					<label>Ngày: <input type="date" name="ngaymau" id="ngaymau" style="width:120px" /></label>
					<button id="timnvmau" onclick="laythongtin()">Tìm</button>
				</div>
				<div class="di">
					<label style="width:60px">NV Copy: </label>
					<input type="text" name="manv" id="manv" placeholder="Mã nv" style="width:60px"
						onchange="onkeyupcheck(1)" />
					<select name="loaicv" id="loaicv" class="style1" style="width:100px;height:30px"
						onchange="onkeyupcheck(2)">
						<option value="">Chức vụ..</option>
						<option value="10" {loai10}>Nhân Viên Bán Hàng</option>
						<option value="5" {loai5}>Nhân Viên Thu Ngân</option>
						<option value="4" {loai4}>Cửa Hàng Trưởng</option>
						<option value="3" {loai3}>Quản Lý Công Ty</option>
						<option value="2" {loai2}>Khách Hàng</option>
						<option value="6" {loai6}>Kế Toán</option>
						<option value="7" {loai7}>kiểm kho</option>
						<option value="8" {loai8}>Nhân Viên Kho</option>
						<option value="9" {loai9}>Nhân Viên Văn Phòng</option>
						<option value="11" {loai11}>Nhân Viên bảo vệ</option>
						<option value="12" {loai12}>Nhân Viên Thời Vụ</option>
						<option value="13" {loai13}>Nhân Viên Loại Khác</option>
						<option value="14" {loai14}>Nhân Viên nhân sự</option>
						<option value="15" {loai15}>Bộ phận mẫu</option>
						<option value="16" {loai16}>Quản lý vùng</option>
						<option value="17" {loai17}>Online</option>
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
	function showlaytt() {
		document.getElementById('poupcopy').style.display = 'flex';
	}

	function closelaytt() {
		document.getElementById('poupcopy').style.display = 'none';
	}
	function laythongtin() {
		var manv = document.getElementById('manvmau').value;
		var ngaymau = document.getElementById('ngaymau').value;
		var loaicvmau = document.getElementById('loaicvmau').value;

		if (!manv) {
			alert("Vui lòng nhập mã nhân viên mẫu!");
			return;
		}
		if (!ngaymau) {
			alert("Vui lòng Chọn ngày!");
			return;
		}

		//console.log(value);
		var poststr = "DATA=" + encodeURIComponent(manv) + "*@!" + encodeURIComponent(ngaymau) + "*@!" + encodeURIComponent(loaicvmau);
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
					<select onkeypress="return chuyentiep(event,'search')" name="chucvu" id="chucvu" style="width:110px"
						class="js-chucvu">
						<option value="">Tất cả Chức Vụ</option>
						<option value="-1">Tất cả thử việc</option>
						{chucvu}


					</select>
					<select name="loaiuser" id="loaiuser" class="style1" style="width:110px;height:26px">
						<option value="">Tất cả thành viên</option>
						<option value="10" {loai10}>Nhân Viên Bán Hàng</option>
						<option value="5" {loai5}>Nhân Viên Thu Ngân</option>
						<option value="4" {loai4}>Cửa Hàng Trưởng</option>
						<option value="3" {loai3}>Quản Lý Công Ty</option>
						<option value="2" {loai2}>Khách Hàng</option>
						<option value="6" {loai6}>Kế Toán</option>
						<option value="7" {loai7}>kiểm kho</option>
						<option value="8" {loai8}>Nhân Viên Kho</option>
						<option value="9" {loai9}>Nhân Viên Văn Phòng</option>
						<option value="11" {loai11}>Nhân Viên bảo vệ</option>
						<option value="12" {loai12}>Nhân Viên Thời Vụ</option>
						<option value="13" {loai13}>Nhân Viên Loại Khác</option>
						<option value="14" {loai14}>Nhân Viên nhân sự</option>
						<option value="15" {loai15}>Bộ phận mẫu</option>
						<option value="16" {loai16}>Quản lý vùng</option>
						<option value="17" {loai17}>Online</option>
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
					<select onkeypress="return chuyentiep(event,'search')" name="dataquet" id="dataquet"
						style="width:110px">
						<option value="0">Quét mới nhất</option>
						<option value="1">Quét thẻ đã lưu</option>
					</select>
					<div align="center">
						<input type="button"
							onclick="return submittk(NameTK.value,codeprotk.value ,kho.value,tungay.value,denngay.value,IDNV.value,thang.value,0,loaiuser.value,dataquet.value,chucvu.value)"
							name="search" style="width:55px" id="search" value="Chi Tiết" />
						<input type="button"
							onclick="return tangca(NameTK.value,codeprotk.value ,kho.value,tungay.value,denngay.value,IDNV.value,thang.value,0,loaiuser.value,dataquet.value,chucvu.value)"
							name="search3" style="width:55px" id="search3" value="Tăng ca" />
						<input type="button"
							onclick="return tongquat(NameTK.value,codeprotk.value ,kho.value,tungay.value,denngay.value,IDNV.value,0,loaiuser.value,dataquet.value,chucvu.value)"
							name="search1" style="width:70px" id="search1" value="Tổng Quát" />
						<input type="button"
							onclick="return theongay(NameTK.value,codeprotk.value ,kho.value,tungay.value,denngay.value,IDNV.value,thang.value,thang.value,0,loaiuser.value,dataquet.value,chucvu.value)"
							name="search2" style="width:68px" id="search2" value="Theo ngày" />
						<span style="padding-bottom:5px;padding-top:5px;">
							<input type="button" style="  width: 45px;" id="xuat" value="Excel" name="xuat"
								onclick="xuatkq()" />
						</span><input type="button" style="  width: 55px;" id="coptt" value="Copy TT" name="coptt"
							onclick="showlaytt()" /><input type="button" style="  width: ;" id="chotdata"
							value="Chốt dữ liệu" name="chotdata" onclick="chotdulieu()" />
						</span>
					</div>
				</div>
				<div id="reschotdl"></div>
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
			function submittk(t1, t2, t3, t4, t5, t6, t8, t7, t9, t10, t11, t12) {
				poststr = "DATA=" + encodeURIComponent(t1) + "*@!" + encodeURIComponent(t2) + "*@!" + encodeURIComponent(t3) + "*@!" + encodeURIComponent(t4) + "*@!" + encodeURIComponent(t5);
				poststr = poststr + "*@!" + encodeURIComponent(t6) + "*@!" + encodeURIComponent(t7) + "*@!" + encodeURIComponent(t8) + "*@!" + encodeURIComponent(t9) + "*@!" + encodeURIComponent(t10) + "*@!" + encodeURIComponent(t11) + "*@!" + encodeURIComponent(t12)
				loadtrang('httim', "baocaogiolamtim", poststr, "");

			}
			function tongquat(t1, t2, t3, t4, t5, t6, t8, t7, t9, t10, t11, t12) {

				poststr = "DATA=" + encodeURIComponent(t1) + "*@!" + encodeURIComponent(t2) + "*@!" + encodeURIComponent(t3) + "*@!" + encodeURIComponent(t4) + "*@!" + encodeURIComponent(t5);
				poststr = poststr + "*@!" + encodeURIComponent(t6) + "*@!" + encodeURIComponent(t7) + "*@!" + encodeURIComponent(t8) + "*@!" + encodeURIComponent(t9) + "*@!" + encodeURIComponent(t10) + "*@!" + encodeURIComponent(t11) + "*@!" + encodeURIComponent(t12);
				loadtrang('httim', "baocaogiolamtongtim", poststr, "");

			}

			function chotdulieu() {
				var poststr = "CHOTDATA=" + encodeURIComponent() + "*@!" + encodeURIComponent(0);
				loadtrang('reschotdl', "tinhluongnvtim", poststr, "xuly3");


			}

			function xuly3() {
				var tam = document.getElementById("reschotdl").innerHTML;
				console.log(tam);
				alert("đã luu dữ liệu");
			}
			function theongay(t1, t2, t3, t4, t5, t6, t8, t7, t9, t10, t11, t12) {

				poststr = "DATA=" + encodeURIComponent(t1) + "*@!" + encodeURIComponent(t2) + "*@!" + encodeURIComponent(t3) + "*@!" + encodeURIComponent(t4) + "*@!" + encodeURIComponent(t5);
				poststr = poststr + "*@!" + encodeURIComponent(t6) + "*@!" + encodeURIComponent(t7) + "*@!" + encodeURIComponent(t8) + "*@!" + encodeURIComponent(t9) + "*@!" + encodeURIComponent(t10) + "*@!" + encodeURIComponent(t11) + "*@!" + encodeURIComponent(t12);
				loadtrang('httim', "baocaogiolamtheongaytim", poststr, "xuly2");

			}
			function xuly2() {
				initluughichu();
			}




			function closepop(id) {
				document.getElementById(id).style.display = "none";
			}

			function showpop(id) {
				document.getElementById(id).style.display = "flex";
			}
			function showloading1() {
				if (document.getElementById('loading1')) {
					document.getElementById('loading1').style.display = "flex";
				}
			}
			function closeloading1() {
				if (document.getElementById('loading1')) {
					document.getElementById('loading1').style.display = "none";
				}
			}
			function showchitietbugio(id, idpop) {
				showpop(idpop);
				poststr = "DATA=" + encodeURIComponent(id) + "*@!" + encodeURIComponent(0)
				loadtrang('poupduyetbugio', "phieubugioduyetchitiet", poststr, "");
			}

			function xuly4() {
				//showpop();

			}

			var capnhap = '';
			var elselect = '';
			var loaicp = '';
			function xuly1() {
				closeloading1();
				//console.log('ok');
				tam = document.getElementById('khonghienthi').innerHTML;
				//alert(tam);
				var n = tam.split("###");
				console.log(n);
				if (n[1] == "-1") { alert(n[2]); return; }
				if (n[1]) {
					if (n[1] != '1') {
						document.getElementById('tinhtrang_' + capnhap).innerHTML = n[2];
						var tinhtrangform = document.getElementsByClassName('tinhtrangform');
						for (var i = 0; i < tinhtrangform.length; i++) {
							var elbtn = tinhtrangform[i];
							elbtn.innerHTML = n[2];
						}

					}
					if (n[1] == "3" || n[1] == "1") {
						document.getElementById('lydo' + loaicp + capnhap).innerHTML = n[4];
						document.getElementById(elselect).value = n[1];
					}
					//document.getElementById('duyetad'+capnhap).innerHTML= n[3];  
					alert(n[2]);
					if (n[1] == "4" || n[1] == "3") {
						document.getElementById(elselect).value = n[1];
						document.getElementById(elselect).disabled = true;
						var btntrangthai = document.getElementsByClassName('btntrangthai');
						for (var i = 0; i < btntrangthai.length; i++) {
							var elbtn = btntrangthai[i];
							elbtn.disabled = true;
						}

					}
					return;
				}
			}
			function goiduyet(id, idl, tennv, loai, vl) {
				capnhap = id;
				elselect = 'cp' + loai + id;
				loaicp = loai;
				if (vl == 4) {
					var cf = "Bạn có chắc chắn muốn duyệt phiếu cho nhân viên " + tennv + " này hay không ? ";
					if (thongbao(cf) == false) { return }
					else {
						poststr = "DATAC=" + encodeURIComponent(id) + "*@!" + encodeURIComponent(idl) + "*@!" + encodeURIComponent(loai) + "*@!" + encodeURIComponent(vl) + "*@!" + encodeURIComponent(0);
						loadtrang('khonghienthi', "phieubugioxulyduyet", poststr, "xuly1");
					}
				}
				else {
					var lydo = prompt("Nhập Lý do: ");
					if (lydo == null) return;
					poststr = "DATAC=" + encodeURIComponent(id) + "*@!" + encodeURIComponent(idl) + "*@!" + encodeURIComponent(loai) + "*@!" + encodeURIComponent(vl) + "*@!" + encodeURIComponent(lydo);
					loadtrang('khonghienthi', "phieubugioxulyduyet", poststr, "xuly1");

				}



				//duyet(idphieu,idlogin,tinhtrang,tennv,lydo);

			}

			function tangca(t1, t2, t3, t4, t5, t6, t8, t7, t9, t10) {

				poststr = "DATA=" + encodeURIComponent(t1) + "*@!" + encodeURIComponent(t2) + "*@!" + encodeURIComponent(t3) + "*@!" + encodeURIComponent(t4) + "*@!" + encodeURIComponent(t5);
				poststr = poststr + "*@!" + encodeURIComponent(t6) + "*@!" + encodeURIComponent(t7) + "*@!" + encodeURIComponent(t8) + "*@!" + encodeURIComponent(t9) + "*@!" + encodeURIComponent(t10);
				loadtrang('httim', "baocaotangcatim", poststr, "");

			}

			function showchitietbugioct(id) {
				showpop('poupduyetbugioct');
				poststr = "DATA=" + encodeURIComponent(id) + "*@!" + encodeURIComponent(0)
				loadtrang('poupduyetbugioct', "phieubugioduyetform", poststr, "");
			}


		</script>

	</fieldset>
</div>