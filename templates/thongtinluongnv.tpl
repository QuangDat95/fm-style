<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<style>
	.thongtinchitiet input,
	.thongtincoban input {
		width: 200px;
		height: 35px !important;
		margin: 3px 0px;
	}

	.chitietthucap {
		padding-left: 20px;
	}

	.select2-selection--single {
		height: 35px !important;
	}

	.select2-search__field {
		width: 100% !important;
	}
</style>

<br />
<div class="nenbao">
	<fieldset class="nencon">
		<legend> <a style="cursor:pointer">
				<label style="Color:#FF3300;Font-Weight:Bold;Font-size:9pt;"> Thông tin lương </label>
			</a></legend>

		<!--<script language="JavaScript" src='js/innovaeditor.js'></script>-->
		<!-- BEGIN: block_khht1 -->
		<form name="frmProduct1" method="post">
			<table width="100%" border="0" cellpadding="0" cellspacing="0">
				<tr>
					<td colspan="13">
						[ <a href="default.php?act=thongtinluongnv&id=-1">Thêm mới</a>]

						[<a href="default.php?act=md">Đóng Lại</a>]&nbsp;&nbsp;Mã NV
						<input type="text" name="maS" class="text" size="10" value="{maS}" />&nbsp;&nbsp;
						<select name="phongbanS" id="phongbanS" style="height:30px;width:100px" class="js-phongbantim">
							<option value="">Phòng ban</option>
							{phongban}
						</select>
						<select name="chucvuS" id="chucvuS" style="height:30px;width:100px" class="js-cvtim">
							<option value="">Chức vụ</option>
							{kh_chucvu}
						</select>
						<input type="date" name="thangS" id="thangS" style="height:30px" value="{thangS}" />
						<input type="submit" name="search" value="Tìm kiếm" />
						<input type="date" id="luongthangmoi" style="height:30px" onchange="setthangs(this.value)"
							name="luongthangmoi" />
						<input type="button" name="loadmoi" onclick="loadmoif()" value="Load mới" />

						<input type="button" name="nhapexel" onclick="nhapexcel1()" value="Nhập exel" />
						<!--<div id="loadmoires"></div>-->
					</td>

				<tr bgcolor="#F8E4CB">
					<td align="center"
						style='border:solid windowtext 1.0pt; mso-border-alt:solid windowtext .5pt;padding:0in 0.4pt 0in 0.4pt'
						height="23" width="48"><b>STT</b></td>
					<td width="103" align="center"
						style='border:solid windowtext 1.0pt; mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
						<strong>Lương tháng </strong>
					</td>
					<td width="74" align="center"
						style='border:solid windowtext 1.0pt; mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
						<strong>Mã nhân viên </strong>
					</td>
					<td width="74" align="center"
						style='border:solid windowtext 1.0pt; mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
						<strong>Tên nhân viên </strong>
					</td>
					<td width="104" align="center"
						style='border:solid windowtext 1.0pt; mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt'>
						<strong>Lương cơ bản</strong>
					</td>

					<td width="89" align="center"
						style='border:solid windowtext 1.0pt; mso-border-alt:solid windowtext .5pt;padding:0in 0.4pt 0in 0.4pt'>
						<strong>Lương KPI</strong>
					</td>
					<td width="98" align="center"
						style='border:solid windowtext 1.0pt; mso-border-alt:solid windowtext .5pt;padding:0in 0.4pt 0in 0.4pt'>
						<strong>Giờ trên ngày</strong>
					</td>
					<td width="132" align="center"
						style='border:solid windowtext 1.0pt; mso-border-alt:solid windowtext .5pt;padding:0in 0.4pt 0in 0.4pt'>
						<strong>Lương ngày công</strong>
					</td>
					<td width="114" align="center"
						style='border:solid windowtext 1.0pt; mso-border-alt:solid windowtext .5pt;padding:0in 0.4pt 0in 0.4pt'>
						<strong>Lương chỉ tiêu</strong>
					</td>
					<td width="141" align="center"
						style='border:solid windowtext 1.0pt; mso-border-alt:solid windowtext .5pt;padding:0in 0.4pt 0in 0.4pt'>
						<strong>Giờ công</strong>
					</td>
					<td width="77" align="center"
						style='border:solid windowtext 1.0pt; mso-border-alt:solid windowtext .5pt;padding:0in 0.4pt 0in 0.4pt'>
						<strong>Chức vụ</strong>
					</td>
					<td width="94" align="center"
						style='border:solid windowtext 1.0pt; mso-border-alt:solid windowtext .5pt;padding:0in 0.4pt 0in 0.4pt'>
						<strong>Phòng ban</strong>
					</td>
					<td width="45" align="center"
						style='border:solid windowtext 1.0pt; mso-border-alt:solid windowtext .5pt;padding:0in 0.4pt 0in 0.4pt'>
						<strong>Cập nhật</strong>
					</td>
					<td width="53" align="center"
						style='border:solid windowtext 1.0pt; mso-border-alt:solid windowtext .5pt;padding:0in 0.4pt 0in 0.4pt'>
						<strong>xóa</strong>
					</td>
				</tr>
				<!-- End: block_khht1 -->
				<tbody id="loadmoires">
					<!-- BEGIN: block_khht -->
					<tr bgcolor="{color}">
						<td style="border:solid windowtext 1.0pt; mso-border-alt:solid windowtext .5pt;padding:0in 0.4pt 0in 0.4pt;padding-right:12px"
							align="right">&nbsp;{stt}</td>

						<td valign="middle"
							style="border:solid windowtext 1.0pt; mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt">
							<label for="sele<%=j%>" style="Font-Weight:Normal;Color:Black;">&nbsp;{luongthang}</label>
						</td>
						<td valign="middle"
							style="border:solid windowtext 1.0pt; mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt">
							<label for="sele<%=j%>" style="Font-Weight:Normal;Color:Black;">&nbsp;{manv}</label>
						</td>
						<td valign="middle"
							style="border:solid windowtext 1.0pt; mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt">
							<label for="sele<%=j%>" style="Font-Weight:Normal;Color:Black;">&nbsp;{tennv}</label>
						</td>
						<td valign="middle"
							style="border:solid windowtext 1.0pt; mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt">
							<label for="sele<%=j%>" style="Font-Weight:Normal;Color:Black;">&nbsp;{luongcoban}</label>
						</td>
						<td valign="middle"
							style="border:solid windowtext 1.0pt; mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt">
							<label for="sele<%=j%>" style="Font-Weight:Normal;Color:Black;">&nbsp;{luongkpi}</label>
						</td>
						<td valign="middle"
							style="border:solid windowtext 1.0pt; mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt">
							<label for="sele<%=j%>" style="Font-Weight:Normal;Color:Black;">&nbsp;{giotrenngay}</label>
						</td>
						<td valign="middle"
							style="border:solid windowtext 1.0pt; mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt">
							<label for="sele<%=j%>"
								style="Font-Weight:Normal;Color:Black;">&nbsp;{luongngaycong}</label>
						</td>
						<td valign="middle"
							style="border:solid windowtext 1.0pt; mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt">
							<label for="sele<%=j%>" style="Font-Weight:Normal;Color:Black;">&nbsp;{luongchitieu}</label>
						</td>
						<td valign="middle"
							style="border:solid windowtext 1.0pt; mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt">
							<label for="sele<%=j%>" style="Font-Weight:Normal;Color:Black;">&nbsp;{giocong}</label>
						</td>
						<td valign="middle"
							style="border:solid windowtext 1.0pt; mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt">
							<label for="sele<%=j%>" style="Font-Weight:Normal;Color:Black;">&nbsp;{chucvu}</label>
						</td>
						<td valign="middle"
							style="border:solid windowtext 1.0pt; mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt">
							<label for="sele<%=j%>" style="Font-Weight:Normal;Color:Black;">&nbsp;{phongban}</label>
						</td>
						<td align="center"
							style="border:solid windowtext 1.0pt; mso-border-alt:solid windowtext .5pt;padding:0in 3.4pt 0in 3.4pt">
							<label for="sele<%=j%>" style="Font-Weight:Normal;Color:Black;cursor:hand">
								<a href="default.php?act=thongtinluongnv&id={ID}"> <img src="images/book_addressHS.png"
										border="0"></a></label>
						</td>


						<td align="center"
							style="border:solid windowtext 1.0pt; mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt">
							<a onclick='return ask()' href="default.php?act=thongtinluongnv&Del={ID}"><img
									src="images/delete.gif" border="0"></a>
						</td>
					</tr>
					<!-- End: block_khht -->

					<!-- BEGIN: block_proht2 -->
					<tr style="padding-top:10">
						<td align="right" colspan="4"> {list_page}</td>
					</tr>
				</tbody>
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
				<div class="thongtincoban">
					<h3>Thông tin cơ bản</h3>
					<div class="chitietthucap">
						<table width="100%" border="0">
							<tr>
								<td><strong>Phòng ban</strong></td>
								<td><select id="phongban" name="phongban" class="js-phongban" style="width:200px"
										onchange="">
										<option value="">Chọn phòng ban</option>
										{phongban}
									</select>
								</td>
								<td> <strong>Cửa hàng</strong>
								</td>
								<td><select id="idcuahang" name="idcuahang" class="js-cuahang" style="width:200px">
										<option value="">Chọn cửa hàng</option>
										{cuahang}
									</select></td>
								<td><strong>Chức vụ</strong></td>
								<td><select id="chucvu" name="chucvu" class="js-chucvu" style="width:200px" onchange="">
										<option value="">Chọn Chức vụ</option>
										{kh_chucvu}
									</select></td>

							</tr>
							<tr>

								<td><strong>Nhân viên</strong></td>
								<td>
									<select id="idnhanvien" name="idnhanvien" class="js-nhanvien" style="width:200px"
										onchange="getnhanvientheoma(event)">
										<option value="">Chọn nhân viên</option>
										{nhanvien}
									</select>
								</td>
								<td> <strong>Tên nhân viên</strong></td>
								<td><input type="text" name="tennv" id="tennv" value="{tennv}" /></td>
								<td><strong>Mã nhân viên</strong></td>
								<td>
									<input type="text" name="manv" id="manv" onchange="getnhanvientheoma(event)"
										value="{manv}" />
									<div id="hienthinone" style="display: inline-block;"></div>

								</td>
							</tr>
							<tr>
								<td><strong>Chức danh</strong></td>
								<td><input type="text" id="chucdanh" name="chucdanh" value="{chucdanh}" /></td>
								<td><strong>Lương tháng</strong></td>
								<td><input type="date" id="luongthang" name="luongthang" style="height:30px"
										value="{luongthang}" /></td>

								<td><strong>ngày chuẩn</strong></td>
								<td><input type="text" id="ngaychuan" name="ngaychuan" value="{ngaychuan}" /></td>

							</tr>
							<tr>
								<td><strong>Số giờ trên ngày</strong></td>
								<td><input type="text" id="giotrenngay" name="giotrenngay" value="{giotrenngay}" /></td>
								<td><strong>Lương cơ bản</strong></td>
								<td><input type="text" id="luongcoban" name="luongcoban" value="{luongcoban}" /></td>
								<td><strong>Giờ công</strong></td>
								<td><input type="text" id="giocong" name="giocong" value="{giocong}" /></td>


							</tr>
							<tr>
								<td><strong>Lương ngày công</strong></td>
								<td><input type="text" id="luongngaycong" name="luongngaycong"
										value="{luongngaycong}" /></td>
								<td><strong>Số ngày trong tháng</strong></td>
								<td><input type="text" id="songaytrongthang" name="songaytrongthang"
										value="{songaytrongthang}" /></td>
								<td><strong>Số ngày mở của</strong></td>
								<td><input type="text" id="songaymocua" name="songaymocua" value="{songaymocua}" /></td>
							</tr>
							<tr>
								<td><strong>Lương doanh số</strong></td>
								<td><input type="text" id="luongdoanhso" name="luongdoanhso" value="{luongdoanhso}" />
								</td>
								<td><strong>Phụ cấp</strong></td>
								<td><input type="text" id="phucap" name="phucap" value="{phucap}" /></td>
								<td><strong>Phụ cấp dịch</strong></td>
								<td><input type="text" id="phucapdich" name="phucapdich" value="{phucapdich}" /></td>

							</tr>
							<tr>
								<td><strong>Phụ cấp khác</strong></td>
								<td><input type="text" id="phucapkhac" name="phucapkhac" value="{phucapkhac}" /></td>
								<td><strong>Phạt</strong></td>
								<td><input type="text" id="phat" name="phat" value="{phat}" /></td>
								<td><strong>BHXH</strong></td>
								<td><input type="text" id="bhxh" name="bhxh" value="{bhxh}" /></td>

							</tr>
						</table>
					</div>
				</div>

				<div class="thongtinchitiet">
					<h3>Thông tin chi tiết</h3>
					<div class="chitietthucap">
						<h4><strong>Chi tiết lương</strong></h4>
						<table width="100%" border="0">

							<tr>
								<td><strong>Thu nhập</strong></td>
								<td><input type="text" id="thunhap" name="thunhap" value="{thunhap}" /></td>
								<td><strong>Lương cũ</strong></td>
								<td><input type="text" id="luongcu" name="luongcu" value="{luongcu}" /></td>
								<td><strong>Công nợ</strong></td>
								<td><input type="text" id="congno" name="congno" value="{congno}" /></td>

							</tr>

							<tr>
								<td><strong>Đã ứng</strong></td>
								<td><input type="text" id="daung" name="daung" value="{daung}" /></td>
								<td><strong>Giữ lương</strong></td>
								<td><input type="text" id="giuluong" name="giuluong" value="{giuluong}" /></td>
								<td><strong>Thực nhận</strong></td>
								<td><input type="text" id="thucnhan" name="thucnhan" value="{thucnhan}" /></td>

							</tr>
							<tr>
								<td><strong>Lương trách nhiệm</strong></td>
								<td><input type="text" id="luongtrachnhiem" name="luongtrachnhiem"
										value="{luongtrachnhiem}" />
								</td>
								<td><strong>Lương KPI miền</strong></td>
								<td><input type="text" id="luongkpimien" name="luongkpimien" value="{luongkpimien}" />
								</td>
								<td><strong>lương CP trên DT</strong></td>
								<td><input type="text" id="luongdoanhthu" name="luongdoanhthu"
										value="{luongdoanhthu}" /></td>


							</tr>

							<tr>
								<td><strong>Lương chỉ tiêu</strong></td>
								<td><input type="text" id="luongchitieu" name="luongchitieu" value="{luongchitieu}" />
								</td>
								<td><strong>Ngày vào làm</strong></td>
								<td><input type="date" id="ngayvaolam" name="ngayvaolam" value="{ngayvaolam}" /></td>
								<td><strong>Lương DT BH TN BV</strong></td>
								<td><input type="text" id="Luongdtbhtnbv" name="Luongdtbhtnbv"
										value="{Luongdtbhtnbv}" /></td>
							</tr>
							<tr>
								<td><strong>Lương DT CP CT</strong></td>
								<td><input type="text" id="luongdtcpct" name="luongdtcpct" value="{luongdtcpct}" /></td>
								<td><strong>Lương KPI</strong></td>
								<td><input type="text" id="luongkpi" name="luongkpi" value="{luongkpi}" /></td>
								<td><strong>Phần trăm doanh thu </strong></td>
								<td><input type="text" id="phantramdoanhthu" name="phantramdoanhthu"
										value="{phantramdoanhthu}" /></td>
							</tr>
							<tr>
								<td><strong>Hệ số lương </strong></td>
								<td><input type="text" id="hesoluong" name="hesoluong" value="{hesoluong}" /></td>
								<td><strong>Mã chạy thưởng</strong></td>
								<td><input type="text" id="machaythuong" name="machaythuong" value="{machaythuong}" />
								</td>
								<td><strong>Mã chạy lương</strong></td>
								<td><input type="text" id="machayluong" name="machayluong" value="{machayluong}" /></td>
							</tr>
							<tr>
								<td><strong>Trừ giờ công tính SP</strong></td>
								<td><input type="text" id="trugiocongtinhsp" name="trugiocongtinhsp"
										value="{trugiocongtinhsp}" /></td>
								<td><strong>Thưởng CS</strong></td>
								<td><input type="text" id="thuongcs" name="thuongcs" value="{thuongcs}" /></td>
								<td><strong>Thưởng TOP</strong></td>
								<td><input type="text" id="thuongtop" name="thuongtop" value="{thuongtop}" /></td>
							</tr>
						</table>
					</div>
					<div class="chitietthucap">
						<h4><strong>Doanh thu</strong></h4>
						<table width="100%" border="0">
							<tr>
								<td><strong>Doanh thu mỗi cửa hàng (%)</strong></td>
								<td><input type="text" id="doanhthumoicuahang" name="doanhthumoicuahang"
										value="{doanhthumoicuahang}" /></td>

							</tr>
							<tr>
								<td><strong>Dịch vụ (%)</strong></td>
								<td><input type="text" id="dichvu" name="dichvu" value="{dichvu}" /></td>
								<td><strong>Doanh thu thực</strong></td>
								<td><input type="text" id="doanhthuthuc" name="doanhthuthuc" value="{doanhthuthuc}" />
								</td>
								<td><strong>Doanh thu cá nhân</strong></td>
								<td><input type="text" id="doanhthucanhan" name="doanhthucanhan"
										value="{doanhthucanhan}" />
								</td>
							</tr>
							<tr>

								<td><strong>Doanh thu đạt (%) </strong></td>
								<td><input type="text" id="doanhthumuctieu" name="doanhthumuctieu"
										value="{doanhthumuctieu}" />
								</td>
								<td><strong>Hệ số doanh thu</strong></td>
								<td><input type="text" id="hesodoanhthu" name="hesodoanhthu" value="{hesodoanhthu}" />
								</td>
								<td><strong>Doanh thu muc tiêu</strong></td>
								<td><input type="text" id="doanhthumuctieu" name="doanhthumuctieu"
										value="{doanhthumuctieu}" />
								</td>
							</tr>

						</table>
					</div>
					<div class="chitietthucap">
						<h4><strong>Chi tiết Khác</strong></h4>
						<table width="100%" border="0">
							<tr>
								<td><strong>Hàng Hóa (%)</strong></td>
								<td><input type="text" id="hanghoa" name="hanghoa" value="{hanghoa}" /></td>
								<td><strong>Nhân sự và đào tạo (%)</strong></td>
								<td><input type="text" id="nhansuvadaotao" name="nhansuvadaotao"
										value="{nhansuvadaotao}" />
								</td>
								<td><strong>Xác nhận</strong></td>
								<td><input type="text" id="xacnhan" name="xacnhan" value="{xacnhan}" /></td>
							</tr>
							<tr>
								<td><strong>Xác nhận luong thử việc</strong></td>
								<td><input type="text" id="xacnhanluongthuviec" name="xacnhanluongthuviec"
										value="{xacnhanluongthuviec}" /></td>
								<td><strong>Giờ công tính SP</strong></td>
								<td><input type="text" id="giocongtinhsp" name="giocongtinhsp"
										value="{giocongtinhsp}" /></td>
								<td><strong>Hoa hồng</strong></td>
								<td><input type="text" id="hoahong" name="hoahong" value="{hoahong}" /></td>
							</tr>
							<tr>

								<td><strong>Số của hàng quản lý</strong></td>
								<td><input type="text" id="socuahang" name="socuahang" value="{socuahang}" /></td>
							</tr>
						</table>
					</div>
				</div>
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
			location.replace("default.php?act=thongtinluongnv");
		</script>
		<!-- END: block_khupdate -->

		<!-- BEGIN: block_ajack -->
		<script language="javascript">
			$(document).ready(function () {

				$('.js-cvtim').select2();
				$('.js-phongbantim').select2();
				$('.js-chucvu').select2();
				$('.js-phongban').select2();
				$('.js-nhanvien').select2();
				$('.js-cuahang').select2();
			})
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

			function loadmoif() {
				console.log("ok");
				var thang = document.getElementById("luongthangmoi").value;
				if (thang) {
					var poststr = "LOADMOI=" + encodeURIComponent(thang) + "*@!" + encodeURIComponent(0);

					loadtrang('loadmoires', "tinhluongajax", poststr, "xuly6");
				}
				else {
					alert("Vui lòng chọn tháng cần load!");
				}

			}

			function xuly6() {


			}

			function setthangs(value) {
				document.getElementById("thangS").value = value;
			}
			/*(setMintoday)();
			function setMintoday(){
			
			var today = new Date().toISOString().split('T')[0];
			console.log(today);
			document.getElementById("luongthangmoi").setAttribute('min', today);
			
			}*/
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

		<div id="khonghienthi"></div>

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
			alert('Cập nhập thành công');
			location.replace("default.php?act=thongtinluongnv");
		</script>
		<!-- END: block_cusupdate -->

		<script src="js/jquery-1.7.2.min.js"></script>
		<script src="js/select2.min.js"></script>
		<link rel="stylesheet" media="screen" href="js/select2.min.css">

		<script language="javascript">

			function getlistnv() {

				var chucvu = document.getElementById('chucvu').value;
				var phongban = document.getElementById('phongban').value;
				var manv = document.getElementById('manv').value;
				if (chucvu && !manv) {
					var poststr = "GETNHANVIEN=" + encodeURIComponent(phongban) + "*@!" + encodeURIComponent(chucvu);

					loadtrang('idnhanvien', "kpiajax", poststr, "xuly1");
				}



			}

			function getnhanvientheoma(e) {
				document.getElementById('hienthinone').style.display = "inline-block";
				var value = e.target.value;

				//var idnhanvien =document.getElementById('idnhanvien').value;

				//if(!idnhanvien){
				var poststr = "GETNHANVIENMA=" + encodeURIComponent(value) + "*@!" + encodeURIComponent(0);

				loadtrang('hienthinone', "kpiajax", poststr, "xuly1");
				//var poststr = "SETPB=" + encodeURIComponent(value) + "*@!"+ encodeURIComponent(0);

				//loadtrang('hienthinone', "kpiajax", poststr, "xuly4");

				//}
			}

			function xuly1() {
				var tam = document.getElementById("hienthinone").innerHTML;
				//console.log(tam)
				if (tam) {
					tam = tam.split("###");
					console.log(tam)
					if (tam[1] == -1) {
						alert(tam[2]);
					} else {

						$('#chucvu').val(tam[4]);
						$('#chucvu').select2().trigger('change');
						$('#phongban').val(tam[5]);
						$('#phongban').select2().trigger('change');
						$("#tennv").val(tam[6]);
						$("#manv").val(tam[3]);
						$('#idcuahang').val(tam[7]);
						$('#idcuahang').select2().trigger('change');

						$('#luongcoban').val(tam[8]);
						$('#luongkpi').val(tam[9]);
						$('#socuahang').val(tam[10]);
						$('#luongtrachnhiem').val(tam[11]);
						$('#luongkpimien').val(tam[12]);
						$('#luongkpidoanhthu').val(tam[13]);

					}
					document.getElementById("hienthinone").style.display = "none";
				}
				//$('.js-nhanvien').select2();
				//var ten =$('.js-nhanvien :selected').text();


				/*var tam=document.getElementById("hienthinone").innerHTML;
				if(tam){
					document.getElementById("idnhanvien").innerHTML(tam);
				}
				console.log(tam);*/
			}

			function getmanv(e) {
				document.getElementById('hienthinone').style.display = "inline-block";
				var target = e.target;
				var value = target.value;

				var poststr = "GETMANHANVIEN=" + encodeURIComponent(value) + "*@!" + encodeURIComponent(0);

				loadtrang('hienthinone', "kpiajax", poststr, "xuly3");
			}
			function xuly3() {
				document.getElementById('hienthinone').style.display = "none";
				var tam = document.getElementById('hienthinone').innerHTML;
				document.getElementById('manv').value = tam;
				var ten = $('.js-nhanvien :selected').text();
				$("#tennv").val(ten);
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


		</script>
		<!-- BEGIN: block_khongxoa -->
		<script language="JavaScript">
			alert('Bạn không thể xóa khách hàng này do đã có nơi sử dụng  rồi !!! ');
		</script>
		<!-- END: block_khongxoa -->


		<div id="hiennhapexcel"
			style="display:none ; overflow:hidden; position:absolute;   top: 90px;left:0;width:100%; " align="center">
			<div style=" width:900px; min-height:510px;border:1px #999 solid; background-color:#FFF; opacity: 0.98;font-size:15px; 
  font-weight:bold; padding:5px; color:#F00;">

				<div align="right"><b style="color:#00F;cursor:pointer" onclick="goidongid('hiennhapexcel')">( X Đóng
						lại )</b></div>

				<div id="timexxcel" style="padding:10px">
					<div style="display: flex;
    flex-direction: row;    align-items: center;
    justify-content: center;padding-bottom:1em;">
						<!--<a href="data/maupancake.xlsx" style="margin-right:1em">File mẫu pancke</a>
<a href="data/mauthuongmaidientu.xlsx">File mẫu thương mại điện tử</a>-->
					</div>
					<div>
						<input id="mangfilean" type="hidden" size="25" name="mangfilean" value="" />
						<label>File tính lương Excel *.xlsx</label>
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
					<div style="    margin: 0.5em;display: flex;
    justify-content: center;">
						<div class="chiao " style="  border: 1px solid red;">
							<p style="color:#FF0000;font-weight:bold">Tải lên file tính lương</p>
							<button class="button" id="buttonUpload" onclick="return ajaxFileUpload('tinhluong',1);"
								style="height:22px">Tải lên</button>
							<!-- <button class="button" id="buttonUploadmoi" onclick="return hienthidulieumoi();" style="height:22px">Hiển thị</button> -->
						</div>


					</div>

					<div id="resupdate"></div>
					<div id="hienthiexcel" style="padding:5px">

						<table id="tbex" width="100%" border="0" cellpadding="0" cellspacing="0"
							style="background:#FFF;" class="tbchuan">
							<tr bgcolor="#F8E4CB">
								<td align="center" class="cothienthi" height="23" width="32"><b>STT</b></td>

								<td width="75" align="center" class="cothienthi"><strong>Mã Thành Viên</strong></td>
								<td width="360" align="center" class="cothienthi"><strong>Tên</strong> </td>
								<td width="39" align="center" class="cothienthi"><strong>Điện thoại</strong></td>
								<td width="40" align="center" class="cothienthi"><strong>Ngày Sinh</strong> </td>


							</tr>
							<tr bgcolor="" style="color:#000">
								<td align="center" class="cothienthi" height="23" width="32">5</td>

								<td width="75" align="center" class="cothienthi">2805210001</td>
								<td width="360" align="center" class="cothienthi">Nguyễn Văn A</td>
								<td width="39" align="center" class="cothienthi">0987654321</td>
								<td width="40" align="center" class="cothienthi">01/01/2000</td>



							</tr>
						</table>


					</div>

				</div>
			</div>
		</div>



		<div id="khonghienthiapp"></div>
		<script type="text/javascript" src="templates/ajaxfileupload.js"></script>

		<script language="JavaScript">




			function goidongthe() {
				document.getElementById("hiethithongbao").style.display = 'none';
			}



			function timkiemkh(t1, t2, t3, t4, t5, t6, t7, t8, t9) {
				poststr = "DATA=" + encodeURIComponent(t1) + "*@!" + encodeURIComponent(t2) + "*@!" + encodeURIComponent(t3) + "*@!" + encodeURIComponent(t4);
				poststr = poststr + "*@!" + encodeURIComponent(t5) + "*@!" + encodeURIComponent(t6) + "*@!" + encodeURIComponent(t7) + "*@!" + encodeURIComponent(t8) + "*@!" + encodeURIComponent(t9);
				if (t6 != 2) {
					loadtrang('hienthinhacc', "naptienapptim", poststr, "");
				} else {
					loadtrang('hienthinhacc', "naptienapptim", poststr, "");
				}
				//alert('Luu xong !!!');
			}


			function xuatkq() {

				document.getElementById("noidung").value = ' <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"><html><body>' + document.getElementById("hienthinhacc").innerHTML + "</body></html>";
				// alert( document.getElementById("ketqua").value);
				document.getElementById("xuatketqua").submit();
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
							url: 'luongthangupload.php?us=' + tenfile,
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
				var poststr = "DATA=" + encodeURIComponent(0) + "*@!" + encodeURIComponent(0);
				loadtrang('resupdate', "luongthangbaocaohtexcel", poststr, "");

			}

			// function xuly2() {
			// 	var tam = document.getElementByID("resupdate").innerHTML;

			// 	if (tam) {

			// 		alert(tam);
			// 	}
			// }

			function hienthidulieu() {

				var t1;
				//  t1=document.getElementById('idchuyen').value;
				poststr = "DATA=" + encodeURIComponent(t1) + "*@!" + encodeURIComponent(0);
				loadtrang('hienthiexcel', 'tinhluongtailendatahienthi', poststr, "");

			}
			function xuatbaoloi(str) {
				alert(str);
			}

		</script>

</div>
</fieldset>
</div>