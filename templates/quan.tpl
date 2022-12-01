<div class="nenbao">
	<fieldset class="nencon">
		<legend> <a style="cursor:pointer">
				<label style="Color:#FF3300;Font-Weight:Bold;Font-size:9pt;">Quận</label>
			</a></legend>

		<script language=JavaScript src='scripts/innovaeditor.js'></script>
		<!-- BEGIN: block_khht1 -->
		<form name="frmProduct1" method="post">
			<table width="100%" border="0" cellpadding="0" cellspacing="0">
				<tr>
					<td colspan="7">
						[ <a href="default.php?act=quan&id=-1">Thêm Mới</a>]&nbsp;&nbsp;[<a
							href="default.php?act=md">Đóng Lại</a>]&nbsp;&nbsp;Tên
						<input type="text" name="NameS" class="text" size="10" value="{NameS}" />&nbsp;&nbsp;
						<input type="submit" name="search" value="Tìm kiếm" />
					</td>
				</tr>

				<tr bgcolor="#F8E4CB">
					<td align="center"
						style='border:solid windowtext 1.0pt; mso-border-alt:solid windowtext .5pt;padding:0in 0.4pt 0in 0.4pt'
						height="23" width="41"><b>STT</b></td>

					<td width="829" align="center"
						style='border:solid windowtext 1.0pt; mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
						<strong>Tên tỉnh </strong>
					</td>

					<td width="829" align="center"
						style='border:solid windowtext 1.0pt; mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
						<strong>Tên quận </strong>
					</td>


					<td width="201" align="center"
						style='border:solid windowtext 1.0pt; mso-border-alt:solid windowtext .5pt;padding:0in 0.4pt 0in 0.4pt'>
						<strong>Cập nhập</strong>
					</td>
					<td width="143" align="center"
						style='border:solid windowtext 1.0pt; mso-border-alt:solid windowtext .5pt;padding:0in 0.4pt 0in 0.4pt'>
						<strong>Xóa</strong>
					</td>
				</tr>
				<!-- End: block_khht1 -->
				<!-- BEGIN: block_khht -->
				<tr bgcolor="{color}">
					<td style="border:solid windowtext 1.0pt; mso-border-alt:solid windowtext .5pt;padding:0in 0.4pt 0in 0.4pt;padding-right:12px"
						align="right">&nbsp;{stt}</td>

					<td valign="middle"
						style="border:solid windowtext 1.0pt; mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt">
						<label for="sele<%=j%>" style="Font-Weight:Normal;Color:Black;">&nbsp;{NameC} </label>
					</td>

					<td valign="middle"
						style="border:solid windowtext 1.0pt; mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt">
						<label for="sele<%=j%>" style="Font-Weight:Normal;Color:Black;">&nbsp;{NameD} {NameB} </label>
					</td>


					<td align="center"
						style="border:solid windowtext 1.0pt; mso-border-alt:solid windowtext .5pt;padding:0in 3.4pt 0in 3.4pt">
						<label for="sele<%=j%>" style="Font-Weight:Normal;Color:Black;cursor:hand">
							<a  href="default.php?act=quan&id={IDquan}"> 
								<img src="images/book_addressHS.png"
									border="0"></a></label>
					</td>

					<td align="center"
						style="border:solid windowtext 1.0pt; mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt">
						<a class="idbtnupdate"  onclick='return ask()' href="default.php?act=quan&Del={IDquan}"><img src="images/delete.gif"
								border="0"></a>
					</td>
				</tr>
				
				<script>
				function ask() {
				var n = confirm("Bạn có muốn xóa không");
				if (n == false) {
					return false;

				}
			}
			function quaylai() {
				location.replace("default.php?act=customer");
			}
				</script>
				<!-- End: block_khht -->

				<!-- BEGIN: block_proht2 -->
				<tr style="padding-top:10">
					<td align="right" colspan="4"> {list_page}</td>
				</tr>
			</table>
			<input type="hidden" name="currentPage" />
		</form>
		<!-- End: block_proht2 -->


		<!-- BEGIN: block_kh -->
		<form name="frmkho" method="post">
			<table width="100%" border="0">
				<tr>
					<td colspan="2" align="center" style="color:#FF6600;padding-bottom:10px">
						<h3>{t-c}</h3><input name="id" type="hidden" value="{idgoi}" />
						<!-- <input type="text" id="loadtinh" name="loadtinh" value="" onchange="loadtinh(event)"> -->
					</td>
				</tr>


				<tr>
					<td width="17%">Thành Phố</td>
					<td width="83%">
						<select class="idtinh" name="idtinh" id="idtinh"  onkeypress="return chuyentiep(event,'idtinh')">
							<option value="0">Thành Phố</option>
							{tinh}
						</select>
						
					</td>
				</tr>
				<tr>
					<td width="17%">Loại </td>
					<td width="83%">
						<select class="idquan" name="idquan" id="idquan" onkeypress="return chuyentiep(event,'idquan')">
							<option value="0">Chọn loại</option>
							<option value="1" {loai1}>Quận</option>
							<option value="2" {loai2}>Huyện</option>
						</select>
					</td>
				</tr>
				<tr>
					<td width="17%">Quận </td>
					<td width="83%">
						<input type="Text" name="Name" ID="Name" class="text" size="6" value="{Name}" />
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

		<script src="js/select2.min.js"></script>
		<link rel="stylesheet" media="screen" href="js/select2.min.css">
		<script>
			// $('.js-tinh').select2();
			$('.idtinh, .idquan').select2();
		</script>

		<!-- END: block_kh -->
		<!-- BEGIN: block_khupdate -->
		<script language="JavaScript">
			alert('Cập nhập Tỉnh - TP thành công');
			location.replace("default.php?act=quan");
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

			function kiemtra() {
				if (trim(document.getElementById('Name').value) == '') {
					alert('Bạn chưa nhập tên Tỉnh ');
					document.getElementById('Name').focus();
					return false;

				}

				return true;
			}

		</script>

	</fieldset>
</div>