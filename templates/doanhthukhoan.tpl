<style>
	.wrapper {
		width: 100%;
		height: 140vh;
	}

	.header {
		width: 100%;
	}
</style>
<div class="nenbao">

	<legend> <a style="cursor:pointer">
			<label style="Color:#FF3300;Font-Weight:Bold;Font-size:9pt;"> Doanh Thu Khoán</label>
		</a></legend>

	<script language=JavaScript src='scripts/innovaeditor.js'></script>
	<!-- BEGIN: block_khht1 -->

	[ <a href="default.php?act=doanhthukhoan&id=-1">Thêm Mới</a>]&nbsp;&nbsp;[<a href="default.php?act=md">Đóng
		Lại</a>]&nbsp;&nbsp;
	<select name="tencuahang" id="tencuahang" style="width: 190px;">
		<option value="">Cửa hàng</option>
		{muccha}
	</select>
	<select name="khuvuc" id="khuvuc" style="width: 159px;">
		<option value="">Khu vực - Miền - Vùng</option>
		{khuvuc}
		{mien}
		{vung}
	</select>
	&nbsp;

	Ngày
	<select onkeypress="return chuyentiep(event,'search')" name="thang" id="thang" style="width:110px">

		{thangnam}
		<option value="">Tất cả</option>
	</select>
	<select onkeypress="return chuyentiep(event,'search')" name="sapxep" id="sapxep" style="width:110px">
		<option value="sotien desc">Sắp xếp cao -> thấp</option>
		<option value="sotien asc">Sắp xếp thấp -> cao</option>
		<option value="datduoc desc">đạt đươc cao -> thấp</option>
		<option value="datduoc asc">đạt đươc thấp -> cao</option>
		<option value="datduoc/sotien desc">Tỉ lệ cao -> thấp</option>
		<option value="datduoc/sotien">Tỉ lệ thấp -> cao</option>
	</select>
	<select onkeypress="return chuyentiep(event,'search')" name="tinhtrang" id="tinhtrang" style="width:110px">
		<option value="">Tất cả</option>
		<option value="1">Đạt</option>
		<option value="0">Không đạt</option>
	</select>
	<input type="button" name="search"
		onclick="timkiemcuahang(tencuahang.value,thang.value,khuvuc.value,tinhtrang.value,sapxep.value)"
		value="Tìm kiếm" />
	<input type="button" name="tm" style="width:100px;display:{q_themp}" value="Nhập từ Excel"
		onclick="nhapexcel1();" />
	<input type="button" name="bieudo" id="bieudo" onclick="bieudodoanhthukhoan(tencuahang.value,thang.value)"
		value="Biểu đồ vùng" />
	<input type="button" name="bieudocuahang" id="bieudocuahang"
		onclick="bieudocuahangthukhoan(tencuahang.value,thang.value,khuvuc.value)" value="biểu đồ theo cửa hàng" />
	<input type="button" name="bieudongay" id="bieudongay"
		onclick="bieudocuahangngay(tencuahang.value,thang.value,khuvuc.value)" value="Biểu đồ theo ngày" />
	<!-- END: block_khht1 -->

	<!-- BEGIN: block_admin -->
	<input type="button" name="search2" onclick="capnhapdoanhthu(thang.value)" value="Cập nhập " />

	<!-- END: block_admin -->
	<div id="hienthinhacc"></div>
	<div id="khoanchitietcuahang"></div>


	<!-- BEGIN: block_kh -->
	<form name="frmkho" method="post">
		<table width="100%" border="0">
			<tr>
				<td colspan="2" align="center" style="color:#FF6600;padding-bottom:10px">
					<h3>{t-c}</h3><input name="id" type="hidden" value="{idgoi}" />
				</td>
			</tr>
			<tr>
				<td width="17%">Số Tiền </td>
				<td width="83%">
					<input type="Text" ID="sotien" name="sotien" class="text" size="50" value="{sotien}" />
					*
				</td>
			</tr>
			<tr>
				<td width="17%">Tháng</td>
				<td width="83%">
					<select name="thang" id="thang" style="width: 209px;">
						{thangnam}
					</select>
				</td>
			</tr>
			<tr>
				<td width="17%">Tên Cửa Hàng</td>
				<td width="83%">
					<select name="tencuahang" id="tencuahang" style="width: 209px;">
						{muccha}
					</select>
				</td>
			</tr>
			<tr>
				<td width="17%">Đạt Được</td>
				<td width="83%">
					<input type="Text" ID="datduoc" name="datduoc" class="text" size="50" value="{datduoc}" />
				</td>
			</tr>


			<tr>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td colspan="2">
					<input type="Submit" class="text" name="btnUpdate" onclick="return kiemtra()" value="Cập nhập">
					<input type="submit" class="text" name="cancel" value="Quay Lại" />
				</td>
			</tr>
		</table>
	</form>

	<!-- END: block_kh -->
	<div id="hiennhapexcel" style="display:none;overflow:hidden;position:absolute;top: 90px;left:0;width:100%; "
		align="center">
		<div
			style="width:1187px; min-height:510px;border:1px #999 solid; background-color:#FFF; opacity: 0.98;font-size:15px;font-weight:bold; padding:5px; ">

			<div align="right"><b style="color:#00F;cursor:pointer" onclick="goidongid('hiennhapexcel')">( X Đóng lại
					)</b></div>

			<div id="timexxcel" style="padding:10px">
				<div>
					<input id="mangfilean" type="hidden" size="25" name="mangfilean" value="" />
					<label>File khách hàng Excel *.xlsx</label>
					<input id="fileToUpload" type="file" accept=".xlsx" size="35" name="fileToUpload" class="input"
						style="height:22px" />


				</div>

				<style>
					.chiao {
						display: flex;
						flex-direction: column;
						width: 40%;
						min-height: 120px;
						padding: 0 1em;
						justify-content: space-between;
						display: flex;
						flex-direction: column;
						width: 40%;
						min-height: 120px;
						padding: 0.5em 1em;
						justify-content: space-between;

						margin-right: 1em;
					}
				</style>
				<div style="margin: 0.5em;display: flex;justify-content: center;">
					<div class="chiao " style="  border: 1px solid red;">
						<p style="color:#FF0000;font-weight:bold">Tải lên Doanh thu khoán</p>
						<button class="button" id="buttonUpload"
							onclick="return ajaxFileUpload('DoanhthukhoanThang',thang.value);" style="height:22px">Tải
							lên </button>


					</div>
				</div>

				<div id="resupdate"></div>
				<div id="hienthiexcel" style="padding:5px">




				</div>

			</div>
		</div>
	</div>
	<script src="js/jquery-1.7.2.min.js"></script>
	<script src="js/select2.min.js"></script>
	<link rel="stylesheet" media="screen" href="js/select2.min.css">
	<script type="text/javascript" src="templates/ajaxfileupload.js"></script>
	<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/chart.js"></script>
	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
	<script>
		function xuly3() {

		}

		function timkiemcuahang(t1, t2, t3, t4, t5) {
			//console.log(t2);

			poststr = "DATA=" + encodeURIComponent(t1) + "*@!" + encodeURIComponent(t2) + "*@!" + encodeURIComponent(t3) + "*@!" + encodeURIComponent(t4) + "*@!" + encodeURIComponent(t5);
			loadtrang('hienthinhacc', "doanhthukhoantim", poststr, "xuly3");
		}


		function bieudodoanhthukhoan(t1, t2) {
			document.getElementById("bieudo").disabled = true;
			poststr = "DATA=" + encodeURIComponent(t1) + "*@!" + encodeURIComponent(t2);
			loadtrang('hienthinhacc', "doanhthukhoanbieudomien", poststr, "xuly1");
		}

		function xuly1() {
			document.getElementById("bieudo").disabled = false;
			eval(document.getElementById("dulieutongkhoan").innerHTML);

		}


		function nhapexcel1() {
			if (document.getElementById('hiennhapexcel').style.display == "") {
				document.getElementById('hiennhapexcel').style.display = "none";
			} else { document.getElementById('hiennhapexcel').style.display = ""; }


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
					/*+ tt + '_'+ nn*/
					{
						url: 'pancakefileuploaddata.php?us=' + tenfile,
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

									hienthidulieu(loai);

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
		function hienthidulieu(t1) {


			poststr = "DATA=" + encodeURIComponent(t1) + "*@!" + encodeURIComponent(0);
			loadtrang('hienthiexcel', 'doanhthukhoantailen', poststr, "");

		}

		function tailendatadoanhthu() {

			poststr = "luu=" + encodeURIComponent(0) + "*@!" + encodeURIComponent(0);
			loadtrang('hienthiexcel', "doanhthukhoantailen", poststr, "");
		}



	</script>


	<!-- BEGIN: block_khupdate -->
	<script language="JavaScript">
		alert('Cập nhập  thành công');
		location.replace("default.php?act=doanhthukhoan");
	</script>
	<!-- END: block_khupdate -->




	<script language="JavaScript">


		function bieudocuahangthukhoan(t1, t2, t3) {
			console.log(t3);
			document.getElementById("bieudocuahang").disabled = true;
			poststr = "DATA=" + encodeURIComponent(t1) + "*@!" + encodeURIComponent(t2) + "*@!" + encodeURIComponent(t3);
			if(document.getElementById("khoanchitietcuahang").innerHTML) {
				document.getElementById("khoanchitietcuahang").style.display = "none";
			}
			
			loadtrang('hienthinhacc', "doanhthukhoantimch", poststr, "xuly6");
		}

		function bieudothukhoanchitiet(t1, t2, t3) {
			// console.log(t3);
			document.getElementById("bieudocuahang").disabled = true;
			poststr = "DATA=" + encodeURIComponent(t1) + "*@!" + encodeURIComponent(t2) + "*@!" + encodeURIComponent(t3);
			document.getElementById("chart_find_stores").style.display = "none";
			document.getElementById("khoanchitietcuahang").style.display = "block";
			loadtrang('khoanchitietcuahang', "doanhthukhoanchitietch", poststr, "xuly7");
		}

		function bieudocuahangngay(t1, t2, t3) {
			console.log(t3);
			document.getElementById("bieudocuahang").disabled = true;
			poststr = "DATA=" + encodeURIComponent(t1) + "*@!" + encodeURIComponent(t2) + "*@!" + encodeURIComponent(t3);
			document.getElementById("khoanchitietcuahang").style.display = "none";
			loadtrang('hienthinhacc', "doanhthukhoanchtheongay", poststr, "xuly8");
		}
		function capnhapdoanhthu(t1) {
			poststr = "DATA=" + encodeURIComponent(t1) + "*@!" + encodeURIComponent(0) + "*@!" + encodeURIComponent(0);
			document.getElementById("khoanchitietcuahang").style.display = "none";
			loadtrang('hienthinhacc', "doanhthukhoancapnhapdoanhthu", poststr, "");
		}
		function xuly6() {
			document.getElementById("bieudocuahang").disabled = false;
			eval(document.getElementById("dulieucuahang").innerHTML);
		}

		function xuly8() {
			document.getElementById("bieudocuahang").disabled = false;
			eval(document.getElementById("dulieucuahang3").innerHTML);
		}

		function xuly7() {
			document.getElementById("bieudocuahang").disabled = false;
			eval(document.getElementById("dulieucuahang2").innerHTML);
		}

		function trim(str) {
			ch = '';
			for (i = 0; i < str.length; i++) {
				cha = str.charAt(i);
				if (cha != ' ') {
					ch = ch + cha;
				}
			}
			return ch;
		}

		function kiemtra() {
			if (trim(document.getElementById('Name').value) == '') {
				alert('Bạn chưa nhập tên  ');
				document.getElementById('Name').focus();
				return false;

			}

			return true;
		}

	</script>



	</fieldset>
</div>