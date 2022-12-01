<style>
	.tbthu td {
		border-bottom: 1px dashed #CCCCCC;
	}
</style>
<!-- BEGIN: block_thuchich -->
<div class="top_space"></div>
<div class="nenbao">
	<div style="padding:1px">
		<fieldset class="nencon">
			<legend> <a style="cursor:pointer">
					<label style="Color:#FF3300;Font-Weight:Bold;Font-size:15pt;">Quản lý Phiếu Chi Cửa Hàng</label></a>
			</legend>
			<div>
				<br />
				<form name="frmthuchich" method="post" style="float:left">

					<div style="padding-bottom:10px;padding-left:15px ">
						<div> <b style="display:{q_them}"> [ <b style="cursor:pointer" onclick="setmoi()">Thêm
									Mới</b>]&nbsp;&nbsp;</b>[<a href="default.php?act=md">Đóng Lại</a>]&nbsp; &nbsp;
							&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
							<input id="luachon" name="luachon" value="2" type="hidden" />


						</div>

					</div>
					<fieldset class="nencon">
						<legend>
							<label style="Color:#FF3300;Font-Weight:Bold;Font-size:9pt;"> Thông tin</label>
						</legend>
						<table width="950px" cellpadding="2" cellspacing="2" style="" class="tbthu">

							<tr>
								<td>Ngày chứng từ </td>
								<td>
									<input onkeyup="return chuyentiep(event,'sochungtu')" type="text" name="ngay"
										id="ngay" class="text" style="width:68px" value="{ngay}" />
									<img src="images/img.gif" alt="" id="Lichtungaytao"
										style="cursor: pointer; border: 0px solid red;" title="Date selector"
										onclick="displayCalendar(frmthuchich.ngay,'dd/mm/yyyy',this)" /><span
										style="color:#FF0000">*</span>
								</td>

								<td width="82" align="right">Số chứng từ</td>
								<td colspan="3"><input type="text" name="sochungtu" id="sochungtu" class="text"
										size="12" value="{sochungtu}" onkeyup="return chuyentiep(event,'sotien')"
										onblur="kttrung(this.value)" /> <span style="color:#FF0000">*</span>

									Nhóm chi
									<select onkeypress="return chuyentieps(event,'ngay')" name="loainhom" id="loainhom"
										style="width:160px" onblur="chicongno(this.value)">
										<option value="">Chọn nhóm</option>

										{loainhom}

										<option value="-1">Chi Cho nhà cung cấp</option>
									</select> Chi Cho <select name="cuahang" id="cuahang" style="width:150px">
										{tatca}

										{cuahang}


									</select>
								</td>
							</tr>


							<tr>
								<td width="89">Lý do chi </td>
								<td colspan="5">
									<input type="Text" id="lydo" name="lydo" class="text" style="width:798px"
										value="{lydo}" onkeypress="return chuyentiep(event,'nguoinhan')" /><span
										style="color:#FF0000">*</span>
								</td>
							</tr>
							<tr>
								<td width="89">Loại tài khoản</td>
								<td colspan="5"><select name="loaitaikhoan" id="loaitaikhoan" style="width:105px">
										<option value="0" {loaitaikhoan0}>Tiền mặt</option>
										<option value="1" {loaitaikhoan1}>Ngân hàng</option>
									</select> &nbsp; Tài khoản ngân hàng &nbsp; <select name="nganhang" id="nganhang"
										style="width:545px">
										<option value=""></option>
										{nganhang}
									</select></td>
							</tr>
							<tr>
								<td>Số tiền</td>
								<td width="131"><input type="Text" name="sotien" id="sotien" class="text" size="10"
										value="{sotien}" onkeyup="formatchuan(this)" onblur="txtFormat(this)"
										onkeydown="return chuyentiep(event,'lydo')" /><span
										style="color:#FF0000">*</span>
									<input type="hidden" name="ID" id="ID" class="text" />
									<input type="hidden" name="ngayhn" id="ngayhn" class="text" value="{ngay}" />
									<input type="hidden" name="luachon" id="luachon" class="text" value="1" />

								</td>
								<td width="82">Người chi tiền</td>
								<td width="192"><input type="Text" name="nguoichi" id="nguoichi" class="text" size="18"
										value="{nguoichi}" onkeypress="return chuyentieps(event,'taikhoan')" />
									<span style="color:#FF0000">*</span>
								</td>

								<td width="188" align="right">Người nhận tiền</td>
								<td width="228">&nbsp;&nbsp; &nbsp;&nbsp;
									<input type="Text" name="nguoinhan" id="nguoinhan" class="text" size="18"
										value="{nguoinhan}" onkeypress="return chuyentiep(event,'nguoichi')" />
								</td>

							</tr>
							<tr>
								<td>Đơn vị nhận </td>
								<td colspan="5">
									<div id="donvi"><input type="Text" id="donvi" name="donvi" class="text"
											style="width:606px" value="{donvi}"
											onkeypress="return chuyentiep(event,'note')" />
									</div>

									<div id="dncc" style="display:none">
										<select name="nhacungcap" id="nhacungcap" class="js-khachhang"
											style="width:280px" onchange="timdiachicc(this.value)"
											onkeypress="return chuyentiep(event,'note')">
											<option value="0">Chọn nhà cung cấp</option>

											{nhacungcap}

										</select> <span id="manhacungcap"></span>
									</div>
								</td>
							</tr>
							<tr>
								<td>Tài sản</td>
								<td colspan="5">
									<div id="donvi">
										<select name="loaitaisan" id="loaitaisan" style="width:180px"
											onchange="hienthinhapts(this.value)">
											<option value="0">Chọn có hoặc không</option>
											<option value="1">Có</option>
											<option value="2">Không</option>
										</select>
										<span style="color:#FF0000">*</span> <span style="color:#00F"> mỗi tài sản phải
											làm 1 phiếu chi riêng.</span>
									</div>
									<div id="dncc" style="display:">
										<select name="nhacungcap" id="nhacungcap" class="js-khachhang"
											style="width:280px" onchange="timdiachicc(this.value)"
											onkeypress="return chuyentiep(event,'note')">
											<option value="0">Chọn nhà cung cấp</option>

											{nhacungcap}

										</select> <span id="manhacungcap"></span>
									</div>
								</td>
							</tr>
							<tr>
								<td>Chi chú </td>
								<td colspan="4" valign="middle"><textarea id="note" name="note" class="texta"
										style='width:606px;height:50px;z-index:19'>{note}</textarea> </td>
								<td colspan="1" align="center"> <input type="button" align="middle"
										style="width:70px;height:40px;z-index:20" onclick="goiluu()" name="luu" id="luu"
										value="Lưu" /> &nbsp;<input type="button" align="middle"
										style="width:70px;height:40px;z-index:20" onclick="goiin()" name="in" id="in"
										value="IN Phiếu" /></td>
							</tr>

							<tr>
								<td colspan="6">
									<div style="border:#009 1px solid;display:" id="hiennhaptaisan">
										<table width="100%" border="0" cellpadding="3">

											<tr>
												<td width="14%">
													Mã tài sản</td>
												<td width="86%">
													<input type="Text" onkeypress="return chuyentiep(event,'IDNhomcc')"
														readonly="readonly" name="ma" id="ma" class="text" size="20"
														value="{ma}">
													<input id="idts" name="idts" value="{idts}" type="hidden" />
													<input id="ghichuluu" name="ghichuluu" value="{note2}"
														type="hidden" />
												</td>
											</tr>
											<tr>
												<td width="14%">
													Tên tài sản </td>
												<td width="86%">
													<input type="Text" onkeypress="return chuyentiep(event,'IDNhomcc')"
														name="Name" id="Name" class="text" size="70" value="{Name}">
													<strong style="color:#F00">*</strong>
												</td>
											</tr>

											<tr>
												<td width="14%"> Loại Tài sản </td>
												<td width="86%">
													<select name="type" id="type"
														onkeypress="return chuyentiep(event,'Rank')"
														style="width:200px">
														<option value="1" {type1}>TSCD</option>
														<option value="2" {type2}>TTNH </option>
														<option value="3" {type3}>Tài sản TTDH</option>
														<option value="4" {type4}>Tài sản khác</option>
													</select>
													Nhóm Tài sản <select name="nhomtaisan" id="nhomtaisan"
														style="display:" onkeypress="return chuyentiep(event,'Rank')">
														<option value="0">Nhóm ngành Gốc</option>
														{cay}
													</select>
												</td>
											</tr>




											<tr style="display:none">
												<td>Mô tả sản phẩm</td>
												<td><input type="text" onkeypress="return chuyentiep(event,'IDNhomcc')"
														name="mota" id="mota" class="text" style="width:497px"
														value="{mota}" /></td>
											</tr>
											<tr>
												<td width="14%">Số lượng</td>
												<td width="86%"><input type="number"
														onkeypress="return chuyentiep(event,'IDNhomcc')" name="soluong"
														id="soluong" class="text" size="4" value="{soluong}"
														style="width:60px" /> <strong
														style="color:#F00">*</strong>&nbsp; Đơn Giá :

													<input type="text" name="gia" id="gia" maxlength="12"
														style="width:80px;" onkeyup="formatchuan(this)"
														onblur="txtFormat(this)"
														onkeydown="return chuyentiep(event,'donvitinh')" value="" />
													<strong style="color:#F00">* </strong>( Giá của một sản phẩm )
												</td>
											</tr>
											<tr>
												<td width="14%">Đơn vị tính</td>
												<td width="86%"><select name="donvitinh" id="donvitinh"
														onkeypress="return chuyentiep(event,'Rank')"
														style="width:200px">
														<option value="0">Vui lòng chọn </option>

														{donvitinh}


													</select>
													<strong style="color:#F00">*</strong>
												</td>
											</tr>
											<tr style="display:none">
												<td width="14%">Người nhận TS</td>
												<td width="86%">
													<select name="nguoinhants" id="nguoinhants" class="js-khachhang"
														onkeypress="return chuyentiep(event,'Rank')"
														style="width:300px">
														<option value="0">Vui lòng chọn </option>
														{nguoinhants}
													</select>
													<strong style="color:#F00">*</strong>
													<input type="text" onkeypress="return chuyentiep(event,'IDNhomcc')"
														name="nguoigiao" id="nguoigiao" class="text"
														style="width:197px;display:none" value="{nguoigiao}" />
												</td>
											</tr>
											<tr>
												<td width="14%">Ngày mua TS</td>
												<td width="86%"><input type="text"
														onkeypress="return chuyentiep(event,'IDNhomcc')"
														name="ngaybatdau" id="ngaybatdau" class="text"
														style="width:80px" value="{ngaybatdau}" />
													<span style="padding-bottom:10px"><img src="images/img.gif"
															id="Lichtungaytao"
															style="cursor: pointer; border: 0px solid red;"
															title="Date selector"
															onclick="displayCalendar(frmthuchich.ngaybatdau,'dd/mm/yyyy',this)" /></span>&nbsp;<strong
														style="color:#F00">*</strong> Ngày kết thúc
													<input type="text" onkeypress="return chuyentiep(event,'IDNhomcc')"
														name="ngayketthuc" id="ngayketthuc" class="text"
														style="width:80px" value="{ngayketthuc}" />
													<span style="padding-bottom:10px"><img src="images/img.gif"
															id="Lichtungaytao2"
															style="cursor: pointer; border: 0px solid red;"
															title="Date selector"
															onclick="displayCalendar(frmthuchich.ngayketthuc,'dd/mm/yyyy',this)" /></span>
												</td>
											</tr>

											<tr style="display:none">
												<td width="14%">Thời gian bảo hành</td>
												<td width="86%"><input type="number"
														onkeypress="return chuyentiep(event,'IDNhomcc')" name="baohanh"
														style="width:50px" id="baohanh" class="number" size="2"
														value="{baohanh}" />
													( Tính theo tháng - Ngoại lệ nhập ghi chú)



												</td>
											</tr>

											<tr>
												<td>Ghi chú</td>
												<td><textarea id="note2" name="note2" class="texta"
														style='width:550px;height:115px'>{note2}</textarea>
													<strong>* Tình trạng:  (Mới 100% / Đã qua sử dụng)</strong>
												</td>
											</tr>
											<tr>
												<td>&nbsp;</td>
												<td>&nbsp;</td>
											</tr>
											<tr>
												<td height="26" colspan="2">
													<input type="button" onfocus="setrong()" onclick="luutaisan()"
														class="text" name="btnUpdate" id="btnUpdate" value="Lưu Phiếu">
													&nbsp; <input type="submit" class="text" name="cancel" id="cancel"
														value="Quay Lại" />
													&nbsp;<input type="button" name="inan2" id="inan2"
														onclick="window.close()" value="Đóng Lại"
														style="width:80px;display:{donglai}" />
												</td>
											</tr>
										</table>


									</div>

								</td>
							</tr>
						</table>
					</fieldset>

					<div style="padding:5px">
						<span style="padding-bottom:5px">Ngày
							<input onkeypress="return chuyentiep(event,'denngay')" title="Click đôi để xoá trắng"
								ondblclick="xoatrang(this)" type="text" name="tungay" id="tungay" class="text"
								style="width:68px" value="{tungay}" />
							<img src="images/img.gif" id="Lichtungaytao2"
								style="cursor: pointer; border: 0px solid red;" title="Date selector"
								onclick="displayCalendar(frmthuchich.tungay,'dd/mm/yyyy',this)" />&nbsp;đến
							<input onkeypress="return chuyentieps(event,'luachon')" type="text" name="denngay"
								id="denngay" title="Click đôi để xoá trắng" ondblclick="xoatrang(this)" class="text"
								style="width:68px" value="{denngay}" />
							<img src="images/img.gif" id="Lichtungaytao2"
								style="cursor: pointer; border: 0px solid red;" title="Date selector"
								onclick="displayCalendar(frmthuchich.denngay,'dd/mm/yyyy',this)" /></span>
						<input value="1" type="hidden" name="luachon2" id="luachon2" style="width:147px">

						<select onkeypress="return chuyentieps(event,'loaitk2')" name="nhomtk" id="nhomtk"
							style="width:180px">
							<option value="">Tất cả nhóm</option>
							{loainhom}
						</select>
						<select onkeypress="return chuyentieps(event,'loaitk2')" name="cuahangtk" id="cuahangtk"
							style="width:140px">
							{tatca}
							{cuahang}
						</select>

						<input type="hidden" name="taikhoan2" id="taikhoan2">


						<select name="tinhtrang" id="tinhtrang" style="width:80px">
							<option value="">Tất cả</option>
							<option value="1">Đã khóa</option>
							<option value="0">Chưa khóa</option>

						</select>
						Lý do
						<input type="text" title="Click đôi để xoá trắng" name="lydo2" id="lydo2" class="text" size="20"
							value="" onkeypress="return chuyentiep(event,'loaitk')" ondblclick="xoatrang(this)" />
						<input type="button" style="width:50px"
							onclick="timphieu(tungay.value,denngay.value,2,nhomtk.value,taikhoan2.value,lydo2.value,0,cuahangtk.value,tinhtrang.value)"
							name="search2" id="search2" value="Tìm" />
					</div>
					<div id="hienthitim" align="center">
						<table width="100%" border="0" cellpadding="0" cellspacing="0">
							<tr bgcolor="#F8E4CB">
								<td align="center" class="cothienthi" height="23" width="32"><b>STT</b></td>
								<td width="131" align="center" class="cothienthi" title="Ngày chứng từ"><strong>Ngày
										CT</strong></td>
								<td width="150" align="center" class="cothienthi"><strong><strong><strong>Số chứng
												từ</strong></strong></strong> </td>
								<td width="140" align="center" class="cothienthi"><strong><strong>Số
											tiền</strong></strong></td>
								<td width="489" align="center" class="cothienthi"><strong>Lý do</strong></td>
								<td width="164" align="center" class="cothienthi"><strong><strong>Người lập
											phiếu</strong> </strong></td>
							</tr>
							<tr bgcolor="#FFFFFF">
								<td class="cothienthi" align="right">&nbsp;</td>
								<td class="cothienthi">&nbsp;</td>
								<td class="cothienthi">&nbsp;</td>
								<td class="cothienthi">&nbsp;</td>
								<td class="cothienthi">&nbsp;</td>
								<td class="cothienthi">&nbsp;</td>
							</tr>
						</table>
						<div style="height:300px"></div>
					</div>

				</form>





			</div>
		</fieldset>
	</div>
	<div id="ketqualuu" style="display:"></div>
</div>











<!-- END: block_thuchich -->
<script src="js/jquery-1.7.2.min.js"></script>
<script src="js/select2.min.js"></script>
<link rel="stylesheet" media="screen" href="js/select2.min.css">
<script language="javascript" src="templates/phieuchich.js"> </script>
<script language="javascript">
	setmoi()

	$(document).ready(function () {
		$('.js-khachhang').select2();

	});

	function chicongno(vl) {
		if (vl == '-1') {
			document.getElementById('dncc').style.display = "";
			document.getElementById('donvi').style.display = "none";

		} else {
			document.getElementById('donvi').style.display = "";
			document.getElementById('dncc').style.display = "none";
		}
	}

	$(document).ready(function () {
		$('.js-khachhang').select2();

	});
</script>