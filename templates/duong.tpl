<div class="nenbao">
	<fieldset class="nencon">
		<legend> <a style="cursor:pointer">
				<label style="Color:#FF3300;Font-Weight:Bold;Font-size:9pt;"> Phường </label>
			</a></legend>

		<script language=JavaScript src='scripts/innovaeditor.js'></script>
		<!-- BEGIN: block_khht1 -->
		<form name="frmProduct1" method="post">
			<table width="100%" border="0" cellpadding="0" cellspacing="0">
				<tr>
					<td colspan="7">
						[ <a href="default.php?act=duong&id=-1">Thêm Mới</a>]

						&nbsp;&nbsp;[<a href="default.php?act=duong">Đóng Lại</a>]&nbsp;&nbsp;Tên
						<input type="text" name="NameS" class="text" size="10" value="{NameS}" />&nbsp;&nbsp;

						<select class="js-tinh-sl" id="stinh" name="stinh" value={tinh} style="width:200px">
							<option value="">vui lòng chọn tỉnh</option>
							{tinh}
						</select>
	
						<span style="color:#FF0000">*</span> Quận/Huyện
						<select class="js-quan-sl" name="squan" id="squan" value={quan} disabled="disabled"
							style="width:200px">
							{quan}
						</select>
	
						<span style="color:#FF0000">*</span> Phường/Xã
						<select class="js-phuong-sl" name="sphuong" id="sphuong" value={phuong} disabled="disabled"
							style="width:200px">
							{quan}
						</select>

						
						</tr>
						<input type="submit" name="search" value="Tìm kiếm" />
					</td>
				</tr>

				<tr bgcolor="#F8E4CB">
					<td align="center"
						style='border:solid windowtext 1.0pt; mso-border-alt:solid windowtext .5pt;padding:0in 0.4pt 0in 0.4pt'
						height="23" width="41"><b>STT</b></td>

					<td width="829" align="center"
						style='border:solid windowtext 1.0pt; mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
						<strong>Tỉnh</strong></td>
					<td width="829" align="center"
						style='border:solid windowtext 1.0pt; mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
						<strong>Quận </strong></td>
					<td width="829" align="center"
						style='border:solid windowtext 1.0pt; mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
						<strong>Phường </strong></td>
					<td width="829" align="center"
						style='border:solid windowtext 1.0pt; mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
						<strong>Đường</strong></td>


					<td width="201" align="center"
						style='border:solid windowtext 1.0pt; mso-border-alt:solid windowtext .5pt;padding:0in 0.4pt 0in 0.4pt'>
						<strong>C&#7853;p nh&#7853;p</strong></td>
					<td width="143" align="center"
						style='border:solid windowtext 1.0pt; mso-border-alt:solid windowtext .5pt;padding:0in 0.4pt 0in 0.4pt'>
						<strong>X&#243;a</strong></td>
				</tr>
				<!-- End: block_khht1 -->
				<!-- BEGIN: block_khht -->
				<tr bgcolor="{color}">
					<td style="border:solid windowtext 1.0pt; mso-border-alt:solid windowtext .5pt;padding:0in 0.4pt 0in 0.4pt;padding-right:12px"
						align="right">&nbsp;{stt}</td>

					<td valign="middle"
						style="border:solid windowtext 1.0pt; mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt">
						<label for="sele<%=j%>" style="Font-Weight:Normal;Color:Black;">&nbsp;{NameC}</label>
					</td>
					<td valign="middle"
						style="border:solid windowtext 1.0pt; mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt">
						<label for="sele<%=j%>" style="Font-Weight:Normal;Color:Black;">&nbsp;{NameB}</label>
					</td>
					<td valign="middle"
						style="border:solid windowtext 1.0pt; mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt">
						<label for="sele<%=j%>" style="Font-Weight:Normal;Color:Black;">&nbsp;{NameE}</label>
					</td>
					<td valign="middle"
						style="border:solid windowtext 1.0pt; mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt">
						<label for="sele<%=j%>" style="Font-Weight:Normal;Color:Black;">&nbsp;{NameD}</label>
					</td>
					
					

					<td align="center"
						style="border:solid windowtext 1.0pt; mso-border-alt:solid windowtext .5pt;padding:0in 3.4pt 0in 3.4pt">
						<label for="sele<%=j%>" style="Font-Weight:Normal;Color:Black;cursor:hand">
							<a href="default.php?act=duong&id={ID}"> <img src="images/book_addressHS.png"
									border="0"></a></label></td>


					<td align="center"
						style="border:solid windowtext 1.0pt; mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt">
						<a onclick='return ask()' href="default.php?act=duong&Del={ID}"><img src="images/delete.gif"
								border="0"></a></td>
				</tr>
				<!-- End: block_khht -->

				<!-- BEGIN: block_proht2 -->
				<tr style="padding-top:10">
					<td align="right" colspan="4"> {list_page}</td>
				</tr>
			</table>
			<input type="hidden" name="currentPage" />
		</form>
		<form action="" method="post">
			<button name="view">VIEW </button>
		</form>

		<!-- End: block_proht2 -->






		<!-- BEGIN: block_kh -->
		<form name="frmkho" id="frmkho" method="post">
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

				<table width="100%" border="0">


					<tr>
						<td width="17%">Tỉnh Thành</td>
						<td width="44%">

							<select class="js-tinh" id="idtinh" name="idtinh" value={tinh} style="width:200px">
								<option value="">vui lòng chọn tỉnh</option>
								{tinh}
							</select>




							<span style="color:#FF0000">*</span> Quận/Huyện
							<select class="js-quan" name="idquan" id="quan" value={quan} disabled="disabled"
								style="width:200px">
								{quan}
							</select>

							<span style="color:#FF0000">*</span> Phường/Xã
							<select class="js-phuong" name="idphuong" id="phuong" value={phuong} disabled="disabled"
								style="width:200px">
								{quan}
							</select>
						</td>

						<td width="11%" align="right">&nbsp; </td>
						<td width="28%">&nbsp; </td>
					</tr>
					<tr>
						<td width="17%">Đường </td>
						<td width="44%">
							<input type="Text" name="Name" id="Name" class="text" size="16" value="{Name}" />
						</td>
					<tr>
						<td width="17%">&nbsp; </td>
						<td width="83%">&nbsp;</td>
					</tr>
					<td width="11%" align="right">&nbsp; </td>
					<td width="28%">&nbsp; </td>
					</tr>

					<tr>
						<td width="17%">&nbsp;</td>
						<td>&nbsp;</td>
						<td width="11%" align="right">&nbsp; </td>
						<td>&nbsp;</td>
					</tr>
				</table>
				<br />


				<div style="padding-left:105px;padding-bottom:8px">
					<input type="Submit" class="text" name="btnUpdate" onclick="return kiemtra()" value="Cập nhập">
					<input type="submit" class="text" name="cancel" value="Quay Lại" />
				</div>
			</fieldset>



		</form>



		<!-- END: block_kh -->
		<!-- BEGIN: block_khupdate -->
		<script language="JavaScript">
			alert('Cập nhập Tỉnh - TP thành công');
			location.replace("default.php?act=duong");
		</script>
		<!-- END: block_khupdate -->

		<!-- BEGIN: block_ajack -->
		<script language="javascript">

			function makeObject() {
				var x;
				var browser = navigator.appName;
				if (browser == "Microsoft Internet Explorer") {
					x = new ActiveXObject("Microsoft.XMLHTTP");
				} else {
					x = new XMLHttpRequest();
				}
				return x;
			}

			var request = makeObject();


			//============================================================


			function findtemp(id) {
				request.open('get', 'findtemp.php?id=' + id);

				request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
				request.onreadystatechange = outputfindtemp;

				request.send('');
			}

			function outputfindtemp() {
				if (request.readyState == 1) { 		//You can add animated gif while loading //
					//document.getElementById('temp').innerHTML = "<p>&nbsp;</p><p align='left' style='padding-left:200'><img               src='images/downloading.gif'></p>";
				}
				if (request.readyState == 4) {
					var data = request.responseText;

					document.getElementById('templa').innerHTML = data;
				}
			}

			function ask() {
				var n = confirm("Bạn có muốn xóa không");
				if (n == false) {
					return false;

				}
			}


		</script>
		<!-- END: block_ajack -->
		<script language="JavaScript">

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

		</script>

		<div id="khonghienthi" style="display:none"></div>

		<script language="JavaScript">




			function chuyen(event, tieptheo, th) {
				capnhap = tieptheo;

				if (event.keyCode == 13 && document.getElementById('dachon').value == '0') {
					document.getElementById(tieptheo).focus();
					capnhap = tieptheo;

				} else {
					document.getElementById(th).focus();
					capnhap = th;
				}
				event.keyCode = '';
			}

		</script>
		<!-- END: block_cus -->
		<!-- BEGIN: block_cusupdate -->
		<script language="JavaScript">
			alert('Cập nhập khách hàng thành công');
			location.replace("default.php?act=duong");
		</script>
		<!-- END: block_cusupdate -->

		<script src="js/jquery-1.7.2.min.js"></script>
		<script src="js/select2.min.js"></script>
		<link rel="stylesheet" media="screen" href="js/select2.min.css">

		<script language="javascript">
			var tinh = '';
			var quan = '';
			var thanhpho = '';

			$(document).ready(function () {
				$('.js-tinh').select2();
				$('.js-ch').select2();
				$('.js-quan').select2();
				$('.js-phuong').select2();
				$('.js-tinh').on('select2:selecting', function (e) {
					//console.log('Selecting: ' , e.params.args.data);
				tinh = e.params.args.data.id;
				var poststr = "TINH=" + encodeURIComponent(e.params.args.data.id) + "*@!";

					loadtrang('khonghienthi', "ajaxtinhthanh", poststr, "xuly9");
				});

				$('.js-quan').on('select2:selecting', function (e) {
					var poststr = "THANH=" + encodeURIComponent(tinh) + "*@!" + encodeURIComponent(e.params.args.data.id);
					loadtrang('khonghienthi', "ajaxtinhthanh", poststr, "xuly8");
				});

				$('.js-phuong').on('select2:selecting', function (e) {
					var poststr = "PHUONG=" + encodeURIComponent(quan) + "*@!" + encodeURIComponent(e.params.args.data.id);
					loadtrang('khonghienthi', "ajaxtinhthanh", poststr, "xuly10");
				});
			});
			function xuly9() {

				var tam = document.getElementById('khonghienthi').innerHTML;
				var quan = document.getElementById("quan");//thêm mới

				var squan = document.getElementById("squan");// tìm kiếm

				if (tam != "") {

					quan.innerHTML = tam;
					quan.disabled = false;

					squan.innerHTML = tam;
					squan.disabled = false;


				}


			}
			function xuly8() {

				var tam = document.getElementById('khonghienthi').innerHTML;
				var phuong = document.getElementById("phuong");
				var sphuong = document.getElementById("sphuong");

				if (tam != "") {

					phuong.innerHTML = tam;
					phuong.disabled = false;

					sphuong.innerHTML = tam;
					sphuong.disabled = false;

				}


			}

			function xuly10() {

				var tam = document.getElementById('khonghienthi').innerHTML;
				var duong = document.getElementById("duong");

				if (tam != "") {

					duong.innerHTML = tam;
					duong.disabled = false;

				}


			}

			//============================================================
			function ask() {
				var n = confirm("Bạn có muốn xóa không");
				if (n == false) {
					return false;

				}
			}
			function quaylai() {
				location.replace("default.php?act=customer");
			}
			//=======================
			function settype(valu) {
				document.getElementById('dachon').value = valu;

			}
			function kiemtra() {
				// if (capnhap != '') { return false ;}



				if (document.getElementById('IDKhuVuc').value == "0") {
					alert('Bạn chưa nhập tỉnh thành');
					document.getElementById('IDKhuVuc').focus();
					return false;
				}

				return true;
			}


			function xuly5() {
				document.getElementById("hiethithongbao").style.display = '';
			}
			function goidongthe() {
				document.getElementById("hiethithongbao").style.display = 'none';
			}

			function setkh(t1, t2, t3) {
				return false;
			}
			// document.getElementById("Name").focus(); 
		</script>

		<!-- tìm kiếm -->

		<script language="javascript">
			var tinh = '';
			var quan = '';
			var thanhpho = '';

			$(document).ready(function () {
				$('.js-tinh-sl').select2();
				$('.js-ch').select2();
				$('.js-quan-sl').select2();
				$('.js-phuong-sl').select2();
				$('.js-tinh-sl').on('select2:selecting', function (e) {
					//console.log('Selecting: ' , e.params.args.data);
				tinh = e.params.args.data.id;
				var poststr = "TINH=" + encodeURIComponent(e.params.args.data.id) + "*@!";

					loadtrang('khonghienthi', "ajaxtinhthanh", poststr, "xuly11");
				});

				$('.js-quan-sl').on('select2:selecting', function (e) {
					var poststr = "THANH=" + encodeURIComponent(tinh) + "*@!" + encodeURIComponent(e.params.args.data.id);
					loadtrang('khonghienthi', "ajaxtinhthanh", poststr, "xuly12");
				});

				$('.js-phuong-sl').on('select2:selecting', function (e) {
					var poststr = "PHUONG=" + encodeURIComponent(quan) + "*@!" + encodeURIComponent(e.params.args.data.id);
					loadtrang('khonghienthi', "ajaxtinhthanh", poststr, "xuly10");
				});
			});
			function xuly11() {

				var tam = document.getElementById('khonghienthi').innerHTML;
				var squan = document.getElementById("squan");// tìm kiếm

				if (tam != "") {

					squan.innerHTML = tam;
					squan.disabled = false;


				}


			}
			function xuly12() {

				var tam = document.getElementById('khonghienthi').innerHTML;
				var sphuong = document.getElementById("sphuong");

				if (tam != "") {

					sphuong.innerHTML = tam;
					sphuong.disabled = false;

				}


			}


			//============================================================
			function ask() {
				var n = confirm("Bạn có muốn xóa không");
				if (n == false) {
					return false;

				}
			}
			function quaylai() {
				location.replace("default.php?act=customer");
			}
			//=======================
			function settype(valu) {
				document.getElementById('dachon').value = valu;

			}
			function kiemtra() {
				// if (capnhap != '') { return false ;}

				if (document.getElementById('IDKhuVuc').value == "0") {
					alert('Bạn chưa nhập tỉnh thành');
					document.getElementById('IDKhuVuc').focus();
					return false;
				}

				return true;
			}


			function xuly5() {
				document.getElementById("hiethithongbao").style.display = '';
			}
			function goidongthe() {
				document.getElementById("hiethithongbao").style.display = 'none';
			}

			function setkh(t1, t2, t3) {
				return false;
			}
			// document.getElementById("Name").focus(); 
		</script>
		<!-- BEGIN: block_khongxoa -->
		<script language="JavaScript">
			alert('Bạn không thể xóa khách hàng này do đã có nơi sử dụng  rồi !!! ');
		</script>
		<!-- END: block_khongxoa -->
	</fieldset>
</div>